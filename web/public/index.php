<?php

use App\Router\Infrastructure\Controller\Slim\AddRoute;
use App\Router\Infrastructure\Controller\Slim\GetGateway;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../app/vendor/autoload.php';

$app = AppFactory::create();

$app->put('/route', function (Request $request, Response $response) {
    $controller = new AddRoute();
    $controller->handle($request, $response);
    return $response;
});

$app->get('/gateway', function (Request $request, Response $response) {
    $controller = new GetGateway();
    $controller->handle($request, $response);
    return $response;
});

$app->run();
