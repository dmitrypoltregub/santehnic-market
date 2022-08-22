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
?>
<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult['PICTURE'])): ?>
<div class="banner">
    <? if ($arParams["DISPLAY_DATE"] != "N"): ?>
            <div class="date<?=$arResult['DISABLED'] == 'Y' ? ' disable' : ''?>">
            <?= $arResult["PROPERTIES"]["DATE_START"]["VALUE"] ?>&nbsp;-&nbsp;<?= $arResult["PROPERTIES"]["DATE_END"]["VALUE"] ?>
            </div>
    <? endif; ?>
   
    <img src="<?=$arResult['PICTURE']['SRC']?>" alt="<?=$arResult['PICTURE']['ALT']?>" title="<?=$arResult['PICTURE']['TITLE']?>">
</div>
<? endif; ?>

<? if (!empty($arResult["FIELDS"]['PREVIEW_TEXT']) || !empty($arResult["FIELDS"]['DETAIL_TEXT'])): ?> 
<h2 class="title"><?=GetMessage('ACTION_DESCRIPTION_TITLE')?></h2>
<div class="text">
    <? if (!empty($arResult["FIELDS"]['DETAIL_TEXT'])): ?> 
        <?=$arResult["FIELDS"]['DETAIL_TEXT']?>
    <? else: ?>
        <?=$arResult["FIELDS"]['PREVIEW_TEXT']?>
    <? endif; ?>
</div>
<? endif; ?>


