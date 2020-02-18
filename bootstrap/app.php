<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';
require("custom_autoloader.php");

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../resources/views', [
    'cache' => false
]);

$app->get('/home', function (Request $request, Response $response, array $args) {
    $vars = [
        'title'=>'Solent DFTI – Home',
        'description'=>'Home page',
        'msg'=>'Home works!'
    ];
    return $this->view->render($response, 'home.php', ['vars' => $vars]);
})->setName('home');