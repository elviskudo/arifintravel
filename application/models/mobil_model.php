<?php if (! defined('BASEPATH')) exit('No direct script access');

class Mobil_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', 1);
		$query = $this->db->get('mobil');
		return $query->result();
	}
	function get($id) {
		$this->db->select('nama');
		$this->db->where('id_mobil', $id);
		$this->db->where('status', '1');
		$query = $this->db->get('mobil');
		$row = $query->row();
		return $row->nama;
	}
	function getmobil($mobil) {
		$mobil = strtolower($mobil);
		$this->db->select('id_mobil');
		$this->db->where('nama', $mobil);
		$query = $this->db->get('mobil');
		$row = $query->row();
		$id_mobil = $row->id_mobil;
		$this->db->select('jam');
		$this->db->where('id_mobil', $id_mobil);
		$query = $this->db->get('jam');
		return $query->result();
	}
	function getbiaya($id) {
		$this->db->select('biaya');
		$this->db->where('id_mobil', $id);
		$this->db->where('status', '1');
		$query = $this->db->get('mobil');
		$row = $query->row();
		return $row->biaya;
	}
	function getp($id) {
		$this->db->where('id_mobil', $id);
		$query = $this->db->get('mobil');
		return $query->result();
	}
	function page($limit, $offset) {
		//$this->db->where('status', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('mobil');
		return $query->result();
	}
	function count() {
		//$this->db->where('status', '1');
		$query = $this->db->get('mobil');
		return $query->num_rows();
	}
	
	/* process CRUD */
	function insert() {
		$data = array(
			'plat' => $this->input->post('plat'),
			'jenis' => $this->input->post('jenis'),
			'tarif' => $this->input->post('tarif'),
			'warna' => $this->input->post('warna')
		);
		$this->db->insert('mobil', $data);
	}
	function update($id) {
		$data = array(
			'plat' => $this->input->post('plat'),
			'jenis' => $this->input->post('jenis'),
			'tarif' => $this->input->post('tarif'),
			'warna' => $this->input->post('warna')
		);
		$this->db->where('id_mobil', $id);
		$this->db->update('mobil', $data);
	}
	//function delete($id) {
	//	$data = array(
	//		'status' => 0
	//	);
	//	$this->db->where('id_mobil', $id);
	//	$this->db->update('mobil', $data);
	//}
	function delete($id) {
		$this->db->where('id_mobil', $id);
		$this->db->delete('mobil');
	}
	function force($id) {
		$this->db->where('id_mobil', $id);
		$this->db->delete('mobil');
	}

}