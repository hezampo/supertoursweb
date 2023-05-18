<?php
if (isset($this->data['reserve']) && isset($_SESSION['login'])) {
    $valida = false;
    $reserva = $data['reserve'];
//    print_r($reserva);
//    exit;
    $subto = $data['subto'];
    $rastro = $data['rastro'];
    $pagado = $data['pagado'];
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
<div id="header_page" >
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
                    <a href="<?php echo $data['rootUrl']; ?>admin/reporte/cargar" class="link-button" id="idreserva1">
                        <span class="icon-print" title="imprimir resumen">&nbsp;</span>
                        Summary 
                    </a>
                </li>
                <li class="btn-toolbar" id="btn-rastro">
                    <a  class="link-button" id="btn-rastro">
                        <span class="icon-32-rastro" title="Mostrar Rastro" >&nbsp;</span>
                        Traces
                    </a>
                </li>
                <li class="btn-toolbar" id="btn-save1">
                    <a  class="link-button" id="btn-save1">
                        <span class="icon-32-save" title="Guardar" >&nbsp;</span>
                        Save
                    </a>
                </li>
                <li class="btn-toolbar" id="btn-cancel1">
                    <a  class="link-button" >
                        <span class="icon-back" title="Regresar" >&nbsp;</span>
                        Back
                    </a>
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
            <div class="ho">RESERVATION <span>#</span></div>
            <div id="reser"><?php echo $reserva->codconf; ?><input type="hidden" /></div>
        </div>
        <div id="status">
            <div class="ho">STATUS</div>
            <div id="stat"><?php echo $reserva->estado; ?></div>
        </div>
        <div id="status-change" >
            <div>CHANGE STATUS</div>
            <select id="estado" name="estado">
                <option></option>
                <option <?php if ($reserva->estado == 'CONFIRMED' || $reserva->estado == 'INVOICED') {
    echo ' selected="selected" ';
};
?>  value="CONFIRMED">CONFIRMED</option>
                <option <?php if ($reserva->estado == 'QUOTE') {
    echo ' selected="selected" ';
};
?>  value="QUOTE">QUOTE</option>
                <option value="NOT SHOW W/ CHARGE" <?php if ($reserva->estado == 'NOT SHOW W/ CHARGE') {
    echo ' selected="selected" ';
};
?>>NOT SHOW W/ CHARGE</option>
                <option value="NOT SHOW W/O CHARGE" <?php if ($reserva->estado == 'NOT SHOW W/O CHARGE') {
    echo ' selected="selected" ';
};
?>>NOT SHOW W/O CHARGE</option>
                <option <?php if ($reserva->estado == 'CANCELED') {
    echo ' selected="selected" ';
};
?>  value="CANCELED">CANCELED</option>
            </select>
        </div>
    </div>

    <div id="content_page"  >
        <div id="serpare">
            <input id="fin_calculo" type="hidden" value="false"/>
            <input type="hidden"  id="vista" value="1" />
            <input name="id" type="hidden"  id="id"  value="<?php if (isset($reserva)) {
    echo $reserva->id;
} ?>" />
            <table width="100%">
                <tr><td>
                        <fieldset id="liderpax" style=""><legend>LEADER PASS</legend>
                            <table>
                                <tr>
                                    <td >
                                        <div id="opera" class="input" style="padding-top:5px;">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label style="" id="label" >SEARCH </label>
                                                    </td>
                                                    <td>
                                                        <div class="ausu-suggest" id="opera">
                                                            <input type="text" size="65" value="<?php
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
                                                        <label style="" id="labeldere12">FIRST NAME</label>		
                                                    </td>
                                                    <td width="">
                                                        <input name="firstname1" type="text"  id="firstname1" size="20" maxlength="20" value="<?php if (isset($reserva)) {
    echo $reserva->firsname;
} ?>" />	
                                                    </td>
                                                    <td width="" align="right"> 
                                                        <label style="" id="labeldere12" >LAST NAME </label>
                                                    </td>
                                                    <td width="">  
                                                        <input name="lastname1" type="text"  id="lastname1" size="20" maxlength="20" value="<?php if (isset($reserva)) {
    echo $reserva->lasname;
} ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right">
                                                        <label style="" id="labeldere12">PHONE </label>
                                                    </td>
                                                    <td>
                                                        <input name="phone1" type="text"  id="phone1" size="20" maxlength="20" value="<?php
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
                                                    <td align="right"> 
                                                        <label style="" id="labeldere12">E-MAIL </label>
                                                    </td>
                                                    <td>
                                                        <input name="email1" type="text"  id="email1" size="20" value="<?php if (isset($reserva)) {
                                                                   echo $reserva->email;
                                                               } ?>"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                    <td>
                        <fieldset id="inputype" style="width:40%;"><legend>INPUT TYPE</legend>
                            <div id="opera" class="input">
                                <table width="100%" >
                                    <tr align="left">

                                        <td >
                                            <label style="" id="label">CALL CENTER</label>
                                        </td>
                                        <td >
                                            <input name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                                        </td>

                                    </tr>
                                    <tr><td colspan="2" >
                                            <table width="100%">
                                                <tr>
                                                    <td width="10%">
                                                        <label><strong>AGENCY</strong></label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input name="agency" type="text"  id="agency" size="19" maxlength="30" value="<?php echo $agencia->company_name; ?>"  autocomplete="off"  disabled="disabled"  />
                                                            <input type="hidden" size="4" value="<?php echo $agencia->id; ?>" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="<?php echo $agencia->type_rate; ?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>

                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <label><strong>Employ</strong></label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input style="width:120px;" name="uagency" type="text"  id="uagency" size="11" maxlength="30" value="<?php echo ($agencia->id != -1) ? $userA->firstname . ' ' . $userA->lastname : ''; ?>"  />
                                                            <input type="hidden" size="4" value="<?php echo ($agencia->id != -1) ? $userA->id : ''; ?>" name="id_auser" id="id_auser" autocomplete="off" />
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr><td colspan="2" >&nbsp;</td></tr>
                                    <tr><td colspan="2">
                                            <table align="center" cellspacing="10">
                                                <tr valign="top">
                                                    <td><label  for="calan_phone"> BY PHONE</label> <input name="canal" <?php if ($reserva->canal == 'PHONE') {
                                                                   echo ' checked="checked" ';
                                                               } ?>  type="radio" id="calan_phone" value="PHONE" />  </td>
                                                    <td><label  for="calan_mail"> BY MAIL</label> <input name="canal" <?php if ($reserva->canal == 'MAIL') {
                    echo ' checked="checked" ';
                } ?> type="radio"  id="calan_mail"  value="MAIL" /> </td>
                                                    <td><label for="calan_web"> WEBSALE </label><input name="canal"  <?php if ($reserva->canal == 'WEBSALE') {
                        echo ' checked="checked" ';
                    } ?> type="radio" id="calan_web" value="WEBSALE" />  </td>
                                                </tr>
                                            </table>
                                        </td></tr>
                                </table>
                            </div>

                        </fieldset>
                    </td>
                </tr>
            </table>

            <fieldset id="boo" ><legend>BOOKING</legend>
                <input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php
                    if (isset($reserva)) {
                        if ($reserva->tipo_ticket == 'oneway') {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    }
                    ?>"/>
                <div id="opera" class="input" style="padding-top:5px;"> <label>ONE WAY </label> <input name="tipo_ticket"  id="oneway" type="radio" value="1"
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
                <div id="opera" class="input" style="padding-top:5px;"> <label>ROUND TRIP </label><input name="tipo_ticket" id="roundtrip" type="radio" value="2" <?php
                    if (isset($reserva)) {
                        if ($reserva->tipo_ticket != 'oneway') {
                            echo ' checked ';
                        }
                    }
                    ?> /> </div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;">TYPE OF PASS </label>
                    <select name="tipo_pass" id="tipo_pass" disabled="disabled">
                        <option value="0">NO RESIDENT</option>
                        <option value="1">RESIDENT</option>
                    </select>  
                </div>

                <div id="opera" class="input" style="float: right;"><input name="byr" type="checkbox" value="1" <?php
                    if (isset($reserva)) {
                        if ($reserva->customer_disabilities == 1) {
                            echo ' checked ';
                        }
                    }
                    ?> /><label id="labeldere" style="background-color: rgb(243, 229, 155);"> Customer With Disabilities </label>
                </div>
                <div id="opera" class="input"  style="padding-top:10px; clear:left;">
                    <label style="width:45px"  >ADULT</label>
                    <input name="pax" type="number" min="1"  id="pax" size="2" maxlength="2" value="<?php echo $reserva->pax ?>"  style="width:50px" onchange="
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
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px"  >CHILD</label>
                    <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" value="<?php echo $reserva->pax2 ?>" style="width:50px" min="0" max="15" onchange="
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
                    <label style="width:45px"  ><strong>TOTAL</strong></label>
                    <input name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/>
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">
                    <label style="width:45px"  >INFANT</label>
                    <input name="infat" type="number"  id="infat" size="2" maxlength="2" value="<?php echo $reserva->pax3; ?>" min="0" max="16" style="width:50px"  />
                </div>

    <!--<div id="opera" class="input" style="padding-right:200px; padding-top:10px;"><input name="byr" type="radio" value="" /><label id="labeldere"> Customer With Disabilities </label></div>-->
            </fieldset>
            <!--&nbsp;-->

            <table width="200"  cellspacing="0" class="sup" >
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
            </table>
            <fieldset id="onew" ><legend>ONE WAY</legend>

                <div id="opera" class="input" style="padding-top:18px; ">

                    <label style="width:75px;"  >DEPARTURE </label><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>
                    <input name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value="<?php if (isset($reserva)) {
                        echo ($reserva->fecha_salida == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_salida)));
                    } ?>" autocomplete="off"/>
                </div>

                <div id="opera" class="input"  >
                    <div id="explo">  <label style="width:45px"  > FROM</label></div>
                    <div id="explo" align="left"> 
                        <select name="fromt"  style="width:125px; height:25px;" id="from">
                            <option value=""></option>
