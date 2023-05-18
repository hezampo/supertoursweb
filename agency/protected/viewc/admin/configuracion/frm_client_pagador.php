<?php $cliente= $data["cliente"]; $frm = 0;  ?>

    
    
         <div id="header_page" >
<div class="header2">Clientes</div>
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar" id="btn-save-cliente">
                        <a   class="link-button" id="btn-save-cliente">
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
		
		
		<form id="formu1" class="form" action="<?php echo $data['rootUrl']; ?>admin/clientes/save" method="post" name="formu1">
        <div id="serpare">		
        <fieldset><legend>Informaci&oacute;n general</legend>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no"> E-mail*</label>
                <input type="text" name="username" id="username"  size="25" maxlength="50"  value="<?php echo $cliente->username; ?>"/>
            </div>
            <div class="input" style="display:none">
                <label style="width:150px" class="required" id="l_trip_no">Password*</label>
                <input type="password" name="password" id="password"  size="25" maxlength="20"  value="<?php echo $cliente->password; ?>"/>
            </div>
            <div class="input" style="display:none">
                <label style="width:150px" class="required" id="l_trip_no">Confirm password*</label>
                <input type="password" name="password" id="password2"  size="25" maxlength="20"  value="<?php echo $cliente->password; ?>"/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_firstname">Firts Name*</label>
                <input type="text" name="firstname" id="firstname" size="25" maxlength="30" value="<?php echo $cliente->firstname; ?>"/>
            </div>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_lastname">Last Name*</label>
                <input name="lastname" type="text"  id="lastname" size="25" maxlength="30"  value="<?php echo $cliente->lastname; ?>" />
            </div>
       
         <div class="input">
                <label style="width:150px" class="required" id="l_phone">Phone</label>
                <input name="phone" type="text"  id="phone" size="20" maxlength="20"  value="<?php echo $cliente->phone; ?>" />
            </div>
           <div class="input" style="display:none">
                <label style="width:150px" class="required" id="l_celphone">Cel Phone</label>
                <input name="celphone" type="text"  id="celphone" size="20" maxlength="20"  value="<?php echo $cliente->celphone; ?>" />
            </div>             
            <div class="input">
                <label style="width:150px" class="required" id="l_city">City</label>
                <input name="city" type="text"  id="city" size="25" maxlength="25"  value="<?php echo $cliente->city; ?>" />
            </div> 
            <div class="input">
                <label style="width:150px" class="required" id="l_state">State</label>
                <select name="state" id="state" class="select">
                  <option value=""></option>  
                  <?php foreach($data["state"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($cliente->state == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_country">Country</label>
                <select name="country" id="country" class="select">
                  <option value=""></option>  
                  <?php foreach($data["country"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($cliente->country == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>
                <div class="input">
                <label style="width:150px" class="required" id="l_address">Address</label>
                <input name="address" type="text"  id="address" size="25" maxlength="25"  value="<?php echo $cliente->address; ?>" />
            </div> 
          
        <input name="id" type="hidden"  id="id"  value="<?php echo $cliente->id; ?>" />
		<input name="frm" type="hidden"  id="frm" value="<?php echo $frm; ?>" />
		
        <input name="clientePagador" id="clientePagador" type="hidden"  value="1" />
        </fieldset>
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
   
     $('#btn-save-cliente').click(function(){
        if (validateForm()){			
			var dato = $("#formu1").serialize();
			var url = '<?php echo $data['rootUrl']; ?>admin/clientes/save';
			$.post(url,dato,function(response){
				alert(response);
			});
        }
    });

    $('#btn-cancel').click(function(){
		//validando desde donde se abrio el form de clientes  	
	   if($("#vista").val() == 1){
	   
			$("#mascaraP").hide("fade");
			$("#clienteN").hide("fade");
			$("#newClient").css("visibility","hidden");		
			$("#leader").val("");
		
	   }else{
	   
			window.location = '<?php echo $data['rootUrl']; ?>admin/clientes';
			
		}       
	   
    });



    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateEmail($('#username').val(), $('#l_trip_no').html(), true);
        sErrMsg += validateText($('#firstname').val(),$('#l_firstname').html() , true);
        sErrMsg += validateText($('#lastname').val(),$('#l_lastname').html() , true);
        sErrMsg += validateText($('#phone').val(),$('#l_phone').html() , true);
      	sErrMsg += validateText($('#city').val(),$('#l_city').html() , true);
		sErrMsg += validateText($('#state').val(),$('#l_state').html() , true);
		sErrMsg += validateText($('#country').val(),$('#l_country').html() , true);
		sErrMsg += validateText($('#address').val(),$('#l_address').html() , true);
				  
        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

</script>


