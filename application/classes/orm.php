<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
	
	public function paginate(Pagination $pager) {
		$this->offset($pager->offset);
		$this->limit($pager->items_per_page);
		
		if ( isset($pager->orderby)) {
			
			$sort_options = is_string($pager->orderby) ? array($pager->orderby) : $pager->orderby;
			foreach ($sort_options as $orderby=>$direction) {
				 $this->order_by($orderby, $direction);
			}
		}
		
		$objects = $this->find_all();
		$pager->total_items = $this->_db->count_last_query();
		return $objects;
	}

}