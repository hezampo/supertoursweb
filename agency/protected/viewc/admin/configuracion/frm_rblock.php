<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>


<?php $ratesblock = $data["ratesblock"];?>
<div id="header_page" >
<div class="header2">(Hotel) Block Dates [ <? echo $data['dato'];?> ]</div>
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

             <fieldset><legend>General Information</legend>
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/block-rates/save" method="post" name="form1">
        

            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Name Category: </label>
                  <select name="id_hotel">
               <?php foreach($data["hotel"] as $e):?>
                  
                       <option value="<?php echo  $e['id']; ?>"  <?php echo ($ratesblock->id_hotel == trim($e['id'])?'selected':''); ?>><?php echo $e["nombre"]; ?></option>
                   <?php endforeach;?>
               </select>
            </div>
        
            <div class="input">
            
                <label style="width:150px" class="required" id="l_price">Starting Date : </label>
                <input name="fecha_ini" type="text"  id="fecha_ini" size="10" maxlength="7"  value="<?php echo ($ratesblock->fecha_ini != ""? date("m-d-Y",$ratesblock->fecha_ini):''); ?>" />
            </div>
           <div class="input">
          
                <label style="width:150px" class="required" id="l_price">Ending Date : </label>
                <input name="fecha_fin" type="text"  id="fecha_fin" size="10" maxlength="7"  value="<?php echo ($ratesblock->fecha_fin != ""? date("m-d-Y",$ratesblock->fecha_fin):''); ?>" />
            </div>
          <div class="input">
            <label style="width:150px" class="required" id="l_price"></label>
          </div>
            
      <div class="input">
        
            </div>
          
            <input name="id" type="hidden" id="id" value="<? echo $ratesblock->id; ?>" />
            </fieldset>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

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
       window.location = '<?php echo $data['rootUrl']; ?>admin/tours/block-rates';
    })

</script>


