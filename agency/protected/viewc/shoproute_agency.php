<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>

<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>  
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<?php $disponible = $data['disponible']; $acountAgen = new Agency_Account($_SESSION['agencyAcount']);
                    ?>

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
     <?php
           
          $booking = $_SESSION['booking'];
          $login = $_SESSION['user'];
		  
                    list($mes,$dia,$anyo) = explode("-",$booking['fecha_salida']);
		            $fecha = $anyo."-".$mes."-".$dia;	
                
                          				
 ?>   
 
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /> </div>
 </div>
 <div id="topnav">
      <div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Logout</a>
     <?php } ?>
   </div>
 </div>
    <div id="content">
   
      <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/pago/agency" method="post" name="form1">
     <div id="center-column1">
      <table width="100%"  id="clearTable" cellpadding="0"> 
     <tr>
    <td width="79%" height="33" id="titletd"> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + <?php echo $booking['ticke'];?> </p></td>
    <td width="21%" id="titletd">Date:   <?php  echo date("M-d-Y", strtotime($booking['fecha_ini'])); ?></td>
     </tr>
  <tr>
    <td colspan="2" >
    <table id="tableorder"  width="90%">
      <tr>
        <td  width="21%" height="28" id="titlett" ><strong>LEddADER PASSENGER'S NAME</strong></td>
        <td width="21%" id="titlett">&nbsp;</td>
        <td width="21%" id="titlett">&nbsp;</td>
        <td width="3%" id="titlett">&nbsp;</td>
        <td width="2%" id="titlett">&nbsp;</td>
        <td width="8%" id="titlett">&nbsp;</td>
        <td width="8%" id="titlett">&nbsp;</td>
        <td width="11%" id="titlett">&nbsp;</td>
      </tr>
      <tr height="50" >
     
        <td><div style="color:red; display:inline;">*</div><span id="r1"> Firstname: </span>
          <input type="text" name="firstname" id="firstname" /> </td>
        <td><div style="color:red; display:inline;">*</div><span id="r2"> Lastname:</span>
          <input type="text" name="lastname" id="lastname" /> </td>
        <td><span id="r3">E-Mail:</span>
         <input type="text" name="email" id="email" /></td>  
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
    
    
    <table width="90%"  id="tableorder">
      <tr>
        <td  id="titlett" width="34%" height="35"  ><strong>Departure Date:</strong> <?php echo date("l", strtotime($fecha)); ?>, <?php echo date("M-d-Y", strtotime($fecha)); ?></td>
        <td  id="titlett" width="26%"><strong>TRIP # :</strong> <?php echo $booking['trip_no'];	?></td>
        <td  id="titlett" width="40%"><strong>DEPARTURE TIME :</strong> <?php echo date("g:i a",strtotime($booking['trip_departure']));	?></td>
      </tr>
      <tr>
        <td height="28"><strong>From :</strong> <?php echo $data["from_name"]; ?></td>
        <td colspan="2"><strong>Pick up Point / Extensions :</strong> <?php echo $booking['place1']." , ".$booking['hotelarea1']; ?> </td>
      </tr>
      <tr>
        <td height="27"><strong>To </strong>:<?php echo $data["to_name"]; ?></td>
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
        <td id="titlelp">&nbsp;</td>
        <td id="titlelp"><div id="fee_collect">$ 0.00<div> </td>
      </tr>
     
           
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id="titlelr" align="center" >TOTAL AMOUNT</td>
        <td id="titlelr" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id="total_amount">$ <?php echo $booking['totaltotal'];?> </strong></td>
      </tr>
      <tr id="error" style="display:none;" >
        <td  id="titlelr" align="center" colspan="5" style="backgroup-color:blue;" ><div id="msg">Error </div></td>
      </tr>
         <?php 
        if(isset($_SESSION['data_agency'])){
           Doo::loadModel("Agency");
           $dat = new Agency($_SESSION['data_agency']);
           Doo::loadModel("Agency_Account");
           $acountAgen = new Agency_Account($_SESSION['agencyAcount']);
           
           if($dat->type_rate == '0'){ 
             echo ("<tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td id=\"titlelr\" align=\"center\" >Agency Comision</td>
               <td colspan=\"2\"  id=\"titlelr\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>$ ".number_format($booking['comision_agency'], 2, '.', '')."</strong></td>
             </tr>");
			 
			 ?>
			 <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td id="titlelr" align="center" >Balance</td>
               <td colspan="2"  id="titlelr" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id="balance"><?php echo '$ '.number_format($booking['totaltotal'] - (isset($booking['comision_agency'])?$booking['comision_agency']:0), 2, '.', '');?></strong></td>
             </tr>
			 <?php 
            }else{
				 ?>
		    <tr>
			   <td>&nbsp;</td>
			   <td>&nbsp;</td>
			   <td style="padding-left: 5px;
                font-size: 12px;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CE0000;
                color: #CE0000;
                }" align="center">Other Amount</td>
			   <td style="padding-left: 5px;
                font-size: 12px;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CE0000;
                color: #CE0000;
                }" colspan="2" id="titlelr2" onclick="
                $('#otheramount').attr('disabled',false);
                 $('#otheramount').focus();
                " ><input  id="otheramount" name="otheramount" value="" disabled="disabled" style="width:100px; padding-left:3px;"/></td>
  </tr>
		    <tr>
               <td>&nbsp;</td>
               <td><label for="textarea">Comentarios:</label></td>
               <td colspan="3">
               <textarea name="comentarios" id="comentarios" cols="45" rows="5"></textarea></td>
               </tr>
			 <?php 
			}
        }?>
               
    </table>
         <br/> 
  <?php if(isset($_SESSION['data_agency'])&& isset($_SESSION['data_agency'])){ ?>
  <tr>
    <td height="33" colspan="2" id="titletd" ><strong>PAYMENT</strong></td>
  </tr>
  <td colspan="2" >
      <table width="90%" height="125" id="tableorder">
      <tr>
        <td  colspan="3" width="34%" height="20" align="center"  >
        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
         <?php if($dat->type_rate == '0'){?>
        		<table width="100%" align="center">
               
                 <tr>
                    <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION 
                    </strong> 
                    </td>
                  </tr>

                	<tr>
                      <td>&nbsp;</td>
        				<td width="2%">
                        <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio" checked="checked"></td>
                        <td width="10%">Paid Full</td>
                        <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                        <td width="10%">Paid Balance</td>
                        <td>&nbsp;</td>
                    <tr>
                   
                    <tr><td colspan="6"><hr /></td></tr>
                    
                </table>
                 <?php }?>
        	</td>
      </tr>
        <tr>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
      </tr>
      <tr>
      <td >
      <table>    
       <tr>
    <td colspan="2"></td>
    </tr>
  <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion1 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?> value="2" type="radio"></td>
    <td width="164" <?php echo ($acountAgen->opcion1 != 1)?"style=\"color:FF33FF\" ":""; ?>><? echo "Passager Credit Card"; ?></td>
  </tr>    
    <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion1 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?>  value="1" agencypago="true" type="radio"></td>
    <td width="164" <?php echo ($acountAgen->opcion1 != 1)?"style=\"color:FF33FF\" ":""; ?>>Agency Credit Card</td>
  </tr>            

   </table>        
</td>
      <td >
          <table>
              <tr>
    <td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2" id="td_otheramount"></td>
    </tr>
  <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion3 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?>  value="3" type="radio"></td>
    <td width="164"  <?php echo ($acountAgen->opcion3 != 1)?"style=\"color:FF33FF\" ":""; ?>  >Credit Card+ 4 % FEE</td>
  </tr>
  <tr>
    <td><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion4 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?> value="4" type="radio"></td>
    <td <?php echo ($acountAgen->opcion4 != 1)?"style=\"color:FF33FF\" ":""; ?> >Cash</td>
    
  </tr>
  


          </table> </td>
      <td >
      <div id="typeVoucher">
      <table>
              <tr>
    <td colspan="2"></td>
    </tr>
  <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo (($acountAgen->opcion5 != 1)&&( trim($acountAgen->opcion5) != "2")  )?"readonly=\"readonly\"  disabled=\"true\" ":""; ?> value="5" type="radio"></td>
    <td width="164" <?php echo (($acountAgen->opcion5 != 1)||($acountAgen->opcion5 != 2))?"style=\"color:FF33FF\" ":""; ?> >Credit Voucher</td>
  </tr>


          </table> 
          </div>
          </td>
      </tr>
    </table>  
    
 <?php }  ?>   

        <tr>
    <td height="56" colspan="2" align="center"> <p align="center" class="titulopago"> 
            <button  class="btn2" id="btn-continue" <?php echo (isset($_SESSION['data_agency'])?"disabled=\"true\"":""); ?> ><img src="<?php echo $data['rootUrl']; ?>global/images/paytickets.jpg" /></button>
   </td>
  </tr>  
     
      
      
      
	 
