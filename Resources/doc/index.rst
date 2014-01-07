-- app/config/config.yml

unno_yandex_maps:
    latitude: 37.619899                      - Default latitude value
    longitude: 55.753676                     - Default longitude value
    canvasZoom: 10                           - Map zoom value

    placemark:
        draggable: false                     - Should we be able to drag placemark
        geocoderFunction: yandexMapsGeocoder - Callable javascript function name, accepts two parameters map object,
                                               placemark object

    controls:
        zoom: true                           - Show zoom control
        zoomSmall: false                     - Show small zoom control
        scaleLine: false                     - Show scale line
        miniMap: true                        - Show mini map
        typeSelector: false                  - Show map type selector


-- example yandexMapsGeocoder function

yandexMapsGeocoder = function (yandexMap, yandexPlacemark) {
    var timeout, address, $inputStreet, $inputHouseNumber;

    var idStreet = 'admin_street';
    var idHouseNumber = 'admin_houseNumber';

    var idStreetValue = $('#' + idStreet).val();
    var idHouseNumberValue = $('#' + idHouseNumber).val();

    $('#' + idStreet + ', #' + idHouseNumber).on('keyup', function () {
        $inputStreet = $('#' + idStreet);
        $inputHouseNumber = $('#' + idHouseNumber);

        idStreetValue = $inputStreet.val();
        idHouseNumberValue = $inputHouseNumber.val();

        address  = 'Moscow, ';
        address += idStreetValue + (idHouseNumberValue ? ', ' + idHouseNumberValue : '');

        if ('' === idStreetValue || '' === idHouseNumberValue) {
            return;
        }

        clearTimeout(timeout);

        timeout = setTimeout(function () {
            (ymaps.geocode(
                address,
                {
                    results : 1
                }
            )).then(
                function (response) {
                    var geoObject = response.geoObjects.get(0);

                    if (geoObject) {
                        yandexPlacemark.geometry.setCoordinates(geoObject.geometry.getCoordinates());
                        yandexPlacemark.events.fire('dragend');
                    }
                },
                function (error) {
                    alert('Error: ' + error.message);
                }
            );
        }, 500);
    });
};