<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

//Load constants from .env file
$env = new \Dotenv\Loader(dirname(__DIR__) . '/.env');
$env->load();

foreach ($_ENV as $key => $var) {
    defined($key) || define($key, $var);
}

defined('TESTS_BP') || define('TESTS_BP', dirname(__DIR__));
defined('FW_BP') || define('FW_BP', TESTS_BP . '/vendor/magento/magento2-acceptance-test-framework');
defined('TESTS_MODULE_PATH') || define('TESTS_MODULE_PATH', TESTS_BP . '/tests/acceptance/Magento/AcceptanceTest');
