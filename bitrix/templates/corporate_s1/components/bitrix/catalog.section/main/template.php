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

<? if (count($arResult['ITEMS']) > 0): ?>
<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <div class="pagination top">
        <?= $arResult["NAV_STRING"] ?>
    </div>
<? endif; ?>
<div class="items" id="<?= $containerName ?>">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <? if ($arParams['VIEW_MODE'] != 'list'): ?>
        <div class="item-wrap" >
        <? endif; ?>
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
                    'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                    'VIEW_MODE' => $arParams['VIEW_MODE'],
                    'SHOW_TAGS' => 'Y',
                    'SHOW_LABEL_TOP' => 'N',
                    'SHOW_SCHEMA' => 'Y',
                    "PROPERTY_PRICE" => $arParams['PROPERTY_PRICE'],
                    "PROPERTY_OLD_PRICE" => $arParams['PROPERTY_OLD_PRICE'],
                    "PROPERTY_TAGS" => $arParams['PROPERTY_TAGS'],
                )
                    ), $component, array('HIDE_ICONS' => 'Y')
            );
            ?>
        </div>
        <? endforeach; ?>
</div>
    
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
<div class="pagination">
        <?= $arResult["NAV_STRING"] ?>
</div>

<? endif; ?>

<? else: ?>
<div class="empty-section">
    <div class="title">
        <?=GetMessage('CT_EMPTY_ITEMS_TITLE')?>
    </div>
    <?=GetMessage('CT_EMPTY_ITEMS_DESCR')?>
</div>
<? endif; ?>