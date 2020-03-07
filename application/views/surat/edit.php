
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Reaksi  Surat<small>Surat Tagihan</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <form class="form-horizontal form-label-left" id="cust_form"  autocomplete="off"   action="<?php echo base_url(); ?>surat/updatesurat" method="POST">
          <input type="hidden" name="kode_surat" value="<?php echo $surat['kode_surat']; ?>">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text"  class="form-control has-feedback-left" id="perihal" name ="perihal" value="<?php echo $surat['perihal']; ?>" >
              <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea name="editor1"><?php echo $surat['isi_surat']; ?></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <textarea name="editor2"><?php echo $surat['isi_surat2']; ?></textarea>
            </div>
          </div>
        	<div class="modal-footer">
        	  <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-upload"></i> Update</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   CKEDITOR.replace( 'editor1' );
   CKEDITOR.replace( 'editor2' );
</script>
