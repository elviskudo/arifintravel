<?php if (! defined('BASEPATH')) exit('No direct script access');

class Kurs_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function all() {
		//$this->db->where('status', 1);
		$query = $this->db->get('kurs');
		return $query->result();
	}
	function getmatauang($id) {
		$this->db->select('mata_uang');
		$this->db->where('id_kurs', $id);
		//$this->db->where('status', '1');
		$query = $this->db->get('kurs');
		$row = $query->row();
		return $row->mata_uang;
	}
	function getjual($id) {
		$this->db->select('jual');
		$this->db->where('id_kurs', $id);
		//$this->db->where('status', '1');
		$query = $this->db->get('kurs');
		$row = $query->row();
		return $row->jual;
	}
	function getbeli($id) {
		$this->db->select('beli');
		$this->db->where('id_kurs', $id);
		//$this->db->where('status', '1');
		$query = $this->db->get('kurs');
		$row = $query->row();
		return $row->beli;
	}
	function getNoTukar() {
		$query = "SELECT nomor from urutan WHERE jenis ='penukaran'";
		$query = $this->db->query($query);
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
			SELECT * FROM penukaran 
			WHERE id_penukaran <> 'MC'  
		";
		if($this->input->post('no')) {
			$sql .= " AND id_penukaran LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND tanggal_penukaran >= '".$tanggal1."' AND tanggal_penukaran <= '".$tanggal2."'";
			else
				$sql .= " AND tanggal_penukaran >= '".$tanggal1."' AND tanggal_penukaran <= '".$tanggal1."'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND cabang_pemesan LIKE '%".$this->input->post('kota')."%'";
		}
		if($this->input->post('jenis') != 'semua') {
			$sql .= " AND jenis = '".$this->input->post('jenis')."'";
		}
		
		//if($this->input->post('mata_uang') != 'semua') {
			$sql .= " order by tanggal_penukaran ASC";
	//echo $sql;
		$query = $this->db->query($sql);
		return $query->result();
	}
	function totalq() {
		$sql = "
			SELECT SUM(total) as totalbiaya FROM penukaran 
			WHERE id_penukaran <> 'MC'  
		";
		if($this->input->post('no')) {
			$sql .= " AND id_penukaran LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND tanggal_penukaran >= '".$tanggal1."' AND tanggal_penukaran <= '".$tanggal2."'";
			else
				$sql .= " AND tanggal_penukaran >= '".$tanggal1."' AND tanggal_penukaran <= '".$tanggal1."'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND cabang_pemesan LIKE '%".$this->input->post('kota')."%'";
		}
		if($this->input->post('jenis') != 'semua') {
			$sql .= " AND jenis = '".$this->input->post('jenis')."'";
		}
		//if($this->input->post('mata_uang') != 'semua') {
			$sql .= " ORDER BY tanggal_penukaran ASC";
		
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
	
	function pagep($limit, $offset) {
		if($offset == '') $offset = 0;
		$sql = "
			SELECT * FROM penukaran 
			WHERE tanggal_penukaran >= '".date("Y-m-d")."' AND tanggal_penukaran <= '".date("Y-m-d")."'
			ORDER BY tanggal_penukaran ASC";  
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function total() {
		//if($offset == '') $offset = 0;
		$sql = "
			SELECT SUM(total) as totalbiaya FROM penukaran 
			WHERE tanggal_penukaran >= '".date("Y-m-d")."' AND tanggal_penukaran <= '".date("Y-m-d")."'
			ORDER BY tanggal_penukaran ASC";  
		
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
	/* process CRUD */
	function insert_kurs() {
		$data = array(
			'mata_uang' => $this->input->post('mata_uang'),
			'jual' => $this->input->post('jual'),
			'beli' => $this->input->post('beli'),
			'bendera' => $this->input->post('bendera')
		);
		$this->db->insert('kurs', $data);
	}
	function update_kurs($id) {
		$data = array(
			'mata_uang' => $this->input->post('mata_uang'),
			'jual' => $this->input->post('jual'),
			'beli' => $this->input->post('beli'),
			'bendera' => $this->input->post('bendera')
		);
		$this->db->where('id_kurs', $id);
		$this->db->update('kurs', $data);
	}
	function insert() {
		/* bikin invoice antar */
		foreach($this->getNoInvoice() as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'MC-'.date('my').'-0'.$combinecode;
		
		$mata_uang = $this->kurs->getmatauang($this->input->post('matauang'));
		//echo "jns = ".$this->input->post('jenis');
		$jumlah = $this->input->post('jumlah');
			if($this->input->post('jenis')=="JUAL") {
				$kurs = $this->kurs->getjual($this->input->post('matauang'));
			} else {
				$kurs = $this->kurs->getbeli($this->input->post('matauang'));
			}
		//echo "kurs = ". $kurs;
                //echo "jumlah = ". $jumlah;
		$biaya2 = $jumlah * $kurs;
		//echo "biaya = ". $biaya;
		//$biaya2 = str_replace('.','',$biaya);
		//echo "biaya2 = ". $biaya2;
		
		
		/* isi data penukaran */
		$data = array(
			'id_penukaran' => $no,
			'tanggal_penukaran' => date('Y-m-d'),
			'jumlah_penukaran' => $this->input->post('jml'),
			'jenis' => $this->input->post('jenis'),
			'total' => $biaya2,
			'pemesan' => $this->input->post('pemesan'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp')
		);
		$this->db->insert('penukaran', $data);
		
		$data = array(
			'id_penukaran' => $no,
			'mata_uang' => $mata_uang,
			'kurs' => $kurs,
			'jumlah' => $jumlah,
			'biaya' => $biaya2,
		);	
		$this->db->insert('penukaran_matauang', $data);
			
		$this->session->set_userdata('id_penukaran', $no);
		/* isi data urutan */
		//echo "test".$combinecode;
		$this->updateNo($combinecode);

		// isi data transaksi
		$kota = $this->db->where('id_cabang', $this->input->post('kota'))->get('cabang')->nama;
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $this->input->post('kota'),
			'judul' => 'ID Tukar: '.$no.' untuk mata uang '.$mata_uang.' dalam kurs '.$kurs,
			'keterangan' => 'ID Tukar: '.$no.' untuk mata uang '.$mata_uang.'
				dalam kurs '.$kurs.'
				dari saudara/saudari '.$this->input->post('pemesan').'
				yang beralamat di '.$this->input->post('alamat').' no telpon '.$this->input->post('telp').'
				jumlah '.$jumlah.' 
				sebesar Rp '.$biaya2,
			'arus' => 'masuk',
			'nilai' => $biaya2,
			'status' => 1
		);
		$this->db->insert('transaksi', $data);

		// update data saldo akhir cabang
		$saldo_akhir = $this->db->where('id_cabang',$this->input->post('kota'))->get('cabang')->row()->saldo_akhir;
		$data = array(
			'saldo_akhir' => ($saldo_akhir + $biaya2)
		);
		$this->db->where('id_cabang', $this->input->post('kota'));
		$this->db->update('cabang', $data);
	}
	
	function insert_all() {
		foreach($this->getNoInvoice() as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'MC-'.date('my').'-0'.$combinecode;
		$total = 0;
		for($i = 1; $i <= $this->input->post('jml'); $i++) {
			$mata_uang[$i] = $this->kurs->getmatauang($this->input->post('matauang'.$i));
			$jumlah[$i] = $this->input->post('jumlah'.$i);
			$jenis = $this->input->post('jenis'); 
			if($jenis =="jual") {
				$kurs[$i] = $this->kurs->getjual($this->input->post('matauang'.$i));
			} else {
				$kurs[$i] = $this->kurs->getbeli($this->input->post('matauang'.$i));
			}
			$biaya[$i] = $jumlah[$i] * $kurs[$i];
			$total = $total + $biaya[$i];
		}
	
		/* isi data penukaran */
		$data = array(
			'id_penukaran' => $no,
			'tanggal_penukaran' => date('Y-m-d'),
			'cabang_pemesan' => $this->input->post('kota'),
			'jumlah_penukaran' => $this->input->post('jml'),
			'jenis' => $this->input->post('jenis'),
			'total' => $total,
			'pemesan' => $this->input->post('pemesan'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp')
		);
		$this->db->insert('penukaran', $data);
		
		for($i = 1; $i <= $this->input->post('jml'); $i++) {
			$data = array(
				'id_penukaran' => $no,
				'mata_uang' => $mata_uang[$i],
				'kurs' => $kurs[$i],
				'jumlah' => $jumlah[$i],
				'biaya' => $biaya[$i],
			);
			$this->db->insert('penukaran_matauang', $data);
		}
		$this->session->set_userdata('id_penukaran', $no);
		/* isi data urutan */
		//echo "test".$combinecode;
		$this->updateNo($combinecode);

		// isi data transaksi
		$kota = $this->db->where('id_cabang', $this->input->post('kota'))->get('cabang')->nama;
		$data = array(
			'tanggal' => time(),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'id_cabang' => $this->input->post('kota'),
			'judul' => 'ID Tukar: '.$no.' untuk mata uang '.$mata_uang.' dalam kurs '.$kurs,
			'keterangan' => 'ID Tukar: '.$no.' untuk mata uang '.$mata_uang.'
				dalam kurs '.$kurs.'
				dari saudara/saudari '.$this->input->post('pemesan').'
				yang beralamat di '.$this->input->post('alamat').' no telpon '.$this->input->post('telp').'
				jumlah '.$jumlah.' 
				sebesar Rp '.$total,
			'arus' => 'masuk',
			'nilai' => $total,
			'status' => 1
		);
		$this->db->insert('transaksi', $data);

		// update data saldo akhir cabang
		$saldo_akhir = $this->db->where('id_cabang',$this->input->post('kota'))->get('cabang')->row()->saldo_akhir;
		$data = array(
			'saldo_akhir' => ($saldo_akhir + $total)
		);
		$this->db->where('id_cabang', $this->input->post('kota'));
		$this->db->update('cabang', $data);
	}
	function getNoInvoice() {
		$query = "SELECT nomor from urutan WHERE jenis ='penukaran'";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getPenukaran($no) {
		$query = "SELECT * from penukaran WHERE id_penukaran ='".$no."'";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getPenukaran2($no) {
		$query = "SELECT * from penukaran_matauang WHERE id_penukaran ='".$no."'";
		$query = $this->db->query($query);
		return $query->result();
	}
	function updateNo($nomor) {
		$no = $nomor+1;
	    $data = array('nomor' => $no);
		$this->db->where('jenis', 'penukaran');
		$this->db->update('urutan', $data);
	}
	
	function delete($id) {
		$this->db->where('id_kurs', $id);
		$this->db->delete('kurs');
	}
	function deletep($id) {
		$this->db->where('id_penukaran', $id);
		$this->db->delete('penukaran');
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