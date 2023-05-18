
<div id="header_page" >
<div class="header2">Scheduling</div>
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

    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/schedule/update2" method="post" name="form1">
       <fieldset><legend>General Information</legend>

        <div class="input">
            <label style="width:150px" id="anno_1">Year</label>
            <input name="anno" type="text" id="anno"  size="10" maxlength="4"/>
        </div>
        
                            
        <!--div class="input">
            <label style="width:150px" class="required" id="1_viaje">Viaje</label>
            <input name="viaje" type="text"  id="viaje" size="20" maxlength="10"  value=""/>
        </div--> 
        
        <div class="input">
            <label style="width:150px" class="required" id="1_viaje">Trip</label>            
			<select name="trip_no" id="trip_no" maxlenght="10" class="select">                
                 <?php 
				
				$sql = 'SELECT trip_no FROM trips';

                $rs = Doo::db()->query($sql);
               
				while($datos = $rs->fetch()){ ?>
                 <option value="<?php echo $datos["trip_no"]; ?>"><?php echo $datos["trip_no"]; ?>
                 </option>
                <?php } ?>                   
            </select>
        </div>
        
         <div class="input">
            <label style="width:150px" class="required">Status</label>
            <select name="estado">
              <option value="1" >Active</option>
              <option value="0" >Inactive</option>
            </select>
         </div>     
        
      
       
        </fieldset>
</div>
</div>
    </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
<script type="text/javascript">

      
    $('#btn-save').click(function(){
           $('#form1').submit();   
    })
    
    $('#btn-cancel').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/home';
    })
    
</script>  