<?php if (! defined('BASEPATH')) exit('No direct script access');

class Penumpang extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('penumpang_model', 'penumpang');
		$this->load->model('user_model', 'user');
	}

	function index($offset = '') {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_penumpang');
		$data['getpenumpang'] = $this->penumpang->getp($id);
		$data['user'] = $this->user->getuser($this->session->userdata('id_user'));
		
		/* pagination 
		$limit = 3;
		$total = $this->penumpang->count();
		$data['penumpang'] = $this->penumpang->page($limit, $offset);
		
		$config['base_url'] = base_url().'admin/penumpang/index/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/penumpang', $data);
		} else {
			$this->load->view('admin/penumpang', $data);
		}*/
		$data['penumpang'] = $this->penumpang->all();
		$this->load->view('admin/penumpang', $data);
	}
	
	/* proses CRUD */
	function insert() {
		$this->session->set_userdata('update','no');
		redirect('admin/penumpang#insert');
	}
	function insert_penumpang() {
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('biaya', 'Biaya', 'required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$data = array(
				'update' => 'no'
			);
			$this->session->set_userdata($data);
			$this->index();
		}	else {
			$this->penumpang->insert();
			redirect('admin/penumpang#insert');
		}
	}
	function update_penumpang() {
		$this->session->set_userdata('id_penumpang', $this->uri->segment(4));
		$this->session->set_userdata('update', 'yes');
		$id = $this->uri->segment(4);
		redirect('admin/penumpang#update');
	}
	function update_penumpang_y() {
		$id = $this->input->post('id_penumpang');
		$this->penumpang->update($id);
		redirect('admin/penumpang');
	}
	function delete_penumpang() {
		$id = $this->uri->segment(4);
		$this->penumpang->delete($id);
		redirect('admin/penumpang');
	}
	function force_penumpang() {
		$id = $this->uri->segment(4);
		$this->penumpang->force($id);
		redirect('admin/penumpang');
	}

}