<?php

    include_once __DIR__."/header.php";

    use DevBoot\Commands\OccurrenceCmd;
    use DevBoot\Commands\AddressCmd;

    if (isset($_POST)) {

        if ($_POST['real_time'] == "" || $_POST['plaintiff'] == "" || $_POST['precautionary_measure'] == "" || $_POST['name_victim'] == "" || $_POST['name_accused'] == "" || $_POST['note'] == "" || $_POST['public_place'] == "" || $_POST['district'] == ""){
            $json['CREATE'] = "ERROR_EM_BRANCO";
            echo json_encode($json);
            return;
        }

        $data['type'] = 0;
        $data['real_time'] = ($_POST['real_time'] == "Sim") ? 1 : 0;
        $data['plaintiff'] = $_POST['plaintiff'];
        $data['precautionary_measure'] = $_POST['precautionary_measure'];
        $data['name_victim'] = $_POST['name_victim'];
        $data['name_accused'] = $_POST['name_accused'];
        $data['note'] = $_POST['note'];
        $data['users_id'] = $_POST['users_id']??0;
        $data['ip_plaintiff'] = $_SERVER['REMOTE_ADDR'];
        $data['plaintiff_coordinates'] = $_POST['plaintiff_coordinates'];

        $query = new OccurrenceCmd($data);
        $occurrence = $query->handle();
        if (!$occurrence) {
            $json['CREATE'] = $occurrence->message()->textString();
            echo json_encode($json);
            return;
        }

        $data['occurrences_id'] = $occurrence->id;
        $data['public_place'] = $_POST['public_place'];
        $data['complement'] = $_POST['complement'];
        $data['district'] = $_POST['district'];
        $data['coordinates'] = $_POST['coordinates'];

        $query = new AddressCmd($data);
        if (!$query->handle()) {
            $json['CREATE'] = "ERROR_ENDEREÇO";
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
