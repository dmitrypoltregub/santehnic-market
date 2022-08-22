<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($_REQUEST['ORDER_ID'])) return;
use Nextype\Corporate\CBasket;

$ajaxPath = SITE_DIR . "include/ajax";
$APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject(Array('BASKET_FULL_AJAX_PATH' => $ajaxPath), false) . ')</script>', true);
$this->setFrameMode(true);
?>

<? if (count($arResult) > 0): ?>
<div id="basket-full-container">
    <? if ($_REQUEST['is_ajax'] == "basket-full-container") {$APPLICATION->RestartBuffer();} ?>
    <table class="basket-full" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <th></th>
            <th class="name"><?=GetMessage('TH_NAME')?></th>
            <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_PRICE'] == "Y"): ?>
            <th class="price"><?=GetMessage('TH_PRICE')?></th>
            <? endif; ?>
            <th class="qty"><?=GetMessage('TH_QTY')?></th>
            <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_PRICE'] == "Y"): ?>
            <th class="sum"><?=GetMessage('TH_SUM')?></th>
            <? endif; ?>
            <th class="actions"></th>
        </thead>
        <tbody>
            <? foreach ($arResult as $key => $arItem): ?>
            <? if (!isset($arItem["ID"]))
                continue; ?>
            <tr>
                <td class="image">
                    <? if (!empty($arItem['PICTURE'])): ?>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <img src="<?=$arItem['PICTURE']['src']?>" alt="<?=$arItem['NAME']?>" />
                    </a>
                    <? endif; ?>
                </td>
                <td class="name">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></td>
                <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_PRICE'] == "Y"): ?>
                <td class="price">
                    <?=$arItem['PRINT_PRICE']?>
                    <? if ($arItem["PROPERTIES"][CBasket::propPrice]["VALUE"] < $arItem["PROPERTIES"][CBasket::propOldPrice]["VALUE"]): ?>
                    <div class="old-price">
                        <?=$arItem['PRINT_OLD_PRICE']?>
                    </div>
                    <? endif; ?>
                </td>
                <? endif; ?>
                <td class="qty">
                    <div class="quantity quantity-selector">
                        <input type="text" value="<?=$arItem['QUANTITY']?>" data-qty="<?=$arItem["ID"]?>" class="quantity-input">
                        <div class="counters">
                            <span class="count icon plus"></span>
                            <span class="count icon minus"></span>
                        </div>
                    </div>

                </td>
                <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_PRICE'] == "Y"): ?>
                <td class="sum">
                    <?=$arItem['PRINT_SUM']?>
                </td>
                <? endif; ?>
                <td class="actions">
                    <a href="javascript:void(0)" data-delete="<?=$arItem["ID"]?>" class="delete"></a>
                </td>
            </tr>
            <? endforeach; ?>
        </tbody>
    </table>
    <div class="basket-full-footer">
        <div class="actions">
            <a href="javascript:void(0);" class="button clear-basket"><?=GetMessage('BTN_CLEAR_BASKET')?></a>
        </div>
        <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SHOW_PRICE'] == "Y"): ?>
        <div class="sum">
            <?=GetMessage('TF_SUM', Array ("#VALUE#" => $arResult['TOTAL_PRICE']));?>
        </div>
        <? endif; ?>
    </div>
    <? if ($_REQUEST['is_ajax'] == "basket-full-container") {exit;} ?>
</div>
<? else: ?>

<div class="basket-full-empty">
    <div class="icon-cart"></div>
    <div class="desc">
        <div class="title"><?=GetMessage('EMPTY_BASKET_TITLE')?></div>
        <?=GetMessage('EMPTY_BASKET_MESSAGE', Array("#SITE_DIR#" => SITE_DIR ))?>
    </div>
</div>

<? endif; ?>
