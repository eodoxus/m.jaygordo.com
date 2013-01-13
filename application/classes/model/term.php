<?php defined('SYSPATH') or die('No direct script access.');

class Model_Term extends Model_Base {
	protected $_has_many = array(
		'nodes' => array(
			'model' => 'node',
			'through' => 'term_node',
			'foreign_key' => 'nid',
		),
	);
	
	protected $_table_name = 'term_data';
	protected $_primary_key  = 'tid';
}