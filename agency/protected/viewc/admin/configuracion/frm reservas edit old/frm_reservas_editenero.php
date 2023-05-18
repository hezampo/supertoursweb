<?php
if (isset($this->data['reserve']) && isset($_SESSION['login'])) {
    $valida = false;
    $reserva = $data['reserve'];
//    print_r($reserva);
//    exit;
    $subto = $data['subto'];
    $rastro = $data['rastro'];
    $pagado = $data['pagado'];
    //print($pagado);
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
    $var = explode('-', $dato_pago);
    $typo_pago = strtoupper($var[0]);
    if (isset($var[1])) {
        $typo_saldo = $var[1];
        $rest_comision = 0;
    } else {
        $typo_saldo = 'FULL';
        $rest_comision = isset($reserva_a->agency_fee) ? $reserva_a->agency_fee : 0;
    }

//    if($agencia->type_rate == 0){
//        $precioExt = $extencion1->precio + $extencion2->precio + $extencion3->precio + $extencion4->precio ;
//    }else{
//        $precioExt = $extencion1->precio_neto + $extencion2->precio_neto + $extencion3->precio_neto + $extencion4->precio_neto ;
//    }
//    $transporadult = $reserva->precioA/$reserva->pax;
//    if ($reserva->pax2 != 0){
//        $transporechil = $reserva->precioN/$reserva->pax2;
//    }else{
//        $transporechil = 0;
//    }
//    $subtoadult = $reserva->precioA + ($precioExt * $reserva->pax);
//    $subtochild = $reserva->precioN + ($precioExt*$reserva->pax2);
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

    if ($typo_pago == strtoupper('CREDIT CARD WITH FEE')) {
        if ($reserva->id < 17670) {
            $fee = $totaltotal * 0.03;
        } else {
            $fee = $totaltotal * 0.04;
        }
    } else {
        $fee = 0;
    }
    $descuento = $reserva->descuento_procentaje;
    $val_procentaje = 0;
    if ($descuento > 0) {
        $val_procentaje = ($totaltotal * $descuento) / 100;
    }


    $totaltotal = $totaltotal + $fee;
    //print_r($totaltotal);
    //conf Other Amount
    if ($reserva->otheramount != 0) {
        $saldoxPagar = $reserva->otheramount - $pagado;
    } else {
        $saldoxPagar = $totaltotal - $pagado;
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






<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--jquery para el calendario-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>


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
    .cerati{
        /* IE10+ */ 
        background-image: -ms-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* Mozilla Firefox */ 
        background-image: -moz-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* Opera */ 
        background-image: -o-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* Webkit (Safari/Chrome 10) */ 
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #1E4D82), color-stop(51, #33449C), color-stop(75.5, #1B1478), color-stop(100, #E1E0FF));

        /* Webkit (Chrome 11+) */ 
        background-image: -webkit-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* W3C Markup */ 
        background-image: linear-gradient(to top right, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />

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
                position: [left - 260, top + 50],
            });
            $("#dialog").dialog("open");
        }
        $("#btn-rastro").click(function () {
            var posicion = $(this).position();
            mosrtarRastro(posicion.left, posicion.top);
        });

    });
</script>

<?php if (isset($_GET['menssage'])) { ?>
    <div class="success"><?php echo $_GET['menssage']; ?></div>
<?php } ?>
<?php if (isset($_GET['error'])) { ?>
    <div class="error"><?php echo $_GET['error']; ?></div>
<?php } ?>
<!--<div id="header_page" >-->
<div id="header_page" style="height:50px; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
    <div class="header">
        <table style="width:500px;" border="0">
            <tr>
                <td width="30%">Reserves [ edit ] </td>
                <td width="10%" id="bnt-trips" class="btn" style="cursor:pointer;"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/calendar_aviso32x32.png" /></td>
                <td>ID <?php echo $reserva->id; ?></td>

                <td width="10%" style="padding:5px;"><div id="mensajeTrip" class="temporizador">00:00</div></td>
            </tr>
        </table>
    </div>
    <div  id="toolbar">

        <div class="toolbar-list">
            <ul>

                <li class="btn-toolbar" id="">
                    <form action="<?php echo $data['rootUrl'] ?>admin/reporte/cargar" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
                        <input id="variable" style="display:none" name="variable"  value="<?php echo $reserva->id; ?>"  />
                        <!--<input  type="submit" value="Summary" />-->
                        <input  type="submit" value="Summary" style="margin-top: 2px; margin-left: -54px;padding: 10px; color: #AC1B29;font-weight: 700;" />
                    </form>
                    <script type="text/javascript">
                        var variableJs = document.getElementById("variable").value;//"2259";

                        function onEnviar() {
                            document.getElementById("variable").value = variableJs;
                        }
                    </script>

                </li>            

                <li class="btn-toolbar" id="btn-rastro">
                    <a  class="link-button" id="btn-rastro">
                        <span class="icon-32-rastro" title="Mostrar Rastro">&nbsp;</span>

                        Traces
                    </a>
                </li>
                <li class="btn-toolbar" id="btn-save1">
<!--                    <a  class="link-button" id="btn-save1"><span class="icon-32-save" title="Guardar">&nbsp;</span>Save</a>-->
                    <a class="link-button" id="btn-save1"> <i class="fa fa-floppy-o fa-3x" title="Guardar" style="margin-left: 4px; color:#4B0082;"></i><br>&nbsp;Save</a>
                </li>


                <li class="btn-toolbar" id="btn-cancel1">
<!--                    <a  class="link-button" ><span class="icon-back" title="Regresar">&nbsp;</span>Back</a>-->
                    <a class="link-button"><i class="fa fa-arrow-left fa-3x" title="Regresar" style="color: #33449C;"></i><br>Back</a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- header options -->

<form  id="formula" class="form" action="<?php echo $data['rootUrl']; ?>admin/reservas/save-edit-reserve" method="post" name="formula" >


    <div id="info-group2">
        <div id="cancelation">
            <div class="ho">CANCELATION <span>#</span></div>
            <div id="cancel">00000</div>
        </div>
        <div id="reservation">
            <div class="ho" style="color: #fff;background: #bb0000; height:12px;">RESERVATION <span>#</span></div>
            <div id="reser"><?php echo $reserva->codconf; ?><input type="hidden" /></div>
        </div>
        <div id="status">
            <div class="ho" style="color: #fff;background: #bb0000; height:12px;">STATUS</div>
            <div id="stat"><?php echo $reserva->estado; ?></div>
        </div>
        <div id="status-change"  >
<!--            <div  style="width: 102px;color:#4B0082;"><strong>CHANGE STATUS</strong></div>-->
            <div class="ho" style="color: #fff;background: #bb0000;padding: 4px;margin-top: 0px; margin-left:47px; width:44px; ">STATUS</div>
            <select style="width:112px; margin-left: -4px; margin-top:-2px;" id="estado" name="estado">
                <option></option>
                <option <?php
                if ($reserva->estado == 'CONFIRMED' || $reserva->estado == 'INVOICED') {
                    echo ' selected="selected" ';
                };
                ?>  value="CONFIRMED">CONFIRMED</option>
                <option <?php
                if ($reserva->estado == 'QUOTE') {
                    echo ' selected="selected" ';
                };
                ?>  value="QUOTE">QUOTE</option>
                <option value="NOT SHOW W/ CHARGE" <?php
                if ($reserva->estado == 'NOT SHOW W/ CHARGE') {
                    echo ' selected="selected" ';
                };
                ?>>NOT SHOW W/ CHARGE</option>
                <option value="NOT SHOW W/O CHARGE" <?php
                if ($reserva->estado == 'NOT SHOW W/O CHARGE') {
                    echo ' selected="selected" ';
                };
                ?>>NOT SHOW W/O CHARGE</option>
                <option <?php
                if ($reserva->estado == 'CANCELED') {
                    echo ' selected="selected" ';
                };
                ?>  value="CANCELED">CANCELED</option>
            </select>
        </div>
    </div>

    <!--    <div id="content_page"  >-->
    <div id="content_page" style="width: 1000px;z-index:1; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
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
                        <fieldset    id="inputype" style="margin-left:-6px; width:470px; border-radius: 3px 120px 0px 80px;" class="rojo"><legend style="border:1px solid #B83A36; background:#fff;margin-left:5px;">INPUT TYPE</legend>
                            <div id="opera" class="input">
                                <table width="100%" >
                                    <tr align="left">

                                        <td >
                                            <label style="color:#FFFFFF;" id="label">CALL CENTER</label>
                                        </td>
                                        <td >
