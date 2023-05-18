<?php
$tours = $this->data['tours'];
$pagado = $this->data['pagado'];
$rastro = $this->data['rastro'];
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
?>
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
</style>

<?php if (isset($_GET['menssage'])) { ?>
    <div class="success"><?php echo $_GET['menssage']; ?></div>
<?php } ?>
<?php if (isset($_GET['error'])) { ?>
    <div class="error"><?php echo $_GET['error']; ?></div>
<?php } ?>
<span id="limpiar"></span>
<div id="header_page" style="background-image: url('<?php echo $data['rootUrl']?>global/img/bg2.jpg');" >
    <div class="header">Tours [ Edit ] ID  <?php echo $tours->id; ?></div>

    <div  id="toolbar">
        
        <select style="margin-right:136px; margin-top:12px; width:220px; background: #AC1B29;color: #fff;border-color: transparent;" name="fnombre" id="rate" onclick = "capturar();" onchange="obtenerValor(this.value);">
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
        
        <input type="text" name="rates" id="rates" style="display: none" size="4" value= "<?php echo $agency['tour_name']; ?>" />
        <script type="text/javascript">
            var obtenerValor = function (x) {
                document.getElementById('rates').value = x;
                net_rate.value = x;
            };
        </script>    
        
        <div class="toolbar-list">
            <ul>
                <li style="margin: 0 -92px -26px;margin-top: 6px;">
                    <form action="<?php echo $data['rootUrl'] ?>admin/tours/edit/resumen" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
                        <input type="text" id="variable" name="variable" hidden readonly style="width: 13%;" value="<?php echo $tours->id; ?>" />
                   <!-- <input type="submit" value="summary" />-->
                        <input  type="submit" value="Summary" style="margin-top: -10.5px; margin-left: -14px; padding: 10px; color: #AC1B29;font-weight: 700;" />
                    </form>
                    
                    <script type="text/javascript">
                        var variableJs = document.getElementById("variable").value;

                        function onEnviar() {
                            document.getElementById("variable").value = variableJs;
                        }
                    </script>

                </li>
                <li class="btn-toolbar" id="btn-rastro">
                    <a class="link-button" id="btn-rastro2">
                        <span class="icon-32-rastro" title="Nuevo" style="margin-top: -13px; margin-left: -4px; ">&nbsp;</span>
                        Traces
                    </a>
                </li>
                <li class="btn-toolbar" id="btn-cancel">
                    <a class="link-button" >
                        <span class="icon-back" title="Editar" style="margin-top: -13px; margin-left: 4px;" >&nbsp;</span>
                        Back
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="content_page_tours" style="z-index:1;width: 984px; margin-top: -28px; background-image: url('<?php echo $data['rootUrl']?>global/img/bg2.jpg');">

    <form id="form1" class="form" action="" method="post" name="form1">

        <div id="info-group" style="width: 900px;">
            <div id="cancelation">
                <div class="ho" style="background: #bb0000;">CANCELATION <span>#</span></div>
                <div id="cancel" style="background: #fff;">00000</div>
            </div>
            <div id="reservation"  style="width:200px;">
                <div class="ho" style="background: #bb0000;">RESERVATION <span>#</span></div>
                <div id="reser" style="background: #fff;"><?php echo $tours->code_conf; ?></div>
            </div>
            <div id="status">
                <div class="ho" style="background: #bb0000;">STATUS</div>
                <div id="stat" style="background: #fff;"><?php echo $tours->estado; ?></div>
            </div>
            <div id="status-change">
                <div style="color: #fff;background: #bb0000;padding: 4px;margin-top: 0px; margin-left: 135px; text-align: -webkit-auto;">CHANGE STATUS</div>
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
                <select id="estado" name="estado" style="margin-left: -7px; margin-top: -1px;">
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
        <fieldset id="inputype" class="rojo" style="float: left; margin-bottom: 2%; border-radius: 3px 120px 0px 80px;width: 48%;">
            <legend style="border: 1px solid #B83A36;; background: #fff;">INPUT TYPE</legend>
            <div id="opera" class="input">
                <table width="100%" >
                    <tr align="left">
                        <td >
                            <label style="color:#FFFFFF;" id="label">CALL CENTER</label>
                        </td>
                        <td >
                            <input name="nombre" style="margin-left:-4px;" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr><td colspan="2" >
                            <table width="100%">
                                <tr>
                                    <td width="10%">
                                        <label style="margin-top:10px; color:#FFFFFF;">AGENCY</label>
                                    </td>
                                    <td width="40%">
                                        <div class="ausu-suggest" >
