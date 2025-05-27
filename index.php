<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\TelaInicialController;
use App\Controller\PainelAdministradorController;
use App\Controller\SolicitarDoacaoController;
use App\Controller\TelaCadastroController;
use App\Controller\LocalController;

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

$router->map('POST', '/novoLocal', function() {
    (new LocalController())->cadastrar();
});

$router->map('POST', '/atualizarLocal', function() {
    (new \App\Controller\LocalController())->atualizar();
});

$router->map('GET', '/excluirLocal', function() {
    (new \App\Controller\LocalController())->excluir();
});

$router->map('POST', '/cadastrarDoacao', function() {
    (new \App\Controller\DoacaoController())->cadastrar();
});

$router->map('POST', '/atualizarDoacao', function() {
    (new \App\Controller\DoacaoController())->atualizar();
});

$router->map('POST', '/excluirDoacao', function() {
    (new \App\Controller\DoacaoController())->excluir();
});

$router->map('GET', '/excluirDoacao', function() {
    (new \App\Controller\DoacaoController())->excluir();
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // 404
    echo 'Página não encontrada';
}