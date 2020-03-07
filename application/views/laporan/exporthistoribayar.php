<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
<table class="datatable3" style="font-size:14px; font-family:Tahoma; width:70%" border="1px">
  <thead>
    <tr>
      <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN PROFESI </th>
    </tr>
    <tr class="info">
      <th>No.</th>
      <th>Tanggal</th>
      <th>BTK</th>
      <th>BTB</th>
      <th>Keterangan</th>
      <th>Kasir</th>
      <th>Jumlah Bayar</th>
    </tr>
</thead>
<tbody>
  <?php
    $cekprofesi = $profesi->num_rows();
    //echo $cekprofesi;
    $noprofesi   = 1;
    $jmlprofesi  = 0;
    if($cekprofesi !=0){
      foreach($profesi->result() as $p){

        $keterangan  = "Pembayaran ".$p->namamhs." Kelas ".$p->kelas." Untuk ".$p->keterangan;
        $jmlprofesi  = $jmlprofesi + $p->bayar;
  ?>
        <tr>
          <td><?php echo $noprofesi; ?></td>
          <td><?php echo $p->tgl; ?></td>
          <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $p->nobukti; ?>" target="_blank" style="color:blue"><?php echo $p->nobtk; ?></a></td>
          <td><?php echo $p->nobtb; ?></td>
          <td><?php echo $keterangan; ?></td>
          <td><?php echo $p->kasir; ?></td>
          <td align="right"><?php echo number_format($p->bayar,'0','','.'); ?></td>

        </tr>
<?php
      $noprofesi++;
      }
    }else{
      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
    }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmlprofesi,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
  <tr>
    <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN TINGKAT III </th>
  </tr>
  <tr class="info">
    <th>No.</th>
    <th>Tanggal</th>
    <th>BTK</th>
    <th>BTB</th>
    <th>Keterangan</th>
    <th>Kasir</th>
    <th>Jumlah Bayar</th>
  </tr>
