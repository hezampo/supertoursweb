<?php
if (isset($this->data['reserve']) && isset($_SESSION['login'])) {
    $valida = false;
    $reserva = $data['reserve'];
    $subto = $data['subto'];
    $rastro = $data['rastro'];
    $pagado = $data['pagado'];
    //print($pagado);
    $pagado_sinCargo = ($pagado / 1.04);
    //cargo al pago con credit card
    $CargoCC = $pagado - $pagado_sinCargo;
    //echo $CargoCC;

    $btnpay = $reserva->Btnpay;
    
    $adultos = $reserva->pax;
    $peques = $reserva->pax2;
    
    $total_pasajeros = $adultos + $peques;
    
    $trip_no = $reserva->trip_no;
    $trip_no2 = $reserva->trip_no2;
    
    $fecha_crea = $reserva->fecha_ini;
    $residente = $reserva->resident;
    //echo $fecha_crea;
    
    $subtoadult1 = $reserva->precio_trip1_a;     
    $subtochild1 = $reserva->precio_trip1_c;
    
    $exten1a = $reserva->precio_exten1_a;
    $exten1c = $reserva->precio_exten1_c;
    
    $exten3a = $reserva->precio_exten3_a;
    $exten3c = $reserva->precio_exten3_c;
    $extension1 = $reserva->extension1;
    $extension2 = $reserva->extension2;
    
    $fec_salida = $reserva->fecha_salida;
    
    
    $fecha_salida_ns = $reserva->fecha_salida_ns;
    
//    list ($mes, $dia, $anyo) = explode("-", $fecha_salida_ns1);
//    $fecha_salida_ns =  $mes . "-" . $dia . "-" . $anyo ;
//    print($fecha_salida_ns);
//    
    
    $subtoadult2 = $reserva->precio_trip2_a;     
    $subtochild2 = $reserva->precio_trip2_c;
    
    $exten2a = $reserva->precio_exten2_a;
    $exten2c = $reserva->precio_exten2_c;
    
    
    $extension3 = $reserva->extension3;
    $extension4 = $reserva->extension4;
    $exten4a = $reserva->precio_exten4_a;
    $exten4c = $reserva->precio_exten4_c;
    
    $fec_retorno = $reserva->fecha_retorno;
    $fecha_retorno_ns = $reserva->fecha_retorno_ns;
    
    
    $tarif_round = $reserva->tarifa_round;
    $tarif_one = $reserva->tarifa_one;
    
    //print($btnpay);
//    $pago =  $data['pago'];
//    print($pago);
    $cliente = $data['cliente'];
    $cliente_apto = $data['cliente_apto'];
    $pickup1 = $data['pickup1'];
    $pickup2 = $data['pickup2'];
    $drop1 = $data['drop1'];
    $drop2 = $data['drop2'];
    $extencion1 = $data['extencion1'];
    $extencion2 = $data['extencion2'];
    $extencion4 = $data['extencion4'];
    $extencion3 = $data['extencion3'];
    $agencia = $data['agencia'];
    $disponible = $this->data['disponible'];
    $agen_account = $data['agen_account'];
    $reserva_a = $data['reserver_a'];
    $userA = $data['userA'];
    $area = $data['areas'];
    $extenFrom1 = $data['extenFrom1'];
    $extenTo1 = $data['extenTo1'];
    $extenFrom2 = $data['extenFrom2'];
    $extenTo2 = $data['extenTo2'];
    $to_areas = $data['to_areas'];
    $to_areas2 = $data['to_areas2'];
    $dato_pago = $reserva->pago;
    
    $canal = $reserva->canal;
    //echo $canal;
    
    $var = explode('-', $dato_pago);
    $typo_pago = strtoupper($var[0]);
    if (isset($var[1])) {
        $typo_saldo = $var[1];
        $rest_comision = 0;
    } else {
        $typo_saldo = 'FULL';
        $rest_comision = isset($reserva_a->agency_fee) ? $reserva_a->agency_fee : 0;
    }



    $url1 = $data['rootUrl'] . $ruta . $reserva->id;


    $precio_extension_adultos = ($reserva->precio_exten1_a + $reserva->precio_exten2_a + $reserva->precio_exten3_a + $reserva->precio_exten4_a);
    $precio_trips_adultos = $reserva->precio_trip1_a + $reserva->precio_trip2_a;
    $subtoadult = ($precio_trips_adultos * $reserva->pax) + ($precio_extension_adultos * $reserva->pax);

    $precio_extension_children = ($reserva->precio_exten1_c + $reserva->precio_exten2_c + $reserva->precio_exten3_c + $reserva->precio_exten4_c);
    $precio_trips_children = $reserva->precio_trip1_c + $reserva->precio_trip2_c;
    $subtochild = ( $precio_trips_children * $reserva->pax2) + ($precio_extension_children * $reserva->pax2);

    $transporadult = $precio_trips_adultos;
    if ($reserva->pax2 != 0) {
        $transporechil = $precio_trips_children;
    } else {
        $transporechil = 0;
    }
    $precioExt = $precio_extension_adultos;

    $totaltotal = ($subtoadult) + ($subtochild) + $reserva->extra_charge - $rest_comision - $val_procentaje - $reserva->descuento_valor;

    //actualizacion de nuevas variables para capturar datos almacenados en la tabla reservas de la base de datos
    //$total2 = $reserva->totaltotal;
    $total2 = $reserva->total2;

    $paid_driver = $reserva->paid_driver;
    
    $op_pago_conductor = $reserva->op_pago_conductor;
    $pred_paid_amount = $reserva->pred_paid_amount;
    $total_paid = $reserva->total_paid;
    $totaltotalfull = $reserva->totaltotal;
    $passenger_balance_due = $reserva->passenger_balance_due;
    //print($passenger_balance_due);   

    $agency_balance_due = $reserva->agency_balance_due;
    $total_charge = $reserva->total_charge;    
    $pay_amount = $reserva->pay_amount;  
    
    
    
    $fecha_hoy = date("Y-m-d");
    $dias= 1; // los días a restar 
    $fecha_ayer =  date("Y-m-d", strtotime("$fecha_hoy - $dias day"));  
    Doo::db()->query("DELETE FROM  reservas_trip_puestos WHERE fecha_trip <= '$fecha_ayer'");



    $sql1 = "SELECT SUM(FLOOR(pagado)) AS PAGPRED FROM reservas_pago WHERE id_reserva=$reserva->id AND pago = 'PRED-PAID'";
    $rs1 = Doo::db()->query($sql1);
    $pagosprep = $rs1->fetchAll();


    foreach ($pagosprep as $ppr) {

    }
    
    $pago_prepaid = ($ppr['PAGPRED']) * 0.04;


    
    /*FLOOR (REDONDEA) PCCWF (PAGOS CON CREDIT CARD WITH FEE)*/
    $sql2 = "SELECT SUM(pagado) AS PCCWF FROM reservas_pago WHERE id_reserva=$reserva->id AND tipo_pago='CREDIT CARD WITH FEE' AND pago='COLLECT ON BOARD'";
    $rs2 = Doo::db()->query($sql2);
    $pagosccwf = $rs2->fetchAll();

//                    print($pagosprep);
    foreach ($pagosccwf as $pccwf) {
//                        print($ppr['PAGPRED']);
    }
    $pago_ccwf = $pccwf['PCCWF']; 
    $pago_sinccwf = ($pccwf['PCCWF']) / 1.04;
    $cargos1 = $pago_ccwf - $pago_sinccwf;
    $cargos = number_format($cargos1, 2, '.', '');
    
    
     /*FLOOR (REDONDEA) PCCWF (PAGOS CON CREDIT CARD WITH FEE)*/
    $sql3 = "SELECT SUM(pagado) AS PPPCCWF FROM reservas_pago WHERE id_reserva=$reserva->id AND tipo_pago='CREDIT CARD WITH FEE' AND pago='PRED-PAID'";
    $rs3 = Doo::db()->query($sql3);
    $pagosprepaidccwf = $rs3->fetchAll();

//                    print($pagosprep);
    foreach ($pagosprepaidccwf as $pppccwf) {
//                        print($ppr['PAGPRED']);
    }
    $pagopp_ccwf = $pppccwf['PPPCCWF']; 
    $pagopp_sinccwf = ($pppccwf['PPPCCWF']) / 1.04;
    $cargospp1 = $pagopp_ccwf - $pagopp_sinccwf;
    $cargospp = number_format($cargospp1, 2, '.', '');
    
    //print($cargos);
    
    $idagencia = $agencia->id;
    //print($idagencia);
    $sql4 = "SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days FROM agency_account WHERE id_agencia = '$idagencia' ";
    $rs4 = Doo::db()->query($sql4);
    $opcion = $rs4->fetchAll();


    foreach ($opcion as $opc) {

    }
    $voucher = $opc['opcion5']; 
   
    
    
    $descuento = $reserva->descuento_procentaje;

    $val_procentaje = 0;
    if ($descuento > 0) {
        $val_procentaje = ($totaltotal * $descuento) / 100;
    }
    //actualizacion
    $fee = 0;
    //$totaltotal = $totaltotal + $fee;
    //actualizacion
    //$totaltotal = $total2 + $fee;

    $totaltotal = $totaltotal + $fee;


    //print_r($totaltotal);
    //conf Other Amount
    if ($reserva->otheramount != 0) {
        $saldoxPagar = $reserva->otheramount - $pagado;
    } else {
        $saldoxPagar = $totaltotal - $pagado;

        // $saldoxPagar = $totaltotal - $total_charge;
        //$saldoxPagar = $totaltotal;
        //print($saldoxPagar);
    }

    if ($reserva->pred_paid_amount != 0) {
        $saldoPago = $reserva->pred_paid_amount - $totaltotal;
        //print($saldoPago);
    }

    $adaptacion = "";
    if ($extencion1->id != 0) {
        $adaptacion .= "$('#pickup1').attr('disabled','true');";
        $adaptacion .= "$('#pickup1').attr('value','');";
        $adaptacion .= "$('#id_p1').attr('value','');";
        $precio = ($agencia->type_rate == 0) ? $extencion1->precio : $extencion1->precio_neto;
        $_SESSION['price']['exten1'] = $precio;
    }
    if ($extencion2->id != 0) {

        $adaptacion .= "$('#dropoff1').attr('disabled','true');";
        $adaptacion .= "$('#dropoff1').attr('value','');";
        $adaptacion .= "$('#id_dropoff1').attr('value','');";
        $precio = ($agencia->type_rate == 0) ? $extencion2->precio : $extencion2->precio_neto;
        $_SESSION['price']['exten2'] = $precio;
    }
    if ($extencion3->id != 0) {
        $adaptacion .= "$('#pickup2').attr('disabled','true');";
        $adaptacion .= "$('#pickup2').attr('value','');";
        $adaptacion .= "$('#id_p2').attr('value','');";
        $precio = ($agencia->type_rate == 0) ? $extencion3->precio : $extencion3->precio_neto;
        $_SESSION['price']['exten3'] = $precio;
    }
    if ($extencion4->id != 0) {
        $adaptacion .= "$('#dropoff2').attr('disabled','true');";
        $adaptacion .= "$('#dropoff2').attr('value','');";
        $adaptacion .= "$('#id_dropoff2').attr('value','');";
        $precio = ($agencia->type_rate == 0) ? $extencion4->precio : $extencion4->precio_neto;
        $_SESSION['price']['exten4'] = $precio;
    }
} else {
    echo 'Acceso denegado';
    exit();
}
$login = $_SESSION['login'];
?>


<!-- Estilos y importaciones de javascript-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<link rel="stylesheet" href="//resources/demos/style.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>


<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
<script type = "text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js" ></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
<script type="text/javascript"   src="<?php echo $data['rootUrl']; ?>global/ui/jquery.ui.dialog.js"></script>


<style type="text/css" media="screen">
    #search{
        cursor:pointer;
    }
    #reservation{
        width:300px !important;
    }
    #offer {
        position: absolute;
        margin-left: 10px;
        margin-top: 5px;
    }
    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 0px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        padding: 8px;
        width: 98.4%;
        float: left;
        clear: both;
        border-radius: 20px;

    }

    #selector {
        -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
        box-shadow:inset 0px 1px 0px 0px #ffffff;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
        background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
        background-color:#ededed;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        border:1px solid #dcdcdc;
        display:inline-block;
        color:#777777;
        font-family:arial;
        font-size:11px;
        font-weight:bold;
        padding:6px;
        text-decoration:none;
        text-shadow:1px 1px 0px #ffffff;
    }
    .selector:hover {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
        background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
        background-color:#dfdfdf;
        cursor:pointer;
    }
    .selector:active {
        position:relative;
        top:1px;
    }
    #selectos{
        padding:0;
        margin:0;
    }
    input[type="radio"]{
        height: 15px;
        width: 15px;
    }

    .background {
        background: rgba(212,228,239,1);
        background: -moz-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(212,228,239,1)), color-stop(100%, rgba(134,174,204,1)));
        background: -webkit-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: -o-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: -ms-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: linear-gradient(135deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#86aecc', GradientType=1 );

    }
    .rojo{
        /* IE10+ */ 
        background-image: -ms-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* Mozilla Firefox */ 
        background-image: -moz-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* Opera */ 
        background-image: -o-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* Webkit (Safari/Chrome 10) */ 
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #260505), color-stop(75.5, #AC1B29), color-stop(100, #FFC7C7));

        /* Webkit (Chrome 11+) */ 
        background-image: -webkit-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* W3C Markup */ 
        background-image: linear-gradient(to top right, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%); 
    }
