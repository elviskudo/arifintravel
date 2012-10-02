<?php if (! defined('BASEPATH')) exit('No direct script access');

class Penumpang_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->order_by('id_penumpang', 'DESC');
		$query = $this->db->get('penumpang');
		return $query->result();
	}
	function get($search, $id) {
		$this->db->select($search);
		$this->db->where('id_penumpang', $id);
		$query = $this->db->get('penumpang');
		$row = $query->row();
		return $row->$search;
	}
	function getp($id) {
		$this->db->where('id_penumpang', $id);
		$query = $this->db->get('penumpang');
		return $query->result();
	}
	function log($isi) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => $isi.' penumpang',
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}
	function insert() {
		$this->log('insert');
		
		$data = array(
			'no' => $this->input->post('no'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telpon' => $this->input->post('telpon'),
			'catatan' => $this->input->post('catatan')
		);
		$this->db->insert('penumpang', $data);
	}
	function update($id) {
		$this->log('update');
		$data = array(
			'no' => $this->input->post('no'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telpon' => $this->input->post('telpon'),
			'catatan' => $this->input->post('catatan')
		);
		$this->db->where('id_penumpang', $id);
		$this->db->update('penumpang', $data);
	}
	function delete($id) {
		$this->log('delete');
		$this->db->where('id_penumpang', $id);
		$this->db->delete('penumpang');
	}
	
}