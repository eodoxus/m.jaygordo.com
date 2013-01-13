<?php

/**
 * @group jb
 */

class AnonymousLogin_Test extends JB_UnitTest_TestCase_Base {

	protected $url = 'account/login.json';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->anonLogin =  array(
			'deviceId' => 'unique_id_1234567',
			'titleSKU' => 'Title Sku Fixture',
		);
	}
	
	public function test_Success() {
		$post = array(
			'type' => 'anonymous',
			'data' => $this->anonLogin,
		);
		
		$result = $this->tr->request($this->url, "POST", $post);
		$this->assertSame(self::STATUS_SUCCESS, $result['status']);
		
		$user = json_decode($result['output']);
		$this->assertSame(User::ROLE_ANONYMOUS, $user->role);
	}
	
	public function test_FailMissingDeviceId() {
		
		$data = $this->anonLogin;
		unset($data['deviceId']);
		$post = array(
			'type' => 'anonymous',
			'data' => $data,
		);
		
		$result = $this->tr->request($this->url, "POST", $post);
		$this->assertSame(self::STATUS_VALIDATION_ERROR, $result['status']);
		
		$error = json_decode($result['output']);
		$this->assertSame(array(Authentication::ERROR_DEVICE_ID), $error->additional_errors);
	}
}

