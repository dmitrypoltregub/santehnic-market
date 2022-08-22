<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<section class="services section">
	<div class="container">
		<div class="section-name">
			<h2 class="subtitle"><?=$arParams['BLOCK_TITLE']?></h2>
                        <? if (!empty($arParams['BLOCK_MORE_TITLE'])): ?>
			<a href="<?=$arParams['BLOCK_MORE_LINK']?>" class="all"><?=$arParams['BLOCK_MORE_TITLE']?></a>
                        <? endif; ?>
		</div>
                <? if(!empty($arParams['BLOCK_DESCRIPTION'])):?>
		<div class="desc"><?=$arParams['BLOCK_DESCRIPTION']?></div>
                <? endif; ?>
		<div class="items">
                    <? foreach ($arResult['ITEMS'] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
			<a id="<?=$this->GetEditAreaId($arItem['ID']);?>" href="<?=$arItem['LINK']?>" class="item<?=!empty($arItem['BIG_BANNER']) ? ' big' : ''?>" style="background-image: url('<?=$arItem['PICTURE']['SRC']?>')">
				<div class="gradient">
					<h3 class="name"><?=$arItem['NAME']?></h3>
				</div>
			</a>
                    <? endforeach; ?>
			
		</div>
	</div>
</section>