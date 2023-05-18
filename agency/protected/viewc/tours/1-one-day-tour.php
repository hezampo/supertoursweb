<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/styles-Tours.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/tooltip.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui-timepicker-addon.css"> 
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/css/tipTip.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">  
<link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/menu.css" rel="stylesheet" type="text/css" />  
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice.css"/>  
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"  language="javascript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ddslick.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
<script type="text/javascript">


$(document).ready(function() {		
	
	 $('#nav li').hover(
        function () {
            //show its submenu
            $('ul', this).slideDown(100);
        },
        function () {
            //hide its submenu
            $('ul', this).slideUp(100);        
        }
    );
	
	
});
 



</script>

<style>
  .notFilled{
    border: 2px solid #f00;
    background: #f99;
    
  }
   input.error 
        {
            border: solid 1px red;  
            color: Red;    
        }
	.nodisponible{
	   color:#F00;
	   font-style:oblique;
	   text-decoration: underline; 
	}
     
</style>

 	
   

</head>

<body class="no-js">
<script>

<?php if(isset($_SESSION['ErrorOnedayTour']) && $_SESSION['ErrorOnedayTour'] != ''){
			?>
				alert('<?php echo $_SESSION['ErrorOnedayTour'];?>');
			<?php
				unset($_SESSION['ErrorOnedayTour']);
			}?>
			var el = document.getElementsByTagName("body")[0];
			el.className = "";
		</script>
        <noscript>
        	<!--[if IE]>
            	<link rel="stylesheet" href="css/ie.css">
            <![endif]-->
        </noscript>
<div id="contenedor">
<div id="header">
<div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>

<div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>

<div id="redes">
   
  <div id="iconos"  >

<div id="redesGo"></div><div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div><div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div></div>
<div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
From 4 am To Midnight - (Eastern Time) <br />
<strong>Hablamos Español</strong></div> </div>
</div>
<div id="barra">
<?php
	include_once('global/menu/menu1.php');?>
    </div>

 <form action="<?php echo $data['rootUrl']; ?>tours/5" id="form" method="post" >
<div id="policy"> 

<div id="contendinfo">
<div id="mapmarcohome">
<!--div id="separadorTInter"></div-->
<div id="contenidohometours"><br />
<?php $mañana = date('d-m-Y', strtotime( '+1 day' , strtotime ( date('d-m-Y') ) ));?>
<div><table width="100%" border="0" id="">
  <tr align="right">
    
    <td>
    <table width="100%"><tr>   
    <td></td>
    <td width="10%" height="61"><img src="<?php echo $data['rootUrl']; ?>global/images/step1.jpg" /></td>
    <td width="63%" align="left" id="schoice">Please complete this important information about your travel party.</td></tr>
    <tr>
    <td width="27%" rowspan="5" valign="top">
          <table width="306" border="0" class="redondo" id="toursbooking" style="height:100%;">
      <tr valign="top">
        <td width="300" height="173"><table border="0" class="redondo" id="toursbooking2"  >
            <tr>
              <td width="292" ><div>
                  <table width="100%">
                    <tr>
                      <td align="left"><div class="booking-title"><img src="<?php echo $data['rootUrl']; ?>global/img/yourtour.png"/></div></td>
                    </tr>
                    <tr>
                      <td align="center" ><font color="#FF0000"><span id="premiun">PREMIUM SCHEDULED</span></font></td>
                    </tr>
                    <tr>
                      <td align="center" ><samp>1 DAY TOUR</span></td>
                    </tr>
                    <tr align="center" valign="middle">
                      <td height="66"><table>
                          <tr align="center" valign="middle">
                            
                          </tr>
                      </table>
                        <table width="100%" border="0" cellspacing="1">
                          <tr>
                            <td width="90">ARRIVAL</td>
                            <td width="156">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><span id="arrival0" style="font-size:9px;"></span></td>
                            <td><font size="-2"><span id="arrival1" style="font-size:9px;"></span></font></td>
                          </tr>
                          <tr>
                            <td><span id="arrival2" style="font-size:9px;"></span></td>
                            <td><font size="-2"><span id="arrival3" style="font-size:9px;"></span></font></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>DEPARTURE</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><span id="departure0" style="font-size:9px;"></span></td>
                            <td><font size="-2"><span id="departure1" style="font-size:9px;"></span></font></td>
                          </tr>
                          <tr>
                            <td><span id="departure2" style="font-size:9px;"></span></td>
                            <td><font size="-2"><span id="departure3" style="font-size:9px;"></span></font></td>
                          </tr>
                        </table>
                        <p>&nbsp;</p></td>
                    </tr>
                  </table>
              </div>
                  <div></div>
                <div>
                    <table>
                      <tr>
                        <td width="auto"></td>
                      </tr>
                    </table>
                </div></td>
            </tr>
        </table></td >
      </tr>
    </table>
    </td>
    <td colspan="2">
    	<div id="toursajax">
  <form>
