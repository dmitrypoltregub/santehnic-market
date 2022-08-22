<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Контакты");
?>

<main class="contacts">
	<div class="container">
			<div class="info">
				<div class="item icon-custom phone">
					<div class="content">
						<div class="name">Единый телефон</div>
						<div class="text tel">
                                                    <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/company/contacts/phone.php", Array(), Array("MODE" => "html"));?>
                                                    
                                                </div>
					</div>
				</div>
				<div class="item icon-custom location">
					<div class="content">
						<div class="name">Адрес офиса</div>
                                                
						<div class="text">
                                                    <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/company/contacts/address.php", Array(), Array("MODE" => "html"));?>
                                                </div>
					</div>
				</div>
				<div class="item icon-custom open-mail">
					<div class="content">
						<div class="name">E-mail</div>
                                                
						<div class="text email">
                                                    <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/company/contacts/email.php", Array(), Array("MODE" => "html"));?>
                                                    
                                                </div>
					</div>
				</div>
				<div class="item icon-custom time">
					<div class="content">
						<div class="name">Режим работы</div>
                                                
						<div class="text">
                                                    <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/company/contacts/worktime.php", Array(), Array("MODE" => "html"));?>
                                                    
                                                </div>
					</div>
				</div>
			</div>
			<div class="map">
                            <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/company/contacts/map.php", Array(), Array("MODE" => "html"));?>
			</div>
            
                        <?\Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR."include/company/contacts/feedback.php", Array(), Array("MODE" => "html"));?>
            
			
	</div>
</main>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>