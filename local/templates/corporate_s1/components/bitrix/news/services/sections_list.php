<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arSections as $key => $arSection)
{
    if (!empty($arSection['PICTURE']))
    {
        $arResizePreview = CFile::ResizeImageGet($arSection['PICTURE'], Array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_EXACT, true);
        $arSections[$key]['PICTURE'] = Array (
            'SRC' => $arResizePreview['src'],
            'ALT' => $arSection['NAME'],
            'TITLE' => $arSection['NAME'],
        );
    }
}
?>

<div class="categories">
    <? foreach ($arSections as $arSection): ?>
    <div class="category">
        <? if (!empty($arSection['PICTURE'])): ?>
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="image">
            <img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['PICTURE']['ALT']?>" title="<?=$arSection['PICTURE']['TITLE']?>">
        </a>
        <? endif; ?>
        <h2 class="name"><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></h2>
        <? if (!empty($arSection['DESCRIPTION'])): ?>
        <div class="text">
            <?=$arSection['DESCRIPTION']?>
        </div>
        <? endif; ?>
    </div>
    <? endforeach; ?>
    
</div>