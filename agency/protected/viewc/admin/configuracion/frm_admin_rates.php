<?php 

$admision_rates = $data["admision_rates"];
$id_grupo = $_POST["idgrupo2"];

$estado = $data['dato'];
$idgrupo =  $admision_rates->id_grupo;
//echo $idgrupo;
$idparque = $admision_rates->id_parque;
//echo $idparque;
$cantidad = $admision_rates->cantidad;

$fecha_ini = $admision_rates->fecha_ini;

$fecha_fin = $admision_rates->fecha_fin;



?>

<fieldset id="todoparques" style="position:absolute; width:741px; height:13px; margin-left:205px; margin-top:143px; padding-top: 0px; padding-left: 0px; border-color: transparent;"><legend></legend>

<div id="checkboxes1" style="width: 99%; font-family:arial; font-size: 15px; ">
                    
    <input style="display:none; margin-left: 4px; margin-top:7px;" type="checkbox"  onclick="toggle(this);" />                



    <?php    
    //order by nombre asc
    if($cantidad == 1){

    $sql = "SELECT nombre FROM parques where id_grupo ='$idgrupo' AND id ='$idparque'";
    $rs = Doo::db()->query($sql);
    $park_name = $rs->fetchAll();

    foreach ($park_name as $r):
        
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox1" checked="checked" disabled="disabled" id="<?php echo $r['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     

    <?php 
    endforeach;
    } else if($cantidad == 2){
        
    $sql = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select2 = '1' AND tari_2 = '0' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs = Doo::db()->query($sql);
    $id_park1 = $rs->fetchAll();
    
    foreach($id_park1 as $id){
        
      $id_parque1 = $id['id_parque'];
        
     
    
    $sql1 = "SELECT nombre FROM parques WHERE id ='$id_parque1' order by nombre asc";
    $rs1 = Doo::db()->query($sql1);
    $park_name = $rs1->fetchAll();

    foreach ($park_name as $r):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox1" checked="checked" disabled="disabled" id="<?php echo $r['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     

    <?php 
    endforeach;
    }
    
    $sql2 = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select2 = '0' AND tari_2 = '1' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs2 = Doo::db()->query($sql2);
    $id_park2 = $rs2->fetchAll();
    
    foreach($id_park2 as $id2){
        
      $id_parque2 = $id2['id_parque'];
        
    
    $sql3 = "SELECT nombre FROM parques WHERE id ='$id_parque2' order by nombre asc";
    $rs3 = Doo::db()->query($sql3);
    $park_name2 = $rs3->fetchAll();
    
    foreach ($park_name2 as $r2):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox2" style="checked:false;" disabled="disabled" id="<?php echo $r2['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r2['id'] ?>"/><?php echo $r2['nombre']; ?></label>     

    <?php 
    endforeach;
    
        }
    
    }else if($cantidad == 3){
        
    $sql = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select3 = '1' AND tari_3 = '0' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs = Doo::db()->query($sql);
    $id_park1 = $rs->fetchAll();
    
    foreach($id_park1 as $id){
        
      $id_parque1 = $id['id_parque'];
        
     
    
    $sql1 = "SELECT nombre FROM parques WHERE id ='$id_parque1' order by nombre asc";
    $rs1 = Doo::db()->query($sql1);
    $park_name = $rs1->fetchAll();

    foreach ($park_name as $r):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox1" checked="checked" disabled="disabled" id="<?php echo $r['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     

    <?php 
    endforeach;
    }
    
    $sql2 = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select3 = '0' AND tari_3 = '1' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs2 = Doo::db()->query($sql2);
    $id_park2 = $rs2->fetchAll();
    
    foreach($id_park2 as $id2){
        
      $id_parque2 = $id2['id_parque'];
        
    
    $sql3 = "SELECT nombre FROM parques WHERE id ='$id_parque2' order by nombre asc";
    $rs3 = Doo::db()->query($sql3);
    $park_name2 = $rs3->fetchAll();
    
    foreach ($park_name2 as $r2):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox2" style="checked:false;" disabled="disabled" id="<?php echo $r2['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r2['id'] ?>"/><?php echo $r2['nombre']; ?></label>     

    <?php 
    endforeach;
    
        }
    
    }else if($cantidad == 4){
        
    $sql = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select4 = '1' AND tari_4 = '0' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs = Doo::db()->query($sql);
    $id_park1 = $rs->fetchAll();
    
    foreach($id_park1 as $id){
        
      $id_parque1 = $id['id_parque'];
        
     
    
    $sql1 = "SELECT nombre FROM parques WHERE id ='$id_parque1' order by nombre asc";
    $rs1 = Doo::db()->query($sql1);
    $park_name = $rs1->fetchAll();

    foreach ($park_name as $r):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox1" checked="checked" disabled="disabled" id="<?php echo $r['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     

    <?php 
    endforeach;
    }
    
    $sql2 = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select4 = '0' AND tari_4 = '1' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs2 = Doo::db()->query($sql2);
    $id_park2 = $rs2->fetchAll();
    
    foreach($id_park2 as $id2){
        
      $id_parque2 = $id2['id_parque'];
        
    
    $sql3 = "SELECT nombre FROM parques WHERE id ='$id_parque2' order by nombre asc";
    $rs3 = Doo::db()->query($sql3);
    $park_name2 = $rs3->fetchAll();
    
    foreach ($park_name2 as $r2):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox2" style="checked:false;" disabled="disabled" id="<?php echo $r2['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r2['id'] ?>"/><?php echo $r2['nombre']; ?></label>     

    <?php 
    endforeach;
    
    }
    
    }else if($cantidad == 5){
        
    $sql = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select5 = '1' AND tari_5 = '0' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs = Doo::db()->query($sql);
    $id_park1 = $rs->fetchAll();
    
    foreach($id_park1 as $id){
        
      $id_parque1 = $id['id_parque'];
        
     
    
    $sql1 = "SELECT nombre FROM parques WHERE id ='$id_parque1' order by nombre asc";
    $rs1 = Doo::db()->query($sql1);
    $park_name = $rs1->fetchAll();

    foreach ($park_name as $r):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox1" checked="checked" disabled="disabled" id="<?php echo $r['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     

    <?php 
    endforeach;
    }
    
    $sql2 = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select5 = '0' AND tari_5 = '1' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs2 = Doo::db()->query($sql2);
    $id_park2 = $rs2->fetchAll();
    
    foreach($id_park2 as $id2){
        
      $id_parque2 = $id2['id_parque'];
        
    
    $sql3 = "SELECT nombre FROM parques WHERE id ='$id_parque2' order by nombre asc";
    $rs3 = Doo::db()->query($sql3);
    $park_name2 = $rs3->fetchAll();
    
    foreach ($park_name2 as $r2):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox2" style="checked:false;" disabled="disabled" id="<?php echo $r2['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r2['id'] ?>"/><?php echo $r2['nombre']; ?></label>     

    <?php 
    endforeach;
    
        }
    
    }else if($cantidad == 6){
        
    $sql = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select6= '1' AND tari_6 = '0' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs = Doo::db()->query($sql);
    $id_park1 = $rs->fetchAll();
    
    foreach($id_park1 as $id){
        
      $id_parque1 = $id['id_parque'];
        
     
    
    $sql1 = "SELECT nombre FROM parques WHERE id ='$id_parque1' order by nombre asc";
    $rs1 = Doo::db()->query($sql1);
    $park_name = $rs1->fetchAll();

    foreach ($park_name as $r):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox1" checked="checked" disabled="disabled" id="<?php echo $r['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     

    <?php 
    endforeach;
    }
    
    $sql2 = "SELECT  id_parque FROM parques_restric  WHERE id_grupo ='$idgrupo' AND park_select6 = '0' AND tari_6 = '1' AND fecha_ini = '$fecha_ini' AND fecha_fin ='$fecha_fin' AND cantidad = '$cantidad'";
    $rs2 = Doo::db()->query($sql2);
    $id_park2 = $rs2->fetchAll();
    
    foreach($id_park2 as $id2){
        
      $id_parque2 = $id2['id_parque'];
        
    
    $sql3 = "SELECT nombre FROM parques WHERE id ='$id_parque2' order by nombre asc";
    $rs3 = Doo::db()->query($sql3);
    $park_name2 = $rs3->fetchAll();
    
    foreach ($park_name2 as $r2):
    ?>   

    <label for="one"> <input type="checkbox" name="checkbox2" style="checked:false;" disabled="disabled" id="<?php echo $r2['id'] ?>" onclick="" style="disabled:true;" value="<?php echo $r2['id'] ?>"/><?php echo $r2['nombre']; ?></label>     

    <?php 
    endforeach;
    
        }
    
    }   
        
    
    ?>       


</div>
</fieldset>


<!--<? $rates_group = $data["Rates_Group"]; ?>-->

<link rel="stylesheet" type="text/css" href="<?php  echo $data['rootUrl'];  ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php  echo $data['rootUrl'];  ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script src="<?php echo $data['rootUrl']; ?>//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<?php /*if($admision_rates->type_rate==1){
    echo 'Net';
}else{
    echo 'Special Net';
}*/?>

<style>
    .roge{
        background: -moz-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E3E8FA), color-stop(78%, #E3E8FA), color-stop(92%, #FF0505), color-stop(100%, #FF0505)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ie10+ */
        background: linear-gradient(0deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E3E8FA', endColorstr='#FF0505',GradientType=0 ); /* ie6-9 */
    }
    
    .azu{
        background: -moz-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #DEEEFA), color-stop(78%, #DEEEFA), color-stop(92%, #F4FF1C), color-stop(100%, #F4FF1C)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* ie10+ */
        background: linear-gradient(0deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#DEEEFA', endColorstr='#F4FF1C',GradientType=0 ); /* ie6-9 */
    }
    .ama2{
        background: -moz-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFFCD9), color-stop(78%, #FFFCD9), color-stop(92%, #1EFF00), color-stop(100%, #1EFF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ie10+ */
        background: linear-gradient(0deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFCD9', endColorstr='#1EFF00',GradientType=0 ); /* ie6-9 */
    }
    .verdefosf{
        background: rgba(230,227,225,0.45);
        background: -moz-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(230,227,225,0.45)), color-stop(25%, rgba(189,226,222,0.45)), color-stop(53%, rgba(142,224,219,1)), color-stop(87%, rgba(86,222,215,1)), color-stop(100%, rgba(87,126,224,1)));
        background: -webkit-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -o-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -ms-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: linear-gradient(to bottom, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e3e1', endColorstr='#577ee0', GradientType=0 );
    }
    .verde{
        background: -moz-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,  #F0F8FF), color-stop(8%, #FCFCFC), color-stop(49%, #FFFFFF), color-stop(97%, #FCFCFC), color-stop(100%,  #F0F8FF)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* ie10+ */
        background: linear-gradient(180deg,  #0D19FF  0%, #FCFCFC 8%, #FFFFFF 49%, #FCFCFC 97%,  #0D19FF  100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=' #F0F8FF', endColorstr=' #F0F8FF',GradientType=0 ); /* ie6-9 */

    }
    .blue{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+31,066dab+100;Web+2.0+Blue+3D+%231 */
        background: rgb(197,222,234); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 31%, rgba(6,109,171,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=0 ); /* IE6-9 */

    }
    
    .descuentos{

        background: -moz-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff0000), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #ff0000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* ie10+ */
        background: linear-gradient(180deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0000', endColorstr='#ff0000',GradientType=0 ); /* ie6-9 */


    }
    
    .orangered{
        background: -moz-linear-gradient(270deg, #FF0000 0%, #ff0000 68%, #ffffff 94%, #000000 95%, #000000 99%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FF0000), color-stop(68%, #ff0000), color-stop(94%, #ffffff), color-stop(95%, #000000), color-stop(99%, #000000), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #FF0000 0%, #ff0000 68%, #ffffff 94%, #000000 95%, #000000 99%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #FF0000 0%, #ff0000 68%, #ffffff 94%, #000000 95%, #000000 99%, #000000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #FF0000 0%, #ff0000 68%, #ffffff 94%, #000000 95%, #000000 99%, #000000 100%); /* ie10+ */
        background: linear-gradient(180deg, #FF0000 0%, #ff0000 68%, #ffffff 94%, #000000 95%, #000000 99%, #000000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FF0000', endColorstr='#000000',GradientType=0 ); /* ie6-9 */
    }
    .super{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+29,0751b2+78 */
        background: rgb(197,222,234); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 29%, rgba(7,81,178,1) 78%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#0751b2',GradientType=0 ); /* IE6-9 */

    }
    
    .cerati{
        background: -moz-linear-gradient(90deg, #000000 0%, #000000 1%, #4147B5 2%, #025E7D 97%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #000000), color-stop(3%, #025E7D), color-stop(98%, #4147B5), color-stop(99%, #000000), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #000000 0%, #000000 1%, #4147B5 2%, #025E7D 97%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #000000 0%, #000000 1%, #4147B5 2%, #025E7D 97%, #000000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #000000 0%, #000000 1%, #4147B5 2%, #025E7D 97%, #000000 100%); /* ie10+ */
        background: linear-gradient(0deg, #000000 0%, #000000 1%, #4147B5 2%, #025E7D 97%, #000000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000',GradientType=0 ); 
    }
    
    .cerati2{
        background: -moz-linear-gradient(270deg, #003333 0%, #3060da 7%, #3060DA 50%, #3060da 93%, #003333 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #003333), color-stop(7%, #3060da), color-stop(50%, #3060DA), color-stop(93%, #3060da), color-stop(100%, #003333)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #003333 0%, #3060da 7%, #3060DA 50%, #3060da 93%, #003333 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #003333 0%, #3060da 7%, #3060DA 50%, #3060da 93%, #003333 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #003333 0%, #3060da 7%, #3060DA 50%, #3060da 93%, #003333 100%); /* ie10+ */
        background: linear-gradient(180deg, #003333 0%, #3060da 7%, #3060DA 50%, #3060da 93%, #003333 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#003333', endColorstr='#003333',GradientType=0 ); /* ie6-9 */
    }
</style>

<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/save" method="post" name="form1" enctype="multipart/form-data">
    <div id="header_page" style="height:50px; background-image: url('<?php echo $data['rootUrl']?>global/img/bg2.jpg');" >
        <div class="header2">Park Admision Rates  [<?php echo $data['dato'];?>]</div>
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>
<!--                    <li class="btn-toolbar" id="btn-edit">
                        <a   class="link-button" id="btn-edit">
                            <span class="icon-edit" title="editar" >&nbsp;</span>
                            Refresh 
                        </a>
                    </li>-->

                    <li class="btn-toolbar" id="btn-save">
                        <a   class="link-button" id="btn-save">
                            <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                            Save
                        </a>
                    </li>

                    <li class="btn-toolbar" id="btn-cancel">
                        <a  class="link-button" >
                            <span class="icon-back" title="Editar" >&nbsp;</span>
                            Cancel
                        </a>
                    </li>


                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="content_page" >
        <div id="serpare">

            <fieldset><legend>General Information</legend>
                <?php
                if ($admision_rates->type_rate == 2) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }
                ?>

                <div  class="input" style="display:<?php echo $display; ?>" >
                    <label style="width:150px" class="required" for="type_rate">Agency</label>
                    <div class="ausu-suggest" >
                        <input name="company_name" type="text" id="company_name" size="40" maxlength="40" value="<?php echo $admision_rates->company_name; ?>" autocomplete="off"
                        <?php
                        if ($data['dato'] == 'edit') {
                            
                            echo 'readonly';
                            echo '   style="background:#DFDFE1;"';
                            
                        }
                        ?>

                               />
                        <input type="hidden" size="4" value="<?php echo $admision_rates->id_agency ?>" name="id_agency" id="id_agency" autocomplete="off" />
                        
                    </div>
                </div>
                
                </BR>
                <fieldset id="cerati" class="cerati2" style="background-color:#3060DA; width:924px; height: 84px; margin-left: 2px; border-color:#000;">
                <div class="input">
                    <label style="position:absolute; width:150px; margin-left: -1px; margin-top: -3px; color: #FFFFFF; text-align:right;" class="required" id="l_id_grupo"><strong>Group:</strong> </label>
                    <select style="width:187px;  color: #000; font-weight: bold; margin-left: 158px; border-color: #FFFFFF; disabled:false;"   name="id_grupo" id="id_grupo" class="select" onclick="grupal(); cambiafondo();" >
                        <option value=""></option>
                        <?php foreach ($data["grupos"] as $e): ?>
                            <option value="<?php echo $e['id']; ?>"  <?php echo ($admision_rates->id_grupo == trim($e['id']) ? 'selected' : '' ); ?>><?php echo $e["nombre"]; ?></option>
                                                  
                        <?php endforeach; ?>
                              
                            
                    </select>
                          
                    
                </div>         
                    

                <div class="input">
                    <label style="position:absolute; width:150px; margin-left: 110px;  margin-top: 3px; color: #FFFFFF;" class="required" id="l_trip_no"><strong>Parks:</strong> </label>
                    <select style="display:none; width:187px; color: #0B55C4; font-weight: bold; margin-left: 158px; margin-top: 5px;" name="id_parque" id="id_parque" class="select" disabled="false">
                        <option  value="0">All</option>
                        <?php foreach ($data["parques"] as $e): ?>
                            <option value="<?php echo $e['id']; ?>"  <?php echo ($admision_rates->id_parque == trim($e['id']) ? 'selected' : ''); ?>><?php echo $e["nombre"]; ?></option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input">
                        
                        <label style="position:absolute; margin-left: 97px; margin-top: 33px; width:54px; color: #FFFFFF;" class="required" id="l_cantidad"><strong>Amount:</strong> </label>
                        <input type="text" style="margin-left: 158.3px; margin-top: 33px; width:36px; color: #0B55C4; border-color: #000; font-weight: bold; font-size: 16px; text-align: center; disabled:false;" name="cantidad" id="cantidad"  size="10" maxlength="10"  value="<?php echo $admision_rates->cantidad; ?> " onkeypress="return solocantidad(event); " onkeyup ="validacantidad();" onclick="cambiafondo();" autocomplete="off"/>
                    
                </div>
                    
                </fieldset>
                </BR>
                
                <input type="hidden" size="4" value="<?php echo $data['dato'];?>" name="dato" id="dato" autocomplete="off" />
                <fieldset class="orangered" style="background-color:#b81621; width:351px; margin-left: 2px; height:33px; border-color:#000;">
                    
                    <div class="input">
                    <!--onchange="replicarcalendario();"-->
                    <label style="position:absolute; width:69px;  margin-left: -7px; margin-top: 3px; color:  #FFFFFF;"><strong>Start Date:</strong></label>
                    <input type="text" style="text-align: center; margin-left: 70px; margin-top: 3px; width:95px; height:20px; color: #0B55C4; font-weight: bold; border-color: #000;" name="fecha_ini" id="fecha_ini" size="25" maxlength="25" onclick="cambiafondo();"  onchange="fechaRetorno(this.value);" value="<?php echo ($admision_rates->fecha_ini != "" ? date("m/d/Y", $admision_rates->fecha_ini) : ''); ?>" autocomplete="off"/>


                    </div>

                    <div class="input">

                        <label style="position:absolute; width:61px; margin-left: 178px; margin-top: -27px; color: #FFFFFF;"><strong>End Date:</strong> </label>
                        <input type="text" style="text-align: center; margin-left: 248px; margin-top: -26px; width:95px;  height: 20px; color: #0B55C4; font-weight: bold; border-color: #000;" name="fecha_fin" id="fecha_fin" size="25" onclick="cambiafondo();" onchange ="comprobarFecha();" maxlength="25" value="<?php echo ($admision_rates->fecha_fin != "" ? date("m/d/Y", $admision_rates->fecha_fin) : ''); ?>" autocomplete="off"/>


                    </div>
                    
                </fieldset>
                </BR>         
                <fieldset id ="retail" class="verde" style="background-color:#D3D3D3; width:365px; height: 61px; margin-left: 2px; border-color:blue;">
                <div class="input">
                    
<!--                        <label style="margin-left: -15px; margin-top: 12px; width:150px; color: #0B55C4;" class="required" id="l_child"><strong>Cost Child:</strong> </label>
                        <input type="text" style="margin-top: 13px; width:95px; margin-left: -1px; color: #0B55C4; font-weight: bold; " name="child1" id="child1"  size="10" maxlength="10"  value="<?php echo $admision_rates->child1; ?>"autocomplete="off"/>   -->
                        
                        <label style="position:absolute; width:95px; margin-left: 59px; color: #000;" class="required" id="l_adults"><strong>Retail Adults: $</strong> </label>
                        <input type="text" name="adults" id="adults"  size="10" maxlength="10" style="margin-left: 158px; margin-top: 2px; font-size: 16px; color: #696969 ; font-weight: bold; width: 69px; border-color: blue;" value="<?php echo $admision_rates->adults; ?>" onkeypress="return soloadult(event);" onblur="validar(this)" onclick="cambiafondo();" onkeyup="ponDecimales(2);" autocomplete="off"/>   
                        
                        <div style="margin-left: 10px; margin-top: -25px;">
                    
                        <label style="position:absolute; margin-left: 58px; margin-top: 33px; width:87px; color: #000;" class="required" id="l_child"><strong>Retail Child: $</strong> </label>
                        <input type="text" name="child" id="child"  size="10" maxlength="10" style="margin-top: 34px; margin-left: 148px; width: 69px; font-size: 16px; color: #696969 ; font-weight: bold; border-color: blue;" value="<?php echo $admision_rates->child; ?>" onkeypress="return solochild(event);" onblur="validar(this)" onclick="cambiafondo();" onkeyup="ponDecimales(2);" autocomplete="off"/>
                    
                        </div>
                    
<!--                    <div style="margin-left: 70%; margin-top: -25px;">
                    
                        <label style="width:150px; color: #0B55C4;" class="required" id="t_child"><strong>Transf Child:</strong> </label>
                        <input type="text" name="child" id="child"  size="10" maxlength="10" style="margin-left: -55px;color: #0B55C4 ; font-weight: bold;"  value="<?php echo $rates_group->child; ?>"/>                                      
                    
                    </div>-->
                        
                </div>
                </fieldset>
                </BR>
                
                <fieldset class="verdefosf" id="cost" style="background-color:#DCDCDC; width:365px; height: 60px; margin-left: 2px; border-color:blue;">
                
                    <div class="input">
                    
                        <label style="position:absolute; margin-left: 67px; width:87px; color: #000;" class="required" id="l_adults1"><strong>Cost Adults: $</strong> </label>
                        <input type="text" style="width:69px; color: #696969 ; font-weight: bold; font-size: 16px; margin-left: 158px; margin-top:1px; border-color: blue;" name="adults1" id="adults1"  size="10" maxlength="10"   value="<?php echo $admision_rates->adults1; ?>" onblur="validar(this)" onkeypress="return soloadults1(event);" onkeyup="ponDecimales(2);" autocomplete="off"/>   
                        
                        <div style="margin-left: 40%; margin-top: -25px;">                    
                    
<!--                        <label style="width:150px; margin-left: 2px; color: #0B55C4;" class="required" id="l_adults"><strong>Retail Adults:</strong> </label>
                        <input type="text" name="adults" id="adults"  size="10" maxlength="10" style="margin-left: -60px; color: #0B55C4 ; font-weight: bold;" value="<?php echo $admision_rates->adults; ?>"autocomplete="off"/>   -->
                        
                        <label style="position:absolute; margin-left: -62px; margin-top: 33px; width:78px; color: #000;" class="required" id="l_child"><strong>Cost Child: $</strong> </label>
                        <input type="text" style="margin-top: 33px; width:69px; margin-left: 20px; color: #696969; font-size: 16px; font-weight: bold; border-color: blue;" name="child1" id="child1"  size="10" maxlength="10"  value="<?php echo $admision_rates->child1; ?>" onblur="validar(this)" onkeypress="return solochild1(event);" onkeyup="ponDecimales(2);" autocomplete="off"/>   
                        
                        </div>
                   
<!--                    <div style="margin-left: 70%; margin-top: -25px;">
                        
                        <label style="width:150px; color: #0B55C4;" class="required" id="t_adults"><strong>Transf Adults:</strong> </label>
                        <input type="text" name="adult" id="adult"  size="10" maxlength="10" style="margin-left: -55px;color: #0B55C4 ; font-weight: bold;"  value="<?php echo $rates_group->adult; ?>"/>                                      
                    
                    </div>-->
                
                    </div>
                </fieldset>
                
                
<!--                </BR>-->
                
                
                
 
                <div class="input">
                    
                    <label style="width:150px; display:none" class="required" for="annio" >Year:</label>
                    <input type="number" id="annio"  style="display:none;" value="<?php echo isset($admision_rates->annio) ? substr($admision_rates->annio, 0, 4) : date('Y') ?>" name="annio">                  
                
                </div>
                
                <div class="input">
                    
                    <label style="width:150px; display:none" class="required" for="year" >Year1:</label>
                    <input type="number" id="year" name="year" style="display:none;" value="<?php echo isset($admision_rates->year) ? substr($admision_rates->year, 0, 4) : date('Y') ?>">                  
                
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="l_address"></label>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="l_address"></label>
                </div>
                            

                <input name="id" type="hidden" id="id" value="<?php echo $admision_rates->id; ?>" />
            </fieldset>
            
            <input type="text" id="idgrupo_e" name="idgrupo_e" style="display:none;"  value="<?php echo $admision_rates->id_grupo; ?>" />
            <input type="text" id="idparque" name="idparque" style="display:none;"  value="<?php echo $admision_rates->id_parque; ?>" />
            <input type="text" id="cantidad_ed" name="cantidad_ed" style="display:none;"  value="<?php echo $admision_rates->cantidad; ?>" />

          
       

        <div class="header2"> <div class="multiselect" style="position:absolute; background-color: #FFFFFF; margin-left:185px; width:187px; margin-top:-333px; font-size:12px; line-height: 0.5em;" onclick="darclick();cambiafondo();">
                <div class="selectBox" onclick="showCheckboxes();cambiafondo();" >
                    <select name="parques[]" id="parquecitos" onclick="cambiafondo();">
                        <option>Select Park</option>
                    </select>                
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxes" style="width: 99%;">
                    
                    <input style="margin-left: 4px; margin-top:7px;" type="checkbox" onclick="toggle(this);" />Check all                   
                   
                    
                            
                     <?php                  
                                                
                    $sql = "SELECT id, nombre FROM parques where id_grupo ='$id_grupo' order by nombre asc";
                    $rs = Doo::db()->query($sql);
                    $park_name = $rs->fetchAll();
                    
                    foreach ($park_name as $r):
                        ?>   

                       <label for="one"> <input type="checkbox" name="checkbox" id="<?php echo $r['id'] ?>" onclick="darclick();" value="<?php echo $r['id'] ?>"/><?php echo $r['nombre']; ?></label>     
                    
                    <?php endforeach; ?>       
                   

                </div>
            </div>
        </div>

        <input type="text" style="display:none; margin-top:15px; margin-left:1px; " name="sodastereo" id="sodastereo" value="" />
        
        <input type="text" name="idgrupo" id="idgrupo" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;"  size="10" maxlength="10"  value="" autocomplete="off"/>
        <input type="text" name="estado" id="estado" style="display:none; margin-left: 178px; margin-top: 5px; width:60px; color: #0B55C4;  font-size: 10px; text-align: center;" size="10" maxlength="10"  value="<?php echo $data['dato'];?>" autocomplete="off"/>     
        <input type="text" name="grupale" id="grupale" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" size="10" maxlength="10"  value="<?php echo $id_grupo ;?>" autocomplete="off"/>
            
        </div>
    </div>
</form>

<!-- Nuevo formulario -->
    <form id="form2" action="<?php echo $data['rootUrl']?>admin/tours/admision-rate/add/1" name="form2" method="POST">
      <!-- Tus inputs -->
    
        <fieldset style="display:none;"><legend></legend>
            
            <input type="text" style="margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="idgrupo2" id="idgrupo2"  size="10" maxlength="10"  value="" autocomplete="off"/>
            
                       
            <input name="mysubmit" id="mysubmit" type="submit" value="Enviar" on />
            
        </fieldset>
      
    </form>

   <div id="respuesta"><!-- Respuesta AJAX --></div>






<script type="text/javascript">
//    $(function () {
//        $.datepicker.setDefaults($.datepicker.regional["es"]);
//        $("#fecha_ini").datepicker({
//            firstDay: 1,
//            numberOfMonths: 1,
//            changeMonth: true,
//            changeYear: true
////            dateFormat:'mm-dd-yy'
//        });
//    });
//    $(function () {
//        $.datepicker.setDefaults($.datepicker.regional["es"]);
//        $("#fecha_fin").datepicker({
////            dateFormat:'mm-dd-yy'
//            firstDay: 1,
//            numberOfMonths: 1,
//            changeMonth: true,
//            changeYear: true
//            
//        });
//    });

    $(function () {
        //$.datepicker.setDefaults($.datepicker.regional["es"]);
        $('#fecha_ini').datepicker({
           // dateFormat: 'mm-dd-yy',
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 2
            
        });
    });
    
   
    $(function () {
        //$.datepicker.setDefaults($.datepicker.regional["es"]);
        $('#fecha_fin').datepicker({
            //dateFormat: 'mm-dd-yy',


            beforeShow: function () {
                if ($('#fecha_fin').attr("readonly") === "readonly") {
                    return false;
                }
            },
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 2
        });
    });
    
    function fechaRetorno(menor) {
        
        var d = new Date(menor);       
        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
        $('#fecha_fin').datepicker('option', 'minDate', d);
        
    }
    


    $("#company_name").keyup(function () {
        $("#company_name").autocomplete({
            source: '<?php echo $data["rootUrl"]; ?>admin/tours/loadcompany/' + $("#company_name").val(),
            select: function (event, ui) {
                $('#id_agency').val(ui.item.id);
            }
        });
    });

    $('#image1').change(function () {
        var ext = $('#image1').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

            $('#image1').val("");

            $("#dialog-message").dialog({
                modal: true,
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                    }
                }
            });

        }
    });

    $("#id_grupo").change(function () {
        var grupo = $(this).val();
        $("#id_parque").load('<?php echo $data["rootUrl"]; ?>admin/tours/parks/list/' + grupo);
        
    });


    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        
        var retail_adults = document.getElementById('adults').value;
        var cost_adults = document.getElementById('adults1').value;
        
        var retailadults = parseFloat(retail_adults);
        var costadults = parseFloat(cost_adults);
        
        var retail_child = document.getElementById('child').value;
        var cost_child = document.getElementById('child1').value;
        
        var retailchild = parseFloat(retail_child);
        var costchild = parseFloat(cost_child);

        sErrMsg += validateNumberPositivo($('#id_grupo').val(), $('#l_id_grupo').html(), true);

        sErrMsg += validateNumberPositivo($('#cantidad').val(), $('#l_cantidad').html(), true);
        
        if (retailadults < costadults) {
                alert("Retail Adults debe ser mayor o igual a Cost Adults ");
                document.getElementById('adults').style.background = 'red';
                document.getElementById('adults').style.color = '#fff';
                $("#adults").focus();
                
                return false;
        }
        
        if ($("#adults").val() == "") {
                alert("Por favor Asigne un valor a Retail Adults");
                document.getElementById('adults').style.background = 'red';
                document.getElementById('adults').style.color = '#fff';
                $("#adults").focus();
                
                return false;
        }
                
        
        if (retailchild < costchild) {
                alert("Retail Child debe ser mayor o igual a Cost Child ");
                document.getElementById('child').style.background = 'red';
                document.getElementById('child').style.color = '#fff';
                $("#child").focus();
                
                return false;
        }
        
//        if ($("#child").val() > $("#adults").val()) {
//                alert("Retail Child debe ser menor o igual a Retail Adult ");
//                document.getElementById('child').style.background = 'red';
//                document.getElementById('child').style.color = '#fff';
//                $("#child").focus();
//                
//                return false;
//        }
        
        if ($("#child").val() == "") {
                alert("Por favor Asigne un valor a Retail Child");
                document.getElementById('child').style.background = 'red';
                document.getElementById('child').style.color = '#fff';
                $("#child").focus();
                
                return false;
        }

        if ($("#cantidad").val() == "") {
                alert("Por favor digite una cantidad especifica !!!!");
                document.getElementById('cantidad').style.background = 'red';
                document.getElementById('cantidad').style.color = '#fff';
                $("#cantidad").focus();
                
                return false;
        }
        
        if ($("#fecha_ini").val() == "") {
                alert("Por favor Asigne una fecha Inicial");
//                document.getElementById('fecha_ini').style.background = '#4682B4';
//                document.getElementById('fecha_ini').style.color = '#fff';
                $("#fecha_ini").focus();
                
                return false;
        }
        
        if ($("#fecha_fin").val() == "") {
                alert("Por favor Asigne una Fecha Final");
//                document.getElementById('fecha_fin').style.background = '#4682B4';
//                document.getElementById('fecha_fin').style.color = '#fff';
                $("#fecha_fin").focus();
                
                return false;
        }
        
//        if ($("#grupale").val() == "") {
//                alert("Por favor Seleccione un Grupo de Parques !!!");
//                document.getElementById('id_grupo').style.background = 'yellow';
//                    //document.getElementById('fecha_fin').style.background = '#4682B4';
//                    //document.getElementById('fecha_fin').style.color = '#fff';
//                $("#id_grupo").focus();
//                
//                return false;
//        }
        
//        if ($("#sodastereo").val() == "") {
//                alert("Por favor Seleccione un Parque !!!");
//                document.getElementById('parquecitos').style.background = 'yellow';
//                        //document.getElementById('fecha_fin').style.color = '#fff';
//                $("#parquecitos").focus();
//                
//                return false;
//        }
        
        
//        sErrMsg += validateNumberPositivo($('#adults').val(), $('#l_adults').html(), true);
//
//        sErrMsg += validateNumberPositivo($('#child').val(), $('#l_child').html(), true);

<?php if ($admision_rates->type_rate == 2) { ?>
            if ($('#id_agency').val() == -1) {
                sErrMsg += '- Enter agency data \n';
            }
<?php } ?>

        if (sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;

    }
    
    $('#btn-edit').click(function (){
                window.location = '<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/<?php echo $admision_rates->type_rate; ?>';
    });

    $('#btn-save').click(function () {
        if (validateForm()) {
            
            $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>admin/tours/admision-rate/<?php echo $admision_rates->type_rate; ?>';
            });

</script>




<script type="text/javascript">
function comprobarFecha(fechaAnterior,fechaPosterior,fechaActual)
{
          
     var fechaini = document.getElementById('fecha_ini').value;
     var fechafin =  document.getElementById('fecha_fin').value;
 
     var fecha_ini = new Date(fechaini);
     var fecha_fin = new Date(fechafin);

     if(fechaini !=""){

       if((fecha_fin < fecha_ini)){

             alert("Fecha no Aceptada");
             //$("#fecha_fin").hide();
             //$("#fecha_fin").show();             
             document.getElementById('fecha_fin').value = "";                  
             $("#fecha_fin").focus();                          
             exit;
        }     
        
     }            
            
}

</script>

 
    

<script type="text/javascript">
    
    $(window).load(function () {                        
          
          estado();
          
          comprobarScreen();
          
          //capturamos id del grupo de parques
          selector();      
  
 
    });

</script>

<script type="text/javascript">
    
 var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
    
</script>

<script type="text/javascript">
    
    function cambiafondo() {
       
       document.getElementById('adults').style.background = '#FFFFFF';
       document.getElementById('adults').style.color = '#696969';
       
       document.getElementById('child').style.background = '#FFFFFF';
       document.getElementById('child').style.color = '#696969';
       
       document.getElementById('parquecitos').style.background = '#FFFFFF';
       document.getElementById('parquecitos').style.color = '#000';
       
       document.getElementById('id_grupo').style.background = '#FFFFFF';
       document.getElementById('id_grupo').style.color = '#000';
       
       
    }
    
</script>

<style type="text/css" media="screen">
    
    .multiselect {
      width: 200px;
    }

    .selectBox {
      position: relative;
    }

    .selectBox select {
      width: 100%;
      font-weight: bold;
    }

    .overSelect {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    #checkboxes {
      display: none;
      border: 1px #dadada solid;
    }

    #checkboxes label {
      display: block;
    }

    #checkboxes label:hover {
/*      background-color: #1e90ff;*/
      background-color: #1E8F75;
      color: #FFFFFF;
    }

</style>

<script type="text/javascript">

        function darclick() {
            var obj = document.getElementById('button');
            obj.click();
        }

    </script>

    <script type="text/javascript">
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>




    <button id="button" style="margin-top:-21px; margin-left:597px; display:none;">Ids!</button>
    <script type="text/javascript">

        $('button').click(function () {
            var ids;
            ids = $('input[type=checkbox]:checked').map(function () {
                return $(this).attr('id');
            }).get();
            //alert('IDS: ' + ids.join(', '));
            //alert(ids.join(', '));
            document.getElementById('sodastereo').value = ids;
            //alert(ids);                            

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

<script type="text/javascript">
    
    function grupal(){
        
        
       var idgrupo= document.getElementById('id_grupo').value;
       
       if(idgrupo == ""){
          
           
           document.getElementById('idgrupo').value = ""; 
           document.getElementById('idgrupo2').value = "";
       }else{
           document.getElementById('idgrupo').value = idgrupo;
           document.getElementById('idgrupo2').value = idgrupo;
       }
    }
    
</script>

<script type="text/javascript">
    $("document").ready(function()
    {
     $("#id_grupo").change(function(){
      var id2=$("#id_grupo").val();
      
      setTimeout(function () {            

               $('#mysubmit').click();

      }, 100);   
       
      
      
      
     })
     })
   
</script>

<script type="text/javascript">
    
    function estado(){
        
        var est = document.getElementById('estado').value;
        //alert(est);
       
        if(est == "edit"){
            //alert("hola mundo");
            document.getElementById('id_grupo').disabled =true;
            
            document.getElementById('id_grupo').style.background = '#E1E3E8';
            document.getElementById('checkboxes1').style.background = 'transparent';
            document.getElementById('checkboxes1').style.color = '#FFFFFF';
            document.getElementById('parquecitos').style.display = 'none';
            document.getElementById('todoparques').style.display = '';
            document.getElementById('todoparques').style.background = 'transparent';
//            document.getElementById('todoparques').style.width = "auto";
//            document.getElementById('todoparques').style.align = "center";
            document.getElementById('cerati').style.width = "924px";
            document.getElementById('id_parque').style.display = 'none';
            document.getElementById('id_parque').style.disabled = true;
            document.getElementById('id_parque').style.background = '#E1E3E8';
            
            
            
            document.getElementById('cantidad').disabled = true;
            document.getElementById('cantidad').style.background = '#E1E3E8';
            document.getElementById('cantidad').style.marginTop = "35px";
            
            document.getElementById('l_cantidad').style.marginTop = "35px";
            
            document.getElementById('adults1').style.background = '#FFFFFF';
            document.getElementById('adults1').style.color = '#000';
            document.getElementById('child1').style.background = '#FFFFFF';
            document.getElementById('child1').style.color = '#000';
            
            document.getElementById('adults').style.background = '#FFFFFF'
            document.getElementById('adults').style.color = '#000';
            document.getElementById('child').style.background = '#FFFFFF';
            document.getElementById('child').style.color = '#000';
            
            
        }else if(est == "New"){
            //alert("Nuevo");
            document.getElementById('parquecitos').style.display = '';
            document.getElementById('todoparques').style.display = 'none';
            document.getElementById('cerati').style.width = "366px";
            //document.getElementById('id_grupo').style.disabled = "false";
            document.getElementById('id_grupo').disabled = false;
            document.getElementById('cantidad').disabled = false;
        }
    }
   
   
</script>

<script type="text/javascript">
      $(document).ready(function(){   
         $(document).on('submit', '#form2', function() { 

              //Obtenemos datos formulario.
              var data = $(this).serialize(); 

              //AJAX.
              $.ajax({  
                 type : 'POST',
                 url  : '<?php echo $data['rootUrl']?>admin/tours/admision-rate/add/1',
                 data:  data, 

                 success:function(data) {  
                     $('#respuesta').html(data).fadeIn();
                 }  
              });
              return false;
        });
      });//Fin document.
</script>        

<script type="text/javascript">
    
    
    
    function selector(){
       
       <?php
       if ($id_grupo == "0"){
           
           $grupo = 0;
       }else if($id_grupo == "4"){
           
           $grupo = 1;
       }else if($id_grupo == "5"){
           
           $grupo = 2;
       }else if($id_grupo == "6"){
           
           $grupo = 3;
       }else if($id_grupo == "7"){
           
           $grupo = 4;
       }else if($id_grupo == "8"){
           
           $grupo = 5;
       }else if($id_grupo == "9"){
           
           $grupo = 6;
       }else if($id_grupo == "10"){
           
           $grupo = 7;
       }else if($id_grupo == "11"){
           
           $grupo = 8;
       }else if($id_grupo == "12"){
           
           $grupo = 9;
       }else if($id_grupo == "13"){
           
           $grupo = 10;
       }else if($id_grupo == "14"){
           
           $grupo = 11;
       }else if($id_grupo == "15"){
           
           $grupo = 12;
       }else if($id_grupo == "16"){
           
           $grupo = 13;
       }else if($id_grupo == "17"){
           
           $grupo = 14;
       }else if($id_grupo == "18"){
           
           $grupo = 15;
       }else if($id_grupo == "19"){
           
           $grupo = 16;
       }else if($id_grupo == "20"){
           
           $grupo = 17;
       }
       
       ?>
        
       document.getElementById('id_grupo').selectedIndex = <?php echo $grupo; ?>;
       
      
    }
    
</script>   


<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloadults1(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('adults1').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solochild1(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('child1').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solocantidad(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('cantidad').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloadult(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('adults').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solochild(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('child').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>

<script type="text/javascript"> 
       function redondea(sVal, nDec){ 
           
        var n = parseFloat(sVal); 
        var s = "0.00"; 
        
//        setTimeout(function () {
            if (!isNaN(n)){ 
             n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec); 
             s = String(n); 
             s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1); 
             s = s.substr(0, s.indexOf(".") + nDec + 1); 
                } 
                return s; 
//          }, 2000);
        } 

       function ponDecimales1(nDec){ 
           
        setTimeout(function () {

        document.form1.adults1.value = redondea(document.form1.adults1.value, nDec); 
        document.form1.child1.value = redondea(document.form1.child1.value, nDec); 
        document.form1.adults.value = redondea(document.form1.adults.value, nDec); 
        document.form1.child.value = redondea(document.form1.child.value, nDec); 
        
                
         }, 2000);
       
       } 
    </script> 
    
<script type="text/javascript"> 
    
       function validacantidad(){ 
           
          setTimeout(function () {

            var cant = document.getElementById('cantidad').value;
            
                if(cant == 0){
                    
                    document.getElementById('cantidad').value = 1;

                }else if(cant >= 10){
                    
                    document.getElementById('cantidad').value = 9;
                    
                }

                
         }, 100);
           
       }
               
</script>    

<script type="text/javascript"> 
    
function validar(obj) { 
    
      var adults = document.getElementById('adults').value;
      var adults1 = document.getElementById('adults1').value;
      
      var child = document.getElementById('child').value;
      var child1 = document.getElementById('child1').value;
      
      num=obj.value.charAt(0); 
      if(num!='1' && num!='2' && num!='3' &&  num!='4' && num!='5' && num!='6' && num!='7' && num!='8' && num!='9') { 
        //alert('Hay una cantidad que no puede empezar por cero'); 
        //obj.focus(); 
        if(adults == 0){
            document.getElementById('adults').value = "";
        }
        
        if(adults1 == 0){
            document.getElementById('adults1').value = "";
        }
        
        if(child == 0){
            document.getElementById('child').value = "";
        }
        
        if(child1 == 0){
            document.getElementById('child1').value = "";
        }
        
        exit;
      } 

}  
    
</script> 