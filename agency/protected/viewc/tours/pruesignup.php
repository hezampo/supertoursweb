<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>


<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />

   <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/js/themes/base/jquery.ui.all.css">  
   <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css"> 
   

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
</style>
</head>
<body class="no-js">
<script>
			var el = document.getElementsByTagName("body")[0];
			el.className = "";
		</script>
        <noscript>
        	<!--[if IE]>
            	<link rel="stylesheet" href="css/ie.css">
            <![endif]-->
        </noscript>
<?php $signup= $data["signup"];
$pais = "UNITED STATES";
?>
<div id="container">
<?
                                if (isset($_SESSION["tourstick"])) {
                                    $tourstick = $_SESSION["tourstick"];
                                }
                                ?>

  <?php 
 
 if(isset($_SESSION['signup2'])){
  $signup2 = $_SESSION['signup2'];
  }
  ?> 
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
 </div>
  <div id="topnav"> </div>
  <div id="content">
 
     <div id="center-column">
              <blockquote>
                <blockquote>
                  <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>tours/save" method="post" name="form1">
                    <div id="users" >
  <table width="840" border="0">
    <tr>
      <td width="5%" height="53"></td>
      <td width="8%"><img src="<?php echo $data['rootUrl']; ?>global/img/new-user.jpg" alt="" /></td>
      <td width="9%" colspan="2">Register User</td>
      <td width="1%">&nbsp;</td>
      <td><img src="<?php echo $data['rootUrl']; ?>global/images/Address-Book.png" /></td>
      <td>Billing address</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" id="tdgris"><span class="required" id="username1" style="width:150px">Username / E-mail</span></td>
      <td  id="tdrojo" width="24%"><input type="text" name="username" id="username" size="25" maxlength="50" value="<?php echo $tourstick['email']; ?>"/></td>
      <td>&nbsp;</td>
      <td id="tdgris" width="7%"><span class="required" id="address1" style="width:150px">Address</span></td>
      <td id="tdrojo" width="46%"><span class="input">
        <input name="address" type="text"  id="address" size="25" maxlength="25"  value="" />
        </span></td>
    </tr>
    <tr>
      <td height="31">&nbsp;</td>
      <td colspan="2" id="tdgris"><span class="required" id="password1" style="width:150px">Password</span></td>
      <td id="tdrojo"> <span class="input">
        <input type="password" name="password" id="password" size="25" maxlength="20" value=""/>
      </span></td>
      <td>&nbsp;</td>
      <td id="tdgris"><span class="required" id="city1" style="width:150px">City</span></td>
      <td id="tdrojo"><span class="input">
        <input name="city" type="text"  id="city" size="25" maxlength="25"  value="" />
        </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" id="tdgris"><span class="input">
        <label style="width:150px" class="required" id="password3">Confirm password</label>
        </span></td>
      <td id="tdrojo"><span class="input">
        <input type="password" name="password2" id="password2" size="25" maxlength="20" value=""/>
      </span></td>
      <td>&nbsp;</td>
      <td id="tdgris"><span class="required" id="zip11" style="width:150px">Zip</span></td>
      <td id="tdrojo"><span class="input">
        <input name="zip" type="text"  id="zip" size="25" maxlength="25"  value="" />
        </span></td>
    </tr>
	
    <tr>
      <td height="32">&nbsp;</td>
      <td colspan="2" class="required" id="tdgris"> First  Name</td>
      <td id="tdrojo"><span class="input">
        <input type="text" name="firstname" id="firstname" size="25" maxlength="20" value="<?php echo $tourstick['firstname']; ?>"/>
      </span></td>
      <td>&nbsp;</td>
      <td id="tdgris"><span class="required" id="phone1" style="width:150px">Phone</span></td>
      <td id="tdrojo"><span class="input">
        <input name="phone" type="text"  id="phone" size="25" maxlength="20"  value="<?php echo $tourstick['phone']; ?>" />
        </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" id="tdgris"><span class="required" id="lastname1" style="width:150px">Last Name</span></td>
      <td id="tdrojo"><span class="input">
        <input name="lastname" type="text" id="lastname" size="25" maxlength="20" value="<?php echo $tourstick['lastname']; ?>" />
      </span></td>
      <td>&nbsp;</td>
      <td id="tdgris"><span class="input">
        <label style="width:150px" class="required" id="celphone1">Cel Phone</label>
        </span></td>
      <td id="tdrojo"><span class="input">
        <input name="celphone" type="text"  id="celphone" size="25" maxlength="20"  value="<?php echo $tourstick['cellphone']; ?>" />
        </span></td>
    </tr>
    <tr>
	
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td id="tdgris"><span class="input">
        <label style="width:150px" class="required" id="country1">Country</label>
        </span></td>
      <td id="tdrojo"><span class="input">
        <select name="country" id="country" class="select">
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
      <td id="tdgris"><span class="input">
        <label style="width:150px" class="required" id="state1">State</label>
        </span></td>
      <td id="tdrojo"><span class="input">
        <select name="state" id="state" class="select">
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
      <td colspan="6"><p> <input type="checkbox" name="frecuente1" value="0" id="frecuente"  />
          <span class="Estilo1">To register as a frequent passenger, check this option to enjoy amazing discounts and free travel as a member&nbsp;<br />
