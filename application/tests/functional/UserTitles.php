<?php

/**
 * @group jb
 */

class UserTitles_Test extends JB_UnitTest_TestCase_UserCrud {
	
	protected $objType = 'titles';
	protected $testField = 'titleSKUId';
	protected $testUpdateValue = 2;
	
	public function setUp() {
		
		parent::setUp();
		
		$this->obj['titleId'] = 2;
		$this->obj['titleSKUId'] = 2;
		$this->obj['userDeviceId'] = 1;
	}
}

