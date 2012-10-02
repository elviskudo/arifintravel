<?php if (! defined('BASEPATH')) exit('No direct script access');

class Rental extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->model('rental_model', 'rent');
		$this->load->model('user_model', 'user');
		$this->load->model('kota_model', 'kota');
	}

	function index($offset = '') {
		if($this->session->userdata('level') === '0') {
			$this->session->sess_destroy();
			redirect('admin/main');
		}
		$id = $this->session->userdata('id_persewaan');
		$data['getpersewaan'] = $this->rent->getpersewaan($id);
		$data['user'] = $this->user->getmail($this->session->userdata('email'));
		//$data['pesawat'] = $this->invoice->getpesawat();
		//$data['getuser'] = $this->invoice->getalluser();
		$data['rent'] = $this->rent->all();
		
		if($this->input->post('tanggal_sekian0'))
			$data['tanggal_sekian0'] = $this->input->post('tanggal_sekian0');
		if($this->input->post('tanggal_sekian1'))
			$data['tanggal_sekian1'] = $this->input->post('tanggal_sekian1');
		
		if($this->input->post('kota'))
			$data['kota'] = $this->input->post('kota');
			//if($this->input->post('pesawat'))
		//	$data['manafist'] = $this->invoice->manafist($this->input->post('pesawat'));
		//if($data['getinvoice']) {
		//	foreach($data['getinvoice'] as $r)
		//		$no = $r->no;
		//	$data['penumpang'] = $this->invoice->penumpang($no);
		//}
		
		/* pagination */
		$limit = 5;
		$total = $this->rent->countp();
		
		$config['base_url'] = base_url().'admin/rental/index/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		
		if($this->session->userdata('search') == 'yes') {
			$data['persewaan'] = $this->rent->searchq();
			$data['totalbiaya'] = $this->rent->totalq();
		}	else {
			$data['persewaan'] = $this->rent->pagep($limit, $offset);
			$data['totalbiaya'] = $this->rent->total();
		}
		$data['kota'] = $this->kota->all();
		$data['total'] = $total;
		$data['page_link'] = $this->pagination->create_links();
		
		if(IS_AJAX) {
			$this->load->view('admin/ajax/persewaan', $data);
		} else {
			$this->load->view('admin/persewaan', $data);
		}
	}
	function search() {
		$this->session->set_userdata('search', 'yes');
		$this->session->unset_userdata('update');
		$this->index();
	}
	function update_nama() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$nama = $this->input->post('nama');
		$this->invoice->update_nama($id, $nama);
		echo $nama;
	}
	function update_alamat() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$alamat = $this->input->post('alamat');
		$this->invoice->update_alamat($id, $alamat);
		echo $alamat;
	}
	function update_telpon() {
		$id = explode('_',$this->input->post('id'));
		$id = $id[1];
		$telpon = $this->input->post('telpon');
		$this->invoice->update_telpon($id, $telpon);
		echo $telpon;
	}
	function tanggalan($tanggal) {
		$tanggald = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tanggald.'/'.$bulan.'/'.$tahun;
	}
	public function printr() {
		if($this->session->userdata('id_persewaan'))
			$no = $this->session->userdata('id_persewaan');
		else
			$no = $this->uri->segment(4);
		$data['no'] = $no;
		foreach($this->rent->getPersewaan($no) as $row) {
			$data['tujuan'] = $row->tujuan;
			$data['tgl_mulai'] = $this->tanggalan($row->tgl_mulai);
			$data['tgl_akhir'] = $this->tanggalan($row->tgl_akhir);
			$data['kota'] = $row->cabang_pemesan;
			$data['id_member'] = $row->id_member;
			foreach($this->rent->getMember($row->id_member) as $row2) {
				$data['nama'] = $row2->nama;
				$data['alamat'] = $row2->alamat;
				$data['no_id'] = $row2->no_identitas;
				$data['telp'] = $row2->telp;
			}
			foreach($this->rent->getMobil($row->id_mobil) as $row3) {
				$data['jenis'] = $row3->jenis;
				$data['plat'] = $row3->plat;
				$data['warna'] = $row3->warna;
			}
			$data['tarif'] = $row->tarif;
			$data['jaminan'] = $row->jaminan;
			$data['catatan'] = $row->catatan;
			
		}
		//$data['penukaran2'] = $this->kurs->getPenukaran2($no);
		$this->load->view('include/persewaan', $data);
	}
	
	
	function delete_persewaan() {
		$id = $this->uri->segment(4);
		$this->rent->deletep($id);
		redirect('admin/rental');
	}
	function force_invoice() {
		$id = $this->uri->segment(4);
		$this->invoice->force($id);
		redirect('admin/invoice');
	}

}