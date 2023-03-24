<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	// load the constructor
	public function __construct() {

        parent::__construct();
        $this->load->model('users');

    }

	// load the register view
	public function index() {

		if ($this->users->is_logged_in() == true) {

			redirect(base_url() . "index.php/HomeController/");

		} else {

			$this->load->view('login_view');

		}

	}


	// login authetication the user
	 public function login() {

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->users->is_logged_in() == true) {

			redirect(base_url() . "index.php/HomeController/");

		} else {

			if ($this->users->authenticate($username,$password)) {
			
				$this->session->is_logged_in = true;
				$this->session->username = $username;
	
				redirect(base_url() . "index.php/HomeController/");
			}
	
			else {
				$this->session->login_error = True;
	
				$data['error'] = 'Login Failed! Please try again.';
				$this->load->view('login_view', $data);
			}

		}


	}

	public function logout(){
        $this->session->sess_destroy();

		$this->load->view('login_view');
	
    }
}
