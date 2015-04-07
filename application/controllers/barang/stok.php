<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stok extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('sess_login') != TRUE) {
		 	redirect('auth','refresh');
		}
	}

	function index()
	{
		$data['page'] = 'barang/stok_view';
		$this->load->view('template',$data);
	}

}

/* End of file stok.php */
/* Location: ./application/controllers/barang/stok.php */