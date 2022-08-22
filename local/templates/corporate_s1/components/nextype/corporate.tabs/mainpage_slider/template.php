<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<? if (!empty($arResult['TABS'])): ?>
<div class="slider">
	<div class="container">
		<div class="tabs">
                    <? foreach ($arResult['TABS'] as $key => $arTab): ?>
			<a href="javascript:void(0);" onclick="CCorporate.openCatalogTab(this, '<?=$arTab['HTML_ID']?>');" class="tab<?=$key==0?' active':''?>"><?=$arTab['TITLE']?></a>
                    <? endforeach; ?>
		</div>
		<div class="tabs-content">
                    <? foreach ($arResult['TABS'] as $key => $arTab): ?>
                        <? $GLOBALS[$arParams['FILTER_NAME']] = Array(); ?>
                        <? foreach ($arTab['VALUES'] as $arValue) 
                            $GLOBALS[$arParams['FILTER_NAME']]['ID'][] = $arValue['ID'];
                        
                        ?>
                    <div class="tab-content<?= $key == 0 ? ' active' : '' ?>" id="<?= $arTab['HTML_ID'] ?>">
                        <?
                        $intSectionID = $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section", "slider", array(
                                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                    "ADD_PICT_PROP" => $arParams["ADD_PICT_PROP"],
                                    "ADD_PROPERTIES_TO_BASKET" => $arParams["ADD_PROPERTIES_TO_BASKET"],
                                    "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                                    "AJAX_MODE" => $arParams["AJAX_MODE"],
                                    "AJAX_OPTION_ADDITIONAL" => $arParams["AJAX_OPTION_ADDITIONAL"],
                                    "AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
                                    "AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
                                    "AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
                                    "BACKGROUND_IMAGE" => $arParams["BACKGROUND_IMAGE"],
                                    "BASKET_URL" => $arParams["BASKET_URL"],
                                    "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
                                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "COMPATIBLE_MODE" => $arParams["COMPATIBLE_MODE"],
                                    "DETAIL_URL" => $arParams["DETAIL_URL"],
                                    "DISABLE_INIT_JS_IN_COMPONENT" => $arParams["DISABLE_INIT_JS_IN_COMPONENT"],
                                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                                    "DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
                                    "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                                    "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                    "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                    "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                    "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                    "ENLARGE_PRODUCT" => $arParams["ENLARGE_PRODUCT"],
                                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                                    "LABEL_PROP" => $arParams["LABEL_PROP"],
                                    "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                                    "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                                    "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],
                                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                                    "MESS_BTN_ADD_TO_BASKET" => $arParams["MESS_BTN_ADD_TO_BASKET"],
                                    "MESS_BTN_BUY" => $arParams["MESS_BTN_BUY"],
                                    "MESS_BTN_DETAIL" => $arParams["MESS_BTN_DETAIL"],
                                    "MESS_BTN_SUBSCRIBE" => $arParams["MESS_BTN_SUBSCRIBE"],
                                    "MESS_NOT_AVAILABLE" => $arParams["MESS_NOT_AVAILABLE"],
                                    "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
                                    "META_KEYWORDS" => $arParams["META_KEYWORDS"],
                                    "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
                                    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                    "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                                    "PARTIAL_PRODUCT_PROPERTIES" => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
                                    "PRICE_CODE" => $arParams["PRICE_CODE"],
                                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                    "PRODUCT_BLOCKS_ORDER" => $arParams["PRODUCT_BLOCKS_ORDER"],
                                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                    "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                    "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                    "PRODUCT_ROW_VARIANTS" => $arParams["PRODUCT_ROW_VARIANTS"],
                                    "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
                                    "PROPERTY_CODE_MOBILE" => $arParams["PROPERTY_CODE_MOBILE"],
                                    "RCM_PROD_ID" => $arParams["RCM_PROD_ID"],
                                    "RCM_TYPE" => $arParams["RCM_TYPE"],
                                    "SECTION_CODE" => $arParams["SECTION_CODE"],
                                    "SECTION_ID" => $arParams["SECTION_ID"],
                                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                    "SECTION_URL" => $arParams["SECTION_URL"],
                                    "SECTION_USER_FIELDS" => $arParams["SECTION_USER_FIELDS"],
                                    "SEF_MODE" => $arParams["SEF_MODE"],
                                    "SET_BROWSER_TITLE" => $arParams["SET_BROWSER_TITLE"],
                                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                    "SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
                                    "SET_META_KEYWORDS" => $arParams["SET_META_KEYWORDS"],
                                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                    "SET_TITLE" => $arParams["SET_TITLE"],
                                    "SHOW_404" => $arParams["SHOW_404"],
                                    "SHOW_ALL_WO_SECTION" => $arParams["SHOW_ALL_WO_SECTION"],
                                    "SHOW_FROM_SECTION" => $arParams["SHOW_FROM_SECTION"],
                                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                    "SHOW_SLIDER" => $arParams["SHOW_SLIDER"],
                                    "SLIDER_INTERVAL" => $arParams["SLIDER_INTERVAL"],
                                    "SLIDER_PROGRESS" => $arParams["SLIDER_PROGRESS"],
                                    "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                    "USE_ENHANCED_ECOMMERCE" => $arParams["USE_ENHANCED_ECOMMERCE"],
                                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                    "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                                    "DISPLAY_IN_STOCK" => $arParams["DISPLAY_IN_STOCK"],
                                ), $component
                        );
                        ?>
                    </div>
			<? endforeach; ?>
			
		</div>
	</div>
</div>
<? endif; ?>


