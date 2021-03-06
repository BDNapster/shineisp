<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Regions', 'doctrine');

/**
 * BaseRegions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $region_id
 * @property integer $country_id
 * @property string $name
 * @property Countries $Countries
 * @property Doctrine_Collection $Addresses
 * @property Doctrine_Collection $Provinces
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRegions extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('regions');
        $this->hasColumn('region_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('country_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => false,
             'fixed' => 0,
             'unsigned' => false,
             'length' => '4',
             ));
        $this->hasColumn('name', 'string', 200, array(
             'type' => 'string',
             'notnull' => false,
             'length' => '200',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Countries', array(
             'local' => 'country_id',
             'foreign' => 'country_id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Addresses', array(
             'local' => 'region_id',
             'foreign' => 'region_id'));

        $this->hasMany('Provinces', array(
             'local' => 'region_id',
             'foreign' => 'region_id'));
    }
}