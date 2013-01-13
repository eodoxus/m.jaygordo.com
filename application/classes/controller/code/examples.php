<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Code_Examples extends Controller_Base_Site {

	public function action_index() {
		
		$this->view->pagination = new Pagination(array(
			'orderby' => array(
				'sticky' => 'desc',
				'promote' => 'asc',
				'created' => 'desc',
			),
		));
		
		$this->view->posts = ORM::factory('blog')
			->filter_by_term('code')
			->paginate($this->view->pagination);
		$this->view->set_filename('modules/posts');
		$this->title = 'Code Examples';
	}

}
