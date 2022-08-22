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

<? if (!empty($arResult['ITEMS'])): ?>


    <div class="reviews">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
        <div class="review" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="text">
                <?=$arItem['PREVIEW_TEXT']?>
            </div>
            <? if (!empty($arItem['PROPERTIES']['NAME']['VALUE'])): ?>
            <div class="author">
                <div class="person"><?=$arItem['PROPERTIES']['NAME']['VALUE']?></div>
                <? if (!empty($arItem['PROPERTIES']['JOB']['VALUE'])): ?>
                <div class="post"><?=$arItem['PROPERTIES']['JOB']['VALUE']?></div>
                <? endif; ?>
            </div>
            <? endif; ?>
            
            <? if (!empty($arItem['FILE'])): ?>
            <div class="documents">
                <div class="doc icon-custom pdf">
                    <a href="<?=$arItem['FILE']['SRC']?>" target="_blank" class="link"><?=GetMessage('FILE_DOWNLOAD_TITLE')?></a>
                    <span class="size">(<?=$arItem['FILE']['FILE_SIZE']?>)</span>
                </div>
            </div>
            <? endif; ?>
        </div>
        <? endforeach; ?>
    </div>

<? endif; ?>
