<?php if (! defined('BASEPATH')) exit('No direct script access');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->order_by('nama');
		$query = $this->db->get('user');
		return $query->result();
	}
	function getmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		return $query->result();
	}
	function mini() {
		$this->db->order_by('tanggal', 'desc');
		$query = $this->db->get('user', 0, 3);
		return $query->result();
	}
	function get($id) {
		$this->db->where('id_user', $id);
		$query = $this->db->get('user');
		return $query->result();
	}
	function getlimit($limit, $offset) {
		$this->db->where('status', 1);
		$query = $this->db->get('user', $limit, $offset);
		return $query->result();
	}
	function getlogin($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('level', '1');
		$query = $this->db->get('user');
		return $query->result();
	}
	function seek($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		return $query->result();
	}
	function log($isi) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => $isi.' user',
			'user' => $this->session->userdata('username'),
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}
	function insert() {
		$this->log('insert');
		$data = array(
			'id_user' => substr(md5($this->input->post('email')),0,8),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'kota' => $this->input->post('kota'),
			'propinsi' => $this->input->post('propinsi'),
			'telpon' => $this->input->post('telpon'),
			'hp' => $this->input->post('hp'),
			'level' => 1,
			'status' => 1
		);
		$this->db->insert('user', $data);
	}
	function update($id) {
		$this->log('update');
		if($this->input->post('password') == '') {
			$data = array(
				'email' => $this->input->post('email'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'propinsi' => $this->input->post('propinsi'),
				'telpon' => $this->input->post('telpon'),
				'hp' => $this->input->post('hp')
			);
		} else {
			$data = array(
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'propinsi' => $this->input->post('propinsi'),
				'telpon' => $this->input->post('telpon'),
				'hp' => $this->input->post('hp')
			);
		}
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
	}
	function delete($id) {
		$this->log('delete');
		$data = array(
			'status' => 0
		);
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
	}
	function force($id) {
		$this->log('force delete');
		$this->db->where('id_user', $id);
		$this->db->delete('user');
	}
	function count() {
		return $this->db->count_all('user');
	}

}