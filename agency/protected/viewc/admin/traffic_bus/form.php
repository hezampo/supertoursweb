<?php
    $bus= $data["bus"];
    $drivers = $data['drivers'];
?>

<div id="header_page" >
    <div class="header2">Bus [
        <?
            if($bus->id == null){
                echo 'New';
            }else{
                echo $bus->name;
            }

        ?>
    ]</div>
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

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/traffic/buses/save" method="post" name="form1">


                <div class="input">
                    <label style="width:150px" class="required" for="id_short_name">Short name: </label>
                    <input type="text" name="short_name" id="id_short_name"  size="25" maxlength="5"  value="<?php echo $bus->short_name; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" for="id_name">Name: </label>
                    <input type="text" name="name" id="id_name"  size="25" maxlength="100"  value="<?php echo $bus->name; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" for="id_type_bus">Bus type: </label>
                    <input type="text" name="type_bus" id="id_type_bus"  size="25" maxlength="50"  value="<?php echo $bus->type_bus; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" for="id_capacity">Capacity: </label>
                    <input type="text" name="capacity" id="id_capacity"  size="25" maxlength="20"  value="<?php echo $bus->capacity; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" for="id_driver">Driver: </label>
                    <select name="id_driver" id="id_driver" style="width: 150px">
                        <option value="">---</option>
                        <? foreach($drivers as $driver): ?>
                            <option value="<? echo $driver->id; ?>" <? if($driver->id == $bus->id_driver){ echo "selected"; } ?>>
                                <? echo $driver->firstname.' '.$driver->lastname; ?>
                            </option>
                        <? endforeach ?>
                    </select>
                </div>


                <input name="id" type="hidden" id="id" value="<? echo $bus->id; ?>" />
        </fieldset>
    </div>
</div>
</form>

</div>


<div id="dialog-message" title="Error file">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        Se ha producido un problema durante la subida.
        Comprueba que el archivo que subes sea un JPG, GIF o PNG y vuelve a intentarlo.
    </p>
</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">

    //$( "#dialog:ui-dialog" ).dialog( "destroy" );

    $("#dialog-message").css("display", "none");

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
        var shortname = $('#id_short_name').val();
        var name = $('#id_name').val();
        var type_bus = $('#id_type_bus').val();
        var capacity = $('#id_capacity').val();
        var driver = $('#id_driver').val();

        if(shortname.length > 5){
            sErrMsg = sErrMsg.concat("shortname max characters: 5.\n")
        }

        if(shortname == ""){
            sErrMsg = sErrMsg.concat("shortname is required.\n")
        }

        if(name.length > 100){
            sErrMsg = sErrMsg.concat("name max characters: 100.\n")
        }

        if(name == ""){
            sErrMsg = sErrMsg.concat("name is required.\n")
        }

        if(type_bus.length > 50){
            sErrMsg = sErrMsg.concat("bus type max characters: 50.\n")
        }

        if(type_bus == ""){
            sErrMsg = sErrMsg.concat("bus type is required.\n")
        }

        sErrMsg = sErrMsg.concat(validateInt(capacity, 'capacity', true));
        sErrMsg = sErrMsg.concat(validateInt(driver, 'driver', true));

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
    });

    $('#btn-cancel').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/traffic/buses/index';
    });

</script>


