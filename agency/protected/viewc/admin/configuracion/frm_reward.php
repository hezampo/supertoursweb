<?php $reward = $data["reward"]; ?>
 <div id="header_page" >
<div class="header2">Rewards [ <? echo $data['dato'];?> ]</div>
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

    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/rewards/save" method="post" name="form1">
       

        <div class="input">
            <label style="width:150px" class="required" id="l_code">Codigo</label>
            <input type="text" name="code" id="code"  size="25" maxlength="20"  value="<?php echo $reward->code; ?>"/>
        </div>
        <div class="input">
            <label style="width:150px" class="required" id="l_reward_ticket">Nombre</label>
            <input type="text" name="reward_ticket" id="reward_ticket"  size="25" maxlength="20"  value="<?php echo $reward->reward_ticket; ?>"/>
        </div>
        <div class="input">
            <label style="width:150px" class="required" id="l_points">Puntos</label>
            <input type="text" name="points" id="points"  size="25" maxlength="20"  value="<?php echo $reward->points; ?>"/>
        </div>
        <div class="input">
            <label style="width:150px" class="required" id="l_ammount_discount">Descuento</label>
            <input type="text" name="ammount_discount" id="ammount_discount" size="25" maxlength="20" value="<?php echo $reward->ammount_discount; ?>"/>
        </div>

       
            <input name="id" type="hidden" id="id" value="<? echo $reward->id; ?>" />
            </fieldset>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
        
        $("#code,#reward_ticket").change(function(e){
			$(this).val($(this).val().toUpperCase());
    	});
		
		$("#points,#ammount_discount").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    	});
		
		$("#").change(function(e){
			$(this).val($(this).val().toUpperCase());
    	});
        
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#code').val(), $('#l_code').html(), true);
        sErrMsg += validateText($('#reward_ticket').val(),$('#l_reward_ticket').html() , true);
        sErrMsg += validateText($('#points').val(),$('#l_points').html() , true);
        sErrMsg += validateText($('#ammount_discount').val(),$('#l_ammount_discount').html() , true);
		  
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/rewards';
    });
    
</script>


