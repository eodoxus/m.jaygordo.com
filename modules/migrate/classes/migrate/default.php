<?php

class Migrate_Default implements Migrate_Base {
	protected $version;
	
	public function __construct($version) {
		$this->version = $version;
	}
	
	public function up() {
		Migrate::factory()->sql_file("{$this->version}.up.sql");
	}
	
	public function down() {
		Migrate::factory()->sql_file("{$this->version}.down.sql");
	}
}
