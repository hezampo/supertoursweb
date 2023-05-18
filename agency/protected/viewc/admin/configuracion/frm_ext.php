<?php $extension = $data["extension"];
?><head>

</head>

<div id="header_page" >
    <div class="header2">Extension [ <? echo $data['dato'];?> ]</div>
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

        <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/extension/save" method="post" name="form1">
            <fieldset><legend>General Information</legend>

                <div class="input">
                    <label style="width:150px" class="required" id="place_1">Place: </label>
                    <input type="text" name="place" id="place" size="25" maxlength="25" value="<?php echo $extension->place; ?>"/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="address_1">Address: </label>
                    <input type="text" name="address" id="address" size="25" maxlength="25" value="<?php echo $extension->address; ?>"/>
                </div>


                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Price: </label>
                    <input type="text" name="precio" id="precio" size="25" maxlength="25" value="<?php echo $extension->precio; ?>"/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Net Price: </label>
                    <input type="text" name="precio_neto" id="precio" size="25" maxlength="25" value="<?php echo $extension->precio_neto; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Special Price: </label>
                    <input type="text" name="precio_especial" id="precio" size="25" maxlength="25" value="<?php echo $extension->precio_especial; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Area: </label>
                    <select name="id_area" class="select" style="width:150px;" id="id_area">
                        <option value="0">Select Option</option>  
                        <?php foreach ($data["areas"] as $e) { ?>
                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == trim($extension->id_area) ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                        <?php } ?>
                    </select>
                </div>



                <input name="id" type="hidden" id="id" value="<? echo $extension->id; ?>" />
        </form>
    </div>
</div>
</div>

<div id="to"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">


    function validateForm() {

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#place').val(), $('#place_1').html(), true);
        sErrMsg += validateText($('#address').val(), $('#address_1').html(), true);
        if (document.form1.id_area.selectedIndex == 0) {

            sErrMsg += "- debe seleccionar Area \n";
        }
        if (sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function() {
        if (validateForm()) {
            $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function() {
        window.location = '<?php echo $data['rootUrl']; ?>admin/extension';
    })

</script>


