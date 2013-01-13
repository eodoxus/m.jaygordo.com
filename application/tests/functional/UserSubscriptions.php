<?php

/**
 * @group jb
 */

class UserSubscriptions_Test extends JB_UnitTest_TestCase_UserCrud {
	
	protected $objType = 'subscriptions';
	protected $testField = 'status';
	protected $testUpdateValue = false;
	
	public function setUp() {
		
		parent::setUp();
		
		$this->obj['subscriptionId'] = 2;
		$this->obj['status'] = true;
	}
}

