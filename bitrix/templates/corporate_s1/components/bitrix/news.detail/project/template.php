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

<div class="project">
    <? if (!empty($arResult['GALLERY'])): ?>
    <div class="project-slider">
        <div class="items owl-carousel">
            <? foreach ($arResult['GALLERY'] as $key => $arItem): ?>
            <div class="item" data-hash="gallery-<?=$key?>">
                <img src="<?=$arItem['DETAIL']?>" alt="">
            </div>
            <? endforeach; ?>
        </div>
        <div class="slider-nav"></div>
        <div class="slider-preview">
            <? foreach ($arResult['GALLERY'] as $key => $arItem): ?>
            <a href="#gallery-<?=$key?>" class="item <?=$key==0 ? 'active' : ''?>">
                <img src="<?=$arItem['PREVIEW']?>" alt="">
            </a>
            <? endforeach; ?>
        </div>
        <script>
                $('.project-slider .items').owlCarousel({
                        items: 1,
                        loop: true,
                        nav: true,
                        navContainer: '.project-slider .slider-nav',
                        navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
                        URLhashListener:true,
                        dots: false
                }).on('changed.owl.carousel', function (event) {
                $(".slider-preview .item").removeClass('active');
                $(".slider-preview .item:eq(" + event.item.index + ")").addClass('active');
            });
        </script>
    </div>
    <? endif; ?>
    
    <div class="info">
        <h2 class="name"><?=GetMessage('PROJECT_DESCRIPTION_TITLE')?></h2>
        <? if (!empty($arResult['PREVIEW_TEXT'])): ?>
        <div class="desc">
            <?=$arResult['PREVIEW_TEXT']?>
        </div>
        <? endif; ?>
        
        <? if (!empty($arResult['DISPLAY_PROPERTIES'])): ?>
        <h3 class="subname"><?=GetMessage('PROPERTIES_TITLE')?></h3>
        <div class="features">
            <? foreach ($arResult['DISPLAY_PROPERTIES'] as $arProp): ?>
            <div class="feature">
                <div class="name"><?=$arProp['NAME']?></div>
                <div class="value">
                    <? if (is_array($arProp['VALUE'])): ?>
                        <?=implode(", ", $arProp['VALUE']); ?>
                    <? else: ?>
                        <?=$arProp['VALUE']?>
                    <? endif; ?>
                </div>
            </div>
            <? endforeach; ?>
        </div>
        <? endif; ?>
    </div>
    
    <? if ($arResult['PROPERTIES']['SHOW_ORDER_FORM']['VALUE_XML_ID'] == "Y"): ?>
    <div class="order">
        <div class="text icon-custom"><?=GetMessage('ORDER_FORM_TITLE')?></div>
        <a href="javascript:void(0)" class="btn service-popup-btn color"><?=GetMessage('ORDER_FORM_BTN_TITLE')?></a>
    </div>
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
                    dots: false
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