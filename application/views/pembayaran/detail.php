<?php error_reporting(0); ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Rincian Pembayaran<small>Data Rincian Pembayaran</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
						<div class="profile_img">
							<div id="crop-avatar">
								<!-- Current avatar -->
								<img  style="margin-left:34px;" class="img-responsive avatar-view" src="<?php echo base_url(); ?>assets/images/avatar.jpg" alt="Avatar" title="Change the avatar">
							</div>
						</div>
						<h3 align="center"><?php echo $reg['namamhs']; ?></h3>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="profile_title">
							<div class="col-md-6">
								<h2>Profile</h2>
							</div>
						</div>
						<table class="table table-striped table-hover">
							<tr>
								<th>NIM</th>
								<td>:</td>
								<td><?php echo $reg['nim']; ?></td>
							</tr>
							<tr>
								<th>Nama Mahasiswa</th>
								<td>:</td>
								<td><?php echo $reg['namamhs']; ?></td>
							</tr>
							<tr>
								<th>Kelas</th>
								<td>:</td>
								<td><?php echo $reg['kelas']; ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>:</td>
								<td><?php echo $reg['ket']; ?></td>
							</tr>
							<tr>
								<th>Tanggal Registrasi</th>
								<td>:</td>
								<td><?php echo DateToIndo2($reg['tglregis']); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12">
            <div class="x_panel">
              <div class="x_content">
								<table class="table table-striped table-hover">
									<tr>
										<th>Harga Normal</th>
										<td>:</td>
										<td align="right" style="color:green; font-weight:bold"><?php echo number_format($reg['biaya'],'0','','.'); ?></td>
									</tr>
									<tr>
										<th>Potongan Gelombang</th>
										<td>:</td>
										<td align="right" style="color:red; font-weight:bold"><?php echo number_format($reg['diskongelombang'],'0','','.'); ?></td>
									</tr>
									<tr>
										<th>Potongan Prestasi</th>
										<td>:</td>
										<td align="right" style="color:red; font-weight:bold"><?php echo number_format($reg['diskonprestasi'],'0','','.'); ?></td>
									</tr>
									<tr>
										<th>Potongan Cash</th>
										<td>:</td>
										<td align="right" style="color:red; font-weight:bold"><?php echo number_format($reg['diskoncash'],'0','','.'); ?></td>
									</tr>
									<tr>
										<th>Potongan Lain</th>
										<td>:</td>
										<td align="right" style="color:red; font-weight:bold"><?php echo number_format($reg['diskonlain'],'0','','.'); ?></td>
									</tr>
                  <tr>
										<th>Penyesuaian</th>
										<td>:</td>
										<td align="right" style="color:green; font-weight:bold"><?php echo number_format($reg['penyesuaian'],'0','','.'); ?></td>
									</tr>
								</table>

							</div>
          	</div>
					</div>
					<div class="col-md-6 col-xs-12">
            <div class="x_panel">
              <div class="x_content">
								<table class="table table-striped table-hover">
									<?php
										$wajibbayar = $reg['hargadeal'] - $reg['registrasi'];
										if($reg['jenisregis']=='DANAPINJAMAN'){
											$q 	= "SELECT SUM(wajibbayar) as jmlwajibbayar FROM detailrencana WHERE kodekontrak = '$kodereg' GROUP BY kodekontrak";
											$d 	= $this->db->query($q)->row_array();
											$w	= $d['jmlwajibbayar'];
											$dp = $reg['hargadeal']-$w;
											$wb = $wajibbayar - $dp;
											$ket= "";
										}else{
											$wb = $wajibbayar;
											$ket= $reg['jenisregis'];
										}
									?>
									<tr>
										<th>Harga Deal</th>
										<td>:</td>
										<td align="right" style="color:green; font-weight:bold"><?php echo number_format($reg['hargadeal'],'0','','.'); ?></td>
									</tr>
									<tr>
										<th>Registrasi</th>
										<td>:</td>
										<td align="right" style="color:green; font-weight:bold"><?php echo number_format($reg['registrasi'],'0','','.'); ?></td>
									</tr>
									<?php if($reg['jenisregis']=='DANAPINJAMAN'){ ?>
									<tr>
										<th>Dana Pinjaman</th>
										<td>:</td>
										<td align="right" style="color:green; font-weight:bold"><?php echo number_format($dp,'0','','.'); ?></td>
									</tr>
									<?php } ?>
									<tr>
										<th>Wajib Bayar</th>
										<td>:</td>
										<td align="right" style="color:green; font-weight:bold"><?php echo number_format($wb,'0','','.'); ?></td>
									</tr>
									<tr>
										<th>Keterangan</th>
										<td>:</td>
										<td><?php echo $ket; ?></td>
									</tr>
									<tr>
										<th></th>
										<td>:</td>
										<td></td>
									</tr>
								</table>
                <a href="<?php echo base_url(); ?>pembayaran/editregistrasi/<?php echo $reg['kodekontrak']; ?>" class="btn btn-info btn-sm" name="input-mhs"><i class="fa fa-pencil"></i> Edit Rencana Registrasi</a>
        				<a href="<?php echo base_url();?>pembayaran/hapusregistrasi/<?php echo $reg['kodekontrak']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin mau menghapus data registrasi ini?')"><i class="fa fa-trash-o"></i> Hapus Data Registrasi</a>
							</div>
          	</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-xs-12">
						<div class="x_title">
							<h2>Rencana Pembayaran<small>Data Rencana</small></h2>
							<div class="clearfix"></div>
						</div>
						<table class="table table-striped">
							<tr>
								<th colspan="3"><a href="<?php echo base_url(); ?>pembayaran/editrencana/<?php echo $kodereg; ?>" class="btn btn-sm btn-success">Edit Rencana Pembayaran</a></th>
							</tr>
							<tr class="bg-primary" style="font-size:12px">
								<th>Cicilan Ke</th>
								<th>Jatuh Tempo</th>
								<th>Wajib Bayar</th>
							</tr>
							<tr style="font-size:11px">
								<td>REGISTRASI</td>
								<td></td>
								<td align="right" style="color:blue; font-weight:bold"><?php echo number_format($reg['registrasi'],'0','','.'); ?></td>
							</tr>
							<?php foreach ($ren as $r){ ?>
							<tr style="font-size:11px">
								<td><?php echo $r->cicilanke; ?></td>
								<td><?php echo $r->jatuhtempo; ?></td>
								<td align="right" style="color:blue; font-weight:bold"><?php echo number_format($r->wajibbayar,'0','','.'); ?></td>
							</tr>
							<?php } ?>
							<?php if($reg['jenisregis']=='DANAPINJAMAN'){ ?>
							<tr class="bg-primary" style="font-size:11px">
								<th colspan="2">TOTAL RENCANA BAYAR</th>
								<td align="right" style="font-weight:bold"><?php echo number_format($w,'0','','.'); ?></td>
							</tr>
						<?php }else{ ?>
              <tr class="bg-primary" style="font-size:12px">
								<th colspan="2">TOTAL RENCANA BAYAR</th>
								<td align="right" style="font-weight:bold"><?php echo number_format($reg['hargadeal'],'0','','.'); ?></td>
							</tr>
						<?php } ?>
						</table>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="x_title">
							<h2>Posting Pembayaran<small>Data Posting Pembayaran</small></h2>
							<div class="clearfix"></div>
						</div>
						<table class="table table-striped">
							<tr>
								<th colspan="4"><a href="#" class="btn btn-sm btn-default" style="color:white" disabled>A</a></th>
							</tr>
							<tr class="bg-danger" style="font-size:12px">
								<th>Bulan</th>
								<th>Rencana</th>
								<th>Realisasi</th>
								<th>Tunggakan</th>
							</tr>
							<?php
								$n 							=	 0;
								$jmlbayar 			= $hb['jumlah'];
                $jumlah         = $hb['jumlah'];
								$cicilanper			= $reg['cicilanper'];
                $sumwajib       = $jmlcicilan;
                while($n < $sumwajib){
                  $qrencana     = "SELECT jatuhtempo, wajibbayar FROM detailrencana where kodekontrak='$kodereg' and cicilanke='$n'";
                  $datarencana  = $this->db->query($qrencana)->row_array();
                  $wb           = $datarencana['wajibbayar'];
                  $tgl          = $datarencana['jatuhtempo'];
				          $tahun        = substr($tgl,0,4);
				          $bulan        = substr($tgl,5,2);
                  if($jmlbayar>$wb){
                  ?>
                    <tr style="font-size:11px">
                      <td><?php echo "$bulan-$tahun";?></td>
                      <td align="right"><?php  echo number_format($wb,0,',','.');?></td>
                      <td align="right"><?php  echo number_format($wb,0,',','.');?></td>
                      <td align="right" style="color:red; font-weight:bold"><?php  echo number_format('0',0,',','.');?></td>
                    </tr>
                  <?php
                    $jmlbayar = $jmlbayar-$wb;
                  }else{
                    if($jmlbayar > 0){
                      $tambah   = mktime(0,0,0,date($bulan)+1,date(10),date($tahun));
						          $tglkem   = date("m-Y", $tambah);
						          $tgl      = $datarencana['jatuhtempo'];
						          $tahun    = substr($tgl,0,4);
						          $bulan    = substr($tgl,5,2);
                    ?>
                    <tr style="font-size:11px">
                      <td><?php echo "$bulan-$tahun";?></td>
                      <td align="right"><?php  echo number_format($wb,0,',','.');?></td>
                      <td align="right"><?php  echo number_format($jmlbayar,0,',','.');?></td>
                      <td align="right" style="color:red; font-weight:bold"><?php  echo number_format($wb-$jmlbayar,0,',','.');?></td>
                    </tr>
                    <?php
                    $jmlbayar = $jmlbayar-$wb;
                  }else{
                  ?>
                    <tr style="font-size:11px">
                      <td><?php echo "$bulan-$tahun";?></td>
                      <td align="right"><?php  echo number_format($wb,0,',','.');?></td>
                      <td align="right"><?php  echo number_format('0',0,',','.');?></td>
                      <td align="right" style="color:red; font-weight:bold"><?php  echo number_format($wb,0,',','.');?></td>
                    </tr>
                  <?php
                  }
                }
                $n++;
              }
              if($reg['jenisregis']=="DANAPINJAMAN"){
        			?>
        			<tr class="bg-danger" style="font-size:12px; font-weight:bold">
        				<td align="right">JUMLAH</td>
        				<td align="right"><?php  echo number_format($meng,0,',','.');?></td>
        				<td align="right"><?php  echo number_format($jumlah,0,',','.');?></td>
        				<td align="right">
                  <?php
                    $sisa = $reg['hargadeal']-$jumlah-$dp;
          					echo number_format($sisa,0,',','.');
        					?>
        				</td>
        			</tr>
        			<?php
        			}else{
        			?>
        			<tr class="danger" style="font-size:12px; font-weight:bold">
        				<td align="right">JUMLAH</td>
        				<td align="right"><?php  echo number_format($reg['hargadeal'],0,',','.');?></td>
        				<td align="right"><?php  echo number_format($jumlah,0,',','.');?></td>
        				<td align="right"><?php
        					$sisa  = $reg['hargadeal']-$jumlah;
        					echo number_format($sisa,0,',','.');
        					?>
        				</td>
        			</tr>
        			<?php
        			}
        			?>
						</table>
					</div>
					<div class="col-md-5 col-xs-12">
						<div class="x_title">
							<h2>Histori Pembayaran<small>Data Histori Pembayaran</small></h2>
							<div class="clearfix"></div>
						</div>
            <?php
              $cek = $hbayar->num_rows();
              if(empty($cek) && !empty($reg['harga_deal'])){
            ?>
            <h4>Maaf, mahasiswa/i ini belum melakukan pembayaran Cicilan!</h4>
            <td align="right"><a href="#" id="bayar" class="btn btn-success btn-sm" name="input-mhs">Bayar Registrasi</a></td>
            <?php
              }else{
            ?>
              <table class="table table-striped">
  							<tr>
                  <?php if($sisa > 0){ ?>
                    <th colspan="6"><a href="#" id="bayar" class="btn btn-sm btn-danger" style="color:white">Bayar Cicilan</a></th>
                  <?php }else{ ?>
                    <th colspan="6"><a href="#" disabled class="btn btn-sm btn-success" style="color:white">LUNAS</a></th>
                  <?php } ?>
  							</tr>
  							<tr class="bg-success" style="font-size:11px">
  								<th>No</th>
  								<th>BTK</th>
  								<th>BTB</th>
  								<th>Tgl Bayar</th>
  								<th>Jumlah</th>
                  <th></th>
  							</tr>
                <?php $totalbayar = 0; foreach($hbayar->result() as $h){ $totalbayar = $totalbayar + $h->bayar; ?>
                  <tr style="font-size:11px">
                    <td><?php echo $h->nobukti;?></td>
                    <td><?php echo $h->nobtk;?></td>
                    <td><?php echo $h->nobtb;?></td>
                    <?php
          					$bear1 = substr($h->tgl,2,2);
          					$bear2 = substr($h->tgl,5,2);
          					$bear3 = substr($h->tgl,8,2);
          					?>
                    <td><?php echo "$bear3/$bear2/$bear1";?></td>
                    <td align="right">Rp. <?php  echo number_format($h->bayar,0,',','.');?></td>
                    <td>
                      <a href="#" class="btn btn-info btn-xs edit" data-id="<?php echo $h->nobukti; ?>"><i class="fa fa-pencil"></i></a>
                      <a href="<?php echo base_url(); ?>pembayaran/hapusbayar/<?php echo $h->nobukti; ?>/<?php echo $kodereg; ?>" class="btn btn-danger btn-xs hapus"><i class="fa fa-trash-o"></i></a>
    									<a href="<?php echo base_url(); ?>pembayaran/cetakkwitansi/<?php echo $h->nobukti; ?>" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                    </td>
                  </tr>
                <?php } ?>
                <tr class="success">
                  <td colspan="4">JUMLAH BAYAR</td>
                  <td align="right"><?php  echo number_format($totalbayar,0,',','.');?></td>
                  <td>&nbsp </td>
                </tr>
  						</table>
            <?php } ?>
					</div>
				</div>
			</div>
		</div>
