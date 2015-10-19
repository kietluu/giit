<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/10/2015
 * Time: 15:36
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('stock_custom/display'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ), 'Title')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_CHAR, null, array(
        'unsigned'  => true,
        'nullable'  => false,
    ), 'Store Id')
        ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
        'unsigned'  => true,
        'nullable'  => false,
    ), 'Status')
    ->addColumn('create_date', Varien_Db_Ddl_Table::TYPE_DATETIME, 0, array(
        'nullable' => false,
    ), 'Create Date')
	->addColumn('type', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable' => false,
	), 'Type')
	->addColumn('text_default', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => true,
	), 'Text In Stock')
	->addColumn('image_default', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => true,
	), 'Image In Stock')
	->addColumn('text_out_stock', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => true,
	), 'Text Out of Stock')
	->addColumn('image_out_stock', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => true,
	), 'Image Out of Stock');
$installer->getConnection()->createTable($table);


$installer->endSetup();