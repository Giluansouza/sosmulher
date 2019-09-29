<?php //theme("assets/img/logo.png"); ?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="utf-8">
    <?= $head ?>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="<?= theme("assets/img/favicon.png"); ?>" rel="icon">
    <link href="<?= theme("assets/img/apple-touch-icon.png"); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="<?= theme("assets/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?= theme("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <link href="<?= theme("assets/animate/animate.min.css"); ?>" rel="stylesheet">
    <link href="<?= theme("assets/venobox/venobox.css"); ?>" rel="stylesheet">
    <link href="<?= theme("assets/owlcarousel/assets/owl.carousel.min.css"); ?>" rel="stylesheet">
    <link href="<?= theme("assets/plugins/sweetalert2/sweetalert2.min.css"); ?>" rel="stylesheet" />

    <!-- Main Stylesheet File -->
    <link href="<?= theme("assets/css/style.css"); ?>" rel="stylesheet">

    <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
    ======================================================= -->
</head>

<body>

    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>
  <!--==========================
    Header
  ============================-->
   <header id="header">
        <div class="container">
            <div id="logo" class="pull-left">
                <!-- Uncomment below if you prefer to use a text logo -->
                <!-- <h1><a href="#main">C<span>o</span>nf</a></h1> -->
                <a href="#intro" class="scrollto"><img src="<?= theme("assets/img/logo.png") ?>" alt="SOS Mulher" title="SOSMulher"></a>
            </div>
            <?= $v->insert($nav['nav']) ?>
        </div>
    </header><!-- #header -->

    <?= $v->section("content"); ?>

  <!--==========================
    Footer
  ============================-->
    <footer id="footer">
        <div class="container">
            <!-- <div class="brands"> -->
            <div class="row">
                <div class="col-3 text-center">
                    <img class="img-fluid" src="<?= theme("assets/img/pmba.png"); ?>" alt="">
                </div>
                <div class="col-3 text-center">
                    <img class="img-fluid" src="<?= theme("assets/img/cprn.png"); ?>" alt="">
                </div>
                <div class="col-3 text-center">
                    <img class="img-fluid" src="<?= theme("assets/img/cprn-spinner.png"); ?>" alt="">
                </div>
                <div class="col-3 text-center">
                    <img class="img-fluid" src="<?= theme("assets/img/rede.png"); ?>" alt="">
                </div>
            </div>
            <!-- </div> -->
        </div>
    </footer><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="<?= theme("assets/jquery/jquery.min.js"); ?>"></script>
    <script src="<?= theme("assets/jquery/jquery-migrate.min.js"); ?>"></script>
    <script src="<?= theme("assets/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?= theme("assets/easing/easing.min.js"); ?>"></script>
    <script src="<?= theme("assets/superfish/hoverIntent.js"); ?>"></script>
    <script src="<?= theme("assets/superfish/superfish.min.js"); ?>"></script>
    <script src="<?= theme("assets/wow/wow.min.js"); ?>"></script>
    <script src="<?= theme("assets/venobox/venobox.min.js"); ?>"></script>
    <script src="<?= theme("assets/owlcarousel/owl.carousel.min.js"); ?>"></script>

    <!-- Contact Form JavaScript File -->
    <script src="<?= theme("assets/contactform/contactform.js"); ?>"></script>

    <script src="<?= theme("/../../shared/js/lib/jquery-ui.js"); ?>"></script>
    <script src="<?= theme("/../../shared/js/lib/jquery.form.js"); ?>"></script>
    <script src="<?= theme("/../../shared/js/scripts.js"); ?>"></script>

    <!-- Template Main Javascript File -->
    <script src="<?= theme("assets/js/main.js"); ?>"></script>
    <?= $v->section("scripts") ?>
</body>

</html>
