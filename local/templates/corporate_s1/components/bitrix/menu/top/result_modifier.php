<?php
$CCorporate = \Nextype\Corporate\CCorporate::getInstance();
echo "<!--";
var_dump($arResult);
echo "-->";
$arResult = $CCorporate->GetMenuMultilevel($arResult);

