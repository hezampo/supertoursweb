<?php $service_driver = $data["service_driver"];?>


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
	
<div id="header_page" >
<div class="header2">Service of Driver [ <? echo $data['dato'];?> ]</div>
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
    
<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/driver/service-driver/save" method="post" name="form1" enctype="multipart/form-data">
       <fieldset><legend>Informaci&oacuten general</legend>
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Name Driver: </label>
                   <select name="id_driver" id="id_driver" autofocus="autofocus" autocorrect="off" autocomplete="off" size="45" <? echo ($data['dato'] == "edit"?"readonly":'');?>>
                    <option value="" >Type name</option>
                      <?php foreach($data["driver"] as $e):?>
                      <option value="<? echo $e['id'];?>" data-alternative-spellings="fadsf"  <?php echo ($e["id"] == trim($service_driver->id_driver)?'selected':''); ?>  ><? echo $e['firstname'];?> <? echo $e['lastname'];?></option>
      
                       <?php endforeach;?>
                     </select>
    
            </div>
        
           
           <div class="input">
             
                <label style="width:150px" class="required" id="l_price">Service Type</label>
                
                <select name="id_service_type" class="select" style="width:150px;" id="id_service_type">
                       <option value=""></option> 
                      <?php foreach($data["type_service"] as $e):?>
                             <option value="<?php echo $e["id"]; ?>" <?php echo ($e["id"] == trim($service_driver->id_service_type)?'selected':''); ?> ><?php echo $e["name_service"]; ?></option>
                      <?php endforeach;?>
        </select>
                     
          </div>
            
            
            <div class="input">
            <table ><tr><td><label style="width:145px" id="l_price">Date: </label></td><td><input name="fecha" type="text"  id="fecha" size="10" maxlength="7"  value="<? echo date("m-d-Y",strtotime($service_driver->fecha)); ?>" /></td><td> <a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt="" width="19" height="20" border="0" /></a></td></tr></tr></table>
               
               
            </div>
           
             
              
          <div class="input">
            <label style="width:150px" class="required" id="l_price"></label>
          </div>
            
       <div class="input">
        
            </div>
           
             
            <input name="id" type="hidden" id="id" value="<? echo $service_driver->id; ?>" />
            </fieldset>
        </div>
       </div>
     


       
  </form>
   

</div>
	<script>
    
   
	  (function($){
	    $(function(){
	      $('#id_driver').selectToAutocomplete();
	     
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

        sErrMsg += validateText($('#role').val(), $('#l_role').html(), true);
        sErrMsg += validateText($('#descripcion').val(),$('#l_descripcion').html() , true);

        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    
    $('#btn-save').click(function(){
        //if (validateForm()){
           //validar();
           $('#form1').submit();
        //}
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>admin/driver/service-driver';
    })

</script>


