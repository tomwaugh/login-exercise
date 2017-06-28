<?php
class Login extends CI_Controller {

        public function index()
        {

        if ( ! file_exists(APPPATH.'views/login.php')) {
                echo APPPATH.'views/login.php';
        }

        $this->load->view('templates/header');	
        $this->load->view('login');
        $this->load->view('templates/footer');
        }
}