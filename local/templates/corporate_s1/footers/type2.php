<footer class="footer light">
	<div class="container">
		<div class="top">
			<div class="subscribe">
                            <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_subscribe.php", Array(), Array("MODE" => "html"));?>
			</div>
            <div class="social color">
                <? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/socials_groups.php");?>
            </div>
		</div>
		<div class="bottom">
			<div class="contacts">
				<div class="tel icon"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_phone.php", Array(), Array("MODE" => "html"));?></div>
				<div class="location icon"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_address.php", Array(), Array("MODE" => "html"));?></div>
				<div class="email icon-custom"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_email.php", Array(), Array("MODE" => "html"));?></div>
			</div>
            <div class="menu-container">
			<div class="menu">
				<div class="parent"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_menu_title1.php", Array(), Array("MODE" => "html"));?></div>
				
                                <?
                                $APPLICATION->IncludeComponent(
                                        "bitrix:menu", "footer", Array(
                                    "ROOT_MENU_TYPE" => "footer_1",
                                    "MAX_LEVEL" => "1",
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
                                
                                
			</div>
			<div class="menu">
				<div class="parent"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_menu_title2.php", Array(), Array("MODE" => "html"));?></div>
				
                                <?
                                $APPLICATION->IncludeComponent(
                                        "bitrix:menu", "footer", Array(
                                    "ROOT_MENU_TYPE" => "footer_2",
                                    "MAX_LEVEL" => "1",
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
			</div>
            </div>
			<div class="copyright">
				<div class="name"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_copyright1.php", Array(), Array("MODE" => "html"));?></div>
				<div class="right"><?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/footer_copyright2.php", Array(), Array("MODE" => "html"));?></div>
			</div>
		</div>
	</div>
</footer>