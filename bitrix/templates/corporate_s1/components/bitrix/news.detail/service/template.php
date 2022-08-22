<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

<div class="service">
        <? if ($arParams["DISPLAY_PICTURE"] != "N" && (is_array($arResult['PREVIEW_PICTURE']) || is_array($arResult['DETAIL_PICTURE']))): ?>
        <div class="banner">
            <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
                <div class="date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></div>
            <? endif; ?>

            <? if (is_array($arResult['DETAIL_PICTURE'])): ?>
                <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" title="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>">
            <? elseif (is_array($arResult['PREVIEW_PICTURE'])): ?>
                <img src="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>" title="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>">
        <? endif; ?>
        </div>
        <? endif; ?>
    <div class="desc">
            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"]): ?>
            <p><?= $arResult["FIELDS"]["PREVIEW_TEXT"];
            unset($arResult["FIELDS"]["PREVIEW_TEXT"]);
                ?></p>
            <? endif; ?>
        <? if ($arResult["NAV_RESULT"]): ?>
            <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><br /><? endif; ?>
            <? echo $arResult["NAV_TEXT"]; ?>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br /><?= $arResult["NAV_STRING"] ?><? endif; ?>
        <? elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
            <? echo $arResult["DETAIL_TEXT"]; ?>
<? else: ?>
    <? echo $arResult["PREVIEW_TEXT"]; ?>
<? endif ?>
    </div>
    
    
<? if ($arResult['PROPERTIES']['SHOW_ORDER_FORM']['VALUE_XML_ID'] == "Y"): ?>
    <div class="order">
        <div class="text icon-custom"><?=GetMessage('ORDER_FORM_TITLE')?></div>
        <a href="javascript:void(0)" class="btn color service-popup-btn"><?=GetMessage('ORDER_FORM_BTN_TITLE')?></a>
    </div>
    
    <? endif; ?>
    
    <? if (!empty($arResult['DOCS'])): ?>
    <section class="documents section">
        <h2 class="name"><?=GetMessage('DOCS_TITLE')?></h2>
        <? foreach ($arResult['DOCS'] as $arFile): ?>
        <div class="doc icon-custom file">
            <a href="<?=$arFile['SRC']?>" class="link" target="_blank"><?=(!empty($arFile['DESCRIPTION'])) ? $arFile['DESCRIPTION'] : $arFile['ORIGINAL_NAME']?></a>
            <span class="size">(<?=$arFile['FILE_SIZE']?>)</span>
        </div>
        <? endforeach; ?>
    </section>
    <? endif; ?>
    
    <? if (!empty($arResult['PROJECTS'])): ?>
    <section class="projects section">
        <h2 class="name"><?=GetMessage('PROJECTS_TITLE')?></h2>
        <div class="slider-nav"></div>
        <div class="items owl-carousel" id="projects-slider">		
            <? foreach ($arResult['PROJECTS'] as $arItem): ?>
            <?
            $arPicture = false;
            if (!empty($arItem['PREVIEW_PICTURE']))
                $arPicture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array ('width' => 270, 'height' => 180), BX_RESIZE_IMAGE_EXACT);
            ?>
            <div class="item">
                <? if ($arPicture): ?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="image"><img src="<?=$arPicture['src']?>" alt="<?=$arItem['NAME']?>"></a>
                <? endif; ?>
                <h3 class="name"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
            </div>
            <? endforeach; ?>
            <script>
                $('#projects-slider').owlCarousel({
                    items: 3,
                    margin: 32,
                    //loop: true,
                    nav: true,
                    navContainer: '.projects.section .slider-nav',
                    navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
                    dots: false,
                    responsive:{
                        0:{
                            items:1
                        },
                        640:{
                            items:2
                        },
                        1260:{
                            items:3
                        }
                    }
                });
            </script>					
        </div>
    </section>
    <? endif; ?>
    
    <? if (!empty($arResult['REVIEWS'])): ?>
    <section class="reviews section">
        <h2 class="name"><?=GetMessage('REVIEWS_TITLE')?></h2>
        <? foreach ($arResult['REVIEWS'] as $arItem): ?>
        <div class="review">
            <div class="text">
                <?=$arItem['PREVIEW_TEXT']?>
            </div>
            <? if (!empty($arItem['PROPERTIES']['NAME']['VALUE'])): ?>
            <div class="author">
                <div class="person"><?=$arItem['PROPERTIES']['NAME']['VALUE']?></div>
                <? if (!empty($arItem['PROPERTIES']['JOB']['VALUE'])): ?>
                <div class="post"><?=$arItem['PROPERTIES']['JOB']['VALUE']?></div>
                <? endif; ?>
            </div>
            <? endif; ?>
            
            <? if (!empty($arItem['FILE'])): ?>
            <div class="documents">
                <div class="doc icon-custom pdf">
                    <a href="<?=$arItem['FILE']['SRC']?>" target="_blank" class="link"><?=GetMessage('FILE_DOWNLOAD_TITLE')?></a>
                    <span class="size">(<?=$arItem['FILE']['FILE_SIZE']?>)</span>
                </div>
            </div>
            <? endif; ?>
        </div>
        <? endforeach; ?>
    </section>
    <? endif; ?>
</div>