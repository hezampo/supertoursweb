
    <?php if (isset($_REQUEST['msg'])) { ?>
        <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/  ?></div>
    <?php } ?>
    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/bonos"  class="form" id="form1">
        <div id="header_page" >
            <div class="header">Bonos</div>
        <div  id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/bonos/add" id="btn-add" class="link-button"> <span class="icon-new" title="Nuevo" >&nbsp;</span> Nuevo </a> </li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/bonos/edit" id="btn-edit" class="link-button" > <span class="icon-edit" title="Editar" >&nbsp;</span> Editar </a> </li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/bonos/delete" id="btn-delete" class="link-button"> <span class="icon-delete" title="Eliminar" >&nbsp;</span> Eliminar </a> </li>
                    <li class="divider">&nbsp;</li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button"> <span class="icon-back" title="Regresar" >&nbsp;</span> Regresar </a> </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
              </div>
<div id="form">
        <div id="filter-bar">
            <label style="width:70px" class="filter-by">Filtrar por</label>
            <select name="filtro" id="filtro" class="select">
                <option value="codigo" <? echo $data["filtro"] == 'codigo' ? 'selected' : '' ?>>Code</option>
                <option value="nombre" <? echo $data["filtro"] == 'nombre' ? 'selected' : '' ?>>Name</option>
                <option value="valor" <? echo $data["filtro"] == 'valor' ? 'selected' : '' ?>>Value</option>
                <option value="tipo" <? echo $data["filtro"] == 'tipo_cliente' ? 'selected' : '' ?>>Client Type</option>
                <option value="tipo" <? echo $data["filtro"] == 'rule_id' ? 'selected' : '' ?>>Rule</option>
                <option value="asignado" <? echo $data["filtro"] == 'asignado' ? 'selected' : '' ?>>Assigned</option>
                <option value="asignado" <? echo $data["filtro"] == 'redimido' ? 'selected' : '' ?>>Redeemed</option>
                <option value="fecha_creacion" <? echo $data["filtro"] == 'fecha_creacion' ? 'selected' : '' ?>>Creation Date</option>
                <option value="fecha_vencimiento" <? echo $data["filtro"] == 'fecha_vencimiento' ? 'selected' : '' ?>>Expiration Date</option>
            </select>
            <span class="search">
                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" />
            </span> </div>
        <div id="datagrid">
            <table class="grid" cellspacing="1" id="grid">
                <thead>
                    <tr>
                        <th width="21">&nbsp;</th>
                        <th width="133">Code</th>
                        <th width="107"><center>Name</center></th>
                <th width="107"><center>Value</center></th>
                <th width="107"><center>Client Type</center></th>
                <th width="76"><center>Assigned</center></th>
                <th width="76"><center>Redeemed</center></th>
                <th width="76"><center>Creation Date</center></th>
                <th width="76"><center>Expiration Date</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data["bonos"] as $e):
                        ?>
                        <tr class="row<? echo $i ?>">
                            <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>
                            <td><? echo $e['codigo']; ?></td>
                            <td><? echo $e['nombre']; ?></td>
                            <td><? echo $e['valor']; ?></td>
                            <td><? echo $e['tipo_cliente']; ?></td>
                            <td><? echo $e['asignado']; ?></td>
                            <td><? echo $e['redimido']; ?></td>
                            <td><? echo $e['fecha_creacion']; ?></td>
                            <td><? echo $e['fecha_vencimiento']; ?></td>
                        </tr>
                        <?php
                        $i = 1 - $i;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div id="pagination"> <?php echo $data['pager'] ?> </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#grid tr').click(function() {
$(this).find('input[name="item"]').prop('checked', true)
   
});
   
    $('texto').keypress(function(e){
        if (e.keyCode==13)
            $('#form1').submit();
    })
    
    $('#btn-find').click(function(){
        $('#form1').submit();
    });

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
   
    $('#btn-delete').click(function(e){
        n = $('input[name=item]:checked').attr('value');
        if (!n){
            alert('You must select an Item');
            e.preventDefault();
        }else {
            if (confirm("Are you sure of deleting this item? ...")){
                var action = $(this).attr("href") + "/?item=" + n;
                $(this).attr("href",action);
            }else
			{
				return false;
			}
        }
    });

</script> 
