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
    <div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>
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
                <h2>MY PROFILE <?php $color = "#003366"; ?></h2>
                <?php $cliente= $data["cliente"];?>
                <div id="form" style="width:600px;">
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/profile/update" method="post" name="form1">
        <h4 class="titleform">Informaci&oacute;n Cliente</h4>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Username / E-mail</label>
                <input type="text" name="username" id="username"  size="25" maxlength="20"  value="<?php echo $cliente->username; ?>" readonly  />
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Password</label>
                <input type="password" name="password" id="password"  size="25" maxlength="20"  value=""/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Confirm password</label>
                <input type="password" name="password" id="password"  size="25" maxlength="20"  value=""/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_equipment">Firts Name</label>
                <input type="text" name="firstname" id="firstname" size="25" maxlength="20" value="<?php echo $cliente->firstname; ?>"/>
            </div>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_capacity">Last Name</label>
                <input name="lastname" type="text"  id="lastname" size="25" maxlength="20"  value="<?php echo $cliente->lastname; ?>" />
            </div>
       
         <div class="input">
                <label style="width:150px" class="required" id="l_phone">Phone</label>
                <input name="phone" type="text"  id="phone" size="20" maxlength="20"  value="<?php echo $cliente->phone; ?>" />
            </div>
           <div class="input">
                <label style="width:150px" class="required" id="l_celphone">Cel Phone</label>
                <input name="celphone" type="text"  id="celphone" size="20" maxlength="20"  value="<?php echo $cliente->celphone; ?>" />
            </div>             
            <div class="input">
                <label style="width:150px" class="required" id="l_city">City</label>
                <input name="city" type="text"  id="city" size="25" maxlength="25"  value="<?php echo $cliente->city; ?>" />
            </div> 
            <div class="input">
                <label style="width:150px" class="required" id="l_state">State</label>
                <select name="state" id="state" class="select">
                  <option value=""></option>  
                  <?php foreach($data["state"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($cliente->state == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_country">Country</label>
                <select name="country" id="country" class="select">
                  <option value=""></option>  
                  <?php foreach($data["country"] as $e):?>
                  
                       <option value="<?php echo  $e['name']; ?>"  <?php echo ($cliente->country == trim($e['name'])?'selected':''); ?>><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
               
            </div>
                <div class="input">
                <label style="width:150px" class="required" id="l_address">Address</label>
                <input name="address" type="text"  id="address" size="25" maxlength="25"  value="<?php echo $cliente->address; ?>" />
            </div> 
          
       
            <button class="button right" type="button" id="btn-cancel"><span class="icon-cancel16">Cancelar</span></button>
            <button class="button right" type="button" id="btn-continuar"><span class="icon-save16">Guardar</span></button>
            <input name="id" type="hidden" id="id" value="<? echo $cliente->id; ?>" />
       
    </form>

</div>
       <br />
<p>&nbsp;</p>
             <p align="center" class="titulopago"><br />
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

        
       
             
			    return flag;
        }
    
			 
    $('#btn-continuar').click(function(){
        if (validateForm()){
          $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>booking/';
    })
		
   
   
   

   

 
</script>  

    
</html>