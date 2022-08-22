<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewTypesList = array(
	'' => GetMessage('NT_FORMS_PRO_VIEW_TYPE_INLINE'),
	'POPUP' => GetMessage('NT_FORMS_PRO_VIEW_TYPE_POPUP'),
);

$arTemplateParameters = array(
	'VIEW_TYPE' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('NT_FORMS_PRO_VIEW_TYPE'),
		'TYPE' => 'LIST',
		'VALUES' => $arViewTypesList,
		'MULTIPLE' => 'N',
		'DEFAULT' => '',
		'REFRESH' => 'Y'
	),
	'SUBMIT_BUTTON_TEXT' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('NT_FORMS_PRO_SUBMIT_BUTTON_TEXT'),
		'TYPE' => 'TEXT',
		'DEFAULT' => GetMessage('NT_FORMS_PRO_SUBMIT_BUTTON_TEXT_DEFAULT')
	),
);

if (isset($arCurrentValues['VIEW_TYPE']) && $arCurrentValues['VIEW_TYPE'] == "POPUP")
{
	$arTemplateParameters['SHOW_POPUP_BUTTON'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('NT_FORMS_PRO_SHOW_POPUP_BUTTON'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y'
	);
        
        $arTemplateParameters['POPUP_BUTTON_TEXT'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('NT_FORMS_PRO_POPUP_BUTTON_TEXT'),
		'TYPE' => 'TEXT',
		'DEFAULT' => GetMessage('NT_FORMS_PRO_POPUP_BUTTON_TEXT_DEFAULT')
	);
}
?>