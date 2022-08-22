<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<style>
    <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_QTY'] != "Y"): ?>
    #catalog-quantity-selector {display: none;}
    <? endif; ?>
    <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_SHARED'] != "Y"): ?>
    #catalog-share {display: none;}
    <? endif; ?>
    <? if (\Nextype\Corporate\CCorporate::$options['USE_BASKET'] != "Y"): ?>
    #catalog-disabled-basket {display: block; } #catalog-use-basket {display: none;}
    <? else: ?>
    #catalog-disabled-basket {display: none; } #catalog-use-basket {display: block;}
    <? endif; ?>
</style>
<? if (\Nextype\Corporate\CCorporate::$options['USE_BASKET'] != "Y"): ?>
<script>
    jqmPopup('order-button', 'include/ajax/forms/order.php?PRODUCT=<?=urlencode($arResult['NAME'])?>');
</script>
<?endif;?>