/*    .cerati{
         IE10+  
        background-image: -ms-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         Mozilla Firefox  
        background-image: -moz-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         Opera  
        background-image: -o-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         Webkit (Safari/Chrome 10)  
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #1E4D82), color-stop(51, #33449C), color-stop(75.5, #1B1478), color-stop(100, #E1E0FF));

         Webkit (Chrome 11+)  
        background-image: -webkit-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         W3C Markup  
        background-image: linear-gradient(to top right, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);
    }*/
    
    .cerati{
               /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+20,2989d8+50,1e5799+80&0+0,0.8+15,1+19,1+81,0.8+85,0+100 */
        background: -moz-linear-gradient(45deg, rgba(30,87,153,0) 0%, rgba(30,87,153,0.8) 15%, rgba(30,87,153,1) 19%, rgba(30,87,153,1) 20%, rgba(41,137,216,1) 50%, rgba(30,87,153,1) 80%, rgba(30,87,153,1) 81%, rgba(30,87,153,0.8) 85%, rgba(30,87,153,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(45deg, rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(45deg, rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001e5799', endColorstr='#001e5799',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }
    
    .pass{
        
        background: #02111D;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to top, #02111D, #037BB5, #02111D);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to top, #02111D, #037BB5, #02111D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

/*    .super{
         Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+29,0751b2+78 
        background: rgb(197,222,234);  Old browsers 
        background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 29%, rgba(7,81,178,1) 78%);  FF3.6-15 
        background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%);  Chrome10-25,Safari5.1-6 
        background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%);  W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ 
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#0751b2',GradientType=0 );  IE6-9 

    }*/

    .super{
        background: #076585;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to bottom, #fff, #076585);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to bottom, #fff, #076585); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


    }
    
    .black{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7d7e7d+0,0e0e0e+100;Black+3D */
        background: rgb(125,126,125); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(125,126,125,1) 0%, rgba(14,14,14,1) 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#0e0e0e',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }

    .gris{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+0,000000+100&0.65+0,0+100;Neutral+Density */
        background: -moz-linear-gradient(-45deg,  rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(-45deg,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(135deg,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }
    .azul{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+20,2989d8+50,1e5799+80&0+0,0.8+15,1+19,1+81,0.8+85,0+100;Blue+Two+Sided+Transparent */
        background: -moz-linear-gradient(top,  rgba(30,87,153,0) 0%, rgba(30,87,153,0.8) 15%, rgba(30,87,153,1) 19%, rgba(30,87,153,1) 20%, rgba(41,137,216,1) 50%, rgba(30,87,153,1) 80%, rgba(30,87,153,1) 81%, rgba(30,87,153,0.8) 85%, rgba(30,87,153,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001e5799', endColorstr='#001e5799',GradientType=0 ); /* IE6-9 */

    }

    .verde{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d8e0de+0,aebfbc+22,99afab+33,8ea6a2+50,829d98+67,4e5c5a+82,0e0e0e+100;Grey+3D */
        background: rgb(216,224,222); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(216,224,222,1) 0%, rgba(174,191,188,1) 22%, rgba(153,175,171,1) 33%, rgba(142,166,162,1) 50%, rgba(130,157,152,1) 67%, rgba(78,92,90,1) 82%, rgba(14,14,14,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d8e0de', endColorstr='#0e0e0e',GradientType=0 ); /* IE6-9 */

    }

    .gris2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f5f6f6+0,dbdce2+21,b8bac6+49,dddfe3+80,f5f6f6+100;Grey+Pipe */
        background: rgb(245,246,246); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(245,246,246,1) 0%, rgba(219,220,226,1) 21%, rgba(184,186,198,1) 49%, rgba(221,223,227,1) 80%, rgba(245,246,246,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(245,246,246,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(245,246,246,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(245,246,246,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(245,246,246,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f5f6f6', endColorstr='#f5f6f6',GradientType=0 ); /* IE6-9 */

    }

    .brown{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f3e2c7+0,c19e67+50,b68d4c+51,e9d4b3+100;L+Brown+3D */
        background: rgb(243,226,199); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(243,226,199,1) 0%, rgba(193,158,103,1) 50%, rgba(182,141,76,1) 51%, rgba(233,212,179,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(243,226,199,1) 0%,rgba(193,158,103,1) 50%,rgba(182,141,76,1) 51%,rgba(233,212,179,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(243,226,199,1) 0%,rgba(193,158,103,1) 50%,rgba(182,141,76,1) 51%,rgba(233,212,179,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f3e2c7', endColorstr='#e9d4b3',GradientType=0 ); /* IE6-9 */

    }

    .sky{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7db9e8+66,1e5799+100&0.39+58,1+92 */
        background: -moz-linear-gradient(top,  rgba(125,185,232,0.39) 58%, rgba(125,185,232,0.53) 66%, rgba(52,110,172,1) 92%, rgba(30,87,153,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(125,185,232,0.39) 58%,rgba(125,185,232,0.53) 66%,rgba(52,110,172,1) 92%,rgba(30,87,153,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(125,185,232,0.39) 58%,rgba(125,185,232,0.53) 66%,rgba(52,110,172,1) 92%,rgba(30,87,153,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#637db9e8', endColorstr='#1e5799',GradientType=0 ); /* IE6-9 */

    }

    .orangered{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e5361b+20,ed9017+95 */
        background: rgb(229,54,27); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(229,54,27,1) 20%, rgba(237,144,23,1) 95%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5361b', endColorstr='#ed9017',GradientType=0 ); /* IE6-9 */

    }

    .redop{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#cd615b+44,cd615b+44,cd615b+60,cd615b+72,cd615b+72,cd615b+75,cd615b+75,cd615b+96,cd615b+96&1+0,0.39+78 */
        background: -moz-linear-gradient(top,  rgba(205,97,91,1) 0%, rgba(205,97,91,0.66) 44%, rgba(205,97,91,0.53) 60%, rgba(205,97,91,0.44) 72%, rgba(205,97,91,0.42) 75%, rgba(205,97,91,0.39) 78%, rgba(205,97,91,0.39) 96%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(205,97,91,1) 0%,rgba(205,97,91,0.66) 44%,rgba(205,97,91,0.53) 60%,rgba(205,97,91,0.44) 72%,rgba(205,97,91,0.42) 75%,rgba(205,97,91,0.39) 78%,rgba(205,97,91,0.39) 96%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(205,97,91,1) 0%,rgba(205,97,91,0.66) 44%,rgba(205,97,91,0.53) 60%,rgba(205,97,91,0.44) 72%,rgba(205,97,91,0.42) 75%,rgba(205,97,91,0.39) 78%,rgba(205,97,91,0.39) 96%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cd615b', endColorstr='#63cd615b',GradientType=0 ); /* IE6-9 */

    }

    .oliva{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fcfff5+0,e0f0cc+40,abdb91+100 */
        background: rgb(252,255,245); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(252,255,245,1) 0%, rgba(224,240,204,1) 40%, rgba(171,219,145,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(252,255,245,1) 0%,rgba(224,240,204,1) 40%,rgba(171,219,145,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(252,255,245,1) 0%,rgba(224,240,204,1) 40%,rgba(171,219,145,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff5', endColorstr='#abdb91',GradientType=0 ); /* IE6-9 */

    }

    .oliva2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#dbe3e5+0,6993a1+81 */
        background: rgb(219,227,229); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(219,227,229,1) 0%, rgba(105,147,161,1) 81%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(219,227,229,1) 0%,rgba(105,147,161,1) 81%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(219,227,229,1) 0%,rgba(105,147,161,1) 81%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dbe3e5', endColorstr='#6993a1',GradientType=0 ); /* IE6-9 */

    }

    .oliveti{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f2f6f8+0,d8e1e7+50,b5c6d0+82,e0eff9+100 */
        background: rgb(242,246,248); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 82%, rgba(224,239,249,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */

    }

    .brown2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6dfb8+47,f6dfb8+76,e1ac51+94 */
        background: rgb(246,223,184); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(246,223,184,1) 47%, rgba(246,223,184,1) 76%, rgba(225,172,81,1) 94%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(246,223,184,1) 47%,rgba(246,223,184,1) 76%,rgba(225,172,81,1) 94%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(246,223,184,1) 47%,rgba(246,223,184,1) 76%,rgba(225,172,81,1) 94%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6dfb8', endColorstr='#e1ac51',GradientType=0 ); /* IE6-9 */

    }

    .brown3{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6cbb8+47,f6cbb8+86,e17c51+94 */
        background: rgb(246,203,184); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(246,203,184,1) 47%, rgba(246,203,184,1) 86%, rgba(225,124,81,1) 94%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(246,203,184,1) 47%,rgba(246,203,184,1) 86%,rgba(225,124,81,1) 94%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(246,203,184,1) 47%,rgba(246,203,184,1) 86%,rgba(225,124,81,1) 94%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6cbb8', endColorstr='#e17c51',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }

    .brown4{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f9e0cb+49,f9e0cb+49,f9e0cb+65,f9e0cb+69,f9e0cb+70,f9e0cb+74,e9b081+86,e9b081+86 */
        background: rgb(249,224,203); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(249,224,203,1) 49%, rgba(249,224,203,1) 49%, rgba(249,224,203,1) 65%, rgba(249,224,203,1) 69%, rgba(249,224,203,1) 70%, rgba(249,224,203,1) 74%, rgba(233,176,129,1) 86%, rgba(233,176,129,1) 86%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(249,224,203,1) 49%,rgba(249,224,203,1) 49%,rgba(249,224,203,1) 65%,rgba(249,224,203,1) 69%,rgba(249,224,203,1) 70%,rgba(249,224,203,1) 74%,rgba(233,176,129,1) 86%,rgba(233,176,129,1) 86%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(249,224,203,1) 49%,rgba(249,224,203,1) 49%,rgba(249,224,203,1) 65%,rgba(249,224,203,1) 69%,rgba(249,224,203,1) 70%,rgba(249,224,203,1) 74%,rgba(233,176,129,1) 86%,rgba(233,176,129,1) 86%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9e0cb', endColorstr='#e9b081',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }

    .verdefosf1{
        background: rgba(230,227,225,0.45);
        background: -moz-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(230,227,225,0.45)), color-stop(25%, rgba(189,226,201,0.45)), color-stop(87%, rgba(86,222,141,0.96)), color-stop(92%, rgba(86,185,173,1)), color-stop(100%, rgba(87,126,224,1)));
        background: -webkit-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: -o-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: -ms-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: linear-gradient(to bottom, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e3e1', endColorstr='#577ee0', GradientType=0 );
    }

    .verdefosf{
        background: rgba(230,227,225,0.45);
        background: -moz-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(230,227,225,0.45)), color-stop(25%, rgba(189,226,222,0.45)), color-stop(53%, rgba(142,224,219,1)), color-stop(87%, rgba(86,222,215,1)), color-stop(100%, rgba(87,126,224,1)));
        background: -webkit-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -o-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -ms-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: linear-gradient(to bottom, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e3e1', endColorstr='#577ee0', GradientType=0 );
    }

    .vinotinto{
        background: rgba(173,0,17,1);
        background: -moz-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(173,0,17,1)), color-stop(44%, rgba(228,196,198,0.97)), color-stop(100%, rgba(0,0,61,0.93)));
        background: -webkit-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: -o-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: -ms-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: linear-gradient(to bottom, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ad0011', endColorstr='#00003d', GradientType=0 );
    }

    .booking2{
        background: rgba(212,214,230,0.28);
        background: -moz-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: -webkit-gradient(left top, left bottom, color-stop(81%, rgba(212,214,230,0.28)), color-stop(89%, rgba(212,214,230,0.6)), color-stop(99%, rgba(210,255,82,1)));
        background: -webkit-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: -o-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: -ms-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: linear-gradient(to bottom, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4d6e6', endColorstr='#d2ff52', GradientType=0 );
    }

    .verde2018{
        background: rgba(100,241,39,1);
        background: -moz-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(100,241,39,1)), color-stop(29%, rgba(74,176,69,1)), color-stop(85%, rgba(74,176,69,1)));
        background: -webkit-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: -o-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: -ms-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: radial-gradient(ellipse at center, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#64f127', endColorstr='#4ab045', GradientType=1 );
    }

    .verde2017{
        background: rgba(14,216,54,1);
        background: -moz-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(14,216,54,1)), color-stop(62%, rgba(51,151,90,1)), color-stop(70%, rgba(56,143,95,0.9)), color-stop(100%, rgba(56,143,95,0.53)));
        background: -webkit-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: -o-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: -ms-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: linear-gradient(to bottom, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0ed836', endColorstr='#388f5f', GradientType=0 );
    }

    .rojo2017{
        background: rgba(196,107,84,1);
        background: -moz-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(196,107,84,1)), color-stop(18%, rgba(196,107,84,0.9)), color-stop(39%, rgba(248,114,84,0.79)), color-stop(51%, rgba(255,47,5,0.72)), color-stop(67%, rgba(250,54,15,0.64)), color-stop(99%, rgba(239,59,31,0.47)), color-stop(100%, rgba(239,59,31,0.46)));
        background: -webkit-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: -o-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: -ms-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: linear-gradient(to bottom, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c46b54', endColorstr='#ef3b1f', GradientType=0 );
    }

    .azul2017{
        background: rgba(0,120,212,1);
        background: -moz-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: -webkit-gradient(left top, left bottom, color-stop(18%, rgba(0,120,212,1)), color-stop(32%, rgba(0,154,250,1)), color-stop(34%, rgba(0,154,250,1)), color-stop(65%, rgba(0,154,250,0.5)));
        background: -webkit-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: -o-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: -ms-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: linear-gradient(to bottom, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0078d4', endColorstr='#009afa', GradientType=0 );
    }

    .redopc{
        background: rgba(167,6,41,1);
        background: -moz-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(167,6,41,1)), color-stop(32%, rgba(167,6,41,0.54)), color-stop(40%, rgba(167,6,41,0.54)), color-stop(44%, rgba(138,5,34,0.54)), color-stop(53%, rgba(105,2,24,0.54)));
        background: -webkit-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: -o-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: -ms-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: linear-gradient(to bottom, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a70629', endColorstr='#690218', GradientType=0 );
    }

    .grad {
        background: red; /* For browsers that do not support gradients */
        background: -webkit-linear-gradient(-90deg, red, yellow); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(-90deg, red, yellow); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(-90deg, red, yellow); /* For Firefox 3.6 to 15 */
        background: linear-gradient(-90deg, red, yellow); /* Standard syntax */
    }

    .angry{
        background: -moz-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #008080), color-stop(25%, #FFFFFF), color-stop(50%, #32898C), color-stop(75%, #FFFFFF), color-stop(100%, #005757)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* ie10+ */
        background: linear-gradient(180deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* w3c */
    }

    .angry2{
        background: -moz-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #0B4A8A), color-stop(83%, #010C17), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* ie10+ */
        background: radial-gradient(ellipse at center, #0B4A8A 0%, #010C17 83%, #000000 100%); /* w3c */
    }

    .angryrad{
        background: -moz-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #003333), color-stop(50%, #05C1FF), color-stop(100%, #003333)); /* safari4+,chrome */
        background: -webkit-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* ie10+ */
        background: radial-gradient(ellipse at center, #003333 0%, #05C1FF 50%, #003333 100%); /* w3c */
    }

    .payment{
        background: -moz-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, right top, color-stop(0%, #0C0680), color-stop(33%, #FFFFFF), color-stop(50%, #0c0680), color-stop(65%, #FFFFFF), color-stop(100%, #0C0680)); /* safari4+,chrome */
        background: -webkit-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ie10+ */
        background: linear-gradient(90deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0C0680', endColorstr='#0C0680',GradientType=1 ); /* ie6-9 */
    }

    .paymentvert{

        background: -moz-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #0C0680), color-stop(35%, #FFFFFF), color-stop(50%, #0c0680), color-stop(67%, #ffffff), color-stop(100%, #0C0680)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ie10+ */
        background: linear-gradient(0deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0C0680', endColorstr='#0C0680',GradientType=0 ); /* ie6-9 */

    }

    .paymentvertblack{
        background: -moz-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #000000), color-stop(35%, #FFFFFF), color-stop(50%, #000000), color-stop(67%, #ffffff), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* ie10+ */
        background: linear-gradient(0deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000',GradientType=0 ); /* ie6-9 */
    }

    .ama{
        background: -moz-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #428CFC), color-stop(78%, #428CFC), color-stop(92%, #29FF50), color-stop(100%, #29FF50)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* ie10+ */
        background: linear-gradient(0deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#428CFC', endColorstr='#29FF50',GradientType=0 ); /* ie6-9 */
    }

    .ama2{
        background: -moz-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFFCD9), color-stop(78%, #FFFCD9), color-stop(92%, #1EFF00), color-stop(100%, #1EFF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ie10+ */
        background: linear-gradient(0deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFCD9', endColorstr='#1EFF00',GradientType=0 ); /* ie6-9 */
    }

    .naran{
        background: -moz-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E3E8FA), color-stop(78%, #E3E8FA), color-stop(92%, #15FF00), color-stop(100%, #15FF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* ie10+ */
        background: linear-gradient(0deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E3E8FA', endColorstr='#15FF00',GradientType=0 ); /* ie6-9 */
    }

    .roge{
        background: -moz-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E3E8FA), color-stop(78%, #E3E8FA), color-stop(92%, #FF0505), color-stop(100%, #FF0505)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ie10+ */
        background: linear-gradient(0deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E3E8FA', endColorstr='#FF0505',GradientType=0 ); /* ie6-9 */
    }

    .verd{
        background: -moz-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #8EDE93), color-stop(78%, #8EDE93), color-stop(92%, #FFFFFF), color-stop(100%, #FFFFFF)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* ie10+ */
        background: linear-gradient(0deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8EDE93', endColorstr='#FFFFFF',GradientType=0 ); /* ie6-9 */
    }

    .azu{
        background: -moz-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #DEEEFA), color-stop(78%, #DEEEFA), color-stop(92%, #F4FF1C), color-stop(100%, #F4FF1C)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* ie10+ */
        background: linear-gradient(0deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#DEEEFA', endColorstr='#F4FF1C',GradientType=0 ); /* ie6-9 */
    }
    .brown3{
        background: -moz-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFDCB5), color-stop(79%, #FFDCB5), color-stop(88%, #9E634A), color-stop(100%, #9E634A)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* ie10+ */
        background: linear-gradient(0deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFDCB5', endColorstr='#9E634A',GradientType=0 ); /* ie6-9 */
    }

    .verdefos3{
        background: -moz-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFFFFF), color-stop(80%, #FFFFFF), color-stop(88%, #151E9E), color-stop(100%, #06209E)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* ie10+ */
        background: linear-gradient(0deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFFFF', endColorstr='#06209E',GradientType=0 ); /* ie6-9 */

    }

    .olivo{

        background: rgba(98,125,77,0.59);
        background: -moz-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: -webkit-gradient(left top, left bottom, color-stop(37%, rgba(98,125,77,0.59)), color-stop(78%, rgba(31,59,8,0.59)), color-stop(82%, rgba(31,59,8,0.59)), color-stop(94%, rgba(31,59,8,1)));
        background: -webkit-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: -o-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: -ms-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: linear-gradient(to bottom, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#627d4d', endColorstr='#1f3b08', GradientType=0 );
    }

    .blackblue{
        background: -moz-linear-gradient(270deg, #fff 0%, #000080 50%, #fff 99%, #fff 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(50%, #000080), color-stop(99%, #fff), color-stop(100%, #fff)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #fff 0%, #000080 50%, #fff 99%, #fff 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #fff 0%, #000080 50%, #fff 99%, #fff 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #fff 0%, #000080 50%, #fff 99%, #fff 100%); /* ie10+ */
        background: linear-gradient(180deg, #fff 0%, #000080 50%, #fff 99%, #fff 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#298DA3', endColorstr='#298DA3',GradientType=0 ); /* ie6-9 */
    }

    .descuentos{

        background: -moz-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff0000), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #ff0000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* ie10+ */
        background: linear-gradient(180deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0000', endColorstr='#ff0000',GradientType=0 ); /* ie6-9 */


    }

    .extracargos{
        background: -moz-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #008080), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #005757)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ie10+ */
        background: linear-gradient(180deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#008080', endColorstr='#005757',GradientType=0 ); /* ie6-9 */

    }
    
    .electric{
        background: -moz-radial-gradient(50% 50%, #ccff00, #fff);
        background: -webkit-radial-gradient(50% 50%, #ccff00, #fff);
        background: -o-radial-gradient(50% 50%, #ccff00, #fff);
        background: -ms-radial-gradient(50% 50%, #ccff00, #fff);
        background: radial-gradient(50% 50%, #ccff00, #fff);
    }

    .electric2{
        background: -moz-radial-gradient(50% 50%, #fb0a2a, #fff);
        background: -webkit-radial-gradient(50% 50%, #fb0a2a, #fff);
        background: -o-radial-gradient(50% 50%, #fb0a2a, #fff);
        background: -ms-radial-gradient(50% 50%, #fb0a2a, #fff);
        background: radial-gradient(50% 50%, #fb0a2a, #fff);
    }
    
    .celeste{
        background: -moz-linear-gradient(270deg, #3582BD 0%, #FFFFFF 4%, #ffffff 50%, #FFFFFF 96%, #3582BD 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3582BD), color-stop(4%, #FFFFFF), color-stop(50%, #ffffff), color-stop(96%, #FFFFFF), color-stop(100%, #3582BD)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #3582BD 0%, #FFFFFF 4%, #ffffff 50%, #FFFFFF 96%, #3582BD 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #3582BD 0%, #FFFFFF 4%, #ffffff 50%, #FFFFFF 96%, #3582BD 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #3582BD 0%, #FFFFFF 4%, #ffffff 50%, #FFFFFF 96%, #3582BD 100%); /* ie10+ */
        background: linear-gradient(180deg, #3582BD 0%, #FFFFFF 4%, #ffffff 50%, #FFFFFF 96%, #3582BD 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3582BD', endColorstr='#3582BD',GradientType=0 ); /* ie6-9 */
    }

    
    .oliverty{
        border: 2px solid #fff;
        border-radius: 9px 9px 2px 2px;
        background-image: url(../../../global/img/confirm.png);
        width: 130px;
        height: 32px;
        font-size: 14px;
        font-weight: bold;
        font-style: Normal;
        color: #fff;
        background-position: 0px 0px;
        background-repeat: repeat-x;
        padding: 0;
        margin-left: 405px;
        margin-top: -93px;
        position: absolute;
        filter: hue-rotate(1137deg);
    }

    @keyframes animatedBackgroundButton {
        from { background-position: 0 0; }
        to { background-position: 100% 0; }
    }

    .oliverty:hover{
        animation: animatedBackgroundButton 1s linear infinite;
        -moz-filter:hue-rotate(-350deg);
        -webkit-filter:hue-rotate(-350deg);
        -o-filter:hue-rotate(-350deg);
        -ms-filter:hue-rotate(-350deg);
        filter:hue-rotate(-350deg);

    }

    .ui-widget-header {
        /* border: 1px solid #333333; */
        /*background: #0086cc;*/
        background: #c00;
        color: #ffffff;
        font-weight: bold;
        border-radius: 6px 6px 0px 0px !important;
        font-family: bebasbook;
    }

    .ui-dialog {
        position: absolute;
        top: 80px;
        left: 676px;
        padding: .2em;
        outline: 0;
    }

    .button_sliding_bg {
        color: #fff;
        background: #006394;
        padding: 12px 17px;
        margin: 25px;
        font-family: 'OpenSansBold', sans-serif;
        border: 2px solid #31302B;
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        border-radius: 2px;
        display: inline-block;
        text-align: center;
        cursor: pointer;
        box-shadow: inset 0 0 0 0 #31302B;
            -webkit-transition: all ease 0.8s;
            -moz-transition: all ease 0.8s;
            transition: all ease 0.8s;
    }
    .button_sliding_bg:hover {
        box-shadow: inset 0 100px 0 0 #E21F26;
        color: #fff;
    }



    ul.tabs {

        margin: 0;

        padding: 0;

        float: left;

        list-style: none;

        height: 32px; /*--Define el ancho de las tabs--*/

        border-bottom: 1px solid #999;

        border-left: 1px solid #999;

        width: 40%;
        

    }

    ul.tabs li {

        float: left;

        margin: 0;

        padding: 0;

        height: 31px; /*--Sustrae 1px de la altura de la lista desordenada--*/

        line-height: 31px; /*--Alineamiento vertical del texto dentro de la tabla--*/

        border: 1px solid #999;

        border-radius: 5px 5px 0px 0px !important;


        border-left: none;

        margin-bottom: -1px; /*--Desplaza los item de la lista abajo 1px--*/

        overflow: hidden;

        position: relative;

        background: #E21F26;

    }

    ul.tabs li a {

        text-decoration: none;

        color: #fff;

        display: block;

        font-size: 1.2em;

        padding: 0 20px;

        border: 2px solid #fff;

        border-radius: 5px 5px 0px 0px !important;

        outline: none;
        
        

    }

    ul.tabs li a:hover {

        background: #006394;

    }

    html ul.tabs li.active, html ul.tabs li.active a:hover  { /*--Estate seguro de que a la tab activa no se le aplicarán estas propiedades hover--*/

        background: #fff;

        border-bottom: 1px solid #fff; /*--Esto hace que la tab activa esté conectada con respecto a su contenido--*/

    }

    .tab_container {

        border: 1px solid #999;

        border-top: none;

        overflow: hidden;

        clear: both;

        float: left; width: 40%;

        background: #fff;

    }

    .tab_content {

        padding: 20px;

        font-size: 1.2em;

    }

    /**********************************************/

    
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    h2 {
        font-size: 1.1em;
        margin-top: 2em;
        text-align: center;
    }

    main {
        width: 40%;
        margin: auto;
    }
/*height: 103%;*/
    #modal {
        background: rgba(0, 0, 0, 0.9);
        opacity: 0.16;
        filter: alpha(opacity=100);
        color: #fff;
        position: absolute;
        top: 9%;
        left: 12.8%;
        height: 235%;
        width: 74.5%;
        transition: all .5s;
    }
    #modal p {
        width: 60%;
        height: 40%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        font-size: 1.5em;
        text-align: center;
    }

    #mostrar-modal {
        display: none;
    }
    #mostrar-modal + label {
        background: steelblue;
        display: table;
        margin: auto;
        height:14px;
        color: #fff;
        line-height: 2;
        padding: 0 1em;
        text-transform: uppercase;
        cursor: pointer;
    }
    #mostrar-modal + label:hover {
        background: #38678f;
    }
    #mostrar-modal:checked ~ #modal {
        top: 1399px;
    }
    #mostrar-modal:checked ~ #cerrar-modal + label {
        display: block;
        left: 70em;
        margin-top: -248px;
    }

    #cerrar-modal {
        display: none;
    }
    #cerrar-modal + label {
        position: fixed;
        top: 33em;
        right: 208em;
        z-index: 100;
        color: #fff;
        /*  font-weight: bold;*/
        cursor: pointer;
        background: tomato;
        width: 68px;
        height: 25px;
        line-height: 27px;
        text-align: center;
        border-radius: 0%;
        display: none;
        transition: all .5s;
    }
    #cerrar-modal:checked ~ #modal {
        top: 9%;
    }
    #cerrar-modal:checked + label {
        display: none;
    }


    .flotante {
        display:scroll;
        position:fixed;
        bottom:40.5%;
        right:87.7%;
        top:-16.8%;
    }

    .flashit{
        
        color:#f2f;
                -webkit-animation: flash linear 0.4s infinite;
                animation: flash linear 0.4s infinite;
        }
        @-webkit-keyframes flash {
                0% { opacity: 1; } 
                50% { opacity: .6 } 
                100% { opacity: 1; }
        }
        @keyframes flash {
                0% { opacity: 1; } 
                50% { opacity: .6; } 
                100% { opacity: 1; }
    }
    
    .flashit2{
        
        color:#f2f;
                -webkit-animation: flash linear 0.4s infinite;
                animation: flash linear 0.4s infinite;
        }
        @-webkit-keyframes flash {
                0% { opacity: 1; } 
                50% { opacity: .6 } 
                100% { opacity: 1; }
        }
        @keyframes flash {
                0% { opacity: 1; } 
                50% { opacity: .6; } 
                100% { opacity: 1; }
    }
    
    .stroke {
    -webkit-text-fill-color: darkblue;
    -webkit-text-stroke: 1px deepskyblue;
    }
    
    .cssload-loader {
            width: 244px;
            height: 49px;
            line-height: 49px;
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
                    -o-transform: translate(-50%, -50%);
                    -ms-transform: translate(-50%, -50%);
                    -webkit-transform: translate(-50%, -50%);
                    -moz-transform: translate(-50%, -50%);
            font-family: helvetica, arial, sans-serif;
            text-transform: uppercase;
            font-weight: 900;
            font-size:18px;
            color: rgb(206,66,51);
            letter-spacing: 0.2em;
    }
    .cssload-loader::before, .cssload-loader::after {
            content: "";
            display: block;
            width: 15px;
            height: 15px;
            background: rgb(206,66,51);
            position: absolute;
            animation: cssload-load 0.81s infinite alternate ease-in-out;
                    -o-animation: cssload-load 0.81s infinite alternate ease-in-out;
                    -ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
                    -webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
                    -moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
    }
    .cssload-loader::before {
            top: 0;
    }
    .cssload-loader::after {
            bottom: 0;
    }



    @keyframes cssload-load {
            0% {
                    left: 0;
                    height: 29px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 39px;
            }
            100% {
                    left: 229px;
                    height: 29px;
                    width: 15px;
            }
    }

    @-o-keyframes cssload-load {
            0% {
                    left: 0;
                    height: 29px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 39px;
            }
            100% {
                    left: 229px;
                    height: 29px;
                    width: 15px;
            }
    }

    @-ms-keyframes cssload-load {
            0% {
                    left: 0;
                    height: 29px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 39px;
            }
            100% {
                    left: 229px;
                    height: 29px;
                    width: 15px;
            }
    }

    @-webkit-keyframes cssload-load {
            0% {
                    left: 0;
                    height: 29px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 39px;
            }
            100% {
                    left: 229px;
                    height: 29px;
                    width: 15px;
            }
    }

    @-moz-keyframes cssload-load {
            0% {
                    left: 0;
                    height: 29px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 39px;
            }
            100% {
                    left: 229px;
                    height: 29px;
                    width: 15px;
            }
    }


</style>


<?php if (isset($_GET['menssage'])) { ?>
    <div class="success"><?php echo $_GET['menssage']; ?></div>
<?php } ?>
<?php if (isset($_GET['error'])) { ?>
    <div class="error"><?php echo $_GET['error']; ?></div>
<?php } ?>

<?php

    if($reserva->estado == 'INVOICED'){
        
        $sql = "SELECT id_factura FROM facturaservicio WHERE id_servicio = '$reserva->id' AND tipo_servicio = 'RESERVE' ";
        $rs = Doo::db()->query($sql);
        $factura = $rs->fetchAll();

        foreach ($factura as $fact) {

        }

        $invoice_no =  $fact['id_factura'];


        $sql2 = "SELECT creation_date FROM factura WHERE id = $invoice_no ";
        $rs2 = Doo::db()->query($sql2);
        $fecha = $rs2->fetchAll();

        foreach ($fecha as $fec) {

        }

        $fecha_factura =  $fec['creation_date'];
    //echo $fecha_factura;
    
    }
    
?>

</div>
<div id="header_page" style="height:77px; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
    <div class="header">
<!--        <table style="width:500px;" border="0">
            <tr>
                <td width="30%">Reserves [ edit ] </td>
                <td width="10%" id="bnt-trips" class="btn" style="cursor:pointer;"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/calendar_aviso32x32.png" /></td>
                <td>ID <?php echo $reserva->id; ?></td>

                <td width="10%" style="padding:5px;"><div id="mensajeTrip" class="temporizador">00:00</div></td>
            </tr>
        </table>-->
        
        <table style="width:500px;" border="0">
            <tr>
                <td width="30%">Reservas [ edit ] </td>
                <td width="10%" id="bnt-trips" class="btn" style="cursor:pointer;"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/calendar_aviso32x32.png" /></td>
                <td>ID <?php echo $reserva->id;?></td>
                <td width="10%" style="padding:5px;"><div id="mensajeTrip" class="temporizador">00:00</div></td>
                
            </tr>
        </table>
    </div>

    <div id="info-group" style="">
        <input type="text" readonly="true" style=" background: #33449C; margin-left: 11px; margin-top: -6px; width: 303px; color: #fff; border-color: transparent; font-family: Arial, Helvetica, sans-serif;" name="taritrans" id="taritrans" placeholder="Rates" />
    </div>

    <script type="text/javascript">
        function capturar2()
        {
            var x = document.getElementById('taritrans1').value;
            document.getElementById('taritrans').value = x;
        }
    </script>

    <div  id="toolbar">
        <select style="margin-left:-479px; margin-top: 13px; width:303px; background: #AC1B29;color: #fff;border-color: transparent;" name="special_price_name" id="special_price_name" onchange="myFunction()">
    <!--    <select style="margin-left:3px; margin-top:11px; width:303px; background: #AC1B29;color: #fff;border-color: transparent;" name="fnombre" id="rate" onchange="myFunction()">-->

            <option id="" value="Rates">Rates</option>
            <?php
            $sql1 = "SELECT DISTINCT special_price_name FROM routes_net";
            $rs1 = Doo::db()->query($sql1);
            $routesnet = $rs1->fetchAll();
            foreach ($routesnet as $r) {
                echo '<option value="' . $r['special_price_name'] . '" >' . $r['special_price_name'] . '</option>';
            }
            ?>
        </select>

        <script>
            function myFunction() {
                var x = 'RATES ----------------------------------------------------->';
                document.getElementById("taritrans").value = x;
            }
        </script>           

        <div class="toolbar-list">
            <ul>

                <li class="btn-toolbar" id="">
                    
                    <form action="<?php echo $data['rootUrl'] ?>admin/reporte/cargar" id="formulario" method="post" name="formulario" onsubmit="onEnviar();">
                        <input id="variable" style="display:none" name="variable"  value="<?php echo $reserva->id; ?>"  />
                        <!--<input  type="submit" value="Summary" />-->
                        <input  type="submit" value="Summary Passenger" style="cursor:pointer; margin-top: -7px; margin-left: -89px; padding: 4px; height: 34px; width: 127px; color: #AC1B29; font-weight: 700; font-size:11px;" />

                    </form>
                    
                    <script type="text/javascript">
                        var variableJs = document.getElementById("variable").value;//"2259";

                        function onEnviar() {
                            document.getElementById("variable").value = variableJs;
                        }
                    </script>

                </li>            

                <li style="margin-left: -14px; margin-top: 1px;" class="btn-toolbar" id="btn-rastro">
                    <a  style="margin-left: 12px; margin-top: -15px;" class="link-button" id="btn-rastro">
                        <span class="icon-32-rastro" title="Mostrar Rastro" style="margin-left: 4px; margin-top: -3px; color:#4B0082; width: 32px; height: 32px; ">&nbsp;</span>

                        Traces
                    </a>
                </li>

                <li style="margin-left: -1px; margin-top: 1px;" class="btn-toolbar" id="btn-pagos">
                    <a  style="margin-left: 10px; margin-top: -15px;" class="link-button" id="btn-pagos">    
                        <span class="pagos" title="Pagos" style="margin-left: 4px; margin-top: -3px; color:#4B0082; width: 32px; height: 32px; ">&nbsp;</span>

                        Payments
                    </a>
                </li>

                <li style="margin-left: -1px; margin-top: 1px;" class="btn-toolbar" id="btn-save1">
<!--                    <a  class="link-button" id="btn-save1"><span class="icon-32-save" title="Guardar">&nbsp;</span>Save</a>-->
                    <a style="margin-left: 154px; margin-top: -64px;" class="link-button" id="btn-save1"> <i class="fa fa-floppy-o fa-3x" title="Guardar" style="margin-left: 4px; margin-top: -2px;  color:#4B0082;"></i><br>&nbsp;Save</a>
                </li>


                <!--                <li style="margin-left: -1px; margin-top: 1px;" class="btn-toolbar" id="btn-cancel1">
                                    <a style="margin-left: 207px; margin-top: -64px;" class="link-button"><i class="fa fa-arrow-left fa-3x" title="Regresar" style="color: #33449C; margin-top: -4px;"></i><br>Back</a>
                                </li>-->

            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- header options -->
<fieldset id="facturas" style="position:absolute; width:109px; height: 36px; margin-top: -148px; margin-left:872px; background-color: #F5F5F5; border-color: transparent;">

    <div id="invoices">
    
    <table>
        
        <tr>
          
        <td><label id="lbl_invoice" style="position:absolute; margin-left:-78px; margin-top:9px; font-size: 14px; color:#0B55C4; font-weight: bold;">Invoice #</label></td>
        <td><input type="text"  id="invoice" name="invoice" style="position:absolute;  height: 17px; margin-left:-8px; margin-top: 3px; width:119px; text-align: center; color:red; font-size:18px; padding-top:3px; font-weight:bold;"   value="<?php echo $invoice_no; ?>" readonly="readonly"/></td>
        <td><label id="lbl_creation" style="position:absolute; margin-left:-9px; margin-top:32px; color:#000; font-size:8px;">Creation Date:</label></td>
        <td><input type="text"  id="fec_invoice" name="fec_invoice" style="position:absolute; margin-left:69px; margin-top: 31.2px; width:50px; text-align: left; color:#000; font-size:8px; font-weight:bold; border:0px; background-color: transparent;"   value="<?php echo $fecha_factura; ?>" readonly="readonly"/></td>
            
        </tr>
    </table>
    
    
    </div>
     
 </fieldset>

    


        

    
<!--background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');-->
    <div id="content_page"  style="margin-top: -26px; width: 1000px;z-index:1; height:1350px;" >

    <form  id="formula" class="form" action="<?php echo $data['rootUrl']; ?>admin/reservas/save-edit-reserve" method="post" name="formula">
        
        <div id="info-group2">
        <div id="cancelation">
            <div class="ho">CANCELATION <span>#</span></div>
            <div id="cancel">00000</div>
        </div>
        <div id="reservation">
            <div class="ho" style="color: #fff;background: #bb0000; height:12px;">RESERVATION <span>#</span></div>
            <div style="background: #98FB98;" id="reser"><?php echo $reserva->codconf; ?><input type="hidden" /></div>
        </div>
        <div id="status-change" >
<!--            <div  style="width: 102px;color:#4B0082;"><strong>CHANGE STATUS</strong></div>-->
            <div class="ho" style="color: #fff;background: #2D2193;padding: 4px;margin-top: 3px; margin-left:0px; width:44px; ">STATUS</div>
            <select style="width:112px; margin-left: -4px; margin-top:1px;"  id="estado" name="estado">
                <option></option>
                <option style="font-weight:bold; color:green;" <?php
            if ($reserva->estado == 'CONFIRMED' || $reserva->estado == 'INVOICED') {
                echo ' selected="selected" ';
            };
            ?>  value="CONFIRMED">CONFIRMED</option>
                <option style="font-weight:bold; color:green;"  <?php
                if ($reserva->estado == 'QUOTE') {
                    echo ' selected="selected" ';
                };
            ?>  value="QUOTE">QUOTE</option>
                <option style="font-weight:bold; color:red;" value="NO SHOW W/ CHARGE" <?php
                if ($reserva->estado == 'NO SHOW W/ CHARGE') {
                    echo ' selected="selected" ';
                };
            ?>>NO SHOW W / CHARGE</option>
                <option style="font-weight:bold; color:red;"  value="NO SHOW W/ O CHARGE" <?php
                if ($reserva->estado == 'NO SHOW W/ O CHARGE') {
                    echo ' selected="selected" ';
                };
            ?>>NO SHOW W / O CHARGE</option>
                <option style="font-weight:bold; color:red;"  <?php
                if ($reserva->estado == 'CANCELED') {
                    echo ' selected="selected" ';
                };
            ?>  value="CANCELED">CANCELED</option>
            </select>
        </div>
        <div id="status" style="width:110px;" >
            <!--            <div class="ho" style="color: #fff;background: #bb0000; height:12px;">STATUS</div>
            -->
            <div  id="stat"><?php
                if ($reserva->estado == 'CONFIRMED') {

                    echo '<input style="position:absolute; background-color:green; color:#fff; text-align:center; font-weight:bold; font-size:24px; width:417px; margin-top: -1.1px; margin-left: -56px; height: 23px;" type="text" id="reservita" name="reservita" value="' . $reserva->estado . '" />';
//                echo $reserva->estado;
                };
            ?>

                <?php
                if ($reserva->estado == 'QUOTE') {

                    echo '<input style="position:absolute; background-color:green; color:#fff; text-align:center; font-weight:bold; font-size:24px; width:417px; margin-top: -1.1px; margin-left: -56px; height: 23px;" type="text" id="reservita" name="reservita" value="' . $reserva->estado . '" />';
//                echo $reserva->estado;
                };
                ?>

                <?php
                if ($reserva->estado == 'INVOICED') {

                    echo '<input style="position:absolute; background-color:#3821FF; color:#fff; text-align:center; font-weight:bold; font-size:24px; width:417px; margin-top: -1.1px; margin-left: -56px; height: 23px;" type="text" id="reservita" name="reservita" value="' . $reserva->estado . '" />';
//                echo $reserva->estado;
                };
                ?>

                <?php
                if ($reserva->estado == 'NO SHOW W/ CHARGE') {

                    echo '<input style="position:absolute; background-color:#FF2121; color:#fff; text-align:center; font-weight:bold; font-size:24px; width:417px; margin-top: -1.1px; margin-left: -56px; height: 23px;" type="text" id="reservita" name="reservita" value="' . $reserva->estado . '" />';
//                echo $reserva->estado;
                };
                ?>

                <?php
                if ($reserva->estado == 'NO SHOW W/ O CHARGE') {

                    echo '<input style="position:absolute; background-color:#FF2121; color:#fff; text-align:center; font-weight:bold; font-size:24px; width:417px; margin-top: -1.1px; margin-left: -56px; height: 23px;" type="text" id="reservita" name="reservita" value="' . $reserva->estado . '" />';
//                echo $reserva->estado;
                };
                ?>

                <?php
                if ($reserva->estado == 'CANCELED') {

                    echo '<input style="position:absolute; background-color:#FF2121; color:#fff; text-align:center; font-weight:bold; font-size:24px; width:417px; margin-top: -1.1px; margin-left: -56px; height: 23px;" type="text" id="reservita" name="reservita" value="' . $reserva->estado . '" />';
//                echo $reserva->estado;
                };
                ?>

            </div>
        </div>
    </div>
    
        <div id="serpare">
            <input id="fin_calculo" type="hidden" value="false"/>
            <input type="hidden"  id="vista" value="1" />
            <input name="id" type="hidden"  id="id"  value="<?php
                if (isset($reserva)) {
                    echo $reserva->id;
                }
                ?>" />

            <table width="100%">
                <tr>    <td>
                        <!--                        <fieldset id="inputype" style="width:40%;"><legend>INPUT TYPE</legend>-->
                        <fieldset    id="inputype" style="margin-left:-6px; width:468px;  height:145px; border-radius: 0px 64px 0px 0px; box-shadow: 0 -11px 4px #DC1349;" class="rojo"><legend style="border:1px solid #B83A36; background:#fff;margin-left:11.1px;">INPUT TYPE</legend>
                            <div id="opera" class="input">
                                <table width="100%" >
                                    <tr align="left">
                                    <div>
                                        <div style="margin-top:2px; margin-left:2px;">
<!--                                            <td >-->
                                                <label style="color:#FFFFFF;" id="label">CALL CENTER</label>
<!--                                            </td>-->

                                        </div>
                                        <div style="margin-top:-11px; margin-right:234px;">
<!--                                            <td >-->
    <!--                                            <input name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>-->
                                                <input style=" width:205px; text-align: left;" name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
<!--                                            </td>-->
                                        </div>
                                    </div>
                                    </tr>
                                    <tr><td colspan="2" >
                                            <table width="100%">
                                                <tr>
<!--                                                    <td width="10%">-->
                                                <div>
                                                        
                                                    <div style="margin-top:2px; margin-left:2px;">
                                                        <label style="color:#FFFFFF;">AGENCY</label>
                                                    </div>
                                                    
<!--                                                    </td>-->
<!--                                                    <td width="40%">-->
                                                    <div class="ausu-suggest" style="margin-top:9px; margin-left:-50px;">
                                                        <input type="text" name="agency" onchange="capturar2();" id="agency" size="19" maxlength="30" style="margin-top:12px; margin-left:3px; width:201px;" value="<?php echo $agencia->company_name; ?>"  autocomplete="off"    />
                                                        <input type="hidden" size="4" value="<?php echo $agencia->id; ?>" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value="<?php echo $agencia->type_rate; ?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>

                                                    </div>

                                                </div>
<!--                                                    </td>-->
<!--                                                    <td width="10%">-->

                                                        <div style="margin-top:2px; margin-left:2px;">
                                                            <label style="margin-left:7px; color:#FFFFFF;">Employ</label>
                                                        </div>
<!--                                                    </td>-->
<!--                                                    <td width="40%">-->
                                                        <div class="ausu-suggest" style="margin-top:11px; margin-left:-41px;" >
                                                            <input style="width:219px; margin-top:-37px; margin-left:257px;" name="uagency" type="text"  id="uagency" size="11" maxlength="30" value="<?php echo ($agencia->id != -1) ? $userA->firstname . ' ' . $userA->lastname : ''; ?>"  />
                                                            <input type="hidden" size="4" value="<?php echo ($agencia->id != -1) ? $userA->id : ''; ?>" name="id_auser" id="id_auser" autocomplete="off" />
                                                        </div>
<!--                                                    </td>-->
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr><td colspan="2" >&nbsp;</td></tr>
                                    <tr><td colspan="2">
                                            <table style="margin-top:-15px; margin-right:112px;" align="center" cellspacing="10">
                                                <tr valign="top">
                                                    <td><label style="color:#FFFFFF;" for="calan_phone"> BY PHONE</label> <input name="canal" <?php
            if ($reserva->canal == 'PHONE') {
                echo ' checked="checked" ';
            }
                ?>  type="radio" id="calan_phone" value="PHONE" />  </td>
                                                    <td><label style="color:#FFFFFF;"  for="calan_mail"> BY MAIL</label> <input name="canal" <?php
                                                        if ($reserva->canal == 'MAIL') {
                                                            echo ' checked="checked" ';
                                                        }
                ?> type="radio"  id="calan_mail"  value="MAIL" /> </td>
                                                    <td><label style="color:#FFFFFF;" for="calan_web"> WEBSALE </label><input name="canal"  <?php
                                                        if ($reserva->canal == 'WEBSALE') {
                                                            echo ' checked="checked" ';
                                                        }
                ?> type="radio" id="calan_web" value="WEBSALE" />  </td>
                                                </tr>
                                            </table>
                                        </td></tr>
                                </table>
                            </div>

                        </fieldset>
                    </td>  


                    <td>
                        <!--                        <fieldset id="liderpax" style=""><legend>LEADER PASS</legend>-->
                        <fieldset id="liderpax" style="margin-left:-1px; margin-top:0px; border-radius: 64px 0px 0px 0px; width:470px; height: 145px; box-shadow: 0 -11px 4px #1E90F6;" class="pass"><legend style="border:1px solid #00C; margin-left:15px; background:#fff;">LEADER PASS</legend>
                            <table>
                                <tr>
                                    <td >
                                        <div id="opera" class="input" style="padding-top:5px;">
                                            <table>
                                                <tr>
                                                
                                                    <div>
<!--    <td>-->
                                                        <div style="margin-left:22px; margin-top:-14px;">
                                                                <label style="color:#FFFFFF; margin-left:-19px;" id="label" >SEARCH </label>
                                                        </div>
<!--                                                    </td>-->
<!--                                                    <td>-->
                                                        <div style="margin-left:-1px; margin-top:0px; margin-top: 0px;" class="ausu-suggest" id="opera">
                                                            <input style="margin-left:4px; width:446px;" type="text" size="35" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->lastname . " " . $cliente->firstname . " - E-Mail -" . $cliente->username;
                                                            }
                                                        }
                ?>" name="leader" id="leader" autocomplete="off" />

                                                            <input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
                                                        </div>
<!--                                                    </td>-->
<!--                                                    <td>&nbsp;&nbsp;</td>-->
<!--                                                    <td title="">-->
                                                        <div  class="ausu-suggest" style="margin-top:-5px; margin-left:2px; display:none">
                                                            <a id="newClient" style="cursor:pointer; visibility:hidden;" ><img src="<?php echo $data['rootUrl']; ?>global/img/new.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
                                                        </div>
<!--                                                    </td>-->

                                                    </div>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="opera" class="input" >
                                            <table width="100%">
                                                <tr>
                                                <div style="margin-right:-34px; margin-top:-31px;">
<!--                                                    <td width="" align="right">-->
                                                    <div style="margin-right:418px; margin-top:-9px;">
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
                                                            
                                                    </div>
    <!--                                                    </td>-->
    <!--                                                    <td width="">-->
                                                    <div style="margin-right:240px; margin-top:22px;">
                                                            <input style="margin-right:28px; width:217px;" name="firstname1" type="text"  id="firstname1" size="15" maxlength="15" value="<?php
                                                            if (isset($reserva)) {
                                                                echo $reserva->firsname;
                                                            }
                    ?>" />	
    <!--                                                    </td>-->
                                                    </div>
    <!--                                                    <td width="" align="right"> -->
                                                    <div style="margin-left:22px; margin-top:-14px;">
                                                            <label style="color:#FFFFFF; margin-top: -31px; margin-right: 197px;" id="labeldere12" >LAST NAME </label>
    <!--                                                    </td>-->
                                                    </div>
    <!--                                                    <td width="">  -->

                                                    <div style="margin-left:22px; margin-top:-24px;">
                                                            <input style="margin-right:35px; width:224px;" name="lastname1" type="text"  id="lastname1" size="15" maxlength="15" value="<?php
                                                            if (isset($reserva)) {
                                                                echo $reserva->lasname;
                                                            }
                    ?>" />
    <!--                                                    </td>-->
                                                    </div>

                                                </div>
                                                </tr>
                                                <tr>
                                                <label style="color:#FFFFFF; margin-top:-2px; margin-left:2px;" id="email">E-MAIL</label>
                                                <div style="margin-left:2px; margin-top:-4px;">
                                                        <div style="margin-top:2px;">
        <!--                                                    <td align="right"> -->
<!--                                                                <label style="color:#FFFFFF; margin-right: 382px;" id="labeldere12">E-MAIL </label>-->
        <!--                                                    </td>-->
                                                        </div>
        <!--                                                    <td>-->
                                                        <div style="margin-right:2px; margin-top:2px;">
                                                                <input style="margin-right:232px; margin-top:2px; width:217px; " name="email1" type="text"  id="email1" size="15" value="<?php
                                                                if (isset($reserva)) {
                                                                    echo $reserva->email;
                                                                }
                        ?>"/>
        <!--                                                    </td>-->
                                                        </div>
        <!--                                                    <td align="right">-->
                                                        <div style="margin-right:2px; margin-top:2px;">
                                                                <label style="color:#FFFFFF; margin-right: 186px; margin-top:-48px;" id="labeldere12">PHONE </label>
        <!--                                                    </td>-->
                                                        </div>
        <!--                                                    <td>-->
                                                        <div style="margin-right:2px; margin-top:2px;">
                                                                <input style="margin-top: -26px; margin-right:-1px; width:224px; " name="phone1" type="text"  id="phone1" size="15" maxlength="15" value="<?php
                                                                if (isset($cliente) && isset($reserva)) {
                                                                    if ($cliente->id == $reserva->id_clientes) {
                                                                        echo $cliente->phone;
                                                                    }
                                                                }
                        ?>" /> 
                                                                <input  type="hidden" name="type_cliente"  id="type_cliente" value="<?php
                                                                if (isset($cliente) && isset($reserva)) {
                                                                    if ($cliente->id == $reserva->id_clientes) {
                                                                        echo $cliente->tipo_client;
                                                                    }
                                                                }
                        ?>" />       	
        <!--                                                    </td>-->
                                                        </div>
                                                    
                                                </div>

                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>

                </tr>
            </table>

            <!--            <fieldset id="boo" ><legend>BOOKING</legend>-->
            <fieldset id="boo" style="width:952px; height: 65px; border-radius: 26%;margin-top: 3px;" class="booking2" ><legend style="border:1px solid #00C; background:#fff;">BOOKING</legend>
                <input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php
                                                        if (isset($reserva)) {
                                                            if ($reserva->tipo_ticket == 'oneway') {
                                                                echo 1;
                                                            } else {
                                                                echo 2;
                                                            }
                                                        }
                ?>"/>

                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#00f;"><strong>ONE WAY</strong> </label> <input name="tipo_ticket"  id="oneway" onclick="capturar(); reset_roundtrip();" type="radio" value="1"
                    <?php
                    if (isset($reserva)) {
                        if ($reserva->tipo_ticket == 'oneway') {
                            echo ' checked ';
                        }
                    }
                    ?>

                                                                                                                                            <?php
                                                                                                                                            if (isset($reserva)) {
                                                                                                                                                if ($reserva->tipo_ticket != 'oneway') {
                                                                                                                                                    echo ' enabled ';
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            ?>/></div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#AC1B29;"><strong>ROUND TRIP</strong></label><input name="tipo_ticket" id="roundtrip" type="radio" value="2" onclick="capturar();" <?php
                                                                                                                                            if (isset($reserva)) {
                                                                                                                                                if ($reserva->tipo_ticket != 'oneway') {
                                                                                                                                                    echo ' checked ';
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            ?> /> </div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#4B0082;" style="padding-right:5px;"><strong>TYPE OF PASS</strong></label>
                    <div style="margin-left:97px; margin-top:1px;">
                        <select name="tipo_pass" id="tipo_pass" onclick="cargando();residente();" disabled="true" >
                            <option style="color:red;" value="0">NO RESIDENT</option>
                            <option style="color:blue;" value="1">RESIDENT</option>
                        </select>
                    </div>
                    
                    <input type="text" name="resident" id="resident" value="<?php echo $residente; ?>" style="display:none; position:absolute; margin-left:10px; margin-top:34px; width:55px;" />

                </div>
<!--margin-top:31px; margin-right:-122px;-->
                <div><label id="labeldere" style=" margin-right:565px; margin-top:4px; width: 167px; color:#4B0082;"><strong>Customer With Disabilities</strong></label></div>
                <div id="opera" class="input" style="margin-left:386px; margin-top:-15.1px;" >
                    <input style="" name="byr" type="checkbox" value="1" <?php
                    if (isset($reserva)) {
                        if ($reserva->customer_disabilities == 1) {
                            echo ' checked ';
                        }
                    }
                                                                                                                                            ?> />
                                      
                </div>
                <div style="margin-left:0px; margin-top:-1px;">
                
                <div id="opera" class="input"  style="padding-top:10px; clear:left;">
                    <label style="width:45px; margin-left:470px; margin-top:-58px;color:#000000;"><strong>ADULT</strong></label>
                    <input name="pax" type="number" min="1"  id="pax" size="2" maxlength="2" readonly="readonly" value="<?php echo $reserva->pax ?>"  style="border:1px solid #AFAFAF; color:#AFAFAF; font-weight: bold;text-align: center; width:40px; margin-top:-58px;" onchange="
                            var a = document.getElementById('pax').value();
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
                </div>
                
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-top:-58px; color:#000000;"  ><STRONG>CHILD</STRONG></label>
                    <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" readonly="readonly" value="<?php echo $reserva->pax2 ?>" style="border:1px solid #AFAFAF; color:#AFAFAF; font-weight: bold; text-align: center; width:40px; margin-top:-58px;" min="0" max="15" onchange="
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
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-top:-58px; height:18px; color:#000;"  ><strong>TOTAL</strong></label>
                    <input style="color:#AFAFAF; border:1px solid #AFAFAF; margin-top:-58px; height:18px; text-align: center; width: 40px;" name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/>
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-left:-12px; margin-top:-58px; color:#000;"  ><strong>INFANT</strong></label>
                    <input name="infat" type="number" readonly="readonly" id="infat" size="2" maxlength="2" value="<?php echo $reserva->pax3; ?>" min="0" max="16" style="border:1px solid #AFAFAF; color:#AFAFAF; font-weight: bold; text-align: center; width:40px; margin-top:-58px;margin-left:8px;" />
                </div>
                    
                </div>

<!--    <div id="opera" class="input" style="float: left; margin-left:230px; margin-top:-30px; "><input style="margin-top:6px;" name="byr" type="radio" value="" /><label id="labeldere" style="color:#4B0082;"><strong>Customer With Disabilities</strong></label></div>-->
            </fieldset>
            <!--&nbsp;-->

<!--            <table width="200"  cellspacing="0" class="sup" >
                <tr>
                    <td width="167" ><label > <strong>SUPERCLUB#</strong></label></td>
                    <td width="27"><label id="labeldere"><span id="number_supu">N/A</span></label></td>
                </tr>
                <tr>
                    <td><label> <strong>POINTS BALANCE</strong></label></td>
                    <td><label id="labeldere"><span id="points">N/A</span></label></td>
                </tr>
                <tr>
                    <td><label > <strong>POINTS REQUIRED
                                <span style="font-size: 8px;">FOR THIS TRIP</span>

                            </strong></label></td>
                    <td><label id="labeldere" >N/A</label></td>
                </tr>
            </table>-->
            <fieldset id="onew" style="border-radius: 7%; margin-top:0px;  height:293px; padding-top: 15px;  box-shadow: 4px 6px 7px 1px #708090;" class="cerati"><legend style="margin-top:4px; border:1px solid #00C; background:#fff;">ONE WAY</legend>
                
                <table style="margin-top:0px; margin-left:0px;" align="left" cellspacing="0" border="0">                                       

                    <tr>  
                        
                        <td>
                            <div>
                                <select style="position:absolute; border: #000 2px solid; width:177px; margin-left: 16px; margin-top:-4.3px; border-radius: 0px 0px 0px 0px; font-weight:bold;" id="estado_oneway" name="estado_oneway" onchange="passenger_balance(); fecha_ns_one();">

                                    <optgroup  label="STATUS">

                                        <option style="font-weight:bold;" value="1">CONFIRMED</option>
                                        <option style="font-weight:bold;" value="4">CANCELED</option>
                                        <option style="font-weight:bold;" value="5">CANCELED W/FEE</option>                            
                                        <option style="font-weight:bold;" value="2">NO SHOW</option>
                                        <option style="font-weight:bold;" value="3">NO SHOW W/FEE</option>
                                        <option style="font-weight:bold;" value="6">OPEN W/FEE</option>


                                    </optgroup>

                                </select>
                            </div>
                        </td>
                        
                        <td>
                            <div class="cerati" style="border: #fff 1.3px solid; width:664px; height:46px; margin-left:7px; margin-top:2px; border-radius: 10px 10px 10px 10px;">
                                <div style="margin-top:4px; margin-left: 24px;">
                                  <label id="tarifone" style="margin-left:165px;  color:#FFFFFF;">RATE</label> 
                                </div>
                                <div>                     
                                    <input type="text" name="tari_one"  id="tari_one" size="10" maxlength="15" style="border-radius: 0px 0px 0px 0px; border: #000 2px solid; background-color: #757575; color:#FFF; text-align:center; width:140px; margin-left:188.5px; margin-top: 1.2px; height: 14px;" disabled="disabled" value="<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; } else if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } else if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '3') {  echo 'Web Fare Price'; } else if ($reserva->tarifa_one == '4') {  echo 'Super Promo Price'; } else if ($reserva->tarifa_one == '5') {  echo 'Super Discount Price'; } ?> " autocomplete="off"/>
                                </div>
                            </div>                            
                        </td>
                        
                        <td>
                            <div>
                                <div style="margin-top:-42.5px; margin-left: -115px;">
                                    <label id="departure_ns" style="position:absolute; margin-left:-215px; margin-top:42.5px; color:#FFFFFF;">DEPARTURE</label>
                                </div>
                                <div>
                                    <input type="text" name="fec_salida_ns"  id="fec_salida_ns" title="(Y - M - D)" size="10" maxlength="15" disabled="disabled" style="border-radius: 0px 0px 0px 0px; border: #000 2px solid; background-color: #757575; color:#FFF; text-align:center; width:83px; margin-left:-330px; height: 12px; padding-top:3px; margin-top: 56.5px;" value="<?php if (isset($reserva)) {  echo ($reserva->fecha_salida_ns == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($reserva->fecha_salida_ns))); }  ?>" autocomplete="off"/>
                                </div>

                            </div>
                        </td>
                        
                    </tr>
                    
                </table>

                <table style="margin-top:0px; margin-left:0px;" align="left" cellspacing="0" border="0">  
                    
                    <tr>    
                        
                        <td>                            
<!--                            <a href="" id="dataclick1" ><i class="fa fa-calendar fa-2x" style="color: #fff; margin-top: 6px; margin-right: 96px;"></i></a>-->
                            <a href="" id="dataclick1" style="position:absolute; margin-left:7px; margin-top:1px;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/calendar.png' width='25' height='25'></a>
                            
                        </td>
                        <td> 
                            <div id="opera" class="input" style="">

                                <div><label style="position:absolute; width:75px; color:#FFFFFF; margin-left:29px; margin-top: 12px;" >DEPARTURE</label></div>
            <!--                    <a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                
                                <div>

                                <input type="text" name="fecha_salida"  id="fecha_salida" size="10" title="(M - D - Y)" maxlength="15" style="width:87px; margin-left:29px; padding-top:2px; margin-top: 32px; text-align: center;" value="<?php  if($reserva->fecha_salida == '-N/A-') { echo 'N/S'; } else if($reserva->fecha_salida == '-N/S W/F-') { echo 'N/S W/FEE'; } else if($reserva->fecha_salida == '-C W/F-') { echo 'CANC W/FEE'; } else if($reserva->fecha_salida == '-C-') { echo 'CANC'; } else if($reserva->fecha_salida == '-OP-') { echo 'OPEN W/FEE'; } else {  if (isset($reserva)) {  echo ($reserva->fecha_salida == "0000-00-00"?"00-00-0000":date('m-d-Y', strtotime($reserva->fecha_salida))); } }?>" onchange="fechale();" autocomplete="off"/>
                                </div>

                            </div>
                        </td>
                        
                        <td>
                            <div id="opera" class="input" style="" >
                                <div id="explo">  <label style="position:absolute; width:45px; color:#FFFFFF; margin-left: -14px; margin-top:-16px;"  > FROM</label></div>
                                <div id="explo" align="left"> 
                                    <select name="fromt"  style="position:absolute; width:178px; height:25px; margin-top: 4px; margin-left:-14px;" id="from">
                                        <option value=""></option>
                                        <?php foreach ($data["areas"] as $e) { ?>
                                            <option value="<?php echo $e["id"]; ?>" <?php
                                        if (isset($reserva)) {
                                            echo (trim($reserva->fromt) == trim($e["id"])) ? 'selected' : '';
                                        } else {
                                            echo (trim($e['nombre'] == trim("ORLANDO") ? 'selected' : ''));
                                        }
                                            ?> ><?php echo $e["nombre"]; ?></option>
                                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                        </td>
                        
                        <td>
                            <div id="opera" class="input" style=""  >
                                <div id="explo"><label style="position:absolute; width:45px; color:#FFFFFF; margin-left: 31px; margin-top: 12px;"  > TO</label></div>
                                <div id="explo" align="left">
                                    <select name="to"  id="to" style="width:178px; height:25px; margin-top: 32px; margin-left:29px;">
                                        <?php foreach ($to_areas as $area) { ?>
                                            <option value="<?php echo $area['trip_to']; ?>"  <?php echo ($area["trip_to"] == $reserva->tot ? 'selected' : '') ?> >
                                                <?php echo $area['nombre']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="valto" id="valto" value="<?php
                                        if (isset($reserva)) {
                                            echo $reserva->tot;
                                        }
                                        ?>"/>
                                </div>
                            </div>
                        </td>    
                        
                        
                        <td>
                            <div id="mascaraP" style="display: none;">
                            </div>
                            <div id="popup" style="display: none;">
                                <div class="content-popup">
                                </div>
                            </div>

                            <div id="clienteN" style="display:none; width: 700px; margin-left: 100px;" ></div>

                            <div id="opera" class="input" style="">
                                <div style="width:50px; margin-top: -5px;" id="popup1">  <label style="position:absolute; width:20px; color:#FFFFFF; margin-top: 17px; margin-left: 73px;"> TRIP</label><a id="search" onclick="activa_one(); comprobarScreen(); cargando();" style="position:absolute; cursor:pointer;color: #fff; margin-left: 82px; margin-top: 5px;"><img src ='<?php echo $data['rootUrl'] ?>global/img/search.png' width='25' height='25'></a>
                                    <input type="hidden" id="valorcomision01" name="valorcomision01" value="<?php /* echo $subto['comi1'] */ ?>" /></div>
                                <div style="width:50px;"> <input type="hidden" id="trip_no_c" name="trip_no_c"  value="<?php
                                    if (isset($reserva)) {
                                        echo $reserva->trip_no;
                                    }
                                        ?>"/><input name="trip_no" type="text" style="text-align:center; margin-top:37px; margin-left:72px; height: 21px; width:83px;"  id="trip_no" size="3" maxlength="3" value="<?php if (isset($reserva)) {
                                        echo $reserva->trip_no;
                                    } ?>"  readonly="readonly"/>
                                </div>


                            </div>
                        </td>
                        
                        <td>
                            <div id="opera" class="input"  style="">
                                <div style="width:50px;">  <label style="position:absolute; width:45px; margin-left:92px; margin-top: 12px; color:#FFFFFF;"  > DEP.TIME</label></div>

                                <input name="departure1" type="text"  id="departure1" size="5" maxlength="8" style="text-align:center; height:21px; width:72px; margin-left:92px; margin-top:32px;" value="<?php
                                if (isset($reserva)) {
                                    echo date("g:i a", strtotime($reserva->deptime1));
                                }
                                ?>" readonly="readonly"/>

                            </div>
                            
                        </td>
                        
                        

                            
                            
                    </tr>
                    
                </table>
                
                <table style="margin-top:-11px; margin-left:0px;" align="left" cellspacing="0" border="0">  
                    
                    <tr>  
                        
                        <td>
                        
                            <div id="opera" class="input"  style="clear:left; ">
                                <div style="width:265px;">  <label style="position:absolute; margin-left:0px; margin-top:8px; width:150px;  color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
                                <div style="width:200px;  margin-left:0px; margin-top:29px;">
                                    <div class="ausu-suggest" >
                                        <input name="pickup1" type="text"  id="pickup1" size="40" maxlength="55" value="<?php
                                        if (isset($pickup1) && $pickup1 != "") {
                                            echo $pickup1->place;
                                        }
                                        ?>" autocomplete="off"/>
                                        <input name="id_p1" type="hidden"  id="id_p1" size="40" maxlength="55" value="<?php
                                        if (isset($pickup1) && $pickup1 != "") {
                                            echo $pickup1->id;
                                        }
                                        ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </td>
                        
                        <td>
                            <div id="opera" class="input"  >
                                <div style="width:265px;">  <label style="position:absolute; margin-left:8px; margin-top:8px; width:250px;  color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                                <div style="width:210px;">
                                    <div class="ausu-suggest" >
                                        <input name="dropoff1" style=" margin-left: 8px; margin-top:29px; width: 280px;" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php
                                        if (isset($drop1) && $drop1 != "") {
                                            echo $drop1->place;
                                        }
                                        ?>" autocomplete="off"/>
                                        <input name="id_dropoff1" type="hidden"  id="id_dropoff1" size="39" maxlength="55" value="<?php
                                        if (isset($drop1) && $drop1 != "") {
                                            echo $drop1->id;
                                        }
                                        ?>" />
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div id="opera" class="input" style="" >
                                <div style="width:50px;">  <label style="position:absolute; width:45px; margin-left:15px; margin-top:8px; color:#FFFFFF;"  >ARR.TIME</label></div>
                                <div style="width:50px;">
                                    <input name="arrival1" type="text"  id="arrival1" size="5" maxlength="8" style="text-align:center; height: 22px; margin-left: 14px; margin-top:29px;  width:72px;"  value="<?php
                                    if (isset($reserva)) {
                                        echo date("g:i a", strtotime($reserva->arrtime1));
                                    }
                                    ?>" readonly="readonly" />
                                </div>
                            </div>
                        </td>
                        
                    </tr>
                    
                </table>
                    
                    
                <table style="margin-top:18px; margin-left:0px;" align="left" cellspacing="0" border="0">
                    
                    <tr>

                        <td>
                            <div id="opera" class="input">
                                <div><label style="position:absolute; margin-left:0px; margin-top:-20px; color:#FFFFFF;">EXTENSION AREA:</label></div>
                                <div>
                                <select name="ext_from1" id="ext_from1" style='width:287px; height:25px;' >
                                    <option value="0"></option>
                                    <?php foreach ($extenFrom1 as $ex) { ?>
                                        <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion1->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                                    <?php } ?>          
                                </select>

                                </div>
                            </div>                            
                        </td>
                        
                        <td>                            
                            <div id="opera" class="input" > 
                                <div><label style="position:absolute; color:#FFFFFF; margin-left:-14px; margin-top:-20px;">EXTENSION AREA:</label></div>
                                <div>
                                <select name="ext_to1" id="ext_to1" style="width:286.5px; margin-left:-14px; height:25px; margin-top:0px;">
                                    <option value="0"></option>
                                    <?php foreach ($extenTo1 as $ex) { ?>
                                        <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion2->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                                    <?php } ?>
                                </select>

                                </div>
                            </div>                            
                        </td>
                        
                        <td>
                            <div id="opera" class="input">

                                <div><label style="position:absolute; margin-left: -14px; margin-top:-20px; color:#FFFFFF;" >ROOM #</label></div>

                                <div>
                                    <input name="room1" type="text"  id="room1" size="4" maxlength="6" style=" width:72px;  margin-left: -15px; margin-top:-1px; height:22px;" value="<?php echo $reserva->room1; ?>" />
                                </div>

                            </div>
                        </td>
                </tr>

                    
                </table>
                
                <table style="margin-top:7px; margin-left:0px;" align="left" cellspacing="0" border="0">

                    <tr>
                        <td>
                            <div id="opera" class="input"  style="">

                                <div style="width:300px;">  <label style="position:absolute; margin-left: 0px; margin-top: -10px; width:250px;  color:#FFFFFF;"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
                                <div style="width:200px;">
                                    <div class="ausu-suggest" >
                                        <input name="exten1" type="text"  id="exten1" size="46" maxlength="55" style="margin-left: 0px; margin-top: 11px; width:320px;"  value="<?php echo $reserva->pickup_exten1; ?>" <?php
                                        if ($extencion1->id == 0) {
                                            echo ' disabled="disabled" ';
                                        }
                                        ?>  autocomplete="off"/>
                                        <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="opera" class="input" >
                                <div style="width:265px;">  <label style="position:absolute; margin-left: 13px; margin-top: -10px; width:250px;  color:#FFFFFF; "  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                                <!--                    <div style="width:200px;">-->
                                <div class="ausu-suggest" >
                                    <input name="exten2" type="text"  id="exten2" size="47" maxlength="55" style="margin-left: 13px; margin-top: 11px; width:320px;" value="<?php echo $reserva->pickup_exten2; ?>"  <?php
                                    if ($extencion2->id == 0) {
                                        echo ' disabled="disabled" ';
                                    }
                                    ?>  autocomplete="off"/>
                                    <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
                                    <!--                        </div>-->
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                </table>

            </fieldset>
            <!--Estados de Select-->
            <input type="text"  name="estado_one"  id="estado_one"  style="display:none; width:25px;  margin-left: 30px; margin-top:4px;" value="<?php echo $reserva->estado_one; ?>" />
            <input type="text"  name="estado_round"  id="estado_round"  style="display:none; width:25px;  margin-left: 30px; margin-top:4px;" value="<?php echo $reserva->estado_round; ?>" />
            <!--            <fieldset id="round" style="display:none;"><legend><font color="#990000">ROUND TRIP</font></legend>-->
            <fieldset id="round" style="border-radius: 5%;  margin-top:7px; height:310px; padding-top: 13px;  box-shadow: 4px 6px 7px 1px #708090;" class="rojo"><legend style="border:1px solid #B83A36; background:#fff;"><font color="#990000">ROUND TRIP</font></legend>
            
            <table style="margin-top:0px; margin-left:0px;" align="left" cellspacing="0" border="0">                                       

                <tr>  
                        
                    <td>                
                        <div>
        <!--                    class="electric"  #ccff00-->
                            <select   style="position:absolute; border: #000 2px solid; width:177px; margin-left: 18px; margin-top:-4px; font-weight:bold;" id="estado_roundtrip" name="estado_roundtrip" onchange="passenger_balance(); fecha_ns_round();">

                                <optgroup  label="STATUS">

                                    <option  style="font-weight:bold;" value="1">CONFIRMED</option>
                                    <option  style="font-weight:bold;" value="4">CANCELED</option>
                                    <option  style="font-weight:bold;" value="5">CANCELED W/FEE</option>                            
                                    <option  style="font-weight:bold;" value="2">NO SHOW</option>
                                    <option  style="font-weight:bold;" value="3">NO SHOW W/FEE</option>
                                    <option  style="font-weight:bold;" value="6">OPEN W/FEE</option>

                                </optgroup>

                            </select>

                        </div>
                    </td>
                
                    <td>
                        <div class="rojo" style="border: #fff 1.3px solid; width:664px; height:46px; margin-left:7px; margin-top:6px; border-radius: 10px 10px 10px 10px;">
                            <div style="margin-top:3px; margin-left: 24px;">
                                <label id="tarifround" style="position:absolute; margin-left:169px; color:#FFFFFF;">RATE</label>

                            </div>

                            <div>                     
                                  <input type="text" name="tari_round"  id="tari_round" size="10" maxlength="15" style="border: #000 2px solid; background-color: #757575; color:#FFF; text-align:center; width:114px; margin-left:193px; margin-top: 14px; height: 14px; padding-top: 2px;" value="<?php  if($reserva->tarifa_round == '1') { echo 'Standard Price'; } else if($reserva->tarifa_round == '6') { echo 'Special Price'; } else if($reserva->tarifa_round == '0') { echo ''; } else if ($reserva->tarifa_round == '2') {  echo 'Super Flex Price'; } else if ($reserva->tarifa_round == '3') {  echo 'Web Fare Price'; } else if ($reserva->tarifa_round == '4') {  echo 'Super Promo Price'; } else if ($reserva->tarifa_round == '5') {  echo 'Super Discount Price'; }?>" autocomplete="off"/>
                            </div>

                        </div>
                    </td>
                    
                    <td>
                        <div>

                            <div style="margin-top:-42.5px; margin-left: -115px;">
                                <label id="departure_ns2" style="position: absolute; margin-left:-235px; margin-top:44px; color:#FFFFFF;">DEPARTURE</label>
                            </div>

                            <div>

                                <input type="text" name="fec_retorno_ns"  id="fec_retorno_ns" title="(Y - M - D)" size="10" maxlength="15" disabled="disabled" style="border: #000 2px solid; background-color: #757575; color:#FFF; text-align:center; width:84px; margin-left:-350px; height: 13px; padding-top:3px; margin-top: 57px;" value="<?php if($reserva->fecha_retorno_ns == 'N/A') { echo ''; } else {  echo ($reserva->fecha_retorno_ns == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($reserva->fecha_retorno_ns))); } ?>" autocomplete="off"/>

                            </div>

                        </div>
                    </td>
                    
                </tr>
                
            </table>
                
                
            <table style="margin-top:-6px; margin-left:0px;" align="left" cellspacing="0" border="0"> 
                
                <tr>
                    <td>
<!--                        <a href="" id="dataclick2" ><i class="fa fa-calendar fa-2x" style="color: #fff; margin-top:6px; margin-right: 96px;"></i></a>-->
                        <a href="" id="dataclick2" style="position:absolute; margin-left:5px; margin-top:5px;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/calendar2.png' width='25' height='25'></a>                         
                    </td>
                    
                    <td>
                        <div id="opera" class="input">

                            <div><label style="position:absolute; width:75px; color:#FFFFFF; margin-left:28px; margin-top:19px;">DEPARTURE</label></div>
                                
                            <div>
        <!--                   <a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                <input name="fecha_retorno" type="text"  id="fecha_retorno" style="text-align:center; width:87px; margin-top:40px; margin-left:28px; padding-top:2px;" size="10" title="(M - D - Y)" maxlength="15" value="<?php if ($reserva->fecha_retorno == '-N/A-') { echo 'N/S';  }else if($reserva->fecha_retorno == '-N/S W/F-') { echo 'N/S W/FEE'; } else if($reserva->fecha_retorno == '-C W/F-') { echo 'CANC W/FEE'; } else if($reserva->fecha_retorno == '-C-') { echo 'CANC'; } else if($reserva->fecha_retorno == '-OP-') { echo 'OPEN W/FEE'; } else {  if (isset($reserva) && $reserva->tipo_ticket != 'oneway') { echo ($reserva->fecha_retorno == "0000-00-00"?"00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_retorno))); } } ?>" onchange="fechale2();" autocomplete="off" />
                            </div>
                        </div>
                    </td>
                        
                    <td>
                        <div id="opera" class="input" style="" >
                            <div id="explo">  <label style="position:absolute; width:45px; color:#FFFFFF; margin-left: -14px; margin-top:-13px;"> FROM</label></div>
                            <div id="explo" align="left">
                                <select name="fromt2"  style="position:absolute; width:178px; height:25.5px; margin-top:8px; margin-left:-14px;" id="from2" >
                                    <option value=""></option>
                                        <?php foreach ($to_areas as $area) { ?>
                                        <option value="<?php echo $area['trip_to']; ?>"  <?php echo ($area["trip_to"] == $reserva->fromt2 ? 'selected' : '') ?>  >
                                        <?php echo $area['nombre']; ?>
                                        </option>
                                        <?php } ?>

                                </select>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                        <div id="opera" class="input" style=""  >
                            <div id="explo">  <label style="position:absolute; width:45px; color:#FFFFFF; margin-left: 32px; margin-top: 19px;"  > TO</label></div>
                            <div id="explo" align="left">
                                <select name="to2"  id="to2" style="width:177px; height:25px; margin-top:40px; margin-left:30px;" >
                                        <?php foreach ($data["to_areas2"] as $area) { ?>
                                        <option value="<?php echo $area['trip_to']; ?>"  <?php echo ($area["trip_to"] == $reserva->tot2 ? 'selected' : '') ?>  >
                                        <?php echo $area['nombre']; ?>
                                        </option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </td>
                    
                    <td>                        
                        <div id="opera" class="input" style=""  >
                            <div style="width:50px;" id="popup2">  <label style="position:absolute; width:20px; color:#FFFFFF; margin-left: 75px; margin-top: 19px;"  > TRIP</label><a id="search2" onclick="activa_round(); comprobarScreen(); cargando();" style="position:absolute; cursor:pointer;color: #fff; margin-top: 7px; margin-left: 81px;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/search.png' width='25' height='25'></a> 
                                <input type="hidden" id="valorcomision02" name="valorcomision02" value="<?php /* echo $subto['comi2'] */ ?>" />
                            </div>
                            <div style="width:50px;"><input type="hidden" id="trip_no2_c" name="trip_no2_c" style="height: 22px; width:75px;" value="<?php
                                if (isset($reserva)) {
                                    echo $reserva->trip_no2;
                                }
                                ?>"/> <input name="trip_no2" type="text"  style="text-align:center; margin-top:39px; height:22px; width:83px; margin-left: 73px;" id="trip_no2" size="3" maxlength="3" value="<?php
                                                            if (isset($reserva)) {
                                                                echo ($reserva->trip_no2 != 0 ? $reserva->trip_no2 : "");
                                                            }
                                                            ?>"  readonly="readonly"/>
                            </div>
                        </div>
                    <td>
                        
                    <td>                        
                        <div id="opera" class="input"  style="">
                            <div style="width:50px;">  <label style="position:absolute; width:45px;  color:#FFFFFF; margin-top: 19px; margin-left: 91px;"  > DEP.TIME</label></div>
                            <div style="width:50px;">
                                <input name="departure2" type="text" style="text-align:center; height: 22px; margin-top:39px; width:71.5px; margin-left:91px;" id="departure2" size="5" maxlength="8" value="<?php
                                if (isset($reserva)) {
                                    echo ($reserva->deptime2 != "00:00:00" ? date("g:i a", strtotime($reserva->deptime2)) : "");
                                }
                                ?>" readonly="readonly"/>
                            </div>
                        </div>
                    </td>
                    
                </tr>   
                
            </table>
                    
            <table style="margin-top:20px; margin-left:0px;" align="left" cellspacing="0" border="0"> 
                
                <tr>
                
                    <td>
                        
                        <div id="opera" class="input">
                            <div style="width:265px;">  <label style="position:absolute; width:150px; color:#FFFFFF; margin-left:0px; margin-top:-20px;">PICK UP POINT/ADDRESS</label></div>
                            <div style="width:200px;">
                                <div class="ausu-suggest" >
                                    <input name="pickup2" type="text"  id="pickup2" size="40" maxlength="55" value="<?php
                                    if (isset($pickup2) && $pickup2 != "") {
                                        echo $pickup2->place;
                                    }
                                    ?>" autocomplete="off"/>
                                    <input name="id_pickup2" type="hidden"  id="id_pickup2" size="40" maxlength="55" value="<?php
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
                            <div style="width:265px;">  <label style="position:absolute; width:250px; margin-left:8px; margin-top:-20px; color:#FFFFFF;">DROP OFF POINT/ADDRESS</label></div>
                            <div style="width:200px;">
                                <div class="ausu-suggest" >
                                    <input name="dpoff2" type="text" style="margin-left:8px; width: 280px; margin-top: 0px;" id="dropoff2" size="39" maxlength="55" value="<?php
                                    if (isset($drop2) && $drop2 != "") {
                                        echo $drop2->place;
                                    }
                                    ?>" autocomplete="off"/>
                                    <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php
                                    if (isset($drop2) && $drop2 != "") {
                                        echo $drop2->id;
                                    }
                                    ?>" />
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                        <div id="opera" class="input">
                            <div style="width:50px;">  <label style="position:absolute; width:45px;  color:#FFFFFF; margin-left:15px; margin-top:-20px;"  >ARR.TIME</label></div>
                            <div style="width:50px;">
                                <input name="arrival2" type="text" style="height: 22px; margin-left: 14px;  width:72px; margin-top: 0px; text-align: center;" id="arrival2" size="5" maxlength="8" value="<?php
                                if (isset($reserva)) {
                                    echo ($reserva->arrtime2 != "00:00:00" ? date("g:i a", strtotime($reserva->arrtime2)) : "");
                                }
                                ?>" readonly="readonly" />
                            </div>
                        </div>
                    </td>

                </tr>
                
            </table>
                
            <table style="margin-top:21px; margin-left:0px;" align="left" cellspacing="0" border="0"> 
                
                <tr>
                
                    <td>
                        
                        <div id="opera" class="input">
                            <div> <label style="position:absolute; margin-left:-1px; margin-top:-19px; color:#FFFFFF;">EXTENSION AREA:</label></div>
                            <div>
                                <select name="ext_from2" id="ext_from2" style="width:287px; height:25px; margin-left: 0px; margin-top:1px;" >
                                    <option value="0"></option>
                                    <?php foreach ($extenFrom2 as $ex) { ?>
                                        <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion3->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                                    <?php } ?>
                                </select> 
                            </div>   
                        </div>
                    </td>

                    <td>
                            <div id="opera" class="input" >

                                <div> <label style="position:absolute; margin-left:-13px; margin-top:-19px; color:#FFFFFF;">EXTENSION AREA:</label></div>
                                <div>
                                    <select name="ext_to2" id="ext_to2" style="width:286.5px; margin-left:-14px; height:25px; margin-top:1px;">
                                        <option value="0"></option>
                                        <?php foreach ($extenTo2 as $ex) { ?>
                                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion4->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                                        <?php } ?>
                                    </select> 
                                </div>    
                            </div>
                    </td>
                    
                    <td>
                
                            <div id="opera" class="input" >

                                <div><label style="position:absolute; margin-left:-16px; margin-top:-19px; color:#FFFFFF;">ROOM #</label></div>
                                <div>
                                    <input name="room2" type="text" style=" width:72px; margin-left:-16px; margin-top:1px; height:21px;" id="room2" size="4" maxlength="6" value="<?php echo $reserva->room2; ?>" />
                                </div>   
                            </div>
                        
                    </td>
                    
                    
                </tr>
                
            </table>
                
            <table style="margin-top:7px; margin-left:0px;" align="left" cellspacing="0" border="0"> 
                
                <tr>
                    
                    <td>
                        <div id="opera" class="input">
                            <div style="width:300px;">  <label style="margin-left: -1px; margin-top: -7px; width:250px; color:#FFFFFF;">EXTENSION PICK UP POINT/ADDRESS</label></div>
                            <div style="width:200px;">
                                <div class="ausu-suggest" >
                                    <input name="exten3" type="text" style="margin-left: 0px; width: 320px; "  id="exten3" size="46" maxlength="55" value="<?php echo $reserva->pickup_exten3; ?>"   <?php
                                    if ($extencion3->id == 0) {
                                        echo ' disabled="disabled" ';
                                    }
                                    ?> autocomplete="off" />
                                    <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                        <div id="opera" class="input">
                            <div style="width:265px;"><label style=" margin-left: 12px; margin-top: -7px; width: 310px;  color:#FFFFFF;"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                            <div style="width:200px;">
                                <div class="ausu-suggest" >
                                    <input name="exten4" type="text"  style="margin-left: 13px; width: 320px; " id="exten4" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten4; ?>"  <?php
                                    if ($extencion4->id == 0) {
                                        echo ' disabled="disabled" ';
                                    }
                                    ?>  autocomplete="off" />
                                    <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value="" />
                                </div>
                            </div>
                        </div>
                    </td>
                    
                </tr>
                
            </table>
                
            </fieldset>
<!--            <table width="246" cellspacing="0" class="sup2" style="margin-top: 2px;">-->
            <table class="" border="1" width="256" height="205" cellspacing="0" class="sup2" style="background-color:#FFFFFF; margin-top:-20px; box-shadow: 0 -1px 20px #1E9196;">
                <tr class="blackblue">

<!--                    <td width="136" style="text-align:center; color:#fff; font-size: 14px; font-weight:bold;"><label><strong>QUOTE</strong></label></td>
                    <td width="54"  style="text-align:center; color:#fff; font-size: 14px; font-weight:bold;"><label style="color:#4B0082;"><strong>ADULT</strong></label></td>
                    <td width="48"  style="text-align:center; color:#fff; font-size: 14px; font-weight:bold;"><label style="color:#4B0082;"><strong>CHILD</strong></label></td>
                    -->
                    <td width="136" style="text-align:center; color:#fff; font-size: 14px; font-weight:bold;" ><label><strong>QUOTE</strong></label></td>
                    <td width="54"  style="text-align:center; font-size: 14px; font-weight:bold;"><label style="color:#fff;"><strong>ADULT</strong></label></td>
                    <td width="48"  style="text-align:center; font-size: 14px; font-weight:bold;"><label style="color:#fff;"><strong>CHILD</strong></label></td>
                </tr>
                <tr>
                    <td><label style="font-size: 14px; font-weight:bold; float:right; color:#4B0082;"><strong>Line Transportation</strong></label></td>
                    <td style="text-align:center; color:blue;"><span name ="transporadult" id="transporadult" value="" style="font-size: 15px; font-weight:bold;"></span></td>
                <input type="hidden" name ="transadult" id="transadult"/>
                <input type="hidden" name ="transchild" id="transchild"/>
                <td style="text-align:center; color:blue;"><span name ="transporechil" id="transporechil" style="font-size: 15px; font-weight:bold;"></span></td>
                </tr>
                <tr>
                    <td><label style="float:right; color:#4B0082; font-size: 14px; font-weight:bold; "><strong>Extensions</strong></label></td>
                    <td style="text-align:center; color:red;"><span id="extenadult" style="font-size: 15px;font-weight:bold; "></span></td>
                    <td style="text-align:center; color:red;"><span id="extenchil" style="font-size: 15px;font-weight:bold; "></span></td>
                </tr>

                <tr>
                    <td><label style="float:right; color:#4B0082; font-size: 14px; font-weight:bold;"><strong>Sub-total per Pax</strong></label></td>                 

                    <td style="text-align:center; color:#4B0082;"><span id="subtoadult" style="font-size: 15px; font-weight:bold; "></span></td>
                    <td style="text-align:center; color:#4B0082;"><span id="subtochild" style="font-size: 15px; font-weight:bold; "></span></td>

                </tr>
                <tr>
<!--                    <td><label style="text-align: center; color:#fff; font-size: 16px; font-weight:bold;" ><strong>TOTAL</strong></label></td>
                    <td style="text-align:center;" colspan="2"><label style="color:#fff;"><strong   id="totaltotal" style="font-size: 18px; font-weight:bold; " >$ 00.0</strong></label></td>-->

                    <td  style="float:center; text-align: center; color:#4B0082; font-size: 16px; font-weight:bold;"><label><strong>TOTAL&nbsp;</strong></label></td>
<!--                    <td style="text-align:center;" colspan="2"><label style="color:#4B0082;"><strong id="totaltotal" style="font-size: 18px; font-weight:bold; ">$ 00.0</strong></label></td>-->
                    <td style="text-align:center;" colspan="2"><label style="color:#4B0082; font-size: 18px; font-weight:bold;">$<strong id="totaltotal" style="font-size: 18px; font-weight:bold; ">$ 00.0</strong></label></td>
                    

                <div id="enviarDatos"></div>

                <!--Standard Price Trip No 1-->

                <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" title="subtoadult1 standard price adult trip1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild1" name="subtochild1" title="subtochild1 standard price child trip1" value="<?php echo $reserva->precio_trip1_c; ?>" /><br>

                <!--SuperFlex Trip No1-->
                <input size="5" type="hidden" id="subtoadult22" name="subtoadult22" title="subtoadult22 Super Flex price adult trip1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild22" name="subtochild22" title="subtochild22 Super Flex price child trip1" value="<?php echo $reserva->precio_trip1_c; ?>" /><br>
                
                <!--Web Fare Trip No1-->
                <input size="5" type="hidden" id="subtoadultwf1" name="subtoadultwf1" title="subtoadultwf1 Web Fare price adult trip1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochildwf1" name="subtochildwf1" title="subtochildwf1 Web Fare price child trip1" value="<?php echo $reserva->precio_trip1_c; ?>" /><br>
                
                <!--Super Promo Trip No1-->
                <input size="5" type="hidden" id="subtoadultsp1" name="subtoadultsp1" title="subtoadultsp1 Super Promo price adult trip1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochildsp1" name="subtochildsp1" title="subtoadultsp1 Super Promo price child trip1" value="<?php echo $reserva->precio_trip1_c; ?>" /><br>
                
                <!--Super Discount Trip No1-->
                <input size="5" type="hidden" id="subtoadultsd1" name="subtoadultsd1" title="subtoadultsd1 Super Discount price adult trip1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochildsd1" name="subtochildsd1" title="subtochildsd1 Super Discount price chils trip1" value="<?php echo $reserva->precio_trip1_c; ?>" /><br>
                

                <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="<?php echo $reserva->precio_exten1_a; ?>" />
                <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="<?php echo $reserva->precio_exten2_a; ?>" />
                <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="<?php echo $reserva->precio_exten3_a; ?>"  />
                <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="<?php echo $reserva->precio_exten4_a; ?>" />


                <!--Standard Price Trip No 2-->
                <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" title="subtoadult2 standard price adult trip2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochild2" name="subtochild2" title="subtochild2 standard price child trip2" value="<?php echo $reserva->precio_trip2_c; ?>" /><br>

                <!--SuperFlex Trip No2-->
                <input size="5" type="hidden" id="subtoadult4" name="subtoadult4" title="subtoadult4 super Flex price adult trip2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochild4" name="subtochild4" title="subtochild4 super Flex price child trip2" value="<?php echo $reserva->precio_trip2_c; ?>" /><br>
                
                
                <!--Web Fare Trip No1-->
                <input size="5" type="hidden" id="subtoadultwf2" name="subtoadultwf2" title="subtoadultwf1 Web Fare price adult trip2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochildwf2" name="subtochildwf2" title="subtochildwf1 Web Fare price child trip2" value="<?php echo $reserva->precio_trip2_c; ?>" /><br>
                
                <!--Super Promo Trip No1-->
                <input size="5" type="hidden" id="subtoadultsp2" name="subtoadultsp2" title="subtoadultsp1 Super Promo price adult trip2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochildsp2" name="subtochildsp2" title="subtoadultsp1 Super Promo price child trip1" value="<?php echo $reserva->precio_trip2_c; ?>" /><br>
                
                <!--Super Discount Trip No1-->
                <input size="5" type="hidden" id="subtoadultsd2" name="subtoadultsd2" title="subtoadultsd1 Super Discount price adult trip2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochildsd2" name="subtochildsd2" title="subtochildsd1 Super Discount price chils trip2" value="<?php echo $reserva->precio_trip2_c; ?>" /><br>


                <input size="5" type="hidden" id="subtoadult1_o" name="subtoadult1_o" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild1_o" name="subtochild1_o" value="<?php echo $reserva->precio_trip1_c; ?>" />
                <input size="5" type="hidden" id="subtoadult2_o" name="subtoadult2_o" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochild2_o" name="subtochild2_o" value="<?php echo $reserva->precio_trip2_c; ?>" />                
                <input size="5" type="hidden" id="price_exten01_o" name="price_exten01_o" value="<?php echo $reserva->precio_exten1_a; ?>" />
                <input size="5" type="hidden" id="price_exten02_o" name="price_exten02_o" value="<?php echo $reserva->precio_exten2_a; ?>" />
                <input size="5" type="hidden" id="price_exten03_o" name="price_exten03_o" value="<?php echo $reserva->precio_exten3_a; ?>"  />
                <input size="5" type="hidden" id="price_exten04_o" name="price_exten04_o" value="<?php echo $reserva->precio_exten4_a; ?>" />


                <input size="5" type="hidden" id="price1" name="price1" value="<?php echo $reserva->id1; ?>" /><br>
                <input size="5" type="hidden" id="price2" name="price2" value="<?php echo $reserva->id2; ?>" /><br>

                </tr>
                
                <input type="text" name="fec_salida_ns1"  id="fec_salida_ns1"  size="10" maxlength="15"  style="display:none;" value="" autocomplete="off"/>
                <input type="text" name="fec_retorno_ns1"  id="fec_retorno_ns1"  size="10" maxlength="15"  style="display:none;" value="" autocomplete="off"/>
                
                 <!--<tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;
                        </td>
                    <td colspan="2">&nbsp;
            
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
            
                        </td>
                    <td colspan="2">&nbsp;
                        </td>
                </tr>
                <tr>
                    <td>&nbsp;
                        </td>
                    <td colspan="2">&nbsp;
            
            
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
            
                        </td>
                    <td colspan="2">&nbsp;
                        </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
            
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>-->

            </table >

            <!--            <fieldset id="pymen" style="height:375px;" ><legend >PAYMENT INFORMATIONS brown4</legend>-->
            <fieldset id="pymen" style="margin-top:8px; height:403px; border-radius: 5%;" class="super" ><legend style="border:1px solid #00C; background:#fff" >PAYMENT INFORMATIONS</legend>
                <input type="hidden" value="0" id="totalcom" name="totalcom">
                <table width="100%">
                    <tr><td>
                            <div id="opera" class="input" style="padding-top:5px; width:450px;">
                                <table width="100%" id="tr_complementary"  style="display:
                                <?php
                                if ($agencia->id == -1) {
                                    echo 'block';
                                } else {
                                    echo 'none';
                                }
                                ?>;display:none;" ><tr>
                                        <td width="2%">
                                            <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio"  <?php echo ($typo_pago == strtoupper('Complementary')) ? ' checked ' : ''; ?>    ></td>
                                        <td width="20%"><label for="opcion_pago_complementary">Complementary</label></td>
                                    </tr></table>
                                <table width="100%" height="125" id="tableorder" style="display:none;">
                                    <tr>
                                        <td  colspan="3" width="34%" height="" align="center"  >
                                            <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                            <table width="100%" align="center" id="tableTypeSaldo"
                                                   style="display:
                                                   <?php
                                                   if ($agencia->id != -1 && $agencia->type_rate == 0) {
                                                       echo 'block';
                                                   } else {
                                                       echo 'none';
                                                   }
                                                   ?>;" >
                                                <tr>
                                                    <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION</strong></td>
                                                </tr>

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td width="2%">
                                                        <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio"  <?php echo ($typo_saldo == 'FULL') ? ' checked ' : ''; ?> ></td>
                                                    <td width="20%">Paid Full</td>
                                                    <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" <?php echo ($typo_saldo == 'BALANCE') ? ' checked ' : ''; ?>   type="radio"></td>
                                                    <td width="20%">Paid Balance</td>
                                                    <td>&nbsp;</td>
                                                <tr>
                                                <tr><td colspan="6"><hr /></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong></td>
                                        <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong></td>
                                        <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong></td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td valign="top"  >
                                            <table style="width:160px;">
                                                <tr>
                                                    <td colspan="2"></td>
                                                </tr>

<!--                                <tr id="tipo_passager">
         <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio"  <?php echo ($typo_pago == strtoupper('Passenger Credit Card')) ? ' checked ' : ''; ?>  ></td>
         <td width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Passenger Credit Card</label></td>

     </tr>
     <tr id="tipo_agency" style="" >
         <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"   <?php echo ($typo_pago == strtoupper('Agency Credit Card')) ? ' checked ' : ''; ?>   ></td>
         <td width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Agency Credit Card</label></td>
     </tr>
     <tr id="tipo_predpaid_cash" style="">
         <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" <?php echo ($typo_pago == strtoupper('Cash in terminal')) ? ' checked ' : ''; ?>   ></td>
         <td width="" align="left" id=""> <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="opcion_pago">Cash in terminal </label></td>
     </tr>-->

<!--                                <tr id="tipo_passager">
         <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" <?php echo ($typo_pago == strtoupper('Credit Card') || $typo_pago == strtoupper('Passenger Credit Card')) ? ' checked ' : ''; ?>  ></td>
         <td width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
     </tr>
     <tr id="tipo_agency" style="" >
         <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"   <?php echo ($typo_pago == strtoupper('Agency Credit Card')) ? ' checked ' : ''; ?>   ></td>
         <td width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
     </tr>
     <tr id="tipo_predpaid_cash" style="">
         <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" <?php echo ($typo_pago == strtoupper('Cash in terminal')) ? ' checked ' : ''; ?>   ></td>
         <td width="" align="left" id=""> <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="opcion_pago">Cash in terminal </label></td>
     </tr>-->
                                                <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" class="opcion_pago" <?php echo ($typo_pago == strtoupper('Passenger Credit Card') || $typo_pago == strtoupper('Credit Card')) ? ' checked ' : ''; ?>></td>
                                                    <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                                </tr>
                                                <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio" class="opcion_pago" <?php echo ($typo_pago == strtoupper('Agency Credit Card')) ? ' checked ' : ''; ?>></td>
                                                    <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                                </tr>
                                                <tr id="tipo_passager_3" style="height:20px;width:160px; display:block">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" class="opcion_pago" <?php echo ($typo_pago == strtoupper('Cash in terminal')) ? ' checked ' : ''; ?>></td>
                                                    <td nowrap="nowrap" > <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash</label></td>
                                                </tr>
                                                <tr id="tipo_passager_4" style="height:20px;width:160px; display:block">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_check"  value="10" agencypago="true" type="radio" class="opcion_pago"></td>
                                                    <td nowrap="nowrap" > <label id="label_tipo_predpaid_check" for="opcion_pago_predpaid_check" class="">Check</label></td>
                                                </tr>

                                            </table>
                                        </td>
                                        <td valign="top">
                                            <table style="width:160px;" >
                                                <tr>
                                                    <td colspan="2"></td>
                                                </tr>
                                                <!--<?php if ($agen_account['opcion3'] != 0) { ?>
                                                                                                                                                                                                    <tr id="tipo_CrediFee">
                                                                                                                                                                                                        <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio"    <?php echo ($typo_pago == strtoupper('Credit Card+ 4 % FEE')) ? ' checked ' : ''; ?>   ></td>
                                                                                                                                                                                                        <td align="left" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card+ 3 % FEE</label></td>
                                                                                                                                                                                                    </tr>
                                                <?php } ?>
                                                <?php if ($agen_account['opcion4'] != 0) { ?>                                                                                                                                                                                                                                              <tr id="tipo_Cash">
                                                                                                                                                                                                                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio"  <?php echo ($typo_pago == strtoupper('Cash')) ? ' checked ' : ''; ?>  ></td>
                                                                                                                                                                                                                                                    <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                                <?php } ?>
                                                </tr>-->
                                                <tr id="tipo_passager_2" style="">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_passager_2"  value="8" agencypago="true" type="radio" class="opcion_pago" ></td>
                                                    <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager_2" for="opcion_pago_passager_2" class="opcion_pago">Credit Card no fee</label></td>
                                                </tr>
                                                <tr id="tipo_CrediFee">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio" class="opcion_pago" <?php echo ($tipo_pago == strtoupper('Credit Card+ 4 % FEE')) ? ' checked ' : ''; ?>></td>
                                                    <td align="left"  nowrap="nowrap" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card with fee</label></td>
                                                </tr>
                                                <tr id="tipo_Cash">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio" class="opcion_pago" <?php echo ($tipo_pago == strtoupper('Cash')) ? ' checked ' : ''; ?>></td>
                                                    <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                                </tr>
                                                <tr id="tipo_Cash_2">
                                                    <td width="5"><input name="opcion_pago" id="opcion_pago_Cash_2" value="9" type="radio" class="opcion_pago"></td>
                                                    <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash_2" class="opcion_pago">Check</label></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="left" valign="top" >
                                        <?php if ($agen_account['opcion5'] != 0) { ?>
                                                <div id="tipo_Voucher" style="">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"   <?php echo ($typo_pago == strtoupper('Credit Voucher')) ? ' checked ' : ''; ?> >
                                                            </td>
                                                            <td>
                                                                <label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                                <!--Aqui-->
                                <div id="opera" class="input" style="width: 525px; margin-top:-73px; margin-left:-5px;">
                                    <table>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                        <!--                                <td style="width:50px">  &nbsp;
                                                            <a id="enviarF" style="display:none" ><img src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                                        </td>-->
                                                        <td style="width:60px;">
                                                            &nbsp;
<!--                                                            <a id="btn-save2" title="Save"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>-->

<!--                                                            <input type="button" style="display:none" id="enviar_escondido" value="0"  />
                                                            <a  id="pago_agente" style="display:block" ><img style="width: 77px; margin-left:3px;  margin-top: 164px;cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>-->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td>
<!--                                                <table style="margin-left:-8px; filter: alpha(opacity=35); background-color: #a4a4a4; height: 5px; -moz-opacity: 0.3; opacity: 0.3; -khtml-opacity: 0.3;" border="0" width="446" align="center">
                                                    <tbody>
                                                    <tr>
                                                    <td> </td>
                                                    </tr>
                                                    </tbody>
                                                    </table>-->


                                                <table>
                                                    <tr>
                        <!--                                <td >
                                                    <?php if ($agencia->id != -1 && $agencia->type_rate != 0) { ?>
                                                                                                                                                                                                            <label  style="padding-left:20px; font-size:11px; "><strong style="padding-bottom:10px;" >Agency Comision	$ </strong></label>
                                                                                                                                                                                                        </td>-->
                                                                                                                                                                        <!--                                <td>
                                                                                                                                                                                                            <label id="totalComision" ></label>
                                                                                                                                                                                                            <br />
                                                    <?php } ?>
                                                        </td>-->
                                                    </tr>
                                                    <tr>
                                                        <td>
<!--                                                            <label  style="padding-left:22px; font-size:16px; color:#4B0082; "><strong style="padding-bottom:10px;">TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ </strong></label>-->
                                                        </td>
                                                        <td>
                                                            <!--                                                            <label  style="font-size:16px; padding-left:3px; font-weight:bold;" id="totalPagar" ></label>-->
                                                            <!--                                                            <font  style="float: left; height:23px; text-align: center;border: #AC1B29 solid thin; background-color: #AC1B29; width: 104px; margin-top:3px; font-size:22px; padding-left:3px; font-weight:bold; color:#fff;" id="totalPagar" ></font>
                                                                                                                        <input name="totP" type="hidden"  id="totP" value="" />-->
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td>
<!--                                                            <label  style="padding-left:21px; font-size:14px; margin-top: 6px; "><strong style="padding-bottom:0px; color:#090;">Total Amount Paid</strong></label>-->
                                                        </td>
                                                        <td>
<!--                                                            <label id="saldoPagado" <strong style="font-size:16px; padding-left:20px;" >$  <?php echo number_format($pagado, 2, '.', ','); ?></strong></label>-->
                                                            <br />
                                                        </td>
                                                    </tr>
<!--                                                    <td>&nbsp;</td>-->
                                                    <tr style=" height:35px;">
                                                        <td>
<!--                                                            <label  style="padding-left:20px; font-size:12px; "><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#F00">Amount to Collect </strong></label>-->
                                                        </td>
<!--                                                        <td><select name="opcion_pago" id="op_pago_id" style="margin-left:10px;">
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
                                                            <label style="font-family: Verdana, Geneva, sans-serif; color:#4B0082; font-size: 16px; font-weight: bold; margin-left:14px;    margin-top: -4px;" id="saldoporpagar" >$  <?php echo number_format(($saldoxPagar), 2, '.', ','); ?></label>
                                                                                                                        <label style="font-family: Verdana, Geneva, sans-serif; color:#4B0082; font-size: 16px; font-weight: bold; margin-left:27px;    margin-top: -5px;" id="" >$  </label>
                                                            <br />
                                                        </td>-->
                                                    </tr>
<!--                                                    <td>&nbsp;</td>-->

                                                    <tr id="tr_otheramount"   ><td>
<!--                                                            <label  style="padding-left:20px; width:146px; font-size:16px; color:#4B0082;"><strong style="padding-bottom:10px;">Other Amount&nbsp;$</strong></label>	</td>-->
                                                        <td>
<!--                                                            <input type="text" id="otheramount" name="otheramount" style="text-align: center;font-size: 22px; float:left;width:100px; font-weight:bold; font-family:Verdana, Geneva, sans-serif; color: #fff;border: #AC1B29 solid thin; background-color: #AC1B29; width: 104px;float:left;width:106px; font-weight:bold; font-family:Verdana, Geneva, sans-serif; color:fff;"" value="<?php echo number_format($reserva->otheramount, 2, '.', ','); ?>" onkeyup="CalcularTotalTotal();"  />-->
<!--                                                             <input type="text" id="otheramount" name="otheramount" style="text-align: center;font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #AC1B29; width: 104px;float:left;width:106px; font-weight:bold; font-family:Verdana, Geneva, sans-serif; color:fff;" value="" onkeyup="CalcularTotalTotal();"  />-->
                                                        </td>
                                                    </tr>
<!--                                                    <td>&nbsp;</td>-->
<!--                                                    <tr id="pay_amount_html" style="height: 50px;">
                                                        <td>
                                                            <label  style="padding-left:22px; font-size:16px;color:#4B0082;"><strong style="padding-bottom:10px;">Add Payment&nbsp;&nbsp;$ </strong></label>
                                                        </td>
                                                        <td>
                                                            <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; text-align: center;font-size: 22px;font-weight: bold;color: #fff;border: 1px #33F solid; background-color: #00f; padding-left:5px; width:100px; height:20px;float:left; margin-top:4px;" />
                                                            <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:100px; height:20px;float:left;" />
                                                            <select name="opcion_pago_2" style="margin-left:10px; margin-top: -20px;">
                                                                <optgroup label="PRED-PAID">
                                                                    <option value="2">Credit Card no fee</option>
                                                                    <option value="1">Credit Card with fee</option>
                                                                    <option value="6">Cash</option>
                                                                    <option value="10">Check</option>
                                                                </optgroup>
                                                                <optgroup label="COLLECT ON BOARD">
                                                                    <option value="8">Credit Card no fee</option>
                                                                    <option value="3">Credit Card with fee</option>
                                                                    <option value="4">Cash</option>
                                                                    <option value="9">Check</option>
                                                                </optgroup>

                                                            </select>
                                                        </td>
                                                    </tr>-->
                                                </table>
                                            </td>
                                            <td>
                                                <div id="estadoTranssacion">

                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </td>



                        <td>


                        </td>


                    </tr>
                    <tr>
                        <td colspan="2">

                        </td>
                    </tr>
                </table>
                </td>
                </tr>


                <input type="text" id="bal_duep" name="bal_duep"    value="0.00"  style="display:none; border: 1px #33F solid; margin-top: -58px;  margin-right: -123px; text-align: right; height: 25px; font-size: 22px; width:106px;" autocomplete="off" />
                
                <table class="oliveti" style="width: 39%; border: 2px solid #000; margin-left: 10px; margin-top: -7px; height: 159px;">
                    <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius: 25px 0px 0px 0px; border: 2px #000 solid;">Passenger Payment Information</caption>


                    <tr  style=" height:33px; width:180px; ">

                        <td style="width: 700px; margin-top:-49px; ">
                            <label  style="padding-left:92px; font-size:16px;"><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#000;">Amount to Collect&nbsp;$</strong></label>
                        </td>
                        <td>
                            <input type="text" id="saldoporpagar" name="saldoporpagar" class="verd"  value="" style="font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; margin-top: 0px; margin-right:6px; text-align:right; width: 106px;" onKeyUp="dupliac(); ponDecimales(2);"  onkeypress="return soloNumeros(event); "  autocomplete="off" />             
                        </td>
                    </tr>


                    <tr style="height:33px; width: 700px; " >
                        <td>

                            <label  style=" padding-left:77px; font-size:16px; margin-left: 68px; margin-top: -53px; "><strong style="padding-bottom:10px; color:#000;">Paid Driver&nbsp;$</strong></label>
                        </td>
                        <td>

                            <input type="text" id="saldoPagado" class="brown2" style="display:none; font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:23px; margin-left: -22px; width: 83px;" value="<?php echo number_format($pagado, 2, '.', ''); ?>" onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();"  />

                            <input autocomplete="off" readonly="readonly" type="text" id="paid_driver" name="paid_driver" class="brown3"   style="text-align: right; height: 24px; font-size: 22px;font-weight: bold;color: #000; border: #33F solid thin; margin-top: -3px; margin-right:6px; width: 104px; float:left; width:106px; font-weight:bold; color:#000;" value="<?php echo number_format($reserva->paid_driver, 2, '.', ''); ?>" onKeyUp="CalcularTotalTotal();" onclick="valida_pago(this,'one');" />
                            <input  type="text" id="paid_driverp" name="paid_driverp" style="display:none;" value=""  />

                        </td>
                    </tr>

                    <tr style="height:33px; width: 700px; " >
                        <td>
                            <label  style=" padding-left:77px; font-size:16px; margin-top: -30px; margin-left: -29px;"><strong id="Passenger_Balance_Due" style="padding-bottom:10px; color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                        </td>

                        <td>
                            <!--<?php /*echo number_format($reserva->passenger_balance_due, 2, '.', '');*/?>-->
                            <input type="text" name="balance_due" id="balance_due" class="ama2"  readonly="readonly" style="border: 1px #33F solid; margin-top: -1px; margin-right:6px; text-align: right; height: 25px; font-size: 22px; font-weight:bold; width:106px;" value=""  autocomplete="off" />
                            <input  type="text" name="balance_duep" id="balance_duep"  style="display:none;" value=""  />

                        </td>
                    </tr>



                </table>


                <table class="oliveti" style="width: 39%; border: 2px solid #000; margin-left: 10px; margin-top: 6px; height: 170px; ">

                    <caption class="cerati" style="  font-weight:bold; font-size:16px; color:#fff; border: 2px #000 solid;">Agency Payment Information</caption>

                    <tr style="height:3px; width: 700px;">
                        <td>
                            <b style="display:none; font-size: 18px; margin-left: 3px; ">Agency Request to Collect&nbsp;$</b>
                        </td>
                        <td>
                            <input type="text" id="otheramount" name="otheramount"  style="display:none; margin-top: 2px; margin-left: 10px; text-align: center; height: 25px; font-size: 22px; font-weight: bold; color: #000;border: #AC1B29 solid thin; width: 103px; float:left; width:106px; font-weight:bold; color:fff; border: 1px #33F solid;" value="<?php echo $reserva->otheramount; ?>" onkeyup="CalcularTotalTotal();ClkPay_Amount();" onclick="valida_pago(this,'one');" autocomplete="off" />
                            <input type="text" name="otheramountp" id="otheramountp" value="0.00"  style="display:none; margin-left: 366px; margin-top: -252px; padding-left:5px; width:160px; height:25px;  border: 1px solid #000;" autocomplete="off"  />

                        </td>
                    </tr>    
                    <tr style="height:33px; width: 700px;">
                        <td>
                            <b style="font-size: 16px; padding-left: 124px; margin-top:3px;">Total Net Fare&nbsp;$</b>
                        </td>
                        <td>
                            <!--                            <font  class="orangered" style=" height:25px; text-align: right; float: right; border: 1px #33F solid; width: 106px; margin-top:-8px;  margin-right: 6px; font-size:22px; font-weight:bold; color:#fff;" id="totalPagar" ></font>-->
                            <input type="text" id="totalPagar" name="totalPagar" class="orangered" style="height:25px; text-align: right; float: right; border: 1px #33F solid; width: 106px; margin-top:-8px;  margin-right: 6px; font-size:22px; font-weight:bold; color:#fff;" value="" disabled="disabled" autocomplete="off" />
                            <input type="hidden" name="totP" id="totP" value="" /> 

                        </td>
                    </tr>
                    <tr id="pay_amount_html" style="height: 33px; width: 700px;">
                        <td>
                            <b style=" color:#000;font-size: 16px; margin-left:101px;">Amount Pre-Paid&nbsp;$</b>                                       
                        </td>
                        <td>
                            <input type="text" name="pay_amount" id="pay_amount" readonly="readonly" class="azu" value="<?php echo number_format($reserva->pred_paid_amount, 2, '.', ''); ?>"  onKeyUp="CalcularTotalTotal();" style="margin-top:-10px; margin-left: 2px; width: 106px; height:25px;  text-align: right; font-size: 22px; font-weight: bold; color: #000; border: 1px #33F solid;" onclick="valida_pago2(this,'two')" autocomplete="off"/>
                            <input type="text" id="pay_amountp" name="pay_amountp" style="display:none;" value="" />
                        </td>
                    </tr>


                    <tr style="height:33px; width: 700px;">
                        <td>
                            <b style="padding-left:123px;"><strong style="margin-left:-33px; color:#000;font-size: 16px; font-weight:bold;">Total Amount Paid&nbsp;$</strong></b>                                         
                        </td>
                        <td>
                            <input type="text" name="tot_amount_paid" id="tot_amount_paid" class="verdefos3"   value="<?php echo number_format($reserva->total_paid, 2, '.', ''); ?>"  style="text-align: right; border: 1px #33F solid; width:106px; margin-top:-10px; margin-left: 1px;  height: 25px; font-size: 22px; font-weight: bold;" readonly="readonly" autocomplete="off"/>
                            <input type="text" id="tot_amount_paidp" name="tot_amount_paidp" style="display:none;" value="" />
                        </td>


                    </tr>  

                    <tr style="height:33px; width: 700px;">
                        <td>
                            <b style="padding-left:123px;"><strong style="margin-left:-51px; color:#000;font-size: 16px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>                                         
                        </td>
                        <td>
                            <input type="text" name="agency_balance_due" id="agency_balance_due" class="roge"  value=""  style="text-align: right; border: 1px #33F solid; margin-top:-8px; margin-left: 1px; height: 25px; font-size: 22px; width:106px; font-weight: bold;" readonly="readonly" autocomplete="off"/>
                        </td>


                    </tr>  



                    <div>
                        <input title="Add Payment" class="button_sliding_bg" type="button" id="pay_driver" name="pay_driver" onclick="mostrarVentana2();" style="position:absolute; border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px; margin-left: 386.2px; margin-top: -93px; height: 26px; cursor:pointer; color: #fff; font-weight: 700; width: 156px;  padding: 3px; padding-left: 2px;" value="Add Payment"/>
                    </div>

                    <table width="100%" style="position:absolute; background-color: transparent; margin-top: -373px;; margin-left:547px; height:175px; width:180px;">
             
                        <tr>
                            <td style="margin-left:1px; margin-top:0px;">

                    
                            <div id="miVentana2" style="position: absolute; width: 175px; height: 169px; top:0px; left: 0px;  font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none; ">

                                <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

        <!--    <label  style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color: #000; margin-left:-55px;">$</strong></label> -->
                                <p>
                                    <label  id="tap" style="padding-left:57px; font-size:10px; "><strong style="padding-bottom:10px; color:#090; margin-left:-50px;">Total Amount Paid $</strong></label> 
                                    <input type="text" id="saldoPagado" name="saldoPagado" readonly="readonly" style="text-align: right; font-family: sans-serif; font-size: 10px; color:#090; font-weight: bold; padding-left:4px; margin-left: 126px; margin-top: -16px; width: 38px;" value="<?php echo number_format($pagado, 2, '.', ''); ?>"  />
                                </p>

                                <label  id="dolares" name="dolares" style="padding-left:39px; font-size:16px; "><strong style="padding-bottom:10px; color:#006394; ">$</strong></label> 

                                <!--class="money"-->
                                <!--ponDecimales(2);-->
                                <input type="text" id="pago_driver" name="pago_driver" size="12" style="font-size: 22px; font-weight:bold; text-align:right; margin-top:-21px; margin-left:54px; width:114px; height:20px;" value="" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago(); ponDecimales(2);" placeholder="0.00" autocomplete="off"/>

                                <input type="text" id="pago_driver2" name="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

                                <input type="text" id="temp"  name="temp" title="Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($reserva->total_charge, 2, '.', ''); ?>" />

<!--                                <input type="text" id="temp_driver"  name="temp_driver" title="Temp Driver" size="12" style=" margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
                                
                                <input type="text" id="temp_prepaid"  name="temp_prepaid" title="Temp Prepaid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
                                -->
                                
                                <input type="text" name="tempwf"  id="tempwf" title="temp W/Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo $cargos; ?>" />
                                <input type="text" name="tempppwf"  id="tempppwf" title="temp prepaid W/Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo $cargospp; ?>" />
                                
                                
<!--                                <input type="text" id="collect" name="collect" title="Paid Driver" size="12" style=" margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($reserva->paid_driver, 2, '.', ''); ?>" />

                                <input type="text" id="prepaid" name="prepaid" title="Amount Paid" size="12" style="display:none;  margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($reserva->pred_paid_amount, 2, '.', ''); ?>" />
-->


        <!--    <input name="someTextBox" type="text" id="someTextBox" size="12" style="display:none; margin-top:9px; margin-left:27px; width:114px; height:20px;" value="0.00" />-->


                                <select name="opcion_pago1" id="op_pago_id1" style="margin-left:9px; margin-top: 8px;" disabled= "disabled" onclick="calculos();">
                                    <option style="color:red;" id="" value="0">((( Amount Paid )))</option>
                                    <optgroup label="PRE-PAID">
                                        <option value="20">Credit Card NO Fee</option>
                                        <option value="21">Credit Card with Fee</option>
                                        <option value="22">Cash</option>
                                        <option value="23">Check</option>
                                    </optgroup>
                                    <option style="color:blue;" id="" value="1">((( Paid Driver )))</option>
                                    <optgroup label="COLLECT ON BOARD">
                                        <option value="24">Credit Card NO Fee</option>
                                        <option value="25">Credit Card with Fee</option>
                                        <option value="26">Cash</option>
                                        <option value="27">Check</option>
                                    </optgroup>       


                                </select>

                                <div class="paymentvertblack" style="padding: 9px;  text-align: center; margin-top: 9px;">

<!--                                <input type="button" id="btnExit" name="btnExit" onclick="Exit();" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:1px; width:43px; font-weight: 700;" size="20"  value="Exit"  />
                                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="resetal();reset2();" style="background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; font-weight: 700;"  size="20" value="Reset"  />
                                    <input type="button" id="btnAceptar" name="btnAceptar" size="20" value="Save"  style="border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; font-weight: 700;" onclick="ocultarVentana2();" disabled="true" />-->
                                    <div>
                                        <input type="button" id="btnExit" name="btnExit" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" onclick="Exit();"  />
                                    </div>

                                    <div>
                                        <input type="button" id="btnCancelar" name="btnCancelar" style=" background-color: grey; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px;"  size="20" disabled="true"  value="CANCEL" onclick="resetal(); reset2();"  />
                                    </div>

                                    <div>
                                        <input type="button" id="btnAceptar" name="btnAceptar"  size="20" value="SAVE"  style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; width:68px; height: 24px; font-size:9px; font-weight: bold; margin-left: 98px; margin-top: -24px;" onclick="ocultarVentana2();" disabled="true" />
                                    </div>

                                    <div>    
                                        <input type="button" id="btnPagolinea" name="btnPagolinea"  size="20" value="MAKE CHARGE"  style=" display:none; border-color: palegreen; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:2px; width:68px; height: 24px; font-weight: bold; margin-right: -100px; margin-top: -24px; font-size:8px;  color:#fff; background-color:#006400;" onclick="" disabled="true" />
                                    </div>

                                    <div>
                                        <input type="button" id="btndecline" name="btndecline"  size="20" value="CANCEL"  style=" display:none; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff; background-color:red;" onclick="cancelar();" disabled="true" />
                                    </div>

                                    <div>
                                        <input type="button" id="btncancol" name="btncancol"  size="20" value="CANCEL"  style="display:none; background-color:red; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff;" onclick="cancelar_collect_on_board();" disabled="true" />
                                    </div>

                                    
                                </div>

                            </div> 
                            
                       </td>            
                </tr>
                
            </table>
                   



                <img class="ventana-imagen-class" style="margin-left:547px; margin-top:-375px; width: 181px; height: 175px; " src="<?php echo $data['rootUrl']; ?>global/img/admin/ventana.png" />

                </table>


                <table class="oliveti" style="width: 22%; border: 2px solid #000; margin-left: 732px; margin-top: -374px; height: 155px; border-radius: 0px 0px 0px 0px;">

                    <caption class="olivo" style=" font-weight:bold; font-size:15px; color:#fff; border-radius:0px 25px 0px 0px; border: 2px #000 solid;">Extra Charges & Discounts</caption>



                    <td>&nbsp;</td>


                    <tr style="width: 700px;" >
                        <td>
                            <label  style=" float:right; font-size:14px; margin-top:-19px; "><strong style="padding-bottom:10px; color: #000;">Discount&nbsp;%</strong></label>
                        </td>

                        <td>
                            <input type="number" name="descuento"  id="descuento"  class="descuentos"  maxlength="3" style="text-align: right; margin-top: -21px;  margin-right: 6px; color:#000; font-size: 22px;font-weight: bold; height:25px; width:80px; border: #33F solid thin; float:right;" onkeypress="return descuentoporc(event);" onkeyup="desporc();" onchange="desporc();" max="100" min="0"  value="0" autocomplete="off"/>
                            <input type="number" name="descuentop" id="descuentop" class="descuentos" maxlength="3" class="txtNumbers" value=""  autocomplete="off" style="display:none; text-align: right; color:#000; font-size: 22px;font-weight: bold; border: #33F solid thin; float:right; margin-top: -21px;  margin-right: 6px; height:25px; width:80px; " />
                        </td>
                    </tr>

                    <tr style="width: 700px;" >
                        <td>
                            <label  style="float:right; font-size:14px;  margin-top: 8px; "><strong style="padding-bottom:10px; color:#000;">Discount&nbsp;&nbsp;&nbsp;$</strong></label>

                        </td>

                        <td>                      
                            <input type="text" name="descuento_valor"  id="descuento_valor" class="descuentos"  size="12"  style="float:right; border: 1px #33F solid; margin-top: 7px; margin-right: 6px; text-align: right; color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="<?php echo $reserva->descuento_valor; ?>" onkeypress="return solodescuento(event);" onkeyup="desval(); ponDecimales(2);" autocomplete="off" />
                            <input type="text" name="descuento_valorp" id="descuento_valorp"   class="descuentos" size="12" style="display:none; float:right; border: 1px #33F solid; margin-top: 7px;  margin-right: 6px;  text-align: right; color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="" autocomplete="off" />
                        </td>
                    </tr>

                    <td>&nbsp;</td>


                    <tr  style="width: 700px;">

                        <td style="width: 700px;">
                            <label  style="float:right;  font-size:14px;  margin-top: -16px;"><strong style="padding-bottom:10px; color: #000;">Extra Charges&nbsp;$</strong></label>
                        </td>

                        <td>
                            <input name="extra" type="text" id="extra" size="12" class="extracargos" style="float:right;  text-align: right; color:#000; margin-top: -17px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;"  value="<?php echo $reserva->extra_charge; ?>" onkeypress="return soloextra(event);" onkeyup="resetextra(); ponDecimales(2);" autocomplete="off" />
                            <input type="text" name="extrap" id="extrap"   size="12" style="display:none; float:right;  text-align: right; color:#000; margin-top: -21px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px;"   value="" />
                            <br />
                        </td>
                    </tr>

                    <div>
                        <a  id="pago_agente" style="display:none;" ><img style="width:0px; height: 28px; margin-top: -124px; margin-left: 386px; cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                        <a  id="pago_agente1" style="display:none;"><img style="width:0px; height: 28px; margin-top:-124px; margin-left: 386px;  " src="<?php echo $data['rootUrl']; ?>global/img/admin/chargedisabled.png" /></a>
                        <input type="text" id="pago_tarjeta" name="pago_tarjeta" title="Pago Tarjeta" value="0.00"  style="display:none; position:absolute;  border: 1px #FFF solid; margin-top: 23.2px;  margin-left: 628px; width: 68px; height:12px; text-align:right; font-size: 14px; padding-top:2px; background-color: yellow; color:#000;"  autocomplete="off"  />                                
                 
                    </div>

                    <li class="btn-toolbar" id="btn-save2">
                        
                        <div id="">
                            <input type="button" id="btn-save2" name="btnsave2" class="oliverty"  class="link-button"  style="margin-left: 811px; margin-top: -192px;"  title="Save" value="SAVE" />
                        </div>
                    </li>



                </table>


<!--                <script>
                    $(function () {
                        $("#tabs").tabs();
                    });
                </script>-->

                <!--                <div id="tabs" style="margin-left:547px; margin-top:6px; width:386px; height:177px;">
                                    <ul>
                                        <li><a  href="#tabs-2">Saved Notes</a></li>
                                        <li><a title="Type your notes" href="#tabs-1">Add Notes</a></li>
                
                
                                    </ul>
                
                                    <div id="tabs-2">
                                        <textarea id="comments2" name="comments2" cols="0" rows="0"  disabled="disabled" style="border-color:blue; margin: 13px; width: 377px; height: 137px; margin-top:-11px; margin-left:-15px;"><?php echo trim($reserva->comments2); ?></textarea> 
                                    </div>
                                    <div id="tabs-1">
                                        <textarea id="comments" name="comments" cols="0" rows="0" style="border-color:red; margin: 13px; width: 377px; height:137px; margin-top:-11px; margin-left:-15px;"></textarea> 
                                    </div>
                
                
                                </div>-->



                <div style="margin-left:547px; margin-top:6px;">
                    <ul class="tabs" style=" width:97%;">

                        <li style=""><a href="#tab1">Saved Notes</a></li>
                        <li><a href="#tab2">Add Notes</a></li>

                    </ul>

                    <div class="tab_container" style="height:157px; width: 392px; ">
                        <div id="tab1" class="tab_content">
                            <!--Contenido del bloque-->

                            <textarea id="comments2" name="comments2" cols="0" rows="0"  disabled="disabled" style=" width: 377px; height: 137px; margin-left:-15px; margin-top:-11px; "><?php echo trim($reserva->comments2); ?></textarea>

                        </div>
                        <div id="tab2" class="tab_content">
                            <!--Contenido del bloque-->
                            <textarea id="comments" name="comments" cols="0" rows="0" style=" width: 377px; height: 137px; margin-left:-15px; margin-top:-11px;"></textarea>
                        </div>
                    </div>

                </div>


            </fieldset>
            <select id="opcion_pago_2" name="opcion_pago_2" style="margin-left:401px; margin-top: -201px; display:none;">
                <optgroup label="PRED-PAID">
                    <option value="2">Credit Card no fee</option>
                    <option value="1">Credit Card with fee</option>
                    <option value="6">Cash</option>
                    <option value="10">Check</option>
                </optgroup>
                <optgroup label="COLLECT ON BOARD">
                    <option value="8">Credit Card no fee</option>
                    <option value="3">Credit Card with fee</option>
                    <option value="4">Cash</option>
                    <option value="9">Check</option>
                </optgroup>
            </select>


            <select id="opcion_pago_3" name="opcion_pago_3" style="display:none; margin-left:424px; margin-top: -168px;">
                <optgroup label="PRED-PAID">
                    <option value="2">Credit Card no fee</option>
                    <option value="1">Credit Card with fee</option>
                    <option value="6">Cash</option>
                    <option value="10">Check</option>
                </optgroup>
                <optgroup label="COLLECT ON BOARD">
                    <option value="8">Credit Card no fee</option>
                    <option value="3">Credit Card with fee</option>
                    <option value="4">Cash</option>
                    <option value="9">Check</option>
                </optgroup>
            </select>

            <input type="button" style="display:none" id="enviar_escondido" value="0"  />

<!--            <a  id="pago_agente" style="display:none; margin-left: 399px;" ><img style="width:77px; height: 28px; margin-top: -147px; cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
<a  id="pago_agente1" style="margin-left: 399px;"><img style="width:77px; height: 28px; margin-top:-147px;  " src="<?php echo $data['rootUrl']; ?>global/img/admin/chargedisabled.png" /></a>-->
            <!--style="margin-right: 320px;"-->


        </div>
        


<!--        <input title="Add Payment" class="button_sliding_bg" type="button" id="pay_driver" name="pay_driver" onclick="mostrarVentana2();" style="border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 9px; border-top-right-radius: 9px; margin-left: 573px; margin-top: -400px; height: 26px; cursor:pointer; color: #fff; font-weight: 700; width: 179px;  padding: 3px; padding-left: 2px;" value="Add Payment"/>-->
        <td align="right">

        </td>

        <select name="opcion_pago_driver" id="opcion_pago_driver" style="display:none; margin-left:414px; margin-top:-327px;">
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

        <select name="opcion_pago" id="op_pago_id" style="display:none; margin-left:411px; margin-top:-221px;">
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
        
        <select name="op_pago_conductor" id="op_pago_conductor" style="margin-left:410.2px; margin-top:-251px;" value="9" onclick="valida_voucher();" onchange="captura(); passenger_balance();" >
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


        <input type="text" id="saldoPagado2"  style=" display:none; font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:23px; margin-left: -32px; width: 83px;" value="" />

        <input name="opc_ap"  type="text" id="opc_ap" size="12" style="display:none;" value="" />
        <input name="PAP"  type="text" id="PAP" size="12" style="display:none;" value="0.00" />
        <input name="PAP2"  type="text" id="PAP2" size="12" style="display:none;" value="0.00" />         
        <input name="etb"  type="text" id="etb" size="12" style="display:none;" value="0.00" />
        <input name="paid_drivert"  type="text" id="paid_drivert" size="12" style="display:none;" value="<?php echo number_format($reserva->paid_driver, 2, '.', ''); ?>" />
        <input name="pred_paid_amountt"  type="text" id="pred_paid_amountt" size="12" style="display:none;" value="<?php echo number_format($reserva->pred_paid_amount, 2, '.', ''); ?>" />

        <input name="tot_charge"  type="text" id="tot_charge" size="12" style="display:none;" value="<?php echo number_format($reserva->total_charge, 2, '.', ''); ?>" />
        <!--paid driver edition-->
        <input name="p_d_e"  type="text" id="p_d_e" size="12" style="display:none;" value="<?php echo $reserva->paid_driver ?>" />
        <!--pay amount edition-->
        <input name="p_a_e"  type="text" id="p_a_e" size="12" style="display:none;" value="<?php echo $reserva->pred_paid_amount ?>" />
        <input name="totalbalance"  type="text" id="totalbalance" size="12" style="display:none;" value="0.00" />



<div id="userr"></div>
<div id="puestosEnUso"></div>

<div id="dialog_states__trips" title="Seats available on trips" style="display:none;">
    <div>
        <div id="states__trips_conte"></div>
    </div>
</div>
<div id="userr"></div>
<div id="dialog" title="History of changes of the reserve" style="display:none;">
    <div style="overflow-y: scroll;height:250px;">
        <table class="grid2" cellspacing="1" id="grid2">
            <thead>
                <tr>
                    <td>Action</td>
                    <td>User</td>
                    <td>Date</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
<?php foreach ($rastro as $rr) { ?>
                    <tr class="row1">
                        <td><?php echo $rr['tipo_cambio']; ?></td>
                        <td><?php echo $rr['usuario']; ?></td>
                        <td><?php echo date('M-d-Y', strtotime($rr['fecha'])); ?></td>
                        <td onclick="detalles_rastro('<?php echo $rr['id'] ?>');"><img src="<?php echo $data['rootUrl'] ?>global/img/admin/info.png" width="24" height="24" title="Details of change" /></td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div id="dialog2" title="History of Payments [Transportations]" style="display:none; width:550px; margin-left:12px;">
    <div style="overflow-y: scroll;height:250px; width:550px;">
        <table class="grid2" cellspacing="1" id="grid2">
            <thead>
                <tr>
                    <td style="text-align: center;">Pago</td>
                    <td style="text-align: center; width:158px;">Tipo Pago</td>
                    <td style="text-align: center; width:78px;">Valor Pagado</td>
                    <td style="text-align: center; width:150px;">Fecha</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql122 = "SELECT pago, tipo_pago, pagado, fecha FROM reservas_pago where id_reserva=$reserva->id AND pagado <> '0.00' order by fecha";
                $rs12 = Doo::db()->query($sql122);
                $pagos2 = $rs12->fetchAll();
                foreach ($pagos2 as $p):
                    ?>
                    <tr class="row1">
                        <td style="text-align: left;"><?php echo $p['pago']; ?></td>
                        <td style="text-align: left;"><?php echo $p['tipo_pago']; ?></td>
                        <td style="text-align: right;"><?php echo $p['pagado']; ?></td>
                        <td style="text-align: center;"><?php echo $p['fecha']; ?></td>

                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="dialog_message_rastro" style="display:none" title="Details of change">
    <div id="conten_rastro">
    </div>
</div>


<div id="dialog-trip-pregunta" title="Time limit for booking" style="display:none">
    <p>
        <div id="reloj_temporizador" class="temporizador"></div>
        <div id="mensaje_trips_pregunta">    </div>
    </p>
</div>



<!--Capturamos valor del tipo de pago para ajustarlo a la funcion CalcularTotalTotal -->

<input type="text" id="op_pago" name="op_pago" size="12" style="display:none;" value="<?php echo $reserva->op_pago; ?>" />


<input type="button" id="btnBD" name="btnBD" size="20" value="Balance_Due"  style="display:none; cursor:pointer; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="bal_due();"  />

<input type="button" id="btnABD" name="btnABD" size="20" value="Agency_Balance_Due"  style="display:none; cursor:pointer; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="agen_bal_due();"  />

<input type="button" id="btn_Other" name="btn_Other" size="10" value="Amount to Collect $"  style="display:none; cursor:pointer; margin-left:130px; margin-top:-396px; font-weight: bold; font-size: 16px; width: 163px; height: 27px;  border-color: red; " onclick="calc_other();"  />


<div style="display:none;" id="resultado"></div>

<div style="display:none;" id="result"></div>

<input type="text" name="selectcond" id="selectcond" value="" style="display:none; position:absolute; margin-left:0px; margin-top:0px;" />

<input type="text" id="temp_driver"  name="temp_driver" title="Temp Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
                                
<input type="text" id="temp_prepaid"  name="temp_prepaid" title="Temp Prepaid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

<input type="text" id="collect" name="collect" title="Paid Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($reserva->paid_driver, 2, '.', ''); ?>" />

<input type="text" id="prepaid" name="prepaid" title="Amount Paid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($reserva->pred_paid_amount, 2, '.', ''); ?>" />

                                

<input type="text" id="no_pago"  name="no_pago" title="# pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="no_prep"  name="no_prep" title="# prep" size="12" style="display:none; margin-top:4px; margin-left:417px; width:18px; height:11px;" value="0" />
<br>
</br>
<input type="text" id="pago_1"  name="pago_1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago1"  name="pago1" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago1"  name="tipo_pago1" title="tipo pago1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado1"  name="pagado1" title="pagado1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre1"  name="pago_pre1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre1"  name="pagopre1" title="pago prep1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre1"  name="tipo_pagopre1" title="tipo pagopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre1"  name="pagadopre1" title="pagadopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_2"  name="pago_2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago2"  name="pago2" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago2"  name="tipo_pago2" title="tipo pago2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado2"  name="pagado2" title="pagado2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre2"  name="pago_pre2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre2"  name="pagopre2" title="pago prep2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre2"  name="tipo_pagopre2" title="tipo pagopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre2"  name="pagadopre2" title="pagadopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />


<br>
</br>
<input type="text" id="pago_3"  name="pago_3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago3"  name="pago3" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago3"  name="tipo_pago3" title="tipo pago3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado3"  name="pagado3" title="pagado3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre3"  name="pago_pre3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre3"  name="pagopre3" title="pago prep3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre3"  name="tipo_pagopre3" title="tipo pagopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre3"  name="pagadopre3" title="pagadopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />


<br>
</br>
<input type="text" id="pago_4"  name="pago_4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago4"  name="pago4" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago4"  name="tipo_pago4" title="tipo pago4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado4"  name="pagado4" title="pagado4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre4"  name="pago_pre4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre4"  name="pagopre4" title="pago prep4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre4"  name="tipo_pagopre4" title="tipo pagopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre4"  name="pagadopre4" title="pagadopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_5"  name="pago_5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago5"  name="pago5" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago5"  name="tipo_pago5" title="tipo pago5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado5"  name="pagado5" title="pagado5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre5"  name="pago_pre5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre5"  name="pagopre5" title="pago prep5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre5"  name="tipo_pagopre5" title="tipo pagopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre5"  name="pagadopre5" title="pagadopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_6"  name="pago_6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago6"  name="pago6" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago6"  name="tipo_pago6" title="tipo pago6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado6"  name="pagado6" title="pagado6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre6"  name="pago_pre6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre6"  name="pagopre6" title="pago prep6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre6"  name="tipo_pagopre6" title="tipo pagopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre6"  name="pagadopre6" title="pagadopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_7"  name="pago_7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago7"  name="pago7" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago7"  name="tipo_pago7" title="tipo pago7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado7"  name="pagado7" title="pagado7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre7"  name="pago_pre7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre7"  name="pagopre7" title="pago prep7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre7"  name="tipo_pagopre7" title="tipo pagopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre7"  name="pagadopre7" title="pagadopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_8"  name="pago_8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago8"  name="pago8" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago8"  name="tipo_pago8" title="tipo pago8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado8"  name="pagado8" title="pagado8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre8"  name="pago_pre8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre8"  name="pagopre8" title="pago prep8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre8"  name="tipo_pagopre8" title="tipo pagopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre8"  name="pagadopre8" title="pagadopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_9"  name="pago_9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago9"  name="pago9" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago9"  name="tipo_pago9" title="tipo pago9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado9"  name="pagado9" title="pagado9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre9"  name="pago_pre9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre9"  name="pagopre9" title="pago prep9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre9"  name="tipo_pagopre9" title="tipo pagopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre9"  name="pagadopre9" title="pagadopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

<br>
</br>
<input type="text" id="pago_10"  name="pago_10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
<input type="text" id="pago10"  name="pago10" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pago10"  name="tipo_pago10" title="tipo pago10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagado10"  name="pagado10" title="pagado10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

<input type="text" id="pago_pre10"  name="pago_pre10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
<input type="text" id="pagopre10"  name="pagopre10" title="pago prep10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="tipo_pagopre10"  name="tipo_pagopre10" title="tipo pagopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
<input type="text" id="pagadopre10"  name="pagadopre10" title="pagadopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />


<input type="text" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="idagencia" id="idagencia"  size="10" maxlength="10"  value="<?php echo $voucher; ?>" autocomplete="off"/>
<input type="text" style="display:none;" name="est" id="est"  size="10" maxlength="10"  value="<?php echo $canal; ?>" autocomplete="off"/>

<input type="text" style="display:none; margin-left:10px; width:50px;" name="tarifaone"     id="tarifaone"   size="15"  value="<?php echo $reserva->tarifa_one; ?>" />
<input type="text" style="display:none;  margin-left:10px; width:50px;" name="tarifaround"   id="tarifaround" size="15"  value="<?php echo $reserva->tarifa_round; ?>" />

<input type="text" style="display:none; margin-left:10px; width:50px;" name="tarifaone_edit"     id="tarifaone_edit"   size="15"  value="<?php echo $reserva->tarifa_one; ?>" />
<input type="text" style="display:none; margin-left:10px; width:50px;" name="tarifaround_edit"   id="tarifaround_edit" size="15"  value="<?php echo $reserva->tarifa_round; ?>" />

<input type="radio" name="tipo_ticket2"  id="oneway2"    style="display:none;" value="1" />
<input type="radio" name="tipo_ticket2"  id="roundtrip2" style="display:none;" value="2" />

</form> 
<main>
    <!--  <h2>Editar Reserva</h2>-->
    <input type="radio" id="mostrar-modal" name="modal" onclick="pregunta(event);"/>
    <label class="flotante" style="margin-left:-384px; color:#fff;" for="mostrar-modal">Editar</label>
  <!--  <input type="radio" id="cerrar-modal" name="modal"/>
    <label class="" style="margin-left:-43.3%; margin-top:-13.80%; color:#fff;" for="cerrar-modal">CERRAR</label> href='<?php /*echo $data['rootUrl']*/?>admin/reservas/'-->
    <div id="modal">
  
    </div>
</main>
        
<!--<table style="border: 0px solid #ccc;" align="center" cellspacing="0" border="0">
    
    <tr>-->

        <div class="" id="save2" style="position:fixed; overflow: visible; z-index: 1000; margin-left: 382px; margin-top: -1050px; font-weight: bold; font-size: 39px; display:none; ">    
<!--            <i class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: #CE4233;"></i> -->
            <a style="margin-left: 21px; margin-top: -160px; position: absolute;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/eclipse.gif' width="155px" height="155px" margin-left="85px" margin-top="-127px">
            <a style="margin-left: 60px; margin-top: -118px; position: absolute;"><img src ='<?php echo $data['rootUrl'] ?>global/img/loading_trips.gif' width="75px" height="75px" margin-left="85px" margin-top="-127px">
            <div class="cssload-loader" style="position:absolute; color:#4682B4; text-align:center; margin-left: 6px; margin-top: 72px; font-size: 28px;">Loading</div>
        </div> 
<!--    </tr>
    
</table>-->

<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:85px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="tipo_reserva" id="tipo_reserva"  size="10" maxlength="10"  value="Editado" autocomplete="off"/><br>
<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="total_pasajeros" id="total_pasajeros"  size="10" maxlength="10"  value="<?php echo $total_pasajeros ?>" autocomplete="off"/>
<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="trip_1" id="trip_1"  size="10" maxlength="10"  value="<?php echo $trip_no ?>" autocomplete="off"/>
<input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="trip_2" id="trip_2"  size="10" maxlength="10"  value="<?php echo $trip_no2 ?>" autocomplete="off"/>

</div>

<div class="" id="sur2015" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 0px; margin-top: 0px; font-weight: bold; font-size: 16px; display:none;">                
     
            <a style="margin-left: 572px; margin-top: -132px; position: absolute;" href=''><img src ='<?php echo $data['rootUrl'] ?>global/img/sur2015.gif' width="115px" height="85px" margin-left="0px" margin-top="0px">
        
</div> 

<!--<input type="button" name="print" value="" title="Print Credit/Card" style="margin-left: 91px; margin-top: 47px;color: #AC1B29; font-weight: bold; width: 49px;  height: 34px; font-size: 12px;" onclick="window.print();">-->
<img title= "Print Credit Card" onclick="window.print();" style="position:absolute; margin-left: 97px; margin-top: 45px; "src ='<?php echo $data['rootUrl'] ?>global/img/print.png' width="35px" height="35px" margin-left="0px" margin-top="0px">
           
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
                
       //document.getElementById('prepaid').value = "0.00"; 
       //document.getElementById('temp_prepaid').value = "0.00"; 
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00"; 
       document.getElementById('pago_tarjeta').value = "0.00"; 
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none"; 
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";        
                
        mostrarVentana2();

       
    
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
    
    function fecha_ns_round()
    {

        var roundtrip = document.getElementById("roundtrip").checked; 

        if(roundtrip == true){
        
        var opcround = $("#estado_roundtrip").val();

        //CONFIRMED
        if(opcround == '1'){     

            document.getElementById('estado_roundtrip').style.background = "#98FB98"; 
            document.getElementById('estado_roundtrip').style.color = "#000";
            document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

            alert('Selecciona la Fecha de Retorno y Escoge la respectiva Tarifa para el Trip');

            document.getElementById('estado_round').value = "1";

            document.getElementById('fecha_retorno').value = "<?php echo $fecha_retorno; ?>";                                    
            document.getElementbyId('fec_retorno_ns').value="<?php echo $fecha_retorno_ns; ?>";
            document.getElementbyId('fec_retorno_ns1').value = document.getElementbyId('fec_retorno_ns').value;

            //document.getElementById('fec_salida_ns').value = "<?php echo $fecha_salida_ns; ?>";

            //Standard Price Trip 2   
            document.getElementById('subtoadult2').value = "<?php echo $subtoadult2; ?>";                                
            document.getElementById('subtochild2').value = "<?php echo $subtochild2; ?>";

            //Super Flex Price Trip2   
            document.getElementById('subtoadult4').value = "<?php echo $subtoadult2; ?>";                                    
            document.getElementById('subtochild4').value = "<?php echo $subtochild2; ?>";

            //Extensiones Trip 2
            document.getElementById('price_exten04').value = "<?php echo $exten4a; ?>";                                  
            document.getElementById('price_exten03').value = "<?php echo $exten3a; ?>";

            document.getElementById('ext_from2').value = "<?php echo $extension3; ?>";                                    
            document.getElementById('ext_to2').value = "<?php echo $extension4; ?>";

            document.getElementById('pickup2').disabled = false;
            document.getElementById('dropoff2').disabled = false;


            document.getElementById('tari_round').value = "<?php  if($reserva->tarifa_round == '1') { echo 'Standard Price'; } else if($reserva->tarifa_round == '7') { echo 'Special Price'; } else if($reserva->tarifa_round == '0') { echo ''; } else if ($reserva->tarifa_round == '2') {  echo 'Super Flex Price'; } ?>";

            document.getElementById('tarifround').value = "<?php  if($reserva->tarifa_round == '1') { echo '1'; } else if($reserva->tarifa_round == '7') { echo '7'; } else if($reserva->tarifa_round == '0') { echo '0'; } else if ($reserva->tarifa_round == '2') {  echo '2'; } ?>";



            CalcularTotal();                               
            CalcularTotalTotal();
            
             setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);


        //NO SHOW
        }else if(opcround == '2'){

            document.getElementById('estado_round').value = "2";

            document.getElementById('fecha_retorno').value = "N/S";

            document.getElementById('subtoadult2').value = 0;
            document.getElementById('subtochild2').value = 0;

            document.getElementById('subtoadult4').value = 0;
            document.getElementById('subtochild4').value = 0;

            document.getElementById('price_exten03').value = 0;
            document.getElementById('price_exten04').value = 0;                                   

            document.getElementById('ext_from2').value = 0;                                    
            document.getElementById('ext_to2').value = 0;     

            document.getElementById('tari_round').value = '';
            document.getElementById('tarifaround').value = 0;     

            document.getElementById('pickup2').disabled = false;
            document.getElementById('dropoff2').disabled = false;

            document.getElementById('estado_roundtrip').style.background = "#00BFFF";  
            document.getElementById('estado_roundtrip').style.color = "#000";
            document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

            CalcularTotal();    
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //NO SHOW W/FEE
        } else if(opcround == '3'){

            document.getElementById('estado_round').value = "3";

            document.getElementById('fecha_retorno').value = "N/S W/FEE";

            //Standard Price Trip 2   
            document.getElementById('subtoadult2').value = "<?php echo $subtoadult2; ?>";                                
            document.getElementById('subtochild2').value = "<?php echo $subtochild2; ?>";

            //Super Flex Price Trip2   
            document.getElementById('subtoadult4').value = "<?php echo $subtoadult2; ?>";                                    
            document.getElementById('subtochild4').value = "<?php echo $subtochild2; ?>";

            //Extensiones Trip 2
            document.getElementById('price_exten04').value = "<?php echo $exten4a; ?>";                                  
            document.getElementById('price_exten03').value = "<?php echo $exten3a; ?>";

            document.getElementById('ext_from2').value = "<?php echo $extension3; ?>";                                    
            document.getElementById('ext_to2').value = "<?php echo $extension4; ?>";

            document.getElementById('pickup2').disabled = false;
            document.getElementById('dropoff2').disabled = false;


            document.getElementById('tari_round').value = "<?php  if($reserva->tarifa_round == '1') { echo 'Standard Price'; } else if($reserva->tarifa_round == '7') { echo 'Special Price'; } else if($reserva->tarifa_round == '0') { echo ''; } else if ($reserva->tarifa_round == '2') {  echo 'Super Flex Price'; }?>";
            document.getElementById('tarifround').value = "<?php  if($reserva->tarifa_round == '1') { echo '1'; } else if($reserva->tarifa_round == '0') { echo '0'; } else if($reserva->tarifa_round == '7') { echo '7'; } else if ($reserva->tarifa_round == '2') {  echo '2'; }?>";


            document.getElementById('estado_roundtrip').style.background = "#ADD8E6";  
            document.getElementById('estado_roundtrip').style.color = "#000";
            document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

            CalcularTotal();      
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //CANCELED
        } else if(opcround == '4'){

            document.getElementById('estado_round').value = "4";

            // Colocamos Fecha Retorno (CANC)
            document.getElementById('fecha_retorno').value = "CANC";

            //Standard Price Trip 2   
            document.getElementById('subtoadult2').value = 0;
            document.getElementById('subtochild2').value = 0;

            //Super Flex Price Trip 2 
            document.getElementById('subtoadult4').value = 0;
            document.getElementById('subtochild4').value = 0;

            //Extensiones Trip 2
            document.getElementById('price_exten03').value = 0;                                    
            document.getElementById('price_exten04').value = 0;

            document.getElementById('ext_from2').value = 0;                                    
            document.getElementById('ext_to2').value = 0;

            document.getElementById('tari_round').value = '';
            document.getElementById('tarifaround').value = 0;

            //Habilitamos cajas de texto para pickup y dropoff de Trip 2                                   
            document.getElementById('pickup2').disabled = false;
            document.getElementById('dropoff2').disabled = false;

            document.getElementById('estado_roundtrip').style.background = "#DC143C";  
            document.getElementById('estado_roundtrip').style.color = "#FFFFFF";
            document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";
            
            

            //Recalculamos todo

            CalcularTotal();      
            CalcularTotalTotal();
            
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);
            
//            setTimeout(function () {
//
//                $('#op_pago_conductor').click();
//                document.getElementById('op_pago_conductor').value = 8;
//
//            }, 0.001);
            
            

        //CANCELED W/FEE   
        }else if(opcround == '5'){


            document.getElementById('estado_round').value = "5";
             // Colocamos Fecha Retorno (CANC W/FEE)
            document.getElementById('fecha_retorno').value = "CANC W/FEE";

             //Standard Price Trip 2   
            document.getElementById('subtoadult2').value = "<?php echo $subtoadult2; ?>";                                
            document.getElementById('subtochild2').value = "<?php echo $subtochild2; ?>";

            //Super Flex Price Trip2   
            document.getElementById('subtoadult4').value = "<?php echo $subtoadult2; ?>";                                    
            document.getElementById('subtochild4').value = "<?php echo $subtochild2; ?>";

            //Extensiones Trip 2
            document.getElementById('price_exten04').value = "<?php echo $exten4a; ?>";                                  
            document.getElementById('price_exten03').value = "<?php echo $exten3a; ?>";

            document.getElementById('ext_from2').value = "<?php echo $extension3; ?>";                                    
            document.getElementById('ext_to2').value = "<?php echo $extension4; ?>";

            document.getElementById('pickup2').disabled = false;
            document.getElementById('dropoff2').disabled = false;


            document.getElementById('tari_round').value = "<?php  if($reserva->tarifa_round == '1') { echo 'Standard Price'; } else if($reserva->tarifa_round == '7') { echo 'Special Price'; } else if($reserva->tarifa_round == '0') { echo ''; } else if ($reserva->tarifa_round == '2') {  echo 'Super Flex Price'; }?>";
            document.getElementById('tarifround').value = "<?php  if($reserva->tarifa_round == '1') { echo '1'; } else if($reserva->tarifa_round == '0') { echo '0'; } else if($reserva->tarifa_round == '7') { echo '7'; } else if ($reserva->tarifa_round == '2') {  echo '2';  }?>";

            document.getElementById('estado_roundtrip').style.background = "#E93F2E";  
            document.getElementById('estado_roundtrip').style.color = "#FFFFFF";
            document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

            CalcularTotal();      
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //OPEN W/FEE    
        }else if(opcround == '6'){

            document.getElementById('estado_round').value = "6";

            document.getElementById('fecha_retorno').value = "OPEN W/FEE";

            //Standard Price Trip 2   
            document.getElementById('subtoadult2').value = "<?php echo $subtoadult2; ?>";                                
            document.getElementById('subtochild2').value = "<?php echo $subtochild2; ?>";

            //Super Flex Price Trip2   
            document.getElementById('subtoadult4').value = "<?php echo $subtoadult2; ?>";                                    
            document.getElementById('subtochild4').value = "<?php echo $subtochild2; ?>";

            //Extensiones Trip 2
            document.getElementById('price_exten04').value = "<?php echo $exten4a; ?>";                                  
            document.getElementById('price_exten03').value = "<?php echo $exten3a; ?>";

            document.getElementById('ext_from2').value = "<?php echo $extension3; ?>";                                    
            document.getElementById('ext_to2').value = "<?php echo $extension4; ?>";

            document.getElementById('pickup2').disabled = false;
            document.getElementById('dropoff2').disabled = false;


            document.getElementById('tari_round').value = "<?php  if($reserva->tarifa_round == '1') { echo 'Standard Price'; } else if($reserva->tarifa_round == '7') { echo 'Special Price'; } else if($reserva->tarifa_round == '0') { echo ''; } else if ($reserva->tarifa_round == '2') {  echo 'Super Flex Price'; }?>";
            document.getElementById('tarifround').value = "<?php  if($reserva->tarifa_round == '1') { echo '1'; } else if($reserva->tarifa_round == '0') { echo '0'; } else if($reserva->tarifa_round == '7') { echo '7'; } else if ($reserva->tarifa_round == '2') {  echo '2'; }?>";



            document.getElementById('estado_roundtrip').style.background = "#F0E68C";  
            document.getElementById('estado_roundtrip').style.color = "#000";
            document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

            CalcularTotal();      
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        }else {

            //&& $reserva->tipo_ticket != 'oneway'
            document.getElementById('fecha_retorno').value = "<?php
        if ($reserva->fecha_retorno == 'N/A') {
            echo 'N/S';
        }else if($reserva->fecha_retorno == 'N/S W/F'){
            echo 'N/S W/FEE';
        }else if($reserva->fecha_retorno == 'C W/F'){
            echo 'CANC W/FEE';
        }else if($reserva->fecha_retorno == 'C'){
            echo 'CANC';
        }else if($reserva->fecha_retorno == 'OP'){
            echo 'OPEN W/FEE';
        }else {
            if (isset($reserva)) {
                echo ($reserva->fecha_retorno == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_retorno)));
            }
        }
        ?>"

        }
     
     }

    }

</script>

<script type="text/javascript">
    function fecha_ns_one()
    {


    var oneway = document.getElementById("oneway").checked; 
    var roundtrip = document.getElementById("roundtrip").checked; 

        
    if(oneway == true){        
   
        
    var opcone = $("#estado_oneway").val();

        //CONFIRMED
        if(opcone == '1'){

            document.getElementById('estado_oneway').style.background = "#98FB98"; 
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";

            alert('Selecciona La Fecha de Salida y Escoge la respectiva Tarifa para el Trip');

            document.getElementById('estado_one').value = "1";
            document.getElementById('estado').value = "CONFIRMED";

            document.getElementById('fecha_salida').value = "<?php echo $fecha_salida; ?>";
            document.getElementById('fec_salida_ns').value = "<?php echo $fecha_salida_ns; ?>";

            document.getElementbyId('fec_salida_ns1').value = document.getElementbyId('fec_salida_ns').value;
            //document.getElementById('trip_no').value = "";

//                                    document.getElementbyId('fec_retorno_ns').value="<?php echo $fecha_retorno_ns; ?>";

            //Standard Price Trip 1                                   
            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                               
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            //Super Flex Price Trip1                                    
            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                    
            document.getElementById('subtochild22').value = "<?php echo $subtochild1; ?>";

            //Extensiones Trip 1
            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";

            document.getElementById('pickup1').disabled = false;
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; } else if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; }?>";
            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '6') { echo '6'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if ($reserva->tarifa_one == '2') {  echo '2'; }?>";                                                                                                        



            CalcularTotal();                               
            CalcularTotalTotal();
            
             setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);


        //NO SHOW
        }else if(opcone == '2'){

            document.getElementById('estado_one').value = "2";

            document.getElementById('fecha_salida').value = "N/S";

            document.getElementById('subtoadult1').value = 0;                                   
            document.getElementById('subtochild1').value = 0;

            document.getElementById('subtoadult22').value = 0;                                   
            document.getElementById('subtochild22').value = 0;

            document.getElementById('price_exten01').value = 0;                                    
            document.getElementById('price_exten02').value = 0;

            document.getElementById('ext_from1').value = 0;                                    
            document.getElementById('ext_to1').value = 0;                              


            document.getElementById('pickup1').disabled = false;
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = '';
            document.getElementById('tarifaone').value = 0;

            document.getElementById('estado_oneway').style.background = "#00BFFF";  
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";

            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //NO SHOW W/FEE
        } else if(opcone == '3'){

            document.getElementById('estado_one').value = "3";

            document.getElementById('fecha_salida').value = "N/S W/FEE";

            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                       
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                   
            document.getElementById('subtochild22').value = "<?php echo $subtoadult1; ?>";

            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";                                                               

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; }  if($reserva->tarifa_one == '0') { echo ''; } else {  if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } }?>";

            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if($reserva->tarifa_one == '3') { echo '3'; } else {  if ($reserva->tarifa_one == '2') {  echo '2'; } }?>";

            document.getElementById('estado_oneway').style.background = "#ADD8E6";  
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);


        //CANCELED
        }else if(opcone == '4'){

            document.getElementById('estado_one').value = "4";
            
            document.getElementById('estado').value = "CANCELED";
            
            //document.getElementById('op_pago_conductor').value = "8";            

            document.getElementById('fecha_salida').value = "CANC";

//            document.getElementById('subtoadult1').value = 0;                       
//            document.getElementById('subtochild1').value = 0;
//
//            document.getElementById('subtoadult22').value = 0;                                   
//            document.getElementById('subtochild22').value = 0;
//
//            document.getElementById('price_exten01').value = 0;                                    
//            document.getElementById('price_exten02').value = 0;
//
//            document.getElementById('ext_from1').value = 0;                                    
//            document.getElementById('ext_to1').value = 0;  
            
//            document.getElementById('exten1').value = '';
//            document.getElementById('exten2').value = '';

//            document.getElementById('pickup1').disabled = false;                                    
//            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = '';
            document.getElementById('tarifaone').value = 0;

            document.getElementById('estado_oneway').style.background = "#DC143C";  
            document.getElementById('estado_oneway').style.color = "#FFFFFF";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //CANCELED W/FEE   
        }else if(opcone == '5'){

            document.getElementById('estado_one').value = "5";
            document.getElementById('fecha_salida').value = "CANC W/FEE";

            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                       
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                   
            document.getElementById('subtochild22').value = "<?php echo $subtoadult1; ?>";

            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";                                                               

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } if($reserva->tarifa_one == '6') { echo 'Special Price'; } if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } ?>";
            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if($reserva->tarifa_one == '6') { echo '6'; } else if ($reserva->tarifa_one == '2') {  echo '2'; } ?>";
            //document.getElementById('tari_one').value = '';
            //document.getElementById('tarifaone').value = 3;

            document.getElementById('estado_oneway').style.background = "#E93F2E";  
            document.getElementById('estado_oneway').style.color = "#FFFFFF";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
             setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //OPEN W/FEE    

        }else if(opcone == '6'){

            document.getElementById('estado_one').value = "6";

            document.getElementById('fecha_salida').value = "OPEN W/FEE";

            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                       
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                   
            document.getElementById('subtochild22').value = "<?php echo $subtoadult1; ?>";

            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";                                                               

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; } else if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } ?>";

            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if($reserva->tarifa_one == '6') { echo '6'; } else {  if ($reserva->tarifa_one == '2') {  echo '2'; } }?>";

            document.getElementById('estado_oneway').style.background = "#F0E68C";  
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);
            
            

        }else{

            // && $reserva->tipo_ticket != 'oneway'

            document.getElementById('fecha_salida').value = "<?php
        if ($reserva->fecha_salida == 'N/A') {
            echo 'N/S';
        }else if($reserva->fecha_salida == 'N/S W/F'){
            echo 'N/S W/FEE';
        }else if($reserva->fecha_salida == 'C W/F'){
            echo 'CANC W/FEE';
        }else if($reserva->fecha_salida == 'C'){
            echo 'CANC';
        }else if($reserva->fecha_salida == 'OP'){
            echo 'OPEN W/FEE';
        }else {
            if (isset($reserva)) {
                echo ($reserva->fecha_salida == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_salida)));
            }
        }
        ?>"

        }
        
    }
    
    
    if(roundtrip == true){
        
   
        
    var opcone = $("#estado_oneway").val();

        //CONFIRMED
        if(opcone == '1'){

            document.getElementById('estado_oneway').style.background = "#98FB98"; 
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";

            alert('Selecciona La Fecha de Salida y Escoge la respectiva Tarifa para el Trip');

            document.getElementById('estado_one').value = "1";
            document.getElementById('estado').value = "CONFIRMED";

            document.getElementById('fecha_salida').value = "<?php echo $fecha_salida; ?>";
            document.getElementById('fec_salida_ns').value = "<?php echo $fecha_salida_ns; ?>";

            document.getElementbyId('fec_salida_ns1').value = document.getElementbyId('fec_salida_ns').value;
            //document.getElementById('trip_no').value = "";

//                                    document.getElementbyId('fec_retorno_ns').value="<?php echo $fecha_retorno_ns; ?>";

            //Standard Price Trip 1                                   
            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                               
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            //Super Flex Price Trip1                                    
            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                    
            document.getElementById('subtochild22').value = "<?php echo $subtochild1; ?>";

            //Extensiones Trip 1
            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";

            document.getElementById('pickup1').disabled = false;
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; } else if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; }?>";
            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '6') { echo '6'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if ($reserva->tarifa_one == '2') {  echo '2'; }?>";                                                                                                        



            CalcularTotal();                               
            CalcularTotalTotal();
            
             setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);


        //NO SHOW
        }else if(opcone == '2'){

            document.getElementById('estado_one').value = "2";

            document.getElementById('fecha_salida').value = "N/S";

            document.getElementById('subtoadult1').value = 0;                                   
            document.getElementById('subtochild1').value = 0;

            document.getElementById('subtoadult22').value = 0;                                   
            document.getElementById('subtochild22').value = 0;

            document.getElementById('price_exten01').value = 0;                                    
            document.getElementById('price_exten02').value = 0;

            document.getElementById('ext_from1').value = 0;                                    
            document.getElementById('ext_to1').value = 0;                              


            document.getElementById('pickup1').disabled = false;
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = '';
            document.getElementById('tarifaone').value = 0;

            document.getElementById('estado_oneway').style.background = "#00BFFF";  
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";

            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //NO SHOW W/FEE
        } else if(opcone == '3'){

            document.getElementById('estado_one').value = "3";

            document.getElementById('fecha_salida').value = "N/S W/FEE";

            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                       
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                   
            document.getElementById('subtochild22').value = "<?php echo $subtoadult1; ?>";

            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";                                                               

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; }  if($reserva->tarifa_one == '0') { echo ''; } else {  if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } }?>";

            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if($reserva->tarifa_one == '3') { echo '3'; } else {  if ($reserva->tarifa_one == '2') {  echo '2'; } }?>";

            document.getElementById('estado_oneway').style.background = "#ADD8E6";  
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);


        //CANCELED
        }else if(opcone == '4'){

            document.getElementById('estado_one').value = "4";
            
            document.getElementById('estado').value = "CANCELED";
            
            //document.getElementById('op_pago_conductor').value = "8";            

            document.getElementById('fecha_salida').value = "CANC";

            document.getElementById('subtoadult1').value = 0;                       
            document.getElementById('subtochild1').value = 0;

            document.getElementById('subtoadult22').value = 0;                                   
            document.getElementById('subtochild22').value = 0;

            document.getElementById('price_exten01').value = 0;                                    
            document.getElementById('price_exten02').value = 0;

            document.getElementById('ext_from1').value = 0;                                    
            document.getElementById('ext_to1').value = 0;  
            
            document.getElementById('exten1').value = '';
            document.getElementById('exten2').value = '';

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = '';
            document.getElementById('tarifaone').value = 0;

            document.getElementById('estado_oneway').style.background = "#DC143C";  
            document.getElementById('estado_oneway').style.color = "#FFFFFF";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //CANCELED W/FEE   
        }else if(opcone == '5'){

            document.getElementById('estado_one').value = "5";
            document.getElementById('fecha_salida').value = "CANC W/FEE";

            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                       
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                   
            document.getElementById('subtochild22').value = "<?php echo $subtoadult1; ?>";

            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";                                                               

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } if($reserva->tarifa_one == '6') { echo 'Special Price'; } if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } ?>";
            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if($reserva->tarifa_one == '6') { echo '6'; } else if ($reserva->tarifa_one == '2') {  echo '2'; } ?>";
            //document.getElementById('tari_one').value = '';
            //document.getElementById('tarifaone').value = 3;

            document.getElementById('estado_oneway').style.background = "#E93F2E";  
            document.getElementById('estado_oneway').style.color = "#FFFFFF";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
             setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);

        //OPEN W/FEE    

        }else if(opcone == '6'){

            document.getElementById('estado_one').value = "6";

            document.getElementById('fecha_salida').value = "OPEN W/FEE";

            document.getElementById('subtoadult1').value = "<?php echo $subtoadult1; ?>";                       
            document.getElementById('subtochild1').value = "<?php echo $subtochild1; ?>";

            document.getElementById('subtoadult22').value = "<?php echo $subtoadult1; ?>";                                   
            document.getElementById('subtochild22').value = "<?php echo $subtoadult1; ?>";

            document.getElementById('price_exten01').value = "<?php echo $exten1a; ?>";
            document.getElementById('price_exten02').value = "<?php echo $exten2a; ?>";

            document.getElementById('ext_from1').value = "<?php echo $extension1; ?>";                                    
            document.getElementById('ext_to1').value = "<?php echo $extension2; ?>";                                                               

            document.getElementById('pickup1').disabled = false;                                    
            document.getElementById('dropoff1').disabled = false;

            document.getElementById('tari_one').value = "<?php  if($reserva->tarifa_one == '1') { echo 'Standard Price'; } else if($reserva->tarifa_one == '6') { echo 'Special Price'; } else if($reserva->tarifa_one == '0') { echo ''; } else if ($reserva->tarifa_one == '2') {  echo 'Super Flex Price'; } ?>";

            document.getElementById('tarifaone').value = "<?php  if($reserva->tarifa_one == '1') { echo '1'; } else if($reserva->tarifa_one == '0') { echo '0'; } else if($reserva->tarifa_one == '6') { echo '6'; } else {  if ($reserva->tarifa_one == '2') {  echo '2'; } }?>";

            document.getElementById('estado_oneway').style.background = "#F0E68C";  
            document.getElementById('estado_oneway').style.color = "#000";
            document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";


            CalcularTotal();
            CalcularTotalTotal();
            
            setTimeout(function () {

                $('#op_pago_conductor').click();
                document.getElementById('op_pago_conductor').value = 8;
                document.getElementById('balance_due').value = document.getElementById('saldoporpagar').value;

            }, 100);
            
            

        }else{

            // && $reserva->tipo_ticket != 'oneway'

            document.getElementById('fecha_salida').value = "<?php
        if ($reserva->fecha_salida == 'N/A') {
            echo 'N/S';
        }else if($reserva->fecha_salida == 'N/S W/F'){
            echo 'N/S W/FEE';
        }else if($reserva->fecha_salida == 'C W/F'){
            echo 'CANC W/FEE';
        }else if($reserva->fecha_salida == 'C'){
            echo 'CANC';
        }else if($reserva->fecha_salida == 'OP'){
            echo 'OPEN W/FEE';
        }else {
            if (isset($reserva)) {
                echo ($reserva->fecha_salida == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_salida)));
            }
        }
        ?>"

        }
        
    }
    
    


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

<!--                        <script type="text/javascript">
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }
</script>-->
<script type="text/javascript">

    function reset22()
    {
        reselect();

        setTimeout(function () {

            $('#btnAceptar').click();


        }, 0.001);

        setTimeout(function () {

            tipopago();


        }, 100);

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


            $('#op_pago_id').click();
            document.getElementById('op_pago_id').value = 3;
            //balance_pasajero();

        }


        //CASH
        if (op_pago == 4) {

            document.getElementById('op_pago_id').value = 4;
            $('#op_pago_id').click();

        }

        //CREDIT VOUCHER
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
    function reselect()
    {

        document.getElementById('op_pago_id').value = 8;


    }

</script>

<script type="text/javascript">
    function coordenadas_modal()
    {
        setTimeout(function () {

            $('#pay_driver').click();
            //document.getElementById('tot_amount_paid').value = '0.00';

        }, 0.001);

    }

</script>

<script type="text/javascript">

    function make_charge()
    {

        var payamount = document.getElementById('pay_amount').value;

        if (payamount > 0) {

            var pg = document.getElementById('pago_agente');
            var pg1 = document.getElementById('pago_agente1');
            pg.style.display = 'block';
            pg1.style.display = 'none';

        } else {
            pg.style.display = 'none';
            pg1.style.display = 'block';

        }

    }

</script>


<script type="text/javascript">

    function pago_click()
    {

        var pag = document.getElementById('pago_agente');
        var pag1 = document.getElementById('pago_agente1');

//        if ($('#pago_agente').click();) {
//
//            //    pag.style.display = 'none';
//            //    pag1.style.display = 'block';
//
//            document.getElementById('pago_agente').style.display = 'none';
//            document.getElementById('pago_agente1').style.display = 'block';
//
//        }
    }

</script>

<script type="text/javascript">

    function outcharge()
    {

        var p_amount = document.getElementById('pay_amount').value;

        if (p_amount == 0) {

            var pgt = document.getElementById('pago_agente');
            pgt.style.display = 'none';

        } else {

            pgt.style.display = 'block';

        }

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
        document.getElementById('otheramountp').value = duplicado;
        document.getElementById('balance_due').value = dupliam;





        if (dupliam == '') {


            setTimeout(function () {

                //click al boton Balance_Due para hacer el calculo de passenger Balance Due  
                //$('#btnCancelar').click();
                $("#saldoporpagar").val((apagar1).toFixed(2));
                $("#balance_due").val((balance).toFixed(2));
                $("#otheramount").val((other).toFixed(2));
                $("#otheramountp").val((other).toFixed(2));
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



    }

</script>

<!--    <script type="text/javascript">
function pago(){
//alert('hola');
</*?php
$sql1 = "SELECT pago, tipo_pago, pagado, fecha FROM reservas_pago where id_reserva='42514'";
$rs1 = Doo::db()->query($sql1, array(9));
$pagos = $rs1->fetchAll();
foreach ($pagos as $p) {
echo $p['pago'] ;
}
?*/>
}

</script>-->

<script type="text/javascript">
    function resetal()
    {

        var op_pago = "<?php echo $reserva->op_pago; ?>";                               
        var otheramount = "<?php echo $reserva->otheramount; ?>";  
        var op_pago_conductor = "<?php echo $op_pago_conductor; ?>";
        var tempwf = "<?php echo $cargos; ?>";
        var temp = "<?php echo $total_charge; ?>";
        var pre_paid_amount = "<?php echo $pre_paid_amount; ?>";
        var pay_amount = "<?php echo $reserva->pay_amount; ?>";

        var descuento_valor = "<?php echo $reserva->descuento_valor; ?>";
        var extra_cargo = "<?php echo $reserva->extra_charge; ?>";
        var descuento_porcentaje = "<?php echo $reserva->descuento_procentaje ?>";

//                                $("#otheramount").val((otheramount).toFixed(2));
        document.getElementById('otheramount').value =  otheramount;

        if (otheramount > 0) {


            var op_pago_conductor = parseFloat($("#selectcond").val());
            var paid_driver = parseFloat($("#paid_driver").val());
            //          var pay_amount = parseFloat($("#pay_amount").val()); 

            var apagar_2 = parseFloat(otheramount);

            var result = (parseFloat(apagar_2) + parseFloat(tempwf)).toFixed(2);
            var bd = (parseFloat(result) - parseFloat(paid_driver)).toFixed(2);

            if(op_pago_conductor == "3"){

                setTimeout(function () {   

                    var balance = parseFloat($("#balance_due").val());
                    var porcbal = balance*0.04;
                    var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                    $("#balance_due").val((tot_balance).toFixed(2));
                    $("#bal_duep").val((tot_balance).toFixed(2));            


                }, 0.01);

            }





            document.getElementById('saldoporpagar').value = result;
            document.getElementById('pago_driver').value = '';
            document.getElementById('pago_driver').style.color = '#848484';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('totalPagar').value = '0.00';      
            //document.getElementById('temp').value = '0.00';   
            document.getElementById('pago_tarjeta').value = '0.00';
            
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
        
            
            
            document.getElementById('collect').value = "<?php echo $reserva->paid_driver; ?>";
            document.getElementById('prepaid').value = "<?php echo $reserva->pred_paid_amount; ?>";
            document.getElementById('paid_driver').value = "<?php echo $reserva->paid_driver; ?>";
            document.getElementById('balance_due').value = bd;                                    
            document.getElementById('temp').value = "<?php echo $reserva->total_charge; ?>";
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById('tot_charge').value = "<?php echo $reserva->total_charge; ?>";
            document.getElementById('paid_drivert').value = "<?php echo $reserva->paid_driver; ?>";
            document.getElementById('pay_amount').value = "<?php echo $reserva->pred_paid_amount; ?>";
            document.getElementById('pred_paid_amountt').value = "<?php echo $reserva->pred_paid_amount; ?>";
            document.getElementById('tot_amount_paid').value = "<?php echo $reserva->total_paid; ?>";
            //document.getElementById('pago_driver').disabled = false;
            document.getElementById('btnAceptar').style.background = '';
            document.getElementById('btnAceptar').style.color = '#000';
            document.getElementById('pago_agente').style.display = 'none';
            document.getElementById('pago_agente1').style.display = 'block';
            document.getElementById('dolares').style.color = '#848484';
            document.getElementById('btnAceptar').style.cursor = '';

            document.getElementById('op_pago_id1').value = 0;
            document.getElementById('op_pago_id').value = op_pago;
            document.getElementById('op_pago_conductor').value = op_pago_conductor;
            document.getElementById('descuento_valor').value = descuento_valor;
            document.getElementById('descuento').value = descuento_porcentaje;
            document.getElementById('extra').value = extra_cargo;
            document.getElementById('paid_driver').style.color = "#000";
            document.getElementById('pay_amount').style.color = "#000";
            document.getElementById('pay_amount').className = "azu";
            document.getElementById('paid_driver').className = "brown3";
            document.getElementById('paid_driver').title =""; 
            document.getElementById('pay_amount').title =""; 

//                                    selector();
//                                    captura(); 
            //passenger_balance2();


        } else {

            //document.getElementById('saldoporpagar').value = saldoporpagar; 

            var op_pago_conductor = "<?php echo $op_pago_conductor; ?>";

            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver').style.color = '#848484';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_tarjeta').value = '0.00';
            
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
            //document.getElementById('totalPagar').value = '0.00';      
            //document.getElementById('temp').value = '0.00';   
            document.getElementById('collect').value = "<?php echo $reserva->paid_driver; ?>";
            document.getElementById('prepaid').value = "<?php echo $reserva->pred_paid_amount; ?>";
            document.getElementById('paid_driver').value = "<?php echo $reserva->paid_driver; ?>";
            
            
            //document.getElementById('balance_due').value = "<?php echo $reserva->passenger_balance_due; ?>";
            document.getElementById('temp').value = "<?php echo $reserva->total_charge; ?>";
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById('tot_charge').value = "<?php echo $reserva->total_charge; ?>";
            document.getElementById('paid_drivert').value = "<?php echo $reserva->paid_driver; ?>";
            document.getElementById('pay_amount').value = "<?php echo $reserva->pred_paid_amount; ?>";
            document.getElementById('pred_paid_amountt').value = "<?php echo $reserva->pred_paid_amount; ?>";
            document.getElementById('tot_amount_paid').value = "<?php echo $reserva->total_paid; ?>";
            //document.getElementById('pago_driver').disabled = false;
            document.getElementById('btnAceptar').style.background = '';
            document.getElementById('btnAceptar').style.color = '#000';
            document.getElementById('pago_agente').style.display = 'none';
            document.getElementById('pago_agente1').style.display = 'block';
            document.getElementById('dolares').style.color = '#848484';
            document.getElementById('btnAceptar').style.cursor = '';
            document.getElementById('paid_driver').style.color = "#000";
            document.getElementById('pay_amount').style.color = "#000";
            document.getElementById('pay_amount').className = "azu";
            document.getElementById('paid_driver').className = "brown3";
            document.getElementById('paid_driver').title =""; 
            document.getElementById('pay_amount').title =""; 

            document.getElementById('op_pago_id1').value = 0;
            //document.getElementById('op_pago_conductor').value = op_pago_conductor;

//                                    selector();
//                                    captura(); 
            //passenger_balance2();

        }


    }
</script>

<script type="text/javascript">

    function pregunta(e) {
        if (confirm('¿Esta seguro de que desea Editar esta Reserva?')) {
            
            document.getElementById('modal').style.display = "none";
            document.getElementbyId('mostrar-modal').style.display = "none";


        } else {
            e.preventDefault();
        }
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


    }
</script>

<script type="text/javascript">
    function fechale()
    {

        var fecha1 = document.getElementById('fecha_salida').value;
        var trip = "";
        var d = new Date(fecha1); 
        var dia = ("0" + (d.getDate())).slice(-2);                                               
        var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
        var yyy = d.getFullYear();
        var fechita = yyy + '-' + mes + '-' + dia;

        $("#fec_salida_ns").val(fechita); 
        $("#fec_salida_ns1").val(fechita); 
        $("#trip_no").val(trip); 
        $("#estado_oneway").val(1); 

        document.getElementsByName('estado_one').value = "1";
        document.getElementById('estado_one').value = "1";



    }
</script>

<script type="text/javascript">
    function fechale2()
    {

        var fecha2 = document.getElementById('fecha_retorno').value;
        var trip2 = "";
        var d = new Date(fecha2); 
        var dia = ("0" + (d.getDate())).slice(-2);                                               
        var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
        var yyy = d.getFullYear();
        var fechita = yyy + '-' + mes + '-' + dia;

        $("#fec_retorno_ns").val(fechita); 
        $("#fec_retorno_ns1").val(fechita); 
        $("#trip_no2").val(trip2);   
        $("#estado_roundtrip").val(1); 

        document.getElementsByName('estado_round').value = "1";
        document.getElementById('estado_round').value = "1";
    }
</script>

<!--</form>-->
<script>

    function calculos() {


        var opcion = $("#op_pago_id1").val();

        //PRED-PAID////////////////////////////////////////////

        //Credit Card no fee

        if (opcion === '20') {

            //alert('opcion 20');
            if (confirm('Confirme su Tipo de Pago !!!')) {

                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var prepaid = parseFloat($("#prepaid").val());
                var kollect = parseFloat($("#pago_driver").val());
                
                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;
                
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
                    
                }else if(no_prep == 2){
                    
                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((kollect).toFixed(2));
                    
                }else if(no_prep == 3){
                    
                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((kollect).toFixed(2));
                    
                }else if(no_prep == 4){
                    
                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((kollect).toFixed(2));
                    
                }else if(no_prep == 5){
                    
                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((kollect).toFixed(2));
                    
                }else if(no_prep == 6){
                    
                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((kollect).toFixed(2));
                    
                }else if(no_prep == 7){
                    
                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((kollect).toFixed(2));
                    
                }else if(no_prep == 8){
                    
                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((kollect).toFixed(2));
                    
                }else if(no_prep == 9){
                    
                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((kollect).toFixed(2));
                    
                }else if(no_prep == 10){
                    
                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((kollect).toFixed(2));
                    
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

                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';

                document.getElementById('opcion_pago_2').value = 2;

                document.getElementById('opcion_pago_3').value = 2;
                //document.getElementById('op_pago_id').value = 8;

                valida_clase2();
                
                }

            } else {
                // Do nothing!
                //exit();
                Exit2();
            }


        }

        //Credit Card with fee

        if (opcion === '21') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());

                var valor = parseFloat(pago_driver2) * 0.04;
                var total = parseFloat(pago_driver2) + parseFloat(valor);
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;
                
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
                
                $("#tot_charge").val((temp).toFixed(2));
                $("#PAP").val((valor).toFixed(2));
                
                
                if(no_prep == 1){
                    
                                      
                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    
                }else if(no_prep == 2){
                    
                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((total).toFixed(2));
                    
                }else if(no_prep == 3){
                    
                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((total).toFixed(2));
                    
                }else if(no_prep == 4){
                    
                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((total).toFixed(2));
                    
                }else if(no_prep == 5){
                    
                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((total).toFixed(2));
                    
                }else if(no_prep == 6){
                    
                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((total).toFixed(2));
                    
                }else if(no_prep == 7){
                    
                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((total).toFixed(2));
                    
                }else if(no_prep == 8){
                    
                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((total).toFixed(2));
                    
                }else if(no_prep == 9){
                    
                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((total).toFixed(2));
                    
                }else if(no_prep == 10){
                    
                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((total).toFixed(2));
                    
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
                
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('opcion_pago_2').value = 1;
                document.getElementById('opcion_pago_3').value = 1;
                //document.getElementById('op_pago_id').value = 8;

                valida_clase2();

               }
               
            } else {
                // Do nothing!
                //exit;
                Exit2();
            }


        }

        //Cash
        if (opcion === '22') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                var pago_driver2 = parseFloat($("#pago_driver2").val());
                var total = parseFloat(pago_driver2);
                var valor = 0;
                var prepaid = parseFloat($("#prepaid").val());
                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                
                var no_prep =  document.getElementById("no_prep").value;
                no_prep = parseInt(no_prep) + 1;
                
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
                $("#no_prep").val(no_prep);
                $("#prepaid").val((prepaid).toFixed(2));
                $("#pago_driver").val((total).toFixed(2));
                $("#PAP").val((valor).toFixed(2));
                
                
                if(no_prep == 1){
                    
                                      
                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    
                }else if(no_prep == 2){
                    
                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((total).toFixed(2));
                    
                }else if(no_prep == 3){
                    
                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((total).toFixed(2));
                    
                }else if(no_prep == 4){
                    
                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((total).toFixed(2));
                    
                }else if(no_prep == 5){
                    
                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((total).toFixed(2));
                    
                }else if(no_prep == 6){
                    
                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((total).toFixed(2));
                    
                }else if(no_prep == 7){
                    
                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((total).toFixed(2));
                    
                }else if(no_prep == 8){
                    
                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((total).toFixed(2));
                    
                }else if(no_prep == 9){
                    
                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((total).toFixed(2));
                    
                }else if(no_prep == 10){
                    
                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((total).toFixed(2));
                    
                }


                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';
                
                document.getElementById("btndecline").disabled = false;
                document.getElementById("btndecline").style.display = "";
                document.getElementById("btndecline").style.cursor = 'pointer'; 
                
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';                
                document.getElementById('opcion_pago_2').value = 6;
                document.getElementById('opcion_pago_3').value = 6;
                //document.getElementById('op_pago_id').value = 8;

                valida_clase2();
                
                }

            } else {
                // Do nothing!
                //exit;
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
                    
                }else if(no_prep == 2){
                    
                    document.getElementById("pago_pre2").value = no_prep;
                    document.getElementById("pagopre2").value = pago;
                    document.getElementById("tipo_pagopre2").value= tipo_pago;
                    $("#pagadopre2").val((total).toFixed(2));
                    
                }else if(no_prep == 3){
                    
                    document.getElementById("pago_pre3").value = no_prep;
                    document.getElementById("pagopre3").value = pago;
                    document.getElementById("tipo_pagopre3").value= tipo_pago;
                    $("#pagadopre3").val((total).toFixed(2));
                    
                }else if(no_prep == 4){
                    
                    document.getElementById("pago_pre4").value = no_prep;
                    document.getElementById("pagopre4").value = pago;
                    document.getElementById("tipo_pagopre4").value= tipo_pago;
                    $("#pagadopre4").val((total).toFixed(2));
                    
                }else if(no_prep == 5){
                    
                    document.getElementById("pago_pre5").value = no_prep;
                    document.getElementById("pagopre5").value = pago;
                    document.getElementById("tipo_pagopre5").value= tipo_pago;
                    $("#pagadopre5").val((total).toFixed(2));
                    
                }else if(no_prep == 6){
                    
                    document.getElementById("pago_pre6").value = no_prep;
                    document.getElementById("pagopre6").value = pago;
                    document.getElementById("tipo_pagopre6").value= tipo_pago;
                    $("#pagadopre6").val((total).toFixed(2));
                    
                }else if(no_prep == 7){
                    
                    document.getElementById("pago_pre7").value = no_prep;
                    document.getElementById("pagopre7").value = pago;
                    document.getElementById("tipo_pagopre7").value= tipo_pago;
                    $("#pagadopre7").val((total).toFixed(2));
                    
                }else if(no_prep == 8){
                    
                    document.getElementById("pago_pre8").value = no_prep;
                    document.getElementById("pagopre8").value = pago;
                    document.getElementById("tipo_pagopre8").value= tipo_pago;
                    $("#pagadopre8").val((total).toFixed(2));
                    
                }else if(no_prep == 9){
                    
                    document.getElementById("pago_pre9").value = no_prep;
                    document.getElementById("pagopre9").value = pago;
                    document.getElementById("tipo_pagopre9").value= tipo_pago;
                    $("#pagadopre9").val((total).toFixed(2));
                    
                }else if(no_prep == 10){
                    
                    document.getElementById("pago_pre10").value = no_prep;
                    document.getElementById("pagopre10").value = pago;
                    document.getElementById("tipo_pagopre10").value= tipo_pago;
                    $("#pagadopre10").val((total).toFixed(2));
                    
                }

                

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';
                
                document.getElementById("btndecline").disabled = false;
                document.getElementById("btndecline").style.display = "";
                document.getElementById("btndecline").style.cursor = 'pointer'; 
                
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('opcion_pago_2').value = 10;
                document.getElementById('opcion_pago_3').value = 10;

                valida_clase2();
                
                }
                
            } else {
                // Do nothing!
                //exit;
                Exit2();
            }

        }

         /*COLLECT ON BOARD////////////////////////////////////*/

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
                    
                }else if(no_pago == 2){
                    
                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((kollect).toFixed(2));
                    
                }else if(no_pago == 3){
                    
                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((kollect).toFixed(2));
                    
                }else if(no_pago == 4){
                    
                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((kollect).toFixed(2));
                    
                }else if(no_pago == 5){
                    
                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((kollect).toFixed(2));
                    
                }else if(no_pago == 6){
                    
                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((kollect).toFixed(2));
                    
                }else if(no_pago == 7){
                    
                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((kollect).toFixed(2));
                    
                }else if(no_pago == 8){
                    
                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((kollect).toFixed(2));
                    
                }else if(no_pago == 9){
                    
                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((kollect).toFixed(2));
                    
                }else if(no_pago == 10){
                    
                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((kollect).toFixed(2));
                    
                }

                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';
                
                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';
                
                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';
                
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 8;
                document.getElementById('opcion_pago_driver').value = 8;                                      

                valida_clase();
                
                }

            } else {
                // Do nothing!
                //exit;
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
                var tot_cargo = parseFloat(pago_driver) - parseFloat(valor);
                var temp_driver = parseFloat($("#temp_driver").val());                                        
                //var temp_prepaid = parseFloat($("#temp_prepaid").val());
                var temp = parseFloat($("#temp").val());
                
                var no_pago =  document.getElementById("no_pago").value;                
                no_pago = parseInt(no_pago) + 1;
                
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
                    
                }else if(no_pago == 2){
                    
                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((total).toFixed(2));
                    
                }else if(no_pago == 3){
                    
                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((total).toFixed(2));
                    
                }else if(no_pago == 4){
                    
                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((total).toFixed(2));
                    
                }else if(no_pago == 5){
                    
                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((total).toFixed(2));
                    
                }else if(no_pago == 6){
                    
                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((total).toFixed(2));
                    
                }else if(no_pago == 7){
                    
                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((total).toFixed(2));
                    
                }else if(no_pago == 8){
                    
                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((total).toFixed(2));
                    
                }else if(no_pago == 9){
                    
                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((total).toFixed(2));
                    
                }else if(no_pago == 10){
                    
                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((total).toFixed(2));
                    
                }
                

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';
                
                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';
                
                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';
                
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 3;
                document.getElementById('opcion_pago_driver').value = 3;

                valida_clase();
                
                }

            } else {
                // Do nothing!
                //exit;
                //reset();
                Exit2();
            }

        }

        //Cash
        if (opcion === '26') {

            if (confirm('Confirme su Tipo de Pago !!!')) {
                //var cash = $('#op_pago_id1').val();

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
                    
                }else if(no_pago == 2){
                    
                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((kollect).toFixed(2));
                    
                }else if(no_pago == 3){
                    
                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((kollect).toFixed(2));
                    
                }else if(no_pago == 4){
                    
                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((kollect).toFixed(2));
                    
                }else if(no_pago == 5){
                    
                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((kollect).toFixed(2));
                    
                }else if(no_pago == 6){
                    
                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((kollect).toFixed(2));
                    
                }else if(no_pago == 7){
                    
                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((kollect).toFixed(2));
                    
                }else if(no_pago == 8){
                    
                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((kollect).toFixed(2));
                    
                }else if(no_pago == 9){
                    
                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((kollect).toFixed(2));
                    
                }else if(no_pago == 10){
                    
                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((kollect).toFixed(2));
                    
                }
               


                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';
                
                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';
                
                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';
                
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 4;
                document.getElementById('opcion_pago_driver').value = 4;

                valida_clase();
                
                }

            } else {
                // Do nothing!
                //exit;
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
                no_pago = parseInt(no_pago) + 1;
                
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
                    
                }else if(no_pago == 2){
                    
                    document.getElementById("pago_2").value = no_pago;
                    document.getElementById("pago2").value = pago;
                    document.getElementById("tipo_pago2").value= tipo_pago;
                    $("#pagado2").val((kollect).toFixed(2));
                    
                }else if(no_pago == 3){
                    
                    document.getElementById("pago_3").value = no_pago;
                    document.getElementById("pago3").value = pago;
                    document.getElementById("tipo_pago3").value= tipo_pago;
                    $("#pagado3").val((kollect).toFixed(2));
                    
                }else if(no_pago == 4){
                    
                    document.getElementById("pago_4").value = no_pago;
                    document.getElementById("pago4").value = pago;
                    document.getElementById("tipo_pago4").value= tipo_pago;
                    $("#pagado4").val((kollect).toFixed(2));
                    
                }else if(no_pago == 5){
                    
                    document.getElementById("pago_5").value = no_pago;
                    document.getElementById("pago5").value = pago;
                    document.getElementById("tipo_pago5").value= tipo_pago;
                    $("#pagado5").val((kollect).toFixed(2));
                    
                }else if(no_pago == 6){
                    
                    document.getElementById("pago_6").value = no_pago;
                    document.getElementById("pago6").value = pago;
                    document.getElementById("tipo_pago6").value= tipo_pago;
                    $("#pagado6").val((kollect).toFixed(2));
                    
                }else if(no_pago == 7){
                    
                    document.getElementById("pago_7").value = no_pago;
                    document.getElementById("pago7").value = pago;
                    document.getElementById("tipo_pago7").value= tipo_pago;
                    $("#pagado7").val((kollect).toFixed(2));
                    
                }else if(no_pago == 8){
                    
                    document.getElementById("pago_8").value = no_pago;
                    document.getElementById("pago8").value = pago;
                    document.getElementById("tipo_pago8").value= tipo_pago;
                    $("#pagado8").val((kollect).toFixed(2));
                    
                }else if(no_pago == 9){
                    
                    document.getElementById("pago_9").value = no_pago;
                    document.getElementById("pago9").value = pago;
                    document.getElementById("tipo_pago9").value= tipo_pago;
                    $("#pagado9").val((kollect).toFixed(2));
                    
                }else if(no_pago == 10){
                    
                    document.getElementById("pago_10").value = no_pago;
                    document.getElementById("pago10").value = pago;
                    document.getElementById("tipo_pago10").value= tipo_pago;
                    $("#pagado10").val((kollect).toFixed(2));
                    
                }
              

                document.getElementById("op_pago_id1").disabled = true;
                document.getElementById("pago_driver").disabled = true;
                document.getElementById('pago_driver').style.color = '#848484';
                
                document.getElementById("btndecline").disabled = true;
                document.getElementById("btndecline").style.display = "none";
                document.getElementById("btndecline").style.cursor = '';
                
                document.getElementById("btncancol").disabled = false;
                document.getElementById("btncancol").style.display = "";
                document.getElementById("btncancol").style.cursor = 'pointer';
                
                
                document.getElementById('btnAceptar').style.cursor = 'pointer';
                document.getElementById("btnAceptar").disabled = false;
                document.getElementById('btnAceptar').style.background = '#006400';
                document.getElementById('btnAceptar').style.color = '#fff';
                document.getElementById('op_pago_id').value = 9;
                document.getElementById('opcion_pago_driver').value = 9;
                //valida clase de pago
                valida_clase();
                
                }

            } else {
                // Do nothing!
                //exit;
                Exit2();
            }

        }



    }
</script>



<script type="text/javascript">
    function ClkPay_Amount()
    {

        var clone = document.getElementById('otheramount').value;
        var pd = document.getElementById('paid_driver').value;


        if (clone == '') {

            document.getElementById('otheramount').value = '0.00';
            document.getElementById('etb').value = '0.00';

        }

        if (clone == '0.0') {

            document.getElementById('otheramount').value = '0.00';
            document.getElementById('etb').value = '0.00';
        }


        if (clone == '.00') {

            document.getElementById('otheramount').value = '0.00';
            document.getElementById('etb').value = '0.00';
        }

        if (clone > 0) {


            document.getElementById('saldoporpagar').value = clone;
            document.getElementById('paid_driver').value = pd;

            $("#saldoporpagar").val((clone).toFixed(2));

            setTimeout(function () {

                //$('#paid_driver').click();
                CalcularTotalTotal();

            }, 0.001);


            //$("#balance_due").val((clone-pd).toFixed(2));



        }

        if (clone == '0.') {

            document.getElementById('otheramount').value = '0.00';
            document.getElementById('etb').value = '0.00';
        }


        if (clone == '0') {

            document.getElementById('otheramount').value = '0.00';
            document.getElementById('etb').value = '0.00';
        }
        setTimeout(function () {
            //$('#paid_driver').click();
            CalcularTotalTotal();

        }, 0.001);


    }
</script>
  

<script type="text/javascript">
    function cargando()
    {
        var trip2 = $("#trip_2").val();
        
        
        if(trip2 == 0){
            
            document.getElementById('save2').style.display = '';
            
            //document.getElementById('save2').style.marginTop = "-1050px"; 
            
            if (window.screen.availWidth == 1024) {
                window.parent.document.body.style.zoom = "100%";   
                document.getElementById("save2").style.marginTop = "-1049px";
            }
            
            if (window.screen.availWidth == 1280) {
                window.parent.document.body.style.zoom = "100%";   
                document.getElementById("save2").style.marginTop = "-1092px";
            }
            
            if (window.screen.availWidth == 1366) {
                window.parent.document.body.style.zoom = "100%";   
                document.getElementById("save2").style.marginTop = "-1092px";
            }
            
            if (window.screen.availWidth == 1440) {
                window.parent.document.body.style.zoom = "110%";
                document.getElementById("save2").style.marginTop = "-1074px";
            }
            
            if (window.screen.availWidth == 1600) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1093px";
            }
            
            if (window.screen.availWidth == 1680) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1058px";
            }

            
            if (window.screen.availWidth > 1680) {
               window.parent.document.body.style.zoom = "125%";
               document.getElementById("save2").style.marginTop = "-1050px";
            }
            
        }else{
            
            document.getElementById('save2').style.display = '';
            
            if (window.screen.availWidth == 1024) {
                window.parent.document.body.style.zoom = "100%";   
                document.getElementById("save2").style.marginTop = "-1437px";
            }
            
            if (window.screen.availWidth == 1280) {
                window.parent.document.body.style.zoom = "100%";   
                document.getElementById("save2").style.marginTop = "-1434px";
            }
            
            if (window.screen.availWidth == 1366) {
                window.parent.document.body.style.zoom = "100%";   
                document.getElementById("save2").style.marginTop = "-1434px";
            }
            
            if (window.screen.availWidth == 1440) {
                window.parent.document.body.style.zoom = "110%";
                document.getElementById("save2").style.marginTop = "-1408px";
            }
            
            if (window.screen.availWidth == 1600) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1432px";
            }
            
            if (window.screen.availWidth == 1680) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1397px";
            }        
            
            
            if (window.screen.availWidth > 1680) {
               window.parent.document.body.style.zoom = "125%";
               document.getElementById("save2").style.marginTop = "-1393px";
            }                
                
            //document.getElementById('save2').style.marginTop = "-1393px";
        }
        
        

    }
