<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>
 <div id="formu" >
        
        <form id="form1" class="form" action="http://localhost/supertoursface2/admin/bus/save" method="post" name="form1">
        <h4 class="titleform">Bus Information</h4>
        
          

           
        
           <div class="input">        
          <label style="width:150px" id="plate_1">Plate: </label>
          <input name="plate" type="text"  id="plate" size="20" maxlength="10" value=""  />
        </div>
        
        <div class="input">        
          <label style="width:150px" id="tipo_1">Bus Type: </label>
          <input name="tipobus" type="text"  id="tipobus" size="20" maxlength="10" value="" />
        </div>
          
        
        <div class="input">  
         <label style="width:150px" id="capacidad_1">Capacity: </label>
               
         <input name="capacidad" type="text"  id="capacidad" size="5" maxlength="6"  value="" />
        </div>
      <div class="input">  
         <label style="width:150px" id="fecha_ini_1">Start Date:</label>
         
         <input name="fecha_ini" type="text"  id="fecha_ini" size="8" maxlength="6"  value=""/>
      </div>
      
       <div class="input">  
         <label style="width:150px" id="fecha_fin_1">End Date:</label>
         
         <input name="fecha_fin" type="text"  id="fecha_fin" size="8" maxlength="6"  value=""/>
      </div>
       
<label style="width:150px" class="required" id="l_frecuency"></label>
           <div class="button-bar">
            
            <button class="button right" type="button" id="btn-saves"><span class="icon-save16">Save</span></button>  <input name="superbox" type="hidden" id="id" value="" />
            <input name="id" type="hidden" id="id" value="" />
        </div>
    </form><script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
     <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js">
	 
     </script>  
       <script>
	    $( "#fecha_ini" ).datepicker({
        dateFormat:'mm-dd-yy',
		 maxDate:         365,
         minDate:         0,
    });

    $( "#fecha_fin" ).datepicker({
        dateFormat:'mm-dd-yy',
		maxDate:         365,
        minDate:         0,
    });
	
	
	function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#plate').val(), $('#plate_1').html(), true);
        sErrMsg += validateText($('#tipobus').val(), $('#tipo_1').html(), true);
		sErrMsg += validateNumber($('#capacidad').val(), $('#capacidad_1').html(), true);
		
		sErrMsg += validateText($('#fecha_ini').val(), $('#fecha_ini_1').html(), true);
		sErrMsg += validateText($('#fecha_fin').val(), $('#fecha_fin_1').html(), true);
		
		if(sErrMsg != "")
		 {
            alert(sErrMsg);
            flag = false;
         }

        return flag;

    }
	
	
	 $('#btn-saves').click(function(){
        if (validateForm()){
          $('#form1').submit();
        }
    })
    
    
	
	   </script>
        </div>
