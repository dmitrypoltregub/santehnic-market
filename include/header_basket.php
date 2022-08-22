<?
$arResult = Nextype\Corporate\CBasket::getList();
?>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line","",Array(
        "HIDE_ON_BASKET_PAGES" => "Y",
        "PATH_TO_BASKET" => SITE_DIR."basket/",
        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
        "PATH_TO_PROFILE" => SITE_DIR."personal/",
        "PATH_TO_REGISTER" => SITE_DIR."login/",
        "POSITION_FIXED" => "Y",
        "POSITION_HORIZONTAL" => "right",
        "POSITION_VERTICAL" => "top",
        "SHOW_AUTHOR" => "Y",
        "SHOW_DELAY" => "N",
        "SHOW_EMPTY_VALUES" => "Y",
        "SHOW_IMAGE" => "Y",
        "SHOW_NOTAVAIL" => "N",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_PERSONAL_LINK" => "N",
        "SHOW_PRICE" => "Y",
        "SHOW_PRODUCTS" => "Y",
        "SHOW_SUMMARY" => "Y",
        "SHOW_TOTAL_PRICE" => "Y"
    )
);?>
<!--
<a href="<?=SITE_DIR?>basket/" class="basket">
    <div class="icon-cart"></div>
    <div class="name"><?=GetMessage('BASKET_BUTTON_TEXT')?></div>
    <div class="counter"><span><?=$arResult['CNT']?></span></div>
</a>
-->