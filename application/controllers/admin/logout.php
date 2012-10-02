<?php if (! defined('BASEPATH')) exit('No direct script access');

class Logout extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data = array(
			'id_user' => '',
			'username' => ''
		);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		redirect('admin');
	}

}