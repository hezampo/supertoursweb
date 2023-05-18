<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

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

<style>
    
.grafico {
position: relative; /* IE is dumb */
width: 200px;
border: 1px solid #B1D632;
padding: 2px;
}
.grafico .barra {
display: block;
position: relative;
background: #B1D632;
text-align: center;
color: #333;
height: 2em;
line-height: 2em;
}
.grafico .barra span {
position: absolute; left: 1em;
}

</style>

<style type="text/css" id=codigo>
/*#torta { 
position: relative; 
height: 100px; width: 100px; 
overflow: hidden; 
border-radius: 100%; 
background-color: aqua; 
background-image: linear-gradient(108deg, red, red 49.9%, transparent 50.1%, transparent 100%); 
} 
#torta::before { 
content: ''; 
position: absolute; 
height: 100%; width: 100%; 
top: 0; left: 0; 
border-radius: inherit; 
background-color: red; 
clip: rect(0, 300px, 150px, 0px); 
background-image: linear-gradient(324deg, blue, blue 49.9%, transparent 50.1%, transparent 100%), linear-gradient(252deg, yellow, yellow 49.9%, transparent 50.1%, transparent 100%); */


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

}
</style>


<div id="header_page">
    <div class="header">Reports</div>
    <div id="toolbar">
        <div class="toolbar-list">
            <ul>
                <li class="divider">&nbsp;</li>
                <li class="btn-toolbar">
                    <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">
                            <span class="icon-back" title="Regresar">
                                &nbsp;
                            </span> Back
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>


<div id="accordion" style="margin-bottom: 40px;">
    
<!--╔╩╩ ╩╩╗-->
<h3 style="">DAILY ARRIVAL</h3>
<div>

    
    
    <form class="form_reports" id="form_daily_arrival_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_daily_arrival_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_daily_arrival_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_daily_arrival_report">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_daily_arrival_report" value="" required=""></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="cargando();" style="float: right" id="print_daily_arrival_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
        
        
        
        
    </form>
    
    
    
</div>



<h3>QUOTES</h3>
<div>
    <form class="form_reports" id="form_reserve_collect_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_reserve_collect_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_reserve_collect_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_reserve_collect_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_reserve_collect_report" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_reserve_collect_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<h3>DAILY REPORT TO HOTEL</h3>
<div>
    <form class="form_reports" id="form_hotel_services_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_hotel_services_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_hotel_services_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_hotel_services_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_hotel_services_report" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_hotel_services_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<h3>DAILY SALES</h3>
<div>
    <form class="form_reports" id="form_cost_range_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_cost_range_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_cost_range_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_cost_range_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_cost_range_report" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_cost_range_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<!--<h3>Commisions and Refunds</h3>
<div>
    <form class="form_reports" id="form_coms_and_refunds">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_coms_and_refunds">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_coms_and_refunds" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_coms_and_refunds">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_coms_and_refunds" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_coms_and_refunds">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<h3>Status Report Tours and Transportation</h3>
<div>
    <form id="form_ventas_tours_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_ventas_tours_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_ventas_tours_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_ventas_tours_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_ventas_tours_report" value="" required=""></td>
            </tr>
            <tr>
                <td><label for="type_ventas_tours_report">Type</label></td>
                <td><select id="type_ventas_tours_report" name="type" required="">
                        <option value="1">Transport</option>
                        <option value="2">Tours</option>
                        <option value="3">One Day</option>
                    </select></td>
                <td><label for="status_ventas_tours_report">Status</label></td>
                <td>
                    <select id="status_ventas_tours_report" name="status" required="">
                        <option value="1">CONFIRMED</option>
                        <option value="2">QUOTE</option>
                        <option value="3">CANCELLED</option>
                        <option value="4">INVOICED</option>
                        <option value="5">NOT SHOW W/ CHARGE</option>
                        <option value="6">NOT SHOW W/O CHARGE</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button type="button" style="float: right" id="print_ventas_tours_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<h3>Canal Services</h3>
<div>
    <form class="form_reports" id="form_entry_services_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_entry_services_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_entry_services_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_entry_services_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_entry_services_report" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_entry_services_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>-->
<h3>TOTAL TICKETS</h3>
<div>
    <form class="form_reports" id="form_total_tickets_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_total_tickets_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_total_tickets_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_total_tickets_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_total_tickets_report" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_total_tickets_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<!--<h3>Transfer Services</h3>
