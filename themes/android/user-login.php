<?php

    include_once __DIR__."/header.php";

    use DevBoot\Repositories\AuthRepository;

    if (isset($_POST['email_app'])) {

        if ($_POST['email_app'] == "" || $_POST['password_app'] == ""){
            $json['LOGIN'] = "PREENCHA O E-MAIL E A SENHA";
            echo json_encode($json);
            return;
        }

        $data['email'] = $_POST['email_app'];
        $data['password'] = $_POST['password_app'];

        $auth = new AuthRepository();
        $login = $auth->login($data['email'], $data['password']);

        if (!$login) {
            $json['LOGIN'] = "E-MAIL OU SENHA INCORRETOS";
            echo json_encode($json);
            return;
        }

        $json['LOGIN'] = "SUCCESS";
        echo json_encode($json);
        return;

    } else {
        $json['LOGIN'] = "ERRO AO TENTAR ENTRAR";
        echo json_encode($json);
        return;
    }
