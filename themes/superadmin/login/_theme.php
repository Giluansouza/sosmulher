<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <?= $head; ?>

        <!-- Favicons -->
        <link href="<?= theme("assets/img/favicon.png"); ?>" rel="icon">
        <link href="<?= theme("assets/img/apple-touch-icon.png"); ?>" rel="apple-touch-icon">
        <!-- Bootstrap CSS File -->
        <link href="<?= theme("assets/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
        <!-- Custom fonts for this template -->
        <link rel="stylesheet" href="<?= theme('/../../vendor/fontawesome-free/css/all.min.css'); ?>">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="<?= theme("/../superadmin/assets/css/boot.css"); ?>">
        <link rel="stylesheet" href="<?= theme("/../superadmin/assets/css/style.css"); ?>"/>

    </head>
    <body id="page-top">

        <div class="ajax_load">
            <div class="ajax_load_box">
                <div class="ajax_load_box_circle"></div>
                <p class="ajax_load_box_title">Aguarde, carregando!</p>
            </div>
        </div>

        <?= $v->section("content"); ?>

        <!-- USAR O MINIFY POSTERIORMENTE -->
        <script src="<?= theme("/../../shared/js/lib/jquery.min.js"); ?>"></script>
        <script src="<?= theme("/../../shared/js/lib/jquery-ui.js"); ?>"></script>
        <script src="<?= theme("/../../shared/js/lib/jquery.form.js"); ?>"></script>
        <script src="<?= theme("/../../shared/js/scripts.js"); ?>"></script>
        <script>
            var onloadCallback = function() {
                if ($('#recaptcha').length) {
                    grecaptcha.render('recaptcha', {
                      'sitekey' : '6LeMabIUAAAAANG1NwhmRMjKNtqiqzb41nRkyBFa'
                    });
                }
            };
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer></script>
    </body>
</html>
