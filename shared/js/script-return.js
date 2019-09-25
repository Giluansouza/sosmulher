    urlcurrent = 'https://www.localhost/siageo';
    // urlcurrent = 'https://www.siageoba.com';
    // LISTA ANINHADA PRA BAIRRO/DISTRITO
    $(document).on('change', '#city_id', function(e) {
        var cityId = $(this).val();
        $.ajax({
            type: "GET",
            data: "city_id=" + cityId,
            url: urlcurrent+"/shared/views/ajax/return-districts.php",
        }).done(function(data) {
            $('#district_id').html(data);
        })
    });

    // function returnDataUf(data) {
    //     var dataOne = "<option value='' selected>-- Selecionar um estado</option>";
    //     $.each(data, function(chave, valor) {
    //         dataOne += "<option value='"+ valor.id + "'>" + valor.name + "</option>";
    //     });
    //     $('#uf').html(dataOne);
    // }
    // $(document).on('change', '#uf', function(e) {
    //     var statesId = $(this).val();
    //     $.ajax({
    //         type: "GET",
    //         data: "states_id=" + statesId,
    //         url: urlcurrent+"/shared/views/ajax/return-city-list.php",
    //     }).done(function(data) {
    //         $('#city').html(data);
    //     })
    // });

    function returnDataUf(data) {
        var dataOne = "<option value='' selected>-- Selecionar um estado</option>";
        $.each(data, function(chave, valor) {
            dataOne += "<option value='"+ valor.id + "'>" + valor.name + "</option>";
        });
        $('.people_uf').html(dataOne);
        // console.log(data);
    }

    $(document).on('change', '.people_uf', function(e) {
        var statesId = $(this).val();
        $.ajax({
            type: "GET",
            data: "states_id=" + statesId,
            url: urlcurrent+"/shared/views/ajax/return-city-list.php",
        }).done(function(data) {
            $('.people_city').html(data);
        })
    });
