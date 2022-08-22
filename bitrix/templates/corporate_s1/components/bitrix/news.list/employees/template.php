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


    <div class="employees">
        <? foreach ($arResult['ITEMS'] as $arSection): ?>
            <? if (empty($arSection['ITEMS'])) continue; ?>
        <h2><?=$arSection['NAME']?></h2>
        <div class="items">
            <? foreach ($arSection['ITEMS'] as $arItem): ?>
            <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
            <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <? if (!empty($arItem['PICTURE'])): ?>
                <img src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['PICTURE']['ALT']?>" title="<?=$arItem['PICTURE']['TITLE']?>" class="image">
                <? endif; ?>
                <div class="name"><?=$arItem['NAME']?></div>
                <? if (!empty($arItem['PROPERTIES']['JOB']['VALUE'])): ?>
                <div class="post"><?=$arItem['PROPERTIES']['JOB']['VALUE']?></div>
                <? endif; ?>
                
                <? if (!empty($arItem['PROPERTIES']['PHONE']['VALUE'])): ?>
                <a href="tel:<?=$arItem['PROPERTIES']['PHONE']['VALUE_INT']?>" class="tel icon"><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></a>
                <? endif; ?>
                
                <? if (!empty($arItem['PROPERTIES']['EMAIL']['VALUE'])): ?>
                <a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE']?>" class="email icon-custom"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
                <? endif; ?>
                
                
                <div class="social color">
                    <? if (!empty($arItem['PROPERTIES']['SOCIAL_VK']['VALUE'])): ?>
                    <a href="<?=$arItem['PROPERTIES']['SOCIAL_VK']['VALUE']?>" target="_blank" rel="nofollow" class="link icon vk"></a>
                    <? endif; ?>
                    
                    <? if (!empty($arItem['PROPERTIES']['SOCIAL_INSTAGRAM']['VALUE'])): ?>
                    <a href="<?=$arItem['PROPERTIES']['SOCIAL_INSTAGRAM']['VALUE']?>" target="_blank" rel="nofollow" class="link icon instagram"></a>
                    <? endif; ?>
                    
                    <? if (!empty($arItem['PROPERTIES']['SOCIAL_FACEBOOK']['VALUE'])): ?>
                    <a href="<?=$arItem['PROPERTIES']['SOCIAL_FACEBOOK']['VALUE']?>" target="_blank" rel="nofollow" class="link icon facebook"></a>
                    <? endif; ?>

                </div>
            </div>
            <? endforeach; ?>
        </div>
        <? endforeach; ?>
    </div>



    



<? endif; ?>
