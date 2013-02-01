<?php if (! defined('BASEPATH')) exit('No direct script access');

class Tiket extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('tiket_model', 'tiket');
		//$this->load->model('kota_model', 'kota');
		$this->load->model('admin_model', 'admin');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_tiket');
		$data['gettiket'] = $this->tiket->getTiket($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		//$data['pesawat'] = $this->invoice->getpesawat();
		//$data['getuser'] = $this->invoice->getalluser();
		//$data['tiket'] = $this->tiket->all();
		
		if($this->input->post('tanggal_sekian0'))
			$data['tanggal_sekian0'] = $this->input->post('tanggal_sekian0');
		if($this->input->post('tanggal_sekian1'))
			$data['tanggal_sekian1'] = $this->input->post('tanggal_sekian1');
		
			//echo  $data['dari'];
		//if($this->input->post('pesawat'))
		//	$data['manafist'] = $this->invoice->manafist($this->input->post('pesawat'));
		//if($data['getinvoice']) {
		//	foreach($data['getinvoice'] as $r)
		//		$no = $r->no;
		//	$data['penumpang'] = $this->invoice->penumpang($no);
		//}
		
		/* pagination */
		$limit = 5;
		$total = $this->tiket->countp();
		
		$config['base_url'] = base_url().'admin/tiket/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if($this->session->userdata('search') == 'yes') {
			$data['tiket'] = $this->tiket->searchq();
			$data['totalbiaya'] = $this->tiket->totalq();
		}	else {
			$data['tiket'] = $this->tiket->page($limit, $offset);
			$data['totalbiaya'] = $this->tiket->total();
		}
		$data['kota'] = $this->kota->all();
		$data['total'] = $total;
		$data['page_link'] = $this->pagination->create_links();
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/tiket', $data);
		} else {
			$this->load->view('admin/tiket', $data);
		}
	}
	function search() {
		$this->session->set_userdata('search', 'yes');
		$this->session->unset_userdata('update');
		$this->index();
	}

	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	public function printr() {
		if($this->session->userdata('id_tiket'))
			$no = $this->session->userdata('id_tiket');
		else
			$no = $this->uri->segment(4);
		//echo $no;
		$data['no'] = $no;
		foreach($this->tiket->getTiket($no) as $row) {
			$data['dari'] = $row->dari;
			$data['tujuan'] = $row->tujuan;
			$data['tanggal'] = $this->tanggalan($row->tgl_pemesanan);
			$data['tgl_berangkat'] = $this->tanggalan($row->tgl_berangkat);
			$data['jam'] = $row->jam;
			$data['orang'] = $row->orang;
			$data['maskapai'] = $row->maskapai;
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
		$this->load->view('include/pemesanan', $data);
	}
	function delete_tiket() {
		$id = $this->uri->segment(4);
		$this->tiket->deletep($id);
		redirect('admin/tiket');
	}
}