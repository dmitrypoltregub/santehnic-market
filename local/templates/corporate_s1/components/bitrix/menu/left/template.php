<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

    <div class="side-menu">
        <? foreach ($arResult as $key => $arItem): ?>
            <div class="item<? if (is_array($arItem['SUB'])): ?> has-sub2<?endif;?><?if(!empty($arItem['SELECTED'])):?> active<?endif;?>">
                <a href="<?=$arItem['LINK']?>" class="link"><?=$arItem['TEXT']?></a>

            </div>
        <? endforeach; ?>

    </div>

<?php
/*ВЕРСИЯ МЕНЮ С ПОДРАЗДЕЛАМИ
 *

<div class="side-menu">
    <? foreach ($arResult as $key => $arItem): ?>
    <div class="item<? if (is_array($arItem['SUB'])): ?> has-sub<?endif;?><?if(!empty($arItem['SELECTED'])):?> active<?endif;?>">
            <a href="<?=$arItem['LINK']?>" class="link"><?=$arItem['TEXT']?></a>
            <? if (is_array($arItem['SUB'])): ?>
            <div class="sub">
                <? foreach ($arItem['SUB'] as $arItemSub): ?>
                <a href="<?=$arItemSub['LINK']?>" class="sub-item<?if(!empty($arItemSub['SELECTED'])):?> active<?endif;?>"><?=$arItemSub['TEXT']?></a>
                <? endforeach; ?>
            </div>
            <?endif;?>
        </div>
    <? endforeach; ?>
		
</div>
 */
?>