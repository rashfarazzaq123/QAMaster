<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	// load the constructor
	public function __construct() {

        parent::__construct();
        $this->load->model('users');

    }

	// load the register view
	public function index() {

		$this->load->view('register_view');

	}

	// register the user
	public function register() {

		$name = $this->input->post('name');

		$email = $this->input->post('email');

		$username = $this->input->post('username');

		$password = $this->input->post('password');
		
		if (!$this->users->registerUser($name, $email, $username, $password)) {

			$data['error'] = 'Register Failed! Please try again.';
            $this->load->view('register_view', $data);

		}
		else {

			$this->load->view('login_view');

		}

	}

}
