<?php
@define("ERROR_404","Y");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
CHTTP::SetStatus("404 Not Found");
$APPLICATION->SetTitle("Страница не найдена");
?>
<div class="error-404">
    <div class="number">
        404
    </div>
    <div class="text">Такой страницы нет</div>
    <a href="<?=SITE_DIR?>" class="btn color">Перейти на главную страницу</a>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>