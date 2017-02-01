# Sitewards Setup Magento 1 Bridge #

This Magento 1 module is a bridge for the [sitewards setup](https://github.com/sitewards/setup) system to allow the import and export of content and configuration in Magento 2.

## Architecture ##

This module contains a bin script and an implementation of the [main module's page repository interface](https://github.com/sitewards/setup#architecture).

**bin/setup**

* Inject the Magento 1 bridge into the main application,
* Run the main application,

**Application/Bridge.php**

* Initialise the Magento1 Application,
* Build the Magento1 specific page repository,

**Repository/PageRepository.php**

* Requires the `Mage_Cms_Model_Resource_Page_Collection` class,
* Implement the `findByIds`, `findAll` and `import` methods from the main application,

## Commands ##

Current commands are as follows:

Export page(s) from Magento1 to JSON format.

`bin/setup page:export [page1] [page2]`

Import page(s) from JSON to Magento1.

`bin/setup page:import`

### Authors ###

* David Manners <david.manners@sitewards.com>
* Darko Poposki <darko.poposki@sitewards.com>
