<?php

if (Doo::acl()->isDenied("operador", "AdminController")) {
    echo "entro";
    exit();
}

Doo::loadController('I18nController');

class AdminController extends I18nController {

    public function isAuth() {

        if (isset($_SESSION["login"])) {
            return true;
        } else {
            return false;
        }
    }

    // public function home() {

    //    $services = $this->tablas();
    //    print($services);


    //     $auth = $this->isAuth();


    //     if ($auth) {
    //         $this->data['rootUrl'] = Doo::conf()->APP_URL;
    //         $this->data['content'] = 'home.php';
    //         $this->renderc('admin/index', $this->data);
    //     } else {
    //         return Doo::conf()->APP_URL . "admin";
    //     }
    // }


    public function tablas() {

    $temporal = $this->params['temporal'];
    //echo $temporal;


    $fecha_actual = date("Y-m-d");

    $fecha_mas_un_dia_temp = strtotime ( '+1 day' , strtotime ( $fecha_actual ) ) ;
    $fecha_mas_un_dia = date ( 'Y-m-d' , $fecha_mas_un_dia_temp );

//    $fecha_mas_dos_dias_temp = strtotime ( '+2 day' , strtotime ( $fecha_actual ) ) ;
//    $fecha_mas_dos_dias = date ( 'Y-m-d' , $fecha_mas_dos_dias_temp );

    $fecha_ini = $fecha_actual;
    $fecha_ini1 = $fecha_mas_un_dia;
    //$fecha_fin = $fecha_actual;

    //$fecha_ini2 = $fecha_mas_un_dia;
    //$fecha_fin2 = $fecha_mas_un_dia;

//    $sqlfec = "SELECT DISTINCT fecha_ini FROM routes WHERE  fecha_ini = '$fecha_ini' OR fecha_ini ='$fecha_ini2' ORDER BY fecha_ini ASC";
//    $rsfec = Doo::db()->query($sqlfec);
//    $fechale = $rsfec->fetchAll();
//
//
//    foreach ($fechale as $fecs){
//
//    $fecha_ini1 = $fecs['fecha_ini'];
//    $fecha_fin = $fecha_ini1;
//


//    $sql = "SELECT DISTINCT trip_no FROM routes WHERE  fecha_ini='$fecha_ini' ORDER BY TRIP_NO ASC";//
//    OR trip_no = '101' OR trip_no = '201' OR trip_no = '301'

//        $sql = "SELECT DISTINCT trip_no FROM routes WHERE  trip_no = '100' OR trip_no ='200' OR trip_no = '300'  AND  fecha_ini ='$fecha_ini1' ORDER BY TRIP_NO ASC";
//        $rs = Doo::db()->query($sql);
//        $datos = $rs->fetchAll();
        //print_r($datos);


//        foreach ($datos as $dat){
//

            //$trip = $dat['trip_no'];


            //fecha actual

            $trip100_1 = 100;
            $sqlcap100_1 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip100_1' AND trip_from ='1' AND trip_to ='8' ";
            $rscap100_1 = Doo::db()->query($sqlcap100_1);
            $capac100_1 = $rscap100_1->fetchAll();

            foreach ($capac100_1 as $cap100_1) {

            }
            $capacidad100_1 = $cap100_1['Capacidad'];
            $vehiculos100_1  = $cap100_1['vehicles'];

            $sqlres100_1 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip100_1' AND fecha_salida = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip100_1' AND fecha_retorno = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res100_1 = Doo::db()->query($sqlres100_1, array($trip100_1, $fecha_ini));
            $r_res100_1 = $rs_res100_1->fetchAll();
            $res_tot100_1 = $r_res100_1[0]['transport'] ? $r_res100_1[0]['transport'] : 0;

            $total_cupos100_1 = $res_tot100_1;

            if($capacidad100_1 == 0){
                $cupo_disponible100_1 = 0;
            }else{
               $cupo_disponible100_1 = $capacidad100_1 - $total_cupos100_1;

            }

            //fecha mas un dia

            $trip100 = 100;
            $sqlcap100 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini1' AND trip_no = '$trip100' AND trip_from ='1' AND trip_to ='8' ";
            $rscap100 = Doo::db()->query($sqlcap100);
            $capac100 = $rscap100->fetchAll();

            foreach ($capac100 as $cap100) {

            }
            $capacidad100 = $cap100['Capacidad'];
            $vehiculos100  = $cap100['vehicles'];

            $sqlres100 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip100' AND fecha_salida = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip100' AND fecha_retorno = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res100 = Doo::db()->query($sqlres100, array($trip100, $fecha_ini1));
            $r_res100 = $rs_res100->fetchAll();
            $res_tot100 = $r_res100[0]['transport'] ? $r_res100[0]['transport'] : 0;

            $total_cupos100 = $res_tot100;

            if($capacidad100 == 0){
                $cupo_disponible100 = 0;
            }else{
               $cupo_disponible100 = $capacidad100 - $total_cupos100;

            }



            //****************************** 200 ***********************************

            //fecha actual

            $trip200_1 = 200;
            $sqlcap200_1 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip200_1' AND trip_from ='1' AND trip_to ='8' ";
            $rscap200_1 = Doo::db()->query($sqlcap200_1);
            $capac200_1 = $rscap200_1->fetchAll();

            foreach ($capac200_1 as $cap200_1) {

            }
            $capacidad200_1 = $cap200_1['Capacidad'];
            $vehiculos200_1  = $cap200_1['vehicles'];

            $sqlres200_1 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip200_1' AND fecha_salida = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip200_1' AND fecha_retorno = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res200_1 = Doo::db()->query($sqlres200_1, array($trip200_1, $fecha_ini));
            $r_res200_1 = $rs_res200_1->fetchAll();
            $res_tot200_1 = $r_res200_1[0]['transport'] ? $r_res200_1[0]['transport'] : 0;

            $total_cupos200_1 = $res_tot200_1;

            if($capacidad200_1 == 0){
                $cupo_disponible200_1 = 0;
            }else{
               $cupo_disponible200_1 = $capacidad200_1 - $total_cupos200_1;

            }


            //fecha mas un dia

            $trip200 = 200;
            $sqlcap200 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini1' AND trip_no = '$trip200' AND trip_from ='1' AND trip_to ='8' ";
            $rscap200 = Doo::db()->query($sqlcap200);
            $capac200 = $rscap200->fetchAll();

            foreach ($capac200 as $cap200) {

            }
            $capacidad200 = $cap200['Capacidad'];
            $vehiculos200  = $cap200['vehicles'];

            $sqlres200 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip200' AND fecha_salida = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip200' AND fecha_retorno = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) ";
            $rs_res200 = Doo::db()->query($sqlres200, array($trip200, $fecha_ini1));
            $r_res200 = $rs_res200->fetchAll();
            $res_tot200 = $r_res200[0]['transport'] ? $r_res200[0]['transport'] : 0;

