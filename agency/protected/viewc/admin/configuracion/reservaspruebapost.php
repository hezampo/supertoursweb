<?php if(isset($_REQUEST['msg'])){?>
     <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>
    <?php } ?>

    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/reservas"  class="form" id="form1">
       <input type="text" id="texto" name="texto">
       <input type="submit" name="submit" value="Submit Form">
        <div id="header_page" >
            <div class="header">Transportation Reservations </div>

        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                      <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/reservas/add" id="btn-add" class="link-button">
                            <span class="icon-new" title="Nuevo" >&nbsp;</span>
                            New
                        </a>
                    </li>

                    <li class="btn-toolbar">
<!--                        href="<?php echo $data['rootUrl']; ?>admin/reservas/edit"-->
<!--                        <a  id="btn-edit" onclick="enviar();" class="link-button" >
                            <span class="icon-edit" title="Editar" >&nbsp;</span>
                            Edit
                        </a>-->

                        <?php
        
                        $texto = $_POST["texto"];

                        //$id = trim($texto);
                        $id = '42684';          
                        $ruta = "admin/reservas/edit/";
                        $url1 = $data['rootUrl'] . $ruta . $id;
                //        $texto = 45;
                        echo $texto;
                        exit();

                        ?>
                        
                        <a href="javascript:void(window.open('<?php echo $url1; ?>','RESERVAS','resizable=no,location=no,menubar=no, scrollbars=no,status=no,toolbar=no,fullscreen=no,dependent=no,width=1024,height=768,left=100,top=100'))" id="btn-edit" class="link-button" onclick="enviar();"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/edit2.png" style="margin-top:-2px; height:25px;" title="Modify reservation data"/>
                            <span style="margin-top:-10px; height: 12px;" title="Editar" >Edit</span>
                            <!--                            Edit-->
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
                      <th width="20">&nbsp;</th>
                      <th width="50">#Confirmation</th>
                      <th width="83"><center>
                      Date Hours
                      </center></th>
                      <th width="50"><center>Type</center></th>
                      <th width="90"><center>Round Date</center></th>
                      <th width="96"><center>Return Date</center></th>
                      <th width="120"><center>Pax Name</center></th>
                      <th width="59"><center>Phone</center></th>
                      <th width="48"><center>pax #</center></th>
                      <th width="48"><center>Agency </center></th>
                      <th width="71"><center>From</center></th>
                      <th width="67"><center>To</center></th>
                      <th width="35"><center>Total</center></th>
                      <th width=""><center>User</center></th>
                   </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                      foreach ($data["reservas"] as $e){
                    ?>
                        <tr class="row<?php echo $i ?>">
                            <td><input name="item" type="radio" value="<?php echo $e['id']; ?>" /></td>
                            <td><?php if($e['estado'] == "CANCELED") {?> <strike>  <?php } ?><?php echo $e['codconf']; ?><?php if($e['estado'] == "CANCELED") {?> </strike>  <?php } ?></td>
                            <td style="font-size: 10px;"><?php echo date('M-d-Y',strtotime($e['fecha_ini']))."  ".date('h:i A', strtotime($e['hora'])); ?></td>                            
                            <td><?php echo $e['tipo_ticket']; ?></td>
                            <td><?php echo date('M-d-Y',strtotime($e['fecha_salida'])); ?></td>
                            <td><?php echo ( $e['tipo_ticket'] == 'roundtrip')?date('M-d-Y',strtotime($e['fecha_retorno'])):''; ?> </td>
                            <td><?php echo $e['firsname']." ".$e['lasname']; ?> </td>
                            <td><?php echo $e['phone']; ?> </td>
                            <td><?php echo $a = $e['pax']+$e['pax2']; ?> </td>
                            <td><?php echo $e['agencia']; ?> </td>
                            <td><?php echo $e['de']; ?> </td>
                            <td><?php echo $e['para']; ?> </td>
                            <td><?php echo $e['totaltotal']; ?> </td>
                            <td><?php echo $e['opuser']; ?> </td>
                        </tr>
                    <?php
                        $i = 1 - $i;
                      }
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
        document.getElementById('texto').value = id;
        
        
        
//        if (!id){
//         alert('You must select an Item');
//         e.preventDefault();
//       }
//       else {
//           var action = $(this).attr("href") + "/" + id;           
//           
//           $(this).attr("href",action);
//       }
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

<script>
	function enviar()
	{
		// Esta es la variable que vamos a pasar
		//var miVariableJS=$("#texto").val();
                var id = $('input[name=item]:checked').attr('value');
                document.getElementByName('texto').value = id;
//                alert(id);
//                exit();
		// Enviamos la variable de javascript a archivo.php
//		$.post("admin/reservas.php",{"texto":id},function(respuesta){
//			alert(respuesta);
//		});
	}
	</script>
        
        
        
        




