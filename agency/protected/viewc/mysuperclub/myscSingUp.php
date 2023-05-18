<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/js/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/mysuperclub.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000
}
-->
</style>
</head>
<body class="no-js">
<script>
	var el = document.getElementsByTagName("body")[0];
	el.className = "";
</script>
<div id="container">
  <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
  </div>
  <div id="topnav"> </div>
  <div id="content">
    <div id="center-column">
      <blockquote>
        <blockquote>
          <form id="user_form" name="user_form" class="form" action="<?php echo $data['rootUrl']; ?>mysuperclub/save" method="post">
            <div id="users" >
              <table width="840" border="0">
                <tr>
                  <td width="5%" height="53"></td>
                  <td width="8%"><img src="<?php echo $data['rootUrl']; ?>global/img/new-user.jpg" alt="" /></td>
                  <td colspan="2">Register User</td>
                  <td width="1%">&nbsp;</td>
                  <td><img src="<?php echo $data['rootUrl']; ?>global/images/Address-Book.png" /></td>
                  <td>Billing address</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2" ><span class="required" id="username1" style="width:150px">Username / E-mail</span></td>
                  <td  width="24%"><input type="text" name="username" id="username" size="25" maxlength="50" value="<?php echo (isset($_SESSION["user"]["name"])? $_SESSION["user"]["name"] :''); ?>"/></td>
                  <td>&nbsp;</td>
                  <td width="11%"><span class="required" id="address1" style="width:150px">Address</span></td>
                  <td  width="42%"><span class="input">
                    <input name="address" type="text"  id="address" size="25" maxlength="25"  value="<?php echo (isset($_SESSION["user"]["address"])? $_SESSION["user"]["address"] :''); ?>" />
                    </span></td>
                </tr>
                <tr>
                  <td height="31">&nbsp;</td>
                  <td colspan="2" ><span class="required" id="password1" style="width:150px">Password</span></td>
                  <td ><span class="input">
                    <input type="password" name="password" id="password" size="25" maxlength="20" value=""/>
                    </span></td>
                  <td>&nbsp;</td>
                  <td ><span class="required" id="city1" style="width:150px">City</span></td>
                  <td><span class="input">
                    <input name="city" type="text"  id="city" size="25" maxlength="25"  value="<?php echo (isset($_SESSION["user"]["city"])? $_SESSION["user"]["city"] :''); ?>" />
                    </span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2" ><span class="input">
                    <label style="width:150px" class="required" id="password3">Confirm password</label>
                    </span></td>
                  <td ><span class="input">
                    <input type="password" name="password2" id="password2" size="25" maxlength="20" value=""/>
                    </span></td>
                  <td>&nbsp;</td>
                  <td ><span class="required" id="zip11" style="width:150px">Zip</span></td>
                  <td><span class="input">
                    <input name="zip" type="text"  id="zip" size="25" maxlength="25"  value="<?php echo (isset($_SESSION["user"]["zip"])? $_SESSION["user"]["zip"] :''); ?>" />
                    </span></td>
                </tr>
                <tr>
                  <td height="32">&nbsp;</td>
                  <td colspan="2" class="required" > First  Name</td>
                  <td ><span class="input">
                    <input type="text" name="firstname" id="firstname" size="25" maxlength="20" value="<?php echo (isset($_SESSION["user"]["fname"])? $_SESSION["user"]["fname"] :''); ?>"/>
                    </span></td>
                  <td>&nbsp;</td>
                  <td><span class="required" id="phone1" style="width:150px">Phone</span></td>
                  <td ><span class="input">
                    <input name="phone" type="text"  id="phone" size="25" maxlength="20"  value="<?php echo (isset($_SESSION["user"]["phone"])? $_SESSION["user"]["phone"] :''); ?>" />
                    </span></td>
                </tr>
                <tr>
                  <td height="26">&nbsp;</td>
                  <td colspan="2" ><span class="required" id="lastname1" style="width:150px">Last Name</span></td>
                  <td ><span class="input">
                    <input name="lastname" type="text" id="lastname" size="25" maxlength="20" value="<?php echo (isset($_SESSION["user"]["lname"])? $_SESSION["user"]["lname"] :''); ?>" />
                    </span></td>
                  <td>&nbsp;</td>
                  <td ><span class="input">
                    <label style="width:150px" class="required" id="celphone1">Cell Phone</label>
                    </span></td>
                  <td><span class="input">
                    <input name="celphone" type="text"  id="celphone" size="25" maxlength="20"  value="<?php echo (isset($_SESSION["user"]["cellphone"])? $_SESSION["user"]["cellphone"] :''); ?>" />
                    </span></td>
                </tr>
                <tr>
                  <td height="29">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td ><span class="input">
                    <label style="width:150px" class="required" id="country1">Country</label>
                    </span></td>
                  <td><span class="input">
                    <select name="country" id="country">
                      <option value=""></option>
                      <?php foreach($data["country"] as $e):?>
                      <option value="<?php echo  $e['name']; ?>"  <?php echo ($e['name'] =="UNITED STATES" ? 'selected':''); ?>><?php echo $e["name"]; ?></option>
                      <?php endforeach;?>
                    </select>
                    </span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td ><span class="input">
                    <label style="width:150px" class="required" id="state1">State</label>
                    </span></td>
                  <td ><span class="input">
                    <select name="state" id="state">
                      <option value=""></option>
                      <?php foreach($data["state"] as $e):?>
                      <option value="<?php echo  $e['name']; ?>"  <?php echo ($e['name'] == "FLORIDA" ? 'selected':''); ?>><?php echo $e["name"]; ?></option>
                      <?php endforeach;?>
                    </select>
                    </span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td height="35">&nbsp;</td>
                  <td colspan="6"><p><span>Frequent Passenger!!. Enjoy amazing discounts and free travel as a member of our SuperClub. </span></p></td>
                </tr>
                <tr>
                  <td height="41">&nbsp;</td>
                  <td colspan="5"><div id="birthday1">Date of Birthday
                      <input name="ibirthday" size="20" maxlength="10" class="input-text" id="ibirthday" readonly/>
                    </div>
                    <input type="checkbox" name="frecuente2" value="2" id="frecuente2"  />
                    I accept the terms of service and <a href="<?php echo $data['rootUrl']; ?>tickets-policy-supertours" target="_blank">privacy policy </a> of Supertours.</td>
                </tr>
                <tr>
                  <td height="46">&nbsp;</td>
                  <td colspan="6" align="center"><div class="button-bar">
                      <button  class="btn" id="btn-cancel" type="button">Back</button>
                      <button  class="btn" id="btn-register" type="button" onclick="show_checked()">Register</button>
                      <input name="id" type="hidden" id="id" value="" />
                    </div></td>
                </tr>
                <tr>
                  <td height="41">&nbsp;</td>
                </tr>
              </table>
            </div>
            <div id="users"></div>
          </form>
        </blockquote>
      </blockquote>
    </div>
    <div id="footer">
      <table width="100%" border="0">
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="24%"><img src="<?php echo $data['rootUrl']; ?>global/img/Visa.png"  /></td>
          <td width="72%">Millions of passengers proved our red carpet service specially created to provide peace and comfort in traveling. Our purpose is to serve you like a king. <b> Copyright &copy;  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.</b></td>
          <td width="1%">&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="clear"></div>
  </div>
