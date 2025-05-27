
<?php
require_once 'controllers/tela-inicial.controller.php';
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$controller = new TelaInicialController();
$controller->handleRequest();

