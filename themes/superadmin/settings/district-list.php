<?php $v->layout("_theme"); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Lista de Bairros e Distritos</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= url("/dev") ?>">Início</a></li>
                <li class="breadcrumb-item active"><a href="<?= url("/dev/lista-cidades") ?>">Lista de Cidades</a></li>
                <li class="breadcrumb-item active">Lista de Bairros e Distritos</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="ajax_response"><?= flash(); ?></div>
<?php if (!$districts->isEmpty()): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <span class="pull-right">
                        <a href="<?= url("/dev/cidade/bairro/cadastro") ?>" class="btn btn-sm btn-success">Cadastrar Bairro/Distrito</a>
                    </span>
                    <h3><i class="fa fa-users"></i> Bairros/Distritos</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-xl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">Unidade</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($districts as $list => $value): ?>
                                    <tr>
                                        <td></td>
                                        <td><?= mb_strtoupper($value->name) ?></td>
                                        <td><?= mb_strtoupper($value->Cities->name) ?></td>
                                        <td><?= ($value->Units->name??''); ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-navicon bigfonts" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="<?= url("dev/bairro/editar/{$value->id}") ?>"><i class="fa fa-edit text-warning" aria-hidden="true"></i> Editar</a>
                                                    <a class="dropdown-item confirmDelete" href="<?= url("dev/bairro/remover/{$value->id}") ?>" role="button"><i class="fas fa-trash text-danger" aria-hidden="true"></i> Excluir</a>
                                                </div>
                                            </div>
                                        </td>
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
                    <p class="alert alert-warning">Nenhum bairro cadastrado</p>
                    <a href="<?= url("/dev/cidade/bairro/cadastro") ?>" class="btn btn-primary"><i class="fas fa-check"></i> Cadastrar Novo Bairro</a>
                </div>
            </div><!-- end card-->
        </div>
    </div>
<?php endif ?>
    <?php $v->start('scripts'); ?>
    <script src="<?= theme("/../superadmin/assets/plugins/sweetalert2/sweetalert2.min.js"); ?>"></script>
    <script>
        $(document).ready(function(){
            $('.confirmDelete').click(function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Deseja excluir?',
                    text: "Após excluir você não terá mais acesso a informação!",
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Excluído!',
                            'Cadastro apagado com sucesso.',
                            'success'
                        )
                        setTimeout(window.location.replace($(this).attr('href')), 8);
                    }
                });
            });
        });
    </script>
    <?php $v->end(); ?>
