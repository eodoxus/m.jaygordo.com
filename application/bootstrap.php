<?php defined('SYSPATH') or die('No direct script access.');

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en_US.utf-8');
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

if (getenv('KOHANA_ENV') !== FALSE) {
	Kohana::$environment = getenv('KOHANA_ENV');
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url' => '/',
	'index_file' => '/',
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);
if (is_file(APPPATH.'config/settings.local.php')) {
	require APPPATH.'config/settings.local.php';
}

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
$modules = array(
	'drupal_block'			=> MODPATH.'drupal_block',    		// Mini framework for handling drupal blocks
	'cache'      			=> MODPATH.'cache',      			// Caching with multiple backends
	'database'   			=> MODPATH.'database',   			// Database access
	'image'					=> MODPATH.'image',					// Twerking w/ images
	'loghelper' 			=> MODPATH.'loghelper', 			// Helper for logging
	'migrate'      			=> MODPATH.'migrate',      			// For DB migrations
	'orm'        			=> MODPATH.'orm',        			// Object Relationship Mapping
	'pagination' 			=> MODPATH.'pagination', 			// Paging of results
);

if (is_file(APPPATH.'config/modules.php')) {
	require APPPATH.'config/modules.php';
}

Kohana::modules($modules);

if (Kohana::config('tests.enabled') === true) {
	$modules['unittest'] = MODPATH.'unittest';
} else {
	die("tests not enabled");
}

require APPPATH.'config/routes.php';

if( ! defined('SUPPRESS_REQUEST'))
{
	/**
	 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	 * If no source is specified, the URI will be automatically detected.
	 */
	$request = Request::instance();

	try {
		echo $request
			->execute()
			->send_headers()
			->response;
	} catch (Exception $e) {
		Kohana::$log->add(1, "Normal exception");
		LogHelper::exception($e);
		if (Kohana::config('app.debug')) {
			throw $e;
		} else {
			echo $request
				->send_headers()
				->response;
		}
	}
}

