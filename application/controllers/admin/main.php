<?php if (! defined('BASEPATH')) exit('No direct script access');

class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
		$this->load->model('invoice_model', 'invoice');
		$this->load->model('invoicej_model', 'invoicej');
	}

	function index() {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/login');
		} else {
			$data['statusantar'] = $this->invoice->getstatus();
			$data['statusjemput'] = $this->invoicej->getstatus();
			$data['user'] = $this->user->getmail($this->session->userdata('email'));
			$this->load->view('admin/main', $data);
		}
	}
	function update1() {
		$id = $this->uri->segment(4);
		$this->invoice->update1($id);
		redirect('admin/main');
	}
	function update0() {
		$id = $this->uri->segment(4);
		$this->invoice->update0($id);
		redirect('admin/main');
	}
	function updatej1() {
		$id = $this->uri->segment(4);
		$this->invoicej->update1($id);
		redirect('admin/main');
	}
	function updatej0() {
		$id = $this->uri->segment(4);
		$this->invoicej->update0($id);
		redirect('admin/main');
	}
	
}