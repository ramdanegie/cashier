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
    <?php
    $data = $this->db->query("select `mahasiswa`.`nim` as nim, `mahasiswa`.`namamhs` AS `namamhs`,`mahasiswa`.`ket` AS `ket`,`mahasiswa`.`kelas` AS `kelas`,`kelas`.`kodejur` AS `kodejur`,`jurusan`.`namajur` AS `namajur`,`kelas`.`tingkat` AS `tingkat`,`tingkat`.`namatingkat` AS `namatingkat`
                          from mahasiswa, tingkat, kelas, jurusan
                          where `kelas`.`kelas` = `mahasiswa`.`kelas`
                          and `tingkat`.`tingkat` = `kelas`.`tingkat`
                          and `kelas`.`kodejur` = `jurusan`.`kodejur`
                          and `mahasiswa`.`nim` = '$nim'")->row_array();
    ?>
    <table width="100%" border="1" bordercolor="#000000" class="garis2" style="font-family:Tahoma">
      <tr>
        <td width="10%" align="center"><img src="<?php echo base_url(); ?>asset/images/lp3i.png" width="75" height="83" /></td>
        <td width="45%" align="center"><h2>RINCIAN PEMBAYARAN MAHASISWA<br />
        LP3I TASIKMALAYA</h2></td>
        <td width="45%">
          <table width="100%" border="1" bordercolor="#000000" class="garis2">
            <tr>
              <td width="15%">No Induk</td>
              <td width="85%"><?php echo $nim;?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td><?php echo $data['namamhs'];?></td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td><?php echo $data['kelas'];?></td>
            </tr>
            <tr>
              <td>Jurusan</td>
              <td><?php echo $data['namajur'];?></td>
            </tr>
            <tr>
              <td>Tingkat</td>
              <td><?php echo $data['namatingkat'];?></td>
            </tr>
          </table>
        </td>
      </tr>
      <?php
      $qtingkat = $this->db->query("SELECT `tingkat`, `namatingkat` FROM `tingkat` WHERE 1")->result();
      foreach($qtingkat as $dtingkat){
      ?>
      	<!--JUNIOR-->
      		<table width="100%" border="1" bordercolor="#000000" class="garis2">
      		  <tr>
      			<td valign="top" colspan="3" bgcolor="#999999" align="center"><b>Rincian Pembayaran <?php echo $dtingkat->namatingkat;?></b></td>
      		  </tr>
      			<?php
      			$koting = $dtingkat->tingkat;
      			$ceks = $this->db->query("select count(`kontrak`.`nim`) AS hubahuba
                		from kontrak, tingkat, biaya
                		where `biaya`.`kodebiaya` = `kontrak`.`kodebiaya`
                		and `tingkat`.`tingkat` = `biaya`.`tingkat`
                		and `kontrak`.`nim` = '$nim'
                		and `tingkat`.`tingkat` = '$koting'")->row_array();
      			$ayas=$ceks['hubahuba'];

      			if ($ayas==0){
      			?>
      			<tr>
      				<td colspan="3" align="center">TIDAK ADA DATA DI SYSTEM</td>
      			</tr>
      			<?php
      			}else{
      			?>
      			<tr>
      				<td bgcolor="#CCCCCC">Rencana Pembayaran</td>
      				<td bgcolor="#CCCCCC">Posting Pembayaran</td>
      				<td bgcolor="#CCCCCC">Realisasi Pembayaran</td>
      			</tr>
      			<tr>
      			<td valign="top" align="center">
      			<?php
      					$query2 = $this->db->query("select `kontrak`.`kodekontrak` AS `kode`,`kontrak`.`nim` AS `nim`,
      		`mahasiswa`.`namamhs` AS `namamhs`,`mahasiswa`.`ket` AS `ket`,`mahasiswa`.`kelas` AS `kelas`,`kelas`.`kodejur` AS `kodejur`,`jurusan`.`namajur` AS `namajur`,`biaya`.`tingkat` AS `tingkat`,`tingkat`.`namatingkat` AS `namatingkat`,`biaya`.`biaya` AS `biaya`,`biaya`.`angkatan` AS `angkatan`,`kontrak`.`gelombang` AS `gelombang`,`kontrak`.`diskongelombang` AS `diskongelombang`,`kontrak`.`diskonprestasi` AS `diskonprestasi`,`kontrak`.`diskoncash` AS `diskoncash`,`kontrak`.`diskonlain` AS `diskonlain`,`kontrak`.`hargadeal` AS `deal`,`kontrak`.`tglregis` AS `tglregis`,`kontrak`.`registrasi` AS `regis`,`kontrak`.`rencanacicilan` AS `rencanacicilan`,`kontrak`.`cicilanper` AS `cicilanper`,(select ifnull(sum(`historibayar`.`bayar`),0) AS `jumlah` from `historibayar` where (`historibayar`.`kodekontrak` = `kode`)) AS `jumlah`,(select (`deal` - `jumlah`)) AS `sisa`,`kontrak`.`jenisregis` AS `jenisregis` from mahasiswa, kontrak, tingkat, kelas, biaya, jurusan
      		where `mahasiswa`.`nim` = `kontrak`.`nim`
      		and `kelas`.`kelas` = `mahasiswa`.`kelas`
      		and `biaya`.`kodebiaya` = `kontrak`.`kodebiaya`
      		and `tingkat`.`tingkat` = `biaya`.`tingkat`
      		and `kelas`.`kodejur` = `jurusan`.`kodejur`
      		and `mahasiswa`.`nim` = '$nim'
      		and `tingkat`.`tingkat` = '$koting'");

      					$data2=$query2->row_array();
      					$jumlah=$data2['jumlah'];
      						$rencanacicilan=$data2['rencanacicilan'];
      						$tglregis=$data2['tglregis'];
      						$id=$data2['kode'];

      					?>
      						<table width="100%" border="1" bordercolor="#000000" class="garis2">
      						<tr>
      							<th>Cicilan Ke</th>
      							<th>Jatuh Tempo</th>
      							<th>Wajib Bayar</th>
      						</tr>
      						<tr>
      								<td>REGISTRASI</td>
      								<td><?php echo $data2['tglregis']; ?></td>
      								<td align="right">Rp. <?php  echo number_format($data2['regis'],0,',','.');?></td>
      						</tr>
      						<?php

      							$queryren=$this->db->query("select * from detailrencana where kodekontrak='$id' and cicilanke>0");
      							foreach ($queryren->result() as $dataren)

      							{
      							?>
      							<tr>
      								<td><?php echo $dataren->cicilanke; ?></td>
      								<td><?php echo $dataren->jatuhtempo; ?></td>
      								<td align="right">Rp. <?php  echo number_format($dataren->wajibbayar,0,',','.');?></td>
      							</tr>
      						<?php
      							}

      						?>
      						<tr class="success">
      								<td colspan="2" align="right">TOTAL RENCANA BAYAR</td>
      								<td align="right">Rp. <?php  echo number_format($data2['deal'],0,',','.');?></td>
      							</tr>
      						</table>
      			</td>
      			<td valign="top" align="center">
      					<table width="100%" border="1" bordercolor="#000000" class="garis2">
      					<tr class="info">
      							<th>Bulan</th>
      							<th>Rencana</th>
      							<th>Realisasi</th>
      							<th>Tertunggak</th>
      					</tr>
      		<?php
      					$n=0;
      					$jmlbayar=$data2['jumlah'];
      					$cicilanper=$data2['cicilanper'];

      						$q = $this->db->query("select cicilanke, jatuhtempo, wajibbayar, count(wajibbayar) as sumwajib from detailrencana where kodekontrak='$id'");
      						$d = $q->row_array();
      						$sumwajib=$d['sumwajib'];

      						while($n<$sumwajib) {

      						$queryrencana=$this->db->query("SELECT * FROM detailrencana where kodekontrak='$id' and cicilanke='$n'");
      						$datarencana=$queryrencana->row_array();

      						$tgl=$datarencana['jatuhtempo'];
      						$tahun=substr($tgl,0,4);
      						$bulan=substr($tgl,5,2);

      						$wb=$datarencana['wajibbayar'];

      						if($jmlbayar>$wb){
      						?>
      						<tr>
      							<td><?php echo "$bulan-$tahun";?></td>
      							<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      							<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      							<td align="right">Rp. <?php  echo number_format('0',0,',','.');?></td>

      						</tr>
      						<?php
      						$jmlbayar=$jmlbayar-$wb;
      						}else{
      							if($jmlbayar>0){
      								$tambah = mktime(0,0,0,date($bulan)+1,date(10),date($tahun));
      								$tglkem= date("m-Y", $tambah);

      								$tgl=$datarencana['jatuhtempo'];
      								$tahun=substr($tgl,0,4);
      								$bulan=substr($tgl,5,2);

      								?>
      								<tr>
      									<td><?php echo "$bulan-$tahun";?></td>
      									<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      									<td align="right">Rp. <?php  echo number_format($jmlbayar,0,',','.');?></td>
      									<td align="right">Rp. <?php  echo number_format($wb-$jmlbayar,0,',','.');?></td>
      								</tr>
      							<?php
      								$jmlbayar=$jmlbayar-$wb;
      							}else{
      							?>
      								<tr>
      									<td><?php echo "$bulan-$tahun";?></td>
      									<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      									<td align="right">Rp. <?php  echo number_format('0',0,',','.');?></td>
      									<td align="right">Rp. <?php  echo number_format($wb,0,',','.');?></td>
      								</tr>
      							<?php
      							}
      						}
      						$n++;
      					}
      					?>
      					<tr class="info">
      						<td align="right">JUMLAH</td>
      						<td align="right">Rp. <?php  echo number_format($data2['deal'],0,',','.');?></td>
      						<td align="right">Rp. <?php  echo number_format($jumlah,0,',','.');?></td>
      						<td align="right">Rp. <?php
      							$sisa=$data2['deal']-$jumlah;
      							echo number_format($sisa,0,',','.');
      							?>
      						</td>
      					</tr>
      				</table>
      			</td>
      			<td valign="top" align="center"><?php
      				$cek = $this->db->query("select count(kodekontrak) as hubahuba from historibayar where kodekontrak='$id'")->row_array();
      				$aya=$cek['hubahuba'];
      				if ($aya==0){
      				?>
      					<h4>Maaf, mahasiswa/i ini belum melakukan pembayaran Cicilan!</h4>
      				<?php
      				}else{
      				?>
      					<table width="100%" border="1" bordercolor="#000000" class="garis2">
      						<tr class="warning">
      							<th>No.</th>
      							<th>BTK</th>
      							<th>BTB</th>
      							<th>Tgl. Bayar</th>
      							<th>Jumlah Bayar</th>
      						</tr>
      						<?php
      						$qqq = $this->db->query("SELECT nobukti,nobtk,nobtb,tgl,bayar FROM historibayar where kodekontrak='$id' order by nobukti asc");
      						foreach($qqq->result() as $ddd)
      						{
      						?>
      						<tr>
      							<td><?php echo $ddd->nobukti;?></td>
      							<td><?php echo $ddd->nobtk;?></td>
      							<td><?php echo $ddd->nobtb;?></td>
      							<?php
      							$bear1 = substr($ddd->tgl,2,2);
      							$bear2 = substr($ddd->tgl,5,2);
      							$bear3 = substr($ddd->tgl,8,2);
      							?>
      							<td><?php echo "$bear3/$bear2/$bear1";?></td>
      							<td align="right">Rp. <?php  echo number_format($ddd->bayar,0,',','.');?></td>
      						</tr>
      						<?php
      						}
      						$query3 = $this->db->query("SELECT sum(bayar) as menyeh FROM historibayar where kodekontrak='$id' order by nobukti asc");
      						$data3=$query3->row_array();
      						?>
      						<tr class="warning">
      							<td colspan="4">JUMLAH BAYAR</td>
      							<td align="right">Rp. <?php  echo number_format($data3['menyeh'],0,',','.');?></td>
      						</tr>
      					</table>
      					<?php
      				}
      					?>

      			</td>
      		  </tr>
      		  <?php
      			}

      		  ?>
      			</tr>
      		</table>
      <?php
      }
      ?>
  </section>

</body>
</html>
