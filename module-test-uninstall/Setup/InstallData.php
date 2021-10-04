<?php


namespace Zfy\UninstallerTest\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);

        /**
         * Add attributes to the eav/attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'test_uninstall',
            [
                'group'        => 'default',
                'type'         => 'varchar',
                'backend'      => '',
                'frontend'     => '',
                'label'        => 'Test Attribute',
                'input'        => 'text',
                'frontend_class' => 'required-entry validate-zero-or-greater',
                'global'       => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible'      => true,
                'required'     => false,
                'user_defined' => true,
                'default'      => '',
                'searchable'   => false,
                'filterable'   => false,
                'comparable'   => false,
                'unique'       => false,
                'visible_on_front'        => false,
                'used_in_product_listing' => true
            ]
        );


		$eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'ret_crown', [
            'group' => 'default',
            'type' => 'varchar',
            'backend' => '',
            'frontend' => '',
            'label' => 'Crown',
            'input' => 'select',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
            'option' => [
                'values' => ['Solitaire','Three Stone','Bloom']]
        ]);

    }
}
