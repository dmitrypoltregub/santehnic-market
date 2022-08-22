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

<section class="news section">
	<div class="container">
		<div class="section-name">
			<h2 class="subtitle"><?=$arParams['BLOCK_TITLE']?></h2>
                        <? if (!empty($arParams['BLOCK_MORE_TITLE'])): ?>
			<a href="<?=$arParams['BLOCK_MORE_LINK']?>" class="all"><?=$arParams['BLOCK_MORE_TITLE']?></a>
                        <? endif; ?>
		</div>
		<div class="items">
                    <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
			<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="image">
                                    <img src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['PICTURE']['ALT']?>" alt="<?=$arItem['PICTURE']['TITLE']?>" />
                                </a>
				<div class="info">
                                    <? if (!empty($arItem['DISPLAY_ACTIVE_FROM'])): ?>
					<div class="main-date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
                                    <? endif; ?>
					<h3 class="name"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
					<div class="desc"><?=$arItem['PREVIEW_TEXT']?></div>
				</div>
			</div>
                    <? endforeach; ?>
		</div>
	</div>
</section>

<? endif; ?>
