
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Kelas<small>Data Kelas</small></h2>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<a href="#" class="btn btn-sm btn-success" id="add"><i class="fa fa-plus"></i> Add<a>
				<table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>Kelas</th>
							<th>Kode Jurusan</th>
							<th>Tahun Masuk</th>
							<th>Angkatan</th>
              <th>Tingkat</th>
              <th>Status</th>
              <th>PA</th>
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
		  <h4 class="modal-title" id="myModalLabel">INPUT KELAS</h4>
		</div>
		<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>kelas/save" method="POST">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text"  class="form-control has-feedback-left" name ="kelas" placeholder="Nama Kelas" required>
						<span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <select class="form-control" name="jurusan" id="jurusan" required >
              <option value="">-- Pilih Jurusan --</option>
              <?php foreach($jurusan as $j){ ?>
                <option value="<?php echo $j->kodejur ?>"><?php echo $j->namajur; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="tahunmasuk" id="tahunmasuk" placeholder="Tahun Masuk" required>
						<span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="angkatan" id="angkatan" placeholder="Angkatan" required>
						<span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <select class="form-control" name="tingkat" id="tingkat" required>
              <option value="">-- Pilih Tingkat --</option>
              <?php foreach($tingkat as $t){ ?>
                <option value="<?php echo $t->tingkat ?>"><?php echo $t->namatingkat; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <select class="form-control" name="status" id="status" required >
              <option value="">-- Pilih Status --</option>
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
                <option value="<?php echo $p->userid ?>"><?php echo $p->nama; ?></option>
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
	  </div>
	</div>
  </div>

  <!----------------------------- MODAL EDIT ----------------------------------------->
 <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">EDIT KELAS</h4>
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

    ajax: {"url": "kelas/get_kelas", "type": "POST"},
    columns: [
      {
        "data": "kelas",
        "orderable": false
      },

      {"data": "kelas"},
      {"data": "kodejur"},
      {"data": "tahunmasuk"},
      {"data": "angkatan"},
      {"data": "tingkat"},
      {"data": "statuskelas"},
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
    $.ajax({
      url     : '<?php echo base_url(); ?>/kelas/edit',
      type    : 'POST',
      data    : {kelas:id},
      cache   : false,
      success : function(respond)
      {
        $("#modal-body").html(respond);
      }
    });
  });

  $('#add').click(function(e){
    e.preventDefault();
    $("#modal").modal("show");
  });

  $('#tabelmahasiswa tbody').on('click', '.hapus', function () {
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




</script>
