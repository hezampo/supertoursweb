
<?php $areas = $data["areas"];

?>
<div id="header_page" >
<div class="header2">Area [ <? echo $data['dato'];?> ]</div>
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
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/areas/save" method="post" name="form1" >
        <fieldset><legend>Informaci&oacuten general</legend>
        <div class="input">        
          <label style="width:150px" id="nombre_1">Name Area: </label>
          <input name="nombre" type="text"  id="nombre" size="25" maxlength="25" value="<?php echo $areas->nombre;?>" />
        </div>
     
            <input name="id" type="hidden" id="id" value="<? echo $areas->id; ?>" />
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
 
        sErrMsg += validateText($('#nombre').val(), $('#nombre_1').html(), true);
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
        window.location = '<?php echo $data['rootUrl']; ?>admin/areas';
    })
    

   

</script>


