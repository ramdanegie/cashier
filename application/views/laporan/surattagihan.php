
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Cetak  Surat Tagihan<small>Surat Tagihan</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <form class="form-horizontal form-label-left" id="cust_form"  autocomplete="off" target="_blank"  action="<?php echo base_url(); ?>laporan/cetak_surattagihan" method="POST">
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="tahunajaran" id="tahunajaran" >
                <option value="">-- Tahun Ajaran --</option>
                <?php foreach($angkatan as $angs){ $angs2 = $angs->angkatan + 1; $angkatan = $angs->angkatan."/".$angs2; ?>

                  <option  value="<?php echo $angs->angkatan; ?>"><?php echo $angkatan; ?></option>
                <?php } ?>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >
              <select class="form-control" name="tingkat" id="tingkat" >
                <option value="">-- Tingkat --</option>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">

              <select class="form-control" name="jurusan" id="jurusan" >
                <option value="">-- Jurusan --</option>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="kelas" id="kelas" >
                <option value="">-- Kelas --</option>
              </select>
      			</div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" value="<?php echo date('Y-m-d'); ?>"  class="form-control has-feedback-left" id="batastgl" name ="batastgl"  placeholder="Tunggakan Sampai Tanggal" >
              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
            </div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="surat" id="surat" required >
                <option value="">-- Pilih Surat --</option>
                <option value="1">Tagihan</option>
                <option value="2">Informasi UAS</option>
              </select>
      			</div>
          </div>
        	<div class="modal-footer">
        	  <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-print"></i> Cetak</button>
        	</div>

        <table class="table table-bordered table-hover table-striped">
          <thead>

            <tr class="success">
              <th style="width:100px">
                <input type="checkbox" onClick="toggle(this)"> Check All
              </th>
              <th style="text-align:center">No</th>
              <th style="text-align:center">Nama</th>
              <th style="text-align:center">Kelas Senior</th>
              <th style="text-align:center">Tlp/HP</th>
              <th style="text-align:center">Status</th>
              <th style="text-align:center">Jumlah Tunggakan <br>(s/d)</th>
              <th style="text-align:center">Jumlah Tunggakan<br>(s/d Akhir Periode)</th>
              <th style="text-align:center">Kirim Tagihan</th>
            </tr>
          </thead>
          <tbody id="loaddatatunggakan">
          </tbody>
        </table>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function toggle(pilih)
{
  checkboxes = document.getElementsByName('kodekontrak[]');
  for(var i=0, n=checkboxes.length;i<n;i++)
  {
    checkboxes[i].checked = pilih.checked;
   }
 }

 </script>
<script>

  $(function(){

    function loaddatatunggakan(){
     var surat        = $("#surat").val();
      var ta          = $("#tahunajaran").val();
      var tingkat     = $("#tingkat").val();
      var kelas       = $("#kelas").val();
      var batastgl    = $("#batastgl").val();
      //alert(batastgl);
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporan/loaddatatunggakan',
        cache   : false,
        data    : {ang:ta,tingkat:tingkat,kelas:kelas,batastgl:batastgl,surat:surat},
        success : function(respond){
          $("#loaddatatunggakan").html(respond);
        }

      });
    }



    function loadTingkat(){
      var tingkats = $("#tingkats").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporan/gettingkat2',
        cache   : false,
        data    : {tingkats:tingkats},
        success : function(respond){
          $("#tingkat").html(respond);

        }
      });
    }
    loadTingkat();

    $("#tahunajaran").change(function(){
      loadTingkat();
      loaddatatunggakan();
    });

    $("#tingkat").change(function(){
      var ta        = $("#tahunajaran").val();
      var tingkat   = $("#tingkat").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporan/getjurusan',
        data    : {ta:ta,tingkat:tingkat},
        cache   : false,
        success : function(respond){
          $("#jurusan").html(respond);
          loaddatatunggakan();
        }
      });
    });

    $("#jurusan").change(function(){
      var ta          = $("#tahunajaran").val();
      var tingkat     = $("#tingkat").val();
      var jurusan     = $("#jurusan").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporan/getkelas',
        data    : {ta:ta,tingkat:tingkat,jurusan:jurusan},
        cache   : false,
        success : function(respond){
          $("#kelas").html(respond);
          loaddatatunggakan();
        }
      });
    });

    $("#kelas").change(function(){
      loaddatatunggakan();
    });

    $("#batastgl").change(function(){
      loaddatatunggakan();
    });

    $("#batastgl").daterangepicker({
      singleDatePicker  :!0,
      singleClasses     :"picker_1",
      locale            : {
                            format: 'YYYY-MM-DD'
                          }
    });

    $("#surat").change(function(){
      loaddatatunggakan();
    });


  });

</script>
