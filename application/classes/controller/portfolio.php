<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Portfolio extends Controller_Base_Site {

	public function action_index() {
		
		$this->view->pagination = new Pagination(array(
			'orderby' => array(
				'sticky' => 'desc',
				'promote' => 'asc',
				'created' => 'desc',
			),
		));
		
		$this->view->posts = ORM::factory('project')->paginate($this->view->pagination);
		$this->view->set_filename('modules/posts');
		$this->title = "Portfolio";
	}
	
	public function action_view($slug) {
		
		$post =  ORM::factory('project')->find_by_url('portfolio/'.$slug);
		if ( ! $post->loaded()) throw new Exception_HTTP_404();
		
		$this->view->post = $post;
		$this->view->set_filename('modules/post');
		$this->title = 'Project: '.$post->title;
	}
}
