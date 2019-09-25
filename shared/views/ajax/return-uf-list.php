<?php
require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__."/../../../source/Boot/Config.php";

new \DevBoot\Core\Connect;
use DevBoot\Repository\CityRepository;

$callback = isset($_GET['callback']) ?  $_GET['callback'] : false;

if (!empty($callback)){

    $result = new CityRepository;
    $json = $result->returnUf();

    echo ($callback ? $callback . '(' : '') . json_encode($json) . ($callback? ')' : '');

}
