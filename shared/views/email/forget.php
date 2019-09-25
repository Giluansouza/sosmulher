<?php $v->layout("_theme", ["title" => "Recupere sua senha para acessar o SIAGEO"]); ?>

<h2>Perdeu sua senha <?= $name; ?>?</h2>
<p>Você está recebendo este e-mail pois foi solicitado a recuperação de senha no site do SIAGEO.</p>
<p><a title='Recuperar Senha' href='<?= $forget_link; ?>'>CLIQUE AQUI PARA CRIAR UMA NOVA SENHA</a></p>
<p><b>IMPORTANTE:</b> Se não foi você que solicitou ignore o e-mail. Seus dados permanecem seguros.</p>
