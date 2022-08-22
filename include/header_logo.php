<a href="<?=SITE_DIR?>">
    <? $arLogo = \Nextype\Corporate\CCorporate::getSiteLogo(); ?>
    <? if (!empty($arLogo['SRC'])): ?>
        <img src="<?=$arLogo['SRC']?>" alt="<?=$arLogo['ALT']?>" title="<?=$arLogo['TITLE']?>">
    <? else: ?>
        <? include($arLogo['DEFAULT']) ?>
    <? endif; ?>
</a>