</script>

<!--</form>-->
<!--<div class="container" >           

            <section class="main-content">                
                
                  
                    <input id="fullscreen" type="button" value="Full Screen" style="" />
                    <button id="cancel-fullscreen">Cancel fullscreen</button>
                
            </section>
           
</div>-->

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
            document.getElementById("op_pago_id1").disabled = true;

            document.getElementById('pago_driver').style.color = '#848484';

            document.getElementById('dolares').style.color = '#848484';

            $("#pago_driver").focus();
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
//        document.getElementById('op_pago_id').value = 8;
//        document.getElementById('opcion_pago_driver').value = 8;

    }
</script>


<script type="text/javascript">
    function Exit2()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.display = 'none'; // Y lo hacemos invisible
        resetal();
        mostrarVentana2();

    }
</script>

<script type="text/javascript">

    function passenger_balance()
    {

        //$('op_pago_conductor option[value="<?php /*echo $op_pago_conductor;*/ ?>"]').attr("selected", true);
        
        //credit card with fee
        var op = document.getElementById('op_pago_conductor').value;
        var otheramount = parseFloat($("#otheramount").val());
        
        if (op == '3' && otheramount >= '0') {  
            
                        
            document.getElementById('op_pago_conductor').value = "3";  
            document.getElementById('op_pago_id').value = "3";
            
        
            setTimeout(function () {

                
                var balance = parseFloat($("#balance_due").val());
                var porcbal = balance*0.04;
                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                $("#balance_due").val((tot_balance).toFixed(2));
                $("#bal_duep").val((tot_balance).toFixed(2));


            }, 0.01);

        //credit card no fee
        }else if (op == '8' && otheramount >= '0') {              
                          
             document.getElementById('op_pago_conductor').value = "8";
             document.getElementById('op_pago_id').value = "8";
             //resetal();
             CalcularTotalTotal();
             document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;
             
        //cash
        }else if (op == '4' && otheramount >= '0') {      
           
            document.getElementById('op_pago_conductor').value = "4";
            document.getElementById('op_pago_id').value = "4";
            //resetal();
            CalcularTotalTotal(); 
            document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;
            
        //check
        }else if (op == '9' && otheramount >= '0') {                        
            
            
            document.getElementById('op_pago_conductor').value = "9";
            document.getElementById('op_pago_id').value = "9";
            //resetal();
            CalcularTotalTotal();
            document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;
            
        //credit voucher
        }else if (op == '5' && otheramount >= '0') {                        
            
           
            document.getElementById('op_pago_conductor').value = "5";
            document.getElementById('op_pago_id').value = "5";
            
            setTimeout(function () {
                
                var cv = 0;
                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;
                
            }, 0.01);
            
        //complementary    
        }else if (op == '7' && otheramount >= '0') {
            
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
                $("#tot_amount_paid").val((cv).toFixed(2));
                $("#agency_balance_due").val((cv).toFixed(2));
                $("#otheramount").val((cv).toFixed(2));
                document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;
                
            }, 0.01);    
            
        }

    }

