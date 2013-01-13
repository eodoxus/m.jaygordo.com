<?php

class Migrate
{
	protected $_latest;
	protected $_current;
	protected $_config;

	protected $_delegate;

	protected static $_instance;
	
	protected $_failed_migration = FALSE;

	public function __construct()
	{
		$this->_config = Kohana::config('migrate');

		$this->_latest = 0;
		$this->_current = 0;

		while (class_exists('Migrate_'.($this->_latest + 1))
				|| file_exists($this->migrate_file_path(($this->_latest + 1).'.up.sql')))
		{
			// Determine maximum verison
			$this->_latest++;
		}
		
		$this->_current = $this->get_current_from_db();
	}

	public static function factory()
	{
		if ( ! isset(self::$_instance))
		{
			self::$_instance = new Migrate();
		}

		return self::$_instance;
	}

	/**
	 * Returns instance migration class
	 *
	 * @param  int  version number
	 */
	public static function migration($version)
	{
		$class = 'Migrate_'.$version;
		
		if (!class_exists($class)) {
			return new Migrate_Default($version);
		}

		$interfaces = class_implements($class);
		if (!isset($interfaces['Migrate_Base']))
			throw new Exception("$class does not implement Migrate_Base");

		return new $class();
	}

	/**
	 * Set delegate, used for status update callbacks
	 *
	 * @param Migrate_OutputDelegate $delegate
	 */
	public function setDelegate($delegate) {
		$i = class_implements($delegate);
		if (!isset($i['Migrate_OutputDelegate']))
			throw new Exception("Delegate must implement Migrate_OutputDelegate interface");

		$this->_delegate = $delegate;

		return $this;
	}

	/**
	 * Perform a migration in the appropriate direction
	 *
	 * run() will automatically determine whether up() or down() is applicable and take
	 * the appropriate action.
	 *
	 * @param int version
	 */
	public function run($version = NULL)
	{
		if ($version === NULL) {
			$version = $this->_latest;
		}

		if ($version >= $this->_current) {
			return $this->up($version);
		} else {
			return $this->down($version);
		}
	}

	/**
	 * Upgrades to given version or latest if version is ommitted
	 *
	 * @param  int  version
	 */
	public function up($version = NULL)
	{
		if ($version === NULL)
		{
			// Upgrade to latest
			$version = $this->_latest;
		}

		if ($version == $this->_current OR $version > $this->_latest) {
			return FALSE;
		}

		for ($i = $this->_current + 1; $i <= $version; $i++)
		{
			// Run all migration scripts up to target version

			try {
				Migrate::migration($i)->up();
			} catch (Exception $ex) {
				if (!empty($this->_delegate))
					$this->_delegate->migrate_step_failed($i, 'up', $ex->getMessage());
				$this->_failed_migration = TRUE;
				echo "FAILED UP ON $i --- RUNNING DOWN\n";
				Migrate::migration($i)->down();
				if (!$this->_failed_migration) throw $ex;
				break;
			}

			if (!$this->_failed_migration) {
				if (!empty($this->_delegate)) {
					$this->_delegate->migrate_step_applied($i, 'up');
				}
				$this->update_version($i);
			}
			
			if ($this->_failed_migration) {
				break;
			}
		}
		
		$this->_current = $version;
		if (!$this->_failed_migration)
				$this->update_version();
	}

	/**
	 * Downgrades to given version or previous if ommitted
	 *
	 * @param  int  version
	 */
	public function down($version = NULL)
	{
		if ($version === NULL)
		{
			// Downgrade to previous
			$version = $this->_current - 1;
		}

		if ($version == $this->_current OR $version < 0)
			return FALSE;

		for ($i = $this->_current; $i > $version; $i--)
		{
			// Run all migration scripts down to target version
			try {
				Migrate::migration($i)->down();
				if (!empty($this->_delegate)) {
					$this->_delegate->migrate_step_applied($i, 'down');
				}
				$this->update_version($i - 1);
			} catch (Exception $ex) {
				$this->_failed_migration = TRUE;
				if (!empty($this->_delegate))
					$this->_delegate->migrate_step_failed($i, 'down', $ex->getMessage());
				break;
				
				// Note: Don't throw an exception when downgrading.
			}
		}

		$this->_current = $version;
		if (!$this->_failed_migration) {
			$this->update_version();
		}
	}

	/**
	 * Current version number
	 *
	 * @return int
	 */
	public function current()
	{
		return $this->_current;
	}

	/**
	 * Latest available version upgrade script
	 *
	 * @return int
	 */
	public function latest()
	{
		return $this->_latest;
	}

