<?php if (! defined('BASEPATH')) exit('No direct script access');

class Rental_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		//$this->db->where('status', 1);
		$query = $this->db->get('kurs');
		return $query->result();
	}
	function getMember($id) {
		//$this->db->select('member');
		$this->db->where('id_member', $id);
		//$this->db->where('status', '1');
		$query = $this->db->get('member');
	    return $query->result();
	}
	function getMobil($id) {
		//$this->db->select('mobil');
		$this->db->where('id_mobil', $id);
		//$this->db->where('status', '1');
		$query = $this->db->get('mobil');
	    return $query->result();
	}
	function page($limit, $offset) {
		//$this->db->where('status', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('kurs');
		return $query->result();
	}
	function count() {
		$query = $this->db->get('kurs');
		return $query->num_rows();
	}
	function countp() {
		$query = $this->db->get('penukaran');
		return $query->num_rows();
	}
	function getp($id) {
		$this->db->where('id_kurs', $id);
		$query = $this->db->get('kurs');
		return $query->result();
	}
	function searchq() {
		$sql = "
			SELECT * FROM persewaan 
			WHERE id_persewaan <> 'RC'  
		";
		if($this->input->post('no')) {
			$sql .= " AND id_persewaan LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND tgl_mulai >= '".$tanggal1."' AND tgl_mulai <= '".$tanggal2."'";
			else
				$sql .= " AND tgl_mulai >= '".$tanggal1."' AND tgl_mulai <= '".$tanggal1."'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND cabang_pemesan LIKE '%".$this->input->post('kota')."%'";
		}
		
		
		//if($this->input->post('mata_uang') != 'semua') {
			$sql .= " order by tgl_mulai ASC";
	//echo $sql;
		$query = $this->db->query($sql);
		return $query->result();
	}
	function totalq() {
		$sql = "
			SELECT SUM(tarif) as totalbiaya FROM persewaan 
			WHERE id_persewaan <> 'RC'  
		";
		if($this->input->post('no')) {
			$sql .= " AND id_persewaan LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND tgl_mulai >= '".$tanggal1."' AND tgl_mulai <= '".$tanggal2."'";
			else
				$sql .= " AND tgl_mulai >= '".$tanggal1."' AND tgl_mulai <= '".$tanggal1."'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND cabang_pemesan LIKE '%".$this->input->post('kota')."%'";
		}
		
		
		//if($this->input->post('mata_uang') != 'semua') {
			$sql .= " order by tgl_mulai ASC";		
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
	
	function pagep($limit, $offset) {
		if($offset == '') $offset = 0;
		$sql = "
			SELECT * FROM persewaan 
			WHERE tgl_mulai >= '".date("Y-m-d")."' AND tgl_mulai <= '".date("Y-m-d")."'
			ORDER BY tgl_mulai ASC";  
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function total() {
		//if($offset == '') $offset = 0;
		$sql = "
			SELECT SUM(tarif) as totalbiaya FROM persewaan 
			WHERE tgl_mulai >= '".date("Y-m-d")."' AND tgl_mulai <= '".date("Y-m-d")."'
			ORDER BY tgl_mulai ASC"; 
		
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
	/* process CRUD */

	function insert() {
		/* bikin invoice antar */
		foreach($this->getNoInvoice() as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'RC-'.date('my').'-0'.$combinecode;
				
		/* isi data penukaran */
		$data = array(
			'id_persewaan' => $no,
			'tujuan' => $this->input->post('tujuan'),
			'tgl_mulai' => $this->tanggalan($this->input->post('tgl_mulai')),
			'tgl_akhir' => $this->tanggalan($this->input->post('tgl_akhir')),
			'cabang_pemesan' => $this->input->post('kota'),
			'id_member' => $this->input->post('id_member'),
			'id_mobil' => $this->input->post('id_mobil'),
			'tarif' => $this->input->post('tarif'),
			'jaminan' => $this->input->post('jaminan'),
			'catatan' => $this->input->post('catatan')
		);
		$this->db->insert('persewaan', $data);
			
		$this->session->set_userdata('id_persewaan', $no);
		/* isi data urutan */
		//echo "test".$combinecode;
		$this->updateNo($combinecode);

		// isi data transaksi
		$kota = $this->db->where('id_cabang', $this->input->post('kota'))->get('cabang')->nama;
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $this->input->post('kota'),
			'judul' => 'ID Sewa: '.$no.' dengan tujuan '.$this->input->post('tujuan'),
			'keterangan' => 'ID Sewa: '.$no.' dengan ID Member: '.$this->input->post('id_member').'
				dengan tujuan ke '.$this->input->post('tujuan').'
				pada tanggal mulai '.$this->tanggalan($this->input->post('tgl_mulai')).' 
				dan tanggal akhir '.$this->tanggalan($this->input->post('tgl_akhir')).'
				dengan jaminan '.$this->input->post('jaminan').'
				sebesar Rp '.$this->input->post('tarif').
			'arus' => 'masuk',
			'nilai' => $this->input->post('tarif'),
			'status' => 1
		);
		$this->db->insert('transaksi', $data);

		// update data saldo akhir cabang
		$saldo_akhir = $this->db->where('id_cabang',$this->input->post('kota'))->get('cabang')->row()->saldo_akhir;
		$data = array(
			'saldo_akhir' => ($saldo_akhir + $this->input->post('tarif'))
		);
		$this->db->where('id_cabang', $this->input->post('kota'));
		$this->db->update('cabang', $data);
	}
	
	function getNoInvoice() {
		$query = "SELECT nomor from urutan WHERE jenis ='persewaan'";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getPersewaan($no) {
		$query = "SELECT * from persewaan WHERE id_persewaan ='".$no."'";
		$query = $this->db->query($query);
		return $query->result();
	}

	function updateNo($nomor) {
		$no = $nomor+1;
	    $data = array('nomor' => $no);
		$this->db->where('jenis', 'persewaan');
		$this->db->update('urutan', $data);
	}
	
	function delete($id) {
		$this->db->where('id_kurs', $id);
		$this->db->delete('kurs');
	}
	function deletep($id) {
		$this->db->where('id_persewaan', $id);
		$this->db->delete('persewaan');
	}
	function force($id) {
		$this->db->where('id_kota', $id);
		$this->db->delete('kota');
	}
    function tanggalan($tanggal) {
		/* konversi tanggal 31/01/2011 jadi 2011-01-31 */
		$tahun = substr($tanggal,6,4);
		$bulan = substr($tanggal,3,2);
		$tanggal = substr($tanggal,0,2);
		$tanggal_antar = $tahun.'-'.$bulan.'-'.$tanggal;
		return $tanggal_antar;
	}
}