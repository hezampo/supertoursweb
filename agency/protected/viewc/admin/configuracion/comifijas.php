<div id="form" style="width:800px;">    <?php if(isset($_REQUEST['msg'])){?>     <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>    <?php } ?>    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/tours/room-rates"  class="form" id="form1">        <h4 class="titleform" style="margin-bottom:0px;">Hotel Category</h4>        <div  id="toolbar">            <div class="toolbar-list">                <ul>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/room-rates/add" id="btn-add" class="link-button">                            <span class="icon-new" title="Nuevo" >&nbsp;</span>                            New                        </a>                    </li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/room-rates/edit" id="btn-edit" class="link-button" >                            <span class="icon-edit" title="Editar" >&nbsp;</span>                            Edit                        </a>                    </li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/room-rates/delete" id="btn-delete" class="link-button">                            <span class="icon-delete" title="Eliminar" >&nbsp;</span>                            Delete                        </a>                    </li>                    <li class="divider">&nbsp;</li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">                            <span class="icon-back" title="Regresar" >&nbsp;</span>                            Back                        </a>                    </li>                </ul>                <div class="clear"></div>            </div>            <div class="clear"></div>        </div>        <hr />        <div id="filter-bar" align="center">            <label style="width:70px" class="filter-by">Filter By</label>            <select name="filtro" id="filtro" class="select">               <option value="trip_no" <? echo $data["filtro"] == 'trip_no' ? 'selected' : '' ?>>Viaje</option>            </select>            <span class="search">                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>                <input type="button" class="search-btn" id="btn-find" />            </span>         </div>        <div id="datagrid">          <table class="grid"  align="center" cellspacing="1" width="96%">            <thead>              <tr>                <th width="20">&nbsp;</th>                <th width="90">Hotel Name</th>                <th width="83">Start Date</th>                <th width="70">End Date</th>                <th width="75">Sgl Price</th>                <th width="74">Dbl Price</th>                <th width="80">Tpl Price</th>                <th width="84">Qua Price</th>                <th width="79">Breakfast</th>                <th width="80">Resort</th>              </tr>            </thead>            <tbody>              <?php                    $i = 0;                      foreach ($data["ratesroom"] as $e):                    ?>              <tr class="row<?php echo $i ?>">                <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>                <td><?php echo $e['nombre']; ?></td>                <td><?php echo date("m-d-Y",$e['fecha_ini']); ?></td>                <td><?php echo date("m-d-Y",$e['fecha_fin']); ?></td>                <td><?php echo $e['sgl']; ?></td>                <td><?php echo $e['dbl']; ?></td>                <td><?php echo $e['tpl']; ?></td>                <td><?php echo $e['qua']; ?></td>                <td><?php echo $e['resortprice']; ?></td>                <td><?php echo $e['brackfast']; ?></td>              </tr>              <?php                        $i = 1 - $i;                    endforeach;                    ?>            </tbody><thead><tr></tr>        </thead>        </table><div id="pagination">                <?php echo $data['pager'] ?>            </div>        </div>  </form></div><script type="text/javascript">        $('texto').keypress(function(e){       if (e.keyCode==13)           $('#form1').submit();    })         $('#btn-find').click(function(){       $('#form1').submit();     });    $('#btn-edit').click(function(e){        var id = $('input[name=item]:checked').attr('value');        if (!id){         alert('You must select an Item');         e.preventDefault();       }       else {           var action = $(this).attr("href") + "/" + id;           $(this).attr("href",action);       }   });      $('#btn-delete').click(function(e){        n = $('input[name=item]:checked').attr('value');        if (!n){          alert('You must select an Item');          e.preventDefault();        }else {            if (confirm("Are you sure of deleting this item? ...")){               var action = $(this).attr("href") + "/?item=" + n;               $(this).attr("href",action);            }        }    });</script>