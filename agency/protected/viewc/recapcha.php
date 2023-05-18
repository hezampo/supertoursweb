<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>reCAPTCHA</title>
<style type="text/css">
      body {
        font-family: Helvetica, sans-serif;
        color: #000000;
        font-size: 12px;
        border: none;
        background-color: transparent;
      }
    </style></head>
  
  <?php

		//Llaves de la captcha 
		$captcha_publickey = "6Lf75dESAAAAALbHS0PLAzkbBD7lVZJFNSHM9fIR"; 
		$captcha_privatekey = "	6Lf75dESAAAAAPItCFp-CbuEJzsgsQyNqOsNul-4"; 
		$error_captcha=null; 
		
		if ($_POST){ 
		   $captcha_respuesta = recaptcha_check_answer ($captcha_privatekey, 
		$_SERVER["REMOTE_ADDR"], 
		$_POST["recaptcha_challenge_field"], 
		$_POST["recaptcha_response_field"]); 
		   if ($captcha_respuesta->is_valid) { 
		      //todo correcto 
		      //hacemos lo que se deba hacer una vez recibido el formulario válido 
		      echo "Todo correcto!"; 
		   }else{ 
		      //El código de validación de la imagen está mal escrito. 
		      echo "Has escrito mal el texto"; 
		      $error_captcha = $captcha_respuesta->error; 
		   } 
		} 

?>   
    
    
<body>
<form action="" method="post">

    <!-- ... your form code here ... -->

    <script type="text/javascript"
       src="http://www.google.com/recaptcha/api/challenge?k=6Lf75dESAAAAALbHS0PLAzkbBD7lVZJFNSHM9fIR">
    </script>
    <noscript>
       <iframe src="http://www.google.com/recaptcha/api/noscript?k=6Lf75dESAAAAALbHS0PLAzkbBD7lVZJFNSHM9fIR"
           height="300" width="500" frameborder="0"></iframe><br>
       <textarea name="recaptcha_challenge_field" rows="3" cols="40">
       </textarea>
       <input type="hidden" name="recaptcha_response_field"
           value="manual_challenge">
    </noscript>

    <!-- ... more of your form code here ... -->
<input type="submit" name="Button1" value="Submit">
  </form>


</body>

</html>