<?php if (! defined('BASEPATH')) exit('No direct script access');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
	}

	function index() {
		$html = "
			<!DOCTYPE html>
			<html>
				<head>
					<style type='text/css' media='screen'>
						html, body { background:#2d2d2d; }
						#login {
							background:#fff;
							border:1px solid #ccc;
							margin:200px auto;
							padding:20px;
							width:480px;
							-moz-border-radius:10px;
							-webkit-border-radius:10px;
							border-radius:10px;
						}
						#login_form { text-align:left; }
						.simple { margin:20px 0; }
						.simple label { float:left; width:80px; }
					</style>
				</head>
				</body>
					<div id='login' style='display:block'>
						<img src='".base_url()."images/logo-invoice.png' style='height:58px;width:400px'>
						<form id='login_form' method='post' action='".base_url()."admin/login/force/'>
		";
		if($this->session->userdata('error')) {
	  	$html .= "<p style='background:#ff0;border:1px solid #f00;color:#f00;padding:5px;'>".$this->session->userdata('error')."</p>";
	  	$this->session->unset_userdata('error');
  	}
		$html .= "
							<div class='simple'>
								<label for='email'>Login: </label>
								<input type='text' id='email' name='email' size='30' />
							</div>
							<div class='simple'>
								<label for='password'>Password: </label>
								<input type='password' id='password' name='password' size='30' />
							</div>
							<div class='simple'>
								<label for='submit'>&nbsp;</label>
								<input type='submit' value='Login' />
							</div>
						</form>
					</div>
				</body>
			</html>
		";
		echo $html;
	}
	function force() {
		$this->session->sess_destroy();
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if($email == '' && $password == '') {
			$this->session->set_userdata('error', 'Email dan Password belum diisi!');
		} else {
			$email1 = explode('@',$email);
			$email1 = $email1[0];
			$query = $this->db->get('kota')->result();
			$logged = $this->user->getlogin($email, $password);
			foreach($query as $row) {
				if($email1 == $row->nama || $email1 == 'admin') {
					if($logged) {
						foreach($logged as $row) {
							$this->session->unset_userdata('error');
							if($row->level == 1) {
								$data = array(
									'id_user' => $row->id_user,
									'email' => $email,
									'level' => $row->level
								);
								$this->session->set_userdata($data);
							} else {
								$this->session->set_userdata('error', 'Anda tidak berhak berada halaman ini!');
							}
						}
					} else {
						$this->session->set_userdata('error', 'Email dan Password tidak ditemukan!');
					}
				} else {
					$this->session->set_userdata('error', 'Anda tidak berhak berada halaman ini!');
				}
			}
		}
		redirect('admin');
	}

}