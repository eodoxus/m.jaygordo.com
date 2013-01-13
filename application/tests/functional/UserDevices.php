<?php

/**
 * @group jb
 */

class UserDevices_Test extends JB_UnitTest_TestCase_UserCrud {
	
	protected $objType = 'devices';
	protected $testField = 'manufacturer';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->obj['deviceId'] = 'unique_id_1234567';
		$this->obj['platform'] = 'Android';
		$this->obj['softwareVersion'] = '410.900';
		$this->obj['manufacturer'] = '410.900';
		$this->obj['model_major'] = '410.900';
		$this->obj['model_minor'] = '410.900';
		$this->obj['resolution'] = '410.900';
		$this->obj['graphicsAPI'] = '410.900';
		$this->obj['graphicsAPIVersion'] = '410.900';
		$this->obj['details'] = json_decode('{"json":"string"}');
	}
	
	public function test_Create() {
		// This op isn't supported by the service so skip it
	}
	
	public function test_Update() {
		
		$this->obj[$this->testField] = $this->testUpdateValue;
		
		$result = $this->tr->request($this->url, "PUT", $this->obj);
		$this->assertSame(self::STATUS_SUCCESS, $result['status']);
		
		$obj = json_decode($result['output']);
		$this->assertSame($this->obj[$this->testField], $obj->{$this->testField});
	}
}

