<?php
    $v->layout("_theme");
    $lastUpdate = "<div class=\"card-footer text-muted\"><b>Atualizado até ".date('d/m/Y', strtotime('-1 day'))."</b></div>";
?>
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Dashboard - CPRN</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item active">Início</li>
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
                <h3><i class="fa fa-fw fa-bullhorn"></i> Botão do Pânico</h3>
            </div>
            <div class="card-body">
                <!-- <div class="widget-messages nicescroll" style="height: 200px;"> -->
                <?php if (empty($lists->toArray())): ?>
                        <p class="alert alert-warning">Não existem acionamentos do botão do pânico</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Horário</th>
                                    <th>Usuário</th>
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
                                            $class = "class='bg-danger'";
                                            $situation = "Aberta";
                                        }
                                ?>
                                        <tr <?= $class ?> >
                                            <td><?= date_fmt($list->updated_at, "d/m/Y H:i"); ?></td>
                                            <td><?= $list->User->name; ?></td>
                                            <td><?= $list->plaintiff_coordinates; ?></td>
                                            <td><?= $situation; ?></td>
                                            <td><?= ($list->status == 0)? "<a href=\"admin/ocorrencia/{$list->id}\" class=\"btn btn-sm btn-warning\">Visualizar</a>" : "Visualizada"; ?></td>
                                            <?php if ($key == 0 && $list->status == 0): ?>
                                                <audio id="notificacao" preload="auto" autoplay="" src="<?= theme("/../../storage/files/beautiful-guitar.wav") ?>">
                                                    <p>Seu nevegador não suporta o elemento audio.</p>
                                                </audio>
                                            <?php endif ?>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <!-- </div> -->
            </div>
            <div class="card-footer small text-muted">Atualizado até <?= date('d/m/Y H:i'); ?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card card-box">
            <div class="card-header">
                <h3><i class="fa fa-fw fa-clipboard"></i> Denúncias</h3>
            </div>
            <div class="card-body">
                <!-- <div class="widget-messages nicescroll" style="height: 200px;"> -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Horário</th>
                                    <th>Nome da vítima</th>
                                    <th>Coordenadas</th>
                                    <th>Situação</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($denunciation->toArray())): ?>
                                    <tr>
                                        <td colspan="4">
                                            <span class="alert alert-warning">
                                                Nenhuma denúncia nova
                                            </span>
                                        </td>
                                    </tr>
                                <?php else:
                                    foreach ($denunciation as $list):
                                        $class = "";
                                        $situation = "Visualizada";
                                        if ($list->status == 0) {
                                            $class = "class='bg-warning'";
                                            $situation = "Aberta";
                                        }
                                ?>

                                        <tr <?= $class ?>>
                                            <td><?= date_fmt($list->updated_at, "d/m/Y H:i"); ?></td>
                                            <td><?= $list->name_victim; ?></td>
                                            <td><?= $list->Address->coordinates??""; ?></td>
                                            <td><?= $situation; ?></td>
                                            <td><?= ($list->status == 0)? "<a href=\"admin/ocorrencia/{$list->id}\" class=\"btn btn-sm btn-warning\">Visualizar</a>" : "Visualizada"; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <!-- </div> -->
            </div>
            <div class="card-footer small text-muted">Atualizado até <?= date('d/m/Y H:i'); ?></div>
        </div>
    </div>
</div>
<!-- Autoplay is allowed. -->
<!-- <iframe src="<= theme("/../../storage/files/beautiful-guitar.wav") ?>" allow="autoplay"> -->
<!-- <audio id="notificacao" autoplay>
    <source src="<= theme("/../../storage/files/beautiful-guitar.wav") ?>" type="audio/wav">
</audio> -->

<?= $v->start("scripts"); ?>
    <script>
        $( document ).ready(function() {
          // Handler for .ready() called.
            window.setTimeout('location.reload()', 30000);
        });
    </script>
<?= $v->end(); ?>