<br />
  <table width="100%"><tr><td>
  <table width="100%" border="0"  >
    <tr>
    	<td align="left">
        <table width="100%">
        	<tr>
              <td align="center" ><strong>Tour  Date</strong></td>
               <td>&nbsp;</td>
              <td align="center"><strong>Adults</strong></td>      
             
              <td align="center"><strong>Child (3 to 9 Years)</strong></td>
            </tr>
    <tr>
      <td align="center" ><table width="110" border="0" align="center">
        <tr>
          <td width="60"><input name="txtfecha_salida" type="text" id="txtfecha_salida" size="10"  class="required" value="<?php echo date('m-d-Y',strtotime($mañana));?>" />
          </td>
          <td width="124"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" /></a></td>
        </tr>
      </table></td>
  <td>&nbsp;</td>
      <td align="center" >
      	<input  type="number" name="txtAdults" id="txtAdults" min="1" style="width:70px" value="1" max="16" onchange="
             var a = document.getElementById('txtAdults').value
        	if (isNaN(a)) { 
            	 return false;
     		}else{
            	 var max = 16-a;
                 if(max<0){
                 	var valor = 16-$('#txtChild').val();
                    document.getElementById('txtAdults').value = valor;
                    $('#txtChild').attr('max',valor);
                 }else{
                     $('#txtChild').attr('max',max);
                     if($('#txtChild').val()>max){
                        $('#txtChild').attr('value',max);
                     }
                 }
            }
            
        " required="required" /></td>
      <td align="center"><input  type="number" name="txtChild" id="txtChild" min="0" max="15"  style="width:70px" required="required" value="0" onchange=" 	
      		var a = document.getElementById('txtChild').value;
        	if (isNaN(a)) { 
            	 return false;
     		}else{
           		 var max = 16-a;
                 if(max<=0){
                 	var valor = 16-$('#txtAdults').val();
                    document.getElementById('txtChild').value = valor;
                    $('#txtChild').attr('max',valor);
                 }else{
                     if($('#txtAdults').val()>max){
                        $('#txtAdults').attr('value',max);
                     }
                 }
            }" /></td
      
    >
    </tr>
        </table></td>
        <td colspan="2" width="50%" valign="middle" align="center">
     
		<u><font size="+2" color="#000000" id="txtFecha"><?php echo date('D M d Y',strtotime($mañana))?></font></u></td>
    </tr>
    <tr id="tdSelectTrip">
    	<td colspan="3"><strong>Select the tour date to view the available trips</strong></td>
    </tr>
    </table>
    </td></tr>
    <tr><td style="height:200px">
    <div id="itinerary" >
    <table width="100%">
    <tr>
    <td><strong>PickUp</strong></td>
    <td width="2%" rowspan="5" align="center"><img src="<?php echo $data['rootUrl']; ?>global/img/vertical_line.png" height=""/></td>
    <td><strong>Drop off</strong></td>
    </tr>
     <tr>
      <td width="49%" align="center"><div id="pickups" >
      	<table width='80%' border='0' cellspacing='1' aling='center'>
        	<tr>
    			<td width='20%'>Area:</td>
	    		<td width='20%'>
                	<select name='area' id='area'>
                    <?php
						$areas_ida = $data['areas_ida'];
						foreach ($areas_ida as $e) {
							echo '<option value="' . $e ['id'] . '" ' . ((9 == $e ['id'])? 'selected' : '') . ' >' . $e ['nombre'] . '</option>';
            }
			?>
                    </select>
                </td>
                </tr>
                <tr>
                	<td>Pickup Point:</td>
                    <td><div id="pickup_exexten"><select name='pickup' id='pickup' style='width:195px;'>
                <?php
						 $sql2 = "SELECT id,place,address
									FROM pickup_dropoff
									WHERE id_area = ?";
						$rs2 = Doo::db()->query($sql2, array(9));
						  $pickupdropof = $rs2->fetchAll();
						foreach ($pickupdropof as $e) {
							echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
						}
			?>
				</select>
                </div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
        </table>
      </div></td>
      <td  width="49%" align="center"><div id="pickups2" >
      	<table width='80%' border='0' cellspacing='1' aling='center'>
        	<tr>
    			<td width='20%'>Area:</td>
	    		<td width='20%'>
                	<select name='area2' id='area2'>
                    <?
					$areas_return = $data['areas_return']; 
					foreach ($areas_return as $e) {
							echo '<option value="' . $e ['id'] . '" ' . ((9 == $e ['id'])? 'selected' : '') . ' >' . $e ['nombre'] . '</option>';
            }
			?>
                    </select>
                </td>
                </tr>
                <tr>
                	<td>Pickup Point:</td>
                    <td><div id="pickup2_exexten"><select name='pickup2' id='pickup2' style='width:195px;'>
                <?php
						 $sql2 = "SELECT id,place,address
									FROM pickup_dropoff
									WHERE id_area = ?";
						$rs2 = Doo::db()->query($sql2, array(9));
						  $pickupdropof = $rs2->fetchAll();
						foreach ($pickupdropof as $e) {
							echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
						}
			?>
				</select></div>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
        </table>
      </div></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="49%" align="center" >
      <strong> Method of arrival to Orlando</strong>     </td>
      <td width="49%" align="center"><strong> Method of departure to Orlando  </strong>    </td>
    </tr>
    <tr>
     <td  width="49%" align="center" valign="top"><div id="trip1_onedaytour" ><strong></strong></div></td>
      <td width="49%" align="center" valign="top"><div id="trip2_onedaytour" ></div></td>
    </tr>
  </table>
   </div>
  </td></tr>
  <tr>
  <td>
  	<p align="right">
         <button  class="btn" id="btn-continue">Continue</button>
    </p>
  </td>
  </tr>
  </table>

 
