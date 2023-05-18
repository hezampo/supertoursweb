<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../global/css/style.css"/>  
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>

<link href="<?php echo $data['rootUrl']; ?>global/styles-Tours.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/tooltip.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui-timepicker-addon.css"> 
<link href="<?php echo $data['rootUrl']; ?>global/css/tipTip.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">  

 
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"  language="javascript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-sliderAccess.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>



<script>
    $(document).ready(function (){
        var p = $("td:[offer=yes]");
        $(p).append('<span id="offer" ><img src="<?php echo $data['rootUrl']; ?>global/img/offer.png"  /></span>');
    });
</script>


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
 
   <div id="left-column">
   
     <div id="booking">
  <div id="formularioH">
<form action="<?php echo $data['rootUrl']; ?>questions" method="post" name="form1"> 
<table width="200" border="0" align="center" cellpadding="5" cellspacing="0

">
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
  <tr>
    <td colspan="4" class="titulos1forms"><img src="<?php echo $data['rootUrl']; ?>global/images/BUY-TICKETS - white.png"  /></td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms" id="spn" >Round Trip</span> <input name="tipo_ticket" type="radio" value="roundtrip" id="rd" <?php echo ($booking["tipo_ticket"] == trim("roundtrip")?'checked':''); ?>  /></td>
    <td colspan="2"><span class="niveltextoforms">One Way Trip</span> <input name="tipo_ticket" type="radio" value="oneway" id="ow"  <?php echo ($booking["tipo_ticket"] == trim("oneway")?'checked':''); ?> />      </td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms1"> From</span>:<br /></td>
    <td colspan="2"><select name="fromt" class="select" style="width:140px;" id="from">
                       <option value=""></option> 
                      <?php foreach($data["areas"] as $e){?>
                             <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim($data["from_name"])?'selected':''); ?> ><?php echo $e["nombre"]; ?></option>
                      <?php }?>
        </select></td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms1"> To:</span></td>
    <td colspan="2"> <select name="tot" class="select" id="to" style="width:140px;">
                       
                   </select></td>
  </tr>
  <tr>
    <td colspan="4" class="titulos1forms">  </td>
  </tr>
  <tr>
    <td width="64"><span class="niveltextoforms">Departing <br />
      </span></td>
    <td width="20"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20"  border="0"  /></a></td>
    <td colspan="2" class="titulos2forms"><input name="fecha_salida" size="15" maxlength="10" class="input-text" id="fecha_salida" readonly="readonly" value="<?php echo $booking['fecha_salida'];  ?>"/></td>
  </tr>
   <tr >
    <td height="64">
        <div id="dv_fr2"><span class="niveltextoforms">Returning: <br /> </span> </div>
    </td>
    <td><div id="dv_fr1"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20" border="0" /></a></div></td>
    <td colspan="2" class="titulos2forms"> <div class="form-row" id="dv_fr">  <input name="fecha_retorno" size="15" maxlength="10" class="input-text" id="fecha_retorno" readonly="readonly"  value="<?php echo $booking['fecha_retorno'];  ?>"/></div></td>
  </tr>
  
   <tr>
     <td colspan="4"><span class="niveltextoforms3"> Adult</span>
       <input type="number" name="pax" size="2" maxlength="5" style="width:50px" class="input-text" id="pax" value="<?php echo $booking['pax'];  ?>"  max="16" min="1" required="required"  onchange=" 
	       var a = document.getElementById('pax').value;
        	if (isNaN(a)) { 
            	 return false;
     		}else{
            	 var max = 16-a;
                 if(max<0){
                 	var valor = 16-$('#pax2').val();
                    document.getElementById('pax').value = valor;
                    $('#pax2').attr('max',valor);
                 }else{
                     $('#pax2').attr('max',max);
                     if($('#pax2').val()>max){
                        $('#pax2').attr('value',max);
                     }
                 }
            }"    /> 
       <span class="niveltextoforms3">Child<span class="titulos2forms">
       <input type="number" name="pax2"  style="width:50px" class="input-text" id="pax2" value="<?php echo $booking['chil'];  ?>" max="15" min="0" required="required" onchange="
       		var a = document.getElementById('pax2').value;
        	if (isNaN(a)) { 
            	 return false;
     		}else{
           		 var max = 16-a;
                 if(max<=0){
                 	var valor = 16-$('#pax').val();
                    document.getElementById('pax2').value = valor;
                    $('#pax2').attr('max',valor);
                 }else{
                     if($('#pax').val()>max){
                        $('#pax').attr('value',max);
                     }
                 }
            }"  />
       </span></span></td>
     </tr>
    <tr>
      <td colspan="2"><button  class="btn" id="btn-search">Search</button></td>
      <td colspan="2" class="titulos2forms">&nbsp;</td>
    </tr>
  </table>
  </form>


