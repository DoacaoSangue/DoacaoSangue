<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\TelaInicialController;
use App\Controller\PainelAdministradorController;
use App\Controller\SolicitarDoacaoController;
use App\Controller\TelaCadastroController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new AltoRouter();
$router->setBasePath('/DoacaoSangue');

$router->map('GET', '/', function() {
    (new TelaInicialController())->handleRequest();
});

$router->map('GET', '/cadastro', function() {
    (new TelaInicialController())->handleRequest('cadastro');
});

$router->map('POST', '/login', function() {
    (new TelaInicialController())->handleRequest('login');
});

$router->map('POST', '/cadastrar', function() {
    (new TelaCadastroController())->criar();
});

$router->map('GET', '/painel-administrador', function() {
    (new PainelAdministradorController())->handleRequest();
});

$router->map('GET', '/painel', function() {
    (new \App\Controller\PainelUsuarioController())->handleRequest();
});

$router->map('POST', '/doar', function() {
    \App\Controller\SolicitarDoacaoController::atualizarStatus();
});

$router->map('GET', '/verificar-status', function() {
    \App\Controller\SolicitarDoacaoController::verificarStatus();
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // 404
    echo 'Página não encontrada';
}