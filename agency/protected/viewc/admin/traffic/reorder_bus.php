

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/traffic.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/swig.min.js"></script>
<!--jquery para el calendario-->

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>

<style>
    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 20px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        padding: 8px;
        width: 100%;
        float: left;
        clear: both;
    }

    table   th:first-child{
        width: 60px;
    }

    table th{
        font-size: 1em;
    }

    #btn_save{
        float: right;
        margin-top: 30px;
    }

    .error_validate{
        color: red;
    }

    label.error_validate{
        font-size: 9px;
    }

    .driver_am{
        max-width: 60px;
    }

    .driver_pm{
        max-width: 60px;
    }

    .bus_am{
        max-width: 60px;
    }

    .bus_pm{
        max-width: 60px;
    }

    .date{
        max-width: 118px;
    }
</style>

<script>
    $(function(){
        console.log('jquery-ready');
    });</script>

<script type="text/javascript">

</script>

<div id="header_page" >
    <div class="header2">
        Reorder bus <? echo strtoupper($data['time']); ?>
    </div>
    <div  id="toolbar">

        <div class="toolbar-list">
            <ul>
                <li class="btn-toolbar" id="" style="margin-right: 70px">
                    <a id="print_guides_services" class="link-button" href="javascript:void(0);">
                        <span class="icon-" title="Reorder Bus" ><img src="<? echo $data['rootUrl'] ?>global/img/home/lists.png" height="24" width="24">&nbsp;</span>
                        Guides Services <? echo strtoupper($data['time']); ?>
                    </a>
                </li>
                <? if ($data['time'] == 'pm'){ ?>
                <li class="btn-toolbar" id="" style="margin-right: 80px">
                    <a id="reorder_bus" class="link-button" href="<? echo $data['rootUrl']; ?>admin/traffic/index_reorder_bus/am">
                        <span class="icon-" title="Reorder Bus" ><img src="<? echo $data['rootUrl'] ?>global/img/reorder-bus-am.png" height="24" width="24">&nbsp;</span>
                        Reorder bus AM today
                    </a>
                </li>
                <? } ?>
                <? if ($data['time'] == 'am'){ ?>
                <li class="btn-toolbar" id="" style="margin-right: 80px">
                    <a id="reorder_bus" class="link-button" href="<? echo $data['rootUrl']; ?>admin/traffic/index_reorder_bus/pm">

                        <span class="icon-" title="Reorder Bus" ><img src="<? echo $data['rootUrl'] ?>global/img/reorder-bus-pm.png" height="24" width="24">&nbsp;</span>
                        Reorder bus PM today
                    </a>
                </li>
                <? } ?>
                <li class="btn-toolbar" id="btn-cancel">
                    <a  class="link-button" href="<? echo $data['rootUrl'] ?>admin/traffic/index">
                        <span class="icon-back" title="Editar" >&nbsp;</span>
                        Back
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>


