<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>
  <!-- Load paper.css for happy printing -->

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
  <style>@page { size: A4 }</style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table>
      <tr>
        <td style="width:60px"><img src="<?php echo base_url(); ?>asset/images/lp3i.png" width="50px" height="50px"></td>
        <td><h3 style="font-family:Tahoma">DAFTAR TUNGGAKAN KELAS <?php echo $kelas; ?><br>TAHUN AJARAN <?php echo $tahunajaran; ?><br> HARGA DEAL DAN TUNGGAKAN </h3></td>
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
    <table class="datatable3" style="font-family:Tahoma">
      <tr bgcolor="#024a75" style="color:white;">
        <th>No</th>
        <th>Nama Mhs</th>
        <th>Kelas Senior</th>
        <th>No HP</th>
        <th>No HP Ortu</th>
        <th>Registrasi</th>
        <th>Status</th>
        <th>Harga Deal</th>
        <th>Jumlah Bayar</th>
        <th>Jumlah Tunggakan</th>
        <th>Tunggakan s/d <?php echo $batas; ?></th>
      </tr>
      <?php
        $no                = 1;
        $sisatung          = 0;
        $totalhargadeal    = 0;
        $totalbayar        = 0;
        $totaltunggakan    = 0;
        $totaltunggakannow = 0;
        foreach ($cetak0 as $c) {

          $jenisregis   = $c->jenisregis;
          $status       = $c->ket;
          if($jenisregis=="DANAPINJAMAN"){
  					$meng            = $c->meng;
  					$danapinjaman    = $c->sumwb-$meng;
  					$ket             ="DANAPINJAMAN";
  					$sumwb           = $meng;
  					$wajibbayardulu  = $meng;
  				}else{
  					$sumwb           = $c->sumwb;
  					$parid           ="";
  					$wajibbayardulu  = $c->sumwb;
  				}

          $sumbayar   = $c->sumbayar;
          $tung       = $sumwb-$sumbayar;

          $sumwbnow   = $c->sumwbnow;;
    			$sumnow    =  $sumwbnow-$sumbayar;
          if($sumnow<0){
    				$sumnow=0;
    			}


          if($sumbayar<=0){
    				$tung       = 0;
    				$lunas      = "-";
    				$lun        = "x";
    				$sumwb      = 0;
    				$sumbayar   = 0;
    				$sisatung   = 0;
    			}else if($tung>0){
    				$lunas      ="BELUM LUNAS";
    				$lun        ="&#10004";
    				$sumwb      =$sumwb;
    				$sumbayar   =$sumbayar;
    				$sisatung   =$sisatung;
    			}else{
    				$tung       =0;
    				$lunas      ="LUNAS";
    				$lun        ="&#10004";
    				$sumwb      =$sumwb;
    				$sumbayar   =$sumbayar;
    				$sisatung   =$sisatung;
    			}
          $sisatung     = $sumwb - $sumbayar;
          if ($tung>0){
            $bgcolor ="ffbddb";
          }else{
            $bgcolor ="";
          }
      ?>
        <tr>
          <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $no; ?></td>
          <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $c->namamhs; ?></td>
          <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $c->kelas_senior; ?></td>
          <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $c->telepon; ?></td>
          <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $c->noorgtua; ?></td>
          <td bgcolor="<?php echo $bgcolor; ?>" align="center"><strong><?php  echo $lun;?></strong></td>
  				<td bgcolor="<?php echo $bgcolor; ?>" align="center"><strong><?php  echo $status;?></strong></td>
          <?php
          if($lunas=="-"){
    				if($status!="Aktif"){
    					$tung       = 0;
              $sumwb      = 0;
              $sumbayar   = 0;
              $sumnow     = 0;
    				?>
              <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumwb,0,',','.');?></td>
    					<td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumbayar,0,',','.');?></td>
              <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($tung,0,',','.');?></td>
              <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumnow,0,',','.');?></td>
    				<?php
    				}else{
    					$tung      = 0;
              $sumwb     = 0;
              $sumbayar  = 0;
              $sumnow     = 0;
    				?>
            <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumwb,0,',','.');?></td>
            <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumbayar,0,',','.');?></td>
            <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($tung,0,',','.');?></td>
            <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumnow,0,',','.');?></td>
    				<?php
    				}

    			}else{
    			?>
          <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumwb,0,',','.');?></td>
          <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumbayar,0,',','.');?></td>
          <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($tung,0,',','.');?></td>
          <td align="right" bgcolor="<?php echo $bgcolor; ?>"><strong><?php  echo number_format($sumnow,0,',','.');?></td>
    			<?php
    			}


          ?>
        </tr>
      <?php

        $totalhargadeal = $totalhargadeal + $sumwb;
        $totalbayar     = $totalbayar + $sumbayar;
        $totaltunggakan = $totaltunggakan + $tung;
        $totaltunggakannow = $totaltunggakannow + $sumnow;
        $no++;
        }
      ?>
      <tr>
        <td colspan="7" bgcolor="#024a75" style="color:white;" align="center"><strong>TOTAL</strong></td>
        <td align="right" bgcolor="#024a75" style="color:white;"  ><strong><?php  echo number_format($totalhargadeal,0,',','.');?></strong></td>
        <td align="right" bgcolor="#024a75" style="color:white;"  ><strong><?php  echo number_format($totalbayar,0,',','.');?></strong></td>
        <td align="right" bgcolor="#024a75" style="color:white;"  ><strong><?php  echo number_format($totaltunggakan,0,',','.');?></strong></td>
        <td align="right" bgcolor="#024a75" style="color:white;"  ><strong><?php  echo number_format($totaltunggakannow,0,',','.');?></strong></td>
      </tr>
    </table>
    <p align="left" style="font-size:10px" class="parhas"><?php echo 'Bagi yang belum Registrasi, biaya normal untuk jurusan '.$biaya['kodejur'].' '.$biaya['namatingkat'].' angkatan '.$biaya['angkatan'].' ialah sebesar <strong>Rp. '.number_format($biaya['biaya'],0,',','.').'</strong> (belum termasuk potongan-potongan).';?></p>
    <table  width="100%" style="font-family:Tahoma; font-size:11px" >
    	<tr>
          <td width="50%" align="center">
            <br>
            <br>
            <br>
            <br>
    		    <u><?php echo $fullname;?></u>
    		    <br>
            <b>Finance Staff</b>
          </td>
          <td width="50%"  align="center">
            <br>
            <br>
            <br>
            <br>
            <u>Dheri Febiyani Lestari, S.Pd</u>
    		    <br>
            <b>Head of Finance & HRD Dept.</b>
          </td>
    	</tr>
      <tr>
        <td colspan="2"><p align="right"><br><br><i>Catatan : Jika terjadi kesalahan pencetakan tunggakan mohon konfirmasi ke Bagian Keuangan LP3I Tasikmalaya</i></p></td>
      </tr>
    </table>
  </section>

</body>
</html>
