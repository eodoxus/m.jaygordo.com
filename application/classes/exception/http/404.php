<?php defined('SYSPATH') or die('No direct access');

class Exception_HTTP_404 extends Exception_HTTP {
	
	public function __construct($message = 'error.not_found', array $variables = NULL, $code = 404, $escape = TRUE) {
		parent::__construct($message, $variables, $code, $escape);
	}
} // End Exception_HTTP_404
