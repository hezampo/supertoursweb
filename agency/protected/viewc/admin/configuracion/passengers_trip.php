<?php
$url = $this->data['url'];
$url = str_replace('/', '.', $url);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<?php $i = 0; $cont = 1; foreach ($data["reservas"] as $e) {   $pax_tot += $e['pax'] + $e['pax2'];  $i = 1 - $i;} ?>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>  
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css"/>

<?php if (isset($_REQUEST['msg'])) { ?>
    <div class="error" style="margin-top: 10px;"><?php /* echo $_REQUEST['msg']; */ ?></div>
<?php } ?>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/trips/passengers"  class="form" id="form1">


    <div id="header_page" >
        <!--<div class="header">Print passengers lists </div>   &nbsp;&nbsp;&nbsp;&nbsp;▒▒▒ Todos Los Pagos en CASH, están Habilitados ▒▒▒ -->
        <div class="header">Print passengers lists</div>
        <div id="toolbar">
            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar" id="btn-areas"><a class="link-button"  id="btn-areas"> <span class="icon-32-save"
                                                                                                         title="Assign bus passengers"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/brujula.png" width="24" height="24" /></span>
                            Areas </a></li>

                    <li class="btn-toolbar" id="btn-bus">
                        <a class="link-button"  id="btn-bus"> 
                            <span class="icon-32-save" title="Assign bus passengers"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/bus.png" width="24" height="24" /></span>
                            Bus </a>
                    </li>

                    <li class="btn-toolbar" id="">
                    </li>
                    <li class="btn-toolbar" id="btn-save"><a class="link-button"  id="btn-save"> <span class="icon-32-save"
                                                                                                       title="Nuevo">&nbsp;</span>
                            Save </a></li>
                    <li class="btn-toolbar" id="btn-cancel">
                        <a href="<?php echo $data['rootUrl']; ?>admin/home" class="link-button"> <span class="icon-back" title="Editar">&nbsp;</span>
                            Cancel </a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>


