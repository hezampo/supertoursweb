<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/2/13
 * Time: 11:04 AM
 */
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
    <input type="hidden" value="-1" id="id_agency">
    <div id="header_page">
        <div class="header">Sales Reports</div>
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
            <legend>Invoices</legend>
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-2">Online Paid</a></li>
                </ul>
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

    <div id="mascaraP" style="display:none;"></div>
    <div id="debbug"></div>
    <div id="lightbox">
        <div class="close-modal">close <i class="fa fa-times"></i></div>
        <div class="att"></div>
    </div>
</form>
<script>

$(function(){


    $("#tabs").tabs();
    $("#table_body2").load('<?php echo $data['rootUrl']?>admin/loadpaidinvoicessu/');

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

});
</script>