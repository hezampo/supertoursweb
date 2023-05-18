<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>

<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>  
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>


<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:355px;
	top:969px;
	width:200px;
	height:125px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:414px;
	top:970px;
	width:256px;
	height:71px;
	z-index:1;
}
-->
</style>
</head>
<body>
<div id="container">
     <?php $booking = $_SESSION['booking'];
          $login = $_SESSION['user'];
		  
                    list($mes,$dia,$anyo) = explode("-",$booking['fecha_salida']);
		            $fecha = $anyo."-".$mes."-".$dia;
					
					
 ?>   
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /> </div>
 </div>
 <div id="topnav"> Welcome ,    <?php echo $login->firstname." ".$login->lastname; ?> <a href="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/logout">Logout</a></div>
 <div id="content">
   
      <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/showproute/load" method="post" name="form1">
     <div id="center-column1">
      <table width="100%"  id="clearTable"> 
     <tr>
    <td width="79%" height="33" id="titletd"> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + <?php echo $booking['ticke'];?> </p></td>
    <td width="21%" id="titletd">Date:   <?php  echo date("M-d-Y", strtotime($booking['fecha_ini'])); ?></td>
     </tr>
  <tr>
    <td colspan="2" >
    <table id="tableorder"  width="90%">
      <tr>
        <td  width="26%" height="28"  ><strong>LEADER PASSENGER'S NAME</strong></td>
        <td width="21%">&nbsp;</td>
        <td width="21%">&nbsp;</td>
        <td width="3%">&nbsp;</td>
        <td width="2%">&nbsp;</td>
        <td width="8%">&nbsp;</td>
        <td width="8%">&nbsp;</td>
        <td width="11%">&nbsp;</td>
      </tr>
      
      <tr>
     
        <td><span id="r1">Firstname: </span>
          <input type="text" name="firstname" id="firstname" /></td>
        <td><span id="r2">Lastname:</span>
          <input type="text" name="lastname" id="lastname" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>AD : <?php echo $booking['pax'];	?></td>
        <td>CHD : <?php echo $booking['chil'];	?></td>
        <td><strong>TOTAL</strong> : <?php echo $booking['pax'] + $booking['chil'];?></td>
      </tr>
      <?php if(isset($login->tipo_client)){
	      if($login->tipo_client == 2){
	 ?> 
      <tr>
       <td><span id="r3">Phone Number: </span>
          <input type="text" name="celphone" id="celphone" /></td>
           <td><span id="r4">Email: </span>
          <input type="text" name="email" id="email" /></td>
      </tr>
      <?php }} ?>
    </table>
    
    
    <table width="90%" height="125" id="tableorder">
      <tr>
        <td  width="34%" height="35" id="titlett"  ><strong>Departure Date:</strong> <?php echo date("l", strtotime($fecha)); ?>, <?php echo date("M-d-Y", strtotime($fecha)); ?></td>
        <td  id="titlett" width="26%"><strong>TRIP # :</strong> <?php echo $booking['trip_no'];	?></td>
        <td  id="titlett" width="40%"><strong>DEPARTURE TIME :</strong> <?php echo date("g:i a",strtotime($booking['trip_departure']));	?></td>
      </tr>
      <tr>
        <td height="41"><strong>From :</strong> <?php echo $data["from_name"]; ?></td>
        <td colspan="2"><strong>Pick up Point / Extensions :</strong> <?php echo $booking['place1']." , ".$booking['hotelarea1']; ?> </td>
      </tr>
      <tr>
        <td height="39"><strong>To </strong>:<?php echo $data["to_name"]; ?></td>
        <td colspan="2"><strong>Drop Off / Extensions :</strong> <?php echo $booking['address1']." , ".$booking['hotelarea2']; ?></td>
        </tr>
    </table>
    <?php  if (isset($booking['trip_no2'])  && $booking['trip_no2'] != "N/A"){ 
                 list($mes1,$dia1,$anyo1) = explode("-",$booking['fecha_retorno']);
		            $fecha1 = $anyo1."-".$mes1."-".$dia1;
              ?>  
          <table id="tableorder" width="90%">
      <tr>
        <td id="titlett"  width="34%" height="35"  ><strong>Departure Date :</strong> <?php echo date("l", strtotime($fecha1)); ?>, <?php echo date("M-d-Y", strtotime($fecha1)); ?>   </td>
        <td id="titlett" width="26%"><strong>TRIP # :</strong> <?php echo $booking['trip_no2']; ?></td>
        <td id="titlett" width="40%"><strong>DEPARTURE TIME :</strong> <?php echo date("g:i a",strtotime($booking['trip_departure2']));	?></td>
      </tr>
      <tr>
        <td height="28"><strong>From :</strong> <?php echo $data['to_name']; ?></td>
        <td colspan="2"><strong>Pick up Point / Extensions :</strong> <?php echo $booking['place2']." , ".$booking['hotelarea3']; ?> </td>
      </tr>
      <tr>
        <td height="27"><strong>To :</strong><?php echo $data["from_name"]; ?></td>
        <td colspan="2"><strong>Drop Off / Extensions :</strong> <?php echo $booking['address2']." , ".$booking['hotelarea4']; ?></td>
        </tr>
    </table>
    <?php } ?>
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
        <td height="31" colspan="5" align="center" id="titlell"><?php echo $booking['ticke'];?> Transportation from <b><?php echo $data["from_name"]; ?> </b>to <b><?php echo $data["to_name"]; ?></b></td>
      </tr>
      <tr >
        <td width="7%" height="30"><?php echo $booking['pax'];?></td>
        <td width="17%">Adults</td>
        <td id="titlell" width="53%"><?php echo $booking['ticke'];?> <?php echo $booking['residente'];?></td>
        <td id="titlelp" width="11%">$ <?php echo $booking['precioadul'];?></td>
        <td id="titlelp" width="12%">$ <?php echo $booking['totaladul'];?></td>
      </tr>
      <tr>
        
         <?php if($booking['chil'] != 0) { ?>
        <td height="27"><?php echo $booking['chil'];?></td>
        <td>Children (3-9 Years)</td>
        <td id="titlell"><?php echo $booking['ticke'];?><?php echo $booking['residente']; ?></td>
        <td id="titlelp">$ <?php echo $booking['preciochil'];?></td>
        <td id="titlelp">$ <?php echo $booking['totalchil'];?></td>
        <?php } ?>
      </tr>
       <tr>
        <td height="27"></td>
        <td>&nbsp;</td>
        <td id="titlell"> Pick up Point /Drop Off - Extension </td>
        <td id="titlelp">$ <?php echo $booking['pricexten'];?></td>
        <td id="titlelp">$ <?php echo $booking['totalexten'];?></td>
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
        <td id="titlelr"><strong>$ <?php echo $booking['totaltotal'];?> </strong></td>
      </tr>
    </table> 
    <?php if(isset($login->tipo_client)){
	      if($login->tipo_client == 2){
	 ?> 
         <table width="860" border="0">
  <tr>
    <td colspan="2"><p> <input type="radio" name="pago" id="bus"  value="Collect">
Collect $<?php echo $booking['totaltotal'];?> </p></td>
  </tr>
  <tr>
    <td colspan="2"> <p><input type="radio" name="pago" id="oamout"  value="OtherAmount">
        Collect Other Amount
        <div id="amount" style="display: none;">$
<input name="amount2" size="20" maxlength="10" class="input-text" id="amount1" value=" <?php echo $booking['totaltotal'];?>" /> </div>
         </p></td>
  </tr>
  <tr>
    <td width="381"><p><input type="radio" name="pago" id="voucher"  value="voucher">
        Voucher / Travel Agency
  <p>  <div id="agencia" style="display: none;">Agency Name:
<input name="agencia" size="20" maxlength="50" class="input-text" id="agencia1" /><p>Other Amount $<input name="amount" size="20" maxlength="10" class="input-text" id="amount1"  value="<?php echo $booking['totaltotal'];?>"/> </p></div>

    </p></td>
    <td width="469"><label>
      <textarea name="comments" id="comments" cols="45" rows="5">Comments</textarea>
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><p><input type="radio" name="pago" id="credicard"  value="credicard">
        Credicard </p></td>
  </tr>
</table>

    

    
     
        <?php }} ?>    </td>
   
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