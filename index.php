<?php

include 'core/include/include.php';
include 'app/include/routes.php';

try {
    /** @var $svc \core\ServiceContainer */

    /** @var \core\Router $router */
    $router = $svc['core.router'];

    $response = $router->execute($svc['core.http.request']);
} catch (Throwable $e) {
    $response = new \core\http\Response(json_encode(['status' => 'exception', 'message' => $e->getMessage()]), 500);
    $response->addHeader('Content-Type', 'application/json');
}
$response->send();