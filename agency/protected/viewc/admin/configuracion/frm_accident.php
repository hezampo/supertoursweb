<?php $accident = $data["accident"];?>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-autocomplete.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.select-to-autocomplete.js"></script>
<style type="text/css" media="screen">
	 
    .ui-autocomplete {
      padding: 0;
      list-style: none;
      background-color: #fff;
      width: 280px;
      border: 1px solid #B0BECA;
      max-height: 500px;
      overflow-y: scroll;
    }
    .ui-autocomplete .ui-menu-item a {
      border-top: 1px solid #B0BECA;
      display: block;
      padding: 4px 6px;
      color: #353D44;
      cursor: pointer;
    }
    .ui-autocomplete .ui-menu-item:first-child a {
      border-top: none;
    }
    .ui-autocomplete .ui-menu-item a.ui-state-hover {
      background-color: #D5E5F4;
      color: #161A1C;
    }
	</style>


    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/driver/accident-drag/save" method="post" name="form1" enctype="multipart/form-data">
       <div id="header_page" >
<div class="header2">Driver [ <? echo $data['dato'];?> ]</div>
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
    <fieldset><legend>Informaci&oacuten general</legend>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Name Driver: </label>
                   <select name="id_driver" id="driver" autofocus="autofocus" autocorrect="off" autocomplete="off" size="45" <? echo ($data['dato'] == ("edit")?'readonly':'');?> >
     
       <?php foreach($data["driver"] as $e):?>
      <option value="<? echo $e['id'];?>"  <? echo ($e['id'] == ($accident->id_driver)?'selected':'');?> ><? echo $e['firstname'];?> <? echo $e['lastname'];?></option>
      
         <?php endforeach;?>
       
         
      </select>
    
      
            </div>
        
            <div class="input">
            <table ><tr><td><label style="width:145px" id="fecha_1">Date: </label></td><td><input name="fecha" type="text"  id="fecha" size="10" maxlength="7"  value="<? echo ($accident->fecha != "" ?date("m-d-Y",$accident->fecha):""); ?>" /></td><td> <a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt="" width="19" height="20" border="0" /></a></td></tr></tr></table>
               
               
            </div>
           <div class="input">
          
                <label style="width:150px" class="required" id="reporte_1">Report:</label>
               <font face="Verdana, Arial, Helvetica, sans-serif"> <textarea name="reporte" id="reporte" cols="30" rows="5" ><? echo $accident->reporte; ?></textarea></font>
            </div>
              <div class="input">
          
                <label style="width:150px" class="required" id="l_price">Attached:</label>
                <input name="anexo" id="anexo" type="file" accept="image/*,application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
            </div>
            
          <div class="input">
            <label style="width:150px" class="required" id="l_price"></label>
          </div>
            <input name="ruta" type="hidden"  value="<? echo $accident->anexo; ?>" />
      
           
            <input name="id" type="hidden" id="id" value="<? echo $accident->id; ?>" />
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

        sErrMsg += validateText($('#fecha').val(), $('#fecha_1').html(), true);
        sErrMsg += validateText($('#reporte').val(),$('#reporte_1').html() , true);
		
		
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
       window.location = '<?php echo $data['rootUrl']; ?>admin/driver/accident-drag';
    })

</script>


