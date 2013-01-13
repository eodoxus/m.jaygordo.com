<?php defined('SYSPATH') or die('No direct script access.');

class Model_Node_Revision extends Model_Base {
	
	protected $_belongs_to = array(
		'node' => array(),
	);
		
	protected $_primary_key  = 'vid';
	protected $_primary_val  = 'body';
	protected $_sorting = array('vid' => 'desc');
}
