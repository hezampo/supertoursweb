<?php if(isset($_REQUEST['msg'])){?>
     <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>
    <?php } ?>

    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/reservas_quotes"  class="form" id="form1">
       <div id="header_page" >
            <div class="header">Quotes</div>

        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                      <li class="btn-toolbar">
<!--                        <a href="<?php echo $data['rootUrl']; ?>admin/reservas/add" id="btn-add" class="link-button">-->
                        <a style="margin-left:1px;" href="javascript:void(window.open('<?php echo $data['rootUrl'] ?>admin/reservas/add','RESERADD',''))">
                            <span class="icon-new" title="Nuevo" >&nbsp;</span>
                            New
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/reservas/edit" id="btn-edit" class="link-button" >
                            <span class="icon-edit" title="Editar" >&nbsp;</span>
                            Edit
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
<div id="form2" >
        <div id="filter-bar">

            <label style="width:70px" class="filter-by">Filter By</label>
            <select name="filtro2" id="filtro" class="select">
                <option value="r.id" <?php echo $data["filtro2"] == 'r.id' ? 'selected' : '' ?>>ID</option>
                <option value="tipo_ticket" <?php echo $data["filtro2"] == 'tipo_ticket' ? 'selected' : '' ?>>Type</option>
                <option value="codconf" <?php echo $data["filtro2"] == 'codconf' ? 'selected' : '' ?>>Code</option>
                <option value="fecha_salida" <?php echo $data["filtro2"] == 'fecha_salida' ? 'selected' : '' ?>>Round Date</option>
                <option value="fecha_retorno" <?php echo $data["filtro2"] == 'fecha_retorno' ? 'selected' : '' ?>>Return Date</option>
                <option value="lasname" <?php echo $data["filtro2"] == 'lasname' ? 'selected' : '' ?>>Lastname pax</option>
                <option value="opuser" <?php echo $data["filtro2"] == 'opuser' ? 'selected' : '' ?>>User</option>
                <option value="r.estado" <?php echo $data["filtro2"] == 'r.estado' ? 'selected' : '' ?>>Status</option>
            </select>

            <span class="search">
                <input name="texto2" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto2"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" />
            </span>
 
        </div>

        <div id="datagrid"  >

            <table class="grid" cellspacing="1" id="grid">
                 <thead>
                    <tr>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="20">&nbsp;</th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="107"># Confirmation</th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="83"><center>Date Hours</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="66"><center>Type</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="89"><center>Round Date</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="96"><center>Return Date</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="120"><center>Pax Name</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="59"><center>Phone</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="48"><center>pax #</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="71"><center>From</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="67"><center>To</center></th>
                      <th style="font-size: 11px; color:#fff; background-color:#F90A45;"width="35"><center>Total</center></th>
                   </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                      foreach ($data["reservas"] as $e):
                    ?>
                        <tr class="row<?php echo $i ?>">
                            <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>
                            <td><?php echo $e['codconf']; ?></td>
                            <td><?php echo date('M-d-Y',strtotime($e['fecha_ini']))."  ".date('h:i A', strtotime($e['hora'])); ?></td>                            
                            <td><?php echo $e['tipo_ticket']; ?></td>
                            <td><?php echo date('M-d-Y',strtotime($e['fecha_salida'])); ?></td>
                            <td><?php echo 
							( $e['tipo_ticket'] == 'roundtrip')?date('M-d-Y',strtotime($e['fecha_retorno'])):''; ?> </td>
                            <td><?php echo $e['firsname']." ".$e['lasname']; ?> </td>
                            <td><?php echo $e['phone']; ?> </td>
                            <td><?php echo $a = $e['pax']+$e['pax2']; ?> </td>
                            <td><?php echo $e['de']; ?> </td>
                            <td><?php echo $e['para']; ?> </td>
                            <td><?php echo $e['totaltotal']; ?> </td-->
                        </tr>
                    <?php
                        $i = 1 - $i;
                    endforeach;
                    ?>
                </tbody>

                
            </table>
             <div id="pagination">
                <?php echo $data['pager']?>
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

<script type="text/javascript">
    
    $(window).load(function () {                        
          
          comprobarScreen();
          
  
 
    });

</script>

<script type="text/javascript">

    function comprobarScreen()
    {
        if (window.screen.availWidth <= 640) {
            window.parent.document.body.style.zoom = "62%";
        }

        if (window.screen.availWidth == 800) {
            window.parent.document.body.style.zoom = "78%";
        }
        if (window.screen.availWidth == 1024) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth <= 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }
        
        if (window.screen.availWidth == 1440) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth > 1440) {
            window.parent.document.body.style.zoom = "125%";

        }
    }

</script>



