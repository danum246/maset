<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('sess_login') != TRUE) {
		 	redirect('auth','refresh');
		}
	}

	function index()
	{
		$data['page'] = 'master/vendor_view';
		$this->load->view('template',$data);
	}

}

/* End of file vendor.php */
/* Location: ./application/controllers/master/vendor.php */