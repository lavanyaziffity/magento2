<?php

namespace Zfy\UninstallerTest\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Db\Select;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface as UninstallInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class Uninstall
 */
class Uninstall implements UninstallInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;
    
    private $_mDSetup;
    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $mDSetup
    )
    {
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->_mDSetup = $mDSetup;
    }

    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /** @var AdapterInterface $connection */
        $connection = $installer->getConnection();
        $connection->dropTable('wk_test'); // remove table wk_test

        $installer->endSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_mDSetup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'ret_crown'); // removing the install attribute
    }
}
