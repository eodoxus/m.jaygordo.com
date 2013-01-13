<?php

/**
 * @group jb
 */

class Subscriptions_Test extends JB_UnitTest_TestCase_Crud {
	
	protected $url = 'subscriptions.json';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->obj =  array(
			'titleId' => 1,
			'name' => 'testSubscription',
			'description' => 'created from test',
		);
	}
}

