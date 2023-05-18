
    <?php if (isset($_REQUEST['msg'])) { ?>
        <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/  ?></div>
    <?php } ?>
    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/BonosRules"  class="form" id="form1">
    <div id="header_page" >
            <div class="header">Bonus Rules</div>
        <div  id="toolbar">
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/BonosRules/add" id="btn-add" class="link-button"> <span class="icon-new" title="Nuevo" >&nbsp;</span> New </a> </li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/BonosRules/edit" id="btn-edit" class="link-button" > <span class="icon-edit" title="Editar" >&nbsp;</span> Edit </a> </li>
                    <li class="btn-toolbar"> <a href="<?php echo $data['rootUrl']; ?>admin/BonosRules/delete" id="btn-delete" class="link-button"> <span class="icon-delete" title="Eliminar" >&nbsp;</span> Delete </a> </li>
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
                <option value="tipo_bono" <? echo $data["filtro"] == 'tipo_bono' ? 'selected' : '' ?>>Type</option>
                <option value="valor" <? echo $data["filtro"] == 'valor' ? 'selected' : '' ?>>Value per Point</option>
                <option value="vencimiento" <? echo $data["filtro"] == 'vencimiento' ? 'selected' : '' ?>>Expiration Date</option>
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
                        <th width="133">Type</th>
                        <th width="107"><center>Value per Point</center></th>
                <th width="76"><center>Expiration Date</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($data["bonos_rules"] as $e):
                        ?>
                        <tr class="row<? echo $i ?>">
                            <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>
                            <td><? echo $e['tipo_bono']; ?></td>
                            <td><? echo $e['valor']; ?></td>
                            <td><? echo $e['vencimiento']; ?></td>
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