</form> </div>
    </td>
    </tr>
    </table>
    </td></tr></table>

 <div id="lefttours">
</div>






<span id="platium"></span>



<div id="foot">
  <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
    Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.  </h4>
</div>


</div>
		<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
		<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
		<script>
	 $("#trip1_onedaytour").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="150" height="150" id="gif"/>');
	 $("#trip2_onedaytour").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="150px" height="150" id="gif"/>');
                   function restar(dia1, mes1, ano1, dia2, mes2, ano2)
                    {
                        fecha1 = new Date(ano1, mes1 - 1, dia1);
                        fecha2 = new Date(ano2, mes2 - 1, dia2);
                        var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;
                        return resta;

                    }
                    var f=new Date();
                    var dato = restar(26, 5, 2014, f.getDate(), f.getMonth(), f.getFullYear()); 
		   $( "#txtfecha_salida" ).datepicker({
				dateFormat:'mm-dd-yy',
				 maxDate:         553 - dato,
                 minDate:         <?php if(date('H:g')>'22:00'){echo 2;
							}else{
								echo 1;
							}?>
                       
			});
			
			$('#txtChild, #txtAdults').change(function(){
				cargarTrip();
			});
			
			function cargarTrip(){
				var totalpax = totalPax();
				 if(totalpax!=-1){
					$("#trip1_onedaytour").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="150" height="150" id="gif"/>');
		 $("#trip2_onedaytour").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="150px" height="150" id="gif"/>');
					 var sentido = 1;
					 var idArea = $("#area").val();
					 var fechaS = $("#txtfecha_salida").val();
					 $("#trip1_onedaytour").load('<?php echo $data['rootUrl']; ?>tours/onedaytour/' + sentido +'/'+ idArea +'/'+ fechaS+'/'+totalpax);
					 sentido = 2;
					 $("#trip2_onedaytour").load('<?php echo $data['rootUrl']; ?>tours/onedaytour/' + sentido +'/'+ idArea +'/'+ fechaS+'/'+totalpax);
				 }else{
					  $("#txtAdults").addClass('notFilled');
					 alert(validateNumberPositivo(totalpax,'Adults', true));
					   $("#txtAdults").focus();
				 }
			}
			
			function cargarTrip2(){
				var totalpax = totalPax();
				 if(totalpax!=-1){
					 var sentido = 2;
					 var idArea = $("#area2").val();;
					 var fechaS = $("#txtfecha_salida").val();
					 $("#trip2_onedaytour").load('<?php echo $data['rootUrl']; ?>tours/onedaytour/' + sentido +'/'+ idArea +'/'+ fechaS+'/'+totalpax);
				 }else{
					 $("#txtAdults").addClass('notFilled');
					 alert(validateNumberPositivo(totalpax,'Adults', true));
					 $("#txtAdults").focus();
				 }
			}
			
			$("#area").change(function() {			
			    var id = $(this).val();	  
				$("#area2").attr("value",id);
				$("#pickup_exexten").load('<?php echo $data['rootUrl']; ?>tours/question15/' + id );
				 var num = 2;
				$("#pickup2_exexten").load('<?php echo $data['rootUrl']; ?>tours/question15/' + id +'/'+ num );
				cargarTrip();
				
			});
			
			function totalPax(){
				var child = $("#txtChild").val();
				var adult = $("#txtAdults").val();
				if(validateNumberPositivo(adult,'adult', true)!=""){
					adult = 0;
				}
				if(validateNumberPositivo(child,'child', true)!=""){
					child = 0;
				}
				if(adult==0){
					return -1;
				}
				var totalpax = parseFloat(adult) + parseFloat(child);
				return totalpax;
			}
			
		$("#area2").change(function() {			
			var id = $(this).val();	  
			var num = 2;
			$("#pickup2_exexten").load('<?php echo $data['rootUrl']; ?>tours/question15/' + id +'/'+ num );			
		});
			
			
			$("#pickup").change(function() {			
			     var id = $(this).val();	  
				$("#pickup2").attr("value",id);
			});
			
			
			
			$("#txtfecha_salida").change(function() {
			     $('#tdSelectTrip').html('');
				 div = document.getElementById('itinerary');
			     div.style.display = '';
				 var f = new Date($("#txtfecha_salida").val());
				 cargarTrip();
				 $('#txtFecha').html(f.toDateString());
			});
			$("#dataclick1").click(function(e) {	



		e.preventDefault();
		$("#txtfecha_salida").datepicker("show");
	});
	
			$(this).find('.notFilled').first().focus();
