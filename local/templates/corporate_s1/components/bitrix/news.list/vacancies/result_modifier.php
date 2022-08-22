<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ITEMS']))
{

    foreach ($arResult['ITEMS'] as $key => &$arItem)
    {
        if (!empty($arItem['PROPERTIES']['FILE']['VALUE']))
        {
            $file = CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
            $file['FILE_SIZE'] = $file['FILE_SIZE'] / 1000;

            if ($file['FILE_SIZE'] < 1024)
                $file['FILE_SIZE'] = round($file['FILE_SIZE'], 0) . " " . GetMessage('FILE_SIZE_KB');
            else
                $file['FILE_SIZE'] = round($file['FILE_SIZE'] / 1024, 2) . " " . GetMessage('FILE_SIZE_MB');

            $arItem['FILE'] = $file;
        }

    }

}
