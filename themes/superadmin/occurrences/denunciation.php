<?php
    $v->layout("_theme");
    $lastUpdate = "<div class=\"card-footer text-muted\"><b>Atualizado até ".date('d/m/Y', strtotime('-1 day'))."</b></div>";
?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Botão do Pânico</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Início</li>
                <li class="breadcrumb-item active">Botão do Pânico</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="ajax_response"><?= flash(); ?></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card card-box">
            <div class="card-header">
                <h3><i class="fa fa-fw fa-bullhorn"></i> Denúncias</h3>
            </div>
            <div class="card-body">
                <!-- <div class="widget-messages nicescroll" style="height: 200px;"> -->
                <?php if (empty($lists->toArray())): ?>
                        <p class="alert alert-warning">Não existem denúncias cadastradas</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Horário</th>
                                    <th>Vítima</th>
                                    <th>Coordenadas</th>
                                    <th>Situação</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($lists as $key => $list):
                                        $class = "";
                                        $situation = "Visualizada";
                                        if ($list->status == 0) {
                                            $class = "class='bg-warning'";
                                            $situation = "Aberta";
                                        } else if ($list->status > 1) {
                                            $situation = "Encerrada";
                                        }
                                ?>
                                        <tr <?= $class ?> >
                                            <td><?= date_fmt($list->updated_at, "d/m/Y H:i"); ?></td>
                                            <td><?= $list->name_victim; ?></td>
                                            <td><?= $list->Address->coordinates??""; ?></td>
                                            <td><?= $situation; ?></td>
                                            <td><a href="ocorrencia/<?= $list->id ?>" class="btn btn-sm btn-warning">Visualizar</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $paginator ?>
                    </div>
                <?php endif; ?>
                <!-- </div> -->
            </div>
            <div class="card-footer small text-muted">Atualizado até <?= date('d/m/Y H:i'); ?></div>
        </div>
    </div>
</div>
