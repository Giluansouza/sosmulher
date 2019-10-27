<?php
date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__."/../../source/Boot/Config.php";

$dotenv = Dotenv\Dotenv::create(__DIR__."/../../");
$dotenv->load();

new \DevBoot\Core\Connect;
