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


<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <div class="pagination top">
        <?= $arResult["NAV_STRING"] ?>
    </div>
<? endif; ?>

<div class="previews">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="preview" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PICTURE"])): ?>
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="image">
                        <img src="<?= $arItem["PICTURE"]["SRC"] ?>" alt="<?= $arItem["PICTURE"]["ALT"] ?>" title="<?= $arItem["PICTURE"]["TITLE"] ?>">
                    </a>
                <? else: ?>
                    <div class="image">
                        <img src="<?= $arItem["PICTURE"]["SRC"] ?>" alt="<?= $arItem["PICTURE"]["ALT"] ?>" title="<?= $arItem["PICTURE"]["TITLE"] ?>">
                    </div>
                <? endif; ?>
            <? endif; ?>
            <div class="info">
                <h2 class="name">
                    <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <? endif; ?>
                        <?= $arItem["NAME"] ?>
                        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                        </a>
                    <? endif; ?>
                </h2>
                
                <div class="date<?=$arItem['DISABLED']=='Y' ? ' disable' : '' ?>">
                    <?= $arItem["PROPERTIES"]["DATE_START"]["VALUE"] ?>&nbsp;-&nbsp;<?= $arItem["PROPERTIES"]["DATE_END"]["VALUE"] ?>
                </div>
                
                <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                    <div class="desc">
                        <? echo $arItem["PREVIEW_TEXT"]; ?>
                    </div>
                <? endif; ?>

                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn color"><?= GetMessage('READ_MORE') ?></a>
                <? endif; ?>
            </div>
        </div>
    <? endforeach; ?>
</div>


<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
<div class="pagination">
        <?= $arResult["NAV_STRING"] ?>
</div>
<? endif; ?>