            $total_cupos200 = $res_tot200;

            if($capacidad200 == 0){
                $cupo_disponible200 = 0;
            }else{
               $cupo_disponible200 = $capacidad200 - $total_cupos200;

            }

            //fecha actual

            $trip300_1 = 300;
            $sqlcap300_1 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip300_1' AND trip_from ='1' AND trip_to ='8' ";
            $rscap300_1 = Doo::db()->query($sqlcap300_1);
            $capac300_1 = $rscap300_1->fetchAll();

            foreach ($capac300_1 as $cap300_1) {

            }
            $capacidad300_1 = $cap300_1['Capacidad'];
            $vehiculos300_1  = $cap300_1['vehicles'];

            $sqlres300_1 = "SELECT (SUM(pax) + SUM(pax2)) AS transport FROM  reservas   WHERE (trip_no2 = '$trip300_1' AND fecha_retorno = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no = '$trip300_1' AND fecha_salida = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res300_1 = Doo::db()->query($sqlres300_1, array($trip300_1, $fecha_ini));
            $r_res300_1 = $rs_res300_1->fetchAll();
            $res_tot300_1 = $r_res300_1[0]['transport'] ? $r_res300_1[0]['transport'] : 0;

            $total_cupos300_1 = $res_tot300_1;

            if($capacidad300_1 == 0){
                $cupo_disponible300_1 = 0;
            }else{
               $cupo_disponible300_1 = $capacidad300_1 - $total_cupos300_1;

            }

            //fecha mas un dia

            $trip300 = 300;
            $sqlcap300 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini1' AND trip_no = '$trip300' AND trip_from ='1' AND trip_to ='8' ";
            $rscap300 = Doo::db()->query($sqlcap300);
            $capac300 = $rscap300->fetchAll();

            foreach ($capac300 as $cap300) {

            }
            $capacidad300 = $cap300['Capacidad'];
            $vehiculos300  = $cap300['vehicles'];

            $sqlres300 = "SELECT (SUM(pax) + SUM(pax2))AS transport FROM  reservas   WHERE (trip_no2 = '$trip300' AND fecha_retorno = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no = '$trip300' AND fecha_salida = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res300 = Doo::db()->query($sqlres300, array($trip300, $fecha_ini1));
            $r_res300 = $rs_res300->fetchAll();
            $res_tot300 = $r_res300[0]['transport'] ? $r_res300[0]['transport'] : 0;

            $total_cupos300 = $res_tot300;

