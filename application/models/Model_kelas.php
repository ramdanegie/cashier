<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_kelas extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function get() {
    $this->datatables->select('kelas,kodejur,tahunmasuk,angkatan,tingkat,statuskelas,kelas.userid,nama');
    $this->datatables->from('kelas');
    $this->datatables->join('user','kelas.userid = user.userid');
    $this->datatables->add_column('view', '<a href="kelas/setkelas/$1"  class="btn bg-blue btn-xs waves-effect"><i class = "fa fa-gear"></i></a><a href="#" data-id="$1"  class="btn bg-green btn-xs waves-effect edit "><i class = "fa fa-pencil"></i></a> <a href="kelas/delete/$1"  class="btn bg-red btn-xs waves-effect hapus"><i class = "fa fa-trash-o"></i></a>', 'kelas');
    return $this->datatables->generate();
  }

  function getJurusan(){
    return $this->db->get('jurusan');
  }

  function getTingkat(){
    return $this->db->get('tingkat');
  }

  function getPA(){
    return $this->db->get_where('user',array('role'=>'pa'));
  }

  function save(){
    $namakelas   = $this->input->post('kelas');
    $jurusan     = $this->input->post('jurusan');
    $tahunmasuk  = $this->input->post('tahunmasuk');
    $angkatan    = $this->input->post('angkatan');
    $tingkat     = $this->input->post('tingkat');
    $status      = $this->input->post('status');
    $pa          = $this->input->post('pa');

    $data     = array(

      'kelas'       => $namakelas,
      'kodejur'     => $jurusan,
      'tahunmasuk'  => $tahunmasuk,
      'angkatan'    => $angkatan,
      'tingkat'     => $tingkat,
      'statuskelas' => $status,
      'userid'      => $pa

    );

    $simpan = $this->db->insert('kelas',$data);
    if($simpan){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
      redirect('kelas');
    }
  }

  function update(){
    $namakelas   = $this->input->post('kelas');
    $jurusan     = $this->input->post('jurusan');
    $tahunmasuk  = $this->input->post('tahunmasuk');
    $angkatan    = $this->input->post('angkatan');
    $tingkat     = $this->input->post('tingkat');
    $status      = $this->input->post('status');
    $pa          = $this->input->post('pa');

    $data     = array(


      'kodejur'     => $jurusan,
      'tahunmasuk'  => $tahunmasuk,
      'angkatan'    => $angkatan,
      'tingkat'     => $tingkat,
      'statuskelas' => $status,
      'userid'      => $pa

    );

    $simpan = $this->db->update('kelas',$data,array('kelas'=>$namakelas));
    if($simpan){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
      redirect('kelas');
    }
  }

    function delete($kelas){
      $delete = $this->db->delete('kelas',array('kelas'=>$kelas));
      if($delete){
        $this->session->set_flashdata('msg',
       '<div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <i class="fa fa-check"></i> Data Deleted Succesfully !
        </div>');
        redirect('kelas');
      }
    }

    function get_mhs($kelas){
      $this->db->select('*');
      $this->db->from('mahasiswa');
      $this->db->join('kelas','mahasiswa.kelas = kelas.kelas');
      $this->db->join('jurusan','kelas.kodejur = jurusan.kodejur');
      $this->db->where('mahasiswa.kelas',$kelas);
      return $this->db->get();
    }

    function get_kelas($kelas){
      $this->db->join('jurusan','kelas.kodejur = jurusan.kodejur');
      $this->db->where('kelas',$kelas);
      return $this->db->get('kelas');
    }

    function get_kelas2($kelas,$angkatan,$tahunmasuk,$tingkat){
      $this->db->where('angkatan',$angkatan);
      $this->db->where('tahunmasuk',$tahunmasuk);
      $this->db->where('tingkat',$tingkat);
      return $this->db->get('kelas');
    }

    function updatesetkelas(){
      $x = 0;
      $k = $this->input->post('kelas');
    	foreach($this->input->post('nim') as $nim){
    		$nimdulu = $this->input->post('nimdulu')[$x];
    		$namamhs = $this->input->post('namamhs')[$x];
    		$kls     = $this->input->post('kelasbaru')[$x];

        $data = array(

          'nim'     => $nim,
          'namamhs' => $namamhs,
          'kelas'   => $kls,

        );

        $this->db->update('mahasiswa',$data,array('nim'=>$nimdulu));

    		if($nim<>$nimdulu){
    			$count = $this->db->query("select count(nim) from kontrak where nim='$nimdulu'")->num_rows();
    			if($count > 0){
            $datakontrak = array(
              'nim' => $nim
            );
            $this->db->update('kontrak',$datakontrak,array('nim'=>$nimdulu));
    			}
    		}

    		$x++;
    	}
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
      redirect('kelas/setkelas/'.$k);
    }
  }
