<?php

/**
 * Description of TripsController
 *
 * 
 */
Doo::loadController('I18nController');

class TripsController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {
        // Cargamos el paginador
        Doo::loadHelper('DooPager');

        if (!isset($_POST["filtro"])) {
            if (!isset($this->params['filtro'])) {
                $filtro = "trip_no";
            } else {
                $filtro = $this->params['filtro'];
            }
        } else {
            $filtro = $_POST["filtro"];
        }

        if (!isset($_POST["texto"])) {
            if (!isset($this->params['texto'])) {
                $texto = "";
            } else {
                $texto = $this->params['texto'];
            }
        } else {
            $texto = $_POST["texto"];
        }

        $rs = Doo::db()->find("Trips", array("select" => "COUNT(*) AS total",
            "where" => "$filtro like ?",
            "limit" => 1,
            "param" => array($texto . '%')
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/trips/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("select trips.id,trip_no,equipment,lunes,martes,miercoles,jueves,viernes,sabado,domingo
                                from trips
                                
                                where $filtro like ?  order by trip_no limit $pager->limit ", array($texto . '%'));

        $trips = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/trips.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['trips'] = $trips;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Trips");
        $trip = new Trips();
        $rs = Doo::db()->query("SELECT id_bus, id_trips , t2.capacidad,t2.plate,t3.trip_no,t2.tipobus

      									 		FROM bus_trips t1
      
											  LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
											  LEFT JOIN trips t3 ON (t3.id = t1.id_trips) 

                                              WHERE  t1.id_trips = ?", array(""));

        $bus_trips = $rs->fetchAll();

        $sql = "SELECT  id,plate,tipobus,capacidad,fecha_ini,fecha_fin
		FROM bus
		WHERE id NOT IN (SELECT id_bus FROM bus_trips)";
        $rs = Doo::db()->query($sql);

        $libres = $rs->fetchAll();


        $this->data['bus_trips'] = $bus_trips;
        $this->data['libres'] = $libres;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['trip'] = $trip;
        $this->data['equipos'] = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        //$this->data['frecuencia']  = Doo::db()->find("Codigos", array("where" => "tipo = 'frecuency'","asArray" => true));

        $this->data['bus'] = Doo::db()->find("Bus", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_trip.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Trips");

        $trip = new Trips($_POST);
        $dias = $_POST['dias'];
                
        
//        $conductor = $_POST['conductor'];
//        print($conductor);
//        exit();

        if (isset($_POST['id_bus'])) {
            $bus_trips = $_POST['id_bus'];
        }

        if (isset($_POST['sacar'])) {
            $bus_trips2 = $_POST['sacar'];
        }

        foreach ($dias as $valor) {
            if ($valor == 1) {
                $trip->lunes = 1;
            }
            if ($valor == 2) {
                $trip->martes = 1;
            }
            if ($valor == 3) {
                $trip->miercoles = 1;
            }
            if ($valor == 4) {
                $trip->jueves = 1;
            }
            if ($valor == 5) {
                $trip->viernes = 1;
            }
            if ($valor == 6) {
                $trip->sabado = 1;
            }
            if ($valor == 7) {
                $trip->domingo = 1;
            }
        }

        if ($trip->lunes == "") {
            $trip->lunes = 0;
        }
        if ($trip->martes == "") {
            $trip->martes = 0;
        }
        if ($trip->miercoles == "") {
            $trip->miercoles = 0;
        }
        if ($trip->jueves == "") {
            $trip->jueves = 0;
        }
        if ($trip->viernes == "") {
            $trip->viernes = 0;
        }
        if ($trip->sabado == "") {
            $trip->sabado = 0;
        }
        if ($trip->domingo == "") {
            $trip->domingo = 0;
        }


        $new = false;

        if ($_POST['id'] == "") {
            $trip->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new) {
            Doo::db()->insert($trip);
            $id = Doo::db()->lastInsertId();
            if (isset($bus_trips)) {

                if (is_array($bus_trips)) {

                    for ($i = 0; $i < count($bus_trips); $i++) {


                        Doo::db()->query("INSERT INTO bus_trips (id_bus,id_trips)  

                                   VALUES ('$bus_trips[$i] ','$id')"
                        );
                    }
                }
            }
        } else {




            if (isset($_POST['change'])) {
                $trip_no = $_POST['trip_no'];

                $trips = Doo::db()->find("Trips", array("select" => "trip_no,lunes,martes,miercoles,jueves,viernes,sabado,domingo",
                    "where" => "trip_no like ?",
                    "asArray" => true,
                    "param" => array($trip_no . '%')
                ));


                if (!empty($trips)) {
                    foreach ($trips as $e) {

                        $lunes = $e["lunes"];
                        $martes = $e["martes"];
                        $miercoles = $e["miercoles"];
                        $jueves = $e["jueves"];
                        $viernes = $e["viernes"];
                        $sabado = $e["sabado"];
                        $domingo = $e["domingo"];
                    }
                    $info = false;
                    if ($lunes != $trip->lunes) {
                        $info = true;
                    }
                    if ($martes != $trip->martes) {
                        $info = true;
                    }
                    if ($miercoles != $trip->miercoles) {
                        $info = true;
                    }
                    if ($jueves != $trip->jueves) {
                        $info = true;
                    }
                    if ($viernes != $trip->viernes) {
                        $info = true;
                    }
                }

                if ($info) {
                    $rs = Doo::db()->query("DELETE FROM programacion
					  WHERE trip_no= '$trip_no'");

                    $_SESSION['elimi'] = "ha eliminado la programacion de trip $trip_no, please generar programacion";
                }
            }

            Doo::db()->update($trip);
            if (isset($bus_trips)) {

                if (is_array($bus_trips)) {



                    for ($i = 0; $i < count($bus_trips); $i++) {

                        $rs = Doo::db()->query("SELECT id_bus, id_trips 
												FROM bus_trips
													WHERE id_bus = ? AND id_trips = ?"
                                , array($bus_trips[$i], $trip->id));

                        $variable = $rs->fetchall();

                        if (empty($variable)) {

                            Doo::db()->query("INSERT INTO bus_trips (id_bus,id_trips)  

                                   VALUES ('$bus_trips[$i] ','$trip->id')"
                            );
                        }
                    }
                }
            }


            if (isset($bus_trips2)) {

                if (is_array($bus_trips2)) {


                    for ($i = 0; $i < count($bus_trips2); $i++) {

                        Doo::db()->query("DELETE
									FROM bus_trips
									WHERE id_bus = '$bus_trips2[$i]' AND id_trips= '$trip->id'"
                        );
                    }
                }
            }
        }

        return Doo::conf()->APP_URL . "admin/trips";
    }

    public function edit() {
        Doo::loadModel("Trips");
        $trip = new Trips();
        $trip->id = $this->params["pindex"];
        $rs = Doo::db()->query("SELECT id_bus, id_trips , t2.capacidad,t2.plate,t3.trip_no,t2.tipobus

      									 		FROM bus_trips t1
      
											  LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
											  LEFT JOIN trips t3 ON (t3.id = t1.id_trips) 

                                              WHERE  t1.id_trips = ?", array($trip->id));

        $bus_trips = $rs->fetchAll();
        $sql = "SELECT  id,plate,tipobus,capacidad,fecha_ini,fecha_fin
		FROM bus
		WHERE id NOT IN (SELECT id_bus FROM bus_trips)";
        $rs = Doo::db()->query($sql);

        $libres = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['trip'] = Doo::db()->find($trip, array('limit' => 1));

        $this->data['bus_trips'] = $bus_trips;

        $this->data['libres'] = $libres;
        $this->data['equipos'] = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        $this->data['bus'] = Doo::db()->find("Bus", array("asArray" => true));
        // $this->data['frecuencia']  = Doo::db()->find("Codigos", array("select tipo from Codigos" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_trip.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Trips");
        $trip = new Trips();
        $trip->id = $_REQUEST['item'];
        Doo::db()->delete($trip);
        return Doo::conf()->APP_URL . "admin/trips";
    }

    public function passengers() {
        // Cargamos el paginador
        Doo::loadHelper('DooPager');

        if (!isset($_POST["trip"])) {
            if (!isset($this->params['trip'])) {
                $trip = "100";
            } else {
                $trip = $this->params['trip'];
            }
        } else {
            $trip = $_POST["trip"];
        }
        if (!isset($_POST["fecha_ini"])) {
            if (!isset($this->params['fecha_ini'])) {
                $fecha = date('m-d-Y');
            } else {
                $fecha = $this->params['fecha_ini'];
            }
        } else {
            $fecha = $_POST["fecha_ini"];
        }
        $fe = $fecha;
        $url = "admin/trips/passengers/$trip/$fe";
        list($mes, $dia, $anyo) = explode("-", $fecha);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        $total = $this->totalReservas($trip, $fecha);
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/trips/passengers/$trip/$fe/page", $total, $total, $total);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);


        /* BORRAMOS DATOS DE LAS VARIABLES DE SESSION */
        unset($_SESSION['asignacion']);
        unset($_SESSION['total_areas']);
        unset($_SESSION['buses']);
        unset($_SESSION['reservas']);
        unset($_SESSION['estado_equipaje']);
        unset($_SESSION['estado_bus']);
        unset($_SESSION['total_areas']);
        unset($_SESSION['totalPax']);


        //Buscamos la reservas
        $reservas = $this->reservas($trip, $fecha);

        $_SESSION['reservas'] = $reservas;
        $botones = array();

        if (count($reservas) == 0) {
            $botones['btn-save'] = 'none';
            $botones['btn-bus'] = 'none';
            $botones['btn-areas'] = 'none';
        }/* else if ($_SESSION['estado_equipaje'] == 0){
          $botones['btn-areas'] = 'none';
          $botones['btn-bus'] = 'none';
          } */ else if ($_SESSION['estado_bus'] == 0) {
            //$botones['btn-bus'] = 'none';
        }
        //echo $_SESSION['estado_bus'];



        $sql = "select trips.id,trip_no,equipment,lunes,martes,miercoles,jueves,viernes,sabado,domingo
                                from trips
                                order by trip_no limit $pager->limit ";
        $rs = Doo::db()->query($sql, array());
        $sqlT = "SELECT `id`, `trip_no`, `equipment` FROM  `trips` ORDER BY  `trips`.`trip_no` ASC  ";
        $rs = Doo::db()->query($sqlT, array());
        $trips = $rs->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/passengers_trip.php';
        $this->data['trips'] = $trips;
        $this->data['trip_no'] = $trip;
        $this->data['botones'] = $botones;
        $this->data['fecha'] = $fecha;
        $this->data['reservas'] = $reservas;
        $this->data['pager'] = $pager->output;
        $this->data['url'] = $url;
        $this->renderc('admin/index', $this->data, true);
    }

    public function reservas($trip, $fecha) {
        //** Adecuar para fromt2 y tot2 

        $rIda = array();
        $rRetorno = array();
        // Buscamos las de ida

        /* $sql = "SELECT r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,
          pax+pax2 as totalPax, r.type_tour, r.tipo_pago, r.pago,r.totaltotal,r.otheramount, r.total2,
          upper(firsname) as firsname ,upper(lasname) as lasname, r.trip_no,
          totaltotal, ar.nombre as de, ob.nombre as para, r.fromt, r.tot,
          ot.phone as phone, IFNULL(upper(ag.company_name),'Supertours') as company_name, pk.place as pickup,
          pk.place as pickup_index, do.place as dropoff, do.place as dropoff_index,
          e1.place as nomExten1, e2.place as nomExten2, r.luggage1 as luggage, fecha_salida as fecha , pb.id_bus as bus,
          pk.posicion as pos_pk,
          do.posicion as pos_po
          FROM reservas r
          left join areas ar on (r.fromt = ar.id)
          left join areas ob on (r.tot =  ob.id)
          left join pickup_dropoff pk on (r.pickup1 =  pk.id)
          left join pickup_dropoff do on (r.dropoff1 =  do.id)
          left join extension e1 on (r.extension1 =  e1.id)
          left join extension e2 on (r.extension2 =  e2.id)
          left join clientes ot on (r.id_clientes =  ot.id)
          left join agencia ag on (r.agency =  ag.id)
          left join passengers_bus pb on (r.id =  pb.id_reservas AND r.trip_no = pb.trip)
          WHERE `trip_no` = ? AND fecha_salida =  ?
          ORDER BY pk.posicion DESC";
          $rs = Doo::db()->query($sql, array( $trip, $fecha ));
          $rIda = $rs->fetchAll(); */

        //Regreso
        /* $sql = "SELECT r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,
          pax+pax2 as totalPax, r.type_tour, r.tipo_pago, r.pago,r.totaltotal,r.otheramount, r.total2,
          upper(firsname) as firsname ,upper(lasname) as lasname,totaltotal,
          ar.nombre as de, ob.nombre as para,
          r.fromt2 as fromt, r.tot2 as tot, ot.phone as phone, IFNULL(upper(ag.company_name),'Supertours') as company_name ,
          pk.place as pickup, do.place as dropoff,
          pk.place as pickup_index, do.place as dropoff, do.place as dropoff_index,
          e1.place as nomExten1, e2.place as nomExten2,
          r.luggage2 as luggage, fecha_retorno as fecha , r.trip_no2 as trip_no, pb.id_bus as bus,
          pk.posicion as pos_pk,
          do.posicion as pos_po
          FROM reservas r
          left join areas ar on (r.fromt2 = ar.id)
          left join areas ob on (r.tot2 =  ob.id)
          left join pickup_dropoff pk on (r.pickup2 =  pk.id)
          left join pickup_dropoff do on (r.dropoff2 =  do.id)
          left join extension e1 on (r.extension3=  e1.id)
          left join extension e2 on (r.extension4 =  e2.id)
          left join clientes ot on (r.id_clientes =  ot.id)
          left join agencia ag on (r.agency =  ag.id)
          left join passengers_bus pb on (r.id =  pb.id_reservas AND r.trip_no2 = pb.trip)
          WHERE trip_no2 = ?  AND  fecha_retorno = ?  AND tipo_ticket = 'roundtrip'
          ORDER BY do.posicion ASC"; */
        $dis = substr($trip, -1);
        if ($dis == 0) {
            $dir = 'result.pos_po ASC';
        } else {
            $dir = 'result.pos_pk DESC, result.pos_po ASC';
        }

        $sql = "select * from ((SELECT r.id,
                  codconf,
                  fecha_ini,
                  hora,
                  tipo_ticket,
                  fecha_salida,
                  fecha_retorno,
                  pax,
                  pax2,
                  pax+pax2 as totalPax,
                  r.type_tour,
                  r.id_tours,
                  r.tipo_pago,
                  r.pago,
                  IF(r.type_tour = 'MULTI',t.totalouta,IF(r.type_tour = 'ONE',ton.totalouta,r.totaltotal)) AS totaltotal,
                  IF(r.type_tour = 'MULTI',t.otheramount,IF(r.type_tour = 'ONE',ton.otheramount,r.otheramount)) AS otheramount,
                  IF(r.type_tour = 'MULTI',t.total,IF(r.type_tour = 'ONE',ton.total,r.total2)) AS total2,
                  upper(firsname) as firsname ,
                  upper(lasname) as lasname,
                  r.trip_no,
                  ar.nombre as de,
                  ob.nombre as para,
                  r.fromt,
                  r.tot,
                  r.room1 as room,
                  ot.phone as phone,
                  IFNULL(upper(ag.company_name),'Supertours') as company_name,
                  pk.place as pickup,
                  pk.address as address_pickup,
                  pk.place as pickup_index,
                  do.place as dropoff,
                  do.address as address_dropoff,
                  do.place as dropoff_index,
                  e1.place as nomExten1,
                  e2.place as nomExten2,
                  r.pickup_exten1 as extension1,
                  r.pickup_exten2 as extension2,                  
                  r.luggage1 as luggage,
                  fecha_salida as fecha ,
                  pb.id_bus as bus,
                  pk.posicion as pos_pk,
                  do.posicion as pos_po,
                  r.comments as comentarios
                FROM reservas r
                  left join areas ar on (r.fromt = ar.id)
                  left join areas ob on (r.tot = ob.id)
                  left join pickup_dropoff pk on (r.pickup1 = pk.id)
                  left join pickup_dropoff do on (r.dropoff1 = do.id)
                  left join extension e1 on (r.extension1 = e1.id)
                  left join extension e2 on (r.extension2 = e2.id)
                  left join clientes ot on (r.id_clientes = ot.id)
                  left join agencia ag on (r.agency = ag.id)
                  left join passengers_bus pb on (r.id = pb.id_reservas AND r.trip_no = pb.trip)
                  left join tours as t on (t.id_reserva = r.id)
                  left join tours_oneday as ton on (ton.id_reserva = r.id)
                WHERE `trip_no` = ? AND
                      fecha_salida = ? and r.estado != 'NOT SHOW W/O CHARGE' and r.estado != 'NOT SHOW W/ CHARGE' and r.estado != 'QUOTE' and r.estado != 'CANCELED')

               UNION ALL

               (
                 SELECT re.id,codconf,
                   fecha_ini,
                   hora,
                   tipo_ticket,
                   fecha_salida,
                   fecha_retorno,
                   pax,
                   pax2,
                   pax+pax2 as totalPax,
                   re.type_tour,
                   re.id_tours,
                   re.tipo_pago,
                   re.pago,
                   IF(re.type_tour = 'MULTI',t.totalouta,IF(re.type_tour = 'ONE',ton.totalouta,re.totaltotal)) AS totaltotal,
                   IF(re.type_tour = 'MULTI',t.otheramount,IF(re.type_tour = 'ONE',ton.otheramount,re.otheramount)) AS otheramount,
                   IF(re.type_tour = 'MULTI',t.total,IF(re.type_tour = 'ONE',ton.total,re.total2)) AS total2,
                   upper(firsname) as firsname ,
                   upper(lasname) as lasname,
                   trip_no2,
                   ar.nombre as de,
                   ob.nombre as para,
                   re.fromt2 as fromt,
                   re.tot2 as tot,                   
                   re.room2 as room,
                   ot.phone as phone,
                   IFNULL(upper(ag.company_name),'Supertours') as company_name,
                   pk.place as pickup,
                   pk.address as address_pickup,
                   pk.place as pickup_index,
                   do.place as dropoff,
                   do.address as address_dropoff,
                   do.place as dropoff_index,
                   e1.place as nomExten1,
                   e2.place as nomExten2,
                   re.pickup_exten3 as extension1,
                   re.pickup_exten4 as extension2, 
                   re.luggage2 as luggage,
                   fecha_retorno as fecha ,
                   pb.id_bus as bus,
                   pk.posicion as pos_pk,
                   do.posicion as pos_po,
                  re.comments as comentarios
                 FROM reservas re
                   left join areas ar on (re.fromt2 = ar.id)
                   left join areas ob on (re.tot2 = ob.id)
                   left join pickup_dropoff pk on (re.pickup2 = pk.id)
                   left join pickup_dropoff do on (re.dropoff2 = do.id)
                   left join extension e1 on (re.extension3= e1.id)
                   left join extension e2 on (re.extension4 = e2.id)
                   left join clientes ot on (re.id_clientes = ot.id)
                   left join agencia ag on (re.agency = ag.id)
                   left join passengers_bus pb on (re.id = pb.id_reservas AND re.trip_no2 = pb.trip)
                   left join tours as t on (t.id_reserva = re.id)
                   left join tours_oneday as ton on (ton.id_reserva = re.id)
                 WHERE trip_no2 = ?
                       AND fecha_retorno = ?
                       /*AND tipo_ticket = 'roundtrip'*/ and re.estado != 'NOT SHOW W/O CHARGE' and re.estado != 'NOT SHOW W/ CHARGE' and re.estado != 'QUOTE' and re.estado != 'CANCELED'))
                       as result order by $dir;";
        $rs = Doo::db()->query($sql, array($trip, $fecha, $trip, $fecha));
        $rRetorno = $rs->fetchAll();
//        print_r(Doo::db()->showSQL());
//        exit;
        //Unimos reservas
        $reservas = array();
        $cont = 0;
        $_SESSION['estado_equipaje'] = '1';
        $_SESSION['estado_bus'] = '1';
        /* if(!empty($rIda)){
          foreach($rIda as $e){
          $e['tipo'] = 'I';// IDA
          $reservas[$cont++] = $e;
          if($e['luggage']==-1){
          $_SESSION['estado_equipaje'] = '0';
          }
          if(trim($e['bus'])==''){
          $_SESSION['estado_bus'] = '0';
          }
          }
          } */

        if (!empty($rRetorno)) {
            foreach ($rRetorno as $e) {
                $e['tipo'] = 'R';
                $reservas[$cont++] = $e;
                if ($e['luggage'] == -1) {
                    $_SESSION['estado_equipaje'] = '0';
                }
                if (trim($e['bus']) == '') {
                    $_SESSION['estado_bus'] = '0';
                }
            }
        }

        return $reservas;
    }

    public function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse == true) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }

//Adrian Morelos. 

    public function totalReservas($trip, $fecha) {
        $sqlT1 = "SELECT COUNT(*) as total 
						FROM reservas 
						Where ((trip_no = ? AND  fecha_salida = ?) OR (trip_no2 = ? AND  fecha_retorno = ?)) and estado != 'CANCELED' and estado != 'NOT SHOW W/ CHARGE' and estado != 'NOT SHOW W/O CHARGE' and estado != 'QUOTE'";
        $rs = Doo::db()->query($sqlT1, array($trip, $fecha, $trip, $fecha));

        $rTotal1 = $rs->fetchAll();
        $total = ($rTotal1[0]['total'] != '') ? $rTotal1[0]['total'] : 0;
        if ($total == 0)
            $total = 1;
        return $total;
    }

    public function totalPasajeros($trip, $fecha) {
        $sqlT1 = "SELECT SUM(pax) + SUM(pax2) as total 
						FROM reservas 
						Where ((trip_no = ? AND  fecha_salida = ?) OR (trip_no2 = ? AND  fecha_retorno = ?))  and estado != 'CANCELED' and estado != 'NOT SHOW W/ CHARGE' and estado != 'NOT SHOW W/O CHARGE' and estado != 'QUOTE'";
        $rs = Doo::db()->query($sqlT1, array($trip, $fecha, $trip, $fecha));
        $rTotal1 = $rs->fetchAll();
//        print_r(Doo::db()->showSQL());
//        exit;
        $total = ($rTotal1[0]['total'] != '') ? $rTotal1[0]['total'] : 0;
        return $total;
    }

    public function totalPaxBus() {
        $reserv_bus = $_SESSION['reserv_bus'];
        $totalBus = array();
        $buses = $_SESSION['buses'];
        foreach ($buses as $b) {
            $totalBus[$b['id_bus']] = 0;
        }
        foreach ($reserv_bus as $key => $e) {
            $r_bus = $e;
            foreach ($r_bus as $r) {
                if (!isset($totalBus[$key])) {
                    $totalBus[$key] = 0;
                }
                $totalBus[$key] = $totalBus[$key] + $r['totalPax'];
            }
        }
        return $totalBus;
    }

    public function save_luggage() {

        Doo::loadHelper('DooPager');
        if (!isset($_POST["trip"])) {
            if (!isset($this->params['trip'])) {
                $trip = "100";
            } else {
                $trip = $this->params['trip'];
            }
        } else {
            $trip = $_POST["trip"];
        }
        if (!isset($_POST["fecha_ini"])) {
            if (!isset($this->params['fecha_ini'])) {
                $fecha = date('m-d-Y');
            } else {
                $fecha = $this->params['fecha_ini'];
            }
        } else {
            $fecha = $_POST["fecha_ini"];
        }
        list($mes, $dia, $anyo) = explode("-", $fecha);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        $fe = $mes . "-" . $dia . "-" . $anyo;
        $total = $this->totalReservas($trip, $fecha);
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/trips/passengers/$trip/$fe/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        /*
          //Buscamos la reservas
          $reservas = $_SESSION['reservas'];
          foreach ($reservas as $e) {
          if (isset($_POST['equipaje_' . $e['id']])) {
          $equipaje = $_POST['equipaje_' . $e['id']];
          if ($e['tipo'] == 'I') {
          $sql = "UPDATE  `reservas` SET  `luggage1` =  ? WHERE  `reservas`.`id` = ? ";
          } else {
          $sql = "UPDATE  `reservas` SET  `luggage2` =  ? WHERE  `reservas`.`id` = ? ";
          }
          $rs = Doo::db()->query($sql, array($equipaje, $e['id']));
          }
          } */
        try {

            Doo::db()->beginTransaction();

            foreach ($_POST["pagos"] as $key => $pago) {
                list($nombre, $id_reserva, $servicio) = explode('_', $key);
                $tipo_pago = $_POST[$id_reserva . "_" . $servicio];
                if ($servicio == "TRANSP") {
                    print($id_reserva);
                    exit;
                    //$this->pagos_transpor($id_reserva, $pago, $tipo_pago);
                } else {
                    $this->pagos_tours($id_reserva, $pago, $servicio, $tipo_pago);
                }
            }
            Doo::db()->commit();
        } catch (Exception $exc) {
            Doo::db()->rollBack();
        }

        return Doo::conf()->APP_URL . "admin/trips/passengers/$trip/$fe";
    }

    public function pagos_transpor($id_reserva, $pago, $tipo_pago) {
        Doo::loadModel("Reserve_Pago");
        $pagor_r = new Reserve_Pago();
        $pagor_r->id_reserva = $id_reserva;
        $pagor_r->pago = "COLLECT ON BOARD";
        $pagor_r->tipo_pago = $tipo_pago;
        $pagor_r->pagado = $pago/* ($reserve->otheramount == 0) ? $reserve->totaltotal : $reserve->otheramount */;
        $pagor_r->usuario = $_SESSION['login']->id;
        $pagor_r->fecha = date('Y-m-d H:s');
        
        print($id_reserva);
        exit;
//        if ($pago > 0) {
//            Doo::db()->insert($pagor_r);
//        }
    }

    public function pagos_tours($id_reserva, $pago, $tipo, $tipo_pago) {
        Doo::loadModel("Tours_Pago");        
        $pagor_t = new Tours_Pago();
        
        print("queso");
        exit();
        $pagor_t->id_tours = $id_reserva;
        $pagor_t->pago = "COLLECT ON BOARD";
        $pagor_t->tipo_pago = $tipo_pago;
        $pagor_t->tipo = $tipo;
        $pagor_t->pagado = $pago; /* ($tours->otheramount == 0) ? $tours->totalouta : $tours->otheramount; */
        $pagor_t->usuario = $_SESSION['login']->id;
        $pagor_t->fecha = date('Y-m-d H:s');

        if ($pago > 0) {
            Doo::db()->insert($pagor_t);
        }
    }

    public function passengers_bus_one() {

        if (!isset($_POST["trip"])) {
            if (!isset($this->params['trip'])) {
                $trip = "0";
            } else {
                $trip = $this->params['trip'];
            }
        } else {
            $trip = $_POST["trip"];
        }

        if (!isset($_POST["direction"])) {
            if (!isset($this->params['direction'])) {
                $dir = 1;
            } else {
                $dir = $this->params['direction'];
            }
        } else {
            $dir = $_POST["direction"];
        }

        if (!isset($_POST["fecha_ini"])) {
            if (!isset($this->params['fecha_ini'])) {
                $fecha = date('m-d-Y');
            } else {
                $fecha = $this->params['fecha_ini'];
            }
        } else {
            $fecha = $_POST["fecha_ini"];
        }
        list($mes, $dia, $anyo) = explode("-", $fecha);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        $dir = $trip[2];
        if (!isset($_SESSION['asignacion'])) {
            $_SESSION['asignacion'] = array();
        }
        $asignacion = $_SESSION['asignacion'];

        $reservas = $this->reservasXArea($trip, $fecha, $dir);
        $_SESSION['total_areas'] = count($reservas);
        $r_to_from = $this->reservasFromTo($trip, $fecha, $reservas);
        $_SESSION['r_to_from'] = $r_to_from;
        $total = $this->totalReservas($trip, $fecha);
        $totalPax = $this->totalPasajeros($trip, $fecha);
        $_SESSION['totalPax'] = $totalPax;
        $buses = $this->buses($trip, $fecha);
        $_SESSION['buses'] = $buses;
        $this->busesAreas($r_to_from); // Mirar el estado de cada area con respecto a las reservas de from.
        $area_to_from = $_SESSION['area_to_from'];
        $bus_to_from = $_SESSION['bus_to_from'];
        $bus_area = $_SESSION['bus_area'];

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['reservas'] = $reservas;
        $this->data['r_to_from'] = $r_to_from;
        $this->data['area_to_from'] = $area_to_from;
        $this->data['bus_to_from'] = $bus_to_from;
        $this->data['bus_area'] = $bus_area;
        $this->data['asignacion'] = $asignacion;
        $this->data['buses'] = $buses;
        $this->data['total'] = $total;
        $this->data['totalPax'] = $totalPax;
        $this->data['fecha'] = $fecha;
        $this->data['msg_areas'] = $this->opcionGuarda_Areasr();
        $this->data['trip'] = $trip;
        $this->data['content'] = 'configuracion/passengers_bus.php';
        $this->renderc('admin/index', $this->data, true);
    }

    public function busesAreas($r_to_from) {
        $asignacion = $_SESSION['asignacion'];
        $buses = $_SESSION['buses'];
        $bus_to_from = array();
        $area_to_from = array();
        $bus_area = array();
        foreach ($r_to_from as $to => $array) {
            if (isset($asignacion[$to])) {
                $tt = count($array);
                $cont = 0;
                foreach ($array as $from => $val) {
                    if (isset($asignacion[$to][$from])) {
                        $cont++;
                        $bus_to_from[$to][$from] = $asignacion[$to][$from];
                        $bus_area[$asignacion[$to][$from]][$to] = 1;
                    }
                }
                $area_to_from[$to] = $tt - $cont;
            } else {
                $area_to_from[$to] = count($array);
            }
        }
        //exit();
        $_SESSION['area_to_from'] = $area_to_from;
        $_SESSION['bus_to_from'] = $bus_to_from;
        $_SESSION['bus_area'] = $bus_area;
    }

    public function reservasXArea($trip, $fecha, $dir) {
        $reservas = array();
        // Buscamos las de ida
        if ($trip % 2 == 0) {
            $condicion_uno = "tot";
            $condicion_dos = "tot2";
        } else {
            $condicion_uno = "fromt";
            $condicion_dos = "fromt2";
        }
        $sql = "SELECT tot,
                    SUM(totalpax) AS totalpax,
                    SUM(total) AS total,
                    para
             FROM (
                     (SELECT r.$condicion_uno AS tot,
                             (SUM(pax) + SUM(pax2)) AS totalpax,
                             COUNT(r.tot) AS total,
                             ob.nombre AS para
                      FROM reservas r
                      LEFT JOIN areas ob ON (r.$condicion_uno = ob.id)
                      WHERE (trip_no = ?
                             AND fecha_salida = ?) and estado != 'CANCELED' and estado != 'NOT SHOW W/ CHARGE' and estado != 'NOT SHOW W/O CHARGE' and estado != 'QUOTE'
                      GROUP BY (r.$condicion_uno))
                   UNION
                     (SELECT r.$condicion_dos AS tot,
                             (SUM(pax) + SUM(pax2)) AS totalpax,
                             COUNT(r.tot2) AS total,
                             ob.nombre AS para
                      FROM reservas r
                      LEFT JOIN areas ob ON (r.$condicion_dos = ob.id)
                      WHERE (trip_no2 = ?
                             AND fecha_retorno = ?) and estado != 'CANCELED' and estado != 'NOT SHOW W/ CHARGE' and estado != 'NOT SHOW W/O CHARGE' and estado != 'QUOTE'
                      GROUP BY (r.$condicion_dos))) AS A
                GROUP BY para";



        $rs = Doo::db()->query($sql, array($trip, $fecha, $trip, $fecha));
        $reservas1 = $rs->fetchAll();


        foreach ($reservas1 as $val) {
            $reservas[] = $val;
        }
//        print_r(Doo::db()->showSQL());
//        exit;
//        //Buscamos las de Regreso
//        $sql = "SELECT  r.tot2 as tot, (SUM(pax) + SUM(pax2)) as totalpax, count(r.tot2 ) as total, ob.nombre as para
//						FROM reservas r
//							left join areas ob on (r.tot2 =  ob.id) 
//						Where (trip_no2 = ? AND  fecha_retorno = ?)
//						GROUP BY (r.tot2) ORDER BY ob.id DESC";
//        $rs = Doo::db()->query($sql, array($trip, $fecha));
//        $reservas2 = $rs->fetchAll();
//        foreach ($reservas2 as $val) {
//            $reservas[] = $val;
//        }
//       print_r(Doo::db()->showSQL());
//       exit;
        return $reservas;
    }

    public function reservasFromTo($trip, $fecha, $r_tot) {
        $from_to = array();
        // Buscamos las de ida
        if ($trip % 2 == 0) {
            $condicion_1 = "tot";
            $condicion_1_1 = "fromt";

            $condicion_2_1 = "tot2";
            $condicion_2_2 = "fromt2";
        } else {
            $condicion_1 = "fromt";
            $condicion_1_1 = "tot";

            $condicion_2_1 = "fromt2";
            $condicion_2_2 = "tot2";
        }
        $sql = "SELECT r.id as reserva,r.$condicion_1 as tot,
		       r.$condicion_1_1 as fromt,
                       (pax + pax2) AS totalpax,
		       ob.nombre AS de,firsname AS nombre1, lasname AS nombre2
		FROM reservas r
		LEFT JOIN areas ob ON (r.fromt = ob.id)
		WHERE (trip_no = ?
		       AND fecha_salida = ? and r.estado != 'NOT SHOW W/O CHARGE' and r.estado != 'NOT SHOW W/ CHARGE' and r.estado != 'QUOTE' and r.estado != 'CANCELED')
		ORDER BY ob.id DESC";
        $rs = Doo::db()->query($sql, array($trip, $fecha));
        $from_to_ida = $rs->fetchAll();

        // Buscamos las de regreso
        $sql = "SELECT r.id as reserva,r.$condicion_2_1 AS tot,
		       r.$condicion_2_2 AS fromt,
		       (pax + pax2) AS totalpax,
		       ob.nombre AS de,firsname AS nombre1, lasname AS nombre2
		FROM reservas r
		LEFT JOIN areas ob ON (r.fromt2 = ob.id)
		WHERE (trip_no2 = ?
		       AND fecha_retorno = ? and r.estado != 'NOT SHOW W/O CHARGE' and r.estado != 'NOT SHOW W/ CHARGE' and r.estado != 'QUOTE' and r.estado != 'CANCELED')		
		ORDER BY ob.id DESC";
        $rs = Doo::db()->query($sql, array($trip, $fecha));
        $from_to_return = $rs->fetchAll();
        $from_to = array_merge($from_to_ida, $from_to_return);
        $r_from_to = array();
        foreach ($r_tot as $to) {
            $array = array();
            foreach ($from_to as $val) {

                if ($val['tot'] == $to['tot']) {

                    $array[$val['fromt']][] = $val;
                }
            }
            $r_from_to[$to['tot']] = $array;
        }
//         echo "<br><br>";
//        print_r($from_to);
//        echo "<br><br>";
//        print_r($r_from_to);
//        exit;
        return $r_from_to;
    }

    public function buses($trip, $fecha) {
        $sql = "SELECT bt.`id_bus`, bt.`id_trips` , b.`plate`, b.`tipobus`, b.`capacidad`, b.`fecha_ini`, b.`fecha_fin`
				FROM `bus_trips` bt 
					LEFT JOIN bus b on (bt.id_bus = b.id)
					LEFT JOIN trips t on (bt.id_trips = t.id)
				WHERE t.trip_no	 = ? AND  b.`fecha_ini`<= ? AND  b.`fecha_fin` >= ? ";
        $rs = Doo::db()->query($sql, array($trip, strtotime($fecha), strtotime($fecha)));
        $buses = $rs->fetchAll();
        return $buses;
    }

    public function reserves_bus_area_add() {
        if (isset($this->params['area']) && isset($this->params['bus'])) {
            $area = $this->params['area'];
            $axu = substr_count($area, '-');

            $bus = $this->params['bus'];
//            echo $axu;
            if ($axu > 0) {
                $this->reserves_bus_fromt_to_add($area, $bus);
            } else {
                $asignacion = $_SESSION['asignacion'];
                $r_to_from = $_SESSION['r_to_from'];
                $array = $r_to_from[$area];

                foreach ($array as $v) {
                    $from = ($v['fromt'] == "" ? 0 : $v['fromt']);
                    //echo $asignacion[$area][$from]."<br>";
//                    if (!isset($asignacion[$area][$from])) {                   
                    $asignacion[$area][$from] = $bus;
                    echo "<script>meter_bus2($area,$from,0,$bus,1,0,0,0);</script>";
//                    }
                }
                $_SESSION['asignacion'] = $asignacion;
                $this->opcionGuarda_Areasr();
                $msg_area = $this->opcionGuarda_Areasr();
                echo "<script>document.getElementById('opcionGuardar').value = '$msg_area'</script>";
            }
        }
    }

    public function reserves_bus_fromt_to_add($area, $bus) {
        list($from, $tot, $id_reserva) = explode('-', $area);

        $asignacion = $_SESSION['asignacion'];
        $bus_viejo = isset($asignacion[$tot][$from]) ? $asignacion[$tot][$from] : 0;
        $asignacion[$tot][$id_reserva] = $bus;
        $_SESSION['asignacion'] = $asignacion;
//        print_r($_SESSION['asignacion']);
        $cont = 0;
        $cont_bv = 0;
        $ver = 1;
        $ocupadas = 0;
        foreach ($asignacion[$tot] as $va) {
            $ocupadas++;
            if ($bus == $va) {
                $cont++;
            }
            if ($bus_viejo == $va) {
                $cont_bv++;
            }
        }
//        if ($cont > 1) {
//            $ver = 0;
//        }
        if ($cont_bv != 0) {// para que no lo oculte
            $bus_viejo = 0;
        }

        $r_to_from = $_SESSION['r_to_from'];
        $iniciales = count($r_to_from[$tot]);
        $nrt = 1/* $iniciales - $ocupadas */; ///numero de areas inicales
        echo "<script>meter_bus2($tot,$from,$id_reserva,$bus,$ver,$nrt,$bus_viejo,1);</script>";
    }

    public function reserves_bus_area_dell() {

        if (isset($this->params['area']) && substr_count($this->params['area'], '-')) {

            list($from, $tot, $id_reserva) = explode('-', $this->params['area']);
            $asignacion = $_SESSION['asignacion'];
            $cont = 0;

//            print_r($asignacion);
//            echo "<br><br>";

            if (isset($asignacion[$tot][$id_reserva])) {
                $bus = $asignacion[$tot][$id_reserva];
                unset($asignacion[$tot][$id_reserva]);
//                print_r($asignacion);
//                 echo "<br><br>";
                $_SESSION['asignacion'] = $asignacion;
                foreach ($asignacion[$tot] as $va) {
                    if ($bus == $va) {
                        $cont++;
                    }
                }
                echo "<script>sacar_bus($tot,$from,$id_reserva,$bus,$cont);</script>";
                $msg_area = $this->opcionGuarda_Areasr();
                echo "<script>document.getElementById('opcionGuardar').value = '$msg_area'</script>";
            }
        }
    }

    public function opcionGuarda_Areasr() {
        $asignacion = $_SESSION['asignacion'];
        $asgin_areas = count($asignacion);
        $total_areas = $_SESSION['total_areas'];
        if ($asgin_areas == $total_areas) {
            $msg_areas = '';
        } else {
            $msg_areas = ''/* 'You must put all the areas in a bus available' */;
        }
        return $msg_areas;
    }

    public function reserves_bus_area_save() {
        Doo::loadModel("Passengers_Bus");
        Doo::loadModel("Reserve");
        Doo::loadModel("Tours");
        Doo::loadModel("Onetour");

        
        
        $asignacion = $_SESSION['asignacion'];
        $asgin_areas = count($asignacion);
        $total_areas = $_SESSION['total_areas'];
        
        

        
        if (/* $asgin_areas == $total_areas && */ isset($_POST["trip"]) && isset($_POST["fecha"])) {
        //if (isset($_POST["trip"]) && isset($_POST["fecha"]) && isset($_POST["conductor"])) {
            $trip = $_POST["trip"];
            $fecha = $_POST["fecha"];
            $conductor1 = $_POST['conductor1'];
            $conductor2 = $_POST['conductor2'];
            $conductor3 = $_POST['conductor3'];
            $conductor4 = $_POST['conductor4'];
            $conductor5 = $_POST['conductor5'];
            
            
//            print($conductor2);
//            exit();
//            
            $fec_ini = $_POST['fecini'];
            $reservas = $_SESSION['reservas'];
            
            $reservas = $this->orderMultiDimensionalArray($reservas, 'firsname');
            $reserv_bus = array();
            $aux = array();
            //print_r($asignacion);
            if ($trip % 2 == 0) {
                $miami_orlando = 'tot';
            } else {
                $miami_orlando = 'fromt';
            }
            foreach ($reservas as $e) {
                $bus = $asignacion[$e[$miami_orlando]][$e['id']];
                $pb = new Passengers_Bus();
                $re = new reserve();
                $one = new Onetour();
                $multi = new Tours();
                
                $reservatab = $e['id'];
                $pb->id_reservas = $e['id'];
                $pb->trip = $trip;            
                $e['bus'] = $bus;
                $reserv_bus[$bus][] = $e;
                $result = Doo::db()->find($pb, array("limit", 1));
                if (empty($result)) {
                    $pb->id = NULL;
                    $pb->id_bus = $bus;
                    
                    if($bus == 0){
                        $pb->driver =  '';
                        $pb->driver2 = '';
                        $pb->driver3 = '';
                        $pb->driver4 = '';
                        $pb->driver5 = '';
                    }else{
                        $pb->driver =  $conductor1;
                        $pb->driver2 = $conductor2;
                        $pb->driver3 = $conductor3;
                        $pb->driver4 = $conductor4;
                        $pb->driver5 = $conductor5;
                    }
                    $pb->fec_ini = $fec_ini;
                   
                    Doo::db()->insert($pb);
                    Doo::db()->query("UPDATE reservas SET  id_bus='$bus' WHERE id='$reservatab'");
                    Doo::db()->query("UPDATE tours SET  id_bus='$bus' WHERE id_reserva='$reservatab'");
                    Doo::db()->query("UPDATE tours_oneday SET  id_bus='$bus' WHERE id_reserva='$reservatab'");
                    
                    
                    
                } else {
                    $pb = new Passengers_Bus($result [0]);
                    $pb->id_bus = $bus;
                    if($bus == 0){
                        $pb->driver =  '';
                        $pb->driver2 = '';
                        $pb->driver3 = '';
                        $pb->driver4 = '';
                        $pb->driver5 = '';
                    }else{
                        $pb->driver =  $conductor1;
                        $pb->driver2 = $conductor2;
                        $pb->driver3 = $conductor3;
                        $pb->driver4 = $conductor4;
                        $pb->driver5 = $conductor5;
                    }
                    $pb->fec_ini = $fec_ini;
                    
                    Doo::db()->update($pb);
                    Doo::db()->query("UPDATE reservas SET  id_bus='$bus' WHERE id='$reservatab'");
                    Doo::db()->query("UPDATE tours SET  id_bus='$bus' WHERE id_reserva='$reservatab'");
                    Doo::db()->query("UPDATE tours_oneday SET  id_bus='$bus' WHERE id_reserva='$reservatab'");
                }

                $aux[] = $e;
            }
            //exit;
            $reservas = $aux;
            $_SESSION['reservas'] = $reservas;
            $_SESSION['reserv_bus'] = $reserv_bus;
            return Doo::conf()->APP_URL . "admin/trips/passengers/bus-two";
        }
    }

    public function passengers_bus_two() {
        Doo::loadHelper('DooPager');
        $reservas = $_SESSION['reservas'];


        //$conductor = $this->params['conductor'];

        $trip = $reservas[0]['trip_no'];
        $fecha = $reservas[0]['fecha'];
        $reservas = $this->reservas($trip, $fecha);

        $aux = array();
        $buses = $this->buses($trip, $fecha);
        $_SESSION['buses'] = $buses;
        $cancel = -1;
        if (!isset($_SESSION['asignacion'])) {
            $cancel = -2;
        }

        //INICIO
        $reservas = $this->orderMultiDimensionalArray($reservas, 'firsname');
        $reserv_bus = array();
        foreach ($reservas as $e) {
            $reserv_bus[$e['bus']][] = $e;
        }
        $_SESSION['reserv_bus'] = $reserv_bus;
        //FIN

        $total = $this->totalReservas($trip, $fecha);

        $totalPaxBus = $this->totalPaxBus();
        $msg_buses = $this->validarBuses();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/passengers_bus_2.php';
        $this->data['trip'] = $trip;
        $this->data['fecha'] = $fecha;
        $this->data['totalPaxBus'] = $totalPaxBus;
        $this->data['msg_buses'] = $msg_buses;
        $this->data['reservas'] = $reservas;
        $this->data['buses'] = $buses;
        $this->data['total'] = $total;
        $this->data['cancel'] = $cancel;
        $this->renderc('admin/index', $this->data, true);
    }

    public function reserves_bus_add() {
        if (isset($this->params['bus']) && isset($this->params['r_string'])) {
            $bus = $this->params['bus'];
            $r_string = $this->params['r_string'];
            $r_pasar = explode("-", $r_string);

            if (!empty($r_pasar)) {
                $this->pasarReservas($bus, $r_pasar);
                $this->validarBuses();
            } else {
                echo "<script>alert('Choose stocks you want to change buses');</script>";
            }
        } else {
            echo "<script>alert('Ups. Failed bus assignment. Update page');</script>";
        }
    }

    public function pasarReservas($bus, $r_pasar) {
        $reserv_bus = array();
        $reservas = $_SESSION['reservas'];
        $aux = array();
        $bus_viejo = '';
        foreach ($reservas as $e) {
            foreach ($r_pasar as $id) {
                if ($e['id'] == $id) {
                    $bus_viejo = $e['bus'];
                    $e['bus'] = $bus;
                }
            }
            $aux[] = $e;
            $reserv_bus[$e['bus']][] = $e;
            echo "<script>document.getElementById('r_'+" . $e['id'] . ").value = 0;</script>";
        }
        $reservas = $aux;
        $_SESSION['reservas'] = $reservas;
        $_SESSION['reserv_bus'] = $reserv_bus;
        $this->mostrarReservas($bus);
        echo '<script>bg_tr("' . $bus_viejo . '");
			bg_tr("' . $bus . '");
		</script>';
        $this->allotted();
    }

    public function allotted() {
        $totalPax = $this->totalPaxBus();
        foreach ($totalPax as $key => $e) {
            echo "<script>$('#allotted'+" . $key . ").html('" . $e . "');</script>";
        }
    }

    public function mostrarReservas($bus) {
        $reserv_bus = $_SESSION['reserv_bus'];
        $i = 0;
        foreach ($reserv_bus[$bus] as $e) {
            echo '<script>cambiar("' . $e['id'] . '", "' . $bus . '");</script>';
        }
    }

    public function ordernar_bus() {
        if (isset($this->params['bus']) && isset($this->params['c_order'])) {
            $bus = $this->params['bus'];
            $c_order = $this->params['c_order'];
            $invertir = $this->params['invertir'];
            $r_bus = $_SESSION['reserv_bus'][$bus];
            $r_bus = $this->orderMultiDimensionalArray($r_bus, $c_order, $invertir);
            $_SESSION['reserv_bus'][$bus] = $r_bus;
            $this->mostrarReservas($bus);
            echo '<script>bg_tr("' . $bus . '");</script>';
        }
    }

    public function reserves_bus_save() {
        $buses = $_SESSION['buses'];
        $msg_buses = $this->validarBuses();
        if ($msg_buses == '') {
            Doo::loadModel("Passengers_Bus");
            $reservas = $_SESSION['reservas'];
            foreach ($reservas as $e) {
                $pb = new Passengers_Bus();
                $pb->id_reservas = $e['id'];
                $pb->id_bus = $e['bus'];
                $pb->trip = $e['trip_no'];
                $result = Doo::db()->find($pb, array("limit", 1));
                if (empty($result)) {
                    $pb->id = NULL;
                    Doo::db()->insert($pb);
                } else {
                    $pb = new Passengers_Bus($result[0]);
                    $pb->id_bus = $e['bus'];
                    Doo::db()->update($pb);
                }
            }
            print_r(Doo::db()->showSQL());
            exit;
            return Doo::conf()->APP_URL . "admin/trips/passengers/bus-two";
        } else {
            echo '<script>alert("' . $msg_buses . '");</script>';
        }
    }

    public function validarBuses() {
        $buses = $_SESSION['buses'];
        $reserv_bus = $_SESSION['reserv_bus'];
        $mensaje = '';
        foreach ($buses as $e) {
            $abordo = $this->totalPaxBus();
            if ($abordo[$e['id_bus']] > $e['capacidad']) {
                $mensaje .= '- It has exceeded the capacity of the bus ' . $e['plate'] . '-' . $e['tipobus'] . '    ';
            }
        }
        "<script>document.getElementById('opcionGuardar').value = '" . trim($mensaje) . "';</script>";
        return $mensaje;
    }

    public function pdf() {

                
        if (isset($this->params['bus']) && isset($this->params['trip']) && isset($this->params['fecha']) && isset($this->params['order'])) {
            $bus = $this->params['bus'];
            $trip = $this->params['trip'];
            $fecha = $this->params['fecha'];
            $conductor_bus = $this->params['conductor'];
            //quitamos la cadena %20 y la reemplazamos por espacios en blanco
            $conductor1 = str_replace("%20"," ",$conductor_bus);
            $conductor = strtoupper($conductor1);
            $torder = $this->params['order'];
            $agency = $this->params['agency'];

            if ($agency == 0) {
                $agency = 1;
                $tipo_p = 1;
            } else if ($agency == 1) {
                $agency = 0;
                $tipo_p = 0;
            }

            $reservas = $this->reservas($trip, $fecha);
            if ($torder == 1) {
                $cOrder = 'pickup_index';
            } else {
                $cOrder = 'dropoff_index';
            }
            $dir = $trip[strlen($trip) - 1];
            if ($dir == 0) {
                $txtdir = 'MCO/MIA';
                // $reservas = $this->orderMultiDimensionalArray($reservas, $cOrder , false);
            } else {
                $txtdir = 'MIA/MCO';
                // $reservas = $this->orderMultiDimensionalArray($reservas, $cOrder, true);
            }
            Doo::loadModel("Bus");
            $trans_bus = new Bus();
            $trans_bus->id = $bus;

            $trans_bus = Doo::db()->find($trans_bus, array("limit", 1));
            $trans_bus = $trans_bus[0];
            $page = "<head>
                
<title>Documento sin titulo</title>
<style type='text/css'>
#clearTable {
    width:80%;
    font-size: 13px;
    font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd3 {
    font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd2 {
    font-size: 20px;
}
#clearTable tr td p {
    text-align: center;
}

#content #center-column #tdgris {
    background-color: #F0F0F0;
}
#content #center-column #tdrojo {
    background-color: #FFE6E6;
}
#content #center-column1 #titletd {
    background-color: #F5EDEB;
    padding-left: 5px;
    font-size: 12px;
}
 #titlett {
    background-color: #E8E8E8;
    padding-left: 5px;
    font-size: 12px;
}
 #titlell {
    padding-left: 5px;
    font-size: 12px;
    border-bottom-width: 1px;
    border-left-width: 1px;
    border-bottom-style: solid;
    border-left-style: solid;
    border-bottom-color: #E6E6E6;
    border-left-color: #E6E6E6;
}
#titlelp {
    padding-left: 5px;
    font-size: 12px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #E6E6E6;
}
 #titlelr {
    padding-left: 5px;
    font-size: 12px;
    border-top-width: 1px;
    border-top-style: solid;
    border-top-color: #CE0000;
    color: #CE0000;
}
 #tdgristable {
    background-color: #FFF;
    padding-left: 5px;
}

