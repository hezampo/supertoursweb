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
<script>
   $(document).ready(function() {
	<?php  if(isset($data['opcionPago'])){
				if($data['opcionPago']>'2'){
					$cod ='CoV'.$data['opcionPago'];
				}else{
					$cod = $_REQUEST['ssl_approval_code'];	
				}
			}else{
				$cod = $_REQUEST['ssl_approval_code'];
			}
			
			if(isset($_SESSION['pagoListo'])){
				unset($_SESSION['pagoListo']);
			}else{
				?>
			$("#response_approval").load('<?php echo $data['rootUrl']; ?>tours/approval/response?ssl_approval_code=<?php echo $cod ; ?>');
			<?	
			}
	?>
     
   });
   
								
</script>				
</head>
<body>
    

<div id="container">
 <?php 
  //print_r($_POST);
   if(isset($_SESSION['user'])){
 $login = $_SESSION['user'];

   } 
  ?>   
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
 </div>
 <div id="topnav"></div>
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
    <td colspan="3"><div id="response_approval">.</div> </td>
  </tr>
   
 <tr>
    <td width="30%" height="28">&nbsp;</td>
    <td colspan="3" align="center"><strong><?
		 if($_SESSION['onedaytour'] == true){
		 	echo '1 Days Tour';
		 }else if($_SESSION['onedaytour'] == false){
		 	echo 'Multi Days Tours';
		 }
    ?></strong></td>
  </tr>
  <tr>
    <td height="46">&nbsp;</td>
    <td colspan="3" align="center"> <span class="Estilo1">Your tour package has been sent to the email , please print and present this e-ticket voucher to board the bus.<br />
        <span class="Estilo2">Please arrive at departure point 30 minutes before the scheduled time.
        <br /><br />
        Thank you for your purchase! 
        <br />
Super Tours of Orlando Inc
<br />
The best tour service in Orlando
        </span></span></td>
    </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="45%"> <span class="Estilo1">CONFIRMATION CODE:</span> <?php echo (isset($_SESSION['codconf'])?$_SESSION['codconf']:"N/A"); ?></td>
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
 
</div><!-- Google Code for Tours Vendidos Conversion Page --><script type="text/javascript">/* <![CDATA[ */var google_conversion_id = 962705794;var google_conversion_language = "en";var google_conversion_format = "2";var google_conversion_color = "ffffff";var google_conversion_label = "P1fQCI2d4FcQgvOGywM";var google_remarketing_only = false;/* ]]> */</script><script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script><noscript><div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/962705794/?label=P1fQCI2d4FcQgvOGywM&amp;guid=ON&amp;script=0"/></div></noscript>
</body>
   
</html>