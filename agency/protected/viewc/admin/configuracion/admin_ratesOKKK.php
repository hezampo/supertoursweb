<style type="text/css" media="screen">

/* .stroke {
        text-align: center;
        color: #FF4FFF;
        font-family: impact;
        font-size: 8px;
        text-shadow: -1px -1px 1px #000, 1px 1px 1px #000, -1px 1px 1px #000, 1px -1px 1px #000;
        -webkit-text-fill-color: #FF4FFF;
        -webkit-text-stroke: 2px black;
    }*/

</style>

<?php if(isset($_REQUEST['msg'])){?>

    <div class="error" style="margin-top: 10px;"><?php /*echo $_REQUEST['msg'];*/ ?></div>

<?php } ?>

<?php /*if($data['type_rate']==1){

    echo 'Net';

}else{

    echo 'Special Net';

}*/?>

<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/tours/admision-rate"  class="form" id="form1">

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

    
    <div id="form">

        <div id="filter-bar">


            <label style="width:70px" class="filter-by">Filter By</label>
            
            <select style=""  name="filtro" id="filtro" class="select">

                <option value="gp.nombre" <?php echo $data["filtro"] == 'gp.nombre' ? 'selected' : '' ?>>Group Name</option>

                <option value="p.nombre" <?php echo $data["filtro"] == 'p.nombre' ? 'selected' : '' ?>>Park Name</option>

                <option value="apt.annio" <?php /*echo $data["filtro"] == 'apt.annio' ? 'selected' : '' */?>>Year</option>

            </select>
            
            <select style="color: #0B55C4; text-align:center; font-weight: bold; margin-left:0px; margin-top:12px; width:220px;" name="grupo_parkes" id="grupo_parkes"  onchange="combo2();">
                                <option>Group Name</option>
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
            
            <span class="search">
                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" />
                <span id="resultado<?php $data["texto"]?>" style="text-align: -webkit-center;"></span>
<!--                <button type="button" class="btn btn-default" data-dismiss="modal" id="mandarDatos<?php/* echo $reg['id'];*/?>">Actualizar</button>-->
            </span>
            
            
            
            <select style="display:none; color: #0B55C4; text-align:center; font-weight: bold; margin-left:0px; margin-top:12px; width:220px;" name="parkes" id="parkes"  onchange="combo3();">
                                <option>Park Name</option>
                                <?php
                                $sql3 = "SELECT DISTINCT p.id AS id_parque, p.nombre AS nombre    
                                        FROM parques AS p
                                        LEFT JOIN admin_parques_tarifa AS apt ON (p.id = apt.id_parque) 
                                        LEFT JOIN grupo_parques AS gp ON (apt.id_grupo = gp.id) 
                                        WHERE apt.inicio > '2018-01-01' AND apt.type_rate = '1' ORDER BY  apt.id_parque ASC;";
                                 
                                $rs3 = Doo::db()->query($sql3, array(9));
                                $parkes = $rs3->fetchAll();
                                foreach ($parkes as $park) {
                                    
                                    echo '<option value="' . $park['id_parque'] . '" ' . (( 9 == $park['id_parque']) ? 'select' : '' ) . '>' . $park['nombre'] . '</option>';
                                    
                                   
                                }
                               
                                ?>                              
                                

            </select> 
            
        </div>

        <div id="datagrid">

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
                        <th width="173" style="width: 3%;background: #000066; color: #CCFFFF; display: none;">Year</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $i = 0;
                foreach ($data["admin_rates"] as $e):
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
                        <td style="text-align: center; display: none;"><?php/* echo substr($e['annio'],0,4); */?></td>
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

      </div>
<!--   </div>-->

</form>

<!--</div>-->

<script type="text/javascript">
    
    $("#btn-find").click(function(){
        
        
//        var departureTime = $("#departureTime<?php /*echo $reg['id']*/?>").val();
//        var arrivalTime = $("#arrivalTime<?php/* echo $reg['id']*/?>").val();
//        var trip_from = $("#trip_from<?php/* echo $reg['id']*/?>").val();
//        var trip_to = $("#trip_to<?php/* echo $reg['id']*/?>").val();
//        var trip_no = $("#trip_no<?php/* echo $reg['id']*/?>").val();
//        var fecha_ini = $("#fecha_ini<?php/* echo $reg['id']*/?>").val();
//        var fecha_fin = $("#fecha_fin<?php/* echo $reg['id']*/?>").val();
       
        var type_rate = 1;
        var filtro = "<?php echo $data["filtro"] ?>";
        var texto = $("#texto").val();
        
       
        
        
        
//        $('#fecha_salida<?php /*echo $reg['id']*/?>').html(departureTime);
//        $('#fecha_llegada<?php/* echo $reg['id']*/?>').html(arrivalTime);
        
        $.ajax({
                //datos que se envian a traves de ajax
                url:   '<?php echo $data['rootUrl']?>admin/tours/admision-rate/'+ type_rate + '/' + filtro + '/' + texto, //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado<?php echo $data["texto"]?>").html('<i class="fa fa-spinner fa-spin" style="font-size:15px"></i>');
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado<?php echo $data["texto"]?>").html(response);
                }
        });
    });
</script>

<!--<script type="text/javascript">
$('#btn-find').click(function() {
    //location.reload();
});
</script>-->



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

<script type="text/javascript">

    $('#grid tr').click(function() {

        $(this).find('input[name="item"]').prop('checked', true)



    });

    $('texto').keypress(function(e){

        if (e.keyCode==13)

            //$('#form1').submit();

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






