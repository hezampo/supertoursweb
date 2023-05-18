<?php

/**
 * Description of ReserveController
 *
 * @author Angel Valenca A.
 */
set_time_limit(320);
ini_set('memory_limit', '356M');
Doo::loadController('I18nController');
ob_start();
Doo::loadHelper('class.phpmailer');

Doo::loadHelper('DooFile');


Doo::loadController('DooController');


class ReservasController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {
        unset($_SESSION['reserve_pago']);
        // Cargamos el paginador
        Doo::loadHelper('DooPager');
        if (!isset($_POST["filtro2"])) {
            if (!isset($this->params['filtro2'])) {
                $filtro = "codconf";
            } else {
                $filtro = $this->params['filtro2'];
            }
        } else {
            $filtro = $_POST["filtro2"];
        }
        if (!isset($_POST["texto2"])) {
            if (!isset($this->params['texto2'])) {
                $texto = "";
            } else {
                $texto = $this->params['texto2'];
            }
        } else {
            $texto = $_POST["texto2"];
        }

        if ($filtro == 'opuser') {
            $filtro = "us.nombre";
        }
        if ($filtro == 'lasname') {
            $filtro = "CONCAT_WS(' ',firsname,lasname)";
        }

        $query = "SELECT COUNT( * ) AS total
                    FROM (
                    SELECT r.id
                    FROM reservas r
                    LEFT JOIN areas ar ON ( r.fromt = ar.id ) 
                    LEFT JOIN areas ob ON ( r.tot = ob.id ) 
                    LEFT JOIN clientes ot ON ( r.id_clientes = ot.id ) 
                    LEFT JOIN usuarios us ON ( r.ip_op = us.id ) 
                    WHERE r.estado !=  'QUOTE' and type_tour != 'MULTI' and type_tour != 'ONE'
                    AND $filtro LIKE  ?
                    ORDER BY r.id DESC
                    ) AS count";
        $rs = Doo::db()->query($query, array('%' . $texto . '%'));
        $count = $rs->fetchAll();
        $total = $count[0]['total'];
        if ($total == 0)
            $total = 1;
        // iniciamos el paginador
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/reservas/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);


        $rs = Doo::db()->query("select r.estado, r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,firsname,lasname,totaltotal,
                                ar.nombre as de , ob.nombre as para, ot.phone as phone, us.nombre as opuser,ag.company_name AS agencia
									
									from reservas r
									left join areas ar on (r.fromt = ar.id)
									left join areas ob on (r.tot =  ob.id)
									left join clientes ot on (r.id_clientes =  ot.id) 
                                                                        left join usuarios us on (r.ip_op = us.id)
                                                                        LEFT JOIN agencia ag ON (r.agency = ag.id)
									
                                where  r.estado != 'QUOTE' and type_tour != 'MULTI' and type_tour != 'ONE' AND $filtro like ? order by (r.id) DESC limit $pager->limit ", array('%' . $texto . '%'));

        $reservas = $rs->fetchAll();

        if ($filtro == 'us.nombre') {
            $filtro = "opuser";
        }
        if ($filtro == "CONCAT_WS(' ',firsname,lasname)") {
            $filtro = "lasname";
        }
        //echo $filtro;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/reservas.php';
        $this->data['filtro2'] = $filtro;
        $this->data['texto2'] = $texto;
        $this->data['reservas'] = $reservas;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function quotes() {
        // Cargamos el paginador
        Doo::loadHelper('DooPager');
        if (!isset($_POST["filtro2"])) {
            if (!isset($this->params['filtro2'])) {
                $filtro = "firsname";
            } else {
                $filtro = $this->params['filtro2'];
            }
        } else {
            $filtro = $_POST["filtro2"];
        }
        if (!isset($_POST["texto2"])) {
            if (!isset($this->params['texto2'])) {
                $texto = "";
            } else {
                $texto = $this->params['texto2'];
            }
        } else {
            $texto = $_POST["texto2"];
        }
        if ($filtro == 'lasname') {
            $filtro = "CONCAT_WS(' ',firsname,lasname)";
        }


        $rs = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
            "where" => "  estado = 'QUOTE' and type_tour = '' AND  '$filtro' like ?",
            "limit" => 1,
            "param" => array('%' . $texto . '%')
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/reservas_quotes/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);


        $rs = Doo::db()->query("select r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,firsname,lasname,totaltotal,
                                ar.nombre as de , ob.nombre as para, ot.phone as phone
									
									from reservas r
									left join areas ar on (r.fromt = ar.id)
									left join areas ob on (r.tot =  ob.id) 
									left join clientes ot on (r.id_clientes =  ot.id) 
									
                                where estado = 'QUOTE' and type_tour = '' AND $filtro like ? order by (r.id) DESC limit $pager->limit ", array('%' . $texto . '%'));

        $reservas = $rs->fetchAll();
        if ($filtro == "CONCAT_WS(' ',firsname,lasname)") {
            $filtro = "lasname";
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/reserves_quote.php';
        $this->data['filtro2'] = $filtro;
        $this->data['texto2'] = $texto;
        $this->data['reservas'] = $reservas;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['cliente'] = $cliente;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true, "asc" => "orden"));
        $this->data['age_comis'] = Doo::db()->find("Agencomi", array("param" => array()));

        if (isset($_SESSION['price'])) {
            unset($_SESSION['price']);
        }
//        unset($_SESSION['codconf']);
        unset($_SESSION['reserva_edit']);

        $_SESSION['codconf'] = $this->codigoConf(1);

        $this->actualiarPuestosUsuario(5);
//        $_SESSION['reserve_pago'] == 'ok';
        $this->data['content'] = 'configuracion/frm_reservas.php';
        $this->renderc('admin/index', $this->data);
    }

    public function loadAreas() {
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true, "asc" => "orden"));

        $html = "";
        foreach ($this->data['areas'] as $e) {
            $html .= "<option value='" . $e["id"] . "' " . ($e["nombre"] == trim(" ") ? 'selected' : "ORLANDO") . ">" . $e["nombre"] . "</option>";
        }
        echo $html;
    }

    public function pagoWeb() {
        extract($_POST, EXTR_SKIP);
        if ($opcion_pago <= 2) {
            if ($idPagador != '') {
                Doo::loadModel("Clientes");
                $cliente = new Clientes();
                $cliente->id = $idPagador;
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
                if (!empty($cliente)) {
                    //Generar codigo de confirmaciòn.
//                    $_SESSION['codconf'] = $this->codigoConf(1);
                    if (isset($_SESSION['reserva_edit'])) {
                        Doo::loadModel("Reserve");
                        $r_anterior = new Reserve($_SESSION['reserva_edit']);
                        $pagado = $this->pagado($r_anterior->id);
                    } else {
                        $pagado = 0;
                    }
                    $apagar = 0;
                    if (is_numeric($otheramount) && $otheramount > 0) {
                        $apagar = $otheramount - $pagado;
                    } else {
                        $apagar = $totP - $pagado;
                    }
                    if ($apagar > 0) {
                        $_SESSION['toursbooking']['pago_pred'] = $apagar;
                        $this->data['rootUrl'] = Doo::conf()->APP_URL;
                        $this->data['usuario'] = $cliente;
                        $this->view()->renderc('admin/configuracion/pago', $this->data);
                    } else {
                        return Doo::conf()->APP_URL . "admin/reservas/edit/" . $r_anterior->id;
                    }
                } else {
                    echo '<script type="text/javascript">
				alert("The selected client is not registered.\n Please record the client and try again");
				close();
			  </script>';
                }
            } else {
                echo '<script type="text/javascript">
					alert("The selected client is not registered.\n Please record the client and try again");
					close();
					</script>';
            }
        }
    }

    public function estado_pago() {
        if (isset($_SESSION['reserve_pago']) && $_SESSION['reserve_pago'] == 'ok') {
            echo '<table>
		   			<tr>
						<td align="left">
		  					<samp style="font-size: 18px;
									font-weight: bold;
									color: #0B55C4;
									background-repeat: no-repeat;
									float: left;">Transaction has been successful</samp>			
						</td>
						</tr>
						<tr>
							<td  align="left">
								<strong>Press the save button to complete the reservation</strong>
							<td>
						</tr>';
            echo "<script>
		   			$('#btn-save1').css('display','block');
		   			$('#btn-save2').css('display','block');
		   			$('#fin_calculo').val('true');
				</script>";
        } else if (isset($_SESSION['reserve_pago']) && $_SESSION['reserve_pago'] == '...') {
            echo '<table>
		   			<tr>
						<td align="left">
							<samp style="font-size: 18px;
									font-weight: bold;
									color: #DD0005;
									background-repeat: no-repeat;
									width: 87%;
									float: left;">
								Transaction processing
							</samp>
						</td>
						</tr>
						<tr>
							<td>
								You must complete the transaction in order to maintain the confidentiality
							<td>
						</tr>
				</table>';
        } else if (isset($_SESSION['reserve_pago']) && $_SESSION['reserve_pago'] == 'no') {
            echo '<table>
		   			<tr>
						<td align="left">
							<samp style="font-size: 18px;
									font-weight: bold;
									color: #DD0005;
									background-repeat: no-repeat;
									width: 100%;
									float: left;">
								Transaction declined.
							</samp>
						</td>
						</tr>
						<tr>
							<td>
								Check that the Credit Card are correct
							<td>
						</tr>
				</table>';
        }
    }

    public function response_aproval() {
        if (isset($_GET['ssl_approval_code']) && isset($_SESSION['codconf'])) {
            $_SESSION['codconf'] = $_SESSION['codconf'] . "-" . $_GET['ssl_approval_code'];
            $_SESSION['reserve_pago'] = 'ok';
            $data['rootUrl'] = Doo::conf()->APP_URL;
            $this->view()->renderc('admin/configuracion/approval', $data);
        } else {
            unset($_SESSION['codconf']);
            unset($_SESSION['reserve_pago']);
            return Doo::conf()->APP_URL . "transaction/admin/reserva/decline/";
        }
    }

    public function response_decline() {
        $_SESSION['reserve_pago'] = 'no';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('admin/configuracion/decline', $data);
    }

    public function saveReserve() {
//        print_r($_POST);
//        exit;
        extract($_POST, EXTR_SKIP);
        Doo::loadModel("Clientes");
        try {

            Doo::db()->beginTransaction();
            if (trim($idCliente) != '') {
                $cliente = new Clientes();
                $cliente->id = $idCliente;
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
            } else {
                $cliente = new Clientes();
                $cliente->firstname = $firstname1;
                $cliente->lastname = $lastname1;
                $cliente->phone = $phone1;
                $cliente->username = $email1;
                if (Doo::db()->insert($cliente))
                    ;
                $id_cliente = Doo::db()->lastInsertId();
                $cliente->id = $id_cliente;
            }

            Doo::loadModel("Reserve");
            if (isset($ext_from1)) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_from1));
                $datos = $rs->fetch();

                $precio_e1 = $datos['precio'];
                $extension1 = $datos['id'];
            } else {
                $precio_e1 = 0;
                $extension1 = 0;
            }
            if (isset($ext_to1)) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_to1));
                $datos = $rs->fetch();
                $precio_e2 = $datos['precio'];
                $extension2 = $datos['id'];
            } else {
                $precio_e2 = 0;
                $extension2 = 0;
            }

            if (isset($ext_from2)) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_from2));
                $datos = $rs->fetch();

                $precio_e3 = $datos['precio'];
                $extension3 = $datos['id'];
            } else {
                $precio_e3 = 0;
                $extension3 = 0;
            }
            if (isset($ext_to2)) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_to2));
                $datos = $rs->fetch();

                $precio_e4 = $datos['precio'];
                $extension4 = $datos['id'];
            } else {
                $precio_e4 = 0;
                $extension4 = 0;
            }
            $tipoticket = ""; // Tipo de tiquete
            if ($tipo_ticket == 1) {
                $tipoticket = "oneway";
            } else {
                $tipoticket = "roundtrip";
            }
            if (!isset($_SESSION['codconf'])) {
                if (trim($estado) == 'QUOTE') {
                    $_SESSION['codconf'] = $this->codigoConf(0);
                } else {
                    $_SESSION['codconf'] = $this->codigoConf(1);
                }
                $codconf = $_SESSION['codconf'];
            } else {
                $codconf = $_SESSION['codconf'];
            }
            Doo::loadModel("Agency");
            if ($id_agency != -1) {
                $dat = new Agency();
                $dat->id = $id_agency;
                $agencys = Doo::db()->find($dat, array("limit", 1));
                if (!empty($agencys)) {
                    $dat = new Agency($agencys[0]);
                    if ($id_auser == '' && $uagency != '') {
                        Doo::loadModel('UserA');
                        $usera = new UserA();
                        $usera->id_agencia = $dat->id;
                        $usera->active = false;
                        $usera->firstname = $uagency;
                        $usera->email = $dat->main_email;
                        $id_auser = Doo::db()->insert($usera);
                    }
                } else {
                    $dat = new Agency();
                    $dat->id = -1;
                    $dat->type_rate = 0;
                }
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }
            $fecha_salida_org = $fecha_salida;
            list ($mes, $dia, $anyo) = explode("-", $fecha_salida);
            $fecha_salida = $anyo . "-" . $mes . "-" . $dia;
            if ($tipoticket == 'roundtrip') {
                $fecha_retorno_org = $fecha_retorno;
                list ($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
                $fecha_retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
            } else {
                $fecha_retorno = 'N/A';
            }
            $prince_trip_1 = $this->trip_price($trip_no, $dat, $fecha_salida_org, $fecha_salida, $fromt, $to, $tipo_pass);


            if (isset($trip_no2)) {
                if ($trip_no2 != "" && $trip_no2 != 0) {
                    $prince_trip_2 = $this->trip_price($trip_no2, $dat, $fecha_retorno_org, $fecha_retorno, $fromt2, $to2, $tipo_pass);
                }
            }

            if (isset($_REQUEST['opcion_pago'])) {
                $pago = $_REQUEST['opcion_pago'];
            } else
                $pago = 1;

            if (isset($_REQUEST['opcion_pago_saldo'])) {
                $opcion_saldo = $_REQUEST['opcion_pago_saldo'];
            } else
                $opcion_saldo = 1;


            //La Reserva
            $op = $this->types_payments();
            $arval = array_values($op[$pago]);
            $arkey = array_keys($op[$pago]);
            $tipoP = $arkey[0];
            $formaP = $arval[0];
            /* echo $tipoP;
              exit */;
            if ($opcion_saldo == 2) {
                $tiposaldo = "BALANCE";
            } else {
                $tiposaldo = "FULL";
            }

            if (!is_numeric($extra)) {
                $extra = 0;
            }
            if (!is_numeric($extra)) {
                $extra = 0;
            }
            if (0 > $extra) {
                $extra = 0;
            }
            if (!is_numeric($descuento)) {
                $descuento = 0;
            }
            if (!is_numeric($descuento_valor)) {
                $descuento_valor = 0;
            }
            if (0 > $descuento_valor) {
                $descuento_valor = 0;
            }
            if (0 > $otheramount) {
                $otheramount = 0;
            }
            //$total_neto = $totP;

            $reserve = new Reserve();
            if (isset($extension1)) {
                $precio_exten1 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension1)));
                if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                    $precio_extension1 = $precio_exten1->precio_especial;
                } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                    $precio_extension1 = $precio_exten1->precio_neto;
                } else {
                    $precio_extension1 = $precio_exten1->precio;
                }
                $reserve->precio_exten1_a = $precio_extension1;
                $reserve->precio_exten1_c = $precio_extension1;
            } else {
                $reserve->precio_exten1_a = 0;
                $reserve->precio_exten1_c = 0;
            }
            if (isset($extension2)) {
                $precio_exten2 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension2)));
                if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                    $precio_extension2 = $precio_exten2->precio_especial;
                } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                    $precio_extension2 = $precio_exten2->precio_neto;
                } else {
                    $precio_extension2 = $precio_exten2->precio;
                }
                $reserve->precio_exten2_a = $precio_extension2;
                $reserve->precio_exten2_c = $precio_extension2;
            } else {
                $reserve->precio_exten2_a = 0;
                $reserve->precio_exten2_c = 0;
            }
            if (isset($extension3)) {
                $precio_exten3 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension3)));
                if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                    $precio_extension3 = $precio_exten3->precio_especial;
                } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                    $precio_extension3 = $precio_exten3->precio_neto;
                } else {
                    $precio_extension3 = $precio_exten3->precio;
                }
                $reserve->precio_exten3_a = $precio_extension3;
                $reserve->precio_exten3_c = $precio_extension3;
            } else {
                $reserve->precio_exten3_a = 0;
                $reserve->precio_exten3_c = 0;
            }
            if (isset($extension4)) {
                $precio_exten4 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension4)));
                if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                    $precio_extension4 = $precio_exten4->precio_especial;
                } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                    $precio_extension4 = $precio_exten4->precio_neto;
                } else {
                    $precio_extension4 = $precio_exten4->precio;
                }
                $reserve->precio_exten4_a = $precio_extension4;
                $reserve->precio_exten4_c = $precio_extension4;
            } else {
                $reserve->precio_exten4_a = 0;
                $reserve->precio_exten4_c = 0;
            }

            $reserve->id_tours;
            $reserve->type_tour;
            $reserve->fecha_ini = date("Y-m-d");
            $reserve->trip_no = $trip_no;
            $reserve->trip_no2 = $trip_no2;
            $reserve->tipo_ticket = $tipoticket;
            $reserve->fromt = $fromt;
            $reserve->tot = $to;
            if ($tipoticket == 'roundtrip') {
                $reserve->fromt2 = $fromt2;
                $reserve->tot2 = $to2;
            }
            $reserve->firsname = $firstname1;
            $reserve->lasname = $lastname1;
            $reserve->email = $email1;

            $reserve->deptime1 = date("H:i", strtotime($departure1));

            $reserve->arrtime1 = date("H:i", strtotime($arrival1));

            if (isset($_POST["byr"])) {
                $reserve->customer_disabilities = 1;
            }
            /** Discriminacion de Precios */
            $reserve->precio_trip1_a = $prince_trip_1["price_adult"];
            $reserve->precio_trip1_c = $prince_trip_1["price_child"];
            $reserve->precio_trip2_a = $prince_trip_2["price_adult"];
            $reserve->precio_trip2_c = $prince_trip_2["price_child"];

            $reserve->precioA = $prince_trip_1["price_adult"] * $pax; //--
            if ($pax2 > 0) {
                $reserve->precioN = $prince_trip_1["price_child"] * $pax2; //--
            }
            if (isset($trip_no2)) {
                if ($trip_no2 != "" && $trip_no2 != 0) {
                    $reserve->deptime2 = date("H:i", strtotime($departure2));
                    $reserve->arrtime2 = date("H:i", strtotime($arrival2));

                    $reserve->precioA = $reserve->precioA + ($prince_trip_2["price_adult"] * $pax);
                    if ($pax2 > 0) {
                        $reserve->precioN = $reserve->precioN + ($prince_trip_2["price_child"] * $pax2); //--
                    }
                }
            }
            /** FIN Discriminacion de Precios. */
            /** totales calculando * */
            $precio_extension_adultos = ($reserve->precio_exten1_a + $reserve->precio_exten2_a + $reserve->precio_exten3_a + $reserve->precio_exten4_a);
            $precio_extension_children = ($reserve->precio_exten1_c + $reserve->precio_exten2_c + $reserve->precio_exten3_c + $reserve->precio_exten4_c);
            $total_neto = (($reserve->precioA + $reserve->precioN) + ($precio_extension_adultos * $pax) + ($precio_extension_children * $pax2));

            $val_procentaje = 0;
            if ($descuento > 0) {
                $val_procentaje = ($total_neto * $descuento) / 100;
            } else {
                $descuento = 0;
            }

            $total_neto+= $extra; //los extra siempre los ganara supertours

            $total_reserva = $total_neto - $val_procentaje - $descuento_valor;

