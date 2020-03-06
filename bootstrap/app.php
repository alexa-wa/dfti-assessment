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

/*
 *
 * Handling page load scripts
 * and assigning them to .PHP files
 */
$app->map(['GET', 'POST'], '/home', function (Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Home',
        'desc' => 'Solent DFTI Assessment Title Page',
        'status' => 'Home works!'
    ];

    return $this->view->render($response, 'home.php', ['values' => $values]);
})->setName('home');

$app->map(['GET', 'POST'], '/poiadd', function (Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Add new POI',
        'desc' => 'Solent DFTI Assessment POI adding page',
        'status' => 'Add works!'
    ];

    return $this->view->render($response, 'templates/poiadd.php', ['values' => $values]);
})->setName('poiadd');

$app->map(['GET', 'POST'], '/poisearch', function (Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Search for a POI',
        'desc' => 'Solent DFTI Assessment POI search page',
        'status' => 'Search works!'
    ];

    return $this->view->render($response, 'templates/poisearch.php', ['values' => $values]);
})->setName('poisearch');

$app->map(['GET', 'POST'], '/poireview', function(Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Review a POI',
        'desc' => 'Solent DFTI Assessment POI review page',
        'status' => 'Review works!'
    ];

    return $this->view->render($response, 'templates/poireview.php', ['values' => $values]);
})->setName('poireview');

$app->map(['GET', 'POST'], '/poiread', function (Request $request, Response $response, array $args) {

    $values = [
        'title' => 'Solent DFTI – Read reviews',
        'desc' => 'Solent DFTI Assessment Read reviews Page',
        'status' => 'Read works!'
    ];

    return $this->view->render($response, 'templates/poiread.php', ['values' => $values]);
})->setName('read');

/*
 *
 * Handling page form action scripts
 * for GET/POST requests
 */
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
            } catch (Exception $e) {
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

        try {
            $record = $poiControl->getPoiUser($username);
        } catch (Exception $e) {
            exit("Unable to find or authorize your account!");
        }

        if (password_verify($password, $record['password'])) {
            session_regenerate_id();

            $_SESSION["gatekeeper"] = null;
            $_SESSION["gaterole"] = null;

            $_SESSION['gatekeeper'] = $record['username'];
            $_SESSION['gaterole'] = $record['isadmin'];
        }

    } else {
        exit("Unable to find or authorize your account!");
    }

    return $response->withStatus(302)->withHeader('Location', '../home');
});

$app->map(['GET', 'POST'], '/user/sign-out', function (Request $request, Response $response, array $args) {

    if (isset($_SESSION['gatekeeper']))
        session_destroy();

    return $response->withStatus(302)->withHeader('Location', '../home');
});

$app->map(['GET', 'POST'], '/poi/add', function (Request $request, Response $response, array $args) {

    $poiControl = new PoiControl();
    $post = $request->getParsedBody();

    $poiName = $post['name'];
    $poiType = $post['type'];
    $poiCountry = $post['country'];
    $poiRegion = $post['region'];
    $poiDescription = $post['description'];
    $poiRecommended = 0;
    $poiUser = $_SESSION['gatekeeper'];

    if(empty($poiName) || empty($poiType) || empty($poiCountry) || empty($poiRegion))
        exit("Please complete the form!");

    try {
        $poiControl->setNewPoi($poiName, $poiType, $poiCountry, $poiRegion, $poiDescription, $poiRecommended, $poiUser);
    } catch (Exception $e) {
        echo $e->getCode();
        exit('Something went wrong!');
    }
    return $response->withStatus(302)->withHeader('Location', '../poiadd');
});

$app->get('/poi/search', function (Request $request, Response $response, array $args) {

    $poiControl = new PoiControl();
    $region = $_GET['region'];

    if(empty($region))
        exit("Region field can't be empty!");

    try {
        $records = $poiControl->getPoiByRegion($region);

        $someJSON = [];

        foreach ($records as $record) {
            $someJSON[] = [
                "id" => "{$record['id']}",
                "name" => "{$record['name']}",
                "type" => "{$record['type']}",
                "country" => "{$record['country']}",
                "region" => "{$record['region']}",
                "description" => "{$record['description']}"
            ];
        }

        $newJSON = json_encode($someJSON);
        echo $newJSON;

    } catch (Exception $e) {
        echo $e->getCode();
        exit('Something went wrong!');
    }
});

$app->map(['GET', 'POST'], '/poi/recommend', function (Request $request, Response $response, array $args) {

    $poiControl = new PoiControl();
    $region = $_GET['id'];

    try {
        $poiControl->setRating($region);
    } catch (Exception $e) {
        $e->getMessage();
    }

});

$app->map(['GET', 'POST'], '/poi/review', function (Request $request, Response $response, array $args) {

    $poiControl = new PoiControl();
    $id = $_GET['id'];
    $review = $_GET['review'];

    $poiControl->setNewReview($id, $review, 0);

});