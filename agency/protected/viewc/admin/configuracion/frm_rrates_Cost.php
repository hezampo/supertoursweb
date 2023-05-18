<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<?php $ratesroom = $data["ratesroom"]; ?><head>
    <style>
        .info, .success, .warning, .error, .validation {
            border: 1px solid;
            margin: 10px 0px;
            /*padding:15px 10px 15px 50px;*/
            padding: 10px 10px 10px 30px;
            background-repeat: no-repeat;
            background-position: 10px center;
        }
      
        .error {
            color: #D8000C;
            background-color: #FFBABA;
            background-image: url('<?php echo $data['rootUrl']; ?>global/img/error.png');
        }
        .success {
            color: #4F8A10;
            background-color: #DFF2BF;
            background-image:url('<?php echo $data['rootUrl']; ?>global/img/error.png');
        }

    </style>    
</head>
<?php if(isset($_GET['menssage'])){?>
<?php if($_GET['menssage'] == 'error'){?>
<div class="error">Error al Generar tarifas, intente nuevamente</div>
<?php }else{ ?>
<div class="success">Guardado Correctamente</div>
<?php } ?>

<?php } ?>
<div id="header_page" >
<div  class="header2">(Tours) Room Rates COST[ <?php echo $data['dato'];?> ]</div>
        <div id="toolbar">

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
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/room-rates-cost/save" method="post" name="form1">
        
        
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">NAME CATEGORY: </label>
                  <select name="id_hotel">
               <?php foreach($data["hotel"] as $e):?>
                  
                       <option value="<?php echo  $e['id']; ?>"  <?php echo ($ratesroom->id_hotel == trim($e['id'])?'selected':''); ?>><?php echo $e["nombre"]; ?></option>
                   <?php endforeach;?>
               </select>
            </div>
             <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">STARTING DATE </label>
                <input type="text" name="fecha_ini" id="fecha_ini" size="25" maxlength="25" value="<?php echo ($ratesroom->fecha_ini != ""? date("m-d-Y",$ratesroom->fecha_ini):''); ?>"/>
            </div>
             <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">ENDING DATE </label>
                <input type="text" name="fecha_fin" id="fecha_fin" size="25" maxlength="25" value="<?php echo ($ratesroom->fecha_fin != ""? date("m-d-Y",$ratesroom->fecha_fin):''); ?>"/>
            </div>



           <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">SGL PRICE </label>
                <input type="text" name="sgl" id="sgl" size="25" maxlength="25" value="<?php echo $ratesroom->sgl; ?>"/>
            </div>
       
        <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">DBL PRICE </label>
                <input type="text" name="dbl" id="dbl" size="25" maxlength="25" value="<?php echo $ratesroom->dbl; ?>"/>
            </div>
       
        <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">TPL PRICE </label>
                <input type="text" name="tpl" id="tpl" size="25" maxlength="25" value="<?php echo $ratesroom->tpl; ?>"/>
            </div>
       
          
           <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">QUA PRICE </label>
                <input type="text" name="qua" id="qua" size="25" maxlength="25" value="<?php echo $ratesroom->qua; ?>"/>
            </div>
            
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">BREAKFAST PRICE</label>
                <input type="text" name="brackfast" id="brackfast" size="25" maxlength="25" value="<?php echo $ratesroom->brackfast; ?>"/>
            </div>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">SUPER BREAKFAST </label>
                <input type="text" name="super_breakfast" id="super_breakfast" size="25" maxlength="25" value="<?php echo $ratesroom->super_breakfast; ?>"/>
            </div>

               
            <input name="id" type="hidden" id="id" value="<?php echo $ratesroom->id; ?>" />
            </fieldset>
            </div>
        </div>
    </form>
<div id="to"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

		   $( "#fecha_ini" ).datepicker({
				dateFormat:'mm-dd-yy'
			});

			$( "#fecha_fin" ).datepicker({
				dateFormat:'mm-dd-yy'
			});

	

    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        
       // sErrMsg += validateInt($('#capacity').val(),$('#l_capacity').html() , true);
        //sErrMsg += validateText($('#frecuency').val(),$('#l_frecuency').html() , true);

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
       window.location = '<?php echo $data['rootUrl']; ?>admin/tours/room-rates-cost';
    })

</script>

<script type="text/javascript">

    function comprobarScreen()
    {

        window.moveTo(0, 0);
        window.resizeTo(screen.width, screen.height);
        window.fullScreen;

        if (window.screen.availWidth <= 640) {
            window.parent.document.body.style.zoom = "62%";
        }

        if (window.screen.availWidth == 800) {
            window.parent.document.body.style.zoom = "78%";
        }
        if (window.screen.availWidth == 1024) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1440) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1600) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1680) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth > 1680) {
            window.parent.document.body.style.zoom = "125%";

        }
    }

</script>

<script type="text/javascript">
    
    
$(window).load(function () {

    comprobarScreen();

});


</script>


