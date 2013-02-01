<?php if (! defined('BASEPATH')) exit('No direct script access');

class Admin_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$query = "
			SELECT a.id_admin, a.tanggal, b.nama as cabang, 
				a.email, a.password, a.nama, a.kota, a.telpon,
				a.hp
			FROM admin a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
				AND a.level = 0
			ORDER BY a.nama
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('admin');
		return $query->result();
	}
	function getlogin($email, $password, $cabang) {
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('id_cabang', $cabang);
		$query = $this->db->get('admin');
		return $query->result();
	}
	function get($search, $id) {
		$this->db->select($search);
		$this->db->where('id_admin', $id);
		$this->db->where('level', 0);
		$this->db->where('status', 1);
		$query = $this->db->get('admin');
		$row = $query->row();
		return $row->$search;
	}
	function getp($id) {
		$query = "
			SELECT a.id_admin, a.tanggal, b.nama as cabang, 
				a.email, a.password, a.nama, a.kota, a.telpon,
				a.hp
			FROM admin a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
				AND a.level = 0
				AND a.id_admin = ".$id."
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getq($id) {
		$query = "
			SELECT id_admin as id_admin, nama as nama_admin
			FROM admin
			WHERE id_admin=b.id_admin
				AND b.id_jam='".$id."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->id_admin.' - '.$row->nama_admin;
	}
	function page($limit, $offset) {
		if($offset == '') $offset = 0;
		$query = "
			SELECT a.id_admin, a.tanggal, b.nama as cabang, 
				a.email, a.password, a.nama, a.kota, a.telpon,
				a.hp
			FROM admin a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
				AND a.level = 0
			ORDER BY a.nama
			LIMIT ".$limit." OFFSET ".$offset."
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function count() {
		$this->db->where('level', 0);
		$this->db->where('status', 1);
		$query = $this->db->get('admin');
		return $query->num_rows();
	}
	
	/* process CRUD */
	function log($isi, $id_admin) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => $isi.' admin&id: '.$id_admin,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}
	function insert() {
		// insert to admin
		$data = array(
			'tanggal' => time(),
			'id_cabang' => $this->input->post('cabang'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'kota' => strtoupper($this->input->post('kota')),
			'telpon' => $this->input->post('telpon'),
			'hp' => $this->input->post('hp'),
			'level' => 0,
			'status' => 1
		);
		$this->db->insert('admin', $data);
		$id = $this->db->insert_id();
		$this->log('insert', $id);
	}
	function update($id) {
		$data = array(
			'id_cabang' => $this->input->post('cabang'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'kota' => strtoupper($this->input->post('kota')),
			'telpon' => $this->input->post('telpon'),
			'hp' => $this->input->post('hp'),
		);
		$this->db->where('id_admin', $id);
		$this->db->update('admin', $data);
		$this->log('update', $id);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_admin', $id);
		$this->db->update('admin', $data);
		$this->log('delete', $id);
	}
	function force($id) {
		$this->db->where('id_admin', $id);
		$this->db->delete('admin');
		$this->log('force', $id);
	}

}