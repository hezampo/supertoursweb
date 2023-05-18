<?php $cliente= $data["cliente"]; 
		$frm = 0;  
	 $pagador = $this->data['clientepagador'] ;
	?>

    
    
         <div id="header_page" >
<div class="header2">Customer</div>
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar" id="btn-save">
                        <a   class="link-button" id="btn-save">
                            <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                            Save
                        </a>
                    </li>

                    <li class="btn-toolbar" id="btn-cancel-cliente">
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
            <input type="hidden"  value="" name='creator'>
        <fieldset><legend>Information</legend>
       
        <?php if($pagador == 1){?>
        <div class="input">
         <label style="width:150px" class="required" id="l_trip_no"></label>
        <label for="cardholder"  title="Disable this option if the client is not the cardholder">CARDHOLDER  </label>
        <input type="checkbox" checked="checked" id="cardholder" value="1"/>
        </div>
         <div id="div_form">
        <?php }?>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_username">Username / E-mail*</label>
                <input type="text" name="username" id="username"  size="25" maxlength="40"  value="<?php echo $cliente->username; ?>"/>
            </div>
             <?php if($pagador == 0){?>

            <div class="input">
                <label style="width:150px" class="required" id="l_password">Password*</label>
                <input type="password" name="password" id="password"  size="25" maxlength="20"  value="<?php echo $cliente->password; ?>"/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_password2">Confirm password*</label>
                <input type="password" name="password" id="password2"  size="25" maxlength="20"  value="<?php echo $cliente->password; ?>"/>
            </div>
            <?php }?>
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
             <?php if($pagador == 0){?>
           <div class="input">
                <label style="width:150px" class="required" id="l_celphone">Cel Phone</label>
                <input name="celphone" type="text"  id="celphone" size="20" maxlength="20"  value="<?php echo $cliente->celphone; ?>" />
            </div>    
            <?php }?>     
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
                <label style="width:150px" class="required" id="l_state">State</label>
                <select name="state" id="state" class="select">
                  <option value=""></option>  
                  <?php foreach($data["state"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($cliente->state == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>  
            <div class="input">
                <label style="width:150px" class="required" id="l_city">City</label>
                <input name="city" type="text"  id="city" size="25" maxlength="25"  value="<?php echo $cliente->city; ?>" />
            </div> 
           
            
                <div class="input">
                <label style="width:150px" class="required" id="l_address">Address</label>
                <input name="address" type="text"  id="address" size="25" maxlength="25"  value="<?php echo $cliente->address; ?>" />
            </div> 
            <div class="input">
                <label style="width:150px" class="required" id="l_zip">Zip code</label>
                <input name="zip" type="text"  id="zip" size="25" maxlength="25"  value="<?php echo $cliente->zip; ?>" />
            </div> 
        <input name="id" type="hidden"  id="id"  value="<?php echo $cliente->id; ?>" />
		 </div>
         	<input name="frm" type="hidden"  id="frm" value="<?php echo $frm; ?>" />
         <input name="cliente_pagador" type="hidden"  id="cliente_pagador" value="<?php echo $pagador; ?>" />
        </fieldset>
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

$(document).ready(function() {

$("#frm").val($("#vista").val());


	if($("#vista").val() != 1){
		$("#frm").val('0');			
	}
    
    $('#btn-save').click(function(){
	
        if (validateForm()){
			if($("#vista").val() == 1){
				var dato = $("#formu1").serialize();
				var url = '<?php echo $data['rootUrl']; ?>admin/clientes/save';
				$.post(url, dato, function(res){
                                        console.log(res);
					var respuesta = $.parseJSON(res);
					if(respuesta.accion == 1){
						alert('Registered Customer with success');
						$('#idPagador').val(respuesta.id);	
						if($('#cardholder').val()==1){
							$('#idCliente').val(respuesta.id)
							$('#firstname1').val(respuesta.firstname);
							$('#lastname1').val(respuesta.lastname);
							$('#phone1').val(respuesta.phone);
							$('#email1').val(respuesta.username);
							$('#cliente_apto').val(respuesta.accion);
							$("#leader").val(respuesta.lastname+' '+respuesta.firstname+'-'+respuesta.phone+'-'+respuesta.username);
						}
						$("#mascaraP").hide("fade");
						$("#clienteN").hide("fade");
						$("#newClient").css("visibility","hidden");		
						$("#mascaraP").hide("fade");
						$("#clienteN").hide("fade");
						if($("#cliente_pagador").val() == 1){
							 $("#enviar_escondido").val(1);
						}
					}else{
						alert('Failed to register customers.\nVerify that no other mail client entered');
					}
				});	
			}else{
				
				$("#formu1").submit();
				
			}
        }else{
			
		}
    })

    $('#btn-cancel-cliente').click(function(){
		//validando desde donde se abrio el form de clientes  	
	   if($("#vista").val() == 1){
			$("#mascaraP").hide("fade");
			$("#clienteN").hide("fade");
			$("#newClient").css("visibility","hidden");		
	   }else{
			window.location = '<?php echo $data['rootUrl']; ?>admin/clientes';
			
		}       
	   
    })
});

		
	$("#cardholder").click(function(e) {
		$("#cardholder").attr('disabled',true);
		var idCliente = '<?php echo $cliente->id?>';
		$("#div_form").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
		if($("#cardholder").is(':checked')){
			$("#div_form").load('<?php echo $data['rootUrl']; ?>admin/clientes/pagador/cargarDatos/'+idCliente, function(){
                        });
			$("#cardholder").val(1);
		}else{
			$("#div_form").load('<?php echo $data['rootUrl']; ?>admin/clientes/pagador/cargarDatos/'+0, function(){
                        });
			$("#cardholder").val(0);
		}
		$("#cardholder").attr('disabled',false);
	});


    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#username').val(), $('#l_username').html(), true);
        sErrMsg += validateText($('#firstname').val(),$('#l_firstname').html() , true);
        sErrMsg += validateText($('#lastname').val(),$('#l_lastname').html() , true);
		 <?php if($pagador == 0){
		echo "sErrMsg += validateText($('#password').val(),$('#l_password').html() , true);";
		  }?>
        sErrMsg += validateText($('#phone').val(),$('#l_phone').html() , true);
		
		 <?php if($pagador == 0){
		echo "sErrMsg += validateText($('#celphone').val(),$('#l_celphone').html() , true);";
		  }?>
		sErrMsg += validateText($('#country').val(),$('#l_country').html() , true);
		if($('#country').val()=='UNITED STATES'){
			sErrMsg += validateText($('#state').val(),$('#l_state').html() , true);	
		}
		sErrMsg += validateText($('#city').val(),$('#l_city').html() , true);
		sErrMsg += validateText($('#address').val(),$('#l_address').html() , true);
		sErrMsg += validateText($('#zip').val(),$('#l_zip').html() , true);
		 <?php if($pagador == 0){ 
		 echo "
			if($('#password').val() != $('#password2').val()){
				alert('** Error in password **');
				flag = false;            
			}
			 ";
		 }?>
        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

</script>