<!--                                            <input name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>-->
                                            <input style="margin-left:18px; width:275px; border-top-left-radius: 25px; text-align: center; border-top-right-radius: 25px;" name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                                        </td>

                                    </tr>
                                    <tr><td colspan="2" >
                                            <table width="100%">
                                                <tr>
                                                    <td width="10%">
                                                        <label style="color:#FFFFFF;">AGENCY</label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input style="border-bottom-left-radius: 17px; margin-top:12px; margin-left:10px; " name="agency" type="text"  id="agency" size="19" maxlength="30" value="<?php echo $agencia->company_name; ?>"  autocomplete="off"  disabled="disabled"  />
                                                            <input type="hidden" size="4" value="<?php echo $agencia->id; ?>" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="<?php echo $agencia->type_rate; ?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>

                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <label style="margin-left:16px; color:#FFFFFF;">Employ</label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input style="border-top-right-radius: 25px; width:150px;margin-top:10px; margin-left:18px;" name="uagency" type="text"  id="uagency" size="11" maxlength="30" value="<?php echo ($agencia->id != -1) ? $userA->firstname . ' ' . $userA->lastname : ''; ?>"  />
                                                            <input type="hidden" size="4" value="<?php echo ($agencia->id != -1) ? $userA->id : ''; ?>" name="id_auser" id="id_auser" autocomplete="off" />
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr><td colspan="2" >&nbsp;</td></tr>
                                    <tr><td colspan="2">
                                            <table style="margin-top:-8px; margin-right:70px;" align="center" cellspacing="10">
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
                        <fieldset id="liderpax" style="margin-left:-1px; margin-top:-1px; border-radius: 130px 3px 80px 0px; width:470px;" class="cerati"><legend style="border:1px solid #00C; margin-left:64px; background:#fff;">LEADER PASS</legend>
                            <table>
                                <tr>
                                    <td >
                                        <div id="opera" class="input" style="padding-top:5px;">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label style="color:#FFFFFF; margin-left:30px;" id="label" >SEARCH </label>
                                                    </td>
                                                    <td>
                                                        <div class="ausu-suggest" id="opera">
                                                            <input style="margin-left:4px; width:354px; border-top-left-radius: 17px;border-top-right-radius: 17px;" type="text" size="35" value="<?php
                                                            if (isset($cliente) && isset($reserva)) {
                                                                if ($cliente->id == $reserva->id_clientes) {
                                                                    echo $cliente->lastname . " " . $cliente->firstname . " - E-Mail -" . $cliente->username;
                                                                }
                                                            }
                                                            ?>" name="leader" id="leader" autocomplete="off" />

                                                            <input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
                                                        </div>
                                                    </td>
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
                                            <table width="100%">
                                                <tr>
                                                    <td width="" align="right">

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
                                                    </td>
                                                    <td width="">
                                                        <input style="margin-left:10px; width:140px;" name="firstname1" type="text"  id="firstname1" size="15" maxlength="15" value="<?php
                                                        if (isset($reserva)) {
                                                            echo $reserva->firsname;
                                                        }
                                                        ?>" />	
                                                    </td>
                                                    <td width="" align="right"> 
                                                        <label style="color:#FFFFFF;" id="labeldere12" >LAST NAME </label>
                                                    </td>
                                                    <td width="">  
                                                        <input style="margin-left:6px; width:134px;" name="lastname1" type="text"  id="lastname1" size="15" maxlength="15" value="<?php
                                                        if (isset($reserva)) {
                                                            echo $reserva->lasname;
                                                        }
                                                        ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"> 
                                                        <label style="color:#FFFFFF;" id="labeldere12">E-MAIL </label>
                                                    </td>
                                                    <td>
                                                        <input style="margin-left:10px; margin-top:6px; width:140px; border-bottom-left-radius: 17px;" name="email1" type="text"  id="email1" size="15" value="<?php
                                                        if (isset($reserva)) {
                                                            echo $reserva->email;
                                                        }
                                                        ?>"/>
                                                    </td>
                                                    <td align="right">
                                                        <label style="color:#FFFFFF;" id="labeldere12">PHONE </label>
                                                    </td>
                                                    <td>
                                                        <input style="margin-top: 6px; margin-left:0px; width:134px; border-bottom-right-radius: 25px;" name="phone1" type="text"  id="phone1" size="15" maxlength="15" value="<?php
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
                                                    </td>

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
            <fieldset id="boo" style="width:952px; height: 65px; margin-top: 5px; border-radius: 26%;margin-top: 0%;" class="booking2" ><legend style="border:1px solid #00C; background:#fff;">BOOKING</legend>
                <input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php
                if (isset($reserva)) {
                    if ($reserva->tipo_ticket == 'oneway') {
                        echo 1;
                    } else {
                        echo 2;
                    }
                }
                ?>"/>

                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#00f;"><strong>ONE WAY</strong> </label> <input name="tipo_ticket"  id="oneway" onclick="capturar();" type="radio" value="1"
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
                    <select name="tipo_pass" id="tipo_pass" disabled="disabled">
                        <option style="color:red;" value="0">NO RESIDENT</option>
                        <option style="color:blue;" value="1">RESIDENT</option>
                    </select>

                </div>

                <div id="opera" class="input" >
                    <input style="margin-top:31px; margin-right:2px;" name="byr" type="checkbox" value="1" <?php
                    if (isset($reserva)) {
                        if ($reserva->customer_disabilities == 1) {
                            echo ' checked ';
                        }
                    }
                    ?> />
                    <label id="labeldere" style=" margin-left:-50x; margin-top:25px; width: 165px; color:#4B0082;"><strong>Customer With Disabilities</strong></label>                  
                </div>
                <div id="opera" class="input"  style="padding-top:10px; clear:left;">
                    <label style="width:45px; margin-left:470px; margin-top:-58px;color:#000000;"><strong>ADULT</strong></label>
                    <input name="pax" type="number" min="1"  id="pax" size="2" maxlength="2" value="<?php echo $reserva->pax ?>"  style="font-weight: bold;text-align: center; width:50px; margin-top:-58px;" onchange="
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
                    <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" value="<?php echo $reserva->pax2 ?>" style="font-weight: bold; text-align: center; width:50px; margin-top:-58px;" min="0" max="15" onchange="
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
                    <input style="margin-top:-58px; height:18px;" name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/>
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px; margin-left:-12px; margin-top:-58px; color:#000;"  ><strong>INFANT</strong></label>
                    <input name="infat" type="number"  id="infat" size="2" maxlength="2" value="<?php echo $reserva->pax3; ?>" min="0" max="16" style="font-weight: bold; text-align: center; width:50px; margin-top:-58px;margin-left:4px;" />
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
            <fieldset id="onew" style="border-radius: 7%; height:211px;" class="cerati"><legend style="margin-top:4px; border:1px solid #00C; background:#fff;">ONE WAY</legend>

                <div id="opera" class="input" style="padding-top:18px; ">

                    <label style="width:75px; color:#FFFFFF;"  >DEPARTURE</label>
