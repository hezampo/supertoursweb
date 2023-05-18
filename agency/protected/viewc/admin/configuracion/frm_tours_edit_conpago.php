<?php
$tours = $this->data['tours'];

$pagado = $this->data['pagado'];

$dato = 'Edit';

$totaltotal = $tours->total;
$adult = $tours->adult;
$child = $tours->child;
$total_pasajeros = $adult + $child;
$id_reserva = $tours->id_reserva;
$saldpagar1 = $tours->total;
$saldpagar = number_format($saldpagar1, 2, '.', '');
$totalAmount = $tours->totalouta;
$total_paid = $tours->total_paid;
$pre_paid_amount = $tours->pred_paid_amount;
$fecha_crea = $tours->creation_date;
$paid_driver = $tours->paid_driver;
$total_charge = $tours->total_charge;
$balance_due = $tours->passenger_balance_due;
$tipo_reserva = "multiday";
//echo '<<<' . $balance_due;
$agency_balance_due = $tours->agency_balance_due;
$otheramount = $tours->otheramount;
$op_pago = $tours->op_pago;

$op_pago_conductor = $tours->op_pago_conductor;

//print($op_pago_conductor);

$rastro = $this->data['rastro'];
//print_r($rastro);
$comsion_servis = $this->data['comsion_servis'];
$cliente = $this->data['cliente'];
$agencia = $this->data['agencia'];
$agency_account = $this->data['agency_account'];
$disponible = $this->data['disponible'];
$userA = $this->data['userA'];
$transfer_in = $this->data['transfer_in'];
$transfer_out = $this->data['transfer_out'];
$reserve = $this->data['reserve'];
$extenciones01 = $this->data['extenciones01'];
$extenciones04 = $this->data['extenciones04'];
$pickup1 = $this->data['pickup1'];
$dropoff1 = $this->data['dropoff1'];
$pickup2 = $this->data['pickup2'];
$dropoff2 = $this->data['dropoff2'];
$last_index = $data['last_indexh'];
$hoteles = ($this->data['tours']->id_hotel_reserve != -1) ? $data['hoteles'] : array();
$hotel_reserves = ($this->data['tours']->id_hotel_reserve != -1) ? $this->data['hotel_reserves'] : array();

$comision = $this->data['comision'];
//	$costoHotel = $this->data['costoHotel'];
$tipoHabitacion = ($this->data['tours']->id_hotel_reserve != -1) ? $this->data['tipo_habs'] : array();
/*    print_r($tipoHabitacion);
  exit; */
if ($this->data['last_indexh'] > 0) {
    $rooms = $tipoHabitacion[0]['sgl'] + $tipoHabitacion[0]['dbl'] + $tipoHabitacion[0]['tpl'] + $tipoHabitacion[0]['qua'];
    $r_adult1 = $hotel_reserves[0]['room1_adult'];
    $r_adult2 = $hotel_reserves[0]['room2_adult'];
    $r_adult3 = $hotel_reserves[0]['room3_adult'];
    $r_adult4 = $hotel_reserves[0]['room4_adult'];
    $r_child1 = $hotel_reserves[0]['room1_child'];
    $r_child2 = $hotel_reserves[0]['room2_child'];
    $r_child3 = $hotel_reserves[0]['room3_child'];
    $r_child4 = $hotel_reserves[0]['room4_child'];
}
//	$hotel = $this->data['hotel'];
//        if($tours->id_hotel_reserve != -1){
//	if($hotel_reserve->breakfastprice!=0){
//		$breakfastdato = 'SUPER BREKFAST BUFFET';
//	}else{
//		if($hotel->breakfast==1){
//			$breakfastdato = "FREE BREAKFAST ";
//		}else{
//			$breakfastdato = "NOT BREAKFAST ";
//		}	
//	}
//        }else{
//            $breakfastdato = '';
//        }
//Variables que se necesitan para el calculo de de lso precios en tiempo de ejecucion.	
$valores = $this->data['valores'];
$numpark = $this->data['numpark'];

//Tipo de pago y saldo
$dato_pago = $tours->pago;
$var = explode('-', $dato_pago);
$tipo_pago = strtoupper($var[0]);
if (isset($var[1])) {
    $tipo_saldo = $var[1];
} else {
    $tipo_saldo = 'FULL';
}
if ($agencia->id != -1) {
    if ($agency_account['opcion5'] == 1) {
        $textoVoucher = 'Open Credit Voucher';
        $disponible = -1;
    } else {
        $textoVoucher = 'Limit Credit Voucher';
    }
} else {
    $textoVoucher = 'Limit Credit Voucher';
}

/*FLOOR (REDONDEA) PCCWF (PAGOS CON CREDIT CARD WITH FEE)*/
//    $sql = "SELECT SUM(pagado) AS PCCWF FROM tours_pago WHERE id_tours = $tours->id AND pago='CREDIT CARD WITH FEE' AND tipo_pago='COLLECT ON BOARD' AND tipo='MULTI'";
//    $rs = Doo::db()->query($sql);
//    $pagosccwf = $rs->fetchAll();
//
////                    print($pagosprep);
//    foreach ($pagosccwf as $pccwf) {
////                        print($ppr['PAGPRED']);
//    }
//    $pago_ccwf = $pccwf['PCCWF']; 
//    $pago_sinccwf = ($pccwf['PCCWF']) / 1.04;
//    $cargos1 = $pago_ccwf - $pago_sinccwf;
//    $cargos = number_format($cargos1, 2, '.', '');
//    
    //print($cargos);
    
/*FLOOR (REDONDEA) PCCWF (PAGOS PREPAGO CON CREDIT CARD WITH FEE)*/
    $sqlpp = "SELECT SUM(pagado) AS PCCWF FROM tours_pago WHERE id_tours = $tours->id AND tipo_pago='PRED-PAID' AND pago='CREDIT CARD WITH FEE' AND tipo='MULTI'";
    $rspp = Doo::db()->query($sqlpp);
    $pagosccwf = $rspp->fetchAll();

//                    print($pagosprep);
    foreach ($pagosccwf as $pccwf) {
//                        print($ppr['PAGPRED']);
    }
    $pago_ccwf = $pccwf['PCCWF']; 
    $pago_sinccwf = ($pccwf['PCCWF']) / 1.04;
    $cargos1 = $pago_ccwf - $pago_sinccwf;
    $cargospp = number_format($cargos1, 2, '.', '');

   //print($cargospp);

    //////////////////////////////////////////////////////////////////

    /*FLOOR (REDONDEA) PCCWF (PAGOS COLLECT ON BOARD CON CREDIT CARD WITH FEE)*/
    $sqlcob = "SELECT SUM(pagado) AS PCOB FROM tours_pago WHERE id_tours = $tours->id AND tipo_pago='COLLECT ON BOARD' AND pago='CREDIT CARD WITH FEE' AND tipo='MULTI'";
    $rscob = Doo::db()->query($sqlcob);
    $pagoscob = $rscob->fetchAll();

//                    print($pagosprep);
    foreach ($pagoscob as $pcob) {
//                        print($ppr['PAGPRED']);
    }
    $pago_cob = $pcob['PCOB']; 
    $pago_sincccob = ($pcob['PCOB']) / 1.04;
    $cargos2 = $pago_cob - $pago_sincccob;
    $cargoscob = number_format($cargos2, 2, '.', '');

    //print($cargoscob);

    
    $sql2 = "SELECT estado_one, estado_round, trip_no, trip_no2 FROM reservas WHERE id_tours = $tours->id AND type_tour = 'MULTI' ";
    $rs2 = Doo::db()->query($sql2);
    $estados = $rs2->fetchall();
    
    foreach ($estados as $est){
        
    }
    
    $estado_transf_in = $est['estado_one'];
    $estado_transf_out = $est['estado_round'];
    $trip1 = $est['trip_no'];
    $trip2 = $est['trip_no2'];
    
    //echo $trip1;
    
//    print($estado_transf_in);
//    print($estado_transf_out);
    
    $idagencia = $agencia->id;
    //print($idagencia);
    $sql4 = "SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days FROM agency_account WHERE id_agencia = '$idagencia' ";
    $rs4 = Doo::db()->query($sql4);
    $opcion = $rs4->fetchAll();


    foreach ($opcion as $opc) {

    }
    $voucher = $opc['opcion5']; 
    
    
?>