</script>

<script type="text/javascript">

    function passenger_balance22()
    {

        //$('op_pago_conductor option[value="<?php /*echo $op_pago_conductor;*/ ?>"]').attr("selected", true);
        
        //credit card with fee
        if (rup == 3) {  
            
                        
            document.getElementById('op_pago_conductor').value = "3"; 
            
        
            setTimeout(function () {

                var gt = "<?php echo $passenger_balance_due; ?>";
               // alert(gt);
                //var balance = parseFloat($("#balance_due").val());
//                var balance = gt;
//                var porcbal = balance*0.04;
//                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          
//
//                $("#balance_due").val((tot_balance).toFixed(2));


            }, 0.01);

        //credit card no fee
        }else if (rup == 8) {              
                          
             document.getElementById('op_pago_conductor').value = "8";
             CalcularTotalTotal();
             
        //cash
        }else if (rup == 4) {      
           
            document.getElementById('op_pago_conductor').value = "4";
            CalcularTotalTotal();  
            
        //check
        }else if (rup == 9) {                        
            
            
            document.getElementById('op_pago_conductor').value = "9";
            CalcularTotalTotal();
            
        //credit voucher
        }else if (rup == 5) {                        
            
           
            document.getElementById('op_pago_conductor').value = "5";
            
            setTimeout(function () {
                
                var cv = 0;
                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                
            }, 0.01);
            
        //complementary    
        }else if (rup == 7) {
            
            document.getElementById('op_pago_conductor').value = "7";
            
            setTimeout(function () {
                
                var cv = 0;
                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#totalPagar").val((cv).toFixed(2));
                $("#totaltotal").text((cv).toFixed(2));
                $("#pay_amount").val((cv).toFixed(2));
                $("#tot_amount_paid").val((cv).toFixed(2));
                $("#agency_balance_due").val((cv).toFixed(2));
                $("#otheramount").val((cv).toFixed(2));
                
            }, 0.01);    
            
        }

    }

