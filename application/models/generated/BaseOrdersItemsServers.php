<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('OrdersItemsServers', 'doctrine');

/**
 * BaseOrdersItemsServers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $relationship_id
 * @property integer $server_id
 * @property integer $order_id
 * @property integer $orderitem_id
 * @property Orders $Orders
 * @property OrdersItems $OrdersItems
 * @property Servers $Servers
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrdersItemsServers extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('orders_items_servers');
        $this->hasColumn('relationship_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('server_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
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
        $this->hasColumn('orderitem_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Orders', array(
             'local' => 'order_id',
             'foreign' => 'order_id'));

        $this->hasOne('OrdersItems', array(
             'local' => 'orderitem_id',
             'foreign' => 'detail_id'));

        $this->hasOne('Servers', array(
             'local' => 'server_id',
             'foreign' => 'server_id'));
    }
}