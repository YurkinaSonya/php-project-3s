<?php


$svc['core.router'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\Router();
});



$svc['core.http.request_builder'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\http\RequestBuilder(

    );
});

$svc['core.http.request'] = \core\ServiceContainer::share(static function ($svc) {
    /** @var \core\http\RequestBuilder $requestBuilder */
    $requestBuilder = $svc['core.http.request_builder'];
    return $requestBuilder->createFromGlobals();
});


$svc['core.view.json'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\view\JsonView();
});


$svc['core.db.handler'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\db\MySql(
        $svc['config.db.user'],
        $svc['config.db.password'],
        $svc['config.db.dbName']
    );
});
