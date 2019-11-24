<?php

    include_once __DIR__."/header.php";

    use DevBoot\Commands\UserCmd;

    if (isset($_POST)) {

        if ($_POST['name_app'] == "" || $_POST['cpf_app'] == "" || $_POST['email_app'] == "" || $_POST['password_app'] == ""){
            $json['CREATE'] = "ERROR";
            echo json_encode($json);
            return;
        }

        $data['name'] = $_POST['name_app'];
        $data['cpf'] = $_POST['cpf_app'];
        $data['email'] = $_POST['email_app'];
        $data['password'] = $_POST['password_app'];
        $data['conf_password'] = $_POST['password_app'];

        $user = new UserCmd ($data);
        if (!$user->handle()) {
            $json['CREATE'] = "NÃO FOI POSSÍVEL REALIAR O CADASTRO";
            echo json_encode($json);
            return;
        }

        $json['CREATE'] = "SUCCESS";
        echo json_encode($json);

        return;

    } else {
        $json['CREATE'] = "ERROR";
        echo json_encode($json);
        return;
    }
