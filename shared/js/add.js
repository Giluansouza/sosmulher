$(document).ready(function() {
    function getBaseUrl(){
        // Nome do host
        var hostName = location.hostname;
        if(hostName === "www.localhost"){
            // Endereço após o domínio do site
            pathname = window.location.pathname;
            // Separa o pathname com uma barra transformando o resultado em um array
            splitPath = pathname.split('/');
            // Obtém o segundo valor do array, que é o nome da pasta do servidor local
            path = splitPath[1];
            baseUrl = "https://" + hostName + "/" + path;
        }else{
            baseUrl = "https://" + hostName;
        }
        return baseUrl;
    }
    urlbase = getBaseUrl();
    var max = 6;
    var x = 0;

    // FUNÇÃO PARA CONSULTA SEM REFRESH PÁGINA OCORRÊNCIA
    function searchOccurence(id,r){
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: urlbase+"/shared/views/ajax/occurrence-file.php",
            data: {id: id,r:r},
            success: function(data){
                $('#searchResult').html(data);
            }
        })
    }

    // ABRIR MODAL PARA CONSULTA DE OCORRÊNCIAS
    $('.btnOpenOccurrence').on('click', function(e){
        e.preventDefault();
        var url = this.href;
        url = url.split('?id=');
        url = url[1].split('&r=');
        id  = url[0];
        r   = url[1];
        searchOccurence(id,r);
        $('#modalOccurrence').modal('show');
    });
/**
* ###                         FUNÇÕES DE OCORRÊNCIA                        ###
* ############################################################################
*/
    if ($('#listType').length) {
        var list = document.getElementById('listType').innerHTML;
        list = JSON.parse(list);

        var option = '<option value="">-- Selecione Tipo de Ocorrência</option>';
        $.each(list, function(i,val){
            // console.log(val.id+val.name);
            option += '<option value="'+val.id+'">'+val.name+'</option>';
        })
    }

    // Remover o div anterior
    $('#victim').on("click",".remove",function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().parent('div').remove();
        x--;
    });

    // Remover o div anterior
    $('#suspect').on("click",".sremove",function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().parent('div').remove();
        x--;
    });

    // BOTÃO NO MODAL PARA INSERIR PESSOAS EM OCORRÊNCIAS
    $(document).on('click', '#include-victim', function(e){
        e.preventDefault();
        if (x < max) {
            var dad  = $(this).parents('tr:eq(0)');
            var id   = dad.find('.id').text();
            var name = dad.find('.name').text();

            $('#victim')
            .append(
                '<div class="form-row">\
                    <div class="col-sm-6">\
                        <label for="name">Nome da vitíma</label>\
                        <div class="input-group">\
                            <span class="input-group-btn">\
                                <a href="#" class="btn btn-danger mb-2 remove"><i class="fas fa-trash"></i></a>\
                            </span>\
                            <input type="text" class="form-control name'+x+'" value='+name+'" readonly>\
                        </div>\
                        <input type="hidden" class="people_id'+x+'" name="people_id[]" value="'+id+'">\
                    </div>\
                    <div class="col-sm-3">\
                        <label for="involviment">Envolvimento</label>\
                        <input type="text" name="involvement[]" class="form-control" id="involviment" placeholder="Envolvimento" value="VITIMA" readonly="">\
                    </div>\
                    <div class="col-sm-3">\
                        <label for="city_id">Tipo de Ocorrência</label>\
                        <select name="occurrence_type_id[]" id="occurrence_type_id" class="form-control">\
                            '+option+'\
                        </select>\
                    </div>\
                </div>');

            $('.name'+x).val(name);
            $('.people_id'+x).val(id);
            x++;
        } else {
            alert("Número máximo permitido!");
        }
    });

    $(document).on('click', '#include-accused', function(e){
        e.preventDefault();
        if (x < max) {
            var dad  = $(this).parents('tr:eq(0)');
            var id   = dad.find('.id').text();
            var name = dad.find('.name').text();

            $('#suspect')
                .append(
                    '<div class="form-row">\
                        <div class="col-sm-6">\
                            <label for="name">Nome da vitíma</label>\
                            <div class="input-group">\
                                <span class="input-group-btn">\
                                    <a href="#" class="btn btn-danger mb-2 sremove"><i class="fa fa-trash"></i></a>\
                                </span>\
                                <input type="text" class="form-control sname'+x+'" placeholder="Nome completo do suspeito" readonly>\
                            </div>\
                                <input type="hidden" id="speople_id'+x+'" name="people_id[]" value="'+id+'">\
                        </div>\
                        <div class="col-sm-3">\
                            <label for="involviment">Envolvimento</label>\
                            <input type="text" name="involvement[]" class="form-control" id="involviment" placeholder="Envolvimento" value="SUSPEITO" readonly="">\
                        </div>\
                        <div class="col-sm-3">\
                        <label for="city_id">Tipo de Ocorrência</label>\
                        <select name="occurrence_type_id[]" id="occurrence_type_id" class="form-control">\
                            '+option+'\
                        </select>\
                    </div>\
                    </div>');
            $('.sname'+x).val(name);
            $('.speople_id'+x).val(id);
            x++;
        } else {
            alert("Número máximo permitido!");
        }
    });

    // ----------------------------------------------
    // CADASTRAR PESSOA A PARTIR DA PÁGINA OCORRÊNCIA
    // $(document).on('click', "#btnOpenPeople", function(e){
    //         e.preventDefault();
    //         $('#modalPeopleCreate').modal('show');
    //     });

    //     // ABRIR MODAL PARA CONSULTA DE PESSOAS
    //     $(document).on('click', '.btnPersonalRecord', function(event){
    //         event.preventDefault();
    //         var url = this.href;
    //         url = url.split('?id=');
    //         url = url[1];
    //         searchPersonalFile(url);
    //         $('#modalPeople').modal('show');
    //     });

    //     // FUNÇÃO PARA CONSULTA SEM REFRESH PÁGINA OCORRÊNCIA
    //     function searchPersonalFile(id){
    //         $.ajax({
    //             type: 'GET',
    //             dataType: 'html',
    //             url: urlcurrent+"/shared/views/ajax/people/personal-file.php",
    //             data: {id: id},
    //             success: function(data){
    //                 $('#resultPersonal').html(data);
    //             }
    //         })
    //     }

    //     function peopleCreate(array){
    //         $.ajax({
    //             type: 'POST',
    //             dataType: 'json',
    //             url: urlcurrent+"/shared/views/ajax/people/people-create.php",
    //             data: array,
    //             success: function(data){
    //                 $('#resultPeopleCreate').html(data.message);
    //             }
    //         })
    //     }
    //     // BOTÃO DE CADASTRO DE PESSOA NA PÁGINA OCORRÊNCIA
    //     $(document).on('click', "#btnPeopleCreate", function(e){
    //         e.preventDefault();

    //         var data = $("#form").serialize();
    //         peopleCreate(data);
    //         $('#modalPeopleCreate').animate({scrollTop: 0}, 1000);
    //     });

    //     $(document).on('click', '.closeModal', function(){
    //         $('#form input').val('');
    //         $('#form select').val('');
    //         $('#resultPeopleCreate').text('');
    //     }) ;

});
