<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\SetupMage1\Application;

use Sitewards\Setup\Application\BridgeInterface;
use Sitewards\Setup\Domain\Page\PageRepositoryInterface;

final class Bridge implements BridgeInterface
{
    public function __construct()
    {
        $this->initMagento();
    }

    /**
     * Init the magento bootstrap and create the cli app and object manager
     */
    private function initMagento()
    {
        $projectRootDir = __DIR__ . '/../../../..';

        if (file_exists($projectRootDir . '/web/app/Mage.php')) {
            require $projectRootDir . '/web/app/Mage.php';
        }

        \Mage::app();
    }

    /**
     * @return PageRepositoryInterface
     */
    public function getPageRepository()
    {
        return new \Sitewards_Setup_Model_Repository_PageRepository(
            \Mage::getModel('cms/page')->getCollection()
        );
    }
}
