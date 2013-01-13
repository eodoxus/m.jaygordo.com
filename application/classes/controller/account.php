<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Base_Site {

	public function action_index() {
		if ( ! User::current()) $this->request->redirect('account/login');
	}
	
	public function action_login() {
		$authenticator = Authentication::factory($this->post_data->type);
		$user = $authenticator->login($this->post_data->data);
		
		$this->content = $user->as_response();
		
		// Append the auth token to the user dto
		$this->content->{User::AUTH_TOKEN} = User::auth_token();
	}
	
	public function action_logout() {
		User::current()->logout();
		Message::success("You've been logged out.");
		$this->request->redirect('');
	}
	
	public function action_register() {
		$authenticator = Authentication::factory($this->post_data->type);
		
		foreach ($this->post_data->device as $key=>$value) {
			$this->post_data->user->{$key} = $value;
		}
		
		$user = $authenticator->register($this->post_data->user);
		
		$this->request->status = 201;
		$this->content = $user->as_response();
	}
} // End Welcome
