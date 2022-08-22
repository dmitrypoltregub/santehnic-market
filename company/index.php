<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("О компании");
?>


<div class="banner">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/about/image.php", Array(), Array("MODE" => "html")); ?>
</div>
<div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/about/detail_text.php", Array(), Array("MODE" => "html")); ?>
</div>


<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>