<? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SECTION_SHOW_SIDEBAR'] == "Y"): ?>
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
    
    <? if($isFilter && $arParams['FILTER_VIEW_MODE'] == 'vertical'):?>
    <div class="smart-filter vertical">
                    <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:catalog.smart.filter", "main", array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "Y",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                            ), $component, array('HIDE_ICONS' => 'Y')
                    );
                    ?>
    </div>
            <? endif; ?>
    
    <? if (in_array(\Nextype\Corporate\CCorporate::$options['SIDEBAR_TYPE'], Array('FULL', 'ASK'))): ?>
    <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/sidebar_ask.php", Array(), Array("MODE" => "html"));?>
    <? endif; ?>
    
</aside>
<? endif; ?>