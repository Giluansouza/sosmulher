<?php $v->layout("_theme"); ?>
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Cadastro de Bairros/Distritos</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= url("/app") ?>">Início</a></li>
                <li class="breadcrumb-item active">Cadastro de Bairros/Distritos</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="<?= url('/dev/cidade/bairro/cadastro') ?>" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-check-square-o"></i> Cadastro de Bairros/Distritos</h3>
                </div>
                <div class="card-body">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?php include __DIR__."/../../../shared/views/forms/form-district.php"; ?>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary form-custom" type="submit" id="submeter"><i class="fas fa-check"></i> Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
