<?php

class Laporan extends MY_Core {
	function __construct() {
    parent:: __construct();
    $this->load->model(array('Model_laporan','Model_pembayaran'));
  }

	function rincianpembayaran(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$this->template->display('laporan/rincian', $data);
	}

	function historibayar(){

		$dari 						= "";
    $sampai 					= "";
    $jenis    				= "";
		$kasir 						= "";

		if(isset($_POST['submit']) ){
			$dari 		= $this->input->post('dari');
			$sampai 	= $this->input->post('sampai');
			$jenis  	= $this->input->post('jenis');
			$kasir  	= $this->input->post('kasir');
			$data 	= array(

					'dari'	 			=> $dari,
					'sampai'	 		=> $sampai,
					'jenis'     	=> $jenis,
					'kasir'				=> $kasir

			);
			$this->session->set_userdata($data);
		}else{
			if($this->session->userdata('dari') != NULL){
				$dari = $this->session->userdata('dari');
			}

			if($this->session->userdata('sampai') != NULL){
				$sampai = $this->session->userdata('sampai');
			}

			if($this->session->userdata('jenis') != NULL){
				$jenis = $this->session->userdata('jenis');
			}

			if($this->session->userdata('kasir') != NULL){
				$kasir  = $this->session->userdata('kasir');
			}
		}

		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['kasir']		= $this->Model_laporan->get_kasir();
		$data['profesi']	= $this->Model_laporan->get_profesi($dari,$sampai,$jenis,$kasir);
		$data['tingkat3']	= $this->Model_laporan->get_tingkat3($dari,$sampai,$jenis,$kasir);
		$data['tingkat4']	= $this->Model_laporan->get_tingkat4($dari,$sampai,$jenis,$kasir);
		$data['karyawan']	= $this->Model_laporan->get_karyawan($dari,$sampai,$jenis,$kasir);
		$data['sewa']			= $this->Model_laporan->get_sewa($dari,$sampai,$jenis,$kasir);
		$data['parkir']		= $this->Model_laporan->get_parkir($dari,$sampai,$jenis,$kasir);
		$data['iht']			= $this->Model_laporan->get_iht($dari,$sampai,$jenis,$kasir);
		$data['kursus']		= $this->Model_laporan->get_kursus($dari,$sampai,$jenis,$kasir);
		$data['lainlain']	= $this->Model_laporan->get_lainlain($dari,$sampai,$jenis,$kasir);
		$data['dari']			= $dari;
		$data['sampai']		= $sampai;
		$data['jenis']		= $jenis;
		$data['ksr']			= $kasir;

		if(isset($_POST['excel'])){
			// Fungsi header dengan mengirimkan raw data excel
			header("Content-type: application/vnd-ms-excel");
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=Laporan Histori Bayar.xls");
			$this->load->view('laporan/exporthistoribayar',$data);
		}else{
			$this->template->display('laporan/historibayar', $data);
		}
	}

	function laporankelas(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['angkatan'] = $this->Model_laporan->getangkatan()->result();
		$data['tingkat']	= $this->Model_laporan->gettingkat()->result();
		$this->template->display('laporan/laporankelas', $data);
	}


