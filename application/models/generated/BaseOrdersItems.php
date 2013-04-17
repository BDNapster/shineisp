<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('OrdersItems', 'doctrine');

/**
 * BaseOrdersItems
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $detail_id
 * @property integer $order_id
 * @property integer $billing_cycle_id
 * @property timestamp $date_start
 * @property timestamp $date_end
 * @property integer $autorenew
 * @property integer $quantity
 * @property float $cost
 * @property float $price
 * @property float $setupfee
 * @property integer $status_id
 * @property string $parameters
 * @property string $setup
 * @property string $note
 * @property integer $product_id
 * @property integer $tld_id
 * @property integer $review_id
 * @property string $description
 * @property BillingCycle $BillingCycle
 * @property Orders $Orders
 * @property Products $Products
 * @property Reviews $Reviews
 * @property Statuses $Statuses
 * @property DomainsTlds $DomainsTlds
 * @property Doctrine_Collection $Domains
 * @property Doctrine_Collection $Messages
 * @property Doctrine_Collection $OrdersItemsDomains
 * @property Doctrine_Collection $OrdersItemsServers
 * @property Doctrine_Collection $PanelsActions
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrdersItems extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('orders_items');
        $this->hasColumn('detail_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('order_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('billing_cycle_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('date_start', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('date_end', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('autorenew', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('quantity', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cost', 'float', 10, array(
             'type' => 'float',
             'length' => 10,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('price', 'float', 10, array(
             'type' => 'float',
             'length' => 10,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('setupfee', 'float', 10, array(
             'type' => 'float',
             'length' => 10,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('status_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('parameters', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('setup', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('note', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('product_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('tld_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('review_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('BillingCycle', array(
             'local' => 'billing_cycle_id',
             'foreign' => 'billing_cycle_id'));

        $this->hasOne('Orders', array(
             'local' => 'order_id',
             'foreign' => 'order_id'));

        $this->hasOne('Products', array(
             'local' => 'product_id',
             'foreign' => 'product_id'));

        $this->hasOne('Reviews', array(
             'local' => 'review_id',
             'foreign' => 'review_id'));

        $this->hasOne('Statuses', array(
             'local' => 'status_id',
             'foreign' => 'status_id'));

        $this->hasOne('DomainsTlds', array(
             'local' => 'tld_id',
             'foreign' => 'tld_id'));

        $this->hasMany('Domains', array(
             'local' => 'detail_id',
             'foreign' => 'orderitem_id'));

        $this->hasMany('Messages', array(
             'local' => 'detail_id',
             'foreign' => 'detail_id'));

        $this->hasMany('OrdersItemsDomains', array(
             'local' => 'detail_id',
             'foreign' => 'orderitem_id'));

        $this->hasMany('OrdersItemsServers', array(
             'local' => 'detail_id',
             'foreign' => 'orderitem_id'));

        $this->hasMany('PanelsActions', array(
             'local' => 'detail_id',
             'foreign' => 'orderitem_id'));
    }
}