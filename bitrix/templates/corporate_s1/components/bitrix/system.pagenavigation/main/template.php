<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>


<div class="pagination-items">
    
    <? if ($arResult["NavPageNomer"] > 1): ?>
    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="prev item"></a>
    <? endif; ?>
    
    <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

        <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
            <div class="item active"><?= $arResult["nStartPage"] ?></div>
        <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
            <a class="item" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
        <? else: ?>
            <a class="item" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
        <? endif ?>
        <? $arResult["nStartPage"] ++ ?>
    <? endwhile; ?>
            
    <? if ($arResult["NavPageNomer"] < $arResult['NavPageCount']): ?>
     <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="next item"></a>
     <? endif; ?>
</div>
