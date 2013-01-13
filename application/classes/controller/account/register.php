<?php
/**
 * Use this service to register a user. When you register a user we merge their anonymous account with the data you send up during this registration process.
 * Therefore, make sure you obtain an auth_token before using attempting to register a user, or you risk losing any data (like analytics and tracking) that was
 * created for the user during their anonymous sessions..
 * .
 * Anonymous users have a unique account that belongs specifically to the phone and application that they're using. When you log an anonymous user into the
 * system, we check if an account exists for the phone and the application. If not, we create * a new anonymous account. If it exists, we connect it to an
 * auth_token and send that back to you. That way we can track* all the history for a user, even if they haven't registered. Then, if they do register, we
 * just update a little info in their already existing account.
 */
class Controller_Account_Register extends Controller_API {
	
	/**
	 * Register a new user. You can set profile information, email address and password.
	 * <br />
	 * <strong>Type</strong> can be one of the following:
	 * - jb
	 * <br />
	 * <strong>User</strong> 
	 * <a href="/docs#user">A user JSON object</a> with <strong>no id field</strong> set.
	 * <br />
	 * <strong>Device</strong>
	 * A JSON object containing platform, deviceType, deviceId, and optional version (as you would include them in an anonymous login).
	 * <br />
	 * <strong>Example</strong>
	 * {"type":"jb","user":{"username":"testy_mctesrsauce","email":"testy@testation.test","password":"tester"},"device":{"platform":"iOS","deviceType":"iPhone","deviceId":"testy_mctestersauces_phone_12343567","version":"4.1"}}
	 * 
	 * @return object <a href="/docs#user">A user object</a> representing the user that was just created. You'll still have to log the user in to get an auth_token.
	 */
	public function action_create() {
		
		$authenticator = Authentication::factory($this->post_data->type);
		
		foreach ($this->post_data->device as $key=>$value) {
			$this->post_data->user->{$key} = $value;
		}
		
		$user = $authenticator->register($this->post_data->user);
		
		$this->request->status = 201;
		$this->content = $user->as_response();
	}
}
