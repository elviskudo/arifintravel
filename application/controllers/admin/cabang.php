<?php if (! defined('BASEPATH')) exit('No direct script access');

class Cabang extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('cabang_model', 'cabang');
		$this->load->model('admin_model', 'admin');
		$this->load->model('user_model', 'user');
		$this->load->model('transaksi_model', 'transaksi');
		$this->load->model('cabang_model', 'cabang');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_cabang');
		$data['getcabang'] = $this->cabang->getp($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		$data['kasmasuk'] = $this->transaksi->kasmasuk();
		$data['kaskeluar'] = $this->transaksi->kaskeluar();
		$data['saldoawal'] = $this->cabang->saldoawal();
		$data['saldoakhir'] = $this->cabang->saldoakhir();
		
		/* pagination */
		$limit = 5;
		$total = $this->cabang->count();
		$data['cabang'] = $this->cabang->page($limit, $offset);
		$data['total'] = $total;
		
		$config['base_url'] = base_url().'admin/cabang/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/cabang', $data);
		} else {
			$this->load->view('admin/cabang', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/cabang#insert');
	}
	function insert_cabang() {
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('kota', 'Kota', 'required|xss_clean');
		$this->form_validation->set_rules('kontak', 'kontak', 'required|xss_clean');
		$this->form_validation->set_rules('saldo', 'saldo', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->cabang->insert();
			redirect('admin/cabang#insert');
		}
	}
	function update_cabang() {
		$this->session->set_userdata('id_cabang', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/cabang#update');
	}
	function update_cabang_y() {
		$id = $this->input->post('id_cabang');
		$this->cabang->update($id);
		redirect('admin/cabang');
	}
	function delete_cabang() {
		$id = $this->uri->segment(4);
		$this->cabang->delete($id);
		redirect('admin/cabang');
	}
	function force_cabang() {
		$id = $this->uri->segment(4);
		$this->cabang->force($id);
		redirect('admin/cabang');
	}

}