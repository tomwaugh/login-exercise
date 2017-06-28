<?php
class Form extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users');
	}


	function index()
	{

		if ( ! file_exists(APPPATH.'views/login.php')) {
			echo APPPATH.'views/login.php';
		}
		//Make sure that the entered username and password are valid by calling the verify_details function
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|callback_verify_details');
		//If invalid then load the login view again
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header');
			$this->load->view('login');
			$this->load->view('templates/footer');
		}
		//If valid redirect to the secure area
		else {
			redirect('details');
		}

	}

	function verify_details()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user_result = $this->users->get_user($username);
		//Check the user exists
		if($user_result) {
			foreach($user_result as $row){
				//Verify that the passwords match
				if(password_verify($password, $row->password)){
					//Set the session for the user
					$session = $this->set_session($row->id, $row->username);					
					return true;
				}
				else {
					$this->form_validation->set_message('verify_details', 'The username or password is incorrect');
					return false;
				}
			}
		}

		else {
			$this->form_validation->set_message('verify_details', 'The username or password is incorrect'); 
			return false;
		}
	}

	function set_session($id, $username)
	{
		$session_array = array(
			'id'            => $id,
			'username'      => $username,
			'logged_in'     => TRUE
			);
		$this->session->set_userdata($session_array);
	}


}