<div>
    <form class="form_reports" id="form_transfer_services_report">
        <table>
            <tbody>
            <tr>
                <td style="width: 100px;"><label for="id_initial_date_transfer_services_report">Initial Date</label></td>
                <td style="width: 50px;"><input type="date" name="initial_date" id="id_initial_date_transfer_services_report" value="" required=""></td>
                <td style="width: 100px;"><label for="id_end_date_transfer_services_report">End Date</label></td>
                <td style="width: 50px;"><input type="date" name="end_date" id="id_end_date_transfer_services_report" value="" required=""></td>
                <td><button type="button" style="float: right" id="print_transfer_services_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>-->



<h3>PAX SERVICES</h3>
<div>
    <form class="form_reports" id="form_cost_range_report">
        <fieldset id="liderpax" style="width:40%"><legend>PAX</legend>
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
                                            <input type="text" size="55" value="" name="leader" id="leader" autocomplete="off" />

                                            <input type= "hidden" size="4"  value="0" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
                                        
                                        </div>
                                    </td>

                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>

        <table>
            <tbody>
            <tr>
                <td><button type="button" style="float: right" id="print_pax">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>



<!--<h3>Daily Cost</h3>
<div>
    <form class="form_reports" id="form_cost_day_report">
        <table>
            <tbody>
            <tr>
                <td><button type="button" style="float: right" id="print_cost_day_report">Submit</button></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>-->

</div>


<i id= "spinner" class="fa fa-spinner fa-pulse fa-5x fa-fw" style="display:none; margin-left: 426px; margin-top: -476px; color: #CE4233;"></i>



<!--<canvas id="speedChart" width="600" height="400"></canvas>-->

<script type="text/javascript">
    function cargando()
    {
       //document.getElementById('spinner').style.display = '';      
       
       
    }
