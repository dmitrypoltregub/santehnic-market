<?php
/**
 * /usr/bin/php ~/santehnic-market.ru/public_html/local/sync_app/app.php -t syncProducts
 * /usr/bin/php ~/santehnic-market.ru/public_html/local/sync_app/app.php -t syncSections
 * /usr/bin/php ~/santehnic-market.ru/public_html/local/sync_app/app.php -t syncExtCodes
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

if($_SERVER['DOCUMENT_ROOT'] == '')
{
	// запуск из командной строки
	$DOCUMENT_ROOT = realpath(dirname(__FILE__)."/../.." );
	$_SERVER["DOCUMENT_ROOT"] = $DOCUMENT_ROOT;

	$shortopts  = "";
	$shortopts .= "t:";

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
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/sync_app/logs/main.log");
set_time_limit(0);

require($_SERVER[ "DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

require_once  $_SERVER[ "DOCUMENT_ROOT"]. '/local/sync_app/classes/MoySklad.php';
require_once  $_SERVER[ "DOCUMENT_ROOT"]. '/local/sync_app/classes/CUtilEx.php';
require_once  $_SERVER[ "DOCUMENT_ROOT"]. '/local/sync_app/classes/SimpleImage.php';


if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")) { echo "failure"; return;}

if(isset($options['t']))
{
    echo 'moysklad ';
	$moySklad = new MoySklad();
	$moySklad->catalogIblockId = 22;
	$moySklad->saveImagePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/moi-sklad-files/';
	$moySklad->startTime = time() - 15; // -15 секунд нужно для того, чтобы при быстром апдейте ничего лишнего не удалилось

	// получаем токен для работы
	$moySklad->token = $moySklad->getToken();
	$moySklad->tokenExpire = time() + 60 * $moySklad::TOKEN_LIFE_MINUTES;

	switch ($options['t'])
	{
		case 'syncSections':
            echo 'syncSections - processing...';
			$moySklad->syncCatalogSections();
			break;

		case 'syncProducts':
			$moySklad->syncCatalogProducts();
			break;

        case 'syncProductsFull':
            $moySklad->syncCatalogProducts(true);
            break;

		case 'syncExtCodes':
			$moySklad->syncCatalogProductsExtCodes();
			break;
	}

	global $CACHE_MANAGER;

	$CACHE_MANAGER->ClearByTag("iblock_id_".$moySklad->catalogIblockId);
}

//echo "done \n";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

