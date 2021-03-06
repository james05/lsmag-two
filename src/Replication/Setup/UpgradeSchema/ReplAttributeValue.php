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

class ReplAttributeValue
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_attribute_value' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_attribute_value_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('Code' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('LinkField1' , Table::TYPE_TEXT, '');
        	$table->addColumn('LinkField2' , Table::TYPE_TEXT, '');
        	$table->addColumn('LinkField3' , Table::TYPE_TEXT, '');
        	$table->addColumn('LinkType' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('NumbericValue' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('Sequence' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('Value' , Table::TYPE_TEXT, '');
        	$table->addColumn('processed_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => true ], 'Processed At');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'Code' ) === false) {
        		$connection->addColumn($table_name, 'Code', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	} else {
        		$connection->modifyColumn($table_name, 'Code', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	} else {
        		$connection->modifyColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LinkField1' ) === false) {
        		$connection->addColumn($table_name, 'LinkField1', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LinkField1']);
        	} else {
        		$connection->modifyColumn($table_name, 'LinkField1', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LinkField1']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LinkField2' ) === false) {
        		$connection->addColumn($table_name, 'LinkField2', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LinkField2']);
        	} else {
        		$connection->modifyColumn($table_name, 'LinkField2', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LinkField2']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LinkField3' ) === false) {
        		$connection->addColumn($table_name, 'LinkField3', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LinkField3']);
        	} else {
        		$connection->modifyColumn($table_name, 'LinkField3', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LinkField3']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LinkType' ) === false) {
        		$connection->addColumn($table_name, 'LinkType', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'LinkType']);
        	} else {
        		$connection->modifyColumn($table_name, 'LinkType', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'LinkType']);
        	}
        	if ($connection->tableColumnExists($table_name, 'NumbericValue' ) === false) {
        		$connection->addColumn($table_name, 'NumbericValue', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'NumbericValue']);
        	} else {
        		$connection->modifyColumn($table_name, 'NumbericValue', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'NumbericValue']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Sequence' ) === false) {
        		$connection->addColumn($table_name, 'Sequence', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Sequence']);
        	} else {
        		$connection->modifyColumn($table_name, 'Sequence', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Sequence']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Value' ) === false) {
        		$connection->addColumn($table_name, 'Value', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Value']);
        	} else {
        		$connection->modifyColumn($table_name, 'Value', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Value']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	} else {
        		$connection->modifyColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	}
        	if ($connection->tableColumnExists($table_name, 'processed_at' ) === false) {
        		$connection->addColumn($table_name, 'processed_at', ['length' => '','default' => null,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Processed_at']);
        	} else {
        		$connection->modifyColumn($table_name, 'processed_at', ['length' => '','default' => null,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Processed_at']);
        	}
        }
    }


}

