<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>A4</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/paper.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/tabel.css">
  <style>@page { size: A4 }</style>
</head>
<body class="A4" style="font-size:11px">
<?php
  foreach($kode as $k){

  $query2 = "SELECT
              kontrak.kodekontrak,kontrak.nim,namamhs,
              mahasiswa.ket AS ket,
              mahasiswa.kelas AS kelas,
              kelas.kodejur AS kodejur,
              jurusan.namajur AS namajur,
              biaya.tingkat AS tingkat,
              tingkat.namatingkat AS namatingkat,
              biaya.biaya AS biaya,
              biaya.angkatan AS angkatan,
              kontrak.gelombang AS gelombang,
              kontrak.diskongelombang AS diskongelombang,
              kontrak.diskonprestasi AS diskonprestasi,
              kontrak.diskoncash AS diskoncash,
              kontrak.diskonlain AS diskonlain,
              kontrak.hargadeal AS deal,
              kontrak.tglregis AS tglregis,
              kontrak.registrasi AS regis,
              kontrak.rencanacicilan AS rencanacicilan,
              kontrak.cicilanper AS cicilanper,
              (
              	SELECT
              		ifnull( sum( historibayar.bayar ), 0 ) AS jumlah
              	FROM
              		historibayar
              	WHERE
              		( historibayar.kodekontrak = kontrak.kodekontrak )
              		AND historibayar.jenis = 'REGULER'
              	) AS jumlah,
                (
                	SELECT
                		ifnull( sum( detailrencana.wajibbayar ), 0 ) AS jumlahwb
                	FROM
                		detailrencana
                	WHERE
                		( detailrencana.kodekontrak = kontrak.kodekontrak )
                		AND jatuhtempo <= '$batas'
                	) AS sumwbnow,
              	( SELECT ( `deal` - `jumlah` ) ) AS `sisa`,
              	`kontrak`.`jenisregis` AS `jenisregis`
              FROM
              kontrak
              INNER JOIN mahasiswa ON kontrak.nim = mahasiswa.nim
              INNER JOIN kelas ON mahasiswa.kelas = kelas.kelas
              INNER JOIN jurusan ON kelas.kodejur = jurusan.kodejur
              INNER JOIN biaya ON kontrak.kodebiaya = biaya.kodebiaya
              INNER JOIN tingkat ON biaya.tingkat = tingkat.tingkat
              WHERE kontrak.kodekontrak = '$k'";
  $data2  = $this->db->query($query2)->row_array();
  $hd     = $data2['deal'];
	$rg     = $data2['regis'];
	$ss     = $hd-$rg;

  if($data2['jenisregis']=="DANAPINJAMAN"){
  	$cinggalong   = $this->db->query("select sum(wajibbayar) as meng from detailrencana where kodekontrak='$k'")->row_array();
  	$meng         = $cinggalong['meng'];
  	$danapinjaman = $hd-$meng;
  	$sumwb        = $meng;
  }else{
  	$sumwb        = $data2['deal'];
  }

  $jmlbayar       = $data2['jumlah'];
  $tung           = $sumwb-$data2['jumlah'];

  $sumnow         = $data2['sumwbnow']-$data2['jumlah'];
  if($sumnow<0){
  	$sumnow=0;
  }

  $surat  = $this->db->get_where('surat',array('status'=>$pilihsurat))->row_array();

?>

  <section class="sheet padding-10mm" style="font-family:Tahoma">
  <p style="font-size:11px">
    Tasikmalaya, <?php echo DateToIndo2(date('Y-m-d')); ?>
  </p>

  <p style="font-size:11px; margin-top:30px">
    <b>Kepada Yth.<br>Bpk/Ibu Orangtua Peserta Didik dari<br><?php echo $data2['namamhs']; ?></b><br>di<br>Tempat
  </p>
  <p style="font-size:11px; margin-top:20px">
    <b>Perihal : <?php echo $surat['perihal']; ?></b>
  </p>
  <p style="font-size:11px; margin-top:30px">
    <?php
    $string       = $surat['isi_surat'];
    $replace      = ['{batas}','{jumlahtagihan}'];
    $info         = [
      'batas'           => DateToIndo2($batas),
      'jumlahtagihan'   => number_format($sumnow,0,',','.')
    ];
    echo str_replace($replace, $info, $string);
     ?>
  </p>
  <p style="font-size:11px; margin-top:10px">
    <table width="100%" border="1" bordercolor="#000000" class="garis6">
      <tr bgcolor="#a7bee1">
        <th colspan="5">Rincian Rencana Pembayaran</th>
      </tr>
			<tr bgcolor="#a7bee1">
				<th>Cicilan Ke</th>
				<th>Tgl Rencana Bayar</th>
				<th>Rencana</th>
				<th>Realisasi</th>
				<th>Tertunggak</th>
			</tr>
      <?php
      	$n           = 0;
      	$cicilanper  = $data2['cicilanper'];
				$q           = $this->db->query("select cicilanke, jatuhtempo, wajibbayar, count(wajibbayar) as sumwajib from detailrencana where kodekontrak='$k'");
				$d           = $q->row_array();
				$sumwajib    = $d['sumwajib'];
        $bulan       = "";
      	while($n<$sumwajib) {
  				$queryrencana = $this->db->query("SELECT * FROM detailrencana where kodekontrak='$k' and cicilanke='$n'");
  				$datarencana  = $queryrencana->row_array();
  				//$tgl=$datarencana['jatuhtempo'];
  				//$tahun=substr($tgl,0,4);
  				//$bulan=substr($tgl,5,2);
  				$tanggal2     = $datarencana['jatuhtempo'];
          $bulanskrg2   = substr($tanggal2,5,2);
          $bulanskrg    = substr(date('Y-m-d'),5,2);
  				$cicke        = $datarencana['cicilanke'];
  				if($cicke=="0"){
  					$ketcic="REGISTRASI";
  				}else{
  					$ketcic=$cicke;
  				}

      		$wb = $datarencana['wajibbayar'];
  				if($jmlbayar>$wb){
  				?>
  				<tr>
  					<td><?php echo $ketcic;?></td>
  					<td><?php echo DateToIndo2($datarencana['jatuhtempo']);?></td>
  					<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
  					<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
  					<td align="right">Rp. <?php  echo number_format('0',0,',','.');?></td>
  				</tr>
  				<?php
  				$jmlbayar = $jmlbayar-$wb;
  				}else{
  					if($jmlbayar>0){
  						?>
  						<tr>
  							<td><?php echo "$ketcic";?></td>
  							<td><?php echo DateToIndo2($datarencana['jatuhtempo']);?></td>
  							<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
  							<td align="right">Rp. <?php  echo number_format($jmlbayar,0,',','.');?></td>
  							<td align="right">Rp. <?php  echo number_format($wb-$jmlbayar,0,',','.');?></td>
  						</tr>
    					<?php
      					$jmlbayar = $jmlbayar - $wb;
      					}else{
      						if($bulanskrg2!=$bulanskrg){
      							$warna="EEEEEE";
      						}else{
      							$warna="DDDDDD";
      						}
      					?>
      						<tr bgcolor="<?php echo $warna;?>">
      							<td><?php echo "$ketcic";?></td>
      							<td><?php echo DateToIndo2($datarencana['jatuhtempo']);?></td>
      							<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      							<td align="right">Rp. <?php  echo number_format('0',0,',','.');?></td>
      							<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      						</tr>
      					<?php
      					}
      				}
      				$n++;
      			}
      			$jumlah=$data2['jumlah'];
      			if($data2['jenisregis']=="DANAPINJAMAN"){
      			?>
      			<tr class="info">
      				<td align="center" colspan="2">JUMLAH</td>
      				<td align="right">Rp. <?php  echo number_format($meng,0,',','.');?></td>
      				<td align="right">Rp. <?php  echo number_format($jumlah,0,',','.');?></td>
      				<td align="right">Rp. <?php
      					$sisa  = $meng-$jumlah;
      					echo number_format($sisa,0,',','.');
      					?>
      				</td>
      			</tr>
      			<?php
      			}else{
      			?>
      			<?php
      			}
      			?>

      <tr bgcolor="#a7bee1">
        <th colspan="5">Histori Pembayaran</th>
      </tr>
      <?php
  		$cek    = $this->db->query("select count(kodekontrak) as hubahuba from historibayar where kodekontrak='$k' and jenis='REGULER'")->row_array();
  		$aya    = $cek['hubahuba'];
  		if ($aya==0){
  		?>
  			<tr>
          <td colpsan="5"><b>Maaf, mahasiswa/i ini belum melakukan pembayaran Cicilan!</b></td>
        </tr>
  		<?php
  		}else{
  			$query3 = $this->db->query("SELECT * FROM historibayar where kodekontrak='$k' and jenis='REGULER' order by nobukti asc");
  			$data3  = $query3->row_array();
  		?>
      <tr bgcolor="#a7bee1">
        <th>BTK</th>
        <th>BTB</th>
        <th>Tgl. Bayar</th>
        <th>Keterangan</th>
        <th>Jumlah Bayar</th>
      </tr>

    <?php
      $totalbayar = 0;
      foreach ($query3->result() as $d){
        $totalbayar = $totalbayar + $d->bayar;
    ?>
    <tr>
      <td><?php echo $d->nobtk;?></td>
      <td><?php echo $d->nobtb;?></td>
      <td><?php echo DateToIndo2($d->tgl);?></td>
      <td><?php  echo $d->keterangan;?></td>
      <td align="right">Rp. <?php  echo number_format($d->bayar,0,',','.');?></td>
    </tr>
    <?php
      }
    }
    ?>
    <tr bgcolor="#a7bee1">
      <td colspan="4" align="center"><b>JUMLAH YG TELAH DIBAYARKAN</b></td>
      <td align="right"><b>Rp. <?php  echo number_format($totalbayar,0,',','.');?></b></td>
    </tr>
    </table>
  </p>
  <p style="font-size:11px; margin-top:10px">
    <?php echo $surat['isi_surat2']; ?>
  </p>
  <p style="font-size:11px; margin-top:20px">
    <b>LP3I TASIKMALAYA
    <br /><i>Business & Technology College</i></b>
  </p>
  <p style="font-size:11px; margin-top:60px">
    <table style="width:100%">
      <tr>
        <td style="width:50%; text-align:center"><u><?php echo $fullname; ?></u><br>Finance Staff</td>
        <td style="width:50%; text-align:center"><u>Dheri Febiyani Lestari</u><br>Head Of Finance & HRD Dept.</td>
      </tr>
    </table>
  </p>
  </section>


<?php
  }
?>
</body>
</html>
