
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Pembayaran <?php echo strtoupper($status)." "; ?><?php if($tingkat =='1'){ echo "Tingkat Junior";}elseif($tingkat=='2'){echo "Tingkat Senior";}elseif($tingkat=='3'){echo "Tingkat 3";}else{echo "Tingkat 4";} ?><small>Data Pembayaran</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li><a href="<?php echo base_url(); ?>pembayaran/belumregis/<?php echo $status; ?>/<?php echo $tingkat; ?>">Data Belum Registrasi</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>pembayaran/pmbmhs/<?php echo $status; ?>/<?php echo $tingkat; ?>">Data Sudah Registrasi</a>
          </ul>
          <div id="myTabContent" class="tab-content">
            <table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
    					<thead class="bg-cyan" >
    						<tr>
    							<th>No.</th>
    							<th>Nama Mhs</th>
    							<th>Kelas</th>
                  <th>Tahun Ajaran</th>
                  <th>Tingkat</th>
    							<th>Action</th>
    						</tr>
    					</thead>
    				</table>
          </div>
        </div>
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

    ajax: {"url": "<?php echo base_url(); ?>pembayaran/get_pembayaran/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>", "type": "POST"},
    columns: [
      {
        "data"     : "angkatan",
        "orderable": false
      },

      {"data": "namamhs"},
      {"data": "kelas"},
      {"data": "angkatan"},
      {"data": "namatingkat"},
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

</script>
