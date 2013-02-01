<?php if (! defined('BASEPATH')) exit('No direct script access');

class Jam extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('jam_model', 'jam');
		$this->load->model('admin_model', 'admin');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') == 0) {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_jam');
		$data['getjam'] = $this->jam->getp($id);
		$data['user'] = $this->admin->getmail($this->session->userdata('email'));
		$data['pesawat'] = $this->jam->pesawat();
		$data['kota'] = $this->jam->kota();
		
		/* pagination */
		$limit = 5;
		$total = $this->jam->count();
		$data['total'] = $total;
		
		$config['base_url'] = base_url().'admin/jam/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['page_link'] = $this->pagination->create_links();
		
		if($this->session->userdata('search') == 'yes') {
			$data['jam'] = $this->jam->search();
		}	else {
			$data['jam'] = $this->jam->page($limit, $offset);
		}
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/jam', $data);
		} else {
			$this->load->view('admin/jam', $data);
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
		redirect('admin/jam#insert');
	}
	function insert_jam() {
		$this->form_validation->set_rules('jam', 'Jam', 'required|xss_clean');
		$this->form_validation->set_rules('kota', 'Kota', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->jam->insert();
			redirect('admin/jam#insert');
		}
	}
	function update_jam() {
		$this->session->set_userdata('id_jam', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/jam#update');
	}
	function update_jam_y() {
		$id = $this->input->post('id_jam');
		$this->jam->update($id);
		redirect('admin/jam');
	}
	function delete_jam() {
		$id = $this->uri->segment(4);
		$this->jam->delete($id);
		redirect('admin/jam');
	}
	function force_jam() {
		$id = $this->uri->segment(4);
		$this->jam->force($id);
		redirect('admin/jam');
	}

}