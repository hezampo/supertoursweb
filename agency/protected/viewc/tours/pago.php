<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
</head>
<body>

<div id="container">
 <?php 
   
  //$booking = $_SESSION['booking'];
	$booking =  $_SESSION['toursbooking'];
	if(isset($_SESSION['user'])){
    $login = $_SESSION['user'];
   }
  ?>   
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
  
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
 </div>
 <div id="topnav">
      <div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>
 </div>
 <div id="content">
   
    <div id="center-column">  

 
  <form action="https://www.myvirtualmerchant.com/VirtualMerchant/process.do" method="POST">
 
<!--
   //echo $booking ['tqp'] * $booking ['totalpax'];
  ?>-->
 
 <?php 
  $pago = $_SESSION['toursbooking']['pago_pred'];
  $pago = 1;
 
?> 
 
 <input type="hidden" name="ssl_amount"  value="<?php echo $pago; ?>">
<br/>
<input type="hidden" name="ssl_merchant_id" value="507174">
<input type="hidden" name="ssl_user_id" value="STOWEBPAGE">
<input type="hidden" name="ssl_pin" value="G3Q3W4">
<input type="hidden" name="ssl_show_form" value="true">
<input type="hidden" name="ssl_transaction_type" value="ccsale">
<input type="hidden" name="ssl_customer_code" value="0">
<input type="hidden" name="ssl_invoice_number" value="<?php echo $_SESSION['codconf']; ?>">    
<input type="hidden" name="ssl_avs_address" value="<? echo $login ->address; ?>">
<input type="hidden" name="ssl_avs_zip" value="<? echo $login->zip; ?>">
<input type="hidden" name="ssl_salestax" value="0">


<input type="hidden" name="ssl_email" value="<? echo $login->username; ?>">
<input type="hidden" name="ssl_first_name" value="<? echo $login->firstname; ?>">
<input type="hidden" name="ssl_last_name" value="<? echo $login->lastname; ?>">
<input type="hidden" name="ssl_phone" value="<? echo $login->phone; ?>">

<input type="hidden" name="ssl_state" value="<? echo $login->state; ?>">
<input type="hidden" name="ssl_description" value="Paid Tours">



<input type="hidden" name="ssl_result_format" value="HTML">

<input type="hidden" name="ssl_receipt_decl_method" value="REDG">
<input type="hidden" name="ssl_receipt_decl_get_url" value="<?php echo $data['rootUrl']; ?>tours/transaction/decline">
<input type="hidden" name="ssl_receipt_apprvl_method" value="REDG">
<input type="hidden" name="ssl_receipt_apprvl_get_url" value="<?php echo $data['rootUrl']; ?>tours/transaction/approval">

<br/>

   <table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td width="25%"><img src="<?php echo $data['rootUrl']; ?>global/img/Credit_Card.png" /></td>
    <td colspan="2"> Please complete the following information: </td>
    </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="37%" height="28">&nbsp;</td>
    <td>Card:      </td>
    <td><select name="ssl_cvv2cvc2_indicator">
      <option value="1">Visa</option>
      <option value="9">MasterCard</option>
      <option value="9">American Express</option>
     
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  
    <td height="46">&nbsp;</td>
    <td><span id="credi">Credit Card Number: </span></td>
    <td colspan="2"><input type="text" name="ssl_card_number" id="ssl_card_number"  required="required"/></td>
  </tr>
  <tr>
    <td height="52">&nbsp;</td>
    <td><span id="expir">Expiration Date (MMYY):</span></td>
    <td width="13%"><label for="select">
      <input type="text" name="ssl_exp_date" id="ssl_exp_date" size="4" required="required" />
    </label></td>
    <td width="25%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span id="cvv2">CVV2 Code: </span></td>
   
    <td><input type="text" name="ssl_cvv2cvc2"  id="ssl_cvv2cvc2" size="4" autocomplete="off" required="required" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td>Total Payment :</td>
    <td colspan="2"><?php echo '$'.($pago).' USD'; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"> <button  class="btn" id="btn-continue">Continue</button></td>
  </tr>
</table>







  </form>  
    
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

</body>

<script type="text/javascript">
    
   $("#btn-back").click(function(){
      window.location = '<?php echo $data['rootUrl']; ?>booking'; 
   });
   
   $("#btn-continue").click(function(event){

	 var total = <?php echo $pago;?>;
	   
	 var msg = ""; 
     var p1 = $("#ssl_card_number").val();
     var d1 = $("#ssl_exp_date").val();
     var p2 = $("#ssl_cvv2cvc2").val();
      
      
     
      if (!p1){
        if (p1 == "")
            msg += $('#credi').html() + " is required\n";
			
      }
     if (!d1){
       if (d1 == "")
        msg += $('#expir').html() + " is required\n";  
      }
      if (!p2){
       if (p2 == "")
        msg += $('#cvv2').html() + " is required\n";
      }
     
      
      if (msg!=""){
          alert(msg);
          return false;
      }
      
      if(total != $('input:[name=ssl_amount]').val()){
		
	   	document.location.href = '<?php echo $data['rootUrl']; ?>tours/transaction/decline';
	     return false;
		  }
	  
		  return true;
   });
   
   
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