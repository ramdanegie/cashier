<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_pa extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function get() {
    $this->datatables->select('username,nama');
    $this->datatables->from('user');
    $this->datatables->add_column('view', '<a href="#" data-id="$1"  class="btn bg-green btn-xs waves-effect edit "><i class = "fa fa-pencil"></i></a> <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="jurusan/delete/$1" class="btn bg-red btn-xs waves-effect"><i class = "fa fa-trash-o"></i></a>', 'kodejur');
    return $this->datatables->generate();
  }




}
