
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Laporan Periode Semua Tingkat<small>RPT</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <form class="form-horizontal form-label-left" id="cust_form" target="_blank" autocomplete="off"  action="" method="POST">
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

        </form>
        <center>
          <h3>
            DAFTAR RENCANA, PEMBAYARAN / REALISASI  & TUNGGAKAN BIAYA PENDIDIKAN<br>
            TAHUN AJARAN <b id="tahun1"></b>
          </h3>
        </center>
        <table  width="100%"class="table table-bordered table-striped table-hover">
          <tr align="center" class="info"><th colspan=15>RENCANA</th></tr>
        	<tr align="center" class="warning">
            <th>Tingkat</th>
            <th>Sebelum Juli</th>
            <th>Juli</th>
            <th>Agustus</th>
            <th>September</th>
            <th>Oktober</th>
            <th>Nopember</th>
            <th>Desember</th>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
            <th>Jumlah</th>
        	</tr>
          <tbody id="loadrencana">
          </tbody>
        </table>
        <table style="width:100%">
          <tr>
            <td></td>
            <td align="center">Tasikmalaya,<?php echo date('Y-m-d'); ?></td>
          </tr>
          <tr>
            <td align="center">Head Of Finance & HRD</td>
            <td align="center">Branch Manager</td>
          </tr>
          <tr>
            <td style="height:100px"></td>
            <td></td>
          </tr>
          <tr>
            <td align="center"><b>Dheri Febiyani Lestari,M.M</b></td>
            <td align="center"><b>H. Rudi Kurniawa,S.T,M.M</b></td>
          </tr>

        </table>
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url(); ?>asset/images/loadingemot.gif" / width="200px" height="150px">
        <div clas="loader-txt">
          <p><b>Mohon Ditunggu Gaees.. ! <br> Sedang Proses Menampilkan Data....</b></p>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
    $(function(){

    $(document).ajaxStart(function(){
      $("#loadMe").modal({
        backdrop: "static", //remove ability to close modal with click
        keyboard: false, //remove option to close with keyboard
        show: true //Display loader!
      });
    });
    $(document).ajaxComplete(function(){
       $("#loadMe").modal("hide");
    });

    $("#tahunajaran").change(function(e){
      var tahunajaran   = $(this).val();
      var tahunajaran2  = parseInt(tahunajaran) + 1;
      $("#tahun1").text(tahunajaran+"/"+tahunajaran2);
      $("#loadrencana").load("<?php echo base_url(); ?>laporan/loadrencana/"+tahunajaran);
      return false;
    });
  });
</script>
