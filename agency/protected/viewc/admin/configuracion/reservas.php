
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

    <script src="<?php echo $data['rootUrl']; ?>global/startjs/sweetalert2.js"></script>
    
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/js/custom.js"></script>

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

<?php //if(isset($_SESSION['loginagency']) AND $login->admon == 1) { ?>
<?php if(true) { ?>
<?php if (isset($_REQUEST['msg'])) { ?>
    <div class="error" style="margin-top: 10px;"><?php /* echo $_REQUEST['msg']; */ ?></div>
<?php } ?>


<?php
    Doo::loadModel("Reserve");
    $reserve = new Reserve();
    $reserve->id = $this->params["pindex"];
//    $prueba = $_POST["resultado"];
//    echo $prueba;
    
    
    
//    $servicio = $this->data['servicios'];    
//    //echo $servicio;
//    $prueba = $servicio;
?>

<form name="form1" method="POST" action="<?php echo $data['rootUrl']; ?>admin/reservas"  class="form" id="form1">

    <?php
    
    $prueba = $_POST["inputform"];
//    $prueba = $_POST["temporal"];

    ?>






<!-- page content -->
<div class="" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">

    <div><input type="text" id="inputform" name="inputform" style="display:none;"></div>
    <div><input name="php" type="submit"  id="php" value="Enviar valor" style="display:none;"></div>

    <div><input name="edition" type="button"  id="edition" style="display:none;" value="Edition" <?php
        $id = trim($prueba);
        //echo $id;
        $ruta = "admin/reservas/edit/";
        $url = $data['rootUrl'] . $ruta . $id;
        ?><a href="#" onclick="javascript:void(window.open('<?php echo $url; ?>', 'RESERVAS', ''))"></div>

   <!--<a href="javascript:void(window.open('<?php /*echo $url*/; ?>', 'RESERVAS', ''))"></div>-->
    <div><input name="regreso" type="submit"  id="regreso" style="display:none;" value="Regresar" onclick="regresar();" ></div>

    <div id="resultado" style="display:none;"></div>


    <div id="header_page" style="display:none">

        <div  id="toolbar">


            <input style="display:none; text-align: center; width:81px; height: 15px; margin-top: 14px; margin-right: 18px; border-radius: 8px 8px 8px 8px; background-color: #f6f6f6; border:2px solid #271B64; border-color:#271B64; color:#271B64; font-size:15px;" disabled="disabled" autocomplete="off"  placeholder="Id Reserve" type="text" size="30" maxlength="30"  id="idreser" value="<?php echo $var1; ?>"/>

            <div class="toolbar-list" >
                <ul>

                    <li class="btn-toolbar" style="height: 40px;">

                    <body  onload="">

                    </body>
                    
                    </li>

                    <li class="btn-toolbar" style="height: 40px;">


                        <input class="flashit" style="text-align: center; width:170px; height: 24px; margin-top: 11px; margin-left: -189px; border-radius: 8px 8px 8px 8px; background-color: #2D2193; border:4; border-color:#2D2193; color:#fff; font-size:14px;" autocomplete="off"  placeholder="Id Reserve" type="text" size="30" maxlength="30"  id="idreser" value="<?php if($id >0){echo 'Reserva:'.'   '.$id.'   ';}else{echo 'Selecciona una Reserva';}?>"/>

                        <div class="flashit">
                            <a class="link-button" id="flecha"> <i class=" fa fa-hand-o-right fa-3x"  style="margin-left: 11px; margin-top:-34px; color:#2D2193;"></i></a>
                        </div>

                    </li>

                    <li class="btn-toolbar" style="height: 40px;">

                        <?php
                            $id = trim($prueba);                       
                            $ruta = "admin/reservas/edit/";
                            $url1 = $data['rootUrl'] . $ruta . $id;
                        ?>

                        <a href="javascript:void(window.open('<?php echo $url1; ?>','RESERVAS',''))" id="btn-edit"  class="link-button" onclick="retorno();"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/edit2.png" style="margin-top:-2px; height:25px;" title="Modify reservation data"/>

                            <span style="margin-top:-10px; height: 12px;" title="Editar" >Edit</span>
                          
                        </a>

                    </li>

                    <li class="divider">&nbsp;</li>

                    <li class="btn-toolbar" >
                        <a href="<?php echo $data['rootUrl']; ?>admin/reservas" id="btn-cancel" class="link-button">
                            <span class="icon-delete" title="Cancel" >&nbsp;</span>
                            Cancel
                        </a>
                    </li>

<!--                     <li class="btn-toolbar">
                        <a style="margin-left:1px;" href="javascript:void(window.open('<?php echo $data['rootUrl'] ?>admin/reservas/add','RESERADD',''))">
                            <span class="icon-new" title="Nuevo" >&nbsp;</span>
                            New
                        </a>
                    </li> -->


                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div></div></div>
    


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">


              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="padding: unset;">



    <div id="form2" >
        <div id="filter-bar">
<div class="animated fadeIn col-lg-2 col-md-10 col-sm-10 col-xs-10"  >
            <label style="width:70px" class="filter-by">Filter By</label>
            <select name="filtro2" id="filtro" class="select2_single form-control" >
                <!-- <option value="r.id" <?php echo $data["filtro2"] == 'r.id' ? 'selected' : '' ?>>ID</option> -->
                <option value="tipo_ticket" <?php echo $data["filtro2"] == 'tipo_ticket' ? 'selected' : '' ?>>Type</option>
                <option value="codconf" <?php echo $data["filtro2"] == 'codconf' ? 'selected' : '' ?>>Code</option> 
                <option value="fecha_salida" <?php echo $data["filtro2"] == 'fecha_salida' ? 'selected' : '' ?>>Round Date</option>                
                <option value="reference" <?php echo $data["filtro2"] == 'reference' ? 'selected' : '' ?>>Reference</option>                
                <option value="fecha_retorno" <?php echo $data["filtro2"] == 'fecha_retorno' ? 'selected' : '' ?>>Return Date</option>
                <option value="lasname" <?php echo $data["filtro2"] == 'lasname' ? 'selected' : '' ?>>Lastname pax</option>
                <!-- <option value="opuser" <?php echo $data["filtro2"] == 'opuser' ? 'selected' : '' ?>>User</option> -->
                <option value="r.estado" <?php echo $data["filtro2"] == 'r.estado' ? 'selected' : '' ?>>Status</option>
                
            </select>
</div>
<script>
    /*$("#filtro").change(function(event) {
    var c = $('#filtro').text();
    alert(c);
    });*/

</script>
    <div class="animated fadeIn col-lg-4 col-md-9 col-sm-9 col-xs-9"  >
            <span class="search">
            <label style="width:70px" class="filter-by">Filter</label>
                <input name="texto2" type="text" size="30" maxlength="30" class="input-search form-control"  id="texto" value="<?php echo $data["texto2"] ?>"/>
                
                <!-- <input type="button" class="search-btn" id="btn-find" /> -->
            </span>

        </div>
        <div class="animated fadeIn col-lg-2 col-md-3 col-sm-3 col-xs-3"  style="margin-top: 30px;" >
            <label  class="filter-by"></label>
                <a id="btn-all" class="btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="see all"><i class="fa fa-list"></i></a>
                <a id="btn-find" class="btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="search"><i class="fa fa-search"></i></a>
        </div>
    </div>
<!--         <div class="animated fadeIn col-lg-1 col-md-3 col-sm-3 col-xs-3"  style="margin-top: 30px;" data-toggle="tooltip" data-placement="top"  title="search">
            <label  class="filter-by"></label>
                <a id="btn-find" class="btn-sm btn-success" title="search"><i class="fa fa-search"></i></a>
        </div> -->
<!--         <div class="animated fadeIn col-lg-1 col-md-3 col-sm-3 col-xs-3"  style="margin-top: 30px;" data-toggle="tooltip" data-placement="top"  title="export excel">
            <label  class="filter-by"></label>
                <a id="btn-exportex" class="btn-success btn-sm"><i class="fa fa-file-excel-o "></i></a>
        </div> -->


    </div>

        <div id="datagrid"  >
    
                <?php //echo date('Y-m-d',time());?>
                <?php //echo date("h:i:sa")?>
                <!-- <input id='conteo' type="text"> -->

                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table  jambo_table bulk_action " id="tablereservas">

                 <thead>
                    <tr class="headings">
                        <!--<th  width="20">&nbsp;</th>-->
                        <!--<th style="font-size: 11px; color:#fff; ;" width="20">Id</th>-->
                        <th style="font-size: 11px; color:#fff; ;" width="50">#Confirmation</th>                        
                        <th style="font-size: 11px; color:#fff; ;" width="150"><center>
                    Reference
                </center>
                </th>
                <th style="font-size: 11px; color:#fff; " width="50"><center>Type</center></th>                            
                <th style="font-size: 10px; color:#fff; " width="150"><center>Departure Date</center></th>
                <th style="font-size: 11px; color:#fff; " width="45"><center>Trip</center></th>                  
                <th style="font-size: 10px; color:#fff; " width="150"><center>Return Date</center></th>
                <th style="font-size: 11px; color:#fff; " width="45"><center>Trip</center></th>
                <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="180"><center>Pax Name</center></th>
                <th style="font-size: 11px; color:#fff; " width="90"><center>Phone</center></th>
                <th style="font-size: 11px; color:#fff; " width="50"><center>pax</center></th>
                <!--<th style="font-size: 11px; color:#fff; " width="100"><center>Agency </center></th>-->
                <th style="font-size: 11px; color:#fff; " width="71"><center>From</center></th>
                <th style="font-size: 11px; color:#fff; " width="90"><center>To</center></th>
                <th style="font-size: 11px; color:#fff; " width="45"><center>Total</center></th>
                <th style="font-size: 11px; color:#fff; " width="45"><center>Action</center></th>

                </tr>
                </thead>

                       <tbody >
                       <?php
                            $id = trim($prueba);                       
                            $ruta = "admin/reservas/edit/";
                            $url2 = $data['rootUrl'] . $ruta;
                        ?>
                    <?php
//print_r($data["reservas"]);
                    $i = 0;
                    foreach ($data["reservas"] as $e) {
                        //$e['passenger_balance_due']
                        // echo '<pre>';
                        // print_r($e);
                        // echo '</pre>';
                        // die;
                        // $total_full1 = ($e['totaltotal']);
                        // $total_full = number_format($total_full1, 2, '.', '');
                        //$total_full1 = ($e['total2'] + $e['total_charge']);
                        //$total_full = number_format($total_full1, 2, '.', '');passenger_balance_due
                        //$total_full = number_format( $e['passenger_balance_due'], 2, '.', '');
                        $total_full = number_format( $e['totaltotal'], 2, '.', '');
                        //$total_full = ($e['op_pago'] == 3 )? number_format( $e['total_paid']*0.04, 2, '.', '') : number_format( $e['total_paid'], 2, '.', '') ;
						//print_r($e);
                        ?>

                        <tr class="row<?php echo $i ?>">
                        <!--<td style="text-align:center;" ><input id="item" name="item" type="radio" onclick="capturar();" value="<?php echo $e['id']; ?>" /></td>-->
                        <!--<td style="text-align:center;" ><input style="text-align:center;  width:60px; background-color: #457ADC; border:0; color:#fff;" id="id_reserva" name="id_reserva" value="<?php echo $e['id']; ?>"/></td>-->
                        <td style=" text-align:center; color: #ca1351;  font-weight:bold; " ><b><?php if ($e['estado'] == "CANCELED") { ?> <strike>  <?php } ?><?php echo $e['codconf']; ?><?php if ($e['estado'] == "CANCELED") { ?> </strike>  <?php } ?></b></td>
                        <!-- <td style="text-align:center;   font-weight:bold; font-size: x-small;"><?php echo date('M-d-Y', strtotime($e['fecha_ini'])) . "  " . date('h:i A', strtotime($e['hora'])); ?></td>     -->
                        <td style="text-align:center;   font-weight:bold; font-size: x-small;"><?php echo $e['referenci']; ?></td>    

                        <td style="font-size: 15px; text-align:center;">
                        <span class="<?php echo ($e['tipo_ticket'] == 'oneway')? $r = 'label label-success' : $r = 'label label-warning'; ?>">
                        <b><?php echo $e['tipo_ticket']; ?></b>
                        </span>
                        </td>

                        <td style="text-align:center; font-size: x-small;">
                        <b><?php 
                        if($e['fecha_salida'] == '-N/A-' && $e['tipo_ticket'] == 'oneway' || $e['fecha_salida'] == '-N/A-') {
                            echo 'NO SHOW';
                        }else if($e['fecha_salida'] == '-C-' && $e['tipo_ticket'] == 'oneway' || $e['fecha_salida'] == '-C-'){
                            echo 'CANCELED';
                        }else if($e['fecha_salida'] == '--' && $e['tipo_ticket'] == 'oneway' || $e['fecha_salida'] == '--'){
                            echo 'CANCELED';
                        }else if($e['fecha_salida'] == '-N/S W/F-' && $e['tipo_ticket'] == 'oneway' || $e['fecha_salida'] == '-N/S W/F-'){
                            echo 'NO SHOW W/F';
                        }else if($e['fecha_salida'] == '-C W/F-' && $e['tipo_ticket'] == 'oneway' || $e['fecha_salida'] == '-C W/F-'){
                            echo 'CANCELED W/F';
                        }else if($e['fecha_salida'] == '-OP-'  && $e['tipo_ticket'] == 'oneway' || $e['fecha_salida'] == '-OP-'){
                            echo 'OPEN W/F';                            
                        }else if ($e['tipo_ticket'] == 'oneway'){
                            echo date('M-d-Y', strtotime($e['fecha_salida']));
                            echo '<br> ';
                            echo date('h:i A', strtotime($e['deptime1']));
                        } else {
                            echo ($e['tipo_ticket'] == 'roundtrip') ? date('M-d-Y', strtotime($e['fecha_salida'])) : '';
                            echo '<br> ';
                            echo date('h:i A', strtotime($e['deptime1']));
                        }
                        ?> </b> </td>
                    
                    
                    <td style=" text-align:center;"><b><?php echo $e['trip_no']; ?></b></td>

                    <td style="text-align:center; font-size: x-small;"><b><?php
                    
                        if($e['fecha_retorno'] == '-N/A-' && $e['tipo_ticket'] == 'roundtrip') {
                            echo 'NO SHOW';
                        }else if($e['fecha_retorno'] == '-C-' && $e['tipo_ticket'] == 'roundtrip'){
                            echo 'CANCELED';
                        }else if($e['fecha_retorno'] == '--' && $e['tipo_ticket'] == 'roundtrip'){
                            echo 'CANCELED';
                        }else if($e['fecha_retorno'] == '-N/S W/F-' && $e['tipo_ticket'] == 'roundtrip'){
                            echo 'NO SHOW W/F';
                        }else if($e['fecha_retorno'] == '-C W/F-'  && $e['tipo_ticket'] == 'roundtrip'){
                            echo 'CANCELED W/F';
                        }else if($e['fecha_retorno'] == '-OP-'  && $e['tipo_ticket'] == 'roundtrip'){
                            echo 'OPEN W/F';                            
                        }else if ($e['tipo_ticket'] == 'roundtrip'){
                            echo date('M-d-Y', strtotime($e['fecha_retorno']));
                            echo '<br>';
                            echo date('h:i A', strtotime($e['deptime2']));
                        }else {
                            echo ($e['tipo_ticket'] == 'roundtrip') ? date('M-d-Y', strtotime($e['fecha_retorno'])) : '';
                        }
                        
                        
                        ?> </b></td>
                    <td style="text-align:center; "><b><?php
                        if ($e['trip_no2'] == 0) {
                            $e['trip_no2'] = '';
                        }echo $e['trip_no2'];
                        ?></td>
                    <td style=" text-align:center; color: #0C6E8B;" ><b><?php echo $e['firsname'] . " " . $e['lasname']; ?> </b></td>
                    <td style=" text-align:center;"><b><?php
                        if ($e['phone'] == '0') {
                            $e['phone'] = '';
                        } 
                        echo $e['phone'];
                        ?> </b></td>
                    <td style=" text-align:center; color: #ca1351;"><b><?php echo $a = $e['pax'] + $e['pax2']; ?> </b></td>
                    <!--<td style="font-size: 10px; text-align:center;"><?php // echo $e['agencia']; ?> </td>-->
                    <td data-toggle="tooltip" data-placement="top" title="<?php echo $e['pickup1'] ?>" style=" text-align:center; color: #750B6F;"><b><?php echo $e['de']; ?> </b></td>
                    <td data-toggle="tooltip" data-placement="top" title="<?php echo $e['dropoff1'] ?>" style=" text-align:center; color: #044153;"><b><?php echo $e['para']; ?> </b></td>
                    <td style=" text-align:center; <?php echo  'color: #28b999;';//($total_full == 0)? 'color: red;' : 'color: #28b999;' ; ?> "><b><?php echo '$'.$total_full; //($total_full == 0)? 'paid out' : '$'.$total_full ; ?> </b></td> 
                    <td style=" text-align:center;">


                    <?php //echo date('m-d-Y'); ?>
                        <?php //date_default_timezone_set('America/Bogota'); //var_dump(date("H:i A")); ?>
                        <?php //var_dump(date('H:i A', strtotime($e['hora'])));?>

                        <?php 
                        $datetime1 = strtotime(date('Y-m-d' ,strtotime($e['fecha_salida']."- 1 days")));
                        $datetime2 = strtotime(date('Y-m-d',time()));
                        ?>
                        <?php //var_dump(date('m-d-Y', strtotime($e['fecha_ini']."+ 1 days")) > date('m-d-Y') || date('H:i A', +($e['hora'])) > date("H:i A") AND date('m-d-Y', strtotime($e['fecha_ini']."+ 1 days")) < date('m-d-Y'));?>

                        <?php //print_r($e); die;?>
                        <?php //var_dump(date('m-d-Y', strtotime($e['fecha_ini']."+ 1 days")));?>
                        <?php //var_dump(date('m-d-Y',time()));?>
                        <?php //var_dump($datetime1);?>
                        <?php //print(date('H:i', strtotime($e['deptime1'])));?>
                        <?php //print(date("H:i"));?>
                        <?php  $datenewdate = date('Y-m-d H:i:s', strtotime($e['fecha_salida']));?>
                        <?php  $datenewhour = date('Y-m-d H:i:s', strtotime($e['deptime1']));?>
                        <?php //print_r($date2 = new DateTime("now"));?>

                        <?php 

                        $date1 = new DateTime($datenewdate);// 2019-07-10 19:30:00 - 2015-02-14 15:29:00 (YY-MM-DD HH-MM-SS)
                        $date2 = new DateTime('now');
                        $diff = $date1->diff($date2);
                         $year =  ( $diff->y ); //. ' years';
                         $mo =  ( $diff->m ); //. ' min';
                         $day =  ( $diff->d ); //. ' day';


                        $date3 = new DateTime($datenewhour);// 2019-07-10 09:40:00 - 2015-02-14 15:29:00 (YY-MM-DD HH-MM-SS)
                        $date4 = new DateTime("now");
                        $diff2 = $date3->diff($date4);

                        $hora = ( ($diff2->days * 24 ) * 60 ) + ( $diff2->h ); //. ' hours';
                        $min = ( ($diff2->days * 24 ) * 60 ) + ( $diff2->i ); //. ' minutes';
                        $seg = ( ($diff2->days * 24 ) * 60 ) + ( $diff2->s ); //. ' seconds';
                        // passed means if its negative and to go means if its positive
                        // $daterestante = ($diff->invert == 1 ) ? ' passed ' : ' to go ';
                        
                        ?>
                        <?php //print_r($min );?>
                    <?php //print_r(/*$ms = "(".$mo." months, ".$day ." days)"*/ $hora.":".$min.":".$seg); //(". $hora.":".$min.":".$seg.") HORAS FALTANTES  ?> 
                        <?php //print_r( ($mo <= 0 && $day <= 0)? 'TODAY' : "(".$mo." months, ".$day ." days)" ) ?> 
                        <?php //print($min ." ".$daterestante );?>
                        <?php //print($diff->invert );?>
                        <?php //var_dump($datetime1 > $datetime2 );?>
                        <?php //var_dump(date('H:i A', strtotime($e['hora'])));?>
                        <?php //var_dump(date('H:i', strtotime($e['hora'])));?>
                        <?php //var_dump(date("H:i A"));?>
                        <?php 

                        if($datetime1 > $datetime2){
                             $validacion= 0;
                             
                             }else{
                                if ((date('H:i', strtotime($e['deptime1'])) > date("H:i")) ) {
                                        if ($datetime1 >= $datetime2 ) {
                                            $validacion= 0;
                                        }else{
                                            $validacion= 1;
                                        }
                                }else{
                                    
                                    $validacion= 1;
                                }
                            };

                        ?>
                        <?php //echo $validacion;?>
                        <?php //var_dump($datetime1 > $datetime2);?>
                        <?php //var_dump($datetime1);?>
                        <?php //var_dump($datetime2);?>
                        <?php //var_dump(date('H:i', strtotime($e['deptime1'])));?>
                        <?php //var_dump(date("H:i"));?>
                        <?php //var_dump((date('H:i', strtotime($e['hora'])) > date("H:i")) );?>
                        <?php //var_dump((date('H:i', strtotime($e['hora'])) > date("H:i")) AND $datetime1 > $datetime2);?>

                    <?php if($validacion== 0){ ?>
                    <a data-toggle="tooltip" data-placement="top" title="Remember that the reservation cannot be modified after : <?php echo date('M-d-Y', strtotime($e['fecha_salida']."- 1 days"));  ?>  <?php echo date('h:i a', strtotime($e['deptime1'])); ?> | the reservation expires  <?php echo $ms = "(".$mo." months, ".$day ." days ~ ".$hora." Hours ".$min." Minute)" ?> (GMT-4)  <?php //echo $min." ".$daterestante?>"  href="javascript:void(window.open('<?php echo $url2.$e['id']; ?>','RESERVAS',''))" id="btn-edit"  class="btn-xs btn-warning" onclick="retorno();"><i class="fa fa-edit"></i></td> 

                    <?php }else{ ?>

                    <a id="exp" data-toggle="tooltip" data-placement="top" title="Your can't Edit this Reservation, it's expired the last: <?php echo  date('M-d-Y', strtotime($e['fecha_salida']."- 1 days")); ?> at <?php echo date('h:i A', strtotime($e['deptime1'])); ?>  (GMT-4)"  href="javascript:void(window.open('<?php echo $url2.$e['id']; ?>','RESERVAS',''))"  class="btn-xs btn-danger" onclick="retorno();" disabled><i class="fa fa-eye"></i></td> 
                        <?php } ?>

                    </tr>
                    <?php
                    $i = 1 - $i;
                }
                ?>

                <script type="text/javascript">
                    // $('#btn-exportex').

                </script>
                </tbody>

                      </table>
                    </div>
                        
            <div id="pagination">
                <?php echo $data['pager'] ?>
            </div>
            
                        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


</form>

</div>
    


<script type="text/javascript">

    $(window).load(function () {

        comprobarScreen();
        //document.getElementById("idreser").style.background = '#f6f6f6';   

//           setTimeout(function () {
//                            
//                         $('#btn-edit').click();  
//                         exit();
//                         
//         }, 8000);    

    });

</script>
<script type="text/javascript">


    $('#grid tr').click(function () {
        $(this).find('input[name="item"]').prop('checked', true)

    });

    $('texto').keypress(function (e) {
        if (e.keyCode == 13)
            $('#form1').submit();
    })

    $('#btn-find').click(function () {
        $('#form1').submit();
    });

    $jq('#btn-all').click(function(){
        $jq('#texto').val('');
        $('#form1').submit();
    });

    $('#btn-edit').click(function (e) {

        var id = $('input[name=item]:checked').attr('value');


        if (!id) {
//            alert('You must select an Item');
//            e.preventDefault();
        } else {
//            var action = $(this).attr("href") + "/" + id;
//            $(this).attr("href", action);
        }

    });


    $('#btn-delete').click(function (e) {
        n = $('input[name=item]:checked').attr('value');
        if (!n) {
            alert('You must select an Item');
            e.preventDefault();
        } else {
            if (confirm("Are you sure of deleting this item? ...")) {
                var action = $(this).attr("href") + "/?item=" + n;
                $(this).attr("href", action);
            } else
            {
                return false;
            }
        }
    });

</script>





<script type="text/javascript">
    function regresar()
    {

        window.location.href == "<?php echo $data['rootUrl']; ?>admin/reservas";
        
        setTimeout(function () {

            $('#btn-back').click();

        }, 100);


    }
</script>

<script type="text/javascript">
    function retorno()
    {
        //$('#regreso').click();

    }
</script>



<script type="text/javascript">

    function comprobarScreen()
    {
        // if (window.screen.availWidth <= 640) {
        //     window.parent.document.body.style.zoom = "62%";
        // }

        // if (window.screen.availWidth == 800) {
        //     window.parent.document.body.style.zoom = "78%";
        // }
        // if (window.screen.availWidth == 1024) {
        //     window.parent.document.body.style.zoom = "100%";

        // }
        // if (window.screen.availWidth <= 1280) {
        //     window.parent.document.body.style.zoom = "100%";

        // }
        // if (window.screen.availWidth == 1366) {
        //     window.parent.document.body.style.zoom = "100%";

        // }
        
        // if (window.screen.availWidth == 1440) {
        //     window.parent.document.body.style.zoom = "100%";

        // }
        
        // if (window.screen.availWidth == 1600) {
        //     window.parent.document.body.style.zoom = "100%";

        // }
        
        // if (window.screen.availWidth == 1680) {
        //     window.parent.document.body.style.zoom = "100%";

        // }

        // if (window.screen.availWidth > 1680) {
        //     window.parent.document.body.style.zoom = "125%";


        // }
    }

</script>

<script>

    var z
    function capturar()
    {

        var resultado = "ninguno";
        var porNombre = document.getElementsByName("item");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for (var i = 0; i < porNombre.length; i++)
        {
            if (porNombre[i].checked)
                resultado = porNombre[i].value;
        }

        //z = document.getElementById("resultado").innerHTML = " \ " + resultado;
        z = document.getElementById("resultado").innerText = " \ " + resultado;
        document.getElementById("inputform").value = z;
        
//        var temporal = resultado;
//        
//        //alert(temporal);
//        
//        $.ajax({
//                
//                //datos que se envian a traves de ajax
//                url: '<?php echo $data['rootUrl']; ?>admin/reservas/temporal'+ temporal, //archivo que recibe la peticion
//                
//                type: 'POST', //método de envio
//                //'<i class="fa fa-spinner fa-spin" style="font-size:25px; color:red;"></i>'
//                beforeSend: function () {
//                        $("#resultado").html();
//                },
//                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
//                        $("#resultado").html(response);
//                        alert(temporal);
//                }
//
//        });
//        
        setTimeout(function () {

            $('#php').click();

            exit;

        }, 10);

    }


</script>

<script>
setInterval(function(){
                $("#tablereservas").load(' #tablereservas');

            }, 1000 * 60 * 60);//Lanzara la peticion cada 1 segundos
</script>



<?php }else{ ?>
              <script>
                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: 'btn btn-info'
                  },
                  buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                  title: 'You should not be here!',
                  text: "Return home immediately",
                  type: 'warning',
                  showCancelButton: false,
                  confirmButtonText: 'Okay, Return me home!',
                  reverseButtons: true
                }).then((result) => {
                  window.location="<?php echo $data['rootUrl']; ?>admin/home";
                })
                
                
                </script>
            <?php } ?>
            