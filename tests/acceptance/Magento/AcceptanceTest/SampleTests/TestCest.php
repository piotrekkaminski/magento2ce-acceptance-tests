<?php
namespace Magento\AcceptanceTest\SampleTests;

use Magento\AcceptanceTestFramework\Step\Backend\AdminStep;

/**
 * @group skip
 */
class TestCest
{
    public function _before(AdminStep $I)
    {
        $I->goToTheAdminLoginPage();
        $I->loginAsAdmin();
    }

    /**
     * @env phantomjs
     * @env chrome
     * @group example
     */
    public function accessTheSalesOrdersPage(AdminStep $I)
    {
        $I->goToTheAdminOrdersGrid();
        $I->shouldBeOnTheAdminOrdersGrid();
    }

    /**
     * @env phantomjs
     * @env chrome
     * @group example
     */
    public function accessTheProductsCatalogPage(AdminStep $I)
    {
        $I->goToTheAdminCatalogPage();
        $I->shouldBeOnTheAdminCatalogGrid();
    }
}
