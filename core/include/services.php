<?php


$svc['core.router'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\Router();
});



$svc['core.http.request_builder'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\http\RequestBuilder(

    );
});
