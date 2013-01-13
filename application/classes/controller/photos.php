<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Photos extends Controller_Base_Site {

	public function action_index() {
		
		$this->view->pagination = new Pagination(array(
			'items_per_page' => 25,
			'orderby' => array(
				'files.timestamp' => 'desc',
			),
		));
		
		$this->view->photos = ORM::factory('photo')->paginate($this->view->pagination);
		$this->title = 'Photos';
	}
	
	public function action_view($id) {
		$photo =  ORM::factory('photo')->find($id);
		if ( ! $photo->loaded()) throw new Exception_HTTP_404();
		
		$this->title = "Photo";
		$this->view->photo = $photo;
	}
}
