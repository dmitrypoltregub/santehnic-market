<?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"history",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "30000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array("ID","CODE","NAME","PREVIEW_TEXT","PROPERTY_YEAR",""),
		"IBLOCKS" => array(
                    0 => \Nextype\Corporate\COptions::getIblockID('history')
                ),
		"IBLOCK_TYPE" => "nt_corporate_content",
		"NEWS_COUNT" => "100",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC"
	)
);?>