<?php defined('SYSPATH') OR die('No direct access allowed.');

class Drupal_Blocks {
	
	protected static $_instance;
	
	protected $_cache;
	protected $_region;
	
	public static function instance() {
		if ( ! isset(self::$_instance)) {
			self::$_instance = new Blocks();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		
		$cache_enabled = Kohana::config('app.blocks.cache_enabled');
		
		$this->_cache = Cache::instance()->get('blocks');
		if ( ! isset($this->_cache) || ! $cache_enabled) {
			
			$this->_cache = array();
		
			$blocks = DB::select('*')
				->from('blocks')
				->where('status', '=', 1)
				->where('theme', '=', Kohana::config('app.blocks.theme'))
				->order_by('weight', 'asc')
				->as_object()
				->execute();
			foreach ($blocks as $block_data) {
				$this->_cache[$block_data->region][$block_data->bid] = new Block($block_data);
			}
			
			Cache::instance()->set('blocks', $this->_cache);
		}
	}
	
	public static function region($region) {
		return self::instance()->_region($region);
	}
	
	public function _region($region) {
		if ( ! isset($this->_cache[$region])) return '';
		return View::factory('blocks/region')
			->set('blocks', $this->_cache[$region])
			->set('region', $region);
	}
} 

