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
                            <h3 class="mb-4 pb-0"><span>Recuperar senha</span></h3>
                            <div class="ajax_response"><?= flash(); ?></div>
                            <!-- <p>Envia sua localização para a viatura mais próxima deslocar de forma rápida para atender sua solicitção em caso de violência contra mulher.</p> -->
                            <form action="<?= url("/recuperar-senha") ?>" method="post">
                                <?= csrf_input(); ?>
                                <div class="form-row mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="E-mail" autofocus="">
                                </div>
                                <button type="submit" class="primary-btn scrollto">Recuperar</button>
                                <a href="<?= url("/") ?>" class="button secondary-btn scrollto">Voltar</a>
                            </form>
                            <br>
                            <a href="<?= url("/anonimo") ?>">Continuar sem cadastro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