<!--                                            disabled="disabled"-->
                                            <input name="agency" type="text" style="margin-top:15px; margin-left:4px;"  id="agency" size="19" maxlength="30" value="<?php echo $agencia->company_name; ?>" autocomplete="off"  />
                                            <input type="hidden" size="4" value="<?php echo $agencia->id; ?>" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                            <input type="hidden" size="4" value="<?php echo $agencia->type_rate; ?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                            <input type="hidden" size="4" value="<?php echo $disponible; ?>" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                            <input type="hidden" size="4" value='<?php echo ($data['comision'] > 1) ? $data['comision'] : 0; ?>' name="comision" id="comision" autocomplete="off" />
                                        </div>
                                    </td>
                                    <td width="10%">
                                        <label style="margin-top:10px; margin-left:4px; color:#FFFFFF;">Employ</label>
                                    </td>
                                    <td width="40%">
                                        <div class="ausu-suggest" >
                                            <input style="width:170px; margin-top:15px; margin-left:4px;" name="uagency" type="text"  id="uagency" autocomplete="off" size="11" maxlength="30" value="<?php echo $userA->firstname . ' ' . $userA->lastname ?>" disabled="disabled" >
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
    
        <fieldset id="liderpax" style="margin-left:1px; width: 180px;border-radius: 130px 3px 80px 0px; width:90px;" class="cerati" >
            <legend style="border: 1px solid #00C; margin-left:64px; background: #fff;">LEADER PASS</legend>
            <table>
                <tr>
                    <td>
                        <div id="opera" class="input" style="padding-top:5px;">
                            <table>
                                <tr>
                                    <td>
                                        <label style="margin-left:25px; color:#FFFFFF;" id="label"> SEARCH </label>
                                    </td>
                                    <td>
                                        <div class="ausu-suggest" id="opera">
                                            <input type="text" size="65" style="margin-left:2px; width:341px;" value="<?php echo $data['cliente']->lastname . ' ' . $data['cliente']->firstname . ' - E-Mail -' . $data['cliente']->username ?>" name="cliente" id="cliente" autocomplete="off">

                                            <input type="hidden" size="4" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled" value="<?php echo $data['cliente']->id ?>" readonly="readonly">
                                            <div class="ausu-suggestionsBox"></div></div>
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
                                        <input name="lastname1" type="text" style="margin-left:2px; width:136px;" id="lastname1" size="20" maxlength="20" value="<?php echo $data['cliente']->lastname ?>">
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
                                        <input name="email1" type="text" id="email1" size="20" style="margin-left:2px; width:136px; margin-top:6px;" value="<?php echo $data['cliente']->username ?>">
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
        <fieldset style="margin-top: 5px; border-radius: 10%;margin-top: 2%; margin-bottom: 1%;"class="gris2">
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
                                <table >
                                    <tr >
                                        <td>
                                            <label style="width:100px; font-size: 11px; color: #000;"  >START DATE </label>
                                        </td>
                                    </tr>
                                    <tr><td>
                                            <a href="" id="dataclick1" ><i class="fa fa-calendar" style="font-size: 21px; color: #000;"></i></a>
                                            <!--<a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                            <input name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value="<?php
                                            list($anio, $mes, $dia) = explode('-', $tours->starting_date);
                                            echo $mes . '-' . $dia . '-' . $anio;
                                            ?>" onchange="fechaRetorno(this.value);" autocomplete="off"  />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div id="opera" class="input"> <table><tr><td>

                                            <label style="width:100px;font-size: 11px; color: #000;">END DATE</label>
                                        </td></tr>
                                    <tr><td>
                                            <!--<a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                            <a href="" id="dataclick2">
                                                <i class="fa fa-calendar " style="font-size: 21px; color: #000;"></i>
                                            </a>
                                            <input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php
                                            list($anio, $mes, $dia) = explode('-', $tours->ending_date);
                                            echo $mes . '-' . $dia . '-' . $anio;
                                            ?>"   autocomplete="off"   />
                                        </td></tr></table>
                            </div>
                        </td>
                        <td>
                            <div class="fields">
                                <label style="font-size: 10px;"><b>ADULT(S)</b></label><br />
                                <input style="font-size:16px" name="adult" id="adult" type="number" value="<?php echo $tours->adult; ?>" max="100" min="1">
                            </div>
                        </td>


                    <input type="text" name="frates" readonly="readonly" id="rates" hidden="hidden"  value= "<?php echo $agency['tour_name']; ?>" />


                    <td>

                        <div class="fields">
                            <label style="font-size: 10px;"><b>CHILD(S)</b></label><br />
                            <input style="font-size:16px" name="child" id="child" type="number" value="<?php echo $tours->child; ?>" max="100" min="0">
                        </div>
                    </td>
                    <td style="width:100px;">
                        <label for="tipo_pass"><span style="font-size: 10px;">Resident </span></label>
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

                    <fieldset id="arrival" class="cerati" style="border-radius: 7%;" >
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
                                                    <td><div class="label" style="color: #fff; font-size: 12px;">ARRIVAL</div></td>
                                                    <td>
                                                        <ul class="list">
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
                                                        <div id="t-total">
                                                            <div id="price_transport1pp" class="price">$ 0.00</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="arrival-content">
                                            <div id="transport1" class="group" align="left">

                                                <?php if ($transfer_in->type == 1) { ?>
                                                    <table width="100%"><tr>
                                                            <td>
                                                                <div id="div_from">
                                                                    <div class="label" style="font-size: 12px; color: #fff;">FROM</div>
                                                                    <select style="width:190px" name="from" id="from" class="select" onchange="change_from();">
                                                                        <option value="0"></option>
                                                                        <?php foreach ($data["to_areas"] as $e) { ?>
                                                                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == $reserve->fromt ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>


                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="div_to">
                                                                    <div class="label" style="font-size: 12px; color: #fff;">TO</div>
                                                                    <select style="width:190px" name="to" id="to" class="select">
                                                                        <?php foreach ($data["area_park"] as $e) { ?>
                                                                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="trip">
                                                                    <div class="label" style="font-size: 12px; color: #fff;">TRIP</div>
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                                <span>
                                                                                    <input class="field" name="a_trip_no" type="text" id="a_trip_no" size="3" maxlength="3" value="<?php echo $reserve->trip_no; ?>" readonly="readonly"/>
                                                                                    <input type="hidden" name="deptime1"  id="deptime1" value="<?php echo $reserve->deptime1; ?>" />
                                                                                    <input type="hidden" name="arrtime1"  id="arrtime1" value="<?php echo $reserve->arrtime1; ?>" />
                                                                                    <input type="hidden" name="trip1a"  id="trip1a" value="0" />
                                                                                    <input type="hidden" name="trip1c"  id="trip1c" value="0" />
                                                                                </span>
                                                                            </td>
                                                                            <td onclick="mostrarTrip1()">
                                                                                <a><i style="cursor:pointer; color: #fff; font-size: 23px;" id="popup1" class="fa fa-search-plus"></i></a>
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
                                                                    <div  style="width:100%" class="ausu-suggest">
                                                                        <input name="a_pickup1" style="width:100%"
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
                                                                        <td width="25%"> <font style="color: #fff; font-size: 12px;">EXTENSION AREA:</font> </td>
                                                                        <td>
                                                                            <select name="ext_from1" id="ext_from1" class="select" style="width:200px;" onchange="change_ext_from1();">
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
                                                                        <td>&nbsp;</td>
                                                                        <td width="15%">
                                                                            <div id="rooms">
                                                                                <div class="label"> <font style="color: #fff; font-size: 12px;">LUGGAGE </font></div>
                                                                                <span><input name="a_luggage" type="text" id="a_luggage" size="2" maxlength="1" value="<?php echo $reserve->luggage1; ?>" class="field"/></span>
                                                                            </div>
                                                                        </td>
                                                                        <td width="15%">
                                                                            <div id="rooms">
                                                                                <div class="label"><font style="color: #fff; font-size: 12px;">ROOM #</font></div>
                                                                                <span><input name="a_room1" type="text" id="a_room1" size="5" maxlength="10"  class="field" value="<?php echo $reserve->room1; ?>"/></span>
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
                                                                        <input name="a_pickup4" style="width:100%" <?php
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
                        <fieldset id="departure" style="background-color: #F3DCDC;border-radius: 25px;" class="rojo">
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
                                                            <ul class="list">
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
                                                        <td title="Price of transport per person">   <div id="t-total">

                                                                <div id="price_transport2pp" class="price">$ 0.00</div>
                                                            </div></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="departure-content">
                                                <div id="transport2" class="group" align="left">
                                                    <?php if ($transfer_out->type == 1) { ?>
                                                        <table width="100%"><tr>
                                                                <td>
                                                                    <div id="div_from2">
                                                                        <div class="label" style="font-size: 12px; color: #fff;">FROM</div>
                                                                        <select style="width:190px" name="from2" id="from2" class="select">
                                                                            <?php foreach ($data["area_park"] as $e) { ?>
                                                                                <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="div_to2">
                                                                        <div class="label" style="font-size: 12px; color: #fff;">TO</div>
                                                                        <select style="width:190px" name="to2" id="to2" class="select" onchange="change_to2();" >
                                                                            <option value="0"></option>
                                                                            <?php foreach ($data["to_areas"] as $e) { ?>
                                                                                <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == $reserve->tot2 ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="trip">

                                                                        <div class="label" style="font-size: 12px; color: #fff;">TRIP</div>
                                                                        <table><tr><td>
                                                                                    <span><input class="field" name="d_trip_no" type="text" id="d_trip_no" size="3" maxlength="3" value="<?php echo $reserve->trip_no2; ?>"
                                                                                                 readonly="readonly"/>
                                                                                        <input type="hidden" name="deptime2"  id="deptime2" value="0" />
                                                                                        <input type="hidden" name="arrtime2"  id="arrtime2" value="0" />
                                                                                        <input type="hidden" name="trip2a"  id="trip2a" value="0" />
                                                                                        <input type="hidden" name="trip2c"  id="trip2c" value="0" />
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <a rel="superbox[ajax][<?php echo $data['rootUrl']; ?>admin/tours/trips/arrival][300x100]">
                                                                                        <i style="cursor:pointer; color: #fff; font-size: 23px;" id="popup1" class="fa fa-search-plus"></i>

                                                                                    </a>
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
                                                                            <input name="d_pickup1" style="width:100%"  <?php
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
                                                                            <td width="25%" style="font-size: 12px; color: #fff;">EXTENSION AREA: </td>
                                                                            <td>
                                                                                <select name="ext_to2" id="ext_to2" class="select" style="width:200px;" onchange="change_ext_to2();">
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
                                                                            <td>&nbsp;</td>
                                                                            <td width="15%">
                                                                                <div id="rooms">
                                                                                    <div class="label" style="font-size: 12px; color: #fff;">LUGGAGE</div>
                                                                                    <span><input name="d_luggage" type="text" id="d_luggage" size="2" maxlength="1" value="<?php echo $reserve->luggage2; ?>" class="field"/>
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                            <td width="15%">
                                                                                <div id="rooms">
                                                                                    <div class="label" style="font-size: 12px; color: #fff;">ROOM #</div>
                                                                                    <span><input name="d_room1" type="text" id="d_room1" size="5"  value="<?php echo $reserve->room2; ?>"  class="field"/></span>
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
                                                                            <input name="a_pickup2" style="width:100%" <?php
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
                        <fieldset id="hotelfieldset" style="border-radius: 5%;" class="verde">
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
                                                                        <select name="select_rooms" id="select_rooms" class="select">

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
                                                            <div class="price" id="amount_hotel"><?php //echo '$ '.number_format($hotel_reserve->total_paid,2,'.','.');      ?></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <td colspan="2">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="7%">
                                                                <div class="label"><strong style="font-size: 14px;">HOTEL</strong></div>
                                                            </td>
                                                            <td width="25%" >
                                                                <div  style="width:100%; font-size: 12px;" class="ausu-suggest">
                                                                    <input  style="width:250px; font-size: 12px; " class="field" type="text" value="" id="hotel_name" autocomplete="off"
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
                                                                <fieldset style="width: 270px;float: left; background: transparent;border: 1px solid #000;"><legend style="color: #000;">START DATE / END DATE</legend>
                                                                    <a href="" id="dataclick1_h" ><i class="fa fa-calendar fa-2x" style="font-size: 21px; color:#000;"></i></a>
                                                                    <input name="fecha_salida_h" type="text"  id="fecha_salida_h" size="10" maxlength="15" value="<?php echo date('m-d-Y', strtotime($tours->starting_date)); ?>" onchange="fechaRetorno_h(this.value);" autocomplete="off"  />
                                                                    <a href="" id="dataclick2_h" ><i class="fa fa-calendar fa-2x" style="font-size: 21px; color:#000;"></i></a>
                                                                    <input name="fecha_retorno_h" type="text"  id="fecha_retorno_h" size="10" maxlength="15" value="<?php echo date('m-d-Y', strtotime($tours->ending_date)); ?>"   autocomplete="off"   />
                                                                </fieldset>
                                                                <fieldset style="float: left; height:36px; background: transparent;border: 1px solid #000;"><legend style="color: #000;">FREE DAYS</legend>
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
                                                                        <input type="number" style="font-size:12px; margin-left:19px; margin-top:3px; width:29px; " name="frday" id="frday"  value="<?php echo $hotel_reserve['freeday']; ?>" max="8" min="0" autocomplete="off">
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
                                                                    <input name="button" type="button" id="add_Hotel_list"  style="height:30px" value="Add to list" />
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
                                                                            <input type="hidden" name="hotel_breakfast_<?php echo $i; ?>" id="hotel_breakfast_<?php echo $i; ?>" value="<?php if($tours->id_hotel_reserve != -1){ echo $data['hoteles'][$i]->breakfast;}else{echo 0;}?>"/>
                                                                            <input type="hidden" name="hotel_buffet_<?php echo $i; ?>" id="hotel_buffet_<?php echo $i; ?>" value="<?php if($hotel_reserve['breakfastprice']==0){echo  0;}else{echo 1;}?>"/>                                                                   
                                                                            <input type="hidden" name="hotel_nochesfree_<?php echo $i; ?>" id="hotel_nochesfree_<?php echo $i; ?>"  min="0" value="<?php echo trim($hotel_reserve['free_night']);?>"/>                                                                     
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
        <div style="" id="resultado"></div>
        <!-- Parks Edit -->
        <fieldset style="border-radius: 5%;" class="brown">           
            
            
            <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;">
                          <label for="opcion_parks_edit" style=" cursor:pointer; " >PARKS EDIT</label><input type="radio"  id="opcion_parks_edit" checked="checked" value="1" />                
                          </legend>
                          <div id="parks_edit">                   

            <?php
            $color_row = array('#3E7D1C', '#FC2E02', '#4B0082', '#0174DF', '#DF7401', '#AEB404', '#585858');
            $ind_color = 8;



            $sql = "SELECT p1.nombre as PARQUE,g1.nombre AS GRUPO, a1.adult, a1.child, a1.admission_adtul,
                    a1.admission_child, a1.totalTraspor, a1.v_p_adult, a1.v_p_child, a1.total_paid, a1.cantidad 
                    FROM attraction_trafic a1
                    LEFT JOIN parques p1 on (a1.id_park = p1.id)
                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)
                    WHERE a1.id_tours = $tours->id AND a1.type_tour = 'MULTI'";

            $rs = Doo::db()->query($sql);
            $atracadm = $rs->fetchAll();
            //print_r($atracadm);             

            $table = "<table border=3 font-weight: bold; align='center' style='text-align: center; color: #FFFFFF;'>";
            $table .=" <tr style='color: #000;background:#FFFFFF; font-size:15px;'>
              <td>PARK</td>                 
              <td>GROUP</td>                 
              <td>&nbsp;&nbsp;&nbsp;ADMISSION ADULT&nbsp;&nbsp;&nbsp;</td>
              <td>&nbsp;&nbsp;&nbsp;ADMISSION CHILD&nbsp;&nbsp;&nbsp;</td>
              <td>&nbsp;&nbsp;&nbsp;TRANSPORT&nbsp;&nbsp;&nbsp;</td>
                   </tr>
                 ";


            foreach ($atracadm as $clave => $key) {
                $ind_color++;
                $ind_color %= 7;

                //capturamos las admisiones de adultos y ninos
                $adm_Ad = $key['admission_adtul'];
                $adm_Ch = $key['admission_child'];

                //capturamos el numero de adultos y ninos

                $No_adult = $key['adult'];
                $No_child = $key['child'];


                //calculamos las respectivas tarifas para adultos y ninos

                $tf_adult = ($adm_Ad) / ($No_adult);

                if ($No_child == 0) {

                    $tf_child = 0;
                } else {

                    $tf_child = ($adm_Ch) / ($No_child);
                }



                $table .="<tr font-size:14px; bgcolor=${color_row[$ind_color]}>";
                $table .="<td> " . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $key["PARQUE"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "</td>";
                $table .="<td>" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $key['GRUPO'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "</td>";
                $table .="<td> $ " . $tf_adult . ".00</td>";
                $table .="<td> $ " . $tf_child . ".00</td>";
                //echo"<td>&nbsp;&nbsp;".$key['admission_adtul']."&nbsp;&nbsp;".$key['admission_child']."</td>";
                $table .="<td> $ " . $key['totalTraspor'] . ".00</td>";
                $table .= "</tr>";
            }
            $table .= "</table>";
            echo $table;

            //             $sql2 = "SELECT a1.adult,a1.child,a1.cantidad,g1.nombre AS GRUPO, SUM(total_paid) AS TOTAL, ROUND(SUM(v_p_adult)) AS ADM_ADULT, ROUND(SUM(v_p_child)) AS ADM_CHILD
            //                    FROM attraction_trafic a1
            //                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)                    
            //                    WHERE id_tours = $tours->id AND type_tour = 'MULTI'";

            $sql2 = "SELECT a1.adult,a1.child,g1.nombre AS GRUPO, ROUND(SUM(total_paid)) AS TOTAL, ROUND(SUM(totalAdmission)) AS TOTADM, ROUND(SUM(admission_adtul)) AS SUMADMADULT, ROUND(SUM(admission_child)) AS SUMADMCHILD, ROUND(SUM(totalTraspor)) AS TTRANSPORT,
                    ROUND(SUM(v_p_adult)) AS ADM_ADULT, ROUND(SUM(v_p_child)) AS ADM_CHILD
                    FROM attraction_trafic a1
                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)                    
                    WHERE id_tours = $tours->id AND type_tour = 'MULTI'";

            $rs = Doo::db()->query($sql2);
            $atracadm2 = $rs->fetchAll();

            foreach ($atracadm2 as $clave => $key) {
                
            }

            $adultos = $key['adult'];
            $ninos = $key['child'];
            $price_total_paid = $key['TOTAL'];
            //echo $price_total_paid;
            //SUMATORIA DE ADMISIONES PARA ADULTOS Y NINOS
            $adm_adult = $key['ADM_ADULT'];
            $adm_child = $key['ADM_CHILD'];
            $cantidad = $key['cantidad'];
            
            //echo $cantidad;
            $totadm = $key['TOTADM'];
            $totTransport = $key['TTRANSPORT'];
            $sum_admission_adult = $key['SUMADMADULT'];
            $sum_admission_child = $key['SUMADMCHILD'];

            $totadadult = ($adultos) * ($adm_adult);

            $totadninos = ($ninos) * ($adm_child);

            $totadparks = ($totadadult) + ($totadninos);
            
            
//            $sql3 = "SELECT MAX(a2.cantidad) AS CANT,MAX(g2.nombre) AS GRUPO
//                    FROM attraction_trafic a2
//                    LEFT JOIN grupo_parques g2 on (a2.group = g2.id)                                   
//                    WHERE id_tours = $tours->id AND type_tour = 'MULTI'";
//
//            $rs3 = Doo::db()->query($sql3);
//            $atracadm3 = $rs3->fetchAll();
//            //print_r($atracadm3);
//
//            foreach ($atracadm3 as $clave3 => $key3) {
//                
//            }
//
//            $cantidad = $key3['CANT'];
//            $grupo = $key3['GRUPO'];
            //echo $cantidad;
//            echo $grupo;
            //echo '>>'.$totadparks;
            
            if ($cantidad == 0) {
                echo $respuesta_html81 .= "<p style='margin-left: -1px; color: #07218B;'><blink> <b>" . "</b>&nbsp;&nbsp;TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $sum_admission_adult . ".00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $sum_admission_child . ".00</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadm . ".00</strong>.</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 2) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 3) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 4) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 5) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 6) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 7) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }

            if ($cantidad == 8) {
                echo $respuesta_html .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . $key['cantidad'] . "</b> tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</blink></p>";
                echo $respuesta_html2 .= "<p style='margin-left: 20px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION ADULT: $&nbsp;<strong>" . $totadadult . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION CHILD: $&nbsp;<strong>" . $totadninos . "</strong><b>" . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TOTAL ADMISSION PARKS: $&nbsp;<strong>" . $totadparks . ".00</strong>.</b>&nbsp;&nbsp;&nbsp; TOTAL TRANSPORT. SUPPLEMENT: $&nbsp;<strong>" . $totTransport . ".00</strong></blink></p>";
            }





