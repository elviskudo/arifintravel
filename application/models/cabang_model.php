<?php if (! defined('BASEPATH')) exit('No direct script access');

class Cabang_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		$this->db->where('status', '1');
		$this->db->order_by('nama');
		$query = $this->db->get('cabang');
		return $query->result();
	}
	function get($search, $id) {
		$this->db->select($search);
		$this->db->where('id_cabang', $id);
		$this->db->where('status', 1);
		$this->db->order_by('nama');
		$query = $this->db->get('cabang');
		$row = $query->row();
		return $row->$search;
	}
	function getnama($id) {
		$this->db->select('nama, kota');
		$this->db->where('id_cabang', $id);
		$query = $this->db->get('cabang');
		$row = $query->row();
		return $row->nama.' KOTA '.$row->kota;
	}
	function getp($id) {
		$this->db->where('id_cabang', $id);
		$this->db->where('status', 1);
		$this->db->order_by('nama');
		$query = $this->db->get('cabang');
		return $query->result();
	}
	function getq($id) {
		$query = "
			SELECT id_cabang as id_cabang, nama as nama_cabang
			FROM cabang
			WHERE id_cabang=b.id_cabang
				AND b.id_jam='".$id."'
			ORDER BY nama_cabang
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->id_cabang.' - '.$row->nama_cabang;
	}
	function page($limit, $offset) {
		$this->db->where('status', 1);
		$this->db->order_by('nama');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('cabang');
		return $query->result();
	}
	function count() {
		$this->db->where('status', 1);
		$query = $this->db->get('cabang');
		return $query->num_rows();
	}
	function saldoawal() {
		if($this->session->userdata('level') == 1) {
			$this->db->select('SUM(saldo_awal) AS saldo_awal');
			$row = $this->db->get('cabang')->row();
			return $row->saldo_awal;
		} else {
			$this->db->select('saldo_awal');
			$this->db->where('id_cabang', $this->session->userdata('id_cabang'));
			$row = $this->db->get('cabang')->row();
			return $row->saldo_awal;
		}
	}
	function saldoakhir() {
		if($this->session->userdata('level') == 1) {
			$this->db->select('SUM(saldo_akhir) AS saldo_akhir');
			$row = $this->db->get('cabang')->row();
			return $row->saldo_akhir;
		} else {
			$this->db->select('saldo_akhir');
			$this->db->where('id_cabang', $this->session->userdata('id_cabang'));
			$row = $this->db->get('cabang')->row();
			return $row->saldo_akhir;
		}
	}
	
	/* process CRUD */
	function log($isi, $id_cabang) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => $isi.' cabang&id: '.$id_cabang,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}
	function insert() {
		// insert to cabang
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'nama' => strtoupper($this->input->post('nama')),
			'alamat' => $this->input->post('alamat'),
			'kota' => strtoupper($this->input->post('kota')),
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
		$this->log('insert', $id);

		// insert to transaksi
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $id_cabang,
			'judul' => 'SALDO AWAL CABANG KOTA '.strtoupper($this->input->post('kota')),
			'keterangan' => 'Saldo awal kantor cabang dengan nama: '.$this->input->post('nama').' yang beralamat di '.$this->input->post('alamat').' kota '.$this->input->post('kota').' , kontak person: '.$this->input->post('kontak').' dengan saldo awal sebesar: '.str_replace(',','.',number_format($row->saldo_akhir)),
			'nilai' => $this->input->post('saldo'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);
		$this->log('insert transaksi', $id);
	}
	function update($id) {
		$data = array(
			'nama' => strtoupper($this->input->post('nama')),
			'alamat' => $this->input->post('alamat'),
			'kota' => strtoupper($this->input->post('kota')),
			'telpon' => $this->input->post('telpon'),
			'email' => $this->input->post('email'),
			'kontak' => $this->input->post('kontak'),
			'hp' => $this->input->post('hp'),
			'saldo_awal' => $this->input->post('saldo_awal'),
			'saldo_akhir' => $this->input->post('saldo_akhir'),
		);
		$this->db->where('id_cabang', $id);
		$this->db->update('cabang', $data);
		$this->log('update', $id);

		// insert to transaksi
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $id,
			'judul' => 'PERUBAHAN SALDO CABANG KOTA '.strtoupper($this->input->post('kota')),
			'keterangan' => 'Perubahan saldo awal dari kantor cabang dengan nama: '.$this->input->post('nama').' yang beralamat di '.$this->input->post('alamat').' kota '.$this->input->post('kota').' , kontak person: '.$this->input->post('kontak').' sebesar: '.str_replace(',','.',number_format($row->saldo_akhir)),
			'nilai' => $this->input->post('saldo'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);
		$this->log('update transaksi', $id);
	}
	function delete($id) {
		if($id > 1) {
			// update cabangnya
			$data = array(
				'status' => 0,
			);
			$this->db->where('id_cabang', $id);
			$this->db->update('cabang', $data);
			$this->log('delete', $id);
			// update transaksinya
			$data = array('status'=>0);
			$this->db->where('id_cabang', $id);
			$this->db->update('transaksi', $data);
			$this->log('delete transaksi', $id);
		}
	}
	function force($id) {
		$this->db->where('id_cabang', $id);
		$this->db->delete('transaksi');
		$this->log('force', $id);

		$this->db->where('id_cabang', $id);
		$this->db->delete('cabang');
		$this->log('force transaksi', $id);
	}

}