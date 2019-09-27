<?php $v->layout("_theme"); ?>

    <!--==========================
    Intro Section
    ============================-->
    <section id="intro">
        <div class="intro-container wow fadeIn">
            <div class="row no-gutters">
                <div class="col-lg-12 venue-info">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-12">
                            <h3 class="mb-4 pb-0"><span>Nova Senha</span></h3>
                            <div class="ajax_response"><?= flash(); ?></div>
                            <form action="<?= url("/recuperar/resetar") ?>" method="post">
                                <?= csrf_input(); ?>
                                <div class="form-row mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Senha">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="password" class="form-control" name="conf_password" placeholder="Confirmar senha">
                                </div>
                                <input type="hidden" name="code" value="<?= $code; ?>"/>
                                <button type="submit" class="primary-btn scrollto">Nova senha</button>
                                <a href="<?= url("/") ?>" class="button secondary-btn scrollto">Voltar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

