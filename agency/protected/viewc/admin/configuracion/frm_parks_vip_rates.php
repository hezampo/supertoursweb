<?php $parks_vip_rate= $data["parks_vip_rate"];?>

<div id="header_page" >
    <div class="header2">(park) Rates VIP [ <? echo $data['dato'];?> ]</div>
    <div  id="toolbar">

        <div class="toolbar-list">
            <ul>

                <li class="btn-toolbar" id="btn-save">
                    <a   class="link-button" id="btn-save">
                        <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                        Save
                    </a>
                </li>

                <li class="btn-toolbar" id="btn-cancel">
                    <a  class="link-button" >
                        <span class="icon-back" title="Editar" >&nbsp;</span>
                        Cancel
                    </a>
                </li>


            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="content_page" >
    <div id="serpare">

        <fieldset><legend>General Information</legend>

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/parks-vip/save" method="post" name="form1" enctype="multipart/form-data">

                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Cantidad: </label>
                    <input type="text" name="cantidad" id="cantidad"  size="2" maxlength="2"  value="<?php echo $parks_vip_rate->cantidad; ?>"/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Valor: </label>
                    <input type="text" name="valor" id="valor"  size="10" maxlength="10"  value="<?php echo $parks_vip_rate->valor; ?>"/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="l_address"></label>
                </div>

                <input name="id" type="hidden" id="id" value="<? echo $parks_vip_rate->id; ?>" />
        </fieldset>
    </div>
</div>
</form>

</div>



<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">

    //$( "#dialog:ui-dialog" ).dialog( "destroy" );



    $('#image1').change(function() {
        var ext = $('#image1').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {

            $('#image1').val("");

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

    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        /* sErrMsg += validateText($('#username').val(), $('#l_trip_no').html(), true);*/


        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function(){
        if (validateForm()){
            $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/tours/parks-vip';
    })

</script>


