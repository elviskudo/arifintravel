<?php if (! defined('BASEPATH')) exit('No direct script access');

class Antar extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('kota_model', 'kota');
		$this->load->model('jam_model', 'jam');
		$this->load->model('pesawat_model', 'pesawat');
		$this->load->model('invoice_model', 'invoice');
		$this->load->model('user_model', 'user');
	}

	function index() {
		$pesawat = $this->pesawat->all();
		//$data['id_pesawat'] = 
		$id_kota = $this->input->post('id_kota');
		$data['kota'] = $this->kota->get($id_kota);
		$data['id_kota'] = $id_kota;
		$data['user'] = $this->user->getuser($this->session->userdata('id_user'));
		$biaya = $this->kota->getbiaya($id_kota);
		$data['biaya'] = str_replace(',','.',number_format($biaya));
		if(!$this->session->userdata('id_jam'))
			$id_jam = $this->input->post('jam');
		else
			$id_jam = $this->session->userdata('id_jam');
		$data['jam'] = $this->jam->getjam($id_jam);
		$data['orang'] = $this->input->post('orang');
		$data['waktu'] = $this->input->post('waktu');
		$sess = array(
			'id_kota' => $this->input->post('id_kota'),
			'id_jam' => $this->input->post('jam')
		);
		$this->session->set_userdata($sess);
		$this->load->view('antar', $data);
	}
	function insert() {
		if($this->input->post('orang') == 1) {
			$this->invoice->insert();
		} else {
			$this->invoice->insertall();
		}
		$this->session->set_userdata('kota', $this->input->post('kota'));
		redirect('invoice');
	}

}