<?php if (! defined('BASEPATH')) exit('No direct script access');

class Invoicej extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('invoicej_model', 'invoicej');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_invoicej');
		$data['getinvoicej'] = $this->invoicej->getp($id);
		$data['user'] = $this->user->getmail($this->session->userdata('email'));
		$data['getuser'] = $this->invoicej->getalluser();
		$data['kota'] = $this->kota->all();
		if($this->input->post('tanggal_sekian0'))
			$data['tanggal_sekian0'] = $this->input->post('tanggal_sekian0');
		if($this->input->post('tanggal_sekian1'))
			$data['tanggal_sekian1'] = $this->input->post('tanggal_sekian1');
		if($this->input->post('kota'))
			$data['kotayangdituju'] = $this->input->post('kota');
		if($data['getinvoicej']) {
			foreach($data['getinvoicej'] as $r)
				$no = $r->no;
			$data['penumpang'] = $this->invoicej->penumpang($no);
		}
		
		/* pagination */
		$limit = 5;
		$total = $this->invoicej->count();
		$data['invoicej'] = $this->invoicej->page($limit, $offset);
		
		$config['base_url'] = base_url().'admin/invoicej/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if($this->session->userdata('searchj') == 'yes') {
			$data['invoicej'] = $this->invoicej->searchq();
			$data['totalbiaya'] = $this->invoicej->totalq();
		}	else {
			$data['invoicej'] = $this->invoicej->page($limit, $offset);
			$data['totalbiaya'] = $this->invoicej->total();
		}
		$data['total'] = $total;
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/invoicej', $data);
		} else {
			$this->load->view('admin/invoicej', $data);
		}
	}
	function search() {
		$this->session->set_userdata('searchj', 'yes');
		$this->session->unset_userdata('update');
		$this->index();
	}
	function update_nama() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$nama = $this->input->post('nama');
		$this->invoicej->update_nama($id, $nama);
		echo $nama;
	}
	function update_alamat() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$alamat = $this->input->post('alamat');
		$this->invoicej->update_alamat($id, $alamat);
		echo $alamat;
	}
	function update_telpon() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$telpon = $this->input->post('telpon');
		$this->invoicej->update_telpon($id, $telpon);
		echo $telpon;
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	function printr() {
		if($this->session->userdata('no_invoicej'))
			$no = $this->session->userdata('no_invoicej');
		else
			$no = $this->uri->segment(4);
		$data['no'] = $no;
		$data['pesawat'] = $this->invoicej->pesawat($no, 'nama');
		$data['tanggal'] = $this->tanggalan($this->invoicej->pesawat($no, 'tanggal'));
		$data['waktu'] = $this->tanggalan($this->invoicej->pesawat($no, 'tanggal_jemput'));
		$data['jam'] = $this->invoicej->pesawat($no, 'jam');
		$data['kota'] = $this->invoicej->pesawat($no, 'kota');
		$email = $this->invoicej->getemail($no);
		foreach($email as $e)
			$email = $e->email;
		foreach($this->invoicej->getdetail($no) as $row) {
			$data['nama'] = $row->penumpang;
			$data['alamat'] = $row->alamat;
			$data['telpon'] = $row->telpon;
			$data['email'] = $row->email;
		}
		$data['invoicej'] = $this->invoicej->select($no);
		$data['penumpang'] = $this->invoicej->getpenumpang($no);
		$data['jasa'] = $this->invoicej->jasa($no);
		$data['biaya'] = 0;
		$this->load->view('include/invoicej', $data);
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/invoicej#insert');
	}
	function insert_invoicej() {
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
			$this->invoicej->insert();
			redirect('admin/invoicej#insert');
		}
	}
	function update_invoicej() {
		$this->session->set_userdata('id_invoicej', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/invoicej#update');
	}
	function update_invoicej_y() {
		$id = $this->input->post('id_invoicej');
		$this->invoicej->update($id);
		$this->session->unset_userdata('update');
		redirect('admin/invoicej');
	}
	function update1() {
		$id = $this->uri->segment(4);
		$this->invoicej->update1($id);
		redirect('admin/invoicej');
	}
	function update0() {
		$id = $this->uri->segment(4);
		$this->invoicej->update0($id);
		redirect('admin/invoicej');
	}
	function delete_invoicej() {
		$id = $this->uri->segment(4);
		$this->invoicej->delete($id);
		redirect('admin/invoicej');
	}
	function force_invoicej() {
		$id = $this->uri->segment(4);
		$this->invoicej->force($id);
		redirect('admin/invoicej');
	}

}