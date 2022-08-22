<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Документы");
?>


<div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/docs/detail_text.php", Array(), Array("MODE" => "html")); ?>

</div>

<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/docs/documents.php", Array(), Array("MODE" => "html")); ?>



<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>