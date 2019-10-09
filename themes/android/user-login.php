<?php

    include_once __DIR__."/header.php";

    use DevBoot\Commands\UserCmd;

    if (isset($_POST)) {

        if (empty($data['email_app']) || empty($data['password_app'])) {
            $json = ["message" => 'ERRO_BLANK'];
        }

        $auth = new AuthRepository();
        $login = $auth->login($data['email_app'], $data['password_app']);
        if (!$login) {
            $json = ["message" => 'ERRO'];
        } else {
            $json = ["message" => 'SUCCESS'];
        }

        echo json_encode($json);
        // return;

    } else {
        $json['message'] = "ERROR";//$user->message()->render();
        echo json_encode($json);
        return;
    }
