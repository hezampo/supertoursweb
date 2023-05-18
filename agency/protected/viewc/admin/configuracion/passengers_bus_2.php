<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>  
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ddslick.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>

<!--<script type="text/javascript" src ="<? echo $data['rootUrl']; ?>global/js/jquery.js"></script>"-->
<!--<script type="text/javascript" src ="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.js"></script>

<style type="text/css" media="screen">
    .conborde
    {
        border: 1px solid #000;
        border-collapse:collapse;
    }

    table.conborde th,
    table.conborde td {
        border: 1px solid #000;
    }
    
  
</style>

<?php if (isset($_REQUEST['msg'])) { ?>

    <div class="error" style="margin-top: 10px;"><?php /* echo $_REQUEST['msg']; */ ?></div>


<?php } ?>



<?php

foreach ($data['buses'] as $bus) {

    $driver_bus[] = $bus['id_bus'];
    
}

$fechax = $data['fecha'];        
list ($mes1, $dia1, $anyo1) = explode("-", $fechax);
$fechax2 = $mes1 . "-" . $dia1 . "-" . $anyo1;
$fecha_ini = $fechax2;

$trip = $data['trip'];

$bus1 =  $driver_bus[0];
$bus2 =  $driver_bus[1];
$bus3 =  $driver_bus[2];
$bus4 =  $driver_bus[3];
$bus5 =  $driver_bus[4];

//Consulta para busqueda de conductor de vehiculo1


//$sqldvr1 = "SELECT DISTINCT driver FROM passengers_bus WHERE id_bus = '$driver_bus[0]' AND trip = '$trip' AND fec_ini = '$fecha_ini'";


$sqlcap = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip' AND capacity > '0' AND capacity2 >= '0' AND capacity3 >= '0' AND capacity4 >= '0' AND capacity5 >= '0'";
$rscap = Doo::db()->query($sqlcap);
$resultcap =  $rscap->fetchAll();

foreach ($resultcap as $cap){

}

$capacidad1 = $cap['capacity'];
$capacidad2 = $cap['capacity2'];
$capacidad3 = $cap['capacity3'];
$capacidad4 = $cap['capacity4'];
$capacidad5 = $cap['capacity5'];



$sqldvr1 = "SELECT DISTINCT p.driver AS CHOFE1 FROM passengers_bus p LEFT JOIN reservas r ON (p.id_reservas = r.id) WHERE p.id_bus = '$driver_bus[0]' AND p.trip = '$trip' AND p.fec_ini = '$fecha_ini'  AND r.fecha_salida != '-N/S W/F-' AND r.fecha_salida != '-N/A-' AND r.fecha_salida != '-C-' AND r.fecha_retorno != '-N/S W/F-' AND r.fecha_retorno != '-N/A-' AND r.fecha_retorno != '-C-' AND r.estado != 'NOT SHOW W/O CHARGE' AND r.estado != 'NOT SHOW W/ CHARGE' AND r.estado != 'QUOTE' AND r.estado != 'CANCELED'";
$rsdvr1 = Doo::db()->query($sqldvr1);
$driver1 = $rsdvr1->fetchAll();


foreach ($driver1 as $drv1) {
    
}
$conductor1 = $drv1['CHOFE1'];
$conductor_bus1 = str_replace("%20", " ", $conductor1);



//Consulta para busqueda de conductor de vehiculo2

//$sqldvr2 = "SELECT driver2 FROM passengers_bus WHERE id_bus = '$driver_bus[1]' AND trip = '$trip' AND fec_ini = '$fecha_ini'";
$sqldvr2 = "SELECT DISTINCT p.driver2 AS CHOFE2 FROM passengers_bus p LEFT JOIN reservas r ON (p.id_reservas = r.id) WHERE p.id_bus = '$driver_bus[1]' AND p.trip = '$trip' AND p.fec_ini = '$fecha_ini'  AND r.fecha_salida != '-N/S W/F-' AND r.fecha_salida != '-N/A-' AND r.fecha_salida != '-C-' AND r.fecha_retorno != '-N/S W/F-' AND r.fecha_retorno != '-N/A-' AND r.fecha_retorno != '-C-' AND r.estado != 'NOT SHOW W/O CHARGE' AND r.estado != 'NOT SHOW W/ CHARGE' AND r.estado != 'QUOTE' AND r.estado != 'CANCELED'";
$rsdvr2 = Doo::db()->query($sqldvr2);
$driver2 = $rsdvr2->fetchAll();


foreach ($driver2 as $drv2) {
    
}
$conductor2 = $drv2['CHOFE2'];
$conductor_bus2 = str_replace("%20", " ", $conductor2);

//Consulta para busqueda de conductor de vehiculo3

//$sqldvr3 = "SELECT driver3 FROM passengers_bus WHERE id_bus = '$driver_bus[2]' AND trip = '$trip' AND fec_ini = '$fecha_ini'";
$sqldvr3 = "SELECT DISTINCT p.driver3 AS CHOFE3 FROM passengers_bus p LEFT JOIN reservas r ON (p.id_reservas = r.id) WHERE p.id_bus = '$driver_bus[2]' AND p.trip = '$trip' AND p.fec_ini = '$fecha_ini'  AND r.fecha_salida != '-N/S W/F-' AND r.fecha_salida != '-N/A-' AND r.fecha_salida != '-C-' AND r.fecha_retorno != '-N/S W/F-' AND r.fecha_retorno != '-N/A-' AND r.fecha_retorno != '-C-' AND r.estado != 'NOT SHOW W/O CHARGE' AND r.estado != 'NOT SHOW W/ CHARGE' AND r.estado != 'QUOTE' AND r.estado != 'CANCELED'";
$rsdvr3 = Doo::db()->query($sqldvr3);
$driver3 = $rsdvr3->fetchAll();


foreach ($driver3 as $drv3) {
    
}
$conductor3 = $drv3['CHOFE3'];
$conductor_bus3 = str_replace("%20", " ", $conductor3);




//Consulta para busqueda de conductor de vehiculo4

//$sqldvr4 = "SELECT driver4 FROM passengers_bus WHERE id_bus = '$driver_bus[3]' AND trip = '$trip' AND fec_ini = '$fecha_ini'";
$sqldvr4 = "SELECT DISTINCT p.driver4 AS CHOFE4 FROM passengers_bus p LEFT JOIN reservas r ON (p.id_reservas = r.id) WHERE p.id_bus = '$driver_bus[3]' AND p.trip = '$trip' AND p.fec_ini = '$fecha_ini'  AND r.fecha_salida != '-N/S W/F-' AND r.fecha_salida != '-N/A-' AND r.fecha_salida != '-C-' AND r.fecha_retorno != '-N/S W/F-' AND r.fecha_retorno != '-N/A-' AND r.fecha_retorno != '-C-' AND r.estado != 'NOT SHOW W/O CHARGE' AND r.estado != 'NOT SHOW W/ CHARGE' AND r.estado != 'QUOTE' AND r.estado != 'CANCELED'";

