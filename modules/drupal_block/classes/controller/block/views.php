<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Block_Views extends Controller_Block {
	
	public function action_index() {
	}
	
	public function action_blog_categories($op) {
	}
	
	public function action_projects($op) {
		
		$this->view->projects = ORM::factory('project')
			->join('content_type_project')
				->on('content_type_project.vid', '=', 'node.vid')
			->where('promote', '=', 1)
			->order_by('created', 'desc')
			->group_by('node.vid')
			->find_all();
	}
}