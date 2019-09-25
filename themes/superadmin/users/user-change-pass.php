<?php $v->layout("_theme"); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Alterar Senha</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item active">Início</li>
                <li class="breadcrumb-item active">Alterar Senha</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="<?= url('/dev/alterar-senha') ?>" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?php include __DIR__."/../../shared/views/forms/form-user-change-pass.php"; ?>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary form-custom" type="submit" id="submeter">Confirmar Alteração</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
