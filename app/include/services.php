<?php

use app\controller\AuthorizationController;
use app\controller\CommunityController;
use app\controller\IndexController;
use app\middleware\LoginValidator;
use app\middleware\RegisterValidator;
use app\middleware\TokenMiddleware;
use app\repository\CommunityRepository;
use app\repository\TokenRepository;
use app\repository\UserRepository;
use app\service\EncryptService;
use app\service\TokenService;

$svc['app.controller.index'] = \core\ServiceContainer::share(static function ($svc) {
    return new IndexController();
});

$svc['app.repository.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityRepository($svc['core.db.handler']);
});

$svc['app.repository.tokens'] = \core\ServiceContainer::share(static function ($svc) {
    return new TokenRepository(
        $svc['core.db.handler'],
        $svc['config.token.ttl']
    );
});

$svc['app.repository.users'] = \core\ServiceContainer::share(static function ($svc) {
    return new UserRepository(
        $svc['core.db.handler']
    );
});

$svc['app.controller.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityController(
        $svc['app.repository.communities'],
        $svc['core.view.json'],
        $svc['config.per_page']
    );
});

$svc['app.controller.authorization'] = \core\ServiceContainer::share(static function ($svc) {
    return new AuthorizationController(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt'],
        $svc['core.view.json']
    );
});

$svc['app.service.tokens'] = \core\ServiceContainer::share(static function ($svc) {
    return new TokenService($svc['app.repository.tokens'], $svc['core.http.request']);
});

$svc['app.service.encrypt'] = \core\ServiceContainer::share(static function ($svc) {
    return new EncryptService($svc['config.password.salt']);
});

$svc['app.middleware.register'] = \core\ServiceContainer::share(static function ($svc) {
    return new RegisterValidator(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt']
    );
});

$svc['app.middleware.login'] = \core\ServiceContainer::share(static function ($svc) {
    return new LoginValidator(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt']
    );
});

$svc['app.middleware.token'] = \core\ServiceContainer::share(static function ($svc) {
    return new TokenMiddleware(
        $svc['app.service.tokens']
    );
});



