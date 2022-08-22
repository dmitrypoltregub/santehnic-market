<?php

$arNewTabs = Array ();
foreach ($arResult['TABS'] as $arTab)
{
    if (!empty($arTab['VALUES']))
    {
        $arTab['HTML_ID'] = "bx_catalog_top".$this->randString();
        $arNewTabs[] = $arTab;
    }
}

$arResult['TABS'] = $arNewTabs;
