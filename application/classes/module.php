<?php defined('SYSPATH') OR die('No direct access allowed.');

class Module {
	
	/**
	 * Includes a file and returns the view to assign variables,
	 * This can send a request to a server
	 */
	public static function render($name, $request = FALSE, $data = null)
	{
		$name = 'modules/' . str_replace('.', '/', $name);
		$view = NULL;
		
		// If it is local
		if ($request === FALSE)
		{
			$view = View::factory($name, $data);
		}
		
		// If it has dynamic content
		else
		{
			$view = Request::factory($name)->execute();
		}
		
		return $view;
	}
} 

