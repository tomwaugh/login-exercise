<?php

class Get_users_test extends TestCase
{
	public function setup(){
		$this->resetInstance();
        $this->CI->load->model('users');
        $this->obj = $this->CI->users;
	}

	public function test_get_users_true()
	{
		$expected = array(
				'id'            => 1,
       		    'username'      => 'tomwaugh',
       		    'password'		=> '$2a$06$M/uHeYK2xRx0j29y01Ha8u0VCgjK24iBfgpF1gqUEvURpGtRL79TK',
                'email'     	=> 'tom@email.com',
                'firstname'		=> 'Tom',
                'lastname'		=> 'Waugh',
                'address'		=> 'wilmslow'
				);
		$data = $this->obj->get_user('tomwaugh');
		foreach($data as $row){
        	$output = array(
        		'id'            => $row->id,
                'username'      => $row->username,
                'password'		=> $row->password,
                'email'     	=> $row->email,
                'firstname'		=> $row->firstname,
                'lastname'		=> $row->lastname,
                'address'		=> $row->address
        		);
        }
		$this->assertEquals($expected, $output);
	}

    public function test_get_users_blank()
    {
        $expected = false;
        $output = $this->obj->get_user('');
        $this->assertEquals($expected, $output);
    }

    public function test_check_email_true()
    {
        $expected = true;
        $output = $this->obj->check_email('tom@email.com');
        $this->assertEquals($expected, $output);
    }

    public function test_check_email_false()
    {
        $expected = false;
        $output = $this->obj->check_email('thisisnotanemail');
        $this->assertEquals($expected, $output);
    }
}
?>