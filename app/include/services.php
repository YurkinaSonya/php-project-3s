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
use app\repository\SubscribeRepository;
use app\middleware\SubscribeValidator;
use app\middleware\UnsubscribeValidator;
use app\middleware\CommunityValidator;
use app\middleware\ProfileValidator;


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

$svc['app.repository.subscribers'] = \core\ServiceContainer::share(static function ($svc) {
    return new SubscribeRepository(
        $svc['core.db.handler']
    );
});

$svc['app.controller.index'] = \core\ServiceContainer::share(static function ($svc) {
    return new IndexController();
});

$svc['app.controller.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityController(
        $svc['app.repository.communities'],
        $svc['app.repository.users'],
        $svc['app.repository.subscribers'],
        $svc['app.service.tokens'],
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

$svc['app.middleware.subscribe'] = \core\ServiceContainer::share(static function ($svc) {
    return new SubscribeValidator(
        $svc['app.repository.subscribers'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.unsubscribe'] = \core\ServiceContainer::share(static function ($svc) {
    return new UnsubscribeValidator(
        $svc['app.repository.subscribers'],
        $svc['app.service.tokens']
    );
});

$svc['app.middleware.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityValidator(
        $svc['app.repository.communities']
    );
});

$svc['app.middleware.profile'] = \core\ServiceContainer::share(static function ($svc) {
    return new ProfileValidator(
        $svc['app.repository.users'],
        $svc['app.service.tokens'],
        $svc['app.service.encrypt']
    );
});


