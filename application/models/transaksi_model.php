<?php if (! defined('BASEPATH')) exit('No direct script access');

class Transaksi_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
			ORDER BY a.tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function get($search, $id) {
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
				AND a.id_transaksi = ".$id."
			ORDER BY a.tanggal DESC
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->$search;
	}
	function getp($id) {
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
				AND a.id_transaksi = '".$id."'
			ORDER BY a.tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getq($id) {
		$query = "
			SELECT a.id_transaksi as id_transaksi, a.no as no_transaksi, a.nama as nama_transaksi
			FROM transaksi a, jam b
			WHERE a.id_transaksi=b.id_transaksi
				AND b.id_jam='".$id."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->id_transaksi.'. '.$row->no_transaksi.' - '.$row->nama_transaksi;
	}
	function page($limit, $offset) {
		if($offset == '')
			$offset = 0;
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
			ORDER BY a.tanggal DESC
			LIMIT ".$limit." OFFSET ".$offset."
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function count() {
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
			ORDER BY a.tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	/* process CRUD */
	function log($judul, $keterangan, $id_transaksi) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => 'transaksi: '.$judul.' dengan keterangan: '.$keterangan.'<br>id: '.$id_transaksi,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}

	function insert() {
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $this->input->post('id_cabang'),
			'judul' => $this->input->post('judul'),
			'keterangan' => $this->input->post('keterangan'),
			'nilai' => $this->input->post('nilai'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);
		$id_transaksi = $this->db->insert_id();

		// insert log
		$this->log('insert '.$this->input->post('judul'), $this->input->post('keterangan'), $id_transaksi);

		// update to cabang
		$this->db->select('saldo_akhir');
		$this->db->where('id_cabang', $this->input->post('id_cabang'));
		$query = $this->db->get('cabang');
		$row = $query->row();
		$saldo_akhir = $row->saldo_akhir;
		$data = array(
			'saldo_akhir' => $saldo_akhir + $this->input->post('nilai')
		);
		$this->db->where('id_cabang', $this->input->post('id_cabang'));
		$this->db->update('cabang', $data);
	}
	function update($id) {
		$data = array(
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $this->input->post('id_cabang'),
			'judul' => $this->input->post('judul'),
			'keterangan' => $this->input->post('keterangan'),
			'nilai' => $this->input->post('nilai'),
		);
		$this->db->where('id_transaksi', $id);
		$this->db->update('transaksi', $data);

		// insert log
		$this->log('update '.$this->input->post('judul'), $this->input->post('keterangan'), $id_transaksi);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_transaksi', $id);
		$this->db->update('transaksi', $data);
		
		// kurangkan pada saldo akhir cabang
		$this->db->select('nilai, id_cabang');
		$this->db->where('id_transaksi', $id);
		$query = $this->db->get('transaksi');
		$row = $query->row();
		$nilai = $row->nilai;
		$id_cabang = $row->id_cabang;

		$this->db->select('saldo_akhir');
		$this->db->where('id_cabang', $id_cabang);
		$query = $this->db->get('cabang');
		$row = $query->row();
		$data = array(
			'saldo_akhir' => ($row->saldo_akhir - $nilai)
		);
		$this->db->where('id_cabang', $id_cabang);
		$this->db->update('cabang', $data);

		// insert log
		$this->log('delete transaksi bernilai: '.$nilai, 'delete oleh '.$this->session->userdata('email'), $id);
	}
	function force($id) {
		$this->db->where('id_transaksi', $id);
		$this->db->delete('transaksi');
	}

}