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
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>
 </div>
 
 <div id="content">
   <div id="left-column">
     <div id="booking">
  <div id="formularioH">
  
<form action="<?php echo $data['rootUrl']; ?>questions" method="post" name="form2"> 
<table width="200" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
  <tr>
    <td colspan="4" class="titulos1forms"><img src="<?php echo $data['rootUrl']; ?>global/images/BUY-TICKETS - white.png"  /></td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms">Round Trip</span> <input name="tipo_ticket" type="radio" value="roundtrip" id="rd" <?php echo ($booking["tipo_ticket"] == trim("roundtrip")?'checked':''); ?>  /></td>
    <td colspan="2"><span class="niveltextoforms">One Way Trip</span> <input name="tipo_ticket" type="radio" value="oneway" id="ow"<?php echo ($booking["tipo_ticket"] == trim("oneway")?'checked':''); ?>  />      </td>
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
   <tr>
    <td height="38"><div id="dv_fr2"><span class="niveltextoforms">Returning: <br />
      </span> </div></td>
    <td><div id="dv_fr1"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20" border="0" /></a></div></td>
    <td colspan="2" class="titulos2forms"> <div class="form-row" id="dv_fr">  <input name="fecha_retorno" size="15" maxlength="10" class="input-text" id="fecha_retorno" readonly="readonly"  value="<?php echo $booking['fecha_retorno'];  ?>"/></div></td>
  </tr>
  
   <tr>
     <td colspan="4"><span class="niveltextoforms3"> Adult</span>
       <input name="pax" size="2" maxlength="5" class="input-text" id="pax" value="<?php echo $booking['pax'];  ?> "/> 
       <span class="niveltextoforms3">Child<span class="titulos2forms">
       <input name="pax2" size="2" maxlength="5" class="input-text" id="pax2" value="<?php echo $booking['chil'];  ?> "/>
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
     
     <div id="center-column2">
    
         <form action="<?php echo $data['rootUrl']; ?>booking" method="post" name="form1" >
          <p align="center">ARE YOU A FLORIDA RESIDENT ?<BR />
         <span>Yes</span>
         <input name="pregun" type="radio" value="1" id="si" />
         <span>No</span>
         <input name="pregun" type="radio" value="0" id="no" />
         <div id="zip" style="display: none;" align="center">Zip Code
<input name="zip1" size="20" maxlength="10" class="input-text" id="zip1" /></div>
         
       <p align="center">
        <button  class="btn" id="btn-continue" >Continue</button>
       </p><p>
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
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>    
<script type="text/javascript">

   $("#si").click(function(evento){
		if ($("#si").attr("checked")){
			$("#zip").css("display", "block");
			
		}else{
			$("#zip").css("display", "none");
		}
	});
	
	
   $("#no").click(function(evento){
		if ($("#no").attr("checked")){
			$("#zip").css("display", "none");
			
		}else{
			$("#zip").css("display", "none");
		}
	});
   
   if ($("#from").val() != ""){
      $("#to").load('<?php echo $data['rootUrl']; ?>load/' + $("#from").val(), function(){
        $("#to").val('<?php echo $booking["tot"] ?>');
      });   
   }
   var variablejs = "<?php echo $booking['tipo_ticket']; ?>" ;


	
    $("#from").change(function(){
        var id = $("#from").val();
        if (id != "")
            $("#to").load('<?php echo $data['rootUrl']; ?>load/' + id);
    });

 
   
   $("#btn-continue").click(function(){
     
      if($('input[id=si]').is(':checked') == true ){
		
			     
				if($("#zip1").val().length < 1) {  
                     alert("Required Zip Code ");  
                       return false;
                   }
			if($("#zip1").val() >= 32003 && $("#zip1").val() <= 34997) { 
				  
				    }
					else
					{ 
					
					alert("Zip Code does not belong to florida");  
					 return false;
					}	  
				   
	 }
      return true;
    });
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