<?php foreach ($data["areas"] as $e) { ?>
                                <option value="<?php echo $e["id"]; ?>" <?php if (isset($reserva)) {
        echo (trim($reserva->fromt) == trim($e["id"])) ? 'selected' : '';
    } else {
        echo (trim($e['nombre'] == trim("ORLANDO") ? 'selected' : ''));
    } ?> ><?php echo $e["nombre"]; ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div id="opera" class="input"  >
                    <div id="explo"><label style="width:45px"  > TO</label></div>
                    <div id="explo" align="left">
                        <select name="to"  id="to" style="width:130px; height:25px;">
<?php foreach ($to_areas as $area) { ?>
                                <option value="<?php echo $area['trip_to']; ?>"  <?php echo ($area["trip_to"] == $reserva->tot ? 'selected' : '') ?> >
    <?php echo $area['nombre']; ?>
                                </option>
<?php } ?>
                        </select>
                        <input type="hidden" name="valto" id="valto" value="<?php if (isset($reserva)) {
    echo $reserva->tot;
} ?>"/>
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
                    <div style="width:50px;" id="popup1">  <label style="width:20px"  > TRIP</label><a id="search" style="cursor:pointer;"><img src="<?php echo $data['rootUrl']; ?>global/images/search.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
                        <input type="hidden" id="valorcomision01" name="valorcomision01" value="<?php /* echo $subto['comi1'] */ ?>" /></div>
                    <div style="width:50px;"> <input type="hidden" id="trip_no_c" name="trip_no_c"  value="<?php if (isset($reserva)) {
    echo $reserva->trip_no;
} ?>"/><input name="trip_no" type="text"  id="trip_no" size="3" maxlength="3" value="<?php if (isset($reserva)) {
    echo $reserva->trip_no;
} ?>"  readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input"  style="clear:right; padding-left:7px;">
                    <div style="width:50px;">  <label style="width:45px"  > DEP.TIME</label></div>
                    <div style="width:50px;">
                        <input name="departure1" type="text"  id="departure1" size="5" maxlength="8" value="<?php if (isset($reserva)) {
    echo date("g:i a", strtotime($reserva->deptime1));
} ?>" readonly="readonly"/>
                    </div>
                </div>

                <div id="opera" class="input"  style="clear:left; ">
                    <div style="width:265px;">  <label style="width:150px"  >PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="pickup1" type="text"  id="pickup1" size="40" maxlength="55" value="<?php if (isset($pickup1) && $pickup1 != "") {
    echo $pickup1->place;
} ?>" autocomplete="off"/>
                            <input name="id_p1" type="hidden"  id="id_p1" size="40" maxlength="55" value="<?php if (isset($pickup1) && $pickup1 != "") {
    echo $pickup1->id;
} ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input"  >
                    <div style="width:265px;">  <label style="width:250px"  >DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="dropoff1" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php if (isset($drop1) && $drop1 != "") {
    echo $drop1->place;
} ?>" autocomplete="off"/>
                            <input name="id_dropoff1" type="hidden"  id="id_dropoff1" size="40" maxlength="55" value="<?php if (isset($drop1) && $drop1 != "") {
    echo $drop1->id;
} ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input"  >
                    <div style="width:50px;">  <label style="width:45px"  >ARR.TIME</label></div>
                    <div style="width:50px;">
                        <input name="arrival1" type="text"  id="arrival1" size="5" maxlength="8" value="<?php if (isset($reserva)) {
    echo date("g:i a", strtotime($reserva->arrtime1));
} ?>" readonly="readonly" />
                    </div>
                </div>


                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
                    <select name="ext_from1" id="ext_from1" style='width:123px;' >
                        <option value="0"></option>
                            <?php foreach ($extenFrom1 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion1->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
<?php } ?>
                    </select></div>

                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
                    <select name="ext_to1" id="ext_to1" style='width:123px;'>
                        <option value="0"></option>
