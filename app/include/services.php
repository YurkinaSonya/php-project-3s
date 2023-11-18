<?php

use app\controller\IndexController;
use app\repository\CommunityRepository;
use app\controller\CommunityController;

$svc['app.controller.index'] = \core\ServiceContainer::share(static function ($svc) {
    return new IndexController();
});

$svc['app.repository.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityRepository($svc['core.db.handler']);
});


$svc['app.controller.communities'] = \core\ServiceContainer::share(static function ($svc) {
    return new CommunityController(
        $svc['app.repository.communities'],
        $svc['core.view.json'],
        $svc['config.per_page']
    );
});

