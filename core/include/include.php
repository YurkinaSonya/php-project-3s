<?php

const INC_ROOT = __DIR__ . '/../..';
const INC_CORE = INC_ROOT . '/core';
require_once __DIR__ . '/load.php';

/** @var $svc \core\ServiceContainer */
$svc = new core\ServiceContainer();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/services.php';

require_once INC_ROOT . '/app/include/include.php';
