<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$mainId = $this->GetEditAreaId($arResult['ID']);
$arMessages = Array (
    'MESS_BTN_ADD_TO_BASKET' => (!empty($arParams['MESS_BTN_ADD_TO_BASKET'])) ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('TO_BASKET')
);
$currentUri = CMain::IsHTTPS() ? "https://" : "http://";
$currentUri .= $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri();
?>

<div class="product" itemscope itemtype="http://schema.org/Product">
    <meta itemprop="name" content="<?=$arResult['NAME']?>">
    
    <? if (!empty($arResult['TAGS'])): ?>
        <div class="product-tags">
            <? foreach ($arResult['TAGS'] as $arTag):?>
            <div class="label <?= strtolower($arTag['CODE'])?>"><span><?=$arTag['NAME']?></span></div>
            <? endforeach; ?>
        </div>
        <? endif; ?>
    <div class="images">
        
        <a itemprop="image" href="<?=$arResult['PICTURES'][0]['DETAIL']?>" data-lightbox="product-main-img" id="product-main-img" class="main-img">
            <img src="<?=$arResult['PICTURES'][0]['PREVIEW']?>" alt="<?=$arResult['PICTURES'][0]['ALT']?>" title="<?=$arResult['PICTURES'][0]['TITLE']?>">
        </a>
        <? if (count($arResult['PICTURES']) > 1): ?>
        <div class="thumbnails">
            <? foreach ($arResult['PICTURES'] as $key => $arPicture): ?>
            <a href="javascript:void(0);" class="thumb<?=$key==0 ? ' active' : ''?>" data-alt="<?=$arPicture['ALT']?>" data-title="<?=$arPicture['TITLE']?>" data-preview="<?=$arPicture['PREVIEW']?>" data-detail="<?=$arPicture['PREVIEW']?>">
                <img src="<?=$arPicture['THUMB']?>" alt="<?=$arPicture['ALT']?>">
            </a>
            <? endforeach; ?>
        </div>
        <? endif; ?>
    </div>
    <div class="information">
        <div class="info">
            <? if (is_array($arResult['STOCK'])): ?>
            <?
            $cssClass = "ready";
            if ($arResult['STOCK']['TYPE'] == "O") $cssClass = "for-order";
            if ($arResult['STOCK']['TYPE'] == "N") $cssClass = "disable";
            ?>
            <div class="label <?=$cssClass?>"><?=$arResult['STOCK']['TEXT']?></div>
            <? endif; ?>
            
            <? if (!empty($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])): ?>
            <div class="code"><?=GetMessage('PROPERTY_ARTICLE')?> <?=$arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></div>
            <? endif; ?>
        </div>
        <? if (!empty($arResult['PREVIEW_TEXT'])): ?>
        <div class="desc" itemprop="description">
            <?=$arResult['PREVIEW_TEXT']?>
        </div>
        <? endif; ?>
        <div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <? if (!empty($arResult['PRICE']['VALUE'])): ?>
                <div class="new"><?=$arResult['PRICE']['PRINT_VALUE']?></div>
                <? if (!empty($arResult['PRICE']['VALUE'])): ?>
                <div class="old"><?=$arResult['PRICE']['PRINT_DISCOUNT_VALUE']?></div>
                <? endif; ?>
                <meta itemprop="price" content="<?=$arResult['PRICE']['VALUE']?>">
            <? else: ?>
                <div class="disabled"><?=GetMessage('PRICE_ON_REQUEST')?></div>
                <meta itemprop="price" content="0">
            <? endif; ?>
                <meta itemprop="priceCurrency" content="<?=\Nextype\Corporate\CCorporate::$options['CURRENCY']?>">
                <? if (!in_array($arResult['STOCK']['TYPE'], Array ("O", "N"))): ?>
                <link itemprop="availability" href="http://schema.org/InStock">
                <? endif; ?>
        </div>
        <div class="buttons" id="catalog-use-basket">
            <div class="quantity quantity-selector" id="catalog-quantity-selector">
                <input type="text" value="1" id="basket-quantity">
                <div class="counters">
                    <span class="count icon plus"></span>
                    <span class="count icon minus"></span>
                </div>
            </div>
            <a href="javascript:void(0)" onclick="CCorporate.toBasket(this, '<?=$arResult['ID']?>', 'basket-quantity');" data-in-basket-text="<?=GetMessage('IN_BASKET')?>" class="btn color"><?=$arMessages['MESS_BTN_ADD_TO_BASKET']?></a>
        </div>
        <div class="order-buttons" id="catalog-disabled-basket">
            <a href="javascript:void(0)" class="btn order-button-popup-btn color"><?=GetMessage('ORDER_BUTTON')?></a>
        </div>
        <div class="share" id="catalog-share">
            <div class="text"><?=GetMessage('SHARE')?></div>
            <div class="social">
                <a href="https://vk.com/share.php?url=<?=$currentUri?>&description=<?=$arResult['NAME']?>" target="_blank" rel="nofollow" class="link icon vk"></a>
                <a href="https://twitter.com/intent/tweet?url=<?=$currentUri + ' ' + $arResult['NAME']?>" target="_blank" rel="nofollow" class="link icon twitter"></a>
                <a href="https://plus.google.com/share?url=<?=$currentUri?>" rel="nofollow" target="_blank" class="link icon gplus"></a>
            </div>
        </div>
    </div>
