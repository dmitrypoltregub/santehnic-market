<header class="header">
    <div class="info">
        <div class="container">
            <? if (\Nextype\Corporate\CCorporate::$options['LOCATIONS'] != "Y"): ?>
                <div class="item icon location">
                    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/header_address.php", Array(), Array("MODE" => "html")); ?>
                </div>
            <? else: ?>
                <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/header_locations.php", Array(), Array("MODE" => "html")); ?>
            <? endif; ?>
            <div class="item icon-custom email">
                <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/header_email.php", Array(), Array("MODE" => "html")); ?>
            </div>
            <div class="item icon-custom ask"><a href="javascript:void(0);" class="ask-popup-btn"><?= GetMessage('ASK_BUTTON_TEXT') ?></a></div>
            <div class="social">
                <? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/socials_groups.php"); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="logo">
            <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/header_logo.php", Array(), Array("MODE" => "html")); ?>
            </div>

            <div class="slogan">
                <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/header_slogan.php", Array(), Array("MODE" => "html")); ?>

            </div>
            <div class="tel icon">
                <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/header_phone.php", Array(), Array("MODE" => "html")); ?>
                <? if (\Nextype\Corporate\CCorporate::$options['HEADER_CALLBACK'] == "Y"): ?>
                <a href="javascript:void(0);" class="callback-popup-btn call-me"><?= GetMessage('CALLBACK_BUTTON_TEXT') ?></a>
                <? endif; ?>
            </div>
            
            <? if (\Nextype\Corporate\CCorporate::$options['USE_BASKET'] == "Y"): ?>
            <div id="header-basket" class="basket-container">
                <? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/header_basket.php"); ?>
            </div>
            <? endif; ?>
        </div>
    </div>


    <?
    $APPLICATION->IncludeComponent(
            "bitrix:menu", "top", Array(
        "ROOT_MENU_TYPE" => "top",
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "left",
        "USE_EXT" => "Y",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS" => ""
            )
    );
    ?>

    <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SEARCH'] == "Y"): ?>
    <? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/search_line.php"); ?>
    <? endif; ?>
    
</header>