<!--                    <a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                    <a href="" id="dataclick1" ><i class="fa fa-calendar fa-2x" style="color: #fff;"></i></a>
                    <input  style="width:84px; margin-left:8px; padding-top:3px; margin-top: -7px;"  name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value="<?php
                    if (isset($reserva)) {
                        echo ($reserva->fecha_salida == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_salida)));
                    }
                    ?>" autocomplete="off"/>
                </div>

                <div id="opera" class="input"  >
                    <div id="explo">  <label style="width:45px; color:#FFFFFF;"  > FROM</label></div>
                    <div id="explo" align="left"> 
                        <select name="fromt"  style="width:125px; height:25px;" id="from">
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
                <div id="opera" class="input"  >
                    <div id="explo"><label style="width:45px; color:#FFFFFF;"  > TO</label></div>
                    <div id="explo" align="left">
                        <select name="to"  id="to" style="width:130px; height:25px;">
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
                <div id="mascaraP" style="display: none;">
                </div>
                <div id="popup" style="display: none;">
                    <div class="content-popup">
                    </div>
                </div>

                <div id="clienteN" style="display:none; width: 700px; margin-left: 100px;" ></div>

                <div id="opera" class="input">
                    <div style="width:50px; margin-top: -5px;" id="popup1">  <label style="width:20px; color:#FFFFFF;"  > TRIP</label><a id="search" style="cursor:pointer;color: #fff;" class="fa fa-search-plus fa-2x"></a>
                        <input type="hidden" id="valorcomision01" name="valorcomision01" value="<?php /* echo $subto['comi1'] */ ?>" /></div>
                    <div style="width:50px;"> <input type="hidden" id="trip_no_c" name="trip_no_c"  value="<?php
                        if (isset($reserva)) {
                            echo $reserva->trip_no;
                        }
                        ?>"/><input name="trip_no" type="text" style="margin-top:1px; height: 22px; width:75px;"  id="trip_no" size="3" maxlength="3" value="<?php
                                                     if (isset($reserva)) {
                                                         echo $reserva->trip_no;
                                                     }
                                                     ?>"  readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input"  style="clear:right; padding-left:7px;">
                    <div style="width:50px;">  <label style="width:45px; margin-left:10px; color:#FFFFFF;"  > DEP.TIME</label></div>

                    <input name="departure1" type="text"  id="departure1" size="5" maxlength="8" style="padding-left: 12px; height:23px; width:62px; margin-left:11px; margin-top:-1px; height: 23px;" value="<?php
                    if (isset($reserva)) {
                        echo date("g:i a", strtotime($reserva->deptime1));
                    }
                    ?>" readonly="readonly"/>

                </div>

                <div id="opera" class="input"  style="clear:left; ">
                    <div style="width:265px;">  <label style="width:150px;  color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
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
                <div id="opera" class="input"  >
                    <div style="width:265px;">  <label style="margin-left:8px; width:250px;  color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:210px;">
                        <div class="ausu-suggest" >
                            <input name="dropoff1" style="padding:2px; margin-left: 8px; width: 272px;" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php
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
                <div id="opera" class="input" style="margin-left: 16px;" >
                    <div style="width:50px;">  <label style="width:45px; padding-left: 6px; color:#FFFFFF;"  >ARR.TIME</label></div>
                    <div style="width:50px;">
                        <input name="arrival1" type="text"  id="arrival1" size="5" maxlength="8" style="height: 22px; margin-left: 6px; padding-left: 10px; width:63px;"  value="<?php
                        if (isset($reserva)) {
                            echo date("g:i a", strtotime($reserva->arrtime1));
                        }
                        ?>" readonly="readonly" />
                    </div>
                </div>


                <div id="opera" class="input" style="padding-top:5px;  "> <label style="padding-right:5px;color:#FFFFFF;">EXTENSION AREA:</label>
                    <select name="ext_from1" id="ext_from1" style='width:123px; height:26px;' >
                        <option value="0"></option>
                        <?php foreach ($extenFrom1 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion1->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                        <?php } ?>
                    </select></div>

                <div id="opera" class="input" > <label style=" color:#FFFFFF; margin-left:-8px; margin-top:4px;">EXTENSION AREA:</label>
                    <select name="ext_to1" id="ext_to1" style="width:132px; margin-left:5px; height:26px; margin-top:5px;">
                        <option value="0"></option>
                        <?php foreach ($extenTo1 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion2->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                        <?php } ?>
                    </select>  </div>
                <div id="opera" class="input">
                    <label style="margin-left: 0px; color:#FFFFFF; margin-top:4px;" >ROOM #</label>
                    <input name="room1" type="text"  id="room1" size="4" maxlength="6" style=" width:73px;  margin-left: 30px; margin-top:4px;" value="<?php echo $reserva->room1; ?>" />
                </div>

                <div id="opera" class="input"  style="clear:left; ">

                    <div style="width:300px;">  <label style="width:250px;  color:#FFFFFF;"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten1" type="text"  id="exten1" size="46" maxlength="55" value="<?php echo $reserva->pickup_exten1; ?>" <?php
                            if ($extencion1->id == 0) {
                                echo ' disabled="disabled" ';
                            }
                            ?>  autocomplete="off"/>
                            <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" >
                    <div style="width:265px;">  <label style="width:250px;  color:#FFFFFF; margin-left: 11px;"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                    <!--                    <div style="width:200px;">-->
                    <div class="ausu-suggest" >
                        <input name="exten2" type="text"  id="exten2" size="47" maxlength="55" style="padding-left:11px; margin-left: 11px; width:313px;" value="<?php echo $reserva->pickup_exten2; ?>"  <?php
                        if ($extencion2->id == 0) {
                            echo ' disabled="disabled" ';
                        }
                        ?>  autocomplete="off"/>
                        <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
                        <!--                        </div>-->
                    </div>
                </div>

            </fieldset>
            <!--            <fieldset id="round" style="display:none;"><legend><font color="#990000">ROUND TRIP</font></legend>-->
            <fieldset id="round" style="display:none;border-radius: 5%;  margin-top:7px; height:220px;" class="rojo"><legend style="border:1px solid #B83A36; background:#fff;"><font color="#990000">ROUND TRIP</font></legend>
                <div id="opera" class="input" style="padding-top:18px; ">

                    <label style="width:75px; color:#FFFFFF;"  >DEPARTURE</label>
                    <a href="" id="dataclick2" ><i class="fa fa-calendar fa-2x" style="color: #fff; margin-top:5px; "></i></a>