</div>
<div class="tabs">
    <a href="javascript:void(0);" onclick="CCorporate.openCatalogTab(this, 'tab-product-description');" class="tab tab-description active"><?=GetMessage('DESCRIPTION');?></a>
    
    <? if (count($arResult['ACTIVE_PROPERTIES']) > 0): ?>
    <a href="javascript:void(0);" onclick="CCorporate.openCatalogTab(this, 'tab-product-characteristics');" class="tab tab-characteristics"><?=GetMessage('CHARACTERISTICS');?></a>
    <? endif; ?>
    
    <? if (!empty($arResult['DISPLAY_PROPERTIES']['FILES']['VALUE'])): ?>
    <a href="javascript:void(0);" onclick="CCorporate.openCatalogTab(this, 'tab-product-documents');" class="tab tab-documents"><?=GetMessage('DOCUMENTS');?></a>
    <? endif; ?>
    
    <? if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE'])): ?>
    <a href="javascript:void(0);" onclick="CCorporate.openCatalogTab(this, 'tab-product-videos');" class="tab tab-videos"><?=GetMessage('VIDEOS');?></a>
    <? endif; ?>
</div>
<div class="tabs-content">
    <div class="tab-content active" id="tab-product-description">
        <div class="text">
            <? if (!empty($arResult['DETAIL_TEXT'])): ?>
                <?=$arResult['DETAIL_TEXT']?>
            <? else: ?>
                <?=GetMessage('EMPTY_DESCRIPTION')?>
            <? endif; ?>
        </div>
    </div>
    <? if (count($arResult['ACTIVE_PROPERTIES']) > 0): ?>
    <div class="tab-content" id="tab-product-characteristics">
        <div class="features">
            <? foreach ($arResult['ACTIVE_PROPERTIES'] as $arProperty): ?>
            <div class="feature">
                <div class="name"><?=$arProperty['NAME']?></div>
                <div class="value">
                    <? if (is_array($arProperty['VALUE'])): ?>
                    <?=implode(", ", $arProperty['VALUE'])?>
                    <? else: ?>
                    <?=$arProperty['VALUE']?>
                    <? endif; ?>
                </div>
            </div>
            <? endforeach; ?>
        </div>
    </div>
    <? endif; ?>
    
    <? if (!empty($arResult['DISPLAY_PROPERTIES']['FILES']['VALUE'])): ?>
    <div class="tab-content" id="tab-product-documents">
        <div class="documents">
            <? foreach ($arResult['DISPLAY_PROPERTIES']['FILES']['VALUE'] as $arFile): ?>
            <div class="doc icon-custom file">
                <a href="<?=$arFile['SRC']?>" target="_blank" class="link"><?=(!empty($arFile['DESCRIPTION'])) ? $arFile['DESCRIPTION'] : $arFile['ORIGINAL_NAME']?></a>
                <span class="size">(<?=$arFile['FILE_SIZE']?>)</span>
            </div>
            <? endforeach; ?>
            
        </div>
    </div>
    <? endif; ?>
    
    <? if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE'])): ?>
    <div class="tab-content" id="tab-product-videos">
        <div class="video">
            
            <? if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE']['TEXT'])): ?>
            <?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['~VALUE']['TEXT']?>
            <? else: ?>
            <?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE']?>
            <? endif; ?>
        </div>
    </div>
    <? endif; ?>
</div>