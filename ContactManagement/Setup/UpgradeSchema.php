<?php
namespace Exercice\ContactManagement\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $installer = $setup;;
        if (version_compare($context->getVersion(), '1.0.5', '<')) {
            $tableName = $setup->getTable('customer_contact');
            $searchIndexColumns = ['customer_name', 'customer_mail','contact_reason']; // Columns for the search index

            $setup->getConnection()->addIndex(
                $tableName,
                $setup->getIdxName($tableName, $searchIndexColumns, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $searchIndexColumns,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            if (!$installer->tableExists('exercice_contactmanagement_customer_reason')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('exercice_contactmanagement_customer_reason')
                )
                    ->addColumn(
                        'entity_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                        'Entity ID'
                    )
                    ->addColumn(
                        'reason',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable' => false],
                        'Reason'
                    )
                    ->setComment('Customer Reason Table');

                $installer->getConnection()->createTable($table);
            }
        }

        $setup->endSetup();
    }
}
