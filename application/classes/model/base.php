<?php defined('SYSPATH') or die('No direct script access.');

abstract class Model_Base extends ORM {
	
	public function save() {
		throw new Kohana_Exception('method_not_supported');
	}
	
	public function save_all() {
		throw new Kohana_Exception('method_not_supported');
	}
}