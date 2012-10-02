<?php if (! defined('BASEPATH')) exit('No direct script access');

class Pesawat extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('pesawat_model', 'pesawat');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_pesawat');
		$data['getpesawat'] = $this->pesawat->getp($id);
		$data['user'] = $this->user->getmail($this->session->userdata('email'));
		
		/* pagination */
		$limit = 5;
		$total = $this->pesawat->count();
		$data['pesawat'] = $this->pesawat->page($limit, $offset);
		$data['total'] = $total;
		
		$config['base_url'] = base_url().'admin/pesawat/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/pesawat', $data);
		} else {
			$this->load->view('admin/pesawat', $data);
		}
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/pesawat#insert');
	}
	function insert_pesawat() {
		$this->form_validation->set_rules('no', 'No Pesawat', 'required|xss_clean');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jam', 'Jam', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->pesawat->insert();
			redirect('admin/pesawat#insert');
		}
	}
	function update_pesawat() {
		$this->session->set_userdata('id_pesawat', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/pesawat#update');
	}
	function update_pesawat_y() {
		$id = $this->input->post('id_pesawat');
		$this->pesawat->update($id);
		redirect('admin/pesawat');
	}
	function delete_pesawat() {
		$id = $this->uri->segment(4);
		$this->pesawat->delete($id);
		redirect('admin/pesawat');
	}
	function force_pesawat() {
		$id = $this->uri->segment(4);
		$this->pesawat->force($id);
		redirect('admin/pesawat');
	}

}