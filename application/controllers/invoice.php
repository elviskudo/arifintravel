<?php if (! defined('BASEPATH')) exit('No direct script access');

class Invoice extends CI_Controller {

	var $to;
	function __construct() {
		parent::__construct();
		$this->load->model('invoice_model', 'invoice');
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
		$no = $this->session->userdata('no_invoice');
		$data['no'] = $no;
		$data['no_pesawat'] = $this->invoice->pesawat($no, 'no');
		$data['nama_pesawat'] = $this->invoice->pesawat($no, 'nama');
		$data['tanggal'] = $this->tanggalan($this->invoice->pesawat($no, 'tanggal'));
		$data['waktu'] = $this->tanggalan($this->invoice->pesawat($no, 'tanggal_antar'));
		$data['jam'] = $this->invoice->pesawat($no, 'jam');
		$data['kota'] = $this->invoice->pesawat($no, 'kota');
		foreach($this->invoice->getdetail($no) as $row) {
			$data['nama'] = $row->penumpang;
			$data['alamat'] = $row->alamat;
			$data['telpon'] = $row->telpon;
			$data['email'] = $row->email;
		}
		
		$email = $this->invoice->getemail($no);
		$data['invoice'] = $this->invoice->select($no);
		$data['penumpang'] = $this->invoice->getpenumpang($no);
		$data['jasa'] = $this->invoice->jasa($no);
		$data['biaya'] = 0;
		
		$this->to = $data['email'];
		
		/* email */
		$html = $this->load->view('include/invoice', $data, TRUE);
		
		$this->load->library('email');

		$this->email->from('admin@arifintravel.com', 'Arifin Travel Administrator');
		$this->email->to($this->to.', admin@arifintravel.com');
		
		$this->email->subject('Invoice Pengantaran No. '.$no);
		$this->email->message($html);
		
		$this->email->send();
		
		$this->load->view('invoice', $data);
	}
	function printr() {
		if($this->session->userdata('no_invoice'))
			$no = $this->session->userdata('no_invoice');
		else
			$no = $this->uri->segment(3);
		$data['no'] = $no;
		$data['no_pesawat'] = $this->invoice->pesawat($no, 'no');
		$data['nama_pesawat'] = $this->invoice->pesawat($no, 'nama');
		$data['tanggal'] = $this->tanggalan($this->invoice->pesawat($no, 'tanggal'));
		$data['waktu'] = $this->tanggalan($this->invoice->pesawat($no, 'tanggal_antar'));
		$data['jam'] = $this->invoice->pesawat($no, 'jam');
		$data['kota'] = $this->invoice->pesawat($no, 'kota');
		foreach($this->invoice->getdetail($no) as $row) {
			$data['nama'] = $row->penumpang;
			$data['alamat'] = $row->alamat;
			$data['telpon'] = $row->telpon;
			$data['email'] = $row->email;
		}
		$data['invoice'] = $this->invoice->select($no);
		$data['penumpang'] = $this->invoice->getpenumpang($no);
		$data['jasa'] = $this->invoice->jasa($no);
		$data['biaya'] = 0;
		$this->load->view('include/invoice', $data);
	}

}