
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Peserta Didik<small>Data Peserta Didik</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<a href="#" class="btn btn-sm btn-success" id="add"><i class="fa fa-plus"></i> Add<a>
				<table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Kelas</th>
							<th>Telepon</th>
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
		  <h4 class="modal-title" id="myModalLabel">MAHASISWA</h4>
		</div>
		<form class="form-horizontal form-label-left" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>mahasiswa/save" method="POST">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text"  class="form-control has-feedback-left" name ="nim" placeholder="Nim" required >
						<span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text"  class="form-control has-feedback-left" name ="nama" placeholder="Nama Lengkap" required >
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <div class="row">
        			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >
                <select class="form-control" name="tingkat" id="tingkat" required>
                  <option value="">-- Tingkat --</option>
                  <?php
                    foreach ($tingkat as $t ) {
                			echo "<option   value='$t->tingkat'>".$t->namatingkat."</option>";
                		}
                  ?>
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
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="phone" id="phone" placeholder="Phone Number" required>
						<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <select class="form-control" name="status" id="status" required>
              <option value="">-- Status --</option>
              <option value="Aktif">Aktif</option>
              <option value="Cuti">Cuti</option>
              <option value="Lulus">Lulus</option>
              <option value="D.O">D.O</option>
            </select>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text"  class="form-control has-feedback-left" name ="namaortu" placeholder="Nama Orangtua" required >
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="alamatortu" id="address" placeholder="Alamat Orangtua" required>
						<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="phoneortu" id="phoneortu" placeholder="Telepon Orangtuaua" required >
						<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
					</div>
				</div>
        <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="kelas_senior" id="kelas_senior" placeholder="Kelas SENIOR" >
						<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
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
				<h4 class="modal-title" id="myModalLabel">EDIT MAHASISWA</h4>
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

    ajax: {"url": "mahasiswa/get_mahasiswa", "type": "POST"},
    columns: [
      {
        "data": "nim",
        "orderable": false
      },

      {"data": "nim"},
      {"data": "namamhs"},
      {"data": "kelas"},
      {"data": "telepon"},

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

    var a = $(this).attr('data-id');
    $("#modaledit").modal("show");
    $("#modal-body").load("mahasiswa/edit/"+a);
  });

  $("#add").click(function(e){
    e.preventDefault();
    $("#modal").modal("show");
  });

  $("#tingkat").change(function(){
    var tingkat   = $("#tingkat").val();
    $.ajax({
      type    : 'POST',
      url     : '<?php echo base_url();?>mahasiswa/getjurusan',
      data    : {tingkat:tingkat},
      cache   : false,
      success : function(respond){
        $("#jurusan").html(respond);
      }
    });
  });

  $("#jurusan").change(function(){
    var tingkat     = $("#tingkat").val();
    var jurusan     = $("#jurusan").val();
    $.ajax({
      type    : 'POST',
      url     : '<?php echo base_url();?>mahasiswa/getkelas',
      data    : {tingkat:tingkat,jurusan:jurusan},
      cache   : false,
      success : function(respond){
        $("#kelas").html(respond);
      }
    });
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
