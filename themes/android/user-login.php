<?php

    include_once __DIR__."/header.php";

    if (isset($_POST)) {

        if ($_POST['email_app'] == "" || $_POST['password_app'] == ""){
            $json['LOGIN'] = "ERROR";//$user->message()->render();
            echo json_encode($json);
            return;
        }

        $data['email'] = $_POST['email_app'];
        $data['password'] = $_POST['password_app'];

        $json['LOGIN'] = "SUCCESS";//$this->message->success("Cadastrado com sucesso")->flash();
        echo json_encode($json);
        return;

    } else {
        $json['LOGIN'] = "ERROR";
        echo json_encode($json);
        return;
    }
