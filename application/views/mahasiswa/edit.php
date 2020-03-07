<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>mahasiswa/update" method="POST">

	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" readonly value="<?php echo $mhs['nim']; ?>"  class="form-control has-feedback-left" name ="nim" placeholder="Nim" required >
				<span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['namamhs']; ?>"  class="form-control has-feedback-left" name ="nama" placeholder="Nama Lengkap" required >
				<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >
						<select class="form-control" name="tingkat" id="tingkat2" required>
							<option value="">-- Tingkat --</option>
							<?php
								foreach ($tingkat as $t ) {
									if($t->tingkat == $mhs['tingkat']){
										$select = "selected";
									}else{
										$select = "";
									}
									echo "<option $select   value='$t->tingkat'>".$t->namatingkat."</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<select class="form-control" name="jurusan" id="jurusan2" required>
							<option value="<?php echo $mhs['kodejur']; ?>"><?php echo $mhs['namajur']; ?></option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<select class="form-control" name="kelas" id="kelas2" required>
						<option value="<?php echo $mhs['kelas']; ?>"><?php echo $mhs['kelas']; ?></option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['telepon']; ?>" class="form-control has-feedback-left" name ="phone" id="phone" placeholder="Phone Number" required>
				<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<select class="form-control" name="status" id="status" required>
					<option value="">-- Status --</option>
					<option <?php if($mhs['ket']=='Aktif'){echo "selected";} ?> value="Aktif">Aktif</option>
					<option <?php if($mhs['ket']=='Cuti'){echo "selected";} ?> value="Cuti">Cuti</option>
					<option <?php if($mhs['ket']=='Lulus'){echo "selected";} ?>value="Lulus">Lulus</option>
					<option <?php if($mhs['ket']=='D.O'){echo "selected";} ?>value="D.O">D.O</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['namaorgtua']; ?>"  class="form-control has-feedback-left" name ="namaortu" placeholder="Nama Orangtua" required >
				<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['alamatorgtua']; ?>" class="form-control has-feedback-left" name ="alamatortu" id="address" placeholder="Alamat Orangtua" required>
				<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['noorgtua']; ?>" class="form-control has-feedback-left" name ="phoneortu" id="phoneortu" placeholder="Telepon Orangtuaua" required >
				<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['kelas_senior']; ?>" class="form-control has-feedback-left" name ="kelas_senior" id="kelas_senior" placeholder="Kelas SENIOR" >
				<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button class="btn btn-primary" type="submit">Save changes</button>
	</div>
</form>
<script>

  $("#tingkat2").change(function(){
    var tingkat   = $("#tingkat2").val();
    $.ajax({
      type    : 'POST',
      url     : '<?php echo base_url();?>mahasiswa/getjurusan',
      data    : {tingkat:tingkat},
      cache   : false,
      success : function(respond){
        $("#jurusan2").html(respond);
      }
    });
  });

  $("#jurusan2").change(function(){
    var tingkat     = $("#tingkat2").val();
    var jurusan     = $("#jurusan2").val();
    $.ajax({
      type    : 'POST',
      url     : '<?php echo base_url();?>mahasiswa/getkelas',
      data    : {tingkat:tingkat,jurusan:jurusan},
      cache   : false,
      success : function(respond){
        $("#kelas2").html(respond);
      }
    });
  });

</script>
