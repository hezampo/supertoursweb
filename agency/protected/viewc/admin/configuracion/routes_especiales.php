<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" /><link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" /><script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>    <?php if(isset($_REQUEST['msg'])){?>     <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>    <?php } ?>    <form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/routes/<?php echo $data['type_rate']; ?>"  class="form" id="form1">       <div id="header_page" ><div class="header">	<?php if($data['type_rate']==0){			echo 'Commissionable rates';		}else if($data['type_rate']==1){			echo 'Net Rates';		}else if($data['type_rate']==2){			echo 'Special Net Rates';		}	?>	</div>        <div  id="toolbar">            <div class="toolbar-list">                <ul>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/routes/edit" id="btn-edit" class="link-button" >                            <span class="icon-edit" title="Editar" >&nbsp;</span>                            Edit                        </a>                    </li>                                                            <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/routes/delete" id="btn-delete" class="link-button">                            <span class="icon-delete" title="Eliminar" >&nbsp;</span>                            Delete                        </a>                    </li>                    <li class="divider">&nbsp;</li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">                            <span class="icon-back" title="Regresar" >&nbsp;</span>                            Back                        </a>                    </li>                </ul>                <div class="clear"></div>            </div>            <div class="clear"></div>        </div>        </div>        </div>        <div id="form" >        <div id="filter-bar">                     <label style="width:70px" class="filter-by">Filter By</label>            <select name="filtro" id="filtro" class="select">               <option value="t2.nombre" <? echo $data["filtro"] == 't2.nombre' ? 'selected' : '' ?>>Departure</option>               <option value="t3.nombre" <?php echo $data["filtro"] == 't3.nombre' ? 'selected' : '' ?>>Arrival</option>               <option value="trip_no" <?php echo $data["filtro"] == 'trip_no' ? 'selected' : '' ?>>Trip</option>	       <option value="anno" <?php echo $data["filtro"] == 'anno' ? 'selected' : '' ?>>Year</option>            </select>              <span class="search">             <input name="texto" type="text" autocomplete="off" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>               <input type="button" class="search-btn" id="btn-find" />            </span>            <?php if($data['type_rate']==2){ ?>               <div id="opera" class="input" style="float:right;" >              <label style="width:auto" for="acompany" class="filter-by" style="float:right;" >Filter By Agency : </label>            <div class="ausu-suggest" style="float:right;" >                               <input name="acompany" style="width:90%;" type="text" autocomplete="off" id="acompany" size="30" maxlength="30" class="input-search" value="<?php echo $data["acompany"] ?>"  />               <input type="hidden" size="4" value="<?php echo $data['id_agency'] ?>" name="id_agencya" id="id_agencya" autocomplete="off" />              </div>               </div>             <?php } ?>             <input name="mod" type="hidden" id="mod" value="roles" />            </div>                                     <div id="datagrid">            <table class="grid" cellspacing="1" width="100%" id="grid">                 <thead>                    <tr>                        <th width="20">&nbsp;</th>                        <?php if($data['type_rate']==2){ ?><th width="105">Agency</th><?php } ?>                        <th width="107">Departure</th>                        <th width="159">Arrival</th>                        <th width="59">Trip</th>                        <th width="56">Adult Price</th>                        <th width="56">Child Price</th>                        <th width="56">Child Price R.</th>			<th width="56">Adult Price R.</th>						                        <th width="128">Departure Time</th>                        <th width="105">Arrival Time</th>			<th width="105">Year</th>                    </tr>                </thead>                <tbody>                    <?php                    $i = 0;                      foreach ($data["trips"] as $e):                    ?>                        <tr class="row<?php echo $i ?>">                            <td><input name="item" type="radio" value="<? echo $e['id'].":".$e['type_rate']; ?>" /></td>                            <?php if(isset($e['company_name'])){ ?><td><? echo isset($e['company_name'])?$e['company_name']:"-"; ?></td><?php } ?>                            <td><?php echo $e['trip_from']; ?></td>                            <td><?php echo $e['trip_to']; ?></td>                            <td><?php echo $e['trip_no']; ?></td>                            <td><?php echo $e['price']; ?></td>                            <td><?php echo $e['price2']; ?></td>                            <td><?php echo $e['price3']; ?></td>			    <td><?php echo $e['price4']; ?></td>                            <td><?php echo date("H:i A",strtotime($e['trip_departure'])); ?></td>                            <td><?php echo date("H:i A",strtotime($e['trip_arrival'])); ?></td>		   	    <td><?php echo $e['anno']; ?></td>                        </tr>                    <?php                                                 $i = 1 - $i;                    endforeach;                    ?>                </tbody>                            </table>             <div id="pagination">                <?php echo $data['pager'] ?>            </div>        </div>    </form></div><script type="text/javascript">     $('#grid tr').click(function() {$(this).find('input[name="item"]').prop('checked', true)   });    //auto-complete       $("#acompany").keyup(function(){        $("#acompany").autocomplete({                source: '<?php echo $data["rootUrl"]; ?>admin/tours/loadcompany/'+$("#acompany").val(),                select: function(event, ui) {                  $('#id_agencya').val(ui.item.id);              }          });         });         $("#acompany").keypress(function(e){       if (e.keyCode==13)           $('#form1').submit();    });            $('texto').keypress(function(e){       if (e.keyCode==13)           $('#form1').submit();    });        $('#btn-find').click(function(){       $('#form1').submit();    });    $('#btn-edit').click(function(e){        var id = $('input[name=item]:checked').attr('value');                if (!id){         alert('You must select an Item');         e.preventDefault();       }       else {           var action = $(this).attr("href") + "/" + id;           $(this).attr("href",action);       }   });             $('#btn-delete').click(function(e){        n = $('input[name=item]:checked').attr('value');        if (!n){          alert('You must select an Item');          e.preventDefault();        }else {            if (confirm("Are you sure of deleting this item? ...")){               var action = $(this).attr("href") + "/?item=" + n;               $(this).attr("href",action);            }else			{			return false;			}        }    });     </script>