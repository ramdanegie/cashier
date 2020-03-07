<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <style>@page { size: A4 }</style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table>
      <tr>
        <td style="width:60px"><img src="<?php echo base_url(); ?>asset/images/lp3i.png" width="50px" height="50px"></td>
        <td><h3 style="font-family:Tahoma">DAFTAR RENCANA DAN REALISASI PEMBAYARAN DAN PROGRAM PROFESI  <?php echo $kelas; ?><br>TAHUN AJARAN <?php echo $tahunajaran; ?> </h3></td>
      </tr>
    </table>
    <table style="font-family:Tahoma">
      <tr>
        <td>Pembimbing Akademik</td>
        <td>:</td>
        <td><b><?php echo $pa['nama']; ?></b></td>
      </tr>
    </table>
    <br>
    <?php
    $query =  $this->db->query("select nim, namamhs, ket,kelas_senior
          from mahasiswa where kelas='$kelas'
          order by namamhs")->result();

      $sumsebelumjuli = 0;
      $sumjuli        = 0;
      $sumagustus     = 0;
      $sumseptember   = 0;
      $sumoktober     = 0;
      $sumnopember    = 0;
      $sumdesember    = 0;
      $sumjanuari     = 0;
      $sumfebruari    = 0;
      $summaret       = 0;
      $sumapril       = 0;
      $summei         = 0;
      $sumjuni        = 0;
    ?>
    <table class="datatable4" style="font-family:Tahoma">
      <tr>
        <th bgcolor="#BBBBBB" rowspan="2"> No. </th>
				<th bgcolor="#BBBBBB" rowspan="2"> No Induk </th>
        <th bgcolor="#BBBBBB" rowspan="2">Nama</th>
        <th bgcolor="#BBBBBB" rowspan="2">Program Study</th>
        <th bgcolor="#BBBBBB" rowspan="2">Rencana Bayar</th>
        <th bgcolor="#BBBBBB" colspan="5">Potongan</th>
        <th bgcolor="#BBBBBB" rowspan="2">Total Yang Harus Dibayar</th>
        <th bgcolor="#BBBBBB" rowspan="2">Registrasi</th>
        <?php
         error_reporting(0);
					$h[0]="0";
					$h[1]="1";
					$h[2]="2";
					$h[3]="3";
					$h[4]="4";
					$h[5]="5";
					$h[6]="6";
					$h[7]="7";
					$h[8]="8";
					$h[9]="9";
					$h[10]="10";
					$h[11]="11";
					$h[12]="12";

          for ($i=0; $i<=12; $i++){
						if ($h[$i]<=$count){
							$warna[$i]="#EEEEEE";
						}else{
							$warna[$i]="#CCCCCC";
						}
					}
        ?>
        <th bgcolor="<?php echo $warna[0];?>"  colspan="3">Sebelum Juli</th>
        <th bgcolor="<?php echo $warna[1];?>" colspan="3">Juli</th>
        <th bgcolor="<?php echo $warna[2];?>"  colspan="3">Agustus</th>
        <th bgcolor="<?php echo $warna[3];?>"  colspan="3">September</th>
        <th bgcolor="<?php echo $warna[4];?>"  colspan="3">Oktober</th>
        <th bgcolor="<?php echo $warna[5];?>"  colspan="3">Nopember</th>
        <th bgcolor="<?php echo $warna[6];?>"  colspan="3">Desember</th>
        <th bgcolor="<?php echo $warna[7];?>"  colspan="3">Januari</th>
        <th bgcolor="<?php echo $warna[8];?>"  colspan="3">Februari</th>
        <th bgcolor="<?php echo $warna[9];?>"  colspan="3">Maret</th>
        <th bgcolor="<?php echo $warna[10];?>"  colspan="3">April</th>
        <th bgcolor="<?php echo $warna[11];?>"  colspan="3">Mei</th>
        <th bgcolor="<?php echo $warna[12];?>"  colspan="3">Juni</th>
        <th bgcolor="#BBBBBB" width="6%" rowspan="2">Jumlah Tunggakan<br>
            (s.d <?php echo $batas;?>)
        </th>
        <th bgcolor="#BBBBBB"  rowspan="2">Sisa Bayar</th>
      </tr>
      <tr>
				<th bgcolor="#BBBBBB"> Gelombang </th>
				<th bgcolor="#BBBBBB"> Prestasi </th>
				<th bgcolor="#BBBBBB"> Cash </th>
        <th bgcolor="#BBBBBB"> Lain-lain</th>
        <th bgcolor="#BBBBBB"> Dana Pinjaman</th>
				<?php
				for ($i=0; $i<=12; $i++)
					{
				?>
						<th bgcolor="<?php echo $warna[$i];?>"><small>Rencana</small></th>
						<th bgcolor="<?php echo $warna[$i];?>"><small>Realisasi</small></th>
						<th bgcolor="<?php echo $warna[$i];?>"><small>Tertunggak</small></th>
				<?php
					}
				?>

			</tr>
      <?php
        $no=1;
        foreach($query as $r){
          $nim      = $r->nim;
          $jumlah   = $this->db->query("select kontrak.kodekontrak AS `kode`,
                			kontrak.hargadeal AS `sumwb`,
                			kontrak.jenisregis AS `jenisregis`
                			from kontrak, mahasiswa, biaya, tingkat, kelas, jurusan
                			where kontrak.nim = mahasiswa.nim
                			and kontrak.kodebiaya = biaya.kodebiaya
                			and biaya.tingkat = tingkat.tingkat
                			and mahasiswa.kelas = kelas.kelas
                			and jurusan.kodejur = kelas.kodejur
                			and kontrak.nim='$nim' and biaya.tingkat='$tingkat' and mahasiswa.kelas='$kelas'")->row_array();
        $kode       = $jumlah['kode'];
  			$jenisregis = $jumlah['jenisregis'];
        if($jenisregis  ==  "DANAPINJAMAN"){
					$cinggalong   = $this->db->query("select sum(wajibbayar) as meng from detailrencana where kodekontrak='$kode'")->row_array();
					$meng         = $cinggalong['meng'];
					$danapinjaman = $jumlah['sumwb']-$meng;
					$sumwb        = $meng;
				}else{
					$sumwb         = $jumlah['sumwb'];
					$danapinjaman  = 0;
				}

        $ukuku      = $this->db->query("select ifnull(sum(`historibayar`.`bayar`),0) as sumbayar from `historibayar` where `historibayar`.`kodekontrak` = '$kode'")->row_array();
        $sumbayar   = $ukuku['sumbayar'];
        $tung       = $sumwb-$sumbayar;

        $akaka      = $this->db->query("select ifnull(sum(wajibbayar),0) as sumwbnow from detailrencana where kodekontrak = '$kode' and jatuhtempo <= '$batas'")->row_array();
        $sumwbnow   = $akaka['sumwbnow'];
        $sumnow     = $sumwbnow-$sumbayar;
        if($sumnow<0){
          $sumnow=0;
        }

        $reg = $this->db->query(
          			"select `kontrak`.`kodekontrak` AS `kode`,
          			`kontrak`.`nim` AS `nim`,
          			`mahasiswa`.`namamhs` AS `namamhs`,
          			`kontrak`.`kodebiaya` AS `kodebiaya`,
          			`biaya`.`angkatan` AS `angkatan`,
          			`biaya`.`tingkat` AS `tingkat`,
          			`biaya`.`biaya` AS `biaya`,
          			biaya.kodejur as kelas,
          			`kontrak`.`diskongelombang` AS `diskongelombang`,
          			`kontrak`.`diskonprestasi` AS `diskonprestasi`,
          			`kontrak`.`diskoncash` AS `diskoncash`,
          			`kontrak`.`diskonlain` AS `diskonlain`,
          			`kontrak`.`hargadeal` AS `hargadeal`,
          			`kontrak`.`registrasi` AS `registrasi`
          			FROM kontrak
          			INNER JOIN mahasiswa ON kontrak.nim = mahasiswa.nim
          			INNER JOIN biaya ON kontrak.kodebiaya = biaya.kodebiaya
          			WHERE kontrak.kodekontrak = '$kode'")->row_array();
                $rencanabayar = $reg['biaya'] - $reg['diskongelombang'] - $reg['diskonprestasi'] - $reg['diskoncash'] - $reg['diskonlain'];

  			$cic       = $this->db->query("select `detailrencana`.`jatuhtempo`
                            					from `detailrencana`
                            					where `detailrencana`.`kodekontrak` = '$kode'
                            					order by `detailrencana`.`jatuhtempo` limit 1")->row_array();
  			$cicpertama = $cic['jatuhtempo'];
  			$akhirjun          = substr($cicpertama,0,4).'-06-30';
  			$year2             = substr($cicpertama,0,4) + 1;
        $rsebelumjuli      = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as sebelumjuli from `detailrencana` where `detailrencana`.`kodekontrak` = '$kode' and `detailrencana`.`jatuhtempo` <= '$akhirjun'")->row_array();
  			$rjuli             = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as juli from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '7' and year(`detailrencana`.`jatuhtempo`) = year('$akhirjun') and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$ragustus          = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as agustus from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '8' and year(`detailrencana`.`jatuhtempo`) = year('$akhirjun') and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rseptember        = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as september from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '9' and year(`detailrencana`.`jatuhtempo`) = year('$akhirjun') and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$roktober          = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as oktober from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '10' and year(`detailrencana`.`jatuhtempo`) = year('$akhirjun') and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rnopember         = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as nopember from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '11' and year(`detailrencana`.`jatuhtempo`) = year('$akhirjun') and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rdesember         = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as desember from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '12' and year(`detailrencana`.`jatuhtempo`) = year('$akhirjun') and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rjanuari          = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as januari from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '1' and year(`detailrencana`.`jatuhtempo`) = '$year2' and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rfebruari         = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as februari from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '2' and year(`detailrencana`.`jatuhtempo`) = '$year2' and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rmaret            = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as maret from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '3' and year(`detailrencana`.`jatuhtempo`) = '$year2' and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rapril            = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as april from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '4' and year(`detailrencana`.`jatuhtempo`) = '$year2' and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rmei              = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as mei from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '5' and year(`detailrencana`.`jatuhtempo`) = '$year2' and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
  			$rjuni             = $this->db->query("select ifnull(sum(`detailrencana`.`wajibbayar`),0) as juni from `detailrencana` where month(`detailrencana`.`jatuhtempo`) = '6' and year(`detailrencana`.`jatuhtempo`) = '$year2' and `detailrencana`.`kodekontrak` = '$kode'")->row_array();
        $row['sebelumjuli'] = $rsebelumjuli['sebelumjuli'];
  			$row['juli']        = $rjuli['juli'];
  			$row['agustus']     = $ragustus['agustus'];
  			$row['september']   = $rseptember['september'];
  			$row['oktober']     = $roktober['oktober'];
  			$row['nopember']    = $rnopember['nopember'];
  			$row['desember']    = $rdesember['desember'];
  			$row['januari']     = $rjanuari['januari'];
  			$row['februari']    = $rfebruari['februari'];
  			$row['maret']       = $rmaret['maret'];
  			$row['april']       = $rapril['april'];
  			$row['mei']         = $rmei['mei'];
  			$row['juni']        = $rjuni['juni'];
  			$row['jumlah']      = $row['sebelumjuli'] + $row['juli'] + $row['agustus'] + $row['september'] + $row['oktober'] + $row['nopember'] + $row['desember'] + $row['januari'] + $row['februari'] + $row['maret'] + $row['april'] + $row['mei'] + $row['juni'];


      ?>
      <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $nim;?></td>
        <?php
        if ($sumnow>0){
        ?>
          <td bgcolor="EEEEEE"><b><?php echo $reg['namamhs']; ?></b></td>
        <?php
        }else{
        ?>
          <td ><?php echo $reg['namamhs']; ?></td>
        <?php
        }
        ?>
        <td><?php echo $reg['kelas'];?></td>
  			<td align="right"><?php echo number_format($reg['biaya'],0,',','.');?></td>
  			<td align="right"><?php echo number_format($reg['diskongelombang'],0,',','.');?></td>
  			<td align="right"><?php echo number_format($reg['diskonprestasi'],0,',','.');?></td>
  			<td align="right"><?php echo number_format($reg['diskoncash'],0,',','.');?></td>
  			<td align="right"><?php echo number_format($reg['diskonlain'],0,',','.');?></td>
  			<td align="right"><?php echo number_format($danapinjaman,0,',','.');?></td>
  			<td align="right"><?php echo number_format($reg['hargadeal']-$danapinjaman,0,',','.');?></td>
  			<td align="right"><?php echo number_format($reg['registrasi'],0,',','.');?></td>
        <?php
          if ($sumbayar<=0){
        ?>
            <td align="right"><?php  echo number_format($row['sebelumjuli'],0,',','.');?></td>
            <td align="right"><?php  echo number_format('0',0,',','.');?></td>
            <td align="right"><?php  echo number_format($row['sebelumjuli'],0,',','.');?></td>
        <?php
            $sebelumjuli=0;
          }else{
            if ($sumbayar>=$row['sebelumjuli']){
        ?>
        	    <td align="right" ><?php  echo number_format($row['sebelumjuli'],0,',','.');?></td>
  						<td align="right" ><?php  echo number_format($row['sebelumjuli'],0,',','.');?></td>
              <td align="right" ><?php  echo number_format('0',0,',','.');?></td>
            <?php
              $sebelumjuli=$row['sebelumjuli'];
            }else{
            ?>
  						<td align="right"><?php  echo number_format($row['sebelumjuli'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
              <td align="right"><?php  echo number_format($row['sebelumjuli']-$sumbayar,0,',','.');?></td>
            <?php
              $sebelumjuli=$sumbayar;
            }
          }
          $sumbayar=$sumbayar-$row['sebelumjuli'];
          if ($sumbayar<=0){
          ?>
            <td align="right"><?php  echo number_format($row['juli'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
            <td align="right"><?php  echo number_format($row['juli'],0,',','.');?></td>
          <?php
            $juli=0;
          }else{
            if ($sumbayar>=$row['juli']){
          ?>
  						<td align="right"><?php  echo number_format($row['juli'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['juli'],0,',','.');?></td>
              <td align="right"><?php  echo number_format('0',0,',','.');?></td>
            <?php
              $juli=$row['juli'];
            }else{
            ?>
              <td align="right"><?php  echo number_format($row['juli'],0,',','.');?></td>
              <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
              <td align="right"><?php  echo number_format($row['juli']-$sumbayar,0,',','.');?></td>
            <?php
            $juli =  $sumbayar;
            }
        }
          $sumbayar=$sumbayar-$row['juli'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['agustus'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['agustus'],0,',','.');?></td>
                  <?php
                  $agustus=0;
                  }else{
                      if ($sumbayar>=$row['agustus']){
                      ?>
  						<td align="right"><?php  echo number_format($row['agustus'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['agustus'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $agustus=$row['agustus'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['agustus'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['agustus']-$sumbayar,0,',','.');?></td>
                      <?php
                      $agustus=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['agustus'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['september'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['september'],0,',','.');?></td>
                  <?php
                  $september=0;
                  }else{
                      if ($sumbayar>=$row['september']){
                      ?>
  						<td align="right"><?php  echo number_format($row['september'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['september'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $september=$row['september'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['september'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['september']-$sumbayar,0,',','.');?></td>
                      <?php
                      $september=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['september'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['oktober'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['oktober'],0,',','.');?></td>
                  <?php
                  $oktober=0;
                  }else{
                      if ($sumbayar>=$row['oktober']){
                      ?>
                          <td align="right"><?php  echo number_format($row['oktober'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['oktober'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $oktober=$row['oktober'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['oktober'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['oktober']-$sumbayar,0,',','.');?></td>
                      <?php
                      $oktober=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['oktober'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['nopember'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['nopember'],0,',','.');?></td>
                  <?php
                      $nopember=0;
                  }else{
                      if ($sumbayar>=$row['nopember']){
                      ?>
                          <td align="right"><?php  echo number_format($row['nopember'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['nopember'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                          $nopember=$row['nopember'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['nopember'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['nopember']-$sumbayar,0,',','.');?></td>
                      <?php
                          $nopember=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['nopember'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['desember'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['desember'],0,',','.');?></td>
                  <?php
                  $desember=0;
                  }else{
                      if ($sumbayar>=$row['desember']){
                      ?>
  						<td align="right"><?php  echo number_format($row['desember'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['desember'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $desember=$row['desember'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['desember'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['desember']-$sumbayar,0,',','.');?></td>
                      <?php
                      $desember=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['desember'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['januari'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['januari'],0,',','.');?></td>
                  <?php
                  $januari=0;
                  }else{
                      if ($sumbayar>=$row['januari']){
                      ?>
  						<td align="right"><?php  echo number_format($row['januari'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['januari'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $januari=$row['januari'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['januari'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['januari']-$sumbayar,0,',','.');?></td>
                      <?php
                      $januari=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['januari'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['februari'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['februari'],0,',','.');?></td>
                  <?php
                  $februari=0;
                  }else{
                      if ($sumbayar>=$row['februari']){
                      ?>
  						<td align="right"><?php  echo number_format($row['februari'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['februari'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $februari=$row['februari'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['februari'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['februari']-$sumbayar,0,',','.');?></td>
                      <?php
                      $februari=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['februari'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['maret'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['maret'],0,',','.');?></td>
                  <?php
                  $maret=0;
                  }else{
                      if ($sumbayar>=$row['maret']){
                      ?>
  						<td align="right"><?php  echo number_format($row['maret'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['maret'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $maret=$row['maret'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['maret'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['maret']-$sumbayar,0,',','.');?></td>
                      <?php
                      $maret=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['maret'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['april'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['april'],0,',','.');?></td>
                  <?php
                  $april=0;
                  }else{
                      if ($sumbayar>=$row['april']){
                      ?>
  						<td align="right"><?php  echo number_format($row['april'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['april'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $april=$row['april'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['april'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['april']-$sumbayar,0,',','.');?></td>
                      <?php
                      $april=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['april'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['mei'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['mei'],0,',','.');?></td>
                  <?php
                  $mei=0;
                  }else{
                      if ($sumbayar>=$row['mei']){
                      ?>
  						<td align="right"><?php  echo number_format($row['mei'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['mei'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                      $mei=$row['mei'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['mei'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['mei']-$sumbayar,0,',','.');?></td>
                      <?php
                      $mei=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['mei'];

                  if ($sumbayar<=0){
                  ?>
                      <td align="right"><?php  echo number_format($row['juni'],0,',','.');?></td>
  					<td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right"><?php  echo number_format($row['juni'],0,',','.');?></td>
                  <?php
                      $juni=0;
                  }else{
                      if ($sumbayar>=$row['juni']){
                      ?>
  						<td align="right"><?php  echo number_format($row['juni'],0,',','.');?></td>
  						<td align="right"><?php  echo number_format($row['juni'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <?php
                          $juni=$row['juni'];
                      }else{
                      ?>
                          <td align="right"><?php  echo number_format($row['juni'],0,',','.');?></td>
                          <td align="right"><?php  echo number_format($sumbayar,0,',','.');?></td>
                          <td align="right"><?php  echo number_format($row['juni']-$sumbayar,0,',','.');?></td>
                      <?php
                          $juni=$sumbayar;
                      }
                  }
                  $sumbayar=$sumbayar-$row['juni'];


                  ?>



                  <?php
  				if ($sumnow>0){
  				?>
                  	<td align="right" bgcolor="#EEEEEE"><strong><?php  echo number_format($sumnow,0,',','.');?></strong></td>
                  <?php
  				}else{
  				?>
  	                <td align="right"><strong><?php  echo number_format($sumnow,0,',','.');?></strong></td>
                  <?php
  				}
  				$sisabyr = $row['jumlah']+$sumbayar;
  				if ($sisabyr>=$row['jumlah']){
  					$sisabyr = 0;
  				}
  				?>

  				<td align="right"><?php echo number_format($sisabyr,0,',','.');;?></td>
              </tr>
              <?php
              $cetak_sj = $cetak_sj + $row['sebelumjuli'];
              $cetak_juli = $cetak_juli + $row['juli'];
              $cetak_agustus = $cetak_agustus + $row['agustus'];
              $cetak_september = $cetak_september + $row['september'];
              $cetak_oktober = $cetak_oktober + $row['oktober'];
              $cetak_nopember = $cetak_nopember + $row['nopember'];
              $cetak_desember = $cetak_desember + $row['desember'];
              $cetak_januari = $cetak_januari + $row['januari'];
              $cetak_februari = $cetak_februari + $row['februari'];
              $cetak_maret = $cetak_maret + $row['maret'];
              $cetak_april = $cetak_april + $row['april'];
              $cetak_mei = $cetak_mei + $row['mei'];
              $cetak_juni = $cetak_juni + $row['juni'];

  			$sumsebelumjuli=$sumsebelumjuli+$sebelumjuli;
              $sumjuli=$sumjuli+$juli;
              $sumagustus=$sumagustus+$agustus;
              $sumseptember=$sumseptember+$september;
              $sumoktober=$sumoktober+$oktober;
              $sumnopember=$sumnopember+$nopember;
              $sumdesember=$sumdesember+$desember;
              $sumjanuari=$sumjanuari+$januari;
              $sumfebruari=$sumfebruari+$februari;
              $summaret=$summaret+$maret;
              $sumapril=$sumapril+$april;
              $summei=$summei+$mei;
              $sumjuni=$sumjuni+$juni;

              $no++;
  			$cetak_now=$cetak_now+$sumnow;
  			$sumsisabyr=$sumsisabyr+$sisabyr;
              }
              ?>
              <tr>
                  <td align="right" bgcolor="#BBBBBB" colspan="12"><strong>TOTAL</strong></td>

          <td align="right" bgcolor="<?php echo $warna[0];?>"><strong><?php echo number_format($cetak_sj,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[0];?>"><strong><?php echo number_format($sumsebelumjuli,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[0];?>"><strong><?php echo number_format($cetak_sj-$sumsebelumjuli,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[1];?>"><strong><?php echo number_format($cetak_juli,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[1];?>"><strong><?php echo number_format($sumjuli,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[1];?>"><strong><?php echo number_format($cetak_juli-$sumjuli,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[2];?>"><strong><?php echo number_format($cetak_agustus,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[2];?>"><strong><?php echo number_format($sumagustus,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[2];?>"><strong><?php echo number_format($cetak_agustus-$sumagustus,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[3];?>"><strong><?php echo number_format($cetak_september,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[3];?>"><strong><?php echo number_format($sumseptember,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[3];?>"><strong><?php echo number_format($cetak_september-$sumseptember,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[4];?>"><strong><?php echo number_format($cetak_oktober,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[4];?>"><strong><?php echo number_format($sumoktober,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[4];?>"><strong><?php echo number_format($cetak_oktober-$sumoktober,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[5];?>"><strong><?php echo number_format($cetak_nopember,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[5];?>"><strong><?php echo number_format($sumnopember,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[5];?>"><strong><?php echo number_format($cetak_nopember-$sumnopember,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[6];?>"><strong><?php echo number_format($cetak_desember,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[6];?>"><strong><?php echo number_format($sumdesember,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[6];?>"><strong><?php echo number_format($cetak_desember-$sumdesember,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[7];?>"><strong><?php echo number_format($cetak_januari,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[7];?>"><strong><?php echo number_format($sumjanuari,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[7];?>"><strong><?php echo number_format($cetak_januari-$sumjanuari,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[8];?>"><strong><?php echo number_format($cetak_februari,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[8];?>"><strong><?php echo number_format($sumfebruari,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[8];?>"><strong><?php echo number_format($cetak_februari-$sumfebruari,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[9];?>"><strong><?php echo number_format($cetak_maret,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[9];?>"><strong><?php echo number_format($summaret,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[9];?>"><strong><?php echo number_format($cetak_maret-$summaret,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[10];?>"><strong><?php echo number_format($cetak_april,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[10];?>"><strong><?php echo number_format($sumapril,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[10];?>"><strong><?php echo number_format($cetak_april-$sumapril,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[11];?>"><strong><?php echo number_format($cetak_mei,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[11];?>"><strong><?php echo number_format($summei,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[11];?>"><strong><?php echo number_format($cetak_mei-$summei,0,',','.');?></strong></td>

                  <td align="right" bgcolor="<?php echo $warna[12];?>"><strong><?php echo number_format($cetak_juni,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[12];?>"><strong><?php echo number_format($sumjuni,0,',','.');?></strong></td>
                  <td align="right" bgcolor="<?php echo $warna[12];?>"><strong><?php echo number_format($cetak_juni-$sumjuni,0,',','.');?></strong></td>

                  <td align="right" bgcolor="#BBBBBB"><strong><?php echo number_format($cetak_now,0,',','.');?></strong></td>
          <td align="right" bgcolor="#BBBBBB"><strong><?php echo number_format($sumsisabyr,0,',','.');?></strong></td>
              </tr>      
    </table>
    <p align="left" style="font-size:10px" class="parhas"><?php echo 'Bagi yang belum Registrasi, biaya normal untuk jurusan '.$biaya['kodejur'].' '.$biaya['namatingkat'].' angkatan '.$biaya['angkatan'].' ialah sebesar <strong>Rp. '.number_format($biaya['biaya'],0,',','.').'</strong> (belum termasuk potongan-potongan).';?></p>
  </section>

</body>
</html>
