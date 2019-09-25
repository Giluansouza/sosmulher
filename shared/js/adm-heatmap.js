    // This example requires the Visualization library. Include the libraries=visualization
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">
    var map, heatmap;
    var cdata = document.getElementById('data').innerHTML;
    var cdata = JSON.parse(cdata);
    var urlBase = "https://www.siageoba.com/storage/mapa/";
    var LatLng;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: -9.42719,lng: -40.49628,},
            mapTypeId: 'satellite'
        });

        var ctaLayer44 = new google.maps.KmlLayer({
            url: urlBase + 'AISP44.kmz',
            map: map
        });
        var ctaLayer46 = new google.maps.KmlLayer({
            url: urlBase + 'AISP46.kmz',
            map: map
        });
        var ctaLayer47 = new google.maps.KmlLayer({
            url: urlBase + 'AISP47.kmz',
            map: map
        });
        var ctaLayer53 = new google.maps.KmlLayer({
            url: urlBase + 'AISP53.kmz',
            map: map
        });

        Array.prototype.forEach.call(cdata, function(data, i) {
            LatLng = {lat: parseFloat(data['address']['latitude']), lng: parseFloat(data['address']['longitude'])};
            var marker = new google.maps.Marker({
                position: LatLng,
                icon: urlBase + '/icon-heat.png',
                title: 'Ocorrência',
                map: map
            });
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
            data: getPoints(),
            map: map
        });

        heatmap.set('radius', 40);
    }

    // Heatmap data: Dinamic Points
    function getPoints(){
                var final_data = new Array();
                for(var i = 0 ; i < cdata.length ; i++){
                    var a = cdata[i]['address']['latitude'];
                    var b = cdata[i]['address']['longitude'];
                    final_data.push(new google.maps.LatLng(a,b));
                }
                return final_data;
    };
