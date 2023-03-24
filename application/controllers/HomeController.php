<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	// load the constructor
	public function __construct() {
        parent::__construct();
		$this->load->model('users');
    }

	// load the register view
	public function index() {

		if ($this->users->is_logged_in() == true) {

			$this->load->view('home_view');

		} else {

			$this->load->view('login_view');

		}

	}
}
