<?php $signup= $data["signup"];?>
<div id="form" style="width:600px;">
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>booking/signup/save" method="post" name="form1">
        <h4 class="titleform">Informaci&oacute;n Cliente</h4>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Username / E-mail</label>
                <input type="text" name="username" id="username"  size="25" maxlength="20"  value="<?php echo $signup->username; ?>"/>
            </div>

            <div class="input">
                <label style="width:150px" class="required" id="l_equipment">Firts Name</label>
                <input type="text" name="firstname" id="firstname" size="25" maxlength="20" value="<?php echo $signup->firstname; ?>"/>
            </div>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_capacity">Last Name</label>
                <input name="lastname" type="text"  id="lastname" size="25" maxlength="20"  value="<?php echo $signup->lastname; ?>" />
            </div>
       
         <div class="input">
                <label style="width:150px" class="required" id="l_phone">Phone</label>
                <input name="phone" type="text"  id="phone" size="20" maxlength="20"  value="<?php echo $signup->phone; ?>" />
            </div>
           <div class="input">
                <label style="width:150px" class="required" id="l_celphone">Cel Phone</label>
                <input name="celphone" type="text"  id="celphone" size="20" maxlength="20"  value="<?php echo $signup->celphone; ?>" />
            </div>             
            <div class="input">
                <label style="width:150px" class="required" id="l_city">City</label>
                <input name="city" type="text"  id="city" size="25" maxlength="25"  value="<?php echo $signup->city; ?>" />
            </div> 
            <div class="input">
                <label style="width:150px" class="required" id="l_state">State</label>
                <select name="state" id="state" class="select">
                  <option value=""></option>  
                  <?php foreach($data["state"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($signup->state == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_country">Country</label>
                <select name="country" id="country" class="select">
                  <option value=""></option>  
                  <?php foreach($data["country"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($signup->country == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>
                <div class="input">
                <label style="width:150px" class="required" id="l_address">Address</label>
                <input name="address" type="text"  id="address" size="25" maxlength="25"  value="<?php echo $signup->address; ?>" />
            </div> 
          
        <div class="button-bar">
            <button class="button right" type="button" id="btn-cancel"><span class="icon-cancel16">Cancelar</span></button>
            <button class="button right" type="button" id="btn-save"><span class="icon-save16">Guardar</span></button>
            <input name="id" type="hidden" id="id" value="<? echo $signup->id; ?>" />
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#username').val(), $('#l_trip_no').html(), true);
        sErrMsg += validateText($('#firstname').val(),$('#l_equipment').html() , true);
        sErrMsg += validateText($('#lastname').val(),$('#l_capacity').html() , true);
        sErrMsg += validateText($('#phone').val(),$('#l_phone').html() , true);
      	sErrMsg += validateText($('#celphone').val(),$('#l_celphone').html() , true);
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
    
    $('#btn-save').click(function(){
        if (validateForm()){
          $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>booking/signup';
    })

</script>


