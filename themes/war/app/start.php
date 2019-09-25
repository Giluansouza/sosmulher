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
                        <form class="ajax_off" id="confirmPanic" action="<?= url("app/panico") ?>" method="post">
                            <?= csrf_input(); ?>
                            <input type="hidden" value="<?= $user->id??"" ?>" class="form-control" name="users_id">
                            <input type="hidden" value="1" class="form-control" name="type">
                            <input type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" class="form-control" name="ip_plaintiff">
                            <input type="hidden" class="form-control" id="plaintiff_coordinates" name="plaintiff_coordinates">
                            <button type="submit" class="play-btn mb-4"></button>
                            <p>Botão do Pânico</p>
                        </form>
                        <a href="<?= url("app/denuncia") ?>" class="play-btn mb-4"></a>
                        <p>Denúncia</p>
                        <a href="<?= url("/instrucoes") ?>" class="play-btn mb-4"></a>
                        <p>Sobre/Instruções</p>
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
                <div class="col-12 col-lg-4 text-center">
                    <p id="geolocation">Você está em: <span> Não foi possível obter sua localização</span></p>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $v->start("scripts") ?>
    <script src="<?= theme("assets/plugins/sweetalert2/sweetalert2.min.js"); ?>"></script>
    <script>
        $(document).ready(function(){
            var form = $('#confirmPanic');

            form.on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                var load = $(".ajax_load");
                var flashClass = "ajax_response";
                var flash = $("." + flashClass);
                Swal.fire({
                    title: 'Enviar Localização?',
                    text: "Deseja informar sua localização atual para a polícia?",
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, enviar!',
                    cancelButtonText: 'Cancelar!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Sucesso!',
                            'Sua localização foi enviada com sucesso, polícia a caminho!',
                            'success'
                        )

                        form.ajaxSubmit({
                            url: form.attr("action"),
                            type: "POST",
                            dataType: "json",
                            beforeSend: function () {
                                load.fadeIn(200).css("display", "flex");
                            },
                            success: function (response) {
                                //redirect
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                }

                                //message
                                if (response.message) {
                                    if (flash.length) {
                                        flash.html(response.message).fadeIn(100).effect("bounce", 300);
                                    } else {
                                        form.prepend("<div class='" + flashClass + "'>" + response.message + "</div>")
                                            .find("." + flashClass).effect("bounce", 300);
                                    }
                                } else {
                                    flash.fadeOut(100);
                                }
                            },
                            complete: function () {
                                load.fadeOut(200);

                                if (form.data("reset") === true) {
                                    form.trigger("reset");
                                }
                            }
                        });
                    }
                });
            });
        });

        var geocoder;
        var lat;
        var lng;
        var options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        getLocation();

        function getLocation()
        {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else {
                x.innerHTML="O seu navegador não suporta Geolocalização.";
            }
        }

        function showPosition(position)
        {
            // console.log(position.coords.latitude);
            lat = position.coords.latitude;
            lng = position.coords.longitude;
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
                    alert("Erro desconhecido.");
                    break;
            }
        }

        function initialise() {
            geocoder = new google.maps.Geocoder();
        };

        function geocodeLatLng(lat, lng) {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'location': latlng}, function(results, status){
                if (status === 'OK') {
                    if (results[0]) {
                        // console.log(results);
                        $('#geolocation span').text(results[0].formatted_address);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: '+status);
                }
            });
        }
    </script>
    <script async defer
    src="//maps.googleapis.com/maps/api/js?key=AIzaSyAb_ZDqRKz79PYIsplkC9F8AqXMkEsM2-M&libraries=visualization&callback=initialise">
    </script>
<?php $v->end(); ?>
