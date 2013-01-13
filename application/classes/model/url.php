<?php defined('SYSPATH') or die('No direct script access.');

class Model_Url extends Model_Base {
	
	protected $_field_map = array (
		'href' => 'field_url_url',
		'title' => 'field_url_title',
		'attributes' => 'field_url_attributes',
		
	);

	protected $_table_name = 'content_field_url';
	protected $_primary_key = 'nid';
	
	
	public function __get($column) {
		if (isset($this->_field_map[$column])) {
			$column = $this->_field_map[$column];
		}
		return parent::__get($column);
	}
}