<?php

umask(0);

defined('TESTS_BP') || define('TESTS_BP', dirname(dirname(__DIR__)));
defined('FW_BP') || define('FW_BP', TESTS_BP . '/vendor/magento/magento2-acceptance-test-framework');
defined('TESTS_MODULE_PATH') || define('TESTS_MODULE_PATH', TESTS_BP . '/tests/acceptance/Magento/AcceptanceTest');


require_once FW_BP . '/bootstrap.php';

$objectManager = \Magento\AcceptanceTestFramework\ObjectManagerFactory::getObjectManager();
/** @var $generate \Magento\AcceptanceTestFramework\Generate\GeneratePage */
$generate = $objectManager->get('Magento\AcceptanceTestFramework\Generate\GeneratePage');
$generate->launch();

\Magento\AcceptanceTestFramework\Generate\GenerateResult::displayResults();
