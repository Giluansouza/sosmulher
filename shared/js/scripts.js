urlcurrent = 'https://www.localhost/siageo';
// urlcurrent = 'https://www.siageoba.com';
$(function () {
    // mobile menu open
    $(".j_menu_mobile_open").click(function (e) {
        e.preventDefault();

        $(".j_menu_mobile_tab").css("left", "auto").fadeIn(1).animate({"right": "0"}, 200);
    });

    // mobile menu close
    $(".j_menu_mobile_close").click(function (e) {
        e.preventDefault();

        $(".j_menu_mobile_tab").animate({"left": "100%"}, 200, function () {
            $(".j_menu_mobile_tab").css({
                "right": "auto",
                "display": "none"
            });
        });
    });

    // scroll animate
    $("[data-go]").click(function (e) {
        e.preventDefault();

        var goto = $($(this).data("go")).offset().top;
        $("html, body").animate({scrollTop: goto}, goto / 2, "easeOutBounce");
    });

    // modal open
    $("[data-modal]").click(function (e) {
        e.preventDefault();

        var modal = $(this).data("modal");
        $(modal).fadeIn(200).css("display", "flex");
    });

    // modal close
    $(".j_modal_close").click(function (e) {
        e.preventDefault();

        if ($(e.target).hasClass("j_modal_close")) {
            $(".j_modal_close").fadeOut(200);
        }

        var iframe = $(this).find("iframe");
        if (iframe) {
            iframe.attr("src", iframe.attr("src"));
        }
    });

    // collpase
    $(".j_collapse").click(function () {
        var collapse = $(this);

        collapse.parents().find(".j_collapse_icon").removeClass("icon-minus").addClass("icon-plus");
        collapse.find(".j_collapse_icon").removeClass("icon-plus").addClass("icon-minus");

        if (collapse.find(".j_collapse_box").is(":visible")) {
            collapse.find(".j_collapse_box").slideUp(200);
        } else {
            collapse.parent().find(".j_collapse_box").slideUp(200);
            collapse.find(".j_collapse_box").slideDown(200);
        }
    });

    //ajax form
    $("form:not('.ajax_off')").on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var load = $(".ajax_load");
        var flashClass = "ajax_response";
        var flash = $("." + flashClass);

        $('html').animate({scrollTop: 0}, 1000);

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
    })
});

// var tempo = new Number();
// // Tempo em segundos
// tempo = 60*30;
// function startCountdown(){
//     // Se o tempo não for zerado
//     if((tempo - 1) >= 0){
//         // Pega a parte inteira dos minutos
//         var min = parseInt(tempo/60);
//         // Calcula os segundos restantes
//         var seg = tempo%60;
//         // Formata o número menor que dez, ex: 08, 07, ...
//         if(min < 10){
//             min = "0"+min;
//             min = min.substr(0, 2);
//         }
//         if(seg <= 9){
//             seg = "0"+seg;
//         }
//         // Cria a variável para formatar no estilo hora/cronômetro
//         horaImprimivel = min + ':' + seg;
//         //JQuery pra setar o valor
//         $("#sessao").html(horaImprimivel);
//         // Define que a função será executada novamente em 1000ms = 1 segundo
//         setTimeout('startCountdown()',1000);

//         if(tempo < 30 && seg > 28){
//             Swal.fire({
//                 title: 'Sua sessão vai expirar!',
//                 text: "Deseja permanecer conectado?",
//                 type: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Permanecer conectado!',
//                 cancelButtonText: 'Sair agora!'
//             }).then((result) => {
//                 if (result.value) {
//                     tempo = 60*15;
//                 } else {
//                     window.location.href = urlcurrent+"/sair";
//                 }
//             })
//         }
//         // diminui o tempo
//         tempo--;
//     } else {// Quando o contador chegar a zero faz esta açãos
//         window.location.href = urlcurrent+"/expired";
//     }
// }
// // Chama a função ao carregar a tela
// startCountdown();