//             echo   $respuesta_html3 .= "<p style='margin-left: 64px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION CHILD: $&nbsp;<strong>" .$totadninos."</strong></blink></p>"; 
//             echo   $respuesta_html4 .= "<p style='margin-left: 64px; color: #07218B;'><blink> <b>" . "</b> TOTAL ADMISSION PARKS: $&nbsp;<strong>" .$totadparks."</strong></blink></p>"; 
            ?>
            
             </div>
            <input type="hidden" id="totalparque" name="totalparque" value="<?php echo $totadparks; ?>">
        </fieldset>
        <br />        
        <!-- Parks -->
<!--        <input type="text" name="op" id="op" style="" size="10" maxlength="10" style=" margin-left: -70px;" value="">-->
        <div id="traffic">
            <fieldset style="border-radius: 5%;">
                <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;">
                    <div id="chk_traffic">
                        <label for="opcion_traffic" style=" cursor:pointer; " >TRAFFIC TOURS  </label><input type="radio" id="opcion_traffic" checked="checked" <?php echo ($numpark > 0) ? 1 : 0; ?> value="2" />
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
                                                            <select name="categoria_park" id="categoria_park" class="select">
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
                                                                <input style="width:300px; font-size: 12px; " class="field" id="park_name" type="text" autocomplete="off" />
                                                                <input type="hidden" name="id_park" id="id_park" value=""/>
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
        <fieldset style="border-radius: 5%;" class="gris2">
            <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;"><div id="chk_traffic">
                    <div class="label">COSTO SUMMARY</div></div></legend>
            <table><tr>
                    <td width="60%">
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
                                        <table >
                                            <tr>
                                                <td valign="" >
                                                    <div id="t-total2">
                                                        <div class="label" style="text-align:left;  font-size: 14px;"><strong>TOTAL AMOUNT </strong>  </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:168px;">
                                                        <input type="hidden" name="id_tours" id="id_tours" value="<?php echo $tours->id; ?>" />
                                                       
                                                        <div class="price">
                                                            <samp  id="totalAmount">$ 0.00</samp>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!--<label style="text-align:left;"><strong> Disc %</strong></label>                           
                                                    <input name="descuento" type="number" id="descuento" maxlength="3" onchange="valorDescuentoPorec();" max="100" min="0"  value="<?php echo $tours->descuento_procentaje; ?>"  style="height:16px; width:100px;" />-->
                                                    
                                                    <label style="margin-left:12px; text-align:left; color: black; "><strong> Disc %</strong></label>                           
                                                    <input name="descuento" type="number" id="descuento" maxlength="3" onchange="valorDescuentoPorec();" max="100" min="0"  value=""  style="height:16px; width:100px; margin-left:8px; margin-top:2px;" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label style="font-weight:bold;text-align:left; color: #000">Extra Charges</label></td>
                                                <td colspan="0">
                                                    <input name="extra" type="text" id="extra" size="12" style=" text-align:left; color: #000; padding-left:5px; width:168px; height:16px; font-size: 16px;
                                                           font-weight: 600;" min="0" onkeyup="valorExtra();"  value="<?php echo $tours->extra_charge ?>" autocomplete="off" />
                                                </td>
                                                <td>
                                                    <label style="margin-left:12px; text-align:left; color: #000;"><strong> Disc &nbsp;$</strong></label>                            
                                                    <input name="descuento_valor" type="number" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="color: #000;height:16px; width:100px; margin-left:10px; margin-top:2px;" onchange="valorDescuentoValor();"  value="<?php echo $tours->descuento_valor; ?>"  />                            
                                                    
                                                    
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
                                                    <div id="t-total2" style="width:170px;">
                                                        <input autocomplete="off" type="text"  name="otheramount" id="otheramount" value="<?php echo $tours->otheramount_sin_tax ?>"
                                                               style="color: #000; text-align:left; padding-left:5px; font-size: 16px; font-weight: 600; width:168px; height:16px;" />
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
                                                    <div id="div_pagado" class="t-total3" style="width:168px;">
                                                        <div class="price">
                                                            <samp  id="saldoporpagar">$ 0.00</samp>
                                                        </div>
                                                    </div>
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label  style=" font-weight:bold;color:#00F; text-align:left; ">Total Amount Paid</label>
                                                </td>
                                                <td>
                                                    <div id="t-total" style="width:168px;">
                                                        <div class="price" style="border: 1px #33F solid;background-color: #00f;color: #fff;">
                                                            <samp  id="pagado">$  <?php echo number_format(($pagado), 2, '.', ','); ?></samp>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #DCE6F2;">
                                                <td>
                                                    <div id="t-total3">
                                                        <!--<div class="label" style="width:150px; color:#00F;"><strong><label class="label" id="txtSaldoDiff" style="font-weight:bold;  text-align:left; ">Amount to Collect</label></strong></div>-->
                                                        <div class="label" style="width:150px; color:#00F;"><strong><label class="label" id="txtSaldoDiff" style="font-weight:bold;  text-align:left; color: #000;">Amount to Collect</label></strong></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="div_actual" class="t-total3">
                                                        <div class="price" style="border:1px #33F solid; background-color:#00f; color:#fff;">
                                                            <samp id="saldoactual">$0.00</samp>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="opcion_pago" id="op_pago_id" style="margin-left:10px;">
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
                                                </td>
                                            </tr>
                                            <tr id="pay_amount_html">
                                                <td valign="" >                                
                                                    <a  id="pago_agente" style="display:block;float: left;" ><img style="width: 59px;    margin-top: 14px;cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" />

                                                    </a>
                                                    <label style="text-align:left;    position: absolute;   margin-top: 19px;    margin-left: 68px;">Pay a Amount</label>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:170px;">
                                                        <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:167px; height:20px;" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="opcion_pago_2" style="margin-left:10px;">
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
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                 <!--<a style="cursor:pointer" id="btn-save2"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>-->
                                                    <a style="margin-top: 20px; margin-right: -55px; cursor:pointer" id="btn-save2"><i class="fa fa-floppy-o fa-4x" style="color: #AC1B29;"></i></a>
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
                    <td style="width:300px;" align="left" valign="bottom">
                        <div id="" class="input"><div style="width:275px;"><label style="width:150px;"  ><strong>NOTES</strong></label></div><textarea id="comments" name="comments" cols="0" rows="0"  style="width: 339px; height: 250px; "><?php echo $tours->comments; ?></textarea></div>
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
    </form>
    <div id="userr"></div>
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
<div style="margin-left: 100%;margin-top: -25px;">
<!--    <input type="text" name="pricechilds" id="pricechilds" style="display:none" size="10" maxlength="10" style="margin-left: 254px;" value="<? echo $tour->t_price_child; ?>"></div>-->


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

            var url = encodeURI('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $tours->code_conf; ?>');

            window.open(url, '_blank');
            return false;
        });
        $(window).load(function () {
            //alert("Se cargo");
                
            
            document.getElementById('frday').value = '<?php echo $hotel_reserve['freeday']; ?>';
            document.getElementById('rates').value = 0;
//            document.getElementById('opcion_parks_edit').value = 1;
//            document.getElementById('op').value = 1;
            $("#content").css("opacity", "1");
            var sel_payment = '<?php echo $reserva->op_pago; ?>';
            $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
            calcularTotalPago();

            ocultar('attractions');
            $("#opcion_traffic").val(1);
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
//                document.getElementById('opcion_parks_edit').value = 1;
//                document.getElementById('op').value = document.getElementById('opcion_parks_edit').value;    
               
                $("#opcion_traffic").attr('checked', false);
                
                
                
            });
            
            $("#opcion_traffic").change(function () {
                var i = $(this).val();
                $(this).val((1 - i));
                ocultar('attractions');
                //actualizacion
                ocultar('parks_edit');
                $("#opcion_parks_edit").val(0);
//                document.getElementById('opcion_traffic').value = 2;
//                document.getElementById('op').value = document.getElementById('opcion_traffic').value;               
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

                var url = '<?php echo $data['rootUrl']; ?>admin/tours/selectpark/' + id_park + '/' + id_group + '/' + adult + '/' + child + '/' + fecha_salida + '/' + fecha_retorno + '/' + platinum + '/' + id_agency;
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
                                if((noches-nochesfree) == 0){
                                    var valorDesyuno = 0;
                                }else{
                                    var valorDesyuno = priceBreakfast/(adult*(noches-nochesfree));
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

                    $("#form1").attr('action', '<?php echo $data['rootUrl']; ?>admin/tours/saveedit');
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
                    $("#nochesfree").attr('max',diferencia);
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
                msj = '- From is required (The departure area).';
                titulo = 'The departure area ';
                mensaje(msj, titulo, 'from');
                return false;

            }
            if (to == '' || to == 0) {
                msj = '- To is required (The arrival area).';
                titulo = 'The arrival area ';
                mensaje(msj, titulo, 'to');
                return false;
            }
            $(".content-popup").html(" ");
            var url = '<?php echo $data["rootUrl"]; ?>admin/tours/selectTrip1/' + from + '/' + to + '/' + fecha_salida + '/' + totalpax + '/' + tipopas + '/' + agency + '/' + rates;
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
            var url = '<?php echo $data["rootUrl"]; ?>admin/tours/selectTrip2/' + from + '/' + to + '/' + fecha_retorno + '/' + totalpax + '/' + tipopas + '/' + agency + '/' + rates;
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
            } else {
                $("#a_pickup1").attr('disabled', true);
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
                                    var nochesfree = ($("#nochesfree").val() == '')? 0 : trim($("#nochesfree").val());
                                    var url = '<?php echo $data['rootUrl']; ?>admin/tours/selecthotel/' + id_hotel + '/' + fecha_salida + '/' + fecha_retorno + datosroom + '/' + id_agency + '/' +nochesfree+'/' + free_buffet + '/' + rates + '/' + frday;
                                    
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
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            $("#tablePark").load('<?php echo $data['rootUrl']; ?>admin/tours/delete_park/' + id_park + '/' + adult + '/' + child);
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
            
//            var nombre_hotel = $("#hotel_name").val();
//            if (nombre_hotel != "") {
//                nombre_hotel = "";
//                $("#nombre_hotel").val();
//            }  
            
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

                
                
                //////////Al ataque total precio de parques ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                
                     
                if ($("#opcion_parks_edit").is(':checked')) {
                    var priceTransportLocal = calcularTransportLocal(adult, child);
                    var priceAdmision = ('<?php echo $price_total_paid ; ?>' - priceTransportLocal);
                    var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                }
                else {
                if($("#opcion_traffic").is(':checked')){
                    var priceTransportLocal = calcularTransportLocal(adult, child);
                    var priceAdmision = calcularAdmision(adult, child);
                    var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                  }
                }    
 
                //////////////////////
                
               // var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                
                //            } else {
                //                var priceTransportLocal = 0;
                //                var priceAdmision = 0;
                //                var totalpark = 0;
//                         }
                var total = parseFloat(totalTranspor1) + parseFloat(totalTranspor2) + parseFloat(totalHotel) + parseFloat(totalpark);

                //        console.log(total);
                $("#price_transport1pp").text('$ ' + ((totalTranspor1 / totalpax)*totalpax).toFixed(2));
                $("#price_transport2pp").text('$ ' + ((totalTranspor2 / totalpax)*totalpax).toFixed(2));
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
                    var totalTranspor1 = parseFloat(priceTranspor1) + parseFloat(priceExten1);
                } else {
                    var totalTranspor1 = 0;
                }
                //Transporte 2
                if ($("#opcion_transfer_out").is(':checked')) {
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
        function calcularTotalPago() {

            var total = calcularTotal();

            var child = $('#child').val();
            var adult = $('#adult').val();
            if (child == "") {
                child = 0;
            }
            if (adult == "") {
                adult = 0;
            }
            var totalpax = (parseInt(adult) + parseInt(child));
            //Calculamos comision
            var comi = 0/*comision()*/;
            var full = total + 0/*comision()*/;
            var balance = full - comi;
            var disponible = $("#disponible").val();
            var agency = $("#id_agency").val();
            var pagado = '<?php echo $pagado; ?>';
            var tipo_pago = 0;
            var num = document.getElementsByName('opcion_pago').length
            for (var i = 0; i < num; i++) {
                if (document.getElementsByName('opcion_pago').item(i).checked) {
                    tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
                }
            }
            var tipo_pago = $("#op_pago_id option:selected").val();
            var tipo_saldo = $('#opcion_pago_saldo').val();
            var apagar = full;
            if (tipo_saldo == 2) {
                apagar = balance;
            }

            valor = apagar;
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
                porcentaje = $("#descuento").val();
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
                var fee = other * fee_n;
                apagar = other;
            } else {
                var fee = apagar * fee_n;
            }

            var totalPax = parseFloat(child) + parseFloat(adult);
            $("#valorComision").text(comi.toFixed(2));

            //Calculamos total segun el tipo de pago
            if (tipo_pago == 5) {
                if (disponible - apagar < 0 && disponible != -1) {//Validamos saldo disponible
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
                } else {
                    $("#opcion_saldo1").attr('checked', true);
                    $("#opcion_saldo2").attr('disabled', true);
                    $("#opcion_saldo1").attr('disabled', false);
                    $("#opcion_pago_saldo").val('1');
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
            }


            if (tipo_pago == 3) {
                apagar = parseFloat(apagar) + parseFloat(fee);
                valor = parseFloat(valor) + parseFloat(fee);
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
        function setTotalPagar(valor, total, pagado) {
            valor = valor;
            var apagar = total;
            var other = parseInt($("#otheramount").val());

            $("#totalAmount").text('$ ' + (valor).toFixed(2));

            var diff_apagar = parseFloat(apagar) - parseFloat(pagado);


            //    if(pagado == 0){
            //        var diff_apagar = 0;
            //    }
            $('#saldoactual').html('$ ' + (diff_apagar).toFixed(2));
            //Restamos el valor pagado

            if (apagar >= 0) {
                $("#saldoporpagar").text('$ ' + (apagar).toFixed(2));//+Math.ceil((apagar)).toFixed(2)
                $('#txtSaldoPorPagar').html('Total Amount');
                $('#txtSaldoPorPagar').css('color', '#F00');

            } else {
                $("#saldoporpagar").text('$ ' + (apagar * -1).toFixed(2));//Math.ceil((apagar*-1)).toFixed(2)
                $('#txtSaldoPorPagar').html('Debit note for client');
                $('#txtSaldoPorPagar').css('color', '#00F');
                $('#div_pagado').attr('class', 't-total4');
            }
        }
        function valorExtra() {
            calcularTotalPago();
        }
        function valorDescuentoPorec() {
            calcularTotalPago();
        }
        function valorDescuentoValor() {
            calcularTotalPago();
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
                    $("#uagency").attr('disabled', true);
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
            var sel_payment = '<?php echo $op_pago; ?>';
            //alert(sel_payment);
            $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
        });

    </script>
    
    <script>
         
     function combo()
        {     
                
           $(document).ready(function() {
            // Así accedemos al Texto de la opción seleccionada
            var valor = $("#rate option:selected").html();
            //alert(valor);
            
            tour_name.value= valor;
                                                  
            });
            
        }  
</script>
<!-- <script>

        var z
        function capturar2()
        {
            var resultado = "ninguno";

            var porNombre = document.getElementsByName("opcion_parks_edit");
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
    
  <script>

        var z
        function capturar3()
        {
            var resultado = "ninguno";

            var porNombre = document.getElementsByName("opcion_traffic");
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
    </script>-->

<!--    <script>
        function habilitar(value)
        {
            if (value == "1")
            {
                // Habilitamos el grupo de parques de WDW/UNIVERSAL/SEAWORLD

//                document.getElementById("categoria_park")[0].style.display = 'block';
//                document.getElementById("categoria_park")[1].style.display = 'block';
//                document.getElementById("categoria_park")[2].style.display = 'block';
//                document.getElementById("categoria_park")[3].style.display = 'none';
//                document.getElementById("categoria_park")[4].style.display = 'none';
//                document.getElementById("categoria_park")[5].style.display = 'none';
//                document.getElementById("categoria_park")[6].style.display = 'none';

            }

            if (value == "2")
            {
                // Habilitamos el grupo de parques de WATER PARKS & HOLY LAND

//                document.getElementById("categoria_park")[0].style.display = 'none';
//                document.getElementById("categoria_park")[1].style.display = 'none';
//                document.getElementById("categoria_park")[2].style.display = 'none';
//                document.getElementById("categoria_park")[3].style.display = 'block';
//                document.getElementById("categoria_park")[4].style.display = 'none';
//                document.getElementById("categoria_park")[5].style.display = 'none';
//                document.getElementById("categoria_park")[6].style.display = 'block';


            }

           
        }




    </script>-->