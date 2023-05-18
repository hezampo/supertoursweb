
<?php $acredito = $data["acredito"];

?>
<div id="header_page" >
<div class="header2">Credit of Agency [ <? echo $data['dato'];?> ]</div>
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
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/agency/credit/save" method="post" name="form1" onsubmit="return validateForm();" >
        <fieldset><legend>Informaci&oacuten general</legend>
        <div class="input">
                <label style="width:152px" class="required" id="l_trip_no">Agency: </label>
                <select name="id_agency_account" class="select" style="width:150px; height:23px;" id="id_agencia">
                       <option value="0">Select Agency</option> 
                      <?php foreach($data["agencias"] as $e):?>
                             <option value="<?php echo $e["id_agencia"]; ?>" <?php echo ($e["id_agencia"] == trim($acredito->id_agency_account)?'selected':''); ?> ><?php echo $e["company_name"]; ?></option>
                      <?php endforeach;?>
        </select>
            </div>

       
        <div class="input">        
          <label style="width:150px" id="nombre_1">Cantidad Voucher: </label>
          <input name="cantidad" type="text"  id="cantidad" size="10" maxlength="10" value="<?php echo $acredito->cantidad;?>" />
        </div>
       
     
            <input name="id" type="hidden" id="id" value="<? echo $acredito->id; ?>" />
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
		if($("#id_agencia").val() == "0"){
		    sErrMsg += "- Seleccione Agencia \n";
		}
 
        sErrMsg += validateText($('#cantidad').val(), $('#nombre_1').html(), true);
		
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
        window.location = '<?php echo $data['rootUrl']; ?>admin/agency/credit';
    })
    

   

</script>