</div>
<div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
       </button>
       <h4 class="modal-title" id="myModalLabel">BAYAR</h4>
      </div>
      <form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>pembayaran/bayar" method="POST">
       <input id="kodekontrak" type="hidden" name="kodekontrak" value="<?php echo $kodereg;?>" readonly="readonly" >
       <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
       <input id="terimadari" name="terimadari" value="<?php echo $reg['namamhs'];?>" type="hidden" >
       <div class="modal-body">
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <input type="text"  class="form-control has-feedback-left" id="tglbayar" name ="tglbayar" value="<?php echo $tglmeng; ?>" placeholder="Tanggal Bayar" >
             <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="bayar" id="byr" placeholder="Masukan Nominal Bayar" >
             <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
         <div class="row">
           <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
             <select class="form-control" name="pilih">
               <option value="btk">BTK</option>
               <option value="btb">BTB</option>
             </select>
           </div>
           <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
             <input type="text" class="form-control has-feedback-left" name ="nobtkbtb" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
             <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-primary" type="submit">Save changes</button>
       </div>
      </form>
    </div>
 </div>
</div>

<div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
       </button>
       <h4 class="modal-title" id="myModalLabel">EDIT BAYAR</h4>
      </div>
      <div id="modal-body">
      </div>
    </div>
 </div>
</div>
<script>
  var b = document.getElementById('byr');
  b.addEventListener('keyup', function(e){
    b.value = formatRupiah(this.value, '');
    //alert(b);
  });
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }
  function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
  }
</script>
 <script>
   $(function(){

    $("#tglbayar").daterangepicker({
      singleDatePicker  :!0,
      singleClasses     :"picker_1",
      locale            : {
                            format: 'YYYY-MM-DD'
                          }
    });

    $("#bayar").click(function(e){
      e.preventDefault();
      $("#modal").modal("show");
    });

    $(".edit").click(function(e){
      e.preventDefault();
      nobukti  = $(this).attr('data-id');
      $("#modaledit").modal("show");
      $("#modal-body").load("<?php echo base_url(); ?>pembayaran/editbayar/"+nobukti);
    });

    $('.hapus').on('click',function(){
        var getLink = $(this).attr('href');
        swal({
                title             : 'Alert',
                text              : 'Hapus Data?',
                html              : true,
                confirmButtonColor: '#d9534f',
                showCancelButton  : true,
                },function(){
                window.location.href = getLink
            });
        return false;
    });

   });

 </script>
