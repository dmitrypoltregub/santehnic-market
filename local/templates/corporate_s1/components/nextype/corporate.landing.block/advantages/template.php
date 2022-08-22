<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<div class="advantages">
	<div class="container">
		<div class="items">
                    <? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
                    <div class="item icon-custom <?=$arItem['icon']?>">
				<div class="name"><?= $arItem['name'] ?></div>
				<div class="desc"><?= $arItem['description'] ?></div>
			</div>
                    
                    <? endforeach; ?>
			
		</div>
	</div>
</div>