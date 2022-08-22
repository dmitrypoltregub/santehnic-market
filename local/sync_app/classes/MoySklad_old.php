<?php

use \CUtilEx as CUtil;

class MoySklad
{
	const API_URL = 'https://online.moysklad.ru/api/posap/1.0';

	const USERNAME = 'admin@kck007';
	const PASSWORD = 'sly9119';
	const TOKEN_LIFE_MINUTES = 5;

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
		$id = $arRetailStore['rows'][0]['id'];
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

		echo "<pre>";print_r($rows);echo "</pre>";
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
			$arSection = $this->findSectionByName($arFolder['name']);

			if(!empty($arSection))
			{
				// раздел присутствует в каталоге
				// проверяем его внешний код. еслу нужно - обновляем его
				$this->checkExternalId($bs, $arSection, $arFolder['id']);

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

	public function syncCatalogProducts()
	{
		$logFileTimes = $_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/syncCatalogProducts_times.log';
		file_put_contents($logFileTimes, 'syncCatalogProducts::BEGIN - ' . date('d.m.Y H:i:s') . "\r\n", FILE_APPEND | LOCK_EX);

		// получаем список товаров
		$arProducts = $this->getProducts();
		file_put_contents($_SERVER['DOCUMENT_ROOT'] .  '/local/sync_app/logs/products.log', var_export($arProducts, true), LOCK_EX);

		$el = new CIBlockElement;

		foreach ($arProducts as $arProduct)
		{
			// проверяем есть ли такой товар к каталоге
			$arInfo = $this->findProductByExtCode($arProduct['id']);

			if($arInfo !== false)
			{
				// товар найден. обновляем его
				$this->updateProduct($el, $arProduct, $arInfo);
			}
			else
			{
				// товар не найден. создаем....
				$this->createProduct($el, $arProduct);

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

		file_put_contents($logFileTimes, 'syncCatalogProducts::END - ' . date('d.m.Y H:i:s') . "\r\n\r\n", FILE_APPEND | LOCK_EX);
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

	private function updateProduct(&$el, $arItem = array(), $arInfo = array())
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
		 *
		 * обновлем
		 * - остаток
		 * - цену
		 *
		 */

		$codeParams = array("replace_space"=>"_","replace_other"=>"_");

		//получем информацию по разделу
		$arSection = $this->getSectionInfo($arItem['productFolder']);

//		pr($arSection);

		$arFields = array(
			"MODIFIED_BY"       => 1,
//			"IBLOCK_SECTION_ID" => $this->sectionInfo['ID'],
			"IBLOCK_SECTION_ID" => ($arSection!==false ? $arSection['ID'] : false),
			"NAME"              => $arItem['name'],
//			"IBLOCK_ID"         => $this->catalogIblockId,
//			"ACTIVE"            => "Y",
//			"CODE"              => Cutil::translit($arItem['name'].'_'.$arItem['article'],"ru",$codeParams),
//			'DETAIL_PICTURE'    => $detailPicture,
//			'PREVIEW_PICTURE'   => $detailPicture,
//			"EXTERNAL_ID"       => $arItem['id'],
//			"PROPERTY_VALUES"   => $arPropEl,
		);

		if($el->Update($arInfo['ID'], $arFields))
		{
			// обновляем артикул
			$arProps = array('ARTICUL' => $arItem['article'],);
			CIBlockElement::SetPropertyValuesEx($arInfo['ID'], $this->catalogIblockId, $arProps);


			// обновляем остаток товара
			$arFields = array('QUANTITY' => $arItem['stock'], "PURCHASING_PRICE" => $this->getPrice($arItem['buyPrice']));
			CCatalogProduct::Update($arInfo['ID'], $arFields);


			// обновляем цену
			$arFields = Array(
				"PRODUCT_ID" => $arInfo['ID'],
				"CATALOG_GROUP_ID" => 1,
				"PRICE" => $this->getPrice($arItem['salePrices']),
//				"PRICE" => 79,
				"CURRENCY" => 'RUB'
			);

			echo $arItem['name']." Цена: <pre>";print_r($arItem);echo "<pre>";print_r($arFields);echo "</pre>";
			
			$res = CPrice::GetList(array(),array("PRODUCT_ID" => $arInfo['ID'],"CATALOG_GROUP_ID" => 1));

			if ($arr = $res->Fetch())
			{
				CPrice::Update($arr["ID"], $arFields);
			}
			else
			{
				CPrice::Add($arFields);
			}
		}

//		die('update');
	}

	private function createProduct(&$el, $arItem = array())
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


		$arPropEl = array('ARTICUL' => $arItem['article']);

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
			$res = CCatalogProduct::add(array("ID" => $PRODUCT_ID, "QUANTITY" => $arItem['stock']));

//			var_dump($productID);

			$arFields = Array(
				"CURRENCY"         => "RUB",       // валюта
				"PRICE"            => $this->getPrice($arItem['salePrices']),      // значение цены
				"CATALOG_GROUP_ID" => 1,           // ID типа цены
				"PRODUCT_ID"       => $PRODUCT_ID,  // ID товара
			);

//			pr($arFields);//die();


			$res = CPrice::Add($arFields);
//			var_dump($res);
		}
		else
		{
			echo " Error: ".$el->LAST_ERROR . "\r\n";
//			file_put_contents($logFile, 'Ошибка создания нового товара ' . "\r\n", FILE_APPEND | LOCK_EX);
//			file_put_contents($logFile, $arItem['OLD_ID']." Error: ".$el->LAST_ERROR . "\r\n", FILE_APPEND | LOCK_EX);
		}
//		pr($arItem);die();
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
			if ($price['priceType'] == 'Опт')
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
}