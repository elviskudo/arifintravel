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
	function tanggalan($tanggal) {
		/* konversi tanggal 31/01/2011 jadi 2011-01-31 */
		$tahun = substr($tanggal,6,4);
		$bulan = substr($tanggal,3,2);
		$tanggal = substr($tanggal,0,2);
		$tanggal_antar = $tahun.'-'.$bulan.'-'.$tanggal;
		return $tanggal_antar;
	}
	function searchq($id_cabang, $arus, $tanggal1, $tanggal2, $limit, $offset) {
		if($offset == '')
			$offset = 0;
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
		";
		if($id_cabang != 0)
			$query .= " AND a.id_cabang = ".$id_cabang."
		";
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$query .= " AND a.tanggal >= UNIX_TIMESTAMP('".$tanggal1." 00:00:00') AND a.tanggal <= UNIX_TIMESTAMP('".$tanggal2." 23:59:59')";
			else
				$query .= " AND a.tanggal >= UNIX_TIMESTAMP('".$tanggal1." 00:00:00') AND a.tanggal <= UNIX_TIMESTAMP('".$tanggal1." 23:59:59')";
		}
		$query .= "
				AND a.arus = '".$arus."'
			ORDER BY a.tanggal DESC
			LIMIT ".$limit." OFFSET ".$offset."
		";

		$query = $this->db->query($query);
		return $query->result();
	}
	function countq($id_cabang, $arus, $tanggal1, $tanggal2) {
		$query = "
			SELECT COUNT(a.id_cabang) AS total
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
		";
		if($id_cabang != 0)
			$query .= " AND a.id_cabang = ".$id_cabang."
		";
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$query .= " AND a.tanggal >= UNIX_TIMESTAMP('".$tanggal1." 00:00:00') AND a.tanggal <= UNIX_TIMESTAMP('".$tanggal2." 23:59:59')";
			else
				$query .= " AND a.tanggal >= UNIX_TIMESTAMP('".$tanggal1." 00:00:00') AND a.tanggal <= UNIX_TIMESTAMP('".$tanggal1." 23:59:59')";
		}
		$query .= "
				AND a.arus = '".$arus."'
		";

		$query = $this->db->query($query);
		return $query->row()->total;
	}
	function kasmasuk($tanggal1=NULL, $tanggal2=NULL) {
		$query = "
			SELECT SUM(nilai) AS kasmasuk
			FROM transaksi
			WHERE arus = 'masuk'
		";
		if($tanggal1 != NULL && $tanggal2 != NULL)
			$query .= "AND tanggal >= UNIX_TIMESTAMP('".$tanggal1." 00:00:00') AND tanggal <= UNIX_TIMESTAMP('".$tanggal2." 23:59:59')";
		if($this->session->userdata('email') != 'admin@arifintravel.com')
			$query .= "AND id_cabang = ".$this->session->userdata('id_cabang');
		$row = $this->db->query($query)->row();
		if($row->kasmasuk == NULL)
			return 0;
		else
			return $row->kasmasuk;
	}
	function kaskeluar($tanggal1=NULL, $tanggal2=NULL) {
		$query = "
			SELECT SUM(nilai) AS kaskeluar
			FROM transaksi
			WHERE arus = 'keluar'
		";
		if($tanggal1 != NULL && $tanggal2 != NULL)
			$query .= "AND tanggal >= UNIX_TIMESTAMP('".$tanggal1." 00:00:00') AND tanggal <= UNIX_TIMESTAMP('".$tanggal2." 23:59:59')";
		if($this->session->userdata('email') != 'admin@arifintravel.com')
			$query .= "AND id_cabang = ".$this->session->userdata('id_cabang');
		$row = $this->db->query($query)->row();
		if($row->kaskeluar == NULL)
			return 0;
		else
			return $row->kaskeluar;
	}
	function page($limit, $offset) {
		if($offset == '')
			$offset = 0;
		$query = "
			SELECT a.id_transaksi, a.tanggal, b.nama, a.judul, a.keterangan, a.nilai, a.status
			FROM transaksi a, cabang b
			WHERE a.id_cabang = b.id_cabang
				AND a.status = 1
		";
		if($this->session->userdata('email') != 'admin@arifintravel.com')
			$query .= " AND a.id_cabang = ".$this->session->userdata('id_cabang');
		$query .= "
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
		";
		if($this->session->userdata('email') != 'admin@arifintravel.com')
			$query .= " AND a.id_cabang = ".$this->session->userdata('id_cabang');
		$query .= "
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
			'arus' => $this->input->post('kas'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);
		$id_transaksi = $this->db->insert_id();

		// insert log
		$this->log('insert '.$this->input->post('judul'), $this->input->post('keterangan').' sebesar: '.$this->input->post('kas'), $id_transaksi);

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
		$saldo = $row->saldo_akhir - $nilai;
		if($saldo <= 0)
			$saldo = 0;
		$data = array(
			'saldo_akhir' => $saldo
		);
		$this->db->where('id_cabang', $id_cabang);
		$this->db->update('cabang', $data);

		// insert log
		$this->log('delete transaksi sebesar: '.$nilai, 'delete oleh '.$this->session->userdata('email').' di kota: '.$row->nama, $id);
	}
	function force($id) {
		$this->db->where('id_transaksi', $id);
		$this->db->delete('transaksi');
	}

}