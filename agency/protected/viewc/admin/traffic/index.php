<!--Actualizado por Ing. Arturo Bustamante Madariaga [2016-2018]-->

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
        width: 110%;
        float: left;
        clear: both;
    }

    #header_page {
        width: 111%;
    }

    #header {
        width: 111%;
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

    .ui-icon{
        display: inline-block !important;
    }

    .parking{
        width: 70px;
    }
</style>

<script>
    $(function(){
        console.log('jquery-ready');
    });</script>

<script type="text/javascript">

</script>

<div id="header_page" >
    <div class="header2"></div>
    <div  id="toolbar">

        <div class="toolbar-list">
            <ul>
                <li class="btn-toolbar" id="" style="margin-right: 10px">
                    <a id="open_reports" class="link-button" href="javascript:void(0);">
                        <span class="icon-" title="Reorder Bus" ><img src="<?php echo $data['rootUrl'] ?>global/img/home/lists.png" height="24" width="24">&nbsp;</span>
                        Reports
                    </a>
                </li>

                <li class="btn-toolbar" id="" style="margin-right: 80px">
                    <a id="reorder_bus" class="link-button" href="<?php echo $data['rootUrl']; ?>admin/traffic/index_reorder_bus/am">
                        <span class="icon-" title="Reorder Bus" ><img src="<?php echo $data['rootUrl'] ?>global/img/reorder-bus-am.png" height="24" width="24">&nbsp;</span>
                        Reorder bus AM today
                    </a>
                </li>

                <li class="btn-toolbar" id="" style="margin-right: 80px">
                    <a id="reorder_bus" class="link-button" href="<?php echo $data['rootUrl']; ?>admin/traffic/index_reorder_bus/pm">

                        <span class="icon-" title="Reorder Bus" ><img src="<?php echo $data['rootUrl'] ?>global/img/reorder-bus-pm.png" height="24" width="24">&nbsp;</span>
                        Reorder bus PM today
                    </a>
                </li>

                <li class="btn-toolbar" id="" style="margin-right: 80px">
                    <a id="update_drivers" class="link-button" href="javascript:void(0);">
                        <span class="icon-" title="Update Drivers" ><img src="<?php echo $data['rootUrl'] ?>global/img/home/resource-group.png" height="24" width="24">&nbsp;</span>
                        drivers update today
                    </a>
                </li>
                <li class="btn-toolbar" id="" style="margin-right: 40px">
                    <a id="update_parks" class="link-button" href="javascript:void(0);">
                        <span class="icon-" title="Update Parks" ><img src="<?php echo $data['rootUrl'] ?>global/img/parque-de-diversiones.png" height="24" width="24">&nbsp;</span>
                        update time parks
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
            <input  style="width:100px;"  name="fecha_ini" type="text"  id="fecha_ini" size="8" value="<?php echo $data['fecha_ini']; ?>" onchange=""/>
            <input type="button" class="search-btn" id="btn-find" />
            <?php //echo print_r($data['attraction_traffic_query']) ?>
            <?php //print_r($data['dias']) ?>
            <?php //print_r($data['select_date']) ?>
        </form>
    </div>
    <h4>Tours</h4>
    <table id="tours" class="grid">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Pax name</th>
                <th>In</th>
                <th>Out</th>
                <th>Days</th>
                <th>Nights</th>
                <th>Ad</th>
                <th>Chd</th>
                <th>Tot</th>
                <th>Type</th>
                <th>Hotel</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                foreach($data['all_tours'] as $tour){
            ?>
            <tr class="row<?php echo $i; ?>" data-id="<?php echo $tour['id']; ?>" data-type="<?php echo $tour['type']; ?>">
                <td>
                    <label>
                        <input class="item" name="item" type="radio" value="<?php echo $tour['id']; ?>">
                    </label>
                </td>
                <td>
                    <?php echo $tour['code_conf']; ?>
                    <input type="hidden" name="id_tour" class="id_tour" value="<?php echo $tour['id']; ?>">
                </td>
                <td>
                    <?php echo $tour['firstname'].' '.$tour['lastname']; ?>
                    <input type= "hidden" name="id_client" type="" class="id_client" value="<?php echo $tour['id_client']; ?>">
<!--                    hidden-->
                </td>
                <td>
                    <?php echo $tour['starting_date']; ?>
                    <input name="starting_date" type="hidden" class="starting_date" value="<?php echo $tour['starting_date']; ?>">
                </td>
                <td>
                    <?php echo $tour['ending_date']; ?>
                    <input name="ending_date" type="hidden" class="ending_date" value="<?php echo $tour['ending_date']; ?>">
                </td>
                <td>
                    <?php echo $tour['days']; ?>
                    <input name="days" type="hidden" class="days" value="<?php echo $tour['days']; ?>">
                </td>
                <td>
                    <?php echo $tour['nights']; ?>
                    <input name="nights" type="hidden" class="nights" value="<?php echo $tour['nights']; ?>">
                </td>
                <td>
                    <?php echo $tour['adult']; ?>
                    <input name="adult" type="hidden" class="adult" value="<?php echo $tour['adult']; ?>">
                </td>
                <td>
                    <?php echo $tour['child']; ?>
                    <input name="child" type="hidden" class="child" value="<?php echo $tour['child']; ?>">
                </td>
                <td>
                    <?php echo $tour['adult'] + $tour['child']; ?>
                    <input name="total_pax" type="hidden" class="total_pax" value="<?php echo $tour['adult'] + $tour['child']; ?>">
                </td>
                <td>
                    <?php echo $tour['type']; ?>
                    <input name="type_tour" type="hidden" class="type_tour" value="<?php echo $tour['type']; ?>">
                </td>
                <td>
                    <?php echo $tour['nombre_hotel']; ?>
                    <input type="hidden" class="" value="">
                </td>
                <td class="reload">
                      <img src="<?php echo $data['rootUrl']; ?>global/img/admin/reload.png" width="20px" height="20px">
                </td>
            </tr>
            <?php
                $i = 1 - $i;
                }
            ?>
        </tbody>
    </table>

    <h4>Traffic</h4>
    <form id="form_traffics">
        <table class="grid" id="table_traffics">
            <thead>
                <tr>
<!--                    <th>Parks</th>-->
                    <th>Original Service</th>
                    <th>Type tickets</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Time AM</th>
                    <th>Time PM</th>
                    <th>Date</th>
                    <th>Bus AM</th>
                    <th>Driver AM</th>
                    <th>Bus PM</th>
                    <th>Driver PM</th>
                    <th>Parking</th>
                    <th>Include Tickets</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </form>
    <button type="button" id="btn_save" disabled>Save</button>
</div>

<div id="dialog-form" title="Update time the parks today">

    <form id="form_update_parks">
        <fieldset>
            <table>
                
                <tr>
