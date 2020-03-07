<?php

class Model_dashboard extends CI_Model{

  function getPenerimaanhariini(){
    $hariini = date('Y-m-d');
    $this->db->select("SUM(bayar) as jmlbayar");
    $this->db->from('historibayar');
    $this->db->where('tgl',$hariini);
    $this->db->group_by('tgl');
    return $this->db->get();
  }

  function getPenerimaanbulanini(){
    $bulan = date('m');
    $tahun = date('Y');
    $this->db->select("SUM(bayar) as jmlbayar");
    $this->db->from('historibayar');
    $this->db->where('YEAR(tgl)',$tahun);
    $this->db->where('MONTH(tgl)',$bulan);
    //$this->db->group_by('tgl');
    return $this->db->get();
  }

  function getPenerimaantahunini(){
    $tahun = date('Y');
    $this->db->select("SUM(bayar) as jmlbayar");
    $this->db->from('historibayar');
    $this->db->where('YEAR(tgl)',$tahun);
    
    //$this->db->group_by('tgl');
    return $this->db->get();
  }
}
