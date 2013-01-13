<?php

class LogHelper {
	/**
	 * Log exception information
	 */
	public static function exception($e, $message = '', $details = true) {
		if (is_object(Kohana::$log)) {
			$out = Kohana::exception_text($e);
			if (!empty($message)) {
				$out = $message . "\n" . $out;
			}
			Kohana::$log->add(Kohana::ERROR, $out);
			if ($details) {
				Kohana::$log->add(Kohana::DEBUG, "File: " . $e->getFile() . ":" . $e->getLine() . "\n" . $e->getTraceAsString());
			}
			Kohana::$log->write();
		}
	}
}

