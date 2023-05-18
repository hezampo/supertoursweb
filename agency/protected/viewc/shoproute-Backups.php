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
     <?php $booking = $_SESSION['booking'];
          $login = $_SESSION['user'];

 ?>   
 <div id="header">
    <div id="logo"><img src="<?php echo $data['rootUrl']; ?>global/img/logo_s.png" width="316" height="119" /></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /> </div>
 </div>
 <div id="topnav"> Welcome ,    <?php echo $login->firstname." ".$login->lastname; ?> <a href="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/logout">Logout</a></div>
 <div id="content">
   <div id="left-column">
  
         <div id="booking">
  <div id="formularioH">
<form action="<?php echo $data['rootUrl']; ?>booking" method="post" name="form1"> 
<table width="263" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td height="5" colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3" class="titulos1forms">Buy Tickets</td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms">Round Trip </span> <input name="tipo_ticket" type="radio" value="roundtrip" id="rd"  <?php echo ($booking["tipo_ticket"] == trim("roundtrip")?'checked':''); ?>  /></td>
    <td width="150"><span class="niveltextoforms">One Way Trip</span> <input name="tipo_ticket" type="radio" value="oneway" id="ow" <?php echo ($booking["tipo_ticket"] == trim("oneway")?'checked':''); ?> />
      </td>
  </tr>
  <tr>
    <td colspan="2"><div align="left"><span class="niveltextoforms1"> From</span>:<br />
    </div></td>
    <td><select name="fromt" class="select" style="width:150px;" id="from">
                       <option value=""></option> 
                      <?php foreach($data["areas"] as $e):?>
                         <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim($data["from_name"])?'selected':''); ?> > <?php echo $e["nombre"]; ?> </option>
                      <?php endforeach;?>
        </select></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left"><span class="niveltextoforms1"> To:</span></div></td>
    <td> <select name="tot" class="select" id="to" style="width:150px;">
                      
                   </select></td>
  </tr>
  <tr>
    <td colspan="3" class="titulos1forms">
      
  </td>
  </tr>
  <tr>
    <td width="64"><span class="niveltextoforms">Departing <br />
      </span></td>
    <td width="19"><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20" /></td>
    <td class="titulos2forms"><input name="fecha_salida" size="10" maxlength="10" class="input-text" id="fecha_salida" value="<?php echo $booking['fecha_salida'];  ?>" /></td>
    
  </tr>
   <tr>
    <td><span class="niveltextoforms">Returning: <br />
      </span> </td>
    <td><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20" /></td>
    <td class="titulos2forms"> <div class="form-row" id="dv_fr">  <input name="fecha_retorno" size="10" maxlength="10" class="input-text" id="fecha_retorno" value="<?php echo $booking['fecha_retorno'];  ?>"/>
    </div></td>
   
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms"> Passengers <br />
    </span></td>
    <td class="titulos2forms"><input name="pax" size="4" maxlength="10" class="input-text" id="pax" value="<?php echo $booking['pax'];  ?> " /></td>
    
  </tr>
  <tr>
    <td height="66" colspan="3" align="left"><button  class="btn" id="btn-search">Search</button></td>
  </tr>
</table>
          </form>


</div>
</div>
     
    <div  align="center"> <br /><img src="<?php echo $data['rootUrl']; ?>global/img/Payments.jpg"  /><br /><br />
</div> 
 </div>
     
     <div id="center-column">
       <form name="form1" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/reserva" method="post" id="form"> 
            <input type="hidden" name="id" value=""/>
 				
