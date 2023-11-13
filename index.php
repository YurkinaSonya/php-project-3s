<?php

include 'core/include/include.php';

/** @var $svc \core\ServiceContainer */

/** @var \core\Router $router */
$router = $svc['core.router'];

/** @var \core\http\RequestBuilder $requestBuilder */
$requestBuilder = $svc['core.http.request_builder'];
$request = $requestBuilder->createFromGlobals();

$response = $router->execute($request);

$response->send();
