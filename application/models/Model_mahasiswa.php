<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_mahasiswa extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function get() {
    $this->datatables->select('nim,namamhs,kelas,telepon');
    $this->datatables->from('mahasiswa');
    $this->datatables->add_column('view', '<a href="#" data-id="$1"  class="btn bg-green btn-xs waves-effect edit "><i class = "fa fa-pencil"></i></a> <a href="mahasiswa/delete/$1"  class="btn bg-red btn-xs waves-effect hapus"><i class = "fa fa-trash-o"></i></a>', 'nim');
    return $this->datatables->generate();
  }

  function save(){
    $nim          = $this->input->post('nim');
    $nama         = $this->input->post('nama');
    $tingkat      = $this->input->post('tingkat');
    $jurusan      = $this->input->post('jurusan');
    $kelas        = $this->input->post('kelas');
    $telepon      = $this->input->post('phone');
    $status       = $this->input->post('status');
    $namaortu     = $this->input->post('namaortu');
    $alamatortu   = $this->input->post('alamatortu');
    $teleponortu  = $this->input->post('phoneortu');
    $kelassenior  = $this->input->post('kelas_senior');

    $data = array(
      'nim'             => $nim,
      'namamhs'         => $nama,
      'kelas'           => $kelas,
      'telepon'         => $telepon,
      'ket'             => $status,
      'namaorgtua'      => $namaortu,
      'alamatorgtua'    => $alamatortu,
      'noorgtua'        => $teleponortu,
      'kelas_senior'    => $kelassenior
    );

    $simpan = $this->db->insert('mahasiswa',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Saved Succesfully !
      </div>');
      redirect('mahasiswa');
    }
  }

  function get_mhs($a){
    $this->db->select('*');
    $this->db->from('mahasiswa');
    $this->db->where('nim',$a);
    $this->db->join('kelas','mahasiswa.kelas = kelas.kelas');
    $this->db->join('jurusan','kelas.kodejur = jurusan.kodejur');
    return $this->db->get();
  }

  function update(){
    $nim          = $this->input->post('nim');
    $nama         = $this->input->post('nama');
    $tingkat      = $this->input->post('tingkat');
    $jurusan      = $this->input->post('jurusan');
    $kelas        = $this->input->post('kelas');
    $telepon      = $this->input->post('phone');
    $status       = $this->input->post('status');
    $namaortu     = $this->input->post('namaortu');
    $alamatortu   = $this->input->post('alamatortu');
    $teleponortu  = $this->input->post('phoneortu');
    $kelassenior  = $this->input->post('kelas_senior');

    $data = array(
      'namamhs'         => $nama,
      'kelas'           => $kelas,
      'telepon'         => $telepon,
      'ket'             => $status,
      'namaorgtua'      => $namaortu,
      'alamatorgtua'    => $alamatortu,
      'noorgtua'        => $teleponortu,
      'kelas_senior'    => $kelassenior
    );

    $simpan = $this->db->update('mahasiswa',$data,array('nim'=>$nim));
    if($simpan){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
      redirect('mahasiswa');
    }
  }

  function deleted($nim){
    $delete = $this->db->delete('mahasiswa',array('nim'=>$nim));
    if($delete){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Deleted Succesfully !
      </div>');
      redirect('mahasiswa');
    }
  }


}
