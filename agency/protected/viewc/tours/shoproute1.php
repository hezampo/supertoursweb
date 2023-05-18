<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>

<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>  
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>



</head>
<body>
<div id="container">
      
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /> </div>
    
 </div>
 <div id="topnav"> </div>
 <div id="content">
		<?php
            if (isset($_SESSION["toursbooking"])) {
                $toursbooking = $_SESSION["toursbooking"];
            }
            exit();
          ?>
   
      <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/showproute/load" method="post" name="form1">
     <div id="center-column1">
      <table width="100%"  id="clearTable"> 
     <tr>
    <td width="79%" height="33" id="titletd"> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + </p></td>
    <td width="21%" id="titletd">Date:   </td>
     </tr>
  <tr>
    <td colspan="2" >
    <table id="tableorder"  width="90%">
      <tr>
        <td height="28" colspan="2"  ><strong>LEADER PASSENGER'S NAME</strong></td>
        <td colspan="2">&nbsp;</td>
        <td width="7%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
        <td width="13%">&nbsp;</td>
      </tr>
      
      <tr>
        <td><span id="r1">Firstname: </span></td>
        <td><input type="text" name="firstname" id="firstname"/></td>
        <td width="11%"><span id="r2">Lastname: </span></td>
        <td width="16%"><input type="text" name="firstname2" id="firstname2" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>AD : </td>
        <td>CHD : </td>
        <td><strong>TOTAL</strong> : </td>
      </tr>
      <tr>
        <td width="6%"><span id="r3">E-Mail: </span>          </td>
        <td width="23%"><input type="text" name="firstname3" id="firstname3" /></td>
        <td>Re-enter E-MAIL:</td>
        <td><input type="text" name="firstname4" id="firstname4" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td><input type="text" name="firstname5" id="firstname5" /></td>
        <td>Celular:</td>
        <td><input type="text" name="firstname6" id="firstname6" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
     
        <td colspan="2">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     
    </table>
    
    
    <table width="90%" height="125" id="tableorder">
      <tr>
        <td  width="34%" height="35" id="titlett"  ><strong>Departure Date:</strong> ,</td>
        <td  id="titlett" width="26%"><strong>TRIP # :</strong> </td>
        <td  id="titlett" width="40%"><strong>DEPARTURE TIME :</strong> </td>
      </tr>
      <tr>
        <td height="41"><strong>From :</strong></td>
        <td colspan="2"><strong>Pick up Point / Extensions :</strong>  </td>
      </tr>
      <tr>
        <td height="39"><strong>To </strong>:</td>
        <td colspan="2"><strong>Drop Off / Extensions :</strong> </td>
        </tr>
    </table>
    
          <table id="tableorder" width="90%">
      <tr>
        <td id="titlett"  width="34%" height="35"  ><strong>Departure Date :</strong>    </td>
        <td id="titlett" width="26%"><strong>TRIP # :</strong> </td>
        <td id="titlett" width="40%"><strong>DEPARTURE TIME :</strong> </td>
      </tr>
      <tr>
        <td height="28"><strong>From :</strong> </td>
        <td colspan="2"><strong>Pick up Point / Extensions :</strong>  </td>
      </tr>
      <tr>
        <td height="27"><strong>To :</strong></td>
        <td colspan="2"><strong>Drop Off / Extensions :</strong> </td>
        </tr>
    </table>
   
    <br /></td>
  </tr>
  <tr>
    <td height="33" colspan="2" id="titletd" ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><table width="90%" border="0" cellpadding="3" id="tableorder">
      <tr>
        <td height="29" colspan="5" align="center"  id="titlett"><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height="31" colspan="5" align="center" id="titlell"> Transportation from <b> </b>to <b></b></td>
      </tr>
      <tr >
        <td width="7%" height="30"></td>
        <td width="17%">Adults</td>
        <td id="titlell" width="53%"></td>
        <td id="titlelp" width="11%">$ </td>
        <td id="titlelp" width="12%">$ </td>
      </tr>
      <tr>
        
       
        <td height="27"></td>
        <td>Children (3-9 Years)</td>
        <td id="titlell"></td>
        <td id="titlelp">$ </td>
        <td id="titlelp">$ </td>
        
      </tr>
       <tr>
        <td height="27"></td>
        <td>&nbsp;</td>
        <td id="titlell"> Pick up Point /Drop Off - Extension </td>
        <td id="titlelp">$ </td>
        <td id="titlelp">$ </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id="titlell">Taxes and Fees</td>
        <td id="titlelp">$ 0.00</td>
        <td id="titlelp">$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id="titlelr" align="center" colspan="2">TOTAL AMOUNT PAID</td>
        <td id="titlelr"><strong>$  </strong></td>
      </tr>
    </table> 
      </td>
   
  </tr>
  <tr>
    <td height="56" colspan="2" align="center"> <p align="center" class="titulopago"> <button  class="btn2" id="btn-continue"><img src="<?php echo $data['rootUrl']; ?>global/images/paytickets.jpg" /></button>
    
</p>       </td>
  </tr>
      </table>
      

    
      
	 
</div>  
    </form> 
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

 
  
</body>
  

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script> 
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
<script type="text/javascript">
 $(document).ready(function(){
	$("#voucher").click(function(evento){
		if ($("#voucher").attr("checked")){
			$("#agencia").css("display", "block");
			$("#amount").css("display", "none")
		}else{
			$("#agencia").css("display", "none");
		}
	});
	
	$("#oamout").click(function(evento){
		if ($("#oamout").attr("checked")){
			$("#amount").css("display", "block");
			$("#agencia").css("display", "none");
		}else{
			$("#amount").css("display", "none");
		}
	});
	
	
	
	 $("#bus").click(function(evento){
		if ($("#bus").attr("checked")){
			$("#amount").css("display", "none");
			$("#agencia").css("display", "none");
		}else{
			
		}
	});
	
	
	$("#credicard").click(function(evento){
		if ($("#credicard").attr("checked")){
			$("#amount").css("display", "none");
			$("#agencia").css("display", "none");
		}else{
			
		}
	});
});
  
 
	

  
  
  
        $("#btn-continue").click(function(){
		var msg = ""; 
           var p1 = $("#firstname").val();
           var d1 = $("#lastname").val();
           var p2 = $("#celphone").val();
           
         
				 if (!p1){
				if (p1 == "")
					msg += $('#r1').html() + "  is required\n";
				}
	  
			   if (!d1){
			   if (d1 == "")
				msg += $('#r2').html() + " is required\n";  
			  }
			  
			   if (!p2){
                  if (p2 == "")
                     msg += $('#r3').html() + " is required\n";
                    }
      
				 
			
				  
       if($('input[id=voucher]').is(':checked') == true ){
			   
			     
				if($("#agencia1").val().length < 1) {  
                     alert("Required Agency Name ");  
                       return false;
                   }
				  
				   
	 }
   if($('input[id=oamout]').is(':checked') == true ){
			   
			     
				if($("#amount1").val().length < 1) {  
                     alert("Required Order Amount ");  
                       return false;
                   }
				  
				   
	 }
      if (msg!=""){
          alert(msg);
          return false;
      }
      
      return true;
          
   });
			 
    

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>booking/';
    })
		
   
   
   

   

 
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