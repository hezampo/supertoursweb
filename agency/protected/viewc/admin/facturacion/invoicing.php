<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 11/13/13
 * Time: 10:39 AM
 */

?>

<!--jquery UI -->
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/invoicing.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/facturacion/proceso" class="form" id="form1">

    <div id="header_page">
        <div class="header">Invoicing</div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar">
                        <a id="invoice" href="<?php echo $data['rootUrl']?>admin/invoicing_process" class="link-button">
                            <span class="invoice" title="invoicing process">&nbsp;</span> Invoice
                        </a>
                    </li>
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

    <div id="maincontent" style="background-color: #f6f6f6; width: 984px; height:300px; padding:9px; margin-left: 0px;">
        <fieldset id="invoicing-period" style="width: 967px; height: 68px; margin-left: 0.01em; margin-right: 0.01em;">
            <legend>Invoicing Period</legend>
            <label for="starting-date" > Starting Date : </label><input class="datepick" name="starting-date" id="starting-date" type="datetime" style="font-weight: bold; text-align: center;" value="" autocomplete = "off">
            
            <label for="ending-date" > Ending Date : </label><input class="datepick" name="ending-date" id="ending-date" type="datetime" style="font-weight: bold; text-align: center;" value="" autocomplete = "off">
            <label for="invoice_date"> Invoice date: </label><input class="datepick" name="invoice_date" id="invoice_date" type="datetime" style="font-weight: bold; text-align: center; background: lightyellow;" value="" autocomplete = "off"/> 
            
            <!--<label> invoice date: </label><input type="date" placeholder="YYYY-MM-DD" name="invoice_date" id="invoice_date"  size="25" maxlength="40"  value="<?php /*echo $cliente['invoice_date']; */?>"/>--> 
            <!--invoice date:<input type="text" class="datepick" name="username" id="username"  size="25" maxlength="40"  value="<? echo $cliente['username']; ?>"/>-->
            <label style="padding-left:10px" for="filter">Filter by</label>
            <select name="filter" id="filter">
                <option value=0 >
                    All
                </option>
                <option value=1>
                    Invoiced
                </option>
                <option value=2>
                    Service (Tour)
                </option>
                <option value=3>
                    Service (OneDay)
                </option>
                <option value=4>
                    Service (Reserve)
                </option>
                <option value=5>
                    Company Name
                </option>
            </select>
            <label>
                <input type="text" id="companyname" name="companyname" value="" style="display:none;">
            </label>
            <span id="search" style="margin-top: 29px; margin-left: -71px; position: absolute;"><i class="fa fa-search"></i> Search</span>
        </fieldset>
        <fieldset style="width:966px; margin-left: 0.01em; margin-right: 0.01em;">
            <legend>Results</legend>
            <table class="grid" style="margin-bottom: 80px;">
                <thead>
                <tr>
                    <th>
                        <label>
                            <input type="checkbox" id="select-all" name="select-all">
                        </label>
                    </th>
                    <th>Typ_serv</th>
                    <th>Conf. Code</th>
                    <th>Passenger Name</th>
                    <th>Customer</th>
                    <th style="width:80px; text-align: center;">Start Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th style="width:5%;"></th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody id="table_info">

                </tbody>
            </table>
        </fieldset>
    </div>
</form>
<div id="debbug"></div>
<div id="dialog-message" title="Comment">
    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
    <p>

    </p>
</div>
<script>
    $(function(){

        $("#dialog-message").hide();

        /*Iniatializate libraries*/

        $(".datepick").datepicker({
            dateFormat:      'mm-dd-yy',
//            maxDate:         -1,
            beforeShow: function() {
                if($(this).attr("disable")){
                    return false;
                }
            }
        });

        /*Events Functionality*/

        $("#select-all").click(function(){
            if($(this).is(':checked')){
                $("input[name='checkboxsel[]']").attr('checked',true);
            }else{
                $("input[name='checkboxsel[]']").attr('checked',false);
            }
        });

        $("#search").click(function(){
            var start = $("#starting-date").val();
            var end = $("#ending-date").val();

            var st1 = start.split('-');
            var end1 = end.split('-');

            var st2 = new Date(st1[2]+'-'+st1[0]+'-'+st1[1]);
            var end2 = new Date(end1[2]+'-'+end1[0]+'-'+end1[1]);


            var cadena = encodeURI($("#n_fecha").val());
            var texto = encodeURI($("#companyname").val());
            if(texto == ''){
                texto = 'slug';
            }
            if(validateDates(st2,end2)){
                var filter = $("#filter").val();
                $("#table_info").load('<?php echo $data['rootUrl']?>admin/facturacion/afacturar/'+start+'/'+end+'/'+filter+'/'+texto);
            }
        });

        $("#invoice").click(function(evt){
            evt.preventDefault();
            if($("input[name='checkboxsel[]']").is(':checked')){
                $("#form1").submit();
            }
            return false;
        });

        $("#filter").change(function(){
            if($(this).val() == 5){
                $("#companyname").css('display','inline-block');
            }else{
                $("#companyname").css('display','none');
            }
        });

        $(".comment").live('click',function(evt){
            evt.preventDefault();
            console.log('click');
            var com = $(this).next('textarea').val();
            com = (com.trim() == "")? '...':com;
            $("#dialog-message").children('p').html(com).parent()
                .dialog({
                    modal:true,
                    width:300,
                    height:200
                });
        })

    });

    //utils functions

    function validateDates(start,end){
//        var today = new Date();
//        today.setDate(today.getDate() - 1);
//        if(today<start || today<=end){
//            alert('You can\'t make invoices to services after today\'s date ');
//            return false;
//        }
//
//        if(start>end){
//            alert('Please correct the dates...');
//            return false;
//        }

        return true;
    }
</script>