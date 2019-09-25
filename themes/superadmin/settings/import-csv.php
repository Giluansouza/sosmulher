<?php $v->layout("_theme"); ?>

<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Importar Dados em CSV</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= url("/{$user->url}") ?>">Início</a></li>
                <li class="breadcrumb-item active">Importar Dados em CSV</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="<?= url('/dev/importar-csv') ?>" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-check-square"></i> Upload do Arquivo CSV</h3>
                </div>
                <div class="card-body">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <?= csrf_input(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="csv">Tipo de Importação</label>
                            <select name="opcao" class="form-control">
                                <option value="2019">Ocorrências 2019</option>
                                <option value="2018">Ocorrências 2018</option>
                                <option value="BAIRROS">BAIRROS</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="csv">Caminho do arquivo CSV</label>
                            <input type="file" class="form-control" name="csv" placeholder="Caminho do arquivo CSV">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary form-custom" type="submit" id="submeter">Importar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
    <div class="col-md-12">
    </div>
</div>
