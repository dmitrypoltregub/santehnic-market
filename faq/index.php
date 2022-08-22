<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Вопрос-ответ");
?>

<div class="faq">
	<div class="container">
		<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/sidebar.php", Array(), Array("MODE" => "html")); ?>
            <main class="content">
                <div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/faq/detail_text.php", Array(), Array("MODE" => "html")); ?>

</div>

<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/faq/faq.php", Array(), Array("MODE" => "html")); ?>
                
                <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/faq/help_form.php", Array(), Array("MODE" => "html")); ?>
            </main>
        </div>
</div>
    


    <?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>