</div>
</div>
     
    <div  align="center"> <br /><img src="<?php echo $data['rootUrl']; ?>global/img/Payments.jpg"  /><br /><br />
</div> 
 </div>
   
     <div id="center-column">
     <?php if(isset($_SESSION['msg'])){ ?>
     
     
     <script>
	 
     alert ('El Trip Numero <?php echo $_SESSION['msg']['trip']; ?>, solo tiene capacidad disponible de <?php echo $_SESSION['msg']['disponible']; ?>');
	 
     </script>
     
    <?php } ?>
         <form name="form2" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff" method="post" id="form1"> 
         <div class="title"><?php echo $data["from_name"]." to ".$data["to_name"]." - ".$booking["fecha_salida"] ?></div> 
         <table class="table table-bordered table-striped" id="tbl1">
             <thead id="rr">
                 <tr >
                     <th width="7%">Select</th>
                     <th width="8%">Trip</th>
                     <th width="11%">Departure</th>
                     <th width="11%">Arrive</th>
                     <th width="21%"><?php echo ($booking["resident"] == '1'?'FLA. Resident Adult':'Regular Price Adult'); ?></th>
                     <th width="21%"><?php echo ($booking["resident"] == '1'?'FLA. Resident Child (3-9 Yrs)':'Regular Price Child'); ?></th>
                     <th width="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equipment&nbsp;&nbsp;&nbsp;&nbsp</th>
                     
                                     
					  
                 </tr>
             </thead>
            <?php   
               foreach($data['salida'] as $e):
               
              $booking = array(
            "tipo_ticket"   => $booking['tipo_ticket'],
            "fromt"          => $booking['fromt'],
            "tot"            => $booking['tot'],
            "fecha_salida"  => $booking['fecha_salida'],
            "fecha_retorno" => $booking['fecha_retorno'],
            "pax"           => $booking['pax'],
            "pax2"           => $booking['chil'],
			 "price"           => $e['price'],
			 "trip_departure"           => $e['trip_departure'],
			"chil"           => $booking['chil'],
			"resident"      =>  $booking["resident"],
			"zip"      =>  $booking["zip"]
             );
        
			 $_SESSION["booking"] = $booking;
			 $booking = $_SESSION['booking'];
			 
                 endforeach; 
				
               ?>
             <?php
               if (count($data['salida']) > 0){
               foreach($data['salida'] as $e): ?>
                 <tr >
                    <td><input type="radio" name="trip1"  value="<?php echo $e['id'];?>"  /></td>
                    <td><?php echo $e['trip_no']; ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_departure'])); ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_arrival'])); ?></td>
                    <td><?php echo ($booking["resident"] == '1' ? $e['price4'] : $e['price'] ); ?></td>
                    <td><?php echo ($booking["resident"] == '1' ? $e['price3'] : $e['price2'] ); ?></td>
                    <td <?php if(isset($e["oferta"])){echo 'offer="yes"'; }?>    ><?php echo $e['equipment'];   ?></td>

                </tr>
             <?php

                 endforeach;
               } else {
             ?>
              <tr>
                  <td colspan="7">No tours available</td>
              </tr>
             <?php } ?>
         </table>
         <br />
         <?php if (count($data['retorno']) > 0) { ?>
         <div class="title"><?php echo $data["to_name"]." to ".$data["from_name"]." - ".$booking["fecha_retorno"] ?>   </div>
         <table class="table table-bordered table-striped">
             <thead>
                 <tr>
                     <th width="7%">Select</th>
                     <th width="8%">Trip</th>
                     <th width="11%">Departure</th>
                     <th width="11%">Arrive</th>
                     <th width="21%"><?php echo ($booking["resident"] == '1'?'FLA. Resident Adult':'Regular Price Adult'); ?></th>
                     <th width="21%"><?php echo ($booking["resident"] == '1'?'FLA. Resident Child (3-9 Yrs)':'Regular Price Child'); ?></th>
                     <th width="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equipment &nbsp;&nbsp;&nbsp;&nbsp</th>

                 </tr>
             </thead>
             <?php foreach($data['retorno'] as $e): ?>
                 <tr>  
                    <td><input type="radio" name="trip2" value="<?php echo $e['id'];?>" /></td>
                    <td><?php echo $e['trip_no']; ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_departure'])); ?></td>
                    <td><?php echo date("g:i a",strtotime($e['trip_arrival'])); ?></td>
                    <td><?php echo ($booking["resident"] == '1' ? $e['price4'] : $e['price'] ); ?></td>
                    <td><?php echo ($booking["resident"] == '1' ? $e['price3'] : $e['price2'] ); ?></td>
                    <td <?php if(isset($e["oferta"])){ echo 'offer="yes"'; }?> ><?php echo $e['equipment']; ?></td>
                </tr>
             <?php


			 endforeach; ?>
              
             
         </table>
         <?php } ?>
       <p align="right">
         <button  class="btn" id="btn-continue">Continue</button>
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
 <div id="dialog-message" title="No seats available">
	<p>
		  Seat availability <span id="capacidad" >$</span> is less than the amount you entered passenger <span id="tiketsMess" ><?php echo $booking['pax']+$booking['chil'];?></span> 
	</p>