<!--                    <a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                    <input name="fecha_retorno" type="text"  id="fecha_retorno" style="width:84px; margin-top:8px; margin-left:8px; padding-top:2px;" size="10" maxlength="15" value="<?php
                    if (isset($reserva) && $reserva->tipo_ticket != 'oneway') {
                        echo ($reserva->fecha_retorno == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_retorno)));
                    }
                    ?>" autocomplete="off" />
                </div>

                <div id="opera" class="input"  >
                    <div id="explo">  <label style="width:45px; color:#FFFFFF;"> FROM</label></div>
                    <div id="explo" align="left">
                        <select name="fromt2"  style="width:125px; height:25px; margin-top:5px; " id="from2" >
                            <option value=""></option>
                            <?php foreach ($to_areas as $area) { ?>
                                <option value="<?php echo $area['trip_to']; ?>"  <?php echo ($area["trip_to"] == $reserva->fromt2 ? 'selected' : '') ?>  >
                                    <?php echo $area['nombre']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                </div>

                <div id="opera" class="input"  >
                    <div id="explo">  <label style="width:45px; color:#FFFFFF;"  > TO</label></div>
                    <div id="explo" align="left">
                        <select name="to2"  id="to2" style="width:130px; height:25px; margin-top:5px; " <?php
//            if($reserva->tipo_ticket=='oneway'){
//                echo ' disabled="disabled" ';
//            }
                        ?> >
                                    <?php foreach ($data["to_areas2"] as $area) { ?>
                                <option value="<?php echo $area['trip_to']; ?>"  <?php echo ($area["trip_to"] == $reserva->tot2 ? 'selected' : '') ?>  >
                                    <?php echo $area['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id="opera" class="input" style="margin-top: -1px;"  >
                    <div style="width:50px;" id="popup2">  <label style="width:20px; color:#FFFFFF;"  > TRIP</label><a id="search2" style="cursor:pointer;color: #fff;" class="fa fa-search-plus fa-2x"></a> 
                        <input type="hidden" id="valorcomision02" name="valorcomision02" value="<?php /* echo $subto['comi2'] */ ?>" />
                    </div>
                    <div style="width:50px;"><input type="hidden" id="trip_no2_c" name="trip_no2_c" style="height: 22px; width:75px;" value="<?php
                        if (isset($reserva)) {
                            echo $reserva->trip_no2;
                        }
                        ?>"/> <input name="trip_no2" type="text"  style="margin-top:5px; height:22px; width:83px;" id="trip_no2" size="3" maxlength="3" value="<?php
                                                    if (isset($reserva)) {
                                                        echo ($reserva->trip_no2 != 0 ? $reserva->trip_no2 : "");
                                                    }
                                                    ?>"  readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input"  style="clear:right; padding-left:7px;">
                    <div style="width:50px;">  <label style="width:45px; padding-left: 15px; color:#FFFFFF;"  > DEP.TIME</label></div>
                    <div style="width:50px;">
                        <input name="departure2" type="text" style="height: 22px; padding-left: 9px; margin-top:5px; width:62px; margin-left:15px;" id="departure2" size="5" maxlength="8" value="<?php
                        if (isset($reserva)) {
                            echo ($reserva->deptime2 != "00:00:00" ? date("g:i a", strtotime($reserva->deptime2)) : "");
                        }
                        ?>" readonly="readonly"/>
                    </div>
                </div>

                <div id="opera" class="input"  style="clear:left; ">
                    <div style="width:265px;">  <label style="width:150px; color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
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
                <div id="opera" class="input"  >
                    <div style="width:265px;">  <label style="width:250px; margin-left:8px; color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="dpoff2" type="text" style="margin-left:9px; width: 272px; padding-left:10px;" id="dropoff2" size="39" maxlength="55" value="<?php
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
                <div id="opera" class="input" style="margin-left: 16px;"  >
                    <div style="width:50px;">  <label style="width:45px; padding-left: 10px; color:#FFFFFF;"  >ARR.TIME</label></div>
                    <div style="width:50px;">
                        <input name="arrival2" type="text" style="height: 22px; margin-left: 10px; padding-left: 8px; width:63px;" id="arrival2" size="5" maxlength="8" value="<?php
                        if (isset($reserva)) {
                            echo ($reserva->arrtime2 != "00:00:00" ? date("g:i a", strtotime($reserva->arrtime2)) : "");
                        }
                        ?>" readonly="readonly" />
                    </div>
                </div>


                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px; color:#FFFFFF;">EXTENSION AREA:</label>
                    <select name="ext_from2" id="ext_from2" style="width:123px; height:26px;" >
                        <option value="0"></option>
                        <?php foreach ($extenFrom2 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion3->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                        <?php } ?>
                    </select> 
                </div>

                <div id="opera" class="input" > <label style=" color:#FFFFFF; margin-left:-8px; margin-top:4px;">EXTENSION AREA:</label>
                    <select name="ext_to2" id="ext_to2" style="width:122px; margin-left:7px; height:26px; margin-top:5px;">
                        <option value="0"></option>
                        <?php foreach ($extenTo2 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion4->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                        <?php } ?>
                    </select>  
                </div>
                <div id="opera" class="input" >
                    <label style=" margin-right:-13px; color:#FFFFFF;"  >ROOM #</label>
                    <input name="room2" type="text" style=" width:58px; padding-left: 13px; margin-left:55px; margin-top:4px; " id="room2" size="4" maxlength="6" value="<?php echo $reserva->room2; ?>" />
                </div>   


                <div id="opera" class="input"  style="clear:left; ">
                    <div style="width:300px;">  <label style="width:250px; color:#FFFFFF;">EXTENSION PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten3" type="text" style="margin-left: 1px; width: 313px; padding-left: 0px;"  id="exten3" size="46" maxlength="55" value="<?php echo $reserva->pickup_exten3; ?>"   <?php
                            if ($extencion3->id == 0) {
                                echo ' disabled="disabled" ';
                            }
                            ?> autocomplete="off" />
                            <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" style="clear:right;" >
                    <div style="width:265px;"><label style=" margin-left: -1px; width: 310px; padding-left: 9px;  color:#FFFFFF;"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten4" type="text"  style="margin-left: 9px; width: 308px; padding-left: 20px;" id="exten4" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten4; ?>"  <?php
                            if ($extencion4->id == 0) {
                                echo ' disabled="disabled" ';
                            }
                            ?>  autocomplete="off" />
                            <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
            </fieldset>
<!--            <table width="246" cellspacing="0" class="sup2" style="margin-top: 2px;">-->
            <table class="sky" border="1" width="256" height="205" cellspacing="0" class="sup2" style="margin-top: 90px;">
                <tr>
                    <td style="text-align:center; color:#4B0082;" width="136"><label><strong>QUOTE</strong></label></td>
                    <td width="54" style="text-align:center;"><label style="color:#4B0082;"><strong>Adult</strong></label></td>
                    <td width="48" style="text-align:center;"><label style="color:#4B0082;"><strong>Child</strong></label></td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Line Transportation</strong></label></td>
                    <td style="text-align:center; color:blue;"><span name ="transporadult" id="transporadult" value="" style="font-size: 15px; font-weight:bold;"></span></td>
                <input type="hidden" name ="transadult" id="transadult"/>
                <input type="hidden" name ="transchild" id="transchild"/>
                <td style="text-align:center; color:blue;"><span name ="transporechil" id="transporechil" style="font-size: 15px; font-weight:bold;"></span></td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Extensions</strong></label></td>
                    <td style="text-align:center; color:red;"><span id="extenadult" style="font-size: 15px;font-weight:bold; "></span></td>
                    <td style="text-align:center; color:red;"><span id="extenchil" style="font-size: 15px;font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong> Discount %</strong></label></td>
                    <td colspan="2">
                        <input name="descuento" type="number" id="descuento" maxlength="3" onkeyup="valorExtra();" max="100" min="0"  value="<?php echo $reserva->descuento_procentaje; ?>"  style="text-align:left; height:20px; width:112px;" />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong> Discount &nbsp;$</strong></label></td>
                    <td colspan="2">
                        <input name="descuento_valor" type="number" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:20px; width:112px;" onkeyup="valorDescuento();"   value="<?php echo $reserva->descuento_valor; ?>"  />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Extra Charges &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$</strong></label></td>
                    <td colspan="2">
                        <input name="extra" type="text" id="extra" size="12" maxlength="10" style="height:20px; width:114px;" onkeyup="valorExtra();"  />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#ffffff;"><strong>Sub-total per Pax</strong></label></td>
                    <td style="text-align:center; color:#ffffff;"><span id="subtoadult" style="font-size: 15px; font-weight:bold; "></span></td>
                    <td style="text-align:center; color:#ffffff;"><span id="subtochild" style="font-size: 15px; font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td><label style="color:#ffffff;" ><strong>Total</strong></label></td>
                    <td style="text-align:center;" colspan="2"><label style="color:#ffffff;"><strong id="totaltotal" style="font-size: 15px; font-weight:bold; " >$ 00.0</strong></label></td>
                <div id="enviarDatos"></div>
                <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild1" name="subtochild1" value="<?php echo $reserva->precio_trip1_c; ?>" />

                <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochild2" name="subtochild2" value="<?php echo $reserva->precio_trip2_c; ?>" />

                <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="<?php echo $reserva->precio_exten1_a; ?>" />
                <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="<?php echo $reserva->precio_exten2_a; ?>" />
                <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="<?php echo $reserva->precio_exten3_a; ?>"  />
                <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="<?php echo $reserva->precio_exten4_a; ?>" />

                <input size="5" type="hidden" id="subtoadult1_o" name="subtoadult1_o" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild1_o" name="subtochild1_o" value="<?php echo $reserva->precio_trip1_c; ?>" />

                <input size="5" type="hidden" id="subtoadult2_o" name="subtoadult2_o" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="subtochild2_o" name="subtochild2_o" value="<?php echo $reserva->precio_trip2_c; ?>" />

                <input size="5" type="hidden" id="price_exten01_o" name="price_exten01_o" value="<?php echo $reserva->precio_exten1_a; ?>" />
                <input size="5" type="hidden" id="price_exten02_o" name="price_exten02_o" value="<?php echo $reserva->precio_exten2_a; ?>" />
                <input size="5" type="hidden" id="price_exten03_o" name="price_exten03_o" value="<?php echo $reserva->precio_exten3_a; ?>"  />
                <input size="5" type="hidden" id="price_exten04_o" name="price_exten04_o" value="<?php echo $reserva->precio_exten4_a; ?>" />

                </tr>
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
            <fieldset id="pymen" style="margin-top:4px; height:423px; border-radius: 5%;" class="super" ><legend style="border:1px solid #00C; background:#fff" >PAYMENT INFORMATIONS</legend>
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
                                                <?php if ($agen_account['opcion4'] != 0) { ?>
                                                                    <tr id="tipo_Cash">
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
<!--                            <div style="width:265px; margin-left:50px; margin-top:-50px;"><label style="width:150px;  padding-left:134%; margin-top:47px; color:#4B0082;"  ><strong>NOTES</strong></label></div>-->
                            <div id="comco" class="input"> <textarea id="comments" name="notes" cols="0" rows="0" placeholder="Notes" style="margin: 13px; width: 360px; height:100px; margin-top:2px; margin-left:93px;"></textarea></div>
                            <div id="comco2" class="input"><div style="width:265px; margin-left:50px; margin-top:50px;"></div><textarea id="comments2" name="notes2" cols="0" rows="0"  disabled="disabled" style="margin: 0px; width: 360px; height: 208px; margin-top:-79px; margin-left:93px;"><?php echo trim($reserva->comments2); ?></textarea></div>
                        
                        </td>
                        
                        
                            
                       
                    </tr>
                    <tr>
                        <td colspan="2">

                        </td>
                    </tr>
                </table>
                </td>
                </tr>
<!--                </table>-->
                
                
                
                <table class="oliveti" style="width: 39%; border: 2px solid #000; margin-left: 10px; margin-top: -331px; height: 139px;">
                                <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff;">Passenger Payment Information</caption>

<!--                                    <tr id="tr_agencycomision" style="display:none">
    <td width="132">
        <label  style="padding-left:20px; width:100px; font-size:11px; margin-left:2px;color: #BDBDBD;"><strong>Agency Comision &nbsp;$</strong></label>
    </td>
    <td width="296">
        <label id="totalComision" style="margin-top: 30px; padding-bottom:8px;color: #BDBDBD; "></label>
    </td>
</tr>-->
<!--                                <tr>
                                    <td style="width: 700px;">
                                        <label  style="display:none; font-weight:bold; padding-left:20px; height: 20px; font-size:16px; color:#000;"><strong style="margin-top:-18px; margin-left: 108px; padding-bottom:10px; "><strong>Total Fare&nbsp;$</strong></label>
                                    </td>
                                    <td>
                                                                                <font  class="black" style="float: left; height:24px; text-align: center;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px; margin-top:3px; font-size:22px; padding-left:3px; height:25px; font-weight:bold; color:#fff;  margin-left: 2px;" id="totalPagar" ></font>
                                                                                <input name="totP" type="hidden"  id="totP" value="" /> 

                                    </td>
                                </tr>-->

<!--                                <tr>
    <td style="width: 700px;">
        <label  style="font-weight:bold; padding-left:19px; height: 20px; font-size:16px; color:#000;"><strong style="margin-top:-18px; margin-left: -17px; padding-bottom:10px; "><strong>Total Amount Paid&nbsp;$</strong></label>
    </td>
    <td>
        <input type="text" readonly="readonly"  id="totalAmountPaid" style="font-size:22px; margin-top:7px; margin-left: -11px; width:107px; height:23px; color: green; font-weight:bold; text-align: center;">
    </td>
    
    
</tr>-->


<!--                                <tr style="display:none;">
                                    <td>
                                        <label  style="padding-left:20px; font-size:12px; "><strong style="padding-bottom:0px; color:#090;">Total Amount Paid $</strong></label>

                                    </td>
                                    <td>
                                        <label id="saldoPagado" >$  </label>
                                        <br />
                                    </td>
                                </tr>
                                <td>&nbsp;</td>-->


                                <tr  style=" height:33px; width:180px; ">

                                    <td style="width: 700px; margin-top:-49px; ">
                                        <label  style="padding-left:101px; font-size:16px;"><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#000;">Amount to Collect&nbsp;$</strong></label>
                                    </td>
                                    <td>
                                        
<!--                                        <label  class="verde2017"  style="font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; margin-left:3px;    margin-top: -4px;" id="saldoporpagar" > value="<?php echo number_format(($saldoxPagar), 2, '.', ','); ?>" />-->
                                            
                                        <input type="text"  autocomplete="off" class="verde2017"  style="font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; margin-left:-22px; text-align:center;    width: 106px;   margin-top: -4px;" id="saldoporpagar"  value="<?php echo number_format(($saldoxPagar), 2, '.', ','); ?>"  />             
                                        
<!--                                        <input autocomplete="off" type="text"  class="verde2017"   id="saldoporpagar" value=""  style=" border: 1px #33F solid; margin-top: -47px; margin-left: 3px; text-align: center; height: 25px; font-family: sans-serif; font-size: 22px; width:106px;"  />-->
<!--                                    
<input background-color: #BCED91; class="txtNumbers" type="text" id="otheramount" name="otheramount"  style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #AC1B29; width: 104px;float:left;width:106px; font-weight:bold; color:fff;" value="" onkeyup="CalcularTotalTotal();"  />-->

<!--                                        <input autocomplete="off" type="text"  class="verde2017"   id="saldoporpagar" value=""  style=" border: 1px #33F solid; margin-top: -47px; margin-left: 3px; text-align: center; height: 25px; font-family: sans-serif; font-size: 22px; width:106px;"  />-->
                                        <!--                                        <label style="text-align: center;  width:105px; background-color: #BCED91; color:#000; font-size: 22px; font-weight: bold; margin-left:3px; border: 1px #33F solid;  margin-top: -11px;width: 106px;height: 23px;  font-family: sans-serif;" id="saldoporpagar" >$  </label>-->


<!--                                        <br />-->
                                    </td>
                                </tr>
<!--                                <td>&nbsp;</td>-->


                                <tr style="height:33px; width: 700px; " ><td>
                                        <label  style=" padding-left:87px; font-size:16px; margin-left:68px; margin-top:-53px; "><strong style="padding-bottom:10px; color:#090">Paid Driver&nbsp;$</strong></label>    </td>
                                    <td>
<!--                                        <input type="text" id="paid_driver" name="paid_driver" class="brown2"  style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #000; border: #33F solid thin; margin-top: 1px; margin-left: -22px; width: 104px;float:left;width:106px; font-weight:bold; color:fff;" value="" onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();" />-->
                                        
<!--                                        <input type="text" id="saldoPagado" name="saldoPagado" class="brown2"  style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #000; border: #33F solid thin; margin-top: 1px; margin-left: -22px; width: 104px;float:left;width:106px; font-weight:bold; color:fff;" <?php echo number_format($pagado, 2, '.', ','); ?>/>-->
                                        
<!--                                        <label id="saldoPagado" class="brown2" <strong style="font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:4px;" ><?php echo number_format($pagado, 2, '.', ','); ?></strong></label>-->
                                        <input type="text" id="saldoPagado" class="brown2" style="font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:23px; margin-left: -22px; width: 83px;" value="<?php echo number_format($pagado, 2, '.', ','); ?>" onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();"  />
<!--                                         <input type="text" id="paid_driver" name="paid_driver" class="brown2"   style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #000; border: #33F solid thin; margin-top: -52px; margin-left: 3px; width: 104px;float:left;width:106px; font-weight:bold; color:fff;" value="" onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();" />-->
                                    </td>
                                </tr>

                                <tr style="height:33px; width: 700px; " >
                                    <td>
                                        <label  style=" font-size:16px; margin-left: 57px; margin-top: -30px; "><strong style="padding-bottom:10px; color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                                    </td>

                                    <td>
                                        <input style="border: 1px #33F solid; margin-top: -1px; margin-left: -22px; text-align: center; height: 25px; font-size: 22px; width:106px;" autocomplete="off" type="text" class="azul2017"  class="txtNumbers"  name="balance_due" id="balance_due" value=""    />
                                    </td>
                                </tr>


<!--                                <tr id="pay_amount_html" style="height: 50px;">
   <td>

       <label  style="padding-left:48px; font-size:16px; "><strong style="padding-bottom:10px; color:#000;">Add Payment&nbsp;$</strong></label>
        <input autocomplete="off" type="text" class="caja5"  name="pay_amount" id="pay_amount" value=""  onkeyup="PasarPago();"  style=" height:23px; color: green;" />
       
   </td>
   <td>



           <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style=" text-align: center;font-size: 22px;font-weight: bold;color: #fff;border: 1px #33F solid; background-color: #F3FE3D; padding-left:5px; width:100px; height:20px;float:left; margin-top:4px;" />
       <input autocomplete="off" type="text" class="txtNumbers"  name="balance_due" id="balance_due" value=""  style="display:none; height: 24px; text-align: center;font-size: 22px;font-weight: bold;color: #fff;border: 1px #33F solid; background-color: #72CBEC; padding-left:5px; width:100px; height:24px; float:left; margin-top:4px;" />

   </td>
</tr>
                                -->
                                <select name="opcion_pago" id="op_pago_id" style="margin-left:389px; margin-top:-209px;">
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

                            </table>
                
                
                 <table class="oliveti" style="width: -8%; border: 2px solid #000; margin-left: 10px; margin-top: 9px; height: 154px; ">

                                <caption class="cerati" style="  font-weight:bold; font-size:16px; color:#fff;">Agency Payment Information</caption>
                                
                                <tr style="height:33px; width: 700px;">
                                    <td>
                                        <b style="font-size: 18px; margin-left: 3px; ">Agency Request to Collect&nbsp;$</b>
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" id="otheramount" name="otheramount" class="black" style="margin-top: 2px; margin-left: 10px; text-align: center; height: 25px; font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px;float:left;width:106px; font-weight:bold; color:fff;" value="<?php echo number_format($reserva->otheramount, 2, '.', ','); ?>" onkeyup="CalcularTotalTotal();ClkPay_Amount();"  />
<!--                                        <input autocomplete="off" type="text"  class="black"  name="otheramount"  id="otheramount"  style="margin-top: -151px; margin-left: -107px; text-align: center; height: 25px; font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px;float:left;width:106px; font-weight:bold; color:fff;"   value="" onkeyup="ClkPay_Amount();" />-->
                                    
                                    </td>
                                </tr>    
                                <tr style="height:33px; width: 700px;">
                                    <td>
                                        <b style="font-size: 18px; margin-left:112px; margin-top:3px;">Total Net Fare&nbsp;$</b>
                                    </td>
                                    <td>
                                        <font  class="orangered" style="float: left; height:24px; text-align: center;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px; margin-top:0px; font-size:22px; padding-left:3px; height:25px; font-weight:bold; color:#fff;  margin-left: 10px;" id="totalPagar" ></font>
                                        <input name="totP" type="hidden"  id="totP" value="" /> 
                                        <input type="text"  class="orangered" style="display:none; float: left; height:24px; text-align: center;border: #AC1B29 solid thin; font-weight:bold; color:#fff; background-color: #1B1478; height:25px; width: 103px; margin-left: 10px; margin-top:13px; font-size:22px; padding-left:3px;"  id="totalPagar" />
                                        
<!--                                        <input name="totP" type="hidden"  id="totP" value="" />
                                        <font  style="float: left; height:23px; text-align: center;border: #AC1B29 solid thin; background-color: #AC1B29; width: 104px; margin-top:3px; font-size:22px; padding-left:3px; font-weight:bold; color:#fff;" id="totalPagar" ></font>
                                        -->
                                    </td>
                                </tr>
                                <tr id="pay_amount_html" style="height: 33px; width: 700px;">
                                    <td>
                                        <b style=" color:#000;font-size: 18px; margin-left:120px;">Amount Paid&nbsp;$</b>                                       
                                    </td>
                                    <td>
<!--                                        <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();" style="text-align: center; z-index: 100; position: absolute; margin-top: -14px; margin-left:10px; width: 106px; height:25px; font-size:22px;" />-->
<!--                                        <label id="saldoPagado" <strong style="font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:38px;" ><?php echo number_format($pagado, 2, '.', ','); ?></strong></label>-->
                                            
                                    </td>
                                </tr>
                                <tr style="height:33px; width: 700px;">
                                    <td>
                                        <b style="padding-left:123px;"><strong style="margin-left:-70px; color:#000;font-size: 18px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>                                         
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" class="gris2"  class="txtNumbers"  name="agency_balance_due" id="agency_balance_due" value=""  style="border: 1px #33F solid; margin-left: 10px; margin-top:1px; text-align: center; height: 25px; font-size: 22px; width:106px;" />
                                    </td>
                                    
                                
                                </tr>  
                                
                                
                            </table>
                
               
              
<!--                                                            <label style="font-family: Verdana, Geneva, sans-serif; color:#4B0082; font-size: 16px; font-weight: bold; margin-left:14px;    margin-top: -4px;" id="saldoporpagar" >$  <?php echo number_format(($saldoxPagar), 2, '.', ','); ?></label>-->
                                                            <!--                                                            <label style="font-family: Verdana, Geneva, sans-serif; color:#4B0082; font-size: 16px; font-weight: bold; margin-left:27px;    margin-top: -5px;" id="" >$  </label>-->
                                                          
<!--                                                        <tr id="pay_amount_html" style="height: 50px;">
                                                        
                                                            
                                                            <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:100px; height:20px;float:left;" />
                                                        </tr>    -->
                                                     

            </fieldset>
            <select name="opcion_pago_2" style="margin-left:404px; margin-top: -139px;">
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
            <a  id="pago_agente" style="display:block" ><img style="width: 77px; margin-left:404px;  margin-top: -111px;cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>

<!--            <li class="btn-toolbar" id="btn-save2">
                   
                    <a class="link-button" id="btn-save2"> <i class="fa fa-floppy-o fa-3x"  title="Save" style="margin-left: 286px; margin-top:-58px; color:#4B0082;"></i></a>
         
            </li>-->
            
            <li class="btn-toolbar" id="btn-save2">
                   
<!--                    <a class="link-button" id="btn-save2"> <i class="fa fa-floppy-o fa-3x"  title="Save" style="margin-left: 286px; margin-top:-58px; color:#4B0082;"></i></a>-->
                    <input  class="oliveti" class="link-button"  type="button" id="btn-save2" title="Confirm Booking" style="border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; margin-left: 831px; margin-top:-63px; height: 35px; cursor:pointer; color: #000;font-weight: 700; width:124px;" value="Confirm Booking" />
         
            </li>
            
<!--            <li class="btn-toolbar" id="btn-exit2">-->
                
<!--                    <a title="Exit" id="btn-exit2" href="<?php echo $data['rootUrl'] ?>admin/home"><i class="fa fa-external-link-square fa-3x" style="color:#AC1B29; margin-top: -112px; margin-left: 528px;"></i></a> -->
<!--            </li>-->
            
                
            <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; text-align: center;font-size: 22px;font-weight: bold; color: #000; border: 1px #33F solid; padding-left:5px; width:100px; height:20px;float:left; margin-top:-144px; margin-left: 286px;" />
            
            
        </div>
<!--         <a title="Save" style="cursor:pointer" id="btn-save2"><i class="fa fa-floppy-o fa-3x" style="color:#4B0082; margin-left: 295px; margin-top:-65px;"></i></a>-->
<!--         <a class="link-button" id="btn-save2"> <i class="fa fa-floppy-o fa-3x" title="Save" style="cursor:pointer; margin-left: 295px; margin-top:-65px; color:#4B0082;"></i></a>-->
<!--         <input title="Add Payment" type="button" id="pay_driver" name="pay_driver" onclick="pago_driver();" style="margin-left: -401px; margin-top: -269px; height: 35px; cursor:pointer; color: #000;font-weight: 700; width: 124px;  padding: 10px;" value="Add Payment"/>-->
         
         <td align="right">
                                                                                               
         
         
<!--         <input  class="link-button" title="Confirm Booking" type="button" id="btn-save3"  style="margin-left: 841px; margin-top:-71px; height: 35px; cursor:pointer; color: #000;font-weight: 700; width:124px;" value="Confirm Booking" />-->

         
                                                
         </td>
         
         <input type="text" id="saldoPagado2"  style="display:none; font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:23px; margin-left: -32px; width: 83px;" value="" />
         <input title="Add Payment" class="brown2" type="button" id="pay_driver" name="pay_driver" onclick="mostrarVentana2();" style="border-color: brown; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; margin-left: 415px; margin-top: -352px; height: 35px; cursor:pointer; color: #000;font-weight: 700; width: 124px;  padding: 10px;" value="Add Payment"/>
         <input name="opc_ap"  type="text" id="opc_ap" size="12" style="display:none;" value="" />
         <input name="PAP"  type="text" id="PAP" size="12" style="display:none;" value="0.00" />
</form>



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
<div id="dialog_message_rastro" style="display:none" title="Details of change">
    <div id="conten_rastro">
    </div>
</div>


<div id="dialog-trip-pregunta" title="Time limit for booking" style="display:none">
    <p>
    <div id="reloj_temporizador" class="temporizador"></div>
    <div id="mensaje_trips_pregunta">
    </div>
</p>
</div>


<div id="miVentana2" style="position: fixed; width: 174px; height: 141px;  top:414px; left: 98px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

    <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">Add Payment</div>
    
<!--    <label  style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color: #000; margin-left:-55px;">$</strong></label> -->
    <label  id="dolares" style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color:#006394; margin-left:-55px;">$</strong></label> 

    <!--class="money"-->
    <input name="pago_driver"   type="text" id="pago_driver" size="12" style="font-size: 22px;  text-align:right; margin-top:6px; margin-left:29px; width:114px; height:20px;" value="0.00" onkeypress="validate(event);"  onkeyup="dupliPago();"/>

    <input name="pago_driver2"  type="text" id="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
    
    <input name="temp"  type="text" id="temp" title="Fees" size="12" style="margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

    <input name="collect"  type="text" id="collect" title="Paid Driver" size="12" style="margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

    <input name="prepaid"  type="text" id="prepaid" title="Amount Paid" size="12" style="margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />


<!--    <input name="someTextBox" type="text" id="someTextBox" size="12" style="display:none; margin-top:9px; margin-left:27px; width:114px; height:20px;" value="0.00" />-->


    <select name="opcion_pago1" id="op_pago_id1" style="margin-left:6px; margin-top: 8px;" disabled= "disabled" onclick="calculos();">
        <option style="color:red;" id="" value="0">((( Amount Paid )))</option>
        <optgroup label="PRED-PAID">
            <option value="20">Credit Card no fee</option>
            <option value="21">Credit Card with fee</option>
            <option value="22">Cash</option>
            <option value="23">Check</option>
        </optgroup>
        <option style="color:blue;" id="" value="1">((( Paid Driver )))</option>
        <optgroup label="COLLECT ON BOARD">
            <option value="24">Credit Card no fee</option>
            <option value="25">Credit Card with fee</option>
            <option value="26">Cash</option>
            <option value="27">Check</option>
        </optgroup>       


    </select>
    
    <script type="text/javascript">
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
    </script>
    
    <script type="text/javascript">
    function reset()
    {

        document.getElementById('pago_driver').value = '0.00';

        document.getElementById('pago_driver').style.color = '#848484';

        document.getElementById('pago_driver2').value = '0.00';

        document.getElementById('op_pago_id1').value = 0;

        document.getElementById('temp').value = '0.00';
        document.getElementById('prepaid').value = '0.00';
        document.getElementById('collect').value = '0.00';
        document.getElementById('pago_driver').disabled = false;

        document.getElementById('btnAceptar').style.background = '';

        document.getElementById('btnAceptar').style.color = '#000';

        document.getElementById('dolares').style.color = '#848484';

        document.getElementById('btnAceptar').style.cursor = '';
        //document.getElementById('btnAceptar').disabled = true;



    }
</script>
    
 <!--</form>-->
 
<script>

    function calculos() {


        var opcion = $("#op_pago_id1").val();

        //PRED-PAID////////////////////////////////////////////

        //Credit Card no fee

        if (opcion === '20') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                document.getElementById('op_pago_id2').value = 2;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                var prepaid = parseFloat($("#prepaid").val());

                prepaid = prepaid + total;

                $("#prepaid").val((prepaid).toFixed(2));



                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }


        }

        //Credit Card with fee

        if (opcion === '21') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                document.getElementById('op_pago_id2').value = 1;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var valor = pago_driver2 * 0.04;

                var total = (pago_driver2) + (valor);


                var temp = parseFloat($("#temp").val());

                temp = temp + valor;

                $("#temp").val((temp).toFixed(2));


                var prepaid = parseFloat($("#prepaid").val());

                prepaid = prepaid + total;

                $("#prepaid").val((prepaid).toFixed(2));




                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';


            } else {
                // Do nothing!
                exit;
            }


        }

        //Cash
        if (opcion === '22') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                document.getElementById('op_pago_id2').value = 6;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                var prepaid = parseFloat($("#prepaid").val());

                prepaid = prepaid + total;

                $("#prepaid").val((prepaid).toFixed(2));


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }


        }

        //Check
        if (opcion === '23') {

            if (confirm('Confirme su Tipo de Pago !!!')) {


                document.getElementById('op_pago_id2').value = 10;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                var prepaid = parseFloat($("#prepaid").val());

                prepaid = prepaid + total;

                $("#prepaid").val((prepaid).toFixed(2));


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }

        }



        ////////////////////////////////////////////////////////



        //COLLECT ON BOARD//////////////////////////////////////

        //Credit Card no fee
        if (opcion === '24') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                //document.getElementById('op_pago_id').value = 8;


                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                var collect = parseFloat($("#collect").val());

                collect = collect + total;

                $("#collect").val((collect).toFixed(2));


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }


        }

        //Credit Card with fee
        if (opcion === '25') {

            if (confirm('Confirme su Tipo de Pago !!!')) {

                //document.getElementById('op_pago_id').value = 3;

                var pago_driver = parseFloat($("#pago_driver").val());

                var valor = pago_driver * 0.04;

                var total = (pago_driver) + (valor);


                var temp = parseFloat($("#temp").val());

                temp = temp + valor;

                $("#temp").val((temp).toFixed(2));


                var collect = parseFloat($("#collect").val());

                collect = collect + total;

                $("#collect").val((collect).toFixed(2));


                $("#pago_driver").val((total).toFixed(2));
                //$("#saldoporpagar").val((total).toFixed(2));

                //document.getElementById('PAP').value = valor;

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }

        }

        //Cash
        if (opcion === '26') {

            if (confirm('Confirme su Tipo de Pago !!!')) {
                //var cash = $('#op_pago_id1').val();
                //document.getElementById('op_pago_id').value = 4;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;

                var collect = parseFloat($("#collect").val());

                collect = collect + total;

                $("#collect").val((collect).toFixed(2));


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }

        }

        //Check

        if (opcion === '27') {


            if (confirm('Confirme su Tipo de Pago !!!')) {


                //document.getElementById('op_pago_id').value = 9;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                var collect = parseFloat($("#collect").val());

                collect = collect + total;

                $("#collect").val((collect).toFixed(2));


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

                document.getElementById("op_pago_id1").disabled = true;

                document.getElementById("pago_driver").disabled = true;

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('btnAceptar').style.cursor = 'pointer';

                document.getElementById("btnAceptar").disabled = false;

                document.getElementById('btnAceptar').style.background = '#f20707';

                document.getElementById('btnAceptar').style.color = '#fff';

            } else {
                // Do nothing!
                exit;
            }

        }



    }
