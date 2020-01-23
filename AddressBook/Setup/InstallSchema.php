<?php


namespace Customer\AddressBook\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table = $setup->getConnection()->newTable($setup->getTable('address_book'))
            ->addColumn(
                'address_book_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Address book ID'
            )
            ->addColumn(
                'first_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'First name'
            )
            ->addColumn(
                'last_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Last name'
            )
            ->addColumn(
                'phone_number',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'phone number'
            )
            ->addColumn(
                'customer_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned'],
                'Customer ID'
            );
        $setup->getConnection()->createTable($table);
    }
}