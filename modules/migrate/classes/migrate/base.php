<?php
/**
 * Basic migration step interface
 * 
 * @package Migrate
 */

interface Migrate_Base
{
	public function up();

	public function down();
}