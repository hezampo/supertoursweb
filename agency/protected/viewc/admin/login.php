<?php
// print_r($this->data['error']);
// die;
if (isset($this->data['error'])) {
  $error = $this->data['error'];
}
        ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/favicon.ico" type="image/ico" />

    <title>Supertour</title>

    <!-- Bootstrap -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/animate.css/animate.min.css" rel="stylesheet">

    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/css/introjs.css" rel="stylesheet">
     <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/css/custom.css" rel="stylesheet">
    <!-- BOOTSTRAp spin -->
    <link href="<?php echo $data['rootUrl']; ?>global/css/estiloseric/out/jquery.bootstrap-touchspin.css" rel="stylesheet">
    <link href="<?php echo $data['rootUrl']; ?>global/css/estiloseric/out/sweetalert2.css" rel="stylesheet">
  </head>
  <?php if(!isset($_SESSION['loginagency'])) { ?>
  <body class="login">

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo $data['rootUrl'] ?>admin/login" method="POST">
            <div data-step="1" data-intro="More features, more fun."  data-position='left'>
              <h1>Welcome Agent</h1>
              <?php if(isset($this->data['error'])){?>
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Error!</strong> <?php echo $error?>.
                </div>
              <?php } ?>
            </div>
            <div data-step="2" data-intro="More features, more fun."  data-position='right'>
            <div >
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="Username" name="userof" value="<?php echo (isset($_POST['useroff']) AND $_POST['useroff'] == 'off')? 'off': 'on'; ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="tipo ticket" name="tipo_ticket" value="<?php echo $_POST['tipo_ticket'] ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="fecha salida" name="fecha_salida"  value="<?php echo $_POST['fecha_salida'] ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="fecha alida2" name="fecha_salida2"  value="<?php echo $_POST['fecha_salida2'] ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="fecha retorno" name="fecha_retorno"  value="<?php echo $_POST['fecha_retorno'] ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="pax" name="pax"  value="<?php echo $_POST['pax'] ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="pax2" name="pax2"  value="<?php echo $_POST['pax2'] ?>" onfocus="this.blur()"/>
                <input style="font-weight: bold; color:#545353" type="hidden" class="form-control" placeholder="opcion" name="opcion"  value="<?php echo $_POST['opcion'] ?>" onfocus="this.blur()"/>


                <input style="font-weight: bold; color:#545353" type="email" class="form-control" placeholder="Enter Your Email" name="usuario" required="" />
              </div>
              <div>
              <div class="input-group">
                            <input style="font-weight: bold; color:#545353" type="password" class="form-control" placeholder="Enter Your Password" name="password" id="pass" required="" />
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default btn-flat"  style=" margin: -50% 0% 0% 0%;" id="mostrarpass"><i class="fa fa-eye" id="iconpass"></i></button>
                            </span>
                          </div>
                <!-- <input type="password" class="form-control" placeholder="Password" name="password" required="" /> -->
              </div>
              <div>
                <!-- <a href="" class="btn btn-danger">back</a> -->
                <button type="submit" class="btn  btn-flat btn-success btn-block">Login</button>
                <!-- <a class="btn" href="javascript:void(0);" onclick="javascript:introJs().start();">tour</a> -->
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>
              <!-- <div>
                <a href="<?php echo $data['rootUrl'] ?>admin/home" type="submit" class="btn btn-flat btn-info btn-block" style="text-decoration: blink;">Agency Home</a>
              </div> -->
            </div>


              <div class="clearfix"></div>

              <div class="separator">
  <!--               <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div>
                <a href="<?php echo $data['rootUrl'] ?>../" type="submit" class="btn btn-flat btn-danger btn-block" style="text-decoration: blink;">Supertours Home</a>
              </div>
                <div class="clearfix"></div>
                <br />

                <div data-step="3" data-intro="More features, more fun."  data-position='left'>
                  <span  class="sub-foot">&copy;<?php echo date('Y');?> Super Tours. Copyright &copy; 1989 - <?php echo date('Y');?><br> Super Tours. All Rights Reserved.</span>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>


    <!-- jQuery -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/dist/jquery.min.js"></script>
    <script>
    var $jq = jQuery.noConflict();
    // alert($jq.fn.jquery);
    </script>
    <!-- Bootstrap -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <!-- bootstrap-progressbar -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.resize.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/js/custom.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>

      <!-- BOOTSTRAp spin -->
    <script src="<?php echo $data['rootUrl']; ?>global/startjs/jquery.bootstrap-touchspin.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>global/startjs/sweetalert2.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/switchery/dist/switchery.min.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/js/intro.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/js-er/frm_reservas.js"></script> -->
    <script>
      var f = 0;
$jq('#mostrarpass').click(function(){
var d  = $jq('#pass').val();
f++;
  // if (d != '') {
  console.log(f);
    if (f%2 == 0) {
    $jq('#pass').removeAttr('type','text');
    $jq('#pass').prop('type','password');
    $jq('#iconpass').removeClass('fa fa-eye-slash');
    $jq('#iconpass').addClass('fa fa-eye');
    }else{

    $jq('#pass').removeAttr('type','password');
    $jq('#pass').prop('type','text');
    $jq('#iconpass').removeClass('fa fa-eye');
    $jq('#iconpass').addClass('fa fa-eye-slash');

    }
  // }
});
</script>

<?php
if (isset($this->data['status']) AND $this->data['status'] == false) {
  echo '<script>toastr.error("Email/password wrong, please try again", {  timeOut: 5000 });</script>';
}
?>

</html>

<?php }else{ ?>
<script>
window.location="<?php echo $data['rootUrl']; ?>admin/home";
</script>
            <?php } ?>