<?php foreach ($extenTo1 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion2->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
                        <?php } ?>
                    </select>  </div>
                <div id="opera" class="input" style="padding-left:13px; clear:right;">
                    <label style="width:48px" >ROOM #</label>
                    <input name="room1" type="text"  id="room1" size="4" maxlength="6" value="<?php echo $reserva->room1; ?>" />
                </div>

                <div id="opera" class="input"  style="clear:left; ">

                    <div style="width:300px;">  <label style="width:250px"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten1" type="text"  id="exten1" size="46" maxlength="55" value="<?php echo $reserva->pickup_exten1; ?>" <?php if ($extencion1->id == 0) {
                                    echo ' disabled="disabled" ';
                                } ?>  autocomplete="off"/>
                            <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" >
                    <div style="width:265px;">  <label style="width:250px"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten2" type="text"  id="exten2" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten2; ?>"  <?php if ($extencion2->id == 0) {
                                    echo ' disabled="disabled" ';
                                } ?>  autocomplete="off"/>
                            <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>

            </fieldset>
            <fieldset id="round" style="display:none;"><legend><font color="#990000">ROUND TRIP</font></legend>

                <div id="opera" class="input" style="padding-top:18px; ">

                    <label style="width:75px;"  >DEPARTURE </label><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>
                    <input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php if (isset($reserva) && $reserva->tipo_ticket != 'oneway') {
                                    echo ($reserva->fecha_retorno == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_retorno)));
                                } ?>" autocomplete="off" />
                </div>

                <div id="opera" class="input"  >
                    <div id="explo">  <label style="width:45px"  > FROM</label></div>
                    <div id="explo" align="left">
                        <select name="fromt2"  style="width:125px; height:25px;" id="from2" >
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
                    <div id="explo">  <label style="width:45px"  > TO</label></div>
                    <div id="explo" align="left">
                        <select name="to2"  id="to2" style="width:130px; height:25px;" <?php
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
                <div id="opera" class="input"  >
                    <div style="width:50px;" id="popup2">  <label style="width:20px"  > TRIP</label><a id="search2" style="cursor:pointer;"><img src="<?php echo $data['rootUrl']; ?>global/images/search.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" />
                            <input type="hidden" id="valorcomision02" name="valorcomision02" value="<?php /* echo $subto['comi2'] */ ?>" />
                        </a></div>
                    <div style="width:50px;"><input type="hidden" id="trip_no2_c" name="trip_no2_c"  value="<?php if (isset($reserva)) {
    echo $reserva->trip_no2;
} ?>"/> <input name="trip_no2" type="text"  id="trip_no2" size="3" maxlength="3" value="<?php if (isset($reserva)) {
    echo ($reserva->trip_no2 != 0 ? $reserva->trip_no2 : "");
} ?>"  readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input"  style="clear:right; padding-left:7px;">
                    <div style="width:50px;">  <label style="width:45px"  > DEP.TIME</label></div>
                    <div style="width:50px;">
                        <input name="departure2" type="text"  id="departure2" size="5" maxlength="8" value="<?php if (isset($reserva)) {
    echo ($reserva->deptime2 != "00:00:00" ? date("g:i a", strtotime($reserva->deptime2)) : "");
} ?>" readonly="readonly"/>
                    </div>
                </div>

                <div id="opera" class="input"  style="clear:left; ">
                    <div style="width:265px;">  <label style="width:150px"  >PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="pickup2" type="text"  id="pickup2" size="40" maxlength="55" value="<?php if (isset($pickup2) && $pickup2 != "") {
    echo $pickup2->place;
} ?>" autocomplete="off"/>
                            <input name="id_pickup2" type="hidden"  id="id_pickup2" size="40" maxlength="55" value="<?php if (isset($pickup2) && $pickup2 != "") {
    echo $pickup2->id;
} ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input"  >
                    <div style="width:265px;">  <label style="width:250px"  >DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="dpoff2" type="text"  id="dropoff2" size="39" maxlength="55" value="<?php if (isset($drop2) && $drop2 != "") {
    echo $drop2->place;
} ?>" autocomplete="off"/>
                            <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php if (isset($drop2) && $drop2 != "") {
    echo $drop2->id;
} ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input"  >
                    <div style="width:50px;">  <label style="width:45px"  >ARR.TIME</label></div>
                    <div style="width:50px;">
                        <input name="arrival2" type="text"  id="arrival2" size="5" maxlength="8" value="<?php if (isset($reserva)) {
    echo ($reserva->arrtime2 != "00:00:00" ? date("g:i a", strtotime($reserva->arrtime2)) : "");
} ?>" readonly="readonly" />
                    </div>
                </div>


                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
                    <select name="ext_from2" id="ext_from2" style='width:123px;' >
                        <option value="0"></option>
