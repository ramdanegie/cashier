
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Pembayaran<small>Edit Pembayaran</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>pembayaran/update_lainlain" method="POST">
           <input id="nobukti" name="nobukti" value="<?php echo $hb['nobukti'];?>" type="hidden" >
           <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >
           <div class="modal-body">
             <div class="row">
               <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
                 <select class="form-control" name="pilih">
                   <option <?php  if($hb['nobtk'] != ""){echo "selected"; }?> value="btk">BTK</option>
                   <option <?php  if($hb['nobtb'] != ""){echo "selected"; }?> value="btb">BTB</option>
                 </select>
               </div>
               <div class="col-md-8 col-sm-12 col-xs-12 form-group has-feedback">
                 <?php
                  if(!empty($hb['nobtk'])){
                    $nobtkbtb = $hb['nobtk'];
                  }else{
                    $nobtkbtb = $hb['nobtb'];
                  }
                 ?>
                 <input type="text" class="form-control has-feedback-left" name ="nobtkbtb" value="<?php echo $nobtkbtb;  ?>" id="nobtkbtb" placeholder="Kosongkan Jika Diisi Otomatis" >
                 <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                 <input type="text"  class="form-control has-feedback-left" id="terimadari" value="<?php echo $hb['terimadari']; ?>" name ="terimadari"  placeholder="Terima Dari" required>
                 <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                 <select class="form-control" name="pilihjenis" required>
                   <option value="">-- Pilih Jenis Pembayaran --</option>
                   <option <?php if($hb['jenis']=="SEWA"){ echo "selected"; } ?> value="SEWA">Sewa</option>
                   <option <?php if($hb['jenis']=="KARYAWAN"){ echo "selected"; } ?> value="KARYAWAN">Kelas Karyawan</option>
                   <option <?php if($hb['jenis']=="PARKIR"){ echo "selected"; } ?> value="PARKIR">Parkir</option>
                   <option <?php if($hb['jenis']=="IHT"){ echo "selected"; } ?> value="IHT">IHT</option>
                   <option <?php if($hb['jenis']=="KURSUS"){ echo "selected"; } ?> value="KURSUS">Kursus</option>
                   <option <?php if($hb['jenis']=="LAINLAIN"){ echo "selected"; } ?> value="LAINLAIN">Lain-lain</option>
                 </select>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                 <input type="text"  class="form-control has-feedback-left" id="tglbayar" value="<?php echo $hb['tgl']; ?>" name ="tglbayar" placeholder="Tanggal Bayar" >
                 <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                 <input type="text" style="text-align:right" class="form-control has-feedback-left" value="<?php echo number_format($hb['bayar'],'0','','.');?>" name ="bayar" id="byredit" placeholder="Masukan Nominal Bayar" required>
                 <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                 <textarea class="form-control" placeholder="Keterangan"  name="ket" required><?php echo $hb['keterangan']; ?></textarea>
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
</div>
<script>
  var b = document.getElementById('byredit');
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
