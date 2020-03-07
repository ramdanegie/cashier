<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr class="info">
      <th colspan="5">RINCIAN PEMBAYRAN PROFESI</th>
    </tr>
    <tr class="info">
      <th>No</th>
      <th>No. Bukti</th>
      <th>Tanggal</th>
      <th>Terima Dari</th>
      <th>Jumlah</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      $totalreg = 0;
      foreach($reg as $r){
        $totalreg = $totalreg + $r->bayar;
    ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $r->nobukti; ?></td>
        <td><?php echo DateToIndo2($r->tgl); ?></td>
        <td><?php echo $r->terimadari; ?></td>
        <td align="right"><?php echo number_format($r->bayar,'0','','.'); ?></td>
      </tr>
    <?php
        $no++;
      }
    ?>
    <tr>
      <td colspan="4"><b>TOTAL</b></td>
      <td align="right"><b><?php echo number_format($totalreg,'0','','.'); ?></b></td>
    </tr>
  </tbody>

</table>
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr class="danger">
      <th colspan="5">RINCIAN PEMBAYRAN DANA PINJAMAN</th>
    </tr>
    <tr class="danger">
      <th>No</th>
      <th>No. Bukti</th>
      <th>Tanggal</th>
      <th>Terima Dari</th>
      <th>Jumlah</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      $totaldp = 0;
      foreach($dp as $d){
        $totaldp = $totaldp + $d->bayar;
    ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d->nobukti; ?></td>
        <td><?php echo DateToIndo2($d->tgl); ?></td>
        <td><?php echo $d->terimadari; ?></td>
        <td align="right"><?php echo number_format($d->bayar,'0','','.'); ?></td>
      </tr>
    <?php
        $no++;
      }
    ?>
    <tr>
      <td colspan="4"><b>TOTAL</b></td>
      <td align="right"><b><?php echo number_format($totaldp,'0','','.'); ?></b></td>
    </tr>
  </tbody>
</table>
