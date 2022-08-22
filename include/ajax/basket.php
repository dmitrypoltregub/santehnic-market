<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
\Bitrix\Main\Localization\Loc::loadMessages($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . "/header.php");

include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/header_basket.php");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");