</script>

<script type="text/javascript">
    function ClkPay_Amount()
    {

        var clone = document.getElementById('otheramount').value;

        if(clone==''){
            
             document.getElementById('otheramount').value = '0.00';
        }
        
        if(clone=='0.0'){
            
             document.getElementById('otheramount').value = '0.00';
        }
        
        document.getElementById('saldoporpagar').value = clone;

        if(clone=='0.'){
            
             document.getElementById('otheramount').value = '0.00';
        }
        

        if(clone=='0'){
            
             document.getElementById('otheramount').value = '0.00';
        }
        setTimeout(function () {
            $('#saldoPagado').click();

        }, 0.001);


    }
</script>

<!--    <script>

        function calculos() {

            var opcion = $("#op_pago_id1").val();

            //PRED-PAID////////////////////////////////////////////

            //Credit Card no fee

            if (opcion === '20') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;

                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));
            }

            //Credit Card with fee

            if (opcion === '21') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var valor = pago_driver2 * 0.04;

                var total = (pago_driver2) + (valor);

                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

            }

            //Cash
            if (opcion === '22') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;

                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

            }

            //Check
            if (opcion === '23') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));
            }



            ////////////////////////////////////////////////////////



            //COLLECT ON BOARD//////////////////////////////////////

            //Credit Card no fee
            if (opcion === '24') {

                document.getElementById('op_pago_id').value = 8;


                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;


                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));


            }

            //Credit Card with fee
            if (opcion === '25') {

                document.getElementById('op_pago_id').value = 3;

                var pago_driver = parseInt($("#pago_driver").val());

                var valor = pago_driver * 0.04;

                var total = (pago_driver) + (valor);

                $("#pago_driver").val((total).toFixed(2));

                //document.getElementById('PAP').value = valor;

                $("#PAP").val((valor).toFixed(2));

            }

            //Cash
            if (opcion === '26') {


                //var cash = $('#op_pago_id1').val();
                document.getElementById('op_pago_id').value = 4;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;

                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

            }

            //Check

            if (opcion === '27') {


                document.getElementById('op_pago_id').value = 9;

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                var valor = 0;

                $("#pago_driver").val((total).toFixed(2));

                $("#PAP").val((valor).toFixed(2));

            }



        }
    </script>-->

    <!--presionar();-->
