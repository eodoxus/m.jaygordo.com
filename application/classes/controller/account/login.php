<?php
/**
 * Use this service to log a user into the system and retrieve an auth_token for them. There are several types of logins supported.
 * See below...
 */
class Controller_Account_Login extends Controller_API {
	
	/**
	 * Log a user in. This service requires 2 fields in the JSON packet: <strong>type</strong> and <strong>data</strong>
	 * <br />
	 * <strong>Type</strong> can be one of the following:
	 * - jb
	 * - facebook
	 * - anonymous
	 * <br />
	 * <strong>Data</strong> depends on the value of type as follows:
	 * &nbsp;&nbsp;&nbsp;&nbsp;<strong>jb: </strong>A JSON object with 4 fields: email, deviceId and titleSKU.
	 * &nbsp;
	 * &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ex: {"type":"jb","data":{"email":"jujubase@badjuju.com","password":"sneaky!", "deviceId":"xyz123", "titleSKU":"mygame-iOS-4.13"}}
	 * <br />
	 * &nbsp;&nbsp;&nbsp;&nbsp;<strong>facebook: </strong>A JSON object with 4 fields: access_token, platform, deviceId, titleSKU.
	 * &nbsp;
	 * &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ex: {"type":"facebook","data":{"access_token":"my123example456access789token", "deviceId":"xyz123", ""titleSKU":"mygame-iOS-4.13"}}
	 *<br />
	 * &nbsp;&nbsp;&nbsp;&nbsp;<strong>anonymous: </strong>A JSON object with 2 fields: deviceId, and titleSKU. All strings.
	 * &nbsp;&nbsp;&nbsp;&nbsp; - deviceId: This is the machine id of the phone.
	 * &nbsp;&nbsp;&nbsp;&nbsp; - titleSKU: The SKU of the game for the particular platform it's running on. Needs to match a titleSKU we have in the database.
	 * &nbsp;
	 * &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ex: {"type":"anonymous","data":{""deviceId":"xyz123", , "titleSKU":"mygame-iOS-4.13"}}
	 * <br />
	 * @return object <a href="/docs#user">A user object</a> representing the user that was just logged in. <a href="#authentication">Attached to the user object will be the auth_token</a>.
	 */
	public function action_create() {
		
		$authenticator = Authentication::factory($this->post_data->type);
		$user = $authenticator->login($this->post_data->data);
		
		$this->content = $user->as_response();
		
		// Append the auth token to the user dto
		$this->content->{User::AUTH_TOKEN} = User::auth_token();
	}
}
