<?php

const INC_APP = __DIR__ . '/..';
const INC_APP_CONTROLLER = INC_APP . '/controller';
const INC_APP_REPOSITORY = INC_APP . '/repository';
const INC_APP_MODEL = INC_APP . '/model';
const INC_APP_VIEW = INC_APP . '/view';
const INC_APP_MIDDLEWARE = INC_APP . '/middleware';

require_once 'config.php';
require_once 'load.php';
require_once 'services.php';
require_once 'routes.php';
