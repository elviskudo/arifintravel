<?php if (! defined('BASEPATH')) exit('No direct script access');

class Kota_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', 1);
		$query = $this->db->get('kota');
		return $query->result();
	}
	function get($id) {
		$this->db->select('nama');
		$this->db->where('id_kota', $id);
		$this->db->where('status', '1');
		$query = $this->db->get('kota');
		$row = $query->row();
		return $row->nama;
	}
	function getkota($kota) {
		$kota = strtolower($kota);
		$this->db->select('id_kota');
		$this->db->where('nama', $kota);
		$query = $this->db->get('kota');
		$row = $query->row();
		$id_kota = $row->id_kota;
		$this->db->select('jam');
		$this->db->where('id_kota', $id_kota);
		$query = $this->db->get('jam');
		return $query->result();
	}
	function getbiaya($id) {
		$this->db->select('biaya');
		$this->db->where('id_kota', $id);
		$this->db->where('status', '1');
		$query = $this->db->get('kota');
		$row = $query->row();
		return $row->biaya;
	}
	function getp($id) {
		$this->db->where('id_kota', $id);
		$query = $this->db->get('kota');
		return $query->result();
	}
	function page($limit, $offset) {
		$this->db->where('status', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('kota');
		return $query->result();
	}
	function count() {
		$this->db->where('status', '1');
		$query = $this->db->get('kota');
		return $query->num_rows();
	}
	
	/* process CRUD */
	function insert() {
		$data = array(
			'nama' => $this->input->post('nama'),
			'biaya' => $this->input->post('biaya'),
			'status' => 1
		);
		$this->db->insert('kota', $data);
	}
	function update($id) {
		$data = array(
			'nama' => $this->input->post('nama'),
			'biaya' => $this->input->post('biaya')
		);
		$this->db->where('id_kota', $id);
		$this->db->update('kota', $data);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_kota', $id);
		$this->db->update('kota', $data);
	}
	function force($id) {
		$this->db->where('id_kota', $id);
		$this->db->delete('kota');
	}

}