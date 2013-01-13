<?php defined('SYSPATH') OR die('No direct access allowed.');

class Message {

	private static $ERROR_KEY 		= 'messages.error';
	private static $SUCCESS_KEY 	= 'messages.success';
	
	public static function success($message = NULL)
	{
		self::_save_message(self::$SUCCESS_KEY , $message);
	}

	public static function error($message = NULL)
	{
		self::_save_message(self::$ERROR_KEY , $message);
	}
	
	protected static function _save_message($key, $message)
	{
		$session = Session::instance();
		
		$message = is_array($message) ? $message : array($message);
		
		$existing = $session->get($key);
		if (isset($existing) && count($existing)) {
			$message = array_merge($message, $existing);
		}
		
		$session->set($key , $message);
	}
	
	public static function errors($error, $additional_errors)
	{
		if (is_array($error)) {
			$error = array_shift($error);
		}
		
		self::error($error);
		
		if (empty($additional_errors)) return;
		
		foreach ($additional_errors as $error) {
			if (is_string($error)) {
				self::error($error);
			}
		}
	}
	
	public static function render()
	{
		$session = Session::instance();
		
		$out = '';
		
		if ($messages = $session->get(self::$ERROR_KEY, FALSE)) {
			$class = 'error';
			$out .= View::factory('message/output')
				->set('class', $class)
				->set('messages', $messages);
			$session->delete( self::$ERROR_KEY );
		}
		
		if ($messages = $session->get(self::$SUCCESS_KEY, FALSE)) {
			$class = 'success';
			$out .= View::factory('message/output')
				->set('class', $class)
				->set('messages', $messages);
			$session->delete( self::$SUCCESS_KEY );
		}
		
		return $out;
	}
	
	public static function format_error_list($primary, $secondary = array(), $format = 'html') {
		
		$out = '';
		
		if (is_string($primary)) {
			$primary = array($primary);
		}
		
		switch ($format) {
			case 'html':
			default:
				$out = '<ul class="error">';
				foreach ($primary as $error) {
					$out .= '<li>'.__($error).'</li>';
				}
				foreach ($secondary as $error) {
					if (is_object($error)) {
						$error = implode(' ', (array)$error);
					}
					$out .= '<li>'.__($error).'</li>';
				}
				$out .= '</ul>';
		}
		
		return $out;
	}
	
	public static function format_message_list($messages, $format = 'html') {
		
		$out = '';
		
		if (is_string($messages)) {
			$messages = array($messages);
		}
		
		switch ($format) {
			case 'html':
			default:
				$out = '<ul class="message">';
				foreach ($messages as $msg) {
					$out .= '<li>'.__($msg).'</li>';
				}
				$out .= '</ul>';
		}
		
		return $out;
	}
} 

