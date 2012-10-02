<?php
class Mobil extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}
	
	function index() {
		$data['hidden'] = array('user_id' => "", 'user_id' => "", 'user_comp' => "", 'user_dept' => "");
		$data['filterList'] = array(''=>'None','jenis' => "Jenis", 'Warna' => "Nama", 'plat' => "Plat Nomor", 'tarif' => "Tarif");
		$data['keyword'] = array('name' => 'keyword', 'id' => 'keyword');
		
		$this->load->view('popup/mobil', $data);
	}
	
	function index2() {
		$this->load->database();
		if ($this->input->post('filter') != '') {
			$addWhere = " and ".$this->input->post('filter')." LIKE '%".$this->input->post('keyword')."%' ";
		} else {
			$addWhere = "";
		}
		$strquery = "SELECT * from mobil where id_mobil <> ''".$addWhere;
		$query = $this->db->query($strquery);
		$total = $query->num_rows();
		$data['total'] = $total;
		$data['results'] = $query;
		
		$this->load->view('popup/mobil2', $data);	
		
	}
}
?>