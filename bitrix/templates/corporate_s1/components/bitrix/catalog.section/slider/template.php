<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

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

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'catalog-' . randString(5);
?>
    <? if (!empty($arParams['BLOCK_TITLE'])): ?>
    <h2 class="caption"><?=$arParams['BLOCK_TITLE']?></h2>
    <? endif; ?>
    <div class="slider-nav" id="slider-nav-<?=$containerName?>"></div>
    <div class="items owl-carousel" id="product-carousel-<?=$containerName?>">
        <!-- products -->
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <?
            $uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
            $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
            ?>

            <?
            $APPLICATION->IncludeComponent(
            'bitrix:catalog.item', 'main', array(
                'RESULT' => array(
                    'ITEM' => $item,
                    'AREA_ID' => $this->GetEditAreaId($uniqueId)
                ),
                'PARAMS' => array(
                    'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                    'SHOW_TAGS' => 'Y',
                    'SHOW_LABEL_TOP' => 'N',
                    'SHOW_SCHEMA' => 'Y',
                    "PROPERTY_PRICE" => $arParams['PROPERTY_PRICE'],
                    "PROPERTY_OLD_PRICE" => $arParams['PROPERTY_OLD_PRICE'],
                    "PROPERTY_TAGS" => $arParams['PROPERTY_TAGS'],
                    "DISPLAY_IN_STOCK" => $arParams["DISPLAY_IN_STOCK"],
                )
                    ), $component, array('HIDE_ICONS' => 'Y')
            );
            ?>

        <? endforeach; ?>
    </div>
    <script>
            $('#product-carousel-<?=$containerName?>').owlCarousel({

            loop: true,
            nav: true,
            navContainer: '#slider-nav-<?=$containerName?>',
            navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
            dots: false,
            responsive : {
                0 : {
                    items: 1,
                    margin: 10
                },
                640 : {
                    items: 2,
                    margin: 29
                },
                960 : {
                    items: 3,
                    margin: 29
                },
                1261 : {
                    items: <?=intval($arParams['LINE_ELEMENT_COUNT'])?>,
                    margin: 29
                }
            }
            });
    </script>
