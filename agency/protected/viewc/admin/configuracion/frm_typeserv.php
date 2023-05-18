<?php $type_service = $data["type_service"];?>


  <div id="header_page" >
<div class="header2">Type of Service [ <? echo $data['dato'];?> ]</div>
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
  
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/driver/type-service/save" method="post" name="form1" enctype="multipart/form-data">
         <fieldset><legend>Informaci&oacuten general</legend>

            <div class="input">
                <label style="width:150px" class="required" id="name_service_1">Name Service: </label>
             
        <input name="name_service" type="text"  id="name_service" size="30" maxlength="30"  value="<? echo $type_service->name_service; ?>" />
      
      </div>
         <div class="input">
                <label style="width:150px" class="required" id="price_1">Price: </label>
             
        <input name="price" type="text"  id="price" size="10" maxlength="10"  value="<? echo $type_service->price; ?>" />
      
      </div>
           
            
          <div class="input">
            <label style="width:150px" class="required" id="l_price"></label>
          </div>
            
      <div class="input">
        
            </div>
            
            <input name="id" type="hidden" id="id" value="<? echo $type_service->id; ?>" />
            </fieldset>
        </div>
        </div>
    </form>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
 (function($){
	    $(function(){
	      $('select').selectToAutocomplete();
	     
	    });
	  })(jQuery);
	  
        
			$( "#fecha" ).datepicker({
				dateFormat:'mm-dd-yy',
				changeMonth: true, 
				changeYear: true, 
			    yearRange: '-100:+0'
			});

   $("#dataclick1").click(function(e) {	



		e.preventDefault();



		$("#fecha").datepicker("show");



	});



    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#name_service').val(), $('#name_service_1').html(), true);
        sErrMsg += validateText($('#price').val(),$('#price_1').html() , true);

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
       window.location = '<?php echo $data['rootUrl']; ?>admin/driver/type-service';
    })

</script>