<div id="content_page_tours">
    <div id="filter-bar">
        <form method="post" id="form-search">
            <label style="width:70px" class="filter-by"><strong>Date</strong> </label>
            <input  style="width:100px;"  name="fecha_ini" type="text"  id="fecha_ini" size="8" value="<? echo $data['fecha_ini']; ?>" onchange=""/>
            <input type="button" class="search-btn" id="btn-find" />
        </form>
    </div>
    <div style="float: left">
    <? foreach ($data['traffics_agruped_with_bus'] as $traffic_bus): ?>
        <div class="dia" data-bus="<?
            if(isset($traffic_bus['bus'])){
                echo $traffic_bus['bus']['id']; 
            }else{
                echo 'null';
            }
        ?>">
            <label class="label_dia">
                <input class="capacity" name="capacity" type="hidden" value="<?
                if(isset($traffic_bus['bus'])){
                    echo $traffic_bus['bus']['capacity'];
                }else{
                    echo 0;
                }
                ?>">
                <input type="hidden" name="total_pax" class="total_pax" value="<? echo $traffic_bus['total_pax']; ?>">
                <p class="bus_title">
                    <?
                        if(isset($traffic_bus['bus'])){
                            echo $traffic_bus['bus']['name'];
                        }else{
                            echo 'without bus';
                        }
                    ?>.
                    <?
                    if(isset($traffic_bus['bus'])){
                        echo 'Driver: '.$traffic_bus['bus']['firstname'].' '.$traffic_bus['bus']['lastname'].'.';
                    }
                    ?>
                    <?
                    if(isset($traffic_bus['bus'])){
                        echo 'Type: '.$traffic_bus['bus']['type_bus'].'.';
                    }
                    ?>
                </p>
                <span class="span_capacity" style="float: right">Capacity: <span class="span_total_pax"><? echo $traffic_bus['total_pax']; ?></span>/<?
                    if(isset($traffic_bus['bus'])){
                        echo $traffic_bus['bus']['capacity'];
                    }else{
                        echo '0';
                    }
                    ?></span>
            </label>
            <div class="clearfix"></div>
            <span class="botones">
                <button type="button" class="btn_add" data-bus="<?
                if(isset($traffic_bus['bus'])){
                    echo $traffic_bus['bus']['id'];
                }else{
                    echo 'null';
                }
                ?>">
                    Add
                </button>
            </span>
            <table class="table table_bus">
                <thead>
                    <tr>
                        <th></th>
                        <th>PAX</th>
                        <th>SERV</th>
                        <th>TIME</th>
                        <th class="adult">AD</th>
                        <th class="child">CH</th>
                        <th class="total">TOT</th>
                        <th>CODECONF</th>
                    </tr>
                </thead>
                <tbody class="info_traffics" data-bus="<?
                if(isset($traffic_bus['bus'])){
                    echo $traffic_bus['bus']['id'];
                }else{
                    echo 'null';
                }
                ?>">
                    <? foreach ($traffic_bus['traffics'] as $traffic): ?>
                        <tr class="reserva" data-id="<? echo $traffic['id']; ?>" data-bus="<?
                        if(isset($traffic_bus['bus'])){
                            echo $traffic_bus['bus']['id'];
                        }else{
                            echo 'null';
                        }
                        ?>">
                            <td>
                                <input class="check_reserva" type="checkbox" data-id="<? echo $traffic['id']; ?>">
                                <input type="hidden" class="pax" name="pax" value="<? echo $traffic['total_pax']; ?>"></td>
                            <td><? echo $traffic['firstname'].' '.$traffic['lastname']; ?></td>
                            <td>
                                <?
                                    if(isset($traffic['nombre_parque'])){
                                        echo $traffic['nombre_parque'];
                                    }else{
                                        echo $traffic['type_traffic'];
                                    }

                                ?>
                            </td>
                            <td>
                                <?  $hora = '';
                                    if($data['time'] == 'am'){
                                        $hora = $traffic['time_am'];
                                   }else{
                                        $hora = $traffic['time_pm'];
                                    }
                                    echo date ('H:i',strtotime($hora))
                                ?>
                            </td>
                            <td class="adult"><? echo $traffic['adult_t']; ?></td>
                            <td class="child"><? echo $traffic['child_t']; ?></td>
                            <td class="total"><? echo $traffic['total_pax']; ?></td>
                            <td>
                                <?
                                    if(isset($traffic['reserve_code_conf'])){
                                        echo $traffic['reserve_code_conf'];
                                    }elseif(isset($traffic['oneday_code_conf'])){
                                        echo $traffic['oneday_code_conf'];
                                    }elseif(isset($traffic['tours_code_conf'])){
                                        echo $traffic['tours_code_conf'];
                                    }
                                ?>
                            </td>
                        </tr>

                    <? endforeach; ?>

                </tbody>
            </table>
    </div>
    <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <div>
        <button type="button" id="btn_save">Save</button>
    </div>

</div>