<!--    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;">
        <input id="btnExit" onclick="Exit();" name="btnExit" size="20" type="button" value="Exit"  />
        <input id="btnCancelar" onclick="reset();" name="btnCancelar" size="20" type="button" value="Reset"  />
        <input id="btnAceptar" onclick="ocultarVentana2();" name="btnAceptar" size="20" type="button" value="Save"  />

    </div>-->
    
    <div class="paymentvertblack" style="padding: 10px;  text-align: center; margin-top: 9px;">

        <input id="btnExit" onclick="Exit();" style="border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer;"name="btnExit" size="20" type="button" value="Exit"  />
        <input id="btnCancelar" onclick="reset();" style="border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer;" name="btnCancelar" size="20" type="button" value="Reset"  />
        <input type="button" id="btnAceptar" style="border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="ocultarVentana2();" name="btnAceptar" size="20" value="Save" disabled="true"/>

    </div>

</div>    


<!--display:none-->
<div style="display:none" id="resultado"></div>

<!--<script type="text/javascript">
    function reset()
    {

        document.getElementById('pago_driver').value = '0.00';
        document.getElementById('pago_driver2').value = '0.00';
        document.getElementById('op_pago_id1').value = 0;

    }
</script>-->

<!--<script type="text/javascript">
    function dupliPago()
    {
//       ("#pago_driver").mask("99,99");
        var dupli = document.getElementById('pago_driver').value;
        document.getElementById('pago_driver2').value = dupli;

    }
