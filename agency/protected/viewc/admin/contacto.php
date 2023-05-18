<?php

    $login = $_SESSION['loginagency'];
    //$usuario = $login->usuario_pago;
    $nombre = $login->nombre;
    //$pin = $login->pin_pago;
    //echo $pin;
    $vehiculos100 = 1;
    //echo $nombre;
    /*if($nombre == 'Sanchez Ruth' && $pin ='9S1M59'){
        $codigoHTML.=' <div id="duelo" style="position:absolute; z-index: 1; margin-left:383px; margin-top:148px;"><img src="https://www.supertours.com/duelo.png" alt="" style="width: 63px; height: 74px; margin-left: 9px; margin-top: 5px;" /></div>';
        echo $codigoHTML;
    }*/

?> 
    <div class="right_col" role="main">
<!-- Contact Information content -->
<div class="col-md-12 col-sm-12 col-xs-12">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_content">
                    <div class="x_title">
                      <h2>Contact Information</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="row top_tiles">
                        <div class="animated fadeIn col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="list-unstyled timeline">
                    <li>
                      <!--<div class="block">
                        <div class="tags">
                          <a href="javascript:void(0)" class="tag">
                            <span>Main Office</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title"> <a> 5419 International Drive, Ste. F Orlando, Fl. 32819</a> </h2>
                          <div class="byline">
                            <span>SuperTour</span>
                          </div>

                        </div>
                      </div>-->
                    </li>

                    <li>
                      <div class="block">
                        <div class="tags">
                          <a href="javascript:void(0)" class="tag">
                            <span>E-Mail</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title"> <a>reservations@supertours.com</a> </h2>
                          <div class="byline">
                            <span>Super Tours</span>
                          </div>

                        </div>
                      </div>
                    </li>

                    <li>
                      <div class="block">
                        <div class="tags">
                          <a href="javascript:void(0)" class="tag">
                            <span>Customer Support</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title"> <a> Orlando : (407) 370 3001</a> </h2>
                          <h2 class="title"> <a> Miami : (305) 677 2676</a> </h2>
                          <h2 class="title"> <a> Toll Free : (800) 251 4206</a> </h2>
                          <div class="byline">
                            <span>Super Tours</span>
                          </div>

                        </div>
                      </div>
                    </li>

                    <li>
                      <div class="block">
                        <div class="tags">
                          <a href="javascript:void(0)" class="tag">
                            <span>Contact Us</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title"> <a>reservations@supertours.com</a> </h2>
                          <div class="byline">
                            <span>Super Tours</span>
                          </div>

                        </div>
                      </div>
                    </li>

                  </ul>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
<!-- Contact Information content END-->


