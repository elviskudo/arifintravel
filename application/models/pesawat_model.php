<?php if (! defined('BASEPATH')) exit('No direct script access');

class Pesawat_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', '1');
		$query = $this->db->get('pesawat');
		return $query->result();
	}
	function get($search, $id) {
		$this->db->select($search);
		$this->db->where('id_pesawat', $id);
		$query = $this->db->get('pesawat');
		$row = $query->row();
		return $row->$search;
	}
	function getp($id) {
		$this->db->where('id_pesawat', $id);
		$query = $this->db->get('pesawat');
		return $query->result();
	}
	function getq($id) {
		$query = "
			SELECT a.id_pesawat as id_pesawat, a.no as no_pesawat, a.nama as nama_pesawat
			FROM pesawat a, jam b
			WHERE a.id_pesawat=b.id_pesawat
				AND b.id_jam='".$id."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->id_pesawat.'. '.$row->no_pesawat.' - '.$row->nama_pesawat;
	}
	function page($limit, $offset) {
		$this->db->where('status', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('pesawat');
		return $query->result();
	}
	function count() {
		$this->db->where('status', '1');
		$query = $this->db->get('pesawat');
		return $query->num_rows();
	}
	
	/* process CRUD */
	function insert() {
		$data = array(
			'no' => $this->input->post('no'),
			'nama' => $this->input->post('nama'),
			'jam' => $this->input->post('jam'),
			'status' => 1
		);
		$this->db->insert('pesawat', $data);
	}
	function update($id) {
		$data = array(
			'no' => $this->input->post('no'),
			'nama' => $this->input->post('nama'),
			'jam' => $this->input->post('jam')
		);
		$this->db->where('id_pesawat', $id);
		$this->db->update('pesawat', $data);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_pesawat', $id);
		$this->db->update('pesawat', $data);
	}
	function force($id) {
		$this->db->where('id_pesawat', $id);
		$this->db->delete('pesawat');
	}

}