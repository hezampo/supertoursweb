<style>
    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 20px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        padding: 8px;
        width: 100%;
        float: left;
        clear: both;
    }

    table   th:first-child{
        width: 60px;
    }

    table th{
        font-size: 1em;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--jquery para el calendario-->

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>

<script>
    $(function(){
        console.log('jquery-ready');
    });</script>

<script type="text/javascript">

</script>

<div id="header_page" >
    <div class="header">Traffic Bus</div>

    <div  id="toolbar">

        <div class="toolbar-list">
            <ul>

                <li class="btn-toolbar">
                    <a href="<?php echo $data['rootUrl']; ?>admin/traffic/buses/add" id="btn-add" class="link-button">
                        <span class="icon-new" title="Nuevo" >&nbsp;</span>
                        New
                    </a>
                </li>

                <li class="btn-toolbar">
                    <a href="<?php echo $data['rootUrl']; ?>admin/traffic/buses/edit" id="btn-edit" class="link-button" >
                        <span class="icon-edit" title="Editar" >&nbsp;</span>
                        Edit
                    </a>
                </li>

                <li class="btn-toolbar">
                    <a href="javascript:void();" id="btn-delete" class="link-button">
                        <span id="btn-delete-icon" class="icon-delete" title="Eliminar" ></span>
                        <samp id="btn-delete-txt"> delete</samp>
                    </a>
                </li>

                <li class="divider">&nbsp;</li>

                <li class="btn-toolbar">
                    <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">
                        <span class="icon-back" title="Regresar" >&nbsp;</span>
                        Back
                    </a>
                </li>

            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>





<div id="content_page_tours">
    <div id="data_grid">
        <table class="grid">
        <thead>
            <tr>
                <th>

                </th>
                <th>
                    Short Name
                </th>
                <th>
                    Name
                </th>
                <th>
                    Bus Type
                </th>
                <th>
                    Capacity
                </th>
                <th>
                    Driver
                </th>

            </tr>
        </thead>
        <tbody>
            <? $i = 0; ?>
            <? foreach($data['all_buses'] as $bus): ?>
                <tr class="row<? echo $i; ?>">
                    <td><label><input name="item" type="radio" value="<? echo $bus['id']; ?>" /></label></td>
                    <td><? echo $bus['short_name']; ?></td>
                    <td><? echo $bus['name']; ?><input data-id="<? echo $bus['id']; ?>" class="bus_name" type="hidden" value="<? echo $bus['name']; ?>"></td>
                    <td><? echo $bus['type_bus']; ?></td>
                    <td><? echo $bus['capacity']; ?></td>
                    <td><? echo $bus['firstname'].' '.$bus['lastname']; ?></td>
                </tr>
            <?
                if ($i == 0){
                    $i = 1;
                }else{
                    $i = 0;
                }
                ?>
            <? endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<form id="form_bus_delete" method="post" action="<?php echo $data['rootUrl']; ?>admin/traffic/buses/delete" style="display: none">
    <input type="hidden" name="id_bus" id="id_bus_delete" value="">
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $('.grid tr').click(function() {
            var id_bus = $(this).find('input[name="item"]').val();
            $('#id_type_ticket_delete').val(id_bus);
            $(this).find('input[name="item"]').prop('checked', true);

        });

        /*
        $('texto').keypress(function(e){
            if (e.keyCode==13)
                $('#form1').submit();
        });

        $('#btn-find').click(function(){
            $('#form1').submit();
        });
        */

        $('#btn-edit').click(function(e){
            var id = $('input[name=item]:checked').attr('value');
            if (!id){
                alert('You must select an Item');
                e.preventDefault();
            }
            else {
                var action = $(this).attr("href") + "/" + id;
                $(this).attr("href",action);
            }
        });

        $('input[type="radio"]').change(function(){
            var nom = 'est_'+$(this).val();
            var estado = document.getElementById(nom).value;
            if(estado==1){
                document.getElementById('btn-delete-icon').className = 'icon-delete';
                document.getElementById('btn-delete-icon').title = 'Block';
                document.getElementById('btn-delete-txt').innerHTML = 'Block';
            }else{
                document.getElementById('btn-delete-icon').className = 'icon-active';
                document.getElementById('btn-delete-icon').title = 'Activate';
                document.getElementById('btn-delete-txt').innerHTML = 'Activate';
            }
        });

        function estado(id){
            var nom = 'est_'+id;
            var estado = document.getElementById(nom).value;
            if(estado==1){
                document.getElementById('btn-delete-icon').className = 'icon-delete';
                document.getElementById('btn-delete-icon').title = 'Block';
                document.getElementById('btn-delete-txt').innerHTML = 'Block';
            }else{
                document.getElementById('btn-delete-icon').className = 'icon-active';
                document.getElementById('btn-delete-icon').title = 'Activate';
                document.getElementById('btn-delete-txt').innerHTML = 'Activate';
            }
        }

        $('#btn-delete').click(function(e){
            n = $('input[name=item]:checked').attr('value');
            if (!n){
                alert('You must select an item');
                e.preventDefault();
            }else {
                if (confirm("This sure delete this record ..")){

                    $('#form_type_ticket_delete').submit();

                }else
                {
                    return false;
                }
            }
        });
    });
</script>
<script type="text/javascript">



</script>
