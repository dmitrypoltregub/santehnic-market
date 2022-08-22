<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetAdditionalCSS($APPLICATION->GetCurPage()."style.css", true);
$APPLICATION->AddHeadScript($APPLICATION->GetCurPage()."script.js");
?>
<?$api_key = htmlspecialcharsbx(Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key'));?>
<?$APPLICATION->AddHeadScript("https://api-maps.yandex.ru/2.1.50/?load=package.full&lang=ru&apikey={$api_key}" );?>

    <div class="contacts__list">

            <div class="contacts__box">
                <div class="contacts__map">

                    <div class="contacts__search contacts__search1">
                        <div class="contacts__icon" title="Проложить маршрут"></div>
                        <textarea placeholder="Откуда ехать" name="form-map-from" class="contacts__from" id="form-map-from-1"></textarea>
                    </div>
                    <div id="map-1" class="contacts__mapframe"></div>
                </div>
                <div class="contacts__left">
                    <div class="contacts__topic">Салон-магазин и пункт выдачи товаров "СтройМаркет"</div>
                    <div class="contacts__address">г. Москва, ст. м. Юго-Западная, ул.&nbsp;Покрышкина, д. 7, корп. 1</div>
                    <div class="contacts__time">Мы работаем ежедневно с 9:00 до 19:00</div>
                    <a class="contacts__email" href="mailto:santehnic-market@yandex.ru">santehnic-market@yandex.ru</a>
                    <a class="contacts__phone" href="tel:+7 (925) 334-61-38">+7 (925) 334-61-38</a>

                </div>
            </div>

        <script>ymaps.ready(init(1, 55.664609, 37.468192));</script>

    </div>

<style>
    .contacts {
       /* display: flex;
        justify-content: space-between;*/ }
    @media (max-width: 1023px) {
        .contacts {
            flex-direction: column; } }
    .contacts__leftside {
        width: 330px; }
    @media (max-width: 1023px) {
        .contacts__leftside {
            width: 100%; } }
    .contacts__rightside {
        width: calc(100% - 360px); }
    @media (max-width: 1023px) {
        .contacts__rightside {
            width: 100%; } }
    .contacts__left {
        background: #FFFFFF;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 28px 32px 30px 32px;
        max-width: 430px;
        position: relative;
        z-index: 2; }
    @media (max-width: 1199px) {
        .contacts__left {
            max-width: 330px; } }
    @media (max-width: 767px) {
        .contacts__left {
            border-radius: 0px;
            box-shadow: none;
            padding: 20px 20px 25px 20px; } }
    .contacts__topic {

        font-weight: bold;
        font-size: 24px;
        line-height: 135%;
        color: #000000;
        margin-bottom: 20px; }
    @media (max-width: 767px) {
        .contacts__topic {
            font-size: 20px;
            margin-bottom: 15px; } }
    .contacts__address, .contacts__time, .contacts__email {

        font-weight: 500;
        font-size: 14px;
        line-height: 145%;
        color: #000000;
        margin-bottom: 20px; }
    .contacts__address:last-child, .contacts__time:last-child, .contacts__email:last-child {
        margin-bottom: 0px; }
    @media (max-width: 767px) {
        .contacts__address, .contacts__time, .contacts__email {
            font-size: 12px;
            margin-bottom: 15px; } }
    .contacts__email {
        color: #09d;
        display: block; }
    .contacts__phone {
        display: inline-block;

        font-weight: 600;
        font-size: 16px;
        color: #09d;
        padding: 14px 26px;
        padding-left: 47px;
        border: 1px solid #09d;
        border-radius: 5px;
        background-position: left 26px center;
        background-image: url(./images/phone-contacts-one.svg);
        background-repeat: no-repeat; }
    @media (max-width: 767px) {
        .contacts__phone {
            font-size: 14px;
            padding: 10px 15px;
            padding-left: 35px;
            background-size: 11px;
            background-position: left 13px center; } }
    .contacts__box {
        border-radius: 10px;
        position: relative;
        padding: 6px;
        margin-bottom: 40px; }
    .contacts__box:last-child {
        margin-bottom: 0px; }
    @media (max-width: 767px) {
        .contacts__box {
            padding: 0px;
            margin-bottom: 25px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1); } }
    .contacts__map {
        border-radius: 10px;
        overflow: hidden;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%; }
    @media (max-width: 767px) {
        .contacts__map {
            position: relative;
            height: 240px;
            border-radius: 0px; } }
    .contacts__mapframe {
        width: 100%;
        height: 100% }
    .contacts__map iframe, .contacts__map > ymaps {
        width: 100%!important;
        height: 100%!important; }
    .contacts__search {
        position: absolute;
        right: 6px;
        top: 6px;
        z-index: 3;
        width: 100%; }
    .contacts__from {
        width: calc(100% - 58px);
        border-radius: 10px;
        height: 40px;
        resize: none;
        opacity: 1;
        padding: 9px 10px 3px;
        margin-right: 6px;
        float: right;
        box-shadow: 0px 4px 15px rgb(0 0 0 / 20%);
        display: none; }
    .contacts__icon {
        width: 40px;
        height: 40px;
        background: #fff url(./images/route.svg) 50% 50% / 80% 80% no-repeat;
        opacity: 0.7;
        border-radius: 10px;
        /*border: 1px solid #979797;*/
        cursor: pointer;
        float: right;
        /*box-shadow: 0px 4px 15px rgb(0 0 0 / 10%);*/
        overflow: hidden; }
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>