<form method="post" id="form_guides_services" action="<? echo $data['rootUrl']; ?>admin/traffic/guides_services_pdf" style="display: none;">
    <input id="id_time_select_report" name="time_select_report" type="hidden" required="required" value="<? echo $data['time']; ?>"/>
    <input type="hidden" name="select_date_guides_services" id="id_select_date_guides_services" value="<? echo $data['date']; ?>" required=""></td>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        if (navigator.userAgent.indexOf('Chrome/2') != -1) {
            $('input[type=date]').live('click', function(event) {
                event.preventDefault();
            });
        }

        $('#print_guides_services').click(function(){
            $('#form_guides_services').submit();
        });

        $( "#fecha_ini" ).datepicker({
            dateFormat:'mm-dd-yy',
            maxDate:   365
        });

        $('#btn-find').click(function(){
            var fecha = $('#fecha_ini').val();
            if (ValidarFecha(fecha)){
                $('#form-search').submit();
            }else{
                alert('La fecha es incorrecta')
            }
        });

        $('.btn_add').click(function(){
            var bus = $(this).attr('data-bus');
            var $bus_div = $('.dia[data-bus="'+ bus +'"]');
            var $info_traffics = $('.info_traffics[data-bus="'+ bus +'"]');
            var bus_pax = $bus_div.find('.total_pax').val();
            bus_pax = parseInt(bus_pax);
            var elementos = $(".check_reserva:checked[data-bus!='"+ bus +"']").toArray();

            $.each(elementos, function(index, value){
                var id_reserva = value.attributes['data-id'].value;
                // reserva seleccionada
                var $reserva = $('.reserva[data-id="'+ id_reserva +'"]');

                //buscamos el bus anterior para evitar que se ejecute la accion si se llama al mismo bus
                var id_bus_anterior = $reserva.attr('data-bus');
                if(id_bus_anterior != bus){

                    $reserva.find('input').removeAttr('checked');

                    // le sumamos los pasajeros al nuevo bus
                    var pax = $reserva.find('.pax').val();
                    pax = parseInt(pax);
                    bus_pax += pax;

                    // buscamos los datos del bus anterior(de donde viene el trafico)

                    var $bus_anterior_div = $('.dia[data-bus="'+ id_bus_anterior +'"]');
                    var pax_bus_anterior = $bus_anterior_div.find('.total_pax').val();


                    // le restamos los pasajeros al bus anterior
                    pax_bus_anterior = parseInt(pax_bus_anterior);
                    pax_bus_anterior -= pax;
                    $bus_anterior_div.find('.total_pax').val(pax_bus_anterior);
                    $bus_anterior_div.find('.span_total_pax').html(pax_bus_anterior);

                    //seleccionamos el bus y transferimos la reserva al bus.
                    $reserva.attr('data-bus', bus);
                    $info_traffics.append($reserva);
                }
            });
            $bus_div.find('.total_pax').val(bus_pax);
            $bus_div.find('.span_total_pax').html(bus_pax);
        });

        $('#btn_save').click(function(){
            var time = '<? echo $data['time']; ?>';
            var buses = [];
            $.each($('.dia'), function(index, value){
                var id_bus = $(this).attr('data-bus');
                var traffics = [];
                $.each($(this).find('.reserva'), function(index, value){
                    var id_traffic = $(this).attr('data-id');
                    traffics.push(id_traffic);
                });
                buses.push({id_bus: id_bus, traffics: traffics});
            });

            var data = {
                time: time,
                buses: buses
            };
            $('#btn_save').attr('disabled', 'disabled');
            $.getJSON('<? echo $data['rootUrl'] ?>admin/traffic/index_reorder_bus/save', data).done(function(data){
                if(data['exito']){
                    alert('successful update');
                }
                $('#btn_save').removeAttr('disabled');
            }).fail(function(){
                    alert('update failed, try again');
                    $('#btn_save').removeAttr('disabled');
                });
        });

    });
</script>