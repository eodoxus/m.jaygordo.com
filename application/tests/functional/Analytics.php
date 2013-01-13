<?php

/**
 * @group jb
 */

class Analytics_Test extends JB_UnitTest_TestCase_Authenticated {
	
	const TYPE_SESSIONS = 'sessions';
	const TYPE_EVENTS = 'events';

	protected $url = 'analytics/<type>.json';
	
	public function setUp() {
		
		parent::setUp();
		
		$this->session = array(
			'userId' => 'unknown',
			'sessionId' => 'session_hash',
			'platform' => 'iOs',
			'deviceType' => 'iPhone',
			'deviceId' => self::$anonLogin['data']['deviceId'],
			'titleId' => 1,
			'titleSKUId' => 1,
			'dateStarted' => time(),
			'dateEnded' => time() + 1800, // You're only allowed to play for 30 minutes young man!
		);
		
		$this->event = array(
			'userId' => 'unknown',
			'sessionId' => 'session_hash',
			'sessionEventCount' => 1,
			'name' => 'some_achievement',
			'status' => 'failed',
			'platform' => 'iOs',
			'titleId' => 1,
			'date' => time(),
			'payload' => array(
				'score' => 120.34,
				'time_accumulated' => 10.32,
			),
		);
	}
	
	public function test_AnonymousSessionCreate() {
		
		// Log in anonymously
		$this->loginAnonymous();
		
		// Create a session (we should already be logged in and have a valid user object and auth token).
		$this->session['userId'] = $this->user->id;
		$url = str_replace('<type>', self::TYPE_SESSIONS, $this->url).'?auth_token='.$this->user->auth_token;
		$result = $this->tr->request($url, "POST", $this->session);
		$this->assertSame(self::STATUS_SUCCESS_CREATE, $result['status']);
	}
	
	public function test_AnonymousEventCreate() {
		
		$this->loginAnonymous();
		
		$this->event['userId'] = $this->user->id;
		$url = str_replace('<type>', self::TYPE_EVENTS, $this->url).'?auth_token='.$this->user->auth_token;
		$result = $this->tr->request($url, "POST", $this->event);
		$this->assertSame(self::STATUS_SUCCESS_CREATE, $result['status']);
	}
	
	public function test_AuthenticatedSessionCreate() {
		
		// Log in
		$this->loginAuthenticated();
		
		// Create a session (we should already be logged in and have a valid user object and auth token).
		$this->session['userId'] = $this->user->id;
		$url = str_replace('<type>', self::TYPE_SESSIONS, $this->url).'?auth_token='.$this->user->auth_token;
		$result = $this->tr->request($url, "POST", $this->session);
		$this->assertSame(self::STATUS_SUCCESS_CREATE, $result['status']);
	}
	
	public function test_AuthenticatedEventCreate() {
		
		$this->loginAuthenticated();
		
		$this->event['userId'] = $this->user->id;
		$url = str_replace('<type>', self::TYPE_EVENTS, $this->url).'?auth_token='.$this->user->auth_token;
		$result = $this->tr->request($url, "POST", $this->event);
		$this->assertSame(self::STATUS_SUCCESS_CREATE, $result['status']);
	}
}

