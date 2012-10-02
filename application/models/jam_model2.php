<?php if (! defined('BASEPATH')) exit('No direct script access');

class Jam_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$query = "
			SELECT a.id_jam as id_jam, a.jam as jam, b.no as no, b.nama as nama, c.nama as kota 
			FROM jam a, pesawat b, kota c 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.id_kota = c.id_kota
			ORDER BY a.id_jam DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
        function get2($kota) {
		$query = "
			SELECT a.id_jam as id_jam, a.jam as jam, b.no as no, b.nama as nama, c.nama as kota 
			FROM jam a, pesawat b, kota c 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.id_kota = c.id_kota
                                AND a.id_kota = ".$kota."
			ORDER BY a.id_jam DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function get($kota) {
		$this->db->where('id_kota', $kota);
		$query = $this->db->get('jam');
		return $query->result();
	}
	function getjam($id) {
		$this->db->where('id_jam', $id);
		$query = $this->db->get('jam');
		$row = $query->row();
		return $row->jam;
	}
	function pesawat() {
		$this->db->where('status', '1');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get('pesawat');
		return $query->result();
	}
	function kota() {
		//$this->db->where('id_kota', '1');
		$this->db->where('status', '1');
		$this->db->order_by('id_kota', 'ASC');
		$query = $this->db->get('kota');
		return $query->result();
	}
	function getp($id) {
		$query = "
			SELECT a.id_jam as id_jam, a.id_pesawat as id_pesawat, a.id_kota as id_kota, 
				a.jam as jam, b.no as no, b.nama as nama, c.nama as kota 
			FROM jam a, pesawat b, kota c 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.id_kota = c.id_kota
				AND id_jam ='".$id."'
			ORDER BY a.id_jam DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function search() {
		$query = "
			SELECT a.id_jam as id_jam, a.jam as jam, b.no as no, b.nama as nama, c.nama as kota 
			FROM jam a, pesawat b, kota c 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.id_kota = c.id_kota
				AND a.id_kota = ".$this->input->post('kota')."
			ORDER BY a.id_jam DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function page($limit, $offset) {
		if($offset == '') $offset = 0;
		$query = "
			SELECT a.id_jam as id_jam, a.jam as jam, b.no as no, b.nama as nama, c.nama as kota 
			FROM jam a, pesawat b, kota c 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.id_kota = c.id_kota
				AND a.id_kota = 1
			ORDER BY a.id_jam DESC
			LIMIT ".$offset.", ".$limit."
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function count() {
		$query = "
			SELECT a.id_jam as id_jam, a.jam as jam, b.no as no, b.nama as nama, c.nama as kota 
			FROM jam a, pesawat b, kota c 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.id_kota = c.id_kota
			ORDER BY a.id_jam DESC
		";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	/* process CRUD */
	function insert() {
		$data = array(
			'jam' => $this->input->post('jam'),
			'id_pesawat' => $this->input->post('no'),
			'id_kota' => $this->input->post('kota')
		);
		$this->db->insert('jam', $data);
	}
	function update($id) {
		$data = array(
			'jam' => $this->input->post('jam'),
			'id_pesawat' => $this->input->post('no'),
			'id_kota' => $this->input->post('kota')
		);
		$this->db->where('id_jam', $id);
		$this->db->update('jam', $data);
	}
	function delete($id) {
		$this->db->where('id_jam', $id);
		$this->db->delete('jam');
	}
	function force($id) {
		$this->db->where('id_jam', $id);
		$this->db->delete('jam');
	}

}