.grid2 {
    border-collapse:collapse;
    border: thin solid #CCCCCC;
    border-spacing: 1px;
    background-color: #fcfbf2;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    color: #0A439A;
}

.grid2 td {
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:11px;
    color:#000;
    height:20px;
    border: 1px solid white;
	
}


.trInicial {
    text-align: center;
    background: #FFFFFF;
    color: #0B55C4;
    border-bottom: 1px solid white;
    border-left: 1px solid white;
    font-weight: bold;
    height:20px;
    font-size:12px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #666666;
		
}

.grid2 thead th:hover {
    cursor:pointer;
    background-color: #ffd;

}

.tdCuerpo {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: bold;
    color: #000000;
    background-color: #EABB00;
    text-align: left;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
    height: 30px;
	
}

.row0 {
    background-color:#FFF;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #000000;
    text-align: left;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
    height: 30px;
	
}


.row1 {
    background-color:#FFF;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #000000;
    text-align: left;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
    height: 30px;
	
}

.row0:hover td,
.row1:hover td  {
    background-color: #ffd;
    cursor:pointer;
	
}

.grid2 tr.selected{
    background-color:#09F;
    cursor:pointer;
}
#lista, #lista th, #lista td {
    border-bottom: 1px solid black;
    border-collapse: collapse;
}

