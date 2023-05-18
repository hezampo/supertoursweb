<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/2/13
 * Time: 11:04 AM
 */
?>

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
        <div class="header">Invoicing edit process [<?php echo $data['factura']->id?>]</div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar" style="margin-right:10px; display:none;">
                        <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-remake" class="link-button">
                            <span class="icon-remake" title="Refacturar">
                                &nbsp;
                            </span> Re-invoice
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
        <input type="hidden" value="<?php echo $data['factura']->id?>" id="id">
        <fieldset>
            <legend>Invoice Info</legend>
            <table class="grid" style="width: 500px; float:left">
                <tbody style="background-color: #fafafa !important;">
                <tr>
                    <th>
                        Invoice Number :
                    </th>
                    <td colspan="3" style="color:#c60003; font-style: italic; font-weight: bold; font-size: 1.3em">
                        <?php echo str_pad($data['factura']->id,8,'0',STR_PAD_LEFT)?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Company Name :
                    </th>
                    <td colspan="3" style="color:#C60003; font-style: italic; font-weight: bold; font-size: 1.3em">
                        <?php echo $data['company_name']?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Terms :
                    </th>
                    <td style="color:#C60003; font-style: italic; font-weight: bold;">
                        Voucher
                    </td>
                    <th>
                        Date :
                    </th>
                    <td style="color:#C60003; font-style: italic; font-weight: bold;">
                        <?php echo $data['factura']->creation_date ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="grid" style="width:200px; float: right">
                <tbody style="background-color: #fafafa !important;">
                <tr>
                    <th>
                        Subtotal :
                    </th>
                    <td style="color:#C60003; font-style: italic; font-weight: bold;">
                        <?php echo $data['factura']->subtotal?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Collect :
                    </th>
                    <td style="color:#C60003; font-style: italic; font-weight: bold; border-bottom: double 1px blue !important;">
                        <?php echo $data['factura']->collect?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Total :
                    </th>
                    <td style="color:#C60003; font-style: italic; font-weight: bold;">
                        <?php echo $data['factura']->total?>
                    </td>
                </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Services</legend>
            <table class="grid">
                <thead>
                <tr>
                    <th rowspan="2" style="width:5%"></th>
                    <th colspan="2">Your Reference</th>
                    <th rowspan="2">Pax Name<br>Service</th>
                    <th rowspan="2">Confirmation Code</th>
                    <th rowspan="2">Date In<br>Date out</th>
                    <th rowspan="2">Total Sale -<br>Collect</th>
                    <th rowspan="2"> = Total Due</th>
                </tr>
                <tr>
                    <th>
                        Adults
                    </th>
                    <th>
                        Childs
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['services'] as $service) {?>
                    <tr>
                        <td>
                            <a class="re-trigger" href="<?php echo $data['rootUrl']?>admin/<?php echo $service['link'] ?>/edit/<?php echo $service['id']?>" target="_blank">
                                <img src="<?php echo $data['rootUrl']?>global/img/admin/edit.png" style="width:16px; height:16px;padding-left: 10px;">
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $service['adult']?>
                        </td>
                        <td style="text-align:center">
                            <?php echo $service['children']?>
                        </td>
                        <td style="padding-left: 5px;">
                            <?php echo $service['pax']?>
                            <br>
                            <?php echo $service['type']?>
                        </td>
                        <td style="text-align: center">
                            <?php echo $service['confcode']?>
                        </td>
                        <td style="text-align: center">
                            &nbsp;<?php echo $service['initdate']?>&nbsp;&nbsp;<?php if($service['trip_no'] == '0'){echo "";}else if($service['trip_no'] == '1'){echo "";}else{echo "Trip: ".$service['trip_no'];}?>
                            <br>
                            <?php echo $service['enddate']?>&nbsp;&nbsp;<?php if($service['trip_no2'] == '0'){echo "";}else if($service['trip_no2'] == '1'){echo "";}else{echo "Trip: ".$service['trip_no2'];}?>
                        </td>
                        <td style="text-align: right">
                            <?php echo $service['sale']?>
                            <br>
                            <?php echo $service['collect']?>&nbsp;
                        </td>
                        <td style="text-align: right">
                            <?php echo $service['total']?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </fieldset>
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
        var hilo = setInterval(function(){
            $.getJSON('<?php echo $data['rootUrl']?>admin/reinvoicing',function(data){
                if(data.reinvoicing){
                    $("#btn-remake").parent().show();
                }
            })
        },1000);
        $("#btn-remake").click(function(evt){
            evt.preventDefault();
            var id = $("#id").val();
            location.href='<?php echo $data['rootUrl']?>admin/facturacion/refacturar/'+id;
        });
    });

</script>