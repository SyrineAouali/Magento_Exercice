<?php
namespace Exercice\ContactManagement\Setup;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class InstallSchema implements InstallSchemaInterface

{/**
 * Install schema
 * @param SchemaSetupInterface $setup
 * @param ModuleContextInterface $context
 * @throws \Zend_Db_Exception
 */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table = $setup->getConnection()->newTable(
            $setup->getTable('customer_contact')
        )
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'customer_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Customer ID'
            )
            ->addColumn(
                'customer_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Name'
            )
            ->addColumn(
                'customer_mail',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Email'
            )
            ->addColumn(
                'customer_phone_number',
                Table::TYPE_TEXT,
                '20',
                [],
                'Customer Phone Number'
            )
            ->addColumn(
                'contact_reason',
                Table::TYPE_TEXT,
                255,
                [],
                'Contact Reason'
            )
            ->addColumn(
                'contact_request',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Contact Request'
            )
            ->addColumn(
                'contact_response',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Contact Response'
            )
            ->addColumn(
                'contact_creation_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Contact Creation Time'
            )
            ->addColumn(
                'contact_updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                'Contact Update Time'
            )
            ->setComment('Customer Contact Table');
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
