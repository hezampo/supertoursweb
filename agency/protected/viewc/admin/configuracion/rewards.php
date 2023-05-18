
    <?php if (isset($_REQUEST['msg'])) { ?>
        <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/  ?></div>
    <?php } ?>
    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/rewards"  class="form" id="form1">
        <div id="header_page" >
            <div class="header">Rewards</div>
        <div  id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/rewards/add" id="btn-add" class="link-button"> <span class="icon-new" title="Nuevo" >&nbsp;</span> Nuevo </a> </li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/rewards/edit" id="btn-edit" class="link-button" > <span class="icon-edit" title="Editar" >&nbsp;</span> Editar </a> </li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/rewards/delete" id="btn-delete" class="link-button"> <span class="icon-delete" title="Eliminar" >&nbsp;</span> Eliminar </a> </li>
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
                <option value="code" <? echo $data["filtro"] == 'code' ? 'selected' : '' ?>>Codigo</option>
                <option value="reward_ticket" <? echo $data["filtro"] == 'reward_ticket' ? 'selected' : '' ?>>Nombre</option>
                <option value="points" <? echo $data["filtro"] == 'points' ? 'selected' : '' ?>>Puntos</option>
                <option value="ammount_discount"<? echo $data["filtro"] == 'ammount_discount' ? 'selected' : '' ?>>Descuento</option>
            </select>
            <span class="search">
                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" />
            </span> </div>
        <div id="datagrid">
            <table class="grid" cellspacing="1" id="grid">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Codigo</th>
                        <th><center>Nombre</center></th>
                        <th><center>Puntos</center></th>
                        <th><center>Descuento</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data["rewards"] as $e){
                        ?>
                        <tr class="row<? echo $i ?>">
                            <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>
                            <td><? echo $e['code']; ?></td>
                            <td><? echo $e['reward_ticket']; ?></td>
                            <td align="center"><? echo $e['points']; ?></td>
                            <td align="center"><? echo $e['ammount_discount']; ?></td>
                        </tr>
                        <?php
                        $i = 1 - $i;
                    };
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
