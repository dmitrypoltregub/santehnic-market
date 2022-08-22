<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Сотрудники");
?>


<div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/employees/detail_text.php", Array(), Array("MODE" => "html")); ?>

</div>

<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/employees/employees.php", Array(), Array("MODE" => "html")); ?>


<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>