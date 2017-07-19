<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */

class RoboFile extends \Robo\Tasks
{
    use Robo\Task\Base\loadShortcuts;

    // Define public methods as commands
    function cloneFiles() {
        $this->_exec('cp -vn .env.example .env');
        $this->_exec('cp -vn codeception.dist.yml codeception.yml');
        $this->_exec('cp -vn tests/acceptance.suite.dist.yml tests/acceptance.suite.yml');
    }

    // Generate page objects
    function generatePages() {
        $this->_exec('cd vendor/magento/magento2-acceptance-test-framework/src/Magento/AcceptanceTestFramework/Util && php PageGenerator.php');
    }

    // Build project.
    function buildProject() {
        $this->cloneFiles();
        $this->_exec('vendor/bin/codeception build');
    }

    function allureGenerate() {
        return $this->_exec('allure generate tests/_output/allure-results/ -o tests/_output/allure-report/');
    }

    function allureOpen() {
        $this->_exec('allure report open --report-dir tests/_output/allure-report/');
    }

    function allureReport() {
        $result1 = $this->allureGenerate();

        if ($result1->wasSuccessful()) {
            $this->allureOpen();
        }
    }

    function code(array $args) {
        $this->_exec('codecept run ' . implode(' ', $args));
        $this->allureReport();
    }

    function test() {
        $this->chrome();
        $this->allureReport();
    }

    function example() {
        $this->_exec('codecept run --env chrome --group example --skip-group skip');
        $this->allureReport();
    }

    function group($args = '') {
        $this->taskExec('codecept run acceptance --verbose --steps --env chrome --skip-group skip --group')->args($args)->run();
    }

    function chrome() {
        $this->_exec('codecept run acceptance --env chrome --skip-group skip');
        $this->allureReport();
    }

    function generated() {
        $this->_exec('codecept run acceptance --env chrome --skip-group skip --group generated');
    }

    function firefox() {
        $this->_exec('codecept run acceptance --env firefox --skip-group skip');
        $this->allureReport();
    }

    function phantomjs() {
        $this->_exec('codecept run acceptance --env phantomjs');
        $this->allureReport();
    }

    function catalog()
    {
        $this->_exec('codecept run --env chrome --group catalog');
        $this->allureReport();
    }

    function folder($args = '')
    {
        $this->taskExec('codecept run acceptance --env chrome')->args($args)->run();
    }

    function generateTests()
    {
        $this->_exec('cd vendor/magento/magento2-acceptance-test-framework/src/Magento/AcceptanceTestFramework/Util && php TestGenerator.php');
    }
}
