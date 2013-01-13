<?php defined('SYSPATH') or die('No direct access');

class Exception_HTTP extends Kohana_Exception {
	
	public function __construct($message = 'error.http', array $variables = NULL, $code = NULL, $escape = TRUE) {
		parent::__construct($message, $variables, $code, $escape);
	}
} // End Exception_HTTP


