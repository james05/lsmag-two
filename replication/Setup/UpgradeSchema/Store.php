<?php

namespace Ls\Replication\Setup\UpgradeSchema;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class Store implements UpgradeSchemaBlockInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'lsr_replication_store' ); 
        if ( ! $setup->tableExists( $table_name ) ) {

        	$table = $setup->getConnection()->newTable( $table_name );

        	$table->addColumn( 'store_id', Table::TYPE_INTEGER, NULL, 
        	                    [ 'identity' => TRUE, 'primary' => TRUE,
        	                      'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ] );
        	$table->addColumn( 'CurrencyCode' , Table::TYPE_TEXT );
        	$table->addColumn( 'Description' , Table::TYPE_TEXT );
        	$table->addColumn( 'Distance' , Table::TYPE_FLOAT );
        	$table->addColumn( 'Id' , Table::TYPE_TEXT );
        	$table->addColumn( 'IsClickAndCollect' , Table::TYPE_BOOLEAN );
        	$table->addColumn( 'Latitude' , Table::TYPE_FLOAT );
        	$table->addColumn( 'Longitude' , Table::TYPE_FLOAT );
        	$table->addColumn( 'Phone' , Table::TYPE_TEXT );
        	$table->addColumn( 'CAC' , Table::TYPE_BOOLEAN );
        	$table->addColumn( 'City' , Table::TYPE_TEXT );
        	$table->addColumn( 'Country' , Table::TYPE_TEXT );
        	$table->addColumn( 'County' , Table::TYPE_TEXT );
        	$table->addColumn( 'CultureName' , Table::TYPE_TEXT );
        	$table->addColumn( 'Currency' , Table::TYPE_TEXT );
        	$table->addColumn( 'DefaultCustAcct' , Table::TYPE_TEXT );
        	$table->addColumn( 'Del' , Table::TYPE_BOOLEAN );
        	$table->addColumn( 'FunctProfile' , Table::TYPE_TEXT );
        	$table->addColumn( 'Name' , Table::TYPE_TEXT );
        	$table->addColumn( 'State' , Table::TYPE_TEXT );
        	$table->addColumn( 'Street' , Table::TYPE_TEXT );
        	$table->addColumn( 'TaxGroup' , Table::TYPE_TEXT );
        	$table->addColumn( 'UserDefaultCustAcct' , Table::TYPE_INTEGER );
        	$table->addColumn( 'ZipCode' , Table::TYPE_TEXT );
        	$table->addColumn( 'scope', Table::TYPE_TEXT, 8);
        	$table->addColumn( 'scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn( 'processed', Table::TYPE_BOOLEAN, null, [ 'default' => FALSE ] );

        	$setup->getConnection()->createTable( $table );
        }
    }


}