$rsdvr4 = Doo::db()->query($sqldvr4);
$driver4 = $rsdvr4->fetchAll();


foreach ($driver4 as $drv4) {
    
}
$conductor4 = $drv4['CHOFE4'];
$conductor_bus4 = str_replace("%20", " ", $conductor4);


//Consulta para busqueda de conductor de vehiculo5

//$sqldvr5 = "SELECT driver5 FROM passengers_bus WHERE id_bus = '$driver_bus[4]' AND trip = '$trip' AND fec_ini = '$fecha_ini'";
$sqldvr5 = "SELECT DISTINCT p.driver5 AS CHOFE5 FROM passengers_bus p LEFT JOIN reservas r ON (p.id_reservas = r.id) WHERE p.id_bus = '$driver_bus[4]' AND p.trip = '$trip' AND p.fec_ini = '$fecha_ini'  AND r.fecha_salida != '-N/S W/F-' AND r.fecha_salida != '-N/A-' AND r.fecha_salida != '-C-' AND r.fecha_retorno != '-N/S W/F-' AND r.fecha_retorno != '-N/A-' AND r.fecha_retorno != '-C-' AND r.estado != 'NOT SHOW W/O CHARGE' AND r.estado != 'NOT SHOW W/ CHARGE' AND r.estado != 'QUOTE' AND r.estado != 'CANCELED'";

$rsdvr5 = Doo::db()->query($sqldvr5);
$driver5 = $rsdvr5->fetchAll();


foreach ($driver5 as $drv5) {    
}

$conductor5 = $drv5['CHOFE5'];
$conductor_bus5 = str_replace("%20", " ", $conductor5);

//$conductor_bus = urldecode($conductor);
//echo $conductor_bus;
?>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/trips/reserves-bus-save"  class="form" id="form1">


    
    <div id="header_page" >
        <div class="header">Passengers Bus - Trip <?php echo $data['trip']; ?>, Date <?php echo date('M-d-Y', strtotime($data['fecha'])); ?>
<!--            <td><BR></td>
            <td><label>BUS 01<input type="radio" name="bus" id="bus1" checked="checked" value="1"  /></label></td>
            <td>&nbsp;&nbsp;&nbsp</td>
            <td><label>BUS 02<input type="radio" name="bus" id="bus2" value="2" /></label></td>
            <td>&nbsp;&nbsp;&nbsp</td>
            <td><label>BUS 03<input type="radio" name="bus" id="bus3" value="3" /></label></td>
            <td>&nbsp;&nbsp;&nbsp</td>
            <td><label>BUS 04<input type="radio" name="bus" id="bus4" value="4" /></label></td>
            <td>&nbsp;&nbsp;&nbsp</td>
            <td><label>BUS 05<input type="radio" name="bus" id="bus5" value="5" /></label></td>-->
            
            <input type="hidden" value="<?php echo $data['trip']; ?>" name="trip" id="trip" />
            <input type="hidden" value="<?php echo date('m-d-Y', strtotime($data['fecha'])); ?>" name="fecha_ini" id="fecha_ini" />
        </div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <!--<li class="btn-toolbar" id="btn-save" ><a class="link-button"  id="btn-save"> <span class="icon-32-save"
                                                                                                      title="Nuevo">&nbsp;</span>
                        Save <input type="hidden" name="opcionGuardarPasajero" id="opcionGuardarPasajero" value="<? echo $data['msg_buses'];?>" /></a></li>-->
                    <li class="btn-toolbar" id="btn-cancel">
                        <a class="link-button"  id="btn-cancel"> <span class="icon-back" title="Editar">&nbsp;</span>
                            Cancel </a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>


</div>

<div>

    <table readonly="true" class="conborde" cellspacing="0" cellpadding="0" id="no_asignados"  style="width: 56%; margin-left: 0px; border: 1px solid #000; border-spacing: 1px; background-color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">                        

        <!-- <div class="ausu-suggest" id="opera">   '  ' .                              
             <input type="text" size="35" value="" name="leader" id="leader" autocomplete="off" />
             <input type=  size="15"  value="0" name="id_leader" id="id_leader" autocomplete="off" />                                  
         </div> -->
        <caption style="display:none; background-color:#0B55C4; color:#FFFFFF; font-size: 18px; padding-top:2px;">Passengers Bus - Trip <?php echo $data['trip']; ?>, Date <?php echo date('M-d-Y', strtotime($data['fecha'])); ?></caption>         
        <thead>
            <tr>
                <th readonly="true" style="background-color:red; color:#FFFFFF; font-size: 13px;" width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'firsname');">Pax Name
                    <input type="hidden" value="firsname" name="cOrder<?php echo $bus['id_bus']; ?>" id="cOrder<?php echo $bus['id_bus']; ?>" />
                    <input type="hidden" value="0" name="estadoOrder<?php echo $bus['id_bus']; ?>" id="estadoOrder<?php echo $bus['id_bus']; ?>" />
                </th>
                <th readonly="true" style="background-color:red; color:#FFFFFF; font-size: 13px;" width="10" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'totalPax');" >pax #</th>
                <th readonly="true" style="background-color:red; color:#FFFFFF; font-size: 13px;" width="50" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'company_name');" >Agency</th>
<!--                              <th width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>','de');">From</th>
                <th width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>','dropoff');">To</th>-->
<!--                              <th width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>','dropoff');">Reserva</th>-->
                <th readonly="true" style="background-color:red; color:#FFFFFF; font-size: 13px;" width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'dropoff');">Estate</th>

            </tr>
        </thead>
        <!--<tr>
          <td><button type="button" style="float: right" id="print_pax">Submit</button></td>
        </tr>-->
        <tbody  id="tb_<?php echo $bus['id_bus'] ?>">
<?php
//						  $cont = 0;
//						  $i = 0;

$fecha = $data['fecha'];

list ($mes, $dia, $anyo) = explode("-", $fecha);
$fecha2 = $mes . "-" . $dia . "-" . $anyo;
$fec_ini = $fecha2;

//        echo $fec_ini; (anio, mes dia)

$trip1 = $data['trip'];

