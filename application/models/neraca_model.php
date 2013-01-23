<?php if (! defined('BASEPATH')) exit('No direct script access');

class Neraca_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', '1');
		$query = $this->db->get('neraca');
		return $query->result();
	}
	function get($search, $id) {
		$this->db->select($search);
		$this->db->where('id_neraca', $id);
		$query = $this->db->get('neraca');
		$row = $query->row();
		return $row->$search;
	}
	function getp($id) {
		$this->db->where('id_neraca', $id);
		$query = $this->db->get('neraca');
		return $query->result();
	}
	function getq($id) {
		$query = "
			SELECT a.id_neraca as id_neraca, a.no as no_neraca, a.nama as nama_neraca
			FROM neraca a, jam b
			WHERE a.id_neraca=b.id_neraca
				AND b.id_jam='".$id."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->id_neraca.'. '.$row->no_neraca.' - '.$row->nama_neraca;
	}
	function page($limit, $offset) {
		$this->db->where('status', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('neraca');
		return $query->result();
	}
	function count() {
		$this->db->where('status', '1');
		$query = $this->db->get('neraca');
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
		$this->db->insert('neraca', $data);
	}
	function update($id) {
		$data = array(
			'no' => $this->input->post('no'),
			'nama' => $this->input->post('nama'),
			'jam' => $this->input->post('jam')
		);
		$this->db->where('id_neraca', $id);
		$this->db->update('neraca', $data);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_neraca', $id);
		$this->db->update('neraca', $data);
	}
	function force($id) {
		$this->db->where('id_neraca', $id);
		$this->db->delete('neraca');
	}

}