
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Pembiming Akademik<small>Data PA</small></h2>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<a href="#" class="btn btn-sm btn-success" onclick="add()"><i class="fa fa-plus"></i> Add<a>
				<table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>Username</th>
							<th>Nama PA</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<!----------------------------- MODAL ----------------------------------------->
 <div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">

		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" id="myModalLabel">FORM CUSTOMER</h4>
		</div>
		<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>customer/save" method="POST">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text"  class="form-control has-feedback-left" name ="name" placeholder="Name" >
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="phone" id="phone" placeholder="Phone Number" >
						<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="address" id="address" placeholder="Address" >
						<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
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

  <!----------------------------- MODAL EDIT ----------------------------------------->
 <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">EDIT PESERTA DIDIK</h4>
			</div>
			<div id="modal-body">

			</div>
		</div>
	</div>
  </div>

<script>
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

  var t = $("#tabelmahasiswa").dataTable({
    initComplete: function() {
      var api = this.api();
      $('#tabelmahasiswar_filter input')
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

    ajax: {"url": "pa/get_pa", "type": "POST"},
    columns: [
      {
        "data"     : "username",
        "orderable": false
      },

      {"data": "username"},
      {"data": "nama"},
      {"data": "view"}
    ],
    order: [[1, 'asc']],
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $('td:eq(0)', row).html(index);
    }
  });

   $('#tabelmahasiswa tbody').on('click', '.edit', function () {
     var id = $(this).attr('data-id');
    //alert($id);
    $("#modaledit").modal("show");
    $("#modal-body").load("mahasiswa/edit/"+id);
  });




  $('#cust_form').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      name: {
        validators: {

            notEmpty: {
            message: 'Please Input Name...'
          }
        }
      },
       phone: {
        validators: {

          notEmpty: {
            message: 'Please Input Phone..'
          }
        }
      },
      address: {
        validators: {

          notEmpty: {
            message: 'Please Input Address..'
          }
        }
      },



    }
  })

  .on('success.form.bv', function(e) {
    $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
    $('#reg_form').data('bootstrapValidator').resetForm();

    // Prevent form submission
    e.preventDefault();

    // Get the form instance
    var $form = $(e.target);

    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    // Use Ajax to submit form data
    $.post($form.attr('action'), $form.serialize(), function(result) {
      console.log(result);
    }, 'json');
  });


</script>