	/**
	 * Executes given sql statement
	 *
	 * @param  string  statement
	 * @param  string  database name
	 */
	public function sql($sql, $db = NULL)
	{
		if ($db === NULL)
		{
			$db = $this->_config['database'];
		}

		// Run unknown type of SQL query
		DB::query(-1, $sql)->execute($db);
	}
	
	/**
	 * Return full path to specified migration filename
	 * 
	 * @param string name of file
	 */
	public function migrate_file_path($name)
	{
		return $this->_config['sql_path'].'/'.$name;
	}

	/**
	 * Executes a .sql file
	 *
	 * @param  string  name of file
	 * @param  string  database name
	 */
	public function sql_file($name, $db = NULL)
	{
		// Check path
		$path = $this->migrate_file_path($name);
		if (!file_exists($path)) {
			throw new Exception("Unable to open migrate file $path");
		}
		
		// Load SQL from file
		$sql = file_get_contents($path);

		$statements = array();

		// Keeps track of last character
		$last_char = NULL;

		// Keeps track of last string character
		$string_open_with = array(
			'"' => false, 
			'`' => false, 
			'\'' => false
		);

		$statement = '';

		// Read all characters of file, in a loop
		foreach (range(0, strlen($sql) - 1) as $i)
		{
			$c = $sql[$i];

			// In the case of a semicolon, check to see if it is embedded in a string via these keys, which act as flags
			if ($c == ';' 
			    AND !$string_open_with['\'']
			    AND !$string_open_with['`']
			    AND !$string_open_with['"']
			   )
			{
				// Found the end of a statement, so save it to the que and begin anew
				$statement = preg_replace("/;+$/", ";", $statement);
				if ($statement != '') 
					$statements[] = trim($statement);
				$statement = '';
				continue;
			}

			// If the character is a semicolon and we're in a string, or if it's another character, test for a string character
			elseif (in_array($c, array('"', '`', '\'')))
			{
				// If the string character is found while open, flip it closed.
				if($string_open_with[$c]
				   // or if nothing is open, time to open one
				   OR (!$string_open_with['\''] AND !$string_open_with['`'] AND !$string_open_with['"'])
				  )
				{
					// Escaped versions of $c should be ignored
					if ($last_char == '\\')
					{
                                		// Ignore string character entirely if it's escaped
                        	        	continue;
                	                }
        	                        else
	                                {
						// Flip the string character flag.
						$string_open_with[$c] = !$string_open_with[$c];
					}
				}
				// otherwise char $c is within some other string delimiter
			}

			// Append character to current statement
			$statement .= $c;

			$last_char = $c;
		}

		foreach ($statements as $statement)
		{
			try {
				// Execute statements
				$this->sql($statement, $db);
			} catch (Exception $e) {
				echo "\n--- Failed to execute --- \n" . $statement . "\n-------------------------\n\n";
				if (!$this->_failed_migration) {
					throw $e;
				}
			}
		}
	}

	/**
	 * Update version stored in database
	 *
	 * @param int Current version number
	 */
	protected function update_version($version = NULL)
	{
		if ($version === NULL)
			$version = $this->_current;

		DB::update($this->_config['table'])->value('version', $version)->execute($this->_config['database']);

		if ($this->get_current_from_db() != $version) {
			// Try again; maybe the initial value was set incorrectly
			DB::update($this->_config['table'])->value('version', $version)->execute($this->_config['database']);
		}

		if ($this->get_current_from_db() != $version) {
			throw new Exception('Unable to properly store database version number');
		}
	}

	/**
	 * Retrieve current version stored in the database
	 */
	protected function get_current_from_db()
	{
		$prefix = Kohana::config("database.{$this->_config['database']}.table_prefix");
		
		try {

			// Retrieve count from migration table
			$num_rows = DB::query(Database::SELECT, 'SELECT COUNT(*) AS cnt FROM `'.$prefix . $this->_config['table'] . '`')->execute($this->_config['database'])->get('cnt');

		} catch (Database_Exception $ex) {

			$this->sql('CREATE TABLE `'.$prefix.$this->_config['table'].'` ( `version` int(11) NOT NULL ) ENGINE=InnoDB', $this->_config['database']);
			$num_rows = 0;
		}

		if (!$num_rows ) {
			$this->sql('INSERT INTO `'.$prefix.$this->_config['table'].'` VALUES (' . intval($this->_current) . ' )', $this->_config['database']);
		}

		// Grab current version
		$current = DB::select('version')
			->from($this->_config['table'])
			->execute($this->_config['database'])
			->get('version');

		return $current;
	}
}
