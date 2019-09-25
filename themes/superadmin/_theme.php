<?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?= $head ?>

    <!-- Favicons -->
    <link href="<?= theme("assets/img/favicon.png"); ?>" rel="icon">
    <link href="<?= theme("assets/img/apple-touch-icon.png"); ?>" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link href="<?= theme("/../../shared/css/bootstrap.css"); ?>" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="<?= theme("/../superadmin/assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= theme("/../superadmin/assets/font-awesome/css/all.css"); ?>" rel="stylesheet" type="text/css"/>
    <!-- SweetAlert2 -->
    <link href="<?= theme("/../superadmin/assets/plugins/sweetalert2/sweetalert2.min.css"); ?>" rel="stylesheet" type="text/css"/>
    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" href="<?= theme("/../../shared/css/boot.css"); ?>"/>
    <!-- Custom CSS -->
    <link href="<?= theme("/../../shared/css/style.css"); ?>" rel="stylesheet">
    <!-- END CSS for this page -->
    <style>
        .mapcapture {
            width: 100%;
            height: 100%
        }
    </style>
</head>
<body class="adminbody">

    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>

    <div id="main" class="forced enlarged">
        <!-- top bar navigation -->
        <div class="headerbar">
            <!-- LOGO -->
            <div class="headerbar-left">
                <a href="<?= url('/dev') ?>" class="logo">
                    <img alt="Logo" src="<?= theme("/assets/img/apple-touch-icon.png"); ?>"/>
                    <span>SOSMulher</span>
                </a>
            </div>
            <!-- Topbar -->
            <?= $v->insert("views/topbar"); ?>
            <!-- End topbar -->
        </div>
        <!-- End Navigation -->
        <!-- Left Sidebar -->
        <?= $v->insert("views/sidebar", ['url' => '/dev']); ?>
        <!-- End Sidebar -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <?= $v->section("content"); ?>
                </div>
                <!-- END container-fluid -->
            </div>
            <!-- END content -->
        </div>
        <!-- END content-page -->
        <footer class="footer">
            <span class="text-right">
                2019 &copy; <a target="_blank" href="#"><?= CONF_SITE_NAME ?></a>
            </span>
            <span class="float-right">
                Desenvoldido por <a target="_blank" href="https://www.devboot.com.br"><b>DevBoot</b></a>
            </span>
        </footer>

    </div>
    <!-- END main -->
    <script src="<?= theme("/../superadmin/assets/js/jquery.min.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/modernizr.min.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/moment.min.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/popper.min.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/bootstrap.min.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/detect.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/fastclick.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/jquery.blockUI.js"); ?>"></script>
    <script src="<?= theme("/../superadmin/assets/js/jquery.nicescroll.js"); ?>"></script>
    <!-- App js -->
    <script src="<?= theme("/../superadmin/assets/js/pikeadmin.js"); ?>"></script>
    <!-- BEGIN Java Script for this page -->
    <!-- <script src="<= theme("/../superadmin/assets/js/Chart.min.js"); ?>"></script> -->
    <!-- <script src="<= theme("/../superadmin/assets/js/jquery.dataTables.min.js"); ?>"></script> -->
    <!-- <script src="<= theme("/../superadmin/assets/js/dataTables.bootstrap4.min.js"); ?>"></script> -->

    <!-- SweetAlert2 -->
    <script src="<?= theme("/../superadmin/assets/plugins/sweetalert2/sweetalert2.min.js"); ?>"></script>
    <script src="<?= theme("/../../shared/js/lib/jquery-ui.js"); ?>"></script>
    <script src="<?= theme("/../../shared/js/lib/jquery.form.js"); ?>"></script>
    <script src="<?= theme("/../../shared/js/scripts.js"); ?>"></script>
    <?= $v->section("scripts"); ?>
</body>
</html>