</div>
</body>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>    
<script type="text/javascript">
   
   $("#other").click(function() {
    $('.error').hide();
      });
   if ($("#from").val() != ""){
      $("#to").load('<?php echo $data['rootUrl']; ?>load/' + $("#from").val(), function(){
        $("#to").val('<?php echo $booking["tot"] ?>');
      });   
   }
   var variablejs = "<?php echo $booking['tipo_ticket']; ?>" ;

   $("#btn-continue").click(function(){
      n1 = $("input[name='trip1']:checked").attr('value');
      n2 = $("input[name='trip2']:checked").attr('value');
     
		if(variablejs == "roundtrip"){
		   if(n1 == null   || n2 == null ){
                     alert("must select a trip");
                       return false;
                     }
		 
		}
		
		if(variablejs == "oneway"){
		if(n1 == null ){
                     alert("must select a trip");
                       return false;
                     }
		
		}
		
      return true;
    });
	
	$($("input[type='radio']")).change(function(){
		var totalPax = <?php echo $booking['pax']+$booking['chil'];?>
	
		var dispo = Array();
		<?php foreach($data['salida'] as $e){ 
		 	echo "dispo[".$e['id']."] = ".$e['disponible'].";";
		 }?>
		 
		 <?php foreach($data['retorno'] as $e){ 
		 	echo "dispo[".$e['id']."] = ".$e['disponible'].";";
		 }?>
		 
		 var id  = $( this ).val();
		 var valor = dispo[id];
		 if(valor<totalPax){
			 $( "#capacidad" ).html(valor);
			 $( "#dialog-message" ).dialog({
				modal: true,
				buttons: {
				Ok: function() {
						$( this ).dialog( "close" );
							}
					}
			});
			$( this ).attr('checked',false);
			
		 }
    });
	
	
    $("#from").change(function(){
        var id = $("#from").val();
        if (id != "")
            $("#to").load('<?php echo $data['rootUrl']; ?>load/' + id);
    });

 $("#dialog-message").css("display", "none");
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