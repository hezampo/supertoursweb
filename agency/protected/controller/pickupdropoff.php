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
 <?php $booking = $_SESSION['booking']; 
  if(isset($_SESSION['user'])){
 $login = $_SESSION['user'];
}
 ?>   
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
 </div>
 <div id="topnav"><?php echo (isset($_SESSION['user'])? 'Welcome ,'. $login->firstname." ".$login->lastname."<a href=".$data['rootUrl']."booking/pickup-dropoff/autentication/logout>Logout</a>":''); ?></div>
 <div id="content">
    
     <div id="center-column">
      <form name="form2" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication" method="post" id="form1"> 
              <?php if (isset($data['salida']) && isset($data['pickup1'])){ 
                 $e = $data['salida'];
				list($mes,$dia,$anyo) = explode("-",$e['fecha']);
		
		
		            $fecha1 = $anyo."-".$mes."-".$dia;
				
				   $booking = array(
            "tipo_ticket"   => $booking['tipo_ticket'],
            "fromt"          => $booking['fromt'],
            "tot"            => $booking['tot'],
            "fecha_salida"  => $booking['fecha_salida'],
            "fecha_retorno" => $booking['fecha_retorno'],
            "pax"           => $booking['pax'],
			"trip_no"       => $e['trip_no'],
			"price"         => $e['price'],
			"pricer"         => $e['price2'],
			"pricechil"         => $e['price3'],
			"priceadult"         => $e['price4'],
			"trip_departure"  => $e['trip_departure'],
			"chil"         => $booking['chil'],
			"resident"     => $booking['resident'],
			"zip"          => $booking['zip']
			
        );
		 $_SESSION["booking"] = $booking;
		  $booking = $_SESSION["booking"];
		 
              ?>
                <h2>PICK � UP / DROP � OFF  + EXTENSIONS</h2>
               <div class="title"> <span id="r1"> <?php echo $e["trip_from"]; ?> To <?php echo $e["trip_to"]; ?></span></div> 
               <table width="86%" class="table table-bordered table-striped">  
                 <thead>
                 <tr>
                     <th width="14%">Trip</th>
                   <th width="23%">Departing </th>
                   <th width="9%">Departure</th>
                     <th width="25%">Arrivalddddd</th>
                   <th width="17%">PickUp</th>
                   <th width="23%">DropOff</th>
                 </tr>
                 </thead>  
                 <tr>  
                    <td><?php echo $e['trip_no']; ?></td>
                    <td><?php echo date("M-d-y", strtotime($fecha1)); ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_departure'])); ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_arrival'])); ?></td>
                    <td>
                       <select name="pickup1" id="pickup1">
                           <option value=""></option>
                           <?php 
                           foreach($data["pickup1"] as $p): ?><option value="<?php echo $p["id"]; ?>"><?php echo $p["nombre"]." - ".$p["address"]; ?></option>
                           
                           <?php endforeach; ?>
                      </select>
                        <div id="hotelarea">Indicate Hotel Name  <input name="hotelarea" id="hotelarea1" type="text" /></div>
                    </td>
                    <td>
                       <select name="dropoff1" id="dropoff1">
                           <option value=""></option>
                           <?php foreach($data["dropoff1"] as $d): ?>  
                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["nombre"]." - ".$d["address"]; ?></option>
                           <?php endforeach; ?>
                        </select>
                       <div id="hotelareaa">Indicate Hotel Name
                         <input name="hotelarea" id="hotelarea4" type="text" />
                       </div>                    </td>
                 </tr>
              </table>
             <?php } ?>
             <?php if (isset($data['retorno'])){ 
                 $e = $data['retorno'];
				 list($mes,$dia,$anyo) = explode("-",$e['fecha']);
		
		
		            $fecha = $anyo."-".$mes."-".$dia;
				 
				 $booking = array(
            "tipo_ticket"   => $booking['tipo_ticket'],
            "fromt"          => $booking['fromt'],
            "tot"            => $booking['tot'],
            "fecha_salida"  => $booking['fecha_salida'],
            "fecha_retorno" => $booking['fecha_retorno'],
            "pax"           => $booking['pax'],
			"trip_no"       => $booking['trip_no'],
			"trip_no2"       => $e['trip_no'],
			"price"         => $e['price'],
			"price2"       => $e['price'],
			"pricer"         => $e['price2'],
				"pricechil"         => $e['price3'],
				"priceadult"         => $e['price4'],
			"trip_departure2"         => $e['trip_departure'],
			"trip_departure"         => $booking['trip_departure'],
			"chil"         => $booking['chil'],
			"resident"     => $booking['resident'],
			"zip"          => $booking['zip']
        );
		 $_SESSION["booking"] = $booking;
		  $booking = $_SESSION["booking"];
		
              ?>
               <div class="title"><span id="r2"><?php echo $e["trip_from"]; ?> To <?php echo $e["trip_to"]; ?></span></div> 
               <table width="86%" class="table table-bordered table-striped">  
                 <thead>
                 <tr>
                     <th width="16%">Trip</th>
                   <th width="23%">Returning</th>
                   <th width="9%">Departure</th>
                   <th width="16%">Arrivaleddddd</th>
                   <th width="16%">PickUp</th>
                   <th width="20%">DropOff</th>
                 </tr>
                 </thead>  
                 <tr>  
                    <td height="47"><?php echo $e['trip_no']; ?></td>
                   <td><?php echo date("M-d-y", strtotime($fecha)); ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_departure'])); ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_arrival'])); ?></td>
                     <td>
                       <select name="pickup2" id="pickup2">
                           <option value=""></option>
                           <?php 
                           foreach($data["pickup2"] as $p): ?>  
                            <option value="<?php echo $p["id"]; ?>"><?php echo $p["nombre"]." - ".$p["address"]; ?></option>
                           <?php endforeach; ?>
                        </select>
                       <div id="hotelarea5">Indicate Hotel Name
                         <input name="hotelarea2" id="hotelarea6" type="text" />
                       </div></td>
                    <td>
                       <select name="dropoff2" id="dropoff2">
                           <option value=""></option>
                           <?php foreach($data["dropoff2"] as $d): ?>  
                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["nombre"]." - ".$d["address"]; ?></option>
                           <?php endforeach; ?>
                        </select>
                      <div id="hotelarea2">Indicate Hotel Name
                        <input name="hotelarea2" id="hotelarea22" type="text" />
                       </div>                    </td>
                 </tr>
              </table>
        <?php } ?>  
        <p align="center">
         <button  class="btn" id="btn-back" type="button">Back</button>   
         <button   class="btn" id="btn-continue">Continue</button>
       </p>
       
          
     
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