<!-- Contact Information content -->
<div class="col-md-12 col-sm-12 col-xs-12">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_content">
                    <div class="x_title">
                      <h2>Contact Information</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="row top_tiles">
                        <div class="animated fadeIn col-lg-12 col-md-12 col-sm-12 col-xs-12">


                        <form class="form-horizontal form-label-left input_mask" action="<?php echo $data['rootUrl']?>admin/reservas/EnviarContact" method="POST">
                      <input type="hidden" name="company" value="<?php echo $login->company_name ?>" />
                      <div class="col-md-3 col-sm-12 col-xs-12 form-group has-feedback from12">
                          <label for="heard">First Name: </label>
                        <input style="padding-right: 5.5px; text-align: left; font-size:1em;font-weight: bold;" class="form-control has-feedback-left" value="<?php echo $login->firstname ?>"  name="name" type="text"  id="name" size="10" maxlength="15" value=""  autocomplete="off"  placeholder="First Name" required/>

                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-12 col-xs-12 form-group has-feedback " id="Content_fecha_retorno">
                          <label for="heard">Last Name:</label>
                          <input  style="padding-right: 5.5px; text-align: left; font-size:1em;font-weight: bold;"  placeholder="Last Name" class="form-control has-feedback-left"  value="<?php echo $login->lastname ?>"  name="lastname" type="text"  id="lastname" size="10" maxlength="15"  autocomplete="off" required/>
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-12 col-xs-12 form-group has-feedback from12">
                          <label for="heard">E-mail:</label>
                        <input style="padding-right: 5.5px; text-align: left; font-size:1em;font-weight: bold;" class="form-control has-feedback-left"  value="<?php echo $login->email ?>"  name="email" type="email"  id="email"  value=""  autocomplete="off"  placeholder="Email@domain.com" required/>

                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-12 col-xs-12 form-group has-feedback " id="Content_fecha_retorno">
                          <label for="heard">Phone:</label>
                          <input  style="padding-right: 5.5px; text-align: right; font-size:1em;font-weight: bold;"  placeholder="phone Number" class="form-control has-feedback-left"   name="phone" type="tel"  id="phone"  />
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-12 col-xs-12 form-group " id="Content_fecha_retorno">
                          <label for="heard">Your Comment:</label>
                          <textarea class="form-control has-feedback-left" name="comment" style="text-align: left; font-size:1em;font-weight: bold;" placeholder="comment" name="" id="" cols="30" rows="10" autocomplete="off" required></textarea>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group " >
                      <?php if(isset($_SESSION['loginagency'])) { ?>
                      <button title="Send" type="submit" class="btn btn-success btn-flat" style="float: right; ">Send <i class="fa fa-paper-plane"></i></button>
                      <?php }else{ ?>
                      <a title="Send" class="btn btn-success btn-flat" style="float: right; " id="formulario" >Send <i class="fa fa-paper-plane"></i></a>
                      <?php } ?>
                      </div>

                      </form>


<!-- <button class="btn btn-default source" onclick="TodoOK()">Dark</button> -->


<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/dist/jquery.min.js"></script>
      <script>
    var $jq = jQuery.noConflict();
    // alert($jq.fn.jquery);
    </script>
    <!-- jQuery Cookie-->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/src/jquery.cookie.js"></script>
    <!-- Bootstrap -->
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/gauge.js/dist/gauge.min.js"></script>
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

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/ResponsiveSlides/responsiveslides.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>global/startjs/sweetalert2.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/js/custom.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/pnotify/dist/pnotify.js"></script>
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/pnotify/dist/pnotify.buttons.js"></script>
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/js/intro.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js"></script>
<script>
    // var $j = jQuery.noConflict();
    // // alert($jq.fn.jquery);
    // </script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/ajaxfileupload.js"></script>

<script src='<?php echo $data['rootUrl']?>global/startjs/jquery.bootstrap-touchspin.js'></script>
    <script src='<?php echo $data['rootUrl']?>global/startjs/moment.min.js'></script>
    <script src='<?php echo $data['rootUrl']?>global/startjs/lightpick.js'></script> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!-- Contact Information content END-->

<script>
$jq('#formulario').click(function(){
var f = "<?php echo $data['rootUrl']; ?>admin/login_agency";
//alert(f);
location.href = f;
})
</script>

<?php if(isset($_GET['msj']) AND $_GET['msj'] == 'ok') {?>
<script>
$jq(document).ready(function(){
TodoOK(); // MUESTRA EL MENSAJE QUE TODO ESTA BIEN
})

</script>
<?php }elseif(isset($_GET['msj']) AND $_GET['msj'] == 'error') { ?>
<script>
TodonoOK(); // MUESTRA EL MENSAJE QUE NO SE PUDO MANDAR EL CORREO

</script>

<?php } ?>
</div>

<script>
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
if(isMobile.any()) {
  console.log('Esto es un dispositivo móvil, si especificar cuál');
}
if(isMobile.Android()) {
  console.log('Esto es un dispositivo Android');
}
if(isMobile.BlackBerry()) {
  console.log('Esto es un dispositivo BlackBerry');
}
if(isMobile.iOS()) {
  console.log('Esto es un dispositivo iOS');
}
if(isMobile.Opera()) {
  console.log('Esto es un dispositivo Opera');
}
if(isMobile.Windows()) {
  console.log('Esto es un dispositivo Windows');
}
// console.log(isMobile);

</script>
