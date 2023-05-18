<div class="right_col" role="main">
      <!-- row -->
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0px 0px 0px 0px;">
<div class="x_panel" id="imgfondo">
              <!-- x_Content interior-->
                    <div class="x_content">

                    <div >
                      <div class="dashboard-widget-content" >
                        <?php if(isset($_SESSION['loginagency'])) {?>
                        <h1 class="titleagency"><b style="text-transform: uppercase"> WELCOME <?php  print_r($login->company_name) ?></b> <br> <small style="color:#fff">(<?php print_r($login->manager) ?>)</small>
                        <?php }else{ ?>
                        <h1 class="titleagency"><b style="text-transform: uppercase"> WELCOME <?php  print_r($login->company_name) ?></b> <br>
                        <?php } ?></h1>
                      </div>
                    </div>

                    </div>
                     <!-- x_Content interior END-->

             <!--x_panel End -->
    </div>



</div>
</div>
  <!-- row end -->






  <!-- row -->
 <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12" id="dateform">
                  <div class="x_panel" style="
                    border-radius: 0px 0px 6px 6px;
                    -moz-border-radius: 0px 0px 6px 6px;
                    -webkit-border-radius: 0px 0px 0px 20px;">
                    <div class="x_content">
                      <small>Create a New Reservation </small>

                      <div class="dashboard-widget-content" >
                      <?php if(isset($_SESSION['loginagency'])) { ?>
                      <form class="form-horizontal form-label-left input_mask" action="<?php echo $data['rootUrl']?>admin/reservas/MostrarReserva" method="POST">
                      <?php }else{?>
                        <form class="form-horizontal form-label-left input_mask" action="<?php echo $data['rootUrl']?>admin/login_agency" method="POST">
                        <input  name="useroff"   value="off" readonly type="hidden" />
                      <?php } ?>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <label for="heard">option:</label>
                        <select id="opcion" class="select2_single form-control"  name="opcion" required="required">
                              <option value="">Choose..</option>
                              <?php if($serviciosV->serv_transp == 1) {?>
                              <option  value="reservas/transportation/add">Transportation</option> 
                              <?php } ?>
                              <?php if($serviciosV->serv_oneday == 1) {?>
                              <option value="" ;>Oneday Tours</option>
                              <?php }?>
                              <?php if($serviciosV->serv_multiday == 1) {?>
                              <option value="" style="display:none";>Multiday Tours</option>
                              <?php }?>
                          </select>
                      </div>
                        <div id="opc_trasortacion">


                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                      <p>
                      <label for="heard">Round Trip:</label>
                      <input  name="tipo_ticket"  id="roundt" type="radio" value="roundtrip" onclick="ocultar(0)" checked/> <b>|</b>
                        <label >One Way Trip :</label>
                        <input  name="tipo_ticket"  id="oneway" type="radio" value="oneway" onclick="ocultar(1)" />
                      </p>
                      </div>


                      <div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback from12">
                          <label for="heard">Departure Date:</label>
                        <input class="form-control has-feedback-left" style="text-align: left; font-size:1em;font-weight: bold; padding-right: 4.5px;"  name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value=""  autocomplete="off"  placeholder="Departure Date" />

                        <input  style="text-align: left; font-size:1em;font-weight: bold; padding-right: 4.5px;"  class="form-control has-feedback-left"   name="fecha_salida2" type="text"  id="fecha_salida2" size="10" maxlength="15" value=""  autocomplete="off"  placeholder="Departure Date"/>

                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-3 col-xs-6 form-group has-feedback " id="Content_fecha_retorno">
                          <label for="heard">Return Date:</label>
                          <input   placeholder="Return Date" class="form-control has-feedback-left"  style="text-align: left; font-size:1em;font-weight: bold; padding-right: 4.5px;"   name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15"  autocomplete="off" />
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
                          <label for="heard">Adult:</label>
                      <input data-toggle="tooltip" data-placement="bottom" title="Adult" type="number" placeholder=" Adult" name="pax" size="2" maxlength="2" style="padding-right: 1.5px;" class="form-control" id="pax" max="8" value=""  min="1" required="required"  onchange="
                                var a = document.getElementById('pax').value;
                                //alert(a);
                                if (isNaN(a)) {
                                    return false;
                                } else {
                                    var max = 8 - a;
                                    if (max < 0) {
                                      Swal.fire({
                                        type: 'error',
                                        title: 'Oops...',
                                        text: 'Total passenger (Adult + Child) must be 8'
                                        });
                                        var valor = 8 - $('#pax2').val();
                                        document.getElementById('pax').value = valor;
                                        $('#pax2').attr('max', valor);
                                    } else {
                                        $('#pax2').attr('max', max);
                                        if ($('#pax2').val() > max) {
                                            $('#pax2').attr('value', max);
                                        }
                                    }
                                }"/>
                      </div>


                      <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
                          <label for="heard">Child:</label>
                                <input data-toggle="tooltip" data-placement="bottom" title="Child (3 to 9 Years old)" type="number" style="padding-right: 1.5px; " placeholder="Child" name="pax2"   class="form-control" id="pax2"  value="" min="0" required="required" onchange="
                                var a = document.getElementById('pax2').value;
                                if (isNaN(a)) {
                                    return false;
                                } else {
                                    var max = 8 - a;

                                    if (max <= 0) {
                                        alert('Total passenger (Adult + Child) must be 8');
                                        var valor = 8 - $('#pax').val();
                                        document.getElementById('pax2').value = valor;
                                        $('#pax2').attr('max', valor);
                                    } else {
                                        if ($('#pax').val() > max) {
                                            $('#pax').attr('value', max);
                                            alert('Total passenger (Adult + Child) must be 8');
                                        }
                                    }
                                }"/>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >

                      <button type="submit" class="btn btn-success btn-flat" style="float: right; ">Go!</button>

                      </div>
                      </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  <!-- row end -->






  <?php if(isset($_SESSION['loginagency']) AND $login->admon == 1) { ?>



  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
            <div class="x_title">
              <h2>Action</h2>
              <div class="clearfix"></div>
            </div>

            <div class="row top_tiles">

                            <!--<div class="animated fadeIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="javascript:void(window.open('<?php //echo $data['rootUrl'] ?>admin/reservas/new/add','RESERADD',''))">
                              <div class="tile-stats">
                                  <div class="icon"><i class="fa fa-plus"></i></div>
                                  <div class="count">New T</div>
                                  <h3>New Reservation</h3>
                                  <p>You Can Do A Transportation Clicking Here.</p>
                              </div>
                            </a>
                            </div>-->

                          <div class="animated fadeIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <a href="<?php echo $data['rootUrl'] ?>admin/reservas/">
                            <div class="tile-stats">
                              <div class="icon"><i class="fa fa-search"></i></div>
                              <div class="count">Search</div>
                              <h3>Existing Reservation</h3>
                              <p>Past or Future.</p>
                            </div>
                            </a>
                          </div>
              </div>
        </div>
      </div>
    </div>
  </div>

  <?php  } ?>

