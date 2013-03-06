<?php if (! defined('BASEPATH')) exit('No direct script access');

class Tiket_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->model('kota_model', 'kota');
	}
	
	function all() {
		//$this->db->where('status', 1);
		$query = $this->db->get('tiket');
		return $query->result();
	}
	
	function getNoTiket() {
		$query = "SELECT nomor from urutan WHERE jenis ='tiket'";
		$query = $this->db->query($query);
		return $query->result();
	}

	function page($limit, $offset) {
		if($offset == '') $offset = 0;
		$sql = "
			SELECT * FROM tiket
			WHERE tgl_pemesanan >= '".date("Y-m-d")."' AND tgl_pemesanan <= '".date("Y-m-d")."'
			ORDER BY id_tiket ASC";  
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count() {
		$query = $this->db->get('tiket');
		return $query->num_rows();
	}
	function countp() {
		$query = $this->db->get('penukaran');
		return $query->num_rows();
	}
	function getp($id) {
		$this->db->where('id_tiket', $id);
		$query = $this->db->get('tiket');
		return $query->result();
	}

	
	function searchq() {
		$sql = "
			SELECT * FROM tiket 
			WHERE id_tiket <> 'TK'  
		";
		if($this->input->post('no')) {
			$sql .= " AND id_tiket LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND tgl_pemesanan >= '".$tanggal1."' AND tgl_pemesanan <= '".$tanggal2."'";
			else
				$sql .= " AND tgl_pemesanan >= '".$tanggal1."' AND tgl_pemesanan <= '".$tanggal1."'";
		}
		if($this->input->post('dari') != '') {
			$sql .= " AND dari LIKE '%".$this->input->post('dari')."%'";
		}
		//$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		if($this->input->post('tujuan') != '') {
			$sql .= " AND tujuan = '".$this->input->post('tujuan')."'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND cabang_pemesan LIKE '%".$this->input->post('kota')."%'";
		}
		
		//if($this->input->post('mata_uang') != 'semua') {
			$sql .= " order by tgl_pemesanan ASC";
		//} else {
		//	$sql .= "order by mata_uang ASC";
		//}	
		$query = $this->db->query($sql);
		return $query->result();
	}
	function totalq() {
		$sql = "
			SELECT SUM(biaya) as totalbiaya FROM tiket
			WHERE id_tiket <> 'TK'  
		";
		if($this->input->post('no')) {
			$sql .= " AND id_tiket LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND tgl_pemesanan >= '".$tanggal1."' AND tgl_pemesanan <= '".$tanggal2."'";
			else
				$sql .= " AND tgl_pemesanan >= '".$tanggal1."' AND tgl_pemesanan <= '".$tanggal1."'";
		}
		if($this->input->post('dari') != '') {
			$sql .= " AND dari LIKE '%".$this->input->post('dari')."%'";
		}
		//$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		if($this->input->post('tujuan') != '') {
			$sql .= " AND tujuan = '".$this->input->post('tujuan')."'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND cabang_pemesan LIKE '%".$this->input->post('kota')."%'";
		}
		
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
	
	function total() {
		//if($offset == '') $offset = 0;
		$sql = "
			SELECT SUM(biaya) as totalbiaya FROM tiket 
			WHERE tgl_pemesanan >= '".date("Y-m-d")."' AND tgl_pemesanan <= '".date("Y-m-d")."'
			ORDER BY id_tiket ASC";  
		
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}

	/* process CRUD */
	function insert() {
		/* bikin invoice antar */
		foreach($this->getNoTiket() as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'TK-'.date('my').'-0'.$combinecode;
		
		$biaya = str_replace('.','',$this->input->post('biaya'));
		
		/* isi data penukaran */
		$data = array(
			'id_tiket' => $no,
			'dari' => $this->input->post('dari'),
			'tujuan' => $this->input->post('tujuan'),
			'cabang_pemesan' => $this->input->post('kota'),
			'tgl_pemesanan' => date('Y-m-d'),
			'tgl_berangkat' => $this->tanggalan($this->input->post('tgl_berangkat')),
			'orang' => $this->input->post('orang'),
			'maskapai' => $this->input->post('maskapai'),
			'jam' => $this->input->post('jam'),
			'kode_booking' => $this->input->post('kodeb'),
			'biaya' => $biaya
		);
		$this->db->insert('tiket', $data);
		$this->session->set_userdata('id_tiket', $no);
		
		$data = array(
			'id_tiket' => $no,
			'nama' => $this->input->post('nama'),
			'pengenal' => $this->input->post('pengenal'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			'catatan' => $this->input->post('catatan')
		);
		$this->db->insert('tiket_penumpang', $data);
		/* isi data urutan */
		//echo "test".$combinecode;
		$this->updateNo($combinecode);

		// isi data transaksi
		$kota = $this->db->where('id_cabang', $this->input->post('kota'))->get('cabang')->row()->nama;
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $this->input->post('kota'),
			'judul' => 'Kode booking '.$this->input->post('kodeb').' dari '.$this->input->post('kota'),
			'keterangan' => 'Tiket dengan nama '.$this->input->post('nama').' dan tanda pengenal '.$this->input->post('pengenal').'
				yang beralamat di '.$this->input->post('alamat').'
				telah memesan tiket dengan nomor booking '.$this->input->post('kodeb').' di cabang '.$this->input->post('kota').' 
				akan diberangkatkan pada tanggal '.$this->tanggalan($this->input->post('tgl_berangkat')).' 
				melalui maskapai '.$this->input->post('maskapai').' pada jam '.$this->input->post('jam').'
				sebesar Rp '.$this->input->post('biaya'),
			'arus' => 'masuk',
			'nilai' => $biaya,
			'status' => 1
		);
		$this->db->insert('transaksi', $data);

		// update data saldo akhir cabang
		$saldo_akhir = $this->db->where('id_cabang',$this->input->post('kota'))->get('cabang')->row()->saldo_akhir;
		$data = array(
			'saldo_akhir' => ($saldo_akhir + $biaya)
		);
		$this->db->where('id_cabang', $this->input->post('kota'));
		$this->db->update('cabang', $data);
	}

	function getTiket($no) {
		$query = "SELECT * from tiket WHERE id_tiket ='".$no."'";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getTiketPenumpang($no) {
		$query = "SELECT * from tiket_penumpang WHERE id_tiket ='".$no."'";
		$query = $this->db->query($query);
		return $query->result();
	}
	function updateNo($nomor) {
		$no = $nomor+1;
	    $data = array('nomor' => $no);
		$this->db->where('jenis', 'tiket');
		$this->db->update('urutan', $data);
	}
	
	function delete($id) {
		$this->db->where('id_kurs', $id);
		$this->db->delete('kurs');
	}
	function deletep($id) {
		$this->db->where('id_tiket', $id);
		$this->db->delete('tiket');
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