<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Supertours Of Orlando, Inc.</title>
<meta NAME="Title" CONTENT="Super Tours Of Orlando - Transportations Florida">
<meta NAME="Author" CONTENT=" Super Tours Of Orlando ">
<meta NAME="Subject" CONTENT=" Transportations Miami  Orlando - ">
<meta NAME="Description" CONTENT=" Bus Tickets through Florida: luxury bus from  Miami to Orlando  , Orlando to ,  Ft.Lauderdale Airport, Fort Pierce , Hollywood (Sheridan), Hialeah , Kendall , Miami Airport , Miami Beach Central , Miami Downtown, Miami Beach North , Pompano , Miami Beach South , West Palm Beach, tours of Orlando from Miami , leader transportations 1989">
<meta NAME="Keywords" CONTENT=" Bus Tickets  Florida, Transportations Miami to Orlando , Transportations Orlando  to Miami , transportations florida, tours , florida tours , miami , travel florida , vacations florida , destinations florida, travel agents florida , Ft.Lauderdale Airport, Fort Pierce , Hollywood (Sheridan), Hialeah , Kendall , Miami Airport , Miami Beach Central , Miami Downtown, Miami Beach North , Pompano , Miami Beach South , West Palm Beach , leader transportations ">
<meta NAME="Language" CONTENT="English">
<meta NAME="Revisit" CONTENT="1 day">

<meta NAME="Robots" CONTENT="All">
 <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery.superbox.css"> 
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>    --> 
 <link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/menu.css" rel="stylesheet" type="text/css" />  
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/agencia.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui.css">
    
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min2.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min2.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery_timer.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.superbox.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<style type="text/css">
		/* Custom Theme */
		#superbox-overlay{background:#e0e4cc;}
		#superbox-container .loading{width:32px;height:32px;margin:0 auto;text-indent:-9999px;background:url(<?php echo $data['rootUrl']; ?>global/img/loader1.gif) no-repeat 0 0;}
		#superbox .close a{float:right;padding:0 5px;line-height:20px;background:#333;cursor:pointer;}
		#superbox .close a span{color:#fff;}
		#superbox .nextprev a{float:left;margin-right:5px;padding:0 5px;line-height:20px;background:#333;cursor:pointer;color:#fff;}
		#superbox .nextprev .disabled{background:#ccc;cursor:default;}
		
</style>
<script type="text/javascript">
    
