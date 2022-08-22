<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? \Nextype\Corporate\CCorporate::getInstance(); ?>
<div class="menu-container">
<a href="javascript:void(0);" class="mobile-menu">
    <div class="mobile-menu-icon">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <?=GetMessage("MENU_TITLE");?>
</a>
<nav class="menu" id="top-menu">

    <? foreach ($arResult as $key => $arItem): ?>
    <div class="item<?if(!empty($arItem['SELECTED'])):?> active<?endif;?> <? if (is_array($arItem['SUB'])): ?>has-sub<? endif; ?>">
        <a href="<?=$arItem['LINK']?>" class="link"><?=$arItem['TEXT']?></a>
        <? if (is_array($arItem['SUB'])): ?>
        <div class="sub">
            <? foreach ($arItem['SUB'] as $arItemLvl2): ?>
            <div class="item<? if (is_array($arItemLvl2['SUB'])): ?> has-sub<? endif; ?>">
                <a href="<?=$arItemLvl2['LINK']?>" class="link<?if(!empty($arItemLvl2['SELECTED'])):?> active<?endif;?>"><?=$arItemLvl2['TEXT']?></a>
                <? if (is_array($arItemLvl2['SUB'])): ?>
                <div class="sub">
                    <? foreach ($arItemLvl2['SUB'] as $arItemLvl3): ?>
                        <div class="item">
                            <a href="<?=$arItemLvl3['LINK']?>" class="link<?if(!empty($arItemLvl3['SELECTED'])):?> active<?endif;?>"><?=$arItemLvl3['TEXT']?></a>
                        </div>
                    <? endforeach; ?>
                </div>
                <? endif; ?>
            </div>
            <? endforeach; ?>
        </div>
        <? endif; ?>
    </div>
    <? endforeach; ?>
    <? if (\Nextype\Corporate\CCorporate::$options['CATALOG_SEARCH'] == "Y"): ?>
    <div class="item tablet-only">
    	<a href="<?= SITE_DIR ?>search/" class="link"><?=GetMessage("SEARCH_TITLE");?></a>
    </div>
    <a href="javascript:void(0);" class="search-icon"></a>
    <? endif; ?>
</nav>
</div>