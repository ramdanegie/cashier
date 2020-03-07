<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_biaya extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function biaya(){
    $this->db->select('kodebiaya,namajur,biaya,tingkat,angkatan,statuskelas ');
    $this->db->from('biaya');
    $this->db->join('jurusan','biaya.kodejur = jurusan.kodejur');
    $this->db->order_by('angkatan','desc');
    return $this->db->get();
  }

	function get_kelas($id){
		return $this->db->get_where('biaya',array('kodebiaya'=>$id));
	}

  function save(){
    $tingkat      = $this->input->post('tingkat');
    $jurusan      = $this->input->post('jurusan');
    $biaya        = $this->input->post('biaya');
    $angkatan     = $this->input->post('tahun');
    $statuskelas  = $this->input->post('status');
    $cek          = $this->db->query("select kodebiaya as hitung from biaya where tingkat='$tingkat' and kodejur='$jurusan' and angkatan='$angkatan'")->num_rows();
    if(!empty($cek)){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Already Exist !
      </div>');
      redirect('biaya');
    }else{
      $data = array(
        'kodejur'     => $jurusan,
        'biaya'       => $biaya,
        'tingkat'     => $tingkat,
        'angkatan'    => $angkatan,
        'statuskelas' => $statuskelas
      );

      $simpan = $this->db->insert('biaya',$data);
      if($simpan){
        $this->session->set_flashdata('msg',
       '<div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <i class="fa fa-check"></i> Data Saved Succesfully !
        </div>');
        redirect('biaya');
      }
    }
  }

  function hapus($kodebiaya){
    $hapus = $this->db->delete('biaya',array('kodebiaya'=>$kodebiaya));
    if($hapus){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Deleted Succesfully !
      </div>');
      redirect('biaya');
    }
  }







}
