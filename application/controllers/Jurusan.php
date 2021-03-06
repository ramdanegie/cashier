<?php

class Jurusan extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_jurusan'));
  }

	function index(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$this->template->display('jurusan/jurusan', $data);
	}

	function get_jurusan() {
		header('Content-Type: application/json');
    echo $this->Model_jurusan->get();
  }

}
