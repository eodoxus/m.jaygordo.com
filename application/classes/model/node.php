<?php defined('SYSPATH') or die('No direct script access.');

class Model_Node extends Model_Base {
	
	protected $_url;
	
	protected $_has_one = array(
		'revision' => array(
			'model' => 'node_revision',
			'foreign_key' => 'vid',
		),
	);
	
	protected $_has_many = array(
		'terms' => array(
			'model' => 'term',
			'through' => 'term_node',
			'foreign_key' => 'nid',
			'far_key' => 'tid',
		),
		
		'images' => array(
			'model' => 'file',
			'through' => 'content_field_images',
			'foreign_key' => 'nid',
			'far_key' => 'field_images_fid',
		),
	);
		
	protected $_table_name = 'node';
	protected $_primary_key  = 'nid';
	protected $_primary_val  = 'title';
	protected $_sorting = array('changed' => 'desc');
	protected $_type;
	
	public function find($id = NULL) {
		if ( ! empty($this->_load_with)) {
			foreach ($this->_load_with as $alias) {
				// Bind relationship
				$this->with($alias);
			}
		}

		$this->_build(Database::SELECT);

		if ($id !== NULL) {
			// Search for a specific column
			$this->_db_builder->where($this->_table_name.'.'.$this->_primary_key, '=', $id);
		}
		
		if ( ! empty($this->_type)) {
			$this->_db_builder->where($this->_table_name.'.type', '=', $this->_type);
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
		
		if ( ! empty($this->_type)) {
			$this->_db_builder->where($this->_table_name.'.type', '=', $this->_type);
		}

		return $this->_load_result(TRUE);
	}

	public function filter_by_term($term) {
		$this->join('term_node')->on('term_node.nid', '=', 'node.nid')
			->join('term_data')->on('term_data.tid', '=', 'term_node.tid')
			->where('term_data.name', '=', $term);
		return $this;
	}
	
	public function find_by_url($url_alias) {
		$src = DB::select('src')->from('url_alias')->where('dst', '=', $url_alias)->execute()->get('src');
		if (strpos($src, 'node/') !== false) {
			$nid = str_replace('node/', '', $src);
			$this->where('nid', '=', $nid);
			return $this->find();
		}
		
		return $this;
	}
	
	public function url() {
		if ( ! isset($this->_url)) {
			$this->_url = DB::select('dst')->from('url_alias')->where('src', '=', 'node/'.$this->nid)->execute()->get('dst');
		}
		return $this->_url;
	}
	
	public function body() {
		return isset($this->revision->body) ? $this->revision->body : '';
	}
}
