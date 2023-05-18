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

<style>
    .dobleborde{
        border: 1px solid #0080FF;
        padding: 5px;
        font-family: Verdana, Geneva, sans-serif;
        color: #0B173B;
    }

    .dobleborde2{
        border: 4px double #0080FF;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 0 8px 6px #808080;
        -moz-box-shadow: 0 8px 6px #808080;
        box-shadow: 0 8px 6px #808080;
        padding: 10px;
        font-family: Verdana, Geneva, sans-serif;
        color: #0B173B;
    }
</style>


<?php
$asignacion = $data['asignacion'];
$area_to_from = $data['area_to_from'];
$bus_to_from = $data['bus_to_from'];
$bus_area = $data['bus_area'];
?>
<?php if (isset($_REQUEST['msg'])) { ?>
    <div class="error" style="margin-top: 10px;"><?php /* echo $_REQUEST['msg']; */ ?></div>
<?php } ?>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/trips/reserves-bus-area-save"  class="form" id="form1">


    <div id="header_page" >
        <div class="header">Passengers Bus - Trip <?php echo $data['trip']; ?>, Date <?php echo date('M-d-Y', strtotime($data['fecha'])); ?>

            <input type="hidden" value="<?php echo $data['trip']; ?>" name="trip" id="trip" />
            <input type="hidden" value="<?php echo $data['fecha']; ?>" name="fecha" id="fecha" />  
        </div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar" id="btn-save" ><a class="link-button"  id="btn-save"> <span class="icon-32-save"
                                                                                                        title="Nuevo">&nbsp;</span>
                            Save </a></li>
                    <li class="btn-toolbar" id="btn-cancel">
                        <a href="<?php echo $data['rootUrl']; ?>admin/trips/passengers/<?php echo $data['trip']; ?>/<?php echo date('m-d-Y', strtotime($data['fecha'])); ?>" class="link-button"> <span class="icon-back" title="Editar">&nbsp;</span>
                            Cancel </a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>


