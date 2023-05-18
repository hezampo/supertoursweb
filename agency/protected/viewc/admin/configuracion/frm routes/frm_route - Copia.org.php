<?php $trip = $data["trip"];?>
<div id="header_page" >
<div class="header2">Route [ <? echo $data['dato'];?> ]</div>
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
    
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/routes/save" method="post" name="form1">
        <fieldset><legend>General Information</legend>

            <div class="input">
                <label style="width:150px" class="required" id="l_trip_from">Departure</label>
                <select name="trip_from" id="trip_from" class="select">
                  <option value="0">Select Option</option>  
                  <?php foreach($data["areas"] as $e):?>
                       <option value="<?php echo $e["id"]; ?>" <?php echo ($trip->trip_from == trim($e['id'])?'selected':''); ?>><?php echo $e["nombre"]; ?></option>
                   <?php endforeach;?>
                </select>
            </div>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_to">Arrival</label>
                <select name="trip_to" id="trip_to" class="select">
                  <option value="0">Select Option</option>    
                  <?php foreach($data["areas"] as $e):?>
                       <option value="<?php echo $e["id"]; ?>" <?php echo (trim($trip->trip_to) == trim($e['id'])?'selected':''); ?>><?php echo $e["nombre"]; ?></option>
                   <?php endforeach;?>
                </select>
            </div> 
        
            <div class="input">
                <label style="width:150px" class="required">Trip</label>
                <select name="trip_no" id="trip_no" class="select">
                  <option value=""></option>    
                  <?php foreach($data["tripsnumber"] as $e):?>
                       <option value="<?php echo $e["trip_no"]; ?>" <?php echo ($trip->trip_no == $e['trip_no']?'selected':''); ?>><?php echo $e["trip_no"]; ?></option>
                   <?php endforeach;?>
                </select>
            </div> 
        
            <div class="input">
                <label style="width:150px" class="required" id="price_1">Adult Price</label>
                <input name="price" type="text"  id="price" size="10" maxlength="7"  value="<? echo $trip->price; ?>" />
            </div>
           <div class="input">
                <label style="width:150px" class="required" id="price_2">Child Price</label>
                <input name="price2" type="text"  id="price2" size="10" maxlength="7"  value="<? echo $trip->price2; ?>" />
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="price_3">Child Price R.</label>
                <input name="price3" type="text"  id="price3" size="10" maxlength="7"  value="<? echo $trip->price3; ?>" />
            </div>
            
            <div class="input">
                <label style="width:150px" class="required" id="price_3">Adult Price R.</label>
                <input name="price4" type="text"  id="price3" size="10" maxlength="7"  value="<? echo $trip->price3; ?>" />
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_departure">Departure Time</label>
                <input name="trip_departure" type="text"  id="trip_departure" size="10" maxlength="7"  value="<? echo $trip->trip_departure; ?>" />
            </div>
        
             <div class="input">
                <label style="width:150px" class="required" id="l_trip_arrival">Arrival Time</label>
                <input name="trip_arrival" type="text"  id="trip_arrival" size="10" maxlength="7"  value="<? echo $trip->trip_arrival; ?>" />
            </div>
			
			 <div class="input">
                <label style="width:150px" class="required" id="l_anno">Year</label>
                <input name="anno" type="text"  id="anno" size="10" maxlength="7"  value="<? echo $trip->anno; ?>" />
            </div>
          

            <input name="type_rate" type="hidden" id="type_rate" value="<? echo $trip->type_rate; ?>" />
            <input name="id" type="hidden" id="id" value="<? echo $trip->id; ?>" />
       </fieldset></div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#price').val(), $('#price_1').html(), true);
        sErrMsg += validateText($('#price2').val(),$('#price_1').html() , true);
        sErrMsg += validateText($('#price3').val(),$('#price_3').html() , true);
		sErrMsg += validateText($('#trip_departure').val(),$('#l_trip_departure').html() , true);
		sErrMsg += validateText($('#trip_arrival').val(),$('#l_trip_arrival').html() , true);
		sErrMsg += validateText($('#anno').val(),$('#l_anno').html() , true);
		
		if (document.form1.trip_from.selectedIndex==0){ 
      	 
      	 sErrMsg += "- debe seleccionar Partida \n";
   	} 
		if (document.form1.trip_to.selectedIndex==0){ 
      	 
      	 sErrMsg += "- debe seleccionar Llegada \n";
   	} 
		if (document.form1.trip_no.selectedIndex==0){ 
      	 
      	 sErrMsg += "- debe seleccionar Number Trip \n";
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
           //validar();
           $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>admin/routes';
    })

</script>


