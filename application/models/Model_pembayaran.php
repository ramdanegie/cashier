<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_pembayaran extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function get($status,$tingkat) {
    $status = strtoupper($status);
    $url    = base_url();
    $this->datatables->select('kontrak.kodekontrak,kontrak.nim,namamhs,biaya.tingkat,biaya.angkatan,mahasiswa.kelas,biaya.statuskelas,tingkat.namatingkat');
    $this->datatables->from('kontrak');
    $this->datatables->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->datatables->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->datatables->join('kelas','mahasiswa.kelas = kelas.kelas');
    $this->datatables->join('tingkat','biaya.tingkat = tingkat.tingkat');
    $this->datatables->where('biaya.statuskelas',$status);
    $this->datatables->where('biaya.tingkat',$tingkat);

    $this->datatables->add_column('view', '<a href='.$url.'pembayaran/detail/$1 class="btn bg-red btn-xs waves-effect">Rincian</a>', 'kodekontrak');
    return $this->datatables->generate();
  }

  function getall() {

    $url    = base_url();
    $this->datatables->select('nim,namamhs,kelas');
    $this->datatables->from('mahasiswa');
    $this->datatables->add_column('view', '<a href='.$url.'laporan/cetakrincian/$1 class="btn bg-red btn-xs waves-effect">Cetak Rincian</a>', 'nim');
    return $this->datatables->generate();
  }

  function get_belumregis($status,$tingkat){
    $status = strtoupper($status);
    $query  = "SELECT mahasiswa.nim, mahasiswa.namamhs, b.kelas
    FROM  mahasiswa
    LEFT JOIN
      (
        SELECT kontrak.kodekontrak as kode, kontrak.nim, biaya.tingkat, biaya.angkatan, mahasiswa.namamhs, mahasiswa.kelas, kelas.statuskelas, tingkat.namatingkat
        FROM kontrak
        INNER JOIN biaya ON kontrak.kodebiaya = biaya.kodebiaya
        INNER JOIN mahasiswa ON kontrak.nim = mahasiswa.nim
        INNER JOIN kelas ON mahasiswa.kelas = kelas.kelas
        INNER JOIN tingkat ON biaya.tingkat = tingkat.tingkat
        WHERE biaya.statuskelas = '$status'
        AND biaya.tingkat = '$tingkat') AS a ON mahasiswa.nim = a.nim
        JOIN kelas as b on b.kelas = mahasiswa.kelas
        WHERE  b.statuskelas = '$status'
        AND b.tingkat = '$tingkat'
        AND a.nim is null";
    return $this->db->query($query);
  }

  function get_reg($kodereg){
    $this->db->select('kontrak.kodekontrak,kontrak.nim,namamhs,kelas,ket,tglregis,gelombang,kontrak.kodebiaya,biaya,diskongelombang,diskonprestasi,diskoncash,diskonlain,hargadeal,rencanacicilan,registrasi,jenisregis,cicilanper,penyesuaian');
    $this->db->from('kontrak');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->where('kontrak.kodekontrak',$kodereg);
    return $this->db->get();
  }

  function getJmlbayar($kodereg){
    $query = "SELECT IFNULL(SUM(bayar),0) as jumlah FROM historibayar WHERE kodekontrak ='$kodereg' AND jenis='REGULER' GROUP BY kodekontrak";
    return $this->db->query($query);
  }

  function get_ren($kodereg){
    $this->db->where('kodekontrak',$kodereg);
    $this->db->where('cicilanke >',0);
    return $this->db->get('detailrencana');
  }

  function get_ren2($kodereg){
    $this->db->where('kodekontrak',$kodereg);
    return $this->db->get('detailrencana');
  }
  function get_rentemp($kodereg){
    $this->db->where('kodekontrak',$kodereg);
    return $this->db->get('temp_detailrencana');
  }

  function get_jmlcicilan($kodereg){
    $this->db->where('kodekontrak',$kodereg);
    return $this->db->get('detailrencana');
  }

  function get_historibayar($kodereg,$jenis="REGULER"){
    $this->db->where('kodekontrak',$kodereg);
    $this->db->where('jenis',$jenis);
    $this->db->order_by('nobukti ASC');
    return $this->db->get('historibayar');
  }

  function bayar(){
    error_reporting(0);
    $tahunskrg      =date("Y");
    $char           = "";
    $tahunkapotong  = substr($tahunskrg,2,2);
  	$q              = "select (SELECT nobukti FROM historibayar where substr(nobukti,1,2)=$tahunkapotong order by nobukti desc limit 1) as idMaks";
  	$h              = $this->db->query($q);
  	$d              = $h->row_array();
  	$ambilnik       = $d['idMaks'];
  	$autonik        = substr($ambilnik,2,5);
  	$noUrut         = (int)($autonik);
  	$noUrut++;
  	//%03s untuk mengatur 3 karakter di belakang
  	$akhir          = $char . sprintf("%05s", $noUrut);
  	$nobuktis       = "$tahunkapotong$akhir";
  	//ambil data value dari setiap name input type
  	//echo $nobukti;
    //autonumber no. btk
		$q2             = "select (SELECT nobtk FROM historibayar order by nobtk desc limit 1) as idMaks";
    $h2             = $this->db->query($q2);
  	$d2             = $h2->row_array();
		$ambilnik2      = $d2['idMaks'];
  	$autonik2       = $ambilnik2;
  	$noUrut2        = (int)($autonik2);
  	$noUrut2++;


  	$kodekontrak   = $this->input->post('kodekontrak');
  	$nobukti       = $nobuktis;
  	//$cicilanper = $_POST['cicilanper'];
  	$tglbayar      = $this->input->post('tglbayar');
  	$bayar         = str_replace(".","",$this->input->post('bayar'));
  	$kasir         = $this->input->post('kasir');
  	$pilih         = $this->input->post('pilih');
  	$mbe           = $this->input->post('nobtkbtb');
  	$terimadari    = $this->input->post('terimadari');
    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih=="btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}


    $q      = "select (SELECT cicilanke FROM detailrencana where kodekontrak='$kodekontrak' order by cicilanke desc limit 1) as idMaks";
		$hasil  = $this->db->query($q);
		$data   = $hasil->row_array();
		$autokj = $data['idMaks'];
		$noUrut = (int)($autokj);
		$noUrut++;

    $cek          = $this->db->query("select sum(bayar) as jumlahbayar from historibayar where kodekontrak='$kodekontrak' order by nobukti asc limit 1")->row_array();
    $jumlahbayar  = $cek['jumlahbayar'];

    $cek1         = $this->db->query("select hargadeal as deal from kontrak where kodekontrak='$kodekontrak'")->row_array();
    $deal         = $cek1['deal'];

    $jumlah       = $this->db->query("select jenisregis from kontrak where kodekontrak='$kodekontrak'")->row_array();
    $jenisregis   = $jumlah['jenisregis'];

    if($jenisregis=="DANAPINJAMAN"){
      $cinggalong   = $this->db->query("select sum(wajibbayar) as meng from detailrencana where kodekontrak='$kodekontrak'")->row_array();
      $meng         = $cinggalong['meng'];
      $danapinjaman = $deal-$meng;
      $sumwb        = $meng;
    }else{
      $sumwb        = $deal;
    }
    $wajibbayar   = $sumwb-$jumlahbayar;

    if ($wajibbayar == "0"){
      //header ("location:admin-home.php?page=bayar-cicilan&id=$kodekontrak&error=2");
    }else if ($bayar>$wajibbayar){
      //header ("location:admin-home.php?page=bayar-cicilan&id=$kodekontrak&error=1");
    }else{
      $id       = $kodekontrak;
      $query    = $this->db->query("SELECT sum(bayar) as haha from historibayar where kodekontrak='$id'");
      $row      = $query->row_array();
      $n        = 0;
      $jmlbayar =$row['haha'];
      $q        = $this->db->query("select cicilanke, jatuhtempo, wajibbayar, count(wajibbayar) as sumwajib from detailrencana where kodekontrak='$id'");
      $d        = $q->row_array();
      $sumwajib = $d['sumwajib'];
      $bayaryeuh= $bayar;

      while($n<$sumwajib) {
        $queryrencana = $this->db->query("SELECT * FROM detailrencana where kodekontrak='$id' and cicilanke='$n'");
        $datarencana  = $queryrencana->row_array();
        $tgl          = $datarencana['jatuhtempo'];
        $tahun        = substr($tgl,0,4);
        //$bulan=substr($tgl,5,2);
        $bulan        = date("F", strtotime($tgl));
        $wb           = $datarencana['wajibbayar'];
        $ck           = $n;
        if($n=='0'){
          $meong        = $this->db->query("SELECT tingkat.namatingkat from tingkat, kontrak, biaya where biaya.tingkat = tingkat.tingkat and kontrak.kodebiaya = biaya.kodebiaya and kontrak.kodekontrak='$kodekontrak'");
          $dudu         = $meong->row_array();
          $namatingkat  = $dudu['namatingkat'];
          $cetak        = "Registrasi";
        }else{
          $cetak="Cic ke-$n";
        }
        if($jmlbayar>$wb){
          $jmlbayar=$jmlbayar-$wb;
        }else{
          if($jmlbayar>0){
            $kurang=$wb-$jmlbayar;
            if($kurang>0){
              if ($bayaryeuh>0){
                if ($bayaryeuh<$kurang){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  if($kurang<$wb){
                    $ie[$n] = "Pelunasan $cetak; ";
                  }else{
                    $ie[$n] = "$cetak; ";
                  }
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$kurang;
            }else{
              $bayaryeuh=$bayaryeuh-$kurang;
            }
            $jmlbayar=$jmlbayar-$wb;
          }else{
            if($ck=='0'){
              if ($bayaryeuh>0){
                if ($bayaryeuh<$wb){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$wb;
            }else{
              if ($bayaryeuh>0){
                if ($bayaryeuh<$wb){
                  $ie[$n] = "$cetak (sebagian); ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }else{
              }
              $bayaryeuh=$bayaryeuh-$wb;
            }
          }
        }
        $n++;
    }

    if ($bayar==$wajibbayar){
      $ket="Pelunasan Pembayaran Cicilan";
    }else{
      $ket="$ie[0]$ie[1]$ie[2]$ie[3]$ie[4]$ie[5]$ie[6]$ie[7]$ie[8]$ie[9]$ie[10]";
    }

    $data = array(
            'nobukti'     => $nobukti,
            'kodekontrak' => $kodekontrak,
            'tgl'         => $tglbayar,
            'terimadari'  => $terimadari,
            'bayar'       => $bayar,
            'jenis'       => 'REGULER',
            'Keterangan'  => $ket,
            'kasir'       => $kasir,
            'nobtk'       => $nobtk,
            'nobtb'       => $nobtb

    );
    $simpan = $this->db->insert('historibayar',$data);
    if($simpan){

      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Saved Succesfully !
      </div>');
      redirect('pembayaran/detail/'.$kodekontrak);
    }
  }
}

function updatebayar(){
  error_reporting(0);
  $kodekontrak   = $this->input->post('kodekontrak');
  $nobukti       = $this->input->post('nobukti');
  $tglbayar      = $this->input->post('tglbayar');
  $bayar         = str_replace(".","",$this->input->post('bayar'));;
  $kasir         = $this->input->post('kasir');
  $pilih         = $this->input->post('pilih');
  $mbe           = $this->input->post('nobtkbtb');
  $terimadari    = $this->input->post('terimadari');
  //echo $mbe;
	if ($pilih == "btk"){
		$nobtk  = $mbe;
		$nobtb  = "";
		//echo "nobtk : $nobtk, nobtb ga ada";
	}else if ($pilih == "btb"){
		$nobtk  = "";
		$nobtb  = $mbe;
		//echo "nobtb : $nobtb, nobtk ga ada";
	}


  $query            = $this->db->query("SELECT sum(bayar) as haha from historibayar where kodekontrak='$kodekontrak'");
  $row              = $query->row_array();

  $dodol            = $this->db->query("select*from historibayar where kodekontrak='$kodekontrak' and nobukti='$nobukti'")->row_array();
  $n                = 0;
  $bayarsebelumnya  = $dodol['bayar'];
  $jmlbayar         = $row['haha']-$bayarsebelumnya;

  $cek1             = $this->db->query("SELECT `hargadeal` FROM `kontrak` WHERE kodekontrak='$kodekontrak'")->row_array();
  $deal             = $cek1['hargadeal'];
  $wajibbayar       = $deal-$jmlbayar;


  if ($bayar>$wajibbayar){
  }else{
    $q              = $this->db->query("select cicilanke, jatuhtempo, wajibbayar, count(wajibbayar) as sumwajib from detailrencana where kodekontrak='$kodekontrak'");
    $d              = $q->row_array();
    $sumwajib       = $d['sumwajib'];
    $bayaryeuh      = $bayar;

    while($n<$sumwajib) {

      $queryrencana = $this->db->query("SELECT * FROM detailrencana where kodekontrak='$kodekontrak' and cicilanke='$n'");
      $datarencana  = $queryrencana->row_array();
      $tgl          = $datarencana['jatuhtempo'];
      $tahun        = substr($tgl,0,4);
    //$bulan=substr($tgl,5,2);
      $bulan        = date("F", strtotime($tgl));
      $wb           = $datarencana['wajibbayar'];
      $ck           = $n;
      if($n=='0'){
        $cetak="Registrasi";
      }else{
        $cetak="Cic ke-$n";
      }
      if($jmlbayar>$wb){
        $jmlbayar=$jmlbayar-$wb;
      }else{
        if($jmlbayar>0){
          $kurang=$wb-$jmlbayar;
          if($kurang>0){
            if ($bayaryeuh>0){
              if ($bayaryeuh<$kurang){
                $ie[$n] = "$cetak (sebagian); ";
              }else{
                if($kurang<$wb){
                  $ie[$n] = "Pelunasan $cetak; ";
                }else{
                  $ie[$n] = "$cetak; ";
                }
              }
            }else{
            }
            $bayaryeuh=$bayaryeuh-$kurang;
          }else{
            $bayaryeuh=$bayaryeuh-$kurang;
          }
          $jmlbayar=$jmlbayar-$wb;
        }else{
          if($ck=='0'){
            if ($bayaryeuh>0){
              if ($bayaryeuh<$wb){
                $ie[$n] = "$cetak (sebagian); ";
              }else{
                $ie[$n] = "$cetak; ";
              }
            }else{
            }
            $bayaryeuh=$bayaryeuh-$wb;
          }else{
            if ($bayaryeuh>0){
              if ($bayaryeuh<$wb){
                $ie[$n] = "$cetak (sebagian); ";
              }else{
                $ie[$n] = "$cetak; ";
              }
            }else{
            }
            $bayaryeuh=$bayaryeuh-$wb;
          }
        }
      }
      $n++;
    }
  }
    $ket="$ie[0]$ie[1]$ie[2]$ie[3]$ie[4]$ie[5]$ie[6]$ie[7]$ie[8]$ie[9]$ie[10]";

    $data = array(
            'tgl'         => $tglbayar,
            'terimadari'  => $terimadari,
            'bayar'       => $bayar,
            'jenis'       => 'REGULER',
            'Keterangan'  => $ket,
            'kasir'       => $kasir,
            'nobtk'       => $nobtk,
            'nobtb'       => $nobtb

    );
    $simpan = $this->db->update('historibayar',$data,array('nobukti'=>$nobukti));
    if($simpan){

      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
      redirect('pembayaran/detail/'.$kodekontrak);
    }
}

function hapusbayar($nobukti,$kodereg){
  $hapus = $this->db->delete('historibayar',array('nobukti'=>$nobukti));
  if($hapus){
    $this->session->set_flashdata('msg',
   '<div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <i class="fa fa-check"></i> Data Has Been  Deleted !
    </div>');
    redirect('pembayaran/detail/'.$kodereg);
  }
}

function getHB($nobukti){
  return $this->db->get_where('historibayar',array('nobukti'=>$nobukti));
}

function cetakkwitansi1($nobukti){
  $this->db->select('historibayar.nobukti,historibayar.kodekontrak, biaya.tingkat, kontrak.nim, mahasiswa.namamhs, tingkat.namatingkat, mahasiswa.kelas, kelas.kodejur, historibayar.tgl, historibayar.bayar, historibayar.jenis, historibayar.keterangan, historibayar.kasir, historibayar.nobtk, historibayar.nobtb, historibayar.terimadari');
  $this->db->from('historibayar');
  $this->db->join('kontrak','historibayar.kodekontrak = kontrak.kodekontrak');
  $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
  $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
  $this->db->join('tingkat','biaya.tingkat = tingkat.tingkat');
  $this->db->join('kelas','mahasiswa.kelas = kelas.kelas');
  $this->db->where('historibayar.nobukti',$nobukti);
  return $this->db->get();

}

function cetakkwitansi2($nobukti){
  $this->db->select('historibayar.nobukti, historibayar.kodekontrak, historibayar.tgl, historibayar.bayar, historibayar.jenis, historibayar.keterangan, historibayar.kasir, historibayar.nobtk, historibayar.nobtb, historibayar.terimadari');
  $this->db->from('historibayar');
  $this->db->where('nobukti',$nobukti);
  return $this->db->get();
}


function get_rencana($id){
  $query = "select `kontrak`.`kodekontrak` AS `kode`,`kontrak`.`nim` AS `nim`,
  `mahasiswa`.`namamhs` AS `namamhs`,`mahasiswa`.`ket` AS `ket`,`mahasiswa`.`kelas` AS `kelas`,`kelas`.`kodejur` AS `kodejur`,`jurusan`.`namajur` AS `namajur`,`biaya`.`tingkat` AS `tingkat`,`tingkat`.`namatingkat` AS `namatingkat`,`biaya`.`biaya` AS `biaya`,`biaya`.`angkatan` AS `angkatan`,`kontrak`.`gelombang` AS `gelombang`,`kontrak`.`diskongelombang` AS `diskongelombang`,`kontrak`.`diskonprestasi` AS `diskonprestasi`,`kontrak`.`diskoncash` AS `diskoncash`,`kontrak`.`diskonlain` AS `diskonlain`,`kontrak`.`hargadeal` AS `deal`,`kontrak`.`tglregis` AS `tglregis`,`kontrak`.`registrasi` AS `regis`,`kontrak`.`rencanacicilan` AS `rencanacicilan`,`kontrak`.`cicilanper` AS `cicilanper`,(select ifnull(sum(`historibayar`.`bayar`),0) AS `jumlah` from `historibayar` where (`historibayar`.`kodekontrak` = `kode`)) AS `jumlah`,(select (`deal` - `jumlah`)) AS `sisa`,`kontrak`.`jenisregis` AS `jenisregis` from mahasiswa, kontrak, tingkat, kelas, biaya, jurusan
  where `mahasiswa`.`nim` = `kontrak`.`nim`
  and `kelas`.`kelas` = `mahasiswa`.`kelas`
  and `biaya`.`kodebiaya` = `kontrak`.`kodebiaya`
  and `tingkat`.`tingkat` = `biaya`.`tingkat`
  and `kelas`.`kodejur` = `jurusan`.`kodejur`
  and `kontrak`.`kodekontrak`='$id'";
  return $this->db->query($query);
}

function updaterencana(){
  $id     = $this->input->post('id');
  $n      = $this->input->post('rencanacicilan');
  $total  = $this->input->post('total');
  //echo $id;
  $tot  = 0;
  for ($i=0; $i<=$n; $i++)
	{
		$wajibbayar   = $this->input->post('wajibbayar'.$i);
		$tot          = $tot  + $wajibbayar;
		//echo "cic ke $i = $tot <br>";
	}

  if($tot!=$total){
  	//echo "total : $tot <br>";
  	//echo "deal : $total";
    $this->session->set_flashdata('msg',
   '<div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <i class="fa fa-check"></i> Jumlah Rencana Melebihi Total Pembayaran !
    </div>');
  	redirect('pembayaran/editrencana/'.$id);
  }else{
    //echo "total : $tot <br>";
  	//echo "deal : $total";
  	$ce    = "select count(cicilanke) as jmlcicilan from detailrencana where kodekontrak='$id'";
  	$cek   = $this->db->query($ce);
  	$cekk  = $cek->row_array();
  	$cekkk = $cekk['jmlcicilan'];
    if($cekkk>1){
  		for ($i=1; $i<=$n; $i++)
  		{
  			$cicilanke   = $this->input->post('cicilanke'.$i);
  			$jatuhtempo  = $this->input->post('jatuhtempo'.$i);
  			$wajibbayar  = $this->input->post('wajibbayar'.$i);

        $data = array(
          'jatuhtempo'  => $jatuhtempo,
          'wajibbayar'  => $wajibbayar
        );

       $simpan =  $this->db->update('detailrencana',$data,array('kodekontrak'=>$id,'cicilanke'=>$cicilanke));
  		}
  		//header("Location: admin-home.php?page=rincian&id=$id");
  		if ($simpan) {
        $this->session->set_flashdata('msg',
       '<div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <i class="fa fa-check"></i> Data Has Been  Updated !
        </div>');
        redirect('pembayaran/detail/'.$id);

  		}
  	}else if($cekkk<=1){

  		redirect('pembayaran/detail/'.$id);

  	}else{
  		echo "Data Error";
  	}
  }
  }

  function updaterencanapinjaman(){
    $id           = $this->input->post('id');
    $n            = $this->input->post('rencanacicilan');
    $total        = $this->input->post('total');
    $danapinjaman = $this->input->post('danapinjaman');


    $tot  = $danapinjaman;
    for ($i=0; $i<=$n; $i++)
  	{
  		$wajibbayar   = $this->input->post('wajibbayar'.$i);
  		$tot          = $tot  + $wajibbayar;
  		//echo "cic ke $i = $tot <br>";
  	}
    echo $tot."<br>".$total;
    //die;
    if($tot!=$total){
    	//echo "total : $tot <br>";
    	//echo "deal : $total";
      $this->session->set_flashdata('msg',
     '<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Jumlah Rencana Melebihi Total Pembayaran !
      </div>');
    	redirect('pembayaran/editrencanapembayaran/'.$id);
    }else{
      //echo "total : $tot <br>";
    	//echo "deal : $total";
    	$ce    = "select count(cicilanke) as jmlcicilan from detailrencana where kodekontrak='$id'";
    	$cek   = $this->db->query($ce);
    	$cekk  = $cek->row_array();
    	$cekkk = $cekk['jmlcicilan'];
      if($cekkk>1){
    		for ($i=1; $i<=$n; $i++)
    		{
    			$cicilanke   = $this->input->post('cicilanke'.$i);
    			$jatuhtempo  = $this->input->post('jatuhtempo'.$i);
    			$wajibbayar  = $this->input->post('wajibbayar'.$i);

          $data = array(
            'jatuhtempo'  => $jatuhtempo,
            'wajibbayar'  => $wajibbayar
          );

         $simpan =  $this->db->update('detailrencana',$data,array('kodekontrak'=>$id,'cicilanke'=>$cicilanke));
    		}
    		//header("Location: admin-home.php?page=rincian&id=$id");
    		if ($simpan) {
          $this->session->set_flashdata('msg',
         '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check"></i> Data Has Been  Updated !
          </div>');
          redirect('pembayaran/detail/'.$id);

    		}
    	}else if($cekkk<=1){

    		redirect('pembayaran/detail/'.$id);

    	}else{
    		echo "Data Error";
    	}
    }
    }

  function get_lainlain(){
      $url    = base_url();
      $jenis  = 'REGULER';
      $this->datatables->select('nobukti, jenis, tgl, keterangan, bayar, nobtk, terimadari, kasir');
      $this->datatables->from('historibayar');
      $this->datatables->where('jenis !=',$jenis);

      $this->datatables->add_column('view', '
      <a href='.$url.'pembayaran/editbayarlainlain/$1 class="btn bg-blue btn-xs waves-effect hapus"><i class="fa fa-pencil"></i></a>
      <a href='.$url.'pembayaran/cetakbtk/$1 class="btn btn-success btn-xs waves-effect" target="_blank"><i class="fa fa-print"></i></a>
      <a href='.$url.'pembayaran/cetakkwitansi/$1/II class="btn btn-dark btn-xs waves-effect" target="_blank"><i class="fa fa-print"></i></a>
      <a href='.$url.'pembayaran/hapusbayarlainlain/$1 class="btn bg-red btn-xs waves-effect hapus"><i class="fa fa-trash-o"></i></a>
      ', 'nobukti');
      return $this->datatables->generate();
  }

  function get_btk($nobukti){
    $this->db->select('historibayar.nobukti,historibayar.kodekontrak, biaya.tingkat, kontrak.nim, mahasiswa.namamhs, tingkat.namatingkat, mahasiswa.kelas, kelas.kodejur, historibayar.tgl, historibayar.bayar, historibayar.jenis, historibayar.keterangan, historibayar.kasir, historibayar.nobtk, historibayar.nobtb, historibayar.terimadari');
    $this->db->from('historibayar');
    $this->db->join('kontrak','historibayar.kodekontrak = kontrak.kodekontrak');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->join('tingkat','biaya.tingkat = tingkat.tingkat');
    $this->db->join('kelas','mahasiswa.kelas = kelas.kelas');
    $this->db->where('historibayar.nobukti',$nobukti);
    return $this->db->get();
  }

  function inputlainlain(){
    error_reporting(0);
    $tahunskrg      =date("Y");
    $char           = "";
    $tahunkapotong  = substr($tahunskrg,2,2);
  	$q              = "select (SELECT nobukti FROM historibayar where substr(nobukti,1,2)=$tahunkapotong order by nobukti desc limit 1) as idMaks";
  	$h              = $this->db->query($q);
  	$d              = $h->row_array();
  	$ambilnik       = $d['idMaks'];
  	$autonik        = substr($ambilnik,2,5);
  	$noUrut         = (int)($autonik);
  	$noUrut++;
  	//%03s untuk mengatur 3 karakter di belakang
  	$akhir          = $char . sprintf("%05s", $noUrut);
  	$nobuktis       = "$tahunkapotong$akhir";
  	//ambil data value dari setiap name input type
  	//echo $nobukti;
    //autonumber no. btk
		$q2             = "select (SELECT nobtk FROM historibayar order by nobtk desc limit 1) as idMaks";
    $h2             = $this->db->query($q2);
  	$d2             = $h2->row_array();
		$ambilnik2      = $d2['idMaks'];
  	$autonik2       = $ambilnik2;
  	$noUrut2        = (int)($autonik2);
  	$noUrut2++;


  	$nobukti       = $nobuktis;
  	//$cicilanper = $_POST['cicilanper'];
  	$tglbayar      = $this->input->post('tglbayar');
  	$bayar         = str_replace(".","",$this->input->post('bayar'));;
  	$kasir         = $this->input->post('kasir');
  	$pilih         = $this->input->post('pilih');
  	$mbe           = $this->input->post('nobtkbtb');
  	$terimadari    = $this->input->post('terimadari');
    $keterangan    = $this->input->post('ket');
    $pilihjenis    = $this->input->post('pilihjenis');

    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih=="btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}

    $data = array(
            'nobukti'     => $nobukti,
            'tgl'         => $tglbayar,
            'terimadari'  => $terimadari,
            'bayar'       => $bayar,
            'jenis'       => $pilihjenis,
            'Keterangan'  => $keterangan,
            'kasir'       => $kasir,
            'nobtk'       => $nobtk,
            'nobtb'       => $nobtb

    );
    $simpan = $this->db->insert('historibayar',$data);
    if($simpan){
      redirect('pembayaran/lainlain');
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Saved Succesfully !
      </div>');
    }
  }

  function inputbayarpinjaman(){
    error_reporting(0);
    $tahunskrg      =date("Y");
    $char           = "";
    $tahunkapotong  = substr($tahunskrg,2,2);
  	$q              = "select (SELECT nobukti FROM historibayar where substr(nobukti,1,2)=$tahunkapotong order by nobukti desc limit 1) as idMaks";
  	$h              = $this->db->query($q);
  	$d              = $h->row_array();
  	$ambilnik       = $d['idMaks'];
  	$autonik        = substr($ambilnik,2,5);
  	$noUrut         = (int)($autonik);
  	$noUrut++;
  	//%03s untuk mengatur 3 karakter di belakang
  	$akhir          = $char . sprintf("%05s", $noUrut);
  	$nobuktis       = "$tahunkapotong$akhir";
  	//ambil data value dari setiap name input type
  	//echo $nobukti;
    //autonumber no. btk
		$q2             = "select (SELECT nobtk FROM historibayar order by nobtk desc limit 1) as idMaks";
    $h2             = $this->db->query($q2);
  	$d2             = $h2->row_array();
		$ambilnik2      = $d2['idMaks'];
  	$autonik2       = $ambilnik2;
  	$noUrut2        = (int)($autonik2);
  	$noUrut2++;


  	$nobukti       = $nobuktis;
  	//$cicilanper = $_POST['cicilanper'];
  	$tglbayar      = $this->input->post('tglbayar');
    $kodekontrak   = $this->input->post('kodekontrak');
  	$bayar         = str_replace(".","",$this->input->post('bayar'));;
  	$kasir         = $this->input->post('kasir');
  	$pilih         = $this->input->post('pilih');
  	$mbe           = $this->input->post('nobtkbtb');
  	$terimadari    = $this->input->post('terimadari');
    $keterangan    = $this->input->post('ket');
    $pilihjenis    = $this->input->post('pilihjenis');

    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih=="btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}

    $data = array(
            'nobukti'     => $nobukti,
            'kodekontrak' => $kodekontrak,
            'tgl'         => $tglbayar,
            'terimadari'  => $terimadari,
            'bayar'       => $bayar,
            'jenis'       => $pilihjenis,
            'Keterangan'  => $keterangan,
            'kasir'       => $kasir,
            'nobtk'       => $nobtk,
            'nobtb'       => $nobtb

    );
    $simpan = $this->db->insert('historibayar',$data);
    if($simpan){
      redirect('pembayaran/lainlain');
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Saved Succesfully !
      </div>');
    }
  }

  function hapusbayarlainlain($nobukti){
    $hapus = $this->db->delete('historibayar',array('nobukti'=>$nobukti));
    if($hapus){
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Has Been  Deleted !
      </div>');
      redirect('pembayaran/lainlain');
    }
  }


  function update_lainlain(){
    error_reporting(0);
    $nobukti       = $this->input->post('nobukti');
  	$tglbayar      = $this->input->post('tglbayar');
  	$bayar         = str_replace(".","",$this->input->post('bayar'));;
  	$kasir         = $this->input->post('kasir');
  	$pilih         = $this->input->post('pilih');
  	$mbe           = $this->input->post('nobtkbtb');
  	$terimadari    = $this->input->post('terimadari');
    $keterangan    = $this->input->post('ket');
    $pilihjenis    = $this->input->post('pilihjenis');

    if(empty($mbe)){
      $mbe = $noUrut2;
    }else{
      $mbe = $mbe;
    }

    //echo $mbe;

    //die;

    if ($pilih=="btk"){
  		$nobtk  = $mbe;
  		$nobtb  = "";
  		//echo "nobtk : $nobtk, nobtb ga ada";
  	}else if ($pilih=="btb"){
  		$nobtk  = "";
  		$nobtb  = $mbe;
  		//echo "nobtb : $nobtb, nobtk ga ada";
  	}

    $data = array(
            'tgl'         => $tglbayar,
            'terimadari'  => $terimadari,
            'bayar'       => $bayar,
            'jenis'       => $pilihjenis,
            'Keterangan'  => $keterangan,
            'kasir'       => $kasir,
            'nobtk'       => $nobtk,
            'nobtb'       => $nobtb

    );
    $simpan = $this->db->update('historibayar',$data,array('nobukti'=>$nobukti));
    if($simpan){
      redirect('pembayaran/lainlain');
      $this->session->set_flashdata('msg',
     '<div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Data Updated Succesfully !
      </div>');
    }
  }

  function get_mhs($nim){
    return $this->db->get_where('vmhs',array('nim'=>$nim));
  }



  function get_biaya($kodejur,$tingkat,$angkatan){
    return $this->db->get_where('biaya',array('kodejur'=>$kodejur,'tingkat'=>$tingkat,'angkatan'=>$angkatan));
  }

  function insert_regis(){
    $q          = "SELECT kodekontrak FROM kontrak order by kodekontrak desc limit 1";
		$hasil      = $this->db->query($q);
		$data       = $hasil->row_array();
		$ambilnik   = $data['kodekontrak'];
		$autonik    = substr($ambilnik,2,5);
		$noUrut     = (int)($autonik);
		$noUrut++;
		$char       = "";
		$awal       = "RE";
		//%03s untuk mengatur 3 karakter di belakang
		$akhir      = $char . sprintf("%05s", $noUrut);
		$kodekontrak= "$awal$akhir";

    $nim                  = $this->input->post('nim');
  	$kodebiaya            = $this->input->post('kodebiaya');
  	$tglregis             = $this->input->post('tglregis');
  	$gelombang            = $this->input->post('gelombang');
  	$diskongelombang      = str_replace(".","",$this->input->post('potgel'));
  	$diskonprestasi       = str_replace(".","",$this->input->post('potpres'));
  	$diskoncash           = str_replace(".","",$this->input->post('potcash'));
  	$diskonlain           = str_replace(".","",$this->input->post('potlainlain'));
    $peny                 = str_replace(".","",$this->input->post('peny'));
  	$hargadeal            = str_replace(".","",$this->input->post('hargadeal'));
  	$registrasi           = str_replace(".","",$this->input->post('jmlregis'));
  	$jenisregis           = $this->input->post('keterangan');
  	$rencanacicilan       = $this->input->post('jmlcicilan');
  	$cicilanper           = str_replace(".","",$this->input->post('cicilanper'));
  	$tglmulai             = $this->input->post('mulaicicilan');
    $tglreg               = date($tglmulai);
  	$tahun                = substr($tglreg,0,4);
  	$bulan                = substr($tglreg,5,2);
    $krg                  = mktime(0,0,0,date($bulan-1),date(10),date($tahun));
    $tglr                 = date("Y-m-d", $krg);

    $datareg  = array(
      'kodekontrak'     => $kodekontrak,
      'nim'             => $nim,
      'tglregis'        => $tglregis,
      'gelombang'       => $gelombang,
      'kodebiaya'       => $kodebiaya,
      'diskongelombang' => $diskongelombang,
      'diskonprestasi'  => $diskonprestasi,
      'diskoncash'      => $diskoncash,
      'diskonlain'      => $diskonlain,
      'penyesuaian'     => $peny,
      'hargadeal'       => $hargadeal,
      'registrasi'      => $registrasi,
      'rencanacicilan'  => $rencanacicilan,
      'cicilanper'      => $cicilanper,
      'jenisregis'      => $jenisregis

    );

    $datadetailrencana = array(

      'kodekontrak' => $kodekontrak,
      'cicilanke'   => 0,
      'jatuhtempo'  => $tglr,
      'wajibbayar'  => $registrasi

    );

    $simpanreg      = $this->db->insert('kontrak',$datareg);
    $simpanrencana  = $this->db->insert('detailrencana',$datadetailrencana);
    for ($i=1; $i<=$rencanacicilan; $i++)
    {

      $tambah = mktime(0,0,0,date($bulan),date(10),date($tahun));
      $tglkem = date("Y-m-d", $tambah);

      $datadetailrencana2 = array(

        'kodekontrak' => $kodekontrak,
        'cicilanke'   => $i,
        'jatuhtempo'  => $tglkem,
        'wajibbayar'  => $cicilanper

      );
      $simpanrencana2 = $this->db->insert('detailrencana',$datadetailrencana2);
      $bulan++;
    }

    if($simpanreg && $simpanrencana){
      if($jenisregis == 'DANAPINJAMAN'){
        redirect('pembayaran/editrencanapinjaman/'.$kodekontrak);
      }else{
        redirect('pembayaran/editrencana/'.$kodekontrak);
      }
    }
  }


  function update_regis(){

    $kodekontrak          = $this->input->post('kodekontrak');
    $nim                  = $this->input->post('nim');
  	$kodebiaya            = $this->input->post('kodebiaya');
  	$tglregis             = $this->input->post('tglregis');
  	$gelombang            = $this->input->post('gelombang');
  	$diskongelombang      = str_replace(".","",$this->input->post('potgel'));
  	$diskonprestasi       = str_replace(".","",$this->input->post('potpres'));
  	$diskoncash           = str_replace(".","",$this->input->post('potcash'));
  	$diskonlain           = str_replace(".","",$this->input->post('potlainlain'));
  	$hargadeal            = str_replace(".","",$this->input->post('hargadeal'));
  	$registrasi           = str_replace(".","",$this->input->post('jmlregis'));
  	$jenisregis           = $this->input->post('keterangan');
  	$rencanacicilan       = $this->input->post('jmlcicilan');
  	$cicilanper           = str_replace(".","",$this->input->post('cicilanper'));
  	$tglmulai             = $this->input->post('mulaicicilan');
    $tglreg               = date($tglmulai);
  	$tahun                = substr($tglreg,0,4);
  	$bulan                = substr($tglreg,5,2);
    $krg                  = mktime(0,0,0,date($bulan-1),date(10),date($tahun));
    $tglr                 = date("Y-m-d", $krg);

    $datareg  = array(

      'tglregis'        => $tglregis,
      'gelombang'       => $gelombang,
      'kodebiaya'       => $kodebiaya,
      'diskongelombang' => $diskongelombang,
      'diskonprestasi'  => $diskonprestasi,
      'diskoncash'      => $diskoncash,
      'diskonlain'      => $diskonlain,
      'hargadeal'       => $hargadeal,
      'registrasi'      => $registrasi,
      'rencanacicilan'  => $rencanacicilan,
      'cicilanper'      => $cicilanper,
      'jenisregis'      => $jenisregis

    );

    $datadetailrencana = array(

      'kodekontrak' => $kodekontrak,
      'cicilanke'   => 0,
      'jatuhtempo'  => $tglr,
      'wajibbayar'  => $registrasi

    );

    $simpanreg      = $this->db->update('kontrak',$datareg,array('kodekontrak'=>$kodekontrak));
    $simpanrencana  = $this->db->insert('temp_detailrencana',$datadetailrencana);
    for ($i=1; $i<=$rencanacicilan; $i++)
    {

      $tambah = mktime(0,0,0,date($bulan),date(10),date($tahun));
      $tglkem = date("Y-m-d", $tambah);

      $datadetailrencana2 = array(

        'kodekontrak' => $kodekontrak,
        'cicilanke'   => $i,
        'jatuhtempo'  => $tglkem,
        'wajibbayar'  => $cicilanper

      );
      $simpanrencana2 = $this->db->insert('temp_detailrencana',$datadetailrencana2);
      $bulan++;
    }

    if($simpanreg && $simpanrencana){
      redirect('pembayaran/editrencana2/'.$kodekontrak);
    }
  }

  function updaterencana2(){
    $id           = $this->input->post('id');
    $n            = $this->input->post('rencanacicilan');
    $total        = $this->input->post('total');
    //echo $id;
    $cicilanke0     = $this->input->post('cicilanke0');
  	$jatuhtempo0    = $this->input->post('jatuhtempo0');
  	$wajibbayar0    = $this->input->post('wajibbayar0');
    $tot  = 0;
    for ($i=0; $i<=$n; $i++)
  	{
  		$wajibbayar   = $this->input->post('wajibbayar'.$i);
  		$tot          = $tot  + $wajibbayar;
  		//echo "cic ke $i = $tot <br>";
  	}

    if($tot!=$total){
    	//echo "total : $tot <br>";
    	//echo "deal : $total";
      $this->session->set_flashdata('msg',
     '<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i> Jumlah Rencana Melebihi Total Pembayaran !
      </div>');
    	redirect('pembayaran/editrencana/'.$id);
    }else{
      //echo "total : $tot <br>";
    	//echo "deal : $total";

      $delete = $this->db->delete('detailrencana',array('kodekontrak'=>$id));
      $delete = $this->db->delete('temp_detailrencana',array('kodekontrak'=>$id));
      $data = array(
        'kodekontrak' => $id,
        'cicilanke'   => $cicilanke0,
        'jatuhtempo'  => $jatuhtempo0,
        'wajibbayar'  => $wajibbayar0
      );

      $simpan = $this->db->insert('detailrencana',$data);

    		for ($i=1; $i<=$n; $i++)
    		{
    			$cicilanke   = $this->input->post('cicilanke'.$i);
    			$jatuhtempo  = $this->input->post('jatuhtempo'.$i);
    			$wajibbayar  = $this->input->post('wajibbayar'.$i);

          $data2 = array(
            'kodekontrak' => $id,
            'cicilanke'   => $cicilanke,
            'jatuhtempo'  => $jatuhtempo,
            'wajibbayar'  => $wajibbayar
          );

          $this->db->insert('detailrencana',$data2);
    		}
    		//header("Location: admin-home.php?page=rincian&id=$id");
    		if ($simpan) {
          $this->session->set_flashdata('msg',
         '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check"></i> Data Has Been  Updated !
          </div>');
          redirect('pembayaran/detail/'.$id);

    		}

    }
  }

  function hapusregistrasi($kodekontrak){
    $hapuskontrak = $this->db->delete('kontrak',array('kodekontrak'=>$kodekontrak));
    if($hapuskontrak){
      $hapusdetailrencana = $this->db->delete('detailrencana',array('kodekontrak'=>$kodekontrak));
      if($hapusdetailrencana){
        $hapushistori = $this->db->delete('historibayar',array('kodekontrak'=>$kodekontrak));
        if($hapushistori){
          $this->session->set_flashdata('msg',
         '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check"></i> Data Has Been  Deleted !
          </div>');
          redirect('dashboard');
        }
      }
    }
  }

  function getDatapinjaman(){
    $this->db->select('kontrak.kodekontrak,kontrak.nim,namamhs,mahasiswa.ket,mahasiswa.kelas,biaya,gelombang,diskongelombang,diskonprestasi,diskoncash,diskonlain,hargadeal,registrasi,(select sum(wajibbayar) as meng from detailrencana where kodekontrak=kontrak.kodekontrak) as meng,(select sum(bayar) as jumlahbayar from historibayar where kodekontrak=kontrak.kodekontrak AND jenis="DANAPINJAMAN") as jumlahbayar');
    $this->db->from('kontrak');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->where('kontrak.jenisregis','DANAPINJAMAN');
    $this->db->order_by('namamhs');
    return $this->db->get();
  }

  function getReguler($kodekontrak){
    $this->db->order_by('nobukti');
    return $this->db->get_where('historibayar',array('jenis'=>'REGULER','kodekontrak'=>$kodekontrak));
  }


  function getDp($kodekontrak){
    $this->db->order_by('nobukti');
    return $this->db->get_where('historibayar',array('jenis'=>'DANAPINJAMAN','kodekontrak'=>$kodekontrak));
  }


}
