<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog extends Controller_Base_Site {

	public function action_index() {
		
		$this->view->pagination = new Pagination(array(
			'orderby' => array(
				'sticky' => 'desc',
				'promote' => 'asc',
				'created' => 'desc',
			),
		));
		
		$this->view->posts = ORM::factory('blog')->paginate($this->view->pagination);
		$this->title ='Blog';
		$this->view->set_filename('modules/posts');
	}
	
	public function action_view($slug) {
		
		$post =  ORM::factory('blog')->find_by_url('blog/'.$slug);
		if ( ! $post->loaded()) throw new Exception_HTTP_404();
		
		$this->view->post = $post;
		$this->title = $post->title;
		$this->view->set_filename('modules/post');
	}
}
