<?php

class Surat extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_surat'));
  }

	function index(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['surat']		= $this->Model_surat->get()->result();
		$this->template->display('surat/surat', $data);
	}

	function edit(){
		$kode 						= $this->uri->segment(3);
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['surat']		= $this->Model_surat->get_surat($kode)->row_array();
		$this->template->display('surat/edit',$data);
	}

	function updatesurat(){
		$kode_surat = $this->input->post('kode_surat');
		$this->Model_surat->updatesurat($kode_surat);
	}


}
