<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>kelas/update" method="POST">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" readonly  class="form-control has-feedback-left" value="<?php echo $kelas['kelas'];  ?>" name ="kelas" placeholder="Nama Kelas" required>
				<span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<select class="form-control" name="jurusan" id="jurusan" required >
					<option value="<?php echo $kelas['kodejur'] ?>"><?php echo $kelas['namajur']; ?></option>
					<?php foreach($jurusan as $j){ ?>
						<option value="<?php echo $j->kodejur ?>"><?php echo $j->namajur; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $kelas['tahunmasuk']; ?>" class="form-control has-feedback-left" name ="tahunmasuk" id="tahunmasuk" placeholder="Tahun Masuk" required>
				<span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $kelas['angkatan']; ?>" class="form-control has-feedback-left" name ="angkatan" id="angkatan" placeholder="Angkatan" required>
				<span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<select class="form-control" name="tingkat" id="tingkat" required>
					<option value="">-- Pilih Tingkat --</option>
					<?php foreach($tingkat as $t){ ?>
						<option <?php if($kelas['tingkat']==$t->tingkat){echo "selected"; } ?> value="<?php echo $t->tingkat ?>"><?php echo $t->namatingkat; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<select class="form-control" name="status" id="status" required >
					<option value="<?php echo $kelas['statuskelas']; ?>"><?php echo $kelas['statuskelas']; ?></option>
					<option value="LP3I">LP3I</option>
					<option value="DNBS">DNBS</option>
					<option value="UNWIM">UNWIM</option>
					<option value="STT">STT</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<select class="form-control" name="pa" id="pa"  required>
					<option value="">-- Pilih PA --</option>
					<?php foreach($pa as $p){ ?>
						<option <?php if($kelas['userid']==$p->userid){echo "selected"; } ?> value="<?php echo $p->userid ?>"><?php echo $p->nama; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-primary" type="submit">Save changes</button>
	</div>
</form>
