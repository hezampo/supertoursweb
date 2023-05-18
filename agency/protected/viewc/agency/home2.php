<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Supertours Of Orlando, Inc.</title>

<META NAME="Title" CONTENT="Super Tours Of Orlando - Transportations Florida">
<META NAME="Author" CONTENT=" Super Tours Of Orlando ">
<META NAME="Subject" CONTENT=" Transportations Miami  Orlando - ">
<META NAME="Description" CONTENT=" Bus Tickets through Florida: luxury bus from  Miami to Orlando  , Orlando to ,  Ft.Lauderdale Airport, Fort Pierce , Hollywood (Sheridan), Hialeah , Kendall , Miami Airport , Miami Beach Central , Miami Downtown, Miami Beach North , Pompano , Miami Beach South , West Palm Beach, tours of Orlando from Miami , leader transportations 1989">
<META NAME="Keywords" CONTENT=" Bus Tickets  Florida, Transportations Miami to Orlando , Transportations Orlando  to Miami , transportations florida, tours , florida tours , miami , travel florida , vacations florida , destinations florida, travel agents florida , Ft.Lauderdale Airport, Fort Pierce , Hollywood (Sheridan), Hialeah , Kendall , Miami Airport , Miami Beach Central , Miami Downtown, Miami Beach North , Pompano , Miami Beach South , West Palm Beach , leader transportations ">
<META NAME="Language" CONTENT="English">
<META NAME="Revisit" CONTENT="1 day">
<META NAME="Distribution" CONTENT="Global">
<META NAME="Robots" CONTENT="All">
 
<link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/menu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/new/jquery-1.7.2.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/new/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>     

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

slideShow();


});
</script>

<script>
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

</head> 

<body>

<div id="contenedor">      
  
 <?php 

 if(isset($_SESSION['user']) ){
 $login = $_SESSION['user'];

}
 if( isset($_SESSION['booking']) ){
 
$booking = $_SESSION['booking'];
}

  ?>  
<div id="header">
<div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
<div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Close Session</a>
     <?php } ?>
   </div>
<div id="redes"><div id="iconos"><div id="redesGo"></div><div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div><div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div></div>
<div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open  <br />
  From 4 am To Midnight - (Eastern Time) <br />
  <strong>Hablamos Español</strong></div> </div>
</div>
<div id="barra">
<?php
	include_once('global/menu/menu1.php');?>
    </div>
<div id="banner">
<div id="bannerslider">
 <div id="gallery">
	<a href="#" class="show">
		<img src="<?php echo $data['rootUrl']; ?>global/images/banner1sl.jpg" alt="Leader in transportation since 1989" width="756" height="378" title="" alt="" rel="<h3>LEADER IN TRANSPORTATION SINCE 1989</h3>  "/>  
	</a>
	
	<a href="#">
		<img src="<?php echo $data['rootUrl']; ?>global/images/banner2sl.jpg" alt="Leader in transportation since 1989" width="756" height="378" title="" alt="" rel="<h3>GO WHIT THE BEST SERVICE IN FLORIDA</h3>Proud to serve Oolando - Kissimmee/ST.Cloud - Fort pierce - West Palm Beach - Pompano - Fort Lauderdale Airport - Hollywood, and more.... "/>
	</a>
	
	<a href="#">
		<img src="<?php echo $data['rootUrl']; ?>global/images/banner3sl.jpg" alt="Leader in transportation since 1989" width="756" height="378" title="" alt="" rel="<h3>FREE ONBOARD</h3>Breakfast in AM services, Snacks in PM services, WI-FI INTERNET, SUPER KIDS, PLAY KIT."/>
	</a></div>
</div>
<div id="formularioH">
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
    <td colspan="2" class="titulos2forms"> <div class="form-row" id="dv_fr">  <input name="fecha_retorno" size="20" maxlength="10" class="input-text" id="fecha_retorno" readonly="readonly"  value="<?php echo date('m-d-Y',time()+84600);?>"/></div></td>
  </tr>
  
   <tr>
     <td colspan="4"><span class="niveltextoforms3"> Adult</span>
       <input type="number" name="pax" size="2" maxlength="5" class="input-text" id="pax" value="1" style="width:50px" min="1" required="required"  onchange=" 
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
            }"   /> 
       <span class="niveltextoforms3">Child<span class="titulos2forms">
       <input type="number" name="pax2" size="2" style="width:50px" maxlength="5" class="input-text" id="pax2"  value="0" min="0" required="required" onchange="
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
            }"/>
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
</div>

<div id="subBanner">
<div id="Sbanner1">
<div id="fotoBanner">
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="313" height="145">
    <param name="movie" value="<?php echo $data['rootUrl']; ?>global/swf/banner1.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    <param name="swfversion" value="6.0.65.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="<?php echo $data['rootUrl']; ?>global/swf/banner1.swf" width="313" height="145">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="transparent" />
      <param name="swfversion" value="6.0.65.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
     
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
</div>
<div class="titulosbanners" id="tituBanner">1 DAY TOUR TO ANY ATTRACTION</div>

</div>
<div id="separadorBanners"></div>
<div id="Sbanner2">
<div id="fotoBanner">
  <object id="FlashID2" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="313" height="145">
    <param name="movie" value="<?php echo $data['rootUrl']; ?>global/swf/banner2.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="8.0.35.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="<?php echo $data['rootUrl']; ?>global/swf/banner2.swf" width="313" height="145">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
       
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
</div>
<div class="titulosbanners" id="tituBanner">MULTI- DAYS TOURS TO ORLANDO </div>

</div>
<div id="separadorBanners"></div>
<div id="Sbanner3">
<div id="fotoBanner">
  <object id="FlashID3" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="313" height="145">
    <param name="movie" value="<?php echo $data['rootUrl']; ?>global/swf/banner3.swf" />
    <param name="quality" value="high" />
    <param name="swfversion" value="8.0.35.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="<?php echo $data['rootUrl']; ?>global/swf/banner3.swf" width="313" height="145">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="transparent" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
     
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
</div>
<div class="titulosbanners" id="tituBanner">ORLANDO'S HOTEL OF THE MONTH</div>

</div>
</div>

<div id="contendinfo">
<div id="mapmarcohome">

<div id="contenidohome1"><img src="<?php echo $data['rootUrl']; ?>global/images/Welcome-Supertours.jpg" width="307" height="41" /><br />
<p>The mission  of Super Tours  of Orlando is to make a  positive difference in traveling, primarily by offering to our guest the best  Customer Service and the Lowest Price, while making sure we exceed our guest  expectations... <a href="<?php echo $data['rootUrl']; ?>goal-supertours-of-orlando">Continue reading</a></p>
</div>


</div>
<div id="bannersRight">
<div id="bannerR1"><img src="<?php echo $data['rootUrl']; ?>global/images/banner.png" width="281" height="109" /></div>
<div id="bannerR2"><img src="<?php echo $data['rootUrl']; ?>global/images/banner2.png" width="281" height="109" /></div>
</div>
<div id="foot">
  <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
    Copyright ©  1989 - <?php echo date("Y"); ?> Supertours Of  Orlando, INC . All Rights Reserved.  <br />
    <p align="right">Developed by Supertours Of Orlando</p></h4>
</div>
</div> 


<script type="text/javascript">

          
     $("#from").change(function(){
         
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
     });
	 
	
         
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
			 
			 $("#dataclick1").click(function(e) {	



		e.preventDefault();



		$("#fecha_salida").datepicker("show");



	});
	
	$("#dataclick2").click(function(e) {	



		e.preventDefault();



		$("#fecha_retorno").datepicker("show");



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
   
</body>
</html>