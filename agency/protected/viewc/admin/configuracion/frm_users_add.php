<style>
    .input-text{
        width:100%;
    }
    .input-pass{
        width:70%;
    }
    .error_message{
        color: #F00;
        margin-left:10px;
    }
</style>
<div id="header_page" >
<div class="header2">Users</div>
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar" id="btn-save">
                        <a   class="link-button">
                            <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                            Save
                        </a>
                    </li>

                    <li class="btn-toolbar" id="btn-cancel-cliente">
                        <a  class="link-button" >
                            <span class="icon-back" id="icon-back" >&nbsp;</span>
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
		
		
	<form id="formu1" class="form" action="<?php echo $data['rootUrl']; ?>admin/users/save" method="post" name="formu1">
        <div id="serpare">		
        <fieldset><legend>Information</legend>
            <table style="margin:10px auto auto 20px; width:500px; " >
                <tr><td width=20%><label for="username">Username : </label></td><td width=40%><input class="input-text" type="text" name="username" id="username"></td><td><span class="error_message" id="error_message_username"></span><input type="hidden" id="uerror" val="false"></td></tr>
                <tr><td width=20%><label for="email">Email : </label></td><td width=40%><input class="input-text" type="text" name="email" id="email"></td><td><span class="error_message" id="error_message_email"></span><input type="hidden" id="eerror" val="false"></td></tr>
                <tr><td width=20%><label for="firstname">Firstname : </label></td><td width=40%><input class="input-text" type="text" name="firstname" id="firstname"></td><td><span class="error_message" id="error_message_firstname"></span></td></tr>
                <tr><td width=20%><label for ="lastname"></label>Lastname : </td><td width=40%><input type="text" class="input-text" name="lastname" id="lastname"></td><td><span class="error_message" id="error_message_lastname"></span></td></tr>
                <tr><td width=20%><label for ="password">Password : </label></td><td width=40%><input type="password" class="input-pass" name="password" id="password"></td><td><span class="error_message" id="error_message_password"></span></td></tr>
                <tr><td><label for="roles">Role : </label></td><td>
                        <select id="roles" name="roles" class="input-pass">
                            <?php foreach($data['roles'] as $k => $v){?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['role']?></option>
                            <?php } ?>
                        </select>
                    </td></tr>
                
                <tr><td><label for="active">Active User?</label></td><td><input type="checkbox" checked id="active" name="active"></td></tr>
                <tr>
                        <td width=10%>
                            <label for ="lastname"></label>ID - Pagos : </td>
                        <td width=40%>
                            <input type="text" class="input-text" name="id_pago" id="id_pago" value="">
                        </td>
                        <td>
                            <span class="error_message" id="error_message_lastname"></span>
                        </td>
                    </tr>
                    <tr>
                        <td width=10%>
                            <label for ="lastname"></label>Usuario - Pagos : </td>
                        <td width=40%>
                            <input type="text" class="input-text" name="usuario_pago" id="usuario_pago" value="">
                        </td>
                        <td>
                            <span class="error_message" id="error_message_lastname"></span>
                        </td>
                    </tr>
                    <tr>
                        <td width=10%>
                            <label for ="lastname"></label>Pin - Pagos : </td>
                        <td width=40%>
                            <input type="text" class="input-text" name="pin_pago" id="pin_pago" value="">
                        </td>
                        <td>
                            <span class="error_message" id="error_message_lastname"></span>
                        </td>
                    </tr>
            </table>
        </fieldset>
        </div>
            <div id="results"></div>
            <div id="results-email"></div>
            <input type="hidden" val="0" id="errors">
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    $(function(){
       $("#btn-save").click(function(){
           if(validate()){
           $("#formu1").submit();
           }else{
            alert('please check the errors in the form');
           }
       });
       $("#icon-back").click(function(){
          location.href = "<?php echo $data['rootUrl']?>admin/users" 
       });
       $("#username").keyup(function(){
           console.log($("#username").val().length);
           if($("#username").val().length >= 4){
               $("#results").load('<?php echo $data['rootUrl']?>admin/users/existuser/'+$("#username").val(),function(){
                    if($("#selected").val() == "true"){
                       $("#error_message_username").html('This username is already taken');
                       $("#username").css('border-color','#F00');
                       $("#uerror").val('true');
                    }else{
                       $("#error_message_username").html('');
                       $("#username").css('border-color','rgb(8, 134, 8)');
                       $("#uerror").val('false');
                    }
               });
           }
       });
    
     $("#username").focusout(function(){
           console.log($("#username").val().length);
           if($("#username").val().length >= 4){
               $("#results").load('<?php echo $data['rootUrl']?>admin/users/existuser/'+$("#username").val(),function(){
                    if($("#selected").val() == "true"){
                       $("#error_message_username").html('This username is already taken');
                       $("#username").css('border-color','#F00');
                       $("#uerror").val('true');
                    }else{
                       $("#error_message_username").html('');
                       $("#username").css('border-color','rgb(8, 134, 8)');
                       $("#uerror").val('false');
                    }
               });
           }
       });
    
    $("#email").keyup(function(){
           console.log($("#username").val().length);
           if($("#username").val().length >= 4){
               $("#results-email").load('<?php echo $data['rootUrl']?>admin/users/existemail/'+$("#email").val(),function(){
                    if($("#selected-email").val() == "true"){
                       $("#error_message_email").html('This email is already associated to a created user');
                       $("#email").css('border-color','#F00');
                       $("#eerror").val('true');
                    }else{
                       $("#error_message_email").html('');
                       $("#email").css('border-color','rgb(8, 134, 8)');
                       $("#eerror").val('false');
                    }
               });
           }
       });
       
        $("#email").focusout(function(){
           console.log($("#username").val().length);
           if($("#username").val().length >= 4){
               $("#results-email").load('<?php echo $data['rootUrl']?>admin/users/existemail/'+$("#email").val(),function(){
                    if($("#selected-email").val() == "true"){
                       $("#error_message_email").html('This email is already associated to a created user');
                       $("#email").css('border-color','#F00');
                       $("#eerror").val('true');
                    }else{
                       $("#error_message_email").html('');
                       $("#email").css('border-color','rgb(8, 134, 8)');
                       $("#eerror").val('false');
                    }
               });
           }
       });
       
    });
    
    
    function validate(){
        if($("#uerror").val() == "true"){
            return false;
        }
        if($("#eerror").val() == "true"){
            return false;
        }
        if( $("#username").val()== ""){
            $("#error_message_username").html('please insert a valid username');
            $("#username").css('border-color','#F00');
            return false;
        }
        if( $("#username").val().length < 4){
            $("#error_message_username").html('Username is too short');
            $("#username").css('border-color','#F00');
            return false;
        }else{
            $("#error_message_username").html('');
            $("#username").css('border-color','rgb(8, 134, 8)');
        }
        
        if(!validateEmail($("#email").val())){
            $("#error_message_email").html('Please insert a valid email');
            $("#email").css('border-color','#F00');
            return false;
        }else{
            $("#error_message_email").html('');
            $("#email").css('border-color','rgb(8, 134, 8)');
        }
        
        if($("#firstname").val() == ""){
            $("#error_message_firstname").html('Please insert a valid First name');
            $("#firstname").css('border-color','#F00');
            return false;
        }else{
            $("#error_message_firstname").html('');
            $("#firstname").css('border-color','rgb(8, 134, 8)');
        }
        
        if($("#lastanme").val() == ""){
            $("#error_message_lastname").html('Please insert a valid Last name');
            $("#lastname").css('border-color','#F00');
            return false;
        }else{
            $("#error_message_lastname").html('');
            $("#lastname").css('border-color','rgb(8, 134, 8)');
        }
        
        if($("#password").val() == ""){
            $("#error_message_password").html('Please insert a valid password');
            $("#password").css('border-color','#F00');
            return false;
        }else{
            $("#error_message_password").html('');
            $("#password").css('border-color','rgb(8, 134, 8)');
        }
        
        if($("#password").val().length < 5){
            $("#error_message_password").html('Password is too short');
            $("#password").css('border-color','#F00');
            return false;
        }else{
            $("#error_message_password").html('');
            $("#password").css('border-color','rgb(8, 134, 8)');
        }
        return true;
    }
    
    function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
</script>


