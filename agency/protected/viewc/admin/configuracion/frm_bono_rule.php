<?php $bono_rule = $data["bono_rule"]; ?>


    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/BonosRules/save" method="post" name="form1">
         <div id="header_page" >
<div class="header2">Driver [ <? echo $data['dato'];?> ]</div>
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
            <input type="hidden" id="h_tipo" value="<?php echo $bono_rule->tipo_bono; ?>"/>
            <label style="width:150px" class="required" id="l_tipo_bono">Type</label>
            <select id="tipo_bono" name="tipo_bono" class="select">
                <option value="points">Points</option>
                <option value="trips">Trips</option>
                <option value="birthday">Birthday</option>
            </select>
        </div>
        <div class="input">
            <label style="width:150px" class="required" id="l_valor">Value per Points</label>
            <input type="text" name="valor" id="valor"  size="25" maxlength="20"  value="<?php echo $bono_rule->valor; ?>"/>
        </div>
        <div class="input">
            <label style="width:150px" class="required" id="l_vencimiento">Expiration Date</label>
            <input type="text" name="vencimiento" id="vencimiento"  size="25" maxlength="20"  value="<?php echo $bono_rule->vencimiento; ?>" />
        </div>
      
            <input name="id" type="hidden" id="id" value="<? echo $bono_rule->id; ?>" />
            </fieldset>
            </div>
        </div>
    </form>

</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript">
        
        var tipo = $("#h_tipo").val();
        $("#tipo_bono option[value="+tipo+"]").attr("selected",true);    	
        
        function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#tipo_bono').val(), $('#l_tipo_bono').html(), true);
        sErrMsg += validateText($('#vencimiento').val(),$('#l_vencimiento').html() , true);
        sErrMsg += validateText($('#valor').val(),$('#l_valor').html() , true);
		  
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/BonosRules';
    })

</script>


