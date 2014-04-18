<?php

/**
 * DomainsNichandle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class DomainsNichandle extends BaseDomainsNichandle
{

    /**
     * Get the domain nichandle profile
     * 
     * @param integer $id
     * @param string $fields
     * @return Ambigous <Doctrine_Collection, mixed, PDOStatement, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown, number>
     */
    public static function getProfile($id, $type="owner") {
		$dq = Doctrine_Query::create ()->select('profile_id as profile')
		                      ->from ( 'DomainsNichandle dn' )
		                      ->where ( "dn.domain_id = ?", $id )
		                      ->andWhere ( "dn.type = ?", $type )->limit(1);
		
		$profile = $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
		if(!empty($profile[0])){
		    return $profile[0]['profile'];
		}
		
		return null;
	}

    /**
     * Get the domain nichandle information
     * 
     * @param integer $id
     * @param string $fields
     * @param integer $hydrationmode
     * @return Ambigous <Doctrine_Collection, mixed, PDOStatement, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown, number>
     */
    public static function getNichandle($domain_id, $profile_id, $type="owner") {
		$dq = Doctrine_Query::create ()
		                      ->from ( 'DomainsNichandle dn' )
		                      ->where ( "dn.domain_id = ?", $domain_id )
		                      ->andWhere ( "dn.profile_id = ?", $profile_id )
		                      ->andWhere ( "dn.type = ?", $type )
		                      ->limit(1);
		
		return $dq->fetchOne ();
	}

    /**
     * Get the domains attached to a particular profile id
     * 
     * @param integer $profileId
     * @return Ambigous <Doctrine_Collection, mixed, PDOStatement, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown, number>
     */
    public static function getDomains($profileId) {
		$dq = Doctrine_Query::create ()->select('d.domain as domain, ws.tld as tld')
		                      ->from ( 'DomainsNichandle dn' )
		                      ->leftJoin ( 'dn.Domains d' )
		                      ->leftJoin ( 'd.DomainsTlds tlds' )
		                      ->leftJoin ( 'tlds.WhoisServers ws' )
		                      ->where ( "dn.profile_id = ?", $profileId );
		
		return $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
	}

    /**
     * Count how many times the profile has been used 
     * 
     * @param integer $profileId
     * @return Ambigous <Doctrine_Collection, mixed, PDOStatement, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown, number>
     */
    public static function isUsed($profileId) {
		$dq = Doctrine_Query::create ()
		                      ->from ( 'DomainsNichandle dn' )
		                      ->where ( "dn.profile_id = ?", $profileId );
		
		$record = $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
		
		return count($record);
	}

    /**
     * Get the domain nichandle information
     * 
     * @param integer $id
     * @param string $fields
     * @param integer $hydrationmode
     * @return Ambigous <Doctrine_Collection, mixed, PDOStatement, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown, number>
     */
    public static function find($id, $fields = null, $hydrationmode = Doctrine_Core::HYDRATE_ARRAY) {
		$dq = Doctrine_Query::create ()
		                      ->from ( 'DomainsNichandle dn' )
		                      ->leftJoin ( 'dn.Domains d' )
		                      ->leftJoin ( 'd.DomainsTlds tlds' )
		                      ->leftJoin ( 'tlds.WhoisServers ws' )
		                      ->leftJoin ( 'd.Customers c' )
		                      ->leftJoin ( 'd.CustomersDomainsRegistrars cdr' )
		                      ->leftJoin ( 'd.Statuses s' )
		                      ->where ( "dn.domain_id = ?", $id );
		
		if(!empty($fields)){
			$dq->select ( $fields );
		}                      
        
		$domain = $dq->execute ( array (), $hydrationmode );
		return $domain;
	}
    
    /**
     * Add a new nichandle reference
     */
    public static function setNicHandle($domain_id, $profile_id, $type="owner") {
        
        try{
            
            if(!empty($profile_id) && is_numeric($profile_id)){
                $nicHandle = new DomainsNichandle();
                $nicHandle->domain_id = $domain_id;
                $nicHandle->profile_id = $profile_id;
                $nicHandle->type = $type;
                
                if ($nicHandle->trySave()){
                    return true;
                }
            }
            return false;
            
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    
    /**
     * Add multiple nicHandle reference to a domain
     */
    public static function setNicHandles($domain_id, $owner, $admin=null, $tech=null, $billing=null) {
        
        try{
            // clear the domain nicHandles
            self::clearNicHandles($domain_id);
            
            // Save the nicHandles
            self::setNicHandle($domain_id, $owner);
            self::setNicHandle($domain_id, $admin, "admin");
            self::setNicHandle($domain_id, $tech, "tech");
            self::setNicHandle($domain_id, $billing, "billing");
            
            return false;
            
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    
    /**
     * Delete all the domains nicHandle profiles
     * @param $domain_id
     * @return boolean
     */
    public static function clearNicHandles($domain_id) {
        if(is_numeric($domain_id)){
            return Doctrine_Query::create ()->delete('DomainsNichandle')->where('domain_id = ?', $domain_id)->execute();
        }
        return false;
    }
}