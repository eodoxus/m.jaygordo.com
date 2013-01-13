<?php defined('SYSPATH') OR die('No direct access allowed.');

Route::set('home', '')
	->defaults(array(
		'controller'	=>	'home',
		'action'		=>	'index',
	));
	
Route::set('indexes', '<controller>',
	array(
		'controller' => '(blog|portfolio|code_examples|photos)',
	))
	->defaults(array(
		'action'		=>	'index',
	));
	
	
Route::set('details', '<controller>/<slug>',
	array(
		'slug' => '(.*)',
		'controller' => '(blog|portfolio|code_examples)',
	))
	->defaults(array(
		'action'		=>	'view',
	));

Route::set('photos', 'photos(/<action>)(/<id>)')
	->defaults(array(
		'controller' 	=> 'photos',
		'action'		=> 'index',
	));
	
Route::set('pages', '<page>',
	array(
		'page' => '(.*)',
	))
	->defaults(array(
		'controller' 	=> 'home',
		'action'		=> 'page',
	));
	
Route::set('catchall', '(<controller>)(/<action>)(/<id>)(.<format>)')
	->defaults(array(
		'controller'	=> 'home',
		'action'		=>	'index',
	));