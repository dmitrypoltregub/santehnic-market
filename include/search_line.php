<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"main",
	Array(
		"CATEGORY_0" => array("iblock_nt_corporate_catalog"),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_nt_corporate_catalog" => array(\Nextype\Corporate\COptions::getIblockID("catalog")),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "/search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y"
	)
);?>