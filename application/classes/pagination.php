<?php defined('SYSPATH') or die('No direct script access.');

class Pagination extends Kohana_Pagination {
	
	// For sorting
	public $orderby;
	public $uri;
	public $items_per_page = 10;
	
	const MAX_ITEMS = 2147483647;
	
	public function __construct(array $config = array()) {
		if (isset($config['orderby'])) {
			$this->orderby = $config['orderby'];
		}
		
		// Override the orderby setting in the url
		if ($orderby = Input::get('orderby')) {
			$this->orderby = $orderby;
		}
		
		if ( ! isset($config['total_items'])) {
			$config['total_items'] = self::MAX_ITEMS;
		}
		
		if (isset($config['uri'])) {
			$this->uri = $config['uri'];
		}
		
		parent::__construct($config);
	}

    public function setOrderBy($orderBy)
    {
        if (isset($orderBy))
            $this->orderby = $orderBy;
    }
	
	public function info($format = '1 - 5 of 10') {
		switch ($format) {
			case '1 - 5 of 10':
			default:
				return $this->current_first_item.' - '.$this->current_last_item.' of '.$this->total_items;
		}
	}
	
	public function __set($key, $value)	{
		if ($key == 'orderby') {
			$this->orderby = $value;
		}
		$this->setup(array($key => $value));
	}
	
	public function url($page = 1) {
		
		if ($this->config['current_page']['source'] == 'route') {
			return parent::uri($page);
		}
		
		$uri = isset($this->uri) ? $this->uri : Request::instance()->uri;
		
		// Clean the page number
		$page = max(1, (int) $page);

		return URL::site($uri).URL::query(array($this->config['current_page']['key'] => $page));
	}
}