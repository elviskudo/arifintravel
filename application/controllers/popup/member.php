<?php
class Member extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->load->model('member_model', 'member');
		$this->load->model('user_model', 'user');
	}
	
	function index() {
		$data['hidden'] = array('user_id' => "", 'user_id' => "", 'user_comp' => "", 'user_dept' => "");
		$data['filterList'] = array(''=>'None','id_member' => "ID Member", 'nama' => "Nama", 'alamat' => "alamat", 'no_id' => "identitas");
		$data['keyword'] = array('name' => 'keyword', 'id' => 'keyword');
		
		$this->load->view('popup/member', $data);
	}
	
	function index2() {
		$this->load->database();
		if ($this->input->post('filter') != '') {
			$addWhere = " and ".$this->input->post('filter')." LIKE '%".$this->input->post('keyword')."%' ";
		} else {
			$addWhere = "";
		}
		$strquery = "SELECT * from member where id_member <> ''".$addWhere;
		$query = $this->db->query($strquery);
		$total = $query->num_rows();
		$data['total'] = $total;
		$data['results'] = $query;
		
		$this->load->view('popup/member2', $data);	
		
	}
	function tambah() {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$this->load->view('popup/tambah_member');
	}
	function tambah2() {
		$this->member->insert();
		$id = $this->session->userdata('id_member');
		//echo "id=".$id;
		//$data['results'] = $this->member->getMember($id);
		foreach($this->member->getMember($id) as $row3) {
				$data['id_member'] = $row3->id_member;
				$data['nama'] = $row3->nama;
				$data['alamat'] = $row3->alamat;
				$data['no_id'] = $row3->no_identitas;
				$data['telp'] = $row3->telp;
			}
		
		$this->load->view('popup/tambah_member2', $data);	
		
	}
}
?>