<!--    <div id="form">-->
        <div id="filter-bar" style="margin-top:12px;">

            <label style="width:70px" class="filter-by"><strong>Trip </strong></label>
            <select name="trip" id="trip" class="select">
                <?php foreach ($data["trips"] as $e) { ?>
                    <option value="<?php echo $e['trip_no'] ?>" <?php echo ($data['trip_no'] == $e['trip_no']) ? ' selected ' : ' ' ?> ><?php echo $e['trip_no'] . ' - ' . $e['equipment'] ?></option>
                <?php } ?>
            </select>

            &nbsp;&nbsp;&nbsp;
            <label style="width:70px;" class="filter-by"><strong>Date</strong> </label>
            <input style="width:100px; text-align: center;"  name="fecha_ini" type="text"  id="fecha_ini" title="M-D-Y" size="8" value="<?php echo date('m-d-Y', strtotime($data['fecha'])); ?>" onchange=""/>
            <input style="display:none; width:45px; text-align: center;"  name="orden" type="text"  id="orden" title="" size="8" value="0" onchange=""/>

            
            <input type="button" class="search-btn" id="btn-find" />
             &nbsp;&nbsp;&nbsp;
            <label style="width:70px" ><strong>Total Pax</strong> </label>
            <input type="text" id="total_pax" name="total_pax" style="width:35px; text-align: center;" size="8" value="<?php echo $pax_tot ; ?>" readonly="readonly"/>
            <label style="margin-left:25px; width:70px" ><strong>List Preview</strong> </label>
            <a id="preview" onclick="pdf();"> <i class="fa fa-arrow-circle-o-down fa-3x" aria-hidden="true" title="Download" style="cursor: pointer; position:absolute; margin-left: 4px; margin-top:-7px; color:#00bb2d;"></i></a>
        </div>

        <div id="datagrid">

            <table class="grid" cellspacing="1" id="grid">
                <thead>
                    <tr>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="20">&nbsp;</th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="67"><center>Collect</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="20">ON BOARD</th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="30">Id</th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="120"><center>Pax Name</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="30"><center>Pax#</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="89"><center>Agency</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="40"><center>Type Tour</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="35"><center>Route</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="71"><center>From</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="67"><center>To</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="67"><center>PickUp</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="67"><center>DropOff</center></th>
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="35"><center>Total</center></th>
<!--                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="35"><center>Confirmed</center></th>    -->
                        <th style="font-size: 11px; color:#fff; background-color:#F90A45;" width="20">&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                    $cont = 1;
                    foreach ($data["reservas"] as $e) {
                        //print_r($e);
                        if ($e['type_tour'] == 'ONE') {
                            
                             
                            
                            $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?";
                            $rs = Doo::db()->query($sql, array($e['id_tours'], $e['type_tour']));
                            $pagado = $rs->fetch();
                            
                            $sql2 = "select passenger_balance_due as collect from tours_oneday where id = ?";
                            $rs2 = Doo::db()->query($sql2, array($e['id_tours']));
                            $pagado2 = $rs2->fetch();
                            
                            $sql1 = "select agency_balance_due from tours_oneday where id = ?";
                            $rs1 = Doo::db()->query($sql1, array($e['id_tours']));
                            $pagado1 = $rs1->fetch();     
                            $totalcargos = $pagado1['agency_balance_due'];
                            
                            
//                            print_r($pagado2);
//                            exit();
                            
                        }else if ($e['type_tour'] == 'MULTI') {
                            
                            
                                               
                            $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?";
                            $rs = Doo::db()->query($sql, array($e['id_tours'], $e['type_tour']));
                            $pagado = $rs->fetch();
                            
                            //habilitar cuando esten listas las cajas de multiday
                            
                                          
                            $sql2 = "select passenger_balance_due as collect, total_charge from tours where id = ?";
                            $rs2 = Doo::db()->query($sql2, array($e['id_tours']));
                            $pagado2 = $rs2->fetch();                            
                            //$totalcargos = $pagado2['total_charge'];
                            
                            //$agen_bal_due = $pagado2['agency_balance_due'];
                            //print($agen_bal_due);
                            
                            $sql1 = "select agency_balance_due from tours where id = ?";
                            $rs1 = Doo::db()->query($sql1, array($e['id_tours']));
                            $pagado1 = $rs1->fetch();     
                            $totalcargos = $pagado1['agency_balance_due'];
                            
                            
                        }else {
                            
                           
                            $sql = "select sum(pagado) as total from reservas_pago where id_reserva = ?";
                            $rs = Doo::db()->query($sql, array($e['id']));
                            $pagado = $rs->fetch();
                            
                            $sql2 = "select passenger_balance_due as collect, totaltotal from reservas where id = ?";
                            $rs2 = Doo::db()->query($sql2, array($e['id']));
                            $pagado2 = $rs2->fetch();
                            
                           
                            //print_r($pagado2);
                            //exit();
                        }
                        
                        $var = explode('-', $e['pago']);
                        
                        //print($e["tipo_pago"]);
                        
                        if ($e["tipo_pago"] == "COMPLEMENTARY") {
                            $pagado["total"] = 0;
                            $e['totaltotal'] = 0;
                        }
                        
                        if ($e["tipo_pago"] == "VOUCHER" && $e['type_tour'] == 'ONE') {
                            //$pagado["total"] = $agen_bal_due;
                            $total1 = $totalcargos;
                            
                            $total = number_format($total1, 2, '.', '');
                            

                        }
                        if ($e["tipo_pago"] == "VOUCHER" && $e['type_tour'] == 'MULTI') {
                            //$pagado["total"] = $agen_bal_due;
                            $total1 = $totalcargos;
                            
                            $total = number_format($total1, 2, '.', '');
                            

                        }

                        if ($e["tipo_pago"] == "VOUCHER" && $e['type_tour'] == '') {
                            //$pagado["total"] = $agen_bal_due;                    
                            
                            $total1 =  $e['totaltotal'];
                            
                            $total = number_format($total1, 2, '.', '');
                            

                        }
                        
                       
//                        if ($var[0] == "5") {
//                            $pagado["total"] = 0;
//                            $e['totaltotal'] = 0;
//                        }

                        $dato_pago = $e['tipo_pago'];


                        if ($e['otheramount'] > 0) {
                            $valor_total = $e['otheramount'];
                        } else {
                            $valor_total = $e['totaltotal'];
                        }
                        if ($e["tipo_pago"] == "COMPLEMENTARY") {
                            $valor_total = 0;
                        }
                        if ($e["tipo_pago"] == "VOUCHER") {
                            $valor_total = 0;
                            $total1 = $e["totaltotal"];
                            $total = number_format($total1, 2, '.', '');
                        }

                        if ($var[0] == "5") {
                            $valor_total = 0;
                        }
                        
                        

                        ////////////////////////////////////////////////////////////////////////////////////
                        //$colectar = $valor_total - $pagado["total"];
                        $colectar = $pagado2['collect'];
                        if ($e["id_tours"] != -1) {
                            $id = $e['id_tours'];
                            if ($e["type_tour"] == "MULTI") {
                                $ruta = "admin/tours/edit/";
                                $url2 = "";
                            } else {
                                $ruta = "admin/onedaytour/edit/";
                                $url2 = "";
                            }
                        } else {
                            $id = $e['id'];                            
                            $ruta = "admin/reservas/edit/";
                            $url2 = "/" . $url;
                        }
                        
                       
                        $url1 = $data['rootUrl'] . $ruta . $id;

                        if ($e["otheramount"] > 0) {
                            //$total = $e["otheramount"];
                            $total1 = $e["totaltotal"];
                            $total = number_format($total1, 2, '.', '');
                         }else if ($pagado["total"] > 0 && $e["tipo_pago"] == "VOUCHER" && $e['type_tour'] == '') {
//                            $total1 = ($colectar + $pagado["total"]);  
//                            $total = number_format($total1, 2, '.', '');
                            
                            $total1 = $e["totaltotal"];
                            $total = number_format($total1, 2, '.', '');
                            
                            
                        }else if ($pagado["total"] > 0 && $e["tipo_pago"] != "VOUCHER"){
                            
                            $total1 = ($colectar + $pagado["total"]);  
                            $total = number_format($total1, 2, '.', '');                            
                            
                        }else {   
                        
                            $total1 = $e["totaltotal"];
                            $total = number_format($total1, 2, '.', '');
                        }
                        ?>
                        <tr class="row<?php echo $i ?>">
                            <td><input type="checkbox" class="activar" name="activar_<?php echo ($e['type_tour'] == "" ? $e['id'] : $e['id_tours']); ?>_<?php echo ($e['type_tour'] == "" ? "TRANSP" : $e['type_tour']); ?>"  id="<?php echo ($e['type_tour'] == "" ? $e['id'] : $e['id_tours']); ?>_<?php echo ($e['type_tour'] == "" ? "TRANSP" : $e['type_tour']); ?>" value="1" style="width: 15px; height: 15px;"> </td>
                            <td>
                                <input type="text"  value="<?php echo ($colectar != 0) ? number_format($colectar, 2,'.', '') : 0; ?>" id="equipaje_<?php echo ($e['type_tour'] == "" ? $e['id'] : $e['id_tours']); ?>_<?php echo ($e['type_tour'] == "" ? "TRANSP" : $e['type_tour']); ?>" name="pagos[equipaje_<?php echo ($e['type_tour'] == "" ? $e['id'] : $e['id_tours']); ?>_<?php echo ($e['type_tour'] == "" ? "TRANSP" : $e['type_tour']); ?>]" disabled="disabled" style="text-align:right;  width: 60px;  height: 25px;"/>
                            </td>
                            <td>
                                    <select name="<?php echo ($e['type_tour'] == "" ? $e['id']."_TRANSP" : $e['id_tours']."_".$e['type_tour']); ?>" style="width: 70px;">
                                        <option value="CASH" checked>CASH</option>
                                        <option value="CREDIT CARD WITH FEE" disabled>CREDIT CARD WITH FEE (Esto se hace en la reserva)</option>
<!--                                        <option value="CREDIT CARD WITH FEE" >CREDIT CARD WITH FEE</option>-->
                                        <option value="CREDIT CARD NO FEE" >CREDIT CARD NO FEE </option>                                        
                                        <option value="CHECK">CHECK</option>                                        
                                    </select> 
                            </td>
                            
                            <td><?php echo $e['id']; ?></td>
                            <td><?php echo $e['firsname'] . " " . $e['lasname']; ?> </td>
                            <td style="text-align:center;"><?php echo $a = $e['pax'] + $e['pax2']; ?> </td>                            
                            <td><?php echo $e['company_name']; ?></td>  
                            <td style="text-align:center;"><?php echo $e['type_tour']; ?></td> 
                            <td><?php echo $e['tipo_ticket']; ?></td>
                            <td><?php echo $e['de']; ?> </td>
                            <td><?php echo $e['para']; ?> </td>
                            <td>
                                <?php
                                if ($e['nomExten1'] != "") {
                                    echo $e['nomExten1'] . " - (" . $e['extension1'] . ")";
                                } else {
                                    echo $e['pickup'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($e['nomExten2'] != "") {
                                    echo $e['nomExten2'] . " - (" . $e['extension2'] . ")";
                                } else {
                                    echo $e['dropoff'];
                                }
                                ?> 
                            </td>
                            <td><?php echo $total; ?> </td>
<!--                            <td><img style="position:absolute; width:16px; height:15px; margin-left:19px; margin-top:-9px;" src="<?php echo $data['rootUrl'] ?>global/img/confirmed.gif"></td>-->
                            <td> 
                                <!--resizable=yes, location=no, menubar=yes, scrollbars=yes, status=no, toolbar=no, fullscreen=yes, dependent=no, width=1920, height=1080, left=0, top=0-->
                                <?php if ($e["type_tour"] == "ONE") {?>
                                <a href="javascript:void(window.open('<?php echo $url1; ?>','ONEDAY',''))" id="btn-edit" class="link-button" > <img  src="<?php echo $data['rootUrl']; ?>global/img/admin/edit2.png" title="Modify One Day reservation data"/></a>                                                                 
                                <?php }elseif ($e["type_tour"] == "MULTI"){?>
                                <a href="javascript:void(window.open('<?php echo $url1; ?>','MULTIDAY',''))" id="btn-edit" class="link-button" > <img  src="<?php echo $data['rootUrl']; ?>global/img/admin/edit2.png" title="Modify Multi Day reservation data"/></a>
                                <?php }else {?>
                                <a href="javascript:void(window.open('<?php echo $url1; ?>','RESERVAS',''))" id="btn-edit" class="link-button" > <img  src="<?php echo $data['rootUrl']; ?>global/img/admin/edit2.png" title="Modify Transportations reservation data"/></a>        
                                <?php }?>
                                
                                
                            </td>
                        </tr>
                        <?php
                        $i = 1 - $i;
                    }
                    ?>

                <tr title="Total Pax" style="background-color:#fff; text-align:center; font-weight:bold; color:#0C0C69;" width="23" height="10">
                            
                            <td></td>                           
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td id="tot_pax" style="background-color:#fff; color:#000; font-size:12px; border: #000 1px solid;">
                                <?php echo $pax_tot; ?>
                            </td>                            
                            <td></td>                          
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                            <td></td> 
<!--                            <td></td> -->
                            
                        </tr>


                </tbody>


            </table>
            <div id="pagination">
                <?php echo $data['pager'] ?>
            </div>
        </div>

</form>
    
<!--<div class="content-popup"></div>-->

<!--</div>-->
<?php if (isset($_SESSION['elimi'])) { ?>
    <script>
        jQuery.noticeAdd({
            text: '<?php echo $_SESSION['elimi']; ?>',
            stay: true
        });
    </script>
<?php } unset($_SESSION['elimi']); ?>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

<?php
$botones = $data['botones'];
foreach ($botones as $key => $e) {
    ?>
            //Motramos o Ocultamos los motones
            document.getElementById('<?php echo $key; ?>').style.display = '<?php echo $e; ?>';
<?php } ?>

        function cambiarbg(id, color, tiempo) {
            $('#' + id).animate({
                'background-color': color
            }, tiempo);
        }
        
        

        $("#fecha_ini").datepicker({
            dateFormat: 'mm-dd-yy',
            maxDate: 365
        });
        function buscar() {
            var sErrMsg = '';
            if (!ValidarFecha($('#fecha_ini').val())) {
                sErrMsg += '- Incorrect date \n';
            }
            if (sErrMsg != '') {
                alert(sErrMsg);
                return false;
            }
            var trip = $('#trip').val();
            var fecha = $('#fecha_ini').val();
            $('#form1').submit();

        }

        $('texto').keypress(function (e) {
            if (e.keyCode == 13)
                buscar();
        });

        $('#btn-find').click(function () {
            buscar()
        });

        $('#btn-save').click(function () {

            if (!ValidarFecha($('#fecha_ini').val())) {
                alert('- Incorrect date \n');
            } else {
                var action = '<?php echo $data['rootUrl']; ?>admin/trips/passengers/save';

                $('#form1').attr('action', action);
                $('#form1').submit();
            }
        })

        $('#btn-areas').click(function () {
            if (!ValidarFecha($('#fecha_ini').val())) {
                alert('- Incorrect date \n');
            } else {
                var action = '<?php echo $data['rootUrl']; ?>admin/trips/passengers/bus';

                $('#form1').attr('action', action);
                $('#form1').submit();
            }
        })

        $('#btn-bus').click(function () {
            if (!ValidarFecha($('#fecha_ini').val())) {
                alert('- Incorrect date \n');
            } else {
                var action = '<?php echo $data['rootUrl']; ?>admin/trips/passengers/bus-two';

                $('#form1').attr('action', action);
                $('#form1').submit();
            }
        })


        $('#btn-edit').click(function (e) {
            var action = $(this).attr("href") + "/" + id;
            $(this).attr("href", action);
        });
        $('.activar').click(function (e) {
            if ($(this).is(":checked")) {
                $('#'+"equipaje_"+$(this).attr("id")).attr("disabled",false);                
            }else{
                $('#'+"equipaje_"+$(this).attr("id")).attr("disabled",true);
            }         
        });
        $('#btn-delete').click(function (e) {
            n = $('input[name=item]:checked').attr('value');
            if (!n) {
                alert('You must select an Item');
                e.preventDefault();
            } else {
                if (confirm("Are you sure of deleting this item? ...")) {
                    var action = $(this).attr("href") + "/?item=" + n;
                    $(this).attr("href", action);
                } else
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
function pdf(){
            
            var trip_no = document.getElementById('trip').value;
            var fecha_salida = $('#fecha_ini').val(); 
            $('#orden').val(1);
            //var orden = 1
            var orden = document.getElementById('orden').value;
            
            //alert(fecha_salida);
            
            //$(".content-popup").html(" ");
            var url = "<?php echo $data['rootUrl']; ?>admin/trips/passengers/" + trip_no + "/" + fecha_salida + "/" + orden;
            location.href = url;  
            $('#orden').val(0);
            //$('.content-popup').load(url);
            //$("#datagrid").load(url);
            
            
        }
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
        if (window.screen.availWidth == 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }      
            
        if (window.screen.availWidth > 1440) {
            window.parent.document.body.style.zoom = "125%";

        }
//            capturar();

      
    }

</script>