<!--<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--jquery para el calendario-->

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
<style>
    .fields2 input {
        height: 22px;
        border: #AFAFAF solid thin;
        width: 50px;
        font-family: courier;
        font-size: 22px;
        font-weight: bold;
        text-align: center;
        color: #0033FF;
        padding-top: 3px;
    }
    .fields input {
        height: 22px;
        border: #AFAFAF solid thin;
        width: 50px;
        float: left;
        padding-right: 3px;
        padding-left: 3px;
        text-align: center;
        font-size:12px;
    }
    .field {
        height: 22px;
        font-size: 11px;
        color: #666;
        text-decoration: none;
        border: #AFAFAF solid thin;
        float: left;
    }
    span .field {
        height: 22px;
        font-size: 11px;
        color: #666;
        text-decoration: none;
        border: #AFAFAF solid thin;
        float: left;
        text-align: center;
    }
    .select {
        font-size: 12px;
        color: #666;
        text-decoration: none;
        height: 27px;
        padding: 3px;
        cursor: pointer;
    }
    .select2 {
        font-size: 14px;
        color: #333;
        text-decoration: none;
        height: 27px;
        padding: 3px;
        font-weight:bold;
        cursor: pointer;
    }
    #arrival {
        background-color: #DCE6F2;
        border: #0167CC solid thin;
        width:95%;
        float: left;
        padding: 8px;
        margin-right: 8px;
        margin-left: 7px;
        height: auto;
    }
    #departure {
        background-color: #F3DCDC;
        border: #B83A36 solid thin;
        width: 95%;
        float: left;
        padding: 8px;
        height: auto;
    }
    #type .list {
        float: left;
        padding: 0 2px 0 2px;
        margin: 0;
    }
    #type .label {
        float: left;
        margin-right: 5px;
        margin-top: 4px;
    }
    #type {
        margin: auto auto 8px auto;
        float: left;
        width: 100%;
        clear: both;
    }
    #type .list li {
        font-size: 11px;
        color: #666;
        display: inline;
        text-decoration: none;
        cursor: pointer;
    }
    #total #amount {
        text-align: center;
        vertical-align: middle;
        border: #0368CC solid thin;
        background-color: #DCE6F2;
        color: #0368CC;
        font-size: 26px;
        font-weight: 600;
    }
    #total .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total .price {
        text-align: center;
        vertical-align: middle;
        border: #33449C solid thin;
        background-color: #33449C;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
        border-radius: 130px 0px 130px 0px;
        margin-left: 9px;

    }
    #t-total .label {
        text-align: center;
        font-size: 12px;
    }
    #t-total2 .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total2 .price {
        text-align: center;
        vertical-align: middle;
        border: #AC1B29 solid thin;
        background-color: #AC1B29;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
    }
    .t-total3 .label {
        text-align: center;
        font-size: 16px;
    }
    .t-total3 .price {
        text-align: center;
        vertical-align: middle;
        border: #AC1B29 solid thin;
        background-color: #AC1B29;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
        width:167px;
    }

    .t-total4 .label {
        text-align: center;
        font-size: 16px;
    }
    .t-total4 .price {
        text-align: center;
        vertical-align: middle;
        border: #00F solid thin;
        background-color: #DCE6F2;
        color: #00F;
        font-size: 26px;
        font-weight: 600;
    }
    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 0px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        padding: 8px;
        width: 100%;
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
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#4c4c4c+0,595959+12,666666+25,474747+39,2c2c2c+50,000000+51,111111+60,2b2b2b+76,1c1c1c+91,131313+100;Black+Gloss+%231 */
    background: rgb(76,76,76); /* Old browsers */
    background: -moz-linear-gradient(-45deg, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(-45deg, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(135deg, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#131313',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        }
        .cerati{
           /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+20,2989d8+50,1e5799+80&0+0,0.8+15,1+19,1+81,0.8+85,0+100 */
    background: -moz-linear-gradient(45deg, rgba(30,87,153,0) 0%, rgba(30,87,153,0.8) 15%, rgba(30,87,153,1) 19%, rgba(30,87,153,1) 20%, rgba(41,137,216,1) 50%, rgba(30,87,153,1) 80%, rgba(30,87,153,1) 81%, rgba(30,87,153,0.8) 85%, rgba(30,87,153,0) 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(45deg, rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(45deg, rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001e5799', endColorstr='#001e5799',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }

    .super{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+29,0751b2+78 */
        background: rgb(197,222,234); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 29%, rgba(7,81,178,1) 78%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#0751b2',GradientType=0 ); /* IE6-9 */

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

    .negro{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#131313+0,1c1c1c+9,2b2b2b+24,111111+40,000000+49,2c2c2c+50,474747+61,666666+75,595959+88,4c4c4c+100 */
    background: rgb(19,19,19); /* Old browsers */
    background: -moz-linear-gradient(-45deg, rgba(19,19,19,1) 0%, rgba(28,28,28,1) 9%, rgba(43,43,43,1) 24%, rgba(17,17,17,1) 40%, rgba(0,0,0,1) 49%, rgba(44,44,44,1) 50%, rgba(71,71,71,1) 61%, rgba(102,102,102,1) 75%, rgba(89,89,89,1) 88%, rgba(76,76,76,1) 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(-45deg, rgba(19,19,19,1) 0%,rgba(28,28,28,1) 9%,rgba(43,43,43,1) 24%,rgba(17,17,17,1) 40%,rgba(0,0,0,1) 49%,rgba(44,44,44,1) 50%,rgba(71,71,71,1) 61%,rgba(102,102,102,1) 75%,rgba(89,89,89,1) 88%,rgba(76,76,76,1) 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(135deg, rgba(19,19,19,1) 0%,rgba(28,28,28,1) 9%,rgba(43,43,43,1) 24%,rgba(17,17,17,1) 40%,rgba(0,0,0,1) 49%,rgba(44,44,44,1) 50%,rgba(71,71,71,1) 61%,rgba(102,102,102,1) 75%,rgba(89,89,89,1) 88%,rgba(76,76,76,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#131313', endColorstr='#4c4c4c',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        }
        .rojo2{
           /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f3c5bd+0,e86c57+0,e86c57+0,7c1600+0,930a05+10,930a05+18,8e1101+28,891a01+64,ff6600+90,c72200+100 */
    background: rgb(243,197,189); /* Old browsers */
    background: -moz-linear-gradient(-45deg, rgba(243,197,189,1) 0%, rgba(232,108,87,1) 0%, rgba(232,108,87,1) 0%, rgba(124,22,0,1) 0%, rgba(147,10,5,1) 10%, rgba(147,10,5,1) 18%, rgba(142,17,1,1) 28%, rgba(137,26,1,1) 64%, rgba(255,102,0,1) 90%, rgba(199,34,0,1) 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(-45deg, rgba(243,197,189,1) 0%,rgba(232,108,87,1) 0%,rgba(232,108,87,1) 0%,rgba(124,22,0,1) 0%,rgba(147,10,5,1) 10%,rgba(147,10,5,1) 18%,rgba(142,17,1,1) 28%,rgba(137,26,1,1) 64%,rgba(255,102,0,1) 90%,rgba(199,34,0,1) 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(135deg, rgba(243,197,189,1) 0%,rgba(232,108,87,1) 0%,rgba(232,108,87,1) 0%,rgba(124,22,0,1) 0%,rgba(147,10,5,1) 10%,rgba(147,10,5,1) 18%,rgba(142,17,1,1) 28%,rgba(137,26,1,1) 64%,rgba(255,102,0,1) 90%,rgba(199,34,0,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f3c5bd', endColorstr='#c72200',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }
    .booking2{
        background: -moz-linear-gradient(270deg,  #00FF00 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #00FF00 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,  #00FF00), color-stop(8%, #FCFCFC), color-stop(49%, #FFFFFF), color-stop(97%, #FCFCFC), color-stop(100%,  #00FF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg,  #00FF00 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #00FF00 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg,  #00FF00 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #00FF00 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg,  #00FF00 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #00FF00 100%); /* ie10+ */
        background: linear-gradient(180deg,  #00FF00 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #00FF00 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=' #00FF00', endColorstr=' #00FF00',GradientType=0 ); /* ie6-9 */

    }

    .verde11{
        background: -moz-linear-gradient(270deg,  #FF4500 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #FF4500 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,  #F0F8FF), color-stop(8%, #FCFCFC), color-stop(49%, #FFFFFF), color-stop(97%, #FCFCFC), color-stop(100%,  #F0F8FF)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg,  #FF4500 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #FF4500 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg,  #FF4500 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #FF4500 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg,  #FF4500 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #FF4500 100%); /* ie10+ */
        background: linear-gradient(180deg,  #FF4500 0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #FF4500 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=' #F0F8FF', endColorstr=' #F0F8FF',GradientType=0 ); /* ie6-9 */

    }

    .verde{
        background: -moz-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,  #F0F8FF), color-stop(8%, #FCFCFC), color-stop(49%, #FFFFFF), color-stop(97%, #FCFCFC), color-stop(100%,  #F0F8FF)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* ie10+ */
        background: linear-gradient(180deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=' #F0F8FF', endColorstr=' #F0F8FF',GradientType=0 ); /* ie6-9 */

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

    .booking1{        
        background: rgba(67,165,230,0.28);
        background: -moz-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(56%, rgba(67,165,230,0.28)), color-stop(89%, rgba(67,165,230,0.82)), color-stop(100%, rgba(210,255,82,1)));
        background: -webkit-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: -o-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: -ms-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: linear-gradient(to bottom, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#43a5e6', endColorstr='#d2ff52', GradientType=0 );
    }

    .blue{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+31,066dab+100;Web+2.0+Blue+3D+%231 */
        background: rgb(197,222,234); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 31%, rgba(6,109,171,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=0 ); /* IE6-9 */

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

    .brown2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6dfb8+47,f6dfb8+76,e1ac51+94 */
        background: rgb(246,223,184); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(246,223,184,1) 47%, rgba(246,223,184,1) 76%, rgba(225,172,81,1) 94%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(246,223,184,1) 47%,rgba(246,223,184,1) 76%,rgba(225,172,81,1) 94%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(246,223,184,1) 47%,rgba(246,223,184,1) 76%,rgba(225,172,81,1) 94%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6dfb8', endColorstr='#e1ac51',GradientType=0 ); /* IE6-9 */

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


    .orangered{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e5361b+20,ed9017+95 */
        background: rgb(229,54,27); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(229,54,27,1) 20%, rgba(237,144,23,1) 95%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5361b', endColorstr='#ed9017',GradientType=0 ); /* IE6-9 */

    }

    .oliveti{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f2f6f8+0,d8e1e7+50,b5c6d0+82,e0eff9+100 */
        background: rgb(242,246,248); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 82%, rgba(224,239,249,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */

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

    .paymentvertblack{
        background: -moz-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #000000), color-stop(35%, #FFFFFF), color-stop(50%, #000000), color-stop(67%, #ffffff), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* ie10+ */
        background: linear-gradient(0deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000',GradientType=0 ); /* ie6-9 */
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



    .ui-widget-header {

        background: #c00;
        color: #ffffff;
        font-weight: bold;
        border-radius: 6px 6px 0px 0px !important;
        font-family: bebasbook;
    }

    .oliverty{
        border: 2px solid #fff;
        border-radius: 9px 9px 2px 2px;
        background-image: url(../../../global/img/confirm.png);
        width: 184px;
        height: 32px;
        font-size: 14px;
        font-weight: bold;
        font-style: Normal;
        color: white;
        background-position: 0px 0px;
        background-repeat: repeat-x;
        padding: 7px;
        margin-left: 764px;
        margin-top: 191px;
        position: absolute;
        filter: hue-rotate(1137deg);
    }

    @keyframes animatedBackgroundButton {
        from { background-position: 0 0; }
        to { background-position: 100% 0; }
    }

    .oliverty:hover{
        animation: animatedBackgroundButton 1s linear infinite;
        -moz-filter:hue-rotate(-250deg);
        -webkit-filter:hue-rotate(-250deg);
        -o-filter:hue-rotate(-350deg);
        -ms-filter:hue-rotate(-350deg);
        filter:hue-rotate(-350deg);

    }

    .button_sliding_bg {
        color: #fff;
        background: #006394 ;
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
        box-shadow: inset 0 100px 0 0 #E21F26 ;
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
    
    $estado_multiday = $tours->estado;
    
    
    if($estado_multiday == 'INVOICED'){
        
        $id_multiday = $tours->id;
        
        $sql = "SELECT id_factura FROM facturaservicio WHERE id_servicio = '$id_multiday' AND tipo_servicio = 'MULTI'";
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
    
    
    }
    
?>
    
<span id="limpiar"></span>

<?php
$sql1 = "SELECT id_agency, tarifario FROM tours WHERE id='$tours->id'";
$rs1 = Doo::db()->query($sql1);
$id_tarif = $rs1->fetchAll();
//print_r($id_tarif);

foreach ($id_tarif as $idt) {
    $id_tarifario = $idt['tarifario'];
    $id_agency = $idt['id_agency'];
}


//echo '-->'.$id_agency; 
?>
 
<div id="header_page" style="background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
    
    <div class="header">Tours [ Edit ] ID  <?php echo $tours->id; ?><input type="text" readonly="true" style="display:none; background: #fff; margin-left: 7px; margin-top: -11px;width: 290px;color: #fff;" name="tour_name" id="tour_name"  value="" /></div>
    <input type="hidden" id="tarifario" onclick="tarifario()" name="tarifario" value="<?php echo $id_tarifario; ?>">
    <input type="hidden" id="id_agencia"  onclick="id_agencia()" name="id_agencia" value="<?php echo $id_agency; ?>">

    <script>
        function tarifario() {
            var id = document.getElementById('tarifario').value;
            document.getElementById('rate').value = id;
            document.getElementById('rates').value = id;
        }
    </script>

    <script>
        function id_agencia() {
            var id_agencia = document.getElementById('id_agency').value;

            if (id_agencia == 45) {
                alert('SuperTours');
            } else {
                alert('Agencia')
            }
        }
    </script>


    <div  id="toolbar">
        
        

        <select style="margin-right:13px; height: 19px; margin-top:15px; width:290px; background: #128020; color: #fff;border-color: transparent;" name="fnombre" id="rate" onclick = "capturar();" onchange="obtenerValor(this.value);">
            <option id="" value="0">Select Tour Name</option>
            <?php
            $sql1 = "SELECT id, rate FROM ratesvalid";
            $rs1 = Doo::db()->query($sql1, array(9));
            $rates_valid1 = $rs1->fetchAll();
            foreach ($rates_valid1 as $r) {
                echo '<option value="' . $r['id'] . '" ' . (( 9 == $r['id']) ? 'select' : '' ) . '>' . $r['rate'] . '</option>';
            }
            ?>
        </select>  



        <script type="text/javascript">
            var obtenerValor = function (x) {
                document.getElementById('rates').value = x;
                net_rate.value = x;
            };
        </script>    

        <div class="toolbar-list">
            <ul>
                <li style="margin: 0 -92px -26px; margin-top: 6px;">

                    <!--<form action="<?php echo $data['rootUrl'] ?>admin/tours/edit/resumen2" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
                        <input type="text" id="variable" name="variable" style="display:none; width: 13%; margin-top: -4px;" value="<?php echo $tours->id; ?>" />

                        <button style="cursor:pointer; margin-top: -4px; margin-left: -5px; padding: 10px; color: #AC1B29;font-weight: 700;">Summary</button>
                        <input  type="submit" hidden="hidden" value="Summary" style="cursor:pointer; margin-top: -4px; margin-left: -5px; padding: 10px; color: #AC1B29;font-weight: 700;" />                      


                    </form>-->


                    <form name="formulario" id="formulario" action="" method="post" onsubmit="onEnviar()">

                        <input type="text" id="variable" name="variable" style="display:none; width: 13%; margin-top: -4px;" value="<?php echo $tours->id; ?>" />

                        <button name="bt1" id="bt1" type="submit" style="cursor:pointer; color: #AC1B29;font-weight: 700; margin-top: 3px; margin-left: -337px; padding: 10px; font-size:9px; width: 118px;"  onclick="f_Cmb()">Summary Agency</button>

                        <button name="bt2" id="bt2" type="submit" style="cursor:pointer; color: #AC1B29;font-weight: 700; margin-top: 3px; margin-left: -247px; padding: 10px; font-size:9px; width: 118px;"  onclick="f_Cmb1()">Summary Passenger</button>

                        <button name="bt3" id="bt3" type="submit" style="cursor:pointer; color: #AC1B29;font-weight: 700; margin-top: 3px; margin-left: -336px; padding: 10px; font-size:9px; width: 118px;"  onclick="f_Cmb2()">Summary Passenger</button>

                    </form>



                </li>

                <script type="text/javascript">
                    var variableJs = document.getElementById("variable").value;

                    function onEnviar() {
                        document.getElementById("variable").value = variableJs;
                    }
                </script>



                <script>
                    function f_Cmb() {
                        //ruta para resumen de agencia
                        document.formulario.action = "<?php echo $data['rootUrl'] ?>admin/tours/edit/resumen";
                        document.formulario.submit();

                    }
                        //ruta para resumen de pasajero de agencia
                    function f_Cmb1() {
                        document.formulario.action = "<?php echo $data['rootUrl'] ?>admin/tours/edit/resumen2";
                        document.formulario.submit();
                    }
                        //ruta para resumen de pasajero de supertours
                    function f_Cmb2() {
                        document.formulario.action = "<?php echo $data['rootUrl'] ?>admin/tours/edit/resumen3";
                        document.formulario.submit();
                    }
                </script>

                <li class="btn-toolbar" id="btn-rastro">
                    <a class="link-button" id="btn-rastro2">
                        <span class="icon-32-rastro" title="Nuevo" style="margin-top: -10px; margin-left: -4px; ">&nbsp;</span>
                        Traces
                    </a>
                </li>

                <li style="margin-left: -1px; margin-top: 1px;" class="btn-toolbar" id="btn-pagos">
                    <a  style="margin-left: -5px; margin-top: -15px;" class="link-button" id="btn-pagos">    
                        <span class="pagos" title="Pagos" style="margin-left: 3px; margin-top: -4px; color:#4B0082; width: 32px; height: 32px; ">&nbsp;</span>

                        Payments
                    </a>
                </li>
                <li class="btn-toolbar" id="btn-cancel">
<!--                    <a class="link-button" ><span class="icon-back" title="Editar" style="margin-top: -10px; margin-left: 4px;" >&nbsp;</span>Back</a>-->
                    <a class="link-button"><i class="fa fa-arrow-left fa-3x" title="Regresar" style="color: #33449C; margin-top: -16px;"></i> <br>Back</a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<fieldset id="facturas" style="position:absolute; width:109px; height: 36px; margin-top: -125px; margin-left:872px; background-color: #F5F5F5; border-color: transparent;">

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
<div id="content_page_tours" style="z-index:1; width:984px; height:1490px; margin-top:-15px;">

    
    <form id="form1" class="form" action="" method="post" name="form1">
        <input type="text" name="rates" id="rates" style="display:none;" size="4" value= "<?php echo $agency['tour_name']; ?>" />
        <input type="text" name="dato" id="dato" style="display:none;" value= "<?php echo $dato; ?>" />
        <div id="info-group" style="width: 900px; margin-left:6px;">
            <div id="cancelation">
                <div class="ho" style="background: #bb0000; margin-left:0px; margin-top:0px;">CANCELATION <span>#</span></div>
                <div id="cancel" style="background: #fff;">00000</div>
            </div>
            <div id="reservation"  style="width:200px; font-size: 12px; margin-left: 121px; position: absolute;">
                <div class="ho" style="background: #bb0000;">RESERVATION <span>#</span></div>
                <div>
                    <input type="text" id="reser" name="reser" style="background: chartreuse; font-weight: 600; font-size: 11px; width: 199px; text-align: center; height: 8px; padding-top: 2px;" value="<?php echo $tours->code_conf; ?>" readonly="readonly">
                </div>
            </div>
            <div id="status" style="position:absolute; margin-left:785px; margin-top:0px; width:188px; font-size:12px;">
                <div class="ho" style="background: #bb0000;">STATUS</div>
                <div id="stat" style="background: #98FB98;"><?php echo $tours->estado; ?></div>
            </div>
            <div id="status-change" style="">
                <div style="color: #fff; background: black; padding: 4px;margin-top: 0px; margin-left: 452px; width: 102px; text-align: center">CHANGE STATUS</div>
        <!--        <select id="estado" name="estado">
                    <option></option>
                    <option <?php
                if ($tours->estado == 'CONFIRMED') {
                    echo ' selected="selected" ';
                }
                ?>  value="CONFIRMED">CONFIRMED</option>
                    <option <?php
                if ($tours->estado == 'QUOTE') {
                    echo ' selected="selected" ';
                }
                ?>  value="QUOTE">QUOTE</option>
                    <option <?php
                if ($tours->estado == 'CANCELED') {
                    echo ' selected="selected" ';
                }
                ?>  value="CANCELED">CANCELED</option>
                </select>-->
                <select id="estado" name="estado" style="margin-left: -4px; height: 20px; margin-top: 1px;padding-top: 1px; width:109px;">
                    <option></option>
                    <option <?php
                    if ($tours->estado == 'CONFIRMED' || $tours->estado == 'INVOICED') {
                        echo ' selected="selected" ';
                    };
                    ?>  value="CONFIRMED">CONFIRMED</option>
                    
                    <option <?php
                    if ($tours->estado == 'QUOTE') {
                        echo ' selected="selected" ';
                    };
                    ?>  value="QUOTE">QUOTE</option>
                    <option value="NOT SHOW W/ CHARGE" <?php
                    if ($tours->estado == 'NOT SHOW W/ CHARGE') {
                        echo ' selected="selected" ';
                    };
                    ?>>NOT SHOW W/ CHARGE</option>
                    <option value="NOT SHOW W/O CHARGE" <?php
                    if ($tours->estado == 'NOT SHOW W/O CHARGE') {
                        echo ' selected="selected" ';
                    };
                    ?>>NOT SHOW W/O CHARGE</option>
                    <option <?php
                    if ($tours->estado == 'CANCELED') {
                        echo ' selected="selected" ';
                    };
                    ?>  value="CANCELED">CANCELED</option>
                </select>
            </div>
        </div>
        <br />
        <!--input type-->


        <!-- lider pass -->

        <!-- end lider pass -->
        <!-- agency and cal center -->
        <fieldset id="inputype" class="negro" style="float: left; margin-bottom: 2%; border-radius: 0px 120px 0px 14px; box-shadow: 0 -14px 4px #DC1349; width: 47%;">
            <legend style="border: 1px solid #B83A36;; background: #fff;">INPUT TYPE</legend>
            <div id="opera" class="input">
                <table width="100%" >
                    <tr align="left">
                        <td >
                            <label style="color:#FFFFFF; margin-left: -12px;" id="label">CALL CENTER</label>
                        </td>
                        <td >
                            <input name="nombre" style="position:absolute; margin-left:-355px; margin-top:-10px; width:178px;" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr><td colspan="2" >
                            <table width="100%">
                                <tr>
                                    <td width="10%">
                                        <label style="margin-top:10px; margin-left: -13px; color:#FFFFFF;">AGENCY</label>
                                    </td>
                                    <td width="40%">
                                        <div class="ausu-suggest" >                                            
                                            <input name="agency" type="text" style="margin-top:9px; margin-left:4px;"  id="agency" size="19" maxlength="30" value="<?php echo $agencia->company_name; ?>" readonly="readonly" autocomplete="off"  />
                                            <input type="hidden" size="4" value="<?php echo $agencia->id; ?>" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                            <input type="hidden" size="4" value="<?php echo $agencia->type_rate; ?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                            <input type="hidden" size="4" value="<?php echo $disponible; ?>" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                            <input type="hidden" size="4" value='<?php echo ($data['comision'] > 1) ? $data['comision'] : 0; ?>' name="comision" id="comision" autocomplete="off" />
                                        </div>
                                    </td>
                                    <td width="10%">
                                        <label style="position:absolute; margin-top:-6px; margin-left:8px; color:#FFFFFF; ">Employ</label>
                                    </td>
                                    <td width="40%">
                                        <div class="ausu-suggest" >
                                            <input style="width:178px; margin-top:9px; margin-left:53px; border-top-right-radius: 6px;" name="uagency" type="text"  id="uagency" readonly="readonly" autocomplete="off" size="11" maxlength="30" value="<?php echo $userA->firstname . ' ' . $userA->lastname ?>"  >
                                            <input type="hidden" size="4" value="<?php echo $userA->id; ?>" name="id_auser" id="id_auser" autocomplete="off" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2" >&nbsp;</td></tr>
                    <tr>
                        <td colspan="2">
                            <table align="center" style="margin-top:-5px;" cellspacing="10">
                                <tr valign="top">
                                    <td><label style="color:#FFFFFF;"> BY PHONE</label> <input id="byrp" name="byr" type="radio" value="1" checked="checked"/></td>
                                    <td><label style="color:#FFFFFF;"> BY MAIL</label> <input id="byrm" name="byr" type="radio" value="2" /></td>
                                    <td><label style="color:#FFFFFF;"> WEBSALE </label> <input id="byrw" name="byr" type="radio" value="3" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>

        <fieldset id="liderpax" style="position:absolute; margin-left:492px; width: 180px; border-radius: 130px 0px 14px 0px; box-shadow: 0 -14px 4px #1E90F6;" class="negro" >
            <legend style="border: 1px solid #00C; margin-left:64px; background: #fff;">LEADER PASS</legend>
            <table width="50%">
                <tr>
                    <td>
                        <div id="opera" class="input" style="padding-top:5px;">
                            <table width="50%">
                                <tr>
                                    <td>
                                        <label style="margin-left:25px; color:#FFFFFF;" id="label"> SEARCH </label>
                                    </td>
                                    <td>
                                        <div class="ausu-suggest" id="opera">
                                            <input type="text" size="65" style="position:absolute; margin-left:2.2px; width:376px; margin-top:-12px;" value="<?php echo $data['cliente']->lastname . ' ' . $data['cliente']->firstname . ' - E-Mail -' . $data['cliente']->username ?>" name="cliente" id="cliente" autocomplete="off">

                                            <input type="hidden" size="4" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled" value="<?php echo $data['cliente']->id ?>" readonly="readonly">
                                            <div class="ausu-suggestionsBox"></div>
                                                
                                        </div>
                                    </td>
<!--                                    <td>&nbsp;&nbsp;</td>-->
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
                            <table width="50%">
                                <tr>
                                    <td width="" align="right">
                                        <input type="hidden" name="idCliente" id="idCliente" value="<?php echo $data['cliente']->id ?>">
                                        <label id="label" style="color:#FFFFFF; margin-left:2px;">FIRST NAME</label>
                                    </td>
                                    <td>
                                        <input name="firstname1" type="text" id="firstname1" style="margin-left:2px; width:128px;"  size="20" maxlength="20" value="<?php echo $data['cliente']->firstname ?>">
                                    </td>
                                    <td width="" align="right">
                                        <label style="margin-left:-6px; color:#FFFFFF;" id="labeldere12" >LAST NAME </label>
                                    </td>
                                    <td>
                                        <input name="lastname1" type="text" style="margin-right:-12px; width:175px;" id="lastname1" size="20" maxlength="20" value="<?php echo $data['cliente']->lastname ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <label style="margin-left:2px; color:#FFFFFF;" id="labeldere12">PHONE </label>
                                    </td>
                                    <td>
                                        <input name="phone1" type="text" id="phone1" size="20" maxlength="20" style="margin-left:2px; margin-top:6px; width:128px;"  value="<?php echo $data['cliente']->phone ?>">
                                        <input type="hidden" name="type_cliente" id="type_cliente" value="<?php echo $data['cliente']->tipo_client ?>">
                                    </td>
                                    <td align="right">
                                        <label style="color:#FFFFFF;" id="labeldere12" style="margin-left:-6px;">E-MAIL </label>
                                    </td>
                                    <td>
                                        <input name="email1" type="text" id="email1" size="20" style="margin-right:-13px; width:175px; margin-top:6px;" value="<?php echo $data['cliente']->username ?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
        <!-- end agency y cal center -->
        <!-- date of tours -->
        <fieldset style="margin-top: 5px; border-radius: 10%;margin-top: 2%; margin-bottom: 1%;  box-shadow: 6px 7px 4px #999;"class="booking2">
            <div id="date" align="center">
                <table width="90%">
                    <tr valign="top">
                        <td>
                            <table>
                                <tr>
                                    <td><label for="type_services_premiun"  style="cursor:pointer;font-size: 10px;" ><strong>Premium Class</strong></label></td>
                                    <td><input type="radio" id="type_services_premiun" name="type_services" value="0"  checked="checked"/> </td>
                                </tr>
                                <tr>
                                    <td><label for="type_services_vip" style="cursor:pointer;font-size: 10px;" ><strong>Platinum VIP</strong></label></td>
                                    <td><input type="radio" id="type_services_vip" name="type_services" value="1" /> </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <div id="opera" class="input" >
                                <table style="margin-left:2px;">
                                    <tr>
                                        <td>
                                            <label style="width:100px; font-size: 11px; color: #000;"  >START DATE </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="" id="dataclick1" ><i class="fa fa-calendar" style="box-shadow: 3px 5px 4px #999; font-size: 21px; color: #00E;"></i></a>                                           
                                            <input type="text" id="fecha_salida" name="fecha_salida"  style="text-align:center; font-weight:bold;" size="10" maxlength="15" value="<?php
                                            list($anio, $mes, $dia) = explode('-', $tours->starting_date);
                                            echo $mes . '-' . $dia . '-' . $anio;
                                            ?>" onchange="fechaRetorno(this.value);fechale();" autocomplete="off"/>
                                        </td>
                                        <input name="fec_sal" type="text" style="display:none; text-align:center;" id="fec_sal" size="10" maxlength="15" value="<?php
                                            list($anio, $mes, $dia) = explode('-', $tours->starting_date);
                                            echo $mes . '-' . $dia . '-' . $anio;
                                            ?>" onchange="fechaRetorno(this.value);" autocomplete="off" onchange="fechale();"/>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div id="opera" style="margin-left:2px;" class="input">
                                <table>
                                    <tr>
                                        <td>
                                            <label style="width:100px;font-size: 11px; color: #000;">END DATE</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>                                            
                                            <a href="" id="dataclick2"><i class="fa fa-calendar" style="box-shadow: 3px 5px 4px #999; font-size: 21px; color: #B83A36;"></i></a>
                                            <input name="fecha_retorno" type="text"  style="text-align:center; font-weight:bold;" id="fecha_retorno" size="10" maxlength="15" value="<?php
                                            list($anio, $mes, $dia) = explode('-', $tours->ending_date);
                                            echo $mes . '-' . $dia . '-' . $anio;
                                            ?>"   autocomplete="off" onchange="fechale2();" />
                                            
                                            <input name="fec_retor" type="text"  style="display:none; text-align:center;" id="fec_retor" size="10" maxlength="15" value="<?php
                                            list($anio, $mes, $dia) = explode('-', $tours->ending_date);
                                            echo $mes . '-' . $dia . '-' . $anio;
                                            ?>"   autocomplete="off" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div class="fields" >
                                <label style="font-size: 10px; margin-left: 2px;"><b>ADULT(S)</b></label><br />
                                <input style="font-size:16px; margin-top: 12px;" name="adult" id="adult" type="number" value="<?php echo $tours->adult; ?>" max="100" min="1">
                            </div>
                        </td>


                    <input type="text" name="frates" readonly="readonly" id="rates" hidden="hidden"  value= "<?php echo $agency['tour_name']; ?>" />


                    <td>

                        <div class="fields">
                            <label style="font-size: 10px; margin-left: 2px;"><b>CHILD(S)</b></label><br />
                            <input style="font-size:16px; margin-top: 12px;" name="child" id="child" type="number" value="<?php echo $tours->child; ?>" max="100" min="0">
                        </div>
                    </td>
                    <td style="width:100px; margin-top:-5px;">
                        <label for="tipo_pass"><span style="font-size: 10px;  margin-left: 17px;">Resident </span></label>
                        <input type="checkbox" id="tipo_pass" name="tipo_pass" value="0" onclick="opcionCheckbox(this.id)" />
                    </td>
                    <td>
                        <div id="length-tour" class="fields2" >
                            <table>
                                <tr>
                                    <td rowspan="2">
                                        <label><strong style="font-size: 10px;">LENGTH OF TOUR</strong></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fa fa-sun-o" style="color: #FF8000;"></i>
                                        <span style="font-size: 10px;">
                                            Days:<br /> 
                                            <input name="days" style="width:52px; height:28px;" id="days" type="text" value="<?php echo $tours->length_day; ?>" readonly="readonly">
                                        </span>
                                    </td>
                                    <td>  <i class="fa fa-moon-o" style="color: blue;"></i>
                                        <span style="font-size: 10px;">

                                            Nights:<br /> <input name="nights" id="nights" type="text" value="<?php echo $tours->length_nights; ?>" readonly="readonly" style="width:52px; height:28px;">
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>

                    </tr>
                </table>
            </div>
        </fieldset>
        <!-- Transfer-->
        <table width="100%">
            <tr>
                <td width="49%" valign="top" >

                    <fieldset id="arrival" class="cerati" style="border-radius: 7%; box-shadow: 6px 7px 4px #999;" >
                        <legend id="leg_transfer_in" style="border:1px solid #00C;background:#fff;">
                            <label for="opcion_transfer_in" style="cursor:pointer; ">TRANSFER IN</label>  <input type="checkbox" name="opcion_transfer_in" id="opcion_transfer_in" value="1" checked="checked"/>
                        </legend>
                        <div id="conte_arrival" style="height: 225px;" >
                            <table width="100%">
                                <tr>
                                    <td>
                                        <div id="type">
                                            <table width="100%">
                                                <tr>
                                                    <td><div class="label" style="color: #fff; font-size: 12px; margin-left: 2px;">ARRIVAL</div></td>
                                                    <td>
                                                        <ul class="list" style="margin-left:-40px;">
                                                            <li><input id="a_bus" name="a_type" type="radio" value="0" <?php
                                                                if ($transfer_in->type == 1) {
                                                                    echo '  checked="checked" ';
                                                                }
                                                                ?> ><label style="cursor:pointer;font-size: 12px;color: #fff;"  for="a_bus">BUS</label></li>
                                                            <li><input id="a_vip" name="a_type" type="radio" value="1"  <?php
                                                                if ($transfer_in->type == 2) {
                                                                    echo '  checked="checked" ';
                                                                }
                                                                ?>  /><label style="cursor:pointer;font-size: 12px;color: #fff;"  for="a_vip">VIP</label></li>
                                                            <li><input id="a_airpoty" name="a_type" type="radio" value="2" <?php
                                                                if ($transfer_in->type == 3) {
                                                                    echo '  checked="checked" ';
                                                                }
                                                                ?>  /><label style="cursor:pointer;font-size: 12px;color: #fff;"  for="a_airpoty">AIRPORT</label></li>
                                                            <li><input id="a_car" name="a_type" type="radio" value="3"  <?php
                                                                if ($transfer_in->type == 4) {
                                                                    echo '  checked="checked" ';
                                                                }
                                                                ?>  /><label style="cursor:pointer;font-size: 12px;color: #fff;"  for="a_car">BY CAR</label></li>
                                                        </ul>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td title="Price of transport per person">
                                                        <div style = "display:none;" id="t-total">
                                                            <div id="price_transport1pp" class="price">$ 0.00</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!--Estados de Select-->
                                                <input type="text"  name="estado_trf_in"  id="estado_trf_in"  style="display:none;  width:25px;  margin-left: 30px; margin-top:4px;" value="<?php echo $estado_transf_in; ?>" />
                                                <input type="text"  name="estado_trf_out"  id="estado_trf_out"  style="display:none;  width:25px;  margin-left: 30px; margin-top:4px;" value="<?php echo $estado_transf_out; ?>" />

                                                <div>
                                                        <!--TRANSFER IN-->
                                                        <select style="position:absolute; border: #000 2px solid; width:149px; margin-left: 0px; margin-top:24px; border-radius: 0px 0px 0px 0px; font-weight:bold;" id="estado_transfer_in" name="estado_transfer_in" onchange="fecha_transfer_in();">

                                                            <optgroup  label="STATUS">

                                                                <option style="font-weight:bold;" value="1">CONFIRMED</option>
                                                                <option style="font-weight:bold;" value="2">CANCELED</option>                                                                     
                                                                <option style="font-weight:bold;" value="3">NO SHOW</option>                                          


                                                            </optgroup>

                                                        </select>

                                                    </div>
                                            </table>
                                        </div>
                                        
                                        
                                    </td>
                                </tr>
                                <td>&nbsp;</td>
                                <tr>
                                    <td>
                                        <div id="arrival-content">
                                            <div id="transport1" class="group" align="left">

                                                <?php if ($transfer_in->type == 1) { ?>
                                                    <table width="100%"><tr>
                                                            <td>
                                                                <div id="div_from">
                                                                    <div class="label" style="font-size: 12px; color: #fff;">FROM</div>
                                                                    <select style="width:190px; color: #000; font-weight: bold;" name="from" id="from" class="select" onchange="change_from();">
                                                                        <option value="0"></option>
                                                                        <?php foreach ($data["to_areas"] as $e) { ?>
                                                                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == $reserve->fromt ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>


                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="div_to">
                                                                    <div class="label" style="font-size: 12px; color: #fff; margin-left: -32px;">TO</div>
                                                                    <select style="width:190px; margin-left:-32px; color: #000; font-weight: bold;" name="to" id="to" class="select">
                                                                        <?php foreach ($data["area_park"] as $e) { ?>
                                                                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="trip">
                                                                    <div class="label" style="font-size: 12px; color: #fff; margin-left: -23px;">TRIP</div>
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                                <span>
                                                                                    <input class="field" name="a_trip_no" style="width:45px; margin-left:-24px; height: 23.2px; margin-top: -1px; color: #000; font-weight: bold; font-size: 16px; background-color: #fff;  border: 2px solid dodgerblue;" type="text" id="a_trip_no" size="3" maxlength="3" value="<?php echo $reserve->trip_no; ?>" readonly="readonly"/>
                                                                                    <input type="hidden" name="deptime1"  id="deptime1" value="<?php echo $reserve->deptime1; ?>" />
                                                                                    <input type="hidden" name="arrtime1"  id="arrtime1" value="<?php echo $reserve->arrtime1; ?>" />
                                                                                    <input type="hidden" name="trip1a"  id="trip1a" value="0" />
                                                                                    <input type="hidden" name="trip1c"  id="trip1c" value="0" />
                                                                                </span>
                                                                            </td>
<!--                                                                            <td onclick="mostrarTrip1();cargando();">
                                                                                <a><i style="position:absolute; cursor:pointer; color: #fff; font-size: 23px; margin-left:-23px; margin-top:-47px;" id="popup1" class="fa fa-search-plus fa-2x"></i></a>
                                                                            </td>   -->
                                                                            
                                                                            <td onclick="cargando();mostrarTrip1();comprobarScreen();"><a style="color: #fff; cursor:pointer; position: absolute; margin-top: -53px; margin-left: -29px;" id="popup1"><img id="search1" style="" src ='<?php echo $data['rootUrl'] ?>global/img/search.png' width='25' height='25'></a>

                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" colspan="3">
                                                                <div id="pick-drop">
                                                                    <div class="label" style="color: #fff;font-size: 12px;">PICK UP POINT/ADDRESS</div>
                                                                    <div  style="width:100%;" class="ausu-suggest">
                                                                        <input name="a_pickup1" style="width:443px;"
                                                                        <?php
//                            if($reserve->extension1 != 0){
//                                echo ' disabled="disabled" ';
//                            }
                                                                        ?> class="field" type="text" id="a_pickup1" autocomplete="off" maxlength="55" value="<?php echo $pickup1->place . " " . $pickup1->address; ?>"/>
                                                                        <input name="a_id_pickup1" type="hidden" id="a_id_pickup1" maxlength="55" value="<?php echo $pickup1->id; ?>"/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="3">
                                                                <table width="100%">
                                                                    <tr>
<!--                                                                        <td width="25%"> <font style="color: #fff; font-size: 12px;">EXTENSION AREA:</font> </td>
                                                                        <td>-->
                                                                            <td width="25%">    
                                                                                <div>
                                                                                      <div style="color:#FFFFFF;" class="label">EXTENSION AREA:</div>
                                                                                </div> 
                                                                                
                                                                                <select name="ext_from1" id="ext_from1" class="select" style="width:321px; margin-top: 0px; height: 25px; color:#000; font-weight:bold;" onchange="change_ext_from1();">
                                                                                    <option value="0"></option>
                                                                                    <?php
                                                                                    foreach ($extenciones01 as $ext) {
                                                                                        if ($reserve->extension2 == $ext['id']) {
                                                                                            $select = '  selected="selected" ';
                                                                                        } else {
                                                                                            $select = '';
                                                                                        }
                                                                                        echo "<option value='" . $ext['id'] . "'   " . $select . "  >" . $ext['place'] . "' '" . $ext['address'] . " </option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                              
                                                                            </td>
<!--                                                                        </td>-->

                                                                        <td>&nbsp;</td>
                                                                        <td width="15%">
                                                                            <div id="rooms">
                                                                                <div class="label"> <font style="color: #fff; font-size: 12px; margin-left: 3px;">LUGGAGE </font></div>
                                                                                <span><input name="a_luggage" type="text" id="a_luggage" size="2" style="width:57px; margin-left: 4px; font-size: 14px; color: #000;" maxlength="1" value="<?php echo $reserve->luggage1; ?>" class="field"/></span>
                                                                            </div>
                                                                        </td>
                                                                        <td width="15%">
                                                                            <div id="rooms">
                                                                                <div class="label"><font style="color: #fff; font-size: 12px; margin-left: 5px;">ROOM #</font></div>
                                                                                <span><input name="a_room1" type="text" id="a_room1" size="5" maxlength="10" style="margin-left: 6px; width: 45px; font-size: 14px; color: #000;" class="field" value="<?php echo $reserve->room1; ?>"/></span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <div style="width:100%" id="ex_pick_drop">
                                                                    <div class="label" style="color: #fff; font-size: 12px;">EXTENTION DROPOFF POINT/ADDRESS</div>
                                                                    <div style="width:100%" class="ausu-suggest">
                                                                        <input name="a_pickup4" style="width:444px;" <?php
                                                                        if ($reserve->extension2 == 0) {
                                                                            echo ' disabled="disabled" ';
                                                                        }
                                                                        ?>  class="field" type="text" id="a_pickup2" maxlength="55" autocomplete="off" value="<?php echo $reserve->pickup_exten2; ?>"/>
                                                                        <input name="a_id_pickup2" type="hidden" id="a_id_pickup2" maxlength="55" value="<?php echo $reserve->pickup_exten2; ?>"/>                                              </span></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php } else if ($transfer_in->type == 2) { ?>
                                                    <table width="381" border="0">
                                                        <tr >
                                                            <td>&nbsp;</td>
                                                            <td colspan="4" >&iquest;At what time you wish your private service leaves Miami?</td>
                                                            <td width="29">
                                                                <label>
                                                                    <input  autocomplete="off" name="hora1" type="text" id="hora1"  size="6" class="required"  value="<?php echo date('h:iA', strtotime($transfer_in->arrival_time)); ?>" />
                                                                </label>
                                                            </td>
                                                            <td width="29"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7">&nbsp;</td>
                                                            <td colspan="4"><div align="center">&iquest;From where in Miami?</div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="12" height="7">&nbsp;</td>
                                                            <td width="53">&nbsp;</td>
                                                            <td width="58">City:</td>
                                                            <td width="113"><input  autocomplete="off" name="city" type="text" id="city" size="25" class="required" value="<?php echo $transfer_in->city; ?>" /></td>
                                                            <td width="114"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="2">&nbsp;</td>
                                                            <td height="2">&nbsp;</td>
                                                            <td height="2">Address:</td>
                                                            <td height="2"><input  autocomplete="off" name="address" type="text" id="address" size="25" class="required" value="<?php echo $transfer_in->address; ?>"   /></td>
                                                            <td height="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="3">&nbsp;</td>
                                                            <td height="3">&nbsp;</td>
                                                            <td height="3">Zip Code:</td>
                                                            <td height="3"><input  autocomplete="off" name="zipcode" type="text" id="zipcode" size="25" class="required" value="<?php echo $transfer_in->zipcode; ?>" /></td>
                                                            <td height="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7">&nbsp;</td>
                                                            <td height="7">&nbsp;</td>
                                                            <td height="7">Phone #:</td>
                                                            <td height="7"><input  autocomplete="off" name="phone" type="text" id="phone" size="25" class="required"  value="<?php echo $transfer_in->phone; ?>"   /></td>
                                                            <td height="7"></td>
                                                        </tr>
                                                    </table>

                                                    <script>
                                                        $("#hora1").timeEntry().change(function () {
                                                            var log = $("#log");
                                                            log.val(log.val() + ($("#hora1").val() || "blank") + "\n");
                                                            $("#hora2").val($("#hora1").val());
                                                        });
                                                        $("#city").keyup(function () {
                                                            $("#city2").val($("#city").val());
                                                        });
                                                        $("#address").keyup(function () {
                                                            $("#address2").val($("#address").val());
                                                        });
                                                        $("#zipcode").keyup(function () {
                                                            $("#zipcode2").val($("#zipcode").val());
                                                        });
                                                        $("#phone").keyup(function () {
                                                            $("#phone2").val($("#phone").val());
                                                        });
                                                        //$(function(){
                                                        //$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
                                                        //});
                                                    </script>
                                                <?php } else if ($transfer_in->type == 3) { ?>
                                                    <table width="381" border="0">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td colspan="2">&nbsp;</td>
                                                            <td width="29"><label></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="16" colspan="3"><div align="center"></div></td>
                                                            <td rowspan="7">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7">&nbsp;</td>
                                                            <td><div align="left" style="color: #fff;">Airline:</div></td>
                                                            <td>
                                                                <label>
                                                                    <input  autocomplete="off" type="text" name="airlinearrival" id="airlinearrival"  class="required" value="<?php echo $transfer_in->airlie; ?>"  />
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7">&nbsp;</td>
                                                            <td><div align="left" style="color: #fff;">Flight #:</div></td>
                                                            <td><input  autocomplete="off" type="text" name="flightarrival" id="flightarrival"  class="required" value="<?php echo $transfer_in->flight; ?>"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="55" height="7"><div align="left"></div></td>
                                                            <td width="89"><div align="left" style="color: #fff;">Arrival Time:</div></td>
                                                            <td width="279"><input  autocomplete="off" name="hora1" type="text" id="hora1" size="6"  class="required" value="<?php echo date('h:iA', strtotime($transfer_in->arrival_time)); ?>"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="2">&nbsp;</td>
                                                            <td height="2">&nbsp;</td>
                                                            <td height="2">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="3">&nbsp;</td>
                                                            <td height="3">&nbsp;</td>
                                                            <td height="3">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7">&nbsp;</td>
                                                            <td height="7">&nbsp;</td>
                                                            <td height="7">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                    <script>

                                                        $("#hora1").timeEntry().change(function () {
                                                            var log = $("#log");
                                                            log.val(log.val() + ($("#hora1").val() || "blank") + "\n");
                                                        });
                                                        //					$(function(){
                                                        //					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
                                                        //					});
                                                    </script>
                                                <?php } else if ($transfer_in->type == 4) { ?>
                                                    <table width="381" border="0">
                                                        <tr>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td width="36"><label></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="16" colspan="3"><div align="center"></div></td>
                                                            <td rowspan="7">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="77" height="7">&nbsp;</td>
                                                            <td width="211"><div align="left" style="color: #fff;">Estimated arrival time to Orlando:</div></td>
                                                            <td>
                                                                <label>
                                                                    <input  autocomplete="off" name="hora1" value="<?php echo date('h:i A', strtotime($transfer_in->arrival_time)); ?>" type="text" id="hora1" size="6" class="required"/>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7" colspan="2">&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7" colspan="2">&nbsp;</td>
                                                            <td width="128">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="2" colspan="2">&nbsp;</td>
                                                            <td height="2">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="3" colspan="2">&nbsp;</td>
                                                            <td height="3">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7" colspan="2">&nbsp;</td>
                                                            <td height="7">&nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <script>
                                                        $("#hora1").timeEntry().change(function () {
                                                            var log = $("#log");
                                                            log.val(log.val() + ($("#hora1").val() || "blank") + "\n");
                                                        });
                                                        //$(function(){
                                                        //$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
                                                        //});
                                                    </script>
                                                <?php } ?>
                                            </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                </td>
                <td>&nbsp;</td>
                <td width="49%" valign="top">
                    <div id="chk_departure">
                        <fieldset id="departure" style="background-color: #F3DCDC;border-radius: 25px; width:95%; margin-left:-1px;  box-shadow: 6px 7px 4px #999;" class="rojo2">
                            <legend style="background-color: #fff; border: #B83A36 solid thin;" >
                                <label for="opcion_transfer_out" style=" cursor:pointer; " >TRANSFER OUT</label><input type="checkbox" name="opcion_transfer_out" id="opcion_transfer_out" value="1" checked="checked"/>
                            </legend>
                            <div id="conte_departure"  style="height: 225px;"  >
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <div id="type">
                                                <table width="100%">
                                                    <tr>
                                                        <td><div class="label" style="color: #fff; font-size: 12px;">DEPARTURE</div></td>
                                                        <td>
                                                            <ul class="list" style="margin-left:-73px;  margin-top: -2px;">
                                                                <li><input id="d_bus" name="d_type" type="radio" value="0"  <?php
                                                                    if ($transfer_out->type == 1) {
                                                                        echo '  checked="checked" ';
                                                                    }
                                                                    ?> ><label style="cursor:pointer; color: #fff;" for="d_bus">BUS</label></li>
                                                                <li><input id="d_vip" name="d_type" type="radio" value="1"  <?php
                                                                    if ($transfer_out->type == 2) {
                                                                        echo '  checked="checked" ';
                                                                    }
                                                                    ?>  /><label style="cursor:pointer;color: #fff;" for="d_vip">VIP</label></li>
                                                                <li><input id="d_airpoty" name="d_type" type="radio" value="2"  <?php
                                                                    if ($transfer_out->type == 3) {
                                                                        echo '  checked="checked" ';
                                                                    }
                                                                    ?> /><label style="cursor:pointer;color: #fff;" for="d_airpoty">AIRPORT</label></li>
                                                                <li><input id="d_car" name="d_type" type="radio" value="3"  <?php
                                                                    if ($transfer_out->type == 4) {
                                                                        echo '  checked="checked" ';
                                                                    }
                                                                    ?>  /><label style="cursor:pointer;color: #fff;" for="d_car" >BY CAR</label></li>
                                                            </ul>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td title="Price of transport per person">   <div style = "display:none;" id="t-total">

                                                                <div id="price_transport2pp" class="price">$ 0.00</div>
                                                            </div></td>
                                                    </tr>
                                                    
                                                                                                   
                                                
                                                    <div>
                                                    <!--TRANSFER OUT-->
                                                    <select style="position:absolute; border: #000 2px solid; width:149px; margin-left: 1px; margin-top:24px; border-radius: 0px 0px 0px 0px; font-weight:bold;" id="estado_transfer_out" name="estado_transfer_out" onchange="fecha_transfer_out();">

                                                        <optgroup  label="STATUS">

                                                            <option style="font-weight:bold;" value="1">CONFIRMED</option>
                                                            <option style="font-weight:bold;" value="2">CANCELED</option>                                                                     
                                                            <option style="font-weight:bold;" value="3">NO SHOW</option>                                        


                                                        </optgroup>

                                                    </select>

                                                </div>
                                                </table>
                                            </div>
                                            
                                            
                                        </td>
                                    </tr>
                                    <td>&nbsp;</td>
                                    <tr>
                                        <td>
                                            <div id="departure-content">
                                                <div id="transport2" class="group" align="left">
                                                    <?php if ($transfer_out->type == 1) { ?>
                                                        <table width="100%"><tr>
                                                                <td>
                                                                    <div id="div_from2">
                                                                        <div class="label" style="font-size: 12px; color: #fff;">FROM</div>
                                                                        <select style="width:190px; color: #000; font-weight: bold;" name="from2" id="from2" class="select">
                                                                            <?php foreach ($data["area_park"] as $e) { ?>
                                                                                <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="div_to2">
                                                                        <div class="label" style="font-size: 12px; color: #fff; margin-left: -25px;">TO</div>
                                                                        <select style="width:190px; margin-left: -24px; color: #000; font-weight: bold;" name="to2" id="to2" class="select" onchange="change_to2();" >
                                                                            <option value="0"></option>
                                                                            <?php foreach ($data["to_areas"] as $e) { ?>
                                                                                <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == $reserve->tot2 ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="trip">

                                                                        <div class="label" style="font-size: 12px; color: #fff; margin-left: -21px;">TRIP</div>
                                                                        <table><tr><td>
                                                                                    <span><input class="field" name="d_trip_no" type="text" id="d_trip_no" style="width:45px; margin-left:-22px; height:24px; margin-top:-1px; color: #000; font-weight: bold; font-size: 16px; background-color: #fff; border: 2px solid dodgerblue;" size="3" maxlength="3" value="<?php echo $reserve->trip_no2; ?>"
                                                                                                 readonly="readonly"/>
                                                                                        <input type="hidden" name="deptime2"  id="deptime2" value="<?php echo $reserve->deptime2; ?>" />
                                                                                        <input type="hidden" name="arrtime2"  id="arrtime2" value="<?php echo $reserve->arrtime2; ?>" />
                                                                                        <input type="hidden" name="trip2a"  id="trip2a" value="0" />
                                                                                        <input type="hidden" name="trip2c"  id="trip2c" value="0" />
                                                                                    </span>
                                                                                </td>
<!--                                                                                <td onclick="mostrarTrip2();cargando();">
                                                                                    <a rel="superbox[ajax][<?php/* echo $data['rootUrl']; */?>admin/tours/trips/arrival][300x100]">
                                                                                        <a><i style="position:absolute; cursor:pointer; color: #fff; font-size: 23px; margin-left:-24px; margin-top:-46px;" id="popup2" class="fa fa-search-plus fa-2x"></i></a>

                                                                                    </a>
                                                                                </td>-->
                                                                                <td onclick="cargando();mostrarTrip2();comprobarScreen();"><a style="color: #fff; cursor:pointer; position: absolute; margin-top: -53px; margin-left: -29px;" id="popup2" ><img id="search2" style="" src ='<?php echo $data['rootUrl'] ?>global/img/search.png' width='25' height='25'></a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="100%" colspan="3">
                                                                    <div id="pick-drop">
                                                                        <div class="label" style="font-size: 12px; color: #fff;">DROP OFF POINT/ADDRESS</div>
                                                                        <div  style="width:100%" class="ausu-suggest">
                                                                            <input name="d_pickup1" style="width:439px;"  <?php
                                                                            if ($reserve->extension3 != 0) {
                                                                                
                                                                            }
                                                                            ?>  class="field" type="text" id="d_pickup1" autocomplete="off" maxlength="55" value="<?php echo $dropoff2->place . " " . $dropoff2->address; ?>"/>
                                                                            <input name="d_id_pickup1" type="hidden" id="d_id_pickup1" maxlength="55" value="<?php echo $dropoff2->id; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <table width="100%">
                                                                        <tr>
<!--                                                                            <td width="25%" style="font-size: 12px; color: #fff;">EXTENSION AREA: </td>-->
                                                                            
<!--                                                                            <td>-->
                                                                            <td width="25%">    
                                                                                <div>
                                                                                      <div style="color:#FFFFFF;" class="label">EXTENSION AREA:</div>
                                                                                </div> 
                                                                                <select name="ext_to2" id="ext_to2" class="select" style="width:321px; margin-top: 1px; height: 25px; color:#000; font-weight:bold;" onchange="change_ext_to2();">
                                                                                    <option value="0" ></option>
                                                                                    <?php
                                                                                    foreach ($extenciones04 as $ext) {
                                                                                        if ($reserve->extension3 == $ext['id']) {
                                                                                            $select = '  selected="selected" ';
                                                                                        } else {
                                                                                            $select = '';
                                                                                        }
                                                                                        echo "<option value='" . $ext['id'] . "'   " . $select . "  >" . $ext['place'] . "' '" . $ext['address'] . " </option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                             </td>    
                                                                                
<!--                                                                            </td>-->
                                                                            <td>&nbsp;</td>
                                                                            <td width="15%">
                                                                                <div id="rooms">
                                                                                    <div class="label" style="font-size: 12px; color: #fff; margin-left: 1px;">LUGGAGE</div>
                                                                                    <span><input name="d_luggage" type="text" id="d_luggage" size="2" maxlength="1" style="width: 57px; margin-left:2px; font-size: 14px; color: #000;" value="<?php echo $reserve->luggage2; ?>" class="field"/>
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                            <td width="15%">
                                                                                <div id="rooms">
                                                                                    <div class="label" style="font-size: 12px; color: #fff; margin-left: 5px;">ROOM #</div>
                                                                                    <span><input name="d_room1" type="text" id="d_room1" size="5" style="margin-left: 5px; width:45px; font-size: 14px; color: #000;" value="<?php echo $reserve->room2; ?>"  class="field"/></span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div style="width:100%" id="ex-pick-drop">
                                                                        <div class="label" style="font-size: 12px; color: #fff;">EXTENTION PICK UP POINT/ADDRESS</div>
                                                                        <div style="width:100%" class="ausu-suggest">
                                                                            <input name="a_pickup2" style="width:439px;" <?php
                                                                            if ($reserve->extension3 == 0) {
                                                                                echo ' disabled="disabled" ';
                                                                            }
                                                                            ?> class="field" type="text" id="d_pickup2" maxlength="55" value="<?php echo $reserve->pickup_exten3; ?>"/>
                                                                            <input name="a_id_pickup2" type="hidden" id="d_id_pickup2" maxlength="55" value=""/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else if ($transfer_out->type == 2) { ?>
                                                        <table width="381" border="0">
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td colspan="5" >&iquest;At what time you wish your private?</td>
                                                                <td width="29">
                                                                    <label>
                                                                        <!--<input autocomplete="off" name="hora2" type="text" id="hora2" value="<?php echo date('h:i A', strtotime($transfer_out->arrival_time)); ?>" size="6" class="required"/>-->
                                                                        <input  autocomplete="off" name="hora1" type="text" id="hora1"  size="6" class="required"  value="<?php echo date('h:iA', strtotime($transfer_in->arrival_time)); ?>" />
                                                                    </label>
                                                                </td>
                                                                <td width="29"></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7">&nbsp;</td>
                                                                <td colspan="4"><div align="center">&iquest;From where in Orlando?</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="12" height="7">&nbsp;</td>
                                                                <td width="53">&nbsp;</td>
                                                                <td width="58">City:</td>
                                                                <td width="113"><input autocomplete="off" name="city2" type="text" id="city2" size="25" class="required" value="<?php echo $transfer_out->city; ?>"  /></td>
                                                                <td width="114"></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="2">&nbsp;</td>
                                                                <td height="2">&nbsp;</td>
                                                                <td height="2">Address:</td>
                                                                <td height="2"><input autocomplete="off" name="address2" type="text" id="address2" size="25" class="required" value="<?php echo $transfer_out->address; ?>" /></td>
                                                                <td height="2"></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="3">&nbsp;</td>
                                                                <td height="3">&nbsp;</td>
                                                                <td height="3">Zip Code:</td>
                                                                <td height="3"><input autocomplete="off" name="zipcode2" type="text" id="zipcode2" size="25" class="required"  value="<?php echo $transfer_out->zipcode; ?>"  /></td>
                                                                <td height="3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7">&nbsp;</td>
                                                                <td height="7">&nbsp;</td>
                                                                <td height="7">Phone #:</td>
                                                                <td height="7"><input autocomplete="off" name="phone2" type="text" id="phone2" size="25" class="required"   value="<?php echo $transfer_out->phone; ?>" /></td>
                                                                <td height="7"></td>
                                                            </tr>
                                                        </table>
                                                        <script>
                                                            $("#hora2").timeEntry().change(function () {
                                                                /*var log = $("#log");
                                                                 log.val(log.val() + ($("#hora1").val() || "blank") + "\n");
                                                                     
                                                                 $("#hora2").val($("#hora1").val());*/
                                                            });
                                                            $("#city").keyup(function () {
                                                                $("#city2").val($("#city").val());
                                                            });
                                                            $("#address").keyup(function () {
                                                                $("#address2").val($("#address").val());
                                                            });
                                                            $("#zipcode").keyup(function () {
                                                                $("#zipcode2").val($("#zipcode").val());
                                                            });
                                                            $("#phone").keyup(function () {
                                                                $("#phone2").val($("#phone").val());
                                                            });
                                                            // $(function(){
                                                            //   $(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
                                                            // });
                                                        </script>
                                                    <?php } else if ($transfer_out->type == 3) { ?>
                                                        <table width="381" border="0">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td colspan="2">&nbsp;</td>
                                                                <td width="29"><label></label></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="16" colspan="3"><div align="center"></div></td>
                                                                <td rowspan="7">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7">&nbsp;</td>
                                                                <td><div align="left" style="color: #fff;">Airline:</div></td>
                                                                <td>
                                                                    <label>
                                                                        <input  autocomplete="off" type="text" name="airlinedeparture" id="airlinedeparture"  class="required" value="<?php echo $transfer_out->airlie; ?>" />
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7">&nbsp;</td>
                                                                <td><div align="left" style="color: #fff;">Flight #:</div></td>
                                                                <td>
                                                                    <input autocomplete="off" type="text" name="flightdeparture" id="flightdeparture"   value="<?php echo $transfer_out->flight; ?>"  class="required"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="55" height="7"><div align="left"></div></td>
                                                                <td width="104"><div align="left" style="color: #fff;">Departure Time:</div></td>
                                                                <td width="264">
                                                                    <input  autocomplete="off" name="hora2" type="text" id="hora2" size="6"   value="<?php echo $transfer_out->arrival_time; ?>"  class="required"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="2">&nbsp;</td>
                                                                <td height="2">&nbsp;</td>
                                                                <td height="2">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="3">&nbsp;</td>
                                                                <td height="3">&nbsp;</td>
                                                                <td height="3">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7">&nbsp;</td>
                                                                <td height="7">&nbsp;</td>
                                                                <td height="7">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                        <script>
                                                            $("#hora2").timeEntry().change(function () {
                                                                var log = $("#log");
                                                                log.val(log.val() + ($("#hora2").val() || "blank") + "\n");
                                                            });
                                                            //$(function(){
                                                            //  $(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
                                                            //});
                                                        </script>
                                                    <?php } else if ($transfer_out->type == 4) { ?>
                                                        <table width="381" border="0">
                                                            <tr>
                                                                <td colspan="3">&nbsp;</td>
                                                                <td width="36"><label></label></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="16" colspan="3"><div align="center"></div></td>
                                                                <td rowspan="6">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="65" height="7">&nbsp;</td>
                                                                <td width="308">
                                                                    <div align="left" style="color: #fff;">Remember the Hotel Check Out is at 11:00 am<input autocomplete="off" name="hora2" style="display:none" type="text" id="hora2" value="11:00 am" size="6" class="required"/></div>
                                                                </td>
                                                                <td><label></label></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7" colspan="2">&nbsp;</td>
                                                                <td width="43">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="2" colspan="2">&nbsp;</td>
                                                                <td height="2">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="3" colspan="2">&nbsp;</td>
                                                                <td height="3">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="7" colspan="2">&nbsp;</td>
                                                                <td height="7">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    <?php } ?>
                                                </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
        <!-- End Transfer-->
        <!-- Hoteles -->
        <br />
        <table width="100%">
            <tr>
                <td>
                    <div id="chk_hotels">
                        <fieldset id="hotelfieldset" style="border-radius: 5%;  box-shadow: 6px 7px 4px #999;" class="verde">
                            <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;">
                                <label for="opcion_hotel" style="cursor:pointer;">HOTELS</label><input type="checkbox" checked="checked" id="opcion_hotel" value="1" name="opcion_hotel"/>
                            </legend>
                            <div id="hotels">
                                <input type='hidden' id='nhoteles' name="nhoteles" value='<?php echo $data['nhoteles']; ?>' />
                                <table width="100%">
                                    <tr>
                                        <td id="tdRomm">
                                            <table width="100%">
                                                <tr>
                                                    <td width="15%"  valign="middle">
                                                        <table >
                                                            <tr>
                                                                <td>
                                                                    <div class="label"><strong style="font-size: 12px;"><i class="fa fa-bed fa-2x" style="margin-left: 10px; color: #AC1B29;"></i>ROOMS</strong></div>
                                                                </td>
                                                                <td>
                                                                    <div id="rooms-selection" style="">
                                                                        <select name="select_rooms" id="select_rooms" class="select" style="border: 1px solid #AC1B29;">

                                                                        </select>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td  style="width:630px;">
                                                        <div id="selectos" style="float:left;"></div>
                                                        <div id="t-total" style="width:170px;float: right;">
                                                            <div class="label">TOTAL PRICE PER PERSON</div>
                                                            <div class="price" id="amount_hotel"><?php //echo '$ '.number_format($hotel_reserve->total_paid,2,'.','.');                  ?></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <td colspan="2">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="7%">
                                                                <div class="label"><strong style="font-size: 12px;">HOTEL</strong></div>
                                                            </td>
                                                            <td width="25%" >
                                                                <div  style="width:100%; font-size: 10px;" class="ausu-suggest">
                                                                    <input  style="width:250px; font-size: 14px; margin-top: 8px; border: 1px solid #33449C; color:#33449C;" class="field" type="text" value="" id="hotel_name" autocomplete="off" onchange="addlist();"
                                                                    <?php
                                                                    if ($tours->id_hotel_reserve == -1) {
                                                                        echo ' disabled="disabled" ';
                                                                    }
                                                                    ?> >
                                                                    <input type="hidden" name="hotel_id" id="hotel_id" value="-1"/>
                                                                    <input type="hidden" name="hotel_cat" id="hotel_cat" value="-1"/>
                                                                    <input name="super_breakfast" id="super_breakfast" type="hidden" value="0"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <fieldset style="width: 254px;float: left; background: transparent; border: 1px solid #33449C; border-radius: 10px 10px 10px 10px;"><legend style="text-align:center; color: #000;">START DATE / END DATE</legend>
                                                                    <a href="" id="dataclick1_h" ><i class="fa fa-calendar fa-2x" style="box-shadow: 2px 5px 4px #999; font-size: 21px; color:#00E;"></i></a>
                                                                    <input name="fecha_salida_h" type="text"  id="fecha_salida_h" size="10" maxlength="15" style="border: 1px solid #33449C;" value="<?php echo date('m-d-Y', strtotime($tours->starting_date)); ?>" onchange="fechaRetorno_h(this.value);" autocomplete="off"  />
                                                                    <a href="" id="dataclick2_h" ><i class="fa fa-calendar fa-2x" style="box-shadow: 2px 5px 4px #999; font-size: 21px; color:#B83A36;"></i></a>
                                                                    <input name="fecha_retorno_h" type="text"  id="fecha_retorno_h" size="10" maxlength="15" style="border: 1px solid #33449C;" value="<?php echo date('m-d-Y', strtotime($tours->ending_date)); ?>"   autocomplete="off"   />
                                                                </fieldset>
                                                                <fieldset style="float: left; height:36px; background: transparent;border: 1px solid #33449C; border-radius: 10px 10px 10px 10px; margin-top: 1px;  margin-left: 2px;"><legend style="color: #000;">FREE DAYS</legend>
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td width="10%"><!--
                                                                                <div class="label"><strong>Nigths&nbsp;</strong></div>
                                                                            </td>-->
                                                                            <td width="5%">
                                                                                <span><input class="field" style="width:40px; display:none;" type="number"  min="0" value="0" id="nochesfree"/></span></td>                                                                          
                                                                            <td width="">&nbsp;</td>
                                                                            <!--                                                                            <div class="label">Adults&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Childs&nbsp;</div>-->
                                                                            <!--                                                                              <span><input class="field" style="width:40px; " type="number"  min="0" value="0" max="0" id="diasfree"/></span></td>    -->
                                                                        <input type="number" style="font-size:15px; margin-left:20px; margin-top:1px; width:29px; border: 1px solid #33449C;" name="frday" id="frday"  value="<?php echo $hotel_reserve['freeday']; ?>" max="8" min="0" autocomplete="off">
<!--                                                                        <input style="font-size:16px; display:none;" name="fdadult" id="fdadult" type="number" value="" max="8" min="0" autocomplete="off">-->
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input style="font-size:16px; margin-left:3px; margin-top:2px; width:35px; display: none; " name="free_buffet" id="free_buffet" type="number" value="0" max="8" min="0" autocomplete="off">

                                                                        <td width="30%">
                                                                            <div class="label"><strong><label style="cursor:pointer; display:none;" for="free_buffet">Free Buffet&nbsp;</label></strong></div>
                                                                        </td>
                                                                        <td width="5%">
    <!--                                                                        <span><input type="checkbox" <?php
                                                                            if (count($hotel_reserves) > 0) {
                                                                                if ($hotel_reserves[count($hotel_reserves) - 1]['freeday'] == 1) {
                                                                                    echo ' checked';
                                                                                }
                                                                            }
                                                                            ?> id="free_buffet" name="free_buffet" value="<?php
                                                                            if (count($hotel_reserves) > 0) {
                                                                                echo $hotel_reserves[count($hotel_reserves) - 1]['freeday'];
                                                                            }
                                                                            ?>"  /></span>-->
                                                                        </td>
                                                                        </tr>
                                                                    </table>
                                                                </fieldset>

                                                            </td>
                                                            <td align="center" valign="bottom">

                                                                <div id="add" style="vertical-align:bottom;">
                                                                    <input name="button" type="button" id="add_Hotel_list"  style="height:30px" value="Add to list" disabled="disabled" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </table>
                                        </td>
                                        <td rowspan="2">

                                        </td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <td colspan="2">
                                            <div id="table">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="80%">

                                                            <div id="tablehoteles">

                                                                <table class="grid2" cellspacing="0" cellpadding="0" id="table_7">
                                                                    <thead>
                                                                    <th width="25%">NAME</th>
                                                                    <th width="4%">PAX</th>
                                                                    <th width="">START DATE</th>
                                                                    <th width="">END DATE</th>
                                                                    <th width="4%">NIGHTS</th>                                                            
                                                                    <th width="4%">FREE&nbsp;DAYS</th>
                                                                    <th width="4%">SQL</th>
                                                                    <th width="4%">DBL</th>
                                                                    <th width="4%">TPL</th>
                                                                    <th width="4%">QUA</th>
                                                                    <th width="15%">BREAKFAST</th>
                                                                    <th width="%"></th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
//                                                            print_r($data['hotel_reserves']);
//                                                            
//                                                            exit;
                                                                        $i = 0;
                                                                        if ($last_index > 0) {
                                                                            foreach ($data['hotel_reserves'] as $hotel_reserve) {
                                                                                ?>
                                                                                <tr class="row0">
                                                                                    <td><?php echo $hotel_reserve["hotel_name"]; ?></td>
        <!--                                                                                    <td><? echo $hotel_reserve["sql"]; ?></td>-->
            <!--                                                                        <td><? echo $hotel_reserve['adult']+ $hotel_reserve['child']; ?></td>-->
                                                                                    <td><?php echo $hotel_reserve['total_persons']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['starting_date']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['ending_date']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['nights']; ?></td>                                                                       
                                                                                    <td><?php echo $hotel_reserve['freeday']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['sql_indicativo']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['dbl_indicativo']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['tpl_indicativo']; ?></td>
                                                                                    <td><?php echo $hotel_reserve['qua_indicativo']; ?></td>

                                                                                                <!--                                                                    <td><? echo ($hotel_reserve["room1_adult"] > 0?1:0); ?></td>
                                                                                                <td><? echo ($hotel_reserve["room2_adult"] > 0?1:0); ?></td>
                                                                                                <td><? echo ($hotel_reserve["room3_adult"] > 0?1:0); ?></td>
                                                                                                <td><? echo ($hotel_reserve["room4_adult"] > 0?1:0); ?></td>-->
                                                                                    <?php
                                                                                    if ($hotel_reserve['breakfastprice'] != 0 && $hotel_reserve["super_breakfast"] == 1) {
                                                                                        $breakfastdato = 'SUPER BREKFAST BUFFET';
                                                                                    } else {
                                                                                        if ($hotel_reserve["buffet"] == 1) {
                                                                                            $breakfastdato = "FREE BREAKFAST ";
                                                                                        } else {
                                                                                            $breakfastdato = "NOT BREAKFAST ";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <td id="breakfastdato" title="<?php
                                                                                    if ($tours->id_hotel_reserve != -1) {
                                                                                        echo '$ ' . number_format($hotel_reserve['breakfastprice'] / $hotel_reserve['nights'], 2, '.', '.');
                                                                                    } else {
                                                                                        echo 0;
                                                                                    }
                                                                                    ?>"><?php echo $breakfastdato; ?></td>
                                                                                    <td title="DELETE"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_hotel_<?php echo $hotel_reserve['id']; ?>" onclick='delete_hotel("<?php echo $hotel_reserve['id_hotel']; ?>");' /></td>
                                                                                </tr>
                                                                            <input type="hidden" name="hotel_id_select_<?php echo $i; ?>" id="hotel_id_select_<?php echo $i; ?>" value="<?php echo $hotel_reserve['id_hotel']; ?>"/>                                                                            
                                                                            <input type="hidden" name="hotel_breakfast_<?php echo $i; ?>" id="hotel_breakfast_<?php echo $i; ?>" value="<?php
                                                                            if ($tours->id_hotel_reserve != -1) {
                                                                                echo $data['hoteles'][$i]->breakfast;
                                                                            } else {
                                                                                echo 0;
                                                                            }
                                                                            ?>"/>
                                                                            <input type="hidden" name="hotel_buffet_<?php echo $i; ?>" id="hotel_buffet_<?php echo $i; ?>" value="<?php
                                                                            if ($hotel_reserve['breakfastprice'] == 0) {
                                                                                echo 0;
                                                                            } else {
                                                                                echo 1;
                                                                            }
                                                                            ?>"/>                                                                   
                                                                            <input type="hidden" name="hotel_nochesfree_<?php echo $i; ?>" id="hotel_nochesfree_<?php echo $i; ?>"  min="0" value="<?php echo trim($hotel_reserve['free_night']); ?>"/>                                                                     
                                                                            <input type="hidden" name="hotel_nochesfree_buffet_<?php echo $i; ?>" id="hotel_nochesfree_buffet_<?php echo $i; ?>"  value="<?php echo $hotel_reserve['free_night_buffet']; ?>" />                                                                   
        <!--                                                                            <input type="hidden" name="freeday_<?php echo $i; ?>" id="freeday_<?php echo $i; ?>"  value="<? echo $hotel_reserve['free_night_buffet']; ?>" style=" display:none; width: 4%;margin-left: 661px; margin-top: -55px;">                                                                    <input type="hidden" name="hotel_resort_<?php echo $i; ?>" id="hotel_resort_<?php echo $i; ?>" value=""/>-->
                                                                            <input type="hidden" name="hotel_category_<?php echo $i; ?>" id="hotel_category_<?php echo $i; ?>" value="<?php echo ($tours->id_hotel_reserve != -1) ? $data['hoteles'][0]->categoria : 0; ?>" />
                                                                            <input type="hidden" style="margin-top: -54px;" name="hotel_subtotal_<?php echo $i; ?>" id="hotel_subtotal_<?php echo $i; ?>" size="4" value="<?php echo ($tours->id_hotel_reserve != -1) ? $hotel_reserve['total_paid'] : 0; ?>" />
        <!--                                                                             <input type="hidden" style="font-size:15px; margin-left:20px; margin-top:-56px; width:29px; " name="frday" id="frday"  value="<? echo $hotel_reserve['freeday']; ?>" max="8" min="0" autocomplete="off">-->
                                                                            <?php
                                                                            $i += 1;
                                                                        }
                                                                        ?>
                                                                        <input type="hidden" name="hotel_id_select" id="hotel_id_select" value="1">
                                                                    <?php } ?>

                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
        <input type="hidden" style="margin-top: -54px;" name="hotel_subtotal1<?php echo $i; ?>" id="hotel_subtotal1<?php echo $i; ?>" size="4" value="<?php echo ($tours->id_hotel_reserve != -1) ? $hotel_reserve['total_paid'] : 0; ?>" />
        <input type="hidden" style="margin-top: -45px;" name="sqlhotel<?php echo $i; ?>" id="sqlhotel<?php echo $i; ?>" size="4" value="<?php echo ($tours->id_hotel_reserve != -1) ? $hotel_reserve['sql'] : 0; ?>" />
        <input type="hidden" style="margin-top: -45px;" name="dblhotel<?php echo $i; ?>" id="dblhotel<?php echo $i; ?>" size="4" value="<?php echo ($tours->id_hotel_reserve != -1) ? $hotel_reserve['dbl'] : 0; ?>" />
        <input type="hidden" style="margin-top: -45px;" name="tplhotel<?php echo $i; ?>" id="tplhotel<?php echo $i; ?>" size="4" value="<?php echo ($tours->id_hotel_reserve != -1) ? $hotel_reserve['tpl'] : 0; ?>" />
        <input type="hidden" style="margin-top: -45px;" name="quahotel<?php echo $i; ?>" id="quahotel<?php echo $i; ?>" size="4" value="<?php echo ($tours->id_hotel_reserve != -1) ? $hotel_reserve['qua'] : 0; ?>" />
        <!-- End Hoteles -->
        <br />        
        <!-- Parks Edit -->
        <fieldset style="display:none; border-radius: 5%;" class="brown">           


            <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;">
                <label for="opcion_parks_edit" style=" cursor:pointer; " >PARKS EDIT</label><input type="radio" id="opcion_parks_edit" checked="checked" name="opcion_parks_edit"/>                
            </legend>
            <div id="parks_edit">     


            </div>
            <input type="" id="totalparque" name="totalparque" value="<?php echo $totadparks; ?>">
        </fieldset>
        <br />        
        <!-- Parks -->
        <div id="traffic">
            <fieldset style="border-radius: 5%; margin-top:-15px;  box-shadow: 6px 7px 4px #999;" class="verdefosf">
                <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;">
                    <div id="chk_traffic">
                        <label for="opcion_traffic" style=" cursor:pointer; " >TRAFFIC TOURS  </label><input type="checkbox" id="opcion_traffic" checked="checked" <?php echo ($numpark > 0) ? 1 : 0; ?> name="opcion_traffic"/>
<!--                        <label for="opcion_traffic" style=" cursor:pointer; " >TRAFFIC TOURS  </label><input type="checkbox" id="opcion_traffic" checked="checked" <?php echo ($numpark > 0) ? 1 : 0; ?> name="opcion_traffic"/>-->
                    </div>
                </legend>
                <div id="attractions">
                    <table width="100%">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td valign="bottom">
                                            <div id="category-selection">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div class="label"><strong style="font-size: 12px;"> CATEGORY</strong></div>
                                                        </td>
                                                        <td valign="bottom">
                                                            <div class="label"><strong style="font-size: 12px;">SEARCH PARK</strong></div>

                                                        </td>
                                                        <td colspan="">
                                                            <label><strong style="font-size: 12px;">LENGTH OF TOUR</strong></label>
                                                        </td>
                                                    </tr>
                                                    <tr>                            <td valign="bottom">
                                                            <select style="height: 28px;" name="categoria_park" id="categoria_park" class="select" style="border: 1px solid #33449C;">
                                                                <option value="0"></option>
                                                                <?php
                                                                $grupos = $data['grupos'];
                                                                foreach ($grupos as $group) {
                                                                    echo '<option value="' . $group['id'] . '">' . $group['nombre'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td valign="bottom">
                                                            <div  style="width:100%; font-size: 12px;" class="ausu-suggest">
                                                                <input style="width:300px; font-size: 12px; border: 1px solid #33449C;" class="field" id="park_name" type="text" autocomplete="off" onchange="addpark();" />
                                                                <input type="hidden" name="id_park" id="id_park" value="34"/>
                                                                <input type="hidden" name="numPark" id="numPark" value="<?php echo $numpark; ?>"/>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <table class="fields2"><tr></tr>
                                                                <tr>
                                                                    <td>
                                                                        <span style="font-size: 12px;">
                                                                            Days:<br /> <input name="days2" id="days2" type="text" value="<?php echo $tours->length_day; ?>" readonly="readonly">
                                                                        </span>
                                                                    </td>
                                                                    <td><span style="font-size: 12px;">Nights:<br /> <input name="nights1" id="nights2" type="text" value="<?php echo $tours->length_nights; ?>" readonly="readonly">
                                                                        </span>
                                                                    </td></tr></table>
                                                        </td>
                                                        <td valign="bottom"><input type="button" id="add_attraction_list" style="height:30px" value="Add to list"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table width="100%">
                                                <tr>
                                                    <td width="80%">
                                                        <div id="tablePark">
                                                            <table class="grid2" cellspacing="0" cellpadding="0" id="table_7" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>NAME</th>
                                                                        <th>GROUP</th>
                                                                        <th>TICKET</th>
                                                                        <th>TRANSFER</th>
                                                                        <th>ADMISSION PER PARK</th>
                                                                        <th>TRANSPORT </th>
                                                                        <th>DELETE</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="row1">
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr class="row1">
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr class="row1">
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:170px;" valign="bottom">
                                <div id="info_html" style="font-size: 10px;color: rgb(44, 110, 45);"><?php echo $tours->mensaje_tiquetes; ?></div>
                                <div id="t-total">
                                    <div class="label">PRICE PER PERSON OF TRANSPORT LOCAL</div>
                                    <div id="park_transport" class="price">$ 0.00</div>
                                    <div class="label">PRICE PER PERSON OF TICKET </div>
                                    <div id="park_admision" class="price">$ 0.00</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

            </fieldset>
        </div>
        <br />
        <fieldset style="border-radius: 5%; height:408px;  box-shadow: 6px 7px 4px #999;" class="blue">
            <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;"><div id="chk_traffic">
                    <div class="label">COSTO SUMMARY</div></div></legend>

            <!--*************************************ACTUALIZACION********************************************************************************************-->

            <div id="t-total2" style="width:170px;">
                <input type="text" id="otheramount" name="otheramount" class="txtNumbers"    onkeyup="ClkPay_Amount();" value="<?php echo $tours->otheramount; ?>"  style="display:none; margin-left: 366px; margin-top: -42px; padding-left:5px; width:160px; height:25px;  border: 1px solid #000;" autocomplete="off"/>
                <input type="text" id="otheramountp" name="otheramountp"  value="0.00"  style="display:none; margin-left: 366px; margin-top: -62px; padding-left:5px; width:160px; height:25px;  border: 1px solid #000;" autocomplete="off"  />

            </div>


            <div id="opera" class="input" style="width: 85%;" >



                <table class="oliveti" style="width: 46%; border: 2px solid #000; margin-left: -8px; margin-top: -11px; height: 156px;">



                    <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius: 25px 0px 0px 0px; border: 2px #000 solid">Passenger Payment Information</caption>


                    <td>&nbsp;</td>

                    <tr  style=" height:13px; width:180px;">

                        <td style="width: 700px;">
                            <label  style=" float:right; font-size:16px; margin-top:-35px;"><strong   id="txtamountpendiente" style=" color:#F00">Amount to Collect&nbsp;$</strong></label>
                        </td>

                        <td>

                            <div id="div_actual" class="t-total3">

<!--                                    <samp id="saldoactual">$0.00</samp>-->
                                <input  type="text"  id="saldoactual" name="saldoactual" class="" class="price" value="" style="display:none; width:106px; height:25px; margin-right:6px; margin-top: -66px; text-align: right; border:1px #33F solid;  color:#000; font-family:arial; font-size: 22px; font-weight:bold;" onKeyUp="dupliac();" autocomplete="off" onkeypress="validate(event);" />

                                <input  type="text"  id="saldoporpagar" name="saldoporpagar" class="verd" class="price" value="" style="width:106px; height:25px; margin-right:6px; margin-top: -33px; text-align: right; border:1px #33F solid;  color:#000; font-family:arial; font-size: 22px; font-weight:bold;" onKeyUp="dupliac();ponDecimales(2);"  onkeypress="return soloNumeros(event);" autocomplete="off" />

                            </div>

                        </td>   

                    <br />

                    </tr>
                    <td>&nbsp;</td>

                    <tr style="width: 700px;" ><td>
                            <label  style=" float:right; font-size:16px;  margin-top:-46px; "><strong style=" color: #000;">Paid Driver&nbsp;$</strong></label>    </td>
                        <td>
                            <input type="text" id="paid_driver" name="paid_driver" class="brown3" readonly="readonly"  style="float:right; text-align: right; margin-right:6px; margin-top: -45px; height: 25px; font-size: 22px; font-weight: bold; color: #000; border: 1px #33F solid;  width:106px;" value="<?php echo number_format($tours->paid_driver, 2, '.', ''); ?>" onKeyUp="calcularTotalPago();"  autocomplete="off" />

                        </td>
                    </tr>

                    <tr style="width: 700px;" >
                        <td>
                            <label  style=" float:right; font-size:16px;  margin-top: -30px; "><strong style=" color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                        </td>

                        <td>
                            <input type="text" id="balance_due" name="balance_due" class="ama2"  class="txtNumbers"  style="float:right; border: 1px #33F solid; margin-top: -29px;  text-align: right; margin-right:6px; height: 25px; font-size: 22px; font-weight:bold; width:106px;"  value="<?php echo number_format($tours->passenger_balance_due, 2, '.', ''); ?>" onchange="ponDecimales(2);" readonly="readonly" autocomplete="off"  />
                            <input type="text" id="bal_duep" name="bal_duep" style="display:none; float:right; border: 1px #33F solid; margin-top: -29px;  text-align: right; margin-right:6px; height: 25px; font-size: 22px; width:106px;"  value="0.00"  autocomplete="off"  />
                        
                        </td>
                    </tr>                


                </table>



                <table class="oliveti" style="width: 46%; border: 2px solid #000; margin-left: -8px; margin-top: 9px; height: 166px; ">


                    <caption class="cerati" style="font-weight:bold; font-size:16px; color:#fff; border: 2px #000 solid">Agency Payment Information</caption>

                    <tr>
                        <td>
                            <b style="display:none; font-size: 18px; margin-left: 3px; ">Agency Request to Collect&nbsp;$</b>
                        </td>
                        <td>

                        </td>
                    </tr>

                    <tr style="width: 700px;">
                        <td>

                            <label  style=" float:right; padding-left: 102px; font-size:16px;  margin-top: -16px;"><strong style=" color:#000;">Total Net Fare&nbsp;$</strong></label>

                        </td>
                        <td>

                            <!--onKeyUp="dupliac();"-->
                            <div>
                                <input type="text"  class="orangered"   id="totalAmount" name="totalAmount" value="" readonly="readonly" style="float: right; width:106px; height: 25px; margin-right:6px; margin-top: -6px; text-align: right; font-weight:bold; color:#fff; border: 1px #33F solid; font-size:22px; padding-left:0px; font-weight:bold;" autocomplete="off" onkeypress="validate(event);"  />
                            </div>

                        </td>
                    </tr>

                    <tr style="width: 700px;">
                        <td>
                            <b style="float: right; color:#000;font-size: 16px; margin-top:-4px;">Amount Pre-Paid&nbsp;$</b>                                       
                        </td>


                        <td>                           
                            <input type="text"  name="pay_amount" id="pay_amount" class="azu" class="txtNumbers"  readonly="readonly" value="<?php echo number_format($tours->pred_paid_amount, 2, '.', ''); ?>"  onKeyUp="calcularTotalPago(); outcharge();" style=" text-align: right; margin-right:6px; margin-top: -5px; float:right; width: 106px; height:25px; font-size:22px; font-weight:bold; padding-left:0px; border: 1px #33F solid;" autocomplete="off"/>
                            <input type="text"  name="pay_amountp" id="pay_amountp"  class="txtNumbers"  value=""  style="display:none; text-align: right; margin-right:16px; margin-top: -5px; float:right; width: 106px; height:25px; font-size:22px; padding-left:0px; border: 1px #33F solid;" autocomplete="off"/>
                        </td>

                    </tr>

                    <tr style="height:33px; width: 700px;">
                        <td>
                            <b style="float: right;"><strong style=" color:#000;font-size: 16px; font-weight:bold; margin-top: -8px;">Total Amount Paid&nbsp;$</strong></b>                                         
                        </td>
                        <td>
                            <input type="text" id="tot_amount_paid" name="tot_amount_paid" readonly="readonly" autocomplete="off"  class="verdefos3"  class="txtNumbers"    value="<?php echo number_format($tours->total_paid, 2, '.', ''); ?>"  style="float:right;  border: 1px #33F solid;  margin-top:2px; margin-right:6px; text-align: right; height: 25px; font-size: 22px; font-weight:bold; width:106px;" />
                            <input type="text" id="tot_amount_paidp" name="tot_amount_paidp" style="display:none;" value="" />

                        </td>


                    </tr>  

                    <tr width: 700px;>
                        <td>
                            <b style="float: right; "><strong style=" color:#000;font-size: 16px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>                                         
                        </td>

                        <td>
                            <input type="text" id="agency_balance_due" name="agency_balance_due"    class="roge"  class="txtNumbers"   value=""  style="float:right; border: 1px #33F solid; margin-right:6px; margin-top:-1px; text-align: right; height: 25px; font-size: 22px; font-weight:bold; padding-left:0px; width:106px;" readonly="readonly" autocomplete="off" />
                        </td>
                        
                        <input type="text" id="pago_tarjeta" name="pago_tarjeta" title="Pago Tarjeta" value="0.00"  style="display:none; position:absolute;  border: 1px #FFF solid; margin-top: 67.2px;  margin-left: 57px; width: 68px; height:12px; text-align:right; font-size: 14px; padding-top:2px; background-color: transparent; color:#fff;"  autocomplete="off"  />
                        
                    </tr>  
                </table>

<!--margin-right:117px;-->

                <img class="ventana-imagen-class" style="position:absolute;  margin-left: -298px; margin-top:-378px; width: 181px; height: 179px; " src="<?php echo $data['rootUrl']; ?>global/img/admin/ventana.png" />


                <table class="oliveti" style="width: 30%; border: 2px solid #000; margin-left: 697px; margin-top: -376px; height: 156px; border-radius: 0px 0px 0px 0px;">

                    <caption class="olivo" style="border-radius: 0px 25px 0px 0px; font-weight:bold; font-size:16px; color:#fff; border: 2px #000 solid">Extra Charges & Discounts</caption>

                    <td>&nbsp;</td>       


                    <tr style="width: 700px;" >
                        <td>
                            <label  style=" float:right; font-size:16px; margin-top:-25px; "><strong style="padding-bottom:10px; color: #000;">Discount&nbsp;%</strong></label>
                        </td>

                        <td>

                            <input type="number" id="descuento" name="descuento"  class="descuentos" maxlength="3"  max="100" min="0"  value="<?php echo $tours->descuento_procentaje ?>"  autocomplete="off" style="text-align: right; color:#000; font-size: 22px;font-weight: bold; border: #33F solid thin; float:right; margin-top: -21px;  margin-right: 6px; height:25px; width:80px; " onkeypress="return descuentoporc(event);" onKeyUp="desporc();"  onchange="desporc();" />
                            <input type="number" name="descuentop" id="descuentop"   class="descuentos" maxlength="3" class="txtNumbers" value=""  autocomplete="off" style="display:none; text-align: right; color:#000; font-size: 22px;font-weight: bold; border: #33F solid thin; float:right; margin-top: -21px;  margin-right: 6px; height:25px; width:80px; " />

                        </td>
                    </tr>

                    <tr style="width: 700px;" >
                        <td>
                            <label  style="float:right; font-size:16px;  margin-top: -3px; "><strong style="padding-bottom:10px; color:#000;">Discount&nbsp;&nbsp;&nbsp;$</strong></label>

                        </td>

                        <td>

                            <input type="text" name="descuento_valor" id="descuento_valor"   class="descuentos" size="12" style="float:right; border: 1px #33F solid; margin-top: 7px;  margin-right: 6px;  text-align: right; color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="<?php echo $tours->descuento_valor; ?>" autocomplete="off" onkeypress="return solodescuento(event);" onkeyup="desval(); ponDecimales(2);"  />
                            <input type="text" name="descuento_valorp" id="descuento_valorp"   class="descuentos" size="12" style="display:none; float:right; border: 1px #33F solid; margin-top: 7px;  margin-right: 6px;  text-align: right; color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="" autocomplete="off" />
                        </td>
                    </tr>

                    <td>&nbsp;</td>


                    <tr  style="width: 700px;">

                        <td style="width: 700px;">
                            <label  style="float:right;  font-size:16px;  margin-top: -29px;"><strong style="padding-bottom:10px; color: #000;">Extra Charges&nbsp;$</strong></label>
                        </td>

                        <td>
                            <input type="text" id="extra" name="extra"  class="extracargos" size="12" style="float:right;  text-align: right; color:#000; margin-top: -21px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;"   value="<?php echo $tours->extra_charge; ?>"  onkeypress="return soloextra(event);" onkeyup="resetextra();  ponDecimales(2);" autocomplete="off" />
                            <input type="text" name="extrap" id="extrap"   size="12" style="display:none; float:right;  text-align: right; color:#000; margin-top: -21px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px;"   value="" />
                            <br />
                        </td>
                    </tr>

                </table>
<!--margin-right: 118px;-->
                <input  type="button" id="pay_driver" name="pay_driver" title="Add Payment" class="button_sliding_bg" class="" onclick="mostrarVentana2();" style="position:absolute; border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px;  margin-left: -441px; margin-top: -89px; height: 30px; cursor:pointer; color: #fff; font-weight: 700; width: 138px;  padding: 6px; padding-left: 6px; padding-top: 5px;" value="Add Payment"/>

            </div>


            <div id="">
                <input  type="button" id="btn-save2" title="Save" class="oliverty"  class="link-button"  value="SAVE"/>            
            </div>

            <div>
                <a  id="pago_agente" style="display:none;" ><img style="margin-top: 81px; margin-left: 380px; width: 67px; height: 28px; cursor:pointer;" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
            </div>
            <a  id="pago_agente1" style="margin-right: 2px;"><img style="margin-top:81px; margin-left:380px; width:0px; height:28px; " src="<?php echo $data['rootUrl']; ?>global/img/admin/chargedisabled.png" /></a>

            <!--            <div>-->

            <div>

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

            </div>    

            <div>
                <select name="opcion_pago" id="op_pago_id" style="display:none; margin-left:379px; margin-top:-105px; width:141px;">
                    <optgroup label="COLLECT ON BOARD">
                        <option value="8">Credit Card no fee</option>
                        <option value="3">Credit Card with fee</option>
                        <option value="4">Cash</option>
                        <option value="9">Check</option>
                    </optgroup>
                    <optgroup label="VOUCHER">
                        <option value="5">Credit Voucher</option>
                    </optgroup>
                    <optgroup disabled= "disabled" label="COMPLEMENTARY">
                        <option value="7">Complementary</option>
                    </optgroup>
                </select>

            </div>  
            
            <div>
                <select name="op_pago_conductor" id="op_pago_conductor" style="margin-left:378px; margin-top:-163px; width:142px;" onclick="valida_voucher();" onchange="captura(); passenger_balance();">
                    <optgroup label="COLLECT ON BOARD">
                        <option value="8">Credit Card no fee</option>
                        <option value="3">Credit Card with fee</option>
                        <option value="4">Cash</option>
                        <option value="9">Check</option>
                    </optgroup>
                    <optgroup label="VOUCHER">
                        <option value="5">Credit Voucher</option>
                    </optgroup>
                    <optgroup disabled= "disabled" label="COMPLEMENTARY">
                        <option value="7">Complementary</option>
                    </optgroup>
                </select>

            </div>  

            <!--PREPAGO-------------------------------------------->
            <div>
                <select name="opcion_pago_2" id="opcion_pago_2" style="display:none; margin-left:379px; margin-top:-34px; width:141px;">
                    <optgroup label="PRED-PAID">
                        <option value="2">Credit Card no fee</option>
                        <option value="1">Credit Card with fee</option>
                        <option value="6">Cash</option>
                        <option value="10">Check</option>
                    </optgroup>

                </select>

            </div> 


            <div>
                <select name="opcion_pago_3"  id="opcion_pago_3" style="display:none; margin-left:379px; margin-top: -189px;">
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

            </div>






            <div style="margin-left:523px; margin-top:-116px;">
                <ul class="tabs" style=" width:98%;">

                    <li style=""><a href="#tab1">Saved Notes</a></li>
                    <li><a style="background-color:#006358;"  href="#tab2">Add Notes</a></li>

                </ul>

                <div class="tab_container" style="height:155px; width: 424px;">
                    <div id="tab1" class="tab_content">
                        <!--Contenido del bloque  onclick="foco_comments();"-->

                        <textarea id="comments2" name="comments2" cols="0" rows="0"  readonly="readonly" style=" width: 411px; height: 143px; margin-left:-16px; margin-top:-17px; "><?php echo $tours->comments2; ?></textarea>

                    </div>
                    <div id="tab2"  class="tab_content">
                        <!--Contenido del bloque onclick="foco_comments();"-->
                        <textarea id="comments" name="comments" cols="0" rows="0" style="width: 411px; height: 142px; margin-left:-16px; margin-top:-17px;"></textarea>
                    </div>
                </div>

            </div>

            <input type="text" id="saldoPagado2"  style=" display:none; font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:23px; margin-left: -32px; width: 83px;" value="" />

            <input type="text" name="opc_ap"  id="opc_ap" size="12" style="display:none;" value="0" />
            <input type="text" name="PAP" id="PAP" size="12" style="display:none;" value="0.00" />
            <input type="text" name="PAP2" id="PAP2" size="12" style="display:none;" value="0.00" />         
            <input type="text" name="etb" id="etb" size="12" style="display:none;" value="0.00" />
            <input type="text" name="paid_drivert" id="paid_drivert" size="12" style="display:none;" value="<?php echo number_format($tours->paid_driver, 2, '.', ''); ?>" />
            <input type="text" name="pred_paid_amountt" id="pred_paid_amountt" size="12" style="display:none;" value="<?php echo number_format($tours->pred_paid_amount, 2, '.', ''); ?>" />

            <input type="text" name="tot_charge" id="tot_charge" size="12" style="display:none;" value="<?php echo number_format($tours->total_charge, 2, '.', ''); ?>" />
            <!--paid driver edition-->
            <input type="text" name="p_d_e" id="p_d_e" size="12" style="display:none;" value="<?php echo $tours->paid_driver ?>" />
            <!--pay amount edition-->
            <input type="text" name="p_a_e" id="p_a_e" size="12" style="display:none;" value="<?php echo $tours->pred_paid_amount ?>" />
            
            <input type="text" name="totalbalance" id="totalbalance" size="12" style="display:none;" value="0.00" />


            <table width="100%" style="position:absolute; background-color: transparent; margin-top: -187px;; margin-left:523px; height:179px; width:181px;">
             
            <tr>
                <td style="margin-left:1px; margin-top:0px;">
                    
            <div id="miVentana2" style=" width: 174px; height: 168px;  top:1113px; left: 842px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

                <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 3px; background-color:#006394">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

<!--    <label  style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color: #000; margin-left:-55px;">$</strong></label> -->
                <p>
                    <label  id="tap" style="padding-left:57px; font-size:10px; "><strong style="padding-bottom:10px; color:#090; margin-left:-50px;">Total Amount Paid $</strong></label> 
                    <input type="text" id="saldoPagado"  readonly="readonly" style="text-align: right; font-family: sans-serif; font-size: 10px; color:#090; font-weight: bold; padding-left:4px; margin-left: 126px; margin-top: -16px; width: 38px;" value="<?php echo number_format($tours->total_paid, 2, '.', ''); ?>"  />
                </p>

                <label  id="dolares" style="padding-left:39px; font-size:16px; "><strong style="padding-bottom:10px; color:#006394; ">$</strong></label> 

                <!--class="money"-->
                <input type="text" name="pago_driver" id="pago_driver" size="12" style="font-size: 22px; font-weight:bold; text-align:right; margin-top:-21px; margin-left:54px; width:114px; height:20px;" value="0.00" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago(); " autocomplete="off"/>

                <input type="text" name="pago_driver2" id="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

                
                
                <input type="text" name="collect"  id="collect" title="" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($tours->paid_driver, 2, '.', ''); ?>" />

                <input type="text" name="prepaid"  id="prepaid" title="Amount Paid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($tours->pred_paid_amount, 2, '.', ''); ?>" />


<!--    <input name="someTextBox" type="text" id="someTextBox" size="12" style="display:none; margin-top:9px; margin-left:27px; width:114px; height:20px;" value="0.00" />-->


                <select name="opcion_pago1" id="op_pago_id1" style="margin-left:8px; margin-top: 8px;" disabled= "disabled" onclick="calculos();">
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
                
<!--                <div class="paymentvertblack" style="padding: 11px;  text-align: center; margin-top: 12px;">

                    <input type="button" id="btnExit" name="btnExit" size="20"   onclick="Exit();" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:1px; width:43px; font-weight: 700;" value="Exit" />
                    <input type="button" id="btnCancelar" name="btnCancelar" size="20"  style="background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; font-weight: 700;" value="Reset" onclick="Reseteo(); Resetal();" />
                    <input type="button" id="btnAceptar" name="btnAceptar" size="20" value="Save"  style="border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; font-weight: 700;" onclick="ocultarVentana2();"  />
                    
                </div>-->

                <div class="paymentvertblack" style="padding: 5px;  text-align: center; margin-top: 10px; height: 31px;">

                        <div>
                            <input type="button" id="btnExit" name="btnExit" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" onclick="Exit();"  />
                        </div>

                        <div>
                            <input type="button" id="btnCancelar" name="btnCancelar" style=" background-color: grey; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px; height:24px;"  size="20"  value="CANCEL" onclick="reseteo(); resetal();" disabled="true" />
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

                        <input type="button" id="enviar_escondido" value="0" style="display:none;" />

                </div>

<!--                <input type="button" id="logor" name="logor" onclick="passenger_balance();"/>-->

                <input type="button" id="btnBD" name="btnBD" size="20" value="Balance_Due"  style="display:none; cursor:pointer; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="bal_due();"  />

                <input type="button" id="btnABD" name="btnABD" size="20" value="Agency_Balance_Due"  style="display:none; cursor:pointer; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="agen_bal_due();"  />

                <input type="button" id="btn_Other" name="btn_Other" size="10" value="Amount to Collect $"  style="display:none; cursor:pointer; margin-left:130px; margin-top:-396px; font-weight: bold; font-size: 16px; width: 163px; height: 27px;  border-color: red; " onclick="calc_other();"  />


            </div> 
                    
                </td>
            
            </tr>
                
            </table>
            
            <div style="display:none;" id="result"></div>
            <input type="text" name="selectcond" id="selectcond" value="" style="display:none; position:absolute; margin-left:0px; margin-top:0px;" />


            <!--****************************************************************TABLA***********************************************************************************************************************-->        
            <table style="margin-top:450px;"><tr>
                    <td width="60%" >
                        <div id="opera" class="input" style="padding-top:0px; width:450px;">
                            <table width="100%" id="tr_complementary" style="display:none;">
                                <tr>
                                    <td width="2%">
                                        <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio"   <?php echo ($tipo_pago == strtoupper('Complementary')) ? ' checked ' : ''; ?>    >
                                    </td>
                                    <td width="20%"><label for="opcion_pago_complementary">Complementary</label></td>
                                </tr>
                            </table>
                            <table width="100%" height="125" id="tableorder" style="display:none;">
                                <tr>
                                    <td  colspan="3" width="34%" height="20" align="center"  >
                                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                        <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                            <tr>
                                                <td colspan="6"   height="20" id="titlett" align="center"  >
                                                    <strong>PAYMENT OPTION </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo1" value="1" checked="checked" type="radio"></td>
                                                <td width="20%">Paid Full</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                                                <td width="20%">Paid Balance</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr><td colspan="6"><hr /></td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  height="34%" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
                                    <td  width="32%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table width="100%">
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>

<!--                                <tr id="tipo_passager" style="width:180px;" >
        <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio"  <?php echo ($tipo_pago == strtoupper('Passenger Credit Card') || $tipo_pago == strtoupper('Credit Card')) ? ' checked ' : ''; ?>  ></td>
        <td nowrap="nowrap" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
    </tr>
    <tr id="tipo_agency" style="" >
        <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"   <?php echo ($tipo_pago == strtoupper('Agency Credit Card')) ? ' checked ' : ''; ?>   ></td>
        <td nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
    </tr>

<tr id="tipo_predpaid_cash" style="height:20px; position:static;">
    <td><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio"   <?php echo ($tipo_pago == strtoupper('Cash in terminal')) ? ' checked ' : ''; ?>   ></td>
    <td><label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash in terminal </label></td>
</tr>-->


                                            <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" class="opcion_pago" <?php echo ($tipo_pago == strtoupper('Passenger Credit Card') || $tipo_pago == strtoupper('Credit Card')) ? ' checked ' : ''; ?>></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio" class="opcion_pago" <?php echo ($tipo_pago == strtoupper('Agency Credit Card')) ? ' checked ' : ''; ?>></td>
                                                <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_passager_3" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" class="opcion_pago" <?php echo ($tipo_pago == strtoupper('Cash in terminal')) ? ' checked ' : ''; ?>></td>
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
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                <!--                            <tr id="tipo_CrediFee">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio"   <?php echo ($tipo_pago == strtoupper('Credit Card+ 4 % FEE')) ? ' checked ' : ''; ?> ></td>
                                                <td align="left" nowrap="nowrap" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago"  >Credit Card+ 3 % FEE</label></td>
                                            </tr>
                                            <tr id="tipo_Cash">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio"  <?php echo ($tipo_pago == strtoupper('Cash')) ? ' checked ' : ''; ?> ></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
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
                                        <?php if ($agency_account['opcion5'] != 0) { ?>
                                            <div id="tipo_Voucher" style=" position:static">
                                                <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio" <?php echo ($tipo_pago == strtoupper('Credit Voucher')) ? ' checked ' : ''; ?>  ><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <table style="display:none;" >
                                            <tr>
                                                <td valign="" >
                                                    <div id="t-total2">
                                                        <div class="label" style="text-align:left;  font-size: 14px;"><strong>TOTAL AMOUNT </strong>  </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:168px;">
                                                        <input type="hidden" name="id_tours" id="id_tours" value="<?php echo $tours->id; ?>" />

                                                        <!--                                                        <div class="price">
                                                                                                                    <samp  id="totalAmount">$ 0.00</samp>
                                                                                                                </div>-->
                                                    </div>
                                                </td>
                                                <td>
                                                    <!--<label style="text-align:left;"><strong> Disc %</strong></label>                           
                                                    <input name="descuento" type="number" id="descuento" maxlength="3" onchange="valorDescuentoPorec();" max="100" min="0"  value="<?php echo $tours->descuento_procentaje; ?>"  style="height:16px; width:100px;" />-->

                                                    <label style="margin-left:12px; text-align:left; color: black; "><strong> Disc %</strong></label>                           
<!--                                                    <input name="descuento" type="number" id="descuento" maxlength="3" onchange="valorDescuentoPorec();" max="100" min="0"  value=""  style="height:16px; width:100px; margin-left:8px; margin-top:-18px;" />-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label style="font-weight:bold;text-align:left; color: #000">Extra Charges</label></td>
                                                <td colspan="0">
<!--                                                    <input name="extra" type="text" id="extra" size="12" style="margin-right:5px; text-align:left; color: #000; padding-left:-14px; width:166px; height:16px; font-size: 16px;
                                                           font-weight: 600;" min="0" onkeyup="valorExtra();"  value="<?php echo $tours->extra_charge ?>" autocomplete="off" />-->
                                                </td>
                                                <td>
                                                    <label style="margin-left:12px; text-align:left; color: #000;"><strong> Disc &nbsp;$</strong></label>                            
<!--                                                    <input name="descuento_valor" type="number" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="color: #000;height:16px; width:100px; margin-left:10px; margin-top:-18px;" onchange="valorDescuentoValor();"  value="<?php echo $tours->descuento_valor; ?>"  />                            
-->

                                                </td>
                                            </tr>
                                            <tr >
                                                <!--<td valign="" >
                                                    <div style="display:none" id="div_tex_comision">
                                                        <div class="label">Comision</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div   id="div_val_comision" style="display:none; width:170px;">
                                                        <samp  id="valorComision">$ 0.00</samp>
                                                    </div>
                                                </td>-->
                                            </tr>
                                            <tr>
                                                <td valign="" >
                                                    <label style="font-weight:bold;text-align:left; color: #000;">Amount to Collect</label>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:166px;">
<!--                                                        <input autocomplete="off" type="text"  name="otheramount" id="otheramount" value="<?php /*echo $tours->otheramount_sin_tax */?>"
                                                               style="color: #000; text-align:left; padding-left:-1px; font-size: 16px; font-weight: 600; width:166px; height:16px;" />-->
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <div id="t-total2">
                                                        <!--<div class="label" style="width:150px;color:#F00;" ><strong><label class="label"  id="txtSaldoPorPagar" style="font-weight:bold;  text-align:left; ">TOTAL AMOUNT</label></strong></div>-->
                                                        <div class="label" style="margin-top: -8px; width:150px;color:#000;" ><strong><label class="label"  id="txtSaldoPorPagar" style="font-weight:bold;  text-align:left; color:#000">TOTAL AMOUNT</label></strong></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="div_pagado" class="t-total3" style="width:172px;">
                                                        <div class="price" style="width:166px;">
<!--                                                            <samp  id="saldoporpagar">$ 0.00</samp>-->
                                                        </div>
                                                    </div>
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label  style=" font-weight:bold;color:#00F; text-align:left;margin-top: -17px;">Total Amount Paid</label>
                                                </td>
                                                <td>
                                                    <div id="t-total" style="width:168px;">
                                                        <div class="price" style="margin-top: -13px;margin-left: -1px; border: 1px #33F solid;background-color: #DCE6F2;color: #0368CC; border-radius: 0px;">
                                                            <samp  id="pagado">$  <?php echo number_format(($pagado), 2, '.', ','); ?></samp>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #DCE6F2;">
                                                <td>
                                                    <div id="t-total3">
                                                        <!--<div class="label" style="width:150px; color:#00F;"><strong><label class="label" id="txtSaldoDiff" style="font-weight:bold;  text-align:left; ">Amount to Collect</label></strong></div>-->
                                                        <div class="label" style="width:150px; color:#00F;"><strong><label class="label" id="txtSaldoDiff" style="font-weight:bold;  text-align:left; color:#666666;">Amount to Collect</label></strong></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!--                                                    <div id="div_actual" class="t-total3">
                                                                                                            <div class="price" style="border:1px #33F solid; background-color:#00f; color:#fff;">
                                                                                                                <samp id="saldoactual">$0.00</samp>
                                                                                                            </div>
                                                                                                        </div>-->
                                                </td>
                                                <td>
<!--                                                    <select name="opcion_pago" id="op_pago_id" style="margin-left:10px;">
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
                                                    </select>-->
                                                </td>
                                            </tr>
                                            <tr id="pay_amount_html">
                                                <td valign="" >                                
<!--                                                    <a  id="pago_agente" style="display:block;float: left;" ><img style="width: 59px;    margin-top: 14px;cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" />

                                                    </a>-->
                                                    <label style="text-align:left;  color:#fff;  position: absolute;   margin-top: 14px;    margin-left: 68px;">Pay a Amount</label>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:170px;">
<!--                                                        <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="margin-right:3px; padding-left:5px; width:163px; height:20px;" />-->
                                                    </div>
                                                </td>
                                                <td>
<!--                                                    <select name="opcion_pago_2" style="margin-left:10px;">
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

                                                    </select>-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                 <!--<a style="cursor:pointer" id="btn-save2"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>-->
<!--                                                    <a style="margin-top: 0px; margin-right: -42px; cursor:pointer" title="Save" id="btn-save2"><i class="fa fa-floppy-o fa-4x" style="color: #AC1B29;"></i></a>-->
                                                </td>
                                                <td align="right">

<!--                                                    <a href="<?php echo $data['rootUrl'] ?>admin/home" title="Exit" style="margin-top: 16px; margin-right: 4px; cursor:pointer" id="btn-exit"><i class="fa fa-external-link-square fa-4x" style="color:#AC1B29;"></i></a>  -->

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="bottom">
                                        <table width="100%">
                                            <tr>

                                            </tr>
                                            <tr>

                                            <tr>
                                                <td>
                                                    <div id="opera" class="enviarForm" style="padding-top:5px; cursor:pointer;" align="left">
                                                        <a id="enviarF" style="display:none; cursor:pointer" ><img src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                                        <input type="button" style="display:none" id="enviar_escondido" value="0"  />
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>

                    <td width="5%">&nbsp;</td>
                    <td style="width:300px;" align="left">
<!--                        <div id="" class="input"><div style="width:275px;"><label style="width:150px; margin-top: -55px; margin-left:369px; color:#000;"  ><strong>NOTES</strong></label></div><textarea id="comments" name="comments" cols="0" rows="0"  style="width: 406px; height: 250px; margin-top: -36px;"><? $tours->comments; ?></textarea></div>-->

<!--                        <textarea id="comments" name="comments" cols="0" rows="0" placeholder="Notes"  style="width: 339px; height: 100px; margin-top:0px;"></textarea>
                        <textarea id="comments2" name="comments2" cols="0" rows="0"  disabled="disabled" style="width: 339px; height: 226px; margin-top:6px;"><?php echo $tours->comments2; ?></textarea>-->

                    </td>
                </tr>
                <tr>
                    <td style="width:300px;" align="" valign="bottom" colspan="2">

                    </td>
                    <td width="5%">&nbsp;</td>
                    <td>
                        <div id="estadoTranssacion">

                        </div>
                    </td>
                </tr>
            </table>

            <div id="priceTransporA1" style="display:none"><?php echo (isset($valores['priceTransporA1'])) ? $valores['priceTransporA1'] : 0 ?></div>
            <div id="priceTransporC1" style="display:none"><?php echo (isset($valores['priceTransporC1'])) ? $valores['priceTransporC1'] : 0 ?></div>
            <div id="comisionTranspor1" style="display:none"><?php echo (isset($valores['comisionTranspor1'])) ? $valores['comisionTranspor1'] : 0 ?></div>
            <div id="priceTransporA2" style="display:none"><?php echo (isset($valores['priceTransporA2'])) ? $valores['priceTransporA2'] : 0 ?></div>
            <div id="priceTransporC2" style="display:none"><?php echo (isset($valores['priceTransporC2'])) ? $valores['priceTransporC2'] : 0 ?></div>
            <div id="comisionTranspor2" style="display:none"><?php echo (isset($valores['comisionTranspor2'])) ? $valores['comisionTranspor2'] : 0 ?></div>
            <div id="priceExt_from1" style="display:none"><?php echo (isset($valores['priceExt_from1'])) ? $valores['priceExt_from1'] : 0 ?></div>
            <div id="priceExt_to2" style="display:none"><?php echo (isset($valores['priceExt_to2'])) ? $valores['priceExt_to2'] : 0 ?></div>
            <div id="totalpriceNights" style="display:none"><?php echo (isset($valores['totalpriceNights'])) ? $valores['totalpriceNights'] : 0 ?></div>
            <div id="totalpriceBreakfast" style="display:none"><?php echo (isset($valores['totalpriceBreakfast'])) ? $valores['totalpriceBreakfast'] : 0 ?></div>
            <div id="totalpriceAdmision" style="display:none"><?php echo (isset($valores['totalpriceAdmision'])) ? $valores['totalpriceAdmision'] : 0 ?></div>
            <div id="totalpriceTransporLocal" style="display:none"><?php echo (isset($valores['totalpriceTransporLocal'])) ? $valores['totalpriceTransporLocal'] : 0 ?></div>
            <input type="hidden" value="<?php echo $tours->id ?>" id="slugfield" name="slugfield" />
            <input type="hidden" value="<?php echo $tours->length_nights; ?>" id="initial_nights" name="initial_nights">
            <input type="hidden" value="<?php echo $data['toutwcharge'] ?>" id="toutwcharge" name="toutwcharge" />
            <input type="hidden" value="<?php echo $data['last_indexh'] ?>" id="lastindex_hotel" />
            <input type="hidden" value="<?php echo $data['hotel_redis'] ?>" id="hotel_redis" name="hotel_redis" />
        </fieldset>
        
        <main>
            <!--  <h2>Editar Multiday Toursa</h2>-->
            <input type="radio" id="mostrar-modal" name="modal" onclick="pregunta(event);"/>
            <label class="flotante" id="flotador" style="display:none; margin-left:-384px; color:#fff;"  for="mostrar-modal">Editar</label>
            <!--  <input type="radio" id="cerrar-modal" name="modal"/>
            <label class="" style="margin-left:-43.3%; margin-top:-13.80%; color:#fff;" for="cerrar-modal">CERRAR</label>-->
            <div id="modal">
            <!--    <p> </p>-->
            </div>
    </main>
        <input type="text" name="temp"  id="temp" title="Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($tours->total_charge, 2, '.', ''); ?>" />

<!--        <input type="text" name="tempwf"  id="tempwf" title="temp W/Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo $cargos; ?>" />-->
                
        
        <input type="text" id="temp_driver"  name="temp_driver" title="Temp Driver" size="12" style="display:none; margin-top:4px; margin-left:-230px; width:114px; height:20px;" value="<?php echo $cargoscob; ?>" />
        <input type="text" id="temp_prepaid"  name="temp_prepaid" title="Temp Prepaid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo $cargospp; ?>" />
        
        <br>
        </br>
            
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
    
    
    </form>
    
        <input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:85px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="tipo_reserva" id="tipo_reserva"  size="10" maxlength="10"  value="Editado" autocomplete="off"/><br>
        <input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="total_pasajeros" id="total_pasajeros"  size="10" maxlength="10"  value="<?php echo $total_pasajeros ?>" autocomplete="off"/>
<!--        <input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="trip_1" id="trip_1"  size="10" maxlength="10"  value="<?php /*echo $trip_no */?>" autocomplete="off"/>
        <input type="text" style="display:none; margin-left: 0px; margin-top: 0px; width:30px; color: #0B55C4; font-weight: bold; font-size: 10px; text-align: center;" name="trip_2" id="trip_2"  size="10" maxlength="10"  value="<?php /*echo $trip_no2*/ ?>" autocomplete="off"/>-->

    
    
    
        <div class="" id="save2" style="position:fixed; overflow: visible; z-index: 3000; margin-left: 395px; margin-top: -1500px; font-weight: bold; font-size: 39px; display:none;">                
    
<!--        <i class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: #CE4233;"></i>-->
        <a style="margin-left: 24px; margin-top: -159px; position: absolute;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/eclipse.gif' width="150px" height="150px" margin-left="85px" margin-top="-127px">
        <a style="margin-left: 61px; margin-top: -118px; position: absolute;" ><img src ='<?php echo $data['rootUrl'] ?>global/img/loading_trips.gif' width="75px" height="75px" margin-left="85px" margin-top="-127px">
        

        <div class="cssload-loader" style="position:absolute; color:#4682B4; text-align:center; margin-left: 6px; margin-top: 72px; font-size: 28px;">Loading</div>

        </div>  
        
        



        <script type="text/javascript">
            
            function cargando()
            {
                //document.getElementById('save2').style.display = "";
                
                var from = $("#from").val();
                var to2 = $("#to2").val();                      
                
                
                if (from == "0" && to2 == "0") {
                    document.getElementById("save2").style.display = "none";                              
                }
                
                if (from > "0" && to2 == "0") {
                    document.getElementById("save2").style.display = "";                              
                }
                
                
                
                if (to2 > "0" && from == "0") {
                    document.getElementById("save2").style.display = "";                              
                }  
                
                if (to2 > "0" && from > "0") {
                    document.getElementById("save2").style.display = '';                              
                }  
                

            }
            
        </script>
    
     
    <div id="userr"></div>
    <div id="puestosEnUso"></div>
    
    <div id="buffet" title="This hotel does not include breakfast" style="height:200px; display:none">
        <table width="100%" border="0" cellspacing="1"><tr><td width="22%"><img src="<?php echo Doo::conf()->APP_URL; ?>global/images/desayunob.jpg" width="150px;" heigth="50px;"/></td><td colspan="2">&nbsp;</td><td width="76%">Do you want to include SUPER BREAKFAST BUFFET in your Hotel?
                    <label></label>
                    <label><br />
                        <input type="radio" name="buffet" id="buffetYes" <?php
                        if ($tours->id_hotel_reserve != -1 && $hotel_reserve['breakfastprice'] != 0) {
                            echo ' checked="checked" ';
                        }
                        ?>   class="buff" value="1" /><label for="buffetYes">YES</label></label>

                    <input type="radio" name="buffet" class="buff" id="buffetNo" value="0" /><label for="buffetNo">NO</label>
                </td></tr>
        </table>
    </div>

    <div id="buffet2" title="This hotel does not include breakfast" style="height:200px; display:none"><table width="100%" border="0" cellspacing="1"><tr><td width="22%"><img src="<?php echo Doo::conf()->APP_URL; ?>global/images/desayunob.jpg" width="150px;" heigth="50px;"/></td><td colspan="2">&nbsp;</td><td width="76%">Do you want to include SUPER BREAKFAST BUFFET in your Hotel?
                </td></tr></table></div>

    <div  id="dialog_message4" style="display:none" title="Number of parks">
        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
            <samp  style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje">
                ---
            </samp>
        </p>
    </div>

    <div  id="dialog_message5" style="display:none" title="Shall the transfer out amount apply?">
        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
            <samp  style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje2">
                ---
            </samp>
        </p>
    </div>

    <div  id="dialog_message6" style="display:none" title="Be carefull here!">
        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
            <samp  style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje2">
                The tours has already begun, do you want redistribute the hotel days?
            </samp>
        </p>
    </div>

    <div  id="dialog_message7" style="display:none" title="how many nights?">
        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
            <samp  style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje2">
                How many nights are going to be charge in actual hotel?
                <br>
                <input type="text" name="renights" id="renights" />
            </samp>
        </p>
    </div>

    <div id="mascaraP" style="display: none;"></div>
    <div id="popup" style="display: none;">
        <div class="content-popup"></div>
    </div>

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

    <div id="dialog2" title="History of Payments [Multi-Day Tours]" style="display:none; width:550px; margin-left:-12px;">
        <div style="overflow-y: scroll;height:250px; width:550px; margin-left:0px;">
            <table class="grid2" cellspacing="1" id="grid2">
                <thead>
                    <tr>
                        <td style="text-align: center; width: 50px;">Eliminar</td>
                        <td style="text-align: center; width:170px; padding-left:2px;">Pago</td>
                        <td style="text-align: center; width:158px;">Tipo Pago</td>
                        <td style="text-align: center; width:78px;">Valor Pagado</td>
                        <td style="text-align: center; width:150px;">Fecha</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_multiday = $tours->id;
                    $sql122 = "SELECT pago, tipo_pago, pagado, fecha FROM tours_pago where id_tours= $id_multiday AND pagado <> '0.00' AND tipo='MULTI' order by fecha";
                    $rs12 = Doo::db()->query($sql122);
                    $pagos2 = $rs12->fetchAll();
                    foreach ($pagos2 as $p):
                        ?>
                        <tr class="row1">
                            <td style="text-align: center;">
                                    <a id="delpay" name="delpay" style="cursor:pointer;" href="javascript:ventanaSecundaria('<?php echo $data['rootUrl'] ?>admin/pagos/recibirId/<?php echo $tours->id ?>/<?php echo $tipo_reserva ?>')"  onClick=""><img style ="margin-top:8px; margin-left: 1px;" title="Eliminar Pago" src ='<?php echo $data['rootUrl'] ?>global/img/remove.png' width='15px'></a>
                            </td>
                            <td style="text-align: left;"><?php echo $p['pago']; ?></td>
                            <td style="text-align: left;"><?php echo $p['tipo_pago']; ?></td>
                            <td style="text-align: right;"><?php echo $p['pagado']; ?></td>
                            <td style="text-align: center;"><?php echo $p['fecha']; ?></td>
                            <script lenguage='javascript'>
                                function ventanaSecundaria(url){
                                    window.open(url, 'ventana1', 'width=1243, height=720, scrollbars=NO');

                                }
                            </script>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="debbug"></div>
    <div id="dialog-message" title="Details of change">
        <div id="conten_rastro">
        </div>
    </div>
    <div id="anonimo"></div>
    <div id="anonimo2"></div>
</div>

<div style="margin-right: -43%;margin-top: -5px;">
    <input type="text" name="priceadults" id="priceadults" style="display:none" size="10" maxlength="10" style="margin-left: -70px;" value=""></div>
    <input type="text" name="fecha_unix" id="fecha_unix" style="display:none;" value="" >
    
<div style="margin-left: 100%;margin-top: -25px;">
<!--    <input type="text" name="pricechilds" id="pricechilds" style="display:none" size="10" maxlength="10" style="margin-left: 254px;" value="<? echo $tour->t_price_child; ?>"></div>-->
    <div class="content"></div>   
<div class="" id="sur2015" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 0px; margin-top: 0px; font-weight: bold; font-size: 16px; display:none;">                
     
    <a style="margin-left: -556px; margin-top: 6px; position: absolute;" href=''><img src ='<?php echo $data['rootUrl'] ?>global/img/sur2015.gif' width="115px" height="85px" margin-left="0px" margin-top="0px">

</div> 
    
<img id="print" title= "Print Credit Card" onclick="window.print();" style="position:absolute; margin-left: -228px; margin-top: -30px; "src ='<?php echo $data['rootUrl'] ?>global/img/print.png' width="35px" height="35px" margin-left="0px" margin-top="0px">
    
    <script type="text/javascript">

                    function desval()
                    {

                    var dcval = document.getElementById('descuento_valor').value;                   
                        
                        if (dcval == "") {

                            document.getElementById('descuento_valor').value = "0.00";
                            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;

                            //$('#paid_driver').click();  
                            calcularTotalPago();
                            $("#descuento_valor").focus();
                        }



                        if (dcval == "0") {

                            document.getElementById('descuento_valor').value = "0.00";
                            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;

                            //$('#paid_driver').click(); 
                            calcularTotalPago();
                            $("#descuento_valor").focus();

                        }

                        if (dcval > "0") {                           

                          setTimeout(function () {                                

                            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;

                            //$('#paid_driver').click();  
                            calcularTotalPago();

                          }, 0.01);                          

                            $("#descuento_valor").focus();

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
       $("#pago_driver").focus();
                
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
    
        if($(obj).attr('class')=="flashit2"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

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
                            calcularTotalPago();
                            $("#extra").focus();                                                        

                        }

                        if (extra_cargo == "0" && otheramount == '0') {

                            document.getElementById('extra').value = "0.00";
                            document.getElementById('extrap').value = document.getElementById('extra').value;
                            
                            //$('#paid_driver').click();   
                            calcularTotalPago();
                            $("#extra").focus();                           
                            

                        }

                        if (extra_cargo > "0") {
                            
                            setTimeout(function () {
                                                        
                                document.getElementById('extrap').value = document.getElementById('extra').value;

                                //$('#paid_driver').click();
                                calcularTotalPago();
                                $("#extra").focus();
                            
                             }, 0.01);                           

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
                                            
                           calcularTotalPago();
                           $("#descuento").focus();

                        }



                        if (dcporc == "0") {


                            document.getElementById('descuento').value = "0";
                            document.getElementById('descuentop').value = document.getElementById('descuento').value;
                                              
                            calcularTotalPago();
                            $("#descuento").focus();

                        }

                        if (dcporc > "0") {
                            
                            setTimeout(function () {
                                
                            document.getElementById('descuentop').value = document.getElementById('descuento').value;
                                                   
                            calcularTotalPago();
                            $("#descuento").focus();
                            
                            }, 0.01);

                        }


                    }
                </script>

                <script type="text/javascript">

                    function foco_comments()
                    {
                       $("#comments").click();
                      
                       document.getElementById('comments').style.background = "#FFFFFF";

                       $("#comments").focus();
                      

                    }

                </script>


                <script type="text/javascript">

                    function make_charge()
                    {

                        var payamount = document.getElementById('pay_amount').value;



//                        if (payamount > 0) {
//                            //                        var op = 8;
//                            //                        alert(op);
//                            //                        exit;
//                            //                        document.getElementById('op_pago_id').value = 8;
//                            var pg = document.getElementById('pago_agente');
//                            var pg1 = document.getElementById('pago_agente1');
//                            pg.style.display = 'block';
//                            pg1.style.display = 'none';
//
//                        } else {
//                            pg.style.display = 'none';
//                            pg1.style.display = 'block';
//
//                        }

                    }

                </script>

                <script type="text/javascript">

                    function pago_click()
                    {

//                        var pag = document.getElementById('pago_agente');
//                        var pag1 = document.getElementById('pago_agente1');
//
//                        if ($('#pago_agente').click(); ) {
//
//
//                            pg.style.display = 'none';
//                            pg1.style.display = 'block';
//
//                        }
                    }

                </script>

                <script type="text/javascript">

                    function outcharge()
                    {


                        var pamount = document.getElementById('pay_amount').value;


                        if (pamount == 0) {


//                            var pagt = document.getElementById('pago_agente');
//                            pagt.style.display = 'none';
//
                        } else {
//
//                            pagt.style.display = 'block';
//
                     }

                    }

                </script>
                
            <script type="text/javascript">
    
                function fecha_transfer_in()
                {

                    var opcone = $("#estado_transfer_in").val();

                    //CONFIRMED
                    if(opcone == '1'){

                        document.getElementById('estado_transfer_in').value = "1";

                        document.getElementById('fec_sal').value = document.getElementById('fecha_salida').value;
                        
                        document.getElementById('estado_transfer_in').style.background = "#98FB98"; 
                        document.getElementById('estado_transfer_in').style.color = "#000";
                        document.getElementById('estado_transfer_in').style.border = "2px solid #FFFFFF";
                        
                        fechale();
                        


                    //CANCELED
                    }else if(opcone == '2'){

                        document.getElementById('estado_transfer_in').value = "2";

                        document.getElementById('fec_sal').value = "CANC";
                        
                        document.getElementById('estado_transfer_in').style.background = "#DC143C";  
                        document.getElementById('estado_transfer_in').style.color = "#FFFFFF";
                        document.getElementById('estado_transfer_in').style.border = "2px solid #FFFFFF";

                        

                    //NO SHOW
                    }else if(opcone == '3'){

                        document.getElementById('estado_transfer_in').value = "3";

                        document.getElementById('fec_sal').value = "N/S";
                        
                        document.getElementById('estado_transfer_in').style.background = "#00BFFF";  
                        document.getElementById('estado_transfer_in').style.color = "#000";
                        document.getElementById('estado_transfer_in').style.border = "2px solid #FFFFFF";

                       
              
                    } else{

                       

                    document.getElementById('fecha_salida').value = "<?php
                    
                    if ($reserva->fecha_salida == 'N/A') {
                        echo 'N/S';
                    }else if($reserva->fecha_salida == 'C'){
                        echo 'CANC';
                    }else {
                        if (isset($reserva)) {
                            echo ($reserva->fecha_salida == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_salida)));
                        }
                    }
                    ?>"

                    }


                }

            </script>
                
                
            
            <script type="text/javascript">
    
                function fecha_transfer_out()
                {

                    var opcone = $("#estado_transfer_out").val();

                    //CONFIRMED
                    if(opcone == '1'){

                        document.getElementById('estado_transfer_out').value = "1";

                        document.getElementById('fec_retor').value = document.getElementById('fecha_retorno').value;
                        
                        document.getElementById('estado_transfer_out').style.background = "#98FB98"; 
                        document.getElementById('estado_transfer_out').style.color = "#000";
                        document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";
                        
                        fechale2();
                        


                    //CANCELED
                    }else if(opcone == '2'){

                        document.getElementById('estado_transfer_out').value = "2";

                        document.getElementById('fec_retor').value = "CANC";
                        
                        document.getElementById('estado_transfer_out').style.background = "#DC143C";  
                        document.getElementById('estado_transfer_out').style.color = "#FFFFFF";
                        document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                        

                    //NO SHOW
                    }else if(opcone == '3'){

                        document.getElementById('estado_transfer_out').value = "3";

                        document.getElementById('fec_retor').value = "N/S";
                        
                        document.getElementById('estado_transfer_out').style.background = "#00BFFF";  
                        document.getElementById('estado_transfer_out').style.color = "#000";
                        document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                       
              
                    } else{

                       

                    document.getElementById('fecha_retorno').value = "<?php
                    
                    if ($reserva->fecha_retorno == 'N/A') {
                        echo 'N/S';
                    }else if($reserva->fecha_retorno == 'C'){
                        echo 'CANC';
                    }else {
                        if (isset($reserva)) {
                            echo ($reserva->fecha_retorno == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_retorno)));
                        }
                    }
                    ?>"

                    }


                }

            </script>
            
            <script type="text/javascript">
                
                function fechale()
                {

                    var fecha1 = document.getElementById('fecha_salida').value;                    
                    var d = new Date(fecha1); 
                    var dia = ("0" + (d.getDate())).slice(-2);                                               
                    var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
                    var yyy = d.getFullYear();
                    var fechita = yyy + '-' + mes + '-' + dia;

                    $("#fec_sal").val(fechita);                     

                }
            </script>
                        
            <script type="text/javascript">                
                
                function fechale2()
                {

                    var fecha2 = document.getElementById('fecha_retorno').value;                    
                    var d = new Date(fecha2); 
                    var dia = ("0" + (d.getDate())).slice(-2);                                               
                    var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
                    var yyy = d.getFullYear();
                    var fechita = yyy + '-' + mes + '-' + dia;

                    $("#fec_retor").val(fechita);              
                   
                }
            </script>
            

                
                <script type="text/javascript">

                function passenger_balance()
                {

                    //$('op_pago_conductor option[value="<?php /*echo $op_pago_conductor;*/ ?>"]').attr("selected", true);

                    //credit card with fee
                    
                    var op = document.getElementById('op_pago_conductor').value;
                    var otheramount = parseFloat($("#otheramount").val());
                   
                    
                    if (op == '3') {  

                       
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
                    }else if (op == '8') {              

                         document.getElementById('op_pago_conductor').value = "8";
                         document.getElementById('op_pago_id').value = "8";
                         //Reseteo();
                         calcularTotalPago();
                         document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                    //cash
                    }else if (op == '4') {      

                        document.getElementById('op_pago_conductor').value = "4";
                        document.getElementById('op_pago_id').value = "4";
                        //Reseteo();
                        calcularTotalPago(); 
                        document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                    //check
                    }else if (op == '9') {                        


                        document.getElementById('op_pago_conductor').value = "9";
                        document.getElementById('op_pago_id').value = "9";
                        //Reseteo();
                        calcularTotalPago();
                        document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;

                    //credit voucher
                    }else if (op == '5') {                        


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
                    }
//                    else if (op == '7'  {
//
//                        document.getElementById('op_pago_conductor').value = "7";
//
//                        setTimeout(function () {
//
////                            var cv = 0;
////                            $("#saldoporpagar").val((cv).toFixed(2));
////                            $("#paid_driver").val((cv).toFixed(2));
////                            $("#balance_due").val((cv).toFixed(2));
////                            $("#totalPagar").val((cv).toFixed(2));
////                            $("#totaltotal").text((cv).toFixed(2));
////                            $("#pay_amount").val((cv).toFixed(2));
////                            $("#tot_amount_paid").val((cv).toFixed(2));
////                            $("#agency_balance_due").val((cv).toFixed(2));
////                            $("#otheramount").val((cv).toFixed(2));
////                            document.getElementById('bal_duep').value = document.getElementById('balance_due').value ;
//
//                        }, 0.01);    
//
//                    }

                }

            </script>

                


                <script type="text/javascript">

                var rup

                function captura()
                {

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
                    
                    function Reseteo()
                    {

                        var op_pago = "<?php echo $tours->op_pago; ?>";
                        
                        var saldpagar = "<?php echo $saldpagar; ?>";                  
                        
                        var totalamount = "<?php echo $totalAmount; ?>";
                                              
                        var pay_amount = "<?php echo $pre_paid_amount; ?>";

                        var paid_driver = "<?php echo $paid_driver; ?>";                    
                        
                        var balance_due = "<?php echo $balance_due; ?>";

                        var agency_bal_due = "<?php echo $agency_balance_due; ?>";

                        var otheramount = "<?php echo $otheramount; ?>";

                        var tot_amount_paid = "<?php echo $total_paid; ?>";

                        var pre_paid_amount = "<?php echo $pre_paid_amount; ?>";

                        var temp = "<?php echo $total_charge; ?>";
                        
                        var tempwf = "<?php echo $cargos; ?>";
                        
                        var descuento_valor = "<?php echo $tours->descuento_valor; ?>";
                        var extra_cargo = "<?php echo $tours->extra_charge; ?>";
                        var descuento_porcentaje = "<?php echo $tours->descuento_procentaje ?>";
                        
                        
                        var op_pago_conductor = "<?php echo $op_pago_conductor; ?>";
                        
                        var paid_drivere = (parseFloat(paid_driver).toFixed(2));
                        
                        var balanceduee = (parseFloat(balance_due).toFixed(2));
                        
                        var totamon = (parseFloat(totalamount) + parseFloat(temp)).toFixed(2);
                        
                        var pay_amounte = (parseFloat(pay_amount).toFixed(2));
                        
                        var tot_amount_paide = (parseFloat(tot_amount_paid).toFixed(2));
                        
                        var agency_balance_duee = (parseFloat(agency_bal_due).toFixed(2));
                        
                        var otheramounte = (parseFloat(otheramount).toFixed(2));
                        
                       
                        

                        document.getElementById('pago_driver').value = '0.00';
                        
                        
                        if (otheramount > 0  &&  paid_driver == 0 && pay_amount == 0 ) {
                            
                            var cargos = "<?php echo $cargos; ?>";
                            var paid_driver = "<?php echo $paid_driver; ?>";
                            var saldpagar = "<?php echo $saldpagar; ?>";
                            var temp = "<?php echo $total_charge; ?>";
                            var result = (parseFloat(otheramount) + parseFloat(cargos)).toFixed(2);
                            var balance = (parseFloat(result) - parseFloat(paid_driver)).toFixed(2);
                            var resultado = (parseFloat(saldpagar) + parseFloat(temp) + parseFloat(cargos)).toFixed(2);
                            
//                            document.getElementById('saldoporpagar').value = otheramount; 
//                            document.getElementById('balance_due').value = otheramount;
                            document.getElementById('saldoporpagar').value = result; 
                            document.getElementById('balance_due').value = balance;
                            document.getElementById('totalAmount').value = resultado;
                            
                            document.getElementById('op_pago_conductor').value = op_pago_conductor;                            
                            document.getElementById('opcion_pago_driver').value = op_pago;  
                            
                            document.getElementById('descuento_valor').value = descuento_valor;
                            document.getElementById('descuento').value = descuento_porcentaje;
                            document.getElementById('extra').value = extra_cargo;
                            
                            selector();
                            captura(); 
                            //passenger_balance();
                            
                            
                        } else if(otheramount > 0  &&  paid_driver == 0 && pay_amount > 0){ 
                            
                            var cargos = "<?php echo $cargos; ?>";
                            var paid_driver = "<?php echo $paid_driver; ?>";
                            var saldpagar = "<?php echo $saldpagar; ?>";
                            var temp = "<?php echo $total_charge; ?>";
                            var result = (parseFloat(otheramount) + parseFloat(cargos)).toFixed(2);
                            var balance = (parseFloat(result) - parseFloat(paid_driver)).toFixed(2);
                            var resultado = (parseFloat(saldpagar) + parseFloat(temp) + parseFloat(cargos)).toFixed(2);
                            
                            document.getElementById('saldoporpagar').value = result; 
                            document.getElementById('balance_due').value = balance;
                            document.getElementById('totalAmount').value = resultado;
                            
                            document.getElementById('op_pago_conductor').value = op_pago_conductor;
                            document.getElementById('opcion_pago_driver').value = op_pago; 
                            
                            document.getElementById('descuento_valor').value = descuento_valor;
                            document.getElementById('descuento').value = descuento_porcentaje;
                            document.getElementById('extra').value = extra_cargo;
                            
                            selector();
                            captura(); 
                            //passenger_balance();
                      
                            //calcularTotalPago(); 
                            
                            
                            
                            
                        }else if(otheramount > 0  &&  paid_driver > 0 && pay_amount == 0){ 
                            
                            var cargos = "<?php echo $cargos; ?>";
                            var paid_driver = "<?php echo $paid_driver; ?>";
                            var saldpagar = "<?php echo $saldpagar; ?>";
                            var temp = "<?php echo $total_charge; ?>";
                            var result = (parseFloat(otheramount) + parseFloat(cargos)).toFixed(2);
                            var balance = (parseFloat(result) - parseFloat(paid_driver)).toFixed(2);
                            var resultado = (parseFloat(saldpagar) + parseFloat(temp) + parseFloat(cargos)).toFixed(2);
                            
                            document.getElementById('saldoporpagar').value = result; 
                            document.getElementById('balance_due').value = balance;
                            document.getElementById('totalAmount').value = resultado;
                            
                            
                            document.getElementById('op_pago_conductor').value = op_pago_conductor;
                            document.getElementById('opcion_pago_driver').value = op_pago; 
                            
                            document.getElementById('descuento_valor').value = descuento_valor;
                            document.getElementById('descuento').value = descuento_porcentaje;
                            document.getElementById('extra').value = extra_cargo;
                            
                            selector();
                            captura(); 
                            //passenger_balance();
                      
                            //calcularTotalPago(); 
                            
                        }else if(otheramount > 0  &&  paid_driver > 0 && pay_amount > 0){ 
                            
                                                        
                            var cargos = "<?php echo $cargos; ?>";
                            var paid_driver = "<?php echo $paid_driver; ?>";
                            var saldpagar = "<?php echo $saldpagar; ?>";
                            var temp = "<?php echo $total_charge; ?>";
                            var result = (parseFloat(otheramount) + parseFloat(cargos)).toFixed(2);
                            var balance = (parseFloat(result) - parseFloat(paid_driver)).toFixed(2);
                            var resultado = (parseFloat(saldpagar) + parseFloat(temp) + parseFloat(cargos)).toFixed(2);
                            
                            
                            document.getElementById('saldoporpagar').value = result; 
                            document.getElementById('balance_due').value = balance;
                            document.getElementById('totalAmount').value = resultado;
                           
                            
                            document.getElementById('op_pago_conductor').value = op_pago_conductor;
                            document.getElementById('opcion_pago_driver').value = op_pago;   
                            
                            document.getElementById('descuento_valor').value = descuento_valor;
                            document.getElementById('descuento').value = descuento_porcentaje;
                            document.getElementById('extra').value = extra_cargo;
                            
                            selector();
                            captura(); 
                            //passenger_balance();
                      
                            //calcularTotalPago(); 
                            
                            
                            
                        }else if (otheramount == 0){
                            
                            
                            //alert('hola');
                            var op_pago_conductor = "<?php echo $op_pago_conductor; ?>";
                            var saldpagar = "<?php echo $saldpagar; ?>";
                            
                            var total = "<?php echo $tours->total; ?>";
                            var temp = "<?php echo $tours->total_charge; ?>";
                            var total_charge = "<?php echo $tours->total_charge; ?>";
                            var paid_dvr = "<?php echo $tours->paid_driver; ?>";
                            
                            var other_amount = '0.00';
                            var result = (parseFloat(total) + parseFloat(temp)).toFixed(2);
                            //alert(total);
                           
                            selector();
                            captura(); 
                            //passenger_balance();
                            
                            document.getElementById('saldoporpagar').value = result; 
                            
                            $("#balance_due").val((((result) - (paid_dvr))-(pay_amount)).toFixed(2));
                            
                            if(op_pago_conductor == 3){
                                
                                setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));                                  
                                 
                                }, 0.01);
                                
                            }
                            //document.getElementById('totalAmount').value = total;
                            $("#otheramount").val(other_amount);                            
                            //$("#balance_due").val(balance_due);
                            $("#totalAmount").val(result);
                            
                            document.getElementById('op_pago_conductor').value = rup;
                            document.getElementById('opcion_pago_driver').value = op_pago; 
                            
                            document.getElementById('descuento_valor').value = descuento_valor;
                            document.getElementById('descuento').value = descuento_porcentaje;
                            document.getElementById('extra').value = extra_cargo;
                            
                            
                      
                             
//                            document.getElementById('saldoporpagar').value = saldpagar;  
                         }
                        
                            
                        

                        
                        document.getElementById('paid_driver').value = paid_drivere;                        
                        
                        //document.getElementById('totalAmount').value = totamon ;
                        
                        document.getElementById('pay_amount').value = pay_amounte;

                        document.getElementById('tot_amount_paid').value = tot_amount_paide;

                        document.getElementById('agency_balance_due').value = agency_balance_duee;

                        document.getElementById('otheramount').value = otheramount;

                        document.getElementById('temp').value = temp;
                        
                        document.getElementById('tempwf').value = tempwf;

                        document.getElementById('prepaid').value = pre_paid_amount;

                        document.getElementById('collect').value = paid_driver;

                        

                        document.getElementById('paid_drivert').value = paid_driver;

                        document.getElementById('pred_paid_amountt').value = pre_paid_amount;

                        document.getElementById('tot_charge').value = temp;


                        

                        document.getElementById('pay_amountp').value = document.getElementById('pay_amount').value;

                        document.getElementById('pred_paid_amountt').value = document.getElementById('pay_amount').value;

                        document.getElementById('pago_driver').style.color = '#848484';

                        document.getElementById('pago_driver2').value = '0.00';

                        document.getElementById('descuento').min = 0;

                        document.getElementById('pago_driver').disabled = false;

                        document.getElementById('btnAceptar').style.background = '';

                        document.getElementById('btnAceptar').style.color = '#000';

                        document.getElementById('dolares').style.color = '#848484';

                        document.getElementById('btnAceptar').style.cursor = '';


                        document.getElementById('op_pago_id').value = op_pago;
                        
                        //$('op_pago_id option[value="8"]').attr("selected", true);
                        
                        document.getElementById('op_pago_conductor').value = op_pago_conductor;
                        
                        document.getElementById('opcion_pago_driver').value = op_pago;

                        document.getElementById('op_pago_id2').value = 2;

                        document.getElementById('op_pago_id1').value = 0;
                        //calcularTotal();
                        
//                        selector();
//                        captura(); 
//                        passenger_balance();
//                      
                       //calcularTotalPago();
                        
                        
                        
                        //                  document.getElementById('btnAceptar').disabled = true;
                        


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
                    function Resetal()
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
                    function botonReset()
                    {
                        setTimeout(function () {

                           $('#logor').click();                            


                        }, 10000);                       
                       

                    }

                </script>
                



                <script type="text/javascript">
                    function dupliPago()
                    {
                        //       ("#pago_driver").mask("99,99");
                        var dupli = document.getElementById('pago_driver').value;
                        document.getElementById('pago_driver2').value = dupli;

                        if (dupli == '') {
                            document.getElementById('pago_driver').value = '0.00';

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


                        }

                    }
                </script>

                <script>

                    function calculos() {


                        var opcion = $("#op_pago_id1").val();

                        //*****************************************************PRED-PAID*************************************************************//
                        //***************************************************************************************************************************//

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
                                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                var temp = parseFloat($("#temp").val());
                                
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
                                
                                //document.getElementById('op_pago_conductor').value = 8;
                                
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
                                var agency_balance_due = parseFloat($("#agency_balance_due").val());
                                var total = parseFloat(pago_driver2);
                                var valor = 0;
                                var prepaid = parseFloat($("#prepaid").val());
                                
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
                                
                                //document.getElementById('op_pago_id').value = 8;
                                
                                valida_clase2();
                                
                                }

                            } else {
                                // Do nothing!
                                //exit;
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
                                //Reseteo();
                                Exit2();
                            }

                        }

                        //Cash
                        if (opcion === '26') {

                            if (confirm('Confirme su Tipo de Pago !!!')) {

                                var pago_driver = parseFloat($("#pago_driver").val());
                                var balance_due = parseFloat($("#balance_due").val());
                                var total = parseFloat(pago_driver);
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
                    function Exit()
                    {
                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
                        document.getElementById("btndecline").style.display = "none"; 
                        document.getElementById("btncancol").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";   
                        
                        ventana2.style.display = 'none'; // Y lo hacemos invisible

                    }
                </script>


                <script type="text/javascript">
                    function Exit2()
                    {
                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
                        ventana2.style.display = 'none'; // Y lo hacemos invisible
                        //Reseteo();
                        mostrarVentana2();

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
                                calcularTotalPago();

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
                            calcularTotalPago();

                        }, 0.001);


                    }
                </script>

                <script type="text/javascript">
                    function aplicar_pago() {
                        //alert('mostrar');
                        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor

                        var totalamount = document.getElementById('totalAmount').value;

                        //        alert(totalPagar);
                        ventana.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
                        ventana.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
                        ventana.style.display = 'block'; // Y lo hacemos visible
                    }
                    function ocultarVentana()
                    {
                        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
                        ventana.style.display = 'none'; // Y lo hacemos invisible
                        var opcion_pago_2 = $('#opcion_pago_2').val();
                        var aplica_pago = $('#aplica_pago').val();

                        // document.getElementById('pay_amount').value = aplica_pago;
                        //var resultados = prueba + opcion_pago_2;
                        //alert(opcion_pago_2);
                    }
                    //document.getElementById('otheramount').value = totalPagar;
                </script>

                <script type="text/javascript">

                    function mostrarVentana2() {

                        //                    capturar();



                        if (window.screen.availWidth <= 640) {

                            window.parent.document.body.style.zoom = "62%";
                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                            ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';
                        }

                        if (window.screen.availWidth == 800) {

                            window.parent.document.body.style.zoom = "78%";
                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                            ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';
                        }
                        if (window.screen.availWidth == 1024) {

                            window.parent.document.body.style.zoom = "100%";
                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                            ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                            ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';


                        }

                        if (window.screen.availWidth == 1366) {


                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
                            //                        ventana2.style.marginTop = "-1px"; // Definimos su posición vertical.   
//                            ventana2.style.top = "1140px"; // Definimos su posición vertical.      
//                            //                        ventana2.style.marginLeft = "-86.4px"; // Definimos su posición horizontal
//                            ventana2.style.left = "756px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';

                        }

                        if (window.screen.availWidth == 1440) {


                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                            ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                            ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';

                        }

                        if (window.screen.availWidth == 1600) {


                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                            ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                            ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';

                        }

                        if (window.screen.availWidth == 1680) {


                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                            ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                            ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
//                            ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';

                        }

                        if (window.screen.availWidth > 1680) {


                            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  


                            //                        ventana2.style.marginTop = "-16px"; // Definimos su posición vertical.        
                            //                        ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
//                            ventana2.style.top = "1223px"; // Definimos su posición vertical.        
//                            ventana2.style.left = "808px"; // Definimos su posición horizontal
                            ventana2.style.display = 'block'; // Y lo hacemos visible
                            //ventana2.style.position = 'absolute';
                            ventana2.style.height = '174px';



                        }


                        $("#pago_driver").focus();

                        

                        document.getElementById('pago_driver').value = '0.00';

                        document.getElementById('pago_driver').style.color = '#848484';

                        document.getElementById('op_pago_id1').value = 0;
                        //document.getElementById('op_pago_id').value = 8;
                        document.getElementById('opcion_pago_2').value = 2;
                        //document.getElementById('opcion_pago_3').value = 2;
                        
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

                        //PRED-PAID////////////////////////////////////////////
                        //Credit Card with fee

                        if (opcion === '0') {

                            //            document.getElementById('paid_driver').value = '0.00';
                            //            document.getElementById('pay_amount').value = '0.00';
                            //            document.getElementById('paid_drivert').value = '0.00';
                            //            document.getElementById('pred_paid_amountt').value = '0.00';


                            setTimeout(function () {
                                //$('#pay_amount').click();
                                calcularTotalPago();

                            }, 0.001);

                            setTimeout(function () {
                                //$('#paid_driver').click();
                                calcularTotalPago();

                            }, 0.001);

                            $("#pago_driver").focus();


                        }

                        if (opcion === '1') {

                            //            document.getElementById('paid_driver').value = '0.00';
                            //            document.getElementById('pay_amount').value = '0.00';
                            //            document.getElementById('paid_drivert').value = '0.00';
                            //            document.getElementById('pred_paid_amountt').value = '0.00';

                            setTimeout(function () {
                                //$('#pay_amount').click();
                                calcularTotalPago();

                            }, 0.001);

                            setTimeout(function () {
                                //$('#paid_driver').click();
                                calcularTotalPago();

                            }, 0.001);

                            $("#pago_driver").focus();

                        }

                        //*****************************PRED-PAID**********************//////////
                        //************************************************************/////////

                        //CREDIT CARD NO FEE
                        if (opcion === '20') {

                            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                                document.getElementById('pay_amount').value = prepaid;
                                document.getElementById('pay_amountp').value = prepaid;
                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());
                                
                                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                                
                                setTimeout(function () {
                                    
                                    calcularTotalPago();
                                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                                    document.getElementById('pay_amount').className = "flashit2";
//                                    document.getElementById('guardar').className = "flashit2";
                                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";

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

                                //document.getElementById('opcion_pago').value = 8;
                                document.getElementById('pay_amount').value = prepaid;
                                document.getElementById('pay_amountp').value = prepaid;
                                document.getElementById('pred_paid_amountt').value = prepaid;

                                var prep = parseFloat($("#pred_paid_amountt").val());

                                var coll = parseFloat($("#paid_drivert").val());
                                
                                var result = parseFloat(prep) + parseFloat(coll);                           

                                $("#tot_amount_paid").val((prep + coll).toFixed(2));

                                setTimeout(function () {
                                  
                                    calcularTotalPago();
                                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                                    document.getElementById('pay_amount').className = "flashit2";
//                                    document.getElementById('guardar').className = "flashit2";
                                    document.getElementById('pay_amount').style.backgroundColor = "#E21F26";

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

                        //CASH
                        if (opcion === '22') {

                            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                                document.getElementById('pay_amount').value = prepaid;
                                document.getElementById('pay_amountp').value = prepaid;
                                document.getElementById('pred_paid_amountt').value = prepaid;

                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());

                                $("#tot_amount_paid").val((prep + coll).toFixed(2));

                                setTimeout(function () {
                                    
                                    calcularTotalPago();
                                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                                    document.getElementById('pay_amount').className = "flashit2";
//                                    document.getElementById('guardar').className = "flashit2";
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
                                document.getElementById('pay_amountp').value = prepaid;
                                document.getElementById('pred_paid_amountt').value = prepaid;

                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());

                                $("#tot_amount_paid").val((prep + coll).toFixed(2));

                                setTimeout(function () {
                                    
                                    calcularTotalPago();
                                    document.getElementById('pay_amount').style.color = "#FFFFFF";
                                    document.getElementById('pay_amount').className = "flashit2";
//                                    document.getElementById('guardar').className = "flashit2";
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
                        //******************************************************************//
                        //**********************COLLECT ON BOARD****************************//
                        //******************************************************************//


                        //CREDIT CARD NO FEE
                        if (opcion === '24') {


                            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                                document.getElementById('paid_driver').value = collect;
                                document.getElementById('paid_drivert').value = collect;


                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());
             
                                $("#tot_amount_paid").val((prep + coll).toFixed(2));

                                setTimeout(function () {
                                   
                                    calcularTotalPago();
                                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                                    document.getElementById('paid_driver').className = "flashit";
//                                    document.getElementById('guardar').className = "flashit";
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
                             
                                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                                
                                setTimeout(function () {
                                    
                                    calcularTotalPago();
                                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                                    document.getElementById('paid_driver').className = "flashit";
//                                    document.getElementById('guardar').className = "flashit";
                                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
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
                        //CASH
                        if (opcion === '26') {

                            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                                document.getElementById('paid_driver').value = collect;
                                document.getElementById('paid_drivert').value = collect;

                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());
                                $("#tot_amount_paid").val((prep + coll).toFixed(2));
                             
                                setTimeout(function () {
                                    
                                    calcularTotalPago();
                                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                                    document.getElementById('paid_driver').className = "flashit";
//                                    document.getElementById('guardar').className = "flashit";
                                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
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

                        //CHECK
                        if (opcion === '27') {

                            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                             
                                document.getElementById('paid_driver').value = collect;
                                document.getElementById('paid_drivert').value = collect;
                              
                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());
                      
                                $("#tot_amount_paid").val((prep + coll).toFixed(2));

                                setTimeout(function () {
                                    
                                    calcularTotalPago();
                                    document.getElementById('paid_driver').style.color = "#FFFFFF";
                                    document.getElementById('paid_driver').className = "flashit";
//                                    document.getElementById('guardar').className = "flashit";
                                    document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
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



                <script type="text/javascript">

                    function ocultarmenu() {
                        div = document.getElementById('menu-bar');
                        div.style.display = 'none';
                        div2 = document.getElementById('hd-menu');
                        div2.style.display = 'none';

                    }

                </script>



               

                <script type="text/javascript">
                    function dupliac()
                    {
                        //duplicar amount to collect  en otheramount
                       
                        var dupliam = document.getElementById('saldoporpagar').value;
                        var extra = $("#extra").val();
                        var desc_valor = $("#descuento_valor").val();
                        var desc_porc = $("#descuento").val();
                        var paid_driver = $("#paid_driver").val();
                        var apagare1 = apagare;
                        //var apagar1 = parseFloat(apagare1) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                        var apagar1 = parseFloat(apagare1);
                        var balance = parseFloat(apagar1) - parseFloat(paid_driver);
                        var duplicado = (parseFloat(dupliam)).toFixed(2);   
                        var other = 0 ;
                                
                        document.getElementById('otheramount').value = duplicado;
                        document.getElementById('otheramountp').value = duplicado;
                        document.getElementById('balance_due').value = dupliam;


                        if (dupliam == '') {                           
                                                      
                            
                            setTimeout(function () {

                                //click al boton Balance_Due para hacer el calculo de passenger Balance Due  
                                
                                $("#saldoporpagar").val((apagar1).toFixed(2));
                                $("#balance_due").val((balance).toFixed(2));
                                $("#otheramount").val((other).toFixed(2));
                                $("#otheramountp").val((other).toFixed(2));
                                //$('#paid_driver').click();
                                calcularTotalPago();

                                
                             

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
                                 calcularTotalPago();

                            }, 100);

                        }
                        
                        if (dupliam > 0) {
                           
                            setTimeout(function () {
                                
                                //click al boton Balance_Due para hacer el calculo de passenger Balance Due                                
                                //$("#saldoporpagar").val((duplicado).toFixed(2));
                                
                                calcularTotalPago();
                                //$("#saldoporpagar").val((duplicado).toFixed(2));

                            }, 1250);

                        }

                       

                    }

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

                            function pregunta(e) {
                                if (confirm('Esta seguro de que desea Editar este MultiDay Tours?')) {
                                    //document.formborrar.submit() 

                                    document.getElementById('modal').style.display = 'none';
                                    document.getElementbyId('mostrar-modal').style.display = 'none';


                                } else {
                                    e.preventDefault();
                                }
                            }

            </script>

    
    <script type="text/javascript">
                function valida_hotel()
                {
                    setTimeout(function () {

                    var fec_salida = document.getElementById('fecha_salida').value;
                    var fec_retorn = document.getElementById('fecha_retorno').value;
                    
                    if(fec_salida != "" && fec_retorn != ""){ 
                        
                        document.getElementById('hotel_name').disabled = false;
                        document.getElementById('park_name').disabled = false;
//                        document.getElementById('add_hotel_list').disabled = false;
//                        document.getElementById('add_attraction_list').disabled = false;
                        
                    }else{
                        
                        document.getElementById('hotel_name').disabled = true;
                        document.getElementById('park_name').disabled = true;
//                        document.getElementById('add_Hotel_list').disabled = true;
//                        document.getElementById('add_attraction_list').disabled = true;

                    }                        

                                                                  
                    }, 0.001);

                   
                }

    </script>
    
    <script type="text/javascript">
                function addlist()
                {
                    setTimeout(function () {

                    var hotel_name = document.getElementById('hotel_name').value;
                    
                    
                    if(hotel_name != ""){ 
                        
                        document.getElementById('add_Hotel_list').disabled = false;

                        
                    }else{
                        
                        document.getElementById('add_Hotel_list').disabled = true;


                    }                        

                                                                  
                    }, 0.001);

                   
                }

    </script>
    
    <script type="text/javascript">
                function addpark()
                {
                    setTimeout(function () {

                    var park_name = document.getElementById('park_name').value;
                    
                    
                    if(park_name != ""){ 
                        
                        document.getElementById('add_attraction_list').disabled = false;

                        
                    }else{
                        
                        document.getElementById('add_attraction_list').disabled = true;


                    }                        

                                                                  
                    }, 0.001);

                   
                }

    </script>
    
    <script type="text/javascript">

    function estado_trf_in()
    {

        var est_trf_in = document.getElementById('estado_trf_in').value;
        document.getElementById('estado_transfer_in').value = est_trf_in;   
        
        //CONFIRMED
        if(est_trf_in == 1){
            
           document.getElementById('estado_transfer_in').style.background = "#98FB98"; 
           document.getElementById('estado_transfer_in').style.color = "#000";
           document.getElementById('estado_transfer_in').style.border = "2px solid #FFFFFF";
        
        //CANCELED
        }else if(est_trf_in == 2){
            
           document.getElementById('estado_transfer_in').style.background = "#DC143C";  
           document.getElementById('estado_transfer_in').style.color = "#FFFFFF";
           document.getElementById('estado_transfer_in').style.border = "2px solid #FFFFFF";
        
        //NO SHOW    
        }else if(est_trf_in == 3){
            
           document.getElementById('estado_transfer_in').style.background = "#00BFFF";  
           document.getElementById('estado_transfer_in').style.color = "#000";
           document.getElementById('estado_transfer_in').style.border = "2px solid #FFFFFF";
            
        }


    }
</script>

<script type="text/javascript">

    function estado_trf_out()
    {

        var est_trf_out = document.getElementById('estado_trf_out').value;
        document.getElementById('estado_transfer_out').value = est_trf_out;  
        
        //CONFIRMED
        if(est_trf_out == 1){
            
           document.getElementById('estado_transfer_out').style.background = "#98FB98"; 
           document.getElementById('estado_transfer_out').style.color = "#000";
           document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";
        
        //CANCELED
        }else if(est_trf_out == 2){
            
           document.getElementById('estado_transfer_out').style.background = "#DC143C";  
           document.getElementById('estado_transfer_out').style.color = "#FFFFFF";
           document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";
        
        //NO SHOW
        }else if(est_trf_out == 3){
            
           document.getElementById('estado_transfer_out').style.background = "#00BFFF";  
           document.getElementById('estado_transfer_out').style.color = "#000";
           document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";
            
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
            return "Salir de la ventana o actualizarla, Evitara que no se guarden los nuevos cambios hechos en esta reserva de Multiday Tours.";
    }
</script>-->


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
//        $("#pago_agente").click(function () {

            document.getElementById('btnPagolinea').style.display = 'none';
            document.getElementById("btndecline").disabled = false;
            document.getElementById("btndecline").style.display = "";
            document.getElementById("btndecline").style.cursor = 'pointer';

            //var cantidad = $("#pay_amount").val();
            var cantidad = $("#pago_tarjeta").val();
            if (cantidad <= 0) {
                return false;
            }
            var email1 = $("#email1").val();
            var primer_n = $("#firstname1").val();
            var segundo_n = $("#lastname1").val();
            var phone1 = $("#phone1").val();

            var url = encodeURI('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $tours->code_conf; ?>');

            window.open(url, '_blank');
            return false;
        });
        $(window).load(function () {

            Ocultarmenu();
            ComprobarScreen();
            //);
            sur_2015();
            //*****estado transfer in****
            estado_trf_in();
            
            //*****estado transfer out****
            estado_trf_out();
            
            fechale();
            fechale2();
            
            selector();
            captura();  
            facturado();
            //passenger_balance();
            

            document.getElementById('descuento_valorp').value = document.getElementById('descuento_valor').value;
            document.getElementById('descuentop').value = document.getElementById('descuento').value;
            document.getElementById('extrap').value = document.getElementById('extra').value;

            document.getElementById('frday').value = '<?php echo $hotel_reserve['freeday']; ?>';
            document.getElementById('rates').value = 0;
//            document.getElementById('pay_amountp').value = "<?php echo $pre_paid_amount; ?>";
            document.getElementById('pay_amountp').value = document.getElementById('pay_amount').value;
            document.getElementById('otheramountp').value = document.getElementById('otheramount').value;

            $("#content").css("opacity", "1");
            var sel_payment = '<?php echo $reserva->op_pago; ?>';
            $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
            
            calcularTotalPago();

            ocultar('attractions');
            $("#opcion_traffic").val(0);
            $("#opcion_traffic").attr('checked', false);

        });
        $("#op_pago_id").change(function () {
            calcularTotalPago();
        });
        $(function () {
            $("#opcion_pago_predpaid_cash").click(function () {
                $("#btn-save2").show();
                $("#enviarF").hide();
                //        $("#pay_amount_html").hide();
            });
            $("#opcion_pago_CrediFee").click(function () {
                $("#btn-save2").show();
                $("#enviarF").hide();
                //#new
                $("#pay_amount_html").show();
            });
            $("#opcion_pago_agency").click(function () {
                $("#btn-save2").show();
                $("#enviarF").hide();
                //#new
                $("#pay_amount_html").show();
            });
            $("#opcion_pago_Cash, #opcion_pago_Voucher").click(function () {
                $("#btn-save2").show();
                $("#enviarF").hide();
                //        $("#pay_amount_html").hide();
            });
            $("#opcion_pago_passager").click(function () {
                //        $("#btn-save2").hide();
                $("#enviarF").show();
                $("#pay_amount_html").show();
            });
            $("#label_tipo_predpaid_cash").click(function () {
                //        $("#btn-save2").hide();
                //        $("#enviarF").show();
                $("#pay_amount_html").show();
            });
            $("#extra").change(function () {
                calcularTotalPago();
            });
            $("#otheramount").change(function () {
                calcularTotalPago();
            });
            $("#opcion_pago_CrediFee").change(function () {
                calcularTotalPago();
            });
            $("#icon-back").click(function () {
                $("#mascaraP").hide();
                $("#clienteN").hide();
            });

            $("#dataclick1").click(function (e) {
                e.preventDefault();
                // $("#fecha_salida").datepicker("show");
            });
            $("#dataclick1_h").click(function (e) {
                e.preventDefault();
                // $("#fecha_salida_h").datepicker("show");
            });
            $('#btn-cancel').click(function () {
                window.location = '<?php echo $data['rootUrl']; ?>admin/tours';
            });

            $('#cliente').focus();
            $.fn.autosugguest({
                className: 'ausu-suggest',
                methodType: 'POST',
                minChars: 1,
                rtnIDs: true,
                dataFile: '<?php echo $data["rootUrl"]; ?>admin/tours/loaddatos'
            });

            $("#btn-rastro, #btn-rastro2").click(function () {
                var posicion = $(this).position();
                mosrtarRastro(posicion.left, posicion.top);
            });

            $('#fecha_salida').datepicker({
                dateFormat: 'mm-dd-yy'

            });
            $('#fecha_retorno').datepicker({
                dateFormat: 'mm-dd-yy',
                beforeShow: function () {
                    if ($('#fecha_retorno').attr("readonly") == "readonly") {
                        return false;
                    }
                }

            });
            $('#fecha_salida_h').datepicker({
                dateFormat: 'mm-dd-yy'

            });
            $('#fecha_retorno_h').datepicker({
                dateFormat: 'mm-dd-yy',
                beforeShow: function () {
                    if ($('#fecha_retorno_h').attr("readonly") == "readonly") {
                        return false;
                    }
                }
            });
            $("#dataclick2").click(function (e) {
                e.preventDefault();
                //$("#fecha_retorno").datepicker("show");
            });
            $("#dataclick2_h").click(function (e) {
                e.preventDefault();
                // $("#fecha_retorno_h").datepicker("show");
            });

            $("#fecha_salida").change(function () {
                var fecha_salida = $('#fecha_salida').val();
                $("#fecha_salida_h").val(fecha_salida);
                $("#fec_sal").val(fecha_salida);
                if (!Validar(fecha_salida)) {
                    $('#fecha_salida').focus();
                } else {
                    var fecha_retorno = $('#fecha_retorno').val();
                    if (Validar(fecha_retorno)) {
                        diferencia();
                        $("#hotel_name").attr('disabled', false);
                    } else {
                        $("#hotel_name").attr('disabled', true);
                    }
                }
            });

            $("#fecha_retorno").change(function () {
                mensaje("Ha hecho un Cambio en las fechas, esto representa un cambio en el numero de dias y noches por lo tanto, es necesario volver a realizar la distribución de habitaciones e ingresar nuevamente el hotel.", "Cambiar Distribución de Hoteles", '');
                var fecha_retorno = $('#fecha_retorno').val();
                $("#fecha_retorno_h").val(fecha_retorno);
                $("#fec_retor").val(fecha_retorno);
                if (!Validar(fecha_retorno)) {
                    $('#fecha_retorno').focus();
                } else {
                    var fecha_salida = $('#fecha_salida').val();
                    if (Validar(fecha_salida)) {
                        diferencia();
                        $("#hotel_name").attr('disabled', false);
                    } else {
                        $("#hotel_name").attr('disabled', true);
                    }
                }
            });

            $("#type_services_premiun, #type_services_vip").change(function (e) {
                var val = $(this).val();
                if (val == 1) {
                    $("#a_bus").attr('disabled', true);
                    $("#a_car").attr('disabled', true);
                    $("#d_bus").attr('disabled', true);
                    $("#d_car").attr('disabled', true);

                    //Seleccionamos VIP
                    if ($("#a_bus").is(":checked") || $("#a_car").is(":checked")) {
                        $("#a_vip").attr('checked', true);
                        typeTranspor1($("#a_vip").val());
                    }
                    if ($("#d_bus").is(":checked") || $("#d_car").is(":checked")) {
                        $("#d_vip").attr('checked', true);
                        typeTranspor2($("#d_vip").val());
                    }
                } else {
                    $("#a_bus").attr('disabled', false);
                    $("#a_car").attr('disabled', false);
                    $("#d_bus").attr('disabled', false);
                    $("#d_car").attr('disabled', false);
                }
            });

            $("#a_bus, #a_vip,#a_airpoty, #a_car").change(function () {
                var id = $(this).val();
                typeTranspor1(id);
                if (id != 0) {
                    valorTransfer(id, 1, 1);
                } else {
                    $("#priceTransporA1").html(0);
                    $("#priceTransporC1").html(0);
                    calcularTotalPago();
                }
            });

            $("#d_bus, #d_vip,#d_airpoty, #d_car").change(function () {
                var id = $(this).val();
                typeTranspor2(id);
                if (id != 0) {
                    valorTransfer(id, 2, 2);
                } else {
                    $("#priceTransporA2").html(0);
                    $("#priceTransporC2").html(0);
                    calcularTotalPago();
                }
            });

            $("#child, #adult").change(function () {
                mensaje("Ha hecho un Cambio en el numero de pasajeros, des necesario volver a realizar la distribución de habitaciones e ingresar nuevamente el hotel.", "Cambiar Distribución de Hoteles", 'fecha_retorno');
                var adult = $("#adult").val();
                var child = $("#child").val();
                if (adult < 1) {
                    adult = 1;
                    $("#adult").val(adult);
                } else if (adult > 100) {
                    adult = 100;
                    $("#adult").val(adult);
                }
                var maxChild = 100 - adult;
                $("#child").attr('max', maxChild);
                if (child < 0) {
                    $("#child").val(0);
                } else if (child > maxChild) {
                    $("#child").val(maxChild);
                }
                var id_agency = $("#id_agency").val();
                var url = '<?php echo $data['rootUrl']; ?>admin/tours/change/pax/attractions/' + $("#adult").val() + '/' + $("#child").val() + '/' + id_agency;
                $("#anonimo2").load(url);

                valorTransferGeneral();
                habitaciones();
                calcularTotalPago();

            });

            $("#opcion_transfer_in").change(function () {
                var i = $(this).val();
                $(this).val((1 - i));
                ocultar('conte_arrival');
            });

            $("#opcion_transfer_out").change(function () {
                //Se pregunta que si se desea cobrar, si el resultado es si, se mantiene el valor
                //Dentro del total, solo se ocultara el transfer out

                if (!$(this).is(':checked')) {
                    $("#mascaraP").show();
                    erase_transferout();
                } else {
                    $("#toutwcharge").val('-1');
                }
                var i = $(this).val();
                $(this).val((1 - i));
                ocultar('conte_departure');
            });


            $("#opcion_hotel").change(function () {
                var i = $(this).val();
                $(this).val((1 - i));
                var fecha_retorno = $('#fecha_retorno').val();
                var fecha_salida = $('#fecha_salida').val();
                if ($(this).is(':visible') && Validar(fecha_salida) && Validar(fecha_retorno)) {
                    $("#hotel_name").attr('disabled', false);
                    var num = $("#select_rooms").val();
                    var url = '<?php echo $data['rootUrl']; ?>admin/tours/habitaciones2/' + num + '/' + $("#adult").val() + '/' + $("#child").val();
                    $("#selectos").load(url);
                } else {
                    $("#hotel_name").attr('disabled', true);
                }
                ocultar('hotels');
            });

            $("#opcion_parks_edit").change(function () {
                var i = $(this).val();
                $(this).val((1 - i));
                ocultar('parks_edit');
                ocultar('attractions');
                $("#opcion_traffic").val(0);
                $("#opcion_traffic").attr('checked', false);

            });

            $("#opcion_traffic").change(function () {
                var i = $(this).val();
                $(this).val((1 - i));
                ocultar('attractions');
                //actualizacion
                ocultar('parks_edit');
                $("#opcion_parks_edit").val(0);
                $("#opcion_parks_edit").attr('checked', false);
            });
            $("#select_rooms").change(function () {
                var child = $('#child').val();
                var adult = $('#adult').val();
                if (child == "") {
                    child = 0;
                }
                if (adult == "") {
                    adult = 0;
                }
                var num = $("#select_rooms").val();
                var url = '<?php echo $data['rootUrl']; ?>admin/tours/habitaciones2/' + num + '/' + adult + '/' + child;
                $("#selectos").load(url);

            });
            $("#add_Hotel_list").click(function () {
                cargarHoteles();
            });
            $("#free_buffet").click(function (e) {
                if ($("#free_buffet").is(":checked")) {
                    $("#free_buffet").val(1);
                } else {
                    $("#free_buffet").val(0);
                }
                $("#free_buffet").attr('disabled', true);
                if ($("#hotel_id_select").val() != -1 && $("#hotel_id_select").val() != '' && $("#hotel_id_select").val() != -0) {
                    var id_hotel = $("#hotel_id_select").val();
                    $('#hotel_id').val(id_hotel);
                    cargarHoteles();
                    $('#hotel_id').val(-1)

                }
                $("#free_buffet").attr('disabled', false);
            });
            acomodacion();
            $("#add_attraction_list").click(function () {
                var msj = '';
                var dato = $("#dato").val(); 
                var titulo = '';
                var id_park = $("#id_park").val();
                var fecha_retorno = $('#fecha_retorno').val();
                var fecha_salida = $('#fecha_salida').val();
                var id_group = $('#categoria_park').val();
                if (!Validar(fecha_salida)) {
                    msj = '- Incorrect tours start date.';
                    titulo = 'START DATE';
                    mensaje(msj, titulo, 'fecha_salida');
                    return false;
                }
                if (!Validar(fecha_retorno)) {
                    msj = '- Incorrect final date of the tour';
                    titulo = 'END DATE';
                    mensaje(msj, titulo, 'fecha_retorno');
                    return false;
                }
                if (id_park == '' || id_park == '-1' || id_park == '0') {
                    msj = '- Choose a park to add to the tour';
                    titulo = 'Parks of the tour';
                    mensaje(msj, titulo, 'park_name');
                    return false;
                }
                var child = $('#child').val();
                var adult = $('#adult').val();
                if (child == "") {
                    child = 0;
                }
                if (adult == "") {
                    adult = 0;
                }
                var totalpax = (parseInt(adult) + parseInt(child));
                if (totalpax <= 1 && id_park == '19') {
                    msj = '- to go to Kennedy space ctr., there must be 2 passengers ';
                    titulo = 'Alert';
                    mensaje(msj, titulo, 'park_name');
                    return false;
                }
                var id_agency = $("#id_agency").val();
                if ($("#type_services_premiun").is(':checked')) {
                    var platinum = 0;
                } else {
                    var platinum = 1;
                }

                var url = '<?php echo $data['rootUrl']; ?>admin/tours/selectpark/' + id_park + '/' + id_group + '/' + adult + '/' + child + '/' + fecha_salida + '/' + fecha_retorno + '/' + platinum + '/' + id_agency + '/' + dato;
                $("#tablePark").load(url);

                $("#park_name").val('');
                $("#categoria_park").val(0);

            });
            $('.buff').change(function () {
                $('#buffet').dialog('close');
                if ($("#buffetYes").is(':checked')) {
                    $('#breakfastdato').text('SUPER BREKFAST BUFFET');
                    $("#hotel_buffet").val(1);
                    var nhot = parseInt($("#nhoteles").val());
                    $("#hotel_buffet_" + nhot).val(1);
                    var child = $('#child').val();
                    var adult = $('#adult').val();
                    if (child == "") {
                        child = 0;
                    }
                    if (adult == "") {
                        adult = 0;
                    }
                    //var fdadult = $("#fdadult").val();
                    var nochesfree = $("#nochesfree").val();
                    //var free_buffet = $("#free_buffet").val();
                    var noches = $("#nights").val();
                    var priceBreakfast = calcularBreakfast(adult, child);
                    if ((noches - nochesfree) == 0) {
                        var valorDesyuno = 0;
                    } else {
                        var valorDesyuno = priceBreakfast / (adult * (noches - nochesfree));
                    }
                    var id_hotel = $('#hotel_id').val();

                    var url = '<?php echo $data['rootUrl']; ?>admin/tours/activar/superbreakfast/' + id_hotel + '/1';
                    $("#anonimo").load(url);
                    $("#breakfastdato").attr('title', '$ ' + valorDesyuno);
                }
                calcularTotalPago();
            });
            $('#opcion_saldo1, #opcion_saldo2').change(function () {
                if ($(this).get(0).id == 'opcion_saldo1') {
                    $('#opcion_pago_saldo').val('1');
                } else if ($(this).get(0).id == 'opcion_saldo2') {
                    $('#opcion_pago_saldo').val('2');
                }
                calcularTotalPago();
            });
            $('#opcion_pago_passager, #opcion_pago_agency, #opcion_pago_predpaid_cash,#opcion_pago_complementary,#opcion_pago_CrediFee, #opcion_pago_Cash,#opcion_pago_Voucher').click(function (e) {

                calcularTotalPago();
            });
            $("#btn-save2").click(function (e) {
                if (validarFormulario()) {
                    
                    bPreguntar = false;
                    preguntarAntesDeSalir();
                    if ($("#a_bus").is(':checked')) {
                        $("#trip1a").val($("#priceTransporA1").html());
                        $("#trip1c").val($("#priceTransporC1").html());
                    }
                    if ($("#d_bus").is(':checked')) {
                        $("#trip2a").val($("#priceTransporA2").html());
                        $("#trip2c").val($("#priceTransporC2").html());
                    }
                    $("#content").css("display", "none");
                    $("#form1").attr('target', '_parent');
                     $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/3");

                    $("#form1").attr('action', '<?php echo $data['rootUrl']; ?>admin/tours/saveedit');
                    //bPreguntar = false;
                    $("#form1").submit();
                }
            });
            $("#enviarF").click(function (e) {
                if (validarFormulario()) {
                    if ($("#enviar_escondido").val() == 1) {
                        $("#enviar_escondido").val(0);
                        irApagar();
                    } else {
                        registrarCliente();
                    }
                }
            });
            cargarParkRegistrados();
            setTimeout('calcularTotalPago();', 1000);
<?php if ($tours->id_reserva == -1 && $tours->id_transfer_in == -1) {
    ?>
                ocultar('conte_arrival');
                $("#opcion_transfer_in").val(0);
                $("#opcion_transfer_in").attr('checked', false);
    <?php
} else if ($tours->id_reserva != -1 && $tours->id_transfer_in == -1 && $reserve->trip_no == 0) {
    ?>
                ocultar('conte_arrival');
                $("#opcion_transfer_in").val(0);
                $("#opcion_transfer_in").attr('checked', false);
    <?php
}
?>

<?php if ($tours->id_reserva == -1 && $tours->id_transfer_out == -1) {
    ?>
                ocultar('conte_departure');
                $("#opcion_transfer_out").val(0);
                $("#opcion_transfer_out").attr('checked', false);
    <?php
} else if ($tours->id_reserva != -1 && $tours->id_transfer_out == -1 && $reserve->trip_no2 == 0) {
    ?>
                ocultar('conte_departure');
                $("#opcion_transfer_out").val(0);
                $("#opcion_transfer_out").attr('checked', false);
    <?php
}
?>

<?php if ($tours->id_hotel_reserve != -1) { ?>

                $("#opcion_hotel").attr('checked', 'checked');

<?php } else { ?>
                $("#opcion_hotel").attr('checked', false);
                //$("#fdadult").val(0);
                $("#nochesfree").val(0);

                ocultar('hotels');
<?php } ?>
<?php if (empty($_SESSION['tours']['attraction'])) { ?>
                ocultar('attractions');
                $("#opcion_traffic").val(0);
                $("#opcion_traffic").attr('checked', false);
<?php } ?>

<?php
if ($tours->id_agency != -1) {
    ?>
                $("#div_tex_comision").show();
                $("#div_val_comision").html("$<?php echo $comision ?>")
                        .show();
    <?php
}
//aqui
?>
<?php
if ($tours->id_agency != -1) {
    ?>
                $("#opcion_pago_agency").show();
    <?php if ($agencia->type_rate == 0) { ?>
                    $("#tableTypeSaldo").show();
        <?php if ($tipo_saldo == "FULL") { ?>
                        console.log('FULL');
                        $("#opcion_saldo2").attr('checked', '');
                        $("#opcion_saldo1").attr('checked', 'checked');
                        $("#opcion_saldo1").trigger('change');
        <?php } else { ?>
                        console.log('BALANCE');
                        $("#opcion_saldo1").attr('checked', '');
                        $("#opcion_saldo2").attr('checked', 'checked');
                        $("#opcion_saldo2").trigger('change');

        <?php } ?>
    <?php } ?>
    <?php
}
?>

        });
        function poner(id, id2) {
            var id = id;
            var id2 = id2;
            $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/cargardatos/' + id + '/' + id2);
        }
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
            $('#clienteN').fadeIn('slow');
            $('#mascaraP').fadeIn('slow');
            $("#email1").focus();
            //setInterval('setTimeout("activarenvioPago()",5000)',5000);
        }
        function fechaRetorno(menor) {
            var d = new Date(menor);
            d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
            $('#fecha_retorno').datepicker('option', 'minDate', d);
        }
        function fechaRetorno_h(menor) {
            var d = new Date(menor);
            d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
            $('#fecha_retorno_h').datepicker('option', 'minDate', d);
        }
        function diferencia() {
            if ($('#fecha_retorno').val() != "") {
                var diferencia = Math.floor((Date.parse($('#fecha_retorno').val()) - Date.parse($('#fecha_salida').val())) / 86400000);
                if (diferencia < 0) {
                    alert('End date must be greater than start date');
                    fechaRetorno($('#fecha_salida').val());
                    $('#fecha_retorno').focus();
                    return 0;
                } else {
                    $("#nights").val((diferencia));
                    $("#days").val(diferencia + 1);
                    $("#nights2").val((diferencia));
                    $("#days2").val(diferencia + 1);
                    //$("#fdadult").attr('max', diferencia);
                    $("#nochesfree").attr('max', diferencia);
                    return diferencia;
                }
            }
            return 0;
        }
        function typeTranspor1(id) {
            $("#transport1").load('<?php echo $data["rootUrl"]; ?>admin/tours/typeTranspor1/' + id);
        }
        function typeTranspor2(id) {
            $("#transport2").load('<?php echo $data["rootUrl"]; ?>admin/tours/typeTranspor2/' + id);
        }
        function valorTransferGeneral() {
            var a_t_num = document.getElementsByName('a_type').length;
            var a_type = 0;
            for (var i = 0; i < a_t_num; i++) {
                if (document.getElementsByName('a_type').item(i).checked) {
                    a_type = document.getElementsByName('a_type').item(i).value;
                }
            }

            var d_t_num = document.getElementsByName('d_type').length;
            var d_type = 0;
            for (var i = 0; i < d_t_num; i++) {
                if (document.getElementsByName('d_type').item(i).checked) {
                    d_type = document.getElementsByName('d_type').item(i).value;
                }
            }
            if (a_type != 0) {
                valorTransfer(a_type, 1, 1);
            }
            if (d_type != 0) {
                valorTransfer(d_type, 2, 2);
            }
        }
        function valorTransfer(tipo_transfer, tipo_transport, sentido) {

            var rates = $('#rates').val();
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var id_agencia = $("#id_agency").val();
            if (sentido == 1) { //para ida
                var fecha = $("#fecha_salida").val();
            } else {
                var fecha = $("#fecha_retorno").val();
            }
            //    alert(sentido);
            //Calulamos el valor y la comision del transfer 
            $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/valorTransfer/' + tipo_transfer + '/' + tipo_transport + '/' + child + '/' + adult + '/' + id_agencia + '/' + fecha + '/' + sentido + '/' + rates);

        }
        function opcionCheckbox(id) {
            if ($("#" + id).attr("checked")) {
                $("#" + id).val('1');
            } else {
                $("#" + id).val('0');
            }
        }
        function mostrarTrip1() {
            
            var rates = $('#rates').val();
            var from = $('#from').val();
            var to = $('#to').val();
            var fecha_salida = $('#fecha_salida').val();
            var tipopas = $('#tipo_pass').val();
            var child = $('#child').val();
            var adult = $('#adult').val();
            var tipo_reserva = $('#tipo_reserva').val();
            var total_pasajeros = $('#total_pasajeros').val();
            var trip1 = "<?php echo $trip1; ?>";
            var trip2 = "<?php echo $trip2; ?>";
            
            
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var totalpax = (parseInt(adult) + parseInt(child));

            var agency;
            if ($('#id_agency').val() != '-1') {
                agency = $('#id_agency').val()
            } else {
                agency = -1;
            }
            var mensage = "";
            if (!Validar(fecha_salida)) {
                msj = '- Incorrect tours start date.';
                titulo = 'START DATE';
                mensaje(msj, titulo, 'fecha_salida');
                return false;
            }
            if (totalpax == 0) {
                msj = '- Passenger numbers must be greater than zero.';
                titulo = 'Passenger numbers ';
                mensaje(msj, titulo, 'adult');
                return false;
            }
            if (from == '' || from == 0) {
                document.getElementById('save2').style.display = "none";
                msj = '- From is required (The departure area).';
                titulo = 'The departure area ';
                mensaje(msj, titulo, 'from');
                return false;

            }
            if (to == '' || to == 0) {
                document.getElementById('save2').style.display = "none";
                msj = '- To is required (The arrival area).';
                titulo = 'The arrival area ';
                mensaje(msj, titulo, 'to');
                return false;
            }
            $(".content-popup").html(" ");
            var url = '<?php echo $data["rootUrl"]; ?>admin/tours/selectTrip1/' + from + '/' + to + '/' + fecha_salida + '/' + totalpax + '/' + total_pasajeros + '/' + tipo_reserva + '/' + trip1 + '/' + trip2 + '/' + tipopas + '/' + agency + '/' + rates;
            $('.content-popup').load(url);

            $('#mascaraP').fadeIn('slow');
            $('#popup').fadeIn('slow');
        }
        function mostrarTrip2() {

            var rates = $('#rates').val();
            var from = $('#from2').val();
            var to = $('#to2').val();
            var fecha_retorno = $('#fecha_retorno').val();
            var tipopas = $('#tipo_pass').val();
            var child = $('#child').val();
            var adult = $('#adult').val();
            var tipo_reserva = $('#tipo_reserva').val();
            var total_pasajeros = $('#total_pasajeros').val();
            var trip1 = "<?php echo $trip1; ?>";
            var trip2 = "<?php echo $trip2; ?>";
            
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var totalpax = (parseInt(adult) + parseInt(child));

            var agency;
            if ($('#id_agency').val() != '-1') {
                agency = $('#id_agency').val()
            } else {
                agency = -1;
            }
            //var dato = from+'  '+to+'  '+fecha_retorno+'  '+tipopas+'  '+agency +'  '+totalpax;
            //alert(dato);
            var mensage = "";
            //    if(!Validar(fecha_retorno)){
            //        msj = '- Incorrect final date of the tour.';
            //        titulo = 'END DATE';
            //        mensaje(msj,titulo,'fecha_retorno');
            //        return false;
            //    }
            if (totalpax == 0) {
                msj = '- Passenger numbers must be greater than zero.';
                titulo = 'Passenger numbers ';
                mensaje(msj, titulo, 'adult');
                return false;
            }
            if (from == '' || from == 0) {
                msj = '- From is required (The departure area).';
                titulo = 'The departure area ';
                mensaje(msj, titulo, 'from2');
                return false;
            }
            if (to == '' || to == 0) {
                msj = '- To is required (The arrival area).';
                titulo = 'The arrival area ';
                mensaje(msj, titulo, 'to2');
                return false;
            }
            $(".content-popup").html(" ");
            var url = '<?php echo $data["rootUrl"]; ?>admin/tours/selectTrip2/' + from + '/' + to + '/' + fecha_retorno + '/' + totalpax + '/' + total_pasajeros + '/' + tipo_reserva + '/' + trip1 + '/' + trip2 + '/' + tipopas + '/' + agency + '/' + rates;
            $('.content-popup').load(url);

            $('#mascaraP').fadeIn('slow');
            $('#popup').fadeIn('slow');
        }
        function trim(myString) {
            return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
        }
        function ocultar(id) {
            if ($("#" + id).is(":visible")) {
                $("#" + id).hide("blind", {direction: "vertical"}, 500);
            } else {
                $("#" + id).show("blind", {direction: "vertical"}, 500);
            }
        }
        function change_from() {
            var id = $("#from").val();
            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
            if (id != 0) {
                $("#a_pickup1").attr('disabled', false);
                document.getElementById('search1').style.display = "";
            } else {
                $("#a_pickup1").attr('disabled', true);
            }
            
            if(id == 0){            
            document.getElementById('search1').style.display = "none"; 
            document.getElementById('a_trip_no').value = ""; 
            }

            if(id > 0){            
                document.getElementById('search1').style.display = ""; 
                document.getElementById('a_trip_no').value = ""; 
            }
        }
        function change_to2() {
            var id = $("#to2").val();
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
            if (id != 0) {
                //        $("#d_pickup1").attr('disabled',false);
            } else {
                //        $("#d_pickup1").attr('disabled',true);
            }
            
            if(id == 0){            
                document.getElementById('search2').style.display = "none";  
                document.getElementById('d_trip_no').value = ""; 
            }

            if(id > 0){            
                document.getElementById('search2').style.display = ""; 
                document.getElementById('d_trip_no').value = ""; 
            }
        }
        function change_ext_from1() {
            var id = $("#ext_from1").val();
            if (id != 0) {
                var id_agency = $("#id_agency").val();
                var num = 1;
                $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/tours/priceexten/' + id + '/' + id_agency + '/' + num));
                $("#a_pickup2").attr('disabled', false);
                //        $("#a_pickup1").attr('disabled',true);
            } else {
                $("#a_pickup2").attr('disabled', true);
                //        $("#a_pickup1").attr('disabled',false);
                $("#a_id_pickup1").val('-1');
                $("#priceExt_from1").html('0');
                calcularTotalPago();
            }
        }
        function change_ext_to2() {
            var id = $("#ext_to2").val();
            if (id != 0) {
                var id_agency = $("#id_agency").val();
                var num = 4;
                $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/tours/priceexten/' + id + '/' + id_agency + '/' + num));
                $("#d_pickup2").attr('disabled', false);
                //        $("#d_pickup1").attr('disabled',true);
            } else {
                $("#d_pickup2").attr('disabled', true);
                //        $("#d_pickup1").attr('disabled',false);
                $("#priceExt_to2").html('0');
                calcularTotalPago();
            }
        }
        function acomodacion() {
            var child = $('#child').val();
            var adult = $('#adult').val();
            var rooms = '<?php echo ($last_index > 0) ? $rooms : 0; ?>';
            var r_adult1 = '<?php echo ($last_index > 0) ? $r_adult1 : 0; ?>';
            var r_adult2 = '<?php echo ($last_index > 0) ? $r_adult2 : 0; ?>';
            var r_adult3 = '<?php echo ($last_index > 0) ? $r_adult3 : 0; ?>';
            var r_adult4 = '<?php echo ($last_index > 0) ? $r_adult4 : 0; ?>';
            var r_child1 = '<?php echo ($last_index > 0) ? $r_child1 : 0; ?>';
            var r_child2 = '<?php echo ($last_index > 0) ? $r_child2 : 0; ?>';
            var r_child3 = '<?php echo ($last_index > 0) ? $r_child3 : 0; ?>';
            var r_child4 = '<?php echo ($last_index > 0) ? $r_child4 : 0; ?>';
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            url = '<?php echo $data['rootUrl']; ?>admin/tours/habitacionesAginables/' + adult + '/' + rooms;
            $("#select_rooms").load(url);
<?php if ($tours->id_hotel_reserve != -1) { ?>
                var totalpax = (parseInt(adult) + parseInt(child));
                var url = '<?php echo $data['rootUrl']; ?>admin/tours/acomodacion/' + rooms + '/' + r_adult1 + '/' + r_adult2 + '/' + r_adult3 + '/' + r_adult4 + '/' + r_child1 + '/' + r_child2 + '/' + r_child3 + '/' + r_child4;
                $("#selectos").load(url);
<?php } ?>
        }
        //habitaciones();
        function habitaciones() {
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            url = '<?php echo $data['rootUrl']; ?>admin/tours/habitacionesAginables/' + adult + '/' + adult;
            $("#select_rooms").load(url);
            var url = '<?php echo $data['rootUrl']; ?>admin/tours/habitaciones/' + adult + '/' + child;
            $("#selectos").load(url);
        }
        function validarAcomodacion() {
            if ($('#adult1').length != 0) {
                var adult1 = $('#adult1').val();
                if (adult1 == 0) {
                    alert('- Room 1: The rooms must have at least one adult.')
                    $('#adult1').focus();
                    return '';
                }
            } else {
                var adult1 = 0;
            }
            if ($('#child1').length != 0) {
                var child1 = $('#child1').val();
            } else {
                var child1 = 0;
            }
            if ($('#adult2').length != 0) {
                var adult2 = $('#adult2').val();
                if (adult2 == 0) {
                    alert('- Room 2: The rooms must have at least one adult.')
                    $('#adult2').focus();
                    return '';
                }
            } else {
                var adult2 = 0;
            }
            if ($('#child2').length != 0) {
                var child2 = $('#child2').val();
            } else {
                var child2 = 0;
            }
            if ($('#adult3').length != 0) {
                var adult3 = $('#adult3').val();
                if (adult3 == 0) {
                    alert('- Room 3: The rooms must have at least one adult.')
                    $('#adult3').focus();
                    return '';
                }
            } else {
                var adult3 = 0;
            }
            if ($('#child3').length != 0) {
                var child3 = $('#child3').val();
            } else {
                var child3 = 0;
            }
            if ($('#adult4').length != 0) {
                var adult4 = $('#adult4').val();
                if (adult4 == 0) {
                    alert('- Room 4: The rooms must have at least one adult.')
                    $('#adult4').focus();
                    return '';
                }
            } else {
                var adult4 = 0;
            }
            if ($('#child4').length != 0) {
                var child4 = $('#child4').val();
            } else {
                var child4 = 0;
            }

            adult1 = parseInt(adult1);
            child1 = parseInt(child1);
            adult2 = parseInt(adult2);
            child2 = parseInt(child2);
            adult3 = parseInt(adult3);
            child3 = parseInt(child3);
            adult4 = parseInt(adult4);
            child4 = parseInt(child4);

            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var totalpax1 = (parseInt(adult) + parseInt(child));
            var totalpax2 = (adult1 + child1 + adult2 + child2 + adult3 + child3 + adult4 + child4);

            if (totalpax1 != totalpax2) {
                alert('- The number of people in the rooms does not match the total passajeros ');
                $('#adult1').focus();
                return '';
            }
            if (adult != (adult1 + adult2 + adult3 + adult4)) {
                alert('- The number of people in the rooms does not match the total passajeros.');
                $('#adult1').focus();
                return '';
            }
            var dato = '/' + adult1 + '/' + adult2 + '/' + adult3 + '/' + adult4 + '/' + child1 + '/' + child2 + '/' + child3 + '/' + child4;
            return dato;
        }

        $("#frday").click(function (e) {
//                                if ($("#free_buffet").is(":checked")) {
//                                    $("#free_buffet").val(1);
//                                } else {
//                                    $("#free_buffet").val(0);
//                                }
            var frday = $('#frday').val();

        });

        function cargarHoteles() {

            var id_tour = $("#id_tour").html();
            var rates = $('#rates').val();
            var frday = $('#frday').val();
            var datosroom = validarAcomodacion();
            var msj = '';
            var titulo = '';
            if (datosroom != '') {
                var fecha_retorno = $('#fecha_retorno_h').val();
                var fecha_salida = $('#fecha_salida_h').val();
                var id_hotel = $('#hotel_id').val()
                if (!Validar(fecha_salida)) {
                    msj = '- Incorrect tours start date.';
                    titulo = 'START DATE';
                    mensaje(msj, titulo, 'fecha_salida');
                    return false;
                }
                if (!Validar(fecha_retorno)) {
                    msj = '- Incorrect final date of the tour';
                    titulo = 'END DATE';
                    mensaje(msj, titulo, 'fecha_retorno');
                    return false;
                }
                if (id_hotel == '' || id_hotel == -1 || id_hotel == 0) {
                    msj = '-  Select the hotel you want to add';
                    titulo = 'Hotel of the tour';
                    mensaje(msj, titulo, 'hotel_name');
                    return false;
                }
                var d = diferencia();
                var frday = $('#frday').val();

                if (d < frday) {
                    msj = '- The number of Free Days exceeds the size of the tour';
                    titulo = 'Free Days';
                    mensaje(msj, titulo, 'frday');
                    return false;
                }



                var free_buffet = $("#free_buffet").val();
                if (free_buffet == undefined) {
                    free_buffet = 0;
                }

                var frday = $("#frday").val();
                if (frday == undefined) {
                    frday = 0;
                }

//                                    if(frday == ""){
//                                      frday = 0;
//                                    }
//            
                var id_agency = $("#id_agency").val();
                //var fdadult = $("#fdadult").val();
                //var fdchild = $("#fdchild").val();
                var nochesfree = ($("#nochesfree").val() == '') ? 0 : trim($("#nochesfree").val());
                var url = '<?php echo $data['rootUrl']; ?>admin/tours/selecthotel/' + id_hotel + '/' + fecha_salida + '/' + fecha_retorno + datosroom + '/' + id_agency + '/' + nochesfree + '/' + free_buffet + '/' + rates + '/' + frday;

                $("#tablehoteles").load(url);
            }
        }



        function mensaje(msg, titulo, id) {
            $("#txtMensaje").text(msg);
            $("#dialog_message4").removeAttr('title');
            $("#dialog_message4").attr('title', titulo);
            $("#dialog_message4").dialog({
                modal: true,
                width: 600,
                buttons: {
                    Ok: function () {
                        $("#dialog_message4").dialog("close");
                        $('#' + id).focus();
                    }
                }
            });
            $("#ui-dialog-title-dialog_message4").text(titulo);
        }
        function checker_admision(check, img, id_park) {
            if ($("#" + check).is(":checked")) {
                $("#" + check).attr("checked", false);
                var url = "<?php echo $data['rootUrl']; ?>global/img/admin/x02.png";
                $("#" + img).hide("blind", {direction: "vertical"}, 300);
                $("#" + img).attr('src', url);
                $("#" + img).show("blind", {direction: "vertical"}, 300);
                var opcion = 0;
            } else {
                $("#" + check).attr("checked", true);
                var url = "<?php echo $data['rootUrl']; ?>global/img/admin/check2.png";
                $("#" + img).hide("blind", {direction: "vertical"}, 300);
                $("#" + img).attr('src', url);
                $("#" + img).show("blind", {direction: "vertical"}, 300);
                var opcion = 1;
            }
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var id_agency = $("#id_agency").val();
            $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionpark/' + id_park + '/' + opcion + '/' + adult + '/' + child + '/' + id_agency);
        }
        function checker_admision_todos(opcion) {
            var id_park = 'a';
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var id_agency = $("#id_agency").val();
            $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionpark/' + id_park + '/' + opcion + '/' + adult + '/' + child + '/' + id_agency);
        }
        function checker_transport(check, img, id_park) {
            if ($("#" + check).is(":checked")) {
                $("#" + check).attr("checked", false);
                var url = "<?php echo $data['rootUrl']; ?>global/img/admin/x02.png";
                $("#" + img).hide("blind", {direction: "vertical"}, 300);
                $("#" + img).attr('src', url);
                $("#" + img).show("blind", {direction: "vertical"}, 300);
                var opcion = 0;
            } else {
                $("#" + check).attr("checked", true);
                var url = "<?php echo $data['rootUrl']; ?>global/img/admin/check2.png";
                $("#" + img).hide("blind", {direction: "vertical"}, 300);
                $("#" + img).attr('src', url);
                $("#" + img).show("blind", {direction: "vertical"}, 300);
                var opcion = 1;
            }
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionTransorLocal/' + id_park + '/' + opcion + '/' + adult + '/' + child);
        }
        function  checker_transport_todos(opcion) {
            var id_park = 'a';
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionTransorLocal/' + id_park + '/' + opcion + '/' + adult + '/' + child);
        }
        function delete_park(id_park) {

            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child === "") {
                child = 0;
            }
            if (adult === "") {
                adult = 0;
            }
            return $("#tablePark").load('<?php echo $data['rootUrl']; ?>admin/tours/delete_park/' + id_park + '/' + adult + '/' + child);
        }
        function delete_hotel(id_hotel) {
            $('#buffetYes').attr('checked', false);


//            var free_buffet = $("#free_buffet").val();
//            if (free_buffet > 0) {
//                free_buffet = 0;
//                $("#free_buffet").val(0);
//            }

            var frday = $("#frday").val();
            if (frday > 0) {
                frday = 0;
                $("#frday").val(0);
            }

            $('#buffetNo').attr('checked', false);
            $("#tablehoteles").load('<?php echo $data['rootUrl']; ?>admin/tours/delete_hotel/' + id_hotel);
        }
        function calcularTranspor1(adult, child) {
            var a_t_num = document.getElementsByName('a_type').length;
            var a_type = 0;
            for (var i = 0; i < a_t_num; i++) {
                if (document.getElementsByName('a_type').item(i).checked) {
                    a_type = document.getElementsByName('a_type').item(i).value;
                }
            }
            var priceA = $("#priceTransporA1").html();
            var priceC = $("#priceTransporC1").html();
            if (a_type == 0) {
                var priceTranspor1 = (priceA * adult) + (priceC * child);
            } else {
                var priceTranspor1 = parseFloat(priceA) + parseFloat(priceC);
            }
            //    alert(priceTranspor1);
            return priceTranspor1;
        }
        function calcularTranspor2(adult, child) {
            var d_t_num = document.getElementsByName('d_type').length;
            var d_type = 0;
            for (var i = 0; i < d_t_num; i++) {
                if (document.getElementsByName('d_type').item(i).checked) {
                    d_type = document.getElementsByName('d_type').item(i).value;
                }
            }
            var priceA = $("#priceTransporA2").html();
            var priceC = $("#priceTransporC2").html();
            if (d_type == 0) {
                var priceTranspor2 = (priceA * adult) + (priceC * child);
            } else {
                var priceTranspor2 = parseFloat(priceA) + parseFloat(priceC);
            }
            return priceTranspor2;
        }

        function calcularExtencion1(adult, child) {
            var exten1 = $("#priceExt_from1").html();
            var totalpax = parseInt(adult) + parseInt(child);
            var priceExten = (exten1 * totalpax);
            return priceExten;
        }
        function calcularExtencion2(adult, child) {
            var exten4 = $("#priceExt_to2").html();
            var totalpax = parseInt(adult) + parseInt(child);
            var priceExten2 = (exten4 * totalpax);
            return priceExten2;
        }
        function calcularCostoHotel(adult, child) {
            /*var priceHotel = $("#totalpriceNights").html();*/
            var priceHotel = $("#totalpriceNights").html();
            return priceHotel;
        }
        function calcularBreakfast(adult, child) {
            if ($("#buffetYes").is(':checked')) {
                var priceBreakfast = $("#totalpriceBreakfast").html();
            } else {
                var priceBreakfast = 0;
            }
            return priceBreakfast;
        }
        function calcularTransportLocal(adult, child) {
            var priceTransportLocal = $("#totalpriceTransporLocal").html();
            if (priceTransportLocal == '') {
                priceTransportLocal = 0;
            }
            return priceTransportLocal;
        }
        function calcularAdmision(adult, child) {
            var priceAdmision = $("#totalpriceAdmision").html();
            if (priceAdmision == '') {
                priceAdmision = 0;
            }
            return priceAdmision;
        }
        function calcularTotal() {
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var totalpax = (parseInt(adult) + parseInt(child));
            if (totalpax > 0) {
                //Transporte 1
                if ($("#opcion_transfer_in").is(':checked')) {
                    var priceTranspor1 = calcularTranspor1(adult, child);
                    var priceExten1 = calcularExtencion1(adult, child);
                    var totalTranspor1 = parseFloat(priceTranspor1) + parseFloat(priceExten1);
                } else {
                    var totalTranspor1 = 0;
                }
                //        alert(totalTranspor1);
                //Transporte 2
                if ($("#opcion_transfer_out").is(':checked') || $("#toutwcharge").val() == '1') {
                    console.log('se sigue cobrando');
                    var priceTranspor2 = calcularTranspor2(adult, child);
                    var priceExten2 = calcularExtencion2(adult, child);
                    var totalTranspor2 = parseFloat(priceTranspor2) + parseFloat(priceExten2);
                } else {
                    var totalTranspor2 = 0;
                }
                //Hotel
                if ($("#opcion_hotel").is(':checked')) {
                    var priceHotel = calcularCostoHotel(adult, child);
                    var priceBreakfast = calcularBreakfast(adult, child);
                    var totalHotel = parseFloat(priceHotel) + parseFloat(priceBreakfast);
                } else {
                    var totalHotel = 0;
                }
                //        alert(priceHotel);
                //        alert(priceBreakfast);
                //Park

                //priceadults.value = parseFloat($("#price_total_paid").val());

                //            if ($("#opcion_traffic").is(':checked')) {


                ///////////////////////////////////////////////////////////////////////////////////////
//                var priceTransportLocal = calcularTransportLocal(adult, child);
//
//                var priceAdmision = calcularAdmision(adult, child);
//                            //(priceadults.value)
//                           // var priceTransportLocal = 0;
//                            //////////////////////
//                var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                //            } else {
                //                var priceTransportLocal = 0;
                //                var priceAdmision = 0;
                //                var totalpark = 0;
                //            }
                /////////////////////////////////////////////////////////////////////////////////////////////

//               if ($("#opcion_parks_edit").is(':checked')) {
//                    var priceTransportLocal = calcularTransportLocal(adult, child);
//                    var priceAdmision = ('<?php echo $price_total_paid; ?>' - priceTransportLocal);
//                    //var priceAdmision = calcularAdmision(adult, child);
//                    var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
//                }
//                else {
                if ($("#opcion_traffic").is(':checked')) {
                    var priceTransportLocal = calcularTransportLocal(adult, child);
                    var priceAdmision = calcularAdmision(adult, child);
                    var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                } else {
                    var priceTransportLocal = 0;
                    var priceAdmision = 0;
                    var totalpark = 0;
                }
//                }    







                var total = parseFloat(totalTranspor1) + parseFloat(totalTranspor2) + parseFloat(totalHotel) + parseFloat(totalpark);

                //        console.log(total);
                $("#price_transport1pp").text('$ ' + ((totalTranspor1 / totalpax) * totalpax).toFixed(2));
                $("#price_transport2pp").text('$ ' + ((totalTranspor2 / totalpax) * totalpax).toFixed(2));
                $("#park_transport").text('$ ' + (priceTransportLocal / totalpax).toFixed(2));
                $("#park_transport").text('$ ' + (priceTransportLocal / totalpax).toFixed(2));
                $("#park_admision").text('$ ' + (priceAdmision / totalpax).toFixed(2));
                $("#amount_hotel").html('$ ' + (totalHotel / totalpax).toFixed(2));
                return total;
            }
            return 0;
        }
        function comision() {
            var c_tours = '<?php echo $comsion_servis['003']; ?>';
            var c_hotel = '<?php echo $comsion_servis['004']; ?>';
            var c_atraction = '<?php echo $comsion_servis['005']; ?>';
            var c_transport1 = $("#comisionTranspor1").html();
            var c_transport2 = $("#comisionTranspor2").html();
            var type_rate = $("#type_rate").val();
            var id_agency = $("#id_agency").val();
            if (id_agency == -1 || type_rate == 1) {
                return 0;
            } else {
                var child = $('#child').val();
                var adult = $('#adult').val();
                if (child == "") {
                    child = 0;
                }
                if (adult == "") {
                    adult = 0;
                }
                //Transporte 1
                if ($("#opcion_transfer_in").is(':checked')) {
                    var priceTranspor1 = calcularTranspor1(adult, child);
                    var priceExten1 = calcularExtencion1(adult, child);
                    //var totalTranspor1 = parseFloat(priceTranspor1) + parseFloat(priceExten1);
                    var totalTranspor1 = parseFloat(priceTranspor1);
                } else {
                    var totalTranspor1 = 0;
                }
                //Transporte 2
                if ($("#opcion_transfer_out").is(':checked')) {
                    var priceTranspor2 = calcularTranspor2(adult, child);
                    var priceExten2 = calcularExtencion2(adult, child);
                    //var totalTranspor2 = parseFloat(priceTranspor2) + parseFloat(priceExten2);
                    var totalTranspor2 = parseFloat(priceTranspor2);
                } else {
                    var totalTranspor2 = 0;
                }
                //Hotel
                if ($("#opcion_hotel").is(':checked')) {
                    var priceHotel = calcularCostoHotel(adult, child);
                    var priceBreakfast = calcularBreakfast(adult, child);
                    var totalHotel = parseFloat(priceHotel) + parseFloat(priceBreakfast);
                } else {
                    var totalHotel = 0;
                }
                //Park
                if ($("#opcion_traffic").is(':checked')) {

                    var priceTransportLocal = 0;
                    var priceAdmision = 0;
                    var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);


                } else {
                    var priceTransportLocal = 0;
                    var priceAdmision = 0;
                    var totalpark = 0;
                }
                if (($("#opcion_transfer_in").is(':checked')) && ($("#opcion_transfer_out").is(':checked')) && ($("#opcion_hotel").is(':checked')) && $("#opcion_traffic").is(':checked')) {
                    var total = parseFloat(totalTranspor1) + parseFloat(totalTranspor2) + parseFloat(totalHotel) + parseFloat(totalpark);
                    $("#comision").val(total * c_tours / 100);
                    return (total * c_tours / 100);
                } else {
                    var comi = (parseFloat(totalTranspor1 * c_transport1) + parseFloat(totalTranspor2 * c_transport2) + parseFloat(totalHotel * c_hotel) + parseFloat(totalpark * c_atraction)) / 100;
                    $("#comision").val(comi);
                    return comi;
                }
            }
        }
        
        //variable usada para obtener valor de apagar en funcion dupliac()
        var apagare
        
        function calcularTotalPago() {

            var total = calcularTotal();
            var child = $("#child").val();
            var adult = $("#adult").val();
            //var saldoactual = $("#saldoactual").val();      
            var saldoporpagar = $("#saldoporpagar").val();
            var paid_driver = $("#paid_driver").val();            
            var balance_due = $("#balance_due").val();
            var totalamount = $("#totalAmount").val();
            var other_amount = $("#otheramount").val();
            var temp = $("#temp").val();
            var pay_amount = $("#pay_amount").val();
            var tot_amount_paid = $("#tot_amount_paid").val();
            var agency_balance_due = $("#agency_balance_due").val();
            var totcharge = parseFloat($("#tot_charge").val());

            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var totalpax = parseInt(adult) + parseInt(child);
            //Calculamos comision
            var total_total = "<?php echo $totaltotal; ?>";
            var comi = 0/*comision()*/;
            var full = total + 0/*comision()*/;
            //full = total_total;
            var balance = full - comi;
            var disponible = $("#disponible").val();
            var agency = $("#id_agency").val();
            var pagado = "<?php echo $pagado; ?>";


            var tipo_pago = 0;
            var num = document.getElementsByName('opcion_pago').length;
            for (var i = 0; i < num; i++) {
                if (document.getElementsByName('opcion_pago').item(i).checked) {
                    tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
                }
            }
            
           
            var tipo_pago = $("#op_pago_id option:selected").val();            

            //var prepago = $("#op_pago_id2 option:selected").val();
            
            var prepago = $("#opcion_pago_2 option:selected").val();

            var tipo_saldo = $('#opcion_pago_saldo').val();
            var apagar = full;
            
            
            if (tipo_saldo == 2) {
                apagar = balance;
            }

            var valor = apagar;
            //VALOR EXTRA
            var error = "";
            error += validateNumber($("#extra").val(), 'Extra', true);
            var extra = 0;
            if (error == "") {
                extra = $("#extra").val();
            }
            //DESCUENTO DE %
            error = "";
            error += validateNumber($("#descuento").val(), 'Descuento', true);
            var desc_porc = 0;
            if (error == "") {
                var porcentaje = $("#descuento").val();
                //Park--> Calculamos el valor para no tenerlo en cuenta al sacar el porcentaje
                if ($("#opcion_traffic").is(':checked')) {
                    var priceAdmision = calcularAdmision(adult, child);
                } else {
                    var priceAdmision = 0;
                }
                if (porcentaje > 100) {
                    porcentaje = 100;
                }
                desc_porc = (porcentaje * (full - priceAdmision)) / 100;
            }
            //DESCUENTO DE $
            error = "";
            error += validateNumber($("#descuento_valor").val(), 'Descuento Valor', true);
            var desc_valor = 0;
            if (error == "") {
                desc_valor = $("#descuento_valor").val();
                if (desc_valor > valor) {
                    desc_valor = valor;
                }
            }
            apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
            valor = parseFloat(valor) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
    //            apagar = parseFloat(apagar);
            
            apagare = apagar;
            console.log(apagar);
            //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);

            

            var other = parseFloat($("#otheramount").val());

            var fee_n = 0;
            <?php
            if ($tours->id < 1410) {
                echo "fee_n = 0.03;";
            } else {
                echo "fee_n = 0.04;";
            }
            ?>
            if (other > 0) {                
             
                var fee = other * 0.04;
                //var apagar_2 = parseFloat(other);
                var apagar_2 = parseFloat($("#otheramount").val());
                                
            } else {
                
                var fee = apagar * fee_n;
            }

            var totalPax = parseFloat(child) + parseFloat(adult);


            $("#valorComision").text(comi.toFixed(2));           
            
            
            //Calculamos total segun el tipo de pago
            
            
//            if(op_pag_conduct == "5")  { 
//                       
//                        var cero = 0;
//                        $("#saldoporpagar").val((cero).toFixed(2)); 
//                        $("#paid_driver").val((cv).toFixed(2));                        
//                        $("#balance_due").val((cero).toFixed(2));
//                        
//                        $("#totalAmount").val((apagar).toFixed(2));
//                        $("#agency_balance_due").val((((apagar) - (paid_driver)) - (pay_amount)).toFixed(2));
//                        
////                       setTimeout(function () {                               
////                                  
////                                  var balanceo = parseFloat($("#balance_due").val());
////                                  var porcbal = parseFloat(balanceo)*0.04;
////                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          
////
////                                  $("#balance_due").val((tot_balance).toFixed(2));
////                                  $("#bal_duep").val((tot_balance).toFixed(2));                                  
////                                 
////                        }, 0.01);
//                        
//                        
//                     
//            }
//            
            //CREDIT VOUCHER
            if (tipo_pago == 5) {                
                

               
               if (disponible - apagar < 0) {//Validamos saldo disponible && disponible == -1
     
//                    /*alert('Your available credit is less than the total amount to be paid');
//                    $("#opcion_pago").attr("checked",false);
//                    $("#opcion_saldo1").attr('checked',false);
//                    $("#opcion_saldo2").attr('checked',false);
//                    $("#opcion_saldo2").attr('disabled',false);
//                    $("#opcion_saldo1").attr('disabled',false);*/
                    $("#opcion_saldo2").attr('checked', true);
                    $("#opcion_saldo1").attr('disabled', true);
                    $("#opcion_saldo2").attr('disabled', false);
                    $("#opcion_pago_saldo").val('2');
                  
                    var totalbalance = 0.00;
                    
                    var cv = 0;             
                    
                    $("#saldoporpagar").val((cv).toFixed(2));
                    $("#paid_driver").val((cv).toFixed(2));
                    $("#paid_driverp").val((cv).toFixed(2));
                    $("#balance_due").val((cv).toFixed(2));
                                     
                    $("#totalAmount").val((apagar).toFixed(2));                    
                    $("#pay_amount").val((cv).toFixed(2));
                    $("#tot_amount_paid").val((cv).toFixed(2)); 
                    $("#totaltotal").text(((apagar) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val(((apagar) - (pay_amount)).toFixed(2));
                
                    
                    if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                    
                   
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
                            $("#paid_driver").val((tembalance).toFixed(2));
                            $("#balance_due").val((tembalance).toFixed(2));
                            $("#totalAmount").val((result).toFixed(2)); 
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
                            $("#totalAmount").val((result).toFixed(2)); 
                            $("#totaltotal").text((result).toFixed(2));  
                            $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                        }

                    }

               }else{
                    
                    var prep = parseFloat($("#pred_paid_amountt").val());
                    var coll = parseFloat($("#paid_drivert").val());
                    
                    $("#opcion_saldo1").attr('checked', true);
                    $("#opcion_saldo2").attr('disabled', true);
                    $("#opcion_saldo1").attr('disabled', false);
                    $("#opcion_pago_saldo").val('1');
                    
                    $("#totalPagar").val((apagar).toFixed(2));
                    $("#totaltotal").text(((apagar) - (pay_amount)).toFixed(2));
                    $("#agency_balance_due").val(((apagar) - (pay_amount)).toFixed(2));

                    $("#saldoporpagar").val((cv).toFixed(2));
                    $("#paid_driver").val((cv).toFixed(2));
                    $("#paid_driverp").val((cv).toFixed(2));
                    $("#balance_due").val((cv).toFixed(2));
                    
                    $("#tot_amount_paid").val((prep + coll).toFixed(2));
                    $("#tot_amount_paidp").val((prep + coll).toFixed(2));

                }
                
                
            } else if (tipo_pago == 1) {
                //        $("#opcion_saldo2").attr('checked',true);
                //        $("#opcion_saldo1").attr('disabled',true);
                //        $("#opcion_saldo2").attr('disabled',false);
                //        $("#opcion_pago_saldo").val('2');

                apagar = parseFloat(apagar) + parseFloat(fee);
                valor = parseFloat(valor) + parseFloat(fee);
            } else {
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_saldo1").attr('disabled', false);
            //}
     
            if (tipo_pago == 3) {
                
                var otheramount = parseFloat($("#otheramount").val());
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                //var tempwf = parseFloat($("#tempwf").val());
                var paid_driver = parseFloat($("#paid_driver").val());                
                var pay_amount = parseFloat($("#pay_amount").val());
                var total_amount = parseFloat($("#totalAmount").val());
                var total_amount_paid = parseFloat($("#tot_amount_paid").val());

                
                /***************************1***********************************ok**/
                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {

                   
                    var result = parseFloat(apagar) + parseFloat(temp_driver) +  parseFloat(temp_prepaid);
                    var totalbalance = ((result) - (paid_driver)) - (pay_amount);              
                    
                    
                    if (totalbalance < 0) {
                        
                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                    }else{
                        
                        var temp = parseFloat($("#temp").val());
                        var temp_driver = parseFloat($("#temp_driver").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var pay_amount = parseFloat($("#pay_amount").val()); 
                        var op_pag_conduct = parseFloat($("#selectcond").val());
                        var result = parseFloat(apagar) +  parseFloat(temp_driver)+ parseFloat(temp_prepaid);                        
                        var bd = parseFloat(result) - parseFloat(paid_driver);  
                        //var porcbaldue = total * 0.04;
                        //var tempbal = parseFloat(total) + parseFloat(porcbaldue);                       
                      
                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));
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
                
                /***************************2***********************************ok**/
                
                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

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
                    $("#totalAmount").val((result).toFixed(2));               
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
                
                /***************************3*************************************/

                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {
                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
//                    var op_pag_conduct = parseFloat($("#op_pago_conductor").val())
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var totalbalance = ((apagar + temp_prepaid) - (paid_driver)) - (pay_amount);                    
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid);             
                    
                                  
                    if (totalbalance < 0) {
                        
                        var tembalance = 0;
                        $("#saldoporpagar").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                    }else{
                        
                        var pay_amount = parseFloat($("#pay_amount").val());                        
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var temp = parseFloat($("#temp").val());   
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                          
                        var op_pag_conduct = parseFloat($("#selectcond").val());                        
                        var result = parseFloat(apagar) + parseFloat(temp_prepaid);

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));
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

                /***************************4*************************************/
                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val()); 
                    var pay_amount = parseFloat($("#pay_amount").val());                        
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());     
                   
                    
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);               
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    var tot_amount = parseFloat(paid_driver) + parseFloat(pay_amount);
                    
                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));
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

                /***************************1*************************************/
                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {
                    
                                
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var balance = parseFloat(result) - parseFloat(paid_driver);                    
                    var resultado = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                                   
                                       
                    if(op_pag_conduct == "3")  { 
                    
                        $("#saldoporpagar").val((result).toFixed(2));                 
                        $("#balance_due").val((balance).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));
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
                        $("#totalAmount").val((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }
                    

                }
                
                /***************************2*************************************/
                
                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                  
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                                       
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) +  parseFloat(temp_driver);
                    var apagar1 = parseFloat(apagar)
                    var resultado = parseFloat(apagar1) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver); 

                   
                   if(op_pag_conduct == "3")  { 
                       
                       
                        $("#saldoporpagar").val((result).toFixed(2));                 
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                       setTimeout(function () {                               
                                  
                                  var balanceo = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balanceo)*0.04;
                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));                                  
                                 
                        }, 0.01);
                        
                        
                     
                   }else{    
                    
                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                       
                    }
                }
                
                var other_amount = parseFloat($("#otheramount").val());
                
                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());                    
                    var temp_driver = parseFloat($("#temp_driver").val());                   
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                   
                    var resultado = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;                    
                    var bd = parseFloat(result) - parseFloat(paid_driver); 

                    if(op_pag_conduct == "3"){ 
                        
                        $("#saldoporpagar").val((result).toFixed(2));                 
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));                                  
                                 
                        }, 0.01);
                        
                        
                        
                    }else{    
                       
                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));                       
                        $("#totalAmount").val((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }
                    
                    

                    

                }
                /***************************4*************************************/
                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {
                    
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());                    
                var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                var op_pag_conduct = parseFloat($("#selectcond").val());                 
                var apagar_2 = parseFloat(other_amount);
                var pay_amount = parseFloat($("#pay_amount").val());
                var paid_driver = parseFloat($("#paid_driver").val());
                var result = parseFloat(apagar_2) + parseFloat(temp_driver);                      
                var resultado = parseFloat(apagar) + parseFloat(temp_prepaid) + parseFloat(temp_driver);                                       
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
                            $("#totalAmount").val((resultado).toFixed(2));
                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
                            $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                        }

                        if (totalbalance >= 0){
                            
                            if(op_pag_conduct == "3")  { 
                                
                                
                                $("#saldoporpagar").val((result).toFixed(2));                 
                                $("#balance_due").val((bd).toFixed(2));                                
                                $("#totalAmount").val((resultado).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                                
                                setTimeout(function () {                               
                                  
                                  var balanceo = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balanceo)*0.04;
                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));                                  
                                 
                                }, 0.01);  
                        
                              

                            }else{    

                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((resultado).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
                                $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                            }
                        }

                              

                   }
                
                document.getElementById('op_pago_id1').value = 0;
                
            }
            
            /****************************************************************/
            

            
            //CREDIT CARD NO FEE                                
            if (tipo_pago == 8) {
                
              
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());
                var other_amount = parseFloat($("#otheramount").val());
                var total_amount_paid = parseFloat($("#tot_amount_paid").val());
           
            /***************************1*************************************/
            
            
                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {

                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());  
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    
                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));                                  

                            }, 0.01);
                        
                    }


                }
            /***************************2*************************************/    
                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

                   
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());  
                    var op_pag_conduct = parseFloat($("#selectcond").val()); 
                    var balance_due = parseFloat($("#balance_due").val());
                    var pay_amount = parseFloat($("#pay_amount").val());                                   

                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                   
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));


                    if(op_pag_conduct == "3"){


                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));                                  

                            }, 0.01);

                    }                                      
                                                


                }
            /***************************3***********************************ok**/
                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());  
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var result = parseFloat(apagar) + parseFloat(temp_prepaid);                      
                    var balance_due = parseFloat($("#balance_due").val());
                    var pay_amount = parseFloat($("#pay_amount").val());                                   

                    var totalbalance = ((result) - (paid_driver)) - (pay_amount);
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);    


                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));

                    } else {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                     
                        $("#agency_balance_due").val((total).toFixed(2));

                        if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);

                        }


                    }                                      

                    
                }
                
               
                /***************************4***********************************ok**/
                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                   
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                    
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));

                            }, 0.01);

                    }

                }

                var other_amount = parseFloat($("#otheramount").val());

                /***************************1***********************************ok**/
                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {
                   
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                     
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                    var op_pag_conduct = parseFloat($("#selectcond").val());                
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);                      
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);



                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                       
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                       setTimeout(function () {                               

                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = parseFloat(balance)*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);    

                                $("#balance_due").val((tot_balance).toFixed(2)); 
                                $("#bal_duep").val((tot_balance).toFixed(2));

                       }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                       
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }

                  
                }

                /***************************2***********************************ok**/
                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {
                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                           
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                     
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                     
                        $("#agency_balance_due").val((total).toFixed(2));


                        setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);

                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));                        


                    }

                    
                }

                /***************************3***********************************ok**/
                
                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                   
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);  
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));                    
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").text((res_total).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));

                    } 

                    
                    

                }
                
                /***************************4***********************************full ok**/
                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {                 
                   
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                     
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                                 
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);                    
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
                            $("#totalAmount").val((res_total).toFixed(2));  
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {

                            if(op_pag_conduct == "3")  {


                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                             
                                $("#agency_balance_due").val((total).toFixed(2));

                                setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                                }, 0.01);


                            }else{

                                $("#saldoporpagar").val((result).toFixed(2));                    
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").text((res_total).toFixed(2));
                                $("#totaltotal").text((res_total).toFixed(2));
                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));                      
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                        }                  
                   
                }
                
                document.getElementById('op_pago_id1').value = 0;


            }

            //CASH

            if (tipo_pago == 4) {
            
            
            /*************************************1*************************************ok**/

                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());                
                var otheramount = parseFloat($("#otheramount").val());

                if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                       
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                 
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);

                    }                                        


                }
            /*************************************2*************************************ok**/
                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                     
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);

                    }                

                }
            
                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {                                     
                                        
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
                        $("#totalAmount").val((result).toFixed(2));                       
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                        
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                        if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
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
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    var op_pag_conduct = parseFloat($("#selectcond").val());

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                   
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);

                    }

                }
           
                var other_amount = $("#otheramount").val();        

    
                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                 
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                       setTimeout(function () {                               

                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = parseFloat(balance)*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                $("#balance_due").val((tot_balance).toFixed(2));
                                $("#bal_duep").val((tot_balance).toFixed(2));


                       }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }

                    
                }
            /*************************************2*************************************ok**/
            
                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                               
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver) ;                     
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));             
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);

                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));



                    }
                    
                    
                }

                
            /*************************************3*************************************ok**/
            
                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);    
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));                    
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((total).toFixed(2));

                    }

                    
                    
                }
                
                
            /*************************************4*************************************ok**/    
                
                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {
                    
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());                    
                var temp_prepaid = parseFloat($("#temp_prepaid").val());                                  
                var op_pag_conduct = parseFloat($("#selectcond").val());                    
                var pay_amount = parseFloat($("#pay_amount").val());
                var paid_driver = $("#paid_driver").val();
                var apagar_2 = parseFloat(other_amount);                    
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
                        $("#totalAmount").val((res_total).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));

                    }
                    if(bd >= 0) {

                        if(op_pag_conduct == "3")  {


                            $("#saldoporpagar").val((result).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalAmount").val((res_total).toFixed(2));                                
                            $("#agency_balance_due").val((total).toFixed(2));

                            setTimeout(function () {                               

                              var balance = parseFloat($("#balance_due").val());
                              var porcbal = parseFloat(balance)*0.04;
                              var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                              $("#balance_due").val((tot_balance).toFixed(2));
                              $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);




                        }else{
                                   
                            $("#saldoporpagar").val((result).toFixed(2));                    
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalAmount").val((res_total).toFixed(2));                                
                            $("#agency_balance_due").val((total).toFixed(2));
                        }

                    }

                                   
                }
                
                document.getElementById('op_pago_id1').value = 0;


            }

            //CHECK
            if (tipo_pago == 9) {
                
                var temp = parseFloat($("#temp").val());
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());

            /*******************************1************************************ok*/
                if (pay_amount == 0 && paid_driver == 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var agbd = (result - paid_driver).toFixed(2);   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                   
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);

                    }


                }
            /*******************************2************************************ok*/
            
                if (pay_amount == 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                       
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                        
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(apagar) + parseFloat(temp_driver);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                    
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);

                    }

                }
                
                
            /*******************************3************************************ok*/    
                if (pay_amount > 0 && paid_driver == 0 && other_amount == 0) {

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
                        $("#totalAmount").val((result).toFixed(2));                       
                        $("#agency_balance_due").val((total).toFixed(2));

                    } else {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));

                        if(op_pag_conduct == "3"){

                            setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);

                        }

                    }

                }
            /*******************************4************************************ok*/
                if (pay_amount > 0 && paid_driver > 0 && other_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                  

                    var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoporpagar").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                    
                    $("#agency_balance_due").val((total).toFixed(2));

                    if(op_pag_conduct == "3"){

                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = parseFloat(balance)*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      $("#bal_duep").val((tot_balance).toFixed(2));


                            }, 0.01);

                    }

                }
            
            
                var other_amount = $("#otheramount").val();

            /*******************************1*************************************/
                if (other_amount > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                       setTimeout(function () {                               

                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = parseFloat(balance)*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                $("#balance_due").val((tot_balance).toFixed(2));
                                $("#bal_duep").val((tot_balance).toFixed(2));


                       }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                    }
                    
                }
            /*******************************2*************************************/  
            
                if (other_amount > 0 && paid_driver == 0 && pay_amount > 0) {
                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(other_amount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                     
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    if(op_pag_conduct == "3")  {

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((total).toFixed(2));


                        setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);

                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));                       

                    }

                    
                     
                }
                
            /*******************************3*************************************/      
                if (other_amount > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                        
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                    var res_total = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);    
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if(op_pag_conduct == "3")  {


                        $("#saldoporpagar").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                       
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                        }, 0.01);



                    }else{

                        $("#saldoporpagar").val((result).toFixed(2));                    
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((total).toFixed(2));

                    }                                         

                
                    
                }
                
            /*******************************4*************************************/      
                
                if (other_amount > 0 && paid_driver > 0 && pay_amount > 0) {
                    
                  
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                      
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                        
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(other_amount);                    
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
                            $("#totalAmount").val((res_total).toFixed(2));                         
                            $("#agency_balance_due").val((total).toFixed(2));


                        }
                        if(bd >= 0) {

                            if(op_pag_conduct == "3")  {


                                $("#saldoporpagar").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                                
                                $("#agency_balance_due").val((total).toFixed(2));


                                setTimeout(function () {                               

                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = parseFloat(balance)*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                  $("#bal_duep").val((tot_balance).toFixed(2));


                                }, 0.01);




                            }else{
//                                
                                $("#saldoporpagar").val((result).toFixed(2));                    
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                                
                                $("#agency_balance_due").val((total).toFixed(2));


                                }

                         }


                    }
                    
                    document.getElementById('op_pago_id1').value = 0;
                    
                }

            //Guardar O  Pagar
            if (tipo_pago == 1 || tipo_pago == 2) {

                if (apagar - pagado <= 0) {
                    $('#enviarF').css('display', 'none');
                    $('#btn-save1').css('display', 'block');
                    $('#btn-save2').css('display', 'block');
                } else {
                    $('#enviarF').css('display', 'block');


                    //            $('#btn-save1').css('display','none');
                    //            $('#btn-save2').css('display','none');
                }
            } else {
                $('#enviarF').css('display', 'none');
                $('#btn-save1').css('display', 'block');
                $('#btn-save2').css('display', 'block');
            }

            setTotalPagar(valor, apagar, pagado);
        }
        
    }
        
        //var apagare2
        
    function setTotalPagar(valor, total, pagado) {
            
            valor = valor;
            
            var apagar = total;
            
            var other = parseFloat($("#otheramount").val());
            var temp = parseFloat($("#temp").val());
            var temp_driver = parseFloat($("#temp_driver").val());
            var payam = parseFloat($("#pay_amount").val());
            var extra = parseFloat($("#extra").val());
            var desc_porc = parseFloat($("#descuento").val());
            var desc_valor = parseFloat($("#descuento_valor").val());

            var paid_driver = parseFloat($("#paid_driver").val());
            //$("#totalAmount").text('$ ' + (valor).toFixed(2));
            //$("#totalAmount").val((valor - temp).toFixed(2));
            var diff_apagar = parseFloat(apagar) - parseFloat(pagado);

//            if(other > 0){
//                //var apagar_2 = parseFloat(other) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
//                var apagar_2 = parseFloat(other);
//                $("#saldoporpagar").val((apagar_2).toFixed(2));//+Math.ceil((apagar)).toFixed(2)
//                $('#txtSaldoPorPagar').html('Total Amount');
//                $('#txtSaldoPorPagar').css('color', '#F00');
//                
//            }else{
//                apagar = total;
//                //var apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
//                //var result1 = parseFloat(apagar1) + parseFloat(temp);
//                
//            }

            //alert(apagar);
            if (apagar >= 0 && other == 0) {

                var temp_driver = parseFloat($("#temp_driver").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                var result = parseFloat(apagar) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                //$("#saldoporpagar").text('$ ' + (apagar).toFixed(2));//+Math.ceil((apagar)).toFixed(2)
                
                    $("#saldoporpagar").val((result).toFixed(2));//+Math.ceil((apagar)).toFixed(2)
                    $('#txtSaldoPorPagar').html('Total Amount');
                    $('#txtSaldoPorPagar').css('color', '#F00');

            }else if (apagar >= 0 && other > 0){
                
                var other = parseFloat($("#otheramount").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                var result = parseFloat(other) + parseFloat(temp_driver);
                //$("#saldoporpagar").text('$ ' + (apagar * -1).toFixed(2));//Math.ceil((apagar*-1)).toFixed(2)
                //$("#saldoporpagar").val((apagar * -1).toFixed(2));//Math.ceil((apagar*-1)).toFixed(2)
                $("#saldoporpagar").val((result).toFixed(2));//+Math.ceil((apagar)).toFixed(2)
                
                $('#txtSaldoPorPagar').html('Debit note for client');
                $('#txtSaldoPorPagar').css('color', '#00F');
                $('#div_pagado').attr('class', 't-total4');
            }
            
        }
        function valorExtra() {
            //calcularTotalPago();
        }
        function valorDescuentoPorec() {
           // calcularTotalPago();
        }
        function valorDescuentoValor() {
            //calcularTotalPago();
        }
        function validarTransfer_in() {
            if ($("#opcion_transfer_in").is(':checked')) {
                if ($("#a_bus").is(':checked')) {//BUS
                    var fecha_salida = trim($('#fecha_salida').val());
                    if (!Validar(fecha_salida)) {
                        msj = '- Incorrect tours start date.';
                        titulo = 'START DATE';
                        mensaje(msj, titulo, 'fecha_salida');
                        return false;
                    }
                    var trip1 = trim($('#a_trip_no').val());
                    if (trip1 == '') {
                        msj = '- Select the trip arrival.';
                        titulo = 'ARRIVAL TRIP';
                        mensaje(msj, titulo, 'a_trip_no');
                        return false;
                    }
                    var ext_from1 = trim($("#ext_from1").val());
                    var a_id_pickup1 = trim($("#a_id_pickup1").val());
                    var a_pickup2 = trim($("#a_pickup2").val());
                    if (ext_from1 != '' && ext_from1 != 0) {
                        if (a_pickup2 == '') {
                            msj = '- Enter the extension pick up point.';
                            titulo = 'PickUp - Extension';
                            mensaje(msj, titulo, 'ext_from1');
                            return false;
                        }
                    } else if (a_id_pickup1 == -1 || a_id_pickup1 == 0 || a_id_pickup1 == '') {
                        msj = '- Enter the pick up.';
                        titulo = 'PickUp - Maimi';
                        mensaje(msj, titulo, 'a_pickup1');
                        return false;
                    }
                } else if ($("#a_vip").is(':checked')) {//VIP
                    var hora1 = trim($("#hora1").val());
                    if (hora1 == '') {
                        msj = '- Enter the time of private service in Miami.';
                        titulo = 'Time your private service in Miami';
                        mensaje(msj, titulo, 'hora1');
                        return false;
                    }
                    var city = trim($("#city").val());
                    if (city == '') {
                        msj = '- Enter the city of private service in Miami.';
                        titulo = 'City your private service in Miami';
                        mensaje(msj, titulo, 'city');
                        return false;
                    }
                    var address = trim($("#address").val());
                    if (address == '') {
                        msj = '- Enter the address of private service in Miami.';
                        titulo = 'Address your private service';
                        mensaje(msj, titulo, 'address');
                        return false;
                    }
                    var zipcode = trim($("#zipcode").val());
                    if (zipcode == '') {
                        msj = '- Enter the zipcode of private service in Miami.';
                        titulo = 'Zipcode  your private service';
                        mensaje(msj, titulo, 'zipcode');
                        return false;
                    }
                    var phone = trim($("#phone").val());
                    if (phone == '') {
                        msj = '- Enter the phone of private service in Miami.';
                        titulo = 'Phone  your private service';
                        mensaje(msj, titulo, 'phone');
                        return false;
                    }
                } else if ($("#a_airpoty").is(':checked')) {//AIRPORT
                    var airlinearrival = trim($("#airlinearrival").val());
                    if (airlinearrival == '') {
                        msj = '- Enter Airline of arrival at orlando.';
                        titulo = 'Airline arrival orlando';
                        mensaje(msj, titulo, 'airlinearrival');
                        return false;
                    }
                    var flightarrival = trim($("#flightarrival").val());
                    if (flightarrival == '') {
                        msj = '- Enter the airline flight arrival to horlando.';
                        titulo = 'Flight arrival orlando';
                        mensaje(msj, titulo, 'flightarrival');
                        return false;
                    }
                    var hora1 = trim($("#hora1").val());
                    if (hora1 == '') {
                        msj = '- Enter the time of arrival in orlando.';
                        titulo = 'Time  arrival orlando';
                        mensaje(msj, titulo, 'hora1');
                        return false;
                    }
                } else if ($("#a_car").is(':checked')) {
                    //BY CAR
                    var hora1 = trim($("#hora1").val());
                    if (hora1 == '') {
                        msj = '- Enter the time of arrival in orlando.';
                        titulo = 'Time  arrival orlando';
                        mensaje(msj, titulo, 'hora1');
                        return false;
                    }
                }
            }
            return true;
        }
        function validarTransfer_out() {
            if ($("#opcion_transfer_out").is(':checked')) {
                if ($("#d_bus").is(':checked')) {//BUS
                    var fecha_retorno = trim($('#fecha_retorno').val());
                    //            if(!Validar(fecha_retorno)){
                    //                msj = '- Incorrect final date of the tour.';
                    //                titulo = 'END DATE';
                    //                mensaje(msj,titulo,'fecha_retorno');
                    //                return false;
                    //            }
                    var trip2 = trim($('#d_trip_no').val());
                    if (trip2 == '') {
                        msj = '- Select the trip departure.';
                        titulo = 'DEPARTURE TRIP';
                        mensaje(msj, titulo, 'd_trip_no');
                        return false;
                    }
                    var ext_to2 = trim($("#ext_to2").val());
                    var d_id_pickup1 = trim($("#d_id_pickup1").val());
                    var d_pickup2 = trim($("#d_pickup2").val());
                    if (ext_to2 != '' && ext_to2 != 0) {
                        if (d_pickup2 == '') {
                            msj = '- Enter the extension pick up point.';
                            titulo = 'PickUp - Extension';
                            mensaje(msj, titulo, 'd_pickup2');
                            return false;
                        }
                    } else if (d_id_pickup1 == -1 || d_id_pickup1 == 0 || d_id_pickup1 == '') {
                        msj = '- Enter the pick up.';
                        titulo = 'PickUp - Maimi';
                        mensaje(msj, titulo, 'd_pickup1');
                        return false;
                    }
                } else if ($("#d_vip").is(':checked')) {//VIP
                    var hora2 = trim($("#hora2").val());
                    if (hora2 == '') {
                        msj = '- Enter the time of private service in Orlando.';
                        titulo = 'Time your private service in Miami';
                        mensaje(msj, titulo, 'hora2');
                        return false;
                    }
                    var city2 = trim($("#city2").val());
                    if (city2 == '') {
                        msj = '- Enter the city of private service in Orlando.';
                        titulo = 'City your private service in Orlando';
                        mensaje(msj, titulo, 'city2');
                        return false;
                    }
                    var address2 = trim($("#address2").val());
                    if (address2 == '') {
                        msj = '- Enter the address of private service in Orlando.';
                        titulo = 'Address your private service';
                        mensaje(msj, titulo, 'address2');
                        return false;
                    }
                    var zipcode2 = trim($("#zipcode2").val());
                    if (zipcode2 == '') {
                        msj = '- Enter the zipcode of private service in Orlando.';
                        titulo = 'Zipcode  your private service';
                        mensaje(msj, titulo, 'zipcode2');
                        return false;
                    }
                    var phone2 = trim($("#phone2").val());
                    if (phone2 == '') {
                        msj = '- Enter the phone of private service in Orlando.';
                        titulo = 'Phone  your private service';
                        mensaje(msj, titulo, 'phone2');
                        return false;
                    }
                } else if ($("#d_airpoty").is(':checked')) {//AIRPORT
                    var airlinearrival = trim($("#airlinedeparture").val());
                    if (airlinearrival == '') {
                        msj = '- Enter Airline of departure in  orlando.';
                        titulo = 'Airline arrival orlando';
                        mensaje(msj, titulo, 'airlinedeparture');
                        return false;
                    }
                    var flightdeparture = trim($("#flightdeparture").val());
                    if (flightdeparture == '') {
                        msj = '- Enter the airline flight departure in orlando.';
                        titulo = 'Flight departure orlando';
                        mensaje(msj, titulo, 'flightdeparture');
                        return false;
                    }
                    var hora2 = trim($("#hora2").val());
                    if (hora2 == '') {
                        msj = '- Enter the time of departure in orlando.';
                        titulo = 'Time  departure orlando';
                        mensaje(msj, titulo, 'hora2');
                        return false;
                    }
                } else if ($("#d_car").is(':checked')) {//BY CAR
                    //Nada
                    var hora2 = trim($("#hora2").val());
                    if (hora2 == '') {
                        msj = '- Enter the time of arrival in orlando.';
                        titulo = 'Time  arrival orlando';
                        mensaje(msj, titulo, 'hora2');
                        return false;
                    }
                }
            }
            return true;
        }
        function validarHotel() {
            if ($("#opcion_hotel").is(':checked')) {
                var fecha_salida = trim($('#fecha_salida').val());
                if (!Validar(fecha_salida)) {
                    msj = '- Incorrect tours start date.';
                    titulo = 'START DATE';
                    mensaje(msj, titulo, 'fecha_salida');
                    return false;
                }
                var fecha_retorno = trim($('#fecha_retorno').val());
                //        if(!Validar(fecha_retorno)){
                //            msj = '- Incorrect final date of the tour.';
                //            titulo = 'END DATE';
                //            mensaje(msj,titulo,'fecha_retorno');
                //            return false;
                //        }
                var hotel_id_select = $("#hotel_id_select").val();


                if (hotel_id_select == -1 || hotel_id_select == undefined) {
                    msj = '- Select hotel accommodation during the tour.';
                    titulo = 'Select Hotel';
                    mensaje(msj, titulo, 'hotel_name');
                    return false;
                }
            }
            return true;
        }
        function validarPark() {

            if ($("#opcion_traffic").is(':checked')) {

                var fecha_salida = trim($('#fecha_salida').val());
                if (!Validar(fecha_salida)) {
                    msj = '- Incorrect tours start date.';
                    titulo = 'START DATE';
                    mensaje(msj, titulo, 'fecha_salida');
                    return false;
                }
                var fecha_retorno = trim($('#fecha_retorno').val());
                //        if(!Validar(fecha_retorno)){
                //            msj = '- Incorrect final date of the tour.';
                //            titulo = 'END DATE';
                //            mensaje(msj,titulo,'fecha_retorno');
                //            return false;
                //        }
                var numPark = $("#numPark").val();
                if (numPark == 0) {
                    msj = '- Select the park you want to visit on the tour.';
                    titulo = 'Select parks';
                    mensaje(msj, titulo, 'park_name');
                    return false;
                }
            }
            return true;
        }
        function validarSeleccionServicio() {
            if (!$("#opcion_transfer_in").is(':checked') && !$("#opcion_transfer_out").is(':checked')
                    && !$("#opcion_hotel").is(':checked') && !$("#opcion_traffic").is(':checked')) {
                msj = '- You must select at least one service to sell.';
                titulo = 'Select service';
                mensaje(msj, titulo, 'opcion_transfer_in');
                return false;
            }
            return true;
        }
        function validarSeleccionTipoPago() {
            var tipo_pago = 0;
            var num = document.getElementsByName('opcion_pago').length
            for (var i = 0; i < num; i++) {
                if (document.getElementsByName('opcion_pago').item(i).checked) {
                    tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
                }
            }
            if (tipo_pago == 0) {
                //        msj = '- Select the payment method.';
                //        titulo = 'Payment method ';
                //        mensaje(msj,titulo,'opcion_pago');
                //        return false;
            }
            var id_agency = $("#id_agency").val();
            if (id_agency != -1) {
                if (!$("#opcion_saldo1").is(':checked') && !$("#opcion_saldo2").is(':checked')) {
                    msj = '- Select the payment option (FULL / BALANCE).';
                    titulo = 'Payment option ';
                    mensaje(msj, titulo, 'uagency');
                    return false;
                }
            }
            return true;
        }
        function validarFormulario() {

            //Cliente
            var msj = '';
            var titulo = '';
            var idcliente = $("#idCliente").val();
            if (idcliente == '-1' && ($("#firstname1").val() == '' && $("#lastname1").val() == '')) {
                msj = '- Enter customer data.';
                titulo = 'SEARCH CLIENT';
                mensaje(msj, titulo, 'cliente');
                return false;
            }
            //Agencia
            var id_agency = $("#id_agency").val();
            if (id_agency != -1) {
                var id_auser = $("#id_auser").val();
                //        if(trim($("#uagency").val()) == ''){
                //            msj = '- Enter the employee of the agency.';
                //            titulo = 'EMPLOY ';
                //            mensaje(msj,titulo,'uagency');
                //            return false;
                //        }
            }

            //Notas     
            if ($("#comments").val() == "") {
                alert("Please Type One Note");
                //$("#comments").focus();
                return false;
            }

            //Transfer in
            if (!validarTransfer_in()) {
                return false;
            }
            //Transfer out
            if (!validarTransfer_out()) {
                return false;
            }
            //Hotel
            if (!validarHotel()) {
                return false;
            }


            //Park
            if (!validarPark()) {
                return false;
            }
            //servicios
            if (!validarSeleccionServicio()) {
                return false;
            }
            //Tipo Pago
            if (!validarSeleccionTipoPago()) {
                return false;
            }
            return true;
        }
        function irApagar() {
            if (validarFormulario()) {
                $("#form1").attr('target', '_blank');
                $("#form1").attr('action', '<?php echo $data['rootUrl']; ?>admin/tours/payment');
                if ($("#a_bus").is(':checked')) {
                    $("#trip1a").val($("#priceTransporA1").html());
                    $("#trip1c").val($("#priceTransporC1").html());
                }
                if ($("#d_bus").is(':checked')) {
                    $("#trip2a").val($("#priceTransporA2").html());
                    $("#trip2c").val($("#priceTransporC2").html());
                }
                var hilo = setInterval("estadoPago()", 5000);
                $("#form1").submit();
            }
        }
        function estadoPago() {
            $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/tours/payment');
        }
        function cargarParkRegistrados() {
            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var id_agency = $("#id_agency").val();
            var url = '<?php echo $data['rootUrl']; ?>admin/tours/listTablaPark/' + adult + '/' + child + '/' + id_agency;
            $("#tablePark").load(url);
        }


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
                position: [left - 260, top + 50],
            });
            $("#dialog").dialog("open");
        }
        function detalles_rastro(id) {
            $("#conten_rastro").load('<?php echo $data['rootUrl']; ?>admin/tours/edit/rastro/' + id);
            $("#dialog-message").dialog({
                modal: true,
                width: 600,
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                    }
                }
            });
        }
        function erase_transferout() {
            $("#dialog_message5").dialog({
                buttons: [
                    {
                        text: 'Yes',
                        click: function () {
                            $("#toutwcharge").val('1');
                            $("#mascaraP").hide();
                            $(this).dialog('close');
                        }
                    },
                    {
                        text: 'No',
                        click: function () {
                            $("#toutwcharge").val('0');
                            $("#mascaraP").hide();
                            calcularTotalPago();
                            $(this).dialog('close');
                        }
                    }
                ]
            });
        }
        function dialog7() {
            $("#dialog_message7").dialog({
                buttons: [
                    {
                        text: 'Change',
                        click: function () {
                            redisNights();
                        }
                    }, {
                        text: 'Cancel',
                        click: function () {
                            $("#dialog_message6").dialog('close');
                            $("#dialog_message7").dialog('close');
                            $("#mascaraP").hide();
                        }
                    }
                ]
            });
        }
        function redisNights() {
            var hotel_id = $("#hotel_id").val();
            var f_sal = $("#fecha_salida").val();
            var f_ret = $("#fecha_retorno").val();
            var datosroom = validarAcomodacion();
            var id_agency = $("#id_agency").val();
            //var nfree = $("#fdadult").val();
            var nfree = $("#nochesfree").val();
            var nfeeb = 0;
            if ($("#free_buffet").is(':checked')) {
                nfeeb = 1;
            }
            var buff = 0;
            if ($("#buffetYes").is(':checked')) {
                buff = 1;
            }
            var lindex = $("#lastindex_hotel").val();
            var renights = $("#renights").val();
            var slugfield = $("#slugfield").val();
            var noches_escogidas = $("#noches_escogidas").val();

            console.log($("#hotelfieldset").serialize());
            $.post('<?php echo $data['rootUrl'] ?>admin/tours/redishotels/' + slugfield + '/' + hotel_id + '/' + f_sal + '/' + f_ret + datosroom + '/' + id_agency + '/' + buff + '/' + nfree + '/' + nfeeb + '/' + lindex + '/' + renights, $("#hotelfieldset").serialize(), noches_escogidas, function (data) {
                $("#debbug").html(data)
            })
        }
        function reloadHoteles() {
            console.log('recalculando tabla de hoteles');
            var id = $("#slugfield").val();
            //    $("#tablehoteles").children("table").children("tbody").load('<?php echo $data['rootUrl'] ?>admin/tours/reloadhotels/'+id,function(data){
            //        calcularTotalPago();
            //    });
        }
    </script>
    <?php echo $data['script']; ?>
    <script>
        $(function () {
            $("#agency").keyup(function () {
                if ($(this).val() == "") {
                    //$("#uagency").attr('disabled', true);
                    $('#uagency').val('');
                    $("#id_agency").val(-1);
                    $("#tableTypeSaldo").hide();
                    $("#opcion_pago_agency, #label_tipo_agency").parent().hide();
                } else {
                    $("#opcion_pago_agency, #label_tipo_agency").parent().show();
                }
            });
            reloadHoteles();
            $("#fecha_retorno").change(function () {
                if (parseInt($("#nhoteles").val()) > 1) {
                    if (parseInt($("#initial_nights").val()) < parseInt($("#nights").val())) {
                        var id = $("#slugfield").val();
                        var d = diferencia();
                        $("#noches_escogidas").val((d));
                        var new_day = $("#fecha_retorno").val();
                        $.get('<?php echo $data['rootUrl'] ?>admin/tours/add_night_hotel/' + id + '/' + new_day, function (data) {
                            $("#debbug").html(data);
                        });
                    }
                } else {
                    console.log('no esta redistribuido');
                }
            });
            $("#cliente").change(function () {
                if (trim($("#cliente").val()) == '') {
                    $("#idCliente").val('-1');
                }
            });
            $("#uagency, #agency").keyup(function (evt) {
                if (evt.keyCode == 8) {
                    if (trim($("#uagency").val()).length == 0) {
                        console.log('limpiado');
                        $("#id_auser").val("-1");
                    }
                }
            });
<?php
if ($tours->op_pago != 0) {
    $op_pago = $tours->op_pago;
} else {
    if ($tours->pago == "COLLECT ON BOARD") {
        list($primero, $segundo) = explode("-", $tours->tipo_pago);
        if (trim($primero) == "CREDIT CARD WITH FEE") {
            $op_pago = 3;
        }
        if (trim($primero) == "CREDIT CARD NO FEE") {
            $op_pago = 8;
        }
        if (trim($primero) == "CASH") {
            $op_pago = 4;
        }
        if (trim($primero) == "CHECK") {
            $op_pago = 9;
        }
    }
    if ($tours->pago == "PRE-PAID") {
        list($primero, $segundo) = explode("-", $tours->tipo_pago);
        if (trim($primero) == "CREDIT CARD WITH FEE") {
            $op_pago = 1;
        }
        if (trim($primero) == "CREDIT CARD NO FEE") {
            $op_pago = 2;
        }
        if (trim($primero) == "CASH") {
            $op_pago = 6;
        }
        if (trim($primero) == "CHECK") {
            $op_pago = 10;
        }
    }
}
?>
            var sel_payment = "<?php echo $op_pago; ?>";
            var sel_payment2 = "<?php echo $op_pago_conductor; ?>";
            //alert(sel_payment);
            $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
            $("#op_pago_conductor option[value=" + sel_payment2 + "]").attr("selected", "selected");
            
            
        });

    </script>

    <script>

        function combo()
        {

            $(document).ready(function () {
                // Así accedemos al Texto de la opción seleccionada
                var valor = $("#rate option:selected").html();
                //alert(valor);

                tour_name.value = valor;

            });

        }
    </script>

