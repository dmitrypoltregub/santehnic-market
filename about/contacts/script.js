function init(id, lat, lon) {

    getRoute = false;
    myRoute = false;

    return function () {
        window['myMap' + id] = new ymaps.Map('map-' + id, {
            center: [lat, lon],
            controls: [],
            zoom: 15
        }, {
        });

        if(window.innerWidth >= 767){
            var pixelCenter = window['myMap' + id].getGlobalPixelCenter();
            pixelCenter = [
                pixelCenter[0] - 220,
                pixelCenter[1] - 0
            ];
            var geoCenter = window['myMap' + id].options.get('projection').fromGlobalPixels(pixelCenter, window['myMap' + id].getZoom());
            window['myMap' + id].setCenter(geoCenter);
        }

        var myPlacemark = new ymaps.Placemark([lat, lon], {
            hintContent: '',
            balloonContent: ''
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            //iconImageHref: template_url + '/images/shop_label.svg',
            // Размеры метки.
            iconImageSize: [30, 30],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-15, -15]
        });

        window['myMap' + id].geoObjects.add(myPlacemark);

        window['suggestView' + id] = new ymaps.SuggestView('form-map-from-' + id);

        myCollection = new ymaps.GeoObjectCollection({}, {
            preset: 'islands#blueIcon', //все метки красные
            draggable: false, // и их можно перемещать
        });

        window['suggestView' + id].events.add("select", function(e) {
            ymaps.geocode(e.get('item').value).then(function (res) {

                if (getRoute) {
                    //myCollection.remove(myPlacemark2);
                    if (myRoute) window['myMap' + id].geoObjects.remove(myRoute);
                    console.log(myRoute);
                }

                myPlacemark2 = new ymaps.Placemark(res.geoObjects.get(0).geometry.getCoordinates(), {}, {
                    preset: 'islands#circleIcon',
                    iconColor: '#4F36E3'
                });


                // добавляем коллекцию на карту
                window['myMap' + id].geoObjects.add(myCollection);


                //myCollection.add(myPlacemark2);
                //console.log(res.geoObjects.get(0).geometry.getCoordinates());

                $('.contacts__from').val('');
                $('.contacts__icon').show();
                $('.contacts__from').hide();


                var start_point = [lat, lon];
                var end_point = res.geoObjects.get(0).geometry.getCoordinates();
                ymaps.route([start_point, end_point], {
                    mapStateAutoApply: false,
                    avoidTrafficJams: false,
                    multiRoute: false,
                    routingMode: "auto",
                    viaIndexes: []
                }).then(function (route) {
                    /*route.getPaths().options.set('strokeColor', '#552FEC');*/
                    var points = route.getWayPoints();
                    points.get(0).properties.set('balloonContent', 'Дистанция: ' + route.getHumanLength() + '. Продолжительность: ' + route.getHumanTime() + '.');
                    points.get(1).properties.set('balloonContent', 'Дистанция: ' + route.getHumanLength() + '. Продолжительность: ' + route.getHumanTime() + '.');
                    points.get(0).properties.set('iconContent', '');
                    points.get(1).properties.set('iconContent', '');
                    points.get(0).options.set('iconColor', '#4F36E3');
                    points.get(1).options.set('iconColor', '#4F36E3');
                    points.get(0).options.set('preset', 'islands#circleIcon');
                    points.get(1).options.set('preset', 'islands#circleIcon');
                    points.get(0).options.set('visible', false);
                    points.get(1).options.set('visible', true);
                    window['myMap' + id].geoObjects.add(myRoute = route);
                    window['myMap' + id].setCenter([end_point[0], end_point[1]]);

                    if(window.innerWidth >= 767){
                        var pixelCenter = window['myMap' + id].getGlobalPixelCenter();
                        pixelCenter = [
                            pixelCenter[0] - 220,
                            pixelCenter[1] - 0
                        ];
                        var geoCenter = window['myMap' + id].options.get('projection').fromGlobalPixels(pixelCenter, window['myMap' + id].getZoom());
                        window['myMap' + id].setCenter(geoCenter);
                    }


                }, function (error) {
                    // Ошибка error.message
                });

                getRoute = true;

            });


        });

    }
}











$(document).ready(function() {
    $('.contacts__icon').click(function() {
        //$(this).hide();
        $(this).parent().children('.contacts__from').toggle(300);
    });
});