</script>


<script type="text/javascript">

    var rup
    
    function captura()
    {
        //var pc = "<?php echo $op_pago_conductor; ?>";
        
        var result = document.getElementsByName("op_pago_conductor")[0].value;
        

        rup = document.getElementById("result").innerHTML = " \ " + result; 
        
               
        $("#selectcond").val(result);

    }
</script>

<script type="text/javascript">

      
    function selector()
    {
       
        //var pc = "<?php echo $op_pago_conductor; ?>";
        
        var pc = rup;
        
        if(pc == 8){        
            document.getElementById("op_pago_conductor").selectedIndex = 0;
        }else if(pc == 3){
            document.getElementById("op_pago_conductor").selectedIndex = 1; 
        }else if(pc == 4){
            document.getElementById("op_pago_conductor").selectedIndex = 2; 
        }else if(pc == 9){
            document.getElementById("op_pago_conductor").selectedIndex = 3;
        }else if(pc == 5){
            document.getElementById("op_pago_conductor").selectedIndex = 4;
        }else if(pc == 7){
            document.getElementById("op_pago_conductor").selectedIndex = 5;
        }


    }
    
</script>


<script type="text/javascript">

    function mostrarVentana2() {

        capturar();


        if (window.screen.availWidth <= 640) {

            window.parent.document.body.style.zoom = "62%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '174px';
        }

        if (window.screen.availWidth == 800) {

            window.parent.document.body.style.zoom = "78%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';
        }
        if (window.screen.availWidth == 960 && z == 1) {

            window.parent.document.body.style.zoom = "78%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';
        }

        if (window.screen.availWidth == 960 && z == 2) {

            window.parent.document.body.style.zoom = "78%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "221px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';
        }

        if (window.screen.availWidth == 1024 && z == 1) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';


        }

        if (window.screen.availWidth == 1024 && z == 2) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "221px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-444.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';


        }


        if (window.screen.availWidth == 1280 && z == 1) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-321.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';


        }

        if (window.screen.availWidth == 1280 && z == 2) {

            window.parent.document.body.style.zoom = "100%";
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "221px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-321.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';


        }



        if (window.screen.availWidth == 1366 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-9px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1366 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "222px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1440 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-1.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1440 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "229.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1600 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-15.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1600 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "215.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1680 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "-15.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }

        if (window.screen.availWidth == 1680 && z == 2) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//            ventana2.style.marginTop = "215.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-240.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }



        if (window.screen.availWidth > 1680 && z == 1) {


            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  


//            ventana2.style.marginTop = "-2.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-190.4px"; // Definimos su posición horizontal
//            ventana2.style.top = "760px"; // Definimos su posición vertical.        
//            ventana2.style.left = "835px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';


        }

        if (window.screen.availWidth > 1680 && z == 2) {

            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor   

//            ventana2.style.marginTop = "228.5px"; // Definimos su posición vertical.        
//            ventana2.style.marginLeft = "-190.4px"; // Definimos su posición horizontal

//            ventana2.style.top = "1094px"; // Definimos su posición vertical.        
//            ventana2.style.left = "834px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
//            ventana2.style.position = 'absolute';
            ventana2.style.height = '169px';

        }


        
        document.getElementById("pago_driver").disabled = false;
        document.getElementById('pago_driver').value = '';
        document.getElementById('pago_driver').style.color = '#848484';
        document.getElementById('pago_driver').style.background = '#fff';
        $("#pago_driver").focus();

        document.getElementById('op_pago_id1').value = 0;
        //document.getElementById('op_pago_id').value = 8;
        document.getElementById('opcion_pago_2').value = 2;
        //document.getElementById('opcion_pago_3').value = 2;
        
        document.getElementById("btnAceptar").disabled = true;        
        document.getElementById("btnAceptar").style.background = "lightgray";
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


        //AMOUNT PAID LABEL LIST
        if (opcion === '0') {

//            document.getElementById('paid_driver').value = '0.00';
//            document.getElementById('pay_amount').value = '0.00';
//            document.getElementById('paid_drivert').value = '0.00';
//            document.getElementById('pred_paid_amountt').value = '0.00';


            setTimeout(function () {
                //$('#pay_amount').click();
                CalcularTotalTotal();

            }, 0.001);

            setTimeout(function () {
                //$('#paid_driver').click();
                CalcularTotalTotal();

            }, 0.001);

            $("#pago_driver").focus();


        }
        //PAID DRIVER LABEL LIST
        if (opcion === '1') {

//            document.getElementById('paid_driver').value = '0.00';
//            document.getElementById('pay_amount').value = '0.00';
//            document.getElementById('paid_drivert').value = '0.00';
//            document.getElementById('pred_paid_amountt').value = '0.00';

            setTimeout(function () {
                //$('#pay_amount').click();
                CalcularTotalTotal();

            }, 0.001);

            setTimeout(function () {
                //$('#paid_driver').click();
                CalcularTotalTotal();

            }, 0.001);

            $("#pago_driver").focus();

        }

        //***********************************************PRED-PAID*************************************************************************//////
        //*********************************************************************************************************************************//////

        //CREDIT CARD NO FEE

        if (opcion === '20') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('pay_amount').value = prepaid;
                document.getElementById('pred_paid_amountt').value = prepaid;

                var prep = parseFloat($("#pred_paid_amountt").val());
                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));


                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                    document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('pay_amount').title ="Pago sin Guardar"; 
                    
                    //make_charge();
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    

                }, 0.001);

                $("#pago_driver").focus();
                Exit();

            } else {
                // Do nothing!
                
                var no_prep =  document.getElementById("no_prep").value;
                
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
                
                $("#pago_driver").focus();
                Exit();


            }



        }

        //CREDIT CARD WITH FEE
        if (opcion === '21') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('pay_amount').value = prepaid;
                document.getElementById('pred_paid_amountt').value = prepaid;

                var prep = parseFloat($("#pred_paid_amountt").val());
                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                    document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('pay_amount').title ="Pago sin Guardar"; 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    
                    //make_charge();

                }, 0.001);

                $("#pago_driver").focus();


                Exit();


            } else {
                // Do nothing!
                
                var no_prep =  document.getElementById("no_prep").value;
                
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
                
                $("#pago_driver").focus();
                Exit();

            }

        }

        //CASH
        if (opcion === '22') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;
                document.getElementById('pred_paid_amountt').value = prepaid;

                var prep = parseFloat($("#pred_paid_amountt").val());
                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                    document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('pay_amount').title ="Pago sin Guardar"; 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                   

                }, 0.001);


                Exit();

            } else {
                // Do nothing!
                var no_prep =  document.getElementById("no_prep").value;
                
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
                
                $("#pago_driver").focus();
                Exit();

            }

        }

        //CHECK
        if (opcion === '23') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('pay_amount').value = prepaid;
                document.getElementById('pred_paid_amountt').value = prepaid;

                var prep = parseFloat($("#pred_paid_amountt").val());
                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                setTimeout(function () {
                    //$('#pay_amount').click();
                    CalcularTotalTotal();
//                    document.getElementById('pay_amount').style.color = "#0000FF";
                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                    document.getElementById('pay_amount').className = "flashit2";
//                    document.getElementById('guardar').className = "flashit2";
                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                    document.getElementById('pay_amount').title ="Pago sin Guardar"; 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    

                }, 0.001);

                $("#pago_driver").focus();


                Exit();

            } else {
                // Do nothing!
                
                var no_prep =  document.getElementById("no_prep").value;
                
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
                
                $("#pago_driver").focus();
                Exit();

            }

        }

        //*********************************************************COLLECT ON BOARD*************************************************************//////
        //**************************************************************************************************************************************//////

        //CREDIT CARD NO FEE

        if (opcion === '24') {



            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('paid_driver').value = collect;
                document.getElementById('paid_drivert').value = collect;


                var prep = parseFloat($("#pred_paid_amountt").val());

                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));
                setTimeout(function () {
                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                    document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                    document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                    
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    
                    
                    

                }, 0.001);

                $("#pago_driver").focus();

                
                Exit();
                // Save it!
            } else {
                // Do nothing!
                
                var no_pago =  document.getElementById("no_pago").value;
                
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
                
                $("#pago_driver").focus();
                Exit();

            }





        }

        //CREDIT CARD WITH FEE
        if (opcion === '25') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                var otheramount = document.getElementById('otheramount').value;

                var pd = document.getElementById('paid_driver').value;

                document.getElementById('paid_driver').value = collect;
                document.getElementById('paid_drivert').value = collect;



                var prep = parseFloat($("#pred_paid_amountt").val());

                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                setTimeout(function () {

                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                    document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                    document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    
                    
                }, 0.001);

                $("#pago_driver").focus();


