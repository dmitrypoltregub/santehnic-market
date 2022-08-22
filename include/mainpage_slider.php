<?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array("ID","CODE","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","PROPERTY_BUTTON_PRIMARY_TEXT","PROPERTY_BUTTON_PRIMARY_LINK","PROPERTY_BUTTON_SECOND_TEXT","PROPERTY_BUTTON_SECOND_LINK","PROPERTY_TEXT_POSITION",""),
		"IBLOCKS" => array(
                    0 => \Nextype\Corporate\COptions::getIblockID('slider')
                ),
		"IBLOCK_TYPE" => "nt_corporate_content",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC"
	)
);?>