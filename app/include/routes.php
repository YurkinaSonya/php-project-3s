<?php

use core\http\Request;

/** @var $svc core\ServiceContainer */

/** @var core\Router $router */
$router = $svc['core.router'];
$router->addRoute('GET', '/', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.index']->index($route, $request));

