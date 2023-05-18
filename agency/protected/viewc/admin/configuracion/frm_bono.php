<?php $bono = $data["bono"]; ?>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-autocomplete.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.select-to-autocomplete.js"></script>
<style type="text/css" media="screen">
	
	label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
    
	.ui-autocomplete {
        padding: 0;
        list-style: none;
        background-color: #fff;
        width: 200px;
        border: 1px solid #B0BECA;
        max-height: 200px;
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
<div class="header2">Bonos [ <? echo $data['dato'];?> ]</div>
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
  <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/bonos/save" method="post" name="form1">
    
    <div class="input">
      <label style="width:150px" class="required" id="l_codigo">Code</label>
      <input type="text" name="codigo" id="codigo"  size="25" maxlength="20" class="required" value="<?php echo $bono->codigo; ?>"/>
    </div>
    <div class="input">
      <label style="width:150px" class="required" id="l_nombre">Name</label>
      <input type="text" name="nombre" id="nombre"  size="25" maxlength="20"  value="<?php echo $bono->nombre; ?>"/>
    </div>
    <div class="input">
      <label style="width:150px" class="required" id="l_valor">Value</label>
      <input type="text" name="valor" id="valor"  size="25" maxlength="20"  value="<?php echo $bono->valor; ?>"/>
    </div>
    <div class="input">
      <label style="width:150px" class="required" id="l_cantidad">Ammount</label>
      <input type="text" name="valor" id="valor"  size="25" maxlength="20"  value="<?php echo $bono->cantidad; ?>"/>
    </div>
    <div class="input">
      <input type="hidden" id="h_rule" value="<?php echo $bono->rule_id; ?>"/>
      <label style="width:150px" class="required" id="l_rule">Rule</label>
      <select id="tipo" name="tipo" class="select">
        <?php foreach ($data["rules"] as $e): ?>
        <option value="<?php echo $e['id']; ?>"  <?php echo ($bono->rule_id == trim($e['id']) ? 'selected' : ''); ?>><?php echo $e["tipo_bono"]; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="input">
      <input type="hidden" id="h_utype" value="<?php echo $bono->tipo_cliente; ?>"/>
      <label style="width:150px" class="required" id="l_utype">Client type</label>
      <select id="utipo" name="rule" class="select">
        <option value="0" >Regular</option>
        <option value="1" >Frequent</option>
      </select>
    </div>
    <div class="input">
      <input type="hidden" id="h_utype" value="<?php echo $bono->tipo_cliente; ?>"/>
      <label style="width:150px" class="required" id="l_asignado">Asigned to</label>
      <select name="asignado" id="asignado" autofocus="autofocus" autocorrect="off" autocomplete="off" size="25">
        <option value="" selected="selected">Write Client Name</option>
        <?php foreach($data["clientes"] as $e){?>
        	<option value="<? echo $e['id'];?>" data-alternative-spellings="fadsf"><? echo $e['firstname'];?> <? echo $e['lastname'];?></option>
        <?php }?>
      </select>
    </div>
    <div class="input">
      <input type="hidden" id="h_redimido" value="<?php echo $bono->redimido; ?>"/>
      <label style="width:150px" class="required" id="l_redimido">Redeemed</label>
      <select id="redimido" name="redimido" class="select">
        <option value="No">No</option>
        <option value="Si">Si</option>
      </select>
    </div>
    <div class="input">
      <label style="width:150px" class="required" id="l_fecha_creacion">Register Date</label>
      <input type="text" name="fecha_creacion" id="fecha_creacion"  size="25" maxlength="20"  value="<?php echo $bono->fecha_creacion; ?>" readonly/>
    </div>
    <div class="input">
      <label style="width:150px" class="required" id="l_fecha_vencimiento">Expiration Date</label>
      <input type="text" name="fecha_vencimiento" id="fecha_vencimiento"  size="25" maxlength="20"  value="<?php echo $bono->fecha_vencimiento; ?>" readonly/>
    </div>
   
      <input name="id" type="hidden" id="id" value="<? echo $bono->id; ?>" />
      </fieldset>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
<script type="text/javascript">
        
	$("#form1").validate();	
		
	$( "#fecha_vencimiento,#fecha_creacion" ).datepicker({ dateFormat: "yy-mm-dd" });
    var tipo = $("#h_tipo").val();
    
	$("#tipo option[value="+tipo+"]").attr("selected",true);    
        
    var utype = $("#h_utype").val();
    $("#utype option[value="+utype+"]").attr("selected",true);    
		
    var redimido = $("#h_redimido").val(); 
    $("#redimido option[value="+redimido+"]").attr("selected",true);		

	function validateForm(){
        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#codigo').val(), $('#l_codigo').html(), true);
        sErrMsg += validateText($('#nombre').val(),$('#l_nombre').html() , true);
        sErrMsg += validateText($('#valor').val(),$('#l_valor').html() , true);
        sErrMsg += validateText($('#asignado').val(),$('#l_asignado').html() , true);
        sErrMsg += validateText($('#fecha_creacion').val(),$('#l_fecha_creacion').html() , true);
        sErrMsg += validateText($('#fecha_vencimiento').val(),$('#l_fecha_encimiento').html() , true);
		  
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
    });

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>admin/bonos';
	});
	
	$(function(){
		$('select').selectToAutocomplete();
	});
	
</script>

