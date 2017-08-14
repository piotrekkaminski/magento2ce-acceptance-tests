# Built With
* [Codeception](http://codeception.com/)
* [Robo](http://robo.li/)
* [Allure](http://allure.qatools.ru/)

----

# Prerequisites
* [PHP v7.x](http://php.net/manual/en/install.php)
* [Composer v1.4.x](https://getcomposer.org/download/)
* [Allure CLI](https://docs.qameta.io/allure/latest/#_installing_a_commandline)
* [GitHub](https://desktop.github.com/)
* GitHub Repos:
  * [CE Tests](https://github.com/magento-pangolin/magento2ce-acceptance-tests)
  * [EE Tests](https://github.com/magento-pangolin/magento2ee-acceptance-tests)

### Recommendations
We recommend using [PHPStorm 2017](https://www.jetbrains.com/phpstorm/) for your IDE. They recently added support for [Codeception Test execution](https://blog.jetbrains.com/phpstorm/2017/03/codeception-support-comes-to-phpstorm-2017-1/) which is helpful when debugging.

----

# Installation
You can **either** install through composer **or** clone from git repository.
##Git
  *
    ```
    git clone GITHUB_REPO_URL
    cd magento2ce-acceptance-tests
    composer install
    ```
##Composer
  * 
    ```
    mkdir DIR_NAME
    cd DIR_NAME
    composer create-project --repository-url=GITHUB_REPO_URL magento/magento2ce-acceptance-tests-metapackage
    ```

----

# Robo
Robo is a task runner for PHP that allows you to alias long complex CLI commands to simple commands.

### Example

* Original: `allure generate tests/_output/allure-results/ -o tests/_output/allure-report/`
* Robo: `robo allure:generate`

## Available Robo Commands
You can see a list of all available Robo commands by calling `robo` directly in the Terminal.

* `robo`
  * Lists all available Robo commands.
* `robo clone:files`
  * Duplicate the Example configuration files used to customize the Project
* `robo build:project`
  * Build the Codeception project
* `robo generate:pages`
  * Generate all Page Objects
* `robo generate:tests`
  * Generate all Tests in PHP
* `robo example`
  * Run all Tests marked with the @group tag 'example', using the Chrome environment
* `robo chrome`
  * Run all Acceptance tests using the Chrome environment
* `robo firefox`
  * Run all Acceptance tests using the FireFox environment
* `robo phantomjs`
  * Run all Acceptance tests using the PhantomJS environment
* `robo folder`
  * Run all Acceptance tests located under the Directory Path provided using the Chrome environment
* `robo group`
  * Run all Tests with the specified @group tag, excluding @group 'skip', using the Chrome environment
* `robo allure:generate`
  * Generate the HTML for the Allure report based on the Test XML output
* `robo allure:open`
  * Open the HTML Allure report
* `robo allure:report`
  * Generate and open the HTML Allure report

----

# Building The Framework
After installing the dependencies you will want to build the Codeception project in the [Acceptance Test Framework](https://github.com/magento-pangolin/magento2-acceptance-test-framework), which is a dependency of the CE or EE Tests repo. Run `robo build:project` to complete this task.

`robo build:project`

----

# Configuration
The commands `robo setup`, `robo clone:files` or `robo build:project` will copy Example Configuration files that you can edit with out the fear of accidentally committing credentials or other information as these files are listed in the *.gitignore* file.
In these files you will find key pieces of information that is unique to your Magento setup that will need to be edited (ex **MAGENTO_BASE_URL**, **MAGENTO_ADMIN_USERNAME**, **MAGENTO_ADMIN_PASSWORD**, etc...).
* **tests/acceptance.suite.yml**
* **codeception.dist.yml**
* **.env**

----

# Running Tests
## Run Tests Manually
You can run the Codeception tests directly without using Robo if you'd like. To do so please run `codecept run acceptance` to execute all Acceptance tests that DO NOT include @env tags. IF a Test includes an [@env tag](http://codeception.com/docs/07-AdvancedUsage#Environments) you MUST include the `--env ENV_NAME` flag.

#### Common Codeception Flags:

* --env
* --group
* --skip-group
* --steps
* --verbose
* --debug
  * [Full List of CLI Flags](http://codeception.com/docs/reference/Commands#Run)

#### Examples

* Run ALL Acceptance Tests without an @env tag: `codecept run acceptance`
* Run ALL Acceptance Tests without the "skip" @group: `codecept run acceptance --skip-group skip`
* Run ALL Acceptance Tests with the @group tag "example" without the "skip" @group tests: `codecept run acceptance --group example --skip-group skip`

## Run Tests using Robo
* Run all Acceptance Tests using the @env tag "chrome": `robo chrome`
* Run all Acceptance Tests using the @env tag "firefox": `robo firefox`
* Run all Acceptance Tests using the @env tag "phantomjs": `robo phantomjs`
* Run all Acceptance Tests using the @group tag "example": `robo example`
* Run all Acceptance Tests using the provided @group tag: `robo group GROUP_NAME`
* Run all Acceptance Tests listed under the provided Folder Path: `robo folder tests/acceptance/Magento/AcceptanceTest/MODULE_NAME`

----

# Allure Reports
### Manually
You can run the following commands in the Terminal to generate and open an Allure report.

* Build the Report: `allure generate tests/_output/allure-results/ -o tests/_output/allure-report/`
* Open the Report: `allure report open --report-dir tests/_output/allure-report/`

### Using Robo
You can run the following Robo commands in the Terminal to generate and open an Allure report.

* Build the Report: `robo allure:generate`
* Open the Report: `robo allure:open`
* Build/Open the Report: `robo allure:report`

----

# Composer SymLinking
Due to the interdependent nature of the 2 repos it is recommended to Symlink the repos so you develop locally easier. Please refer to this GitHub page: https://github.com/gossi/composer-localdev-plugin

----

# Troubleshooting
* TimeZone Error - http://stackoverflow.com/questions/18768276/codeception-datetime-error
* TimeZone List - http://php.net/manual/en/timezones.america.php
* System PATH - Make sure you have `vendor/bin/` and `vendor/` listed in your system path so you can run the  `codecept` and `robo` commands directly:

    `sudo nano /etc/private/paths`
    
    * StackOverflow Help: https://stackoverflow.com/questions/7703041/editing-path-variable-on-mac