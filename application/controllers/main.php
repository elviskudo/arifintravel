<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('kota_model', 'kota');
		$this->load->model('jam_model', 'jam');
	}
	public function index()	{
		$data['kota'] = $this->kota->all();
		$this->load->view('main', $data);
	}
	public function jam() {
		$id = $this->uri->segment(3);
		foreach($this->jam->get($id) as $row) {
			echo '<option value="'.$row->id_jam.'">'.$row->jam.'</option>';
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */