<?php
use \CUtilEx as CUtil;

class MoySklad
{
	const API_URL = 'https://online.moysklad.ru/api/posap/1.0';

	const USERNAME = 'admin@kck007';
	const PASSWORD = 'sly9119';
	//const USERNAME = 'user@kck007';
	//const PASSWORD = 'sly9119';
	
	const TOKEN_LIFE_MINUTES = 5;
	
	const CATALOG_IBLOCK_ID = 22;
	
	const COUNTRY_PROP_ID = 201;
	
	const DISABLED_FOLDER_ID = "0ae42681-bd7b-11e8-9107-5048000396b7";	// ID категории, которую не нужно синронизировать с Битриксом

	/**
	 * @var string
	 */
	public $token;

	/**
	 * @var integer
	 */
	public $tokenExpire;

	/**
	 * @var integer
	 */
	public $catalogIblockId;

	/**
	 * @var array
	 */
	public $arSections;

	/**
	 * @var array
	 */
	public $sectionInfo;
	
	/**
	 * @var array
	 */
	public $syncProps;

	/**
	 * @var string
	 */
	public $saveImagePath;

	/**
	 * @var
	 */
	public $startTime;

	/**
	 * @return array
	 */
	public function getRetailStore()
	{
		$url = self::API_URL . '/admin/retailstore';
		$credentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);
		$data = $this->getData($url, $credentials, false);
		$data = json_decode($data, true);
		return $data;
	}

	/**
	 * @return string
	 */
	public function getToken()
	{
		$arRetailStore = $this->getRetailStore();
		//AddMessage2Log($arRetailStore, "getRetailStore");
		$id = $arRetailStore['rows'][0]['id'];
		//$id = $arRetailStore['rows'][1]['id'];
		$url = self::API_URL . '/admin/attach/' . $id;
		$credentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);

		$data = $this->getData($url, $credentials,true);
		$data = json_decode($data, true);

		return $data['token'];
	}

	/**
	 * Запрос на получение всех папок
	 *
	 * @return mixed
	 */
	public function getProductFolder()
	{
		$url = self::API_URL . '/entity/productfolder';
		$credentials = array('username' => self::USERNAME, 'password' => $this->token);
		$data = $this->getData($url, $credentials);
		$data = json_decode($data, true);
		return $data['rows'];
	}

	/**
	 * Запрос на получение товаров/модификаций и остатков по ним
	 *
	 * @return mixed
	 */
	public function getProducts()
	{
		$rows = [];

		$url = self::API_URL . '/entity/assortment?stockmode=all';
//		$url = self::API_URL . '/entity/assortment?limit=1000&offsetId=2743a6da-9314-11e7-7a69-93a7002dc2bb&direction=forward';
//		$url = self::API_URL . '/entity/assortment?limit=1000&offsetId=48c4daea-209f-11e7-7a69-93a700086781&direction=forward';
//		$url = self::API_URL . '/entity/assortment?limit=1000&offsetId=57c161d6-966a-11e7-7a69-93a70064c4d4&direction=forward';
//		$url = self::API_URL . '/entity/assortment?limit=1000&offsetId=8cd98b1c-2132-11e7-7a69-93a7004db552&direction=forward';
//		$url = self::API_URL . '/entity/assortment?limit=1000&offsetId=d5d2aef9-b703-11e7-7a31-d0fd0009ce8e&direction=forward';
		$credentials = array('username' => self::USERNAME, 'password' => $this->token);

		while ($url != '')
		{
			$data = $this->getData($url, $credentials);
			$data = json_decode($data, true);

			$rows = array_merge($rows, $data['rows']);
			if(!empty($data['meta']['nextHref']))
			{
				$url = $data['meta']['nextHref'];
			}
			else
			{
				$url = '';
			}
		}

		//echo "<pre>";print_r($rows);echo "</pre>";
        //\Bitrix\Main\Diag\Debug::dumpToFile($rows, "", '/upload/2txt');
		return $rows;
	}


	/**
	 * синхронизация разделов каталога и папок с моего склада
	 */
	public function syncCatalogSections()
	{
		$logFileTimes = $_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/syncCatalogSections_times.log';
		file_put_contents($logFileTimes, 'syncCatalogSections::BEGIN - ' . date('d.m.Y H:i:s') . "\r\n", FILE_APPEND | LOCK_EX);

		//получаем все разделы
		$arFolders = $this->getProductFolder();
		file_put_contents($_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/folders.log', var_export($arFolders, true), LOCK_EX);

		$this->arSections = array();
		$bs = new CIBlockSection;

		foreach ($arFolders as $keyFolder=>&$arFolder)
		{
			if(($arFolder["id"] != MoySklad::DISABLED_FOLDER_ID) AND (stripos($arFolder["path"],MoySklad::DISABLED_FOLDER_ID) === false)){
				$arSection = $this->findSectionByName($arFolder['name']);

				if(!empty($arSection))
				{
					// раздел присутствует в каталоге
					// проверяем его внешний код. еслу нужно - обновляем его
					$this->checkExternalId($bs, $arSection, $arFolder['id']);

                    // проверяем есть ли в каталоге родитель
                    // парсим путь папок для получения его родителей

                    $arNamePath = explode('/', $arFolder['namepath']);

                    //Проверяем совпадают ли значения родительских разделов у текущего раздела
                    $parentSection=$this->findSectionByName(end($arNamePath));
                    if($parentSection['ID']!=$arSection['IBLOCK_SECTION_ID'])
                    {

                        //ЕСЛИ родитель не совпадает, то меняем

                        // убираем лишние слеши с начала и конца строки
                        $arFolder['path'] = substr($arFolder['path'], 1, -1);
                        $arPath = explode('/', $arFolder['path']);

                        // проходим по полученному массиву и, если нужно, добавляем в базу разделы
                        $IBLOCK_SECTION_ID = false;

                        foreach ($arNamePath as $key=>$name)
                        {
                            if($name == '') continue;

                            if (isset($this->arSections[$name.'-'.$arPath[$key]]))
                            {
                                // проверяем... имеется ли такой раздел в сохраненных
                                $IBLOCK_SECTION_ID = $this->arSections[$name.'-'.$arPath[$key]];
                            }
                            else
                            {
                                // ищем раздел по имени
                                $arSectParent = $this->findSectionByName($name);
                                if(empty($arSectParent))
                                {
                                    // если не нашли - создаем
                                    $IBLOCK_SECTION_ID = $this->createNewSection($name, $arPath[$key], $IBLOCK_SECTION_ID);
                                }
                                else
                                {
                                    $IBLOCK_SECTION_ID = $arSectParent['ID'];
                                    $this->arSections[$name.'-'.$arPath[$key]] = $IBLOCK_SECTION_ID;
                                }
                            }
                        }

                        $this->UpdateSection($arSection['ID'], $arFolder['id'], $IBLOCK_SECTION_ID);

                    }

					$this->arSections[$arFolder['name'].'-'.$arFolder['id']] = $arSection['ID'];
				}
				else
				{
					// раздел отсутствует в каталоге

					// проверяем есть ли в каталоге родитель
					// парсим путь папок для получения его родителей

					$arNamePath = explode('/', $arFolder['namepath']);

					// убираем лишние слеши с начала и конца строки
					$arFolder['path'] = substr($arFolder['path'], 1, -1);
					$arPath = explode('/', $arFolder['path']);

					// проходим по полученному массиву и, если нужно, добавляем в базу разделы
					$IBLOCK_SECTION_ID = false;

					foreach ($arNamePath as $key=>$name)
					{
						if($name == '') continue;

						if (isset($this->arSections[$name.'-'.$arPath[$key]]))
						{
							// проверяем... имеется ли такой раздел в сохраненных
							$IBLOCK_SECTION_ID = $this->arSections[$name.'-'.$arPath[$key]];
						}
						else
						{
							// ищем раздел по имени
							$arSectParent = $this->findSectionByName($name);
							if(empty($arSectParent))
							{
								// если не нашли - создаем
								$IBLOCK_SECTION_ID = $this->createNewSection($name, $arPath[$key], $IBLOCK_SECTION_ID);
							}
							else
							{
								$IBLOCK_SECTION_ID = $arSectParent['ID'];
								$this->arSections[$name.'-'.$arPath[$key]] = $IBLOCK_SECTION_ID;
							}
						}
					}

					// создаем нужный раздел
					$IBLOCK_SECTION_ID = $this->createNewSection($arFolder['name'], $arFolder['id'], $IBLOCK_SECTION_ID);
					$this->arSections[$arFolder['name'].'-'.$arFolder['id']] = $IBLOCK_SECTION_ID;
				}
			}
		}


		if(count($arFolders))
		{
			// после обработки каталога, удаляем товары которые не пришли из МойСклад
			global $DB;

			$arFilter = array(
				'IBLOCK_ID' => $this->catalogIblockId,
				'<TIMESTAMP_X' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), ($this->startTime)),
			);

			$rsSect = CIBlockSection::GetList(array(), $arFilter, false, array("ID"), false);
//			while ($arSect = $rsSect->GetNext())
			while ($arSect = $rsSect->Fetch())
			{
				$DB->StartTransaction();
				if(!CIBlockSection::Delete($arSect['ID']))
				{
					file_put_contents($logFileTimes, '!! ERROR DELETE ELEMENT ID =  ' . $arSect['ID'] . "\r\n", FILE_APPEND | LOCK_EX);
					$DB->Rollback();
				}
				else
				{
					$DB->Commit();
				}
			}
		}

		file_put_contents($logFileTimes, 'syncCatalogSections::END - ' . date('d.m.Y H:i:s') . "\r\n\r\n", FILE_APPEND | LOCK_EX);
	}

	public function syncCatalogProducts(bool $full_sync = false)
	{
		$logFileTimes = $_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/syncCatalogProducts_times.log';
		file_put_contents($logFileTimes, 'syncCatalogProducts::BEGIN - ' . date('d.m.Y H:i:s') . "\r\n", FILE_APPEND | LOCK_EX);

		// получаем список товаров
		$arProducts = $this->getProducts();
		file_put_contents($_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/products.log', var_export($arProducts, true), LOCK_EX);

		$el = new CIBlockElement;

		foreach ($arProducts as $arProduct)
		{
			// проверяем есть ли такой товар в каталоге
			$arInfo = $this->findProductByExtCode($arProduct['id']);


			// Получаем остатки
			$JSONurl = 'https://online.moysklad.ru/api/remap/1.1/report/stock/bystore?product.id='.$arProduct['id'];
			$JSONcredentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);
			$JSONarStock = json_decode($this->getData($JSONurl, $JSONcredentials),true);


			if($arInfo !== false)
			{
				// товар найден. обновляем его
				$this->updateProduct($el, $arProduct, $arInfo, $JSONarStock["rows"][0]["stockByStore"], $full_sync);
			}
			else
			{
				// товар не найден. создаем....
				$this->createProduct($el, $arProduct, $JSONarStock["rows"][0]["stockByStore"]);

			}

			if($this->tokenExpire < time())
			{
				// получаем новый токен для работы
				$this->token = $this->getToken();
				$this->tokenExpire = time() + 60 * self::TOKEN_LIFE_MINUTES;
			}
		}


		if(count($arProducts))
		{
			// после обработки каталога, удаляем товары которые не пришли из МойСклад
			global $DB;

			$arFilter = array(
				'IBLOCK_ID' => $this->catalogIblockId,
				'<=TIMESTAMP_X' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), $this->startTime),
			);

			$rsSect = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID"));
			while ($arProd = $rsSect->GetNext())
			{
				$DB->StartTransaction();
				if(!CIBlockElement::Delete($arProd['ID']))
				{
					file_put_contents($logFileTimes, '!! ERROR DELETE ELEMENT ID =  ' . $arProd['ID'] . "\r\n", FILE_APPEND | LOCK_EX);
					$DB->Rollback();
				}
				else
				{
					$DB->Commit();
				}
			}
		}

		// Обновляем связи свойств с разделами
		$this->UpdateSectionPropsLinks();
		
		file_put_contents($logFileTimes, 'syncCatalogProducts::END - ' . date('d.m.Y H:i:s') . "\r\n\r\n", FILE_APPEND | LOCK_EX);
		
		// Запускаем обновление фида Яндекс.Маркета
		CCatalogExport::PreGenerateExport(3);
	}

	public function syncCatalogProductsExtCodes()
	{
		$logFileTimes = $_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/syncCatalogProductsExtCodes_times.log';
		file_put_contents($logFileTimes, 'syncCatalogProductsExtCodes::BEGIN - ' . date('d.m.Y H:i:s') . "\r\n", FILE_APPEND | LOCK_EX);

		// получаем список товаров из "Мой склад"
		$arProducts = $this->getProducts();

		$el = new CIBlockElement;

		$this->arSections = [];

		foreach ($arProducts as $arProduct)
		{
			pr($arProduct);
			// проверяем есть ли такой товар в каталоге
			$arInfo = $this->findProduct($arProduct);

			if($arInfo !== false)
			{
				$arFields = ['EXTERNAL_ID' => $arProduct['id']];

				$res = $el->Update($arInfo['ID'], $arFields);
			}
		}

		file_put_contents($logFileTimes, 'syncCatalogProductsExtCodes::END - ' . date('d.m.Y H:i:s') . "\r\n\r\n", FILE_APPEND | LOCK_EX);
	}


	/**
	 * @param string $url
	 * @param array $credentials
	 * @param bool   $isPost
	 *
	 * @return mixed
	 */
	private function getData($url = '', $credentials = array(), $isPost = false)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		if($isPost)
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));
		}

		if(count($credentials))
		{
			curl_setopt($ch, CURLOPT_USERPWD, $credentials['username'] . ':' . $credentials['password']);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
//				'Content-Length: ' . strlen(json_encode(array()))
			)
		);

		$res = curl_exec($ch);

//		$logFileTimes = $_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/curl.log';
//		file_put_contents($logFileTimes, 'getData - ' . date('d.m.Y H:i:s') . "\r\n", FILE_APPEND | LOCK_EX);
//		file_put_contents($logFileTimes, $url .' ...url' . "\r\n", FILE_APPEND | LOCK_EX);
//		file_put_contents($logFileTimes, ($credentials['username']) . "\r\n", FILE_APPEND | LOCK_EX);
//		file_put_contents($logFileTimes, ($credentials['password']) . "\r\n", FILE_APPEND | LOCK_EX);
//		file_put_contents($logFileTimes, $res . "\r\n\r\n", FILE_APPEND | LOCK_EX);

		curl_close($ch);
		return $res;
	}

	public function save_image($img = '', $credentials = array())
	{
		$res = false;

		$curl = curl_init($img);
		curl_setopt($curl, CURLOPT_USERPWD, $credentials['username'] . ':' . $credentials['password']);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);

		$content = curl_exec($curl);
		curl_close($curl);


		if($content !== '' && $content !== false)
		{
//			$simpleImage = new SimpleImage();
//			$simpleImage->fromString($content);
//			$mimeType = $simpleImage->getMimeType();
//
//			$file = basename($img);
//
//			switch($mimeType) {
//				case 'image/gif':
//					$file .= '.gif';
//					break;
//
//				case 'image/jpeg':
//					$file .= '.jpg';
//					break;
//
//				case 'image/png':
//					$file .= '.png';
//					break;
//			}
//
//			$filePath = $this->saveImagePath . $file;
//			$simpleImage->toFile($filePath);

			$file = basename($img);
			$filePath = $this->saveImagePath . $file;

			$fp = fopen($filePath,'w');
			fwrite($fp, $content);
			fclose($fp);
			$ext = '';
			switch(exif_imagetype($filePath))	{
				case 1:
					$ext = '.gif';
					break;
				case 2:
					$ext = '.jpg';
					break;
				case 3:
					$ext = '.png';
					break;
				case 6:
					$ext = '.bmp';
					break;
			}

			if ($ext != '')
			{
				$filePathNew = $filePath . $ext;
				rename($filePath, $filePathNew);
				$res = $filePathNew;
			}
			else
			{
				$res = $filePath;
			}
		}

		return $res;
	}

	/**
	 * поиск раздела по его имени
	 * подразумевается, что имя уникальное
	 *
	 * @param string $name
	 *
	 * @return array
	 */
	private function findSectionByName($name = '')
	{
		$arFilter = array(
			'IBLOCK_ID' => $this->catalogIblockId,
			'NAME' => $name
		);

		$rsSect = CIBlockSection::GetList(array(), $arFilter);
		$arSect = $rsSect->GetNext();
		return $arSect;
	}

	private function findSectionByExtCode($extId = '')
	{
		$arFilter = array(
			'IBLOCK_ID' => $this->catalogIblockId,
			'EXTERNAL_ID' => $extId
		);

		$rsSect = CIBlockSection::GetList(array(), $arFilter);
		$arSect = $rsSect->GetNext();
		return $arSect;
	}


	/**
	 * проверяет корректность поля EXTERNAL_ID
	 * и если нужно - обновляет его
	 *
	 * @param CIBlockSection $bs
	 * @param array  $arSect
	 * @param string $externalId
	 *
	 * @return bool
	 */
	private function checkExternalId(&$bs, &$arSect = array(), $externalId = '')
	{
		global $DB;

		$res = true;

//		if($arSect['EXTERNAL_ID'] != $externalId)
//		{
			$arFields = array(
				'EXTERNAL_ID'=>$externalId,
				'TIMESTAMP_X'=>date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), $this->startTime)
			);
			$res = $bs->Update($arSect['ID'], $arFields);
			$arSect['EXTERNAL_ID'] = $externalId;
//			var_dump($arSect['ID']);
//			var_dump($res);
//		}
		return $res;
	}

	/**
	 * создание нового раздела
	 *
	 * @param string $NAME
	 * @param string $EXTERNAL_ID
	 * @param bool   $IBLOCK_SECTION_ID
	 *
	 * @return bool|int
	 */
	private function createNewSection($NAME = '', $EXTERNAL_ID = '', $IBLOCK_SECTION_ID = false)
	{
		$bs = new CIBlockSection;
		$codeParams = array("replace_space"=>"_","replace_other"=>"_");

		$arFields = Array(
			"ACTIVE" => "Y",
			"IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
			"IBLOCK_ID" => $this->catalogIblockId,
			"NAME" => $NAME,
			"SORT" => 500,
			"EXTERNAL_ID" => $EXTERNAL_ID,
			"CODE" => Cutil::translit($NAME, "ru", $codeParams)
		);

//		pr($arFields);//die();
		
		$ID = $bs->Add($arFields);
//		$res = ($ID>0);
//		if(!$res)
//			echo $bs->LAST_ERROR;

		return $ID;
	}

    private function UpdateSection($ID, $EXTERNAL_ID = '', $IBLOCK_SECTION_ID = false)
    {
        $bs = new CIBlockSection;
        $codeParams = array("replace_space"=>"_","replace_other"=>"_");

        $arFields = Array(
            "IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
            "EXTERNAL_ID" => $EXTERNAL_ID,

        );

        $bs->Update($ID, $arFields);
    }


	/**
	 * поиск товара по его
	 * внешнему коду
	 *
	 * @param string $extCode
	 *
	 * @return array | bool
	 */
	private function findProductByExtCode($extCode = '')
	{
		$arFilter = array(
			'IBLOCK_ID' => $this->catalogIblockId,
			'EXTERNAL_ID' => $extCode
		);

		$rs = CIBlockElement::GetList(array(), $arFilter);
		$ar = $rs->GetNext();
		return $ar;
	}


	/**
	 * поиск раздела по его имени
	 * подразумевается, что имя уникальное
	 *
	 * @param string $name
	 *
	 * @return array | bool
	 */
	private function findProductByName($name = '')
	{
		$arFilter = array(
			'IBLOCK_ID' => $this->catalogIblockId,
			'NAME' => $name
		);

		$rsSect = CIBlockElement::GetList(array(), $arFilter);
		$arProd = $rsSect->GetNext();
		return $arProd;
	}


