<?php

include 'core/include/include.php';

/** @var $svc \core\ServiceContainer */

/** @var \core\Router $router */
$router = $svc['core.router'];

$response = $router->execute($svc['core.http.request']);

$response->send();
