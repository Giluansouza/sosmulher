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
                            <h3 class="mb-4 pb-0">Cadastro</h3>
                            <div class="ajax_response"><?= flash(); ?></div>
                            <!-- <p>Envia sua localização para a viatura mais próxima deslocar de forma rápida para atender sua solicitção em caso de violência contra mulher.</p> -->
                            <form action="<?= url("/cadastro") ?>" method="post">
                                <?= csrf_input(); ?>
                                <div class="form-row mb-3">
                                    <input type="text" class="form-control" name="cpf" placeholder="Cpf" autofocus="">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="E-mail">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Senha">
                                </div>
                                <div class="form-row mb-3">
                                    <input type="password" class="form-control" name="conf_password" placeholder="Confirmar senha">
                                </div>
                                <button type="submit" class="primary-btn scrollto">Cadastrar</button>
                                <a href="<?= url("/") ?>" class="button secondary-btn scrollto">Voltar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

