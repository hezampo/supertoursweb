

    <?php if(isset($_REQUEST['msg'])){?>
     <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>
    <?php } ?>

    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/pickup-dropoff"  class="form" id="form1">
          <div id="header_page" >
            <div class="header">Pickup - Dropoff / Extension</div>
      

        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/pickup-dropoff/ext/add" id="btn-add" class="link-button">
                            <span class="icon-new" title="Nuevo" >&nbsp;</span>
                            Nuevo
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/pickup-dropoff/ext/edit" id="btn-edit" class="link-button" >
                            <span class="icon-edit" title="Editar" >&nbsp;</span>
                            Editar
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/pickup-dropoff/ext/delete" id="btn-delete" class="link-button">
                            <span class="icon-delete" title="Eliminar" >&nbsp;</span>
                            Eliminar
                        </a>
                    </li>

                    <li class="divider">&nbsp;</li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">
                            <span class="icon-back" title="Regresar" >&nbsp;</span>
                            Regresar
                        </a>
                    </li>

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
               <option value="place" <? echo $data["filtro"] == 'place' ? 'selected' : '' ?>>Place</option>
                <option value="address" <? echo $data["filtro"] == 'address' ? 'selected' : '' ?>>Address</option>
            </select>

            <span class="search">
                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" />
            </span>
 
        </div>

        <div id="datagrid">

            <table class="grid" cellspacing="1" width="100%" id="grid">
                 <thead>
                    <tr>
                        <th width="31">&nbsp;</th>
                      <th width="150">Place</th>
                      <th width="150">Address</th>
                      <th width="173">Area / extension</th>
                   </tr>
                </thead>

                <tbody>
                    <?
                    $i = 0;
                      foreach ($data["pickdrop"] as $e):
                    ?>
                        <tr class="row<? echo $i ?>">
                            <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>
                            <td><? echo $e['place']; ?></td>
                            <td><? echo $e['address']; ?></td>
                            <td><? echo $e['nombre']; ?></td>
                        </tr>
                    <?php
                        $i = 1 - $i;
                    endforeach;
                    ?>
                </tbody>

                
            </table>
             <div id="pagination">
                <?php echo $data['pager'] ?>
            </div>
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