$sql55 = "SELECT p.id_reservas FROM passengers_bus p LEFT JOIN reservas r ON (p.id_reservas = r.id) WHERE p.id_bus = '0' AND p.trip = '$trip1' AND p.fec_ini='$fec_ini' AND r.fecha_salida != '-N/S W/F-' AND r.fecha_salida != '-N/A-' AND r.fecha_salida != '-C-' AND r.fecha_retorno != '-N/S W/F-' AND r.fecha_retorno != '-N/A-' AND r.fecha_retorno != '-C-' AND r.estado != 'NOT SHOW W/O CHARGE' AND r.estado != 'NOT SHOW W/ CHARGE' AND r.estado != 'QUOTE' AND r.estado != 'CANCELED'";
//$sql55 = "SELECT id_reservas FROM passengers_bus WHERE id_bus = '0' AND trip = '$trip1' AND fec_ini='$fec_ini'";
$rs55 = Doo::db()->query($sql55);
$reservas = $rs55->fetchAll();

foreach ($reservas as $reserv) {

    $idreserva = $reserv['id_reservas'];


    $sql6 = "SELECT firsname, lasname, pax, pax2,agen,fromt,dropoff1 FROM reservas WHERE id = '$idreserva'";
    $rs6 = Doo::db()->query($sql6);
    $reservas_tabla = $rs6->fetchAll();

    foreach ($reservas_tabla as $resertabla) {

        $nombre_pasajero = strtoupper($resertabla['firsname']);
        $apellido_pasajero = strtoupper($resertabla['lasname']);
        $pasajeros_adultos = $resertabla['pax'];
        $pasajeros_ninos = $resertabla['pax2'];
        $id_agencia = $resertabla['agen'];
        $from = $resertabla['fromt'];
        $dropoff = $resertabla['dropoff1'];

        $estado = '*** NO Assign ***';

        $sql7 = "SELECT company_name FROM agencia WHERE id = '$id_agencia'";
        $rs7 = Doo::db()->query($sql7);
        $agen = $rs7->fetchAll();

        foreach ($agen as $ag) {

            $compania = strtoupper($ag['company_name']);
            $cont = 0;
            $i = 0;

//                                    $e['id'] =$idreserva;
            //                        foreach($data['reservas'] as $e){

            if ($e['bus'] == $bus['id_bus']) {
                if (trim($e['nomExten2']) != '') {
                    $para = $e['nomExten2'] . '(EXT)';
                } else {
                    $para = $e['dropoff'];
                }
            }
            ?>
                    <tr id="row<?php echo $idreserva; ?>" style="height:12px;" class="row<?php echo $i ?>" onclick="selecionar('row<?php echo $idreserva; ?>');" >
                    <input type="hidden" name="reserves" id="r_<?php echo $idreserva; ?>" value="0" />
                    <td style="text-align: left; font-size:12px; padding-left: 8px; background-color:#F6F6F6;" ><?php echo $nombre_pasajero . " " . $apellido_pasajero; ?> </td>
                    <td style="text-align: center; font-size:12px; background-color:#F6F6F6;"><?php echo $a = $resertabla['pax'] + $resertabla['pax2']; ?> </td>
                    <td style="text-align: left; font-size:12px; padding-left: 5px; background-color:#F6F6F6;"  ><?php echo $compania; ?></td>
            <!--                                      <td style="font-size:9px;" ><?php /*echo $e['de'];*/ ?> </td>
                    <td style="font-size:9px;"><?php /*echo $para; */?> </td>-->
            <!--                                  <td style="font-size:10px;"  ><?php /*echo $e['id']; */?></td>-->
                    <td style="text-align: center; font-size:12px;color:red; font-weight:bold; background-color:#F6F6F6;"  ><?php echo $estado; ?></td>
                    </tr>
            <?php
            $i = 1 - $i;
        }
    }
}
?>
        </tbody>
    </table>
    
    <br>

</div>

<div style="display:none;">
<td>
    <input type="text" name="idfbus" id="idfbus" style="" value="" />
    <input type="text" name="buse1" id="buse1" style="" value="<?php echo $bus1;?>" />
    <input type="text" name="buse2" id="buse2" style="" value="<?php echo $bus2;?>" />
    <input type="text" name="buse3" id="buse3" style="" value="<?php echo $bus3;?>" />
    <input type="text" name="buse4" id="buse4" style="" value="<?php echo $bus4;?>" />
    <input type="text" name="buse5" id="buse5" style="" value="<?php echo $bus5;?>" />
    
    <br>
</td>
</div>

<div style="display:none;">
<td><label id="lbl1">BUS 01<input type="radio" name="bus" id="bus1" onClick="capturar();" value="1"  /></label></td>
<td>&nbsp;&nbsp;&nbsp</td>
<td><label id="lbl2">BUS 02<input type="radio" name="bus" id="bus2" onClick="capturar();" value="2" /></label></td>
<td>&nbsp;&nbsp;&nbsp</td>
<td><label id="lbl3">BUS 03<input type="radio" name="bus" id="bus3" onClick="capturar();" value="3" /></label></td>
<td>&nbsp;&nbsp;&nbsp</td>
<td><label id="lbl4">BUS 04<input type="radio" name="bus" id="bus4" onClick="capturar();" value="4" /></label></td>
<td>&nbsp;&nbsp;&nbsp</td>
<td><label id="lbl5">BUS 05<input type="radio" name="bus" id="bus5" onClick="capturar();" value="5" /></label></td>
<td><br></td>
<td>&nbsp;&nbsp;&nbsp</td>
</div>
<!--overflow-x:scroll; border:1px #00C solid; -->

<div id="datagrid" style=" margin-left:1px; width:auto;  overflow-style:auto;">
    <div id="cargarBus"></div>

    <table width="574" height="174" border="0">
        <tr>
<?php
$i = 0;
$z = 0;