//            if ($otheramount > 0) {
//                $total_reserva = $otheramount; // si se cobrara otro monto, el total de la reserva sera ese monto
//            }
            if ($totalcom > 0 && $opcion_saldo == 1) {
                $total_reserva += $totalcom;
            }
            if ($pago == '3') {//"Credit Card+ 3 % FEE
                $total_reserva = $total_reserva + ($total_reserva * 0.04);
            }
            if ($pago == '1') {//"Credit Card+ 3 % FEE
                $total_reserva = $total_reserva + ($total_reserva * 0.04);
            }
            if ($pago == '7') {
                $total_reserva = 0;
            }

            $reserve->extension1 = $extension1;
            $reserve->precio_e1 = $precio_extension1;
            $reserve->pickup_exten1 = isset($exten1) ? $exten1 : '';

            $reserve->extension2 = $extension2;
            $reserve->precio_e2 = $precio_extension2;
            $reserve->pickup_exten2 = isset($exten2) ? $exten2 : '';

            $reserve->extension3 = $extension3;
            $reserve->precio_e3 = $precio_extension3;
            $reserve->pickup_exten3 = isset($exten3) ? $exten3 : '';

            $reserve->extension4 = $extension4;
            $reserve->precio_e4 = $precio_extension4;
            $reserve->pickup_exten4 = isset($exten4) ? $exten4 : '';

            $reserve->room1 = isset($room1) ? $room1 : '';
            $reserve->room2 = isset($room2) ? $room2 : '';

            $reserve->fecha_salida = $fecha_salida;
            $reserve->fecha_retorno = $fecha_retorno;
            $reserve->pax = $pax;
            $reserve->pax2 = $pax2;

            $reserve->pax3 = $infat; //campo de infantes, agregado a la tabla de reservas.

            $reserve->id_clientes = $cliente->id;
            $reserve->pickup1 = $id_p1;
            $reserve->dropoff1 = $id_dropoff1;
            $reserve->pickup2 = $id_pickup2;
            $reserve->dropoff2 = $id_dropoff2;
            $reserve->tipo_pago = $tipoP;
            $reserve->pago = $formaP . '-' . $tiposaldo;
            $reserve->op_pago = $pago;

            $reserve->totaltotal = $total_reserva;
            $reserve->otheramount = $otheramount;
            $reserve->extra_charge = $extra;
            $reserve->descuento_procentaje = $descuento;
            $reserve->descuento_valor = $descuento_valor;

            $reserve->total2 = $total_neto;
            $reserve->codconf = $codconf;
            $reserve->hora = date("H:i", time());
            $reserve->comments = $notes;
            $reserve->resident = $tipo_pass;
            $reserve->agen = $id_agency;
            $reserve->tipo_client = $cliente->tipo_client;
            $reserve->reward_id;
            $reserve->agency = $id_agency;
            $reserve->luggage1 = 0;
            $reserve->luggage2 = 0;
            $reserve->canal = $canal;
            $reserve->ip_op = $_SESSION['login']->id;

            if (trim($estado) != '') {
                $reserve->estado = $estado;
            }
            if (Doo::db()->insert($reserve)) {

                $id_reserva = Doo::db()->lastInsertId();
                $reserve->id = $id_reserva;

                Doo::loadModel('CollectService');
                $collected = new CollectService();
                $collected->id_servicio = $reserve->id;
                $collected->tipo_servicio = "RESERVE";
                $collected->monto_pagado = 0;
                $collected->id = $collected->insert();

                // generamos la factura del servicio //
//                if ($tipoP == "PRED-PAID" || $tipoP == "FREE SERVICES") {
//                    Doo::loadModel('Factura');
//                    Doo::loadModel('FacturaServicio');
//                    $factura = new Factura();
//                    $factura->creation_date = date('Y-m-d');
//                    $factura->total = $reserve->totaltotal;
//                    if ($pago == 'FREE SERVICES') {
//                        $factura->total = 0;
//                        $factura->estado = "PAID";
//                    }
//                    $factura->subtotal = $reserve->total2;
//                    $factura->id_agency = $reserve->agency;
//                    $factura->id = $factura->insert();
//                    $fs = new FacturaServicio();
//                    $fs->id_factura = $factura->id;
//                    $fs->id_servicio = $reserve->id;
//                    $fs->tipo_servicio = "RESERVE";
//                    $fs->insert();
//
//                    if ($reserve->tipo_pago == "PRED-PAID") {
//                        Doo::loadModel('Pago');
//                        $pago = new Pago();
//                        $pago->fecha = date('Y-m-d H:m:s');
//                        $pago->monto = $reserve->totaltotal;
//                        $pago->descuento = 0;
//                        $pago->per_descuento = 0;
//                        $pago->factura = $factura->id;
//                        $pago->tipo = 'FULL';
//                        $pago->transnu = '0';
//                        if ($tipoP == 'Passenger Credit Card' || $tipoP == 'Agency Credit Card') {
//                            $pago->metodo = 4;
//                        } else if ($tipoP == 'Cash in terminal') {
//                            $pago->metodo = 5;
//                        }
//                        $pago->insert();
//
//                        $factura->collect = $reserve->totaltotal;
//                        $factura->total = $factura->subtotal - $factura->collect;
//                        $factura->estado = 'PAID';
//                        $factura->update();
//
//                        $collected->monto_pagado = $reserve->totaltotal;
//                        $collected->update();
//
//                        $sql = "update reservas set estado = 'INVOICED' where id = ?";
//                        $query = Doo::db()->query($sql, array($reserve->id));
//                    }
//                } else if ($tipoP == 'COLLECT ON BOARD') {
//                    $collected->monto_pagado = $reserve->totaltotal;
//                    $collected->update();
//                }


                $login = $_SESSION['login'];
                $reserves_a = NULL;
//                $this->registrar_pago($reserve, $reserves_a, $login);
                if ($pay_amount != "" && $pay_amount > 0) {
                    $option = $this->types_payments();
                    if (isset($_REQUEST['opcion_pago_2'])) {
                        $pago_2 = $_REQUEST['opcion_pago_2'];
                    }
                    $arval = array_values($option[$pago_2]);
                    $arkey = array_keys($option[$pago_2]);
                    $tipoP_2 = $arkey[0];
                    $formaP_2 = $arval[0];
                    //La Reserva


                    $reserve->paid = $pay_amount;
                    $this->registrar_pago($reserve, NULL, $login, $pay_amount, $tipoP_2, $formaP_2);
                } else {
                    $reserve->paid = 0;
                }
                $login->tipo = 'OPERATOR';
                $this->rastro_reserva('CREATE', $reserves_a, $reserve, $login);

                Doo::loadModel("Reservas_Agency");
                $reserves_a = new Reservas_Agency();
                $reserves_a->id_reservas = $id_reserva;
                $reserves_a->id_agencia = $id_agency;
                $reserves_a->id_cliente = $cliente->id;
                $reserves_a->type_client = $cliente->tipo_client;
                $reserves_a->id_useragency = $id_auser;
                $reserves_a->paid_type = $tipoP;
                $reserves_a->metodo_paid = $formaP . '-' . $tiposaldo;
                $reserves_a->comision = $comision;
                $reserves_a->agency_fee = $total_neto * $comision / 100;
                $reserves_a->paper_voucher = 0;
                $reserves_a->paid_net = $total_neto;

                if ($dat->id != -1) {
                    if ($opcion_saldo == 2 && $pago != 5) {
                        $total_pagado = $total_neto - ($total_neto * $reserves_a->comision / 100);
                    } else {
                        $total_pagado = $total_reserva;
                    }

                    $reserves_a->paid_full = $total_pagado;
                    Doo::db()->insert($reserves_a);
                } else {
                    $reserves_a = NULL;
                }
                //$this->correo($reserve, $reserves_a); envio de email

                unset($_SESSION['codconf']);
            } else {
                //
            }
            //generando trafico
            Doo::loadController("admin/TrafficController");
            $traffic = new TrafficController();
            if ($fecha_salida != "0000-00-00") {
                $datos = $traffic->generate_and_search_traffics($id_reserva, "RESERVE");
            }
            Doo::db()->commit();

            return Doo::conf()->APP_URL . "admin/reservas/edit/$id_reserva?menssage=Guardado Correctamente";
        } catch (Exception $exc) {
            Doo::db()->rollBack();
            print_r($exc);
            exit;
            return Doo::conf()->APP_URL . "admin/reservas/add";
        }
    }

    public function editReserve() {
        Doo::loadModel("Reserve");
        Doo::loadModel("Clientes");
        Doo::loadModel("Routes");
        Doo::loadModel("Agency");
        Doo::loadModel("PickupDropoff");
        Doo::loadModel("Extension");
        Doo::loadModel("UserA");
        Doo::loadModel("Reservas_Agency");
        if (isset($this->params["pindex"])) {
            if (isset($this->params["url"])) {
                $url_back = str_replace('.', '/', $this->params["url"]);
            } else {
                $url_back = 'admin/reservas';
            }
            $reserve = new Reserve();
            $cliente = new Clientes();
            $pickup1 = new PickupDropoff();
            $pickup2 = new PickupDropoff();
            $drop1 = new PickupDropoff();
            $drop2 = new PickupDropoff();
            $extencion1 = new Extension();
            $extencion2 = new Extension();
            $extencion3 = new Extension();
            $extencion4 = new Extension();
            $agencia = new Agency();
            $userA = new UserABase();
            $reserver_a = new Reservas_Agency();
            $reserve->id = $this->params["pindex"];



            $reserve = Doo::db()->find($reserve, array('limit' => 1));
            if (!empty($reserve)) {
                //RASTRO-> Modificaciones de la reserva
                $sql = "SELECT id, id_reserva, tipo_cambio, detalles, fecha, usuario, tipo_usuario FROM reservas_rastro WHERE id_reserva = ? ORDER BY  reservas_rastro.fecha DESC
";
                $rs = Doo::db()->query($sql, array($reserve->id));

                $rastro = $rs->fetchAll();
                foreach ($rastro as $key => $rr) {
                    if ($rr['tipo_usuario'] == 'OPERATOR') {
                        Doo::loadModel("Usuarios");
                        $usuario = new Usuarios();
                        $usuario->id = $rr['usuario'];
                        $usuario = Doo::db()->find($usuario, array('limit' => 1));
                        if (!empty($usuario)) {
                            $rr['id_usuario'] = $usuario->id;
                            $rr['usuario'] = $usuario->nombre;
                        } else {
                            $rr['id_usuario'] = $rr['usuario'];
                            $rr['usuario'] = 'User Not Found';
                        }
                    } else if ($rr['tipo_usuario'] == 'CLIENT') {
                        Doo::loadModel("Clientes");
                        $cli = new Clientes();
                        $cli->id = $rr['usuario'];
                        $cli = Doo::db()->find($cli, array('limit' => 1));
                        if (!empty($cli)) {
                            $rr['id_usuario'] = $cli->id;
                            $rr['usuario'] = $cli->firstname . ' ' . $cli->lastname;
                        } else {
                            $rr['id_usuario'] = $rr['usuario'];
                            $rr['usuario'] = 'User Not Found';
                        }
                    }
                    $rastro[$key] = $rr;
                }

                //PAGOS REALIZADOS
                $pagado = $this->pagado($reserve->id);

                //Cliente
                if ($reserve->id_clientes == NULL) {
                    $cliente = new Clientes();
                    $cliente->id = $reserve->id_clientes;
                    $cliente->username = $reserve->email;
                    $cliente->firstname = $reserve->firsname;
                    $cliente->lastname = $reserve->lasname;
                } else {
                    $cliente = new Clientes();
                    $cliente->id = $reserve->id_clientes;
                    $cliente = Doo::db()->find($cliente, array('limit' => 1));
                    if (empty($cliente)) {
                        $cliente = new Clientes();
                        $cliente->id = $reserve->id_clientes;
                        $cliente->username = $reserve->email;
                        $cliente->firstname = $reserve->firsname;
                        $cliente->lastname = $reserve->lasname;
                    }
                }
                $datos = get_object_vars($cliente);
                $cliente_apto = $this->clienteAptoPagoWeb($datos);


                //PickupDropoff-IDA
                $pickup1->id = $reserve->pickup1;
                $drop1->id = $reserve->dropoff1;
                $pickup1 = Doo::db()->find($pickup1, array('limit' => 1));
                $drop1 = Doo::db()->find($drop1, array('limit' => 1));

                //Agencia
                $agencia->id = $reserve->agency;

                if ($agencia->id != -1) {
                    $agencia = Doo::db()->find($agencia, array('limit' => 1));

                    $reserver_a->id_reservas = $reserve->id;
                    $reserver_a = Doo::db()->find($reserver_a, array('limit' => 1));
                    if (!empty($reserver_a)) {
                        $userA->id = $reserver_a->id_useragency;
                        $userA = Doo::db()->find($userA, array('limit' => 1));
                    }
                    $rs = Doo::db()->query("SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days  FROM agency_account WHERE id_agencia = ? ", array($agencia->id));
                    $agen_account = $rs->fetchAll();
                    if (!empty($agen_account)) {
                        $agen_account = $agen_account[0];
                    } else {
                        $agen_account = array();
                        $agen_account['opcion1'] = 0;
                        $agen_account['opcion2'] = 0;
                        $agen_account['opcion3'] = 1;
                        $agen_account['opcion4'] = 1;
                        $agen_account['opcion5'] = 0;
                    }
                } else {
                    $agencia->type_rate = 0;
                    $agen_account = array();
                    $agen_account['opcion1'] = 0;
                    $agen_account['opcion2'] = 0;
                    $agen_account['opcion3'] = 1;
                    $agen_account['opcion4'] = 1;
                    $agen_account['opcion5'] = 0;
                }
                $from = $reserve->fromt;
                $to = $reserve->tot;
                if ($reserve->tipo_ticket == "roundtrip") {
                    //PickupDropoff-RETORNO
                    $pickup2->id = $reserve->pickup2;
                    $drop2->id = $reserve->dropoff2;
                    $pickup2 = Doo::db()->find($pickup2, array('limit' => 1));
                    $drop2 = Doo::db()->find($drop2, array('limit' => 1));
                    //ROUTE RETORNO
                    $from2 = $reserve->fromt2;
                    $to2 = $reserve->tot2;
                    $trip = $reserve->trip_no2;
                }

                //EXTENCIONES ESCOGIDAS
                if ($reserve->extension1 != 0) {
                    $extencion1->id = $reserve->extension1;
                    $extencion1 = Doo::db()->find($extencion1, array('limit' => 1));
                }
                if ($reserve->extension2 != 0) {
                    $extencion2->id = $reserve->extension2;
                    $extencion2 = Doo::db()->find($extencion2, array('limit' => 1));
                }
                if ($reserve->extension3 != 0) {
                    $extencion3->id = $reserve->extension3;
                    $extencion3 = Doo::db()->find($extencion3, array('limit' => 1));
                }
                if ($reserve->extension4 != 0) {
                    $extencion4->id = $reserve->extension4;
                    $extencion4 = Doo::db()->find($extencion4, array('limit' => 1));
                }
                //LISTA DE EXTENCIONES
                $sql = "SELECT * FROM  extension Where id_area = ?";
                $rs = Doo::db()->query($sql, array($reserve->fromt));
                $extenFrom1 = $rs->fetchAll();

                $sql = "SELECT * FROM  extension Where id_area = ?";
                $rs = Doo::db()->query($sql, array($reserve->tot));
                $extenTo1 = $rs->fetchAll();

                //LISTA DE EXTENCIONES
                $sql = "SELECT * FROM  extension Where id_area = ?";
                $rs = Doo::db()->query($sql, array($reserve->fromt2));
                $extenFrom2 = $rs->fetchAll();

                $sql = "SELECT * FROM  extension Where id_area = ?";
                $rs = Doo::db()->query($sql, array($reserve->tot2));
                $extenTo2 = $rs->fetchAll();


                //AREAS
                $sql = "SELECT DISTINCT t1.trip_to, t2.nombre
						FROM routes t1 LEFT JOIN areas t2 ON (t1.trip_to = t2.id) 
						ORDER BY  t1.trip_to,t2.orden asc";
                $rs = Doo::db()->query($sql);
                $from_areas = $rs->fetchAll();

                if ($reserve->type_tour == 'ONE' || $reserve->type_tour == 'MULTI') {// Solo se muestra orlando
                    $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
					LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
					WHERE t2.id = 1 order by t2.orden asc";
                    $rs = Doo::db()->query($sql);
                } else {
                    $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
					LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
					WHERE t1.trip_from = ? order by t2.orden asc";
                    $rs = Doo::db()->query($sql, array($reserve->fromt));
                }
                $to_areas = $rs->fetchAll();
                //print_r($to_areas);

                $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
					LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
					WHERE t1.trip_from = ? order by orden asc";
                $rs = Doo::db()->query($sql, array($reserve->fromt2));
                $to_areas2 = $rs->fetchAll();



                //echo $reserve->fromt2;
                //PRECIOS TRIP

                /* if ($reserve->id_tours == -1) {
                  $fecha = date('m-d-Y', strtotime($reserve->fecha_salida));
                  $precioTrip1 = $this->precioTrip($reserve->trip_no, $reserve->fromt, $reserve->tot, $fecha, $agencia);
                  $subto = array();
                  //                    print_r($precioTrip1);
                  //                    exit;
                  if ($reserve->resident != 1) {
                  $subto['child1'] = $precioTrip1['price2'];
                  $subto['adult1'] = $precioTrip1['price'];
                  } else {
                  $subto['child1'] = $precioTrip1['price3'];
                  $subto['adult1'] = $precioTrip1['price4'];
                  }
                  if ($agencia->type_rate != 1) {
                  $subto['comi1'] = $this->comision_trip($reserve->trip_no);
                  } else {
                  $subto['comi1'] = 0;
                  }
                  } else {
                  Doo::loadController('admin/ToursController');
                  $toursOperador = new ToursController();
                  /*$prices = $toursOperador->precioTripTours($reserve->trip_no, $agencia->type_rate, $agencia->id, substr($reserve->fecha_salida, 0, 4) . '-01-01 00:00:00');
                  $subto['child1'] = $prices['child'];
                  $subto['adult1'] = $prices['adult'];
                  $subto['comi1'] = 0; */
//                }

                /* if ($reserve->tipo_ticket == 'roundtrip') {
                  if ($reserve->id_tours == -1) {
                  $fecha = date('m-d-Y', strtotime($reserve->fecha_retorno));
                  //                                                        echo '<br/>';
                  //                                                        echo $reserve->id.'...'.$reserve->trip_no2.'...'.$reserve->fromt2.'...'.$reserve->tot2.'...'.$fecha.'...'.$agencia->id;
                  //
                  $precioTrip2 = $this->precioTrip($reserve->trip_no2, $reserve->fromt2, $reserve->tot2, $fecha, $agencia);
                  if ($reserve->resident != 1) {
                  $subto['child2'] = $precioTrip2['price2'];
                  $subto['adult2'] = $precioTrip2['price'];
                  } else {
                  $subto['child2'] = $precioTrip2['price3'];
                  $subto['adult2'] = $precioTrip2['price4'];
                  }
                  if ($agencia->type_rate != 1) {
                  $subto['comi2'] = $this->comision_trip($reserve->trip_no2);
                  } else {
                  $subto['comi2'] = 0;
                  }
                  } else {
                  Doo::loadController('admin/ToursController');
                  $toursOperador = new ToursController();
                  $prices = $toursOperador->precioTripTours($reserve->trip_no2, $agencia->type_rate, $agencia->id, substr($reserve->fecha_salida, 0, 4) . '-01-01 00:00:00');
                  $subto['child2'] = $prices['child'];
                  $subto['adult2'] = $prices['adult'];
                  $subto['comi2'] = 0;
                  }
                  } else {
                  $subto['child2'] = 0;
                  $subto['adult2'] = 0;
                  $subto['comi2'] = 0;
                  } */

                Doo::loadController("AgenciaController");
                $agenControl = new AgenciaController();
                $disponible = $agenControl->iscredit();

                $_SESSION['reserva_edit'] = $reserve;
                $this->data['reserve'] = $reserve;
                $this->data['subto'] = "";
                $this->data['rastro'] = $rastro;
                $this->data['pagado'] = $pagado;
                $this->data['cliente'] = $cliente;
                $this->data['cliente_apto'] = $cliente_apto;
                $this->data['pickup1'] = $pickup1;
                $this->data['pickup2'] = $pickup2;
                $this->data['drop1'] = $drop1;
                $this->data['drop2'] = $drop2;
                $this->data['extencion1'] = $extencion1;
                $this->data['extencion2'] = $extencion2;
                $this->data['extencion3'] = $extencion3;
                $this->data['extencion4'] = $extencion4;
                $this->data['extenFrom1'] = $extenFrom1;
                $this->data['extenTo1'] = $extenTo1;
                $this->data['extenFrom2'] = $extenFrom2;
                $this->data['extenTo2'] = $extenTo2;
                $this->data['to_areas'] = $from_areas;
                $this->data['from_areas'] = $from_areas;
                $this->data['to_areas2'] = $to_areas2;
                $this->data['agencia'] = $agencia;
                $this->data['disponible'] = $disponible;
                $this->data['agen_account'] = $agen_account;
                $this->data['reserver_a'] = $reserver_a;
                $this->data['userA'] = $userA;
                $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true, "asc" => "orden"));
                if ($reserve->type_tour == 'ONE' || $reserve->type_tour == 'MULTI') {// Solo vista no editar
                    $this->data['content'] = 'configuracion/reservas_view.php';
                } else {
                    $this->data['content'] = 'configuracion/frm_reservas_edit.php';
                }
                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['url_back'] = Doo::conf()->APP_URL . $url_back;
                $this->actualiarPuestosUsuario(5);
                $this->view()->renderc('admin/index', $this->data);
            } else {
                //Salir
            }
        } else {
            //Salir
        }
    }

    public function mostrar() {

        Doo::loadModel("Clientes");
        Doo::loadModel("PickupDropoff");
        Doo::loadModel("Reserve");

//        $url_back = '';
//
//        $cliente = new Clientes();
//
//        $pickupdropoff = new PickupDropoff();


        $reserve = new Reserve();

        $reserve->id = $this->params["pindex"];

        $r_anterior = new Reserve($_SESSION['reserva_edit']); //Datos de la reserva anterior
        $id_reserva = $r_anterior->id;
       // $pregunta_reserva = Doo::db()->getOne("Reserve", array("where" => "id = ?", "param" => array($r_anterior->id)));
        //$reserve = new Reserve();



        $sql = "SELECT r1.precio_trip1_a AS adulto,
	r1.precio_trip1_c AS nino,
	r1.totaltotal AS neto,
        r1.firsname AS nombre,
        r1.lasname AS apellido,
        r1.email, c2.phone,
        r1.pax AS adult,
        r1.pax2 AS child,        
        r1.fecha_salida,
        r1.deptime1,
        r1.deptime2, 
	r1.trip_no,
	r1.trip_no2,
	r1.fecha_retorno, 
	r1.trip_no2,
	r1.codconf,
	r1.agency,	
	r1.tipo_ticket,
	r1.arrtime1,
	r1.arrtime2,
	a1.nombre AS FROM1,
	a2.nombre AS TO1,
	a3.nombre AS FROM2,
	a4.nombre AS TO2,
	p1.place AS lugar1, 
	p1.address AS direccion1,
	p2.place AS lugar2,
	p2.address AS direccion2,
	p3.place AS lugar3,
	p3.address AS direccion3,
	p4.place AS lugar4,
	p4.address AS direccion4

        
        FROM reservas r1	 
	LEFT JOIN clientes c2 ON (r1.id_clientes = c2.id) 
        LEFT JOIN areas a1 ON (r1.fromt = a1.id)
        LEFT JOIN areas a2 ON (r1.tot = a2.id)
        LEFT JOIN areas a3 ON (r1.fromt2 = a3.id)
        LEFT JOIN areas a4 ON (r1.tot2 = a4.id)        
        LEFT JOIN pickup_dropoff p1 ON (r1.pickup1 = p1.id) 
        LEFT JOIN pickup_dropoff p2 ON (r1.pickup2 = p2.id)  
        LEFT JOIN pickup_dropoff p3 ON (r1.dropoff1 = p3.id)  
        LEFT JOIN pickup_dropoff p4 ON (r1.dropoff2 = p4.id)  
        

	WHERE r1.id = '37072' ";


        $rs = $this->db()->query($sql);

        $transp = $rs->fetchAll();

        foreach ($transp as $clave => $key) {
            
        }


       // $comentario = $key['comentario'];
        $agencia = $key['agency'];
        $adulto1 = $key['adulto'];
//formateamos la variable para entregarla con dos cifras decimales
        $adulto = number_format($adulto1, 2, '.', '');
        $from1 = $key['FROM1'];
        $to1 = $key['TO1'];
        $from2 = $key['FROM2'];
        $to2 = $key['TO2'];
        $nino1 = $key['nino'];
//formateamos la variable para entregarla con dos cifras decimales
        $nino = number_format($nino1, 2, '.', '');
        $neto1 = $key['neto'];
        $neto = number_format($neto1, 2, '.', '');
        $nombre = $key['nombre'];
        $apellido = $key['apellido'];
        $email = $key['email'];
        $phone1 = $key['phone'];
        
        // Separamos en grupos de tres  
        $phone2 = chunk_split($phone1,3,"");   

        // Creamos un grupo de 3 digitos y tres grupos de 2 digitos  
        $num_tlf1 = substr($phone2, 0, 3);  
        $num_tlf2 = substr($phone2, 3, 3);  
        $num_tlf3 = substr($phone2, 3, 4);  

        $phone3 = "($num_tlf1) $num_tlf2-$num_tlf3";        
            
        $adult = $key['adult'];
        $child = $key['child'];
        $axa1 = ($adulto1 * $adult);
        $axa2 = number_format($axa1, 2, '.', '');

        $nxc1 = ($nino1 * $child);
        $nxc = number_format($nxc1, 2, '.', '');
        //$infant = $key['inf'];
        //$fecha_salida1 = $key['fecha_salida'];
        
        $fecha_salida1 = $key['fecha_salida'];
        $fecha_salida2 = strtotime($fecha_salida1); 
        $fecha_salida = date('m/d/Y', $fecha_salida2);      

        $lugar1 = $key['lugar1'];
        $direccion1 = $key['direccion1'];

        $lugar2 = $key['lugar2'];
        $direccion2 = $key['direccion2'];

        $trip_no = $key['trip_no'];
        //$trip_no2 = $key['trip_no2'];
        $fecha_retorno1 = $key['fecha_retorno'];
        $fecha_retorno2 = strtotime($fecha_retorno1); 
        $fecha_retorno = date('m/d/Y', $fecha_retorno2);  
                
        $lugar3 = $key['lugar3'];
        $direccion3 = $key['direccion3'];
//cambiar formato de hora a AM / PM
        $deptime1 = date("g:i a", strtotime($key['deptime1']));
        $deptime2 = date("g:i a", strtotime($key['deptime2']));
        $arrtime1 = date("g:i a", strtotime($key['arrtime1']));
        $arrtime2 = date("g:i a", strtotime($key['arrtime2']));

        $lugar4 = $key['lugar4'];
        $direccion4 = $key['direccion4'];
        $trip_no2 = $key['trip_no2'];
        $codconf = $key['codconf'];
        $tipo_ticket = $key['tipo_ticket'];
//$tipo_ticket = strtoupper($key['tipo_ticket']);
//Primera letra en Mayuscula
        //$ticket_oneway = ucwords($key['tipo_ticket']);

        if ($child == 0) {
            $child = '0';
            $nino = '00.00';
            $nxc = '00.00';
        }

        if ($email == '') {
            $email = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        if ($phone3 == '') {
            $phone3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }

//<img src="global/img/icono26anios.png" alt="" style="width: 25%;" />

        if (($agencia == 45 OR $agencia == 53) AND $tipo_ticket == 'oneway') {

//////////////////////////////////ONE-WAY//////////////////////////////////////////////////////////////////////////////////////////////////////
            $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    
                    <img src="https://www.supertours.com/Logo-Supertours-mail.jpg" alt="" style="width: 25%;" />
                   
                </div>
                <div id="sp-div-left" style="margin-left: 410px;">
                    <p style="font-size: 25px; margin-top: -3%;">
                        Confirmation  #: <u><b>' . $codconf . '</b></u>
                    </p>
                </div>
            </div>
        </header><br>
       
        <div id="contenido">
            <p style="font-size: 27px;  margin-left: 45%; margin-top: -4%;">
                E-Ticket
            </p>
            <p style="font-size: 27px;">
                <i>
                    <u>
                        <b>Passenger Information</b>
                    </u>
                </i>
            </p>
            <p>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone3 . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>ONE-WAY</b></i> </td>
                    </tr>
                    <tr>
                        <th align="center" style="width: 16%;">Date</th>
                        <th align="center" style="width: 12%;">Trip</th>
                        <th align="center" style="width: 32%;">Departure Time</th>
                        <th align="center" style="width: 45%;">From</th>
                        <th align="center" style="width: 45%;">To</th>
                        <th align="center" style="width: 30%;">Arrival Time</th>
                       
                    </tr>
                </thead>
                <tbody style="border-top: 1px solid #000;">
                <tbody>
                    <tr>
                        <td align="center">' . $fecha_salida . '</td>
                        <td align="center">' . $trip_no . '</td>
                        <td align="center">' . $deptime1 . '</td>
                        <td align="left">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>
                    </tr>
                  
                </tbody>
            </table> <br />
            <label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 290px;">
                 <ul style=" margin-left: -2%;">
                    <li>Passengers must be ready and waiting for the vehicle 15 minutes prior to scheduled
                    departure time at selected departure location. This is a Non-refundable & Non-Changeable Ticket.
                    </li>
                    <li>You must present this e-ticket printed or on mibile device.</li>
                    <li>Passenger must present a valid from of ID, with a photo and name. </li>
                    <li>Each passanger is entitled to one (1) checked bag up to 40 lbs and one (1)
                    Carry-on up to 12 lbs.
                    </li>
                    <li>Each additional bag you wish to check in will cost $10.00</li>
                </ul>
            </textarea>
            </label>
            
           
                        
            <div id="caja-contenido" style="margin-left: 56%; margin-top: -35%;">
                <table border="0" width ="245"  bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
              
                <thead>
               
                <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                   
                </thead>
                
                <tbody>
                    <tr>
                        <td align="left" style="width: 44.5%;">One Way-Trip Adult:</td>
                        <td align="right">$&nbsp;' . $adulto . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $axa2 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="width: 44%;">One Way-Trip Child:</td>
                        <td align="right">$&nbsp;' . $nino . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $nxc . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $neto . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;00.00 </td>                        
                    </tr>                  
                    
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
                </tbody>
                </table> <br />
            </div>
            
           
            <img src="https://www.supertours.com/codigo.png" alt="" style="width: 25%; margin-left: 75%; margin-top: -20%;" />
            
            <br><br>
            <p style="text-align: center; margin-top: -5px;">
                Thank you for traveling with Super Tours of Orlando!            
            </p>
            
        </div>

	';

            $codigoHTML.='
    
</body>
</html>';
        }
//<img src="global/img/codigo.png" alt="" style="width: 25%; margin-left: 75%; margin-top: -20%;" />
        if ($agencia != 45 && $tipo_ticket == 'oneway') {

            $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <img src="global/img/icono26anios.png" alt="" style="width: 25%;" />
                </div>
                <div id="sp-div-left" style="margin-left: 410px;">
                    <p style="font-size: 25px; margin-top: -3%;">
                        Confirmation  #: <u><b>' . $codconf . '</b></u>
                    </p>
                </div>
            </div>
        </header><br>
       
        <div id="contenido">
            <p style="font-size: 27px;  margin-left: 45%;">
                E-Ticket
            </p>
            <p style="font-size: 27px;">
                <i>
                    <u>
                        <b>Passenger Information</b>
                    </u>
                </i>
            </p>
            <p>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone3 . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#FBFFD8" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
            
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>ONE-WAY</b></i> </td>
                    </tr>
                    <tr>
                        <th align="center" style="width: 16%;">Date</th>
                        <th align="center" style="width: 12%;">Trip</th>
                        <th align="center" style="width: 32%;">Departure Time</th>
                        <th align="center" style="width: 45%;">From</th>
                        <th align="center" style="width: 45%;">To</th>
                        <th align="center" style="width: 30%;">Arrival Time</th>
                       
                    </tr>
                </thead>
                <tbody style="border-top: 1px solid #000;">
                <tbody>
                    <tr>
                        <td align="center">' . $fecha_salida . '</td>
                        <td align="center">' . $trip_no . '</td>
                        <td align="center">' . $deptime1 . '</td>
                        <td align="left">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>
                    </tr>
                  
                </tbody>
            </table> <br />
            <label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 350px;">
             
            </textarea>
            </label>
            
           
                        
            <div id="caja-contenido" style="margin-left: 56%; margin-top: -41%; display:none;">
                <table border="0" width ="245"  bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
              
                <thead>
               
                <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                   
                </thead>
                
                <tbody>
                    <tr>
                        <td align="left" style="width: 44.5%;">One Way-Trip Adult:</td>
                        <td align="right">$&nbsp;' . $adulto . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $axa2 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="width: 44%;">One Way-Trip Child:</td>
                        <td align="right">$&nbsp;' . $nino . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $nxc . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $neto . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;00.00 </td>                        
                    </tr>                  
                    
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
                </tbody>
                </table> <br />
            </div>
            
           
            <img src="global/img/codigo.png" alt="" style="width: 25%; margin-left: 75%; margin-top: -20%;" />
            <br><br>
            <p style="text-align: center; margin-top: -6.5px;">
                Thank you for traveling with Super Tours of Orlando!            
            </p>
            
        </div>

	';

            $codigoHTML.='
    
</body>
</html>';
        }

///////////// ROUND TRIP /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if (($agencia == 45 OR $agencia == 53)  AND $tipo_ticket == 'roundtrip') {


            $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <img src="global/img/icono26anios.png" alt="" style="width: 25%;" />
                </div>
                <div id="sp-div-left" style="margin-left: 410px;">
                    <p style="font-size: 25px; margin-top: -4%;">
                        Confirmation  #: <u><b>' . $codconf . '</b></u>
                    </p>
                </div>
            </div>
        </header><br>
       
        <div id="contenido" style="">
            <p style="font-size: 27px;  margin-left: 45%;margin-top:-4.5%;">
                E-Ticket
            </p>
            <p style="font-size: 27px;">
                <i>
                    <u>
                        <b>Passenger Information</b>
                    </u>
                </i>
            </p>
            <p>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone3 . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>ROUND-TRIP</b></i> </td>
                    </tr>
                    <tr>
                        <th align="center" style="width: 16%;">Date</th>
                        <th align="center" style="width: 12%;">Trip</th>
                        <th align="center" style="width: 32%;">Departure Time</th>
                        <th align="center" style="width: 45%;">From</th>
                        <th align="center" style="width: 45%;">To</th>
                        <th align="center" style="width: 30%;">Arrival Time</th>
                       
                    </tr>
                </thead>
                <tbody style="border-top: 1px solid #000;">
                    <tr>
                        <td align="center">' . $fecha_salida . '</td>
                        <td align="center">' . $trip_no . '</td>
                        <td align="center">' . $deptime1 . '</td>
                        <td align="left">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>                       
                    </tr>
                </tbody> 
                <tbody style="border-top: 1px solid #000;">
                    <tr>
                        <td align="center">' . $fecha_retorno . '</td>
                        <td align="center">' . $trip_no2 . '</td>
                        <td align="center">' . $deptime2 . '</td>
                        <td align="left">' . $from2 . '<br>' . $lugar3 . '<br>' . $direccion3 . '</td>
                        <td align="left">' . $to2 . '<br>' . $lugar4 . '<br>' . $direccion4 . '</td>
                        <td align="center">' . $arrtime2 . '</td>
                    </tr>
                    </tbody> 
                  
                
            </table> <br />
            <label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 300px;">
             
            </textarea>
            </label>
            
           
                        
            <div id="caja-contenido" style="margin-left: 56%; margin-top: -35%;">
                <table border="0" width ="245"  bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
              
                <thead>
               
                <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                   
                </thead>
                
                <tbody>
                    <tr>
                        <td align="left" style="width: 44.5%;">Round-Trip Adult:</td>
                        <td align="right">$&nbsp;' . $adulto . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $axa2 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="width: 44%;">Round-Trip Child:</td>
                        <td align="right">$&nbsp;' . $nino . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $nxc . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $neto . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;00.00 </td>                        
                    </tr>                  
                    
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
                </tbody>
                </table> <br />
            </div>
            
           
            <img src="global/img/codigo.png" alt="" style="width: 25%; margin-left: 75%; margin-top: -20%;" />
            <br>
            <p style="text-align: center; margin-top: 2.5%;">
                Thank you for traveling with Super Tours of Orlando!            
            </p>
            
        </div>

	';

            $codigoHTML.='
    
</body>
</html>';
        }

        if ($agencia != 45 && $tipo_ticket == 'roundtrip') {

            $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <img src="global/img/icono26anios.png" alt="" style="width: 25%;" />
                </div>
                <div id="sp-div-left" style="margin-left: 410px;">
                    <p style="font-size: 25px; margin-top: -3%;">
                        Confirmation  #: <u><b>' . $codconf . '</b></u>
                    </p>
                </div>
            </div>
        </header><br>
       
        <div id="contenido">
            <p style="font-size: 27px;  margin-left: 45%;">
                E-Ticket
            </p>
            <p style="font-size: 27px;">
                <i>
                    <u>
                        <b>Passenger Information</b>
                    </u>
                </i>
            </p>
            <p>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone3 . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#FBFFD8" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>ROUND-TRIP</b></i> </td>
                    </tr>
                    <tr>
                        <th align="center" style="width: 16%;">Date</th>
                        <th align="center" style="width: 12%;">Trip</th>
                        <th align="center" style="width: 32%;">Departure Time</th>
                        <th align="center" style="width: 45%;">From</th>
                        <th align="center" style="width: 45%;">To</th>
                        <th align="center" style="width: 30%;">Arrival Time</th>
                       
                    </tr>
                </thead>
                <tbody style="border-top: 1px solid #000;">
                    <tr>
                        <td align="center">' . $fecha_salida . '</td>
                        <td align="center">' . $trip_no . '</td>
                        <td align="center">' . $deptime1 . '</td>
                        <td align="left">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>
                    </tr>
                    </tbody>
                    <tbody style="border-top: 1px solid #000;">
                    
                    <tr>
                        <td align="center">' . $fecha_retorno . '</td>
                        <td align="center">' . $trip_no2 . '</td>
                        <td align="center">' . $deptime2 . '</td>
                        <td align="left">' . $from2 . '<br>' . $lugar3 . '<br>' . $direccion3 . '</td>
                        <td align="left">' . $to2 . '<br>' . $lugar4 . '<br>' . $direccion4 . '</td>
                        <td align="center">' . $arrtime2 . '</td>
                    </tr>
                  
                </tbody>
            </table> <br />
            <label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 290px;">
             
            </textarea>
            </label>
            
           
                        
            <div id="caja-contenido" style="margin-left: 56%; margin-top: -41%; display:none;">
                <table border="0" width ="245"  bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
              
                <thead>
               
                <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                   
                </thead>
                
                <tbody>
                    <tr>
                        <td align="left" style="width: 44.5%;">Round-Trip Adult:</td>
                        <td align="right">$&nbsp;' . $adulto . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $axa2 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="width: 44%;">Round-Trip Child:</td>
                        <td align="right">$&nbsp;' . $nino . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $nxc . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $neto . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;00.00 </td>                        
                    </tr>                  
                    
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
                </tbody>
                </table> <br />
            </div>
            
           
            <img src="global/img/codigo.png" alt="" style="width: 25%; margin-left: 75%; margin-top: -28%;" />
            <br>
            <p style="text-align: center; margin-top: -1%;">
                Thank you for traveling with Super Tours of Orlando!            
            </p>
            
        </div>

	';

            $codigoHTML.='
    
</body>
</html>';
        }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        Doo::loadHelper('DooPDF');
        
        
        
        
        //$pdf = new DooPDF('Summary Transportation' . ' [' . $tipo_ticket . ' ' . ' ' . date('Y-m-d') . ']', $codigoHTML, false, 'letter', 'letter');
        $pdf = new DooPDF('Summary Transportation', $codigoHTML, false, 'letter', 'letter');
        
        
 
//            if( file_put_contents(Doo::conf ()->APP_URL."global/files/".$this->name, $pdf->doPDF()) ) header('Location: '.Doo::conf ()->APP_URL."global/files/".$this->name);
       // file_put_contents(Doo::conf ()->APP_URL."global/files/".$this->name, $pdf->doPDF());
       // header('Location: '.Doo::conf ()->APP_URL."global/files/".$this->name);

        //$archivo=$codigoHTML;
        
        $pdf->doPDF();
        
        
        
        //$archivo = file_put_contents('Summary Transportation.pdf', $pdf->doPDF());
        
       // $archivo = $pdf;
        
        //$pdf->stream("Summary Transportation.pdf");
        //file_put_contents("Summary Transportation.pdf");
        //$archivo = "https://www.supertours.com/Logo-Supertours-mail.jpg";
        
        $path="https://www.supertours.com/global/img/offer.png";
        //$path="global/Summary Transportation.pdf";
        $archivo = $path;
        //file_put_contents("FPDF/Summary Transportation.pdf", $pdf);
        
        $from = "arturo@supertours.com";
        $to = "bustamante3@hotmail.com";
        
       
        Doo::loadHelper('AttachMailer');
        
         //$mailer = new AttachMailer("correo@correo.com", "correo_destino@correo.com", "asunto", "hello contenido del mensaje");
        //$mailer = new AttachMailer($from, $to, "E-Ticket Transportation", "$pdf");
        $mailer = new AttachMailer($from, $to, "E-Ticket Transportation", "$codigoHTML");
        //$mailer->attachFile($archivo);
        //$mail­>AddAttachment("ruta/archivo_adjunto.gif");
        //https://www.supertours.com/icono26anios.png
        $mailer->attachFile("$archivo");
        //$mailer->attachFile('Downloads/'.$_FILES['Summary Transportation.pdf']['Summary Transportation.pdf']);
        $resultado = ($mailer->send() ? "Enviado" : "Problemas al enviar");

        echo($resultado);
        
        
//        $mailtransp = new PHPMailer(true);
//        $mailtransp = $datosMail->datos();
//            //Para quien va.
//        if ($cliente->username != '') {
//            $mail4->AddAddress($cliente->username, $cliente->firstname . ' ' . $cliente->lastname);
//            }
//        $login = $_SESSION['login'];
//        $mailtransp->AddAddress($login->email, $login->nombre . '(' . $login->usuario . ')');
//        $mailtransp->Subject = 'Reservations Super Tours OF Orlando';
//        $mailtransp->AltBody = 'Reservations Super Tours OF Orlando'; //El cuerpo del mensaje, puede ser con etiquetas HTML
//        $mailtransp->MsgHTML($this->txtCorreo($r, $r_a));
//        $mailtransp->Send();
//        
        
//        $mail = new PHPMailer(true);
//
//        //Luego tenemos que iniciar la validación por SMTP:
//        $mail->IsSMTP();
//        $mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
//        $mail->Username = "$from"; // Cuenta de e-mail
//        $mail->Password = "abc123"; // Password
//
//
//        $mail->Host = "smtpout.secureserver.net";
//        $mail->From = "$from";
//        $mail->FromName = "Reservations Super Tours OF Orlando";
//        $mail->Subject = "E-ticket";
//        $mail->AddAddress("$to","Prueba");
//
//        $mail->WordWrap = 50;
//
//        $body  = "Hola, este es un…";
//        $body .= "<font color='red'> mensaje de prueba</font>";
//
//        $mail->Body = $codigoHTML;
//        //$mail->AddAttachment("imagenes/img.jpg", "nombre_a_mostrar.jpg");
//        //$mail->AddCC("cuenta@dominio.com"); cuentas con CC o CCO
//        //$mail->AddBCC("cuenta@dominio.com");
//        $mail->IsHTML(true); // El correo se envía como HTML
//
//        $mail->Send();
////
////
//        // Notificamos al usuario del estado del mensaje
//
//        if(!$mail->Send()){
//           echo "No se pudo enviar el Mensaje.";
//        }else{
//           echo "Mensaje enviado";
//        }
//        
//        
//        
        
        
        
//        $mail->Body = $body;
//        $mail->AltBody = “Hola amigo\nprobando PHPMailer\n\nSaludos”;
//        $mail->AddAttachment(“images/foto.jpg”, “foto.jpg”);
//        $mail->AddAttachment(“files/demo.zip”, “demo.zip”);
       
    }

    public function save_editReserve() {
        extract($_POST, EXTR_SKIP);

        Doo::loadModel("Reserve");
        try {
            Doo::db()->beginTransaction();
            if (isset($ext_from1) && $ext_from1 != 0) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_from1));
                $datos = $rs->fetch();
                $precio_e1 = $datos['precio'];
                $extension1 = $datos['id'];
            } else {
                $precio_e1 = 0;
                $extension1 = 0;
            }
            if (isset($ext_to1) && $ext_to1 != 0) {
                $sql = "SELECT id, precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_to1));
                $datos = $rs->fetch();
                $precio_e2 = $datos['precio'];
                $extension2 = $datos['id'];
            } else {
                $precio_e2 = 0;
                $extension2 = 0;
            }

            if (isset($ext_from2) && $ext_from2 != 0) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_from2));
                $datos = $rs->fetch();

                $precio_e3 = $datos['precio'];
                $extension3 = $datos['id'];
            } else {
                $precio_e3 = 0;
                $extension3 = 0;
            }
            if (isset($ext_to2) && $ext_to2 != 0) {
                $sql = "SELECT id,precio FROM extension WHERE id = ?";
                $rs = Doo::db()->query($sql, array($ext_to2));
                $datos = $rs->fetch();

                $precio_e4 = $datos['precio'];
                $extension4 = $datos['id'];
            } else {
                $precio_e4 = 0;
                $extension4 = 0;
            }
            $tipoticket = ""; // Tipo de tiquete
            if ($tipo_ticket == 1) {
                $tipoticket = "oneway";
            } else {
                $tipoticket = "roundtrip";
            }
            if (!isset($_SESSION['codconf'])) {
                if (trim($estado) == 'QUOTE') {
                    $_SESSION['codconf'] = $this->codigoConf(0);
                } else {
                    $_SESSION['codconf'] = $this->codigoConf(1);
                }
            } else {
                $codconf = $_SESSION['codconf'];
            }
            Doo::loadModel("Agency");
            if ($id_agency != -1) {
                $dat = new Agency();
                $dat->id = $id_agency;
                $agencys = Doo::db()->find($dat, array("limit", 1));
                $dat = new Agency($agencys[0]);
                Doo::loadModel('UserA');
                $usera = new UserA();
                if (($id_auser == '' || $id_auser == '-1') && $uagency != '') {
                    $usera->id_agencia = $dat->id;
                    $usera->active = false;
                    $usera->firstname = $uagency;
                    $usera->email = $dat->main_email;
                    $usera->id = Doo::db()->insert($usera);
                } else {
                    $usera->id = $id_auser;
                    $usera = Doo::db()->getOne($usera);
                }
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }

            if (isset($_REQUEST['opcion_pago'])) {
                $pago = $_REQUEST['opcion_pago'];
            } else
                $pago = 1;

            if (isset($_REQUEST['opcion_pago_saldo'])) {
                $opcion_saldo = $_REQUEST['opcion_pago_saldo'];
            } else
                $opcion_saldo = 1;

            $r_anterior = new Reserve($_SESSION['reserva_edit']); //Datos de la reserva anterior
            $id_reserva = $r_anterior->id;
            $pregunta_reserva = Doo::db()->getOne("Reserve", array("where" => "id = ?", "param" => array($r_anterior->id)));
            $reserve = new Reserve();

            $op = $this->types_payments();
            //La Reserva
            $arval = array_values($op[$pago]);
            $arkey = array_keys($op[$pago]);
            $tipoP = $arkey[0];
            $formaP = $arval[0];
            if ($opcion_saldo == 2) {
                $tiposaldo = "BALANCE";
            } else {
                $tiposaldo = "FULL";
            }
            $fecha_salida_org = $fecha_salida;
            $fecha_retorno_org = $fecha_retorno;

            list ($mes, $dia, $anyo) = explode("-", $fecha_salida);
            $fecha_salida = $anyo . "-" . $mes . "-" . $dia;
            if ($tipoticket == 'roundtrip') {
                list ($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
                $fecha_retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
            } else {
                $fecha_retorno = 'N/A';
            }
            if (!is_numeric($extra)) {
                $extra = 0;
            }
            if (0 > $extra) {
                $extra = 0;
            }
            if (!is_numeric($otheramount)) {
                $otheramount = 0;
            }
            if (0 > $otheramount) {
                $otheramount = 0;
            }

            //$total_neto = $totP;
//            $prince_trip_1 = $this->trip_price($trip_no, $dat, $fecha_salida, $fromt, $to, $tipo_pass);
//
//
//            if (isset($trip_no2)) {
//                if ($trip_no2 != "" && $trip_no2 != 0) {
//                    $prince_trip_2 = $this->trip_price($trip_no2, $dat, $fecha_retorno, $fromt2, $to2, $tipo_pass);
//                }
//            }
//        print_r($_SESSION['reserva_edit']);
//        exit;            
            //primera pregunta if fecha departur, id from, id to, trip 1 $pregunta_reserva->fecha_salida != $fecha_salida || $pregunta_reserva->fromt != $fromt || $pregunta_reserva->tot != $to || $pregunta_reserva->trip_no != $trip_no ||
//            echo $fecha_salida;
//            exit;
            if ($pregunta_reserva->trip_no != $trip_no || $id_agency != $pregunta_reserva->agen /* || $fecha_salida != '0000-00-00' */) {

                $prince_trip_1 = $this->trip_price($trip_no, $dat, $fecha_salida_org, $fecha_salida, $fromt, $to, $pregunta_reserva->resident);
                /** Discriminacion de Precios */
                $reserve->precio_trip1_a = $prince_trip_1["price_adult"];
                $reserve->precioA = $prince_trip_1["price_adult"] * $pax; //--
                if ($pax2 > 0) {
                    $reserve->precio_trip1_c = $prince_trip_1["price_child"];
                    $reserve->precioN = $prince_trip_1["price_child"] * $pax2; //--
                }
            } else {

                $reserve->precio_trip1_a = $pregunta_reserva->precio_trip1_a;
                $reserve->precioA = $pregunta_reserva->precio_trip1_a * $pax; //--
                if ($pax2 > 0) {
                    $reserve->precio_trip1_c = $pregunta_reserva->precio_trip1_c;
                    $reserve->precioN = $pregunta_reserva->precio_trip1_c * $pax2; //--
                }
            }
            if (isset($trip_no2)) {
                //$pregunta_reserva->fecha_retorno != $fecha_retorno || $pregunta_reserva->fromt2 != $fromt2 || $pregunta_reserva->tot2 != $to2 || $pregunta_reserva->trip_no2 != $trip_no2 || 
                if ($pregunta_reserva->trip_no2 != $trip_no2 || $id_agency != $pregunta_reserva->agen /* || $fecha_retorno != '0000-00-00' */) {
                    if ($trip_no2 != "" && $trip_no2 != 0) {
                        $prince_trip_2 = $this->trip_price($trip_no2, $dat, $fecha_retorno_org, $fecha_retorno, $fromt2, $to2, $pregunta_reserva->resident);
                        $reserve->precio_trip2_a = $prince_trip_2["price_adult"];
                        $reserve->precioA = $reserve->precioA + ($prince_trip_2["price_adult"] * $pax);
                        $reserve->precio_trip2_c = $prince_trip_2["price_child"];
                        if ($pax2 > 0) {
                            $reserve->precioN = $reserve->precioN + ($prince_trip_2["price_child"] * $pax2); //--
                        }
                    }
                } else {
                    $reserve->precio_trip2_a = $pregunta_reserva->precio_trip2_a;
                    $reserve->precioA = $reserve->precioA + ($pregunta_reserva->precio_trip2_a * $pax);
                    $reserve->precio_trip2_c = $pregunta_reserva->precio_trip2_c;
                    if ($pax2 > 0) {
                        $reserve->precioN = $reserve->precioN + ($pregunta_reserva->precio_trip2_c * $pax2); //--
                    }
                }
            } else {
                $reserve->precio_trip2_a = 0;
                $reserve->precio_trip2_c = 0;
            }

            /** Extensiones * */
            if ($extension1 != 0) {
                if ($pregunta_reserva->extension1 != $extension1) {
                    $precio_exten1 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension1)));
                    if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                        $precio_extension1 = $precio_exten1->precio_especial;
                    } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                        $precio_extension1 = $precio_exten1->precio_neto;
                    } else {
                        $precio_extension1 = $precio_exten1->precio;
                    }
                    $reserve->precio_exten1_a = $precio_extension1;
                    $reserve->precio_exten1_c = $precio_extension1;
                    $reserve->precio_e1 = $precio_extension1; //antiguo campo
                } else {
                    $reserve->precio_exten1_a = $pregunta_reserva->precio_exten1_a;
                    $reserve->precio_exten1_c = $pregunta_reserva->precio_exten1_c;
                    $reserve->precio_e1 = $pregunta_reserva->precio_e1; //antiguo campo
                }
            } else {
                $reserve->precio_exten1_a = 0;
                $reserve->precio_exten1_c = 0;
                $reserve->precio_e1 = 0; //antiguo campo
            }
            if ($extension2 != 0) {
                if ($pregunta_reserva->extension2 != $extension2) {
                    $precio_exten2 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension2)));
                    if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                        $precio_extension2 = $precio_exten2->precio_especial;
                    } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                        $precio_extension2 = $precio_exten2->precio_neto;
                    } else {
                        $precio_extension2 = $precio_exten2->precio;
                    }
                    $reserve->precio_exten2_a = $precio_extension2;
                    $reserve->precio_exten2_c = $precio_extension2;
                    $reserve->precio_e2 = $precio_extension2; //antiguo campo
                } else {
                    $reserve->precio_exten2_a = $pregunta_reserva->precio_exten2_a;
                    $reserve->precio_exten2_c = $pregunta_reserva->precio_exten2_c;
                    $reserve->precio_e2 = $pregunta_reserva->precio_e2; //antiguo campo
                }
            } else {
                $reserve->precio_exten2_a = 0;
                $reserve->precio_exten2_c = 0;
                $reserve->precio_e2 = 0;
            }
            if ($extension3 != 0) {
                if ($pregunta_reserva->extension3 != $extension3) {
                    $precio_exten3 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension3)));
                    if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                        $precio_extension3 = $precio_exten3->precio_especial;
                    } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                        $precio_extension3 = $precio_exten3->precio_neto;
                    } else {
                        $precio_extension3 = $precio_exten3->precio;
                    }
                    $reserve->precio_exten3_a = $precio_extension3;
                    $reserve->precio_exten3_c = $precio_extension3;
                    $reserve->precio_e3 = $precio_extension3; //antiguo campo
                } else {
                    $reserve->precio_exten3_a = $pregunta_reserva->precio_exten3_a;
                    $reserve->precio_exten3_c = $pregunta_reserva->precio_exten3_c;
                    $reserve->precio_e3 = $pregunta_reserva->precio_e3; //antiguo campo
                }
            } else {
                $reserve->precio_exten3_a = 0;
                $reserve->precio_exten3_c = 0;
                $reserve->precio_e3 = 0;
            }
            if ($extension4 != 0) {
                if ($pregunta_reserva->extension4 != $extension4) {
                    $precio_exten4 = Doo::db()->getOne("Extension", array("where" => "id = ?", "param" => array($extension4)));
                    if ($dat->precio_especial_exten == 1 && $dat->id != -1) {
                        $precio_extension4 = $precio_exten4->precio_especial;
                    } else if ($dat->id != -1 && $dat->precio_especial_exten == 0) {
                        $precio_extension4 = $precio_exten4->precio_neto;
                    } else {
                        $precio_extension4 = $precio_exten4->precio;
                    }
                    $reserve->precio_exten4_a = $precio_extension4;
                    $reserve->precio_exten4_c = $precio_extension4;
                    $reserve->precio_e4 = $precio_extension4; //antiguo campo
                } else {
                    $reserve->precio_exten4_a = $pregunta_reserva->precio_exten4_a;
                    $reserve->precio_exten4_c = $pregunta_reserva->precio_exten4_c;
                    $reserve->precio_e4 = $pregunta_reserva->precio_e4; //antiguo campo
                }
            } else {
                $reserve->precio_exten4_a = 0;
                $reserve->precio_exten4_c = 0;
                $reserve->precio_e4 = 0;
            }
            $precio_extension_adultos = ($reserve->precio_exten1_a + $reserve->precio_exten2_a + $reserve->precio_exten3_a + $reserve->precio_exten4_a);
            $precio_extension_children = ($reserve->precio_exten1_c + $reserve->precio_exten2_c + $reserve->precio_exten3_c + $reserve->precio_exten4_c);
            $total_neto = (($reserve->precioA + $reserve->precioN) + ($precio_extension_adultos * $pax) + ($precio_extension_children * $pax2));

            $val_procentaje = 0;
            if ($descuento > 0) {
                $val_procentaje = ($total_neto * $descuento) / 100;
            } else {
                $descuento = 0;
            }

            $total_neto+= $extra; //los extra siempre los ganara supertours

            $total_reserva = $total_neto - $val_procentaje - $descuento_valor;

