<?php
/**
 * /usr/bin/php ~/santehnic-market.ru/public_html/local/sync_app/app.php -t syncProducts
 * консоль
 * php local/sync_app/app.php -t syncSections
 *
 *
 * браузер
 * /local/sync_app/app.php?t=syncSections
 *
 * /local/sync_app/app.php?t=syncProducts
 * /local/sync_app/app.php -t syncProducts
 *
 * синхронизация внешних кодов в каталоге
 * /local/sync_app/app.php?t=syncExtCodes
 *
 */
//var_dump($_SERVER['DOCUMENT_ROOT']);

if($_SERVER['DOCUMENT_ROOT'] == '')
{
	// запуск из командной строки
	$DOCUMENT_ROOT = realpath(dirname(__FILE__)."/../.." );
	$_SERVER["DOCUMENT_ROOT"] = $DOCUMENT_ROOT;

	$shortopts  = "";
	$shortopts .= "t:";
//$shortopts .= "m:";

	$options = getopt($shortopts);

}
else
{
	// запуск из браузера
	$t = isset($_GET['t']) ? $_GET['t'] : '';
	if($t != '') {
		$options['t'] = $t;
	}
	else
	{
		$options = array();
	}
}

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);

require($_SERVER[ "DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

require_once  $_SERVER[ "DOCUMENT_ROOT"]. '/local/sync_app/classes/MoySklad.php';
require_once  $_SERVER[ "DOCUMENT_ROOT"]. '/local/sync_app/classes/SimpleImage.php';


if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")) { echo "failure"; return;}



//var_dump($options['t']);

if(isset($options['t']))
{
	$moySklad = new MoySklad();
	$moySklad->catalogIblockId = 11;
	$moySklad->saveImagePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/moi-sklad-files/';


	// получаем токен для работы
	$moySklad->token = $moySklad->getToken();
	$moySklad->tokenExpire = time() + 60 * $moySklad::TOKEN_LIFE_MINUTES;
	var_dump($moySklad->token);
	
//	switch ($options['t'])
//	{
//		case 'syncSections':
//			$moySklad->syncCatalogSections();
//			break;
//
//		case 'syncProducts':
//			$moySklad->syncCatalogProducts();
//			break;
//
//		case 'syncExtCodes':
//			$moySklad->syncCatalogProductsExtCodes();
//			break;
//
//	}
}

//var_dump($_GET);
//pr($arFolders);
//pr($DOCUMENT_ROOT);
echo "done \n";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

