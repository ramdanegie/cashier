<?php
  $no       =1;
  $sisatung = 0;
  $total    = 0;
  foreach ($cetak0 as $c ) {
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


    if($sumbayar<0){
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

    $nowa =  str_replace("0","62",$c->telepon);
    $text =  "Nama%20%3a%20*".$c->namamhs."*%0aKelas%20%3a%20*".$c->kelas."*%0aJumlah%20Tagihan%20%3a%20*".$sumnow."*%0a";

?>
  <tr>
    <td>
      <?php if($sumnow !=0 AND $surat=='1' OR $surat=='2'){ ?>
        <input type="checkbox"  name="kodekontrak[]" value ="<?php echo $c->kodekontrak; ?>" >
      <?php } ?>
    </td>
    <td><?php echo $no; ?></td>
    <td><?php echo $c->namamhs; ?></td>
    <td><?php echo $c->kelas_senior; ?></td>
    <td><?php echo $c->telepon; ?></td>
    <td><?php echo $c->ket; ?></td>
    <td align="right"><b><?php echo number_format($sumnow,'0','','.'); ?></b></td>
    <td align="right"><b><?php echo number_format($tung,'0','','.'); ?></b></td>
    <td><a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $nowa; ?>&text=<?php echo $text; ?>" class="btn btn-xs btn-success"><i class="fa fa-send"></i> Kirim via Whatsapp</a></td>
  </tr>
<?php
  $no++;
  $jumdata = $no -1;
  }
?>

<input type="hidden" name="jumdata" value="<?php echo $jumdata; ?>">
