urlcurrent = 'https://www.localhost/siageo';
// urlcurrent = 'https://www.siageoba.com';
// FUNÇÃO PARA CONSULTA SEM REFRESH PÁGINA OCORRÊNCIA
function searchPage(name, birth, mother, page = 1){
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: urlcurrent+"/themes/app/views/people/ajax/ajax-query.php",
        data: {name: name, birth: birth, mother: mother, page: page},
        success: function(data){
            $('#searchResult').html(data);
        }
    })
}
// CONSULTAR PESSOAS NO MODAL DE PESQUISA DE INDIVIDUOS
$('#btnSearchPg').on('click', function(e){
    e.preventDefault();
    searchPage($('#searchName').val(), $('#searchBirth').val(), $('#searchMother').val());
});
// PAGINAÇÃO
$(document).on('click', '.paginator_item', function(e){
    e.preventDefault();
    var page = $(this).attr('id');
    searchPage($('#searchName').val(), $('#searchBirth').val(), $('#searchMother').val(), page);
});
