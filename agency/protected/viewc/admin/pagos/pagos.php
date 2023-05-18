<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/2/13
 * Time: 11:04 AM
 */
$ag = isset($data['agency'])? $data['agency'] : '';
?>

<style>
    .ausu-suggestionsBox
    {
        position: absolute;
        left: 2px;
        top:40px !important;
        font-family:Verdana, Arial, Helvetica, sans-serif;

        font-size: 11px;
        margin: 26px 0px 0px 0px;

        display: none;
        padding: 0px;
        z-index:9;
    }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/payments.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/new/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']?>global/js/swig.min.js"></script>

<form id="form1" class="form" action="<?php echo $data['rootUrl']?>admin/pagos/proceso" method="post" name="form1" enctype="multipart/form-data">
    <div id="header_page">
        <div class="header">Payment Window</div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar">
                        <a href="#" id="btn-load" class="link-button">
                            <span class="icon-load" title="Load">
                                &nbsp;
                            </span> Load
                        </a>
                    </li>
                    <li class="btn-toolbar">
                        <a href="#" id="btn-statements" class="link-button">
                            <span class="icon-statements" title="Statements">
                                &nbsp;
                            </span> Stats.
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

    <div id="maincontent">

        <fieldset>
            <legend>Agency Info</legend>
            <div style="width: 600px"><label for="company-name" style="margin-right: 10px">Customer</label><input type="text" readonly id="company-name">
                <label for="aphone" style="margin: 0 10px;">Agency Phone</label><input type="text" readonly id="aphone">
            </div>
            <div style="float:right; width:200px;">
                <label for="uagency">Conctact User  </label><input type="text" id="uagency" readonly>
                <label for="uaphone">Contact Phone  </label><input type="text" id="uaphone" readonly>
            </div>
            <div style="float: left; position: relative">
                <h4 style="color:#0b55c4;">Payment Form</h4>
                <!--<div class="clearfix"></div>-->
                <div class="row-control">
                    <div class="control">
                        <label for="payment-method" >Payment Method : </label>
                        <select id="payment-method" name="payment-method" style="width: 200px">
                            <option value="1">Check</option>
                            <option value="2">Wire Transfer</option>
                            <option value="2">Wire Fee.</option>
                        </select>
                    </div>
                    <div class="control">
                        <label for="check-nu" >Check Number</label>
                        <input name="check-nu" id="check-nu" type="text" onkeypress="return isNumberKey(event)"/>
                    </div>
                    <div class="control">
                        <label for="deposit">Deposit?</label><br>
                        <input name="deposit" id="deposit" type="checkbox"/>
                    </div>
                </div>
                <div class="row-control">
                    <div class="control">
                        <label for="discount">Discount : </label>
                        <input name="discount" id="discount" type="number" value="0"/>
                    </div>
                    <div class="control">
                        <label for="perdiscount">Per. discount : </label>
                        <input name="perdiscount" id="perdiscount" type="number" value="0"/>
                    </div>
                    <div class="control" style="vertical-align: bottom;">
                        <span id="pay" >Save Payment</span>
                    </div>
                </div>
                <div class="rowcontrol">
                    <div class="control"><label class="ammount" for="attach">Ammount : </label>
                        <input name="ammount" id="ammount" type="number"/>
                    </div>
                    <div class="control"><label class="attach" for="attach">Attach : </label>
                        <input name="attach" id="attach" type="file" accept="image/*, application/pdf"/>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Invoices</legend>
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Unpaid</a></li>
                    <li><a href="#tabs-2">Paid</a></li>
                </ul>
                <div id="tabs-1">
                    <table class="grid" style="margin-bottom:100px">
                        <thead>
                        <tr>
                            <th style="min-width:10px;"></th>
                            <th>Invoice Number</th>
                            <th>Inv. PDF</th>
                            <th>Discount</th>
                            <th>Inv. Date</th>
                            <th>Inv. Amount</th>
                            <th>Balance</th>
                            <th>Paid</th>
                            <th>Paid Date</th>
                            <th>Attach</th>
                        </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>
                </div>
                <div id="tabs-2">
                    <table class="grid" style="margin-bottom:100px">
                        <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Discount</th>
                            <th>Inv. Date</th>
                            <th>Inv. Amount</th>
                            <th>Paid</th>
                            <th>Paid Date</th>
                            <th>PDF</th>
                            <th>Attach</th>
                        </tr>
                        </thead>
                        <tbody id="table_body2">
                        </tbody>
                    </table>
                </div>
            </div>
        </fieldset>
    </div>

    <div  id="dialog_message1" style="display:none" title="Customer Searching box">
        <p>
            <samp style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje">
                Please enter the company name of the customer...
            </samp>
        <div class="ausu-suggest" style="width: 100%;">
            <input id="agency" name="agency" type="text" autocomplete="off" style="margin-top: 30px; width:100% !important; height: 1.5em"/>
            <input type="hidden" id="id_agency" name="id_agency" value="<?php echo (isset($data['preload']))? $ag->id : ''?>">
        </div>
    </div>


    <div id="dialog-message" title="Error file" style="display: none">
        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
            There was a problem with the file uploading.
            Check the file you try to upload is a JPG, GIF, PNG, BMP or PDF and try again
        </p>
    </div>

    <div id="mascaraP" style="display:none;"></div>
    <div id="debbug"></div>
    <div id="lightbox">
        <div class="close-modal">close <i class="fa fa-times"></i></div>
        <div class="att"></div>
    </div>
