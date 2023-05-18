<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.7.2.min.js"></script>
<script language="javascript" src="<?php echo $data['rootUrl']; ?>global/js/js/jquery-1.2.6.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<?php if (isset($_REQUEST['msg'])) { ?>
<div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>
<?php } ?>

<style type="text/css" media="screen">  
    ::-webkit-input-placeholder { color: #fff; } /* WebKit */
    :-moz-placeholder { color: #fff; } /* Firefox 18- */
    ::-moz-placeholder { color: #fff; } /* Firefox 19+ */
    :-ms-input-placeholder { color: #fff; } /* IE 10+ */
    
    .flashit{
                  color:#f2f;
                        -webkit-animation: flash linear 10s infinite;
                        animation: flash linear 1s infinite;
                }
                @-webkit-keyframes flash {
                        0% { opacity: 1; } 
                        50% { opacity: .6 } 
                        100% { opacity: 1; }
                }
                @keyframes flash {
                        0% { opacity: 1; } 
                        50% { opacity: .6; } 
                        100% { opacity: 1; }
                }
    
</style> 



<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/onedaytour" class="form" id="form1">
    
    <?php
    $prueba = $_POST["inputform"];
    ?>


    <div><input type="text" id="inputform" name="inputform" style="display:none;"></div>
    <div><input name="php" type="submit"  id="php" value="Enviar valor" style="display:none;"></div>

    <div><input name="edition" type="button"  id="edition" style="display:none;" value="Edition" <?php
        $id = trim($prueba);
        echo $id;
        $ruta = "admin/onedaytour/edit/";
        $url = $data['rootUrl'] . $ruta . $id;
        ?> <a href="#" onclick="javascript:void(window.open('<?php echo $url; ?>', 'ONEDAY', ''))"></div>
    <div><input name="regreso" type="submit"  id="regreso" style="display:none;" value="Regresar" onclick="regresar();" ></div>

    <div id="resultado" style="display:none;"></div>
    
    
    
    <div id="header_page">
        <div class="header">One day Tours</div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>
                    
                    <li class="btn-toolbar" style="height: 40px;">

                    <body  onload="colores()">
                        
<!--                       <p style="margin-top:40px; margin-left:-99px; width:140px;" align="center"><font style="margin-top:0px; margin-left:0px; font-size:10px; font-weight:bold;" id="Tutores" size="38">■■■■■■■■■■■■■■■■■■■■■■■■■■</font></b></p>-->

                    </body>
                    
                    </li>
                    
                    <li class="btn-toolbar" style="height: 40px;">


                        <input class="flashit" style="text-align: center; width:170px; height: 24px; margin-top: 11px; margin-left: -189px; border-radius: 8px 8px 8px 8px; background-color: #2D2193; border:4; border-color:#2D2193; color:#fff; font-size:14px;" autocomplete="off"  placeholder="Id Reserve" type="text" size="30" maxlength="30"  id="idreser" value="<?php if($id >0){echo 'Id:'.'   '.$id.'   ';}else{echo 'Selecciona un Id';}?>"/>

                        <div class="flashit">
                            <a class="link-button" id="flecha"> <i class=" fa fa-hand-o-right fa-3x"  style="margin-left: 11px; margin-top:-34px; color:#2D2193;"></i></a>
                        </div>

                    </li>
                    
     
                        
                    <li class="btn-toolbar" style="height: 40px;">

                        <?php
                        $id = trim($prueba);                       
                        $ruta = "admin/onedaytour/edit/";
                        $url1 = $data['rootUrl'] . $ruta . $id;
                        ?>

                        <a href="javascript:void(window.open('<?php echo $url1; ?>','ONEDAY',''))" id="btn-edit"  class="link-button" onclick=""><img src="<?php echo $data['rootUrl']; ?>global/img/admin/edit2.png" style="margin-top:-2px; height:25px;" title="Modify reservation data"/>

                            <span style="margin-top:-10px; height: 12px;" title="Editar" >Edit</span>
                          
                        </a>

                    </li>
                    
                    <li class="btn-toolbar"><a id="btn-add" class="link-button" style="margin-left:1px;" href="javascript:void(window.open('<?php echo $data['rootUrl'] ?>admin/onedaytour/add','ONEDAYADD',''))" ><span class="icon-new" title="Nuevo">&nbsp;</span>        
                            
                        New </a></li>
                        
                        
                        
                    <li class="divider">&nbsp;</li>
                    <li class="btn-toolbar"><a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back"
                                               class="link-button"> <span class="icon-back"
                                                                          title="Regresar">&nbsp;</span> Back </a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="form">
        <div id="filter-bar">
            <label style="width:70px" class="filter-by">Filter By</label>
            <select name="filtro2" id="filtro" class="select">
                <option value="code_conf" <?php echo $data["filtro2"] == 'code_conf' ? 'selected' : '' ?> >Confirmation Code</option>                
                <option value="t.id" <?php echo $data["filtro2"] == 't.id' ? 'selected' : '' ?> >ID</option>                
                <option value="firstname" <?php echo $data["filtro2"] == 'firstname' ? 'selected' : '' ?> >Firstname</option>
                <option value="lastname" <?php echo $data["filtro2"] == 'lastname' ? 'selected' : '' ?>>Lastname</option>
            </select>
      <span class="search">
      <input name="texto2" type="text" size="30" maxlength="30" class="input-search" id="texto"
             value="<?php echo $data["texto2"] ?>"/>
      <input type="button" class="search-btn" id="btn-find"/>
      </span></div>
        
        
        <div id="datagrid">
            <table class="grid" cellspacing="1" id="grid">
                <thead>
                <tr>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">&nbsp;</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="20">Id</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;"># Confirmation</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">Pax Name</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">Agency</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">Employee</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">Creation Date</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">Tour's Date</th>
                    <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($data["tours"] as $e){
				if($e['otheramount'] != 0){
					$total = $e['otheramount'];
				}else{
					$total = $e['totalouta'];
				}
                    ?>
                <tr class="row<?php echo $i ?>">
                    <td style="text-align:center;"><input name="item" type="radio" onclick="capturar();" value="<?php echo $e['id']; ?>"/></td>
                    <td style="text-align:center;" ><input style="text-align:center; border-radius: 8px 8px 8px 8px;width:42px; background-color: #F90A45; border:0; color:#fff;" id="id_reserva" name="id_reserva" value="<?php echo $e['id']; ?>"/></td>                         
                    <td style="text-align:center; font-size: 10px; color:#000; font-weight:bold;"><?php if($e['estado'] == "CANCELED") {?> <strike>  <?php } ?><?php echo $e['code_conf']; ?><?php if($e['estado'] == "CANCELED") {?> </strike>  <?php } ?></td>
                    <td style="font-size: 9px; text-align:left;"><?php echo $e['nomcliente']; ?></td>
                    <td style="font-size: 9px; text-align:left; width:191px;"><?php echo $e['company_name']; ?></td>
                    <td style="font-size: 9px; text-align:left;"><?php echo $e['nomempleado']; ?></td>
                    <td style="font-size: 9px; text-align:center;"><?php echo date('Y-m-d',strtotime($e['creation_date'])).'/ '.date('h:i:s A',strtotime($e['creation_date']));?></td>
                    <td style="font-size: 10px; text-align:center;"><?php echo date('M-d-Y',strtotime($e['starting_date'])); ?></td>
                    <td style="font-size: 10px; text-align:center;"><?php echo  number_format($total, '2','.','.'); ?></td>
                </tr>
                    <?php
                    $i = 1 - $i;
                     }
                ?>
                </tbody>
            </table>
            
            <script language="JavaScript">
                i = 0;
                function colores()
                {
                    tabcolores = new Array("#f6f6f6", "#F90A45", "#f6f6f6", "#F90A45");
                    if (i + 1 == tabcolores.length)
                        i = 0;
                    else
                        i++;
                    document.getElementById("Tutores").setAttribute('color', tabcolores[i]);
                    setTimeout("colores()", 500);
                }
            </script>

            
            <div id="pagination"> <?php echo $data['pager']?> </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
    $(window).load(function () {

//        ocultarmenu();
        comprobarScreen();


    });
    
    $('#grid tr').click(function () {
        $(this).find('input[name="item"]').prop('checked', true)

    });

    $('texto').keypress(function (e) {
        if (e.keyCode == 13)
            $('#form1').submit();
    })

    $('#btn-find').click(function () {
        $('#form1').submit();
    });

    $('#btn-edit').click(function (e) {
        var id = $('input[name=item]:checked').attr('value');
        if (!id) {
//            alert('You must select an item');
//            e.preventDefault();
        }
        else {
//            var action = $(this).attr("href") + "/" + id;
//            $(this).attr("href", action);
        }
    });

    $('#btn-delete').click(function (e) {
        n = $('input[name=item]:checked').attr('value');
        if (!n) {
            alert('You must select an item');
            e.preventDefault();
        } else {
            if (confirm("Are you sure of deleting this item? ...")) {
                var action = $(this).attr("href") + "/?item=" + n;
                $(this).attr("href", action);
            } else {
                return false;
            }
        }
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

<script type="text/javascript">
    function regresar()
    {

        window.location.href == "<?php echo $data['rootUrl']; ?>admin/reservas";
        
        setTimeout(function () {

            $('#btn-back').click();

        }, 100);


    }
</script>

<script type="text/javascript">
    function retorno()
    {
        //$('#regreso').click();

    }
</script>

<script>

    var z
    function capturar()
    {
        var resultado = "ninguno";

        var porNombre = document.getElementsByName("item");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for (var i = 0; i < porNombre.length; i++)
        {
            if (porNombre[i].checked)
                resultado = porNombre[i].value;

        }

        //z = document.getElementById("resultado").innerHTML = " \ " + resultado;
        z = document.getElementById("resultado").innerText = " \ " + resultado;
        document.getElementById("inputform").value = z;



        setTimeout(function () {

            $('#php').click();

            exit;

        }, 10);
        
    }


</script>

