<?php


$svc['core.router'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\Router();
});



$svc['core.http.request_builder'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\http\RequestBuilder(

    );
});

$svc['core.db.handler'] = \core\ServiceContainer::share(static function ($svc) {
    return new \core\db\MySql(
        $svc['config.db.user'],
        $svc['config.db.password'],
        $svc['config.db.dbName']
    );
});