<!--                    <td>
                        <label for="id_park_to_update">Park</label>
                    </td>
                    <td>
                        <select id="id_park_to_update" name="park_to_update" required="required">
                            <option value="">---------</option>
                            <?php foreach($data['parques'] as $park){ ?>
                                <option value="<?php echo $park->id; ?>"><?php echo $park->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </td>-->
                </tr>
                
                <tr>
                    <td>
                        <label for="id_park_to_update">Park</label>
                    </td>
                    <td>
                        <select id="id_park_to_update" name="park_to_update" required="required">
                            <option value="">---------</option>
                            <?php foreach($data['parques'] as $park){ ?>
                                <option value="<?php echo $park->id; ?>"><?php echo $park->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="id_days_filter">Days</label>
                    </td>
                    <td>
                        <select id="id_days_filter" name="days_filter" required="required">
                            <option value="">---------</option>
                            <?php for($i=1; $i<20; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="id_nights_filter">Nights</label>
                    </td>
                    <td>
                        <select id="id_nights_filter" name="nights_filter" read>
                            <option disabled="disabled" value="">---------</option>
                            <?php for($i=0; $i<19; $i++){ ?>
                                <option disabled="disabled" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="id_time_am">Time am</label>
                    </td>
                    <td>
                        <input type="time" name="time_am" id="id_time_am" value="08:00" class="text ui-widget-content ui-corner-all" required="required" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="id_time_pm">Time pm</label>
                    </td>
                    <td>
                        <input type="time" name="time_pm" id="id_time_pm" value="18:00" class="text ui-widget-content ui-corner-all" required="required" />
                    </td>
                </tr>
            </table>

            <input type="hidden" id="id_fecha_actual" name="fecha_actual" value="<?php echo $data['date']; ?>">
        </fieldset>
    </form>
</div>

<div id="dialog-driver-bus-form" title="drivers update today">

    <form id="form_update_driver_bus">
        <fieldset>
            <table>
                <tr>
                    <td><label for="id_bus_to_update">Bus</label></td>
                    <td>
                        <select id="id_bus_to_update" name="bus_to_update" required="required">
                            <option value="">---------</option>
                            <?php foreach($data['buses'] as $bus){ ?>
                                <option value="<?php echo $bus['id']; ?>"><?php echo $bus['name']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="id_driver_to_update">Driver</label></td>
                    <td>
                        <select id="id_driver_to_update" name="driver_to_update" required="required">
                            <option value="">---------</option>
                            <?php foreach($data['drivers'] as $driver){ ?>
                                <option value="<?php echo $driver['id']; ?>"><?php echo $driver['firstname'].' '.$driver['lastname']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="id_time_select">Time (AM/PM)</label></td>
                    <td>
                        <select id="id_time_select" name="time_select" required="">
                            <option value="">---</option>
                            <option value="all">ALL</option>
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                        </select>
                    </td>
            </table>
            <input type="hidden" id="id_fecha_actual" name="fecha_actual" value="<?php echo $data['date']; ?>">
        </fieldset>
    </form>
</div>

<div id="dialog-reports" title="Reports">
    <div id="accordion">
<!--        <h3>Daily Arrival</h3>
        <div>
            <form method="post" id="form_daily_arrival" action="<?php /*echo $data['rootUrl']; */?>admin/traffic/daily_arrival_pdf">
                <table>
                    <tbody>
                        <tr>
                            <td><label for="id_initial_date">Date</label></td>
                            <td><input type="date" name="initial_date" id="id_initial_date" value="<?php /*echo $data['date']; */?>" required=""></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="button" style="float: right" id="print_daily_arrival">Submit</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>-->
        <h3>Daily Arrival Extension </h3>
        <div>
            <form method="post" id="form_daily_exten_arrival" action="<?php echo $data['rootUrl']; ?>admin/traffic/daily_arrival_exten_pdf">
                <table>
                    <tbody>
                        <tr>
                            <td><label for="id_initial_date">Date</label></td>
                            <td><input type="date" name="initial_exten_date" id="id_initial_exten_date" value="<?php echo $data['date']; ?>" required=""></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="button" style="float: right" id="print_daily_exten_arrival">Submit</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <h3>Guides Services</h3>
        <div>
            <form method="get" id="form_guides_services" action="<?php echo $data['rootUrl']; ?>admin/traffic/guides_services_pdf">
                <table>
                    <tbody>
                    <tr>
                        <td><label for="id_time_select_report">Time</label></td>
                        <td>
                            <select id="id_time_select_report" name="time_select_report" required="required">
                                <option value="">----</option>
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="id_select_date_guides_services">Date</label></td>
                        <td><input type="date" name="select_date_guides_services" id="id_select_date_guides_services" value="<?php echo $data['date']; ?>" required=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="button" style="float: right" id="print_guides_services">Submit</button></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <h3>Envelopes</h3>
        <div>
            <form method="get" id="form_tickets_pdf" action="<?php echo $data['rootUrl']; ?>admin/traffic/tickets_pdf">
                <table>
                    <tbody>
                    <tr>
                        <td><label for="id_select_date_tickets_pdf">Date</label></td>
                        <td><input type="date" name="select_date_tickets_pdf" id="id_select_date_tickets_pdf" value="<?php echo $data['date']; ?>" required=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="button" style="float: right" id="print_tickets_pdf">Submit</button></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
<!--        <h3>Tickets</h3>
        <div>
            <form method="post" id="formu_tiketes" action="<?php /*echo $data['rootUrl']; */?>admin/traffic/tiketes_pdf">
                <table>
                    <tbody>
                        <tr>
                            <td><label for="fecha_inicial">Date</label></td>
                            <td><input type="date" name="fecha_inicial" id="fecha_inicial" value="<?php /*echo $data['date'];*/ ?>" required=""></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="button" style="float: right" id="print_tiketes">Submit</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>-->
        
    </div>
</div>

<script type="text/template" id="tr_traffic">
    {% if traffics.length > 0 %}
        {% for traffic in traffics %}
            <tr class="row{% if loop.index0 % 2 == 0 %}0{% else %}1{% endif %}" data-id="{{ traffic.id}}" data-index="{{ loop.index0 }}" data-type-traffic="{{ traffic.type_traffic }}" data-id-park="{{ traffic.id_park }}">
                <td>
                    {% if traffic.type_traffic == 'PARK' %}
                        {{ traffic.nombre_parque }}
                    {% else %}
                        {{ traffic.type_traffic }}
                    {% endif %}
                    <input class="traffic_id" type="hidden" name="traffic_id" value="{{ traffic.id}}"> </td>
                <td>
                    <select class="type_ticket" name="type_ticket-{{ loop.index0 }}">
                        <option value="">----</option>
                        {% for type_ticket in type_tickets %}
                        <option value="{{ type_ticket.id }}" {% if traffic.type_ticket == type_ticket.id %} selected {% endif %}>{{ type_ticket.type }}</option>
                        {% endfor %}
                    </select>
                </td>
                <td><input class="from" type="text" name="from-{{ loop.index0 }}" value="{{ traffic.from }}" required="required" ></td>
                <td><input class="to" type="text" name="to-{{ loop.index0 }}" value="{{ traffic.to }}" required="required"></td>
                <td><input type="time" name="time_am-{{ loop.index0 }}" class="time_am" value="{{ traffic.time_am }}" required="required"></td>
                <td><input type="time" name="time_pm-{{ loop.index0 }}" class="time_pm" value="{{ traffic.time_pm }}" required="required"></td>
                <td><input type="date" name="date-{{ loop.index0 }}" class="date" value="{{ traffic.date }}" required="required"></td>
                <td>
                    <select class="bus_am" name="bus_am-{{ loop.index0 }}" data-id="{{ traffic.id}}" data-index="{{ loop.index0 }}">
                        <option value="">--------</option>
                        {% for bus in buses %}
                            <option value="{{ bus.id }}" {% if traffic.id_bus_am == bus.id %} selected {% endif %}>{{ bus.name }}</option>
                        {% endfor %}
                    </select>
                </td>
                <td>
                    <select class="driver_am" name="driver_am-{{ loop.index0 }}">
                        <option value="">--------</option>
                        {% for driver in drivers %}
                        <option value="{{ driver.id }}" {% if traffic.driver_am == driver.id %} selected {% endif %}>{{ driver.firstname }} {{ driver.lastname }}</option>
                        {% endfor %}
                    </select>
                </td>
                <td>
                    <select class="bus_pm" name="bus_pm-{{ loop.index0 }}" data-id="{{ traffic.id}}" data-index="{{ loop.index0 }}">
                        <option value="">---------</option>
                        {% for bus in buses %}
                        <option value="{{ bus.id }}" {% if traffic.id_bus_pm == bus.id %} selected {% endif %}>{{ bus.name }}</option>
                        {% endfor %}
                    </select>
                </td>
                <td>
                    <select class="driver_pm" name="driver_pm-{{ loop.index0 }}">
                        <option value="" >--------</option>
                        {% for driver in drivers %}
                        <option value="{{ driver.id }}" {% if traffic.driver_pm == driver.id %} selected {% endif %}>{{ driver.firstname }} {{ driver.lastname }}</option>
                        {% endfor %}
                    </select>
                </td>
                <td>
                    <input maxlength="49" type="text" name="parking-{{ loop.index0 }}" class="parking" value="{% if traffic.parking %}{{ traffic.parking }}{% endif %}">
                </td>
                <td>
                    <input type="checkbox" disabled {% if traffic.admission == 1 %}checked{% endif %}>
                </td>
            </tr>
        {% endfor %}
    {% else %}
        <tr class="row1">
            <td colspan="12" style="text-align: center">
                Not generated traffic
            </td>
        </tr>
    {% endif %}

</script>

<script type="text/javascript">
    $(document).ready(function(){
        var $form_update_parks = $('#form_update_parks');
        var $form_update_driver_bus = $('#form_update_driver_bus');
        var $form_daily_arrival = $('#form_daily_arrival');
        var $formu_tiketes = $('#formu_tiketes');
        var $form_daily_exten_arrival = $('#form_daily_exten_arrival');
        var $form_tickets_pdf = $('#form_tickets_pdf');
        var url_tickets = "<?php echo $data['rootUrl']; ?>admin/traffic/tickets_pdf/";
        var url_guides_services = "<?php echo $data['rootUrl']; ?>admin/traffic/guides_services_pdf/";
        var url_daily_arrival = "<?php echo $data['rootUrl']; ?>admin/traffic/daily_arrival_pdf/";
        var url_daily_exten_arrival = "<?php echo $data['rootUrl']; ?>admin/traffic/daily_arrival_exten_pdf/";
        var url_tiketes = "<?php echo $data['rootUrl']; ?>admin/traffic/tiketes_pdf/";

        $( "#update_parks" ).click(function() {
            $( "#dialog-form" ).dialog( "open" );
        });
        
        $( "#update_drivers" ).click(function() {
            $( "#dialog-driver-bus-form" ).dialog( "open" );
        });

        $('#print_daily_arrival').click(function(){

            if($form_daily_arrival.valid()){
                location.href = url_daily_arrival + $form_daily_arrival.find('#id_initial_date').val();
            }
        });
        
        $('#print_tiketes').click(function(){

            if($formu_tiketes.valid()){
                location.href = url_tiketes + $formu_tiketes.find('#fecha_inicial').val();
            }
        });
        
        $('#print_daily_exten_arrival').click(function(){

            if($form_daily_exten_arrival.valid()){
                location.href = url_daily_exten_arrival + $form_daily_exten_arrival.find('#id_initial_exten_date').val();
            }
        });
        $('#print_tickets_pdf').click(function(){
            if($form_tickets_pdf.valid()){
                location.href = url_tickets + $form_tickets_pdf.find('#id_select_date_tickets_pdf').val();
            }
        });

        $('#print_guides_services').click(function(){
            var $form_guides_services = $('#form_guides_services');
            if($form_guides_services.valid()){
                location.href = url_guides_services + $form_guides_services.find('#id_select_date_guides_services').val() + '/' + $form_guides_services.find('#id_time_select_report').val();
            }
        });

        $('#id_days_filter').change(function(){
            var day = $(this).val();
            console.log(day);
            if(day != ''){
                day = parseInt(day);
                day -= 1;
                console.log(day);
                $('#id_nights_filter').val(day);
            }else{
                $('#id_nights_filter').val('');
            }

        });


        $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Update traffics": function() {
                    if($form_update_parks.valid()){
                        var cambiar = true;
//                        if(modificado){
//                            cambiar = confirm("You have updated data, it'll lose them if not save");
//                        }

                        if(cambiar){
                            modificado = false;
                            var data = $form_update_parks.serialize();


                            $.getJSON('<?php echo $data['rootUrl']; ?>admin/traffic/update_time_parks/', data)
                                .done(function(data){
                                    alert(data['rows_updated'] + ' traffics updated');
                                    if(id_tour && type_tour){
                                        var $tr_select = $('#tours').find('tbody').find('tr[data-id="'+ id_tour +'"][data-type="'+ type_tour +'"]');
                                        var days_select = $form_update_parks.find('#id_days_filter').val();
                                        var nights_select = $form_update_parks.find('#id_nights_filter').val();
                                        console.log(nights_select);
                                        var id_selected_park = $form_update_parks.find('#id_park_to_update').val();
                                        var fecha_actual = $form_update_parks.find('#id_fecha_actual').val();
                                        var time_am = $form_update_parks.find('#id_time_am').val();
                                        var time_pm = $form_update_parks.find('#id_time_pm').val();

                                        if($tr_select.find('.days').val() == days_select && $tr_select.find('.nights').val() == nights_select){


                                            $.each($('#table_traffics').find('tbody').find('[data-id-park="'+  id_selected_park +'"'), function(index, value){
                                                var fecha_trafico = $(this).find('.date').val();
                                                if(fecha_actual == fecha_trafico){
                                                    $(this).find('.time_am').val(time_am);
                                                    $(this).find('.time_pm').val(time_pm);
                                                }
                                            });


                                            console.log();
                                        }
                                    }
                                    $form_update_parks.find('#id_park_to_update').val('');
                                    $form_update_parks.find('#id_days_filter').val('');
                                    $form_update_parks.find('#id_nights_filter').val('');
                                }
                            );

                        }
                    }
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        $('#open_reports').click(function(){
            $('#dialog-reports').dialog('open');
        });

        $( "#accordion" ).accordion({
            heightStyle: "content"
        });

        $( "#dialog-reports" ).dialog({
            autoOpen: false,
            height: 480,
            width: 640,
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
        
        $( "#dialog-driver-bus-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Update traffics": function() {
                    if($form_update_driver_bus.valid()){
                        var cambiar = true;
                        if(modificado){
                            cambiar = confirm("You have updated data, it'll lose them if not save");
                        }

                        if(cambiar){
                            modificado = false;
                            var data = $form_update_driver_bus.serialize();
                            console.log(data);
                                
                            $.getJSON('<?php echo $data['rootUrl']; ?>admin/traffic/update_drivers_bus/', data)
                                .done(function(data){
                                    alert(data['rows_updated'] + ' traffics updated');
                                    if(id_tour && type_tour){
                                        $('#tours').find('tbody').find('tr[data-id="'+ id_tour +'"][data-type="'+ type_tour +'"]').trigger('click');
                                    }
                                }
                            );
                            $form_update_driver_bus.find('#id_bus_to_update').val('');
                            $form_update_driver_bus.find('#id_driver_to_update').val('');
                            $form_update_driver_bus.find('#id_time_select').val('');
                        }
                    }
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        if (navigator.userAgent.indexOf('Chrome/2') != -1) {
            $('input[type=date]').live('click', function(event) {
                event.preventDefault();
            });
        }

        $( "#fecha_ini" ).datepicker({
            dateFormat:'mm-dd-yy',
            maxDate:   365
        });

        $( "#id_initial_date" ).datepicker({
            dateFormat:'yy-mm-dd',
            maxDate:   365
        });
        $( "#id_initial_exten_date" ).datepicker({
            dateFormat:'yy-mm-dd',
            maxDate:   365
        });

        $( "#id_select_date_guides_services" ).datepicker({
            dateFormat:'yy-mm-dd',
            maxDate:   365
        });

        $( "#id_end_date" ).datepicker({
            dateFormat:'yy-mm-dd',
            maxDate:   365
        });

        $( "#id_select_date_tickets_pdf" ).datepicker({
            dateFormat:'yy-mm-dd',
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

        var modificado = false;
        var tr_traffic = swig.compile($("#tr_traffic").html(),{filename: 'tr_traffic'});
        var drivers = <?php echo json_encode($data['drivers']); ?>;
        var buses =  <?php echo json_encode($data['buses']); ?>;
        var type_tickets =  <?php echo json_encode($data['type_tickets']); ?>;
        var starting_date = null;
        var ending_date = null;
        var dias = null;
        var array_dias = [];
        var id_tour = null;
        var type_tour = null;
        var item_sort = null;
        var last_item = null;
        var $table_traffic = $('#table_traffics');

        function calcular_index_traffic(){
            var $traff = $table_traffic.find('tbody').find('tr[data-type-traffic="PARK"]');
            $.each($traff, function(index, value){
                $(this).attr('data-index-traffic', index);
                last_item = $(this);
            });
        }

        $table_traffic.find('tbody').sortable({

            update: function(event, ui){
                var item = ui['item'];
                var index_traffic_item = item.attr('data-index-traffic');
                var i = 0;
                var doble = false;
                var $traffics_tr = $table_traffic.find('tbody').find('tr[data-type-traffic="PARK"]');
                var num_doubles = $traffics_tr.toArray().length - array_dias.length;
                $table_traffic.find('tbody').find('tr[data-index-traffic="PARK"]');
                var ant_last_item = last_item;
                calcular_index_traffic();
                if(ant_last_item.attr('data-index') != last_item.attr('data-index')){
                    if(last_item.attr('data-type-traffic') == 'PARK' && item.attr('data-type-traffic') == 'PARK'){
                        //if(item == $(this)){
                        if(index_traffic_item == last_item.attr('data-index-traffic')){
                            var aux = item.find('.to').val();
                            item.find('.to').val(last_item.find('.to').val());
                            last_item.find('.to').val(aux);
                        }else if(item.attr('data-index-traffic') == last_item.attr('data-index-traffic')){
                            var aux = item.find('.to').val();
                            item.find('.to').val(ant_last_item.find('.to').val());
                            ant_last_item.find('.to').val(aux);
                        }
                        //}
                    }
                }

                var doblado = true;
                $.each($traffics_tr, function(index, value){
                    var fecha = array_dias[i].split('-');
                    //fecha = "" + fecha[]
                    $(this).find('.date').val(array_dias[i]);
                    $(this).find('.date').trigger('change');

                    if(doble){
                       doble = false;
                       i++;
                    }else{

                        if(num_doubles > 0){
                            num_doubles--;
                            doble = true;
                            console.log('dobado');

                        }else{
                            i++;
                        }

                        if(i > (array_dias.length-1)){
                            i = 0;
                        }

                    }
                });
            }
        });

        $('#form_traffics').validate({
            errorClass: 'error_validate'
        });

        $('#form_daily_arrival').validate({
            errorClass: 'error_validate'
        });
        $('#form_daily_exten_arrival').validate({
            errorClass: 'error_validate'
        });

        $('#form_guides_services').validate({
            errorClass: 'error_validate'
        });

        $('#form_tickets_pdf').validate({
            errorClass: 'error_validate'
        });

        $form_update_parks.validate({
            errorClass: 'error_validate'
        });
        $form_update_driver_bus.validate({
            errorClass: 'error_validate'
        });

        $('#tours').find('tr').click(function() {

            var cambiar = true;
//            if(modificado){
//                cambiar = confirm("You have updated data, it'll lose them if not save");
//            }
            
            
            if(cambiar){
                id_tour = $(this).find('input[name="item"]').val();
                type_tour = $(this).find('input[name="type_tour"]').val();
                $(this).find('input[name="item"]').prop('checked', true);
                starting_date = $(this).find('input[name="starting_date"]').val();
                ending_date = $(this).find('input[name="ending_date"]').val();
                starting_date = starting_date.split('-');
                starting_date = new Date(starting_date[0], starting_date[1]-1, starting_date[2]);
                ending_date = ending_date.split('-');
                ending_date = new Date(ending_date[0], ending_date[1]-1, ending_date[2]);

                dias = ending_date - starting_date;
                dias = dias / (1000 * 60 * 60 * 24);
                var cambiar2 = false;
                var cambiar2 = confirm("Deseas generar nuevo trafico para esta reserva?");
                var camb = 0;
                if(cambiar2){
                    var camb = 1;
                }
                var data = {
                    id_tour: id_tour,
                    type_tour: type_tour,
                    cambiar:camb
                };
                $.getJSON('<?php echo $data['rootUrl']; ?>admin/traffic/search_traffic', data).done(function(data){

                    $table_traffic.find('tbody').html(tr_traffic({'traffics': data['traffics'], 'drivers': drivers, 'buses': buses, 'type_tickets': type_tickets}));
                    array_dias = data['dias'];


                    $( ".date" ).datepicker({
                        dateFormat:'yy-mm-dd',
                        maxDate:   365
                    });
                    $('#btn_save').removeAttr('disabled');
                    modificado = false;
                    calcular_index_traffic();

                });
            }
        });

        function change_driver(type, id_bus, id_traffic, index){
            var selector = 'tr';
            console.log(index);
            for(var i = 0; i < buses.length; i++){
                if(buses[i]['id'] == id_bus){
                    //console.log('cambiando driver');
                    //console.log(buses[i]['id_driver']);
                    //console.log($('tr[data-id="'+ id_traffic +'"]').find('select[name="driver_'+ type +'"]'));
                    $('tr[data-id="'+ id_traffic +'"]').find('select[name="driver_'+ type +'-'+ index +'"]').val(buses[i]['id_driver']);
                    break;
                }
            }
        }

        $('.bus_am').live('change' ,function(){
            var id_bus = $(this).val();
            var id_traffic = $(this).attr('data-id');
            var index = $(this).attr('data-index');
            //console.log('change driver');
            modificado = true;
            change_driver('am', id_bus, id_traffic, index);
        });

        $('.bus_pm').live('change' ,function(){
            var id_bus = $(this).val();
            var id_traffic = $(this).attr('data-id');
            var index = $(this).attr('data-index');
            modificado = true;
            //console.log('change driver');
            change_driver('pm', id_bus, id_traffic, index);
        });

        $('#btn_save').click(function(){
            var valido = $('#form_traffics').valid();
            if(valido){
                var trafics = [];
                var error = false;
                $.each($('#table_traffics').find('tbody').find('tr'), function(index, value){
                    var id_traffic = $(this).find('.traffic_id').val();
                    var type_ticket = $(this).find('.type_ticket').val();
                    var from = $(this).find('.from').val();
                    var to = $(this).find('.to').val();
                    var time_am = $(this).find('.time_am').val();
                    var time_pm = $(this).find('.time_pm').val();
                    var date = $(this).find('.date').val();
                    var bus_am = $(this).find('.bus_am').val();
                    var bus_pm = $(this).find('.bus_pm').val();
                    var driver_am = $(this).find('.driver_am').val();
                    var driver_pm = $(this).find('.driver_pm').val();
                    var parking = $(this).find('.parking').val();

                    trafics.push({
                        id_traffic: id_traffic,
                        type_ticket: type_ticket,
                        from: from,
                        to: to,
                        time_am: time_am,
                        time_pm: time_pm,
                        date: date,
                        bus_am: bus_am,
                        bus_pm: bus_pm,
                        driver_am: driver_am,
                        driver_pm: driver_pm,
                        parking: parking
                    });

                    date = date.split('-');
                    date = new Date(date[0], date[1]-1, date[2]);

                    if(date < starting_date || date > ending_date){
                        error = true;
                    }
                });

                if(!error){
                    $.getJSON('<?php echo $data['rootUrl']; ?>admin/traffic/save_traffic', {data: trafics}).done(function(data){
                        alert(data['num_registro'] + ' traffics have been updated');
                        modificado = false;
                    }).fail(function(data){
                            alert('ocurrio un error');
                        });
                }else{
                    alert('select a valid date for the traffic');
                }

            }
        });

        $('.driver_am').live('change', function(){
            modificado = true;
        });
        $('.driver_pm').live('change', function(){
            modificado = true;
        });
        $('input').live('change', function(){
            modificado = true;
        });
    });
</script>



<script>
    
    $(document).ready(function() {                

                
				
		$("#btn-continue").click(function(){     
                
               
                
                
                var radios = document.getElementsByName("price1");
                var formValid = false;
                var i = 0;
                while (!formValid && i < radios.length) {
                    if (radios[i].checked) formValid = true;
                    i++;        
                }

                if (!formValid) {
                alert("Select [ Standard Price ] or [ Super Flex Price ]");
                //alert(formValid);
                return formValid;
                }else{
                formValid = true;
                }
                
                document.getElementById("save2").style.display = "none";                
                
                var price1 = $("input:radio[name=price1]:checked").val();
                var price2 = $("input:radio[name=price1]:checked").val();
                var price3 = $("input:radio[name=price1]:checked").val();
                var price4 = $("input:radio[name=price1]:checked").val();
                var price5 = $("input:radio[name=price1]:checked").val();
                
                
                
                        //alert(price1);
                        
				var index = false;		
                                for(i=0;i<$("#tbl1 tr").toArray().length;i++) {
				if($("#tbl1 tr").eq(i).find("td").eq(0).find("input").attr("checked")){
					valor = $("#tbl1 tr").eq(i).find("td").eq(1).html();
					departure = $("#tbl1 tr").eq(i).find("td").eq(2).html();
					arrival = $("#tbl1 tr").eq(i).find("td").eq(3).html();
					adult = $("#tbl1 tr").eq(i).find("td").eq(4).html();
                                        space = $("#tbl1 tr").eq(i).find("td").eq(5).html();
					child = $("#tbl1 tr").eq(i).find("td").eq(6).html();    
                                        adult2 = $("#tbl1 tr").eq(i).find("td").eq(7).html();
                                        space = $("#tbl1 tr").eq(i).find("td").eq(8).html();
					child2 = $("#tbl1 tr").eq(i).find("td").eq(9).html();    
                                        adult3 = $("#tbl1 tr").eq(i).find("td").eq(10).html();
                                        space = $("#tbl1 tr").eq(i).find("td").eq(11).html();
					child3 = $("#tbl1 tr").eq(i).find("td").eq(12).html(); 
                                        adult4 = $("#tbl1 tr").eq(i).find("td").eq(13).html();
                                        space = $("#tbl1 tr").eq(i).find("td").eq(14).html();
					child4 = $("#tbl1 tr").eq(i).find("td").eq(15).html(); 
                                        adult5 = $("#tbl1 tr").eq(i).find("td").eq(16).html();
                                        space = $("#tbl1 tr").eq(i).find("td").eq(17).html();
					child5 = $("#tbl1 tr").eq(i).find("td").eq(18).html();  
                                        
					index=true;
					}
				}			
			
			
			if(index){
                                        var capacidad = $("#capacidad_trip_"+valor).val();                                        
                                        

                                        //var totalpax = parseFloat( parseFloat($("#pax").val()) +  parseFloat($("#pax2").val()) );
                                        
                                        var tipo_reserva = "' . $tipo_reserva . '";                                            
                                        var total_pasajeros = "' . $totalpaxx . '";                                            
                                        var trip_1 = "' . $trip_1 . '";                                        
                                        var trip_2 = "' . $trip_2 . '";                                            
                                        var tipo = "' . $tipo . ' ";  
                                        var trips = "' . $trips . '";    
                                        var tarifaone = $("#tarifaone_edit").val();     
                                        var tarifaround = $("#tarifaround_edit").val();     
                                        
                                        
                                                                  
                                        if(trips == 100200300 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){   
                                        
                                            var radio100 = document.getElementById("valor100").checked;                                        
                                            var radio200 = document.getElementById("valor200").checked;                                        
                                            var radio300 = document.getElementById("valor300").checked;
                                            
                                            var radioS100 = document.getElementById("valorS100").checked;                                        
                                            var radioS200 = document.getElementById("valorS200").checked;                                        
                                            var radioS300 = document.getElementById("valorS300").checked;
                                            
                                            if(radio100 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                       
                                            }

                                            if(radio200 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                            }    

                                            if(radio300 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                            }   
                                            
                                            if(radioS100 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                         
                                            }

                                            if(radioS200 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }    

                                            if(radioS300 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }   

                                        }
                                        
                                        if(trips == 100200 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){ 
                                        
                                            var radio100 = document.getElementById("valor100").checked;                                        
                                            var radio200 = document.getElementById("valor200").checked;  
                                            var radioS100 = document.getElementById("valorS100").checked;                                        
                                            var radioS200 = document.getElementById("valorS200").checked;   
                                            
                                            if(radio100 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                       
                                            }

                                            if(radio200 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }    
                                            
                                            if(radioS100 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                           
                                            }

                                            if(radioS200 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }    
                                            

                                        }
                                        
                                        if(trips == 300 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                        
                                            var radio300 = document.getElementById("valor300").checked;   
                                            var radioS300 = document.getElementById("valorS300").checked;
                                            
                                            if(radio300 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }
                                            
                                            if(radioS300 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }   
                                            
                                        }
                                        
                                        
                                        if(trips == 101201301 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){ 
                                        
                                            var radio101 = document.getElementById("valor101").checked;                                        
                                            var radio201 = document.getElementById("valor201").checked;                                        
                                            var radio301 = document.getElementById("valor301").checked;  
                                            
                                            var radioS101 = document.getElementById("valorS101").checked;                                        
                                            var radioS201 = document.getElementById("valorS201").checked;                                        
                                            var radioS301 = document.getElementById("valorS301").checked;
                                            
                                            if(radio101 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                     
                                            }

                                            if(radio201 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                       
                                            }

                                            if(radio301 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                       
                                            }
                                            
                                            if(radioS101 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                           
                                            }

                                            if(radioS201 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }    

                                            if(radioS301 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }   

                                            
                                            
                                        }
                                        
                                        if(trips == 101201 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                        
                                            var radio101 = document.getElementById("valor101").checked;                                        
                                            var radio201 = document.getElementById("valor201").checked;  
                                            var radioS101 = document.getElementById("valorS101").checked;                                        
                                            var radioS201 = document.getElementById("valorS201").checked; 
                                            
                                            if(radio101 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                         
                                            }

                                            if(radio201 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                         
                                            }  
                                            
                                            if(radioS101 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                           
                                            }

                                            if(radioS201 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }    

                                        }
                                        
                                        if(trips == 301 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                            var radio301 = document.getElementById("valor301").checked; 
                                            var radioS301 = document.getElementById("valorS301").checked; 
                                            
                                            if(radio301 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                      
                                            } 
                                            if(radioS301 == true && trip_1 == 0 && tipo_reserva == "Nuevo" && (tipo == 1 || tipo == 2)){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                            }   
                                        }                   
                                                                              

                                        //<<EDITADO>>>/////////////////////////////////////////////////////////////////////////////////////
                                        
                                        /*var tipo_reserva = "' . $tipo_reserva . '";                                            
                                        var total_pasajeros = "' . $totalpaxx . '";                                            
                                        var trip_1 = "' . $trip_1 . '";                                        
                                        var trip_2 = "' . $trip_2 . '";                                            
                                        var tipo = "' . $tipo . ' ";  
                                        var trips = "' . $trips . '";    
                                        var tarifaone = $("#tarifaone_edit").val();     
                                        var tarifaround = $("#tarifaround_edit").val();*/     
                                        
                                        
                                        
                                        var tipo_reserva = "' . $tipo_reserva . '";                                            
                                        var total_pasajeros = "' . $totalpaxx . '";                                            
                                        var trip_1 = "' . $trip_1 . '";                                        
                                        var trip_2 = "' . $trip_2 . '";                                            
                                        var tipo = "' . $tipo . ' ";  
                                        var trips = "' . $trips . '";    
                                        var tarifaone = $("#tarifaone_edit").val();     
                                        var tarifaround = $("#tarifaround_edit").val();       
                                        
                                        if(trips == 100200300 && tipo_reserva == "Editado" && tipo == 1){   
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";  
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaone = $("#tarifaone_edit").val();    
                                            
                                            var radio100 = document.getElementById("valor100").checked;                                        
                                            var radio200 = document.getElementById("valor200").checked;                                        
                                            var radio300 = document.getElementById("valor300").checked;
                                            
                                            var radialeS100 = document.getElementById("valorS100").checked;
                                            var radialeS200 = document.getElementById("valorS200").checked;
                                            var radialeS300 = document.getElementById("valorS300").checked;
                                            
                                            //SUPERFLEX
                                            
                                            //100
                                            
                                             if(radialeS100 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                             
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());                                                

                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                                     

                                             }
                                             
                                             if(radialeS100 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                             
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                
                                                //alert(totalpax);                                                     

                                             }
                                             
                                             if(radialeS200 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                                  
                                             }
                                             if(radialeS200 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                                  
                                             }
                                             
                                             if(radialeS300 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                             
                                             } 
                                             if(radialeS300 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                             
                                             } 
                                             
                                            //200 
                                            
                                            if(radialeS200 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                             
                                                                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                     
                                             }
                                             
                                             if(radialeS200 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                             
                                                                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);                                     
                                             }
                                             
                                             if(radialeS100 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                                  
                                             }
                                             if(radialeS100 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                                  
                                             }
                                             
                                             if(radialeS300 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                             
                                             } 
                                             if(radialeS300 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                             
                                             } 
                                             
                                             //300
                                             
                                             if(radialeS300 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                             
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                
                                             }
                                             
                                             if(radialeS300 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                             
                                                
                                                 var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                
                                                //alert(totalpax);              
                                                
                                             }
                                             
                                             if(radialeS100 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                                  
                                             }
                                             if(radialeS100 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                                  
                                             }
                                             
                                             if(radialeS200 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                             
                                             } 
                                             if(radialeS200 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                //alert(totalpax);                             
                                             }              

                                            //STANDARD
                                            
                                            //100
                                            
                                            if(radio100 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){  
                                            
                                                //alert("100");  
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                
                                                                                 
                                            }
                                            
                                            if(radio100 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("100");  
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                                
                                                //alert(totalpax);              
                                                
                                                                                 
                                            }
                                            
                                            if(radio200 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio300 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio300 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            

                                            //200

                                            if(radio200 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                            
                                                //alert("200");      
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                     
                                            }
                                            
                                            if(radio200 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                            
                                                //alert("200");      
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                                                     
                                            }


                                            if(radio100 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio100 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio300 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio300 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }

                                            //300

                                            if(radio300 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        
                                                //alert("300");    
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                          
                                                                               
                                            }
                                            
                                            if(radio300 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("300");    
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                                
                                                //alert(totalpax);                                          
                                                                               
                                            }
                                            
                                            if(radio100 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){          
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio100 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){          
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        
                                                //alert("200");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("200");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                        
                                        }
                                        
                                                                                
                                        
                                        if(trips == 100200 && tipo_reserva == "Editado" && tipo == 1){   
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";  
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);   
                                            var tarifaone = $("#tarifaone_edit").val();  
                                            var radio100 = document.getElementById("valor100").checked;                                        
                                            var radio200 = document.getElementById("valor200").checked;                                        
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            
                                            //100
                                            
                                            if(radio100 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        
                                                //alert("100");        
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                     
                                            }
                                            
                                            if(radio100 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("100");        
                                                
                                               var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                                
                                                //alert(totalpax);              
                                                                                     
                                            }
                                            
                                            if(radio200 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_1 == 100 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }


                                            //200

                                            if(radio200 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                            
                                                //alert("200");     
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                         
                                            }
                                            
                                            if(radio200 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                            
                                                //alert("200");     
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());       
                                                
                                                //alert(totalpax);              
                                                                                         
                                            }

                                            if(radio100 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio100 == true && trip_1 == 200 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                                                                       
                                        
                                        }
                                        
                                        if(trips == 300 && tipo_reserva == "Editado" && tipo == 1){                                           
                                             
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaone = $("#tarifaone_edit").val();                                             
                                            var radio300 = document.getElementById("valor300").checked; 
                                             

                                            //300

                                            if(radio300 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        
                                                //alert("300");   
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                     
                                            }
                                            
                                            if(radio300 == true && trip_1 == 300 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        
                                                //alert("300");   
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                                
                                                //alert(totalpax);              
                                                                                     
                                            }
                                            
                                        
                                        }
                                        
                                        
                                        //101201301  101
                                        
                                        if(trips == 101201301 && tipo_reserva == "Editado" && tipo == 1){  
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";  
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);                                            
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaone = $("#tarifaone_edit").val();
                                            
                                            var radio101 = document.getElementById("valor101").checked;                                        
                                            var radio201 = document.getElementById("valor201").checked;                                        
                                            var radio301 = document.getElementById("valor301").checked;
                                            
                                            var radialeS101 = document.getElementById("valorS101").checked;
                                            var radialeS201 = document.getElementById("valorS201").checked;
                                            var radialeS301 = document.getElementById("valorS301").checked;
                                           

                                            //STANDARD PRICE
                                            
                                            //101
                                            
                                            if(radio101 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("101");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            
                                            if(radio101 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            
                                            if(radio201 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio201 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio301 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio301 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }

                                            //201

                                            if(radio201 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("201");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            
                                            if(radio201 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                

                                            }

                                            if(radio101 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio101 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }

                                            if(radio301 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio301 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }

                                            //301
                                                                                       
                                            
                                            if(radio301 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                var total_pasajeros = "' . $totalpaxx . '"; 
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                                                               
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                                                    

                                            }
                                            
                                            if(radio301 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                                                               
                                                var totalpax =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());                     
                                                
                                                                                    

                                            }
                                            
                                            if(radio101 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                        

                                                //alert("101");

                                                var totalpax =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val()); 

                                            }
                                            if(radio101 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                        

                                                //alert("101");

                                                var totalpax =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val()); 

                                            }
                                            if(radio201 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("201");

                                                var totalpax =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val()); 

                                            }
                                            if(radio201 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("201");

                                                var totalpax =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val()); 

                                            }
                                            
                                            //SUPERFLEX PRICE
                                            
                                            //101
                                            
                                             if(radialeS101 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){  
                                                
                                                var total_pasajeros = "' . $totalpaxx . '"; 
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());                                                

                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                                     

                                             }
                                             
                                             if(radialeS101 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){  
                                                
                                                var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                //alert(totalpax);                                                     

                                             }
                                             
                                             if(radialeS201 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                                  
                                             }
                                             if(radialeS201 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                                  
                                             }
                                             
                                             if(radialeS301 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                             
                                             } 
                                             if(radialeS301 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                             
                                             } 
                                             
                                            //201 
                                            
                                            if(radialeS201 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){  
                                                
                                                var total_pasajeros = "' . $totalpaxx . '"; 
                                                                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                     
                                             }
                                             
                                            if(radialeS201 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){  
                                                
                                                var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                //alert(totalpax);                                     
                                             }
                                             
                                             if(radialeS101 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                                  
                                             }
                                             if(radialeS101 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                                  
                                             }
                                             
                                             if(radialeS301 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                             
                                             } 
                                             if(radialeS301 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                             
                                             } 
                                             
                                             //301
                                             
                                             if(radialeS301 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){                                             
                                                
                                                var total_pasajeros = "' . $totalpaxx . '"; 
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                
                                             }
                                             
                                             if(radialeS301 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){                                             
                                                
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                
                                                //alert(totalpax);              
                                                
                                             }
                                             
                                             if(radialeS101 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                                  
                                             }
                                             if(radialeS101 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                                  
                                             }
                                             
                                             if(radialeS201 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                             
                                             }
                                             if(radialeS201 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){
                                                var totalpax = parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                //alert(totalpax);                             
                                             }
                                        
                                        }
                                        
                                        //101201  
                                        
                                        if(trips == 101201 && tipo_reserva == "Editado" && tipo == 1){  
                                        
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques); 
                                            var tarifaone = $("#tarifaone_edit").val();
                                            var radio101 = document.getElementById("valor101").checked;                                        
                                            var radio201 = document.getElementById("valor201").checked;                                        
                                            

                                            //101
                                            
                                            if(radio101 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("101");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                    

                                            }
                                            
                                            if(radio101 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);                                    

                                            }
                                            
                                            
                                            if(radio201 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                            if(radio201 == true && trip_1 == 101 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            

                                            //201

                                            if(radio201 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("201");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            
                                            if(radio201 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                

                                            }

                                            if(radio101 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio101 == true && trip_1 == 201 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                        
                                        }
                                        
                                        //301  
                                        if(trips == 301 && tipo_reserva == "Editado" && tipo == 1){  
                                        
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);                                            
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";                                  
                                            var radio301 = document.getElementById("valor301").checked; 
                                            var tarifaone = $("#tarifaone_edit").val();
                                           

                                            //301

                                            if(radio301 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 1){

                                                //alert("301");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                
                                                

                                            }
                                            
                                            if(radio301 == true && trip_1 == 301 && tipo_reserva == "Editado" && tipo == 1 && tarifaone == 2){

                                                //alert("301");

                                                var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                //alert(totalpax);              
                                                
                                                

                                            }
                                            
                                        
                                        }
                                        
                                        //trip_2 && tipo 2
                                        
                                        if(trips == 100200300 && tipo_reserva == "Editado" && tipo == 2){  
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);
                                            var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '"; 
                                            var tarifaround = $("#tarifaround_edit").val();  
                                            
                                            var radio100 = document.getElementById("valor100").checked;                                        
                                            var radio200 = document.getElementById("valor200").checked;                                        
                                            var radio300 = document.getElementById("valor300").checked;
                                            
                                            var radiale100 = document.getElementById("valorS100").checked;                                        
                                            var radiale200 = document.getElementById("valorS200").checked;                                        
                                            var radiale300 = document.getElementById("valorS300").checked;
                                            
                                            //100
                                            
                                            if(radio100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){         
                                            
                                                //alert("100");                                                
                                                                                               
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                        
                                            }
                                            if(radio100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){  
                                            
                                                //alert("100"); 
                                                                                            
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());   
                                                
                                                //alert(totalpax);              
                                                                                        
                                            }
                                            
                                            if(radio200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio300 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio300 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            
                                            
                                            if(radiale100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("200");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("200");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale300 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("300");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale300 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("300");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("100");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                            //200

                                            if(radio200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                            
                                                //alert("200");                                        
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());
                                                var total_pasajeros = "' . $totalpaxx . '"; 
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                           
                                            }
                                            if(radio200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                            
                                                //alert("200");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                                //alert(totalpax);              
                                                                                           
                                            }

                                            if(radio100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            
                                            if(radio300 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }
                                            if(radio300 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                            
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }
                                            
                                            
                                            if(radiale200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                //alert("200");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }
                                            
                                            if(radiale100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                               
                                            }
                                            
                                            if(radiale100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){
                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                               
                                            }
                                            
                                            if(radiale300 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                //alert("300");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }
                                            
                                            if(radiale300 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){
                                                //alert("300");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("200");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }

                                            

                                            //300

                                            if(radio300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                        
                                                //alert("300");                                        
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                        
                                            }
                                            if(radio300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        
                                                //alert("300");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                   
                                                //alert(totalpax);              
                                                                                        
                                            }
                                            if(radio100 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){          
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio100 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){          
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                        
                                                //alert("200");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio200 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        
                                                //alert("200");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            
                                            
                                            if(radiale300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                //alert("300");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                            }
                                            
                                            if(radiale200 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                //alert("200");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale200 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){
                                                //alert("200");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale100 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                               

                                            } 
                                            if(radiale100 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){
                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                               

                                            } 
                                            
                                            //SUPERFLEX

                                            if(radiale300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("300");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }                                
                                            
                                        
                                        }
                                        
                                                                                
                                        
                                        if(trips == 100200 && tipo_reserva == "Editado" && tipo == 2){  
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";   
                                            var total_pasajeros = "' . $totalpaxx . '";
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);                                            
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaround = $("#tarifaround_edit").val();           
                                                
                                            var radio100 = document.getElementById("valor100").checked;                                        
                                            var radio200 = document.getElementById("valor200").checked; 
                                            var radiale100 = document.getElementById("valorS100").checked;                                        
                                            var radiale200 = document.getElementById("valorS200").checked;       
                                            
                                            
                                            //100
                                            
                                            if(radio100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                        
                                                //alert("100");                                        
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                         
                                            }
                                            if(radio100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        
                                                //alert("100");                                        
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                 
                                                //alert(totalpax);              
                                                                                         
                                            }
                                            if(radio200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            
                                            if(radio200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                            
                                                //alert("200");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            
                                            
                                            if(radiale100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale200 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            //SUPERFLEX

                                            if(radiale100 == true && trip_2 == 100 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("100");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                            


                                            //200

                                            if(radio200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                            
                                                //alert("200");        
                                                
                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                           
                                            }
                                            if(radio200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                            
                                                //alert("200");                                        
                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());    
                                                //alert(totalpax);              
                                                                                           
                                            }

                                            if(radio100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            if(radio100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        
                                                //alert("100");                                           
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                            
                                            }
                                            
                                            if(radiale200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("200");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                               

                                            }
                                            
                                            if(radiale100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale100 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("100");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            //SUPERFLEX
                                            
                                            if(radiale200 == true && trip_2 == 200 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("200");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                                                                       
                                        
                                        }
                                        
                                        if(trips == 300 && tipo_reserva == "Editado" && tipo == 2){                                           
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);                                            
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaround = $("#tarifaround_edit").val();   
                                            var radio300 = document.getElementById("valor300").checked;
                                            var radiale300 = document.getElementById("valorS300").checked;
                                            

                                            //300

                                            if(radio300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                                                   
                                                                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                    
                                            }
                                            if(radio300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        
                                                //alert("300");                                        
                                               
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val()); 
                                                
                                                //alert(totalpax);              
                                                                                    
                                            }
                                            if(radiale300 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale300 == true && trip_2 == 300 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("300");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                            
                                            
                                            
                                        
                                        }
                                        
                                        
                                        //101201301  101
                                        
                                        if(trips == 101201301 && tipo_reserva == "Editado" && tipo == 2){ 
                                        
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);                                            
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaround = $("#tarifaround_edit").val();                                  
                                            var radio101 = document.getElementById("valor101").checked;                                        
                                            var radio201 = document.getElementById("valor201").checked;                                        
                                            var radio301 = document.getElementById("valor301").checked;
                                            
                                            var radiale101 = document.getElementById("valorS101").checked;                                        
                                            var radiale201 = document.getElementById("valorS201").checked;                                        
                                            var radiale301 = document.getElementById("valorS301").checked;

                                            //101
                                            
                                            //STANDARD
                                            
                                            if(radio101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){
                                                
                                                //alert("101");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                                
                                                                             

                                            }
                                            
                                            if(radio101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                               
                                                //alert(totalpax);              
                                                

                                            }                                            
                                                                                    
                                                                                        
                                            if(radio201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio301 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio301 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                                                                        
                                            if(radiale101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale301 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale301 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            

                                            //201

                                            if(radio201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            if(radio201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                

                                            }                                            
                                                                                       
                                            
                                            if(radio101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }

                                            if(radio301 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio301 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                                                                        
                                            if(radiale201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            if(radiale101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            if(radiale101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            if(radiale301 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            if(radiale301 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }

                                            //301

                                            if(radio301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);                                         

                                            }
                                            if(radio301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);                                       

                                            }
                                            
                                                                                        
                                            if(radio101 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){                                        

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio101 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){                                        

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio201 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio201 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                                                                       
                                            if(radiale301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            if(radiale201 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            if(radiale201 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            if(radiale101 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            } 
                                            
                                            if(radiale101 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }    
                                            
                                            //SUPERFLEX

                                            if(radiale301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                        
                                        }
                                        
                                        //101201  
                                        
                                        if(trips == 101201 && tipo_reserva == "Editado" && tipo == 2){  
                                            
                                            var tipo_reserva = "' . $tipo_reserva . '";  
                                            var total_pasajeros = "' . $totalpaxx . '"; 
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques);   
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaround = $("#tarifaround_edit").val();  
                                            
                                            var radio101 = document.getElementById("valor101").checked;                                        
                                            var radio201 = document.getElementById("valor201").checked;  
                                            var radiale101 = document.getElementById("valorS101").checked;                                        
                                            var radiale201 = document.getElementById("valorS201").checked;       
                                            
                                            

                                            //101
                                            
                                            //STANDARD
                                            
                                            if(radio101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");

                                                                                               
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            if(radio101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            if(radio201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                            if(radiale101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale201 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            //SUPERFLEX

                                            if(radiale101 == true && trip_2 == 101 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                            

                                            //201

                                            if(radio201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                

                                            }
                                            if(radio201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                

                                            }

                                            if(radio101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            if(radio101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());

                                            }
                                            
                                            if(radiale201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("201");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            if(radiale101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            if(radiale101 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("101");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());                                                

                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale201 == true && trip_2 == 201 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("201");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                            
                                        
                                        }
                                        
                                        //301  
                                        if(trips == 301 && tipo_reserva == "Editado" && tipo == 2){  
                                        
                                            var tipo_reserva = "' . $tipo_reserva . '";                                            
                                            var total_pasajeros = "' . $totalpaxx . '";    
                                            var adultos = $("#pasadult").val();
                                            var peques = $("#pasanino").val();
                                            var tot_paxx =  parseInt(adultos) +  parseInt(peques); 
                                            var trip_1 = "' . $trip_1 . '";                                        
                                            var trip_2 = "' . $trip_2 . '";                                            
                                            var tipo = "' . $tipo . ' ";  
                                            var trips = "' . $trips . '";
                                            var tarifaround = $("#tarifaround_edit").val();  
                                            var radio301 = document.getElementById("valor301").checked;
                                            var radiale301 = document.getElementById("valorS301").checked;
                                            
                                           

                                            //301

                                            if(radio301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");

                                                var tot_paxx =  parseInt($("#pasadult").val()) +  parseInt($("#pasanino").val());  
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }
                                                
                                                //alert(totalpax);              
                                                                                      

                                            }
                                            if(radio301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");

                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                
                                                //alert(totalpax);              
                                                                                      

                                            }
                                            
                                            if(radiale301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 1){

                                                //alert("301");                                                
                                                var totalpax = parseInt($("#pax").val()) +  parseInt($("#pax2").val());
                                                

                                            }
                                            
                                            //SUPERFLEX

                                            if(radiale301 == true && trip_2 == 301 && tipo_reserva == "Editado" && tipo == 2 && tarifaround == 2){

                                                //alert("301");                                                
                                                
                                                if(tot_paxx > total_pasajeros){
                                                
                                                    var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                    
                                                    
                                                }else if(tot_paxx < total_pasajeros){
                                                
                                                   var totalpax =  parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                
                                                }else{
                                                
                                                   var totalpax = parseInt(tot_paxx) - parseInt(total_pasajeros);
                                                }                                      

                                            }
                                            
                                            
                                            
                                            
                                        
                                        }             
                                        
                                        
                                        
					if(capacidad-totalpax<0){
						alert("There is no capacity available for passengers in total admitted");
						return false;
					}
					
                                        var id = $("#trip").val();                                        
                                        var tipo = "' . $tipo . '";                                            
                                        
                                        
					$("#CargaTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/add/trip/" + valor + "/"+tipo/' . $id_agency . ');
					$("#puestosEnUso").load("' . Doo::conf()->APP_URL . 'admin/reservas/ocuparPuesto/"+valor+"/"+tipo+"/"+"' . $fecha . '"+"/"+totalpax+"/1");
                                        $("#mensajeTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/consultatrip");
					
					paxA = $("#pax").val();
					paxC = $("#pax2").val();
					var id_agencia = ' . $id_agency . ';
					
					if("' . $tipo . '" == 1){
						adulto1 = adult;
						ninio1 = child;	
                                                adulto2 = adult2;
                                                ninio2 = child2;
                                                adulto3 = adult3;
                                                ninio3 = child3;
                                                adulto4 = adult4;
						ninio4 = child4;	
                                                adulto5 = adult5;
                                                ninio5 = child5;
                                                
                                                

						if($("#trip_no_c").val() != valor || id_agencia != -1){
                                                  $("#trip_no").val(valor);
						  $("#departure1").val(departure);
						  $("#arrival1").val(arrival);	
                                                  
                                                  //Tarifa standar Trip No 1   
                                                  $("#subtoadult1").val(adult);
						  $("#subtochild1").val(child);
						  
                                                  
                                                  //Tarifa SuperFlex Trip No 1
                                                  $("#subtoadult22").val(adult2);
                                                  $("#subtochild22").val(child2);
                                                  
                                                  //Tarifa Web Fare Trip No 1
                                                  $("#subtoadultwf1").val(adult3);
                                                  $("#subtochildwf1").val(child3);
						  
                                                  //Tarifa Super promo Trip No 1
                                                  $("#subtoadultsp1").val(adult4);
                                                  $("#subtochildsp1").val(child4);
                                                  
                                                  //Tarifa Super Discount Trip No 1
                                                  $("#subtoadultsd1").val(adult5);
                                                  $("#subtochildsd1").val(child5);
                                                  
                                                  //Equipment & Seats
                                                  //("#subtochild33").val(child3);
						  //$("#subtoadult33").val(adult3);
                                                  
                                                  $("#price1").val(price1);
                                                  
						  CalcularTotalTotal();
                                                  

                                                }else{
                                                  $("#trip_no").val(valor);
						  $("#departure1").val(departure);
						  $("#arrival1").val(arrival);
                                                  
                                                  child = $("#subtochild1_o").val();
                                                  adult = $("#subtoadult1_o").val();
                                                  child2 = $("#subtochild22_o").val();
                                                  adult2 = $("#subtoadult22_o").val();
                                                  //child3 = $("#subtochild33_o").val();
                                                  //adult3 = $("#subtoadult33_o").val();
                                             


                                                  $("#subtoadult1").val(adult);
						  $("#subtochild1").val(child);
                                                  
						  $("#subtoadult22").val(adult2);
                                                  $("#subtochild22").val(child2);
						  
                                                  $("#subtochildwf1").val(child3);
						  $("#subtoadultwf1").val(adult3);
                                                  
                                                  $("#subtoadultsp1").val(adult4);
                                                  $("#subtochildsp1").val(child4);
                                                  
                                                  $("#subtoadultsd1").val(adult5);
                                                  $("#subtochildsd1").val(child5);
                                                  

						  CalcularTotalTotal();  
                                                }						
						
						
					}else{
						if($("#trip_no2").val() != ""){								
							total = 0;
							sta = 0;
							stc = 0;
							ad = 0;
							ch = 0;
                                                       
						}else{	
                                                        
                                                                                                                  
                                                         $("#trip_no2").val(valor);                                                        
                                                         $("#departure2").val(departure);
                                                         $("#arrival2").val(arrival);
                                                         
                                                         
                                                         $("#subtoadult2").val(adult);
                                                         $("#subtochild2").val(child);
                                                         
                                                         $("#subtoadult4").val(adult2);
                                                         $("#subtochild4").val(child2);
                                                         
                                                         CalcularTotalTotal();  
                                                         
                                                         
                                                                                                         
																						
						}
                                                 if($("#trip_no2_c").val() != valor || id_agencia != -1){
                                                    $("#trip_no2").val(valor);                                                        
                                                    $("#departure2").val(departure);
                                                    $("#arrival2").val(arrival);
                                                    
                                                   //Tarifa standar Trip No 2
                                                    $("#subtoadult2").val(adult);
                                                    $("#subtochild2").val(child);
                                                    
                                                    
                                                    //Tarifa SuperFlex Trip No 2
                                                    $("#subtoadult4").val(adult2);
                                                    $("#subtochild4").val(child2);
                                                    
                                                    //Tarifa Web Fare Trip No 2
                                                    $("#subtoadultwf2").val(adult3);
                                                    $("#subtochildwf2").val(child3);

                                                    //Tarifa Super promo Trip No 2
                                                    $("#subtoadultsp2").val(adult4);
                                                    $("#subtochildsp2").val(child4);

                                                    //Tarifa Super Discount Trip No 2
                                                    $("#subtoadultsd2").val(adult5);
                                                    $("#subtochildsd2").val(child5);                                                   
                                                    
                                                    
                                                  
                                                    //Equipment & Seats
                                                    //$("#subtochild33").val(child3);
                                                    //$("#subtoadult33").val(adult3); 
                                                  
                                                    $("#price2").val(price1);
                                                  
                                                    CalcularTotalTotal();
                                                    

                                                    
                                                 }else{
                                                 
                                                     $("#trip_no2").val(valor);                                                        
                                                     $("#departure2").val(departure);
                                                     $("#arrival2").val(arrival);
                                                     

                                                     
                                                     child = $("#subtochild2").val();
                                                     adult = $("#subtoadult2").val();
                                                     
                                                     child2 = $("#subtochild2_o").val();
                                                     adult2= $("#subtoadult2_o").val();
                                                     
                                                     $("#subtoadult2").val(adult);
                                                     $("#subtochild2").val(child);
                                                     
                                                     $("#subtoadult2_o").val(adult2);
                                                     $("#subtochild2_o").val(child2);
                                                     
                                                     $("#subtochildwf2").val(child3);
                                                     $("#subtoadultwf2").val(adult3);
                                                  
                                                     $("#subtoadultsp2").val(adult4);
                                                     $("#subtochildsp2").val(child4);
                                                  
                                                     $("#subtoadultsd2").val(adult5);
                                                     $("#subtochildsd2").val(child5);

                                                     
                                                     
                                                    
                                                     CalcularTotalTotal();  
                                                  
                                                   
                                                 }
						
					}				
					 
					 $("#mascaraP").hide("fade");					 
					 $("#popup").hide("fade");
					 return false;
                                         
			}else{
					alert("select Trip"); 
                                        
                                        
                    return false;
                    
			}  
                                   
				
                    });    
                        
		
		$("#btn-cancelar").click(function(){
                
                                                                
                                var tipo_reserva = "' . $tipo_reserva . '"; 
                                    
                                var tarifaone = $("#tarifaone_edit").val();
                                var tarifaround = $("#tarifaround_edit").val();
                                var tarione = $("#tari_one").val();
                                var tariround = $("#tari_round").val();
                                
                                if(tipo_reserva == "Editado"){  
                                    
                                    $("#tarifaone").val(tarifaone);
                                    $("#tarifaround").val(tarifaround);
                                    
                                        if(tarifaone == 1){                                    
                                            tarione = "Standard Price";
                                            $("#tari_one").val(tarione);
                                        }
                                        if(tarifaone == 2){                                    
                                            tarione = "Super Flex Price";
                                            $("#tari_one").val(tarione);
                                        }
                                        if(tarifaone == 3){                                    
                                            tarione = "Web Fare Price";
                                            $("#tari_one").val(tarione);
                                        }
                                        if(tarifaone == 4){                                    
                                            tarione = "Super Promo Price";
                                            $("#tari_one").val(tarione);
                                        }
                                        if(tarifaone == 5){                                    
                                            tarione = "Super Discount Price";
                                            $("#tari_one").val(tarione);
                                        }                                   
                                        if(tarifaone == 6){                                    
                                            tarione = "Special Price";
                                            $("#tari_one").val(tarione);
                                        }
                                        
                                        if(tarifaround == 1){                                    
                                            tariround = "Standard Price";
                                            $("#tari_round").val(tariround);
                                        }
                                        if(tarifaround == 2){                                    
                                            tariround = "Super Flex Price";
                                            $("#tari_round").val(tariround);
                                        }
                                        if(tarifaround == 3){                                    
                                            tariround = "Web Fare Price";
                                            $("#tari_round").val(tariround);
                                        }
                                        if(tarifaround == 4){                                    
                                            tariround = "Super Promo Price";
                                            $("#tari_round").val(tariround);
                                        }
                                        if(tarifaround == 5){                                    
                                            tariround = "Super Discount Price";
                                            $("#tari_round").val(tariround);
                                        }
                                        if(tarifaround == 6){                                    
                                            tariround = "Special Price";
                                            $("#tari_round").val(tariround);
                                        }
                                        
                                }
                                
				
				$("#popup").fadeOut("slow");
				$("#popup").hide("fade");
					 
				$("#mascaraP").fadeOut("slow");
				$("#mascaraP").hide("fade");
                                
                                document.getElementById("save2").style.display = "none";
					 
				return false;
		});
		
		});
		
		
		function calcularPrecios(ad,ch){

								
						//hace la suma de los precios( Line Transportation ) escogidos desde la ventana de trips					
						var transAdult = $("#transporadult").text(); //obtiene el valor del texto del spam (transporadult) y lo convierte en float						
						var transChild = $("#transporechil").text(); //obtiene el valor del texto del spam (transporechil) y lo convierte en float						
												
						//alert(" TransAdult convertido a float: " + parseFloat(transAdult.substring(1,transAdult.length)));
						
						ad = (parseFloat(ad) + (parseFloat(transAdult.substring(1,transAdult.length)))); //convierte la variable adult en float y la suma con transAdult
						ch = (parseFloat(ch) + (parseFloat(transChild.substring(1,transChild.length)))); //convierte la variable child en float y la suma con transAdult
										
					
						$("#transporadult").text("$"+ad.toFixed(2)); //la funcion toFixed muestra los dos decimales despues del entero
						$("#transporechil").text("$"+ch.toFixed(2));
							
											
						 sta = $("#extenadult").text();
						 stc = $("#extenchil").text();						
												
						if($("#extenadult").text() == ""){ sta = ad;} 
						if($("#extenchil").text() == ""){stc = ch;}
												
						
						
						if($("#extenadult").text() != "" || $("#extenchil").text() != ""){
							
							sta = parseFloat(sta.substring(1,sta.length)) + parseFloat(ad);
							stc = parseFloat(stc.substring(1,sta.length)) + parseFloat(ch);
							
						 }						 
						 
						total = sta + stc;		 
						
						 
						$("#subtoadult").html("$"+sta.toFixed(2));
						$("#subtochild").html("$"+stc.toFixed(2));
						 
					
						var subtotalAdult = sta * parseFloat(paxA);	
						var subtotalChild = stc * parseFloat(paxC);
						var totalpagar = subtotalAdult + subtotalChild;
                                                
						$("#totaltotal").html("$"+ totalpagar.toFixed(2));	
						$("#totalPagar").text(totalpagar.toFixed(2));                                               
						$("#totalPagar2").text(totalpagar.toFixed(2));
		
		}
    
    
</script>