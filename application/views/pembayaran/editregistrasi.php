
<form id="formregis" class="form-horizontal form-label-left input_mask" action="<?php echo base_url(); ?>pembayaran/update_regis" method="POST" >
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Form Registrasi<small>Registrasi Mahasiswa</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
						<div class="profile_img">
							<div id="crop-avatar">
								<!-- Current avatar -->
								<img  style="margin-left:34px;" class="img-responsive avatar-view" src="<?php echo base_url(); ?>assets/images/avatar.jpg" alt="Avatar" title="Change the avatar">
							</div>
						</div>
						<h3 align="center"><?php echo $reg['namamhs']; ?></h3>
            <table class="table table-striped table-hover">
            	<tr>
            		<th>NIM</th>
            		<td>:</td>
            		<td>
                  <input type="hidden" name="kodekontrak" value="<?php echo $reg['kodekontrak']; ?>">
                  <input type="hidden" name="nim" value="<?php echo $reg['nim']; ?>">
                  <?php echo $reg['nim']; ?>
                </td>
            	</tr>
            	<tr>
            		<th>Nama Mahasiswa</th>
            		<td>:</td>
            		<td><?php echo $reg['namamhs']; ?></td>
            	</tr>
            	<tr>
            		<th>Kelas</th>
            		<td>:</td>
            		<td><?php echo $reg['kelas']; ?></td>
            	</tr>
            	<tr>
            		<th>Status</th>
            		<td>:</td>
            		<td><?php echo $reg['ket']; ?></td>
            	</tr>
              <tr>
                <th colspan="3"><a href="#" class="btn btn-success btn-sm" style="width:100%"><i class="fa fa-edit"></i> Edit Profile</a></th>
              </tr>
            </table>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_title">
							<h2>Data Registrasi<small>Registrasi</small></h2>
							<div class="clearfix"></div>
						</div>
            <div class="x_panel">
              <div class="x_content">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gelombang</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="gelombang" id="gelombang" class="form-control">
                      <option value="">-- Pilih Gelombang --</option>
                      <option <?php if($reg['gelombang']=='1'){echo "selected";} ?> value="1">1</option>
                      <option <?php if($reg['gelombang']=='2'){echo "selected";} ?>  value="2">2</option>
                      <option <?php if($reg['gelombang']=='3'){echo "selected";} ?>   value="3">3</option>
                      <option <?php if($reg['gelombang']=='4'){echo "selected";} ?>  value="4">4</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="tglregis" value="<?php echo $reg['tglregis']; ?>" id="tglregis" class="form-control" placeholder="Tanggal Registrasi">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Publish</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="hidden" name="kodebiaya" value="<?php echo $reg['kodebiaya']; ?>">

                    <input style="text-align:right" readonly onkeyup="calc()"  value="<?php echo number_format($reg['biaya'],'0','','.'); ?>" ame="hargapublish" id="hargapublish" type="text" class="form-control" placeholder="Harga Publish">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Potongan Gelombang</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['diskongelombang'],'0','','.'); ?>"  name="potgel" id="potgel"   type="text" class="form-control" placeholder="Potongan Gelombang">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Potongan Prestasi</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['diskonprestasi'],'0','','.'); ?>"  type="text" name="potpres" id="potpres"  class="form-control" placeholder="Potongan Prestasi">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Potongan Cash</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right"  onkeyup="calc()" value="<?php echo number_format($reg['diskoncash'],'0','','.'); ?>"  type="text" name="potcash" id="potcash"  class="form-control" placeholder="Potongan Cash">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Potongan Lain Lain</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" onkeyup="calc()" value="<?php echo number_format($reg['diskonlain'],'0','','.'); ?>"  type="text" name="potlainlain" id="potlainlain"  class="form-control" placeholder="Potongan Lain Lain">
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Deal</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" onkeyup="calc()" value="<?php echo $reg['hargadeal']; ?>"  type="hidden" name="hargadeal" id="hargadeal"  class="form-control" >
                    <input style="text-align:right"  value="<?php echo number_format($reg['hargadeal'],'0','','.'); ?>"readonly  type="text" name="terbilangdeal" id="terbilangdeal"  class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Registrasi</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" value="<?php echo number_format($reg['registrasi'],'0','','.'); ?>" onkeyup="calc()"  name="jmlregis" id="jmlregis"  type="text" class="form-control">
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sisa</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" value="0" onkeyup="calc()"  name="sisa" id="sisa" type="hidden" readonly class="form-control">
                    <input style="text-align:right" value="0" onkeyup="calc()"  name="terbilangsisa" id="terbilangsisa" type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Cicilan</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input style="text-align:right" value="<?php echo $reg['rencanacicilan']; ?>" onkeyup="calc()" name="jmlcicilan" id="jmlcicilan" value="0"  type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Biaya/Cicilan</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input style="text-align:right" onkeyup="calc()" value="0"  type="hidden" name="cicilanper" id="cicilanper" class="form-control">
                    <input style="text-align:right" readonly  value="0"  type="text" readonly name="terbilangcicilan" id="terbilangcicilan" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Cicilan</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="hidden" name="selisih" id="selisih">
                    <input type="text"   value="<?php echo $reg['tglregis']; ?>" name="mulaicicilan" id="mulaicicilan" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" name="keterangan" value="<?php echo $reg['jenisregis']; ?>" id="keterangan" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i> Update</button>
                </div>
              </div>
            </div>
          </div>
			</div>
		</div>
  </div>