<script>
$(document).ready(function() {
   $("#hotelarea").css("display", "none");
    $("#hotelarea2").css("display", "none");
});

$("#pickup1").change(function(){
         
         var id = $("#pickup1").val();
         
         if(id == 327 || id == 328  || id == 329)
		 {
		 $("#hotelarea").css("display", "block");
		 } else
		 {
		 $("#hotelarea").css("display", "none");
		 }
		
		 
		 
		
		
		 
     });
	 
	 $("#dropoff1").change(function(){
         
         var id = $("#pickup1").val();
         
         if(id == 327 || id == 328  || id == 329)
		 {
		 $("#hotelarea").css("display", "block");
		 } else
		 {
		 $("#hotelarea").css("display", "none");
		 }
		
		 
		 
		
		
		 
     });
$("#dropoff2").change(function(){
         
         var id = $("#dropoff2").val();
         
         if(id == 327 || id == 328  || id == 329 )
		 {
		 $("#hotelarea2").css("display", "block");
		 
		 }
		 else
		 {
		 $("#hotelarea2").css("display", "none");
		 }
     });
	 

/*
$(document).ready(function(){
	$("#pickup1").click(function(evento){
		if ($("#pickup1").attr("checked")){
			$("#birthday1").css("display", "block");
		}else{
			$("#birthday1").css("display", "none");
		}
	});
});
*/

</script>




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
      
      
	  
	     var id1 = $("#dropoff2").val();
         var id2 = $("#pickup1").val();  
         if(id1 == 327 || id1 == 328  || id1 == 329 )
		 {
		 
            var drof = $("#hotelarea22").val();
			
		if (drof == ""){
                  msg += $('#r2').html() + " Hotel Area \n";
               }
		 
		 }
		  
		  if(id2 == 327 || id2 == 328  || id2 == 329 )
		 {
		 var pick = $("#hotelarea1").val();
			
			if (pick == ""){
                  msg += $('#r1').html() + " Hotel Area \n";
               }
		 
		 }
		 
	  
	  
	  
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
      
      if (!d2){
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
   
</html>