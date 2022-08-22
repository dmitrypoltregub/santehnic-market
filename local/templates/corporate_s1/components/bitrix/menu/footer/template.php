<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<ul class="menu-list">
	<? foreach ($arResult as $key => $arItem): ?>
	<li>
		<a href="<?=$arItem['LINK']?>" class="link<?if(!empty($arItem['SELECTED'])):?> active<?endif;?>"><?=$arItem['TEXT']?></a>
	</li>
	<? endforeach; ?>
</ul>