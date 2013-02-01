<?php if (! defined('BASEPATH')) exit('No direct script access');

class Kurs extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('kurs_model', 'kurs');
		$this->load->model('admin_model', 'admin');
		$this->load->model('kota_model', 'kota');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_kurs');
		$data['getkurs'] = $this->kurs->getp($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		
		/* pagination */
		$limit = 5;
		$total = $this->kurs->count();
		$data['kurs'] = $this->kurs->page($limit, $offset);
		$data['total'] = $total;
		
		$config['base_url'] = base_url().'admin/kurs/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/kurs', $data);
		} else {
			$this->load->view('admin/kurs', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/kurs#insert');
	}
	function insert_kurs() {
		$this->form_validation->set_rules('mata_uang', 'MataUang', 'required|xss_clean');
		$this->form_validation->set_rules('jual', 'Jual', 'required|xss_clean');
		$this->form_validation->set_rules('beli', 'Beli', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->kurs->insert_kurs();
			redirect('admin/kurs#insert');
		}
	}
	function update_kurs() {
		$this->session->set_userdata('id_kurs', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/kurs#update');
	}
	function update_kurs_y() {
		$id = $this->input->post('id_kurs');
		$this->kurs->update_kurs($id);
		redirect('admin/kurs');
	}
	function delete_kurs() {
		$id = $this->uri->segment(4);
		$this->kurs->delete($id);
		redirect('admin/kurs');
	}
	function force_kota() {
		$id = $this->uri->segment(4);
		$this->kota->force($id);
		redirect('admin/kota');
	}

}