</div>  
    </form> 
     <table width="100%" border="0">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="24%"><img src="<?php echo $data['rootUrl']; ?>global/img/Visa.png"  /></td>
    <td width="72%">Millions of passengers proved our red carpet service specially created to provide peace and comfort in traveling. Our purpose is to serve you like a king. <b> Copyright &copy;  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.</b> </td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  
</table>

   <div class="clear"></div>
 </div>
 
</div>

 
  
</body>
    <div id="rr"><div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script> 
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskMoney.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">
  
 $(document).ready(function(){
     $("#angency_fee").maskMoney();
       $('input[type="radio"]').change(function(){   
		 if($(this).get(0).name=='opcion_pago'){
		  <?php $pagof = $booking['totaltotal'];  
				$pagob = $pagof - (isset($booking['comision_agency'])?$booking['comision_agency']:0); 
				$booking['4fee'] = ($booking['totaltotal']*0.04);
				?> 					
			 if($(this).val()=='5'){
				  <?php 
						if($booking['totaltotal']>$disponible && $acountAgen->opcion5 != 1){
							?>
							$('#btn-continue').attr("disabled","false");
							alert('Your available credit (<?php echo $disponible; ?>) is less than the total amount to be paid');
							$(this).attr("checked",false);
							 $("#opcion_saldo2").attr('checked',true);
							<?php
						}else{
							?>
							$('#btn-continue').removeAttr("disabled"); 
							 $("#opcion_saldo2").attr('checked',true);
							 $("#opcion_saldo2").attr('disabled',false);
							 $("#opcion_saldo1").attr('disabled',true);
							 document.getElementById('opcion_pago_saldo').value = '2';
							<?php
						}
					?>
					 actualizarAmount('<?php echo $pagob;?>');
			 }else{

					   if($(this).val()=='3'){
							if( $("#opcion_pago_saldo").val()=='2'){
								actualizarAmount('<?php echo $booking['4fee']+$pagob;?>');
							}else{
								actualizarAmount('<?php echo $booking['4fee']+$pagof;?>');
							}
					   }else{
							if($(this).val()=='1' && $(this).attr('agencypago') ){
								 actualizarAmount('<?php echo $pagob;?>');
							}else{
								 if( $("#opcion_pago_saldo").val()=='2'){
								  	actualizarAmount('<?php echo $pagob;?>');
								}else{
									 actualizarAmount('<?php echo $pagof;?>');
								}
							}         
					   }
					   $('#btn-continue').removeAttr("disabled"); 
					   $('#error').fadeOut('slow');
			 } 
			 if($(this).val()=='1'){
					 $("#opcion_saldo2").attr('checked',true);
					 $("#opcion_saldo2").attr('disabled',false);
					 $("#opcion_saldo1").attr('disabled',true);
				     document.getElementById('opcion_pago_saldo').value = '2';
			 }else if($(this).val()!='5'){
				 $("#opcion_saldo2").attr('disabled',false);
				 $("#opcion_saldo1").attr('disabled',false);
			 }
		 }else {
			var num = document.getElementsByName('opcion_pago').length
			 var typePago  = 0;
			 for(var i = 0; i<num; i++){
				 if(document.getElementsByName('opcion_pago').item(i).checked){
					 typePago = document.getElementsByName('opcion_pago').item(i).value;
				 }
			 }
			if(typePago == 0){
				if($(this).get(0).id=='opcion_saldo1'){
					actualizarAmount('<?php echo $pagof;?>');
				}else{
					actualizarAmount('<?php echo $pagob;?>');
				}
			}else if($(this).get(0).id=='opcion_saldo1'){
					document.getElementById('opcion_pago_saldo').value = '1';
					if(typePago =='3'){
						actualizarAmount('<?php echo $booking['4fee']+$pagof;?>');
					}else if(typePago =='2' || typePago =='4'){
						actualizarAmount('<?php echo $pagof;?>');
					}
			 }else  if($(this).get(0).id=='opcion_saldo2'){
				 document.getElementById('opcion_pago_saldo').value = '2';
				 if(typePago=='3'){
						actualizarAmount('<?php echo $booking['4fee']+$pagob;?>');
					}else if(typePago =='2' || typePago =='4'){
						actualizarAmount('<?php echo $pagob;?>');
					}
			 }
		 }
       });
      
     });
	 
	  function valor_other(){
	   <?php $pagof = $toursbooking['totaltotal']; ?> ;	  
	   <?php $toursbooking['4fee'] = $toursbooking['totaltotal']*0.04; ?>;
	     var num = document.getElementsByName('opcion_pago').length
	     var typePago  = 0;
		 for(var i = 0; i<num; i++){
			 if(document.getElementsByName('opcion_pago').item(i).checked){
				 typePago = document.getElementsByName('opcion_pago').item(i).value;
			 }
		 }
		 if(typePago==3){
			 actualizarAmount('<?php echo ($booking['4fee']+$pagof);?>');
		 }else{
			 actualizarAmount('<?php echo ($pagof);?>');
		 }
  }

    function actualizarAmount(amount){
		var valor = formato((parseFloat(amount)),2);
	   $('#total_amount').html('$ '+valor);
		
	     var num = document.getElementsByName('opcion_pago').length
	     var typePago  = 0;
		 for(var i = 0; i<num; i++){
			 if(document.getElementsByName('opcion_pago').item(i).checked){
				 typePago = document.getElementsByName('opcion_pago').item(i).value;
			 }
		 }
		  if(typePago==3){
			 $('#balance').html('$ '+formato('<?php echo ($booking['4fee']+$pagob);?>',2));
			  $('#fee_collect').html('$ '+formato('<?php echo ($booking['4fee']);?>',2));
		 }else{
			 $('#balance').html('$ '+formato('<?php echo ($pagob);?>',2));
			 $('#fee_collect').html('$ 0.00');
			
		 }
		
	}
	
	function formato(cnt, cents) {
			cnt = cnt.toString().replace(/\$|\u20AC|\,/g,'');
			if (isNaN(cnt))
				return 0;	
			var sgn = (cnt == (cnt = Math.abs(cnt)));
			cnt = Math.floor(cnt * 100 + 0.5);
			cvs = cnt % 100;
			cnt = Math.floor(cnt / 100).toString();
			if (cvs < 10)
			cvs = '0' + cvs;
			for (var i = 0; i < Math.floor((cnt.length - (1 + i)) / 3); i++)
				cnt = cnt.substring(0, cnt.length - (4 * i + 3)) + ',' 
                                + cnt.substring(cnt.length - (4 * i + 3));

			return (((sgn) ? '' : '-') + cnt) + ( cents ?  '.' + cvs : '');
	}
	
  
    function validarOtherAmount(){
		var msg='';
		try{
		   var campo = document.getElementById('otheramount').value;
		   if(campo != '' && campo != 0){
		   		 return msg = validateNumberPositivo(campo, 'Other Amount',true);
		   }else{
			   return msg;   
		   }
		}catch(e){
		   return msg;
		}  
	}
	
	function valorOtherAmount(){
		var msg='';
		try{
		   var campo = document.getElementById('otheramount').value;
		   if(campo != ''){
		   		msg = validateNumberPositivo(campo, 'Other Amount',true);
				if(msg == ''){
					return campo;
				}else{
					return 0;
				}
		   }else{
			   return 0;   
		   }
		}catch(e){
		   return 0;
		}  
	}
 
	$("#otheramount").blur(function(){
		 var campo = document.getElementById('otheramount').value;
		 if(campo == ""){
			 $('#otheramount').attr('disabled','disabled');
		 }else{
			 msg = validateNumberPositivo(campo, 'Other Amount',true);
			 if(msg != ""){
				 if(campo != '0'){
					 alert('Error type the other amount field. Try again');
					 $("#otheramount").focus();
				 }
			 }
		 }
	});
	
    
  
    $("#btn-continue").click(function(){
		var msg = ""; 
           var p1 = $("#firstname").val();
           var d1 = $("#lastname").val();
           var p2 = $("#email").val();
			  msg += validateText(p1,'Firstname',true);
			  msg += validateText(d1,'Lastname',true);
			  msg += validateEmail(p2,'Email', true);
      
				 
			msg += validarOtherAmount();
				  
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
       if($('input[type="radio"]:checked').attr("agencypago")){
         <?php $booking['totaltotal'] = number_format($booking['totaltotal']-(isset($booking['comision_agency'])?$booking['comision_agency']:0), 2, '.', '');
            $booking['comision_agency'] = 0;    
         ?>
       }
      if($('input[type="radio"]:checked').val()=='3'){
        <?php $booking['totaltotal'] = number_format(($booking['4fee']+$booking['totaltotal']), 2, '.', '');?>
      }
      
      $('#from1').submit(); 
      return true;
          
   });
			 
    

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>booking/';
    })
		
   
   function suplement(){
       var suplements = $("#suplements").val();
       if(parseFloat(suplements) < 0){
           suplements = 0;
       }
       var tax_c = 0;
       if($('input[type="radio"]:checked').val()=='3'){          
           tax_c = ((parseFloat(<?php echo $pagob;?>) +  parseFloat(suplements))*parseFloat(0.04));
       }
       if(!isNaN(suplements) && suplements > 0){                                                                 
          if(parseFloat(suplements) < 0){
                
            var total_n =  parseFloat(<?php echo $pagob;?>)+ parseFloat(tax_c);
          }else{
              
              var total_n = parseFloat(<?php echo $pagob;?>) + parseFloat(suplements)+ parseFloat(tax_c);
                                                                    
          }
          }else{
        
              var total_n =  parseFloat(<?php echo $pagob;?>)+ parseFloat(tax_c);

          }
              
       actualizarAmount(total_n);
   }
   

   

 
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
