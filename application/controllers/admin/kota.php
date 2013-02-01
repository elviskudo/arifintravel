<?php if (! defined('BASEPATH')) exit('No direct script access');

class Kota extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('admin_model', 'admin');
		$this->load->model('kota_model', 'kota');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_kota');
		$data['getkota'] = $this->kota->getp($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		
		/* pagination */
		$limit = 5;
		$total = $this->kota->count();
		$data['kota'] = $this->kota->page($limit, $offset);
		$data['total'] = $total;
		
		$config['base_url'] = base_url().'admin/kota/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/kota', $data);
		} else {
			$this->load->view('admin/kota', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/kota#insert');
	}
	function insert_kota() {
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('biaya', 'Biaya', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->kota->insert();
			redirect('admin/kota#insert');
		}
	}
	function update_kota() {
		$this->session->set_userdata('id_kota', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/kota#update');
	}
	function update_kota_y() {
		$id = $this->input->post('id_kota');
		$this->kota->update($id);
		redirect('admin/kota');
	}
	function delete_kota() {
		$id = $this->uri->segment(4);
		$this->kota->delete($id);
		redirect('admin/kota');
	}
	function force_kota() {
		$id = $this->uri->segment(4);
		$this->kota->force($id);
		redirect('admin/kota');
	}

}