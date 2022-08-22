<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<? foreach ($arResult['FIELDS'] as $arField): ?>

<div class="field">
    <div class="label">
        <label><?=$arField['NAME']?><? if($arField['IS_REQUIRED'] == "Y"):?><sup>*</sup><?endif;?></label>
    </div>
    
    <? if ($arField['TYPE'] == 'TEXT'): ?>
    <?
    $type = "text";
    if (strpos($arField['CODE'], "EMAIL") !== false) $type = "email"; ?>
    <input name="ORDER_PROPERTY_<?=$arField['CODE']?>" <? if($arField['IS_REQUIRED'] == "Y"):?>required="required"<?endif;?> type="<?=$type?>" value="<?=$_REQUEST['ORDER_PROPERTY_' . $arField['CODE']]?>" />
    <? endif ;?>
    
    <? if ($arField['TYPE'] == 'TEXTAREA'): ?>
    <textarea <? if($arField['IS_REQUIRED'] == "Y"):?>required="required"<?endif;?> name="ORDER_PROPERTY_<?=$arField['CODE']?>"><?=$_REQUEST['ORDER_PROPERTY_' . $arField['CODE']]?></textarea>
    <? endif ;?>
    
    <? if ($arField['TYPE'] == 'SELECT'): ?>
    <select <? if($arField['IS_REQUIRED'] == "Y"):?>required="required"<?endif;?> name="ORDER_PROPERTY_<?=$arField['CODE']?>">
        <? foreach ($arField['OPTIONS'] as $arOption): ?>
        <option value="<?=$arOption['ID']?>"><?=$arOption['VALUE']?></option>
        <? endforeach; ?>
    </select>
    <? endif ;?>
</div>

<? endforeach; ?>

<? if ($arParams['USE_AGREEMENT_FIELD'] == "Y"): ?>
<div class="field">
    <div class="checkbox">
        <input type="checkbox" required="required" checked="checked" value="Y" id="order_agreement" name="ORDER_AGREEMENT">
        <label for="order_agreement"><?=GetMessage('B_FORM_AGREEMENT_TEXT', Array("#SITE_DIR#" => SITE_DIR))?></label>
    </div>
</div>
<? endif; ?>