//	private function findProduct($name = '', $path = '')
	private function findProduct($arProduct = array())
	{
//		$this->arSections[$arFolder['name'].'-'.$arFolder['id']] = $arSection['ID'];
		$name = $arProduct['name'];

		$arSection = $this->getSectionInfo($arProduct['productFolder']);


		$arFilter = array(
			'IBLOCK_ID' => $this->catalogIblockId,
			'NAME' => $name,
		);

		if($arSection !== false)
		{
			$arFilter['SECTION_ID'] = $arSection['ID'];
		}

		$this->sectionInfo = $arSection;

		$rsSect = CIBlockElement::GetList(array(), $arFilter);
		$arProd = $rsSect->GetNext();
		return $arProd;
	}

	private function updateProduct(&$el, $arItem = array(), $arInfo = array(), $stockByStore = array(), $full_sync = false)
	{

//		pr($this->sectionInfo);//die();
//		pr($arInfo);//die();
//		pr($arItem);die();

		/*
		 * обновляем поля:
		 * - название
		 * - символьный код
		 * - раздел каталога
		 *
		 * обновляем св-ва
		 * - артикул
		 * - остаток на складе
		 *
		 * обновлем
		 * - остаток
		 * - цену
		 *
		 */



		$codeParams = array("replace_space"=>"_","replace_other"=>"_");

		//получем информацию по разделу
		$arSection = $this->getSectionInfo($arItem['productFolder']);

		// Если товар в корне или в разделе "1 Товары" - удаляем
		if(($arSection !== false) AND (stripos($arItem['productFolder']["path"],MoySklad::DISABLED_FOLDER_ID) === false)){
	//		pr($arSection);
			//echo "<pre>";print_r($arItem);echo "</pre>";
			//exit;
			
				//echo "<pre>";print_r($arItem);echo "</pre>";
				// Получаем товар через JSON API, т.к. в POS API не приходит закупочная цена
				$JSONurl = 'https://online.moysklad.ru/api/remap/1.1/entity/product/'.$arItem["id"];
				$JSONcredentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);
				$JSONarItem = json_decode($this->getData($JSONurl, $JSONcredentials),true);

			$arFields = array(
				"MODIFIED_BY"       => 1,
	//			"IBLOCK_SECTION_ID" => $this->sectionInfo['ID'],
				"IBLOCK_SECTION_ID" => ($arSection!==false ? $arSection['ID'] : false),
				"NAME"              => $arItem['name'],
				"DETAIL_TEXT"       => $JSONarItem['description'],
				"DETAIL_TEXT_TYPE" => 'html',
	//			"IBLOCK_ID"         => $this->catalogIblockId,
	//			"ACTIVE"            => "Y",
	//			"CODE"              => Cutil::translit($arItem['name'].'_'.$arItem['article'],"ru",$codeParams),
	//			'DETAIL_PICTURE'    => $detailPicture,
	//			'PREVIEW_PICTURE'   => $detailPicture,
	//			"EXTERNAL_ID"       => $arItem['id'],
	//			"PROPERTY_VALUES"   => $arPropEl,
			);

            //Если у товара нет картинки или стоит полная синхронизация, то обновляем картинку
			if(empty($arInfo['DETAIL_PICTURE']) || $full_sync){
				$credentials = array('username' => self::USERNAME, 'password' => $this->token);
				$filePath = $this->save_image($arItem['image']['href'], $credentials);

				if($filePath !== false){
					$arFields["DETAIL_PICTURE"] = $arFields["PREVIEW_PICTURE"] = CFile::MakeFileArray($filePath);
				}
			}

			if($el->Update($arInfo['ID'], $arFields))
			{
				
				$JSONarItem["attributes"][] = Array(
                    'id' => 'weight',
                    'name' => 'Вес',
                    'type' => 'double',
                    'value' => $JSONarItem["weight"],				
				);
				
				$JSONarItem["attributes"][] = Array(
                    'id' => 'barcode',
                    'name' => 'Штрихкод',
                    'type' => 'double',
                    'value' => $JSONarItem["barcodes"][0],				
				);				

				$this->SetCountry($arInfo['ID'], $JSONarItem);

				$this->SetProductProperties($arInfo['ID'],$JSONarItem["attributes"]);
				
		//if ($arItem['article']=='АРТИКУЛ676N7777' || $arInfo['ID']==152299) file_put_contents($_SERVER["DOCUMENT_ROOT"].'/local/sync_app/logs/new.log', print_r($JSONarItem, true)."\n-------------".print_r($stock, true)."\n-------------".print_r($arFields, true));

				// обновляем свойства
				$arProps = array('ARTICUL' => $arItem['article']);
				$InStockAll = 0;
				foreach($stockByStore as $stock){
					if($stock["name"] == "Можайский двор"){
						$arProps['REST_STOCK_1'] = $stock["stock"];
					} else {
						$arProps['REST_STOCK_0'] = $stock["stock"];
					}
					$InStockAll += $stock["stock"];
				}

                if($InStockAll>0) {
                    $enumId = CIBlockProperty::GetPropertyEnum('STOCK', [], ["IBLOCK_ID"=>MoySklad::CATALOG_IBLOCK_ID, "XML_ID"=>'Y'])->GetNext();

                }
                else {
                    $enumId = CIBlockProperty::GetPropertyEnum('STOCK', [], ["IBLOCK_ID"=>MoySklad::CATALOG_IBLOCK_ID, "XML_ID"=>'N'])->GetNext();
                }
                CIBlockElement::SetPropertyValuesEx($arInfo['ID'], $this->catalogIblockId, ['STOCK' => $enumId['ID']]);

				$arProps['MOYSKLAD_UOM'] = $arItem['uom'];
				$arProps['UPDATED_MOY_SKLAD'] = date("d.m.Y G:i:s",MakeTimeStamp($JSONarItem['updated'], "YYYY-MM-DD HH:MI:SS"));
				CIBlockElement::SetPropertyValuesEx($arInfo['ID'], $this->catalogIblockId, $arProps);
				// обновляем остаток товара
				//$arFields = array('QUANTITY' => $InStockAll, 'PURCHASING_CURRENCY'=>'RUB', "PURCHASING_PRICE" => ($JSONarItem['buyPrice']['value']/100));
                $arFields = array('QUANTITY' => $InStockAll);
				//CCatalogProduct::Update($arInfo['ID'], $arFields);
                $arFields['ID']=$arInfo['ID'];

                CCatalogProduct::Add($arFields);
				
				/*echo "<pre>";print_r($JSONarItem);echo "</pre>";
				echo "<pre>";print_r($arInfo);echo "</pre>";
				echo "<pre>";print_r($arItem);echo "</pre>";
				exit;*/
				
				// обновляем цену
				$arFields = Array(
					"PRODUCT_ID" => $arInfo['ID'],
					"CATALOG_GROUP_ID" => 1,
					"PRICE" => $this->getPrice($arItem['salePrices']),
	//				"PRICE" => 79,
					"CURRENCY" => 'RUB'
				);

				//echo $arItem['name']." Цена: <pre>";print_r($arItem);echo "<pre>";print_r($arFields);echo "</pre>";
				
				$res = CPrice::GetList(array(),array("PRODUCT_ID" => $arInfo['ID'],"CATALOG_GROUP_ID" => 1));

				if ($arr = $res->Fetch())
				{
					CPrice::Update($arr["ID"], $arFields);
                    CIBlockElement::SetPropertyValues(
                        $arInfo['ID'],
                        MoySklad::CATALOG_IBLOCK_ID,
                        $this->getPrice($arItem['salePrices']),
                        'PRICE'
                    );

                    CIBlockElement::SetPropertyValues(
                        $arInfo['ID'],
                        MoySklad::CATALOG_IBLOCK_ID,
                        $this->getMarketPrice($arItem['salePrices']),
                        'PRICE_MARKET'
                    );
				}
				else
				{
					CPrice::Add($arFields);
				}
			}

	//		die('update');
		} else {
			CIBlockElement::Delete($arInfo['ID']);
		}
	}

	private function createProduct(&$el, $arItem = array(), $stockByStore = array())
	{

//		pr($arItem);//die();
		//
		$credentials = array('username' => self::USERNAME, 'password' => $this->token);
		$filePath = $this->save_image($arItem['image']['href'], $credentials);

		if($filePath !== false)
		{
			$detailPicture = CFile::MakeFileArray($filePath);
		}
		else
		{
			$detailPicture = false;
		}



//		$data = $this->getData($arItem['image']['href'], array());
//		pr($arItem['image']['href']);
//		pr($credentials);
//		pr($data);
//		$data = json_decode($data, true);

//		die();

		$codeParams = array("replace_space"=>"_","replace_other"=>"_");

		//получем информацию по разделу
		$arSection = $this->getSectionInfo($arItem['productFolder']);
		
		
		// Если товар в корне или в разделе "1 Товары" - не добавляем
		if(($arSection !== false) AND (isset($arItem['productFolder'])) AND ($arItem['productFolder']['name'] != "1 Товары")){
			$arPropEl = array('ARTICUL' => $arItem['article']);
			$arPropEl['MOYSKLAD_UOM'] = $arItem['uom'];
			
			$InStockAll = 0;
			foreach($stockByStore as $stock){
				if($stock["name"] == "Можайский двор"){
					$arPropEl['REST_STOCK_1'] = $stock["stock"];
				} else {
					$arPropEl['REST_STOCK_0'] = $stock["stock"];
				}
				$InStockAll += $stock["stock"];
			}
			
			$arFields = array(
				"MODIFIED_BY"       => 1,
				"IBLOCK_SECTION_ID" => ($arSection!==false ? $arSection['ID'] : false),
				"NAME"              => $arItem['name'],
				"IBLOCK_ID"         => $this->catalogIblockId,
				"ACTIVE"            => "Y",
				"CODE"              => Cutil::translit($arItem['name'].'_'.$arItem['article'],"ru",$codeParams),
				'DETAIL_PICTURE'    => $detailPicture,
				'PREVIEW_PICTURE'   => $detailPicture,
				"EXTERNAL_ID"       => $arItem['id'],
				"PROPERTY_VALUES"   => $arPropEl,
			);



	//		pr($arPropEl);//die();
	//		pr($arFields);//die();
			
			if($PRODUCT_ID = $el->Add($arFields))
			{
				// Получаем товар через JSON API, т.к. в POS API не приходит закупочная цена
				$JSONurl = 'https://online.moysklad.ru/api/remap/1.1/entity/product/'.$arItem["id"];
				$JSONcredentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);
				$JSONarItem = json_decode($this->getData($JSONurl, $JSONcredentials),true);
				$this->SetCountry($PRODUCT_ID, $JSONarItem);

				$this->SetProductProperties($PRODUCT_ID,$JSONarItem["attributes"]);
				$res = CCatalogProduct::add(array("ID" => $PRODUCT_ID, "QUANTITY" => $InStockAll, "PURCHASING_PRICE" => ($JSONarItem['buyPrice']['value']/100)));
				
				$arProps = array();
				$arProps['UPDATED_MOY_SKLAD'] = date("d.m.Y G:i:s",MakeTimeStamp($JSONarItem['updated'], "YYYY-MM-DD HH:MI:SS"));
				CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, $this->catalogIblockId, $arProps);	
	//			var_dump($productID);

				$arFields = Array(
					"CURRENCY"         => "RUB",       // валюта
					"PRICE"            => $this->getPrice($arItem['salePrices']),      // значение цены
					"CATALOG_GROUP_ID" => 1,           // ID типа цены
					"PRODUCT_ID"       => $PRODUCT_ID,  // ID товара
				);

	//			pr($arFields);//die();


				$res = CPrice::Add($arFields);
                CIBlockElement::SetPropertyValues(
                    $PRODUCT_ID,
                    MoySklad::CATALOG_IBLOCK_ID,
                    $this->getPrice($arItem['salePrices']),
                    'PRICE'
                );

                CIBlockElement::SetPropertyValues(
                    $PRODUCT_ID,
                    MoySklad::CATALOG_IBLOCK_ID,
                    $this->getMarketPrice($arItem['salePrices']),
                    'PRICE_MARKET'
                );
	//			var_dump($res);
			}
			else
			{
				echo " Error 1: ".$el->LAST_ERROR . "\r\n";
                \Bitrix\Main\Diag\Debug::dumpToFile([$el->LAST_ERROR, date("Y-m-d H:i:s")], "", '/upload/Errors.txt');
	//			file_put_contents($logFile, 'Ошибка создания нового товара ' . "\r\n", FILE_APPEND | LOCK_EX);
	//			file_put_contents($logFile, $arItem['OLD_ID']." Error: ".$el->LAST_ERROR . "\r\n", FILE_APPEND | LOCK_EX);
			}
	//		pr($arItem);die();
		}
	}

	/**
	 * @param array $arPrice
	 *
	 * @return float|int
	 */
	private function getPrice($arPrice = array())
	{
		$res = 0;
		foreach ($arPrice as $price)
		{
			if ($price['priceType'] == 'Интернет магазин')
			{
				// нужно делить на 100, так как приходит целое число,
				// а цены д.б. с копейками
				$res = floatval($price['value'] / 100);
			}
		}

		return $res;
	}

    /**
     * @param array $arPrice
     *
     * @return float|int
     */
    private function getMarketPrice($arPrice = array())
    {
        $res = 0;
        foreach ($arPrice as $price)
        {
            if ($price['priceType'] == 'Цена продажи')
            {
                // нужно делить на 100, так как приходит целое число,
                // а цены д.б. с копейками
                $res = floatval($price['value'] / 100);
            }
        }

        return $res;
    }

	public function getSectionInfo($productFolder)
	{
		$sectionKey = $productFolder['name'] . '-' . $productFolder['id'];
		if(!is_set($this->arSections[$sectionKey]))
		{
			$path = $productFolder['path'];

			// убираем лишние слеши с начала и конца строки
			$path = substr($path, 1, -1);
			$arPath = explode('/', $path);

			$arSection = $this->findSectionByExtCode($arPath[(count($arPath)-1)]);
			if($arSection !== false)
			{
				$this->arSections[$sectionKey] = $arSection;
			}
		}
		else
		{
			$arSection = $this->arSections[$sectionKey];
		}

		return $arSection;
	}
	
	public function RebuildPropCode($prop_id){
		return "ms_".str_replace("-","_",$prop_id);
	}
	
	// Получаем страну
	public function SetCountry($product_id, $arItem){
		if(isset($arItem["country"]["meta"]["href"])){
			$iblockproperty_enum = new CIBlockPropertyEnum;
			$JSONcredentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);
			$JSONCountry = json_decode($this->getData($arItem["country"]["meta"]["href"], $JSONcredentials),true);
			$property_enums = CIBlockPropertyEnum::GetList(Array(), Array("PROPERTY_ID"=>self::COUNTRY_PROP_ID));
			$isset_fl = false;
			while($enum_fields = $property_enums->GetNext()){
				if($enum_fields["VALUE"] == $JSONCountry["name"]){
					CIBlockElement::SetPropertyValues(
						$product_id,
						MoySklad::CATALOG_IBLOCK_ID,
						$enum_fields["ID"],
						self::COUNTRY_PROP_ID
					);
					$isset_fl = true;
					break;
				}
			}
			// Если значение в списке не найдено - добавляем
			if(!$isset_fl){
				$EntityID = $iblockproperty_enum->Add(Array('PROPERTY_ID'=>self::COUNTRY_PROP_ID, 'VALUE'=>$JSONCountry["name"]));
				CIBlockElement::SetPropertyValues(
					$product_id,
					MoySklad::CATALOG_IBLOCK_ID,
					$EntityID,
					self::COUNTRY_PROP_ID
				);
			}
			//echo "<pre>";print_r($JSONCountry);echo "</pre>";
		} else {
			CIBlockElement::SetPropertyValues(
				$product_id,
				MoySklad::CATALOG_IBLOCK_ID,
				false,
				self::COUNTRY_PROP_ID
			);
		}
	}
	
	// Функция синхронизирует свойства товара
	public function SetProductProperties($product_id, $props_arr){

		$iblockproperty = new CIBlockProperty;
		$iblockproperty_enum = new CIBlockPropertyEnum;
		$allow_prop_types_arr = array("long", "double", "string", "boolean", "customentity");
		$digits_types_arr = array("long", "double");
		$element_res = CIBlockElement::GetByID($product_id)->GetNextElement();
		$element_fields = $element_res->GetFields();
		$element_props = $element_res->GetProperties();
		foreach($props_arr as $prop){
            //формируем код свойства из названия. Макс. размер поля строки 50 символов в БД
            $prop_code = $this->RebuildPropCode(mb_strimwidth(Cutil::translit($prop["name"], 'ru'), 0, 47)); //Зачем-то заменили name на кривой id, вернул, только битрикс транслит метод
			//$prop_code = $this->RebuildPropCode($prop["id"]); //Заменен id на имя свойства 26.10.21
			//$prop_code = $this->RebuildPropCode($this->TranslitSef($prop["name"]));

			
			if((in_array($prop["type"],$digits_types_arr)) OR ($prop["type"] == "string")){
				if((isset($element_props[$prop_code])) AND ($element_props[$prop_code]["VALUE"] == $prop["value"])){
					// Если свойство у товара существует и значения одинаковы - ничего не делаем
				} else {
					//echo "<pre>";print_r($element_props);echo "</pre>";
					if(!isset($element_props[$prop_code])) {
						// Если свойства не существует - добавляем
						$arFields = Array(
							"NAME" => $prop["name"],
							"ACTIVE" => "Y",
							"SORT" => "10000",
							"CODE" => $prop_code,
							"IBLOCK_ID" => MoySklad::CATALOG_IBLOCK_ID,
							);
						if($prop["type"] == "string"){
							$arFields["PROPERTY_TYPE"] = "S";
						} else {
							$arFields["PROPERTY_TYPE"] = "N";
						}
						if($PropertyID = $iblockproperty->Add($arFields)){
							CIBlockSectionPropertyLink::Delete(0, $PropertyID);
							$this->syncProps[] = $prop_code;
						} else {
							echo 'Error 2: '.$iblockproperty->LAST_ERROR;
						}	
					} else {
						$PropertyID = $element_props[$prop_code]["ID"];
					}
					CIBlockSectionPropertyLink::Add($element_fields["IBLOCK_SECTION_ID"], $PropertyID, array('SMART_FILTER' => 'Y'));
					CIBlockElement::SetPropertyValues(
						$product_id,
						MoySklad::CATALOG_IBLOCK_ID,
						$prop["value"],
						$prop_code
					);
				}
				unset($element_props[$prop_code]);
			} elseif($prop["type"] == "boolean"){
				if((isset($element_props[$prop_code])) AND ($element_props[$prop_code]["VALUE"] == $prop["value"])){
					// Если свойство у товара существует и значения одинаковы - ничего не делаем
				} else {
					if(!isset($element_props[$prop_code])) {
						// Если свойства не существует - добавляем
						$arFields = Array(
							"NAME" => $prop["name"],
							"ACTIVE" => "Y",
							"SORT" => "10000",
							"CODE" => $prop_code,
							"IBLOCK_ID" => MoySklad::CATALOG_IBLOCK_ID,
							"PROPERTY_TYPE" => "L",
							"LIST_TYPE" => "C",
							"VALUES" => array(
								0 => array(
									"VALUE" => 1,
									"DEF" => "N",
									"SORT" => 100
								)
							),
						);
						if($PropertyID = $iblockproperty->Add($arFields)){
							CIBlockSectionPropertyLink::Delete(0, $PropertyID);
							$this->syncProps[] = $prop_code;
						} else {
							echo 'Error 3: '.$iblockproperty->LAST_ERROR;
						}	
					} else {
						$PropertyID = $element_props[$prop_code]["ID"];
					}
					CIBlockSectionPropertyLink::Add($element_fields["IBLOCK_SECTION_ID"], $PropertyID, array('SMART_FILTER' => 'Y'));
					if($prop["value"] > 0){
						$property_enums = CIBlockPropertyEnum::GetList(Array(), Array("PROPERTY_ID"=>$PropertyID));
						if($enum_fields = $property_enums->GetNext()){
							CIBlockElement::SetPropertyValues(
								$product_id,
								MoySklad::CATALOG_IBLOCK_ID,
								$enum_fields["ID"],
								$prop_code
							);
						}
					} else {
						CIBlockElement::SetPropertyValues(
							$product_id,
							MoySklad::CATALOG_IBLOCK_ID,
							false,
							$prop_code
						);
					}
				}
				unset($element_props[$prop_code]);
			} elseif($prop["type"] == "customentity"){
				// Тип свойства - список
				if((isset($element_props[$prop_code])) AND ($element_props[$prop_code]["VALUE"] == $prop["value"])){
					// Если свойство у товара существует и значения одинаковы - ничего не делаем
				} else {
					if(!isset($element_props[$prop_code])) {
						// Если свойства не существует - добавляем
						$arFields = Array(
							"NAME" => $prop["name"],
							"ACTIVE" => "Y",
							"SORT" => "10000",
							"CODE" => $prop_code,
							"IBLOCK_ID" => MoySklad::CATALOG_IBLOCK_ID,
							"PROPERTY_TYPE" => "L",
							"LIST_TYPE" => "L",
							"VALUES" => array(
								0 => array(
									"VALUE" => $prop["value"]["name"],
									"DEF" => "N",
									"SORT" => 100
								)
							),
						);
						if($PropertyID = $iblockproperty->Add($arFields)){
							CIBlockSectionPropertyLink::Delete(0, $PropertyID);
						} else {
							echo 'Error 4: '.$iblockproperty->LAST_ERROR;
						}
					} else {
						$PropertyID = $element_props[$prop_code]["ID"];
					}
					echo "Добавляется связь свойства ".$PropertyID." для раздела ".$element_fields["IBLOCK_SECTION_ID"]." Продукт ".$product_id."\n";

                        CIBlockSectionPropertyLink::Add($element_fields["IBLOCK_SECTION_ID"], $PropertyID, array('SMART_FILTER' => 'Y'));
                        if (!empty($prop["value"]["name"])) {
                            $property_enums = CIBlockPropertyEnum::GetList(array(), array("PROPERTY_ID" => $PropertyID));
                            $isset_fl = false;
                            while ($enum_fields = $property_enums->GetNext()) {
                                //Сравнивает без учета регистра и в обработанном функцией htmlspecialchars виде
                                $xml_prop_id = "p_" . CUtil::translit($prop["value"]["name"], 'ru', array("replace_space" => "_", "replace_other" => "_"));
                                if (strcasecmp($enum_fields["VALUE"], htmlspecialchars($prop["value"]["name"]))==0) {

                                    if ($xml_prop_id == $enum_fields["XML_ID"]) {
                                        CIBlockElement::SetPropertyValues(
                                            $product_id,
                                            MoySklad::CATALOG_IBLOCK_ID,
                                            $enum_fields["ID"],
                                            $prop_code
                                        );
                                        $isset_fl = true;
                                        break;
                                    }
                                }
                            }
                            // Если значение в списке не найдено - добавляем ( && $prop["value"]["name"]!='Power&Soul' && $prop["value"]["name"]!='1-1/2')
                            $enumProp = $iblockproperty_enum->GetList([], ["XML_ID"=>$xml_prop_id, 'PROPERTY_ID' => $PropertyID])->GetNext();
                            if (!$isset_fl && !$enumProp) {
                                //$EntityID = $iblockproperty_enum->Add(Array('PROPERTY_ID'=>$PropertyID, 'VALUE'=>$prop["value"]["name"]));

                                $EntityID = $iblockproperty_enum->Add(array('PROPERTY_ID' => $PropertyID, 'VALUE' => $prop["value"]["name"], 'XML_ID' => $xml_prop_id));

                                CIBlockElement::SetPropertyValues(
                                    $product_id,
                                    MoySklad::CATALOG_IBLOCK_ID,
                                    $EntityID,
                                    $prop_code
                                );
                            }
                        } else {
                            CIBlockElement::SetPropertyValues(
                                $product_id,
                                MoySklad::CATALOG_IBLOCK_ID,
                                false,
                                $prop_code
                            );
                        }

				}
				unset($element_props[$prop_code]);
			}
			if((in_array($prop["type"],$allow_prop_types_arr)) AND (!in_array($prop_code,$this->syncProps))){
				$PropRes = CIBlockProperty::GetList(Array(), Array("IBLOCK_ID"=>MoySklad::CATALOG_IBLOCK_ID, "CODE"=>$prop_code));
				if($PropInfo = $PropRes->GetNext()){
					// Синхронизация названий свойств
					if($PropInfo["NAME"] != $prop["name"]){
						$iblockproperty->Update($PropInfo['ID'], array("NAME"=>$prop["name"]));
					}
					// Синхронизация значений справочника
					if($prop["type"] == "customentity"){
						$metadata_arr = explode("/",$prop["value"]["meta"]["metadataHref"]);
						$metadata_id = $metadata_arr[count($metadata_arr)-1];
						$JSONurl = 'https://online.moysklad.ru/api/remap/1.1/entity/customentity/'.$metadata_id;
						$JSONcredentials = array('username' => self::USERNAME, 'password' => self::PASSWORD);
						$JSONarEntity = json_decode($this->getData($JSONurl, $JSONcredentials),true);
						$EnumFieldsRes = CIBlockPropertyEnum::GetList(array(),array("PROPERTY_ID"=>$PropInfo['ID']));
						while($EnumFields = $EnumFieldsRes->GetNext()){
							$isset_fl = false;
							foreach($JSONarEntity["rows"] as $key => $entity){
								if($EnumFields["VALUE"] == $entity["name"]){
									unset($JSONarEntity["rows"][$key]);
									$isset_fl = true;
									break;
								}
							}
							if(!$isset_fl){
								// Если значение списка не найдено в источнике - удаляем
								CIBlockPropertyEnum::Delete($EnumFields["ID"]);
							}
						}
						// Добавляем новые значения списка
						foreach($JSONarEntity["rows"] as $entity){
							if($PropID = $iblockproperty_enum->Update($PropInfo['ID'], Array('PROPERTY_ID'=>$PropInfo['ID'], 'VALUE'=>$entity["name"], 'XML_ID'=>"p_".CUtil::translit($entity["name"], 'ru')))){
								//echo 'New ID:'.$PropID;
							} else {
								//echo 'Error: '.$iblockproperty_enum->LAST_ERROR;
							}
						}
						$this->syncProps[] = $prop_code;
					}
				}
			}
		}
		// Очищаем значения свойств, которые не пришли из Моего Склада
		//echo "<pre>";var_dump($element_props);echo "</pre>";
		foreach($element_props as $prop){
			if((substr($prop["CODE"],0,3) === "ms_") AND (!empty($prop["VALUE"]))){
				CIBlockElement::SetPropertyValues(
					$product_id,
					MoySklad::CATALOG_IBLOCK_ID,
					false,
					$prop["CODE"]
				);
			}
		}
		//echo $product_id."<pre>";print_r($props_arr);echo "</pre>";
		//exit;
	}
	
	// Функция обновляет связи свойств с разделами
	public function UpdateSectionPropsLinks(){
		$SectionsRes = CIBlockSection::GetList(Array("left_margin"=>"asc"), array("IBLOCK_ID" => self::CATALOG_IBLOCK_ID));
		while($arSection = $SectionsRes->GetNext()){
			$SectionLinks = CIBlockSectionPropertyLink::GetArray(self::CATALOG_IBLOCK_ID, $arSection["ID"]);
			foreach($SectionLinks as $SectionLink){
				$PropertyRes = CIBlockProperty::GetByID($SectionLink["PROPERTY_ID"]);
				if($arProperty = $PropertyRes->GetNext()){
					if(substr($arProperty["CODE"],0,3) === "ms_"){
						$ElemCount = CIBlockElement::GetList(array(), array("SECTION_ID"=>$arSection["ID"], "!PROPERTY_".$arProperty["CODE"] => false), array());
						if($ElemCount <= 0){
							CIBlockSectionPropertyLink::Delete($arSection["ID"], $arProperty["ID"]);
						}
					}
				}
			}
		}
	}
	
public function TranslitSef($value){
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
	);
 
	$value = mb_strtolower($value);
	$value = strtr($value, $converter);
	$value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');	
 
	return $value;
}	
}