<!--    <script type="text/javascript" src="../jquery.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function () {


            setTimeout(function () {
                $(".content").fadeOut(100);
                ocultar('parks_edit');
                $("#opcion_parks_edit").val(0);
                $("#opcion_parks_edit").attr('checked', false);
                $("#opcion_parks_edit").attr('disabled', 'disabled');
                $

                            // $("#opcion_traffic").val(0);
                            // $("#opcion_traffic").attr('checked', true);
                            // $("#opcion_traffic").click();
                var parques = $('#numPark').val();
                            //alert(parques);
                if (parques > 0) {
                    $("#opcion_traffic").click();
                    $("#add_attraction_list").trigger('click');

                }
                            //if(id_agencia != 45){
                            //$('#bt2').click();  
                            //$('#bt1').click();          
                
                            //}
            }, 1000);
//            
            setTimeout(function () {
                delete_park("_0");
            }, 1000);

            setTimeout(function () {
                $('#tarifario').click();
                document.getElementById('flotador').style.display = '';
                //alert('Cargado');

            }, 300);
            
            var id_agencia = document.getElementById('id_agency').value;

            if (id_agencia == 45) {
                //alert('SuperTours');               

                document.getElementById('bt1').style.display = 'none';
                document.getElementById('bt2').style.display = 'none';

                // $('#bt1').click();

            } else {
                // alert('Agencia')
                document.getElementById('bt1').style.display = '';
                document.getElementById('bt2').style.display = '';
                document.getElementById('bt3').style.display = 'none';

                //$('#bt2').click(); 


            }


        });

    </script>

    <script type="text/javascript">

        function Ocultarmenu() {

            div = document.getElementById('menu-bar');
            div.style.display = 'none';
            div2 = document.getElementById('hd-menu');
            div2.style.display = 'none';
        }

    </script>

    <script type="text/javascript">

        function ComprobarScreen()
        {
            window.moveTo(0, 0);
            window.resizeTo(screen.width, screen.height);
            window.fullScreen;
            
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
                document.getElementById("save2").style.marginTop = "-1543px";

            }

            if (window.screen.availWidth == 1440) {
                window.parent.document.body.style.zoom = "110%";
                document.getElementById("save2").style.marginTop = "-1485px";

            }

            if (window.screen.availWidth == 1600) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1485px";

            }

            if (window.screen.availWidth == 1680) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1490px";

            }

            if (window.screen.availWidth > 1680) {
                window.parent.document.body.style.zoom = "125%";
                document.getElementById("save2").style.marginTop = "-1500px";

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
       function redondea(sVal, nDec){ 
           
        var n = parseFloat(sVal); 
        var s = "0.00"; 
        
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
           
        //document.form1.pago_driver.value = redondea(document.form1.pago_driver.value, nDec); 
        document.form1.descuento_valor.value = redondea(document.form1.descuento_valor.value, nDec); 
        document.form1.extra.value = redondea(document.form1.extra.value, nDec); 
        document.form1.saldoporpagar.value = redondea(document.form1.saldoporpagar.value, nDec);
        document.form1.balance_due.value = redondea(document.form1.balance_due.value, nDec);
        
         }, 1500);
       
       } 
    </script> 
    
   <script type="text/javascript">
    
    function valida_voucher(){
        

                 
    var idagencia = document.getElementById('idagencia').value;
       
        if(idagencia == "1"){
           
           
           document.getElementById('op_pago_conductor')[4].disabled = false; 
          
           
       }else{
           
         
           document.getElementById('op_pago_conductor')[4].disabled = true; 
           
           
       }       
             
   

    }
    