</div><div id="prueba"></div>
<div id="datagrid"  class="dobleborde2" >
    <samp style="text-align: center;
          font-size: 12pt;
          font-weight: bold;
          color: #0B55C4;">
        Total Passengers Trip: <?php echo $data['totalPax']; ?>  </samp>
    <br />
    <table border="0">


        <tr>
            <td  style="width:220px;" >
                <div id="Reservas">
                    <?php
                    $tt = 0;
                    foreach ($data['reservas'] as $e) {
                        ?>
                        <div id="div0-area-<?php echo $e['tot']; ?>">
                            <div id="div-area-<?php echo $e['tot']; ?>" style="display:<?php echo ($area_to_from[$e['tot']] != 0) ? 'block' : 'none'; ?>">
                                <fieldset  style="heigth:40px;cursor:pointer; width:200px;" id="area_<?php echo $e['tot']; ?>"
                                           >
                                    <legend onclick="selecionarArea('<?php echo $e['tot']; ?>');"  ><?php echo $e['para'] ?></legend>
                                    <table width="100%">
                                        <tr  >
                                            <td>
                                                <img  src="<?php echo $data['rootUrl']; ?>global/img/admin/expandir.gif" width="16" height="16" id="img_from_<?php echo $e['tot']; ?>" onclick="ocultar('<?php echo $e['tot']; ?>');" />
                                            </td>
                                            <td onclick="selecionarArea('<?php echo $e['tot']; ?>');" >
                                                <label><strong>Quantity
                                                        : <?php echo $e['totalpax'] ?></strong></label>			</td>
                                            <td>
                                                <!--<input type="checkbox" name="areas" value="<?php echo $e['total'] ?>" class="areas" id="<?php echo $e['tot']; ?>" />-->
                                            </td>
                                        </tr>
                                        <tr style="width:220px;" >
                                            <td colspan="3" >
                                                <div style="display:none;" id="div_from_<?php echo $e['tot']; ?>" class="dobleborde" >

                                                    <?php
                                                    
                                                    $j = 0;
                                                    $array = $data['r_to_from'][$e['tot']];
                                                    //print_r($array);
                                                    foreach ($array as $from) {
                                                        
                                                        foreach ($from as $from2) {
                                                        if (!isset($bus_to_from[$e['tot']][$from2['fromt']])) {   ?>
                                                            <table width="100%" class="grid2" cellspacing="0" cellpadding="0" id="div_tot-from-<?php echo $e['tot'] . '-' . $from2['fromt']. '-' . $from2['reserva']; ?>">
                                                                <tbody>
                                                                    <tr class="row0" id="td_from_to_<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva'];; ?>" onclick="selecionarFromTo('<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva'];; ?>');" ><td><?php echo $from2['de'] . '(' . $from2['totalpax'] . ') ' . $from2['nombre1'] . ' ' . $from2['nombre2'] . ''; ?></td>
                                                                        <td width="5%">
                                                                            <input type="checkbox" name="areas" value="<?php echo $from2['totalpax'] ?>"  onclick="selecionarFromTo('<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva']; ?>');" class="from-to"   id="<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva']; ?>" />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                            $j = 1 - $j;
                                                        }                                                        
                                                      }
                                                    }
                                                    ?>

                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </td>
            <td  style="width:50px;">&nbsp;
                <div id="cargaBus">
                </div>
            </td>
            <?php
            $i = 0;
            foreach ($data['buses'] as $e) {
                $i++;
                $col = count($data['reservas']) + 1;
                $h = $col * (40 + 12);
                ?>
                <td width="370px"  height="<?php echo $col ?>px" rowspan="<?php echo $h; ?>">
                    <fieldset  style="">
                        <legend  ><?php echo strtoupper($e['plate'] . '-' . $e['tipobus'] . ', capacity: ' . $e['capacidad']); ?></legend>
                        <table>
                            <tr>
                                <td>
                                    <button type="button" value="<?php echo $e['id_bus']; ?>" name="add-<?php echo $e['id_bus']; ?>" id="add-<?php echo $e['id_bus']; ?>" >ADD</button>
                                </td>
                                <td >
                                    <button type="button" value="<?php echo $e['id_bus']; ?>" name="delete-<?php echo $e['id_bus']; ?>" id="delete-<?php echo $e['id_bus']; ?>" >DELETE</button>
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <div id="areaBus<?php echo $e['id_bus']; ?>">
                            <?php
                            foreach ($data['reservas'] as $ar) {
                                $diaplay = isset($bus_area[$e['id_bus']][$ar['tot']]) ? 'block' : 'none';
                                ?>

                                <div id="div-bus-area-<?php echo $e['id_bus']; ?>-<?php echo $ar['tot']; ?>" style="
                                     display:<?php echo $diaplay; ?>">
                                    <fieldset style="heigth:40px;cursor:pointer;" id="bus-area-<?php echo $e['id_bus'] . '-' . $ar['tot']; ?>"
                                              >
                                        <legend  ><?php echo $ar['para'] ?></legend>
                                        <table width="100%">
                                            <tr style="width:220px;" >
                                                <td colspan="3" >
                                                    <div  id="div_bus-tot-<?php echo $e['id_bus'] . '-' . $ar['tot']; ?>" >
                                                        <?php
                                                        $j = 0;
                                                        $array = $data['r_to_from'][$ar['tot']];
                                                        foreach ($array as $from) {
                                                            foreach ($from as $from2) {
                                                            if (isset($asignacion[$ar['tot']][$from2['fromt']]) && $asignacion[$ar['tot']][$from2['fromt']] == $e['id_bus']) {
                                                                ?>
                                                                <table width="100%" class="grid2" cellspacing="0" cellpadding="0" 
                                                                       id="div_tot-from-<?php echo $ar['tot'] . '-' . $from2['fromt']. '-' . $from2['reserva']; ?>">
                                                                    <tbody>

                                                                        <tr class="row0" id="td_from_to_<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva']; ?>" onclick="selecionarFromTo('<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva']; ?>');" ><td><?php echo $from2['de'] . '(' . $from2['totalpax'] . ')' . $from2['nombre1'] . ' ' . $from2['nombre2'] . ''; ?></td>
                                                                            <td width="5%">
                                                                                <input type="checkbox" name="areas" value="<?php echo $from2['totalpax'] ?>"  onclick="selecionarFromTo('<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva']; ?>');"  class="from-to"   id="<?php echo $from2['fromt'] . '-' . $from2['tot']. '-' . $from2['reserva']; ?>" />
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                                <?php
                                                                $j = 1 - $j;
                                                            }}
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>

                                </div>


    <?php } ?>

                        </div>
                    </fieldset>
                </td>
<?php } ?>
        </tr>
        <tr>
            <td>

                <input type="hidden" name="opcionGuardar" id="opcionGuardar" value="<?php echo $data['msg_areas']; ?>" />
            </td>
        </tr>
    </table>

    <div id="pagination">

    </div>
</div>

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
<script type="text/javascript">

    function selecionarArea(id) {
        var color;
        if (document.getElementById(id).checked) {
            document.getElementById(id).checked = false;
            color = '#F6F6F6';
        } else {
            color = '#ffd';
            document.getElementById(id).checked = true;
        }
        cambiarbg('area_' + id, color, 700);
    }



    function cambiarbg(id, color, tiempo) {
        $('#' + id).animate({
            'background-color': color
        }, tiempo);
    }


    $('.areas').click(function () {
        var id = $(this).attr('id');
        var color;
        if (document.getElementById(id).checked) {
            color = '#ffd';
        } else {
            color = '#F6F6F6';
        }
        cambiarbg('area_' + id, color, 700);
    });

    $('.from-to').click(function () {
        var id = $(this).attr('id');
        var dato = id.split('-');
        var fromt = dato[0];
        var tot = dato[1];
        document.getElementById(tot).checked = false;
        cambiarbg('area_' + tot, '#F6F6F6', 700);

    });


    $('button').click(function () {
        var id = $(this).val();
        var id2 = $(this).get(0).name;
        var accion = id2.substring(0, 3);
        if (accion == 'add') {
            agregar(id);
        } else {
            var accion = id2.substring(0, 6);
            if (accion == 'delete') {
                sacar();
            } else {
                alert('Accion no valida' + id);
            }
        }
    });
    var guardar = 0;
    function agregar(bus) {
        var num = document.getElementsByName('areas').length;
        var agre = false;
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('areas').item(i).checked) {
                agre = true;
                var area = document.getElementsByName('areas').item(i).id;
                $("#prueba").load('<?php echo $data['rootUrl']; ?>admin/trips/reserves-bus-area-add/' + area + '/' + bus);
            }
        }
        if (!agre) {
            alert('Select the areas to add to the bus');
        }
    }

    function sacar() {
        var num = document.getElementsByName('areas').length;
        var agre = false;
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('areas').item(i).checked) {
                agre = true;
                var area = document.getElementsByName('areas').item(i).id;
                $("#prueba").load('<?php echo $data['rootUrl']; ?>admin/trips/reserves-bus-area-dell/' + area);
            }
        }
        if (!agre) {
            alert('Select the areas to add to the bus')
        }
    }
    
    function meter_bus(area, bus) {
        $('#div-area-' + area).appendTo('#bus-' + bus + '-area-' + area);
        $('#' + area).attr('checked', false);
        var color = '#F6F6F6';
        cambiarbg('area_' + area, color, 1500);
    }

    function meter_bus2(tot, fromt,id_reserva, bus, divp, nrt, bus_v, op_radio) {
        var divbus = '#div-bus-area-' + bus + '-' + tot ;
        var divbus2 = '#bus-area-' + bus + '-' + tot ;
        var filtarea = '#area_' + tot;
        var divnuevo = '#div_bus-tot-' + bus + '-' + tot;
        
        if(id_reserva != 0){
            var contenido = '#div_tot-from-' + tot + '-' + fromt+'-'+id_reserva;
        }else{
            var contenido = '#div-area-' + tot;
        }
        
        var radio = '#' + fromt + '-' + tot;
        if (bus_v != 0) {
            var busviejo = '#div-bus-area-' + bus_v + '-' + tot;
            $(busviejo).hide("blind", {direction: "vertical"}, 100);
        } else {
            if (nrt == 0) {
                $(filtarea).hide("blind", {direction: "vertical"}, 100);
            }
        }
        if (divp == 1) {
            $(divbus).show("blind", {direction: "vertical"}, 100);
            $(divbus2).show("blind", {direction: "vertical"}, 100);
        }
        if (op_radio == 1) {
            selecionarFromTo(fromt + '-' + tot + '-' + id_reserva);
        } else {
            selecionarFromTo(fromt + '-' + tot + '-' + id_reserva);
            selecionarFromTo(fromt + '-' + tot + '-' + id_reserva);
        }
        $(contenido).appendTo(divnuevo);
    }

    function sacar_bus(tot, fromt,id_reserva, bus, cont) {
        var contenido = '#div_tot-from-' + tot + '-' + fromt + '-'+id_reserva;
        var divnuevo = '#div_from_' + tot;
        var filtarea = '#area_' + tot;
        var divFilt = '#div-area-' + tot;
        var divviejo = '#bus-area-' + bus + '-' + tot;
        var radio = '#' + fromt + '-' + tot;
        $(contenido).appendTo(divnuevo);
        $(divFilt).show("blind", {direction: "vertical"}, 50);
        $(filtarea).show("blind", {direction: "vertical"}, 100);

        if (cont == 0) {
            $(divviejo).hide("blind", {direction: "vertical"}, 300);
        }
        selecionarFromTo(fromt + '-' + tot + '-'+id_reserva);
    }

    function ocultar(to) {
        var img = '#img_from_' + to;
        var td = '#div_from_' + to;
        if ($(td).is(":visible")) {
            var url = '<?php echo $data['rootUrl']; ?>global/img/admin/expandir.gif';
            $(img).attr('src', url);
            $(td).hide("blind", {direction: "vertical"}, 100);
        } else {
            var url = '<?php echo $data['rootUrl']; ?>global/img/admin/contraer.png';
            $(img).attr('src', url);
            $(td).show("blind", {direction: "vertical"}, 100);
        }
    }

    function selecionarFromTo(id) {
        var color;
        if (document.getElementById(id).checked) {
            document.getElementById(id).checked = false;
            color = '#FFF';
        } else {
            color = '#ffd';
            document.getElementById(id).checked = true;
        }
        cambiarbg('td_from_to_' + id, color, 700);
    }

    $('#btn-save').click(function () {
        if ($("#opcionGuardar").val() != '') {
            alert($("#opcionGuardar").val());
        } else {
            $('#form1').submit();
        }
    });


</script>



