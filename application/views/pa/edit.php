<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>mahasiswa/update" method="POST">
	<input type="hidden" name="id_customer" value="<?php echo $mhs['nim']; ?>">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $mhs['namamhs']; ?>"  class="form-control has-feedback-left" name ="name" placeholder="Name" >
				<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>


	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button class="btn btn-primary" type="submit">Save changes</button>
	</div>
</form>
