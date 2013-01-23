<?php if (! defined('BASEPATH')) exit('No direct script access');

class Cabang_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', '1');
		$query = $this->db->get('cabang');
		return $query->result();
	}
	function get($search, $id) {
		$this->db->select($search);
		$this->db->where('id_cabang', $id);
		$this->db->where('status', 1);
		$query = $this->db->get('cabang');
		$row = $query->row();
		return $row->$search;
	}
	function getp($id) {
		$this->db->where('id_cabang', $id);
		$this->db->where('status', 1);
		$query = $this->db->get('cabang');
		return $query->result();
	}
	function getq($id) {
		$query = "
			SELECT id_cabang as id_cabang, nama as nama_cabang
			FROM cabang
			WHERE id_cabang=b.id_cabang
				AND b.id_jam='".$id."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->id_cabang.' - '.$row->nama_cabang;
	}
	function page($limit, $offset) {
		$this->db->where('status', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('cabang');
		return $query->result();
	}
	function count() {
		$this->db->where('status', '1');
		$query = $this->db->get('cabang');
		return $query->num_rows();
	}
	
	/* process CRUD */
	function insert() {
		// insert to cabang
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'kota' => $this->input->post('kota'),
			'telpon' => $this->input->post('telpon'),
			'email' => $this->input->post('email'),
			'kontak' => $this->input->post('kontak'),
			'hp' => $this->input->post('hp'),
			'saldo_awal' => $this->input->post('saldo'),
			'saldo_akhir' => $this->input->post('saldo'),
			'status' => 1
		);
		$this->db->insert('cabang', $data);
		$id_cabang = $this->db->insert_id();

		// insert to transaksi
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $id_cabang,
			'judul' => 'SALDO AWAL CABANG KOTA '.$this->input->post('kota'),
			'keterangan' => 'Saldo awal kantor cabang dengan nama: '.$this->input->post('nama').' yang beralamat di '.$this->input->post('alamat').' kota '.$this->input->post('kota').' , kontak person: '.$this->input->post('kontak').' dengan saldo awal sebesar: '.str_replace(',','.',number_format($row->saldo_akhir)),
			'nilai' => $this->input->post('saldo'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);
	}
	function update($id) {
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'kota' => $this->input->post('kota'),
			'telpon' => $this->input->post('telpon'),
			'email' => $this->input->post('email'),
			'kontak' => $this->input->post('kontak'),
			'hp' => $this->input->post('hp'),
			'saldo_akhir' => $this->input->post('saldo'),
		);
		$this->db->where('id_cabang', $id);
		$this->db->update('cabang', $data);

		// insert to transaksi
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $id,
			'judul' => 'PERUBAHAN SALDO CABANG KOTA '.$this->input->post('kota'),
			'keterangan' => 'Perubahan saldo awal dari kantor cabang dengan nama: '.$this->input->post('nama').' yang beralamat di '.$this->input->post('alamat').' kota '.$this->input->post('kota').' , kontak person: '.$this->input->post('kontak').' sebesar: '.str_replace(',','.',number_format($row->saldo_akhir)),
			'nilai' => $this->input->post('saldo'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_cabang', $id);
		$this->db->update('cabang', $data);
	}
	function force($id) {
		$this->db->where('id_cabang', $id);
		$this->db->delete('transaksi');

		$this->db->where('id_cabang', $id);
		$this->db->delete('cabang');
	}

}