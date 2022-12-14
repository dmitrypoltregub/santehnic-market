<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Оформление заказа");
?>

    <?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"origin",
	array(
		"ADDITIONAL_PICT_PROP_8" => "-",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "Y",
		"ALLOW_USER_PROFILES" => "Y",
		"BASKET_IMAGES_SCALING" => "standard",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "Y",
		"DELIVERIES_PER_PAGE" => "8",
		"DELIVERY_FADE_EXTRA_SERVICES" => "Y",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"MESS_DELIVERY_CALC_ERROR_TEXT" => "Вы можете продолжить оформление заказа, а чуть позже менеджер магазина  свяжется с вами и уточнит информацию по доставке.",
		"MESS_DELIVERY_CALC_ERROR_TITLE" => "Не удалось рассчитать стоимость доставки.",
		"MESS_FAIL_PRELOAD_TEXT" => "",
		"MESS_SUCCESS_PRELOAD_TEXT" => "",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "basket.php",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "8",
		"PICKUPS_PER_PAGE" => "5",
		"PRODUCT_COLUMNS_HIDDEN" => array(
			0 => "PROPERTY_MATERIAL",
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"PROPS_FADE_LIST_1" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "7",
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "standard",
		"SET_TITLE" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",
		"SHOW_VAT_PRICE" => "Y",
		"SKIP_USELESS_BLOCK" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "blue",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"ALLOW_APPEND_ORDER" => "Y",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"USE_PRELOAD" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"PICKUP_MAP_TYPE" => "yandex",
		"PROPS_FADE_LIST_2" => array(
			0 => "8",
			1 => "9",
			2 => "10",
			3 => "12",
			4 => "13",
			5 => "14",
			6 => "19",
		),
		"ACTION_VARIABLE" => "soa-action",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"USE_PHONE_NORMALIZATION" => "Y",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_18" => "-",
		"ADDITIONAL_PICT_PROP_22" => "-",
		"HIDE_ORDER_DESCRIPTION" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"MESS_PAY_SYSTEM_PAYABLE_ERROR" => "Вы сможете оплатить заказ после того, как менеджер проверит наличие полного комплекта товаров на складе. Сразу после проверки вы получите письмо с инструкциями по оплате. Оплатить заказ можно будет в персональном разделе сайта."
	),
	false
);?>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>