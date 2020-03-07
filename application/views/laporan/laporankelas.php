
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Laporan  Data Tagihan<small>Data Tagihan</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <form class="form-horizontal form-label-left" id="cust_form" target="_blank" autocomplete="off"  action="<?php echo base_url(); ?>laporan/cetaklaporankelas" method="POST">
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="tahunajaran" id="tahunajaran" required>
                <option value="">-- Tahun Ajaran --</option>
                <?php foreach($angkatan as $ang){ $ang2 = $ang->angkatan + 1; $angkatan = $ang->angkatan."/".$ang2; ?>

                  <option value="<?php echo $ang->angkatan; ?>"><?php echo $angkatan; ?></option>
                <?php } ?>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >
              <select class="form-control" name="tingkat" id="tingkat" required>
                <option value="">-- Tingkat --</option>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="jurusan" id="jurusan" required>
                <option value="">-- Jurusan --</option>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="kelas" id="kelas" required>
                <option value="">-- Kelas --</option>
              </select>
      			</div>
          </div>
          <div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <select class="form-control" name="jenislaporan" id="jenislaporan" required>
                <option value="">-- Jenis Laporan --</option>
              </select>
      			</div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text"  class="form-control has-feedback-left" id="batastgl" name ="batastgl"  placeholder="Tunggakan Sampai Tanggal" >
              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
            </div>
          </div>
        	<div class="modal-footer">
        	  <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-print"></i> Cetak</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

  $(function(){

    $("#tahunajaran").change(function(){
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporan/gettingkat',
        cache   : false,
        success : function(respond){
          $("#tingkat").html(respond);
        }
      });
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
        }
      });
    });

    $("#kelas").change(function(){

      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporan/getjenislaporan',
        cache   : false,
        success : function(respond){
          $("#jenislaporan").html(respond);
        }
      });
    });

    $("#batastgl").daterangepicker({
      singleDatePicker  :!0,
      singleClasses     :"picker_1",
      locale            : {
                            format: 'YYYY-MM-DD'
                          }
    });


  });

</script>
