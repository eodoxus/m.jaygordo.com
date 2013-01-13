<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form {
	
	/**
	 * Creates a field description. Label text is not automatically translated.
	 *
	 *     echo Form::description('username', 'Username');
	 *
	 * @param   string  target input
	 * @param   string  description text
	 * @param   array   html attributes
	 * @return  string
	 * @uses    HTML::attributes
	 */
	public static function description($input, $text = NULL, array $attributes = NULL)
	{
		$attributes['class'] = isset($attributes['class']) ? $attributes['class'].' description' : 'description';
		
		if ($text === NULL)
		{
			// Use the input name as the text
			$text = ucwords(preg_replace('/[\W_]+/', ' ', $input));
		}

		// Set the label target
		$attributes['for'] = $input;

		return '<span'.HTML::attributes($attributes).'>'.$text.'</span>';
	}}