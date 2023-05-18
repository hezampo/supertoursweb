<?php //echo $data['tipo_reserva'];?>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/invoicing.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-tabs-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']?>global/js/swig.min.js"></script>
<form id="info" enctype="multipart/form-data">
<div id="header_page">
    <div class="header">Cancel Pay</div>
    <div id="toolbar">
        <div class="toolbar-list">
            <ul>
                <li class="btn-toolbar">
                    <a id="cancel-invoice" href="" class="link-button">
                        <span class="cancel-invoice" title="Remove Payment">&nbsp;</span> Delete
                    </a>
                </li>
<!--                <li class="divider">&nbsp;</li>-->
<!--                <li class="btn-toolbar">
                    <a href="<?php /*echo $data['rootUrl'];*/ ?>admin/home" id="btn-back" class="link-button">
                            <span class="icon-back" title="Regresar">
                                &nbsp;
                            </span> Back
                    </a>
                </li>-->
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div id="maincontent">
    <fieldset>
        <legend>Filters</legend>
        <label for="id_factura">ID Number : </label>
        <input name="id" id="id_factura" type="text" value='<?php echo $data['id_reserva'];?>'/>
        <select name="filter" id="filter">
                <option value="0" >
                    Transportations
                </option>
                <option value="1">
                    Tours Multidays
                </option>
                <option value="2">
                    Tours One Days
                </option>
            </select>
        <span id="search" ><i class="fa fa-search"></i> Search</span>
    </fieldset>
    <form>
        <fieldset>
            <legend>Invoices</legend>
            <table class="grid" style="margin-bottom:100px">
                <thead>
                <tr>
                    <th style="width:5%;"></th>
                    <th>ID</th>
                    <th>Method</th>
                    <th>Type Pay</th>
                    <th>Paid</th>
                    <th>User</th>
                    <th>Date</th>
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
    
        <textarea style="width:550px; height: 240px" id="cancel-concept" name="cancel-concept"></textarea>
        <div class="control" style="margin-top: 10px;"><label class="attach" for="attach">Attach : </label>
            <input name="attach" id="attach" type="file" accept="image/*, application/pdf"/>
        </div>
        <input type="hidden" id="factura" name="factura" value="">
        <span class="pull-right" id="cancel"><i class="fa fa-times"></i> Cancel it</span>
   
</div>
</form>
<script>
    $(function(){

        /*Initializate libraries*/

        

        

        $("#cancel-invoice").click(function(evt){            
                      
            $("#info").attr('action','<?php echo $data['rootUrl']?>admin/pagos/cancelando/new')
                .attr('method','POST')
                .submit();
            return false;
        });
       

        $("#search").click(function(){
            var id = $("#id_factura").val();
            var id_filtro = $("#filter").val();
            var tmpl = swig.compile($("#rows").html(),{ filename: 'rows'});
            $("#table_body").html('');
            $.getJSON('<?php echo $data['rootUrl']?>admin/pagos/buscar/'+id+'/'+id_filtro,function(data){
                console.log(data);
                if(data == false){
                    alert('No existen pagos');
                }else{
                    $.each(data,function(arrayid,dato){
                    if(dato != "false"){
                        $("#table_body").append(tmpl(dato));
                    }else{
                        alerta = true;
                    }
                   });
                    
                }
            });
        });

        $(".close-modal").live('click',function(){
            $("#modal").hide();
        });

       

    })
</script>

<script type="text/javascript">

$(window).load(function () {

        buscar_pagos();       
        
        


  });
  

</script>


<script type="text/template" id="rows">
    <tr>
        <td><input type="checkbox" id="{{ id }}"  value="{{ id }}"  name="pagos[]" ></td>
        <td>{{ id_r }}</td>
        <td>{{ pago }}</td>
        <td>{{ tipo_pago }}</td>
        <td>{{ pagado }}</td>
        <td>{{ usuario }}</td>
        <td>{{ fecha }}</td>
    </tr>
</script>

<script type="text/javascript">

        function buscar_pagos() {
            
            var idreserva = "<?php echo $data['id_reserva']; ?>";
            var tipo_reserva = "<?php echo $data['tipo_reserva']; ?>";
           
            
            if(idreserva != ""){
            
                setTimeout(function () {

                    $('#search').click();

                }, 100);
            }
            
            if(tipo_reserva == "transportation"){
                
                document.getElementById("filter").selectedIndex = 0;
                
            }else if(tipo_reserva == "multiday"){
                
                
                document.getElementById("filter").selectedIndex = 1;
                
            }else if(tipo_reserva == "oneday"){
                
                document.getElementById("filter").selectedIndex = 2;
            }

        }

</script>








<!--<script id="invoice" type="text/template">
    <div class="close-modal">close <i class="fa fa-times"></i></div>
    <table style="padding: 0 1em 0 1em;">
        <tbody>
        <tr>
            <td style="width:50%"><img src="<?php /*echo $data['rootUrl']*/?>Logo-Supertours-mail.jpg" class="supertours-banner">
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
</script>-->


