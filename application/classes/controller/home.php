<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base_Site {

	public function action_index() {
		$this->title = "Jason Gordon: Web Developer";
	}
	
	public function action_page() {
		
		$post = ORM::factory('page')->find_by_url($this->request->uri);
			
		if ( ! $post->loaded()) throw new Exception_HTTP_404();
		
		$this->view->post = $post;
		$this->title = $post->title;
	} 
}
