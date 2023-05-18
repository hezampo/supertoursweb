<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>
<?php $ofertas = $data["ofertas"];

?>
<div id="header_page" >
<div class="header2">Deals [ <? echo $data['dato'];?> ]</div>
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
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/ofertas/save" method="post" name="form1">
        <fieldset><legend>Informaci&oacuten general</legend>
        <table><tr><td>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">From: </label>
                <select name="trip_from" class="select" style="width:150px;" id="trip_from">
                       <option value=""></option> 
                      <?php foreach($data["areas"] as $e):?>
                             <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == trim($ofertas->trip_from)?'selected':''); ?> ><?php echo $e["nombre"]; ?></option>
                      <?php endforeach;?>
        </select>
            </div>
			</td></tr>
            <tr><td><div class="input">
                <label style="width:150px" class="required" id="l_equipment">To: </label>
                <select name="trip_to" class="select" id="trip_to" style="width:150px;">
                       
                   </select>
               
			</div></td></tr>
        
           <tr><td><div class="input">        
          <label style="width:150px" id="l_fechaini">Initial date: </label>
          <input name="fecha_ini" type="text"  id="fecha_ini" size="20" maxlength="10" value="<?php echo ($ofertas->fecha_ini == ""?'': date("m-d-Y" , $ofertas->fecha_ini)); ?>"  />
           </div></td></tr>
        
        <tr><td><div class="input">        
          <label style="width:150px" id="l_fechafin">Ending date: </label>
          <input name="fecha_fin" type="text"  id="fecha_fin" size="20" maxlength="10" value="<?php echo ($ofertas->fecha_fin == ""?'': date("m-d-Y" , $ofertas->fecha_fin));?>" />
        </div></td></tr>
          <tr><td><div class="input">
            <label style="width:150px" class="required">Trip:</label>
            
<select name="trip_no" id="trip_no" class="select">
                <option value="">All</option>    
                <?php foreach ($data["viajes"] as $e): ?>
                 <option value="<?php echo $e["trip_no"]; ?>" <?php echo ($e["trip_no"] == trim($ofertas->trip_no)?'selected':''); ?> ><?php echo $e["trip_no"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div></td></tr> 
        <tr><td><div class="input">        
          <label style="width:150px" id="l_fechafin">Price Resident Adult:</label>
          $
          <input name="price4" type="text"  id="price4" size="8" maxlength="6" value="<?php echo $ofertas->price4;?>" />
        </div></td></tr>
        <tr><td><div class="input">  
         <label style="width:150px" id="l_fechafin">Price Resident Child:</label>
         
          $
         <input name="price3" type="text"  id="price3" size="8" maxlength="6"  value="<?php echo $ofertas->price3;?>"/>
        </div></td></tr>
        <tr><td><div class="input">  
         <label style="width:150px" id="l_fechafin">Price Regular Adult:</label>
         
          $
         <input name="price" type="text"  id="price" size="8" maxlength="6"  value="<?php echo $ofertas->price;?>" />
        </div></td></tr>
      <tr><td><div class="input">  
         <label style="width:150px" id="l_fechafin">Price Regular Child:</label>
         
          $
         <input name="price2" type="text"  id="price2" size="8" maxlength="6"  value="<?php echo $ofertas->price2;?>"/>
      </div></td></tr>
          <input name="id" type="hidden" id="id" value="<? echo $ofertas->id; ?>" />
		  </table>
            </fieldset>
        </div>
        </div>
    </form>

</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
if ($("#trip_from").val() != ""){
      $("#trip_to").load('<?php echo $data['rootUrl']; ?>load/' + $("#trip_from").val(), function(){
        $("#trip_to").val('<?php echo $ofertas->trip_to; ?>');
      });   
   }
   
   
   
   $("#trip_from").change(function(){
        var id = $("#trip_from").val();
        if (id != "")
            $("#trip_to").load('<?php echo $data['rootUrl']; ?>load/' + id);
    });
	
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

        
       

        return flag;

    }
    
    $('#btn-save').click(function(){
        if (validateForm()){
            $('#form1').submit();
        }
    })
    
    $('#btn-cancel').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/ofertas';
    })
    

   

</script>


