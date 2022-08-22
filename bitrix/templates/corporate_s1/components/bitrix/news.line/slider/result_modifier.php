<?php

foreach ($arResult['ITEMS'] as $key => $arItem)
{
    foreach ($arItem as $prop => $value)
    {
        if (strpos($prop, "PROPERTY_") !== false)
        {
            $propCode = str_replace("_VALUE", "", str_replace("PROPERTY_", "", $prop));
            
            if ($propCode == "BUTTON_PRIMARY_LINK" || $propCode == "BUTTON_SECOND_LINK")
                $value = str_replace ("#SITE_DIR#", SITE_DIR, $value);
            
            if ($propCode == "TEXT_POSITION")
            {
                $enumProperty = CIBlockProperty::GetPropertyEnum("TEXT_POSITION", Array(), Array("IBLOCK_ID"=>$arItem['IBLOCK_ID'], "ID" => $arItem['PROPERTY_TEXT_POSITION_ENUM_ID']))->fetch();
                if (!empty($enumProperty['XML_ID']))
                    $value = $enumProperty['XML_ID'];
            }
            
            $arResult['ITEMS'][$key][$propCode] = $value;
            unset($arResult['ITEMS'][$key][$prop]);
        }
    }
}
