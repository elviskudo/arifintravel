<?php if (! defined('BASEPATH')) exit('No direct script access');

class Invoicej extends CI_Controller {

	var $to;
	function __construct() {
		parent::__construct();
		$this->load->model('invoicej_model', 'invoicej');
		$this->load->model('pesawat_model', 'pesawat');
		$this->to = '';
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	function index() {
		if(!$this->session->userdata('email')) {
			redirect('main');
		}
		if(!$this->session->userdata('email'))
			redirect('main');
		$no = $this->session->userdata('no_invoicej');
		$data['no'] = $no;
		$data['pesawat'] = $this->invoicej->pesawat($no, 'nama_pesawat');
		$data['tanggal'] = $this->tanggalan($this->invoicej->pesawat($no, 'tanggal'));
		$data['waktu'] = $this->tanggalan($this->invoicej->pesawat($no, 'tanggal_jemput'));
		$data['jam'] = $this->invoicej->pesawat($no, 'jam');
		$data['kota'] = $this->invoicej->pesawat($no, 'kota');
		foreach($this->invoicej->getdetail($no) as $row) {
			$data['nama'] = $row->penumpang;
			$data['alamat'] = $row->alamat;
			$data['telpon'] = $row->telpon;
			$data['email'] = $row->email;
		}
		$email = $this->invoicej->getemail($no);
		$data['invoicej'] = $this->invoicej->select($no);
		$data['penumpang'] = $this->invoicej->getpenumpang($no);
		$data['jasa'] = $this->invoicej->jasa($no);
		$data['biaya'] = 0;
		
		$this->to = $data['email'];
	
		/* email */
		$html = $this->load->view('include/invoicej', $data, TRUE);
		
		$this->load->library('email');

		$this->email->from('admin@arifintravel.com', 'Arifin Travel Administrator');
		$this->email->to($this->to.', admin@arifintravel.com');
		
		$this->email->subject('invoice Penjemputan No. '.$no);
		$this->email->message($html);
		
		$this->email->send();
		
		$this->load->view('invoicej', $data);
	}
	function printr() {
		if($this->session->userdata('no_invoicej'))
			$no = $this->session->userdata('no_invoicej');
		else
			$no = $this->uri->segment(3);
		$data['no'] = $no;
		$data['pesawat'] = $this->invoicej->pesawat($no, 'nama_pesawat');
		$data['tanggal'] = $this->tanggalan($this->invoicej->pesawat($no, 'tanggal'));
		$data['waktu'] = $this->tanggalan($this->invoicej->pesawat($no, 'tanggal_jemput'));
		$data['jam'] = $this->invoicej->pesawat($no, 'jam');
		$data['kota'] = $this->invoicej->pesawat($no, 'kota');
		foreach($this->invoicej->getdetail($no) as $row) {
			$data['nama'] = $row->penumpang;
			$data['alamat'] = $row->alamat;
			$data['telpon'] = $row->telpon;
			$data['email'] = $row->email;
		}
		$email = $this->invoicej->getemail($no);
		$data['invoicej'] = $this->invoicej->select($no);
		$data['penumpang'] = $this->invoicej->getpenumpang($no);
		$data['jasa'] = $this->invoicej->jasa($no);
		$data['biaya'] = 0;
		$this->load->view('include/invoicej', $data);
	}

}