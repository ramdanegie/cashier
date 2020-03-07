<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>
		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<?php echo $contents; ?>
				</section>
			</div>
		</div>
    </div>
  </body>
</html>
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
										  
		$('#username').focus();

		//Form Login            
		$('#sign_in').submit(function () {
		  // $('#loading').show() 
			$.ajax({
				url: "<?php echo site_url() ?>auth/login",
				type: "POST",
				data: $('#sign_in').serialize(),
				cache: false,
				success: function (respon) {
					var obj = $.parseJSON(respon);
					if (obj.status == 1) {
					   
										  
							window.open("<?php echo site_url() ?>auth", "_self")
					   
					} else {
						  alert(obj.error);
					   
					}
				}
			});
			return false;
		});

		$('#btn-login').click(function () {
			$('#sign_in').submit();
		});

	});
</script>