<?php foreach ($extenFrom2 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion3->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
<?php } ?>
                    </select> 
                </div>

                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
                    <select name="ext_to2" id="ext_to2" style='width:123px;'>
                        <option value="0"></option>
<?php foreach ($extenTo2 as $ex) { ?>
                            <option value="<?php echo $ex['id'] ?>"  <?php echo ($extencion4->id == $ex['id']) ? ' selected ' : ''; ?> > <?php echo $ex['place'] . ' ' . $ex['address'] ?></option>
<?php } ?>
                    </select>  
                </div>
                <div id="opera" class="input"  style="padding-left:13px; clear:right;">
                    <label style="width:48px"  >ROOM #</label>
                    <input name="room2" type="text"  id="room2" size="4" maxlength="6" value="<?php echo $reserva->room2; ?>" />
                </div>
                <div id="opera" class="input"  style="clear:left; ">
                    <div style="width:300px;">  <label style="width:250px"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten3" type="text"  id="exten3" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten3; ?>"   <?php if ($extencion3->id == 0) {
    echo ' disabled="disabled" ';
} ?> autocomplete="off" />
                            <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" >
                    <div style="width:265px;"><label style="width:250px"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten4" type="text"  id="exten4" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten4; ?>"  <?php if ($extencion4->id == 0) {
    echo ' disabled="disabled" ';
} ?>  autocomplete="off" />
                            <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <table width="246" cellspacing="0" class="sup2" style="margin-top: 2px;">
                <tr>
                    <td width="136"><label><strong>QUOTE</strong></label></td>
                    <td width="54"><label><strong>Adult</strong></label></td>
                    <td width="48"><label><strong>Child</strong></label></td>
                </tr>
                <tr>
                    <td><label style="text-align:left;"><strong>Line Transportation</strong></label></td>
                    <td><span name ="transporadult" id="transporadult" value=""></span></td>
                <input type="hidden" name ="transadult" id="transadult"/>
                <input type="hidden" name ="transchild" id="transchild"/>
                <td><span name ="transporechil" id="transporechil"></span></td>
                </tr>
                <tr>
                    <td><label style="text-align:left;"><strong>Extensions</strong></label></td>
                    <td><span id="extenadult"></span></td>
                    <td><span id="extenchil"></span></td>
                </tr>
                <tr>
                    <td><label style="text-align:left;"><strong> Discount %</strong></label></td>
                    <td colspan="2">
                        <input name="descuento" type="number" id="descuento" maxlength="3" onkeyup="valorExtra();" max="100" min="0"  value="<?php echo $reserva->descuento_procentaje; ?>"  style="height:20px; width:100px;" />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left;"><strong> Discount &nbsp;$</strong></label></td>
                    <td colspan="2">
                        <input name="descuento_valor" type="number" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:20px; width:100px;" onkeyup="valorDescuento();"   value="<?php echo $reserva->descuento_valor; ?>"  />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left;"><strong>Extra Charges &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$</strong></label></td>
                    <td colspan="2">
                        <input name="extra" type="text" id="extra" size="12" maxlength="10" style="height:20px;" onkeyup="valorExtra();"  />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left;"><strong>Sub-total per Pax</strong></label></td>
                    <td><span id="subtoadult"></span></td>
                    <td><span id="subtochild"></span></td>
                </tr>
                <tr>
                    <td><label ><strong>Total</strong></label></td>
                    <td colspan="2"><label ><strong id="totaltotal" >$ 00.0</strong></label></td>
                <div id="enviarDatos"></div>
                <input size="5" type="hidden" id="subtochild1" name="subtochild1" value="<?php echo $reserva->precio_trip1_c; ?>" />
                <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild2" name="subtochild2" value="<?php echo $reserva->precio_trip2_c; ?>" />
                <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" value="<?php echo $reserva->precio_trip2_a; ?>" />
                <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="<?php echo $reserva->precio_exten1_a; ?>" />
                <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="<?php echo $reserva->precio_exten2_a; ?>" />
                <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="<?php echo $reserva->precio_exten3_a; ?>"  />
                <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="<?php echo $reserva->precio_exten4_a; ?>" />


                <input size="5" type="hidden" id="subtochild1_o" name="subtochild1_o" value="<?php echo $reserva->precio_trip1_c; ?>" />
                <input size="5" type="hidden" id="subtoadult1_o" name="subtoadult1_o" value="<?php echo $reserva->precio_trip1_a; ?>" />
                <input size="5" type="hidden" id="subtochild2_o" name="subtochild2_o" value="<?php echo $reserva->precio_trip2_c; ?>" />
                <input size="5" type="hidden" id="subtoadult2_o" name="subtoadult2_o" value="<?php echo $reserva->precio_trip2_a; ?>" />
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

            <fieldset id="pymen" style="height:375px;" ><legend >PAYMENT INFORMATIONS</legend>
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
                                <div id="opera" class="input" style="width: 525px;">
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
                                                            <a id="btn-save2" title="Save"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>
                                                            <input type="button" style="display:none" id="enviar_escondido" value="0"  />
                                                            <a  id="pago_agente" style="display:block" ><img style="width: 77px;    margin-top: 36px;cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
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
                                                            <label  style="padding-left:20px; font-size:14px; "><strong style="padding-bottom:10px;">TOTAL </strong></label>
                                                        </td>
                                                        <td>
                                                            <label  style="font-size:16px; padding-left:3px; font-weight:bold;" id="totalPagar" ></label>
                                                            <input name="totP" type="hidden"  id="totP" value="" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label  style="padding-left:20px; font-size:12px; "><strong style="padding-bottom:0px; color:#090;">Total Amount Paid	</strong></label>
                                                        </td>
                                                        <td>
                                                            <label id="saldoPagado" >$  <?php echo number_format($pagado, 2, '.', ','); ?></label>
                                                            <br />
                                                        </td>
                                                    </tr>
                                                    <tr style="background-color: #DCE6F2;">
                                                        <td>
                                                            <label  style="padding-left:20px; font-size:12px; "><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#F00">Amount to Collect </strong></label>
                                                        </td>
                                                        <td><select name="opcion_pago" id="op_pago_id" style="margin-left:10px;">
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
                                                            <label id="saldoporpagar" >$  <?php echo number_format(($saldoxPagar), 2, '.', ','); ?></label>
                                                            <br />
                                                        </td>
                                                    </tr>


                                                    <tr id="tr_otheramount"   ><td>
                                                            <label  style="padding-left:20px; font-size:11px; "><strong style="padding-bottom:10px;">Other Amount $</strong></label>	</td>
                                                        <td>
                                                            <input type="text" id="otheramount" name="otheramount" style="float:left;width:100px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;" value="<?php echo number_format($reserva->otheramount, 2, '.', ','); ?>" onkeyup="CalcularTotalTotal();"  />
                                                        </td>
                                                    </tr>
                                                    <tr id="pay_amount_html" style="height: 50px;">
                                                        <td>
                                                            <label  style="padding-left:20px; font-size:16px; "><strong style="padding-bottom:10px;">Add Payment	$ </strong></label>
                                                        </td>
                                                        <td>
                                                            <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:100px; height:20px;float:left;" />
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
                            <div id="comco" class="input"><div style="width:265px;"><label style="width:150px;padding-left:100%;"  ><strong>NOTES</strong></label></div><textarea id="comments" name="notes" cols="0" rows="0"  style="margin: 2px; width: 339px; height: 180px; "><?php echo trim($reserva->comments); ?></textarea></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                        </td>
                    </tr>
                </table>
                </td>
                </tr>
                </table>

            </fieldset>

        </div>
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

        var resident = '<?php if (isset($reserva)) {
    echo $reserva->resident;
} ?>';
        $("#tipo_pass option[value=" + resident + "]").attr("selected", true);
        var idext1 = '<?php if (isset($reserva)) {
    echo $reserva->extension1;
} ?>';
        $("#ext_from1 option[value=" + idext1 + "]").attr("selected", true);
        var precioa = '<?php if (isset($reserva)) {
    echo $reserva->precioA;
} ?>';
        var precion = '<?php if (isset($reserva)) {
    echo $reserva->precioN;
} ?>';
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
        dateFormat: 'mm-dd-yy'
    });
    $("#dataclick1").click(function (e) {
        e.preventDefault();

        //$("#fecha_salida").datepicker("show");
        return false;
    });
    $('#fecha_retorno').datepicker({
        dateFormat: 'mm-dd-yy',
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
//        $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id+'/'+id_agency));
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
        var url = '<?php echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency;
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
        }
        else {
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
        }
        else {
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
        }
        else if (typeof elemento.selectionStart != 'undefined') {                    //método estándar
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

        var transadult = (parseFloat(transporAdul1) + parseFloat(transporAdul2)) * pax_1;
        var transchild = (parseFloat(transporChil1) + parseFloat(transporChil2)) * pax_2;
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
                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));

            } else {

                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/
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
            $("#totalPagar").text((apagar).toFixed(2));
            $("#totaltotal").text((apagar).toFixed(2));
        } else {
            $("#opcion_saldo2").attr('disabled', false);
            $("#opcion_saldo1").attr('disabled', false);
            if (tipo_pago == 3) {
                apagar = parseFloat(apagar) + parseFloat(fee);
                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));
            } else {
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
                $('#saldoporpagar').html('$ ' + (diferencia).toFixed(2));
                $('#txtamountpendiente').html('Amount to Collect');
                $('#txtamountpendiente').css('color', '#F00');
            } else if (diferencia == 0) {
                $('#saldoporpagar').html('$ ' + (diferencia).toFixed(2));
                $('#txtamountpendiente').html('Amount to Collect');
                $('#txtamountpendiente').css('color', '#666666');
            } else {
                $('#saldoporpagar').html('$ ' + (diferencia * -1).toFixed(2));
                $('#txtamountpendiente').html('Amount to Collect');
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
    $('#saldoporpagar').html('$ ' + (porp).toFixed(2));
</script>

