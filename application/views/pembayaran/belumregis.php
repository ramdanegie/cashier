
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
            <li  class="active"><a href="<?php echo base_url(); ?>pembayaran/belumregis/<?php echo $status; ?>/<?php echo $tingkat; ?>">Data Belum Registrasi</a></li>
            <li><a href="<?php echo base_url(); ?>pembayaran/pmbmhs/<?php echo $status; ?>/<?php echo $tingkat; ?>">Data Sudah Registrasi</a>
          </ul>
          <div id="myTabContent" class="tab-content">
            <table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
    					<thead class="bg-cyan" >
    						<tr>
    							<th>No.</th>
                  <th>Nim.</th>
    							<th>Nama Mhs</th>
    							<th>Kelas</th>
    							<th>Action</th>
    						</tr>
    					</thead>
              <tbody>
                <?php
                  $no =1;
                  foreach($belregis as $d){
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $d->nim; ?></td>
                    <td><?php echo $d->namamhs; ?></td>
                    <td><?php echo $d->kelas; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>pembayaran/inputregis/<?php echo $d->nim."/".$status; ?>" class="btn btn-xs btn-info">Registrasi</a>
                      <a href="<?php echo base_url(); ?>pembayaran/inputregispinjaman/<?php echo $d->nim."/".$status; ?>" class="btn btn-xs btn-danger">Dana Pinjaman</a>
                    </td>
                  </tr>
                <?php
                  $no++;
                  }
                ?>
              </tbody>
    				</table>
          </div>
        </div>
			</div>
		</div>
	</div>
</div>
<script>
  $(function(){
    $("#tabelmahasiswa").DataTable();
  });
</script>
