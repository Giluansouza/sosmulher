<?php
ob_start();//controlar o cache, assim carrega apenas uma vez

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use CoffeeCode\Router\Router;
use DevBoot\Core\Session;

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

new \DevBoot\Core\Connect;
$session = new Session();
$route = new Router(url(), ":"); //os dois pontos para separar

/***********************
 * AUTH ROUTES        *
 **********************/
$route->namespace("DevBoot\Controllers\Auth");
/** Routes Group */
$route->group(null);
/** Routes */
$route->get('/', 'Auth:login');
$route->post('/', 'Auth:login');
$route->get('/cadastro', 'Auth:register');
$route->post('/cadastro', 'Auth:register');
$route->get('/recuperar-senha', 'Auth:forget');
$route->post('/recuperar-senha', 'Auth:forget');
$route->get('/recuperar/{code}', 'Auth:reset');
$route->post('/recuperar/resetar', 'Auth:reset');
$route->get('/sair', 'Auth:logout');

/***********************
 * WAR ROUTES        *
 **********************/
$route->namespace("DevBoot\Controllers"); //onde estão os controladores
/** Routes Group */
$route->group(null);
/** Routes */
$route->get('/anonimo', 'War:anonymous');
$route->get('/denuncia', 'War:denunciation');
$route->post('/denuncia', 'War:denunciation');
$route->get('/instrucoes', 'War:instructions');

/***********************
 * APP ROUTES        *
 **********************/
$route->get('/app', 'App:home');
$route->post('/app/panico', 'App:panicButton');
$route->get('/app/denuncia', 'App:denunciation');
$route->post('/app/denuncia', 'App:denunciation');
$route->get('/app/instrucao', 'App:instruction');

/***********************
 * ADMIN ROUTES        *
 **********************/
$route->namespace("DevBoot\Controllers\Dev");
$route->group(null);
$route->get('/admin', 'Admin:home');
$route->get('/admin/ocorrencia/{id}', 'Occurrence:show');
$route->post('/admin/ocorrencia/status', 'Occurrence:show');
$route->get('/admin/usuarios', 'User:list');
$route->post('/admin/atualizar-usuario', 'User:list');

/***********************
 * ERROR ROUTES        *
 ***********************/
$route->namespace("DevBoot\Controllers\Error");
$route->group("/ops");
$route->get("/{errcode}", "Error:error");

/**
 * ROUTE
 */
$route->dispatch();//para executar a rota

/**
 * ERROR REDIRECT
 */
if ($route->error()) {//controla caso o dispatch não consiga entregar uma rota
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