</script>

<script type="text/javascript">
$('#agency').change(function () {

        //$('#uagency').attr('disabled', 'disabled');
       
        $('#uagency').val('');
        $('#id_auser').val('');
        $('#id_agency').val('-1');
        

    });
</script>


<script type="text/javascript">
    
    function facturado() {
        
        var estado = "<?php echo $estado_multiday; ?>";
        
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

<script type="text/javascript">
    
    function sur_2015()
    {     
        var fecha_creacion = "<?php echo $fecha_crea; ?>";
        
         if(fecha_creacion < '2018-05-31 00:00:00'){       
            document.getElementById('sur2015').style.display = "";         
         }else{           
            document.getElementById('sur2015').style.display = "none";
         }       
        
        
    }

</script>

<!--<script type="text/javascript">
    
    function voucher()
    {     
        var pago_conductor = "<?php /*echo $op_pago_conductor;*/ ?>";
        
         if(pago_conductor === '5'){  
             
            //alert("aqui");
             
            document.getElementById('op_pago_conductor').value = "8";   
            
            setTimeout(function () {
           
                $('#op_pago_conductor').click();  
                document.getElementById('op_pago_conductor').value = "5";   
            }, 1500);

            
            
         }else{     
             
            //document.getElementById('sur2015').style.display = "none";
            
         }       
        
        
    }

</script>-->