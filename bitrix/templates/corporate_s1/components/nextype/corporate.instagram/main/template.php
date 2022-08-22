<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["ITEMS"]) || !empty($arResult['ERRORS']))
    return;
?>

<section class="instagram section">
    <div class="container">
        <div class="section-name">
            <h2 class="subtitle"><?=GetMessage('INSTAGRAM_TITLE')?></h2>
            <a href="<?=\Nextype\Corporate\CCorporate::$options['INSTAGRAM_LINK_MORE'];?>" class="all"><?=GetMessage('INSTAGRAM_TEXT_MORE')?></a>
        </div>

        <div class="items owl-carousel">
            <?foreach ($arResult["ITEMS"] as $item):?>
                <div class="item">
                    <a href="<?=$item["DETAIL_URL"]?>" class="link" target="_blank">

                        <div class="image"
                            style="background-image: url('<?=$item["DETAIL_PICTURE"]?>')">
                        </div>

                        <div class="text_wrapper">
                            <div class="scrollbar-inner">
                                <div class="text">
                                    <span><?=$item['TEXT']?></span>
                                </div>
                            </div>
                        </div>

                    </a>
                </div>
            <?endforeach?>
        </div>
    </div>
</section>
