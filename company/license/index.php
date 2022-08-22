<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Лицензии и сертификаты");
?>


<div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/license/detail_text.php", Array(), Array("MODE" => "html")); ?>

</div>

<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/license/licenses.php", Array(), Array("MODE" => "html")); ?>



<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>