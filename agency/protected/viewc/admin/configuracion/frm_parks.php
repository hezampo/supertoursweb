<?php $parques = $data["parques"]; ?>

<?php if(isset($_GET['menssage'])){?>
<?php if($_GET['menssage'] == 'error'){?>
<div class="error">Error al guardar la informacion, intente nuevamente</div>
<?php }else{ ?>
<div class="success">Guardado Correctamente</div>
<?php } ?>
<?php } ?>
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/parks/save" method="post" name="form1" enctype="multipart/form-data">
       <div id="header_page" >
        <div class="header2">(Tours) Tarifa Trip [ <?php echo $data['dato']; ?> ]</div>
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

             <fieldset><legend>Informaci&oacuten general</legend>
        
            
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Name: </label>
                <input type="text" name="nombre" id="nombre"  size="25" maxlength="20"  value="<?php echo $parques->nombre; ?>"/>
            </div>

           
                <div class="input">
                  <label style="width:150px" class="required" id="l_trip_no">Categoria: </label>
                  <select name="id_grupo" id="id_grupo" class="select">
                    <option value=""></option>
                        <?php foreach ($data["grupos"] as $e){ ?>
                            <option value="<?php echo $e['id']; ?>"  <?php echo ($parques->id_grupo == trim($e['id']) ? 'selected' : ''); ?>><?php echo $e["nombre"]; ?></option>
                        <?php } ?>
                  </select>
                </div>
              <div class="input">
                <label style="width:150px" class="required" id="l_address">Description: </label>
               <textarea name="description" cols="40" rows="5" id="description"><?php echo $parques->description; ?></textarea>
            </div> 
             <div class="input">
                <label style="width:150px" class="required" id="l_address">Image </label>
              <input name="image1" type="file"  id="image1" accept="image/*"  value="<?php echo $parques->image1; ?>"/>
            </div> 
                <div class="input" style="margin-bottom: 10px;">
                    <label style="width:150px" class="required" id="imagen">Image Gallery  :</label>
                    <input type="file" name="img_gallery[]" id="img_banner" multiple/>
                    <span style="margin-left: 30px;">Reemplazar : <input type="checkbox" name="reemp_img_gallery" multiple/></span>
                </div>
                <?php if (isset($data["edit"])) { ?>
                    <div id="datagrid">
                        <table class="grid" cellspacing="1" id="grid">
                            <thead>
                                <tr>
                                    <th width="%">Imagen Gallery</th>
                                    <th width="%">Nombre</th>
                                    <th width="%">Descripci&oacuten</th>
                                    <th width="%">Orden</th>                                    
                                    <th width="%">Eliminar</th>
                                </tr>
                            </thead>
       
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($data["gallery"] as $r) {
                                    ?>
                                    <tr class="row<?php echo $i ?>">
                                        <td><img src="<?php echo $data['rootUrl']; ?>global/<?php echo $r->ruta_peque; ?>" > </td>
                                        <td><?php echo $r->nombre_original; ?></td>
                                        <td><textarea rows="4" cols="25" name="describ[<?php echo $r->id; ?>]" id="describ"><?php echo $r->descripcion; ?></textarea></td>
                                        <td><input type="text" name="ordenb[<?php echo $r->id; ?>]" id="ordenb"  size="10" maxlength="10"  value="<?php echo $r->orden; ?>"/></td> 
                                        <td><input type="checkbox" name="eliminarb[]" id="eliminarb"  value="<?php echo $r->id; ?>"/></td> 
                                    </tr>
                                    <?php
                                    $i = 1 - $i;
                                }
                                ?>
                            </tbody>


                        </table>
                    </div>
                <?php } ?>

                <input name="id" type="hidden" id="id" value="<?php echo $parques->id; ?>" />
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
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

    $('#image1').val("");
	
            $("#dialog-message").dialog({
			modal: true,
			buttons: {
				Ok: function() {
                        $(this).dialog("close");
				}
			}
		});
  
}
});
 
    function validateForm() {

        var sErrMsg = "";
        var flag = true;

       /* sErrMsg += validateText($('#username').val(), $('#l_trip_no').html(), true);*/
        
		  
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/tours/parks';
    })

</script>


