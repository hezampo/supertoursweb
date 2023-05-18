<?php

/**
 * MainController
 *
 */
Doo::loadController('I18nController');
Doo::loadController('RecaptController');
//Doo::loadHelper('DooMailer');
Doo::loadHelper('class.phpmailer');

class MainController extends DooController {

    static $variable;
    public $data;

    /* /FUNCIONES QUE CARGAN VISTAS PRINCIPALES */

    public function fleet() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/fleet-terminal-supertours', $this->data);
    }

    public function baggage() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('page/baggage', $this->data);
    }

    public function conditionsT() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('tours/terms-conditions-tours', $this->data);
    }

    public function policies() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('tours/cancellation-policies', $this->data);
    }

    public function goal() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/goal-supertours-of-orlando', $this->data);
    }

    public function free() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/free-onboard', $this->data);
    }

    public function charters() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/charters-miami-orlando', $this->data);
    }

    public function contact() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->renderc('page/contact-us-supertours', $this->data);
    }

    public function destinations() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('page/destinations-florida', $this->data);
    }

    public function tickets() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/tickets-policy-supertours', $this->data);
    }

    public function daytour() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/1-day-tour', $this->data);
    }

    public function hotel() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/hotel-month', $this->data);
    }

    public function multitours() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/multi-days-tours', $this->data);
    }

    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT id, nombre FROM  `areas` ORDER BY  `orden` ASC ";
        $rs = Doo::db()->query($sql);
        $areas = $rs->fetchAll();
        $this->data['areas'] = $areas;
        $this->renderc('home2', $this->data);
    }

    /*     * *************************************************** */

    /* PREGUNTA SI ERES RESIDENTE DE FLOIRIDA */

    public function areyou() {
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            //if (isset($_SESSION["booking"])) {

            $booking = $_SESSION["booking"];

            $from = $booking["fromt"];
            $to = $booking["tot"];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
            $pax = $booking["pax"];
            $chil = $booking["chil"];
        } else {
            if (isset($_POST["fromt"]) && isset($_POST["tot"])) {

                if (isset($_POST['pax2'])) {
                    $chil = $_POST['pax2'];
                    if ($_POST['pax2'] == "") {
                        $chil = 0;
                    }
                } else {
                    $chil = 0;
                }
                if (!isset($_POST)) {
                    return Doo::conf()->APP_URL;
                }
                $tipo_ticket = $_POST["tipo_ticket"];
                $from = $_POST["fromt"];
                $to = $_POST["tot"];
                $fecha_salida = $_POST["fecha_salida"];
                $fecha_retorno = $_POST["fecha_retorno"];
                $pax = $_POST["pax"];
            } else {
                return Doo::conf()->APP_URL;
            }
        }
        if (!isset($tipo_ticket)) {
            return Doo::conf()->APP_URL;
        }

        $booking = array(
            "tipo_ticket" => $tipo_ticket,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "pax" => $pax,
            "chil" => $chil
        );

        $_SESSION["booking"] = $booking;

        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($from),
            "limit" => 1));
        $from_name = $rs->nombre;

        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($to),
            "limit" => 1));
        $to_name = $rs->nombre;

        $this->data['from_name'] = $from_name;
        $this->data['to_name'] = $to_name;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        if (isset($_SESSION['data_agency'])) {
            return Doo::conf()->APP_URL . "booking/";
        } else {
            $this->renderc('questions', $this->data, true);
        }
    }

    /*     * ************************************************************************* */

    /* AGENDA O BOOKING DEL TICKET */

    public function booking() {
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_SESSION["booking"]) && (isset($_SESSION["booking"]["resident"]) || isset($_SESSION['data_agency']))) {

                $booking = $_SESSION["booking"];
                $tipo_ticket = $booking["tipo_ticket"];
                $from = $booking["fromt"];
                $to = $booking["tot"];
                $fecha_salida = $booking["fecha_salida"];
                $fecha_retorno = $booking["fecha_retorno"];
                $pax = $booking["pax"];
                $chil = $booking["chil"];
                $resident = isset($booking["resident"]) ? $booking["resident"] : "0";
                $zip = isset($booking["zip"]) ? $booking["zip"] : "0";
            } else {
                return Doo::conf()->APP_URL;
            }
        } else {
            if ((isset($_POST["pregun"]) && isset($_POST["zip1"])) || isset($_SESSION['data_agency'])) {
                $booking = $_SESSION["booking"];
                $tipo_ticket = $booking["tipo_ticket"];
                $from = $booking["fromt"];
                $to = $booking["tot"];
                $fecha_salida = $booking["fecha_salida"];
                $fecha_retorno = $booking["fecha_retorno"];
                $pax = $booking["pax"];
                $chil = $booking["chil"];
                $resident = isset($_POST["pregun"]) ? $_POST["pregun"] : "0";
                $zip = isset($_POST["zip1"]) ? $_POST["zip1"] : "0";
            } else {
                return Doo::conf()->APP_URL;
            }
        }

        $date = date("Y-m-d");
        list($mes, $dia, $anyo) = explode("-", $fecha_salida);
        $salida = $anyo . "-" . $mes . "-" . $dia;
        if ($fecha_retorno != "" && $fecha_retorno != "N/A") {
            list($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
            $retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }


        $hora = date("H:i");
        $hora2 = date("H:i");
        if (strtotime($date) != strtotime($salida)) {
            $hora = "";
        }
        if (isset($retorno)) {
            if (strtotime($date) != strtotime($retorno)) {
                $hora2 = "";
            }
        }
        //////////////////////////////////////////////// / *Ofertas*/ IDA

        if (!isset($_SESSION['data_agency'])) {
            $sqlofer = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente,                          t3.equipment
						FROM ofertas t1
							LEFT JOIN trips  t3 ON ( t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
						WHERE t1.trip_from = ? 
							AND t1.trip_to = ?
							AND t1.fecha_ini <= ? 
							AND t1.fecha_fin >= ? order by t1.trip_no asc) 
							";
            $rsofer = Doo::db()->query($sqlofer, array($from, $to, strtotime($salida), strtotime($salida)));
            $ofertas = $rsofer->fetchAll();
            foreach ($ofertas as $key => $value) {
                $_SESSION["ofertaida"][$key] = $value;
            }

            //////////////////////////////////////////////// /* Cierre de ofertas */    IDA
            //////////////////////////////////////////////// / *Ofertas*/ Return

            $sqlofer2 = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente, t3.equipment
                         FROM ofertas t1
						 	LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
                         WHERE t1.trip_from = ? 
						 	AND t1.trip_to = ?
							AND t1.fecha_ini <= ? 
							AND t1.fecha_fin >= ?)";

            if (isset($retorno)) {
                $rsofer2 = Doo::db()->query($sqlofer2, array($to, $from, strtotime($retorno), strtotime($retorno)));
                $ofertas2 = $rsofer2->fetchAll();
                foreach ($ofertas2 as $key => $value) {
                    $_SESSION["ofertaretur"] = $value;
                }
            }
        } else {
            $ofertas = "";
            $ofertas2 = "";
        }

        //////////////////////////////////////////////// /* Cierre de ofertas */    Return

        $sql = "select t1.trip_no, t2.id, t1.fecha, t4.nombre as trip_from, t5.nombre as trip_to, t2.price, t2.price2, t2.price3, t2.price4, t2.trip_departure, t2.trip_arrival, t3.equipment, t1.estado
			FROM programacion t1
				left join routes t2 on (t1.trip_no = t2.trip_no)
				left join trips  t3 on (t1.trip_no = t3.trip_no)
				left join areas  t4 on (t2.trip_from = t4.id)
				left join areas  t5 on  (t2.trip_to  = t5.id)
			WHERE t2.type_rate = '$dat->type_rate'  
				AND t2.trip_from = ? 
				AND t2.trip_to = ? 
				AND fecha = ? 
				AND t2.trip_departure > '$hora' 
				AND t1.estado = '1' 
				AND t2.anno='$anyo' 
			ORDER BY t2.trip_departure ASC";

        if ($net_rate) {
            $sql_net = "SELECT t1.trip_no, t2.id, t1.fecha, t4.nombre as trip_from, t5.nombre as trip_to, t2.price, t2.price2, t2.price3, t2.price4, t2.trip_departure, t2.trip_arrival, t3.equipment, t1.estado
                     FROM programacion t1
					 	left join routes_net t2 on (t1.trip_no = t2.trip_no)
						left join trips  t3 on (t1.trip_no = t3.trip_no)
						left join areas  t4 on (t2.trip_from = t4.id)
						left join areas  t5 on  (t2.trip_to  = t5.id)
					WHERE t2.type_rate = 2 
						AND t2.id_agency = '$dat->id'  
						AND t2.trip_from = ? 
						AND t2.trip_to = ? 
						AND fecha = ? 
						AND t2.trip_departure > '$hora' 
						AND t1.estado = '1' 
						AND t2.anno='$anyo' ORDER BY t2.trip_departure ASC";

            $sql = "Select 
ms.trip_no, ms.id, ms.fecha, ms.trip_from, ms.trip_to,

CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price 
       ELSE ms.price
   END as price ,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price2 
       ELSE ms.price2
   END as price2,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price3 
       ELSE ms.price3
   END as price3,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price4 
       ELSE ms.price4
   END as price4,
ms.trip_departure, ms.trip_arrival, ms.equipment, ms.estado
 From ( " . $sql . " )as ms LEFT JOIN ( " . $sql_net . " ) as k ON (ms.trip_no = k.trip_no)";
            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida, $from, $to, $fecha_salida));
        } else {
            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));
        }
        $salida = $rs->fetchAll();
        $row_array = array();
        $resul_array = array();
        $lista_trip = array();
        ///////////////////////////////////////////////////// */ Igualar Ofertas */
        if (!empty($ofertas)) {
            foreach ($ofertas as $key1 => $value1) {
                foreach ($salida as $key2 => $value) {
                    list($mes, $dia, $anyo) = explode("-", $value["fecha"]);
                    $fechaarray = array();
                    $fechaarray = $anyo . "-" . $mes . "-" . $dia;

                    if (($value["trip_no"] == $value1["trip_no"]) && strtotime($fechaarray) >= $value1["fecha_ini"] && strtotime($fechaarray) <= $value1["fecha_fin"]) {

                        $value = array(
                            "trip_no" => $value1["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array[$key2] = $value;
                        $lista_trip[$key2] = $value1["trip_no"];
                    } else if (($value1["trip_no"] == '') && strtotime($fechaarray) >= $value1["fecha_ini"] && strtotime($fechaarray) <= $value1["fecha_fin"]) {

                        $value = array(
                            "trip_no" => $value["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array[$key2] = $value;
                        $lista_trip[$key2] = $value1["trip_no"];
                    } else {
                        $sino = true;
                        foreach ($ofertas as $valu_n_trip) {
                            if ($valu_n_trip["trip_no"] == $value["trip_no"]) {
                                $sino = false;
                                break;
                            }
                        }
                        if ($sino == true) {
                            $row_array[$key2] = $value;
                        }
                    }
                }
            }
        } else {
            foreach ($salida as $key => $value) {
                $row_array[$key] = $value;
            }
        }

        ///////////////////////////////////////////////////// */ Cierre de Igualar Ofertas */
        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($from),
            "limit" => 1));
        $from_name = $rs->nombre;
        $retorno = array();
        if ($tipo_ticket == "roundtrip") {
            $sql2 = "select
						t1.trip_no,
						t2.id,
						t1.fecha, 
						t4.nombre as trip_from, 
						t5.nombre as trip_to, 
						t2.price, 
						t2.price2,
						t2.price3,
						t2.price4,  
						t2.trip_departure, 
						t2.trip_arrival,
						t3.equipment,
					    t1.estado
			 FROM programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
		         where t2.type_rate = '$dat->type_rate'  AND t2.trip_from = ? AND t2.trip_to = ? and fecha = ?  AND t2.trip_departure > '$hora2' and t1.estado = '1' AND t2.anno='$anyo' ORDER BY t2.trip_departure ASC ";

            /*             * ************************************ */
            if ($net_rate) {
                $sql_net1 = "select
					  t1.trip_no,
					  t2.id,
					  t1.fecha, 
					  t4.nombre as trip_from, 
					  t5.nombre as trip_to, 
					  t2.price, 
					  t2.price2,
					  t2.price3,
					  t2.price4,  
					  t2.trip_departure, 
					  t2.trip_arrival,
					  t3.equipment,
					 t1.estado
			 from programacion t1
                         left join routes_net t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
		         where t2.type_rate = 2 and t2.id_agency = '$dat->id' AND t2.trip_from = ? AND t2.trip_to = ? and fecha = ?  AND t2.trip_departure > '$hora2' and t1.estado = '1' AND t2.anno='$anyo' ORDER BY t2.trip_departure ASC ";


                $sql2 = "Select
ms.trip_no, ms.id, ms.fecha, ms.trip_from, ms.trip_to,

CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price 
       ELSE ms.price
   END as price ,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price2 
       ELSE ms.price2
   END as price2,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price3 
       ELSE ms.price3
   END as price3,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price4 
       ELSE ms.price4
   END as price4,
ms.trip_departure, ms.trip_arrival, ms.equipment, ms.estado
 From ( " . $sql2 . " )as ms  LEft JOIN ( " . $sql_net1 . " ) as k ON (ms.trip_no = k.trip_no)";
                $rs = Doo::db()->query($sql2, array($to, $from, $fecha_retorno, $to, $from, $fecha_retorno));
            } else {
                $rs = Doo::db()->query($sql2, array($to, $from, $fecha_retorno));
            }

            /*             * ******************************************************** */


            // $rs = Doo::db()->query($sql2, array($to, $from, $fecha_retorno));
            $retorno = $rs->fetchAll();
            $rs = Doo::db()->find("Areas", array("select" => "nombre",
                "where" => "id = ?",
                "param" => array($to),
                "limit" => 1));
            $to_name = $rs->nombre;
        }


        if ($tipo_ticket == "oneway") {
            if ($net_rate) {
                $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno, $to, $from, $fecha_retorno));
            } else {
                $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
            }
            $retorno = $rs->fetchAll();
            $rs = Doo::db()->find("Areas", array("select" => "nombre",
                "where" => "id = ?",
                "param" => array($to),
                "limit" => 1));
            $to_name = $rs->nombre;
        }
        $row_array2 = array();
        $lista_trip = array();
        $contador = 0;
        ///////////////////////////////////////////////////// */ Igualar Ofertas2 */
        if (!empty($ofertas2)) {
            foreach ($ofertas2 as $key2 => $value1) {
                foreach ($retorno as $key => $value) {
                    list($mes, $dia, $anyo) = explode("-", $value["fecha"]);
                    $fechaarray2 = array();
                    $fechaarray2 = $anyo . "-" . $mes . "-" . $dia;
                    if (($value["trip_no"] == $value1["trip_no"]) && strtotime($fechaarray2) >= $value1["fecha_ini"] && strtotime($fechaarray2) <= $value1["fecha_fin"]) {
//                        echo $value["trip_no"]." - ". $value1["trip_no"]."<br>";
                        $value = array(
                            "trip_no" => $value["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array2[$key] = $value;
                        $lista_trip[$contador++] = $value1["trip_no"];
                    } else if (($value1["trip_no"] == "") && strtotime($fechaarray2) >= $value1["fecha_ini"] && strtotime($fechaarray2) <= $value1["fecha_fin"]) {
                        $value = array(
                            "trip_no" => $value["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array2[$key] = $value;
                        $lista_trip[$contador++] = $value1["trip_no"];
                    } else {
                        $sino = true;
                        foreach ($ofertas2 as $valu_n_trip) {
                            if ($valu_n_trip["trip_no"] == $value["trip_no"]) {
                                $sino = false;
                                break;
                            }
                        }
                        if ($sino == true) {
                            $row_array2[$key] = $value;
                        }
                    }
                }
            }
        } else {

            foreach ($retorno as $key => $value) {
                $row_array2[$key] = $value;
            }
        }
     //print_r($row_array2);
//        exit;
        ///////////////////////////////////////////////////// */Cierre de Igualar Ofertas2*/


        $booking = array(
            "tipo_ticket" => $tipo_ticket,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "pax" => $pax,
            "chil" => $chil,
            "resident" => $resident,
            "zip" => $zip
        );

        // Disponibilidad
        list($mes, $dia, $anyo) = explode("-", $fecha_salida);
        $salida = $anyo . "-" . $mes . "-" . $dia;
        if ($fecha_retorno != "" && $fecha_retorno != "N/A") {
            list($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
            $retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }
        //IDA
        $i = 0;
        $aux = array();
        foreach ($row_array as $key => $value1) {
            $disponible = $this->disponible($value1['trip_no'], $salida);
            if ($disponible > 0) {
                $value1["disponible"] = $disponible;
                $aux[$i] = $value1;
            }
            $i++;
        }
        $row_array = $aux;

        //RETORNO
        $i = 0;
        $aux = array();
        foreach ($row_array2 as $key => $value1) {
            $disponible = $this->disponible($value1['trip_no'], $retorno);
            if ($disponible > 0) {
                $value1["disponible"] = $disponible;
                $aux[$i] = $value1;
            }
            $i++;
        }
        $row_array2 = $aux;

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['salida'] = $row_array;
        $this->data['retorno'] = $row_array2;
        $this->data['from_name'] = $from_name;
        $this->data['to_name'] = $to_name;

        $_SESSION["booking"] = $booking;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('booking', $this->data, true);
    }

    //        $sqlC = "SELECT DISTINCT r.seats_remain AS cupos FROM routes r
//                    LEFT JOIN trips t ON(r.trip_no = t.trip_no)
//                    WHERE t.trip_no= '100' AND r.fecha_ini ='2017-04-28';
//					WHERE t.trip_no= ?";
    public function disponible($trip_no, $fecha) {
                  
        //tipo = 1 -> De Ida
        //tipo = 2 -> De Retorno
        // Disponibilidad
        
                
        if($trip_no == 301){
            
        
        //echo "301";
            
        $trip301 = 301;
                        
        $sqlrtp301 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '$trip301' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
        $rsrtp301 = Doo::db()->query($sqlrtp301);
        $puestosocupados301 = $rsrtp301->fetchAll();    

        foreach ($puestosocupados301 as $po301){

            $puestos_ocupados301 = $po301['CANTIDAD'];
        }
        
                    
        $sqlcap_301 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip_no' ";
        $rscap_301 = Doo::db()->query($sqlcap_301);
        $capac_301 = $rscap_301->fetchAll();


        foreach ($capac_301 as $cap301) {

        }

        $capacidad1_301 = $cap301['capacity'];
        $capacidad2_301 = $cap301['capacity2'];
        $capacidad3_301 = $cap301['capacity3'];
        $capacidad4_301 = $cap301['capacity4'];
        $capacidad5_301 = $cap301['capacity5'];

        $capacidad301 = $capacidad1_301 + $capacidad2_301 + $capacidad3_301 + $capacidad4_301 + $capacidad5_301;
        
        if ($capacidad301 == 0) {// No esta disponible
            return 0;
        }
        
        $sql_stdida = "SELECT (sum(pax) + sum(pax2))as tari_std
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida = Doo::db()->query($sql_stdida, array($trip_no, $fecha));
        $r_stdida = $rs_stdida->fetchAll();
        $std_seats_ida = $r_stdida[0]['tari_std'] ? $r_stdida[0]['tari_std'] : 0;



        $sql_stdretorno = "SELECT (sum(pax) + sum(pax2))as tari_std
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno = Doo::db()->query($sql_stdretorno, array($trip_no, $fecha));
        $r_stdretorno = $rs_stdretorno->fetchAll();
        $std_seats_retorno = $r_stdretorno[0]['tari_std'] ? $r_stdretorno[0]['tari_std'] : 0;

        $standard_total = $std_seats_ida + $std_seats_retorno;

        $sqlflexida = "SELECT (sum(pax) + sum(pax2))as tari_flex
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida = Doo::db()->query($sqlflexida, array($trip_no, $fecha));
        $r_flexida = $rsflexida->fetchAll();
        $superflex_seats_ida = $r_flexida[0]['tari_flex'] ? $r_flexida[0]['tari_flex'] : 0;

        $sqlflexretorno = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno = Doo::db()->query($sqlflexretorno, array($trip_no, $fecha));
        $r_flexretorno = $rsflexretorno->fetchAll();
        $superflex_seats_retorno = $r_flexretorno[0]['tari_flex'] ? $r_flexretorno[0]['tari_flex'] : 0;

        $superflex_total = $superflex_seats_ida + $superflex_seats_retorno;

        //TOURS////////////////////////////////////////////////////////////////////
        //De Ida
        $sqlTourIda = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                FROM  reservas 
                                Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsti = Doo::db()->query($sqlTourIda, array($trip_no, $fecha));
        $r_tida = $rsti->fetchAll();
        $ocupadas_tour_ida = $r_tida[0]['ocupadas_tour'] ? $r_tida[0]['ocupadas_tour'] : 0;



        //De Retorno
        $sqlTourReturn = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstr = Doo::db()->query($sqlTourReturn, array($trip_no, $fecha));
        $r_treturn = $rstr->fetchAll();
        $ocupadas_tour_return = $r_treturn[0]['ocupadas_tour'] ? $r_treturn[0]['ocupadas_tour'] : 0;


        $tours_total = $ocupadas_tour_ida + $ocupadas_tour_return;

        //print($ocupadas_tours);
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                FROM  reservas 
                                Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida = Doo::db()->query($sql_spcida, array($trip_no, $fecha));
        $r_spcida = $rs_spcida->fetchAll();
        $spc_seats_ida = $r_spcida[0]['tari_spc'] ? $r_spcida[0]['tari_spc'] : 0;



        $sql_spcretorno = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno = Doo::db()->query($sql_spcretorno, array($trip_no, $fecha));
        $r_spcretorno = $rs_spcretorno->fetchAll();
        $spc_seats_retorno = $r_spcretorno[0]['tari_spc'] ? $r_spcretorno[0]['tari_spc'] : 0;

        $special_total = $spc_seats_ida + $spc_seats_retorno;

        //webfare
        $sqlwebida = "SELECT (sum(pax) + sum(pax2))as webfare
            FROM  reservas 
            Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida = Doo::db()->query($sqlwebida, array($trip_no, $fecha));
        $r_webida = $rswebida->fetchAll();
        $webfare_ida = $r_webida[0]['webfare'] ? $r_webida[0]['webfare'] : 0;

        $sqlwebretorno = "SELECT (sum(pax) + sum(pax2))as webfare
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno = Doo::db()->query($sqlwebretorno, array($trip_no, $fecha));
        $r_webretorno = $rswebretorno->fetchAll();
        $webfare_retorno = $r_webretorno[0]['webfare'] ? $r_webretorno[0]['webfare'] : 0;

        $webfare_total = $webfare_ida + $webfare_retorno;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida = "SELECT (sum(pax) + sum(pax2))as spromo
            FROM  reservas 
            Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida = Doo::db()->query($sqlspromoida, array($trip_no, $fecha));
        $r_spromoida = $rsspromoida->fetchAll();
        $superpromo_ida = $r_spromoida[0]['spromo'] ? $r_spromoida[0]['spromo'] : 0;

        $sqlspromoretorno = "SELECT (sum(pax) + sum(pax2))as spromo
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno = Doo::db()->query($sqlspromoretorno, array($trip_no, $fecha));
        $r_spromoretorno = $rsspromoretorno->fetchAll();
        $superpromo_retorno = $r_spromoretorno[0]['spromo'] ? $r_spromoretorno[0]['spromo'] : 0;

        $superpromo_total = $superpromo_ida + $superpromo_retorno;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida = "SELECT (sum(pax) + sum(pax2))as sdisc
            FROM  reservas 
            Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida = Doo::db()->query($sqlsdiscida, array($trip_no, $fecha));
        $r_discida = $rsdiscida->fetchAll();
        $superdisc_ida = $r_discida[0]['sdisc'] ? $r_discida[0]['sdisc'] : 0;

        $sqlsdiscretorno = "SELECT (sum(pax) + sum(pax2))as sdisc
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno = Doo::db()->query($sqlsdiscretorno, array($trip_no, $fecha));
        $r_discretorno = $rssdiscretorno->fetchAll();
        $superdisc_retorno = $r_discretorno[0]['sdisc'] ? $r_discretorno[0]['sdisc'] : 0;

        $superdiscount_total = $superdisc_ida + $superdisc_retorno;
        
        //lo vendido
        //$puestos_ocupados301 ----> puestos en uso

        $total_cupos1 = $standard_total + $superflex_total + $tours_total + $special_total + $webfare_total + $superpromo_total + $superdiscount_total;
        
        //$result = $capacidad - $ocupadas;
        
        $result = ($capacidad301 - $total_cupos1)-($puestos_ocupados301); 
        
        return $result; 
        
        }
        
        
        if($trip_no == 300){
        
        
        //echo "300"; 
            
        $trip300 = 300;
                        
        $sqlrtp300 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '$trip300' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
        $rsrtp300 = Doo::db()->query($sqlrtp300);
        $puestosocupados300 = $rsrtp300->fetchAll();    

        foreach ($puestosocupados300 as $po300){

            $puestos_ocupados300 = $po300['CANTIDAD'];
        }
        
            
        $sqlcap_300 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip_no' ";
        $rscap_300 = Doo::db()->query($sqlcap_300);
        $capac_300 = $rscap_300->fetchAll();


        foreach ($capac_300 as $cap300) {

        }

        $capacidad1_300 = $cap300['capacity'];
        $capacidad2_300 = $cap300['capacity2'];
        $capacidad3_300 = $cap300['capacity3'];
        $capacidad4_300 = $cap300['capacity4'];
        $capacidad5_300 = $cap300['capacity5'];

        $capacidad300 = $capacidad1_300 + $capacidad2_300 + $capacidad3_300 + $capacidad4_300 + $capacidad5_300;
        
        if ($capacidad300 == 0) {// No esta disponible
            return 0;
        }
        
        $sql_stdida = "SELECT (sum(pax) + sum(pax2))as tari_std
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida = Doo::db()->query($sql_stdida, array($trip_no, $fecha));
        $r_stdida = $rs_stdida->fetchAll();
        $std_seats_ida = $r_stdida[0]['tari_std'] ? $r_stdida[0]['tari_std'] : 0;



        $sql_stdretorno = "SELECT (sum(pax) + sum(pax2))as tari_std
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno = Doo::db()->query($sql_stdretorno, array($trip_no, $fecha));
        $r_stdretorno = $rs_stdretorno->fetchAll();
        $std_seats_retorno = $r_stdretorno[0]['tari_std'] ? $r_stdretorno[0]['tari_std'] : 0;

        $standard_total = $std_seats_ida + $std_seats_retorno;

        $sqlflexida = "SELECT (sum(pax) + sum(pax2))as tari_flex
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida = Doo::db()->query($sqlflexida, array($trip_no, $fecha));
        $r_flexida = $rsflexida->fetchAll();
        $superflex_seats_ida = $r_flexida[0]['tari_flex'] ? $r_flexida[0]['tari_flex'] : 0;

        $sqlflexretorno = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno = Doo::db()->query($sqlflexretorno, array($trip_no, $fecha));
        $r_flexretorno = $rsflexretorno->fetchAll();
        $superflex_seats_retorno = $r_flexretorno[0]['tari_flex'] ? $r_flexretorno[0]['tari_flex'] : 0;

        $superflex_total = $superflex_seats_ida + $superflex_seats_retorno;

        //TOURS////////////////////////////////////////////////////////////////////
        //De Ida
        $sqlTourIda = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                FROM  reservas 
                                Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsti = Doo::db()->query($sqlTourIda, array($trip_no, $fecha));
        $r_tida = $rsti->fetchAll();
        $ocupadas_tour_ida = $r_tida[0]['ocupadas_tour'] ? $r_tida[0]['ocupadas_tour'] : 0;



        //De Retorno
        $sqlTourReturn = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstr = Doo::db()->query($sqlTourReturn, array($trip_no, $fecha));
        $r_treturn = $rstr->fetchAll();
        $ocupadas_tour_return = $r_treturn[0]['ocupadas_tour'] ? $r_treturn[0]['ocupadas_tour'] : 0;


        $tours_total = $ocupadas_tour_ida + $ocupadas_tour_return;

        //print($ocupadas_tours);
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                FROM  reservas 
                                Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida = Doo::db()->query($sql_spcida, array($trip_no, $fecha));
        $r_spcida = $rs_spcida->fetchAll();
        $spc_seats_ida = $r_spcida[0]['tari_spc'] ? $r_spcida[0]['tari_spc'] : 0;



        $sql_spcretorno = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno = Doo::db()->query($sql_spcretorno, array($trip_no, $fecha));
        $r_spcretorno = $rs_spcretorno->fetchAll();
        $spc_seats_retorno = $r_spcretorno[0]['tari_spc'] ? $r_spcretorno[0]['tari_spc'] : 0;

        $special_total = $spc_seats_ida + $spc_seats_retorno;

        //webfare
        $sqlwebida = "SELECT (sum(pax) + sum(pax2))as webfare
            FROM  reservas 
            Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida = Doo::db()->query($sqlwebida, array($trip_no, $fecha));
        $r_webida = $rswebida->fetchAll();
        $webfare_ida = $r_webida[0]['webfare'] ? $r_webida[0]['webfare'] : 0;

        $sqlwebretorno = "SELECT (sum(pax) + sum(pax2))as webfare
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno = Doo::db()->query($sqlwebretorno, array($trip_no, $fecha));
        $r_webretorno = $rswebretorno->fetchAll();
        $webfare_retorno = $r_webretorno[0]['webfare'] ? $r_webretorno[0]['webfare'] : 0;

        $webfare_total = $webfare_ida + $webfare_retorno;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida = "SELECT (sum(pax) + sum(pax2))as spromo
            FROM  reservas 
            Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida = Doo::db()->query($sqlspromoida, array($trip_no, $fecha));
        $r_spromoida = $rsspromoida->fetchAll();
        $superpromo_ida = $r_spromoida[0]['spromo'] ? $r_spromoida[0]['spromo'] : 0;

        $sqlspromoretorno = "SELECT (sum(pax) + sum(pax2))as spromo
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno = Doo::db()->query($sqlspromoretorno, array($trip_no, $fecha));
        $r_spromoretorno = $rsspromoretorno->fetchAll();
        $superpromo_retorno = $r_spromoretorno[0]['spromo'] ? $r_spromoretorno[0]['spromo'] : 0;

        $superpromo_total = $superpromo_ida + $superpromo_retorno;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida = "SELECT (sum(pax) + sum(pax2))as sdisc
            FROM  reservas 
            Where trip_no = '$trip_no' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida = Doo::db()->query($sqlsdiscida, array($trip_no, $fecha));
        $r_discida = $rsdiscida->fetchAll();
        $superdisc_ida = $r_discida[0]['sdisc'] ? $r_discida[0]['sdisc'] : 0;

        $sqlsdiscretorno = "SELECT (sum(pax) + sum(pax2))as sdisc
                                FROM  reservas 
                                Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno = Doo::db()->query($sqlsdiscretorno, array($trip_no, $fecha));
        $r_discretorno = $rssdiscretorno->fetchAll();
        $superdisc_retorno = $r_discretorno[0]['sdisc'] ? $r_discretorno[0]['sdisc'] : 0;

        $superdiscount_total = $superdisc_ida + $superdisc_retorno;



        $total_cupos = $standard_total + $superflex_total + $tours_total + $special_total + $webfare_total + $superpromo_total + $superdiscount_total;
            
            
        //$result = $capacidad300 - $total_cupos;
        
        $result = ($capacidad300 - $total_cupos)-($puestos_ocupados300); 
        
        return $result;
        
                   
        }    
        
    }
 
    
    public function puestosEnUsados($trip_no, $fecha) {
        
        Doo::loadModel('Reservas_trip_puestos');
        $puestos = new Reservas_trip_puestos();
        $login = $_SESSION['login'];
        $sql = "SELECT id, trip_to, tipo,fecha_trip, cantidad, fecha_usado, usuario, estado FROM reservas_trip_puestos WHERE usuario != ? AND trip_to = ? AND fecha_trip = ? AND (estado='USING' OR estado='RENEWED') order by (id) DESC";
        $rs = Doo::db()->query($sql, array($login->id, $trip_no, $fecha));
        $aux = $rs->fetchAll();
        $ahora = date('Y-m-d H:i:s');
        $enUso = 0;
        foreach ($aux as $p) {
            $fe = $p['fecha_usado'];
            $segundos = strtotime($ahora) - strtotime($fe);
            $diferencia_dias = ($segundos / 60);
            if ($diferencia_dias < 6) {
                $enUso += $p['cantidad'];
            }
        }
        return $enUso;
    }
    
    public function ocuparPuesto() {
        ///:trip/:fecha/:cantidad/:opcion

        if (isset($this->params["trip"]) && isset($this->params["tipo"]) && isset($this->params["fecha"]) && isset($this->params["cantidad"]) && isset($this->params["opcion"])) {
            
            Doo::loadModel('Reservas_trip_puestos');
            $puestos = new Reservas_trip_puestos();
            $puestos->trip_to = $this->params["trip"];
            $puestos->fecha_trip = $this->params["fecha"];
            $puestos->cantidad = $this->params["cantidad"];
            $puestos->tipo = $this->params["tipo"];
            $login = $_SESSION['login'];
            $puestos->usuario = $login->id;
            /* Estados:
              1: USING: Puesto que acabo de ser usado por el usuario.
              2: RENEWED: Puesto q se estaba usando, pero se vencio el tiempo y volvio a renovarlo.
              3: RESERVED: Puesto que se estaba usando y se convirtio en una reserva.
              4: CANCELLED: Puesto que se estaba usando pero no se siguo con la reserva.
              5: SUSPENDED: Puesto que el usuario comenzo a usar pero lo perdio debido al tiempo.
             */
            $sql = "SELECT id, trip_to, tipo,fecha_trip, cantidad, fecha_usado, usuario, estado FROM reservas_trip_puestos WHERE usuario = ? AND tipo = ? AND (estado='USING' OR estado='RENEWED') order by (id) DESC";
            $rs = Doo::db()->query($sql, array($login->id, $this->params["tipo"]));
            $aux = $rs->fetchAll();
            if (!empty($aux)) {
                $fe = $aux[0]['fecha_usado'];
                $ahora = date('Y-m-d H:i:s');
                $segundos = strtotime($ahora) - strtotime($fe);
                $diferencia_dias = ($segundos / 60);
                if ($diferencia_dias > 5) {
                    $aux = array();
                }
            }
            $opcion = $this->params["opcion"];
            if (!empty($aux)) {
                switch ($opcion) {
                    case 1:
                        $estado = 'USING';
                        $puestos->fecha_usado = date('Y-m-d H:i:s');
                        break;
                    case 2:
                        $estado = 'RENEWED';
                        $puestos->fecha_usado = date('Y-m-d H:i:s');
                        break;
                    case 3:
                        $estado = 'RESERVED';
                        break;
                    case 4:
                        $estado = 'CANCELLED';
                        break;
                    case 5:
                        $estado = 'SUSPENDED';
                        break;
                }
                $puestos->id = $aux[0]['id'];
                $puestos->estado = $estado;
                echo '<script>
                                       
					var hilo02=setInterval("estadoTrip()",1000);
				</script>';
                Doo::db()->update($puestos);
            } else {
                $puestos->estado = 'USING';
                $puestos->fecha_usado = date('Y-m-d H:i:s');
                echo '<script>
                                        
					var hilo02=setInterval("estadoTrip()",1000);
				</script>';
                Doo::db()->insert($puestos);
            }
        }
    }
    
     public function actualiarPuestosUsuario($opcion) {
        $estado = 'SUSPENDED';
        switch ($opcion) {
            case 1:
                $estado = 'USING';
                break;
            case 2:
                $estado = 'RENEWED';
                break;
            case 3:
                $estado = 'RESERVED';
                break;
            case 4:
                $estado = 'CANCELLED';
                break;
            case 5:
                $estado = 'SUSPENDED';
                break;
        }
        $login = $_SESSION['login'];
        if ($opcion == 2) {
            $sql = 'UPDATE reservas_trip_puestos SET fecha_usado= ? , estado= ?
						WHERE usuario = ? AND (estado="USING" OR estado="RENEWED")';
            $rs = Doo::db()->query($sql, array(date('Y-m-d H:i:s'), $estado, $login->id));
        } else {
            $sql = 'UPDATE  reservas_trip_puestos SET  estado =  "' . $estado . '"
						WHERE usuario = ? AND (estado="USING" OR estado="RENEWED")';
            $rs = Doo::db()->query($sql, array($login->id));
        }
    }

    public function ocuparPuestoUsuario() {
        
        if (isset($this->params["opcion"])) {
            $opcion = $this->params["opcion"];
            $this->actualiarPuestosUsuario($opcion);
        }
        
    }
/*//////////////////////////////////////////////////////////////////////////////////*/

    /* FUNCION DE PICK UP Y DROP OP */

    public function pickupDropoff() {
        global $variable;
        Doo::loadModel("Agency");

        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
            $dat2 = new Agency();
            $dat2->id = $dat->id;
            $dato_exten_n = Doo::db()->getOne($dat2);
            if ($dato_exten_n->precio_especial_exten == 1) {
                $precio_sql = "precio_especial as precio";
            } else if ($net_rate) {
                $precio_sql = "precio_neto as precio";
            } else {
                $precio_sql = "precio";
            }
        } else {
            $dat = new Agency();
            $dat->id = -1;
            $net_rate = false;
            $dat->type_rate = 0;
            $precio_sql = "precio";
        }

        if (isset($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return Doo::conf()->APP_URL . "booking";
        }

        if (isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
        } else {
            return Doo::conf()->APP_URL;
        }

        $sql = "SELECT
                    t1.trip_no,
                    t1.fecha, 
                    t4.nombre AS trip_from, 
                    t5.nombre AS trip_to,
					t2.price,
					t2.price2,
					t2.price3,
					t2.price4,
					t2.trip_from as tf,
							t2.trip_to as tt,
							t2.trip_departure,
							t2.trip_arrival
							FROM programacion t1
							LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
							LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
							LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
							
							WHERE t2.id = ? AND fecha = ?";



        if ($net_rate) {
            $sql_net = "SELECT
                    t1.trip_no,
                    t1.fecha, 
                    t4.nombre AS trip_from, 
                    t5.nombre AS trip_to,
					t2.price,
					t2.price2,
					t2.price3,
					t2.price4,
					t2.trip_from as tf,
							t2.trip_to as tt,
							t2.trip_departure,
							t2.trip_arrival
							FROM programacion t1
							LEFT JOIN routes_net t2 ON (t1.trip_no = t2.trip_no)
							LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
							LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
					WHERE fecha = '" . $booking["fecha_salida"] . "' AND t2.type_rate = 2 and t2.id_agency = '$dat->id' ";


            $sql = "Select ms.trip_no, ms.fecha, ms.trip_from, ms.trip_to, ms.trip_to,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price 
       ELSE ms.price
   END as price ,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price2 
       ELSE ms.price2
   END as price2,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price3 
       ELSE ms.price3
   END as price3,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price4 
       ELSE ms.price4
   END as price4,

  ms.tf,ms.tt,ms.trip_departure,ms.trip_arrival
 From ( " . $sql . " )as ms  LEft JOIN ( " . $sql_net . " ) as k ON ((ms.trip_no = k.trip_no) and (k.trip_from = ms.trip_from) AND (ms.trip_to = k.trip_to)  )";
        }

        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $type_web = 1;
        } else {
            $type_web = 0;
        }

        if (isset($_POST["trip1"])) {

            $trip1 = $_POST["trip1"];

            $rs = Doo::db()->query($sql, array($trip1, $booking["fecha_salida"]));

            $salida = $rs->fetch();




            $rs = Doo::db()->query("select id, address, place as nombre,valid from pickup_dropoff where id_area = ? AND type_web = ? ORDER BY id ASC", array($salida["tf"], $type_web));

            $pickup1 = $rs->fetchAll();

            $rs2 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid 
											FROM extension 
			 where id_area = ? ORDER BY id ASC", array($salida["tf"]));

            $exten1 = $rs2->fetchAll();


            ///////////////////////////////////////////////////// */ Igualar Extension  pickup 1*/
            $pickupnew = array();
            $contador = 0;
            if (!empty($exten1)) {

                foreach ($exten1 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew[$key] = $value;
                    $contador++;
                }
                foreach ($pickup1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew[$contador] = $value;
                    $contador++;
                }
                
            } else {
                foreach ($pickup1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew[$key] = $value;
                }
            }



            ///////////////////////////////////////////////////// */ Cierre de Igualar extension */


            $rs = Doo::db()->query("select id, address, valid, place as nombre from pickup_dropoff 
			WHERE id_area = ? AND type_web = ? ORDER BY nombre ASC", array($salida["tt"], $type_web));
            $dropoff1 = $rs->fetchAll();

            $rs3 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid 
											FROM extension 
			 where id_area = ? ORDER BY id ASC", array($salida["tt"]));

            $exten2 = $rs3->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  dropoff 1 */
            $pickupnew2 = array();
            $contador = 0;

            if (!empty($exten2)) {

                foreach ($exten2 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew2[$key] = $value;
                    $contador++;
                }
                foreach ($dropoff1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$contador] = $value;
                    $contador++;
                }
                
            } else {
                foreach ($dropoff1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$key] = $value;
                }
            }
            if (!isset($_SESSION['data_agency'])) {
                list($mes, $dia, $anyo) = explode("-", $salida["fecha"]);
                $fecha = $anyo . "-" . $mes . "-" . $dia;
                ///////////////////////////////////////////////////// */ Cierre de Igualar extension */
                ///////////////////////////////////////////////////// */ Igualar Ofertas */
                $sqlofer = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente,                          t3.equipment
						FROM ofertas t1
							LEFT JOIN trips  t3 ON ( t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
						WHERE t1.trip_from = ? 
							AND t1.trip_to = ?
							AND t1.fecha_ini <= ? 
							AND t1.fecha_fin >= ?
							AND t1.trip_no = ?)";
                $rsofer = Doo::db()->query($sqlofer, array($salida["tf"], $salida["tt"], strtotime($fecha), strtotime($fecha), $salida["trip_no"]));
                $ofertas = $rsofer->fetch();
            } else {
                $ofertas = "";
            }

            $row_array = array();

            if (!empty($ofertas)) {

                list($mes, $dia, $anyo) = explode("-", $salida["fecha"]);


                $fechaarray = array();
                $fechaarray = $anyo . "-" . $mes . "-" . $dia;

                if ($salida["trip_no"] == $ofertas["trip_no"] && strtotime($fechaarray) >= $ofertas["fecha_ini"] && strtotime($fechaarray) <= $ofertas["fecha_fin"]) {

                    $value1 = array(
                        "trip_no" => $ofertas["trip_no"],
                        "trip_departure" => $salida["trip_departure"],
                        "trip_arrival" => $salida["trip_arrival"],
                        "price" => $ofertas["price"],
                        "price2" => $ofertas["price2"],
                        "price3" => $ofertas["price3"],
                        "price4" => $ofertas["price4"],
                        "oferta" => "1",
                        "fecha" => $salida["fecha"],
                        "trip_from" => $salida["trip_from"],
                        "trip_to" => $salida["trip_to"]
                    );

                    $row_array = $value1;
                } else {
                    $row_array = $salida;
                }


                // echo $row_array[""]."<br>";
            } else {
                foreach ($salida as $key => $value) {
                    $row_array[$key] = $value;
                }
            }

            ///////////////////////////////////////////////////// */ Cierre de Igualar Ofertas */
            /////////////////////////////////////////////////////// /*CAPACIDAD RUTA IDA*/


            $sqlcapa = "SELECT t1.id_bus,t1.id_trips,t2.capacidad,t3.trip_no,t2.fecha_fin,t2.fecha_ini
			   
									FROM bus_trips t1
																	
									LEFT JOIN bus t2 ON (t1.id_bus = t2.id) 
									LEFT JOIN trips t3 ON (t1.id_trips = t3.id)
										   
										WHERE t3.trip_no = ?  AND t2.fecha_ini <= ? AND t2.fecha_fin >= ?
                         ";


            list($mes, $dia, $anyo) = explode("-", $fecha_salida);

            $fechaida = $anyo . "-" . $mes . "-" . $dia;


            $rs = Doo::db()->query($sqlcapa, array($row_array['trip_no'], strtotime($fechaida), strtotime($fechaida)));


            $capacidad = $rs->fetchAll();

            $capacity = array();
            $total = 0;
            foreach ($capacidad as $key => $value) {
                $capacity[$key] = $value;
                $total = $total + $value['capacidad'];
            }

            $fecha_sali = $_SESSION['booking']['fecha_salida'];
            $demanda = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

            $rs = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
                "where" => "fecha_ini = ? AND trip_no = ?",
                "limit" => 1,
                "param" => array($fecha_sali, $row_array['trip_no'])
            ));
            $totaldispo = $rs->total;

            $disponible = ($total - $totaldispo );


            if (isset($disponible) && isset($demanda)) {
                if ($demanda > $disponible) {
                    $_SESSION['msg'] = array("error" => "error", "disponible" => $disponible, "demanda" => $demanda, "trip" => $row_array['trip_no']);
                    return Doo::conf()->APP_URL . "booking/";
                }
            }
            ////////////////////////////////////////////////////////////// /* CIERRE CAPACIDAD RUTA */ 
            $this->data['salida'] = $row_array;
            $this->data['pickup1'] = $pickupnew;
            $this->data['dropoff1'] = $pickupnew2;
            $e = $salida;
        }

        if (isset($_POST["trip2"])) {
            $trip2 = $_POST["trip2"];
            $rs = Doo::db()->query($sql, array($trip2, $booking["fecha_retorno"]));
            $retorno = $rs->fetch();

            $rs = Doo::db()->query("select id, address,valid,  place as nombre from pickup_dropoff 
			WHERE id_area = ? AND type_web = ? ORDER BY nombre ASC", array($retorno["tf"], $type_web));
            $pickup2 = $rs->fetchAll();

            $rs2 = Doo::db()->query("SELECT address, valid,place as nombre,id," . $precio_sql . ",valid 
											FROM extension 
			 where id_area = ? ORDER BY id ASC", array($retorno["tf"]));

            $exten2 = $rs2->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  pickup 2*/
            $pickupnew2 = array();
            $contador = 0;
            if (!empty($exten2)) {

                foreach ($exten2 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew2[$key] = $value;
                    $contador++;
                }
                foreach ($pickup2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$contador] = $value;
                    $contador++;
                }
                
            } else {
                foreach ($pickup2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$key] = $value;
                }
            }



            ///////////////////////////////////////////////////// */ Cierre de Igualar extension pickup2*/ 

            $rs = Doo::db()->query("select id, address, valid,  place as nombre from pickup_dropoff 
				WHERE id_area = ? AND type_web = ?  ORDER BY id ASC", array($retorno["tt"], $type_web));
            $dropoff2 = $rs->fetchAll();

            $rs3 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid 
											FROM extension 
			 where id_area = ? ORDER BY id ASC", array($retorno["tt"]));

            $exten4 = $rs3->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  dropoff 1 */
            $pickupnew3 = array();
            $contador = 0;

            if (!empty($exten4)) {
                foreach ($exten4 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew3[$key] = $value;
                    $contador++;
                }
                foreach ($dropoff2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew3[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($dropoff2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew3[$key] = $value;
                }
            }
            if (!isset($_SESSION['data_agency'])) {
                list($mes, $dia, $anyo) = explode("-", $retorno["fecha"]);
                $fecha = $anyo . "-" . $mes . "-" . $dia;
                ///////////////////////////////////////////////////// */ Cierre de Igualar extension dropoff 2*/
                $sqlofer2 = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente, t3.equipment
                         FROM ofertas t1
						 	LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
                         WHERE t1.trip_from = ? 
						 	AND t1.trip_to = ?
							AND t1.fecha_ini <= ? 
							AND t1.fecha_fin >= ?
                                                        AND t1.trip_no = ?)
							";


                $rsofer2 = Doo::db()->query($sqlofer2, array($retorno["tf"], $retorno["tt"], strtotime($fecha), strtotime($fecha), $retorno["trip_no"]));
                $ofertas2 = $rsofer2->fetch();
            } else {
                $ofertas2 = "";
            }

            $row_array2 = array();
            if (!empty($ofertas2)) {
                list($mes, $dia, $anyo) = explode("-", $retorno["fecha"]);
                $fechaarray2 = array();
                $fechaarray2 = $anyo . "-" . $mes . "-" . $dia;
                if ($retorno["trip_no"] == $ofertas2["trip_no"] && strtotime($fechaarray2) >= $ofertas2["fecha_ini"] && strtotime($fechaarray2) <= $ofertas2["fecha_fin"]) {
                    $value1 = array(
                        "trip_no" => $ofertas2["trip_no"],
                        "trip_departure" => $retorno["trip_departure"],
                        "trip_arrival" => $retorno["trip_arrival"],
                        "price" => $ofertas2["price"],
                        "price2" => $ofertas2["price2"],
                        "price3" => $ofertas2["price3"],
                        "price4" => $ofertas2["price4"],
                        "oferta" => "1",
                        "fecha" => $retorno["fecha"],
                        "trip_from" => $retorno["trip_from"],
                        "trip_to" => $retorno["trip_to"]
                    );

                    $row_array2 = $value1;
                } else {

                    $row_array2 = $retorno;
                }
            } else {

                foreach ($retorno as $key => $value) {

                    $row_array2[$key] = $value;
                }
            }


            /////////////////////////////////////////////////////// /*CAPACIDAD RUTA RETORNO*/


            $sqlcapa2 = "SELECT t1.id_bus,t1.id_trips,t2.capacidad,t3.trip_no,t2.fecha_fin,t2.fecha_ini
			   
									FROM bus_trips t1
																	
									LEFT JOIN bus t2 ON (t1.id_bus = t2.id) 
									LEFT JOIN trips t3 ON (t1.id_trips = t3.id)
										   
										WHERE t3.trip_no = ?  AND t2.fecha_ini <= ? AND t2.fecha_fin >= ?
                         ";


            list($mes, $dia, $anyo) = explode("-", $booking["fecha_retorno"]);

            $fecharet = $anyo . "-" . $mes . "-" . $dia;


            $rs = Doo::db()->query($sqlcapa2, array($row_array2['trip_no'], strtotime($fecharet), strtotime($fecharet)));


            $capacidad = $rs->fetchAll();

            $capacity = array();
            $total = 0;
            foreach ($capacidad as $key => $value) {

                $capacity[$key] = $value;
                $total = $total + $value['capacidad'];
            }



            $fecha_ret = $_SESSION['booking']['fecha_retorno'];
            $demanda = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

            $rs = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
                "where" => "fecha_ini = ? AND trip_no = ?",
                "limit" => 1,
                "param" => array($fecha_ret, $row_array2['trip_no'])
            ));
            $totaldispo = $rs->total;




            $disponible = ( $total - $totaldispo );


            if (isset($disponible) && isset($demanda)) {
                if ($demanda > $disponible) {
                    $_SESSION['msg'] = array("error" => "error", "disponible" => $disponible, "demanda" => $demanda, "trip" => $row_array2['trip_no']);
                    return Doo::conf()->APP_URL . "booking/";
                }
            }

            $this->data['pickup2'] = $pickupnew2;
            $this->data['dropoff2'] = $pickupnew3;
            $this->data['retorno'] = $row_array2;
            $r = $retorno;
        }
        $_SESSION['booking']['trip_arrival'] = $this->data['salida']['trip_arrival'];
        $_SESSION['booking']['trip_departure'] = $this->data['salida']['trip_departure'];
        $_SESSION['booking']['trip_arrival2'] = isset($this->data['retorno']['trip_arrival']) ? $this->data['retorno']['trip_arrival'] : '';
        $_SESSION['booking']['trip_departure2'] = isset($this->data['retorno']['trip_departure']) ? $this->data['retorno']['trip_departure'] : '';

        $_SESSION['trip_arrival'] = $this->data['salida']['trip_arrival'];
        $_SESSION['trip_departure'] = $this->data['salida']['trip_departure'];
        $_SESSION['trip_arrival2'] = isset($this->data['retorno']['trip_arrival']) ? $this->data['retorno']['trip_arrival'] : '';
        $_SESSION['trip_departure2'] = isset($this->data['retorno']['trip_departure']) ? $this->data['retorno']['trip_departure'] : '';



        $date = date("Y-m-d");
        $hor = date("H:i");

        if (isset($e['trip_departure']) && isset($r['trip_departure'])) {
            if (strtotime($date) == strtotime($fecha_salida)) {

                if ($hor > $e['trip_departure'] && $booking["fecha_retorno"] == $date) {
                    return Doo::conf()->APP_URL . "booking/";
                }
                if ($hor > $r['trip_departure'] && $booking["fecha_retorno"] == $date) {
                    return Doo::conf()->APP_URL . "booking/";
                }
            }
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('pickupdropoff', $this->data, true);
    }

    function messageReserveUserAgencyOneWay($tipo = array("N/A", "N/A")) {
        Doo::loadModel("Agency");

        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);
            
            $agencia_name = $dat->company_name;
            $agencia_usuario = $datos->firstname." ".$datos->lastname;
            
        } else {
            $agencia_name = "N/A";
            $agencia_usuario = "N/A";
        }
        
        $booking = $_SESSION['booking'];
        list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        if ($_SESSION['booking']['fecha_retorno'] != "N/A") {
            list($mes1, $dia1, $anyo1) = explode("-", $booking['fecha_retorno']);
            $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $login = $_SESSION['user'];

        $var = explode('-', $tipo[1]);
        $tipoPago = strtoupper($var[0]);
        $totalpax = $booking['pax'] + $booking['chil'];
        $otheramount = isset($_SESSION['booking']['otheramount']) ? $_SESSION['booking']['otheramount'] : 0;
        $pago = ( ($otheramount == 0) ? $_SESSION['booking']['totaltotal'] : $otheramount );
        $pago = number_format($pago, 2, '.', ',');

        return ("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='3' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd5'>Date/Time of Booking: " . $_SESSION['booking']['fecha_ini'] . " / " . $_SESSION['booking']['hora'] . "</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Agency: <span style='color: #1B58E5'>$agencia_name</span>, Usuario : <span style='color: #1B58E5'>$agencia_usuario</span></td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $_SESSION['booking']['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_POST['firstname'] . " " . $_POST['lastname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $_SESSION['booking']['pax'] . "<strong>  </strong>CHD : " . $_SESSION['booking']['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>&nbsp;</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $_SESSION['booking']['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo[0] . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $_SESSION['booking']['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $_SESSION['booking']['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($_SESSION['booking']['trip_departure'])) . "</td>
        </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $_SESSION['booking']['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $_SESSION['booking']['place1'] . " , " . $_SESSION['booking']['hotelarea1'] . "</td>
        </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $_SESSION['booking']['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $_SESSION['booking']['address1'] . " , " . $_SESSION['booking']['hotelarea2'] . "</td>
        </tr>
      </table>
      
      <table id='tableorder2' width='90%'>
        <tr>
          <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
            Please arrive at departure point 30 minutes before the scheduled time</td>
          </tr>
        </table>
      <table id='tableorder3' width='90%'>
        <tr>
          <td  height='35' colspan='3' bgcolor='#DDD7D7' id='titlett3'  aling='center' >RECEIPT</td>
          </tr>
        <tr>
          <td width='34%' height='28'>Card Holder Information</td>
          <td colspan='2'>Billing Address </td>
          </tr>
        <tr>
          <td height='27'>Name : " . $_POST['firstname'] . " </td>
          <td colspan='2'>Address : " . $login->address . "</td>
          <td colspan='2'>Phone : " . $login->phone . "</td>
          </tr>
        <tr>
          <td height='27'>Last Name : " . $_POST['lastname'] . "</td>
          <td colspan='2'>City : " . $login->city . "</td>
          </tr>
        <tr>
          <td height='27'>E-mail : " . $login->username2 . "</td>
          <td>State : " . $login->state . "</td>
          <td>Country :" . $login->country . "</td>
          </tr>
        <tr>
          <td height='27'>Lead Traveler : " . $_POST['firstname'] . " " . $_POST['firstname'] . "</td>
          <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
          </tr>
        </table>
      <p><br />
      </p></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> " . $tipoPago . "</td>
        <td id='titlelr'><strong>$  " . $pago . " </strong></td>
        </tr>
      </table>
      <h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
      <span style='color:rgb(223, 44, 44);'>".$_SESSION['booking']['comentarios']."</span>
      <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
        luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
        THANK YOU FOR CHOOSING US<br />
        HAVE A NICE TRIP<br />
        SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
        Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
        
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>
</div>");
    }

    function messageReserveUserAgencyRoundtrip($tipo = array("N/A", "N/A")) {
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);
            
            $agencia_name = $dat->company_name;
            $agencia_usuario = $datos->firstname." ".$datos->lastname;
            
        } else {
            $agencia_name = "N/A";
            $agencia_usuario = "N/A";
        }
        list($mes, $dia, $anyo) = explode("-", $_SESSION['booking']['fecha_salida']);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        if ($_SESSION['booking']['fecha_retorno'] != "N/A") {
            list($mes1, $dia1, $anyo1) = explode("-", $_SESSION['booking']['fecha_retorno']);
            $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $login = $_SESSION['user'];

        $var = explode('-', $tipo[1]);
        $tipoPago = strtoupper($var[0]);
        $totalpax = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];
        $otheramount = isset($_SESSION['booking']['otheramount']) ? $_SESSION['booking']['otheramount'] : 0;
        $pago = ( ($otheramount == 0) ? $_SESSION['booking']['totaltotal'] : $otheramount );
        $pago = number_format($pago, 2, '.', ',');
        return ("<head>	<title>Documento sin título</title>
							<style type='text/css'>
							#clearTable {
								width: 800px;
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
							
							
							
							.Estilo1 {color: #FF0000}
							.Estilo2 {
								color: #990000;
								font-weight: bold;
							}
							</style>
							</head><div align='center'>
							<br />
							<table   id='clearTable'> 
								 <tr>
								   <td width='316' height='33' rowspan='3' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
								   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
								 </tr>
								 <tr>
								   <td height='35' colspan='3' id='titletd5'>Date/Time of Booking: " . $_SESSION['booking']['fecha_ini'] . " / " . $_SESSION['booking']['hora'] . "</td>
						      </tr>
								 <tr>
								   <td height='35' colspan='3' id='titletd4'>Agency: <span style='color: #1B58E5'>$agencia_name</span>, Usuario : <span style='color: #1B58E5'>$agencia_usuario</span></td>
								</tr>
								 <tr>
								   <td align='center' height='33' colspan='4' id='titletd2'>" . $_SESSION['booking']['ticke'] . " E-TICKET</td>
								 </tr>
								 <tr>
								   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_POST['firstname'] . " " . $_POST['lastname'] . " </td>
								   <td width='145' height='15' id='titletd6'>&nbsp;</td>
								   <td colspan='2' id='titletd6'>AD : " . $_SESSION['booking']['pax'] . "<strong>  </strong>CHD : " . $_SESSION['booking']['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
								 </tr>
								 <tr>
								   <td height='16' id='titletd7'>&nbsp;</td>
								   <td height='16' id='titletd7'>Status: CONFIRMED</td>
								   <td width='197' height='16' id='titletd7'>Confirmation # " . $_SESSION['booking']['codconf'] . "</td>
								   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo[0] . "</td>
								 </tr>
								 <tr>
								<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $_SESSION['booking']['ticke'] . " </p></td>
							  </tr>
							  <tr>
								<td colspan='4' ><table width='90%' height='125' id='tableorder'>
								  <tr>
									<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
									<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $_SESSION['booking']['trip_no'] . "</td>
									<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($_SESSION['booking']['trip_departure'])) . "</td>
								  </tr>
								  <tr>
									<td height='41'><strong>From :</strong> " . $_SESSION['booking']['from_name'] . "</td>
									<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $_SESSION['booking']['place1'] . " , " . $_SESSION['booking']['hotelarea1'] . "</td>
								  </tr>
								  <tr>
									<td height='39'><strong>To </strong>:" . $_SESSION['booking']['to_name'] . "</td>
									<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $_SESSION['booking']['address1'] . " , " . $_SESSION['booking']['hotelarea2'] . "</td>
									</tr>
							  </table>
							   
							   <table id='tableorder' width='90%'>
								  <tr>
									<td id='titlett'  width='34%' height='35'  ><strong> Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
									<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $_SESSION['booking']['trip_no2'] . "</td>
									<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($_SESSION['booking']['trip_departure2'])) . "</td>
								  </tr>
								  <tr>
									<td height='28'><strong>From :</strong> " . $_SESSION['booking']['to_name'] . "</td>
									<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $_SESSION['booking']['place2'] . " , " . $_SESSION['booking']['hotelarea3'] . "</td>
								  </tr>
								  <tr>
									<td height='27'><strong>To :</strong>" . $_SESSION['booking']['from_name'] . "</td>
									<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $_SESSION['booking']['address2'] . ", " . $_SESSION['booking']['hotelarea4'] . "</td>
									</tr>
								</table>
							   
							   
								<table id='tableorder2' width='90%'>
								  <tr>
									<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
									  Please arrive at departure point 30 minutes before the scheduled time</td>
									</tr>
								</table>
								<table id='tableorder3' width='90%'>
								  <tr>
									<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
									</tr>
								  <tr>
									<td width='34%' height='28'>Card Holder Information</td>
									<td colspan='2'>Billing Address </td>
								  </tr>
								  <tr>
									<td height='27'>Name : " . $_POST['firstname'] . " </td>
									<td colspan='2'>Address : " . $login->address . "</td>
									 <td colspan='2'>Phone : " . $login->phone . "</td>
								  </tr>
								  <tr>
									<td height='27'>Last Name : " . $_POST['lastname'] . "</td>
									<td colspan='2'>City : " . $login->city . "</td>
								  </tr>
								  <tr>
									<td height='27'>E-mail : " . $login->username2 . "</td>
									<td>State : " . $login->state . "</td>
									<td>Country :" . $login->country . "</td>
								  </tr>
								  <tr>
									<td height='27'>Lead Traveler : " . $_POST['firstname'] . " " . $_POST['lastname'] . "</td>
									<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
								  </tr>
								</table>
								<p><br />
							  </p></td>
							  </tr>
							  <tr>
								<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
							  </tr>
							  <tr>
								<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
								  
								  <tr>
									<td height='31' colspan='5' align='center' id='titlell2'>&nbsp;</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipoPago . "</td>
									<td id='titlelr2'><span class='Estilo2'>$  " . $pago . "</span></td>
								  </tr>
								  
								</table>
								  <h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
                                  <span style='color:rgb(223, 44, 44);'>".$_SESSION['booking']['comentarios']."</span>
                                  <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
								  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
								  THANK YOU FOR CHOOSING US<br />
								  HAVE A NICE TRIP<br />
								  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
								  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
							   
								</p></td>
							  </tr>
							  <tr>
								<td colspan='4' align='center'> <p align='center' class='titulopago'> 
								
							</p>       </td>
							
							  </tr>
							  </table>
							
							
							
							</div>");
    }

    function emailReserveUserAgency($reserves) {
        Doo::loadModel("Reserve");
        $reserve = new Reserve();
        $reserve = $reserves;
        try {
            $login = $_SESSION['user'];
            if (isset($_POST['email'])) {
                $NomCliente = $_POST['firstname'] . ' ' . $_POST['lastname'];
                $correoCliente = $_POST['email'];
            } else {
                $correoCliente = '';
            }
            Doo::loadController('DatosMailController');
            $datosMail = new DatosMailController();
            $mail4 = new PHPMailer(true);
            $mail4 = $datosMail->datos();
            $tipo = array($reserve->tipo_pago, $reserve->pago);
            $mail4->AddAddress($login->username2, $login->firstname . ' ' . $login->lastname);
            if ($correoCliente != '') {
                $mail4->AddAddress($correoCliente, $NomCliente);
            }
            if ($_SESSION['booking']['tipo_ticket'] == "oneway") {
                $mail4->MsgHTML($this->messageReserveUserAgencyOneWay($tipo));
            } else {
                $mail4->MsgHTML($this->messageReserveUserAgencyRoundtrip($tipo));
            }
            $mail4->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Errores de cualquier otra cosa.
        }
    }

    public function aprovado() {

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('approval', $this->data, true);
    }

    public function load() {
        if (isset($_SESSION['user']) && isset($_SESSION['booking'])) {
            $login = $_SESSION['user'];
            $booking = $_SESSION['booking'];
            if ($login->tipo_client != 2) {
                if (isset($_GET['ssl_approval_code']) && isset($_SESSION['booking']['codconf'])) {
                    $_SESSION['booking']['codconf'] = $_SESSION['booking']['codconf'] . "_" . $_GET['ssl_approval_code'];
                } else {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/";
                }
            }
        }
        Doo::loadModel("Reserve");
        Doo::loadModel("Agency");
        $reserve = new Reserve();
        if (isset($_SESSION["booking"])) {
            if (isset($_GET['ssl_card_number'])) {
                $_SESSION['booking']['card_number'] = $_GET['ssl_card_number'];
            } else {
                $_SESSION['booking']['card_number'] = "N/A";
            }
            if (isset($_SESSION['tipo'])) {
                $tipo = $_SESSION['tipo'];
                $_SESSION['booking']['total2'] = $_SESSION['booking']['totaltotal'];
                if (isset($tipo->agencia) && isset($tipo->otheram)) {
                    $_SESSION['booking']['agen'] = $tipo->agencia;
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                } else {
                    $_SESSION['booking']['agen'] = "N/A";
                }
                if (isset($tipo->otheram)) {
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                }
            }


            $booking = $_SESSION["booking"];
            
            
            if (isset($_GET['ssl_txn_id'])) {
                $tipo->pago = "TOTAL AMOUNT PAID";
                $tipo->comment = "PAID ONLINE";
            }
            if (isset($tipo->comment)) {
                $_SESSION['booking']['comments'] = $tipo->comment;
            }
            $reserve = new Reserve($_SESSION['booking']);
            $new = true;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $login = $_SESSION['user'];
            if (isset($_SESSION['tipo'])) {
                $tipo = $_SESSION['tipo'];
                $reserve->tipo_pago = $tipo->tipo;
                $tipo_pago = $tipo->tipo;
                $fpago = $_SESSION['formaPago'];
            }
            if ($new) {
                if (isset($_SESSION['data_agency'])) {
                    $dat = new Agency($_SESSION['data_agency']);
                } else {
                    $dat = new Agency();
                    $dat->id = -1;
                    $dat->type_rate = 0;
                }
                Doo::loadModel("Reserve");
                list ($mes, $dia, $anyo) = explode("-", $_SESSION['booking']['fecha_salida']);
                $fecha_salida = $anyo . "-" . $mes . "-" . $dia;
                if ($_SESSION['booking']['tipo_ticket'] == 'roundtrip') {
                    list ($mes2, $dia2, $anyo2) = explode("-", $_SESSION['booking']['fecha_retorno']);
                    $fecha_retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
                } else {
                    $fecha_retorno = 'N/A';
                }
                $tipo_pago = 'PRED-PAID';
                $total_neto = $_SESSION['booking']['totaltotal'];
                $otheramount = (isset($_SESSION['booking']['otheramount'])) ? $_SESSION['booking']['otheramount'] : 0;
                $reserves = new Reserve();
                $reserves->id_tours = -1;
                $reserves->type_tour = '';                
                $reserves->fecha_ini = date('Y-m-d');
                $reserves->trip_no = $_SESSION['booking']['trip_no'];
                $reserves->trip_no2 = $_SESSION['booking']['trip_no2'];
                $reserves->tipo_ticket = $_SESSION['booking']['tipo_ticket'];
                $reserves->fromt = $_SESSION['booking']['fromt'];
                $reserves->tot = $_SESSION['booking']['tot'];
                $reserves->fromt2 = $_SESSION['booking']['tot'];
                $reserves->tot2 = $_SESSION['booking']['fromt'];
                $reserves->firsname = $_SESSION['booking']['firsname'];
                $reserves->lasname = $_SESSION['booking']['lasname'];
                if (isset($_SESSION['booking']['email'])) {
                    $reserves->email = $_SESSION['booking']['email'];
                } else {
                    if (!isset($_SESSION['data_agency'])) {
                        $reserves->email = $login->username;
                    }
                }
                $reserves->deptime1 = $_SESSION['booking']['trip_departure'];
                $reserves->deptime2 = isset($_SESSION['booking']['trip_departure2']) ? $_SESSION['booking']['trip_departure2'] : '';
                $reserves->arrtime1 = $_SESSION['booking']['trip_arrival'];
                $reserves->arrtime2 = isset($_SESSION['booking']['trip_arrival2']) ? $_SESSION['booking']['trip_arrival2'] : '';

                $reserves->precioA = $_SESSION['booking']['totaladul'];
                $reserves->precioN = ($_SESSION['booking']['chil'] > 0) ?  $_SESSION['booking']['totalchil'] : 0;

                /** Discriminacion de precios */
                    $reserves->precio_trip1_a = $_SESSION['booking']['priceadult'];
                    $reserves->precio_trip1_c = $_SESSION['booking']['pricechil'];
                    $reserves->precio_trip2_a = $_SESSION['booking']['2priceadult'];
                    $reserves->precio_trip2_c = $_SESSION['booking']['2pricechil'];

                    #extension 1
                    $reserves->precio_exten1_a = $_SESSION['booking']['precio_e1'];
                    $reserves->precio_exten1_c = $_SESSION['booking']['precio_e1'];

                    #extension 2
                    $reserves->precio_exten2_a = $_SESSION['booking']['precio_e2'];
                    $reserves->precio_exten2_c = $_SESSION['booking']['precio_e2'];

                    #extension 3
                    $reserves->precio_exten3_a = $_SESSION['booking']['precio_e3'];
                    $reserves->precio_exten3_c = $_SESSION['booking']['precio_e3'];

                    #extension 4
                    $reserves->precio_exten4_a = $_SESSION['booking']['precio_e4'];
                    $reserves->precio_exten4_c = $_SESSION['booking']['precio_e4'];                
                /** fin Discriminacion de precios */
                
                $reserves->extension1 = $_SESSION['booking']['extension1'];
                $reserves->precio_e1 = $_SESSION['booking']['precio_e1'];
                $reserves->pickup_exten1 = $_SESSION['booking']['hotelarea1'];
                $reserves->extension2 = $_SESSION['booking']['extension2'];
                $reserves->precio_e2 = $_SESSION['booking']['precio_e2'];
                $reserves->pickup_exten2 = $_SESSION['booking']['hotelarea2'];
                $reserves->extension3 = $_SESSION['booking']['extension3'];
                $reserves->precio_e3 = $_SESSION['booking']['precio_e3'];
                $reserves->pickup_exten3 = $_SESSION['booking']['hotelarea3'];
                $reserves->extension4 = $_SESSION['booking']['extension4'];
                $reserves->precio_e4 = $_SESSION['booking']['precio_e4'];
                $reserves->pickup_exten4 = $_SESSION['booking']['hotelarea4'];
                $reserves->fecha_salida = $fecha_salida;
                $reserves->fecha_retorno = $fecha_retorno;
                $reserves->pax = $_SESSION['booking']['pax'];
                $reserves->pax2 = $_SESSION['booking']['chil'];
                $reserves->id_clientes = $_SESSION['booking']['id_clientes'];
                $reserves->pickup1 = $_SESSION['booking']['pickup1'];
                $reserves->dropoff1 = $_SESSION['booking']['dropoff1'];
                $reserves->pickup2 = $_SESSION['booking']['pickup2'];
                $reserves->dropoff2 = $_SESSION['booking']['dropoff2'];
                $reserves->tipo_pago = $tipo_pago;
                $reserves->pago = $fpago;
                $reserves->totaltotal = $total_neto;
                $reserves->otheramount = $_SESSION['booking']['otheramount'];
                $reserves->extra_charge = 0;
                $reserves->total2 = $total_neto;
                $reserves->codconf = $_SESSION['booking']['codconf'];
                $reserves->hora = $_SESSION['booking']['hora'];
                if (isset($_SESSION["booking"]["comentarios"])) {
                    $comentarios = $_SESSION["booking"]["comentarios"];
                } else {
                    $comentarios = "PAID ONLINE";
                }
                $reserves->comments = $comentarios;
                $reserves->resident = isset($_SESSION['booking']['resident']) ? $_SESSION['booking']['resident'] : 0;
                $reserves->agen = $login->id;
                $reserves->tipo_client = isset($login->tipo_client) ? $login->tipo_client : 0;
                $reserves->reward_id = -1;
                $reserves->agency = $dat->id;
                $reserves->luggage1 = -1;
                $reserves->luggage2 = -1;
                $reserves->canal = 'WEBSALE';
                $reserves->estado = 'CONFIRMED';

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                if (Doo::db()->insert($reserves)) {
                    //Registramos pagos y rastro
                    $id_reserva = Doo::db()->lastInsertId();
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserves->id = $id_reserva;
                    $login = $_SESSION['user'];
                    if (isset($_SESSION['data_agency'])) {
                        $login->tipo = 'AGENCY';
                    } else {
                        $login->tipo = 'CLIENTE';
                    }
                    $reseControl->registrar_pago($reserves, NULL, $login);
                    $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);
                    //fin registro pagos y rastro
                    //facturamos
                    Doo::loadModel('Factura');
                    Doo::loadModel('FacturaServicio');
                    $factura = new Factura();
                    $factura->id_agency = ($reserve->agency == 0) ? -1 : $reserve->agency;
                    $factura->creation_date = date('Y-m-d');
                    $factura->subtotal = $reserve->total2;
                    $factura->collect = $reserve->totaltotal;
                    $factura->total = $factura->subtotal - $factura->collect;
                    $factura->estado = "PAID";
                    $factura->id = $factura->insert();
                    $fs = new FacturaServicio();
                    $fs->id_servicio = $id_reserva;
                    $fs->tipo_servicio = "RESERVE";
                    $fs->id_factura = $factura->id;
                    $fs->id = $fs->insert();
                    Doo::loadModel('CollectService');
                    $coll = new CollectService();
                    $coll->id_servicio = $id_reserva;
                    $coll->tipo_servicio = "RESERVE";
                    $coll->monto_pagado = $reserve->totaltotal;
                    $coll->id = $coll->insert();
                    Doo::loadModel('Pago');
                    $pago = new Pago();
                    $pago->factura = $factura->id;
                    $pago->monto = $reserve->totaltotal;
                    $pago->tipo = 'FULL';
                    $pago->transnu = 0;
                    $pago->adjunto = 'online-paid';
                    $pago->descuento = 0;
                    $pago->per_descuento = 0;
                    $pago->fecha = date('Y-m-d h:m:s');
                    $pago->metodo = 4;
                    $pago->id = $pago->insert();

                    $tipo_pago = $reserves->tipo_pago;
                    $fpago = $reserves->pago;
                    $tipo = new stdclass();
                    $tipo->tipo = $tipo_pago;
                    $tipo->pago = $fpago;
                    $tipo->comment = "PAID ONLINE";
                    $_SESSION['tipo'] = $tipo;
                    if (isset($_SESSION['data_agency'])) {
                        $id_reserva = Doo::db()->lastInsertId();
                        $tipo_pago = $reserves->tipo_pago;
                        $fpago = $reserves->pago;
                        $dat = new Agency($_SESSION['data_agency']);
                        Doo::loadModel("Reservas_Agency");
                        $reserves_a = new Reservas_Agency();
                        $reserves_a->id_reservas = $id_reserva;
                        $reserves_a->id_agencia = $dat->id;
                        $reserves_a->id_client = $login->id;
                        $reserves_a->type_client = $login->id;
                        $reserves_a->id_useragency = $login->id;
                        $reserves_a->paid_type = $tipo_pago;
                        $reserves_a->metodo_paid = $fpago;
                        $reserves_a->paid_net = $total_neto;
                        $reserves_a->otheramount = $_SESSION['booking']['otheramount'];
                        $reserves_a->paid_full = $_SESSION['booking']['totaltotal'];
                        if ($dat->type_rate == 1) {
                            $reserves_a->comision = 0;
                        } else {
                            $reserves_a->comision = ($this->cal_equipament($reserve->trip_no) + $this->cal_equipament($reserve->trip_no2)) / 2;
                        }
                        $reserves_a->otheramount = $otheramount;
                        $reserves_a->agency_fee = $total_neto * $reserves_a->comision / 100;
                        $reserves_a->paper_voucher = 0;
                        Doo::db()->insert($reserves_a);
                    }
                }
                $this->loading();
                if (isset($_GET['ssl_txn_id'])) {
                    $codconf = array(
                        "codconf" => $_SESSION['booking']['codconf']
                    );
                    $_SESSION['code'] = $codconf;
                    unset($_SESSION['booking']);
                    return Doo::conf()->APP_URL . "transaction/approved";
                }
            } else {
                return Doo::conf()->APP_URL . "error";
            }
            $codconf = array(
                "codconf" => $_SESSION['booking']['codconf']
            );
            $_SESSION['code'] = $codconf;
            unset($_SESSION['booking']);
            return Doo::conf()->APP_URL . "transaction/approved";
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    ////////////////////////////////////////////////////////


    public function loading() {
        $tipo = $_SESSION['tipo'];
        $login = $_SESSION['user'];
        $booking = $_SESSION['booking'];

        list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
        $fecha = $anyo . "-" . $mes . "-" . $dia;

        if ($booking['fecha_retorno'] != "N/A") {
            list($mes1, $dia1, $anyo1) = explode("-", $booking['fecha_retorno']);
            $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
        }


        $totalpax = $booking['pax'] + $booking['chil'];
        if ($tipo->comment == "PAID ONLINE") {
            try {
                Doo::loadController('DatosMailController');
                $datosMail = new DatosMailController();
                $mail = new PHPMailer(true);
                $mail = $datosMail->datos();
                $mail->AddAddress($login->username, $login->lastname);

                $tipo_ticket = $booking["tipo_ticket"];
                $otheramount = isset($_SESSION['booking']['otheramount']) ? $_SESSION['booking']['otheramount'] : 0;
                $pago = ( ($otheramount == 0) ? $booking['totaltotal'] : $otheramount);
                $pago = number_format($pago, 2, '.', ',');
                $var = explode('-', $tipo->pago);
                $tipoPago = strtoupper($var[0]);

                if ($tipo_ticket == "oneway") {
                    $mail->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'></td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . " </td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>

        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
      </tr>
       <tr >
		<td width='7%' height='30'>" . $booking['pax'] . "</td>
		<td width='17%'>Adults</td>
		<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
		<td id='titlelp' width='11%'>" . (($otheramount == 0) ? '$ ' . $booking['precioadul'] : ' ') . "</td>
		<td id='titlelp' width='12%'>" . (($otheramount == 0) ? '$ ' . $booking['totaladul'] : ' ') . "</td>
	  </tr>
	  <tr>
		
		 
		<td height='27'>" . $booking['chil'] . "</td>
		<td>Children (3-9 Years)</td>
		<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
		<td id='titlelp'>" . ( ($otheramount == 0) ? '$ ' . $booking['preciochil'] : ' ' ) . "</td>
		<td id='titlelp'>" . ( ($otheramount == 0) ? '$ ' . $booking['totalchil'] : ' ' ) . "</td>
			 
	  </tr>
	   <tr>
		<td height='27'></td>
		<td>&nbsp;</td>
		<td id='titlell'> Pick up Point /Drop Off - Extension </td>
		<td id='titlelp'>" . (($otheramount == 0) ? '$ ' . $booking['pricexten'] : ' ') . "</td>
		<td id='titlelp'>" . (($otheramount == 0) ? '$ ' . $booking['totalexten'] : ' ') . "</td>
	  </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> " . $tipoPago . "</td>
        <td id='titlelr'><strong>$  " . $pago . " </strong></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>



</div>");
                } else {

                    $mail->MsgHTML("<head>
					
					<title>Documento sin título</title>
					<style type='text/css'>
					#clearTable {
						width: 800px;
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
					
					
					
					</style>
					</head><div align='center'>
					<br />
					<table   id='clearTable'> 
						 <tr>
						   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
						   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
						 </tr>
						 <tr>
						   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
						</tr>
						 <tr>
						   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
						 </tr>
						 <tr>
						   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
						   <td width='145' height='15' id='titletd6'>&nbsp;</td>
						   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
						 </tr>
						 <tr>
						   <td height='16' id='titletd7'></td>
						   <td height='16' id='titletd7'>Status: CONFIRMED</td>
						   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
						   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
						 </tr>
						 <tr>
						<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
					  </tr>
					  <tr>
						<td colspan='4' ><table width='90%' height='125' id='tableorder'>
						  <tr>
							<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
							<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
							<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
						  </tr>
						  <tr>
							<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
						  </tr>
						  <tr>
							<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . ", " . $booking['hotelarea2'] . "</td>
							</tr>
					  </table>
					   
					   <table id='tableorder' width='90%'>
						  <tr>
							<td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
							<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
							<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
						  </tr>
						  <tr>
							<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . " </td>
						  </tr>
						  <tr>
							<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
							</tr>
						</table>
					   
					   
						<table id='tableorder2' width='90%'>
						  <tr>
							<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
							  Please arrive at departure point 30 minutes before the scheduled time</td>
							</tr>
						</table>
						<table id='tableorder3' width='90%'>
						  <tr>
							<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
							</tr>
						  <tr>
							<td width='34%' height='28'>Card Holder Information</td>
							<td colspan='2'>Billing Address </td>
						  </tr>
						  <tr>
							<td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
							<td colspan='2'>Address : " . $login->address . "</td>
							 <td colspan='2'>Phone : " . $login->phone . "</td>
						  </tr>
						  <tr>
							<td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
							<td colspan='2'>City : " . $login->city . "</td>
						  </tr>
						  <tr>
							<td height='27'>E-mail : " . $login->username . "</td>
							<td>State : " . $login->state . "</td>
							<td>Country :" . $login->country . "</td>
						  </tr>
						  <tr>
							<td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
							<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
						  </tr>
						</table>
						<p><br />
					  </p></td>
					  </tr>
					  <tr>
						<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
					  </tr>
					  <tr>
						<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
						  <tr>
							<td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
						  </tr>
						  <tr>
							<td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
						  </tr>
						  <tr >
							<td width='7%' height='30'>" . $booking['pax'] . "</td>
							<td width='17%'>Adults</td>
							<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp' width='11%'>" . (($otheramount == 0) ? '$ ' . $booking['precioadul'] : ' ') . "</td>
							<td id='titlelp' width='12%'>" . (($otheramount == 0) ? '$ ' . $booking['totaladul'] : ' ') . "</td>
						  </tr>
						  <tr>
							
							 
							<td height='27'>" . $booking['chil'] . "</td>
							<td>Children (3-9 Years)</td>
							<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp'>" . ( ($otheramount == 0) ? '$ ' . $booking['preciochil'] : ' ' ) . "</td>
							<td id='titlelp'>" . ( ($otheramount == 0) ? '$ ' . $booking['totalchil'] : ' ' ) . "</td>
								 
						  </tr>
						   <tr>
							<td height='27'></td>
							<td>&nbsp;</td>
							<td id='titlell'> Pick up Point /Drop Off - Extension </td>
							<td id='titlelp'>" . (($otheramount == 0) ? '$ ' . $booking['pricexten'] : ' ') . "</td>
							<td id='titlelp'>" . (($otheramount == 0) ? '$ ' . $booking['totalexten'] : ' ') . "</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td  id='titlelr' align='center' colspan='2' style='font-size: 18px;' > " . $tipoPago . "</td>
							<td id='titlelr'><strong style='font-size: 18px;'>$  " . $pago . " </strong></td>
						  </tr>
						</table>
						  <p>&nbsp;</p>
						<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
						  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
						  THANK YOU FOR CHOOSING US<br />
						  HAVE A NICE TRIP<br />
						  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
						  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
						</p></td>
					  </tr>
					  <tr>
						<td colspan='4' align='center'> <p align='center' class='titulopago'> 
						
					</p>       </td>
					
					  </tr>
					  </table>
					
					
					
					</div>");
                }


                $mail->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Errores de cualquier otra cosa.
            }
        }

        unset($mail);


        try {
            $nombre_destino = "Admin";
            Doo::loadController('DatosMailController');
            $datosMail = new DatosMailController();
            $mail2 = new PHPMailer(true);
            $mail2 = $datosMail->datos();
            $mail2->AddAddress("websales@supertours.com", $nombre_destino);
            $tipo_ticket = $booking["tipo_ticket"];

            if ($tipo_ticket == "oneway") {

                $mail2->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



.Estilo2 {color: #FF0000}
.Estilo3 {color: #FFFFFF}
.Estilo4 {color: #000000; }
</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
         
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
        <td colspan='2'>Date : " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
        <td colspan='2'>'Card Number : " . $_SESSION['booking']['card_number'] . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
      </tr>
      <tr >
        <td width='7%' height='30'>" . $booking['pax'] . "</td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
        <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
      </tr>
      <tr>
        
         
        <td height='27'>" . $booking['chil'] . "</td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
        <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
        <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo2'  id='titlelr2'> " . $tipo->pago . "</td>
        <td id='titlelr2'><span class='Estilo2'><strong>$  " . $booking['totaltotal'] . " </strong></span></td>
      </tr>
      <tr>
        <td>Comments</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo4'  id='titlelr'><p>" . $tipo->comment . "</p>
          <p>&nbsp;</p></td>
        <td class='Estilo3' id='titlelr'></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>


</div>");
            } else {
                $mail2->MsgHTML("<head>
				
				<title>Documento sin título</title>
				<style type='text/css'>
				#clearTable {
					width: 800px;
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
				
				
				
				.Estilo1 {color: #FF0000}
				.Estilo2 {
					color: #990000;
					font-weight: bold;
				}
				</style>
				</head><div align='center'>
				<br />
				<table   id='clearTable'> 
					 <tr>
					   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
					   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
					 </tr>
					 <tr>
					   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
					</tr>
					 <tr>
					   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
					 </tr>
					 <tr>
					   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
					   <td width='145' height='15' id='titletd6'>&nbsp;</td>
					   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
					 </tr>
					 <tr>
					   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
					   <td height='16' id='titletd7'>Status: CONFIRMED</td>
					   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
					   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
					 </tr>
					 <tr>
					<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
				  </tr>
				  <tr>
					<td colspan='4' ><table width='90%' height='125' id='tableorder'>
					  <tr>
						<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
						<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
						<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
					  </tr>
					  <tr>
						<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
						<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
					  </tr>
					  <tr>
						<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
						<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
						</tr>
				  </table>
				   
				   <table id='tableorder' width='90%'>
					  <tr>
						<td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
						<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
						<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
					  </tr>
					  <tr>
						<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
						<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . "  , " . $booking['hotelarea3'] . "</td>
					  </tr>
					  <tr>
						<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
						<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
						</tr>
					</table>
				   
				   
					<table id='tableorder2' width='90%'>
					  <tr>
						<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
						  Please arrive at departure point 30 minutes before the scheduled time</td>
						</tr>
					</table>
					<table id='tableorder3' width='90%'>
					  <tr>
						<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
						</tr>
					  <tr>
						<td width='34%' height='28'>Card Holder Information</td>
						<td colspan='2'>Billing Address </td>
					  </tr>
					  <tr>
						<td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
						<td colspan='2'>Address : " . $login->address . "</td>
						 <td colspan='2'>Phone : " . $login->phone . "</td>
                         
					  </tr>
					  <tr>
						<td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
						<td colspan='2'>City : " . $login->city . "</td>
                        <td colspan='2'>Date : " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
					  </tr>
					  <tr>
						<td height='27'>E-mail : " . $login->username . "</td>
						<td>State : " . $login->state . "</td>
						<td>Country :" . $login->country . "</td>
                         <td colspan='2'>Card Number : " . $_SESSION['booking']['card_number'] . "</td>
					  </tr>
					  <tr>
						<td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
						<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
					  </tr>
					</table>
					<p><br />
				  </p></td>
				  </tr>
				  <tr>
					<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
				  </tr>
				  <tr>
					<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
					  <tr>
						<td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
					  </tr>
					  <tr>
						<td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
					  </tr>
					  <tr >
						<td width='7%' height='30'>" . $booking['pax'] . "</td>
						<td width='17%'>Adults</td>
						<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
						<td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
						<td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
					  </tr>
					  <tr>
						
						 
						<td height='27'>" . $booking['chil'] . "</td>
						<td>Children (3-9 Years)</td>
						<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
						<td id='titlelp'>$ " . $booking['preciochil'] . "</td>
						<td id='titlelp'>$ " . $booking['totalchil'] . "</td>
					  </tr>
					   <tr>
						<td height='27'></td>
						<td>&nbsp;</td>
						<td id='titlell'> Pick up Point /Drop Off - Extension </td>
						<td id='titlelp'>$ " . $booking['pricexten'] . "</td>
						<td id='titlelp'>$ " . $booking['totalexten'] . "</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td id='titlell'>Taxes and Fees</td>
						<td id='titlelp'>$ 0.00</td>
						<td id='titlelp'>$ 0.00 </td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
						<td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
					  </tr>
					  <tr>
						<td>Comments</td>
						<td>&nbsp;</td>
						<td  id='titlelr' align='center' colspan='2'><p>" . $tipo->comment . "</p>
						  <p>&nbsp;</p></td>
						<td id='titlelr'></td>
					  </tr>
					</table>
					  <p>&nbsp;</p>
					<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
					  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
					  THANK YOU FOR CHOOSING US<br />
					  HAVE A NICE TRIP<br />
					  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
					  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
				   
					</p></td>
				  </tr>
				  <tr>
					<td colspan='4' align='center'> <p align='center' class='titulopago'> 
					
				</p>       </td>
				
				  </tr>
				  </table>
				
				
				
				</div>");
            }
            $mail2->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Errores de cualquier otra cosa.
        }
        unset($mail2);
/////////////////////////////////////////////////////////				 




        if ($login->username == "operador1@supertours.com" || $login->username == "operador2@supertours.com" || $login->username == "operador3@supertours.com") {

            try {
                Doo::loadController('DatosMailController');
                $datosMail = new DatosMailController();
                $mail3 = new PHPMailer(true);
                $mail3 = $datosMail->datos();
                //La direccion a donde mandamos el correo
                $mail3->AddAddress($login->username, "Super Tours OF Orlando");
                $tipo_ticket = $booking["tipo_ticket"];
                if ($tipo_ticket == "oneway") {
                    $mail3->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



.Estilo2 {color: #FF0000}
.Estilo3 {color: #FFFFFF}
.Estilo4 {color: #000000; }
</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>

  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
      </tr>
      <tr >
        <td width='7%' height='30'>" . $booking['pax'] . "</td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
        <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
      </tr>
      <tr>
        
         
        <td height='27'>" . $booking['chil'] . "</td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
        <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
        <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo2'  id='titlelr2'> " . $tipo->pago . "</td>
        <td id='titlelr2'><span class='Estilo2'><strong>$  " . $booking['totaltotal'] . " </strong></span></td>
      </tr>
      <tr>
        <td>Comments</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo4'  id='titlelr'><p>" . $tipo->comment . "</p>
          <p>&nbsp;</p></td>
        <td class='Estilo3' id='titlelr'>&nbsp;</td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>


</div>");
                } else {
                    $mail3->MsgHTML("<head>
					
					<title>Documento sin título</title>
					<style type='text/css'>
					#clearTable {
						width: 800px;
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
					
					
					
					.Estilo1 {color: #FF0000}
					.Estilo2 {
						color: #990000;
						font-weight: bold;
					}
					</style>
					</head><div align='center'>
					<br />
					<table   id='clearTable'> 
						 <tr>
						   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
						   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
						 </tr>
						 <tr>
						   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
						</tr>
						 <tr>
						   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
						 </tr>
						 <tr>
						   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
						   <td width='145' height='15' id='titletd6'>&nbsp;</td>
						   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
						 </tr>
						 <tr>
						   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
						   <td height='16' id='titletd7'>Status: CONFIRMED</td>
						   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
						   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
						 </tr>
						 <tr>
						<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
					  </tr>
					  <tr>
						<td colspan='4' ><table width='90%' height='125' id='tableorder'>
						  <tr>
							<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
							<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
							<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
						  </tr>
						  <tr>
							<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
						  </tr>
						  <tr>
							<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
							</tr>
					  </table>
					   
					   <table id='tableorder' width='90%'>
						  <tr>
							<td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
							<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
							<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
						  </tr>
						  <tr>
							<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . "</td>
						  </tr>
						  <tr>
							<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
							</tr>
						</table>
					   
					   
						<table id='tableorder2' width='90%'>
						  <tr>
							<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
							  Please arrive at departure point 30 minutes before the scheduled time</td>
							</tr>
						</table>
						<table id='tableorder3' width='90%'>
						  <tr>
							<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
							</tr>
						  <tr>
							<td width='34%' height='28'>Card Holder Information</td>
							<td colspan='2'>Billing Address </td>
						  </tr>
						  <tr>
							<td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
							<td colspan='2'>Address : " . $login->address . "</td>
							 <td colspan='2'>Phone : " . $login->phone . "</td>
						  </tr>
						  <tr>
							<td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
							<td colspan='2'>City : " . $login->city . "</td>
						  </tr>
						  <tr>
							<td height='27'>E-mail : " . $login->username . "</td>
							<td>State : " . $login->state . "</td>
							<td>Country :" . $login->country . "</td>
						  </tr>
						  <tr>
							<td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
							<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
						  </tr>
						</table>
						<p><br />
					  </p></td>
					  </tr>
					  <tr>
						<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
					  </tr>
					  <tr>
						<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
						  <tr>
							<td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
						  </tr>
						  <tr>
							<td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
						  </tr>
						  <tr >
							<td width='7%' height='30'>" . $booking['pax'] . "</td>
							<td width='17%'>Adults</td>
							<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
							<td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
						  </tr>
						  <tr>
							
							 
							<td height='27'>" . $booking['chil'] . "</td>
							<td>Children (3-9 Years)</td>
							<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp'>$ " . $booking['preciochil'] . "</td>
							<td id='titlelp'>$ " . $booking['totalchil'] . "</td>
						  </tr>
						   <tr>
							<td height='27'></td>
							<td>&nbsp;</td>
							<td id='titlell'> Pick up Point /Drop Off - Extension </td>
							<td id='titlelp'>$ " . $booking['pricexten'] . "</td>
							<td id='titlelp'>$ " . $booking['totalexten'] . "</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td id='titlell'>Taxes and Fees</td>
							<td id='titlelp'>$ 0.00</td>
							<td id='titlelp'>$ 0.00 </td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
							<td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
						  </tr>
						  <tr>
							<td>Comments</td>
							<td>&nbsp;</td>
							<td  id='titlelr' align='center' colspan='2'><p>" . $tipo->comment . "</p>
							  <p>&nbsp;</p></td>
							<td id='titlelr'>&nbsp;</td>
						  </tr>
						</table>
						  <p>&nbsp;</p>
						<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
						  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
						  THANK YOU FOR CHOOSING US<br />
						  HAVE A NICE TRIP<br />
						  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
						  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
					   
						</p></td>
					  </tr>
					  <tr>
						<td colspan='4' align='center'> <p align='center' class='titulopago'> 
						
					</p>       </td>
					
					  </tr>
					  </table>
					
					
					
					</div>");
                }

                $mail3->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Errores de cualquier otra cosa.
            }
            unset($mail3);
        }





/////////////////////////////////////////////////////////				 

        if ($login->tipo_client == 2) {
            try {
                Doo::loadController('DatosMailController');
                $datosMail = new DatosMailController();
                $mail4 = new PHPMailer(true);
                $mail4 = $datosMail->datos();
                //La direccion a donde mandamos el correo
                $mail4->AddAddress($login->username2, "Supertours Of Orlando");

                if ($tipo_ticket == "oneway") {
                    $mail4->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>&nbsp;</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username2 . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' >&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      
      <tr>
        <td width='7%'>&nbsp;</td>
        <td width='17%'>&nbsp;</td>
        <td width='53%' id='titlell'>Taxes and Fees</td>
        <td width='11%' id='titlelp'>$ 0.00</td>
        <td width='12%' id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
        <td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>



</div>");
                } else {

                    $mail4->MsgHTML("<head>
							
							<title>Documento sin título</title>
							<style type='text/css'>
							#clearTable {
								width: 800px;
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
							
							
							
							.Estilo1 {color: #FF0000}
							.Estilo2 {
								color: #990000;
								font-weight: bold;
							}
							</style>
							</head><div align='center'>
							<br />
							<table   id='clearTable'> 
								 <tr>
								   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
								   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
								 </tr>
								 <tr>
								   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
								</tr>
								 <tr>
								   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
								 </tr>
								 <tr>
								   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . " </td>
								   <td width='145' height='15' id='titletd6'>&nbsp;</td>
								   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
								 </tr>
								 <tr>
								   <td height='16' id='titletd7'>&nbsp;</td>
								   <td height='16' id='titletd7'>Status: CONFIRMED</td>
								   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
								   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
								 </tr>
								 <tr>
								<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
							  </tr>
							  <tr>
								<td colspan='4' ><table width='90%' height='125' id='tableorder'>
								  <tr>
									<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
									<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
									<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
								  </tr>
								  <tr>
									<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
									<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
								  </tr>
								  <tr>
									<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
									<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
									</tr>
							  </table>
							   
							   <table id='tableorder' width='90%'>
								  <tr>
									<td id='titlett'  width='34%' height='35'  ><strong> Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
									<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
									<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
								  </tr>
								  <tr>
									<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
									<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . "</td>
								  </tr>
								  <tr>
									<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
									<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . ", " . $booking['hotelarea4'] . "</td>
									</tr>
								</table>
							   
							   
								<table id='tableorder2' width='90%'>
								  <tr>
									<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
									  Please arrive at departure point 30 minutes before the scheduled time</td>
									</tr>
								</table>
								<table id='tableorder3' width='90%'>
								  <tr>
									<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
									</tr>
								  <tr>
									<td width='34%' height='28'>Card Holder Information</td>
									<td colspan='2'>Billing Address </td>
								  </tr>
								  <tr>
									<td height='27'>Name : " . $_SESSION['booking']['firsname'] . " </td>
									<td colspan='2'>Address : " . $login->address . "</td>
									 <td colspan='2'>Phone : " . $login->phone . "</td>
								  </tr>
								  <tr>
									<td height='27'>Last Name : " . $_SESSION['booking']['lasname'] . "</td>
									<td colspan='2'>City : " . $login->city . "</td>
								  </tr>
								  <tr>
									<td height='27'>E-mail : " . $login->username2 . "</td>
									<td>State : " . $login->state . "</td>
									<td>Country :" . $login->country . "</td>
								  </tr>
								  <tr>
									<td height='27'>Lead Traveler : " . $_SESSION['booking']['firsname'] . " " . $_SESSION['booking']['lasname'] . "</td>
									<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
								  </tr>
								</table>
								<p><br />
							  </p></td>
							  </tr>
							  <tr>
								<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
							  </tr>
							  <tr>
								<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
								  
								  <tr>
									<td height='31' colspan='5' align='center' id='titlell2'>&nbsp;</td>
								  </tr>
								  
								  <tr>
									<td width='7%'>&nbsp;</td>
									<td width='17%'>&nbsp;</td>
									<td width='53%' id='titlell'>Taxes and Fees</td>
									<td width='11%' id='titlelp'>$ 0.00</td>
									<td width='12%' id='titlelp'>$ 0.00 </td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
									<td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
								  </tr>
								  
								</table>
								  <p>&nbsp;</p>
								<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
								  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
								  THANK YOU FOR CHOOSING US<br />
								  HAVE A NICE TRIP<br />
								  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
								  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
							   
								</p></td>
							  </tr>
							  <tr>
								<td colspan='4' align='center'> <p align='center' class='titulopago'> 
								
							</p>       </td>
							
							  </tr>
							  </table>
							
							
							
							</div>>");
                }
                $mail4->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Errores de cualquier otra cosa.
            }

            unset($mail4);
        }
    }

    public function load_old() {

        Doo::loadModel("Reserve");
        $reserve = new Reserve();
        if (isset($_SESSION["booking"])) {
            if (isset($_POST['ssl_card_number'])) {
                $_SESSION['booking']['card_number'] = $_POST['ssl_card_number'];
            } else {
                $_SESSION['booking']['card_number'] = "N/A";
            }

            if (isset($_SESSION['tipo'])) {
                $tipo = $_SESSION['tipo'];
                $_SESSION['booking']['total2'] = $_SESSION['booking']['totaltotal'];

                if (isset($tipo->agencia) && isset($tipo->otheram)) {
                    $_SESSION['booking']['agen'] = $tipo->agencia;
                    $_SESSION['booking']['agency'] = $tipo->agencia;
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                } else {
                    $_SESSION['booking']['agen'] = "N/A";
                }

                if (isset($tipo->otheram) && isset($tipo->comment)) {
                    $_SESSION['booking']['comments'] = $tipo->comment;
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                }
            }
            $booking = $_SESSION["booking"];

            if (isset($_POST['ssl_txn_id'])) {

                $tipo->pago = "TOTAL AMOUNT PAID";

                $tipo->comment = "PAID ONLINE";
            }



            list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
            $fecha = $anyo . "-" . $mes . "-" . $dia;

            if ($booking['fecha_retorno'] != "N/A") {
                list($mes1, $dia1, $anyo1) = explode("-", $booking['fecha_retorno']);
                $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
            }

            $reserve = new Reserve($booking);

            $new = false;
            $id = "";
            if ($id == "") {
                $reserve->id = Null;
                $new = true;
            } else {
                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
            }


            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $login = $_SESSION['user'];
            if (isset($_SESSION['tipo'])) {
                $reserve->tipo_pago = $tipo->tipo;
            }

            $totalpax = $booking['pax'] + $booking['chil'];

            if ($new) {
                Doo::db()->insert($reserve);
                if ($tipo->comment == "PAGO ONLINE") {
                    try {
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail = new PHPMailer(true);
                        $mail = $datosMail->datos();
                        //La direccion a donde mandamos el correo
                        $mail->AddAddress($login->username, $login->lastname);
                        $tipo_ticket = $booking["tipo_ticket"];

                        if ($tipo_ticket == "oneway") {

                            $mail->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'></td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . " </td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>

        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
      </tr>
      <tr >
        <td width='7%' height='30'>" . $booking['pax'] . "</td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
        <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
      </tr>
      <tr>
        
         
        <td height='27'>" . $booking['chil'] . "</td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
        <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
             
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
        <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
        <td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>



</div>");
                        } else {
                            $mail->MsgHTML("<head>
					
					<title>Documento sin título</title>
					<style type='text/css'>
					#clearTable {
						width: 800px;
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
					
					
					
					</style>
					</head><div align='center'>
					<br />
					<table   id='clearTable'> 
						 <tr>
						   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
						   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
						 </tr>
						 <tr>
						   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
						</tr>
						 <tr>
						   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
						 </tr>
						 <tr>
						   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
						   <td width='145' height='15' id='titletd6'>&nbsp;</td>
						   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
						 </tr>
						 <tr>
						   <td height='16' id='titletd7'></td>
						   <td height='16' id='titletd7'>Status: CONFIRMED</td>
						   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
						   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
						 </tr>
						 <tr>
						<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
					  </tr>
					  <tr>
						<td colspan='4' ><table width='90%' height='125' id='tableorder'>
						  <tr>
							<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
							<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
							<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
						  </tr>
						  <tr>
							<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
						  </tr>
						  <tr>
							<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . ", " . $booking['hotelarea2'] . "</td>
							</tr>
					  </table>
					   
					   <table id='tableorder' width='90%'>
						  <tr>
							<td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
							<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
							<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
						  </tr>
						  <tr>
							<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . " </td>
						  </tr>
						  <tr>
							<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
							</tr>
						</table>
					   
					   
						<table id='tableorder2' width='90%'>
						  <tr>
							<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
							  Please arrive at departure point 30 minutes before the scheduled time</td>
							</tr>
						</table>
						<table id='tableorder3' width='90%'>
						  <tr>
							<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
							</tr>
						  <tr>
							<td width='34%' height='28'>Card Holder Information</td>
							<td colspan='2'>Billing Address </td>
						  </tr>
						  <tr>
							<td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
							<td colspan='2'>Address : " . $login->address . "</td>
							 <td colspan='2'>Phone : " . $login->phone . "</td>
						  </tr>
						  <tr>
							<td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
							<td colspan='2'>City : " . $login->city . "</td>
						  </tr>
						  <tr>
							<td height='27'>E-mail : " . $login->username . "</td>
							<td>State : " . $login->state . "</td>
							<td>Country :" . $login->country . "</td>
						  </tr>
						  <tr>
							<td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
							<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
						  </tr>
						</table>
						<p><br />
					  </p></td>
					  </tr>
					  <tr>
						<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
					  </tr>
					  <tr>
						<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
						  <tr>
							<td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
						  </tr>
						  <tr>
							<td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
						  </tr>
						  <tr >
							<td width='7%' height='30'>" . $booking['pax'] . "</td>
							<td width='17%'>Adults</td>
							<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
							<td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
						  </tr>
						  <tr>
							
							 
							<td height='27'>" . $booking['chil'] . "</td>
							<td>Children (3-9 Years)</td>
							<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp'>$ " . $booking['preciochil'] . "</td>
							<td id='titlelp'>$ " . $booking['totalchil'] . "</td>
								 
						  </tr>
						   <tr>
							<td height='27'></td>
							<td>&nbsp;</td>
							<td id='titlell'> Pick up Point /Drop Off - Extension </td>
							<td id='titlelp'>$ " . $booking['pricexten'] . "</td>
							<td id='titlelp'>$ " . $booking['totalexten'] . "</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td id='titlell'>Taxes and Fees</td>
							<td id='titlelp'>$ 0.00</td>
							<td id='titlelp'>$ 0.00 </td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
							<td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
						  </tr>
						</table>
						  <p>&nbsp;</p>
						<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
						  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
						  THANK YOU FOR CHOOSING US<br />
						  HAVE A NICE TRIP<br />
						  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
						  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
						<div id='agencia' style='display: none;'>Name Agencia
					<input name='agencia' size='20' maxlength='10' class='input-text' id='agencia1' /> </div>
						</p></td>
					  </tr>
					  <tr>
						<td colspan='4' align='center'> <p align='center' class='titulopago'> 
						
					</p>       </td>
					
					  </tr>
					  </table>
					
					
					
					</div>");
                        }


                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
                }
                try {
                    $nombre_destino = 'Admin';
                    Doo::loadController('DatosMailController');
                    $datosMail = new DatosMailController();
                    $mail2 = new PHPMailer(true);
                    $mail2 = $datosMail->datos();
                    //La direccion a donde mandamos el correo
                    $mail2->AddAddress("websales@supertours.com", $nombre_destino);
                    $tipo_ticket = $booking["tipo_ticket"];

                    if ($tipo_ticket == "oneway") {

                        $mail2->MsgHTML("<head>
		  	<title>Documento sin título</title>
					<style type='text/css'>
					#clearTable {
						width: 800px;
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
					
					
					
					.Estilo2 {color: #FF0000}
					.Estilo3 {color: #FFFFFF}
					.Estilo4 {color: #000000; }
					</style>
					</head>
		
		<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
      </tr>
      <tr >
        <td width='7%' height='30'>" . $booking['pax'] . "</td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
        <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
      </tr>
      <tr>
        
         
        <td height='27'>" . $booking['chil'] . "</td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
        <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
        <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo2'  id='titlelr2'> " . $tipo->pago . "</td>
        <td id='titlelr2'><span class='Estilo2'><strong>$  " . $booking['totaltotal'] . " </strong></span></td>
      </tr>
      <tr>
        <td>Comments</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo4'  id='titlelr'><p>" . $tipo->comment . "</p>
          <p>&nbsp;</p></td>
        <td class='Estilo3' id='titlelr'>" . $_SESSION['booking']['card_number'] . "</td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>


</div>");
                    } else {
                        $mail2->MsgHTML("<head>
				
				<title>Documento sin título</title>
				<style type='text/css'>
				#clearTable {
					width: 800px;
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
				
				
				
				.Estilo1 {color: #FF0000}
				.Estilo2 {
					color: #990000;
					font-weight: bold;
				}
				</style>
				</head><div align='center'>
				<br />
				<table   id='clearTable'> 
					 <tr>
					   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
					   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
					 </tr>
					 <tr>
					   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
					</tr>
					 <tr>
					   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
					 </tr>
					 <tr>
					   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
					   <td width='145' height='15' id='titletd6'>&nbsp;</td>
					   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
					 </tr>
					 <tr>
					   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
					   <td height='16' id='titletd7'>Status: CONFIRMED</td>
					   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
					   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
					 </tr>
					 <tr>
					<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
				  </tr>
				  <tr>
					<td colspan='4' ><table width='90%' height='125' id='tableorder'>
					  <tr>
						<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
						<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
						<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
					  </tr>
					  <tr>
						<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
						<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
					  </tr>
					  <tr>
						<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
						<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
						</tr>
				  </table>
				   
				   <table id='tableorder' width='90%'>
					  <tr>
						<td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
						<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
						<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
					  </tr>
					  <tr>
						<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
						<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . "  , " . $booking['hotelarea3'] . "</td>
					  </tr>
					  <tr>
						<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
						<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
						</tr>
					</table>
				   
				   
					<table id='tableorder2' width='90%'>
					  <tr>
						<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
						  Please arrive at departure point 30 minutes before the scheduled time</td>
						</tr>
					</table>
					<table id='tableorder3' width='90%'>
					  <tr>
						<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
						</tr>
					  <tr>
						<td width='34%' height='28'>Card Holder Information</td>
						<td colspan='2'>Billing Address </td>
					  </tr>
					  <tr>
						<td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
						<td colspan='2'>Address : " . $login->address . "</td>
						 <td colspan='2'>Phone : " . $login->phone . "</td>
					  </tr>
					  <tr>
						<td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
						<td colspan='2'>City : " . $login->city . "</td>
					  </tr>
					  <tr>
						<td height='27'>E-mail : " . $login->username . "</td>
						<td>State : " . $login->state . "</td>
						<td>Country :" . $login->country . "</td>
					  </tr>
					  <tr>
						<td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
						<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
					  </tr>
					</table>
					<p><br />
				  </p></td>
				  </tr>
				  <tr>
					<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
				  </tr>
				  <tr>
					<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
					  <tr>
						<td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
					  </tr>
					  <tr>
						<td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
					  </tr>
					  <tr >
						<td width='7%' height='30'>" . $booking['pax'] . "</td>
						<td width='17%'>Adults</td>
						<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
						<td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
						<td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
					  </tr>
					  <tr>
						
						 
						<td height='27'>" . $booking['chil'] . "</td>
						<td>Children (3-9 Years)</td>
						<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
						<td id='titlelp'>$ " . $booking['preciochil'] . "</td>
						<td id='titlelp'>$ " . $booking['totalchil'] . "</td>
					  </tr>
					   <tr>
						<td height='27'></td>
						<td>&nbsp;</td>
						<td id='titlell'> Pick up Point /Drop Off - Extension </td>
						<td id='titlelp'>$ " . $booking['pricexten'] . "</td>
						<td id='titlelp'>$ " . $booking['totalexten'] . "</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td id='titlell'>Taxes and Fees</td>
						<td id='titlelp'>$ 0.00</td>
						<td id='titlelp'>$ 0.00 </td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
						<td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
					  </tr>
					  <tr>
						<td>Comments</td>
						<td>&nbsp;</td>
						<td  id='titlelr' align='center' colspan='2'><p>" . $tipo->comment . "</p>
						  <p>&nbsp;</p></td>
						<td id='titlelr'>" . $_SESSION['booking']['card_number'] . "</td>
					  </tr>
					</table>
					  <p>&nbsp;</p>
					<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
					  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
					  THANK YOU FOR CHOOSING US<br />
					  HAVE A NICE TRIP<br />
					  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
					  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
				   
					</p></td>
				  </tr>
				  <tr>
					<td colspan='4' align='center'> <p align='center' class='titulopago'> 
					
				</p>       </td>
				
				  </tr>
				  </table>
				
				
				
				</div>");
                    }

                    $mail2->Send();
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Errores de PhpMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Errores de cualquier otra cosa.
                }

/////////////////////////////////////////////////////////				 




                if ($login->username == "operador1@supertours.com" || $login->username == "operador2@supertours.com" || $login->username == "operador3@supertours.com") {

                    try {
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail3 = new PHPMailer(true);
                        $mail3 = $datosMail->datos();
                        //La direccion a donde mandamos el correo
                        $mail3->AddAddress($login->username, "Super Tours OF Orlando");
                        $tipo_ticket = $booking["tipo_ticket"];

                        if ($tipo_ticket == "oneway") {

                            $mail3->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



.Estilo2 {color: #FF0000}
.Estilo3 {color: #FFFFFF}
.Estilo4 {color: #000000; }
</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>

  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
      </tr>
      <tr >
        <td width='7%' height='30'>" . $booking['pax'] . "</td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
        <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
      </tr>
      <tr>
        
         
        <td height='27'>" . $booking['chil'] . "</td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
        <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
        <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
        <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo2'  id='titlelr2'> " . $tipo->pago . "</td>
        <td id='titlelr2'><span class='Estilo2'><strong>$  " . $booking['totaltotal'] . " </strong></span></td>
      </tr>
      <tr>
        <td>Comments</td>
        <td>&nbsp;</td>
        <td colspan='2' align='center' class='Estilo4'  id='titlelr'><p>" . $tipo->comment . "</p>
          <p>&nbsp;</p></td>
        <td class='Estilo3' id='titlelr'>&nbsp;</td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>


</div>");
                        } else {
                            $mail3->MsgHTML("<head>
					
					<title>Documento sin título</title>
					<style type='text/css'>
					#clearTable {
						width: 800px;
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
					
					
					
					.Estilo1 {color: #FF0000}
					.Estilo2 {
						color: #990000;
						font-weight: bold;
					}
					</style>
					</head><div align='center'>
					<br />
					<table   id='clearTable'> 
						 <tr>
						   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
						   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
						 </tr>
						 <tr>
						   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
						</tr>
						 <tr>
						   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
						 </tr>
						 <tr>
						   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
						   <td width='145' height='15' id='titletd6'>&nbsp;</td>
						   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
						 </tr>
						 <tr>
						   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
						   <td height='16' id='titletd7'>Status: CONFIRMED</td>
						   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
						   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
						 </tr>
						 <tr>
						<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
					  </tr>
					  <tr>
						<td colspan='4' ><table width='90%' height='125' id='tableorder'>
						  <tr>
							<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
							<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
							<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
						  </tr>
						  <tr>
							<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
						  </tr>
						  <tr>
							<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
							</tr>
					  </table>
					   
					   <table id='tableorder' width='90%'>
						  <tr>
							<td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
							<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
							<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
						  </tr>
						  <tr>
							<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
							<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . "</td>
						  </tr>
						  <tr>
							<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
							<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
							</tr>
						</table>
					   
					   
						<table id='tableorder2' width='90%'>
						  <tr>
							<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
							  Please arrive at departure point 30 minutes before the scheduled time</td>
							</tr>
						</table>
						<table id='tableorder3' width='90%'>
						  <tr>
							<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
							</tr>
						  <tr>
							<td width='34%' height='28'>Card Holder Information</td>
							<td colspan='2'>Billing Address </td>
						  </tr>
						  <tr>
							<td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
							<td colspan='2'>Address : " . $login->address . "</td>
							 <td colspan='2'>Phone : " . $login->phone . "</td>
						  </tr>
						  <tr>
							<td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
							<td colspan='2'>City : " . $login->city . "</td>
						  </tr>
						  <tr>
							<td height='27'>E-mail : " . $login->username . "</td>
							<td>State : " . $login->state . "</td>
							<td>Country :" . $login->country . "</td>
						  </tr>
						  <tr>
							<td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
							<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
						  </tr>
						</table>
						<p><br />
					  </p></td>
					  </tr>
					  <tr>
						<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
					  </tr>
					  <tr>
						<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
						  <tr>
							<td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
						  </tr>
						  <tr>
							<td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
						  </tr>
						  <tr >
							<td width='7%' height='30'>" . $booking['pax'] . "</td>
							<td width='17%'>Adults</td>
							<td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
							<td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
						  </tr>
						  <tr>
							
							 
							<td height='27'>" . $booking['chil'] . "</td>
							<td>Children (3-9 Years)</td>
							<td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
							<td id='titlelp'>$ " . $booking['preciochil'] . "</td>
							<td id='titlelp'>$ " . $booking['totalchil'] . "</td>
						  </tr>
						   <tr>
							<td height='27'></td>
							<td>&nbsp;</td>
							<td id='titlell'> Pick up Point /Drop Off - Extension </td>
							<td id='titlelp'>$ " . $booking['pricexten'] . "</td>
							<td id='titlelp'>$ " . $booking['totalexten'] . "</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td id='titlell'>Taxes and Fees</td>
							<td id='titlelp'>$ 0.00</td>
							<td id='titlelp'>$ 0.00 </td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
							<td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
						  </tr>
						  <tr>
							<td>Comments</td>
							<td>&nbsp;</td>
							<td  id='titlelr' align='center' colspan='2'><p>" . $tipo->comment . "</p>
							  <p>&nbsp;</p></td>
							<td id='titlelr'>&nbsp;</td>
						  </tr>
						</table>
						  <p>&nbsp;</p>
						<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
						  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
						  THANK YOU FOR CHOOSING US<br />
						  HAVE A NICE TRIP<br />
						  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
						  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
					   
						</p></td>
					  </tr>
					  <tr>
						<td colspan='4' align='center'> <p align='center' class='titulopago'> 
						
					</p>       </td>
					
					  </tr>
					  </table>
					
					
					
					</div>");
                        }

                        $mail3->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
                }





/////////////////////////////////////////////////////////				 

                if ($login->tipo_client == 3) {
                    try {
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail4 = new PHPMailer(true);
                        $mail4 = $datosMail->datos();
                        //La direccion a donde mandamos el correo
                        $mail4->AddAddress($login->username2, "Supertours Of Orlando");
                        if ($tipo_ticket == "oneway") {
                            $mail4->MsgHTML("<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
     </tr>
     <tr>
       <td height='16' id='titletd7'>&nbsp;</td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $login->username2 . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' >&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      
      <tr>
        <td width='7%'>&nbsp;</td>
        <td width='17%'>&nbsp;</td>
        <td width='53%' id='titlell'>Taxes and Fees</td>
        <td width='11%' id='titlelp'>$ 0.00</td>
        <td width='12%' id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
        <td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>



</div>");
                        } else {

                            $mail4->MsgHTML("<head>
							
							<title>Documento sin título</title>
							<style type='text/css'>
							#clearTable {
								width: 800px;
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
							
							
							
							.Estilo1 {color: #FF0000}
							.Estilo2 {
								color: #990000;
								font-weight: bold;
							}
							</style>
							</head><div align='center'>
							<br />
							<table   id='clearTable'> 
								 <tr>
								   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
								   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
								 </tr>
								 <tr>
								   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
								</tr>
								 <tr>
								   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
								 </tr>
								 <tr>
								   <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . " </td>
								   <td width='145' height='15' id='titletd6'>&nbsp;</td>
								   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
								 </tr>
								 <tr>
								   <td height='16' id='titletd7'>&nbsp;</td>
								   <td height='16' id='titletd7'>Status: CONFIRMED</td>
								   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
								   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
								 </tr>
								 <tr>
								<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
							  </tr>
							  <tr>
								<td colspan='4' ><table width='90%' height='125' id='tableorder'>
								  <tr>
									<td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
									<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
									<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
								  </tr>
								  <tr>
									<td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
									<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
								  </tr>
								  <tr>
									<td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
									<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
									</tr>
							  </table>
							   
							   <table id='tableorder' width='90%'>
								  <tr>
									<td id='titlett'  width='34%' height='35'  ><strong> Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
									<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
									<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
								  </tr>
								  <tr>
									<td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
									<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . "</td>
								  </tr>
								  <tr>
									<td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
									<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . ", " . $booking['hotelarea4'] . "</td>
									</tr>
								</table>
							   
							   
								<table id='tableorder2' width='90%'>
								  <tr>
									<td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
									  Please arrive at departure point 30 minutes before the scheduled time</td>
									</tr>
								</table>
								<table id='tableorder3' width='90%'>
								  <tr>
									<td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
									</tr>
								  <tr>
									<td width='34%' height='28'>Card Holder Information</td>
									<td colspan='2'>Billing Address </td>
								  </tr>
								  <tr>
									<td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
									<td colspan='2'>Address : " . $login->address . "</td>
									 <td colspan='2'>Phone : " . $login->phone . "</td>
								  </tr>
								  <tr>
									<td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
									<td colspan='2'>City : " . $login->city . "</td>
								  </tr>
								  <tr>
									<td height='27'>E-mail : " . $login->username2 . "</td>
									<td>State : " . $login->state . "</td>
									<td>Country :" . $login->country . "</td>
								  </tr>
								  <tr>
									<td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
									<td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
								  </tr>
								</table>
								<p><br />
							  </p></td>
							  </tr>
							  <tr>
								<td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
							  </tr>
							  <tr>
								<td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
								  
								  <tr>
									<td height='31' colspan='5' align='center' id='titlell2'>&nbsp;</td>
								  </tr>
								  
								  <tr>
									<td width='7%'>&nbsp;</td>
									<td width='17%'>&nbsp;</td>
									<td width='53%' id='titlell'>Taxes and Fees</td>
									<td width='11%' id='titlelp'>$ 0.00</td>
									<td width='12%' id='titlelp'>$ 0.00 </td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
									<td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
								  </tr>
								  
								</table>
								  <p>&nbsp;</p>
								<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
								  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
								  THANK YOU FOR CHOOSING US<br />
								  HAVE A NICE TRIP<br />
								  SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
								  Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
							   
								</p></td>
							  </tr>
							  <tr>
								<td colspan='4' align='center'> <p align='center' class='titulopago'> 
								
							</p>       </td>
							
							  </tr>
							  </table>
							
							
							
							</div>");
                        }
                        $mail4->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
                }

                if (isset($_POST['ssl_txn_id'])) {

                    $this->renderc('approval', $this->data, true);
                }
            } else {
                Doo::db()->update($reserve);




                /* $mainController=new MainController();

                  $mainController->saveregreso();
                  $mainController->saveida(); */

                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
            }

            $this->renderc('approval', $this->data, true);
            unset($_SESSION['booking']);
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function reserve() {

        if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
            $firsname = $_POST['firstname'];
            $lasname = $_POST['lastname'];
        }

        if (isset($_SESSION["booking"])) {

            $booking = $_SESSION["booking"];
            $tipo_ticket = $booking["tipo_ticket"];
            $fecha_ini = $booking["fecha_ini"];
            $from = $booking["fromt"];
            $to = $booking["tot"];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
            $pax = $booking["pax"];
            $pax2 = $booking["pax2"];
            $pickup1 = $booking["pickup1"];
            $dropoff1 = $booking["dropoff1"];
            $trip_no = $booking['trip_no'];
            $pickup2 = $booking["pickup2"];
            $dropoff2 = $booking["dropoff2"];
            $id_clientes = $booking['id_clientes'];
            $trip_no2 = $booking["trip_no2"];
            $price = $booking['price'];
            $price2 = $booking['price2'];
            $total = $booking['total'];
            $codconf = $booking['codconf'];
            $hora = $booking['hora'];
        }


        $booking = array(
            "tipo_ticket" => $tipo_ticket,
            "fecha_ini" => $fecha_ini,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "pax" => $pax,
            "pax2" => $pax2,
            "trip_no" => $trip_no,
            "pickup1" => $pickup1,
            "dropoff1" => $dropoff1,
            "id_clientes" => $id_clientes,
            "firsname" => $firsname,
            "lasname" => $lasname,
            "pickup2" => $pickup2,
            "dropoff2" => $dropoff2,
            "trip_no2" => $trip_no2,
            "price" => $price,
            "price2" => $price2,
            "total" => $total,
            "codconf" => $codconf,
            "hora" => $hora,
        );



        $_SESSION["booking"] = $booking;



        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/reserva/load";
        /*
         */
    }

    public function tipoclient() {



        if (isset($_SESSION["booking"]) && isset($_SESSION['user'])) {

            $login = $_SESSION['user'];
            $tipo = new stdclass();
            if (isset($_POST['firstname']) && isset($_POST['lastname'])) {

                $_SESSION['booking']['firsname'] = $_POST['firstname'];
                $_SESSION['booking']['lasname'] = $_POST['lastname'];
                if (isset($_POST['email'])) {
                    $_SESSION['booking']['email'] = $_POST['email'];
                }

                if (isset($_POST['comments'])) {
                    $comments = $_POST['comments'];
                    $tipo->comment = $comments;
                }
            }

            if (isset($_POST['celphone']) && isset($_POST['email'])) {

                $login->phone = $_POST['celphone'];
                $login->username2 = $_POST['email'];
            }


            if (isset($_POST['pago'])) {

                if ($_POST['pago'] == "Collect") {


                    $tipo->tipo = "Collect";
                    $tipo->pago = "PLEASE PAY DRIVER";
                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "OtherAmount") {
                    $total = $_POST['amount2'];



                    $tipo->tipo = "Collect";
                    $tipo->otheram = $total;
                    $tipo->pago = "PLEASE PAY DRIVER";

                    $_SESSION['tipo'] = $tipo;


                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "voucher") {

                    $total = $_POST['amount'];
                    $agencia = $_POST['agencia'];

                    $tipo->tipo = "Voucher";
                    $tipo->otheram = $total;
                    $tipo->agencia = $agencia;
                    $tipo->pago = "PLEASE PAY DRIVER";

                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "credicard") {
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->renderc('pago2', $this->data, true);
                }
            } else {
                $tipo->tipo = "Credit Card";
                $_SESSION['tipo'] = $tipo;
                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/pago";
            }
        }
    }

    public function tipoclient_old() {

        if (isset($_SESSION["booking"]) && isset($_SESSION['user'])) {

            $login = $_SESSION['user'];
            $tipo = new stdclass();
            if (isset($_POST['firstname']) && isset($_POST['lastname'])) {

                $_SESSION['booking']['firstname'] = $_POST['firstname'];
                $_SESSION['booking']['lastname'] = $_POST['lastname'];

                if (isset($_POST['comments'])) {
                    $comments = $_POST['comments'];
                    $tipo->comment = $comments;
                }
            }

            if (isset($_POST['celphone']) && isset($_POST['email'])) {

                $login->phone = $_POST['celphone'];
                $login->username2 = $_POST['email'];
            }


            if (isset($_POST['pago'])) {

                if ($_POST['pago'] == "Collect") {
                    $tipo->tipo = "Collect";
                    $tipo->pago = "PLEASE PAY DRIVER";
                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "OtherAmount") {
                    $total = $_POST['amount2'];
                    $tipo->tipo = "Collect";
                    $tipo->otheram = $total;
                    $tipo->pago = "PLEASE PAY DRIVER";
                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "voucher") {

                    $total = $_POST['amount'];
                    $agencia = $_POST['agencia'];


                    $tipo->tipo = "Voucher";
                    $tipo->otheram = $total;
                    $tipo->agencia = $agencia;
                    $tipo->pago = "PLEASE PAY DRIVER";

                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "credicard") {
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->renderc('pago2', $this->data, true);
                }
            } else {
                $tipo->tipo = "Credit Card";
                $tipo->comment = "PAY ONLINE";
                $_SESSION['tipo'] = $tipo;
                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/pago";
            }
        }
    }

    public function confir() {

        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
        }

        if (isset($_SESSION["user"]) && isset($_SESSION["booking"])) {

            $booking = $_SESSION["booking"];
            if (isset($booking["pickup1"])) {
                $mainController = new MainController();
                $hor = date("is");
                list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
                $salida = $anyo . "-" . $mes . "-" . $dia;
                if (isset($_SESSION["booking"])) {
                    $booking = $_SESSION["booking"];
                    $tipo_ticket = $booking["tipo_ticket"];
                    $from = $booking["fromt"];
                    $to = $booking["tot"];
                    $fecha_salida = $booking["fecha_salida"];
                    $fecha_retorno = $booking["fecha_retorno"];
                    $pax = $booking["pax"];
                    $pickup1 = $booking["pickup1"];
                    $dropoff1 = $booking["dropoff1"];
                    $trip_no = $booking['trip_no'];
                    $pickup2 = $booking["pickup2"];
                    $dropoff2 = $booking["dropoff2"];
                    $trip_no2 = $booking["trip_no2"];
                    $price = $booking['price'];
                    $price2 = $booking['price2'];
                }

                Doo::loadController('admin/ReservasController');
                $reserveControl = new ReservasController();
                $codconf = $reserveControl->codigoConf(1);

                $sql = "select 
                              t1.trip_no,
                              t2.id,
                              t1.fecha, 
                              t4.nombre as trip_from, 
                              t5.nombre as trip_to, 
                              t2.price, 
                              t2.price2, 
                              t2.trip_departure, 
                              t2.trip_arrival,
                              t3.equipment,
                             t1.estado 
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND fecha > curdate() and t1.estado = '1'";

                if ($net_rate) {
                    $sql_net = "select
                              t1.trip_no,
                              t2.id,
                              t1.fecha, 
                              t4.nombre as trip_from, 
                              t5.nombre as trip_to, 
                              t2.price, 
                              t2.price2, 
                              t2.trip_departure, 
                              t2.trip_arrival,
                              t3.equipment,
                             t1.estado 
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.type_rate = 2 and t2.id_agency = '$dat->id' and t2.trip_from = '$from' AND t2.trip_to = '$to' and fecha = '$fecha_salida' AND fecha > curdate() and t1.estado = '1'";


                    $sql = "Select
                              ms.trip_no,
                              ms.id,
                              ms.fecha, 
                              ms.trip_from, 
                              ms.trip_to, 
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price 
       ELSE ms.price
   END as price ,
CASE 
      WHEN ms.trip_no = k.trip_no THEN k.price2 
       ELSE ms.price2
   END as price2,
 ms.trip_departure, 
 ms.trip_arrival,
 ms.equipment,
 ms.estado     
 From ( " . $sql . " )as ms  LEft JOIN ( " . $sql_net . " ) as k ON (ms.trip_no = k.trip_no)";
                }
                $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));



                //    $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));




                $salida = $rs->fetchAll();

                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($from),
                    "limit" => 1));
                $from_name = $rs->nombre;

                if ($tipo_ticket == "roundtrip") {
                    $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
                    $retorno = $rs->fetchAll();
                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }
                if ($tipo_ticket == "oneway") {
                    $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
                    $retorno = $rs->fetchAll();
                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }


                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['from_name'] = $from_name;
                $this->data['to_name'] = $to_name;

                $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));


                /* /////////////////////////////////////////////////////// */

                $fecha_ini = date("M-d-Y");
                $hora = date("H:i:s");


                $booking = $_SESSION['booking'];

                $login = $_SESSION['user'];

                if ($booking["tipo_ticket"] == "oneway") {

                    if ($from_name == "ORLANDO") {
                        if ($booking['exten'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:45"));
                        }


                        if ($booking['exten'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                        if ($booking['exten'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                    }
                }

                if ($booking["tipo_ticket"] == "roundtrip") {

                    if ($to_name == "ORLANDO") {

                        if ($booking['exten1'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:45"));
                        }


                        if ($booking['exten1'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:30"));
                        }
                        if ($booking['exten1'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:30"));
                        }
                    }

                    if ($from_name == "ORLANDO") {

                        if ($booking['exten'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:45"));
                        }


                        if ($booking['exten'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                        if ($booking['exten'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                    }
                }



                if ($booking["tipo_ticket"] == "oneway") {
                    $booking['fecha_retorno'] = "N/A";
                    $booking['pickup2'] = "N/A";
                    $booking['dropoff2'] = "N/A";
                    $booking['trip_no2'] = "N/A";
                    $pax2 = "N/A";
                    ///////////////////////////////////   
                    if (isset($_SESSION['user']) && isset($booking['pricer'])) {
                        $login = $_SESSION['user'];
                        if ($booking['resident'] == 1) {
                            $booking['totaladul'] = $booking['priceadult'] * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');
                            $booking['precioadul'] = ( $booking['priceadult'] );
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');
                            $booking['preciochil'] = ( $booking['pricechil']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                            $booking['totalchil'] = $booking['pricechil'] * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');
                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];
                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');
                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Florida Residents Rate Express Service";
                            $booking['ticke'] = "One Way Trip";
                        } else {


                            $booking['totaladul'] = $booking['price'] * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['price'] );
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = $booking['pricer'] * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Regular Ticket Rate Express Service";
                            $booking['ticke'] = "One Way Trip";
                        }
                    }
                    if ($booking['chil'] == 0) {
                        $booking['preciochil'] = 0.00;
                        $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                    }
                    ////////////////////


                    $comision_agency = (!$net_rate) ? ($booking['totaltotal'] * (($this->cal_equipament($booking['trip_no'])) / 100)) : 0.00;
                    $booking = array(
                        "tipo_ticket" => $booking['tipo_ticket'],
                        "fecha_ini" => $fecha_ini,
                        "fromt" => $booking['fromt'],
                        "tot" => $booking['tot'],
                        "fecha_salida" => $booking['fecha_salida'],
                        "fecha_retorno" => $booking['fecha_retorno'],
                        "pax" => $booking['pax'],
                        "pax2" => $pax2,
                        "exten" => $booking['exten'],
                        "to_name" => $this->data['to_name'],
                        "from_name" => $this->data['from_name'],
                        "totaladul" => $booking['totaladul'],
                        "precioadul" => $booking['precioadul'],
                        "pricechil" => $booking['pricechil'],
                        "preciochil" => $booking['preciochil'],
                        "totalchil" => $booking['totalchil'],
                        "pricexten" => $booking['pricexten'],
                        "totalexten" => $booking['totalexten'],
                        "totaltotal" => $booking['totaltotal'],
                        "comision_agency" => $comision_agency,
                        "balance" => $booking['totaltotal'] - $comision_agency,
                        "resident" => $booking['resident'],
                        "residente" => $booking['residente'],
                        "ticke" => $booking['ticke'],
                        "priceadult" => $booking['priceadult'],
                        "price" => $booking['price'],
                        "trip_no" => $booking['trip_no'],
                        "pickup1" => $booking['pickup1'],
                        "dropoff1" => $booking['dropoff1'],
                        "id_clientes" => $login->id,
                        "pickup2" => $booking['pickup2'],
                        "dropoff2" => $booking['dropoff2'],
                        "trip_no2" => $booking['trip_no2'],
                        "price2" => $booking['price2'],
                        "pricechil" => $booking['pricechil'],
                        "codconf" => $codconf,
                        "hora" => $hora,
                        "pricer" => $booking['pricer'],
                        "extension1" => $booking['extension1'],
                        "extension3" => $booking['extension3'],
                        "extension2" => $booking['extension2'],
                        "extension4" => $booking['extension4'],
                        "precio_e1" => $booking['precio_e1'],
                        "precio_e2" => $booking['precio_e2'],
                        "precio_e3" => $booking['precio_e3'],
                        "precio_e4" => $booking['precio_e4'],
                        "trip_arrival" => $booking['trip_arrival'],
                        "trip_departure" => $booking['trip_departure'],
                        "trip_arrival2" => $booking['trip_arrival2'],
                        "trip_departure2" => $booking['trip_departure2'],
                        "place1" => $booking['place1'],
                        "address1" => $booking['address1'],
                        "chil" => $booking['chil'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "zip" => $booking['zip'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "hotelarea3" => $booking['hotelarea3'],
                        "hotelarea4" => $booking['hotelarea4']
                    );


                    $_SESSION["booking"] = $booking;


                    $booking = $_SESSION['booking'];
                } else {

                    if (isset($_SESSION['user'])) {
                        $login = $_SESSION['user'];

                        if ($booking['resident'] == 1) {

                            $booking['totaladul'] = ($booking['priceadult'] + $booking['2priceadult'] ) * ($booking['pax'] );
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['priceadult'] + $booking['2priceadult']);
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricechil'] + $booking['2pricechil']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = ($booking['pricechil'] + $booking['2pricechil']) * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Florida Residents Rate Express Service";
                            $booking['ticke'] = "Round Trip";
                        } else {


                            $booking['totaladul'] = ($booking['price'] + $booking['2price']) * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['price'] + $booking['2price']);
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricer'] + $booking['2pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = ($booking['pricer'] + $booking['2pricer']) * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Regular Ticket Rate Express Service";
                            $booking['ticke'] = "Round Trip";
                        }
                    }

                    if ($booking['chil'] == 0) {
                        $booking['preciochil'] = 0.00;
                        $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                    }
                    $comision_agency = (!$net_rate) ? ($booking['totaltotal'] * (($this->cal_equipament($booking['trip_no']) + $this->cal_equipament($booking['trip_no2'])) / 100)) / 2 : 0.00;
                    $booking = array(
                        "tipo_ticket" => $booking['tipo_ticket'],
                        "fecha_ini" => $fecha_ini,
                        "fromt" => $booking['fromt'],
                        "tot" => $booking['tot'],
                        "fecha_salida" => $booking['fecha_salida'],
                        "fecha_retorno" => $booking['fecha_retorno'],
                        "pax" => $booking['pax'],
                        "exten" => $booking['exten'],
                        "exten1" => $booking['exten1'],
                        "to_name" => $this->data['to_name'],
                        "from_name" => $this->data['from_name'],
                        "pax2" => $booking['pax'],
                        "resident" => $booking['resident'],
                        "totaladul" => $booking['totaladul'],
                        "precioadul" => $booking['precioadul'],
                        "pricechil" => $booking['pricechil'],
                        "preciochil" => $booking['preciochil'],
                        "2pricechil" => $booking['2pricechil'],
                        "totalchil" => $booking['totalchil'],
                        "pricexten" => $booking['pricexten'],
                        "totalexten" => $booking['totalexten'],
                        "totaltotal" => $booking['totaltotal'],
                        "comision_agency" => $comision_agency,
                        "balance" => $booking['totaltotal'] - $comision_agency,
                        "resident" => $booking['resident'],
                        "residente" => $booking['residente'],
                        "ticke" => $booking['ticke'],
                        "price" => $booking['price'],
                        "2price" => $booking['2price'],
                        "trip_no" => $booking['trip_no'],
                        "pickup1" => $booking['pickup1'],
                        "dropoff1" => $booking['dropoff1'],
                        "priceadult" => $booking['priceadult'],
                        "2priceadult" => $booking['2priceadult'],
                        "id_clientes" => $login->id,
                        "pickup2" => $booking['pickup2'],
                        "dropoff2" => $booking['dropoff2'],
                        "trip_no2" => $booking['trip_no2'],
                        "price2" => $booking['price2'],
                        "codconf" => $codconf,
                        "hora" => $hora,
                        "pricer" => $booking['pricer'],
                        "2pricer" => $booking['2pricer'],
                        "extension1" => $booking['extension1'],
                        "extension3" => $booking['extension3'],
                        "extension2" => $booking['extension2'],
                        "extension4" => $booking['extension4'],
                        "precio_e1" => $booking['precio_e1'],
                        "precio_e2" => $booking['precio_e2'],
                        "precio_e3" => $booking['precio_e3'],
                        "precio_e4" => $booking['precio_e4'],
                        "trip_arrival" => $booking['trip_arrival'],
                        "trip_departure" => $booking['trip_departure'],
                        "trip_arrival2" => $booking['trip_arrival2'],
                        "trip_departure2" => $booking['trip_departure2'],
                        "place2" => $booking['place2'],
                        "place1" => $booking['place1'],
                        "address1" => $booking['address1'],
                        "address2" => $booking['address2'],
                        "chil" => $booking['chil'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "zip" => $booking['zip'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "hotelarea3" => $booking['hotelarea3'],
                        "hotelarea4" => $booking['hotelarea4']
                    );

                    $_SESSION["booking"] = $booking;


                    $booking = $_SESSION['booking'];
                }
                if (!isset($_SESSION['data_agency'])) {
                    #cotizacion 
                    try {
                        $contenido .= print_r($_SESSION, true);
                        $contenido .= "<span style='color:red;'>Cotizacion Transportation </span>";
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $correo_emisor = "websales@supertours.com";
                        $nombre_emisor = "Supertours Of Orlando";
                        $contrasena = "Daniel4";
                        //$mail->SMTPDebug  = 2;                  
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = "tsl";                
                        $mail->SMTPSecure = "ssl";
                        $mail->Host = "smtpout.secureserver.net";
                        $mail->Port = 465;
                        $mail->Username = $correo_emisor;
                        $mail->Password = $contrasena;
                      //  $mail->AddReplyTo($correo_emisor, $nombre_emisor);
                        $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                        $mail->Subject = 'Supertours Of Orlando, Cotizacion Transportation -' . date("d-m-Y h:i:s");
                        $mail->AltBody = 'Supertours Of Orlando, Cotizacion Transportation -' . date("d-m-Y h:i:s");
                        $mail->AddAddress("angel.valenciaa@gmail.com", "");
                        $mail->MsgHTML($contenido);
                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); // Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); // Errores de cualquier otra cosa.
                    }
                    #fin de cotizacion
                    $this->renderc('shoproute', $this->data, true);
                } else {
                    if ($dat->type_rate == 0) {
                        $_SESSION['agency_fee'] = $booking['comision_agency'];
                    }
                    Doo::loadController("AgenciaController");
                    $agenControl = new AgenciaController();
                    $disponible = $agenControl->iscredit();
                    $this->data['disponible'] = $disponible;
                    $this->renderc('shoproute_agency', $this->data, true);
                }
            } else {
                return Doo::conf()->APP_URL . "booking/pickup-dropoff";
            }
        } else {

            return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication";
        }
    }

    public function signup() {

        Doo::loadModel("Signup");
        $signup = new Signup();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['signup'] = $signup;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));

        $this->renderc('pruesignup', $this->data);
    }

    public function save() {

        Doo::loadModel("Signup");

        $signup = new Signup($_POST);
        $signup->password = trim($signup->password);
        $signup->fecha_r = date("m-d-Y  H:i:s");

        $sql = "SELECT username FROM clientes WHERE  username = ?";
        //Registered user
        $signup2 = new stdclass();
        $signup2->username = $signup->username;
        $signup2->firstname = $signup->firstname;
        $signup2->lastname = $signup->lastname;

        //Billing address
        $signup2->address = $signup->address;
        $signup2->city = $signup->city;
        $signup2->zip = $signup->zip;
        $signup2->phone = $signup->phone;
        $signup2->celphone = $signup->celphone;


        $signup2->error = "";

        $_SESSION['signup2'] = $signup2;


        $rs = Doo::db()->query($sql, array($signup->username));
        $reci = $rs->fetch();

        if ($reci != NUll) {

            return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/signup/slope";
        } else {

            $new = false;
            if ($signup->birthday != "") {

                $signup->tipo_client = 1;
            } else {
                $signup->tipo_client = 0;
            }
            if ($_POST['id'] == "") {
                $signup->id = Null;
                $new = true;
            }

            $this->data['rootUrl'] = Doo::conf()->APP_URL;

            if ($new) {
                Doo::db()->insert($signup);


                if (isset($_POST['username']) && isset($_POST['firstname'])) {


                    if ($signup->tipo_client == 1) {



                        try {
                            Doo::loadController('DatosMailController');
                            $datosMail = new DatosMailController();
                            $mail = new PHPMailer(true);
                            $mail = $datosMail->datos();
                            //La direccion a donde mandamos el correo
                            $nombre_destino = 'Supertours Of Orlando';
                            $mail->AddAddress($signup->username, $nombre_destino);
                            //De parte de quien es el correo
                            $mail->Subject = 'Signup / Supertours Of Orlando';
                            //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                            $mail->AltBody = 'Signup / Supertours Of Orlando';

                            $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>SUPER CLUB</td>
     </tr>
     <tr>
       
       
       <td colspan='2' align='center' id='titletd6'>Welcome, " . $_POST['username'] . " you are a member of the SUPERCLUB <br />
         The incentive program for frequent passengers <br />
       of SUPER TOURS OF ORLANDO, Inc.</td>
    </tr>
   
     
  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>MEMBER NAME:</td>
        <td colspan='2'>" . $_POST['firstname'] . " " . $_POST['lastname'] . "</td>
      </tr>
      <tr>
        <td height='31'>MEMBER SINCE:</td>
        <td colspan='2'>JUN. 12-2012 / 13:32</td>
      </tr>
      <tr>
        <td height='27'>USERNAME:</td>
        <td colspan='2'>" . $_POST['username'] . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $signup->password . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='37' colspan='4' align='center' id='titletd' ><strong>REDWARS</strong></td>
  </tr>
  
  </tr>
  <tr>
    <td colspan='4'> From this moment you are an official member of our company and you will receive the following benefits:
</td>
  <tr>
    <td colspan='4'>&bull;  A FREE ticket, after 10 trips paid</td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  A free ticket on your birthday week (you will get this benefit after having traveled for at least one year with us)</td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  Exclusive offers for members of SUPER CLUB </td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819 <br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com  
    
</p>       </td>
  </tr>
  </table>



</div>");
                            $mail->Send();
                            // echo "Mensaje enviado. Que chivo va vos!!";
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); //Errores de PhpMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); //Errores de cualquier otra cosa.
                        }
                    } else {
                        try {
                            Doo::loadController('DatosMailController');
                            $datosMail = new DatosMailController();
                            $mai2 = new PHPMailer(true);
                            $mai2 = $datosMail->datos();
                            $nombre_destino = 'Admin';
                            //La direccion a donde mandamos el correo
                            $mai2->AddAddress($signup->username, $nombre_destino);
                            //Asunto del correo
                            $mai2->Subject = 'Signup / Supertours Of Orlando';
                            //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                            $mai2->AltBody = 'Signup / Supertours Of Orlando';


                            $mai2->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>&nbsp;</td>
     </tr>
     <tr>
       
       
       <td colspan='2' align='center' id='titletd6'>Welcome, " . $_POST['username'] . "</td>
    </tr>
   
     
  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>MEMBER NAME:</td>
        <td colspan='2'>" . $_POST['firstname'] . " " . $_POST['lastname'] . "</td>
      </tr>
      <tr>
        <td height='31'>MEMBER SINCE:</td>
        <td colspan='2'>JUN. 12-2012 / 13:32</td>
      </tr>
      <tr>
        <td height='27'>USERNAME:</td>
        <td colspan='2'>" . $_POST['username'] . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $signup->password . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819 <br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com  
    
</p>       </td>
  </tr>
  </table>



</div>");
                            $mai2->Send();
                            // echo "Mensaje enviado. Que chivo va vos!!";
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); //Errores de PhpMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); //Errores de cualquier otra cosa.
                        }
                    }
                    $login = new stdclass();
                    $login->username = $signup->username;
                    $login->firstname = $signup->firstname;
                    $login->lastname = $signup->lastname;
                    $login->state = $signup->state;
                    $login->address = $signup->address;
                    $login->tipo_client = $signup->tipo_client;
                    $login->zip = $signup->zip;
                    $login->phone = $signup->phone;
                    $login->id = Doo::db()->lastInsertId();
                    $_SESSION['user'] = $login;

                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                }
            } else {
                Doo::db()->update($signup);
            }
        }
        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/signup";
    }

    /* FUNCION DE LOGUEO */

    public function logueo() {

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;

            $dat2 = new Agency();
            $dat2->id = $dat->id;
            $dato_exten_n = Doo::db()->getOne($dat2);
            if ($dato_exten_n->precio_especial_exten == 1) {
                $precio_sql = "precio_especial as precio";
            } else if ($net_rate) {
                $precio_sql = "precio_neto as precio";
            } else {
                $precio_sql = "precio";
            }
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
            $precio_sql = "precio";
        }


        if (isset($_POST["pickup1"]) && isset($_POST["dropoff1"])) {
            $booking = $_SESSION['booking'];
            if (isset($_POST["pickup2"]) && isset($_POST["dropoff2"]) && isset($booking['price2']) && isset($booking["trip_departure2"])) {
                $pickup2 = $_POST["pickup2"];
                $dropoff2 = $_POST["dropoff2"];
                $trip_no2 = $booking['trip_no2'];
                $price2 = $booking['price2'];
                $trip_departure2 = $booking["trip_departure2"];
            } else {
                $trip_departure2 = "N/A";
                $pickup2 = "N/A";
                $dropoff2 = "N/A";
                $trip_no2 = "N/A";
                $price2 = "N/A";
            }
            /* ----- DATOS VIAJE DE IDA------------------------ */
            if (isset($_POST['pickup1']) || isset($_POST['dropoff1'])) {
                ///* PICKUP 01 *///
                $values = explode(',', $_POST['pickup1']);
                $pickup1 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';

                if ($type == 'P') { //es un pickup
                    $sql = "SELECT place,address FROM pickup_dropoff WHERE id = ?";
                    $pre1 = Doo::db()->query($sql, array($pickup1));
                    if ($pre1 != NULL) {
                        $p = $pre1->fetch();

                        if (isset($p['place']) && isset($p['address'])) {
                            $pick1 = $p['place'] . " , " . $p['address'];
                        } else {
                            $pick1 = '';
                        }
                    } else {
                        $pick1 = '';
                    }
                    $exten = "";
                    $extension1 = NULL;
                    $precio_e1 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
						FROM extension 
						WHERE id = ? and valid = ?";
                    $pre1 = Doo::db()->query($sql, array($pickup1, $valid));
                    if ($pre1 != NULL) {
                        $e = $pre1->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            $exten = $e['place'];
                            $extension1 = $pickup1;
                            $precio_e1 = $e['precio'];
                        } else {
                            $exten = "";
                            $extension1 = NULL;
                            $precio_e1 = 0;
                        }
                    } else {
                        $exten = "";
                    }
                    $pick1 = $exten;
                    $pickup1 = 'N/A';
                }

                ///* DROPOFF 01 *///
                $values = explode(',', $_POST['dropoff1']);
                $dropoff1 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';
                if ($type == 'P') { //es un pickup
                    $sql = "SELECT place, address FROM pickup_dropoff WHERE id = ?";
                    $drop1 = Doo::db()->query($sql, array($dropoff1));
                    if ($drop1 != NUll) {
                        $d = $drop1->fetch();
                        if (isset($d['place']) && isset($d['address'])) {
                            $drop1 = $d['place'] . " , " . $d['address'];
                        } else {
                            $drop1 = "";
                        }
                    } else {
                        $drop1 = "";
                    }
                    $exten = "";
                    $extension3 = NULL;
                    $precio_e3 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
							FROM extension 
							WHERE id = ? and valid = ?";
                    $pre2 = Doo::db()->query($sql, array($dropoff1, $valid));
                    if ($pre2 != NULL) {
                        $e = $pre2->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            if ($e['valid'] == 1) {
                                $exten = $e['place'];
                            } else {
                                $exten = "";
                            }
                            $extension3 = $dropoff1;
                            $precio_e3 = $e['precio'];
                        } else {
                            $extension3 = NULL;
                            $precio_e3 = 0;
                        }
                    } else {
                        $exten = "";
                        $extension3 = NULL;
                        $precio_e3 = 0;
                    }
                    $drop1 = $exten;
                    $dropoff1 = 'N/A';
                }
            } else {
                $exten = "";
                $extension1 = NULL;
                $extension3 = NULL;
                $precio_e1 = 0;
                $precio_e3 = 0;
            }
            /* ----- FIN: DATOS VIAJE DE IDA------------------------ */

            /* ----- DATOS VIAJE DE RETORNO------------------------ */
            if (isset($_POST['dropoff2']) || isset($_POST['pickup2'])) {
                ///* PICKUP 02 *///
                $values = explode(',', $_POST['pickup2']);
                $pickup2 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';

                if ($type == 'P') {//es un pickup
                    $sql = "SELECT place,address FROM pickup_dropoff WHERE id = ?";
                    $pick2 = Doo::db()->query($sql, array($_POST['pickup2']));
                    if ($pick2 != NUll) {
                        $p2 = $pick2->fetch();
                        if (isset($p2['place']) && isset($p2['address'])) {
                            $pick2 = $p2['place'] . " , " . $p2['address'];
                        } else {
                            $pick2 = "";
                        }
                    } else {
                        $pick2 = "";
                    }
                    $exten1 = "";
                    $extension2 = NULL;
                    $precio_e2 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
							FROM extension 
							WHERE id = ? and valid = ?";
                    $pre1 = Doo::db()->query($sql, array($values[0], $values[1]));
                    if ($pre1 != NUll) {
                        $e = $pre1->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            if ($e['valid'] == 1) {
                                $exten1 = $e['place'];
                            } else {
                                $exten1 = "";
                            }
                            $extension2 = $pickup2;
                            $precio_e2 = $e['precio'];
                        } else {
                            $exten1 = "";
                            $extension2 = NULL;
                            $precio_e2 = 0;
                        }
                    } else {
                        $exten1 = "";
                        $extension2 = NULL;
                        $precio_e2 = 0;
                    }
                    $pick2 = $exten1;
                    $pickup2 = 'N/A';
                }


                ///* DROPOFF 02 *///
                $values = explode(',', $_POST['dropoff2']);
                $dropoff2 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';
                if ($type == 'P') {//es un pickup
                    $sql = "SELECT place, address FROM pickup_dropoff WHERE id = ?";
                    $drop2 = Doo::db()->query($sql, array($dropoff2));
                    if ($drop2 != NUll) {
                        $d2 = $drop2->fetch();
                        if (isset($d2['place']) && isset($d2['address'])) {

                            $drop2 = $d2['place'] . " , " . $d2['address'];
                        } else {

                            $drop2 = "";
                        }
                    } else {
                        $drop2 = "";
                    }
                    $exten1 = "";
                    $extension4 = NULL;
                    $precio_e4 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
							FROM extension 
							WHERE id = ? and valid = ?";
                    $pre2 = Doo::db()->query($sql, array($dropoff2, $valid));
                    if ($pre2 != NUll) {
                        $e = $pre2->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            if ($e['valid'] == 1) {
                                $exten1 = $e['place'];
                            } else {
                                $exten1 = "";
                            }
                            $extension4 = $dropoff2;
                            $precio_e4 = $e['precio'];
                        } else {
                            $extension4 = NULL;
                            $precio_e4 = 0;
                        }
                    } else {
                        $exten1 = "";
                        $extension4 = $dropoff2;
                        $precio_e4 = $e['precio'];
                    }
                    $drop2 = $exten1;
                    $dropoff2 = 'N/A';
                }
            } else {
                $exten1 = "";
                $extension2 = NULL;
                $extension4 = NULL;
                $precio_e2 = 0;
                $precio_e4 = 0;
                $pick2 = '';
                $drop2 = '';
            }

            /* ---------------------------------------------- */
            if (isset($_POST['hotelarea1'])) {
                $hotelarea1 = $_POST['hotelarea1'];
            } else {
                $hotelarea1 = "";
            }
            if (isset($_POST['hotelarea2'])) {
                $hotelarea2 = $_POST['hotelarea2'];
            } else {
                $hotelarea2 = "";
            }
            if (isset($_POST['hotelarea3'])) {
                $hotelarea3 = $_POST['hotelarea3'];
            } else {
                $hotelarea3 = "";
            }
            if (isset($_POST['hotelarea4'])) {
                $hotelarea4 = $_POST['hotelarea4'];
            } else {
                $hotelarea4 = "";
            }
            if (isset($booking['2pricer'])) {
                $p2ricer = $booking['2pricer'];
            } else {
                $p2ricer = "";
            }
            if (isset($booking['2price'])) {
                $p2rice = $booking['2price'];
            } else {
                $p2rice = "";
            }
            if (isset($booking['2priceadult'])) {
                $p2riceadult = $booking['2priceadult'];
            } else {
                $p2riceadult = "";
            }
            if (isset($booking['2pricechil'])) {
                $p2ricechil = $booking['2pricechil'];
            } else {
                $p2ricechil = "";
            }
            /* ---------------------------------------------- */
            $booking['trip_arrival'] = $_SESSION['trip_arrival'];
            $booking['trip_departure'] = $_SESSION['trip_departure'];
            $booking['trip_arrival2'] = $_SESSION['trip_arrival2'];
            $booking['trip_departure2'] = $_SESSION['trip_departure2'];

            $booking2 = array(
                "pricer" => $booking['pricer'],
                "2pricer" => $p2ricer,
                "exten" => $exten,
                "exten1" => $exten1,
                "actuali" => "vali",
                "tipo_ticket" => $booking['tipo_ticket'],
                "fromt" => $booking['fromt'],
                "tot" => $booking['tot'],
                "fecha_salida" => $booking['fecha_salida'],
                "fecha_retorno" => $booking['fecha_retorno'],
                "pax" => $booking['pax'],
                "trip_no" => $booking['trip_no'],
                "pickup1" => $pickup1,
                "dropoff1" => $dropoff1,
                "pickup2" => $pickup2,
                "dropoff2" => $dropoff2,
                "trip_no2" => $trip_no2,
                "price" => $booking['price'],
                "2price" => $p2rice,
                "price2" => $price2,
                "pricechil" => $booking['pricechil'],
                "2pricechil" => $p2ricechil,
                "priceadult" => $booking['priceadult'],
                "2priceadult" => $p2riceadult,
                "resident" => $booking['resident'],
                "extension1" => $extension1,
                "extension3" => $extension3,
                "extension2" => $extension2,
                "extension4" => $extension4,
                "precio_e1" => $precio_e1,
                "precio_e2" => $precio_e2,
                "precio_e3" => $precio_e3,
                "precio_e4" => $precio_e4,
                "trip_arrival" => $booking['trip_arrival'],
                "trip_departure" => $booking['trip_departure'],
                "trip_arrival2" => $booking['trip_arrival2'],
                "trip_departure2" => $booking['trip_departure2'],
                "place1" => $pick1,
                "address1" => $drop1,
                "place2" => $pick2,
                "address2" => $drop2,
                "chil" => $booking['chil'],
                "hotelarea1" => $hotelarea1,
                "hotelarea2" => $hotelarea2,
                "hotelarea3" => $hotelarea3,
                "hotelarea4" => $hotelarea4,
                "zip" => $booking['zip']
            );
            $_SESSION["booking"] = $booking2;

            if (isset($_SESSION["user"])) {
                if (!isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                } else {

                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser_agency";
                }
            } else {
                $this->view()->renderc('loginuser', $this->data);
            }
        } else {

            if (isset($_SESSION["user"])) {
                if (!isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                } else {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser_agency";
                }
            } else {
                $this->view()->renderc('loginuser', $this->data);
            }
        }
    }

    public function maill() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('correo', $this->data);
    }

    public function recover() {


        if (isset($_POST['email'])) {
            $pass = Doo::db()->query("SELECT password,firstname,lastname,username FROM clientes WHERE username = ?"
                    , array(trim($_POST['email'])));

            $email = trim($_POST['email']);
            $data = $pass->fetch();

            if (isset($data['password'])) {

                try {
                    Doo::loadController('DatosMailController');
                    $datosMail = new DatosMailController();
                    $mail = new PHPMailer(true);
                    $mail = $datosMail->datos();
                    //La direccion a donde mandamos el correo
                    $nombre_destino = 'Admin';
                    $mail->AddAddress($email, $nombre_destino);
                    //Asunto del correo
                    $mail->Subject = 'Recovery Password / Supertours Of Orlando';
                    //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                    $mail->AltBody = 'Recovery Password';
                    //El cuerpo del mensaje, puede ser con etiquetas HTML
                    $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>RECOVERY PASSWORD</td>
     </tr>
     
   
     
  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      
      <tr>
        <td width='34%' height='27'>USERNAME:</td>
        <td colspan='2'>" . $email . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $data['password'] . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819 <br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com  
    
</p>       </td>
  </tr>
  </table>



</div>");
                    //Archivos adjuntos
                    //$mail->AddAttachment('img/logo.jpg');      // Archivos Adjuntos
                    //Enviamos el correo
                    $mail->Send();
                    // echo "Mensaje enviado. Que chivo va vos!!";
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Errores de PhpMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Errores de cualquier otra cosa.
                }

                echo "Contrase&ntildea Enviada a " . $data['username'];
            } else {

                echo "El correo no Existe ";
            }
        }
    }

    public function pago() {
        if (isset($_SESSION['booking']['codconf'])) {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;

            if (isset($_REQUEST['opcion_pago'])) {
                $pago = $_REQUEST['opcion_pago'];
            } else {
                $pago = 2;
            }
            if (isset($_REQUEST['otheramount'])) {
                $otheramount = (is_numeric($_REQUEST['otheramount'])) ? $_REQUEST['otheramount'] : 0;
            } else {
                $otheramount = 0;
            }
            $_SESSION['booking']['otheramount'] = $otheramount;
            //Tipos de pagos
            Doo::loadController('admin/ReservasController');
            $reserveControl = new ReservasController();
            $op = $reserveControl->types_payments();

            $arval = array_values($op[$pago]);
            $arkey = array_keys($op[$pago]);

            $tipo = new stdclass();
            $tipo->tipo = "PRED-PAID";
            $tipo->pago = $arval[0];
            $tipo->otheram = $_SESSION['booking']['totaltotal'];
            $tipo->agencia = -1;
            $_SESSION['formaPago'] = $arval[0];
            $_SESSION['booking']['pago_pred'] = $_SESSION['booking']['totaltotal'];
            $this->view()->renderc('pago', $this->data);
            #cotizacion 
            try {
                $contenido .= print_r($_SESSION, true);
                $contenido .= "<span style='color:red;'>Cotizacion Transportation con usuario true </span>";
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $correo_emisor = "websales@supertours.com";
                $nombre_emisor = "Supertours Of Orlando";
                $contrasena = "daniel4";
                //$mail->SMTPDebug  = 2;                  
                $mail->SMTPAuth = true;
                //$mail->SMTPSecure = "tsl";                
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtpout.secureserver.net";
                $mail->Port = 465;
                $mail->Username = $correo_emisor;
                $mail->Password = $contrasena;
                //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                $mail->Subject = 'Supertours Of Orlando, Cotizacion Transportation con usuario true -' . date("d-m-Y h:i:s");
                $mail->AltBody = 'Supertours Of Orlando, Cotizacion Transportation con usuario true -' . date("d-m-Y h:i:s");
                $mail->AddAddress("angel.valenciaa@gmail.com", "");
                $mail->MsgHTML($contenido);
                $mail->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); // Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); // Errores de cualquier otra cosa.
            }
            #fin de cotizacion
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function pagoAgency() {
        if (isset($_SESSION['booking'])) {
            //Tipos de pagos
            Doo::loadController('admin/ReservasController');
            $reserveControl = new ReservasController();
            $op = $reserveControl->types_payments();

            $this->tipoclient();
            //  if (isset($_SESSION['booking']['codconf'])) {
            if (isset($_SESSION['totalboking']))
                $_SESSION['booking']["totaltotal"] = $_SESSION['totalboking'];
            if (isset($_REQUEST['opcion_pago']))
                $pago = $_REQUEST['opcion_pago'];
            else
                $pago = 2;

            $login = $user = $_SESSION ['user'];
            if (isset($_REQUEST['opcion_pago_saldo']))
                $tipo_saldo = $_REQUEST['opcion_pago_saldo'];
            else
                $tipo_saldo = 1;
            if ($tipo_saldo == 2) {
                $opcion_saldo = 'BALANCE';
            } else {
                $opcion_saldo = 'FULL';
            }
            if (isset($_REQUEST['comentarios'])) {
                $_SESSION['booking']['comentarios'] = $_REQUEST['comentarios'];
            } else {
                $_SESSION['booking']['comentarios'] = "";
            }

            if (isset($_REQUEST['otheramount'])) {
                $otheramount = (is_numeric($_REQUEST['otheramount'])) ? $_REQUEST['otheramount'] : 0;
            } else {
                $otheramount = 0;
            }
            $_SESSION['booking']['otheramount'] = $otheramount;
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
            $total_neto = $_SESSION['booking']['totaltotal'];
            
            $total_reserva = $total_neto;
            if ($pago == '3') {//"Credit Card+ 4 % FEE
                $total_reserva = $total_reserva + ($total_reserva * 0.04);
            }
            $_SESSION['booking']['totaltotal'] = $total_reserva;
            if ($pago < "3") {
                $this->data['opcionPago'] = $pago;
                $total = $_SESSION['booking']["totaltotal"];
                if (isset($_SESSION['booking']['comision_agency'])) {
                    $valorComision = $_SESSION['booking']['comision_agency'];
                } else {
                    $valorComision = 0.00;
                }

                if ($pago == 1 || $tipo_saldo == 2) {
                    $pagovalor = $total - $valorComision;
                } else {
                    $pagovalor = $total;
                }
                $_SESSION['booking']['totaltotal'] = $pagovalor;

                if ($otheramount == 0) {
                    $_SESSION['booking']['pago_pred'] = $pagovalor;
                } else {
                    $_SESSION['booking']['pago_pred'] = $otheramount;
                }

                $arval = array_values($op[$pago]);
                $_SESSION['formaPago'] = $arval[0] . '-' . $opcion_saldo;

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->view()->renderc('pago', $this->data);
            } else {
                //$_SESSION['booking']['firsname'] =
                //Tipo PAGO
                $arval = array_values($op[$pago]);
                $arkey = array_keys($op[$pago]);
                $tipo_pago = $arkey[0];
                $fpago = $arval[0];


                Doo::loadModel("Reserve");
                Doo::loadModel("Clientes");
                list ($mes, $dia, $anyo) = explode("-", $_SESSION['booking']['fecha_salida']);
                $fecha_salida = $anyo . "-" . $mes . "-" . $dia;
                if ($_SESSION['booking']['tipo_ticket'] == 'roundtrip') {
                    list ($mes2, $dia2, $anyo2) = explode("-", $_SESSION['booking']['fecha_retorno']);
                    $fecha_retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
                } else {
                    $fecha_retorno = 'N/A';
                }

                //Cargando Datos cliente
                $cliente = new Clientes();
                $cliente->username = $_POST['email'];
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
                if (empty($cliente)) {
                    $cliente = new Clientes();
                    $cliente->username = $_POST['email'];
                    $cliente->firstname = $_POST['firstname'];
                    $cliente->lastname = $_POST['lastname'];
                    Doo::db()->insert($cliente) or die("Error Ingresando Datos de Cliente");
                    $id_cliente = Doo::db()->lastInsertId();
                    $cliente->id = $id_cliente;
                }
                //FIN carga datos
                $reserves = new Reserve();
                $reserves->id_tours = -1;
                $reserves->type_tour = '';
                $reserves->fecha_ini = date('Y-m-d');
                $reserves->trip_no = $_SESSION['booking']['trip_no'];
                $reserves->trip_no2 = $_SESSION['booking']['trip_no2'];
                $reserves->tipo_ticket = $_SESSION['booking']['tipo_ticket'];
                $reserves->fromt = $_SESSION['booking']['fromt'];
                $reserves->tot = $_SESSION['booking']['tot'];
                $reserves->fromt2 = $_SESSION['booking']['tot'];
                $reserves->tot2 = $_SESSION['booking']['fromt'];
                $reserves->firsname = $cliente->firstname;
                $reserves->lasname = $cliente->lastname;
                $reserves->email = $cliente->username;
                $reserves->deptime1 = $_SESSION['booking']['trip_departure'];
                $reserves->deptime2 = isset($_SESSION['booking']['trip_departure2']) ? $_SESSION['booking']['trip_departure2'] : '';
                $reserves->arrtime1 = $_SESSION['booking']['trip_arrival'];
                $reserves->arrtime2 = isset($_SESSION['booking']['trip_arrival2']) ? $_SESSION['booking']['trip_arrival2'] : '';
                $reserves->precioA = $_SESSION['booking']['totaladul'];
                $reserves->precioN = ($_SESSION['booking']['chil'] > 0) ?  $_SESSION['booking']['totalchil'] : 0;
                
                /** Discriminacion de precios */
                    $reserves->precio_trip1_a = $_SESSION['booking']['priceadult'];
                    $reserves->precio_trip1_c = $_SESSION['booking']['pricechil'];
                    $reserves->precio_trip2_a = $_SESSION['booking']['2priceadult'];
                    $reserves->precio_trip2_c = $_SESSION['booking']['2pricechil'];

                    #extension 1
                    $reserves->precio_exten1_a = $_SESSION['booking']['precio_e1'];
                    $reserves->precio_exten1_c = $_SESSION['booking']['precio_e1'];

                    #extension 2
                    $reserves->precio_exten2_a = $_SESSION['booking']['precio_e2'];
                    $reserves->precio_exten2_c = $_SESSION['booking']['precio_e2'];

                    #extension 3
                    $reserves->precio_exten3_a = $_SESSION['booking']['precio_e3'];
                    $reserves->precio_exten3_c = $_SESSION['booking']['precio_e3'];

                    #extension 4
                    $reserves->precio_exten4_a = $_SESSION['booking']['precio_e4'];
                    $reserves->precio_exten4_c = $_SESSION['booking']['precio_e4'];                
                /** fin Discriminacion de precios */
                    
                $reserves->extension1 = $_SESSION['booking']['extension1'];
                $reserves->precio_e1 = $_SESSION['booking']['precio_e1'];
                $reserves->pickup_exten1 = $_SESSION['booking']['hotelarea1'];
                $reserves->extension2 = $_SESSION['booking']['extension2'];
                $reserves->precio_e2 = $_SESSION['booking']['precio_e2'];
                $reserves->pickup_exten2 = $_SESSION['booking']['hotelarea2'];
                $reserves->extension3 = $_SESSION['booking']['extension3'];
                
                $reserves->precio_e3 = $_SESSION['booking']['precio_e3'];
                $reserves->pickup_exten3 = $_SESSION['booking']['hotelarea3'];
                $reserves->extension4 = $_SESSION['booking']['extension4'];
                $reserves->precio_e4 = $_SESSION['booking']['precio_e4'];
                $reserves->pickup_exten4 = $_SESSION['booking']['hotelarea4'];
                $reserves->fecha_salida = $fecha_salida;
                $reserves->fecha_retorno = $fecha_retorno;
                $reserves->pax = $_SESSION['booking']['pax'];
                $reserves->pax2 = ($_SESSION['booking']['chil'] > 0) ? $_SESSION['booking']['chil'] : 0;
                $reserves->id_tours = -1;
                $reserves->id_clientes = $cliente->id;
                $reserves->pickup1 = $_SESSION['booking']['pickup1'];
                $reserves->dropoff1 = $_SESSION['booking']['dropoff1'];
                $reserves->pickup2 = $_SESSION['booking']['pickup2'];
                $reserves->dropoff2 = $_SESSION['booking']['dropoff2'];
                $reserves->tipo_pago = $tipo_pago;
                $reserves->pago = $fpago . '-' . $opcion_saldo;
                $reserves->totaltotal = $total_reserva;
                $reserves->otheramount = $otheramount;
                $reserves->extra_charge = 0;
                $reserves->total2 = $total_neto;
                $reserves->codconf = $_SESSION['booking']['codconf'];
                $reserves->hora = $_SESSION['booking']['hora'];
                $reserves->comments = $_SESSION['booking']['comentarios'];
                $reserves->resident = 0;
                $reserves->agen = $user->id;
                $reserves->tipo_client = $cliente->tipo_client;
                $reserves->reward_id = -1;
                $reserves->agency = $dat->id;
                $reserves->luggage1 = -1;
                $reserves->luggage2 = -1;
                $reserves->canal = 'WEBSALE';
                $reserves->estado = 'CONFIRMED';
                

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                if (Doo::db()->insert($reserves)) {
                    $id_reserva = Doo::db()->lastInsertId();
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserves->id = $id_reserva;
                    $login = $_SESSION['user'];
                    $login->tipo = 'AGENCY';
                    $reseControl->registrar_pago($reserves, NULL, $login);
                    $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);
                    if ($pago == 5) {// Actualizamos el credio
                        $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($dat->id), "limit" => 1));
                        if (!empty($creditos)) {
                            $creditos->disponible = ($creditos->disponible - $_SESSION['booking']["totaltotal"]);
                            if (!Doo::db()->update($creditos)) {
                                $this->view()->renderc('decline', $this->data);
                            }
                        }
                    }


                    Doo::loadModel("Reservas_Agency");
                    $reserves_a = new Reservas_Agency();
                    $reserves_a->id_reservas = $id_reserva;
                    $reserves_a->id_agencia = $dat->id;
                    $reserves_a->id_client = $cliente->id;
                    $reserves_a->type_client = $cliente->tipo_client;
                    $reserves_a->id_useragency = $user->id;
                    $reserves_a->paid_type = $tipo_pago;
                    $reserves_a->metodo_paid = $fpago . '-' . $opcion_saldo;
                    if ($dat->type_rate == 1) {
                        $reserves_a->comision = 0;
                    } else {
                        $reserves_a->comision = ($this->cal_equipament($reserves->trip_no) + $this->cal_equipament($reserves->trip_no2)) / 2;
                    }
                    $reserves_a->agency_fee = $total_neto * $reserves_a->comision / 100;
                    $reserves_a->paper_voucher = 0;
                    if ($tipo_saldo == 2 && $pago != 5) {
                        $total_pagado = $total_reserva - ($total_neto * $reserves_a->comision / 100);
                    } else {
                        $total_pagado = $total_reserva;
                    }
                    $reserves_a->otheramount = $otheramount;
                    $reserves_a->paid_net = $total_neto;
                    $reserves_a->paid_full = $total_pagado;

                    Doo::db()->insert($reserves_a);


                    $codconf = array(
                        "codconf" => $_SESSION['booking']['codconf']
                    );

                    $_SESSION['code'] = $codconf;
                    $this->emailReserveUserAgency($reserves);
                    $this->view()->renderc('approval', $this->data);
                } else {
                    $this->view()->renderc('decline', $this->data);
                }
            }
        } else {
            return Doo::conf()->APP_URL . "agency/";
        }
    }

    public function cal_equipament($trip) {
        Doo::loadModel("Trips");
        $trip1 = ($trip == "EXPRESS MINIBUS") ? "EXPRESS SERVICES" : $trip;
        $tripss = Doo::db()->find("Trips", array("select" => "equipment", "where" => "trip_no = ?", "param" => array($trip1), "limit" => 1));
        if (empty($tripss)) {
            $age_comis = array();
        } else {
            Doo::loadModel("Agencomi");
            $age_comis = Doo::db()->find("Agencomi", array("where" => "service = ?", "param" => array($tripss->equipment), "limit" => 1));
        }
        if (!empty($age_comis))
            return $age_comis->comision;
        else
            return 0;
    }

    public function prue() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->view()->renderc('index11', $this->data);
    }

    public function isAuth() {

        if (isset($_SESSION["login"])) {
            return true;
        } else {
            return false;
        }
    }

    public function loginuser() {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);
                $pass = trim($_POST['password']);



                //$pass  = trim($_POST['password']);
                $u = $this->db()->find('Clientes', array('where' => 'username = ? and password = ?',
                    'limit' => 1,
                    'select' => 'id,username,firstname,lastname,state,address,zip,tipo_client,city,country,phone',
                    'param' => array($user, $pass)
                        )
                );

                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Acceso denegado";
                    //return Doo::conf()->APP_URL."admin";
                    $this->renderc('loginuser', $this->data);
                } else {

                    $login = new stdclass ();
                    $login->username = $u->username;
                    $login->username2 = $u->username;
                    $login->firstname = $u->firstname;
                    $login->lastname = $u->lastname;
                    $login->state = $u->state;
                    $login->address = $u->address;
                    $login->zip = $u->zip;
                    $login->tipo_client = $u->tipo_client;
                    $login->city = $u->city;
                    $login->country = $u->country;
                    $login->phone = $u->phone;
                    $login->celphone = $u->celphone;
                    $login->id = $u->id;

                    $_SESSION['user'] = $login;
                    //$this->home();
                    $auth = $this->isAuth();
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                }
            }
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function logout() {
        unset($_SESSION['user']);

        return Doo::conf()->APP_URL . "";
    }

    public function pais() {
        $from = $this->params["country"];



        if ($from != "UNITED%20STATES") {

            echo '<option value="OTHER" >OTHER</option>';
        }

        if ($from == "UNITED%20STATES") {
            echo '<option value="ODER"></option>';
            $sql = "SELECT  name  FROM state";

            $rs = Doo::db()->query($sql);

            $states = $rs->fetchAll();

            foreach ($states as $e) {
                echo '<option value="' . $e['name'] . '" ' . ($e["name"] == trim("FLORIDA") ? 'selected' : '') . ' >' . $e['name'] . '</option>';
            }
        }
    }

    public function Myreservas() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;



        if (isset($_SESSION['user'])) {
            $login = $_SESSION['user'];

            if (isset($_SESSION["booking"])) {
                $booking = $_SESSION["booking"];
                $tipo_ticket = $booking["tipo_ticket"];
                $from = $booking["fromt"];
                $to = $booking["tot"];


                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($from),
                    "limit" => 1));
                $from_name = $rs->nombre;

                if ($tipo_ticket == "roundtrip") {


                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }
                if ($tipo_ticket == "oneway") {

                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }




                $rs = Doo::db()->query("select r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,firsname,lasname,totaltotal,
                                ar.nombre as de , ob.nombre as para,ot.phone as phone
									
									from reservas r
									left join areas ar on (r.fromt = ar.id)
									left join areas ob on (r.tot =  ob.id) 
									left join clientes ot on (r.id_clientes =  ot.id) 
									
                                where id_clientes = ? ", array($login->id));

                $myr = $rs->fetchAll();

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['myr'] = $myr;
                $this->data['from_name'] = $from_name;
                $this->data['to_name'] = $to_name;
                $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));


                $this->view()->renderc('reservations', $this->data);
            }
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function profile() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_SESSION['user'])) {
            $login = $_SESSION['user'];
        }
        if (isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
            $tipo_ticket = $booking["tipo_ticket"];
            $from = $booking["fromt"];
            $to = $booking["tot"];


            $rs = Doo::db()->find("Areas", array("select" => "nombre",
                "where" => "id = ?",
                "param" => array($from),
                "limit" => 1));
            $from_name = $rs->nombre;

            if ($tipo_ticket == "roundtrip") {


                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($to),
                    "limit" => 1));
                $to_name = $rs->nombre;
            }
            if ($tipo_ticket == "oneway") {

                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($to),
                    "limit" => 1));
                $to_name = $rs->nombre;
            }

            Doo::loadModel("Clientes");
            $cliente = new Clientes();
            $cliente->id = $login->id;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['cliente'] = Doo::db()->find($cliente, array('limit' => 1));
            $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
            $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));



            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['from_name'] = $from_name;
            $this->data['to_name'] = $to_name;
            $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));

            $this->view()->renderc('profile', $this->data);
        }
    }

    public function pro() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('probando', $this->data);
    }

    public function r() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;


        $id = $this->params["variable"];


        $sql = "SELECT fecha_ini,tipo_ticket,firsname,lasname,pax,pax2,codconf,tipo_pago FROM reservas WHERE codconf= ?";
        $rs = Doo::db()->query($sql, array($id));
        $factu = $rs->fetch();

        $totalpax = $factu['pax'] + $factu['pax2'];
        //$this->data['fac']     = $factu;

        if ($factu['tipo_ticket'] == "oneway") {

            echo "
		<head>

<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
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



</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking:</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $factu['firstname'] . " " . $factu['lastname'] . " </td>
       <td width='202' height='15' id='titletd6'></td>
       <td colspan='2' id='titletd6' width='266' height='15'>AD : <strong>" . $factu['pax'] . "  </strong>CHD :" . $factu['pax2'] . "<strong> TOTAL</strong> :" . $totalpax . "</td>
    </tr>
     <tr>
       
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='202' height='16' id='titletd7'>Confirmation # " . $factu['codconf'] . "</td>
       <td width='200' height='16' id='titletd7'>Paid by: " . $factu['tipo_pago'] . "</td>
    </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong> </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> </td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> </td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> </td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong>  </td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> </td>
        </tr>
  </table>
   
    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : </td>
        <td colspan='2'>Address : </td>
		 <td colspan='2'>Phone : </td>
      </tr>
      <tr>
        <td height='27'>Last Name : </td>
        <td colspan='2'>City : </td>
      </tr>
      <tr>
        <td height='27'>E-mail : </td>
        <td>State : </td>
        <td>Country :</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler :</td>
        <td colspan='2'>Zip / Postal Code : </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'> Transportation from <b> </b>to <b></b></td>
      </tr>
      <tr >
        <td width='7%' height='30'></td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'></td>
        <td id='titlelp' width='11%'>$ </td>
        <td id='titlelp' width='12%'>$ </td>
      </tr>
      <tr>
        
         
        <td height='27'></td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'></td>
        <td id='titlelp'>$ </td>
        <td id='titlelp'>$ </td>
             
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ </td>
        <td id='titlelp'>$ </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> </td>
        <td id='titlelr'><strong>$   </strong></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>



</div>
		
		";
        } else {
            echo "no listo, roundtrip";
        }
    }

    public function update() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("Clientes");

        $cliente = new Clientes($_POST);

        $new = false;

        if ($_POST['id'] == "") {
            $cliente->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new)
            Doo::db()->insert($cliente);
        else
            Doo::db()->update($cliente);

        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/profile/";
    }

    public function exten() {
        $id = $this->params["id"];

        if (isset($this->params["id_agencia"])) {
            $id_agencia = $this->params["id_agencia"];
            $this->getExten($id, $id_agencia);
        } else {
            $this->getExten($id);
        }
    }

    public function getExten($id, $id_agencia = -1) {
        //traemos las variables de la vista frm_reservas para hacer consulta sobre tabla routes y buscar costo de extensiones
//        $from = $this->params["from"];    
//        //echo $from;
//        $to = $this->params["to"];   
//        //echo $to;
//        
//        $trip_no = $this->params["trip_no"];
//        //echo $trip_no;
////        $trip_no2 = $this->params["trip_no2"];
//        
//        
////        $anno = substr($fecha_salida, -4);
////        $resident = $this->params["resid"];
////        $tipo = $this->params["tipo"];
////        $id_agency = $this->params["agency"];
//        $fechasal = $this->params["fechasal"];  
//        list($mes, $dia, $anio) = explode('-', $fechasal);        
//        $fecha_sal = $anio."-".$mes."-".$dia;
//        //echo $fecha_sal;
//        
//        $anno = substr($fechasal, -4);
        //echo $anno;
        // print_r($id_agencia);
        // die;
        
        if ($id_agencia != -1) {
            Doo::loadModel("Agency");
            $agencia = new Agency();
            $agencia->id = $id_agencia;
            $rs_agencia = Doo::db()->getOne($agencia);
            if (!empty($rs_agencia)) {
                if ($rs_agencia->precio_especial_exten == 1) {
                    $sql = "SELECT id,place,address,precio_especial as precio FROM extension WHERE id != 15 AND id_area = ?";
                } else {
                    $sql = "SELECT id,place,address,precio_neto as precio FROM extension WHERE id != 15 AND id_area = ?";
                }
            }
        } else {
            $sql = "SELECT id,place,address,precio FROM extension WHERE id != 15 AND id_area = ?";
        }
        $rs = Doo::db()->query($sql, array($id));
        $datos = $rs->fetchAll();
        
        //echo $id;
        
//        if($id==11){
//            
//            $sql1 = "SELECT   univext 
//                            FROM routes 
//                            WHERE  trip_no='$trip_no' and anno='$anno' and fecha_ini='$fecha_sal' and trip_from='$from' and trip_to='$to'";
//            
//            $rs = Doo::db()->query($sql1);
//            $resul = $rs->fetch();
//            $precio = $resul['univext'];  
////            echo $precio;
//            
//        }
//        
//        if($id==12){
//            
//            $sql2 = "SELECT   univext  
//                            FROM routes 
//                            WHERE  trip_no='$trip_no' and anno='$anno' and fecha_ini='$fecha_sal' and trip_from='$from' and trip_to='$to'";
//            
//            $rs = Doo::db()->query($sql2);
//            $resul = $rs->fetch();
//            $precio = $resul['univext'];          
////            echo $precio;
//        }
//        if($id==13){
//          
//            $sql3 = "SELECT   wdext 
//                            FROM routes 
//                            WHERE  trip_no='$trip_no' and anno='$anno' and fecha_ini='$fecha_sal' and trip_from='$from' and trip_to='$to'";
//            
//            $rs = Doo::db()->query($sql3);
//            $resul = $rs->fetch();
//            $precio = $resul['wdext'];
////            echo $precio;
//        }   
//        
        
        //echo $precio;
        
        echo "<option value='0'> </option>";
        foreach ($datos as $resul) {
            //echo "<option  value='" . $resul['id'] . "'>" . $resul['place'] . " " . $resul['precio'] . " P.P </option>";
            echo "<option  value='" . $resul['id'] . "'>" . $resul['place'] . " </option>";
         
        }
    }

    /*
     * Busca todos los destino de una area determinado
      y retorna las extenciones de la primera area encontrada
     */

    public function exten_to_tot_of_from() {

        $from = $this->params["from"];

        $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1 
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? ORDER BY  t2.id ASC";

        $rs = Doo::db()->query($sql, array($from));

        $areas = $rs->fetchAll();
        if (!empty($areas)) {
            $this->getExten($areas[0]['trip_to']);
        }
    }

    public function area_to_tot_of_from() {
        $from = $this->params["from"];
        $areas_to = $this->areas_to($from);
        echo '<option value="0" ></option>';
        foreach ($areas_to as $e) {
            echo '<option value="' . $e['trip_to'] . '" >' . $e['nombre'] . '</option>';
        }
    }

    public function areas_to($from) {
        $from = $this->params["from"];
        $sql = "SELECT distinct t1.trip_to as trip_to, t2.nombre  FROM routes t1 
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? ORDER BY  t2.orden ASC";
        $rs = Doo::db()->query($sql, array($from));
        $areas = $rs->fetchAll();
        return $areas;
    }

    public function areas($from) {
        $from = $this->params["from"];
        $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1 
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? ORDER BY  t2.orden ASC";
        $rs = Doo::db()->query($sql, array($from));
        $areas = $rs->fetchAll();
        return $areas;
    }

    public function getAreas() {
        $from = $this->params["from"];
        $areas = $this->areas($from);
        foreach ($areas as $e) {
            echo '<option value="' . $e['trip_to'] . '" ' . ($e["nombre"] == trim("MIAMI BEACH (CENTRAL)") ? 'selected' : '') . ' >' . $e['nombre'] . '</option>';
        }
    }

    public function Asinup() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->view()->renderc('agency/signup', $this->data);
    }

    public function Asave() {

        Doo::loadModel("ASignup");

        $Asignup = new ASignup($_POST);


        $sql = "SELECT atanumber FROM agency WHERE atanumber= ?";

        $signup1 = new stdclass();
        $signup1->atanumber = $Asignup->atanumber;
        $signup1->name = $Asignup->name;
        $signup1->address = $Asignup->address;
        $signup1->phone1 = $Asignup->phone1;
        $signup1->phone2 = $Asignup->phone2;
        $signup1->email = $Asignup->email;
        $signup1->toolfree = $Asignup->toolfree;
        $signup1->movil = $Asignup->movil;
        //contac person
        $signup1->firstname = $Asignup->firstname;
        $signup1->lastname = $Asignup->lastname;
        $signup1->celphone = $Asignup->celphone;
        $signup1->error = "";
        $_SESSION['signup1'] = $signup1;

        if (strtoupper($_REQUEST["captcha"]) == $_SESSION["captcha"]) {
            // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
            $_SESSION["captcha"] = md5(rand() * time());
            // INSERTA EL CÓDIGO EXITOSO AQUI
            $rs = Doo::db()->query($sql, array($Asignup->atanumber));
            $reci = $rs->fetch();

            if ($reci != NUll) {

                return Doo::conf()->APP_URL . "agency/signup/slope/";
            } else {

                $new = false;
                $Asignup->estado = "slope";

                $id = "";
                if ($id == "") {
                    $Asignup->id = Null;
                    $new = true;
                }



                if ($new) {
                    Doo::db()->insert($Asignup);
                }

                unset($_SESSION['signup1']);
            }
        } else {
            // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
            $_SESSION["captcha"] = md5(rand() * time());
            // INSERTA EL CÓDIGO DE ERROR AQU�?
            $signup1->error = "Error";
            return Doo::conf()->APP_URL . "agency/signup/";
        }
    }

    public function slope() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('slope', $this->data);
    }

    public function slope2() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('slope2', $this->data);
    }

    public function contacto() {
        return Doo::conf()->APP_URL . "contact-us-supertours";
    }

    public function valid() {
        $explode = $this->params["id"];
        $values = explode(',', $explode);

        if (isset($values[1])) {
            // print_r($values);




            if ($values[1] == 1 && $values[2] == 1) {
                echo '<script> $("#areapickup1").css("display", "block"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 1) {
                echo '<script>  $("#areapickup1").css("display", "none"); </script>';
            }
            //// fin pickup 1

            if ($values[1] == 1 && $values[2] == 2) {
                echo '<script> $("#areadropoff1").css("display", "block"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 2) {
                echo '<script>  $("#areadropoff1").css("display", "none"); </script>';
            }

            //// fin dropoff 1


            if ($values[1] == 1 && $values[2] == 3) {
                echo '<script> $("#areapickup2").css("display", "block"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 3) {
                echo '<script>  $("#areapickup2").css("display", "none"); </script>';
            }


            ///fin de pickup 2

            if ($values[1] == 1 && $values[2] == 4) {

                echo '<script> $("#areadropoff2").css("display", "block"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 4) {
                echo '<script>  $("#areadropoff2").css("display", "none"); </script>';
            }

            ///fin de dropoff 2
        }
    }

    function decline() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('decline', $this->data);
    }

}

?>