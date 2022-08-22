<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Реквизиты");
?>

<div class="about">
    <div class="text">
        <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/requisites/detail_text.php", Array(), Array("MODE" => "html")); ?>
    </div>
    <div class="requisites">
        <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/requisites/requisites.php", Array(), Array("MODE" => "html")); ?>

        <div class="documents">
            <div class="doc icon-custom file">
                <? \Nextype\Corporate\CCorporate::IncludeFile(SITE_DIR . "include/company/requisites/download.php", Array(), Array("MODE" => "html")); ?>
            </div>
        </div>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>