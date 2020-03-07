<?php

class Mahasiswa extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_mahasiswa','Model_laporan'));
  }

	function index(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['tingkat']	= $this->Model_laporan->gettingkat()->result();
		$this->template->display('mahasiswa/mahasiswa', $data);
	}

	function get_mahasiswa() {
		header('Content-Type: application/json');
    echo $this->Model_mahasiswa->get();
  }

	function edit(){
		$a 					= $this->uri->segment(3);
		//echo $id;
		//die;
		//echo $a;
		$data['tingkat']	= $this->Model_laporan->gettingkat()->result();
		$data['mhs']			= $this->Model_mahasiswa->get_mhs($a)->row_array();
		$this->load->view('mahasiswa/edit',$data);
	}

	function getjurusan(){
		$tingkat = $this->input->post('tingkat');
		$jurusan = $this->db->query("SELECT kelas.kodejur, jurusan.namajur
							FROM kelas
							INNER JOIN jurusan ON kelas.kodejur = jurusan.kodejur
							WHERE kelas.tingkat = '$tingkat'
							GROUP BY kelas.kodejur")->result();
		echo "<option value=''>-- Jurusan --</option>";
		foreach ($jurusan as $j ) {
			echo "<option value='$j->kodejur'>".$j->namajur."</option>";
		}
	}

	function getkelas(){
		$tingkat = $this->input->post('tingkat');
		$jurusan = $this->input->post('jurusan');
		$kelas 	 = $this->db->query("SELECT kelas.kelas
							FROM kelas
							INNER JOIN jurusan ON kelas.kodejur = jurusan.kodejur
							WHERE kelas.tingkat = '$tingkat'
							AND kelas.kodejur = '$jurusan'")->result();
		echo "<option value=''>-- Kelas --</option>";
		foreach ($kelas as $k ) {
			echo "<option value='$k->kelas'>".$k->kelas."</option>";
		}
	}

	function save(){
		$this->Model_mahasiswa->save();
	}

	function update(){
		$this->Model_mahasiswa->update();
	}

	function delete(){
		$nim = $this->uri->segment(3);
		$this->Model_mahasiswa->deleted($nim);
	}


}