&nbsp; &nbsp; &nbsp; of our SuperClub. </span></p>     </td>
      </tr>
    <tr>
      <td height="41">&nbsp;</td>
     
    <td colspan="5"> <div id="birthday1" style="display: none;">Date of Birthday
 <input name="birthday" size="20" maxlength="10" class="input-text" id="birthday"  />
 
  </div>
      
      <input type="checkbox" name="frecuente2" value="2" id="frecuente2"  />
I accept the terms of service and <a href="<?php echo $data['rootUrl']; ?>tickets-policy-supertours" target="_blank">privacy policy </a> of Supertours.</td>
      </tr>
    <tr>
      <td height="46">&nbsp;</td>
      <td colspan="6" align="center"><div class="button-bar">
        <button  class="btn" id="btn-cancel" type="button">Back</button>
        <button  class="btn" id="btn-continue" type="button" onclick="show_checked()">Sign up</button>
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
    <div id="footer"><table width="100%" border="0">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="24%"><img src="<?php echo $data['rootUrl']; ?>global/img/Visa.png"  /></td>
    <td width="72%">Millions of passengers proved our red carpet service specially created to provide peace and comfort in traveling. Our purpose is to serve you like a king. <b> Copyright &copy;  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.</b> </td>
    <td width="1%">&nbsp;</td>
  </tr>
</table>
</div>
   <div class="clear"></div>
 </div>
 
 </div>
 
</div>
<div id="element_id"></div>
c
</body>


<script>
$(document).ready(function(){
	$("#frecuente").click(function(evento){
		if ($("#frecuente").attr("checked")){
			$("#birthday1").css("display", "block");
		}else{
			$("#birthday1").css("display", "none");
		}
	});
});


 $( "#birthday" ).datepicker({
         dateFormat:'yy-mm-dd' ,changeMonth: true, changeYear: true,  yearRange: '-100:+0' });


</script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">
           $('#btn-cancel').click(function(){
       window.location = '<? echo $data['rootUrl']; ?>';
    })
	
    $("#country").change(function(){
         
         var id = $("#country").val();
         
         if (id != "")
             $("#state").load(encodeURI('<?php echo $data['rootUrl']; ?>load2/' + id));
     });
	 
   $("#username").tooltip
    ({
        content:'Bienvenido usuario este es tu panel de control!!!',
        fixed:true,
        position: 'top'
    });

   $( "#birthday" ).datepicker({
         dateFormat:'mm-dd-yy' ,changeMonth: true, changeYear: true,  yearRange: '-100:+0' });
   
  
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
		
		
	

		 
        if(sErrMsg != "")
        {
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
				  alert ("La contrase�a no puede contener espacios en blanco");
				  return false;
				}
				
				if (p1 != p2) {
				  alert("Las passwords deben de coincidir");
				  return false;
				}
					

							
						
						   /*if(document.form1.celphone.value.search(/\d{3}\-\d{3}\-\d{4}/)==-1)
			   {
				  alert("The phone number you entered is not valid.\r\nPlease enter a phone 					                          number with the format xxx-xxx-xxxx.");
				  return false;
			   }*/
			    return flag;
    }
        
		
				
			 function show_checked() {
	          if($('input[name=frecuente1]').is(':checked') == true && $('input[name=frecuente2]').is(':checked') == true){
			   
			    
				if($("#birthday").val().length < 1) {  
                     alert("El cumplea�os es obligatorio");  
       
                   }
				   else{
				        if (validateForm()){
                    		$('#form1').submit();
                            }
				   }
				   
			      }
				  
				  if($('input[name=frecuente1]').is(':checked') == false && $('input[name=frecuente2]').is(':checked') == true){
			   
			     if (validateForm()){
                    		$('#form1').submit();
                            }
				
			      }
				  if($('input[name=frecuente2]').is(':checked') == false) {  
                     alert("Acepte Terminos");  
       
                   }
				   
			   if($('input[name=frecuente2]').is(':checked') == true ){
			   
			     
			               
			   }
              }  
	 
         /*   $('#btn-continue').click(function(){
	       
						
						if (validateForm()){
                    		$('#form1').submit();
                            }
			
		
               })
*/
   
	
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