<?php defined('SYSPATH') or die('No direct script access.');

class Model_Photo extends Model_Base {
	
	protected $_has_one = array(
		'file' => array(
			'model' => 'file',
			'foreign_key' => 'fid',
		),
	);
	
	protected $_table_name = 'content_field_images';
	protected $_primary_key  = 'field_images_fid';
	protected $_primary_val  = 'field_images_fid';
	
	public function find($id = NULL) {
		if ( ! empty($this->_load_with)) {
			foreach ($this->_load_with as $alias) {
				// Bind relationship
				$this->with($alias);
			}
		}

		$this->_build(Database::SELECT);
		
		$this->_db_builder->join('files')->on('files.fid', '=', $this->_table_name.'.field_images_fid');

		if ($id !== NULL) {
			// Search for a specific column
			$this->_db_builder->where($this->_table_name.'.'.$this->_primary_key, '=', $id);
		}

		return $this->_load_result(FALSE);
	}
	
	public function find_all() {
		if ( ! empty($this->_load_with)) {
			foreach ($this->_load_with as $alias) {
				// Bind relationship
				$this->with($alias);
			}
		}

		$this->_build(Database::SELECT);
		
		$this->_db_builder->join('files')->on('files.fid', '=', $this->_table_name.'.field_images_fid');

		return $this->_load_result(TRUE);
	}
}
