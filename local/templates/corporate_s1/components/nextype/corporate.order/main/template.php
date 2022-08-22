<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if ($arResult['BASKET']['CNT'] == 0 && empty($arResult['ORDER_ID'])) return;
?>

<div class="order-full">
    <div class="title">
        <?=GetMessage('H_TITLE')?>
    </div>
    
    <? if (!empty($arResult['ORDER_ID'])): ?>
            <? include(__DIR__ . "/confirm.php"); ?>
        <? else: ?>
        <? if (!empty($arResult['ERRORS'])): ?>
        <div class="error-message">
            <?=implode("<br/>", $arResult['ERRORS'])?>
        </div>
        <? endif; ?>
    
    <div class="order-form">
       
        <div class="fields">
            <form method="post" id="order_form">
            <? include(__DIR__ . "/fields.php"); ?>
                <div class="actions">
                    <button type="submit" id="form_submit" class="btn color"><?=GetMessage('B_FORM_SUBMIT_TITLE')?></button>
                </div>
                <input type="hidden" name="SAVE_ORDER" value="Y" />
                <?=bitrix_sessid_post()?>
            </form>
        </div>
        <div class="desc">
            <?=GetMessage('B_FORM_DESC')?>
        </div>
        <? endif; ?>
    </div>
</div>

<script type="text/javascript">
<? if (!empty(\Nextype\Corporate\CCorporate::$options['PHONE_MASK'])): ?>
$("#order_form input[name*='PHONE']").mask('<?=\Nextype\Corporate\CCorporate::$options['PHONE_MASK']?>');
<? endif; ?>
</script>