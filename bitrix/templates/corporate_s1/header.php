<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    die();

$CCorporate = \Nextype\Corporate\CCorporate::getInstance(SITE_ID);
$MESS['CURRENT_PAGE'] = $APPLICATION->GetCurPage();
?>
<?
$CCorporate::start();
$headerType = \Nextype\Corporate\CCorporate::$options['HEADER_TYPE'];
$useBasket = (\Nextype\Corporate\CCorporate::$options['USE_BASKET'] == "N") ? ' disabled-basket' : '';
$hidePrices = (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_PRICE'] == "N") ? ' hide-prices' : '';
$longNames = (\Nextype\Corporate\CCorporate::$options['CATALOG_SHORT_NAMES'] == "N") ? ' long-names' : '';
CJSCore::Init(array('ajax', 'window'));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <? $APPLICATION->ShowMeta("viewport"); ?>
        <title><? $APPLICATION->ShowTitle() ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                <meta name="format-detection" content="telephone=no">
                    <? $APPLICATION->ShowHead(); ?>
                    <? $APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject($MESS, false) . ')</script>', true); ?>
                    </head>
                    <body class="header-<?=$headerType.$useBasket.$hidePrices.$longNames?>">
                        
                        <? $APPLICATION->IncludeComponent("nextype:corporate.options", ".default", array(), false, array("HIDE_ICONS"=>"Y")); ?>
                        <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
                        <div class="wrapper">
                        
                            <?
                            if (!empty($headerType) && file_exists(__DIR__ . "/headers/" . $headerType . ".php"))
                                include(__DIR__ . "/headers/" . $headerType . ".php");
                            else
                                include(__DIR__ . "/headers/type1.php");
                            ?>
                           
               <? if ($APPLICATION->GetCurDir() != SITE_DIR): ?>         
<div class="breadcrumbs">
	<div class="container">
		<?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/breadcrumbs.php", Array(), Array("MODE" => "html"));?>
		<h1 class="title"><? $APPLICATION->ShowTitle(false) ?></h1>
	</div>
</div>
                            <? endif; ?>

<? if (!\Nextype\Corporate\CCorporate::isCustomPage()): ?>
<div class="about">
	<div class="container">
	
                <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/sidebar.php", Array(), Array("MODE" => "html"));?>

            <main class="content">
<? endif; ?>