<link href="css/slideLock.css" rel="stylesheet" type="text/css" media="screen" /> 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<script type="text/javascript" src="js/jquery.slideLock.js"></script>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript">
	$(document).ready(function() { 
		$("#test_form").slideLock({  
		labelText: "Verificación :", 
		noteText: "Dezplaza el interruptor a la derecha  ", 
		lockText: "Bloqueado", 
		unlockText: "Desbloqueado", 
		iconURL: "images/chrome/arrow_right.png", 
		inputID: "sliderInput", 
		onCSS: "#333", 
		offCSS: "#aaa", 
		inputValue: 1, 
		saltValue: 9, 
		checkValue: 10, 
		js_check: "js_check", 
		submitID: "#submit"  
		});  
	});
</script>
</head>

<body>
<?php
if(isset($_POST['submit'])) {  // check to see if JavaScript is disabled 
	if(isset($_POST['sliderInput']) && $_POST['sliderInput'] == 10) { 
		echo "Ha pasado el control";
	}else{		
		echo "No ha pasado control";
	}
}
else{
?>
	
    <form action="prueba.php" method="post" class="hform" id="test_form">
    
        
<input type="submit" name="submit" id="submit" value="Submit" />
            
            <input type="hidden" name="js_check" id="js_check" value="0" />
       
    </form>
<?php
}
?>
</body>
