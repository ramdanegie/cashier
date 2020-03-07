<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_surat extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function get() {
    return $this->db->get('surat');
  }

  function get_surat($kode){
    return $this->db->get_where('surat',array('kode_surat'=>$kode));
  }

  function updatesurat($kode_surat){
    $perihal      = $this->input->post('perihal');
    $editor1      = $this->input->post('editor1');
    $editor2      = $this->input->post('editor2');

    $data = array(
      'perihal'       => $perihal,
      'isi_surat'     => $editor1,
      'isi_surat2'    => $editor2
    );

    $update = $this->db->update('surat',$data,array('kode_surat'=>$kode_surat));
    if($update){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
      redirect('surat');

    }
  }




}