</div>
</form>

<script>
  calc();
  var hp = document.getElementById('hargapublish');
  hp.addEventListener('keyup', function(e){
    hp.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var pg = document.getElementById('potgel');
  pg.addEventListener('keyup', function(e){
    pg.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var pp = document.getElementById('potpres');
  pp.addEventListener('keyup', function(e){
    pp.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var pc = document.getElementById('potcash');
  pc.addEventListener('keyup', function(e){
    pc.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var pl = document.getElementById('potlainlain');
  pl.addEventListener('keyup', function(e){
    pl.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var hd = document.getElementById('hargadeal');
  hd.addEventListener('keyup', function(e){
    hd.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var reg = document.getElementById('jmlregis');
  reg.addEventListener('keyup', function(e){
    reg.value = formatRupiah(this.value, '');
    //alert(b);
  });
  var s = document.getElementById('sisa');
  s.addEventListener('keyup', function(e){
    s.value = formatRupiah(this.value, '');
    //alert(b);
  });

  var cp = document.getElementById('cicilanper');
  cp.addEventListener('keyup', function(e){
    cp.value = formatRupiah(this.value, '');
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
  function calc(){
  		hargapublishrupiah      = document.getElementById("hargapublish").value;
      hargapublish            = hargapublishrupiah.replace(/\./g,'');
  		potgelrupiah   	        = document.getElementById("potgel").value;
      potgel                  = potgelrupiah.replace(/\./g,'');
  		potpresrupiah           = document.getElementById("potpres").value;
      potpres                 = potpresrupiah.replace(/\./g,'');
      potcashrupiah           = document.getElementById("potcash").value;
      potcash                 = potcashrupiah.replace(/\./g,'');
      potlainlainrupiah       = document.getElementById("potlainlain").value;
      potlainlain             = potlainlainrupiah.replace(/\./g,'');
      hargadealrupiah         = document.getElementById("hargadeal").value;
      hargadeal               = hargadealrupiah.replace(/\./g,'');
      jmlregisrupiah          = document.getElementById("jmlregis").value;
      jmlregis                = jmlregisrupiah.replace(/\./g,'');
      sisarupiah              = document.getElementById("sisa").value;
      sisa                    = sisarupiah.replace(/\./g,'');
      cicilanperrupiah        = document.getElementById("cicilanper").value;
      cicilanper              = cicilanperrupiah.replace(/\./g,'');
      jmlcicilan              = document.getElementById("jmlcicilan").value;

      if(hargapublish == ""){
        hargapublish = 0;
      }
      if(potgel == ""){
        potgel = 0;
      }
      if(potpres == ""){
        potpres = 0;
      }
      if(potcash == ""){
        potcash = 0;
      }
      if(potlainlain == ""){
        potlainlain = 0;
      }
      if(hargadeal == ""){
        hargadeal = 0;
      }
      if(jmlregis == ""){
        jmlregis = 0;
      }
      if(sisa == ""){
        sisa = 0;
      }
      if(cicilanper == ""){
        cicilanper = 0;
      }
      if(jmlcicilan == ""){
        jmlcicilan = 0;
      }


      var result  = parseInt(hargapublish) - parseInt(potcash) - parseInt(potpres) - parseInt(potgel)-parseInt(potlainlain);
      var deal    = parseInt(result)-parseInt(jmlregis);
      var cicilan = parseInt(deal) / parseInt(jmlcicilan);
      //var selisih = parseInt(result)-parseInt(totallhp);
      if (!isNaN(result)) {
       hargadeals = document.getElementById('hargadeal').value = result;
       document.getElementById("terbilangdeal").value=convertToRupiah(hargadeals);
      }

      if (!isNaN(deal)) {
       sisas = document.getElementById('sisa').value = deal;
       //document.getElementById("terbilangtotalsetoran").innerHTML=convertToRupiah(totalsetoran);
       document.getElementById("terbilangsisa").value=convertToRupiah(sisas);
      }

      if (!isNaN(cicilan)) {
       cicilans = document.getElementById('cicilanper').value = cicilan;
       document.getElementById("terbilangcicilan").value=convertToRupiah(cicilans);
      }




	}
  function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
  }
</script>
<script>
  $(function(){
    $("#tglregis").daterangepicker({
      singleDatePicker  :!0,
      singleClasses     :"picker_1",
      locale            : {
                            format: 'YYYY-MM-DD'
                          }
    });

    function loadSelisih(){
      var tglmulai = $("#mulaicicilan").val();
      //alert(tglmulai);
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>pembayaran/getselisih',
        data    : {tglmulai:tglmulai},
        cache   : false,
        success : function(respond){
          console.log(respond);
          $("#selisih").val(respond);
        }
      });
    }

    loadSelisih();

    $("#mulaicicilan").daterangepicker({
      singleDatePicker  :!0,
      singleClasses     :"picker_1",
      locale            : {
                            format: 'YYYY-MM-DD'
                          }
    });

    $("#mulaicicilan").change(function(e){
      e.preventDefault();
      loadSelisih();
    });

    $("#formregis").submit(function(){
        var gelombang      = $("#gelombang").val();
        var hargadeal      = $("#hargadeal").val();
        var registrasi     = $("#jmlregis").val();
        var jmlcicilan     = $("#jmlcicilan").val();
        var keterangan     = $("#keterangan").val();
        var selisih        = $("#selisih").val();
        //alert(selisih);
        if(gelombang == ""){
           swal("Oops!", "Silahkan Pilih Gelombang.. !", "warning");
           return false;
        }else if(parseInt(jmlcicilan) > 12){
           swal("Oops!", "Jumlah Cicilan Tidak Boleh Lebih dari 12.. !", "warning");
           return false;
        }else if(parseInt(jmlcicilan) > parseInt(selisih)){
           swal("Oops!", "Jumlah Cicilan yang memungkinkan s/d Bulan Juni Adalah "+selisih+". !", "warning");
           return false;
        }else if(keterangan == 0 || keterangan ==""){
           swal("Oops!", "Keterangan Belum Diisi.. !", "warning");
           return false;
        }else{
            return true;
        }

    });
  });
</script>
