<?php
include_once './vendor/autoload.php';

$http = new Swoole\Http\Server("0.0.0.0", 8080);

$router = new \App\Router\Router();

$router->addRoute('GET', '/hello', function ($request, $response) {
	$response->end('Hello World!');
});

$http->on('request', function ($request, $response) use ($router) {
	$router->handle($request, $response);
});

$http->start();