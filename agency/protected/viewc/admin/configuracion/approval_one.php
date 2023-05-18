<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo2 {color: #000000}
.Estilo3 {color: #003366}
-->
</style>
</head>
<body>

<div id="container">
 <?php 
   if(isset($_SESSION['user']) && isset($_SESSION['code'])){
 $login = $data['cliente'];
    $code = $data['codeconf'];
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

 
 
   <table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td width="14%"><img src="<?php echo $data['rootUrl']; ?>global/img/approval.png" /></td>
    <td colspan="2"> Your transaction has been successful ! </td>
    </tr>
  <tr>
    <td width="30%" height="28">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="46">&nbsp;</td>
    <td colspan="3" align="center"> <span class="Estilo1">Your ticket has been sent to the email , please print and present this e-ticket to board the bus.<br />
     Remember to check your bulk mail (spam folder). <br />
        <span class="Estilo2">Please arrive at departure point 30 minutes before the scheduled time.</span></span></td>
    </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="45%"> <span class="Estilo1">CONFIRMATION CODE:</span><?php echo $data['codeconf']; ?></td>
    <td width="11%">&nbsp;</td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td colspan="3" align="center"> <span class="Estilo3">THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819</span><br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 /&nbsp;<a href="mailto:reservations@supertours.com" target="_blank">reservations@supertours.com</a></td>
    </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>






    
    
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
<?php unset($_SESSION['booking'])?>
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