            if($capacidad300 == 0){
                $cupo_disponible300 = 0;
            }else{
               $cupo_disponible300 = $capacidad300 - $total_cupos300;

            }

            //fecha actual

            $trip101_1 = 101;
            $sqlcap101_1 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip101_1' AND trip_from ='8' AND trip_to ='1' ";
            $rscap101_1 = Doo::db()->query($sqlcap101_1);
            $capac101_1 = $rscap101_1->fetchAll();

            foreach ($capac101_1 as $cap101_1) {

            }
            $capacidad101_1 = $cap101_1['Capacidad'];
            $vehiculos101_1  = $cap101_1['vehicles'];

            $sqlres101_1 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip101_1' AND fecha_salida = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip101_1' AND fecha_retorno = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res101_1 = Doo::db()->query($sqlres101_1, array($trip101_1, $fecha_ini));
            $r_res101_1 = $rs_res101_1->fetchAll();
            $res_tot101_1 = $r_res101_1[0]['transport'] ? $r_res101_1[0]['transport'] : 0;

            $total_cupos101_1 = $res_tot101_1;

            if($capacidad101_1 == 0){
                $cupo_disponible101_1 = 0;
            }else{
               $cupo_disponible101_1 = $capacidad101_1 - $total_cupos101_1;

            }

            //fecha mas un dia

            $trip101 = 101;
            $sqlcap101 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini1' AND trip_no = '$trip101' AND trip_from ='8' AND trip_to ='1' ";
            $rscap101 = Doo::db()->query($sqlcap101);
            $capac101 = $rscap101->fetchAll();

            foreach ($capac101 as $cap101) {

            }
            $capacidad101 = $cap101['Capacidad'];
            $vehiculos101  = $cap101['vehicles'];

            $sqlres101 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip101' AND fecha_salida = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip101' AND fecha_retorno = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res101 = Doo::db()->query($sqlres101, array($trip101, $fecha_ini1));
            $r_res101 = $rs_res101->fetchAll();
            $res_tot101 = $r_res101[0]['transport'] ? $r_res101[0]['transport'] : 0;

            $total_cupos101 = $res_tot101;

            if($capacidad101 == 0){
                $cupo_disponible101 = 0;
            }else{
               $cupo_disponible101 = $capacidad101 - $total_cupos101;

            }

            //fecha actual

            $trip201_1 = 201;
            $sqlcap201_1 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip201_1' AND trip_from ='8' AND trip_to ='1'";
            $rscap201_1 = Doo::db()->query($sqlcap201_1);
            $capac201_1 = $rscap201_1->fetchAll();

            foreach ($capac201_1 as $cap201_1) {

            }
            $capacidad201_1 = $cap201_1['Capacidad'];
            $vehiculos201_1  = $cap201_1['vehicles'];

            $sqlres201_1 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip201_1' AND fecha_salida = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip201_1' AND fecha_retorno = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res201_1 = Doo::db()->query($sqlres201_1, array($trip201_1, $fecha_ini));
            $r_res201_1 = $rs_res201_1->fetchAll();
            $res_tot201_1 = $r_res201_1[0]['transport'] ? $r_res201_1[0]['transport'] : 0;

            $total_cupos201_1 = $res_tot201_1;

            if($capacidad201_1 == 0){
                $cupo_disponible201_1 = 0;
            }else{
               $cupo_disponible201_1 = $capacidad201_1 - $total_cupos201_1;

            }

            //fecha mas un dia

            $trip201 = 201;
            $sqlcap201 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini1' AND trip_no = '$trip201' AND trip_from ='8' AND trip_to ='1' ";
            $rscap201 = Doo::db()->query($sqlcap201);
            $capac201 = $rscap201->fetchAll();

            foreach ($capac201 as $cap201) {

            }
            $capacidad201 = $cap201['Capacidad'];
            $vehiculos201  = $cap201['vehicles'];

