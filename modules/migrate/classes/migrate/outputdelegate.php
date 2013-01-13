<?php
/**
 * Migrate_OutputDelegate
 * Provides an interface for migration delegate, used for sending status messages
 * 
 * @package Migrate
 */

interface Migrate_OutputDelegate {
	/**
	 * Migration step applied successfully
	 * 
	 * @param int $num Migration step number
	 * @param string $direction Direction ("up" or "down")
	 * @param string $message Optional message
	 */
	public function migrate_step_applied($num, $direction, $message = '');

	/**
	 * Migration step applied successfully
	 * 
	 * @param int $num Migration step number
	 * @param string $direction Direction ("up" or "down")
	 * @param string $message Optional message
	 */
	public function migrate_step_failed($num, $direction, $message = '');
}
