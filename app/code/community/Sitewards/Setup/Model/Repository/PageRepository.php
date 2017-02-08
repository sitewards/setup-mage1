<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

use Sitewards\Setup\Domain\Page\Page;
use Sitewards\Setup\Domain\Page\PageRepositoryInterface;

final class Sitewards_Setup_Model_Repository_PageRepository implements PageRepositoryInterface
{
    /**
     * @var \Mage_Cms_Model_Resource_Page_Collection
     */
    private $pageCollection;

    public function __construct(\Mage_Cms_Model_Resource_Page_Collection $pageCollection)
    {
        $this->pageCollection = $pageCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function findByIds(array $ids)
    {
        $this->pageCollection->addFieldToFilter('identifier', [ 'in' => $ids ]);

        return $this->findItems();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->findItems();
    }

    /**
     * @return PageInterface[]
     */
    private function findItems()
    {
        $pages = [];

        /** @var \Mage_Cms_Model_Page $page */
        foreach ($this->pageCollection as $page) {
            $pages[] = new Page(
                $page->getIdentifier(),
                $page->getTitle(),
                $page->getContent(),
                $page->getIsActive()
            );
        }

        return $pages;
    }

    /**
     * {@inheritdoc}
     */
    public function import(PageInterface $page)
    {
        /** @var Mage_Cms_Model_Page $oPage */
        $oPage = Mage::getModel('cms/page');
        $oResource = $oPage->getResource();
        $iPageId = $oResource->checkIdentifier($page->getIdentifier(), 0);
        $oPage->load($iPageId);
        $oPage->setIdentifier($page->getIdentifier());
        $oPage->setTitle($page->getTitle());
        $oPage->setContent($page->getContent());
        $oPage->setIsActive($page->getActive());
        $oPage->save();
    }
}
