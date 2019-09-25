//$(document).ready(function(){
// ABRIR MODAL PARA CONSULTA DE PESSOAS EM OCORRÊNCIAS
    urlcurrent = 'https://www.localhost/siageo';
    // urlcurrent = 'https://www.siageoba.com';

    $('.btnOpenSearchPeople').on('click', function(e){
        e.preventDefault();
        $('#modalSearchPeople').modal('show');
    });
    // FUNÇÃO PARA CONSULTA SEM REFRESH PÁGINA OCORRÊNCIA
    function search(name, birth, mother, page = 1){
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: urlcurrent+"/themes/app/views/people/ajax/ajax-list.php",
            data: {name: name, birth: birth, mother: mother, page: page},
            success: function(data){
                $('#searchResult').html(data);
            }
        })
    }
    // CONSULTAR PESSOAS NO MODAL DE PESQUISA DE INDIVIDUOS
    $('#btnSearch').on('click', function(e){
        e.preventDefault();
        search($('#searchName').val(), $('#searchBirth').val(), $('#searchMother').val());
    });
    // PAGINAÇÃO
    $(document).on('click', '.paginator_item', function(e){
        e.preventDefault();
        var page = $(this).attr('id');
        search($('#searchName').val(), $('#searchBirth').val(), $('#searchMother').val(), page);
    });
//}
