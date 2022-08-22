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

$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<? if (count($arResult['SECTIONS']) > 0): ?>
<div class="categories">
    <? foreach ($arResult['SECTIONS'] as &$arSection): ?>
    <? 
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <div class="category" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="preview-image" <?if(!empty($arSection['PICTURE']['SRC'])):?>style="background-image: url('<?=$arSection['PICTURE']['SRC']?>')"<?endif;?>></a>
        <div class="text">
            <h2 class="name">
                <a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
            </h2>
            <div class="desc">
                <ul>
                    <?php
                    foreach($arSection['SUBSECTIONS'] as $subsection)
                    {
                        ?><li class="subsection"><a href="<?=$arSection['SECTION_PAGE_URL'].$subsection['CODE'].'/'?>"><?=$subsection['NAME']?></a></li><?
                    }
                    ?>
                </ul>
            </div>
			<? if (!empty($arSection['DETAIL_DESC'])): ?>
            <div class="desc"><?=$arSection['DETAIL_DESC']?></div>
            <? endif; ?>
        </div>
    </div>
    <? endforeach; ?>
    
</div>

<? endif; ?>