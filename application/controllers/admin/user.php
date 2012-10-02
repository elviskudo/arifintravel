<?php if (! defined('BASEPATH')) exit('No direct script access');

class User extends CI_Controller {

	var $path;
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('user_model', 'user');
		$this->path = realpath(APPPATH.'../user');
	}

	function index($offset='') {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$data['user'] = $this->user->getmail($this->session->userdata('email'));
		//$data['alluser'] = $this->user->all();
		$id = $this->session->userdata('id_user');
		$data['getuser'] = $this->user->getuser($id);
		
		/* pagination */
		$limit = 5;
		$total = $this->user->count();
		$data['alluser'] = $this->user->page($limit, $offset);
		
		$config['base_url'] = base_url().'admin/user/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['total'] = $total;
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/user', $data);
		} else {
			$this->load->view('admin/user', $data);
		}
	}
	function change_admin() {
		$id = $this->uri->segment(4);
		$this->user->set_admin($id);
		redirect('admin/user');
	}
	function set_user() {
		$id = $this->uri->segment(4);
		$user = $this->user->getuser($id);
		foreach($user as $row) {
			$data = array(
				'update' => 'yes'
			);
			$this->session->set_userdata($data);
			$this->session->unset_userdata('error');
		}
	}
	function unset_user() {
		$data = array(
			'update' => '',
			'error' => ''
		);
		$this->session->unset_userdata($data);
	}
	function insert() {
		$this->unset_user();
		$this->session->set_userdata('update','no');
		redirect('admin/user#insert');
	}
	function insert_user() {
		$this->form_validation->set_rules('emailn', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm]');
		$this->form_validation->set_rules('confirm', 'Konfirmasi Password', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('kota', 'Kota', 'required');
		$this->form_validation->set_rules('telpon', 'Telpon', 'required|numeric');
		$this->form_validation->set_rules('hp', 'HP', 'required|numeric');
		if($this->form_validation->run() == FALSE)	{
			$this->index();
		}	else {
			$this->user->insert();
			$this->session->unset_userdata('error');
			redirect('admin/user');
		}
	}
	function update_user() {
		$this->set_user();
		$id = $this->uri->segment(4);
		$this->session->set_userdata('id_user', $id);
		redirect('admin/user#update');
	}
	function update_user_y() {
		$id = $this->input->post('id_user');
		$this->user->update($id);
		$this->unset_user();
		redirect('admin/user');
	}
	function delete_user() {
		$id = $this->uri->segment(4);
		$this->user->delete($id);
		redirect('admin/user');
	}
	function force_user() {
		$id = $this->uri->segment(4);
		$this->user->force($id);
		redirect('admin/user');
	}

}