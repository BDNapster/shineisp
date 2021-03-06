<?php

/**
 * Provinces
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ShineISP
 * 
 * @author     Shine Software <info@shineisp.com>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Provinces extends BaseProvinces {
	
	/**
	 * 
	 * Get all the provinces
	 */
	public static function findAll() {
		
    	return Doctrine_Query::create ()->from ( 'Provinces c' )
           								->orderBy('c.name')
           								->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );		
	}
   
    /**
     * 
     * Get all the provinces by RegionID
     */    
    public static function findAllByRegionID ( $regionid ) {
        return Doctrine_Query::create ()
                    ->from ( 'Provinces p' )
                    ->where('p.region_id = ?', array($regionid))
                    ->orderBy('p.name')
                    ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );       
        
    }    
	
	/**
	 * Find a province by id
	 * 
	 * 
	 * @param unknown_type $id
	 */
	public static function find($id) {
		return Doctrine::getTable ( 'Provinces' )->findOneBy ( 'province_id', $id );
	}

	/**
	 * Find by name
	 * 
	 * 
	 * @param unknown_type $name
	 */
	public static function findbyName($name) {
		return Doctrine::getTable ( 'Provinces' )->findOneBy ( 'name', $name );
	}

	/**
	 * Find by province code
	 * 
	 * 
	 * @param unknown_type $code
	 */
	public static function findbyCode($code) {
		return Doctrine::getTable ( 'Provinces' )->findOneBy ( 'code', $code );
	}

}