<?php

class Home_test extends TestCase
{
	public function test_get_home()
	{
		$output = $this->request('GET', ['home', 'index']);
		$expected = '<h2>Welcome</h2>';

		$this->assertContains($expected, $output);
	}

	public function test_get_link()
	{
		$output = $this->request('GET', ['home', 'index']);
		$expected = 'Click here to login!';

		$this->assertContains($expected, $output);
	}
}
?>