            $sqlres201 = "SELECT (sum(pax) + sum(pax2))as transport
                      FROM  reservas
                      WHERE (trip_no = '$trip201' AND fecha_salida = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no2 ='$trip201' AND fecha_retorno = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res201 = Doo::db()->query($sqlres201, array($trip201, $fecha_ini1));
            $r_res201 = $rs_res201->fetchAll();
            $res_tot201 = $r_res201[0]['transport'] ? $r_res201[0]['transport'] : 0;

            $total_cupos201 = $res_tot201;

            if($capacidad201 == 0){
                $cupo_disponible201 = 0;
            }else{
               $cupo_disponible201 = $capacidad201 - $total_cupos201;

            }

            //fecha actual

            $trip301_1 = 301;
            $sqlcap301_1 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini' AND trip_no = '$trip301_1' AND trip_from ='8' AND trip_to ='1' ";
            $rscap301_1 = Doo::db()->query($sqlcap301_1);
            $capac301_1 = $rscap301_1->fetchAll();

            foreach ($capac301_1 as $cap301_1) {

            }
            $capacidad301_1 = $cap301_1['Capacidad'];
            $vehiculos301_1  = $cap301_1['vehicles'];

            $sqlres301_1 = "SELECT (SUM(pax) + SUM(pax2))AS transport FROM  reservas   WHERE (trip_no2 = '$trip301_1' AND fecha_retorno = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no = '$trip301_1' AND fecha_salida = '$fecha_ini' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res301_1 = Doo::db()->query($sqlres301_1, array($trip301_1, $fecha_ini));
            $r_res301_1 = $rs_res301_1->fetchAll();
            $res_tot301_1 = $r_res301_1[0]['transport'] ? $r_res301_1[0]['transport'] : 0;

            $total_cupos301_1 = $res_tot301_1;

            if($capacidad301_1 == 0){
                $cupo_disponible301_1 = 0;
            }else{
               $cupo_disponible301_1 = $capacidad301_1 - $total_cupos301_1;

            }

            //fecha mas un dia

            $trip301 = 301;
            $sqlcap301 = "SELECT (SUM(capacity) + SUM(capacity2) + SUM(capacity3) + SUM(capacity4) + SUM(capacity5))AS Capacidad, vehicles FROM routes WHERE fecha_ini = '$fecha_ini1' AND trip_no = '$trip301' AND trip_from ='8' AND trip_to ='1' ";
            $rscap301 = Doo::db()->query($sqlcap301);
            $capac301 = $rscap301->fetchAll();

            foreach ($capac301 as $cap301) {

            }
            $capacidad301 = $cap301['Capacidad'];
            $vehiculos301  = $cap301['vehicles'];

            $sqlres301 = "SELECT (SUM(pax) + SUM(pax2))AS transport FROM  reservas   WHERE (trip_no2 = '$trip301' AND fecha_retorno = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED')) OR (trip_no = '$trip301' AND fecha_salida = '$fecha_ini1' AND (estado = 'CONFIRMED' OR estado = 'INVOICED'))";
            $rs_res301 = Doo::db()->query($sqlres301, array($trip301, $fecha_ini1));
            $r_res301 = $rs_res301->fetchAll();
            $res_tot301 = $r_res301[0]['transport'] ? $r_res301[0]['transport'] : 0;

            $total_cupos301 = $res_tot301;

            if($capacidad301 == 0){
                $cupo_disponible301 = 0;
            }else{
               $cupo_disponible301 = $capacidad301 - $total_cupos301;

            }



            if($temporal == 100){

            echo '<div style="position:absolute;  height:258px; width:302px; margin-left:-58px; margin-top:108px; z-index: 1;">

                <table style="background-color:transparent; heigth:258px; width: 300px; margin-left:-10px; border-color: #a30000; border: 2px solid #a30000; border-left: 1px solid #fff; border-bottom: 1px solid #fff; border-top: 1px solid #fff; border-right: 1px solid #fff; border-radius: 0px 22px 0px 0px;" class="grid2" cellspacing="1" id="grid2">

                    <thead>
                        <tr>
                           <td colspan=13; style="text-align: center; font-weight:bold; font-size:12px; background-color:#a30000; color:#fff; text-shadow: 2px 2px 3px #000; border-radius: 3px 120px 0px 120px;">Orlando to Miami</td>
                        </tr>
                        <tr colspan=13; style="background-color:#fff;">
                           <td style="width:194px; text-align: center; background-color:#2e3555; color:#fff; text-shadow: 2px 2px 3px #000; font-weight:bold; font-size:12px; border-left: 1px solid #000;border-bottom: 1px solid #000;border-top: 1px solid #000;">Trip</td>
                           <td colspan=4; style="width:15px; text-align: center; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; font-size:12px; background-color:#005983; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;border-top: 1px solid #000;">100</td>
                           <td colspan=4; style="width:15px; text-align: center; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; font-size:12px; background-color:#6a8dab; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;border-top: 1px solid #000;">200</td>
                           <td colspan=4; style="width:15px; text-align: center; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; font-size:12px; background-color:#90a8c0; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;border-top: 1px solid #000;">300</td>

                        </tr>
                        <tr colspan=13; style="background-color:#fff;">
                           <td style="width:194px; text-align: center; font-weight:bold; font-size:9.5px; background-color:#6a8dab; border-left: 1px solid #000;border-right: 1px solid transparent;"></td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#005983; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">V</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#005983; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">S</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#005983; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">R</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#005983; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">A</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#6a8dab; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">V</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#6a8dab; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">S</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#6a8dab; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">R</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#6a8dab; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">A</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#90a8c0; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">V</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#90a8c0; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">S</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#90a8c0; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">R</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#90a8c0; color:#fff; text-shadow: 2px 2px 3px #000; border-right: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;border-top: 1px solid #000;">A</td>
                        </tr>

                    </thead>

                    <tbody>


                        <tr class="">

                            <td style="width:194px; text-align: center; font-size:9.5px; height: 22px !important; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#2e3555;">' . $fecha_ini . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#005983;">' . $vehiculos100_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#005983;">' . $capacidad100_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000;  border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#005983;">' . $total_cupos100_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:12px; font-weight:bold; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #005983; border-top: 1.5px solid #005983;border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible100_1 . '</td>

                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6a8dab;">' . $vehiculos200_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6a8dab;">' . $capacidad200_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6a8dab;">' . $total_cupos200_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:12px; font-weight:bold; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #005983; border-top: 1.5px solid #005983;border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible200_1 . '</td>

                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#90a8c0;">' . $vehiculos300_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#90a8c0;">' . $capacidad300_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#90a8c0;">' . $total_cupos300_1 . '</td>
                            <td style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible300_1 . '</td>

                        </tr>

                        <tr class="">

                            <td style="width:194px; text-align: center; font-size:9.5px; height: 22px !important; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#2e3555;">' . $fecha_ini1 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#005983;">' . $vehiculos100 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#005983;">' . $capacidad100 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000;  border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#005983;">' . $total_cupos100 . '</td>
                            <td style="width:15px; text-align: center; font-size:12px; font-weight:bold; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #005983; border-top: 1.5px solid #005983;border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible100 . '</td>

                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6a8dab;">' . $vehiculos200 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6a8dab;">' . $capacidad200 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6a8dab;">' . $total_cupos200 . '</td>
                            <td style="width:15px; text-align: center; font-size:12px; font-weight:bold; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #005983; border-top: 1.5px solid #005983;border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible200 . '</td>

                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#90a8c0;">' . $vehiculos300 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#90a8c0;">' . $capacidad300 . '</td>
                            <td style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff;  text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#90a8c0;">' . $total_cupos300 . '</td>
                            <td style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible300 . '</td>

                        </tr>



                    </tbody>

                    </table>


                </div>';




            echo '<div style="position:absolute;  height:258px; width:302px; margin-left:-58px; margin-top:300px; z-index: 1;">

                <table style="background-color:transparent; heigth:258px; width: 300px; margin-left:-10px; border-color: #fff; border: 2px solid #a30000; border-left: 1px solid #fff; border-bottom: 1px solid #fff; border-top: 1px solid #fff; border-right: 1px solid #fff; border-radius: 3px 22px 0px 0px;" class="grid2" cellspacing="1" id="grid2">

                    <thead>
                        <tr>
                           <td colspan=13; style="text-align: center; font-weight:bold; font-size:12px; background-color:#005983; color:#fff; text-shadow: 2px 2px 3px #000; border-radius: 120px 3px 120px 0px;">Miami to Orlando</td>
                        </tr>

                        <tr colspan=13; style="background-color:#fff;">
                           <td colspan=1; style="width:184px; text-align: center; background-color:#6c1204; color:#fff; text-shadow: 2px 2px 3px #000; font-weight:bold; font-size:12px; border-right: 1px solid #000; border-left: 1px solid #000;border-bottom: 1px solid #000;border-top: 1px solid #000;">Trip</td>
                           <td colspan=4; style="width:15px; text-align: center; font-weight:bold; font-size:12px; background-color:#a30000; color:#fff; text-shadow: 2px 2px 3px #000; border-right: 1px solid #000; border-left: 1px solid #000;border-bottom: 1px solid #000;border-top: 1px solid #000;">301</td>
                           <td colspan=4; style="width:15px; text-align: center; font-weight:bold; font-size:12px; background-color:#ba4029; color:#fff; text-shadow: 2px 2px 3px #000; border-right: 1px solid #000; border-left: 1px solid #000;border-bottom: 1px solid #000;border-top: 1px solid #000;">101</td>
                           <td colspan=4; style="width:15px; text-align: center; font-weight:bold; font-size:12px; background-color:#ce6850; color:#fff; text-shadow: 2px 2px 3px #000; border-right: 1px solid #000; border-left: 1px solid #000;border-bottom: 1px solid #000;border-top: 1px solid #000;">201</td>

                        </tr>
                        <tr colspan=13; style="background-color:#fff;">
                           <td colspan=1; style="width:184px; text-align: center; font-weight:bold; font-size:9.5px; background-color:#ba4029; border-left: 1px solid #000;border-right: 1px solid transparent;"></td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#a30000; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">V</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#a30000; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">S</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#a30000; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">R</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#a30000; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">A</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ba4029; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">V</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ba4029; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">S</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ba4029; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">R</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ba4029; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">A</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ce6850; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">V</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ce6850; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">S</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ce6850; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">R</td>
                           <td colspan=1; style="width:15px; text-align: center; font-weight:bold; font-size:10px; background-color:#ce6850; color:#fff; text-shadow: 2px 2px 3px #000; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000;">A</td>
                        </tr>

                    </thead>

                    <tbody>

                        <tr class="">

                            <td  style="width:194px; text-align: center; font-size:9.5px; height: 22px !important; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6c1204;">' . $fecha_ini . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#a30000;">' . $vehiculos301_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#a30000;">' . $capacidad301_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#a30000;">' . $total_cupos301_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible301_1 . '</td>


                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ba4029;">' . $vehiculos101_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ba4029;">' . $capacidad101_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ba4029;">' . $total_cupos101_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible101_1 . '</td>


                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ce6850;">' . $vehiculos201_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ce6850;">' . $capacidad201_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ce6850;">' . $total_cupos201_1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible201_1 . '</td>



                        </tr>

                        <tr class="">

                            <td  style="width:194px; text-align: center; font-size:9.5px; height: 22px !important; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000;border-right: 1px solid #000; background-color:#6c1204;">' . $fecha_ini1 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#a30000;">' . $vehiculos301 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#a30000;">' . $capacidad301 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#a30000;">' . $total_cupos301 . '</td>
                            <td  style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible301 . '</td>


                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ba4029;">' . $vehiculos101 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ba4029;">' . $capacidad101 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ba4029;">' . $total_cupos101 . '</td>
                            <td  style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible101 . '</td>


                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ce6850;">' . $vehiculos201 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ce6850;">' . $capacidad201 . '</td>
                            <td  style="width:15px; text-align: center; font-size:10px; font-weight:bold; color:#fff; text-shadow: 2px 2px 3px #000; border-left: 1px solid #000; border-bottom: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; background-color:#ce6850;">' . $total_cupos201 . '</td>
                            <td  style="width:15px; text-align: center; font-size:12px; color:#000; font-weight:bold; border-left: 1.5px solid #005983; border-bottom: 1.5px solid #000; border-top: 1.5px solid #005983; border-right: 1.5px solid #005983; background-color:#ffff00;">' . $cupo_disponible201 . '</td>



                        </tr>


                    </tbody>

                </table>


            </div>';


            }else{

                //echo "";


            }



    }

