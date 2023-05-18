<?php
//Actualizado por Ing. Arturo Bustamante Madariaga [2016-2019]
$valida = false;
if (isset($data["reserve"])) {
    $reserva = $data["reserve"];
} else {
    $valida = true;
}
if (isset($data['cliente'])) {
    $cliente = $data['cliente'];
}
if (isset($data['pickup'])) {
    $p = $data['pickup'];

    //print_r($data['pickup']);

}
if (isset($data['drop1'])) {
    $drop1 = $data['drop1'];
//print_r($drop1);
}
if (isset($data['pickup2'])) {
    $pickup2 = $data['pickup2'];
}
if (isset($data['drop2'])) {
    $drop2 = $data['drop2'];
}
if (isset($data['routes'])) {
    $routes = $data['routes'];
}
if (isset($data['routes2'])) {
    $routes2 = $data['routes2'];
//print_r($routes2);
}
$login = $_SESSION['loginagency'];

//destruimos variable de session Multiday

//******************unset($_SESSION['code_conf']); Habilitar depues de probar con tours

//destruimos variable de session Oneday

//******************unset($_SESSION['codconfone']); Habilitar depues de probar con tours


//$codigo_multi = $_SESSION['code_conf'];
//$codigo_one = $_SESSION['codconfone'];
//echo $codigo_multi;
//echo $codigo_one;

$codigo_confirm = $_SESSION['codconf'];
$cadena = $codigo_confirm;
$buscar   = 'T';
$pos = strpos($cadena, $buscar);

if ($pos === false) {

    echo '<i style="display:none; color:#0B55C4;font-size:16px;font-family:calibri; text-align:right;">
          <b>Reservation # [ ✓ ]</b> </i> ';
} else {

    echo "Codigo de Confirmacion Errado.";

    echo '<script>

            window.open("../reservas/add","RESERADD","");

         </script>';

    $codigo_confirm = $_SESSION['codconf'];

}

$fecha_hoy = date("Y-m-d");
$dias= 1; // los días a restar
$fecha_ayer =  date("Y-m-d", strtotime("$fecha_hoy - $dias day"));
//Doo::db()->query("DELETE FROM  reservas_trip_puestos WHERE fecha_trip <= '$fecha_ayer'");

$opc = $_SESSION['opcionhome'];
// print_r($opc);
// die;
$r = explode('/', $opc['fecha_salida']);
$fecha_salida = $r[0]."-".$r[1]."-".$r[2];
$r = explode('/', $opc['fecha_salida2']);
$fecha_salida2 = $r[0]."-".$r[1]."-".$r[2];

if ($opc['fecha_retorno'] != " ") {
    $r2 = explode('/', $opc['fecha_retorno']);
    $fecha_retorno = $r2[0]."-".$r2[1]."-".$r2[2];
}else{
    $fecha_retorno = 'nodate';
}
// echo '<pre>';
// print_r($reserva);
// echo '</pre>';
// die;
?>

    <!-- <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script> -->


<!--<link rel="stylesheet" href="/resources/demos/style.css">-->




      <!-- jQuery -->
      <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/dist/jquery.min.js"></script>
      <script>
    var $jq = jQuery.noConflict();
    // alert($jq.fn.jquery);
    </script>

    <!-- Bootstrap -->
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap/dist/js/bootstrap.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>global/load/js/vendor/modernizr-2.6.2.min.js"></script>

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

    <!-- DateJS -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/DateJS/build/date.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>global/startjs/sweetalert2.js"></script>
    <!-- <script>
       swal("Here's a message!");
    </script> -->
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/js/custom.js"></script>

    <!-- jQuery Cookie-->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/src/jquery.cookie.js"></script>

    <!-- Custom Theme Scripts -->

<script src='<?php echo $data['rootUrl']?>global/startjs/moment.min.js'></script>
    <script src='<?php echo $data['rootUrl']?>global/startjs/lightpick.js'></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/ajaxfileupload.js"></script>


<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--<script type="text/javascript" src="https://www.jose-aguilar.com/scripts/jquery/mask/jquery.mask.js"></script>-->
<!--jquery para el calendario-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>

    <!-- Flot -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.resize.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/js/intro.js"></script>
      <!-- BOOTSTRAp spin -->
    <script src="<?php echo $data['rootUrl']; ?>global/startjs/jquery.bootstrap-touchspin.js"></script>
        <!-- Custom Theme Scripts -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/switchery/dist/switchery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135697845-1"></script>

    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Fullscreen/js/jquery.loadingModal.js"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-135697845-1');
        </script>

<script language="JavaScript" type="text/javascript">
    var bPreguntar = true;
    window.onbeforeunload = preguntarAntesDeSalir;
    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "Are you sure? you will not be able recober your information";
    }
</script>
<script>
// alert($.fn.autosugguest);
</script>
    <script>
// alert($.fn.autosugguest);
// console.log($.fn);
</script>
<style type="text/css" media="screen">
    :-webkit-full-screen {
        background: pink;

    }
    :-moz-full-screen {
        background: pink;
    }

    /* otros elementos */
    :-webkit-full-screen video {
        width: 100%;
        height: 100%;
    }


</style>

<script type="text/javascript">

    var bPreguntar = true;

    //window.onbeforeunload = preguntarAntesDeSalir;

    function preguntarAntesDeSalir()
    {
        if (bPreguntar === true){
            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
            return "Salir de la ventana o actualizarla, generara un nuevo codigo de reserva.";
        }

    }



</script>

<div class="catsandstars" id="header_page"   style="height:77px; display:none;" >
<!--<i onclick = "Verificar();" title="Refresh" class="fa fa-spinner fa-spin fa-2x" style="position:absolute; cursor: pointer; margin-left:485px; margin-top:134px; color:#e63244;"></i>-->
<!--<img onclick = "Verificar();" title="Refresh" style="position:absolute; color: red; width:23px; height:23px; cursor: pointer; margin-left:820px; margin-top:84px;" src="<?php echo $data['rootUrl']; ?>global/img/refresh.svg" />-->

    <div class="header2" style="display:none;">


        <table style="width:500px; ">
            <tr>
                <td width="30%" class='stroke1'style="position:absolute; margin-top:11px; margin-left:-109px; width:392px; color:#0B55C4; text-shadow: 1px 4px #999; font-size:30px; font-weight:normal; text-align:center; font-family:Impact;">Reservas New</td>

                <td width="10%" style='display:none;'>
                    <table>
                        <tr>
                            <td id="bnt-trips" class="btn" style="position:absolute; cursor:pointer; margin-left:200px; margin-top:-5px;"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/calendar_aviso32x32.png" /></td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
<!--                <td><?php/* echo $reservaNew;*/?></td>-->
                <td width="10%" ></div></td>
            </tr>
        </table>
    </div>
    <div id="info-group" style="">
        <input type="text" readonly="true" style="display:none;  background: #33449C; margin-left: 285px; margin-top: -21px; width: 303px; color: #fff; border-color: transparent; font-family: Arial, Helvetica, sans-serif;" name="taritrans" id="taritrans" placeholder="Rates" />
    </div>

    <script type="text/javascript">
        function capturar2()
        {
//            var x = document.getElementById('taritrans1').value;
//            document.getElementById('taritrans').value = x;
        }
    </script>

    <div  id="toolbar" style="margin-top: -27px; display:none;">
        <select style="margin-left:-17%; margin-top: 29px; width:303px; background: #AC1B29;color: #fff;border-color: transparent;" name="special_price_name" id="special_price_name" onchange=""  >

            <option id="" value="Rates">Rates</option>
            <?php
            $sql1 = "SELECT DISTINCT special_price_name FROM tarifarios_transportacion";
            $rs1 = Doo::db()->query($sql1);
            $routesnet = $rs1->fetchAll();
            foreach ($routesnet as $r) {
                $especial = $r['special_price_name'];
                $special_price = str_replace(array('+','-','/',':','*','\\',' ','.','%','#','$','@','!','?','"','<','>','&'),'_',$especial);

                echo '<option disabled  value="' . $special_price . '" >' . $special_price . '</option>';
            }
            ?>
        </select>

        <script>
            function myFunction() {
//                var x = 'RATES ----------------------------------------------------->';
//                document.getElementById("taritrans").value = x;
            }
        </script>


        <div class="toolbar-list">

            <ul>
                <li class="btn-toolbar" id="btn-save1">
<!--                    <a class="link-button" id="btn-save1"><span class="icon-32-save" title="Nuevo" >&nbsp;</span>Save</a>-->
<!--                    <a class="link-button" id="btn-save1"> <i class="fa fa-floppy-o fa-3x" title="" style="margin-left: 4px; color:#4B0082;"></i>&nbsp;Save</a>-->
                </li>

                <!--                <li class="btn-toolbar" id="btn-cancel1">
                                <a  class="link-button" ><span class="icon-back" title="Editar" >&nbsp;</span>Back</a>
                                    <a class="link-button"><i class="fa fa-arrow-left fa-3x" title="Regresar" style="color: #33449C;"></i> Back</a>
                                </li>                      -->
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>


<!-- header options -->
<form  id="formula" class="form" action="<?php echo $data['rootUrl']; ?>admin/reservas/save" target="_blank" method="POST" name="formula"  >
    <div id="info-group2" style="display:none;">
        <div id="cancelation" style="display:none">
            <div class="ho">CANCELATION <span>#</span></div>
            <div id="cancel"><strike>  00000 </strike></div>
        </div>
        <div id="reservation" style="border-color: #fff;">
            <div class="ho" style="color: #fff; background: #000;"> RESERVATION <span>#</span></div>

            <div>
                <input type="text" id="reser" name ="reser" style="background: #CB2C2C; margin-top:0px; margin-left:0px; text-align: center; font-size: 12px; font-weight: bold; color: white; width: 298px; height: 11px;" value="<?php echo $_SESSION['codconf']; ?>" readonly="readonly" >
                <input type="text"  id="codconf" name="codconf" style="display:none;" value="<?php echo $_SESSION['codconf']; ?>"/>
            </div>

        </div>
        <div id="status" style="display:none">
            <div class="ho" style="color: #fff;background: #bb0000; height:12px;">STATUS</div>

            <div id="stat"></div>
        </div>
        <div id="status-change" style="display:none">
<!--            <div style="color:#4B0082; "><strong>STATUS</strong></div>-->
            <div class="ho" style="color: #fff;background: #bb0000;padding: 4px;margin-top: 2px; margin-left:47px; width:44px; ">STATUS</div>
            <select style="width:112px; margin-left: -4px; margin-top:-2px;" id="estado" name="estado">
                <option></option>
                <option value="CONFIRMED" selected>CONFIRMED</option>
                <option value="QUOTE">QUOTE</option>
            </select>
        </div>

        <div id="" style="margin-top: -3.5px; margin-left: 967px; position: absolute;">
             <input type="button" id="btn-cancel_booking" style="margin-left: -101px; cursor: pointer;" class="oliverty"  value="Cancel Booking" onClick="window.location.reload(); cancel_puesto();">
        </div>
    </div>

    <input type="text" style="display:none; margin-left:10px; width:50px;" name="tarifaone"   id="tarifaone" size="15"  value="0" />
    <input type="text" style="display:none; margin-left:10px; width:50px;" name="tarifaround"   id="tarifaround" size="15"  value="0" />

    <div id="opera" class="input" style="display:none; padding-top:5px;"> <label  style="display:none; color:#00f;"><strong>ONE2</strong> </label> <input name="tipo_ticket2" onClick="" id="oneway2" type="radio" value="1"  /></div>
    <div id="opera" class="input" style="display:none; padding-top:5px;"> <label style="display:none; color:#AC1B29;"><strong>ROUND2</strong> </label><input name="tipo_ticket2"  onClick=""  id="roundtrip2" type="radio" value="2"  /> </div>

    <!--    <div id="content_page" style="width: 1000px; z-index:1; height:1167px; margin-top: 3px;"  > background-image: url('<?php /*echo $data['rootUrl'] */?>global/img/bg2.jpg');-->
    <div  >
        <div >
            <input id="fin_calculo" type="hidden" value="false"/>

            <input type="hidden"  id="vista" value="1" />
            <input name="id" type="hidden"  id="id"  value="<?php
            if (isset($reserva)) {
                echo $reserva->id;
            }
            ?>" />





		<div class="right_col" role="main">
			<div class="">
				<div class="clearfix"></div>
                <!-- <div id="mensajeTrip"   class="temporizador"></div> -->

					<div class="row">
					  <div class="col-md-6 col-sm-12 col-xs-12" data-step="1" data-intro="leader pass"  data-position='left'>
						<div class="x_panel">

                  <div class="x_title">
                    <h2>LEADER PASS</h2>

                    <!-- <div id="" class="col-md-4" style="float:right">
                        <input type="button" id="btn-cancel_booking" title="Cancel" class="btn btn-danger btn-xs btn-block oliverty"  class="link-button" value="Cancel Booking" onClick="window.location.reload(); cancel_puesto();"/>
                    </div> -->


                    <div class="clearfix"></div>

                  </div>

				<div class="x_content">
                        <div class="container" >
                            <div class="row ">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group " data-step="2" data-intro="informacion basica del pasajero"  data-position='right'>


                                    <div title="Passenger First Name" class="col-md-6 col-md-6 col-sm-12 col-xs-12 form-group "  >
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"> <strong> First Name</strong></label>
										<input style="font-weight: bold;" name="firstname1" id="firstname1"  type="text" class="verdefosub form-control"  value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->firstname;
                                                            }
                                                        }
                                                        ?>" />
                                    </div>

                                    <div title="Passenger Last Name" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                        <label   class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"><strong>Last Name</strong></label>
										<input  style="font-weight: bold;" name="lastname1" id="lastname1" type="text" class="verdefosub form-control" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->lastname;
                                                            }
                                                        }
                                                        ?>" />
                                    </div>
                                    <div title="Email" class="col-lg-5 col-md-5 col-sm-12 col-xs-12 form-group">
                                        <label  class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"><strong>Email</strong></label>
										<input  style="font-weight: bold; " name="email1" id="email1" type="text"  class="verdefosub form-control" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->username;
                                                            }
                                                        }
                                                        ?>" />
                                    </div>

                                    <div title="Contact phone" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                        <label  class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"><strong>Phone</strong></label>
										<input  style="font-weight: bold; font-style: italic; " name="phone1" id="phone1" type="number" class="verdefosub form-control" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->phone;
                                                            }
                                                        }
                                                        ?>" />
                                    </div>


                        <div title="Reference Number" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                <label  class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"># Ref</label>
                                <input style="font-weight: bold; font-style: italic;" name="numref" id="numref" type="text" class="verdefosub form-control"  />
                        </div>

                                </div>


                                <div style="display:none;" class="col-md-6 col-sm-12 col-xs-12 form-group " data-step="3" data-intro="informacion basica del pasajero"  data-position='left'>
                                    <table class="table  jambo_table bulk_action" style="text-aling:left">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">Quote </th>
                                            <th class="column-title">Adult</th>
                                            <th class="column-title">Child</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr class="even pointer">
                                            <td class=" " style="text-align:right; font-weight: bold;">Line Transportation</td>
                                            <td class=" " ><span  name ="transporadult" id="transporadult"  value="0" style="font-weight:bold; "></span></td>
											<input type="hidden" name ="transadult" id="transadult" value="0" />
											<input type="hidden" name ="transchild" id="transchild" value="0"/>

                                            <td class=" "><span name ="transporechil" id="transporechil" value="0" style="font-weight:bold; "></span></td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr class="even pointer">
                                            <td class=" " style="text-align:right; font-weight: bold;">Extensions</td>
                                            <td class="text-danger "><span id="extenadult" style="font-weight:bold; "></span></td>
                                            <td class="text-danger "><span id="extenchil" style=" font-weight:bold; "></span></td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr class="even pointer">
                                            <td class=" " style="text-align:right; font-weight: bold;">Sub-total per Pax</td>
                                            <td class=" "><span id="subtoadult" style=" font-weight:bold; "></span></td>
                                            <td class=" "><span id="subtochild" style=" font-weight:bold; "></span></td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr class="even pointer">
                                            <td class=" " style="text-align:right; font-weight: bold;">TOTAL</td>
                                            <td class=" " style="text-align:right"></td>
                                            <td class=" " style="text-align:left;"><label style="text-align:left; color:#4B0082; font-weight:bold; margin-left:-40%;">$<strong id="totaltotal" >$ 00.0</strong></label></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>


				</div>
			</div>





              <div class="col-md-6 col-sm-12 col-xs-12" data-step="4" data-intro="Booking"  data-position='left'>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>BOOKING</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="container" >
                            <div class="row " >

                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="radio">
                                        <label  style=" font-size: 1.4em;" class="tri">
                                        <input type="radio" onclick="capturar(); reset_roundtrip();" id="oneway"  name="tipo_ticket" value="1" <?php
                                        if (isset($opc)) {
                                            if ($opc['tipo_ticket'] == 'oneway') {
                                                echo ' checked ';
                                            }
                                        }
                                        ?> /> One Way
                                        </label>
                                    </div>

                                    <div class="radio" >
                                        <label  style=" font-size: 1.4em;" class="tri">
                                        <input name="tipo_ticket"  onclick="capturar(); reset_roundtrip();"  id="roundtrip" type="radio"  name="tipo_ticket"  value="2" <?php
                                                if (isset($opc)) {
                                                    if ($opc['tipo_ticket'] == 'roundtrip') {
                                                        echo ' checked ';
                                                    }
                                                }
                                                ?>> Round Trip
                                        </label>
                                    </div>

                                <div class="col-lg-3" style="display:none">
                                    <label class="control-label col-md-10 col-sm-12 col-xs-12">Type Of Pass:</label>
                                    <select class="select2_single form-control" tabindex="-1" disabled>
                                        <option value="0">No Resident</option>
                                        <option value="1">Resident</option>
                                    </select>
                                </div>
                                <div id="paxs">
                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" data-step="7" data-intro="Adult"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Adult:</label>
							<input class="form-control" data-bts-min="0" data-bts-max="8" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0"  data-bts-button-down-class="btn btn-success" data-bts-button-up-class="btn btn-success" name="pax" max="8" autocomplete="off" type="number" min="1"  id="pax" size="2" maxlength="2"  style="border:1px solid #AFAFAF; font-weight: bold;text-align: center;  color:#333;" onchange="
                            var a = document.getElementById('pax').value;
                            if (isNaN(a)) {
                                return false;
                            } else {
                                var max = 8 - a;
                                if (max < 0) {
                                    var valor = 8 - $('#pax2').val();
                                    document.getElementById('pax').value = valor;
                                    $('#pax2').attr('max', valor);
                                } else {
                                    $('#pax2').attr('max', max);
                                    if ($('#pax2').val() > max) {
                                        $('#pax2').attr('value', max);
                                    }
                                }
                            }"   />


                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" data-step="8" data-intro="leader pass"  data-position='right'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Child:</label>
							<input class="form-control" name="pax2" type="number"  data-bts-min="0" data-bts-max="100" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0"  data-bts-button-down-class="btn btn-success" data-bts-button-up-class="btn btn-success" id="pax2" size="2" maxlength="2"   autocomplete="off" style="border:1px solid #AFAFAF; font-weight: bold; text-align: center; color:#333;" min="0" max="8" onchange="
                            var a = document.getElementById('pax2').value;
                            if (isNaN(a)) {
                                return false;
                            } else {
                                var max = 16 - a;
                                if (max <= 0) {
                                    var valor = 16 - $('#pax2').val();
                                    document.getElementById('pax2').value = valor;
                                    $('#pax2').attr('max', valor);
                                } else {
                                    if ($('#pax').val() > max) {
                                        $('#pax').attr('value', max);
                                    }
                                }
                            }"  />
								 </div>

                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" data-step="9" data-intro="total"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Total:</label>
                                  <input class="form-control" style="font-weight: bold; text-align: center; color:#333;" name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/> </div>

                            </div>

                            <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">AutoComplete</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="country" id="autocomplete-custom-append" class="form-control col-md-10"/>
                        </div>
                      </div> -->

                        </div>
                    </div>
                </div>
            </div>

                </div>
				</div>
        </div>
              <!-- <script>
              $(document).ready(function(){
                $("#pax").TouchSpin();
                $("#pax2").TouchSpin();
              })
            </script> -->




			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" data-step="10" data-intro="ONE WAY"  data-position='left'>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DEPARTURE</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="container">

                        <div class="container">
                            <div class="row ">

                            <!-- <div class="col-lg-3">

                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Departure:</label>
                                    <div class="control-group">
                                      <div class="controls">
                                        <div class="col-md-10 xdisplay_inputx form-group has-feedback">
										<input style="text-align: center; font-size:1em;font-weight: bold;" style="text-align: center; "class="form-control has-feedback-left"   name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value=""  autocomplete="off"  placeholder="Date" />

                                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div> -->

                                  <div class="col-md-3 col-sm-12 col-xs-12 dat" data-step="11" data-intro="leader pass"  data-position='left'>
                                        <label class="control-label " class="control-label col-md-12 col-sm-12 col-xs-12">Departure:</label>
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 xdisplay_inputx form-group has-feedback">
							<input style="text-align: left; font-size:1em;font-weight: bold; padding-right: 8.5px;" class="form-control has-feedback-left"   name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value=""  autocomplete="off"  placeholder="Date" value="" />


                        <!-- <input  style="text-align: left; font-size:1em;font-weight: bold;"  class="form-control has-feedback-left"   name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value=""  autocomplete="off"  placeholder="Date"/> -->


                                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12 col-xs-12" id="fromm" data-step="12" data-intro="leader pass"  data-position='left'>
                                        <label class="control-label ">From:</label>
                                    <div  >
                                        <select name="fromt" class="select2_single form-control" id="from">
                                            <option style="width:145px; "value="0"></option>


                                            <?php foreach ($data["areas"] as $e) { ?>
												<?php if($e["id"] != 20 AND $e["id"] != 16 AND $e["id"] != 17){ ?>
													<option title="<?php echo $e["nombre"]; ?>" value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>
												<?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" data-step="13" data-intro="leader pass"  data-position='left'>
                                        <label class="control-label ">To:</label>
											<div >
												<select name="to" class="select2_single form-control" id="to" >
												</select>
												<input type="hidden" name="valto" id="valto" value="<?php
												if (isset($reserva)) {
													echo $reserva->tot;
												}
												?>"/>
											</div>



                                <div id="mascaraP" style="display: none;">

                                </div>
                                <div id="popup" style="display: none;">
                                <!-- <div id="loading" style="    height: 254px; margin-left: 35%; margin-top: 20px; position: absolute;">
                                            <img style=""  src="<?php echo $data['rootUrl']; ?>global/img/admin/load.gif" />

                                        </div> -->
                                        <div id="loading">
                                            <div id="loader-wrapper">
                                                <div id="loader"> </div>
                                                    <p style="margin-top:26%; margin-left:5% ">loading please wait...</p>
                                            </div>
                                        </div>

                                    <div class="content-popup">

                                    </div>
                                </div>
                    </div>

                    <div id="clienteN" style=" display:none; width: 700px; margin-left: 100px;"></div>
                                    <div class="col-lg-1 " id="popup1" data-step="14" data-intro="leader pass"  data-position='left'>
                                        <label class="control-label col-md-3 col-sm-2 col-xs-2 ">Search</label>
                                        <a  type="button" class="btn btn-dark btn-flat form-control" id="search1"  onclick="activa_one(); comprobarScreen(); cargando();">
                                            <i class="fa fa-search" title="Search" style="margin: 3px 0px 0px 0px;"></i></a>
                                    </div>

                                    <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12" data-step="15" data-intro="leader pass"  data-position='left'>
                                        <label class="control-label ">Trip:</label>
                                        <input id="trip_no" name="trip_no" placeholder="trip" style="text-align: center;"   type="text" class="form-control" value="<?php
                                            if (isset($reserva)) {
                                                echo $reserva->trip_no;
                                            }
                                            ?>"  readonly="readonly">
                                  </div>
                                  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dep1" data-step="16" data-intro="leader pass"  data-position='left'>
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12 spadt">Departure Time:</label>
                                        <input name="departure1" placeholder="Dep. Time"  class="form-control"  type="text"  id="departure1" size="5" maxlength="8" style="text-align: center;" value="<?php
                                        if (isset($reserva)) {
                                            echo date("g:i a", strtotime($reserva->deptime1));
                                        }
                                        ?>" readonly="readonly"/>
                                  </div>
                            </div>
                    </div>

                      <div class="container">
                          <div class="row ">

                              <div class="col-md-5 col-sm-12 col-xs-12" data-step="17" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Pick Up Point/Address:</label>
						        <!-- <div class="ausu-suggest" >
                                <input title="<?php echo $p->place;?>" name="pickup1" type="text"  id="pickup1"  class="form-control" placeholder="Pick Up Point/Adress"  onkeyup="resetpickup1();" onchange="changepickup1();" size="40" maxlength="55" value="<?php
                                // if (isset($p) && $p != "") {
                                //     echo $p->place;
                                // }
                                ?>" autocomplete="off"  />
                                <input class="form-control" name="id_p1" type="hidden"  id="id_p1"  size="40" maxlength="55" value="<?php
                                // if (isset($p) && $p != "") {
                                //     echo $p->id;
                                // }
                                ?>" />
                            </div> -->
                            <select name="id_p1" class="select2_single form-control" id="id_p1" >
                                    <option value=''>Select Trip</option>
                            </select>
                              </div>

                              <div class="col-md-5 col-sm-12 col-xs-12" data-step="18" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Drop Off Point/Address:</label>
									<!-- <div class="ausu-suggest" >
										<input class="form-control" placeholder="Drop Off Point/Adress" name="dropoff1" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php
										// if (isset($drop1) && $drop1 != "") {
										// 	echo $drop1->place;
										// }
										?>" autocomplete="off" />
										<input name="id_dropoff1" type="hidden"  id="id_dropoff1" size="40" maxlength="55" value="<?php
										// if (isset($drop1) && $drop1 != "") {
										// 	echo $drop1->id;
										// }
										?>" />
									</div> -->
                                    <select name="id_dropoff1" class="select2_single form-control" id="id_dropoff1" >
                                            <option value=''>Select Trip</option>
                                    </select>
                              </div>

                              <div class="col-md-2 col-sm-12 col-xs-12" data-step="19" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Arrival Time:</label>
	                        <input  placeholder="Arr. Time" name="arrival1" type="text" style="text-align: center;" class="form-control" id="arrival1"  size="5" maxlength="8" value="<?php
							if (isset($reserva)) {
								echo date("g:i a", strtotime($reserva->arrtime1));
							}
							?>" readonly="readonly" />
                              </div>
                          </div>
                      </div>

                      <div class="container">
                          <div class="row ">

                              <div class="col-md-5 col-sm-12 col-xs-12" data-step="20" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Area From:</label>
                                    <select class="select2_single form-control" name="ext_from1" id="ext_from1"  onchange="change_ext_from1();" >
                                        <option value="0"></option>
                                    </select>
                              </div>

                              <div class="col-md-5 col-sm-12 col-xs-12" data-step="21" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Area To:</label>
                                <select class="select2_single form-control" tabindex="-1" name="ext_to1" id="ext_to1"  onchange="change_ext_to1();">
                                    <option value="0"></option>
                                </select>
                              </div>

                              <div class="col-md-2 col-sm-12 col-xs-12" data-step="22" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Room #:</label>
									<input style="text-align: center;"  placeholder="Room"  class="form-control" name="room1" type="text"  id="room1" size="4" maxlength="6" value=""  />
                              </div>
                          </div>
                      </div>


                      <div class="container">
                          <div class="row ">

                              <div class="col-md-6 col-sm-12 col-xs-12" data-step="23" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Pick Up Point/Address:</label>

                                    <div class="ausu-suggest">
                                        <input placeholder="Extension Pick Up Point" class="form-control" name="exten1" type="text"  id="exten1" size="46" maxlength="55" value=""  autocomplete="off"  />
                                        <input class="form-control" name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
                                    </div>
                                </div>
                              <div class="col-md-6 col-sm-12 col-xs-12" data-step="24" data-intro="leader pass"  data-position='left'>
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Drop Off Point/Address:</label>
                                   <div class="ausu-suggest" >
                                    <input placeholder="Extension Drop Off Point" name="exten2" class="form-control" type="text"  id="exten2"  size="47" maxlength="55" value="" autocomplete="off" />
                                    <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
                                </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
			</div>
           </div>
          </div>
          <style>
            @media (min-width: 1200px){
                .dat {
                    width: 20%;
                }
            }
          /* @media(max-width:1440px){
            .dep1{
                margin: 0px 0px 0px 921px;
                position: absolute;
            }
            .spadt{
                left: -7%;
            }
        }
            @media(min-width:320px){
                .dep1 {
                    margin: 0px 0px 0px 0px;
                    position: relative;
                }

                .spadt{
                    left: 0%;
                }
            } */
        </style>

			<div class="row" id="round"  class="rojillo">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel">
                  <div class="x_title">
                    <h2>RETURN</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                        <div class="container">


                        <div class="container">
                            <div class="row ">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 dat">
                                  <label class="control-label ">Departure:</label>
                                    <div class="control-group">
                                      <div class="controls">
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12  xdisplay_inputx form-group has-feedback">
								<input  style="text-align: left; font-size:1em;font-weight: bold; padding-right: 8.5px;"  placeholder=" Date" class="form-control has-feedback-left"   name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php
                                if (isset($reserva)) {
                                    echo $reserva->fecha_retorno;
                                }
                                ?>"  autocomplete="off" />
                                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
<!--                                          <span id="inputSuccess2Status3" class="sr-only">(success)</span>-->
                                        </div>
                                      </div>
                                    </div>
                                  </div>


                                    <div class="col-md-3 col-sm-12 col-xs-12" id="fromm2">
                                        <label class="control-label ">From:</label>
                                    <div  >
										<select class="select2_single form-control" name="fromt2"  id="from2" >
											<option value="0"></option>
											<?php foreach ($data["areas"] as $e) { ?>
												<?php if($e["id"] != 20 AND $e["id"] != 16 AND $e["id"] != 17){ ?>
												<option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
                                    </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label class="control-label">To:</label>
											<div >
											<select name="to2" class="select2_single form-control" id="to2">
												<option value="0"></option>
											</select>
											</div>
                                    </div>
									<div style="width:50px;" id="popup2">



                                <div id="clienteN" style=" display:none; width: 700px; margin-left: 100px;"></div>

                            </div>
                                <div class="col-lg-1 " id="popup2">
                                    <label  class="control-label col-md-3 col-sm-2 col-xs-2 ">Search</label>
                                    <a   onclick="activa_round(); comprobarScreen(); cargando();" type="button" class="btn btn-dark btn-flat form-control" id="search2"><i style="margin: 3px 0px 0px 0px;" class="fa fa-search" id="searchp2" title="Search" title="Search"></i></a>
									<input type="hidden" id="valorcomision02" name="valorcomision02" value="0" />
								</div>

                                <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                    <label class="control-label col-md-3 col-sm-1 col-xs-1">Trip:</label>
                                    <input class="form-control" name="trip_no2" type="text"  id="trip_no2" placeholder="trip" size="3" maxlength="3" style="text-align: center;"  value="<?php
                                    if (isset($reserva)) {
                                        echo $reserva->trip_no2;
                                    }
                                    ?>"  readonly="readonly"/>
                                  </div>
                                  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dep1">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12 spadt">Departure Time:</label>

                                    <input name="departure2" class="form-control" type="text"  id="departure2" size="5" placeholder="Dep. Time" maxlength="8" value="<?php
                                    if (isset($reserva)) {
                                        echo date("g:i a", strtotime($reserva->deptime2));
                                    }
                                    ?>" readonly="readonly" />

                                  </div>
                    </div>
                    </div>

                      <div class="container">
                          <div class="row ">

                              <div class="col-md-5 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Pick Up Point/Adress:</label>

                                <!-- <div class="ausu-suggest" >
                                    <input class="form-control" name="pickup2" placeholder="Pick Up Point/Adress" type="text"  id="pickup2"  onkeyup="resetpickup2();"  onchange="changepickup2();" size="40" maxlength="55" value="<?php
                                    if (isset($pickup2) && $pickup2 != "") {
                                        echo $pickup2->place;
                                    }
                                    ?>" autocomplete="off"  />
                                    <input name="id_pickup2" type="hidden"  id="id_pickup2"  size="40" maxlength="55" value="<?php
                                    if (isset($pickup2) && $pickup2 != "") {
                                        echo $pickup2->id;
                                    }
                                    ?>" />
                                </div> -->
                                <select name="id_pickup2" class="select2_single form-control" id="id_pickup2" >
                                    <option value="">Select Trip</option>
                                </select>

                              </div>

                              <div class="col-md-5 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Drop Off Point/Adress:</label>
								<!-- <div class="ausu-suggest" >
                                    <input class="form-control" placeholder="Drop Off Point/Adress" name="dpoff2" type="text"  id="dropoff2" size="39" maxlength="55" value="<?php
                                    // if (isset($drop2) && $drop2 != "") {
                                    //     echo $drop2->place;
                                    // }
                                    ?>" autocomplete="off"  />
                                    <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php
                                    // if (isset($drop2) && $drop2 != "") {
                                    //     echo $drop2->id;
                                    // }
                                    ?>" />
                                </div> -->
                                <select name="id_dropoff2" class="select2_single form-control" id="id_dropoff2" >
                                    <option value="">Select Trip</option>
                                </select>

                              </div>

                              <div class="col-md-2 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Arrival Time:</label>
                                <input class="form-control" name="arrival2" type="text"  style="text-align: center;" id="arrival2" placeholder="Arr. Time" size="5" maxlength="8" value="<?php
                                if (isset($reserva)) {
                                    echo date("g:i a", strtotime($reserva->arrtime2));
                                }
                                ?>" readonly="readonly"/>
                              </div>
                          </div>
                      </div>

                      <div class="container">
                          <div class="row ">

                              <div class="col-md-5 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Area From:</label>
                                <select name="ext_from2" id="ext_from2" class="form-control" onchange ="change_ext_from2();">
                                    <option value="0"></option>
                                </select>
                              </div>

                              <div class="col-md-5 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Area To:</label>
                                      <select name="ext_to2" id="ext_to2" class="form-control" onchange="change_ext_to2();">
                                    <option value="0"></option>
                                </select>
                              </div>

                              <div class="col-md-2 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Room #:</label>
									<input name="room2" type="text"  id="room2" size="4" maxlength="6" value="" placeholder="Room" style="text-align: center;" class="form-control" />
                              </div>
                          </div>
                      </div>


                      <div class="container">
                          <div class="row ">

                              <div class="col-md-6 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Pick Up Point/Address:</label>

                            <div class="ausu-suggest" >
                                <input placeholder="Extension Pick Up Point" type="text" name="exten3" id="exten3" class="form-control" size="46" maxlength="55" value="" autocomplete="off" />
                                <input name="id_ext_pikup3" type="hidden" class="form-control" id="id_ext_pikup3" size="40" maxlength="55" value="" />
                            </div>
                                </div>
                              <div class="col-md-6 col-sm-12 col-xs-12">
                                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Extension Drop Off Point/Adress:</label>
									<div class="ausu-suggest" >
										<input placeholder="Extension Drop Off Point" name="exten4" type="text"  id="exten4" size="47" maxlength="55" value=""  class="form-control" autocomplete="off" />
										<input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value=""  />
									</div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
			</div>
           </div>
          </div>



			  <!-- PAYMEN -->
                          <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12" data-step="25" data-intro="leader pass"  data-position='left'>
                                  <div class="x_panel">
                                      <div class="x_title">
                                          <h2>PAYMENT INFORMATIONS</h2>
                                          <div class="clearfix"></div>
                                      </div>
                                       <!-- PASSENGER Y AGENCY PAYMENT INFORMATION  -->
									   <input type="hidden" name="totalcom" id="totalcom" value="0">
                                      <div class="x_content">
                                          <div class="container">
                                              <div class="row ">

                                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                        <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                            <tr>
                                                <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION </strong>
                                                </td>
                                            </tr>

                                            <tr>

                                                <td width="2%">
                                                    <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio">
                                                </td>
                                                <td width="20%">Paid Full</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"  checked="checked"></td>
                                                <td width="20%">Paid Balance</td>

                                            <tr>
								<tr>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
                                </tr>
									<td valign="top"  >
                                        <table style="width:160px;">
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>

                                            <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_passager_3" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_passager_4" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_check"  value="10" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_check" for="opcion_pago_predpaid_check" class="">Check</label></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="top" >
                                        <table style="width:160px;">

                                            <tr id="tipo_passager_2" style="">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager_2"  value="8" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager_2" for="opcion_pago_passager_2" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_CrediFee">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio" class="opcion_pago"></td>
                                                <td align="left"  nowrap="nowrap" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_Cash">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_Cash_2">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash_2" value="9" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash_2" class="opcion_pago">Check</label></td>
                                            </tr>
                                        </table>
                                    </td>
									 <td align="left" valign="top" >
                                        <div id="tipo_Voucher" style="display:none">
                                            <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                        </div>
                                    </td>

                                            <tr><td colspan="6"><hr /></td></tr>
                                        </table>

                                        <!-- Passenger Payment Information -->
                                              <div class="animated fadeIn col-lg-5 col-md-5 col-sm-5 col-xs-12" data-step="26" data-intro="leader pass"  data-position='left' id="paiment">
                                                        <div class="tile-stats">
														<input type="text" id="bal_duep" name="bal_duep"    value="0.00"  style="display:none; border: 1px #33F solid; margin-top: -58px;  margin-right: -123px; text-align: right; height: 25px; font-size: 22px; width:118px;;" autocomplete="off" />
                                                            <table class="data table  no-margin" >
                                                            <thead>
                                                                <tr>
                                                                <th class="text-danger"><strong>Passenger Payment Information</strong></th>
                                                                <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                <tr >
                                                                <td style="text-align:right; font-weight: bold;"><strong id="txtamountpendiente">Amount to Pay Driver $</strong></td>
                                                                <td ><input type="text"  class="verd form-control"   id="saldoporpagar" style=" text-align: right;  font-size: 20px; font-weight:bold; width: 104px;" onKeyUp="dupliac();ponDecimales(2);" onkeypress="return soloNumeros(event);" autocomplete="off" /></td>
                                                                </tr>
                                                                <tr style="display:none">
                                                                <td style="text-align:right; font-weight: bold;"><strong>Paid Driver $</strong></td>
                                                                <td>
                                                                    <input type="button" id="btn_rever_cob" name="btn_rever_cob" title="Reverse Payment" class="button_sliding_bg form-control" style="display:none; position:absolute; background-color: #8c261a; border-color: lavenderblush; cursor:pointer; color:#fff;  margin-top: -1px; z-index: 1; padding:2.1px; width:17px; height:17px; font-weight: bold; font-size:9px;"   size="20"   value="X" onclick="rever_collect_on_board();"  />

																	<input type="text" id="paid_driver" name="paid_driver" class="brown3 form-control" readonly="readonly" autocomplete="off"    style="text-align: right;  font-size: 20px; font-weight:bold; width:103px; " value="" onKeyUp="CalcularTotalTotal();" onclick="valida_pago(this,'one');" />
																		<div style="position:absolute; margin-left:-2px; margin-top:0px;">

																			<div id="trian1" style="display:none; position:absolute; margin-left:380px; margin-top:100px;" class="triangulo1"></div>
																			<div id="trian2" style="display:none; position:absolute; margin-left:395px; margin-top:100px;" class="triangulo2"></div>
																			<div id="trian3" style="display:none; position:absolute; margin-left:410px; margin-top:100px;" class="triangulo3"></div>
																			<div id="trian4" style="display:none; position:absolute; margin-left:425px; margin-top:100px;" class="triangulo4"></div>
																			<div id="trian5" style="display:none; position:absolute; margin-left:440px; margin-top:100px;" class="triangulo5"></div>
																			<div id="trian6" style="display:none; position:absolute; margin-left:455px; margin-top:100px;" class="triangulo6"></div>
																			<div id="trian7" style="display:none; position:absolute; margin-left:470px; margin-top:100px;" class="triangulo7"></div>
																			<div id="trian8" style="display:none; position:absolute; margin-left:485px; margin-top:100px;" class="triangulo8"></div>
																			<div id="trian9" style="display:none; position:absolute; margin-left:500px; margin-top:100px;" class="triangulo9"></div>
																			<div id="trian10" style="display:none; position:absolute; margin-left:515px; margin-top:100px;" class="triangulo10"></div>

																		</div>
																	</td>
                                                                </tr>
                                                                <tr>
                                                                <td style="text-align:right; font-weight: bold;"><strong>Passenger Balance Due $</strong></td>
																	<td><input type="text"  class="ama2 txtNumbers form-control" id="balance_due" style=" text-align: right;  font-size: 20px; font-weight:bold; width:103px;" name="balance_due" readonly="readonly"/></td>
                                                                </tr>
                                                            </tbody>
                                                            </table>
                                                            <hr style="margin: 0; padding: 0; ">

                                                            <table class="data table  no-margin" >
                                                            <thead>
                                                                <tr>
                                                                <th class="text-danger"><strong>Agency Payment Information</strong></th>
                                                                <th></th>
                                                                </tr>
                                                            </thead>


                                                            <tbody >
                                                                <tr >
                                                                <td style="text-align:right; font-weight: bold;"> <strong>Total Net Due $</strong></td>
                                                                <td>
                                        <!--<font  class="orangered" style="float: right; height:24px; text-align: right;  border: 1px #33F solid; width: 106px; margin-top:-6px;  margin-right: 6px; font-size:22px;  height:25px; font-weight:bold; color:#fff; " id="totalPagar" ></font>-->
																	<input type="text" id="totalPagar" name="totalPagar" class="orangered txtNumbers form-control" style=" text-align: right;  font-size: 20px; font-weight:bold; width:106px;" value="" readonly="readonly"/>
																	<input name="totP" type="hidden"  id="totP" value="" />
																	<input type="text"  class="orangered" style="display:none; float: left; height:24px; text-align: center;border: #AC1B29 solid thin; font-weight:bold; color:#fff; background-color: #1B1478; height:25px; width: 103px; margin-left: 10px; margin-top:13px; font-size:22px; padding-left:3px;"  id="totalPagarnet" />
																</td>
                                                                </tr >
                                                                <tr id="pay_amount_html" style="display:none;">
                                                                <td style="text-align:right; font-weight: bold;">
																<strong>Amount Pre-Paid $
																</strong>
																</td>
                                                                <td>

                                                                     <input type="button" id="btn_rever_prepaid" name="btn_rever_prepaid" title="Reverse Payment" class="button_sliding_bg form-control" style="display:none; position:absolute; background-color: #8c261a; border-color: lavenderblush; cursor:pointer; color:#fff;  margin-top: -1px; z-index: 1; padding:2.1px; width:17px; height:17px; font-weight: bold; font-size:9px;"  size="20"   value="X" onclick="rever_prepaid();"  />

																<div style="position: absolute; margin-left:-1px; margin-top:1px;">
																	<div id="cir1" style="display:none; position:absolute; margin-left:380px; margin-top:93px;" class="circle1"></div>
																	<div id="cir2" style="display:none; position:absolute; margin-left:395px; margin-top:93px;" class="circle2"></div>
																	<div id="cir3" style="display:none; position:absolute; margin-left:410px; margin-top:93px;" class="circle3"></div>
																	<div id="cir4" style="display:none; position:absolute; margin-left:425px; margin-top:93px;" class="circle4"></div>
																	<div id="cir5" style="display:none; position:absolute; margin-left:440px; margin-top:93px;" class="circle5"></div>
																	<div id="cir6" style="display:none; position:absolute; margin-left:455px; margin-top:93px;" class="circle6"></div>
																	<div id="cir7" style="display:none; position:absolute; margin-left:470px; margin-top:93px;" class="circle7"></div>
																	<div id="cir8" style="display:none; position:absolute; margin-left:485px; margin-top:93px;" class="circle8"></div>
																	<div id="cir9" style="display:none; position:absolute; margin-left:500px; margin-top:93px;" class="circle9"></div>
																	<div id="cir10" style="display:none; position:absolute; margin-left:515px; margin-top:93px;" class="circle10"></div>
																</div>
															<input  type="text" class="azu txtNumbers form-control" name="pay_amount" id="pay_amount" value=""  onKeyUp="CalcularTotalTotal();" readonly="readonly" onclick="valida_pago2(this,'two');"  style=" text-align: right;  font-size: 20px; font-weight:bold; width:106px;" autocomplete="off"  />
																</td>
                                                                </tr>
                                                                <tr style="display:none;">
                                                                <td style="text-align:right; font-weight: bold; "><strong>Total Balance Due $</strong></td>
                                                                <td>
																<input readonly="readonly" autocomplete="off" type="text" class="roge txtNumbers form-control"  name="agency_balance_due" id="agency_balance_due" style=" text-align: right;  font-size: 20px; font-weight:bold; width:106px;"  /></td>
																<input type="text" id="pago_tarjeta" name="pago_tarjeta" title="Pago Tarjeta" value="0.00"  style="display:none; "	class="form-control"  autocomplete="off"  />
																</tr>
                                                            </tbody>

															</table>
															<!--<img class="ventana-imagen-class" style="margin-right:65px; margin-top:-354px; width: 179px; height: 175px; " src="<?php //echo $data['rootUrl']; ?>global/img/admin/ventana.png" />-->


														</div>
                                                  </div>
                                                   <!-- PASSENGER Y AGENCY PAYMENT INFORMATION FIN -->
                                                   <script>
                                                var opc = '<?php echo $opc ?>';
                                                   if(opc){
                                                var datesalida = '<?php echo $fecha_salida; ?>';
                                                var datesalida1 = '<?php echo $fecha_salida2; ?>';
                                                var datesalida2 = '<?php echo $fecha_retorno; ?>';
                                                var pax1 = '<?php echo $opc['pax'] ?>';
                                                var pax2 = '<?php echo $opc['pax2'] ?>';
                                                if (datesalida2 == 'nodate') {
                                                    var fechaini = datesalida1;
                                                }else{
                                                    var fechaini = datesalida;
                                                }
                                                //alert(datesalida2);

                                                $('#fecha_salida').val(fechaini);
                                                $('#fecha_retorno').val(datesalida2);
                                                $('#pax').val(pax1);
                                                $('#pax2').val(pax2);
                                                   }else{
                                                $('#fecha_salida').val();
                                                $('#fecha_retorno').val();
                                                $('#pax').val(1);
                                                $('#pax2').val(0);
                                                $jq("#oneway").prop('checked',true);
                                                   }

                                                </script>

                                                   <div class="animated fadeIn col-lg-3 col-md-3 col-sm-3 col-xs-12"  data-step="27" data-intro="leader pass"  data-position='left'>
                                                        <div class="tile-stats">
                                                        <table class="data table no-margin">

                                                                <th class="text-danger">Form of Payment</th>

                                                            <tbody>
                                                                <tr >
                                                                    <td style=" text-align-last: center;   font-weight:bold; ">
																   <div >
																        <input  type="text"  name="otheramount" id="otheramount"  style="display:none; margin-top: -151px; margin-left: -107px; text-align: center; height: 25px; font-size: 22px; font-weight: bold; color: #fff; border: #AC1B29 solid thin;  width: 103px;float:left;width:106px; font-weight:bold; color:#000;"   value="0.00" onkeyup="ClkPay_Amount();" autocomplete="off"/>

																		<div>
																			<input  style="display:none;" title="Add Payment" class="button_sliding_bg btn btn-success btn-sm btn-block " type="button"  name="pay_driver"  onClick="mostrarVentana2();"  value="Add Payment"/>

																		</div >
                                                                        <!-- <select name="opcion_pago" id="op_pago_id" style="display:none;  " >


                                                                            <optgroup label="COLLECT ON BOARD">
                                                                                <option value="8">Credit Card no fee</option>
                                                                                <option value="3">Credit Card with fee</option>
                                                                                <option value="4">Cash</option>
                                                                                <option value="9">Check</option>
                                                                            </optgroup>
                                                                            <optgroup label="VOUCHER">
                                                                                <option value="5">Credit Voucher</option>
                                                                            </optgroup>
                                                                            <optgroup label="COMPLEMENTARY">
                                                                                <option value="7">Complementary</option>
                                                                            </optgroup>
                                                                        </select>


                                                                        <select name="op_pago_conductor" id="op_pago_conductor"  onclick="valida_voucher();" onchange="captura(); passenger_balance();" >
                                                                            <optgroup label="COLLECT ON BOARD">
                                                                                <option value="8">Credit Card no fee</option>
                                                                                <option value="3">Credit Card with fee</option>
                                                                                <option value="4">Cash</option>
                                                                                <option value="9">Check</option>
                                                                            </optgroup>
                                                                            <optgroup label="VOUCHER">
                                                                                <option value="5">Credit Voucher</option>
                                                                            </optgroup>
                                                                            <optgroup label="COMPLEMENTARY">
                                                                                <option value="7">Complementary</option>
                                                                            </optgroup>
                                                                        </select>

                                                                        </fieldset>

                                                                        <select name="opcion_pago_2" id="op_pago_id2" style="display:none; ">
                                                                            <optgroup label="PRED-PAID">
                                                                                <option value="2">Credit Card no fee</option>
                                                                                <option value="1">Credit Card with fee</option>
                                                                                <option value="6">Cash</option>
                                                                                <option value="10">Check</option>
                                                                            </optgroup>

                                                                        </select> -->

																			 <select class="select2_single form-control" tabindex="-1" name="opcion_pago" id="op_pago_id"   style="display:none; margin-left:387px; margin-top: -241px; width:151px; " >
																					<optgroup label="COLLECT ON BOARD">
																						<option value="8">Credit Card no fee</option>
																						<option value="3">Credit Card with fee</option>
																						<option value="4">Cash</option>
																						<option value="9">Check</option>
																					</optgroup>
																					<optgroup label="VOUCHER">
																						<option value="5">Credit Voucher</option>
																					</optgroup>
																				</select>


																				<select style=" text-align-last: center;   font-weight:bold;  font-size: 12px;"  class="select2_single form-control" tabindex="-1" name="op_pago_conductor" id="op_pago_conductor" onclick="valida_voucher();" onchange="captura(); passenger_balance();" >
																					<optgroup label="COLLECT BY DRIVER">
																						<option style="display:none;" value="8">Credit Card no fee</option>
																						<option  value="3">Credit Card with fee (+4%)</option>
																						<option value="4" >Cash</option>
																						<option value="9" style="display:none">Check</option>
																					<!-- </optgroup>
																					<optgroup label="VOUCHER"> -->

																						<option value="5">Credit Voucher</option>
																					</optgroup>
																				</select>
																				<select  class="select2_single form-control" id="op_pago_id2" tabindex="-1" name="opcion_pago_2"  style="display:none; margin-left:394px; margin-top: -59px; ">
																					<optgroup label="PRED-PAID">
																						<option value="2">Credit Card no fee</option>
																						<option value="1">Credit Card with fee</option>
																						<option value="6">Cash</option>
																						<option value="10">Check</option>
																					</optgroup>

																				</select>


																	</div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>

                                                           </table>
                                                          </div>
                                                        </div >


                                                        <input type="text" name="extra"  id="extra" size="12" class="extracargos" style="float:right; display:none;  text-align: right; color:#000; margin-top: -17px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;" value="0.00" onkeypress="return soloextra(event);" onkeyup="resetextra(); ponDecimales(2);" autocomplete="off" />


                                                  <!-- PAID  Y EXTRACARGOS-->
                                                    <div class="animated fadeIn col-lg-4 col-md-4 col-sm-4 col-xs-4"  id="vent1" data-step="38" data-intro="leader pass"  data-position='left' style="display:none;">
                                                        <div class="tile-stats">
                                                        <table class="data table no-margin">
                                                            <thead>
                                                                <tr data-step="29" data-intro="leader pass"  data-position='left'>
                                                                <th class="text-danger">Paid</th>
                                                                <th >Total Paid $ <input disabled  type="text"  readonly="readonly" style="cursor:no-drop; text-align: right;  font-size: 1em; color:#090; font-weight: bold;  width: 40%; float:right;" value="<?php echo number_format($pagado, 2, '.', ','); ?>"  /></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>

                                                            <!-- <tbody>
                                                                <tr>
                                                                    <td style=" text-align: right;   font-weight:bold; width:140%;">
                                                                    Total Paid $
                                                                    </td>
                                                                    <td style=" text-align: right;    ">
                                                                        <input disabled class="form-control"  type="text"  readonly="readonly" style="text-align: right;  font-size: 20px; color:#090; font-weight: bold;  width: 54%; float:right;" value="<?php echo number_format($pagado, 2, '.', ','); ?>"  />
                                                                    </td>
                                                                </tr>
                                                            </tbody> -->
                                                            <tbody>
                                                                <tr data-step="30" data-intro="leader pass"  data-position='left'>
                                                                    <td style=" text-align: right;   font-weight:bold; ">
                                                                    Amount
                                                                    </td>
                                                                    <td>
																		<input  type="hidden" id="opcion_pago_2">
                                                                        <input disabled type="text"  name="pago_driver" class="form-control" size="12" style="text-align: right;  font-size: 20px; color:#090; font-weight: bold;  width: 142%; float:right;" value="" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago(); ponDecimales(2);" placeholder="$0.00" autocomplete="off" />
																		<input disabled type="text"  name="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
																	    <input disabled type="text"   title="Paid Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
																		<input disabled type="text"  title="Amount Paid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
																		<a disabled style="display:none; margin-right: 320px;" id="pago_agente" ><img style="cursor:pointer; width: 0px; height: 26px; margin-top:83px; margin-right: 9px;" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
																		<a  disabled style="display:none; id="pago_agente1" ><img  src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
																	</td>
                                                                </tr>
                                                            </tbody>
                                                            <tbody>
                                                                <tr data-step="31" data-intro="leader pass"  data-position='left'>
                                                                    <td style=" text-align: right;   font-weight:bold; ">
                                                                         Amount Paid
                                                                    </td>
                                                                    <td style=" text-align-last: center;   font-weight:bold; ">
                                                                        <select disabled class="select2_single form-control" tabindex="-1" >
																			<option style="color:red;" id="" value="0">((( Amount Paid )))</option>
																			<optgroup   label="PRE-PAID">
																				<option value="20">Credit Card NO Fee</option>
																				<option value="21">Credit Card with Fee</option>
																				<option value="22">Cash</option>
																				<option value="23">Check</option>
																			</optgroup>
																			<option style="color:blue;" id="" value="1">((( Paid Driver )))</option>
																			<optgroup   label="COLLECT ON BOARD">
																				<option value="24">Credit Card NO Fee</option>
																				<option value="25">Credit Card with Fee</option>
																				<option value="26">Cash</option>
																				<option value="27">Check</option>
																			</optgroup>
                                                                        </select>


                        <div class="paymentvertblack" style="padding: 5px;  text-align: center; margin-top: 10px; height: 31px;" >

                            <div>
                                <input type="button" class="btn-danger"  name="btnExit" style=" border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" />
                            </div>

                            <div>
                                <input type="button" class="btn-info" name="btnCancelar" style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px;"  size="20"  disabled="true" value="CANCEL"  />
                            </div>

                            <div>
                                <input type="button" name="btnAceptar"  size="20" value="SAVE"  style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; width:68px; height: 24px; font-size:9px; font-weight: bold; margin-left: 98px; margin-top: -24px;"  disabled="true" />
                            </div>
                        </div>


                            </td>
                        </tr>
                    </tbody>
                    </table>
            <table class="oliveti" style="width: 31%; border: 2px solid #000; margin-left: 715px; margin-top: -353px; height: 158px; border-radius: 0px 0px 0px 0px; display:none;">
    <caption class="olivo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius:0px 25px 0px 0px;">Extra Charges & Discounts</caption>


                <td>&nbsp;</td>


                <tr style="width: 700px;" >
                    <td>
                        <label  style=" float:right; font-size:14px; margin-top:-25px; "><strong style="padding-bottom:10px; color: #000;">Discount&nbsp;%</strong></label>
                    </td>

                    <td>
                        <input type="number" name="descuento" id="descuento" class="descuentos"  style="text-align: right; margin-top: -21px;  margin-right: 6px; color:#000; font-size: 22px;font-weight: bold; height:25px; width:80px; border: #33F solid thin; float:right;" maxlength="3"  max="100" min="0" onkeypress="return descuentoporc(event);" onkeyup="desporc();" onchange="desporc();" value="0" autocomplete="off"/>
                    </td>
                </tr>

                <tr style="width: 700px;" >
                    <td>
                        <label  style="float:right; font-size:14px;  margin-top: -2px; "><strong style="padding-bottom:10px; color:#000;">Discount&nbsp;&nbsp;&nbsp;$</strong></label>

                    </td>

                    <td>
                        <input type="text" name="descuento_valor"  id="descuento_valor" class="descuentos"  size="12"  style="float:right; border: 1px #33F solid; text-align: right; margin-top: 7px;  margin-right: 6px;   color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="0.00"  onkeypress="return solodescuento(event);" onkeyup="desval(); ponDecimales(2);" autocomplete="off"  />
                    </td>
                </tr>

                <td>&nbsp;</td>


                <tr  style="width: 700px;">

                    <td style="width: 700px;">
                        <label  style="float:right;  font-size:14px;  margin-top: -23px; width: 125px;"><strong style="padding-bottom:10px; color: #000;">Extra Charges&nbsp;$</strong></label>
                    </td>

                    <td>
                        <!-- <input type="text" name="extra"  id="extra" size="12" class="extracargos" style="float:right;  text-align: right; color:#000; margin-top: -17px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;" value="0.00" onkeypress="return soloextra(event);" onkeyup="resetextra(); ponDecimales(2);" autocomplete="off" />
                        <br /> -->
                    </td>
                </tr>

            </table>
		</div>
  </div>

<!-- PAID2  -->
<div id="miVentana2" class="animated pulse col-lg-4 col-md-4 col-sm-4 col-xs-4" style="display:none">
						<div class="tile-stats">
						<table class="data table no-margin">
							<thead>
								<tr>
								<th class="text-danger">Paid</th>
								<th >Total Paid $ <input id="saldoPagado"  type="text"  readonly="readonly" style="cursor:no-drop; text-align: right;  font-size: 1em; color:#090; font-weight: bold;  width: 38%; float:right;"value="<?php echo number_format($pagado, 2, '.', ','); ?>"  /></th>
									<th></th>
								</tr>
							</thead>


							<!-- <tbody >
								<tr>
									<td style=" text-align: right;   font-weight:bold; width:140%;">
									Total Paid $
									</td>
									<td style=" float: right;   font-weight:bold; ">
										<input id="saldoPagado" class="form-control"  type="text"  readonly="readonly" style="text-align: right;  font-size: 20px; color:#090; font-weight: bold; width: 54%; float:right;" value="<?php echo number_format($pagado, 2, '.', ','); ?>"  />
									</td>
								</tr>
							</tbody> -->
							<tbody>
								<tr>
									<td style=" text-align: right;   font-weight:bold; ">
									Amount
									</td>
									<td id="dolares"  >

										<input type="text" id="pago_driver" class="form-control" name="pago_driver" style="text-align: right;  font-size: 20px; color:#090; font-weight: bold; width: 139%; float:right;" value="" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago(); ponDecimales(2);" placeholder="$0.00" autocomplete="off" />
										<input type="text" id="pago_driver2" name="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
										<input type="text" name="collect" id="collect" title="Paid Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
										<input type="text" name="prepaid" id="prepaid" title="Amount Paid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

									</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td style=" text-align: right;   font-weight:bold; ">
										 Amount Paid
									</td>
									<td>
									<select style=" text-align-last: center;   font-weight:bold; " name="opcion_pago1"  id="op_pago_id1" class="select2_single form-control" disabled= "disabled" onchange="calculos();">

										<option style="color:red;" id="" value="0">((( Amount Paid )))</option>
										<optgroup   label="PRE-PAID">
											<option value="20">Credit Card NO Fee</option>
											<option value="21">Credit Card with Fee</option>
											<option value="22">Cash</option>
											<option value="23">Check</option>
										</optgroup>
										<option style="color:blue;" id="" value="1">((( Paid Driver )))</option>
										<optgroup   label="COLLECT ON BOARD">
											<option value="24">Credit Card NO Fee</option>
											<option value="25">Credit Card with Fee</option>
											<option value="26">Cash</option>
											<option value="27">Check</option>
										</optgroup>


									</select>
                <div class="paymentvertblack" style="padding: 5px;  text-align: center; margin-top: 10px; height: 31px;">

                    <div>
                        <input type="button" class="btn-danger"  id="btnExit" name="btnExit" style="  border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" onclick="Exit();"  />
                    </div>

                    <div>
                        <input type="button" class="btn-info"  id="btnCancelar" name="btnCancelar" style=" background-color: grey; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px;"  size="20"  disabled="true" value="CANCEL" onclick="resetal(); reset2();"  />
                    </div>

                    <div>
                        <input type="button" id="btnAceptar" name="btnAceptar"  size="20" value="SAVE"  style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; width:68px; height: 24px; font-size:9px; font-weight: bold; margin-left: 98px; margin-top: -24px;" onclick="ocultarVentana2();" disabled="true" />
                    </div>

                    <div>
                        <input type="button" id="btnPagolinea" name="btnPagolinea"  size="20" value="MAKE CHARGE"  style=" display:none; border-color: palegreen; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:2px; width:68px; height: 24px; font-weight: bold; margin-right: -100px; margin-top: -24px; font-size:8px;  color:#fff; background-color:#006400;" onclick="" disabled="true" />
                    </div>

                    <div>
                        <input type="button" id="btndecline" name="btndecline"  size="20" value="CANCEL"  style=" display:none; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff; background-color:red;" onclick="declinar();" disabled="true" />
                    </div>

                    <div>
                        <input type="button" id="btncancol" name="btncancol"  size="20" value="CANCEL"  style="display:none; background-color:red; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff;" onclick="Exit_Cob();" disabled="true" />
                    </div>

                    <input type="button" id="enviar_escondido" value="0" style="display:none;" />

                </div>
									</td>
								</tr>
							</tbody>
							</table>

						</div>
				  </div>

				  <!-- PAID2 FIN -->
   <!-- PAID Y EXTRACARGOS FIN -->
						                                  <!-- NOTAS id="notas1"-->

                                <div  id="notas1" class="animated fadeIn col-md-4 col-sm-4 col-xs-12"  data-step="32" data-intro="leader pass"  data-position='left'>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_content">
                                            <div id="alerts"></div>
                                            <div class="clearfix"></div>
														<input id="textpay" name="textpay" type="text" style="display:none;" value="" />

                                                        <div id="" class="col-md-4 col-sm-8 col-xs-12">
                                                            <input type="button" id="btn-addnote"  class="btn btn-flat btn-default  btn-xs btn-block oliverty link-button"  value="+note" style=""/>
                                                        </div>

														<div id="" class="col-md-4 col-sm-8 col-xs-12">
															<input type="button" id="btn-cancel_booking" title="Cancel Booking" class="btn btn-flat btn-danger btn-xs btn-block oliverty"  class="link-button" value="Cancel" onClick="window.location.reload(); cancel_puesto();"/>
														</div>

														<div id="" class="col-md-4 col-sm-8 col-xs-12">
															<input type="button" id="btn-save2" title="Confirm Booking" class="btn btn-flat btn-success btn-xs btn-block oliverty"  class="link-button" value="Save"/>
														</div>
                                                <div id="" class="col-md-12 col-sm-12 col-xs-12" >
                                            <textarea data-step="33" data-intro="leader pass"  data-position='left'    max="5" class="editor-wrapper" placeholder="ADD NOTE" id="comments" name="comments" ></textarea>
                                            </div>
                                                </div>
                                    </div>

                                    <script type="text/javascript">
                                        $('#btn-addnote').click(function(){
                                            $('#comments').focus();
                                        });
                                    </script>
                                </div>

                                     <!-- NOTAS FIN -->
           </div>



                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>


            <!-- end -->
          </div>


          <!-- <footer>
          <div style="text-align: center;">
          <span class="sub-foot">&copy;<?php// echo date('Y');?> SuperTours, Inc. Copyright &copy; 1989 - <?php echo date('Y');?> Supertours Of Orlando, INC . All Rights Reserved.</span>
          </div>
          <div class="clearfix"></div>
        </footer> -->


            </div>
			</div>
		</div>

            <table style = "display:none"><tr><td>

                        <fieldset  id="inputype"  class="passel">
						<legend style="border:1px solid #B83A36; background:#fff;margin-left:5px;display:none;">INPUT TYPE</legend>
                            <!--<legend>INPUT TYPE</legend>-->
                            <div id="opera" class="input">
                                <table width="50%" >
                                    <tr align="left" style="display:none">

                                        <td >
                                            <label style="color:#FFFFFF;"  id="label">CALL CENTER</label>
                                        </td>
                                        <td >
                                            <input style="margin-left:18px; width:275px; border-top-left-radius: 25px; text-align: center; border-top-right-radius: 25px;" name="nombre" type="text"  id="nombre" class="verdefosub" value="<?php echo trim($login->firstname . ' (' . $login->lastname . ')'); ?>" readonly="readonly"/>
                                        </td>

                                    </tr>
                                    <tr><td colspan="2" style="display:none;">
                                            <table width="100%">
                                                <tr>
                                                    <td width="10%">
                                                        <label style="color:#FFFFFF;">AGENCY</label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input name="agency" readonly  onchange="capturar2();" value="<?php echo $login->company_name?>"   type="hidden"  id="agency" class="verdefosub" size="19" te="off"  maxlength="30" autocomplete="off"/>
                                                            <input type="hidden" size="4"  value="<?php echo $login->id?>" name="id_agency" id="id_agency"  autocomplete="off" readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <label style="margin-left:16px; color:#FFFFFF;">Employ</label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input readonly  value="<?php echo $login->firstname?> <?php echo $login->lastname?>"  name="uagency" type="hidden"  id="uagency" class="verdefosub" size="30" maxlength="30"  autocomplete="off"  />
                                                            <input readonly  type="hidden" size="4" value="" name="id_auser" id="id_auser" autocomplete="off" />
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td></tr>

                                    <tr><td colspan="2" >

                                    <select name="uagency1"  style="width:125px; height:25px; display:none;" id="uagency1">
                                                <option value="0"></option>
                                                <?php foreach ($data["user_agencia"] as $ua) { ?>
                                                    <option value="<?php echo $ua["id_agencia"]; ?>"  ><?php echo $ua["nombre"]; ?></option>
                                                <?php } ?>
                                            </select></td></tr>
                                    <tr><td colspan="2" style="display:none;">
                                            <table style="margin-top:6px; margin-right:70px;"align="center" cellspacing="10">
                                                <tr valign="top">
                                                    <td><label  style="color:#FFFFFF;" for="calan_phone"> BY PHONE</label> <input name="canal" type="radio" id="calan_phone" value="PHONE" />  </td>
                                                    <td><label  style="color:#FFFFFF;" for="calan_mail"> BY MAIL</label> <input name="canal" type="radio"  id="calan_mail"  value="MAIL" /> </td>
                                                    <td><label style="color:#FFFFFF;" for="calan_web"> WEBSALE </label><input name="canal" type="radio" id="calan_web" value="WEBSALE" />  </td>
                                                </tr>
                                            </table>
                                        </td></tr>
                                </table>
                            </div>
                        </fieldset>







                       <!-- <fieldset id="liderpax" style="margin-left:488px; margin-top:-129px;" ><legend style="border:1px solid #00C; margin-left:64px; background:#fff;">LEADER PASS</legend>
                            <table>
                                <tr>
                                    <td >
                                        <div id="opera" class="input" style="padding-top:5px;">
                                            <table>
                                                <tr style="display:none;">
                                                    <td>
                                                        <label style="color:#FFFFFF; margin-left:30px;" id="label" >SEARCH </label>
                                                    </td>
                                                    <td>-->
                                                        <div class="ausu-suggest" id="opera">

                                                            <input readonly style="display: none; margin-left:4px; width:354px; border-top-left-radius: 17px;border-top-right-radius: 17px;" type="text" size="35" value="<?php
                                                            if (isset($cliente) && isset($reserva)) {
                                                                if ($cliente->id == $reserva->id_clientes) {
                                                                    echo $cliente->lastname . " " . $cliente->firstname . " - E-Mail -" . $cliente->username;
                                                                }
                                                            }
                                                            ?>" name="leader" id="leader" class="verdefosub" autocomplete="off" onkeyup="reset_point();"/>

                                                            <input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly" />
                                                        </div>
                                                   <!-- </td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td title="">
                                                        <div  class="ausu-suggest" style="margin-top:-5px; margin-left:2px; display:none">
                                                            <a id="newClient" style="cursor:pointer; visibility:hidden;" ><img src="<?php echo $data['rootUrl']; ?>global/img/new.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="opera" class="input" >
                                            <table width="100%" style="display:none;">
                                                <tr>
                                                    <td width="" align="right">-->

                                                        <input type="hidden" name="idCliente"   id="idCliente"  value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo trim($reserva->id_clientes);
                                                            }
                                                        }
                                                        ?>" />


                                                        <input type="hidden" name="idPagador" id="idPagador" value="0"  />
                                                        <input type="hidden" name="idPagador_aux" id="idPagador_aux" value="0"  />
                                                        <input type="hidden" name="cliente_apto" id="cliente_apto" value="0"  />
                                                        <label style="color:#FFFFFF;" id="labeldere12">FIRST NAME</label>
                                                    <!--</td>
                                                    <td width="">
                                                        <input style="margin-left:10px; width:140px;" name="firstname12" type="text"  id="firstname12" class="verdefosub" size="15" maxlength="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->firstname;
                                                            }
                                                        }
                                                        ?>" />
                                                    </td>

                                                    <td width="" align="right">
                                                        <label style="color:#FFFFFF;" id="labeldere12" >LAST NAME </label>
                                                    </td>
                                                    <td width="">
                                                        <input style="margin-left:6px; width:134px;" name="lastname12" type="text"  id="lastname12" class="verdefosub" size="15" maxlength="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->lastname;
                                                            }
                                                        }
                                                        ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right">
                                                        <label style="color:#FFFFFF;" id="labeldere12">E-MAIL </label>
                                                    </td>
                                                    <td>
                                                        <input style="margin-left:10px; margin-top:6px; width:140px; border-bottom-left-radius: 17px;" name="email12" type="text"  id="email12" class="verdefosub" size="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->username;
                                                            }
                                                        }
                                                        ?>"/>
                                                    </td>

                                                    <td align="right">
                                                        <label style="color:#FFFFFF; margin-left:2px;" id="labeldere12">PHONE </label>
                                                    </td>
                                                    <td>
                                                        <input style="margin-top: 6px; margin-left:0px; width:134px; border-bottom-right-radius: 25px;"name="phone12" type="text"  id="phone12" class="verdefosub" size="15" maxlength="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->phone;
                                                            }
                                                        }
                                                        ?>" /> -->
                                                        <input  type="hidden" name="type_cliente"  id="type_cliente" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->tipo_client;
                                                            }
                                                        }
                                                        ?>" />
                                                    <!--</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </fieldset> -->



                    </td>
                  <td>
                  </td>
              </tr>
            </table>

            <fieldset id="boo" class="" style="display: none; background-color:#FFFFFF; width:952px; height: 65px; margin-top: 5px; border-radius: 26%;margin-top: 0%;"  ><legend style="display: none; border:1px solid #00C; background:#fff;">SUPER CLUB</legend>

                <input style="color:#A9A9A9; width:73px; height: 8px; margin-left:0px; padding-top:3px; margin-top: 10px; text-align:center; font-size:10px;"  name="fecha_inicio" type="text" readonly = "readonly" title="Fecha Inicial" id="fecha_inicio" size="10" maxlength="15" value=""  autocomplete="off" />
                <input style="color:#A9A9A9; width:73px; height: 8px; margin-left:43px; padding-top:3px; margin-top: 10px; text-align:center; font-size:10px;"  name="fecha_actual" type="text"  readonly = "readonly" title="Fecha Actual" id="fecha_actual" size="10" maxlength="15" value=""  autocomplete="off" />
                <label style="color:#000; margin-left: 45px; margin-top:10px; font-weight:bold;" id="label">POINTS BALANCE:</label>
<!--                <input type="button" name="points_bal" id="points_bal"  style="cursor:pointer; color: #AC1B29;font-weight: 700; height: 31px; margin-top: 0px; margin-left: 38px; padding: 10px; font-size:10px; width: 118px;" value="POINTS BALANCE" >-->
                <input type="text" id="points_balance" name="points_balance" style="width:38px; margin-left:6px; padding-top:3px; margin-top: 10px; text-align:center; background-color: #fff; color:green; border:2px solid #499bea;"  readonly = "readonly"  size="10" maxlength="15" value="0"  autocomplete="off" />

                <label style="color:#000; margin-left: 9px; margin-top:0px; font-weight:bold;" id="label">POINTS REQUIRED for this trip:</label>
                <input type="text" id="points_required" name="points_required" style="width:38px; margin-left:4px; padding-top:3px; margin-top: 10px; text-align:center; background-color: #fff; color:red; border:2px solid #f02f17;"  readonly = "readonly"  size="10" maxlength="15" value="0"  autocomplete="off" />
                <input type="text" id="free_ticket" name="free_ticket" style="display:none; width:243px; margin-left:24px; padding-top:3px; margin-top: 10px; text-align:center; background-color: #fff; color:green; border:2px solid blue;"  readonly = "readonly"  size="10" maxlength="15" value=" ***** FREE TICKET *****"  autocomplete="off" />


            </fieldset>

            <fieldset id="boo" style="width:952px; height: 65px; margin-top: 5px; border-radius: 26%;margin-top: 0%; display:none" class="booking2" ><legend style="border:1px solid #00C; background:#fff;">BOOKING</legend>
                <input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php
                if (isset($reserva)) {
                    echo $reserva->tipo_ticket;
                }
                ?>"/>
                <!--<div id="opera" class="input" style="padding-top:5px;"> <label  style="color:#00f;" for="oneway"><strong>ONE WAY</strong> </label> <input name="tipo_ticket" onClick="capturar();reset_roundtrip();" id="oneway" type="radio" value="1"  /></div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#AC1B29;" for="roundtrip"><strong>ROUND TRIP</strong> </label><input name="tipo_ticket"  onClick="capturar();"  id="roundtrip" type="radio" value="2"  /> </div>-->



                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#4B0082;" style="padding-right:5px;"><strong>TYPE OF PASS</strong> </label>

                    <div style="display:none;" id="resultado"></div>
                    <div style="display:none;"  id="result"></div>
                    <input type="text" name="selectcond" id="selectcond" value="" style="display:none; position:absolute; margin-left:0px; margin-top:0px;" />
                    <select id="tipo_pass" name="tipo_pass" style="margin-left:12px;" onclick="cargando();residente();" disabled="true"  ><option style="color:red;" value="0" >NO RESIDENT</option><option style="color:blue;"  value="1">RESIDENT</option></select>  </div>
                    <input type="text" name="resident" id="resident" value="0" style="display:none; position:absolute; margin-left:10px; margin-top:34px; width:55px;" />

<!--                 <div id="opera" class="input"  style="padding-top:10px; clear:left;">
                    <label style="width:45px; margin-left:485px; margin-top:-35px;color:#000000;"  ><strong>ADULT</strong></label>
                    <input name="pax" autocomplete="off" type="number" min="0" readonly="readonly" id="pax" size="2" maxlength="2" value="1"  style="border:1px solid #AFAFAF; font-weight: bold;text-align: center; width:40px; margin-top:-37px; color:#AFAFAF;" onchange="
                            var a = document.getElementById('pax').value
                            if (isNaN(a)) {
                                return false;
                            } else {
                                var max = 100 - a;
                                if (max < 0) {
                                    var valor = 100 - $('#pax2').val();
                                    document.getElementById('pax').value = valor;
                                    $('#pax2').attr('max', valor);
                                } else {
                                    $('#pax2').attr('max', max);
                                    if ($('#pax2').val() > max) {
                                        $('#pax2').attr('value', max);
                                    }
                                }
                            }

                           "   />
                </div> -->
<!--                 <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-top:-35px; color:#000000;"  ><strong>CHILD</strong></label>
                    <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" value="0" readonly="readonly" autocomplete="off" style="border:1px solid #AFAFAF; font-weight: bold; text-align: center; width:40px; margin-top:-37px; color:#AFAFAF;" min="0" max="15" onchange="
                            var a = document.getElementById('pax2').value;
                            if (isNaN(a)) {
                                return false;
                            } else {
                                var max = 16 - a;
                                if (max <= 0) {
                                    var valor = 16 - $('#pax').val();
                                    document.getElementById('pax2').value = valor;
                                    $('#pax2').attr('max', valor);
                                } else {
                                    if ($('#pax').val() > max) {
                                        $('#pax').attr('value', max);
                                    }
                                }
                            }"  />
                </div> -->
<!--                 <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-top:-35px; height:45px; color:#000;"  ><strong>TOTAL</strong></label>
                    <input style="font-weight: bold; margin-top:-37px; height: 18px; width: 40px; text-align: center; color:#AFAFAF;" name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/>
                </div> -->
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-left:-4px; margin-top:-35px; color:#000;"  ><strong>INFANT</strong></label>
                    <input name="infat" type="number"  id="infat" size="2" maxlength="2" value="0" min="0" max="16" style="border:1px solid #AFAFAF; font-weight: bold; text-align: center; width:40px; margin-top:-37px;margin-left:4px; color:#AFAFAF;" readonly="readonly" />
                </div>

                <div id="opera" class="input" style="float: left; margin-left:230px; margin-top:-30px; "><input style="margin-top:6px;" name="byr" type="checkbox" value="1" /><label id="labeldere" style="color:#4B0082;"><strong>Customer With Disabilities</strong></label></div>

            </fieldset>

            <!--<fieldset id="onew" style="border-radius: 7%; height:242px; box-shadow: 4px 6px 7px 1px #708090;" class="cerati"><legend style="margin-top:4px; border:1px solid #00C; background:#fff;">ONE WAY</legend>
                <div id="CargaTrip"></div>

                <table style="margin-top:-15px; margin-left:24px;" align="left" cellspacing="0" border="0">

                        <tr>

                            <td>
                               <a href="" id="dataclick1" style="position:absolute; margin-left:-18px; margin-top:4px;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/calendar.png' width='25' height='25'></a>
                            </td>

                            <td >
                                <div id="opera" class="input" style="clear:right;">

                                    <div>
                                        <label style="position:absolute; width:75px; color:#FFFFFF; text-align: left; margin-left:4px; margin-top:18px;"  >DEPARTURE</label>
                                    </div>
                                    <div>
                                        <input style="width:84px;  text-align:center; margin-left:4px; margin-top:37px; height:22px;"  name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value=""  autocomplete="off" />
                                    </div>
                                 </div>
                            </td>


                            <td>
                                <div id="opera" class="input"  >
                                    <div id="explo">  <label style="width:45px; color:#FFFFFF; position: absolute; text-align: left; margin-left:-14px; margin-top:18px;">FROM</label></div>
                                    <div id="explo" align="left" >
                                        <select name="fromt"  style="width:163px; height:26px; margin-left:-14px; margin-top:37px;" id="from">
                                            <option style="width:145px; "value="0"></option>
                                            <?php foreach ($data["areas"] as $e) { ?>
                                                <option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </td>

                            <td>

                                <div id="opera" class="input"  >
                                    <div id="explo">  <label style="width:45px; color:#FFFFFF; position: absolute; margin-left: 14px; margin-top: 18px; text-align: left;"  >TO</label></div>
                                    <div id="explo" align="left">
                                        <select name="to"  id="to" style="width:196px; height:26px; margin-left: 14px; margin-top: 37px;">
                                        </select>
                                        <input type="hidden" name="valto" id="valto" value="<?php
                                        if (isset($reserva)) {
                                            echo $reserva->tot;
                                        }
                                        ?>"/>
                                    </div>
                                </div>

                                <div id="mascaraP" style="display: none;">
                                </div>
                                <div id="popup" style="display: none;">
                                    <div class="content-popup">
                                    </div>

                                </div>
                                <div id="clienteN" style=" display:none; width: 700px; margin-left: 100px;"></div>

                            </td>

                            <td>

                                <div id="opera" class="input">
                                    <div style="width:50px;" id="popup1">

                                        <label style="position:absolute; width:20px; color:#FFFFFF; margin-left: 76px; margin-top: 18px;" >TRIP</label>

                                        <a id="search" onclick="activa_one(); comprobarScreen(); cargando();" title="Search" style="position:absolute; cursor:pointer; color: #fff; margin-left:74px; margin-top:6px;">
                                                <img id="search1" style="display:none;" src ='<?php echo $data['rootUrl'] ?>global/img/search.png' width='25' height='25'></a>

                                        -->
                                        <input type="hidden" id="valorcomision01" name="valorcomision01" value="0" style="" />
                                        <!--
                                    </div>
                                    <div style="width:50px;">
                                        <input name="trip_no" type="text" style="margin-top:38px; height: 22px; width:74px; margin-left: 76px; text-align: center;"  id="trip_no" size="3" maxlength="3" value="<?php
                                        if (isset($reserva)) {
                                            echo $reserva->trip_no;
                                        }
                                        ?>"  readonly="readonly"/>
                                    </div>
                                </div>


                            </td>

                            <td>

                                <div id="opera" class="input">
                                    <div style="width:50px; ">  <label style="position:absolute; width:45px;  margin-left: 89px; margin-top: 17px; color:#FFFFFF;"  >DEP.TIME</label></div>

                                    <input name="departure1" type="text"  id="departure1" size="5" maxlength="8" style=" width:74px; margin-left:89px; height: 23px; margin-top: 36px; text-align: center;" value="<?php
                                    if (isset($reserva)) {
                                        echo date("g:i a", strtotime($reserva->deptime1));
                                    }
                                    ?>" readonly="readonly"/>

                                </div>

                            </td>

                        </tr>



                </table>

                <table align="left" cellspacing="0" border="0">

                <td>
                    <div id="opera" class="input"  style="clear:left; ">
                        <div style="width:265px;">  <label style="width:150px; color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
                        <div style="width:200px;">
                            <div class="ausu-suggest" >
                                <input name="pickup1" type="text"  id="pickup1" style="padding:2px; margin-left:0px; width: 282px;"  onkeyup="resetpickup1();" onchange="changepickup1();" size="40" maxlength="55" value="<?php
                                if (isset($p) && $p != "") {
                                    echo $p->place;
                                }
                                ?>" autocomplete="off"  />
                                <input name="id_p1" type="hidden"  id="id_p1"  size="40" maxlength="55" value="<?php
                                if (isset($p) && $p != "") {
                                    echo $p->id;
                                }
                                ?>" />
                            </div>
                        </div>
                    </div>
                </td>

                <td>
                    <div id="opera" class="input"  >
                        <div style="width:265px;">  <label style="margin-left:8px; width:250px; color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                        <div style="width:210px;">
                            <div class="ausu-suggest" >
                                <input style="padding:2px; margin-left:8px; width: 272px;" name="dropoff1" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php
                                if (isset($drop1) && $drop1 != "") {
                                    echo $drop1->place;
                                }
                                ?>" autocomplete="off" />
                                <input name="id_dropoff1" type="hidden"  id="id_dropoff1" size="40" maxlength="55" value="<?php
                                if (isset($drop1) && $drop1 != "") {
                                    echo $drop1->id;
                                }
                                ?>" />
                            </div>
                        </div>
                    </div>
                </td>

                <td>
                    <div id="opera" class="input" style="margin-left: 16px;">
                        <div style="width:50px;">  <label style="width:45px; padding-left: 3px; color:#FFFFFF;"  >ARR.TIME</label></div>

                        <input name="arrival1" type="text"  id="arrival1" style="height: 22px; margin-left: 2px;  width:73px; text-align: center;" size="5" maxlength="8" value="<?php
                        if (isset($reserva)) {
                            echo date("g:i a", strtotime($reserva->arrtime1));
                        }
                        ?>" readonly="readonly" />

                    </div>
                </td>

                </table>

                <table align="left" cellspacing="0" border="0">

                  <tr>

                    <td>
                        <div>
                            <div id="opera" class="input"> <label style="position:absolute; margin-left:0px; margin-top:5px;  color:#FFFFFF;">EXTENSION AREA:</label></div>
                                <div>
                                    <select name="ext_from1" id="ext_from1" style="width:288px; height:25px; margin-left:10px; height:25px; margin-top:21px;" onchange="change_ext_from1();" >
                                        <option value="0"></option>
                                    </select>
                                </div>
                        </div>

                    </td>

                    <td>

                        <div>
                            <div id="opera" class="input" > <label style=" position:absolute; color:#FFFFFF; margin-left:-5px; margin-top:5px; ">EXTENSION AREA:</label></div>

                            <div>
                                <select name="ext_to1" id="ext_to1" style="width:277px; margin-left:5px; height:25px; margin-top:21px;" onchange="change_ext_to1();">
                                    <option value="0"></option>
                                </select>
                            </div>

                        </div>

                    </td>

                    <td>

                        <div id="opera" class="input" >
                        <div><label style="position:absolute; margin-left: -3px; color:#FFFFFF; margin-top:-19px;"  >ROOM #</label></div>
                        <div>
                            <input name="room1" type="text"  id="room1" size="4" maxlength="6" value="" style=" width:73px; height: 21px; margin-left: -3px; margin-top:1.5px; position: absolute;" />
                        </div>

                    </div>

                    </td>

                 </tr>

                </table>

                <table align="left" cellspacing="0" border="0">

                    <tr>

                        <td>
                            <div id="opera" class="input"  style="clear:left; ">
                                <div><label style="width:250px; color:#FFFFFF; margin-left:0px; margin-top:0px; position:absolute;" >EXTENSION PICK UP POINT/ADDRESS</label></div>
                                <div >
                                    <div class="ausu-suggest">
                                        <input name="exten1" type="text"  id="exten1" style="margin-left:0px; width: 317px; margin-top: 19px;"  size="46" maxlength="55" value=""  autocomplete="off"  />
                                        <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
                                    </div>
                                </div>
                            </div>

                        </td>

                        <td>
                            <div id="opera" class="input" >
                                <div><label style="width:250px; color:#FFFFFF; margin-left: -13px; margin-top:0px; position:absolute;">EXTENSION DROP OFF POINT/ADDRESS</label></div>

                                <div class="ausu-suggest" >
                                    <input name="exten2" type="text"  id="exten2" style=" margin-left: -13px; width:320px; margin-top: 19px;" size="47" maxlength="55" value="" autocomplete="off" />
                                    <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />

                                </div>
                            </div>

                        </td>


                    </tr>

                </table>

            </fieldset>-->

            </div>

            <!--<fieldset id="round"  class="rojillo" style="margin-top:5px; margin-left: 14px; width: 688px; height:252px; border-radius: 7%;  box-shadow: 4px 6px 7px 1px #708090;"><legend style="border:1px solid #B83A36; background:#fff;"><font color="#990000">ROUND TRIP</font></legend>



            <table style="margin-left:28px; margin-top:-1px;" align="left" cellspacing="0" border="0">


                <tr>

                    <td>
                            <a href="" id="dataclick2" style="position:absolute; margin-left:-21px; margin-top: 0px;"><img src ='<?php echo $data['rootUrl'] ?>global/img/calendar2.png' width='25' height='25'></a>

                    </td>

                    <td>
                        <div id="opera" class="input">
                            <div>
                                <label style="width:75px; color:#FFFFFF; margin-left: 0px; margin-top: 8px; position:absolute;"  >DEPARTURE </label>
                            </div>

                            <div style="margin-left:0px; margin-top:0px;">


                                <input style="width:84px; margin-left: 1px; margin-top:28px; height: 22px; text-align:center;"  name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php
                                if (isset($reserva)) {
                                    echo $reserva->fecha_retorno;
                                }
                                ?>"  autocomplete="off" />

                            </div>
                        </div>

                    </td>


                    <td>
                        <div id="opera" class="input"  >
                            <div id="explo">  <label style="width:45px; color:#FFFFFF; margin-left: -13px; margin-top: 7px; position:absolute;"  > FROM</label></div>
                            <div id="explo" align="left">
                                <select name="fromt2"  style="width:162px; height:26px; margin-left: -13px; margin-top: 27px;" id="from2" >
                                    <option value="0"></option>
                                    <?php foreach ($data["areas"] as $e) { ?>
                                        <option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </td>

                    <td>
                        <div id="opera" class="input"  >
                            <div id="explo"><label style="width:45px; color:#FFFFFF; margin-left: 15px; margin-top: 7px; position:absolute;"  > TO</label></div>
                            <div id="explo" align="left">
                                <select name="to2"  id="to2" style="width:196px; height:26px; margin-left: 15px; margin-top: 27px;">
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>

                    </td>

                    <td>

                        <div id="opera" class="input" style="margin-top: -1px;" >
                            <div style="width:50px;" id="popup2"><label style="width:20px; color:#FFFFFF; margin-left: 77px; margin-top: 11px; position:absolute;"  > TRIP</label><a id="search2" onclick="activa_round(); comprobarScreen(); cargando();" title="Search" style="cursor:pointer; color: #fff; position: absolute; margin-left: 76px; margin-top: -2px;"><img id="searchp2" style="display:none;" src ='<?php echo $data['rootUrl'] ?>global/img/search.png' width='25' height='25'></a>
                                <input type="hidden" id="valorcomision02" name="valorcomision02" value="0" />
                            </div>
                            <div style="width:50px;"> <input name="trip_no2" type="text"  id="trip_no2" size="3" maxlength="3" style="height: 23px; width:73.7px; margin-left: 76.9px; margin-top: 30px; text-align: center;" value="<?php
                                if (isset($reserva)) {
                                    echo $reserva->trip_no2;
                                }
                                ?>"  readonly="readonly"/>
                            </div>
                        </div>

                    </td>

                    <td>

                        <div id="opera" class="input"  style="clear:right; ">

                            <div style="width:50px;">  <label style="width:45px; color:#FFFFFF; margin-top: 7px; margin-left: 89px; position:absolute;"> DEP.TIME</label></div>

                            <input name="departure2" type="text"  id="departure2" size="5" maxlength="8" style="height: 23px; width:73px; margin-left:89px; margin-top: 26px; text-align: center;" value="<?php
                            if (isset($reserva)) {
                                echo date("g:i a", strtotime($reserva->deptime2));
                            }
                            ?>" readonly="readonly" />

                        </div>

                    </td>

                </tr>

            </table>

            <table style="margin-left:-82px;" align="left" cellspacing="0" border="0">

                <tr>

                    <td>

                        <div id="opera" class="input"  style="clear:left; margin-left:18px;">
                            <div style="width:265px;">  <label style="width:150px; color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
                            <div style="width:200px;">


                                <div class="ausu-suggest" >
                                    <input name="pickup2" type="text"  id="pickup2" style="padding:2px; margin-left:0px; width: 282px;"  onkeyup="resetpickup2();" onchange="changepickup2();" size="40" maxlength="55" value="<?php
                                    if (isset($pickup2) && $pickup2 != "") {
                                        echo $pickup2->place;
                                    }
                                    ?>" autocomplete="off"  />
                                    <input name="id_pickup2" type="hidden"  id="id_pickup2"  size="40" maxlength="55" value="<?php
                                    if (isset($pickup2) && $pickup2 != "") {
                                        echo $pickup2->id;
                                    }
                                    ?>" />
                                </div>
                            </div>
                        </div>

                    </td>
                    <td>
                        <div id="opera" class="input"  >
                            <div style="width:265px;">  <label style="margin-left:7px; width:250px; color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                            <div style="width:210px;">
                                <div class="ausu-suggest" >
                                    <input style="margin-left:6px; width:273px; margin-top: 0px;" name="dpoff2" type="text"  id="dropoff2" size="39" maxlength="55" value="<?php
                                    if (isset($drop2) && $drop2 != "") {
                                        echo $drop2->place;
                                    }
                                    ?>" autocomplete="off"  />
                                    <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php
                                    if (isset($drop2) && $drop2 != "") {
                                        echo $drop2->id;
                                    }
                                    ?>" />
                                </div>
                            </div>
                        </div>
                    </td>
                    </td>
                        <div id="opera" class="input" style="margin-left: 16px;" >
                            <div style="width:50px;"><label style="position:absolute; width:45px; margin-left:579px; color:#FFFFFF;"  >ARR.TIME</label></div>
                            <div style="width:50px;">
                                <input name="arrival2" type="text"  id="arrival2" style="height: 22px; margin-left: 578px; margin-top: 21px; width:72px; text-align: center;" size="5" maxlength="8" value="<?php
                                if (isset($reserva)) {
                                    echo date("g:i a", strtotime($reserva->arrtime2));
                                }
                                ?>" readonly="readonly"/>
                            </div>
                        </div>
                    </td>

                </tr>

            </table>

            <table style="margin-left:0px;" align="left" cellspacing="0" border="0">

                <tr>
                    <td>
                        <div>
                            <div id="opera" class="input"><label style="position:absolute; margin-left:2px; margin-top: 2px; color:#FFFFFF;">EXTENSION AREA:</label></div>
                            <div>
                                <select name="ext_from2" id="ext_from2" style="width:286px; margin-left:12px; height:25px; margin-top:19px;" onchange ="change_ext_from2();">
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div id="opera" class="input" ><label style="position:absolute; color:#FFFFFF; margin-left:-5px; margin-top:2px;">EXTENSION AREA:</label></div>
                            <div>
                                <select name="ext_to2" id="ext_to2" style="width:279px; margin-left:5px; height:25px; margin-top:19px;" onchange="change_ext_to2();">
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div id="opera" class="input" ><label style="position:absolute; width:48px; color:#FFFFFF; margin-top: 4px; margin-left: -3px;">ROOM #</label>
                            <input name="room2" type="text"  id="room2" size="4" maxlength="6" value="" style=" width:73px; margin-top: 24px; height: 21px; margin-left: -3px;"/>
                        </div>
                    </td>

                </tr>

            </table>

            <table style="margin-left:0px;" align="left" cellspacing="0" border="0">

                <tr>

                  <td>
                    <div id="opera" class="input">
                        <div style="width:300px;">  <label style="position:absolute; margin-left:2px; width:250px; color:#FFFFFF;"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
                        <div style="width:200px;">
                            <div class="ausu-suggest" >
                                <input type="text" name="exten3" id="exten3" style="margin-left:1px; width: 318px; margin-top:21px;" size="46" maxlength="55" value="" autocomplete="off" />
                                <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
                            </div>
                        </div>
                    </div>

                  </td>
                  <td>
                    <div id="opera" class="input" >
                        <div style="width:265px;"><label style="position:absolute; width:250px; color:#FFFFFF; margin-left: 10px;"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                        <div style="width:200px;">
                            <div class="ausu-suggest" >
                                <input name="exten4" type="text"  id="exten4" size="47" maxlength="55" value=""  style="margin-left: 11px; margin-top:21px; width:319px;" autocomplete="off" />
                                <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value=""  />
                            </div>
                        </div>
                    </div>
                  </td>

                </tr>

            </table>
            </fieldset> -->











            <!--<table class="" border="1" width="256" height="205" cellspacing="0" class="sup2" style="width: 260px; background-color:#FFFFFF; margin-top: 6px; margin-left: 731px; position: absolute; box-shadow: 0 -1px 20px #1E9196;">
                <tr class="blackblue">
                    <td width="136" style="text-align:center; color:#fff; font-size: 14px; font-weight:bold;" ><label><strong>QUOTE</strong></label></td>
                    <td width="54"  style="text-align:center; font-size: 14px; font-weight:bold;"><label style="color:#fff;"><strong>ADULT</strong></label></td>
                    <td width="48"  style="text-align:center; font-size: 14px; font-weight:bold;"><label style="color:#fff;"><strong>CHILD</strong></label></td>
                </tr>

                <tr>
                    <td><label style="font-size: 14px; font-weight:bold; float:right; color:#4B0082;"><strong>Line Transportation&nbsp;</strong></label></td>
                    <td style="text-align:center; color:blue;"><span name ="transporadult" id="transporadult"  value="0"  style="font-size: 15px; font-weight:bold; " ></span></td>
                <input type="hidden" name ="transadult" id="transadult" value="0" />

                <input type="hidden" name ="transchild" id="transchild" value="0"/>


                <td style="text-align:center; color:blue;"><span name ="transporechil" id="transporechil" value="0" style="font-size: 15px; font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td><label style="float:right; color:#4B0082; font-size: 14px; font-weight:bold; "><strong>Extensions&nbsp;</strong></label></td>
                    <td style="text-align:center; color:red;"><span id="extenadult" style="font-size: 15px;font-weight:bold; "></span></td>
                    <td style="text-align:center; color:red;"><span id="extenchil" style="font-size: 15px;font-weight:bold; "></span></td>
                </tr>


                <tr>
                    <td><label style="float:right; color:#4B0082; font-size: 14px; font-weight:bold; "><strong>Sub-total per Pax&nbsp;</strong></label></td>
                    <td style="text-align:center; color:#4B0082;"><span id="subtoadult" style="font-size: 15px; font-weight:bold; "></span></td>
                    <td style="text-align:center; color:#4B0082;"><span id="subtochild" style="font-size: 15px; font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td  style="float:center; text-align: center; color:#4B0082; font-size: 16px; font-weight:bold;"><label><strong>TOTAL</strong></label></td>
                    <td style="text-align:center;" colspan="2"><label style="color:#4B0082; font-size: 18px; font-weight:bold;">$<strong id="totaltotal" style="font-size: 18px; font-weight:bold; ">$ 00.0</strong></label></td>
                    -->

                <div id="enviarDatos"></div>

                <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="0" />
                <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="0" />

                <!--Standard Price Trip No 1-->
                <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" value="0" />
                <input size="5" type="hidden" id="subtochild1" name="subtochild1" value="0" />

                <!--SuperFlex Trip No1-->
                <input size="5" type="hidden" id="subtoadult22" name="subtoadult22" value="0" />
                <input size="5" type="hidden" id="subtochild22" name="subtochild22" value="0" />

                <!--Web Fare Trip No1-->
                <input size="5" type="hidden" id="subtoadultwf1" name="subtoadultwf1" value="0" />
                <input size="5" type="hidden" id="subtochildwf1" name="subtochildwf1" value="0" />

                <!--Super Promo Trip No1-->
                <input size="5" type="hidden" id="subtoadultsp1" name="subtoadultsp1" value="0" />
                <input size="5" type="hidden" id="subtochildsp1" name="subtochildsp1" value="0" />

                <!--Super Discount Trip No1-->
                <input size="5" type="hidden" id="subtoadultsd1" name="subtoadultsd1" value="0" />
                <input size="5" type="hidden" id="subtochildsd1" name="subtochildsd1" value="0" />

                <input size="5" type="hidden" id="price1" name="price1" value="0" />
                <input size="5" type="hidden" id="price2" name="price2" value="0" />

                <!--Standard Price Trip No 2-->
                <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" value="0" />
                <input size="5" type="hidden" id="subtochild2" name="subtochild2" value="0" />


                <!--SuperFlex Trip No2-->
                <input size="5" type="hidden" id="subtoadult4" name="subtoadult4" value="0" />
                <input size="5" type="hidden" id="subtochild4" name="subtochild4" value="0" />

                <!--Web Fare Trip No2-->
                <input size="5" type="hidden" id="subtoadultwf2" name="subtoadultwf2" value="0" />
                <input size="5" type="hidden" id="subtochildwf2" name="subtochildwf2" value="0" />

                <!--Super Promo Trip No2-->
                <input size="5" type="hidden" id="subtoadultsp2" name="subtoadultsp2" value="0" />
                <input size="5" type="hidden" id="subtochildsp2" name="subtochildsp2" value="0" />

                <!--Super Discount Trip No2-->
                <input size="5" type="hidden" id="subtoadultsd2" name="subtoadultsd2" value="0" />
                <input size="5" type="hidden" id="subtochildsd2" name="subtochildsd2" value="0" />


                <!--Equipment & Seats-->

<!--                <input size="5" type="hidden" id="subtoadult33" name="subtoadult33" value="0" />-->
<!--<input size="5" type="hidden" id="subtochild33" name="subtochild33" value="0" />-->


                <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="0"  />
                <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="0" />
                </tr>


            <!-- </table>     -->


           <!-- <fieldset id="pymen" style="display:none; margin-top:17px; border-radius: 5%; height:382px; box-shadow: rgb(112, 128, 144) 4px 6px 7px 1px;" class="supert" >
			<legend style="border:1px solid #00C; background:#fff" >PAYMENT INFORMATIONS</legend>
                <input type="hidden" name="totalcom" id="totalcom" value="0">

                <tr><td style="border: 0px solid #000;">

                        <div id="opera" class="input" style="padding-top:5px; width:450px;">
                            <table width="100%" height="125" id="tableorder" style="display:none;">
                                <tr>
                                    <td  colspan="3" width="34%" height="20" align="center"  >
                                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                        <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                            <tr>
                                                <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION </strong>
                                                </td>
                                            </tr>

                                            <tr>

                                                <td width="2%">
                                                    <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio">
                                                </td>
                                                <td width="20%">Paid Full</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"  checked="checked"></td>
                                                <td width="20%">Paid Balance</td>

                                            <tr>
                                            <tr><td colspan="6"><hr /></td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
                                </tr>
                                <tr>
                                    <td valign="top"  >
                                        <table style="width:160px;">
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>

                                            <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_passager_3" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_passager_4" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_check"  value="10" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_check" for="opcion_pago_predpaid_check" class="">Check</label></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="top" >
                                        <table style="width:160px;">

                                            <tr id="tipo_passager_2" style="">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager_2"  value="8" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager_2" for="opcion_pago_passager_2" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_CrediFee">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio" class="opcion_pago"></td>
                                                <td align="left"  nowrap="nowrap" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_Cash">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_Cash_2">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash_2" value="9" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash_2" class="opcion_pago">Check</label></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="left" valign="top" >
                                        <div id="tipo_Voucher" style="display:none">
                                            <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                        </div>
                                    </td>
                                </tr>

                            </table>


                        </div>

                        <div id="opera" class="input" style="width: 80%;" >

                            <input type="text" id="bal_duep" name="bal_duep"    value="0.00"  style="display:none; border: 1px #33F solid; margin-top: -58px;  margin-right: -123px; text-align: right; height: 25px; font-size: 22px; width:106px;" autocomplete="off" />
                            <table class="oliveti" style="width: 49%; border: 2px solid #000; margin-left: -8px; margin-top: -9px; height: 155px;">
                                <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius: 25px 0px 0px 0px;">Passenger Payment Information</caption>


                                <tr style="display:none;">
                                    <td>
                                        <label  style="padding-left:20px; font-size:12px; "><strong style="padding-bottom:0px; color:#090;">Total Amount Paid $</strong></label>

                                    </td>
                                    <td>
                                        <label id="saldoPagado" >$  </label>
                                        <br />
                                    </td>
                                </tr>
                                <td>&nbsp;</td>


                                <tr  style=" height:13px; width:180px;">

                                    <td style="width: 700px;">
                                        <label  style=" margin-left:76px; font-size:16px; margin-top:-39px;"><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#F00">Amount to Collect&nbsp;$</strong></label>
                                    </td>
                                    <td>

                                        <input type="text"  class="verd"   id="saldoporpagar" value="" style=" border: 1px #33F solid; margin-top: -37px; margin-right: 6px; text-align: right; height: 25px; font-family: sans-serif; font-size: 22px; font-weight:bold; width:106px;" onKeyUp="dupliac();ponDecimales(2);" onkeypress="return soloNumeros(event);" autocomplete="off" />


                                        <br />
                                    </td>
                                </tr>
                                <td>&nbsp;</td>


                                <tr style="width: 700px;" ><td>
                                        <label  style=" margin-left:137px; font-size:16px; margin-top:-53px; "><strong style="padding-bottom:10px; color: #000;">Paid Driver&nbsp;$</strong></label>    </td>
                                        <input type="button" id="btn_rever_cob" name="btn_rever_cob" title="Reverse Payment" class="button_sliding_bg" style="display:none; position:absolute; background-color: #8c261a; border-color: lavenderblush; cursor:pointer; color:#fff; margin-left: -517px; margin-top: 72px; padding:2.1px; padding-left:3px; width:17px; height:17px; font-weight: bold; font-size:9px;"  size="20"   value="X" onclick="rever_collect_on_board();"  />
                                    <td>
                                        <input type="text" id="paid_driver" name="paid_driver" class="brown3" readonly="readonly" autocomplete="off"    style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #000; border: #33F solid thin; margin-top: -52px; margin-right: 6px; text-align: right; width:106px; font-weight:bold; color:fff;" value="" onKeyUp="CalcularTotalTotal();" onclick="valida_pago(this,'one');" />

                                    </td>

                                    <div style="position:absolute; margin-left:-2px; margin-top:0px;">

                                        <div id="trian1" style="display:none; position:absolute; margin-left:380px; margin-top:100px;" class="triangulo1"></div>
                                        <div id="trian2" style="display:none; position:absolute; margin-left:395px; margin-top:100px;" class="triangulo2"></div>
                                        <div id="trian3" style="display:none; position:absolute; margin-left:410px; margin-top:100px;" class="triangulo3"></div>
                                        <div id="trian4" style="display:none; position:absolute; margin-left:425px; margin-top:100px;" class="triangulo4"></div>
                                        <div id="trian5" style="display:none; position:absolute; margin-left:440px; margin-top:100px;" class="triangulo5"></div>
                                        <div id="trian6" style="display:none; position:absolute; margin-left:455px; margin-top:100px;" class="triangulo6"></div>
                                        <div id="trian7" style="display:none; position:absolute; margin-left:470px; margin-top:100px;" class="triangulo7"></div>
                                        <div id="trian8" style="display:none; position:absolute; margin-left:485px; margin-top:100px;" class="triangulo8"></div>
                                        <div id="trian9" style="display:none; position:absolute; margin-left:500px; margin-top:100px;" class="triangulo9"></div>
                                        <div id="trian10" style="display:none; position:absolute; margin-left:515px; margin-top:100px;" class="triangulo10"></div>

                                    </div>
                                </tr>



                                <tr style="width: 700px;" >
                                    <td>
                                        <label  style=" margin-left:27px; font-size:16px;  margin-top: -30px; "><strong style="padding-bottom:10px; color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                                    </td>

                                    <td>
                                        <input type="text" id="balance_due" name="balance_due" class="ama2"  class="txtNumbers"  value="" readonly="readonly" style="border: 1px #33F solid; margin-top: -29px;  margin-right: 6px; text-align: right; height: 25px; font-size: 22px; font-weight:bold; width:106px;" autocomplete="off" />

                                    </td>
                                </tr>


                            </table>

                            <table class="oliveti" style="width: 49%; border: 2px solid #000; margin-left: -8px; margin-top: -115px; height: 155px; ">

                                <caption class="cerati" style="  font-weight:bold; font-size:16px; color:#fff;">Agency Payment Information</caption>

                                <tr>
                                    <td>
                                        <label  style=" float:right; padding-left: 100px; font-size:16px;  margin-top: -16px;"><strong style=" color:#000;">Total Net Fare&nbsp;$</strong></label>

                                    </td>
                                    <td>
                                        <input type="text" id="totalPagar" name="totalPagar" class="orangered" class="txtNumbers" style="float: right; height:24px; text-align: right;  border: 1px #33F solid; width: 106px; margin-top:-6px;  margin-right: 6px; font-size:22px;  height:25px; font-weight:bold; color:#fff;" value="" readonly="readonly"/>
                                        <input name="totP" type="hidden"  id="totP" value="" />
                                        <input type="text"  class="orangered" style="display:none; float: left; height:24px; text-align: center;border: #AC1B29 solid thin; font-weight:bold; color:#fff; background-color: #1B1478; height:25px; width: 103px; margin-left: 10px; margin-top:13px; font-size:22px; padding-left:3px;"  id="totalPagarnet" />

                                    </td>
                                </tr>
                                <tr id="pay_amount_html" style="height: 50px;">
                                    <td>
                                        <b style="float:right; color:#000;font-size: 18px;">Amount Pre-Paid&nbsp;$</b>
                                        <input type="button" id="btn_rever_prepaid" name="btn_rever_prepaid" title="Reverse Payment" class="button_sliding_bg" style="display:none; position:absolute; background-color: #8c261a; border-color: lavenderblush; cursor:pointer; color:#fff; margin-left: 171px; margin-top: -1px; z-index: 1; padding:2.1px; width:17px; height:17px; font-weight: bold; font-size:9px;"  size="20"   value="X" onclick="rever_prepaid();"  />

                                    </td>

                                <div style="position: absolute; margin-left:-1px; margin-top:1px;">

                                    <div id="cir1" style="display:none; position:absolute; margin-left:380px; margin-top:93px;" class="circle1"></div>
                                    <div id="cir2" style="display:none; position:absolute; margin-left:395px; margin-top:93px;" class="circle2"></div>
                                    <div id="cir3" style="display:none; position:absolute; margin-left:410px; margin-top:93px;" class="circle3"></div>
                                    <div id="cir4" style="display:none; position:absolute; margin-left:425px; margin-top:93px;" class="circle4"></div>
                                    <div id="cir5" style="display:none; position:absolute; margin-left:440px; margin-top:93px;" class="circle5"></div>
                                    <div id="cir6" style="display:none; position:absolute; margin-left:455px; margin-top:93px;" class="circle6"></div>
                                    <div id="cir7" style="display:none; position:absolute; margin-left:470px; margin-top:93px;" class="circle7"></div>
                                    <div id="cir8" style="display:none; position:absolute; margin-left:485px; margin-top:93px;" class="circle8"></div>
                                    <div id="cir9" style="display:none; position:absolute; margin-left:500px; margin-top:93px;" class="circle9"></div>
                                    <div id="cir10" style="display:none; position:absolute; margin-left:515px; margin-top:93px;" class="circle10"></div>

                                </div>
                                    <td>
                                        <input  type="text" class="azu" class="txtNumbers" name="pay_amount" id="pay_amount" value=""  onKeyUp="CalcularTotalTotal();" readonly="readonly" onclick="valida_pago2(this,'two');" style="position:absolute; text-align: right; z-index: 0; position: absolute;  border: 1px #33F solid; margin-top: -17px;  margin-left: -114px; width: 106px; height:25px; font-size:22px; font-weight:bold;" autocomplete="off"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b style="float:right; "><strong style="color:#000;font-size: 18px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>
                                    </td>
                                    <td>
                                        <input readonly="readonly" autocomplete="off" type="text" class="roge"  class="txtNumbers"  name="agency_balance_due" id="agency_balance_due" value=""  style="text-align: right; border: 1px #33F solid; margin-right: 6px; margin-top:-7px; height: 25px; font-size: 22px; font-weight:bold; width:106px;" />
                                    </td>
                                     <input type="text" id="pago_tarjeta" name="pago_tarjeta" title="Pago Tarjeta" value="0.00"  style="display:none; position:absolute;  border: 1px #FFF solid; margin-top: 67.2px;  margin-left: 377px; width: 68px; height:12px; text-align:right; font-size: 14px; padding-top:2px; background-color: transparent; color:#fff;"  autocomplete="off"  />

                                </tr>
                                <a style="display:none; margin-right: 320px;" id="pago_agente" ><img style="cursor:pointer; width: 0px; height: 26px; margin-top:83px; margin-right: 9px;" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                <a style=" margin-right: 320px;" id="pago_agente1" ><img style="width: 0px; height: 26px; margin-top:83px; margin-right: -162px;" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>

                            </table>


                            <img class="ventana-imagen-class" style="margin-right:65px; margin-top:-354px; width: 179px; height: 175px; " src="<?php echo $data['rootUrl']; ?>global/img/admin/ventana.png" />

<table width="100%" style="position:absolute; background-color: transparent; margin-top: -351px;; margin-left:534px; height:173px; width:176px;">

    <tr>
        <td style="margin-left:1px; margin-top:0px;">

            <div id="miVentana2" style="position: absolute; width: 174px; height: 170px;  top:-2px; left: -2px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;"  >

                <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 2px; background-color:#006394">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

                <p>
                    <label  id="tap" style="padding-left:57px; font-size:10px; "><strong style="position:absolute; padding-bottom:10px; color:#090; margin-left:-48px; margin-top:-2px;">Total Amount Paid $</strong></label>
                    <input type="text" id="saldoPagado"  readonly="readonly" style="text-align: right; font-family: sans-serif; font-size: 10px; color:#090; font-weight: bold; padding-left:6px; margin-right: 6px; margin-top: 1px; width: 32px; height: 12px;" value="<?php echo number_format($pagado, 2, '.', ','); ?>"  />
                </p>

                <label  id="dolares" style="padding-left:57px; font-size:16px; "><strong style="position:absolute; margin-top: -3px; padding-bottom:10px; color:#006394; margin-left:-19px;">$</strong></label>

                <input type="text" id="pago_driver" name="pago_driver" size="12" style="font-size: 22px; font-weight:bold; text-align:right; margin-top:-20px; margin-right:6px; width:114px; height:20px;" value="" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago(); ponDecimales(2);" placeholder="0.00" autocomplete="off" />

                <input type="text" id="pago_driver2" name="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />


                <input type="text" name="collect" id="collect" title="Paid Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

                <input type="text" name="prepaid" id="prepaid" title="Amount Paid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />


                <select name="opcion_pago1" id="op_pago_id1" style="margin-right: 6px; margin-top: 8px;" disabled= "disabled" onchange="calculos();">

                    <option style="color:red;" id="" value="0">((( Amount Paid )))</option>
                    <optgroup   label="PRE-PAID">
                        <option value="20">Credit Card NO Fee</option>
                        <option value="21">Credit Card with Fee</option>
                        <option value="22">Cash</option>
                        <option value="23">Check</option>
                    </optgroup>
                    <option style="color:blue;" id="" value="1">((( Paid Driver )))</option>
                    <optgroup   label="COLLECT ON BOARD">
                        <option value="24">Credit Card NO Fee</option>
                        <option value="25">Credit Card with Fee</option>
                        <option value="26">Cash</option>
                        <option value="27">Check</option>
                    </optgroup>


                </select>


                <div class="paymentvertblack" style="padding: 5px;  text-align: center; margin-top: 10px; height: 31px;">

                    <div>
                        <input type="button" id="btnExit" name="btnExit" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" onclick="Exit();"  />
                    </div>

                    <div>
                        <input type="button" id="btnCancelar" name="btnCancelar" style=" background-color: grey; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px;"  size="20"  disabled="true" value="CANCEL" onclick="resetal(); reset2();"  />
                    </div>

                    <div>
                        <input type="button" id="btnAceptar" name="btnAceptar"  size="20" value="SAVE"  style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; width:68px; height: 24px; font-size:9px; font-weight: bold; margin-left: 98px; margin-top: -24px;" onclick="ocultarVentana2();" disabled="true" />
                    </div>

                    <div>
                        <input type="button" id="btnPagolinea" name="btnPagolinea"  size="20" value="MAKE CHARGE"  style=" display:none; border-color: palegreen; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:2px; width:68px; height: 24px; font-weight: bold; margin-right: -100px; margin-top: -24px; font-size:8px;  color:#fff; background-color:#006400;" onclick="" disabled="true" />
                    </div>

                    <div>
                        <input type="button" id="btndecline" name="btndecline"  size="20" value="CANCEL"  style=" display:none; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff; background-color:red;" onclick="declinar();" disabled="true" />
                    </div>

                    <div>
                        <input type="button" id="btncancol" name="btncancol"  size="20" value="CANCEL"  style="display:none; background-color:red; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff;" onclick="Exit_Cob();" disabled="true" />
                    </div>

                    <input type="button" id="enviar_escondido" value="0" style="display:none;" />

                </div>


            </div>

         </td>

    </tr>

</table>

<table class="oliveti" style="width: 31%; border: 2px solid #000; margin-left: 715px; margin-top: -353px; height: 158px; border-radius: 0px 0px 0px 0px; display:none;">


    <caption class="olivo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius:0px 25px 0px 0px;">Extra Charges & Discounts</caption>


                <td>&nbsp;</td>


                <tr style="width: 700px;" >
                    <td>
                        <label  style=" float:right; font-size:14px; margin-top:-25px; "><strong style="padding-bottom:10px; color: #000;">Discount&nbsp;%</strong></label>
                    </td>

                    <td>
                        <input type="number" name="descuento" id="descuento" class="descuentos"  style="text-align: right; margin-top: -21px;  margin-right: 6px; color:#000; font-size: 22px;font-weight: bold; height:25px; width:80px; border: #33F solid thin; float:right;" maxlength="3"  max="100" min="0" onkeypress="return descuentoporc(event);" onkeyup="desporc();" onchange="desporc();" value="0" autocomplete="off"/>
                    </td>
                </tr>

                <tr style="width: 700px;" >
                    <td>
                        <label  style="float:right; font-size:14px;  margin-top: -2px; "><strong style="padding-bottom:10px; color:#000;">Discount&nbsp;&nbsp;&nbsp;$</strong></label>

                    </td>

                    <td>
                        <input type="text" name="descuento_valor"  id="descuento_valor" class="descuentos"  size="12"  style="float:right; border: 1px #33F solid; text-align: right; margin-top: 7px;  margin-right: 6px;   color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="0.00"  onkeypress="return solodescuento(event);" onkeyup="desval(); ponDecimales(2);" autocomplete="off"  />
                    </td>
                </tr>

                <td>&nbsp;</td>


                <tr  style="width: 700px;">

                    <td style="width: 700px;">
                        <label  style="float:right;  font-size:14px;  margin-top: -23px; width: 125px;"><strong style="padding-bottom:10px; color: #000;">Extra Charges&nbsp;$</strong></label>
                    </td>

                    <td>
                        <input type="text" name="extra"  id="extra" size="12" class="extracargos" style="float:right;  text-align: right; color:#000; margin-top: -17px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;" value="0.00" onkeypress="return soloextra(event);" onkeyup="resetextra(); ponDecimales(2);" autocomplete="off" />
                        <br />
                    </td>
                </tr>

            </table>

        </div>


        <div style="margin-left:541px; margin-top:-109px;">

            <ul class="tabs" style=" width:94%; cursor:default;">

                <li style="cursor:default;"><a href="#tab1">Add Notes</a></li>

            </ul>

            <div class="tab_container" style="height:142px; width: 420px;">
                <div id="tab1" class="tab_content">

                    <textarea id="comments" name="comments" cols="0" rows="0" style="border-color:red; margin: 13px; width: 406px; height:127px; margin-top:-15px; margin-left:-16px;"></textarea>



                </div>
            </div>

        </div>

        <div id="" style="display:none; margin-top:291px; margin-left:803px;">
            <input type="button" id="btn-cancel_booking" style="margin-left: -101px; cursor: pointer;" class="oliverty"  value="Cancel Booking" onClick="window.location.reload()">
        </div>


        <li class="btn-toolbar" id="btn-save2">


            <input id="textpay" name="textpay" type="text" style="display:none;" value="" />


            <div id="" style="margin-top:291px; margin-left:833px;">
                <input type="button" id="btn-save2" title="Save" class="oliverty" class="link-button" value="Confirm Booking"/>
            </div>


        </li>

        <input type="text"  name="otheramount"  id="otheramount"  style="display:none; margin-top: -151px; margin-left: -107px; text-align: center; height: 25px; font-size: 22px; font-weight: bold; color: #fff; border: #AC1B29 solid thin;  width: 103px;float:left;width:106px; font-weight:bold; color:#000;"   value="0.00" onkeyup="ClkPay_Amount();" autocomplete="off"/>



        <div>
            <input  title="Add Payment" class="button_sliding_bg" type="button" id="pay_driver" name="pay_driver"  onClick="mostrarVentana2();"  style="border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px; margin-left: 387px; margin-top: -276px; height: 26px; cursor:pointer; color: #fff; font-weight: 700; width: 151px;  padding: 3px; padding-left: 4px;" value="Add Payment"/>

        </div>

        <select name="opcion_pago" id="op_pago_id" style="display:none; margin-left:387px; margin-top: -241px; width:151px; " >
            <optgroup label="COLLECT ON BOARD">
                <option value="8">Credit Card no fee</option>
                <option value="3">Credit Card with fee</option>
                <option value="4">Cash</option>
                <option value="9">Check</option>
            </optgroup>
            <optgroup label="VOUCHER">
                <option value="5">Credit Voucher</option>
            </optgroup>
            <optgroup label="COMPLEMENTARY">
                <option value="7">Complementary</option>
            </optgroup>
        </select>


        <select name="op_pago_conductor" id="op_pago_conductor" style=" margin-left:387px; margin-top: -221px; width:151px;" onclick="valida_voucher();" onchange="captura(); passenger_balance();" >
            <optgroup label="COLLECT ON BOARD">
                <option value="8">Credit Card no fee</option>
                <option value="3">Credit Card with fee</option>
                <option value="4">Cash</option>
                <option value="9">Check</option>
            </optgroup>
            <optgroup label="VOUCHER">
                <option value="5">Credit Voucher</option>
            </optgroup>
            <optgroup label="COMPLEMENTARY">
                <option value="7">Complementary</option>
            </optgroup>
        </select>

        </fieldset> -->
        </div>

    </div>


    <input id="opc_ap" name="opc_ap" type="text"  size="12" style="display:none;" value="" />
    <input id="prueba" name="prueba" type="text" style="display:none;" value=""/>
    <input id="PAP" name="PAP"  type="text"  size="12" style="display:none;" value="0.00" />


    <div>

        <input  title="Confirm Booking" class="oliveti"   type="button" id="btn-save2" class="link-button"  style="display:none; border-color: brown; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;  margin-left: -582px; margin-top:786px; height: 30px; cursor:pointer; color: #000;font-weight: 700; width:124px; padding: 6px; padding-left: 4px;" value="Confirm Booking"/>

    </div>


    <div id="userr"></div>
    <div id="puestosEnUso"></div>

    <div id="dialog_states__trips" title="Seats available on trips" style="display:none;">
        <div>
            <div id="states__trips_conte"></div>
        </div>
    </div>

    <div id="dialog-trip-pregunta" title="Time limit for booking" style="display:none;">
        <p>
        <div id="reloj_temporizador" class="temporizador"></div>
        <div id="mensaje_trips_pregunta"></div>
    </p>
    </div>

<input  title="Reverse Payments" class="button_sliding_bg" type="button" id="rever_pagos" name="rever_pagos"  onClick="reversar();"  style="display:none; border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px; margin-left: 387px; margin-top: -321px; height: 26px; cursor:pointer; color: #fff; font-weight: 700; font-size:12px; width: 151px;  padding: 3px; padding-left: 4px;" value="Reverse Payments"/>
<input type="text" id="temp" name="temp" title="Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

<input type="text" id="temp_driver"  name="temp_driver" title="Temp Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
<input type="text" id="temp_prepaid"  name="temp_prepaid" title="Temp Prepaid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

<input type="text" id="no_pago"  name="no_pago" title="# pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="no_prep"  name="no_prep" title="# prep" size="12" style="display:none; margin-top:4px; margin-left:417px; width:18px; height:11px;" value="0" />


<input type="text" id="pago_1"  name="pago_1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago1"  name="pago1" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago1"  name="tipo_pago1" title="tipo pago1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado1"  name="pagado1" title="pagado1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob1"  name="estado_cob1" title="estado_cob1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre1"  name="pago_pre1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre1"  name="pagopre1" title="pago prep1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre1"  name="tipo_pagopre1" title="tipo pagopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre1"  name="pagadopre1" title="pagadopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre1"  name="estado_pre1" title="estado_pre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />


<input type="text" id="pago_2"  name="pago_2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago2"  name="pago2" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago2"  name="tipo_pago2" title="tipo pago2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado2"  name="pagado2" title="pagado2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob2"  name="estado_cob2" title="estado_cob2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre2"  name="pago_pre2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre2"  name="pagopre2" title="pago prep2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre2"  name="tipo_pagopre2" title="tipo pagopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre2"  name="pagadopre2" title="pagadopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre2"  name="estado_pre2" title="estado_pre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />




<input type="text" id="pago_3"  name="pago_3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago3"  name="pago3" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago3"  name="tipo_pago3" title="tipo pago3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado3"  name="pagado3" title="pagado3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob3"  name="estado_cob3" title="estado_cob3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre3"  name="pago_pre3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre3"  name="pagopre3" title="pago prep3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre3"  name="tipo_pagopre3" title="tipo pagopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre3"  name="pagadopre3" title="pagadopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre3"  name="estado_pre3" title="estado_pre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_4"  name="pago_4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago4"  name="pago4" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago4"  name="tipo_pago4" title="tipo pago4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado4"  name="pagado4" title="pagado4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob4"  name="estado_cob4" title="estado_cob4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre4"  name="pago_pre4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre4"  name="pagopre4" title="pago prep4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre4"  name="tipo_pagopre4" title="tipo pagopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre4"  name="pagadopre4" title="pagadopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre4"  name="estado_pre4" title="estado_pre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_5"  name="pago_5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago5"  name="pago5" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago5"  name="tipo_pago5" title="tipo pago5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado5"  name="pagado5" title="pagado5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob5"  name="estado_cob5" title="estado_cob5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre5"  name="pago_pre5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre5"  name="pagopre5" title="pago prep5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre5"  name="tipo_pagopre5" title="tipo pagopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre5"  name="pagadopre5" title="pagadopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre5"  name="estado_pre5" title="estado_pre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_6"  name="pago_6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago6"  name="pago6" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago6"  name="tipo_pago6" title="tipo pago6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado6"  name="pagado6" title="pagado6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob6"  name="estado_cob6" title="estado_cob6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre6"  name="pago_pre6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre6"  name="pagopre6" title="pago prep6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre6"  name="tipo_pagopre6" title="tipo pagopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre6"  name="pagadopre6" title="pagadopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre6"  name="estado_pre6" title="estado_pre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_7"  name="pago_7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago7"  name="pago7" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago7"  name="tipo_pago7" title="tipo pago7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado7"  name="pagado7" title="pagado7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob7"  name="estado_cob7" title="estado_cob7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre7"  name="pago_pre7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre7"  name="pagopre7" title="pago prep7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre7"  name="tipo_pagopre7" title="tipo pagopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre7"  name="pagadopre7" title="pagadopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre7"  name="estado_pre7" title="estado_pre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_8"  name="pago_8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago8"  name="pago8" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago8"  name="tipo_pago8" title="tipo pago8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado8"  name="pagado8" title="pagado8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob8"  name="estado_cob8" title="estado_cob8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre8"  name="pago_pre8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre8"  name="pagopre8" title="pago prep8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre8"  name="tipo_pagopre8" title="tipo pagopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre8"  name="pagadopre8" title="pagadopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre8"  name="estado_pre8" title="estado_pre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_9"  name="pago_9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago9"  name="pago9" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago9"  name="tipo_pago9" title="tipo pago9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado9"  name="pagado9" title="pagado9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob9"  name="estado_cob9" title="estado_cob9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre9"  name="pago_pre9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre9"  name="pagopre9" title="pago prep9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre9"  name="tipo_pagopre9" title="tipo pagopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre9"  name="pagadopre9" title="pagadopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre9"  name="estado_pre9" title="estado_pre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



<input type="text" id="pago_10"  name="pago_10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago10"  name="pago10" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago10"  name="tipo_pago10" title="tipo pago10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado10"  name="pagado10" title="pagado10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_cob10"  name="estado_cob10" title="estado_cob10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" id="pago_pre10"  name="pago_pre10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre10"  name="pagopre10" title="pago prep10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre10"  name="tipo_pagopre10" title="tipo pagopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre10"  name="pagadopre10" title="pagadopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
<input type="text" id="estado_pre10"  name="estado_pre10" title="estado_pre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

<input type="text" style="display:none;" name="est" id="est"  size="10" maxlength="10"  value="New" autocomplete="off"/>



</form>



<!--    <div class="" id="save2" style="position:fixed; overflow: visible; z-index: 1000; margin-left: 382px; margin-top: -32px; font-weight: bold; font-size: 46px; display:none;">
        <a style="margin-left: 40px; margin-top: -173px; position: absolute;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/eclipse.gif' width="150px" height="150px" margin-left="85px" margin-top="-127px">
        <a style="margin-left: 77px; margin-top: -132px; position: absolute;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/loading_trips.gif' width="75px" height="75px" margin-left="85px" margin-top="-127px">
        <div class="cssload-loader" style="position:absolute; color:#4682B4; text-align:center; margin-left: 6px; margin-top: 62px; font-size: 28px;">Loading</div>

    </div>  -->

<div id="save2" style="display:none; position:fixed; overflow: visible; z-index: 1000; margin-left: 132px; margin-top: -230px; color:transparent;">
    <center>
    <div class="loader" id="loader"></div>
    <div class="loader" id="loader2"></div>
    <div class="loader" id="loader3"></div>
    <div class="loader" id="loader4"></div>
            Delete the "loader3" and "loader4" divs for a 2-layer loader
            You can also change the animation durations or delays, that looks also pretty cool
<!--    <span style="font-weight:bold;" id="text">LOADING...</span>-->

    <p id="text" style="font-weight:bold;" class="saving">Loading<span>.</span><span>.</span><span>.</span></p>

</div>


<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:85px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="tipo_reserva" id="tipo_reserva"  size="10" maxlength="10"  value="Nuevo" autocomplete="off"/>
<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="total_pasajeros" id="total_pasajeros"  size="10" maxlength="10"  value="0" autocomplete="off"/>
<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="trip_1" id="trip_1"  size="10" maxlength="10"  value="0" autocomplete="off"/>
<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="trip_2" id="trip_2"  size="10" maxlength="10"  value="0" autocomplete="off"/>



<input type="text" id="temporale" name="temporale" style="display:none; margin-top: 45px;"  value="100" />





<script type="text/javascript">
// $(document).ready(function(){

function cargando(){
        //document.getElementById('save2').style.display = '';

        // var trip2 = $("#trip_2").val();

        // //alert(window.screen.availWidth);

        // if(trip2 == 0){

        //     document.getElementById('save2').style.display = '';

        //     //document.getElementById('save2').style.marginTop = "-1050px";

        //     if (window.screen.availWidth == 1024) {
        //         window.parent.document.body.style.zoom = "100%";
        //         document.getElementById("save2").style.marginTop = "-259px";
        //     }

        //     if (window.screen.availWidth == 1280) {
        //         window.parent.document.body.style.zoom = "100%";
        //         document.getElementById("save2").style.marginTop = "-195px";
        //     }

        //     if (window.screen.availWidth == 1366) {
        //         window.parent.document.body.style.zoom = "110%";
        //         document.getElementById("save2").style.marginTop = "-259px";
        //     }

        //     if (window.screen.availWidth == 1440) {
        //         window.parent.document.body.style.zoom = "110%";
        //         document.getElementById("save2").style.marginTop = "-212px";
        //     }

        //     if (window.screen.availWidth == 1600) {
        //         window.parent.document.body.style.zoom = "125%";
        //         document.getElementById("save2").style.marginTop = "-252px";
        //     }

        //     if (window.screen.availWidth == 1680) {
        //         window.parent.document.body.style.zoom = "125%";
        //         document.getElementById("save2").style.marginTop = "-230px";
        //     }


        //     if (window.screen.availWidth > 1680) {
        //        window.parent.document.body.style.zoom = "125%";
        //        document.getElementById("save2").style.marginTop = "-218px";
        //     }

        //     if (window.screen.availWidth > 1920) {
        //        window.parent.document.body.style.zoom = "100%";
        //        document.getElementById("save2").style.marginTop = "-218px";
        //     }

        // }else{

        //     document.getElementById('save2').style.display = '';

        //     if (window.screen.availWidth == 1024) {
        //         window.parent.document.body.style.zoom = "100%";
        //         document.getElementById("save2").style.marginTop = "-107px";
        //     }

        //     if (window.screen.availWidth == 1280) {
        //         window.parent.document.body.style.zoom = "100%";
        //         document.getElementById("save2").style.marginTop = "-99px";
        //     }

        //     if (window.screen.availWidth == 1366) {
        //         window.parent.document.body.style.zoom = "110%";
        //         document.getElementById("save2").style.marginTop = "-96px";
        //     }

        //     if (window.screen.availWidth == 1440) {
        //         window.parent.document.body.style.zoom = "110%";
        //         document.getElementById("save2").style.marginTop = "-80px";
        //     }

        //     if (window.screen.availWidth == 1600) {
        //         window.parent.document.body.style.zoom = "125%";
        //         document.getElementById("save2").style.marginTop = "-97px";
        //     }

        //     if (window.screen.availWidth == 1680) {
        //         window.parent.document.body.style.zoom = "125%";
        //         document.getElementById("save2").style.marginTop = "-230px";
        //     }


        //     if (window.screen.availWidth > 1680) {
        //        window.parent.document.body.style.zoom = "125%";
        //        document.getElementById("save2").style.marginTop = "-218px";
        //     }


        //     if (window.screen.availWidth > 1920) {
        //        window.parent.document.body.style.zoom = "100%";
        //        document.getElementById("save2").style.marginTop = "-218px";
        //     }

        //     //document.getElementById('save2').style.marginTop = "-1393px";
        // }


// });
        }
</script>



<script type="text/javascript">

            function passenger_balance()
            {

                var pago_conductor = document.getElementById('op_pago_conductor').value;

                //credit card no fee
                if (pago_conductor == '8') {

                    document.getElementById('op_pago_conductor').value = "8";
                    document.getElementById('op_pago_id').value = "8";
                    CalcularTotalTotal();
                    document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;


                //credit card with fee
                }else if (pago_conductor == '3') {
                    document.getElementById('op_pago_conductor').value = "3";
                    document.getElementById('op_pago_id').value = "3";
                    $jq('#saldoporpagar').prop('readonly',false);

                    setTimeout(function () {
                        var balance = parseFloat($("#balance_due").val());
                        var porcbal = balance*0.04;
                        var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                        CalcularTotalTotal();
                        //$("#balance_due").val((tot_balance).toFixed(2));
                        //$("#bal_duep").val((tot_balance).toFixed(2));
                        //document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;


                    }, 0.01);

                //cash
                }else  if (pago_conductor == '4') {

                    document.getElementById('op_pago_conductor').value = "4";
                    document.getElementById('op_pago_id').value = "4";
                    $jq('#saldoporpagar').prop('readonly',false);
                    CalcularTotalTotal();
                    document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                //check
                }else if (pago_conductor == '9') {

                    document.getElementById('op_pago_conductor').value = "9";
                    document.getElementById('op_pago_id').value = "9";
                    $jq('#saldoporpagar').prop('readonly',false);
                    CalcularTotalTotal();
                    document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                //credit voucher
                }else if (pago_conductor == '5') {

                    document.getElementById('op_pago_conductor').value = "5";
                    document.getElementById('op_pago_id').value = "5";
                     $jq('#saldoporpagar').prop('readonly',true);
//                    document.getElementById('op_pago_id1')
                    setTimeout(function () {

                        var cv = 0;
                        $("#saldoporpagar").val((cv).toFixed(2));
                        $("#paid_driver").val((cv).toFixed(2));
                        $("#balance_due").val((cv).toFixed(2));
                        document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                    }, 0.01);

                //complementary
                }else if (pago_conductor == '7') {

                    document.getElementById('op_pago_conductor').value = "7";
                    document.getElementById('op_pago_id').value = "7";
                    setTimeout(function () {

                        var cv = 0;
                        $("#saldoporpagar").val((cv).toFixed(2));
                        $("#paid_driver").val((cv).toFixed(2));
                        $("#balance_due").val((cv).toFixed(2));
                        $("#totalPagar").val((cv).toFixed(2));
                        $("#totaltotal").text((cv).toFixed(2));
                        $("#pay_amount").val((cv).toFixed(2));
                        $("#agency_balance_due").val((cv).toFixed(2));
                        $("#otheramount").val((cv).toFixed(2));
                        document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                    }, 0.01);
                }

            }

</script>


<script type="text/javascript">

    function calculos() {


        var opcion = $("#op_pago_id1").val();

        //PRED-PAID////////////////////////////////////////////

        //Credit Card no fee

        if (opcion === '20') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var prepaid = parseFloat($("#prepaid").val());
                var kollect = parseFloat($("#pago_driver").val());

                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;

//                var no_prep =  $("#no_prep").val();
//                no_prep = no_prep + 1;

                var pago = 'PRED-PAID';
                var tipo_pago = 'CREDIT CARD NO FEE';


                if(agency_balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    alert("Este pago no puede ser Procesado!!!");

                    Exit();

                }else{

                prepaid = parseFloat(prepaid) + parseFloat(total);

                $("#no_prep").val(no_prep);
                $("#prepaid").val((prepaid).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#pago_tarjeta").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));


                if(no_prep == 1){


                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((kollect).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");


                }else if(no_prep == 2){

                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((kollect).toFixed(2));
                    $("#estado_pre2").val("temp_pre2");

                }else if(no_prep == 3){

                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((kollect).toFixed(2));
                    $("#estado_pre3").val("temp_pre3");

                }else if(no_prep == 4){

                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((kollect).toFixed(2));
                    $("#estado_pre4").val("temp_pre4");

                }else if(no_prep == 5){

                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((kollect).toFixed(2));
                    $("#estado_pre5").val("temp_pre5");

                }else if(no_prep == 6){

                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((kollect).toFixed(2));
                    $("#estado_pre6").val("temp_pre6");

                }else if(no_prep == 7){

                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((kollect).toFixed(2));
                    $("#estado_pre7").val("temp_pre7");

                }else if(no_prep == 8){

                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((kollect).toFixed(2));
                    $("#estado_pre8").val("temp_pre8");

                }else if(no_prep == 9){

                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((kollect).toFixed(2));
                    $("#estado_pre9").val("temp_pre9");

                }else if(no_prep == 10){

                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((kollect).toFixed(2));
                    $("#estado_pre10").val("temp_pre10");

                }

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btnPagolinea").disabled = false;
                document.getElementById("btnPagolinea").style.display = "";
                document.getElementById("btnPagolinea").style.cursor = 'pointer';

                document.getElementById("btndecline").disabled = false;
                document.getElementById("btndecline").style.display = "";
                document.getElementById("btndecline").style.cursor = 'pointer';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = "";
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id2').value = 2;

                valida_clase2();

                }

            } else {
                // Do nothing!
                //exit;
                Exit2();
            }


        }

        //Credit Card with fee

        if (opcion === '21') {

            if (confirm('Confirme su Tipo de Pago!!!')) {
				//alert('asd');
                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                var valor = parseFloat(pago_driver2)*(0.04);
                var total = parseFloat(pago_driver2) + parseFloat(valor);
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;

//                var no_prep =  $("#no_prep").val();
//                no_prep = no_prep + 1;

                var pago = 'PRED-PAID';
                var tipo_pago = 'CREDIT CARD WITH FEE';


                if(agency_balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                temp = parseFloat(temp) + parseFloat(valor);
                temp_prepaid = parseFloat(temp_prepaid) + parseFloat(valor);

                $("#temp").val((temp).toFixed(2));
                $("#temp_prepaid").val((temp_prepaid).toFixed(2));

                var prepaid = parseFloat($("#prepaid").val());
                prepaid = parseFloat(prepaid) + parseFloat(total);

                $("#no_prep").val(no_prep);
                $("#prepaid").val((prepaid).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#pago_tarjeta").val((total).toFixed(2));
                //actualizacion
                $("#tot_charge").val((temp).toFixed(2));
                $("#PAP").val((valor).toFixed(2));

                if(no_prep == 1){


                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");

                }else if(no_prep == 2){

                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((total).toFixed(2));
                    $("#estado_pre2").val("temp_pre2");

                }else if(no_prep == 3){

                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((total).toFixed(2));
                    $("#estado_pre3").val("temp_pre3");

                }else if(no_prep == 4){

                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((total).toFixed(2));
                    $("#estado_pre4").val("temp_pre4");

                }else if(no_prep == 5){

                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((total).toFixed(2));
                    $("#estado_pre5").val("temp_pre5");

                }else if(no_prep == 6){

                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((total).toFixed(2));
                    $("#estado_pre6").val("temp_pre6");

                }else if(no_prep == 7){

                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((total).toFixed(2));
                    $("#estado_pre7").val("temp_pre7");

                }else if(no_prep == 8){

                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((total).toFixed(2));
                    $("#estado_pre8").val("temp_pre8");

                }else if(no_prep == 9){

                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((total).toFixed(2));
                    $("#estado_pre9").val("temp_pre9");

                }else if(no_prep == 10){

                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((total).toFixed(2));
                    $("#estado_pre10").val("temp_pre10");

                }

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = '#696969';
                document.getElementById("btnExit").style.background = '#696969';

                document.getElementById("btnPagolinea").disabled = false;
                document.getElementById("btnPagolinea").style.display = "";
                document.getElementById("btnPagolinea").style.cursor = 'pointer';

                document.getElementById("btndecline").disabled = false;
                document.getElementById("btndecline").style.display = "";
                document.getElementById("btndecline").style.cursor = 'pointer';

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id2').value = 1;

                valida_clase2();

              }

            } else {
                // Do nothing!
                Exit2();
            }


        }

        //Cash
        if (opcion === '22') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var prepaid = parseFloat($("#prepaid").val());

                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;

//                var no_prep =  $("#no_prep").val();
//                no_prep = no_prep + 1;

                var pago = 'PRED-PAID';
                var tipo_pago = 'CASH';


                if(agency_balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                prepaid = parseFloat(prepaid) + parseFloat(total);

//                alert(prepaid);
//                exit();
                $("#no_prep").val(no_prep);
                $("#prepaid").val((prepaid).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));

                if(no_prep == 1){


                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");

                }else if(no_prep == 2){

                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((total).toFixed(2));
                    $("#estado_pre2").val("temp_pre2");

                }else if(no_prep == 3){

                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((total).toFixed(2));
                    $("#estado_pre3").val("temp_pre3");

                }else if(no_prep == 4){

                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((total).toFixed(2));
                    $("#estado_pre4").val("temp_pre4");

                }else if(no_prep == 5){

                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((total).toFixed(2));
                    $("#estado_pre5").val("temp_pre5");

                }else if(no_prep == 6){

                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((total).toFixed(2));
                    $("#estado_pre6").val("temp_pre6");

                }else if(no_prep == 7){

                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((total).toFixed(2));
                    $("#estado_pre7").val("temp_pre7");

                }else if(no_prep == 8){

                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((total).toFixed(2));
                    $("#estado_pre8").val("temp_pre8");

                }else if(no_prep == 9){

                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((total).toFixed(2));
                    $("#estado_pre9").val("temp_pre9");

                }else if(no_prep == 10){

                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((total).toFixed(2));
                    $("#estado_pre10").val("temp_pre10");

                }


                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btndecline").disabled = false;
                document.getElementById("btndecline").style.display = "";
                document.getElementById("btndecline").style.cursor = 'pointer';
//                document.getElementById("btnPagolinea").disabled = true;
//                document.getElementById("btnPagolinea").style.display = "none";

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";

                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id2').value = 6;

                valida_clase2();

                }

            } else {
                // Do nothing!
                Exit2();
            }


        }

        //Check
        if (opcion === '23') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var prepaid = parseFloat($("#prepaid").val());

                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;

//                var no_prep =  $("#no_prep").val();
//                no_prep = no_prep + 1;

                var pago = 'PRED-PAID';
                var tipo_pago = 'CHECK';


                if(agency_balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";


                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                prepaid = parseFloat(prepaid) + parseFloat(total);
                $("#no_prep").val(no_prep);
                $("#prepaid").val((prepaid).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));

                if(no_prep == 1){


                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");

                }else if(no_prep == 2){

                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((total).toFixed(2));
                    $("#estado_pre2").val("temp_pre2");

                }else if(no_prep == 3){

                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((total).toFixed(2));
                    $("#estado_pre3").val("temp_pre3");

                }else if(no_prep == 4){

                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((total).toFixed(2));
                    $("#estado_pre4").val("temp_pre4");

                }else if(no_prep == 5){

                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((total).toFixed(2));
                    $("#estado_pre5").val("temp_pre5");

                }else if(no_prep == 6){

                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((total).toFixed(2));
                    $("#estado_pre6").val("temp_pre6");

                }else if(no_prep == 7){

                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((total).toFixed(2));
                    $("#estado_pre7").val("temp_pre7");

                }else if(no_prep == 8){

                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((total).toFixed(2));
                    $("#estado_pre8").val("temp_pre8");

                }else if(no_prep == 9){

                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((total).toFixed(2));
                    $("#estado_pre9").val("temp_pre9");

                }else if(no_prep == 10){

                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((total).toFixed(2));
                    $("#estado_pre10").val("temp_pre10");

                }

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btndecline").disabled = false;
                document.getElementById("btndecline").style.display = "";
                document.getElementById("btndecline").style.cursor = 'pointer';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id2').value = 10;

                valida_clase2();

                }

            } else {
                // Do nothing!
                Exit2();
            }

        }

        //COLLECT ON BOARD//////////////////////////////////////

        //Credit Card no fee
        if (opcion === '24') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var balance_due = parseFloat($("#balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var collect = parseFloat($("#collect").val());
                var kollect = parseFloat($("#pago_driver").val());

                var no_pago =  document.getElementById("no_pago").value;
                no_pago = parseInt(no_pago) + 1;

//                var no_pago =  $("#no_pago").val();
//                no_pago = no_pago + 1;


                var pago = 'COLLECT ON BOARD';
                var tipo_pago = 'CREDIT CARD NO FEE';

                if(balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";


                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                $("#no_pago").val(no_pago);
                collect = parseFloat(collect) + parseFloat(total);
                $("#collect").val((collect).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));

                if(no_pago == 1){

                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((kollect).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");

                }else if(no_pago == 2){

                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((kollect).toFixed(2));
                    $("#estado_cob2").val("temp_cob2");


                }else if(no_pago == 3){

                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((kollect).toFixed(2));
                    $("#estado_cob3").val("temp_cob3");

                }else if(no_pago == 4){

                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((kollect).toFixed(2));
                    $("#estado_cob4").val("temp_cob4");

                }else if(no_pago == 5){

                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((kollect).toFixed(2));
                    $("#estado_cob5").val("temp_cob5");

                }else if(no_pago == 6){

                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((kollect).toFixed(2));
                    $("#estado_cob6").val("temp_cob6");

                }else if(no_pago == 7){

                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((kollect).toFixed(2));
                    $("#estado_cob7").val("temp_cob7");

                }else if(no_pago == 8){

                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((kollect).toFixed(2));
                    $("#estado_cob8").val("temp_cob8");

                }else if(no_pago == 9){

                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((kollect).toFixed(2));
                    $("#estado_cob9").val("temp_cob9");

                }else if(no_pago == 10){

                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((kollect).toFixed(2));
                    $("#estado_cob10").val("temp_cob10");

                }

                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";

                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 8;

                valida_clase2();

              }

            } else {
                // Do nothing!

                Exit2();
            }


        }
        //COLLECT ON BOARD
        //Credit Card with fee
        if (opcion === '25') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                var pago_driver = parseFloat($("#pago_driver").val());
                var balance_due = parseFloat($("#balance_due").val());
                var valor = parseFloat(pago_driver) * 0.04;
                var total = parseFloat(pago_driver) + parseFloat(valor);
                var temp_driver = parseFloat($("#temp_driver").val());
                var temp = parseFloat($("#temp").val());

                var no_pago =  document.getElementById("no_pago").value;
                no_pago = parseInt(no_pago) + 1;

//                var no_pago =  $("#no_pago").val();
//                no_pago = no_pago + 1;

                var pago = 'COLLECT ON BOARD';
                var tipo_pago = 'CREDIT CARD WITH FEE';

                if(balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";


                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                temp = parseFloat(temp) + parseFloat(valor);
                temp_driver = parseFloat(temp_driver) + parseFloat(valor);

                $("#temp").val((temp).toFixed(2));
                $("#temp_driver").val((temp_driver).toFixed(2));
                $("#no_pago").val(no_pago);
                var collect = parseFloat($("#collect").val());
                collect = parseFloat(collect) + parseFloat(total);
                $("#collect").val((collect).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));
                $("#tot_charge").val((temp).toFixed(2));

                if(no_pago == 1){


                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((total).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");

                }else if(no_pago == 2){

                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((total).toFixed(2));
                    $("#estado_cob2").val("temp_cob2");

                }else if(no_pago == 3){

                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((total).toFixed(2));
                    $("#estado_cob3").val("temp_cob3");

                }else if(no_pago == 4){

                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((total).toFixed(2));
                    $("#estado_cob4").val("temp_cob4");

                }else if(no_pago == 5){

                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((total).toFixed(2));
                    $("#estado_cob5").val("temp_cob5");

                }else if(no_pago == 6){

                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((total).toFixed(2));
                    $("#estado_cob6").val("temp_cob6");

                }else if(no_pago == 7){

                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((total).toFixed(2));
                    $("#estado_cob7").val("temp_cob7");

                }else if(no_pago == 8){

                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((total).toFixed(2));
                    $("#estado_cob8").val("temp_cob8");

                }else if(no_pago == 9){

                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((total).toFixed(2));
                    $("#estado_cob9").val("temp_cob9");

                }else if(no_pago == 10){

                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((total).toFixed(2));
                    $("#estado_cob10").val("temp_cob10");

                }


                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";


                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';


                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 3;

                valida_clase();

                }

            } else {
                // Do nothing!
                Exit2();
            }

        }

        //Cash
        if (opcion === '26') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var balance_due = parseFloat($("#balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var collect = parseFloat($("#collect").val());
                var kollect = parseFloat($("#pago_driver").val());

                var no_pago =  document.getElementById("no_pago").value;
                no_pago = parseInt(no_pago) + 1;

                var pago = 'COLLECT ON BOARD';
                var tipo_pago = 'CASH';

                if(balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                $("#no_pago").val(no_pago);
                collect = parseFloat(collect) + parseFloat(total);
                $("#collect").val((collect).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));

                if(no_pago == 1){

                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((kollect).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");

                }else if(no_pago == 2){

                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((kollect).toFixed(2));
                    $("#estado_cob2").val("temp_cob2");

                }else if(no_pago == 3){

                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((kollect).toFixed(2));
                    $("#estado_cob3").val("temp_cob3");

                }else if(no_pago == 4){

                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((kollect).toFixed(2));
                    $("#estado_cob4").val("temp_cob4");

                }else if(no_pago == 5){

                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((kollect).toFixed(2));
                    $("#estado_cob5").val("temp_cob5");

                }else if(no_pago == 6){

                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((kollect).toFixed(2));
                    $("#estado_cob6").val("temp_cob6");

                }else if(no_pago == 7){

                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((kollect).toFixed(2));
                    $("#estado_cob7").val("temp_cob7");

                }else if(no_pago == 8){

                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((kollect).toFixed(2));
                    $("#estado_cob8").val("temp_cob8");

                }else if(no_pago == 9){

                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((kollect).toFixed(2));
                    $("#estado_cob9").val("temp_cob9");

                }else if(no_pago == 10){

                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((kollect).toFixed(2));
                    $("#estado_cob10").val("temp_cob10");
                }

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';

                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 4;

                valida_clase();

                }

            } else {
                // Do nothing!
                Exit2();
            }

        }

        //Check

        if (opcion === '27') {


            if (confirm('Confirme su Tipo de Pago !!!')) {


                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var balance_due = parseFloat($("#balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var collect = parseFloat($("#collect").val());
                var kollect = parseFloat($("#pago_driver").val());

                var no_pago =  document.getElementById("no_pago").value;
                no_pago = parseInt(no_pago) + 1;//

                var pago = 'COLLECT ON BOARD';
                var tipo_pago = 'CHECK';


                if(balance_due <= "0"){

                    document.getElementById('pago_driver').value = "0.00";
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    alert("Este pago no puede ser Procesado!!!");
                    Exit();

                }else{

                $("#no_pago").val(no_pago);
                collect = parseFloat(collect) + parseFloat(total);
                $("#collect").val((collect).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));

                if(no_pago == 1){

                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((kollect).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");

                }else if(no_pago == 2){

                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((kollect).toFixed(2));
                    $("#estado_cob2").val("temp_cob2");

                }else if(no_pago == 3){

                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((kollect).toFixed(2));
                    $("#estado_cob3").val("temp_cob3");

                }else if(no_pago == 4){

                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((kollect).toFixed(2));
                    $("#estado_cob4").val("temp_cob4");

                }else if(no_pago == 5){

                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((kollect).toFixed(2));
                    $("#estado_cob5").val("temp_cob5");

                }else if(no_pago == 6){

                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((kollect).toFixed(2));
                    $("#estado_cob6").val("temp_cob6");

                }else if(no_pago == 7){

                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((kollect).toFixed(2));
                    $("#estado_cob7").val("temp_cob7");

                }else if(no_pago == 8){

                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((kollect).toFixed(2));
                    $("#estado_cob8").val("temp_cob8");

                }else if(no_pago == 9){

                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((kollect).toFixed(2));
                    $("#estado_cob9").val("temp_cob9");

                }else if(no_pago == 10){

                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((kollect).toFixed(2));
                    $("#estado_cob10").val("temp_cob10");

                }


                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';

                document.getElementById("btnExit").disabled = true;
                document.getElementById("btnExit").style.display = '';
                document.getElementById("btnExit").style.cursor = '';
                document.getElementById("btnExit").style.borderColor = "#696969";
                document.getElementById("btnExit").style.background = "#696969";

                //document.getElementById("btn-save2").style.display = "none";

                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';

                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 9;
                //valida clase de pago
                valida_clase();


                }

            } else {
                // Do nothing!
               Exit2();
            }

        }



    }
</script>



<style>
    #rectangulo {
        border: solid 2px #000;
        margin-left: 86px;
        margin-top: -360px;
        height: 198px;
        width: 284px;
        display:none;
    }

</style>

<script type="text/javascript">

    var z
    function capturar()
    {
        var resultado = "ninguno";

        var porNombre = document.getElementsByName("tipo_ticket");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for (var i = 0; i < porNombre.length; i++)
        {
            if (porNombre[i].checked)
                resultado = porNombre[i].value;

        }

        z = document.getElementById("resultado").innerHTML = " \ " + resultado;


    }
</script>
</script>

<script type="text/javascript">

    function mostrarVentana2() {

        capturar();



        if (window.screen.availWidth <= 640) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
			$('#vent1').hide();
        }

        if (window.screen.availWidth == 800) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
			$('#vent1').hide();
        }

        if (window.screen.availWidth == 960 && z == 1) {

            window.parent.document.body.style.zoom = "78%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
			$('#vent1').hide();
        }

        if (window.screen.availWidth == 960 && z == 2) {

            window.parent.document.body.style.zoom = "78%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "221px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
			$('#vent1').hide();
        }

        if (window.screen.availWidth == 1024 && z == 1) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible

//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
$('#vent1').hide();

        }

        if (window.screen.availWidth == 1024 && z == 2) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "221px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';


        }


        if (window.screen.availWidth == 1280 && z == 1) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-321.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible

//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
$('#vent1').hide();

        }

        if (window.screen.availWidth == 1280 && z == 2) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor

//            ventana2.style.marginTop = "221px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-321.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
			//$('#miVentana2').css('display','block');
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';


        }



        if (window.screen.availWidth == 1366 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-1px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-280.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }

        if (window.screen.availWidth == 1366 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "230px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-279.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';
$('#vent1').hide();
        }

        if (window.screen.availWidth == 1440 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-1.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }

        if (window.screen.availWidth == 1440 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "229.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }

        if (window.screen.availWidth == 1600 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-15.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }

        if (window.screen.availWidth == 1600 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "215.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }

        if (window.screen.availWidth == 1680 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "-15.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }

        if (window.screen.availWidth == 1680 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//            ventana2.style.marginTop = "215.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }



        if (window.screen.availWidth > 1680 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor


//            ventana2.style.marginTop = "-2.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-190.4px"; // Definimos su posición horizontal
//            ventana2.style.top = "691px"; // Definimos su posición vertical.
//            ventana2.style.left = "818px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';


        }


        if (window.screen.availWidth > 1680 && z == 2) {

            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor

//            ventana2.style.marginTop = "228.5px"; // Definimos su posición vertical.
//            ventana2.style.marginLeft = "-190.4px"; // Definimos su posición horizontal

//            ventana2.style.top = "954px"; // Definimos su posición vertical.
//            ventana2.style.left = "818px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
			$('#vent1').hide();
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '170px';

        }


        document.getElementById("btnExit").disabled = false;
        document.getElementById("btnExit").style.display = "";
        document.getElementById("btnExit").style.background = "#006394";
        document.getElementById("btnExit").style.cursor = 'pointer';
        document.getElementById("btnExit").style.borderColor = "red";
        document.getElementById("btnExit").style.color = "#fff";


        document.getElementById("pago_driver").disabled = false;
        document.getElementById('pago_driver').value = '';
        document.getElementById('pago_driver').style.color = '#848484';
        document.getElementById('pago_driver').style.background = '#fff';
        $("#pago_driver").focus();


        document.getElementById('op_pago_id1').value = 0;
        //$('op_pago_id1').val(0);
        //document.getElementById('op_pago_id').value = 8;
        document.getElementById('opcion_pago_2').value = 2;
		//$('opcion_pago_2').val(2);
        //document.getElementById('opcion_pago_3').value = 2;

        //document.getElementById("btnPagolinea").disabled = true;

        document.getElementById("btnPagolinea").style.display = "none";

        document.getElementById("btndecline").style.display = "none";

        document.getElementById("btncancol").style.display = "none";

        document.getElementById("btnAceptar").disabled = true;

        document.getElementById("btnAceptar").style.background = "lightgray";

        document.getElementById('btnAceptar').style.background = '';

        document.getElementById('btnAceptar').style.color = '#000';

        document.getElementById('btnAceptar').style.cursor = '';


        //$('#pago_driver').val()='0.00';
    }

</script>

<script languague="javascript">

   function ocultarmenu() {
        div = document.getElementById('menu-bar');
        div.style.display = 'none';
        div2 = document.getElementById('hd-menu');
        div2.style.display = 'none';

    }

</script>




<script type="text/javascript">
    function resetal()
    {

        //CalcularTotalTotal();
        //document.getElementById('saldoporpagar').value = apagar;

        var pay_amount = '0.00';
        var other_amount = '0.00';

        var paid_driver = $("#paid_driver").val();

        var pago_driver = $("#pago_driver").val();

        var total_pagar = $("#totalPagar").val();

        var saldoXpagar = $("#saldoporpagar").val();

        var op_pag_conduct = $("#selectcond").val();

        $("#pay_amount").val(pay_amount);
        $("#otheramount").val(other_amount);

//        document.getElementById('pay_amount').value = pay_amount;



        document.getElementById('pago_driver').value = '';
        document.getElementById('paid_driver').value = '0.00';



        document.getElementById('pago_driver').style.color = '#848484';
        document.getElementById('pago_driver2').value = '0.00';



        document.getElementById('temp').value = '0.00';
        document.getElementById('temp_driver').value = '0.00';
        document.getElementById('temp_prepaid').value = '0.00';
        document.getElementById('pago_tarjeta').value = '0.00';
        document.getElementById('prepaid').value = '0.00';
        document.getElementById('collect').value = '0.00';

        //Pagos Collect on Board
        document.getElementById('no_pago').value = '0';
        document.getElementById('pago_1').value = '0';
        document.getElementById('pago_2').value = '0';
        document.getElementById('pago_3').value = '0';
        document.getElementById('pago_4').value = '0';
        document.getElementById('pago_5').value = '0';
        document.getElementById('pago_6').value = '0';
        document.getElementById('pago_7').value = '0';
        document.getElementById('pago_8').value = '0';
        document.getElementById('pago_9').value = '0';
        document.getElementById('pago_10').value = '0';
        document.getElementById('pago1').value = '';
        document.getElementById('pago2').value = '';
        document.getElementById('pago3').value = '';
        document.getElementById('pago4').value = '';
        document.getElementById('pago5').value = '';
        document.getElementById('pago6').value = '';
        document.getElementById('pago7').value = '';
        document.getElementById('pago8').value = '';
        document.getElementById('pago9').value = '';
        document.getElementById('pago10').value = '';
        document.getElementById('tipo_pago1').value = '';
        document.getElementById('tipo_pago2').value = '';
        document.getElementById('tipo_pago3').value = '';
        document.getElementById('tipo_pago4').value = '';
        document.getElementById('tipo_pago5').value = '';
        document.getElementById('tipo_pago6').value = '';
        document.getElementById('tipo_pago7').value = '';
        document.getElementById('tipo_pago8').value = '';
        document.getElementById('tipo_pago9').value = '';
        document.getElementById('tipo_pago10').value = '';
        document.getElementById('pagado1').value = '0.00';
        document.getElementById('pagado2').value = '0.00';
        document.getElementById('pagado3').value = '0.00';
        document.getElementById('pagado4').value = '0.00';
        document.getElementById('pagado5').value = '0.00';
        document.getElementById('pagado6').value = '0.00';
        document.getElementById('pagado7').value = '0.00';
        document.getElementById('pagado8').value = '0.00';
        document.getElementById('pagado9').value = '0.00';
        document.getElementById('pagado10').value = '0.00';


        //Pagos prepago

        document.getElementById('no_prep').value = '0';
        document.getElementById('pago_pre1').value = '0';
        document.getElementById('pago_pre2').value = '0';
        document.getElementById('pago_pre3').value = '0';
        document.getElementById('pago_pre4').value = '0';
        document.getElementById('pago_pre5').value = '0';
        document.getElementById('pago_pre6').value = '0';
        document.getElementById('pago_pre7').value = '0';
        document.getElementById('pago_pre8').value = '0';
        document.getElementById('pago_pre9').value = '0';
        document.getElementById('pago_pre10').value = '0';




        document.getElementById('pagopre1').value = '';
        document.getElementById('pagopre2').value = '';
        document.getElementById('pagopre3').value = '';
        document.getElementById('pagopre4').value = '';
        document.getElementById('pagopre5').value = '';
        document.getElementById('pagopre6').value = '';
        document.getElementById('pagopre7').value = '';
        document.getElementById('pagopre8').value = '';
        document.getElementById('pagopre9').value = '';
        document.getElementById('pagopre10').value = '';



        document.getElementById('tipo_pagopre1').value = '';
        document.getElementById('tipo_pagopre2').value = '';
        document.getElementById('tipo_pagopre3').value = '';
        document.getElementById('tipo_pagopre4').value = '';
        document.getElementById('tipo_pagopre5').value = '';
        document.getElementById('tipo_pagopre6').value = '';
        document.getElementById('tipo_pagopre7').value = '';
        document.getElementById('tipo_pagopre8').value = '';
        document.getElementById('tipo_pagopre9').value = '';
        document.getElementById('tipo_pagopre10').value = '';


        document.getElementById('pagadopre1').value = '0.00';
        document.getElementById('pagadopre2').value = '0.00';
        document.getElementById('pagadopre3').value = '0.00';
        document.getElementById('pagadopre4').value = '0.00';
        document.getElementById('pagadopre5').value = '0.00';
        document.getElementById('pagadopre6').value = '0.00';
        document.getElementById('pagadopre7').value = '0.00';
        document.getElementById('pagadopre8').value = '0.00';
        document.getElementById('pagadopre9').value = '0.00';
        document.getElementById('pagadopre10').value = '0.00';

        document.getElementById('pago_driver').disabled = false;

        document.getElementById('btnAceptar').style.background = '';
        document.getElementById('btnAceptar').style.color = '#000';
        document.getElementById('dolares').style.color = '#848484';
        document.getElementById('btnAceptar').style.cursor = '';


        document.getElementById('paid_driver').style.color = "#000";
        document.getElementById('pay_amount').style.color = "#000";
        document.getElementById('pay_amount').className = "azu";
        document.getElementById('paid_driver').className = "brown3";
        document.getElementById('paid_driver').title ="";
        document.getElementById('pay_amount').title ="";

        document.getElementById('op_pago_id2').value = 2;
        document.getElementById('op_pago_id1').value = 0;
        document.getElementById('op_pago_id').value = 8;
        document.getElementById('op_pago_conductor').value = 8;
        document.getElementById('selectcond').value = 8;

        CalcularTotalTotal();

    }
</script>


<script type="text/javascript">

    function tipopago()
    {

        var op_pago = document.getElementById('op_pago').value;

        //CREDIT CARD NO FEE
        if (op_pago == 8) {

            document.getElementById('op_pago_id').value = 8;
            $('#op_pago_id').click();

        }

        //CREDIT CARD WITH FEE
        if (op_pago == 3) {


            document.getElementById('op_pago_id').value = 3;
            $('#op_pago_id').click();
            //balance_pasajero();

        }



        //CASH
        if (op_pago == 4) {

            document.getElementById('op_pago_id').value = 4;
            $('#op_pago_id').click();

        }

        //CHECK
        if (op_pago == 9) {

            document.getElementById('op_pago_id').value = 9;
            $('#op_pago_id').click();

        }

        //CREDIT VOUCHER
        if (op_pago == 5) {

            document.getElementById('op_pago_id').value = 5;
            $('#op_pago_id').click();

        }

        //COMPLEMENTARY
        if (op_pago == 7) {

            document.getElementById('op_pago_id').value = 7;
            $('#op_pago_id').click();

        }
    }
</script>

<script type="text/javascript">
    function reset2()
    {
        setTimeout(function () {

            $('#btnAceptar').click();


        }, 0.001);


        setTimeout(function () {

            tipopago();

        }, 100);

    }

</script>

<script type="text/javascript">
    function activa_one()
    {

    document.getElementById('oneway2').checked = true;
    document.getElementById('roundtrip2').checked = false;

    }

</script>

<script type="text/javascript">
    function activa_round()
    {

    document.getElementById('roundtrip2').checked = true;
    document.getElementById('oneway2').checked = false;

    }

</script>





<script type="text/javascript">
    function run()
    {
        setTimeout(function () {

            //$('#pay_amount').click();
            CalcularTotalTotal();

        }, 0.001);

    }
</script>

<script type="text/javascript">
    function dupliac()
    {
//      duplicar amount to collect ---- > otheramount
        var dupliam = document.getElementById('saldoporpagar').value;
        var extra = $("#extra").val();
        var desc_valor = $("#descuento_valor").val();
        var desc_porc = $("#descuento").val();
        var paid_driver = $("#paid_driver").val();
        var apagare1 = apagare;
        var apagar1 = parseFloat(apagare1) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
        var balance = parseFloat(apagar1) - parseFloat(paid_driver);
        var duplicado = (parseFloat(dupliam)).toFixed(2);
        var other = 0;

        document.getElementById('otheramount').value = duplicado;
        document.getElementById('balance_due').value = dupliam;
        document.getElementById('saldoporpagar').style.background = "#1919e6";
        document.getElementById('saldoporpagar').style.color = "#ffff00";
        document.getElementById('saldoporpagar').title = "Colectando";
        document.getElementById('txtamountpendiente').style.color = "#1919e6";



        if (dupliam == '') {

            setTimeout(function () {

                //click al boton Balance_Due para hacer el calculo de passenger Balance Due
                //$('#paid_driver').click();

                $("#saldoporpagar").val((apagar1).toFixed(2));
                $("#balance_due").val((balance).toFixed(2));
                $("#otheramount").val((other).toFixed(2));
                document.getElementById('saldoporpagar').className = "verd form-control";
                document.getElementById('saldoporpagar').style.background = "#fff";
                document.getElementById('saldoporpagar').style.color = "#000";
                document.getElementById('txtamountpendiente').style.color = "#000";
                document.getElementById('saldoporpagar').title = "";



//                $("#otheramountp").val((other).toFixed(2));
                CalcularTotalTotal();

            }, 100);

        }

        if (dupliam == "0") {

            setTimeout(function () {

                //click al boton Balance_Due para hacer el calculo de passenger Balance Due
                //$('#paid_driver').click();


                $("#saldoporpagar").val((apagar1).toFixed(2));
                $("#balance_due").val((balance).toFixed(2));
                $("#otheramount").val((other).toFixed(2));
                document.getElementById('saldoporpagar').className = "verd form-control";
                document.getElementById('saldoporpagar').style.background = "#fff";
                document.getElementById('saldoporpagar').style.color = "#000";
                document.getElementById('txtamountpendiente').style.color = "#000";
                document.getElementById('saldoporpagar').title = "";
//                $("#otheramountp").val((other).toFixed(2));
                CalcularTotalTotal();

            }, 100);

        }

        if (dupliam > 0) {


            setTimeout(function () {

                //click al boton Balance_Due para hacer el calculo de passenger Balance Due

                //$('#paid_driver').click();
                CalcularTotalTotal();
                //document.getElementById('op_pago_conductor').value = 8;

            }, 1250);

        }

        //$('#pay_amount').click();

    }

</script>

<script type="text/javascript">

    function complementary()
    {
        var cv = 0;


        $("#saldoporpagar").val((cv).toFixed(2));
//        $("#paid_driver").val((cv).toFixed(2));
//        $("#balance_due").val((cv).toFixed(2));
//        $("#totalPagar").val((cv).toFixed(2));
//        $("#pay_amount").val((cv).toFixed(2));
//        $("#agency_balance_due").val((cv).toFixed(2));

    }

</script>


<script type="text/javascript">
    function dupliPago()
    {
//       ("#pago_driver").mask("99,99");
        var dupli = document.getElementById('pago_driver').value;
        document.getElementById('pago_driver2').value = dupli;

        if (dupli == '') {

            //document.getElementById('pago_driver').value = '';
            document.getElementById('pago_driver').placeholder = "0.00"

            document.getElementById('pago_driver').style.color = '#848484';

            document.getElementById('dolares').style.color = '#848484';

            $("#pago_driver").focus();
        }

        if (dupli > '0.00') {
            document.getElementById("op_pago_id1").disabled = false;

            document.getElementById('pago_driver').style.color = '#000';

            document.getElementById('dolares').style.color = '#000';

            $("#pago_driver").focus();



        } else {

            document.getElementById("op_pago_id1").disabled = false;

            document.getElementById('pago_driver').style.color = '#000';

            document.getElementById('dolares').style.color = '#000';

            $("#pago_driver").focus();

//
        }

    }
</script>



<!--<table width="100" height="100" border="1" bordercolor="#00FF00" background ="" bgcolor="#0000FF"> <tr>    <td>sss </tr></table>-->

<script type="text/javascript">
    function reversar(){

    var no_prep =  document.getElementById("no_prep").value;
    var no_pago =  document.getElementById("no_pago").value;
    document.getElementById('prepaid').value = "0.00";
    document.getElementById('temp_prepaid').value = "0.00";
    document.getElementById('pago_driver').value = "0.00";
    document.getElementById('pay_amount').value = "0.00";
    document.getElementById('paid_driver').value = "0.00";



    if(no_prep == 1){
        document.getElementById("no_prep").value = 0;
        document.getElementById('pago_pre1').value = '0';
        document.getElementById('pagopre1').value = '';
        document.getElementById('tipo_pagopre1').value = '';
        document.getElementById('pagadopre1').value = '0.00';

    }else if(no_prep == 2){
        document.getElementById("no_prep").value = 1;
        document.getElementById('pago_pre2').value = '0';
        document.getElementById('pagopre2').value = '';
        document.getElementById('tipo_pagopre2').value = '';
        document.getElementById('pagadopre2').value = '0.00';

    }else if(no_prep == 3){
        document.getElementById("no_prep").value = 2;
        document.getElementById('pago_pre3').value = '0';
        document.getElementById('pagopre3').value = '';
        document.getElementById('tipo_pagopre3').value = '';
        document.getElementById('pagadopre3').value = '0.00';

    }else if(no_prep == 4){
        document.getElementById("no_prep").value = 3;
        document.getElementById('pago_pre4').value = '0';
        document.getElementById('pagopre4').value = '';
        document.getElementById('tipo_pagopre4').value = '';
        document.getElementById('pagadopre4').value = '0.00';

    }else if(no_prep == 5){
        document.getElementById("no_prep").value = 4;
        document.getElementById('pago_pre5').value = '0';
        document.getElementById('pagopre5').value = '';
        document.getElementById('tipo_pagopre5').value = '';
        document.getElementById('pagadopre5').value = '0.00';

    }else if(no_prep == 6){
        document.getElementById("no_prep").value = 5;
        document.getElementById('pago_pre6').value = '0';
        document.getElementById('pagopre6').value = '';
        document.getElementById('tipo_pagopre6').value = '';
        document.getElementById('pagadopre6').value = '0.00';

    }else if(no_prep == 7){
        document.getElementById("no_prep").value = 6;
        document.getElementById('pago_pre7').value = '0';
        document.getElementById('pagopre7').value = '';
        document.getElementById('tipo_pagopre7').value = '';
        document.getElementById('pagadopre7').value = '0.00';

    }else if(no_prep == 8){
        document.getElementById("no_prep").value = 7;
        document.getElementById('pago_pre8').value = '0';
        document.getElementById('pagopre8').value = '';
        document.getElementById('tipo_pagopre8').value = '';
        document.getElementById('pagadopre8').value = '0.00';

    }else if(no_prep == 9){
        document.getElementById("no_prep").value = 8;
        document.getElementById('pago_pre9').value = '0';
        document.getElementById('pagopre9').value = '';
        document.getElementById('tipo_pagopre9').value = '';
        document.getElementById('pagadopre9').value = '0.00';

    }else if(no_prep == 10){
        document.getElementById("no_prep").value = 9;
        document.getElementById('pago_pre10').value = '0';
        document.getElementById('pagopre10').value = '';
        document.getElementById('tipo_pagopre10').value = '';
        document.getElementById('pagadopre10').value = '0.00';

    }



    if(no_pago == 1){
        document.getElementById("no_pago").value = 0;
        document.getElementById('pago_1').value = '0';
        document.getElementById('pago1').value = '';
        document.getElementById('tipo_pago1').value = '';
        document.getElementById('pagado1').value = '0.00';

    }else if(no_pago == 2){
        document.getElementById("no_pago").value = 1;
        document.getElementById('pago_2').value = '0';
        document.getElementById('pago2').value = '';
        document.getElementById('tipo_pago2').value = '';
        document.getElementById('pagado2').value = '0.00';

    }else if(no_pago == 3){
        document.getElementById("no_pago").value = 2;
        document.getElementById('pago_3').value = '0';
        document.getElementById('pago3').value = '';
        document.getElementById('tipo_pago3').value = '';
        document.getElementById('pagado3').value = '0.00';

    }else if(no_pago == 4){
        document.getElementById("no_pago").value = 3;
        document.getElementById('pago_4').value = '0';
        document.getElementById('pago4').value = '';
        document.getElementById('tipo_pago4').value = '';
        document.getElementById('pagado4').value = '0.00';

    }else if(no_pago == 5){
        document.getElementById("no_pago").value = 4;
        document.getElementById('pago_5').value = '0';
        document.getElementById('pago5').value = '';
        document.getElementById('tipo_pago5').value = '';
        document.getElementById('pagado5').value = '0.00';

    }else if(no_pago == 6){
        document.getElementById("no_pago").value = 5;
        document.getElementById('pago_6').value = '0';
        document.getElementById('pago6').value = '';
        document.getElementById('tipo_pago6').value = '';
        document.getElementById('pagado6').value = '0.00';

    }else if(no_pago == 7){
        document.getElementById("no_pago").value = 6;
        document.getElementById('pago_7').value = '0';
        document.getElementById('pago7').value = '';
        document.getElementById('tipo_pago7').value = '';
        document.getElementById('pagado7').value = '0.00';

    }else if(no_pago == 8){
        document.getElementById("no_pago").value = 7;
        document.getElementById('pago_8').value = '0';
        document.getElementById('pago8').value = '';
        document.getElementById('tipo_pago8').value = '';
        document.getElementById('pagado8').value = '0.00';

    }else if(no_pago == 9){
        document.getElementById("no_pago").value = 8;
        document.getElementById('pago_9').value = '0';
        document.getElementById('pago9').value = '';
        document.getElementById('tipo_pago9').value = '';
        document.getElementById('pagado9').value = '0.00';

    }else if(no_pago == 10){
        document.getElementById("no_pago").value = 9;
        document.getElementById('pago_10').value = '0';
        document.getElementById('pago10').value = '';
        document.getElementById('tipo_pago10').value = '';
        document.getElementById('pagado10').value = '0.00';

    }

       //document.getElementById('prepaid').value = "0.00";
       //document.getElementById('temp_prepaid').value = "0.00";

       document.getElementById('collect').value = '0.00';
       document.getElementById('pago_driver2').value = '0.00';
       document.getElementById('prepaid').value = '0.00';

       document.getElementById('temp').value = '0.00';
       document.getElementById('temp_driver').value = '0.00';
       document.getElementById('temp_prepaid').value = '0.00';

       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00";
       document.getElementById('pago_tarjeta').value = "0.00";
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none";
       document.getElementById("btncancol").style.display = "none";
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";
       document.getElementById('pay_amount').className = "azu";
       document.getElementById('paid_driver').className = "brown3";
       //$("#pago_driver").focus();


       CalcularTotalTotal();
       resetal();
       reset2();
       ocultarVentana2();




    }
</script>

<script type="text/javascript">

    function Exit_Cob()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        var paid_driver = document.getElementById('paid_driver').value;
        var no_pago = document.getElementById('no_pago').value;
        var pago_driver2 = document.getElementById('pago_driver2').value;
        var collect = document.getElementById('collect').value;
        var temp_driver = document.getElementById('temp_driver').value;

        var estado_cob1 = document.getElementById('estado_cob1').value;
        var estado_cob2 = document.getElementById('estado_cob2').value;
        var estado_cob3 = document.getElementById('estado_cob3').value;
        var estado_cob4 = document.getElementById('estado_cob4').value;
        var estado_cob5 = document.getElementById('estado_cob5').value;
        var estado_cob6 = document.getElementById('estado_cob6').value;
        var estado_cob7 = document.getElementById('estado_cob7').value;
        var estado_cob8 = document.getElementById('estado_cob8').value;
        var estado_cob9 = document.getElementById('estado_cob9').value;
        var estado_cob10 = document.getElementById('estado_cob10').value;

        if(paid_driver == '0.00'){

            rever_collect_on_board();

        }

        //COLLECT ON BOARD (SI HAY PAGOS AL CONDUCTOR)

        if(paid_driver > '0.00'){

            var vacio = "";
            var cero ='0.00';

            if(no_pago == '1' && estado_cob1 == 'temp_cob1'){

                var vacio = '';
                var cero = '0.00';

                $("#no_pago").val(0);
                $("#pago_1").val(0);
                $("#pago1").val(vacio);
                $("#tipo_pago1").val(vacio);
                $("#pagado1").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                //$("#temp_driver").val((temp_driver1).toFixed(2));
                //$("#temp").val((temp_fee).toFixed(2));
                //$("#estado_cob1").val(vacio);
                document.getElementById('estado_cob1').value = "";

                CalcularTotalTotal();

                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btncancol").style.display = "none";
                document.getElementById("btnAceptar").disabled = true;
                document.getElementById("btnAceptar").style.background = "lightgray";
                ventana2.style.display = 'none'; // Y lo hacemos invisible
				$('#vent1').show();

            }

            if(no_pago == '2' && estado_cob2 == 'temp_cob2'){

                var tipo_pago2 = document.getElementById('tipo_pago2').value;
                var pagado2 = document.getElementById('pagado2').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago2 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado2) - parseFloat(pagado2/1.04);
                    $("#no_pago").val(1);
                    $("#pago_2").val(0);
                    $("#pago2").val(vacio);
                    $("#tipo_pago2").val(vacio);
                    $("#pagado2").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob2').value = "";
                    //document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();

                }

                if(tipo_pago2 == 'CREDIT CARD NO FEE' || tipo_pago2 == 'CASH' || tipo_pago2 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(1);
                    $("#pago_2").val(0);
                    $("#pago2").val(vacio);
                    $("#tipo_pago2").val(vacio);
                    $("#pagado2").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob2').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();

                }


            }


            if(no_pago == '3' && estado_cob3 == 'temp_cob3'){

                var tipo_pago3 = document.getElementById('tipo_pago3').value;
                var pagado3 = document.getElementById('pagado3').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago3 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado3) - parseFloat(pagado3/1.04);
                    $("#no_pago").val(2);
                    $("#pago_3").val(0);
                    $("#pago3").val(vacio);
                    $("#tipo_pago3").val(vacio);
                    $("#pagado3").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob3').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();

                }

                if(tipo_pago3 == 'CREDIT CARD NO FEE' || tipo_pago3 == 'CASH' || tipo_pago3 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(2);
                    $("#pago_3").val(0);
                    $("#pago3").val(vacio);
                    $("#tipo_pago3").val(vacio);
                    $("#pagado3").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob3').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();

                }


            }

            if(no_pago == '4' && estado_cob4 == 'temp_cob4'){

                var tipo_pago4 = document.getElementById('tipo_pago4').value;
                var pagado4 = document.getElementById('pagado4').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago4 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado4) - parseFloat(pagado4/1.04);
                    $("#no_pago").val(3);
                    $("#pago_4").val(0);
                    $("#pago4").val(vacio);
                    $("#tipo_pago4").val(vacio);
                    $("#pagado4").val(cero);
                    $("#pago_driver4").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob4').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();

                }

                if(tipo_pago4 == 'CREDIT CARD NO FEE' || tipo_pago4 == 'CASH' || tipo_pago4 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(3);
                    $("#pago_4").val(0);
                    $("#pago4").val(vacio);
                    $("#tipo_pago4").val(vacio);
                    $("#pagado4").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob4').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();

                }


            }

            if(no_pago == '5' && estado_cob5 == 'temp_cob5'){

                var tipo_pago5 = document.getElementById('tipo_pago5').value;
                var pagado5 = document.getElementById('pagado5').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago5 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado5) - parseFloat(pagado5/1.04);
                    $("#no_pago").val(4);
                    $("#pago_5").val(0);
                    $("#pago5").val(vacio);
                    $("#tipo_pago5").val(vacio);
                    $("#pagado5").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob5').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pago5 == 'CREDIT CARD NO FEE' || tipo_pago5 == 'CASH' || tipo_pago5 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(4);
                    $("#pago_5").val(0);
                    $("#pago5").val(vacio);
                    $("#tipo_pago5").val(vacio);
                    $("#pagado5").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob5').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }


            }

            if(no_pago == '6' && estado_cob6 == 'temp_cob6'){

                var tipo_pago6 = document.getElementById('tipo_pago6').value;
                var pagado6 = document.getElementById('pagado6').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago6 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado6) - parseFloat(pagado6/1.04);
                    $("#no_pago").val(5);
                    $("#pago_6").val(0);
                    $("#pago6").val(vacio);
                    $("#tipo_pago6").val(vacio);
                    $("#pagado6").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob6').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pago6 == 'CREDIT CARD NO FEE' || tipo_pago6 == 'CASH' || tipo_pago6 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(5);
                    $("#pago_6").val(0);
                    $("#pago6").val(vacio);
                    $("#tipo_pago6").val(vacio);
                    $("#pagado6").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob6').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();
                }


            }

            if(no_pago == '7' && estado_cob7 == 'temp_cob7'){

                var tipo_pago7 = document.getElementById('tipo_pago7').value;
                var pagado7 = document.getElementById('pagado7').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago7 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado7) - parseFloat(pagado7/1.04);
                    $("#no_pago").val(6);
                    $("#pago_7").val(0);
                    $("#pago7").val(vacio);
                    $("#tipo_pago7").val(vacio);
                    $("#pagado7").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob7').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pago7 == 'CREDIT CARD NO FEE' || tipo_pago7 == 'CASH' || tipo_pago7 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(6);
                    $("#pago_7").val(0);
                    $("#pago7").val(vacio);
                    $("#tipo_pago7").val(vacio);
                    $("#pagado7").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob7').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }


            }

            if(no_pago == '8' && estado_cob8 == 'temp_cob8'){

                var tipo_pago8 = document.getElementById('tipo_pago8').value;
                var pagado8 = document.getElementById('pagado8').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago8 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado8) - parseFloat(pagado8/1.04);
                    $("#no_pago").val(7);
                    $("#pago_8").val(0);
                    $("#pago8").val(vacio);
                    $("#tipo_pago8").val(vacio);
                    $("#pagado8").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob8').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pago8 == 'CREDIT CARD NO FEE' || tipo_pago8 == 'CASH' || tipo_pago8 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(7);
                    $("#pago_8").val(0);
                    $("#pago8").val(vacio);
                    $("#tipo_pago8").val(vacio);
                    $("#pagado8").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob8').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }


            }

            if(no_pago == '9' && estado_cob9 == 'temp_cob9'){

                var tipo_pago9 = document.getElementById('tipo_pago9').value;
                var pagado9 = document.getElementById('pagado9').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago9 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado9) - parseFloat(pagado9/1.04);
                    $("#no_pago").val(8);
                    $("#pago_9").val(0);
                    $("#pago9").val(vacio);
                    $("#tipo_pago9").val(vacio);
                    $("#pagado9").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob9').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pago9 == 'CREDIT CARD NO FEE' || tipo_pago9 == 'CASH' || tipo_pago9 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(8);
                    $("#pago_9").val(0);
                    $("#pago9").val(vacio);
                    $("#tipo_pago9").val(vacio);
                    $("#pagado9").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob9').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }


            }

            if(no_pago == '10' && estado_cob10 == 'temp_cob10'){

                var tipo_pago10 = document.getElementById('tipo_pago10').value;
                var pagado10 = document.getElementById('pagado10').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());

                var vacio = '';
                var cero = '0.00';


                if(tipo_pago10 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagado10) - parseFloat(pagado10/1.04);
                    $("#no_pago").val(9);
                    $("#pago_10").val(0);
                    $("#pago10").val(vacio);
                    $("#tipo_pago10").val(vacio);
                    $("#pagado10").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob10').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pago10 == 'CREDIT CARD NO FEE' || tipo_pago10 == 'CASH' || tipo_pago10 == 'CHECK'){

                    var temporal = 0;
                    $("#no_pago").val(9);
                    $("#pago_10").val(0);
                    $("#pago10").val(vacio);
                    $("#tipo_pago10").val(vacio);
                    $("#pagado10").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_cob10').value = "";
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
					$('#vent1').show();
                }


            }


        }



    }
</script>



<script type="text/javascript">

    function declinar()
    {


        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        var pay_amount = document.getElementById('pay_amount').value;
        var no_prep = document.getElementById('no_prep').value;
        var pago_driver2 = document.getElementById('pago_driver2').value;
        var prepaid = document.getElementById('prepaid').value;
        var temp_prepaid = document.getElementById('temp_prepaid').value;
        var temp_driver = document.getElementById('temp_driver').value;


        var estado_pre1 = document.getElementById('estado_pre1').value;
        var estado_pre2 = document.getElementById('estado_pre2').value;
        var estado_pre3 = document.getElementById('estado_pre3').value;
        var estado_pre4 = document.getElementById('estado_pre4').value;
        var estado_pre5 = document.getElementById('estado_pre5').value;
        var estado_pre6 = document.getElementById('estado_pre6').value;
        var estado_pre7 = document.getElementById('estado_pre7').value;
        var estado_pre8 = document.getElementById('estado_pre8').value;
        var estado_pre9 = document.getElementById('estado_pre9').value;
        var estado_pre10 = document.getElementById('estado_pre10').value;

        if(pay_amount == '0.00'){

            rever_prepaid();

        }

        //PREPAID (SI HAY PAGOS PREPAGADOS)

        if(pay_amount > "0.00"){


            if(no_prep == '1' && estado_pre1 == 'temp_pre1'){


                var vacio = "";
                var cero ='0.00';

                $("#no_prep").val(0);
                $("#pago_pre1").val(0);
                $("#pagopre1").val(vacio);
                $("#tipo_pagopre1").val(vacio);
                $("#pagadopre1").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((0).toFixed(2));
                $("#temp").val((0).toFixed(2));
                //$("#estado_pre1").val(vacio);
                document.getElementById('estado_pre1').value = "";
                document.getElementById('btnPagolinea').style.display = 'none';

                CalcularTotalTotal();

                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btncancol").style.display = "none";
                document.getElementById("btnAceptar").disabled = true;
                document.getElementById("btnAceptar").style.background = "lightgray";
                ventana2.style.display = "none"; // Y lo hacemos invisible
				$('#vent1').show();
            }

            if(no_prep == '2' && estado_pre2 == 'temp_pre2'){

                var tipo_pagopre2 = document.getElementById('tipo_pagopre2').value;
                var pagadopre2 = document.getElementById('pagadopre2').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre2 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre2) - parseFloat(pagadopre2/1.04);

                    $("#no_prep").val(1);
                    $("#pago_pre2").val(0);
                    $("#pagopre2").val(vacio);
                    $("#tipo_pagopre2").val(vacio);
                    $("#pagadopre2").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre2').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre2 == 'CREDIT CARD NO FEE' || tipo_pagopre2 == 'CASH' || tipo_pagopre2 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(1);
                    $("#pago_pre2").val(0);
                    $("#pagopre2").val(vacio);
                    $("#tipo_pagopre2").val(vacio);
                    $("#pagadopre2").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre2').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }


            }

            if(no_prep == '3' && estado_pre3 == 'temp_pre3'){

                var tipo_pagopre3 = document.getElementById('tipo_pagopre3').value;
                var pagadopre3 = document.getElementById('pagadopre3').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre3 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre3) - parseFloat(pagadopre3/1.04);

                    $("#no_prep").val(2);
                    $("#pago_pre3").val(0);
                    $("#pagopre3").val(vacio);
                    $("#tipo_pagopre3").val(vacio);
                    $("#pagadopre3").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre3').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre3 == 'CREDIT CARD NO FEE' || tipo_pagopre3 == 'CASH' || tipo_pagopre3 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(2);
                    $("#pago_pre3").val(0);
                    $("#pagopre3").val(vacio);
                    $("#tipo_pagopre3").val(vacio);
                    $("#pagadopre3").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre3').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '4' && estado_pre4 == 'temp_pre4'){

                var tipo_pagopre4 = document.getElementById('tipo_pagopre4').value;
                var pagadopre4 = document.getElementById('pagadopre4').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre4 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre4) - parseFloat(pagadopre4/1.04);

                    $("#no_prep").val(3);
                    $("#pago_pre4").val(0);
                    $("#pagopre4").val(vacio);
                    $("#tipo_pagopre4").val(vacio);
                    $("#pagadopre4").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre4').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre4 == 'CREDIT CARD NO FEE' || tipo_pagopre4 == 'CASH' || tipo_pagopre4 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(3);
                    $("#pago_pre4").val(0);
                    $("#pagopre4").val(vacio);
                    $("#tipo_pagopre4").val(vacio);
                    $("#pagadopre4").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre4').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '5' && estado_pre5 == 'temp_pre5'){

                var tipo_pagopre5 = document.getElementById('tipo_pagopre5').value;
                var pagadopre5 = document.getElementById('pagadopre5').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre5 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre5) - parseFloat(pagadopre5/1.04);

                    $("#no_prep").val(4);
                    $("#pago_pre5").val(0);
                    $("#pagopre5").val(vacio);
                    $("#tipo_pagopre5").val(vacio);
                    $("#pagadopre5").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre5').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre5 == 'CREDIT CARD NO FEE' || tipo_pagopre5 == 'CASH' || tipo_pagopre5 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(4);
                    $("#pago_pre5").val(0);
                    $("#pagopre5").val(vacio);
                    $("#tipo_pagopre5").val(vacio);
                    $("#pagadopre5").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre5').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '6' && estado_pre6 == 'temp_pre6'){

                var tipo_pagopre6 = document.getElementById('tipo_pagopre6').value;
                var pagadopre6 = document.getElementById('pagadopre6').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre6 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre6) - parseFloat(pagadopre6/1.04);

                    $("#no_prep").val(5);
                    $("#pago_pre6").val(0);
                    $("#pagopre6").val(vacio);
                    $("#tipo_pagopre6").val(vacio);
                    $("#pagadopre6").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre6').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre6 == 'CREDIT CARD NO FEE' || tipo_pagopre6 == 'CASH' || tipo_pagopre6 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(5);
                    $("#pago_pre6").val(0);
                    $("#pagopre6").val(vacio);
                    $("#tipo_pagopre6").val(vacio);
                    $("#pagadopre6").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre6').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '7' && estado_pre7 == 'temp_pre7'){

                var tipo_pagopre7 = document.getElementById('tipo_pagopre7').value;
                var pagadopre7 = document.getElementById('pagadopre7').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre7 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre7) - parseFloat(pagadopre7/1.04);

                    $("#no_prep").val(6);
                    $("#pago_pre7").val(0);
                    $("#pagopre7").val(vacio);
                    $("#tipo_pagopre7").val(vacio);
                    $("#pagadopre7").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre7').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre7 == 'CREDIT CARD NO FEE' || tipo_pagopre7 == 'CASH' || tipo_pagopre7 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(6);
                    $("#pago_pre7").val(0);
                    $("#pagopre7").val(vacio);
                    $("#tipo_pagopre7").val(vacio);
                    $("#pagadopre7").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre7').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '8' && estado_pre8 == 'temp_pre8'){

                var tipo_pagopre8 = document.getElementById('tipo_pagopre8').value;
                var pagadopre8 = document.getElementById('pagadopre8').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre8 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre8) - parseFloat(pagadopre8/1.04);

                    $("#no_prep").val(7);
                    $("#pago_pre8").val(0);
                    $("#pagopre8").val(vacio);
                    $("#tipo_pagopre8").val(vacio);
                    $("#pagadopre8").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre8').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre8 == 'CREDIT CARD NO FEE' || tipo_pagopre8 == 'CASH' || tipo_pagopre8 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(7);
                    $("#pago_pre8").val(0);
                    $("#pagopre8").val(vacio);
                    $("#tipo_pagopre8").val(vacio);
                    $("#pagadopre8").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre8').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '9' && estado_pre9 == 'temp_pre9'){

                var tipo_pagopre9 = document.getElementById('tipo_pagopre9').value;
                var pagadopre9 = document.getElementById('pagadopre9').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre9 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre9) - parseFloat(pagadopre9/1.04);

                    $("#no_prep").val(8);
                    $("#pago_pre9").val(0);
                    $("#pagopre9").val(vacio);
                    $("#tipo_pagopre9").val(vacio);
                    $("#pagadopre9").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre9').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre9 == 'CREDIT CARD NO FEE' || tipo_pagopre9 == 'CASH' || tipo_pagopre9 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(8);
                    $("#pago_pre9").val(0);
                    $("#pagopre9").val(vacio);
                    $("#tipo_pagopre9").val(vacio);
                    $("#pagadopre9").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre9').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }

            if(no_prep == '10' && estado_pre10 == 'temp_pre10'){

                var tipo_pagopre10 = document.getElementById('tipo_pagopre10').value;
                var pagadopre10 = document.getElementById('pagadopre10').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());

                var vacio = '';
                var cero = '0.00';

                if(tipo_pagopre10 == 'CREDIT CARD WITH FEE'){

                    var temporal = parseFloat(pagadopre10) - parseFloat(pagadopre10/1.04);

                    $("#no_prep").val(9);
                    $("#pago_pre10").val(0);
                    $("#pagopre10").val(vacio);
                    $("#tipo_pagopre10").val(vacio);
                    $("#pagadopre10").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre10').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

                if(tipo_pagopre10 == 'CREDIT CARD NO FEE' || tipo_pagopre10 == 'CASH' || tipo_pagopre10 == 'CHECK'){

                    var temporal = 0;
                    $("#no_prep").val(9);
                    $("#pago_pre10").val(0);
                    $("#pagopre10").val(vacio);
                    $("#tipo_pagopre10").val(vacio);
                    $("#pagadopre10").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));
                    $("#temp").val((temp-temporal).toFixed(2));
                    document.getElementById('estado_pre10').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    CalcularTotalTotal();

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    $('#vent1').show();
                }

            }


        }



    }

</script>


<script type="text/javascript">

    function rever_collect_on_board(){

//      var no_prep =  document.getElementById("no_prep").value;
        var no_pago =  document.getElementById("no_pago").value;
        var pago_1 = document.getElementById("pago_1").value;
        var pago_2 = document.getElementById("pago_2").value;
        var pago_3 = document.getElementById("pago_3").value;
        var pago_4 = document.getElementById("pago_4").value;
        var pago_5 = document.getElementById("pago_5").value;
        var pago_6 = document.getElementById("pago_6").value;
        var pago_7 = document.getElementById("pago_7").value;
        var pago_8 = document.getElementById("pago_8").value;
        var pago_9 = document.getElementById("pago_9").value;
        var pago_10 = document.getElementById("pago_10").value;

        var estado_cob1 = document.getElementById("estado_cob1").value;
        var estado_cob2 = document.getElementById("estado_cob2").value;
        var estado_cob3 = document.getElementById("estado_cob3").value;
        var estado_cob4 = document.getElementById("estado_cob4").value;
        var estado_cob5 = document.getElementById("estado_cob5").value;
        var estado_cob6 = document.getElementById("estado_cob6").value;
        var estado_cob7 = document.getElementById("estado_cob7").value;
        var estado_cob8 = document.getElementById("estado_cob8").value;
        var estado_cob9 = document.getElementById("estado_cob9").value;
        var estado_cob10 = document.getElementById("estado_cob10").value;
        var temp_prepaid = document.getElementById("temp_prepaid").value;

//      document.getElementById('prepaid').value = "0.00";
//      document.getElementById('temp_prepaid').value = "0.00";


        var pay_amount = document.getElementById('pay_amount').value;
        document.getElementById('pago_driver').value = "0.00";
        document.getElementById('paid_driver').value = "0.00";

        //actualizacion

        if(no_pago == 0){
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            document.getElementById('trian9').style.display = 'none';
            document.getElementById('trian10').style.display = 'none';
        }

        if(no_pago == 1){

            document.getElementById('trian1').style.display = 'none';
        }

        if(no_pago == 2){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';

        }

        if(no_pago == 3){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';

        }

        if(no_pago == 4){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';

        }

        if(no_pago == 5){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';

        }

        if(no_pago == 6){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';

        }

        if(no_pago == 7){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';

        }

        if(no_pago == 8){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';

        }

        if(no_pago == 9){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            document.getElementById('trian9').style.display = 'none';

        }

        if(no_pago == 10){

            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            document.getElementById('trian9').style.display = 'none';
            document.getElementById('trian10').style.display = 'none';

        }

        //old

        if(pago_1 == 1){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_1').value = '0';
            document.getElementById('pago1').value = '';
            document.getElementById('tipo_pago1').value = '';
            document.getElementById('pagado1').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }


        }
        if(pago_2 == 2){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_2').value = '0';
            document.getElementById('pago2').value = '';
            document.getElementById('tipo_pago2').value = '';
            document.getElementById('pagado2').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_3 == 3){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_3').value = '0';
            document.getElementById('pago3').value = '';
            document.getElementById('tipo_pago3').value = '';
            document.getElementById('pagado3').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_4 == 4){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_4').value = '0';
            document.getElementById('pago4').value = '';
            document.getElementById('tipo_pago4').value = '';
            document.getElementById('pagado4').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_5 == 5){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_5').value = '0';
            document.getElementById('pago5').value = '';
            document.getElementById('tipo_pago5').value = '';
            document.getElementById('pagado5').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_6 == 6){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_6').value = '0';
            document.getElementById('pago6').value = '';
            document.getElementById('tipo_pago6').value = '';
            document.getElementById('pagado6').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_7 == 7){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_7').value = '0';
            document.getElementById('pago7').value = '';
            document.getElementById('tipo_pago7').value = '';
            document.getElementById('pagado7').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_8 == 8){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_8').value = '0';
            document.getElementById('pago8').value = '';
            document.getElementById('tipo_pago8').value = '';
            document.getElementById('pagado8').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            document.getElementById("estado_cob8").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_9 == 9){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_9').value = '0';
            document.getElementById('pago9').value = '';
            document.getElementById('tipo_pago9').value = '';
            document.getElementById('pagado9').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            document.getElementById("estado_cob8").value= '';
            document.getElementById("estado_cob9").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }
        if(pago_10 == 10){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_10').value = '0';
            document.getElementById('pago10').value = '';
            document.getElementById('tipo_pago10').value = '';
            document.getElementById('pagado10').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            document.getElementById("estado_cob8").value= '';
            document.getElementById("estado_cob9").value= '';
            document.getElementById("estado_cob10").value= '';

            if(pay_amount == '0.00'){
            document.getElementById('temp').value = '0.00';
            }
            if(pay_amount > '0.00'){
                document.getElementById('temp').value = temp_prepaid;
            }

        }

       document.getElementById('collect').value = '0.00';
       document.getElementById('pago_driver2').value = '0.00';
       //document.getElementById('temp').value = '0.00';
       document.getElementById('temp_driver').value = '0.00';

       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00";
       document.getElementById('pago_tarjeta').value = "0.00";
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none";
       document.getElementById("btncancol").style.display = "none";
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";

       //document.getElementById('paid_driver').className = "brown3";
       //$("#pago_driver").focus();


     CalcularTotalTotal();
     document.getElementById('btn_rever_cob').style.display = "none";

//     resetal();
//     reset2();
//     ocultarVentana2();


    }
</script>

<script type="text/javascript">
    function rever_prepaid(){

    var no_prep =  $("#no_prep").val();
    var pago_pre1 = $("#pago_pre1").val();
    var pago_pre2 = $("#pago_pre2").val();
    var pago_pre3 = $("#pago_pre3").val();
    var pago_pre4 = $("#pago_pre4").val();
    var pago_pre5 = $("#pago_pre5").val();
    var pago_pre6 = $("#pago_pre6").val();
    var pago_pre7 = $("#pago_pre7").val();
    var pago_pre8 = $("#pago_pre8").val();
    var pago_pre9 = $("#pago_pre9").val();
    var pago_pre10 = $("#pago_pre10").val();
    var estado_pre1 = $("#estado_pre1").val();
    var estado_pre2 = $("#estado_pre2").val();
    var estado_pre3 = $("#estado_pre3").val();
    var estado_pre4 = $("#estado_pre4").val();
    var estado_pre5 = $("#estado_pre5").val();
    var estado_pre6 = $("#estado_pre6").val();
    var estado_pre7 = $("#estado_pre7").val();
    var estado_pre8 = $("#estado_pre8").val();
    var estado_pre9 = $("#estado_pre9").val();
    var estado_pre10 = $("#estado_pre10").val();
    var paid_driver = document.getElementById('paid_driver').value;
    var temp_driver = document.getElementById('temp_driver').value;




//  var no_pago =  document.getElementById("no_pago").value;

    document.getElementById('prepaid').value = "0.00";
    document.getElementById('temp_prepaid').value = "0.00";
    document.getElementById('pay_amount').value = "0.00";
//  document.getElementById('paid_driver').value = "0.00";
//    document.getElementById('pago_driver').value = "0.00";

        if(no_prep == 0){
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            document.getElementById('cir9').style.display = 'none';
            document.getElementById('cir10').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
        }

        if(no_prep == 1){

            document.getElementById('cir1').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 2){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 3){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 4){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 5){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 6){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 7){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 8){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 9){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            document.getElementById('cir9').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }

        if(no_prep == 10){

            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            document.getElementById('cir9').style.display = 'none';
            document.getElementById('cir10').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";

        }



        //old

        if(pago_pre1 == 1){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre1').value = '0';
            document.getElementById('pagopre1').value = '';
            document.getElementById('tipo_pagopre1').value = '';
            document.getElementById('pagadopre1').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';

            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }


        }
        if(pago_pre2 == 2){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre2').value = '0';
            document.getElementById('pagopre2').value = '';
            document.getElementById('tipo_pagopre2').value = '';
            document.getElementById('pagadopre2').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }

        }
        if(pago_pre3 == 3){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre3').value = '0';
            document.getElementById('pagopre3').value = '';
            document.getElementById('tipo_pagopre3').value = '';
            document.getElementById('pagadopre3').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }

        }
        if(pago_pre4 == 4){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre4').value = '0';
            document.getElementById('pagopre4').value = '';
            document.getElementById('tipo_pagopre4').value = '';
            document.getElementById('pagadopre4').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }

        }
        if(pago_pre5 == 5){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre5').value = '0';
            document.getElementById('pagopre5').value = '';
            document.getElementById('tipo_pagopre5').value = '';
            document.getElementById('pagadopre5').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }

        }
        if(pago_pre6 == 6){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre6').value = '0';
            document.getElementById('pagopre6').value = '';
            document.getElementById('tipo_pagopre6').value = '';
            document.getElementById('pagadopre6').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }


        }
        if(pago_pre7 == 7){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre7').value = '0';
            document.getElementById('pagopre7').value = '';
            document.getElementById('tipo_pagopre7').value = '';
            document.getElementById('pagadopre7').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }


        }
        if(pago_pre8 == 8){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre8').value = '0';
            document.getElementById('pagopre8').value = '';
            document.getElementById('tipo_pagopre8').value = '';
            document.getElementById('pagadopre8').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            document.getElementById("estado_pre8").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }


        }
        if(pago_pre9 == 9){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre9').value = '0';
            document.getElementById('pagopre9').value = '';
            document.getElementById('tipo_pagopre9').value = '';
            document.getElementById('pagadopre9').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            document.getElementById("estado_pre8").value= '';
            document.getElementById("estado_pre9").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }

        }
        if(pago_pre10 == 10){

            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre10').value = '0';
            document.getElementById('pagopre10').value = '';
            document.getElementById('tipo_pagopre10').value = '';
            document.getElementById('pagadopre10').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            document.getElementById("estado_pre8").value= '';
            document.getElementById("estado_pre9").value= '';
            document.getElementById("estado_pre10").value= '';

            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){
                document.getElementById('temp').value = temp_driver;
            }

        }


        document.getElementById('prepaid').value = '0.00';
        //document.getElementById('temp').value = '0.00';
        document.getElementById('temp_prepaid').value = '0.00';
        document.getElementById('pago_driver2').value = '0.00';
        document.getElementById("pago_driver").disabled = false;
        document.getElementById('pago_driver').placeholder = "0.00";
        document.getElementById('pago_tarjeta').value = "0.00";
        document.getElementById("btnPagolinea").disabled = true;
        document.getElementById("btnPagolinea").style.display = "none";
        document.getElementById("btndecline").style.display = "none";
        document.getElementById("btncancol").style.display = "none";
        document.getElementById("btnAceptar").disabled = true;
        document.getElementById("btnAceptar").style.background = "lightgray";
        //document.getElementById('pay_amount').className = "azu";
//      document.getElementById('paid_driver').className = "brown3";
//      $("#pago_driver").focus();


        CalcularTotalTotal();
        document.getElementById('btn_rever_prepaid').style.display = "none";
//        resetal();
//        reset2();
//        ocultarVentana2();

    }
</script>

<script type="text/javascript">

 function Salir()

    {

        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        var paid_driver = document.getElementById('paid_driver').value;
        var pay_amount = document.getElementById('pay_amount').value;

        var no_prep = document.getElementById('no_prep').value;
        var no_pago = document.getElementById('no_pago').value;

        var pago_pre2 = document.getElementById('pago_pre2').value;
        var pago_driver2 = document.getElementById('pago_driver2').value;
        var prepaid = document.getElementById('prepaid').value;
        var collect = document.getElementById('collect').value;

        var temp_prepaid = document.getElementById('temp_prepaid').value;
        var temp_driver = document.getElementById('temp_driver').value;
        var pagadopre1 = document.getElementById('pagadopre1').value;
        var pagado1 = document.getElementById('pagado1').value;

        var estado_pre1 = document.getElementById('estado_pre1').value;
        var estado_pre2 = document.getElementById('estado_pre2').value;
        var estado_pre3 = document.getElementById('estado_pre3').value;
        var estado_pre4 = document.getElementById('estado_pre4').value;
        var estado_pre5 = document.getElementById('estado_pre5').value;
        var estado_pre6 = document.getElementById('estado_pre6').value;
        var estado_pre7 = document.getElementById('estado_pre7').value;
        var estado_pre8 = document.getElementById('estado_pre8').value;
        var estado_pre9 = document.getElementById('estado_pre9').value;
        var estado_pre10 = document.getElementById('estado_pre10').value;

        var estado_cob1 = document.getElementById('estado_cob1').value;
        var estado_cob2 = document.getElementById('estado_cob2').value;
        var estado_cob3 = document.getElementById('estado_cob3').value;
        var estado_cob4 = document.getElementById('estado_cob4').value;
        var estado_cob5 = document.getElementById('estado_cob5').value;
        var estado_cob6 = document.getElementById('estado_cob6').value;
        var estado_cob7 = document.getElementById('estado_cob7').value;
        var estado_cob8 = document.getElementById('estado_cob8').value;
        var estado_cob9 = document.getElementById('estado_cob9').value;
        var estado_cob10 = document.getElementById('estado_cob10').value;

        var tempo_prepaid = pay_amount - (pay_amount/1.04);
        var prepagado = prepaid - pagadopre1;
        var prepagad = prepaid  - pago_driver2;


        var tempo_driver = paid_driver - (paid_driver/1.04);
        var cob = collect - pagado1;
        var collected = collect - pago_driver2;


        var temp_total = tempo_prepaid + tempo_driver;

        document.getElementById("btndecline").style.display = "none";
        document.getElementById("btncancol").style.display = "none";
        document.getElementById("btnAceptar").disabled = true;
        document.getElementById("btnAceptar").style.background = "lightgray";
        ventana2.style.display = 'none'; // Y lo hacemos invisible
        $('#vent1').show();

        //alert(paid_driver);

        if(paid_driver == '0.00'){

            rever_collect_on_board();

        }

        //alert(pay_amount);

        if(pay_amount == '0.00'){

            rever_prepaid();

        }

        //COLLECT ON BOARD (SI HAY PAGOS AL CONDUCTOR)

        if(paid_driver > '0.00'){

            var vacio = "";
            var cero ='0.00';

            if(no_pago == '1' && estado_cob1 == 'temp_cob1'){

                $("#no_pago").val(0);
                $("#pago_1").val(0);
                $("#pago1").val(vacio);
                $("#tipo_pago1").val(vacio);
                $("#pagado1").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob1").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";
                CalcularTotalTotal();

            }

            if(no_pago == '2' && estado_cob2 == 'temp_cob2'){

                $("#no_pago").val(1);
                $("#pago_2").val(0);
                $("#pago2").val(vacio);
                $("#tipo_pago2").val(vacio);
                $("#pagado2").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob2").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }

            if(no_pago == '3' && estado_cob3 == 'temp_cob3'){

                $("#no_pago").val(2);
                $("#pago_3").val(0);
                $("#pago3").val(vacio);
                $("#tipo_pago3").val(vacio);
                $("#pagado3").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob3").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }

            if(no_pago == '4' && estado_cob4 == 'temp_cob4'){

                $("#no_pago").val(3);
                $("#pago_4").val(0);
                $("#pago4").val(vacio);
                $("#tipo_pago4").val(vacio);
                $("#pagado4").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob4").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }

            if(no_pago == '5' && estado_cob5 == 'temp_cob5'){

                $("#no_pago").val(4);
                $("#pago_5").val(0);
                $("#pago5").val(vacio);
                $("#tipo_pago5").val(vacio);
                $("#pagado5").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob5").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }

            if(no_pago == '6' && estado_cob6 == 'temp_cob6'){

                $("#no_pago").val(5);
                $("#pago_6").val(0);
                $("#pago6").val(vacio);
                $("#tipo_pago6").val(vacio);
                $("#pagado6").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob6").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();


            }

            if(no_pago == '7' && estado_cob7 == 'temp_cob7'){

                $("#no_pago").val(6);
                $("#pago_7").val(0);
                $("#pago7").val(vacio);
                $("#tipo_pago7").val(vacio);
                $("#pagado7").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob7").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }

            if(no_pago == '8' && estado_cob8 == 'temp_cob8'){

                $("#no_pago").val(7);
                $("#pago_8").val(0);
                $("#pago8").val(vacio);
                $("#tipo_pago8").val(vacio);
                $("#pagado8").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob8").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();


            }

            if(no_pago == '9' && estado_cob9 == 'temp_cob9'){

                $("#no_pago").val(8);
                $("#pago_9").val(0);
                $("#pago9").val(vacio);
                $("#tipo_pago9").val(vacio);
                $("#pagado9").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob9").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }

            if(no_pago == '10' && estado_cob10 == 'temp_cob10'){

                $("#no_pago").val(9);
                $("#pago_10").val(0);
                $("#pago10").val(vacio);
                $("#tipo_pago10").val(vacio);
                $("#pagado10").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#pago_driver").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                $("#temp_driver").val((tempo_driver).toFixed(2));
                //$("#temp").val((tempo_driver).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_cob10").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();

            }





        }


        //PREPAID (SI HAY PAGOS PREPAGADOS)

        if(pay_amount > '0.00'){

            var vacio = "";
            var cero ='0.00';

            if(no_prep == '1' && estado_pre1 == 'temp_pre1'){


                $("#no_prep").val(0);
                $("#pago_pre1").val(0);
                $("#pagopre1").val(vacio);
                $("#tipo_pagopre1").val(vacio);
                $("#pagadopre1").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre1").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '2' && estado_pre2 == 'temp_pre2'){


                $("#no_prep").val(1);
                $("#pago_pre2").val(0);
                $("#pagopre2").val(vacio);
                $("#tipo_pagopre2").val(vacio);
                $("#pagadopre2").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre2").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '3' && estado_pre3 == 'temp_pre3'){

                $("#no_prep").val(2);
                $("#pago_pre3").val(0);
                $("#pagopre3").val(vacio);
                $("#tipo_pagopre3").val(vacio);
                $("#pagadopre3").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre3").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '4' && estado_pre4 == 'temp_pre4'){

                $("#no_prep").val(3);
                $("#pago_pre4").val(0);
                $("#pagopre4").val(vacio);
                $("#tipo_pagopre4").val(vacio);
                $("#pagadopre4").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre4").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '5' && estado_pre5 == 'temp_pre5'){

                $("#no_prep").val(4);
                $("#pago_pre5").val(0);
                $("#pagopre5").val(vacio);
                $("#tipo_pagopre5").val(vacio);
                $("#pagadopre5").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre5").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '6' && estado_pre6 == 'temp_pre6'){

                $("#no_prep").val(5);
                $("#pago_pre6").val(0);
                $("#pagopre6").val(vacio);
                $("#tipo_pagopre6").val(vacio);
                $("#pagadopre6").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre6").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '7' && estado_pre7 == 'temp_pre7'){

                $("#no_prep").val(6);
                $("#pago_pre7").val(0);
                $("#pagopre7").val(vacio);
                $("#tipo_pagopre7").val(vacio);
                $("#pagadopre7").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre7").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '8' && estado_pre8 == 'temp_pre8'){

                $("#no_prep").val(7);
                $("#pago_pre8").val(0);
                $("#pagopre8").val(vacio);
                $("#tipo_pagopre8").val(vacio);
                $("#pagadopre8").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre8").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '9' && estado_pre9 == 'temp_pre9'){

                $("#no_prep").val(8);
                $("#pago_pre9").val(0);
                $("#pagopre9").val(vacio);
                $("#tipo_pagopre9").val(vacio);
                $("#pagadopre9").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre9").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

            if(no_prep == '10' && estado_pre10 == 'temp_pre10'){

                $("#no_prep").val(9);
                $("#pago_pre10").val(0);
                $("#pagopre10").val(vacio);
                $("#tipo_pagopre10").val(vacio);
                $("#pagadopre10").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);
                $("#temp_prepaid").val((tempo_prepaid).toFixed(2));
                //$("#temp").val((tempo_prepaid).toFixed(2));
                $("#temp").val((temp_total).toFixed(2));
                $("#estado_pre10").val(vacio);
                document.getElementById('pago_driver').placeholder = "0.00";

                CalcularTotalTotal();
            }

        }


    }
</script>

<script type="text/javascript">
    function Exit()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor

        document.getElementById("btndecline").style.display = "none";
        document.getElementById("btncancol").style.display = "none";
        document.getElementById("btnAceptar").disabled = true;
        document.getElementById("btnAceptar").style.background = "lightgray";
        ventana2.style.display = 'none'; // Y lo hacemos invisible
        $('#vent1').show();


    }
</script>


<script type="text/javascript">
    function Exit2()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.display = 'none'; // Y lo hacemos invisible
		$('#vent1').show();
        //resetal();
        mostrarVentana2();

    }
</script>

<script type="text/javascript">
    function ClkPay_Amount()
    {

        var clone = document.getElementById('otheramount').value;

        if (clone == '') {

            document.getElementById('otheramount').value = '0.00';
        }

        if (clone == '0.0') {

            document.getElementById('otheramount').value = '0.00';
        }

        document.getElementById('saldoporpagar').value = clone;

        if (clone == '0.') {

            document.getElementById('otheramount').value = '0.00';
        }


        if (clone == '0') {

            document.getElementById('otheramount').value = '0.00';
        }
        setTimeout(function () {
            //$('#paid_driver').click();
            CalcularTotalTotal();

        }, 0.001);


    }
</script>


<script type="text/javascript">
    function aplicar_pago() {
        //alert('mostrar');
        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor

        var totalPagar = document.getElementById('totalPagar').value;

//        alert(totalPagar);
        ventana.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
        ventana.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
        ventana.style.display = 'block'; // Y lo hacemos visible
		$('#vent1').hide();
    }
    function ocultarVentana()
    {
        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
        ventana.style.display = 'none'; // Y lo hacemos invisible
        var opcion_pago_2 = $('#opcion_pago_2').val();
        var aplica_pago = $('#aplica_pago').val();
$('#vent1').show();
        // document.getElementById('pay_amount').value = aplica_pago;
        //var resultados = prueba + opcion_pago_2;
        //alert(opcion_pago_2);
    }
    //document.getElementById('otheramount').value = totalPagar;
</script>

<script type="text/javascript">
    function pago_driver() {
//        alert('mostrar');
//        exit();

        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//        ventana2.style.marginTop = "275px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
//        //ventana2.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
//        ventana2.style.marginLeft = "768.4px"; // Definimos su posición horizontal
        ventana2.style.display = 'block'; // Y lo hacemos visible
//        ventana2.style.position = 'absolute';

        $("#pago_driver").focus();

        document.getElementById('pago_driver').value = '';
        document.getElementById('pago_driver').style.color = '#848484';
        document.getElementById('pago_driver').style.background = '#fff';

        document.getElementById('op_pago_id1').value = 0;
        document.getElementById('op_pago_id').value = 8;
        document.getElementById('op_pago_id2').value = 2;

        document.getElementById("pago_driver").disabled = false;

        document.getElementById('btnAceptar').style.background = '';

        document.getElementById('btnAceptar').style.color = '#000';

        document.getElementById('btnAceptar').style.cursor = '';



        //$('#pago_driver').val()='0.00';
    }

    function ocultarVentana2()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor

        var opcion_pago = $('#opcion_pago_id').val();
        var pago_driver = $('#pago_driver').val();
        var collect = $('#collect').val();
        var prepaid = $('#prepaid').val();

        var opcion = $("#op_pago_id1").val();
        var no_prep =  document.getElementById('no_prep').value;
        var no_pago =  document.getElementById('no_pago').value;

        var pago_pre1 = document.getElementById('pago_pre1').value;
        var pago_pre2 = document.getElementById('pago_pre2').value;
        var pago_pre3 = document.getElementById('pago_pre3').value;
        var pago_pre4 = document.getElementById('pago_pre4').value;
        var pago_pre5 = document.getElementById('pago_pre5').value;
        var pago_pre6 = document.getElementById('pago_pre6').value;
        var pago_pre7 = document.getElementById('pago_pre7').value;
        var pago_pre8 = document.getElementById('pago_pre8').value;
        var pago_pre9 = document.getElementById('pago_pre9').value;
        var pago_pre10 = document.getElementById('pago_pre10').value;

        var tipo_pagopre1 = document.getElementById('tipo_pagopre1').value;
        var tipo_pagopre2 = document.getElementById('tipo_pagopre2').value;
        var tipo_pagopre3 = document.getElementById('tipo_pagopre3').value;
        var tipo_pagopre4 = document.getElementById('tipo_pagopre4').value;
        var tipo_pagopre5 = document.getElementById('tipo_pagopre5').value;
        var tipo_pagopre6 = document.getElementById('tipo_pagopre6').value;
        var tipo_pagopre7 = document.getElementById('tipo_pagopre7').value;
        var tipo_pagopre8 = document.getElementById('tipo_pagopre8').value;
        var tipo_pagopre9 = document.getElementById('tipo_pagopre9').value;
        var tipo_pagopre10 = document.getElementById('tipo_pagopre10').value;


        var pago1 = document.getElementById('pago1').value;
        var pago2 = document.getElementById('pago2').value;
        var pago3 = document.getElementById('pago3').value;
        var pago4 = document.getElementById('pago4').value;
        var pago5 = document.getElementById('pago5').value;
        var pago6 = document.getElementById('pago6').value;
        var pago7 = document.getElementById('pago7').value;
        var pago8 = document.getElementById('pago8').value;
        var pago9 = document.getElementById('pago9').value;
        var pago10 = document.getElementById('pago10').value;


        var tipo_pago1 = document.getElementById('tipo_pago1').value;
        var tipo_pago2 = document.getElementById('tipo_pago2').value;
        var tipo_pago3 = document.getElementById('tipo_pago3').value;
        var tipo_pago4 = document.getElementById('tipo_pago4').value;
        var tipo_pago5 = document.getElementById('tipo_pago5').value;
        var tipo_pago6 = document.getElementById('tipo_pago6').value;
        var tipo_pago7 = document.getElementById('tipo_pago7').value;
        var tipo_pago8 = document.getElementById('tipo_pago8').value;
        var tipo_pago9 = document.getElementById('tipo_pago9').value;
        var tipo_pago10 = document.getElementById('tipo_pago10').value;

        //PRED-PAID////////////////////////////////////////////
        //Credit Card with fee

        if (opcion === '0') {

            document.getElementById('paid_driver').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                //$('#pay_amount').click();
                CalcularTotalTotal();

            }, 0.001);

            setTimeout(function () {
                //$('#paid_driver').click();
                CalcularTotalTotal();

            }, 0.001);

            $("#pago_driver").focus();

            //document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';



        }

        if (opcion === '1') {

            document.getElementById('paid_driver').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                //$('#pay_amount').click();
                CalcularTotalTotal();

            }, 0.001);

            setTimeout(function () {
                //$('#paid_driver').click();
                CalcularTotalTotal();
                //ocultarventana2

            }, 0.001);

            $("#pago_driver").focus();

        }

        //Pred-Paid

        //Credit Card no fee

        if (opcion === '20') {



            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    ////document.getElementById('pay_amount').style.color = "#FFFFFF";
                    ////document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('btn_rever_prepaid').style.display = "";
                    //document.getElementById('pay_amount').title ="Pago sin Guardar";
                    //make_charge();
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var tit = "CREDIT CARD NO FEE";
                    var pagadopre1 = document.getElementById('pagadopre1').value;
                    var pagadopre2 = document.getElementById('pagadopre2').value;
                    var pagadopre3 = document.getElementById('pagadopre3').value;
                    var pagadopre4 = document.getElementById('pagadopre4').value;
                    var pagadopre5 = document.getElementById('pagadopre5').value;
                    var pagadopre6 = document.getElementById('pagadopre6').value;
                    var pagadopre7 = document.getElementById('pagadopre7').value;
                    var pagadopre8 = document.getElementById('pagadopre8').value;
                    var pagadopre9 = document.getElementById('pagadopre9').value;
                    var pagadopre10 = document.getElementById('pagadopre10').value;

                    var titulo1 = tit + "\n" + "$" + pagadopre1;
                    var titulo2 = tit + "\n" + "$" + pagadopre2;
                    var titulo3 = tit + "\n" + "$" + pagadopre3;
                    var titulo4 = tit + "\n" + "$" + pagadopre4;
                    var titulo5 = tit + "\n" + "$" + pagadopre5;
                    var titulo6 = tit + "\n" + "$" + pagadopre6;
                    var titulo7 = tit + "\n" + "$" + pagadopre7;
                    var titulo8 = tit + "\n" + "$" + pagadopre8;
                    var titulo9 = tit + "\n" + "$" + pagadopre9;
                    var titulo10 = tit + "\n" + "$" + pagadopre10;

                    if(pago_pre1 == 0){
                        document.getElementById('cir1').title = "";
                    }

                    if(pago_pre1 == 1 && tipo_pagopre1 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir1').title = titulo1;
                    }

                    if(pago_pre2 == 2 && tipo_pagopre2 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir2').title = titulo2;
                    }


                    if(pago_pre3 == 3 && tipo_pagopre3 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir3').title = titulo3;
                    }

                    if(pago_pre4 == 4 && tipo_pagopre4 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir4').title = titulo4;
                    }

                    if(pago_pre5 == 5 && tipo_pagopre5 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir5').title = titulo5;
                    }

                    if(pago_pre6 == 6 && tipo_pagopre6 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir6').title = titulo6;
                    }

                    if(pago_pre7 == 7 && tipo_pagopre7 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir7').title = titulo7;
                    }

                    if(pago_pre8 == 8 && tipo_pagopre8 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir8').title = titulo8;
                    }

                    if(pago_pre9 == 9 && tipo_pagopre9 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir9').title = titulo9;
                    }

                    if(pago_pre10 == 10 && tipo_pagopre10 == "CREDIT CARD NO FEE"){
                        document.getElementById('cir10').title = titulo10;
                    }

                    if(no_prep == 1){

                            $("#estado_pre1").val("pagado_pre1");
                            document.getElementById('cir1').style.display = '';



                    }else if(no_prep == 2){

                            $("#estado_pre2").val("pagado_pre2");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';


                    }else if(no_prep == 3){

                            $("#estado_pre3").val("pagado_pre3");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';

                    }else if(no_prep == 4){

                            $("#estado_pre4").val("pagado_pre4");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';

                    }else if(no_prep == 5){

                            $("#estado_pre5").val("pagado_pre5");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';

                    }else if(no_prep == 6){

                            $("#estado_pre6").val("pagado_pre6");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';


                    }else if(no_prep == 7){

                            $("#estado_pre7").val("pagado_pre7");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';


                    }else if(no_prep == 8){

                            $("#estado_pre8").val("pagado_pre8");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';

                    }else if(no_prep == 9){

                            $("#estado_pre9").val("pagado_pre9");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';


                    }else if(no_prep == 10){

                            $("#estado_pre10").val("pagado_pre10");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';
                            document.getElementById('cir10').style.display = '';

                    }



                }, 0.001);

                $("#pago_driver").focus();
                Exit();

            } else {
                // Do nothing!
                declinar();
                $("#pago_driver").focus();
                Exit();

            }

        }

        //CREDIT CARD WITH FEE
        if (opcion === '21') {


            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;
                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;



                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    //visualizamos la caja de texto relacionada con el pago prepagado con tarjeta de credito con cargo
                    //document.getElementById('pago_tarjeta').style.display = 'block';
                    //document.getElementById('declinar').style.display = '';
                    ////document.getElementById('pay_amount').style.color = "#FFFFFF";
                    ////document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('btn_rever_prepaid').style.display = "";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var tit = "CREDIT CARD WITH FEE";
                    var pagadopre1 = document.getElementById('pagadopre1').value;
                    var pagadopre2 = document.getElementById('pagadopre2').value;
                    var pagadopre3 = document.getElementById('pagadopre3').value;
                    var pagadopre4 = document.getElementById('pagadopre4').value;
                    var pagadopre5 = document.getElementById('pagadopre5').value;
                    var pagadopre6 = document.getElementById('pagadopre6').value;
                    var pagadopre7 = document.getElementById('pagadopre7').value;
                    var pagadopre8 = document.getElementById('pagadopre8').value;
                    var pagadopre9 = document.getElementById('pagadopre9').value;
                    var pagadopre10 = document.getElementById('pagadopre10').value;

                    var titulo1 = tit + "\n" + "$" + pagadopre1;
                    var titulo2 = tit + "\n" + "$" + pagadopre2;
                    var titulo3 = tit + "\n" + "$" + pagadopre3;
                    var titulo4 = tit + "\n" + "$" + pagadopre4;
                    var titulo5 = tit + "\n" + "$" + pagadopre5;
                    var titulo6 = tit + "\n" + "$" + pagadopre6;
                    var titulo7 = tit + "\n" + "$" + pagadopre7;
                    var titulo8 = tit + "\n" + "$" + pagadopre8;
                    var titulo9 = tit + "\n" + "$" + pagadopre9;
                    var titulo10 = tit + "\n" + "$" + pagadopre10;

                    if(pago_pre1 == 0){
                        document.getElementById('cir1').title ="";
                    }

                    if(pago_pre1 == 1 && tipo_pagopre1 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir1').title = titulo1;
                    }

                    if(pago_pre2 == 2 && tipo_pagopre2 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir2').title = titulo2;
                    }


                    if(pago_pre3 == 3 && tipo_pagopre3 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir3').title = titulo3;
                    }

                    if(pago_pre4 == 4 && tipo_pagopre4 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir4').title = titulo4;
                    }

                    if(pago_pre5 == 5 && tipo_pagopre5 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir5').title = titulo5;
                    }

                    if(pago_pre6 == 6 && tipo_pagopre6 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir6').title = titulo6;
                    }

                    if(pago_pre7 == 7 && tipo_pagopre7 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir7').title = titulo7;
                    }

                    if(pago_pre8 == 8 && tipo_pagopre8 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir8').title = titulo8;
                    }

                    if(pago_pre9 == 9 && tipo_pagopre9 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir9').title = titulo9;
                    }

                    if(pago_pre10 == 10 && tipo_pagopre10 == "CREDIT CARD WITH FEE"){
                        document.getElementById('cir10').title = titulo10;
                    }

                    if(no_prep == 1){

                            $("#estado_pre1").val("pagado_pre1");
                            document.getElementById('cir1').style.display = '';



                    }else if(no_prep == 2){

                            $("#estado_pre2").val("pagado_pre2");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';


                    }else if(no_prep == 3){

                            $("#estado_pre3").val("pagado_pre3");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';

                    }else if(no_prep == 4){

                            $("#estado_pre4").val("pagado_pre4");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';

                    }else if(no_prep == 5){

                            $("#estado_pre5").val("pagado_pre5");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';

                    }else if(no_prep == 6){

                            $("#estado_pre6").val("pagado_pre6");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';


                    }else if(no_prep == 7){

                            $("#estado_pre7").val("pagado_pre7");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';


                    }else if(no_prep == 8){

                            $("#estado_pre8").val("pagado_pre8");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';

                    }else if(no_prep == 9){

                            $("#estado_pre9").val("pagado_pre9");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';


                    }else if(no_prep == 10){

                            $("#estado_pre10").val("pagado_pre10");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';
                            document.getElementById('cir10').style.display = '';

                    }


                    //document.getElementById('pay_amount').title ="Pago sin Guardar";
                    //make_charge();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                declinar();
                $("#pago_driver").focus();
                Exit();

            }

        }

        if (opcion === '22') { // CASH

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;

                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    ////document.getElementById('pay_amount').style.color = "#FFFFFF";
                    ////document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('btn_rever_prepaid').style.display = "";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('pay_amount').title ="Pago sin Guardar";

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var tit = "CASH";
                    var pagadopre1 = document.getElementById('pagadopre1').value;
                    var pagadopre2 = document.getElementById('pagadopre2').value;
                    var pagadopre3 = document.getElementById('pagadopre3').value;
                    var pagadopre4 = document.getElementById('pagadopre4').value;
                    var pagadopre5 = document.getElementById('pagadopre5').value;
                    var pagadopre6 = document.getElementById('pagadopre6').value;
                    var pagadopre7 = document.getElementById('pagadopre7').value;
                    var pagadopre8 = document.getElementById('pagadopre8').value;
                    var pagadopre9 = document.getElementById('pagadopre9').value;
                    var pagadopre10 = document.getElementById('pagadopre10').value;

                    var titulo1 = tit + "\n" + "$" + pagadopre1;
                    var titulo2 = tit + "\n" + "$" + pagadopre2;
                    var titulo3 = tit + "\n" + "$" + pagadopre3;
                    var titulo4 = tit + "\n" + "$" + pagadopre4;
                    var titulo5 = tit + "\n" + "$" + pagadopre5;
                    var titulo6 = tit + "\n" + "$" + pagadopre6;
                    var titulo7 = tit + "\n" + "$" + pagadopre7;
                    var titulo8 = tit + "\n" + "$" + pagadopre8;
                    var titulo9 = tit + "\n" + "$" + pagadopre9;
                    var titulo10 = tit + "\n" + "$" + pagadopre10;



                    if(pago_pre1 == 0){
                        document.getElementById('cir1').title ="";
                    }

                    if(pago_pre1 == 1 && tipo_pagopre1 == "CASH"){
                        document.getElementById('cir1').title = titulo1;
                    }

                    if(pago_pre2 == 2 && tipo_pagopre2 == "CASH"){
                        document.getElementById('cir2').title = titulo2;
                    }


                    if(pago_pre3 == 3 && tipo_pagopre3 == "CASH"){
                        document.getElementById('cir3').title = titulo3;
                    }

                    if(pago_pre4 == 4 && tipo_pagopre4 == "CASH"){
                        document.getElementById('cir4').title = titulo4;
                    }

                    if(pago_pre5 == 5 && tipo_pagopre5 == "CASH"){
                        document.getElementById('cir5').title = titulo5;
                    }

                    if(pago_pre6 == 6 && tipo_pagopre6 == "CASH"){
                        document.getElementById('cir6').title = titulo6;
                    }

                    if(pago_pre7 == 7 && tipo_pagopre7 == "CASH"){
                        document.getElementById('cir7').title = titulo7;
                    }

                    if(pago_pre8 == 8 && tipo_pagopre8 == "CASH"){
                        document.getElementById('cir8').title = titulo8;
                    }

                    if(pago_pre9 == 9 && tipo_pagopre9 == "CASH"){
                        document.getElementById('cir9').title = titulo9;
                    }

                    if(pago_pre10 == 10 && tipo_pagopre10 == "CASH"){
                        document.getElementById('cir10').title = titulo10;
                    }

                    if(no_prep == 1){

                            $("#estado_pre1").val("pagado_pre1");
                            document.getElementById('cir1').style.display = '';



                    }else if(no_prep == 2){

                            $("#estado_pre2").val("pagado_pre2");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';


                    }else if(no_prep == 3){

                            $("#estado_pre3").val("pagado_pre3");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';

                    }else if(no_prep == 4){

                            $("#estado_pre4").val("pagado_pre4");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';

                    }else if(no_prep == 5){

                            $("#estado_pre5").val("pagado_pre5");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';

                    }else if(no_prep == 6){

                            $("#estado_pre6").val("pagado_pre6");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';


                    }else if(no_prep == 7){

                            $("#estado_pre7").val("pagado_pre7");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';


                    }else if(no_prep == 8){

                            $("#estado_pre8").val("pagado_pre8");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';

                    }else if(no_prep == 9){

                            $("#estado_pre9").val("pagado_pre9");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';


                    }else if(no_prep == 10){

                            $("#estado_pre10").val("pagado_pre10");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';
                            document.getElementById('cir10').style.display = '';

                    }


                    /*make_charge();*/

                }, 0.001);

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                declinar();
                $("#pago_driver").focus();
                Exit();
            }

        }

        //Check
        if (opcion === '23') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;

                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    ////document.getElementById('pay_amount').style.color = "#FFFFFF";
                    ////document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('btn_rever_prepaid').style.display = "";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('pay_amount').title ="Pago sin Guardar";

                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var tit = "CHECK";
                    var pagadopre1 = document.getElementById('pagadopre1').value;
                    var pagadopre2 = document.getElementById('pagadopre2').value;
                    var pagadopre3 = document.getElementById('pagadopre3').value;
                    var pagadopre4 = document.getElementById('pagadopre4').value;
                    var pagadopre5 = document.getElementById('pagadopre5').value;
                    var pagadopre6 = document.getElementById('pagadopre6').value;
                    var pagadopre7 = document.getElementById('pagadopre7').value;
                    var pagadopre8 = document.getElementById('pagadopre8').value;
                    var pagadopre9 = document.getElementById('pagadopre9').value;
                    var pagadopre10 = document.getElementById('pagadopre10').value;

                    var titulo1 = tit + "\n" + "$" + pagadopre1;
                    var titulo2 = tit + "\n" + "$" + pagadopre2;
                    var titulo3 = tit + "\n" + "$" + pagadopre3;
                    var titulo4 = tit + "\n" + "$" + pagadopre4;
                    var titulo5 = tit + "\n" + "$" + pagadopre5;
                    var titulo6 = tit + "\n" + "$" + pagadopre6;
                    var titulo7 = tit + "\n" + "$" + pagadopre7;
                    var titulo8 = tit + "\n" + "$" + pagadopre8;
                    var titulo9 = tit + "\n" + "$" + pagadopre9;
                    var titulo10 = tit + "\n" + "$" + pagadopre10;



                    if(pago_pre1 == 0){
                        document.getElementById('cir1').title ="";
                    }

                    if(pago_pre1 == 1 && tipo_pagopre1 == "CHECK"){
                        document.getElementById('cir1').title = titulo1;
                    }

                    if(pago_pre2 == 2 && tipo_pagopre2 == "CHECK"){
                        document.getElementById('cir2').title = titulo2;
                    }


                    if(pago_pre3 == 3 && tipo_pagopre3 == "CHECK"){
                        document.getElementById('cir3').title = titulo3;
                    }

                    if(pago_pre4 == 4 && tipo_pagopre4 == "CHECK"){
                        document.getElementById('cir4').title = titulo4;
                    }

                    if(pago_pre5 == 5 && tipo_pagopre5 == "CHECK"){
                        document.getElementById('cir5').title = titulo5;
                    }

                    if(pago_pre6 == 6 && tipo_pagopre6 == "CHECK"){
                        document.getElementById('cir6').title = titulo6;
                    }

                    if(pago_pre7 == 7 && tipo_pagopre7 == "CHECK"){
                        document.getElementById('cir7').title = titulo7;
                    }

                    if(pago_pre8 == 8 && tipo_pagopre8 == "CHECK"){
                        document.getElementById('cir8').title = titulo8;
                    }

                    if(pago_pre9 == 9 && tipo_pagopre9 == "CHECK"){
                        document.getElementById('cir9').title = titulo9;
                    }

                    if(pago_pre10 == 10 && tipo_pagopre10 == "CHECK"){
                        document.getElementById('cir10').title = titulo10;
                    }

                    if(no_prep == 1){

                            $("#estado_pre1").val("pagado_pre1");
                            document.getElementById('cir1').style.display = '';



                    }else if(no_prep == 2){

                            $("#estado_pre2").val("pagado_pre2");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';


                    }else if(no_prep == 3){

                            $("#estado_pre3").val("pagado_pre3");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';

                    }else if(no_prep == 4){

                            $("#estado_pre4").val("pagado_pre4");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';

                    }else if(no_prep == 5){

                            $("#estado_pre5").val("pagado_pre5");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';

                    }else if(no_prep == 6){

                            $("#estado_pre6").val("pagado_pre6");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';


                    }else if(no_prep == 7){

                            $("#estado_pre7").val("pagado_pre7");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';


                    }else if(no_prep == 8){

                            $("#estado_pre8").val("pagado_pre8");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';

                    }else if(no_prep == 9){

                            $("#estado_pre9").val("pagado_pre9");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';


                    }else if(no_prep == 10){

                            $("#estado_pre10").val("pagado_pre10");
                            document.getElementById('cir1').style.display = '';
                            document.getElementById('cir2').style.display = '';
                            document.getElementById('cir3').style.display = '';
                            document.getElementById('cir4').style.display = '';
                            document.getElementById('cir5').style.display = '';
                            document.getElementById('cir6').style.display = '';
                            document.getElementById('cir7').style.display = '';
                            document.getElementById('cir8').style.display = '';
                            document.getElementById('cir9').style.display = '';
                            document.getElementById('cir10').style.display = '';

                    }


                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                declinar();
                $("#pago_driver").focus();
                Exit();
            }

        }

        //Collect on Board

        //Credit Card no fee

        if (opcion === '24') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('paid_driver').value = collect;

//              document.getElementById('pay_amount').value = pago_driver;

                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {
                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    ////document.getElementById('paid_driver').style.color = "#FFFFFF";
                    ////document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('btn_rever_cob').style.display = "";
                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                    document.getElementById('paid_driver').title ="Pago sin Guardar";

                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var pago_1 = document.getElementById('pago_1').value;
                    var pago_2 = document.getElementById('pago_2').value;
                    var pago_3 = document.getElementById('pago_3').value;
                    var pago_4 = document.getElementById('pago_4').value;
                    var pago_5 = document.getElementById('pago_5').value;
                    var pago_6 = document.getElementById('pago_6').value;
                    var pago_7 = document.getElementById('pago_7').value;
                    var pago_8 = document.getElementById('pago_8').value;
                    var pago_9 = document.getElementById('pago_9').value;
                    var pago_10 = document.getElementById('pago_10').value;



                    var tit = "CREDIT CARD NO FEE";
                    var pagado1 = document.getElementById('pagado1').value;
                    var pagado2 = document.getElementById('pagado2').value;
                    var pagado3 = document.getElementById('pagado3').value;
                    var pagado4 = document.getElementById('pagado4').value;
                    var pagado5 = document.getElementById('pagado5').value;
                    var pagado6 = document.getElementById('pagado6').value;
                    var pagado7 = document.getElementById('pagado7').value;
                    var pagado8 = document.getElementById('pagado8').value;
                    var pagado9 = document.getElementById('pagado9').value;
                    var pagado10 = document.getElementById('pagado10').value;

                    var titulo1 = tit + "\n" + "$" + pagado1;
                    var titulo2 = tit + "\n" + "$" + pagado2;
                    var titulo3 = tit + "\n" + "$" + pagado3;
                    var titulo4 = tit + "\n" + "$" + pagado4;
                    var titulo5 = tit + "\n" + "$" + pagado5;
                    var titulo6 = tit + "\n" + "$" + pagado6;
                    var titulo7 = tit + "\n" + "$" + pagado7;
                    var titulo8 = tit + "\n" + "$" + pagado8;
                    var titulo9 = tit + "\n" + "$" + pagado9;
                    var titulo10 = tit + "\n" + "$" + pagado10;

                    if(pago_1 == 0){
                        document.getElementById('trian1').title = "";
                    }

                    if(pago_1 == 1 && tipo_pago1 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian1').title = titulo1;
                    }

                    if(pago_2 == 2 && tipo_pago2 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian2').title = titulo2;
                    }


                    if(pago_3 == 3 && tipo_pago3 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian3').title = titulo3;
                    }

                    if(pago_4 == 4 && tipo_pago4 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian4').title = titulo4;
                    }

                    if(pago_5 == 5 && tipo_pago5 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian5').title = titulo5;
                    }

                    if(pago_6 == 6 && tipo_pago6 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian6').title = titulo6;
                    }

                    if(pago_7 == 7 && tipo_pago7 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian7').title = titulo7;
                    }

                    if(pago_8 == 8 && tipo_pago8 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian8').title = titulo8;
                    }

                    if(pago_9 == 9 && tipo_pago9 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian9').title = titulo9;
                    }

                    if(pago_10 == 10 && tipo_pago10 == "CREDIT CARD NO FEE"){
                        document.getElementById('trian10').title = titulo10;
                    }


                    if(no_pago == 1){

                            $("#estado_cob1").val("pagado_cob1");
                            document.getElementById('trian1').style.display = '';

                    }else if(no_pago == 2){

                            $("#estado_cob2").val("pagado_cob2");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';


                    }else if(no_pago == 3){

                            $("#estado_cob3").val("pagado_cob3");
                             document.getElementById('trian1').style.display = '';
                             document.getElementById('trian2').style.display = '';
                             document.getElementById('trian3').style.display = '';



                    }else if(no_pago == 4){

                            $("#estado_cob4").val("pagado_cob4");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';


                    }else if(no_pago == 5){

                            $("#estado_cob5").val("pagado_cob5");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';


                    }else if(no_pago == 6){

                            $("#estado_cob6").val("pagado_cob6");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';



                    }else if(no_pago == 7){

                            $("#estado_cob7").val("pagado_cob7");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';


                    }else if(no_pago == 8){

                            $("#estado_cob8").val("pagado_cob8");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';


                    }else if(no_pago == 9){

                            $("#estado_cob9").val("pagado_cob9");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';


                    }else if(no_pago == 10){

                            $("#estado_cob10").val("pagado_cob10");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';
                            document.getElementById('trian10').style.display = '';

                    }

                }, 0.001);

                $("#pago_driver").focus();


                Exit();
                // Save it!
            } else {
                // Do nothing!
                Exit_Cob();
                $("#pago_driver").focus();
                Exit();
            }



        }

        //Credit Card with Fee

        if (opcion === '25') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('paid_driver').value = collect;

//              document.getElementById('pay_amount').value = pago_driver;

                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {

                    CalcularTotalTotal();
                    ////document.getElementById('paid_driver').style.color = "#FFFFFF";
                    ////document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('btn_rever_cob').style.display = "";
                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                    document.getElementById('paid_driver').title ="Pago sin Guardar";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";


                    var pago_1 = document.getElementById('pago_1').value;
                    var pago_2 = document.getElementById('pago_2').value;
                    var pago_3 = document.getElementById('pago_3').value;
                    var pago_4 = document.getElementById('pago_4').value;
                    var pago_5 = document.getElementById('pago_5').value;
                    var pago_6 = document.getElementById('pago_6').value;
                    var pago_7 = document.getElementById('pago_7').value;
                    var pago_8 = document.getElementById('pago_8').value;
                    var pago_9 = document.getElementById('pago_9').value;
                    var pago_10 = document.getElementById('pago_10').value;



                    var tit = "CREDIT CARD WITH FEE";
                    var pagado1 = document.getElementById('pagado1').value;
                    var pagado2 = document.getElementById('pagado2').value;
                    var pagado3 = document.getElementById('pagado3').value;
                    var pagado4 = document.getElementById('pagado4').value;
                    var pagado5 = document.getElementById('pagado5').value;
                    var pagado6 = document.getElementById('pagado6').value;
                    var pagado7 = document.getElementById('pagado7').value;
                    var pagado8 = document.getElementById('pagado8').value;
                    var pagado9 = document.getElementById('pagado9').value;
                    var pagado10 = document.getElementById('pagado10').value;

                    var titulo1 = tit + "\n" + "$" + pagado1;
                    var titulo2 = tit + "\n" + "$" + pagado2;
                    var titulo3 = tit + "\n" + "$" + pagado3;
                    var titulo4 = tit + "\n" + "$" + pagado4;
                    var titulo5 = tit + "\n" + "$" + pagado5;
                    var titulo6 = tit + "\n" + "$" + pagado6;
                    var titulo7 = tit + "\n" + "$" + pagado7;
                    var titulo8 = tit + "\n" + "$" + pagado8;
                    var titulo9 = tit + "\n" + "$" + pagado9;
                    var titulo10 = tit + "\n" + "$" + pagado10;

                    if(pago_1 == 0){
                        document.getElementById('trian1').title = "";
                    }

                    if(pago_1 == 1 && tipo_pago1 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian1').title = titulo1;
                    }

                    if(pago_2 == 2 && tipo_pago2 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian2').title = titulo2;
                    }


                    if(pago_3 == 3 && tipo_pago3 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian3').title = titulo3;
                    }

                    if(pago_4 == 4 && tipo_pago4 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian4').title = titulo4;
                    }

                    if(pago_5 == 5 && tipo_pago5 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian5').title = titulo5;
                    }

                    if(pago_6 == 6 && tipo_pago6 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian6').title = titulo6;
                    }

                    if(pago_7 == 7 && tipo_pago7 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian7').title = titulo7;
                    }

                    if(pago_8 == 8 && tipo_pago8 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian8').title = titulo8;
                    }

                    if(pago_9 == 9 && tipo_pago9 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian9').title = titulo9;
                    }

                    if(pago_10 == 10 && tipo_pago10 == "CREDIT CARD WITH FEE"){
                        document.getElementById('trian10').title = titulo10;
                    }


                    if(no_pago == 1){

                            $("#estado_cob1").val("pagado_cob1");
                            document.getElementById('trian1').style.display = '';

                    }else if(no_pago == 2){

                            $("#estado_cob2").val("pagado_cob2");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';


                    }else if(no_pago == 3){

                            $("#estado_cob3").val("pagado_cob3");
                             document.getElementById('trian1').style.display = '';
                             document.getElementById('trian2').style.display = '';
                             document.getElementById('trian3').style.display = '';



                    }else if(no_pago == 4){

                            $("#estado_cob4").val("pagado_cob4");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';


                    }else if(no_pago == 5){

                            $("#estado_cob5").val("pagado_cob5");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';


                    }else if(no_pago == 6){

                            $("#estado_cob6").val("pagado_cob6");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';



                    }else if(no_pago == 7){

                            $("#estado_cob7").val("pagado_cob7");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';


                    }else if(no_pago == 8){

                            $("#estado_cob8").val("pagado_cob8");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';


                    }else if(no_pago == 9){

                            $("#estado_cob9").val("pagado_cob9");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';


                    }else if(no_pago == 10){

                            $("#estado_cob10").val("pagado_cob10");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';
                            document.getElementById('trian10').style.display = '';

                    }



                }, 0.001);
                $("#pago_driver").focus();
                Exit();

            } else {
                // Do nothing!
                Exit_Cob();
                $("#pago_driver").focus();
                Exit();
            }

        }

        // CASH
        if (opcion === '26') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('paid_driver').value = collect;


//              document.getElementById('pay_amount').value = pago_driver;
                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {
                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    ////document.getElementById('paid_driver').style.color = "#FFFFFF";
                    ////document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";

                    document.getElementById('btn_rever_cob').style.display = "";
                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                    document.getElementById('paid_driver').title ="Pago sin Guardar";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var pago_1 = document.getElementById('pago_1').value;
                    var pago_2 = document.getElementById('pago_2').value;
                    var pago_3 = document.getElementById('pago_3').value;
                    var pago_4 = document.getElementById('pago_4').value;
                    var pago_5 = document.getElementById('pago_5').value;
                    var pago_6 = document.getElementById('pago_6').value;
                    var pago_7 = document.getElementById('pago_7').value;
                    var pago_8 = document.getElementById('pago_8').value;
                    var pago_9 = document.getElementById('pago_9').value;
                    var pago_10 = document.getElementById('pago_10').value;



                    var tit = "CASH";
                    var pagado1 = document.getElementById('pagado1').value;
                    var pagado2 = document.getElementById('pagado2').value;
                    var pagado3 = document.getElementById('pagado3').value;
                    var pagado4 = document.getElementById('pagado4').value;
                    var pagado5 = document.getElementById('pagado5').value;
                    var pagado6 = document.getElementById('pagado6').value;
                    var pagado7 = document.getElementById('pagado7').value;
                    var pagado8 = document.getElementById('pagado8').value;
                    var pagado9 = document.getElementById('pagado9').value;
                    var pagado10 = document.getElementById('pagado10').value;

                    var titulo1 = tit + "\n" + "$" + pagado1;
                    var titulo2 = tit + "\n" + "$" + pagado2;
                    var titulo3 = tit + "\n" + "$" + pagado3;
                    var titulo4 = tit + "\n" + "$" + pagado4;
                    var titulo5 = tit + "\n" + "$" + pagado5;
                    var titulo6 = tit + "\n" + "$" + pagado6;
                    var titulo7 = tit + "\n" + "$" + pagado7;
                    var titulo8 = tit + "\n" + "$" + pagado8;
                    var titulo9 = tit + "\n" + "$" + pagado9;
                    var titulo10 = tit + "\n" + "$" + pagado10;

                    if(pago_1 == 0){
                        document.getElementById('trian1').title = "";
                    }

                    if(pago_1 == 1 && tipo_pago1 == "CASH"){
                        document.getElementById('trian1').title = titulo1;
                    }

                    if(pago_2 == 2 && tipo_pago2 == "CASH"){
                        document.getElementById('trian2').title = titulo2;
                    }


                    if(pago_3 == 3 && tipo_pago3 == "CASH"){
                        document.getElementById('trian3').title = titulo3;
                    }

                    if(pago_4 == 4 && tipo_pago4 == "CASH"){
                        document.getElementById('trian4').title = titulo4;
                    }

                    if(pago_5 == 5 && tipo_pago5 == "CASH"){
                        document.getElementById('trian5').title = titulo5;
                    }

                    if(pago_6 == 6 && tipo_pago6 == "CASH"){
                        document.getElementById('trian6').title = titulo6;
                    }

                    if(pago_7 == 7 && tipo_pago7 == "CASH"){
                        document.getElementById('trian7').title = titulo7;
                    }

                    if(pago_8 == 8 && tipo_pago8 == "CASH"){
                        document.getElementById('trian8').title = titulo8;
                    }

                    if(pago_9 == 9 && tipo_pago9 == "CASH"){
                        document.getElementById('trian9').title = titulo9;
                    }

                    if(pago_10 == 10 && tipo_pago10 == "CASH"){
                        document.getElementById('trian10').title = titulo10;
                    }


                    if(no_pago == 1){

                            $("#estado_cob1").val("pagado_cob1");
                            document.getElementById('trian1').style.display = '';

                    }else if(no_pago == 2){

                            $("#estado_cob2").val("pagado_cob2");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';


                    }else if(no_pago == 3){

                            $("#estado_cob3").val("pagado_cob3");
                             document.getElementById('trian1').style.display = '';
                             document.getElementById('trian2').style.display = '';
                             document.getElementById('trian3').style.display = '';



                    }else if(no_pago == 4){

                            $("#estado_cob4").val("pagado_cob4");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';


                    }else if(no_pago == 5){

                            $("#estado_cob5").val("pagado_cob5");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';


                    }else if(no_pago == 6){

                            $("#estado_cob6").val("pagado_cob6");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';



                    }else if(no_pago == 7){

                            $("#estado_cob7").val("pagado_cob7");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';


                    }else if(no_pago == 8){

                            $("#estado_cob8").val("pagado_cob8");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';


                    }else if(no_pago == 9){

                            $("#estado_cob9").val("pagado_cob9");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';


                    }else if(no_pago == 10){

                            $("#estado_cob10").val("pagado_cob10");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';
                            document.getElementById('trian10').style.display = '';

                    }



                }, 0.001);

                $("#pago_driver").focus();


                Exit();

            } else {
                // Do nothing!
                Exit_Cob();
                $("#pago_driver").focus();
                Exit();
            }


        }

        //CHECK

        if (opcion === '27') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('paid_driver').value = collect;
//              document.getElementById('pay_amount').value = pago_driver;
                //opcion add payment   codigo de envio al controlador para aumento de cargos
                document.getElementById('opc_ap').value = opcion;

                setTimeout(function () {
                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    ////document.getElementById('paid_driver').style.color = "#FFFFFF";
                    ////document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('btn_rever_cob').style.display = "";
                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                    document.getElementById('paid_driver').title ="Pago sin Guardar";
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";

                    var pago_1 = document.getElementById('pago_1').value;
                    var pago_2 = document.getElementById('pago_2').value;
                    var pago_3 = document.getElementById('pago_3').value;
                    var pago_4 = document.getElementById('pago_4').value;
                    var pago_5 = document.getElementById('pago_5').value;
                    var pago_6 = document.getElementById('pago_6').value;
                    var pago_7 = document.getElementById('pago_7').value;
                    var pago_8 = document.getElementById('pago_8').value;
                    var pago_9 = document.getElementById('pago_9').value;
                    var pago_10 = document.getElementById('pago_10').value;



                    var tit = "CHECK";
                    var pagado1 = document.getElementById('pagado1').value;
                    var pagado2 = document.getElementById('pagado2').value;
                    var pagado3 = document.getElementById('pagado3').value;
                    var pagado4 = document.getElementById('pagado4').value;
                    var pagado5 = document.getElementById('pagado5').value;
                    var pagado6 = document.getElementById('pagado6').value;
                    var pagado7 = document.getElementById('pagado7').value;
                    var pagado8 = document.getElementById('pagado8').value;
                    var pagado9 = document.getElementById('pagado9').value;
                    var pagado10 = document.getElementById('pagado10').value;

                    var titulo1 = tit + "\n" + "$" + pagado1;
                    var titulo2 = tit + "\n" + "$" + pagado2;
                    var titulo3 = tit + "\n" + "$" + pagado3;
                    var titulo4 = tit + "\n" + "$" + pagado4;
                    var titulo5 = tit + "\n" + "$" + pagado5;
                    var titulo6 = tit + "\n" + "$" + pagado6;
                    var titulo7 = tit + "\n" + "$" + pagado7;
                    var titulo8 = tit + "\n" + "$" + pagado8;
                    var titulo9 = tit + "\n" + "$" + pagado9;
                    var titulo10 = tit + "\n" + "$" + pagado10;

                    if(pago_1 == 0){
                        document.getElementById('trian1').title = "";
                    }

                    if(pago_1 == 1 && tipo_pago1 == "CHECK"){
                        document.getElementById('trian1').title = titulo1;
                    }

                    if(pago_2 == 2 && tipo_pago2 == "CHECK"){
                        document.getElementById('trian2').title = titulo2;
                    }


                    if(pago_3 == 3 && tipo_pago3 == "CHECK"){
                        document.getElementById('trian3').title = titulo3;
                    }

                    if(pago_4 == 4 && tipo_pago4 == "CHECK"){
                        document.getElementById('trian4').title = titulo4;
                    }

                    if(pago_5 == 5 && tipo_pago5 == "CHECK"){
                        document.getElementById('trian5').title = titulo5;
                    }

                    if(pago_6 == 6 && tipo_pago6 == "CHECK"){
                        document.getElementById('trian6').title = titulo6;
                    }

                    if(pago_7 == 7 && tipo_pago7 == "CHECK"){
                        document.getElementById('trian7').title = titulo7;
                    }

                    if(pago_8 == 8 && tipo_pago8 == "CHECK"){
                        document.getElementById('trian8').title = titulo8;
                    }

                    if(pago_9 == 9 && tipo_pago9 == "CHECK"){
                        document.getElementById('trian9').title = titulo9;
                    }

                    if(pago_10 == 10 && tipo_pago10 == "CHECK"){
                        document.getElementById('trian10').title = titulo10;
                    }


                    if(no_pago == 1){

                            $("#estado_cob1").val("pagado_cob1");
                            document.getElementById('trian1').style.display = '';

                    }else if(no_pago == 2){

                            $("#estado_cob2").val("pagado_cob2");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';


                    }else if(no_pago == 3){

                            $("#estado_cob3").val("pagado_cob3");
                             document.getElementById('trian1').style.display = '';
                             document.getElementById('trian2').style.display = '';
                             document.getElementById('trian3').style.display = '';



                    }else if(no_pago == 4){

                            $("#estado_cob4").val("pagado_cob4");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';


                    }else if(no_pago == 5){

                            $("#estado_cob5").val("pagado_cob5");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';


                    }else if(no_pago == 6){

                            $("#estado_cob6").val("pagado_cob6");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';



                    }else if(no_pago == 7){

                            $("#estado_cob7").val("pagado_cob7");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';


                    }else if(no_pago == 8){

                            $("#estado_cob8").val("pagado_cob8");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';


                    }else if(no_pago == 9){

                            $("#estado_cob9").val("pagado_cob9");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';


                    }else if(no_pago == 10){

                            $("#estado_cob10").val("pagado_cob10");
                            document.getElementById('trian1').style.display = '';
                            document.getElementById('trian2').style.display = '';
                            document.getElementById('trian3').style.display = '';
                            document.getElementById('trian4').style.display = '';
                            document.getElementById('trian5').style.display = '';
                            document.getElementById('trian6').style.display = '';
                            document.getElementById('trian7').style.display = '';
                            document.getElementById('trian8').style.display = '';
                            document.getElementById('trian9').style.display = '';
                            document.getElementById('trian10').style.display = '';

                    }


                }, 0.001);

                $("#pago_driver").focus();


                Exit();

            } else {
                // Do nothing!
                Exit_Cob();
                $("#pago_driver").focus();
                Exit();
            }

        }


    }
</script>

<script type="text/javascript">

    function decli_cob()
    {
        var no_pago =  document.getElementById("no_pago").value;

                if(no_pago == 1){
                    document.getElementById("no_pago").value = 0;
                    document.getElementById('pago_1').value = '0';
                    document.getElementById('pago1').value = '';
                    document.getElementById('tipo_pago1').value = '';
                    document.getElementById('pagado1').value = '0.00';
                    document.getElementById('estado_cob1').value = '';

                }else if(no_pago == 2){
                    document.getElementById("no_pago").value = 1;
                    document.getElementById('pago_2').value = '0';
                    document.getElementById('pago2').value = '';
                    document.getElementById('tipo_pago2').value = '';
                    document.getElementById('pagado2').value = '0.00';
                    document.getElementById('estado_cob2').value = '';

                }else if(no_pago == 3){
                    document.getElementById("no_pago").value = 2;
                    document.getElementById('pago_3').value = '0';
                    document.getElementById('pago3').value = '';
                    document.getElementById('tipo_pago3').value = '';
                    document.getElementById('pagado3').value = '0.00';
                    document.getElementById('estado_cob3').value = '';

                }else if(no_pago == 4){
                    document.getElementById("no_pago").value = 3;
                    document.getElementById('pago_4').value = '0';
                    document.getElementById('pago4').value = '';
                    document.getElementById('tipo_pago4').value = '';
                    document.getElementById('pagado4').value = '0.00';
                    document.getElementById('estado_cob4').value = '';

                }else if(no_pago == 5){
                    document.getElementById("no_pago").value = 4;
                    document.getElementById('pago_5').value = '0';
                    document.getElementById('pago5').value = '';
                    document.getElementById('tipo_pago5').value = '';
                    document.getElementById('pagado5').value = '0.00';
                    document.getElementById('estado_cob5').value = '';

                }else if(no_pago == 6){
                    document.getElementById("no_pago").value = 5;
                    document.getElementById('pago_6').value = '0';
                    document.getElementById('pago6').value = '';
                    document.getElementById('tipo_pago6').value = '';
                    document.getElementById('pagado6').value = '0.00';
                    document.getElementById('estado_cob6').value = '';

                }else if(no_pago == 7){
                    document.getElementById("no_pago").value = 6;
                    document.getElementById('pago_7').value = '0';
                    document.getElementById('pago7').value = '';
                    document.getElementById('tipo_pago7').value = '';
                    document.getElementById('pagado7').value = '0.00';
                    document.getElementById('estado_cob7').value = '';

                }else if(no_pago == 8){
                    document.getElementById("no_pago").value = 7;
                    document.getElementById('pago_8').value = '0';
                    document.getElementById('pago8').value = '';
                    document.getElementById('tipo_pago8').value = '';
                    document.getElementById('pagado8').value = '0.00';
                    document.getElementById('estado_cob8').value = '';

                }else if(no_pago == 9){
                    document.getElementById("no_pago").value = 8;
                    document.getElementById('pago_9').value = '0';
                    document.getElementById('pago9').value = '';
                    document.getElementById('tipo_pago9').value = '';
                    document.getElementById('pagado9').value = '0.00';
                    document.getElementById('estado_cob9').value = '';

                }else if(no_pago == 10){
                    document.getElementById("no_pago").value = 9;
                    document.getElementById('pago_10').value = '0';
                    document.getElementById('pago10').value = '';
                    document.getElementById('tipo_pago10').value = '';
                    document.getElementById('pagado10').value = '0.00';
                    document.getElementById('estado_cob10').value = '';

                }


    }


</script>

<canvas id="rectangulo" width="300" height="150"></canvas>

<!--<script type="text/javascript">

    function cerrar_multi() {

        window.close('../admin/tours/add','MULTIADD','');
        //window.close('../admin/onedaytour/add','ONEDAYADD','');
    }

</script>-->
<input type="hidden" name="idagencia" id="idagencia"   autocomplete="off"/>

<script>
// $jq('#pickup1').prop('readonly',true);
// $jq('#dropoff1').prop('readonly',true);
// $jq('#pickup2').prop('readonly',true);
// $jq('#dropoff2').prop('readonly',true);
</script>
<script type="text/javascript">

    $(window).load(function () {
       var id_ag = $('#id_agency').val();

        year_actual();
        // var opc_cond =
        captura();
        //passenger_balance();
        document.getElementById('comments').value = "";

//        activa_round();
    //    var idagencia = document.getElementById('idagencia').value;

    });


    $("#aprobar").click(function () {

        document.getElementById('declinar').style.display = 'none';
        document.getElementById('aprobar').style.display = 'none';
        document.getElementById('pago_tarjeta').style.display = 'none';
        document.getElementById('pay_amount').style.color = "#000";
        document.getElementById('pay_amount').className = "azu";
        document.getElementById('pay_amount').title ="";


    });

    $("#declinar").click(function () {

        var pago_tarjeta = $("#pago_tarjeta").val();
        var pay_amount = $("#pay_amount").val();
        var otheramount = $("#otheramount").val();
        var saldoporpagar = $("#saldoporpagar").val();
        var totalpagar = $("#totalPagar").val();
        var totaltotal = $("#totaltotal").text();
        var temp_prepaid = $("#temp_prepaid").val();





        if(otheramount == 0){



            var pago_tarjeta = $("#pago_tarjeta").val();
            var pay_amount = $("#pay_amount").val();
            var temp_prepaid = $("#temp_prepaid").val();
            var prepaid = $("#prepaid").val();
            var saldoporpagar = $("#saldoporpagar").val();
            var paid_driver = $("#paid_driver").val();
            var balance_due = $("#balance_due").val();
            var totalpagar = $("#totalPagar").val();
            var totaltotal = $("#totaltotal").text();
            var agency_balance_due = $("#agency_balance_due").val();
            var no_prep =  document.getElementById("no_prep").value;


            var result = parseFloat(pay_amount) - parseFloat(pago_tarjeta);
            var valor_prepagado = parseFloat(prepaid) - parseFloat(pago_tarjeta);
            var saldo = parseFloat(saldoporpagar) - parseFloat(temp_prepaid);
            var total_pagar = parseFloat(totalpagar) - parseFloat(temp_prepaid);
            var total_total = parseFloat(totaltotal) - parseFloat(temp_prepaid);
            var balancedue = parseFloat(saldo) - parseFloat(paid_driver);
            var ag_bal_due= (parseFloat(saldo) - parseFloat(paid_driver)) - parseFloat(result);
            var cargo_actual = ((parseFloat(result)) - (parseFloat(result)/1.04)).toFixed(2);



            $("#saldoporpagar").val((saldo).toFixed(2));
            $("#balance_due").val((balancedue).toFixed(2));
            $("#totalPagar").val((total_pagar).toFixed(2));
            $("#pay_amount").val((result).toFixed(2));
            $("#totaltotal").text((total_total).toFixed(2));
            $("#agency_balance_due").val((ag_bal_due).toFixed(2));
            $("#prepaid").val((valor_prepagado).toFixed(2));

            document.getElementById('temp_prepaid').value = cargo_actual;

            if(no_prep == 1){
                    document.getElementById("no_prep").value = 0;
                    document.getElementById('pago_pre1').value = '0';
                    document.getElementById('pagopre1').value = '';
                    document.getElementById('tipo_pagopre1').value = '';
                    document.getElementById('pagadopre1').value = '0.00';

            }else if(no_prep == 2){

                document.getElementById("no_prep").value = 1;
                document.getElementById('pago_pre2').value = '0';
                document.getElementById('pagopre2').value = '';
                document.getElementById('tipo_pagopre2').value = '';
                document.getElementById('pagadopre2').value = '0.00';

//                var result = parseFloat(pay_amount) - parseFloat(pago_tarjeta);
//                var valor_prepagado = parseFloat(prepaid) - parseFloat(pago_tarjeta);
//                var saldo = parseFloat(saldoporpagar) - parseFloat(cargo_actual);
//                var total_pagar = parseFloat(totalpagar) - parseFloat(cargo_actual);
//                var total_total = parseFloat(totaltotal) - parseFloat(cargo_actual);
//                var balancedue = parseFloat(saldo) - parseFloat(paid_driver);
//                var ag_bal_due= (parseFloat(saldo) - parseFloat(paid_driver)) - parseFloat(result);
//
//
//
//
//                $("#saldoporpagar").val((saldo).toFixed(2));
//                $("#balance_due").val((balancedue).toFixed(2));
//                $("#totalPagar").text((total_pagar).toFixed(2));
//                $("#pay_amount").val((result).toFixed(2));
//                $("#totaltotal").text((total_total).toFixed(2));
//                $("#agency_balance_due").val((ag_bal_due).toFixed(2));
//                //$("#prepaid").val((valor_prepagado).toFixed(2));





            }else if(no_prep == 3){
                document.getElementById("no_prep").value = 2;
                document.getElementById('pago_pre3').value = '0';
                document.getElementById('pagopre3').value = '';
                document.getElementById('tipo_pagopre3').value = '';
                document.getElementById('pagadopre3').value = '0.00';

            }else if(no_prep == 4){
                document.getElementById("no_prep").value = 3;
                document.getElementById('pago_pre4').value = '0';
                document.getElementById('pagopre4').value = '';
                document.getElementById('tipo_pagopre4').value = '';
                document.getElementById('pagadopre4').value = '0.00';

            }


        }


        document.getElementById('declinar').style.display = 'none';
        document.getElementById('pago_tarjeta').style.display = 'none';
        document.getElementById('aprobar').style.display = 'none';
        document.getElementById('pay_amount').style.color = "#000";
        document.getElementById('pay_amount').className = "azu";
        document.getElementById('pay_amount').title ="";



    });

    $("#btnPagolinea").click(function () {

        //$("#pago_agente").click(function () {

        document.getElementById('btnPagolinea').style.display = 'none';
        //document.getElementById("btn-save2").style.display = "";
        document.getElementById("btndecline").disabled = false;
        document.getElementById("btndecline").style.display = "";
        document.getElementById("btndecline").style.cursor = 'pointer';

        var paid_driver = $("#paid_driver").val();
        var pay_amount = $("#pay_amount").val();
        var cantidad = parseFloat(paid_driver) + parseFloat(pay_amount);

        //var cantidad = $("#pay_amount").val();
        var cantidad = $("#pago_tarjeta").val();

        if (cantidad <= 0) {
            return false;
        }
        var email1 = $("#email1").val();
        var primer_n = $("#firstname1").val();
        var segundo_n = $("#lastname1").val();
        var phone1 = $("#phone1").val();
        var referencia = $("#numref").val();
//        var codconf = $_SESSION['codconf'];

        if (segundo_n === '.') {
            segundo_n = '';
        }

//        document.getElementById('pago_tarjeta').style.display = 'block';
//        document.getElementById('declinar').style.display = 'block';
//        document.getElementById('aprobar').style.display = 'block';
//        document.getElementById('pago_agente').style.display = 'none';


        var url = encodeURI('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $_SESSION['codconf']; ?>'+'/'+referencia);

        window.open(url, '_blank');
        return false;


    });

    document.getElementById('otheramount').value = ('0.00');
    document.getElementById('totalPagarnet').value = ('0.00');
    document.getElementById('balance_due').value = ('0.00');
    document.getElementById('agency_balance_due').value = ('0.00');
    document.getElementById('pay_amount').value = ('0.00');
    document.getElementById('paid_driver').value = ('0.00');


    $("#opcion_pago_Voucher").change(function () {
        $("#pay_amount_html").hide();
    });
    $("#opcion_pago_Cash").change(function () {
        $("#pay_amount_html").show();
    });
    $("#label_tipo_CrediFee").change(function () {
        $("#pay_amount_html").show();
    });
    $("#opcion_pago_agency").change(function () {
        $("#pay_amount_html").show();
    });
    $("#opcion_pago_passager").change(function () {
        $("#pay_amount_html").show();
    });


    $("#op_pago_id").change(function () {
        CalcularTotalTotal();
    });
    $("#pay_amount").change(function () {
        CalcularTotalTotal();
    });

    $("#paid_driver").change(function () {
        CalcularTotalTotal();
    });

    $(document).ready(function () {
//        function update(){
//
//
//        var tempo = $("#temporal").val();
//        //alert(temporal);
//        console.log(tempo);
//
//        $.ajax({
//
//                //datos que se envian a traves de ajax
//                url: '<?php /*echo $data['rootUrl']; */?>consul/trips/'+ tempo, //archivo que recibe la peticion
//
//                type: 'POST', //método de envio
//                //'<i class="fa fa-spinner fa-spin" style="font-size:25px; color:red;"></i>'
//                beforeSend: function () {
//                        $("#resultado").html();
//                },
//                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
//                        $("#resultado").html(response);
//                }
//
//        });
//
//    }
//
//    setInterval(update, 5000);

        $("#calan_web").attr('checked', true);

        var tipo;

        //alert(paid_driver);

        setTimeout(function () {

            var paid_driver = document.getElementById('paid_driver').value;
            var pay_amount = document.getElementById('pay_amount').value;


//            if(paid_driver > '0.00'){
//
//                alert("mayor");
//
//                document.getElementById('btn_rever_cob').style.display = "";
//
//            }else{
//
//                document.getElementById('btn_rever_cob').style.display = "none";
//                alert("paid driver");
//            }
//
//            if(pay_amount > '0.00'){
//
//                document.getElementById('btn_rever_prepaid').style.display = "";
//            }else{
//
//                document.getElementById('btn_rever_prepaid').style.display = "none";
//            }

         }, 0.01);

        var client = document.getElementById("newClient");
//client.style.visibility = "hidden";

        if ($("#pax").val() != "" || $("#pax2").val() != "") {

            var pax = $('#pax').val();
            var pax2 = $('#pax2').val();
            var total;

            if (pax2 == "") {
                pax2 = 0;
                // $('#pax2').val(0);
            }

            if (pax == "") {
                pax = 0;
                $('#pax').val(0);
            }

            total = (parseInt(pax) + parseInt(pax2));
            $('#totalpax').val(total);
            CalcularTotalTotal();
        }


        var validar = '<?php echo $opc['tipo_ticket'] ?>';

        //alert(validar)
        if (validar != 'roundtrip') {

            $("#oneway").attr("checked", true);
            $("#round").css("display", "none");
            $(".sup2").css("margin-top", "2px");
        }

        $('#uagency').attr('disabled', 'disabled');
        //$('#leader').focus();
        //$('#agency').focus();
          $.fn.autosugguest({
            className: 'ausu-suggest',
            methodType: 'POST',
            minChars: 1,
            rtnIDs: true,
            dataFile: '<?php echo $data['rootUrl']; ?>leader/ajax'
        });

        var id = $("#from").val();


        if (id != "") {

            $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id), function (response, status, xhr) {
                if (response != '') {
                    var id2 = $("#to").val();

                    if ('<?php echo $valida ?>' == "") {

                        var idto = $("#valto").val();

                        $("#to option[value=" + idto + "]").attr("selected", true);
                        $("#from2 option[value=" + idto + "]").attr("selected", true);

                        var idFrom = $("#from").val();
                        $("#to2 option[value=" + idFrom + "]").attr("selected", true);

                        $('#from2').attr('disabled', 'disabled');
                        $('#to2').attr('disabled', 'disabled');
                    }



                    $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id2));

                    $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id2));

                }
            });

            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));

        }




//    setTimeout(function () {

        //var tempo = $("#temporal").val();
        //$("#temporal").val(tempo);

        //alert(tempo);



//    }, 1000);

    });

	 function poner(id, id2) {
	         var id = id_ag;
        var id2 = id2 //'agency';
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_actual = $('#fecha_actual').val();
        //debugger

        //$("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2), function (response, status, xhr) {
        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2 + '/' + fecha_inicio + '/' + fecha_actual), function (response, status, xhr) {
        var id_leader = $('#id_leader').val();
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_actual = $('#fecha_actual').val();

        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/superclub/' + id_leader + '/' + fecha_inicio + '/' + fecha_actual));
        });
	 }


    //function poner(id, id2) {
		//year_actual();
		var id_ag = $('#id_agency').val();
       var ya = (new Date).getFullYear();
       var hoy = new Date();
       var dd = hoy.getDate();
       var mm = hoy.getMonth()+1; //hoy es 0!
       var yyyy = hoy.getFullYear();

        if(dd<10) {
            dd='0'+dd
        }

        if(mm<10) {
            mm='0'+mm
        }

        //hoy = mm+'/'+dd+'/'+yyyy;
        hoy = yyyy + '-' +mm+ '-' +dd;

        //alert(ano);
       var y_actual = ya + '-01'+'-01';
        //debugger;
       document.getElementById("fecha_inicio").value = y_actual;
       document.getElementById("fecha_actual").value = hoy;

        var id = id_ag;
        var id2 = 'agency';
        var fecha_inicio = y_actual;//$("#fecha_inicio").val();
        var fecha_actual = hoy;//$('#fecha_actual').val();
        //debugger

        //$("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2), function (response, status, xhr) {
        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2 + '/' + fecha_inicio + '/' + fecha_actual), function (response, status, xhr) {
        var id_leader = $('#id_leader').val();
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_actual = $('#fecha_actual').val();

        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/superclub/' + id_leader + '/' + fecha_inicio + '/' + fecha_actual));
        });

    //}


    $('#agency').change(function () {
		var ag = $("#agency").val();
        if ($("#agency").val() == "") {

            $('#uagency').attr('disabled', true);
            $('#uagency').val('');
            $('#id_auser').val('');
            $('#id_agency').val('-1');
            $('#comision').val('0');
            $('#disponible').val('0');
        } else {
            $('#uagency').attr('disabled', false);
        }
        $("#price_exten01").val(0);
        $("#price_exten02").val(0);
//alert($("#agency").val() );
        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#subtochild22").val(0);
        $("#subtoadult22").val(0);
        $("#subtochildwf1").val(0);
        $("#subtoadultwf1").val(0);
        $("#subtochildsp1").val(0);
        $("#subtoadultsp1").val(0);
        $("#subtochildsd1").val(0);
        $("#subtoadultsd1").val(0);

        //$("#subtochild33").val(0);
        //$("#subtoadult33").val(0);
        //$("#subtochild2").val(0);
        //$("#subtoadult2").val(0);
        //$("#subtochild4").val(0);
//        $("#subtoadult4").val(0);



        $("#trip_no").val("");

        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#subtochild4").val(0);
        $("#subtoadult4").val(0);

        $("#trip_no2").val("");

        $("#pickup1").val("");
        $("#dropoff1").val("");
        $("#pickup2").val("");
        $("#dropoff2").val("");


        $("#from option[value=" + 0 + "]").attr("selected", true);
        $("#to option[value=" + 0 + "]").attr("selected", true);
        $("#from2 option[value=" + 0 + "]").attr("selected", true);
        $("#to2 option[value=" + 0 + "]").attr("selected", true);

        $("#ext_from1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_from2 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to2 option[value=" + 0 + "]").attr("selected", true);

        $("#ext_from1").html("");
        $("#ext_from2").html("");

        $("#ext_to1").html("");
        $("#ext_to2").html("");

        CalcularTotalTotal();

    });



    $('#pax').change(function () {
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var total;
        if (pax2 === "") {
            pax2 = 0;
            // $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        total = (parseInt(pax) + parseInt(pax2));
        $('#totalpax').val(total);

        CalcularTotalTotal();

    });

    function CalcularTotal(pax_1, pax_2) {

        var transporChil1 = $("#subtochild1").val();
        var transporAdul1 = $("#subtoadult1").val();
        var transporChil2 = $("#subtochild2").val();
        var transporAdul2 = $("#subtoadult2").val();
        var price_exten01 = $("#price_exten01").val();
        var price_exten02 = $("#price_exten02").val();
        var price_exten03 = $("#price_exten03").val();
        var price_exten04 = $("#price_exten04").val();

        var x = $("#price1").val();


        //actualizacion

        var y = $("#price2").val();

        //standard
        if (x == 1) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();

        }

        //superflex
        if (x == 2) {
            var transporChil1 = $("#subtochild22").val();
            var transporAdul1 = $("#subtoadult22").val();
        }

        //webfare
        if (x == 3) {
            var transporChil1 = $("#subtochildwf1").val();
            var transporAdul1 = $("#subtoadultwf1").val();
        }

        //superpromo
        if (x == 4) {
            var transporChil1 = $("#subtochildsp1").val();
            var transporAdul1 = $("#subtoadultsp1").val();
        }

        //superdiscount
        if (x == 5) {
            var transporChil1 = $("#subtochildsd1").val();
            var transporAdul1 = $("#subtoadultsd1").val();
        }

        //tarifa special
        if (x == 6) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();
        }

        //trip no 2
        //standard

        if (y == 1) {
            var transporChil2 = $("#subtochild2").val();
            var transporAdul2 = $("#subtoadult2").val();
        }

        //superflex

        if (y == 2) {
            var transporChil2 = $("#subtochild4").val();
            var transporAdul2 = $("#subtoadult4").val();
        }

        if (y == 3) {
            var transporChil2 = $("#subtochildwf2").val();
            var transporAdul2 = $("#subtoadultwf2").val();
        }

        if (y == 4) {
            var transporChil2 = $("#subtochildsp2").val();
            var transporAdul2 = $("#subtoadultsp2").val();
        }

        if (y == 5) {
            var transporChil2 = $("#subtochildsd2").val();
            var transporAdul2 = $("#subtoadultsd2").val();
        }

        if (y == 7) {
            var transporChil2 = $("#subtochil2").val();
            var transporAdul2 = $("#subtoadult2").val();
        }



        if (isNaN(transporChil1)) {
            transporChil1 = 0;
        }
        if (isNaN(transporAdul1)) {
            transporAdul1 = 0;
        }
        if (isNaN(transporChil2)) {
            transporChil2 = 0;
        }
        if (isNaN(transporAdul2)) {
            transporAdul2 = 0;
        }
        if (isNaN(price_exten01)) {
            price_exten01 = 0;
        }
        if (isNaN(price_exten02)) {
            price_exten02 = 0;
        }
        if (isNaN(price_exten03)) {
            price_exten03 = 0;
        }
        if (isNaN(price_exten04)) {
            price_exten04 = 0;
        }

        //alert(transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+price_exten01+', '+price_exten02+', '+price_exten03+', '+price_exten04);
        var price_exten = parseFloat(price_exten01) + parseFloat(price_exten02) + parseFloat(price_exten03) + parseFloat(price_exten04);

        var transadult = (parseFloat(transporAdul1) + parseFloat(transporAdul2)) * pax_1;
        var transchild = (parseFloat(transporChil1) + parseFloat(transporChil2)) * pax_2;
        var totalA = parseFloat(transadult) + (parseFloat(price_exten) * pax_1);
        var totalC = parseFloat(transchild) + (parseFloat(price_exten) * pax_2);
        var paxadult = $("#pax").val();

        var totalP = totalA + totalC;




        $("#totalPagar2").text(totalP.toFixed(2));
        $("#extenadult").text('$' + (price_exten * pax_1).toFixed(2));
        $("#extenchil").text('$' + (price_exten * pax_2).toFixed(2));
        $("#transporadult").text('$' + transadult.toFixed(2));
        $("#transporechil").text('$' + transchild.toFixed(2));

        if(paxadult == 0){
            $("#subtoadult").text('$' + (0.00).toFixed(2));
        }else{

            $("#subtoadult").text('$' + (totalA / parseFloat($("#pax").val())).toFixed(2));

        }




        $("#transporechil").text('$' + transchild.toFixed(2));
        if (parseFloat($("#pax2").val()) <= 0) {
            $("#subtochild").text('$0.00');
        } else {
            $("#subtochild").text('$' + (totalC / parseFloat($("#pax2").val())).toFixed(2));
        }
        return totalP;
    }

    function comision() {

        var id_agency = $('#id_agency').val();
        var type_rate = $('#type_rate').val();

        if (id_agency == '-1') {
            id_agency = -1;
            type_rate = 0;

            return 0;
        }
        if (type_rate == '1') {

            $("#comision").val(0);

        }
        var pax_1 = $('#pax').val();
        var pax_2 = $('#pax2').val();
        var total;
        if (pax_1 == "") {
            pax_1 = 0;
        }
        if (pax_2 == "") {
            pax_2 = 0;
        }

        var totalP = CalcularTotal(pax_1, pax_2);
        if (totalP > 0) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();
            var transporChil2 = $("#subtochild2").val();
            var transporAdul2 = $("#subtoadult2").val();
            var porc_comi1 = $("#valorcomision01").val();
            var porc_comi2 = $("#valorcomision02").val();
            if (porc_comi2 != 0) {
                var porc_comiEx = (parseFloat(porc_comi1) + parseFloat(porc_comi2)) / 2;
                $("#comision").val((parseFloat(porc_comi1) + parseFloat(porc_comi2) + parseFloat(porc_comiEx)) / 2);
            } else {
                var porc_comiEx = porc_comi1;
                $("#comision").val(porc_comi1);
            }
            var transpor1 = (parseFloat(transporChil1) * parseFloat(pax_2)) + (parseFloat(transporAdul1) * parseFloat(pax_1));
            var transpor2 = (parseFloat(transporChil2) * parseFloat(pax_2)) + (parseFloat(transporAdul2) * parseFloat(pax_1));
            var transporEx = parseFloat(totalP) - (parseFloat(transpor1) + parseFloat(transpor2));
            var comiT1 = parseFloat(transpor1) * parseFloat(porc_comi1) / 100;
            var comiT2 = parseFloat(transpor2) * parseFloat(porc_comi2) / 100;

            if (transporEx > 0) {
                var comiEx = parseFloat(transporEx) * parseFloat(porc_comiEx) / 100;
            } else {
                var comiEx = 0;
            }
            var comi = parseFloat(comiT1) + parseFloat(comiT2) + parseFloat(comiEx);
            //alert(comi);
            $("#totalComision").text(comi.toFixed(2));
            $("#totalcom").val(comi);
            $("#totalPagar").val(Math.ceil(totalP).toFixed(2));
            //alert(subtotalAdulto+', '+subtotalninio+', '+totalP+','+transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+porc_comi1+', '+porc_comi2+', '+transpor1+', '+transpor2+', '+transporEx+', '+comiT1+', '+comiT2+', '+porc_comi2+', '+comiEx+', '+comi);

        } else {

            var comi = 0;
        }
        return comi;
    }

    $('#pax2').change(function () {

        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        var total;
        total = (parseInt(pax) + parseInt(pax2));

        $('#totalpax').val(total);

        CalcularTotalTotal();
    });




    $('#oneway').change(function () {
        /*$("#round").css("display", "none");*/
//        $("#fecha_retorno").attr("readonly", 'readonly');
//        $("#fecha_retorno").attr("disable", 'disable');
//        $("#from2").attr("disable", true);
//        $("#from2").attr("readonly", "readonly");
//        $("#pickup2").attr("readonly", "readonly");
//        $("#dropoff2").attr("readonly", "readonly");
//        $("#arrival2").attr("readonly", "readonly");
//        $("#to2").attr("readonly", "readonly");
//        $("#ext_from2").attr("readonly", "readonly");
//        $("#departure2").attr("readonly", "readonly");
//        $("#ext_to2").attr("readonly", "readonly");
//        $("#room2").attr("readonly", "readonly");
//        $("#exten3").attr("readonly", "readonly");
//        $("#exten4").attr("readonly", "readonly");
//        $("#trip_no2").html("");
//        $("#departure2").html("");
//        $("#arrival2").html("");

        $("#trip_no2").val("");
        $("#departure2").val("");
        $("#arrival2").val("");
        $("#fecha_retorno").val("");

        $("#pickup2").val("");
        $("#id_pickup2").val("");

        $("#dropoff2").val("");
        $("#id_dropoff2").val("");

        $("#exten3").val("");
        $("#id_ext_pikup3").val("");

        $("#exten4").val("");
        $("#id_ext_pikup4").val("");


        $("#ext_to2").find('option').removeAttr("selected");
        $("#ext_from2").find('option').removeAttr("selected");

        $("#round").css("display", "none");
        $(".sup2").css("margin-top", "2px");
        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#price_exten03").val(0);
        $("#price_exten04").val(0);
        CalcularTotalTotal();
    });

    $('#roundtrip').change(function () {
//        $("#fecha_retorno").attr("disable", '');
//        $("#fecha_retorno").removeAttr("disable");
//        $("#from2").attr("disable", false);
//        $("#departure2").removeAttr("readonly");
//        $("#dropoff2").removeAttr("readonly");
//        $("#pickup2").removeAttr("readonly");
//        $("#arrival2").removeAttr("readonly");
//        $("#to2").removeAttr("readonly");
//        $("#ext_from2").removeAttr("readonly");
//        $("#ext_to2").removeAttr("readonly");
//        $("#exten3").removeAttr("readonly");
//        $("#exten4").removeAttr("readonly");
//        $("#room2").removeAttr("readonly");
//        $("#from2").removeAttr("readonly");
//        $("#round").css("display", "block");
        $("#round").css("display", "block");
        $(".sup2").css("margin-top", " -209px");

    });
    // $("#fecha_salida").val(moment().format('MM-DD-YYYY'));
    //  $("#fecha_retorno").val(moment().add(1, 'days').format('MM-DD-YYYY'));
    //  alert($("#fecha_salida").val());
    // fechaRetorno($("#fecha_salida").val());
    // new Lightpick({
    //           field: document.getElementById('fecha_salida'),
    //           numberOfMonths: 1,
    //           minDate: moment().startOf(new Date()).add((1)-1, 'days'),
    //           onSelect: function(salida){
    //           // rango(salida, null);
    //           }
    //       });

    //       new Lightpick({
    //           field: document.getElementById('fecha_retorno'),
    //           numberOfMonths: 1,
    //           minDate: moment().startOf(new Date()).add((1)-1, 'days'),
    //           onSelect: function(salida){
    //           // rango(salida, null);
    //           }
    //       });

    $('#fecha_salida').datepicker({
        dateFormat: 'mm-dd-yy',
        minDate: 0
    });

//    $('#fecha_salida1').datepicker({
//        dateFormat: 'mm-dd-yy',
//        minDate: 0
//    });

    $("#dataclick1").click(function (e) {
        e.preventDefault();
        //$("#fecha_salida").datepicker("show");
    });

    $("#fecha_retorno").datepicker({
        dateFormat: 'mm-dd-yy',
        beforeShow: function () {
            if ($('#fecha_retorno').attr("disable")) {
                return false;
            }
        }
    });

    $("#dataclick2").click(function (e) {
        e.preventDefault();
        //$("#fecha_retorno").datepicker("show");
    });

    $("#fecha_salida").change(function () {
        $("#trip_no").val('');
        $("#departure1").val('');
        $("#arrival1").val('');
        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        CalcularTotalTotal();
        // alert($("#fecha_salida").val());
        fechaRetorno($("#fecha_salida").val());
    });

    function fechaRetorno(menor) {
        var d = new Date(menor);
        d.setTime(d.getTime())
        $('#fecha_retorno').datepicker('option', 'minDate', d);
    }

    $("#fecha_retorno").change(function () {
        $("#trip_no2").val('');
        $("#departure2").val('');
        $("#arrival2").val('');
        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        CalcularTotalTotal();
    });

    $("#from").change(function () {
       var ctry = $('select[name="fromt"] option:selected').text();
        $('#from').prop('title',ctry);
        if (document.getElementById('oneway').checked) {

            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");

        }

        var id = $("#from").val();
        $("#pickup1").val('');
         $("#id_p1").html('<select name="id_p1" class="select2_single form-control" id="id_p1"> <option value=""> </option></select>');
//    $("#dropoff2").val('');
        $("#id_dropoff1").html('<select name="id_dropoff1" class="select2_single form-control" id="id_dropoff1"><option value="" selected=""></option></select>');
//       $("#dropoff2").val('');
//       $("#id_dropoff2").val('');
        $("#dropoff1").val('');
        $("#id_dropoff1").val('');
//        $("#pickup2").val('');
//        $("#id_pickup2").val('');

        $('#pickup1').removeAttr("disabled");

        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#trip_no").val("");
        CalcularTotalTotal();
        $('#exten1').attr('disabled', 'disabled');
        $("#exten1").val('');
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
        if(id == 0){
            document.getElementById('search1').style.display = "none";
            document.getElementById('trip_no').value = "";
        }

        if(id > 0){
            document.getElementById('search1').style.display = "";
            document.getElementById('trip_no').value = "";
        }


    });

    $("#to").change(function () {
        var ctry = $('select[name="to"] option:selected').text();
        $('#to').prop('title',ctry);

        if (document.getElementById('oneway').checked) {

            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");

        }

        var id = $("#to").val();

        $("#id_p1").html('<select name="id_p1" class="select2_single form-control" id="id_p1"> <option value=""> </option></select>');
//    $("#dropoff2").val('');
        $("#id_dropoff1").html('<select name="id_dropoff1" class="select2_single form-control" id="id_dropoff1"><option value="" selected=""></option></select>');
        //        $("#dropoff2").val('');
//        $("#id_dropoff2").val('');
        $("#dropoff1").val('');
        $("#id_dropoff1").val('');
//        $("#pickup2").val('');
//        $("#id_pickup2").val('');

        $('#dropoff1').removeAttr("disabled");

//        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#trip_no").val("");
        CalcularTotalTotal();
        $('#exten2').attr('disabled', 'disabled');
        $("#exten2").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
//            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
//            $("#from2").attr("value", id);
//            setTimeout($("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val())), 200);
            var idFrom = $("#from").val();
        }
    });


    $("#from2").change(function () {
        var ctry2 = $('select[name="fromt2"] option:selected').text();
        $('#from2').prop('title',ctry2);
        if (document.getElementById('roundtrip').checked) {

            //$("#puestosEnUso").load("<?php /*echo $data['rootUrl'];*/ ?>admin/reservas/ocuparPuestoUsuario/4");

        }

        var id = $("#from2").val();

        $("#id_pickup2").html('<select name="id_p1" class="select2_single form-control" id="id_p1"> <option value=""> </option></select>');
//    $("#dropoff2").val('');
        $("#id_dropoff2").html('<select name="id_dropoff1" class="select2_single form-control" id="id_dropoff1"><option value="" selected=""></option></select>');

        $("#dropoff2").val('');
        $("#id_dropoff2").val('');
        $("#pickup2").val('');
        $("#id_pickup2").val('');

        $('#pickup2').removeAttr("disabled");


        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");
        CalcularTotalTotal();
        $('#exten3').attr('disabled', 'disabled');
        $("#exten3").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
        }

        if(id == 0){
            document.getElementById('searchp2').style.display = "none";
            document.getElementById('trip_no2').value = "";
        }

        if(id > 0){
            document.getElementById('searchp2').style.display = "";
            document.getElementById('trip_no2').value = "";
        }
    });

    $("#to2").change(function () {
        var ctry2 = $('select[name="to2"] option:selected').text();
        $('#to2').prop('title',ctry2);
        if (document.getElementById('roundtrip').checked) {

            //$("#puestosEnUso").load("<?php /*echo $data['rootUrl'];*/ ?>admin/reservas/ocuparPuestoUsuario/4");

        }

        var id = $("#to2").val();


        $("#id_pickup2").html('<select name="id_p1" class="select2_single form-control" id="id_p1"> <option value=""> </option></select>');
//    $("#dropoff2").val('');
        $("#id_dropoff2").html('<select name="id_dropoff1" class="select2_single form-control" id="id_dropoff1"><option value="" selected=""></option></select>');
        $("#dropoff2").val('');
        $("#id_dropoff2").val('');

        $('#dropoff2').removeAttr("disabled");

//        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");
        CalcularTotalTotal();
        $('#exten4').attr('disabled', 'disabled');
        $("#exten4").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
        }
    });


//    function changevalue()
//        {
//           //var text2 = document.getElementById('transporadult');
//           //obtenemos el objeto del elemento de id x..
//           var text2 = document.getElementById('x');
//
//           //aca asignas los valores a las cajas de texto declaradas
//           text2.value = document.getElementById('price_exten01').value;
//           // ...
//           // ....
//        }

    function extenprince(id, id2) {

        if (document.getElementById('oneway').checked) {

            var from = $("#from").val();
            var to = $("#to").val();
            var trip_no = $('#trip_no').val();
            var fechasal = $("#fecha_salida").val();

            var tp = 1;

        }


        if (document.getElementById('roundtrip').checked) {

            var from = $("#from").val();
            var to = $("#to").val();
            var trip_no = $('#trip_no').val();
            var fechasal = $("#fecha_salida").val();

            var from2 = $("#from2").val();
            var to2 = $("#to2").val();
            var trip_no2 = $('#trip_no2').val();
            var fecharetor = $("#fecha_retorno").val();

            var tp = 2;

        }


        var transAdult = $("#transporadult").text();
        var transChild = $("#transporechil").text();




        if (isNaN(transAdult)) {
            transAdult = 0;
        } else {
            transAdult = parseFloat(transAdult.substring(1, transAdult.length));
        }
        if (isNaN(transChild)) {
            transChild = 0;
        } else {
            transChild = parseFloat(transChild.substring(1, transChild.length));
        }
        var id_agency = $("#id_agency").val();

        var type_rate = $("#type_rate").val();
        if (id_agency == '') {
            id_agency = '-1';
        }


        //var url = '<? echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal + '/' + tp;

        var url = '<?php echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal + '/' + tp + '/' + from2 + '/' + to2 + '/' + trip_no2 + '/' + fecharetor;
//        var url = '<? echo $data['rootUrl']; ?>consul/exten/' + id + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal;
        $("#userr").load(encodeURI(url));

    }



    $("#ext_from1").change(function () {
        var id = $("#ext_from1").val();
        var id2 = 1;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten1').removeAttr('disabled');
            $("#pickup1").val('');
            $("#id_p1").val('');
            $('#pickup1').attr('disabled', 'disabled');
        } else {
            $('#pickup1').removeAttr('disabled');
            $('#exten1').attr('disabled', 'disabled');
            $("#exten1").val('');
            $("#id_ext_pikup1").val('');
        }
    });
    $("#ext_to1").change(function () {
        var id = $("#ext_to1").val();
        var id2 = 2;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten2').removeAttr('disabled');
            $("#dropoff1").val('');
            $("#id_dropoff1").val('');
            $('#dropoff1').attr('disabled', 'disabled');
        } else {
            $('#dropoff1').removeAttr('disabled');
            $('#exten2').attr('disabled', 'disabled');
            $("#exten2").val('');
            $("#id_ext_pikup2").val('');
        }
    });

    $("#ext_from2").change(function () {

        var id = $("#ext_from2").val();
        var id2 = 3;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten3').removeAttr('disabled');
            $("#pickup2").val('');
            $("#id_pickup2").val('');
            $('#pickup2').attr('disabled', 'disabled');
        } else {
            $('#pickup2').removeAttr('disabled');
            $('#exten3').attr('disabled', 'disabled');
            $("#exten3").val('');
            $("#id_ext_pikup2").val('');
        }
    });
    $("#ext_to2").change(function () {
        var id = $("#ext_to2").val();
        var id2 = 4;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten4').removeAttr('disabled');
            $("#dropoff2").val('');
            $("#id_dropoff2").val('');
            $('#dropoff2').attr('disabled', 'disabled');
        } else {
            $('#dropoff2').removeAttr('disabled');
            $('#exten4').attr('disabled', 'disabled');
            $("#exten4").val('');
            $("#id_ext_pikup4").val('');
        }
    });

    function valorExtra() {
        CalcularTotalTotal();
    }
    $("#extra").change(function () {
        valorExtra();
    });

    $("#descuento").keypress(Event, function (e) {
        if (e.charCode > 47 && e.charCode < 58) {
            var char = String.fromCharCode(e.charCode);
            var valor = $("#descuento").val()
            var d = valor + '' + char;
            if (d > 100 || d < 0) {
                return false;
            }
            /*
             $("#descuento").val(valor + char + '%');
             var pos = valor.length;

             if((valor+char) == '' ){
             $("#descuento").val('0%');
             }
             establerCursorPosicion(pos+1,'descuento');*/
        } else {
            return false;
        }
    });

    var saber;

    $("#tipo_pass").change(function () {
        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#trip_no").val("");

        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");

        $("#ext_from1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_from2 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to2 option[value=" + 0 + "]").attr("selected", true);
        CalcularTotalTotal();
    });



    $("#popup1 a ").click(function () {

        var est = $('#est').val();

        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var tipo_reserva = $('#tipo_reserva').val();
        var total_pasajeros = $('#total_pasajeros').val();
        var trip_1 = $('#trip_1').val();
        var trip_2 = $('#trip_2').val();


        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        var total;
        total = (parseInt(pax) + parseInt(pax2));

        $('#totalpax').val(total);




        var from = $('#from').val();
        var to = $('#to').val();
        var fecha_sali = $('#fecha_salida').val();
        var tipopas = $('#tipo_pass').val();

        var agency;
        if ($('#id_agency').val() != '-1') {
            agency = $('#id_agency').val()
        } else {
            agency = -1;
        }
        var tipo = 1;
        if ($('#fecha_salida').val() != '' && $('#totalpax').val() != '') {

        } else {
            var mensage = "";
            if (trim($('#fecha_salida').val()) == '') {
                mensage += "- Departure date is required. \n";
            }
            if (trim($('#totalpax').val()) == '') {
                mensage += "- Total passengers required. \n";
            }
            if (trim($('#from').val()) == '') {
                mensage += "From is required. \n";
            }
            if (trim($('#to').val()) == '') {
                mensage += "To  is required. \n";
            }

            alert(mensage);

            return false;

        }
        var special_price_name = $('#special_price_name').val();




//	document.write(special_price_name);
	//var special_price_name = cadena.replace(/[<>%#!(){}"?^*/~|`&@%$:.+-\s+]/g,"_"); //remplaza todas las l por j en la cadena
//	//document.write(cadena);
//
        //alert(cadena);

//
//        $("#transporadult").html("");
//        $("#transporechil").html("");
//        $("#subtoadult").html("");
//        $("#subtochild").html("");
//        $("#subtoadult1").val(0);
//        $("#subtochild1").val(0);
//        $("#subtoadult2").val(0);
//        $("#subtochild2").val(0);
//        $("#transporechil").html("");
//       $("#totaltotal").html("$ 00.0");
//        //$("#ext_from1 option[value="+0+"]").attr("selected",true);
//        $("#extenadult").html("");
//        $("#extenchil").html("");


        //setInterval(function(){

        $('.content-popup').html(" ");

//        function update(){
//
//        var tempo = $("#temporale").val();
         //console.log(tempo);

//        $('.content-popup').load('<?php /*echo $data['rootUrl'];*/ ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name + '/' + total + '/' + est + '/' + tipo_reserva + '/' + total_pasajeros + '/' + trip_1 + '/' + trip_2 + '/' + tempo);

//        }

        //setInterval(update, 5000);
//        var storeTimeInterval = setInterval(update, 5000);
        //$('.content-popup').load('<? echo $data['rootUrl']; ?>consul/extenprice/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);


        $('.content-popup').html(" ");
        $('#loading').fadeIn('slow');
        $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name + '/' + total + '/' + est + '/' + tipo_reserva + '/' + total_pasajeros + '/' + trip_1 + '/' + trip_2 , function(data){
            $('#loading').fadeOut();
        });

        $('#mascaraP').fadeIn('slow');
        $('#popup').fadeIn('slow');
        saber = 1;




//        setTimeout(function () {
//
//            alert("detenido");
//            clearInterval(storeTimeInterval);
//
//        }, 15000);
//

//        var storeTimeInterval = setInterval(function(){
//	        	++countTime;
//	        	$("pre").append(countTime*5 + 'sec.<br/>');
//	        	if(countTime == 12){
//	        		clearInterval(storeTimeInterval);
//	        		$("pre").append('stop');
//	        	}
//	         }, 5000);


    });


    $("#tipo_pass").click(function () {


        var est = $('#est').val();
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var tipo_reserva = $('#tipo_reserva').val();
        var total_pasajeros = $('#total_pasajeros').val();
        var trip_1 = $('#trip_1').val();
        var trip_2 = $('#trip_2').val();
        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        var total;
        total = (parseInt(pax) + parseInt(pax2));

        $('#totalpax').val(total);




        var from = $('#from').val();
        var to = $('#to').val();
        var fecha_sali = $('#fecha_salida').val();
        var tipopas = $('#tipo_pass').val();

        var agency;
        if ($('#id_agency').val() != '-1') {
            agency = $('#id_agency').val()
        } else {
            agency = -1;
        }
        var tipo = 1;
        if ($('#fecha_salida').val() != '' && $('#totalpax').val() != '') {

        } else {
            var mensage = "";
            if (trim($('#fecha_salida').val()) == '') {
                mensage += "- Departure date is required. \n";
            }
            if (trim($('#totalpax').val()) == '') {
                mensage += "- Total passengers required. \n";
            }
            if (trim($('#from').val()) == '') {
                mensage += "From is required. \n";
            }
            if (trim($('#to').val()) == '') {
                mensage += "To  is required. \n";
            }

            alert(mensage);

            return false;

        }
        var special_price_name = $('#special_price_name').val();

//
//        $("#transporadult").html("");
//        $("#transporechil").html("");
//        $("#subtoadult").html("");
//        $("#subtochild").html("");
//        $("#subtoadult1").val(0);
//        $("#subtochild1").val(0);
//        $("#subtoadult2").val(0);
//        $("#subtochild2").val(0);
//        $("#transporechil").html("");
//       $("#totaltotal").html("$ 00.0");
//        //$("#ext_from1 option[value="+0+"]").attr("selected",true);
//        $("#extenadult").html("");
//        $("#extenchil").html("");
        $('.content-popup').html(" ");
        $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name + '/' + total + '/' + est + '/' + tipo_reserva + '/' + total_pasajeros + '/' + trip_1 + '/' + trip_2);

        //$('.content-popup').load('<? echo $data['rootUrl']; ?>consul/extenprice/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);
        $('#mascaraP').fadeIn('slow');
        $('#popup').fadeIn('slow');
        saber = 1;

    });

    $("#popup2 a").click(function () {

        var est = $('#est').val();

        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var tipo_reserva = $('#tipo_reserva').val();
        var total_pasajeros = $('#total_pasajeros').val();
        var trip_1 = $('#trip_1').val();
        var trip_2 = $('#trip_2').val();

        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        var total;
        total = (parseInt(pax) + parseInt(pax2));

        $('#totalpax').val(total);
        var from = $('#from2').val();
        var to = $('#to2').val();
        var fecha_retorno = $('#fecha_retorno').val();
        var tipopas = $('#tipo_pass').val();

        if ($('#trip_no').val() == '') {
            alert("Must fill out the form ONE WAY");
            document.getElementById("save2").style.display = "none";
            return false;
        }

        tipo = 2;

        if ($('#from2').attr("readonly") != "readonly") {
            if ($('#fecha_retorno').val() != '' && $('#totalpax').val() != '') {
            } else {

                var mensage = "";



                if ($('#fecha_retorno').val() == '') {
                    mensage += "- Return date is required. \n";
                }

                if ($('#totalpax').val() == '') {
                    mensage += "- Total passengers required. \n";
                }

                if ($('#from2').val() == '') {
                    mensage += "- From is required. \n";
                }

                if ($('#to2').val() == '') {
                    mensage += "- To  is required. \n";
                }

                $("#subtoadult2").val("0");
                $("#subtochild1").val("0");

                alert(mensage);

                return false;

            }
            var agency;
            if ($('#id_agency').val() != '-1') {
                agency = $('#id_agency').val()
            } else {
                agency = -1;
            }


            var special_price_name = $('#special_price_name').val();

            $('.content-popup').html(" ");
            $('#loading').fadeIn('slow');
            $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_retorno + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name + '/' + total + '/' + est + '/' + tipo_reserva + '/' + total_pasajeros + '/' + trip_1 + '/' + trip_2 , function(){
                $('#loading').fadeOut();
            });
            $('#mascaraP').fadeIn('slow');
            $('#popup').fadeIn('slow');

            saber = 2;
            // alert(texto[0]+'trips/1/12-12/1'+'][400x250]');
        }
    });

    $("#newClient").click(function () {
        registrarCliente();
    });


    function registrarCliente() {
        var email = $("#email1").val();
        var firstname = $("#firstname1").val();
        var lastname = $("#lastname1").val();
        var phone = $("#phone1").val();
        var id = $("#idCliente").val();
        if (id == '') {
            id = 0;
        }
        if (email == '') {
            email = 0;
        }
        if (firstname == '') {
            firstname = 0;
        }
        if (lastname == '') {
            lastname = 0;
        }
        if (phone == '') {
            phone = 0;
        }
        $("#clienteN").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/clientes/pagador/' + email + '/' + firstname + '/' + lastname + '/' + phone + '/' + id), function () {
            $("input[name='creator']").remove();
        });
        $('#mascaraP').fadeIn('slow');
        $('#clienteN').fadeIn('slow');
        $("#email1").focus();
        //setInterval('setTimeout("activarenvioPago()",5000)',5000);
    }


    function borrar() {
        $("#transporadult").html("$ 00.0");
        $("#transporechil").html("$ 00.0");
        $("#subtoadult").html("$ 00.0");
        $("#subtochild").html("$ 00.0");
        $("#totaltotal").html("$ 00.0");
        //$("#ext_from1 option[value="+0+"]").attr("selected",true);
        $("#extenadult").html("$ 00.0");
        $("#extenchil").html("$ 00.0");
        $("#totalPagar").html('$ 00.00');
        $("#totalPagarnet").html('$ 00.00');

    }

    function llamar(extraSettings, $innerbox) {
        var $innerbox = $innerbox;
        var dato = extraSettings;
        if (saber == 1) {
            var from = $('#from').val();
            var to = $('#to').val();
            var fecha_sali = $('#fecha_salida').val();
            var tipopas = $('#tipo_pass').val();
        } else {
            var from = $('#from2').val();
            var to = $('#to2').val();
            var fecha_sali = $('#fecha_retorno').val();
            var tipopas = $('#tipo_pass').val();
        }

        var ruta = dato[0] + '/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber;
        // alert(ruta);

        $.get(ruta, function (data) {
            $(data).appendTo($innerbox);
        });

        if (saber == 1) {
            var mensage = "";
            if ($('#fecha_salida').val() == '') {
                mensage += "- Departure date is required. \n";
            }
            if ($('#totalpax').val() == '') {
                mensage += "Total pass  is requerido. \n";
            }
            if ($('#from').val() == '') {
                mensage += "From is requerido. \n";
            }
            if ($('#to').val() == '') {
                mensage += "to  is requerido. \n";
            }
            if (mensage) {

                $("P.close A").click();
            }
        } else {
            var mensage = "";
            if ($('#fecha_retorno').val() == '') {
                mensage += "fecha salida is requerida. \n";
            }
            if ($('#totalpax').val() == '') {
                mensage += "total pass  is requerido. \n";
            }
            if ($('#from2').val() == '') {
                mensage += "From is requerido. \n";
            }
            if ($('#to2').val() == '') {
                mensage += "to  is requerido. \n";
            }
            if (mensage) {

                $("P.close A").click();
            }


        }
    }
    $('#btn-save1').click(function () {
        if (validarFomulario()) {
            bPreguntar = false;
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").val());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('target', '_parent');
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/save');
            $("#content").css("display", "0");
            $("#formula").submit();
        }

    });

    $('#btn-save2').click(function () {
        $('body').loadingModal({text: 'LOADING PLEASE WAIT...'});
        $('body').loadingModal('animation', 'cubeGrid');
        // return false;
        if (validarFomulario()) {
            bPreguntar = false;
            preguntarAntesDeSalir();
            CalcularTotalTotal();
            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/3");
            $("#totP").val($("#totalPagar").val());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('target', '_parent');
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/save');
            $("#content").css("opacity", "0");
            $("#formula").submit();
        }else{
            $('body').loadingModal('destroy');
        }

    });

    $("#enviarF").click(function () {
        if (validarFomulario()) {
            if ($("#enviar_escondido").val() == 1) {
                $("#enviar_escondido").val(0);
                irApagar();
            } else {
                registrarCliente();
            }
        }
    });

    function irApagar() {
        if (validarFomulario()) {
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").val());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/pago');
            $("#formula").attr('target', '_blank');
            var hilo = setInterval("estadoPago()", 5000);
            $("#formula").submit();
        }
    }

    function activarenvioPago() {
        if ($("#enviar_escondido").val() == 1) {
            $("#enviar_escondido").val(0);
            irApagar();
        }
    }
    //numref
    function validarFomulario() {
        var msError = '';
            // if (trim($("#numref").val()) == '') {
            //     // msError = '- Enter the Reference Number';
            //     // alert(msError);
            //     // $("#numref").val(-1);
            //     // $("#numref").focus();
            //     // return false;
            // }

        var msError = '';
        if (trim($("#idCliente").val()) == '') {
            if (trim($("#firstname1").val()) == '') {
                msError = '- Enter the first name of the passenger';
                alert(msError);
                $("#firstname1").focus();
                return false;
            }

            if (trim($("#lastname1").val()) == '') {
                msError = '- Enter the last name of the passenger';
                alert(msError);
                $("#lastname1").focus();
                return false;
            }
        }


        if (trim($("#id_agency").val()) == '-1' /*&& trim($("#id_agency").val()) != ''*/) {
//            if (trim($("#uagency").val()) == '') {
            msError = '- Enter data Agency';
            alert(msError);
            $("#agency").focus();
            return false;
//            }
        }


        if (trim($("#comments").val()) == '') {
            msError = '- Please Type One Note';
            alert(msError);
            $("#comments").focus();
            return false;
        }

        var canal = 0;
        var num = document.getElementsByName('canal').length
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('canal').item(i).checked) {
                canal = document.getElementsByName('canal').item(i).value;
            }
        }
        if (canal == 0) {
            msError = '- Select the channel through which came the reservation.';
            alert(msError);
            $("#calan_phone").focus();
            return false;
        }

        if (trim($("#trip_no").val()) == '') {
            msError = '- Select Output Trip';
            alert(msError);
            $("#trip_no").focus();
            return false;
        }
        if (trim($("#id_p1").val()) == '' && trim($("#ext_from1").val()) == '0') {
            msError = '- Enter  pickup of ONE WAY';
            alert(msError);
            $("#pickup1").focus();
            return false;
        }

        if (trim($("#id_dropoff1").val()) == '' && trim($("#ext_to1").val()) == '0') {
            msError = '- Enter  dropoff of ONE WAY';
            alert(msError);
            $("#dropoff1").focus();
            return false;
        }
        if (document.getElementById('roundtrip').checked) {
            if (trim($("#trip_no2").val()) == '') {
                msError = '- Select Return Trip';
                alert(msError);
                $("#trip_no2").focus();
                return false;
            }
            if (trim($("#id_pickup2").val()) == '' && trim($("#ext_from2").val()) == '0') {

                msError = '- Enter  pickup of Return TRIP';
                alert(msError);
                $("#pickup2").focus();
                return false;
            }
            if (trim($("#id_dropoff2").val()) == '' && trim($("#ext_to2").val()) == '0') {
                msError = '- Enter  dropoff of Return TRIP';
                alert(msError);
                $("#dropoff2").focus();
                return false;
            }

        }

        var tipo_pago = 0;
        var num = document.getElementsByName('opcion_pago').length
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('opcion_pago').item(i).checked) {
                tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
            }
        }
        if (tipo_pago == 0) {
            msError = '- Select the type of payment';
            //alert(msError);
            //return false;
        }

        return true;
    }

    $('#btn-cancel1').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>admin/reservas';
    });

    function trim(myString) {
        if (myString == null || myString == '') {
            return '';
        }
        return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
    }


    $("#apply_payment").click(function () {
        //cargarHoteles();
        //alert('Apply Payment');
    });

    $("#pay_driver").click(function () {
        //cargarHoteles();
//       alert('hola mundo');
        document.getElementById('pago_driver2').value = '0.00';

    });


    //variable utilizada en funcion dupliac() (duplica el valor de saldoporpagar en otheramount)
    var apagare

    function CalcularTotalTotal() {

        //var otheramount_2 = $("#saldoporpagar").text((((apagar_2 + fee) - pay_amount)).toFixed(2));

        var error = "";
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        if (pax2 == "") {
            pax2 = 0;
        }
        if (pax == "") {
            pax = 0;
        }

        error += validateNumber($("#extra").val(), 'Extra', true);
        var extra = 0;
        if (error == "") {
            extra = $("#extra").val();
        }
        var comi = 0/*comision()*/;
        var full = CalcularTotal(pax, pax2) + comi;
//        alert(comi);
        var balance = full - comi;
        var disponible = $("#disponible").val();
        var agency = $("#id_agency").val();

        var tipo_pago = 0;

        var pago_conduct = $("#op_pago_conductor").val();
		//alert(pago_conduct);
        var num = document.getElementsByName('opcion_pago').length
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('opcion_pago').item(i).checked) {
                tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
            }
        }


        //var op_pago_id = $("#op_pago_id").val();
        //Select de Caja Nueva para Paid driver

        var opcion = $("#op_pago_id1").val();

        var pasajero = $("#op_pago_passenger").val();

        //opcion add payment   codigo de envio al controlador para aumento de cargos
        //document.getElementById('opc_ap').value = opcion;

        //$("#opc_ap").val(opcion);
        //$("#prueba").val(opcion);

        tipo_pago = $("#op_pago_id option:selected").val();
        var prepago = $("#op_pago_id2 option:selected").val();
		console.log(tipo_pago);
        var tipo_saldo = $('#opcion_pago_saldo').val();

        var apagar = full;
        if (tipo_saldo == 2) {
            apagar = balance;
        }
        //RESTAMOS DESCUENTO DE %
        error = "";
        error += validateNumber($("#descuento").val(), 'Descuento', true);
        var desc_porc = 0;
        if (error === "") {
            desc_porc = $("#descuento").val();
        }
        //RESTAMOS DESCUENTO DE $
        error = "";
        error += validateNumber($("#descuento_valor").val(), 'Descuento Valor', true);
        var desc_valor = 0;
        if (error === "") {
            desc_valor = $("#descuento_valor").val();
        }
        var pay_amount = $("#pay_amount").val();
        var paid_driver = $("#paid_driver").val();
        var pago_driver = $("#pago_driver").val();
        var total_pagar = $("#totalPagar").val();
        var saldoXpagar = $("#saldoporpagar").val();

        apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat((full * desc_porc) / 100) - parseFloat(desc_valor);

        apagare = apagar;

        var valor = apagar;

        valor = parseFloat(valor) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
        //alert(valor);

//        alert(apagar);
//        exit();

        var fee = apagar * 0.04;


        var otheramount_2 = $("#otheramount").val();


        if (otheramount_2 > 0) {

            var apagar_2 = parseFloat(otheramount_2);


        } else {

            var apagar_2 = parseFloat(apagar);

        }
        var totalPax = parseFloat(pax) + parseFloat(pax2);

        $("#totalComision").text(comi.toFixed(2));



//        if(pago_conduct == '5'){
//            var resultado = disponible - balance;
//            alert(disponible);
//            alert(resultado);
//
//        }
        if (tipo_pago == 5) {




            if (disponible - balance < 0) {
                /*alert('Your available credit is less than the total amount to be paid');
                 $("#opcion_pago").attr("checked",false);
                 $("#opcion_saldo1").attr('checked',false);
                 $("#opcion_saldo2").attr('checked',false);
                 $("#opcion_saldo2").attr('disabled',false);
                 $("#opcion_saldo1").attr('disabled',false);*/
                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/
                var cv = 0;


                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#totalPagar").val((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));
                $("#agency_balance_due").val((apagar).toFixed(2));




                if (pay_amount > 0 && paid_driver == 0 && otheramount_2 == 0) {


                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var totalbalance = ((apagar + temp_prepaid) - (paid_driver)) - (pay_amount);
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid);
                    var saldoporpagar = parseFloat(apagar) + parseFloat(temp_prepaid);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {

                        var cv = 0;
                        var pay_amount = parseFloat($("#pay_amount").val());
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var temp = parseFloat($("#temp").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                        var op_pag_conduct = parseFloat($("#selectcond").val());
                        var result = parseFloat(apagar) + parseFloat(temp_prepaid);
                        //var total = parseFloat(apagar) + parseFloat(temp);

                        $("#saldoporpagar").val((cv).toFixed(2));
                        $("#paid_driver").val((cv).toFixed(2));
                        $("#balance_due").val((cv).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));



                    }

                }



            } else {
//                $("#opcion_saldo2").attr('checked', true);
//                $("#opcion_saldo1").attr('disabled', true);
//                $("#opcion_saldo2").attr('disabled', false);
//                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/
                //$("#totalPagar").val((apagar).toFixed(2));

                //$("#totaltotal").text((apagar).toFixed(2));
//                $("#saldoporpagar").val(((apagar_2 - pay_amount)).toFixed(2));

//                $("#saldoporpagar").val(((cv)).toFixed(2));
//                $("#paid_driver").val((cv).toFixed(2));
//                $("#balance_due").val((cv).toFixed(2));
//                $("#totalPagar").val((result).toFixed(2));
//                $("#totaltotal").text((result).toFixed(2));
//                $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));


                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/
                var cv = 0;


                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#totalPagar").val((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));
                $("#agency_balance_due").val((apagar).toFixed(2));



            }

        } else if (tipo_pago == 7) {

            if (disponible - balance < 0) {

                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');

                var cv = 0;


                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));

                $("#totalPagar").val((cv).toFixed(2));
                $("#totaltotal").text((cv).toFixed(2));
                $("#agency_balance_due").val((cv).toFixed(2));


            } else {

                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');



                $("#saldoporpagar").val(((cv)).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));

                $("#totalPagar").val((cv).toFixed(2));
                $("#totaltotal").text((cv).toFixed(2));
                $("#agency_balance_due").val((cv).toFixed(2));


            }
        } else if (tipo_pago == 1) {
//            $("#opcion_saldo2").attr('checked', true);
//            $("#opcion_saldo1").attr('disabled', true);
//            $("#opcion_saldo2").attr('disabled', false);
//          $("#opcion_pago_saldo").val('2');
            $("#totalPagar").val((apagar).toFixed(2));
            $("#totaltotal").text((apagar).toFixed(2));


            if (otheramount_2 > 0) {


                ("#saldoporpagar").val((((apagar_2) - pay_amount)).toFixed(2));

                //("#saldoporpagar").val((apagar_2).toFixed(2));


                if (opcion === '0') {
                    //$("#balance_due").val(((apagar_2) - (paid_driver) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                if (opcion === '1') {
                    $("#balance_due").val((((apagar_2) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                //COLLECT ON BOARD
                if (opcion === '24') {

                    //alert('hola mundo');
                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                if (opcion === '25') {


                    var fees = parseFloat($("#temp").val());
                    //alert(fees);

                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val(((apagar_2 + fees) - (paid_driver) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));



                }

                if (opcion === '26') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                if (opcion === '27') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }


                //PRED-PAID

                //CREDIT CARD NO FEE
                if (opcion === '20') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                //CREDIT CARD WITH FEE
                if (opcion === '21') {


                    var fees = parseFloat($("#temp").val());

                    //alert(fees);

                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));



                    $("#balance_due").val(((apagar_2 + fees) - (paid_driver) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));

                }

                //CASH
                if (opcion === '22') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val(((apagar_2 + fees) - (paid_driver) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                //CHECK
                if (opcion === '23') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

            } else {

                $("#saldoporpagar").val((((apagar_2) - pay_amount)).toFixed(2));

                //$("#balance_due").val(((apagar - (apagar_2 - pay_amount))).toFixed(2));
                ////$("#balance_due").val(((apagar_2 - pay_amount) - pago_driver).toFixed(2));
                //$("#balance_due").val(((apagar_2 - pay_amount)- paid_driver).toFixed(2));
                ////$("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                if (opcion === '0') {

                   // $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '1') {

                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //COLLECT ON BOARD

                if (opcion === '24') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                if (opcion === '25') {


                    var fees = parseFloat($("#temp").val());
                    //alert(fees);

                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));


                }

                if (opcion === '26') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                if (opcion === '27') {

                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val(((apagar_2 + fees) - (paid_driver) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }


                //PRED-PAID

                //CREDIT CARD NO FEE
                if (opcion === '20') {


                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val(((apagar_2 + fees) - (paid_driver) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                //CREDIT CARD WITH FEE
                if (opcion === '21') {


                    var fees = parseFloat($("#temp").val());

                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                //CASH
                if (opcion === '22') {
                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }

                //CHECK
                if (opcion === '23') {
                    var fees = parseFloat($("#temp").val());


                    $("#saldoporpagar").val((apagar_2 + fees).toFixed(2));
                    $("#totalPagar").val((apagar + fees).toFixed(2));
                    $("#totaltotal").text((apagar + fees).toFixed(2));


                    $("#balance_due").val((((apagar_2 + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fees) - (paid_driver)) - (pay_amount)).toFixed(2));
                }
            }



        } else {

            $("#opcion_saldo2").attr('disabled', false);
            $("#opcion_saldo1").attr('disabled', false);


            if (tipo_pago == 3) {

                var otheramount_2 = parseFloat($("#otheramount").val());
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());

                if (pay_amount == 0 && paid_driver == 0 && otheramount_2 == 0) {

                var result = parseFloat(apagar) + parseFloat(temp_driver) +  parseFloat(temp_prepaid);
                var totalbalance = ((result) - (paid_driver)) - (pay_amount);

                if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {

                        var temp = parseFloat($("#temp").val());
                        var temp_driver = parseFloat($("#temp_driver").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var pay_amount = parseFloat($("#pay_amount").val());
                        var op_pag_conduct = parseFloat($("#selectcond").val());
                        var saldoporpagar = parseFloat(apagar) +  parseFloat(temp_driver)+ parseFloat(temp_prepaid);
                        var result = parseFloat(apagar) + parseFloat(temp);
                        var bd = parseFloat(result) - parseFloat(paid_driver);



                        $("#saldoporpagar").val((saldoporpagar).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                        if(op_pag_conduct == 3){

                            //setTimeout(function () {

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);

										  console.log("totalbalance : "+tot_balance);

                                          $jq("#balance_due").val((tot_balance).toFixed(2));
                                          $jq("#bal_duep").val((tot_balance).toFixed(2));

                            //}, 0.01);

                        }

                    }


                }

                if (pay_amount == 0 && paid_driver > 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var saldoporpagar = parseFloat(apagar) +  parseFloat(temp_driver);
                    var result = parseFloat(apagar) + parseFloat(temp_driver);
                    var bd = parseFloat(saldoporpagar) - parseFloat(paid_driver);
                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((saldoporpagar).toFixed(2));
                    $("#balance_due").val((bd).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
//                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                            setTimeout(function () {

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                          $("#balance_due").val((tot_balance).toFixed(2));
                                          $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }


                }



                if (pay_amount > 0 && paid_driver == 0 && otheramount_2 == 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var totalbalance = ((apagar + temp_prepaid) - (paid_driver)) - (pay_amount);
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid);
                    var saldoporpagar = parseFloat(apagar) + parseFloat(temp_prepaid);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {

                        var pay_amount = parseFloat($("#pay_amount").val());
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var temp = parseFloat($("#temp").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                        var op_pag_conduct = parseFloat($("#selectcond").val());
                        var result = parseFloat(apagar) + parseFloat(temp_prepaid);
                        //var total = parseFloat(apagar) + parseFloat(temp);

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                        if(op_pag_conduct == "3"){

                            setTimeout(function () {

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                          $("#balance_due").val((tot_balance).toFixed(2));
                                          $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                        }

                    }

                }


                if(pay_amount > 0 && paid_driver > 0 && otheramount_2 == 0){

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());

                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
//                    var tot_amount = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
//                    $("#tot_amount_paid").val((tot_amount).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                          $("#balance_due").val((tot_balance).toFixed(2));
                                          $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }



                }




                var otheramount_2 = parseFloat($("#otheramount").val());

                if(otheramount_2 > 0 && paid_driver == 0 && pay_amount == 0){


                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var apagar_2 = parseFloat(otheramount_2);

                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var balance = parseFloat(result) - parseFloat(paid_driver);
                    var resultado = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);


                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((balance).toFixed(2));
                        $("#totalPagar").val((resultado).toFixed(2));
                        $("#totaltotal").text((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                        setTimeout(function () {

                                      var balanceo = parseFloat($("#balance_due").val());
                                      var porcbal = balanceo*0.04;
                                      var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);


                    }else{
                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((balance).toFixed(2));
                        $("#totalPagar").val((resultado).toFixed(2));
                        $("#totaltotal").text((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }



                }

                if (otheramount_2 > 0 && paid_driver == 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) +  parseFloat(temp_driver);
                    var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
//                    var result1 = parseFloat(apagar1) + parseFloat(temp_prepaid);
                    var resultado = parseFloat(apagar1) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((resultado).toFixed(2));
                        $("#totaltotal").text((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                       setTimeout(function () {

                                  var balanceo = parseFloat($("#balance_due").val());
                                  var porcbal = balanceo*0.04;
                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);



                   }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((resultado).toFixed(2));
                        $("#totaltotal").text((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }



                }

                var otheramount_2 = parseFloat($("#otheramount").val());

                if(otheramount_2 > 0 && paid_driver > 0 && pay_amount == 0){

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    //var result1 = parseFloat(apagar1) + parseFloat(temp_prepaid);
                    var resultado = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;
                    var bd = parseFloat(result) - parseFloat(paid_driver);

                    if(op_pag_conduct == "3"){

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((resultado).toFixed(2));
                        $("#totaltotal").text((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((resultado).toFixed(2));
                        $("#totaltotal").text((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }


                }



                if (otheramount_2 > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount_2);
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
//                    var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
//                    //var result1 = parseFloat(apagar1) + parseFloat(temp);
//                    var result1 = parseFloat(apagar1) + parseFloat(tempppwf) + parseFloat(temp_prepaid);
                    var resultado = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(temp_driver);

                    var bd = parseFloat(result) - parseFloat(paid_driver);
//                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);

                    var totalbalance = parseFloat(result) - parseFloat(paid_driver);

                    var agbd = (resultado - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);





                        if (totalbalance < 0) {

                            alert('Pago excedido');

//                          $("#saldoporpagar").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val(((result) - (paid_driver)).toFixed(2));
                            $("#totalPagar").val((resultado).toFixed(2));
                            $("#totaltotal").text((resultado).toFixed(2));
//                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
                            $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                        }

                        alert(tot_balance);
                        if (totalbalance >= 0){
                            if(op_pag_conduct == "3")  {


                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((resultado).toFixed(2));
                                $("#totaltotal").text((resultado).toFixed(2));
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                                $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                                setTimeout(function () {

                                  var balanceo = parseFloat($("#balance_due").val());
                                  var porcbal = balanceo*0.04;
                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                                }, 0.01);





                            }else{

                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((resultado).toFixed(2));
                                $("#totaltotal").text((resultado).toFixed(2));
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                                $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }
                        }



                }


                document.getElementById('op_pago_id1').value = 0;

            }

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            if (tipo_pago == 8){


                var otheramount_2 = $("#otheramount").val();
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());

                if (pay_amount == 0 && paid_driver == 0 && otheramount_2 == 0) {


                    var temp = parseFloat($("#temp").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp);



                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }



                }


                if (pay_amount == 0 && paid_driver > 0 && otheramount_2 == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());

                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
//                  $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));


                    if(op_pag_conduct == "3"){


                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }


                }



                if (pay_amount > 0 && paid_driver == 0 && otheramount_2 == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid);
                    var totalbalance = ((result) - (paid_driver)) - (pay_amount);
                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
//                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    } else {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
//                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                        }


                    }


                }


                 if (pay_amount > 0 && paid_driver > 0 && otheramount_2 == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
//                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }

                }


                var otheramount_2 = parseFloat($("#otheramount").val());

                if (otheramount_2 > 0 && paid_driver == 0 && pay_amount == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                       setTimeout(function () {

                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = balance*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                $("#balance_due").val((tot_balance).toFixed(2));
                                $("#bal_duep").val((tot_balance).toFixed(2));

                       }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }




                }

                if (otheramount_2 > 0 && paid_driver == 0 && pay_amount > 0) {


                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                      $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));


                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));



                    }




                }


                 if (otheramount_2 > 0 && paid_driver > 0 && pay_amount == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    }



                }

                 if (otheramount_2 > 0 && paid_driver > 0 && pay_amount > 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if (bd < 0) {

                            alert('Pago excedido');

//                          $("#saldoporpagar").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalPagar").val((res_total).toFixed(2));
                            $("#totaltotal").text((res_total).toFixed(2));
                            //$("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {

                            if(op_pag_conduct == "3")  {


                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));

                                setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                                }, 0.01);




                            }else{
//
                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
                                //$("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                        }


                }

                document.getElementById('op_pago_id1').value = 0;

            }


              //CASH
            //var otheramount_2 = $("#otheramount").val();

            if (tipo_pago == 4) {

                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());
                var otheramount_2 = parseFloat($("#otheramount").val());

                if (pay_amount == 0 && paid_driver == 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == 3){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }




                }


                if (pay_amount == 0 && paid_driver > 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }


                }

                if (pay_amount > 0 && paid_driver == 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var totalbalance = ((result) - (paid_driver)) - (pay_amount);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                        if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                        }


                    }



                }

                if (pay_amount > 0 && paid_driver > 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    var op_pag_conduct = parseFloat($("#selectcond").val());

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }


                }



                var otheramount_2 = parseFloat($("#otheramount").val());


                if (otheramount_2 > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                       setTimeout(function () {

                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = balance*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                $("#balance_due").val((tot_balance).toFixed(2));
                                $("#bal_duep").val((tot_balance).toFixed(2));

                       }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }



                }

                if (otheramount_2 > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver) ;
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));



                    }



                }


                if (otheramount_2 > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                      $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                      $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    }

                }



                if (otheramount_2 > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if (bd < 0) {

                            alert('Pago excedido');

//                          $("#saldoporpagar").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalPagar").val((res_total).toFixed(2));
                            $("#totaltotal").text((res_total).toFixed(2));
//                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                          $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {

                            if(op_pag_conduct == "3")  {


                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                              $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));

                                setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                                }, 0.01);




                            }else{
//
                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
                                //$("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                              $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                        }

                }


           document.getElementById('op_pago_id1').value = 0;

         }

         var otheramount_2 = $("#otheramount").val();


         //CHECK
            if (tipo_pago == 9) {


                if (pay_amount == 0 && paid_driver == 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
//                  $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }

                }

                if (pay_amount == 0 && paid_driver > 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }
                }


                if (pay_amount > 0 && paid_driver == 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;
                    var balance = apagar + temp_prepaid + temp_driver;
                    var totalbalance = ((balance) - (paid_driver)) - (pay_amount);

                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if (totalbalance < 0) {

                        var tembalance = 0;

                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
//                      $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    } else {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalPagar").val((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
//                      $("#agency_balance_due").val((((apagar + temp) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        if(op_pag_conduct == "3"){

                            setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                        }

                    }


                }

                if (pay_amount > 0 && paid_driver > 0 && otheramount_2 == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());

                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var agbd = (result - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
//                  $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }

                }


                var otheramount_2 = parseFloat($("#otheramount").val());


                if (otheramount_2 > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                       setTimeout(function () {

                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = balance*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                $("#balance_due").val((tot_balance).toFixed(2));
                                $("#bal_duep").val((tot_balance).toFixed(2));

                       }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }


                }

                 if (otheramount_2 > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));


                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);

                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    }

                }

                if (otheramount_2 > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").val((res_total).toFixed(2));
                        $("#totaltotal").text((res_total).toFixed(2));
//                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    }


                }


                if (otheramount_2 > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount_2);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var agbd = (res_total - paid_driver).toFixed(2);
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if (bd < 0) {

                            alert('Pago excedido');

//                          $("#saldoporpagar").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalPagar").val((res_total).toFixed(2));
                            $("#totaltotal").text((res_total).toFixed(2));
//                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));


                        }
                        if(bd >= 0) {

                            if(op_pag_conduct == "3")  {

                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));

                                setTimeout(function () {

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));

                                }, 0.01);

                            }else{
//
                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                                }

                        }


                }

                document.getElementById('op_pago_id1').value = 0;

            }


      }


        if ($("#fin_calculo").val() === "false") {
            if (tipo_pago === 1 || tipo_pago === 2) {
                $('#enviarF').css('display', 'block');
                /* bloqueado para poder guardar sin obligacion de ir a plataforma de pago
                 * $('#btn-save1').css('display', 'none');
                 $('#btn-save2').css('display', 'none');*/

            } else {
                $('#enviarF').css('display', 'none');
                $('#btn-save1').css('display', 'block');
                $('#btn-save2').css('display', 'block');
            }
        }

    }

    $('#opcion_saldo1, #opcion_saldo2').change(function () {
        if ($(this).get(0).id === 'opcion_saldo1') {
            $('#opcion_pago_saldo').val('1');
        } else if ($(this).get(0).id === 'opcion_saldo2') {
            $('#opcion_pago_saldo').val('2');
        }
        CalcularTotalTotal();
    });

    $('#opcion_pago_passager, #opcion_pago_agency, #opcion_pago_predpaid_cash,#opcion_pago_complementary,#opcion_pago_CrediFee, #opcion_pago_Cash,#opcion_pago_Voucher').change(function (e) {
        CalcularTotalTotal();
    });



    function estadoPago() {
        $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/reserva/pago');
    }

    $("#cardholder").click(function (e) {
        if ($("#cardholder").is(':checked')) {
            var idPagador = $("#idPagador").val();
            var idCliente = $("#idCliente").val();
            $("#idPagador_aux").val(idPagador);
            $("#idPagador").val(idCliente);
        } else {
            var idPagador = $("#idPagador_aux").val();
            $("#idPagador").val(idPagador);
        }
    });

    function mosrtarTrips(left, top) {
        $("#dialog_states__trips").dialog({
            autoOpen: false,
            width: 300,
            height: 300,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "blind",
                duration: 1000
            },
            position: [left - 260, top + 50]
        });
        $("#states__trips_conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="100px" height="100px" id="gif"/>');
        $("#states__trips_conte").load('<?php echo $data['rootUrl']; ?>admin/reservas/estado_trips');
        $("#dialog_states__trips").dialog("open");
    }

    $("#bnt-trips").click(function () {
        var posicion = $(this).position();
        mosrtarTrips(posicion.left, posicion.top);
    });

    function estadoTrip() {
        $("#mensajeTrip").load('<?php echo $data['rootUrl']; ?>admin/reservas/consultatrip');
    }

    function preguntaTrip() {
        $("#dialog-trip-pregunta").dialog({
            resizable: false,
            height: 250,
            modal: true,
            buttons: {
                "YES": function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/2");
                    $(this).dialog("close");
                },
                'NOT': function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
                    $(this).dialog("close");
                    window.location="<?php echo $data['rootUrl']; ?>admin/reservas/new/add";
                }
            }
        });
    }
    $("#estado").change(function () {
        var estado = $(this).val();
        $("#stat").html(estado);
    });


</script>



<script type="text/javascript">

    function btnpay() {

        var btnpago = 1;

        document.getElementById('textpay').value = btnpago;

    }

</script>


<script type="text/javascript">

    function credibalance() {

        document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

    }

</script>

<script type="text/javascript">

    var rup

    function captura() {

//      document.getElementsByName("op_pago_conductor").value = "8";

      var result = document.getElementsByName("op_pago_conductor")[0].value;


      rup = document.getElementById("result").innerHTML = " \ " + result;

      $("#selectcond").val(result);


    }

</script>


<script type="text/javascript">

    function change_ext_from1()
    {

        var ext_from1 = document.getElementById('ext_from1').value;
        var trip_no = $("#trip_no").val();
        var from = $("#from").val();
        var to = $("#to").val();


        setTimeout(function () {

        //*************  100  ***********************

        //Servicing ext_from1  100

            if(ext_from1 == '0' && trip_no == '100' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('7:00 am'); //Orlando - Super Tours Terminal
            }

            if(ext_from1 == '11' && trip_no == '100' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('6:30 am'); //Orlando - International Drive Area
            }

        //Servicing ext_from1  100

            if(ext_from1 == '12' && trip_no == '100' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('6:30 am'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_from1  100

            if(ext_from1 == '13' && trip_no == '100' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('6:00 am'); //Walt Disney World Resorts
            }

        //*************  200  ***********************

        //Servicing ext_from1  200

            if(ext_from1 == '0' && trip_no == '200' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('11:45 am'); //Orlando - Super Tours Terminal
            }

            if(ext_from1 == '11' && trip_no == '200' && from == '1' && (to == '1' || to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('11:20 am'); //Orlando - International Drive Area
            }

        //Servicing ext_from1  200

            if(ext_from1 == '12' && trip_no == '200' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('11:20 am'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_from1  200

            if(ext_from1 == '13' && trip_no == '200' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '11' || to == '12' || to == '10' || to == '9' || to == '8')){

                $("#departure1").val('11:00 am'); //Walt Disney World Resorts
            }


        //*************  300  ***********************

        //Servicing ext_from1  300

            if(ext_from1 == '0' && trip_no == '300' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '7' || to == '8' || to == '9' || to == '10' || to == '12' || to == '14')){

                $("#departure1").val('7:00 pm'); //Orlando - Super Tours Terminal
            }

            if(ext_from1 == '11' && trip_no == '300' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '7' || to == '8' || to == '9' || to == '10' || to == '12' || to == '14')){

                $("#departure1").val('6:30 pm'); //Orlando - International Drive Area
            }

        //Servicing ext_from1  300

            if(ext_from1 == '12' && trip_no == '300' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '7' || to == '8' || to == '9' || to == '10' || to == '12' || to == '14')){

                $("#departure1").val('6:30 pm'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_from1  300

            if(ext_from1 == '13' && trip_no == '300' && from == '1' && (to == '3' || to == '4' || to == '5' || to == '6' || to == '7' || to == '8' || to == '9' || to == '10' || to == '12' || to == '14')){

                $("#departure1").val('5:45 pm'); //Walt Disney World Resorts
            }

         }, 500);

    }

</script>

<script type="text/javascript">

    function change_ext_from2()
    {

        var ext_from2 = document.getElementById('ext_from2').value;
        var trip_no2 = $("#trip_no2").val();
        var from2 = $("#from2").val();
        var to2 = $("#to2").val();


        setTimeout(function () {

        //*************  100  ***********************

        //Servicing ext_from2  100

            if(ext_from2 == '0' && trip_no2 == '100' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('7:00 am'); //Orlando - Super tours Terminal
            }

            if(ext_from2 == '11' && trip_no2 == '100' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('6:30 am'); //Orlando - International Drive Area
            }

        //Servicing ext_from2  100

            if(ext_from2 == '12' && trip_no2 == '100' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('6:30 am'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_from2  100

            if(ext_from2 == '13' && trip_no2 == '100' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('6:00 am'); //Walt Disney World Resorts
            }

        //*************  200  ***********************

        //Servicing ext_from2  200

            if(ext_from2 == '0' && trip_no2 == '200' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('11:45 am'); //Orlando - Super tours Terminal
            }

            if(ext_from2 == '11' && trip_no2 == '200' && from2 == '1' && (to2 == '1' || to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('11:20 am'); //Orlando - International Drive Area
            }

        //Servicing ext_from2  200

            if(ext_from2 == '12' && trip_no2 == '200' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('11:20 am'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_from2  200

            if(ext_from2 == '13' && trip_no2 == '200' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '11' || to2 == '12' || to2 == '10' || to2 == '9' || to2 == '8')){

                $("#departure2").val('11:00 am'); //Walt Disney World Resorts
            }


        //*************  300  ***********************

        //Servicing ext_from2  300

            if(ext_from2 == '0' && trip_no2 == '300' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '7' || to2 == '8' || to2 == '9' || to2 == '10' || to2 == '12' || to2 == '14')){

                $("#departure2").val('7:00 pm'); //Orlando - Super tours Terminal
            }

            if(ext_from2 == '11' && trip_no2 == '300' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '7' || to2 == '8' || to2 == '9' || to2 == '10' || to2 == '12' || to2 == '14')){

                $("#departure2").val('6:30 pm'); //Orlando - International Drive Area
            }

        //Servicing ext_from2  300

            if(ext_from2 == '12' && trip_no2 == '300' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '7' || to2 == '8' || to2 == '9' || to2 == '10' || to2 == '12' || to2 == '14')){

                $("#departure2").val('6:30 pm'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_from2  300

            if(ext_from2 == '13' && trip_no2 == '300' && from2 == '1' && (to2 == '3' || to2 == '4' || to2 == '5' || to2 == '6' || to2 == '7' || to2 == '8' || to2 == '9' || to2 == '10' || to2 == '12' || to2 == '14')){

                $("#departure2").val('5:45 pm'); //Walt Disney World Resorts
            }

         }, 500);

    }

</script>

<script type="text/javascript">

    function change_ext_to1()
    {

        var ext_to1 = document.getElementById('ext_to1').value;
        var trip_no = $("#trip_no").val();
        var from = $("#from").val();
        var to = $("#to").val();


        setTimeout(function () {

        //*************  101  ***********************

        //Servicing ext_to1  101

            if(ext_to1 == '0' && trip_no == '101' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('7:30 pm'); //Orlando - Super Tours Terminal
            }

            if(ext_to1 == '11' && trip_no == '101' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('7:45 pm'); //Orlando - International Drive Area
            }

        //Servicing ext_to1  101

            if(ext_to1 == '12' && trip_no == '101' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('7:45 pm'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_to1  101

            if(ext_to1 == '13' && trip_no == '101' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('8:00 pm'); //Walt Disney World Resorts
            }

        //*************  201  ***********************

        //Servicing ext_to1  201

            if(ext_to1 == '0' && trip_no == '201' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('11:00 pm'); //Orlando - Super Tours Terminal
            }

            if(ext_to1 == '11' && trip_no == '201' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('11:15 pm'); //Orlando - International Drive Area
            }

        //Servicing ext_to1  201

            if(ext_to1 == '12' && trip_no == '201' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('11:15 pm'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_to1  201

            if(ext_to1 == '13' && trip_no == '201' && (from == '8' || from == '9' || from == '10' || from == '12' || from == '11' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('11:30 pm'); //Walt Disney World Resorts
            }


        //*************  301  ***********************

        //Servicing ext_to1  301

            if(ext_to1 == '0' && trip_no == '301' && (from == '14' || from == '12' || from == '10' || from == '9' || from == '8' || from == '7' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('10:00 am'); //Orlando - Super Tours Terminal
            }

            if(ext_to1 == '11' && trip_no == '301' && (from == '14' || from == '12' || from == '10' || from == '9' || from == '8' || from == '7' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('10:20 am'); //Orlando - International Drive Area
            }

        //Servicing ext_to1  301

            if(ext_to1 == '12' && trip_no == '301' && (from == '14' || from == '12' || from == '10' || from == '9' || from == '8' || from == '7' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('10:20 am'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_to1  301

            if(ext_to1 == '13' && trip_no == '301' && (from == '14' || from == '12' || from == '10' || from == '9' || from == '8' || from == '7' || from == '6' || from == '5' || from == '4' || from == '3') && to == '1'){

                $("#arrival1").val('10:30 am'); //Walt Disney World Resorts
            }

         }, 500);

    }

</script>

<script type="text/javascript">

    function change_ext_to2()
    {

        var ext_to2 = document.getElementById('ext_to2').value;
        var trip_no2 = $("#trip_no2").val();
        var from2 = $("#from2").val();
        var to2 = $("#to2").val();


        setTimeout(function () {

        //*************  101  ***********************

        //Servicing ext_to2  101

            if(ext_to2 == '0' && trip_no2 == '101' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('7:30 pm'); //Orlando - Super tours Terminal
            }

            if(ext_to2 == '11' && trip_no2 == '101' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('7:45 pm'); //Orlando - International Drive Area
            }

        //Servicing ext_to2  101

            if(ext_to2 == '12' && trip_no2 == '101' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('7:45 pm'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_to2  101

            if(ext_to2 == '13' && trip_no2 == '101' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('8:00 pm'); //Walt Disney World Resorts
            }

        //*************  201  ***********************

        //Servicing ext_to2  201

            if(ext_to2 == '0' && trip_no2 == '201' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('11:00 pm'); //Orlando - Super tours Terminal
            }

            if(ext_to2 == '11' && trip_no2 == '201' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('11:15 pm'); //Orlando - International Drive Area
            }

        //Servicing ext_to2  201

            if(ext_to2 == '12' && trip_no2 == '201' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('11:15 pm'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_to2  201

            if(ext_to2 == '13' && trip_no2 == '201' && (from2 == '8' || from2 == '9' || from2 == '10' || from2 == '12' || from2 == '11' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('11:30 pm'); //Walt Disney World Resorts
            }


        //*************  301  ***********************

        //Servicing ext_to2  301

            if(ext_to2 == '0' && trip_no2 == '301' && (from2 == '14' || from2 == '12' || from2 == '10' || from2 == '9' || from2 == '8' || from2 == '7' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('10:00 am'); //Orlando - Super tours Terminal
            }

            if(ext_to2 == '11' && trip_no2 == '301' && (from2 == '14' || from2 == '12' || from2 == '10' || from2 == '9' || from2 == '8' || from2 == '7' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('10:20 am'); //Orlando - International Drive Area
            }

        //Servicing ext_to2  301

            if(ext_to2 == '12' && trip_no2 == '301' && (from2 == '14' || from2 == '12' || from2 == '10' || from2 == '9' || from2 == '8' || from2 == '7' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('10:20 am'); //Universal Studios Orlando Resorts
            }

        //Servicing ext_to2  301

            if(ext_to2 == '13' && trip_no2 == '301' && (from2 == '14' || from2 == '12' || from2 == '10' || from2 == '9' || from2 == '8' || from2 == '7' || from2 == '6' || from2 == '5' || from2 == '4' || from2 == '3') && to2 == '1'){

                $("#arrival2").val('10:30 am'); //Walt Disney World Resorts
            }

         }, 500);

    }

</script>

<script type="text/javascript">

    function changepickup1()
    {
        //var idpick = $("#id_p1").val();
        var trip_no = $("#trip_no").val();
        var pickup1 = document.getElementById('pickup1').value;
        var idpick = document.getElementById('id_p1').value;
        var from = $("#from").val();
        var to = $("#to").val();


        setTimeout(function () {

        var id_pick = $("#id_p1").val();

        //Servicing North Miami Beach  301
            if(id_pick == '16' && trip_no == '301' && from == '7'){

                $("#departure1").val('5:50 am'); //Newport Beachside Hotel
            }
            if(id_pick == '7' && trip_no == '301' && from == '7'){

                $("#departure1").val('6:00 am');//Ramada Plaza Marcopolo Beach
            }
            if(id_pick == '' && trip_no == '301' && from == '7'){

                $("#departure1").val('5:40 am');
            }

        //Servicing South Beach  101

             if(id_pick == '449' && trip_no == '101' && from == '9'){

                $("#departure1").val('2:40 pm'); //Chesterfield Hotel - Express
            }

        //Servicing South Beach  101

             if(id_pick == '465' && trip_no == '101' && from == '9'){

                $("#departure1").val('2:45 pm'); //Chesterfield Hotel - Express
            }

        //Servicing South Beach  201

             if(id_pick == '449' && trip_no == '201' && from == '9'){

                $("#departure1").val('6:10 pm'); //Chesterfield Hotel - Express
            }

        //Servicing South Beach  201

             if(id_pick == '465' && trip_no == '201' && from == '9'){

                $("#departure1").val('6:15 pm'); //Chesterfield Hotel - Express
            }



        }, 1000);





    }


</script>

<script type="text/javascript">

    function changepickup2()
    {
        //var idpick = $("#id_p2").val();
        var trip_no2 = $("#trip_no2").val();
        var pickup2 = document.getElementById('pickup2').value;
        var idpick2 = document.getElementById('id_pickup2').value;
        var from2 = $("#from2").val();
        var to2 = $("#to2").val();




        setTimeout(function () {

        var id_pick2 = $("#id_pickup2").val();

        //Servicing North Miami Beach  301
            if(id_pick2 == '16' && trip_no2 == '301' && from2 == '7'){

                $("#departure2").val('5:50 am'); //Newport Beachside Hotel
            }
            if(id_pick2 == '7' && trip_no2 == '301' && from2 == '7'){

                $("#departure2").val('6:00 am');//Ramada Plaza Marcopolo Beach
            }
            if(id_pick2 == '' && trip_no2 == '301' && from2 == '7'){

                $("#departure2").val('5:40 am');
            }
        //Servicing South Beach  101

             if(id_pick2 == '449' && trip_no2 == '101' && from2 == '9'){

                $("#departure2").val('2:40 pm'); //Chesterfield Hotel - Express
            }

        //Servicing South Beach  101

             if(id_pick2 == '465' && trip_no2 == '101' && from2 == '9'){

                $("#departure2").val('2:45 pm'); //Chesterfield Hotel - Express
            }

        //Servicing South Beach  201

             if(id_pick2 == '449' && trip_no2 == '201' && from2 == '9'){

                $("#departure2").val('6:10 pm'); //Chesterfield Hotel - Express
            }

        //Servicing South Beach  201

             if(id_pick2 == '465' && trip_no2 == '201' && from2 == '9'){

                $("#departure2").val('6:15 pm'); //Chesterfield Hotel - Express
            }


        }, 1000);

    }


</script>

<script type="text/javascript">

    function resetpickup1()
    {

        var pickup1 = document.getElementById('pickup1').value;
        var trip_no = $("#trip_no").val();
        var idpick = document.getElementById('id_p1').value;
        var from = $("#from").val();
        var to = $("#to").val();

        //301 North Miami ----> Orlando

        if (pickup1 == "" && trip_no == '301' && from == '7') {

            setTimeout(function () {

                document.getElementById('id_p1').value = '';
                $("#departure1").val('05:40 am');

            }, 100);

        }

        //101 South Beach ----> Orlando

        if (pickup1 == "" && trip_no == '101' && from == '9') {

            setTimeout(function () {

                document.getElementById('id_p1').value = '';
                $("#departure1").val('2:40 pm');

            }, 100);

        }

        //201 South Beach ----> Orlando

        if (pickup1 == "" && trip_no == '201' && from == '9') {

            setTimeout(function () {

                document.getElementById('id_p1').value = '';
                $("#departure1").val('6:10 pm');

            }, 100);

        }



    }

</script>

<script type="text/javascript">

    function resetpickup2()
    {

        var pickup2 = document.getElementById('pickup2').value;
        var trip_no2 = $("#trip_no2").val();
        var idpick2 = document.getElementById('id_pickup2').value;
        var from2 = $("#from2").val();
        var to2 = $("#to2").val();

        //301 North Miami ----> Orlando

        if (pickup2 == "" && trip_no2 == '301' && from2 == '7') {

            setTimeout(function () {

                document.getElementById('id_pickup2').value = '';
                $("#departure2").val('05:40 am');

            }, 100);

        }

        //101 South Beach ----> Orlando

        if (pickup2 == "" && trip_no2 == '101' && from2 == '9') {

            setTimeout(function () {

                document.getElementById('id_pickup2').value = '';
                $("#departure2").val('2:40 pm');

            }, 100);

        }

        //201 South Beach ----> Orlando

        if (pickup2 == "" && trip_no2 == '201' && from2 == '9') {

            setTimeout(function () {

                document.getElementById('id_pickup2').value = '';
                $("#departure2").val('6:10 pm');

            }, 100);

        }



    }

</script>

<script type="text/javascript">

    function resetextra()
    {

        var extra_cargo = document.getElementById('extra').value;


        if (extra_cargo == "") {

            setTimeout(function () {

                document.getElementById('extra').value = '0.00';

                CalcularTotalTotal();

                $("#extra").focus();

            }, 2000);

        }

        if (extra_cargo == "0") {

            setTimeout(function () {

            document.getElementById('extra').value = "0.00";

            CalcularTotalTotal();

            $("#extra").focus();

            }, 2000);

        }

        if (extra_cargo > "0") {

            setTimeout(function () {

                CalcularTotalTotal();

             }, 3000);

            $("#extra").focus();

        }

    }

</script>

<script type="text/javascript">

    function desval()
    {
        var dcval = document.getElementById('descuento_valor').value;

        if (dcval == "") {

            setTimeout(function () {

                document.getElementById('descuento_valor').value = "0.00";
                CalcularTotalTotal();
                $("#descuento_valor").focus();

            }, 2000);
        }


        if (dcval == "0") {

            setTimeout(function () {

            document.getElementById('descuento_valor').value = "0.00";
            CalcularTotalTotal();
            $("#descuento_valor").focus();

            }, 2000);

        }

        if (dcval > "0") {

          setTimeout(function () {

            CalcularTotalTotal();

          }, 3000);

          $("#descuento_valor").focus();

        }


    }
</script>

<script type="text/javascript">

    function desporc()
    {
        var dcporc = document.getElementById('descuento').value;

        if (dcporc == "") {

            document.getElementById('descuento').value = "0";
            CalcularTotalTotal();
            $("#descuento").focus();
        }

        if (dcporc == "0") {

            document.getElementById('descuento').value = "0";
            CalcularTotalTotal();
            $("#descuento").focus();
        }

        if (dcporc > "0") {

            setTimeout(function () {

                CalcularTotalTotal();

            }, 0.01);

            $("#descuento").focus();

        }


    }
</script>




<script type="text/javascript">

    function reset_point()
    {


        var rp = document.getElementById('leader').value;

        if (rp == "") {

            document.getElementById('points_balance').value = "0";
            document.getElementById('points_required').value = "0";
            document.getElementById('firstname1').value = "";
            document.getElementById('lastname1').value = "";
            document.getElementById('email1').value = "";
            document.getElementById('phone1').value = "";

        }



    }
</script>


<script type="text/javascript">

    function cancelar(){/*PAGOS PREPAGADOS*/


       var pago_driver = parseFloat($("#pago_driver").val());
//       var pago_driver = document.getElementById("pago_driver").value;

       var temp_prepaid = parseFloat($("#temp_prepaid").val());
       var prepaid = parseFloat($("#prepaid").val());

       if (pago_driver % 1 == 0) { /*valor entero*/

            var result2 = parseFloat(prepaid) - parseFloat(pago_driver);

            //$("#temp_driver").val((result).toFixed(2));
            $("#prepaid").val((result2).toFixed(2));


       } else { /*valor decimal*/

           var temp_prepaid = parseFloat($("#temp_prepaid").val());
           var prepaid = parseFloat($("#prepaid").val());
           var parte_entera = (parseFloat(pago_driver))/1.04;
           var cargo = (parseFloat(pago_driver) - parseFloat(parte_entera)).toFixed(2);
           var result = parseFloat(temp_prepaid) - parseFloat(cargo);
           var result2 = prepaid - pago_driver;

           $("#temp_prepaid").val((result).toFixed(2));
           $("#prepaid").val((result2).toFixed(2));

        }

       //******////

//       var parte_entera = parseFloat(pago_driver)/1.04;
//       var cargo = parseFloat(pago_driver) - parseFloat(parte_entera);
//       var result = temp_prepaid - cargo;
//       var result2 = prepaid - pago_driver;
//
//       $("#temp_prepaid").val((result).toFixed(2));
//       $("#prepaid").val((result2).toFixed(2));
//
//       alert(result2);
//       exit;

       var no_prep =  document.getElementById("no_prep").value;

                if(no_prep == 1){
                    document.getElementById("no_prep").value = 0;
                    document.getElementById('pago_pre1').value = '0';
                    document.getElementById('pagopre1').value = '';
                    document.getElementById('tipo_pagopre1').value = '';
                    document.getElementById('pagadopre1').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';


                }else if(no_prep == 2){
                    document.getElementById("no_prep").value = 1;
                    document.getElementById('pago_pre2').value = '0';
                    document.getElementById('pagopre2').value = '';
                    document.getElementById('tipo_pagopre2').value = '';
                    document.getElementById('pagadopre2').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 3){
                    document.getElementById("no_prep").value = 2;
                    document.getElementById('pago_pre3').value = '0';
                    document.getElementById('pagopre3').value = '';
                    document.getElementById('tipo_pagopre3').value = '';
                    document.getElementById('pagadopre3').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 4){
                    document.getElementById("no_prep").value = 3;
                    document.getElementById('pago_pre4').value = '0';
                    document.getElementById('pagopre4').value = '';
                    document.getElementById('tipo_pagopre4').value = '';
                    document.getElementById('pagadopre4').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 5){
                    document.getElementById("no_prep").value = 4;
                    document.getElementById('pago_pre5').value = '0';
                    document.getElementById('pagopre5').value = '';
                    document.getElementById('tipo_pagopre5').value = '';
                    document.getElementById('pagadopre5').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 6){
                    document.getElementById("no_prep").value = 5;
                    document.getElementById('pago_pre6').value = '0';
                    document.getElementById('pagopre6').value = '';
                    document.getElementById('tipo_pagopre6').value = '';
                    document.getElementById('pagadopre6').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 7){
                    document.getElementById("no_prep").value = 6;
                    document.getElementById('pago_pre7').value = '0';
                    document.getElementById('pagopre7').value = '';
                    document.getElementById('tipo_pagopre7').value = '';
                    document.getElementById('pagadopre7').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 8){
                    document.getElementById("no_prep").value = 7;
                    document.getElementById('pago_pre8').value = '0';
                    document.getElementById('pagopre8').value = '';
                    document.getElementById('tipo_pagopre8').value = '';
                    document.getElementById('pagadopre8').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 9){
                    document.getElementById("no_prep").value = 8;
                    document.getElementById('pago_pre9').value = '0';
                    document.getElementById('pagopre9').value = '';
                    document.getElementById('tipo_pagopre9').value = '';
                    document.getElementById('pagadopre9').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }else if(no_prep == 10){
                    document.getElementById("no_prep").value = 9;
                    document.getElementById('pago_pre10').value = '0';
                    document.getElementById('pagopre10').value = '';
                    document.getElementById('tipo_pagopre10').value = '';
                    document.getElementById('pagadopre10').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';

                }

       //document.getElementById('prepaid').value = "0.00";
       //document.getElementById('temp_prepaid').value = "0.00";

       document.getElementById('temp_prepaid').value = '0.00';
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00";
       document.getElementById('pago_tarjeta').value = "0.00";
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none";
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";
       $("#pago_driver").focus();


        mostrarVentana2();



    }

</script>
<script type="text/javascript">
    function reset_roundtrip()
    {

        document.getElementById('price2').value = 0;

        document.getElementById('subtoadult2').value = 0;

        document.getElementById('subtochild2').value = 0;

        document.getElementById('subtoadult4').value = 0;

        document.getElementById('subtochild4').value = 0;

        document.getElementById('tarifaround').value = 0;

//        document.getElementById('roundtrip').disabled = true;


    }
</script>
<script type="text/javascript">

    function cancelar_collect_on_board(){


       var pago_driver = parseFloat($("#pago_driver").val());
       var temp_driver = parseFloat($("#temp_driver").val());
       var collect = parseFloat($("#collect").val());

       if (pago_driver % 1 == 0) { /*valor entero*/

            var result2 = parseFloat(collect) - parseFloat(pago_driver);
            //$("#temp_driver").val((result).toFixed(2));
            $("#collect").val((result2).toFixed(2));


       } else { /*valor decimal*/

           var parte_entera = parseFloat(pago_driver)/1.04;

           var cargo = (parseFloat(pago_driver) - parseFloat(parte_entera)).toFixed(2);
           var result = parseFloat(temp_driver) - parseFloat(cargo);
           var result2 = collect - pago_driver;

           $("#temp_driver").val((result).toFixed(2));
           $("#collect").val((result2).toFixed(2));

        }


       var no_pago =  document.getElementById("no_pago").value;

                if(no_pago == 1){
                    document.getElementById("no_pago").value = 0;
                    document.getElementById('pago_1').value = '0';
                    document.getElementById('pago1').value = '';
                    document.getElementById('tipo_pago1').value = '';
                    document.getElementById('pagado1').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 2){
                    document.getElementById("no_pago").value = 1;
                    document.getElementById('pago_2').value = '0';
                    document.getElementById('pago2').value = '';
                    document.getElementById('tipo_pago2').value = '';
                    document.getElementById('pagado2').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 3){
                    document.getElementById("no_pago").value = 2;
                    document.getElementById('pago_3').value = '0';
                    document.getElementById('pago3').value = '';
                    document.getElementById('tipo_pago3').value = '';
                    document.getElementById('pagado3').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 4){
                    document.getElementById("no_pago").value = 3;
                    document.getElementById('pago_4').value = '0';
                    document.getElementById('pago4').value = '';
                    document.getElementById('tipo_pago4').value = '';
                    document.getElementById('pagado4').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 5){
                    document.getElementById("no_pago").value = 4;
                    document.getElementById('pago_5').value = '0';
                    document.getElementById('pago5').value = '';
                    document.getElementById('tipo_pago5').value = '';
                    document.getElementById('pagado5').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 6){
                    document.getElementById("no_pago").value = 5;
                    document.getElementById('pago_6').value = '0';
                    document.getElementById('pago6').value = '';
                    document.getElementById('tipo_pago6').value = '';
                    document.getElementById('pagado6').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 7){
                    document.getElementById("no_pago").value = 6;
                    document.getElementById('pago_7').value = '0';
                    document.getElementById('pago7').value = '';
                    document.getElementById('tipo_pago7').value = '';
                    document.getElementById('pagado7').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 8){
                    document.getElementById("no_pago").value = 7;
                    document.getElementById('pago_8').value = '0';
                    document.getElementById('pago8').value = '';
                    document.getElementById('tipo_pago8').value = '';
                    document.getElementById('pagado8').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 9){
                    document.getElementById("no_pago").value = 8;
                    document.getElementById('pago_9').value = '0';
                    document.getElementById('pago9').value = '';
                    document.getElementById('tipo_pago9').value = '';
                    document.getElementById('pagado9').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }else if(no_pago == 10){
                    document.getElementById("no_pago").value = 9;
                    document.getElementById('pago_10').value = '0';
                    document.getElementById('pago10').value = '';
                    document.getElementById('tipo_pago10').value = '';
                    document.getElementById('pagado10').value = '0.00';
                    document.getElementById('pago_driver2').value = '0.00';
                    document.getElementById('temp').value = '0.00';

                }

       //document.getElementById('prepaid').value = "0.00";
       //document.getElementById('temp_prepaid').value = "0.00";
       document.getElementById('pago_driver2').value = '0.00';
       document.getElementById('temp').value = '0.00';
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00";
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none";
       document.getElementById("btncancol").style.display = "none";
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";
       $("#pago_driver").focus();

        mostrarVentana2();



    }

</script>

<script type="text/javascript">

    function valida_clase(){

        $('#paid_driver').click();

    }

    </script>


    <script type="text/javascript">

    function valida_clase2(){

        $('#pay_amount').click();

    }

    </script>

    <script type="text/javascript">

    function valida_pago(obj,abc){

    //valida la clase activa en el pago al conductor
    //alert($(obj).attr('class'));

    //alert($(obj).attr('class'));

        ////if($(obj).attr('class')=="flashit"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        ////}


    }

    </script>

    <script type="text/javascript">

    //valida la clase activa en el pago prepagado
    function valida_pago2(obj,def){

    //alert($(obj).attr('class'));

        ////if($(obj).attr('class')=="flashit2"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        ////}


    }

    </script>




<script type="text/javascript">

    function comprobarScreen()
    {

 //        window.moveTo(0, 0);
	// window.resizeTo(screen.width, screen.height);
 //        window.fullScreen;

 //        if (window.screen.availWidth <= 640) {
 //            window.parent.document.body.style.zoom = "62%";
 //        }

 //        if (window.screen.availWidth == 800) {
 //            window.parent.document.body.style.zoom = "70%";
 //            //document.getElementById("save2").style.marginTop = "-59px";
 //        }

 //        if (window.screen.availWidth == 960) {
 //            window.parent.document.body.style.zoom = "70%";
 //            //document.getElementById("save2").style.marginTop = "-50px";
 //        }

 //        if (window.screen.availWidth == 1024) {
 //            window.parent.document.body.style.zoom = "80%";
 //            //document.getElementById("save2").style.marginTop = "-11px";

 //        }

 //        if (window.screen.availWidth == 1152) {
 //            window.parent.document.body.style.zoom = "90%";
 //            //document.getElementById("save2").style.marginTop = "-173px";
 //            //document.getElementById("btn-save2").style.marginLeft = "-113px";
 //        }

 //        if (window.screen.availWidth == 1280) {
 //            window.parent.document.body.style.zoom = "100%";
 //            //document.getElementById("save2").style.marginTop = "-70px";

 //        }

 //        if (window.screen.availWidth == 1360) {
 //            window.parent.document.body.style.zoom = "100%";
 //            //document.getElementById("save2").style.marginTop = "-59px";

 //        }

 //        if (window.screen.availWidth == 1366) {
 //            window.parent.document.body.style.zoom = "100%";
 //            //document.getElementById("save2").style.marginTop = "-56px";

 //        }

 //        if (window.screen.availWidth == 1440) {
 //            window.parent.document.body.style.zoom = "110%";
 //            //document.getElementById("save2").style.marginTop = "-32px";

 //        }

 //        if (window.screen.availWidth == 1600) {
 //            window.parent.document.body.style.zoom = "125%";
 //            //document.getElementById("save2").style.marginTop = "-51px";

 //        }

 //        if (window.screen.availWidth == 1680) {
 //            window.parent.document.body.style.zoom = "125%";
 //            //document.getElementById("save2").style.marginTop = "-24px";

 //        }
 //        if (window.screen.availWidth > 1680) {
 //            window.parent.document.body.style.zoom = "125%";
 //            //document.getElementById("save2").style.marginTop = "-14px";

 //        }
    }

</script>


<script type="text/javascript">

    function year_actual()
    {

       var ya = (new Date).getFullYear();
       var hoy = new Date();
       var dd = hoy.getDate();
       var mm = hoy.getMonth()+1; //hoy es 0!
       var yyyy = hoy.getFullYear();

        if(dd<10) {
            dd='0'+dd
        }

        if(mm<10) {
            mm='0'+mm
        }

        //hoy = mm+'/'+dd+'/'+yyyy;
        hoy = yyyy + '-' +mm+ '-' +dd;

        //alert(ano);
       var y_actual = ya + '-01'+'-01';
        //debugger;
       document.getElementById("fecha_inicio").value = y_actual;
       document.getElementById("fecha_actual").value = hoy;


    }
</script>


<script type="text/javascript">
       function redondea(sVal, nDec){

        var n = parseFloat(sVal);
        var s = "";

//        setTimeout(function () {
            if (!isNaN(n)){
             n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec);
             s = String(n);
             s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1);
             s = s.substr(0, s.indexOf(".") + nDec + 1);
                }
                return s;
//          }, 2000);
        }

       function ponDecimales(nDec){

        setTimeout(function () {

        //document.formula.pago_driver.value = redondea(document.formula.pago_driver.value, nDec);
        document.formula.descuento_valor.value = redondea(document.formula.descuento_valor.value, nDec);
        document.formula.extra.value = redondea(document.formula.extra.value, nDec);
        document.formula.saldoporpagar.value = redondea(document.formula.saldoporpagar.value, nDec);
//        document.formula.balance_due.value = redondea(document.formula.balance_due.value, nDec);

         }, 1000);

       }
    </script>

    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloNumeros(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;

        // capturamos el contenido del input
        var valor=document.getElementById("saldoporpagar").value;

        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }

        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }

        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>

    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solopagodriver(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;

        // capturamos el contenido del input

        var valor=document.getElementById("pago_driver").value;

        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }

        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }

        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>

<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solodescuento(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;

        // capturamos el contenido del input

        var valor=document.getElementById("descuento_valor").value;

        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }

        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }

        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>

    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function descuentoporc(evt)
    {
//        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault)
                    theEvent.preventDefault();
           }
    }
    </script>

    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloextra(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;

        // capturamos el contenido del input

        var valor=document.getElementById("extra").value;

        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }

        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }

        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>

    <script type="text/javascript">

    function checkDecimals(fieldName, fieldValue) {

    decallowed = 2; // how many decimals are allowed?

    if (isNaN(fieldValue) || fieldValue == "") {
        alert("El número no es válido. Prueba de nuevo.");
        fieldName.select();
        fieldName.focus();
    }
    else {
    if (fieldValue.indexOf('.') == -1) fieldValue += ".";
    dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

    if (dectext.length > decallowed)
    {
        alert ("Por favor, digita un número con " + decallowed + " números decimales.");
        fieldName.select();
        fieldName.focus();
          }
    else {
    alert ("Número validado satisfactoriamente.");
          }
       }
    }

    </script>

<script type="text/javascript">

    function valida_voucher(){

    var idagencia = document.getElementById('idagencia').value;

       if(idagencia == "1"){
           document.getElementById('op_pago_conductor')[4].disabled = false;
           //document.getElementById('op_pago_conductor').options[5].disabled = true;

       }else{

        // document.getElementById('op_pago_conductor')[4].style.display = 'none';
           document.getElementById('op_pago_conductor')[4].disabled = true;

       }


    }

</script>

<?php

$barra = 10;

?>

<script type="text/javascript">

    function move() {
    var elem = document.getElementById("myBar");
    var width = "<?php echo $barra; ?>";
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            //width++;
            width = width ;
            elem.style.width = width + '%';
            elem.innerHTML = width * 1 + '%';
        }
    }
}

</script>

<script type="text/javascript">

    function residente() {
        document.getElementById('resident').value = document.getElementById('tipo_pass').value;
    }

</script>

<script type="text/javascript">

    function cancel_puesto(){

         $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
    }
</script>

<script type="text/javascript">
function Verificar()
{
//var tecla=window.event.keyCode;
//if (tecla==116) {
var mensaje;

var opcion = confirm('Si recargas la pagina perderas todos los datos ingresados, ¿Deseas recargar la pagina?');
     if (opcion == true) {
           $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/5");
           location.reload();
      } else {
//            event.keyCode=0;
//            event.returnValue=false;
           mensaje = "Has clickado Cancelar";
      }


    }


</script>