foreach ($data['buses'] as $bus) {
    $i++;
    $z++;
    

    $col = count($data['reservas']);
    $h = $col * (5);
    ?>



                <td width="576"  height="<?php echo $h ?>px" rowspan="<?php echo $h; ?>" valign="top">
                    
                    <fieldset  style="height:auto; width: 382px;">
                        

                        
                        <legend><?php 
                            
                            if($bus['id_bus'] == $bus1){
                                
                                if($capacidad1 <= 14){
                                    $tipo = "Express";
                                }else{
                                    $tipo = "Bus";
                                }
                                
                                echo "<i class='fa fa-bus fa-3x' style='margin-left: 0px; color: #a300e3;'></i>&nbsp;&nbsp;&nbsp;<strong style=\"color:#ffffff; border:2px solid #000; background-color:#a300e3; font-size:12px; \">Vehicle 1  »  Capacity: $capacidad1  »  $tipo </strong>";
                                
                            } 
                            if($bus['id_bus'] == $bus2){
                                
                                if($capacidad2 <= 14){
                                    $tipo = "Express";
                                }else{
                                    $tipo = "Bus";
                                }
                                
                                echo "<i class='fa fa-bus fa-3x' style='margin-left: 0px; color: #0089ff;'></i>&nbsp;&nbsp;&nbsp;<strong style=\"color:#ffffff; border:2px solid #000; background-color:#0089ff; font-size:12px; \">Vehicle 2  »  Capacity: $capacidad2  »  $tipo</strong>";
                                
                            } 
                            
                            if($bus['id_bus'] == $bus3){
                                
                                if($capacidad3 <= 14){
                                    $tipo = "Express";
                                }else{
                                    $tipo = "Bus";
                                }
                                
                                echo "<i class='fa fa-bus fa-3x' style='margin-left: 0px; color: #ff0000;'></i>&nbsp;&nbsp;&nbsp;<strong style=\"color:#ffffff; border:2px solid #000; background-color:#ff0000; font-size:12px; \">Vehicle 3  »  Capacity: $capacidad3  »  $tipo</strong>";
                                
                            } 
                            
                            if($bus['id_bus'] == $bus4){
                                
                                if($capacidad4 <= 14){
                                    $tipo = "Express";
                                }else{
                                    $tipo = "Bus";
                                }
                                
                                echo "<i class='fa fa-bus fa-3x' style='margin-left: 0px; color: #009624;'></i>&nbsp;&nbsp;&nbsp;<strong style=\"color:#ffffff; border:2px solid #000; background-color:#009624; font-size:12px; \">Vehicle 4  »  Capacity: $capacidad4  »  $tipo</strong>";
                                
                            } 
                            
                            if($bus['id_bus'] == $bus5){
                                
                                if($capacidad5 <= 14){
                                    $tipo = "Express";
                                }else{
                                    $tipo = "Bus";
                                }
                                
                                echo "<i class='fa fa-bus fa-3x' style='margin-left: 0px; color: #ff8c00;'></i>&nbsp;&nbsp;&nbsp;<strong style=\"color:#ffffff; border:2px solid #000; background-color:#ff8c00; font-size:12px; \">Vehicle 5  »  Capacity: $capacidad5  »  $tipo</strong>";
                                
                            } 
                            
                            
                            echo " ";
                            ?>
                        </legend>

    <!--  'Vehicle 0' . $z . ' -> ' . $bus['plate'] . '-' . echo strtoupper($bus['tipobus']);                          <input type="text" id="idbus<?php /*echo $bus['id_bus'];*/ ?>" name="idbus<?php /*echo $bus['id_bus'];*/ ?>" size="12" style="" value="<?php /*echo $bus['id_bus'];*/ ?>" />-->
                        <input type="hidden" id="<?php echo strtoupper('BUS 0' . $z); ?>" name="<?php echo strtoupper('BUS 0' . $z); ?>" size="12" style="" value="<?php echo strtoupper('BUS 0' . $z); ?>" />
                        <table width="110%">
                            <tr>
                                <td><table><tr>
                                            <td>
                                                    <!--<button type="button" value="<? echo $bus['id_bus'];?>" name="add-<? echo $bus['id_bus'];?>" id="add-<? echo $bus['id_bus'];?>" >ADD</button>-->
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <table style="border:1px solid #000; margin-left: -14px;">
                                                    <tr>
                                                        <td colspan="2" align="center"><strong>By</strong></td>
                                                    <tr>
                                                    </tr>
                                                    <td><label>Pick up <input type="radio" name="cOrder<?php echo $bus['id_bus'] ?>" id="cOrder_pick<?php echo $bus['id_bus'] ?>" checked="checked" value="1"  /></label></td>
                                                    <td><label>Drop Off <input type="radio" name="cOrder<?php echo $bus['id_bus'] ?>" id="cOrder_drop<?php echo $bus['id_bus'] ?>" value="2" /></label></td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <table style="border:1px solid #000; width:231px;">
                                        <tr>
                                            <td colspan="2" style="margin-left:30px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspDriver</strong></td>

                                        <tr>
                                        </tr>
                                        <td>
                                            <label>
                                                <select style="margin-top:-2px;" name="agency_<?php echo $bus['id_bus'] ?>" id="agency_<?php echo $bus['id_bus'] ?>">
                                                    <option value="0">Dispatch</option>
                                                    <option value="1">Drivers</option>
                                                </select>
                                            </label>
                                        </td>
                                        <td> 

                                            <input type="text" name="conductor<?php echo $z; ?>" id="conductor<?php echo $z; ?>"  size="25" maxlength="25" style="text-align:center; width: 142px; margin-top:-3px; height: 16px;" value="">
                                            
<!--                                            <input type="text" name="capacidad<?php /*echo $z; */?>" id="capacidad<?php /*echo $z;*/ ?>"  size="25" maxlength="25" style="text-align:center; width: 142px; margin-top:-3px; height: 16px;" value="">-->

    <!--                                             <input type="text" name="conductor2" id="conductor2"  size="25" maxlength="25" style="text-align:center; width: 112px;  height: 16px;" value="<?php /*echo ($conductor_bus2);*/ ?>">
    <input type="text" name="conductor3" id="conductor3"  size="25" maxlength="25" style="text-align:center; width: 112px;  height: 16px;" value="<?php /*echo ($conductor_bus3);*/ ?>">
    <input type="text" name="conductor4" id="conductor4"  size="25" maxlength="25" style="text-align:center; width: 112px;  height: 16px;" value="<?php /*echo ($conductor_bus4);*/ ?>">
    <input type="text" name="conductor5" id="conductor5"  size="25" maxlength="25" style="text-align:center; width: 112px;  height: 16px;" value="<?php /*echo ($conductor_bus5);*/ ?>">-->

                                        </td> 
                            </tr>
                        </table></td>
            </tr></table>
        </td>                         
        <td>&nbsp;</td>

        <select name="drivers2<?php echo $z; ?>" id="drivers2<?php echo $z; ?>" style=" margin-left:66px; margin-top:6px;width:199px; height:20px;" onchange="combo();">
            <option value="0">Select Driver</option>
    <?php
    $sql2 = "SELECT id, firstname, lastname FROM driver";
    $rs2 = Doo::db()->query($sql2, array(9));
    $drivers2 = $rs2->fetchAll();
    foreach ($drivers2 as $dr) {
        echo '<option value="' . $dr ['id'] . '"  >' . $dr ['firstname'] . '-' . $dr ['lastname'] . '</option>';
        //echo '<option value="' . $dr ['id'] . '"  >'.'</option>';
    }
    ?>
        </select>

        <div id="result"> </div>

        <td>
            <!--validaconductor();-->
            <a style="margin-left:2px;" onclick=" pdf('<?php echo $bus['id_bus'] ?>')" ><i id="<?php echo "dw".$bus['id_bus']; ?>" class="fa fa-download fa-2x" style="display:none; position:fixed; color:#AC1B29; margin-top: -67px; margin-left: -50px;"></i><img src="<?php echo $data['rootUrl']; ?>global/images/pdf.png" width="180%" height="550%"  style="position:absolute; margin-left:-75px; margin-top:-67px; cursor:pointer; height:19px; width:16px;" class="pdf-bus"  id="<?php echo $bus['id_bus']; ?>" /></a>

    <!--                                    <a onclick=" pdf('<?php /*echo $z;*/ ?>')" ><img src="<?php /*echo $data['rootUrl'];*/ ?>global/images/pdf.png" width="100%" height=""  style="cursor:pointer;" class="pdf-bus" id="<?php /*echo $z;*/ ?>" /></a>-->
        </td>
        <td style="margin-right:180px;">
            <strong style="color:#00A636; margin-right:1px;">
    <?php /*echo 'Capacity: ' . $bus['capacidad']; */?></strong>
            <strong style="position:absolute; color:#FF1A1F; margin-left:-101px; margin-top:-40px; width:73px; font-size: 12px;">Allotted: <samp style="" id="allotted<?php echo $bus['id_bus'] ?>"><?php echo $this->data['totalPaxBus'][$bus['id_bus']]; ?></samp></strong>
        </td>
        </tr>
        </table>
        <div id="areaBus<?php echo $bus['id_bus']; ?>">
            <table class="grid2" cellspacing="0" cellpadding="0" id="table_<?php echo $bus['id_bus'] ?>">                        

                <!-- <div class="ausu-suggest" id="opera">   '  ' .                              
                     <input type="text" size="35" value="" name="leader" id="leader" autocomplete="off" />
                     <input type=  size="15"  value="0" name="id_leader" id="id_leader" autocomplete="off" />                                  
                 </div> -->

                <thead>
                    <tr>
                        <th width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'firsname');">Pax Name
                            <input type="hidden" value="firsname" name="cOrder<?php echo $bus['id_bus']; ?>" id="cOrder<?php echo $bus['id_bus']; ?>" />
                            <input type="hidden" value="0" name="estadoOrder<?php echo $bus['id_bus']; ?>" id="estadoOrder<?php echo $bus['id_bus']; ?>" />
                        </th>
                        <th width="10" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'totalPax');" >pax #</th>
                        <th width="40" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'company_name');" >Agency</th>
                        <th width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'de');">From</th>
                        <th width="30" onclick="ordenar('<?php echo $bus['id_bus']; ?>', 'dropoff');">To</th>

                    </tr>
                </thead>
                <!--<tr>
                  <td><button type="button" style="float: right" id="print_pax">Submit</button></td>
                </tr>-->
                <tbody  id="tb_<?php echo $bus['id_bus'] ?>">
    <?php
    $cont = 0;
    $i = 0;
    foreach ($data['reservas'] as $e) {

        if ($e['bus'] == $bus['id_bus']) {
            if (trim($e['nomExten2']) != '') {
                $para = $e['nomExten2'] . '(EXT)';
            } else {
                $para = $e['dropoff'];
            }
            ?>
                            <tr id="row<?php echo $e['id']; ?>" style="height:12px;" class="row<?php echo $i ?>" onclick="selecionar('row<?php echo $e['id']; ?>');" >
                        <input type="hidden" name="reserves" id="r_<?php echo $e['id']; ?>" value="0" />
                        <td style="font-size:10px;" ><?php echo $e['firsname'] . " " . $e['lasname']; ?> </td>
                        <td><?php echo $a = $e['pax'] + $e['pax2']; ?> </td>
                        <td style="font-size:10px;"  ><?php echo $e['company_name']; ?></td>
                        <td style="font-size:9px;" ><?php echo $e['de']; ?> </td>
                        <td style="font-size:9px;"><?php echo $para; ?> </td>
                        </tr>
            <?php
            $i = 1 - $i;
        }
    }
    ?>
                </tbody>
            </table>

        </div>

        </fieldset>
        </td>
