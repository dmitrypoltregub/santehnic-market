<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    die();

$aMenuLinksExt = $APPLICATION->IncludeComponent(
   "bitrix:menu.sections",
   "",
   Array(
       "IS_SEF" => "Y",
        "SEF_BASE_URL" => "",
        "SECTION_PAGE_URL" => "/projects/#SECTION_CODE#/",
        "DETAIL_PAGE_URL" => "/projects/#SECTION_CODE#/#ELEMENT_ID#",
      "IBLOCK_TYPE" => "nt_corporate_catalog", 
      "IBLOCK_ID" => \Nextype\Corporate\COptions::getIblockID('projects'), 
      "CACHE_TIME" => "3600000" 
   )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);