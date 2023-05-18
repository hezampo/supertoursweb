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

<script src="<?php echo $data['rootUrl']; ?>global/lightbox/thickbox.js"></script>
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/lightbox/thickbox.css" type="text/css" media="screen" />
</head>
<body>
    
 <?php
 // $booking = $_SESSION['booking'];
  
 

 ?>
<div id="container">
 
 <div id="header">
    <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
    <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
 </div>
 <div id="topnav"></div>
 <div id="content">
    
     <div id="center-column">
      <table id="tablelogin" width="100%" border="0">
    <tr>
    <td width="64%" rowspan="2">
       <table width="100%" border="0" cellspacing="5">
  <tr>
    <td width="7%"><img src="<?php echo $data['rootUrl']; ?>global/img/registered.jpg" /></td>
    <td width="93%"><h2>Registered user   </h2>
    </td>
  </tr>
  <tr>
    <td colspan="2" ><br />
<div id="login"> 
            
           
            <div id="bd-login">

                <?php if (isset($data['error'])) {
				
                ?>
                    <div class="error"><?php echo $data['error'] ?></div>
                <?php } ?>

                <form name="form1" action="<?php echo $data['rootUrl']; ?>tours/autentication/login" method="post">
                    <div id="user-info">

                       <label style="width:150px">User:</label> 
                                      <p class="input">
                            
                            <input name="usuario" type="text" size="37" maxlength="35" class="inputText" id="usuario" />
                        </p>
                        <label style="width:150px">Password</label>
                        :
                        <p class="input" style="margin-top:15px;">
                            
                            <input name="password" type="password" size="37" maxlength="30" class="inputText" id="password" />                       </p>

                    </div>
                     
					<br  class="clear"/>
                    <div class="button-bar center">
                        <button class="btn"><span class="icon-login16">ENTER</span></button> 
                    </div>
                     <p align="right"><a href="" onclick="pre()" title="add a caption" class="thickbox" >Forgot my password</a></p>
                    
                 
                </form>

            </div></td>
  </tr>
</table>

      

       </td>
    <td width="5%"><img src="<?php echo $data['rootUrl']; ?>global/img/new-user.jpg" /></td>
    <td width="31%"><h2>New user</h2> </td>
    </tr>
    <tr>
      <td colspan="2"><div id="createacon" >If you do not have an account , create one.<br />
<a href="<?php echo $data['rootUrl']; ?>tours/signup">signup</a></div> <br />
<button  class="btn" id="btn-back" type="button">Back   </button>   </td>
    </tr>
      </table>

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
<script type="text/javascript">
    
	function pre()
	{
	   var id = id = 0;
			  var otro= "TB_iframe?height=150&width=330";
			
              $("a#thickbox").load(tb_show("Recovery Password ","<?php echo $data['rootUrl']; ?>load4/" + id + otro,"media/loadingAnimation.gif"));
	}
	
   $("#btn-back").click(function(){
      window.location = '<?php echo $data['rootUrl']; ?>booking'; 
   });
   
   $("#btn-continue").click(function(){
      var msg = ""; 
      var p1 = $("#pickup1").val();
      var d1 = $("#dropoff1").val();
      var p2 = $("#pickup2").val();
      var d2 = $("#dropoff2").val();
      
      
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
      if (!p2){
        if (d2 == "")
          msg += $('#r2').html() + " DropOff is required\n";  
      }
      
      if (msg!=""){
          alert(msg);
          return false;
      }
      
      return false;
          
   });
   
   
</script>    
   
</html>