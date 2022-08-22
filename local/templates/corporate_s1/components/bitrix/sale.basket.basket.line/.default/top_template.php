<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $cartId
 */

$compositeStub = ($arResult['COMPOSITE_STUB'] ?? 'N') === 'Y';
?>
<a href="<?=SITE_DIR?>basket/" class="basket">

        <div class="icon-cart"></div>
        <div class="name">Корзина</div>


	<?php
	if (!$compositeStub)
	{
		if (
			$arParams['SHOW_NUM_PRODUCTS'] === 'Y'
			&& ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] === 'Y')
		)
		{
            ?><div class="counter"><span><?= $arResult['NUM_PRODUCTS'] ?></span></div><?php
		}
	}
	?>
</a>