    public function index() {
        // $this->data['rootUrl'] = Doo::conf()->APP_URL;
        // $this->view()->renderc('admin/login', $this->data);
        return Doo::conf()->APP_URL . "admin/home";
    }

    public function loginpage() {
        $this->restartpuesto();
        // print_r($_REQUEST);
        // die;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('admin/login', $this->data);
        // return Doo::conf()->APP_URL . "admin/home";
    }

    public function contacto() {
        $this->restartpuesto();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'contacto.php';
        $this->renderc('admin/index', $this->data);
        // return Doo::conf()->APP_URL . "admin/contacto";
    }

    public function faq() {

        $this->restartpuesto();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'faq.php';
        $this->renderc('admin/index', $this->data);
        // return Doo::conf()->APP_URL . "admin/home";
    }
    public function setting_agency() {
        $this->restartpuesto();
        $sql1 = "SELECT DISTINCT ua.id,ua.firstname,ua.lastname,ua.email,ua.`password`,ua.id_agencia,ua.admon,ua.activo,ag.company_name,ag.serv_transp,ag.serv_oneday,ag.serv_multiday FROM user_agency ua JOIN agencia ag on id_agencia=ag.id WHERE id_agencia =  '" . $_SESSION['loginagency']->id . "' ";
        $rs1 = Doo::db()->query($sql1);
        $user = $rs1->fetchAll();
        // print_r($user);AND admon = 0
        // die;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'setting_agency.php';
        $this->data['users'] = $user;
        $this->data['infoagency'] = $_SESSION['loginagency'];
        $this->renderc('admin/index', $this->data);
        // return Doo::conf()->APP_URL . "admin/contacto";
    }

