
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Redaksi Surat<small>Data Redaksi Surat</small></h2>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
					<thead class="bg-cyan" >
						<tr>
							<th>No</th>
							<th>Perihal</th>
              <th>Aksi</th>
						</tr>
					</thead>
          <tbody>
            <?php
              $no = 1;
              foreach ($surat as $s ) {
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $s->perihal; ?></td>
                <td><a href="<?php echo base_url(); ?>surat/edit/<?php echo $s->kode_surat; ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a></td>
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
