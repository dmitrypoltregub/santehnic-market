<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Вакансии");
?>


<div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/vacancies/detail_text.php", Array(), Array("MODE" => "html")); ?>

</div>

<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/vacancies/vacancies.php", Array(), Array("MODE" => "html")); ?>



<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>