</div>
</div>
<div id="element_id"></div>
</body>
<script>
$(document).ready(function(){
	$( "#ibirthday" ).datepicker({
    	dateFormat:'yy-mm-dd' ,changeMonth: true, changeYear: true,  yearRange: '-100:+0' 
	});
});
</script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
	$('#btn-cancel').click(function(){
   		window.location = '<?php echo $data['rootUrl']; ?>mysuperclub';
	});
	
	$("#country").change(function(){
   		var id = $("#country").val();
   		if (id != "")
     		$("#state").load(encodeURI('<?php echo $data['rootUrl']; ?>load2/' + id));
	});
	 
	$("#username").tooltip({
   		content:'Bienvenido usuario este es tu panel de control!!!',
   		fixed:true,
   		position: 'top'
	});

	$( "#ibirthday" ).datepicker({
    	dateFormat:'mm-dd-yy' ,changeMonth: true, changeYear: true,  yearRange: '-100:+0' 
	});
    
	function validateForm(){
    	var p1 = document.getElementById("password").value;
		var p2 = document.getElementById("password2").value;
    	var sErrMsg = "";
    	var flag = true;
		
    	sErrMsg += validateEmail($('#username').val(),$('#username1').html() , true);
    	sErrMsg += validateText($('#password').val(),$('#password1').html() , true);
		sErrMsg += validateText($('#password2').val(),$('#password3').html() , true);
		sErrMsg += validateText($('#city').val(),$('#city1').html() , true);
		sErrMsg += validateText($('#address').val(),$('#address1').html() , true);
		sErrMsg += validateText($('#zip').val(),$('#zip11').html() , true);
		sErrMsg += validateText($('#firstname').val(),$('#firstname1').html() , true);
		sErrMsg += validateText($('#lastname').val(),$('#lastname1').html() , true);
    	sErrMsg += validateText($('#phone').val(),$('#phone1').html() , true);
		sErrMsg += validateText($('#celphone').val(),$('#celphone1').html() , true);
		sErrMsg += validateText($('#state').val(),$('#state1').html() , true);
		sErrMsg += validateText($('#country').val(),$('#country1').html() , true);
		
    	if(sErrMsg != ""){
       		alert(sErrMsg);
       		flag = false;
    	}

     	if (p1.length < 7) {
        	alert("Su password, debe tener almenos 7 letras");
			return false;
     	}
		
		var espacios = false;
    	var cont = 0;
				 
		while (!espacios && (cont < p1.length)) {
	  		if (p1.charAt(cont) == " ")
			espacios = true;
	  		cont++;
		}
				 
		if (espacios) {
	  		alert ("La contraseña no puede contener espacios en blanco");
	  		return false;
		}
				
		if (p1 != p2) {
	  		alert("Las passwords deben de coincidir");
	  		return false;
		}

   return flag;
}
        
