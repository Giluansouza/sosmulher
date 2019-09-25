<?php $v->layout("_theme"); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Lista de Cidades</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= url("/dev") ?>">Início</a></li>
                <li class="breadcrumb-item active">Lista de Cidades</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="ajax_response"><?= flash(); ?></div>
<?php if (!$cities->isEmpty()): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <span class="pull-right">
                        <a href="<?= url('/dev/associar-cidade') ?>" class="btn btn-sm btn-success"><i class="fas fa-plug"></i> Associar Cidade com Unidade</a>
                    </span>
                    <h3><i class="fa fa-city"></i> Lista de Cidades Cadastradas</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-xl">
                        <thead>
                            <tr>
                                <th scope="col">Ação</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">Unidade Responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cities as $list => $value): ?>
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-navicon bigfonts" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="<?= url("app/editar-ocorrencia/{$value->id}") ?>"><i class="fa fa-pencil text-warning" aria-hidden="true"></i> Editar</a>
                                                    <a class="dropdown-item confirmDelete" href="<?= url("app/remover-ocorrencia/{$value->id}") ?>" role="button"><i class="fa fa-times text-danger" aria-hidden="true"></i> Excluir</a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Ficha</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><a href="<?= url("/dev/cidade/{$value->city_id}/bairros") ?>"><?= mb_strtoupper($value->Cities->name) ?></a></td>
                                        <td><?= mb_strtoupper($value->Units->name) ?></td>
                                    <tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?= $paginator ?>
                </div>
            </div><!-- end card-->
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <p>Nenhuma assaciação encontrada</p>
                    <a href="<?= url('/admin/associar-cidade') ?>" class="btn btn-primary">Associar Cidade com Unidade</a>
                </div>
            </div><!-- end card-->
        </div>
    </div>
<?php endif ?>
    <?php $v->start('scripts'); ?>
    <script src="<?= theme("/../superadmin/assets/plugins/sweetalert2/sweetalert2.min.js"); ?>"></script>
    <script>
        // $(document).ready(function(){
        //     $('.confirmDelete').click(function(e){
        //         e.preventDefault();
        //         swal({
        //             title: "Você tem certeza?",
        //             text: "Uma vez excluído, você não terá mais acesso a essa informação!",
        //             icon: "warning",
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 swal("Poof! Apagado com sucesso!", {
        //                     icon: "success",
        //                     buttons: false
        //                 });
        //                 setTimeout(window.location.replace($(this).attr('href')), 8);
        //             } //else {
        //             //     swal("Your imaginary file is safe!");
        //             // }
        //         });
        //     });
        // });
    </script>
    <?php $v->end(); ?>
