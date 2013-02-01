<?php if (! defined('BASEPATH')) exit('No direct script access');

class Invoice_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->model('kota_model', 'kota');
		$this->load->model('jam_model', 'jam');
		$this->load->model('pesawat_model', 'pesawat');
	}	
	function all() {
		$query = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, c.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				a.tanggal_antar as tanggal_antar, a.jam as jam, a.biaya as biaya, a.jasa as jasa, c.alamat as alamat
			FROM invoice a, pesawat b, penumpang c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.no = c.no 
			ORDER BY tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function get($no) {
		$this->db->where('no', $no);
		$query = $this->db->get('invoice');
		return $query->result();
	}
	function getpesawat() {
		$this->db->where('status', '1');
		$this->db->order_by('nama');
		$query = $this->db->get('pesawat');
		return $query->result();
	}
	function getalluser() {
		$this->db->where('status', '1');
		$this->db->order_by('nama');
		$query = $this->db->get('user');
		return $query->result();
	}
	function orang($no) {
		$this->db->where('no', $no);
		$query = $this->db->get('invoice');
		return $query->num_rows();
	}
	function getstatus() {
		$query = "
			SELECT a.no as no, a.tanggal as tanggal, a.tanggal_antar as tanggal_antar, 
				b.nama as nama, a.tujuan as tujuan, a.id_invoice as id_invoice, a.status as status
			FROM invoice a, penumpang b
			WHERE a.no=b.no
			ORDER BY a.tanggal DESC
			LIMIT 10
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function penumpang($no) {
		$this->db->where('no', $no);
		$query = $this->db->get('penumpang');
		return $query->result();
	}
	function update_nama($id, $nama) {
		$data = array('nama' => $nama);
		$this->db->where('id_penumpang', $id);
		$this->db->update('penumpang', $data);
	}
	function update_alamat($id, $alamat) {
		$data = array('alamat' => $alamat);
		$this->db->where('id_penumpang', $id);
		$this->db->update('penumpang', $data);
	}
	function update_telpon($id, $telpon) {
		$data = array('telpon' => $telpon);
		$this->db->where('id_penumpang', $id);
		$this->db->update('penumpang', $data);
	}
	function manafist($id_pesawat) {
		if ($id_pesawat != 'semua') {
			$this->db->where('id_pesawat', $id_pesawat);
			$query = $this->db->get('pesawat');
			$row = $query->row();
			return $row->no.' Pesawat: '.$row->nama.' Jam: '.$row->jam;
		} else {
			return " Semua";
		}
	}
	function search($text) {
		$query = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, c.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				a.tanggal_antar as tanggal_antar, a.jam as jam, a.biaya as biaya, a.jasa as jasa, c.alamat as alamat
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
				AND a.no LIKE '%".$text."%' 
				OR a.tanggal_antar LIKE '%".$text."%' 
				OR a.tujuan LIKE '%".$text."%' 
				OR a.jam LIKE '%".$text."%' 
				OR c.nama LIKE '%".$text."%' 
				OR b.nama LIKE '%".$text."%' 
			ORDER BY tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function searchq() {
		$sql = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, c.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				a.tanggal_antar as tanggal_antar, a.jam as jam, (a.biaya * a.orang) as biaya,
				a.jasa as jasa, c.alamat as alamat
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
		";
		if($this->input->post('no')) {
			$sql .= " AND a.no LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND a.tanggal >= '".$tanggal1." 00:00:00' AND a.tanggal <= '".$tanggal2." 23:59:59'";
			else
				$sql .= " AND a.tanggal >= '".$tanggal1." 00:00:00' AND a.tanggal <= '".$tanggal1." 23:59:59'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND a.tujuan LIKE '%".$this->input->post('kota')."%'";
		}
		//$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		if($this->input->post('pesawat') != 'semua') {
			$sql .= " AND b.id_pesawat = '".$this->input->post('pesawat')."'";
		}
		$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		if($this->input->post('kota') != 'semua') {
			$sql .= "order by a.tanggal DESC";
		} else {
			$sql .= "order by a.tujuan ASC";
		}	
		$query = $this->db->query($sql);
		return $query->result();
	}
	function searchp() {
		$sql = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, p.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				b.no as no_pesawat, a.jam as jam, a.biaya as biaya,
				a.jasa as jasa, p.alamat as alamat, b.jam as jam_pesawat
			FROM invoice a, pesawat b, user c, penumpang p
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user AND a.no = p.no
		";
	        if($this->input->post('no')) {
			$sql .= " AND a.no LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0')) {
			//if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
			$sql .= " AND a.tanggal_antar = '".$tanggal1."'";
		//if($this->input->post('tanggal_sekian1') != '__/__/____')
		//	$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		} else {
			$tanggal1 = $this->tanggalan(date("d/m/Y"));
			$sql .= " AND a.tanggal_antar = '".$tanggal1."'";
			//echo $sql;
		}	
			//if($this->input->post('tanggal_sekian0') != '__/__/____') {
			//if($this->input->post('tanggal_sekian1') != '__/__/____')
			//	$sql .= " AND a.tanggal_antar = '".$tanggal1."'";
			//else
			//	$sql .= " AND a.tanggal >= '".$tanggal1." 00:00:00' AND a.tanggal <= '".$tanggal1." 23:59:59'";
			//}
		
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND a.tujuan LIKE '%".$this->input->post('kota')."%'";
		}
		//$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		if($this->input->post('pesawat') != 'semua') {
			$sql .= " AND b.id_pesawat = '".$this->input->post('pesawat')."'";
		}
		$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		if($this->input->post('kota') != 'semua') {
			$sql .= "order by a.tanggal DESC";
		} else {
			$sql .= "order by a.tujuan ASC";
		}	
		$query = $this->db->query($sql);
		//echo "$sql";
		return $query->result();
	}
	
	function totalp() {
		$sql = "
			SELECT SUM(a.biaya) as totalbiaya
			FROM invoice a, pesawat b, user c, penumpang p
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user AND a.no = p.no
		";
		if($this->input->post('no')) {
			$sql .= " AND a.no LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0')) {
			//if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
			$sql .= " AND a.tanggal_antar = '".$tanggal1."'";
		//if($this->input->post('tanggal_sekian1') != '__/__/____')
		//	$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		} else {
			$tanggal1 = $this->tanggalan(date("d/m/Y"));
			$sql .= " AND a.tanggal_antar = '".$tanggal1."'";
			//echo $sql;
		}	
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND a.tujuan LIKE '%".$this->input->post('kota')."%'";
		}
		if($this->input->post('pesawat') != 'semua') {
			$sql .= " AND b.id_pesawat = '".$this->input->post('pesawat')."'";
		}		$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
        function totalpagep() {
		$query = "
			SELECT distinct SUM(a.biaya) as totalbiaya
			FROM invoice a, pesawat b, user c, penumpang p 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user AND a.no = p.no
				AND a.tanggal_antar >= '".date("Y-m-d")." 00:00:00' AND a.tanggal_antar <= '".date("Y-m-d")." 23:59:59'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->totalbiaya;
	}
	
	function totalq() {
		$sql = "
			SELECT SUM(a.biaya * a.orang) as totalbiaya
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
		";
		if($this->input->post('no')) {
			$sql .= " AND a.no LIKE '%".$this->input->post('no')."%'";
		}
		if($this->input->post('tanggal_sekian0') != '__/__/____')
			$tanggal1 = $this->tanggalan($this->input->post('tanggal_sekian0'));
		if($this->input->post('tanggal_sekian1') != '__/__/____')
			$tanggal2 = $this->tanggalan($this->input->post('tanggal_sekian1'));
		if($this->input->post('tanggal_sekian0') != '__/__/____') {
			if($this->input->post('tanggal_sekian1') != '__/__/____')
				$sql .= " AND a.tanggal >= '".$tanggal1." 00:00:00' AND a.tanggal <= '".$tanggal2." 23:59:59'";
			else
				$sql .= " AND a.tanggal >= '".$tanggal1." 00:00:00' AND a.tanggal <= '".$tanggal1." 23:59:59'";
		}
		if($this->input->post('kota') != 'semua') {
			$sql .= " AND a.tujuan LIKE '%".$this->input->post('kota')."%'";
		}
		if($this->input->post('pesawat') != 'semua') {
			$sql .= " AND b.id_pesawat = '".$this->input->post('pesawat')."'";
		}		$sql .= " AND a.status='".$this->input->post('approve_submit')."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->totalbiaya;
	}
	function pesawat($no_invoice, $search) {
		$query = "
			SELECT b.no as no, b.nama as nama,
				a.tanggal_antar as tanggal_antar, a.tujuan as kota,
				a.tanggal as tanggal, a.jam as jam 
			FROM invoice a, pesawat b 
			WHERE a.id_pesawat=b.id_pesawat
				AND a.no='".$no_invoice."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->$search;
	}
	function getemail($no) {
		$query = "
			SELECT a.email as email 
			FROM invoice a, penumpang b, pesawat c 
			WHERE a.no=b.no 
				AND a.id_pesawat=c.id_pesawat 
				AND a.no='".$no."'
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function getsipemesan($no) {
		$this->db->where('no', $no);
		$query = $this->db->get('invoice');
		$row = $query->row();
		return $row->email;
	}
	function getdetail($no) {
		$query = "
			SELECT a.no as no, a.email as email, b.nama as penumpang,
				b.alamat as alamat, a.tujuan as tujuan, b.telpon as telpon
			FROM invoice a, penumpang b 
			WHERE a.no=b.no AND
				a.no='".$no."' AND 
				b.status=1
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function select($no) {
		$query = "
			SELECT a.no as no, c.no as no_pesawat, c.nama as nama_pesawat, b.alamat as alamat,
				b.nama as penumpang, a.tujuan as tujuan, a.email as email, 
				b.telpon as telpon, a.tanggal_antar as tanggal_antar, a.jam as jam,
				a.biaya as biaya, a.jasa as jasa, a.catatan as catatan 
			FROM invoice a, penumpang b, pesawat c 
			WHERE a.no=b.no 
				AND a.id_pesawat=c.id_pesawat 
				AND a.no='".$no."'
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function jasa($no) {
		$query = "
			SELECT jasa
			FROM invoice 
			WHERE no='".$no."'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->jasa;
	}
	function getpenumpang($no) {
		$query = "
			SELECT a.no as no, b.nama as penumpang, b.alamat as alamat, 
				b.telpon as telpon, b.catatan as catatan, a.biaya as biaya
			FROM invoice a, penumpang b
			WHERE a.no = b.no
				AND a.no = '".$no."'
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function histori($email) {
		$query = "
			SELECT a.no as no, a.tanggal as tanggal, a.tujuan as tujuan, 
				a.tanggal_antar as tanggal_antar, a.jam as jam, a.orang as orang
			FROM invoice a, user b
			WHERE a.id_user = b.id_user	
				AND b.email = '".$email."'
			ORDER BY a.tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function log($isi, $id_penumpang) {
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'event' => $isi.' penumpang&id: '.$id_penumpang,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT']
		);
		$this->db->insert('log', $data);
	}
	function tanggalan($tanggal) {
		/* konversi tanggal 31/01/2011 jadi 2011-01-31 */
		$tahun = substr($tanggal,6,4);
		$bulan = substr($tanggal,3,2);
		$tanggal = substr($tanggal,0,2);
		$tanggal_antar = $tahun.'-'.$bulan.'-'.$tanggal;
		return $tanggal_antar;
	}
	function insert() {
		/* bikin invoice antar */
		$waktu = $this->input->post('waktu').date('H:i:s');
		//$combinecode = md5(substr(md5($this->session->userdata('email')),0,8).$this->input->post('tujuan').$waktu);
		foreach($this->getNoInvoice("pengantaran") as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'PN-'.date('my').'-0'.$combinecode;
		$this->session->set_userdata('no_invoice', $no);
		$biaya = str_replace('.','',$this->input->post('biaya'));
		
		$status = 0;
		if($this->input->post('cekok')) {
			if($this->input->post('cekok') == '1')
				$status = 1;
			else
				$status = 0;
		}
		
		/* isi log */
		$this->log('insert', $no);
		
		/* isi data penumpang */
		$data = array(
			'no' => $no,
			'nama' => $this->input->post('penumpang'),
			'alamat' => $this->input->post('alamat'),
			'telpon' => $this->input->post('telpon'),
			'catatan' => $this->input->post('catatan'),
			'status' => 1
		);
		$this->db->insert('penumpang', $data);
		
		/* isi data invoice */
		$data = array(
			'no' => $no,
			'tanggal' => date('Y-m-d H:i:s'),
			'id_pesawat' => $this->input->post('pesawat'),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'email' => $this->input->post('emailp'),
			'tujuan' => $this->input->post('kota'),
			'orang' => $this->input->post('orang'),
			'tanggal_antar' => $this->tanggalan($this->input->post('waktu')),
			'jam' => $this->input->post('jam'),
			'biaya' => $biaya,
			'jasa' => $this->input->post('jasaok'),
			'catatan' => $this->input->post('catatan'),
			'status' => $status
		);
		$this->db->insert('invoice', $data);
		
		/* isi data urutan */
		//echo "test".$combinecode;
		$this->updateNo($combinecode, "pengantaran");
	}
	function insertall() {
		/* bikin invoice antar */
		$waktu = $this->input->post('waktu').date('H:i:s');
		//$combinecode = md5(substr(md5($this->session->userdata('email')),0,8).$this->input->post('tujuan').$waktu);
		//$no = 'PN-'.strtoupper(substr($combinecode,0,8));
		foreach($this->getNoInvoice("pengantaran") as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'PJ-'.date('my').'-0'.$combinecode;
		$this->session->set_userdata('no_invoice', $no);
		$biaya = str_replace('.','',$this->input->post('biaya'));
		
		/* isi log */
		$this->log('insert', $no);
		
		/* isi data invoice */
		$data = array(
			'no' => $no,
			'tanggal' => date('Y-m-d H:i:s'),
			'id_pesawat' => $this->input->post('pesawat'),
			'id_user' => substr(md5($this->session->userdata('email')),0,8),
			'email' => $this->input->post('emailp1'),
			'tujuan' => $this->input->post('kota'),
			'orang' => $this->input->post('orang'),
			'tanggal_antar' => $this->tanggalan($this->input->post('waktu')),
			'jam' => $this->input->post('jam'),
			'biaya' => $biaya,
			'jasa' => $this->input->post('jasaok'),
			'status' => 0
		);
		$this->db->insert('invoice', $data);
			
		for($i = 1; $i <= $this->input->post('orang'); $i++) {
			/* isi data penumpang */
			if($i == 1)
				$status = 1;
			else
				$status = 0;
			$data = array(
				'no' => $no,
				'nama' => $this->input->post('penumpang'.$i),
				'alamat' => $this->input->post('alamat'.$i),
				'telpon' => $this->input->post('telpon'.$i),
				'catatan' => $this->input->post('catatan'.$i),
				'status' => $status
			);
			$this->db->insert('penumpang', $data);
		}
		
		/* isi data urutan */
		$this->updateNo($combinecode, "pengantaran");
	}
	function getp($id) {
		$query = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, c.nama as user, 
				a.tujuan as kota, a.id_pesawat as id_pesawat, a.id_user as id_user,
				a.orang as orang, a.id_invoice as id_invoice, c.ktp as ktp,
				c.telpon as telpon, a.catatan as catatan, a.status as status, c.alamat as alamat,
				a.tanggal_antar as tanggal_antar, a.jam as jam, a.biaya as biaya, a.jasa as jasa
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
				AND a.id_invoice = '".$id."'
		";
		$query = $this->db->query($query);
		return $query->result();
	}
	function page($limit, $offset) {
		if($offset == '') $offset = 0;
		$query = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, c.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				a.tanggal_antar as tanggal_antar, a.jam as jam, (a.biaya * a.orang) as biaya, a.jasa as jasa, c.alamat as alamat
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
				AND a.tanggal >= '".date("Y-m-d")." 00:00:00' AND a.tanggal <= '".date("Y-m-d")." 23:59:59'
			ORDER BY tanggal DESC";
			//LIMIT ".$offset.", ".$limit."
		//";
		$query = $this->db->query($query);
		return $query->result();
	}
        function pagep($limit, $offset) {
		if($offset == '') $offset = 0;
		$query = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, p.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				b.no as no_pesawat, a.jam as jam, a.biaya as biaya,
				a.jasa as jasa, p.alamat as alamat, b.jam as jam_pesawat
			FROM invoice a, pesawat b, user c, penumpang p
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user AND a.no = p.no
				AND a.tanggal_antar >= '".date("Y-m-d")." 00:00:00' AND a.tanggal_antar <= '".date("Y-m-d")." 23:59:59'
			ORDER BY tanggal DESC";
			//LIMIT ".$offset.", ".$limit."
		//";
		$query = $this->db->query($query);
		return $query->result();
	}
	function total() {
		$query = "
			SELECT SUM(a.biaya * a.orang) as totalbiaya
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
				AND a.tanggal >= '".date("Y-m-d")." 00:00:00' AND a.tanggal <= '".date("Y-m-d")." 23:59:59'
		";
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->totalbiaya;
	}
	function count() {
		$query = "
			SELECT a.tanggal as tanggal, a.no as no, b.nama as pesawat, c.nama as user, a.status as status,
				a.tujuan as kota, a.orang as orang, a.id_invoice, c.telpon as telpon, a.catatan as catatan,
				a.tanggal_antar as tanggal_antar, a.jam as jam, a.biaya as biaya, a.jasa as jasa, c.alamat as alamat
			FROM invoice a, pesawat b, user c 
			WHERE a.id_pesawat = b.id_pesawat
				AND a.id_user = c.id_user 
			ORDER BY tanggal DESC
		";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	function getNoInvoice($id) {
		$query = "SELECT nomor from urutan WHERE jenis ='".$id."'";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	/* process CRUD */
	function updateNo($nomor, $jenis) {
		$no = $nomor+1;
	    $data = array('nomor' => $no);
		$this->db->where('jenis', $jenis);
		$this->db->update('urutan', $data);
	}
	function update($id) {
		if(substr($this->input->post('tanggal_antar'),4,1) == '-') {
			$tanggalan = $this->input->post('tanggal_antar');
		} else {
			$tanggalan = $this->tanggalan($this->input->post('tanggal_antar'));
		}
		$data = array(
			'tujuan' => $this->input->post('kota'),
			'tanggal_antar' => $tanggalan,
			'jam' => $this->input->post('jam'),
			'biaya' => $this->input->post('biaya'),
			'jasa' => $this->input->post('jasaok'),
			'catatan' => $this->input->post('catatan'),
			'status' => $this->input->post('cekok')
		);
		$this->db->where('id_invoice', $id);
		$this->db->update('invoice', $data);
	}
	function update1($id) {
		$data = array('status' => 1);
		$this->db->where('id_invoice', $id);
		$this->db->update('invoice', $data);
	}
	function update0($id) {
		$data = array('status' => 0);
		$this->db->where('id_invoice', $id);
		$this->db->update('invoice', $data);
	}
	function delete($id) {
		$data = array(
			'status' => 0
		);
		$this->db->where('id_invoice', $id);
		$this->db->update('invoice', $data);
	}
	function force($no) {
		/* isi log */
		$this->log('delete histori', $no);
		
		$this->db->where('no', $no);
		$this->db->delete('penumpang');
		$this->db->where('no', $no);
		$this->db->delete('invoice');
	}

}