
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Pembayaran Lain Lain<small>Data Pembayaran</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <a href="#" id="bayar" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Input Penerimaan Lain Lain </a>
        <hr>
				<table class="table table-bordered table-striped table-hover jambo_table" style="font-size:10px"  id="tabellainlain">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>Tanggal</th>
							<th>Jenis</th>
              <th>Terima Dari</th>
              <th>Keterangan</th>
              <th>Jumlah</th>
              <th>No BTK</th>
              <th>Kasir</th>
							<th style="width:100px">Action</th>
						</tr>
					</thead>
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
      <form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>pembayaran/inputlainlain" method="POST">

       <input id="kasir" name="kasir" value="<?php echo $fullname;?>" type="hidden" >

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
             <input type="text"  class="form-control has-feedback-left" id="terimadari" name ="terimadari"  placeholder="Terima Dari" required>
             <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
             <select class="form-control" name="pilihjenis" required>
               <option value="">-- Pilih Jenis Pembayaran --</option>
               <option value="SEWA">Sewa</option>
               <option value="KARYAWAN">Kelas Karyawan</option>
               <option value="PARKIR">Parkir</option>
               <option value="IHT">IHT</option>
               <option value="KURSUS">Kursus</option>
               <option value="LAINLAIN">Lain-lain</option>
             </select>
           </div>
         </div>
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
  $("#bayar").click(function(e){
    e.preventDefault();
    $("#modal").modal("show");
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
  $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
  {
    return {
      "iStart": oSettings._iDisplayStart,
      "iEnd": oSettings.fnDisplayEnd(),
      "iLength": oSettings._iDisplayLength,
      "iTotal": oSettings.fnRecordsTotal(),
      "iFilteredTotal": oSettings.fnRecordsDisplay(),
      "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
  };

  var t = $("#tabellainlain").dataTable({
    initComplete: function() {
      var api = this.api();
      $('#tabellainlainr_filter input')
          .off('.DT')
          .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
              api.search(this.value).draw();
        }
      });
    },
    oLanguage: {
      sProcessing: "loading..."
    },
    processing		: true,
    serverSide		: true,
    bLengthChange	: false,

    ajax: {"url": "<?php echo base_url(); ?>pembayaran/get_lainlain", "type": "POST"},
    columns: [
      {
        "data"     : "nobukti",
        "orderable": false
      },

      {"data": "tgl"},
      {"data": "jenis"},
      {"data": "terimadari"},
      {"data": "keterangan"},
      {"data": "bayar"},
      {"data": "nobtk"},
      {"data": "kasir"},
      {"data": "view"}
    ],
    order: [[6, 'desc']],
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $('td:eq(0)', row).html(index);
    }
  });

</script>
