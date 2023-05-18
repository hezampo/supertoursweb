
<?php $grupo_parque = $data["grupo_parque"];

?>
<div id="header_page" >
<div class="header2">(park) Group [ <? echo $data['dato'];?> ]</div>
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
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/group-parks/save" method="post" name="form1" >
       
        <div class="input">        
          <label style="width:150px" id="l_fechafin">Name Group: </label>
          <input name="nombre" type="text"  id="nombre" size="25" maxlength="25" value="<?php echo $grupo_parque->nombre;?>" />
        </div>
        <div class="input">        
          <label style="width:150px" id="l_fechafin">Reference Code: </label>
          <input name="code_refe" type="text"  id="code_refe" size="25" maxlength="25" value="<?php echo $grupo_parque->code_refe;?>" />
        </div>
      
            <input name="id" type="hidden" id="id" value="<? echo $grupo_parque->id; ?>" />
            </fieldset>
            </div>
        </div>
    </form>

</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
if ($("#trip_from").val() != ""){
      $("#trip_to").load('<?php echo $data['rootUrl']; ?>load/' + $("#trip_from").val(), function(){
        $("#trip_to").val('');
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
        window.location = '<?php echo $data['rootUrl']; ?>admin/tours/group-parks';
    })
    

   

</script>


