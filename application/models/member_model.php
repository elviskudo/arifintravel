<?php if (! defined('BASEPATH')) exit('No direct script access');

class Member_model extends CI_Model {

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
	
	/* process CRUD */

	function insert() {
		/* bikin invoice antar */
		foreach($this->getNoInvoice() as $row) {
			$combinecode = $row->nomor;
		}
		$no = 'M-0'.$combinecode;
				
		/* isi data penukaran */
		$data = array(
			'id_member' => $no,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_identitas' => $this->input->post('no_id'),
			'telp' => $this->input->post('telp')
		);
		$this->db->insert('member', $data);
		$this->session->set_userdata('id_member', $no);
		
		/* isi data urutan */
		//echo "test".$combinecode;
		$this->updateNo($combinecode);
	}
	
	function getNoInvoice() {
		$query = "SELECT nomor from urutan WHERE jenis ='member'";
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
		$this->db->where('jenis', 'member');
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