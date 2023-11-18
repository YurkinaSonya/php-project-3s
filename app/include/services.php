<?php

use app\controller\IndexController;

$svc['app.controller.index'] = \core\ServiceContainer::share(static function ($svc) {
    return new IndexController();
});



