<style>
#centrar{
	margin-left: auto;
	margin-right: auto ;
        }
#voucher_code{
float: left;

}		
#peso{
float: left;

}

#diass{
width:auto;

}
		 p {  cursor:pointer; }	
</style>
<? $agency  = $data['agencomi'];?> 

    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/agency/comision/save" method="post" name="form1">
          <div id="header_page" >
<div class="header2">Agency Commissions [ <? echo $data['dato'];?> ]</div>
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
        
        
        
       
           <div class="input">
                <label style="width:150px" class="required" id="servicee">Service Name: </label>
                <input type="text" name="service" id="service"  size="30" maxlength="30"  value="<? echo $agency->service; ?>"/>
     </div>
            <div class="input">
                <label style="width:150px;" class="required" id="service_codee">Service Code: </label>
                <input type="text" <?php if($data['dato']=='edit'){
							echo 'readonly="readonly"  style="background:#E0E0E0;"';
							}?>  name="service_code" id="service_code"  size="30" maxlength="30"  value="<? echo $agency->service_code; ?>"/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="comisionn">Commission: </label>
                <input type="text" name="comision" id="comision"  size="8" maxlength="20"  value="<? echo $agency->comision; ?>"/>
            </div>
           
          
          
          
       
            <input name="id" type="hidden" id="id" value="<?  echo $agency->id; ?>" />
             </fieldset>
             </div>
        
    </form>
<div id="ajax"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskedinput.js"></script>
<script type="text/javascript">
        
	
      
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#service').val(), $('#servicee').html(), true);
        sErrMsg += validateText($('#service_code').val(), $('#service_codee').html(), true);
		sErrMsg += validateText($('#comision').val(), $('#comisionn').html(), true);
		
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/agency/comision';
    })

</script>


