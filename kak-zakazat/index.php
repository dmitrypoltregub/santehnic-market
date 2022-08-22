<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пункт самовывоза в Сантехник-Маркет");
?>

    <div>

    <p>Товар можно забрать&nbsp;на пункте&nbsp;выдачи нашего магазина с 9:00 до 19:00&nbsp;ежедневно.</p>
    <p>При самовывозе, также необходимо оформить заказ на сайте или по тел.&nbsp;+7 (925) 334&nbsp;- 61&nbsp;- 38&nbsp.</p>
	<p>Забор товара в пункте самовывоза без предварительного оформления заказа - невозможен.</p>
    <p>После оформления заказа, с вами свяжется наш оператор для уточнения времени и даты самовывоза.</p>
	После оформления заказа, с вами свяжется наш оператор</span><br>

    </div>
    <div>

            <p><b>Адрес&nbsp;пункта&nbsp;самовывоза:</b></p>
            <p>
                Строительный магазин – “СтройМаркет” (метро Юго-Западная, улица Покрышкина д. 7, корп. 1) - 10 мин. пешком от метро Юго-Западная
            </p>
            <p><b>Как добраться общественным транспортом:</b></p>
            <p>
                От ст.&nbsp;метро&nbsp; “Юго-Западная”
            </p>
            <table class="marsh">
                <tr>
                    <td>автобусы</td>
                    <td>троллейбусы</td>
                    <td>маршрутки</td>
                </tr>
                <tr>
                    <td>720, 226, 261, 630</td>
                    <td>62, 84</td>
                    <td>330м, 374м, 510м, 629м, 630м</td>
                </tr>
            </table>

    </div>
<br>
<?$APPLICATION->IncludeComponent(
    "bitrix:map.yandex.view",
    "",
    Array(
        "INIT_MAP_TYPE" => "MAP",
        "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.6651486947028;s:10:\"yandex_lon\";d:37.46854389682009;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.46817911639406;s:3:\"LAT\";d:55.66466960866945;s:4:\"TEXT\";s:31:\"САНТЕХНИК-МАРКЕТ\";}}}",
        "MAP_WIDTH" => "600",
        "MAP_HEIGHT" => "500",
        "CONTROLS" => array(0=>"ZOOM",1=>"MINIMAP",2=>"TYPECONTROL",3=>"SCALELINE",),
        "OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DBLCLICK_ZOOM",2=>"ENABLE_DRAGGING",),
        "MAP_ID" => ""
    )
);?>
    <p>
        <span style="color: #4d4d4d;"><a href="https://maps.yandex.ru/213/moscow/?ll=37.468403%2C55.664573&z=17"></a></span>
    </p>
    <style>
        .marsh{

        }
        .marsh td{
            border:4px solid #f9f9f9;

            padding: 7px;
        }
    </style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>