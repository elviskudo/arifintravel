<?php if (! defined('BASEPATH')) exit('No direct script access');

class Daftar extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model', 'user');
		$this->load->model('invoice_model', 'invoice');
		$this->load->model('invoicej_model', 'invoicej');
	}

	function _session() {
		if($this->session->userdata('email')) {
			redirect('main');
		} else {
			$this->load->view('daftar');
		}
	}
	function index() {
		$this->_session();
	}
	function profil() {
		if($this->session->userdata('email')) {
			$data['bio'] = $this->user->getuser($this->session->userdata('id_user'));
			$this->load->view('profil', $data);
		} else {
			redirect('main');
		}
	}
	function histori() {
		if($this->session->userdata('email')) {
			$data['histori'] = $this->invoice->histori($this->session->userdata('email'));
			$data['historij'] = $this->invoicej->histori($this->session->userdata('email'));
			$this->load->view('include/histori', $data);
		} else {
			redirect('main');
		}
	}
	function delete() {
		$no = $this->uri->segment(3);
		$this->invoice->force($no);
		redirect('daftar/histori');
	}
	function deletej() {
		$no = $this->uri->segment(3);
		$this->invoicej->force($no);
		redirect('daftar/histori');
	}
	function insert() {
		$this->form_validation->set_rules('emailn','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required|matches[confirm]');
		$this->form_validation->set_rules('confirm','Konfirmasi','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('ktp','No. Paspor/KTP','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('kota','Kota','required');
		$this->form_validation->set_rules('propinsi','Propinsi','required');
		$this->form_validation->set_rules('kode_area','Kode Area','required|numeric');
		$this->form_validation->set_rules('telpon','Telpon','required');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->user->insert();
			redirect('main');
		}
	}
	function update() {
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('ktp','No. Paspor/KTP','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('kota','Kota','required');
		$this->form_validation->set_rules('propinsi','Propinsi','required');
		$this->form_validation->set_rules('kode_area','Kode Area','required|numeric');
		$this->form_validation->set_rules('telpon','Telpon','required');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->user->update($this->input->post('id_user'));
			redirect('daftar/profil');
		}
	}

}