<?php if (! defined('BASEPATH')) exit('No direct script access');

class Jemput extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('kota_model', 'kota');
		$this->load->model('jam_model', 'jam');
		$this->load->model('pesawat_model', 'pesawat');
		$this->load->model('invoicej_model', 'invoicej');
		$this->load->model('user_model', 'user');
	}

	function index() {
		if($this->session->userdata('login_type') == 'jemput') {
			$login = $this->session->userdata('login_type');
		} else {
			$login = $this->input->post('login_type');
		}
		$data['pesawat'] = $this->pesawat->all();
		$id_kota = $this->input->post('kota');
		$data['kota'] = $this->kota->get($id_kota);
		$data['id_kota'] = $id_kota;
		$data['user'] = $this->user->getuser($this->session->userdata('id_user'));
		$biaya = $this->kota->getbiaya($id_kota);
		$data['biaya'] = str_replace(',','.',number_format($biaya));
		$data['orang'] = $this->input->post('orang');
		$data['waktu'] = $this->input->post('waktu');
		$this->session->set_userdata('login_type', 'jemput');
		if($this->session->userdata('email')) {
			$sess = array(
				'id_kota' => $this->input->post('id_kota'),
				'id_jam' => $this->input->post('jam')
			);
			$this->session->set_userdata($sess);
			$this->load->view('jemput', $data);
		} else {
			$this->load->view('login', $data);
		}
	}
	function insert() {
		if($this->input->post('orang') == 1) {
			$this->invoicej->insert_jemput();
		} else {
			$this->invoicej->insertall_jemput();
		}
		$this->session->set_userdata('kota', $this->input->post('kota'));
		redirect('invoicej');
	}

}