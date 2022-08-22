<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Обмен и возврат товара");
$APPLICATION->SetPageProperty("keywords", "возврат товара, обмен товара");
$APPLICATION->SetPageProperty("description", "Как вернуть или обменять приобретенный товар");
$APPLICATION->SetTitle("Как вернуть или обменять приобретенный товар?");

$APPLICATION->SetAdditionalCSS($APPLICATION->GetCurPage()."style.css", true);
$APPLICATION->AddHeadScript($APPLICATION->GetCurPage()."script.js");
?>

    <div class="basic-layout__module intro-slider">

    </div>

    <div class="purchase__returns">
        <h3 class="return__title">Могу ли я вернуть или обменять товар?</h3>

        <p>Согласно ст. 26.1 Закона «О защите прав потребителей», вы вправе вернуть товар, приобретённый в онлайн-магазине, в течение семи дней после получения товара.</p>



        <div id="conditions">
            <div class="tab">
                <div class="head">Условия обмена и возврата товара надлежащего/ненадлежащего качества</div>
                <div class="body">
                    Товар надлежащего качества вы можете вернуть или обменять в сроки, установленные Законом «О защите прав потребителей», кроме изделий, входящих в перечень отдельных видов товаров, на которые данное право не распространяется (п. 55 Постановления Правительства РФ от 20.10.1998 N 1222,<br />
                    от 06.02.2002 N 81). Обратите внимание: товар надлежащего качества подлежит обмену или возврату, если сохранены его товарный вид, упаковка, потребительские свойства и все необходимые документы (гарантийные талоны, паспорт изделия и т.д.). В обратном случае товар обмену и возврату не подлежит (ЗоЗПП 25).<br />
                    Все обращения покупателей, связанные с вопросами обмена и возврата товара, принимаются в письменном виде (в т.ч. по электронной почте) и рассматриваются индивидуально в установленные действующим законодательством сроки.
                    Обмен товара или возврат денежных средств Покупателю осуществляется после проведения  экспертизы сервисного центра.<br />
                    Предъявление требования о возврате или обмене товара следует оформить в соответствующем заявлении. Данное заявление можно отправить по электронной почте info@krep-komp.ru, по факсу или заказным письмом, а также доставить в магазин.<br />
                    Согласно Закону «О защите прав потребителей», срок рассмотрения заявлений — до 10 дней. В этот срок с Покупателем связывается сотрудник отдела претензий для детального обсуждения и решения вопроса.
                    В случае если покупателем является юридическое лицо, обмен и возврат товара производится в соответствии с нормами Гражданского Кодекса РФ.
                </div>
            </div>

            <div class="tab">
                <div class="head">Гарантии и условия возврата товара ненадлежащего качества</div>
                <div class="body">
                    Товар ненадлежащего качества – это товар, имеющий недостаток или существенный недостаток.<br />
                    Недостаток товара – это несоответствие товара обязательным требованиям, предусмотренным законом или условиями договора, или целям, для которых товар используется, или образцу и/или описанию.
                    Существенный недостаток товара – это неустранимый недостаток либо недостаток, требующий несоразмерных расходов или затрат времени, либо выявленный неоднократно, либо появившийся вновь после его устранения.<br /><br />

                    При обнаружении недостатка потребитель вправе:<br /><br />
                    <ul>
                        <li>потребовать замены на товар той же марки/модели/артикула;</li>
                        <li>потребовать замены на такой же товар другой марки с соответствующим пересчетом цены;</li>
                        <li>потребовать соразмерного уменьшения цены;</li>
                        <li>потребовать безвозмездного устранения недостатка или возмещения затрат на устранение недостатка третьими лицами;</li>
                        <li>отказаться от исполнения договора купли-продажи и потребовать возврата уплаченной за товар суммы.</li>
                    </ul><br />

                    Воспользоваться этими правами потребитель может только в случае, если ненадлежащее качество не было оговорено продавцов при покупке. Если при покупке товара отдельные недостатки были оговорены, это не лишает потребителя права предъявить претензии по поводу других обнаруженных недостатков.<br />
                    Если для установки выхода товара из строя требуется дополнительная проверка/экспертиза, она должна быть произведена в течение 20 дней с момента предъявления требований.
                    Если у продавца отсутствует необходимый товар, замена товара ненадлежащего качества должна быть произведена в течение месяца со дня предъявления требований.<br />
                    При возврате товара ненадлежащего качества Клиенту возвращается полная стоимость товара и доставки. При наличии в заказе кондиционных товаров, стоимость доставки заказа Клиенту не возвращается.
                    Полученный товар должен соответствовать заявленному Продавцом описанию. Отличие элементов дизайна или оформления от заявленных в описании не является неисправностью или нефункциональностью товара.
                    Внешний вид и комплектность товара, а также комплектность всего заказа должны быть проверены получателем в момент доставки товара. При доставке товара, Вы ставите свою подпись в квитанции о доставке, в графе: «Заказ принял, комплектность полная, претензий к количеству и внешнему виду товара не имею».<br />
                    Будьте внимательны, т.к. после получения заказа претензии к внешним дефектам товара, его количеству, комплектности и товарному виду мы принять не сможем.
                </div>
            </div>

            <div class="tab">
                <div class="head">Возврат денежных средств</div>
                <div class="body">
                    Возврат денежных средств осуществляется в течение 10 дней со дня предъявления соответствующего требования ( ст. 22 Закона РФ «О защите прав потребителей» ). То есть, в течение 10 дней после того, Продавец получил возвращаемый товар, поступят деньги, затраченные на его покупку.<br />
                    Если осуществляется возврат средств на банковскую карту или электронный кошелек, то срок зачисления зависит от соответствующих правил конкретной платежной системы или банка эмитента.<br />
                    Обратите внимание, что, в зависимости от вида платежной системы, возврат денежных средств на счет плательщика может занять до 30 дней. Более подробную информацию вы можете получить в службе поддержки соответствующей платежной системы или банка-эмитента карты. Помните, что при возврате товара оплаченного банковской картой, возврат денежных средств производится только на ту карту, которой была оплачена оригинальная покупка.<br />
                    Если товар был оплачен наличными - деньги выплачиваются в день оформления возврата товара по рабочим дням.
                    <br /><br />
                    ! Могут быть удержаны комиссии за перевод денег банками-исполнителями платежа.
                </div>
            </div>

            <div class="tab">
                <div class="head">Отказ от услуги</div>
                <div class="body">
                    Право потребителя на расторжение договора об оказании услуги регламентируется статьей 32 федерального закона «О защите прав потребителей»<br /><br />
                    <ul>
                        <li>Потребитель вправе расторгнуть договор об оказании услуги в любое время, уплатив исполнителю часть цены пропорционально части оказанной услуги до получения извещения о расторжении указанного договора и возместив исполнителю расходы, произведенные им до этого момента в целях исполнения договора, если они не входят в указанную часть цены услуги;</li><br />
                    </ul>
                    Потребитель при обнаружении недостатков оказанной услуги вправе по своему выбору потребовать:<br /><br />
                    <ul>
                        <li>безвозмездного устранения недостатков;</li>
                        <li>соответствующего уменьшения цены;</li>
                        <li>возмещения понесенных им расходов по устранению недостатков своими силами или третьими лицами;</li>
                        <li>Потребитель вправе предъявлять требования, связанные с недостатками оказанной услуги, если они обнаружены в течение гарантийного срока, а при его отсутствии в разумный срок, в пределах двух лет со дня принятия оказанной услуги;</li>
                        <li>Исполнитель отвечает за недостатки услуги, на которую не установлен гарантийный срок, если потребитель докажет, что они возникли до ее принятия им или по причинам, возникшим до этого момента.</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

    <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>