<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>
<?php $bus = $data["bus"];

?>
<div id="header_page" >
<div class="header2">Trip [ <?php echo $data['dato'];?> ]</div>
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar" id="btn-save">
                        <a   class="link-button" id="btn-save">
                            <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                            Save
                        </a>
                    </li>

                    <li class="btn-toolbar" id="btn-cancel">
                        <a  class="link-button" >
                            <span class="icon-back" title="Editar" >&nbsp;</span>
                            Cancel
                        </a>
                    </li>

                 

                   

                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
<div id="content_page" >
        <div id="serpare">
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/bus/save" method="post" name="form1">
       <fieldset><legend>General information</legend>
        
           <div class="input">        
          <label style="width:150px" id="plate_1">Plate: </label>
          <input name="plate" type="text"  id="plate" size="20" maxlength="15" value="<?php echo $bus->plate;?>"
		  <?php 
					if($data['dato'] == 'edit'){
						echo 'readonly';
						echo '   style="background:#DFDFE1;"';
					}
				?>  />
        </div>
        
        <div class="input">        
          <label style="width:150px" id="tipobus_1">Bus Type: </label>
          <input name="tipobus" type="text"  id="tipobus" size="20" maxlength="10" value="<?php echo $bus->tipobus;?>" />
        </div>
          
        
        <div class="input">  
         <label style="width:150px" id="capacidad_1">Capacity: </label>
               
         <input name="capacidad" type="number" style="width:80px;"  id="capacidad" size="5" min="1"   value="<?php echo $bus->capacidad; ?>" />
        </div>
      <div class="input">  
         <label style="width:150px" id="fecha_ini_1">Start Date:</label>
         
         <input name="fecha_ini" type="text"  id="fecha_ini" size="8" value="<?php echo ($bus->fecha_ini == ""?'': date("m-d-Y" , $bus->fecha_ini)); ?>" onchange="fechaFinal(this.value);"/>
      </div>
      
       <div class="input">  
         <label style="width:150px" id="fecha_fin_1">Final Date:</label>
         
         <input name="fecha_fin" type="text"  id="fecha_fin" size="8" maxlength="6"  value="<?php echo ($bus->fecha_fin == ""?'': date("m-d-Y" , $bus->fecha_fin));?>"/>
      </div>
       
<label style="width:150px" class="required" id="l_frecuency"></label>
           
            <input name="id" type="hidden" id="id" value="<? echo $bus->id; ?>" />
            </fieldset>
       </div>
       </div>
    </form>

</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
if ($("#trip_from").val() != ""){
      $("#trip_to").load('<?php echo $data['rootUrl']; ?>load/' + $("#trip_from").val(), function(){
        $("#trip_to").val('');
      });   
   }
   
   
   function fechaFinal(menor){
	 /*var d = new Date(menor);
	 d.setTime( d.getTime()+1*24*60*60*1000 )
	$('#fecha_fin').datepicker('option', 'minDate',d );*/
	}
	
	
   $("#trip_from").change(function(){
        var id = $("#trip_from").val();
        if (id != "")
            $("#trip_to").load('<?php echo $data['rootUrl']; ?>load/' + id);
    });
	
	 $( "#fecha_ini" ).datepicker({
        dateFormat:'mm-dd-yy'/*,
		 maxDate:         365,
         minDate:         0,*/
    });

    $( "#fecha_fin" ).datepicker({
        dateFormat:'mm-dd-yy'/*,
		maxDate:         365,
        minDate:         0,*/
    });
	
     function validateForm(){

        var sErrMsg = "";
        var flag = true;
        
        
       sErrMsg += validateText($('#plate').val(), $('#plate_1').html(), true);
	   sErrMsg += validateText($('#tipobus').val(), $('#tipobus_1').html(), true);
	   
	   
	    var errorCapacity = validateText($('#capacidad').val(), $('#capacidad_1').html(), true);
	   if(errorCapacity == ''){
		     sErrMsg += validateNumberPositivo($('#capacidad').val(), $('#capacidad_1').html(), true);
	   }else{
		    sErrMsg += '- Capacity: Is required number \n';
	   }
	   
	   
	   if(!ValidarFecha($('#fecha_ini').val())){
		    sErrMsg += '- Incorrect start date \n';
	   }
	   
	   if(!ValidarFecha($('#fecha_fin').val())){
		    sErrMsg += '- Incorrect start date \n';
	   }
		if(sErrMsg != "")
		{
            alert(sErrMsg);
            flag = false;
        }
        return flag;

    }
    
    $('#btn-save').click(function(){
        if (validateForm()){
            $('#form1').submit();
        }
    })
    
    $('#btn-cancel').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/bus';
    })
    

   

</script>