</form>
<script>

    $(function(){

        $.fn.autosugguest({
            className: 'ausu-suggest',
            methodType: 'POST',
            minChars: 1,
            rtnIDs: true,
            dataFile: '<?php echo $data["rootUrl"]; ?>admin/tours/loaddatos'
        });

        $("#dialog_message").hide();

        $("#tabs").tabs();


        $("#dialog_message1").dialog(
            {
                modal : true,
                width: 600,
                height: 400,
                closeOnEscape: false,
                closeText : "hide",
                buttons : [
                    {
                        text: 'load',
                        click: function(){
                            $.getJSON('<?php echo $data['rootUrl']?>admin/loadagency/'+$("#id_agency").val(),function(data){
                                console.log(data[0].company_name);
                                $("#company-name").val(data[0].company_name);
                                $("#aphone").val(data[0].phone1);
                                $("#uagency").val(data[0].manager);
                                $("#table_body").load('<?php echo $data['rootUrl']?>admin/loadinvoices/'+$("#id_agency").val());
                                $("#table_body2").html('');
                                $("#dialog_message1").dialog('close');
                            });
                        }
                    }
                ]
            }
        );

        $("#btn-statements").click(function(){
            location.href= "<?php echo $data['rootUrl']?>admin/reports/statement_report/"+$("#id_agency").val();
        });

        <?php if(isset($data['preload'])) { ?>
        $("#dialog_message1").dialog('close');
        $("#company-name").val('<?php echo $ag->company_name?>');
        $("#aphone").val('<?php echo $ag->phone1?>');
        $("#uagency").val('<?php echo $ag->manager ?>');
        $("#table_body").load('<?php echo $data['rootUrl']?>admin/loadinvoices/<?php echo $data['id']?>');
        $("#id_agency").val('<?php echo $data['id']?>');
        $("#dialog_message1").dialog('close');
        <?php } ?>

        $("a[href='#tabs-2']").click(function(){
            console.log('trigged');
            $("#table_body2").load('<?php echo $data['rootUrl']?>admin/loadpaidinvoices/'+$("#id_agency").val());
        });

        $(".box").live('click',function(evt){
            evt.preventDefault();
            $("#mascaraP").show();
            $("#lightbox .att").html('<div><img src = "'+$(this).attr('href')+'"/></div>');
            $("#lightbox").show();
        });

        $(".close-modal").click(function(){
            $("#mascaraP").hide();
            $("#lightbox").hide();
        });

        $("#attach").change(function(){
            var ext = $(this).val().split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg', 'pdf', 'bmp']) == -1) {

                $('#attach').val("");

                $( "#dialog-message" ).dialog({
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });

            }
        });

        $("#btn-load").click(function(evt){
            $("#dialog_message1").dialog('open');
        });

        $("#payment-method").change(function(){
            if($(this).val() != 1){
                $("#check-nu").val('0').attr('readonly','readonly');
            }else{
                $("#check-nu").val('').attr('readonly',false);
            }
        });

        $("#pay").click(function(){
            if($("#id_agency").val().trim() == ""){
                alert('Please load an agency with the load button in the right corner');
            }else{
                if(validar()){
                    $("#form1").submit();
                }
            }
        });


    });

    function poner(id, id2) {
        var id = id;
        var id2 = id2;
        $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/cargardatos/'+id+'/'+id2);
    }

    function validar(){

        var total = 0;

        if($("#check-nu").val().trim() == ""){
            alert('Please type the Check Number');
            $("#check-nu").focus();
            return false;
        }

        if(!$("input[name='factura']").is(':checked')){
            alert('Please select a Invoice to begin the payment process');
            return false;
        }else{
            var id = $("input[name='factura']:checked").val();
            total = $("#balance-"+id).val();
        }

        if (isNaN($("#ammount").val())){
            alert('Please type the total amount of the pay');
            $("#ammount").focus();
            return false;
        }

        
//        if($("#deposit").is(':checked')){
//            if(total >= $("#ammount").val()){
//                alert('Changing type of payment to full payment');
//                $("#deposit").attr('checked',false);
//            }
//        }

//        if($("#discount").val()<0 && $("#discount").val()>total){
//            alert('The discount cannot be more than the total concept of the invoice');
//            $("#discount").focus();
//            return false;
//        }

        if($("#perdiscount").val()<0 && $("#perdiscount").val()>100){
            alert('The discount cannot be more than the 100% of the concept invoiced');
            $("#discount").focus();
            return false;
        }

        if($("#discount").val()>0 && $("#perdiscount").val()>0){
            alert('You only may apply one concept of discounting');
            $("#discount").focus();
            return false;
        }

        if($("#discount").val()>0){
            total = total - $("#discount").val();
        }

        if($("#perdiscount").val()>0){
            total = total * (1-($("#perdiscount").val()/100));
        }

        if(total == $("#ammount").val()){
            var conf = confirm('You enter more than the total invoice concept, are you sure you want to pay '+$("#ammount").val()+'\n Total Invoiced Concept : '+total);
            if(conf == false){
                $("#ammount").focus();
                return false;
            }
        }

        if((!$("#deposit").is(':checked'))){
            alert('If you Are paying just a advance of the total payment \n please check the option Deposit...');
            $("#deposit").focus();
            return false;
        }

        return true;

    }

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        //console.log(charCode);
        if (charCode != 46 && charCode != 45 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }




</script>