    public function login2() {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);

                $pass = md5(trim($_POST['password']));
                //$pass  = trim($_POST['password']);


                $u = $this->db()->find('Usuarios', array('where' => 'usuario = ? and password = ? and estado = 1',
                    'limit' => 1,
                    'select' => 'id,role,usuario,nombre,email,id_pago,usuario_pago,pin_pago',
                    'param' => array($user, $pass)
                        )
                );

                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Access Denied";
                    //return Doo::conf()->APP_URL."admin";
                    $this->renderc('admin/login', $this->data);
                } else {
                    $this->buildMenu($u->role);
                    $login = new stdclass();
                    $login->usuario = $u->usuario;
                    $login->nombre = $u->nombre;
                    $login->email = $u->email;
                    $login->id_pago = $u->id_pago;
                    $login->usuario_pago = $u->usuario_pago;
                    $login->pin_pago = $u->pin_pago;

                    $login->id = $u->id;
                    $login->menu = $this->data["htmlmenu"];
                    $login->toolbar = $this->data["toolbar"];

                    $_SESSION['loginagency'] = $login;

                    //$this->home();
                    return Doo::conf()->APP_URL . "admin/home";

                }
            }
        } else {
            return Doo::conf()->APP_URL . "admin";
        }
    }


    public function restartsession(){
        echo $this->params['iduser'];
    }

    public function home() {
        $this->restartpuesto();
             $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true, "asc" => "orden"));
 
             $this->data['rootUrl'] = Doo::conf()->APP_URL;
             $this->data['content'] = 'home.php';
             $this->data['reservas'] = $reservas;
             $this->renderc('admin/index', $this->data);

      }

      public function restartpuesto(){
        if (isset($_SESSION['loginagency']->id)) {
            $sqlcapa = "SELECT serv_transp,serv_oneday,serv_multiday FROM agencia WHERE id = ? ";
            $rs = Doo::db()->query($sqlcapa, array($_SESSION['loginagency']->id));
            $servicios = $rs->fetch(PDO::FETCH_OBJ);
            $_SESSION['servicios'] = $servicios;
           }
        //    var_dump($_SESSION['loginagency']->id);
        //    die;
        if($_SESSION['loginagency']->id){
          $iden = $_SESSION['loginagency']->id;
        $a = "UPDATE reservas_trip_puestos SET estado = 'CANCELLED' WHERE usuario = $iden and estado = 'USING'";
        Doo::db()->query($a);
        }
      }

    public function login() {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);

                $pass = trim($_POST['password']);
                //$pass  = trim($_POST['password']);

                // $sqlcapa = "SELECT * FROM user_agency AS ua JOIN agencia AS ag ON ua.id_agencia = ag.id WHERE email = ? AND `password` = ? AND activo = 1 ";
                $sqlcapa = "SELECT ua.id,ua.firstname,ua.lastname,ua.email,ua.`password`,ua.id_agencia,ua.admon,ua.activo,ag.company_name,ag.address,ag.city,ag.state,ag.zipcode,ag.main_email,ag.country,ag.manager,ag.phone1,ag.fax,ag.web_page,ag.tour_name,ag.special_price_name,ag.img,ag.serv_transp,ag.serv_oneday,ag.serv_multiday FROM user_agency AS ua JOIN agencia AS ag ON ua.id_agencia = ag.id WHERE email = ? AND `password` = ? AND activo = 1 ";
                $rs = Doo::db()->query($sqlcapa, array($user,$pass));
                $u = $rs->fetch(PDO::FETCH_OBJ);
                // echo '<pre>';
                //    print_r($u);
                //     echo '</pre>';
                //     die;
                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Incorrect username or password";
                    //return Doo::conf()->APP_URL."admin";
                    $this->data['status'] = false;
                    $this->renderc('admin/login', $this->data);
                } else {
                    $this->buildMenu($u->role);
                    $login = new stdclass();
                    $login->iduser = $u->id;
                    $login->id = $u->id_agencia;
                    $login->firstname = $u->firstname;
                    $login->lastname = $u->lastname;
                    $login->email = $u->email;
                    $login->admon = $u->admon;
                    $login->activo = $u->activo;
                    $login->company_name = $u->company_name;
                    $login->address = $u->address;
                    $login->city = $u->city;
                    $login->state = $u->state;
                    $login->zipcode = $u->zipcode;
                    $login->main_email = $u->main_email;
                    $login->country = $u->country;
                    $login->usuario = $u->usuario;
                    $login->manager = $u->manager;
                    $login->position = $u->position;
                    $login->phone1 = $u->phone1;
                    $login->fax = $u->fax;
                    $login->web_page = $u->web_page;
                    $login->tour_name = $u->tour_name;
                    $login->special_price_name = $u->special_price_name;
                    $login->img = $u->img;
                    $login->idstate = $u->id2;
                    $login->iscountry = $u->id3;
                    $login->p = $u->password;
                    $login->stransp = $u->serv_transp;
                    $login->sone = $u->serv_oneday;
                    $login->smul = $u->serv_multiday;
                    // $sqlUpdate = "UPDATE user_agency SET online = 1 WHERE id = $u->id;";
                    // Doo::db()->query($sqlUpdate);
                    $login->menu = $this->data["htmlmenu"];
                    $login->toolbar = $this->data["toolbar"];

                    $_SESSION['loginagency'] = $login;
                    // setcookie("logina[0]",$login->iduser);
                    // setcookie("logina[1]",$login->id);
                    // setcookie("logina[2]",$login->online);
                    // echo '<pre>';
                    // print_r($_POST);
                    // echo '</pre>';
                    // die;
                        if (isset($_POST['userof']) AND $_POST['userof'] == 'off') {
                        $_SESSION['opcionhome'] = $_POST;
                        return Doo::conf()->APP_URL . "admin/".$_POST['opcion'];
                        }else{
                        return Doo::conf()->APP_URL . "admin/home";
                        }
                    //$this->home();
                    //return Doo::conf()->APP_URL . "admin/reservas/add";

                }
            }
        } else {
            return Doo::conf()->APP_URL . "admin/login";
        }
    }

    public function rechangepass(){
        if($_POST['pass']){
            $iden = $_SESSION['loginagency']->id;
            $password = $_POST['pass'];
            // print_r($iden);
            // die;
          $a = "UPDATE user_agency SET password = '$password' WHERE id_agencia = $iden";
          Doo::db()->query($a);
          $_SESSION['loginagency']->p = $password ;
          echo 'ok';
          }else{
              echo 'error';
          }
    }

    public function logout() {
        $this->restartpuesto();
        // print_r($_SESSION["loginagency"]->iduser);
        // die;
        $id =$_SESSION["loginagency"]->iduser;
        // $sqlUpdate = "UPDATE user_agency SET online = 0 WHERE id =  $id;";
        // Doo::db()->query($sqlUpdate);
        unset($_SESSION['usuario']);
        session_destroy();
        return Doo::conf()->APP_URL.'admin/home';
    }

    private function buildMenu($role) {

        $this->data["role"] = $role;
        $lang = Doo::conf()->lang;

        $sql = "select
                       o.codigo, o.menuitem_$lang, o.depende, o.submenu, o.url, r.opcion, o.quicklink
                       from opciones o
                       left join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
                      where depende = ''";


        $rs = Doo::db()->query($sql);
        $parentMenu = $rs->fetchAll();

        $this->data["toolbar"] = "";
        $this->data["htmlmenu"] = '<div id="menu-bar">';
        $this->data["htmlmenu"].= '<ul id="menu">';
        $this->buildChildMenu($parentMenu);
        $this->data["htmlmenu"].= '</ul>';
        $this->data["htmlmenu"].= '<br class="clear" />';
        $this->data["htmlmenu"].= '</div>';
    }

    private function buildChildMenu($parentMenu) {

        $role = $this->data["role"];
        $lang = Doo::conf()->lang;

        foreach ($parentMenu as $row){

            $submenu = $row["submenu"];
            $depende = $row["depende"];
            $codigo = $row["codigo"];
            $opcion = $row["opcion"];
            $toolbar = $row["quicklink"];

            if ($submenu == 'S') {
                if (strlen($opcion) != Null) {//condicion para desaparecer el menu desplegable completo
                    $this->data["htmlmenu"].= '<li>';
                    $this->data["htmlmenu"].= '<a class="node" href="javascript:void(0);">' . ($row["menuitem_$lang"]) . '</a>';

                    $sql = "select
                           o.codigo, o.menuitem_$lang, o.depende, o.submenu, o.url, r.opcion,o.quicklink
                       from opciones o
                       left join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
                      where depende = '$codigo'";


                    $rs = Doo::db()->query($sql);
                    $childMenu = $rs->fetchAll();

                    $this->data["htmlmenu"].= '<ul>';
                    $this->buildChildMenu($childMenu);
                    $this->data["htmlmenu"].= '</ul>';
                    $this->data["htmlmenu"].= '</li>';
                }
            } else {

                if (strlen($opcion) != Null) {
                    $this->data["htmlmenu"].= '<li>';
                    $this->data["htmlmenu"].= '<a href="' . Doo::conf()->APP_URL . $row["url"] . '">' . ($row["menuitem_$lang"]) . '</a>';
                    if ($toolbar != "" & strlen($opcion) != Null) {

                        $toolbar = $this->data["rootUrl"] . "global/img/" . $toolbar;
                        $this->data["toolbar"].= '<div class="icon">
                                        <a href="' . Doo::conf()->APP_URL . $row["url"] . '"><img src="' . $toolbar . '" width="48" height="48" border="0"  alt="' . ($row["menuitem_$lang"]) . '"/><span>' . ($row["menuitem_$lang"]) . '</span></a>
                                     </div>';
                    }
                    $this->data["htmlmenu"].= '</li>';
                }
            }


        }
    }

}
