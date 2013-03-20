<?php if (! defined('BASEPATH')) exit('No direct script access');

class Transaksi extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('transaksi_model', 'transaksi');
		$this->load->model('cabang_model', 'cabang');
		$this->load->model('admin_model', 'admin');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		// if(!$this->session->userdata('level')) {
		// 	$this->session->sess_destroy();
		// 	redirect('admin/main');
		// }
		// $this->session->set_userdata('search','');
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->session->userdata('id_transaksi');
		$data['gettransaksi'] = $this->transaksi->getp($id);
		$data['cabang'] = $this->cabang->getnama($this->session->userdata('id_cabang'));
		$data['cabangs'] = $this->cabang->all();
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		
		if($this->input->post('tanggal_sekian0'))
			$data['tanggal_sekian0'] = $this->input->post('tanggal_sekian0');
		if($this->input->post('tanggal_sekian1'))
			$data['tanggal_sekian1'] = $this->input->post('tanggal_sekian1');
		if($this->input->post('kota'))
			$data['kota'] = $this->input->post('kota');

		/* pagination */
		$limit = 5;
		if($this->session->userdata('search') == 'yes') {
			$data['transaksi'] = $this->transaksi->searchq();
			$total = $this->transaksi->countq();
			$data['kasmasuk'] = $this->transaksi->kasmasuk($this->input->post('kota'), $this->input->post('tanggal_sekian0'), $this->input->post('tanggal_sekian1'));
			$data['kaskeluar'] = $this->transaksi->kaskeluar($this->input->post('kota'), $this->input->post('tanggal_sekian0'), $this->input->post('tanggal_sekian1'));
		} else {
			$data['transaksi'] = $this->transaksi->page($limit, $offset);
			$total = $this->transaksi->count();
			$data['kasmasuk'] = $this->transaksi->kasmasuk();
			$data['kaskeluar'] = $this->transaksi->kaskeluar();
		}
		$data['saldoawal'] = $this->cabang->saldoawal();
		$data['saldoakhir'] = $this->cabang->saldoakhir();
		$data['total'] = $total;

		$config['base_url'] = base_url().'admin/transaksi/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		if($this->session->userdata('search') != 'yes')
			$this->pagination->initialize($config);

		if(IS_AJAX) {
			$this->load->view('admin/ajax/transaksi', $data);
		} else {
			$this->load->view('admin/transaksi', $data);
		}
	}
	function search() {
		$this->session->set_userdata('search', 'yes');
		$this->session->unset_userdata('update');
		$this->index();
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/transaksi#insert');
	}
	function insert_transaksi() {
		$this->form_validation->set_rules('id_cabang', 'Kantor Cabang', 'required|xss_clean');
		$this->form_validation->set_rules('judul', 'Judul', 'required|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|xss_clean');
		$this->form_validation->set_rules('nilai', 'Nilai', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->transaksi->insert();
			redirect('admin/transaksi#insert');
		}
	}
	function update_transaksi() {
		$this->session->set_userdata('id_transaksi', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/transaksi#update');
	}
	function update_transaksi_y() {
		$id = $this->input->post('id_transaksi');
		$this->transaksi->update($id);
		redirect('admin/transaksi');
	}
	function delete_transaksi() {
		$id = $this->uri->segment(4);
		$this->transaksi->delete($id);
		redirect('admin/transaksi');
	}
	function force_transaksi() {
		$id = $this->uri->segment(4);
		$this->transaksi->force($id);
		redirect('admin/transaksi');
	}

}