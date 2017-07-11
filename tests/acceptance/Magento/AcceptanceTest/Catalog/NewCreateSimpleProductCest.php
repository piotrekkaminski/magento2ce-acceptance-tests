<?php
namespace Magento\AcceptanceTest\Catalog;

use Magento\AcceptanceTestFramework\Step\Backend\AdminStep;
use Magento\AcceptanceTest\Catalog\Page\Adminhtml\ProductIndex;
use Magento\AcceptanceTest\Catalog\Page\Adminhtml\ProductEdit;
use Yandex\Allure\Adapter\Annotation\Features;
use Yandex\Allure\Adapter\Annotation\Stories;
use Yandex\Allure\Adapter\Annotation\Title;
use Yandex\Allure\Adapter\Annotation\Description;
use Yandex\Allure\Adapter\Annotation\Parameter;
use Yandex\Allure\Adapter\Annotation\Severity;
use Yandex\Allure\Adapter\Model\SeverityLevel;
use Yandex\Allure\Adapter\Annotation\TestCaseId;

/**
 * Class CreateProductCest
 *
 * Allure annotations
 * @Features({"Catalog"})
 * @Stories({"Create simple product"})
 *
 * Codeception annotations
 * @group catalog
 * @group add
 * @env chrome
 * @env firefox
 * @env phantomjs
 */
class NewCreateSimpleProductCest
{
    /**
     * @var array
     */
    protected $category;

    /**
     * @var array
     */
    protected $product;

    public function _before(AdminStep $I)
    {
        $I->loginAsAdmin();
        $I->goToTheAdminCatalogPage();
        $this->category = $I->getCategoryApiData();
        $this->category['id'] = $I->requireCategory($this->category)->id;
        $this->category['url_key'] = $this->category['custom_attributes'][0]['value'];
        $this->product = $I->getProductApiData('simple', $this->category['id']);
        $this->product['url_key'] = $this->product['custom_attributes'][0]['value'];
        if ($this->product['extension_attributes']['stock_item']['is_in_stock'] !== 0) {
            $this->product['stock_status'] = 'In Stock';
            $this->product['qty'] = $this->product['extension_attributes']['stock_item']['qty'];
        } else {
            $this->product['stock_status'] = 'Out of Stock';
        }
    }

    public function _after(AdminStep $I)
    {
        $I->goToTheAdminLogoutPage();
    }

    /**
     * Allure annotations
     * @Title("Create a simple product and verify on the Storefront")
     * @Description("Create a simple product in the Admin and verify the content on the Storefront.")
     * @TestCaseId("")
     * @Severity(level = SeverityLevel::CRITICAL)
     *
     * @param AdminStep $I
     * @param ProductIndex $productIndex
     * @param ProductEdit $productEdit
     * @return void
     */
    public function createSimpleProductTest(
        AdminStep $I,
        ProductIndex $productIndex,
        ProductEdit $productEdit
    ) {
        $I->wantTo('create simple product with required fields in admin product page.');
        $gridActionBlock = $productIndex->getBlockInstance('productGridAction');
        $gridActionBlock->clickButtonAddProductToggle();
        $gridActionBlock->clickButtonAddSimpleProduct();
        $productEdit->getBlockInstance('productForm')->fillFieldProductName($this->product['name']);
    }
}
