<?php $role = $data["role"];?>
<div id="header_page" >
<div class="header2">Roles [ <? echo $data['dato'];?> ]</div>
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
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/roles/save" method="post" name="form1">
         <fieldset><legend>General Information</legend>

            <div class="input">
                <label style="width:150px" class="required" id="l_role">Role</label>
                <input name="role" type="text"  id="role" size="30"  value="<? echo $role->role; ?>" class="inputText"/>
            </div>

            <div class="input">
                <label style="width:150px" class="required" id="l_descripcion">Description</label>
                <textarea name="descripcion" rows="4" cols="30" id="descripcion" class="inputText"><? echo $role->descripcion; ?></textarea>
            </div>

            <div id="datagrid">

                <table width="100%" cellspacing="1" class="grid">
                    <thead>
                        <tr>
                            <th width="186">Acces</th>
                            <th>Menu options</th>
                            <th>Find</th>
                            <th>Modify</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($data["opciones"] as $op):
                        ?>
                            <tr class="row<? echo $i ?>">
                                <td><input name="opcion[]" type="checkbox" value="<? echo $op['codigo']; ?>" <?php echo $op["codigo"] == $op["opcion"]?'checked':'' ?>/></td>
                                <td width="753"><? echo $op['menuitem']; ?></td>
                                <td width="85" align="center"><input name="consultar[]" type="checkbox" value="<? echo $op['codigo']; ?>" /></td>
                                <td width="80">&nbsp;</td>
                                <td width="90">&nbsp;</td>
                            </tr>
                        <?php
                            $i = 1 - $i;
                        endforeach;
                        ?> 
                    </tbody>
                </table>
         </div>

       
            <input name="id" type="hidden" id="id" value="<? echo $role->id; ?>" />
            </fieldset>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#role').val(), $('#l_role').html(), true);
        sErrMsg += validateText($('#descripcion').val(),$('#l_descripcion').html() , true);

        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    var validar = function(){
        $.post( 'index.php?mod=roles&cmd=validar', {
            role: $('#role').val(),
            id:$("#id").val()
        },
        function( data ) {
           if (data){
              alert('El role ' + $('#role').val() + ' ya se encuentra registrado ..')
           } else {
             submitbutton('save');
           }
        }
       );
    }

    $('#btn-save').click(function(){
        if (validateForm()){
           //validar();
           $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>admin/roles';
    })

</script>


