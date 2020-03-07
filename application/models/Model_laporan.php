<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_laporan extends CI_Model {
  function __construct() {
    parent::__construct();
  }

	function get_kasir(){
    return $this->db->get_where('user',array('role'=>'admin'));
  }

  function get_profesi($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
      $this->db->order_by('nobukti,nobtk','asc');
    $this->db->join('kontrak','historibayar.kodekontrak = kontrak.kodekontrak');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->where('tingkat','1');
    $this->db->or_where('tingkat','2');
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    return $this->db->get('historibayar');

  }


  function get_tingkat3($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    $this->db->join('kontrak','historibayar.kodekontrak = kontrak.kodekontrak');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->where('tingkat','3');
    return $this->db->get('historibayar');

  }

  function get_tingkat4($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="REGULER"){
      $this->db->where('jenis','REGULER');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    $this->db->join('kontrak','historibayar.kodekontrak = kontrak.kodekontrak');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->where('tingkat','4');
    return $this->db->get('historibayar');

  }

  function get_karyawan($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="KARYAWAN"){
      $this->db->where('jenis','KARYAWAN');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_sewa($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="SEWA"){
      $this->db->where('jenis','SEWA');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_parkir($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="PARKIR"){
      $this->db->where('jenis','PARKIR');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_iht($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="IHT"){
      $this->db->where('jenis','IHT');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_kursus($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="KURSUS"){
      $this->db->where('jenis','KURSUS');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }

  function get_lainlain($dari,$sampai,$jenis="",$kasir=""){
    $this->db->where('tgl >=',$dari);
    $this->db->where('tgl <=',$sampai);

    if(empty($jenis) OR $jenis =="LAINLAIN"){
      $this->db->where('jenis','LAINLAIN');
    }else{
      $this->db->where('jenis','');
    }
    if($kasir !=""){
      $this->db->where('kasir',$kasir);
    }
    $this->db->order_by('nobukti,nobtk','asc');
    return $this->db->get('historibayar');

  }


  function getangkatan(){
    $this->db->select('angkatan');
    $this->db->group_by('angkatan');
    return $this->db->get('biaya');
  }

  function gettingkat(){
    return $this->db->get('tingkat');
  }

  function getjurusan($ta,$tingkat){
    $this->db->select('kelas.kodejur,namajur');
    $this->db->from('kontrak');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->join('kelas','mahasiswa.kelas = kelas.kelas');
    $this->db->join('jurusan','kelas.kodejur = jurusan.kodejur');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->where('biaya.angkatan',$ta);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->group_by('kelas.kodejur');
    return $this->db->get();
  }

  function getKelas($ta,$tingkat,$jurusan){
    $this->db->select('mahasiswa.kelas');
    $this->db->from('kontrak');
    $this->db->join('mahasiswa','kontrak.nim = mahasiswa.nim');
    $this->db->join('kelas','mahasiswa.kelas = kelas.kelas');
    $this->db->join('jurusan','kelas.kodejur = jurusan.kodejur');
    $this->db->join('biaya','kontrak.kodebiaya = biaya.kodebiaya');
    $this->db->where('biaya.angkatan',$ta);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->where('kelas.kodejur',$jurusan);
    $this->db->group_by('mahasiswa.kelas');
    return $this->db->get();
  }

  function getPA($kelas){
    $this->db->select('nama');
    $this->db->from('kelas');
    $this->db->join('user','kelas.userid = user.userid');
    $this->db->where('kelas',$kelas);
    return $this->db->get();
  }

  function getBiayanormal($kodejur,$tingkat,$ang){
    $this->db->select('biaya.kodejur,biaya,namatingkat,biaya.angkatan');
    $this->db->from('biaya');
    $this->db->join('tingkat','biaya.tingkat = tingkat.tingkat');
    $this->db->where('kodejur',$kodejur);
    $this->db->where('biaya.tingkat',$tingkat);
    $this->db->where('biaya.angkatan',$ang);
    return $this->db->get();

  }


  function getKlas($kelas){
    return $this->db->get_where('kelas',array('kelas'=>$kelas));
  }

  function cetaklaporankelas_hp($ang,$tingkat,$kelas,$batas){

    $query = "SELECT kodekontrak,mahasiswa.nim,namamhs,namaorgtua,kelas,kelas_senior,ket,telepon,noorgtua,sumwb,jenisregis,IFNULL(meng,0) as meng,IFNULL(sumbayar,0) as sumbayar,IFNULL(sumwbnow,0) as sumwbnow
              FROM mahasiswa
              LEFT JOIN
              (
              	SELECT
              	kontrak.kodekontrak,
              	kontrak.nim,
              	hargadeal AS sumwb,
              	jenisregis,
              	meng,
              	sumbayar,
              	sumwbnow
              FROM
              	kontrak
              	INNER JOIN biaya ON kontrak.kodebiaya = biaya.kodebiaya
              	INNER JOIN ( SELECT kodekontrak, SUM( wajibbayar ) AS meng FROM detailrencana GROUP BY kodekontrak ) dr ON ( kontrak.kodekontrak = dr.kodekontrak )
              	LEFT JOIN ( SELECT kodekontrak, SUM( bayar ) AS sumbayar FROM historibayar GROUP BY kodekontrak ) hb ON ( kontrak.kodekontrak = hb.kodekontrak )
              	LEFT JOIN ( SELECT kodekontrak, SUM( wajibbayar ) AS sumwbnow FROM detailrencana WHERE jatuhtempo <= '$batas' GROUP BY kodekontrak ) dr2 ON ( kontrak.kodekontrak = dr2.kodekontrak )
              WHERE
              	biaya.angkatan = '$ang'
              	AND biaya.tingkat = '$tingkat'
              	) k ON (mahasiswa.nim = k.nim)

              	WHERE mahasiswa.kelas ='$kelas' ORDER BY kelas_senior,namamhs ASC
              ";
    return $this->db->query($query);
  }
  function cetaklaporankelas_hplalu($ang,$tingkat,$kelas,$batas,$nim){
    $tingkat = $tingkat-1;
    $ang = $ang-1;

    $query = "SELECT kodekontrak,mahasiswa.nim,namamhs,kelas,kelas_senior,ket,telepon,noorgtua,sumwb,jenisregis,IFNULL(meng,0) as meng,IFNULL(sumbayar,0) as sumbayar,IFNULL(sumwbnow,0) as sumwbnow
              FROM mahasiswa
              LEFT JOIN
              (
                SELECT
                kontrak.kodekontrak,
                kontrak.nim,
                hargadeal AS sumwb,
                jenisregis,
                meng,
                sumbayar,
                sumwbnow
              FROM
                kontrak
                INNER JOIN biaya ON kontrak.kodebiaya = biaya.kodebiaya
                INNER JOIN ( SELECT kodekontrak, SUM( wajibbayar ) AS meng FROM detailrencana GROUP BY kodekontrak ) dr ON ( kontrak.kodekontrak = dr.kodekontrak )
                LEFT JOIN ( SELECT kodekontrak, SUM( bayar ) AS sumbayar FROM historibayar GROUP BY kodekontrak ) hb ON ( kontrak.kodekontrak = hb.kodekontrak )
                LEFT JOIN ( SELECT kodekontrak, SUM( wajibbayar ) AS sumwbnow FROM detailrencana WHERE jatuhtempo <= '$batas' GROUP BY kodekontrak ) dr2 ON ( kontrak.kodekontrak = dr2.kodekontrak )
              WHERE
                biaya.angkatan = '$ang'
                AND biaya.tingkat = '$tingkat'
                ) k ON (mahasiswa.nim = k.nim)

                WHERE mahasiswa.kelas ='$kelas' AND mahasiswa.nim='$nim' ORDER BY kelas_senior,namamhs ASC
              ";
    return $this->db->query($query);
  }

  function getQuery($angkatan,$tingkat){
    $query ="select `kontrak`.`kodekontrak` AS `kode2`,
    `kontrak`.`nim` AS `nim`,
    `kontrak`.`kodebiaya` AS `kodebiaya`,
    `biaya`.`angkatan` AS `angkatan`,
    `biaya`.`tingkat` AS `tingkat`,
    `tingkat`.`namatingkat` AS `namatingkat`,
    `biaya`.`biaya` AS `biaya`,
    `kontrak`.`diskongelombang` AS `diskongelombang`,
    `kontrak`.`diskonprestasi` AS `diskonprestasi`,
    `kontrak`.`diskoncash` AS `diskoncash`,
    `kontrak`.`diskonlain` AS `diskonlain`,
    `kontrak`.`hargadeal` AS `hargadeal`,
    `kontrak`.`registrasi` AS `registrasi`,
    (select (`biaya`.`biaya` - `kontrak`.`diskongelombang`)) AS `rencanabayar`,
    (select `detailrencana`.`jatuhtempo` from `detailrencana` where (`detailrencana`.`kodekontrak` = `kode2`) order by `detailrencana`.`jatuhtempo` limit 1) AS `cicpertama`,
    concat_ws('-',year((select `cicpertama`)),'06','31') AS `akhirjun`
    from (((((`mahasiswa` join `kontrak`) join `kelas`) join `biaya`) join `tingkat`) join `jurusan`)
    where ((`mahasiswa`.`nim` = `kontrak`.`nim`)
    and (`kelas`.`kelas` = `mahasiswa`.`kelas`)
    and (`biaya`.`kodebiaya` = `kontrak`.`kodebiaya`)
    and (`biaya`.`tingkat` = `tingkat`.`tingkat`) and (`kelas`.`kodejur` = `jurusan`.`kodejur`)

    and (`biaya`.`tingkat` = '$tingkat')
    and biaya.angkatan='$angkatan')";
    return $this->db->query($query);
  }





}
