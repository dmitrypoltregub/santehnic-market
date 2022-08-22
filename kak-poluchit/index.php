<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация о доставке в Сантехник-Маркет");
\Bitrix\Main\Page\Asset::getInstance()->addJs('/kak-poluchit/script.js');
\Bitrix\Main\Page\Asset::getInstance()->addCss('/kak-poluchit/styles.css');
?>
<div class="delivery">
    <div class="delivery__tabs" data-delivery-tabs="">
        <div class="delivery__tab delivery__tab--active">Москва и МО</div>
        <div class="delivery__tab">Доставка по России</div>
    </div>
    <div class="delivery__list">
        <div class="delivery__box delivery__box--active" id="moscow">
    <p>Доставка осуществляется по Москве и Московской области на следующий день с момента подтверждения вашего заказа нашим оператором и при наличии данного товара у нас на складе (при условии оформления заказа до 19:00).</p>
    <p>Время доставки: с 9:00&nbsp;до 19:00 ежедневно.</p>
    <p><b>Внимание! </b>Доставка заказов свыше 5 кг осуществляется до подъезда. Подъем на этаж (при&nbsp;наличии&nbsp;лифта) оплачивается отдельно!</p>
    <p><b>Стоимость доставки:</b></p>
    <table class="marsh">
        <tr>
            <td></td>
            <td><b>в пределах МКАД</b></td>
            <td><b>за пределами&nbsp;МКАД</b></td>
        </tr>
        <tr>
            <td><b>меньше 20 000 р.</b></td>
            <td>450 р.</td>
            <td>450 р. + 30 р./км</td>
        </tr>
        <tr>
            <td><b>свыше 20 000 р.</b></td>
            <td>бесплатно</td>
            <td>бесплатно + 30 р./км</td>
        </tr>
    </table>


        </div>
        <div class="delivery__box" id="russia">
            <p>Наш магазин осуществляет доставку по всей России при помощи транспортной компании СДЭК.</p>

               <p>Стоимость и сроки доставки рассчитываются индивидуально по тарифной сетке СДЭК.</p>
        </div>
    </div>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>