<?php } ?>
    </tr>
    <tr>
    </tr>
    </table>

    <div id="pagination">

    </div>
</div>

 <div class="" id="download" style="display:none; position:fixed; overflow: visible; z-index: 1000; margin-left: -396px; margin-top: 0px; font-weight: bold; font-size: 20px; ">
    
    <a style="margin-left: 690px; margin-top: -389px; position: absolute;"><img src ='<?php echo $data['rootUrl'] ?>global/img/download/download1.gif' width="25px" height="25px" margin-left="0px" margin-top="0px">
    
</div> 


<!--        <table style="width: 40%; border-spacing: 1px; background-color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #0A439A;">
<thead>
    <tr>
        <th style="background: #F0F0F0;color: #0B55C4;">Pax Name</th>
        <th style="background: #F0F0F0;color: #0B55C4;">pax #</th>
        <th style="background: #F0F0F0;color: #0B55C4;">Agency</th>
        <th style="background: #F0F0F0;color: #0B55C4;">From</th>
        <th style="background: #F0F0F0;color: #0B55C4;">To</th>
        <th style="background: #F0F0F0;color: #0B55C4;">Estado</th>
        
    </tr>
</thead>
<tbody>
<?php
//foreach ($rows as $row) {
?>
    <tr>
        <td><?php /*echo 'A';*/ ?></td>
        <td><?php /*echo 'B';*/ ?></td>
        <td><?php /*echo 'C'; */?></td>
        <td><?php /*echo 'D'; */?></td>
        <td><?php /*echo 'E'; */?></td>
        <td><?php /*echo 'F'; */?></td>
    </tr>
<?php
//}
?>
</tbody>
</table>-->
<div style="display:none;" id="resultado"></div>

</form>

</div>
<?php if (isset($_SESSION['elimi'])) { ?>
    <script>

        jQuery.noticeAdd({
            text: '<?php echo $_SESSION['elimi']; ?>',
            stay: true
        });
    </script>
<?php } unset($_SESSION['elimi']); ?>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<!--<script type="text/javascript">

    function validaconductor()
    {
        var conduct = document.getElementById('drivers2').value;
       
        if (conduct == 0) {

            
            alert('¡¡¡ Selecciona un Conductor por Favor !!! ');
            exit;

        }
    }

</script>-->



