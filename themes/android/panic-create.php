<?php

    include_once __DIR__."/header.php";

    use DevBoot\Commands\OccurrenceCmd;

    if (isset($_POST) && $_POST) {

        if ($_POST['users_id'] == "") {
            $json['CREATE'] = "Nenhum usuário encontrado, não foi possível concluir a operação";
            echo json_encode($json);
            return;
        }

        $data['type'] = 1;
        $data['real_time'] = 1;
        $data['users_id'] = $_POST['users_id'];
        $data['ip_plaintiff'] = $_SERVER['REMOTE_ADDR'];
        $data['plaintiff_coordinates'] = $_POST['plaintiff_coordinates'];

        $query = new OccurrenceCmd($data);
        $occurrence = $query->handle();
        if (!$occurrence) {
            $json['CREATE'] = "Erro inesperado, não foi possível concluir a operação";
            echo json_encode($json);
            return;
        }

        $json['CREATE'] = "SUCCESS";
        echo json_encode($json);

        return;

    } else {
        $json['CREATE'] = "Erro inesperado, não foi possível concluir a operação";
        echo json_encode($json);
        return;
    }
