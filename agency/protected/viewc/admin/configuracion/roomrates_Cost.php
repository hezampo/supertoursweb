<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>


<?php if(isset($_REQUEST['msg'])){?>
    <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>
<?php } ?>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/tours/room-rates-cost"  class="form" id="form1">
    <div id="header_page" >
        <div class="header">Room Rates COST</div>
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/room-rates-cost/add" id="btn-add" class="link-button">
                            <span class="icon-new" title="Nuevo" >&nbsp;</span>
                            New
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/room-rates-cost/edit" id="btn-edit" class="link-button" >
                            <span class="icon-edit" title="Editar" >&nbsp;</span>
                            Edit
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/room-rates-cost/delete" id="btn-delete" class="link-button">
                            <span class="icon-delete" title="Eliminar" >&nbsp;</span>
                            Delete
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
    </div>
    <div id="form" >

        <div id="filter-bar" >

            <label style="width:70px" class="filter-by">Filter By</label>
            <select name="filtro" id="filtro" class="select">
                <option value="codigo" <?php echo $data["filtro"] == 'codigo' ? 'selected' : '' ?>>Hotel Code</option>
                <option value="nombre" <?php echo $data["filtro"] == 'nombre' ? 'selected' : '' ?>>Hotel Name</option>
            </select>

            <span class="search">
                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" />
            </span>

        </div>

        <div id="datagrid">
            <table class="grid"  align="center" cellspacing="1"  id="grid">
                <thead>
                <tr>
                    <th style="background-color:#F90A45;" width="20">&nbsp;</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="90">Hotel Name</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="83">Starting Date</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="70">Ending Date</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="75">Sgl Price</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="74">Dbl Price</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="80">Tpl Price</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="84">Qua Price</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="79">Breakfast</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="80">Super Breakfast </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($data["ratesroom"] as $e){
                    ?>
                    <tr class="row<?php echo $i ?>">
                        <td><input name="item" type="radio" value="<?php echo $e['id']; ?>" /></td>
                        <td style="font-size: 9px;"><?php echo $e['nombre']; ?></td>
                        <td style="text-align:center;"><?php echo date("m-d-Y",$e['fecha_ini']); ?></td>
                        <td style="text-align:center;"><?php echo date("m-d-Y",$e['fecha_fin']); ?></td>
                        <td style="text-align:center;"><?php echo $e['sgl']; ?></td>
                        <td style="text-align:center;"><?php echo $e['dbl']; ?></td>
                        <td style="text-align:center;"><?php echo $e['tpl']; ?></td>
                        <td style="text-align:center;"><?php echo $e['qua']; ?></td>
                        <td style="text-align:center;"><?php echo $e['brackfast']; ?></td>
                        <td style="text-align:center;"><?php echo $e['super_breakfast']; ?></td>
                    </tr>
                    <?php
                    $i = 1 - $i;
                }
                ?>
                </tbody>
                <thead><tr></tr>
                </thead>
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
            }
        }
    });

</script>


<script type="text/javascript">

    function comprobarScreen()
    {

        window.moveTo(0, 0);
        window.resizeTo(screen.width, screen.height);
        window.fullScreen;

        if (window.screen.availWidth <= 640) {
            window.parent.document.body.style.zoom = "62%";
        }

        if (window.screen.availWidth == 800) {
            window.parent.document.body.style.zoom = "78%";
        }
        if (window.screen.availWidth == 1024) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1440) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1600) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1680) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth > 1680) {
            window.parent.document.body.style.zoom = "125%";

        }
    }

</script>

<script type="text/javascript">
    
    
$(window).load(function () {

    comprobarScreen();

});


</script>