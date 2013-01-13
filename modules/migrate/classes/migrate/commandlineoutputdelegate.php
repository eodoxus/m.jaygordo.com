<?php
/**
 * Command line output delegate for Migrate
 * Outputs all messages to the commandline
 * 
 * @package Migrate
 */

class Migrate_CommandLineOutputDelegate implements Migrate_OutputDelegate {

	public function migrate_step_applied($num, $direction, $message = '') {
		echo "Migration step applied: $num-$direction $message\n";
	}
	public function migrate_step_failed($num, $direction, $message = '') {
		echo "*** Migration step failed: $num-$direction $message\n";
	}
}
