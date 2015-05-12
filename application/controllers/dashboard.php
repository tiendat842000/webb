<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends SB_Controller {

    function __construct()
    {
        parent::__construct();		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);			
    }

	public function index()
	{
		$this->data = array();
		$this->data['content'] = $this->load->view('dashboard',$this->data,true);		
		$this->load->view('layouts/main',$this->data);
	}
	
}
