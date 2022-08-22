<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);
$isOpen = ($APPLICATION->get_cookie("SET_CITY") == "Y") ? false : true;
?>


<div class="header-change-city item icon location">
    <a href="javascript:void(0)" class="open-cities-modal">
        <span class="text"><?=GetMessage("CURRENT_LOCATION_TITLE");?></span>
        <?= $arResult['CURRENT_LOCATION']['NAME']; ?>
        <span class="arrow"></span></a>
    <div class="accept-modal<?=$isOpen ? ' open' : ''?>">
        <div class="title">
            <?=GetMessage('CURRENT_CITY_TITLE')?>
            <span><?=$arResult['CURRENT_LOCATION']['NAME']?></span>
        </div>

        <div class="actions">
            <a href="javascript:void(0)" class="btn close-accept-modal set-cookie color"><?=GetMessage('BTN_CORRECTLY_DEFINED')?></a>
            <a href="javascript:void(0)" class="button set-cookie open-cities-modal-accept"><?=GetMessage('BTN_CHANGE_OTHER')?></a>
        </div>
    </div>
    <div class="cities-modal">
        <? foreach ($arResult['LOCATIONS'] as $arLocation): ?>
        <a class="item-city" href="<?=$arLocation['URL']?>"><?=$arLocation['NAME']?></a>
        <? endforeach; ?>
    </div>
</div>