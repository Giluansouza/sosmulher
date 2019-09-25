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

    var urlBase = "https://www.siageoba.com/storage/mapa/";
    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 350
    });
    var count = 0;
    // MAPA INICIAL
    map = new GMaps({
        div: '#map2',
        lat: -9.422289,
        lng: -40.510784,
        zoom: 12
    });

    map.loadFromKML({
        url: urlBase + 'AISP44.kmz' //AISP 47
    });
    map.loadFromKML({
        url: urlBase + 'AISP46.kmz' //AISP 47
    });
    map.loadFromKML({
        url: urlBase + 'AISP47.kmz' //AISP 47
    });
    map.loadFromKML({
        url: urlBase + 'AISP53.kmz'
    });

    Array.prototype.forEach.call(cdata, function(data, i) {

        var content = document.createElement('div');
        var strong = document.createElement('strong');
        data['date_fact'] = dateFormatES8(data['date_fact']);

        content =
        '<div id="iw-container">' +
            '<div class="row bg-dark text-white p-2">'+
                '<div class="col-md-4 d-none d-sm-block">'+
                    '<img src="'+urlBase+'/icone-cvli2.png"> CVLI'+
                '</div>'+
                '<div class="col-md-8">'+
                    '<b>Data do Fato:</b>'+data['date_fact']+
                    '<br><b>Hora do Fato:</b>'+data['fact_time']+
                '</div>'+
            '</div>'+
            '<div class="iw-content">'+
                '<b>Vítima(s)</b><br>';
            Array.prototype.forEach.call(data['people'], function(pdata, i) {
                count++;
                content += '<div class="iw-subTitle">'+count+' - '+pdata['name']+'</div>'+
                    '<b>Data de Nascimento: </b>'+(dateFormatES8(pdata['date_birth']))+
                    '<br><b>Antecedentes: </b>'+pdata['criminal_record']+
                    '<br><b>Naturalidade: </b>'+pdata['naturalness']+
                    '<hr>';
            });
        content +=
                '<b>Local do Fato</b><br>'+
                    data['address']['public_place']+
                '<hr>'+
                '<b>Motivação: </b>'+data['motivation']+
                '<br><b>Arma Utilizada: </b>'+data['weapon']+
                '<br><b>Veículo: </b>'+data['type_vehicle']+
                '<br><b>Histórico: </b>'+data['comments'];
            '</div>' +
            '<div class="iw-bottom-gradient"></div>' +
        '</div>';

        var marker = map.addMarker({
            lat: data['address']['latitude'],
            lng: data['address']['longitude'],
            icon: urlBase + '/icone-cvli2.png',
            title: 'Ocorrência'
        });

        marker.addListener('click', function() {
            // Referência ao DIV que agrupa o fundo da infowindow
            var iwOuter = $('.gm-style-iw');
            //  Uma vez que o div pretendido está numa posição anterior ao div .gm-style-iw.
            // * Recorremos ao jQuery e criamos uma variável iwBackground,
            // * e aproveitamos a referência já existente do .gm-style-iw para obter o div anterior com .prev().
            var iwBackground = iwOuter.prev();
            // Remover o div da sombra do fundo
            iwBackground.children(':nth-child(2)').css({'display' : 'none'});
            // Remover o div de fundo branco
            iwBackground.children(':nth-child(4)').css({'display' : 'none'});
            // Desloca a infowindow 115px para a direita
            iwOuter.parent().parent().css({left: '115px'});
            // Desloca a sombra da seta a 76px da margem esquerda
            iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
            // Desloca a seta a 76px da margem esquerda
            iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
            // Altera a cor desejada para a sombra da cauda
            iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
            // Referência ao DIV que agrupa os elementos do botão fechar
            var iwCloseBtn = iwOuter.next();
            // Aplica o efeito desejado ao botão fechar
            iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
            // Se o conteúdo da infowindow não ultrapassar a altura máxima definida, então o gradiente é removido.
            if($('.iw-content').height() < 140){
                $('.iw-bottom-gradient').css({display: 'none'});
            }
            // A API aplica automaticamente 0.7 de opacidade ao botão após o evento mouseout. Esta função reverte esse evento para o valor desejado.
            iwCloseBtn.mouseout(function(){
              $(this).css({opacity: '1'});
            });

            infoWindow.setContent(content);
            infoWindow.open(map, marker);
        });
    });
}

google.maps.event.addDomListener(window, 'load', initialise);
