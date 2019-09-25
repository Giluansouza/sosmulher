var geocoder;
var cdata = document.getElementById('data').innerHTML;
cdata = JSON.parse(cdata);

function dateFormatES8(date){
    var data = new Date(date),
        dia  = data.getDate().toString().padStart(2, '0'),
        mes  = (data.getMonth()+1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
        ano  = data.getFullYear();
    return dia+"/"+mes+"/"+ano;
}

function initialise() {

    var coordinates = cdata['plaintiff_coordinates'].split(",");
    var urlBase = "https://siageoba.com/storage/mapa/";
    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 300
    });
    // MAPA INICIAL
    map = new GMaps({
        div: '#map2',
        lat: -9.42719,
        lng: -40.49628,
        zoom: 12
    });

    var marker = map.addMarker({
        lat: coordinates[0],
        lng: coordinates[1],
        // icon: urlBase + '/icone-cvli2.png',
        title: 'Ocorrência'
    });

    marker.addListener('click', function() {
        infoWindow.setContent("Endereço Localizado");
        infoWindow.open(map, marker);
    });
}

google.maps.event.addDomListener(window, 'load', initialise);
