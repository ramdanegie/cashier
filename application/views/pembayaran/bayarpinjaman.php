
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Penerima Dana Pinjaman<small>Data Penerima Dana Pinjaman</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<table class="table table-bordered table-striped table-hover jambo_table" style="font-size:10px"  id="tabellainlain">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>NIM</th>
							<th>Nama</th>
              <th>Kelas</th>
              <th>Dana Pinjaman</th>
              <th>Sudah Membayar</th>
							<th style="width:400px">Action</th>
						</tr>
					</thead>
          <tbody>
            <?php
              $no = 1;
              foreach($dp->result() as $d){
    						$hd           = $d->hargadeal;
    						$rg           = $d->registrasi;
    						$ss           = $hd-$rg;
                $danapinjaman = $hd - $d->meng;
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $d->nim; ?></td>
                <td><?php echo $d->namamhs; ?></td>
                <td><?php echo $d->kelas; ?></td>
                <td align="right"><?php echo number_format($danapinjaman,'0','','.'); ?></td>
                <td align="right"><?php echo number_format($d->jumlahbayar,'0','','.'); ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>pembayaran/detail/<?php echo $d->kodekontrak; ?>" class="btn btn-xs btn-info"> Rincian Profesi </a>
                  <a href="#" data-kode ="<?php echo $d->kodekontrak; ?>" class="btn btn-xs btn-danger hb"> Histori Bayar </a>
                  <a href="#" class="btn btn-xs btn-warning bayar" data-kode="<?php echo $d->kodekontrak; ?>" data-nama="<?php echo $d->namamhs; ?>"> Bayar Pinjaman </a>
                </td>
              </tr>
            <?php
              $no++;
            }
            ?>
          </tbody>
				</table>
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
      <form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>pembayaran/inputbayarpinjaman" method="POST">

       <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
       <input id="kodekontrak" name="kodekontrak"  type="hidden" >

       <div class="modal-body">
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
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <input type="text"  class="form-control has-feedback-left" readonly id="terimadari" name ="terimadari"  placeholder="Terima Dari" required>
             <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
         <input type="hidden" name="pilihjenis" value="DANAPINJAMAN">
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <input type="text"  class="form-control has-feedback-left" id="tglbayar" name ="tglbayar" value="<?php echo $tglmeng; ?>" placeholder="Tanggal Bayar" >
             <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="bayar" id="byr" placeholder="Masukan Nominal Bayar" required>
             <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <textarea class="form-control" placeholder="Keterangan" name="ket" required></textarea>
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
<div class="modal fade bs-example" id="historibayar" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
       </button>
       <h4 class="modal-title" id="myModalLabel">HISTORI BAYAR</h4>
      </div>
      <div id="modalbodyedit" style="margin-left:5px; margin-right:5px">

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
    $("#tabellainlain").DataTable();
    $(".bayar").click(function(e){
      e.preventDefault();
      var kodekontrak = $(this).attr('data-kode');
      var nama        = $(this).attr('data-nama');
      $("#kodekontrak").val(kodekontrak);
      $("#terimadari").val(nama);
      $("#modal").modal("show");
    });

    $(".hb").click(function(e){
      var kodekontrak = $(this).attr('data-kode');
      e.preventDefault();
      $("#historibayar").modal("show");
      $("#modalbodyedit").load("<?php echo base_url(); ?>pembayaran/historibayarpinjaman/"+kodekontrak);
    });

  });
</script>
