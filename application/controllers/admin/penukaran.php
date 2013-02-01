<?php if (! defined('BASEPATH')) exit('No direct script access');

class Penukaran extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('kurs_model', 'kurs');
		$this->load->model('admin_model', 'admin');
		$this->load->model('user_model', 'user');
		$this->load->model('kota_model', 'kota');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_penukaran');
		$data['getpenukaran'] = $this->kurs->getpenukaran($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		//$data['pesawat'] = $this->invoice->getpesawat();
		//$data['getuser'] = $this->invoice->getalluser();
		$data['kurs'] = $this->kurs->all();
		
		if($this->input->post('tanggal_sekian0'))
			$data['tanggal_sekian0'] = $this->input->post('tanggal_sekian0');
		if($this->input->post('tanggal_sekian1'))
			$data['tanggal_sekian1'] = $this->input->post('tanggal_sekian1');
		if($this->input->post('jenis'))
			$data['jenis'] = $this->input->post('jenis');
		if($this->input->post('mata_uang'))
			$data['mata_uang'] = $this->input->post('mata_uang');
		//if($this->input->post('pesawat'))
		//	$data['manafist'] = $this->invoice->manafist($this->input->post('pesawat'));
		//if($data['getinvoice']) {
		//	foreach($data['getinvoice'] as $r)
		//		$no = $r->no;
		//	$data['penumpang'] = $this->invoice->penumpang($no);
		//}
		
		/* pagination */
		$limit = 5;
		$total = $this->kurs->countp();
		
		$config['base_url'] = base_url().'admin/penukaran/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if($this->session->userdata('search') == 'yes') {
			$data['penukaran'] = $this->kurs->searchq();
			$data['totalbiaya'] = $this->kurs->totalq();
		}	else {
			$data['penukaran'] = $this->kurs->pagep($limit, $offset);
			$data['totalbiaya'] = $this->kurs->total();
		}
		$data['kota'] = $this->kota->all();
		$data['total'] = $total;
		$data['page_link'] = $this->pagination->create_links();
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/penukaran', $data);
		} else {
			$this->load->view('admin/penukaran', $data);
		}
	}
	function search() {
		$this->session->set_userdata('search', 'yes');
		$this->session->unset_userdata('update');
		$this->index();
	}
	function update_nama() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$nama = $this->input->post('nama');
		$this->invoice->update_nama($id, $nama);
		echo $nama;
	}
	function update_alamat() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$alamat = $this->input->post('alamat');
		$this->invoice->update_alamat($id, $alamat);
		echo $alamat;
	}
	function update_telpon() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$telpon = $this->input->post('telpon');
		$this->invoice->update_telpon($id, $telpon);
		echo $telpon;
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	public function printr() {
		if($this->session->userdata('id_penukaran'))
			$no = $this->session->userdata('id_penukaran');
		else
			$no = $this->uri->segment(4);
		
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
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/invoice#insert');
	}
	function insert_invoice() {
		$this->form_validation->set_rules('kota', 'Kota Tujuan', 'required|xss_clean');
		$this->form_validation->set_rules('tanggal_antar', 'Tanggal Pengantaran', 'required|xss_clean');
		$this->form_validation->set_rules('jam', 'Jam Pengantaran', 'required|xss_clean');
		$this->form_validation->set_rules('biaya', 'Biaya', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->invoice->insert();
			redirect('admin/invoice#insert');
		}
	}
	function update_penukaran() {
		$this->session->set_userdata('id_penukaran', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/penukaran#update');
	}
	function update_invoice_y() {
		$id = $this->input->post('id_invoice');
		$this->invoice->update($id);
		$this->session->unset_userdata('update');
		redirect('admin/invoice');
	}
	function update1() {
		$id = $this->uri->segment(4);
		$this->invoice->update1($id);
		redirect('admin/invoice');
	}
	function update0() {
		$id = $this->uri->segment(4);
		$this->invoice->update0($id);
		redirect('admin/invoice');
	}
	function delete_penukaran() {
		$id = $this->uri->segment(4);
		$this->kurs->deletep($id);
		redirect('admin/penukaran');
	}
	function force_invoice() {
		$id = $this->uri->segment(4);
		$this->invoice->force($id);
		redirect('admin/invoice');
	}

}