//            if ($otheramount > 0) {
//                $total_reserva = $otheramount; // si se cobrara otro monto, el total de la reserva sera ese monto
//            }

            if ($totalcom > 0 && $opcion_saldo == 1) {
                $total_reserva += $totalcom;
            }
            if ($pregunta_reserva->id < 17670) {

                if ($pago == '3') {//"Credit Card+ 3 % FEE
                    $total_reserva = $total_reserva + ($total_reserva * 0.03);
                }
                if ($pago == '1') {//"Credit Card+ 3 % FEE
                    $total_reserva = $total_reserva + ($total_reserva * 0.03);
                }
                if ($pago == '7') {
                    $total_reserva = 0;
                }
            } else {
                if ($pago == '3') {//"Credit Card+ 3 % FEE
                    $total_reserva = $total_reserva + ($total_reserva * 0.04);
                }
                if ($pago == '1') {//"Credit Card+ 3 % FEE
                    $total_reserva = $total_reserva + ($total_reserva * 0.04);
                }
                if ($pago == '7') {
                    $total_reserva = 0;
                }
            }

            $reserve->id = $r_anterior->id;
            $reserve->id_tours = -1;
            $reserve->type_tour;
            $reserve->fecha_ini = $r_anterior->fecha_ini;
            $reserve->trip_no = $trip_no;
            $reserve->trip_no2 = $trip_no2;
            $reserve->tipo_ticket = $tipoticket;
            $reserve->fromt = $fromt;
            $reserve->tot = $to;
            if ($tipoticket == 'roundtrip') {
                $reserve->deptime2 = date("H:i", strtotime($departure2));
                $reserve->arrtime2 = date("H:i", strtotime($arrival2));
                $reserve->fromt2 = $fromt2;
                $reserve->tot2 = $to2;
            }

            if (isset($_POST["byr"])) {
                $reserve->customer_disabilities = 1;
            }
            $reserve->firsname = $firstname1;
            $reserve->lasname = $lastname1;
            $reserve->email = $email1;

            $reserve->deptime1 = date("H:i", strtotime($departure1));

            $reserve->arrtime1 = date("H:i", strtotime($arrival1));


            $reserve->extension1 = $extension1;
            $reserve->extension2 = $extension2;
            $reserve->extension3 = $extension3;
            $reserve->extension4 = $extension4;

            $reserve->pickup_exten1 = isset($exten1) ? $exten1 : '';
            $reserve->pickup_exten2 = isset($exten2) ? $exten2 : '';

            $reserve->pickup_exten3 = isset($exten3) ? $exten3 : '';
            $reserve->pickup_exten4 = isset($exten4) ? $exten4 : '';

            $reserve->room1 = isset($room1) ? $room1 : '';
            $reserve->room2 = isset($room2) ? $room2 : '';

            $reserve->fecha_salida = $fecha_salida;
            $reserve->fecha_retorno = $fecha_retorno;
            $reserve->pax = $pax;
            $reserve->pax2 = $pax2;
            $reserve->pax3 = $infat;

            if ($idCliente != 0 && trim($idCliente) != '') {
                $reserve->id_clientes = $idCliente;
            }
            $reserve->pickup1 = ($id_p1 != '') ? $id_p1 : 0;
            $reserve->dropoff1 = ($id_dropoff1 != '') ? $id_dropoff1 : 0;
            $reserve->pickup2 = ($id_pickup2 != '') ? $id_pickup2 : 0;
            $reserve->dropoff2 = ($id_dropoff2 != '') ? $id_dropoff2 : 0;
            $reserve->tipo_pago = $tipoP;
            $reserve->pago = $formaP . '-' . $tiposaldo;
            $reserve->op_pago = $pago;
            $reserve->totaltotal = $total_reserva;
            $reserve->otheramount = $otheramount;
            $reserve->descuento_procentaje = $descuento;
            $reserve->descuento_valor = $descuento_valor;
            $reserve->extra_charge = $extra;
            $reserve->total2 = $total_neto;
            $reserve->codconf = $r_anterior->codconf;
            $reserve->hora = $r_anterior->hora;
            $reserve->comments = $notes;
            $reserve->resident = $tipo_pass;
            $reserve->agen = $id_agency;
            $reserve->tipo_client = $type_cliente;
            $reserve->reward_id;
            $reserve->agency = $id_agency;
            $reserve->luggage1 = $r_anterior->luggage1;
            $reserve->luggage2 = $r_anterior->luggage2;
            $reserve->canal = $canal;
            if ($estado == '') {
                $reserve->estado = $r_anterior->estado;
            } else if ($r_anterior->estado == 'INVOICED') {
                $reserve->estado = 'INVOICED';
            } else {
                $reserve->estado = $estado;
            }
            $done = Doo::db()->update($reserve);

            $login = $_SESSION['login'];
            $login->tipo = 'OPERATOR';
            $r_anterior->paid = 0;
            if ($pay_amount != "" && $pay_amount > 0) {
                $option = $this->types_payments();
                if (isset($_REQUEST['opcion_pago_2'])) {
                    $pago_2 = $_REQUEST['opcion_pago_2'];
                }
                $arval = array_values($option[$pago_2]);
                $arkey = array_keys($option[$pago_2]);
                $tipoP_2 = $arkey[0];
                $formaP_2 = $arval[0];
                //La Reserva

                $reserve->paid = $pay_amount;
                $this->registrar_pago($reserve, NULL, $login, $pay_amount, $tipoP_2, $formaP_2);
            } else {
                $reserve->paid = 0;
            }
