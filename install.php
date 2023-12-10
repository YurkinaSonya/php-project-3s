<?php

include 'core/include/include.php';

/** @var $svc \core\ServiceContainer */
/** @var \app\install\Installer */
$installer = $svc['app.installer'];

$installer->install();