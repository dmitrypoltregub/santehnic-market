<div class="product-item" id="<?=$arResult['AREA_ID']?>">
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
    <? if (!empty($arResult['ITEM']['SECTION'])): ?>
    <div class="category"><?=$arResult['ITEM']['SECTION']['NAME']?></div>
    <? endif; ?>
    <div class="name"><a href="<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>"><?=$arResult['ITEM']['NAME']?></a></div>
    <div class="info">
        <? if ($arParams["DISPLAY_IN_STOCK"] === "Y"): ?>
            <? if (is_array($arResult['ITEM']['STOCK'])): ?>
            <?
            $cssClass = "ready";
            if ($arResult['ITEM']['STOCK']['TYPE'] == "O") $cssClass = "for-order";
            if ($arResult['ITEM']['STOCK']['TYPE'] == "N") $cssClass = "disable";
            ?>
            <div class="label <?=$cssClass?>"><?=$arResult['ITEM']['STOCK']['TEXT']?></div>
            <? endif; ?>
        <? endif; ?>
        <? if (!empty($arResult['ITEM']['PROPERTIES']['ARTICLE']['VALUE'])): ?>
        <div class="code"><?=GetMessage('PROPERTY_ARTICLE')?> <?=$arResult['ITEM']['PROPERTIES']['ARTICLE']['VALUE']?></div>
        <? endif; ?>
    </div>
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
    <div class="buttons">
        <a href='javascript::void(0)' data-quantity="<?=$arResult['ITEM']['CATALOG_QUANTITY']?>" data-product="<?=$arResult['ITEM']['ID']?>" data-name="<?=$arResult['ITEM']['NAME']?>" data-price="<?=$arResult['ITEM']['PRICE']['VALUE']?>"  class="btn order-button-popup-btn color product-purchase__button"><i class="simple-cart-icon product-purchase__icon" data-product="<?=$arResult['ITEM']['ID']?>" data-name="<?=$arResult['ITEM']['NAME']?>" data-price="<?=$arResult['ITEM']['PRICE']['VALUE']?>"  data-quantity="<?=$arResult['ITEM']['CATALOG_QUANTITY']?>" rel="nofollow"></i>В корзину</a>
    </div>
</div>
<style>
    .buttons .in-basket:before {
        content: "\f26b";
        font-family: 'Material-Design-Iconic-Font';
        margin-right: 8px;
    }
    .buttons .in-basket{
        background-color: #65b20d !important;
    }
</style>