</thead>
<tbody>
<?php
  $cektingkat3 = $tingkat3->num_rows();
  //echo $cekprofesi;
  $notingkat3   = 1;
  $jmltingkat3  = 0;
  if($cektingkat3 !=0){
    foreach($tingkat3->result() as $t3){

      $keterangan = "Pembayaran ".$t3->namamhs." Kelas ".$t3->kelas." Untuk ".$t3->keterangan;
      $jmltingkat3= $jmltingkat3 + $t3->bayar;
?>
      <tr>
        <td><?php echo $notingkat3; ?></td>
        <td><?php echo $t3->tgl; ?></td>
          <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $t3->nobukti; ?>" target="_blank" style="color:blue"><?php echo $t3->nobtk; ?></a></td>
        <td><?php echo $t3->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $t3->kasir; ?></td>
        <td align="right"><?php echo number_format($t3->bayar,'0','','.'); ?></td>

      </tr>
<?php
      $notingkat3++;
      }
    }else{
      echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
    }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmltingkat3,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN BIAYA PENDIDIKAN TINGKAT IV </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $cektingkat4 = $tingkat4->num_rows();
  //echo $cekprofesi;
  $notingkat4   = 1;
  $jmltingkat4  = 0;
  if($cektingkat4 !=0){
    foreach($tingkat4->result() as $t4){

      $keterangan = "Pembayaran ".$t4->namamhs." Kelas ".$t4->kelas." Untuk ".$t4->keterangan;
      $jmltingkat4= $jmltingkat4 + $t4->bayar;
?>
      <tr>
        <td><?php echo $notingkat4; ?></td>
        <td><?php echo $t4->tgl; ?></td>
        <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $t4->nobukti; ?>" target="_blank" style="color:blue"><?php echo $t4->nobtk; ?></a></td>
        <td><?php echo $t4->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $t4->kasir; ?></td>
        <td align="right"><?php echo number_format($t4->bayar,'0','','.'); ?></td>

      </tr>
<?php
    $notingkat4++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmltingkat4,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN KELAS KARYAWAN </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $cekkaryawan = $karyawan->num_rows();
  //echo $cekprofesi;
  $nokaryawan   = 1;
  $jmlkaryawan  = 0;
  if($cekkaryawan !=0){
    foreach($karyawan->result() as $k){

      $keterangan = $k->keterangan;
      $jmlkaryawan= $jmlkaryawan + $k->bayar;
?>
      <tr>
        <td><?php echo $nokaryawan; ?></td>
        <td><?php echo $k->tgl; ?></td>
          <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $k->nobukti; ?>" target="_blank" style="color:blue"><?php echo $k->nobtk; ?></a></td>
        <td><?php echo $k->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $k->kasir; ?></td>
        <td align="right"><?php echo number_format($k->bayar,'0','','.'); ?></td>

      </tr>
<?php
    $nokaryawan++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmlkaryawan,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN SEWA </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $ceksewa = $sewa->num_rows();
  //echo $cekprofesi;
  $nosewa   = 1;
  $jmlsewa  = 0;
  if($ceksewa !=0){
    foreach($sewa->result() as $s){
      $keterangan = $s->keterangan;
      $jmlsewa= $jmlsewa + $s->bayar;
?>
      <tr>
        <td><?php echo $nosewa; ?></td>
        <td><?php echo $s->tgl; ?></td>
        <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $s->nobukti; ?>" style="color:blue"><?php echo $s->nobtk; ?></a></td>
        <td><?php echo $s->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $s->kasir; ?></td>
        <td align="right"><?php echo number_format($s->bayar,'0','','.'); ?></td>

      </tr>
<?php
    $nosewa++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmlsewa,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN PARKIR </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $cekparkir = $parkir->num_rows();
  //echo $cekprofesi;
  $noparkir     = 1;
  $jmlparkir    = 0;
  if($cekparkir !=0){
    foreach($parkir->result() as $pk){
      $keterangan = $s->keterangan;
      $jmlparkir= $jmlparkir + $pk->bayar;
?>
      <tr>
        <td><?php echo $noparkir; ?></td>
        <td><?php echo $pk->tgl; ?></td>
        <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $pk->nobukti; ?>" style="color:blue"><?php echo $pk->nobtk; ?></a></td>
        <td><?php echo $pk->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $pk->kasir; ?></td>
        <td align="right"><?php echo number_format($pk->bayar,'0','','.'); ?></td>

      </tr>
<?php
    $noparkir++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmlparkir,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN IHT </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $cekiht    = $iht->num_rows();
  //echo $cekprofesi;
  $noiht     = 1;
  $jmliht    = 0;
  if($cekiht !=0){
    foreach($iht->result() as $i){
      $keterangan = $s->keterangan;
      $jmliht= $jmliht + $i->bayar;
?>
      <tr>
        <td><?php echo $noiht; ?></td>
        <td><?php echo $i->tgl; ?></td>
        <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $i->nobukti; ?>" style="color:blue"><?php echo $i->nobtk; ?></a></td>
        <td><?php echo $i->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $i->kasir; ?></td>
        <td align="right"><?php echo number_format($i->bayar,'0','','.'); ?></td>
      </tr>
<?php
    $noiht++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmliht,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN KURSUS </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $cekkursus    = $kursus->num_rows();
  //echo $cekprofesi;
  $nokursus     = 1;
  $jmlkursus    = 0;
  if($cekkursus !=0){
    foreach($kursus->result() as $kr){
      $keterangan = $kr->keterangan;
      $jmlkursus= $jmlkursus + $kr->bayar;
?>
      <tr>
        <td><?php echo $nokursus; ?></td>
        <td><?php echo $kr->tgl; ?></td>
        <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $kr->nobukti; ?>" style="color:blue"><?php echo $kr->nobtk; ?></a></td>
        <td><?php echo $kr->nobtb; ?></td>
        <td><?php echo $keterangan; ?></td>
        <td><?php echo $kr->kasir; ?></td>
        <td align="right"><?php echo number_format($kr->bayar,'0','','.'); ?></td>
      </tr>
<?php
    $nokursus++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmlkursus,'0','','.'); ?></b></td>
    </tr>
</tbody>
<thead>
<tr>
  <th class="success" colspan="7">PEMBAYARAN LAIN LAIN </th>
</tr>
<tr class="info">
  <th>No.</th>
  <th>Tanggal</th>
  <th>BTK</th>
  <th>BTB</th>
  <th>Keterangan</th>
  <th>Kasir</th>
  <th>Jumlah Bayar</th>
</tr>
</thead>
<tbody>
<?php
  $ceklainlain    = $lainlain->num_rows();
  //echo $cekprofesi;
  $nolainlain     = 1;
  $jmllainlain    = 0;
  if($ceklainlain !=0){
    foreach($lainlain->result() as $l){
      $keterangan = $l->keterangan;
      $jmllainlain= $jmllainlain + $l->bayar;
?>
      <tr>
        <td><?php echo $nolainlain; ?></td>
        <td><?php echo $l->tgl; ?></td>
        <td><a href="<?php echo base_url(); ?>pembayaran/cetakbtk/<?php echo $l->nobukti; ?>" style="color:blue"><?php echo $l->nobtk; ?></a></td>
        <td><?php echo $l->nobtb; ?></td>
        <td><?php echo $keterangan." terima dari ".$l->terimadari; ?></td>
        <td><?php echo $l->kasir; ?></td>
        <td align="right"><?php echo number_format($l->bayar,'0','','.'); ?></td>
      </tr>
<?php
    $nolainlain++;
    }
  }else{
    echo "<td colspan='7' align='center'>-- Data Tidak Ada --</td>";
  }
?>
    <tr class="info">
      <td colspan="6"><b>JUMLAH</b></td>
      <td align="right"><b><?php echo number_format($jmllainlain,'0','','.'); ?></b></td>
    </tr>
    <tr class="success">
      <?php

        $total = $jmlprofesi + $jmltingkat3 + $jmltingkat4 + $jmlkaryawan + $jmlsewa + $jmlparkir + $jmliht + $jmlkursus + $jmllainlain;

      ?>
      <td colspan="6"><b>TOTAL</b></td>
      <td align="right"><b><?php echo number_format($total,'0','','.'); ?></b></td>
    </tr>
</tbody>
</table>