</style>

</head><div align='center'>
<!--<br />-->
<table   id='clearTable'  style='margin-left:-12px;'  > 
    <tr>
        <td align='left' style='width:200px; position:relative;' rowspan='2' height='33' id='titletd3'><img src='https://www.supertours.com/cabecera.png'  style='width: 499%; height: 205%; margin-left: 0px; margin-top: -40px;' /></td>

    </tr>
    <tr> 
               
        <!--<td style='width:500px; font-size:11px; ' valign='top' align='right' >
        <b>" . trim(date('M-d-Y g:i a')) . "</b>-->
            
    </tr>
    
    <tr >
        
            
	<td style='position:absolute;' top='1' height='35'  id='titletd4' valign='top'>
		<strong>PASSENGER LIST, Trip :&nbsp;" . $trip . '  ' . $txtdir . ' ' . date('M-d-Y', strtotime($fecha)) . '&nbsp;&nbsp;&nbsp;&nbsp;  <font style="color: #0f0096;">Driver:</font> &nbsp; <font style="color: red;">'. $conductor .'</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <font style="width:524px; color: black; text-align:right;">' . trim(date('M-d-Y g:i a')) . "</font></strong> 
		<br /><strong>Bus: " . $trans_bus->plate . ', ' . $trans_bus->tipobus . "</strong>
                
	</td>    
        
        
        
           
    </tr>";
            $page .='</table><table style="margin-left:-12px; width: 100%; " id="lista"><thead>';
            $page .= '  
                            <tr class="trInicial">
                                <th style="width:8px; color:#0f0096;" >No.</th>
                                <th style="width:130px; color:#0f0096;">PICK</th>
                                <th style="width:10px; color:#0f0096;">ROOM</th>
                                <th style="width:100px; color:#0f0096;">PAX NAME</th>
                                <th style="width:60px; color:#0f0096;">PHONE</th>
                                <th style="width:60px; color:#0f0096;" >TOTAL PAX</th>
                                ' . ($agency == 1 ? "<th style='width:80px; color:#0f0096;'>AGENCY</th>" : "") . '
                                <th  style="width:130px; color:#0f0096;">DROP</th>
                                <th  style="width:30px; color:#0f0096;">TOUR</th>
                                <th  style="width:70px; color:#0f0096;">COLLECT</th>
                                ' . ($tipo_p == 1 ? "<th  style='width:60px; color:#0f0096;'>PAYMENT</th>" : "") . '
                                <!--<th  style="width:60px; color:#0f0096;">COMMENTS</th>-->
                             </tr></thead>
                        ';
            $cont = 0;
            $total = 0;
            $totalPax = 0;
            $page .= '<tbody>';
            $contador = 0;
            $total_adult = 0;
            $total_child = 0;
            foreach ($reservas as $resv) {

//                if ($resv['type_tour'] == 'MULTI' || $resv['type_tour'] == 'ONE') {
//                    $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?  ";
//                    $rs = Doo::db()->query($sql, array($resv['id_tours'], $resv['type_tour']));
//                    $pagado = $rs->fetch();
//
//                    $sql2 = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ? and tipo_pago = 'COLLECT ON BOARD' ";
//                    $rs2 = Doo::db()->query($sql2, array($resv['id_tours'], $resv['type_tour']));
//                    $collectado_consult = $rs2->fetch();
//                } else {
//                    $sql = "select sum(pagado) as total from reservas_pago where id_reserva = ? ";
//                    $rs = Doo::db()->query($sql, array($resv['id']));
//                    $pagado = $rs->fetch();
//
//                    $sql2 = "select sum(pagado) as total from reservas_pago where id_reserva = ? and tipo_pago = 'COLLECT ON BOARD'";
//                    $rs2 = Doo::db()->query($sql2, array($resv['id']));
//                    $collectado_consult = $rs2->fetch();
//                }
//                

                if ($resv['type_tour'] == 'ONE') {

                    $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?";
                    $rs = Doo::db()->query($sql, array($resv['id_tours'], $resv['type_tour']));
                    $pagado = $rs->fetch();

                    $sql2 = "select passenger_balance_due as collect from tours_oneday where id = ?";
                    $rs2 = Doo::db()->query($sql2, array($resv['id_tours']));
                    $pagado2 = $rs2->fetch();
                    
                    $sql3 = "select passenger_balance_due as CREDITCARD from tours_oneday where id = ? AND (op_pago='3' OR op_pago='8') AND id_bus='$bus'";
                    $rs3 = Doo::db()->query($sql3, array($resv['id_tours']));
                    $result = $rs3->fetch();
                    $CCO = $CCO + $result['CREDITCARD'];
                    
                    $sql4 = "select passenger_balance_due as CASH from tours_oneday where id = ? AND op_pago='4' AND id_bus='$bus'";
                    $rs4 = Doo::db()->query($sql4, array($resv['id_tours']));
                    $result2 = $rs4->fetch();
                    $CSHO = $CSHO + $result2['CASH'];

                    $sql5 = "select passenger_balance_due as CHEQUE from tours_oneday where id = ? AND op_pago='9' AND id_bus='$bus'";
                    $rs5 = Doo::db()->query($sql5, array($resv['id_tours']));
                    $result3 = $rs5->fetch();
                    $CHKO = $CHKO + $result3['CHEQUE'];

                }else if ($resv['type_tour'] == 'MULTI') {


                    $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?";
                    $rs = Doo::db()->query($sql, array($resv['id_tours'], $resv['type_tour']));
                    $pagado = $rs->fetch();

                    //habilitar cuando esten listas las cajas de multiday

                    $sql2 = "select passenger_balance_due as collect, total_charge from tours where id = ?";
                    $rs2 = Doo::db()->query($sql2, array($resv['id_tours']));
                    $pagado2 = $rs2->fetch();
                    $totalcargos = $pagado2['total_charge'];
                    
                    $sql3 = "select passenger_balance_due as CREDITCARD from tours where id = ? AND (op_pago='3' OR op_pago='8') AND id_bus='$bus'";
                    $rs3 = Doo::db()->query($sql3, array($resv['id_tours']));
                    $result = $rs3->fetch();
                    $CCM = $CCM + $result['CREDITCARD'];
                    
                    $sql4 = "select passenger_balance_due as CASH from tours where id = ? AND op_pago='4' AND id_bus='$bus'";
                    $rs4 = Doo::db()->query($sql4, array($resv['id_tours']));
                    $result2 = $rs4->fetch();
                    $CSHM = $CSHM + $result2['CASH'];

                    $sql5 = "select passenger_balance_due as CHEQUE from tours where id = ? AND op_pago='9' AND id_bus='$bus'";
                    $rs5 = Doo::db()->query($sql5, array($resv['id_tours']));
                    $result3 = $rs5->fetch();
                    $CHKM = $CHKM + $result3['CHEQUE'];
                    
                    
                } else {

                    $sql = "select sum(pagado) as total from reservas_pago where id_reserva = ?";
                    $rs = Doo::db()->query($sql, array($resv['id']));
                    $pagado = $rs->fetch();

                    $sql2 = "select passenger_balance_due as collect from reservas where id = ?";
                    $rs2 = Doo::db()->query($sql2, array($resv['id']));
                    $pagado2 = $rs2->fetch();

                    $sql3 = "select passenger_balance_due as CREDITCARD from reservas where id = ? AND (op_pago='3' OR op_pago='8') AND id_bus>'0' AND id_bus='$bus'";
                    $rs3 = Doo::db()->query($sql3, array($resv['id']));
                    $result = $rs3->fetch();
                    $CC = $CC + $result['CREDITCARD'];
                    
                    $sql4 = "select passenger_balance_due as CASH from reservas where id = ? AND op_pago='4' AND id_bus='$bus'";
                    $rs4 = Doo::db()->query($sql4, array($resv['id']));
                    $result2 = $rs4->fetch();
                    $CSH = $CSH + $result2['CASH'];

                    $sql5 = "select passenger_balance_due as CHEQUE from reservas where id = ? AND op_pago='9' AND id_bus='$bus'";
                    $rs5 = Doo::db()->query($sql5, array($resv['id']));
                    $result3 = $rs5->fetch();
                    $CHK = $CHK + $result3['CHEQUE'];
                    
                  
                }
                //TOTAL (CREDIT CARD)
                $CCTOT = $CC + $CCO + $CCM;
                //TOTAL (CASH)
                $CSHTOT = $CSH + $CSHO + $CSHM;                
                //TOTAL (CHECK)
                $CHKTOT = $CHK + $CHKO + $CHKM;
//                print($CHKTOT);
//                exit();
                
                $var = explode('-', $resv['pago']);
                if ($resv["tipo_pago"] == "COMPLEMENTARY") {
                    $pagado["total"] = 0;
                    $collectado_consult['total'] = 0;
                    $resv['totaltotal'] = 0;
                }
                if ($resv["tipo_pago"] == "VOUCHER") {
                    $pagado["total"] = 0;
                    $collectado_consult['total'] = 0;
                    $resv['totaltotal'] = 0;
                }

                if ($var[0] == "5") {
                    $pagado["total"] = 0;
                    $collectado_consult['total'] = 0;
                    $resv['totaltotal'] = 0;
                }

                $dato_pago = $resv['tipo_pago'];
                if ($bus == $resv['bus']) {

                    if ($resv['otheramount'] > 0) {
                        $valor_total = $resv['otheramount'];
                    } else {
                        $valor_total = $resv['totaltotal'];
                    }
                    if ($resv["tipo_pago"] == "COMPLEMENTARY") {
                        $valor_total = 0;
                    }
                    if ($resv["tipo_pago"] == "VOUCHER") {
                        $valor_total = 0;
                    }

                    if ($var[0] == "5") {
                        $valor_total = 0;
                    }
                    //$colectar = $valor_total - $pagado["total"];

                    $colectar = $pagado2['collect'];

                    if ($resv['type_tour'] == 'MULTI' || $resv['type_tour'] == 'ONE') {
                        $tour = $resv['type_tour'];
                    } else {
                        $tour = $txtdir;
                    }
                    $totalPax += $resv['pax'] + $resv['pax2'];
                    $total += $colectar;                    
                    $activar_chulo = 0;
                    if ($colectar > 0 && $collectado_consult["total"] > 0) {
                        $resta_pred_collect = ($colectar - $collectado_consult["total"]);

                        if ($resta_pred_collect <= 0) {
                            $activar_chulo = 1;
                        }
                    }
                    if ($var[0] == "1" || $var[0] == "2" || $var[0] == "6" || $var[0] == "10") {
                        $tipo_pago = "PRE-PAID";
                    } else if ($var[0] == "3") {
                        $tipo_pago = "CREDIT CARD 4% FEE";
                    } else if ($var[0] == "4") {
                        $tipo_pago = "CASH";
                    } else if ($var[0] == "5") {
                        $tipo_pago = "CREDIT VOUCHER";
                    } else if ($var[0] == "7") {
                        $tipo_pago = "COMPLEMENTARY";
                    } else if ($var[0] == "8") {
                        $tipo_pago = "CREDIT CARD NO FEE";
                    } else if ($var[0] == "9") {
                        $tipo_pago = "CHECK";
                    } else {
                        $tipo_pago = strtoupper($var[0]);
                    }



//                    $op = array("1" => array("PRED-PAID" => "CREDIT CARD WITH FEE"),
//                        "2" => array("PRED-PAID" => 'CREDIT CARD NO FEE'),
//                        "3" => array("COLLECT ON BOARD" => "CREDIT CARD WITH FEE"),
//                        "4" => array("COLLECT ON BOARD" => "CASH"),
//                        "5" => array("VOUCHER" => "CREDIT VOUCHER"),
//                        "6" => array("PRED-PAID" => "CASH"),
//                        "7" => array("FREE SERVICES" => "COMPLEMENTARY"),
//                        "8" => array("COLLECT ON BOARD" => "CREDIT CARD NO FEE"),
//                        "9" => array("COLLECT ON BOARD" => "CHECK"),
//                        "10" => array("PRED-PAID" => "CHECK")
//                    );
                    $contador++;
                    $page .= '<tr class="row' . ($cont % 2) . '" colspan="2">';
                    $page .= '<td style="width:15px;" >' . $resv['codconf'] . '<br> <strong>' . $contador . '</strong></td>';
                    if ($resv['nomExten1'] != "") {
                        $page .= '<td style="width:130px ; font-size:13px;" >' . $resv['nomExten1'] . " <br><span style='font-size:10px;'> (" . $resv['extension1'] . ")</span>" . '</td>';
                    } else {
                        $page .= '<td style="width:130px ; font-size:13px;" >' . $resv['pickup'] . '<br><span style="font-size:10px;">(' . $resv['address_pickup'] . ')</span></td>';
                    }
                    $lastname = iconv('UTF-8', 'ISO-8859-1', $resv['lasname']);
                    $page .= '<td style="width:10px;" align="center">' . $resv['room'] . '</td>';
                    $page .= '<td style="width:100px; font-size:13px;">' . ucwords(strtolower(trim($lastname)) . " " . ucwords(strtolower($resv['firsname']))) . '</td>';
                    $page .= '<td style="width:50px; font-size:10px;">' . trim($resv['phone']) . '</td>';
                    $page .= '<td style="width:60px; font-size:13px;" align="center" >' . ($resv['pax'] + $resv['pax2']) . '</td>';
                    if ($agency == 1) {
                        $page .= '<td style="width:80px; font-size:10px;"  >' . trim($resv['company_name']) . '</td>';
                    }

                    if ($resv['nomExten2'] != "") {
                        $page .= '<td style="width:130px ; font-size:13px;" >' . $resv['nomExten2'] . " <br><span style='font-size:10px;'>(" . $resv['extension2'] . ")</span>" . '</td>';
                    } else {
                        $page .= '<td style="width:130px ; font-size:13px;" >' . $resv['dropoff'] . '<br><span style="font-size:10px;">(' . $resv['address_dropoff'] . ')</span></td>';
                    }
                    //text-decoration:line-through;
                    $page .= '<td style="width:40px;  font-size:10px;" align="center">' . trim($tour) . '</td>';
                    $page .= '<td style="width:60px; font-size:13px;' . ($activar_chulo == 1 ? "" : "") . '" >&nbsp;  $ ' . number_format(trim($colectar), 2) . '</td>';
                    if ($tipo_p == 1) {
                        $page .= '<td style="width:50px; font-size:8px;" >' . trim($tipo_pago) . '</td>';
                    }
                    $page .= '<!--<td style="width:70px; font-size:8px;" >' . trim($resv['comentarios']) . '</td>-->';
                    $page .= '</tr>';
                    $cont++;
                }
                if ($resv['pax2'] != 0) {
                    //echo $tour ." - ".$resv['id']."<br>";
                }
                $total_adult += $resv['pax'];
                $total_child += $resv['pax2'];
            }


            $page .= "</td></tr>";


            if ($tipo_pago == "CREDIT CARD NO FEE" || $tipo_pago == "CREDIT CARD WITH FEE" || $tipo_pago == "CASH" || $tipo_pago == "CHECK") {
                
                //CASH
                if($CSHTOT == 0){
                

                }else{
                    
                    $page .= '<tr class="trInicial">
                      <th  >&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th >&nbsp;</th>
                      <th style="font-size:14px;"></th>
                      <th>&nbsp;</th>
                      ' . ($agency == 1 ? "<th  >&nbsp;</th>" : "") . '
                      <th style="width:170px; text-align:right; color:#000; " >CASH:&nbsp;&nbsp;&nbsp;</th>
                      <th style="text-align:left; font-size:14px; color:#000; " >&nbsp;&nbsp;$ ' . number_format($CSHTOT, 2, '.', '.') . '</th>
                       ' . ($tipo_p == 1 ? "<th  >&nbsp;</th>" : "") . '
                </tr>';
                    
                }

                //CREDIT CARD WITH FEE OR CREDIT CARD NO FEE
                if($CCTOT == 0){
                

                }else{
                $page .= '<tr class="trInicial">
		  <th  >&nbsp;</th>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
                  <th>&nbsp;</th>
		  <th >&nbsp;</th>
		  <th style="font-size:14px;"></th>
		  <th>&nbsp;</th>
                  ' . ($agency == 1 ? "<th  >&nbsp;</th>" : "") . '
		  <th style="width:170px; text-align:right;  color:#000;" >CREDIT CARD:&nbsp;&nbsp;&nbsp;</th>
		  <th style="text-align:left; font-size:14px; ; color:#000;" >&nbsp;&nbsp;$ ' . number_format($CCTOT, 2, '.', '.') . '</th>
                   ' . ($tipo_p == 1 ? "<th  >&nbsp;</th>" : "") . '
            </tr>';

                }

                //CHECK
                if($CHKTOT == 0){
                

                }else{
                        $page .= '<tr class="trInicial">
                          <th  >&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th >&nbsp;</th>
                          <th style="font-size:14px;"></th>
                          <th>&nbsp;</th>
                          ' . ($agency == 1 ? "<th  >&nbsp;</th>" : "") . '
                          <th style="width:170px; text-align:right;  color:#000;" >CHECK:&nbsp;&nbsp;&nbsp;</th>
                          <th style="text-align:left; font-size:14px;  color:#000;" >&nbsp;&nbsp;$ ' . number_format($CHKTOT, 2, '.', '.') . '</th>
                           ' . ($tipo_p == 1 ? "<th  >&nbsp;</th>" : "") . '
                    </tr>';
                    }
            }
            
            $page .= '<tr class="trInicial">
		  <th  >&nbsp;</th>
		  <th></th>
		  <th>&nbsp;</th>
                  <th>&nbsp;</th>
		  <th >&nbsp;</th>
		  <th style="font-size:14px; color:#000;">' . $totalPax . '</th>
		  <th>&nbsp;</th>
                  ' . ($agency == 1 ? "<th  >&nbsp;</th>" : "") . '
		  <th style="text-align:right; background:#FFF; color:#000;">TOTAL:&nbsp;&nbsp;&nbsp;</th>
		  <th style="text-align:left; font-size:14px; background:#FFF; color:#000;" >&nbsp;&nbsp;$ ' . number_format($total, 2, '.', '.') . '</th>
                   ' . ($tipo_p == 1 ? "<th  >&nbsp;</th>" : "") . '
            </tr>';


            $page .= '</tbody>';
            $page .= "</table>
	 
	 
	 
	 </div>
	 </html>";



            //echo $page;
            $codigoHTML = htmlentities($page);
            Doo::loadHelper("DooPDF");
            $nombre = $trip . " - " . $fecha;

            //echo $page;
            $pdf = new DooPDF($nombre, $page, false, 'letter', 'landscape');
            $pdf->doPDF();
        }
    }

}
