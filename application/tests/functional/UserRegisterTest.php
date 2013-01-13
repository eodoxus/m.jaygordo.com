<?php

/**
 * @group jb
 */

class UserRegister_Test extends JB_UnitTest_TestCase_Base {
	
	protected $url = 'account/register.json';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->user = array(
			'id' => 1,
			'username' => 'testy_mctesrsauce',
			'email' => 'testy@testation.test',
			'password' => 'tester',
			'firstName' => 'testy',
			'lastName' => 'mctestersauce',
			'gender' => 'M',
			'birthDate' => '01/17/1979',
			'addressLine1' => '1234 Sesame St',
			'addressLine2' => 'Apt B',
			'addressLine3' => 'Under the Couch',
			'city' => 'Aliso Viejo',
			'stateCode' => 'CA',
			'regionCode' => 'Orange County',
			'countryCode' => 'US',
			'postalCode' => '92656',
			'phone' => '1234567890',
			'timeZone' => 'America/Los_Angeles',
			'preferredLanguage' => 'en_US',			
		);
		
		$this->device = array(
			'deviceId' => 'testy_mctestersauces_phone_12343567',
			'titleSKU' => 'Title Sku Fixture',
		);
	}
	
	public function test_Success() {
		$post = array(
			'type' => 'jb',
			'user' => $this->user,
			'device' => $this->device,
		);
		
		$result = $this->tr->request($this->url, "POST", $post);
		$this->assertSame(self::STATUS_SUCCESS_CREATE, $result['status']);
		
		$user = json_decode($result['output']);
		$this->assertSame(User::ROLE_AUTHENTICATED, $user->role);
	}
}

