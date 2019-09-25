<?php $v->layout("_theme"); ?>
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Editar Bairro/Distrito</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= url("/dev") ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?= url("/dev") ?>">Cidades</a></li>
                <li class="breadcrumb-item"><a href="<?= url("/dev/") ?>">Bairros</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="<?= url('/dev/bairro/editar') ?>" method="post">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-edit"></i> Editar Bairro/Distrito</h3>
                </div>
                <div class="card-body">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?php include __DIR__."/../../../shared/views/forms/form-district.php"; ?>
                    <input type="hidden" name="district_id" value="<?= $result->id ?>">
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary form-custom" type="submit"><i class="fas fa-check"></i> Confirmar Alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