//            if ($done) {
//                if (isset($_SESSION['reinvoicing'])) {
//                    $_SESSION['reinvoicing'] = true;
//                }               
//                $this->registrar_pago($reserve, $r_anterior, $login);                

            $this->rastro_reserva('UPDATE', $r_anterior, $reserve, $login);
            unset($_SESSION['reserva_edit']);
//            }

            if ($id_agency != -1) {
                Doo::loadModel("Reservas_Agency");
                $reserves_a = new Reservas_Agency();
                $reserves_a->id_reservas = $reserve->id;
                $reserves_a = Doo::db()->find($reserves_a, array('limit' => 1));

                if ($reserves_a != null) {
                    $id_reser_agency = $reserves_a->id;
                } else {
                    $id_reser_agency = 0;
                }
                if ($dat->type_rate == 1) {
                    $comision = 0;
                } else {
                    Doo::loadController("MainController");
                    $main = new MainController();
                    $comision = ($main->cal_equipament($reserve->trip_no) + $main->cal_equipament($reserve->trip_no2)) / 2;
                }
                if ($opcion_saldo == 2 && $pago != 5) {
                    $total_pagado = $total_neto - $totalcom;
                } else {
                    $total_pagado = $total_reserva;
                }
                $reserves_a = new Reservas_Agency();
                if ($id_reser_agency != 0) {
                    $reserves_a->id = $id_reser_agency;
                }

                $reserves_a->id_reservas = $reserve->id;
                $reserves_a->id_agencia = $id_agency;
                $reserves_a->id_cliente = $idCliente;
                $reserves_a->type_client = $type_cliente;
                $reserves_a->id_useragency = $usera->id;
                $reserves_a->paid_type = $tipoP;
                $reserves_a->metodo_paid = $formaP . '-' . $tiposaldo;
                $reserves_a->comision = $comision;
                $reserves_a->agency_fee = $total_neto * $comision / 100;
                $reserves_a->paper_voucher = 0;
                $reserves_a->paid_net = $total_neto;
                $reserves_a->paid_full = $total_pagado;
                Doo::db()->update($reserves_a);
            }

            unset($_SESSION['codconf']);

//            if (isset($_SESSION['reinvoicing'])) {
//                echo '<script>window.close();</script>';
//                exit;
//            }
            //generando trafico
            Doo::loadController("admin/TrafficController");
            $traffic = new TrafficController();
            if ($fecha_salida != "0000-00-00") {
                $datos = $traffic->generate_and_search_traffics($r_anterior->id, "RESERVE", false, true);
            }

            Doo::db()->commit();

            return Doo::conf()->APP_URL . "admin/reservas/edit/$id_reserva?menssage=Actualizado Correctamente";
        } catch (Exception $exc) {
            Doo::db()->rollBack();
            return Doo::conf()->APP_URL . "admin/reservas/edit/$id?error=Errores al actualizar";
        }
    }

    public function correo($r, $r_a) {
        Doo::loadModel("Reserve");
        Doo::loadModel("Clientes");
        $reserve = new Reserve();
        $reserve = $r;
        try {
            if ($reserve->id_clientes == NULL) {
                $cliente = new Clientes();
                $cliente->id = $reserve->id_clientes;
                $cliente->username = $reserve->email;
                $cliente->firstname = $reserve->firsname;
                $cliente->lastname = $reserve->lasname;
            } else {
                $cliente = new Clientes();
                $cliente->id = $reserve->id_clientes;
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
                if (empty($cliente)) {
                    $cliente = new Clientes();
                    $cliente->id = $reserve->id_clientes;
                    $cliente->username = $reserve->email;
                    $cliente->firstname = $reserve->firsname;
                    $cliente->lastname = $reserve->lasname;
                } else {
                    $cliente = new Clientes();
                    $cliente->id = $reserve->id_clientes;
                    $cliente->username = $reserve->email;
                    $cliente->firstname = $reserve->firsname;
                    $cliente->lastname = $reserve->lasname;
                }
            }
            Doo::loadController('DatosMailController');
            $datosMail = new DatosMailController();
            $mail4 = new PHPMailer(true);
            $mail4 = $datosMail->datos();
            //Para quien va.
            if ($cliente->username != '') {
                $mail4->AddAddress($cliente->username, $cliente->firstname . ' ' . $cliente->lastname);
            }
            $login = $_SESSION['login'];
            $mail4->AddAddress($login->email, $login->nombre . '(' . $login->usuario . ')');
            $mail4->Subject = 'Reservations Super Tours OF Orlando';
            $mail4->AltBody = 'Reservations Super Tours OF Orlando'; //El cuerpo del mensaje, puede ser con etiquetas HTML
            $mail4->MsgHTML($this->txtCorreo($r, $r_a));
            $mail4->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Errores de cualquier otra cosa.
        }
        return Doo::conf()->APP_URL . 'admin/reservas';
    }

    public function txtCorreo($reserve, $reserver_a) {
        Doo::loadModel("Reserve");
        Doo::loadModel("Clientes");
        Doo::loadModel("Routes");
        Doo::loadModel("Agency");
        Doo::loadModel("PickupDropoff");
        Doo::loadModel("Extension");
        Doo::loadModel("UserA");
        Doo::loadModel("Reservas_Agency");
        Doo::loadModel("Areas");
        //Datos del clietne;
        if ($reserve->id_clientes == NULL) {
            $cliente = new Clientes();
            $cliente->id = $reserve->id_clientes;
            $cliente->username = $reserve->email;
            $cliente->firstname = $reserve->firsname;
            $cliente->lastname = $reserve->lasname;
        } else {
            $cliente = new Clientes();
            $cliente->id = $reserve->id_clientes;
            $cliente = Doo::db()->find($cliente, array('limit' => 1));
            if (empty($cliente)) {
                $cliente = new Clientes();
                $cliente->id = $reserve->id_clientes;
                $cliente->username = $reserve->email;
                $cliente->firstname = $reserve->firsname;
                $cliente->lastname = $reserve->lasname;
            }
        }
        //Usuario que dio la orden de la creacion de la reserva, en case que sea de agencia.
        if ($reserver_a != NULL && $reserve->pago == 'Agency Credit Card') {
            $agencia = new Agency();
            $agencia->id = $reserve->agency;
            $agencia = Doo::db()->find($agencia, array('limit' => 1));
            $userA = UserA();
            $userA->id = $reserver_a->id_useragency;
            $userA = Doo::db()->find($userA, array('limit' => 1));
            if (!empty($userA)) {
                $login = new Clientes();
                $login->username = $userA->email;
                $login->firstname = $userA->firstname;
                $login->lastname = $userA->lastname;
                $login->city = $agencia->city;
                $login->zipcode = $agencia->zipcode;
                $login->country = $agencia->country;
                $login->phone = $agencia->phone1;
                $login->address = $agencia->address;
                $login->state = $agencia->state;
            } else {
                $login = new Clientes();
                $login = $cliente;
            }
        } else {
            $login = new Clientes();
            $login = $cliente;
        }

        //Area
        $from = new Areas();
        $from->id = $reserve->fromt;
        $to = new Areas();
        $to->id = $reserve->tot;
        $from = Doo::db()->find($from, array('limit' => 1));
        $to = Doo::db()->find($to, array('limit' => 1));


        $p1 = $p2 = $d1 = $d2 = '';
        //PickupDropoff-IDA
        if ($reserve->pickup1 != 0) {
            $pickup1 = new PickupDropoff();
            $pickup1->id = $reserve->pickup1;
            $pickup1 = Doo::db()->find($pickup1, array('limit' => 1));
            $p1 = $pickup1->place;
        }
        if ($reserve->dropoff1 != 0) {
            $drop1 = new PickupDropoff();
            $drop1->id = $reserve->dropoff1;
            $drop1 = Doo::db()->find($drop1, array('limit' => 1));
            $d1 = $drop1->place;
        }

        //PickupDropoff-RETORNO
        if ($reserve->tipo_ticket == "roundtrip") {
            if ($reserve->pickup2 != 0) {
                $pickup2 = new PickupDropoff();
                $pickup2->id = $reserve->pickup2;
                $pickup2 = Doo::db()->find($pickup2, array('limit' => 1));
                $p2 = $pickup2->place;
            }
            if ($reserve->dropoff2 != 0) {
                $drop2 = new PickupDropoff();
                $drop2->id = $reserve->dropoff2;
                $drop2 = Doo::db()->find($drop2, array('limit' => 1));
                $d2 = $drop2->place;
            }
        }


        $e1 = $e2 = $e3 = $e4 = '';
        if ($reserve->extension1 != 0) {
            $extencion1 = new Extension();
            $extencion1->id = $reserve->extension1;
            $extencion1 = Doo::db()->find($extencion1, array('limit' => 1));
            $e1 = ' ' . $extencion1->place;
        }
        if ($reserve->extension2 != 0) {
            $extencion2 = new Extension();
            $extencion2->id = $reserve->extension2;
            $extencion2 = Doo::db()->find($extencion2, array('limit' => 1));
            $e2 = ' ' . $extencion2->place;
        }
        if ($reserve->extension3 != 0) {
            $extencion3 = new Extension();
            $extencion3->id = $reserve->extension3;
            $extencion3 = Doo::db()->find($extencion3, array('limit' => 1));
            $e3 = ' ' . $extencion3->place;
        }
        if ($reserve->extension4 != 0) {
            $extencion4 = new Extension();
            $extencion4->id = $reserve->extension4;
            $extencion4 = Doo::db()->find($extencion4, array('limit' => 1));
            $e4 = ' ' . $extencion4->place;
        }
        $var = explode('-', $reserve->pago);
        $tipoPago = strtoupper($var[0]);
        $otheramount = $reserve->otheramount;
        if ($reserver_a != NULL) {
            $pago = ( ($otheramount == 0) ? $reserver_a->paid_full : $otheramount );
            $pago = number_format($pago, 2, '.', ',');
        } else {
            $pago = ( ($otheramount == 0) ? $reserve->totaltotal : $otheramount );
            $pago = number_format($pago, 2, '.', ',');
        }


        $conten = "<head>
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
				</style></head>
		<div align='center'>
			<br />
			<table   id='clearTable'> 
				<tr>
				   <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
					   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
					 </tr>
					 <tr>
					   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . date('M-d-Y', strtotime($reserve->fecha_ini)) . " / " . date('g:i:a', strtotime($reserve->hora)) . "</td>
					</tr>
					 <tr>
					   <td align='center' height='33' colspan='4' id='titletd2'>" . $reserve->tipo_ticket . " E-TICKET</td>
					 </tr>
					 <tr>
					   <td height='15' id='titletd6'>LEAD TRAVELER: " . $cliente->firstname . " " . $cliente->lastname . " </td>
					   <td width='145' height='15' id='titletd6'>&nbsp;</td>
					   <td colspan='2' id='titletd6'>AD : " . $reserve->pax2 . "<strong>  </strong>CHD : " . $reserve->pax2 . " <strong> TOTAL</strong> : " . ($reserve->pax + $reserve->pax2) . "</td>
					 </tr>
				  <tr>
				   <td height='16' id='titletd7'>&nbsp;</td>
				   <td height='16' id='titletd7'>Status: CONFIRMED</td>
				   <td width='197' height='16' id='titletd7'>Confirmation # " . $reserve->codconf . "</td>
				   <td width='122' height='16' id='titletd7'>Paid by: " . $reserve->tipo_pago . "</td>
				 </tr>
				 <tr>
				<td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $reserve->tipo_ticket . " </p></td>
			  </tr>
	  <tr>
		<td colspan='4' ><table width='90%' height='125' id='tableorder'>
		  <tr>
			<td  width='40%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($reserve->fecha_salida)) . ", " . date('M-d-Y', strtotime($reserve->fecha_salida)) . "  </td>
			<td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $reserve->trip_no . "</td>
			<td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($reserve->deptime1)) . "</td>
		  </tr>
      <tr>
        <td height='41'><strong>From :</strong> " . $from->nombre . "</td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $p1 . $e1 . "</td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:" . $to->nombre . "</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $d1 . $e2 . "</td>
        </tr>
  </table>
	";
        if ($reserve->tipo_ticket == "roundtrip") {
            $conten .="<table id='tableorder' width='90%'>
			  <tr>
				<td id='titlett'  width='34%' height='35'  ><strong> Return Date :</strong> " . date('l', strtotime($reserve->fecha_retorno)) . ", " . date('M-d-Y', strtotime($reserve->fecha_retorno)) . "  , </td>
				<td id='titlett' width='26%'><strong>TRIP # :</strong> " . $reserve->trip_no2 . "</td>
				<td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($reserve->deptime2)) . "</td>
			  </tr>
			  <tr>
				<td height='28'><strong>From :</strong> " . $to->nombre . "</td>
				<td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $d2 . $e3 . "</td>
			  </tr>
			  <tr>
				<td height='27'><strong>To :</strong>" . $from->nombre . "</td>
				<td colspan='2'><strong>Drop Off / Extensions :</strong> " . $p2 . $e4 . "</td>
				</tr>
			</table>";
        }
        $conten .="
	  <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>";

        //Recibo
        if ($reserver_a == NULL) {
            $conten .=
                    "
                 <table id='tableorder3' width='90%'>
                   <tr>
                     <td id='titlett'   height='35' colspan='4' id='titlett3'  aling='center' ><strong>RECEIPT</strong></td>
                     </tr>
                   <tr>
                     <td width='34%' height='28'>Card Holder Information</td>
                     <td colspan='2'>Billing Address </td>
                   </tr>
                   <tr>
                     <td height='27'>Name : " . $cliente->firstname . " </td>
        <td colspan='2'>Address : " . $cliente->address . "</td>
		 <td colspan='2'>Phone : " . $cliente->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $cliente->lastname . "</td>
        <td colspan='2'>City : " . $cliente->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $cliente->username . "</td>
        <td>State : " . $cliente->state . "</td>
        <td>Country :" . $cliente->country . "</td>
      </tr>
    </table>";
        } else {
            $conten .= "
   <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : " . $login->firstname . " </td>
        <td colspan='2'>Address : " . $login->address . "</td>
		 <td colspan='2'>Phone : " . $login->phone . "</td>
      </tr>
      <tr>
        <td height='27'>Last Name : " . $login->lastname . "</td>
        <td colspan='2'>City : " . $login->city . "</td>
      </tr>
      <tr>
        <td height='27'>E-mail : " . $cliente->username . "</td>
        <td>State : " . $login->state . "</td>
        <td>Country :" . $login->country . "</td>
      </tr>
    </table>";
        }
        $conten .= "
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' >&nbsp;</td>
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
</div>";
        return $conten;
    }

    public function registrar_pago($reserve, $r_anterior, $login, $pagado, $pago, $tipo_pago) {
        //Reserve_pago
        Doo::loadModel("Reserve_Pago");
        $pagor_r = new Reserve_Pago();
        $pagor_r->id_reserva = $reserve->id;
        $pagor_r->pago = $pago;
        $pagor_r->tipo_pago = $tipo_pago;
        $pagor_r->pagado = $pagado/* ($reserve->otheramount == 0) ? $reserve->totaltotal : $reserve->otheramount */;
        $pagor_r->usuario = $login->id;
        $pagor_r->fecha = date('Y-m-d H:s');
        Doo::loadModel("Agency");
        if ($reserve->agency != -1) {
            $dat = new Agency();
            $dat->id = $reserve->agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
        } else {
            $dat = new Agency();
            $dat->id = -1;
            $dat->type_rate = 0;
        }

        if ($r_anterior == NULL) {
            Doo::db()->insert($pagor_r);
            //CREDITO
//            if($pagor_r->tipo_pago  == 'VOUCHER'){// Actualizamos el credio
//                $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0","param" => array($dat->id),"limit" => 1));
//                if(!empty($creditos)){
//                    $creditos->disponible = ($creditos->disponible - $reserve->totaltotal);
//                    Doo::db()->update($creditos);
//                }
//            }
        } else {
            $sql = "SELECT `id`, `id_reserva`, `pago`, `tipo_pago`, `pagado`, `usuario`, `fecha`
						FROM `reservas_pago` 
						WHERE  id_reserva = ? 
						ORDER BY  `id` DESC ";
            $rs = Doo::db()->query($sql, array($pagor_r->id_reserva));
            $pagos = $rs->fetchAll();

            if (!empty($pagos)) {
                //echo ' de ('.$r_anterior->tipo_pago.') a ('.$reserve->tipo_pago.')';
                $pagos = new Reserve_Pago($pagos[0]);
                if ($r_anterior->tipo_pago == $reserve->tipo_pago && $r_anterior->totaltotal == $reserve->totaltotal && $r_anterior->otheramount == $reserve->otheramount) {
                    // Solo si se cambia el pago y si se modifica el valor se insertan los pagos
                } else if ($r_anterior->tipo_pago == $reserve->tipo_pago && ($reserve->tipo_pago == 'COLLECT ON BOARD' || $reserve->tipo_pago == 'VOUCHER')) {
                    //echo '<br />De COLLECT ON BOARD a COLLECT ON BOARD o VOUCHER a VOUCHER';
                    $pagor_r->id = $pagos->id;
                    Doo::db()->update($pagor_r);
                } else if (($r_anterior->tipo_pago == 'PRED-PAID' && $reserve->tipo_pago == 'PRED-PAID') ||
                        ($r_anterior->tipo_pago == 'PRED-PAID' && $reserve->tipo_pago == 'COLLECT ON BOARD')) {
                    //echo '<br />De PRED-PAID a PRED-PAID o PRED-PAID a COLLECT ON BOARD';
                    $pagado = $this->pagado($pagor_r->id_reserva);
                    $debe = $pagor_r->pagado - $pagado;
                    if ($debe > 0) {
                        $pagor_r->pagado = $debe;
                        Doo::db()->insert($pagor_r);
                    } else {
                        $this->registrarNotaCredito($pagor_r->id_reserva, ($debe * -1));
                    }
                } else if ($r_anterior->tipo_pago == 'COLLECT ON BOARD' && $reserve->tipo_pago == 'PRED-PAID') {
                    //echo '<br /> COLLECT a PRED-PAID';
                    $pagado = $this->pagado($pagor_r->id_reserva);
                    $debe = $pagor_r->pagado - $pagado;
                    $pagor_r->pagado = $debe;
                    Doo::db()->insert($pagor_r);
                }
            }
        }
    }

    public function registrarNotaCredito($id_reserva, $valor) {
        if ($valor > 0) {
            Doo::loadModel("Reserve_Nota_Credi");
            $login = $_SESSION['login'];
            $notaC = new Reserve_Nota_Credi();
            $notaC->id_reserva = $id_reserva;
            $notaC = Doo::db()->find($notaC, array("limit", 1));
            if (empty($notaC)) {
                $notaC = new Reserve_Nota_Credi();
                $notaC->id_reserva = $id_reserva;
                $notaC->valor = $valor;
                $notaC->usuario = $login->id;
                $notaC->fecha = date('Y-m-d H:s');
                Doo::db()->insert($notaC);
            } else {
                $notaC = new Reserve_Nota_Credi($notaC[0]);
                $notaC->id_reserva = $id_reserva;
                $notaC->valor = $valor;
                $notaC->usuario = $login->id;
                $notaC->fecha = date('Y-m-d H:s');
                Doo::db()->update($notaC);
            }
        }
    }

    public function pagado($id_reserva) {
        $sql = "SELECT SUM(`pagado`) as total
				FROM `reservas_pago` 
				WHERE  id_reserva = ?  
				ORDER BY  `id` DESC ";
        $rs = Doo::db()->query($sql, array($id_reserva));
        $pagos = $rs->fetchAll();
        $pagado = isset($pagos[0]['total']) ? $pagos[0]['total'] : 0;
        return $pagado;
    }

    public function save() {

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

        return Doo::conf()->APP_URL . "admin/clientes";
    }

    public function edit() {
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['cliente'] = Doo::db()->find($cliente, array('limit' => 1));
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));

        $this->data['content'] = 'configuracion/frm_client.php';
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $_REQUEST['item'];
        Doo::db()->delete($cliente);
        return Doo::conf()->APP_URL . "admin/clientes";
    }

    /*
     * AUSU jQuery-Ajax Autosuggest v1.0
     * Demo of a simple server-side request handler
     * Note: This is a very cumbersome code and should only be used as an example
     */

    public function ajaxcliente() {

        # Assign local variables
        $id = @$_POST['id'];          // The id of the input that submitted the request.
        $data = @$_POST['data'];        // The value of the textbox.
        $id_agency = @$_POST['id_a'];
        $id_from1 = @$_POST['id_from1'];
        $id_to1 = @$_POST['id_to1'];
        $id_from2 = @$_POST['id_from2'];
        $id_to2 = @$_POST['id_to2'];
        $id_exten1 = @$_POST['id_exten1'];
        $id_exten2 = @$_POST['id_exten2'];
        $id_exten3 = @$_POST['id_exten3'];
        $id_exten4 = @$_POST['id_exten4'];
        if ($id && $data) {

            if ($id == 'leader') {
                echo "<script>
						client = document.getElementById('newClient');
						client.style.visibility = 'hidden';
					 </script>";

                /* busqueda por clientes */

                $sql = "SELECT id,username,firstname,lastname,phone
							FROM clientes 
                            WHERE phone LIKE ? or lastname LIKE ? or firstname LIKE ?    LIMIT 5 ";
                $rs = Doo::db()->query($sql, array('%' . $data . '%', '%' . $data . '%', '%' . $data . '%'));
                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $tel = '';
                    $toReturn = strtoupper($consul['phone'] . "-" . $consul['lastname'] . " " . $consul['firstname']);
                    $dataList[] = '<li  id="' . $consul['id'] . '"><a >' . htmlentities($toReturn) . '</a></li>';
                }
                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo "<ul style='width:420px;'>";
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo "<script>
								client = document.getElementById('newClient');
								client.style.visibility = 'visible';
						 </script>";
                    echo "<ul style='width:396px;'><li><a >No Results</a></li></ul>";
                }
            } else if ($id == 'agency') {

                if ($consul['id'] = '') {
                    $consul['lastname'] = '';
                    $consul['firstname'] = '';
                    $consul['phone'] == '';
                }



                /* busqueda por nombre de agencias */

                $sql = "SELECT  id,company_name
				 			FROM agencia 
							WHERE  company_name LIKE ?  LIMIT 5  ";



                /* $sql = "SELECT  a1.id,a1.company_name, a2.firstname as Nombre, a2.lastname as Apellido
                  FROM agencia a1
                  LEFT JOIN user_agencia a2 ON(a1.id=a2.id_agencia)
                  WHERE company_name LIKE ?  LIMIT 5  "; */


                $rs = Doo::db()->query($sql, array('%' . $data . '%'));
                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['company_name'];

                    ///retorno de id
                    /* $toReturn1 = $consul['id'];

                      $id_agencia =  $toReturn1;

                      echo $id_agencia; */

                    //capturamos el nombre de la agencia
                    $nombre_agencia = $consul['company_name'];

                    ///////
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }
                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:200px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:200px;"><li><a >No Results</a></li></ul>';

                    echo "<script>
					document.getElementById('tableTypeSaldo').style.display = 'none';
					
					</script>";

                    echo "<script>document.getElementById('type_rate').value= '0';
								var comi = 0;
								$('#totalComision').text(comi.toFixed(2));
						</script>";
                }

