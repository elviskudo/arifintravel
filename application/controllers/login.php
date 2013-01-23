<?php if (! defined('BASEPATH')) exit('No direct script access');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->model('kota_model', 'kota');
		$this->load->model('jam_model', 'jam');
		$this->load->model('pesawat_model', 'pesawat');
		$this->load->model('invoice_model', 'invoice');
	}

	function index() {
		if($this->input->post('login_type') == 'antar') {
			$this->session->set_userdata('login_type', 'antar');
		} else {
			$this->session->set_userdata('login_type', 'jemput');
		}
		if($this->session->userdata('login_type') == 'jemput') {
			if($this->input->post('jam')) {
				$this->session->set_userdata('jam', $this->input->post('jam'));
				$id_jam = $this->input->post('jam');
			} elseif($this->session->userdata('jam')) {
				$id_jam = $this->session->userdata('jam');
				foreach($this->session->userdata('jam') as $jm)
					$id_jam = $jm;
			}
			$this->session->set_userdata('login_type', 'jemput');
		} else {
			if($this->session->userdata('jam')) {
				$this->session->set_userdata('jam', $this->input->post('jam'));
				foreach($this->session->userdata('jam') as $jm)
					$id_jam = $jm;
			} elseif($this->input->post('jam')) {
			    foreach($this->input->post('jam') as $jm)
					$id_jam = $jm;
				$this->session->set_userdata('jam', $id_jam);
			}
			
		}
		$data['jam'] = $this->jam->getjam($id_jam);
		$pesawat = $this->pesawat->getq($id_jam);
		$id_pesawat = explode('. ', $pesawat);
		$data['id_pesawat'] = $id_pesawat[0];
		$data['pesawat'] = $id_pesawat[1];
		if($this->session->userdata('login_type') == 'jemput')
			$id_kota = $this->input->post('kota');
		else
			$id_kota = $this->input->post('id_kota');
		$data['kota'] = $this->kota->get($id_kota);
		$data['user'] = $this->user->getuser($this->session->userdata('id_user'));
		$biaya = $this->kota->getbiaya($id_kota);
		$data['biaya'] = str_replace(',','.',number_format($biaya));
		if($this->session->userdata('id_jam'))
			$id_jam = $this->session->userdata('id_jam');
		$data['orang'] = $this->input->post('orang');
		if($this->session->userdata('waktu'))
			$waktu = $this->session->userdata('waktu');
		$data['waktu'] = $this->input->post('waktu');
		if($this->session->userdata('email')) {
			$sess = array(
				'id_kota' => $this->input->post('id_kota'),
				'id_jam' => $id_jam,
				'waktu' => $this->input->post('waktu')
			);
			$this->session->set_userdata($sess);
			if($this->session->userdata('login_type') == 'jemput') {
				$this->load->view('jemput', $data);
			} else {
				$this->load->view('antar', $data);
			}
		} else {
			$this->session->set_userdata('error_login', 'Maaf anda belum login!');
			$this->load->view('login', $data);
		}
	}
	function process() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if(preg_match('/^[\w]+@[\w\.]+/i', $email) == true) {
			$data = $this->user->get($email, $password);
			$id_user = $data->id_user;
			$nama = $data->nama;
			$level = $data->level;
			$sess = array(
				'id_user' => $id_user,
				'nama' => $nama,
				'email' => $this->input->post('email'),
				'level' => $level
			);
			$this->session->set_userdata($sess);
			redirect('main');
		} else {
			redirect('main');
		}
	}
	function validate_email() {
		$email = $this->input->get('email');
		if(preg_match('/^[\w]+@[\w\.]+/i', $email) == true) {
			$data = $this->user->validate_email($email);
			if($data == true)
				echo 'true';
			else
				echo 'false';
		} else {
			echo 'false';
		}
	}

}