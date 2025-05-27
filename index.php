<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\TelaInicialController;

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

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // 404
    echo 'Página não encontrada';
}