//                if (otheramount > 0 && pd > 0) {
//
//                    setTimeout(function () {
//
//                        $('#btn_Other').click();
//
//                    }, 100);
//
//                }

                //document.getElementById('btn-save2').style.background = "#96db8e";               
                Exit();

            } else {
                // Do nothing!
                
                var no_pago =  document.getElementById("no_pago").value;
                
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
                
                $("#pago_driver").focus();
                Exit();

            }



        }

        //CASH
        if (opcion === '26') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('paid_driver').value = collect;

                document.getElementById('paid_drivert').value = collect;


                var prep = parseFloat($("#pred_paid_amountt").val());

                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));
//                var otheramount  = document.getElementById('otheramount').value;
//                
//                var pd  = document.getElementById('paid_driver').value;



                setTimeout(function () {
                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                    document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('paid_driver').style.backgroundColor = "#FF0000";
                    document.getElementById('paid_driver').title ="Pago sin Guardar";
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    

                }, 0.001);

                $("#pago_driver").focus();

//                if(otheramount > 0 && pd > 0 ){
//                    
//                setTimeout(function () {
//                            
//                            $('#btn_Other').click();   
//
//                }, 100);
//
//                }

                Exit();

            } else {
                // Do nothing!

                var no_pago =  document.getElementById("no_pago").value;
                
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
                
                $("#pago_driver").focus();
                Exit();

                
            }


        }

        //CHECK
        if (opcion === '27') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

