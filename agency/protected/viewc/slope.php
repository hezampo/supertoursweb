<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Supertours Of Orlando, Inc.</title>



<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />

<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<script src="<?php echo $data['rootUrl']; ?>global/lightbox/jquery-latest.js"></script>

  <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css"> 



<script src="<?php echo $data['rootUrl']; ?>global/lightbox/thickbox.js"></script>



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



<div id="container">

 <?php 

 if(isset($_SESSION['booking'])){

 $booking = $_SESSION['booking'];

 }

  ?>   

 <div id="header">

    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>

   <div style="display:inline; float:right;">

                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>

     <?php if(isset($_SESSION['user'])){ ?>          

      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>

     <?php } ?>

   </div>

    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>

 </div>

  <div id="topnav">

  

  

  

  </div>

  <div id="content">

   

    <div id="center-column" align="center">

       <p align="center"><h1>AGENCY ALREADY REGISTERED</h1> </p>

            

</div> 

          

            <div id="users"></div>

         </form>

       </blockquote>

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

 

</div>

<div id="element_id"></div>

</body>















   

</html>