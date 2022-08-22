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


    <div class="license">
        <? foreach ($arResult['ITEMS'] as $arSection): ?>
        <h2><?=$arSection['NAME']?></h2>
        <div class="items">
            <? foreach ($arSection['ITEMS'] as $arItem): ?>
            <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
            <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['PICTURE']['DETAIL']?>" class="fullsize" data-lightbox="license" title="<?=$arItem['NAME']?>">
                    <img src="<?=$arItem['PICTURE']['PREVIEW']?>" alt="<?=$arItem['PICTURE']['ALT']?>" title="<?=$arItem['PICTURE']['TITLE']?>">
                </a>
                <div class="name"><?=$arItem['NAME']?></div>
            </div>
            <? endforeach; ?>
        </div>
        <? endforeach; ?>
        
        <script>
            lightbox.option({
                  'showImageNumberLabel': false
            })
        </script>
    </div>


<? endif; ?>
