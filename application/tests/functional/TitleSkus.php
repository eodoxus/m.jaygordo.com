<?php

/**
 * @group jb
 */

class TitleSkus_Test extends JB_UnitTest_TestCase_Crud {
	protected $url = 'title_skus.json';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->obj =  array(
			'titleId' => 1,
			'name' => 'testTitleSKU',
		);
	}
}

