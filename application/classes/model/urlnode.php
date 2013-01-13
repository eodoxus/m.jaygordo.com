<?php defined('SYSPATH') or die('No direct script access.');

abstract class Model_UrlNode extends Model_Node {
	
	public function __construct($id=null) {
		$this->_has_one['url'] = array (
			'model' => 'url',
			'foreign_key' => 'nid',
		);
		
		parent::__construct($id);
	}
}