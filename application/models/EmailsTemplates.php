<?php

/**
 * EmailsTemplates
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     GUEST.it s.r.l. <assistenza@guest.it>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class EmailsTemplates extends BaseEmailsTemplates
{
	/**
	 * grid
	 * create the configuration of the grid
	 */	
	public static function grid($rowNum = 10) {
		
		$translator = Zend_Registry::getInstance ()->Zend_Translate;
		
		$config ['datagrid'] ['columns'] [] = array ('label' => null, 'field' => 'template_id', 'alias' => 'template_id', 'type' => 'selectall' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'ID' ), 'field' => 'template_id', 'alias' => 'template_id', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Code' ), 'field' => 'code', 'alias' => 'code', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Section' ), 'field' => 'type', 'alias' => 'type', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Name' ), 'field' => 'name', 'alias' => 'name', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['fields'] = "template_id, code AS code, name AS name, type AS type";
		
		$config ['datagrid'] ['dqrecordset'] = Doctrine_Query::create ()->select ( $config ['datagrid'] ['fields'] )->from ( 'EmailsTemplates et' );
		
		$config ['datagrid'] ['rownum'] = $rowNum;
		
		$config ['datagrid'] ['basepath'] = "/admin/serversgroups/";
		$config ['datagrid'] ['index'] = "group_id";
		$config ['datagrid'] ['rowlist'] = array ('10', '50', '100', '1000' );
		
		$config ['datagrid'] ['buttons'] ['edit'] ['label'] = $translator->translate ( 'Edit' );
		$config ['datagrid'] ['buttons'] ['edit'] ['cssicon'] = "edit";
		$config ['datagrid'] ['buttons'] ['edit'] ['action'] = "/admin/emailstemplates/edit/id/%d";
		
		$config ['datagrid'] ['buttons'] ['delete'] ['label'] = $translator->translate ( 'Delete' );
		$config ['datagrid'] ['buttons'] ['delete'] ['cssicon'] = "delete";
		$config ['datagrid'] ['buttons'] ['delete'] ['action'] = "/admin/emailstemplates/delete/id/%d";
		return $config;
	}


	/**
	 * Get a record by ID
	 * 
	 * @param $id
	 * @return Doctrine Record
	 */
	public static function find($id, $fields = "*", $retarray = false, $lang="en") {
		
		$language_id = Languages::get_language_id($lang);
		
		$dq = Doctrine_Query::create ()->select ( $fields )
									->from ( 'EmailsTemplates et' )
									->leftJoin ( "et.EmailsTemplatesData etd WITH etd.language_id = ".intval($language_id) )
									->where ( "et.template_id = ?", $id )
									->limit ( 1 );
		
		return $retarray ? $dq->fetchOne (array(), Doctrine_Core::HYDRATE_ARRAY) : $dq->fetchOne ();
	}

	/**
	 * Get a record by code
	 * 
	 * @param $id
	 * @return Doctrine Record
	 */
	public static function findByCode($code, $fields = "*", $retarray = false, $language_id = 1) {
		$dq = Doctrine_Query::create ()->select ( $fields )
									->from ( 'EmailsTemplates et' )
									->leftJoin ( "et.EmailsTemplatesData etd WITH etd.language_id = ".intval($language_id) )
									->where ( "et.code = ?", $code )
									->limit ( 1 );
		
		return $retarray ? $dq->fetchOne (array(), Doctrine_Core::HYDRATE_ARRAY) : $dq->fetchOne ();
	}


	/**
	 * Get a record by code ignoring language
	 * 
	 * @param $id
	 * @return Doctrine Record
	 */
	public static function fetchRecord($code) {
		$dq = Doctrine_Query::create ()->select ( '*' )
									->from ( 'EmailsTemplates et' )
									->where ( "et.code = ?", $code )
									->limit ( 1 );
		
		return $dq->fetchOne ();
	}


	/**
	 * Delete an email template
	 * 
	 * @param $id
	 * @return Doctrine Record
	 */
	public static function deleteByCode($code) {
		return Doctrine_Query::create ()->select ('*')
									->from ( 'EmailsTemplates et' )
									->where ( "et.code = ?", $code )
									->limit ( 1 )
									->delete();
	}


	/**
	 * getList
	 * Get a list ready for the html select object
	 * @return array
	 */
	public static function getList($type = null) {
		$translator = Zend_Registry::getInstance ()->Zend_Translate;
		$items      = array ();
		$arrFilter  = array('general');
		$items      = array($translator->translate ( 'Select ...' ));
		
		if ( !empty($type) ) {
			$arrFilter[] = $type;
		}

		$db = Doctrine_Query::create ()
				->select ( 'template_id, name' )
				->from ( 'EmailsTemplates et' )
				->where ( "et.type IN ?", $arrFilter )
				->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		
		if ( is_array($db) ) {
			foreach ( $db as $v ) {
				$items [$v ['template_id']] = $v ['name'];			
			}
		}
		
		return $items;
	}



	/**
	 * Save all the data
	 * 
	 * 
	 * @param unknown_type $data
	 * @param unknown_type $locale
	 */
	public static function saveAll($id, $params, $locale = 1) {
		$locale     = intval($locale);
		$validTypes = array('products','domains','supports','general','invoices','affiliates','customers','orders');
		
		// Set the new values
		if (is_numeric ( $id ) && $id > 0) {
			$EmailsTemplates = self::find($id, null, false, $locale);
		} else {
			if ( !empty($params['code']) ) {
				$EmailsTemplates = self::fetchRecord($params['code']);
				if ( !is_object($EmailsTemplates) ) {
					$EmailsTemplates = new self;	
				}
			}
		}

		try {
			if(is_array($params)){
				$EmailsTemplates->type      = (isset($params ['type']) && in_array($params ['type'], $validTypes)) ? $params ['type'] : 'general';
				$EmailsTemplates->name      = ! empty ( $params ['name'] ) ? $params ['name'] : '';
				$EmailsTemplates->cc        = ! empty ( $params ['cc'] ) ? $params ['cc'] : '';
				$EmailsTemplates->bcc       = ! empty ( $params ['bcc'] ) ? $params ['bcc'] : '';
				$EmailsTemplates->plaintext = (isset($params['plaintext'])) ? intval($params['plaintext']) : 0;
				$EmailsTemplates->active    = (isset($params['active'])) ? intval($params['active']) : 0;
				
				if ( !empty($params['code']) ) {
					$EmailsTemplates->code = $params['code'];
				}

				// Save the data
				$EmailsTemplates->save ();
				$template_id = $EmailsTemplates->template_id;
			
				if ( $template_id > 0 ) {
					// Save OK
					
					// Check if this templates has datas for this languages. If yes, we made an update
					$currentEmailsTemplatesData = EmailsTemplatesData::findByTemplateId($template_id, null, false, $locale);
					if ( isset($currentEmailsTemplatesData->id) && $currentEmailsTemplatesData->id > 0 ) {
						$EmailsTemplatesData = $currentEmailsTemplatesData;
					} else {
						$EmailsTemplatesData = new EmailsTemplatesData();
					}
					
					$EmailsTemplatesData->template_id = intval($template_id);
					$EmailsTemplatesData->language_id = intval($locale);
					$EmailsTemplatesData->fromname    = ! empty ( $params ['fromname'] )  ? $params ['fromname']  : '';
					$EmailsTemplatesData->fromemail   = ! empty ( $params ['fromemail'] ) ? $params ['fromemail'] : '';
					$EmailsTemplatesData->subject     = ! empty ( $params ['subject'] )   ? $params ['subject']   : '';
					$EmailsTemplatesData->html        = ! empty ( $params ['html'] )      ? $params ['html']      : '';
					$EmailsTemplatesData->text        = ! empty ( $params ['text'] )      ? $params ['text']      : '';
					$EmailsTemplatesData->save ();
										
					$email_template_date_id = $EmailsTemplatesData->id;
				}
			
				return $template_id;
			}else{
				throw new Exception('Parameters data are not correct.');
			}
		} catch ( Exception $e ) {
			echo $e->getMessage ();
			die ();
			return false;
		}
	}




}