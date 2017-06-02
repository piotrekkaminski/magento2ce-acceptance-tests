<?php
namespace Magento\AcceptanceTest\Acceptance\SampleTests;

// @group skip
$I = new \Magento\AcceptanceTestFramework\Step\Backend\AdminStep(\Codeception\Scenario::$scenario);
$I->wantTo('demo the usage of StepObject in Cept');
$I->loginAsAdmin();