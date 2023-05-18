<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Supertours Of Orlando, Inc.</title>
<link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />

   <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/js/themes/base/jquery.ui.all.css">  
   <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css"> 
   
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
    
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript">

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

$(document).ready(function() {		
	
	//Execute the slideShow
	slideShow();

});

function slideShow() {

	//Set the opacity of all images to 0
	$('#gallery a').css({opacity: 0.0});
	
	//Get the first image and display it (set it to full opacity)
	$('#gallery a:first').css({opacity: 1.0});
	
	//Set the caption background to semi-transparent
	$('#gallery .caption').css({opacity: 0.7});

	//Resize the width of the caption according to the image width
	$('#gallery .caption').css({width: $('#gallery a').find('img').css('width')});
	
	//Get the caption of the first image from REL attribute and display it
	$('#gallery .content').html($('#gallery a:first').find('img').attr('rel'))
	.animate({opacity: 30}, 400);
	
	//Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
	setInterval('gallery()',6000);
	
}

function gallery() {
	
	//if no IMGs have the show class, grab the first image
	var current = ($('#gallery a.show')?  $('#gallery a.show') : $('#gallery a:first'));

	//Get next image, if it reached the end of the slideshow, rotate it back to the first image
	var next = ((current.next().length) ? ((current.next().hasClass('caption'))? $('#gallery a:first') :current.next()) : $('#gallery a:first'));	
	
	//Get next image caption
	var caption = next.find('img').attr('rel');	
	
	//Set the fade in effect for the next image, show class has higher z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 1000);

	//Hide the current image
	current.animate({opacity: 0.0}, 1000)
	.removeClass('show');
	
	//Set the opacity to 0 and height to 1px
	$('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
	
	//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
	$('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '100px'},500 );
	
	//Display the content
	$('#gallery .content').html(caption);
	
	
}

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
  
  
	

	
    <!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

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
<div id="contenedor">
<div id="header">
<div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
<div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>
<div id="redes"><div id="iconos"><div id="redesGo"></div><div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div><div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div></div>
<div class="textosHead" >Tool Free <b> 1-800-251-4206 </b>- Open  <br />
  From 4 am To Midnight - (Eastern Time) <br />
  <strong>Hablamos Español</strong></div> </div>
</div>
<div id="barra">
<?php
	include_once('global/menu/menu1.php');?>
    </div>


<div id="policy">

 <div id="contendinfo">
<div id="mapmarcohome">
<div id="separadorTInter"></div>
<div id="contenidohome1"><img src="<?php echo $data['rootUrl']; ?>global/images/fleet-supertours-of-orlando.jpg" width="250" height="30" /><br />
 
  <p>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="616" height="208" id="FlashID" title="Supertors Terminal">
      <param name="movie" value="<?php echo $data['rootUrl']; ?>global/swf/terminal.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.65.0" />
      <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="<?php echo $data['rootUrl']; ?>global/swf/terminal.swf" width="616" height="208">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="6.0.65.0" />
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
        <!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object>
  </p>
  
 
  
<table  id="tablafleet" width="620" ><caption>
<br />
  <br />
</caption>
  <thead><tr>
    <th  width="131" scope="col"><p align="center"><strong>VEHICLE  TYPE</strong></p></th><th width="49" scope="col"><p align="center"><strong>SEATS</strong></p></th>
    <th width="73" scope="col"><p align="center"><strong>MOVIES</strong></p></th>
    <th width="49" scope="col"><p align="center"><strong>GPS</strong></p></th>
    <th width="53" scope="col"><p align="center"><strong>FREE<br />
WI-FI</strong></p></th>
    <th width="74" scope="col"><p align="center"><strong>LAVATORY</strong></p></th>
    <th width="74" scope="col"><p align="center">&nbsp;<strong>SECURITY</strong><br />
       CAMERAS </p></th>
    <th width="61" scope="col"><p align="center">&nbsp;<strong>HF MUSIC<br />
      SYSTEM</strong></p></th></tr></thead><tfoot></tfoot><tbody><tr >
    <th scope="row" >BUSES VAN-HOOL</th>
    <td>61</td>
    <td>YES</td>
    <td>YES</td>
    <td>YES</td>
    <td >YES</td>
    <td >YES</td>
    <td >YES</td></tr><tr class="odd">
      <th scope="row" ><strong>BUSES PREVOST</strong></th>
      <td>56</td>
      <td>YES</td>
      <td>YES</td>
      <td>YES</td>
      <td>YES</td>
      <td>YES</td>
      <td>YES</td></tr>
    <tr class="odd">
      <th scope="row" ><p><strong>MINI-BUSES MERCEDES BENZ</strong></p></th>
      <td>18</td>
      <td>YES</td>
      <td>YES</td>
      <td>YES</td>
      <td>NO</td>
      <td>YES</td>
      <td>YES</td>
    </tr>
    <tr class="odd">
      <th scope="row" id="r2"><strong>LIMO-VANS MERCEDES BENZ</strong></th>
      <td>15</td>
      <td>YES</td>
      <td>YES</td>
      <td>YES</td>
      <td>NO</td>
      <td>YES</td>
      <td>YES</td>
    </tr>
      </tbody>
</table>



<br />
<br />
<h1>Supertours Terminal </h1>
<iframe width="600" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com.co/maps/ms?msa=0&amp;msid=209411827224061447432.0004c1e9675774ed25a12&amp;ie=UTF8&amp;t=m&amp;ll=28.462504,-81.453152&amp;spn=0.004716,0.007489&amp;z=17&amp;output=embed"></iframe><br /><small>Ver <a href="https://www.google.com.co/maps/ms?msa=0&amp;msid=209411827224061447432.0004c1e9675774ed25a12&amp;ie=UTF8&amp;t=m&amp;ll=28.462504,-81.453152&amp;spn=0.004716,0.007489&amp;z=17&amp;source=embed" style="color:#0000FF;text-align:left">Supertours Of Orlando, Inc. </a> en un mapa más grande</small>
</div>


</div>
<div id="contendLDE">
<div id="separatedbar"></div>
<div id="formularioP">
<form action="<?php echo $data['rootUrl']; ?>questions" method="post" name="form1"> 
<table width="200" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
  <tr>
    <td colspan="4" class="titulos1forms"><img src="<?php echo $data['rootUrl']; ?>global/images/BUY-TICKETS - white.png"  /></td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms">Round Trip</span> <input name="tipo_ticket" type="radio" value="roundtrip" id="rd" checked  /></td>
    <td colspan="2"><span class="niveltextoforms">One Way Trip</span> <input name="tipo_ticket" type="radio" value="oneway" id="ow"  />      </td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms1"> From</span>:<br /></td>
    <td colspan="2"><select name="fromt" class="select" style="width:150px;" id="from">
                       <option value=""></option> 
                      <?php foreach($data["areas"] as $e):?>
                             <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO")?'selected':''); ?> ><?php echo $e["nombre"]; ?></option>
                      <?php endforeach;?>
        </select></td>
  </tr>
  <tr>
    <td colspan="2"><span class="niveltextoforms1"> To:</span></td>
    <td colspan="2"> <select name="tot" class="select" id="to" style="width:150px;">
                       
                   </select></td>
  </tr>
  <tr>
    <td colspan="4" class="titulos1forms">  </td>
  </tr>
  <tr>
    <td width="64"><span class="niveltextoforms">Departing <br />
      </span></td>
    <td width="20"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20"  border="0"  /></a></td>
    <td colspan="2" class="titulos2forms"><input name="fecha_salida" size="20" maxlength="10" class="input-text" id="fecha_salida" readonly="readonly" value="<?php echo date("m-d-Y")?>"/></td>
  </tr>
   <tr>
    <td height="38"><div id="dv_fr2"><span class="niveltextoforms">Returning: <br />
      </span> </div></td>
    <td><div id="dv_fr1"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20" border="0" /></a></div></td>
    <td colspan="2" class="titulos2forms"> <div class="form-row" id="dv_fr">  <input name="fecha_retorno" size="20" maxlength="10" class="input-text" id="fecha_retorno" readonly="readonly" /></div></td>
  </tr>
  
   <tr>
     <td colspan="4"><span class="niveltextoforms3"> Adults</span>
       <input name="pax" size="2" maxlength="5" class="input-text" id="pax" /> 
       <span class="niveltextoforms3">Child<span class="titulos2forms">
       <input name="pax2" size="2" maxlength="5" class="input-text" id="pax2" />
       </span></span></td>
     </tr>
    <tr>
     <td colspan="2"><button  class="btn" id="btn-search">Search</button></td>
     <td colspan="2" class="titulos2forms">&nbsp;</td>
   </tr>
  <tr>
    <td height="66" colspan="4" align="left" valign="top"></td>
  </tr>
</table>
  </form>


</div>
<div id="titusbar">WE FEEL PROUD TO HAVE YOU ON BOARD</div>
<div id="iconsbar"><div id="iconobar"><img src="<?php echo $data['rootUrl']; ?>global/images/icon1.jpg" width="62" height="37" /></div><div id="textbar">GPS SYSTEM</div></div>
<div id="iconsbar"><div id="iconobar"><img src="<?php echo $data['rootUrl']; ?>global/images/icon2.jpg" width="62" height="37" /></div><div id="textbar">FREE WI-FI INTERNET</div></div>
<div id="iconsbar">
  <div id="iconobar"><img src="<?php echo $data['rootUrl']; ?>global/images/icon3.jpg" width="62" height="37" /></div><div id="textbar">HF MUSIC SYSTEM</div></div>
<div id="iconsbar">
  <div id="iconobar"><img src="<?php echo $data['rootUrl']; ?>global/images/icon4.jpg" width="62" height="37" /></div><div id="textbar">DVD MONITORS</div></div>
<div id="titusbar"></div>
<div id="bannerR2"><img src="<?php echo $data['rootUrl']; ?>global/images/banner.png" width="281" height="109" /></div>
</div>





<div id="foot">
  <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
    Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.  </h4>
</div>
</div>


	
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
        <script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
		<script>
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
 
   $("#from").change(function(){
         
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
     });
	 
	
         
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
        </script>
        

        
        
</body>
</html>
