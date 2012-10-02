<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rental extends CI_Controller {

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
		$this->load->model('kota_model', 'kota');
		$this->load->model('rental_model', 'rental');
		//$this->load->model('jam_model', 'jam');
	}
	public function index()	{
		//$data['kota'] = $this->kota->all();
		$this->load->view('rental');
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	public function persewaan() {
		if($this->session->userdata('email')) {
		    $data['kota'] = $this->kota->all();
			$data['id_member'] = $this->input->post('id_member');
			$data['nama'] = $this->input->post('nama');
			$data['alamat'] = $this->input->post('alamat');
			$data['no_id'] = $this->input->post('no_id');
			$data['telp'] = $this->input->post('telp');
			$data['tujuan'] = $this->input->post('tujuan');
			//echo $data['matauang'];
			$this->load->view('persewaan', $data);
			
		} else {
			$data['jam'] = "";
			$data['pesawat'] = "";
			$this->session->set_userdata('error_login', 'Maaf anda belum login!');
			$this->load->view('login', $data);
		}
	}
	
	public function insert() {
		//if($this->input->post('jml') == 1) {
			$this->rental->insert();
		//} else {
		//	$this->kurs->insert_all();
		//}
		redirect('rental/persewaan2');
	}
	
	public function persewaan2() {
		if(!$this->session->userdata('email')) {
			redirect('main');
		}
		$no = $this->session->userdata('id_persewaan');
		$data['no'] = $no;
		foreach($this->rental->getPersewaan($no) as $row) {
			$data['tujuan'] = $row->tujuan;
			$data['tgl_mulai'] = $this->tanggalan($row->tgl_mulai);
			$data['tgl_akhir'] = $this->tanggalan($row->tgl_akhir);
			$data['kota'] = $row->cabang_pemesan;
			$data['id_member'] = $row->id_member;
			foreach($this->rental->getMember($row->id_member) as $row2) {
				$data['nama'] = $row2->nama;
				$data['alamat'] = $row2->alamat;
				$data['no_id'] = $row2->no_identitas;
				$data['telp'] = $row2->telp;
			}
			foreach($this->rental->getMobil($row->id_mobil) as $row3) {
				$data['jenis'] = $row3->jenis;
				$data['plat'] = $row3->plat;
				$data['warna'] = $row3->warna;
			}
			$data['tarif'] = $row->tarif;
			$data['jaminan'] = $row->jaminan;
			$data['catatan'] = $row->catatan;
			
		}
		//$data['penukaran2'] = $this->kurs->getPenukaran2($no);
		$this->load->view('persewaan2', $data);
	}
	
	public function printr() {
		if($this->session->userdata('id_persewaan'))
			$no = $this->session->userdata('id_persewaan');
		else
			$no = $this->uri->segment(4);
		$data['no'] = $no;
		foreach($this->rental->getPersewaan($no) as $row) {
			$data['tujuan'] = $row->tujuan;
			$data['tgl_mulai'] = $this->tanggalan($row->tgl_mulai);
			$data['tgl_akhir'] = $this->tanggalan($row->tgl_akhir);
			$data['kota'] = $row->cabang_pemesan;
			$data['id_member'] = $row->id_member;
			foreach($this->rental->getMember($row->id_member) as $row2) {
				$data['nama'] = $row2->nama;
				$data['alamat'] = $row2->alamat;
				$data['no_id'] = $row2->no_identitas;
				$data['telp'] = $row2->telp;
			}
			foreach($this->rental->getMobil($row->id_mobil) as $row3) {
				$data['jenis'] = $row3->jenis;
				$data['plat'] = $row3->plat;
				$data['warna'] = $row3->warna;
			}
			$data['tarif'] = $row->tarif;
			$data['jaminan'] = $row->jaminan;
			$data['catatan'] = $row->catatan;
			
		}
		//$data['penukaran2'] = $this->kurs->getPenukaran2($no);
		$this->load->view('include/persewaan', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */