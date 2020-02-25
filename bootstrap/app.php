<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';
require("custom_autoloader.php");

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App([
    'settings' => [
        /* Remove the line below before the production.. */
        'displayErrorDetails' => true,
    ]
]);

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../resources/views', [
    'cache' => false
]);

$app->map(['GET', 'POST'], '/home', function (Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Home',
        'desc' => 'Solent DFTI Assessment Title Page',
        'status' => 'Home works!'
    ];

    return $this->view->render($response, 'home.php', ['values' => $values]);
})->setName('home');

$app->map(['GET', 'POST'], '/welcome', function (Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Welcome',
        'desc' => 'Solent DFTI Assessment Welcome Page',
        'status' => 'Welcome works!'
    ];

    return $this->view->render($response, 'templates/welcome.php', ['values' => $values]);
})->setName('welcome');

$app->map(['GET', 'POST'], '/user/sign-up', function (Request $request, Response $response, array $args) {

    $poiControl = new PoiControl();
    $errors = array();

    $post = $request->getParsedBody();

    if (isset($post['username']) && isset($post['password'])) {
        $username = preg_replace('/[^A-Za-z0-9\-]/', '', $post['username']);
        $password = password_hash($post['password'], PASSWORD_DEFAULT);

        if (empty($username) || empty($password)) {
            $errors[] = "Please enter a proper registration details!";
        }

        if (strlen($username) < 5 || strlen($password) < 5) {
            $errors[] = "Login or password are too small!";
        }

        if (!ctype_alnum($username)) {
            $errors[] = "Don't try to inject into the Database!";
        }

        if (empty($errors)) {
            try {
                $poiControl->setPoiUser($username, $password, 0);
            }
            catch (Exception $e) {
                exit($e->getCode());
            }
        } else {
            exit(array_shift($errors));
        }
    }

    return $response->withStatus(302)->withHeader('Location', '../home');
});

$app->map(['GET', 'POST'], '/user/sign-in', function (Request $request, Response $response, array $args) {

    $poiControl = new PoiControl();
    $errors = array();

    $post = $request->getParsedBody();

    if (isset($post['username']) && isset($post['password'])) {
        $username = preg_replace('/[^A-Za-z0-9\-]/', '', $post['username']);
        $password = $post['password'];

        $record = $poiControl->getPoiUser($username);

        if(password_verify($password, $record['password'])) {
            session_regenerate_id();

            $_SESSION["gatekeeper"] = null;
            $_SESSION["gaterole"] = null;

            $_SESSION['gatekeeper'] = $record['username'];
            $_SESSION['gaterole'] = $record['isadmin'];
        }

    } else {
        exit("Unable to find or authorize your account!");
    }

    return $response->withStatus(302)->withHeader('Location', '../welcome');
});

$app->map(['GET', 'POST'], '/user/sign-out', function (Request $request, Response $response, array $args) {

    if(isset($_SESSION['gatekeeper'])) {
        session_destroy();
    }

    return $response->withStatus(302)->withHeader('Location', '../home');
});