<script type="text/javascript">

          function comprobarScreen()
          {
              
              var buses = "<?php echo $z; ?>";         
              
              if(buses == '1'){
                  
                  document.getElementById('bus1').style.display = '';
                  document.getElementById('bus2').style.display = 'none';
                  document.getElementById('bus3').style.display = 'none';
                  document.getElementById('bus4').style.display = 'none';
                  document.getElementById('bus5').style.display = 'none';
                  document.getElementById('lbl2').style.display = 'none';
                  document.getElementById('lbl3').style.display = 'none';
                  document.getElementById('lbl4').style.display = 'none';
                  document.getElementById('lbl5').style.display = 'none';
              }
              
              if(buses == '2'){
                  
                  document.getElementById('bus1').style.display = '';
                  document.getElementById('bus2').style.display = '';
                  document.getElementById('lbl1').style.display = '';
                  document.getElementById('lbl2').style.display = '';
                  document.getElementById('bus3').style.display = 'none';
                  document.getElementById('bus4').style.display = 'none';
                  document.getElementById('bus5').style.display = 'none';
                  document.getElementById('lbl3').style.display = 'none';
                  document.getElementById('lbl4').style.display = 'none';
                  document.getElementById('lbl5').style.display = 'none';                
             
              }
              
              if(buses == '3'){
                  
                  document.getElementById('bus1').style.display = '';
                  document.getElementById('bus2').style.display = '';
                  document.getElementById('bus3').style.display = '';
                  document.getElementById('lbl1').style.display = '';
                  document.getElementById('lbl2').style.display = '';
                  document.getElementById('lbl3').style.display = '';
                  document.getElementById('bus4').style.display = 'none';
                  document.getElementById('bus5').style.display = 'none';
                  document.getElementById('lbl4').style.display = 'none';
                  document.getElementById('lbl5').style.display = 'none';
                  
              }
              
              if(buses == '4'){
                  
                  document.getElementById('bus1').style.display = '';
                  document.getElementById('bus2').style.display = '';
                  document.getElementById('bus3').style.display = '';
                  document.getElementById('bus4').style.display = '';
                  document.getElementById('lbl1').style.display = '';
                  document.getElementById('lbl2').style.display = '';
                  document.getElementById('lbl3').style.display = '';
                  document.getElementById('lbl4').style.display = '';
                  document.getElementById('bus5').style.display = 'none';
                  document.getElementById('lbl5').style.display = 'none';
                  
              } 
              
              if(buses == '5'){
                  
                  document.getElementById('bus1').style.display = '';
                  document.getElementById('bus2').style.display = '';
                  document.getElementById('bus3').style.display = '';
                  document.getElementById('bus4').style.display = '';
                  document.getElementById('bus5').style.display = '';
                  document.getElementById('lbl1').style.display = '';
                  document.getElementById('lbl2').style.display = '';
                  document.getElementById('lbl3').style.display = '';
                  document.getElementById('lbl4').style.display = '';
                  document.getElementById('lbl5').style.display = '';
                  
              } 
              
              if (window.screen.availWidth <= 640) {
                  window.parent.document.body.style.zoom = "62%";
              }

              if (window.screen.availWidth == 800) {
                  window.parent.document.body.style.zoom = "78%";
              }
              if (window.screen.availWidth == 1024) {
                  window.parent.document.body.style.zoom = "100%";

              }
              if (window.screen.availWidth <= 1280) {
                  window.parent.document.body.style.zoom = "100%";

              }
              if (window.screen.availWidth == 1366) {
                  window.parent.document.body.style.zoom = "100%";

              }

              if (window.screen.availWidth == 1440) {
                  window.parent.document.body.style.zoom = "100%";

              }

              if (window.screen.availWidth == 1600) {
                  window.parent.document.body.style.zoom = "100%";

              }

              if (window.screen.availWidth == 1680) {
                  window.parent.document.body.style.zoom = "100%";

              }

              if (window.screen.availWidth > 1680) {
                  window.parent.document.body.style.zoom = "125%";


              }
          }

</script>

<!--<script type="text/javascript">
   function noasignados()
    { 
        var idbus = <?php /*echo $bus['id_bus'];*/ ?>;
//        alert(idbus);
//        exit;
        
        if(idbus > 0){
            
            
            document.getElementById('no_asignados').style.display = 'none';
        }
        if(idbus == "0"){
        
            document.getElementById('no_asignados').style.display = ''; 
        }
       

    }

</script> -->


<script type="text/javascript">

    $(window).load(function () {
       
        comprobarScreen();
        
        document.getElementById('conductor1').value = "<?php echo $conductor_bus1; ?>";
        document.getElementById('conductor2').value = "<?php echo $conductor_bus2; ?>";
        document.getElementById('conductor3').value = "<?php echo $conductor_bus3; ?>";
        document.getElementById('conductor4').value = "<?php echo $conductor_bus4; ?>";
        document.getElementById('conductor5').value = "<?php echo $conductor_bus5; ?>";
       
//        noasignados();

        
    });

