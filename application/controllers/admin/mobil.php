<?php if (! defined('BASEPATH')) exit('No direct script access');

class Mobil extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('mobil_model', 'mobil');
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
		$id = $this->session->userdata('id_mobil');
		$data['getmobil'] = $this->mobil->getp($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		
		/* pagination */
		$limit = 5;
		$total = $this->mobil->count();
		$data['mobil'] = $this->mobil->page($limit, $offset);
		$data['total'] = $total;
		$data['kasmasuk'] = $this->transaksi->kasmasuk();
		$data['kaskeluar'] = $this->transaksi->kaskeluar();
		$data['saldoawal'] = $this->cabang->saldoawal();
		$data['saldoakhir'] = $this->cabang->saldoakhir();
		
		$config['base_url'] = base_url().'admin/mobil/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/mobil', $data);
		} else {
			$this->load->view('admin/mobil', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/mobil#insert');
	}
	function insert_mobil() {
		$this->form_validation->set_rules('plat', 'Plat', 'required|xss_clean');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required|xss_clean');
		$this->form_validation->set_rules('warna', 'Warna', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->mobil->insert();
			redirect('admin/mobil#insert');
		}
	}
	function update_mobil() {
		$this->session->set_userdata('id_mobil', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/mobil#update');
	}
	function update_mobil_y() {
		$id = $this->input->post('id_mobil');
		$this->mobil->update($id);
		redirect('admin/mobil');
	}
	function delete_mobil() {
		$id = $this->uri->segment(4);
		$this->mobil->delete($id);
		redirect('admin/mobil');
	}
	function force_mobil() {
		$id = $this->uri->segment(4);
		$this->mobil->force($id);
		redirect('admin/mobil');
	}

}