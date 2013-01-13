<?php

// Suppress Kohana request handling
define('SUPPRESS_REQUEST', TRUE);

// Load bootstrap, presumably with request output disabled
require realpath(dirname(__FILE__) . '/../../') . '/index.php';

ob_end_flush();

function usage() {
	global $argv, $argc;
	$cmd = isset($argv[0]) ? $argv[0] : basename(__FILE__);
	echo "Usage: $cmd <source-environment> [destination-environment]\n";
	exit;
}

function error($msg) {
	echo "Error: $msg\n\n";
	flush();
	usage();
}

function prompt($msg, $default = '') {
	echo $msg;
	flush();
	$input = trim(`read valu; echo \$valu`);
	if (empty($input)) $input = $default;
	return $input;
}

$mysqldump = trim(`which mysqldump`);
if (!is_executable($mysqldump)) {
	error("Unable to execute mysqldump at '$mysqldump'");
}

$mysql = trim(`which mysql`);
if (!is_executable($mysql)) {
	error("Unable to execute mysql at '$mysql'");
}

if (empty($argv) || empty($argc) || count($argv) < 2) {
	usage();
}

$src = $argv[1];
$dest = isset($argv[2]) ? $argv[2] : Kohana::$environment;

if (strtolower(prompt("SRC: $src DEST: $dest\nIs this correct? Y/n ", "y")) != 'y') {
	echo "Exiting\n";
	exit;
}

if ($dest == Kohana::STAGING || $dest == Kohana::PRODUCTION) {
	// Extra checks in here
	if (strtolower(prompt("Are you sure you want to overwrite $dest? y/N ", "n")) != 'y') {
		echo "OK, good. Exiting.\n";
		exit;
	}
}

$db_configs_src = get_database_configs($src);
$db_configs_dest = get_database_configs($dest);

foreach ($db_configs_src as $name => $src_db) {
	flush();

	if (!isset($db_configs_dest[$name])) {
		echo "Database $name exists in $src but not in $dest. Skipping.\n";
		continue;
	}
	$dest_db = $db_configs_dest[$name];

	if ($src_db['connection']['hostname'] == $dest_db['connection']['hostname']
			&& $src_db['connection']['database'] == $dest_db['connection']['database']) {
		echo "Database $name looks the same between $src and $dest. Skipping.\n";
		echo "  (host: " . $src_db['connection']['hostname'] . "; database: " . $src_db['connection']['database'] . ")\n";
		continue;
	}

	if ($src_db['table_prefix'] != $dest_db['table_prefix']) {
		error("Table prefix mixmatch for $name. $src: {$src_db['table_prefix']}; $dest: {$dest_db['table_prefix']}");
	}

    // parse out port number from hostname string and add command line argument if it exists
    $src_port_param  = '';
    $dest_port_param = '';
	if (strpos($src_db['connection']['hostname'], ':') !== false) {
        $host_port                        = explode(':', $src_db['connection']['hostname']);
        $src_port_param                   = "-P'{$host_port[1]}'";
        $src_db['connection']['hostname'] = $host_port[0];
	}
	if (strpos($dest_db['connection']['hostname'], ':') !== false) {
        $host_port                         = explode(':', $dest_db['connection']['hostname']);
        $dest_port_param                   = "-P'{$host_port[1]}'";
        $dest_db['connection']['hostname'] = $host_port[0];
	}

	echo "Dumping data from {$src_db['connection']['hostname']} $name ({$src_db['connection']['database']})\n";
	$cmd = "$mysqldump --opt --quote-names -u{$src_db['connection']['username']} -p'{$src_db['connection']['password']}' -h'{$src_db['connection']['hostname']}' {$src_port_param} {$src_db['connection']['database']} | $mysql -u{$dest_db['connection']['username']} -p'{$dest_db['connection']['password']}' -h'{$dest_db['connection']['hostname']}' {$dest_port_param} {$dest_db['connection']['database']} ";
	echo "Dump command:\n\n$cmd\n\n";
	if (strtolower(prompt("Run this command now? Y/n ", 'y')) == 'y') {
		system($cmd, $retval);
		if ($retval > 0) {
			error("Error processing the last command!");
		}
	} else {
		echo "Skipping.\n";
	}
	echo "\n";
}

function get_database_configs($env) {
	$config_readers = array(
		// Environment-specific reader
		new Kohana_Config_File('config'.DIRECTORY_SEPARATOR.'env_'.$env),
		// Global reader
		new Kohana_Config_File,
	);

	// Run local settings if they exist
	$files = array(
		APPPATH.'config'.DIRECTORY_SEPARATOR.'settings.local.php',
		APPPATH.'config'.DIRECTORY_SEPARATOR.'env_'.$env.DIRECTORY_SEPARATOR.'settings.local.php',
	);
	foreach ($files as $file) {
		if (file_exists($file)) include $file;
	}

	$result = array();
	foreach ($config_readers as $k => $reader) {
		$db = $reader->load('database');
		if (!empty($db)) {
			foreach ($db as $k => $v) {
				$result[$k] = $v;
			}
			break;
		}
	}

	return $result;
}

