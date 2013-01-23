<?php if (! defined('BASEPATH')) exit('No direct script access');

class Neraca extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('neraca_model', 'neraca');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_neraca');
		$data['getneraca'] = $this->neraca->getp($id);
		$data['user'] = $this->user->getmail($this->session->userdata('email'));
		
		/* pagination */
		$limit = 5;
		$total = $this->neraca->count();
		$data['neraca'] = $this->neraca->page($limit, $offset);
		$data['total'] = $total;
		
		$config['base_url'] = base_url().'admin/neraca/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/neraca', $data);
		} else {
			$this->load->view('admin/neraca', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/neraca#insert');
	}
	function insert_neraca() {
		$this->form_validation->set_rules('no', 'No neraca', 'required|xss_clean');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jam', 'Jam', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->neraca->insert();
			redirect('admin/neraca#insert');
		}
	}
	function update_neraca() {
		$this->session->set_userdata('id_neraca', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/neraca#update');
	}
	function update_neraca_y() {
		$id = $this->input->post('id_neraca');
		$this->neraca->update($id);
		redirect('admin/neraca');
	}
	function delete_neraca() {
		$id = $this->uri->segment(4);
		$this->neraca->delete($id);
		redirect('admin/neraca');
	}
	function force_neraca() {
		$id = $this->uri->segment(4);
		$this->neraca->force($id);
		redirect('admin/neraca');
	}

}