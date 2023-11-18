<?php

use core\http\Request;

/** @var $svc core\ServiceContainer */

/** @var \core\Router $router */
$router = $svc['core.router'];
$router->addRoute('GET', '/', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.index']->index($route, $request));

$router->addRoute('GET', '/films', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.films']->list($route, $request));

//new
$router->addRoute('GET', '/films/(\d+)', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.films']->listPage($route, $request));

$router->addRoute('GET', '/film/(\d+)', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.films']->single($route, $request));

$router->addRoute('POST', '/film', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.films']->addSingle($route, $request))->addMiddleware($svc['app.middleware.validateFilm']);

$router->addRoute('PUT', '/film/(\d+)', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.films']->updateSingle($route, $request))->addMiddleware($svc['app.middleware.validateFilm']);

$router->addRoute('DELETE', '/film/(\d+)', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.films']->deleteSingle($route, $request));

