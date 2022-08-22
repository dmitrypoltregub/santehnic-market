<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"mainpage",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"BLOCK_DESCRIPTION" => "Наша команда занимается реализацией сантехнических продуктов, а так же товаров для дома и ремонта. Мы не одни в данной сфере деятельности, следовательно возникает вопрос, в чем наши достоинства в отличии от конкурентов?",
		"BLOCK_MORE_LINK" => "#WIZARD_SITE_DIR#catalog/",
		"BLOCK_MORE_TITLE" => "Весь каталог",
		"BLOCK_TITLE" => "Каталог",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => \Nextype\Corporate\COptions::getIblockID('catalog'),
		"IBLOCK_TYPE" => "nt_corporate_catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("DESCRIPTION","PICTURE",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	)
);?>