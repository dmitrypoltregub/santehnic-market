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

    <div class="documents">
        <? foreach ($arResult['ITEMS'] as $arSection): ?>
        <? if (empty($arSection['ITEMS'])) continue; ?>
        <h2 class="name"><?=$arSection['NAME']?></h2>
            <? foreach ($arSection['ITEMS'] as $arItem): ?>
            <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
            <div class="doc icon-custom file" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['FILE']['SRC']?>" class="link"><?=$arItem['NAME']?></a>
                <span class="size">(<?=$arItem['FILE']['FILE_SIZE']?>)</span>
            </div>
            <? endforeach; ?>
        <? endforeach; ?>
    </div>



<? endif; ?>
