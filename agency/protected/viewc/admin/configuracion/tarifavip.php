<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/><script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script><link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" /><link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" /><script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script><?php if(isset($_REQUEST['msg'])){?>    <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div><?php } ?><form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/tours/tarifa-vip/<?php echo $data['type_rate']; ?>"  class="form" id="form1">    <div id="header_page" >        <div class="header">(Tours) VIP Rates - <?php            if($data['type_rate']==0){                echo 'By Commission';            }else if($data['type_rate']==1){                echo 'Net Prices';            }else if($data['type_rate']==2){                echo 'Special Net Prices';            }            ?></div>        <div  id="toolbar">            <div class="toolbar-list">                <ul>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/tarifa-vip/add/<?php echo $data['type_rate'];?>" id="btn-add" class="link-button">                            <span class="icon-new" title="Nuevo" >&nbsp;</span>                            New                        </a>                    </li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/tarifa-vip/edit" id="btn-edit" class="link-button" >                            <span class="icon-edit" title="Editar" >&nbsp;</span>                            Edit                        </a>                    </li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/tarifa-vip/delete" id="btn-delete" class="link-button">                            <span class="icon-delete" title="Eliminar" >&nbsp;</span>                            Delete                        </a>                    </li>                    <li class="divider">&nbsp;</li>                    <li class="btn-toolbar">                        <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">                            <span class="icon-back" title="Regresar" >&nbsp;</span>                            Back                        </a>                    </li>                </ul>                <div class="clear"></div>            </div>            <div class="clear"></div>        </div>    </div>    </div>    <div id="form" >        <div id="filter-bar" >            <label style="width:70px" class="filter-by">Filter By</label>            <select name="filtro" id="filtro" class="select">                <option value="cantidad" <? echo $data["filtro"] == 'cantidad' ? 'selected' : '' ?>>Number Pax</option>                <option value="annio" <? echo $data["filtro"] == 'annio' ? 'selected' : '' ?>>Year</option>            </select>            <span class="search">                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>                <input type="button" class="search-btn" id="btn-find" />            </span>            <?php if($data['type_rate']==2){ ?>                <div id="opera" class="input" style="float:right;" >                    <label style="width:auto" for="company_name" class="filter-by" style="float:right;" >Filter By Agency : </label>                    <div class="ausu-suggest" style="float:right;" >                        <input name="company_name" style="width:90%;" type="text" autocomplete="off" id="company_name" size="30" maxlength="30" class="input-search" value="<?php echo $data["company_name"] ?>"  />                        <input type="hidden" size="4" value="<?php echo $data['id_agency'] ?>" name="id_agency" id="id_agency" autocomplete="off" />                    </div>                </div>            <?php } ?>        </div>        <div id="datagrid">            <table class="grid" cellspacing="1" width="23%" id="grid">                <thead>                <tr>                    <th width="28">&nbsp;</th>                    <?php if($data['type_rate']==2){ ?><th width="105">Agency</th><?php } ?>                    <th width="81">#Pax</th>                    <th width="65"> Price</th>                    <th width="65"> Year</th>                </tr>                </thead>                <tbody>                <?php                $i = 0;                foreach ($data["tarifavip"] as $e):                    ?>                    <tr class="row<?php echo $i ?>">                        <td><input name="item" type="radio" value="<? echo $e['id']; ?>" /></td>                        <?php if(isset($e['company_name'])){ ?><td><? echo isset($e['company_name'])?$e['company_name']:"-"; ?></td><?php } ?>                        <td><?php echo $e['cantidad']; ?></td>                        <td><?php echo $e['price']; ?></td>                        <td><?php echo substr($e['annio'],0,4); ?></td>                    </tr>                    <?php                    $i = 1 - $i;                endforeach;                ?>                </tbody>            </table>            <div id="pagination">                <?php echo $data['pager'] ?>            </div>        </div></form><?php if(isset($_SESSION['vip'])){ ?>    <script>        jQuery.noticeAdd({            text: ' <? echo $_SESSION['vip']; ?>',            stay: true        });    </script><?php }  unset($_SESSION['vip']);?></div><script type="text/javascript">    $('#grid tr').click(function() {        $(this).find('input[name="item"]').prop('checked', true)    });    $('texto').keypress(function(e){        if (e.keyCode==13)            $('#form1').submit();    });    $(function(){        $('#type_rate').change(function(){            if($(this).val()== '2'){                $('#company_name').removeAttr("disabled");                $('#company_name').attr('placeholder','Insert Agency');            }else{                $('#company_name').attr("disabled","disabled");                $('#company_name').val('');                $('#id_agency').val('-1');            }        });    });    //auto-complete    $("#company_name").keyup(function(){        $("#company_name").autocomplete({            source: '<?php echo $data["rootUrl"]; ?>admin/tours/loadcompany/'+$("#company_name").val(),            select: function(event, ui) {                $('#id_agency').val(ui.item.id);            }        });    });    $('#btn-find').click(function(){        $('#form1').submit();    });    $('#btn-edit').click(function(e){        var id = $('input[name=item]:checked').attr('value');        if (!id){            alert('You must select an Item');            e.preventDefault();        }        else {            var action = $(this).attr("href") + "/" + id;            $(this).attr("href",action);        }    });    $('#btn-delete').click(function(e){        n = $('input[name=item]:checked').attr('value');        if (!n){            alert('You must select an Item');            e.preventDefault();        }else {            if (confirm("Are you sure of deleting this item? ...")){                var action = $(this).attr("href") + "/?item=" + n;                $(this).attr("href",action);            }else            {                return false;            }        }    });</script>