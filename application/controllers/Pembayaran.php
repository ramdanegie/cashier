<?php

class Pembayaran extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_pembayaran'));
  }

	function pmbmhs(){
		$data['status']   = $this->uri->segment(3);
		$data['tingkat']	= $this->uri->segment(4);
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$this->template->display('pembayaran/pembayaran', $data);
	}

	function belumregis(){
		$data['status']   = $this->uri->segment(3);
		$data['tingkat']	= $this->uri->segment(4);
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['belregis'] = $this->Model_pembayaran->get_belumregis($data['status'],$data['tingkat'])->result();
		$this->template->display('pembayaran/belumregis', $data);
	}

	function inputregis(){
		$nim 							= $this->uri->segment(3);
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$reg 							= $this->Model_pembayaran->get_mhs($nim)->row_array();
		$tingkat 					= $reg['tingkat'];
		$angkatan 				= $reg['angkatan'];
		$kodejur 					= $reg['kodejur'];
		$data['biaya']		= $this->Model_pembayaran->get_biaya($kodejur,$tingkat,$angkatan)->row_array();
		$data['reg']			= $reg;
		$this->template->display('pembayaran/registrasi', $data);
	}

	function get_pembayaran() {
		header('Content-Type: application/json');
		$status  = $this->uri->segment(3);
		$tingkat = $this->uri->segment(4);
		echo $this->Model_pembayaran->get($status,$tingkat);
	}

	function get_pembayaranall() {
		header('Content-Type: application/json');
		echo $this->Model_pembayaran->getall();
	}



	function detail(){
		$kodereg 						= $this->uri->segment(3);
		$data['username'] 	= $this->access->get_username();
    $data['fullname'] 	= $this->access->get_fullname();
    $data['level']	  	= $this->access->get_level();
		$data['reg']				= $this->Model_pembayaran->get_reg($kodereg)->row_array();
		$data['hb']					= $this->Model_pembayaran->getJmlbayar($kodereg)->row_array();
		$data['ren']				= $this->Model_pembayaran->get_ren($kodereg)->result();
		$data['jmlcicilan']	= $this->Model_pembayaran->get_jmlcicilan($kodereg)->num_rows();
		$data['hbayar']			= $this->Model_pembayaran->get_historibayar($kodereg);
		$data['kodereg']		= $kodereg;
		$jam 								= date("H:i:s");
	//$jam = "15:00:01";
		$jam2 							= "15:00:00";
		$tglnyunyu 					= date("Y-m-d");
		$tglnyonyo 					= date('Y-m-d', strtotime('+1 days', strtotime($tglnyunyu)));
		if($jam > $jam2){
			$tglmeng = $tglnyonyo;
		}else{
			$tglmeng = $tglnyunyu;
		}

		$data['tglmeng']		= $tglmeng;
		$this->template->display('pembayaran/detail',$data);
	}

	function bayar(){
		$this->Model_pembayaran->bayar();
	}

	function hapusbayar(){
		$nobukti 	= $this->uri->segment(3);
		$kodereg  = $this->uri->segment(4);
		$this->Model_pembayaran->hapusbayar($nobukti,$kodereg);
	}

	function editbayar(){
		$nobukti 						= $this->uri->segment(3);
		$data['fullname'] 	= $this->access->get_fullname();
		$data['hb']					= $this->Model_pembayaran->getHB($nobukti)->row_array();
		$this->load->view('pembayaran/editbayar',$data);
	}

	function updatebayar(){
		$this->Model_pembayaran->updatebayar();
	}

	function cetakkwitansi(){
		$nobukti  	= $this->uri->segment(3);
		$jn 				= $this->uri->segment(4);
		$data['jn']	= $jn;
		if($jn ==""){

			$data['kw'] = $this->Model_pembayaran->cetakkwitansi1($nobukti)->row_array();
		}else if($jn=="II"){
			$data['kw'] = $this->Model_pembayaran->cetakkwitansi2($nobukti)->row_array();
			//echo "2";
		}

		$this->load->view('pembayaran/kwitansi',$data);
	}

	function cetakbtk(){
		$nobukti  			= $this->uri->segment(3);
		$cek 						= $this->db->get_where('historibayar',array('nobukti'=>$nobukti))->row_array();
		if($cek['kodekontrak']==""){
			$data['data'] = $cek;
		}else{
			$data['data'] = $this->Model_pembayaran->get_btk($nobukti)->row_array();
		}
		$this->load->view('pembayaran/btk',$data);
	}
	function editrencana(){
		$kodereg 						= $this->uri->segment(3);
		$data['id']					= $kodereg;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['data2']			= $this->Model_pembayaran->get_rencana($kodereg)->row_array();
		$data['ren']				= $this->Model_pembayaran->get_ren2($kodereg)->result();
		$this->template->display('pembayaran/editrencana',$data);
	}

	function editrencanapinjaman(){
		$kodereg 						= $this->uri->segment(3);
		$data['id']					= $kodereg;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['data2']			= $this->Model_pembayaran->get_rencana($kodereg)->row_array();
		$data['ren']				= $this->Model_pembayaran->get_ren2($kodereg)->result();
		$this->template->display('pembayaran/editrencanapinjaman',$data);
	}



	function updaterencana(){
		$this->Model_pembayaran->updaterencana();
	}

	function updaterencanapinjaman(){
		$this->Model_pembayaran->updaterencanapinjaman();
	}

	function lainlain(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$jam 								= date("H:i:s");
	//$jam = "15:00:01";
		$jam2 							= "15:00:00";
		$tglnyunyu 					= date("Y-m-d");
		$tglnyonyo 					= date('Y-m-d', strtotime('+1 days', strtotime($tglnyunyu)));
		if($jam > $jam2){
			$tglmeng = $tglnyonyo;
		}else{
			$tglmeng = $tglnyunyu;
		}

		$data['tglmeng']		= $tglmeng;
		$this->template->display('pembayaran/lainlain', $data);
	}

	function get_lainlain(){
		header('Content-Type: application/json');
		echo $this->Model_pembayaran->get_lainlain();
	}

	function inputlainlain(){
		$this->Model_pembayaran->inputlainlain();
	}

	function inputbayarpinjaman(){
		$this->Model_pembayaran->inputbayarpinjaman();
	}

	function hapusbayarlainlain(){
		$nobukti 	= $this->uri->segment(3);
		$this->Model_pembayaran->hapusbayarlainlain($nobukti);
	}

	function editbayarlainlain(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$nobukti  				= $this->uri->segment(3);
		$data['hb']				= $this->Model_pembayaran->getHB($nobukti)->row_array();
		$this->template->display('pembayaran/editbayarlainlain',$data);
	}

	function update_lainlain(){
		$this->Model_pembayaran->update_lainlain();
	}

	function getselisih(){
		$tglmulai = $this->input->post('tglmulai');
		$tglreg		= date($tglmulai);
		$tahun		= substr($tglreg,0,4);
		$bulan		= substr($tglreg,5,2);
		//$hari=substr($tglregis,8,2);
		$a 				= mktime(0,0,0,date($bulan),0,date($tahun));
		$b 				= mktime(0,0,0,date(07),0,date($tahun+1));
		$selisih	= round(($b-$a) / 60 / 60 / 24 / 30);

		echo $selisih;
	}


	function insert_regis(){
		$this->Model_pembayaran->insert_regis();
	}

	function editregistrasi(){
		$kodereg 						= $this->uri->segment(3);
		$data['id']					= $kodereg;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$reg 								= $this->Model_pembayaran->get_reg($kodereg)->row_array();
		$data['reg']				= $reg;
		$this->template->display('pembayaran/editregistrasi',$data);
	}

	function update_regis(){
		$this->Model_pembayaran->update_regis();
	}

	function editrencana2(){
		$kodereg 						= $this->uri->segment(3);
		$data['id']					= $kodereg;
		$data['username'] 	= $this->access->get_username();
		$data['fullname'] 	= $this->access->get_fullname();
		$data['level']	  	= $this->access->get_level();
		$data['data2']			= $this->Model_pembayaran->get_rencana($kodereg)->row_array();
		$data['ren']				= $this->Model_pembayaran->get_ren2($kodereg)->result();
		$data['ren2']				= $this->Model_pembayaran->get_rentemp($kodereg)->result();
		$this->template->display('pembayaran/editrencana2',$data);
	}

	function updaterencana2(){
		$this->Model_pembayaran->updaterencana2();
	}

	function hapusregistrasi(){
		$kodekontrak = $this->uri->segment(3);
		$this->Model_pembayaran->hapusregistrasi($kodekontrak);
	}

	function inputregispinjaman(){
		$nim 							= $this->uri->segment(3);
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$reg 							= $this->Model_pembayaran->get_mhs($nim)->row_array();
		$tingkat 					= $reg['tingkat'];
		$angkatan 				= $reg['angkatan'];
		$kodejur 					= $reg['kodejur'];
		$data['biaya']		= $this->Model_pembayaran->get_biaya($kodejur,$tingkat,$angkatan)->row_array();
		$data['reg']			= $reg;
		$this->template->display('pembayaran/registrasipinjaman', $data);
	}

	function bayarpinjaman(){
		$data['username'] = $this->access->get_username();
		$data['fullname'] = $this->access->get_fullname();
		$data['level']	  = $this->access->get_level();
		$data['dp']				= $this->Model_pembayaran->getDatapinjaman();
		$jam 								= date("H:i:s");
	//$jam = "15:00:01";
		$jam2 							= "15:00:00";
		$tglnyunyu 					= date("Y-m-d");
		$tglnyonyo 					= date('Y-m-d', strtotime('+1 days', strtotime($tglnyunyu)));
		if($jam > $jam2){
			$tglmeng = $tglnyonyo;
		}else{
			$tglmeng = $tglnyunyu;
		}

		$data['tglmeng']		= $tglmeng;

		$this->template->display('pembayaran/bayarpinjaman',$data);
	}

	function historibayarpinjaman(){
		$kodekontrak 	= $this->uri->segment(3);
		$data['reg']	= $this->Model_pembayaran->getReguler($kodekontrak)->result();
		$data['dp']		= $this->Model_pembayaran->getDp($kodekontrak)->result();
		$this->load->view('pembayaran/historibayarpinjaman',$data);
	}

}