</label> </form> 
                <h2>PAYMENT CONFIRMATION <?php $color = "#003366"; ?></h2>
         
              
               <table width="67%" class="table table-bordered table-striped">  
                 <thead>
                 <tr>
                     <th width="20%">From</th>
                   <th width="15%">To</th>
                   <th width="15%"><div align="center"><strong>Departur Date </strong></div></th>
                     <th width="9%"><strong>Trip</strong></th>
                     <th width="17%"><div align="center"><strong>Departur Time</strong></div></th>
                     <th width="13%"><strong>Number Pax </strong></th>
                   <th width="11%"><strong>Price</strong></th>
                 </tr>
                 </thead> 
          
                 <tr> 
                     
                    <td><?php echo $data["from_name"].($booking['extension1'] != NULL ? "<font  SIZE=2 color='".$color."'>"."+".$booking['place1']."$".$booking['address1']."</font>":''); ?></td> 
                    <td><?php echo $data['to_name']; ?></td>
                    <td><?php echo $booking['fecha_salida'];	?></td>
                    <td><?php echo $booking['trip_no'];	?></td>
                    <td><?php echo date("g:i a",strtotime($booking['trip_departure']));	?> </td>
                    <td><?php echo $booking['pax'];	?> </td>
                 
 

 
 
                    <td><?php  echo  ($login->state == "FLORIDA" ? $booking['pricer'].'':$booking['price']);   ?></td>
                   
                   
                
                
                 
                  <?php  if (isset($booking['trip_no2'])  && $booking['trip_no2'] != "N/A"){ 
                 
              ?>  
                 <tr> 
                   
                    <td><?php echo $data['to_name']; ?></td>
                    <td><?php echo $data['from_name'].($booking['extension2'] != NULL ? "<font  SIZE=2 color='".$color."'>"."+".$booking['place2']."$".$booking['address2']."</font>":''); ?></td>
                    <td><?php echo  $booking['fecha_retorno'];	?></td>
                    <td><?php echo $booking['trip_no2'];	?></td>
                    <td><?php echo date("g:i a",strtotime($booking['trip_departure2']));	?></td>
                    <td><?php echo $booking['pax2'];	?></td>

				   
		   
                    <td><?php  echo  ($login->state == "FLORIDA" ? $booking['pricer'].'':$booking['price2']);   ?></td>
                 </tr>
                		
                 <?php } ?>
                 <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td><B><font  SIZE=2 color='black'>Total</font></b></td>
                 <td><?php echo  $booking['pax'] + $booking['pax2']; ?></td>
                 <td><?php echo "<B><font  SIZE=2 color='red'>".$booking['total']."</font></b";?></td>
                 
                 </tr>
                 
              </table>
           
<br />
            <table  bordercolor="#FFFFFF" width="100%" border="1" cellpadding="3" cellspacing="0">
  <tr>
    <td width="22%" height="51" >&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="35%" rowspan="2"><table width="100%" border="0">
      <tr>
        <td colspan="2"><h2>  LEADER PASSENGER'S NAME</h2></td>
        </tr>
      <tr>
      
      <form  action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/reserva" method="post" name="pagar" id="pagar" >
      <td width="13%">Firstname
        <input type="text" name="firstname" id="text1" />        </td>
      <td width="13%">Lastname
        <input type="text" name="lastname" id="text1" /></td>
    </form>
    </table></td>
  </tr>
  <tr>
    <td height="25" id="tdnegro" >&nbsp;</td>
    <td width="6%" id="tdrosado" >&nbsp;</td>
    <td width="11%"  >&nbsp;</td>
  </tr>
       </table>

           
<p>&nbsp;</p>
             <p align="center" class="titulopago"> Payment method (Click )<br />
            <a href="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/pago" ><img src="<?php echo $data['rootUrl']; ?>global/images/1337793233_Credit_Card.png" /></a>
</p>       
       
      
      
	 
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
  

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script> 
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
<script type="text/javascript">
 
  
            if ($("#from").val() != ""){
        $("#to").load('<?php echo $data['rootUrl']; ?>load/' + $("#from").val(), function(){
        $("#to").val('<?php echo $booking["tot"] ?>');
      });   
   }       


		 $("#from").change(function(){
				var id = $("#from").val();
				if (id != "")
					$("#to").load('<?php echo $data['rootUrl']; ?>load/' + id);
			});
	
             
			  function validateForm(){
           
		 
	   
		
        var sErrMsg = "";
        var flag = true;

        
        sErrMsg += validateText($('#firstname').val(),$('#firstname1').html() , true);
    	sErrMsg += validateText($('#lastname').val(),$('#lastname1').html() , true);
			   
        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

             
			    return flag;
        }
    
			 
    $('#btn-continue').click(function(){
        if (validateForm()){
          $('#pagar').submit();
        }
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>booking/';
    })
		
   
   
   

   

 
</script>  

    
</html>