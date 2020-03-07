<?php

class Pa extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_pa'));
  }

	function index(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$this->template->display('pa/pa', $data);
	}

	function get_pa() {
		header('Content-Type: application/json');
    echo $this->Model_pa->get();
  }

}
