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
<meta NAME="Distribution" CONTENT="Global">
<meta NAME="Robots" CONTENT="All">
<link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/js/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/mysuperclub.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript">

$(document).ready(function() {		
	
	 $("#btn_login").click(function(){
		 var user = $("#user").val();
		 var pass = $("#pass").val();
		 
		 if(user && pass){
			 $("#form1").submit();
		 }else{			 
			 message("Error!, user and password are required.");
		 }
	 });
	 
	 $("#newm").click(function(){	 
		 window.location = "<?php echo $data['rootUrl']; ?>mysuperclub/singup";
	 });
	 
	 $("#forgot").click(function(){	 
		 //window.location = "<?php echo $data['rootUrl']; ?>mysuperclub/singup";
	 });
	 	
	function message(mensage){
		$("#mensage").css("display","none");
		$("#mensage").html(mensage).fadeIn(1000);
	}
	
	$("#welcome").fadeIn(4000);
});

</script>
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
  <div id="redes">
    <div id="iconos">
      <div id="redesGo"></div>
      <div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div>
      <div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div>
    </div>
    <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
      From 4 am To Midnight - (Eastern Time) <br />
      <strong>Hablamos Español</strong></div>
  </div>
</div>
<div id="barra">
  <nav id="topNav">
    <ul>
      <li class="last"><a href="<?php echo $data['rootUrl']; ?>" title="Home">HOME</a></li>
      <li><a href="<?php echo $data['rootUrl']; ?>goal-supertours-of-orlando" title="OUR COMPANY">OUR COMPANY</a>
        <ul>
          <li><a href="<?php echo $data['rootUrl']; ?>goal-supertours-of-orlando" title="Our Goal">Our Goal</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>fleet-terminal-supertours" title="Fleet And Terminal">Fleet And Terminal</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>free-onboard" title="Red Carpet Class">Red Carpet Class </a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>charters-miami-orlandol" title="Charters"> Charters</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours" title="Contact Us">Contact Us</a> </li>
        </ul>
      <li><a href="<?php echo $data['rootUrl']; ?>destinations-florida" title="WHERE WE GO">OUR DESTINATIONS</a> </li>
      <li><a href="<?php echo $data['rootUrl']; ?>" title="Coming soon">TOURS</a>
        <ul>
          <li><a href="<?php echo $data['rootUrl']; ?>1-day-tour" title="1 Day Tour">1 Day Tour</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>multi-days-tours" title="Multi-Days Tours">Multi-Days Tours</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>hotel-month" title="Hotels">Hotels</a></li>
        </ul>
      </li>
      <li><a href="#" title="Coming soon">MY SUPERCLUB</a></li>
      <li><a href="<?php echo $data['rootUrl']; ?>" title="Coming soon">TRAVEL AGENTS</a></li>
      <li><a href="<?php echo $data['rootUrl']; ?>" title="INFORMATIONS">INFORMATION</a>
        <ul>
          <li><a href="<?php echo $data['rootUrl']; ?>tickets-policy-supertours" title="Tickets Policy ">Tickets Policy</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>baggage" title="Baggage">Baggage</a></li>
          <li><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours" title="Contact Us">Contact Us</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
<div id="policy">
<div id="contendinfo">
  <div id="mapmarcohome">
    <div id="separadorTInter"></div>
    <div id="contenido"> 
      <!-- contenido principal -->
      <div id="side1">
        <div id="welcome"></div>
        <div id="info"> The mission of Super Tours  of Orlando is to make a positive difference in traveling, primarily by offering to our guest the best Customer Service and the Lowest Price, while making sure we exceed our guest  expectations... Continue reading </div>
      </div>
      <div id="side2">
        <div id="login2">
          <form id="form1" method="post" action="<?php echo $data['rootUrl']; ?>mysuperclub/login">
            <table width="261" border="0">
              <tr>
                <td width="60" class="lbl">Enter your membership number</td>
              </tr>
              <tr>
                <td width="191" class="txt"><input name="user" id="user" type="text"></td>
              </tr>
              <tr>
                <td class="lbl">Enter your membership password</td>
              </tr>
              <tr>
                <td class="txt"><input name="pass" type="password" id="pass"></td>
              </tr>
            </table>
          </form>
          <div id="mensage"><?php echo $this->data["error"] ?></div>
        </div>
        <div>
          <div id="login_options"> <a id="forgot" href="#">Forgot password? </a>| <a  id="newm" href="#">New member</a> </div>
          <div id="btn_login" class="mybutton"><a href="#">Login</a></div>
          <div id="rewards"><img src="<?php echo $data['rootUrl']; ?>global/img/mysuperclub/5.png"/></div>
          <div id="rewards_inforations">
            <ul>
              <li>A FREE ticket, after 10 trips paid</li>
              <li>A free ticket on your birthday week</li>
              <li>Exclusive offers for members of SUPER CLUB</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- contenido principal --> 
    </div>
  </div>
  <div id="foot">
    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
      Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved. </h4>
  </div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script> 
<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script> 
<script>
(function(){
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
	
	$("#from").change(function(){
	   var id = $("#from").val();
       if (id != "")
	   $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
   });
   
   var id = $("#from").val();
   
   if (id != "")
   		$("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));

});
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