<?php if (! defined('BASEPATH')) exit('No direct script access');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model', 'user');
		$this->load->model('cabang_model', 'cabang');
		$this->load->model('admin_model', 'admin');
		$this->load->model('invoice_model', 'invoice');
		$this->load->model('invoicej_model', 'invoicej');
		$this->load->model('transaksi_model', 'transaksi');
		$this->load->model('cabang_model', 'cabang');
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
							font: normal 12px/16px Arial,sans-serif;
							margin:200px auto;
							padding:20px;
							width:480px;
							-moz-border-radius:10px;
							-webkit-border-radius:10px;
							border-radius:10px;
						}
						#login_form { text-align:left; }
						.simple { margin:20px 0; }
						.simple label { float:left; width:120px; }
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
								<label for='cabang'>Kantor Cabang: </label>
								<select id='cabang' name='cabang'>
		";
		$cabang = $this->cabang->all();
		foreach($cabang as $cbg) {
			$html .= '<option value="'.$cbg->id_cabang.'">'.$cbg->nama.' KOTA '.$cbg->kota.'</option>';
		}
		$html .= "
								</select>
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
		$cabang = $this->input->post('cabang');
		if($email == '' && $password == '') {
			$this->session->set_userdata('error', 'Email dan Password belum diisi!');
		} else {
			$logged = $this->admin->getlogin($email, $password, $cabang);
			if($logged) {
				foreach($logged as $row) {
					$this->session->unset_userdata('error');
					$data = array(
						'id_user' => $row->id_admin,
						'email' => $email,
						'level' => $row->level,
						'id_cabang' => $row->id_cabang
					);
					$this->session->set_userdata($data);
					if($row->level == 0)
						redirect('admin/transaksi');
					$data['kasmasuk'] = $this->transaksi->kasmasuk();
					$data['kaskeluar'] = $this->transaksi->kaskeluar();
					$data['saldoawal'] = $this->cabang->saldoawal();
					$data['saldoakhir'] = $this->cabang->saldoakhir();
					$data['statusantar'] = $this->invoice->getstatus();
					$data['statusjemput'] = $this->invoicej->getstatus();
					$data['user'] = $this->admin->getmail($this->session->userdata('email'));
					$this->load->view('admin/main', $data);
				}
			} else {
				$this->session->set_userdata('error', 'Email dan Password tidak ditemukan!');
				redirect('admin/login');
			}
		}
		// redirect('admin');
	}

}