<?php

use core\http\Request;
use core\Route;

/** @var $svc \core\ServiceContainer */

$svc['core.router']->addRoute(new Route('GET', '/', fn(
    core\Route $route,
    Request $request
) => $svc['app.controller.index']->index($route, $request)));

$svc['core.router']->addRoute(new Route('GET', '/films', fn(
    core\Route $route,
    Request $request
) => $svc['app.controller.films']->list($route, $request)));

//new
$svc['core.router']->addRoute(new Route('GET', '/films/(\d+)', fn(
    core\Route $route,
    Request $request
) => $svc['app.controller.films']->listPage($route, $request)));

$svc['core.router']->addRoute(new Route('GET', '/film/(\d+)', fn(
    core\Route $route,
    Request $request
) => $svc['app.controller.films']->single($route, $request)));

