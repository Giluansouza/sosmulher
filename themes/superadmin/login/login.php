<?php $v->layout("login/_theme"); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center"><a href="<?= url('/'); ?>"><img alt="Logo" class="img-fluid" src="<?= theme("/assets/img/logo.png"); ?>"/></a></h5>
                    <?php
                        // echo $_SERVER['REMOTE_ADDR'];
                        // echo "<pre>";
                        // print_r($_SESSION['weblogin']);
                        // echo "</pre>";
                    ?>
                    <form class="form-signin" method="post" action="<?= url("/login") ?>" enctype="multipart/form-data">
                        <div class="ajax_response"><?= flash(); ?></div>
                        <?= csrf_input(); ?>
                        <div class="form-label-group">
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" value="<?= ($_SESSION['weblogin']->email??null) ?>" required autofocus>
                            <label for="inputEmail">Email</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Senha" required>
                            <label for="inputPassword">Senha</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" <?= (!empty($cookie) ? "checked" : "") ?> for="customCheck1" name="save">Lembrar-me!</label>
                        </div>
                        <?php if (isset($_SESSION['weblogin']) && $_SESSION['weblogin']->requests > 0): ?>
                            <div class="form-label-group d-flex justify-content-center mb-3">
                                <div id="recaptcha"></div>
                            </div>
                        <?php endif ?>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
                        <br>
                        <a href="<?= url("/recuperar") ?>">Esqueceu a senha?</a>
                        <a href="<?= url("/cadastro-usuario") ?>">Cadastrar-se</a>
                    </form>
                </div>
                <!-- <div class="card-footer">
                    Versão: 0.4.3 (não estável)
                </div> -->
            </div>
        </div>
    </div>
</div>
