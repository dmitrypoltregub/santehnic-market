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

<? if ($arParams["DISPLAY_PICTURE"] != "N" && (is_array($arResult['PREVIEW_PICTURE']) || is_array($arResult['DETAIL_PICTURE']))): ?>
    <div class="banner">
        <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
            <div class="date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></div>
        <? endif; ?>

        <? if (is_array($arResult['DETAIL_PICTURE'])): ?>
            <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>" title="<?= $arResult['DETAIL_PICTURE']['TITLE'] ?>">
        <? elseif (is_array($arResult['PREVIEW_PICTURE'])): ?>
            <img src="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arResult['PREVIEW_PICTURE']['ALT'] ?>" title="<?= $arResult['PREVIEW_PICTURE']['TITLE'] ?>">
        <? endif; ?>
    </div>
<? endif; ?>
<div class="desc">
    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"]): ?>
        <p><?= $arResult["FIELDS"]["PREVIEW_TEXT"];
    unset($arResult["FIELDS"]["PREVIEW_TEXT"]); ?></p>
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

<? if (is_array($arResult['GALLERY'])): ?>

    <div class="project-slider">
        <div class="items owl-carousel">
    <? foreach ($arResult['GALLERY'] as $key => $arItem): ?>
                <div class="item" data-hash="gallery-<?= $key ?>">
                    <img src="<?= $arItem['DETAIL'] ?>" alt="">
                </div>
    <? endforeach; ?>
        </div>
        <div class="slider-nav"></div>
        <div class="slider-preview">
    <? foreach ($arResult['GALLERY'] as $key => $arItem): ?>
                <a href="#gallery-<?= $key ?>" class="item<?= $key == 0 ? ' active' : ''; ?>">
                    <img src="<?= $arItem['PREVIEW'] ?>" alt="">
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
                }).on('changed.owl.carousel', function(event) {
                        $(".slider-preview .item").removeClass('active');
                        $(".slider-preview .item:eq("+event.item.index+")").addClass('active');
            });
        </script>
    </div>
<? endif; ?>