<?php

    include_once __DIR__."/header.php";

    use DevBoot\Repositories\AuthRepository;

    if (isset($_POST['email_app'])) {

        if ($_POST['email_app'] == ""){
            $json['FORGET'] = "Preencha o e-mail";
            echo json_encode($json);
            return;
        }

        $data['email'] = $_POST['email_app'];

        $auth = new AuthRepository();
        if ($auth->forget($data["email"])) {
            $json["FORGET"] = "Não foi possível enviar o email, verifique seus dados e tente novamente";
        }

        $json['FORGET'] = "SUCCESS";
        echo json_encode($json);
        return;

    } else {
        $json['FORGET'] = "Não foi possível enviar o e-mail, tente mais tarde.";
        echo json_encode($json);
        return;
    }
