<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Languages', 'doctrine');

/**
 * BaseLanguages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $language_id
 * @property string $language
 * @property string $locale
 * @property integer $base
 * @property integer $active
 * @property Doctrine_Collection $CmsBlocksData
 * @property Doctrine_Collection $CmsPagesData
 * @property Doctrine_Collection $DomainsTldsData
 * @property Doctrine_Collection $ProductsAttributesData
 * @property Doctrine_Collection $ProductsData
 * @property Doctrine_Collection $Wiki
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLanguages extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('languages');
        $this->hasColumn('language_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('language', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('locale', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('base', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('active', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('CmsBlocksData', array(
             'local' => 'language_id',
             'foreign' => 'language_id'));

        $this->hasMany('CmsPagesData', array(
             'local' => 'language_id',
             'foreign' => 'language_id'));

        $this->hasMany('DomainsTldsData', array(
             'local' => 'language_id',
             'foreign' => 'language_id'));

        $this->hasMany('ProductsAttributesData', array(
             'local' => 'language_id',
             'foreign' => 'language_id'));

        $this->hasMany('ProductsData', array(
             'local' => 'language_id',
             'foreign' => 'language_id'));

        $this->hasMany('Wiki', array(
             'local' => 'language_id',
             'foreign' => 'language_id'));
    }
}