//                var collect = $('#collect').val();
//                var prepaid = $('#prepaid').val();
//                
//                document.getElementById('tot_amount_paid').value = (collect) +(prepaid);

                document.getElementById('paid_driver').value = collect;

                document.getElementById('paid_drivert').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;

                var prep = parseFloat($("#pred_paid_amountt").val());

                var coll = parseFloat($("#paid_drivert").val());

//                $("#p_d_e").val((coll).toFixed(2));
//                $("#p_a_e").val((prep).toFixed(2));

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                setTimeout(function () {
                    //$('#paid_driver').click();
                    CalcularTotalTotal();
                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                    document.getElementById('paid_driver').className = "flashit";
//                    document.getElementById('guardar').className = "flashit";
                    document.getElementById('paid_driver').style.backgroundColor = "#FF0000";
                    document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    

                }, 0.001);

                $("#pago_driver").focus();

                Exit();

            } else {
                // Do nothing!
                
                var no_pago =  document.getElementById("no_pago").value;
                
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


                $("#pago_driver").focus();

                Exit();

            }

        }
        

    }
</script>

<!--<script language="JavaScript">
  window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
  }
</script>-->
<!--<script type="text/javascript">
    var bPreguntar = true;

    window.onbeforeunload = preguntarAntesDeSalir;
    
    function preguntarAntesDeSalir()
    {
        if (bPreguntar)   
        $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");            
        return "Salir de la ventana o actualizarla, Evitara que no se guarden los nuevos cambios hechos en esta reserva de Transportacion.";
    }
</script>-->

<!--<script type="text/javascript">
    var bPreguntar = false;
    
    function Salir()
    {
        if(bPreguntar === false){
        
            $("#puestosEnUso").load("<?php/* echo $data['rootUrl'];*/ ?>admin/reservas/ocuparPuestoUsuario/4");            
            return "Salir de la ventana o actualizarla, Evitara que no se guarden los nuevos cambios hechos en esta reserva de Transportacion.";

        }
    
    }
    
</script>   -->

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


<script type="text/javascript">
    $("#btnPagolinea").click(function () {
    //$("#pago_agente").click(function () {
//        var paid_driver = $("#paid_driver").val();
//        var pay_amount = $("#pay_amount").val();
//        var cantidad = parseFloat(paid_driver) + parseFloat(pay_amount);

        document.getElementById('btnPagolinea').style.display = 'none';
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

        if (segundo_n === '.') {
            segundo_n = '';
        }

        var url = encodeURI('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $reserva->codconf; ?>');

        window.open(url, '_blank');
        return false;
    });
    
    $(window).load(function () {
        
        
        
        ocultarmenu();
        comprobarScreen();
        sur_2015();
        estado_roundtrip();
        estado_oneway();
        
        selector();
        captura(); 
        facturado();
        //passenger_balance();
//        $("accordion").hide();
       
//        document.getElementbyId('fec_salida_ns1').value = document.getElementbyId('fec_salida_ns').value;
//        document.getElementbyId('fec_retorno_ns1').value = document.getElementbyId('fec_retorno_ns').value;
        
        document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;
        document.getElementById('descuentop').value = document.getElementById('descuento').value;
        document.getElementById('extrap').value = document.getElementById('extra').value;
        
        document.getElementById('pay_amountp').value = document.getElementById('pay_amount').value;
        document.getElementById('otheramountp').value = document.getElementById('otheramount').value;
        
        var btnpay = <?php echo $reserva->Btnpay; ?>;

        if (btnpay == 1) {

            setTimeout(function () {
                //$('#pay_driver').click();
                calcularTotalTotal();

            }, 0.001);

        }

        var fecsal = "<?php echo $reserva->fecha_salida_ns; ?>";
        document.getElementById('fec_salida_ns1').value = fecsal;
        
        var fecret = "<?php echo $reserva->fecha_retorno_ns; ?>";
        document.getElementById('fec_retorno_ns1').value = fecret;
        
        var saldop = document.getElementById('saldoPagado').value;
        document.getElementById('saldoPagado2').value = saldop;

        var pagado = <?php echo $pagado; ?>;
        var saldo_porpagar = <?php echo $saldoxPagar; ?>;
        //alert(saldo_porpagar);
        //document.getElementById('saldoporpagar').value = saldo_porpagar;
        // $("#saldoporpagar").val((saldo_porpagar).toFixed(2));

        //document.getElementById('collect').value = '0.00';


        //document.getElementById('otheramount').value = '0.00';
        //document.getElementById('totalPagarnet').value = ('0.00');

        //document.getElementById('balance_due').value = '0.00';
        //document.getElementById('balance_due').value = <?php echo $passenger_balance_due; ?>;
        //document.getElementById('agency_balance_due').value = '0.00';
        //document.getElementById('agency_balance_due').value = <?php echo $agency_balance_due; ?>;
        //document.getElementById('pay_amount').value = '0.00';   
        //document.getElementById('pay_amount').value = <?php echo $pred_paid_amount; ?>;         
        //document.getElementById('paid_driver').value = '0.00';
        //document.getElementById('paid_driver').value = <?php echo $paid_driver; ?>;   
        //document.getElementById('tot_amount_paid').value = '0.00';
        //document.getElementById('tot_amount_paid').value = <?php echo $total_paid; ?>; 


        $("#content").css("opacity", "1");
        var sel_payment = "<?php echo $reserva->op_pago; ?>";
        var sel_payment2 = "<?php echo $op_pago_conductor; ?>";

        $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
        $("#op_pago_conductor option[value=" + sel_payment2 + "]").attr("selected", "selected");
        
        //actualizacion
        document.getElementById('selectcond').value = sel_payment2;
        
        CalcularTotalTotal();
    });


    $("#op_pago_id").change(function () {
        CalcularTotalTotal();
    });
//    $("#pay_amount").change(function () {
//        CalcularTotalTotal();
//    });

//    $("#paid_driver").change(function () {
//        CalcularTotalTotal();
//    });

    $("#extra").change(function () {
        CalcularTotalTotal();
            });
    $("#otheramount").change(function () {
        CalcularTotalTotal();
    });

    $(document).ready(function () {


        $("#content").css("opacity", "0.2");
        if ($("#id_tipo_ticket").val() == "1") {

            $("#round").css("display", "none");
            $(".sup2").css("margin-top", " 2px");
        } else {

            $("#round").css("display", "block");
            $(".sup2").css("margin-top", " -209px");
        }
        $("#clienteN").hide();

        var tipo;

        client = document.getElementById("newClient");
<?php if ($reserva->id_clientes != NULL && $reserva->id != 0 && $cliente != NULL && $cliente->id != NULL && $cliente->id != 0 && $cliente->id != 'NULL') { ?>
            client.style.visibility = "hidden";
<?php } else { ?>
            client.style.visibility = 'visible';
<?php } ?>

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
        }

        var resident = '<?php
if (isset($reserva)) {
    echo $reserva->resident;
}
?>';
        $("#tipo_pass option[value=" + resident + "]").attr("selected", true);
        var idext1 = '<?php
if (isset($reserva)) {
    echo $reserva->extension1;
}
?>';
        $("#ext_from1 option[value=" + idext1 + "]").attr("selected", true);
        var precioa = '<?php
if (isset($reserva)) {
    echo $reserva->precioA;
}
?>';
        var precion = '<?php
if (isset($reserva)) {
    echo $reserva->precioN;
}
?>';
        if (precioa != "") {
            $("#transporadult").text("$" + precioa + ".00");
        }
        if (precion != "") {
            $("#transporechil").text("$" + precion + ".00");
        }
        //habilita usuario de agencia
        //$('#uagency').attr('disabled', 'disabled');        
        $('#leader').focus();
        $.fn.autosugguest({
            className: 'ausu-suggest',
            methodType: 'POST',
            minChars: 1,
            rtnIDs: true,
            dataFile: '<?php echo $data['rootUrl']; ?>leader/ajax'
        });
    });

    function poner(id, id2) {
        var id = id;
        var id2 = id2;
        
        var fecha_inicio = $("#fecha_inicio").val();        
        var fecha_actual = $('#fecha_actual').val();

//        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2), function (response, status, xhr) {
//            var id_leader = $('#id_leader').val();
//            $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/superclub/' + id_leader));
//        });

        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2 + '/' + fecha_inicio + '/' + fecha_actual), function (response, status, xhr) {
        var id_leader = $('#id_leader').val();
        var fecha_inicio = $("#fecha_inicio").val();        
        var fecha_actual = $('#fecha_actual').val();
        
//        $("#userr").load(encodeURI('<?php /*echo $data['rootUrl']; */?>consul/superclub/' + id_leader + '/' + fecha_inicio + '/' + fecha_actual));
        });

    }

    $('#agency').change(function () {

        //$('#uagency').attr('disabled', 'disabled');
       
        $('#uagency').val('');
        $('#id_auser').val('');
        $('#id_agency').val('-1');
        

    });

    $('#pax').change(function () {
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

    });

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

//    $("#fecha_retorno").attr("disable", true);
//    $("#from2").attr("disable",true);
//    $("#from2").attr("readonly", "readonly");
//    $("#fecha_retorno").attr("readonly", "readonly");
//    $("#pickup2").attr("readonly", "readonly");
//    $("#dropoff2").attr("readonly", "readonly");
//    $("#arrival2").attr("readonly", "readonly");
//    $("#to2").attr("readonly", "readonly");
//    $("#ext_from2").attr("disabled", "disabled");
//    $("#departure2").attr("readonly", "readonly");
//    $("#ext_to2").attr("disabled", "disabled");
//    $("#room2").attr("readonly", "readonly");
//    $("#exten3").attr("readonly", "readonly");
//    $("#exten4").attr("readonly", "readonly");
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
        //actualizacion
//        $("#subtochild2_o").val(0);
//        $("#subtoadult2_o").val(0);
//        
        $("#price_exten03").val(0);
        $("#price_exten04").val(0);
        CalcularTotalTotal();
    });

    $('#roundtrip').change(function () {
//    $("#fecha_retorno").attr("disable", false);
//    $("#from2").attr("disable",false);
//    $("#fecha_retorno").removeAttr("readonly");
//    $("#departure2").removeAttr("readonly");
//    $("#dropoff2").removeAttr("readonly");
//    $("#pickup2").removeAttr("readonly");
//    $("#arrival2").removeAttr("readonly");
//    $("#to2").removeAttr("readonly");
//    $("#ext_from2").removeAttr("disabled");
//    $("#ext_to2").removeAttr("disabled");
//    $("#exten3").removeAttr("readonly");
//    $("#exten4").removeAttr("readonly");
//    $("#room2").removeAttr("readonly");
//    $("#from2").removeAttr("readonly");
        $("#round").css("display", "block");
        $(".sup2").css("margin-top", " -209px");
    });
    $('#fecha_salida').datepicker({
        dateFormat: 'mm-dd-yy',
        minDate: 0
    });
    
    $('#fec_salida_ns').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0
    });
    
    $("#dataclick1").click(function (e) {
        e.preventDefault();

        //$("#fecha_salida").datepicker("show");
        return false;
    });
    $('#fecha_retorno').datepicker({
        dateFormat: 'mm-dd-yy',
        minDate: 0,
        beforeShow: function () {
            if ($('#fecha_retorno').attr("readonly") == "readonly") {
                return false;
            }
        }

    });
    
    $('#fec_retorno_ns').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        beforeShow: function () {
            if ($('#fec_retorno_ns').attr("readonly") == "readonly") {
                return false;
            }
        }

    });
    
    
    $("#dataclick2").click(function (e) {
        e.preventDefault();

        //$("#fecha_retorno").datepicker("show");
        return false;
    });
//$("#fecha_salida").change(function(){
//    $("#trip_no").val('');
//    $("#departure1").val('');
//    $("#arrival1").val('');    
//    $("#subtoadult1").val(0);
//    $("#subtochild1").val(0);
//    CalcularTotalTotal();
//});
    function borrar() {
        $("#transporadult").html("");
        $("#transporechil").html("");
        $("#subtoadult").html("");
        $("#subtochild").html("");
        $("#subtoadult2").html("");
        $("#subtochild2").html("");
        $("#totaltotal").html("$ 00.0");
        //$("#ext_from1 option[value="+0+"]").attr("selected",true);
        $("#extenadult").html("");
        $("#extenchil").html("");
        $("#totalPagar").html('$ 00.00');
    }
//$("#fecha_retorno").change(function(){
//    $("#trip_no2").val('');
//    $("#departure2").val('');
//    $("#arrival2").val('');
//    $("#subtochild2").val(0);
//    $("#subtoadult2").val(0);
//    CalcularTotalTotal();
//});
    $("#from").change(function () {
        var id = $("#from").val();
        $("#pickup1").val('');
        $("#id_p1").val('');
//    $("#dropoff2").val('');
//    $("#id_dropoff2").val('');
        $("#dropoff1").val('');
        $("#id_dropoff1").val('');
//    $("#pickup2").val('');
//    $("#id_pickup2").val('');
        $('#exten1').attr('disabled', 'disabled');
        $("#exten1").val('');
        $('#pickup1').removeAttr("disabled");

        $("#price_exten01").val(0);
        $("#price_exten02").val(0);
        var id_agency = $("#id_agency").val();
        if (id_agency != -1) {
            $("#trip_no").val("");
            $("#subtoadult1").val(0);
            $("#subtochild1").val(0);
        }

        CalcularTotalTotal();

        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
            $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));


//        $("#from2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id),function(){
//            $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val()));
//        });
            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
//        $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id+'/'+id_agency));
//        $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + id));
        }
    });

    $("#from2").change(function () {

        var id = $("#from2").val();
        $("#dropoff2").val('');
        $("#id_dropoff2").val('');
        $("#pickup2").val('');
        $("#id_pickup2").val('');

        $('#pickup2').removeAttr("disabled");

        $("#price_exten03").val(0);
        $("#price_exten04").val(0);
        var id_agency = $("#id_agency").val();
        if (id_agency != -1) {
            $("#trip_no2").val("");
            $("#subtoadult2").val(0);
            $("#subtochild2").val(0);
        }
//    $("#trip_no2").val("");
        CalcularTotalTotal();
        $('#exten3').attr('disabled', 'disabled');
        $("#exten3").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
        }
    });
    $("#to").change(function () {

        var id = $("#to").val();
//    $("#dropoff2").val('');
//    $("#id_dropoff2").val('');
        $("#dropoff1").val('');
        $("#id_dropoff1").val('');
//    $("#pickup2").val('');
//    $("#id_pickup2").val('');

        $('#dropoff1').removeAttr("disabled");
        $('#exten2').attr('disabled', 'disabled');
        $("#exten2").val('');
//    $("#price_exten01").val(0);
        $("#price_exten02").val(0);
        var id_agency = $("#id_agency").val();
        if (id_agency != -1) {
            $("#trip_no").val("");
            $("#subtoadult1").val(0);
            $("#subtochild1").val(0);
        }
//    $("#trip_no").val("");
        CalcularTotalTotal();

        if (id != "") {
            var id_agency = $("#id_agency").val();
//        $("#ext_from2").load(encodeURI('<? echo $data['rootUrl']; ?>consul/exten/' + id+'/'+id_agency));
            $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
//        $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
//        $("#from2").attr("value",id);
            var idFrom = $("#from").val();

        }
    });
    $("#to2").change(function () {
        var id = $("#to2").val();

        $('#dropoff2').removeAttr("disabled");
        $("#dropoff2").val('');
        $("#id_dropoff2").val('');
//    $("#price_exten03").val(0);
        $("#price_exten04").val(0);
        var id_agency = $("#id_agency").val();
        if (id_agency != -1) {
            $("#trip_no2").val("");
            $("#subtoadult2").val(0);
            $("#subtochild2").val(0);
        }
        $('#exten4').attr('disabled', 'disabled');
        $("#exten4").val('');
//    $("#trip_no2").val("");
        CalcularTotalTotal();
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
        }
    });
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
        //var url = '<?php echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency;
        var url = '<?php echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal + '/' + tp + '/' + from2 + '/' + to2 + '/' + trip_no2 + '/' + fecharetor;
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

    function valorDescuento() {
        CalcularTotalTotal();
    }

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
    $("#extra").change(function () {
        valorExtra();
    });
    $("#descuento").change(function () {

        valorDescuento();

    });
    $("#descuento_valor").change(function () {

        valorDescuento();

    });

    //actualizacion
