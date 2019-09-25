<?php $v->layout("_theme"); ?>
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left"><i class="fa fa-file-text"></i> Unidades Operacionais</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= url("/app") ?>">Início</a></li>
                <li class="breadcrumb-item active">Lista de Unidades Operacionais</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="<?= url('/admin/cadastrar-unidade') ?>" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-check-square-o"></i> Cadastro de Unidades Operacionais</h3>
                </div>
                <div class="card-body">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?php include __DIR__."/../../shared/views/forms/form-unit.php"; ?>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary form-custom" type="submit" id="submeter">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