//                busqueda por id de agencia
            } else if ($id == 'agency') {

                if ($consul['id'] == '') {
                    $consul['lastname'] = '';
                    $consul['firstname'] = '';
                    $consul['phone'] = '';
                }



                /* busqueda por nombre de agencias */

                $sql = "SELECT  id
				 FROM agencia 
					WHERE  company_name = $nombre_agencia";



                /* $sql = "SELECT  a1.id,a1.company_name, a2.firstname as Nombre, a2.lastname as Apellido
                  FROM agencia a1
                  LEFT JOIN user_agencia a2 ON(a1.id=a2.id_agencia)
                  WHERE company_name LIKE ?  LIMIT 5  "; */


                $rs = Doo::db()->query($sql, array('%' . $data . '%'));
                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['id'];
                    $id_agencias = $consul['id'];
                }





                /* busqueda de empleados por agencia */
            } else if ($id == 'uagency') {

                $sql = "SELECT  id_agencia, firstname, lastname
							FROM user_agencia
					
                                                WHERE firstname LIKE ? and id_agencia = ?   ";

                $rs = Doo::db()->query($sql, array('%' . $data . '%', $id_agency));
                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['firstname'] . ' ' . $consul['lastname'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                    $resultado = $dataList;
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:200px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    $dataList[] = '<li id="-1"  ><a >No Results</a></li>';
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:200px;">';
                    echo $dataOutput;
                    echo "</ul>";
                }

                /* Nueva busqueda de empleados por agencia */

///////////actualizacion para control select

                /*       $empleados_agencia= $_POST['uagency1'];
                  $id_agency = @$_POST['id_a'];

                  //  else if ($id == 'uagency1')

                  {

                  $sql = "SELECT  firstname, lastname
                  FROM user_agencia
                  WHERE id_agencia = '11'  ";

                  $rs = Doo::db()->query($sql, array('%' . $data . '%', $id_agency));
                  $consulta = $rs->fetchAll();
                  $dataList = array();
                  foreach ($consulta as $consul) {
                  $toReturn = $consul['firstname'] . ' ' . $consul['lastname'];
                  $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                  $resultado=$dataList;
                  }


                  if (count($dataList) >= 1) {
                  $dataOutput = join("\r\n", $dataList);
                  echo '<ul style="width:200px;">';
                  echo $dataOutput;
                  echo "</ul>";
                  } else {
                  $dataList[] = '<li id="-1"  ><a >No Results</a></li>';
                  $dataOutput = join("\r\n", $dataList);
                  echo '<ul style="width:200px;">';
                  echo $dataOutput;
                  echo "</ul>";
                  }

                  //  } */


                ////////////////////////////////////////////
            } elseif ($id == 'pickup1') {

                $rs = Doo::db()->query("SELECT  id,id_area,place,address
 
														FROM pickup_dropoff
															
										  WHERE (place LIKE ? or   address LIKE ?) 
										  and id_area = ? and valid = 0 AND type_web  = 0 LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_from1));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'dropoff1') {

                $rs = Doo::db()->query("SELECT  id,id_area,place,address
 
														FROM pickup_dropoff
															
										  WHERE (place LIKE ? or  address LIKE ?) and id_area = ? 
										  and valid = 0  AND type_web  = 0  LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_to1));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'exten1') {

                $rs = Doo::db()->query("SELECT id,id_extension,place,address FROM pickupdropoff_exten
															
										  WHERE (place LIKE ? or  address LIKE ?) and id_extension = ? LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_exten1));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'exten2') {

                $rs = Doo::db()->query("SELECT id,id_extension,place,address FROM pickupdropoff_exten
															
										  WHERE (place LIKE ? or  address LIKE ?) and id_extension = ? LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_exten2));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'pickup2') {

                $rs = Doo::db()->query("SELECT  id,id_area,place,address
 
														FROM pickup_dropoff
															
										  WHERE (place LIKE ? or   address LIKE ?) and id_area = ? 
										  and valid = 0  AND type_web  = 0  LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_from2));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'dropoff2') {

                $rs = Doo::db()->query("SELECT  id,id_area,place,address
 
														FROM pickup_dropoff
															
										  WHERE (place LIKE ? or  address LIKE ?) and id_area = ? and valid = 0
										  AND type_web  = 0  LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_to2));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'exten3') {

                $rs = Doo::db()->query("SELECT id,id_extension,place,address FROM pickupdropoff_exten
															
										  WHERE (place LIKE ? or  address LIKE ?) and id_extension = ? LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_exten3));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            } elseif ($id == 'exten4') {

                $rs = Doo::db()->query("SELECT id,id_extension,place,address FROM pickupdropoff_exten
															
										  WHERE (place LIKE ? or  address LIKE ?) and id_extension = ? LIMIT 5  ", array('%' . $data . '%', '%' . $data . '%', $id_exten4));

                $consulta = $rs->fetchAll();
                $dataList = array();
                foreach ($consulta as $consul) {
                    $toReturn = $consul['place'] . " " . $consul['address'];
                    $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                }


                if (count($dataList) >= 1) {
                    $dataOutput = join("\r\n", $dataList);
                    echo '<ul style="width:300px;">';
                    echo $dataOutput;
                    echo "</ul>";
                } else {
                    echo '<ul style="width:300px;"><li><a >No Results</a></li></ul>';
                }
            }
        } else {
            echo 'Request Error';
        }
    }

    public function clienteAptoPagoWeb($cliente) {
        if (empty($cliente)) {
            return 0;
        }
        if (trim($cliente['username']) == '' || trim($cliente['firstname']) == '' || trim($cliente['lastname']) == '' || trim($cliente['phone']) == '' || trim($cliente['zip']) == '' || trim($cliente['address']) == '') {
            return 0;
        }
        if (trim($cliente['state']) == '' && trim($cliente['country']) == '') {
            return 0;
        }
        return 1;
    }

    public function ajaxcliente2() {

        $id = $this->params["id"];
        $pertenece = $this->params["id2"];

        if ($pertenece == 'leader') {
            $sql = "SELECT id, username, firstname, lastname, password, phone, celphone, city, state, country, address, zip, tipo_client, birthday, fecha_r, points, left_points, paid_points FROM  clientes WHERE id = ? ";
            $rs = Doo::db()->query($sql, array($id));
            $datos = $rs->fetch();
            $apto = $this->clienteAptoPagoWeb($datos);
            //$apto = 1;

            echo "<script>
				
				  client = document.getElementById('newClient');
				  client.style.visibility = 'hidden';
				  
				  $('#idCliente').val('" . $datos['id'] . "')
				  $('#firstname1').val('" . $datos['firstname'] . "');
				  $('#lastname1').val('" . $datos['lastname'] . "');
				  $('#phone1').val('" . $datos['phone'] . "');
				  $('#email1').val('" . $datos['username'] . "');
				  $('#type_cliente').val('" . $datos['tipo_client'] . "');
				  $('#cliente_apto').val('" . $apto . "');
				  $('#idPagador').val('" . $datos['id'] . "');
				  
				
					 </script>";
        }
        if ($pertenece == 'agency') {
            if (trim($id) == '' || trim($id) == 0) {
                $id = -1;
            }
            if ($id != -1) {
                $rs = Doo::db()->query("SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days
												   FROM agency_account WHERE id_agencia = ? ", array($id));


                Doo::loadController("AgenciaController");
                $agenControl = new AgenciaController();
                $disponible = $agenControl->credito($id);

                $datos = $rs->fetch();

                $sql2 = "SELECT type_rate FROM  agencia WHERE id = ?";
                $rs = Doo::db()->query($sql2, array($id));
                $type = $rs->fetch();
                $type_rate = $type['type_rate'];
                if ($type_rate == 1) {
                    echo "<script>
								$('#tr_agencycomision').css('display','none');
								</script>";
                    echo "<script>
						document.getElementById('tableTypeSaldo').style.display = 'none';
						</script>";
                } else {
                    echo "<script>$('#tr_agencycomision').css('display','block');</script>";
                    echo "<script>document.getElementById('tableTypeSaldo').style.display = 'block';</script>";
                    echo "<script>document.getElementById('type_rate').value= '" . $type_rate . "';var comi = comision();$('#totalComision').text(comi.toFixed(2));</script>";
                }




                echo "<script>$('#uagency').removeAttr('disabled');</script>";


//                if ($datos['opcion1'] != 0) {
//                    echo "<script>
//							$('#opcion_pago_passager').html('Passanger Credit Card');
//							document.getElementById('tipo_passager').style.display = 'block';
//							</script>";
//
//                    echo "<script>
//							
//							document.getElementById('tipo_agency').style.display = 'block';
//							</script>";
//                } else {
//
//                    echo "<script>
//							$('#opcion_pago_passager').html('Credi Car');
//							document.getElementById('tipo_passager').style.display = 'none';</script>";
//                    echo "<script>document.getElementById('tipo_agency').style.display = 'none';</script>";
//                }
//
//                if ($datos['opcion3'] != 0) {
//                    echo "<script>
//							document.getElementById('tipo_CrediFee').style.display = 'block';
//							document.getElementById('tipo_passager_2').style.display = 'block';
//							
//							</script>";
//                } else {
//                    echo "<script>
//							document.getElementById('tipo_CrediFee').style.display = 'none';
//							</script>";
//                }
//
//                if ($datos['opcion4'] != 0) {
//                    echo "<script>
//								document.getElementById('tipo_Cash').style.display = 'block';
//                                                                document.getElementById('tipo_Cash_2').style.display = 'block';
//							</script>";
//                } else {
//                    echo "<script>
//							document.getElementById('tipo_Cash').style.display = 'none';
//							</script>";
//                }



                if ($datos['opcion5'] != 0) {
                    echo "<script>
								document.getElementById('tipo_Voucher').style.display = 'block';
							</script>";

                    Doo::loadController("AgenciaController");
                    $agenControl = new AgenciaController();
                    $disponible = $agenControl->credito($id);
                    echo "<script>$('#uagency').removeAttr('disabled');
								document.getElementById('disponible').value = '" . $disponible . "';
							</script>";
                } else {
                    echo "<script>document.getElementById('tipo_Voucher').style.display = 'none';</script>";
                    echo "<script>$('#uagency').removeAttr('disabled');
								document.getElementById('disponible').value = '0';
							</script>";
                }
//                echo '<script>
//							$("#tr_otheramount").css("display","block");
//						</script>';
//
//
//                echo "<script>
//								$('#tipo_predpaid_cash').css('display','none');
//								$('#label_tipo_predpaid_cash').html('Cash at agency');
//								
//						</script>";
//                echo "<script>
//								$('#tr_complementary').css('display','none');
//								$('#label_tipo_predpaid_cash').html('Cash at agency');
//								
//						</script>";
            } else {
                echo "<script>
								$('#id_agency').val('-1');
							</script>";

//                echo "<script>
//								$('#tr_complementary').css('display','block');
//								$('#label_tipo_predpaid_cash').html('Cash at agency');
//								
//						</script>";
//                echo "<script>
//							$('#opcion_pago_passager').html('Credi Car');
//							document.getElementById('tipo_passager').style.display = 'block';</script>";
//                echo "<script>document.getElementById('tipo_agency').style.display = 'none';</script>";
//
//                echo "<script>
//								document.getElementById('tipo_Cash').style.display = 'block';
//							</script>";
//                echo "<script>
//							document.getElementById('tipo_CrediFee').style.display = 'block';
//							</script>";
//                echo "<script>
//								document.getElementById('tipo_Voucher').style.display = 'none';
//						</script>";
//                echo "<script>
//						document.getElementById('tableTypeSaldo').style.display = 'none';
//						</script>";
//
//                echo "<script>document.getElementById('type_rate').value= '0';
//									var comi = 0;
//									$('#totalComision').text(comi.toFixed(2));
//							</script>";
//                echo "<script>
//								$('#tr_otheramount').css('display','none');
//								$('#tr_agencycomision').css('display','none');
//								
//						</script>";
//
//                echo "<script>
//								$('#tipo_predpaid_cash').css('display','block');
//								$('#label_tipo_predpaid_cash').html('Cash in terminal');
//								
//						</script>";
            }
        }
    }

    public function trips() {
        if (isset($this->params["from"]) && isset($this->params["to"]) && isset($this->params["fecha"])) {
            $from = $this->params["from"];
            $to = $this->params["to"];
            $fecha_salida = $this->params["fecha"];
            $anno = substr($fecha_salida, -4);
            $resident = $this->params["resid"];
            $tipo = $this->params["tipo"];
            $id_agency = $this->params["agency"];
            list($mes, $dia, $anio) = explode('-', $fecha_salida);
            $fecha = $anio . '-' . $mes . '-' . $dia;

            Doo::loadModel("Agency");

            if ($id_agency != -1) {
                $dat = new Agency();
                $dat->id = $id_agency;
                $result = Doo::db()->find($dat, array("limit", 1));
                if (!empty($result)) {
                    $dat = $result[0];
                } else {
                    $dat = new Agency();
                    $dat->id = -1;
                    $dat->type_rate = 0;
                }
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }

            $fromto = $this->params["fromto"];

            $hora = date("H:i");



            $sql = "select
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
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.type_rate = " . $dat->type_rate . " and t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? ORDER BY t2.trip_departure ASC";

            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida, $anno));
            $salida = $rs->fetchAll(); // Salidas

            if ($dat->type_rate == 2) { // Salidas Especial Net
                $sqlNet = "select
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
							 where t2.type_rate = 2 and t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? ORDER BY t2.trip_departure ASC";

                $rs = Doo::db()->query($sqlNet, array($from, $to, $fecha_salida, $anno));

                $sEspNet = $rs->fetchAll();
            } else {
                $sEspNet = array();
            }
            if (!empty($sEspNet)) {// Si encontro especiales los remplazamos
                foreach ($salida as $key2 => $normal) {
                    foreach ($sEspNet as $key => $especial) {
                        if ($especial["trip_no"] == $normal["trip_no"]) {
                            $salida[$key2] = $especial;
                        }
                    }
                }
            }

            if ($dat->id == -1) {


                $sql2 = "select * from ofertas where fecha_ini<= ? and fecha_fin >=? and trip_from = ? and trip_to = ?";
                $query = Doo::db()->query($sql2, array(strtotime($fecha), strtotime($fecha), $from, $to));
                $rs = $query->fetchAll();
                $oferta = false;
                $precios = array();
                foreach ($salida as $key => $normal) {
                    foreach ($rs as $k => $oferta) {
                        if ($normal['trip_no'] == $oferta['trip_no']) {
                            $normal['price'] = $oferta['price'];
                            $normal['price2'] = $oferta['price2'];
                            $normal['price3'] = $oferta['price3'];
                            $normal['price4'] = $oferta['price4'];
                            $salida[$key] = $normal;
                            $oferta = true;
                        } else if ($oferta['trip_no'] == "") {
                            $normal['price'] = $oferta['price'];
                            $normal['price2'] = $oferta['price2'];
                            $normal['price3'] = $oferta['price3'];
                            $normal['price4'] = $oferta['price4'];
                            $salida[$key] = $normal;
                            $oferta = true;
                        }
                    }
                }
            }

            $sql = "SELECT  nombre FROM areas WHERE id = ?";
            $rs = Doo::db()->query($sql, array($from));
            $from = $rs->fetch();
            $sql = "SELECT  nombre FROM areas WHERE id = ?";
            $rs = Doo::db()->query($sql, array($to));
            $to = $rs->fetch();

            echo "<style type='text/css'>
.selector {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:11px;
	font-weight:bold;
	padding:6px 20px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff;
}.selector:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
	background-color:#dfdfdf;
	cursor:pointer;
}.selector:active {
	position:relative;
	top:1px;
}