//    $("#op_pago_id").change(function () {
//        CalcularTotalTotal();
//    });
//    $("#pay_amount").change(function () {
//        CalcularTotalTotal();
//    });
//
//    $("#paid_driver").change(function () {
//        CalcularTotalTotal();
//    });

    $("#descuento").keypress(Event, function (e) {
        if (e.charCode > 47 && e.charCode < 58) {
            var char = String.fromCharCode(e.charCode);
            var valor = $("#descuento").val();
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

    function establerCursorPosicion(pos, idElemento) {
        var elemento = document.getElementById(idElemento);
        if (typeof document.selection != 'undefined' && document.selection) {        //método IE
            var tex = elemento.value;
            elemento.value = '';
            elemento.focus();
            var str = document.selection.createRange();
            elemento.value = tex;
            str.move("character", pos);
            str.select();
        } else if (typeof elemento.selectionStart != 'undefined') {                    //método estándar
            elemento.setSelectionRange(pos, pos);
        }
    }
    var saber;
    $("#popup1 a").click(function () {
        
        var est;
        var tipo;
        var estd = $('#est').val();         
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var tipo_reserva = $('#tipo_reserva').val();
        var total_pasajeros = $('#total_pasajeros').val();
        var trip_1 = $('#trip_1').val();
        var trip_2 = $('#trip_2').val();
        
        var total;
        
        if(estd == 'PHONE' || estd == 'MAIL' ){            
            est = 'New'; 
//            alert(est);
//            exit;
        }
        if(estd == 'WEBSALE'){
            est = 'Edit'; 
//            alert(est);
//            exit;
        }
        
        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        
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
        tipo = 1;
//        alert(tipo);
//        exit;
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

//    $("#transporadult").html("");
//    $("#transporechil").html("");
//    $("#subtoadult").html("");
//    $("#subtochild").html("");
//    $("#totaltotal").html("$ 00.0");
//    //$("#ext_from1 option[value="+0+"]").attr("selected",true);
//    $("#extenadult").html("");
//    $("#extenchil").html("");
        $('.content-popup').html(" ");
        //$('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);
        $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name + '/' + total + '/' + est + '/' + tipo_reserva + '/' + total_pasajeros + '/' + trip_1 + '/' + trip_2);
        $('#mascaraP').fadeIn('slow');
        $('#popup').fadeIn('slow');
        saber = 1;

    });
    
        $("#popup2 a").click(function () {
        
        var est;
        var tipo;
        var estd = $('#est').val();  
        
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var tipo_reserva = $('#tipo_reserva').val();
        var total_pasajeros = $('#total_pasajeros').val();
        var trip_1 = $('#trip_1').val();
        var trip_2 = $('#trip_2').val();
        var total;
        
        if(estd == 'PHONE' || estd == 'MAIL'){            
            est = "New";
//            alert(est);
//            exit;
        }
        if(estd == 'WEBSALE'){
            est = "Edit";
//            alert(est);
//            exit;
        }
        
        
        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        
        total = (parseInt(pax) + parseInt(pax2));

        $('#totalpax').val(total);      
        
        var from = $('#from2').val();
        var to = $('#to2').val();
        var fecha_retorno = $('#fecha_retorno').val();
        var tipopas = $('#tipo_pass').val();

        if ($('#trip_no').val() == '') {
            alert("Must fill out the form ONE WAY");
            return false;
        }

        tipo = 2;
//        alert(tipo);
//        exit;

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

                alert(mensage);

                return false;

            }

            var special_price_name = $('#special_price_name').val();

            var agency;
            if ($('#id_agency').val() != '-1') {
                agency = $('#id_agency').val()
            } else {
                agency = -1;
            }

            $('.content-popup').html(" ");
            //$('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_retorno + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);
            $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_retorno + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name + '/' + total + '/' + est + '/' + tipo_reserva + '/' + total_pasajeros + '/' + trip_1 + '/' + trip_2);
            $('#mascaraP').fadeIn('slow');
            $('#popup').fadeIn('slow');

            saber = 2;
        }
    });
    
    $("#tipo_pass").click(function () {
        

        //var est = $('#est').val();
        var est;
        var estd = $('#est').val();        
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var tipo_reserva = $('#tipo_reserva').val();
        var total_pasajeros = $('#total_pasajeros').val();
        var trip_1 = $('#trip_1').val();
        var trip_2 = $('#trip_2').val();
        var total;
        
        if(estd == 'PHONE' || estd == 'MAIL' ){            
            est = "New";            
        }
        if(estd == 'WEBSALE'){
            est = "Edit";            
        }
        
        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        
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
//    $("#tipo_pass").change(function () {
//        $("#price_exten01").val(0);
//        $("#price_exten02").val(0);
//
//        $("#subtochild1").val(0);
//        $("#subtoadult1").val(0);
//        $("#trip_no").val("");
//
//        $("#price_exten03").val(0);
//        $("#price_exten04").val(0);
//
//        $("#subtochild2").val(0);
//        $("#subtoadult2").val(0);
//        $("#trip_no2").val("");
//
//        $("#ext_from1 option[value=" + 0 + "]").attr("selected", true);
//        $("#ext_from2 option[value=" + 0 + "]").attr("selected", true);
//        $("#ext_to1 option[value=" + 0 + "]").attr("selected", true);
//        $("#ext_to2 option[value=" + 0 + "]").attr("selected", true);
//        CalcularTotalTotal();
//    });


    $("#newClient").click(function () {

    });

    function registrarCliente() {
        var email = $("#email1").val();
        var firstname = $("#firstname1").val();
        var lastname = $("#lastname1").val();
        var phone = $("#phone1").val();
        var id = $("#idCliente").val();
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
        $.get(ruta, function (data) {
            $(data).appendTo($innerbox);
        });

        if (saber == 1) {
            var mensage = "";
            if ($('#fecha_salida').val() == '') {
                mensage += "fecha salida is requerida. \n";
            }
            if ($('#totalpax').val() == '') {
                mensage += "total pass  is requerido. \n";
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
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").text());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('target', '_parent');
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/save-edit-reserve');
            $("#content").css("opacity", "0");
            bPreguntar = false;
            $("#formula").submit();
        }

    });

    $('#btn-save2').click(function () {
        if (validarFomulario()) {
            bPreguntar = false;
            preguntarAntesDeSalir();
            CalcularTotalTotal();
            
            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/3");
            $("#totP").val($("#totalPagar").text());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('target', '_parent');
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/save-edit-reserve');
            $("#content").css("opacity", "0");            
            $("#formula").submit();
        }
    });


    function irApagar() {
        if (validarFomulario()) {
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").text());
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
    function validarFomulario() {
        var msError = '';
        if (trim($("#idCliente").val()) == '') {
            if (trim($("#firstname1").val()) == '') {
                msError = '- Enter the first name of the passenger';
                alert(msError);
                $("#leader").focus();
                return false;
            }

            if (trim($("#lastname1").val()) == '') {
                msError = '- Enter the last name of the passenger';
                alert(msError);
                $("#leader").focus();
                return false;
            }


        }

//    if(trim($("#id_agency").val())!='-1' && trim($("#id_agency").val()) != ''){
//        if(trim($("#uagency").val()) == '' ){
//            msError = '- Enter employee data Agency';
//            alert(msError);
//            $("#uagency").focus();
//            return false;
//        }
//    }
        //Notas     
        if ($("#comments").val() == "") {
            alert("Please Type One Note");
            $("#comments").focus();
            return false;
        }

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
            msError = '- Select the trip';
            alert(msError);
            $("#trip_no").focus();
            return false;
        }
        if (trim($("#fecha_salida").val()) == '') {
            msError = 'Select departure Date';
            alert(msError);
            $("#fecha_salida").focus();
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
            
            //actualizacion verificar
            if (trim($("#fecha_salida").val()) == '') {
            msError = 'Select departure Date';
            alert(msError);
            $("#fecha_salida").focus();
            return false;
            }
            
            
            if (trim($("#fecha_retorno").val()) == '') {
                msError = 'Select return Date';
                alert(msError);
                $("#fecha_retorno").focus();
                return false;
            }
            
            if (trim($("#trip_no2").val()) == '') {
                msError = '- Select the return trip';
                alert(msError);
                $("#trip_no2").focus();
                return false;
            }
            if (trim($("#id_pickup2").val()) == '' && trim($("#ext_from2").val()) == '0') {
                msError = '- Enter  pickup of ROUND TRIP';
                alert(msError);
                $("#pickup2").focus();
                return false;
            }
            if (trim($("#id_dropoff2").val()) == '' && trim($("#ext_to2").val()) == '0') {
                msError = '- Enter  dropoff of ROUND TRIP';
                alert(msError);
                $("#dpoff2").focus();
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
//        alert(msError);
//        return false;
        }


        return true;
    }
    $('#btn-cancel1').click(function () {
        window.location = '<?php echo $data['url_back']; ?>';
    });
    function trim(myString) {
        return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
    }

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

//        //actualizacion

        var y = $("#price2").val();


        if (x == 1) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();
        }

        if (x == 2) {
            var transporChil1 = $("#subtochild22").val();
            var transporAdul1 = $("#subtoadult22").val();
        }
        
        if (x == 3) {
            var transporChil1 = $("#subtochildwf1").val();
            var transporAdul1 = $("#subtoadultwf1").val();
        }
        
        if (x == 4) {
            var transporChil1 = $("#subtochildsp1").val();
            var transporAdul1 = $("#subtoadultsp1").val();
        }
        
        if (x == 5) {
            var transporChil1 = $("#subtochildsd1").val();
            var transporAdul1 = $("#subtoadultsd1").val();
        }
        
        if (x == 6) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();
        }
       

//       
//        
        if (y == 1) {
            var transporChil2 = $("#subtochild2").val();
            var transporAdul2 = $("#subtoadult2").val();
        }

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
        //parseFloat(transporAdul2)
        //parseFloat(transporChil2)

        //if round trip checked

//        if ($("#id_tipo_ticket").val() === "2") {
//
//            var transadult = ((parseFloat(transporAdul1) + parseFloat(transporAdul2)) * pax_1);
//
//            var transchild = ((parseFloat(transporChil1) + parseFloat(transporChil2)) * pax_2);
//
//        }
//
//        //if oneway checked
//        if ($("#id_tipo_ticket").val() === "1") {
//
//            var transadult = (parseFloat(transporAdul1) + 0) * pax_1;
//            var transchild = (parseFloat(transporChil1) + 0) * pax_2;
//
//        }

        var transadult = (parseFloat(transporAdul1) + parseFloat(transporAdul2)) * pax_1;
        var transchild = (parseFloat(transporChil1) + parseFloat(transporChil2)) * pax_2;

        var totalA = parseFloat(transadult) + (parseFloat(price_exten) * pax_1);
        var totalC = parseFloat(transchild) + (parseFloat(price_exten) * pax_2);

//        alert(pax_1);
        var totalP = totalA + totalC;
        //alert(totalP);
//        exit();
        //$("#totalPagar").text(totalP.toFixed(2));
        $("#totalPagar").val((totalP).toFixed(2));
        $("#extenadult").text('$' + (price_exten * pax_1).toFixed(2));
        $("#extenchil").text('$' + (price_exten * pax_2).toFixed(2));
        $("#transporadult").text('$' + transadult.toFixed(2));
        $("#transporechil").text('$' + transchild.toFixed(2));
        $("#subtoadult").text('$' + (totalA / parseFloat($("#pax").val())).toFixed(2));
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
            $("#totalPagar").text(Math.ceil(totalP).toFixed(2));
            //alert(subtotalAdulto+', '+subtotalninio+', '+totalP+','+transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+porc_comi1+', '+porc_comi2+', '+transpor1+', '+transpor2+', '+transporEx+', '+comiT1+', '+comiT2+', '+porc_comi2+', '+comiEx+', '+comi);

        } else {

            var comi = 0;
        }
        return comi;
    }
    //variable utilizada en funcion dupliac() (duplica el valor de saldoporpagar en otheramount)
    var apagare
    
    function CalcularTotalTotal() {

        var opcion = $("#op_pago_id1").val();
        var org = typeof (org) != 'undefined' ? org : 0;
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        if (pax2 == "") {
            pax2 = 0;
        }
        if (pax == "") {
            pax = 0;
        }

        var comi = 0/*comision()*/;

        var full = CalcularTotal(pax, pax2) + comi;
        
        
        var balance = full - comi;
        var disponible = $("#disponible").val();
        var agency = $("#id_agency").val();
        var pagado = <?php echo $pagado; ?>;
        var otheramount = 0;
        //alert(full);

        var tipo_pago = 0;
        var prepago = 0;

        var num = document.getElementsByName('opcion_pago').length;
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('opcion_pago').item(i).checked) {
                tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
            }
        }

        tipo_pago = $("#op_pago_id option:selected").val();//Collect on Board
        /***************************************************/
        prepago = $("#opcion_pago_2 option:selected").val();//pred paid

        var tipo_saldo = $('#opcion_pago_saldo').val();
        //Validar otheramount
        var error = "";
        error += validateNumber($("#otheramount").val(), 'Other Amount', true);
        if (error == "") {
            otheramount = $("#otheramount").val();
        } else {
            otheramount = 0;
        }
        var apagar = full;
        
        
        if (tipo_saldo == 2) {
            apagar = balance;
            

        }

        //SUMAMOS VALOR EXTRA
        error = "";
        error += validateNumber($("#extra").val(), 'Extra', true);
        var extra = 0;
        if (error == "") {
            extra = $("#extra").val();
        }
        //RESTAMOS DESCUENTO DE %
        error = "";
        error += validateNumber($("#descuento").val(), 'Descuento', true);
        var desc_porc = 0;
        if (error == "") {
            desc_porc = $("#descuento").val();
        }
        //RESTAMOS DESCUENTO DE $
        error = "";
        error += validateNumber($("#descuento_valor").val(), 'Descuento Valor', true);
        var desc_valor = 0;
        if (error == "") {
            desc_valor = $("#descuento_valor").val();
        }
        /////////////////////////////////////////
        var pagado = <?php echo $pagado; ?>;

        var opcion = $("#op_pago_id1").val();

        //opcion add payment   codigo de envio al controlador para aumento de cargos

        document.getElementById('opc_ap').value = opcion;

        var pay_amount = $("#pay_amount").val();

        var paid_driver = $("#paid_driver").val();

        var pago_driver = $("#pago_driver").val();

        var total_pagar = $("#totalPagar").val();

        var saldoXpagar = $("#saldoporpagar").val();

        var otheramount2 = $("#otheramount").val();

//        alert(desc_valor);
        apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat((full * desc_porc) / 100) - parseFloat(desc_valor);

       
        apagar = apagar;
        
        
        apagare = apagar;

        var valor = apagar;

        valor = parseFloat(valor) + parseFloat(extra) - parseFloat((full * desc_porc) / 100) - parseFloat(desc_valor);

        var fee = apagar * 0.04;
        <?php
        if ($reserva->id < 17670) {
            echo "var fee = apagar*0.03;";
        } else {
            echo "var fee = apagar*0.04;";
        }
        ?>

        //alert(tipo_pago);

        var totalPax = parseFloat(pax) + parseFloat(pax2);
        $("#totalComision").text(comi.toFixed(2));
        
        ///////////////////////////////COLLECT ON BOARD/////////////////////////////////

        //CREDIT VOUCHER
        if (tipo_pago == 5) {
            if (disponible - full < 0) {
                //alert('tipo 5');
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


                var totalbalance = 0.00;
//                $("#totalPagar").text((apagar).toFixed(2));
//                $("#totaltotal").text((apagar).toFixed(2));
                var cv = 0;

                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#paid_driverp").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#balance_duep").val((cv).toFixed(2));                   
                $("#totalPagar").val((apagar).toFixed(2));
                $("#totaltotal").text(((apagar) - (pay_amount)).toFixed(2));
                $("#agency_balance_due").val(((apagar) - (pay_amount)).toFixed(2));
                
            if (pay_amount > 0 && paid_driver == 0 && otheramount2 == 0) {
                    
                   
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
                        $("#totalPagar").text((result).toFixed(2));
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
                
                var prep = parseFloat($("#pred_paid_amountt").val());
                var coll = parseFloat($("#paid_drivert").val());

                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');

                $("#totalPagar").val((apagar).toFixed(2));
                $("#totaltotal").text(((apagar) - (pay_amount)).toFixed(2));
                $("#agency_balance_due").val(((apagar) - (pay_amount)).toFixed(2));

                $("#saldoporpagar").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#paid_driverp").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#balance_duep").val((cv).toFixed(2));                

                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                $("#tot_amount_paidp").val((prep + coll).toFixed(2));
                
                }

            }else if (tipo_pago == 7) {

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
            
        }else {//////////////////////////////////////////////////////////

            $("#opcion_saldo2").attr('disabled', false);

            $("#opcion_saldo1").attr('disabled', false);

            //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< CREDIT CARD WITH FEE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        //}
            if (tipo_pago == 3) {

                

                var other_amount = parseFloat($("#otheramount").val());
                var temp = parseFloat($("#temp").val());
                var tempwf = parseFloat($("#tempwf").val());
                var tempppwf = parseFloat($("#tempppwf").val());
                var paid_driver = parseFloat($("#paid_driver").val());                
                var pay_amount = parseFloat($("#pay_amount").val());

                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {

                    var result = parseFloat(apagar) + parseFloat(temp);
                    var totalbalance = ((apagar + temp) - (paid_driver)) - (pay_amount);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalPagar").text((result).toFixed(2));
                        $("#totaltotal").text((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {
                        
                        var temp = parseFloat($("#temp").val());
                        var tempwf = parseFloat($("#tempwf").val());
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var pay_amount = parseFloat($("#pay_amount").val()); 
                        var op_pag_conduct = parseFloat($("#selectcond").val());
                        var saldoporpagar = parseFloat(apagar) +  parseFloat(temp)+ parseFloat(tempwf);
                        var result = parseFloat(apagar) + parseFloat(temp);
                        var bd = parseFloat(result) - parseFloat(paid_driver);  
                        
                                        
                      
                        $("#saldoporpagar").val((saldoporpagar).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalPagar").text((result).toFixed(2));
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

                }

                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {
               
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var tempwf = parseFloat($("#tempwf").val());             
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var saldoporpagar = parseFloat(apagar) +  parseFloat(temp_driver) + parseFloat(tempwf);
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf);
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


                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());  

                    var totalbalance = ((apagar + temp_prepaid + tempppwf ) - (paid_driver)) - (pay_amount);                    
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(tempppwf);
                    var saldoporpagar = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(tempppwf);

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
                        var tempppwf = parseFloat($("#tempppwf").val());  
                        var op_pag_conduct = parseFloat($("#selectcond").val());                        
                        var result = parseFloat(apagar) + parseFloat(temp_prepaid)+ parseFloat(tempppwf);
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

                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var pay_amount = parseFloat($("#pay_amount").val());                        
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());                   
                    
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
                  
                    var tot_amount = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                   
                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalPagar").val((result).toFixed(2));
                    $("#totaltotal").text((result).toFixed(2));
                    $("#tot_amount_paid").val((tot_amount).toFixed(2));        
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

                var other_amount = parseFloat($("#otheramount").val());

                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {

                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var apagar_2 = parseFloat(other_amount);
                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf);
                    var balance = parseFloat(result) - parseFloat(paid_driver);                    
                    //var result = parseFloat(apagar) + parseFloat(temp);
                    var resultado = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver);
                    
//                    var bd = parseFloat(result) - parseFloat(paid_driver);   
//                    
                    
                    if(op_pag_conduct == "3")  { 
                    
                        $("#saldoporpagar").val((result).toFixed(2));                 
                        $("#balance_due").val((balance).toFixed(2));
                        $("#totalPagar").text((resultado).toFixed(2));
                        $("#totaltotal").tex((resultado).toFixed(2));
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
                        $("#totalPagar").text((resultado).toFixed(2));
                        $("#totaltotal").tex((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }
                    
                                      
                }

                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                                       
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) +  parseFloat(temp_driver) + parseFloat(tempwf);
                    var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var result1 = parseFloat(apagar1) + parseFloat(temp_prepaid) + parseFloat(tempppwf);
                    var resultado = parseFloat(result1) + parseFloat(temp_driver) + parseFloat(tempwf);
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


                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {
                    
                    var other_amount = parseFloat($("#otheramount").val());
                    var temp = parseFloat($("#temp").val());                    
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver) + parseFloat(tempwf);
//                    var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
//                    var result1 = parseFloat(apagar1) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
                    var resultado = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) ;                    
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


                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val()); 
                    var op_pag_conduct = parseFloat($("#selectcond").val());                           
                    var apagar_2 = parseFloat(other_amount);
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);          
                    var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    //var result1 = parseFloat(apagar1) + parseFloat(temp);
                    var result1 = parseFloat(apagar1) + parseFloat(tempppwf) + parseFloat(temp_prepaid);
                    var resultado = parseFloat(result1) + parseFloat(tempwf) + parseFloat(temp_driver);
                                       
                    var bd = parseFloat(result) - parseFloat(paid_driver);
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                                       
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
                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
                            $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                        }

                        if (totalbalance >= 0){
                            
                            if(op_pag_conduct == "3")  { 
                                
                                
                                $("#saldoporpagar").val((result).toFixed(2));                 
                                $("#balance_due").val((bd).toFixed(2));                                
                                $("#totalPagar").val((resultado).toFixed(2));
                                $("#totaltotal").text((resultado).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
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
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                                $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }
                        }
                    
       
                }


               document.getElementById('op_pago_id1').value = 0;

            }


            if (tipo_pago == 4) {//CASH

                
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());               
                var other_amount = parseFloat($("#otheramount").val());


                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
                    
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

                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
//                    var result = parseFloat(apagar) + parseFloat(temp);
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
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

                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;                 
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

                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());                   
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
                    
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


                var other_amount = parseFloat($("#otheramount").val());

                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());               
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);
                    
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


                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());              
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver) ;                     
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);                   
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

                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());            
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver); 
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);                    
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




                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());               
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);  
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
                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                          $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {
                            
                            if(op_pag_conduct == "3")  {
                                
                                
                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2)); 
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
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                              $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                        }
                    

                }
                
                document.getElementById('op_pago_id1').value = 0;


            }


            if (tipo_pago == 9) {//CHECK

                               
                var tap = parseFloat($("#tot_amount_paid").val());

                var prep = parseFloat($("#pred_paid_amountt").val());

                var coll = parseFloat($("#paid_drivert").val());

                if (coll > 0) {

                    $("#paid_driver").val((coll).toFixed(2));
                    $("#paid_driverp").val((coll).toFixed(2));

                }

                var paid_driver = parseFloat($("#paid_driver").val());

                var pay_amount = parseFloat($("#pay_amount").val());

                var other_amount = parseFloat($("#otheramount").val());


                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());     
                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
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

                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) ;
                    
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

                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());  
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(tempppwf) + parseFloat(temp_prepaid) + parseFloat(tempwf) + parseFloat(temp_driver) ;               
                    var balance = apagar + tempppwf + temp_prepaid + tempwf + temp_driver;        
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

                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var tempppwf = parseFloat($("#tempppwf").val());                   
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;
                   
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




                var other_amount = parseFloat($("#otheramount").val());


                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(tempwf);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);
                    
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

                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);                     
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);                   
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


                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());      
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver); 
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);                    
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

                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);  
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
                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));


                        }
                        if(bd >= 0) {
                            
                            if(op_pag_conduct == "3")  {
                                
                                
                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2)); 
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
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));

                                
                                }

                         }               


                }

                document.getElementById('op_pago_id1').value = 0;
                
                 
            }

            if (tipo_pago == 8) {//CREDIT CARD NO FEE

                
                var other_amount = $("#otheramount").val();
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());
                var total_pagar = parseFloat($("#totalPagar").val());

                
                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {

                    
                    var temp = parseFloat($("#temp").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp);
                    
                    //alert(result);
                    
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
                                      $("#totalPagar").val((result).toFixed(2));

                        }, 0.01);
                        
                    }




                }

                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var tempppwf = parseFloat($("#tempppwf").val());              
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf)  + parseFloat(temp_prepaid) + parseFloat(tempppwf);
                    
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

                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());                        
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;                    
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

                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                   
                    var tempppwf = parseFloat($("#tempppwf").val());                   
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(tempwf) + parseFloat(temp_prepaid) + parseFloat(tempppwf) ;                    
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

                var other_amount = parseFloat($("#otheramount").val());
                
                
                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);
                    
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


                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);                     
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);                   
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

                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());   
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver); 
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);                    
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


                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {

                
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var tempwf = parseFloat($("#tempwf").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var tempppwf = parseFloat($("#tempppwf").val());                              
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(tempwf) + parseFloat(temp_driver);
                    var res_total = parseFloat(apagar) + parseFloat(tempwf) + parseFloat(temp_driver) + parseFloat(tempppwf) + parseFloat(temp_prepaid);  
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
                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {
                            
                            if(op_pag_conduct == "3")  {
                                
                                
                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").val((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2)); 
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
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                    }               


                }

                document.getElementById('op_pago_id1').value = 0;



            }


        }
        
       

        if ($("#fin_calculo").val() == "false") {
            /**/
            var diferencia;

            if (otheramount != 0) {
                diferencia = otheramount - pagado;
            } else {
                diferencia = apagar - pagado;
            }
            if (diferencia > 0) {
                $('#saldoporpagar').html((diferencia).toFixed(2));
//                $('#txtamountpendiente').html('Amount to Collect $');                
//                $('#txtamountpendiente').css('color', '#F00');
                $('#Passenger_Balance_Due').html('Passenger Balance Due $');
                $('#Passenger_Balance_Due').css('color', '#F00');

            } else if (diferencia == 0) {
                $('#saldoporpagar').html((diferencia).toFixed(2));
//                $('#txtamountpendiente').html('Amount to Collect $');
//                $('#txtamountpendiente').css('color', '#666666');
                $('#Passenger_Balance_Due').html('Passenger Balance Due $');
                $('#Passenger_Balance_Due').css('color', '#666666');

            } else {
                $('#saldoporpagar').html((diferencia * -1).toFixed(2));
//                $('#txtamountpendiente').html('Amount to Collect $');
//                $('#txtamountpendiente').css('color', '#00F');
                $('#Passenger_Balance_Due').html('Passenger Balance Due $');
                $('#Passenger_Balance_Due').css('color', '#00F');
            }

            if (tipo_pago == 1 || tipo_pago == 2) {
                if (diferencia <= 0) {
                    $('#enviarF').css('display', 'none');
                    $('#btn-save1').css('display', 'block');
                    $('#btn-save2').css('display', 'block');
                } else {
                    $('#enviarF').css('display', 'block');
//                $('#btn-save1').css('display','none');
//                $('#btn-save2').css('display','none');
                }
            } else {
                $('#enviarF').css('display', 'none');
                $('#btn-save1').css('display', 'block');
                $('#btn-save2').css('display', 'block');
            }
        }

    }


    $('#opcion_saldo1, #opcion_saldo2').change(function () {
        if ($(this).get(0).id == 'opcion_saldo1') {
            $('#opcion_pago_saldo').val('1');
        } else if ($(this).get(0).id == 'opcion_saldo2') {
            $('#opcion_pago_saldo').val('2');
        }
        CalcularTotalTotal();
    });

    $('#opcion_pago_passager, #opcion_pago_agency, #opcion_pago_predpaid_cash,#opcion_pago_complementary,#opcion_pago_CrediFee, #opcion_pago_Cash,#opcion_pago_Voucher').change(function (e) {
        CalcularTotalTotal();
    });
    function estadoTrip() {
        $("#mensajeTrip").load('<?php echo $data['rootUrl']; ?>admin/reservas/consultatrip');
    }
    function estadoPago() {
        $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/reserva/pago');
    }
    function detalles_rastro(id) {
        $("#conten_rastro").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/rastro_detalles/' + id));

        $("#dialog_message_rastro").dialog({
            modal: false,
            width: 600,
            buttons: {
                Ok: function () {
                    $(this).dialog("close");
                }
            }
        });
    }
    $("#bnt-trips").click(function () {
        var posicion = $(this).position();
        mosrtarTrips(posicion.left, posicion.top);
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
            position: [left - 260, top + 50],
        });
        $("#states__trips_conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="100px" height="100px" id="gif"/>');
        $("#states__trips_conte").load('<?php echo $data['rootUrl']; ?>admin/reservas/estado_trips');
        $("#dialog_states__trips").dialog("open");
    }
    $("#bnt-trips").click(function () {
        var posicion = $(this).position();
        mosrtarTrips(posicion.left, posicion.top);
    });
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
                }
            }
        });
    }
    $("#transporadult").html("$ <?php echo $transporadult; ?>");
    $("#transporechil").html("$ <?php echo $transporechil; ?>");
    $("#subtoadult").html("$ <?php echo $subtoadult; ?>");
    $("#subtochild").html("$ <?php echo $subtochild; ?>");
    $("#totaltotal").html("$ <?php echo $totaltotal; ?>");
    $("#extenadult").html("$ <?php echo $reserva->pax * $precioExt; ?>");
    $("#extenchil").html("$ <?php echo $reserva->pax2 * $precioExt; ?>");
    $("#disponible").val('<?php echo $disponible; ?>');

    $("#extra").val('<?php echo $reserva->extra_charge; ?>');
    CalcularTotalTotal();

<?php echo $adaptacion; ?>

<?php if ($reserva->tipo_ticket == 'oneway') { ?>

        //$("#fecha_retorno").attr("disable", true);
        //$("#from2").attr("disabled",true);
        //$("#from2").attr("readonly", "readonly");
        //$("#fecha_retorno").attr("readonly", "readonly");
        //$("#pickup2").attr("readonly", "readonly");
        //$("#dropoff2").attr("readonly", "readonly");
        //$("#arrival2").attr("readonly", "readonly");
        //$("#to2").attr("readonly", "readonly");
        //$("#ext_from2").attr("disabled","disabled");
        //$("#ext_to2").attr("disabled", "disabled");
        $("#departure2").attr("readonly", "readonly");
        //$("#room2").attr("readonly", "readonly");
        //$("#exten3").attr("readonly", "readonly");
        //$("#exten4").attr("readonly", "readonly");
        $("#trip_no2").html("");
        $("#departure2").html("");
        $("#arrival2").html("");
<?php } ?>
    $(function () {
//    setInterval(function(){
//        CalcularTotalTotal();
//        console.log('calculando');
//    },500);
        $("#uagency, #agency").change(function () {
            if (trim($("#uagency").val()).length == 0) {
                console.log('limpiado');
                $("#id_auser").val("-1");
            }
        });
    });


    var ttt = <?php echo $totaltotal; ?>;
    $("#totaltotal").html("$ " + (ttt).toFixed(2));
//    $("#totalPagar").html("$ " + (ttt).toFixed(2));    
    // $("#totalPagar").val((ttt).toFixed(2));
    var porp = <?php echo $saldoxPagar; ?>;
    $('#saldoporpagar').html((porp).toFixed(2));

</script>
<script>

    var z;
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

        //document.getElementById("resultado").innerHTML=" \
        //Value: "+resultado;
        z = document.getElementById("resultado").innerHTML = " \ " + resultado;


    }
</script>

<!--<script type="text/javascript">
    var int=self.setInterval("refresh()",100);
    function refresh()
    {
        location.reload(true);
    }
</script>-->


<script languague="javascript">

    function ocultarmenu() {
        div = document.getElementById('menu-bar');
        div.style.display = 'none';
        div2 = document.getElementById('hd-menu');
        div2.style.display = 'none';
    }

</script>

<script languague="javascript">

    function cambiarfondo() {

//    alert('cambio fondo');
//    exit();
        $('#header_page').style = "background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg3.jpg');";

    }

</script>

<script type="text/javascript">

    function comprobarScreen()
    {
        
        window.moveTo(0, 0);
	window.resizeTo(screen.width, screen.height);
        window.fullScreen;
        
        if (window.screen.availWidth <= 640) {
            window.parent.document.body.style.zoom = "62%";
        }

        if (window.screen.availWidth == 800) {
            window.parent.document.body.style.zoom = "70%";
            document.getElementById("save2").style.marginTop = "-59px";
        }
        
        if (window.screen.availWidth == 960) {
            window.parent.document.body.style.zoom = "-50%";
        } 
        
        if (window.screen.availWidth == 1024) {
            window.parent.document.body.style.zoom = "80%";
            document.getElementById("save2").style.marginTop = "-1183px";
        }
        
        if (window.screen.availWidth == 1152) {
            window.parent.document.body.style.zoom = "90%";
            document.getElementById("save2").style.marginTop = "-173px";
            document.getElementById("btn-save2").style.marginLeft = "-113px";
        }
        
        if (window.screen.availWidth == 1280) {
            window.parent.document.body.style.zoom = "100%";
            document.getElementById("save2").style.marginTop = "-1240px";

        }
        
        if (window.screen.availWidth == 1360) {
            window.parent.document.body.style.zoom = "100%";
            document.getElementById("save2").style.marginTop = "-1240px";
        } 
        
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";   
            document.getElementById("save2").style.marginTop = "-1434px";

        }

        if (window.screen.availWidth == 1440) {
            window.parent.document.body.style.zoom = "110%";
            document.getElementById("save2").style.marginTop = "-1242px";
        }

        if (window.screen.availWidth == 1600) {
            window.parent.document.body.style.zoom = "125%";
            document.getElementById("save2").style.marginTop = "-1242px";
        }

        if (window.screen.availWidth == 1680) {
            window.parent.document.body.style.zoom = "125%";
            document.getElementById("save2").style.marginTop = "-1210px";
        }
        
        if (window.screen.availWidth > 1680) {
            window.parent.document.body.style.zoom = "125%";
            document.getElementById("save2").style.marginTop = "-1050px";
        }
    }

</script>

<script type="text/javascript">

    function resetextra()
    {

        var extra_cargo = document.getElementById('extra').value;


        if (extra_cargo == "") {

            document.getElementById('extra').value = '0.00';
            document.getElementById('extrap').value = document.getElementById('extra').value;
                            
            //$('#paid_driver').click();    
            CalcularTotalTotal();
            $("#extra").focus();          

        }
        
        if (extra_cargo == "0") {

            document.getElementById('extra').value = "0.00";
            document.getElementById('extrap').value = document.getElementById('extra').value;

            //$('#paid_driver').click();   
            CalcularTotalTotal();
            $("#extra").focus();                           


        }

        if (extra_cargo > "0") {

            setTimeout(function () {

                document.getElementById('extrap').value = document.getElementById('extra').value;

                //$('#paid_driver').click();
                CalcularTotalTotal();
                $("#extra").focus();

             }, 0.01);                           

        }
        
        



    }

</script>


<script type="text/javascript">

    function desval()
    {


        var dcval = document.getElementById('descuento_valor').value;

        if (dcval == "") {

            document.getElementById('descuento_valor').value = "0.00";
            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;
            
            CalcularTotalTotal();
            $("#descuento_valor").focus();
        }



        if (dcval == "0") {

            document.getElementById('descuento_valor').value = "0.00";
            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;
            
            CalcularTotalTotal();
            $("#descuento_valor").focus();

        }
        
        if (dcval > "0") {                           

          setTimeout(function () {                                

            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;

            CalcularTotalTotal();

          }, 0.01);                          

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
            document.getElementById('descuentop').value = document.getElementById('descuento').value;
                                                      
            //$('#paid_driver').click();
            CalcularTotalTotal();
            $("#descuento").focus();
        }



        if (dcporc == "0") {

            document.getElementById('descuento').value = "0";

            document.getElementById('descuentop').value = document.getElementById('descuento').value;
                                                
            //$('#paid_driver').click();
            CalcularTotalTotal();
            $("#descuento").focus();
        }
        
        if (dcporc > "0") {
                            
            setTimeout(function () {

            document.getElementById('descuentop').value = document.getElementById('descuento').value;

            //$('#paid_driver').click(); 
            CalcularTotalTotal();
            $("#descuento").focus();

            }, 0.01);

        }


    }
</script>

<script type="text/javascript">

    function estado_roundtrip()
    {

        var est_rnd = document.getElementById('estado_round').value;
        document.getElementById('estado_roundtrip').value = est_rnd;   
        
         //CONFIRMED
        if(est_rnd == 1){ 
            
           document.getElementById('estado_roundtrip').style.background = "#98FB98"; 
           document.getElementById('estado_roundtrip').style.color = "#000";
           document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";
        
        //CANCELED
        }else if(est_rnd == 4){ 
            
           document.getElementById('estado_roundtrip').style.background = "#DC143C";  
           document.getElementById('estado_roundtrip').style.color = "#FFFFFF";
           document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";
           
        //CANCELED W/FEE   
       }else if(est_rnd == 5){ 
            
           document.getElementById('estado_roundtrip').style.background = "#E93F2E";  
           document.getElementById('estado_roundtrip').style.color = "#FFFFFF";
           document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

        
        //NO SHOW
        }else if(est_rnd == 2){ 
            
           document.getElementById('estado_roundtrip').style.background = "#00BFFF";  
           document.getElementById('estado_roundtrip').style.color = "#000";
           document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";
        
        //NO SHOW W/FEE
        }else if(est_rnd == 3){ 
            
           document.getElementById('estado_roundtrip').style.background = "#ADD8E6";  
           document.getElementById('estado_roundtrip').style.color = "#000";
           document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";

        //OPEN W/FEE
        }else if(est_rnd == 6){ 
            
           document.getElementById('estado_roundtrip').style.background = "#F0E68C";  
           document.getElementById('estado_roundtrip').style.color = "#000";
           document.getElementById('estado_roundtrip').style.border = "2px solid #FFFFFF";
                        
        }




    }
</script>

<script type="text/javascript">

    function estado_oneway()
    {

        var est_one = document.getElementById('estado_one').value;
        document.getElementById('estado_oneway').value = est_one;  
        
        //CONFIRMED
        if(est_one == 1){ 
            
           document.getElementById('estado_oneway').style.background = "#98FB98"; 
           document.getElementById('estado_oneway').style.color = "#000";
           document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";
        
        //CANCELED
        }else if(est_one == 4){ 
            
           document.getElementById('estado_oneway').style.background = "#DC143C";  
           document.getElementById('estado_oneway').style.color = "#FFFFFF";
           document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";
           
        //CANCELED W/FEE   
       }else if(est_one == 5){ 
            
           document.getElementById('estado_oneway').style.background = "#E93F2E";  
           document.getElementById('estado_oneway').style.color = "#FFFFFF";
           document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";

        
        //NO SHOW
        }else if(est_one == 2){ 
            
           document.getElementById('estado_oneway').style.background = "#00BFFF";  
           document.getElementById('estado_oneway').style.color = "#000";
           document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";
        
        //NO SHOW W/FEE
        }else if(est_one == 3){ 
            
           document.getElementById('estado_oneway').style.background = "#ADD8E6";  
           document.getElementById('estado_oneway').style.color = "#000";
           document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";

        //OPEN W/FEE
        }else if(est_one == 6){ 
            
           document.getElementById('estado_oneway').style.background = "#F0E68C";  
           document.getElementById('estado_oneway').style.color = "#000";
           document.getElementById('estado_oneway').style.border = "2px solid #FFFFFF";
                        
        }


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
    // End -->
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
//    var balance_due = document.getElementById('balance_due').value;
//    
//    if(balance_due == "0"){
//        
//        alert("Este pago no puede ser Procesado");
//        Exit();
//    
//    }
        if($(obj).attr('class')=="flashit"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        }
        
    
    }
    
    </script>
    
    <script type="text/javascript">
    
    //valida la clase activa en el pago prepagado
    function valida_pago2(obj,def){
        
    //alert($(obj).attr('class'));    
       
//    var agency_balance_due = document.getElementById('agency_balance_due').value;
//    
//    if(agency_balance_due == "0"){
//        
//        alert("Este pago no puede ser Procesado");
//        Exit();
//    
//    }
    
        if($(obj).attr('class')=="flashit2"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        }    
    
    
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
        
         }, 1500);
       
       } 
    </script> 
<script type="text/javascript">
    
    function valida_voucher(){
        

                 
    var idagencia = document.getElementById('idagencia').value;
       
        if(idagencia == "1"){
           
           
           document.getElementById('op_pago_conductor')[4].disabled = false; 
           //document.getElementById('op_pago_conductor').options[5].disabled = true; 
           
       }else{
           
         
           document.getElementById('op_pago_conductor')[4].disabled = true; 
           
           
       }       
             
   

    }
    
</script>    

<script type="text/javascript">
    
    function facturado() {
        
        var estado = "<?php echo $reserva->estado; ?>";
        
        if (estado == 'INVOICED'){
            
            document.getElementById('invoice').style.display = "";
            document.getElementById('lbl_invoice').style.display = "";
            document.getElementById('lbl_creation').style.display = "";
            document.getElementById('facturas').style.background = "#F5F5F5";
            
            
        }else{
            
            document.getElementById('invoice').style.display = "none";
            document.getElementById('lbl_invoice').style.display = "none";
            document.getElementById('lbl_creation').style.display = "none";
            document.getElementById('facturas').style.background = "#FFFFFF";
        }

    
    }
    
</script>

<script>
    $(function () {
        function mosrtarRastro(left, top) {

            $("#dialog").dialog({
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
                position: [left - 676, top + 80],
            });
            $("#dialog").dialog("open");
        }
        $("#btn-rastro").click(function () {
            var posicion = $(this).position();
            mosrtarRastro(posicion.left, posicion.top);
        });

    });
</script>

<script>
    $(function () {
        function mostrarPagos(left, top) {

            $("#dialog2").dialog({
                autoOpen: false,
                width: 580,
                height: 150,
                show: {
                    effect: "blind",
                    duration: 1000
                },
                hide: {
                    effect: "blind",
                    duration: 1000
                },
                position: [left - 676, top + 80],
            });
            $("#dialog2").dialog("open");     
            
            
        }
        $("#btn-pagos").click(function () {
            var posicion = $(this).position();
            mostrarPagos(posicion.left, posicion.top);
        });

    });               
                    
                
</script>

<script type="text/javascript">
    
    function sur_2015()
    {     
        var fecha_creacion = "<?php echo $fecha_crea; ?>";
        
         if(fecha_creacion < '2018-05-31'){       
            document.getElementById('sur2015').style.display = "";         
         }else{           
            document.getElementById('sur2015').style.display = "none";
         }       
        
        
    }

</script>

<script type="text/javascript">
    
    function residente() {
        
        document.getElementById('resident').value = document.getElementById('tipo_pass').value;
    
    }

</script>