</script>-->


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
        ventana2.style.display = 'none'; // Y lo hacemos invisible

    }
</script>





<!--<script type="text/javascript">
    function mostrarVentana2()
    {


//        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
//        ventana2.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
//        ventana2.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
//        ventana2.style.display = 'block'; // Y lo hacemos visible
//        document.getElementById('pago_driver').value = '0.00';
//        document.getElementById('op_pago_id1').value = 0;
        //document.getElementById('op_pago_id').value = 8;


        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.marginTop = "429px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
        //ventana2.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
        ventana2.style.marginLeft = "765.4px"; // Definimos su posición horizontal
        ventana2.style.display = 'block'; // Y lo hacemos visible
        ventana2.style.position = 'absolute';

        $("#pago_driver").focus();

        document.getElementById('pago_driver').value = '0.00';
        document.getElementById('pago_driver').style.color = '#848484';

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
        var opcion = $("#op_pago_id1").val();

        //PRED-PAID////////////////////////////////////////////
        //Credit Card with fee

        if (opcion === '0') {

//            document.getElementById('saldoPagado').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

            setTimeout(function () {
                $('#saldoPagado').click();

            }, 0.001);

//            document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';



        }

        if (opcion === '1') {

//            document.getElementById('saldoPagado').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

            setTimeout(function () {
                $('#saldoPagado').click();

            }, 0.001);

//            document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';

        }

        //Pred-Paid

        if (opcion === '20') {

            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

//            document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';

            Exit();



        }

        if (opcion === '21') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

//                document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                exit;
            }

        }

        if (opcion === '22') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

//                document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                exit;
            }

        }

        if (opcion === '23') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

//                document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                exit;
            }

        }

        //Collect on Board

        if (opcion === '24') {



            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                var saldo = document.getElementById('saldoPagado').value;
                document.getElementById('saldoPagado').value = pago_driver;

                $("#saldoPagado").val((saldo + pago_driver).toFixed(2));
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

//               document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);
//
                Exit();
                // Save it!
            } else {
                // Do nothing!
                exit;
            }





        }

        if (opcion === '25') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                var saldo = document.getElementById('saldoPagado').value;

                document.getElementById('saldoPagado').value = pago_driver;

                $("#saldoPagado").val((saldo + pago_driver).toFixed(2));
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

//                document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);
//
                Exit();

            } else {
                // Do nothing!
                exit;
            }



        }

        if (opcion === '26') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                var saldo = document.getElementById('saldoPagado').value;

                document.getElementById('saldoPagado').value = pago_driver;

                $("#saldoPagado").val((saldo + pago_driver).toFixed(2));
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

//                document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);

                Exit();

            } else {
                // Do nothing!
                exit;
            }


        }

        if (opcion === '27') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                var saldo = document.getElementById('saldoPagado').value;

                document.getElementById('saldoPagado').value = pago_driver;

                $("#saldoPagado").val((saldo + pago_driver).toFixed(2));
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

                //               document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);

                Exit();

            } else {
                // Do nothing!
                exit;
            }

        }


        //var resultados = prueba + opcion_pago_2;
        //alert(pago_driver);
    }
