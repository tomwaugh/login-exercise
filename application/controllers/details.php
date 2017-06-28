<?php
class Details extends CI_Controller {

		function __construct()
		{
		parent::__construct();
			$this->load->model('users');
		}

		function index()
		{

		if ( ! file_exists(APPPATH.'views/details.php')) {
			echo APPPATH.'views/details.php';
		}
		//Load the page if the user's session is set as logged in. Failure will redirect to the home page
		if($this->session->userdata('logged_in')) {
			//Get the user's details and pass the variables into the view
			$username = $this->session->username;
			$user_result = $this->get_user_details($username);
			if($user_result){
				$this->load->view('templates/header');	
				$this->load->view('details', $user_result);
				$this->load->view('templates/footer');
			}
			else {
				redirect('home');
			}
		}
		else {
			redirect('home');
		}
        
		}

		//This function get's the users details and returns an array in a usable format.
		function get_user_details($username) {
			$user = $this->users->get_user($username);
			if($user == false) {
				return false;
			}
			else {
				foreach($user as $row){
					$data = array(
						'id'            => $row->id,
						'username'      => $row->username,
						'email'     	=> $row->email,
						'firstname'		=> $row->firstname,
						'lastname'		=> $row->lastname,
						'address'		=> $row->address
					);
				}
				return $data;
			}	
		}

		//On logout we destroy the session and redirect to the homepage
		function logout()
		{
			$this->session->sess_destroy();
			redirect('home');
		}

}