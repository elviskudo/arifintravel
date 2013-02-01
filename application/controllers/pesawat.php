<?php if (! defined('BASEPATH')) exit('No direct script access');

class Pesawat extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('pesawat_model', 'pesawat');
		$this->load->model('kota_model', 'kota');
		$this->load->model('jam_model', 'jam');
	}

	function index() {
		//$data['pilih'] = $this->kota->get($this->input->post('kota'));
		//$data['terbang'] = $this->pesawat->all();
		//$data['pesawat'] = $this->pesawat->all();
		$data['jam'] = $this->jam->get2($this->input->post('kota'));
		$data['kota'] = $this->kota->get($this->input->post('kota'));
		$this->load->view('pesawat', $data);
	}

}