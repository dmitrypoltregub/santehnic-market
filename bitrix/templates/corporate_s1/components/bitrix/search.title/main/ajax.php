<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arItems = Array ();
$CCorporate = \Nextype\Corporate\CCorporate::getInstance();

if(!empty($arResult["CATEGORIES"]))
{
    foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
    {
        foreach($arCategory["ITEMS"] as $arItem)
        {
            if ($arElement = CIBlockElement::GetByID($arItem['ITEM_ID'])->fetch())
            {
                $arElement['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arElement['PREVIEW_PICTURE'], Array ('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
                $arElement['DETAIL_PAGE_URL'] = $arItem['URL'];
                
                if ($CCorporate::$options['CATALOG_SHOW_PRICE'] == "Y")
                {
                    $arPrice = CIBlockElement::GetProperty($arElement['IBLOCK_ID'], $arElement['ID'], array("sort" => "asc"), Array("CODE" => "PRICE"))->fetch();
                    $arElement['PRICE_VALUE'] = $arPrice['VALUE'];
                    $arElement['PRICE_PRINT_VALUE'] = Nextype\Corporate\CCorporate::formatPrice($arPrice['VALUE']);
                }
                
                $arItems[] = $arElement;
            }
        }
    }
}

?>

<? if (!empty($arItems)): ?>
	<div class="content">
    	<? foreach ($arItems as $arItem): ?>
    	<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="item">
    	    <span class="image">
    	        <img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" />
    	    </span>
    	    <span class="info">
    	        <span class="name"><?=$arItem['NAME']?></span>
    	        <? if (!empty($arItem['PRICE_VALUE'])): ?>
    	        <span class="price"><?=$arItem['PRICE_PRINT_VALUE']?></span>
    	        <? endif; ?>
    	    </span>
    	</a>
    	<? endforeach; ?>
    </div>
<? endif; ?>