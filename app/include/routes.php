<?php

use core\http\Request;

/** @var $svc core\ServiceContainer */

/** @var core\Router $router */
$router = $svc['core.router'];
$router->addRoute('GET', '/', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.index']->index($route, $request));


/** @see \app\controller\AddressController::search() */
$router->addRoute('GET', '/address/search', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.address']->search($route, $request))->addMiddleware($svc['app.middleware.address.search']);

/** @see \app\controller\AddressController::chain() */
$router->addRoute('GET', '/address/chain', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.address']->chain($route, $request))->addMiddleware($svc['app.middleware.address.chain']);


/** @see \app\controller\CommunityController::list() */
$router->addRoute('GET', '/community$', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->list($route, $request));

/** @see \app\controller\PostController::listOfPosts() */
$router->addRoute('GET', '/community/([a-zA-Z0-9\-]{3,})/post', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.posts']->listOfPosts($route, $request))->addMiddleware($svc['app.middleware.communities'])->addMiddleware($svc['app.middleware.post.filter']);

/** @see \app\controller\CommunityController::single() */
$router->addRoute('GET', '/community/([a-zA-Z0-9\-]{3,})', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->single($route, $request))->addMiddleware($svc['app.middleware.communities']);

/** @see \app\controller\CommunityController::my() */
$router->addRoute('GET', '/community/my', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->my($route, $request))->addMiddleware($svc['app.middleware.token']);

/** @see \app\controller\CommunityController::role() */
$router->addRoute('GET', '/community/([a-zA-Z0-9\-]+)/role', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->role($route, $request))->addMiddleware($svc['app.middleware.token'])->addMiddleware($svc['app.middleware.communities']);


/** @see \app\controller\CommunityController::subscribe() */
$router->addRoute('POST', '/community/([a-zA-Z0-9\-]+)/subscribe', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->subscribe($route, $request))->addMiddleware($svc['app.middleware.token'])->addMiddleware($svc['app.middleware.communities'])->addMiddleware($svc['app.middleware.subscribe']);

/** @see \app\controller\CommunityController::unsubscribe() */
$router->addRoute('DELETE', '/community/([a-zA-Z0-9\-]+)/unsubscribe', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.communities']->unsubscribe($route, $request))->addMiddleware($svc['app.middleware.token'])->addMiddleware($svc['app.middleware.communities'])->addMiddleware($svc['app.middleware.unsubscribe']);


/** @see \app\controller\PostController::listOfTags() */
$router->addRoute('GET', '/tag', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.posts']->listOfTags($route, $request));

/** @see \app\controller\PostController::concretePost() */
$router->addRoute('GET', '/post/([a-zA-Z0-9\-]+)', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.posts']->concretePost($route, $request))->addMiddleware($svc['app.middleware.post.get']);

/** @see \app\controller\PostController::listOfPosts() */
$router->addRoute('GET', '/post', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.posts']->listOfPosts($route, $request))->addMiddleware($svc['app.middleware.post.filter']);


/** @see \app\controller\PostController::getNestedComments() */
$router->addRoute('GET', '/comment/([a-zA-Z0-9\-]+)/tree', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.posts']->getNestedComments($route, $request));




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

/** @see \app\controller\AuthorizationController::logout() */
$router->addRoute('POST', '/logout', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->logout($route, $request))->addMiddleware($svc['app.middleware.token']);



/** @see \app\controller\AuthorizationController::profile() */
$router->addRoute('GET', '/profile', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->profile($route, $request))->addMiddleware($svc['app.middleware.token']);

/** @see \app\controller\AuthorizationController::edit() */
$router->addRoute('PUT', '/profile', fn(
    core\Route $route,
    Request    $request
) => $svc['app.controller.authorization']->edit($route, $request))->addMiddleware($svc['app.middleware.token'])->addMiddleware($svc['app.middleware.profile']);


