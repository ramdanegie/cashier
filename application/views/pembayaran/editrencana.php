
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>EDIT RENCANA PEMBAYARAN</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
        <?php
          $hd                = $data2['deal'];
          $rg                = $data2['regis'];
          $rencanacicilan    = $data2['rencanacicilan'];
          $ss                = $hd-$rg;
          $rencanacicilan    = $data2['rencanacicilan'];
          $tglregis          = $data2['tglregis'];

        ?>
        <div class="col-md-6 col-xs12">
          <form class="form-horizontal" action="<?php echo base_url(); ?>pembayaran/updaterencana" method="post" name="form_editrencana" id="form_editrencana">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
    				<input type="hidden" name="rencanacicilan" value="<?php echo $rencanacicilan;?>"/>
            <table class="table table-striped table-hover">
      				<tr class="success">
      					<th>Cicilan</th>
      					<th>Jatuh Tempo</th>
      					<th>Wajib Bayar</th>
      				</tr>
              <?php
                $n = 0;
                foreach($ren as $r){
                  if ($r->cicilanke==0){
    					?>
        					<tr>
        						<td colspan="2"><input type="text" readonly="readonly" class="form-control" style="width:215px;" id="cicilanke<?php echo $n; ?>" name="cicilanke<?php echo $n; ?>" value="Registrasi"/></td>
        						<td align="right"><input type="text" readonly="readonly" class="form-control" style="width:150px;" id="wajibbayar<?php echo $n; ?>" name="wajibbayar<?php echo $n; ?>" value="<?php  echo $r->wajibbayar;?>"/></td>
        					</tr>
        				<?php
        					}else{
        				?>
                <tr>
                  <td><input type="text" readonly="readonly" class="form-control" style="width:100px;" id="cicilanke<?php echo $n; ?>" name="cicilanke<?php echo $n; ?>" value="<?php echo $r->cicilanke; ?>"/></td>
                  <td><input type="text" class="form-control" style="width:100px;" id="jatuhtempo<?php echo $n; ?>" name="jatuhtempo<?php echo $n; ?>" value="<?php echo $r->jatuhtempo; ?>"/></td>
                  <td align="right"><input type="text" class="form-control" style="width:150px;" id="wajibbayar<?php echo $n; ?>" name="wajibbayar<?php echo $n; ?>" value="<?php  echo $r->wajibbayar;?>"/></td>
                </tr>
              <?php
                }
                $n++;
              }
              ?>
              <tr>
      					<td align="right"><button type="submit" class="btn btn-primary">Submit</button></td>
      					<td align="right">Total Rencana Bayar</td>
      					<td align="right"><input type="text" readonly="readonly" class="form-control" name="total" value="<?php echo $hd; ?>"/></td>
      				</tr>
            </table>

          </form>
          <div class="col-lg-12">
          	<div class="alert alert-info">
          		Mohon sebelum di-submit di cek terlebih dahulu apakah total dari jumlah semua wajib bayar yang anda masukan sama dengan Total Rencana Bayar.
          	</div>
          </div>
        </div>
			</div>
		</div>
	</div>
</div>
