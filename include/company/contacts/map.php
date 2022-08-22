<?$APPLICATION->IncludeComponent(
                                    "bitrix:map.yandex.view", 
                                    ".default", 
                                    array(
                                            "INIT_MAP_TYPE" => "MAP",
                                            "MAP_DATA" => "a:3:{s:10:\"yandex_lat\";d:55.75999999999371;s:10:\"yandex_lon\";d:37.63999999999997;s:12:\"yandex_scale\";i:10;}",
                                            "MAP_WIDTH" => "100%",
                                            "MAP_HEIGHT" => "340",
                                            "CONTROLS" => array(
                                                    0 => "ZOOM",
                                                    1 => "SMALLZOOM",
                                                    2 => "MINIMAP",
                                                    3 => "TYPECONTROL",
                                                    4 => "SCALELINE",
                                            ),
                                            "OPTIONS" => array(
                                                    0 => "ENABLE_DRAGGING",
                                            ),
                                            "MAP_ID" => "yam_1",
                                            "COMPONENT_TEMPLATE" => ".default"
                                    ),
                                    false
                            );?>