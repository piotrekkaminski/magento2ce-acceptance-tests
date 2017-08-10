<?php

define('PROJECT_ROOT', dirname(__DIR__));
require_once PROJECT_ROOT . '/vendor/autoload.php';
$RELATIVE_FW_PATH = '/vendor/magento/magento2-acceptance-test-framework';

//Load constants from .env file
$env = new \Dotenv\Loader(PROJECT_ROOT . '/.env');
$env->load();
foreach ($_ENV as $key => $var) {
    defined($key) || define($key, $var);
}

defined('FW_BP') || define('FW_BP', PROJECT_ROOT . $RELATIVE_FW_PATH);