function show_checked() {
     if($('input[name=frecuente1]').is(':checked') == true && $('input[name=frecuente2]').is(':checked') == true){
		if($("#ibirthday").val().length < 1) {  
           alert("El cumpleaños es obligatorio");  
        }else{
			if (validateForm()){
            	$('#user_form').submit();
            }
		}			   
	 }
				  
     if($('input[name=frecuente1]').is(':checked') == false && $('input[name=frecuente2]').is(':checked') == true){
	   if (validateForm()){
          $('#user_form').submit();
       }
	 }
	
	 if($('input[name=frecuente2]').is(':checked') == false) {  
        alert("Acepte Terminos");  
     }
				   
    if($('input[name=frecuente2]').is(':checked') == true ){
    }
}
   
$('#username').tooltip();

</script>
<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
<script>
(function($){
				
				//cache nav
				var nav = $("#topNav");
				
				//add indicator and hovers to submenu parents
				nav.find("li").each(function() {
					if ($(this).find("ul").length > 0) {
						$("<span>").text("^").appendTo($(this).children(":first"));

						//show subnav on hover
						$(this).mouseenter(function() {
							$(this).find("ul").stop(true, true).slideDown();
						});
						
						//hide submenus on exit
						$(this).mouseleave(function() {
							$(this).find("ul").stop(true, true).slideUp();
						});
					}
				});
			})(jQuery);

        </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33124456-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>