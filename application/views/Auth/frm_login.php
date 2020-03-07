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
					<form id="sign_in" method="POST" >
						<h1>Login Form</h1>
						<div>
							<input type="text" class="form-control" name="username" placeholder="Username" required autofocus />
						</div>
						<div>
							<input type="password" class="form-control" name="password" placeholder="Password" required />
						</div>
						<div>
							<button class="btn btn-default submit" type="submit" name="submit" id="btn-login">Log in</button>
							<a class="reset_pass" href="#">Lost your password ?</a>
						</div>
						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">New to site?
								<a href="#signup" class="to_register"> Create Account </a>
							</p>
							<div class="clearfix"></div>
							<br />

						</div>
					</form>
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
      //alert('test');
			$.ajax({
				url: "<?php echo site_url() ?>Auth/login",
				type: "POST",
				data: $('#sign_in').serialize(),
				cache: false,
				success: function (respon) {
					var obj = $.parseJSON(respon);
					if (obj.status == 1) {
						window.open("<?php echo site_url() ?>Auth", "_self")
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
