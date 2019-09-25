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
                            <h3 class="mb-4 pb-0"><span><?= $error->title; ?></span></h3>
                            <div class="ajax_response"><?= flash(); ?></div>
                            <!-- <p>Envia sua localização para a viatura mais próxima deslocar de forma rápida para atender sua solicitção em caso de violência contra mulher.</p> -->

                            <br>
                            <p>Erro <?= $error->code; ?></p>
                            Continuar sem cadastro</a>
                            <p><?= $error->message; ?></p>
                            <?php if ($error->link): ?>
                                <a title="<?= $error->linkTitle; ?>" class="button secondary-btn scrollto" href="<?= $error->link; ?>"><?= $error->linkTitle; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

