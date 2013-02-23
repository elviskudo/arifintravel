<?php if (! defined('BASEPATH')) exit('No direct script access');

class Pegawai extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('admin_model', 'admin');
		$this->load->model('user_model', 'user');
		$this->load->model('cabang_model', 'cabang');
		$this->load->model('transaksi_model', 'transaksi');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_admin');
		if($id != '')
			$data['getpegawai'] = $this->admin->getp($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		
		/* pagination */
		$limit = 5;
		$total = $this->admin->count();
		$data['pegawai'] = $this->admin->page($limit, $offset);
		$data['cabang'] = $this->cabang->all();
		$data['total'] = $total;
		$data['kasmasuk'] = $this->transaksi->kasmasuk();
		$data['kaskeluar'] = $this->transaksi->kaskeluar();
		$data['saldoawal'] = $this->cabang->saldoawal();
		$data['saldoakhir'] = $this->cabang->saldoakhir();
		
		$config['base_url'] = base_url().'admin/pegawai/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/pegawai', $data);
		} else {
			$this->load->view('admin/pegawai', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/pegawai#insert');
	}
	function insert_pegawai() {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('kota', 'Kota', 'required|xss_clean');
		$this->form_validation->set_rules('telpon', 'Telpon', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('hp', 'HP', 'required|numeric|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->admin->insert();
			redirect('admin/pegawai#insert');
		}
	}
	function update_pegawai() {
		$this->session->set_userdata('id_admin', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/pegawai#update');
	}
	function update_pegawai_y() {
		$id = $this->input->post('id_admin');
		$this->admin->update($id);
		redirect('admin/pegawai');
	}
	function delete_pegawai() {
		$id = $this->uri->segment(4);
		$this->admin->delete($id);
		redirect('admin/pegawai');
	}
	function force_pegawai() {
		$id = $this->uri->segment(4);
		$this->admin->force($id);
		redirect('admin/pegawai');
	}

}