$(document).ready(function() {		
    

 
       $('#hora_reserv').timepicker({ampm: true});
       
       $('#hora_reserv').change(function(){
          $.ajax({
           type: "POST",
           url:'<?php echo $data['rootUrl']; ?>agency/ajax',
	   data:'hora='+$('#hora_reserv').val()+'&fecha='+$("#fecha_reserva").val(), 
           dataType: "html",
           success:function(data){
			if(parseInt(data) != 0){
		              $("#ajax").html(data); 
                        }
    	   }
 	 });
       }); 
      // $( "#fecha_reserva" ).datepicker( "option", "dateFormat", "m-d-Y" );
       $("#fecha_reserva").datepicker({dateFormat: 'mm-dd-yy',minDate: new Date()});
      
      
       $('#fecha_reserva').change(function(){
             $.ajax({
           type: "POST",
           url:'<?php echo $data['rootUrl']; ?>agency/ajax',
	   data:'hora='+$('#hora_reserv').val()+'&fecha='+$("#fecha_reserva").val(), 
           dataType: "html",
           success:function(data){
			if(parseInt(data) != 0){
		              $("#ajax").html(data); 
                 	}
    	   }
 	 });
       });
       
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
<!--<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.superbox.js"></script>-->


<style type="text/css">
		/* Custom Theme */
 #ajax{
     overflow:scroll; 
 font-size:11px; 
 width: 100%;	
 height:160px;
 }
</style>

<script type="text/javascript">
$(document).ready(function() {	
$("#tabs").tabs();
	});

</script>
<!--Start of Zopim Live Chat Script-->
        <script type="text/javascript">
            window.$zopim || (function(d, s) {
                var z = $zopim = function(c) {
                    z._.push(c)
                }, $ = z.s =
                        d.createElement(s), e = d.getElementsByTagName(s)[0];
                z.set = function(o) {
                    z.set.
                            _.push(o)
                };
                z._ = [];
                z.set._ = [];
                $.async = !0;
                $.setAttribute('charset', 'utf-8');
                $.src = '//v2.zopim.com/?20XEJ2yJKVJZSjhDmp2MbqrXR29zag89';
                z.t = +new Date;
                $.
                        type = 'text/javascript';
                e.parentNode.insertBefore($, e)
            })(document, 'script');
        </script>
        <!--End of Zopim Live Chat Script-->
	
    
</head>

<body class="no-js">
<script>
			var el = document.getElementsByTagName("body")[0];
			el.className = "";
		</script>
<noscript>
<!--[if IE]>
            	<link rel="stylesheet" href="css/ie.css">
            <![endif]-->
</noscript>
    
<div id="mascaraP" style="display: none;">		</div>
		<div id="popup" style="display: none;">
		</div>
<div id="popupModal" style="display: none;" ></div>
	
        
<div id="contenedor">
<div id="header">
  <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
 
  <div id="redes">
    <div id="iconos">
      <div id="redesGo"></div>
      <div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div>
      <div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div>
    </div>
    <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
      From 4 am To Midnight - (Eastern Time) <br />
      <strong>Hablamos Español</strong> </div>
  </div>
</div>
<div id="barra">
<?php
	include_once('global/menu/menu1.php');?>
    </div>
<div id="policy">
<div id="contendinfo">
  <div id="mapmarcohome">
    <div id="contenido"> 
      <!-- contenido principal -->
      <div id="side1_2">
      
        <div id="myaccount">
          
          <div id="user_welcome"><table width="90%" border="0">
  <tr>
    <td><div id="title">My Account</div></td>
    </tr>
  <tr>
    <td>Welcome, <span><b><font size="+2"><?  $session = unserialize($_SESSION['uagency']);
			      $agencia = $this->data['agencia'];
			   echo $session->firstname; ?> </font>
               <font color="#0099FF" size="-1">
              <a href="<?php echo $data['rootUrl']; ?>agency/logout">logout</a></font></b></span> <br /></td>
    </tr>
  <tr>
    <td><font color="#999999" size="-1">Company <? echo $agencia->company_name.""."&nbsp; Phone: ".$agencia->phone1."<br> AITA/CLIA: ".$agencia->iata_clia; ?></font><font color="#999999" size="-1"><? echo "  &nbsp;&nbsp;E-MAIL: ".$agencia->main_email; ?></font>
      </p></td>
    </tr>
  <tr>
    <td height="0"></td>
    </tr>
</table>

            
            
            <p>&nbsp;</p>
          </div>
          <div id="fp"> </div>
        </div>
        <div id="reserves">
          <div id="tabs">
            <ul >
              <li><a href="#transporte" onclick="javascript:window.location.replace('<?php echo $data['rootUrl']; ?>agency/#transporte')"><span >Transportation</span></a></li>
              <li><a href="#tours" onclick="javascript:window.location.replace('<?php echo $data['rootUrl']; ?>agency/#tours')"><span>Multi-Day-Tours</span></a></li>
              <li><a href="#tours2" onclick="javascript:window.location.replace('<?php echo $data['rootUrl']; ?>agency/#tours2')"><span>1-Day-Tours</span></a></li>
              <li><a href="#profile" onclick="javascript:window.location.replace('<?php echo $data['rootUrl']; ?>agency/#profile')"><span>Profile</span></a></li>
           
            </ul>
            
            <!-- Trips Information TAB -->
            <div id="transporte" style="height:460px;">
            
            </div>
              
            <!-- Account Information TAB -->
            <div id="tours" style="height:460px;">
              
            </div>
            
            <div id="tours2" style="height:460px;">
              
            </div>
            
            
            
            <div id="profile" style="height:460px;">
           
            </div>
      
      <!-- side 2 -->
              
        <div id="ajaxs"  style="display:none"></div>
      
      
      <div id="mensage" style="display:none"></div>
      <!-- fin side 2 -->
      
      <!-- contenido principal --> 
    </div>
  </div>
  <div id="foot">
    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
      Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved. </h4>
  </div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script> 

<script>
  
  $('#btn-find').click(function(){
       $('#form1').submit();
     });

$(document).ready(function() {
 
 //cargar trips
 $("#ajax").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/ajax'));
 $("#transporte").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/transport'));
 $("#tours").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/mytours'));
 $("#tours2").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/mytours2'));
// $("#administrator").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/myadmin'));
 $("#profile").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/myprofile'));
 
 
 $("#close").click(function(){
          $('#mascaraP').fadeOut('slow');				
	  $('#popup').fadeOut('slow');
	 $('#popupModal').fadeOut('slow');
     
 });
 
  var dato = <? echo $data['pagina']; ?>;
         if(dato == 1){
	    javascript:window.location.replace('#transporte');
	 }
	 if(dato == 2){
	  javascript:window.location.replace('#tours');
	 }
	  if(dato == 3){
	 javascript:window.location.replace('#profile');
	 }
         if(dato == 4){
	 javascript:window.location.replace('#administrator');
	 }
         
});

(function($){
			
				//cache nav
				var nav = $("#topNav");
				
				//add indicator and hovers to submenu parents
				nav.find("li").each(function() {
					if ($(this).find("ul").length > 0) {
						$("<span>").text("^").appendTo($(this).children(":first"));

						//show subnav on hover
						$(this).mouseenter(function() {
							$(this).find("ul").stop(true, true).slideDown();
						});
						
						//hide submenus on exit
						$(this).mouseleave(function() {
							$(this).find("ul").stop(true, true).slideUp();
						});
					}
				});
			})(jQuery);

$(function(){
			$.superbox.settings = {
				closeTxt: "Close",
				loadTxt: "Loading...",
				boxClasses: "", // Class of the "superbox" element
	                        overlayOpacity: .8, // Background opaqueness
	                        boxWidth: ($(window).width()-$('#ajaxs').width())/2, // Default width of the box
	                        boxHeight: ($(window).height()-$('#ajaxs').height())/2, // Default height of the box
				overflow: "scroll", 
                                nextTxt: "Next",
				prevTxt: "Previous"
			};
			$.superbox();
		});




$(document).ready(function() {
 	$.timer(300000, function(){
           $.ajax({
            type: "POST",
            url:'<?php echo $data['rootUrl']; ?>agency/ajax',
	    data:'hora='+$('#hora_reserv').val()+'&fecha='+$("#fecha_reserva").val(), 
            dataType: "html",
            success:function(data){
			if(parseInt(data) != 0){
		              $("#ajax").html(data); 
                 	}
    	    }
 	  });
          
             //  $("#ajax").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/ajax'));
        });
});
  
		   $("#btn-continue").click(function(){
			 
			 var tex= "";
			 
			 if($('#password').val() == "")
			 {
			 tex += "- Old PASSWORD is requerid \n";
			 }
			 
			  if($('#newpassword').val() == "")
			 {
			 tex += "- PASSWORD is requerid \n";
			 }
			  if($('#password1').val() == "")
			 {
			 tex += "- Confir Password is requerid \n";
			 }
			 
			if($('#newpassword').val() != $('#password1').val()) 
			{
			 tex += "- Password no coinciden \n";
				
			}
			 
			 
			 if(tex != "")
		 {
            alert(tex);
           return false;
         }
			 return true;
			 
			});
  
	var horas = <?php echo $this->data['hora']; ?>;
	var minutos = <?php echo $this->data['minutos']; ?>;
	var segundos = <?php echo $this->data['segundos']; ?>;

	

	
  	$.timer(1000, function(){ 
			
     		
			if(minutos == 60){
			
			            minutos=0;
						horas+=1;
				$("#horas").html(minutos + ":");
			}					
        		
			 if(segundos == 60){
				
						segundos=0;
						minutos+=1;
				$("#minutos").html(minutos + ":");
				}
				else
				{
    		
    		   segundos+=1;
			
    		  $("#segundos").html(segundos);
			   }
    		 	
							
       });	
	   
  	$("#horas").html(horas + ":");
	$("#minutos").html(minutos + ":");
	$("#segundos").html(segundos + "  " );
	
	
			 $("#dataclick1").click(function(e) {	



		e.preventDefault();



		$("#fecha_salida").datepicker("show");



	});
	
	$("#dataclick2").click(function(e) {	



		e.preventDefault();



		$("#fecha_retorno").datepicker("show");



	});

 /*   
function ajaxs(number)
{
    
    var parm = number;

    //$("#ajaxs").load(encodeURI('<?php echo $data['rootUrl']; ?>agency/ajaxs/' + parm));
	$.ajax({
	   url:'<?php echo $data['rootUrl']; ?>agency/ajaxs/' + parm,
	   success:function(data){
			if(parseInt(data) != 0){
		              $("#ajaxs").html(data); 
                              $('#ajaxs').show().jScrollPane().hide();
                 	}
    	   }
 	 }); 
       
         $('#mascaraP').fadeIn('slow');				
	 $('#popup').fadeIn('slow');
	 $('#popupModal').fadeIn('slow');
	 //alert('<?php echo $data['rootUrl']; ?>protected/viewc/admin/configuracionfrm_client.php');
         return false;


}
*/

   $("#from").change(function(){
         
         var id = $("#from").val();
           if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
     });
     
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
         
         
         
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
</body>
</html>