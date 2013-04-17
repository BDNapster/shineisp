<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Types', 'doctrine');

/**
 * BaseTypes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $type_id
 * @property string $type
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypes extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('types');
        $this->hasColumn('type_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('type', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
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
        
    }
}