<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';




$strReturn .= '<div class="links">';

$itemSize = count($arResult);

if ($itemSize > 0)
    $strReturn .= '<a class="link" href="'.SITE_DIR.'">'.GetMessage('HOMEPAGE_LINK').'</a>';

for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<a class="link" href="'.$arResult[$index]["LINK"].'">'.$title.'</a>';
	}
	else
	{
		$strReturn .= '
			<a href="'.$arResult[$index]["LINK"].'" class="link active">'.$title.'</a>';
	}
}

$strReturn .= '</div>';

return $strReturn;