/* This imageless css button was generated by CSSButtonGenerator.com */
</style>";



            /* echo '<form name="formu" id="formu" action="'.Doo::conf()->APP_URL.'admin/reservas/add" method="post"><input name="resident" type="hidden" value="'.$resident.'" /><input name="fromto" type="hidden" value="'.$fromto.'" />'; */
            echo '<form name="formu" id="formu"  method="post"><input name="resident" type="hidden" value="' . $resident . '" /><input name="fromto" type="hidden" value="' . $fromto . '" />';
            echo '<b style="padding-bottom:10px;"> <font color="#666666" face="Verdana, Arial, Helvetica, sans-serif" >' . $from['nombre'] . ' To ' . $to['nombre'] . '</font></b>';

            echo '   <table class="table table-bordered table-striped" id="tbl1">
             <thead>
                 <tr>
                     <th width="8%">Select</th>
                     <th width="8%">Trip</th>
                     <th width="12%">Departure</th>
                     <th width="11%">Arrive</th>
                     <th width="20%">' . ($resident == '1' ? 'FLA. Resident Adult' : 'Regular Price Adult') . '</th>
                     <th width="20%">' . ($resident == '1' ? 'FLA. Resident Child (3-9 Yrs)' : 'Regular Price Child') . '</th>
                     <th width="20%">Equipment</th> 
					 <th width="20%">Seats</th>             					  
                 </tr>
             </thead>';


            if (count($salida) > 0) {
                $i = 0;
                Doo::loadController("MainController");
                $main = new MainController();
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha = $anio . '-' . $mes . '-' . $dia;
                foreach ($salida as $e) {
                    $disponible = $this->disponible($e['trip_no'], $fecha);
                    $enUso = $this->puestosEnUsados($e['trip_no'], $fecha);
                    //Validamos disponible para cuando se esta editando
                    if (isset($_SESSION['reserva_edit'])) {
                        Doo::loadModel("Reserve");
                        $r = new Reserve($_SESSION['reserva_edit']);
                        if ($tipo == 1 && $r->trip_no == $e['trip_no']) {
                            $disponible += ($r->pax + $r->pax2);
                        }
                        if ($tipo == 2 && $r->trip_no2 == $e['trip_no']) {
                            $disponible += ($r->pax + $r->pax2);
                        }
                    }
                    if ($enUso != 0) {
                        $disponible = $disponible - $enUso;
                        $tituloDisponible = 'There are ' . $enUso . ' other seats that are being used by another operator';
                    } else {
                        $tituloDisponible = '';
                    }
//                    if (!($fecha == date('Y-m-d') && date("H:i", strtotime($e['trip_departure'])) < date('H:i'))) {
                    echo '<tr class="row' . $i . '">
						<td><input type="radio" name="trip1" id="trip1"  value="' . $e['id'] . '" />
						<input name="fecha" type="hidden" value="' . $fecha_salida . '" />
						<input type="hidden" name="trip"  id="trip" value="' . $e['trip_no'] . '" />
						<input type="hidden" name="capacidad_trip_' . $e['trip_no'] . '"  id="capacidad_trip_' . $e['trip_no'] . '" value="' . $disponible . '" />
						</td>
						<td>' . $e['trip_no'] . '</td>
						<td>' . date("g:i a", strtotime($e['trip_departure'])) . '</td>
						<td>' . date("g:i a", strtotime($e['trip_arrival'])) . '</td>
						<td>' . ($resident == '1' ? $e['price4'] : $e['price'] ) . '</td>
						<td>' . ($resident == '1' ? $e['price3'] : $e['price2'] ) . '</td>
						<td>' . $e['equipment'];
                    if ($oferta) {
                        echo '<span id="offer"><img src="http://localhost/supertours/global/img/offer.png"></span>';
                    }
                    echo '</td>
						<td title="' . $tituloDisponible . '" >' . $disponible . '</td>
					</tr>';
                    $i = 1 - $i;
//                    }
                }
            } else {

                echo '<tr>
                  <td colspan="7">No tours available</td> 
              </tr>  ';
            }
            echo ' </table>';

            $inpu = 'input[name="trip1"]';

            echo '  <p align="right">
         <button  class="selector" id="btn-continue" >Select</button> <button  class="selector" id="btn-cancelar" >cancel</button>
       </p>
	   
	  	   
		<div id="con">
		<script>
		
		
		
		$(document).ready(function() {
				
			$("#btn-continue").click(function(){
				var index = false;		
			 for(i=0;i<$("#tbl1 tr").toArray().length;i++) {
				if($("#tbl1 tr").eq(i).find("td").eq(0).find("input").attr("checked")){
					valor = $("#tbl1 tr").eq(i).find("td").eq(1).html();
					departure = $("#tbl1 tr").eq(i).find("td").eq(2).html();
					arrival = $("#tbl1 tr").eq(i).find("td").eq(3).html();
					adult = $("#tbl1 tr").eq(i).find("td").eq(4).html();
					child = $("#tbl1 tr").eq(i).find("td").eq(5).html();
					index=true;
					}
				}			
			
			
			if(index){
				    var capacidad = $("#capacidad_trip_"+valor).val();
					var totalpax = parseFloat( parseFloat($("#pax").val()) +  parseFloat($("#pax2").val()) );
					if(capacidad-totalpax<0){
						alert("There is no capacity available for passengers in total admitted");
						return false;
					}
					var id = $("#trip").val();
					var tipo = "' . $tipo . '";
					$("#CargaTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/add/trip/" + valor + "/"+tipo/' . $id_agency . ');
					$("#puestosEnUso").load("' . Doo::conf()->APP_URL . 'admin/reservas/ocuparPuesto/"+valor+"/"+tipo+"/"+"' . $fecha . '"+"/"+totalpax+"/1");
                                        $("#mensajeTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/consultatrip");
					
					paxA = $("#pax").val();
					paxC = $("#pax2").val();
					var id_agencia = ' . $id_agency . ';
					
					if("' . $tipo . '" == 1){
						adulto1 = adult;
						ninio1 = child;	
						if($("#trip_no_c").val() != valor || id_agencia != -1){
                                                  $("#trip_no").val(valor);
						  $("#departure1").val(departure);
						  $("#arrival1").val(arrival);											
						  $("#subtochild1").val(child);
						  $("#subtoadult1").val(adult);
						  CalcularTotalTotal();
                                                }else{
                                                  $("#trip_no").val(valor);
						  $("#departure1").val(departure);
						  $("#arrival1").val(arrival);
                                                  child = $("#subtochild1_o").val();
                                                  adult = $("#subtoadult1_o").val();
						  $("#subtochild1").val(child);
						  $("#subtoadult1").val(adult);
						  CalcularTotalTotal();  
                                                }						
						
						/*$("#trip_no2").val("");
						$("#departure2").val("");
						$("#arrival2").val("");	*/	
					}else{
						if($("#trip_no2").val() != ""){								
							total = 0;
							sta = 0;
							stc = 0;
							ad = 0;
							ch = 0;
                                                       
						}else{	
                                                        
                                                         $("#trip_no2").val(valor);                                                        
                                                         $("#departure2").val(departure);
                                                         $("#arrival2").val(arrival);
                                                        
																						
						}
                                                 if($("#trip_no2_c").val() != valor || id_agencia != -1){
                                                    $("#trip_no2").val(valor);                                                        
                                                    $("#departure2").val(departure);
                                                    $("#arrival2").val(arrival);
                                                    $("#subtochild2").val(child);
                                                    $("#subtoadult2").val(adult);
                                                    CalcularTotalTotal();
                                                 }else{
                                                     $("#trip_no2").val(valor);                                                        
                                                     $("#departure2").val(departure);
                                                     $("#arrival2").val(arrival);
                                                    child = $("#subtochild2_o").val();
                                                    adult = $("#subtoadult2_o").val();
                                                    $("#subtochild2").val(child);
                                                    $("#subtoadult2").val(adult);
                                                    CalcularTotalTotal();
                                                 }
						
					}				
					 
					 $("#mascaraP").hide("fade");					 
					 $("#popup").hide("fade");
					 
					 return false;
			}else{
					alert("select Trip"); 
                    return false;
			}
				   
				
			});
		
		$("#btn-cancelar").click(function(){
							
				$("#popup").fadeOut("slow");
				$("#popup").hide("fade");
					 
				$("#mascaraP").fadeOut("slow");
				$("#mascaraP").hide("fade");									 
					 
				 return false;
		});
		
		});
		
		
		function calcularPrecios(ad,ch){

								
						//hace la suma de los precios( Line Transportation ) escogidos desde la ventana de trips					
						var transAdult = $("#transporadult").text(); //obtiene el valor del texto del spam (transporadult) y lo convierte en float						
						var transChild = $("#transporechil").text(); //obtiene el valor del texto del spam (transporechil) y lo convierte en float						
												
						//alert(" TransAdult convertido a float: " + parseFloat(transAdult.substring(1,transAdult.length)));
						
						ad = (parseFloat(ad) + (parseFloat(transAdult.substring(1,transAdult.length)))); //convierte la variable adult en float y la suma con transAdult
						ch = (parseFloat(ch) + (parseFloat(transChild.substring(1,transChild.length)))); //convierte la variable child en float y la suma con transAdult
										
					
						$("#transporadult").text("$"+ad.toFixed(2)); //la funcion toFixed muestra los dos decimales despues del entero
						$("#transporechil").text("$"+ch.toFixed(2));
							
											
						 sta = $("#extenadult").text();
						 stc = $("#extenchil").text();						
												
						if($("#extenadult").text() == ""){ sta = ad;} 
						if($("#extenchil").text() == ""){stc = ch;}
												
						
						
						if($("#extenadult").text() != "" || $("#extenchil").text() != ""){
							
							sta = parseFloat(sta.substring(1,sta.length)) + parseFloat(ad);
							stc = parseFloat(stc.substring(1,sta.length)) + parseFloat(ch);
							
						 }						 
						 
						total = sta + stc;		 
						
						 
						$("#subtoadult").html("$"+sta.toFixed(2));
						$("#subtochild").html("$"+stc.toFixed(2));
						 
					
						var subtotalAdult = sta * parseFloat(paxA);	
						var subtotalChild = stc * parseFloat(paxC);
						var totalpagar = subtotalAdult + subtotalChild;
						$("#totaltotal").html("$"+ totalpagar.toFixed(2));	
						$("#totalPagar").text(totalpagar.toFixed(2));
						$("#totalPagar2").text(totalpagar.toFixed(2));
		
		}
		
		</script></div>
		
		</form>';
        }
    }

    public function superclub() {

        $id = $this->params["id"];

        $sql = "SELECT id,points,left_points,paid_points FROM clientes WHERE id = ? AND tipo_client = 1";

        $rs = Doo::db()->query($sql, array($id));
        $datos = $rs->fetch();
        if (!empty($datos)) {
            echo "<script>$('#number_supu').html('" . $datos['id'] . "'); $('#points').html('" . $datos['left_points'] . "'); </script>";
        } else {
            echo "<script>$('#number_supu').html('N/A'); $('#points').html('N/A'); </script>";
        }
    }

    public function extenprice() {

        $id = $this->params["id"];
        $id2 = $this->params["id2"];
        $transAdult = $this->params["transAdult"];
        $transChild = $this->params["transChild"];
        $type_rate = $this->params["type_rate"];
        $id_agencia = $this->params["id_agencia"];

        if ($id_agencia != -1) {

            Doo::loadModel("Agency");
            $agencia = new Agency();
            $agencia->id = $id_agencia;
            $rs_agencia = Doo::db()->getOne($agencia);
            if (!empty($rs_agencia)) {
                if ($rs_agencia->precio_especial_exten == 1) {
                    $sql = "SELECT precio_especial as precio FROM extension WHERE id = ?";
                } else {
                    $sql = "SELECT	precio_neto as precio FROM extension WHERE id = ?";
                }
            }
        } else {
            $sql = "SELECT precio FROM extension WHERE id = ?";
        }

        $rs = Doo::db()->query($sql, array($id));
        $datos = $rs->fetch();
        $precio = $datos['precio'];
        if (empty($datos)) {
            $precio = 0;
        }
        if ($id == 0) {
            $precio = 0;
        }
        echo "<script>
		$('#price_exten0" . $id2 . "').val('" . $precio . "');
		CalcularTotalTotal();
	     </script>";
    }

    public function SelectTrip() {
        $id = $this->params ['id'];
        $tipo = $this->params ['tipo'];
        $id_agency = $this->params['id_agency'];
        Doo::loadModel("Agency");
        $agencia = new Agency();
        $agencia->id = $id_agency;
        $rs = Doo::db()->getOne($agencia);
        if (!empty($rs)) {
            if ($rs->type_rate != 1) {
                Doo::loadController('MainController');
                $main = new MainController();
                $comision = $main->cal_equipament($id);
                if ($tipo == 1) {
                    if ($id == 0) {
                        echo "<script> $('#valorcomision01').val('0');</script>";
                    } else {
                        echo "<script> $('#valorcomision01').val('" . $comision . "');</script>";
                    }
                } else if ($tipo == 2) {
                    if ($id == 0) {
                        echo "<script> $('#valorcomision02').val('0');</script>";
                    } else {
                        echo "<script> $('#valorcomision02').val('" . $comision . "');</script>";
                    }
                }
            }
        }
    }

    public function detalles_rastro() {


        Doo::loadModel("Reserve_Rastro");
        $id = $this->params["id"];
        $rastro = new Reserve_Rastro();
        $rastro->id = $id;
        $rastro = Doo::db()->find($rastro, array('limit' => 1));

        $array = $this->crearArray($rastro->detalles);

        echo '<div><p>THE <strong>' . $rastro->tipo_cambio . '</strong> performed by an <strong>' . $rastro->tipo_usuario . '</strong>.</p>
		<strong>The result was as follows:<strong><br />';

        if ($rastro->tipo_cambio == 'CREATE') {
            echo '
				  <br />Creation date: ' . date('M-d-Y', strtotime($array['fecha_ini'])) .
            ( isset($array['hora']) ? ('  ' . date('h:i A', strtotime($array['hora'])) ) : '') . '
			      <br />Type : ' . $array['tipo_ticket'] .
            ( ($array['id_tours'] == '' || $array['id_tours'] == -1 || $array['id_tours'] == 0) ? '' : ('  ' . $array['type_tour'] ) ) . '
				  <br />Trip 01 : ' . $array['trip_no'];

            if ($array['tipo_ticket'] == 'roundtrip') {
                echo '<br />Trip 02 : ' . $array['trip_no2'];
            }
            echo '<br />Paid: $' . $array['paid'] . '';
            echo '<br />Total Price: $' . $array['totaltotal'] . '';
        } else {
            foreach ($array as $key => $val) {
                echo '<br />' . $key . ' = ' . $val;
            }
        }
        echo '</div>';
    }

    public function rastro_reserva($tipo_cambio, $r_anterior, $r_nueva, $login) {
        Doo::loadModel("Reserve_Rastro");
        $rastro = new Reserve_Rastro();
        $array_nueva = (array) $r_nueva;
        $id_reserva = $array_nueva['id'];
        unset($array_nueva['_table']);
        unset($array_nueva['_primarykey']);
        unset($array_nueva['_fields']);
        if ($r_anterior == NULL) {
            $cambios = $array_nueva;
        } else {
            $array_anterior = (array) $r_anterior;
            unset($array_anterior['_table']);
            unset($array_anterior['_primarykey']);
            unset($array_anterior['_fields']);
            $cambios = $this->buscarCambios($array_anterior, $array_nueva);
        }

        if ($r_nueva->paid > 0 || $tipo_cambio == 'CREATE') {
            $rastro->id_reserva = $id_reserva;
            $rastro->tipo_cambio = $tipo_cambio;
            $rastro->detalles = $this->cadena_array($cambios);
            $rastro->fecha = date('Y-m-d H:i:s');
            $rastro->usuario = $login->id;
            $rastro->tipo_usuario = $login->tipo;
            Doo::db()->insert($rastro);
        } else if (!empty($cambios)) {
            $rastro->id_reserva = $id_reserva;
            $rastro->tipo_cambio = $tipo_cambio;
            $rastro->detalles = $this->cadena_array($cambios);
            $rastro->fecha = date('Y-m-d H:i:s');
            $rastro->usuario = $login->id;
            $rastro->tipo_usuario = $login->tipo;
            Doo::db()->insert($rastro);
        }
    }

    public function cadena_array($array) {
        $cadena = "";
        foreach ($array as $key => $val) {
            $cadena .= '[' . $key . ']=>' . $val . '&->&';
        }
        return $cadena;
    }

    public function buscarCambios($array1, $array2) {
        $cambios = array();
        foreach ($array2 as $key => $v) {
            if (isset($array1[$key]) && trim($array1[$key]) != trim($array2[$key])) {
                $cambios[$key] = $v;
            }
        }
        return $cambios;
    }

    public function crearArray($string) {
        $array = explode('&->&', $string);
        $datos = array();
        for ($i = 0; $i < count($array); $i++) {
            $cadena = $array[$i];
            $separador = ']=>';
            $tam = strlen($cadena);
            $index = -1;
            if (strpos($cadena, $separador) !== false) {
                for ($j = 0; $j < $tam; $j++) {
                    $aux = substr($cadena, $j, 3);
                    if ($aux == $separador) {
                        $index = $j;
                    } else {
                        
                    }
                }
            }
            if ($index != -1) {
                $key = substr($cadena, 1, $index - 1);
                $valor = substr($cadena, $index + 3, $tam);
                $datos[$key] = $valor;
            }
        }
        return $datos;
    }

    public function precioTrip($trip, $from, $to, $fecha, $agencia) {
        $anno = substr($fecha, -4);
        $sql = "select
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
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         WHERE  t1.trip_no = ? AND t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? AND t2.type_rate = ? 
						 ORDER BY t2.trip_departure ASC";

        $rs = Doo::db()->query($sql, array($trip, $from, $to, $fecha, $anno, $agencia->type_rate));
        $salida = $rs->fetchAll(); // Salidas

        if ($agencia->type_rate == 1) { // Salidas Especial Net
            $sqlNet = "select
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
							 WHERE t1.trip_no = ? AND t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? AND t2.type_rate = 2 AND t2.id_agency = ?
							 ORDER BY t2.trip_departure ASC";

            $rs = Doo::db()->query($sqlNet, array($trip, $from, $to, $fecha, $anno, $agencia->id));
            $sEspNet = $rs->fetchAll();
        } else {
            $sEspNet = array();
        }
        if (!empty($sEspNet)) {// Si encontro especiales los remplazamos
            foreach ($salida as $key => $normal) {
                foreach ($sEspNet as $key => $especial) {
                    if ($especial["trip_no"] == $normal["trip_no"]) {
                        $salida[$key] = $especial;
                    }
                }
            }
        }
        return (!empty($salida)) ? $salida[0] : array();
    }

    public function comision_trip($trip) {
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

    public function tripsEstados() {
        Doo::loadModel("Trips");
        $trips = new Trips();
        $trips = Doo::db()->find($trips);
        //print_r($trips);
        echo '
				<div id="datagrid">
				<table class="grid2" cellspacing="1" id="grid2">
				 <thead>
				   <tr>
					<td></td>
					';
        foreach ($trips as $t) {

            echo '<td>' . $t->trip_no . '</td>';
        }
        echo '  </tr>
				 </thead>
				 <tbody> ';
        $fecha = new DateTime();
        for ($i = 0; $i < 5; $i++) {
            echo '<tr>
					<td>' . $fecha->format("M-d") . '</td>';
            foreach ($trips as $t) {
                $diponible = $this->disponible($t->trip_no, $fecha->format("Y-m-d"));

                $capacidad = $this->capacidad_trip($t->trip_no);
                $color = '#77CAF7';
//                $porcentaje = ($diponible / $capacidad) * 100;
//                if ($porcentaje > 70) {
//                    $color = '#77CAF7';
//                } else if ($porcentaje > 35) {
//                    $color = '#F9DE75';
//                } else if ($porcentaje > 0) {
//                    $color = '#FF8B35';
//                } else {
//                    $color = '#CE0000';
//                }
                echo '<td class="td_hover" style="font-size:14px;" bgcolor="' . $color . '" title="' . number_format($porcentaje, 0, '.', '.') . '% is available" align="center">' . $diponible . '</td>';
            }
            echo '</tr>';
            date_add($fecha, date_interval_create_from_date_string('1 days'));
        }
        echo '</tbody></table></div>';
    }

    public function capacidad_trip($trip_no) {
        $sqlC = "SELECT sum(b.capacidad) as capacidad
					FROM  trips t  
							LEFT JOIN  bus_trips tb  on (t.id = tb.id_trips )
							LEFT JOIN  bus b  on (tb.id_bus=b.id) 
					WHERE t.trip_no= ?";
        $rs = Doo::db()->query($sqlC, array($trip_no));
        $trip_bus = $rs->fetchAll();
        $capacidad = $trip_bus[0]['capacidad'];

        $capacidad = ($capacidad != 0) ? $capacidad : 0;
        return $capacidad;
    }

    public function disponible($trip_no, $fecha) {
        //tipo = 1 -> De Ida
        //tipo = 2 -> De Retorno
        $capacidad = $this->capacidad_trip($trip_no);
        if ($capacidad == 0) {// No esta disponible
            return -1;
        }
        //De Ida
        $sqlIda = "SELECT (sum(pax) + sum(pax2))as ocupadas
				FROM  reservas 
				Where trip_no = ? AND fecha_salida	 = ? AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs = Doo::db()->query($sqlIda, array($trip_no, $fecha));
        $r_idas = $rs->fetchAll();
        $ocupadas_idas = $r_idas[0]['ocupadas'] ? $r_idas[0]['ocupadas'] : 0;
        //De Retorno
        $sqlRetunr = "SELECT (sum(pax) + sum(pax2))as ocupadas
				FROM  reservas 
				Where trip_no2 = ? AND fecha_retorno = ? AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs = Doo::db()->query($sqlRetunr, array($trip_no, $fecha));
        $r_return = $rs->fetchAll();
        $ocupadas_return = $r_return[0]['ocupadas'] ? $r_return[0]['ocupadas'] : 0;

        $ocupadas = $ocupadas_idas + $ocupadas_return;
        return $capacidad - $ocupadas;
    }

    public function puestosEnUsados($trip, $fecha) {
        Doo::loadModel('Reservas_trip_puestos');
        $puestos = new Reservas_trip_puestos();
        $login = $_SESSION['login'];
        $sql = "SELECT id, trip_to, tipo,fecha_trip, cantidad, fecha_usado, usuario, estado FROM reservas_trip_puestos WHERE usuario != ? AND trip_to = ? AND fecha_trip = ? AND (estado='USING' OR estado='RENEWED') order by (id) DESC";
        $rs = Doo::db()->query($sql, array($login->id, $trip, $fecha));
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
              4: CANCELLED: Puesto que se estaba usando pero no se siguo con la reseva.
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
                                       
					var hilo02=setInterval("estadoTrip()",10000);
				</script>';
                Doo::db()->update($puestos);
            } else {
                $puestos->estado = 'USING';
                $puestos->fecha_usado = date('Y-m-d H:i:s');
                echo '<script>
                                        
					var hilo02=setInterval("estadoTrip()",10000);
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
            $sql = ' UPDATE reservas_trip_puestos SET fecha_usado= ? , estado= ?
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

    public function consultatrip() {
        $login = $_SESSION['login'];
        $sql = "SELECT `id`, `trip_to`, `tipo`,`fecha_trip`, `cantidad`, `fecha_usado`, `usuario`, `estado` FROM `reservas_trip_puestos` WHERE usuario = ? AND (estado='USING' OR estado='RENEWED') order by (id) DESC";
        $rs = Doo::db()->query($sql, array($login->id));
        $aux = $rs->fetchAll();
        if (!empty($aux)) {
            $fe = $aux[0]['fecha_usado'];
            $ahora = date('Y-m-d H:i:s');
            $segundos = strtotime($ahora) - strtotime($fe);
            $limite = $this->limiteTiempo();
            if ($segundos <= $limite) {
                $temp0 = $this->temporizador($limite, $segundos);
            } else {
                $temp0 = '00:00';
            }
            echo '<script>$("#mensajeTrip").html("' . $temp0 . '");</script>';

            $mensaje = 'More than $limite minutes has the following entries in use:<br />';
            foreach ($aux as $p) {
                if (date("Y-m-d", strtotime($p['fecha_usado'])) == date("Y-m-d")) {
                    $mensaje .= '       ' . $p['cantidad'] . ' aciento of ' . $p['trip_to'] . ' for the day trip ' . date('M-d-Y', strtotime($p['fecha_trip'])) . '<br />';
                }
            }
            $mensaje .='<br /><br />Do you want to continue with the booking?';
            $tiempoEspera = 30;

            if ($segundos > $limite) {
                echo '<script>
						if(!$("#dialog-trip-pregunta").is(":visible")){ 							
							$("#mensaje_trips_pregunta").html("' . $mensaje . '");
							preguntaTrip();
						}
				</script>';
                echo $temp2 = $this->temporizador($tiempoEspera, $segundos - $limite);
                echo '<script>
					$("#reloj_temporizador").html("' . $temp2 . '");
				</script>';
            }

            //Tiempo de espera para ocultar dialog-trip-pregunta
            if ($segundos > $limite + $tiempoEspera) {
                $this->actualiarPuestosUsuario(5);
                echo '<script>
					location.reload();
					$("#reloj_temporizador").html("' . $temp2 . '");
					$( "#dialog-trip-pregunta" ).dialog( "close" );
				</script>';
            }
        }
    }

    public function temporizador($tiempo, $consumido) {
        $tempo = date('i:s', strtotime('Y-m-d') + ($tiempo - $consumido));
        return $tempo;
    }

    public function limiteTiempo() {
        $min = 5; //5 minutos
        $seg = $min * 60;
        return $seg;
    }

    public function types_payments() {
        return $op = array("1" => array("PRED-PAID" => "CREDIT CARD WITH FEE"),
            "2" => array("PRED-PAID" => 'CREDIT CARD NO FEE'),
            "3" => array("COLLECT ON BOARD" => "CREDIT CARD WITH FEE"),
            "4" => array("COLLECT ON BOARD" => "CASH"),
            "5" => array("VOUCHER" => "CREDIT VOUCHER"),
            "6" => array("PRED-PAID" => "CASH"),
            "7" => array("FREE SERVICES" => "COMPLEMENTARY"),
            "8" => array("COLLECT ON BOARD" => "CREDIT CARD NO FEE"),
            "9" => array("COLLECT ON BOARD" => "CHECK"),
            "10" => array("PRED-PAID" => "CHECK")
        );
    }

    public function codigoConf($tipo) {
        if ($tipo == 1) {//Pago
            $prefijo = 'R';
        } else {//Cotizacion
            $prefijo = 'QR';
        }
        do {
            $mes = date("m");
            $dia = date("d");
            $y = date("y");
            $code = $prefijo . $y . $mes . $dia . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
            $a = $this->db()->find('Reserve', array('where' => 'codconf = ?',
                'limit' => 1,
                'select' => 'codconf',
                'param' => array($code)
                    )
            );
        } while ($a != null);
        return $code;
    }

    public function trip_price($trip_no, $dat, $fecha, $fecha2, $from, $to, $residente) {
        $anno = substr($fecha, -4);
        $sql = "select      t2.price, 
                              t2.price2,
			      t2.price3,
			      t2.price4,
                              t1.trip_no
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.trip_no = ? and t2.anno = ? and t2.trip_from = ? AND t2.trip_to = ? and t1.fecha = ? and t2.type_rate = ? ";

        $rs = Doo::db()->query($sql, array($trip_no, $anno, $from, $to, $fecha, $dat->type_rate));
        $salida = $rs->fetch(); // Salidas


        if ($dat->type_rate == 2) { // Salidas Especial Net
            $sqlNet = "select 
								  t2.price, 
								  t2.price2,
								  t2.price3,
								  t2.price4, 
								  t1.trip_no
							 from programacion t1
							 left join routes_net t2 on (t1.trip_no = t2.trip_no)
							 left join trips  t3 on (t1.trip_no = t3.trip_no)
							 left join areas  t4 on (t2.trip_from = t4.id)
							 left join areas  t5 on  (t2.trip_to  = t5.id)
							 where t2.trip_no = ? and t2.anno = ? and t2.trip_from = ? AND t2.trip_to = ? and t1.fecha = ? and t2.type_rate = ?";

            $rs = Doo::db()->query($sqlNet, array($trip_no, $anno, $from, $to, $fecha, 2));

            $sEspNet = $rs->fetch();
        } else {
            $sEspNet = array();
        }
        if (!empty($sEspNet)) {// Si encontro especiales los remplazamos
            if ($sEspNet["trip_no"] == $salida["trip_no"]) {
                $salida = $sEspNet;
            }
        }
        if ($dat->id == -1) {
            $sql2 = "select * from ofertas where fecha_ini<= ? and fecha_fin >= ? and trip_no= ? and trip_from = ? AND trip_to = ?";
            $query = Doo::db()->query($sql2, array(strtotime($fecha2), strtotime($fecha2), $trip_no, $from, $to));
            $rs = $query->fetch();
        } else {
            $rs = "";
        }
        $ofertas = false;
        $precios = array();

//        print_r($rs);
//        exit;
        if (!empty($rs)) {
            $salida['price'] = $rs['price'];
            $salida['price2'] = $rs['price2'];
            $salida['price3'] = $rs['price3'];
            $salida['price4'] = $rs['price4'];
        }

        if ($residente == 1) {
            $datos['price_adult'] = $salida['price4'];
            $datos['price_child'] = $salida['price3'];
        } else {
            $datos['price_adult'] = $salida['price'];
            $datos['price_child'] = $salida['price2'];
        }

//        print_r(strtotime($fecha));

        return $datos;
    }

    public function pago_agente() {
        $cantidad = $this->params["cantidad"];
        $this->data['ssl_email'] = $this->params["ssl_email"];
        $this->data['ssl_first_name'] = $this->params["ssl_first_name"];
        $this->data['ssl_last_name'] = $this->params["ssl_last_name"];
        $this->data['ssl_phone'] = $this->params["ssl_phone"];
        $this->data['reserva_cod'] = $this->params["reserva"];

        Doo::loadModel('Usuarios');
        $usuario = Doo::db()->getone("Usuarios", array("select" => "*", "where" => "id = ?", "param" => array($_SESSION["login"]->id)));

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['pago'] = $cantidad;
        $this->data['usuario'] = $_SESSION["login"];
        $this->view()->renderc('admin/configuracion/pago_agente', $this->data);
    }

    public function decline() {
        echo "Date " . $_GET["ssl_txn_time"];
        echo "<h1>DECLINE</h1>";
        echo "CREDIT CARD SALE" . "<br>" . "<br>";
        echo " CARD NUMBER: " . $_GET["ssl_card_number"] . "<br>";
        echo " TRAN AMOUNT: " . $_GET["ssl_amount"] . "<br>";
        echo " APPROVAL CD: " . $_GET["ssl_approval_code"] . "<br>";
        echo " MESSAGE: " . $_GET["ssl_result_message"] . "<br>";
        echo " Reservation#: " . $_GET["Reservation_Number"] . "<br>";
        echo " Passenger\'s Name: " . $_GET["PassengersName"] . "<br>";
    }

    public function approval() {
        echo "Date " . $_GET["ssl_txn_time"];
        echo "<h1>APPROVED</h1>";
        echo "CREDIT CARD SALE" . "<br>" . "<br>";
        echo " CARD NUMBER: " . $_GET["ssl_card_number"] . "<br>";
        echo " TRAN AMOUNT: " . $_GET["ssl_amount"] . "<br>";
        echo " APPROVAL CD: " . $_GET["ssl_approval_code"] . "<br>";
        echo " MESSAGE: " . $_GET["ssl_result_message"] . "<br>";
        echo " Reservation#: " . $_GET["Reservation_Number"] . "<br>";
        echo " Passenger\'s Name: " . $_GET["PassengersName"] . "<br>";
    }

}
