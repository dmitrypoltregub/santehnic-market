<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Синхронизация");

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");


echo '<pre>';
$arSelect = Array("ID");
$arFilter = Array("IBLOCK_ID"=>9);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>300), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 	if(CIBlockElement::Delete($arFields['ID'])){
		//echo $arFields['ID']. '- удален<br/>';
	}else{
		echo $arFields['ID']. ' - N<br/>';
	}
 //print_r($arFields['ID']);
}