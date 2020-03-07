<?php

class Biaya extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_biaya','Model_kelas'));
  }


	function index(){
		$data['biaya']							= $this->Model_biaya->biaya()->result();
		$data['username'] 					= $this->access->get_username();
		$data['fullname'] 					= $this->access->get_fullname();
		$data['level']	  					= $this->access->get_level();
		$data['tk']									= $this->Model_kelas->getTingkat()->result();
		$data['jur']								= $this->Model_kelas->getJurusan()->result();
		$this->template->display('biaya/biaya', $data);

	}

	function get_biaya() {
		header('Content-Type: application/json');
    echo $this->Model_biaya->get();
  }

	function save(){
		$this->Model_biaya->save();
	}

	function hapus(){
		$kodebiaya = $this->uri->segment(3);
		$this->Model_biaya->hapus($kodebiaya);
	}

}
