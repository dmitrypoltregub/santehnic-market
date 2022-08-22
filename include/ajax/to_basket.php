<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = 'fail';
if (\Bitrix\Main\Loader::includeModule('nextype.corporate') )
{
    if (!empty($_REQUEST['id']))
    if (Nextype\Corporate\CBasket::add(intval($_REQUEST['id']), intval($_REQUEST['qty'])))
            $result = 'ok';
}

echo $result;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");