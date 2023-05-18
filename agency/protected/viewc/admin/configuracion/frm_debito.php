
<?php $adebito = $data["adebito"];

?>
<div id="header_page" >
<div class="header2">Debit of Agency [ <? echo $data['dato'];?> ]</div>
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
      
<div id="content_page" >
        <div id="serpare">    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/agency/debit/save" method="post" name="form1"  enctype="multipart/form-data">
        <fieldset><legend>Informaci&oacuten general</legend>
        <div class="input">
                <label style="width:152px" class="required" id="l_trip_no">Agency </label>
                <select name="id_agency_account" class="select" style="width:150px; height:23px;" id="id_agencia">
                       <option value="0"></option> 
                      <?php foreach($data["agencias"] as $e):?>
                             <option value="<?php echo $e["id_agencia"]; ?>" <?php echo ($e["id_agencia"] == trim($adebito->id_agency_account)?'selected':''); ?> ><?php echo $e["company_name"]; ?></option>
                      <?php endforeach;?>
        </select>
            </div>

       
        <div class="input">        
          <label style="width:150px" id="nombre_1">Amount  </label>
          <input name="cantidad" type="text"  id="cantidad" size="10" maxlength="10" value="<?php echo $adebito->cantidad;?>" />
        </div>
       <div class="input">        
          <label style="width:150px" id="nombre_2">Pay reference  </label>
          <input name="referepago" type="text"  id="referepago" size="15" maxlength="20" value="<?php echo $adebito->referepago;?>" />
        </div>
        <div class="input">        
          <label style="width:150px" id="nombre_1">Anexo  </label>
         <input name="anexo" type="file"  id="anexo"/>
         <input name="ruta" type="hidden"  value="<? echo $adebito->anexo; ?>" />
        </div>
            <input name="id" type="hidden" id="id" value="<? echo $adebito->id; ?>" />
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
 
        sErrMsg += validateText($('#cantidad').val(), $('#nombre_1').html(), true);
		sErrMsg += validateText($('#referepago').val(), $('#nombre_2').html(), true);
		if($("#id_agencia").val() == 0){
		sErrMsg += "- Seleccione Agencia \n";
		}
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
        window.location = '<?php echo $data['rootUrl']; ?>admin/agency/debit';
    })
    

   

</script>


