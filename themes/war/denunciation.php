<?php $v->layout("_theme"); ?>

<!--==========================
    Intro Section
    ============================-->
    <section id="denun">
        <div class="intro-container wow fadeIn">
            <div class="row no-gutters">
                <div class="col-lg-12 venue-info">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-12">
                            <!-- <p>Envia sua localização para a viatura mais próxima deslocar de forma rápida para atender sua solicitção em caso de violência contra mulher.</p> -->
                            <h3 class="mb-4 pb-0"><span>Denúncia</span></h3>
                            <div class="ajax_response"><?= flash(); ?></div>
                            <form action="<?= url($app) ?>" method="post">
                                <?= csrf_input(); ?>
                                <div class="form-row mb-3">
                                    <select name="real_time" class="form-control" required="">
                                        <option value="">Ocorrência em andamento?</option>
                                        <option value="SIM">Sim</option>
                                        <option value="NAO">Não</option>
                                    </select>
                                </div>
                                <div class="form-row mb-3">
                                    <select name="plaintiff" class="form-control" required="">
                                        <option value="">Demandante</option>
                                        <option value="ANONIMO">Anônimo</option>
                                        <option value="VITIMA">Própria vitíma</option>
                                        <option value="FAMILIAR">Familiar</option>
                                        <option value="VIZINHO">Vizinho</option>
                                    </select>
                                </div>
                                <div class="form-row mb-3">
                                    <select name="precautionary_measure" class="form-control">
                                        <option value="">Vítima tem medida cautelar?</option>
                                        <option value="SIM">Sim</option>
                                        <option value="NAO">Não</option>
                                    </select>
                                </div>
                                <div class="form-row mb-3">
                                    <input type="text" class="form-control" name="name_victim" placeholder="Nome da vitíma" required="">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="text" class="form-control" name="name_accused" placeholder="Nome do acusado">
                                </div>
                                <div class="form-row mb-3">
                                    <textarea class="form-control" name="note" placeholder="Observação" required=""></textarea>
                                </div>
                                <a id="fill" href="#" class="button secondary-btn scrollto">Usar minha localização</a>
                                <div class="form-row mb-3">
                                    <input type="text" class="form-control" id="public_place" name="public_place" placeholder="Logradouro" required="">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="text" class="form-control" id="complement" name="complement" placeholder="Complemento">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" required="">
                                </div>
                                <input type="hidden" class="form-control" name="city_id" value="2623">
                                <input type="hidden" value="<?= $user->id??NULL ?>" class="form-control" name="users_id">
                                <input type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" class="form-control" name="ip_plaintiff">
                                <input type="hidden" class="form-control" id="plaintiff_coordinates" name="plaintiff_coordinates">
                                <input type="hidden" class="form-control" id="address_coordinates" name="coordinates" value="">
                                <button type="submit" class="primary-btn scrollto">Enviar denúncia</button>
                                <a href="<?= url($nav['link']) ?>" class="button secondary-btn scrollto">Voltar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="main">
        <!--==========================
          About Section
        ============================-->
        <section id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-4 justify-content-center">
                        <p id="geolocation">Você está em: <span> Não foi possível obter sua localização</span></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $v->start("scripts") ?>
    <script>
        var geocoder;
        var address;
        var lat;
        var lng;
        var options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        $('#fill').on('click', function(){
            // console.log(address[1].address_components[1]);
            $('#public_place').val(address[0].address_components[0].long_name+', '+address[0].address_components[1].long_name);
            $('#district').val(address[0].address_components[2].long_name);
            // Coordenadas do endereço da ocorrência
            $('#address_coordinates').val(lat+","+lng);
        });


        //google.maps.event.addDomListener(window, 'load', initialise);

        function getLocation()
        {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else {
                x.innerHTML = "O seu navegador não suporta Geolocalização.";
            }
        }

        function showPosition(position)
        {
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            // Coordenadas do denunciante
            $('#plaintiff_coordinates').val(lat+","+lng);
            geocodeLatLng(lat, lng);
        }

        function showError(error){
            switch(error.code){
                case error.PERMISSION_DENIED:
                  alert("Permissão negada para capturar coordenadas!");
                  break;
                case error.POSITION_UNAVAILABLE:
                  alert("Localização indisponível.");
                  break;
                case error.TIMEOUT:
                  alert("A requisição expirou.");
                  break;
                case error.UNKNOWN_ERROR:
                  alert("Algum erro desconhecido aconteceu.");
                  break;
            }
        }

        function initialise() {
            geocoder = new google.maps.Geocoder();
            getLocation();
        };

        function geocodeLatLng(lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        // console.log(results);
                        address = results;
                        $('#geolocation span').text(results[0].formatted_address);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: '+status);
                }
            });
        }

        // google.maps.event.addDomListener(window, 'load', initialise);
    </script>
    <!-- <script src="//maps.google.com/maps/api/js?key=<= CONF_APIKEY_MAPS ?>"></script> -->
    <script async defer
    src="//maps.googleapis.com/maps/api/js?key=AIzaSyAb_ZDqRKz79PYIsplkC9F8AqXMkEsM2-M&libraries=visualization&callback=initialise">
    </script>
<?php $v->end(); ?>
