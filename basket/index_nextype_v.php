<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Оформление заказа");
?>

<?$APPLICATION->IncludeComponent(
	"nextype:corporate.basket",
	"main",
Array()
);?>

 <?$APPLICATION->IncludeComponent(
	"nextype:corporate.order",
	"main",
	array(
		"COMPONENT_TEMPLATE" => "main",
		"IBLOCK_TYPE" => "nt_corporate_orders",
		"IBLOCK_ID" => \Nextype\Corporate\COptions::getIblockID('orders'),
		"PROPERTY_CODE" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "EMAIL",
			3 => "DELIVERY",
			4 => "PAYMENT",
			5 => "COMMENT",
		),
		"PROPERTY_PRODUCTS_CODE" => "SYSTEM_PRODUCTS",
		"USE_AGREEMENT_FIELD" => "Y"
	),
	false
);?>

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>