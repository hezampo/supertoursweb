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
   if(isset($_SESSION['user'])){
 $login = $_SESSION['user'];
   }
  ?>   
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
<div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
 </div>
 <div id="topnav"></div>
 <div id="content">
   
    <div id="center-column">  
 <form action="https://www.myvirtualmerchant.com/VirtualMerchant/process.do" method="POST">
 
 
 <input type="hidden" name="ssl_amount" value="1.00">
<br/>
<input type="hidden" name="ssl_merchant_id" value="507174">
<input type="hidden" name="ssl_user_id" value="STOWEBPAGE">
<input type="hidden" name="ssl_pin" value="07U8OI">
<input type="hidden" name="ssl_show_form" value="false">
<input type="hidden" name="ssl_transaction_type" value="ccsale">
<input type="hidden" name="ssl_invoice_number" value="<?php echo $_SESSION['codconf']; ?>">
<input type="hidden" name="ssl_email" value="<?php echo $login->username; ?>">
 
 
   <table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td width="13%"><img src="<?php echo $data['rootUrl']; ?>global/img/Decline.png" /></td>
    <td colspan="2" id="MsjD"> Declined transaction</td>
    </tr>
  <tr>
    <td width="37%" height="28">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="46">&nbsp;</td>
    <td colspan="3" align="center"><p>Your transaction has been declined  ,        <strong>Super Tours</strong> has other types of payments ,<br />
      Please Contact Super Tours AT        reservations@supertours.com<br />
        Or Call 1-800-251-4206 </p>
<p>&nbsp;</p></td>
    </tr>
  <tr>
    <td height="52">&nbsp;</td>
    <td colspan="2"> 
      Retry the payment by credit card </td>
    <td width="25%"><button class="btn" id="btn-try" type="button">Try Again</button></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
</table>
<input type="hidden" name="ssl_avs_address" value="<?php echo $login->address; ?>">
<input type="hidden" name="ssl_avs_zip" value="<?php echo $login->zip; ?>">
<input type="hidden" name="ssl_salestax" value="0"> 

<input type="hidden" name="ssl_result_format" value="HTML">
<input type="hidden" name="ssl_receipt_decl_method" value="POST">
<input type="hidden" name="ssl_receipt_decl_post_url" value="https://www.supertours.com/supertours/transaction/decline">
<input type="hidden" name="ssl_receipt_apprvl_method" value="POST">
<input type="hidden" name="ssl_receipt_apprvl_post_url" value="https://www.supertours.com/supertours/transaction/approval">
<input type="hidden" name="ssl_receipt_link_text" value="Continue">





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
    
   $("#btn-try").click(function(){
      window.location = '<?php echo $data['rootUrl']; ?>tours/confirmation'; 
   });
   
   $("#btn-continue").click(function(){
      var msg = ""; 
     var p1 = $("#pickup1").val();
      var d1 = $("#dropoff1").val();
      var p2 = $("#pickup2").val();
      var d2 = $("#dropoff2").val();
      
      
      if (!p1){
        if (p1 == "")
            msg += $('#r1').html() + " PickUp is required\n";
      }
      if (!d1){
       if (d1 == "")
        msg += $('#r1').html() + " DropOff is required\n";  
      }
      if (!p2){
       if (p2 == "")
        msg += $('#r2').html() + " PickUp is required\n";
      }
      if (!p2){
        if (d2 == "")
          msg += $('#r2').html() + " DropOff is required\n";  
      }
      
      if (msg!=""){
          alert(msg);
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