</div>



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


    <script>
      // Slideshow 1
      $jq("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });
</script>
<script>
$jq(document).ready(function(){
  // alert();
          $jq('#modalaviso').modal('show');
  $jq('#opc_trasortacion').hide();
})
// function sendpass(){
//   alert();
// }
</script>

    <script>
      // Slideshow 1
      $jq("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });
</script>


<script>
$jq('#opcion').change(function(){
 var opc = $jq('#opcion option:selected').val();
 if (opc == 'reservas/transportation/add') {
  $jq('#opc_trasortacion').show();
 }else{
  $jq('#opc_trasortacion').hide();
 }
//alert(opc);
});

</script>

        <!-- <script>
    window.addEventListener("beforeunload", function (e) {
  var confirmationMessage = "\o/";
        (e || window.event).returnValue = confirmationMessage; //Gecko + IE
        return confirmationMessage;                            //Webkit, Safari, Chrome
      });
    </script> -->

<script>
function ocultar(val) {

console.log("val : "+val);

if (val == 0) {
$('.from12').removeClass('col-md-12 col-sm-12 col-xs-12 form-group has-feedback');
$('.from12').addClass('col-md-6 col-sm-6 col-xs-6 form-group has-feedback');
$("#fecha_salida2").hide();
$("#fecha_salida").show();
$("#fecha_salida").val(moment().format('MM/DD/YYYY'));
$("#fecha_retorno").val(moment().add(1, 'days').format('MM/DD/YYYY'));
document.getElementById('fecha_retorno').style.display = 'block';
document.getElementById('Content_fecha_retorno').style.display = 'block';
} else {
$('.from12').removeClass('col-md-6 col-sm-6 col-xs-6 form-group has-feedback');
$('.from12').addClass('col-md-12 col-sm-12 col-xs-12 form-group has-feedback');
$("#fecha_salida").hide();
$("#fecha_salida2").show();
document.getElementById('fecha_retorno').style.display = 'none';
document.getElementById('Content_fecha_retorno').style.display = 'none';
$("#fecha_salida2").val(moment().format('MM/DD/YYYY'));
$('#fecha_retorno').val(' ');
}

}
</script>
    <script>
    ocultar(0);
    $('#pax').val(1);
    $('#pax2').val(0);
             $("#fecha_salida").val(moment().format('MM/DD/YYYY'));
             $("#fecha_retorno").val(moment().add(1, 'days').format('MM/DD/YYYY'));
              new Lightpick({
              field: document.getElementById('fecha_salida'),
              secondField: document.getElementById('fecha_retorno'),
              numberOfMonths: 2,
              minDate: moment().startOf(new Date()).add((1)-1, 'days'),
              // maxDate: moment().endOf('Year').subtract(0, 'day'),
              months: true,
              onSelect: function(salida, retorno){

                  // salida.format('MM/D/YYYY');
                  // retorno.format('MM/D/YYYY');
              // rango(salida, retorno);
              }
          });
          new Lightpick({
              field: document.getElementById('fecha_salida2'),
              numberOfMonths: 1,
              minDate: moment().startOf(new Date()).add((1)-1, 'days'),
              onSelect: function(salida){
              // rango(salida, null);
              }
          });
            </script>
                          <script>
              $jq(document).ready(function(){
                // $jq.removeCookie("prueba");
                $jq.cookie("prueba",44);
                // alert($jq.cookie("prueba"));
                if ($jq.cookie("prueba") == 44 && $jq.cookie("prueba2") != 88) {
                  introJs().start();
                $jq.removeCookie("prueba");
                $jq.cookie("prueba2",88);
                }
              })

              </script>
	<script>

    //$('[data-toggle="popover"]').popover()

    </script>
<script>

    $("#from").change(function () {
       var ctry = $('select[name="fromt"] option:selected').text();
        $('#from').prop('title',ctry);


        var id = $("#from").val();

        // alert(id);
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
            $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
//            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
//            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));

//            $("#from2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id), function() {
//                $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val()));
//            });
            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));


        }

        $("#to").change(function () {
        var ctry = $('select[name="to"] option:selected').text();
        $('#to').prop('title',ctry);
        });


    });
</script>
