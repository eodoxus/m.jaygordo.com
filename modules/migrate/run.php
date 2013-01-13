<?php
/**
 * Run database migrations, if any exist
 * 
 * Usage: php modules/migrate/run.php [target-version]
 */

// Suppress Kohana request handling
define('SUPPRESS_REQUEST', TRUE);

// Load bootstrap, presumably with request output disabled
require realpath(dirname(__FILE__) . '/../../') . '/index.php';

// Verify that our module is loaded
if (!class_exists('Migrate')) {
	migrate_fail('Please enable the \'migrate\' module in bootstrap.php before running this script');
}

$delegate = new Migrate_CommandLineOutputDelegate();

if (isset($argv) && count($argv) > 1) {
	if (intval($argv[1]) != $argv[1]) {
		migrate_fail("Unrecognized target-version: " . $argv[1]);
	}
	Migrate::factory()->setDelegate($delegate)->run(intval($argv[1]));
} else {
	Migrate::factory()->setDelegate($delegate)->run();
}

function migrate_fail($message = '') {
	if (isset($argv))
		$inv = $argv[0];
	else
		$inv = 'php modules/migrate/run.php';
	
	if (!empty($message)) {
		echo "Error: $message\n\n";
	}
	echo "Usage: $inv [target-version]\n";
	exit;
}
