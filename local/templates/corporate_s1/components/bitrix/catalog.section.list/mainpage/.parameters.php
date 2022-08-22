<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

$arTemplateParameters = array(
	"BLOCK_TITLE" => array(
		"NAME" => GetMessage("BLOCK_TITLE"),
		"TYPE" => "STRING",
		'DEFAULT' => '',
		"PARENT" => "VISUAL"
	),
    
    "BLOCK_MORE_TITLE" => array(
		"NAME" => GetMessage("BLOCK_MORE_TITLE"),
		"TYPE" => "STRING",
		'DEFAULT' => '',
		"PARENT" => "VISUAL"
	),
    
    "BLOCK_MORE_LINK" => array(
		"NAME" => GetMessage("BLOCK_MORE_LINK"),
		"TYPE" => "STRING",
		'DEFAULT' => '',
		"PARENT" => "VISUAL"
	),
    
    "BLOCK_DESCRIPTION" => array(
		"NAME" => GetMessage("BLOCK_DESCRIPTION"),
		"TYPE" => "STRING",
		'DEFAULT' => '',
		"PARENT" => "VISUAL"
	),
	
);
