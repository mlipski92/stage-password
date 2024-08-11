<?php

declare(strict_types=1);

namespace Mlipski\CarSearch\Setup\Patch\Data;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class AddCarSearchCategory
 */
class AddCarSearchCategory implements DataPatchInterface
{
    protected $categoryFactory;
    protected $storeManager;

    public function __construct(
        CategoryFactory $categoryFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(): void
    {

        $parentCategoryId = 2; 
        $categoryName = 'All Cars';

        $category = $this->categoryFactory->create();
        $category->setName($categoryName);
        $category->setIsActive(true);
        $category->setParentId($parentCategoryId);
        $category->setStoreId($this->storeManager->getStore()->getId());
        $category->setPath($this->categoryFactory->create()->load($parentCategoryId)->getPath());

        $category->save();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}
