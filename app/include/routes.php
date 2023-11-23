<?php

use core\http\Request;

/** @var $svc core\ServiceContainer */

/** @var core\Router $router */
$router = $svc['core.router'];
$router->addRoute('GET', '/', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.index']->index($route, $request));


/** @see \app\controller\CommunityController::listOfCommunity() */
$router->addRoute('GET', '/community', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->listOfCommunity($route, $request));

/** @see \app\controller\AuthorizationController::register() */
$router->addRoute('POST', '/register', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->register($route, $request))->addMiddleware($svc['app.middleware.register']);

/** @see \app\controller\AuthorizationController::login() */
$router->addRoute('POST', '/login', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->login($route, $request))->addMiddleware($svc['app.middleware.login']);

/** @see \app\controller\AuthorizationController::profile() */
$router->addRoute('GET', '/profile', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->profile($route, $request))->addMiddleware($svc['app.middleware.token']);

/** @see \app\controller\AuthorizationController::edit() */
$router->addRoute('PUT', '/profile', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->edit($route, $request))->addMiddleware($svc['app.middleware.token']);
