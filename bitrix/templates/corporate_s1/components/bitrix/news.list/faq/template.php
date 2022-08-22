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
    <div class="tabs">
        <? $bFirst = true; ?>
        <? foreach ($arResult['ITEMS'] as $key => $arSection): ?>
            <? if (!empty($arSection['ITEMS'])): ?>
                <a href="javascript:void(0);" onclick="CCorporate.openCatalogTab(this, 'tab-<?= $key ?>');" class="tab<?= $bFirst ? ' active' : '' ?>"><?= $arSection['NAME'] ?></a>
                <? $bFirst = false; ?>
            <? endif; ?>
        <? endforeach; ?>
    </div>
    <div class="tabs-content">
        <? $bFirst = true; ?>
        <? foreach ($arResult['ITEMS'] as $key => $arSection): ?>
            <? if (!empty($arSection['ITEMS'])): ?>
                <div class="tab-content<?= $bFirst ? ' active' : '' ?>" id="tab-<?= $key ?>">
                    <div class="accordion">
                        <? foreach ($arSection['ITEMS'] as $arItem): ?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <a href="#" class="name"><span>
                                        <?= $arItem['PREVIEW_TEXT'] ?>
                                    </span></a>
                                <div class="content">
                                    <div class="desc">
                                        <?= $arItem['DETAIL_TEXT'] ?>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
                <? $bFirst = false; ?>
            <? endif; ?>
        <? endforeach; ?>

    </div>
<? endif; ?>
