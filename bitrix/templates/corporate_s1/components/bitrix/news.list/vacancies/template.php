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

    <div class="work">

        <div class="accordion">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="#" class="name"><span><?=$arItem['NAME']?></span> &nbsp; <span class="salary"><?=$arItem['PROPERTIES']['PAY_SHORT']['VALUE']?></span></a>
                <div class="content">
                    <? if (!empty($arItem['PREVIEW_TEXT'])): ?>
                    <div class="desc">
                        <?=$arItem['PREVIEW_TEXT']?>
                    </div>
                    <? endif; ?>
                    
                    <? foreach (Array ('PAY_FULL', 'WORKTIME', 'REQUIREMENTS', 'DUTIES') as $code): ?>
                        <? if (!empty($arItem['PROPERTIES'][$code]['VALUE'])): ?>
                        <div class="param"><?=$arItem['PROPERTIES'][$code]['NAME']?></div>
                        <div class="desc">
                            <? if(is_array($arItem['PROPERTIES'][$code]['VALUE'])): ?>
                                <?=$arItem['PROPERTIES'][$code]['VALUE']['TEXT']?>
                            <? else: ?>
                                <?=$arItem['PROPERTIES'][$code]['VALUE']?>
                            <? endif ;?>
                        </div>
                        <? endif; ?>
                    <? endforeach; ?>

                    <div class="buttons">
                        <a href="javascript:void(0)" class="btn resume<?=$arItem['ID']?>-popup-btn color"><?=GetMessage('SEND_RESUME')?></a>
                    </div>
                    <script>
                    jqmPopup('resume<?=$arItem['ID']?>', 'include/ajax/forms/resume.php?JOB=<?=urlencode($arItem['NAME'])?>');
                    </script>
                </div>
            </div>
            <? endforeach; ?>

        </div>
    </div>

    
<? endif; ?>
