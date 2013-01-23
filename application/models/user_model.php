<?php if (! defined('BASEPATH')) exit('No direct script access');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', 1);
		$query = $this->db->get('user');
		return $query->result();
	}
	function getmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		return $query->result();
	}
	function validate_email($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		return true;
	}
	function get($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('user');
		return $query->row();
	}
	function getuser($id) {
		$this->db->where('id_user', $id);
		$query = $this->db->get('user');
		return $query->result();
	}
	function set_admin($id) {
		$this->log('admin: '.$id, 'change');
		$data = array('level'=>0);
		$this->db->update('user', $data);
		$data = array('level'=>1);
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
	}
	function page($limit, $offset) {
		$this->db->order_by('nama');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('user');
		return $query->result();
	}
	function count() {
		$this->db->order_by('nama');
		$query = $this->db->get('user');
		return $query->num_rows();
	}
	function log($isi, $event) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => $event.' '.$isi.' user',
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}
	function insert() {
		$this->log('daftar', 'insert');
		$id = substr(md5($this->input->post('emailn')),0,8);
		if($this->getuser($id)) {
			$this->session->set_userdata('error', 'Maaf anda sudah terdaftar!');
			redirect('daftar');
		} else {
			$data = array(
				'id_user' => $id,
				'email' => $this->input->post('emailn'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'ktp' => $this->input->post('ktp'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'menikah' => $this->input->post('menikah'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'propinsi' => $this->input->post('propinsi'),
				'kode_area' => $this->input->post('kode_area'),
				'telpon' => $this->input->post('telpon'),
				'hp' => $this->input->post('hp'),
				'deskripsi' => $this->input->post('deskripsi'),
				'level' => 0,
				'status' => 1,
			);
			$this->db->insert('user', $data);
		}
	}
	function update($id) {
		if($this->input->post('password') == '') {
			$data = array(
				'nama' => $this->input->post('nama'),
				'ktp' => $this->input->post('ktp'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'menikah' => $this->input->post('menikah'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'propinsi' => $this->input->post('propinsi'),
				'kode_area' => $this->input->post('kode_area'),
				'telpon' => $this->input->post('telpon'),
				'hp' => $this->input->post('hp'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		} else {
			$data = array(
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'ktp' => $this->input->post('ktp'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'menikah' => $this->input->post('menikah'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'propinsi' => $this->input->post('propinsi'),
				'kode_area' => $this->input->post('kode_area'),
				'telpon' => $this->input->post('telpon'),
				'hp' => $this->input->post('hp'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		}
		$this->log('daftar', 'update');
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
	}
}