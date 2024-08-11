<?php

declare(strict_types=1);

namespace Mlipski\CarSearch\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
 
class AddExampleAttributes implements DataPatchInterface
{
    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(): void
{

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'mlipski_cars_skoda',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Skoda',
                'input' => 'select',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => true,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => '',
                'option' => ['values' => ['Fabia', 'Octavia']]
            ]
        );


        $entityTypeId = $eavSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
        $attributeSetId = $eavSetup->getDefaultAttributeSetId($entityTypeId);
        
        $attributeGroupName = 'Cars settings';
        $attributeGroup = $eavSetup->getAttributeGroup($entityTypeId, $attributeSetId, $attributeGroupName);
        
        if (!$attributeGroup) {
            $eavSetup->addAttributeGroup($entityTypeId, $attributeSetId, $attributeGroupName, 100);
            $attributeGroup = $eavSetup->getAttributeGroup($entityTypeId, $attributeSetId, $attributeGroupName);
        }
        
        $attributeGroupId = $attributeGroup['attribute_group_id'];
        
        $eavSetup->addAttributeToSet(
            $entityTypeId,
            $attributeSetId,
            $attributeGroupId,
            'mlipski_cars_skoda'
        );
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