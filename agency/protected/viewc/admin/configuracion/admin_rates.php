<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style type="text/css" media="screen">

    .modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
    }
    .modalDialog:target {
            opacity:1;
            pointer-events: auto;
    }
    .modalDialog > div {
            width: 400px;
            position: relative;
            margin: 10% auto;
            padding: 5px 20px 13px 20px;
            border-radius: 10px;
            background: #fff;
            background: -moz-linear-gradient(#fff, #999);
            background: -webkit-linear-gradient(#fff, #999);
            background: -o-linear-gradient(#fff, #999);
      -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    }
    .close {
            background: #606061;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            -moz-box-shadow: 1px 1px 3px #000;
            -webkit-box-shadow: 1px 1px 3px #000;
            box-shadow: 1px 1px 3px #000;
    }
    .close:hover { background: #00d9ff; }


    .ui-widget-header {
        border: 1px solid #dddddd;
        background: #F90A45;
        color: #333333;
        font-weight: bold;
    }
</style>

<?php if(isset($_REQUEST['msg'])){?>

    <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>

<?php } ?>


    
    
<div style= "margin-left:0px; margin-top:0px;">     
          
   <a href="#openModal" style="border: transparent;"><img id="unlock" onclick="" style="cursor:pointer; position: absolute; margin-top:77px; margin-left: 781px; width: 30px; height: 30px;" src ='<?php echo $data['rootUrl'] ?>global/img/calendar_park.png' width="75px" height="75px" margin-left="100px" margin-top="0px"></a>            

</div>
    
    
    <div id="openModal" class="modalDialog">

        <div>

            <a id="cerrar" href="#close" title="Close" class="close">X</a>
            <form id="myform" class="form-wizard">      
                
                <table  style="width: 368px;  margin-left: 17px;">
                <thead>
                            <tr>
                                <td style="text-align: center; width:72px; font-size:11px; background-color: #4571c9; color:#fff; font-weight:bold;">PARK NAME</td>                    
                                <td style="text-align: center; width:5px; font-size:11px; background-color: #4571c9; color:#fff; font-weight:bold;">START DATE</td>
                                <td style="text-align: center; width:37px; font-size:11px; background-color: #4571c9; color:#fff; font-weight:bold;">END DATE</td>
                            </tr>
                </thead>
                </table>
                
                <div style="position:absolute; overflow-y: auto; height:258px; width:365px; margin-left:18px; margin-top:0px;">

                    <table style="heigth:258px; border-color: #a30000; border: 2px solid #a30000; border-left: 1px solid #cdd0d4; border-bottom: 1px solid #cdd0d4; border-top: 1px solid #cdd0d4; border-right: 1px solid #cdd0d4;" class="grid2" cellspacing="1" id="grid2">
                        
                        
                        <?php 

          
                        $sql0 = "SELECT id FROM parques WHERE id NOT IN('24,29,30');";
                        $rs0 = Doo::db()->query($sql0, array(9));
                        $id_parques = $rs0->fetchAll();
                        foreach ($id_parques as $idp) {


                            $parquecillo = $idp['id'];

                            $sql = "SELECT ap.id_parque, MIN(ap.inicio) as minimo, MAX(ap.fin) as maximo, p.nombre as parque FROM admin_parques_tarifa ap
                                    LEFT JOIN parques p ON (ap.id_parque = p.id)         
                                    WHERE ap.id_parque = '$parquecillo' ORDER BY ap.id_grupo ASC;";
                            $rs = Doo::db()->query($sql, array(9));
                            $park_name = $rs->fetchAll();
                            foreach ($park_name as $park) {



                            }



                        ?>
                        <tbody>

                            <?php
     
                            foreach ($park_name as $park) {
                                ?>
                                <tr class="row1">

                                    <td style="text-align: left; font-size:13px; color:#000; background-color: #fff; font-family: arial; font-weight:bold; border-left: 1px solid #cdd0d4; border-bottom: 1px solid #cdd0d4; border-top: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4; width: 80px;"><?php if($park['parque'] == ''){echo " ";}else{echo $park['parque'];} ?></td>
                                    <td style="text-align: center; font-size:10px; color:DIMGRAY; background-color: #fff; font-weight:bold; border-left: 1px solid #cdd0d4; border-bottom: 1px solid #cdd0d4; border-top: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4; width: 40px;"><?php if($park['minimo'] == ''){echo " ";}else{echo $park['minimo'];} ?></td>
                                    <td style="text-align: center; font-size:10px; color:DIMGRAY; background-color: #fff; font-weight:bold; border-left: 1px solid #cdd0d4; border-bottom: 1px solid #cdd0d4; border-top: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4; width: 30px;"><?php if($park['maximo'] == ''){echo " ";}else{echo $park['maximo'];} ?></td>

                                </tr>
                            <?php }
    }?>
                        </tbody>

                    </table>


                </div>


            </form>		
        </div>
    </div>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/1"  class="form" id="form1">
    
     <?php
     
        $texto = $_POST["texto"];
        $filtraje = $_POST["filtraje"];
        $cant_parkes = $_POST["cant_parkes"];   
        $starting_date = $_POST["starting_date"];
        $ending_date = $_POST["ending_date"];
        
        
        
        
        list($dia, $mes, $anyo) = explode("-", $starting_date);
        $fecha1 = $dia . "-" . $mes . "-" . $anyo;
        //$fecha2 = strtotime($fecha1);


       
        
        list($dia2, $mes2, $anyo2) = explode("-", $ending_date);
        $fecha3 = $dia2 . "-" . $mes2 . "-" . $anyo2;
        //$fecha4 = strtotime($fecha3);
        
              
        
        //BUSCAR POR GRUPO PARQUES AND CANTIDAD >= 1
        
        if($fecha1 == $fecha3){
            
                    

            $sqlgroup = "select apt.id, apt.cantidad, apt.adults, apt.child, apt.adults1, apt.child1,  apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo, apt.inicio, apt.fin
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                     where apt.inicio <= '$fecha1' AND apt.fin >='$fecha3' AND apt.cantidad = '$cant_parkes' AND apt.type_rate = '1' AND  gp.nombre LIKE '$texto%' order by apt.id_grupo ASC, p.nombre DESC, apt.inicio DESC, apt.fin DESC, apt.cantidad DESC;";
            $qgroup = Doo::db()->query($sqlgroup);
            $admin_rates_group = $qgroup->fetchAll();

                        
        

        //BUSCAR POR PARQUES
//        if($filtraje == 2){
//    
//       
            $sqlpark = "select apt.id, apt.cantidad, apt.adults, apt.child, apt.adults1, apt.child1,  apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo, apt.inicio, apt.fin
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                     where apt.inicio <= '$fecha1' AND apt.fin >='$fecha3' AND apt.type_rate = '1' AND  p.nombre LIKE '$texto%' order by apt.id_grupo ASC, p.nombre DESC, apt.inicio DESC, apt.fin DESC, apt.cantidad DESC;";
            $qpark = Doo::db()->query($sqlpark);
            $admin_rates_park = $qpark->fetchAll();
//                       
//                    
//        }  
            
        }else{
            
                        
            $sqlgroup = "select apt.id, apt.cantidad, apt.adults, apt.child, apt.adults1, apt.child1,  apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo, apt.inicio, apt.fin
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                     where apt.inicio >= '$fecha1' AND apt.fin <='$fecha3' AND apt.cantidad = '$cant_parkes' AND apt.type_rate = '1' AND  gp.nombre LIKE '$texto%' order by apt.id_grupo ASC, p.nombre DESC, apt.inicio DESC, apt.fin DESC, apt.cantidad DESC;";
            $qgroup = Doo::db()->query($sqlgroup);
            $admin_rates_group = $qgroup->fetchAll();

                        
        

        //BUSCAR POR PARQUES
//        if($filtraje == 2){
//    
//       
            $sqlpark = "select apt.id, apt.cantidad, apt.adults, apt.child, apt.adults1, apt.child1,  apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo, apt.inicio, apt.fin
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                     where apt.inicio >= '$fecha1' AND apt.fin <='$fecha3' AND apt.type_rate = '1' AND  p.nombre LIKE '$texto%' order by apt.id_grupo ASC, p.nombre DESC, apt.inicio DESC, apt.fin DESC, apt.cantidad DESC;";
            $qpark = Doo::db()->query($sqlpark);
            $admin_rates_park = $qpark->fetchAll();
//                       
            
            
            
        }
            
            if($filtraje == 1){
                $admin_rates = $admin_rates_group;
            }else{
                
                $admin_rates = $admin_rates_park;
            }
            
            
        
        
        
     ?>

    <div id="header_page" style="height:50px; background-image: url('<?php echo $data['rootUrl']?>global/img/bg2.jpg');" >

        <div class="header">Park Admision Rates</div>

        <div  id="toolbar">

            <div class="toolbar-list">

                <ul>

                    <li class="btn-toolbar">

                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/add/<?php echo $data['type_rate'];?>" id="btn-add" class="link-button">

                            <span class="icon-new" title="Nuevo" >&nbsp;</span>

                            New

                        </a>

                    </li>



                    <li class="btn-toolbar">

                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/edit" id="btn-edit" class="link-button" >

                            <span class="icon-edit" title="Editar" >&nbsp;</span>

                            Edit

                        </a>

                    </li>



                    <li class="btn-toolbar">

                        <a href="<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/delete" id="btn-delete" class="link-button">

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

<!--    </div>-->

    <div id="form" >

        <div id="filter-bar">



            <label style="width:70px" class="filter-by">Filter By</label>

            <select name="filtro" id="filtro" class="select" onchange="combo4();">

                <option value="gp.nombre" <?php echo $data["filtro"] == 'gp.nombre' ? 'selected' : '' ?>>Group Name</option>

                <option value="p.nombre" <?php echo $data["filtro"] == 'p.nombre' ? 'selected' : '' ?>>Park Name</option>

<!--                <option value="apt.annio" <?php /*echo $data["filtro"] == 'apt.annio' ? 'selected' : '' */?>>Year</option>-->

            </select>
            
            <select style="color: #0B55C4; text-align:center; font-weight: bold; margin-left:0px; margin-top:12px; width:220px;" name="grupo_parkes" id="grupo_parkes" title="Group Name" onchange="combo2();">
                               <option selected="true" disabled="">Group Name</option>
                                <?php
                                $sql2 = "SELECT DISTINCT apt.id_grupo,  gp.nombre AS grupo
                                         FROM admin_parques_tarifa AS apt
                                         LEFT JOIN parques AS p ON (apt.id_parque = p.id) 
                                         LEFT JOIN grupo_parques AS gp ON (apt.id_grupo = gp.id)
                                         WHERE apt.inicio > '2018-01-01' AND apt.type_rate = '1' ORDER BY  apt.id_grupo ASC;";
                                $rs2 = Doo::db()->query($sql2, array(9));
                                $grupo_parkes = $rs2->fetchAll();
                                foreach ($grupo_parkes as $grp) {
                                    
                                    echo '<option value="' . $grp['id_grupo'] . '" ' . (( 9 == $grp['id_grupo']) ? 'select' : '' ) . '>' . $grp['grupo'] . '</option>';
                                    
                                   
                                }
                               
                                ?>                              
                                

            </select>
            
           <select style="display:none; color:#0B55C4; text-align:center; font-weight: bold; margin-left:0px; margin-top:42px; width:220px;" name="parkes" id="parkes" title="Park Name" onchange="combo3();">
                                <option selected="true" disabled="">Park Name</option>
                                <?php
                                $sqlp = "SELECT DISTINCT p.id, p.nombre AS parke 
                                         FROM admin_parques_tarifa AS apt
                                         LEFT JOIN parques AS p ON (apt.id_parque = p.id) 
                                         LEFT JOIN grupo_parques AS gp ON (apt.id_grupo = gp.id)
                                         WHERE apt.inicio > '2018-01-01' AND apt.type_rate = '1' ORDER BY  p.id ASC;";
                                $rsp = Doo::db()->query($sqlp, array(9));
                                $parkes = $rsp->fetchAll();
                                foreach ($parkes as $park) {
                                    
                                    echo '<option value="' . $park['id'] . '" ' . (( 9 == $park['id']) ? 'select' : '' ) . '>' . $park['parke'] . '</option>';
                                    
                                   
                                }
                               
                                ?>                              
                                

            </select>
            
            
            

            
<!--            combo2();-->
            
            <select style="color: #0B55C4; text-align:center; font-weight: bold; margin-left:0px; margin-top:12px; width:114px;" name="cantidad_parkes" id="cantidad_parkes"  title="Amount Parks"  onchange="combo1();" value="1">
                               <option selected="true" disabled="">Amount Parks</option>
                                
                                <?php
                                $sql3 = "SELECT DISTINCT apt.cantidad  AS cantidad
                                         FROM admin_parques_tarifa AS apt                                         
                                         WHERE apt.inicio > '2018-01-01' AND apt.type_rate = '1' ORDER BY  apt.cantidad ASC;";
                                $rs3 = Doo::db()->query($sql3);
                                $cantidad_parkes = $rs3->fetchAll();
                                foreach ($cantidad_parkes as $cntp) {
                                    
                                    echo '<option value="' . $cntp['id'] . '" ' . (( 9 == $cntp['id']) ? 'select' : '' ) . '>' . $cntp['cantidad'] . '</option>';                                    
                                   
                                }
                               
                                ?>                              
                                

            </select>



<!--            <span class="search">-->

            <?php /*echo $data["texto"] */?>
                
            <input style="color: #0B55C4; text-align: center; font-weight:bold;" type="text" name="starting_date"  id="starting_date"  size="10" style="" maxlength="10" class=""   value="" placeholder="Starting Date" autocomplete="off"/>
            <input style="color: #0B55C4; text-align: center; font-weight:bold;" type="text" name="ending_date"  id="ending_date" size="10" style="" maxlength="10" class=""  placeholder="Ending Date" value="" autocomplete="off"/>


            <input type="button" class="search-btn" id="btn-find" title ="Search"/>

            <span id="resultado<?php $data["texto"]?>" style="text-align: -webkit-center;"></span>

<!--            </span>-->
            
            <input type="text" name="texto"  id="texto" size="30" style="display:none;" maxlength="30" class="input-search"  value=""/>
            <input type="text" name="cant_parkes"  id="cant_parkes" size="30" style="display:none;" maxlength="30" class=""  value=""/>
            <input type="text" name="filtraje"  id="filtraje" size="30" style="display:none;" maxlength="30" class=""  value="1"/>



        </div>



        <div id="datagrid">
            
<?php    
//
//$type_rate = 1;
//$texto1 = "";
//
//if ($type_rate == 1) {
            
//            
//        } else if ($type_rate == 2) {
//            $sql2 = "select apt.id, apt.cantidad , apt.adults, apt.child, apt.adults1, apt.child1,  apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo, a.company_name
//                        from admin_parques_tarifa as apt
//                        left join parques as p on (apt.id_parque = p.id)
//                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
//                        left join agencia as a on (apt.id_agency = a.id)
//                     where apt.inicio > '2018-01-01 AND  apt.type_rate = '2' AND gp.nombre LIKE 'WALT%' order by   apt.id_grupo ASC, p.nombre DESC, apt.inicio DESC, apt.fin DESC, apt.cantidad DESC limit $pager->limit";
//            $q = Doo::db()->query($sql2);
//           
//        }
//
//
        
//        
        
?>            
            
<table class="grid" cellspacing="1" id="grid" style="background-color: #CCCCCC;">
                <thead>
                <tr>
                    <th width="25"  style="width: 1%; font-size: 11px; color:#fff; background-color:#F90A45;">&nbsp;</th>
                    <th width="150" style="width: 7%; font-size: 11px; color:#fff; background-color:#F90A45;">Group</th>
                    <th width="150" style="width: 6%; font-size: 11px; color:#fff; background-color:#F90A45;">Parks</th>
                    <th width="100" style="width: 5%; font-size: 11px; color:#fff; background-color:#F90A45;">Amount Parks</th>
                    <th width="100" style="width: 4%; font-size: 11px; color:#fff; background-color:#F90A45;">Retail Adult</th>
                    <th width="100" style="width: 4%; font-size: 11px; color:#fff; background-color:#F90A45;">Retail Child</th>
                    <th width="100" style="width: 4%; font-size: 11px; color:#fff; background-color:#F90A45;">Cost Adult</th>
                    <th width="100" style="width: 4%; font-size: 11px; color:#fff; background-color:#F90A45;">Cost Child</th>
                    <?php if($data['type_rate']==2){?>
                        <th width="173">Agency</th>
                    <?php } ?>                        
                        <th width="173" style="width: 5%; font-size: 11px; color:#00FFFB; background-color:#F90A45;">Starting Date</th>
                        <th width="173" style="width: 5%; font-size: 11px; color:#00FFFB; background-color:#F90A45;">Ending Date</th>
                        
                </tr>
                </thead>

                <tbody>
                <?php
                
                //$data["admin_rates"]
                $i = 0;
                foreach ($admin_rates as $e):
                    ?>
                    <tr class="row<?php echo $i ?>">
                        <td><input name="item" type="radio" value="<?php echo $e['id']; ?>"autocomplete="off" /></td>
                        <td style="text-align: center; "><?php echo $e['grupo']; ?></td>
                        <td style="text-align: center; "><?php echo $e['parque']; ?></td>
                        <td style="text-align: center; "><?php echo $e['cantidad']; ?></td>
                        <td style="text-align: center; "><?php echo "$ ".$e['adults']; ?></td>
                        <td style="text-align: center; "><?php echo "$ ".$e['child']; ?></td>
                        <td style="text-align: center; "><?php echo "$ ".$e['adults1']; ?></td>
                        <td style="text-align: center; "><?php echo "$ ".$e['child1']; ?></td>
                        <?php if($data['type_rate']==2){?>
                            <td ><?php echo $e['company_name']; ?></td>
                        <?php } ?>                                     
                        <td style="text-align: center;"><?php echo date("m-d-Y",$e['fecha_ini']); ?></td>
                        <td style="text-align: center;"><?php echo date("m-d-Y",$e['fecha_fin']); ?></td>
                        
                    </tr>
                    <?php
                    $i = 1 - $i;
                endforeach;
                ?>
                </tbody>
            </table>
<!--            <div id="pagination">

                <?php /*echo $data['pager'] */?>

            </div>-->

        </div>

    </div>

</form>
    
    
<script type="text/javascript">
    
    $("#btn-find2").click(function(){
        
        
//        var departureTime = $("#departureTime<?php /*echo $reg['id']*/?>").val();
//        var arrivalTime = $("#arrivalTime<?php/* echo $reg['id']*/?>").val();
//        var trip_from = $("#trip_from<?php/* echo $reg['id']*/?>").val();
//        var trip_to = $("#trip_to<?php/* echo $reg['id']*/?>").val();
//        var trip_no = $("#trip_no<?php/* echo $reg['id']*/?>").val();
//        var fecha_ini = $("#fecha_ini<?php/* echo $reg['id']*/?>").val();
//        var fecha_fin = $("#fecha_fin<?php/* echo $reg['id']*/?>").val();
       
            //        var type_rate = 1;
            //        var filtro = "<?php /*echo $data["filtro"] */?>";
            //        var texto = $("#texto").val();
            //        var page = "page"
            //        var pindex = 1;

       
        
        
        
//        $('#fecha_salida<?php /*echo $reg['id']*/?>').html(departureTime);
//        $('#fecha_llegada<?php/* echo $reg['id']*/?>').html(arrivalTime);
        
            //            $.ajax({
            //                    //datos que se envian a traves de ajax
            //                    url:   '<?php /*echo $data['rootUrl']*/?>admin/tours/admision-rate/'+ type_rate + '/' + filtro + '/' + texto + '/' + page + '/' + pindex, //archivo que recibe la peticion
            //                    type:  'post', //método de envio
            //                    beforeSend: function () {
            //                            $("#resultado<?php /*echo $data["texto"]*/?>").html('<i class="fa fa-spinner fa-spin" style="font-size:15px"></i>');
            //                    },
            //                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            //                            $("#resultado<?php /*echo $data["texto"]*/?>").html(response);
            //                    }
            //            });
    });
</script>

<script type="text/javascript">
    
    $("#btn-find").click(function(){
        
        var filtro = document.getElementById('filtro').value;
        var fecha_inicio = document.getElementById('starting_date').value;
        var grupo_parques = document.getElementById('grupo_parkes').value;
        var cantidad_parques = document.getElementById('cantidad_parkes').value;
        var parques = document.getElementById('parkes').value;        
        var valor = $("#filtro option:selected").html();           

            
            
        
        if(filtro == 'gp.nombre'){
        
            if(grupo_parques == 'Group Name'){

                alert("Group Name is required");            
                $("#grupo_parkes").focus();

            }else if(cantidad_parques == "Amount Parks"){

                alert("Amount Parks is required");            
                $("#cantidad_parkes").focus();    

            }else if(fecha_inicio == ''){

                alert("Starting Date is required");            
                $("#starting_date").focus();

            }else{

                //cargarGrupo_parques();
                $('#form1').submit();
                document.getElementById('grupo_parkes').value = 0;
                document.getElementById('cantidad_parkes').value = 0;
                document.getElementById('filtro').value = "gp.nombre";

            }
        }else if(filtro == 'p.nombre'){
            
            if(parques == 'Park Name'){
                
                alert("Park Name is required");            
                $("#parkes").focus();
                
            }else if(fecha_inicio == ''){

                alert("Starting Date is required");            
                $("#starting_date").focus();

            }else{

                //cargarGrupo_parques();
                $('#form1').submit();
                
//                document.getElementById('grupo_parkes').value = 0;
//                document.getElementById('cantidad_parkes').value = 0;
                
                                
                if(valor == 'Park Name'){   
                    
                    document.getElementById('grupo_parkes').style.display = "none";                    
                    document.getElementById('cantidad_parkes').style.display = "none";                      
                    document.getElementById("filtro").value = "p.nombre";                 
                    document.getElementById('parkes').style.display = "";                      
                    document.getElementById('fecha_inicio').style.display = "";  
                    
                                   
                }            
                

              

            }
            
        }
        
        
    });
    
</script>
<script type="text/javascript">
    
    function cargarGrupo_parques() {
        
        var texto = $('#texto').val();
        var type_rate = 1;
        
        //alert(texto);
        
        //var url = '<?php /*echo $data['rootUrl']; */?>admin/tours/carga_grupo/'+ type_rate + '/' + texto; //archivo que recibe la peticion
        //$("#btn-find").load('<?php /*echo $data['rootUrl']; */?>admin/tours/admision-rate/carga_grupo/'+ type_rate + '/' + texto);
        
        
        $.ajax({
            
            //datos que se envian a traves de ajax
                url:   '<?php echo $data['rootUrl']?>admin/tours/admision-rate/carga_grupo'+ type_rate + '/' + texto, //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado<?php echo $data["texto"]?>").html('<i class="fa fa-spinner fa-spin" style="font-size:15px"></i>');
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado<?php echo $data["texto"]?>").html(response);
                }
        });
    }
    
</script>
    

<script>

    function combo1()
    {

        $(document).ready(function () {
            
            // Así accedemos al Texto de la opción seleccionada
            var valor = $("#cantidad_parkes option:selected").html();
            
            if(valor == 'Amount Parks'){
                
                valor = "";
            }
            
            document.getElementById('cant_parkes').value = valor;
            
            //alert(valor);
            

        });

    }
    
</script>
 
<script>

    function combo2()
    {

        $(document).ready(function () {
            
            // Así accedemos al Texto de la opción seleccionada
            var valor = $("#grupo_parkes option:selected").html();
            
            if(valor == 'Group Name'){
                
                valor = "";
            }
            
            document.getElementById('texto').value = valor;
            
            //alert(valor);
            

        });

    }
    
</script>


<script>

    function combo3()
    {

        $(document).ready(function () {
            
            // Así accedemos al Texto de la opción seleccionada
            var valor = $("#parkes option:selected").html();
            
            if(valor == 'Park Name'){
                
                valor = "";
            }
            document.getElementById('texto').value = valor;
            
            //alert(valor);
            

        });

    }
    
</script>

<script>

    function combo4()
    {

//        $(document).ready(function () {
            
            // Así accedemos al Texto de la opción seleccionada
            var valor = $("#filtro option:selected").html();
            
           
            
            if(valor == 'Group Name'){                
                               
                $("#filtraje").val(1);
                document.getElementById('parkes').style.display = "none";
                document.getElementById('grupo_parkes').style.display = "";
                document.getElementById('cantidad_parkes').style.display = "";
                

            }
            
            if(valor == 'Park Name'){                
                              
                $("#filtraje").val(2);
                document.getElementById('grupo_parkes').style.display = "none";
                document.getElementById('cantidad_parkes').style.display = "none";
                document.getElementById('parkes').style.display = "";
                
               
            }            
            
                        

//        });

    }
    
</script>



<script type="text/javascript">

    
    $('#starting_date').datepicker({
        
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,        
        minDate: 0,        
        numberOfMonths: 2
    });
    
    $('#ending_date').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,        
        minDate: 0,        
        numberOfMonths: 2
    });
    
    
    $("#starting_date").change(function () {
            var fecha_salida = $('#starting_date').val();

            $("#ending_date").val(fecha_salida);           
            $("#starting_date").datepicker("hide");


//            if (!Validar(fecha_salida)) {
//                $('#fecha_fin').focus();
//            } else {
//                var fecha_retorno = $('#fecha_fin').val();
//            }


    });
    
    $('#grid tr').click(function() {

        $(this).find('input[name="item"]').prop('checked', true)



    });

    $('texto').keypress(function(e){

        if (e.keyCode==13)

            $('#form1').submit();

    })



    $('#btn-find').click(function(){

        //$('#form1').submit();

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
    
    $(window).load(function () {                        
          
          comprobarScreen();
          combo4();
          
  
 
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

        if (window.screen.availWidth > 1366) {
            window.parent.document.body.style.zoom = "125%";

        }
    }

</script>