</script>
<style>
    .ui-icon{
        display: inline-block !important;
    }
    .error_validate{
        color: red;
    }

    label.error_validate{
        font-size: 9px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){

        $.fn.autosugguest({
            className: 'ausu-suggest',
            methodType: 'POST',
            minChars: 1,
            rtnIDs: true,
            dataFile: '<?php echo $data['rootUrl']; ?>leader/ajax'
        });

        $( "#accordion" ).accordion({
            heightStyle: "content"
        });
        var url_reserve_collect_report = "<?php echo $data['rootUrl']; ?>admin/reports/reserve_collect_report/";

        $('#print_reserve_collect_report').click(function(){
            var $form_reserve_collect_report = $('#form_reserve_collect_report');
            if($form_reserve_collect_report.valid()){
                var url = url_reserve_collect_report + $form_reserve_collect_report.find('#id_initial_date_reserve_collect_report').val() + '/' + $form_reserve_collect_report.find('#id_end_date_reserve_collect_report').val();
                window.open(url);
            }
        });

        var url_pax = "<?php echo $data['rootUrl']; ?>admin/reports/total_service_by_client/";

        $('#print_pax').click(function(){
            if($("#id_leader").val() != 0){
                var url = url_pax + $("#id_leader").val();
                window.open(url);
            }
        });

        var url_coms_and_refunds = "<?php echo $data['rootUrl']; ?>admin/reports/coms_and_refunds/";

        $('#print_coms_and_refunds').click(function(){
            var $form_coms_and_refunds = $('#form_coms_and_refunds');
            if($form_coms_and_refunds.valid()){
                var url = url_coms_and_refunds + $form_coms_and_refunds.find('#id_initial_date_coms_and_refunds').val() + '/' + $form_coms_and_refunds.find('#id_end_date_coms_and_refunds').val();
                window.open(url);
            }
        });

        $('#form_reserve_collect_report').validate({
            errorClass: 'error_validate'
        });


        var url_ventas_tours_report= "<?php echo $data['rootUrl']; ?>admin/reports/ventas_tours_report/";

        $('#print_ventas_tours_report').click(function(){
            var $form_ventas_tours_report = $('#form_ventas_tours_report');
            if($form_ventas_tours_report.valid()){
                var url = url_ventas_tours_report + $form_ventas_tours_report.find('#status_ventas_tours_report').val() + '/' + $form_ventas_tours_report.find('#type_ventas_tours_report').val() + '/' + $form_ventas_tours_report.find('#id_initial_ventas_tours_report').val() + '/' + $form_ventas_tours_report.find('#id_end_date_ventas_tours_report').val();
                window.open(url);
            }
        });

        $('#form_ventas_tours_report').validate({
            errorClass: 'error_validate'
        });

        var url_entry_services_report = "<?php echo $data['rootUrl']; ?>admin/reports/entry_services_report/";

        $('#print_entry_services_report').click(function(){
            var $form_entry_services_report = $('#form_entry_services_report');
            if($form_entry_services_report.valid()){
                var url = url_entry_services_report + $form_entry_services_report.find('#id_initial_date_entry_services_report').val() + '/' + $form_entry_services_report.find('#id_end_date_entry_services_report').val();
                window.open(url);
            }
        });

        $('#form_entry_services_report').validate({
            errorClass: 'error_validate'
        });

        var url_total_tickets_report = "<?php echo $data['rootUrl']; ?>admin/reports/total_tickets_report/";

        $('#print_total_tickets_report').click(function(){
            var $form_total_tickets_report = $('#form_total_tickets_report');
            if($form_total_tickets_report.valid()){
                var url = url_total_tickets_report + $form_total_tickets_report.find('#id_initial_date_total_tickets_report').val() + '/' + $form_total_tickets_report.find('#id_end_date_total_tickets_report').val();
                window.open(url);
            }
        });

        $('#form_total_tickets_report').validate({
            errorClass: 'error_validate'
        });


        var url_daily_arrival_report = "<?php echo $data['rootUrl']; ?>admin/reports/daily_arrival_report/";

        $('#print_daily_arrival_report').click(function(){
            var $form_daily_arrival_report = $('#form_daily_arrival_report');
            if($form_daily_arrival_report.valid()){
                var url = url_daily_arrival_report + $form_daily_arrival_report.find('#id_initial_date_daily_arrival_report').val() + '/' + $form_daily_arrival_report.find('#id_end_date_daily_arrival_report').val();
                window.open(url);
            }
        });

        $('#form_daily_arrival_report').validate({
            errorClass: 'error_validate'
        });



        var url_transfer_services_report = "<?php echo $data['rootUrl']; ?>admin/reports/transfer_services_report/";

        $('#print_transfer_services_report').click(function(){
            var $form_transfer_services_report = $('#form_transfer_services_report');
            if($form_transfer_services_report.valid()){
                var url = url_transfer_services_report + $form_transfer_services_report.find('#id_initial_date_transfer_services_report').val() + '/' + $form_transfer_services_report.find('#id_end_date_transfer_services_report').val();
                window.open(url);
            }
        });

        $('#form_transfer_services_report').validate({
            errorClass: 'error_validate'
        });

        var url_hotel_services_report = "<?php echo $data['rootUrl']; ?>admin/reports/hotel_services_report/";

        $('#print_hotel_services_report').click(function(){
            var $form_hotel_services_report = $('#form_hotel_services_report');
            if($form_hotel_services_report.valid()){
                var url = url_hotel_services_report + $form_hotel_services_report.find('#id_initial_date_hotel_services_report').val() + '/' + $form_hotel_services_report.find('#id_end_date_hotel_services_report').val();
                window.open(url);
            }
        });

        $('#form_hotel_services_report').validate({
            errorClass: 'error_validate'
        });

        var url_cost_range_report = "<?php echo $data['rootUrl']; ?>admin/reports/cost_range_report/";


        $('#print_cost_range_report').click(function(){
            var $form_cost_range_report = $('#form_cost_range_report');
            if($form_cost_range_report.valid()){
                var url = url_cost_range_report + $form_cost_range_report.find('#id_initial_date_cost_range_report').val() + '/' + $form_cost_range_report.find('#id_end_date_cost_range_report').val();
                window.open(url);
            }
        });

        var url_cost_day_report = "<?php echo $data['rootUrl']; ?>admin/reports/cost_day_report/";

        $('#print_cost_day_report').click(function(){
            window.open(url_cost_day_report);
        });

        $('#form_cost_range_report').validate({
            errorClass: 'error_validate'
        });

        $( "input[type='date']" ).datepicker({
            dateFormat:'yy-mm-dd',
            numberOfMonths: 2,
            maxDate:   365
        });
        
        
//        $("#id_initial_date_daily_arrival_report").change(function () {
//            var fecha_salida = $('#id_initial_date_daily_arrival_report').val();
//
//            $("#id_end_date_daily_arrival_report").val(fecha_salida);           
//            $("#id_initial_date_daily_arrival_report").datepicker("hide");
//
//
//            if (!Validar(fecha_salida)) {
//                $('#id_end_date_daily_arrival_report').focus();
//            } else {
//                var fecha_retorno = $('#id_end_date_daily_arrival_report').val();
//            }
//
//
//        });
        
        
//        $("#id_end_date_daily_arrival_report").change(function () {
//        var fecha_retorno = $('#id_end_date_daily_arrival_report').val();
//
//        $("#id_end_date_daily_arrival_report").val(fecha_retorno);
//
//        if (!Validar(fecha_retorno)) {
//            $('#id_end_date_daily_arrival_report').focus();
//        } else {
//            var fecha_salida = $('#id_initial_date_daily_arrival_report').val();
//        }
//
//
//        });




    });
</script>



