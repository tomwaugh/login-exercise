<?php

class Logout_test extends TestCase
{
	public function test_logout()
	{
		$this->request('GET', ['details', 'logout']);
		$this->assertRedirect('home');
	}
}
?>