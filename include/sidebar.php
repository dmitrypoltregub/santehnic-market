<aside class="side-bar <?= strtolower(\Nextype\Corporate\CCorporate::$options['SIDEBAR_TYPE'])?>">
    <? if (in_array(\Nextype\Corporate\CCorporate::$options['SIDEBAR_TYPE'], Array('FULL', 'MENU'))): ?>
    <?
    $APPLICATION->IncludeComponent(
            "bitrix:menu", "left", Array(
        "ROOT_MENU_TYPE" => "catalog_left",
        "MAX_LEVEL" => "4",
        "CHILD_MENU_TYPE" => "catalog_left",
        "USE_EXT" => "Y",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS" => ""
            )
    );
    ?>
    <? endif; ?>
    
    <? if (in_array(\Nextype\Corporate\CCorporate::$options['SIDEBAR_TYPE'], Array('FULL', 'ASK'))): ?>
    <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/sidebar_ask.php", Array(), Array("MODE" => "html"));?>
    <? endif; ?>
    
</aside>