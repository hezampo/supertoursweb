<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-validation/dist/additional-methods.min.js"></script>

<?php
    $type_ticket= $data["type_ticket"];
?>

<div id="header_page" >
    <div class="header2">Traffic Type Ticket [
        <?
            if($type_ticket->id == null){
                echo 'New';
            }else{
                echo $type_ticket->type.' - '.$type_ticket->description;
            }

        ?>
    ]</div>
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

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/traffic/type_tickets/save" method="post" name="form1">


                <div class="input">
                    <label style="width:150px" class="required" for="id_type">Type: </label>
                    <input type="text" name="type" id="id_type"  size="25" maxlength="6"  value="<?php echo $type_ticket->type; ?>" required=""/>
                    <div class="clearfix"></div>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" for="id_description">Description: </label>
                    <input type="text" name="description" id="id_description"  size="25" maxlength="100"  value="<?php echo $type_ticket->description; ?>" required=""/>
                    <div class="clearfix"></div>
                </div>

                <input name="id" type="hidden" id="id" value="<? echo $type_ticket->id; ?>" />
            </form>
        </fieldset>
    </div>
</div>


</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var $form1 = $('#form1');
        $form1.validate({
            errorClass: 'error_validate'
        });


        $('#btn-save').click(function(){
            if ($form1.valid()){
                $form1.submit();
            }
        });

        $('#btn-cancel').click(function(){
            window.location = '<?php echo $data['rootUrl']; ?>admin/traffic/type_tickets/index';
        });
    });
</script>

<style>
    .input{
        display: block;
    }
    .input input{
        float: left;
    }

    .error_validate{
        color: red !important;
    }

    .clearfix{
        clear: both;
    }
</style>

