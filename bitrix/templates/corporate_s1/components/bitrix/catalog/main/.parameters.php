<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;
use Bitrix\Iblock;

if (!Loader::includeModule('iblock'))
	return;

$boolCatalog = Loader::includeModule('catalog');
CBitrixComponent::includeComponentClass('bitrix:catalog.section');
CBitrixComponent::includeComponentClass('bitrix:catalog.top');
CBitrixComponent::includeComponentClass('bitrix:catalog.element');

$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

if ($iblockExists)
{
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE', 'SORT'),
		'filter' => array('=IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch())
	{
		$propertyCode = (string)$property['CODE'];

		if ($propertyCode === '')
		{
			$propertyCode = $property['ID'];
		}

		$propertyName = '['.$propertyCode.'] '.$property['NAME'];

		if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
		{
			$arProperty[$propertyCode] = $propertyName;

			if ($property['MULTIPLE'] === 'Y')
			{
				$arProperty_X[$propertyCode] = $propertyName;
			}
			elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST)
			{
				$arProperty_X[$propertyCode] = $propertyName;
			}
			elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_ELEMENT && (int)$property['LINK_IBLOCK_ID'] > 0)
			{
				$arProperty_X[$propertyCode] = $propertyName;
			}
		}

		if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER)
		{
			$arProperty_N[$propertyCode] = $propertyName;
		}
	}
	unset($propertyCode, $propertyName, $property, $propertyIterator);
}

$arTemplateParameters = Array(
    'VIEW_MODE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('CP_BC_VIEW_MODE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'REFRESH' => 'N',
			'VALUES' => Array(
                            "cards" => GetMessage('CP_BC_VIEW_MODE_CARDS'),
                            "list" => GetMessage('CP_BC_VIEW_MODE_LIST'),
                        ),
                        "DEFAULT" => "cards",
			'ADDITIONAL_VALUES' => 'N',
            ),
    
    'FILTER_VIEW_MODE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('CP_BC_FILTER_VIEW_MODE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'REFRESH' => 'N',
			'VALUES' => Array(
                            "vertical" => GetMessage('CP_BC_FILTER_VIEW_MODE_VERTICAL'),
                            "horizontal" => GetMessage('CP_BC_FILTER_VIEW_MODE_HORIZONTAL'),
                        ),
                        "DEFAULT" => "vertical",
			'ADDITIONAL_VALUES' => 'N',
            ),
    
        'PROPERTY_TAGS' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('CP_BC_PROPERTY_TAGS'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'REFRESH' => 'N',
			'VALUES' => $arProperty,
			'ADDITIONAL_VALUES' => 'Y',
            ),
    
    'PROPERTY_PRICE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('CP_BC_PROPERTY_PRICE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'REFRESH' => 'N',
			'VALUES' => $arProperty,
			'ADDITIONAL_VALUES' => 'Y',
            ),
    
    'PROPERTY_OLD_PRICE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('CP_BC_PROPERTY_OLD_PRICE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'REFRESH' => 'N',
			'VALUES' => $arProperty,
			'ADDITIONAL_VALUES' => 'Y',
            ),
);