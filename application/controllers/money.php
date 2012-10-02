<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Money extends CI_Controller {

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
		$this->load->model('kurs_model', 'kurs');
		$this->load->model('kota_model', 'kota');
		//$this->load->model('jam_model', 'jam');
	}
	public function index()	{
		//$data['kota'] = $this->kota->all();
		$data['jual'] = $this->kurs->all();
		$this->load->view('money',$data);
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	
	public function penukaran() {
		if($this->session->userdata('email')) {
		$data['kota'] = $this->kota->all();
			$data['pemesan'] = $this->input->post('pemesan');
			$data['alamat'] = $this->input->post('alamat');
			$data['telp'] = $this->input->post('telp');
			$data['jml'] = $this->input->post('jml');
			$data['jenis'] = $this->input->post('jenis');
			$data['jual'] = $this->kurs->all();
			//echo $data['matauang'];
			
			
			$this->load->view('penukaran', $data);
			
		} else {
			$data['jam'] = "";
			$data['pesawat'] = "";
			$this->session->set_userdata('error_login', 'Maaf anda belum login!');
			$this->load->view('login', $data);
		}
	}
	
	public function insert() {
		if($this->input->post('jml') == 1) {
			$this->kurs->insert();
		} else {
			$this->kurs->insert_all();
		}
		redirect('money/penukaran2');
	}
	
	public function penukaran2() {
		if(!$this->session->userdata('email')) {
			redirect('main');
		}
		$no = $this->session->userdata('id_penukaran');
		$data['no'] = $no;
		foreach($this->kurs->getPenukaran($no) as $row) {
			$data['tanggal'] = $this->tanggalan($row->tanggal_penukaran);
			$data['jml'] = $row->jumlah_penukaran;
			$data['jenis'] = $row->jenis;
			$data['total'] = $row->total;
			$data['pemesan'] = $row->pemesan;
			$data['alamat'] = $row->alamat;
			$data['telp'] = $row->telp;
		}
		$data['penukaran2'] = $this->kurs->getPenukaran2($no);
		$this->load->view('penukaran2', $data);
	}
	
	public function printr() {
		if($this->session->userdata('id_penukaran'))
			$no = $this->session->userdata('id_penukaran');
		else
			$no = $this->uri->segment(3);
		
		//$no = $this->session->userdata('id_penukaran');
		$data['no'] = $no;
		foreach($this->kurs->getPenukaran($no) as $row) {
			$data['tanggal'] = $this->tanggalan($row->tanggal_penukaran);
			$data['jml'] = $row->jumlah_penukaran;
                        $data['jenis'] = $row->jenis;
			$data['total'] = $row->total;
			$data['pemesan'] = $row->pemesan;
			$data['alamat'] = $row->alamat;
			$data['telp'] = $row->telp;
		}
		$data['penukaran2'] = $this->kurs->getPenukaran2($no);
		$this->load->view('include/penukaran', $data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */