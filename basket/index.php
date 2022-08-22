<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Корзина");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
	array(
		"ACTION_VARIABLE" => "action",
		"AUTO_CALCULATION" => "Y",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "PRICE",
			2 => "QUANTITY",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"GIFTS_CONVERT_CURRENCY" => "Y",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PLACE" => "BOTTOM",
		"HIDE_COUPON" => "Y",
		"PATH_TO_ORDER" => "/order/",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"USE_PREPAYMENT" => "N",
		"DEFERRED_REFRESH" => "N",
		"USE_DYNAMIC_SCROLL" => "Y",
		"SHOW_FILTER" => "N",
		"SHOW_RESTORE" => "Y",
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DELETE",
			2 => "SUM",
		),
		"COLUMNS_LIST_MOBILE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DELETE",
			2 => "SUM",
		),
		"TEMPLATE_THEME" => "blue",
		"TOTAL_BLOCK_DISPLAY" => array(
			0 => "top",
		),
		"DISPLAY_MODE" => "extended",
		"PRICE_DISPLAY_MODE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"USE_PRICE_ANIMATION" => "Y",
		"LABEL_PROP" => array(
		),
		"CORRECT_RATIO" => "Y",
		"COMPATIBLE_MODE" => "Y",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_18" => "-",
		"ADDITIONAL_PICT_PROP_22" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"USE_GIFTS" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N"
	),
	false
);?>
<?/*$APPLICATION->IncludeComponent(
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
);*/?>
    
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>