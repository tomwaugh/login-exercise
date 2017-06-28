<?php
class Home extends CI_Controller {

        public function index()
        {

        if ( ! file_exists(APPPATH.'views/home.php')) {
                echo APPPATH.'views/home.php';
        }

        $this->load->view('templates/header');	
        $this->load->view('home');
        $this->load->view('templates/footer');
        }
}