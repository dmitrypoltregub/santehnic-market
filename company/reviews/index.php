<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Отзывы клиентов");
?>


<div class="text">
    <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/reviews/detail_text.php", Array(), Array("MODE" => "html")); ?>

</div>

<? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/reviews/reviews.php", Array(), Array("MODE" => "html")); ?>



<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>