$(document).ready(function(){
  $('form').validator();
});

$('#txtfecha_salida').blur(function() {
 $(this).removeClass('notFilled');
});


$('#txtAdults').blur(function() {
 	$(this).removeClass('notFilled');
});
$('#txtChild').blur(function() {
 	$(this).removeClass('notFilled');
});

function getItemChecked(parametro){
	try {
		var val = document.getElementById(parametro).value;
		return val;
	}
	catch(exception){
		return -1;	
	}
}
		
	
		
$("#btn-continue").click(function(){
	if((getItemChecked("trip1") < 0 )||(getItemChecked("trip2") < 0)){
					alert('Not trip available for this day or the buses are full');
					return false;	
    		}
	
	 var fecha = $("#txtfecha_salida").val();
	 var adults = $("#txtAdults").val();
	 var child = $("#txtChild").val();
	  if($("#trip1").val() == -1 || $("#trip2").val() == -1){
		 alert('No trip available for this date');
		 $("#txtfecha_salida").focus();
		 return false;
	}
	 if(adults == '' || !sNumeric(adults) || adults <1){
	 	$("#txtAdults").addClass('notFilled');
		$("#txtAdults").focus();
		return false;
	 }
	 if(child == '' || !sNumeric(child)){
	 	$("#txtChild").addClass('notFilled');
		return false;
	 }
	
	(function($){
	  $.fn.validator = function(opts){
		return $(this).submit(function(evt){
		  $(this).find('.required').each(function(){
			if ($(this).attr('value') == ''){
			  $(this).addClass('notFilled');
			  evt.preventDefault();
			}
		  });
		  $(this).find('.notFilled').first().focus();
		});
	  };
	})(jQuery);	
	}); 
	
	var sentido = 1;
	var idArea = 9;
	var fechaS = $("#txtfecha_salida").val();
	$("#trip1_onedaytour").load('<?php echo $data['rootUrl']; ?>tours/onedaytour/' + sentido +'/'+ idArea +'/'+ fechaS+'/1');
	sentido = 2;
	$("#trip2_onedaytour").load('<?php echo $data['rootUrl']; ?>tours/onedaytour/' + sentido +'/'+ idArea +'/'+ fechaS+'/1');
				 
		
			 
        </script>
        
   
</body>
</html>
