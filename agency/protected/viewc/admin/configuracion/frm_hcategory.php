<?php $hcategoria = $data["hcategoria"];
      
?><head>

</head>

<div id="header_page" >
<div class="header2">Hotel Categoria [ <? echo $data['dato'];?> ]</div>
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
    
    <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/hotel-category/save" method="post" name="form1">
        
        
            <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Name Category: </label>
                <input type="text" name="nombre" id="nombre" size="25" maxlength="25" value="<?php echo $hcategoria->nombre; ?>"/>
            </div>

           <div class="input">
                <label style="width:150px" class="required" id="l_trip_no">Estrellas: </label>
                <input type="text" name="star" id="star" size="25" maxlength="25" value="<?php echo $hcategoria->star; ?>"/>
            </div>
       
          
        
            
               
            <input name="id" type="hidden" id="id" value="<? echo $hcategoria->id; ?>" />
            </div>
        </div>
    </form>
<div id="to"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">



	

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
       window.location = '<?php echo $data['rootUrl']; ?>admin/tours/hotel-category';
    })

</script>


