<?php
/**
 * Use this service to end a user's session and release the auth_token. You'll probably never need this, but just in case...
 */
class Controller_Account_Logout extends Controller_API {
	
	/**
	 * Log the current user out.
	 */
	public function action_index() {
		User::current()->logout();
	}
}