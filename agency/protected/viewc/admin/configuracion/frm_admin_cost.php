<?php $admision_rates= $data["admision_rates"];?>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />

<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/admision-cost/save" method="post" name="form1" enctype="multipart/form-data">
    <div id="header_page" >
        <div class="header2">(Parks) Admision Cost  [ <? echo $data['dato'];?> ]</div>
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

                <div class="input">
                    <label style="width:150px" class="required" id="l_id_grupo">Group: </label>
                    <select style="width:210px"  name="id_grupo" id="id_grupo" class="select">
                        <option value=""></option>
                        <?php foreach($data["grupos"] as $e):?>
                            <option value="<?php echo  $e['id']; ?>"  <?php echo ($admision_rates->id_grupo == trim($e['id'])?'selected':''); ?>><?php echo $e["nombre"]; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="l_trip_no">Parks: </label>
                    <select style="width:210px"  name="id_parque" id="id_parque" class="select">
                        <option value="0">All</option>
                        <?php foreach($data["parques"] as $e):?>
                            <option value="<?php echo  $e['id']; ?>"  <?php echo ($admision_rates->id_parque == trim($e['id'])?'selected':''); ?>><?php echo $e["nombre"]; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_cantidad">Amount: </label>
                    <input type="text" name="cantidad" id="cantidad"  size="10" maxlength="10"  value="<?php echo $admision_rates->cantidad; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_adults">Price Adults: </label>
                    <input type="text" name="adults" id="adults"  size="10" maxlength="10"  value="<?php echo $admision_rates->adults; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_child">Price Child: </label>
                    <input type="text" name="child" id="child"  size="10" maxlength="10"  value="<?php echo $admision_rates->child; ?>"/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" for="annio">Year: </label>
                    <input type="number" id="annio" value="<? echo isset($admision_rates->annio)? substr($admision_rates->annio,0,4) : date('Y')?>" name="annio">
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="l_address"></label>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_address"></label>
                </div>


                <input name="id" type="hidden" id="id" value="<? echo $admision_rates->id; ?>" />
            </fieldset>
        </div>
    </div>
</form>

</div>




<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">

    //$( "#dialog:ui-dialog" ).dialog( "destroy" );

    //auto-complete
    $("#company_name").keyup(function(){
        $("#company_name").autocomplete({
            source: '<?php echo $data["rootUrl"]; ?>admin/tours/loadcompany/'+$("#company_name").val(),
            select: function(event, ui) {
                $('#id_agency').val(ui.item.id);
            }
        });
    });

    $("#id_parque").change(function(){
        if($(this).val() != '0'){
            $("#cantidad").val(1).attr('readonly',true);
        }
    });

    $("#id_grupo").change(function(){
        var grupo = $(this).val();
        $("#id_parque").load('<?php echo $data["rootUrl"]; ?>admin/tours/parks/list/'+grupo);
    });


    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateNumberPositivo($('#id_grupo').val(),$('#l_id_grupo').html() , true);

        sErrMsg += validateNumberPositivo($('#cantidad').val(),$('#l_cantidad').html() , true);

        sErrMsg += validateNumberPositivo($('#adults').val(),$('#l_adults').html() , true);

        sErrMsg += validateNumberPositivo($('#child').val(),$('#l_child').html() , true);

        <?php if($admision_rates->type_rate==2){?>
        if($('#id_agency').val() == -1){
            sErrMsg += '- Enter agency data \n';
        }
        <?php }?>

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
        window.location = '<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/<?php echo $admision_rates->type_rate;?>';
    })

</script>


