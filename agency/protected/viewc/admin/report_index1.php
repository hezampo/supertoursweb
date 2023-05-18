
<!--<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/swig.min.js"></script>
<!--jquery para el calendario-->

<!--<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>-->

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




<h3>Pax Services</h3>
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

                                            <input type="hidden" size="4" value="0" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
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




</div>


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

        
        
        
        
        

        var url_pax = "<? echo $data['rootUrl']; ?>admin/reporte/cargar";
        
        
        $('#print_pax').click(function(){
            if($("#id_leader").val() != 0){
                var url = url_pax + $("#id_leader").val();
                window.open(url);
            }
        });

       
              

        $('#form_entry_services_report').validate({
            errorClass: 'error_validate'
        });

       
        $('#form_cost_range_report').validate({
            errorClass: 'error_validate'
        });

       

    });
</script>