</script> 
<script type="text/javascript">
    $(document).ready(function (e) {
        
        var d = $('#datagrid').get(0).scrollTop = 100;   

    });
   

    function combo()
    {

        $(document).ready(function () {
            // Así accedemos al Texto de la opción seleccionada
            //var valor = $("#drivers2<?php /*echo $i; */?> option:selected").html();
            //alert(valor);

//           conductor.value= valor;
            //document.getElementById('conductor').value = valor;


            var valor = $("#drivers21 option:selected").html();
            var valor2 = $("#drivers22 option:selected").html();
            var valor3 = $("#drivers23 option:selected").html();
            var valor4 = $("#drivers24 option:selected").html();
            var valor5 = $("#drivers25 option:selected").html();

            document.getElementById('conductor1').value = valor;
            document.getElementById('conductor2').value = valor2;
            document.getElementById('conductor3').value = valor3;
            document.getElementById('conductor4').value = valor4;
            document.getElementById('conductor5').value = valor5;
          

        });

    }

    function post()
    {
         //alert("Trabajando");
        // var conductor = document.getElementById('conductor').value;
        var conductor = $('#conductor').val();
        var dataString = conductor;

        var url_driver = "<?php echo $data['rootUrl']; ?>driver/ajax";
        // var url_driver ="index.php/TripsController/pdf/";
        $.ajax({
            methodType: 'POST',
            url: url_driver,
            data: dataString,
            cache: false,
            success: function (html) {
                $('#result').html(html);
                alert("Enviado:" + conductor);
            }
        });
        return false;
    }

    function selecionar(id) {
        selectcionar2(id);

    }
    function random_color()
    {
        return "#" + ("000" + (Math.random() * (1 << 24) | 0).toString(16)).substr(-6)

    }
    function selectcionar2(id) {
        var reserva = id.substring(3);
        var row = 0
        var estado = document.getElementById('r_' + reserva).value;
        var color;
        if (estado == 0) {
            document.getElementById('r_' + reserva).value = 1;
            color = '#09F';
            //document.getElementById(id).className = 'selected';
        } else {
            document.getElementById('r_' + reserva).value = 0;
            if (row == 0) {
                color = '#F8F8F8';
            } else {
                color = '#FFF';
            }
        }
        cambiarbg(id, color, 300);

    }

    $('button').click(function () {
        var id = $(this).val();
        var id2 = $(this).get(0).name;
        var accion = id2.substring(0, 3);

        if (accion == 'add') {
            agregar(id);
        } else {
            var accion = id2.substring(0, 6);
            if (accion == 'delete') {
                alert('Eliminar' + id);
            } else {
                alert('Accion no valida' + id);
            }
        }
    });

    function agregar(bus) {
        var num = document.getElementsByName('reserves').length;
        var string = '';
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('reserves').item(i).value == 1) {
                var idr = document.getElementsByName('reserves').item(i).id;
                idr = idr.substring(2, idr.length);
                string = string + idr + '-';
            }
        }
        var r_string = string.substring(0, string.length - 1);
        $("#cargarBus").load('<?php echo $data['rootUrl']; ?>admin/trips/reserves-bus-add/' + bus + '/' + r_string);
    }

    function cambiar(reserva, bus) {
        var contenido = '#row' + reserva;
        var destino = '#tb_' + bus;
        $(contenido).appendTo(destino);
    }

    function bg_tr(bus) {
        var num = $('#table_' + bus + ' >tbody >tr').length;
        var r = 0;
        for (var i = 0; i < num; i++) {
            var d = $('#table_' + bus + ' >tbody >tr').get(i);
            $('#td-' + d.id).html((i + 1) + '');
            d.className = 'row' + r;
            r = 1 - r;
            if (r == 0) {
                color = '#F8F8F8';
            } else {
                color = '#FFF';
            }
            cambiarbg(d.id, color, 2000);
        }
    }

    function cambiarbg(id, color, tiempo) {
        $('#' + id).animate({
            'background-color': color
        }, tiempo);
    }
    function ordenar(bus, c_order) {
        var criterio = $('#cOrder' + bus).val();
        var estado = $('#estadoOrder' + bus).val();
        var invertir = 0;
        if (criterio == c_order && estado == 0) {
            $('#estadoOrder' + bus).val('1');
            invertir = 1;
        } else {
            $('#estadoOrder' + bus).val('0');
        }
        $('#cOrder' + bus).val(c_order);
        $("#cargarBus").load('<?php echo $data['rootUrl']; ?>admin/trips/reserves-bus-order/' + bus + '/' + c_order + '/' + invertir);
    }

    function pdf(id_bus) {

        //pasamos variable id_bus a caja de texto idfbus
        
        $('#idfbus').val(id_bus);   
        
        var bus1 = $('#buse1').val();
        var bus2 = $('#buse2').val();
        var bus3 = $('#buse3').val();
        var bus4 = $('#buse4').val();
        var bus5 = $('#buse5').val();        
        
        var conductor1 = "<?php echo $conductor_bus1; ?> ";
        var conductor2 = "<?php echo $conductor_bus2; ?> ";
        var conductor3 = "<?php echo $conductor_bus3; ?> ";
        var conductor4 = "<?php echo $conductor_bus4; ?> ";
        var conductor5 = "<?php echo $conductor_bus5; ?> ";  
        
        var id_bus =  $('#idfbus').val();
        
        if(bus1 == ''){            
            $('#buse1').val(0);
        }
        
        if(bus2 == ''){
            $('#buse2').val(0);
        }
        
        if(bus3 == ''){
            $('#buse3').val(0);
           
        }
       
        if(bus4 == ''){
            $('#buse4').val(0);
        }
        
        if(bus5 == ''){
            $('#buse5').val(0);
        }
        
               
        if(id_bus == bus1){            
                       
              var conductor = $('#conductor1').val();
              var capacidad = "<?php echo $capacidad1; ?>";
              var tipo = "<?php echo $tipo; ?>";
              var vehiculo = 1;
              
              document.getElementById('dw'+bus1).style.display = '';
              document.getElementById('dw'+bus1).style.color = '#a300e3';
              document.getElementById('dw'+bus1).title = 'Downloading...';
              
              document.getElementById('conductor1').style.background = '#a300e3'; 
              document.getElementById('conductor1').style.color = '#fff';
              
              setTimeout(function () {

                        document.getElementById('dw'+bus1).style.display = 'none';
                        document.getElementById('dw'+bus1).style.color = 'transparent';
                        document.getElementById('conductor1').style.background = '#fff'; 
                        document.getElementById('conductor1').style.color = '#000';

              }, 5000);
              
        }
        
        if(id_bus == bus2){            
                       
            var conductor = $('#conductor2').val();
            var capacidad = "<?php echo $capacidad2; ?>";
            var tipo = "<?php echo $tipo; ?>";
            var vehiculo = 2;
              
            document.getElementById('dw'+bus2).style.display = '';
            document.getElementById('dw'+bus2).style.color = '#0089ff';
            document.getElementById('dw'+bus2).title = 'Downloading...';
              
            document.getElementById('conductor2').style.background = '#0089ff'; 
            document.getElementById('conductor2').style.color = '#fff';
            
            setTimeout(function () {

                        document.getElementById('dw'+bus2).style.display = 'none';
                        document.getElementById('dw'+bus2).style.color = 'transparent';
                        document.getElementById('conductor2').style.background = '#fff'; 
                        document.getElementById('conductor2').style.color = '#000';

            }, 5000);

            
        }
        
        if(id_bus == bus3){            
                       
            var conductor = $('#conductor3').val(); 
            var capacidad = "<?php echo $capacidad3; ?>";
            var tipo = "<?php echo $tipo; ?>";
            var vehiculo = 3;
            
            document.getElementById('dw'+bus3).style.display = '';
            document.getElementById('dw'+bus3).style.color = '#ff0000';
            document.getElementById('dw'+bus3).title = 'Downloading...';
            
            document.getElementById('conductor3').style.background = '#ff0000'; 
            document.getElementById('conductor3').style.color = '#fff';
            
            setTimeout(function () {

                        document.getElementById('dw'+bus3).style.display = 'none';
                        document.getElementById('dw'+bus3).style.color = 'transparent';
                        document.getElementById('conductor3').style.background = '#fff'; 
                        document.getElementById('conductor3').style.color = '#000';

            }, 5000);
                      
            
        }
        
        if(id_bus == bus4){            
                       
            var conductor = $('#conductor4').val();
            var capacidad = "<?php echo $capacidad4; ?>";
            var tipo = "<?php echo $tipo; ?>";
            var vehiculo = 4;
            
            document.getElementById('dw'+bus4).style.display = '';
            document.getElementById('dw'+bus4).style.color = '#009624';
            document.getElementById('dw'+bus4).title = 'Downloading...';
            
            document.getElementById('conductor4').style.background = '#009624'; 
            document.getElementById('conductor4').style.color = '#fff';
            
            setTimeout(function () {

                        document.getElementById('dw'+bus4).style.display = 'none';
                        document.getElementById('dw'+bus4).style.color = 'transparent';
                        document.getElementById('conductor4').style.background = '#fff'; 
                        document.getElementById('conductor4').style.color = '#000';

            }, 5000);
                       
        }
        
        if(id_bus == bus5){            
                       
            var conductor = $('#conductor5').val(); 
            var capacidad = "<?php echo $capacidad5; ?>";
            var tipo = "<?php echo $tipo; ?>";
            var vehiculo = 5;
            
            document.getElementById('dw'+bus5).style.display = '';
            document.getElementById('dw'+bus5).style.color = '#ff8c00';
            document.getElementById('dw'+bus5).title = 'Downloading...';
            
            document.getElementById('conductor5').style.background = '#ff8c00';
            document.getElementById('conductor5').style.color = '#fff';
            
            setTimeout(function () {

                document.getElementById('dw'+bus5).style.display = 'none';
                document.getElementById('dw'+bus5).style.color = 'transparent';
                document.getElementById('conductor5').style.background = '#fff'; 
                document.getElementById('conductor5').style.color = '#000';

            }, 5000);
            
        }



        var trip = $("#trip").val();
        var fecha = '<?php echo $data['fecha']; ?>';
        if ($("#cOrder_pick" + id_bus).is(':checked')) {
            var Order = 1;
        } else {
            var Order = 2;
        }
//                 if($("#agency_"+id_bus).is(':checked')){
//			var agency = 1;
//		 }else{
//			var agency = 2;
//		 }

        //alert(conductor);
        var agency = $("#agency_" + id_bus).val();
        var url = "<?php echo $data['rootUrl']; ?>admin/trips/passengers/bus/list/" + id_bus + "/" + trip + "/" + fecha + "/" + Order + "/" + agency + "/" + conductor +  "/" + capacidad + "/" + tipo + "/" + vehiculo;
        location.href = url;
    }


    $('#btn-save').click(function () {
        if ($('#opcionGuardarPasajero').val() != '') {
            alert($('#opcionGuardarPasajero').val())
        } else {
            $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function () {
<?php if ($data['cancel'] == -1) { ?>
            var url = '<?php echo $data['rootUrl']; ?>admin/trips/passengers/bus';
<?php } else { ?>
            var url = '<?php echo $data['rootUrl']; ?>admin/trips/passengers';
<?php } ?>
        $("#form1").attr("action", url);
        $('#form1').submit();
    });
    
    


</script>

<script>

        var z
        function capturar()
        {
            var resultado = "ninguno";

            var porNombre = document.getElementsByName("bus");
            // Recorremos todos los valores del radio button para encontrar el
            // seleccionado
            for (var i = 0; i < porNombre.length; i++)
            {
                if (porNombre[i].checked)
                    resultado = porNombre[i].value;

            }


            z = document.getElementById("resultado").innerHTML = " \ " + resultado;

            if(z == 1){                
                                 
                  var bus = "<?php echo $bus['id_bus']; ?>";
                  
                  document.getElementById('conductor1').style.background = '#a300e3'; 
                  document.getElementById('conductor1').style.color = '#fff';
                  document.getElementById('conductor2').style.background = '#fff';
                  document.getElementById('conductor2').style.color = '#000';
                  document.getElementById('conductor3').style.background = '#fff';
                  document.getElementById('conductor3').style.color = '#000';
                  document.getElementById('conductor4').style.background = '#fff';
                  document.getElementById('conductor4').style.color = '#000';
                  document.getElementById('conductor5').style.background = '#fff';
                  document.getElementById('conductor5').style.color = '#000';
//                  document.getElementById('<?php /*echo $bus['id_bus']; */?>').style.display = '';
                  document.getElementById('<?php echo $bus['id_bus']; ?>').style.display = '';
                  
                  
            }
            
            if(z == 2){
                
                    document.getElementById('conductor1').style.background = '#fff'; 
                    document.getElementById('conductor1').style.color = '#000'; 
                    document.getElementById('conductor2').style.background = '#0089ff'; 
                    document.getElementById('conductor2').style.color = '#fff';
                    document.getElementById('conductor3').style.background = '#fff'; 
                    document.getElementById('conductor3').style.color = '#000';
                    document.getElementById('conductor4').style.background = '#fff'; 
                    document.getElementById('conductor4').style.color = '#000';
                    document.getElementById('conductor5').style.background = '#fff'; 
                    document.getElementById('conductor5').style.color = '#000';
//                    document.getElementById('<?php /*echo $bus['id_bus'];*/ ?>').style.display = '';
                    document.getElementById('<?php echo $bus['id_bus']; ?>').style.display = '';
            }

            if(z == 3){
                    
                    document.getElementById('conductor1').style.background = '#fff'; 
                    document.getElementById('conductor1').style.color = '#000';
                    document.getElementById('conductor2').style.background = '#fff'; 
                    document.getElementById('conductor2').style.color = '#000';
                    document.getElementById('conductor3').style.background = '#ff0000'; 
                    document.getElementById('conductor3').style.color = '#fff';
                    document.getElementById('conductor4').style.background = '#fff'; 
                    document.getElementById('conductor4').style.color = '#000';
                    document.getElementById('conductor5').style.background = '#fff'; 
                    document.getElementById('conductor5').style.color = '#000';
//                    document.getElementById('<?php /*echo $bus['id_bus'];*/ ?>').style.display = '';
                    document.getElementById('<?php echo $bus['id_bus']; ?>').style.display = '';
            }
            
            if(z == 4){
                    
                    document.getElementById('conductor1').style.background = '#fff'; 
                    document.getElementById('conductor1').style.color = '#000';
                    document.getElementById('conductor2').style.background = '#fff';
                    document.getElementById('conductor2').style.color = '#000';
                    document.getElementById('conductor3').style.background = '#fff';
                    document.getElementById('conductor3').style.color = '#fff';
                    document.getElementById('conductor4').style.background = '#009624'; 
                    document.getElementById('conductor4').style.color = '#fff';
                    document.getElementById('conductor5').style.background = '#fff';
                    document.getElementById('conductor5').style.color = '#000';
//                    document.getElementById('<?php /*echo $bus['id_bus'];*/ ?>').style.display = '';
                    document.getElementById('<?php echo $bus['id_bus']; ?>').style.display = '';
            }
            
            if(z == 5){
                
                    document.getElementById('conductor1').style.background = '#fff'; 
                    document.getElementById('conductor1').style.color = '#000';
                    document.getElementById('conductor2').style.background = '#fff'; 
                    document.getElementById('conductor2').style.color = '#000';
                    document.getElementById('conductor3').style.background = '#fff';
                    document.getElementById('conductor3').style.color = '#000';
                    document.getElementById('conductor4').style.background = '#fff';
                    document.getElementById('conductor4').style.color = '#000';                    
                    document.getElementById('conductor5').style.background = '#ff8c00';
                    document.getElementById('conductor5').style.color = '#fff';
//                    document.getElementById('<?php /*echo $bus['id_bus'];*/ ?>').style.display = '';
                    document.getElementById('<?php echo $bus['id_bus']; ?>').style.display = '';
            }



        }
    </script>



