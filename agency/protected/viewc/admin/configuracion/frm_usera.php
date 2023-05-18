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
<? $user_agency  = $data['user_agency'];?> 

    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/agency/users/save" method="post" name="form1">
        <div id="header_page" >
<div class="header2">agency's User [ <? echo $data['dato'];?> ]</div>
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
         <fieldset><legend><strong>AGENCY</strong></legend>
        <div class="input">
                <label style="width:150px" class="required" id="l_phone">Company Name: </label>
                <select name="id_agencia" id="id_agencia" class="select" style="width:300px;">
                  <option value="0"></option>  
                  <?php foreach($data["agencia"] as $e):?>
                  
                       <option value="<?php echo $e['id']; ?>"  <?php echo ($user_agency->id_agencia  == trim($e['id'])?'selected':''); ?>><?php echo $e["company_name"]; ?></option>
                   <?php endforeach;?>
                </select>
            </div>
       <div class="input">
                <label style="width:150px" class="required" id="firstnamee">Firstname: </label>
                <input type="text" name="firstname" id="firstname"  size="25"   value="<? echo $user_agency->firstname; ?>"/>
      </div>
            <div class="input">
                <label style="width:150px" class="required" id="lastnamee">Lastname: </label>
                <input type="text" name="lastname" id="lastname"  size="25"  value="<? echo $user_agency->lastname; ?>"/>
            </div>
          
            <div class="input">
                <label style="width:150px" class="required" id="birthdatee">BirthDate: </label>
                d/m<input name="birthdate" type="text"  id="birthdate" size="5" maxlength="20"  value="<? echo $user_agency->birthdate; ?>" />
            </div>

              
         
            
          
             <div class="input">
                <label style="width:150px" class="required" id="emaill">E-mail: </label>
                <input type="text" name="email" id="email"  size="25"  value="<? echo $user_agency->email; ?>"/>
            </div>
           <div class="input">
                <label style="width:150px" class="required" id="passwordd">Password: </label>
                <input name="password" type="password"  id="password" size="25" maxlength="25"  value="<? echo $user_agency->password; ?>" />
           </div>
            <div class="input">
                <label style="width:150px" class="required" id="password11">Confir Password: </label>
                <input name="password1" type="password"  id="password1" size="25" maxlength="25"  value="<? echo $user_agency->password; ?>" />
            </div>
           
            <div class="input">
                <label style="width:150px" class="required" id="admon">Administrador: </label>
                Yes/Not <input name="admon" type="checkbox" id="admon" <? echo ($user_agency->admon==1)?"checked=\"checked\"":""; ?> value="1"  />
            </div>
           
            
        
            <input name="id" type="hidden" id="id" value="<?  echo $user_agency->id; ?>" />
            </fieldset>
        </div>
      
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskedinput.js"></script>
<script type="text/javascript">
        
		
		  $("#birthdate").mask("99/99");
		  
		  
		
		
		 
		
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#firstname').val(), $('#firstnamee').html(), true);
        sErrMsg += validateText($('#lastname').val(), $('#lastnamee').html(), true);
		sErrMsg += validateText($('#birthdate').val(), $('#birthdatee').html(), true);
		sErrMsg += validateEmail($('#email').val(), $('#emaill').html(), true);
		sErrMsg += validateText($('#password').val(), $('#passwordd').html(), true);
	    sErrMsg += validateText($('#password1').val(), $('#password11').html(), true);
		
		 var p1 = document.getElementById("password").value;
		 var p2 = document.getElementById("password1").value;
		
		
		
		if($("#id_agencia").val() == 0)
		{
		 	
			sErrMsg += "- Company name is requerido";
		}
		if(p1 != p2){
		
		sErrMsg += "Los passwords deben de coincidir";
		
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/agency/users';
    })

</script>


