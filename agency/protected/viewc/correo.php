<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
</head>

<body>

<form action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/recover" method="post">
  <table border="0">
    <tr><td>E-Mail:</td>
      <td><input name="email" id="email" type="text" />
      </td>
    </tr>
    <tr>
      <td></td>
      <td><button  class="btn" id="btn-continue">Enviar</button></td>
    </tr>
  </table>
</form>
 
</body>

<script type="text/javascript">
    
   $("#btn-back").click(function(){
      window.location = '<?php echo $data['rootUrl']; ?>booking'; 
   });
   
   $("#btn-continue").click(function(){
      var sErrMsg = ""; 
     
      
      sErrMsg += validateEmail($('#email').val(),$('#email').html() , true);
      
      
      if (sErrMsg != ""){
          alert(sErrMsg);
          return false;
      }
      
      return true;
          
   });
   
   
</script>    
</html>
