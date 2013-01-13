<?php

// Suppress Kohana request handling
define('SUPPRESS_REQUEST', TRUE);

// Load bootstrap, presumably with request output disabled
require realpath(dirname(__FILE__) . '/../../') . '/index.php';

foreach (Kohana::config('database') as $k => $db) {
	echo "-- Create database $k ({$db['connection']['database']}) on {$db['connection']['hostname']}\n";
	echo "CREATE DATABASE {$db['connection']['database']};\n";
	echo "GRANT ALL PRIVILEGES ON {$db['connection']['database']}.* to '{$db['connection']['username']}'@'localhost' IDENTIFIED BY '{$db['connection']['password']}';\n";
	echo "GRANT ALL PRIVILEGES ON {$db['connection']['database']}.* to '{$db['connection']['username']}'@'%' IDENTIFIED BY '{$db['connection']['password']}';\n\n";
}

