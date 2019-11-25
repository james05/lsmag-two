<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Setup\UpgradeSchema;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class LoyItem
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_loy_item' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('loy_item_id', Table::TYPE_INTEGER, NULL, 
        	                    [ 'identity' => TRUE, 'primary' => TRUE,
        	                      'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento. 0 means already added & 1 means failed into Magento tables');
        	$table->addColumn('AllowedToSell' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('BlockDiscount' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('BlockManualPriceChange' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('Blocked' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('Description' , Table::TYPE_TEXT, '');
        	$table->addColumn('Details' , Table::TYPE_TEXT, '');
        	$table->addColumn('GrossWeight' , Table::TYPE_FLOAT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('ItemCategoryCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('ItemFamilyCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('Price' , Table::TYPE_TEXT, '');
        	$table->addColumn('ProductGroupId' , Table::TYPE_TEXT, '');
        	$table->addColumn('SalesUomId' , Table::TYPE_TEXT, '');
        	$table->addColumn('ScaleItem' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('SeasonCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('UnitVolume' , Table::TYPE_FLOAT, '');
        	$table->addColumn('UnitsPerParcel' , Table::TYPE_FLOAT, '');
        	$table->addColumn('nav_id' , Table::TYPE_TEXT, '');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'AllowedToSell' ) === false) {
        		$connection->addColumn($table_name, 'AllowedToSell', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'AllowedToSell']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockDiscount' ) === false) {
        		$connection->addColumn($table_name, 'BlockDiscount', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'BlockDiscount']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockManualPriceChange' ) === false) {
        		$connection->addColumn($table_name, 'BlockManualPriceChange', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'BlockManualPriceChange']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Blocked' ) === false) {
        		$connection->addColumn($table_name, 'Blocked', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'Blocked']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Description' ) === false) {
        		$connection->addColumn($table_name, 'Description', ['type' => Table::TYPE_TEXT, 'comment' => 'Description']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Details' ) === false) {
        		$connection->addColumn($table_name, 'Details', ['type' => Table::TYPE_TEXT, 'comment' => 'Details']);
        	}
        	if ($connection->tableColumnExists($table_name, 'GrossWeight' ) === false) {
        		$connection->addColumn($table_name, 'GrossWeight', ['type' => Table::TYPE_FLOAT, 'comment' => 'GrossWeight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemCategoryCode' ) === false) {
        		$connection->addColumn($table_name, 'ItemCategoryCode', ['type' => Table::TYPE_TEXT, 'comment' => 'ItemCategoryCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemFamilyCode' ) === false) {
        		$connection->addColumn($table_name, 'ItemFamilyCode', ['type' => Table::TYPE_TEXT, 'comment' => 'ItemFamilyCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Price' ) === false) {
        		$connection->addColumn($table_name, 'Price', ['type' => Table::TYPE_TEXT, 'comment' => 'Price']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ProductGroupId' ) === false) {
        		$connection->addColumn($table_name, 'ProductGroupId', ['type' => Table::TYPE_TEXT, 'comment' => 'ProductGroupId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SalesUomId' ) === false) {
        		$connection->addColumn($table_name, 'SalesUomId', ['type' => Table::TYPE_TEXT, 'comment' => 'SalesUomId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ScaleItem' ) === false) {
        		$connection->addColumn($table_name, 'ScaleItem', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'ScaleItem']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SeasonCode' ) === false) {
        		$connection->addColumn($table_name, 'SeasonCode', ['type' => Table::TYPE_TEXT, 'comment' => 'SeasonCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitVolume' ) === false) {
        		$connection->addColumn($table_name, 'UnitVolume', ['type' => Table::TYPE_FLOAT, 'comment' => 'UnitVolume']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitsPerParcel' ) === false) {
        		$connection->addColumn($table_name, 'UnitsPerParcel', ['type' => Table::TYPE_FLOAT, 'comment' => 'UnitsPerParcel']);
        	}
        	if ($connection->tableColumnExists($table_name, 'nav_id' ) === false) {
        		$connection->addColumn($table_name, 'nav_id', ['type' => Table::TYPE_TEXT, 'comment' => 'Nav_id']);
        	}
        }
    }


}

