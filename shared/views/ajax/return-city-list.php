<?php
    require_once __DIR__ . "/../../../vendor/autoload.php";
    require_once __DIR__."/../../../source/Boot/Config.php";

    new \DevBoot\Core\Connect;
    use DevBoot\Models\City;

    $callback = isset($_GET['states_id']) ?  $_GET['states_id'] : false;

    $json = City::select('id', 'name')->where('states_id', '=', $callback)->orderBy('name', 'ASC')->get();

    echo $json;
    foreach ($json as $key => $value) {
        echo "<option value='{$value->id}' selected>{$value->name}</option>";
    }
