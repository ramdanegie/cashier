
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Biaya<small>Data Biaya</small></h2>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<a href="#" class="btn btn-sm btn-success" id="add"><i class="fa fa-plus"></i> Add<a>
        <hr>
				<table class="table table-bordered table-striped table-hover jambo_table"  id="tabelmahasiswa">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>Nama Jurusan</th>
							<th>Biaya</th>
							<th>Tingkat</th>
							<th>Tahun Ajaran</th>
              <th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
          <tbody>
            <?php
              $no = 1;
              foreach ($biaya as $d){
                if($d->tingkat==1){
                  $tingkat = "Junior";
                }else if($d->tingkat==2){
                  $tingkat = "Senior";
                }else if($d->tingkat==3){
                  $tingkat = "Tingkat 3";
                }else if($d->tingkat==4){
                  $tingkat = "Tingkat 4";
                }
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $d->namajur; ?></td>
                <td align="right"><?php echo number_format($d->biaya,'0','','.'); ?></td>
                <td><?php echo $tingkat; ?></td>
                <td><?php echo $d->angkatan; ?></td>
                <td><?php echo $d->statuskelas; ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>biaya/edit/<?php echo $d->kodebiaya ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo base_url(); ?>biaya/hapus/<?php echo  $d->kodebiaya ?>" class="btn btn-xs btn-danger hapus"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
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
<!----------------------------- MODAL ----------------------------------------->
 <div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" id="myModalLabel">INPUT BIAYA</h4>
		</div>
		<form class="form-horizontal form-label-left" name="input_data" id="cust_form" autocomplete="off"  action="<?php echo base_url(); ?>biaya/save" method="POST">
			<div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <select class="form-control" name="tingkat" id="tingkat" required>
              <option value="">-- Pilih Tingkat --</option>
              <?php foreach($tk as $t){ ?>
                <option value="<?php echo $t->tingkat ?>"><?php echo $t->namatingkat; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <select class="form-control" name="jurusan" id="jurusan" required >
              <option value="">-- Pilih Jurusan --</option>
              <?php foreach($jur as $j){ ?>
                <option value="<?php echo $j->kodejur ?>"><?php echo $j->namajur; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" style="text-align:right" class="form-control has-feedback-left" name ="biaya" id="biaya" placeholder="Jumlah Biaya" required>
            <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" onkeyup="hitungangkatan();" name ="tahun" id="tahun" placeholder="Tahun Ajaran" required>
            <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" value="/" readonly required >
          </div>
          <div class="col-md-4 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" readonly name ="tahun2" id="tahun2" placeholder="Tahun Ajaran" required>
            <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
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
      </div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <button class="btn btn-primary" type="submit">Save changes</button>
			</div>
		</form>
	  </div>
	</div>
</div>
<script>
  var b = document.getElementById('biaya');
  b.addEventListener('keyup', function(e){
    b.value = formatRupiah(this.value, '');
    //alert(b);
  });
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }
  function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
  }

  function hitungangkatan()
  {
    angkatan=eval(input_data.tahun.value)
    angkatani=angkatan+1
    angkatani = angkatani || 0
    input_data.tahun2.value = angkatani
  }
</script>
<script>
  $(function(){
    $("#tabelmahasiswa").dataTable();

    $('#add').click(function(e){
      e.preventDefault();
      $("#modal").modal("show");
    });

    $('.hapus').on('click',function(){
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
  });
</script>
