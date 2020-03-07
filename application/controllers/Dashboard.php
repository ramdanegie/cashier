<?php

class Dashboard extends MY_Core{
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_dashboard'));
  }

	function index(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  =$this->access->get_level();
		$data['hariini']	= $this->Model_dashboard->getPenerimaanhariini()->row_array();
		$data['bulanini']	= $this->Model_dashboard->getPenerimaanbulanini()->row_array();
		$data['tahunini']	= $this->Model_dashboard->getPenerimaantahunini()->row_array();
		$this->template->display('dashboard',$data);
	}



}
