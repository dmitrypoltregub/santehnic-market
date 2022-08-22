<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<? if (!empty($arResult['ITEMS'])): ?>


    <div class="timeline">
        <? foreach ($arResult['ITEMS'] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="date"><?=$arItem['PROPERTY_YEAR_VALUE']?></div>
            <div class="content">
                <h3 class="name"><?=$arItem['NAME']?></h3>
                <div class="info">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
            </div>
        </div>
        <? endforeach; ?>
    </div>

<? endif; ?>