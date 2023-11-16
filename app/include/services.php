<?php

use app\controller\IndexController;
use app\controller\FilmsController;
use app\view\JsonView;
use \app\repository\FilmRepository;
use \app\middleware\ValidateFilm;

$svc['app.controller.index'] = \core\ServiceContainer::share(static function ($svc) {
    return new IndexController();
});

$svc['app.controller.films'] = \core\ServiceContainer::share(static function ($svc) {
    return new FilmsController(
        $svc['app.repository.films'],
        $svc['app.view.json'],
        $svc['config.per_page']
    );
});

$svc['app.view.json'] = \core\ServiceContainer::share(static function ($svc) {
    return new JsonView();
});

$svc['app.repository.films'] = \core\ServiceContainer::share(static function ($svc) {
    return new FilmRepository($svc['core.db.handler']);
});

$svc['app.middleware.validateFilm'] = \core\ServiceContainer::share(static function ($svc) {
    return new ValidateFilm($svc['app.repository.films']);
});



