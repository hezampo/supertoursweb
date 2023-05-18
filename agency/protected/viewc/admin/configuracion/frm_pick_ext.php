<?php $pickdrop = $data["pickdrop"];
     
?><head>

</head>

<div id="header_page" >
<div class="header2">Pickup - Dropoff [ <? echo $data['dato'];?> ]</div>
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
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/pickup-dropoff/save" method="post" name="form1">
        <fieldset><legend>Informaci&oacuten general</legend>
        
            <div class="input">
                <label style="width:150px" class="required" id="place_1">Place: </label>
                <input type="text" name="place" id="place" size="50" maxlength="50" value="<?php echo $pickdrop->place; ?>"/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="address_1">Address: </label>
                <input type="text" name="address" id="address" size="50" maxlength="50" value="<?php echo $pickdrop->address; ?>"/>
            </div>
            
          
            <div class="input" id="opera">
                <label style="width:151px" class="required" id="l_trip_no">Extension</label>
                <select name="id_extension" class="select" style="width:150px;" id="id_extension">
                       <option value="0">Select Option</option>  
                      <?php foreach($data["extension"] as $e):?>
                             <option value="<?php echo $e["id"]; ?>"  <?php echo ($e["id"] == trim($pickdrop->id_extension)?'selected':''); ?>  ><?php echo $e["place"] ." ".$e['address']; ?></option>
                      <?php endforeach; ?>
        </select>
            </div>
     
            <input name="id" type="hidden" id="id" value="<? echo $pickdrop->id; ?>" />
      </fieldset>
            
        </div>
        </div>
    </form>
<div id="to"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">


/*$("select.select1").change(function () {
          var str = "";
          $("select.select1 option:selected").each(function () {
                
				///ajax
				
				if (id != "")
            $("#to").load('load5/' + id + );
				
				
              });
           
        })
        .change();*/

	

    function validateForm(){

        var sErrMsg = "";
        var flag = true;

       
        sErrMsg += validateText($('#place').val(),$('#place_1').html() , true);
        sErrMsg += validateText($('#address').val(),$('#address_1').html() , true);
      /* if (document.form1.id_area.selectedIndex==0){ 
      	 
      	 sErrMsg += "- debe seleccionar Area \n";
    	} */
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/pickup-dropoff/ext';
    })

</script>