	function gettingkat2(){
		$tingkats	= $this->input->post('tingkats');
		$tingkat 	= $this->db->get('tingkat')->result();
		echo "<option value=''>-- Tingkat --</option>";
		foreach ($tingkat as $t ) {
			if($tingkats == $t->tingkat){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option $selected  value='$t->tingkat'>".$t->namatingkat."</option>";
		}
	}
	function gettingkat(){
		$tingkat = $this->db->get('tingkat')->result();
		echo "<option value=''>-- Tingkat --</option>";
		foreach ($tingkat as $t ) {

			echo "<option   value='$t->tingkat'>".$t->namatingkat."</option>";
		}
	}

	function getjurusan(){
		$ta 			= $this->input->post('ta');
		$tingkat	= $this->input->post('tingkat');
		$jurusan  = $this->Model_laporan->getjurusan($ta,$tingkat)->result();
		echo "<option value=''>-- Jurusan --</option>";
		foreach ($jurusan as $j ) {
			echo "<option value='$j->kodejur'>".$j->namajur."</option>";
		}
	}

	function getjurusan2(){
		$ta 			= $this->input->post('ta');
		$tingkat	= $this->input->post('tingkat');
		$jurusan  = $this->Model_laporan->getjurusan($ta,$tingkat)->result();
		$jurusans = $this->input->post('jurusans');
		echo "<option value=''>-- Jurusan --</option>";
		foreach ($jurusan as $j ) {
			if($jurusans == $j->kodejur){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value='$jurusans'>".$j->namajur."</option>";
		}
	}

	function getKelas(){
		$ta 			= $this->input->post('ta');
		$tingkat	= $this->input->post('tingkat');
		$jurusan	= $this->input->post('jurusan');
		$kelas  	= $this->Model_laporan->getKelas($ta,$tingkat,$jurusan)->result();
		echo "<option value=''>-- Kelas --</option>";
		foreach ($kelas as $k ) {
			echo "<option value='$k->kelas'>".$k->kelas."</option>";
		}
	}

	function getjenislaporan(){
		echo '
		<option value="">-- Jenis Laporan --</option>
		<option value="0">Laporan Tunggakan Biasa (dengan No. HP)</option>
		<option value="1">Laporan Tunggakan Secara Rinci</option>
		<option value="2">Laporan Tunggakan Sampai Akhir Periode</option>
		<option value="4">Laporan Tunggakan Keterangan Lunas</option>
		<option value="5">Laporan Harga Deal dan Tunggakan</option>
		';
	}


	function cetaklaporankelas(){
		$ang 		 							= $this->input->post('tahunajaran');
		$tingkat 							= $this->input->post('tingkat');
		$data['tingkat']			= $tingkat;
		$kelas	 							= $this->input->post('kelas');
		$data['fullname'] 		= $this->access->get_fullname();
		$akhirangkatan				= $ang+1;
		$laporan							= $this->input->post('jenislaporan');
		$data['tahunajaran']	= $ang."/".$akhirangkatan;
		$data['kelas']				= $kelas;
		$batastgl 					  = $this->input->post('batastgl');
		$kls									= $this->Model_laporan->getKlas($kelas)->row_array();
		$kodejur 							= $kls['kodejur'];
		$data['pa']						= $this->Model_laporan->getPA($kelas)->row_array();
		$data['biaya']				= $this->Model_laporan->getBiayanormal($kodejur,$tingkat,$ang)->row_array();
		$data['batas']				= $batastgl;
		$data['ang']				= $ang;


		if ($laporan=='0'){
			$data['cetak0'] 			= $this->Model_laporan->cetaklaporankelas_hp($ang,$tingkat,$kelas,$batastgl)->result();
			$this->load->view('laporan/cetaklaporankelas_hp',$data);
		}else if ($laporan=='1'){
			$this->load->view('laporan/cetaklaporankelas_rinci',$data);
		}else if ($laporan=='2'){
			$data['cetak0'] 			= $this->Model_laporan->cetaklaporankelas_hp($ang,$tingkat,$kelas,$batastgl)->result();
			$this->load->view('laporan/cetaklaporankelas_akhirperiode',$data);
		}else if ($laporan=='3'){
		}else if ($laporan=='4'){
			$data['cetak0'] 			= $this->Model_laporan->cetaklaporankelas_hp($ang,$tingkat,$kelas,$batastgl)->result();
			$this->load->view('laporan/cetaklaporankelas_lunas',$data);
		}else if ($laporan=='5'){
			$data['cetak0'] 			= $this->Model_laporan->cetaklaporankelas_hp($ang,$tingkat,$kelas,$batastgl)->result();
			$this->load->view('laporan/cetaklaporankelas_deal',$data);
		}

	}

	function surattagihan(){


		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['angkatan'] = $this->Model_laporan->getangkatan()->result();

		$this->template->display('laporan/surattagihan', $data);
	}


	function loaddatatunggakan(){
		$ang 		 							= $this->input->post('ang');
		$tingkat 							= $this->input->post('tingkat');
		$kelas	 							= $this->input->post('kelas');
		$batastgl 						= $this->input->post('batastgl');
		$data['surat'] 				= $this->input->post('surat');
		$data['cetak0'] 			= $this->Model_laporan->cetaklaporankelas_hp($ang,$tingkat,$kelas,$batastgl)->result();
		$this->load->view('laporan/loaddatatunggakan',$data);
	}


	function cetak_surattagihan(){
		error_reporting(0);
		$kodekontrak 			= $this->input->post('kodekontrak');
		$data['kode']			= $kodekontrak;
		$batastgl 				= $this->input->post('batastgl');
		$data['batas']		= $batastgl;
		$data['fullname'] = $this->access->get_fullname();
		$data['tagian']		= "";
		$data['pilihsurat'] = $this->input->post('surat');
		if(isset($_POST['submit'])){
			$this->load->view('laporan/cetak_surattagihan',$data);
		}

	}


	function rpt(){
		$data['username'] = $this->access->get_username();
    $data['fullname'] = $this->access->get_fullname();
    $data['level']	  = $this->access->get_level();
		$data['angkatan'] = $this->Model_laporan->getangkatan()->result();
		$this->template->display('laporan/rpt', $data);
	}


	function loadrencana(){
		$angkatan 				= $this->uri->segment(3);
		$data['query']		= $this->Model_laporan->getQuery($angkatan,1)->result();
		$data['query2']		= $this->Model_laporan->getQuery($angkatan,2)->result();
		$data['query3']		= $this->Model_laporan->getQuery($angkatan,3)->result();
		$data['query4']		= $this->Model_laporan->getQuery($angkatan,4)->result();
		$this->load->view('laporan/loadrencana',$data);
	}


	function cetakrincian(){
		$nim 					= $this->uri->segment('3');
		$data['nim']	= $nim;
		$this->load->view('laporan/cetak_rincian',$data);
	}

}
