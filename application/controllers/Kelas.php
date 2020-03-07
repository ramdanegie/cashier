<?php

class Kelas extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_kelas'));
  }

	function index(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['jurusan']	= $this->Model_kelas->getJurusan()->result();
		$data['tingkat']	= $this->Model_kelas->getTingkat()->result();
		$data['pa']				= $this->Model_kelas->getPA()->result();
		$this->template->display('kelas/kelas', $data);
	}

	function get_kelas() {
		header('Content-Type: application/json');
    echo $this->Model_kelas->get();
  }

	function edit(){
		$id 							= $this->input->post('kelas');
		$data['jurusan']	= $this->Model_kelas->getJurusan()->result();
		$data['tingkat']	= $this->Model_kelas->getTingkat()->result();
		$data['pa']				= $this->Model_kelas->getPA()->result();
		$data['kelas']		= $this->Model_kelas->get_kelas($id)->row_array();
		$this->load->view('kelas/edit',$data);
	}

	function save(){
		$this->Model_kelas->save();
	}

	function update(){
		$this->Model_kelas->update();
	}


	function delete(){
		$kelas  	= $this->uri->segment(3);
		$this->Model_kelas->delete($kelas);
	}

	function setkelas(){
		$k 								= $this->uri->segment(3);
		$kelas 						= str_replace("%20"," ",$k);
		//echo $kelas;
		//die;
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$kls 							= $this->Model_kelas->get_kelas($kelas)->row_array();
		$data['kls']			= $kelas;
		$data['mhs']			= $this->Model_kelas->get_mhs($kelas)->result();
		$data['kelas']		= $this->Model_kelas->get_kelas2($kelas,$kls['angkatan'],$kls['tahunmasuk'],$kls['tingkat'])->result();
		$this->template->display('kelas/setkelas', $data);

	}

	function updatesetkelas(){
		$this->Model_kelas->updatesetkelas();
	}





}
