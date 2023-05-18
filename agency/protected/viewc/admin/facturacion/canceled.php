<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/16/13
 * Time: 5:04 PM
 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/invoicing.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-tabs-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']?>global/js/swig.min.js"></script>
<form>
    <div id="header_page">
        <div class="header">Canceled Invoices</div>
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

    <div id="maincontent">
        <fieldset>
            <legend>Filters</legend>
            Filter By :
            <label for="filter"><select name="filter" id="filter">
                    <option value="all">All</option>
                    <option value="company_name">Agency</option>
                </select></label>
            <label for="company_name"><input id="company_name" type="text"/></label>
            <span id="search" ><i class="fa fa-search"></i> Search</span>
        </fieldset>
        <fieldset>
            <legend>Invoices</legend>
            <table class="grid" style="margin-bottom:100px">
                <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Company Name</th>
                    <th>Subtotal</th>
                    <th>Collected</th>
                    <th>Total</th>
                    <th>Creation Date</th>
                    <th>Details</th>
                    <th>Gen_PDF</th>
                    <th>Cancel Concept</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
            </table>
        </fieldset>
    </div>
</form>

<div  id="dialog_message" style="display:none" title="Cancel Invoice Concepts">
</div>

<div id="modal" class="modal" style="display:block"></div>

<div id="debbug"></div>
<script>
    $(function(){

        /*Initializate libraries*/

        $(".datepicker").datepicker({
            dateFormat:      'mm-dd-yy',
            maxDate:         0,
            beforeShow: function() {
                if($(this).attr("disable")){
                    return false;
                }
            }
        });

        $("#search").click(function(){
            var filter = $("#filter").val();
            var tmpl = swig.compile($("#rows").html(),{ filename: 'rows'});
            var texto = $("#company_name").val();
            if(texto == ""){
                texto = "slug";
                filter = "all";
            }
            $("#table_body").html("");
            $.getJSON('<?php echo $data['rootUrl']?>admin/buscarcanceladas/'+filter+'/'+texto,function(data){
                var alerta = false;
                $.each(data,function(arrayid,dato){
                    if(dato != "false"){
                        $("#table_body").append(tmpl(dato));
                    }else{
                        alerta = true;
                    }
                });
                if(alerta){
                    alert('No Invoices unpaid to show');
                }
            });
        });

        $(".close-modal").live('click',function(){
            $("#modal").hide();
        });

        $(".cancel-report").live('click',function(evt){
            var id = $(this).attr('id').split('-')[1];
            var tpl = swig.compile($('#modal-info').html(),{filename: 'modal'});
            $.getJSON('<?php echo $data['rootUrl']?>admin/cancel_report/'+id,function(data){
                $("#dialog_message").hide()
                    .html(tpl(data))
                    .dialog({
                        modal:true,
                        closeOnEsc: false,
                        width:600,
                        height: 400
                    })
                    .show();
            });
        });


        $(".details").live('click',function(evt){
            evt.preventDefault();
            var id = $(this).attr('data-link');
            var tmpl = swig.compile($("#invoice").html(),{filename: 'invoice'});
            $.getJSON('<?php echo $data['rootUrl']?>admin/facturacion/details/'+id,function(data){
                var tmpl2 = swig.compile($("#invoice-concept").html(),{filename:'invoice-concept'});
                $("#modal").html(tmpl(data));
                $.getJSON('<?php echo $data['rootUrl']?>admin/facturacion/details/services/'+id,function(data2){
                    $("#invoices-concept").html(''); //limpia los concepts anteriores
                    $.each(data2,function(arrayid,dato){
                        $("#invoice-concepts").append(tmpl2(dato));
                    });
                    $("#modal").show();
                });

            });
        });

    });
</script>

<!-- SWIG TEMPLATES -->
<script type="text/template" id="rows">
    <tr>
        <td style="text-decoration: line-through overline underline">{{ id }}</td>
        <td>{{ agency }}</td>
        <td>{{ subtotal }}</td>
        <td>{{ collect }}</td>
        <td>{{ total }}</td>
        <td>{{ invoicedate }}</td>
        <td><a href="<?php echo $data['rootUrl']?>admin/facturacion/details/{{ id }}" target="_blank" class="details" data-link="{{ id }}"><img class="pdficon" src="<?php echo $data['rootUrl']?>global/img/details.png"></a></td>
        <td><a href="<?php echo $data['rootUrl']?>admin/facturacion/genpdf/{{ id }}"><img class="pdficon" src="<?php echo $data['rootUrl']?>global/img/pdf.png"></a></td>
        <td><a href="#" class="cancel-report" id="cancel-{{ cancelid }}"><img src="<?php echo $data['rootUrl']?>global/img/adv.jpg" style="width:20px; height:20px;"></a></td>
    </tr>
