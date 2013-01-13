<?php

/**
 * @group jb
 */

class UserAccounts_Test extends JB_UnitTest_TestCase_UserCrud {
	
	protected $objType = 'accounts';
	protected $testField = 'secret';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->url = $this->baseUrl.'users/'.$this->userId.'/'.$this->objType.'.json?auth_token='.$this->loginAdmin();
		
		$this->obj['type'] = 'google';
		$this->obj['remoteId'] = 'unit_test_remoteid';
		$this->obj['secret'] = 'secret unit test';
		$this->obj['data'] = '{"name":"unit tester"}';
	}
	
	public function test_Create() {
		return;
	}
}

