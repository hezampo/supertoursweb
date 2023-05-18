<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/invoicing.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-tabs-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']?>global/js/swig.min.js"></script>
<div id="header_page">
    <div class="header">Cancel Invoice</div>
    <div id="toolbar">
        <div class="toolbar-list">
            <ul>
                <li class="btn-toolbar">
                    <a id="cancel-invoice" href="" class="link-button">
                        <span class="cancel-invoice" title="invoicing process">&nbsp;</span> Invoice
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
        <legend>Filters</legend>
        <label for="id_factura">Invoice Number : </label>
        <input name="id" id="id_factura" type="text"/>
        <span id="search" ><i class="fa fa-search"></i> Search</span>
    </fieldset>
    <form>
        <fieldset>
            <legend>Invoices</legend>
            <table class="grid" style="margin-bottom:100px">
                <thead>
                <tr>
                    <th style="width:5%;"></th>
                    <th>Invoice Number</th>
                    <th>Company Name</th>
                    <th>Subtotal</th>
                    <th>Collected</th>
                    <th>Total</th>
                    <th>Creation Date</th>
                    <th>Details</th>
                    <th>Gen_PDF</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
            </table>
        </fieldset>
    </form>
</div>

<div id="modal" class="modal" style="display:block"></div>
<div  id="dialog_message" style="display:none" title="Cancel Invoice Concepts">
    <p>
        <samp style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje">
            Please type the concept of cancelation of this invoice, and attach the
            original invoice...
        </samp>
    <form id="info" enctype="multipart/form-data">
        <textarea style="width:550px; height: 240px" id="cancel-concept" name="cancel-concept"></textarea>
        <div class="control" style="margin-top: 10px;"><label class="attach" for="attach">Attach : </label>
            <input name="attach" id="attach" type="file" accept="image/*, application/pdf"/>
        </div>
        <input type="hidden" id="factura" name="factura" value="">
        <span class="pull-right" id="cancel"><i class="fa fa-times"></i> Cancel it</span>
    </form>
</div>

<script>
    $(function(){

        /*Initializate libraries*/

        $("#cancel-invoice").click(function(evt){

            evt.preventDefault();
            if($("input[name='sel']").is(':checked')){
                $("#dialog_message").dialog({
                    modal:true,
                    closeText: "hide",
                    width: 600,
                    height: 415,
                    closeOnEsc: false
                });
                $("#factura").val($("#id_factura").val());
            }else{
                alert('Please select a invoice first');
            }

        });

        $("#cancel").click(function(evt){

            if($("#cancel-concept").val().trim() == ''){
                alert('Please insert a concept');
            }else if($("#attach").val().trim() == ''){
                alert('Please attach a file');
            }else{
                $("#info").attr('action','<?php echo $data['rootUrl']?>admin/facturacion/cancelar')
                    .attr('method','POST')
                    .submit();
            }
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

        $("#search").click(function(){
            var id = $("#id_factura").val();
            var tmpl = swig.compile($("#rows").html(),{ filename: 'rows'});
            $("#table_body").html('');
            $.getJSON('<?php echo $data['rootUrl']?>admin/facturacion/factura/'+id,function(data){
                console.log(data);
                if(data == false){
                    alert('No invoice with this number');
                }else{
                    $("#table_body").append(tmpl(data));
                }
            });
        });

        $(".close-modal").live('click',function(){
            $("#modal").hide();
        });

        $(".details").live('click',function(evt){
            evt.preventDefault();
            var id = $(this).attr('data-link');
            var tmpl3 = swig.compile($("#invoice").html(),{filename: 'invoice'});
            $.getJSON('<?php echo $data['rootUrl']?>admin/facturacion/details/'+id,function(data){
                var tmpl2 = swig.compile($("#invoice-concept").html(),{filename:'invoice-concept'});
                $("#modal").html(tmpl3(data));
                $.getJSON('<?php echo $data['rootUrl']?>admin/facturacion/details/services/'+id,function(data2){
                    $("#invoices-concept").html(''); //limpia los concepts anteriores
                    $.each(data2,function(arrayid,dato){
                        $("#invoice-concepts").append(tmpl2(dato));
                    });
                    $("#modal").show();
                });

            });
        });

    })
</script>

<script type="text/template" id="rows">
    <tr><!--{% if not validop %} disabled {% endif %}-->
        <td><input type="checkbox" id="i-{{ id }}" name="sel" ></td>
        <td>{{ id }}</td>
        <td>{% if agency %}{{ agency }}{% else %}Supertours{% endif %}</td>
        <td>{{ subtotal }}</td>
        <td>{{ collect }}</td>
        <td>{{ total }}</td>
        <td>{{ invoicedate }}</td>
        <td><a href="<?php echo $data['rootUrl']?>admin/facturacion/details/{{ id }}" target="_blank" class="details" data-link="{{ id }}"><img class="pdficon" src="<?php echo $data['rootUrl']?>global/img/details.png"></a></td>
        <td><a href="<?php echo $data['rootUrl']?>admin/facturacion/genpdf/{{ id }}"><img class="pdficon" src="<?php echo $data['rootUrl']?>global/img/pdf.png"></a></td>
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
                                    <span class="title-ninvoice">Invoice Number : </span><span class="ninvoice">{{ invoicenumber }}</span>
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