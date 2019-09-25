<?php $v->layout("_theme"); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Lista de Usuários</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Início</li>
                <li class="breadcrumb-item active">Lista de Usuários</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="ajax_response"><?= flash(); ?></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <span class="pull-right">
                        <!-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add_user">
                            <i class="fas fa-user-plus" aria-hidden="true"></i> Add novo usuário
                        </button> -->
                    </span>
                    <h3><i class="fas fa-user"></i> Todos os Usuários (<?= $users->count() ?> usuários)</h3>
                </div>
                <!-- end card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:50px">#</th>
                                    <th>Detalhes do Usuário</th>
                                    <th style="width:130px">Nível</th>
                                    <th style="width:150px">Inteligência</th>
                                    <th style="width:120px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key => $value): ?>
                                    <tr>
                                        <th><?= $value->id ?></th>
                                        <td>
                                            <span style="float: left; margin-right:10px;">
                                                <?php $value->photo = ($value->photo != "") ? $value->photo : "avatar7.png"; ?>
                                                <img alt="image" style="max-width:40px; height:auto;" src="<?= url("/themes/superadmin/assets/images/avatars/{$value->photo}"); ?>" />
                                            </span>
                                            <strong><?= $value->first_name.' '.$value->last_name; ?></strong>
                                            <br />
                                            <small><?= $value->office.' - '.$value->email ?></small>
                                        </td>
                                        <td><?= $value->level ?></td>
                                        <td><?= $value->reserved ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_user_update_<?= $value->id ?>">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </button>
                                            <a class="btn btn-danger btn-sm confirmDelete" href="<?= url("dev/remover-usuario/{$value->id}") ?>" role="button">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                    include __DIR__.'/modalsforms/modal-user-update.php';
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

<?php $v->insert("users/modalsforms/modal-add-user"); ?>
<?php $v->start('scripts'); ?>
    <script src="<?= theme("/../superadmin/assets/plugins/sweetalert2/sweetalert2.min.js"); ?>"></script>
    <script>
        $(document).ready(function(){
            $('.confirmDelete').click(function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Deseja excluir?',
                    text: "Após excluir esse usuário deixará de ter acesso ai sistema.",
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Deletado!',
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