</script>-->
<script type="text/javascript">
    function mostrarVentana2() {
        //alert('mostrar');

        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.marginTop = "429px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
        //ventana2.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
        ventana2.style.marginLeft = "765.4px"; // Definimos su posición horizontal
        ventana2.style.display = 'block'; // Y lo hacemos visible
        ventana2.style.position = 'absolute';

        $("#pago_driver").focus();

        document.getElementById('pago_driver').value = '0.00';
        document.getElementById('pago_driver').style.color = '#848484';

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

        //PRED-PAID////////////////////////////////////////////
        //Credit Card with fee

        if (opcion === '0') {

            document.getElementById('saldoPagado').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

            setTimeout(function () {
                $('#saldoPagado').click();

            }, 0.001);

            $("#pago_driver").focus();

            //document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';



        }

        if (opcion === '1') {

            document.getElementById('saldoPagado').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

            setTimeout(function () {
                $('#saldoPagado').click();

            }, 0.001);

            $("#pago_driver").focus();

            //document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';

        }

        //Pred-Paid

        if (opcion === '20') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('pay_amount').value = prepaid;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                $("#pago_driver").focus();
                exit;
            }



        }

        if (opcion === '21') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('pay_amount').value = prepaid;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                $("#pago_driver").focus();
                exit;

            }

        }

        if (opcion === '22') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                $("#pago_driver").focus();
                exit;
            }

        }

        if (opcion === '23') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('pay_amount').value = prepaid;

                setTimeout(function () {
                    $('#pay_amount').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                Exit();

            } else {
                // Do nothing!
                $("#pago_driver").focus();
                exit;
            }

        }

        //Collect on Board

        if (opcion === '24') {



            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                document.getElementById('saldoPagado').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);
//
                Exit();
                // Save it!
            } else {
                // Do nothing!
                $("#pago_driver").focus();
                exit;
            }





        }

        if (opcion === '25') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('saldoPagado').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);
//
                Exit();

            } else {
                // Do nothing!
                $("#pago_driver").focus();
                exit;
            }



        }

        if (opcion === '26') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {



                document.getElementById('saldoPagado').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);

                Exit();

            } else {
                // Do nothing!

                $("#pago_driver").focus();
                exit;
            }


        }

        if (opcion === '27') {

            if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                document.getElementById('saldoPagado').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;

                setTimeout(function () {
                    $('#saldoPagado').click();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

//                setTimeout(function () {
//                    $('#pay_amount').click();
//
//                }, 0.001);

                Exit();

            } else {
                // Do nothing!

                $("#pago_driver").focus();
                exit;
            }

        }


        //var resultados = prueba + opcion_pago_2;
        //alert(pago_driver);
    }
</script>



<script type="text/javascript">
    $("#pago_agente").click(function () {

        var cantidad = $("#pay_amount").val();
        if (cantidad <= 0) {
            return false;
        }
        var email1 = $("#email1").val();
        var primer_n = $("#firstname1").val();
        var segundo_n = $("#lastname1").val();
        var phone1 = $("#phone1").val();

        var url = encodeURI('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $reserva->codconf; ?>');

        window.open(url, '_blank');
        return false;
    });
    $(window).load(function () {
        //alert("Se cargo");

        var saldop = document.getElementById('saldoPagado').value;
        document.getElementById('saldoPagado2').value = saldop;

        $("#content").css("opacity", "1");
        var sel_payment = '<?php echo $reserva->op_pago; ?>';

        $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
        CalcularTotalTotal();
    });

    $("#op_pago_id").change(function () {
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
        $('#uagency').attr('disabled', 'disabled');
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

        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2), function (response, status, xhr) {
            var id_leader = $('#id_leader').val();
            $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/superclub/' + id_leader));
        });

    }

    $('#agency').change(function () {

        $('#uagency').attr('disabled', 'disabled');
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

    function establerCursorPosicion(pos, idElemento) {
        var elemento = document.getElementById(idElemento);
        if (typeof document.selection != 'undefined' && document.selection) {        //método IE
            var tex = elemento.value;
            elemento.value = '';
            elemento.focus();
            var str = document.selection.createRange();
            elemento.value = tex;
            str.move("character", pos);
            //str.moveEnd("character", 0);
            str.select();
        } else if (typeof elemento.selectionStart != 'undefined') {                    //método estándar
            elemento.setSelectionRange(pos, pos);
        }
    }
    var saber;
    $("#popup1 a").click(function () {

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

//    $("#transporadult").html("");
//    $("#transporechil").html("");
//    $("#subtoadult").html("");
//    $("#subtochild").html("");
//    $("#totaltotal").html("$ 00.0");
//    //$("#ext_from1 option[value="+0+"]").attr("selected",true);
//    $("#extenadult").html("");
//    $("#extenchil").html("");
        $('.content-popup').html(" ");
        $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);
        $('#mascaraP').fadeIn('slow');
        $('#popup').fadeIn('slow');
        saber = 1;

    });
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
    $("#popup2 a").click(function () {

        var from = $('#from2').val();
        var to = $('#to2').val();
        var fecha_retorno = $('#fecha_retorno').val();
        var tipopas = $('#tipo_pass').val();

        if ($('#trip_no').val() == '') {
            alert("Must fill out the form ONE WAY");
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

                alert(mensage);

                return false;

            }

            var agency;
            if ($('#id_agency').val() != '-1') {
                agency = $('#id_agency').val()
            } else {
                agency = -1;
            }

            $('.content-popup').html(" ");
            $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_retorno + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);
            $('#mascaraP').fadeIn('slow');
            $('#popup').fadeIn('slow');

            saber = 2;
        }
    });

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
            $("#formula").submit();
        }

    });

    $('#btn-save2').click(function () {
        if (validarFomulario()) {
            CalcularTotalTotal();
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

        if ($("#id_tipo_ticket").val() == "2") {

            var transadult = ((parseFloat(transporAdul1) + parseFloat(transporAdul2)) * pax_1);

            var transchild = ((parseFloat(transporChil1) + parseFloat(transporChil2)) * pax_2);

        }

        //if oneway checked
        if ($("#id_tipo_ticket").val() == "1") {

            var transadult = (parseFloat(transporAdul1) + 0) * pax_1;
            var transchild = (parseFloat(transporChil1) + 0) * pax_2;

        }



        var totalA = parseFloat(transadult) + (parseFloat(price_exten) * pax_1);
        var totalC = parseFloat(transchild) + (parseFloat(price_exten) * pax_2);

//        alert(pax_1);
        var totalP = totalA + totalC;
        $("#totalPagar2").text(totalP.toFixed(2));
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


    function CalcularTotalTotal() {
        org = typeof (org) != 'undefined' ? org : 0;
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
        var num = document.getElementsByName('opcion_pago').length;
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('opcion_pago').item(i).checked) {
                tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
            }
        }

        tipo_pago = $("#op_pago_id option:selected").val();

        var tipo_saldo = $('#opcion_pago_saldo').val();
        //Validar otheramount
        error = "";
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

        apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat((full * desc_porc) / 100) - parseFloat(desc_valor);

        apagar = apagar;
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
        if (tipo_pago == 5) {
            if (disponible - full < 0) {
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



//                $("#totalPagar").text((apagar).toFixed(2));
//                $("#totaltotal").text((apagar).toFixed(2));

                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));

            } else {

                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/



//                $("#totalPagar").text((apagar).toFixed(2));
//                $("#totaltotal").text((apagar).toFixed(2));

                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));
            }

        } else if (tipo_pago == 1) {
//        $("#opcion_saldo2").attr('checked',true);
//        $("#opcion_saldo1").attr('disabled',true);
//        $("#opcion_saldo2").attr('disabled',false);
//        $("#opcion_pago_saldo").val('2');
//        $("#totalPagar").text((balance).toFixed(2));
//        $("#totaltotal").text((balance).toFixed(2));
            apagar = parseFloat(apagar) + parseFloat(fee);


//            $("#totalPagar").text((apagar).toFixed(2));
//            $("#totaltotal").text((apagar).toFixed(2));


            $("#totalPagar").text((apagar).toFixed(2));
            $("#totaltotal").text((apagar).toFixed(2));


        } else {
            $("#opcion_saldo2").attr('disabled', false);
            $("#opcion_saldo1").attr('disabled', false);
            if (tipo_pago == 3) {
                //apagar = parseFloat(apagar) + parseFloat(fee);
                //quitamos cargo para reajustar valores.
                apagar = parseFloat(apagar);

//                $("#totalPagar").text((apagar).toFixed(2));
//                $("#totaltotal").text((apagar).toFixed(2));


                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));
            } else {
//                $("#totalPagar").text((apagar).toFixed(2));
//                $("#totaltotal").text((apagar).toFixed(2));
//                

                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));
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
                $('#txtamountpendiente').html('Amount to Collect $');
                $('#txtamountpendiente').css('color', '#F00');
            } else if (diferencia == 0) {
                $('#saldoporpagar').html((diferencia).toFixed(2));
                $('#txtamountpendiente').html('Amount to Collect $');
                $('#txtamountpendiente').css('color', '#666666');
            } else {
                $('#saldoporpagar').html((diferencia * -1).toFixed(2));
                $('#txtamountpendiente').html('Amount to Collect $');
                $('#txtamountpendiente').css('color', '#00F');
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
    $("#totalPagar").html("$ " + (ttt).toFixed(2));
    var porp = <?php echo $saldoxPagar; ?>;
    $('#saldoporpagar').html((porp).toFixed(2));
</script>
<script>

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

        //document.getElementById("resultado").innerHTML=" \
        //Value: "+resultado;
        z = document.getElementById("resultado").innerHTML = " \ " + resultado;


    }
    </script>

