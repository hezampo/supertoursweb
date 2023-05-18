<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Supertours Of Orlando, Inc.</title>

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



$(".tab_content").hide();

	$("ul.tabs li:first").addClass("active").show();

	$(".tab_content:first").show();



	$("ul.tabs li").click(function()

       {

		$("ul.tabs li").removeClass("active");

		$(this).addClass("active");

		$(".tab_content").hide();



		var activeTab = $(this).find("a").attr("href");

		$(activeTab).fadeIn();

		return false;

	});



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



<body >



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

<div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />

From 4 am To Midnight - (Eastern Time) <br />

<strong>Hablamos Español</strong></div> </div>

</div>

<div id="barra">

<?php

	include_once('global/menu/menu1.php');?>

    </div>





<div id="policy">

<form action="<?php echo $data['rootUrl']; ?>contact" method="post">

  <table width="100%" border="0" cellspacing="10">

    <tr>

      <td width="35%" height="31"><h1><img src="<?php echo $data['rootUrl']; ?>global/images/Supertours-terminal.jpg" alt="" width="127" height="21" /></h1></td>

      <td colspan="2"><h1><img src="<?php echo $data['rootUrl']; ?>global/images/contact.jpg" width="121" height="21" /></h1></td>

    </tr>

    <tr>

      <td rowspan="3" valign="top"> <ul class="tabs">

    <li><a href="#tab1"> ORLANDO TICKET OFFICE  

 

</a></li>

  

</ul>



<div class="tab_container">

    <div id="tab1" class="tab_content">

          <iframe width="320" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com.co/maps/ms?msa=0&amp;msid=209411827224061447432.0004c1e9675774ed25a12&amp;ie=UTF8&amp;t=m&amp;ll=28.462504,-81.453152&amp;spn=0.003773,0.003412&amp;z=17&amp;output=embed"></iframe><br /><small>View <a href="https://www.google.com.co/maps/ms?msa=0&amp;msid=209411827224061447432.0004c1e9675774ed25a12&amp;ie=UTF8&amp;t=m&amp;ll=28.462504,-81.453152&amp;spn=0.003773,0.003412&amp;z=17&amp;source=embed" style="color:#0000FF;text-align:left">Supertours Of Orlando, Inc. </a> in a larger map</small>

    </div>

    

</div>

      

      

      

    </td>

      <td width="45%" height="140" valign="top">&nbsp;</td>

      <td width="20%" valign="top"><img src="<?php echo $data['rootUrl']; ?>global/images/contact.png" width="135" height="137" /></td>

    </tr>

    <tr>

      <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0">

        <tr>

          <td width="32%"><strong>Orlando  Tickets Office:</strong></td>

          <td width="68%" id="tdlinea">ORLANDO CROSSING MALL, 5419 International Drive, Orlando, Fl. 32819</td>

        </tr>

        <tr>

          <td ><p><strong>E-mail</strong>:</p></td>

          <td id="tdlinea">reservations@supertours.com</td>

        </tr>

        <tr>

          <td><p><strong>Phone From Orlando:</strong></p></td>

          <td id="tdlinea"> <p>1-407-370-3001</p></td>

        </tr>

        <tr>

          <td><p><strong>From USA and Puerto Rico:</strong>  </p></td>

          <td id="tdlinea"><p>1-800-251-4206 </p></td>

        </tr>

        <tr>

          <td><p><strong>From outside USA:</strong></p></td>

          <td><p>1-407-370-3001 </p></td>

        </tr>

        <tr>

          <td height="53">&nbsp;</td>

          <td>&nbsp;</td>

        </tr>

      </table></td>

    </tr>

    <tr>

      <td colspan="2" valign="top"><table width="100%" border="0">

        <tr>

          <td width="3%" height="27">&nbsp;</td>

          <td width="97%"><strong>Please use the form below to send us an e-mail:</strong></td>

        </tr>

        <tr>

          <td height="30">&nbsp;</td>

          <td height="30"><span id="name">Name (Required at least 2 characters)</span></td>

        </tr>

        <tr>

          <td height="27">&nbsp;</td>

          <td height="27"><input id="contact_name" name="contact_name" size="30" class="required" minlength="2" value="" /></td>

        </tr>

        <tr>

          <td><p>&nbsp;</p></td>

          <td><span id="email">E-Mail  (Required)</span></td>

        </tr>

        <tr>

          <td height="31">&nbsp;</td>

          <td height="31"><input id="contact_email" name="contact_email" size="30"  class="required email" value="" /></td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td><span id="phone">Phone (Required)</span></td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td><input id="contact_phone" name="contact_phone" size="14" class="phone" value="" maxlength="14" /></td>

        </tr>

        <tr>

          <td height="18">&nbsp;</td>

          <td height="18"><span id="comments">Your comments (Required)</span></td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td><textarea id="contact_message" name="contact_message" cols="70" rows="7" class="required"></textarea></td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td><button  class="btn2" id="btn-continue">Enviar</button></td>

        </tr>

      </table>

        <p>&nbsp;</p>

        <p>&nbsp;</p></td>

    </tr>

  </table>

  </form>

  <h1>&nbsp;</h1>

</div>













<div id="foot">

  <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />

    Copyright ©  1989 - <?php echo date("Y"); ?> Supertours Of  Orlando, INC . All Rights Reserved.  </h4>

</div>

</div>



		<script>



			



$("#btn-continue").click(function(){

      var msg = ""; 

     var p1 = $("#contact_name").val();

	 var p3 = $("#contact_phone").val();

     var d1 = $("#contact_email").val();

     var p2 = $("#contact_message").val();

      

      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

      

	  

      

        if ( p1.length <= 2){

            msg += $('#name').html() + "\n";

			}

			

      

    

       if (!emailReg.test(d1) || d1 == ""){

        msg += $('#email').html() + " Enter a valid email address \n";  

      }

	    if (!p3){

       if (p2 == "")

        msg += $('#phone').html() + " \n";

      }

      if (!p2){

       if (p2 == "")

        msg += $('#comments').html() + " \n";

      }

     

     

      if (msg!=""){

          alert(msg);

          return false;

      }

      

      return true;

          

   });

        </script>

</body>

</html>

