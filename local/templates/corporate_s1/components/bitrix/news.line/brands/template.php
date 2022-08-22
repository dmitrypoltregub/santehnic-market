<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<? if (!empty($arResult['ITEMS'])): ?>
<div class="brands">
	<div class="container">
		<div class="items owl-carousel" id="brands-carousel">
                    <? foreach ($arResult['ITEMS'] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                        <? if (!empty($arItem['PICTURE'])): ?>
			<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >
                            <img src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['PICTURE']['ALT']?>" title="<?=$arItem['PICTURE']['TITLE']?>">
                        </div>
                        <? endif; ?>
                    <? endforeach; ?>
		</div>
		<div class="brands-nav"></div>
		<script>
			$('#brands-carousel').owlCarousel({
				items: 6,
				margin: 10,
				loop: true,
				nav: true,
				navContainer: '.brands-nav',
				navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
				dots: false,
            	responsive : {
            	    0 : {
            	        items: 2
            	    },
                    640 : {
                        items: 3
                    },
            	    960 : {
            	        items: 5
            	    },
            	    1261 : {
            	        items: 6
            	    }
            	}
			});
		</script>
	</div>
</div>
<? endif; ?>