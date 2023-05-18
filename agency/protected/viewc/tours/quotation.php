<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
		function checkKeyCode(evt)
	{
	
	var evt = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
	if(event.keyCode==116)
	{
	evt.keyCode=0;
	return false
	}
	}
	document.onkeydown=checkKeyCode;
</script>
</script>
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

 
 
   <table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td width="14%"><img src="<?php echo $data['rootUrl']; ?>global/img/approval.png" /></td>
    <td colspan="2"> Your quotation has been successful ! </td>
    </tr>
  <tr>
    <td width="30%" height="28">&nbsp;</td>
    <td colspan="3"><div id="response_approval"></div> </td>
  </tr>
   
 <tr>
    <td width="30%" height="28">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="46">&nbsp;</td>
    <td colspan="3" align="center"> <span class="Estilo1">Your quotation has been sent to the email.<br />
        <span class="Estilo2"></span></span></td>
    </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="45%"> <span class="Estilo1">QUOTATION CODE:</span> <?php echo (isset($_SESSION['codcuot'])?$_SESSION['codcuot']:"N/A"); ?></td>
    <td width="11%">&nbsp;</td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td colspan="3" align="center"> <span class="Estilo3">THANK YOU FOR CHOOSING US<br />
      HAVE A GOOD VACATION<br />
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
   
</html>
