<div class="product-item-list" id="<?=$arResult['AREA_ID']?>">
<? if (!empty($arResult['ITEM']['TAGS'])): ?>
    <div class="product-tags">
        <? foreach ($arResult['ITEM']['TAGS'] as $arTag):?>
        <div class="label <?= strtolower($arTag['CODE'])?>"><span><?=$arTag['NAME']?></span></div>
        <? endforeach; ?>
    </div>
    <? endif; ?>
<a href="<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>" class="image">
    <img src="<?=$arResult['ITEM']['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arResult['ITEM']['PREVIEW_PICTURE']['ALT']?>" title="<?=$arResult['ITEM']['PREVIEW_PICTURE']['TITLE']?>">
</a>
<div class="information">
    <? if (!empty($arResult['ITEM']['SECTION'])): ?>
    <div class="category"><?=$arResult['ITEM']['SECTION']['NAME']?></div>
    <? endif; ?>
    <div class="name"><a href="<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>"><?=$arResult['ITEM']['NAME']?></a></div>
    <div class="price">
        <? if (!empty($arResult['ITEM']['PRICE']['VALUE'])): ?>
            <div class="new"><?=$arResult['ITEM']['PRICE']['PRINT_VALUE']?></div>
            <? if (!empty($arResult['ITEM']['PRICE']['VALUE'])): ?>
            <div class="old"><?=$arResult['ITEM']['PRICE']['PRINT_DISCOUNT_VALUE']?></div>
            <? endif; ?>
        <? else: ?>
            <div class="disabled"><?=GetMessage('PRICE_ON_REQUEST')?></div>
        <? endif; ?>
    </div>
    <div class="info">
        <? if (is_array($arResult['ITEM']['STOCK'])): ?>
        <?
        $cssClass = "ready";
        if ($arResult['ITEM']['STOCK']['TYPE'] == "O") $cssClass = "for-order";
        if ($arResult['ITEM']['STOCK']['TYPE'] == "N") $cssClass = "disable";
        ?>
        <div class="label <?=$cssClass?>"><?=$arResult['ITEM']['STOCK']['TEXT']?></div>
        <? endif; ?>
        <? if (!empty($arResult['ITEM']['PROPERTIES']['ARTICLE']['VALUE'])): ?>
        <div class="code"><?=GetMessage('PROPERTY_ARTICLE')?> <?=$arResult['ITEM']['PROPERTIES']['ARTICLE']['VALUE']?></div>
        <? endif; ?>
    </div>
    <div class="buttons">
        <a href="<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>" class="btn color"><?=$arMessages['MESS_BTN_DETAIL']?></a>
    </div>
</div>
<? if (!empty($arResult['ITEM']['PREVIEW_TEXT'])): ?>
<div class="desc">
    <?=$arResult['ITEM']['PREVIEW_TEXT']?>
</div>
<? endif; ?>