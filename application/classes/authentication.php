<?php

abstract class Authentication {
	
	const ERROR_DEVICE_ID 			= 'error.login.missingDeviceId';
	const ERROR_TITLE_SKU 			= 'error.login.missingTitleSKU';	
    
    /**
	 * Creates and returns a new authenticator.
	 *
	 * @chainable
	 * @param   string  model name
	 * @return  Authentication
	 */
	public static function factory($type) {
		// Set class name
		$class = 'Authentication_'.ucfirst($type);
		return new $class();
	}
    
    /**
     * Log a user into the system
     *
     * @param mixed Login data (specific to the authentication type)
     * @return Model_User The user that was logged in
     */
    public function login($data) { }
    
    /**
     * Register a user with the system
     *
     * @param mixed Registration data (specific to the authentication type)
     * @return Model_User The user that was just created
     */
    public function register($data) { }
	
	/**
	 * Make sure a couple of fields that are required for all authentication requests are present
	 */ 
	public static function check_required_fields($data) {
		if (empty($data->deviceId)) throw new API_Exception_Validation(Authentication::ERROR_DEVICE_ID);
		if (empty($data->titleSKU)) throw new API_Exception_Validation(Authentication::ERROR_TITLE_SKU);
	}
}