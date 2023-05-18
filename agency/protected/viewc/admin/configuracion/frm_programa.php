<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>


<div id="header_page" >
<div class="header2">Scheduling [ <? echo $data['dato'];?> ]</div>
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
    <?php  $prog = $data['prog'] ?>
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/schedule/update" method="post" name="form1">
       <fieldset><legend>General Information</legend>

        <div class="input">
            <label style="width:150px" id="anno_1">Year</label>
            <input name="anno" type="text" id="anno"  size="10" maxlength="4" value ="<?php echo $prog->anno; ?>"/>
        </div>
        
        <div class="input">        
          <label style="width:150px" id="l_fechaini">Date</label>
          <input name="fecha" type="text"  id="fecha" size="20" maxlength="10"  value="<?php echo $prog->fecha; ?>" />
        </div>
                        
        <div class="input">
            <label style="width:150px" class="required" id="1_viaje">Trip</label>
            <input name="viaje" type="text"  id="viaje" size="20" maxlength="10"  value="<?php echo $prog->trip_no; ?>"/>
        </div> 
        
         <div class="input">
            <label style="width:150px" class="required">Status</label>
            <select name="estado">
              <option value="1" <?php echo ($prog->estado == '1'?'selected':''); ?>>Active</option>
              <option value="0" <?php echo ($prog->estado == '0'?'selected':''); ?>>Inactive</option>
            </select>
         </div>     
        
        <input type="hidden" name="id" value="<?php echo $prog->id; ?>" />

       
        </fieldset>
</div>
</div>
    </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
<script type="text/javascript">
 
    $("#fecha").datepicker({
        dateFormat:'mm-dd-yy'
    });

    
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateNumber($('#anno').val(), $('#anno_1').html(), true);
        sErrMsg += validateDate($('#fecha').val(), $('#l_fechaini').html(), true);
        sErrMsg += validateNumber($('#viaje').val(), $('#1_viaje').html(), true);
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
        window.location = '<?php echo $data['rootUrl']; ?>admin/home';
    })
    
</script>    