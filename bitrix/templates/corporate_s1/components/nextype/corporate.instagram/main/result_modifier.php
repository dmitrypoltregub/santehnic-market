<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($arResult["ITEMS"]))
{
    foreach ($arResult["ITEMS"] as $key => $item)
    {
        if ($item["TYPE"] === 'VIDEO')
            $arResult["ITEMS"][$key]['DETAIL_PICTURE'] = $arResult["ITEMS"][$key]['PREVIEW_PICTURE'];
    }
}

?>