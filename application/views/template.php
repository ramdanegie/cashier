
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
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url(); ?>assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url(); ?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url(); ?>assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url(); ?>assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!----- Bootstrap Selectpicker---->
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Sweetalert Css -->
    <link href="<?php echo base_url(); ?>assets/vendors/sweetalert/sweetalert.css" rel="stylesheet" /> <!-- Sweetalert Css -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="<?php echo base_url(); ?>asset/editor/editor.css" rel="stylesheet" /> <!-- Sweetalert Css -->
    <link href="<?php echo base_url(); ?>assets/build/css/style.css" rel="stylesheet">
     <style>
        #notifikasi {
            cursor: pointer;
            position: fixed;
            right: 0px;
            z-index: 9999;
            bottom: 0px;
            margin-bottom: 22px;
            margin-right: 15px;
            min-width: 300px;
            max-width: 800px;
        }
        .right{
          text-align:right;
        }

        /** SPINNER CREATION **/

        .loader {
          position: relative;
          text-align: center;
          margin: 15px auto 35px auto;
          z-index: 9999;
          display: block;
          width: 80px;
          height: 80px;
          border: 10px solid rgba(0, 0, 0, .3);
          border-radius: 50%;
          border-top-color: #000;
          animation: spin 1s ease-in-out infinite;
          -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
          to {
            -webkit-transform: rotate(360deg);
          }
        }

        @-webkit-keyframes spin {
          to {
            -webkit-transform: rotate(360deg);
          }
        }

    </style>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">


    <!-- jQuery -->
      <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- jQuery Sparklines -->
      <script src="<?php echo base_url(); ?>assets/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
      <!-- Flot -->
      <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="<?php echo base_url(); ?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="<?php echo base_url(); ?>assets/vendors/DateJS/build/date.js"></script>



      <!-- iCheck -->
      <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js" type="fc21aec8e99696df03ce7231-text/javascript"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="<?php echo base_url(); ?>assets/vendors/moment/min/moment.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    	<script src="<?php echo base_url(); ?>assets/vendors/pnotify/dist/pnotify.js"></script>
    	<script src="<?php echo base_url(); ?>assets/vendors/pnotify/dist/pnotify.buttons.js"></script>
    	<script src="<?php echo base_url(); ?>assets/vendors/pnotify/dist/pnotify.nonblock.js"></script>
      <!-- Switchery -->
      <script src="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.min.js" type="fc21aec8e99696df03ce7231-text/javascript"></script>
      <!-- Parsley -->
    <script src="<?php echo base_url(); ?>assets/vendors/parsleyjs/dist/parsley.min.js" type="fc21aec8e99696df03ce7231-text/javascript"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/vendors/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- starrr -->
     <script src="<?php echo base_url(); ?>assets/vendors/starrr/dist/starrr.js" type="fc21aec8e99696df03ce7231-text/javascript"></script>
     <!----- Bootstrap Selectpicker---->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url(); ?>assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js" type="8108b14fdf59799bd0d77684-text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/editor/editor.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js" type="8108b14fdf59799bd0d77684-text/javascript"></script>
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  	<!-- Validator -->
  	<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>E-CASHIER</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $fullname."-".$level; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
          					<?php
          						if (!empty($menu)) {
          							echo $menu;
          						}
          					?>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt=""><?php echo $fullname; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo base_url(); ?>auth/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
			    <div class="">
				    <div id="notifikasi"><?php echo $this->session->flashdata('msg'); ?></div>
    				<?php
    					if (!empty($content)) {
    						echo $content;
    					}
    					if (!empty($inside)) {
    						echo $inside;
    					}
    				?>
          </div>
        </div>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="8108b14fdf59799bd0d77684-|49" defer=""></script></body>
</html>
