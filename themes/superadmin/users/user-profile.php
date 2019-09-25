<?php $v->layout("_theme"); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Perfil do Usuário</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item active">Início</li>
                <li class="breadcrumb-item active">Perfil do usuário</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="ajax_response"><?= flash(); ?></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="<?= url('/dev/editar-perfil') ?>" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-user"></i> Informações do Usuário</h3>
                    <!-- Be sure to use an appropriate <i>type</i> attribute on all inputs (e.g., <i>email</i> for email address or <i>number</i> for numerical information) to take advantage of newer input controls like email verification, number selection, and more. -->
                </div>
                <div class="card-body">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?php include __DIR__."/../../../shared/views/forms/form-user.php"; ?>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" name="user_id" class="form-control" value="<?= $user->id??"" ?>">
                            <button class="btn btn-primary form-custom" type="submit" id="submeter">Editar Perfil</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
