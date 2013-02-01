<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiket extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('tiket_model', 'tiket');
		$this->load->model('kota_model', 'kota');
		//$this->load->model('jam_model', 'jam');
	}
	public function index()	{
		//$data['kota'] = $this->kota->all();
		//$data['jual'] = $this->kurs->all();
		$this->load->view('tiket');
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	public function pemesanan() {
		if($this->session->userdata('email')) {
			$data['kota'] = $this->kota->all();
			$data['dari'] = $this->input->post('dari');
			//echo $data['matauang'];
			//$data['mata_uang'] = $this->kurs->getmatauang($this->input->post('matauang'));
			$data['tujuan'] = $this->input->post('tujuan');
			$data['tgl_berangkat'] = $this->input->post('tgl_berangkat');
			$data['orang'] = $this->input->post('orang');
			$data['maskapai'] = $this->input->post('maskapai');
			$data['jam'] = $this->input->post('jam');
			
			$this->load->view('pemesanan', $data);
			
		} else {
			$data['jam'] = "";
			$data['pesawat'] = "";
			$this->session->set_userdata('error_login', 'Maaf anda belum login!');
			$this->load->view('login', $data);
		}
	}
	
	public function insert() {
		$this->tiket->insert();
		redirect('tiket/pemesanan2');
	}
	
	public function pemesanan2() {
		if(!$this->session->userdata('email')) {
			redirect('main');
		}
		$no = $this->session->userdata('id_tiket');
		$data['no'] = $no;
		$data['tanggal'] = date('d-m-Y');;
		foreach($this->tiket->getTiket($no) as $row) {
			$data['dari'] = $row->dari;
			$data['tujuan'] = $row->tujuan;
			$data['tgl_berangkat'] = $this->tanggalan($row->tgl_berangkat);
			$data['orang'] = $row->orang;
			$data['maskapai'] = $row->maskapai;
			$data['jam'] = $row->jam;
			$data['kodeb'] = $row->kode_booking;
			$data['biaya'] = $row->biaya;
		}
		foreach($this->tiket->getTiketPenumpang($no) as $row) {
			$data['nama'] = $row->nama;
			$data['pengenal'] = $row->pengenal;
			$data['alamat'] = $row->alamat;
			$data['telp'] = $row->telp;
			$data['catatan'] = $row->catatan;
		}
		$this->load->view('pemesanan2', $data);
	}
	
	public function printr() {
		if($this->session->userdata('id_tiket'))
			$no = $this->session->userdata('id_tiket');
		else
			$no = $this->uri->segment(3);
		
		$data['no'] = $no;
		$data['tanggal'] = date('d-m-Y');;
		foreach($this->tiket->getTiket($no) as $row) {
			$data['dari'] = $row->dari;
			$data['tujuan'] = $row->tujuan;
			$data['tgl_berangkat'] = $this->tanggalan($row->tgl_berangkat);
			$data['orang'] = $row->orang;
			$data['maskapai'] = $row->maskapai;
			$data['jam'] = $row->jam;
			$data['kodeb'] = $row->kode_booking;
			$data['biaya'] = $row->biaya;
		}
		foreach($this->tiket->getTiketPenumpang($no) as $row) {
			$data['nama'] = $row->nama;
			$data['pengenal'] = $row->pengenal;
			$data['alamat'] = $row->alamat;
			$data['telp'] = $row->telp;
			$data['catatan'] = $row->catatan;
		}
		//$this->load->view('pemesanan2', $data);
		$this->load->view('include/pemesanan', $data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */