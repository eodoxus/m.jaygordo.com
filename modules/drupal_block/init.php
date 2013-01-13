<?php defined('SYSPATH') or die('No direct script access.');

Route::set('blocks', 'block/<controller>/<action>(/<op>)',
	array(
		'op' => '(.*)',
	))
	->defaults(array(
		'directory' => 'block',
	));