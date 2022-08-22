<?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"tizers",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"BLOCK_DESCRIPTION" => "В профессиональной сфере часто случается так, что личные или корпоративные клиенты заказывают, чтобы публикация была сделана и представлена еще тогда, когда фактическое содержание все еще не готово. Вспомните новостные блоги, где информация публикуется каждый час в живом порядке. Тем не менее, читатели склонны к тому, чтобы быть отвлеченными доступным контентом.",
		"BLOCK_MORE_LINK" => "/services/",
		"BLOCK_MORE_TITLE" => "Все услуги",
		"BLOCK_TITLE" => "Наши услуги",
		"BLOCK_TITLE_LINK" => "",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array("ID","CODE","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","PROPERTY_BIG_BANNER","PROPERTY_LINK",""),
		"IBLOCKS" => array(
                    0 => \Nextype\Corporate\COptions::getIblockID('tizers')
                ),
		"IBLOCK_TYPE" => "nt_corporate_content",
		"NEWS_COUNT" => "6",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC"
	)
);?>