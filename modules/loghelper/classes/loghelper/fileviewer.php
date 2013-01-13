<?php

/**
 * LogHelper FileViewer
 * Provides a way to enumerate and parse default Kohana logfiles
 */
class LogHelper_FileViewer {
	public $ignore_favicon = true;
	protected $_directory;
	protected $_files = array();
	protected $_messages = array();

	public function __construct($directory) {
		if ( ! is_dir($directory) OR ! is_writable($directory)) {
			throw new Kohana_Exception('Directory :dir must be writable',
				array(':dir' => Kohana::debug_path($directory)));
		}

		// Determine the directory path
		$this->_directory = realpath($directory).DIRECTORY_SEPARATOR;
	}

	public function list_files() {
		if (empty($this->_files)) {
			$this->_init_files();
		}
		return array_keys($this->_files);
	}

	public function get_messages($file) {
		if (empty($this->_files)) {
			$this->_init_files();
		}
		if (!isset($this->_files[$file])) {
			throw new Kohana_Exception("Invalid log file: :file", array(':file' => $file));
		}
		if (!isset($this->_messages[$file])) {
			$this->_init_messages($file);
		}
		return $this->_messages[$file];
	}

	protected function _init_files() {
		$files_by_date = array();
		$yr_paths = glob($this->_directory . "*");
		foreach ($yr_paths as $yr_path) {
			$mon_paths = glob($yr_path . DIRECTORY_SEPARATOR . '*');
			foreach ($mon_paths as $mon_path) {
				$day_paths = glob($mon_path . DIRECTORY_SEPARATOR . '*');
				$year = basename($yr_path);
				$mon = basename($mon_path);
				foreach ($day_paths as $day_path) {
					$day = preg_replace('/\..*$/', '', basename($day_path));
					$this->_files["$year-$mon-$day"] = $day_path;
				}
			}
		}
		asort($this->_files, SORT_DESC);
	}

	protected function _init_messages($file) {
		$path = $this->_files[$file];
		if (!file_exists($path) || !is_readable($path)) {
			throw new Kohana_Exception("Unable to read log file :file", array(':file' => $file));
		}
		$lines = file($path);
		$time = false;
		$msg = false;
		$type = false;
		$messages = array();
		foreach ($lines as $line) {
			if (preg_match('/^(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}:\d{2}) --- ([A-Z]+):(.*)/', $line, $matches)) {
				if ($time) {
					if ($this->ignore_favicon && preg_match('/favicon/i', $msg)) {
						// Ignore favicon
					} else {
						$messages[] = array(
							'time'		=> $time,
							'type'		=> $type,
							'message'	=> $msg,
						);
					}
				}
				$time = strtotime($matches[1] . ' ' . $matches[2]);
				$type = $matches[3];
				$msg = $matches[3] . ': ' . $matches[4];
			} else {
				$msg = trim($msg) . "\n" . $line;
			}
		}
		$messages = array_reverse($messages);
		$this->_messages[$file] = $messages;
	}
}

