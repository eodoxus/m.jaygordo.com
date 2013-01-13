<?php defined('SYSPATH') OR die('No direct access allowed.');

class Input {

	/**
	 * Returns a value from the $_POST array
	 */
	public static function post($key = NULL, $default = NULL, $xss_clean = TRUE) 
	{	
		if ($xss_clean) $_POST = Security::xss_clean($_POST);
	
		// if there are no post variables
		if (empty($_POST) && $key === NULL) return false;
	
		// if the key is not specified
		if (is_null($key)) return $_POST;
		
		// perform default
		return Arr::get($_POST, $key, $default);
	}
	
	/**
	 * Returns a value from the $_GET array
	 */
	public static function get($key = NULL, $default = NULL, $xss_clean = TRUE) 
	{
		if ($xss_clean) $_GET = Security::xss_clean($_GET);
	
		// if there are no post variables
		if (empty($_GET) && $key === NULL) return false;
	
		// if the key is not specified
		if (is_null($key)) return $_GET;
	
		// perform default
		return Arr::get($_GET, $key, $default);
	}
} 

