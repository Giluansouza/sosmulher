<?php $v->layout("_theme", ["title" => "Mensagem de contato do AlertCell"]); ?>

<h4>Atenção! Está é uma mensagem de contato via formulário do site AlertCell</h4>
<p><b>Nome:</b> <?= $name; ?></p>
<p><b>Email:</b> <?= $email; ?></p>
<p><b>Assunto:</b> <?= $subject; ?></p>
<p><b>Mensagem:</b> <?= $message; ?></p>
