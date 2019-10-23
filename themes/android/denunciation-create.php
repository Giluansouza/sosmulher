<?php

    include_once __DIR__."/header.php";

    use DevBoot\Commands\OccurrenceCmd;

    if (isset($_POST)) {

        if ($_POST['real_time'] == "" || $_POST['plaintiff'] == "" || $_POST['precautionary_measure'] == "" || $_POST['name_victim'] == "" || $_POST['name_accused'] == "" || $_POST['commit'] == "" || $_POST['public_place'] == "" || $_POST['complement'] == "" || $_POST['district'] == ""){
            $json['CREATE'] = "ERROR";
            echo json_encode($json);
            return;
        }

        $data['real_time'] = $_POST['real_time'];
        $data['plaintiff'] = $_POST['plaintiff'];
        $data['precautionary_measure'] = $_POST['precautionary_measure'];
        $data['name_victim'] = $_POST['name_victim'];
        $data['name_accused'] = $_POST['name_accused'];
        $data['note'] = $_POST['commit'];
        $data['public_place'] = $_POST['public_place'];
        $data['complement'] = $_POST['complement'];
        $data['district'] = $_POST['district'];
        $data['users_id'] = $_POST['users_id']??0;
        $data['ip_plaintiff'] = $_POST['ip_plaintiff'];
        $data['plaintiff_coordinates'] = $_POST['plaintiff_coordinates'];

        $user = new OccurrenceCmd($data);
        if (!$user->handle()) {
            $json['CREATE'] = $user->message()->render();
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
