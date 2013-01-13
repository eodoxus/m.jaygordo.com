<?php defined('SYSPATH') OR die('No direct access allowed.');

class Drupal_Block {
	
	public $bid;
	public $title;
	public $content;
	
	protected $_controller;
	protected $_action;
	protected $_op;
	protected $_pages;
	protected $_cached;
	
	public static function factory($name, $cached = false) {
		$parts = explode('/', $name);
		if (count($parts) < 2) $parts[1] = 'index';
		
		if (count($parts) > 2) {
			array_shift($parts);
			$parts[1] = implode('-', $parts);
		}
		
		$data = array(
			'bid' => null,
			'title' => null,
			'module' => $parts[0],
			'delta' => $parts[1],
			'pages' => '*',
			'cache' => $cached,
		);
		
		return new Drupal_Block((object)$data);
	}
	
	public function __construct($data) {
		$this->bid = $data->bid;
		$this->title = $data->title;
		$this->_controller = $data->module;
		$this->_action = $data->delta;
		
		if (strpos($this->_action, '-') !== false) {
			$this->_op = strtolower(substr($this->_action, strrpos($this->_action, '-')+1));
			$this->_action = strtolower(substr($this->_action, 0, strpos($this->_action, '-')));
		}
		
		$this->_pages = $data->pages;
		$this->_cached = $data->cache == 1;
		
		if ( $this->_cached) {
			$this->content = $this->render();
		}
	}
	
	public function render() {
		if ( ! empty($this->content)) return $this->content;
		
		$this->content = '';
		$class_name = 'controller_block_'.$this->_controller;
		if (class_exists($class_name)) {
		
			try {
				$request = new Request('block/'.$this->_controller.'/'.$this->_action);
				$class = new ReflectionClass($class_name);
				$controller = $class->newInstance($request);
				$controller->block = $this;
				$controller->op = $this->_op;
				
				$method = 'action_'.$this->_action;
				if (method_exists($controller, $method)) {
					$class->getMethod('before')->invoke($controller);
					$class->getMethod($method)->invokeArgs($controller, array($this->_op));
					$class->getMethod('after')->invoke($controller);
					if ($controller->template) {
						$this->content = $controller->template->render();
					}
				}
			} catch (Exception $e) {
				// Re-throw the exception
				throw $e;
			}
		}
		
		return $this->content;
	}
	
	public function __toString() {
		return $this->render();
	}
} 