</script>

<script id="invoice" type="text/template">
    <div class="close-modal">close <i class="fa fa-times"></i></div>
    <table style="padding: 0 1em 0 1em;">
        <tbody>
        <tr>
            <td style="width:50%"><img src="<?php echo $data['rootUrl']?>Logo-Supertours-mail.jpg" class="supertours-banner">
                <p>Supertours of Orlando</p>
                <blockquote>712 DR. PHILLIPS BLVD.<br/>SUITE 50-129<br/><small>ORLANDO,FL. 32819</small></blockquote>
            </td>
            <td style="width:50%">

                <table style="width:100%;height: 100%;">
                    <tr>
                        <td style="vertical-align: top">
                            <div class="invoice-info" >
                                <div class="invoice-number">
                                    <span class="title-ninvoice">Invoice Number : </span><span class="ninvoice" style="text-decoration: line-through;">{{ invoicenumber }}</span><b style="color:red">CANCELED</b>
                                </div>
                                <div class="other-info" style="display:table">
                                    <p style="display:table-row"><span style="display:table-cell">Terms</span> <span style="display:table-cell"> : Voucher</span></p>
                                    <p style="display:table-row"><span style="display:table-cell">Date</span> <span style="display:table-cell"> : {{ invoicedate }}</span></p>
                                </div>
                                <div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>

            </td>
        </tr>
        {% if (agency != "SUPERTOURS") %}
        <tr>
            <td><div class="pretitle">Sold To</div></td>
            <td><div class="pretitle">Make check payable to</div></td>

        </tr>
        <tr>
            <td>
                <p><b>{{ agency }}</b></p>
                <blockquote>
                    {{ addres }}<br/>
                    {{ state }}<br/>
                    USA<br/>
                    Fax {{ fax }}<br/>
                    Phone {{ phone1 }}<br/>
                </blockquote>
            </td>
            <td style="padding-left:10px;"><p><b>SUPERTOURS OF ORLANDO</b></p>
                <blockquote>5419 International Drive<br/><small>ORLANDO,FL. 32819</small></blockquote></td>
        </tr>
        {% else %}
        <tr>
            <td colspan="2">
                <h3> Sales Report </h3>
            </td>
        </tr>
        {% endif %}
        <tr>
            <table class="grid">
                <thead>
                <tr>
                    <th colspan="2" style="width:20%">Your Reference #</th>
                    <th rowspan="2">Pax Name<br>Service</th>
                    <th rowspan="2">Confirmation Code</th>
                    <th rowspan="2">Date In <br> Date out</th>
                    <th rowspan="2">Total Sale -<br>Collect</th>
                    <th rowspan="2"><br> = Total Due</th>
                </tr>
                <tr>
                    <th>ADULT</th>
                    <th>CHILDREN</th>

                </tr>
                </thead>
                <tbody id="invoice-concepts">
                </tbody>
            </table>
        </tr>
        <tr>
            <table id="results" style="float:right; border-radius:10px; border:1px #000 solid; min-height: 100%; margin:10px 0 50px 0;">
                <tr>
                    <th>Subtotal</th>
                    <td style="width:100px; text-align: right; font-size: 15px;">{{ subtotal }}</td>
                </tr>
                <tr>
                    <th>Collect</th>
                    <td style="border-bottom: 1px #000000 solid; text-align: right; font-size: 15px;">{{ collect }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td style="text-align: right; font-size: 15px;">{{ total }}</td>
                </tr>
            </table>
        </tr>
        </tbody>
    </table>
</script>

<script type="text/template" id="invoice-concept">
    <tr>
        <td>{{ adult }}</td>
        <td>{{ children }}</td>
        <td>{{ pax }}<br>{{ type }}</td>
        <td>{{ confcode }}</td>
        <td>{{ initdate }}<br>{{ enddate }}</td>
        <td>{{ sale }}<br>{{ collect }}</td>
        <td>{{ total }}</td>
    </tr>
</script>

<script type="text/template" id="modal-info">
    <p>
    <samp style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje">
        Reason of cancellation of the service :
        <br>
        <br>
        </samp>
        {{ texto }}
        <br>
        <br>
        <a href="<?php echo $data['rootUrl']?>{{ imagen }}" target="_blank">Attachment...</a>
    </p>
</script>