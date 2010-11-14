<?php
/**
 * @version $Id$
 * Kunena Translate Component
 * 
 * @package	Kunena Translate
 * @Copyright (C) 2010 www.kunena.com All rights reserved
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.com
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

class KunenaTranslateModelKunenaTranslate extends JModel {
	function __construct(){
		parent::__construct();
		$cid = JRequest::getVar('cid', array(0) );
		$this->setId($cid);
	}
	
	function setId($id){
		$this->_id = $id;
		$this->_data = NULL;
	}
	
	function getLabels(){
		$this->setId(NULL);
		$res = $this->_getLabels();
		return $res;
	}
	
	function getEdit(){
		$res = $this->_getLabels(true);
		return $res;
	}
	
	function _getLabels($edit=false){
		$table = $this->getTable('Label');
		$labels = $table->loadLabels($this->_id, $edit);
		$table = $this->getTable('Translation');
		$trans = $table->loadTranslations($this->_id);

		foreach ($labels as $k=>$v){
			$labels[$k]->lang = '';
			foreach ($trans as $value) {
				if($v->id == $value->labelid)
					$labels[$k]->lang[] = $value;
			}
		}
		
		return $labels;
	}
}