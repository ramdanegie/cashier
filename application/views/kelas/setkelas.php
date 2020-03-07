<form class="form-control" name="updatekelas" method="POST" action="<?php echo base_url(); ?>kelas/updatesetkelas">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Data Kelas<small>Seting Data Kelas</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr class="success">
              <th>No</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Kelas</th>
            </tr>
          </thead>
          <?php
            $no = 1;
            $y  = 0;
            foreach($mhs as $m){
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td>
                <input type="hidden" name="kelas" value="<?php echo $kls; ?>" class="form-control">
                <input type="hidden" name="nimdulu[<?php echo $y; ?>]" value="<?php echo $m->nim; ?>" class="form-control">
                <input type="text" name="nim[<?php echo $y; ?>]" value="<?php echo $m->nim; ?>" class="form-control">
              </td>
              <td>
                <input type="text" name="namamhs[<?php echo $y; ?>]" value="<?php echo $m->namamhs; ?>" class="form-control">
              </td>
              <td>
                <select name="kelasbaru[<?php echo $y; ?>]" class="form-control">
                  <?php foreach ($kelas as $k){ ?>
                    <option <?php if($kls == $k->kelas){echo "selected";} ?> value="<?php echo $k->kelas; ?>"><?php echo $k->kelas; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
          <?php
              $y++;
              $no++;
            }
          ?>
          <tr>
            <td colspan="4" align="right"><button name="submit" class="btn btn-lg btn-info">Simpan</button></td>
          </tr>
        </table>
			</div>
		</div>
	</div>
</div>
</form>
