<?php

/**
 * Description of ToursController: Controlador para los tours realizados por los operadores
 *
 * @author Andrew Fraser Soñett
 */
Doo::loadController('I18nController');
Doo::loadController('admin/TrafficController');
ob_start();
set_time_limit(320);
ini_set('memory_limit', '356M');
Doo::loadHelper('class.phpmailer');
Doo::loadModel('Hoteles');
Doo::loadModel('Traffic');

class ToursController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {
        // Cargamos el paginador

        Doo::loadHelper('DooPager');
        $filtro = "";

        if (!isset($_POST["filtro2"])) {
            if (!isset($this->params['filtro2'])) {
                $filtro = "code_conf";
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

        if ($filtro == 'nomcliente') {
            $where = 'CONCAT_WS(" ",c.firstname,c.lastname) like "%' . $texto . '%" ';
        } else {
            $where = $filtro . ' like "%' . $texto . '%"';
        }

        $text2 = ($filtro == 'code_conf') ? $texto : '';
        $sql1 = "SELECT COUNT( * ) AS total
                 FROM tours
                 WHERE code_conf LIKE  ? and estado = 'CONFIRMED' or estado = 'CANCELED'";
        $query = Doo::db()->query($sql1, array($text2 . '%'));
        $rs = $query->fetchAll();
        $total = $rs[0]['total'];
        if ($total == 0) {
            $total = 1;
        }



        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $sql = "SELECT t.`estado`, t.`id` , t.`id_client` , t.`type_client` , t.`id_agency` , t.`code_conf` , t.`agency_employee` , t.`creation_date` , t.`starting_date` , t.`ending_date` , t.`length_day` , t.`length_nights` , t.`id_reserva` , t.`id_transfer_in` , t.`id_transfer_out` , t.`id_hotel_reserve` , t.`tipo_pago` , t.`pago` , t.`total` , t.`totalouta` , t.`otheramount` , t.`extra_charge`,t.`estado` , CONCAT( c.firstname,  ' ', c.lastname ) AS nomcliente, company_name, CONCAT( ua.firstname,  ' ', IFNULL(ua.lastname,'') ) AS nomempleado
                FROM  `tours` t
                LEFT JOIN clientes c ON ( t.id_client = c.id ) 
                LEFT JOIN agencia ag ON ( t.id_agency = ag.id ) 
                LEFT JOIN user_agencia ua ON ( t.agency_employee = ua.id ) 
                WHERE $where  ORDER BY t.`id` DESC limit $pager->limit";

        $rs = Doo::db()->query($sql, array($texto . '%'));
        $tours = $rs->fetchAll();
        $rs->closeCursor();
//        print_r(Doo::db()->showSQL());
//        exit;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tours.php';
        $this->data['filtro2'] = $filtro;
        $this->data['texto2'] = $texto;
        $this->data['tours'] = $tours;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function quoted() {
        // Cargamos el paginador

        Doo::loadHelper('DooPager');
        $filtro = "";

        if (!isset($_POST["filtro2"])) {
            if (!isset($this->params['filtro2'])) {
                $filtro = "code_conf";
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

        $sql1 = "SELECT COUNT( * ) AS total
                 FROM tours
                 WHERE code_conf LIKE  ? and estado = 'QUOTE'";
        $query = Doo::db()->query($sql1, array($texto . '%'));
        $rs = $query->fetchAll();
        $total = $rs[0]['total'];
        if ($total == 0) {
            $total = 1;
        }
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex'])) {
            $pager->paginate(intval($this->params['pindex']));
        } else {
            $pager->paginate(1);
        }

        $sql = "SELECT t.`id` , t.`id_client` , t.`type_client` , t.`id_agency` , t.`code_conf` , t.`agency_employee` , t.`creation_date` , t.`starting_date` , t.`ending_date` , t.`length_day` , t.`length_nights` , t.`id_reserva` , t.`id_transfer_in` , t.`id_transfer_out` , t.`id_hotel_reserve` , t.`tipo_pago` , t.`pago` , t.`total` , t.`totalouta` , t.`otheramount` , t.`extra_charge` , CONCAT( c.firstname,  ' ', c.lastname ) AS nomcliente, company_name, CONCAT( ua.firstname,  ' ', ua.lastname ) AS nomempleado
                FROM  `tours` t
                LEFT JOIN clientes c ON ( t.id_client = c.id ) 
                LEFT JOIN agencia ag ON ( t.id_agency = ag.id ) 
                LEFT JOIN user_agencia ua ON ( t.agency_employee = ua.id ) 
                WHERE $filtro LIKE ? and estado = 'QUOTE' ORDER BY t.`id` DESC limit $pager->limit";

        $rs = Doo::db()->query($sql, array($texto . '%'));
        $tours = $rs->fetchAll();
        $rs->closeCursor();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tours_quoted.php';
        $this->data['filtro2'] = $filtro;
        $this->data['texto2'] = $texto;
        $this->data['tours'] = $tours;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    /*
     * AUSU jQuery-Ajax Autosuggest v1.0
     * Demo of a simple server-side request handler
     * Note: This is a very cumbersome code and should only be used as an example
     */

    public function loadDatos() {
        # Assign local variables
        $id = @$_POST['id']; // The id of the input that submitted the request.
        $data = @$_POST['data']; // The value of the textbox.
        $id_agency = @$_POST['id_a'];
        $id_from1 = @$_POST['id_from1'];
        $id_to1 = @$_POST['id_to1'];
        $id_from2 = @$_POST['id_from2'];
        $id_to2 = @$_POST['id_to2'];
        $id_exten1 = @$_POST['id_exten1'];
        $id_exten2 = @$_POST['id_exten2'];
        $id_exten3 = @$_POST['id_exten3'];
        $id_exten4 = @$_POST['id_exten4'];
        $fecha_retorno = @$_POST['fecha_retorno'];
        $fecha_salida = @$_POST['fecha_salida'];

        $categoria_park = @$_POST['categoria_park'];

        if ($id == 'cliente') {
            $sql = "SELECT id,username,firstname,lastname,phone
				FROM clientes 
                WHERE lastname LIKE ? or   firstname LIKE ?   LIMIT 5 ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%', '%' . $data . '%'));
            $consulta = $rs->fetchAll();
            $dataList = array();
            foreach ($consulta as $consul) {
                $toReturn = $consul['lastname'] . " " . $consul['firstname'] . " - E-Mail -" . $consul['username'];
                $dataList[] = '<li  id="' . $consul['id'] . '"><a >' . htmlentities($toReturn) . '</a></li>';
            }
            if (count($dataList) >= 1) {
                $dataOutput = join("\r\n", $dataList);
                echo "<ul style='width:396px;'>";
                echo $dataOutput;
                echo "</ul>";
            } else {
                $dataList[] = '<li id="-1"  ><a >No Results</a></li>';
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:396px;">';
                echo $dataOutput;
                echo "</ul>";
            }
        } else if ($id == 'agency') {
            $sql = "SELECT id,company_name,tour_name FROM agencia
			WHERE company_name LIKE ?  LIMIT 5  ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%'));
            $consulta = $rs->fetchAll();
            $dataList = array();
            foreach ($consulta as $consul) {
                $toReturn = $consul['company_name'];
                $special_price_name = $consul['tour_name'];
                $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
                echo '<input type="hidden" id="tour_name1" name="tour_name1" value="' . $special_price_name . '" />';
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
        } else if ($id == 'uagency') {
            $sql = "SELECT  id,firstname, lastname
							FROM user_agencia
						WHERE firstname LIKE ? and id_agencia = ?  LIMIT 5  ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%', $id_agency));
            $consulta = $rs->fetchAll();
            $dataList = array();
            foreach ($consulta as $consul) {
                $toReturn = $consul['firstname'] . ' ' . $consul['lastname'];
                $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
            }
            if (count($dataList) >= 1) {
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:200px;">';
                echo $dataOutput;
                echo "</ul>";
            } else {
                $dataList[] = '<li><a>No Results</a></li>';
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:200px;">';
                echo $dataOutput;
                echo "</ul>";
            }
        } else if ($id == 'a_pickup1') {
            $sql = "SELECT  id,id_area,place,address
							FROM pickup_dropoff
							WHERE (place LIKE ? or   address LIKE ?) and id_area = ? and valid = 0 AND type_web  = 0 LIMIT 5  ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%', '%' . $data . '%', $id_from1));
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
                echo '<ul style="width:300px;"><li  id = "-1" ><a >No Results</a></li></ul>';
            }
        } else if ($id == 'd_pickup1') {
            $sql = "SELECT  id,id_area,place,address
							FROM pickup_dropoff
							WHERE (place LIKE ? or   address LIKE ?) and id_area = ? and valid = 0  AND type_web  = 0 LIMIT 5  ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%', '%' . $data . '%', $id_to2));
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
                echo '<ul style="width:300px;"><li id = "-1"><a >No Results</a></li></ul>';
            }
        } else if ($id == 'hotel_name') {
            list($mes, $dia, $anio) = explode('-', $fecha_salida);
            $fecha_salida = $anio . '-' . $mes . '-' . $dia;
            list($mes, $dia, $anio) = explode('-', $fecha_retorno);
            $fecha_retorno = $anio . '-' . $mes . '-' . $dia;

            /////////////////////////////////////////////////////////////////////////////////////////////
//            if ($costohotel['total'] <= 0 && $nochesfree == 0) {
//                echo '<script>alert("This hotel has no price configured for selected dates");
//                                             
//                      </script>';
//                Exit ();
//            } 
            //////////////////////////////////////////////////////////////////////////////////////////////

            $sql = "SELECT id, codigo, categoria, nombre, address, city, zipcode, contacname, phone, email, webpage, breakfast, resoftfe, description, image1
				FROM hoteles 
				WHERE id  NOT IN (
					SELECT id_hotel FROM  ratesblock WHERE  (
							ratesblock.fecha_ini BETWEEN  $fecha_salida AND $fecha_retorno ) 
							OR (ratesblock.fecha_fin BETWEEN  $fecha_salida AND $fecha_retorno)  
							OR (
								($fecha_salida BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin ) 
								OR ($fecha_retorno BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin )
							)  
                           )
				AND estado = 1 AND nombre LIKE ? ORDER BY categoria";
            $rs = Doo::db()->query($sql, array('%' . $data . '%'));

            $hoteles = $rs->fetchAll();
            $dataList = array();
            foreach ($hoteles as $consul) {
                if ($consul['categoria'] == 2) {
                    $categoria = 'TOURIST';
                    $img = '2.png';
                } else if ($consul['categoria'] == 3) {
                    $categoria = 'SUPERIOR';
                    $img = '3.png';
                } else if ($consul['categoria'] == 4) {
                    $categoria = 'FIRST CLASS';
                    $img = '4.png';
                } else {
                    $categoria = 'OTHER CATEGORY';
                    $img = 'interrogation.png';
                }
                $toReturn = $consul['nombre'];
                $dato = '<table><tr><td style="width:75px"><img src="' . Doo::conf()->APP_URL . 'global/img/' . $img . '" border="0"></td><td valign="top">' . htmlentities($toReturn) . '</td></tr></table>';
                $dataList[] = '<li  id="' . $consul['id'] . '" ><a  title="' . $categoria . '" >  ' . $dato . '</a></li>';
            }
            if (count($dataList) >= 1) {
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:400px;">';
                echo $dataOutput;
                echo "</ul>";
            } else {
                $dataList[] = '<li id="-1"  ><a >No Results</a></li>';
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:200px;">';
                echo $dataOutput;
                echo "</ul>";
            }
        } else if ($id == 'park_name') {
            if ($categoria_park == 0) {
                $sql = "SELECT `id`, `nombre`, `id_grupo`, `image1`, `description` FROM `parques` 
					WHERE nombre LIKE ? limit 7";
                $rs = Doo::db()->query($sql, array('%' . $data . '%'));
            } else {
                $sql = "SELECT `id`, `nombre`, `id_grupo`, `image1`, `description` FROM `parques` 
					WHERE  id_grupo = ? AND nombre LIKE ? limit 7";
                $rs = Doo::db()->query($sql, array($categoria_park, '%' . $data . '%'));
            }
            $parques = $rs->fetchAll();
            $dataList = array();
            foreach ($parques as $consul) {
                if ($consul['id_grupo'] == 9) { // El grupo de id 9 es de los parque de la noche
                    $tipo = 'Night';
                } else {
                    $tipo = 'Day';
                }
                $toReturn = $consul['nombre'];
                $dataList[] = '<li id="' . $consul['id'] . '" ><a><table width="90%"><tr><td >' . htmlentities($toReturn) . '</td><td  style="width:30px;" >' . $tipo . '</td></tr></table></a>
							</li>';
            }
            if (count($dataList) >= 1) {
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:300px;">';
                echo $dataOutput;
                echo "</ul>";
            } else {
                $dataList[] = '<li id="-1"  ><a >No Results</a></li>';
                $dataOutput = join("\r\n", $dataList);
                echo '<ul style="width:300px;">';
                echo $dataOutput;
                echo "</ul>";
            }
        }
    }

    public function cargarDatos() {
        $id = $this->params["id"];   
        //print($id);
        $pertenece = $this->params["id2"];
        if ($pertenece == 'cliente') {
            $sql = "SELECT id, username, firstname, lastname, password, phone, celphone, city, state, country, address, zip, tipo_client, birthday, fecha_r, points, left_points, paid_points FROM  clientes WHERE id = ? ";
            $rs = Doo::db()->query($sql, array($id));
            $datos = $rs->fetch();
            Doo::loadController('admin/ReservasController');
            $reservControl = new ReservasController();
            $apto = $reservControl->clienteAptoPagoWeb($datos);
            $sql = "select country,city,state,address,zip from clientes where id= ?";
            $rs = Doo::db()->query($sql, array($id));
            $results = $rs->fetchAll();
            $output = true;
            if (isset($results[0])) {
                foreach ($results[0] as $r => $v) {
                    //echo $v;
                    if ($v == "") {
                        $output = 'false';
                        break;
                    }
                    $output = 'true';
                }
            }
            //echo $output;
            if (!empty($datos)) {
                echo "<script> 
				  $('#complete').val('" . $output . "');
				  $('#idCliente').val('" . $datos['id'] . "');
				  $('#firstname1').val('" . $datos['firstname'] . "');
				  $('#lastname1').val('" . $datos['lastname'] . "');
				  $('#phone1').val('" . $datos['phone'] . "');
				  $('#email1').val('" . $datos['username'] . "');
				  $('#type_cliente').val('" . $datos['tipo_client'] . "');
				  $('#cliente_apto').val('" . $apto . "');
				  $('#idPagador').val('" . $datos['id'] . "');
                                  console.log('salida');
				</script>";
            } else {
                echo "<script> 
				  $('#idCliente').val('')
				  $('#firstname1').val('');
				  $('#lastname1').val('');
				  $('#phone1').val('');
				  $('#email1').val('');
				  $('#type_cliente').val('');
				</script>";
            }
        } else if ($pertenece == 'agency') {
            if ($id == -1 || $id == 0 || $id == '') {
                echo "<script>
						$('#uagency').attr('disabled',true);					
						$('#uagency').val('');
						$('#id_auser').val('-1');
						$('#agency').val('');
						$('#id_agency').val('-1');
						$('#type_rate').val('0');
						$('#disponible').val('0');
						$('#tableTypeSaldo').css('display','none');
						$('#totalComision').val('0');
					</script>";
                echo "<script>
						$('#CgCar').html('Credi Car');
						$('#tipo_passager').css('display', 'block');
						$('#tipo_agency').css('display', 'none');
					</script>";

                echo "<script>
						$('#tipo_CrediFee').css('display', 'block');
					</script>";

                echo "<script>
						$('#tipo_predpaid_cash').css('display', 'none');
					</script>";

                echo "<script>
							$('#tipo_Voucher').css('display', 'none');
							$('#disponible').val(0);
					</script>";

                echo "<script>
							$('#div_tex_comision').css('display', 'none');
							$('#div_val_comision').css('display', 'none');
					</script>";
            } else {
                $rs = Doo::db()->query("SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days
										   FROM agency_account WHERE id_agencia = ? ", array($id));
                $datos = $rs->fetch();
                Doo::loadController("AgenciaController");
                $agenControl = new AgenciaController();
                $disponible = $agenControl->credito($id);


                $sql2 = "SELECT type_rate FROM  `agencia` WHERE id = ?";
                $rs = Doo::db()->query($sql2, array($id));
                $type = $rs->fetch();
                $type_rate = $type['type_rate'];

                if ($type_rate == 0) {
                    echo "<script>
							$('#div_tex_comision').css('display', 'block');
							$('#div_val_comision').css('display', 'block');
                                        $('#tableTypeSaldo').css('display', 'block');
                                                        $('#comisionable').val(1);
					</script>";
                } else {
                    echo "<script>
							$('#div_tex_comision').css('display', 'none');
							$('#div_val_comision').css('display', 'none');
					</script>";
                }
                echo "<script>
					$('#type_rate').val( '" . $type_rate . "');
						$('#uagency').attr('disabled',false);
				</script>";
                if ($datos['opcion1'] != 0) {
                    echo "<script>
						$('#CrediCar').html('Passanger Credit Card');
						$('#tipo_passager').css('display', 'block');
						$('#tipo_agency').css('display', 'block');
					</script>";
                } else {
                    echo "<script>
						$('#CrediCar').html('Credi Car');
						$('#tipo_passager').css('display', 'none');
						$('#tipo_agency').css('display', 'none');
						</script>";
                }
                if ($datos['opcion3'] != 0) {
                    echo "<script>
						$('#tipo_CrediFee').css('display', 'block');
                                                $('#tipo_passager_2').css('display', 'block');
                                                $('#tipo_Cash_2').css('display', 'block');
					</script>";
                } else {
                    echo "<script>
							$('#tipo_CrediFee').css('display', 'none');
					</script>";
                }
                if ($datos['opcion4'] != 0) {
                    echo "<script>
							$('#tipo_Cash').css('display', 'block');
					</script>";
                } else {
                    echo "<script>
							$('#tipo_Cash').css('display', 'none');
					</script>";
                }
                
                //echo $datos['opcion5'];
                $voucher = $datos['opcion5'];
                
                echo "<script>document.getElementById('idagencia').value= '" . $voucher . "'</script>";
                
                if ($datos['opcion5'] != 0) {
                    if ($datos['opcion5'] == 1) {
                        $txt = 'Open Credit Voucher';
                        $disponible = -1;
                    } else {
                        Doo::loadController("AgenciaController");
                        $agenControl = new AgenciaController();
                        $disponible = $agenControl->credito($id);
                        $txt = 'Limit Credit Voucher';
                    }
                    echo "<script>
					$('#txtTipo_Voucher').text('" . $txt . "');
					$('#tipo_Voucher').css('display', 'block');
//					$('#uagency').removeAttr('disabled');
					$('#disponible').val( '" . $disponible . "');
			</script>";
                } else {
                    echo "<script>
					$('#tipo_Voucher').css('display', 'none');
					$('#disponible').val( '" . $disponible . "');
			</script>";
                }
            }
        } else if ($id == 'uagency') {
            $sql = "SELECT  id,firstname, lastname
							FROM user_agencia
						WHERE firstname LIKE ? and id_agencia = ?  LIMIT 5  ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%', $id_agency));
            $consulta = $rs->fetchAll();
            $dataList = array();
            foreach ($consulta as $consul) {
                $toReturn = $consul['firstname'] . ' ' . $consul['lastname'];
                $dataList[] = '<li  id="' . $consul['id'] . '" ><a >' . htmlentities($toReturn) . '</a></li>';
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
        } else if ($pertenece == 'park_name') {
            $sql = "SELECT `id`, `nombre`, `id_grupo`, `image1`, `description` FROM `parques`
							WHERE id = ?";
            $rs = Doo::db()->query($sql, array($id));
            $parques = $rs->fetch();
            echo "<script>
							$('#park_name').val('" . $parques['nombre'] . "')
					</script>";
        }
        if ($pertenece == 'hotel_name') {
            $sql = 'select * from hoteles where id = ?';
            $rs = Doo::db()->query($sql, array($id));
            $hotel = $rs->fetchAll();
            echo '<script>
                  $("#hotel_cat").val(' . $hotel[0]['categoria'] . ');
                  $("#super_breakfast").val(' . $hotel[0]['super_breakfast'] . ');
                  </script>';
        }
    }

    /*
     * @name loadcompany()
     * @params input['text']
     * @action listar Clientes por Filtro
     * @author Elbert Tous
     */

    public function loadcompany() {


        $Clientes = array();
        $param = '%' . $this->params['txt'] . '%';
        $res = Doo::db()->query("SELECT id,company_name FROM agencia WHERE UPPER(company_name) like  UPPER(?)  or UPPER(address) like  UPPER(?) or UPPER(city) like  UPPER(?) or UPPER(state) like  UPPER(?) or UPPER(main_email) like  UPPER(?) or UPPER(country) like  UPPER(?) or UPPER(id)  like  UPPER(?) ", array($param, $param, $param, $param, $param, $param, $param));

        $consulta = $res->fetchAll();
        ($consulta) or die('Not Results');
        foreach ($consulta as $consul) {
            $Clientes[] = array(
                'label' => $consul['company_name'],
                'value' => $consul['company_name'],
                'id' => $consul['id'],
            );
        }
        echo json_encode($Clientes);
        return;
    }

    /*
     * @name loadcompany()
     * @params input['text']
     * @action listar Clientes por Filtro
     * @author Elbert Tous
     */

    public function loademploy() {

        $Clientes = array();
        $param = '%' . $this->params['txt'] . '%';
        $res = Doo::db()->query("SELECT DISTINCT firstname,lastname,id FROM user_agencia WHERE id like  ?  or firstname like  ? or lastname like  ? or email like  ? LIMIT 5", array($param, $param, $param, $param));

        $consulta = $res->fetchAll();
        ($consulta) or die('Not Results');
        foreach ($consulta as $consul) {
            $Clientes[] = array(
                'label' => $consul['firstname'] . " " . $consul['lastname'],
                'value' => $consul['firstname'] . " " . $consul['lastname'],
                'id' => $consul['id'],
            );
        }
        echo json_encode($Clientes);

        return;
    }

    public function comision_servis() {
        //Cargamos las comisiones de los servicios
        //003->TOURS
        //004->Hotel
        //005->Atraction 
        //006->Transfer
        //La comision de los buses se calcula en el momento en que el usuario selecciona el bus

        $servis = array("003" => 0, "004" => 0, "005" => 0, "006" => 0);
        foreach ($servis as $key => $val) {
            $sql = "SELECT `service_code`, `comision` 
					FROM `agencia_comision` 
					WHERE service_code = ?";
            $rs = Doo::db()->query($sql, array($key));
            $comis = $rs->fetch();
            if (empty($comis)) {
                $servis[$key] = 15;
            } else {
                $servis[$key] = $comis['comision'];
            }
        }
        return $servis;
    }

    public function add() {
        unset($_SESSION['tours']['hoteles_n']);
        Doo::loadModel("Tours");
        $tour = new Tours();
        $sql = "SELECT DISTINCT t1.trip_to AS id, t2.nombre
				FROM routes t1
				LEFT JOIN areas t2 ON ( t1.trip_to = t2.id ) 
				WHERE t1.trip_from =1";
        $rs = Doo::db()->query($sql);
        $to_areas = $rs->fetchAll();

        $servis = $this->comision_servis();
        

        //Area de los parques: defaul orlando
        $sql = "SELECT t2.id, t2.nombre  FROM areas t2
					WHERE t2.id = 1";
        $rs = Doo::db()->query($sql);
        $area_park = $rs->fetchAll();
        $sql = "select * from grupo_parques";
        $query = Doo::db()->query($sql);
        $rs2 = $query->fetchAll();
        $this->data['grupos'] = $rs2;
        $_SESSION['tours'] = array();
        $_SESSION['tours']['attraction'] = array();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tour'] = $tour;
        $this->data['comsion_servis'] = $servis;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['to_areas'] = $to_areas;
        $this->data['area_park'] = $area_park;
        do {
            $mes = date("m");
            $dia = date("d");
            $y = date("y");
            $prefix = 'TM';
            $_SESSION['codconf'] = $prefix . $y . $mes . $dia . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
            //echo $_SESSION['codconf'];
            $a = $this->db()->find('Tours', array(
                'where' => 'code_conf = ?',
                'limit' => 1,
                'select' => 'code_conf',
                'param' => array($_SESSION['codconf'])
            ));
        } while ($a != null);
        $this->data['content'] = 'configuracion/frm_tours.php';
        $this->renderc('admin/index', $this->data);
    }

    public function trip_comision($trip) {
        $sql = "SELECT equipment 
				FROM  `trips` WHERE trip_no = ?";
        $rs = Doo::db()->query($sql, array($trip));
        $equipment = $rs->fetch();
        if (!empty($equipment)) {
            $service = $equipment['equipment'];
            $sql = "SELECT `comision` 
					FROM `agencia_comision` 
					WHERE service = '" . $equipment['equipment'] . "'";
            $rs = Doo::db()->query($sql);
            $comis = $rs->fetch();
            if (!empty($comis)) {
                $valor = $comis['comision'];
                return $valor;
            } else {
                return 10;
            }
        } else {
            return 10; // Comision por defaults
        }
    }

    public function save() {
        /* echo json_encode($_POST);
          exit; */

        extract($_POST, EXTR_SKIP);
         
        $rates = $_POST["rates"];
        //print($rates);
        //exit();
        //GLOBAL $categor;
        //echo  $categor;
        
        //capturamos el tipo de opcion seleccionada en Add Payment
        //$opc_ap = $_POST['opc_ap'];
        //capturamos 4% del valor asignado en Add Payment
        
        $opcion_pago_conductor = $_POST['op_pago_conductor'];
        
        $no_pago = $_POST['no_pago'];
        $no_prep = $_POST['no_prep'];
        
        
        //PAGOS COLLECT ON BOARD
        
        $pago_1 = $_POST['pago_1'];
        $pago1 = $_POST['pago1'];
        $tipo_pago1 = $_POST['tipo_pago1'];
        $pagado1 = $_POST['pagado1'];
        
        $pago_2 = $_POST['pago_2'];
        $pago2 = $_POST['pago2'];
        $tipo_pago2 = $_POST['tipo_pago2'];
        $pagado2 = $_POST['pagado2'];
        
        $pago_3 = $_POST['pago_3'];
        $pago3 = $_POST['pago3'];
        $tipo_pago3 = $_POST['tipo_pago3'];
        $pagado3 = $_POST['pagado3'];
        
        $pago_4 = $_POST['pago_4'];
        $pago4 = $_POST['pago4'];
        $tipo_pago4 = $_POST['tipo_pago4'];
        $pagado4 = $_POST['pagado4'];
        
        $pago_5 = $_POST['pago_5'];
        $pago5 = $_POST['pago5'];
        $tipo_pago5 = $_POST['tipo_pago5'];
        $pagado5 = $_POST['pagado5'];
        
        $pago_6 = $_POST['pago_6'];
        $pago6 = $_POST['pago6'];
        $tipo_pago6 = $_POST['tipo_pago6'];
        $pagado6 = $_POST['pagado6'];
        
        $pago_7 = $_POST['pago_7'];
        $pago7 = $_POST['pago7'];
        $tipo_pago7 = $_POST['tipo_pago7'];
        $pagado7 = $_POST['pagado7'];
        
        $pago_8 = $_POST['pago_8'];
        $pago8 = $_POST['pago8'];
        $tipo_pago8 = $_POST['tipo_pago8'];
        $pagado8 = $_POST['pagado8'];
        
        $pago_9 = $_POST['pago_9'];
        $pago9 = $_POST['pago9'];
        $tipo_pago9 = $_POST['tipo_pago9'];
        $pagado9 = $_POST['pagado9'];
        
        $pago_10 = $_POST['pago_10'];
        $pago10 = $_POST['pago10'];
        $tipo_pago10 = $_POST['tipo_pago10'];
        $pagado10 = $_POST['pagado10'];
        
        
        //PAGOS PRE-PAID
        
        $pago_pre1 = $_POST['pago_pre1']; 
        $pagopre1 = $_POST['pagopre1'];
        $tipo_pagopre1 = $_POST['tipo_pagopre1'];
        $pagadopre1 = $_POST['pagadopre1']; 
        
        $pago_pre2 = $_POST['pago_pre2']; 
        $pagopre2 = $_POST['pagopre2'];
        $tipo_pagopre2 = $_POST['tipo_pagopre2'];
        $pagadopre2 = $_POST['pagadopre2']; 
        
        $pago_pre3 = $_POST['pago_pre3']; 
        $pagopre3 = $_POST['pagopre3'];
        $tipo_pagopre3 = $_POST['tipo_pagopre3'];
        $pagadopre3 = $_POST['pagadopre3']; 
        
        $pago_pre4 = $_POST['pago_pre4']; 
        $pagopre4 = $_POST['pagopre4'];
        $tipo_pagopre4 = $_POST['tipo_pagopre4'];
        $pagadopre4 = $_POST['pagadopre4'];
        
        $pago_pre5 = $_POST['pago_pre5']; 
        $pagopre5 = $_POST['pagopre5'];
        $tipo_pagopre5 = $_POST['tipo_pagopre5'];
        $pagadopre5 = $_POST['pagadopre5'];
        
        $pago_pre6 = $_POST['pago_pre6']; 
        $pagopre6 = $_POST['pagopre6'];
        $tipo_pagopre6 = $_POST['tipo_pagopre6'];
        $pagadopre6 = $_POST['pagadopre6'];
        
        $pago_pre7 = $_POST['pago_pre7']; 
        $pagopre7 = $_POST['pagopre7'];
        $tipo_pagopre7 = $_POST['tipo_pagopre7'];
        $pagadopre7 = $_POST['pagadopre7'];
        
        $pago_pre8 = $_POST['pago_pre8']; 
        $pagopre8 = $_POST['pagopre8'];
        $tipo_pagopre8 = $_POST['tipo_pagopre8'];
        $pagadopre8 = $_POST['pagadopre8'];
        
        $pago_pre9 = $_POST['pago_pre9']; 
        $pagopre9 = $_POST['pagopre9'];
        $tipo_pagopre9 = $_POST['tipo_pagopre9'];
        $pagadopre9 = $_POST['pagadopre9'];
        
        $pago_pre10 = $_POST['pago_pre10']; 
        $pagopre10 = $_POST['pagopre10'];
        $tipo_pagopre10 = $_POST['tipo_pagopre10'];
        $pagadopre10 = $_POST['pagadopre10'];
        
        $result = $_POST['selectcond'];
        $balance_due = $_POST['balance_due'];
        $bal_duep1 = $_POST['bal_duep'];
        
        if( $bal_duep1 == 'NaN'){
            $bal_duep = '0.00';
        }else{
            $bal_duep = $bal_duep1;
        }


        $total_charge = $_POST['PAP'];        
        $otheramount = $_POST['otheramountp'];        
        $descuento_valor = $_POST['descuento_valor'];        
        $extra = $_POST['extra'];        
        $descuento = $_POST['descuento'];
           
        //AMOUNT TO COLLECT
        $totale = $_POST['saldoactual'];
        //PAID DRIVER
        $paid_driver = $_POST['paid_driver'];
        
        //PASSENGER BALANCE DUE
        if ($result== '8'){
            $passenger_balance_due = $balance_due;
        }else if ($result== '3'){
            $passenger_balance_due = $bal_duep;
        }else if ($result== '4'){
            $passenger_balance_due = $balance_due;
        }else if ($result== '9'){
            $passenger_balance_due = $balance_due;
        }else if ($result== '5'){
            $passenger_balance_due = $bal_duep;
        }else if ($result== '7'){
            $passenger_balance_due = $bal_duep;
        }
        
        
        
        
        //$passenger_balance_due = $_POST['balance_due'];
        //$passenger_balance_due = $_POST['saldoactual'];
        //TOTAL NET FARE
        $totaleouta = $_POST['totalAmount'];
        //AMOUNT PAID
        $pred_paid_amount = $_POST['pay_amount'];
        //AGENCY BALANCE DUE
        $agency_balance_due = $_POST['agency_balance_due'];
        
        //NOTES
        $comments = $_POST['comments'];
        
//        print($totale);
//        echo '<<<';
//        print($paid_driver);
//        echo '<<<';
//        print($passenger_balance_due);
//        echo '<<<';
//        print($totaleouta);
//        echo '<<<';
//        print($pred_paid_amount);
////        echo '<<<';
////        print($agency_balance_due);
////        echo '<<<';
////        print($comments);
////        
//        exit();

        $servis = $this->comision_servis();
        $completo = false;
        Doo::db()->beginTransaction();
        try {

            if (isset($opcion_transfer_in) && isset($opcion_transfer_out) && isset($opcion_hotel) && isset($opcion_traffic)) {
                $comi_in = $servis['003'];
                $comi_out = $servis['003'];
                $comi_hotel = $servis['003'];
                $comi_traffic = $servis['003'];
            } else {
                if (isset($opcion_transfer_in)) {
                    if ($a_type == 0) {
                        $comi_in = $this->trip_comision($a_trip_no);
                    } else {
                        $comi_in = $servis['006']; // servis_code del transfer.
                    }
                } else {
                    $comi_in = 15; // Comision por defaults
                }
                if (isset($opcion_transfer_out)) {
                    if ($d_type == 0) {
                        $comi_out = $this->trip_comision($d_trip_no);
                    } else {
                        $comi_out = $servis['006']; // servis_code del transfer.
                    }
                } else {
                    $comi_out = 15; // Comision por defaults
                }
                if (isset($opcion_hotel)) {
                    $comi_hotel = $servis['004']; // servis_code del transfer.
                } else {
                    $comi_hotel = 15; // Comision por defaults
                }
                if (isset($opcion_traffic)) {
                    $comi_traffic = $servis['005']; // servis_code del transfer.
                } else {
                    $comi_traffic = 15; // Comision por defaults
                }
            }
            $comi_traffic = 0; //OJO, No esta funcionando
            if (isset($_SESSION['tours_pago']) && $_SESSION['tours_pago'] == 'ok' && isset($_SESSION['codconf'])) {
                unset($_SESSION['tours_pago']);
            } else {
//            do{
//                $mes = date("m");
//                $dia = date("d");
//                $y = date("y");
//                $prefix = "";
//                if($estado == 'QUOTE'){
//                    $prefix = 'QM';
//                }else{
//                    $prefix = 'TM';
//                }
//                $_SESSION['codconf'] = $prefix. $mes .$y. $dia . rand(0, 9999);
//                $a = $this->db()->find('Tours', array('where' => 'code_conf = ?',
//                        'limit' => 1,
//                        'select' => 'code_conf',
//                        'param' => array($_SESSION['codconf'])
//                    )
//                );
//            }while($a != null);
            }
            // Consultando agencias
            Doo::loadModel("Agency");

            //actualizacion///////////////////////////////////////////

            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
            $type_rate = $dat->type_rate;



            $tourtrip = $this->params["rates"];


            if ($tourtrip == 0) {
                $id_tour = $dat->id_tour;
            } else {
                $id_tour = $tourtrip;
            }


            /////////////////////////////////////////////////////////
            if (isset($id_agency) && $id_agency != -1) {
                $dat = new Agency();
                $dat->id = $id_agency;
                $dat = Doo::db()->find($dat, array('limit' => 1));
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }
            // Fin consultando Agencia
            //Consultando Cliente
            Doo::loadModel("Clientes");
            if ($idCliente != -1 && $idCliente != "") {
                $cliente = new Clientes();
                $cliente->id = $idCliente;
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
            } else {
                $cliente = new Clientes();
                $cliente->firstname = $firstname1;
                $cliente->lastname = $lastname1;
                $cliente->phone = $phone1;
                $cliente->username = $email1;
                $cliente->id = Doo::db()->insert($cliente);
            }

            //Fin Consultando Cliente
            $op = $this->types_payments();

            //Transporte del tours
            Doo::loadModel("Reserve");
            Doo::loadModel("Transfer");
            $totalPax = $child + $adult;
            //Fechas
            if (isset($fecha_salida) && $fecha_salida != '') {
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha_salida = $anio . '-' . $mes . '-' . $dia;
            } else {
                $fecha_salida = 'N/A';
            }
            $anio1 = $anio;
            if (isset($fecha_retorno)) {
                list($mes, $dia, $anio) = explode('-', $fecha_retorno);
                $fecha_retorno = $anio . '-' . $mes . '-' . $dia;
            } else {
                $fecha_retorno = 'N/A';
            }
            $anio2 = $anio;
            //FIn fechas
            $a = $anio1 . '-01-01 00:00:00';
//            print($a);
            //////////////////////////////////////////////////////
//            $fecha_salida = $this->params["fecha"];
//            $anno = substr($fecha_salida, -4);
//            $anno = $anno . '-01-01 00:00:00';
            //Transfer In
            $totalTransferIn = 0;
            if (isset($opcion_transfer_in)) {
                if ($a_type != 0) {
                    $tranferIn = new Transfer();
                    $tranferIn->total_pax = $totalPax;
                    $tranferIn->arrival_time = $hora1;
                    $tranferIn->type = $a_type + 1;
                    if ($a_type == 1) {
                        $price = -1;
                        $tranferIn->type_transfer = 'VIP';
                        $tranferIn->city = $city;
                        $tranferIn->address = $address;
                        $tranferIn->zipcode = $zipcode;
                        $tranferIn->phone = $phone;
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesvip = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price,id_agency FROM tarifasvip WHERE cantidad = ? AND type_rate = ? and id_agency = ? and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesvip = $rs->fetch();
                            if (empty($pricesvip)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ?';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesvip = $rs->fetch();
                            }
                        }
                        if (!empty($pricesvip)) {
                            $price = number_format($pricesvip ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = $price;
                    } else if ($a_type == 2) {
                        $price = -1;
                        $tranferIn->airlie = $airlinearrival;
                        $tranferIn->flight = $flightarrival;
                        $tranferIn->type_transfer = 'PLANE';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesbyplane = $rs->fetch();
                            }
                        }
                        if (!empty($pricesbyplane)) {
                            $price = number_format($pricesbyplane ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = $price;
                    } else if ($a_type == 3) {
                        $price = -1;
                        $tranferIn->type_transfer = 'CAR';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($type_rate, $a));
                                $pricescar = $rs->fetch();
                            }
                        }

                        if (!empty($pricescar)) {
                            $price = number_format($pricescar ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = ($price) * ($adult + $child);
                    }
                    Doo::db()->insert($tranferIn);
                    $inTrans = Doo::db()->lastInsertId();
                    $totalTransferIn = $tranferIn->total_price;
                }
            } else {
                $a_trip_no = 0;
            }
            // FIN Transfer In
            $a = $anio2 . '-01-01 00:00:00';
            //Transfer Out
            $totalTransferOut = 0;
            if (isset($opcion_transfer_out)) {
                if ($d_type != 0) {
                    $tranferOut = new Transfer();
                    $tranferOut->total_pax = $totalPax;
                    $tranferOut->arrival_time = $hora2;
                    $tranferOut->type = $d_type + 1;
                    if ($d_type == 1) {
                        $price = -1;
                        $tranferOut->type_transfer = 'VIP';
                        $tranferOut->city = $city2;
                        $tranferOut->address = $address2;
                        $tranferOut->zipcode = $zipcode2;
                        $tranferOut->phone = $phone2;
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesvip = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price,id_agency FROM tarifasvip WHERE cantidad = ? AND type_rate = ? and id_agency = ? and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesvip = $rs->fetch();
                            if (empty($pricesvip)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ?';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesvip = $rs->fetch();
                            }
                        }
                        if (!empty($pricesvip)) {
                            $price = number_format($pricesvip ['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = $price;
                    } else if ($d_type == 2) {
                        $price = -1;
                        $tranferOut->airlie = $airlinedeparture;
                        $tranferOut->flight = $flightdeparture;
                        $tranferOut->type_transfer = 'PLANE';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesbyplane = $rs->fetch();
                            }
                        }
                        if (!empty($pricesbyplane)) {
                            $price = number_format($pricesbyplane['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = $price;
                    } else if ($d_type == 3) {
                        $price = -1;
                        $tranferOut->type_transfer = 'CAR';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($type_rate, $a));
                                $pricescar = $rs->fetch();
                            }
                        }
                        if (!empty($pricescar)) {
                            $price = number_format($pricescar ['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = ($price) * ($adult + $child);
                    }
                    Doo::db()->insert($tranferOut);
                    $OutTrans = Doo::db()->lastInsertId();
                    $totalTransferOut = $tranferOut->total_price;
                }
            } else {
                $d_trip_no = 0;
            }
            //FIN Transfer Out
            //tipo pago
            $arval = array_values($op[$opcion_pago]);
            $arkey = array_keys($op[$opcion_pago]);
            //fin tipo Pago
            // RESERVA
            $totalReserva = 0;
            if (( $a_type == 0 && isset($opcion_transfer_in) ) || ($d_type == 0 && isset($opcion_transfer_out))) {
                if (isset($ext_from1)) {
                    $precio_e1 = $this->precio_extencion($ext_from1, $dat->type_rate);
                } else {
                    $precio_e1 = 0;
                    $ext_from1 = 0;
                }
                if (isset($ext_to2)) {
                    $precio_e4 = $this->precio_extencion($ext_to2, $dat->type_rate);
                } else {
                    $precio_e4 = 0;
                    $ext_to2 = 0;
                }
                $trip1a = (isset($trip1a) ? ($adult * $trip1a) : 0);
                $trip1c = (isset($trip1c) ? ($child * $trip1c) : 0);
                $trip2a = (isset($trip2a) ? ($adult * $trip2a) : 0);
                $trip2c = (isset($trip2c) ? ($child * $trip2c) : 0);
                $precioA = $trip1a + $trip2a + (($precio_e1 + $precio_e4) * $adult);
                $precioN = $trip1c + $trip2c + (($precio_e1 + $precio_e4) * $child);


                //TRIP1
                $prc_trip1_adult = ($trip1a / $adult) + (($precio_e1 + $precio_e4) * $adult);

                if ($child == 0) {

                    $prc_trip1_child = 0;
                } else {

                    $prc_trip1_child = ($trip1c / $child) + (($precio_e1 + $precio_e4) * $child);
                }

                //TRIP2
                $prc_trip2_adult = ($trip2a / $adult) + (($precio_e1 + $precio_e4) * $adult);

                if ($child == 0) {

                    $prc_trip2_child = 0;
                } else {

                    $prc_trip2_child = ($trip2c / $child) + (($precio_e1 + $precio_e4) * $child);
                }
//                $tot_trip1lt = $precio_trip1_adult;
//                $tot_trip1_child = 

                $total = $precioA + $precioN;
                ($extra == '') ? 0 : $extra;
                $fee = 0;
                if ($opcion_pago == 3) {
                    //$fee = ($total + $extra) * 0.04;
                    $fee = 0;
                }

                $reserve = new Reserve();
                $reserve->id_tours = -5;
                $reserve->type_tour = 'MULTI';
                $reserve->fecha_ini = date('Y-m-d');
                $reserve->trip_no = (isset($a_trip_no)) ? $a_trip_no : '0';
                $reserve->trip_no2 = (isset($d_trip_no)) ? $d_trip_no : '0';
                $reserve->tipo_ticket = (isset($opcion_transfer_in) && isset($opcion_transfer_out)) ? 'roundtrip' : 'oneway';
                $reserve->fromt = (isset($from)) ? $from : '0';
                $reserve->tot = (isset($to)) ? $to : '0';
                $reserve->fromt2 = (isset($from2)) ? $from2 : '0';
                $reserve->tot2 = (isset($to2)) ? $to2 : '0';
                $reserve->firsname = $cliente->firstname;
                $reserve->lasname = $cliente->lastname;
                $reserve->email = $cliente->username;
                $reserve->deptime1 = isset($deptime1) ? $deptime1 : 0;
                $reserve->deptime2 = isset($deptime2) ? $deptime2 : 0;
                $reserve->arrtime1 = isset($arrtime1) ? $arrtime1 : 0;
                $reserve->arrtime2 = isset($arrtime2) ? $arrtime2 : 0;
                $reserve->ip_op = $_SESSION['login']->id;

                /** Discriminacion de precios */
                $trip_no_new = (isset($a_trip_no)) ? $a_trip_no : '0';

                if ($trip_no_new > 0) {
                    //$tourtrip = $this->params["rates"];
                    $a = $anio1 . '-01-01 00:00:00';
                    $precios = $this->price_transport_trip($dat, $trip_no_new, $a);
//                    $precio_trip1_adult = $precios["adult"];
//                    $precio_trip1_child = $precios["child"];  
                    //actualizacion
                    $precio_trip1_adult = $prc_trip1_adult;
                    $precio_trip1_child = $prc_trip1_child;
                } else {
                    $precio_trip1_adult = 0;
                    $precio_trip1_child = 0;
                }
                $trip2_no_new = (isset($d_trip_no)) ? $d_trip_no : '0';

                if ($trip2_no_new > 0) {
                    //$tourtrip = $this->params["rates"];
                    $a = $anio2 . '-01-01 00:00:00';
                    $precios = $this->price_transport_trip($dat, $trip2_no_new, $a);
//                    $precio_trip2_adult = $precios["adult"];
//                    $precio_trip2_child = $precios["child"];               
                    //actualizacion
                    $precio_trip2_adult = $prc_trip2_adult;
                    $precio_trip2_child = $prc_trip2_child;
                } else {
                    $precio_trip2_adult = 0;
                    $precio_trip2_child = 0;
                }

                $reserve->precio_trip1_a = $precio_trip1_adult;
                $reserve->precio_trip1_c = $precio_trip1_child;
                $reserve->precio_trip2_a = $precio_trip2_adult;
                $reserve->precio_trip2_c = $precio_trip2_child;
                $trip1a = (isset($reserve->precio_trip1_a) ? ($adult * $reserve->precio_trip1_a) : 0);
                $trip1c = (isset($reserve->precio_trip1_c) ? ($child * $reserve->precio_trip1_c) : 0);
                $trip2a = (isset($reserve->precio_trip2_a) ? ($adult * $reserve->precio_trip2_a) : 0);
                $trip2c = (isset($reserve->precio_trip2_c) ? ($child * $reserve->precio_trip2_c) : 0);
                $precioA = $trip1a + $trip2a + (($precio_e1 + $precio_e4) * $adult);
                $precioN = $trip1c + $trip2c + (($precio_e1 + $precio_e4) * $child);

                /** Discriminacion de precios */
                $reserve->precioA = $precioA; // El valor del trip para adulto por el numero de adultos
                $reserve->precioN = $precioN;

                $reserve->extension3 = $ext_to2;
                $reserve->precio_e3 = $precio_e4;
                $reserve->pickup_exten3 = isset($a_pickup2) ? $a_pickup2 : '';
                /* $reserve->extension2;
                  $reserve->precio_e2;
                  $reserve->extension3;
                  $reserve->precio_e3; */
                $reserve->extension2 = $ext_from1;
                $reserve->precio_e2 = $precio_e1;
                $reserve->pickup_exten2 = isset($a_pickup4) ? $a_pickup4 : '';
                $reserve->fecha_salida = $fecha_salida;
                $reserve->fecha_retorno = $fecha_retorno;
                $reserve->pax = $adult;
                $reserve->pax2 = $child;
                $reserve->id_clientes = $cliente->id;
                $reserve->pickup1 = (isset($a_id_pickup1) ? $a_id_pickup1 : 0);
                $reserve->dropoff1 = 1; // Super Tours Terminal
                $reserve->pickup2 = 1; // Super Tours Terminal
                $reserve->dropoff2 = (isset($d_id_pickup1) ? $d_id_pickup1 : 0);
                $reserve->tipo_pago = $arkey[0];
                $reserve->pago = $arval[0];
                $reserve->totaltotal = $total;
                if (!( isset($opcion_hotel) || isset($opcion_traffic) ) &&
                        (isset($opcion_transfer_in) && $a_type == 0 || !isset($opcion_transfer_in) ) &&
                        (isset($opcion_transfer_out) && $d_type == 0 || !isset($opcion_transfer_out) )) {
                    $reserve->otheramount = $otheramount;
                    $reserve->extra_charge = $extra;
                    $reserve->total2 = $total + $reserve->extra_charge + $fee;
                } else {
                    $reserve->otheramount = 0;
                    $reserve->extra_charge = 0;
                    $reserve->total2 = $total;
                }
                $reserve->codconf = $_SESSION['codconf'];
                $reserve->hora = date("H:i:s");
                $reserve->comments = 'Reserva de tours';
                $reserve->resident(isset($tipo_pass)) ? 1 : 0;
                $reserve->agen = $dat->id;
                $reserve->tipo_client = $cliente->tipo_client;
                $reserve->reward_id;
                $reserve->agency = $dat->id;
                $reserve->luggage1 = (isset($a_luggage) ? $a_luggage : '');
                $reserve->luggage2 = (isset($d_luggage) ? $d_luggage : '');

                if (trim($estado) != '') {
                    $reserve->estado = $estado;
                }
                Doo::db()->insert($reserve) or die("Error Ingresando Datos de Trasnporte Por Bus");
                $id_reserva = Doo::db()->lastInsertId();
                $totalReserva = $reserve->total2;
                //Registramos pago y rastro
                Doo::loadController('admin/ReservasController');
                $reseControl = new ReservasController();
                $reserve->id = $id_reserva;
                $login = $_SESSION['login'];
                $login->tipo = 'OPERATOR';
                /* $reseControl->registrar_pago($reserve, NULL, $login);
                  $reseControl->rastro_reserva('CREATE', NULL, $reserve, $login); */
            } else {
                $id_reserva = -1;
            }
            // FIN RESERVA
            //FIN Hotel reserva
            //TRAFFIC TOURS

            $atracciones = array();
            $totalAtraccion = 0;
//            print_r($_SESSION['tours']['attraction']);
//            exit;
            if (isset($opcion_traffic)) {
                Doo::loadModel("Attraction_Trafic");
                $atraccion = $_SESSION['tours']['attraction'];
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $opciones = $park['opciones'];
                        $ticket = $park['ticket'];
                        if ($opciones["ticket"] == 1 && $ticket["precio_varios"] == 1) {
                            $contador++;
                        }
                    }

                    $grupo_array[$id_grupo] = $contador;
                    $contador = 0;
                }
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $transpor = $park['transpor'];
                        $ticket = $park['ticket'];
                        $opciones = $park['opciones'];
                        $attraction = new Attraction_Trafic();
                        $attraction->admission = $opciones['ticket'];
                        $attraction->id_tours;
                        $attraction->type_tour = 'MULTI';
                        $attraction->adult = $adult;
                        $attraction->child = $child;
                        $attraction->group = $id_grupo;
                        $attraction->creation_date = date("Y-m-d H:i");
                        $attraction->ending_date = $fecha_retorno;
                        $attraction->starting_date = $fecha_salida;
                        $attraction->id_agencia = $dat->id;
                        $attraction->id_cliente = $cliente->id;
                        $attraction->id_park = $park['id_park'];
                        $attraction->trafic = $opciones['transpor'];
                        $attraction->total_person = $totalPax;
                        if ($attraction->admission == 1) {
                            $attraction->admission_child = $ticket ['child'] * $child;
                            $attraction->admission_adtul = $ticket ['adult'] * $adult;
                        } else {
                            $attraction->admission_child = 0;
                            $attraction->admission_adtul = 0;
                        }
                        if ($attraction->trafic == 1) {
                            $attraction->totalTraspor = ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                            $attraction->totalTraspor = 0;
                        } else {
                            $attraction->totalTraspor = 0;
                        }
                        /** nuevos Campos */
                        $attraction->precio_varios = $ticket["precio_varios"];
                        $attraction->cantidad = $ticket["cantidad"];

                        $attraction->transpor_adult = 0;
                        $attraction->transpor_child = 0;



                        /** fin nuevos campos */
//                        $attraction->totalAdmission = $attraction->admission_child + $attraction->admission_adtul;
//                        $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;

                        /** nuevo */
                        if ($opciones['transpor'] == 1) {
                            $transporLocal = ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                        }
                        if ($opciones['ticket'] == 1) {
                            if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo]) {
                                $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                                $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];

                                $pricePark = ($precio_child * $child) + ($precio_adulto * $adult);
                            } else {
                                $pricePark = ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                                $precio_adulto = 0;
                                $precio_child = 0;
                            }
                        }
                        /** nuevos Campos */
                        $attraction->v_p_adult = $precio_adulto;
                        $attraction->v_p_child = $precio_child;

                        /** fin nuevos campos */
//                        echo $transporLocal . " transpor <br>";
//                        echo $pricePark . " admission <br>";
                        $attraction->totalTraspor = $transporLocal; //actualizacion
                        //$attraction->totalTraspor = 0;
                        $attraction->totalAdmission = $pricePark;
                        //$attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;//actualizacion
                        $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;

                        /** fin nuevo */
                        $totalAtraccion += $attraction->total_paid;
                        $atracciones[] = $attraction;
                    }
                }
            }
//            echo $totalAtraccion;
//            exit;
            // FIN TRAFFIC TOURS	
            // 

            if (isset($opcion_hotel)) {
                $id_hotel_reserves = 1;
            } else {
                $id_hotel_reserves = -1;
            }
            //Insert tours
            if ((isset($opcion_hotel) || isset($opcion_traffic) ) ||
                    (isset($opcion_transfer_in) && $a_type != 0 ) ||
                    (isset($opcion_transfer_out) && $d_type != 0 )) {
                $total = $totalHotel + $totalAtraccion + $totalReserva + $totalTransferIn + $totalTransferOut;

                //$fee_n = 0.04;
                $fee_n = 0;

                $extra = ($extra == '') ? 0 : $extra;
                if ($opcion_pago == 3) {
                    //$fee = ($total + $extra) * $fee_n;
                    $fee = 0;
                } else {
                    $fee = 0;
                }
                $fee = 0;
                if ($opcion_saldo == 1) {
                    $tipoSaldo = 'FULL';
                } else {
                    $tipoSaldo = 'BALANCE';
                }
                Doo::loadModel("Tours");
                $tours = new Tours();
                $tours->id_client = $cliente->id;
                $tours->tipo_client = $cliente->tipo_client;
                $tours->platinum = $type_services;
                $tours->id_agency = '' . $dat->id . '';
                $tours->code_conf = $_SESSION['codconf'];
                $tours->agency_employee = '-1';
                if ($id_agency != -1) {
                    if (isset($id_auser) && $id_auser != -1) {
                        $tours->agency_employee = $id_auser;
                    } else if (trim($uagency) != '') {
                        $agency = new Agency();
                        $agency->id = $id_agency;
                        $agency = Doo::db()->getOne($agency);
                        Doo::loadModel('UserA');
                        $usera = new UserA();
                        $usera->firstname = $uagency;
                        $usera->email = $agency->main_email;
                        $usera->active = false;
                        $usera->id_agencia = $id_agency;
                        $usera->id = Doo::db()->insert($usera);
                        $tours->agency_employee = $usera->id;
                    }
                }

                if ($rates == 0) {
                    $tn2 = $id_tour;
                } else {
                    $tn2 = $rates;
                }
                
                $time = time();
                $fecha = date("[Y-m-d  H:i:s]", $time);
                
                $user = $_SESSION['login']->id;

                $sql2 = "SELECT nombre as OPERADOR FROM  usuarios  WHERE id = $user";

                $rs2 = Doo::db()->query($sql2);
                $usuario = $rs2->fetch();
                $operador = $usuario['OPERADOR'];
                $operador1 = strtoupper($operador);
                
                $sql = "SELECT rate FROM ratesvalid WHERE id='$tn2'";
                $rs = Doo::db()->query($sql);
                $tour_name = $rs->fetchAll();
//                print_r($tour_name);
//                exit();
                
                foreach ($tour_name as $t) {
                    
                }
                
                $tarifario = $t['rate'];       
                
                $tours->creation_date = date("Y-m-d H:i");
                $tours->ending_date = $fecha_retorno;
                $tours->starting_date = $fecha_salida;
                $tours->length_day = $days;
                $tours->length_nights = $nights;
                $tours->adult = $adult;
                $tours->child = $child;
                $tours->id_reserva = (isset($id_reserva) ? $id_reserva : -1);
                $tours->id_transfer_in = (isset($inTrans) ? $inTrans : -1);
                $tours->id_transfer_out = (isset($OutTrans) ? $OutTrans : -1);
                $tours->id_hotel_reserve = (isset($id_hotel_reserves) ? $id_hotel_reserves : -1);
                $tours->comments = $comments;
                $comments = strtoupper($comments);
                $tours->comments2 = 'TARIFARIO: ' . "[".$tarifario ."]". "\n\n" . $comments ."\n\n". $fecha . "; USUARIO: $operador1. \n\n";
               
                $tours->tarifario = $tn2;
                $tours->tipo_pago = $arkey[0];
                $tours->op_pago = $opcion_pago;
                $tours->op_pago_conductor = $opcion_pago_conductor;
                $tours->pago = $arval[0] . '-' . $tipoSaldo;
                
                $tours->otheramount = $otheramount;
                $tours->paid_driver = $paid_driver;
                $tours->passenger_balance_due = $passenger_balance_due;
                //$tours->totalAmount = $totaleouta;
                $tours->pred_paid_amount = $pred_paid_amount;
                $tours->total_paid = $pred_paid_amount;
                $tours->agency_balance_due = $agency_balance_due; 
                
                $tours->total_charge = $total_charge;
                $tours->extra_charge = $extra;

                $tours->descuento_valor = $descuento_valor;
                $tours->descuento_porcentaje = $descuento;

                /** Calculo del total */
                #transfer in
                $total_tranfer_in = $tranferIn->total_price;

                #tranfer out 
                $total_tranfer_out = $tranferOut->total_price;

                #transport trip
                $total_transport_trip = $reserve->precioA + $reserve->precioN;

                #attracciones parques                
                $total_attracciones = $totalAtraccion;

                $total_sin_hotel = $total_tranfer_in + $total_tranfer_out + $total_transport_trip + $total_attracciones;
                $tours->total = ceil($total_sin_hotel + $fee + $extra);

                $tours->otheramount = $otheramount;

                if ($descuento_valor > 0) {
                    $tours->total = $tours->total - $descuento_valor;
                }
                if ($descuento > 0) {
                    $tours->total = ceil($tours->total * ( 1 - ($descuento / 100))); //////////////////0.9
                }
                if (trim($estado) != '') {
                    $tours->estado = $estado;
                }


                if (isset($_SESSION['tours']["mensaje_html"])) {
                    $tours->mensaje_tiquetes = $_SESSION['tours']["mensaje_html"];
                } else {
                    $tours->mensaje_tiquetes = "";
                }

                /* echo json_encode($_POST);
                  echo json_encode($tours);
                  exit; */
                
                
                Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                $id_tours = Doo::db()->lastInsertId();
                //Hotel reserva
                
                $totalHotel = 0;
                if (isset($opcion_hotel)) {
                    Doo::loadModel("Hotel_Reserves");
                    $hotel = new Hotel_Reserves();
                    $total_paid_suma = 0;
                    foreach ($_SESSION['tours']['hoteles_n'] as $datos_hotel) {

                        $hotel->hotel_name = $datos_hotel["nombre"];
                        $hotel->id_tours = $id_tours;
                        $hotel->id_hotel = $datos_hotel["id"];
                        $hotel->category = $datos_hotel["categorias"];
                        $hotel->days = $datos_hotel["dias"];
                        $hotel->nights = $datos_hotel["noches"];
                        $hotel->creation_date = date("Y-m-d H:i");
                        $hotel->starting_date = $datos_hotel["starting_date"];
                        $hotel->ending_date = $datos_hotel["ending_date"];
                        $hotel->id_cliente = $cliente->id;
                        $hotel->type_client = $cliente->tipo_client;
                        $hotel->id_agencia = $dat->id;
                        $hotel->roooms = $datos_hotel["rooms"];
                        /////////////////////////////////////////////////////////////
                        $hotel->free_night_buffet = $datos_hotel["free_night_buffet"];


                        $hotel->adult = $adult;
                        $hotel->child = $child;

                        $hotel->total_persons = $totalPax;

                        $hotel->room1_adult = (isset($datos_hotel["room1"]) ? $datos_hotel["room1"] : 0);
                        $hotel->room2_adult = (isset($datos_hotel["room2"]) ? $datos_hotel["room2"] : 0);
                        $hotel->room3_adult = (isset($datos_hotel["room3"]) ? $datos_hotel["room3"] : 0);
                        $hotel->room4_adult = (isset($datos_hotel["room4"]) ? $datos_hotel["room4"] : 0);

                        $hotel->room1_child = (isset($datos_hotel["room1_c"]) ? $datos_hotel["room1_c"] : 0);
                        $hotel->room2_child = (isset($datos_hotel["room2_c"]) ? $datos_hotel["room2_c"] : 0);
                        $hotel->room3_child = (isset($datos_hotel["room3_c"]) ? $datos_hotel["room3_c"] : 0);
                        $hotel->room4_child = (isset($datos_hotel["room4_c"]) ? $datos_hotel["room4_c"] : 0);


                        /** NUEVOS CAMPOS */
                        //2 DIAS 1 NOCHE


                        $hotel->sql = $datos_hotel["sql"];
                        $hotel->dbl = $datos_hotel["dbl"];
                        $hotel->tpl = $datos_hotel["tpl"];
                        $hotel->qua = $datos_hotel["qua"];


                        //////////////////////////////////////////////////////////
                        $hotel->sql_indicativo = $datos_hotel["sql_indicativo"];
                        $hotel->dbl_indicativo = $datos_hotel["dbl_indicativo"];
                        $hotel->tpl_indicativo = $datos_hotel["tpl_indicativo"];
                        $hotel->qua_indicativo = $datos_hotel["qua_indicativo"];

                        $hotel->room1 = $datos_hotel["room1"];
                        $hotel->room2 = $datos_hotel["room2"];
                        $hotel->room3 = $datos_hotel["room3"];
                        $hotel->room4 = $datos_hotel["room4"];

                        $hotel->room1_c = $datos_hotel["room1_c"];
                        $hotel->room2_c = $datos_hotel["room2_c"];
                        $hotel->room3_c = $datos_hotel["room3_c"];
                        $hotel->room4_c = $datos_hotel["room4_c"];
                        /** FIN NUEVOS CAMPOS */
                        $hotel->type;
                        $hotel->additional_night = 0;
                        //$datos_hotel["nochesfree"]=0;
                        $hotel->free_night = $datos_hotel["nochesfree"];
                        //$hotel->free_night = 0;
                        //$hotel->free_night = $datos_hotel["fdadult"];
                        //Costo hotel
                        $nochesPagas = $datos_hotel["noches"] - $datos_hotel["nochesfree"];
                        $nochesPagas = $datos_hotel["noches"];

                        if ($nochesPagas == 0) {
                            $hotel->nightprice = 0;
                            $hotel->totalnights = 0;
                            $hotel->breakfastprice = 0;
                            $hotel->totalbreakfasts = 0;
                        } else {

                            $costoHotel = $this->costoHotel($datos_hotel["starting_date"], $datos_hotel["ending_date"], $datos_hotel["id"], $hotel->room1_adult, $hotel->room2_adult, $hotel->room3_adult, $hotel->room4_adult, $hotel->free_night, $datos_hotel["free_night_buffet"], $dat->type_rate);

                            //freeday
                            //$frday =  $this->params["frday"];
                            $frday = $_POST['frday'];
                            $hotel->freeday = $frday;

                            $hotel->sql = $datos_hotel["sql"];
                            $hotel->dbl = $datos_hotel["dbl"];
                            $hotel->tpl = $datos_hotel["tpl"];
                            $hotel->qua = $datos_hotel["qua"];


                            //$hotel->nightprice = $costoHotel['total'] / ($nochesPagas);  
                            $hotel->nightprice = $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];

                            //$hotel->totalnights = $costoHotel['total'];
                            $hotel->totalnights = $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];



                            if ($datos_hotel["breakfast"] == 1) {
                                $hotel->buffet = True;
                                $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                                $hotel->totalbreakfasts = $costoHotel['priceBreakfast'] * $adult;
                            } else {
                                $hotel->buffet = false;
                                $hotel->breakfastprice = 0;
                                $hotel->totalbreakfasts = 0;
                            }
                            if ($datos_hotel["super_breakfast"] == 1) {
                                $hotel->super_breakfast = true;
                                $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                                $hotel->totalbreakfasts = $costoHotel['priceBreakfast'] * $adult;
                            } else {
                                $hotel->super_breakfast = false;
                                $hotel->breakfastprice = 0;
                                $hotel->totalbreakfasts = 0;
                            }
                        }
                        $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
                        $total_paid_suma += $hotel->total_paid;
                        Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                    }

                    $id_hotel_reserves = Doo::db()->lastInsertId();
                    $totalHotel = $total_paid_suma;
                } else {
                    
                }
                /** calculado total */
                $total_completo = $tours->total + $total_paid_suma;
                $tours->total = $total_completo;
//                print_r($tours->total);
//                exit;
                if ($opcion_pago == 7) {
                    $tours->totalouta = 0;
                } else if ($opcion_pago == 3) {

                    if ($otheramount > 0) {
                        
                        $tours->totalouta = $tours->total + ($otheramount * $fee_n);
                    } else {
                        $tours->totalouta = $tours->total + ($tours->total * $fee_n);
                    }

//                    if ($opcion_saldo == 1) {
//                        $tours->totalouta = ceil($tours->total + $comision); //punto
//                    } else {
//                        $tours->totalouta = ceil($tours->total);
//                    }
                    $tres_porciento = ($otheramount * $fee_n);
//                } else {
//                    if ($otheramount > 0) {
//                        $tours->totalouta = $otheramount;
//                    } else {
//                        if ($opcion_saldo == 1) {
//                            $tours->totalouta = ceil($total_completo + $comision); //punto
//                        } else {
//                            $tours->totalouta = ceil($total_completo);
//                        }
//                    }
                } else if ($opcion_pago == 1) {
                    if ($otheramount > 0) {
                        $tours->totalouta = $tours->total + ($otheramount * $fee_n);
                    } else {
                        $tours->totalouta = $tours->total + ($tours->total * $fee_n);
                    }

//                    if ($opcion_saldo == 1) {
//                        $tours->totalouta = ceil($tours->total + $comision); //punto
//                    } else {
//                        $tours->totalouta = ceil($tours->total);
//                    }
                    $tres_porciento = ($otheramount * $fee_n);
//                } else {
//                    if ($otheramount > 0) {
//                        $tours->totalouta = $otheramount;
//                    } else {
//                        if ($opcion_saldo == 1) {
//                            $tours->totalouta = ceil($total_completo + $comision); //punto
//                        } else {
//                            $tours->totalouta = ceil($total_completo);
//                        }
//                    }
                } else {
                    $tres_porciento = 0;
                    $tours->totalouta = $tours->total;
                }
                $tours->otheramount = $otheramount + $tres_porciento;
                $tours->otheramount_sin_tax = $otheramount;
                $sql = "update tours set total = ? , totalouta = ?,otheramount = ?,otheramount_sin_tax = ? where id = ?";
                Doo::db()->query($sql, array($total_completo, $tours->totalouta, $tours->otheramount, $tours->otheramount_sin_tax, $id_tours));

                //Insertamos las atracciones
                if (isset($opcion_traffic)) {
                    Doo::loadModel('Parques');
                    foreach ($atracciones as $attraction) {
                        $attraction->id_tours = $id_tours;
                        Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                        if ($attraction->admission == 1) {
                            $parque = new Parques();
                            $parque->id = $attraction->id_park;
                            $parque = Doo::db()->getOne($parque);
                            $parque->stock = intval($parque->stock) - ($tours->child + $tours->adult);
                            $parque->update();
                        }
                    }
                }
                //Fin Insert las atracciones
                // actualizamos la reseva
                if ($id_reserva != -1) {
                    $reserve->id = $id_reserva;
                    $reserve->id_tours = $id_tours;
                    if ($tours->otheramount > 0) {
                        $tor = $tours->otheramount;
                    } else {
                        $tor = $tours->totalouta;
                    }
                    $reserve->otheramount = $tor;
                    Doo::db()->update($reserve);
                }
                // FIN actializamos la reseva
//                // actualizamos la reseva del hotel
//                if (isset($opcion_hotel)) {
//                    $sql = "update hotel_reserves set id_tours = ? where id = ?";
//                    $rs = Doo::db()->query($sql, array($id_tours, $id_hotel_reserves));
//                }
//                // FIN actializamos la reseva
                Doo::loadModel('CollectService');
                $collected = new CollectService();
                $collected->id_servicio = $id_tours;
                $collected->tipo_servicio = "MULTI";
                $collected->monto_pagado = 0;
                $collected->id = $collected->insert();

                //facturamos de ser necesario
                // generamos la factura del servicio //
                if ($tours->tipo_pago == "PRED-PAID" || $tours->tipo_pago == "FREE SERVICES") {
//                    Doo::loadModel('Factura');
//                    Doo::loadModel('FacturaServicio');
//                    $factura = new Factura();
//                    $factura->creation_date = date('Y-m-d');
//                    $factura->total = $tours->total;
//                    if ($tours->tipo_pago == "FREE SERVICES") {
//                        $factura->total = 0;
//                        $factura->estado = "PAID";
//                    }
//                    $factura->subtotal = $tours->total;
//                    $factura->id_agency = $tours->id_agency;
//                    $factura->id = $factura->insert();
//                    $fs = new FacturaServicio();
//                    $fs->id_factura = $factura->id;
//                    $fs->id_servicio = $id_tours;
//                    $fs->tipo_servicio = "MULTI";
//                    $fs->insert();
//
//                    if ($tours->tipo_pago == "PRED-PAID") {
//                        Doo::loadModel('Pago');
//                        $pago = new Pago();
//                        $pago->fecha = date('Y-m-d H:m:s');
//                        $pago->monto = $tours->totalouta;
//                        $pago->descuento = 0;
//                        $pago->per_descuento = 0;
//                        $pago->factura = $factura->id;
//                        $pago->tipo = 'FULL';
//                        $pago->transnu = '0';
//                        if ($arval[0] == 'Passenger Credit Card' || $arval[0] == 'Agency Credit Card') {
//                            $pago->metodo = 4;
//                        } else if ($arval[0] == 'Cash in terminal') {
//                            $pago->metodo = 5;
//                        }
//                        $pago->insert();
//
//                        $factura->collect = $tours->totalouta;
//                        $factura->total = $factura->subtotal - $factura->collect;
//                        $factura->estado = 'PAID';
//                        $factura->update();
//
//                        $collected->monto_pagado = $tours->totalouta;
//                        $collected->update();
//
////                        $sql = "update tours set estado = 'INVOICED' where id = ?";
////                        $query = Doo::db()->query($sql, array($id_tours));
//                    }
                } else if ($tours->tipo_pago == 'COLLECT ON BOARD') {
                    $collected->monto_pagado = $tours->totalouta;
                    $collected->update();
                }

                //Inser Tours Agency
                if ($dat->id != -1) {
                    Doo::loadModel("Tours_Agency");
                    $tours_reserv = new Tours_Agency();
                    $comision = $comi_in + $comi_out + $comi_traffic + $comi_hotel;
                    //$comision = $comision/4;
                    $comision = $comision / 3; //este es para no meter la comision de las atracciones
                    if ($dat->type_rate == 0 && $dat->id != -1) {
                        $valorComision = $comision * ($total - $totalAtraccion) / 100;
                    } else {
                        $valorComision = 0;
                    }
                    $tours_reserv->id_agencia = $dat->id;
                    $tours_reserv->comision = $comision;
                    $tours_reserv->id_reserva = $id_reserva;
                    $tours_reserv->id_tours = $id_tours;
                    $tours_reserv->type_tour = 'MULTI';
                    $tours_reserv->tipo_pago = $arkey[0];
                    $tours_reserv->pago = $arval[0] . '-' . $tipoSaldo;
                    $tours_reserv->type_rate = $dat->type_rate;
                    $tours_reserv->agency_fee = $valorComision;
                    $tours_reserv->total = $total;
                    $tours_reserv->otheramount = $otheramount;
                    $tours_reserv->totalouta = $total + $fee + $extra;
                    if (Doo::db()->insert($tours_reserv)) {
                        if ($opcion_pago == 5) {// Actualizamos el credio
                            $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($dat->id), "limit" => 1));
                            if (!empty($creditos)) {
                                $creditos->disponible = ($creditos->disponible - $total);
                                if (!Doo::db()->update($creditos)) {
                                    $this->view()->renderc('decline', $this->data);
                                }
                            }
                        }
                    }
                }
                //Registramos pago y rastro del tours
                $tours->id = $id_tours;
                $login = $_SESSION['login'];
                $login->tipo = 'OPERATOR';
                
                //REGISTRO DE PAGOS PREPAGO
                
                if ($pay_amount != "" && $pay_amount > 0) {                   
                   
                    
                    $option = $this->types_payments();
                    if (isset($_REQUEST['opcion_pago_2'])) {
                        $pago_2 = $_REQUEST['opcion_pago_2'];
                    }
                    $arval = array_values($option[$pago_2]);
                    $arkey = array_keys($option[$pago_2]);
                    $tipoP_2 = $arkey[0];
                    $formaP_2 = $arval[0];
                    $tours->paid = $pay_amount;
                    //$this->registrar_pago($tours, NULL, $login, $pay_amount, $tipoP_2, $formaP_2);
                    
                    if($no_prep == 1){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);                   
                        
                    }else if($no_prep == 2){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                    }else if($no_prep == 3){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                    }else if($no_prep == 4){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);                       
                        
                        
                    }else if($no_prep == 5){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        
                    }else if($no_prep == 6){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                    }else if($no_prep == 7){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        
                    }else if($no_prep == 8){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre8, $pagopre8, $tipo_pagopre8); 
                        
                        
                    }else if($no_prep == 9){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre8, $pagopre8, $tipo_pagopre8); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre9, $pagopre9, $tipo_pagopre9); 
                        
                    }else if($no_prep == 10){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre8, $pagopre8, $tipo_pagopre8); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre9, $pagopre9, $tipo_pagopre9); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre10, $pagopre10, $tipo_pagopre10); 
                    } 
                    

                                        
                }else {
                    $tours->paid = 0;
                }
                
                //REGISTRO DE PAGOS AL CONDUCTOR
            
            if ($paid_driver != "" && $paid_driver > 0) {


                $option = $this->types_payments();
                if (isset($_REQUEST['opcion_pago_2'])) {
                    $pago_2 = $_REQUEST['opcion_pago_2'];
                }
                $arval = array_values($option[$pago_2]);
                $arkey = array_keys($option[$pago_2]);
                $tipoP_2 = $arkey[0];
                $formaP_2 = $arval[0];
                $tours->paid = $paid_driver;

                if($no_pago == 1){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                    }else if($no_pago == 2){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                    }else if($no_pago == 3){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                    }else if($no_pago == 4){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                    }else if($no_pago == 5){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                    }else if($no_pago == 6){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                    }else if($no_pago == 7){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        
                    }else if($no_pago == 8){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado8, $pago8, $tipo_pago8);
                        
                        
                    }else if($no_pago == 9){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado8, $pago8, $tipo_pago8);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado9, $pago9, $tipo_pago9);
                        
                        
                    }else if($no_pago == 10){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado8, $pago8, $tipo_pago8);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado9, $pago9, $tipo_pago9);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado10, $pago10, $tipo_pago10);
                
                        
                    }
                    
                    
                }else {
                    $tours->paid = 0;
                }

                
                
                
                $this->rastro_tours('CREATE', NULL, $tours, $login);
            }

            //FIN Insert tours
            //aqui se enviara el correo
            $id = $id_tours;
            $mail_body = $this->mailrender($id);

            Doo::loadModel('clientes');
            $cliente = new Clientes();
            $cliente->id = $tours->id_client;
            $cliente = Doo::db()->getOne($cliente);
            $cont = 0;
            $dest = array("email" => $cliente->username, "nombre" => $cliente->firstname . ' ' . $cliente->lastname);
            $destinatarios[$cont++] = $dest;
//          $dest[0] = array("email"=> $cliente->username, "nombre"=> $cliente->firstname." ".$cliente->lastname);
            //$this->enviarCorreo($mail_body, $destinatarios); envio de email
            //unset($_SESSION['tours']['hoteles_n']);

            Doo::db()->commit();
            //return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?menssage=Guardado Correctamente";
            
            echo "<script> window.open('../tours/edit/$id_tours','MULTIDAY','')</script>";
            
            
        } catch (Exception $exc) {
            //unset($_SESSION['tours']['hoteles_n']);
//            print_r($exc);
            Doo::db()->rollBack();
            return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?error=error al guardar, verifique con su administrador de software.";
        }
        
        echo "<script> window.close('../tours/save','','')</script>";
    }

    public function price_transport_trip($dat, $trip_no_new, $a) {

        //$idpromo = $this->params["rates"];
        //actualizacion//////////////
        Doo::loadModel("Agency");
        $dat = new Agency();
        $dat->id = $id_agency;
        $dat = Doo::db()->find($dat, array('limit' => 1));
        $type_rate = $dat->type_rate;

        $tourtrip = $this->params["rates"];

        if ($tourtrip == 0) {
            $id_tour = $dat->id_tour;
        } else {
            $id_tour = $tourtrip;
        }

        ////////////////////////////
        if ($dat->id != -1) {
            $type_rate = 2;
            $trip1_precios = Doo::db()->getOne("Tarifastrip", array("where" => "trip_no = ? and type_rate = ? and annio = ? and id_agency = ? and id_ratesvalid = ' . $id_tour . ' ", "param" => array($trip_no_new, $type_rate, $a, $dat->id)));
            if (empty($trip1_precios)) {
                $type_rate = $dat->type_rate;
                $trip1_precios = Doo::db()->getOne("Tarifastrip", array("where" => "trip_no = ? and type_rate = ? and annio = ? and id_ratesvalid = '. $id_tour .'", "param" => array($trip_no_new, $type_rate, $a)));
                if (!empty($trip1_precios)) {
                    $precio_trip1_adult = $trip1_precios->adult;
                    $precio_trip1_child = $trip1_precios->child;
                }
            } else {
                $precio_trip1_adult = $trip1_precios->adult;
                $precio_trip1_child = $trip1_precios->child;
            }
        } else {
            $type_rate = 0;
            $trip1_precios = Doo::db()->getOne("Tarifastrip", array("where" => "trip_no = ? and type_rate = ? and annio = ? and id_ratesvalid = '. $id_tour .'", "param" => array($trip_no_new, $type_rate, $a)));
            if (!empty($trip1_precios)) {
                $precio_trip1_adult = $trip1_precios->adult;
                $precio_trip1_child = $trip1_precios->child;
            }
        }

        $precio["adult"] = $precio_trip1_adult;

        $precio["child"] = $precio_trip1_child;

        return $precio;
    }

    public function save_edit() {

        $opcion_pago_conductor = $_POST['op_pago_conductor'];  
        
        $no_pago = $_POST['no_pago'];
        $no_prep = $_POST['no_prep'];
        
        
        //PAGOS COLLECT ON BOARD
        
        $pago_1 = $_POST['pago_1'];
        $pago1 = $_POST['pago1'];
        $tipo_pago1 = $_POST['tipo_pago1'];
        $pagado1 = $_POST['pagado1'];
        
        $pago_2 = $_POST['pago_2'];
        $pago2 = $_POST['pago2'];
        $tipo_pago2 = $_POST['tipo_pago2'];
        $pagado2 = $_POST['pagado2'];
        
        $pago_3 = $_POST['pago_3'];
        $pago3 = $_POST['pago3'];
        $tipo_pago3 = $_POST['tipo_pago3'];
        $pagado3 = $_POST['pagado3'];
        
        $pago_4 = $_POST['pago_4'];
        $pago4 = $_POST['pago4'];
        $tipo_pago4 = $_POST['tipo_pago4'];
        $pagado4 = $_POST['pagado4'];
        
        $pago_5 = $_POST['pago_5'];
        $pago5 = $_POST['pago5'];
        $tipo_pago5 = $_POST['tipo_pago5'];
        $pagado5 = $_POST['pagado5'];
        
        $pago_6 = $_POST['pago_6'];
        $pago6 = $_POST['pago6'];
        $tipo_pago6 = $_POST['tipo_pago6'];
        $pagado6 = $_POST['pagado6'];
        
        $pago_7 = $_POST['pago_7'];
        $pago7 = $_POST['pago7'];
        $tipo_pago7 = $_POST['tipo_pago7'];
        $pagado7 = $_POST['pagado7'];
        
        $pago_8 = $_POST['pago_8'];
        $pago8 = $_POST['pago8'];
        $tipo_pago8 = $_POST['tipo_pago8'];
        $pagado8 = $_POST['pagado8'];
        
        $pago_9 = $_POST['pago_9'];
        $pago9 = $_POST['pago9'];
        $tipo_pago9 = $_POST['tipo_pago9'];
        $pagado9 = $_POST['pagado9'];
        
        $pago_10 = $_POST['pago_10'];
        $pago10 = $_POST['pago10'];
        $tipo_pago10 = $_POST['tipo_pago10'];
        $pagado10 = $_POST['pagado10'];
        
        
        //PAGOS PRE-PAID
        
        $pago_pre1 = $_POST['pago_pre1']; 
        $pagopre1 = $_POST['pagopre1'];
        $tipo_pagopre1 = $_POST['tipo_pagopre1'];
        $pagadopre1 = $_POST['pagadopre1']; 
        
        $pago_pre2 = $_POST['pago_pre2']; 
        $pagopre2 = $_POST['pagopre2'];
        $tipo_pagopre2 = $_POST['tipo_pagopre2'];
        $pagadopre2 = $_POST['pagadopre2']; 
        
        $pago_pre3 = $_POST['pago_pre3']; 
        $pagopre3 = $_POST['pagopre3'];
        $tipo_pagopre3 = $_POST['tipo_pagopre3'];
        $pagadopre3 = $_POST['pagadopre3']; 
        
        $pago_pre4 = $_POST['pago_pre4']; 
        $pagopre4 = $_POST['pagopre4'];
        $tipo_pagopre4 = $_POST['tipo_pagopre4'];
        $pagadopre4 = $_POST['pagadopre4'];
        
        $pago_pre5 = $_POST['pago_pre5']; 
        $pagopre5 = $_POST['pagopre5'];
        $tipo_pagopre5 = $_POST['tipo_pagopre5'];
        $pagadopre5 = $_POST['pagadopre5'];
        
        $pago_pre6 = $_POST['pago_pre6']; 
        $pagopre6 = $_POST['pagopre6'];
        $tipo_pagopre6 = $_POST['tipo_pagopre6'];
        $pagadopre6 = $_POST['pagadopre6'];
        
        $pago_pre7 = $_POST['pago_pre7']; 
        $pagopre7 = $_POST['pagopre7'];
        $tipo_pagopre7 = $_POST['tipo_pagopre7'];
        $pagadopre7 = $_POST['pagadopre7'];
        
        $pago_pre8 = $_POST['pago_pre8']; 
        $pagopre8 = $_POST['pagopre8'];
        $tipo_pagopre8 = $_POST['tipo_pagopre8'];
        $pagadopre8 = $_POST['pagadopre8'];
        
        $pago_pre9 = $_POST['pago_pre9']; 
        $pagopre9 = $_POST['pagopre9'];
        $tipo_pagopre9 = $_POST['tipo_pagopre9'];
        $pagadopre9 = $_POST['pagadopre9'];
        
        $pago_pre10 = $_POST['pago_pre10']; 
        $pagopre10 = $_POST['pagopre10'];
        $tipo_pagopre10 = $_POST['tipo_pagopre10'];
        $pagadopre10 = $_POST['pagadopre10'];
        
        
        $opc_pago = $_POST['opcion_pago'];          
        $estado_transfer_in = $_POST['estado_transfer_in'];        
        $estado_transfer_out = $_POST['estado_transfer_out'];
        $fecha_salida = $_POST['fecha_salida'];    
        $fecha_retorno = $_POST['fecha_retorno'];
        $fec_sal = $_POST['fec_sal'];    
        $fec_retor = $_POST['fec_retor'];
        
        
//        print($opc_pago);
//        exit();
        $rates = $_POST["rates"];              
        $totale = $_POST['saldoporpagar'];
        $paid_driver = $_POST['paid_driver'];
        $passenger_balance_due = $_POST['balance_due'];
        $otheramountp = $_POST['otheramountp'];
        $totaleouta = $_POST['totalAmount'];                
        $pred_paid_amount = $_POST['pay_amountp']; 
        $total_paid = $paid_driver + $pred_paid_amount;
        $agency_balance_due = $_POST['agency_balance_due'];
        $TCH = $_POST['tot_charge'];  
        //Descuento (porcentaje)
        $descuento = $_POST['descuentop'];       
       
        //descuento (valor)
        $descuento_valor = $_POST['descuento_valorp']; 
        
        //Extra cargos
        $extra = $_POST['extrap'];  
             
        
        $totalbalance = $_POST['totalbalance'];
        $comments = $_POST['comments'];
        
         //paid driver edition
        $p_d_e = $_POST['p_d_e'];       
        //pay amount edition
        $p_a_e = $_POST['p_a_e'];   
        //opcion_pago_driver
        $opd = $_POST['opcion_pago_driver'];        
        //opcion_pago_prepago
        $opp = $_POST['opcion_pago_2'];   
        
        
        
        if($fec_sal == 'N/S'){
           
            $fec_sal = 'N/A';
           
        }else if($fec_sal == 'CANC'){
           
            $fec_sal = 'C';
          
        }else if($fechasalida == $fec_sal){
           
            $fec_sal= $fecha_salida;
          
        }
        
        
        if($fec_retor == 'N/S'){
           $fec_retor = 'N/A';
           
        }else if($fec_retor == 'CANC'){
           $fec_retor = 'C';           
        }else if($fecharetorno == $fec_retor){
           $fec_retor = $fecha_retorno;
          
        }
        
          
                   
        
        

    
//        print($opp);
//        exit();
     
        
        extract($_POST, EXTR_SKIP);
        Doo::loadModel("Tours");
        $t_anterior = new Tours();
        $t_anterior->id = $id_tours;
        $t_anterior = Doo::db()->find($t_anterior, array('limit' => 1));
        Doo::db()->beginTransaction();


        try {
            $servis = $this->comision_servis();
            $completo = false;
            if (isset($opcion_transfer_in) && isset($opcion_transfer_out) && isset($opcion_hotel) && isset($opcion_traffic)) {
                $comi_in = $servis['003'];
                $comi_out = $servis['003'];
                $comi_hotel = $servis['003'];
                $comi_traffic = $servis['003'];
            } else {
                if (isset($opcion_transfer_in)) {
                    if ($a_type == 0) {
                        $comi_in = $this->trip_comision($a_trip_no);
                    } else {
                        $comi_in = $servis['006']; // servis_code del transfer.
                    }
                } else {
                    $comi_in = 0; // Comision por defaults
                }
                if (isset($opcion_transfer_out)) {
                    if ($d_type == 0) {
                        $comi_out = $this->trip_comision($d_trip_no);
                    } else {
                        $comi_out = $servis['006']; // servis_code del transfer.
                    }
                } else {
                    $comi_out = 0; // Comision por defaults
                }
                if (isset($opcion_hotel)) {
                    $comi_hotel = $servis['004']; // servis_code del transfer.
                } else {
                    $comi_hotel = 0; // Comision por defaults
                }
                if (isset($opcion_traffic)) {
                    $comi_traffic = $servis['005']; // servis_code del transfer.
                } else {
                    $comi_traffic = 0; // Comision por defaults
                }
            }

            $comi_traffic = 0; //OJO, No esta funcionando
            if (isset($_SESSION['tours_pago']) && $_SESSION['tours_pago'] == 'ok' && isset($_SESSION['codconf'])) {
                unset($_SESSION['tours_pago']);
            } else {
                do {
                    $mes = date("m");
                    $dia = date("d");
                    $y = date("y");
                    $_SESSION['codconf'] = "TM" . $mes . $y . $dia . rand(0, 9999);
                    $a = $this->db()->find('Tours', array('where' => 'code_conf = ?',
                        'limit' => 1,
                        'select' => 'code_conf',
                        'param' => array($_SESSION['codconf'])));
                } while ($a != null);
            }
            // Consultando agencias
            Doo::loadModel("Agency");

            //actualizacion

            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
            $type_rate = $dat->type_rate;



            $tourtrip = $this->params["rates"];
            
            if ($tourtrip == 0) {
                $id_tour = $dat->id_tour;
            } else {
                $id_tour = $tourtrip;
            }




            if (isset($id_agency) && $id_agency != -1) {
                $dat = new Agency();
                $dat->id = $id_agency;
                $dat = Doo::db()->find($dat, array('limit' => 1));
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }
            // Fin consultando Agecia
            //Consultando Cliente
            //Consultando Cliente
            Doo::loadModel("Clientes");
            if ($idCliente != -1 && $idCliente != "") {
                $cliente = new Clientes();
                $cliente->firstname = $firstname1;
                $cliente->lastname = $lastname1;
                $cliente->phone = $phone1;
                $cliente->username = $email1;
                $cliente->id = $idCliente;
                Doo::db()->update($cliente);
                $cliente = new Clientes();
                $cliente->id = $idCliente;
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
            } else {
                $cliente = new Clientes();
                $cliente->firstname = $firstname1;
                $cliente->lastname = $lastname1;
                $cliente->phone = $phone1;
                $cliente->username = $email1;
                $cliente->id = Doo::db()->insert($cliente);
            }
            //Fin Consultando Cliente
            //Fin Consultando Cliente
            $op = $this->types_payments();

            //Transporte del tours
            Doo::loadModel("Reserve");
            Doo::loadModel("Transfer");
            $totalPax = $child + $adult;
            //Fechas
            if (isset($fecha_salida) && $fecha_salida != '') {
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha_salida = $anio . '-' . $mes . '-' . $dia;
            } else {
                $fecha_salida = 'N/A';
            }
            $anio1 = $anio;
            if (isset($fecha_retorno)) {
                list($mes, $dia, $anio) = explode('-', $fecha_retorno);
                $fecha_retorno = $anio . '-' . $mes . '-' . $dia;
            } else {
                $fecha_retorno = 'N/A';
            }

            $anio2 = $anio;
            $a = $anio1 . '-01-01 00:00:00';
            //Transfer In
            $totalTransferIn = 0;
            if (isset($opcion_transfer_in)) {
                if ($a_type != 0) {
                    $tranferIn = new Transfer();
                    $tranferIn->total_pax = $totalPax;
                    $tranferIn->arrival_time = $hora1;
                    $tranferIn->type = $a_type + 1;
                    if ($a_type == 1) {
                        $price = -1;
                        $tranferIn->type_transfer = 'VIP';
                        $tranferIn->city = $city;
                        $tranferIn->address = $address;
                        $tranferIn->zipcode = $zipcode;
                        $tranferIn->phone = $phone;
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesvip = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price,id_agency FROM tarifasvip WHERE cantidad = ? AND type_rate = ? and id_agency = ? and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesvip = $rs->fetch();
                            if (empty($pricesvip)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ?';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesvip = $rs->fetch();
                            }
                        }
                        if (!empty($pricesvip)) {
                            $price = number_format($pricesvip ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = $price;
                    } else if ($a_type == 2) {
                        $price = -1;
                        $tranferIn->airlie = $airlinearrival;
                        $tranferIn->flight = $flightarrival;
                        $tranferIn->type_transfer = 'PLANE';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesbyplane = $rs->fetch();
                            }
                        }
                        if (!empty($pricesbyplane)) {
                            $price = number_format($pricesbyplane ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = $price;
                    } else if ($a_type == 3) {
                        $price = -1;
                        $tranferIn->type_transfer = 'CAR';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($type_rate, $a));
                                $pricescar = $rs->fetch();
                            }
                        }
                        if (!empty($pricescar)) {
                            $price = number_format($pricescar ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = $price;
                    }
                    if ($t_anterior->id_transfer_in != -1) {
                        $tranferIn->id = $t_anterior->id_transfer_in;
                        Doo::db()->update($tranferIn);
                        $inTrans = $tranferIn->id;
                    } else {
                        Doo::db()->insert($tranferIn);
                        $inTrans = Doo::db()->lastInsertId();
                    }
                    $totalTransferIn = $tranferIn->total_price;
                } else {
                    $inTrans = -1;
                    //Si el tours anterior transfer_out reserva, entonces eliminamos  transfer_out.
                    if ($t_anterior->id_transfer_in != -1) {
                        $inTrans_anterior = new Transfer();
                        $inTrans_anterior->id = $t_anterior->id_transfer_in;
                        Doo::db()->delete($inTrans_anterior);
                    }
                }
            } else {
                $inTrans = -1;
                //Si el tours anterior transfer_in reserva, entonces eliminamos transfer_in.
                if ($t_anterior->id_transfer_in != -1) {
                    $inTrans_anterior = new Transfer();
                    $inTrans_anterior->id = $t_anterior->id_transfer_in;
                    Doo::db()->delete($inTrans_anterior);
                }
            }
            // FIN Transfer In
//            print_r($tranferIn);
//            exit;
            $a = $anio2 . '-01-01 00:00:00';

            //Transfer Out
            $totalTransferOut = 0;
            if (isset($opcion_transfer_out)) {
                if ($d_type != 0) {
                    $tranferOut = new Transfer();
                    $tranferOut->total_pax = $totalPax;
                    $tranferOut->arrival_time = date("h:i:s", strtotime($hora2));
                    $tranferOut->type = $d_type + 1;
                    if ($d_type == 1) {
                        $price = -1;
                        $tranferOut->type_transfer = 'VIP';
                        $tranferOut->city = $city2;
                        $tranferOut->address = $address2;
                        $tranferOut->zipcode = $zipcode2;
                        $tranferOut->phone = $phone2;
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesvip = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price,id_agency FROM tarifasvip WHERE cantidad = ? AND type_rate = ? and id_agency = ? and annio = ?';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesvip = $rs->fetch();
                            if (empty($pricesvip)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ?';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesvip = $rs->fetch();
                            }
                        }
                        if (!empty($pricesvip)) {
                            $price = number_format($pricesvip ['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = $price;
                    } else if ($d_type == 2) {
                        $price = -1;
                        $tranferOut->airlie = $airlinedeparture;
                        $tranferOut->flight = $flightdeparture;
                        $tranferOut->type_transfer = 'PLANE';
                        if ($dat->id == -1) {
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                                $pricesbyplane = $rs->fetch();
                            }
                        }
                        if (!empty($pricesbyplane)) {
                            $price = number_format($pricesbyplane['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = $price;
                    } else if ($d_type == 3) {
                        $price = -1;
                        $tranferOut->type_transfer = 'CAR';
                        if ($dat->id == -1) {

                            $tourtrip = $this->params["rates"];
                            if ($tourtrip == 0) {
                                $id_tour = $dat->id_tour;
                            } else {
                                $id_tour = $tourtrip;
                            }

                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;

                            $tourtrip = $this->params["rates"];
                            if ($tourtrip == 0) {
                                $id_tour = $dat->id_tour;
                            } else {
                                $id_tour = $tourtrip;
                            }

                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;

                                $tourtrip = $this->params["rates"];
                                if ($tourtrip == 0) {
                                    $id_tour = $dat->id_tour;
                                } else {
                                    $id_tour = $tourtrip;
                                }

                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' . $id_tour . '';
                                $rs = Doo::db()->query($sql, array($type_rate, $a));
                                $pricescar = $rs->fetch();
                            }
                        }
                        if (!empty($pricescar)) {
                            $price = number_format($pricescar ['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = 0;
                    }
                    if ($t_anterior->id_transfer_out != -1) {
                        $tranferOut->id = $t_anterior->id_transfer_out;

                        Doo::db()->update($tranferOut);
                        $OutTrans = $tranferOut->id;
                    } else {
                        Doo::db()->insert($tranferOut);
                        $OutTrans = Doo::db()->lastInsertId();
                    }

                    $totalTransferOut = $tranferOut->total_price;
                } else {
                    $OutTrans = -1;
                    //Si el tours anterior transfer_out reserva, entonces eliminamos  transfer_out.
                    if ($t_anterior->id_transfer_out != -1) {
                        $OutTrans_anterior = new Transfer();
                        $OutTrans_anterior->id = $t_anterior->id_transfer_out;
                        Doo::db()->delete($OutTrans_anterior);
                    }
                }
            } else {
                $OutTrans = -1;
                //Si el tours anterior transfer_out reserva, entonces eliminamos  transfer_out.
                if ($t_anterior->id_transfer_out != -1) {
                    if ($toutwcharge == 0) {
                        $OutTrans_anterior = new Transfer();
                        $OutTrans_anterior->id = $t_anterior->id_transfer_out;
                        Doo::db()->delete($OutTrans_anterior);
                    } else {
                        $OutTrans_anterior = new Transfer();
                        $OutTrans_anterior->id = $t_anterior->id_transfer_out;
                        $OutTrans_anterior = Doo::db()->getOne($OutTrans_anterior);
                        $OutTrans_anterior->estado = "NOT SHOW";
                        $OutTrans_anterior->update();
                        //rastro del cambio
                    }
                }
            }
            //FIN Transfer Out
            //FIn fechas
            //tipo pago
            $arval = array_values($op[$opcion_pago]);
            $arkey = array_keys($op[$opcion_pago]);
            //fin tipo Pago
            // RESERVA
            $totalReserva = 0;
            if (( $a_type == 0 && isset($opcion_transfer_in) ) || ($d_type == 0 && isset($opcion_transfer_out))) {
                if (!isset($opcion_transfer_in)) {
                    $a_trip_no = 0;
                }
                if (!isset($opcion_transfer_out)) {
                    $d_trip_no = 0;
                }
                if (isset($ext_from1)) {
                    $precio_e1 = $this->precio_extencion($ext_from1, $dat->type_rate);
                } else {
                    $precio_e1 = 0;
                    $ext_from1 = 0;
                }
                $precio_e1 = 0;
                if (isset($ext_to2)) {
                    $precio_e4 = $this->precio_extencion($ext_to2, $dat->type_rate);
                } else {
                    $precio_e4 = 0;
                    $ext_to2 = 0;
                }
                $precio_e4 = 0;
                $trip1a = (isset($trip1a) ? ($adult * $trip1a) : 0);
                $trip1c = (isset($trip1c) ? ($child * $trip1c) : 0);
                $trip2a = (isset($trip2a) ? ($adult * $trip2a) : 0);
                $trip2c = (isset($trip2c) ? ($child * $trip2c) : 0);
                $precioA = $trip1a + $trip2a + (($precio_e1 + $precio_e4) * $adult);
                //$precioA = $trip1a + $trip2a;
                $precioN = $trip1c + $trip2c + (($precio_e1 + $precio_e4) * $child);
                //$precioN = $trip1c + $trip2c;

                $total = $precioA + $precioN;
                ($extra == '') ? 0 : $extra;
                $fee = 0;
                if ($opcion_pago == 3) {
                    $fee = ($total + $extra) * 0.03;
                }


                $reserve = new Reserve();
                $reserve->id_tours = $id_tours;
                $reserve->type_tour = 'MULTI';
                $reserve->fecha_ini = date('Y-m-d');
                $reserve->trip_no = (isset($a_trip_no)) ? $a_trip_no : '0';
                $reserve->trip_no2 = (isset($d_trip_no)) ? $d_trip_no : '0';
                $reserve->tipo_ticket = (isset($opcion_transfer_in) && isset($opcion_transfer_out)) ? 'roundtrip' : 'oneway';
                $reserve->fromt = (isset($from)) ? $from : '0';
                $reserve->tot2 = (isset($to2)) ? $to2 : '0';
                $reserve->firsname = $cliente->firstname;
                $reserve->lasname = $cliente->lastname;
                $reserve->email = $cliente->username;
                $reserve->deptime1 = isset($deptime1) ? $deptime1 : 0;
                $reserve->deptime2 = isset($deptime2) ? $deptime2 : 0;
                $reserve->arrtime1 = isset($arrtime1) ? $arrtime1 : 0;
                $reserve->arrtime2 = isset($arrtime2) ? $arrtime2 : 0;
                $reserve->toutwcharge = $toutwcharge;

                /** Discriminacion de precios */
                $trip_no_new = (isset($a_trip_no)) ? $a_trip_no : '0';

                if ($trip_no_new > 0) {
                    $a = $anio1 . '-01-01 00:00:00';
                    //$tourtrip = $this->params["rates"];
                    $precios = $this->price_transport_trip($dat, $trip_no_new, $a);

                    $prc_trip1_adult = ($trip1a / $adult) + (($precio_e1 + $precio_e4) * $adult);

                    if ($child == 0) {

                        $prc_trip1_child = 0;
                    } else {

                        $prc_trip1_child = ($trip1c / $child) + (($precio_e1 + $precio_e4) * $child);
                    }

//                    $precio_trip1_adult = $precios["adult"];
//                    $precio_trip1_child = $precios["child"];

                    $precio_trip1_adult = $prc_trip1_adult;
                    $precio_trip1_child = $prc_trip1_child;
                } else {
                    $precio_trip1_adult = 0;
                    $precio_trip1_child = 0;
                }
                $trip2_no_new = (isset($d_trip_no)) ? $d_trip_no : '0';

                if ($trip2_no_new > 0) {
                    $a = $anio2 . '-01-01 00:00:00';
                    //$tourtrip = $this->params["rates"];
                    $precios = $this->price_transport_trip($dat, $trip2_no_new, $a);

                    $prc_trip2_adult = ($trip2a / $adult) + (($precio_e1 + $precio_e4) * $adult);

                    if ($child == 0) {

                        $prc_trip2_child = 0;
                    } else {

                        $prc_trip2_child = ($trip2c / $child) + (($precio_e1 + $precio_e4) * $child);
                    }

//                    $precio_trip2_adult = $precios["adult"];
//                    $precio_trip2_child = $precios["child"];
                    $precio_trip2_adult = $prc_trip2_adult;
                    $precio_trip2_child = $prc_trip2_child;
                } else {
                    $precio_trip2_adult = 0;
                    $precio_trip2_child = 0;
                }

                $reserve->precio_trip1_a = $precio_trip1_adult;
                $reserve->precio_trip1_c = $precio_trip1_child;
                $reserve->precio_trip2_a = $precio_trip2_adult;
                $reserve->precio_trip2_c = $precio_trip2_child;

                $trip1a = (isset($reserve->precio_trip1_a) ? ($adult * $reserve->precio_trip1_a) : 0);
                $trip1c = (isset($reserve->precio_trip1_c) ? ($child * $reserve->precio_trip1_c) : 0);
                $trip2a = (isset($reserve->precio_trip2_a) ? ($adult * $reserve->precio_trip2_a) : 0);
                $trip2c = (isset($reserve->precio_trip2_c) ? ($child * $reserve->precio_trip2_c) : 0);

                $precioA = $trip1a + $trip2a + (($precio_e1 + $precio_e4) * $adult);
                $precioN = $trip1c + $trip2c + (($precio_e1 + $precio_e4) * $child);

                $reserve->precioA = $precioA; // El valor del trip para adulto por el numero de adultos
                $reserve->precioN = $precioN;
                /** Discriminacion de precios */
                $reserve->extension3 = $ext_to2;
                $reserve->precio_e3 = $precio_e4;
                $reserve->pickup_exten3 = isset($a_pickup2) ? $a_pickup2 : '';
                /* $reserve->extension2;
                  $reserve->precio_e2;
                  $reserve->extension3;
                  $reserve->precio_e3; */
                $reserve->extension2 = $ext_from1;
                $reserve->precio_e2 = $precio_e1;
                $reserve->pickup_exten2 = isset($a_pickup4) ? $a_pickup4 : '';
                /********************************************************************/
                $reserve->fecha_salida = $fec_sal;
                $reserve->fecha_retorno = $fec_retor;
                $reserve->estado_one = $estado_transfer_in;
                $reserve->estado_round = $estado_transfer_out;
                
                $reserve->pax = $adult;
                $reserve->pax2 = $child;
                $reserve->id_clientes = $cliente->id;
                $reserve->pickup1 = (isset($a_id_pickup1) ? $a_id_pickup1 : 0);
                $reserve->dropoff1 = 1; // Super Tours Terminal
                $reserve->pickup2 = 1; // Super Tours Terminal
                $reserve->dropoff2 = (isset($d_id_pickup1) ? $d_id_pickup1 : 0);
                $reserve->tipo_pago = $arkey[0];
                /* $reserve->pago = $arval[0]; */
                $reserve->pago = $opcion_pago;
                $reserve->totaltotal = $total;
                if (!( isset($opcion_hotel) || isset($opcion_traffic) ) &&
                        (isset($opcion_transfer_in) && $a_type == 0 || !isset($opcion_transfer_in) ) &&
                        (isset($opcion_transfer_out) && $d_type == 0 || !isset($opcion_transfer_out) )) {
                    $reserve->otheramount = $otheramount;
                    $reserve->extra_charge = $extra;
                    $reserve->total2 = $total + $reserve->extra_charge + $fee;
                } else {
                    $reserve->otheramount = 0;
                    $reserve->extra_charge = 0;
                    $reserve->total2 = $total;
                }
                $reserve->codconf = $t_anterior->code_conf;
                $reserve->hora = date("H:i:s");
                if ($toutwcharge != '1') {
                    $reserve->comments = 'Reserva de tours';
                } else {
                    $reserve->comments = 'NOT SHOW';
                }
                $reserve->resident(isset($tipo_pass)) ? 1 : 0;
                $reserve->agen = $dat->id;
                $reserve->tipo_client = $cliente->tipo_client;
                $reserve->reward_id;
                $reserve->agency = $dat->id;
                $reserve->luggage1 = (isset($a_luggage) ? $a_luggage : '');
                $reserve->luggage2 = (isset($d_luggage) ? $d_luggage : '');
                $reserve->room1 = isset($a_room1) ? $a_room1 : '';
                $reserve->room2 = isset($d_room1) ? $d_room1 : '';
                $reserve->canal = $canal;


                if ($t_anterior->estado == 'INVOICED') {
                    $reserve->estado = 'INVOICED';
                } else {
                    $reserve->estado = $estado;
                }

                if ($t_anterior->id_reserva != -1) {
                    $reserve->id = $t_anterior->id_reserva;
                    Doo::db()->update($reserve);
                    $id_reserva = $reserve->id;
                    //Registramos pago y rastro
                    $r_anterior = new Reserve();
                    $r_anterior->id = $reserve->id;
                    $r_anterior = Doo::db()->find($r_anterior, array('limit' => 1));
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserve->id = $id_reserva;
                    $login = $_SESSION['login'];
                    $login->tipo = 'OPERATOR';

                    /* $reseControl->registrar_pago($reserve, $r_anterior, $login);
                      $reseControl->rastro_reserva('UPDATE', $r_anterior, $reserve, $login); //UPDATE */
                } else {
                    Doo::db()->insert($reserve);
                    $id_reserva = Doo::db()->lastInsertId();
                    //Registramos pago y rastro
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserve->id = $id_reserva;
                    $login = $_SESSION['login'];
                    $login->tipo = 'OPERATOR';
                    /* $reseControl->registrar_pago($reserve, NULL, $login);
                      $reseControl->rastro_reserva('CREATE', NULL, $reserve, $login); //UPDATE */
                }
                $totalReserva = $reserve->total2;
            } else {
                $id_reserva = -1;
                //Si el tours anterior tenia reserva, entonces eliminamos la reserva.
                if ($t_anterior->id_hotel_reserve != -1) {
                    Doo::loadModel("Hotel_Reserves");
                    $r_anterior = new Hotel_Reserves();
                    $r_anterior->id = $t_anterior->id_hotel_reserve;
                    Doo::db()->delete($r_anterior);

                    $r_anterior_2 = new Reserve();
                    $r_anterior_2->id_tours = $id_tours;
                    $r_anterior_2->type_tour = 'MULTI';
                    Doo::db()->delete($r_anterior_2);
                }
            }
            // FIN RESERVA
            //Hotel reserva
            $totalHotel = 0;

            if (isset($opcion_hotel)) {


                if (!empty($_SESSION['tours']['hoteles_n'])) {
                    if ($t_anterior->id_hotel_reserve != -1) {
                        $sql = "delete from hotel_reserves where id_tours = ?";
                        $query = Doo::db()->query($sql, array($t_anterior->id));
                    }
                    Doo::loadModel("Hotel_Reserves");
                    $hotel = new Hotel_Reserves();
                    $total_paid_suma = 0;



                    foreach ($_SESSION['tours']['hoteles_n'] as $datos_hotel) {

                        $hotel->hotel_name = $datos_hotel["nombre"];
                        $hotel->id_tours = $id_tours;
                        $hotel->id_hotel = $datos_hotel["id"];
                        $hotel->category = $datos_hotel["categorias"];
                        $hotel->days = $datos_hotel["dias"];
                        $hotel->nights = $datos_hotel["noches"];
                        $hotel->creation_date = date("Y-m-d H:i");
                        $hotel->starting_date = $datos_hotel["starting_date"];
                        $hotel->ending_date = $datos_hotel["ending_date"];
                        $hotel->id_cliente = $cliente->id;
                        $hotel->type_client = $cliente->tipo_client;
                        $hotel->id_agencia = $dat->id;
                        $hotel->roooms = $datos_hotel["rooms"];
                        $hotel->free_night_buffet = $datos_hotel["free_night_buffet"];



                        $hotel->adult = $adult;
                        $hotel->child = $child;
                        $hotel->total_persons = $totalPax;


                        $hotel->room1_adult = (isset($datos_hotel["room1"]) ? $datos_hotel["room1"] : 0);
                        $hotel->room2_adult = (isset($datos_hotel["room2"]) ? $datos_hotel["room2"] : 0);
                        $hotel->room3_adult = (isset($datos_hotel["room3"]) ? $datos_hotel["room3"] : 0);
                        $hotel->room4_adult = (isset($datos_hotel["room4"]) ? $datos_hotel["room4"] : 0);


                        $hotel->room1_child = (isset($datos_hotel["room1_c"]) ? $datos_hotel["room1_c"] : 0);
                        $hotel->room2_child = (isset($datos_hotel["room2_c"]) ? $datos_hotel["room2_c"] : 0);
                        $hotel->room3_child = (isset($datos_hotel["room3_c"]) ? $datos_hotel["room3_c"] : 0);
                        $hotel->room4_child = (isset($datos_hotel["room4_c"]) ? $datos_hotel["room4_c"] : 0);



                        $hotel->sql = $datos_hotel["sql"];
                        //echo $datos_hotel["sql"];                         
                        $hotel->dbl = $datos_hotel["dbl"];
                        //echo $datos_hotel["dbl"];
                        $hotel->tpl = $datos_hotel["tpl"];
                        //echo $datos_hotel["tpl"];
                        $hotel->qua = $datos_hotel["qua"];
                        //echo $datos_hotel["qua"];



                        $hotel->sql_indicativo = $datos_hotel["sql_indicativo"];
                        $hotel->dbl_indicativo = $datos_hotel["dbl_indicativo"];
                        $hotel->tpl_indicativo = $datos_hotel["tpl_indicativo"];
                        $hotel->qua_indicativo = $datos_hotel["qua_indicativo"];

                        $hotel->room1 = $datos_hotel["room1"];
                        $hotel->room2 = $datos_hotel["room2"];
                        $hotel->room3 = $datos_hotel["room3"];
                        $hotel->room4 = $datos_hotel["room4"];

                        $hotel->room1_c = $datos_hotel["room1_c"];
                        $hotel->room2_c = $datos_hotel["room2_c"];
                        $hotel->room3_c = $datos_hotel["room3_c"];
                        $hotel->room4_c = $datos_hotel["room4_c"];



                        /** FIN NUEVOS CAMPOS */
                        $hotel->type;
                        //echo $hotel->type;
                        $hotel->additional_night = 0;
                        ///cambio
                        $hotel->free_night = $datos_hotel["nochesfree"];

                        //Costo hotel
                        //cambio
                        $nochesPagas = $datos_hotel["noches"] - $datos_hotel["nochesfree"];
                        $nochesPagas = $datos_hotel["noches"];
                        if ($nochesPagas == 0) {
                            $hotel->nightprice = 0;
                            $hotel->totalnights = 0;
                            $hotel->breakfastprice = 0;
                            $hotel->totalbreakfasts = 0;
                        } else {


                            $this->params["rates"] = $id_tour;
                            $frday = $_POST['frday'];
                            $hotel->freeday = $frday;

                            $costoHotel = $this->costoHotel($datos_hotel["starting_date"], $datos_hotel["ending_date"], $datos_hotel["id"], $hotel->room1_adult, $hotel->room2_adult, $hotel->room3_adult, $hotel->room4_adult, $hotel->free_night, $datos_hotel["free_night_buffet"], $dat->type_rate);

                            //$hotel->sql = $datos_hotel["sql"];                        
//                            echo $datos_hotel["sql"]; 
                            //$hotel->child = $child;   
                            //echo $child; 
                            //$hotel->sql = $costoHotel['sgl'];

                            $sqlVista = $_POST['sqlhotel1'];
                            //echo '>>'. $sqlVista;

                            $sqlValorNuevo = $_POST['pricesql'];
                            //echo '<br />>>'.$sqlValorNuevo;

                            if ($sqlValorNuevo == '') {
                                $sqlValorNuevo = 0;
                                //echo $sqlValorNuevo;
                                $hotel->sql = $sqlVista;
                            } else {
                                $hotel->sql = $sqlValorNuevo;
                            }


                            $hotel->dbl = $datos_hotel["dbl"];
                            $hotel->tpl = $datos_hotel["tpl"];
                            $hotel->qua = $datos_hotel["qua"];
//                            

                            $hotel->nightprice = $hotel->sql + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];
                            /// ($nochesPagas)
                            $hotel->totalnights = $hotel->sql + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];
                            //$ttotal = $hotel->sql + $hotel->dbl + $hotel->tpl + $hotel->qua;
                            //echo $ttotal;
                            //$hotel->nightprice = $ttotal;
                            // $hotel->nightprice =  $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];
                            //$hotel->nightprice =  $sql + $dbl + $tpl + $qua;                         
                            //$hotel->totalnights = $ttotal;
                            //$hotel->totalnights = $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];
                            //$hotel->totalnights = $sql + $dbl + $tpl + $qua;


                            if ($datos_hotel["breakfast"] == 1) {
                                $hotel->buffet = True;
                                $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                                $hotel->totalbreakfasts = $costoHotel['priceBreakfast'] * $adult;
                            } else {
                                //$hotel->buffet = false;
                                $hotel->breakfastprice = 0;
                                $hotel->totalbreakfasts = 0;
                            }
                            if ($datos_hotel["super_breakfast"] == 1) {
                                $hotel->super_breakfast = true;
                                $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                                $hotel->totalbreakfasts = $costoHotel['priceBreakfast'] * $adult;
                            } else {
                                $hotel->super_breakfast = false;
                                $hotel->breakfastprice = 0;
                                $hotel->totalbreakfasts = 0;
                            }
                        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        
//                        $totalparque = $_POST['totalparque'];///total admisiones de parques
//                        echo $totalparque;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;

                        $total_paid_suma += $hotel->total_paid;

                        Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                    }
//                    echo '<pre>';
//                    print_r($hotel);
//                    echo '</pre>';
//                    exit;

                    $id_hotel_reserves = Doo::db()->lastInsertId();
                    $totalHotel = $total_paid_suma;
                } else {
                    throw new Exception('session de hoteles no existe');
                }
            } else {
                $id_hotel_reserves = -1;
                //Si el tours anterior tenia Hotel reservado, entonces eliminamos la reserva.
                if ($t_anterior->id_hotel_reserve != -1) {
                    $sql = "delete from hotel_reserves where id_tours = ?";
                    $query = Doo::db()->query($sql, array($t_anterior->id));
                }
            }
            //FIN Hotel reserva
            //TRAFFIC TOURS
            ////*********************************************************************************************************************************************////////////////////////

            $atracciones = array();
            $totalAtraccion = 0;

            if (isset($opcion_traffic)) {
                Doo::loadModel("Attraction_Trafic");
                $atraccion = $_SESSION['tours']['attraction'];
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $opciones = $park['opciones'];
                        $ticket = $park['ticket'];
                        if ($opciones["ticket"] == 1 && $ticket["precio_varios"] == 1) {
                            $contador++;
                        }
                    }
                    $grupo_array[$id_grupo] = $contador;
                    $contador = 0;
                }

                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $transpor = $park['transpor'];
                        $ticket = $park['ticket'];
                        $opciones = $park['opciones'];
                        $attraction = new Attraction_Trafic();
                        $attraction->admission = $opciones['ticket'];
                        $attraction->id_tours;
                        $attraction->type_tour = 'MULTI';
                        $attraction->adult = $adult;
                        $attraction->child = $child;
                        $attraction->group = $id_grupo;
                        $attraction->creation_date = date("Y-m-d H:i");
                        $attraction->ending_date = $fecha_retorno;
                        $attraction->starting_date = $fecha_salida;
                        $attraction->id_agencia = $dat->id;
                        $attraction->id_cliente = $cliente->id;
                        $attraction->id_park = $park['id_park'];
                        $attraction->trafic = $opciones['transpor'];
                        $attraction->total_person = $totalPax;
                        if ($attraction->admission == 1) {
                            $attraction->admission_child = $ticket ['child'] * $child;
                            $attraction->admission_adtul = $ticket ['adult'] * $adult;
                        } else {
                            $attraction->admission_child = 0;
                            $attraction->admission_adtul = 0;
                        }
                        if ($attraction->trafic == 1) {
                            $attraction->totalTraspor = ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                        } else {
                            $attraction->totalTraspor = 0;
                        }

                        /** nuevos Campos */
                        $attraction->precio_varios = $ticket["precio_varios"];
                        $attraction->cantidad = $ticket["cantidad"];
                        $attraction->transpor_adult = $transpor['adult'];
                        $attraction->transpor_child = $transpor['child'];
                        /** fin nuevos campos */
//                        $attraction->totalAdmission = $attraction->admission_child + $attraction->admission_adtul;
//                        $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;

                        /** nuevo */
                        if ($opciones['transpor'] == 1) {
                            $transporLocal = ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                        }
                        if ($opciones['ticket'] == 1) {
                            if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo]) {
                                $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                                $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];

                                $pricePark = ($precio_child * $child) + ($precio_adulto * $adult);
//                                echo $pricePark."-".$ticket['v_p_adult']."-".$ticket['v_p_child']."-".$ticket["cantidad"]."- $id_grupo<br>";
                            } else {
                                $pricePark = ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                                $precio_adulto = 0;
                                $precio_child = 0;
                            }
                        }
                        /** nuevos Campos */
                        $attraction->v_p_adult = $precio_adulto;
                        $attraction->v_p_child = $precio_child;

                        /** fin nuevos campos */
//                        echo $transporLocal . " transpor <br>";
//                        echo $pricePark . " admission <br>";
                        $attraction->totalTraspor = $transporLocal;
                        $attraction->totalAdmission = $pricePark;
                        $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;
                        /** fin nuevo */
                        $totalAtraccion += $attraction->total_paid;
                        $ss += $pricePark;
                        $atracciones[] = $attraction;
                    }
                }
            }
            ////////////////////////////////////////////////////////// 
//           echo '<pre>'; 
//           print_r($totalAtraccion);
//           echo '<pre>';
//           exit;
            ////////////////////////////////////////////////////////
            // FIN TRAFFIC TOURS	
            //Insert tours
            if ((isset($opcion_hotel) || isset($opcion_traffic) ) ||
                    (isset($opcion_transfer_in) && $a_type != 0 ) ||
                    (isset($opcion_transfer_out) && $d_type != 0 )) {
                $total = $totalHotel + $totalAtraccion + $totalReserva + $totalTransferIn + $totalTransferOut;



                $extra = ($extra == '') ? 0 : $extra;
//                if ($opcion_pago == 3) {
//                    $fee = ($total + $extra) * 0.04;
//                } else {
//                    $fee = 0;
//                }
                $fee = 0;
                if ($opcion_saldo == 1) {
                    $tipoSaldo = 'FULL';
                } else {
                    $tipoSaldo = 'BALANCE';
                }
                Doo::loadModel("Tours");
                
                if ($rates == 0) {
                    $tn3 = $id_tour;
                } else {
                    $tn3 = $rates;
                }
                
                $sql3 = "SELECT rate FROM ratesvalid WHERE id='$tn3'";
                $rs3 = Doo::db()->query($sql3);
                $tari_name = $rs3->fetchAll();

                
                foreach ($tari_name as $t3) {
                    
                }
                
                $tarifario = $t3['rate'];
                
                $tours = new Tours();
                $tours->id = $t_anterior->id;
                $tours->id_client = $cliente->id;
                $tours->type_client = $cliente->tipo_client;
                $tours->platinum = $type_services;
                $tours->id_agency = $dat->id;
                $tours->tarifario = $tn3;
                $tours->code_conf = $t_anterior->code_conf;
                $tours->agency_employee = -1;
                if ($id_agency != -1) {
                    if (isset($id_auser) && $id_auser != -1) {
                        $tours->agency_employee = $id_auser;
                    } else if (trim($uagency) != '') {
                        $agency = new Agency();
                        $agency->id = $id_agency;
                        $agency = Doo::db()->getOne($agency);
                        Doo::loadModel('UserA');
                        $usera = new UserA();
                        $usera->firstname = $uagency;
                        $usera->email = $agency->main_email;
                        $usera->active = false;
                        $usera->id_agencia = $id_agency;
                        $usera->id = Doo::db()->insert($usera);
                        $tours->agency_employee = $usera->id;
                    }
                }
                $tours->creation_date = $t_anterior->creation_date;
                $tours->ending_date = $fecha_retorno;
                $tours->starting_date = $fecha_salida;
                $tours->length_day = $days;
                $tours->length_nights = $nights;
                $tours->adult = $adult;
                $tours->child = $child;
                $tours->id_reserva = (isset($id_reserva) ? $id_reserva : -1);
                $tours->id_transfer_in = (isset($inTrans) ? $inTrans : -1);
                $tours->id_transfer_out = (isset($OutTrans) ? $OutTrans : -1);
                $tours->id_hotel_reserve = (isset($id_hotel_reserves) ? $id_hotel_reserves : -1);

                /////////////////////////////////////
                
                $tours->paid_driver = $paid_driver;
                $tours->passenger_balance_due = $passenger_balance_due;
                $tours->pred_paid_amount = $pred_paid_amount;
                $tours->total_paid = $total_paid;
                $tours->agency_balance_due = $agency_balance_due;
                $tours->total_charge = $TCH;
                
                $tours->comments = $comments;
                $time = time();
                $fechamulti = date("[Y-m-d  H:i:s]", $time);
                
                $user = $_SESSION['login']->id;

                $sql2 = "SELECT nombre as OPERADOR FROM  usuarios  WHERE id = $user";

                $rs2 = Doo::db()->query($sql2);
                $usuario = $rs2->fetch();
                $operador = $usuario['OPERADOR'];
                

                $sql = "SELECT comments2 FROM  tours  WHERE id = $tours->id";

                $rs = Doo::db()->query($sql);
                $commen2 = $rs->fetch();
//                print_r($commen2);
//                exit;            

                $notes2 = $commen2['comments2'];
                $comments = strtoupper($comments);
                $operador1 = strtoupper($operador);

                //$tours->comments2 = (" Tarifario: " . $tarifario . " " . "New Note: " . $comments . " " . $fechamulti . ";\n" . $notes2);
                $tours->comments2 = ('TARIFARIO: ' . "[". $tarifario ."]". "\n\n" . $comments ."\n\n". $fechamulti . "; USUARIO: $operador1.\n\n" . $notes2);

                //tour_name
                //////////////////////////



                $tours->tipo_pago = $arkey[0];
                $tours->pago = $arval[0] . '-' . $tipoSaldo;
                $tours->op_pago = $opc_pago;
                $tours->op_pago_conductor = $opcion_pago_conductor;
                $tours->extra_charge = $extra;
                $tours->otheramount = $otheramountp;
                $tours->descuento_procentaje = $descuento;
                $tours->descuento_valor = $descuento_valor;

                /** Calculo del total */
                #transfer in
                $total_tranfer_in = $tranferIn->total_price;

                #tranfer out 
                $total_tranfer_out = $tranferOut->total_price;

                #transport trip
                $total_transport_trip = $reserve->precioA + $reserve->precioN;

                #attracciones parques                
                $total_attracciones = $totalAtraccion;

                $total_sin_hotel = $total_tranfer_in + $total_tranfer_out + $total_transport_trip + $total_attracciones + $totalHotel;
                //$tours->total = $total_sin_hotel + $fee + $extra;
                $tours->total = $total_sin_hotel + $extra;
                //$tours->total = $total + $fee + $extra;
                $tours->total = $total + $extra;
                //echo $extra;
                //exit;

                if ($descuento_valor > 0) {
                    $tours->total = $tours->total - $descuento_valor;
                }
                if ($descuento > 0) {
                    $tours->total = ceil($tours->total * ( 1 - ($descuento / 100)));
                }
                if (trim($estado) != '') {
                    $tours->estado = $estado;
                }

                if ($tours->id < 1330) {
                    //$fee_n = 0.03;
                    $fee_n = 0;
                } else {
                    //$fee_n = 0.04;
                    $fee_n = 0;
                }
                if ($opcion_pago == 7) {
                    $tours->totalouta = 0;
                } else if ($opcion_pago == 3) {

                    if ($otheramount > 0) {
                        $tours->totalouta = $tours->total + ($otheramount * $fee_n);
                    } else {
                        $tours->totalouta = $tours->total + ($tours->total * $fee_n);
                    }
                    $tours->total = $tours->total + ($tours->total * $fee_n);
//                    if ($opcion_saldo == 1) {
//                        $tours->totalouta = ceil($tours->total + $comision); //punto
//                    } else {
//                        $tours->totalouta = ceil($tours->total);
//                    }
                    $tres_porciento = ($otheramount * $fee_n);
                } else if ($opcion_pago == 1) {
                    if ($otheramount > 0) {
                        $tours->totalouta = $tours->total + ($otheramount * $fee_n);
                    } else {
                        $tours->totalouta = $tours->total + ($tours->total * $fee_n);
                    }

//                    if ($opcion_saldo == 1) {
//                        $tours->totalouta = ceil($tours->total + $comision); //punto
//                    } else {
//                        $tours->totalouta = ceil($tours->total);
//                    }
                    $tres_porciento = ($otheramount * $fee_n);
                } else {
                    $tres_porciento = 0;
                    $tours->totalouta = $tours->total;
                }

                $tours->otheramount = $otheramount + $tres_porciento;
                
                $tours->otheramount_sin_tax = $otheramountp;
                $tours->canal = $canal;
                if ($t_anterior->estado == 'INVOICED') {
                    $tours->estado = 'INVOICED';
                } else {
                    $tours->estado = $estado;
                }

                if (isset($_SESSION['tours']["mensaje_html"])) {
                    $tours->mensaje_tiquetes = $_SESSION['tours']["mensaje_html"];
                }
                //////////////////////////////////////////////////////////////
//                echo '<pre>';
//                print_r($tours);
//                echo '<pre>';
//                exit;
                ////////////////////////////////////////////////
                Doo::db()->update($tours);
                $id_tours = $t_anterior->id;
                //Insertamos las atracciones
                //restauramos el numero de tiquetes que habia
                $sql0 = "select id_park,admission from attraction_trafic where id_tours = ? and type_tour = 'MULTI'";
                $q0 = Doo::db()->query($sql0, array($t_anterior->id));
                $rs0 = $q0->fetchAll();
                Doo::loadModel('Parques');

                foreach ($rs0 as $parque) {
                    $id = $parque['id_park'];
                    if ($parque['admission'] == 1) {
                        $parque = new Parques();
                        $parque->id = $id;
                        $parque = Doo::db()->getOne($parque);
                        $parque->stock = intval($parque->stock) + ($t_anterior->child + $t_anterior->adult);
                        $parque->update();
                    }
                }
                //eliminamos atracciones anteriores
                Doo::loadModel('Attraction_Trafic');
                $atracciones_anteriores = new Attraction_Trafic();
                $atracciones_anteriores->id_tours = $t_anterior->id;
                $atracciones_anteriores->type_tour = 'MULTI';
                Doo::db()->delete($atracciones_anteriores);

                foreach ($atracciones as $attraction) {
                    $attraction->id_tours = $id_tours;
                    Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                    if ($attraction->admission == 1) {
                        $parque = new Parques();
                        $parque->id = $attraction->id_park;
                        $parque = Doo::db()->getOne($parque);
                        $parque->stock = intval($parque->stock) - ($tours->child + $tours->adult);
                        $parque->update();
                    }
                }
                //Fin Insert las atracciones
//			$rsql = Doo::db()->showSQL();
//                        foreach($rsql as $sql){
//                            echo $sql;
//                        }
//                        exit;
                // actualizamos la reseva
                if ($id_reserva != -1) {
                    $reserve->id = $id_reserva;
                    $reserve->id_tours = $id_tours;
                    if ($tours->otheramount > 0) {
                        $tor = $tours->otheramount;
                    } else {
                        $tor = $tours->totalouta;
                    }
                    $reserve->otheramount = $tor;
                    Doo::db()->update($reserve);
                }
                // FIN actualizamos la reseva
                // actualizamos la reseva del hotel
//                if (isset($opcion_hotel) && $nhoteles == 1) {
//                    $sql = "update hotel_reserves set id_tours = ? where id = ?";
//                    $rs = Doo::db()->query($sql, array($tours->id, $hotel->id));
//                }
                // FIN actualizamos la reseva
                if (isset($_SESSION['reinvoicing'])) {
                    $_SESSION['reinvoicing'] = true;
                }
                //Inser Tours Agency
                if ($dat->id != -1) {
                    Doo::loadModel("Tours_Agency");
                    $tours_reserv = new Tours_Agency();
                    $comision = $comi_in + $comi_out + $comi_traffic + $comi_hotel;
                    //$comision = $comision/4;
                    $comision = $comision / 3; //este es para no meter la comision de las atracciones
                    if ($dat->type_rate == 0 && $dat->id != -1) {
                        $valorComision = $comision * ($total - $totalAtraccion) / 100;
                    } else {
                        $valorComision = 0;
                    }
                    $tours_reserv->id_agencia = $dat->id;
                    $tours_reserv->comision = $comision;
                    $tours_reserv->id_reserva = $id_reserva;
                    $tours_reserv->id_tours = $id_tours;
                    $tours_reserv->type_tour = 'MULTI';
                    $tours_reserv->tipo_pago = $arkey[0];
                    $tours_reserv->pago = $arval[0] . '-' . $tipoSaldo;
                    $tours_reserv->type_rate = $dat->type_rate;
                    $tours_reserv->agency_fee = $valorComision;
                    $tours_reserv->total = $total;
                    $tours_reserv->otheramount = $otheramount;
                    $tours_reserv->totalouta = $total + $fee + $extra;
                    if ($t_anterior->id_agency != -1) {
                        $toursreserv_anterior = new Tours_Agency();
                        $toursreserv_anterior->id_tours = $id_tours;
                        $toursreserv_anterior->type_tour = 'MULTI';
                        $toursreserv_anterior = Doo::db()->find($toursreserv_anterior, array('limit' => 1));
                        if (!empty($toursreserv_anterior)) {
                            $tours_reserv->id = $toursreserv_anterior->id;
                            Doo::db()->update($tours_reserv);
                        } else {
                            Doo::db()->insert($tours_reserv);
                        }
                    } else {
                        Doo::db()->insert($tours_reserv);
                    }
                } else {
                    if ($t_anterior->id_agency != -1) {
                        $toursreserv_anterior = new Tours_Agency();
                        $toursreserv_anterior->id_tours = $id_tours;
                        $toursreserv_anterior->type_tour = 'MULTI';
                        Doo::db()->delete($toursreserv_anterior);
                    }
                }
                //Registramos pago y rastro del tours
//                $tours->id = $id_tours;
//                $login = $_SESSION['login'];
//                $login->tipo = 'OPERATOR';
//                $t_anterior->paid = 0;
//                if ($pay_amount != "" && $pay_amount > 0) {
//                    $option = $this->types_payments();
//                    if (isset($_REQUEST['opcion_pago_2'])) {
//                        $pago_2 = $_REQUEST['opcion_pago_2'];
//                    }
//                    $arval = array_values($option[$pago_2]);
//                    $arkey = array_keys($option[$pago_2]);
//                    $tipoP_2 = $arkey[0];
//                    $formaP_2 = $arval[0];
//
//                    $tours->paid = $pay_amount;
//                    $this->registrar_pago($tours, NULL, $login, $pay_amount, $tipoP_2, $formaP_2);
//                } else {
//                    $tours->paid = 0;
//                }
                
                   ////////////////////////////////////////////////////////////////////////////////////////////
                
                ///PAGO DRIVER
            if ($paid_driver != "" && $paid_driver > 0 && $paid_driver != $p_d_e) {
                $tours->id = $id_tours;
                $login = $_SESSION['login'];
                $login->tipo = 'OPERATOR';
                $t_anterior->paid = 0;
                $option = $this->types_payments();

                if (isset($_REQUEST['opcion_pago_driver'])) {
                    $pago_2 = $_REQUEST['opcion_pago_driver'];
                }
//
//                    if ($opd == 8) {
//                        $tipo_pag = 'CREDIT CARD NO FEE';
//                    }
//
//                    if ($opd == 3) {
//                        $tipo_pag = 'CREDIT CARD WITH FEE';
//                    }
//
//                    if ($opd == 4) {
//                        $tipo_pag = 'CASH';
//                    }
//
//                    if ($opd == 9) {
//                        $tipo_pag = 'CHECK';
//                    }
//                    
//                $pago_conductor = ($paid_driver) - ($p_d_e);
//                $prefix = "COLLECT ON BOARD";
//                $this->registrar_pago($tours, NULL, $login, $pago_conductor, $prefix, $tipo_pag);
                    
                if($no_pago == 1){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                    }else if($no_pago == 2){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                    }else if($no_pago == 3){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                    }else if($no_pago == 4){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                    }else if($no_pago == 5){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                    }else if($no_pago == 6){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                    }else if($no_pago == 7){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        
                    }else if($no_pago == 8){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado8, $pago8, $tipo_pago8);
                        
                        
                    }else if($no_pago == 9){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado8, $pago8, $tipo_pago8);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado9, $pago9, $tipo_pago9);
                        
                        
                    }else if($no_pago == 10){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado1, $pago1, $tipo_pago1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado2, $pago2, $tipo_pago2);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado3, $pago3, $tipo_pago3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado4, $pago4, $tipo_pago4);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado5, $pago5, $tipo_pago5);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado6, $pago6, $tipo_pago6);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado7, $pago7, $tipo_pago7);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado8, $pago8, $tipo_pago8);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado9, $pago9, $tipo_pago9);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagado10, $pago10, $tipo_pago10);                
                        
                    }

                
            }else {
                    $tours->paid = 0;
                }

            //PAGO PRE-PAID

            if ($pred_paid_amount != "" && $pred_paid_amount > 0 && $pred_paid_amount != $p_a_e) {
                $tours->id = $id_tours;
                $login = $_SESSION['login'];
                $login->tipo = 'OPERATOR';
                $t_anterior->paid = 0;
//                $option = $this->types_payments();

                if (isset($_REQUEST['opcion_pago_3'])) {
                    $pago_3 = $_REQUEST['opcion_pago_3'];
                }
                
//                $opp = $_POST['opcion_pago_3'];
//                
//                if ($opp == 2) {
//                        
//                        $tipo_pre = 'CREDIT CARD NO FEE';
//                        
//                    }
//
//                    if ($opp == 1) {
//                       
//                        $tipo_pre = 'CREDIT CARD WITH FEE';
//                    }
//
//                    if ($opp == 6) {
//                        
//                        $tipo_pre = 'CASH';
//                    }
//
//                    if ($opp == 10) {
//                        
//                        $tipo_pre = 'CHECK';
//                    }
//                
//                
//                $pago_prepago = ($pred_paid_amount) - ($p_a_e);
//                $prefix2 = "PRE-PAID";
//
//                $this->registrar_pago($tours, NULL, $login, $pago_prepago, $prefix2, $tipo_pre);
                
                if($no_prep == 1){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);                   
                        
                    }else if($no_prep == 2){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                    }else if($no_prep == 3){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                    }else if($no_prep == 4){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);                       
                        
                        
                    }else if($no_prep == 5){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        
                    }else if($no_prep == 6){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                    }else if($no_prep == 7){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        
                    }else if($no_prep == 8){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre8, $pagopre8, $tipo_pagopre8); 
                        
                        
                    }else if($no_prep == 9){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre8, $pagopre8, $tipo_pagopre8); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre9, $pagopre9, $tipo_pagopre9); 
                        
                    }else if($no_prep == 10){
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre1, $pagopre1, $tipo_pagopre1);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre2, $pagopre2, $tipo_pagopre2); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre3, $pagopre3, $tipo_pagopre3);
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre4, $pagopre4, $tipo_pagopre4);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre5, $pagopre5, $tipo_pagopre5);    
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre6, $pagopre6, $tipo_pagopre6); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre7, $pagopre7, $tipo_pagopre7); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre8, $pagopre8, $tipo_pagopre8); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre9, $pagopre9, $tipo_pagopre9); 
                        
                        $this->registrar_pago($tours, NULL, $login, $pagadopre10, $pagopre10, $tipo_pagopre10); 
                    } 
                
                
                
                }else {
                    $tours->paid = 0;
                }   
                
                
                
                ///////////////////////////////////////////////////////////////////////////////////////////
             

                $hotel_id = $_POST['hotel_id'];
                Doo::loadModel("Tours_Rastro");
                $rastro = new Tours_Rastro();



                $this->rastro_tours('UPDATE', $t_anterior, $tours, $login);
                $rastro->id_hotel = $hotel_id;
            }
//            echo "hola mundos!";
            //FIN Insert tours
//            if (isset($_SESSION['reinvoicing'])) {
//                echo '<script>window.close();</script>';
//                exit;
//            }
            //unset($_SESSION['tours']['hoteles_n']);
            Doo::db()->commit();
//            return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?menssage=Guardado Correctamente";
            echo "<script> window.open('../tours/edit/$id_tours','MULTIDAYSAVE','')</script>";
            
            
        } catch (Exception $exc) {
            //unset($_SESSION['tours']['hoteles_n']);
            Doo::db()->rollBack();
            print_r($exc);
            return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?error=error al guardar, verifique con su administrador de software.";
                        
        }
        
        echo "<script> window.close('../tours/save','','')</script>";
    }

    public function edit() {



        Doo::loadModel("Tours");
        Doo::loadModel("Clientes");
        Doo::loadModel("Agency");
        Doo::loadModel("UserA");
        Doo::loadModel("Transfer");
        Doo::loadModel("Reserve");
        Doo::loadModel("PickupDropoff");
        Doo::loadModel("Hotel_Reserves");
        Doo::loadModel("Hoteles");
        Doo::loadModel("Attraction_Trafic");
        ///////////////////////////////////////



        $url_back = '';
       
        if (isset($this->params["pindex"])) {

            $tours = new Tours();
            $cliente = new Clientes();
            $agencia = new Agency();
            $userA = new UserABase();
            $transfer_in = new Transfer();
            $transfer_out = new Transfer();
            $reserve = new Reserve();
            $pickup1 = new PickupDropoff();
            $pickup2 = new PickupDropoff();
            $dropoff1 = new PickupDropoff();
            $dropoff2 = new PickupDropoff();
            $hotel_reserve = new Hotel_Reserves();
            $hotel = new Hoteles();
            $atractions = new Attraction_Trafic();
            $tours->id = $this->params["pindex"];
            $tours = Doo::db()->find($tours, array('limit' => 1));
            if (!empty($tours)) {




//                $color_row = array('#DBE5DD', 'lightblue');
//               
//                $ind_color = 0;
//
//
//
//                $sql = "SELECT p1.nombre as PARQUE,g1.nombre AS GRUPO, a1.adult, a1.child, a1.admission_adtul,
//                    a1.admission_child, a1.totalTraspor, a1.v_p_adult, a1.v_p_child, a1.total_paid, a1.cantidad 
//                    FROM attraction_trafic a1
//                    LEFT JOIN parques p1 on (a1.id_park = p1.id)
//                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)
//                    WHERE a1.id_tours = $tours->id AND a1.type_tour = 'MULTI'";
//
//                $rs = Doo::db()->query($sql);
//                $atracadm = $rs->fetchAll();
//                            //print_r($atracadm);             
//
//                $table = "<table border=1 align='center' style='text-align: center;'>";
//                $table .=" <tr>
//              <td>PARK</td>                 
//              <td>GROUP</td>                 
//              <td>ADMISSION ADULT</td>
//              <td>ADMISSION CHILD</td>
//              <td>TRANSPORT</td>
//                   </tr>
//                 ";
//
//
//                foreach ($atracadm as $clave => $key) {
//                    $ind_color++;
//                    $ind_color %= 2;
//                    $table .="<tr bgcolor=${color_row[$ind_color]}>";
//                    $table .="<td>" . $key["PARQUE"] . "</td>";
//                    $table .="<td>" . $key['GRUPO'] . "</td>";
//                    $table .="<td> $ " . $key['admission_adtul'] . ".00</td>";
//                    $table .="<td> $ " . $key['admission_child'] . ".00</td>";
//                            //echo"<td>&nbsp;&nbsp;".$key['admission_adtul']."&nbsp;&nbsp;".$key['admission_child']."</td>";
//                    $table .="<td> $ " . $key['totalTraspor'] . ".00</td>";
//                    $table .= "</tr>";
//                }
//                $table .= "</table>";
//                            //echo $table;
//                            //echo "<script>  </script>";
//                            //$priceadult  = $key['v_p_adult'];
//                            //$pricechild = $key['v_p_child'];
//
//
//
//                $sql = "SELECT a1.cantidad,g1.nombre AS GRUPO, SUM(total_paid) AS TOTAL, ROUND(SUM(v_p_adult)) AS ADM_ADULT, ROUND(SUM(v_p_child)) AS ADM_CHILD
//                    FROM attraction_trafic a1
//                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)                    
//                    WHERE id_tours = $tours->id AND type_tour = 'MULTI'";
//
//                $rs = Doo::db()->query($sql);
//                $atracadm2 = $rs->fetchAll();
//                            //$priceadult         = $key['v_p_adult'];
//                            //$pricechild         = $key['v_p_child'];
//
//                foreach ($atracadm2 as $clave => $key) {
//                    
//                }
//
//                $price_total_paid = $key['TOTAL'];
//                $adm_adult = $key['ADM_ADULT'];
//                $adm_child = $key['ADM_CHILD'];
//                $cantidad = $key['cantidad'];
                //            if ($cantidad == 2 ){
                ////            $respuesta_html = "";
                ////                        foreach ($price_group_parks as $key) {
                //              //echo   $respuesta_html .= "<p>" . $key['cantidad'] . " tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</p>";
                //                 
                ////                        }
                //            }  
                //            
                //            if ($cantidad == 3 ){
                ////            $respuesta_html = "";
                ////                        foreach ($price_group_parks as $key) {
                //                    // echo  $respuesta_html .= "<p>" . $key['cantidad'] . " tickets to <strong>" . $key['GRUPO'] . "</strong> Adult $ <strong>" . $key["ADM_ADULT"] . "</strong> Child $ <strong>" . $key["ADM_CHILD"] . "</strong> per person.</p>";
                //                  //}
                ////                    
                //            }       
                //            echo '<input type="hidden" readonly="readonly" value="' . $priceadult . '" name="priceadult" id="priceadult"/>';
                //            echo '<input type="hidden" readonly="readonly" value="' . $pricechild . '" name="pricechild" id="pricechild"/>';
                //echo '<input type="hidden" readonly="readonly" value="' . $price_total_paid . '" name="price_total_paid" id="price_total_paid"/>';
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $_SESSION['tours_edit'] = $tours;
                //RASTRO-> Modificaciones de la reserva
                $sql = "SELECT `id`, `id_tours`, `tipo_cambio`, `detalles`, `fecha`, `usuario`, `tipo_usuario` FROM `tours_rastro` WHERE id_tours = ? ORDER BY  `fecha` DESC";
                $rs = Doo::db()->query($sql, array($tours->id));
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
                //FIN rastro
                //Cargamos el cliente
                $cliente->id = $tours->id_client;
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
                //FIN carga cliente
                //Cargamos la agencia
                $agencia->id = $tours->id_agency;
                if ($agencia->id != -1) {
                    $agencia = Doo::db()->find($agencia, array('limit' => 1));
                    if (!empty($agencia)) {
                        $rs = Doo::db()->query("SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days
										   FROM agency_account WHERE id_agencia = ? ", array($agencia->id));
                        $agency_account = $rs->fetch();
                        if ($agency_account['opcion5'] != 0) {
                            if ($agency_account['opcion5'] == 1) {
                                $txt = 'Open Credit Voucher';
                                $disponible = -1;
                            } else {
                                Doo::loadController("AgenciaController");
                                $agenControl = new AgenciaController();
                                $disponible = $agenControl->credito($agencia->id);
                                $txt = 'Limit Credit Voucher';
                            }
                        }
                    } else {
                        $disponible = 0;
                        $agency_account['opcion1'] = 0;
                        $agency_account['opcion2'] = 0;
                        $agency_account['opcion3'] = 0;
                        $agency_account['opcion4'] = 0;
                        $agency_account['opcion5'] = 0;
                    }
                    $userA->id = $tours->agency_employee;
                    $userA = Doo::db()->find($userA, array('limit' => 1));
                    if (empty($userA)) {
                        $userA = new UserABase();
                        $userA = -1;
                    }
                } else {
                    $agencia->type_rate = 0;
                    $disponible = 0;
                    $agency_account['opcion1'] = 0;
                    $agency_account['opcion2'] = 0;
                    $agency_account['opcion3'] = 0;
                    $agency_account['opcion4'] = 0;
                    $agency_account['opcion5'] = 0;
                }
                //FIN carga agencia
                //Cargamos Transfer in 
                if ($tours->id_transfer_in != -1) {
                    $transfer_in->id = $tours->id_transfer_in;
                    $transfer_in = Doo::db()->find($transfer_in, array('limit' => 1));
                    if (empty($transfer_in)) {
                        $transfer_in = new Transfer();
                    }
                } else {
                    $transfer_in->type = 1;
                }
                //FIN carga Transfer in
                //Cargamos Transfer out 
                if ($tours->id_transfer_out != -1) {
                    $transfer_out->id = $tours->id_transfer_out;
                    $transfer_out = Doo::db()->find($transfer_out, array('limit' => 1));
                    if (empty($transfer_out)) {
                        $transfer_out = new Transfer();
                    }
                } else {
                    $transfer_out->type = 1;
                }
                //FIN carga Transfer out
                //Cargamos Reserva
                if ($tours->id_reserva != -1) {
                    $reserve->id = $tours->id_reserva;
                    $reserve = Doo::db()->find($reserve, array('limit' => 1));
                    if (!empty($reserve)) {
                        if ($reserve->pickup1 != -1 && $reserve->pickup1 != 0) {
                            $pickup1->id = $reserve->pickup1;
                            $pickup1 = Doo::db()->find($pickup1, array('limit' => 1));
                        } else {
                            $pickup1->id = -1;
                        }
                        if ($reserve->dropoff1 != -1 && $reserve->dropoff1 != 0) {
                            $dropoff1->id = $reserve->dropoff1;
                            $dropoff1 = Doo::db()->find($dropoff1, array('limit' => 1));
                        } else {
                            $dropoff1->id = -1;
                        }
                        if ($reserve->pickup2 != -1 && $reserve->pickup2 != 0) {
                            $pickup2->id = $reserve->pickup2;
                            $pickup2 = Doo::db()->find($pickup2, array('limit' => 1));
                        } else {
                            $pickup2->id = -1;
                        }
                        if ($reserve->dropoff2 != -1 && $reserve->dropoff2 != 0) {
                            $dropoff2->id = $reserve->dropoff2;
                            $dropoff2 = Doo::db()->find($dropoff2, array('limit' => 1));
                        } else {
                            $dropoff2->id = -1;
                        }

                        $extenciones01 = $this->getExten(1/* $reserve->tot */);
                        $extenciones04 = $this->getExten(1/* $reserve->tot */);
                    } else {
                        $extenciones01 = array();
                        $extenciones04 = array();
                        $pickup1->id = -1;
                        $dropoff1->id = -1;
                        $pickup2->id = -1;
                        $dropoff2->id = -1;
                    }
                } else {
                    $extenciones01 = array();
                    $extenciones04 = array();
                    $pickup1->id = -1;
                    $dropoff1->id = -1;
                    $pickup2->id = -1;
                    $dropoff2->id = -1;
                }
                //FIN carga Reserva
                //Cargamos Hotel Reservado
                $query = "select * from hotel_reserves where id_tours= ? ";
                $rs = Doo::db()->query($query, array($tours->id));
                $hr = $rs->fetchAll();
                if (!empty($hr)) {

                    /* echo json_encode($tours);
                      exit; */
                    $hoteles = array();
                    $costos_hoteles = array();
                    $tipo_habitaciones = array();
                    $counts = 0;
                    if (!empty($hr)) {
                        if (isset($_SESSION['tours']['hoteles_n'])) {
                            unset($_SESSION['tours']['hoteles_n']);
//            echo '<script>
//                        alert("tiene reservas abiertas en su navegador,cierrelas");
//                       /*window.location="'.Doo::conf()->APP_URL .'admin/tours";*/
//                  </script>';
                            //return Doo::conf()->APP_URL . "admin/tours";
                        }
                        foreach ($hr as $hotel_reserve) {
                            $hotel = new Hoteles();

                            $tipoHabitacion = $this->tipoHabitacion($hotel_reserve['room1_adult'], $hotel_reserve['room2_adult'], $hotel_reserve['room3_adult'], $hotel_reserve['room4_adult']);
//                          $costoHotel = $this->costoHotel($tours->starting_date, $tours->ending_date, $hotel_reserve['id_hotel'], $hotel_reserve['room1_adult'], $hotel_reserve['room2_adult'], $hotel_reserve['room3_adult'], $hotel_reserve['room4_adult'], $hotel_reserve['free_night'], $hotel_reserve['free_night_buffet'], $agencia->type_rate, $hotel_reserve['nights']);
                            $costoHotel = array();
                            $costoHotel['priceRoom1'] = $hotel_reserve["totalnights"];
                            $costoHotel['priceRoom2'] = $hotel_reserve["totalnights"];
                            $costoHotel['priceRoom3'] = $hotel_reserve["totalnights"];
                            $costoHotel['priceRoom4'] = $hotel_reserve["totalnights"];
                            $costoHotel['sgl'] = $hotel_reserve["totalnights"];
                            $costoHotel['dbl'] = $hotel_reserve["totalnights"];
                            $costoHotel['tpl'] = $hotel_reserve["totalnights"];
                            $costoHotel['qua'] = $hotel_reserve["totalnights"];
                            $costoHotel['priceBreakfast'] = $hotel_reserve["totalbreakfasts"];
                            $costoHotel['total'] = $hotel_reserve["totalbreakfasts"];
                            $id_hotel = $hotel_reserve["id_hotel"];
                            /** Discriminacion en Session */
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["id"] = $id_hotel;
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["nombre"] = $hotel_reserve["hotel_name"];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["categorias"] = $hotel_reserve["category"];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["breakfast"] = $hotel_reserve["buffet"];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["super_breakfast"] = $hotel_reserve["super_breakfast"];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["total_price"] = $hotel_reserve["totalnights"];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["sql"] = $hotel_reserve['sgl'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["dbl"] = $hotel_reserve['dbl'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["tpl"] = $hotel_reserve['tpl'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["qua"] = $hotel_reserve['qua'];
//                                              
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["sql_indicativo"] = $hotel_reserve['sql_indicativo'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["dbl_indicativo"] = $hotel_reserve['dbl_indicativo'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["tpl_indicativo"] = $hotel_reserve['tpl_indicativo'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["qua_indicativo"] = $hotel_reserve['qua_indicativo'];

                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room1"] = $hotel_reserve['room1'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room2"] = $hotel_reserve['room2'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room3"] = $hotel_reserve['room3'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room4"] = $hotel_reserve['room4'];

                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room1_c"] = $hotel_reserve['room1_c'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room2_c"] = $hotel_reserve['room2_c'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room3_c"] = $hotel_reserve['room3_c'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["room4_c"] = $hotel_reserve['room4_c'];

                            $_SESSION['tours']['hoteles_n'][$id_hotel]["rooms"] = $hotel_reserve['roooms'];

                            $_SESSION['tours']['hoteles_n'][$id_hotel]["priceBreakfast"] = $hotel_reserve['breakfastprice'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["nochesfree"] = $hotel_reserve['free_night'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["totalpax"] = $hotel_reserve['total_persons'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["noches"] = $hotel_reserve['nights'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["dias"] = $hotel_reserve['days'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["free_night_buffet"] = $hotel_reserve['free_night_buffet'];

                            $_SESSION['tours']['hoteles_n'][$id_hotel]["starting_date"] = $hotel_reserve['starting_date'];
                            $_SESSION['tours']['hoteles_n'][$id_hotel]["ending_date"] = $hotel_reserve['ending_date'];

                            /** Fin Discriminacion en Session */
                            $hotel->id = $hotel_reserve['id_hotel'];
                            $hotel = Doo::db()->find($hotel, array('limit' => 1));
                            array_push($hoteles, $hotel);
                            array_push($costos_hoteles, $costoHotel);
                            array_push($tipo_habitaciones, $tipoHabitacion);
                            $counts += 1;
                        }
                        $this->data['hotel_reserves'] = $hr;
                        $this->data['costos_hoteles'] = $costos_hoteles;
                        $this->data['hoteles'] = $hoteles;
                        $this->data['tipo_habs'] = $tipo_habitaciones;
                        $this->data['nhoteles'] = count($hr);

                        //$this->data['ratesvalid'] = $rvalid;
                    }
                    $this->data['last_indexh'] = $counts;
                } else {
                    $hotel_reserve = new Hotel_Reserves();
                    $hotel = new Hoteles();
                    $this->data['last_indexh'] = 0;
                    $this->data['hotel_reserves'] = array();
                    $this->data['costos_hoteles'] = array();
                    $this->data['hoteles'] = array();
                    $this->data['tipo_habs'] = array();
                    $this->data['nhoteles'] = 0;
                }

//                                print_r($hr);
//                                print_r($hoteles);
//                               print_r($costos_hoteles);
//                                print_r($tipo_habitaciones);
//                                exit;
                //FIN carga hotel
                //Cargamos Actractions
                $atractions->id_tours = $tours->id;
                $atractions->type_tour = 'MULTI';
                $atractions = Doo::db()->find($atractions);
//                $_SESSION['tours'] = array();
                $_SESSION['tours']['attraction'] = array();
                $adminsionAll = 1;
                $contAdmision = 0;
                $traficAll = 1;
                $contTrafic = 0;
                $numpark = 0;


                foreach ($atractions as $row => $park) {
                    
                    
                    $fecha_sal = $tours->starting_date; 
                    //print_r($park);
//                exit;
                    $fec_inicial = strtotime ( '+1 hour' , strtotime ( $fecha_sal ) ) ;
                    
                    
                    //$this->totalValorPark($adult, $child, $id_agency);
                    
                    $this->agregarPark($park->id_park, $park->group, $agencia->id, $tours->starting_date, $tours->ending_date, $tours->platinum, $park->adult, $park->child, $park->admission, $park->trafic);
                    
                    if ($park->admission == 0) {
                        $adminsionAll = 0;
                        $contAdmision++;
                    }
                    if ($park->trafic == 0) {
                        $traficAll = 0;
                        $contTrafic++;
                    }
                    $numpark++;
                }


                if ($adminsionAll == 1) {
                    $_SESSION['tours']['atraccion_admision'] = 1;
                } else if ($contAdmision = $numpark) {
                    $_SESSION['tours']['atraccion_transpor'] = 0;
                }
                if ($traficAll == 1) {
                    $_SESSION['tours']['atraccion_transpor'] = 1;
                } else if ($contTrafic = $numpark) {
                    $_SESSION['tours']['atraccion_transpor'] = 0;
                }


                //FIN carga Actractions

                $sql = "SELECT DISTINCT t1.trip_to AS id, t2.nombre
						FROM routes t1
						LEFT JOIN areas t2 ON ( t1.trip_to = t2.id ) 
						WHERE t1.trip_from = 1";
                $rs = Doo::db()->query($sql);
                $to_areas = $rs->fetchAll();

                $servis = $this->comision_servis();

                //Area de los parques: default orlando
                $sql = "SELECT t2.id, t2.nombre  FROM areas t2
							WHERE t2.id = 1";
                $rs = Doo::db()->query($sql);
                $area_park = $rs->fetchAll();

                //Buscamos variables del proceso
                // $prueba = $tours->id;


                $id_transferin = $tours->id_transfer_in;
                //echo $id_transferin;
                $id_transferout = $tours->id_transfer_out;

                //echo $id_transferout;



                $sql10 = "SELECT type_transfer
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_in)
                    
                    WHERE to1.id_transfer_in = '$id_transferin'";


                $rs10 = Doo::db()->query($sql10);
                $tipo_transf = $rs10->fetchAll();

                foreach ($tipo_transf as $clave10 => $key10) {
                    
                }

                $tipo_transfer = $key10['type_transfer'];
                //echo $tipo_transfer;

                if ($tipo_transfer == 'PLANE') {

                    $valores = array();
                    if ($tours->id_transfer_in != -1) {
                        $valor = ($transfer_in->total_price / 2);

                        $valores['priceTransporA1'] = $valor;
                        $valores['priceTransporC1'] = $valor;
                        $comision_servis = $this->comision_servis();
                        $code = '006'; //servis_code de transfer
                        $valores['comisionTranspor1'] = $comision_servis[$code];
                    } else if ($tours->id_reserva != -1 && $reserve->trip_no != 0) {
                        //Trip
                        // to = 1, por q es orlando
                        $fecha = date('m-d-Y', strtotime($reserve->fecha_salida));
                        //00-00-0000
//                    $precioTrip1 = $this->precioTripTours($reserve->trip_no, $agencia->type_rate, $agencia->id, substr($fecha, -4));

                        $valores['priceTransporA1'] = $reserve->precio_trip1_a;
                        $valores['priceTransporC1'] = $reserve->precio_trip1_c;

                        $valores['comisionTranspor1'] = $this->trip_comision($reserve->trip_no);
                        //Extencion
                        $valores['priceExt_from1'] = $this->precio_extencion($reserve->extension1, $agencia->type_rate);
                    }
                    if ($tours->id_transfer_out != -1) {
                        //$valor = $transfer_out->total_price / $transfer_out->total_pax;
                        $valor = ($transfer_out->total_price / 2);
                        $valores['priceTransporA2'] = $valor;
                        $valores['priceTransporC2'] = $valor;
                        $comision_servis = $this->comision_servis();
                        $code = '006'; //servis_code de transfer
                        $valores['comisionTranspor2'] = $comision_servis[$code];
                    } else if ($tours->id_reserva != -1 && $reserve->trip_no2 != 0) {
                        //Trip
                        //from = 1, por q es orlandoca
                        $fecha = date('m-d-Y', strtotime($reserve->fecha_retorno));
//                    $precioTrip2 = $this->precioTripTours($reserve->trip_no2, $agencia->type_rate, $agencia->id, substr($fecha, -4));

                        $valores['priceTransporA2'] = $reserve->precio_trip2_a;
                        $valores['priceTransporC2'] = $reserve->precio_trip2_c;

                        $valores['comisionTranspor2'] = $this->trip_comision($reserve->trip_no2);
                        //Extencion
                        $valores['priceExt_to2'] = $this->precio_extencion($reserve->extension4, $agencia->type_rate);
                    }
                }


                if ($tipo_transfer == 'CAR') {

                    $adultos = $park->adult;

                    $ninos = $park->child;


                    $valores = array();
                    if ($tours->id_transfer_in != -1) {
                        $valor = ($transfer_in->total_price / 2);
                        //*($adultos+$ninos)
                        $valores['priceTransporA1'] = $valor;
                        $valores['priceTransporC1'] = $valor;
                        $comision_servis = $this->comision_servis();
                        $code = '006'; //servis_code de transfer
                        $valores['comisionTranspor1'] = $comision_servis[$code];
                    } else if ($tours->id_reserva != -1 && $reserve->trip_no != 0) {
                        //Trip
                        // to = 1, por q es orlando
                        $fecha = date('m-d-Y', strtotime($reserve->fecha_salida));
                        //00-00-0000
//                    $precioTrip1 = $this->precioTripTours($reserve->trip_no, $agencia->type_rate, $agencia->id, substr($fecha, -4));

                        $valores['priceTransporA1'] = $reserve->precio_trip1_a;
                        $valores['priceTransporC1'] = $reserve->precio_trip1_c;

                        $valores['comisionTranspor1'] = $this->trip_comision($reserve->trip_no);
                        //Extencion
                        $valores['priceExt_from1'] = $this->precio_extencion($reserve->extension1, $agencia->type_rate);
                    }
                    if ($tours->id_transfer_out != -1) {
                        //$valor = $transfer_out->total_price / $transfer_out->total_pax;
                        $valor = ($transfer_out->total_price / 2);
                        //*($adultos+$ninos);
                        $valores['priceTransporA2'] = $valor;
                        $valores['priceTransporC2'] = $valor;
                        $comision_servis = $this->comision_servis();
                        $code = '006'; //servis_code de transfer
                        $valores['comisionTranspor2'] = $comision_servis[$code];
                    } else if ($tours->id_reserva != -1 && $reserve->trip_no2 != 0) {
                        //Trip
                        //from = 1, por q es orlandoca
                        $fecha = date('m-d-Y', strtotime($reserve->fecha_retorno));
//                    $precioTrip2 = $this->precioTripTours($reserve->trip_no2, $agencia->type_rate, $agencia->id, substr($fecha, -4));

                        $valores['priceTransporA2'] = $reserve->precio_trip2_a;
                        $valores['priceTransporC2'] = $reserve->precio_trip2_c;

                        $valores['comisionTranspor2'] = $this->trip_comision($reserve->trip_no2);
                        //Extencion
                        $valores['priceExt_to2'] = $this->precio_extencion($reserve->extension4, $agencia->type_rate);
                    }
                }

                if ($tipo_transfer != 'PLANE' || $tipo_transfer != 'CAR') {

                    $valores = array();
                    if ($tours->id_transfer_in != -1) {
                        $valor = ($transfer_in->total_price / 2);

                        $valores['priceTransporA1'] = $valor;
                        $valores['priceTransporC1'] = $valor;
                        $comision_servis = $this->comision_servis();
                        $code = '006'; //servis_code de transfer
                        $valores['comisionTranspor1'] = $comision_servis[$code];
                    } else if ($tours->id_reserva != -1 && $reserve->trip_no != 0) {
                        //Trip
                        // to = 1, por q es orlando
                        $fecha = date('m-d-Y', strtotime($reserve->fecha_salida));
                        //00-00-0000
                        $precioTrip1 = $this->precioTripTours($reserve->trip_no, $agencia->type_rate, $agencia->id, substr($fecha, -4));

                        $valores['priceTransporA1'] = $reserve->precio_trip1_a;
                        $valores['priceTransporC1'] = $reserve->precio_trip1_c;

                        $valores['comisionTranspor1'] = $this->trip_comision($reserve->trip_no);
                        //Extencion
                        $valores['priceExt_from1'] = $this->precio_extencion($reserve->extension1, $agencia->type_rate);
                    }
                    if ($tours->id_transfer_out != -1) {
                        //$valor = $transfer_out->total_price / $transfer_out->total_pax;
                        $valor = ($transfer_out->total_price / 2);
                        $valores['priceTransporA2'] = $valor;
                        $valores['priceTransporC2'] = $valor;
                        $comision_servis = $this->comision_servis();
                        $code = '006'; //servis_code de transfer
                        $valores['comisionTranspor2'] = $comision_servis[$code];
                    } else if ($tours->id_reserva != -1 && $reserve->trip_no2 != 0) {
                        //Trip
                        //from = 1, por q es orlandoca
                        $fecha = date('m-d-Y', strtotime($reserve->fecha_retorno));
                        $precioTrip2 = $this->precioTripTours($reserve->trip_no2, $agencia->type_rate, $agencia->id, substr($fecha, -4));

                        $valores['priceTransporA2'] = $reserve->precio_trip2_a;
                        $valores['priceTransporC2'] = $reserve->precio_trip2_c;

                        $valores['comisionTranspor2'] = $this->trip_comision($reserve->trip_no2);
                        //Extencion
                        $valores['priceExt_to2'] = $this->precio_extencion($reserve->extension4, $agencia->type_rate);
                    }
                }



                $hoteles = array();
                if ($tours->id_hotel_reserve != -1) {
                    $valores['totalpriceNights'] = 0;
                    $valores['totalpriceBreakfast'] = 0;
                    $i = 0;
                    foreach ($hr as $hotel_reserve) {
                        $valores['totalpriceNights'] += $hotel_reserve['totalnights'];
                        $valores['totalpriceBreakfast'] += $hotel_reserve['totalbreakfasts'];
                    }
                } else {
                    $valores['totalpriceNights'] = 0;
                    $valores['totalpriceBreakfast'] = 0;
                }
                
                
                
                //$dato = $this->params['dato'];
                
//                if($dato == 'Nuevo'){
                    $park = $this->totalValorPark($reserve->pax, $reserve->pax2);
//                }
//                if($dato == 'Edit'){
//                    $park = $this->totalValorPark($reserve->pax, $reserve->pax2);
//                }

                
              
                //Fin Busca Variables
                //Valor Pagado
                $pagado = $this->pagado($tours->id);
                //Fin valor pagado
                $sql = "select * from grupo_parques";
                $query = Doo::db()->query($sql);
                $rs2 = $query->fetchAll();
                //cambiar
                //list($opcion_pago, $opcion_saldo) = explode("-", $reserve->pago);

                $this->data['hotel_redis'] = 1;
                $this->data['grupos'] = $rs2;
                $this->data['script'] = '<script>$(function(){ var sel_payment = ' . $tours->op_pago . ';
                    $("input[name=opcion_pago][value="+sel_payment+"]").attr("checked",true); /*reloadHoteles();*/ if($("#toutwcharge").val() == "1"){ ocultar("conte_departure"); $("#opcion_transfer_out").attr("checked",false); } })</script>';
                $this->data['cliente'] = $cliente;
                $this->data['agencia'] = $agencia;
                $this->data['agency_account'] = $agency_account;
                $this->data['disponible'] = $disponible;
                $this->data['userA'] = $userA;
                $this->data['transfer_in'] = $transfer_in;
                $this->data['transfer_out'] = $transfer_out;
                $this->data['reserve'] = $reserve;
//                print_r($reserve);
//                exit;
                $this->data['extenciones01'] = $extenciones01;
                $this->data['extenciones04'] = $extenciones04;
                $this->data['pickup1'] = $pickup1;
                $this->data['dropoff1'] = $dropoff1;
                $this->data['pickup2'] = $pickup2;
                $this->data['dropoff2'] = $dropoff2;
                $this->data['toutwcharge'] = $reserve->toutwcharge;
                $this->data['comision'] = $tours->totalouta - $tours->total;
//		$this->data['hotel_reserve'] = $hotel_reserve;
//              if ($tours->id_hotel_reserve != -1){
//                    $this->data['tipoHabitacion'] = $tipoHabitacion;
//                    $this->data['costoHotel'] = $costoHotel;
//		      $this->data['hotel'] = $hotel;
//              } else {
//                    $this->data['tipoHabitacion'] = 0;
//		      $this->data['costoHotel'] = 0;
//                    $this->data['hotel'] = '';
//              }

                $this->data['valores'] = $valores;
                $this->data['numpark'] = $numpark;

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['url_back'] = $url_back;
                $this->data['tours'] = $tours;
                $this->data['pagado'] = $pagado;
                $this->data['rastro'] = $rastro;

                $this->data['comsion_servis'] = $servis;
                $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
                $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
                $this->data['to_areas'] = $to_areas;
                $this->data['area_park'] = $area_park;


                $this->data['content'] = 'configuracion/frm_tours_edit.php';
                /* echo json_encode($this->data);
                  e; */

                $this->renderc('admin/index', $this->data);
            }
        }
    }

    #funcion que muestra los archivos en pdf
    //Resumen para Agencias
    public function resumen() {

        Doo::loadModel("Tours");
        $prueba = $_POST['variable'];
        //echo $prueba;



        $sql2 = "SELECT id from reservas where id_tours='$prueba'";
        $rs2 = $this->db()->query($sql2);
        $consul2 = $rs2->fetchAll();

        foreach ($consul2 as $c => $key) {
            
        }
        //echo "/////////";
        $id_reserv = $key['id'];
        //echo $id_reserv;


        $sql = "SELECT
        r1.precio_trip1_a AS adulto,
	r1.precio_trip1_c AS nino,
	r1.totaltotal AS neto,
	r1.trip_no,
	r1.trip_no2,
	r1.fecha_retorno,
        r1.firsname AS nombre,
	r1.lasname AS apellido,
	r1.email, c2.phone,
	r1.pax AS adult,
	r1.pax2 AS child,
	r1.pax3 AS inf,
	r1.codconf,
	r1.agency,
        r1.fecha_salida,
	r1.deptime1,
	r1.deptime2,
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
	p4.address AS direccion4,
        p5.admission AS admision,
        p5.trafic AS trafic,
	p6.nombre AS parque, 
        
	p8.buffet AS buffet,
        p8.super_breakfast AS super_breakfast,
	p8.roooms AS habitacion,
	p8.ending_date AS checkout,
	p8.starting_date AS checkin,
	p8.hotel_name AS nombreHotel,
        t1.total_charge AS totalcargo,
        t1.passenger_balance_due AS balance_pasajero,
        t1.agency_balance_due AS balance_agencia,
        t1.total_paid AS total_pagado,
        t1.total AS totale,
        t1.otheramount AS other,
	p9.address AS direccion
	
        
	FROM reservas r1	 
	 
	LEFT JOIN clientes c2 ON (r1.id_clientes=c2.id) 
        LEFT JOIN areas a1 ON (r1.fromt = a1.id)
        LEFT JOIN areas a2 ON (r1.tot = a2.id)
        LEFT JOIN areas a3 ON (r1.fromt2 = a3.id)
        LEFT JOIN areas a4 ON (r1.tot2 = a4.id)
        LEFT JOIN tours t1 ON (r1.id = t1.id_reserva)
	LEFT JOIN pickup_dropoff p1 ON (r1.pickup1 = p1.id) 
        LEFT JOIN pickup_dropoff p2 ON (r1.pickup2 = p2.id)  
        LEFT JOIN pickup_dropoff p3 ON (r1.dropoff1 = p3.id)  
        LEFT JOIN pickup_dropoff p4 ON (r1.dropoff2 = p4.id)
        LEFT JOIN attraction_trafic p5 ON (r1.id_tours = p5.id_tours)
	LEFT JOIN parques p6 ON (p5.id_park = p6.id)     
        LEFT JOIN hotel_reserves p8 ON (r1.id_tours = p8.id_tours)        
        LEFT JOIN hoteles p9 ON (p8.id_hotel = p9.id)
        
	
	WHERE r1.id  = '$id_reserv'";

        $rs = $this->db()->query($sql);
        $consul = $rs->fetchAll();
        //print_r($consul);
        foreach ($consul as $c => $key) {
            
        }
        $buffet = $key['buffet'];
        $super = $key['super_breakfast'];
        $habitacion = $key['habitacion'];
        $checkout = $key['checkout'];
        $checkin = $key['checkin'];
        $direccion = $key['direccion'];
        $nombreHotel = $key['nombreHotel'];
        $agencia = $key['agency'];
        $adulto1 = $key['adulto'];
        $trafico = $key['trafic'];
        $other_amount = $key['other'];
        $totale1 = $key['totale'];
        $totale = number_format($totale1, 2, '.', '');
        $balance1 = $key['balance_pasajero'];
        $balance = number_format($balance1, 2, '.', '');
        $balance_agencia1 = $key['balance_agencia'];
        $balance_agencia = number_format($balance_agencia1, 2, '.', '');
        $total_pagado1 = $key['total_pagado'];
        $total_pagado = number_format($total_pagado1, 2, '.', '');
        $total_charge1 = $key['totalcargo'];
        
        
        /*FLOOR (REDONDEA) PCCWF (PAGOS CON CREDIT CARD WITH FEE)*/
        $sqltp = "SELECT SUM(pagado) AS PCCWF FROM tours_pago WHERE id_tours = $prueba AND pago='CREDIT CARD WITH FEE' AND tipo_pago='COLLECT ON BOARD' AND tipo='MULTI'";
        $rstp = Doo::db()->query($sqltp);
        $pagosccwf = $rstp->fetchAll();

    //                    print($pagosprep);
        foreach ($pagosccwf as $pccwf) {
    //                        print($ppr['PAGPRED']);
        }
        $pago_ccwf = $pccwf['PCCWF']; 
        $pago_sinccwf = ($pccwf['PCCWF']) / 1.04;
        $cargos1 = $pago_ccwf - $pago_sinccwf;
        //$cargos = number_format($cargos1, 2, '.', '');
        
        $total_cargo1 = $total_charge1 + $cargos1;
        $total_cargo = number_format($total_cargo1, 2, '.', '');
        
        if($other_amount > 0){
            
            $amount_to_collect1 = ($other_amount + $cargos1);
            $amount_to_collect = number_format($amount_to_collect1, 2, '.', '');
            
        }
        
        if($other_amount == 0){
            
            $amount_to_collect1 = ($totale1 + $total_cargo1);
            $amount_to_collect = number_format($amount_to_collect1, 2, '.', '');
            
        }
        
        
            
//formateamos la variable para entregarla con dos cifras decimales
        $adulto = number_format($adulto1, 2, '.', '');
        //echo $adulto;

        $nino1 = $key['nino'];
//formateamos la variable para entregarla con dos cifras decimales
        $nino = number_format($nino1, 2, '.', '');
        $neto1 = $key['neto'];
        $neto = number_format($neto1, 2, '.', '');
        //echo $neto;

        $parque = $key['parque'];
        $admision = $key['admision'];
        ///echo $admision;
        ///**********************************************************************************
        //relacionar la tabla clientes con la tabla tours
        $sql6 = "SELECT t.code_conf AS codigo,
                t.adult AS adult,
                t.child AS child,
                c.firstname AS nombre,
                c.lastname AS apellido,
                c.username AS email,
                c.phone AS phone  FROM tours t 
                
                LEFT JOIN clientes c ON (t.id_client = c.id)
                       
                WHERE t.id = '$prueba'";


        $rs6 = Doo::db()->query($sql6);
        $datos_multi = $rs6->fetchAll();

        //print_r($datos_multi);
        foreach ($datos_multi as $clave5 => $key5) {
            
        }


        $nombre = strtoupper($key5['nombre']);
        $apellido = strtoupper($key5['apellido']);
        $email = strtolower($key5['email']);
        $phone1 = $key5['phone'];
        $codconf = $key5['codigo'];

        // Separamos en grupos de tres  
        $phone = chunk_split($phone1, 3, "");

        // Creamos un grupo de 3 digitos y tres grupos de 2 digitos  
        $num_tlf1 = substr($phone, 0, 3);
        $num_tlf2 = substr($phone, 3, 3);
        $num_tlf3 = substr($phone, 3, 4);

        $phone = "($num_tlf1) $num_tlf2-$num_tlf3";

        //Cantidad de adultos
        $adult = $key5['adult'];


        //cantidad de ninos        
        $child = $key5['child'];

        //************************************************************************************ 
        $axa1 = ($adulto1 * $adult);

        $axa = number_format($axa1, 2, '.', '');
        //echo $axa;
        //el precio de los parques de cada adulto y ninio
        $precioAdult = $key['entradaAdult'];
        $precioChild = $key['entradaChild'];
        $precioA = number_format($precioAdult, 2, '.', '');

        $nxc1 = ($nino1 * $child);
        $nxc = number_format($nxc1, 2, '.', '');

        //precio de los adultos
        //echo 'precio por unidad mas valor de la transportacion adultos ',$rprecioA1, '<br/>'; 
        $rpomedioA = ($rprecioA1 / $adult);
        $rpomedioA1 = number_format($rpomedioA, 2, '.', '');

        $totalApagar = ($rprecioA1 + $rprecioC1);
        $totalApagar1 = number_format($totalApagar, 2, '.', '');




        $tipo_ticket = $key['tipo_ticket'];
//$tipo_ticket = strtoupper($key['tipo_ticket']);
//Primera letra en Mayuscula
        $ticket_oneway = ucwords($key['tipo_ticket']);



        if ($child == 0) {
            $child = '0';
            $nino = '0.00';
            $nxc = '0.00';
        }

        if ($email == '') {
            $email = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        if ($phone == '') {
            $phone = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }



        if ($buffet == '1') {
            $addb = "YES";
        } else {
            $addb = "NO";
        }
        if ($super == '1') {
            $addb1 = "YES";
            $addb = "NO";
        } else {
            $addb1 = "NO";
            $addb = "YES";
        }

        ////////////////////////////////////////////////////////////////////TABLA DE CONSULTA DE PARQUES////////////////////////////////


        $sql3 = "SELECT p1.nombre as PARQUE,
                g1.nombre AS GRUPO,
                a1.adult,
                a1.child,
                a1.admission_adtul,
                a1.admission_child,
                a1.totalTraspor,
                a1.v_p_adult,
                a1.v_p_child,
                a1.total_paid,
                a1.admission AS admision,         
                a1.trafic AS trafic,  
                a1.cantidad 
                FROM attraction_trafic a1
                LEFT JOIN parques p1 on (a1.id_park = p1.id)
                LEFT JOIN grupo_parques g1 on (a1.group = g1.id)
                WHERE a1.id_tours = '$prueba' AND a1.type_tour = 'MULTI'";

        $rs3 = Doo::db()->query($sql3);
        $atracadm3 = $rs3->fetchAll();



        $table = "<table  align='center' style='text-align: center;width: 300%;border: transparent; line-height: 0.8em;'>";
        $table .="<tr>
                            <td style='' height='4'><b>Theme Park</b></td>                 
                            <td><b>Admission Included</b></td>                 
                            <td><b>Transportation Included</b></td>
                      </tr>";


        foreach ($atracadm3 as $clave2 => $key2) {

            if ($key2['admision'] == '1') {
                $add2 = "YES";
                //echo $add;
            } else {
                $add2 = "NO";
                //echo $add;
            }

            if ($key2['trafic'] == '1') {
                $traf2 = "YES";
                //echo $add;
            } else {
                $traf2 = "NO";
                //echo $add;
            }
            $table .="<tr> <td align='left'>" . $key2["PARQUE"] . "</td> <td>" . $add2 . "</td><td>" . $traf2 . "</td></tr>";
        }
        $table .= "</table>";

        // COSTOS PARA TRIPS 1 Y 2

        $sql10 = "SELECT 
                    r2.totaltotal,
                    r2.trip_no,
                    r2.trip_no2,
                    r2.deptime1,
                    r2.deptime2,
                    r2.arrtime1,
                    r2.arrtime2,
                    r2.fecha_salida,
                    r2.fecha_retorno, 
                    r2.tipo_ticket,
                    a5.nombre AS FROM1,
                    a6.nombre AS TO1,
                    a7.nombre AS FROM2,
                    a8.nombre AS TO2,
                    p11.place AS lugar1,
                    p11.address AS direccion1,
                    p22.place AS lugar2,
                    p22.address AS direccion2,
                    p33.place AS lugar3,
                    p33.address AS direccion3,
                    p44.place AS lugar4,
                    p44.address AS direccion4


                    FROM reservas r2

                    LEFT JOIN areas a5 ON (r2.fromt = a5.id)
                    LEFT JOIN areas a6 ON (r2.tot = a6.id)
                    LEFT JOIN areas a7 ON (r2.fromt2 = a7.id)
                    LEFT JOIN areas a8 ON (r2.tot2 = a8.id)


                    LEFT JOIN pickup_dropoff p11 ON (r2.pickup1 = p11.id) 
                    LEFT JOIN pickup_dropoff p22 ON (r2.pickup2 = p22.id)  
                    LEFT JOIN pickup_dropoff p33 ON (r2.dropoff1 = p33.id)  
                    LEFT JOIN pickup_dropoff p44 ON (r2.dropoff2 = p44.id)
                    
                    LEFT JOIN attraction_trafic p55 ON (r2.id_tours = p55.id_tours)
                    LEFT JOIN parques p66 ON (p55.id_park = p66.id)

                    
                    
                    WHERE codconf = '$codconf'";


        $rs10 = Doo::db()->query($sql10);
        $prc_trips = $rs10->fetchAll();


        foreach ($prc_trips as $clave10 => $key10) {
            
        }

        $tipo_ticket = $key10['tipo_ticket'];
        $precio_trips1 = $key10['totaltotal'];
        $precio_trips = number_format($precio_trips1, 2, '.', '');
        //echo $precio_trips;

        if ($tipo_ticket != 'roundtrip') {
            $fecha_salida = '';
            $fecha_retorno = '';
            $deptime1 = '';
            $deptime2 = '';
            $deptime3 = '';
            $deptime4 = '';
            $from1 = '';
            $to1 = '';
            $from2 = '';
            $to2 = '';
        } else {
            $fecha_salida1 = $key10['fecha_salida'];
            $fecha_salida2 = strtotime($fecha_salida1);
            $fecha_salida = date('m/d/Y', $fecha_salida2);

            $lugar1 = $key10['lugar1'];
            $direccion1 = $key10['direccion1'];

            $lugar2 = $key10['lugar2'];
            $direccion2 = $key10['direccion2'];

            $trip_no = $key10['trip_no'];
            $trip_no2 = $key10['trip_no2'];

            $fecha_retorno1 = $key10['fecha_retorno'];
            $fecha_retorno2 = strtotime($fecha_retorno1);
            $fecha_retorno = date('m/d/Y', $fecha_retorno2);

            $lugar3 = $key10['lugar3'];
            $direccion3 = $key10['direccion3'];
            //cambiar formato de hora a AM / PM
            $deptime1 = date("g:i a", strtotime($key10['deptime1']));
            $deptime2 = date("g:i a", strtotime($key10['deptime2']));
            $arrtime1 = date("g:i a", strtotime($key10['arrtime1']));
            $arrtime2 = date("g:i a", strtotime($key10['arrtime2']));

            $lugar4 = $key10['lugar4'];
            $direccion4 = $key10['direccion4'];
            //$trip_no2 = $key10['trip_no2'];

            $from1 = $key10['FROM1'];
            $to1 = $key10['TO1'];
            $from2 = $key10['FROM2'];
            $to2 = $key10['TO2'];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        //COSTOS PARA TRANSFERS (PLANE & CAR)
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        //TRANSFER IN

        $sql8 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_in)
                    
                    WHERE to1.id = '$prueba'";


        $rs8 = Doo::db()->query($sql8);
        $transf_in = $rs8->fetchAll();

        foreach ($transf_in as $clave8 => $key8) {
            
        }

        $precio_transf_in1 = $key8['total_price'];
        $precio_transf_in = number_format($precio_transf_in1, 2, '.', '');

        //echo $precio_transf_in;
        //TRANSFER OUT

        $sql9 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_out)
                    
                    WHERE to1.id = '$prueba'";


        $rs9 = Doo::db()->query($sql9);
        $transf_out = $rs9->fetchAll();

        foreach ($transf_out as $clave9 => $key9) {
            
        }

        $precio_transf_out1 = $key9['total_price'];
        $precio_transf_out = number_format($precio_transf_out1, 2, '.', '');

        //echo $precio_transf_out;

        $paquete_transfer1 = ($precio_transf_in + $precio_transf_out);

        $paquete_transfer = number_format($paquete_transfer1, 2, '.', '');

        //echo $paquete_transfer;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        //COSTOS DE HOTEL PARA ADULTOS Y NINOS

        $sql7 = "SELECT 
                    total_paid
                                        
                    FROM hotel_reserves 
                    
                    WHERE id_tours = '$prueba'";


        $rs7 = Doo::db()->query($sql7);
        $costo_hotel = $rs7->fetchAll();

        foreach ($costo_hotel as $clave6 => $key6) {
            
        }

        $total_paid_hotel = $key6['total_paid'];
        //echo  $total_paid_hotel;

        $Cantidad_personas = $adult + $child;

        //costo_hotel  promedio por persona
        $prom_hotel_1 = ($total_paid_hotel / $Cantidad_personas);
        //$prom_hotel = ($total_paid_hotel / $Cantidad_personas);
        //$prom_hotel = round($prom_hotel1,2);          
        $prom_hotel = number_format($prom_hotel_1, 4, '.', '');


        //*************************************************************************************************************  

        $sql4 = "SELECT 
                    SUM(total_paid) AS TOTAL,
                    ROUND(SUM(admission_adtul)) AS ADM_ADULT,
                    ROUND(SUM(admission_child)) AS ADM_CHILD
                    
                    FROM attraction_trafic 
                    
                    WHERE id_tours = '$prueba' AND type_tour = 'MULTI'";


        $rs4 = Doo::db()->query($sql4);
        $atracadm4 = $rs4->fetchAll();

        foreach ($atracadm4 as $clave3 => $key3) {
            
        }



        $price_total_paid = $key3['TOTAL'];
        //echo $price_total_paid;
        //echo "-";
        $prome_park = $price_total_paid / $Cantidad_personas;
        //echo $prome_park;
        //echo "-";
        $tot_parq_adult1 = $prome_park;
        $tot_parq_adult = number_format($tot_parq_adult1, 2, '.', '');
        //echo $tot_parq_adult;
        //echo "-";

        $tot_parq_child1 = $prome_park;
        $tot_parq_child = number_format($tot_parq_child1, 2, '.', '');
        //echo $tot_parq_child;
        //admisiones a parque para adultos
        //$adm_adult1   = (($key3['ADM_ADULT'])/$adult); 
        $adm_adult1 = (($key3['TOTAL']) / $adult);

        $adm_adult = number_format($adm_adult1, 2, '.', '');

        if ($child > 0) {
            //admisiones a parque para ninos
            $adm_child1 = (($key3['TOTAL']) / $child);
            $adm_child = number_format($adm_child1, 2, '.', '');
        } else {
            $adm_child = '0.00';
        }
        $transp_adult = $key3['transpor_adult'];

        $transp_child = $key3['transpor_child'];

        $rprecioA = ($tot_parq_adult + $prom_hotel) * $adult;

        $rprecioA1 = number_format($rprecioA, 2, '.', '');

        // $rprecioA1 = number_format($rprecioA, 2, '.', '');


        $rprecioC = ($tot_parq_child + $prom_hotel) * $child;
        $rprecioC1 = number_format($rprecioC, 2, '.', '');

        ////////////////////////////////////////////////////////////////////////////////////////////////////////

         $sql55 = "SELECT company_name FROM agencia 
                    
                    WHERE id = '$agencia'";


        $rs55 = Doo::db()->query($sql55);
        $agency_name = $rs55->fetchAll();

        foreach ($agency_name as $clave55 => $key55) {
            
        }
        
        $agen_name = $key55['company_name'];
        
        
        $sql5 = "SELECT op_pago FROM tours 
                    
                    WHERE id = '$prueba'";


        $rs5 = Doo::db()->query($sql5);
        $tipo_pago = $rs5->fetchAll();

        foreach ($tipo_pago as $clave4 => $key4) {
            
        }

        $op_pago = $key4['op_pago'];
        
        
        

//            if ($paquete_transfer > 0){
//                $precio_trips = 0;
//            }
        //CREDIT CARD NO FEE-FULL  // COLLECT ON BOARD
        if ($op_pago == 8) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD WITH FEE-FULL  // COLLECT ON BOARD
        if ($op_pago == 3) {

            $totalApagar5 = (($rprecioA1) + ($rprecioC1) + ($paquete_transfer) + ($precio_trips)) * 0.04;
            $totalApagar1 = number_format($totalApagar5, 2, '.', '');
        }

        //CASH-FULL // COLLECT ON BOARD
        if ($op_pago == 4) {

            $totalApagar1 = '0.00';
        }

        //CASH-FULL // PRE-PAID
        if ($op_pago == 6) {

            $totalApagar1 = '0.00';
        }

        //CREDIT VOUCHER-FULL  // VOUCHER
        if ($op_pago == 5) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD NO FEE-FULL // PRE-PAID
        if ($op_pago == 2) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD WITH FEE-FULL // PRE-PAID
        if ($op_pago == 1) {

            $totalApagar5 = (($rprecioA1) + ($rprecioC1) + ($paquete_transfer) + ($precio_trips)) * 0.04;
            $totalApagar1 = number_format($totalApagar5, 2, '.', '');
        }

        //COMPLEMENTARY-FULL // FREE SERVICES
        if ($op_pago == 7) {

            $totalApagar1 = '0.00';
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////

        $paquete_adultos_1 = ($tot_parq_adult + $prom_hotel);
        $paquete_adultos = number_format($paquete_adultos_1, 2, '.', '');

        if ($child > 0) {
            $paquete_ninos_1 = ($tot_parq_child + $prom_hotel);
            $paquete_ninos = number_format($paquete_ninos_1, 2, '.', '');
        } else {
            $paquete_ninos = '0.00';
        }

        //$totalApagar_1 = round(($rprecioA1+$transp_adult) + ($rprecioC1+$transp_child) + ($paquete_transfer) + ($totalApagar1));
        $totalApagar_1 = round($rprecioA1 + $transp_adult) + round($rprecioC1 + $transp_child) + ($paquete_transfer) + ($precio_trips) + ($total_cargo);
        $totalApagar = number_format($totalApagar_1, 2, '.', '');
//            if ($child > 0){
//            $rpromedioC = ($rprecioC1/$child);
//
//            $rpromedioC1 = number_format($rpromedioC, 2 , '.', '');
//
//            }else{
//            $rprecioC = '0.00';
//            $rpromedioC1 = '0.00';
//            $nino = '00.00';
//            $nxc = '00.00';
//            }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///resumen para agencia///


        $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <!--<img src="global/img/icono26anios.png" alt="" style="width: 25%; margin-top: -1%;" />-->
                    <img src="https://www.supertours.com/cabecera.png" alt="" style="width: 101%; height: 11%; margin-left: 0px; margin-top: 4px;" />
                    
                </div>
                
                <div id="sp-div-left" style="margin-left: 431px;">
                    <p style="font-size: 20px; margin-top: -6%;">
                        Confirmation  #:<u><b> <font style="font-size: 25px;">' . $codconf . '</font></b></u>
                    </p> 
                    
                </div>
            </div>
        </header>
       <p>
        <div id="contenido">
            <p style="font-size: 24px;  margin-left: 45%; margin-top: -2%;">
                <b>E-Ticket<b>
            </p>                                 
            <p>
                <i style="font-size: 27px; line-height: 1em;"><u><b>Passenger Information</b></u></i><br/>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u style="font-size: 20px;"><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u style="font-size: 20px;"><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u style="font-size: 20px;"><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>Multi Day Tours</b></i> </td>
                    </tr>
                    <tr style="">
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
                        <td align="left" style="line-height: 1em;">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left" style="line-height: 1em;">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>
                    </tr>
                  
                </tbody>
                
                <tbody style="border-top: 1px solid #000;">
                    <tr>
                        <td align="center">' . $fecha_retorno . '</td>
                        <td align="center">' . $trip_no2 . '</td>
                        <td align="center">' . $deptime2 . '</td>
                        <td align="left" style="line-height: 1em;">' . $from2 . '<br>' . $lugar3 . '<br>' . $direccion3 . '</td>
                        <td align="left" style="line-height: 1em;">' . $to2 . '<br>' . $lugar4 . '<br>' . $direccion4 . '</td>
                        <td align="center" style="line-height: 1em;">' . $arrtime2 . '</td>
                    </tr>
                </tbody>

            </table> <br />
            <table border="0" bgcolor= "#f7f9fc"  cellpadding="1" cellspacing="1" style="border: 1px solid #000;width: 101%;">
                <thead>               
                    <tr>                         
                        <td align="center" style="font-size: 21px;width: 38%; "> <u><b><u><i>Accomodation</i></u></b></u></td>
                        <td align="center" colspan="3" style="font-size: 21px; width: 58%; "> <i><b><u>ON REQUEST</u></b></i> </td>
                    </tr>
                </thead>               
                <tbody>
                <tr>
                    <td>&nbsp;<b>Hotel:</b> <u>' . $nombreHotel . '</u></td>   
                    <td colspan="3"><b>Address:</b>&nbsp;<u>' . $direccion . '</u></td>
                </tr>
                <tr>
                    <td style="width: 90%;" <b>&nbsp;Check in:&nbsp;</b> <u>' . $checkin . '</u>&nbsp;After:&nbsp;<u>4:00 P.M.</u></td>
                    <td style="width: 20%;" colspan="3">Check out:&nbsp;<u>' . $checkout . '</u>&nbsp;Before:&nbsp;<u>11:00 A.M.</u><br></td>
                </tr>
                <tr>
                    <td colspan="3"> &nbsp;<b># of Rooms:</b>&nbsp;<u>' . $habitacion . '</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Continental Breakfast Included:</b>&nbsp;<u>' . $addb . '</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>&nbsp;&nbsp;Buffet Breakfast Included:</b>&nbsp;<u>' . $addb1 . '</u> </td>
                    
                </tr>                  
                </tbody>
            </table> 
            <br />
            
            <table border="0" width ="550" bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;text-align: -webkit-auto;" colspan="3"> <u><b><u><i>Theme Park Selected</i></u></b></u></td>
                      
                    </tr>
                    <!--<tr>
                        <th align="center" style="width: 16%;">Theme Park</th>
                        <th align="center" style="width: 12%;">Admission Included</th>
                        <th align="center" style="width: 32%;">Transportation Included</th>                     
                    </tr>-->
                </thead>
                
                <tbody>
                    <tr>
                    
                        <td align="center">' . $table . '</td>
                        
                    </tr>
                  
                </tbody>
            </table>
            <br/>
            <!--<label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 350px;">
             
            </textarea>
            </label>-->
            
           <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                       
            <div id="caja-contenido" style="margin-left: 52%; margin-top: -41%;">
                <table border="0" width ="270"  bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="margin-left 15%;border: 1px solid #000; line-height: 1.2em;">                 
                    <tr style="margin-left:50%;">
                        <td align="left" style="">Package Price Adult:</td>
                        <td align="right">$&nbsp;' . $paquete_adultos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $rprecioA1 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="">Package Price Child:</td>
                        <td align="right">$&nbsp;' . $paquete_ninos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $rprecioC1 . '</td>                        
                    </tr>                  
                    
                    
                    <!--<tr>
                        <td align="left" style="">Trips:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $precio_trips . '</td>                        
                    </tr>-->          
                    
                    <!--<tr>
                        <td align="left" style="">Transfers:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $paquete_transfer . '</td>                        
                    </tr>-->          
                    
                    <!--<tr>
                        <td align="left" style="">Service Fee:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $total_cargo . '</td>                        
                    </tr>-->                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $total_pagado . '</td>                        
                    </tr>                  
                    
                    <!--<tr>
                        <td align="left" style="width: 44%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $balance_agencia . ' </td>                        
                    </tr> -->
                    
                    <tr>
                        <td align="left" style="width: 44%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $balance_agencia . '</td>                        
                    </tr> 
                    
                    <tr>
                        <td align="left" style="width: 46%; font-weight:bold;">Amount to Pay Driver:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right" style="font-weight:bold;">$&nbsp;' . $balance . '</td>                        
                    </tr>            
                    
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
              
                </table> 
               Thank you for traveling with Super Tours of Orlando!<br>                
            </div>
            
           
            <img src="global/img/codigo.png" alt="" style="width: 19%; margin-left: 0%; margin-top: -18%;" />
                    
           
            
        
        </div>';


        $codigoHTML.='
    
</body>
</html>';
        //echo $codigoHTML;
        Doo::loadHelper('DooPDF');
//////        
//////////////        $pdf = new DooPDF('Summary One Day Tours' . ' [' . $tipo_ticket . ' ' . ' ' . date('Y-m-d') . ']', $codigoHTML, false, 'letter', 'letter');

        $pdf = new DooPDF('Summary Multi-Day Tours'.' ('.$agen_name.') '.$codconf, $codigoHTML, false, 'letter', 'letter');
        //$font = Font_Metrics::get_font("helvetica", "bold");
        //$pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        //$pdf->doPDF();
        // ini_set("memory_limit","32M");   

        $output = $pdf->doPDF();


        

        //file_put_contents('salida.pdf', $output);
        //$archivo = $pdf;
//        $archivo = "salida.pdf"; 
//        $arch = fopen($archivo, 'w'); 
//        $contenido = $pdf->doPDF(); 
//        fwrite($arch, $contenido); 
//        echo "pdf creado"; 
//        fclose($arch); 
//        $archivo="Summary Multi-Day Tours.pdf";
//        //****************************************************
//                Doo::loadController('DatosMailController');
//               // $datosMail = new DatosMailController();
//                $mail = new PHPMailer(true);
//                
//                
//                $mail->IsSMTP();
//                $correo_emisor = "arturo@supertours.com";
//                $nombre_emisor = "Supertours Of Orlando";
//                $contrasena = "abc123";
//                //$mail->SMTPDebug  = 2;                  
//                $mail->SMTPAuth = true;
//                //$mail->SMTPSecure = "tsl";                
//                $mail->SMTPSecure = "ssl";
//                $mail->Host = "smtpout.secureserver.net";
//                $mail->Port = 465;
//                $mail->Username = $correo_emisor;
//                $mail->Password = $contrasena;
//                //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
//                $mail->SetFrom("arturo@supertours.com", $nombre_emisor);
//                $mail->Subject = 'Supertours Of Orlando, Resumen de Multi-Day Tours' . date("d-m-Y h:i:s");
//                $mail->AltBody = 'Supertours Of Orlando, Resumen de Multi-Day Tours' . date("d-m-Y h:i:s");
//                $mail->AddAddress("bustamante3@hotmail.com");
//                $mail->AddBCC("arturo.bustamante.madariaga@hotmail.com");
//                //$carpetita = 'Resumen.pdf';
//                $mail->AddAttachment($output);
//                $mail->MsgHTML($codigoHTML);
//                $mail->Send();





        $from = "arturo@supertours.com";
        $to = "bustamante3@hotmail.com";

        Doo::loadHelper('AttachMailer');
        $mailer = new AttachMailer($from, $to, "Summary Multi-Day Tours", "Se adjunta Summary Multi-Day");
        $mailer->attachFile($output);

        $resultado = ($mailer->send() ? "Enviado" : "Problemas al enviar");

        echo($resultado);
    }

    //Resumen 2
    
    
    public function resumen2() {

        Doo::loadModel("Tours");
        $prueba = $_POST['variable'];
        //echo $prueba;

        //resumen para pasajeros (Agencia)

        $sql2 = "SELECT id from reservas where id_tours='$prueba'";
        $rs2 = $this->db()->query($sql2);
        $consul2 = $rs2->fetchAll();

        foreach ($consul2 as $c => $key) {
            
        }
        //echo "/////////";
        $id_reserv = $key['id'];
        //echo $id_reserv;


        $sql = "SELECT
        r1.precio_trip1_a AS adulto,
	r1.precio_trip1_c AS nino,
	r1.totaltotal AS neto,
	r1.trip_no,
	r1.trip_no2,
	r1.fecha_retorno,
        r1.firsname AS nombre,
	r1.lasname AS apellido,
	r1.email, c2.phone,
	r1.pax AS adult,
	r1.pax2 AS child,
	r1.pax3 AS inf,
	r1.codconf,
	r1.agency,
        r1.fecha_salida,
	r1.deptime1,
	r1.deptime2,
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
	p4.address AS direccion4,
        p5.admission AS admision,
        p5.trafic AS trafic,
	p6.nombre AS parque, 
        t1.total_charge AS totalcargo,
        t1.passenger_balance_due AS balance_pasajero,
        t1.agency_balance_due AS balance_agencia,
        t1.total_paid AS total_pagado,
        t1.total AS totale,
        
	p8.buffet AS buffet,
        p8.super_breakfast AS super_breakfast,
	p8.roooms AS habitacion,
	p8.ending_date AS checkout,
	p8.starting_date AS checkin,
	p8.hotel_name AS nombreHotel,
	p9.address AS direccion
	
        
	FROM reservas r1	 
	 
	LEFT JOIN clientes c2 ON (r1.id_clientes=c2.id) 
        LEFT JOIN areas a1 ON (r1.fromt = a1.id)
        LEFT JOIN areas a2 ON (r1.tot = a2.id)
        LEFT JOIN areas a3 ON (r1.fromt2 = a3.id)
        LEFT JOIN areas a4 ON (r1.tot2 = a4.id)
        LEFT JOIN tours t1 ON (r1.id = t1.id_reserva)        
	LEFT JOIN pickup_dropoff p1 ON (r1.pickup1 = p1.id) 
        LEFT JOIN pickup_dropoff p2 ON (r1.pickup2 = p2.id)  
        LEFT JOIN pickup_dropoff p3 ON (r1.dropoff1 = p3.id)  
        LEFT JOIN pickup_dropoff p4 ON (r1.dropoff2 = p4.id)
        LEFT JOIN attraction_trafic p5 ON (r1.id_tours = p5.id_tours)
	LEFT JOIN parques p6 ON (p5.id_park = p6.id)
        
        LEFT JOIN hotel_reserves p8 ON (r1.id_tours = p8.id_tours)
        LEFT JOIN hoteles p9 ON (p8.id_hotel = p9.id)
	
	WHERE r1.id  = '$id_reserv'";

        $rs = $this->db()->query($sql);
        $consul = $rs->fetchAll();
        //print_r($consul);
        foreach ($consul as $c => $key) {
            
        }
        $buffet = $key['buffet'];
        $super = $key['super_breakfast'];
        $habitacion = $key['habitacion'];
        $checkout = $key['checkout'];
        $checkin = $key['checkin'];
        $direccion = $key['direccion'];
        $nombreHotel = $key['nombreHotel'];
        $agencia = $key['agency'];
        $adulto1 = $key['adulto'];
        $trafico = $key['trafic'];
        $totale1 = $key['totale'];
        $totale = number_format($totale1, 2, '.', '');
        $balance1 = $key['balance_pasajero'];
        $balance = number_format($balance1, 2, '.', '');
        $balance_agencia1 = $key['balance_agencia'];
        $balance_agencia = number_format($balance_agencia1, 2, '.', '');
        $total_pagado1 = $key['total_pagado'];
        $total_pagado = number_format($total_pagado1, 2, '.', '');
        $total_cargo1 = $key['totalcargo'];
        $total_cargo = number_format($total_cargo1, 2, '.', '');
        
        $amount_to_collect1 = ($totale1 + $total_cargo1);
        $amount_to_collect = number_format($amount_to_collect1, 2, '.', '');

//formateamos la variable para entregarla con dos cifras decimales
        $adulto = number_format($adulto1, 2, '.', '');
        //echo $adulto;

        $nino1 = $key['nino'];
//formateamos la variable para entregarla con dos cifras decimales
        $nino = number_format($nino1, 2, '.', '');
        $neto1 = $key['neto'];
        $neto = number_format($neto1, 2, '.', '');
        //echo $neto;

        $parque = $key['parque'];
        $admision = $key['admision'];
        ///echo $admision;
        ///**********************************************************************************
        //relacionar la tabla clientes con la tabla tours
        $sql6 = "SELECT t.code_conf AS codigo,
                t.adult AS adult,
                t.child AS child,
                c.firstname AS nombre,
                c.lastname AS apellido,
                c.username AS email,
                c.phone AS phone  FROM tours t 
                
                LEFT JOIN clientes c ON (t.id_client = c.id)
                       
                WHERE t.id = '$prueba'";


        $rs6 = Doo::db()->query($sql6);
        $datos_multi = $rs6->fetchAll();

        //print_r($datos_multi);
        foreach ($datos_multi as $clave5 => $key5) {
            
        }


        $nombre = strtoupper($key5['nombre']);
        $apellido = strtoupper($key5['apellido']);
        $email = strtolower($key5['email']);
        $phone1 = $key5['phone'];
        $codconf = $key5['codigo'];

        // Separamos en grupos de tres  
        $phone = chunk_split($phone1, 3, "");

        // Creamos un grupo de 3 digitos y tres grupos de 2 digitos  
        $num_tlf1 = substr($phone, 0, 3);
        $num_tlf2 = substr($phone, 3, 3);
        $num_tlf3 = substr($phone, 3, 4);

        $phone = "($num_tlf1) $num_tlf2-$num_tlf3";

        //Cantidad de adultos
        $adult = $key5['adult'];


        //cantidad de ninos        
        $child = $key5['child'];

        //************************************************************************************ 
        $axa1 = ($adulto1 * $adult);

        $axa = number_format($axa1, 2, '.', '');
        //echo $axa;
        //el precio de los parques de cada adulto y ninio
        $precioAdult = $key['entradaAdult'];
        $precioChild = $key['entradaChild'];
        $precioA = number_format($precioAdult, 2, '.', '');

        $nxc1 = ($nino1 * $child);
        $nxc = number_format($nxc1, 2, '.', '');

        //precio de los adultos
        //echo 'precio por unidad mas valor de la transportacion adultos ',$rprecioA1, '<br/>'; 
        $rpomedioA = ($rprecioA1 / $adult);
        $rpomedioA1 = number_format($rpomedioA, 2, '.', '');

        $totalApagar = ($rprecioA1 + $rprecioC1);
        $totalApagar1 = number_format($totalApagar, 2, '.', '');




        $tipo_ticket = $key['tipo_ticket'];
//$tipo_ticket = strtoupper($key['tipo_ticket']);
//Primera letra en Mayuscula
        $ticket_oneway = ucwords($key['tipo_ticket']);



        if ($child == 0) {
            $child = '0';
            $nino = '0.00';
            $nxc = '0.00';
        }

        if ($email == '') {
            $email = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        if ($phone == '') {
            $phone = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }



        if ($buffet == '1') {
            $addb = "YES";
        } else {
            $addb = "NO";
        }
        if ($super == '1') {
            $addb1 = "YES";
            $addb = "NO";
        } else {
            $addb1 = "NO";
            $addb = "YES";
        }

        ////////////////////////////////////////////////////////////////////TABLA DE CONSULTA DE PARQUES////////////////////////////////


        $sql3 = "SELECT p1.nombre as PARQUE,
                g1.nombre AS GRUPO,
                a1.adult,
                a1.child,
                a1.admission_adtul,
                a1.admission_child,
                a1.totalTraspor,
                a1.v_p_adult,
                a1.v_p_child,
                a1.total_paid,
                a1.admission AS admision,         
                a1.trafic AS trafic,  
                a1.cantidad 
                FROM attraction_trafic a1
                LEFT JOIN parques p1 on (a1.id_park = p1.id)
                LEFT JOIN grupo_parques g1 on (a1.group = g1.id)
                WHERE a1.id_tours = '$prueba' AND a1.type_tour = 'MULTI'";

        $rs3 = Doo::db()->query($sql3);
        $atracadm3 = $rs3->fetchAll();



        $table = "<table  align='center' style='text-align: center;width: 300%;border: transparent; line-height: 0.8em;'>";
        $table .="<tr>
                            <td style='' height='4'><b>Theme Park</b></td>                 
                            <td><b>Admission Included</b></td>                 
                            <td><b>Transportation Included</b></td>
                      </tr>";


        foreach ($atracadm3 as $clave2 => $key2) {

            if ($key2['admision'] == '1') {
                $add2 = "YES";
                //echo $add;
            } else {
                $add2 = "NO";
                //echo $add;
            }

            if ($key2['trafic'] == '1') {
                $traf2 = "YES";
                //echo $add;
            } else {
                $traf2 = "NO";
                //echo $add;
            }
            $table .="<tr> <td align='left'>" . $key2["PARQUE"] . "</td> <td>" . $add2 . "</td><td>" . $traf2 . "</td></tr>";
        }
        $table .= "</table>";

        // COSTOS PARA TRIPS 1 Y 2

        $sql10 = "SELECT 
                    r2.totaltotal,
                    r2.trip_no,
                    r2.trip_no2,
                    r2.deptime1,
                    r2.deptime2,
                    r2.arrtime1,
                    r2.arrtime2,
                    r2.fecha_salida,
                    r2.fecha_retorno, 
                    r2.tipo_ticket,
                    a5.nombre AS FROM1,
                    a6.nombre AS TO1,
                    a7.nombre AS FROM2,
                    a8.nombre AS TO2,
                    p11.place AS lugar1,
                    p11.address AS direccion1,
                    p22.place AS lugar2,
                    p22.address AS direccion2,
                    p33.place AS lugar3,
                    p33.address AS direccion3,
                    p44.place AS lugar4,
                    p44.address AS direccion4


                    FROM reservas r2

                    LEFT JOIN areas a5 ON (r2.fromt = a5.id)
                    LEFT JOIN areas a6 ON (r2.tot = a6.id)
                    LEFT JOIN areas a7 ON (r2.fromt2 = a7.id)
                    LEFT JOIN areas a8 ON (r2.tot2 = a8.id)


                    LEFT JOIN pickup_dropoff p11 ON (r2.pickup1 = p11.id) 
                    LEFT JOIN pickup_dropoff p22 ON (r2.pickup2 = p22.id)  
                    LEFT JOIN pickup_dropoff p33 ON (r2.dropoff1 = p33.id)  
                    LEFT JOIN pickup_dropoff p44 ON (r2.dropoff2 = p44.id)
                    
                    LEFT JOIN attraction_trafic p55 ON (r2.id_tours = p55.id_tours)
                    LEFT JOIN parques p66 ON (p55.id_park = p66.id)

                    
                    
                    WHERE codconf = '$codconf'";


        $rs10 = Doo::db()->query($sql10);
        $prc_trips = $rs10->fetchAll();

//$clave10 =>
        foreach ($prc_trips as  $key10) {
            
        }

        $tipo_ticket = $key10['tipo_ticket'];
        $precio_trips1 = $key10['totaltotal'];
        $precio_trips = number_format($precio_trips1, 2, '.', '');
        //echo $precio_trips;

        if ($tipo_ticket != 'roundtrip') {
            $fecha_salida = '';
            $fecha_retorno = '';
            $deptime1 = '';
            $deptime2 = '';
            $deptime3 = '';
            $deptime4 = '';
            $from1 = '';
            $to1 = '';
            $from2 = '';
            $to2 = '';
        } else {
            $fecha_salida1 = $key10['fecha_salida'];
            $fecha_salida2 = strtotime($fecha_salida1);
            $fecha_salida = date('m/d/Y', $fecha_salida2);

            $lugar1 = $key10['lugar1'];
            $direccion1 = $key10['direccion1'];

            $lugar2 = $key10['lugar2'];
            $direccion2 = $key10['direccion2'];

            $trip_no = $key10['trip_no'];
            $trip_no2 = $key10['trip_no2'];

            $fecha_retorno1 = $key10['fecha_retorno'];
            $fecha_retorno2 = strtotime($fecha_retorno1);
            $fecha_retorno = date('m/d/Y', $fecha_retorno2);

            $lugar3 = $key10['lugar3'];
            $direccion3 = $key10['direccion3'];
            //cambiar formato de hora a AM / PM
            $deptime1 = date("g:i a", strtotime($key10['deptime1']));
            $deptime2 = date("g:i a", strtotime($key10['deptime2']));
            $arrtime1 = date("g:i a", strtotime($key10['arrtime1']));
            $arrtime2 = date("g:i a", strtotime($key10['arrtime2']));

            $lugar4 = $key10['lugar4'];
            $direccion4 = $key10['direccion4'];
            //$trip_no2 = $key10['trip_no2'];

            $from1 = $key10['FROM1'];
            $to1 = $key10['TO1'];
            $from2 = $key10['FROM2'];
            $to2 = $key10['TO2'];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        //COSTOS PARA TRANSFERS (PLANE & CAR)
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        //TRANSFER IN

        $sql8 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_in)
                    
                    WHERE to1.id = '$prueba'";


        $rs8 = Doo::db()->query($sql8);
        $transf_in = $rs8->fetchAll();

        foreach ($transf_in as $clave8 => $key8) {
            
        }

        $precio_transf_in1 = $key8['total_price'];
        $precio_transf_in = number_format($precio_transf_in1, 2, '.', '');

        //echo $precio_transf_in;
        //TRANSFER OUT

        $sql9 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_out)
                    
                    WHERE to1.id = '$prueba'";


        $rs9 = Doo::db()->query($sql9);
        $transf_out = $rs9->fetchAll();

        foreach ($transf_out as $clave9 => $key9) {
            
        }

        $precio_transf_out1 = $key9['total_price'];
        $precio_transf_out = number_format($precio_transf_out1, 2, '.', '');

        //echo $precio_transf_out;

        $paquete_transfer1 = ($precio_transf_in + $precio_transf_out);

        $paquete_transfer = number_format($paquete_transfer1, 2, '.', '');

        //echo $paquete_transfer;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        //COSTOS DE HOTEL PARA ADULTOS Y NINOS

        $sql7 = "SELECT 
                    total_paid
                                        
                    FROM hotel_reserves 
                    
                    WHERE id_tours = '$prueba'";


        $rs7 = Doo::db()->query($sql7);
        $costo_hotel = $rs7->fetchAll();

        foreach ($costo_hotel as $clave6 => $key6) {
            
        }

        $total_paid_hotel = $key6['total_paid'];
        //echo  $total_paid_hotel;

        $Cantidad_personas = $adult + $child;

        //costo_hotel  promedio por persona
        $prom_hotel_1 = ($total_paid_hotel / $Cantidad_personas);
        //$prom_hotel = ($total_paid_hotel / $Cantidad_personas);
        //$prom_hotel = round($prom_hotel1,2);          
        $prom_hotel = number_format($prom_hotel_1, 4, '.', '');


        //*************************************************************************************************************  

        $sql4 = "SELECT 
                    SUM(total_paid) AS TOTAL,
                    ROUND(SUM(admission_adtul)) AS ADM_ADULT,
                    ROUND(SUM(admission_child)) AS ADM_CHILD
                    
                    FROM attraction_trafic 
                    
                    WHERE id_tours = '$prueba' AND type_tour = 'MULTI'";


        $rs4 = Doo::db()->query($sql4);
        $atracadm4 = $rs4->fetchAll();

        foreach ($atracadm4 as $clave3 => $key3) {
            
        }



        $price_total_paid = $key3['TOTAL'];
        //echo $price_total_paid;
        //echo "-";
        $prome_park = $price_total_paid / $Cantidad_personas;
        //echo $prome_park;
        //echo "-";
        $tot_parq_adult1 = $prome_park;
        $tot_parq_adult = number_format($tot_parq_adult1, 2, '.', '');
        //echo $tot_parq_adult;
        //echo "-";

        $tot_parq_child1 = $prome_park;
        $tot_parq_child = number_format($tot_parq_child1, 2, '.', '');
        //echo $tot_parq_child;
        //admisiones a parque para adultos
        //$adm_adult1   = (($key3['ADM_ADULT'])/$adult); 
        $adm_adult1 = (($key3['TOTAL']) / $adult);

        $adm_adult = number_format($adm_adult1, 2, '.', '');

        if ($child > 0) {
            //admisiones a parque para ninos
            $adm_child1 = (($key3['TOTAL']) / $child);
            $adm_child = number_format($adm_child1, 2, '.', '');
        } else {
            $adm_child = '0.00';
        }
        $transp_adult = $key3['transpor_adult'];

        $transp_child = $key3['transpor_child'];

        $rprecioA = ($tot_parq_adult + $prom_hotel) * $adult;

        $rprecioA1 = number_format($rprecioA, 2, '.', '');

        // $rprecioA1 = number_format($rprecioA, 2, '.', '');


        $rprecioC = ($tot_parq_child + $prom_hotel) * $child;
        $rprecioC1 = number_format($rprecioC, 2, '.', '');

        ////////////////////////////////////////////////////////////////////////////////////////////////////////

        $sql5 = "SELECT op_pago FROM tours 
                    
                    WHERE id = '$prueba'";


        $rs5 = Doo::db()->query($sql5);
        $tipo_pago = $rs5->fetchAll();

        foreach ($tipo_pago as $clave4 => $key4) {
            
        }

        $op_pago = $key4['op_pago'];

//            if ($paquete_transfer > 0){
//                $precio_trips = 0;
//            }
        //CREDIT CARD NO FEE-FULL  // COLLECT ON BOARD
        if ($op_pago == 8) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD WITH FEE-FULL  // COLLECT ON BOARD
        if ($op_pago == 3) {

            $totalApagar5 = (($rprecioA1) + ($rprecioC1) + ($paquete_transfer) + ($precio_trips)) * 0.04;
            $totalApagar1 = number_format($totalApagar5, 2, '.', '');
        }

        //CASH-FULL // COLLECT ON BOARD
        if ($op_pago == 4) {

            $totalApagar1 = '0.00';
        }

        //CASH-FULL // PRE-PAID
        if ($op_pago == 6) {

            $totalApagar1 = '0.00';
        }

        //CREDIT VOUCHER-FULL  // VOUCHER
        if ($op_pago == 5) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD NO FEE-FULL // PRE-PAID
        if ($op_pago == 2) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD WITH FEE-FULL // PRE-PAID
        if ($op_pago == 1) {

            $totalApagar5 = (($rprecioA1) + ($rprecioC1) + ($paquete_transfer) + ($precio_trips)) * 0.04;
            $totalApagar1 = number_format($totalApagar5, 2, '.', '');
        }

        //COMPLEMENTARY-FULL // FREE SERVICES
        if ($op_pago == 7) {

            $totalApagar1 = '0.00';
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////

        $paquete_adultos_1 = ($tot_parq_adult + $prom_hotel);
        $paquete_adultos = number_format($paquete_adultos_1, 2, '.', '');

        if ($child > 0) {
            $paquete_ninos_1 = ($tot_parq_child + $prom_hotel);
            $paquete_ninos = number_format($paquete_ninos_1, 2, '.', '');
        } else {
            $paquete_ninos = '0.00';
        }

        //$totalApagar_1 = round(($rprecioA1+$transp_adult) + ($rprecioC1+$transp_child) + ($paquete_transfer) + ($totalApagar1));
        $totalApagar_1 = round($rprecioA1 + $transp_adult) + round($rprecioC1 + $transp_child) + ($paquete_transfer) + ($precio_trips) + ($totalApagar1);
        $totalApagar = number_format($totalApagar_1, 2, '.', '');
//            if ($child > 0){
//            $rpromedioC = ($rprecioC1/$child);
//
//            $rpromedioC1 = number_format($rpromedioC, 2 , '.', '');
//
//            }else{
//            $rprecioC = '0.00';
//            $rpromedioC1 = '0.00';
//            $nino = '00.00';
//            $nxc = '00.00';
//            }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//resumen para pasajero con agencia////

        $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <!--<img src="global/img/icono26anios.png" alt="" style="width: 25%; margin-top: -1%;" />-->
                    <img src="https://www.supertours.com/cabecera.png" alt="" style="width: 101%; height: 11%; margin-left: 0px; margin-top: 4px;" />
                    
                </div>
                <div id="sp-div-left" style="margin-left: 431px;">
                    <p style="font-size: 20px; margin-top: -6%;">
                        Confirmation  #:<u><b> <font style="font-size: 25px;">' . $codconf . '</font></b></u>
                    </p> 
                    
                </div>
            </div>
        </header>
       <p>
        <div id="contenido">
            <p style="font-size: 24px;  margin-left: 45%; margin-top: -2%;">
                <b>E-Ticket<b>
            </p>                                 
            <p>
                <i style="font-size: 27px; line-height: 1em;"><u><b>Passenger Information</b></u></i><br/>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u style="font-size: 20px;"><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u style="font-size: 20px;"><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u style="font-size: 20px;"><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>Multi Day Tours</b></i> </td>
                    </tr>
                    <tr style="">
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
                        <td align="left" style="line-height: 1em;">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left" style="line-height: 1em;">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>
                    </tr>
                  
                </tbody>
                
                <tbody style="border-top: 1px solid #000;">
                    <tr>
                        <td align="center">' . $fecha_retorno . '</td>
                        <td align="center">' . $trip_no2 . '</td>
                        <td align="center">' . $deptime2 . '</td>
                        <td align="left" style="line-height: 1em;">' . $from2 . '<br>' . $lugar3 . '<br>' . $direccion3 . '</td>
                        <td align="left" style="line-height: 1em;">' . $to2 . '<br>' . $lugar4 . '<br>' . $direccion4 . '</td>
                        <td align="center" style="line-height: 1em;">' . $arrtime2 . '</td>
                    </tr>
                </tbody>

            </table> <br />
            <table border="0" bgcolor= "#f7f9fc"  cellpadding="1" cellspacing="1" style="border: 1px solid #000;width: 101%;">
                <thead>               
                    <tr>                         
                        <td align="center" style="font-size: 21px;width: 38%; "> <u><b><u><i>Accomodation</i></u></b></u></td>
                        <td align="center" colspan="3" style="font-size: 21px; width: 58%; "> <i><b><u>ON REQUEST</u></b></i> </td>
                    </tr>
                </thead>               
                <tbody>
                <tr>
                    <td>&nbsp;<b>Hotel:</b> <u>' . $nombreHotel . '</u></td>   
                    <td colspan="3"><b>Address:</b>&nbsp;<u>' . $direccion . '</u></td>
                </tr>
                <tr>
                    <td style="width: 90%;" <b>&nbsp;Check in:&nbsp;</b> <u>' . $checkin . '</u>&nbsp;After:&nbsp;<u>4:00 P.M.</u></td>
                    <td style="width: 20%;" colspan="3">Check out:&nbsp;<u>' . $checkout . '</u>&nbsp;Before:&nbsp;<u>11:00 A.M.</u><br></td>
                </tr>
                <tr>
                    <td colspan="3"> &nbsp;<b># of Rooms:</b>&nbsp;<u>' . $habitacion . '</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Continental Breakfast Included:</b>&nbsp;<u>' . $addb . '</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>&nbsp;&nbsp;Buffet Breakfast Included:</b>&nbsp;<u>' . $addb1 . '</u> </td>
                    
                </tr>                  
                </tbody>
            </table> 
            <br />
            
            <table border="0" width ="550" bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;text-align: -webkit-auto;" colspan="3"> <u><b><u><i>Theme Park Selected</i></u></b></u></td>
                      
                    </tr>
                    <!--<tr>
                        <th align="center" style="width: 16%;">Theme Park</th>
                        <th align="center" style="width: 12%;">Admission Included</th>
                        <th align="center" style="width: 32%;">Transportation Included</th>                     
                    </tr>-->
                </thead>
                
                <tbody>
                    <tr>
                    
                        <td align="center">' . $table . '</td>
                        
                    </tr>
                  
                </tbody>
            </table>
            <br/>
            <!--<label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 350px;">
             
            </textarea>
            </label>-->
            
           <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                       
            <div id="caja-contenido" style="display:none; margin-left: 52%; margin-top: -41%;">
                <table border="0" width ="270"  bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="margin-left 15%;border: 1px solid #000; line-height: 1.2em;">                 
                    <tr style="margin-left:50%;">
                        <td align="left" style="">Package Price Adult:</td>
                        <td align="right">$&nbsp;' . $paquete_adultos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $rprecioA1 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="">Package Price Child:</td>
                        <td align="right">$&nbsp;' . $paquete_ninos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $rprecioC1 . '</td>                        
                    </tr>                  
                    
                    
                    <tr>
                        <td align="left" style="">Trips:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $precio_trips . '</td>                        
                    </tr>          
                    
                    <tr>
                        <td align="left" style="">Transfers:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $paquete_transfer . '</td>                        
                    </tr>          
                    
                    <tr>
                        <td align="left" style="">Service Fee:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $total_cargo . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $total_pagado . '</td>                        
                    </tr>                  
                    
                    
                    
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
              
                </table> 
               Thank you for traveling with Super Tours of Orlando!<br>                
            </div>
            
           
            <img src="global/img/codigo.png" alt="" style="width: 19%; margin-left: 603px; margin-top: 0%;" />
                    
           
            
        
        </div>';


        $codigoHTML.='
    
</body>
</html>';
        //echo $codigoHTML;
       Doo::loadHelper('DooPDF');
//////        
//////////////        $pdf = new DooPDF('Summary One Day Tours' . ' [' . $tipo_ticket . ' ' . ' ' . date('Y-m-d') . ']', $codigoHTML, false, 'letter', 'letter');

        $pdf = new DooPDF('Summary Multi-Day Tours Passenger'.' - '.$codconf, $codigoHTML, false, 'letter', 'letter');
        //$font = Font_Metrics::get_font("helvetica", "bold");
        //$pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        $pdf->doPDF();
        // ini_set("memory_limit","32M");   

        $output = $pdf->doPDF();


        

        //file_put_contents('salida.pdf', $output);
        //$archivo = $pdf;
//        $archivo = "salida.pdf"; 
//        $arch = fopen($archivo, 'w'); 
//        $contenido = $pdf->doPDF(); 
//        fwrite($arch, $contenido); 
//        echo "pdf creado"; 
//        fclose($arch); 
//        $archivo="Summary Multi-Day Tours.pdf";
//        //****************************************************
//                Doo::loadController('DatosMailController');
//               // $datosMail = new DatosMailController();
//                $mail = new PHPMailer(true);
//                
//                
//                $mail->IsSMTP();
//                $correo_emisor = "arturo@supertours.com";
//                $nombre_emisor = "Supertours Of Orlando";
//                $contrasena = "abc123";
//                //$mail->SMTPDebug  = 2;                  
//                $mail->SMTPAuth = true;
//                //$mail->SMTPSecure = "tsl";                
//                $mail->SMTPSecure = "ssl";
//                $mail->Host = "smtpout.secureserver.net";
//                $mail->Port = 465;
//                $mail->Username = $correo_emisor;
//                $mail->Password = $contrasena;
//                //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
//                $mail->SetFrom("arturo@supertours.com", $nombre_emisor);
//                $mail->Subject = 'Supertours Of Orlando, Resumen de Multi-Day Tours' . date("d-m-Y h:i:s");
//                $mail->AltBody = 'Supertours Of Orlando, Resumen de Multi-Day Tours' . date("d-m-Y h:i:s");
//                $mail->AddAddress("bustamante3@hotmail.com");
//                $mail->AddBCC("arturo.bustamante.madariaga@hotmail.com");
//                //$carpetita = 'Resumen.pdf';
//                $mail->AddAttachment($output);
//                $mail->MsgHTML($codigoHTML);
//                $mail->Send();





        $from = "arturo@supertours.com";
        $to = "bustamante3@hotmail.com";

        Doo::loadHelper('AttachMailer');
        $mailer = new AttachMailer($from, $to, "Summary Multi-Day Tours", "Se adjunta Summary Multi-Day");
        $mailer->attachFile($output);

        $resultado = ($mailer->send() ? "Enviado" : "Problemas al enviar");

        echo($resultado);
    }
    //Resumen para pasajeros de SuperTours
    public function resumen3() {

        Doo::loadModel("Tours");
        $prueba = $_POST['variable'];
        //echo $prueba;



        $sql2 = "SELECT id from reservas where id_tours='$prueba'";
        $rs2 = $this->db()->query($sql2);
        $consul2 = $rs2->fetchAll();

        foreach ($consul2 as $c => $key) {
            
        }
        
        $id_reserv = $key['id'];
        //echo $id_reserv;


        $sql = "SELECT
        r1.precio_trip1_a AS adulto,
	r1.precio_trip1_c AS nino,
	r1.totaltotal AS neto,
	r1.trip_no,
	r1.trip_no2,
	r1.fecha_retorno,
        r1.firsname AS nombre,
	r1.lasname AS apellido,
	r1.email,
        c2.phone,
	r1.pax AS adult,
	r1.pax2 AS child,
	r1.pax3 AS inf,
	r1.codconf,
	r1.agency,
        r1.fecha_salida,
	r1.deptime1,
	r1.deptime2,
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
	p4.address AS direccion4,
        p5.admission AS admision,
        p5.trafic AS trafic,
	p6.nombre AS parque, 
        
	p8.buffet AS buffet,
        p8.super_breakfast AS super_breakfast,
	p8.roooms AS habitacion,
	p8.ending_date AS checkout,
	p8.starting_date AS checkin,
	p8.hotel_name AS nombreHotel,
        t1.total_charge AS totalcargo,
        t1.passenger_balance_due AS balance_pasajero,
        t1.agency_balance_due AS balance_agencia,
        t1.total_paid AS total_pagado,
        t1.otheramount AS other,
        t1.total AS totale,
	p9.address AS direccion
	
        
	FROM reservas r1	 
	 
	LEFT JOIN clientes c2 ON (r1.id_clientes=c2.id) 
        LEFT JOIN areas a1 ON (r1.fromt = a1.id)
        LEFT JOIN areas a2 ON (r1.tot = a2.id)
        LEFT JOIN areas a3 ON (r1.fromt2 = a3.id)
        LEFT JOIN areas a4 ON (r1.tot2 = a4.id)
        LEFT JOIN tours t1 ON (r1.id = t1.id_reserva)
	LEFT JOIN pickup_dropoff p1 ON (r1.pickup1 = p1.id) 
        LEFT JOIN pickup_dropoff p2 ON (r1.pickup2 = p2.id)  
        LEFT JOIN pickup_dropoff p3 ON (r1.dropoff1 = p3.id)  
        LEFT JOIN pickup_dropoff p4 ON (r1.dropoff2 = p4.id)
        LEFT JOIN attraction_trafic p5 ON (r1.id_tours = p5.id_tours)
	LEFT JOIN parques p6 ON (p5.id_park = p6.id)     
        LEFT JOIN hotel_reserves p8 ON (r1.id_tours = p8.id_tours)        
        LEFT JOIN hoteles p9 ON (p8.id_hotel = p9.id)
        
	
	WHERE r1.id  = '$id_reserv'";

        $rs = $this->db()->query($sql);
        $consul = $rs->fetchAll();
        //print_r($consul);
        foreach ($consul as $c => $key) {
            
        }
        $buffet = $key['buffet'];
        $super = $key['super_breakfast'];
        $habitacion = $key['habitacion'];
        $checkout = $key['checkout'];
        $checkin = $key['checkin'];
        $direccion = $key['direccion'];
        $nombreHotel = $key['nombreHotel'];
        $agencia = $key['agency'];
        $adulto1 = $key['adulto'];
        $trafico = $key['trafic'];        
        $other_amount = $key['other'];
        $totale1 = $key['totale'];
        $totale = number_format($totale1, 2, '.', '');
        $balance1 = $key['balance_pasajero'];
        $balance = number_format($balance1, 2, '.', '');
        $balance_agencia1 = $key['balance_agencia'];
        $balance_agencia = number_format($balance_agencia1, 2, '.', '');
        $total_pagado1 = $key['total_pagado'];
        $total_pagado = number_format($total_pagado1, 2, '.', '');
        $total_charge1 = $key['totalcargo'];
        

        /*FLOOR (REDONDEA) PCCWF (PAGOS CON CREDIT CARD WITH FEE)*/
        $sql30 = "SELECT SUM(pagado) AS PCCWF FROM tours_pago WHERE id_tours = '$prueba' AND pago='CREDIT CARD WITH FEE' AND tipo_pago='COLLECT ON BOARD' AND tipo='MULTI'";
        $rs30 = Doo::db()->query($sql30);
        $pagosccwf = $rs30->fetchAll();

   
        foreach ($pagosccwf as $pccwf) {
   
        }
        
        $pago_ccwf = $pccwf['PCCWF']; 
        $pago_sinccwf = ($pccwf['PCCWF']) / 1.04;
        $cargos1 = $pago_ccwf - $pago_sinccwf;
        //$cargos = number_format($cargos1, 2, '.', '');
        
        $total_cargo1 = $total_charge1 + $cargos1;
        $total_cargo = number_format($total_cargo1, 2, '.', '');
        
        
        if($other_amount > 0){
            
            $amount_to_collect1 = ($other_amount + $cargos1);
            $amount_to_collect = number_format($amount_to_collect1, 2, '.', '');
            
        }
        
        if($other_amount == 0){
            
            $amount_to_collect1 = ($totale1 + $total_cargo1);
            $amount_to_collect = number_format($amount_to_collect1, 2, '.', '');
            
        }
        
        
//formateamos la variable para entregarla con dos cifras decimales
        $adulto = number_format($adulto1, 2, '.', '');
        //echo $adulto;

        $nino1 = $key['nino'];
//formateamos la variable para entregarla con dos cifras decimales
        $nino = number_format($nino1, 2, '.', '');
        $neto1 = $key['neto'];
        $neto = number_format($neto1, 2, '.', '');
        //echo $neto;

        $parque = $key['parque'];
        $admision = $key['admision'];
        ///echo $admision;
        ///**********************************************************************************
        //relacionar la tabla clientes con la tabla tours
        $sql6 = "SELECT t.code_conf AS codigo,
                t.adult AS adult,
                t.child AS child,
                c.firstname AS nombre,
                c.lastname AS apellido,
                c.username AS email,
                c.phone AS phone  FROM tours t 
                
                LEFT JOIN clientes c ON (t.id_client = c.id)
                       
                WHERE t.id = '$prueba'";


        $rs6 = Doo::db()->query($sql6);
        $datos_multi = $rs6->fetchAll();

        //print_r($datos_multi);
        foreach ($datos_multi as $clave5 => $key5) {
            
        }


        $nombre = strtoupper($key5['nombre']);
        $apellido = strtoupper($key5['apellido']);
        $email = strtolower($key5['email']);
        $phone1 = $key5['phone'];
        $codconf = $key5['codigo'];

        // Separamos en grupos de tres  
        $phone = chunk_split($phone1, 3, "");

        // Creamos un grupo de 3 digitos y tres grupos de 2 digitos  
        $num_tlf1 = substr($phone, 0, 3);
        $num_tlf2 = substr($phone, 3, 3);
        $num_tlf3 = substr($phone, 3, 4);

        $phone = "($num_tlf1) $num_tlf2-$num_tlf3";

        //Cantidad de adultos
        $adult = $key5['adult'];


        //cantidad de ninos        
        $child = $key5['child'];

        //************************************************************************************ 
        $axa1 = ($adulto1 * $adult);

        $axa = number_format($axa1, 2, '.', '');
        //echo $axa;
        //el precio de los parques de cada adulto y ninio
        $precioAdult = $key['entradaAdult'];
        $precioChild = $key['entradaChild'];
        $precioA = number_format($precioAdult, 2, '.', '');

        $nxc1 = ($nino1 * $child);
        $nxc = number_format($nxc1, 2, '.', '');

        //precio de los adultos
        //echo 'precio por unidad mas valor de la transportacion adultos ',$rprecioA1, '<br/>'; 
        $rpomedioA = ($rprecioA1 / $adult);
        $rpomedioA1 = number_format($rpomedioA, 2, '.', '');

        $totalApagar = ($rprecioA1 + $rprecioC1);
        $totalApagar1 = number_format($totalApagar, 2, '.', '');




        $tipo_ticket = $key['tipo_ticket'];
//$tipo_ticket = strtoupper($key['tipo_ticket']);
//Primera letra en Mayuscula
        $ticket_oneway = ucwords($key['tipo_ticket']);



        if ($child == 0) {
            $child = '0';
            $nino = '0.00';
            $nxc = '0.00';
        }

        if ($email == '') {
            $email = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        if ($phone == '') {
            $phone = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }



        if ($buffet == '1') {
            $addb = "YES";
        } else {
            $addb = "NO";
        }
        if ($super == '1') {
            $addb1 = "YES";
            $addb = "NO";
        } else {
            $addb1 = "NO";
            $addb = "YES";
        }

        ////////////////////////////////////////////////////////////////////TABLA DE CONSULTA DE PARQUES////////////////////////////////


        $sql3 = "SELECT p1.nombre as PARQUE,
                g1.nombre AS GRUPO,
                a1.adult,
                a1.child,
                a1.admission_adtul,
                a1.admission_child,
                a1.totalTraspor,
                a1.v_p_adult,
                a1.v_p_child,
                a1.total_paid,
                a1.admission AS admision,         
                a1.trafic AS trafic,  
                a1.cantidad 
                FROM attraction_trafic a1
                LEFT JOIN parques p1 on (a1.id_park = p1.id)
                LEFT JOIN grupo_parques g1 on (a1.group = g1.id)
                WHERE a1.id_tours = '$prueba' AND a1.type_tour = 'MULTI'";

        $rs3 = Doo::db()->query($sql3);
        $atracadm3 = $rs3->fetchAll();



        $table = "<table  align='center' style='text-align: center;width: 300%;border: transparent; line-height: 0.8em;'>";
        $table .="<tr>
                            <td style='' height='4'><b>Theme Park</b></td>                 
                            <td><b>Admission Included</b></td>                 
                            <td><b>Transportation Included</b></td>
                      </tr>";


        foreach ($atracadm3 as $clave2 => $key2) {

            if ($key2['admision'] == '1') {
                $add2 = "YES";
                //echo $add;
            } else {
                $add2 = "NO";
                //echo $add;
            }

            if ($key2['trafic'] == '1') {
                $traf2 = "YES";
                //echo $add;
            } else {
                $traf2 = "NO";
                //echo $add;
            }
            $table .="<tr> <td align='left'>" . $key2["PARQUE"] . "</td> <td>" . $add2 . "</td><td>" . $traf2 . "</td></tr>";
        }
        $table .= "</table>";

        // COSTOS PARA TRIPS 1 Y 2

        $sql10 = "SELECT 
                    r2.totaltotal,
                    r2.trip_no,
                    r2.trip_no2,
                    r2.deptime1,
                    r2.deptime2,
                    r2.arrtime1,
                    r2.arrtime2,
                    r2.fecha_salida,
                    r2.fecha_retorno, 
                    r2.tipo_ticket,
                    a5.nombre AS FROM1,
                    a6.nombre AS TO1,
                    a7.nombre AS FROM2,
                    a8.nombre AS TO2,
                    p11.place AS lugar1,
                    p11.address AS direccion1,
                    p22.place AS lugar2,
                    p22.address AS direccion2,
                    p33.place AS lugar3,
                    p33.address AS direccion3,
                    p44.place AS lugar4,
                    p44.address AS direccion4


                    FROM reservas r2

                    LEFT JOIN areas a5 ON (r2.fromt = a5.id)
                    LEFT JOIN areas a6 ON (r2.tot = a6.id)
                    LEFT JOIN areas a7 ON (r2.fromt2 = a7.id)
                    LEFT JOIN areas a8 ON (r2.tot2 = a8.id)


                    LEFT JOIN pickup_dropoff p11 ON (r2.pickup1 = p11.id) 
                    LEFT JOIN pickup_dropoff p22 ON (r2.pickup2 = p22.id)  
                    LEFT JOIN pickup_dropoff p33 ON (r2.dropoff1 = p33.id)  
                    LEFT JOIN pickup_dropoff p44 ON (r2.dropoff2 = p44.id)
                    
                    LEFT JOIN attraction_trafic p55 ON (r2.id_tours = p55.id_tours)
                    LEFT JOIN parques p66 ON (p55.id_park = p66.id)

                    
                    
                    WHERE codconf = '$codconf'";


        $rs10 = Doo::db()->query($sql10);
        $prc_trips = $rs10->fetchAll();


        foreach ($prc_trips as $clave10 => $key10) {
            
        }

        $tipo_ticket = $key10['tipo_ticket'];
        $precio_trips1 = $key10['totaltotal'];
        $precio_trips = number_format($precio_trips1, 2, '.', '');
        //echo $precio_trips;

        if ($tipo_ticket != 'roundtrip') {
            $fecha_salida = '';
            $fecha_retorno = '';
            $deptime1 = '';
            $deptime2 = '';
            $deptime3 = '';
            $deptime4 = '';
            $from1 = '';
            $to1 = '';
            $from2 = '';
            $to2 = '';
        } else {
            $fecha_salida1 = $key10['fecha_salida'];
            $fecha_salida2 = strtotime($fecha_salida1);
            $fecha_salida = date('m/d/Y', $fecha_salida2);

            $lugar1 = $key10['lugar1'];
            $direccion1 = $key10['direccion1'];

            $lugar2 = $key10['lugar2'];
            $direccion2 = $key10['direccion2'];

            $trip_no = $key10['trip_no'];
            $trip_no2 = $key10['trip_no2'];

            $fecha_retorno1 = $key10['fecha_retorno'];
            $fecha_retorno2 = strtotime($fecha_retorno1);
            $fecha_retorno = date('m/d/Y', $fecha_retorno2);

            $lugar3 = $key10['lugar3'];
            $direccion3 = $key10['direccion3'];
            //cambiar formato de hora a AM / PM
            $deptime1 = date("g:i a", strtotime($key10['deptime1']));
            $deptime2 = date("g:i a", strtotime($key10['deptime2']));
            $arrtime1 = date("g:i a", strtotime($key10['arrtime1']));
            $arrtime2 = date("g:i a", strtotime($key10['arrtime2']));

            $lugar4 = $key10['lugar4'];
            $direccion4 = $key10['direccion4'];
            //$trip_no2 = $key10['trip_no2'];

            $from1 = $key10['FROM1'];
            $to1 = $key10['TO1'];
            $from2 = $key10['FROM2'];
            $to2 = $key10['TO2'];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        //COSTOS PARA TRANSFERS (PLANE & CAR)
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        //TRANSFER IN

        $sql8 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_in)
                    
                    WHERE to1.id = '$prueba'";


        $rs8 = Doo::db()->query($sql8);
        $transf_in = $rs8->fetchAll();

        foreach ($transf_in as $clave8 => $key8) {
            
        }

        $precio_transf_in1 = $key8['total_price'];
        $precio_transf_in = number_format($precio_transf_in1, 2, '.', '');

        //echo $precio_transf_in;
        //TRANSFER OUT

        $sql9 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_out)
                    
                    WHERE to1.id = '$prueba'";


        $rs9 = Doo::db()->query($sql9);
        $transf_out = $rs9->fetchAll();

        foreach ($transf_out as $clave9 => $key9) {
            
        }

        $precio_transf_out1 = $key9['total_price'];
        $precio_transf_out = number_format($precio_transf_out1, 2, '.', '');

        //echo $precio_transf_out;

        $paquete_transfer1 = ($precio_transf_in + $precio_transf_out);

        $paquete_transfer = number_format($paquete_transfer1, 2, '.', '');

        //echo $paquete_transfer;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        //COSTOS DE HOTEL PARA ADULTOS Y NINOS

        $sql7 = "SELECT 
                    total_paid
                                        
                    FROM hotel_reserves 
                    
                    WHERE id_tours = '$prueba'";


        $rs7 = Doo::db()->query($sql7);
        $costo_hotel = $rs7->fetchAll();

        foreach ($costo_hotel as $clave6 => $key6) {
            
        }

        $total_paid_hotel = $key6['total_paid'];
        //echo  $total_paid_hotel;

        $Cantidad_personas = $adult + $child;

        //costo_hotel  promedio por persona
        $prom_hotel_1 = ($total_paid_hotel / $Cantidad_personas);
        //$prom_hotel = ($total_paid_hotel / $Cantidad_personas);
        //$prom_hotel = round($prom_hotel1,2);          
        $prom_hotel = number_format($prom_hotel_1, 4, '.', '');


        //*************************************************************************************************************  

        $sql4 = "SELECT 
                    SUM(total_paid) AS TOTAL,
                    ROUND(SUM(admission_adtul)) AS ADM_ADULT,
                    ROUND(SUM(admission_child)) AS ADM_CHILD
                    
                    FROM attraction_trafic 
                    
                    WHERE id_tours = '$prueba' AND type_tour = 'MULTI'";


        $rs4 = Doo::db()->query($sql4);
        $atracadm4 = $rs4->fetchAll();

        foreach ($atracadm4 as $clave3 => $key3) {
            
        }



        $price_total_paid = $key3['TOTAL'];
        //echo $price_total_paid;
        //echo "-";
        $prome_park = $price_total_paid / $Cantidad_personas;
        //echo $prome_park;
        //echo "-";
        $tot_parq_adult1 = $prome_park;
        $tot_parq_adult = number_format($tot_parq_adult1, 2, '.', '');
        //echo $tot_parq_adult;
        //echo "-";

        $tot_parq_child1 = $prome_park;
        $tot_parq_child = number_format($tot_parq_child1, 2, '.', '');
        //echo $tot_parq_child;
        //admisiones a parque para adultos
        //$adm_adult1   = (($key3['ADM_ADULT'])/$adult); 
        $adm_adult1 = (($key3['TOTAL']) / $adult);

        $adm_adult = number_format($adm_adult1, 2, '.', '');

        if ($child > 0) {
            //admisiones a parque para ninos
            $adm_child1 = (($key3['TOTAL']) / $child);
            $adm_child = number_format($adm_child1, 2, '.', '');
        } else {
            $adm_child = '0.00';
        }
        $transp_adult = $key3['transpor_adult'];

        $transp_child = $key3['transpor_child'];

        $rprecioA = ($tot_parq_adult + $prom_hotel) * $adult;

        $rprecioA1 = number_format($rprecioA, 2, '.', '');

        // $rprecioA1 = number_format($rprecioA, 2, '.', '');


        $rprecioC = ($tot_parq_child + $prom_hotel) * $child;
        $rprecioC1 = number_format($rprecioC, 2, '.', '');

        ////////////////////////////////////////////////////////////////////////////////////////////////////////

         $sql55 = "SELECT company_name FROM agencia 
                    
                    WHERE id = '$agencia'";


        $rs55 = Doo::db()->query($sql55);
        $agency_name = $rs55->fetchAll();

        foreach ($agency_name as $clave55 => $key55) {
            
        }
        
        $agen_name = $key55['company_name'];
        
        
        $sql5 = "SELECT op_pago FROM tours 
                    
                    WHERE id = '$prueba'";


        $rs5 = Doo::db()->query($sql5);
        $tipo_pago = $rs5->fetchAll();

        foreach ($tipo_pago as $clave4 => $key4) {
            
        }

        $op_pago = $key4['op_pago'];
        
        
        

//            if ($paquete_transfer > 0){
//                $precio_trips = 0;
//            }
        //CREDIT CARD NO FEE-FULL  // COLLECT ON BOARD
        if ($op_pago == 8) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD WITH FEE-FULL  // COLLECT ON BOARD
        if ($op_pago == 3) {

            $totalApagar5 = (($rprecioA1) + ($rprecioC1) + ($paquete_transfer) + ($precio_trips)) * 0.04;
            $totalApagar1 = number_format($totalApagar5, 2, '.', '');
        }

        //CASH-FULL // COLLECT ON BOARD
        if ($op_pago == 4) {

            $totalApagar1 = '0.00';
        }

        //CASH-FULL // PRE-PAID
        if ($op_pago == 6) {

            $totalApagar1 = '0.00';
        }

        //CREDIT VOUCHER-FULL  // VOUCHER
        if ($op_pago == 5) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD NO FEE-FULL // PRE-PAID
        if ($op_pago == 2) {

            $totalApagar1 = '0.00';
        }

        //CREDIT CARD WITH FEE-FULL // PRE-PAID
        if ($op_pago == 1) {

            $totalApagar5 = (($rprecioA1) + ($rprecioC1) + ($paquete_transfer) + ($precio_trips)) * 0.04;
            $totalApagar1 = number_format($totalApagar5, 2, '.', '');
        }

        //COMPLEMENTARY-FULL // FREE SERVICES
        if ($op_pago == 7) {

            $totalApagar1 = '0.00';
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////

        $paquete_adultos_1 = ($tot_parq_adult + $prom_hotel);
        $paquete_adultos = number_format($paquete_adultos_1, 2, '.', '');

        if ($child > 0) {
            $paquete_ninos_1 = ($tot_parq_child + $prom_hotel);
            $paquete_ninos = number_format($paquete_ninos_1, 2, '.', '');
        } else {
            $paquete_ninos = '0.00';
        }

        //$totalApagar_1 = round(($rprecioA1+$transp_adult) + ($rprecioC1+$transp_child) + ($paquete_transfer) + ($totalApagar1));
        $totalApagar_1 = round($rprecioA1 + $transp_adult) + round($rprecioC1 + $transp_child) + ($paquete_transfer) + ($precio_trips) + ($total_cargo);
        $totalApagar = number_format($totalApagar_1, 2, '.', '');
//            if ($child > 0){
//            $rpromedioC = ($rprecioC1/$child);
//
//            $rpromedioC1 = number_format($rpromedioC, 2 , '.', '');
//
//            }else{
//            $rprecioC = '0.00';
//            $rpromedioC1 = '0.00';
//            $nino = '00.00';
//            $nxc = '00.00';
//            }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///resumen para agencia///


        $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <!--<img src="global/img/icono26anios.png" alt="" style="width: 25%; margin-top: -1%;" />-->
                    <img src="https://www.supertours.com/cabecera.png" alt="" style="width: 101%; height: 11%; margin-left: 0px; margin-top: 4px;" />
                    
                </div>
                
                <div id="sp-div-left" style="margin-left: 431px;">
                    <p style="font-size: 20px; margin-top: -6%;">
                        Confirmation  #:<u><b> <font style="font-size: 25px;">' . $codconf . '</font></b></u>
                    </p> 
                    
                </div>
            </div>
        </header>
       <p>
        <div id="contenido">
            <p style="font-size: 24px;  margin-left: 45%; margin-top: -2%;">
                <b>E-Ticket<b>
            </p>                                 
            <p>
                <i style="font-size: 27px; line-height: 1em;"><u><b>Passenger Information</b></u></i><br/>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u style="font-size: 20px;"><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u style="font-size: 20px;"><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u style="font-size: 20px;"><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;"> <u><b><u><i>Itinerary</i></u></b></u></td>
                        <td align="center" colspan="5" style="font-size: 21px; width: 15%;"> <i><b>Multi Day Tours</b></i> </td>
                    </tr>
                    <tr style="">
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
                        <td align="left" style="line-height: 1em;">' . $from1 . '<br>' . $lugar1 . '<br>' . $direccion1 . '</td>
                        <td align="left" style="line-height: 1em;">' . $to1 . '<br>' . $lugar2 . '<br>' . $direccion2 . '</td>
                        <td align="center">' . $arrtime1 . '</td>
                    </tr>
                  
                </tbody>
                
                <tbody style="border-top: 1px solid #000;">
                    <tr>
                        <td align="center">' . $fecha_retorno . '</td>
                        <td align="center">' . $trip_no2 . '</td>
                        <td align="center">' . $deptime2 . '</td>
                        <td align="left" style="line-height: 1em;">' . $from2 . '<br>' . $lugar3 . '<br>' . $direccion3 . '</td>
                        <td align="left" style="line-height: 1em;">' . $to2 . '<br>' . $lugar4 . '<br>' . $direccion4 . '</td>
                        <td align="center" style="line-height: 1em;">' . $arrtime2 . '</td>
                    </tr>
                </tbody>

            </table> <br />
            <table border="0" bgcolor= "#f7f9fc"  cellpadding="1" cellspacing="1" style="border: 1px solid #000;width: 101%;">
                <thead>               
                    <tr>                         
                        <td align="center" style="font-size: 21px;width: 38%; "> <u><b><u><i>Accomodation</i></u></b></u></td>
                        <td align="center" colspan="3" style="font-size: 21px; width: 58%; "> <i><b><u>ON REQUEST</u></b></i> </td>
                    </tr>
                </thead>               
                <tbody>
                <tr>
                    <td>&nbsp;<b>Hotel:</b> <u>' . $nombreHotel . '</u></td>   
                    <td colspan="3"><b>Address:</b>&nbsp;<u>' . $direccion . '</u></td>
                </tr>
                <tr>
                    <td style="width: 90%;" <b>&nbsp;Check in:&nbsp;</b> <u>' . $checkin . '</u>&nbsp;After:&nbsp;<u>4:00 P.M.</u></td>
                    <td style="width: 20%;" colspan="3">Check out:&nbsp;<u>' . $checkout . '</u>&nbsp;Before:&nbsp;<u>11:00 A.M.</u><br></td>
                </tr>
                <tr>
                    <td colspan="3"> &nbsp;<b># of Rooms:</b>&nbsp;<u>' . $habitacion . '</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Continental Breakfast Included:</b>&nbsp;<u>' . $addb . '</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>&nbsp;&nbsp;Buffet Breakfast Included:</b>&nbsp;<u>' . $addb1 . '</u> </td>
                    
                </tr>                  
                </tbody>
            </table> 
            <br />
            
            <table border="0" width ="550" bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
                <thead>
               
                    <tr>                         
                        <td align="center" style="font-size: 21px; width: 25%;text-align: -webkit-auto;" colspan="3"> <u><b><u><i>Theme Park Selected</i></u></b></u></td>
                      
                    </tr>
                    <!--<tr>
                        <th align="center" style="width: 16%;">Theme Park</th>
                        <th align="center" style="width: 12%;">Admission Included</th>
                        <th align="center" style="width: 32%;">Transportation Included</th>                     
                    </tr>-->
                </thead>
                
                <tbody>
                    <tr>
                    
                        <td align="center">' . $table . '</td>
                        
                    </tr>
                  
                </tbody>
            </table>
            <br/>
            <!--<label for=""><b><i>Important Information:</i></b><br /></p>
            <textarea cols="" rows="" value="" style="border: 2px solid #000; width: 50%; height: 350px;">
             
            </textarea>
            </label>-->
            
           <style type="text/css"> 
                table { border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px} 
                </style>
                       
            <div id="caja-contenido" style="margin-left: 52%; margin-top: -41%;">
                <table border="0" width ="270"  bgcolor= "#f7f9fc" cellpadding="1" cellspacing="1" id="tabla" style="margin-left 15%;border: 1px solid #000; line-height: 1.2em;">                 
                    <tr style="margin-left:50%;">
                        <td align="left" style="">Package Price Adult:</td>
                        <td align="right">$&nbsp;' . $paquete_adultos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $rprecioA1 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="">Package Price Child:</td>
                        <td align="right">$&nbsp;' . $paquete_ninos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $child . '</td>
                        <td align="right">$&nbsp;' . $rprecioC1 . '</td>                        
                    </tr>                  
                    
                    
                    <!--<tr>
                        <td align="left" style="">Trips:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $precio_trips . '</td>                        
                    </tr>-->         
                    
                    <!--<tr>
                        <td align="left" style="">Transfers:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $paquete_transfer . '</td>                        
                    </tr>-->          
                    
                    <!--<tr>
                        <td align="left" style="">Service Fee:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $total_cargo . '</td>                        
                    </tr>-->                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $total_pagado . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44.5%;">Balance:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $balance . ' </td>                        
                    </tr> 
                    
                                        
                   
                    <tr>
                        <th colspan="5">Reservation is Non-Refundable</th>                                             
                    </tr>                  
                    
              
                </table> 
               Thank you for traveling with Super Tours of Orlando!<br>                
            </div>
            
           
            <img src="global/img/codigo.png" alt="" style="width: 19%; margin-left: 0%; margin-top: -16%;" />
                    
           
            
        
        </div>';


        $codigoHTML.='
    
</body>
</html>';
        //echo $codigoHTML;
        Doo::loadHelper('DooPDF');
//////        
//////////////        $pdf = new DooPDF('Summary One Day Tours' . ' [' . $tipo_ticket . ' ' . ' ' . date('Y-m-d') . ']', $codigoHTML, false, 'letter', 'letter');

        $pdf = new DooPDF('Summary Multi-Day Tours'.' ('.$agen_name.') '.$codconf, $codigoHTML, false, 'letter', 'letter');
        //$font = Font_Metrics::get_font("helvetica", "bold");
        //$pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        //$pdf->doPDF();
        // ini_set("memory_limit","32M");   

        $output = $pdf->doPDF();


        

        //file_put_contents('salida.pdf', $output);
        //$archivo = $pdf;
//        $archivo = "salida.pdf"; 
//        $arch = fopen($archivo, 'w'); 
//        $contenido = $pdf->doPDF(); 
//        fwrite($arch, $contenido); 
//        echo "pdf creado"; 
//        fclose($arch); 
//        $archivo="Summary Multi-Day Tours.pdf";
//        //****************************************************
//                Doo::loadController('DatosMailController');
//               // $datosMail = new DatosMailController();
//                $mail = new PHPMailer(true);
//                
//                
//                $mail->IsSMTP();
//                $correo_emisor = "arturo@supertours.com";
//                $nombre_emisor = "Supertours Of Orlando";
//                $contrasena = "abc123";
//                //$mail->SMTPDebug  = 2;                  
//                $mail->SMTPAuth = true;
//                //$mail->SMTPSecure = "tsl";                
//                $mail->SMTPSecure = "ssl";
//                $mail->Host = "smtpout.secureserver.net";
//                $mail->Port = 465;
//                $mail->Username = $correo_emisor;
//                $mail->Password = $contrasena;
//                //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
//                $mail->SetFrom("arturo@supertours.com", $nombre_emisor);
//                $mail->Subject = 'Supertours Of Orlando, Resumen de Multi-Day Tours' . date("d-m-Y h:i:s");
//                $mail->AltBody = 'Supertours Of Orlando, Resumen de Multi-Day Tours' . date("d-m-Y h:i:s");
//                $mail->AddAddress("bustamante3@hotmail.com");
//                $mail->AddBCC("arturo.bustamante.madariaga@hotmail.com");
//                //$carpetita = 'Resumen.pdf';
//                $mail->AddAttachment($output);
//                $mail->MsgHTML($codigoHTML);
//                $mail->Send();





        $from = "arturo@supertours.com";
        $to = "bustamante3@hotmail.com";

        Doo::loadHelper('AttachMailer');
        $mailer = new AttachMailer($from, $to, "Summary Multi-Day Tours", "Se adjunta Summary Multi-Day");
        $mailer->attachFile($output);

        $resultado = ($mailer->send() ? "Enviado" : "Problemas al enviar");

        echo($resultado);
    }

    
    public function delete() {
        Doo::loadModel("Tours");
        $tour = new Tours();
        $tour->id = $_REQUEST['item'];
        Doo::db()->delete($tour);
        return Doo::conf()->APP_URL . "admin/tours";
    }

    public function loadCategories() {
        echo '';
    }

    public function roomsCount() {
        try {
            //cuenta el numero de numero de cuartos.
            if (isset($this->params["num"])) {
                $rooms = $this->params["num"];
                echo '<ul> ';
                for ($i = 1; $i <= $rooms; $i++) {
                    echo '<li> ';
                    echo '
                    <table border="0"  id="tours-list" >
						      <tr>
							  	 <td align="center" rowspan="2" class="label" style="float: none;">Room ' . $i . '</td>
                                 <td align="center" class="label" style="float: none;">Adult</td>
                                 <td align="center" class="label" style="float: none;">Child</td>
							  </tr>
							  <tr>
							  	<td>
							       <select name="adults' . $i . '" id="adults' . $i . '" class="select">
								        <option value="1" >1</option>
										<option value="2" selected>2</option>
										<option value="3">3</option>
										<option value="4">4</option>
								   </select>
								</td>
								<td>
								    <select name="childs' . $i . '" id="childs' . $i . '" class="select">
									    <option value="0" selected >0</option>
									    <option value="1" >1</option>
										<option value="2">2</option>
									</select>
								</td>
							  </tr>
					</table>

					<script>
						  $("#adults' . $i . '").change(function(){
						  		var num2 = $("#adults' . $i . '").val();
								var num3 = $("#childs' . $i . '").val();
								$("#childs' . $i . '").load("' . Doo::conf()->APP_URL . 'admin/tours/rooms2/" + num2 + "/" + num3);
						  });

						  $("#childs' . $i . '").change(function(){
    							var num4 = $("#childs' . $i . '").val();
								var num5 = $("#adults' . $i . '").val();
								$("#adults' . $i . '").load("' . Doo::conf()->APP_URL . 'admin/tours/rooms3/" + num4 + "/" + num5);
						  });

						  /*$("")*/
    				</script>
							  ';
                    echo '</li> ';
                }
                echo '</ul> ';
            }

            //numero de adultos
            if (isset($this->params["num2"]) && isset($this->params["num3"])) {

                $number = $this->params["num2"];
                $number2 = $this->params["num3"];

                if ($number == 4) {
                    echo '<option value="0">0</option>';
                } else {
                    $dato = 4 - $number;
                    for ($i = 0; $i <= $dato; $i++) {
                        echo '<option value="' . $i . '" ' . ($i == trim($number2) ? 'selected' : '') . '>' . $i . '</option>';
                    }
                }
            }
        } catch (Exception $e) {
            //procedimiento en caso de reportar errores
        }

        //numero de niños.
        if (isset($this->params["num4"]) && isset($this->params["num5"])) {

            $number = $this->params["num4"];
            $number2 = $this->params["num5"];

            if ($number == 3) {
                echo '<option value="1">1</option>';
            } else {
                $dato = 4 - $number;
                for ($i = 1; $i <= $dato; $i++) {
                    echo '<option value="' . $i . '" ' . ($i == trim($number2) ? 'selected' : '') . ' >' . $i . '</option>';
                }
            }
        }
    }

    public function getDaysNights() {

        list($mes, $dia, $año) = explode("-", $this->params["salida"]);

        $llegada = $año . "-" . $mes . "-" . $dia;

        if (isset($this->params["retorno"])) {
            list($mes2, $dia2, $año2) = explode("-", $this->params["retorno"]);
            $salida = $año2 . "-" . $mes2 . "-" . $dia2;
        }
        $dias = (strtotime($llegada) - strtotime($salida)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias) + 1;
        $noches = $dias - 1;

        echo "<script type='text/javascript'>
            $('#days').val(" . $dias . ");
            $('#nights').val(" . $noches . ");
        </script>";
    }

    public function selectParks() {
        try {
            $categoria = $this->params["cat"];
            $fecha_llegada = $this->params["inicio"];
            $fecha_salida = $this->params["fin"];

            $sql = "SELECT id,codigo,categoria,nombre,address,city,zipcode,contacname,phone,email,webpage,breakfast,resoftfe,description,image1
							  FROM hoteles
						WHERE id  NOT IN (SELECT id_hotel FROM  ratesblock WHERE  fecha_ini >=  $fecha_llegada AND fecha_fin <= $fecha_salida )
						AND categoria = $categoria ";
            $rs = Doo::db()->query($sql);

            $hoteles = $rs->fetchAll();
            $contador = 0;
            $hidden = "hidden";
            $hotel = "hotel";
            foreach ($hoteles as $datos) {
                echo '
                    <table width="100%" border="0" id="tablap" >
					  <tr>
						<td colspan="4" height="30" >&nbsp;&nbsp;&nbsp;<font color="#003399" >' . $datos['nombre'] . '&nbsp;' . ($datos["categoria"] == 3 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/3.png"  border="0" />' : '') . '</font> </td>
					  </tr>
					  <tr>
						<td width="11" height="106" rowspan="2">&nbsp;</td>
						<td width="176" height="106" rowspan="2"><div align="left"><img src="' . Doo::conf()->APP_URL . $datos['image1'] . '"  width="200" height="119" border="0"  /></div></td>
						<td width="4" rowspan="2">&nbsp;</td>
						<td height="82" colspan="2"><div align="center" style="text-align:justify" >' . $datos['description'] . '</div></td>
						<td height="82">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="299" height="21"><font color="#006633">' . ($datos["breakfast"] == 1 ? 'Free Breakfast' : '') . '</font></td>
						<td width="265">
						    <div id="choice" align="right"  >
						        <button class="btn" h-id="' . $datos["id"] . '" h-nombre="' . $datos["nombre"] . '" id="btn-continue" value="' . $datos['id'] . '" name="hotel" >SELECT</button>
						    </div>
						</td>
						<td width="10">&nbsp;</td>
					  </tr>
					<td width="11">&nbsp;</td>
					</table>
					';
                if ($datos["breakfast"] == 1) {
                    echo
                    '<script type="text/javascript">
                        $(function(){
                            $("#hotel-breakfast ").val("YES");
                        });
                    </script>';
                } else {
                    echo
                    '<script type="text/javascript">
                        $(function(){
                            $("#hotel-breakfast ").val("NO");
                        });
                    </script>';
                }
                if ($datos["resoftfe"] == 1) {
                    echo
                    '<script type="text/javascript">
                        $(function(){
                            $("#hotel-resort").val("YES");
                        });
                    </script>';
                } else {
                    echo '<script type="text/javascript">
                        $(function(){
                            $("#hotel-resort").val("NO");
                        });
                    </script>';
                }
                $contador++;
            }
            echo '<script type="text/javascript">
		  $(document).ready(function() {
             $("#btn-continue").click(function(){
                    var id = $(this).attr("h-id");
                    var nombre = $(this).attr("h-nombre");
                    $("#hotel-selection .field").val(nombre);
                    $("#hotel-id").val(id);
                    $("P.close A").click();
            });
        });
		</script>';
        } catch (Exception $e) {
            //procedimiento en caso de reportar errores
        }
    }

    public function ajaxcliente2() {

        $id = $this->params["id"];
        $pertenece = $this->params["id2"];

        if ($pertenece == 'leader') {
            $rs = Doo::db()->query("SELECT  id,username,firstname,lastname,phone FROM  clientes	WHERE id = ? ", array($id));
            $datos = $rs->fetch();

            echo "<script>
				  $('#firstname').val('" . $datos['firstname'] . "');
				  $('#lastname').val('" . $datos['lastname'] . "');
				  $('#phone').val('" . $datos['phone'] . "');
				  $('#email').val('" . $datos['username'] . "');
				
		  </script>";
        }
        if ($pertenece == 'acompany') {
            echo "<script>$('#uagency').removeAttr('disabled');</script>";
        }
    }

    public function trips() {
        if (isset($this->params["from"]) && isset($this->params["to"]) && isset($this->params["fecha"])) {

            $from = $this->params["from"];
            $to = $this->params["to"];
            $fecha_salida = $this->params["fecha"];

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
                         where t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' ORDER BY t2.trip_departure ASC";

            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));
            $salida = $rs->fetchAll();
            //print_r($salida);

            echo '<script type="text/javascript" src="' . Doo::conf()->APP_URL . 'global/js/jquery.form.js"></script>';
            echo '<form name="formu" id="formu" action="' . Doo::conf()->APP_URL . 'admin/tours/consul/trips/poner" method="post">';
            echo
            '<table class="grid">
                    <thead>
                        <tr>
                            <th width="8%">Select</th>
                            <th width="8%">Trip</th>
                            <th width="12%">Departure</th>
                            <th width="11%">Arrive</th>
                            <th width="16%"></th>
                            <th width="22%"></th>
                            <th width="20%">Equipment</th>
                        </tr>
                    </thead>';

            if (count($salida) > 0) {
                foreach ($salida as $e) {
                    echo '<tr>
                    <td><input type="radio" name="trip1"  value="' . $e['id'] . '" /><input name="fecha" type="hidden" value="' . $fecha_salida . '" /></td>
                    <td>' . $e['trip_no'] . '</td>
                    <td>' . date("g:i a", strtotime($e['trip_departure'])) . '</td>
                    <td>' . date("g:i a", strtotime($e['trip_arrival'])) . '</td>
                    <td></td>
                    <td></td>
                    <td>' . $e['equipment'] . '</td>
                    <td ></td>
                </tr>';
                }
            } else {
                echo
                '<tr>
                  <td colspan="7">No tours available</td> 
                </tr>';
            }
            echo ' </table>';

            echo
            '<input type="hidden" id="type" name="type" value = "' . $this->params["type"] . '">
                <p align="right">
                    <button  class="btn" id="btn-continue">Continue</button>
                </p>
		        <div id="con"></div>
		    </form>';
            echo '<script>
		
		  $(document).ready(function() {
             $("#btn-continue").click(function(){
				   $("#formu").ajaxForm({
							target: "#con",
							success: function()
								  {
									 $("P.close A").click();
								  }
					}).submit();
            });

        });
		</script>';
        }
    }

    public function trips2() {
        $trip1 = $_POST['trip1'];
        $fecha = $_POST['fecha'];
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


        $rs = Doo::db()->query($sql, array($trip1, $fecha));
        $dato = $rs->fetch();

        $departure1 = date("h:i A", strtotime($dato['trip_departure']));
        $arrival1 = date("h:i A", strtotime($dato['trip_arrival']));

        $type = $_POST['type'];
        if ($type == "arrival") {
            echo "<script> $('#a-trip_no').val('" . $dato['trip_no'] . "'); </script>";
        } else {
            echo "<script> $('#d-trip_no').val('" . $dato['trip_no'] . "'); </script>";
        }
    }

    public function getExten($area) {
        $sql = "SELECT id,place,address
                FROM extension
				WHERE id_area = ?";
        $rs = Doo::db()->query($sql, array($area));
        $extenciones = $rs->fetchAll();
        return $extenciones;
    }

    public function exten() {
        $id = $this->params["id"];
        $extenciones = $this->getExten($id);
        echo "<option value='0'> </option>";
        foreach ($extenciones as $resul) {
            echo "<option value='" . $resul['id'] . "'>" . $resul['place'] . "' '" . $resul['address'] . " </option>";
        }
    }

    public function parksSelection() {
        try {
            $category = $this->params["park"];
            $sql = "CALL sp_parks_category('" . $category . "')";
            $rs = Doo::db()->query($sql);
            $parques = $rs->fetchAll();
            $rs->closeCursor();

            echo "<ul>";
            foreach ($parques as $parque) {
                echo "
                <li>
                    <div id='park'>
                        <div id='imagen'><img src='" . Doo::conf()->APP_URL . $parque["image1"] . "'/></div>
                        <div id='nombre'>" . $parque["nombre"] . "</div>
                        <div id='descripcion'>" . $parque["description"] . "</div>
                        <div id='seleccionar'><button name='parque' id='btn-continue' p-name='" . $parque["nombre"] . "' p-id='" . $parque["id"] . "' p-adult='" . $parque["adult"] . "' p-id='" . $parque["child"] . "'>SELECT</button></div>
                    <div/>
                </li>";
            }
            echo "</ul>";
            echo '<script>
		        $(document).ready(function() {
                    $("#btn-continue").click(function(){
                        id = $(this).attr("p-id");
                        child = $(this).attr("p-child");
                        adult = $(this).attr("p-adult");
                        nombre = $(this).attr("p-name");
                        grupo = = $(this).attr("p-group");
                        admision = = $(this).attr("p-admission");
                        $("#park-selection .field").val(nombre);
                        $("#park-id").val(id);

                        $($this).addTraffic();

                        //$(this).totalTour();
                        $("P.close A").click();
                    });
                });
		        </script>';
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function typeTranspor1() {
        $url = Doo::conf()->APP_URL;
        $id = $this->params["id"];
        if ($id == 0) {
            $sql = "SELECT DISTINCT t1.trip_to AS id, t2.nombre
				FROM routes t1
				LEFT JOIN areas t2 ON ( t1.trip_to = t2.id ) 
				WHERE t1.trip_from =1";
            $rs = Doo::db()->query($sql);
            $to_areas = $rs->fetchAll();
            //Area de los parques: defaul orlando
            $sql = "SELECT t2.id, t2.nombre  FROM areas t2
							WHERE t2.id = 1";
            $rs = Doo::db()->query($sql);
            $area_park = $rs->fetchAll();

            echo '
                                    <table width="100%"><tr>
                                    	<td>
                                        <div id="div_from">
                                         <div class="label" style="color: #fff;font-size: 12px;">FROM</div>
                                            <select style="width:190px" name="from" id="from" class="select"  onchange="change_from();">
                                                <option value="0"></option>';
            foreach ($to_areas as $e) {
                echo '<option value="' . $e["id"] . '">' . $e["nombre"] . '</option>';
            }

            echo '                      </select>
                                            <input name="sarrival" type="hidden"  value="1"/>

                                        </div>
                                   	 	</td>
                                        <td>
                                        	     
                                        <div id="div_to">
                                            <div class="label" style="color: #fff;font-size: 12px;">TO</div>
                                            <select style="width:190px" name="to" id="to" class="select">';
            foreach ($area_park as $e) {
                echo '<option value="' . $e["id"] . '">' . $e["nombre"] . '</option>';
            }

            echo '                         </select>
                                        </div>
                                        </td>
                                        <td>
                                        	<div id="trip">
                                           
                                            <div class="label" style="color: #fff;font-size: 12px;">TRIP</div>
                                   <table><tr><td>
                                    <span><input class="field" name="a_trip_no" type="text" id="a_trip_no" size="3" maxlength="3" value="" readonly="readonly"/></span></td>
                                    <td>
      <a><i style="cursor:pointer; color: #fff; font-size: 23px;" id="popup1" onclick="mostrarTrip1()" class="fa fa-search-plus"></i></a>                              

<img id="popup1" style="cursor:pointer; display: none;" src="' . $url . 'global/images/search.png"/>
                                            </td></tr></table>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td width="100%" colspan="3">
                                        <div id="pick-drop">
                                            <div class="label" style="color: #fff;font-size: 12px;">PICK UP POINT/ADDRESS</div>
                                            <div  style="width:100%" class="ausu-suggest">
                                                <input name="a_pickup4" style="width:100%" disabled="disabled" class="field" type="text" id="a_pickup1" autocomplete="off" maxlength="55" value=""/>
                                                <input name="a_id_pickup1" type="hidden" id="a_id_pickup1" maxlength="55" value="-1"/>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="3">
                                        	<table width="100%">
                                            	<tr>
                                    	<td width="25%" style="color: #fff;font-size: 12px;">
                                            EXTENSION AREA: 
                                        </td>
                                        <td>
              <select name="ext_from1" id="ext_from1" class="select" style="width:200px;"  onchange="change_ext_from1();"> </select>
                                           
                                
                                        </td>
                                        <td>&nbsp;</td>
										  <td width="15%">
                                         <div id="rooms">
                                    <div class="label" style="color: #fff;font-size: 12px;">LUGGAGE</div>
                                            <span><input name="a_luggage" type="text" id="a_luggage" size="2" maxlength="2" value=""
                                                         class="field"/></span>
                                        </div>
                                        </td>
                                        <td width="15%">
                                         <div id="rooms">
                                    <div class="label" style="color: #fff;font-size: 12px;">ROOM #</div>
                                            <span><input name="a_room1" type="text" id="a_room1" size="2" value=""
                                                         class="field"/></span>
                                        </div>
                                        </td>
                                    </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="3">
                                        	<div style="width:100%" id="ex_pick_drop">
                                            <div class="label" style="color: #fff;font-size: 12px;">EXTENTION DROPOFF POINT/ADDRESS</div>
                                            <div style="width:100%" class="ausu-suggest">
                                                                                            <input name="a_pickup2" style="width:100%" disabled="disabled"  class="field" type="text" id="a_pickup2" maxlength="55" value=""/>
                                              <input name="a_id_pickup2" type="hidden" id="a_id_pickup2" maxlength="55" value=""/>                                              </span></div>
                                        </div>
                                        </td>
                                    </tr>
                                    </table>
                                    <script>	
					$.fn.autosugguest({
                                            className: "ausu-suggest",
                                            methodType: "POST",
                                            minChars: 1,
                                            rtnIDs: true,
                                            dataFile: "' . $url . 'admin/tours/loaddatos"
                                        });	
				    </script>
			   
			   ';
        } else if ($id == 1) {
            echo '<table width="381" border="0">
					  <tr >
						<td>&nbsp;</td>
						<td colspan="4" style="color: #fff;font-size: 12px;">&iquest;At what time you wish your private service leaves Miami?</td>
						<td width="29"><label>
							<input  autocomplete="off" name="hora1" type="text" id="hora1" value="" size="6" class="required"/>
						</label></td>
						<td width="29"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center" style="color: #fff;font-size: 12px;">&iquest;From where in Miami?</div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58" style="color: #fff;font-size: 12px;">City:</td>
						<td width="113"><input  autocomplete="off" name="city" type="text" id="city" size="25" class="required"  /></td>
						<td width="114"></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2" style="color: #fff;font-size: 12px;">Address:</td>
						<td height="2"><input  autocomplete="off" name="address" type="text" id="address" size="25" class="required" /></td>
						<td height="2"></td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3" style="color: #fff;font-size: 12px;">Zip Code:</td>
						<td height="3"><input  autocomplete="off" name="zipcode" type="text" id="zipcode" size="25" class="required"/></td>
						<td height="3"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7" style="color: #fff;font-size: 12px;">Phone #:</td>
						<td height="7"><input  autocomplete="off" name="phone" type="text" id="phone" size="25" class="required" /></td>
						<td height="7"></td>
					  </tr>
					</table>
						   
						<script> 	
						$("#hora1").timeEntry().change(function() { 
								var log = $("#log"); 
								log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
								
								$("#hora2").val($("#hora1").val());
							});
						$("#city").keyup(function(){ 
							$("#city2").val($("#city").val());
					 	});
						$("#address").keyup(function(){ 
							$("#address2").val($("#address").val());
					 	});
						$("#zipcode").keyup(function(){ 
							$("#zipcode2").val($("#zipcode").val());
					 	});
						$("#phone").keyup(function(){ 
							$("#phone2").val($("#phone").val());
					 	});
						
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>';
        } else if ($id == 2) {
            echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2">&nbsp;</td>
						<td width="29"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td> <div align="left" style="color: #fff;font-size: 12px;">Airline:</div></td><td><label>
						  <input  autocomplete="off" type="text" name="airlinearrival" id="airlinearrival"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left" style="color: #fff;font-size: 12px;">Flight #:</div></td>
						<td><input  autocomplete="off" type="text" name="flightarrival" id="flightarrival"  class="required"/>
						  </td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="89"> <div align="left" style="color: #fff;font-size: 12px;">Arrival Time:</div></td>
						<td width="279"><input  autocomplete="off" name="hora1" type="text" id="hora1" size="6"  class="required"/>
						</td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
					
					
					<script> 
					
						$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>';
        } else if ($id == 3) {
            echo '<table width="381" border="0">
					  <tr>
						<td colspan="3">&nbsp;</td>
						<td width="36"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="77" height="7">&nbsp;</td>
						<td width="211"><div align="left" style="color: #fff;font-size: 12px;">Estimated arrival time to Orlando:</div></td>
						<td>
                                                <label>
						  <input  autocomplete="off" name="hora1" type="text" id="hora1" size="6" class="required"/>
						</label>
                                                </td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td width="128">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="2" colspan="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3" colspan="2">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
						
						<script> 
						$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>';
        }
    }

    public function typeTranspor2() {
        $url = Doo::conf()->APP_URL;
        $id = $this->params["id"];
        if ($id == 0) {
            $sql = "SELECT DISTINCT t1.trip_to AS id, t2.nombre
				FROM routes t1
				LEFT JOIN areas t2 ON ( t1.trip_to = t2.id ) 
				WHERE t1.trip_from =1";
            $rs = Doo::db()->query($sql);
            $to_areas = $rs->fetchAll();
            //Area de los parques: defaul orlando
            $sql = "SELECT t2.id, t2.nombre  FROM areas t2
							WHERE t2.id = 1";
            $rs = Doo::db()->query($sql);
            $area_park = $rs->fetchAll();
            echo '    <div id="transport2" class="group" align="left">
                                    
                                    <table width="100%"><tr>
                                    	<td>
                                        <div id="div_from2">
                                         <div class="label" style="color: #fff;font-size: 12px;">FROM</div>
                                            <select style="width:190px" name="from2" id="from2" class="select">';
            foreach ($area_park as $e) {
                echo '<option value="' . $e["id"] . '">' . $e["nombre"] . '</option>';
            }
            echo '
                                            </select>
                                        </div>
                                   	 	</td>
                                        <td>
                                        	     
                                        <div id="div_to2">
                                            <div class="label" style="color: #fff;font-size: 12px;">TO</div>
                                            <select style="width:190px" name="to2" id="to2" class="select" onchange="change_to2();" >
                                              <option value="0"></option>';
            foreach ($to_areas as $e) {
                echo ' <option value="' . $e["id"] . '">' . $e["nombre"] . '</option>';
            }
            echo '</select>
                                        </div>
                                        </td>
                                        <td>
                                        	<div id="trip">
                                           
                                            <div class="label" style="color: #fff;font-size: 12px;">TRIP</div>
                                   <table><tr><td>
                                    <span><input class="field" name="d_trip_no" type="text" id="d_trip_no" size="3" maxlength="3" value=""
                                                 readonly="readonly"/></span></td><td>
                                            <a rel="superbox[ajax][' . $url . 'admin/tours/trips/arrival][300x100]">
                                                <i style="cursor:pointer; color: #fff; font-size: 23px;" id="popup2"  onclick="mostrarTrip2()" class="fa fa-search-plus"></i></a>
                                                <img id="popup2" style="cursor:pointer; display: none;" src="' . $url . 'global/images/search.png" onclick="mostrarTrip2()"/>
                                                
                                            </a></td></tr></table>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td width="100%" colspan="3">
                                        <div id="pick-drop">
                                            <div class="label" style="color: #fff;font-size: 12px;">DROP OFF POINT:/ADDRESS</div>
                                            <div  style="width:100%" class="ausu-suggest">
                                                <input name="a_pickup2" style="width:100%" disabled="disabled"  class="field" type="text" id="d_pickup1" maxlength="55" value=""/>
                                                <input name="d_id_pickup1" type="hidden" id="d_id_pickup1" maxlength="55" value=""/>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="3">
                                        	<table width="100%">
                                            	<tr>
                                    	<td width="25%" style="color: #fff;font-size: 12px;">
                                        EXTENSION AREA: </td>
                                        <td>
              <select name="ext_to2" id="ext_to2" class="select" style="width:200px;"  onchange="change_ext_to2();"></select>
                                           
                                
                                        </td>
                                        <td>&nbsp;</td>
										 <td width="15%">
                                         <div id="rooms">
                                    <div class="label" style="color: #fff;font-size: 12px;">LUGGAGE</div>
                                            <span><input name="d_luggage" type="text" id="d_luggage" size="2" maxlength="1" value=""
                                                         class="field"/></span>
                                        </div>
                                        </td>
                                        <td width="15%">
                                         <div id="rooms">
                                    <div class="label" style="color: #fff;font-size: 12px;">ROOM #</div>
                                            <span><input name="d_room1" type="text" id="d_room1" size="2" maxlength="1" value=""
                                                         class="field"/></span>
                                        </div>
                                        </td>
                                    </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="3">
                                        	<div style="width:100%" id="ex-pick-drop">
                                            <div class="label" style="color: #fff;font-size: 12px;">EXTENTION PICK UP POINT/ADDRESS</div>
                                            <div style="width:100%" class="ausu-suggest">
                                                <input name="d_pickup2" style="width:100%" disabled="disabled"  class="field" type="text" id="d_pickup2" maxlength="55" value=""/>
                                                <input name="d_id_pickup2" type="hidden" id="d_id_pickup2" maxlength="55" value=""/>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    </table>
                                    </div>
                                    <script>	
					$.fn.autosugguest({
                                            className: "ausu-suggest",
                                            methodType: "POST",
                                            minChars: 1,
                                            rtnIDs: true,
                                            dataFile: "' . $url . 'admin/tours/loaddatos"
                                        });	
				    </script>
                                    ';
        } else if ($id == 1) {
            echo '<table width="381" border="0">
					  <tr >
						<td>&nbsp;</td>
						<td colspan="5" style="color: #fff;font-size: 12px;">&iquest;At what time you wish your private?</td>
						<td width="29"><label>
							<input  autocomplete="off" name="hora2" type="text" id="hora2" value="" size="6" class="required"/>
						</label></td>
						<td width="29"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center" style="color: #fff;font-size: 12px;">&iquest;From where in Orlando?</div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58" style="color: #fff;font-size: 12px;">City:</td>
						<td width="113"><input  autocomplete="off" name="city2" type="text" id="city2" size="25" class="required"  /></td>
						<td width="114"></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2" style="color: #fff;font-size: 12px;">Address:</td>
						<td height="2"><input  autocomplete="off" name="address2" type="text" id="address2" size="25" class="required" /></td>
						<td height="2"></td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3" style="color: #fff;font-size: 12px;">Zip Code:</td>
						<td height="3"><input  autocomplete="off" name="zipcode2" type="text" id="zipcode2" size="25" class="required"/></td>
						<td height="3"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7" style="color: #fff;font-size: 12px;">Phone #:</td>
						<td height="7"><input  autocomplete="off" name="phone2" type="text" id="phone2" size="25" class="required" /></td>
						<td height="7"></td>
					  </tr>
					</table>
						   
						<script> 	
						$("#hora2").timeEntry().change(function() { 
								/*var log = $("#log"); 
								log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
								
								$("#hora2").val($("#hora1").val());*/
							});
						$("#city").keyup(function(){ 
							$("#city2").val($("#city").val());
					 	});
						$("#address").keyup(function(){ 
							$("#address2").val($("#address").val());
					 	});
						$("#zipcode").keyup(function(){ 
							$("#zipcode2").val($("#zipcode").val());
					 	});
						$("#phone").keyup(function(){ 
							$("#phone2").val($("#phone").val());
					 	});
						
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>';
        } else if ($id == 2) {
            echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2">&nbsp;</td>
						<td width="29"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td> <div align="left" style="color: #fff;font-size: 12px;">Airline:</div></td><td><label>
						  <input  autocomplete="off" type="text" name="airlinedeparture" id="airlinedeparture"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left" style="color: #fff;font-size: 12px;">Flight #:</div></td>
						<td><input  autocomplete="off" type="text" name="flightdeparture" id="flightdeparture"  class="required"/>
						</td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="104"> <div align="left" style="color: #fff;font-size: 12px;">Departure Time:</div></td>
						<td width="264"><input  autocomplete="off" name="hora2" type="text" id="hora2" size="6"  class="required"/>
						 </td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
						<script> 
							$("#hora2").timeEntry().change(function() { 
							    var log = $("#log"); 
							    log.val(log.val() + ($("#hora2").val() || "blank") + "\n"); 
							});
							$(function(){
								$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
							});
					</script>';
        } else if ($id == 3) {
            echo '
						   <table width="381" border="0">
					  <tr>
						<td colspan="3">&nbsp;</td>
						<td width="36"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="6">&nbsp;</td>
					  </tr>
					   <tr>
						<td width="77" height="7">&nbsp;</td>
						<td width="211"><div align="left" style="color: #fff;font-size: 12px;">Remember the Hotel Check Out </div></td>
						<td>
                                                <label>
						<input  autocomplete="off" readonly="readonly" name="hora2" type="text" id="hora2" size="6" value="11:30AM"/>
						</label>
                                                </td>
					  </tr>
					  
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td width="43">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="2" colspan="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3" colspan="2">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>';
        }
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

    public function precioTripTours($trip, $type_rate, $id_agency, $anno) {

        //$idpromo = $this->params["rates"];
        $tourtrip = $this->params["rates"];
        //echo $tourtrip;

        Doo::loadModel("Agency");
        $dat = new Agency();
        $dat->id = $id_agency;
        $dat = Doo::db()->find($dat, array('limit' => 1));
        $type_rate = $dat->type_rate;


        if ($tourtrip == 0) {
            $id_tour = $dat->id_tour;
            // $id_tour = $id_tour1;
        } else {
            $id_tour = $tourtrip;
            //$id_tour = $id_tour1;
        }


//    $id_tour1 = $dat->id_tour;
//    
//    $id_tour = $id_tour1;

        $fecha_salida = $this->params["fecha"];
        $anno = substr($fecha_salida, -4);
        $anno = $anno . '-01-01 00:00:00';


        //$annio = $annio . '-01-01 00:00:00';

        if ($type_rate == 1) {// Se busca SpecialNet
            $sql = 'SELECT adult, child
					FROM tarifastrip 
					WHERE trip_no = ? 
						AND (type_rate = ? )
						AND (id_agency = ? or id_agency = -1 )
                                                AND annio = ?
                                                AND id_ratesvalid = ' . $id_tour . '    
                                                
					ORDER BY type_rate';
            $type = 2;
            $rs = Doo::db()->query($sql, array($trip, 2, $id_agency, $anno));
            $prices = $rs->fetch();
            //echo $anno;
            //print_r($prices);

            if (empty($prices)) {//Si no encuentra Buscamos Net.
                $sql = 'SELECT adult, child
					FROM tarifastrip 
					WHERE trip_no = ? 
						AND (type_rate = ? )
						AND (id_agency = ? or id_agency = -1 )
						AND annio = ?
                                                AND id_ratesvalid = ' . $id_tour . '
                                                 
					ORDER BY type_rate';
                $rs = Doo::db()->query($sql, array($trip, $type_rate, $id_agency, $anno));
                $prices = $rs->fetch();
                //echo $anno;
                //print_r($prices);
            }
        } else {
            $sql = 'SELECT adult, child
					FROM tarifastrip 
					WHERE trip_no = ? 
						AND (type_rate = ? )
						AND (id_agency = ? or id_agency = -1 )
						AND annio = ?
                                                AND id_ratesvalid = ' . $id_tour . '
                                                
					ORDER BY type_rate';
            $rs = Doo::db()->query($sql, array($trip, $type_rate, $id_agency, $anno));
            $prices = $rs->fetch();
//            echo $anno;
//            print_r($prices);      
        }

        if (empty($prices)) {//Se le pone un valor por defecto;
            $prices['adult'] = 'Tarifa No Disponible';
            $prices['child'] = 'Tarifa No Disponible';
        }

        //echo $prices['adult'].',<br /> precio ninio.'.$prices['child'];
        return $prices;
    }

    public function selectTrip1() {



        if (isset($this->params["from"]) && isset($this->params["to"]) && isset($this->params["fecha"]) && isset($this->params["totalpax"]) && isset($this->params["tipo_pass"]) && isset($this->params["agency"])) {
            $from = $this->params["from"];
            $to = $this->params["to"];
            $fecha_salida = $this->params["fecha"];
            //echo $fecha_salida;
//            $fecha_ini = $_POST['fecha_ini']; 

            list($mes, $dia, $anyo) = explode("-", $fecha_salida);
            $fecha_ini1 = $anyo . "-" . $mes . "-" . $dia;
            //echo $fecha_ini1;

            $anno = substr($fecha_salida, -4);
            //echo $anno;
            $resident = $this->params["tipo_pass"];
            $tipo = 1;
            $id_agency = $this->params["agency"];
            
            $sqlt1 = "SELECT DISTINCT trip_no from routes where fecha_ini= '$fecha_ini1' AND trip_from = '$from' AND trip_to = '$to'";
            $rst1 = Doo::db()->query($sqlt1);
            $viajes1 = $rst1->fetchAll();            
            
            
            foreach ($viajes1 as $vj1) {
                
                //$trips = $vj['trip_no'];
                 $trips .= $vj1['trip_no']; 
                //print($trips);
                
            }
            //echo $trips;

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

                    //actualizacion
//                    $type_rate = $dat->type_rate;
//                    GLOBAL $tarifa1;
//                    $tarifa1 = $type_rate;
//                    echo $type_rate;
                    $dat->type_rate = 0;
                }
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }

            if ($dat->type_rate == 1) {
                $dat->type_rate = 0;
            }

            //$fromto = $this->params["fromto"]; 

            $hora = date("H:i");
            //echo $hora;
            //echo $dat->type_rate;

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
                         where t2.type_rate = " . $dat->type_rate . " and t2.trip_from = ? AND t2.trip_to = ? and t1.fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? and t2.fecha_ini = '$fecha_ini1'   ORDER BY  t2.trip_arrival ASC";

            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida, $anno));
            $salida = $rs->fetchAll(); // Salidas
//            print_r($salida);
//            exit();

            if ($dat->type_rate == 1) {// Salidas Especial Net
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
                         where t2.type_rate = 2 and t2.trip_from = ? AND t2.trip_to = ? and t1.fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ?  and t2.fecha_ini = '$fecha_ini1' AND t2.id_agency = ?
                         ORDER BY  t2.trip_arrival ASC";

                $rs = Doo::db()->query($sqlNet, array($from, $to, $fecha_salida, $anno, $dat->id));
                $sEspNet = $rs->fetchAll();
            } else {
                $sEspNet = array();
            }
            if (!empty($sEspNet)) {// Si encontro especiales los remplazamos
                foreach ($salida as $key1 => $normal) {
                    foreach ($sEspNet as $key => $especial) {
                        if ($especial["trip_no"] == $normal["trip_no"]) {
                            $salida[$key1] = $especial;
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

            /* This imageless css button was generated by CSSButtonGenerator.com */
            </style>";


            echo '<form name="formu" id="formu"  method="post"><input name="resident" type="hidden" value="' . $resident . '" />';
            echo '<b style="padding-bottom:10px;"> <font color="#666666" face="Verdana, Arial, Helvetica, sans-serif" >' . $from['nombre'] . ' To ' . $to['nombre'] . '</font></b>';

            echo '<table class="table table-bordered table-striped" id="tbl1" style="cursor:normal;">
             
            <style type="text/css" media="screen">
             
            
                .standard{
                    background: -moz-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #008080), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #005757)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ie10+ */
                    background: linear-gradient(180deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#008080", endColorstr="#005757",GradientType=0 ); 

                }
                .superflex{

                    background: -moz-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2130FF), color-stop(11%, #2130FF), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #2130FF), color-stop(100%, #2130FF)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* ie10+ */
                    background: linear-gradient(180deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#2130FF", endColorstr="#2130FF",GradientType=0 ); 


                }
                .pasajeros{

                    background: -moz-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFD700), color-stop(8%, #FFD700), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #FFD700), color-stop(100%, #FFD700)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* ie10+ */
                    background: linear-gradient(180deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#FFD700", endColorstr="#FFD700",GradientType=0 ); 
                }
                .residente{

                    background: -moz-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff5a00), color-stop(11%, #ff5a00), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #ff5a00), color-stop(100%, #ff5a00)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* ie10+ */
                    background: linear-gradient(180deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ff5a00", endColorstr="#ff5a00",GradientType=0 ); 
                }
                .rojelio{
                    background: -moz-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff0000), color-stop(11%, #ff0000), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #ff0000), color-stop(100%, #ff0000)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* ie10+ */
                    background: linear-gradient(180deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ff0000", endColorstr="#ff0000",GradientType=0 ); 
                }

            </style>



            <thead>
             
                 <tr>
                     <!--<th width="1px;" style="">Select</th>-->
                     <th class="pasajeros" style="width: 5%; border-right-color: transparent; text-align: left; "><label></label><input type="number" name="infante" id="infante" min="0" max="15" size="2"  maxlength="2" value="0"  style="display:none; height: 13px; font-weight: bold; text-align: center; width:50px; margin-top:-22px; margin-left: 2px;" autocomplete="off" /></th>
                     <th class="pasajeros" style="width: 1%; text-align: left; "><label>Adult(s):</label><input type="number" name="pasadult"  min="1" id="pasadult" size="2" maxlength="2" value="1" onkeyup="valida_adultos();" onchange="valida_adultos();" style=" height: 13px; font-weight: bold; text-align: center; width:50px; margin-top:-21px; margin-left: 3px;"  autocomplete="off" /></th>
                     <th class="pasajeros" style="width: 1%; border-left-color: transparent; text-align: left; "><label>Child(s):</label><input type="number" name="pasanino" id="pasanino" min="0" max="15" size="2"  maxlength="2" value="0" onkeyup="valida_adultos(); valida_chicos();" onchange="valida_adultos(); valida_chicos();" style=" height: 13px; font-weight: bold; text-align: center; width:50px; margin-top:-22px; margin-left: 2px;" autocomplete="off" /></th>                     
                     <th class="standard" style="width: 5px; padding-right:0px; text-align:right;  font-weight:bold; font-size:18px; color:#191955; font-face: verdana;" colspan="2"><u>MULTIDAY&nbsp;</u></th>                     
                     <th class="superflex" style="width: 8px; padding-left:0px; text-align:left;  font-weight:bold; font-size:18px; color:#191955; font-face: verdana;" colspan="2"><u>&nbsp;TOURS</u></th>
                    
                     <th class="residente" style="width: 197px; text-align: left;  color:#000;">Type of Pass: <select style="margin-left:1px; height: 18px;" name="tipo_pasajero" id="tipo_pasajero" disabled= "disabled"><option style="color:black;" value="0">NO RESIDENT</option><option style="color:blue;"  value="1">RESIDENT</option></select></th> 
                     <!--<th class="residente" style="width: 1px; border-left-color: transparent; "></th>-->             					  
                 </tr>
                 <tr>
                     <th style="color:#000;" width="8%">Select</th>
                     <th style="color:#000;"  width="8%">Trip</th>
                     <th style="color:#000;" width="12%">Departure</th>
                     <th style="color:#000;" width="12%">Arrive</th>
                     <th style="color:#000;" width="20%">' . ($resident == '1' ? 'FLA. Resident Adult' : 'Regular Price Adult') . '</th>
                     <th style="color:#000;" width="20%">' . ($resident == '1' ? 'FLA. Resident Child (3-9 Yrs)' : 'Regular Price Child') . '</th>
                     <th style="color:#000;" width="20%">Equipment</th> 
                     <th style="color:#000;" width="10%">Seats</th>
                     
                 </tr>
             </thead>';

            $url = Doo::conf()->APP_URL;
            if (count($salida) > 0) {
                $i = 0;
                Doo::loadController("MainController");
                $main = new MainController();
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha = $anio . '-' . $mes . '-' . $dia;

                
                $sqlrtp301 = "SELECT SUM(cantidad) AS CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '301' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                $rsrtp301 = Doo::db()->query($sqlrtp301);
                $puestosocupados301 = $rsrtp301->fetchAll();    

                foreach ($puestosocupados301 as $po301){

                    $puestos_ocupados301 = $po301['CANTIDAD'];
                }   
                
                $trip301 =301;
                
                $sqlcap_301 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip301' ";
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
                
                
                //tarifa standard
                $sql_stdida301 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                  FROM  reservas 
                                  Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdida301 = Doo::db()->query($sql_stdida301, array($trip301, $fecha));
                $r_stdida301 = $rs_stdida301->fetchAll();
                $std_seats_ida301 = $r_stdida301[0]['tari_std'] ? $r_stdida301[0]['tari_std'] : 0;



                $sql_stdretorno301 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                      FROM  reservas 
                                      Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdretorno301 = Doo::db()->query($sql_stdretorno301, array($trip301, $fecha));
                $r_stdretorno301 = $rs_stdretorno301->fetchAll();
                $std_seats_retorno301 = $r_stdretorno301[0]['tari_std'] ? $r_stdretorno301[0]['tari_std'] : 0;

                $standard_total301 = $std_seats_ida301 + $std_seats_retorno301;

                //echo $standard_total;
                //tarifa superflex
                $sqlflexida301 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                  FROM  reservas 
                                  Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexida301 = Doo::db()->query($sqlflexida301, array($trip301, $fecha));
                $r_flexida301 = $rsflexida301->fetchAll();
                $superflex_seats_ida301 = $r_flexida301[0]['tari_flex'] ? $r_flexida301[0]['tari_flex'] : 0;

                $sqlflexretorno301 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                      FROM  reservas 
                                      Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexretorno301 = Doo::db()->query($sqlflexretorno301, array($trip301, $fecha));
                $r_flexretorno301 = $rsflexretorno301->fetchAll();
                $superflex_seats_retorno301 = $r_flexretorno301[0]['tari_flex'] ? $r_flexretorno301[0]['tari_flex'] : 0;

                $superflex_total301 = $superflex_seats_ida301 + $superflex_seats_retorno301;

                //echo $superflex_total;
                //webfare
                $sqlwebida301 = "SELECT (sum(pax) + sum(pax2))as webfare
                                 FROM  reservas 
                                 Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebida301 = Doo::db()->query($sqlwebida301, array($trip301, $fecha));
                $r_webida301 = $rswebida301->fetchAll();
                $webfare_ida301 = $r_webida301[0]['webfare'] ? $r_webida301[0]['webfare'] : 0;

                $sqlwebretorno301 = "SELECT (sum(pax) + sum(pax2))as webfare
                                     FROM  reservas 
                                     Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebretorno301 = Doo::db()->query($sqlwebretorno301, array($trip301, $fecha));
                $r_webretorno301 = $rswebretorno301->fetchAll();
                $webfare_retorno301 = $r_webretorno301[0]['webfare'] ? $r_webretorno301[0]['webfare'] : 0;

                $webfare_total301 = $webfare_ida301 + $webfare_retorno301;

                //echo $webfare_total;
                //superpromo
                $sqlspromoida301 = "SELECT (sum(pax) + sum(pax2))as spromo
                FROM  reservas 
                Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoida301 = Doo::db()->query($sqlspromoida301, array($trip301, $fecha));
                $r_spromoida301 = $rsspromoida301->fetchAll();
                $superpromo_ida301 = $r_spromoida301[0]['spromo'] ? $r_spromoida301[0]['spromo'] : 0;

                $sqlspromoretorno301 = "SELECT (sum(pax) + sum(pax2))as webfare
                                    FROM  reservas 
                                    Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoretorno301 = Doo::db()->query($sqlspromoretorno301, array($trip301, $fecha));
                $r_spromoretorno301 = $rsspromoretorno301->fetchAll();
                $superpromo_retorno301 = $r_spromoretorno301[0]['spromo'] ? $r_spromoretorno301[0]['spromo'] : 0;

                $superpromo_total301 = $superpromo_ida301 + $superpromo_retorno301;

                //echo $superpromo_total;
                //superdiscount
                $sqlsdiscida301 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsdiscida301 = Doo::db()->query($sqlsdiscida301, array($trip301, $fecha));
                $r_discida301 = $rsdiscida301->fetchAll();
                $superdisc_ida301 = $r_discida301[0]['sdisc'] ? $r_discida301[0]['sdisc'] : 0;

                $sqlsdiscretorno301 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rssdiscretorno301 = Doo::db()->query($sqlsdiscretorno301, array($trip301, $fecha));
                $r_discretorno301 = $rssdiscretorno301->fetchAll();
                $superdisc_retorno301 = $r_discretorno301[0]['sdisc'] ? $r_discretorno301[0]['sdisc'] : 0;

                $superdiscount_total301 = $superdisc_ida301 + $superdisc_retorno301;

                //echo $superdiscount_total;
                //tours
                //De Ida
                $sqlTourIda301 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstida301 = Doo::db()->query($sqlTourIda301, array($trip301, $fecha));
                $r_tida301 = $rstida301->fetchAll();
                $ocupadas_tour_ida301 = $r_tida301[0]['ocupadas_tour'] ? $r_tida301[0]['ocupadas_tour'] : 0;



                //De Retorno
                $sqlTourReturn301 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstreturn301 = Doo::db()->query($sqlTourReturn301, array($trip301, $fecha));
                $r_treturn301 = $rstreturn301->fetchAll();
                $ocupadas_tour_return301 = $r_treturn301[0]['ocupadas_tour'] ? $r_treturn301[0]['ocupadas_tour'] : 0;


                $tours_total301 = $ocupadas_tour_ida301 + $ocupadas_tour_return301;

                //echo $tours_total;
                //SPECIAL/////////////////////////////////////////////////////////////////

                $sql_spcida301 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcida301 = Doo::db()->query($sql_spcida301, array($trip301, $fecha));
                $r_spcida301 = $rs_spcida301->fetchAll();
                $spc_seats_ida301 = $r_spcida301[0]['tari_spc'] ? $r_spcida301[0]['tari_spc'] : 0;



                $sql_spcretorno301 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcretorno301 = Doo::db()->query($sql_spcretorno301, array($trip301, $fecha));
                $r_spcretorno301 = $rs_spcretorno301->fetchAll();
                $spc_seats_retorno301 = $r_spcretorno301[0]['tari_spc'] ? $r_spcretorno301[0]['tari_spc'] : 0;

                $special_total301 = $spc_seats_ida301 + $spc_seats_retorno301;

                //echo $special_total;

                $ocupadas301 = $standard_total301 + $superflex_total301 + $webfare_total301 + $superpromo_total301 + $superdiscount_total301 + $tours_total301 + $special_total301;
                $seats_remain301 = ($capacidad301 - $ocupadas301)-($puestos_ocupados301);
                
                //echo $seats_remain301;
                               
                
                
                
                
                $sqlrtp201 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '201' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                $rsrtp201 = Doo::db()->query($sqlrtp201);
                $puestosocupados201 = $rsrtp201->fetchAll();    

                foreach ($puestosocupados201 as $po201){

                    $puestos_ocupados201 = $po201['CANTIDAD'];
                }   
                
                $trip201 =201;
                
                $sqlcap_201 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip201' ";
                $rscap_201 = Doo::db()->query($sqlcap_201);
                $capac_201 = $rscap_201->fetchAll();
                
                
                foreach ($capac_201 as $cap201) {

                }

                $capacidad1_201 = $cap201['capacity'];
                $capacidad2_201 = $cap201['capacity2'];
                $capacidad3_201 = $cap201['capacity3'];
                $capacidad4_201 = $cap201['capacity4'];
                $capacidad5_201 = $cap201['capacity5'];

                $capacidad201 = $capacidad1_201 + $capacidad2_201 + $capacidad3_201 + $capacidad4_201 + $capacidad5_201;
                
                
                //tarifa standard
                $sql_stdida201 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                  FROM  reservas 
                                  Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdida201 = Doo::db()->query($sql_stdida201, array($trip201, $fecha));
                $r_stdida201 = $rs_stdida201->fetchAll();
                $std_seats_ida201 = $r_stdida201[0]['tari_std'] ? $r_stdida201[0]['tari_std'] : 0;



                $sql_stdretorno201 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                      FROM  reservas 
                                      Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdretorno201 = Doo::db()->query($sql_stdretorno201, array($trip201, $fecha));
                $r_stdretorno201 = $rs_stdretorno201->fetchAll();
                $std_seats_retorno201 = $r_stdretorno201[0]['tari_std'] ? $r_stdretorno201[0]['tari_std'] : 0;

                $standard_total201 = $std_seats_ida201 + $std_seats_retorno201;

                //echo $standard_total;
                //tarifa superflex
                $sqlflexida201 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                  FROM  reservas 
                                  Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexida201 = Doo::db()->query($sqlflexida201, array($trip201, $fecha));
                $r_flexida201 = $rsflexida201->fetchAll();
                $superflex_seats_ida201 = $r_flexida201[0]['tari_flex'] ? $r_flexida201[0]['tari_flex'] : 0;

                $sqlflexretorno201 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                      FROM  reservas 
                                      Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexretorno201 = Doo::db()->query($sqlflexretorno201, array($trip201, $fecha));
                $r_flexretorno201 = $rsflexretorno201->fetchAll();
                $superflex_seats_retorno201 = $r_flexretorno201[0]['tari_flex'] ? $r_flexretorno201[0]['tari_flex'] : 0;

                $superflex_total201 = $superflex_seats_ida201 + $superflex_seats_retorno201;

                //echo $superflex_total;
                //webfare
                $sqlwebida201 = "SELECT (sum(pax) + sum(pax2))as webfare
                                 FROM  reservas 
                                 Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebida201 = Doo::db()->query($sqlwebida201, array($trip201, $fecha));
                $r_webida201 = $rswebida201->fetchAll();
                $webfare_ida201 = $r_webida201[0]['webfare'] ? $r_webida201[0]['webfare'] : 0;

                $sqlwebretorno201 = "SELECT (sum(pax) + sum(pax2))as webfare
                                     FROM  reservas 
                                     Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebretorno201 = Doo::db()->query($sqlwebretorno201, array($trip201, $fecha));
                $r_webretorno201 = $rswebretorno201->fetchAll();
                $webfare_retorno201 = $r_webretorno201[0]['webfare'] ? $r_webretorno201[0]['webfare'] : 0;

                $webfare_total201 = $webfare_ida201 + $webfare_retorno201;

                //echo $webfare_total;
                //superpromo
                $sqlspromoida201 = "SELECT (sum(pax) + sum(pax2))as spromo
                FROM  reservas 
                Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoida201 = Doo::db()->query($sqlspromoida201, array($trip201, $fecha));
                $r_spromoida201 = $rsspromoida201->fetchAll();
                $superpromo_ida201 = $r_spromoida201[0]['spromo'] ? $r_spromoida201[0]['spromo'] : 0;

                $sqlspromoretorno201 = "SELECT (sum(pax) + sum(pax2))as webfare
                                    FROM  reservas 
                                    Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoretorno201 = Doo::db()->query($sqlspromoretorno201, array($trip201, $fecha));
                $r_spromoretorno201 = $rsspromoretorno201->fetchAll();
                $superpromo_retorno201 = $r_spromoretorno201[0]['spromo'] ? $r_spromoretorno201[0]['spromo'] : 0;

                $superpromo_total201 = $superpromo_ida201 + $superpromo_retorno201;

                //echo $superpromo_total;
                //superdiscount
                $sqlsdiscida201 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsdiscida201 = Doo::db()->query($sqlsdiscida201, array($trip201, $fecha));
                $r_discida201 = $rsdiscida201->fetchAll();
                $superdisc_ida201 = $r_discida201[0]['sdisc'] ? $r_discida201[0]['sdisc'] : 0;

                $sqlsdiscretorno201 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rssdiscretorno201 = Doo::db()->query($sqlsdiscretorno201, array($trip201, $fecha));
                $r_discretorno201 = $rssdiscretorno201->fetchAll();
                $superdisc_retorno201 = $r_discretorno201[0]['sdisc'] ? $r_discretorno201[0]['sdisc'] : 0;

                $superdiscount_total201 = $superdisc_ida201 + $superdisc_retorno201;

                //echo $superdiscount_total;
                //tours
                //De Ida
                $sqlTourIda201 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstida201 = Doo::db()->query($sqlTourIda201, array($trip201, $fecha));
                $r_tida201 = $rstida201->fetchAll();
                $ocupadas_tour_ida201 = $r_tida201[0]['ocupadas_tour'] ? $r_tida201[0]['ocupadas_tour'] : 0;



                //De Retorno
                $sqlTourReturn201 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstreturn201 = Doo::db()->query($sqlTourReturn201, array($trip201, $fecha));
                $r_treturn201 = $rstreturn201->fetchAll();
                $ocupadas_tour_return201 = $r_treturn201[0]['ocupadas_tour'] ? $r_treturn201[0]['ocupadas_tour'] : 0;


                $tours_total201 = $ocupadas_tour_ida201 + $ocupadas_tour_return201;

                //echo $tours_total;
                //SPECIAL/////////////////////////////////////////////////////////////////

                $sql_spcida201 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no = '$trip201' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcida201 = Doo::db()->query($sql_spcida201, array($trip201, $fecha));
                $r_spcida201 = $rs_spcida201->fetchAll();
                $spc_seats_ida201 = $r_spcida201[0]['tari_spc'] ? $r_spcida201[0]['tari_spc'] : 0;



                $sql_spcretorno201 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip201' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcretorno201 = Doo::db()->query($sql_spcretorno201, array($trip201, $fecha));
                $r_spcretorno201 = $rs_spcretorno201->fetchAll();
                $spc_seats_retorno201 = $r_spcretorno201[0]['tari_spc'] ? $r_spcretorno201[0]['tari_spc'] : 0;

                $special_total201 = $spc_seats_ida201 + $spc_seats_retorno201;

                //echo $special_total;

                $ocupadas201 = $standard_total201 + $superflex_total201 + $webfare_total201 + $superpromo_total201 + $superdiscount_total201 + $tours_total201 + $special_total201;
                $seats_remain201 = ($capacidad201 - $ocupadas201)-($puestos_ocupados201);
                //echo $seats_remain201;
                
                
                              
                
                $sqlrtp101 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '101' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                $rsrtp101 = Doo::db()->query($sqlrtp101);
                $puestosocupados101 = $rsrtp101->fetchAll();    

                foreach ($puestosocupados101 as $po101){

                    $puestos_ocupados101 = $po101['CANTIDAD'];
                }   
                
                $trip101 =101;
                
                $sqlcap_101 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip101' ";
                $rscap_101 = Doo::db()->query($sqlcap_101);
                $capac_101 = $rscap_101->fetchAll();
                
                
                foreach ($capac_101 as $cap101) {

                }

                $capacidad1_101 = $cap101['capacity'];
                $capacidad2_101 = $cap101['capacity2'];
                $capacidad3_101 = $cap101['capacity3'];
                $capacidad4_101 = $cap101['capacity4'];
                $capacidad5_101 = $cap101['capacity5'];

                $capacidad101 = $capacidad1_101 + $capacidad2_101 + $capacidad3_101 + $capacidad4_101 + $capacidad5_101;
                
                
                //tarifa standard
                $sql_stdida101 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                  FROM  reservas 
                                  Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdida101 = Doo::db()->query($sql_stdida101, array($trip101, $fecha));
                $r_stdida101 = $rs_stdida101->fetchAll();
                $std_seats_ida101 = $r_stdida101[0]['tari_std'] ? $r_stdida101[0]['tari_std'] : 0;



                $sql_stdretorno101 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                      FROM  reservas 
                                      Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdretorno101 = Doo::db()->query($sql_stdretorno101, array($trip101, $fecha));
                $r_stdretorno101 = $rs_stdretorno101->fetchAll();
                $std_seats_retorno101 = $r_stdretorno101[0]['tari_std'] ? $r_stdretorno101[0]['tari_std'] : 0;

                $standard_total101 = $std_seats_ida101 + $std_seats_retorno101;

                //echo $standard_total;
                //tarifa superflex
                $sqlflexida101 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                  FROM  reservas 
                                  Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexida101 = Doo::db()->query($sqlflexida101, array($trip101, $fecha));
                $r_flexida101 = $rsflexida101->fetchAll();
                $superflex_seats_ida101 = $r_flexida101[0]['tari_flex'] ? $r_flexida101[0]['tari_flex'] : 0;

                $sqlflexretorno101 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                      FROM  reservas 
                                      Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexretorno101 = Doo::db()->query($sqlflexretorno101, array($trip101, $fecha));
                $r_flexretorno101 = $rsflexretorno101->fetchAll();
                $superflex_seats_retorno101 = $r_flexretorno101[0]['tari_flex'] ? $r_flexretorno101[0]['tari_flex'] : 0;

                $superflex_total101 = $superflex_seats_ida101 + $superflex_seats_retorno101;

                //echo $superflex_total;
                //webfare
                $sqlwebida101 = "SELECT (sum(pax) + sum(pax2))as webfare
                                 FROM  reservas 
                                 Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebida101 = Doo::db()->query($sqlwebida101, array($trip101, $fecha));
                $r_webida101 = $rswebida101->fetchAll();
                $webfare_ida101 = $r_webida101[0]['webfare'] ? $r_webida101[0]['webfare'] : 0;

                $sqlwebretorno101 = "SELECT (sum(pax) + sum(pax2))as webfare
                                     FROM  reservas 
                                     Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebretorno101 = Doo::db()->query($sqlwebretorno101, array($trip101, $fecha));
                $r_webretorno101 = $rswebretorno101->fetchAll();
                $webfare_retorno101 = $r_webretorno101[0]['webfare'] ? $r_webretorno101[0]['webfare'] : 0;

                $webfare_total101 = $webfare_ida101 + $webfare_retorno101;

                //echo $webfare_total;
                //superpromo
                $sqlspromoida101 = "SELECT (sum(pax) + sum(pax2))as spromo
                FROM  reservas 
                Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoida101 = Doo::db()->query($sqlspromoida101, array($trip101, $fecha));
                $r_spromoida101 = $rsspromoida101->fetchAll();
                $superpromo_ida101 = $r_spromoida101[0]['spromo'] ? $r_spromoida101[0]['spromo'] : 0;

                $sqlspromoretorno101 = "SELECT (sum(pax) + sum(pax2))as webfare
                                    FROM  reservas 
                                    Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoretorno101 = Doo::db()->query($sqlspromoretorno101, array($trip101, $fecha));
                $r_spromoretorno101 = $rsspromoretorno101->fetchAll();
                $superpromo_retorno101 = $r_spromoretorno101[0]['spromo'] ? $r_spromoretorno101[0]['spromo'] : 0;

                $superpromo_total101 = $superpromo_ida101 + $superpromo_retorno101;

                //echo $superpromo_total;
                //superdiscount
                $sqlsdiscida101 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsdiscida101 = Doo::db()->query($sqlsdiscida101, array($trip101, $fecha));
                $r_discida101 = $rsdiscida101->fetchAll();
                $superdisc_ida101 = $r_discida101[0]['sdisc'] ? $r_discida101[0]['sdisc'] : 0;

                $sqlsdiscretorno101 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rssdiscretorno101 = Doo::db()->query($sqlsdiscretorno101, array($trip101, $fecha));
                $r_discretorno101 = $rssdiscretorno101->fetchAll();
                $superdisc_retorno101 = $r_discretorno101[0]['sdisc'] ? $r_discretorno101[0]['sdisc'] : 0;

                $superdiscount_total101 = $superdisc_ida101 + $superdisc_retorno101;

                //echo $superdiscount_total;
                //tours
                //De Ida
                $sqlTourIda101 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstida101 = Doo::db()->query($sqlTourIda101, array($trip101, $fecha));
                $r_tida101 = $rstida101->fetchAll();
                $ocupadas_tour_ida101 = $r_tida101[0]['ocupadas_tour'] ? $r_tida101[0]['ocupadas_tour'] : 0;



                //De Retorno
                $sqlTourReturn101 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstreturn101 = Doo::db()->query($sqlTourReturn101, array($trip101, $fecha));
                $r_treturn101 = $rstreturn101->fetchAll();
                $ocupadas_tour_return101 = $r_treturn101[0]['ocupadas_tour'] ? $r_treturn101[0]['ocupadas_tour'] : 0;


                $tours_total101 = $ocupadas_tour_ida101 + $ocupadas_tour_return101;

                //echo $tours_total;
                //SPECIAL/////////////////////////////////////////////////////////////////

                $sql_spcida101 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no = '$trip101' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcida101 = Doo::db()->query($sql_spcida101, array($trip101, $fecha));
                $r_spcida101 = $rs_spcida101->fetchAll();
                $spc_seats_ida101 = $r_spcida101[0]['tari_spc'] ? $r_spcida101[0]['tari_spc'] : 0;



                $sql_spcretorno101 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip101' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcretorno101 = Doo::db()->query($sql_spcretorno101, array($trip101, $fecha));
                $r_spcretorno101 = $rs_spcretorno101->fetchAll();
                $spc_seats_retorno101 = $r_spcretorno101[0]['tari_spc'] ? $r_spcretorno101[0]['tari_spc'] : 0;

                $special_total101 = $spc_seats_ida101 + $spc_seats_retorno101;

                //echo $special_total;

                $ocupadas101 = $standard_total101 + $superflex_total101 + $webfare_total101 + $superpromo_total101 + $superdiscount_total101 + $tours_total101 + $special_total101;
                $seats_remain101 = ($capacidad101 - $ocupadas101)-($puestos_ocupados101);
                //echo $seats_remain101;
                
                
            foreach ($salida as $e) {

                    $precioTrip1 = $this->precioTripTours($e['trip_no'], $dat->type_rate, $dat->id, $anio);
                    //echo $dat->type_rate;
                    //print_r($precioTrip1);
                    $tourtrip = $this->params["rates"];
                    //echo $tourtrip;            
                    
                    if($e['trip_no'] == 101){
                        
                           $disponible = $seats_remain101;
                           $tipo = 1;

                    }

                    if($e['trip_no'] == 201){

                           $disponible = $seats_remain201;
                           $tipo = 1;

                    }

                    if($e['trip_no'] == 301){

                           $disponible = $seats_remain301;
                           $tipo = 1;

                    }

                    //$disponible = $main->disponible($e['trip_no'], $fecha);
                    //$priceAdult = ($resident == '1' ? $e['price4'] : $e['price'] );
                    //$priceChild = ($resident == '1' ? $e['price3'] : $e['price2'] );

                    $priceAdult = $precioTrip1['adult'];
                    //echo $priceAdult;
                    $priceChild = $precioTrip1['child'];
                    //$seats =57;
                    //echo $priceChild;
                   
                    echo '<tr class="row' . $i . '">  
                    <td style="color:#191955;"><input type="radio" name="trip1" id="trip1' . $e['trip_no'] . '"  value="' . $e['trip_no'] . '" />
					<input type="hidden" name="capacidad_trip_' . $e['trip_no'] . '"  id="capacidad_trip_' . $e['trip_no'] . '" value="' . $disponible . '" />
					<input type="hidden" name="deptime1_' . $e['trip_no'] . '"  id="deptime1_' . $e['trip_no'] . '" value="' . $e['trip_departure'] . '" />
					<input type="hidden" name="arrtime1_' . $e['trip_no'] . '"  id="arrtime1_' . $e['trip_no'] . '" value="' . $e['trip_arrival'] . '" />
					</td>
                    <td style="color:#191955;">' . $e['trip_no'] . '</td>
                    <td style="color:#191955;">' . date("g:i a", strtotime($e['trip_departure'])) . '</td>
                    <td style="color:#191955;">' . date("g:i a", strtotime($e['trip_arrival'])) . '</td>
                    <td style="color:#191955;">' . $priceAdult . ' <input type="hidden" name="priceTransporAdult1_' . $e['trip_no'] . '"  id="priceTransporAdult_' . $e['trip_no'] . '" value="' . $priceAdult . '" /> 
					</td>
                    <td style="color:#191955;">' . $priceChild . '
					<input type="hidden" name="priceTransporChild_' . $e['trip_no'] . '"  id="priceTransporChild_' . $e['trip_no'] . '" value="' . $priceChild . '" />
					</td>
                    <td style="color:#191955;">' . $e['equipment'] . '</td>
                    <!--<td style="color:#191955;">' . $disponible . '</td>-->
                    <td title="' . $tituloDisponible . '" ><input type="text" name="disponible"  id="disponible' . $e['trip_no'] . '" style=" width: 24px; text-align: center; background-color: transparent; border: 0px; font-weight:normal;" value="' . $disponible . '" /></td>
                    </tr>';
                    
                    
                    $i = 1 - $i;
                }
            
                echo '<script> document.getElementById("save2").style.display = "none"; </script>';
                
            } else {
                
                echo '<tr>
                  <td colspan="7">No tours available</td> 
              </tr>  ';
            }
            echo ' </table>';

            $inpu = 'input[name="trip1"]';

            echo '  <p align="right">
             <input  class="selector" type="button" id="btn-SelectTrip" value="Select" /> 
                     <input  class="selector" type="button" id="btn-cancelarTrip" value="Cancel" /> 
            </p>   

            <div id="con">
            
            <script type="text/javascript">
            
            function valida_adultos(){
            
            
            var trips = "' . $trips . '";
                
            if(trips == "101201301"){
            
            var pasadult = document.getElementById("pasadult").value;
            var pasanino = document.getElementById("pasanino").value;
            var adultos = $("#pasadult").val();
            var peques = $("#pasanino").val();
            var totpax = parseInt(adultos) + parseInt(peques);  
            
            var radio101 = document.getElementById("trip1101").checked;
            var radio201 = document.getElementById("trip1201").checked;
            var radio301 = document.getElementById("trip1301").checked;
            
            var seats_remain301 = "' . $seats_remain301 . '";
            var seats_remain201 = "' . $seats_remain201 . '";
            var seats_remain101 = "' . $seats_remain101 . '";
                
                if(totpax > seats_remain301){                
                    //alert("Total de pasajeros excede al cupo disponible Trip 301"); 
                    document.getElementById("btn-SelectTrip").disabled = true;
                    document.getElementById("trip1301").style.cursor = "not-allowed";
                    document.getElementById("trip1301").disabled = true;
                    document.getElementById("disponible301").value = 0;
                    document.getElementById("trip1301").checked = false;
                }else{
                    document.getElementById("trip1301").style.cursor = "";
                    document.getElementById("trip1301").disabled = false;
                    document.getElementById("btn-SelectTrip").disabled = false;
                    document.getElementById("disponible301").value = seats_remain301;

                }

                if(totpax > seats_remain101){  
                    //alert("Total de pasajeros excede al cupo disponible Trip 101"); 
                    document.getElementById("trip1101").style.cursor = "not-allowed";
                    document.getElementById("trip1101").disabled = true;
                    document.getElementById("disponible101").value = 0;
                    //document.getElementById("trip1101").checked = false;
                }else{
                    document.getElementById("trip1101").style.cursor = "";
                    document.getElementById("trip1101").disabled = false;
                    document.getElementById("disponible101").value = seats_remain101;

                }

                if(totpax > seats_remain201){                    
                    document.getElementById("trip1201").style.cursor = "not-allowed";
                    document.getElementById("trip1201").disabled = true;
                    document.getElementById("disponible201").value = 0;
                    //document.getElementById("trip1201").checked = false;
                }else{
                    document.getElementById("trip1201").style.cursor = "";
                    document.getElementById("trip1201").disabled = false;
                    document.getElementById("disponible201").value = seats_remain201;

                }

                if(seats_remain301 == "0"){

                        document.getElementById("trip1301").style.cursor = "not-allowed";
                        document.getElementById("trip1301").disabled = true;
                        document.getElementById("disponible301").value = 0;

                }else{

                    document.getElementById("trip1301").style.cursor = "";
                    document.getElementById("trip1301").disabled = false;
                    document.getElementById("disponible301").value = seats_remain301;

                }

                if(seats_remain201 == "0"){

                    document.getElementById("trip1201").style.cursor = "not-allowed";
                    document.getElementById("trip1201").disabled = true;
                    document.getElementById("disponible201").value = 0;

                }else{

                    document.getElementById("trip1201").style.cursor = "";
                    document.getElementById("trip1201").disabled = false;
                    document.getElementById("disponible201").value = seats_remain201;

                }

                if(seats_remain101 == "0"){

                    document.getElementById("trip1101").style.cursor = "not-allowed";
                    document.getElementById("trip1101").disabled = true;
                    document.getElementById("disponible101").value = 0;

                }else{

                    document.getElementById("trip1101").style.cursor = "";
                    document.getElementById("trip1101").disabled = false;
                    document.getElementById("disponible101").value = seats_remain101;

                }

                //Desactivamos radios (101 201 301)

                if(radio101 == true){                    
                        document.getElementById("trip1101").checked = false;                                            

                }

                if(radio201 == true){
                    document.getElementById("trip1201").checked = false;

                }

                if(radio301 == true){
                    document.getElementById("trip1301").checked = false;

                }  
            
            }
            
            if(trips == "101201"){
            
                var pasadult = document.getElementById("pasadult").value;
                var pasanino = document.getElementById("pasanino").value;
                var adultos = $("#pasadult").val();
                var peques = $("#pasanino").val();
                var totpax = parseInt(adultos) + parseInt(peques); 

                var radio101 = document.getElementById("trip1101").checked;
                var radio201 = document.getElementById("trip1201").checked;
                
                var seats_remain201 = "' . $seats_remain201 . '";
                var seats_remain101 = "' . $seats_remain101 . '";              
                
                
                
                if(totpax > seats_remain101){  
                    
                    //alert("Total de Pasajeros Excedido para Trip 101");
                    document.getElementById("trip1101").checked = false;   
                    document.getElementById("btn-SelectTrip").disabled = true; 
                    
                    document.getElementById("trip1101").style.cursor = "not-allowed";
                    document.getElementById("trip1101").disabled = true;
                    document.getElementById("disponible101").value = 0;                   
                    
                  //document.getElementById("trip1101").checked = false;
                  
                }else{
                
                    document.getElementById("btn-SelectTrip").disabled = false;                     
                    document.getElementById("trip1101").style.cursor = "";
                    document.getElementById("trip1101").disabled = false;
                    document.getElementById("disponible101").value = seats_remain101;

                }

                if(totpax > seats_remain201){   
                
                    //alert("Total de Pasajeros Excedido para Trip 201");
                    document.getElementById("trip1201").checked = false;  
                    document.getElementById("btn-SelectTrip").disabled = true; 
                    
                    document.getElementById("trip1201").style.cursor = "not-allowed";
                    document.getElementById("trip1201").disabled = true;
                    document.getElementById("disponible201").value = 0;                    

                    //document.getElementById("trip1201").checked = false;
                    
                }else{
                
                    document.getElementById("btn-SelectTrip").disabled = false;
                    document.getElementById("trip1201").style.cursor = "";
                    document.getElementById("trip1201").disabled = false;
                    document.getElementById("disponible201").value = seats_remain201;

                }

                      
                if(seats_remain201 == "0"){
                    
                    document.getElementById("trip1201").style.cursor = "not-allowed";
                    document.getElementById("trip1201").disabled = true;
                    document.getElementById("disponible201").value = 0;
                
                }else{
                
                    document.getElementById("trip1201").style.cursor = "";
                    document.getElementById("trip1201").disabled = false;
                    document.getElementById("disponible201").value = seats_remain201;
                
                }
                
                if(seats_remain101 == "0"){
                    
                    document.getElementById("trip1101").style.cursor = "not-allowed";
                    document.getElementById("trip1101").disabled = true;
                    document.getElementById("disponible101").value = 0;
                
                }else{
                
                    document.getElementById("trip1101").style.cursor = "";
                    document.getElementById("trip1101").disabled = false;
                    document.getElementById("disponible101").value = seats_remain101;
                
                }
            
                //Desactivamos radios (101 201)

                if(radio101 == true){                    
                        document.getElementById("trip1101").checked = false;                                            

                }

                if(radio201 == true){
                    document.getElementById("trip1201").checked = false;

                }

            
            }
            
            if(trips == "301"){
            
                var pasadult = document.getElementById("pasadult").value;
                var pasanino = document.getElementById("pasanino").value;
                var adultos = $("#pasadult").val();
                var peques = $("#pasanino").val();
                var totpax = parseInt(adultos) + parseInt(peques);                 
                var radio301 = document.getElementById("trip1301").checked;
            
                var seats_remain301 = "' . $seats_remain301 . '";

                if(totpax > seats_remain301){                    
                    document.getElementById("trip1301").style.cursor = "not-allowed";
                    document.getElementById("trip1301").disabled = true;
                    document.getElementById("disponible301").value = 0;
                    //document.getElementById("trip1301").checked = false;
                }else{
                    document.getElementById("trip1301").style.cursor = "";
                    document.getElementById("trip1301").disabled = false;
                    document.getElementById("disponible301").value = seats_remain301;

                }

                if(seats_remain301 == "0"){

                        document.getElementById("trip1301").style.cursor = "not-allowed";
                        document.getElementById("trip1301").disabled = true;
                        document.getElementById("disponible301").value = 0;

                    }else{

                        document.getElementById("trip1301").style.cursor = "";
                        document.getElementById("trip1301").disabled = false;
                        document.getElementById("disponible301").value = seats_remain301;

                }

                //Desactivamos radio (301)

                if(radio301 == true){
                
                        document.getElementById("trip1301").checked = false;

                }             
            
            }
            
            //VALIDAMOS CONTROL PARA ADULTOS
                    
                if(pasadult == ""){                    
                        document.getElementById("pasadult").value = "1";
                        $("#pasadult").focus();                    
                }

                if(pasadult == "0"){
                    document.getElementById("pasadult").value = "1";
                    $("#pasadult").focus();
                }

                if(pasadult < "0"){
                    document.getElementById("pasadult").value = "1";
                    $("#pasadult").focus();
                }      
            }
            
            function valida_chicos(){
                
                var pasanino = document.getElementById("pasanino").value;                    

                if(pasanino == ""){                    
                        document.getElementById("pasanino").value = "0";
                        $("#pasanino").focus();                    
                }

                if(pasanino < "0"){
                    document.getElementById("pasanino").value = "0";
                    $("#pasanino").focus();
                }                 

            }
            
            $(document).ready(function() {   
                    
                    var adulto = $("#adult").val();
                    var nino =  $("#child").val();
                    var totpax = parseInt(adulto) + parseInt(nino);
                    var seats_remain101 = "' . $seats_remain101 . '";
                    var seats_remain201 = "' . $seats_remain201 . '";
                    var seats_remain301 = "' . $seats_remain301 . '";
                    var trips = "' . $trips . '";
                        
                    if(trips == "101201301"){
                        
                        var radio101 = document.getElementById("trip1101").checked;
                        var radio201 = document.getElementById("trip1201").checked;
                        var radio301 = document.getElementById("trip1301").checked;

                        var totpax = parseInt(adulto) + parseInt(nino);

                        if(totpax > seats_remain101){

                            document.getElementById("trip1101").style.cursor = "not-allowed";
                            document.getElementById("trip1101").disabled = true;
                            //document.getElementById("trip1101").checked = false;

                        }
                    
                        if(totpax > seats_remain201){                    
                            document.getElementById("trip1201").style.cursor = "not-allowed";
                            document.getElementById("trip1201").disabled = true;
                            //document.getElementById("trip1201").checked = false;
                        }

                        if(totpax > seats_remain301){ 
                            
                            document.getElementById("trip1301").style.cursor = "not-allowed";
                            document.getElementById("trip1301").disabled = true;
                            //document.getElementById("trip1301").checked = false;
                        }


                        if(seats_remain101 == "0"){                    
                            document.getElementById("trip1101").style.cursor = "not-allowed";
                            document.getElementById("trip1101").disabled = true;              
                        }

                        if(seats_remain201 == "0"){                    
                            document.getElementById("trip1201").style.cursor = "not-allowed";
                            document.getElementById("trip1201").disabled = true;                    
                        }

                        if(seats_remain301 == "0"){                    
                            document.getElementById("trip1301").style.cursor = "not-allowed";
                            document.getElementById("trip1301").disabled = true;  
                        }
                 
                    }
                    
                    if(trips == "101201"){
                        
                        var radio101 = document.getElementById("trip1101").checked;
                        var radio201 = document.getElementById("trip1201").checked;


                        var totpax = parseInt(adulto) + parseInt(nino);

                        if(totpax > seats_remain101){

                            document.getElementById("trip1101").style.cursor = "not-allowed";
                            document.getElementById("trip1101").disabled = true;
                            //document.getElementById("trip1101").checked = false;

                        }

                        if(totpax > seats_remain201){                    
                            document.getElementById("trip1201").style.cursor = "not-allowed";
                            document.getElementById("trip1201").disabled = true;
                            //document.getElementById("trip1201").checked = false;
                        }


                        if(seats_remain101 == "0"){                    
                            document.getElementById("trip1101").style.cursor = "not-allowed";
                            document.getElementById("trip1101").disabled = true;              
                        }

                        if(seats_remain201 == "0"){                    
                            document.getElementById("trip1201").style.cursor = "not-allowed";
                            document.getElementById("trip1201").disabled = true;                    
                        }



                    }
                    
                    if(trips == "301"){
                        
                        var radio301 = document.getElementById("trip1301").checked;   
                        
                        var totpax = parseInt(adulto) + parseInt(nino);

                        if(totpax > seats_remain301){

                            document.getElementById("trip1301").style.cursor = "not-allowed";
                            document.getElementById("trip1301").disabled = true;
                            //document.getElementById("trip1301").checked = false;

                        }                        

                        if(seats_remain301 == "0"){                    
                            document.getElementById("trip1301").style.cursor = "not-allowed";
                            document.getElementById("trip1301").disabled = true;                    
                        }

                    }
                    
                    $("#pasadult").val(adulto);
                    $("#pasanino").val(nino);

                    $("#pasadult").change(function(){
                        
                        var pasadult = $("#pasadult").val(); 
                        $("#adult").val(pasadult);
                        valorTransferGeneral();
                        habitaciones();
                        calcularTotalPago();

                    });

                    $("#pasanino").change(function(){

                        var pasanino = $("#pasanino").val();                  
                        $("#child").val(pasanino);
                        valorTransferGeneral();
                        habitaciones();
                        calcularTotalPago();

                    });
                    

                    $("#btn-SelectTrip").click(function(){
                            var trip = $("input[name=trip1]:checked").val();
                            var id = $("#trip1").val();                                       
                            var adult = $("#adult").val();
                            var child = $("#child").val();				
                            var fecha = "' . $fecha . '";
                            var tipo = "' . $tipo .  '";                                    
                            var totalpax = parseInt(adult) + parseInt(child);                                 
                            var priceTranspor1A = $("#priceTransporAdult_"+trip).val();
                            var priceTranspor1C = $("#priceTransporChild_"+trip).val();
                            $("#priceTransporA1").html(priceTranspor1A);
                            $("#priceTransporC1").html(priceTranspor1C);
                            $("#a_trip_no").val(trip);
                            $("#arrtime1").val($("#arrtime1_"+trip).val());
                            $("#deptime1").val($("#deptime1_"+trip).val());
                            $("#popup").fadeOut("slow");
                            $("#popup").hide("fade");
                            $("#mascaraP").fadeOut("slow");
                            $("#mascaraP").hide("fade");
                            document.getElementById("save2").style.display = "none";
                            calcularTotalPago();                                
                            //$("#CargaTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/add/trip/" + id + "/"+tipo/' . $id_agency . ');
                            $("#puestosEnUso").load("' . Doo::conf()->APP_URL . 'admin/reservas/ocuparPuesto/"+trip+"/"+tipo+"/"+fecha+"/"+totalpax+"/1"); 
                            $("#mensajeTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/consultatrip");
                            //$("#userr").load("' . $url . 'admin/tours/comisionTransport/"+trip+"/"+1);

                            return false;
                    });
                    
                    $("#btn-cancelarTrip").click(function(){
                            $("#popup").fadeOut("slow");
                            $("#popup").hide("fade");
                            $("#mascaraP").fadeOut("slow");
                            $("#mascaraP").hide("fade");                           
                            //document.getElementById("save2").style.display = "none";
                            return false;
                    });
			
		});                
                
            </script>
            </div>
          </form>';
        }
    }

    public function selectTrip2() {

        if (isset($this->params["from"]) && isset($this->params["to"]) && isset($this->params["fecha"]) && isset($this->params["totalpax"]) && isset($this->params["tipo_pass"]) && isset($this->params["agency"])) {
            $from = $this->params["from"];
            $to = $this->params["to"];
            $fecha_salida = $this->params["fecha"];

            list($mes, $dia, $anyo) = explode("-", $fecha_salida);
            $fecha_sal1 = $anyo . "-" . $mes . "-" . $dia;

            $anno = substr($fecha_salida, -4);
            $resident = $this->params["tipo_pass"];
            $tipo = 1;
            $id_agency = $this->params["agency"];
            
            $sqlt2 = "SELECT DISTINCT trip_no from routes where fecha_ini= '$fecha_sal1' AND trip_from = '$from' AND trip_to = '$to'";
            $rst2 = Doo::db()->query($sqlt2);
            $viajes2 = $rst2->fetchAll();            
            
            
            foreach ($viajes2 as $vj2) {
                
                //$trips = $vj['trip_no'];
                 $trips .= $vj2['trip_no']; 
                //print($trips);
                
            }
            //echo $trips;

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
//                    $type_rate = $dat->type_rate;
//                    GLOBAL $tarifa1;
//                    $tarifa1 = $type_rate;
                    $dat->type_rate = 0;
                }
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }

            if ($dat->type_rate == 1) {
                $dat->type_rate = 0;
            }
            //$fromto = $this->params["fromto"]; 

            $hora = date("H:i");
            //echo $hora;
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
                         where t2.type_rate = " . $dat->type_rate . " and t2.trip_from = ? AND t2.trip_to = ? and t1.fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? and t2.fecha_ini = '$fecha_sal1' ORDER BY t2.trip_arrival DESC";

            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida, $anno));
            $salida = $rs->fetchAll(); 

            if ($dat->type_rate == 1) { // Salidas Especial Net
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
							 where t2.type_rate = 2 and t2.trip_from = ? AND t2.trip_to = ? and t1.fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? and t2.fecha_ini = '$fecha_sal1' AND t2.id_agency = ?
							 ORDER BY t2.trip_arrival DESC";

                $rs = Doo::db()->query($sqlNet, array($from, $to, $fecha_salida, $anno, $dat->id));
                $sEspNet = $rs->fetchAll();
            } else {
                $sEspNet = array();
            }
//            print_r($sEspNet);
//            exit;
            if (!empty($sEspNet)) {// Si encontro especiales los remplazamos
                foreach ($salida as $key1 => $normal) {
                    foreach ($sEspNet as $key => $especial) {
                        if ($especial["trip_no"] == $normal["trip_no"]) {
                            $salida[$key1] = $especial;
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

            echo "<style type='text/css'>/* This imageless css button was generated by CSSButtonGenerator.com */</style>";

            echo '<form name="formu" id="formu"  method="post"><input name="resident" type="hidden" value="' . $resident . '" />';
            echo '<b style="padding-bottom:10px;"> <font color="#666666" face="Verdana, Arial, Helvetica, sans-serif" >' . $from['nombre'] . ' To ' . $to['nombre'] . '</font></b>';

            echo '<table class="table table-bordered table-striped" id="tbl1" style="cursor:normal;">               
             

            <style type="text/css" media="screen">
             
            
                .standard{
                    background: -moz-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #008080), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #005757)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ie10+ */
                    background: linear-gradient(180deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#008080", endColorstr="#005757",GradientType=0 ); 

                }
                .superflex{

                    background: -moz-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2130FF), color-stop(11%, #2130FF), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #2130FF), color-stop(100%, #2130FF)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* ie10+ */
                    background: linear-gradient(180deg, #2130FF 0%, #2130FF 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #2130FF 91%, #2130FF 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#2130FF", endColorstr="#2130FF",GradientType=0 ); 


                }
                .pasajeros{

                    background: -moz-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFD700), color-stop(8%, #FFD700), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #FFD700), color-stop(100%, #FFD700)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* ie10+ */
                    background: linear-gradient(180deg, #FFD700 0%, #FFD700 8%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #FFD700 91%, #FFD700 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#FFD700", endColorstr="#FFD700",GradientType=0 ); 
                }
                .residente{

                    background: -moz-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff5a00), color-stop(11%, #ff5a00), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #ff5a00), color-stop(100%, #ff5a00)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* ie10+ */
                    background: linear-gradient(180deg, #ff5a00 0%, #ff5a00 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff5a00 91%, #ff5a00 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ff5a00", endColorstr="#ff5a00",GradientType=0 ); 
                }
                .rojelio{
                    background: -moz-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff0000), color-stop(11%, #ff0000), color-stop(16%, #FFFFFF), color-stop(50%, #F5FCFF), color-stop(86%, #FFFFFF), color-stop(91%, #ff0000), color-stop(100%, #ff0000)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(270deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* ie10+ */
                    background: linear-gradient(180deg, #ff0000 0%, #ff0000 11%, #FFFFFF 16%, #F5FCFF 50%, #FFFFFF 86%, #ff0000 91%, #ff0000 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ff0000", endColorstr="#ff0000",GradientType=0 ); 
                }

            </style>
            
             <thead>
                 
                 <tr>
                     <!--<th width="1px;" style="">Select</th>-->
                     <th class="pasajeros" style="width: 5%; border-right-color: transparent; text-align: left; "><label></label><input type="number" name="infante" id="infante" min="0" max="15" size="2"  maxlength="2" value="0"  style="display:none; height: 13px; font-weight: bold; text-align: center; width:50px; margin-top:-22px; margin-left: 2px;" autocomplete="off" /></th>
                     <th class="pasajeros" style="width: 1%; text-align: left; "><label>Adult(s):</label><input type="number" name="pasadult"  min="1" id="pasadult" size="2" maxlength="2" value="1"  onkeyup="valida_adultos2();" onchange="valida_adultos2();" style=" height: 13px; font-weight: bold; text-align: center; width:50px; margin-top:-21px; margin-left: 3px;"  autocomplete="off" /></th>
                     <th class="pasajeros" style="width: 1%; border-left-color: transparent; text-align: left; "><label>Child(s):</label><input type="number" name="pasanino" id="pasanino" min="0" max="15" size="2"  maxlength="2" value="0" onkeyup="valida_adultos2();valida_chicos();" onchange="valida_adultos2();valida_chicos();" style=" height: 13px; font-weight: bold; text-align: center; width:50px; margin-top:-22px; margin-left: 2px;" autocomplete="off" /></th>                     
                     <th class="standard" style="width: 5px; padding-right:0px; text-align:right;  font-weight:bold; font-size:18px; color:#191955; font-face: verdana;" colspan="2"><u>MULTIDAY&nbsp;</u></th>                     
                     <th class="superflex" style="width: 8px; padding-left:0px; text-align:left;  font-weight:bold; font-size:18px; color:#191955; font-face: verdana;" colspan="2"><u>&nbsp;TOURS</u></th>
                    
                     <th class="residente" style="width: 197px; text-align: left;  color:#000;">Type of Pass: <select style="margin-left:1px; height: 18px;" name="tipo_pasajero" id="tipo_pasajero" disabled= "disabled" ><option style="color:black;" value="0">NO RESIDENT</option><option style="color:blue;"  value="1">RESIDENT</option></select></th> 
                     <!--<th class="residente" style="width: 1px; border-left-color: transparent; "></th>-->             					  
                 </tr>
                 
                 <tr>
                     <th style="color:#000;" width="8%">Select</th>
                     <th style="color:#000;" width="8%">Trip</th>
                     <th style="color:#000;" width="12%">Departure</th>
                     <th style="color:#000;" width="12%">Arrive</th>
                     <th style="color:#000;" width="20%">' . ($resident == '1' ? 'FLA. Resident Adult' : 'Regular Price Adult') . '</th>
                     <th style="color:#000;" width="20%">' . ($resident == '1' ? 'FLA. Resident Child (3-9 Yrs)' : 'Regular Price Child') . '</th>
                     <th style="color:#000;" width="20%">Equipment</th>  
                     <th style="color:#000;" width="10%">Seats</th>
                 </tr>
             </thead>';

            $url = Doo::conf()->APP_URL;
            
          
                
            if (count($salida) > 0) {
                
                $i = 0;
                Doo::loadController("MainController");
                $main = new MainController();
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha = $anio . '-' . $mes . '-' . $dia;
                
                
                $sqlrtp300 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '300' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                $rsrtp300 = Doo::db()->query($sqlrtp300);
                $puestosocupados300 = $rsrtp300->fetchAll();    

                foreach ($puestosocupados300 as $po300){

                    $puestos_ocupados300 = $po300['CANTIDAD'];
                }   
                
                $trip300 =300;
                
                $sqlcap_300 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip300' ";
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
                
                
                //tarifa standard
                $sql_stdida300 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                  FROM  reservas 
                                  Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdida300 = Doo::db()->query($sql_stdida300, array($trip300, $fecha));
                $r_stdida300 = $rs_stdida300->fetchAll();
                $std_seats_ida300 = $r_stdida300[0]['tari_std'] ? $r_stdida300[0]['tari_std'] : 0;



                $sql_stdretorno300 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                      FROM  reservas 
                                      Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdretorno300 = Doo::db()->query($sql_stdretorno300, array($trip300, $fecha));
                $r_stdretorno300 = $rs_stdretorno300->fetchAll();
                $std_seats_retorno300 = $r_stdretorno300[0]['tari_std'] ? $r_stdretorno300[0]['tari_std'] : 0;

                $standard_total300 = $std_seats_ida300 + $std_seats_retorno300;

                //echo $standard_total;
                //tarifa superflex
                $sqlflexida300 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                  FROM  reservas 
                                  Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexida300 = Doo::db()->query($sqlflexida300, array($trip300, $fecha));
                $r_flexida300 = $rsflexida300->fetchAll();
                $superflex_seats_ida300 = $r_flexida300[0]['tari_flex'] ? $r_flexida300[0]['tari_flex'] : 0;

                $sqlflexretorno300 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                      FROM  reservas 
                                      Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexretorno300 = Doo::db()->query($sqlflexretorno300, array($trip300, $fecha));
                $r_flexretorno300 = $rsflexretorno300->fetchAll();
                $superflex_seats_retorno300 = $r_flexretorno300[0]['tari_flex'] ? $r_flexretorno300[0]['tari_flex'] : 0;

                $superflex_total300 = $superflex_seats_ida300 + $superflex_seats_retorno300;

                //echo $superflex_total;
                //webfare
                $sqlwebida300 = "SELECT (sum(pax) + sum(pax2))as webfare
                                 FROM  reservas 
                                 Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebida300 = Doo::db()->query($sqlwebida300, array($trip300, $fecha));
                $r_webida300 = $rswebida300->fetchAll();
                $webfare_ida300 = $r_webida300[0]['webfare'] ? $r_webida300[0]['webfare'] : 0;

                $sqlwebretorno300 = "SELECT (sum(pax) + sum(pax2))as webfare
                                     FROM  reservas 
                                     Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebretorno300 = Doo::db()->query($sqlwebretorno300, array($trip300, $fecha));
                $r_webretorno300 = $rswebretorno300->fetchAll();
                $webfare_retorno300 = $r_webretorno300[0]['webfare'] ? $r_webretorno300[0]['webfare'] : 0;

                $webfare_total300 = $webfare_ida300 + $webfare_retorno300;

                //echo $webfare_total;
                //superpromo
                $sqlspromoida300 = "SELECT (sum(pax) + sum(pax2))as spromo
                FROM  reservas 
                Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoida300 = Doo::db()->query($sqlspromoida300, array($trip300, $fecha));
                $r_spromoida300 = $rsspromoida300->fetchAll();
                $superpromo_ida300 = $r_spromoida300[0]['spromo'] ? $r_spromoida300[0]['spromo'] : 0;

                $sqlspromoretorno300 = "SELECT (sum(pax) + sum(pax2))as webfare
                                    FROM  reservas 
                                    Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoretorno300 = Doo::db()->query($sqlspromoretorno300, array($trip300, $fecha));
                $r_spromoretorno300 = $rsspromoretorno300->fetchAll();
                $superpromo_retorno300 = $r_spromoretorno300[0]['spromo'] ? $r_spromoretorno300[0]['spromo'] : 0;

                $superpromo_total300 = $superpromo_ida300 + $superpromo_retorno300;

                //echo $superpromo_total;
                //superdiscount
                $sqlsdiscida300 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsdiscida300 = Doo::db()->query($sqlsdiscida300, array($trip300, $fecha));
                $r_discida300 = $rsdiscida300->fetchAll();
                $superdisc_ida300 = $r_discida300[0]['sdisc'] ? $r_discida300[0]['sdisc'] : 0;

                $sqlsdiscretorno300 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rssdiscretorno300 = Doo::db()->query($sqlsdiscretorno300, array($trip300, $fecha));
                $r_discretorno300 = $rssdiscretorno300->fetchAll();
                $superdisc_retorno300 = $r_discretorno300[0]['sdisc'] ? $r_discretorno300[0]['sdisc'] : 0;

                $superdiscount_total300 = $superdisc_ida300 + $superdisc_retorno300;

                //echo $superdiscount_total;
                //tours
                //De Ida
                $sqlTourIda300 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstida300 = Doo::db()->query($sqlTourIda300, array($trip300, $fecha));
                $r_tida300 = $rstida300->fetchAll();
                $ocupadas_tour_ida300 = $r_tida300[0]['ocupadas_tour'] ? $r_tida300[0]['ocupadas_tour'] : 0;



                //De Retorno
                $sqlTourReturn300 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstreturn300 = Doo::db()->query($sqlTourReturn300, array($trip300, $fecha));
                $r_treturn300 = $rstreturn300->fetchAll();
                $ocupadas_tour_return300 = $r_treturn300[0]['ocupadas_tour'] ? $r_treturn300[0]['ocupadas_tour'] : 0;


                $tours_total300 = $ocupadas_tour_ida300 + $ocupadas_tour_return300;

                //echo $tours_total;
                //SPECIAL/////////////////////////////////////////////////////////////////

                $sql_spcida300 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcida300 = Doo::db()->query($sql_spcida300, array($trip300, $fecha));
                $r_spcida300 = $rs_spcida300->fetchAll();
                $spc_seats_ida300 = $r_spcida300[0]['tari_spc'] ? $r_spcida300[0]['tari_spc'] : 0;



                $sql_spcretorno300 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcretorno300 = Doo::db()->query($sql_spcretorno300, array($trip300, $fecha));
                $r_spcretorno300 = $rs_spcretorno300->fetchAll();
                $spc_seats_retorno300 = $r_spcretorno300[0]['tari_spc'] ? $r_spcretorno300[0]['tari_spc'] : 0;

                $special_total300 = $spc_seats_ida300 + $spc_seats_retorno300;

                //echo $special_total;

                $ocupadas300 = $standard_total300 + $superflex_total300 + $webfare_total300 + $superpromo_total300 + $superdiscount_total300 + $tours_total300 + $special_total300;
                $seats_remain300 = ($capacidad300 - $ocupadas300)-($puestos_ocupados300);
                //echo $seats_remain300;
                               
                
                
                
                
                $sqlrtp200 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '200' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                $rsrtp200 = Doo::db()->query($sqlrtp200);
                $puestosocupados200 = $rsrtp200->fetchAll();    

                foreach ($puestosocupados200 as $po200){

                    $puestos_ocupados200 = $po200['CANTIDAD'];
                }   
                
                $trip200 =200;
                
                $sqlcap_200 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip200' ";
                $rscap_200 = Doo::db()->query($sqlcap_200);
                $capac_200 = $rscap_200->fetchAll();
                
                
                foreach ($capac_200 as $cap200) {

                }

                $capacidad1_200 = $cap200['capacity'];
                $capacidad2_200 = $cap200['capacity2'];
                $capacidad3_200 = $cap200['capacity3'];
                $capacidad4_200 = $cap200['capacity4'];
                $capacidad5_200 = $cap200['capacity5'];

                $capacidad200 = $capacidad1_200 + $capacidad2_200 + $capacidad3_200 + $capacidad4_200 + $capacidad5_200;
                
                
                //tarifa standard
                $sql_stdida200 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                  FROM  reservas 
                                  Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdida200 = Doo::db()->query($sql_stdida200, array($trip200, $fecha));
                $r_stdida200 = $rs_stdida200->fetchAll();
                $std_seats_ida200 = $r_stdida200[0]['tari_std'] ? $r_stdida200[0]['tari_std'] : 0;



                $sql_stdretorno200 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                      FROM  reservas 
                                      Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdretorno200 = Doo::db()->query($sql_stdretorno200, array($trip200, $fecha));
                $r_stdretorno200 = $rs_stdretorno200->fetchAll();
                $std_seats_retorno200 = $r_stdretorno200[0]['tari_std'] ? $r_stdretorno200[0]['tari_std'] : 0;

                $standard_total200 = $std_seats_ida200 + $std_seats_retorno200;

                //echo $standard_total;
                //tarifa superflex
                $sqlflexida200 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                  FROM  reservas 
                                  Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexida200 = Doo::db()->query($sqlflexida200, array($trip200, $fecha));
                $r_flexida200 = $rsflexida200->fetchAll();
                $superflex_seats_ida200 = $r_flexida200[0]['tari_flex'] ? $r_flexida200[0]['tari_flex'] : 0;

                $sqlflexretorno200 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                      FROM  reservas 
                                      Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexretorno200 = Doo::db()->query($sqlflexretorno200, array($trip200, $fecha));
                $r_flexretorno200 = $rsflexretorno200->fetchAll();
                $superflex_seats_retorno200 = $r_flexretorno200[0]['tari_flex'] ? $r_flexretorno200[0]['tari_flex'] : 0;

                $superflex_total200 = $superflex_seats_ida200 + $superflex_seats_retorno200;

                //echo $superflex_total;
                //webfare
                $sqlwebida200 = "SELECT (sum(pax) + sum(pax2))as webfare
                                 FROM  reservas 
                                 Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebida200 = Doo::db()->query($sqlwebida200, array($trip200, $fecha));
                $r_webida200 = $rswebida200->fetchAll();
                $webfare_ida200 = $r_webida200[0]['webfare'] ? $r_webida200[0]['webfare'] : 0;

                $sqlwebretorno200 = "SELECT (sum(pax) + sum(pax2))as webfare
                                     FROM  reservas 
                                     Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebretorno200 = Doo::db()->query($sqlwebretorno200, array($trip200, $fecha));
                $r_webretorno200 = $rswebretorno200->fetchAll();
                $webfare_retorno200 = $r_webretorno200[0]['webfare'] ? $r_webretorno200[0]['webfare'] : 0;

                $webfare_total200 = $webfare_ida200 + $webfare_retorno200;

                //echo $webfare_total;
                //superpromo
                $sqlspromoida200 = "SELECT (sum(pax) + sum(pax2))as spromo
                FROM  reservas 
                Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoida200 = Doo::db()->query($sqlspromoida200, array($trip200, $fecha));
                $r_spromoida200 = $rsspromoida200->fetchAll();
                $superpromo_ida200 = $r_spromoida200[0]['spromo'] ? $r_spromoida200[0]['spromo'] : 0;

                $sqlspromoretorno200 = "SELECT (sum(pax) + sum(pax2))as webfare
                                    FROM  reservas 
                                    Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoretorno200 = Doo::db()->query($sqlspromoretorno200, array($trip200, $fecha));
                $r_spromoretorno200 = $rsspromoretorno200->fetchAll();
                $superpromo_retorno200 = $r_spromoretorno200[0]['spromo'] ? $r_spromoretorno200[0]['spromo'] : 0;

                $superpromo_total200 = $superpromo_ida200 + $superpromo_retorno200;

                //echo $superpromo_total;
                //superdiscount
                $sqlsdiscida200 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsdiscida200 = Doo::db()->query($sqlsdiscida200, array($trip200, $fecha));
                $r_discida200 = $rsdiscida200->fetchAll();
                $superdisc_ida200 = $r_discida200[0]['sdisc'] ? $r_discida200[0]['sdisc'] : 0;

                $sqlsdiscretorno200 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rssdiscretorno200 = Doo::db()->query($sqlsdiscretorno200, array($trip200, $fecha));
                $r_discretorno200 = $rssdiscretorno200->fetchAll();
                $superdisc_retorno200 = $r_discretorno200[0]['sdisc'] ? $r_discretorno200[0]['sdisc'] : 0;

                $superdiscount_total200 = $superdisc_ida200 + $superdisc_retorno200;

                //echo $superdiscount_total;
                //tours
                //De Ida
                $sqlTourIda200 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstida200 = Doo::db()->query($sqlTourIda200, array($trip200, $fecha));
                $r_tida200 = $rstida200->fetchAll();
                $ocupadas_tour_ida200 = $r_tida200[0]['ocupadas_tour'] ? $r_tida200[0]['ocupadas_tour'] : 0;



                //De Retorno
                $sqlTourReturn200 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstreturn200 = Doo::db()->query($sqlTourReturn200, array($trip200, $fecha));
                $r_treturn200 = $rstreturn200->fetchAll();
                $ocupadas_tour_return200 = $r_treturn200[0]['ocupadas_tour'] ? $r_treturn200[0]['ocupadas_tour'] : 0;


                $tours_total200 = $ocupadas_tour_ida200 + $ocupadas_tour_return200;

                //echo $tours_total;
                //SPECIAL/////////////////////////////////////////////////////////////////

                $sql_spcida200 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no = '$trip200' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcida200 = Doo::db()->query($sql_spcida200, array($trip200, $fecha));
                $r_spcida200 = $rs_spcida200->fetchAll();
                $spc_seats_ida200 = $r_spcida200[0]['tari_spc'] ? $r_spcida200[0]['tari_spc'] : 0;



                $sql_spcretorno200 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip200' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcretorno200 = Doo::db()->query($sql_spcretorno200, array($trip200, $fecha));
                $r_spcretorno200 = $rs_spcretorno200->fetchAll();
                $spc_seats_retorno200 = $r_spcretorno200[0]['tari_spc'] ? $r_spcretorno200[0]['tari_spc'] : 0;

                $special_total200 = $spc_seats_ida200 + $spc_seats_retorno200;

                //echo $special_total;

                $ocupadas200 = $standard_total200 + $superflex_total200 + $webfare_total200 + $superpromo_total200 + $superdiscount_total200 + $tours_total200 + $special_total200;
                $seats_remain200 = ($capacidad200 - $ocupadas200)-($puestos_ocupados200);
                //echo $seats_remain200;
                
                
                
                
                
                $sqlrtp100 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '100' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                $rsrtp100 = Doo::db()->query($sqlrtp100);
                $puestosocupados100 = $rsrtp100->fetchAll();    

                foreach ($puestosocupados100 as $po100){

                    $puestos_ocupados100 = $po100['CANTIDAD'];
                }   
                
                $trip100 =100;
                
                $sqlcap_100 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip100' ";
                $rscap_100 = Doo::db()->query($sqlcap_100);
                $capac_100 = $rscap_100->fetchAll();
                
                
                foreach ($capac_100 as $cap100) {

                }

                $capacidad1_100 = $cap100['capacity'];
                $capacidad2_100 = $cap100['capacity2'];
                $capacidad3_100 = $cap100['capacity3'];
                $capacidad4_100 = $cap100['capacity4'];
                $capacidad5_100 = $cap100['capacity5'];

                $capacidad100 = $capacidad1_100 + $capacidad2_100 + $capacidad3_100 + $capacidad4_100 + $capacidad5_100;
                
                
                //tarifa standard
                $sql_stdida100 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                  FROM  reservas 
                                  Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdida100 = Doo::db()->query($sql_stdida100, array($trip100, $fecha));
                $r_stdida100 = $rs_stdida100->fetchAll();
                $std_seats_ida100 = $r_stdida100[0]['tari_std'] ? $r_stdida100[0]['tari_std'] : 0;



                $sql_stdretorno100 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                      FROM  reservas 
                                      Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_stdretorno100 = Doo::db()->query($sql_stdretorno100, array($trip100, $fecha));
                $r_stdretorno100 = $rs_stdretorno100->fetchAll();
                $std_seats_retorno100 = $r_stdretorno100[0]['tari_std'] ? $r_stdretorno100[0]['tari_std'] : 0;

                $standard_total100 = $std_seats_ida100 + $std_seats_retorno100;

                //echo $standard_total;
                //tarifa superflex
                $sqlflexida100 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                  FROM  reservas 
                                  Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexida100 = Doo::db()->query($sqlflexida100, array($trip100, $fecha));
                $r_flexida100 = $rsflexida100->fetchAll();
                $superflex_seats_ida100 = $r_flexida100[0]['tari_flex'] ? $r_flexida100[0]['tari_flex'] : 0;

                $sqlflexretorno100 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                      FROM  reservas 
                                      Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsflexretorno100 = Doo::db()->query($sqlflexretorno100, array($trip100, $fecha));
                $r_flexretorno100 = $rsflexretorno100->fetchAll();
                $superflex_seats_retorno100 = $r_flexretorno100[0]['tari_flex'] ? $r_flexretorno100[0]['tari_flex'] : 0;

                $superflex_total100 = $superflex_seats_ida100 + $superflex_seats_retorno100;

                //echo $superflex_total;
                //webfare
                $sqlwebida100 = "SELECT (sum(pax) + sum(pax2))as webfare
                                 FROM  reservas 
                                 Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebida100 = Doo::db()->query($sqlwebida100, array($trip100, $fecha));
                $r_webida100 = $rswebida100->fetchAll();
                $webfare_ida100 = $r_webida100[0]['webfare'] ? $r_webida100[0]['webfare'] : 0;

                $sqlwebretorno100 = "SELECT (sum(pax) + sum(pax2))as webfare
                                     FROM  reservas 
                                     Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rswebretorno100 = Doo::db()->query($sqlwebretorno100, array($trip100, $fecha));
                $r_webretorno100 = $rswebretorno100->fetchAll();
                $webfare_retorno100 = $r_webretorno100[0]['webfare'] ? $r_webretorno100[0]['webfare'] : 0;

                $webfare_total100 = $webfare_ida100 + $webfare_retorno100;

                //echo $webfare_total;
                //superpromo
                $sqlspromoida100 = "SELECT (sum(pax) + sum(pax2))as spromo
                FROM  reservas 
                Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoida100 = Doo::db()->query($sqlspromoida100, array($trip100, $fecha));
                $r_spromoida100 = $rsspromoida100->fetchAll();
                $superpromo_ida100 = $r_spromoida100[0]['spromo'] ? $r_spromoida100[0]['spromo'] : 0;

                $sqlspromoretorno100 = "SELECT (sum(pax) + sum(pax2))as webfare
                                    FROM  reservas 
                                    Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsspromoretorno100 = Doo::db()->query($sqlspromoretorno100, array($trip100, $fecha));
                $r_spromoretorno100 = $rsspromoretorno100->fetchAll();
                $superpromo_retorno100 = $r_spromoretorno100[0]['spromo'] ? $r_spromoretorno100[0]['spromo'] : 0;

                $superpromo_total100 = $superpromo_ida100 + $superpromo_retorno100;

                //echo $superpromo_total;
                //superdiscount
                $sqlsdiscida100 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rsdiscida100 = Doo::db()->query($sqlsdiscida100, array($trip100, $fecha));
                $r_discida100 = $rsdiscida100->fetchAll();
                $superdisc_ida100 = $r_discida100[0]['sdisc'] ? $r_discida100[0]['sdisc'] : 0;

                $sqlsdiscretorno100 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rssdiscretorno100 = Doo::db()->query($sqlsdiscretorno100, array($trip100, $fecha));
                $r_discretorno100 = $rssdiscretorno100->fetchAll();
                $superdisc_retorno100 = $r_discretorno100[0]['sdisc'] ? $r_discretorno100[0]['sdisc'] : 0;

                $superdiscount_total100 = $superdisc_ida100 + $superdisc_retorno100;

                //echo $superdiscount_total;
                //tours
                //De Ida
                $sqlTourIda100 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstida100 = Doo::db()->query($sqlTourIda100, array($trip100, $fecha));
                $r_tida100 = $rstida100->fetchAll();
                $ocupadas_tour_ida100 = $r_tida100[0]['ocupadas_tour'] ? $r_tida100[0]['ocupadas_tour'] : 0;



                //De Retorno
                $sqlTourReturn100 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                    FROM  reservas 
                                    Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rstreturn100 = Doo::db()->query($sqlTourReturn100, array($trip100, $fecha));
                $r_treturn100 = $rstreturn100->fetchAll();
                $ocupadas_tour_return100 = $r_treturn100[0]['ocupadas_tour'] ? $r_treturn100[0]['ocupadas_tour'] : 0;


                $tours_total100 = $ocupadas_tour_ida100 + $ocupadas_tour_return100;

                //echo $tours_total;
                //SPECIAL/////////////////////////////////////////////////////////////////

                $sql_spcida100 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no = '$trip100' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcida100 = Doo::db()->query($sql_spcida100, array($trip100, $fecha));
                $r_spcida100 = $rs_spcida100->fetchAll();
                $spc_seats_ida100 = $r_spcida100[0]['tari_spc'] ? $r_spcida100[0]['tari_spc'] : 0;



                $sql_spcretorno100 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                    FROM  reservas 
                                    Where trip_no2 = '$trip100' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip100, $fecha));
                $r_spcretorno100 = $rs_spcretorno100->fetchAll();
                $spc_seats_retorno100 = $r_spcretorno100[0]['tari_spc'] ? $r_spcretorno100[0]['tari_spc'] : 0;

                $special_total100 = $spc_seats_ida100 + $spc_seats_retorno100;

                //echo $special_total;

                $ocupadas100 = $standard_total100 + $superflex_total100 + $webfare_total100 + $superpromo_total100 + $superdiscount_total100 + $tours_total100 + $special_total100;
                $seats_remain100 = ($capacidad100 - $ocupadas100)-($puestos_ocupados100);
                //echo $seats_remain100;
                
                       
                foreach ($salida as $e) {
                    
                    
                        
                        Doo::loadController("MainController");
                        $main = new MainController();
                        $precioTrip1 = $this->precioTripTours($e['trip_no'], $dat->type_rate, $dat->id, $anio);
                        $tourtrip = $this->params["rates"];
                        list($mes, $dia, $anio) = explode('-', $fecha_salida);
                        $fecha = $anio . '-' . $mes . '-' . $dia;
                        //echo $tourtrip;
                        //$disponible = $main->disponible($e['trip_no'], $fecha);  
                       
                        if($e['trip_no'] == 100){
                        
                               $disponible = $seats_remain100;
                               $tipo = 2;
                        
                        }
                        
                        if($e['trip_no'] == 200){
                        
                               $disponible = $seats_remain200;
                               $tipo = 2;
                        }
                        
                        if($e['trip_no'] == 300){
                        
                               $disponible = $seats_remain300;
                               $tipo = 2;
                        
                        }
                        //$priceAdult = ($resident == '1' ? $e['price4'] : $e['price'] );
                        //$priceChild = ($resident == '1' ? $e['price3'] : $e['price2'] );
                        $priceAdult = $precioTrip1['adult'];
                        $priceChild = $precioTrip1['child'];
                        //$seats = 57;
                        echo '<tr class="row' . $i . '">  
                        <td style="color:#191955;"><input type="radio" name="trip2" id="trip2' . $e['trip_no'] . '"  value="' . $e['trip_no'] . '" />
                                            <input type="hidden" name="capacidad_trip_' . $e['trip_no'] . '"  id="capacidad_trip_' . $e['trip_no'] . '" value="' . $disponible . '" />
                                            <input type="hidden" name="deptime2_' . $e['trip_no'] . '"  id="deptime2_' . $e['trip_no'] . '" value="' . $e['trip_departure'] . '" />
                                            <input type="hidden" name="arrtime2_' . $e['trip_no'] . '"  id="arrtime2_' . $e['trip_no'] . '" value="' . $e['trip_arrival'] . '" />
                                            </td>
                        <td style="color:#191955;">' . $e['trip_no'] . '</td>
                        <td style="color:#191955;">' . date("g:i a", strtotime($e['trip_departure'])) . '</td>
                        <td style="color:#191955;">' . date("g:i a", strtotime($e['trip_arrival'])) . '</td>
                        <td style="color:#191955;">' . $priceAdult . ' <input type="hidden" name="priceTransporAdult1_' . $e['trip_no'] . '"  id="priceTransporAdult_' . $e['trip_no'] . '" value="' . $priceAdult . '" /> 
                                            </td>
                        <td style="color:#191955;">' . $priceChild . '
                                            <input type="hidden" name="priceTransporChild_' . $e['trip_no'] . '"  id="priceTransporChild_' . $e['trip_no'] . '" value="' . $priceChild . '" />
                                            </td>
                        <td style="color:#191955;">' . $e['equipment'] . '</td>
                        <!--<td style="color:#191955;">' . $disponible . '</td>-->
                        <td title="' . $tituloDisponible . '" ><input type="text" name="disponible"  id="disponible' . $e['trip_no'] . '" style=" width: 24px; text-align: center; background-color: transparent; border: 0px; font-weight:normal;" value="' . $disponible . '" /></td>
                    </tr>';
                        
                        $i = 1 - $i;                         
                    
                }
                
                echo '<script> document.getElementById("save2").style.display = "none"; </script>';                            
                
            } else {

                echo '<tr>
                  <td colspan="7">No tours available</td> 
              </tr>  ';
            }
            echo ' </table>';

            $inpu = 'input[name="trip2"]';

            echo '  <p align="right">
            <input  class="selector" type="button" id="btn-SelectTrip" value="Select" /> 
		 <input  class="selector" type="button" id="btn-cancelarTrip" value="Cancel" /> 
            </p>
	   	  	   
            <div id="con">

            <script type="text/javascript">

            function valida_adultos2(){
            
            var trips = "' . $trips . '";
            var pasadult = document.getElementById("pasadult").value;
            var adultos = $("#pasadult").val();
            var peques = $("#pasanino").val();
            var totpax = parseInt(adultos) + parseInt(peques); 

            //alert(trips);

            if(trips == "100200300"){


            var radio100 = document.getElementById("trip2100").checked;
            var radio200 = document.getElementById("trip2200").checked;
            var radio300 = document.getElementById("trip2300").checked;

            var seats_remain300 = "' . $seats_remain300 . '";
            var seats_remain200 = "' . $seats_remain200 . '";
            var seats_remain100 = "' . $seats_remain100 . '";

            if(totpax > seats_remain300){                    
                document.getElementById("trip2300").style.cursor = "not-allowed";
                document.getElementById("trip2300").disabled = true;
                document.getElementById("disponible300").value = 0;
                //document.getElementById("trip2300").checked = false;
            }else{
                document.getElementById("trip2300").style.cursor = "";
                document.getElementById("trip2300").disabled = false;
                document.getElementById("disponible300").value = seats_remain300;

            }

            if(totpax > seats_remain200){                    
                document.getElementById("trip2200").style.cursor = "not-allowed";
                document.getElementById("trip2200").disabled = true;
                document.getElementById("disponible200").value = 0;
                //document.getElementById("trip2200").checked = false;
            }else{
                document.getElementById("trip2200").style.cursor = "";
                document.getElementById("trip2200").disabled = false;
                document.getElementById("disponible200").value = seats_remain200;

            }

            if(totpax > seats_remain100){                    
                document.getElementById("trip2100").style.cursor = "not-allowed";
                document.getElementById("trip2100").disabled = true;
                document.getElementById("disponible100").value = 0;
                //document.getElementById("trip2100").checked = false;
            }else{
                document.getElementById("trip2100").style.cursor = "";
                document.getElementById("trip2100").disabled = false;
                document.getElementById("disponible100").value = seats_remain100;

            }

            if(seats_remain300 == "0"){

                document.getElementById("trip2300").style.cursor = "not-allowed";
                document.getElementById("trip2300").disabled = true;
                document.getElementById("disponible300").value = 0;

            }else{

                document.getElementById("trip2300").style.cursor = "";
                document.getElementById("trip2300").disabled = false;
                document.getElementById("disponible300").value = seats_remain300;

            }

            if(seats_remain200 == "0"){

                document.getElementById("trip2200").style.cursor = "not-allowed";
                document.getElementById("trip2200").disabled = true;
                document.getElementById("disponible200").value = 0;

            }else{

                document.getElementById("trip2200").style.cursor = "";
                document.getElementById("trip2200").disabled = false;
                document.getElementById("disponible200").value = seats_remain200;

            }

            if(seats_remain100 == "0"){

                document.getElementById("trip2100").style.cursor = "not-allowed";
                document.getElementById("trip2100").disabled = true;
                document.getElementById("disponible100").value = 0;

            }else{

                document.getElementById("trip2100").style.cursor = "";
                document.getElementById("trip2100").disabled = false;
                document.getElementById("disponible100").value = seats_remain100;

            }




            //Desactivamos radios (100 200 300)

                if(radio100 == true){  
                    document.getElementById("trip2100").checked = false;  
                }

                if(radio200 == true){
                    document.getElementById("trip2200").checked = false;
                }

                if(radio300 == true){
                    document.getElementById("trip2300").checked = false;
                } 

            }

            if(trips == "100200"){

                var radio100 = document.getElementById("trip2100").checked;
                var radio200 = document.getElementById("trip2200").checked;

                //alert("100200");
                
                //Desactivamos radios (100 200)

                if(radio100 == true){  
                    document.getElementById("trip2100").checked = false;  
                }

                if(radio200 == true){
                    document.getElementById("trip2200").checked = false;
                }

            } 

            if(trips == "300"){

                var radio300 = document.getElementById("trip2300").checked;
                //alert("300");
                
                //Desactivamos radio (300)

                if(radio300 == true){  
                    document.getElementById("trip2300").checked = false;  
                }

                

            }      
                    
        }            
                
                
            $(document).ready(function() {
                
                var adulto = $("#adult").val();
                var nino =  $("#child").val();
                var trips = "' . $trips . '";
                
                if(trips == "100200300"){

                        $("#pasadult").val(adulto);
                        $("#pasanino").val(nino);
                        
                        var seats_remain100 = "' . $seats_remain100 . '";
                        var seats_remain200 = "' . $seats_remain200 . '";
                        var seats_remain300 = "' . $seats_remain300 . '";

                        var radio100 = document.getElementById("trip2100").checked;
                        var radio200 = document.getElementById("trip2200").checked;
                        var radio300 = document.getElementById("trip2300").checked;

                        var totpax = parseInt(adulto) + parseInt(nino);

                        if(totpax > seats_remain100){

                            document.getElementById("trip2100").style.cursor = "not-allowed";
                            document.getElementById("trip2100").disabled = true;
                            //document.getElementById("trip2100").checked = false;

                        }

                        if(totpax > seats_remain200){                    
                            document.getElementById("trip2200").style.cursor = "not-allowed";
                            document.getElementById("trip2200").disabled = true;
                            //document.getElementById("trip2200").checked = false;
                        }

                        if(totpax > seats_remain300){                    
                            document.getElementById("trip2300").style.cursor = "not-allowed";
                            document.getElementById("trip2300").disabled = true;
                            //document.getElementById("trip2300").checked = false;
                        }


                        if(seats_remain100 == "0"){                    
                            document.getElementById("trip2100").style.cursor = "not-allowed";
                            document.getElementById("trip2100").disabled = true;              
                        }

                        if(seats_remain200 == "0"){                    
                            document.getElementById("trip2200").style.cursor = "not-allowed";
                            document.getElementById("trip2200").disabled = true;                    
                        }

                        if(seats_remain300 == "0"){                    
                            document.getElementById("trip2300").style.cursor = "not-allowed";
                            document.getElementById("trip2300").disabled = true;  
                        }

                }
                
                if(trips == "100200"){
                    
                    var adulto = $("#adult").val();
                    var nino =  $("#child").val();
                    $("#pasadult").val(adulto);
                    $("#pasanino").val(nino);
                    
                    var seats_remain100 = "' . $seats_remain100 . '";
                    var seats_remain200 = "' . $seats_remain200 . '";
                    var radio100 = document.getElementById("trip2100").checked;
                    var radio200 = document.getElementById("trip2200").checked;
                    
                    var totpax = parseInt(adulto) + parseInt(nino);

                        if(totpax > seats_remain100){

                            document.getElementById("trip2100").style.cursor = "not-allowed";
                            document.getElementById("trip2100").disabled = true;
                            //document.getElementById("trip2100").checked = false;

                        }

                        if(totpax > seats_remain200){                    
                            document.getElementById("trip2200").style.cursor = "not-allowed";
                            document.getElementById("trip2200").disabled = true;
                            //document.getElementById("trip2200").checked = false;
                        }
                        
                        if(seats_remain100 == "0"){                    
                            document.getElementById("trip2100").style.cursor = "not-allowed";
                            document.getElementById("trip2100").disabled = true;              
                        }

                        if(seats_remain200 == "0"){                    
                            document.getElementById("trip2200").style.cursor = "not-allowed";
                            document.getElementById("trip2200").disabled = true;                    
                        }
                       
                }
                
                if(trips == "300"){
                
                    var adulto = $("#adult").val();
                    var nino =  $("#child").val();
                    $("#pasadult").val(adulto);
                    $("#pasanino").val(nino);
                    var totpax = parseInt(adulto) + parseInt(nino);
                    
                    var seats_remain300 = "' . $seats_remain300 . '";
                    var radio300 = document.getElementById("trip2300").checked;                   
                    

                    if(totpax > seats_remain300){

                        document.getElementById("trip2300").style.cursor = "not-allowed";
                        document.getElementById("trip2300").disabled = true;
                        //document.getElementById("trip2300").checked = false;

                    }
                }

                $("#pasadult").change(function(){

                    var pasadult = $("#pasadult").val(); 
                    $("#adult").val(pasadult);
                    valorTransferGeneral();
                    habitaciones();
                    calcularTotalPago();

                });

                $("#pasanino").change(function(){

                    var pasanino = $("#pasanino").val(); 
                    $("#child").val(pasanino);
                    valorTransferGeneral();
                    habitaciones();
                    calcularTotalPago();

                });

                        
                $("#btn-SelectTrip").click(function(){
                
                var trip = $("input[name=trip2]:checked").val();
                var id = $("#trip2").val();   
                var adult = $("#adult").val();
                var child = $("#child").val();				
                var fecha = "' . $fecha . '";
                var tipo = "' . $tipo .  '";                                    
                var totalpax = parseInt(adult) + parseInt(child); 
                var priceTranspor2A = $("#priceTransporAdult_"+trip).val();
                var priceTranspor2C = $("#priceTransporChild_"+trip).val();
                $("#priceTransporA2").html(priceTranspor2A);
                $("#priceTransporC2").html(priceTranspor2C);
                $("#d_trip_no").val(trip);
                $("#arrtime2").val($("#arrtime2_"+trip).val());
                $("#deptime2").val($("#deptime2_"+trip).val());
                $("#popup").fadeOut("slow");
                $("#popup").hide("fade");
                $("#mascaraP").fadeOut("slow");
                $("#mascaraP").hide("fade");	
                document.getElementById("save2").style.display = "none";
                calcularTotalPago();

                //$("#CargaTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/add/trip/" + id + "/"+tipo/' . $id_agency . ');
                $("#puestosEnUso").load("' . Doo::conf()->APP_URL . 'admin/reservas/ocuparPuesto/"+trip+"/"+tipo+"/"+fecha+"/"+totalpax+"/1"); 
                $("#mensajeTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/consultatrip");
//				$("#userr").load("' . $url . 'admin/tours/comisionTransport/"+trip+"/"+2);     

//                                $("#CargaTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/add/trip/" + valor + "/"+tipo/' . $id_agency . ');
//                                $("#puestosEnUso").load("' . Doo::conf()->APP_URL . 'admin/reservas/ocuparPuesto/"+valor+"/"+tipo+"/"+"' . $fecha . '"+"/"+totalpax+"/1");
//                                $("#mensajeTrip").load("' . Doo::conf()->APP_URL . 'admin/reservas/consultatrip");

                return false;
                
                });
			
                $("#btn-cancelarTrip").click(function(){

                                $("#popup").fadeOut("slow");
                                $("#popup").hide("fade");
                                $("#mascaraP").fadeOut("slow");
                                $("#mascaraP").hide("fade");                                        
                                document.getElementById("save2").style.display = "none";
                                return false;
                });
			
            });
        </script>
        </div>
        </form>';
        }
    }

    public function comisionTransport() {
        if (isset($this->params["trip"])) {
            $trip = $this->params["trip"];
            $tipo = $this->params["tipo"];
            Doo::loadController('MainController');
            $main = new MainController();
            $comision = $main->cal_equipament($trip);
            echo '<script>
			$("#comisionTranspor' . $tipo . '").html("' . $comision . '");
			</script>';
        }
    }

    public function valorTransfer() {
//        echo '<script>console.log("here")</script>';
        //$idpromo = $this->params["rates"];   

        if (isset($this->params["tipo1"]) && isset($this->params["tipo2"])) {
            $tipo_transfer = $this->params["tipo1"];
            $tipo_transport = $this->params["tipo2"];


            $fecha_salida = $this->params["fecha"];
            $anno = substr($fecha_salida, -4);
            $anno = $anno . '-01-01 00:00:00';


            $child = $this->params["child"];
            //echo $child;
            $adult = $this->params["adult"];
            //echo $adult;
            $id_agency = $this->params["type_rate"];
            $fecha = $this->params["fecha"];
            $sentido = $this->params["sentido"];
            list($d, $m, $a) = explode('-', $fecha);
            $a = $a . '-01-01 00:00:00';
            $totalPax = $child + $adult;
            $price = 0;
            Doo::loadModel("Agency");
            //actualizacion

            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
            $type_rate = $dat->type_rate;


//            $id_tour1 = $dat->id_tour;
//            
//            $id_tour = $id_tour1;
            $tourtrip = $this->params["rates"];
            //echo $tourtrip;

            if ($tourtrip == 0) {
                $id_tour = $dat->id_tour;
                //$id_tour = $id_tour1;
            } else {
                $id_tour = $tourtrip;
                //$id_tour = $id_tour1;
            }


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
            if ($tipo_transfer == 1) {//Es VIP
                if ($dat->id != -1) {
                    $type_rate = 2;
                    $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? and type_rate = ? and id_agency = ? and annio = ?';
                    $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                    $pricesvip = $rs->fetch();
                    if (empty($pricesvip)) {
                        $type_rate = 1;
                        $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? and type_rate = ? and annio = ?';
                        $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                        $pricesvip = $rs->fetch();
                        if (!empty($pricesvip)) {
                            $price = number_format($pricesvip ['price'], 2, '.', '');
                        }
                    } else {
                        $price = number_format($pricesvip ['price'], 2, '.', '');
                    }
                } else {
                    $type_rate = 0;
                    $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? and type_rate = ? and annio = ?';
                    $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $a));
                    $pricesvip = $rs->fetch();
                    if (!empty($pricesvip)) {
                        $price = number_format($pricesvip ['price'], 2, '.', '');
                    }
                }
            } else if ($tipo_transfer == 2) {//Es plane
                if ($dat->id != -1) {
                    $type_rate = 2;
                    $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? and type_rate = ? and id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                    $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $anno));
                    $pricesbyplane = $rs->fetch();

                    if (empty($pricesbyplane)) {
                        $type_rate = 1;
                        $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? and type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . ' ';
                        $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $anno));
                        $pricesbyplane = $rs->fetch();


                        if (!empty($pricesbyplane)) {
                            $price = number_format($pricesbyplane ['price'], 2, '.', '');
                        }
                    } else {
                        $price = number_format($pricesbyplane ['price'], 2, '.', '');
                    }
                } else {
                    $type_rate = 0;
                    $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? and type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                    $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $anno));
                    $pricesbyplane = $rs->fetch();


                    if (!empty($pricesbyplane)) {
                        $price = number_format($pricesbyplane ['price'], 2, '.', '');
                    }
                }
            } else if ($tipo_transfer == 3) {//Es Car
                if ($sentido == 1) {
                    if ($dat->id != -1) {
                        $type_rate = 1;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . ' ';
                        $rs = Doo::db()->query($sql, array($type_rate, $dat->id, $anno));
                        $pricescar = $rs->fetch();
                        if (empty($pricescar)) {
                            $type_rate = 1;
                            $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($type_rate, $anno));
                            $pricescar = $rs->fetch();
                            if (!empty($pricescar)) {
                                $price = number_format(($pricescar ['price']) * $totalPax, 2, '.', '');
                            }
                        } else {
                            $price = number_format(($pricescar ['price']) * $totalPax, 2, '.', '');
                        }
                    } else {
                        $type_rate = 0;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                        $rs = Doo::db()->query($sql, array($type_rate, $anno));
                        $pricescar = $rs->fetch();
                        if (!empty($pricescar)) {
                            $price = number_format(($pricescar ['price']) * $totalPax, 2, '.', '');
                        }
                    }
                }

                //////*******SENTIDO 2*************//////

                if ($sentido == 2) {
                    if ($dat->id != -1) {
                        $type_rate = 1;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and id_agency = ? and annio = ? and id_ratesvalid = ' . $id_tour . ' ';
                        $rs = Doo::db()->query($sql, array($type_rate, $dat->id, $anno));
                        $pricescar = $rs->fetch();
                        if (empty($pricescar)) {
                            $type_rate = 1;
                            $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                            $rs = Doo::db()->query($sql, array($type_rate, $anno));
                            $pricescar = $rs->fetch();
                            if (!empty($pricescar)) {
                                $price = number_format(($pricescar ['price']) * $totalPax, 2, '.', '');
                            }
                        } else {
                            $price = number_format(($pricescar ['price']) * $totalPax, 2, '.', '');
                        }
                    } else {
                        $type_rate = 0;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' . $id_tour . '';
                        $rs = Doo::db()->query($sql, array($type_rate, $anno));
                        $pricescar = $rs->fetch();
                        if (!empty($pricescar)) {
                            $price = number_format(($pricescar ['price']) * $totalPax, 2, '.', '');
                        }
                    }
                }
            }
            if ($tipo_transport == 1) {
//                sleep(1);
            }


//            print_r(Doo::db()->showSQL());
//            echo $price;
//            exit;
            //Valor del transporte
            //$("#priceTransporA' . $tipo_transport . '").html("' . ($price / 2) . '");
            //$("#priceTransporC' . $tipo_transport . '").html("' . ($price / 2) . '");

            echo '<script>
			     $("#priceTransporA' . $tipo_transport . '").html("' . ($price / 2) . '");
			     $("#priceTransporC' . $tipo_transport . '").html("' . ($price / 2) . '");
                                
		</script>';


            //Valor de la comision
            $servis = $this->comision_servis();
            $code = '006'; //servis_code de transfer
            $comi = $servis[$code];

            echo '<script>
			    $("#comisionTranspor' . $tipo_transport . '").html("' . $comi . '");
		</script>';

            //Calculamos el total
            echo '<script>  calcularTotalPago(); </script>';
        }
    }

    public function priceexten() {
        $id = $this->params["id"];
        $id_agency = $this->params["id_agency"];
        $num = $this->params["num"];
        Doo::loadModel("Agency");
        if ($id_agency != -1) {
            $dat = new Agency();
            $dat->id = $id_agency;
//            $type_rate = $dat->type_rate;
//            GLOBAL $tarifa1;
//            $tarifa1 = $type_rate;

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

        $precio = $this->precio_extencion($id, $dat->type_rate);

        if ($num == 1) {
            echo '<script> $("#priceExt_from1").html("' . $precio . '");</script>';
        } else if ($num == 4) {
            echo '<script> $("#priceExt_to2").html("' . $precio . '");</script>';
        }
        echo '<script>calcularTotalPago();</script>';
    }

    public function precio_extencion($id, $type_rate) {
        if ($type_rate == 0) {
            $sql = "SELECT precio FROM extension WHERE id = ?";
        } else {
            $sql = "SELECT precio_neto as precio FROM extension WHERE id = ?";
        }
        $rs = Doo::db()->query($sql, array($id));
        $datos = $rs->fetch();
        return $datos['precio'];
    }

    public function habitacionesAsignables() {
        $totalAdult = $this->params["totaladult"];
        $select = $this->params["select"];
        if ($totalAdult > 3) {
            $rooms = 4;
//            $select = 4;
        } else {
            $rooms = $totalAdult;
        }
        echo "<option value='0'></option>";
        for ($i = 0; $i < $rooms; $i++) {
            if ($i == 0) {
                echo '<option  ' . ((($i + 1) == $select) ? "selected" : '') . '  value="' . ($i + 1) . '">' . ($i + 1) . ' Room</option>';
            } else {
                echo '<option  ' . ((($i + 1) == $select) ? "selected" : '') . ' value="' . ($i + 1) . '">' . ($i + 1) . ' Rooms</option>';
            }
        }
    }

    public function habitaciones() {
        $adult = $this->params["adult"];
        $child = $this->params["child"];
        $totalpax = $adult + $child;
        if ($adult > 4) {
            $rooms = 4;
        } else {
            $rooms = $adult; //////////////////////////////////////////////
        }
        if (isset($this->params["num"])) {
            $rooms = $this->params["num"];
        }
        //Opciones de select
        $adult = ($adult > 4) ? 4 : $adult;
        $opAdult = '';
        $opChild = '';
        for ($j = 1; $j <= $adult; $j++) {
            $opAdult .= '<option value="' . $j . '"   ' . (($j == 1) ? ' selected ' : '') . ' >' . $j . '</option>';
        }
        $child = ($child > 6) ? 6 : $child;
        for ($j = 0; $j <= $child; $j++) {
            $opChild .= '<option value="' . $j . '"    >' . $j . '</option>';
        }

        echo '&nbsp;&nbsp;&nbsp;
		<ul style="display:inline-table; border: 1px solid #AC1B29; padding: 7px; border-radius: 10px 10px 10px 10px;"  > ';
        for ($i = 1; $i <= $rooms; $i++) {
            echo '<li style="display:inline-table"> 
					<table width="142" border="0"  id="tours-list" cellspacing="0" cellpadding="0"  >
						<tr>
							<td width="52" rowspan="2">Room' . $i . '</td>
							<td width="42">Adults</td>
							<td width="34">Child</td>
						</tr>
						<tr>
							<td>
								<select name="adult' . $i . '" id="adult' . $i . '" class="tours-list" style="height: 25px;">
									' . $opAdult . '
								</select>
							</td>
							<td> <select name="child' . $i . '" id="child' . $i . '" class="tours-list" style="height: 25px;">'
            . $opChild .
            '</select>
							</td>
						</tr>
					</table>
					<script>
					$("#adult' . $i . '").change(function(){
						var val = $( this ).val();
						if(' . $child . ' != 0){
							$("#child' . $i . ' option").remove();
							for(var i = 0; i<=(7-val); i++){
								$("#child' . $i . '").append("<option value="+i+">"+i+"</option>");
							}
						}
					});		
					</script>
				</li>';
        }
        echo '</ul> ';
    }

    public function acomodacion() {

        ///:rooms/:r_adult1/:r_adult2/:r_adult3/:r_adult4/:r_child1/:r_child2/:r_child3/:
        $rooms = $this->params["rooms"];
        $r_adult1 = $this->params["r_adult1"];
        $r_adult2 = $this->params["r_adult2"];
        $r_adult3 = $this->params["r_adult3"];
        $r_adult4 = $this->params["r_adult4"];
        $r_child1 = $this->params["r_child1"];
        $r_child2 = $this->params["r_child2"];
        $r_child3 = $this->params["r_child3"];
        $r_child4 = $this->params["r_child4"];

        $adult = $r_adult1 + $r_adult2 + $r_adult3 + $r_adult4;
        $child = $r_child1 + $r_child2 + $r_child3 + $r_child4;


        //Opciones de select
        $adult = ($adult > 4) ? 4 : $adult;
        $opAdult = '';
        $opChild = '';
        for ($j = 1; $j <= $adult; $j++) {
            $opAdult .= '<option value="' . $j . '"   ' . (($j == 1) ? ' selected ' : '') . ' >' . $j . '</option>';
        }
        $child = ($child > 6) ? 6 : $child;
        for ($j = 0; $j <= $child; $j++) {
            $opChild .= '<option value="' . $j . '"    >' . $j . '</option>';
        }

        echo '&nbsp;&nbsp;&nbsp;
		<ul style="display:inline-table; border: 1px solid #AC1B29; padding: 6px; border-radius: 10px 10px 10px 10px;"> ';
        for ($i = 1; $i <= $rooms; $i++) {
            if ($this->params["r_adult" . ($i)] + $this->params["r_child" . ($i)] > 0) {
                echo '<li style="display:inline-table"> 
						<table width="142" border="0"  id="tours-list" cellspacing="0" cellpadding="0"  >
							<tr>
								<td width="52" rowspan="2">Room ' . $i . '</td>
								<td width="42">Adults</td>
								<td width="34">Child</td>
							</tr>
							<tr>
								<td>
									<select name="adult' . $i . '" id="adult' . $i . '" class="tours-list">';
                for ($j = 0; $j <= $adult; $j++) {
                    echo '<option ' . (($j == $this->params["r_adult" . ($i)]) ? " selected " : '') . ' value="' . $j . '"    >' . $j . '</option>';
                }
                echo '</select>
								</td>
								<td> <select name="child' . $i . '" id="child' . $i . '" class="tours-list">';
                for ($j = 0; $j <= $child; $j++) {
                    echo '<option ' . (($j == $this->params["r_child" . ($i)]) ? " selected " : '') . ' value="' . $j . '"    >' . $j . '</option>';
                }
                echo '</select>
								</td>
							</tr>
						</table>
						<script>
						$("#adult' . $i . '").change(function(){
							var val = $( this ).val();
							if(' . $child . ' != 0){
								$("#child' . $i . ' option").remove();
								for(var i = 0; i<=(7-val); i++){
									$("#child' . $i . '").append("<option value="+i+">"+i+"</option>");
								}
							}
						});		
						</script>
					</li>';
            }
        }
        echo '</ul> ';
    }

    public function tipoHabitacion($room1, $room2, $room3, $room4) {
        //TIPOS DE HABITACIONES
//        $bandera=2;

        $fecha_salida = $this->params["fecha_salida"];
        $fecha_retorno = $this->params["fecha_retorno"];

        list($mes, $dia, $anio) = explode('-', $fecha_salida);
        $fecha_salida = $anio . '-' . $mes . '-' . $dia;
        list($mes, $dia, $anio) = explode('-', $fecha_retorno);
        $fecha_retorno = $anio . '-' . $mes . '-' . $dia;
        $f0 = strtotime($fecha_salida);
        $f1 = strtotime($fecha_retorno);
        $resultado = ($f1 - $f0);
        $resultado = $resultado / 60 / 60 / 24;
        $resultado = round($resultado);
        $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
        $noches = ($resultado + 1 > 0) ? $dias - 1 : '';

        //$bandera =  $noches;
        //echo $bandera;



        $sgl = $dbl = $tpl = $qua = 0;
        //echo  $noches;

        switch ($room1) {
            case 1:
                $sgl++;
                break;
            case 2:
                $dbl++;
                break;
            case 3:
                $tpl++;
                break;
            case 4:
                $qua++;
                break;
        }

        switch ($room2) {
            case 1:
                $sgl++;
                break;
            case 2:
                $dbl++;
                break;
            case 3:
                $tpl++;
                break;
            case 4:
                $qua++;
                break;
        }
        switch ($room3) {
            case 1:
                $sgl++;
                break;
            case 2:
                $dbl++;
                break;
            case 3:
                $tpl++;
                break;
            case 4:
                $qua++;
                break;
        }

        switch ($room4) {
            case 1:
                $sgl++;
                break;
            case 2:
                $dbl++;
                break;
            case 3:
                $tpl++;
                break;
            case 4:
                $qua++;
                break;
        }
        $tipos = array();
        $tipos['sgl'] = $sgl;
        $tipos['dbl'] = $dbl;
        $tipos['tpl'] = $tpl;
        $tipos['qua'] = $qua;
        return $tipos;
    }

    public function selectHotel() {
        if (isset($this->params["id"])) {

            $idpromo = $this->params["rates"];
            $frday = $this->params["frday"];
            //echo $frday;

            $id_hotel = $this->params["id"];
            $fecha_salida = $this->params["fecha_salida"];
            $fecha_retorno = $this->params["fecha_retorno"];
            $room1 = $this->params["room1"];
            $room2 = $this->params["room2"];
            $room3 = $this->params["room3"];
            $room4 = $this->params["room4"];

            $room1_c = $this->params["room1_c"];
            $room2_c = $this->params["room2_c"];
            $room3_c = $this->params["room3_c"];
            $room4_c = $this->params["room4_c"];

            $id_agency = $this->params["id_agency"];
            $nochesfree = $this->params["nochesfree"];
            //$frd_adult = $this->params["fdadult"];
            //$frd_child = $this->params["fdchild"];         
            $free_night_buffet = $this->params["free_night_buffet"];
            $noches_escogidas = $this->params["noches_escogidas"];
            $url = Doo::conf()->APP_URL;
            list($mes, $dia, $anio) = explode('-', $fecha_salida);
            $fecha_salida = $anio . '-' . $mes . '-' . $dia;
            list($mes, $dia, $anio) = explode('-', $fecha_retorno);
            $fecha_retorno = $anio . '-' . $mes . '-' . $dia;
            //////Actualizacion
            $sgl = $dbl = $tpl = $qua = 0;
            $tipos = $this->tipoHabitacion($room1, $room2, $room3, $room4);
            $sgl = $tipos['sgl'];
            $dbl = $tipos['dbl'];
            $tpl = $tipos['tpl'];
            $qua = $tipos['qua'];
            $totaladult = $room1 + $room2 + $room3 + $room4;
            $totalchild = $room1_c + $room2_c + $room3_c + $room4_c;
            $totalpax = $room1 + $room2 + $room3 + $room4 + $room1_c + $room2_c + $room3_c + $room4_c;
            //Noches
            $f0 = strtotime($fecha_salida);
            $f1 = strtotime($fecha_retorno);
            $resultado = ($f1 - $f0);
            $resultado = $resultado / 60 / 60 / 24;
            $resultado = round($resultado);
            $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
            $noches = ($resultado + 1 > 0) ? $dias - 1 : '';
            /////////////////////////////////////////////////////////////
            ////////////////echo $noches;
            /////////////////////////////////////////////////////////////
            $bandera = $noches;
            ////////////echo $bandera;
            //Calculos costo hotel
            if ($id_agency == -1 || $id_agency == '' || $id_agency == 0) {
                $type_rate = 9;
                echo '<script>alert("This hotel has no price configured for selected dates");
                                       
                                       </script>';
            } else {
                Doo::loadModel("Agency");
                $dat = new Agency();
                $dat->id = $id_agency;
                $dat = Doo::db()->find($dat, array('limit' => 1));
                $type_rate = $dat->type_rate;


                $id_tour = $dat->id_tour;
                //echo  $id_tour;
                //echo $type_rate;
                GLOBAL $tarifa1;
                $tarifa1 = $id_tour;
                //echo $tarifa1;
                //$tarifa1 = 68;
            }
//            print_r($id_agency);
//            exit;
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // $costohotel = $this->costoHotel($fecha_salida, $fecha_retorno, $id_hotel, $room1, $room2, $room3, $room4, $frd_adult, $frd_child, $type_rate);
            $costohotel = $this->costoHotel($fecha_salida, $fecha_retorno, $id_hotel, $room1, $room2, $room3, $room4, $nochesfree, $free_night_buffet, $type_rate);
//            print_r($costohotel);
            //echo $nochesfree;
            //echo $diasfree;
//            exit;
            //if ($costohotel['total'] <= 0 && $frd_adult == 0 && $frd_child == 0) {
            if ($costohotel['total'] <= 0 && $nochesfree == 0) {
                echo '<script>alert("This hotel has no price configured for selected dates");
                                        $("#totalpriceNights").html("0.00");
                                        $("#totalpriceBreakfast").html("0.00");
                                        $("#hotel_nochesfree_buffet").val("0.00");
                                        calcularTotalPago();</script>';
            } else {
                /** rutina foreach hoteles */
                //Fin Calculos costo hotel
                //Hotel a mostrar
                $tabla = ' <table class="grid2" cellspacing="0" cellpadding="0" id="table_7">  
                                <thead>
									<th width="25%">NAME</th>
									<th width="4%">PAX</th>
                                                                        <th width="15%">START DATE</th>
                                                                        <th width="15%">END DATE</th>
									<th width="4%">NIGHTS</th>
									<th width="0%"></th>  
                                                                        <th width="8%">FREE DAYS</th>
									<th width="4%">SQL</th>
									<th width="4%">DBL</th>
									<th width="4%">TPL</th>
									<th width="4%">QUA</th>
									<th width="15%">BREAKFAST</th>
									<th width="15%"></th>
									
                                </thead>
								<tbody>
                            ';
                $sql = "SELECT id, codigo, categoria, nombre, address, city, zipcode, contacname, phone, email, webpage, breakfast, resoftfe, description, image1, super_breakfast
				FROM hoteles 
				WHERE id  NOT IN (
					SELECT id_hotel FROM  ratesblock WHERE  (
							ratesblock.fecha_ini BETWEEN  $fecha_salida AND $fecha_retorno ) 
							OR (ratesblock.fecha_fin BETWEEN  $fecha_salida AND $fecha_retorno)  
							OR (
								($fecha_salida BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin ) 
								OR ($fecha_retorno BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin )
							)  
                           )
				AND id = '" . $id_hotel . "' AND  estado = 1 ";
                $rs = Doo::db()->query($sql, array($id_hotel));
                $hoteles = $rs->fetchAll();
                $total_por_pax = 0;
                $total_priceBreakfast_pax = 0;




                if (empty($hoteles)) {
                    foreach ($_SESSION['tours']['hoteles_n'] as $dato) {
                        $total_por_pax += $dato['total_price'];
                        $total_priceBreakfast_pax += $dato['priceBreakfast'];


                        if ($dato['breakfast'] == 1) {
                            $breakfastdato = "FREE BREAKFAST ";
                        } else {
                            $breakfastdato = "NOT BREAKFAST ";
                        }

                        $tabla .= '<tr class="row0">
									<td>' . trim($dato['nombre']) . '</th>
									<td>' . $dato['totalpax'] . '</td>
									<td>' . $dato['starting_date'] . '</td>
									<td>' . $dato['ending_date'] . '</td>
									<td>' . $dato['noches'] . '</td>
									<td></td>
									<td>' . $frday . '</td>
									<td title=" $ ' . number_format($dato['sgl'], 2, '.', ',') . '">' . $dato['sql_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['dbl'], 2, '.', ',') . '">' . $dato['dbl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['tpl'], 2, '.', ',') . '">' . $dato['tpl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['qua'], 2, '.', ',') . '">' . $dato['qua_indicativo'] . '</td>
									<td id="breakfastdato" title="Delete">' . $breakfastdato . '</td>
									<td id="" ><img src="' . $url . 'global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_hotel_' . $dato['id'] . '_' . $dato['id'] . '" onclick=delete_hotel("' . $dato['id'] . '"); /></td>
						           <input type="hidden" name="hotel_id_select_0" id="hotel_id_select_' . $dato['id'] . '" value="' . $dato['id'] . '">
							   <input type="hidden" name="hotel_breakfast_' . $dato['id'] . '" id="hotel_breakfast_' . $dato['id'] . '" value="' . $dato['breakfast'] . '">
							   <input type="hidden" name="hotel_buffet_' . $dato['id'] . '" id="hotel_buffet_' . $dato['id'] . '" value="1">
							   <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min=""  value="">
                                                           <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min="0"  value="' . $frday . '">
							   <input type="hidden" name="hotel_resort_' . $dato['id'] . '" id="hotel_resort_' . $dato['id'] . '" value="">
							   <input type="hidden" name="hotel_category_' . $dato['id'] . '" id="hotel_category_' . $dato['id'] . '" value="' . $dato['categoria'] . '">
                                                           <input type="hidden" name="hotel_subtotal_' . $dato['id'] . '" id="hotel_subtotal_' . $dato['id'] . '" value="' . $dato['total'] . '">
			 </tr>';
                    }


                    echo '<input type="hidden" name="hotel_id_select" id="hotel_id_select" value="1"><script>
				$("#totalpriceNights").html(' . $total_por_pax . ');
				$("#totalpriceBreakfast").html(' . $total_priceBreakfast_pax . ');                                
				//$("#frday").val(' . $frday . ');
				calcularTotalPago();validarHotel();
		     </script>';

                    echo $tabla . '</tbody></table>';
                } else {
                    /** nueva rutina para multiples hoteles en reservas de multidays */
                    $hotel = Doo::db()->getOne("Hoteles", array("where" => "id = ?", "param" => array($id_hotel)));

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["id"] = $hotel->id;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["nombre"] = $hotel->nombre;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["categorias"] = $hotel->categoria;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["breakfast"] = $hotel->breakfast;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["super_breakfast"] = 0;


                    ///obtenemos el costo del hotel///////////////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////////////////


                    GLOBAL $categor;
                    $categor = $hotel->categoria;

                    //GLOBAL $categor;
                    //GLOBAL $bandera;
                    GLOBAL $fdv_adult21;
                    GLOBAL $fdv_child21;
                    GLOBAL $fdv_adult32;
                    GLOBAL $fdv_child32;
                    GLOBAL $fdv_adult43;
                    GLOBAL $fdv_child43;
                    GLOBAL $fdv_adult54;
                    GLOBAL $fdv_child54;
                    GLOBAL $fdv_adult65;
                    GLOBAL $fdv_child65;
                    GLOBAL $fdv_adult76;
                    GLOBAL $fdv_child76;
                    GLOBAL $fdv_adult87;
                    GLOBAL $fdv_child87;
                    GLOBAL $fdv_adult98;
                    GLOBAL $fdv_child98;

                    GLOBAL $fdm_adult21;
                    GLOBAL $fdm_child21;
                    GLOBAL $fdm_adult32;
                    GLOBAL $fdm_child32;
                    GLOBAL $fdm_adult43;
                    GLOBAL $fdm_child43;
                    GLOBAL $fdm_adult54;
                    GLOBAL $fdm_child54;
                    GLOBAL $fdm_adult65;
                    GLOBAL $fdm_child65;
                    GLOBAL $fdm_adult76;
                    GLOBAL $fdm_child76;
                    GLOBAL $fdm_adult87;
                    GLOBAL $fdm_child87;
                    GLOBAL $fdm_adult98;
                    GLOBAL $fdm_child98;
                    //GLOBAL $idrv;
                    //GLOBAL $desayuno;
                    //echo $desayuno;
                    //echo $idrv;
                    //echo  $fdv_adult21;
                    //echo  $fdv_child21;

                    GLOBAL $chv21;
                    //echo $chv21;

                    GLOBAL $chm21;
                    //echo $chm21;

                    GLOBAL $chv32;
                    //echo $chv32;

                    GLOBAL $chm32;
                    //echo $chm32;

                    GLOBAL $chv43;
                    //echo $chv43;

                    GLOBAL $chm43;
                    //echo $chm43;

                    GLOBAL $chv54;
                    GLOBAL $chm54;

                    GLOBAL $chv65;
                    GLOBAL $chm65;

                    GLOBAL $chv76;
                    GLOBAL $chm76;

                    GLOBAL $chv87;
                    GLOBAL $chm87;

                    GLOBAL $chv98;
                    GLOBAL $chm98;



                    // VALUE 1 NOCHE CATEGORIA 2
                    //AND $type_rate == 0
//                    if ($bandera == 1 && $categor == 2){

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["id"] = $hotel->id;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["nombre"] = $hotel->nombre;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["categorias"] = $hotel->categoria;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["breakfast"] = $hotel->breakfast;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["super_breakfast"] = 0;


                    ///obtenemos el costo del hotel///////////////////////////////////////////////////////////
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["total_price"] = $costohotel['total'];

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["sql"] = $costohotel['sgl'];
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["dbl"] = $costohotel['dbl'];
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["tpl"] = $costohotel['tpl'];
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["qua"] = $costohotel['qua'];

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["sql_indicativo"] = $sgl;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["dbl_indicativo"] = $dbl;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["tpl_indicativo"] = $tpl;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["qua_indicativo"] = $qua;


                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room1"] = $room1;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room2"] = $room2;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room3"] = $room3;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room4"] = $room4;

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room1_c"] = $room1_c;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room2_c"] = $room2_c;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room3_c"] = $room3_c;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["room4_c"] = $room4_c;

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["rooms"] = $sgl + $dbl + $tpl + $qua;

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["priceBreakfast"] = $costohotel['priceBreakfast'] * $totaladult;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["nochesfree"] = $nochesfree;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["totalpax"] = $totalpax;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["noches"] = $noches;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["dias"] = $dias;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["free_night_buffet"] = $free_night_buffet;

                    $_SESSION['tours']['hoteles_n'][$hotel->id]["starting_date"] = $fecha_salida;
                    $_SESSION['tours']['hoteles_n'][$hotel->id]["ending_date"] = $fecha_retorno;

                    $room1_c = $this->params["room1_c"];
                    $room2_c = $this->params["room2_c"];
                    $room3_c = $this->params["room3_c"];
                    $room4_c = $this->params["room4_c"];
                    $totalchild = $room1_c + $room2_c + $room3_c + $room4_c;
                    $total_por_pax = 0;
                    $total_priceBreakfast_pax = 0;



                    /**  fin de nueva rutina */
                    foreach ($_SESSION['tours']['hoteles_n'] as $dato) {



                        $total_por_pax += $dato['total_price'];
                        $total_priceBreakfast_pax += $dato['priceBreakfast'];
                        if ($dato['breakfast'] == 1) {
                            $breakfastdato = "FREE BREAKFAST ";
                        } else {
                            $breakfastdato = "NOT BREAKFAST ";
                        }



                        //$type_rate == 0


                        $tabla .= '<tr class="row0">
									<td>' . trim($dato['nombre']) . '</th>
									<td>' . $dato['totalpax'] . '</td>
                                                                        <td>' . $dato['starting_date'] . '</td>
									<td>' . $dato['ending_date'] . '</td>
									<td>' . $dato['noches'] . '</td>
                                                                        <td></td>
                                                                        <td>' . $frday . '</td>
									<td title=" $ ' . number_format($dato['sgl'], 2, '.', ',') . '">' . $dato['sql_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['dbl'], 2, '.', ',') . '">' . $dato['dbl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['tpl'], 2, '.', ',') . '">' . $dato['tpl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['qua'], 2, '.', ',') . '">' . $dato['qua_indicativo'] . '</td>
									<td id="breakfastdato" title="$ 0.00">' . $breakfastdato . '</td>
									<td  title="Delete"><img src="' . $url . 'global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_hotel_' . $dato['id'] . '_' . $dato['id'] . '" onclick=delete_hotel("' . $dato['id'] . '"); /></td>
									<input type="hidden" name="hotel_id_select_0" id="hotel_id_select_' . $dato['id'] . '" value="' . $dato['id'] . '">
							   <input type="hidden" name="hotel_breakfast_' . $dato['id'] . '" id="hotel_breakfast_' . $dato['id'] . '" value="' . $dato['breakfast'] . '">
							   <input type="hidden" name="hotel_buffet_' . $dato['id'] . '" id="hotel_buffet_' . $dato['id'] . '" value="1">
							   <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min="" value="">
							   <input type="hidden" name="hotel_nochesfree_buffet_' . $dato['id'] . '" id="hotel_nochesfree_buffet_' . $dato['id'] . '" value="' . $frday . '">
							   <input type="hidden" name="hotel_resort_' . $dato['id'] . '" id="hotel_resort_' . $dato['id'] . '" value="">
							   <input type="hidden" name="hotel_category_' . $dato['id'] . '" id="hotel_category_' . $dato['id'] . '" value="' . $dato['categoria'] . '">
                               <input type="hidden" name="hotel_subtotal_' . $dato['id'] . '" id="hotel_subtotal_' . $dato['id'] . '" value="' . $dato['total_price'] . '">
							   </tr>';
                    }

                    echo '<input type="hidden" name="hotel_id_select" id="hotel_id_select" value="1"><script>
				var vacio = "";
                                $("#totalpriceNights").html(' . $total_por_pax . ');
				$("#totalpriceBreakfast").html(' . $total_priceBreakfast_pax . ');
                                $("#hotel_name").val(vacio);
                                document.getElementById("add_Hotel_list").disabled = true;
				//$("#hotel_nochesfree_buffet").val(' . $frday . ');
				calcularTotalPago();validarHotel();
		     </script>';
                    echo $tabla . '</tbody></table>';
                    //Fin hotel a mostrar
                    //Mensaje de buffet
                    if ($hotel->super_breakfast == 1) {
                        echo '<div>';
                        echo "<script>
						$('#buffetYes').attr('checked',false);
						$('#buffetNo').attr('checked',false);
						$('#buffet').dialog({
							modal: false,
							width: 600,
							height:200,
						});
					</script>";
                        echo '</div>';
                    }
                    //Fin Mensaje buffet
                }
            }
        }
    }

    public function activar_super_breakfast() {
        $id_hotel = $this->params["id_hotel"];
        $estado = $this->params["estado"];
        if (isset($_SESSION['tours']['hoteles_n'])) {
            $_SESSION['tours']['hoteles_n'][$id_hotel]["super_breakfast"] = $estado;
        }
    }

    public function delete_hotel() {
        $id_hotel = $this->params["id_hotel"];
        $frday = $this->params["frday"];

        //$dato['free_night_buffet'] = 0;
        unset($_SESSION['tours']['hoteles_n'][$id_hotel]);
        $url = Doo::conf()->APP_URL;
        $tabla = ' <table class="grid2" cellspacing="0" cellpadding="0" id="table_7">  
                                <thead>
									<th width="25%">NAME</th>
									<th width="4%">PAX ADULTS</th>
                                                                        <th width="15%">START DATE</th>
                                                                        <th width="15%">END DATE</th>
									<th width="4%">NIGHTS</th>
                                                                        <th width="0%"></th>
                                                                        <th width="8%">FREE DAYS</th>
									<th width="4%">SQL</th>
									<th width="4%">DBL</th>
									<th width="4%">TPL</th>
									<th width="4%">QUA</th>
									<th width="15%">BREAKFAST</th>
									<th width="15%"></th>
									
                                </thead>
								<tbody>
                            ';
        $total_por_pax = 0;
        $total_priceBreakfast_pax = 0;
        if (!empty($_SESSION['tours']['hoteles_n'])) {

            foreach ($_SESSION['tours']['hoteles_n'] as $dato) {

                $total_por_pax += $dato['total_price'];
                $total_priceBreakfast_pax += $dato['priceBreakfast'];
                if ($dato['breakfast'] == 1) {
                    $breakfastdato = "FREE BREAKFAST ";
                } else {
                    $breakfastdato = "NOT BREAKFAST ";
                }

                $tabla .= '<tr class="row0">
									<td>' . trim($dato['nombre']) . '</th>
									<td>' . $dato['totalpax'] . '</td>
                                                                        <td>' . $dato['starting_date'] . '</td>
									<td>' . $dato['ending_date'] . '</td>
									<td>' . $dato['noches'] . '</td>
                                                                        <td>' . $dato['nochesfree'] . '</td>    
                                                                        <td>' . $frday . '</td>    
									<td title=" $ ' . number_format($dato['sgl'], 2, '.', ',') . '">' . $dato['sql_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['dbl'], 2, '.', ',') . '">' . $dato['dbl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['tpl'], 2, '.', ',') . '">' . $dato['tpl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['qua'], 2, '.', ',') . '">' . $dato['qua_indicativo'] . '</td>
									<td id="breakfastdato" title="$ 0.00">' . $breakfastdato . '</td>
									<td title="Delete"><img src="' . $url . 'global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_hotel_' . $dato['id'] . '_' . $dato['id'] . '" onclick=delete_hotel("' . $dato['id'] . '"); /></td>
									<input type="hidden" name="hotel_id_select_0" id="hotel_id_select_' . $dato['id'] . '" value="' . $dato['id'] . '">
							   <input type="hidden" name="hotel_breakfast_' . $dato['id'] . '" id="hotel_breakfast_' . $dato['id'] . '" value="' . $dato['breakfast'] . '">
							   <input type="hidden" name="hotel_buffet_' . $dato['id'] . '" id="hotel_buffet_' . $dato['id'] . '" value="1">
							   <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min="0" value="' . $dato['nochesfree'] . '">
							   <input type="hidden" name="hotel_nochesfree_buffet_' . $dato['id'] . '" id="hotel_nochesfree_buffet_' . $dato['id'] . '" value="' . $frday . '">
							   <input type="hidden" name="hotel_resort_' . $dato['id'] . '" id="hotel_resort_' . $dato['id'] . '" value="">
							   <input type="hidden" name="hotel_category_' . $dato['id'] . '" id="hotel_category_' . $dato['id'] . '" value="' . $dato['categoria'] . '">
                               <input type="hidden" name="hotel_subtotal_' . $dato['id'] . '" id="hotel_subtotal_' . $dato['id'] . '" value="' . $dato['total_price'] . '">
			 </tr>';
            }
            //$free_buffet = 0;
            //$("#free_buffet").val(' . $free_buffet . '); 
            //$free_night_buffet=0;
            echo '<script>

				$("#totalpriceNights").html(' . $total_por_pax . ');
				$("#totalpriceBreakfast").html(' . $total_priceBreakfast_pax . ');    
				//$("#frday").val(' . $frday . ');                                
				calcularTotalPago();
		     </script>';
            echo $tabla . '</tbody></table>';
        } else {
            echo '<script>
                                var vacio = "";
				$("#totalpriceNights").html(0);
				$("#totalpriceBreakfast").html(0);
                                $("#hotel_name").val(vacio);
                                document.getElementById("add_Hotel_list").disabled = true;
				//$("#frday").val(0);
				calcularTotalPago();
		     </script>';
        }
    }

    public function redisHotel() {
        extract($_POST, EXTR_SKIP);
        if (isset($this->params["id"])) {
            Doo::loadModel('Tours');
            $from_traffic = '';
            $to_traffic = '';
            $tour = new Tours();
            $tour->id = $this->params['id_tour'];

            $tour = Doo::db()->getOne($tour);
            $id_agency = $this->params['id_agency'];
            if ($id_agency == -1 || $id_agency == '' || $id_agency == 0) {
                $type_rate = 9;
            } else {
                Doo::loadModel("Agency");
                $dat = new Agency();
                $dat->id = $id_agency;
                $dat = Doo::db()->find($dat, array('limit' => 1));
                $type_rate = $dat->type_rate;
            }
            $hotel_buffet = $this->params['buffet'];
            $fecha_salida = $this->params['fecha_salida'];
            $fecha_retorno = $this->params['fecha_retorno'];
            $hotel_id_select = $this->params['id'];
            $hotel_nochesfree = $this->params['nochesfree'];
            $hotel_nochesfree_buffet = $this->params['free_buffet'];
            $noches_escogidas = $this->params['noches_escogidas'];

            Doo::loadModel("Hotel_Reserves");
            $sql = "select * from hotel_reserves where id_tours = ? order by id DESC";
            $rsa = Doo::db()->query($sql, array($tour->id));
            $rs = ($rsa->fetchAll());
            $last_reserve = $rs[0];

            if ($last_reserve['id_hotel'] == $hotel_id_select) {
                echo '<script>
                        alert("Are you sending the customer to the same hotel?");
                        $("#mascaraP").hide();
                        $("#dialog_message7").dialog("close");
                        $("#dialog_message6").dialog("close");
                      </script>';
                exit;
            }
            $hotel = new Hotel_Reserves();
            $hotel->id_hotel = $hotel_id_select;
            $hotel->category = $hotel_cat;
            $diff = $this->params['nights'];
            $days = $last_reserve['days'] - $diff;
            $nights = $last_reserve['nights'] - $diff;
            if ($nights == 0) {
                echo '<script>
                        alert("This redistribution cannot be done, there is no nights to charge in the new hotel");
                        $("#mascaraP").hide();
                        $("#dialog_message7").dialog("close");
                        $("#dialog_message6").dialog("close");
                      </script>';
                exit;
            }
            // buscamos el To para el traffic
            $hotel_a_donde_va = new Hoteles();
            $hotel_a_donde_va->id = $hotel_id_select;
            $hotel_a_donde_va = $hotel_a_donde_va->getOne();
            $to_traffic = $hotel_a_donde_va->nombre;

            // fin to traffic

            $hotel->days = $days;
            $hotel->id_tours = $tour->id;
            $hotel->nights = $nights;
            $hotel->creation_date = date("Y-m-d H:i");
            $hotel->starting_date = date("Y-m-d", strtotime($last_reserve['starting_date'] . ' + ' . ($diff) . ' days'));
            $hotel->ending_date = $last_reserve['ending_date'];
            $hotel->id_cliente = $tour->id_client;
            $hotel->type_client = $tour->type_client;
            $hotel->id_agencia = $tour->id_agency;
            $hotel->roooms = $select_rooms;
            $hotel->adult = $tour->adult;
            $hotel->child = $tour->child;
            $hotel->total_persons = $hotel->child + $hotel->adult;
            $hotel->room1_adult = (isset($adult1) ? $adult1 : 0);
            $hotel->room2_adult = (isset($adult2) ? $adult2 : 0);
            $hotel->room3_adult = (isset($adult3) ? $adult3 : 0);
            $hotel->room4_adult = (isset($adult4) ? $adult4 : 0);
            $hotel->room1_child = (isset($child1) ? $child1 : 0);
            $hotel->room2_child = (isset($child2) ? $child2 : 0);
            $hotel->room3_child = (isset($child3) ? $child3 : 0);
            $hotel->room4_child = (isset($child4) ? $child4 : 0);
            $hotel->type;
            $hotel->additional_night = 0;
            $hotel->free_night = $hotel_nochesfree;

            $nochesPagas = $nights - $hotel_nochesfree;
            if ($nochesPagas < 0) {
                echo '<script>
                        alert("The free nights exceed the number of nights");
                        $("#mascaraP").hide();
                        $("#dialog_message7").dialog("close");
                        $("#dialog_message6").dialog("close");
                      </script>';
                exit;
            }
            if ($nochesPagas == 0) {
                $hotel->nightprice = 0;
                $hotel->totalnights = 0;
                $hotel->breakfastprice = 0;
                $hotel->totalbreakfasts = 0;
            } else if ($nochesPagas > 0) {

                $costoHotel = $this->costoHotel($hotel->starting_date, $hotel->ending_date, $hotel_id_select, $hotel->room1_adult, $hotel->room2_adult, $hotel->room3_adult, $hotel->room4_adult, $hotel_nochesfree, $hotel_nochesfree_buffet, $type_rate);
                echo '<br/>';
                ////////////////////////////////////////////////////////////
                $hotel->nightprice = $costoHotel['total'] / ($nochesPagas);
                $hotel->totalnights = $costoHotel['total'];
                $hotel->buffet = $hotel_buffet;
                if ($hotel_buffet == 1) {
                    $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                    $hotel->totalbreakfasts = $costoHotel['priceBreakfast'];
                } else {
                    $hotel->breakfastprice = 0;
                    $hotel->totalbreakfasts = 0;
                }
            }
            $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
            if ($hotel->total_paid > 0) {
                Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");

                //cambiamos la fecha del hotel anterior a la ultima fecha que se cobrara de el y
                // se recalculara su valor.
                $last_hotel = new Hotel_Reserves();
                $last_hotel->id = $last_reserve['id'];
                $last_hotel = Doo::db()->getOne($last_hotel);

                // buscamos el from para el traffic
                $hotel_de_donde_viene = new Hoteles();
                $hotel_de_donde_viene->id = $last_hotel->id_hotel;
                $hotel_de_donde_viene = $hotel_de_donde_viene->getOne();
                $from_traffic = $hotel_de_donde_viene->nombre;


                //fin creacion de
                /* print_r($last_hotel); */
                $last_hotel->ending_date = date('Y-m-d', strtotime($hotel->starting_date));
                $last_hotel->days = $diff;
                $last_hotel->nights = $diff;


                $costoHotel = $this->costoHotel($last_hotel->starting_date, $last_hotel->ending_date, $last_hotel->id_hotel, $last_hotel->room1_adult, $last_hotel->room2_adult, $last_hotel->room3_adult, $last_hotel->room4_adult, $last_hotel->free_night, $last_hotel->free_night_buffet, $type_rate);

                $last_hotel->nightprice = $costoHotel['total'] / ($nochesPagas);
                $last_hotel->totalnights = $costoHotel['total'];
                if ($last_hotel->buffet == 1) {
                    $last_hotel->breakfastprice = $costoHotel['priceBreakfast'];
                    $last_hotel->totalbreakfasts = $costoHotel['priceBreakfast'];
                } else {
                    $hotel->breakfastprice = 0;
                    $hotel->totalbreakfasts = 0;
                }
                /* echo "---------------------------------------------------------"; */
                $last_hotel->total_paid = $last_hotel->totalnights + $last_hotel->totalbreakfasts;
                /* print_r($last_hotel); */
                Doo::db()->update($last_hotel);

                // si no hay traficos creados para el tour los creamos
                $taf = new TrafficController();
                $taf->generate_and_search_traffics($tour->id, 'MULTI');

                // Creamos el trafico para el hotel
                $traffic_hotel = new Traffic();
                $traffic_hotel->from = $from_traffic;
                $traffic_hotel->to = $to_traffic;
                $traffic_hotel->type_tour = 'MULTI';
                $traffic_hotel->id_tour = $tour->id;
                echo $traffic_hotel->id_tour;

                $traffic_hotel->date = $last_hotel->ending_date;
                $traffic_hotel->time_am = '15:00:00';
                $traffic_hotel->time_pm = '15:00:00';
                $traffic_hotel->id_cliente = $tour->id_client;
                $traffic_hotel->hotel_name = $to_traffic;
                $traffic_hotel->type_traffic = 'HOTEL RELOCATION';
                $traffic_hotel->insert();

                echo '<script>
                        alert("The redistribution have been successful!");
                        $("#mascaraP").hide();
                        $("#dialog_message7").dialog("close");
                        $("#dialog_message6").dialog("close");
                        $("#nhoteles").val(parseInt($("#nhoteles").val())+1);
                        reloadHoteles();

                      </script>';
                exit;
            } else {
                echo '<script>
                        alert("This hotel has no price configured for this dates");
                        $("#mascaraP").hide();
                        $("#dialog_message7").dialog("close");
                        $("#dialog_message6").dialog("close");
                     </script>';
            }
        }
    }

    public function add_hotels_nights() {
        $id = $this->params['id'];
        $diff = $this->params['diff'];
        $sql = "select * from hotel_reserves where id_tours = ? order by id DESC";
        $query = Doo::db()->query($sql, array($id));
        $rs = $query->fetchAll();
        $hres = $rs[0];
        Doo::loadModel('Hotel_Reserves');
        $new_hotel = new Hotel_Reserves();
        $new_hotel->id_tours = $id;
        $hotel = new Hotel_Reserves();
        $hotel->id = $hres['id'];
        $hotel = Doo::db()->getOne($hotel);
        list ($mes2, $dia2, $anyo2) = explode("-", $diff);
        $salida = $anyo2 . "-" . $mes2 . "-" . $dia2;
        $new_hotel->starting_date = $hotel->ending_date;
        $new_hotel->ending_date = $salida;
        $new_hotel->id_hotel = $hotel->id_hotel;
        $new_hotel->category = $hotel->category;
        //calculamos los dias
        $days = floor((strtotime($new_hotel->ending_date) - strtotime($new_hotel->starting_date) ) / (60 * 60 * 24));
        $new_hotel->days = $days;
        if ($days == 1) {
            $new_hotel->nights = 1;
        } else {
            $new_hotel->nights = $days - 1;
        }
        $new_hotel->creation_date = date('Y-m-d');
        $new_hotel->id_cliente = $hotel->id_cliente;
        $new_hotel->type_client = $hotel->type_client;
        $new_hotel->id_agencia = $hotel->id_agencia;
        $new_hotel->roooms = $hotel->roooms;
        $new_hotel->adult = $hotel->adult;
        $new_hotel->child = $hotel->child;
        $new_hotel->total_persons = $hotel->total_persons;
        $new_hotel->room1_adult = $hotel->room1_adult;
        $new_hotel->room2_adult = $hotel->room2_adult;
        $new_hotel->room3_adult = $hotel->room3_adult;
        $new_hotel->room4_adult = $hotel->room4_adult;
        $new_hotel->room1_child = $hotel->room1_child;
        $new_hotel->room2_child = $hotel->room2_child;
        $new_hotel->room3_child = $hotel->room3_child;
        $new_hotel->room4_child = $hotel->room4_child;
        $new_hotel->type = $hotel->type;
        $new_hotel->additional_night = 0;
        $new_hotel->free_night = 0;
        $new_hotel->free_night_buffet = 0;

        $costoHotel = $this->costoHotel($new_hotel->starting_date, $new_hotel->ending_date, $new_hotel->id_hotel, $new_hotel->room1_adult, $new_hotel->room2_adult, $new_hotel->room3_adult, $new_hotel->room4_adult, $new_hotel->free_night, $new_hotel->free_night_buffet, $new_hotel->type);

        $new_hotel->nightprice = $costoHotel['total'] / ($new_hotel->nights);
        $new_hotel->totalnights = $costoHotel['total'];
        $new_hotel->buffet = $hotel->buffet;
        if ($new_hotel->buffet == 1) {
            $new_hotel->breakfastprice = $costoHotel['priceBreakfast'];
            $new_hotel->totalbreakfasts = $costoHotel['priceBreakfast'];
        } else {
            $new_hotel->breakfastprice = 0;
            $new_hotel->totalbreakfasts = 0;
        }
        $new_hotel->total_paid = $new_hotel->totalnights + $new_hotel->totalbreakfasts;
        if ($new_hotel->total_paid > 0) {
            Doo::db()->insert($new_hotel) or die("Error Ingresando Datos de Hotel");
        }
        echo '<script>
                $("#nhoteles").val(parseInt($("#nhoteles").val())+1);
                reloadHoteles();
              </script>';
    }

    public function limpiar() {
        //unset($_SESSION['tours']['hoteles_n']);
    }

    public function reloadHotels() {

        $id = $this->params['id'];
        $tabla = "";
        $rs = Doo::db()->query('select * from hotel_reserves where id_tours = ?', array($id));
        $hoteles = $rs->fetchAll();
        $i = 0;
        foreach ($hoteles as $dato) {
            $query = Doo::db()->query('select * from hoteles where id = ? limit 1', array($dato['id_hotel']));
            $rs = $query->fetchAll();
            $hotel = $rs[0];


            $tipos = $this->tipoHabitacion($dato['room1_adult'], $dato['room2_adult'], $dato['room3_adult'], $dato['room4_adult']);
            $sgl = $tipos['sgl'];
            $dbl = $tipos['dbl'];
            $tpl = $tipos['tpl'];
            $qua = $tipos['qua'];
            if ($hotel['breakfast'] == 1) {
                $breakfastdato = "FREE BREAKFAST ";
            } else {
                $breakfastdato = "NOT BREAKFAST ";
            }
            if ($dato['buffet'] == 1) {
                $breakfastdato = "SUPER BREKFAST BUFFET";
            }


            $costohotel = $this->costoHotel($dato['starting_date'], $dato['ending_date'], $dato['id_hotel'], $dato['room1_adult'], $dato['room2_adult'], $dato['room3_adult'], $dato['room4_adult'], $dato['free_night'], $dato['free_night_buffet'], $dato['type']);

            $tabla .= '<tr class="row0">
                        <td>' . trim($hotel['nombre']) . '</th>
                        <td>' . $dato['total_persons'] . '</td>
                        <td>' . $dato['nights'] . '</td>
                        <td title=" $ ' . number_format($costohotel['sgl'], 2, '.', ',') . '">' . $sgl . '</td>
                        <td title=" $ ' . number_format($costohotel['dbl'], 2, '.', ',') . '">' . $dbl . '</td>
                        <td title=" $ ' . number_format($costohotel['tpl'], 2, '.', ',') . '">' . $tpl . '</td>
                        <td title=" $ ' . number_format($costohotel['qua'], 2, '.', ',') . '">' . $qua . '</td>
                        <td id="breakfastdato" title="$ ' . $dato['totalbreakfasts'] . '">' . $breakfastdato . '</td>
							   </tr>
							   <input type="hidden" name="hotel_id_select_' . $i . '" id="hotel_id_select_' . $i . '" value="' . $dato['id_hotel'] . '">
							   <input type="hidden" name="hotel_breakfast_' . $i . '" id="hotel_breakfast_' . $i . '" value="' . $dato['totalbreakfasts'] . '">
							   <input type="hidden" name="hotel_buffet_' . $i . '" id="hotel_buffet_' . $i . '" value="1">
							   <input type="hidden" name="hotel_nochesfree_' . $i . '" id="hotel_nochesfree_' . $i . '" min="0" value="' . $dato['nochesfree'] . '">
							   <input type="hidden" name="hotel_nochesfree_buffet_' . $i . '" id="hotel_nochesfree_buffet_' . $i . '" value="' . $frday . '">
							   <input type="hidden" name="hotel_resort_' . $i . '" id="hotel_resort_' . $i . '" value="">
							   <input type="hidden" name="hotel_category_' . $i . '" id="hotel_category_' . $i . '" value="' . $hotel['categoria'] . '">
							   <input type="hidden" name="hotel_subtotal_' . $i . '" id="hotel_subtotal_' . $i . '" value="' . $dato['totalnights'] . '">
							   ';
            $i += 1;
        }
        echo $tabla;
    }

    public function costoHotel($fechaSalida, $fechaRetorno, $hotel, $room1, $room2, $room3, $room4, $nochesfree, $free_night_buffet, $type_rate, $noches_escogidas = 0) {

        $idpromo = $this->params["rates"];
        //$idpromo = 141;
        ////////////////////////////////////////////////Actualizacion
        $id_agency1 = $this->params["id_agency"];
        //$id_tour = $dat->id_tour;

        $frday = $this->params["frday"];

        Doo::loadModel("Agency");
        $dat = new Agency();
        $dat->id = $id_agency1;
        $dat = Doo::db()->find($dat, array('limit' => 1));
        $type_rate = $dat->type_rate;


        if ($idpromo == 0) {
            $id_tour = $dat->id_tour;
        } else {
            $id_tour = $idpromo;
        }

        if ($type_rate == 0) {


            $id_tour;
        }
        if ($type_rate == 1) {

            $id_tour;
        }

        
        
        $sql = 'SELECT t1.id,t1.breakfast,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.sgl2,t3.dbl2,t3.tpl2,t3.qua2,t3.sgl3, t3.dbl3, t3.tpl3, t3.qua3, t3.sgl4, t3.dbl4, t3.tpl4, t3.qua4, t3.sgl5, t3.dbl5, t3.tpl5, t3.qua5, t3.sgl6, t3.dbl6, t3.tpl6, t3.qua6, t3.sgl7, t3.dbl7, t3.tpl7, t3.qua7, t3.sgl8, t3.dbl8, t3.tpl8, t3.qua8, t3.sglm,t3.dblm,t3.tplm,t3.quam,t3.sglm2,t3.dblm2,t3.tplm2,t3.quam2,t3.sglm3, t3.dblm3, t3.tplm3, t3.quam3, t3.sglm4, t3.dblm4, t3.tplm4, t3.quam4, t3.sglm5, t3.dblm5, t3.tplm5, t3.quam5, t3.sglm6, t3.dblm6, t3.tplm6, t3.quam6, t3.sglm7, t3.dblm7, t3.tplm7, t3.quam7, t3.sglm8, t3.dblm8, t3.tplm8, t3.quam8, t3.chv21, t3.chm21, t3.chv32, t3.chm32, t3.chv43, t3.chm43, t3.chv54, t3.chm54, t3.chv65, t3.chm65, t3.chv76, t3.chm76, t3.chv87, t3.chm87, t3.chv98, t3.chm98,t3.netax,t3.comtax,t3.costax,t3.id_ratesvalid,t3.breackfast,t3.fdv_adult21,t3.fdv_child21,t3.fdm_adult21,t3.fdm_child21,t3.fdv_adult32,t3.fdv_child32,t3.fdm_adult32,t3.fdm_child32,t3.fdv_adult43,t3.fdv_child43,t3.fdm_adult43,t3.fdm_child43,t3.fdv_adult54,t3.fdv_child54,t3.fdm_adult54,t3.fdm_child54,t3.fdv_adult65,t3.fdv_child65,t3.fdm_adult65,t3.fdm_child65,t3.fdv_adult76,t3.fdv_child76,t3.fdm_adult76,t3.fdm_child76,t3.fdv_adult87,t3.fdv_child87,t3.fdm_adult87,t3.fdm_child87,t3.fdv_adult98,t3.fdv_child98,t3.fdm_adult98,t3.fdm_child98,t1.categoria
       
						FROM hoteles t1	
							LEFT JOIN comifijas t3 ON (
											t1.id = t3.id_hotel                                                                                       
											AND t3.fecha_ini <= ? 
											AND t3.fecha_fin  >= ?
											)
						WHERE t3.id_hotel  = ' . $hotel . ' AND t3.id_ratesvalid = ' . $id_tour . ' ';



        $fecha = new DateTime();
        $fecha_fin = new DateTime();
        $fecha->setTimestamp(strtotime($fechaSalida));
        $fecha_fin->setTimestamp(strtotime($fechaRetorno));


        $fecha2 = new DateTime();
        $fecha2->setTimestamp(strtotime($fechaSalida));
        //echo $fechaSalida;

        $fecha3 = new DateTime();
        $fecha3->setTimestamp(strtotime($fechaSalida));

        $fecha4 = new DateTime();
        $fecha4->setTimestamp(strtotime($fechaSalida));
        
        
        //Consulta para obtener los cargos por noche  de hoteles value y moderate PRIMER RANGO
        
        $sql6 = "SELECT schv, schm FROM ratesvalid WHERE id ='$id_tour' AND fecha_schv <= '$fechaSalida' AND fecha_schm >= '$fechaSalida'";                  

        $rs6 = Doo::db()->query($sql6);
        $cargospn = $rs6->fetchAll();
        //cargos por noche
        foreach ($cargospn as $clave5 => $key5) {
            
        }
        //cargo por noche para Hotel Value
        $cpnv = $key5['schv'];
        
        //cargo por noche para Hotel Moderate        
        $cpnm = $key5['schm'];
        
        if($cpnv == ""){
            
            //cargo por noche para Hotel Value
            $cpnv = "0.00";
            //print($cpnv);
            
        }else{    
            
            //cargo por noche para Hotel Value        
            $cpnv = $key5['schv'];
            //print($cpnv);
            
        }
        
        //echo " --- ";
         
        if($cpnm == ""){
            
            //cargo por noche para Hotel Moderate   
            $cpnm = "0.00";
            //print($cpnm);
            
        }else{     
            
            //cargo por noche para Hotel Moderate        
            $cpnm = $key5['schm'];
            //print($cpnm);
            
        }
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        //Consulta para obtener los cargos por noche  de hoteles value y moderate SEGUNDO RANGO
        
        $sql7 = "SELECT schv2, schm2 FROM ratesvalid WHERE id ='$id_tour' AND fecha_schv2 <= '$fechaSalida' AND fecha_schm2 >= '$fechaSalida'";                  

        $rs7 = Doo::db()->query($sql7);
        $cargospn2 = $rs7->fetchAll();
        //cargos por noche
        foreach ($cargospn2 as $clave7 => $key7) {
            
        }
        //cargo por noche para Hotel Value
        $cpnv2 = $key7['schv2'];
        
        //cargo por noche para Hotel Moderate        
        $cpnm2 = $key7['schm2'];
        
        if($cpnv2 == ""){
            
            //cargo por noche para Hotel Value
            $cpnv2 = "0.00";
            //print($cpnv);
            
        }else{    
            
            //cargo por noche para Hotel Value        
            $cpnv2 = $key7['schv2'];
            //print($cpnv);
            
        }
        
        //echo " --- ";
         
        if($cpnm2 == ""){
            
            //cargo por noche para Hotel Moderate   
            $cpnm2 = "0.00";
            //print($cpnm);
            
        }else{     
            
            //cargo por noche para Hotel Moderate        
            $cpnm2 = $key7['schm2'];
            //print($cpnm);
            
        }
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        //Consulta para obtener los cargos por noche  de hoteles value y moderate TERCER RANGO
        
        $sql8 = "SELECT schv3, schm3 FROM ratesvalid WHERE id ='$id_tour' AND fecha_schv3 <= '$fechaSalida' AND fecha_schm3 >= '$fechaSalida'";                  

        $rs8 = Doo::db()->query($sql8);
        $cargospn3 = $rs8->fetchAll();
        //cargos por noche
        foreach ($cargospn3 as $clave8 => $key8) {
            
        }
        //cargo por noche para Hotel Value
        $cpnv3 = $key8['schv3'];
        
        //cargo por noche para Hotel Moderate        
        $cpnm3 = $key8['schm3'];
        
        if($cpnv3 == ""){
            
            //cargo por noche para Hotel Value
            $cpnv3 = "0.00";
            //print($cpnv);
            
        }else{    
            
            //cargo por noche para Hotel Value        
            $cpnv3 = $key8['schv3'];
            //print($cpnv);
            
        }
        
        //echo " --- ";
         
        if($cpnm3 == ""){
            
            //cargo por noche para Hotel Moderate   
            $cpnm3 = "0.00";
            //print($cpnm);
            
        }else{     
            
            //cargo por noche para Hotel Moderate        
            $cpnm3 = $key8['schm3'];
            //print($cpnm);
            
        }
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        //Consulta para obtener los cargos por noche  de hoteles value y moderate CUARTO RANGO
        
        $sql9 = "SELECT schv4, schm4 FROM ratesvalid WHERE id ='$id_tour' AND fecha_schv4 <= '$fechaSalida' AND fecha_schm4 >= '$fechaSalida'";                  

        $rs9 = Doo::db()->query($sql9);
        $cargospn4 = $rs9->fetchAll();
        //cargos por noche
        foreach ($cargospn4 as $clave9 => $key9) {
            
        }
        //cargo por noche para Hotel Value
        $cpnv4 = $key9['schv4'];
        
        //cargo por noche para Hotel Moderate        
        $cpnm4 = $key9['schm4'];
        
        if($cpnv4 == ""){
            
            //cargo por noche para Hotel Value
            $cpnv4 = "0.00";
            //print($cpnv);
            
        }else{    
            
            //cargo por noche para Hotel Value        
            $cpnv4 = $key9['schv4'];
            //print($cpnv);
            
        }
        
        //echo " --- ";
         
        if($cpnm4 == ""){
            
            //cargo por noche para Hotel Moderate   
            $cpnm4 = "0.00";
            //print($cpnm);
            
        }else{     
            
            //cargo por noche para Hotel Moderate        
            $cpnm4 = $key9['schm4'];
            //print($cpnm);
            
        }
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       

        $priceRoom1 = $priceRoom2 = $priceRoom3 = $priceRoom4 = $priceBreakfast = 0;
        //print_r($room1.' '.$room2.' '.$room3.' '.$room4);
        $totaladult = $room1 + $room2 + $room3 + $room4;
        //echo $totaladult;

        $room1_c = $this->params["room1_c"];
        //echo $room1_c;
        $room2_c = $this->params["room2_c"];
//        echo $room2_c;
        $room3_c = $this->params["room3_c"];
//        echo $room3_c;
        $room4_c = $this->params["room4_c"];
//        echo $room4_c;

        $totalpeques = $room1_c + $room2_c + $room3_c + $room4_c;
        //echo $totalpeques;
        $totalpersonas = $totaladult + $totalpeques;
        
        

        $numNoches = $this->numDiasNochesFechaok($fechaSalida, $fechaRetorno);
        //echo $numNoches;
        //echo $numNoches['noches'];

        if ($numNoches['noches'] == $nochesfree) {
            while ($fecha->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {
                $fec = $fecha->getTimestamp();
                $rs = Doo::db()->query($sql, array($fec, $fec));
                $costohotel = $rs->fetch();


                //Desayunos
                if ($costohotel ['breakfast'] == 0 || $costohotel ['categoria'] > 2) {
                    $priceBreakfast += ($costohotel ['breackfast'] * $totaladult);
                } else {
                    $priceBreakfast += 0;
                }
                if ($free_night_buffet == 0) {
                    $totalBreakfast = $priceBreakfast;
                } else {
                    $totalBreakfast = 0;
                }
                date_add($fecha, date_interval_create_from_date_string('1 days'));
            }
        } else {
            //restamos noches gratis
            date_add($fecha_fin, date_interval_create_from_date_string((-1 * $nochesfree) . ' days'));
            
        

            //Costo habitacion 1
            if (isset($room1) && $room1 > 0) {
                $contador = 0;
                while ($fecha->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {
                    if ($noches_escogidas != 0) {
                        if ($noches_escogidas == $contador) {
                            break;
                        }
                    }
                    //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                    /////captura de tarifas relacionadas con las noches escogidas/////////////////////////////////////////////////////////////////
                    //echo $noches_escogidas;

                    $fec = $fecha->getTimestamp();


                    // echo $fec;

                    $sql = 'SELECT t1.id,t1.breakfast,t1.resoftfe,t1.nombre,t3.id as comifi,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.sgl2,t3.dbl2,t3.tpl2,t3.qua2, t3.sgl3, t3.dbl3, t3.tpl3, t3.qua3, t3.sgl4, t3.dbl4, t3.tpl4, t3.qua4, t3.sgl5, t3.dbl5, t3.tpl5, t3.qua5, t3.sgl6, t3.dbl6, t3.tpl6, t3.qua6, t3.sgl7, t3.dbl7, t3.tpl7, t3.qua7, t3.sgl8, t3.dbl8, t3.tpl8, t3.qua8, t3.sglm,t3.dblm,t3.tplm,t3.quam,t3.sglm2,t3.dblm2,t3.tplm2,t3.quam2,t3.sglm3, t3.dblm3, t3.tplm3, t3.quam3, t3.sglm4, t3.dblm4, t3.tplm4, t3.quam4, t3.sglm5, t3.dblm5, t3.tplm5, t3.quam5, t3.sglm6, t3.dblm6, t3.tplm6, t3.quam6, t3.sglm7, t3.dblm7, t3.tplm7, t3.quam7, t3.sglm8, t3.dblm8, t3.tplm8, t3.quam8, t3.chv21, t3.chm21, t3.chv32, t3.chm32, t3.chv43, t3.chm43, t3.chv54, t3.chm54, t3.chv65, t3.chm65, t3.chv76, t3.chm76, t3.chv87, t3.chm87, t3.chv98, t3.chm98, t3.netax,t3.comtax,t3.costax,t3.id_ratesvalid,t3.breackfast,t3.fdv_adult21,t3.fdv_child21,t3.fdm_adult21,t3.fdm_child21,t3.fdv_adult32,t3.fdv_child32,t3.fdm_adult32,t3.fdm_child32,t3.fdv_adult43,t3.fdv_child43,t3.fdm_adult43,t3.fdm_child43,t3.fdv_adult54,t3.fdv_child54,t3.fdm_adult54,t3.fdm_child54,t3.fdv_adult65,t3.fdv_child65,t3.fdm_adult65,t3.fdm_child65,t3.fdv_adult76,t3.fdv_child76,t3.fdm_adult76,t3.fdm_child76,t3.fdv_adult87,t3.fdv_child87,t3.fdm_adult87,t3.fdm_child87,t3.fdv_adult98,t3.fdv_child98,t3.fdm_adult98,t3.fdm_child98,t1.categoria
                    
						FROM hoteles t1	
							LEFT JOIN comifijas t3 ON (
											t1.id = t3.id_hotel 											
											AND t3.fecha_ini <= ' . $fec . ' 
											AND t3.fecha_fin  >= ' . $fec . '
											)
						WHERE t3.id_hotel  = ' . $hotel . ' AND t3.id_ratesvalid = ' . $id_tour . '';

                    $rs = Doo::db()->query($sql);
                    $costohotel = $rs->fetch();
//                    print_r($type_rate);
//                    print_r(Doo::db()->showSQL());
                    if (empty($costohotel)) {
                        echo ' <script>/*$("input[type=\'checkbox\'").attr("checked",false).change();*/
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                        exit;
                    }

                    //$neto = $costohotel['netax'];
                    //$commisionable = $costohotel['comtax'];
                    //$special= $costohotel['costax'];
                    //$idrv = $costohotel['id_ratesvalid'];
                    //DESAYUNOS DE HOTEL
                    $desayuno = $costohotel['breackfast'];
                    //echo $desayuno;
                    $costo_desayuno = $totalpersonas * $desayuno;
                    //echo $costo_desayuno;
                    //echo $idrv;
                    // GLOBAL $idrv;
                    // GLOBAL $desayuno;

                    $categor = $costohotel['categoria'];
//                    $numero_noches = $numNoches['noches'];

//                    if ($categor == "2"){
//
//                        //cargo para hoteles con categoria Value
//                        $cargo_por_noche = $cpnv;
//                        $cargo_total = ($numero_noches)*($cpnv);
//                        //echo "Cargo por Noche Categoria Value: ".$cargo_por_noche;
//                        //echo "Cargo Total:  ".$cargo_total;
//
//                    }else if ($categor == "3"){
//
//                        //cargo para hoteles con categoria Moderate
//                        $cargo_por_noche = $cpnm;
//                        $cargo_total = ($numero_noches)*($cpnm);
//                        //echo "Cargo por Noche Categoria Moderate: ".$cargo_por_noche;
//                        //echo "Cargo Total:  ".$cargo_total;                    
//
//                    }

                    GLOBAL $chv21;
                    GLOBAL $chm21;

                    GLOBAL $chv32;
                    GLOBAL $chm32;

                    GLOBAL $chv43;
                    GLOBAL $chm43;

                    GLOBAL $chv54;
                    GLOBAL $chm54;

                    GLOBAL $chv65;
                    GLOBAL $chm65;

                    GLOBAL $chv76;
                    GLOBAL $chm76;

                    GLOBAL $chv87;
                    GLOBAL $chm87;

                    GLOBAL $chv98;
                    GLOBAL $chm98;

                    GLOBAL $fdv_adult21;
                    GLOBAL $fdv_child21;
                    GLOBAL $fdv_adult32;
                    GLOBAL $fdv_child32;
                    GLOBAL $fdv_adult43;
                    GLOBAL $fdv_child43;
                    GLOBAL $fdv_adult54;
                    GLOBAL $fdv_child54;
                    GLOBAL $fdv_adult65;
                    GLOBAL $fdv_child65;
                    GLOBAL $fdv_adult76;
                    GLOBAL $fdv_child76;
                    GLOBAL $fdv_adult87;
                    GLOBAL $fdv_child87;
                    GLOBAL $fdv_adult98;
                    GLOBAL $fdv_child98;

                    GLOBAL $fdm_adult21;
                    GLOBAL $fdm_child21;
                    GLOBAL $fdm_adult32;
                    GLOBAL $fdm_child32;
                    GLOBAL $fdm_adult43;
                    GLOBAL $fdm_child43;
                    GLOBAL $fdm_adult54;
                    GLOBAL $fdm_child54;
                    GLOBAL $fdm_adult65;
                    GLOBAL $fdm_child65;
                    GLOBAL $fdm_adult76;
                    GLOBAL $fdm_child76;
                    GLOBAL $fdm_adult87;
                    GLOBAL $fdm_child87;
                    GLOBAL $fdm_adult98;
                    GLOBAL $fdm_child98;



                    $chv21 = $costohotel['chv21'];
                    $chm21 = $costohotel['chm21'];

                    $chv32 = $costohotel['chv32'];
                    $chm32 = $costohotel['chm32'];

                    $chv43 = $costohotel['chv43'];
                    $chm43 = $costohotel['chm43'];

                    $chv54 = $costohotel['chv54'];
                    $chm54 = $costohotel['chm54'];

                    $chv65 = $costohotel['chv65'];
                    $chm65 = $costohotel['chm65'];

                    $chv76 = $costohotel['chv76'];
                    $chm76 = $costohotel['chm76'];

                    $chv87 = $costohotel['chv87'];
                    $chm87 = $costohotel['chm87'];

                    $chv98 = $costohotel['chv98'];
                    $chm98 = $costohotel['chm98'];

                    $fdv_adult21 = $costohotel['fdv_adult21'];
                    $fdv_child21 = $costohotel['fdv_child21'];
                    $fdm_adult21 = $costohotel['fdm_adult21'];
                    $fdm_child21 = $costohotel['fdm_child21'];

                    $fdv_adult32 = $costohotel['fdv_adult32'];
                    $fdv_child32 = $costohotel['fdv_child32'];
                    $fdm_adult32 = $costohotel['fdm_adult32'];
                    $fdm_child32 = $costohotel['fdm_child32'];

                    $fdv_adult43 = $costohotel['fdv_adult43'];
                    $fdv_child43 = $costohotel['fdv_child43'];
                    $fdm_adult43 = $costohotel['fdm_adult43'];
                    $fdm_child43 = $costohotel['fdm_child43'];

                    $fdv_adult54 = $costohotel['fdv_adult54'];
                    $fdv_child54 = $costohotel['fdv_child54'];
                    $fdm_adult54 = $costohotel['fdm_adult54'];
                    $fdm_child54 = $costohotel['fdm_child54'];

                    $fdv_adult65 = $costohotel['fdv_adult65'];
                    $fdv_child65 = $costohotel['fdv_child65'];
                    $fdm_adult65 = $costohotel['fdm_adult65'];
                    $fdm_child65 = $costohotel['fdm_child65'];

                    $fdv_adult76 = $costohotel['fdv_adult76'];
                    $fdv_child76 = $costohotel['fdv_child76'];
                    $fdm_adult76 = $costohotel['fdm_adult76'];
                    $fdm_child76 = $costohotel['fdm_child76'];

                    $fdv_adult87 = $costohotel['fdv_adult87'];
                    $fdv_child87 = $costohotel['fdv_child87'];
                    $fdm_adult87 = $costohotel['fdm_adult87'];
                    $fdm_child87 = $costohotel['fdm_child87'];

                    $fdv_adult98 = $costohotel['fdv_adult98'];
                    $fdv_child98 = $costohotel['fdv_child98'];
                    $fdm_adult98 = $costohotel['fdm_adult98'];
                    $fdm_child98 = $costohotel['fdm_child98'];




                    //TOUR 21 VALUE


                    if ($numNoches['noches'] == 1 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];
                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);
                        
                        if ($room1 == 1) {
                            $priceRoom1 += $costohotel ['sgl'] + ($chv21 * $room1_c) + ($fdv_adult21 * $room1 * $frday) + ($fdv_child21 * $room1_c * $frday) + ($cargo_total) + ($cargo_total2) + ($cargo_total3) + ($cargo_total4);
                            //echo $priceRoom1;
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += $costohotel ['dbl'] + (($chv21 * $room1_c) / 2) + (($fdv_adult21 * $room1 * $frday) / 2) + (($fdv_child21 * $room1_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += $costohotel ['tpl'] + (($chv21 * $room1_c) / 3) + (($fdv_adult21 * $room1 * $frday) / 3) + (($fdv_child21 * $room1_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += $costohotel ['qua'] + (($chv21 * $room1_c) / 4) + (($fdv_adult21 * $room1 * $frday) / 4) + (($fdv_child21 * $room1_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                        }
                    }

                    //TOUR 21 MODERATE       


                    if ($numNoches['noches'] == 1 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);
                        
                        
                        if ($room1 == 1) {
                            $priceRoom1 += $costohotel ['sglm'] + ($chm21 * $room1_c) + ($fdm_adult21 * $room1 * $frday) + ($fdm_child21 * $room1_c * $frday) + ($cargo_total) + ($cargo_total2) + ($cargo_total3) + ($cargo_total4);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += $costohotel ['dblm'] + (($chm21 * $room1_c) / 2) + (($fdm_adult21 * $room1 * $frday) / 2) + (($fdm_child21 * $room1_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += $costohotel ['tplm'] + (($chm21 * $room1_c) / 3) + (($fdm_adult21 * $room1 * $frday) / 3) + (($fdm_child21 * $room1_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += $costohotel ['quam'] + (($chm21 * $room1_c) / 4) + (($fdm_adult21 * $room1 * $frday) / 4) + (($fdm_child21 * $room1_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                        }
                    }

                    //TOUR 32 VALUE



                    if ($numNoches['noches'] == 2 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);

                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl2'] / 2) + (($chv32 * $room1_c) / 2) + (($fdv_adult32 * $room1 * $frday) / 2) + (($fdv_child32 * $room1_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl2'] / 2) + (($chv32 * $room1_c) / 4) + (($fdv_adult32 * $room1 * $frday) / 4) + (($fdv_child32 * $room1_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl2'] / 2) + (($chv32 * $room1_c) / 6) + (($fdv_adult32 * $room1 * $frday) / 6) + (($fdv_child32 * $room1_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua2'] / 2) + (($chv32 * $room1_c) / 8) + (($fdv_adult32 * $room1 * $frday) / 8) + (($fdv_child32 * $room1_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                        }
                    }

                    //TOUR 32 MODERATE


                    if ($numNoches['noches'] == 2 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm2'] / 2) + (($chm32 * $room1_c) / 2) + (($fdm_adult32 * $room1 * $frday) / 2) + (($fdm_child32 * $room1_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm2'] / 2) + (($chm32 * $room1_c) / 4) + (($fdm_adult32 * $room1 * $frday) / 4) + (($fdm_child32 * $room1_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm2'] / 2) + (($chm32 * $room1_c) / 6) + (($fdm_adult32 * $room1 * $frday) / 6) + (($fdm_child32 * $room1_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam2'] / 2) + (($chm32 * $room1_c) / 8) + (($fdm_adult32 * $room1 * $frday) / 8) + (($fdm_child32 * $room1_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                        }
                    }

                    //TOUR 43 VALUE

                    
                    if ($numNoches['noches'] == 3 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);
                       

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl3'] / 3) + (($chv43 * $room1_c) / 3) + (($fdv_adult43 * $room1 * $frday) / 3) + (($fdv_child43 * $room1_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl3'] / 3) + (($chv43 * $room1_c) / 6) + (($fdv_adult43 * $room1 * $frday) / 6) + (($fdv_child43 * $room1_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl3'] / 3) + (($chv43 * $room1_c) / 9) + (($fdv_adult43 * $room1 * $frday) / 9) + (($fdv_child43 * $room1_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua3'] / 3) + (($chv43 * $room1_c) / 12) + (($fdv_adult43 * $room1 * $frday) / 12) + (($fdv_child43 * $room1_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                        }
                    }
                    //TOUR 43 MODERATE

                    
                    
                    if ($numNoches['noches'] == 3 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm3'] / 3) + (($chm43 * $room1_c) / 3) + (($fdm_adult43 * $room1 * $frday) / 3) + (($fdm_child43 * $room1_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm3'] / 3) + (($chm43 * $room1_c) / 6) + (($fdm_adult43 * $room1 * $frday) / 6) + (($fdm_child43 * $room1_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm3'] / 3) + (($chm43 * $room1_c) / 9) + (($fdm_adult43 * $room1 * $frday) / 9) + (($fdm_child43 * $room1_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam3'] / 3) + (($chm43 * $room1_c) / 12) + (($fdm_adult43 * $room1 * $frday) / 12) + (($fdm_child43 * $room1_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                        }
                    }

                    //TOUR 54 VALUE 


                    if ($numNoches['noches'] == 4 && $categor == 2 && $room1 > 0) {
                        
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl4'] / 4) + (($chv54 * $room1_c) / 4) + (($fdv_adult54 * $room1 * $frday) / 4) + (($fdv_child54 * $room1_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl4'] / 4) + (($chv54 * $room1_c) / 8) + (($fdv_adult54 * $room1 * $frday) / 8) + (($fdv_child54 * $room1_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl4'] / 4) + (($chv54 * $room1_c) / 12) + (($fdv_adult54 * $room1 * $frday) / 12) + (($fdv_child54 * $room1_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua4'] / 4) + (($chv54 * $room1_c) / 16) + (($fdv_adult54 * $room1 * $frday) / 16) + (($fdv_child54 * $room1_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                        }
                    }
                    //TOUR 54 MODERATE




                    if ($numNoches['noches'] == 4 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm4'] / 4) + (($chm54 * $room1_c) / 4) + (($fdm_adult54 * $room1 * $frday) / 4) + (($fdm_child54 * $room1_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm4'] / 4) + (($chm54 * $room1_c) / 8) + (($fdm_adult54 * $room1 * $frday) / 8) + (($fdm_child54 * $room1_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm4'] / 4) + (($chm54 * $room1_c) / 12) + (($fdm_adult54 * $room1 * $frday) / 12) + (($fdm_child54 * $room1_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam4'] / 4) + (($chm54 * $room1_c) / 16) + (($fdm_adult54 * $room1 * $frday) / 16) + (($fdm_child54 * $room1_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                        }
                    }
                    //TOUR 65 VALUE



                    if ($numNoches['noches'] == 5 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl5'] / 5) + (($chv65 * $room1_c) / 5) + (($fdv_adult65 * $room1 * $frday) / 5) + (($fdv_child65 * $room1_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl5'] / 5) + (($chv65 * $room1_c) / 10) + (($fdv_adult65 * $room1 * $frday) / 10) + (($fdv_child65 * $room1_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl5'] / 5) + (($chv65 * $room1_c) / 15) + (($fdv_adult65 * $room1 * $frday) / 15) + (($fdv_child65 * $room1_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua5'] / 5) + (($chv65 * $room1_c) / 20) + (($fdv_adult65 * $room1 * $frday) / 20) + (($fdv_child65 * $room1_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                        }
                    }

                    //TOUR 65 MODERATE



                    if ($numNoches['noches'] == 5 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm5']) / 5 + (($chm65 * $room1_c) / 5) + (($fdm_adult65 * $room1 * $frday) / 5) + (($fdm_child65 * $room1_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm5']) / 5 + (($chm65 * $room1_c) / 10) + (($fdm_adult65 * $room1 * $frday) / 10) + (($fdm_child65 * $room1_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10)  + (($cargo_total3)/10) + (($cargo_total4)/10);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm5']) / 5 + (($chm65 * $room1_c) / 15) + (($fdm_adult65 * $room1 * $frday) / 15) + (($fdm_child65 * $room1_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15)  + (($cargo_total3)/15) + (($cargo_total4)/15);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam5']) / 5 + (($chm65 * $room1_c) / 20) + (($fdm_adult65 * $room1 * $frday) / 20) + (($fdm_child65 * $room1_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20)  + (($cargo_total3)/20) + (($cargo_total4)/20);
                        }
                    }

                    //TOUR 76 VALUE



                    if ($numNoches['noches'] == 6 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl6']) / 6 + (($chv76 * $room1_c) / 6) + (($fdv_adult76 * $room1 * $frday) / 6) + (($fdv_child76 * $room1_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl6']) / 6 + (($chv76 * $room1_c) / 12) + (($fdv_adult76 * $room1 * $frday) / 12) + (($fdv_child76 * $room1_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl6']) / 6 + (($chv76 * $room1_c) / 18) + (($fdv_adult76 * $room1 * $frday) / 18) + (($fdv_child76 * $room1_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua6']) / 6 + (($chv76 * $room1_c) / 24) + (($fdv_adult76 * $room1 * $frday) / 24) + (($fdv_child76 * $room1_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                        }
                    }

                    //TOUR 76 MODERATE 




                    if ($numNoches['noches'] == 6 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm6']) / 6 + (($chm76 * $room1_c) / 6) + (($fdm_adult76 * $room1 * $frday) / 6) + (($fdm_child76 * $room1_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm6']) / 6 + (($chm76 * $room1_c) / 12) + (($fdm_adult76 * $room1 * $frday) / 12) + (($fdm_child76 * $room1_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm6']) / 6 + (($chm76 * $room1_c) / 18) + (($fdm_adult76 * $room1 * $frday) / 18) + (($fdm_child76 * $room1_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam6']) / 6 + (($chm76 * $room1_c) / 24) + (($fdm_adult76 * $room1 * $frday) / 24) + (($fdm_child76 * $room1_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                        }
                    }
                    //************************************************************************************************************************************         
                    //TOUR 87 VALUE



                    if ($numNoches['noches'] == 7 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl7']) / 7 + (($chv87 * $room1_c) / 7) + (($fdv_adult87 * $room1 * $frday) / 7) + (($fdv_child87 * $room1_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl7']) / 7 + (($chv87 * $room1_c) / 14) + (($fdv_adult87 * $room1 * $frday) / 14) + (($fdv_child87 * $room1_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl7']) / 7 + (($chv87 * $room1_c) / 21) + (($fdv_adult87 * $room1 * $frday) / 21) + (($fdv_child87 * $room1_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua7']) / 7 + (($chv87 * $room1_c) / 28) + (($fdv_adult87 * $room1 * $frday) / 28) + (($fdv_child87 * $room1_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                        }
                    }

                    //TOUR 87 MODERATE


                    if ($numNoches['noches'] == 7 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm7']) / 7 + (($chm87 * $room1_c) / 7) + (($fdm_adult87 * $room1 * $frday) / 7) + (($fdm_child87 * $room1_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm7']) / 7 + (($chm87 * $room1_c) / 14) + (($fdm_adult87 * $room1 * $frday) / 14) + (($fdm_child87 * $room1_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm7']) / 7 + (($chm87 * $room1_c) / 21) + (($fdm_adult87 * $room1 * $frday) / 21) + (($fdm_child87 * $room1_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam7']) / 7 + (($chm87 * $room1_c) / 28) + (($fdm_adult87 * $room1 * $frday) / 28) + (($fdm_child87 * $room1_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                        }
                    }

                    //TOUR 98 VALUE



                    if ($numNoches['noches'] == 8 && $categor == 2 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];                        
                        $cargo_total = ($numero_noches)*($cpnv);
                        $cargo_total2 = ($numero_noches)*($cpnv2);
                        $cargo_total3 = ($numero_noches)*($cpnv3);
                        $cargo_total4 = ($numero_noches)*($cpnv4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sgl8']) / 8 + (($chv98 * $room1_c) / 8) + (($fdv_adult98 * $room1 * $frday) / 8) + (($fdv_child98 * $room1_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dbl8']) / 8 + (($chv98 * $room1_c) / 16) + (($fdv_adult98 * $room1 * $frday) / 16) + (($fdv_child98 * $room1_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tpl8']) / 8 + (($chv98 * $room1_c) / 24) + (($fdv_adult98 * $room1 * $frday) / 24) + (($fdv_child98 * $room1_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['qua8']) / 8 + (($chv98 * $room1_c) / 32) + (($fdv_adult98 * $room1 * $frday) / 32) + (($fdv_child98 * $room1_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                        }
                    }

                    //TOUR 98 MODERATE


                    if ($numNoches['noches'] == 8 && $categor == 3 && $room1 > 0) {
                        
                        $numero_noches = $numNoches['noches'];
                        $cargo_total = ($numero_noches)*($cpnm);
                        $cargo_total2 = ($numero_noches)*($cpnm2);
                        $cargo_total3 = ($numero_noches)*($cpnm3);
                        $cargo_total4 = ($numero_noches)*($cpnm4);
                        

                        if ($room1 == 1) {
                            $priceRoom1 += ($costohotel ['sglm8']) / 8 + (($chm98 * $room1_c) / 8) + (($fdm_adult98 * $room1 * $frday) / 8) + (($fdm_child98 * $room1_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                        }
                        if ($room1 == 2) {
                            $priceRoom1 += ($costohotel ['dblm8']) / 8 + (($chm98 * $room1_c) / 16) + (($fdm_adult98 * $room1 * $frday) / 16) + (($fdm_child98 * $room1_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                        }
                        if ($room1 == 3) {
                            $priceRoom1 += ($costohotel ['tplm8']) / 8 + (($chm98 * $room1_c) / 24) + (($fdm_adult98 * $room1 * $frday) / 24) + (($fdm_child98 * $room1_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                        }
                        if ($room1 == 4) {
                            $priceRoom1 += ($costohotel ['quam8']) / 8 + (($chm98 * $room1_c) / 32) + (($fdm_adult98 * $room1 * $frday) / 32) + (($fdm_child98 * $room1_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                        }
                    }

                    date_add($fecha, date_interval_create_from_date_string('1 days'));
                    $contador++;
//                    print_r(Doo::db()->showSQL());
                }
//                exit;
                //$priceRoom1 = (round($priceRoom1) * $room1);
                $priceRoom1 = $priceRoom1 * $room1;
            } else {
                $priceRoom1 = 0;
            }
        }

        //Costo habitacion 2
        // /room # 2
        if (isset($room2) && $room2 > 0) {
            $contador = 0;
            while ($fecha2->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {
                if ($noches_escogidas != 0) {
                    if ($noches_escogidas == $contador) {
                        break;
                    }
                }
                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                $fec = $fecha2->getTimestamp();

                $sql = 'SELECT t1.id, t1.breakfast, t1.resoftfe, t1.nombre, t3.id as comifi, t3.sgl, t3.dbl, t3.tpl, t3.qua, t3.sgl2, t3.dbl2, t3.tpl2, t3.qua2, t3.sgl3, t3.dbl3, t3.tpl3, t3.qua3, t3.sgl4, t3.dbl4, t3.tpl4, t3.qua4, t3.sgl5, t3.dbl5, t3.tpl5, t3.qua5, t3.sgl6, t3.dbl6, t3.tpl6, t3.qua6, t3.sgl7, t3.dbl7, t3.tpl7, t3.qua7, t3.sgl8, t3.dbl8, t3.tpl8, t3.qua8, t3.sglm, t3.dblm, t3.tplm, t3.quam, t3.sglm2, t3.dblm2, t3.tplm2, t3.quam2, t3.sglm3, t3.dblm3, t3.tplm3, t3.quam3, t3.sglm4, t3.dblm4, t3.tplm4, t3.quam4, t3.sglm5, t3.dblm5, t3.tplm5, t3.quam5, t3.sglm6, t3.dblm6, t3.tplm6, t3.quam6, t3.sglm7, t3.dblm7, t3.tplm7, t3.quam7, t3.sglm8, t3.dblm8, t3.tplm8, t3.quam8, t3.chv21, t3.chm21, t3.chv32, t3.chm32, t3.chv43, t3.chm43, t3.chv54, t3.chm54, t3.chv65, t3.chm65, t3.chv76, t3.chm76, t3.chv87, t3.chm87, t3.chv98, t3.chm98,t3.costax,t3.netax,t3.comtax,t3.id_ratesvalid,t3.breackfast, t1.categoria
                   
						FROM hoteles t1	
							LEFT JOIN comifijas t3 ON (
											t1.id = t3.id_hotel											
											AND t3.fecha_ini <= ' . $fec . ' 
											AND t3.fecha_fin  >= ' . $fec . '
											)
						WHERE t3.id_hotel  = ' . $hotel . ' AND t3.id_ratesvalid = ' . $id_tour . '';
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();
                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }

                //$bandera = 2; 
                //TOUR 21 VALUE



                if ($numNoches['noches'] == 1 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {
                        
                        //($chv21*$room1_c)+($fdv_adult21*$room1*$free_night_buffet)+($fdv_child21*$room1_c*$free_night_buffet);
                        $priceRoom2 += $costohotel ['sgl'] + ($chv21 * $room2_c) + ($fdv_adult21 * $room2 * $frday) + ($fdv_child21 * $room2_c * $frday) + ($cargo_total) + ($cargo_total2) + ($cargo_total3) + ($cargo_total4);
                        //echo $priceRoom2;
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += $costohotel ['dbl'] + (($chv21 * $room2_c) / 2) + (($fdv_adult21 * $room2 * $frday) / 2) + (($fdv_child21 * $room2_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += $costohotel ['tpl'] + (($chv21 * $room2_c) / 3) + (($fdv_adult21 * $room2 * $frday) / 3) + (($fdv_child21 * $room2_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += $costohotel ['qua'] + (($chv21 * $room2_c) / 4) + (($fdv_adult21 * $room2 * $frday) / 4) + (($fdv_child21 * $room2_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                }

                //TOUR 21 MODERATE


                if ($numNoches['noches'] == 1 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += $costohotel ['sglm'] + ($chm21 * $room2_c) + ($fdm_adult21 * $room2 * $frday) + ($fdm_child21 * $room2_c * $frday) + ($cargo_total) + ($cargo_total2) + ($cargo_total3) + ($cargo_total4);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += $costohotel ['dblm'] + (($chm21 * $room2_c) / 2) + (($fdm_adult21 * $room2 * $frday) / 2) + (($fdm_child21 * $room2_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += $costohotel ['tplm'] + (($chm21 * $room2_c) / 3) + (($fdm_adult21 * $room2 * $frday) / 3) + (($fdm_child21 * $room2_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += $costohotel ['quam'] + (($chm21 * $room2_c) / 4) + (($fdm_adult21 * $room2 * $frday) / 4) + (($fdm_child21 * $room2_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                }

                //TOUR 32 VALUE


                if ($numNoches['noches'] == 2 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl2']) / 2 + (($chv32 * $room2_c) / 2) + (($fdv_adult32 * $room2 * $frday) / 2) + (($fdv_child32 * $room2_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl2']) / 2 + (($chv32 * $room2_c) / 4) + (($fdv_adult32 * $room2 * $frday) / 4) + (($fdv_child32 * $room2_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl2']) / 2 + (($chv32 * $room2_c) / 6) + (($fdv_adult32 * $room2 * $frday) / 6) + (($fdv_child32 * $room2_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua2']) / 2 + (($chv32 * $room2_c) / 8) + (($fdv_adult32 * $room2 * $frday) / 8) + (($fdv_child32 * $room2_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                }


                //TOUR 32 MODERATE



                if ($numNoches['noches'] == 2 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm2']) / 2 + (($chm32 * $room2_c) / 2) + (($fdm_adult32 * $room2 * $frday) / 2) + (($fdm_child32 * $room2_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm2']) / 2 + (($chm32 * $room2_c) / 4) + (($fdm_adult32 * $room2 * $frday) / 4) + (($fdm_child32 * $room2_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm2']) / 2 + (($chm32 * $room2_c) / 6) + (($fdm_adult32 * $room2 * $frday) / 6) + (($fdm_child32 * $room2_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam2']) / 2 + (($chm32 * $room2_c) / 8) + (($fdm_adult32 * $room2 * $frday) / 8) + (($fdm_child32 * $room2_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                }

                //TOUR 43 VALUE


                if ($numNoches['noches'] == 3 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl3']) / 3 + (($chv43 * $room2_c) / 3) + (($fdv_adult43 * $room2 * $frday) / 3) + (($fdv_child43 * $room2_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl3']) / 3 + (($chv43 * $room2_c) / 6) + (($fdv_adult43 * $room2 * $frday) / 6) + (($fdv_child43 * $room2_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl3']) / 3 + (($chv43 * $room2_c) / 9) + (($fdv_adult43 * $room2 * $frday) / 9) + (($fdv_child43 * $room2_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua3']) / 3 + (($chv43 * $room2_c) / 12) + (($fdv_adult43 * $room2 * $frday) / 12) + (($fdv_child43 * $room2_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                }

                //TOUR 43 MODERATE



                if ($numNoches['noches'] == 3 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm3']) / 3 + (($chm43 * $room2_c) / 3) + (($fdm_adult43 * $room2 * $frday) / 3) + (($fdm_child43 * $room2_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm3']) / 3 + (($chm43 * $room2_c) / 6) + (($fdm_adult43 * $room2 * $frday) / 6) + (($fdm_child43 * $room2_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm3']) / 3 + (($chm43 * $room2_c) / 9) + (($fdm_adult43 * $room2 * $frday) / 9) + (($fdm_child43 * $room2_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam3']) / 3 + (($chm43 * $room2_c) / 12) + (($fdm_adult43 * $room2 * $frday) / 12) + (($fdm_child43 * $room2_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                }

                //TOUR 54 VALUE



                if ($numNoches['noches'] == 4 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl4']) / 4 + (($chv54 * $room2_c) / 4) + (($fdv_adult54 * $room2 * $frday) / 4) + (($fdv_child54 * $room2_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl4']) / 4 + (($chv54 * $room2_c) / 8) + (($fdv_adult54 * $room2 * $frday) / 8) + (($fdv_child54 * $room2_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl4']) / 4 + (($chv54 * $room2_c) / 12) + (($fdv_adult54 * $room2 * $frday) / 12) + (($fdv_child54 * $room2_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua4']) / 4 + (($chv54 * $room2_c) / 16) + (($fdv_adult54 * $room2 * $frday) / 16) + (($fdv_child54 * $room2_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                }


                //TOUR 54 MODERATE


                if ($numNoches['noches'] == 4 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm4']) / 4 + (($chm54 * $room2_c) / 4) + (($fdm_adult54 * $room2 * $frday) / 4) + (($fdm_child54 * $room2_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm4']) / 4 + (($chm54 * $room2_c) / 8) + (($fdm_adult54 * $room2 * $frday) / 8) + (($fdm_child54 * $room2_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm4']) / 4 + (($chm54 * $room2_c) / 12) + (($fdm_adult54 * $room2 * $frday) / 12) + (($fdm_child54 * $room2_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam4']) / 4 + (($chm54 * $room2_c) / 16) + (($fdm_adult54 * $room2 * $frday) / 16) + (($fdm_child54 * $room2_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                }

                //TOUR 65 VALUE


                if ($numNoches['noches'] == 5 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl5']) / 5 + (($chv65 * $room2_c) / 5) + (($fdv_adult65 * $room2 * $frday) / 5) + (($fdv_child65 * $room2_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl5']) / 5 + (($chv65 * $room2_c) / 10) + (($fdv_adult65 * $room2 * $frday) / 10) + (($fdv_child65 * $room2_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl5']) / 5 + (($chv65 * $room2_c) / 15) + (($fdv_adult65 * $room2 * $frday) / 15) + (($fdv_child65 * $room2_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua5']) / 5 + (($chv65 * $room2_c) / 20) + (($fdv_adult65 * $room2 * $frday) / 20) + (($fdv_child65 * $room2_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                    }
                }

                //TOUR 65 MODERATE


                if ($numNoches['noches'] == 5 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm5']) / 5 + (($chm65 * $room2_c) / 5) + (($fdm_adult65 * $room2 * $frday) / 5) + (($fdm_child65 * $room2_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm5']) / 5 + (($chm65 * $room2_c) / 10) + (($fdm_adult65 * $room2 * $frday) / 10) + (($fdm_child65 * $room2_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm5']) / 5 + (($chm65 * $room2_c) / 15) + (($fdm_adult65 * $room2 * $frday) / 15) + (($fdm_child65 * $room2_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam5']) / 5 + (($chm65 * $room2_c) / 20) + (($fdm_adult65 * $room2 * $frday) / 20) + (($fdm_child65 * $room2_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                    }
                }

                //TOUR 76 VALUE



                if ($numNoches['noches'] == 6 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl6']) / 6 + (($chv76 * $room2_c) / 6) + (($fdv_adult76 * $room2 * $frday) / 6) + (($fdv_child76 * $room2_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl6']) / 6 + (($chv76 * $room2_c) / 12) + (($fdv_adult76 * $room2 * $frday) / 12) + (($fdv_child76 * $room2_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl6']) / 6 + (($chv76 * $room2_c) / 18) + (($fdv_adult76 * $room2 * $frday) / 18) + (($fdv_child76 * $room2_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua6']) / 6 + (($chv76 * $room2_c) / 24) + (($fdv_adult76 * $room2 * $frday) / 24) + (($fdv_child76 * $room2_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                }

                //TOUR 76 MODERATE


                if ($numNoches['noches'] == 6 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm6']) / 6 + (($chm76 * $room2_c) / 6) + (($fdm_adult76 * $room2 * $frday) / 6) + (($fdm_child76 * $room2_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm6']) / 6 + (($chm76 * $room2_c) / 12) + (($fdm_adult76 * $room2 * $frday) / 12) + (($fdm_child76 * $room2_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm6']) / 6 + (($chm76 * $room2_c) / 18) + (($fdm_adult76 * $room2 * $frday) / 18) + (($fdm_child76 * $room2_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam6']) / 6 + (($chm76 * $room2_c) / 24) + (($fdm_adult76 * $room2 * $frday) / 24) + (($fdm_child76 * $room2_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                }

                //TOUR 87 VALUE 



                if ($numNoches['noches'] == 7 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl7']) / 7 + (($chv87 * $room2_c) / 7) + (($fdv_adult87 * $room2 * $frday) / 7) + (($fdv_child87 * $room2_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl7']) / 7 + (($chv87 * $room2_c) / 14) + (($fdv_adult87 * $room2 * $frday) / 14) + (($fdv_child87 * $room2_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl7']) / 7 + (($chv87 * $room2_c) / 21) + (($fdv_adult87 * $room2 * $frday) / 21) + (($fdv_child87 * $room2_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua7']) / 7 + (($chv87 * $room2_c) / 28) + (($fdv_adult87 * $room2 * $frday) / 28) + (($fdv_child87 * $room2_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                    }
                }

                //TOUR 87 MODERATE



                if ($numNoches['noches'] == 7 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);

                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm7']) / 7 + (($chm87 * $room2_c) / 7) + (($fdm_adult87 * $room2 * $frday) / 7) + (($fdm_child87 * $room2_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm7']) / 7 + (($chm87 * $room2_c) / 14) + (($fdm_adult87 * $room2 * $frday) / 14) + (($fdm_child87 * $room2_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm7']) / 7 + (($chm87 * $room2_c) / 21) + (($fdm_adult87 * $room2 * $frday) / 21) + (($fdm_child87 * $room2_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam7']) / 7 + (($chm87 * $room2_c) / 28) + (($fdm_adult87 * $room2 * $frday) / 28) + (($fdm_child87 * $room2_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                    }
                }

                // TOUR 98 VALUE



                if ($numNoches['noches'] == 8 && $categor == 2 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl8']) / 8 + (($chv98 * $room2_c) / 8) + (($fdv_adult98 * $room2 * $frday) / 8) + (($fdv_child98 * $room2_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl8']) / 8 + (($chv98 * $room2_c) / 16) + (($fdv_adult98 * $room2 * $frday) / 16) + (($fdv_child98 * $room2_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl8']) / 8 + (($chv98 * $room2_c) / 24) + (($fdv_adult98 * $room2 * $frday) / 24) + (($fdv_child98 * $room2_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua8']) / 8 + (($chv98 * $room2_c) / 32) + (($fdv_adult98 * $room2 * $frday) / 32) + (($fdv_child98 * $room2_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                    }
                }

                //TOUR 98 MODERATE


                if ($numNoches['noches'] == 8 && $categor == 3 && $room2 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm8']) / 8 + (($chm98 * $room2_c) / 8) + (($fdm_adult98 * $room2 * $frday) / 8) + (($fdm_child98 * $room2_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm8']) / 8 + (($chm98 * $room2_c) / 16) + (($fdm_adult98 * $room2 * $frday) / 16) + (($fdm_child98 * $room2_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm8']) / 8 + (($chm98 * $room2_c) / 24) + (($fdm_adult98 * $room2 * $frday) / 24) + (($fdm_child98 * $room2_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam8']) / 8 + (($chm98 * $room2_c) / 32) + (($fdm_adult98 * $room2 * $frday) / 32) + (($fdm_child98 * $room2_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                    }
                }

                if ($room2 == 0) {

                    $priceRoom2 = 0;
                }

                date_add($fecha2, date_interval_create_from_date_string('1 days'));
                $contador++;
            }

            //$priceRoom2 = round($priceRoom2) * $room2;
            $priceRoom2 = $priceRoom2 * $room2;
        } else {
            $priceRoom2 = 0;
        }
        //Costo habitacion 3
        // /room # 3
        if (isset($room3) && $room3 > 0) {
            $contador = 0;
            while ($fecha3->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {
                if ($noches_escogidas != 0) {
                    if ($noches_escogidas == $contador) {
                        break;
                    }
                }
                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();

                $fec = $fecha3->getTimestamp();
                $sql = 'SELECT t1.id, t1.breakfast, t1.resoftfe, t1.nombre, t3.id as comifi, t3.sgl, t3.dbl, t3.tpl, t3.qua, t3.sgl2, t3.dbl2, t3.tpl2, t3.qua2, t3.sgl3, t3.dbl3, t3.tpl3, t3.qua3, t3.sgl4, t3.dbl4, t3.tpl4, t3.qua4, t3.sgl5, t3.dbl5, t3.tpl5, t3.qua5, t3.sgl6, t3.dbl6, t3.tpl6, t3.qua6, t3.sgl7, t3.dbl7, t3.tpl7, t3.qua7, t3.sgl8, t3.dbl8, t3.tpl8, t3.qua8, t3.sglm, t3.dblm, t3.tplm, t3.quam, t3.sglm2, t3.dblm2, t3.tplm2, t3.quam2, t3.sglm3, t3.dblm3, t3.tplm3, t3.quam3, t3.sglm4, t3.dblm4, t3.tplm4, t3.quam4, t3.sglm5, t3.dblm5, t3.tplm5, t3.quam5, t3.sglm6, t3.dblm6, t3.tplm6, t3.quam6, t3.sglm7, t3.dblm7, t3.tplm7, t3.quam7, t3.sglm8, t3.dblm8, t3.tplm8, t3.quam8, t3.chv21, t3.chm21,t3.chv32, t3.chm32, t3.chv43, t3.chm43, t3.chv54, t3.chm54, t3.chv65, t3.chm65, t3.chv76, t3.chm76, t3.chv87, t3.chm87, t3.chv98, t3.chm98,t3.costax,t3.netax,t3.comtax,t3.id_ratesvalid,t3.breackfast, t1.categoria
                   
						FROM hoteles t1	
							LEFT JOIN comifijas t3 ON (
											t1.id = t3.id_hotel											
											AND t3.fecha_ini <= ' . $fec . ' 
											AND t3.fecha_fin  >= ' . $fec . '
											)
						WHERE t3.id_hotel  = ' . $hotel . ' AND t3.id_ratesvalid = ' . $id_tour . '';
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();
                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }

                //$bandera = 2 ;
                //TOUR 21 VALUE



                if ($numNoches['noches'] == 1 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    

                    if ($room3 == 1) {

                        $priceRoom3 += $costohotel ['sgl'] + ($chv21 * $room3_c) + ($fdv_adult21 * $room3 * $frday) + ($fdv_child21 * $room3_c * $frday) + $cargo_total + $cargo_total2 + $cargo_total3 + $cargo_total4;
                        //echo $priceRoom3;
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += $costohotel ['dbl'] + (($chv21 * $room3_c) / 2) + (($fdv_adult21 * $room3 * $frday) / 2) + (($fdv_child21 * $room3_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += $costohotel ['tpl'] + (($chv21 * $room3_c) / 3) + (($fdv_adult21 * $room3 * $frday) / 3) + (($fdv_child21 * $room3_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += $costohotel ['qua'] + (($chv21 * $room3_c) / 4) + (($fdv_adult21 * $room3 * $frday) / 4) + (($fdv_child21 * $room3_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                }

                //TOUR 21 MODERATE



                if ($numNoches['noches'] == 1 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += $costohotel ['sglm'] + ($chm21 * $room3_c) + ($fdm_adult21 * $room3 * $frday) + ($fdm_child21 * $room3_c * $frday) + $cargo_total + $cargo_total2 + $cargo_total3 + $cargo_total4;
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += $costohotel ['dblm'] + (($chm21 * $room3_c) / 2) + (($fdm_adult21 * $room3 * $frday) / 2) + (($fdm_child21 * $room3_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += $costohotel ['tplm'] + (($chm21 * $room3_c) / 3) + (($fdm_adult21 * $room3 * $frday) / 3) + (($fdm_child21 * $room3_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += $costohotel ['quam'] + (($chm21 * $room3_c) / 4) + (($fdm_adult21 * $room3 * $frday) / 4) + (($fdm_child21 * $room3_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                }

                //TOUR 32 VALUE



                if ($numNoches['noches'] == 2 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl2']) / 2 + (($chv32 * $room3_c) / 2) + (($fdv_adult32 * $room3 * $frday) / 2) + (($fdv_child32 * $room3_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl2']) / 2 + (($chv32 * $room3_c) / 4) + (($fdv_adult32 * $room3 * $frday) / 4) + (($fdv_child32 * $room3_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl2']) / 2 + (($chv32 * $room3_c) / 6) + (($fdv_adult32 * $room3 * $frday) / 6) + (($fdv_child32 * $room3_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua2']) / 2 + (($chv32 * $room3_c) / 8) + (($fdv_adult32 * $room3 * $frday) / 8) + (($fdv_child32 * $room3_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                }


                //TOUR 32 MODERATE



                if ($numNoches['noches'] == 2 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm2']) / 2 + (($chm32 * $room3_c) / 2) + (($fdm_adult32 * $room3 * $frday) / 2) + (($fdm_child32 * $room3_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm2']) / 2 + (($chm32 * $room3_c) / 4) + (($fdm_adult32 * $room3 * $frday) / 4) + (($fdm_child32 * $room3_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm2']) / 2 + (($chm32 * $room3_c) / 6) + (($fdm_adult32 * $room3 * $frday) / 6) + (($fdm_child32 * $room3_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam2']) / 2 + (($chm32 * $room3_c) / 8) + (($fdm_adult32 * $room3 * $frday) / 8) + (($fdm_child32 * $room3_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                }

                //TOUR 43 VALUE



                if ($numNoches['noches'] == 3 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl3']) / 3 + (($chv43 * $room3_c) / 3) + (($fdv_adult43 * $room3 * $frday) / 3) + (($fdv_child43 * $room3_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl3']) / 3 + (($chv43 * $room3_c) / 6) + (($fdv_adult43 * $room3 * $frday) / 6) + (($fdv_child43 * $room3_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl3']) / 3 + (($chv43 * $room3_c) / 9) + (($fdv_adult43 * $room3 * $frday) / 9) + (($fdv_child43 * $room3_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua3']) / 3 + (($chv43 * $room3_c) / 12) + (($fdv_adult43 * $room3 * $frday) / 12) + (($fdv_child43 * $room3_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                }

                //TOUR 43 MODERATE



                if ($numNoches['noches'] == 3 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm3']) / 3 + (($chm43 * $room3_c) / 3) + (($fdm_adult43 * $room3 * $frday) / 3) + (($fdm_child43 * $room3_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm3']) / 3 + (($chm43 * $room3_c) / 6) + (($fdm_adult43 * $room3 * $frday) / 6) + (($fdm_child43 * $room3_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm3']) / 3 + (($chm43 * $room3_c) / 9) + (($fdm_adult43 * $room3 * $frday) / 9) + (($fdm_child43 * $room3_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam3']) / 3 + (($chm43 * $room3_c) / 12) + (($fdm_adult43 * $room3 * $frday) / 12) + (($fdm_child43 * $room3_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                }

                //TOUR 54 VALUE



                if ($numNoches['noches'] == 4 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl4']) / 4 + (($chv54 * $room3_c) / 4) + (($fdv_adult54 * $room3 * $frday) / 4) + (($fdv_child54 * $room3_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl4']) / 4 + (($chv54 * $room3_c) / 8) + (($fdv_adult54 * $room3 * $frday) / 8) + (($fdv_child54 * $room3_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl4']) / 4 + (($chv54 * $room3_c) / 12) + (($fdv_adult54 * $room3 * $frday) / 12) + (($fdv_child54 * $room3_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua4']) / 4 + (($chv54 * $room3_c) / 16) + (($fdv_adult54 * $room3 * $frday) / 16) + (($fdv_child54 * $room3_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                }

                //TOUR 54 MODERATE


                if ($numNoches['noches'] == 4 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);


                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm4']) / 4 + (($chm54 * $room3_c) / 4) + (($fdm_adult54 * $room3 * $frday) / 4) + (($fdm_child54 * $room3_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm4']) / 4 + (($chm54 * $room3_c) / 8) + (($fdm_adult54 * $room3 * $frday) / 8) + (($fdm_child54 * $room3_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm4']) / 4 + (($chm54 * $room3_c) / 12) + (($fdm_adult54 * $room3 * $frday) / 12) + (($fdm_child54 * $room3_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam4']) / 4 + (($chm54 * $room3_c) / 16) + (($fdm_adult54 * $room3 * $frday) / 16) + (($fdm_child54 * $room3_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                }

                // TOUR 65 VALUE



                if ($numNoches['noches'] == 5 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl5']) / 5 + (($chv65 * $room3_c) / 5) + (($fdv_adult65 * $room3 * $frday) / 5) + (($fdv_child65 * $room3_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl5']) / 5 + (($chv65 * $room3_c) / 10) + (($fdv_adult65 * $room3 * $frday) / 10) + (($fdv_child65 * $room3_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl5']) / 5 + (($chv65 * $room3_c) / 15) + (($fdv_adult65 * $room3 * $frday) / 15) + (($fdv_child65 * $room3_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua5']) / 5 + (($chv65 * $room3_c) / 20) + (($fdv_adult65 * $room3 * $frday) / 20) + (($fdv_child65 * $room3_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                    }
                }

                //TOUR 65 MODERATE



                if ($numNoches['noches'] == 5 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm5']) / 5 + (($chm65 * $room3_c) / 5) + (($fdm_adult65 * $room3 * $frday) / 5) + (($fdm_child65 * $room3_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm5']) / 5 + (($chm65 * $room3_c) / 10) + (($fdm_adult65 * $room3 * $frday) / 10) + (($fdm_child65 * $room3_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm5']) / 5 + (($chm65 * $room3_c) / 15) + (($fdm_adult65 * $room3 * $frday) / 15) + (($fdm_child65 * $room3_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam5']) / 5 + (($chm65 * $room3_c) / 20) + (($fdm_adult65 * $room3 * $frday) / 20) + (($fdm_child65 * $room3_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                    }
                }
                //TOUR 76 VALUE



                if ($numNoches['noches'] == 6 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl6']) / 6 + (($chv76 * $room3_c) / 6) + (($fdv_adult76 * $room3 * $frday) / 6) + (($fdv_child76 * $room3_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl6']) / 6 + (($chv76 * $room3_c) / 12) + (($fdv_adult76 * $room3 * $frday) / 12) + (($fdv_child76 * $room3_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl6']) / 6 + (($chv76 * $room3_c) / 18) + (($fdv_adult76 * $room3 * $frday) / 18) + (($fdv_child76 * $room3_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua6']) / 6 + (($chv76 * $room3_c) / 24) + (($fdv_adult76 * $room3 * $frday) / 24) + (($fdv_child76 * $room3_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                }

                //TOUR 76 MODERATE



                if ($numNoches['noches'] == 6 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm6']) / 6 + (($chm76 * $room3_c) / 6) + (($fdm_adult76 * $room3 * $frday) / 6) + (($fdm_child76 * $room3_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm6']) / 6 + (($chm76 * $room3_c) / 12) + (($fdm_adult76 * $room3 * $frday) / 12) + (($fdm_child76 * $room3_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm6']) / 6 + (($chm76 * $room3_c) / 18) + (($fdm_adult76 * $room3 * $frday) / 18) + (($fdm_child76 * $room3_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam6']) / 6 + (($chm76 * $room3_c) / 24) + (($fdm_adult76 * $room3 * $frday) / 24) + (($fdm_child76 * $room3_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                }
                //TOUR 87 VALUE




                if ($numNoches['noches'] == 7 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl7']) / 7 + (($chv87 * $room3_c) / 7) + (($fdv_adult87 * $room3 * $frday) / 7) + (($fdv_child87 * $room3_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl7']) / 7 + (($chv87 * $room3_c) / 14) + (($fdv_adult87 * $room3 * $frday) / 14) + (($fdv_child87 * $room3_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl7']) / 7 + (($chv87 * $room3_c) / 21) + (($fdv_adult87 * $room3 * $frday) / 21) + (($fdv_child87 * $room3_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua7']) / 7 + (($chv87 * $room3_c) / 28) + (($fdv_adult87 * $room3 * $frday) / 28) + (($fdv_child87 * $room3_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                    }
                }

                //TOUR 87 MODERATE


                if ($numNoches['noches'] == 7 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm7']) / 7 + (($chm87 * $room3_c) / 7) + (($fdm_adult87 * $room3 * $frday) / 7) + (($fdm_child87 * $room3_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm7']) / 7 + (($chm87 * $room3_c) / 14) + (($fdm_adult87 * $room3 * $frday) / 14) + (($fdm_child87 * $room3_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm7']) / 7 + (($chm87 * $room3_c) / 21) + (($fdm_adult87 * $room3 * $frday) / 21) + (($fdm_child87 * $room3_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam7']) / 7 + (($chm87 * $room3_c) / 28) + (($fdm_adult87 * $room3 * $frday) / 28) + (($fdm_child87 * $room3_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                    }
                }

                //TOUR 98 VALUE



                if ($numNoches['noches'] == 8 && $categor == 2 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl8']) / 8 + (($chv98 * $room3_c) / 8) + (($fdv_adult98 * $room3 * $frday) / 8) + (($fdv_child98 * $room3_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl8']) / 8 + (($chv98 * $room3_c) / 16) + (($fdv_adult98 * $room3 * $frday) / 16) + (($fdv_child98 * $room3_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl8']) / 8 + (($chv98 * $room3_c) / 24) + (($fdv_adult98 * $room3 * $frday) / 24) + (($fdv_child98 * $room3_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua8']) / 8 + (($chv98 * $room3_c) / 32) + (($fdv_adult98 * $room3 * $frday) / 32) + (($fdv_child98 * $room3_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                    }
                }
                //TOUR 98 MODERATE



                if ($numNoches['noches'] == 8 && $categor == 3 && $room3 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm8']) / 8 + (($chm98 * $room3_c) / 8) + (($fdm_adult98 * $room3 * $frday) / 8) + (($fdm_child98 * $room3_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm8']) / 8 + (($chm98 * $room3_c) / 16) + (($fdm_adult98 * $room3 * $frday) / 16) + (($fdm_child98 * $room3_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm8']) / 8 + (($chm98 * $room3_c) / 24) + (($fdm_adult98 * $room3 * $frday) / 24) + (($fdm_child98 * $room3_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam8']) / 8 + (($chm98 * $room3_c) / 32) + (($fdm_adult98 * $room3 * $frday) / 32) + (($fdm_child98 * $room3_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                    }
                }

                if ($room3 == 0) {

                    $priceRoom3 = 0;
                }

                date_add($fecha3, date_interval_create_from_date_string('1 days'));
                $contador++;
            }
            //$priceRoom3 = (round($priceRoom3) * $room3);
            $priceRoom3 = $priceRoom3 * $room3;
        } else {
            $priceRoom3 = 0;
        }
        //Costo habitacion 1
        // /room # 4
        if (isset($room4) && $room4 > 0) {
            $contador = 0;
            while ($fecha4->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {
                if ($noches_escogidas != 0) {
                    if ($noches_escogidas == $contador) {
                        break;
                    }
                }
                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                $fec = $fecha4->getTimestamp();


                $sql = 'SELECT t1.id,t1.breakfast,t1.resoftfe,t1.nombre,t3.id as comifi, t3.sgl, t3.dbl, t3.tpl, t3.qua, t3.sgl2, t3.dbl2, t3.tpl2, t3.qua2, t3.sgl3, t3.dbl3, t3.tpl3, t3.qua3, t3.sgl4, t3.dbl4, t3.tpl4, t3.qua4, t3.sgl5, t3.dbl5, t3.tpl5, t3.qua5, t3.sgl6, t3.dbl6, t3.tpl6, t3.qua6, t3.sgl7, t3.dbl7, t3.tpl7, t3.qua7, t3.sgl8, t3.dbl8, t3.tpl8, t3.qua8, t3.sglm, t3.dblm, t3.tplm, t3.quam, t3.sglm2, t3.dblm2, t3.tplm2, t3.quam2, t3.sglm3, t3.dblm3, t3.tplm3, t3.quam3, t3.sglm4, t3.dblm4, t3.tplm4, t3.quam4, t3.sglm5, t3.dblm5, t3.tplm5, t3.quam5, t3.sglm6, t3.dblm6, t3.tplm6, t3.quam6, t3.sglm7, t3.dblm7, t3.tplm7, t3.quam7, t3.sglm8, t3.dblm8, t3.tplm8, t3.quam8, t3.chv21, t3.chm21, t3.chv32, t3.chm32, t3.chv43, t3.chm43, t3.chv54, t3.chm54, t3.chv65, t3.chm65, t3.chv76, t3.chm76, t3.chv87, t3.chm87, t3.chv98, t3.chm98,t3.costax,t3.netax,t3.comtax,t3.id_ratesvalid,t3.breackfast, t1.categoria
                    
						FROM hoteles t1	
							LEFT JOIN comifijas t3 ON (
											t1.id = t3.id_hotel											
											AND t3.fecha_ini <= ' . $fec . ' 
											AND t3.fecha_fin  >= ' . $fec . '
											)
						WHERE t3.id_hotel  = ' . $hotel . ' AND t3.id_ratesvalid = ' . $id_tour . '';
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();

                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }
                //print_r(Doo::db()->showSQL());
                //$bandera = 2;
                //TOUR 21 VALUE

                
                


                if ($numNoches['noches'] == 1 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += $costohotel ['sgl'] + ($chv21 * $room4_c) + ($fdv_adult21 * $room4 * $frday) + ($fdv_child21 * $room4_c * $frday) + $cargo_total + $cargo_total2 + $cargo_total3 + $cargo_total4;
                        //echo $priceRoom4;
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += $costohotel ['dbl'] + (($chv21 * $room4_c) / 2) + (($fdv_adult21 * $room4 * $frday) / 2) + (($fdv_child21 * $room4_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += $costohotel ['tpl'] + (($chv21 * $room4_c) / 3) + (($fdv_adult21 * $room4 * $frday) / 3) + (($fdv_child21 * $room4_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += $costohotel ['qua'] + (($chv21 * $room4_c) / 4) + (($fdv_adult21 * $room4 * $frday) / 4) + (($fdv_child21 * $room4_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                }

                //TOUR 21 MODERATE



                if ($numNoches['noches'] == 1 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);

                    if ($room4 == 1) {

                        $priceRoom4 += $costohotel ['sglm'] + ($chm21 * $room4_c) + ($fdm_adult21 * $room4 * $frday) + ($fdm_child21 * $room4_c * $frday) + $cargo_total + $cargo_total2 + $cargo_total3 + $cargo_total4;
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += $costohotel ['dblm'] + (($chm21 * $room4_c) / 2) + (($fdm_adult21 * $room4 * $frday) / 2) + (($fdm_child21 * $room4_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += $costohotel ['tplm'] + (($chm21 * $room4_c) / 3) + (($fdm_adult21 * $room4 * $frday) / 3) + (($fdm_child21 * $room4_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += $costohotel ['quam'] + (($chm21 * $room4_c) / 4) + (($fdm_adult21 * $room4 * $frday) / 4) + (($fdm_child21 * $room4_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                }

                //TOUR 32 VALUE                    



                if ($numNoches['noches'] == 2 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl2']) / 2 + (($chv32 * $room4_c) / 2) + (($fdv_adult32 * $room4 * $frday) / 2) + (($fdv_child32 * $room4_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl2']) / 2 + (($chv32 * $room4_c) / 4) + (($fdv_adult32 * $room4 * $frday) / 4) + (($fdv_child32 * $room4_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl2']) / 2 + (($chv32 * $room4_c) / 6) + (($fdv_adult32 * $room4 * $frday) / 6) + (($fdv_child32 * $room4_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua2']) / 2 + (($chv32 * $room4_c) / 8) + (($fdv_adult32 * $room4 * $frday) / 8) + (($fdv_child32 * $room4_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                }

                //TOUR 32 MODERATE



                if ($numNoches['noches'] == 2 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm2']) / 2 + (($chm32 * $room4_c) / 2) + (($fdm_adult32 * $room4 * $frday) / 2) + (($fdm_child32 * $room4_c * $frday) / 2) + (($cargo_total)/2) + (($cargo_total2)/2) + (($cargo_total3)/2) + (($cargo_total4)/2);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm2']) / 2 + (($chm32 * $room4_c) / 4) + (($fdm_adult32 * $room4 * $frday) / 4) + (($fdm_child32 * $room4_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm2']) / 2 + (($chm32 * $room4_c) / 6) + (($fdm_adult32 * $room4 * $frday) / 6) + (($fdm_child32 * $room4_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam2']) / 2 + (($chm32 * $room4_c) / 8) + (($fdm_adult32 * $room4 * $frday) / 8) + (($fdm_child32 * $room4_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                }

                // TOUR 43 VALUE                  



                if ($numNoches['noches'] == 3 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl3']) / 3 + (($chv43 * $room4_c) / 3) + (($fdv_adult43 * $room4 * $frday) / 3) + (($fdv_child43 * $room4_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl3']) / 3 + (($chv43 * $room4_c) / 6) + (($fdv_adult43 * $room4 * $frday) / 6) + (($fdv_child43 * $room4_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl3']) / 3 + (($chv43 * $room4_c) / 9) + (($fdv_adult43 * $room4 * $frday) / 9) + (($fdv_child43 * $room4_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua3']) / 3 + (($chv43 * $room4_c) / 12) + (($fdv_adult43 * $room4 * $frday) / 12) + (($fdv_child43 * $room4_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                }

                //TOUR 43 MODERATE



                if ($numNoches['noches'] == 3 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm3']) / 3 + (($chm43 * $room4_c) / 3) + (($fdm_adult43 * $room4 * $frday) / 3) + (($fdm_child43 * $room4_c * $frday) / 3) + (($cargo_total)/3) + (($cargo_total2)/3) + (($cargo_total3)/3) + (($cargo_total4)/3);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm3']) / 3 + (($chm43 * $room4_c) / 6) + (($fdm_adult43 * $room4 * $frday) / 6) + (($fdm_child43 * $room4_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm3']) / 3 + (($chm43 * $room4_c) / 9) + (($fdm_adult43 * $room4 * $frday) / 9) + (($fdm_child43 * $room4_c * $frday) / 9) + (($cargo_total)/9) + (($cargo_total2)/9) + (($cargo_total3)/9) + (($cargo_total4)/9);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam3']) / 3 + (($chm43 * $room4_c) / 12) + (($fdm_adult43 * $room4 * $frday) / 12) + (($fdm_child43 * $room4_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                }

                //TOUR 54 VALUE                



                if ($numNoches['noches'] == 4 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl4']) / 4 + (($chv54 * $room4_c) / 4) + (($fdv_adult54 * $room4 * $frday) / 4) + (($fdv_child54 * $room4_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl4']) / 4 + (($chv54 * $room4_c) / 8) + (($fdv_adult54 * $room4 * $frday) / 8) + (($fdv_child54 * $room4_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl4']) / 4 + (($chv54 * $room4_c) / 12) + (($fdv_adult54 * $room4 * $frday) / 12) + (($fdv_child54 * $room4_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua4']) / 4 + (($chv54 * $room4_c) / 16) + (($fdv_adult54 * $room4 * $frday) / 16) + (($fdv_child54 * $room4_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                }

                //TOUR 54 MODERATE                    



                if ($numNoches['noches'] == 4 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm4']) / 4 + (($chm54 * $room4_c) / 4) + (($fdm_adult54 * $room4 * $frday) / 4) + (($fdm_child54 * $room4_c * $frday) / 4) + (($cargo_total)/4) + (($cargo_total2)/4) + (($cargo_total3)/4) + (($cargo_total4)/4);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm4']) / 4 + (($chm54 * $room4_c) / 8) + (($fdm_adult54 * $room4 * $frday) / 8) + (($fdm_child54 * $room4_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm4']) / 4 + (($chm54 * $room4_c) / 12) + (($fdm_adult54 * $room4 * $frday) / 12) + (($fdm_child54 * $room4_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam4']) / 4 + (($chm54 * $room4_c) / 16) + (($fdm_adult54 * $room4 * $frday) / 16) + (($fdm_child54 * $room4_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                }

                //TOUR 65 VALUE                      



                if ($numNoches['noches'] == 5 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl5']) / 5 + (($chv65 * $room4_c) / 5) + (($fdv_adult65 * $room4 * $frday) / 5) + (($fdv_child65 * $room4_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl5']) / 5 + (($chv65 * $room4_c) / 10) + (($fdv_adult65 * $room4 * $frday) / 10) + (($fdv_child65 * $room4_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl5']) / 5 + (($chv65 * $room4_c) / 15) + (($fdv_adult65 * $room4 * $frday) / 15) + (($fdv_child65 * $room4_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua5']) / 5 + (($chv65 * $room4_c) / 20) + (($fdv_adult65 * $room4 * $frday) / 20) + (($fdv_child65 * $room4_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                    }
                }

                //TOUR 65 MODERATE



                if ($numNoches['noches'] == 5 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm5']) / 5 + (($chm65 * $room4_c) / 5) + (($fdm_adult65 * $room4 * $frday) / 5) + (($fdm_child65 * $room4_c * $frday) / 5) + (($cargo_total)/5) + (($cargo_total2)/5) + (($cargo_total3)/5) + (($cargo_total4)/5);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm5']) / 5 + (($chm65 * $room4_c) / 10) + (($fdm_adult65 * $room4 * $frday) / 10) + (($fdm_child65 * $room4_c * $frday) / 10) + (($cargo_total)/10) + (($cargo_total2)/10) + (($cargo_total3)/10) + (($cargo_total4)/10);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm5']) / 5 + (($chm65 * $room4_c) / 15) + (($fdm_adult65 * $room4 * $frday) / 15) + (($fdm_child65 * $room4_c * $frday) / 15) + (($cargo_total)/15) + (($cargo_total2)/15) + (($cargo_total3)/15) + (($cargo_total4)/15);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam5']) / 5 + (($chm65 * $room4_c) / 20) + (($fdm_adult65 * $room4 * $frday) / 20) + (($fdm_child65 * $room4_c * $frday) / 20) + (($cargo_total)/20) + (($cargo_total2)/20) + (($cargo_total3)/20) + (($cargo_total4)/20);
                    }
                }

                //TOUR 76 VALUE



                if ($numNoches['noches'] == 6 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl6']) / 6 + (($chv76 * $room4_c) / 6) + (($fdv_adult76 * $room4 * $frday) / 6) + (($fdv_child76 * $room4_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl6']) / 6 + (($chv76 * $room4_c) / 12) + (($fdv_adult76 * $room4 * $frday) / 12) + (($fdv_child76 * $room4_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl6']) / 6 + (($chv76 * $room4_c) / 18) + (($fdv_adult76 * $room4 * $frday) / 18) + (($fdv_child76 * $room4_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua6']) / 6 + (($chv76 * $room4_c) / 24) + (($fdv_adult76 * $room4 * $frday) / 24) + (($fdv_child76 * $room4_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                }

                //TOUR 76 MODERATE



                if ($numNoches['noches'] == 6 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);                    
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm6']) / 6 + (($chm76 * $room4_c) / 6) + (($fdm_adult76 * $room4 * $frday) / 6) + (($fdm_child76 * $room4_c * $frday) / 6) + (($cargo_total)/6) + (($cargo_total2)/6) + (($cargo_total3)/6) + (($cargo_total4)/6);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm6']) / 6 + (($chm76 * $room4_c) / 12) + (($fdm_adult76 * $room4 * $frday) / 12) + (($fdm_child76 * $room4_c * $frday) / 12) + (($cargo_total)/12) + (($cargo_total2)/12) + (($cargo_total3)/12) + (($cargo_total4)/12);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm6']) / 6 + (($chm76 * $room4_c) / 18) + (($fdm_adult76 * $room4 * $frday) / 18) + (($fdm_child76 * $room4_c * $frday) / 18) + (($cargo_total)/18) + (($cargo_total2)/18) + (($cargo_total3)/18) + (($cargo_total4)/18);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam6']) / 6 + (($chm76 * $room4_c) / 24) + (($fdm_adult76 * $room4 * $frday) / 24) + (($fdm_child76 * $room4_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                }

                //TOUR 87 VALUE 




                if ($numNoches['noches'] == 7 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl7']) / 7 + (($chv87 * $room4_c) / 7) + (($fdv_adult87 * $room4 * $frday) / 7) + (($fdv_child87 * $room4_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl7']) / 7 + (($chv87 * $room4_c) / 14) + (($fdv_adult87 * $room4 * $frday) / 14) + (($fdv_child87 * $room4_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl7']) / 7 + (($chv87 * $room4_c) / 21) + (($fdv_adult87 * $room4 * $frday) / 21) + (($fdv_child87 * $room4_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua7']) / 7 + (($chv87 * $room4_c) / 28) + (($fdv_adult87 * $room4 * $frday) / 28) + (($fdv_child87 * $room4_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                    }
                }

                //TOUR 87 MODERATE

                if ($numNoches['noches'] == 7 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm7']) / 7 + (($chm87 * $room4_c) / 7) + (($fdm_adult87 * $room4 * $frday) / 7) + (($fdm_child87 * $room4_c * $frday) / 7) + (($cargo_total)/7) + (($cargo_total2)/7) + (($cargo_total3)/7) + (($cargo_total4)/7);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm7']) / 7 + (($chm87 * $room4_c) / 14) + (($fdm_adult87 * $room4 * $frday) / 14) + (($fdm_child87 * $room4_c * $frday) / 14) + (($cargo_total)/14) + (($cargo_total2)/14) + (($cargo_total3)/14) + (($cargo_total4)/14);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm7']) / 7 + (($chm87 * $room4_c) / 21) + (($fdm_adult87 * $room4 * $frday) / 21) + (($fdm_child87 * $room4_c * $frday) / 21) + (($cargo_total)/21) + (($cargo_total2)/21) + (($cargo_total3)/21) + (($cargo_total4)/21);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam7']) / 7 + (($chm87 * $room4_c) / 28) + (($fdm_adult87 * $room4 * $frday) / 28) + (($fdm_child87 * $room4_c * $frday) / 28) + (($cargo_total)/28) + (($cargo_total2)/28) + (($cargo_total3)/28) + (($cargo_total4)/28);
                    }
                }



                //TOUR 98 VALUE 

                if ($numNoches['noches'] == 8 && $categor == 2 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];                        
                    $cargo_total = ($numero_noches)*($cpnv);
                    $cargo_total2 = ($numero_noches)*($cpnv2);
                    $cargo_total3 = ($numero_noches)*($cpnv3);
                    $cargo_total4 = ($numero_noches)*($cpnv4);

                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl8']) / 8 + (($chv98 * $room4_c) / 8) + (($fdv_adult98 * $room4 * $frday) / 8) + (($fdv_child98 * $room4_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl8']) / 8 + (($chv98 * $room4_c) / 16) + (($fdv_adult98 * $room4 * $frday) / 16) + (($fdv_child98 * $room4_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl8']) / 8 + (($chv98 * $room4_c) / 24) + (($fdv_adult98 * $room4 * $frday) / 24) + (($fdv_child98 * $room4_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua8']) / 8 + (($chv98 * $room4_c) / 32) + (($fdv_adult98 * $room4 * $frday) / 32) + (($fdv_child98 * $room4_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                    }
                }


                //TOUR 98 MODERATE



                if ($numNoches['noches'] == 8 && $categor == 3 && $room4 > 0) {
                    
                    $numero_noches = $numNoches['noches'];
                    $cargo_total = ($numero_noches)*($cpnm);
                    $cargo_total2 = ($numero_noches)*($cpnm2);
                    $cargo_total3 = ($numero_noches)*($cpnm3);
                    $cargo_total4 = ($numero_noches)*($cpnm4);
                    

                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm8']) / 8 + (($chm98 * $room4_c) / 8) + (($fdm_adult98 * $room4 * $frday) / 8) + (($fdm_child98 * $room4_c * $frday) / 8) + (($cargo_total)/8) + (($cargo_total2)/8) + (($cargo_total3)/8) + (($cargo_total4)/8);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm8']) / 8 + (($chm98 * $room4_c) / 16) + (($fdm_adult98 * $room4 * $frday) / 16) + (($fdm_child98 * $room4_c * $frday) / 16) + (($cargo_total)/16) + (($cargo_total2)/16) + (($cargo_total3)/16) + (($cargo_total4)/16);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm8']) / 8 + (($chm98 * $room4_c) / 24) + (($fdm_adult98 * $room4 * $frday) / 24) + (($fdm_child98 * $room4_c * $frday) / 24) + (($cargo_total)/24) + (($cargo_total2)/24) + (($cargo_total3)/24) + (($cargo_total4)/24);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam8']) / 8 + (($chm98 * $room4_c) / 32) + (($fdm_adult98 * $room4 * $frday) / 32) + (($fdm_child98 * $room4_c * $frday) / 32) + (($cargo_total)/32) + (($cargo_total2)/32) + (($cargo_total3)/32) + (($cargo_total4)/32);
                    }
                }

                if ($room4 == 0) {

                    $priceRoom4 = 0;
                }
                date_add($fecha4, date_interval_create_from_date_string('1 days'));
                $contador++;
            }
            //$priceRoom4 = (round($priceRoom4) * $room4);
            $priceRoom4 = $priceRoom4 * $room4;
        } else {
            $priceRoom4 = 0;
        }
        //Desayunos
        if ($costohotel ['breakfast'] == 0 || $costohotel ['categoria'] > 2) {
            $priceBreakfast += ($costohotel ['breackfast']);
        } else {
            $priceBreakfast += 0;
        }
        date_add($fecha, date_interval_create_from_date_string('1 days'));
//                echo $costohotel['sgl'];

        if ($free_night_buffet == 1) {

            $totalBreakfast = $priceBreakfast * ($numNoches['noches'] - $nochesfree);
            // $totalBreakfast = $priceBreakfast * ($numNoches['noches']);
            //$totalBreakfast = $priceBreakfast + ($gastoNoche * $nochesfree);
            // $totalBreakfast = $priceBreakfast + ($gastoNoche);
        } else {
            $totalBreakfast = $priceBreakfast * $numNoches['noches'];
        }
        
        
//        echo $totalBreakfast;
//        print_r($priceRoom1);
//        exit;
        //Precios per tipos de habitaciones
        $sgl = (($room1 == 1) ? $priceRoom1 : 0) + (($room2 == 1) ? $priceRoom2 : 0) + (($room3 == 1) ? $priceRoom3 : 0) + (($room4 == 1) ? $priceRoom4 : 0);
        $dbl = (($room1 == 2) ? $priceRoom1 : 0) + (($room2 == 2) ? $priceRoom2 : 0) + (($room3 == 2) ? $priceRoom3 : 0) + (($room4 == 2) ? $priceRoom4 : 0);
        $tpl = (($room1 == 3) ? $priceRoom1 : 0) + (($room2 == 3) ? $priceRoom2 : 0) + (($room3 == 3) ? $priceRoom3 : 0) + (($room4 == 3) ? $priceRoom4 : 0);
        $qua = (($room1 == 4) ? $priceRoom1 : 0) + (($room2 == 4) ? $priceRoom2 : 0) + (($room3 == 4) ? $priceRoom3 : 0) + (($room4 == 4) ? $priceRoom4 : 0);

        $totalhotel = array();
        $totalhotel['priceRoom1'] = $priceRoom1;
        //echo $priceRoom1;
        $totalhotel['priceRoom2'] = $priceRoom2;
        //echo $priceRoom2;
        $totalhotel['priceRoom3'] = $priceRoom3;
        //echo $priceRoom3;
        $totalhotel['priceRoom4'] = $priceRoom4;
        //echo $priceRoom4;
        $totalhotel['sgl'] = $sgl;
        //+ ($chv98*3)
        //echo $totalhotel['sql'];
        echo '<input type="hidden" readonly="readonly" value="' . $sgl . '" name="pricesql" id="pricesql"/>';

        //echo $sgl;
        $totalhotel['dbl'] = $dbl;
        //echo $dbl;
        $totalhotel['tpl'] = $tpl;
        //echo $tpl;
        $totalhotel['qua'] = $qua;
        //echo $qua;
        $totalhotel['priceBreakfast'] = (isset($totalBreakfast)) ? $totalBreakfast : $priceBreakfast;

        $totalhotel['free_night_buffet'] = $free_night_buffet;

        $totalhotel['total'] = $priceRoom1 + $priceRoom2 + $priceRoom3 + $priceRoom4;
        //echo $totalhotel['total'];

        /* echo json_encode($totalhotel);
         *   exit; */
//       print_r($totalhotel);
//       exit;
        return $totalhotel;
    }

    public function agregarPark($id_park, $id_group, $id_agency, $fecha_salida, $fecha_retorno, $platinum, $adult, $child, $admission, $trafic) {

        $totalpax = $child + $adult;
        $url = Doo::conf()->APP_URL;
        Doo::loadModel("Agency");

//        GLOBAL $tarifa1;

        if ($id_agency == -1 || $id_agency == '' || $id_agency == 0) {
            $dat = new Agency();
            $dat->id = -1;
            $dat->type_rate = 9;
        } else {
            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
        }


        //TransporPark
        $parkdatos = $this->transporPark($id_park, $dat, $platinum, $totalpax, $fecha_retorno);

        $atraccion = $_SESSION['tours']['attraction'];


        if (!isset($atraccion [$parkdatos['id_grupo']])) {
            $atraccion[$parkdatos['id_grupo']] = array();
        }
        if (!isset($_SESSION['tours']['atraccion_admision'])) {
            $_SESSION['tours']['atraccion_admision'] = 0;
        }
        if (!isset($_SESSION['tours']['atraccion_transpor'])) {
            $_SESSION['tours']['atraccion_transpor'] = 1;
        }
        $park = array();
        $park['text'] = array("nombre" => $parkdatos['nombre'], "grupo" => $parkdatos['grupo']);
        $park['transpor'] = array("child" => $parkdatos['child'], "adult" => $parkdatos['adult'], "fecha_salida" => $fecha_salida, "fecha_retorno" => $fecha_retorno);
        $park['opciones'] = array("ticket" => $admission, "transpor" => $trafic, "fecha_salida" => $fecha_salida, "fecha_retorno" => $fecha_retorno);
        $park['id_park'] = $id_park;
        $park['fecha_salida'] = $fecha_salida;
        $park['fecha_retorno'] = $fecha_retorno;

        
        
        array_push($atraccion[$parkdatos['id_grupo']], $park);

        $_SESSION['tours']['attraction'] = $atraccion;

        //Fin Transport park
        //Precio de Adminiciones
        $this->ticketPark($dat, $adult, $child, $fecha_retorno);
    }

    public function selectPark() {
        if (isset($this->params["id_park"])) {
            $id_park = $this->params["id_park"];
            $id_group = $this->params["id_group"];
            $id_agency = $this->params["id_agency"];
            $fecha_salida = $this->params["fecha_salida"];
            $fecha_retorno = $this->params["fecha_retorno"];
//            $fecha_parque =  $this->params["fecha_parque"];
            $dato = $this->params['dato'];
            //echo $dato;
            $platinum = $this->params["platinum"];
            $adult = $this->params["adult"];
            $child = $this->params["child"];
            $totalpax = $child + $adult;
            $url = Doo::conf()->APP_URL;
           
           
            
                if (isset($fecha_salida)) {
                    list($mes, $dia, $anyo) = explode("-", $fecha_salida);
                    $fechasali = $anyo . "-" . $mes . "-" . $dia;
                    
                }   
                //capturamos fecha salida en formato unix
                $fec_inicial = strtotime($fechasali);        
                
                
                if (isset($fecha_retorno)) {
                    list($mes, $dia, $anyo) = explode("-", $fecha_retorno);
                    $fecretorno = $anyo . "-" . $mes . "-" . $dia;
                                        
                } 
                //capturamos fecha retorno en formato unix
                $fec_final = strtotime($fecretorno);                          
                
                //capturamos dias y noches del tour
                
                $f0 = strtotime($fechasali);
                $f1 = strtotime($fecretorno);
                $resultado = ($f1 - $f0);
                $resultado = $resultado / 60 / 60 / 24;
                $resultado = round($resultado);
                $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
                $noches = ($resultado + 1 > 0) ? $dias - 1 : '';
                
//                echo $dias;
//                echo "-";
//                echo $noches;
                
                
            Doo::loadModel("Agency");
//            GLOBAL $tarifa1;
            if ($id_agency == -1 || $id_agency == '' || $id_agency == 0) {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 9;
                //echo $type_rate;
            } else {
                $dat = new Agency();
                $dat->id = $id_agency;
                $dat = Doo::db()->find($dat, array('limit' => 1));
            }

            $fecha_enviar = $fecha_retorno;
            list ($mes2, $dia2, $anyo2) = explode("-", $fecha_enviar);
            $fecha_enviar = $anyo2 . "-" . $mes2 . "-" . $dia2;
            //TransporPark
            $parkdatos = $this->transporPark($id_park, $dat, $platinum, $totalpax, $fecha_enviar);

            $atraccion = $_SESSION['tours']['attraction'];
            if (!isset($atraccion [$parkdatos['id_grupo']])) {
                $atraccion[$parkdatos['id_grupo']] = array();
            }
            
            if (!isset($atraccion [$parkdatos['id_park']])) {
                $atraccion[$parkdatos['id_park']] = array();
            }
            
            if (!isset($_SESSION['tours']['atraccion_admision'])) {
                $_SESSION['tours']['atraccion_admision'] = 0;
            }
            if (!isset($_SESSION['tours']['atraccion_transpor'])) {
                $_SESSION['tours']['atraccion_transpor'] = 1;
            }

            $park_noche = 0;
            $park_dia = 0;
            foreach ($atraccion as $id_group => $grupo) {
                if ($id_group == '9') {
                    $park_noche += count($grupo);
                } else {
                    $park_dia += count($grupo);
                }
            }
            if ($parkdatos['id_grupo'] == 9) {
                $park_noche++;
            } else {
                $park_dia++;
            }
            
            
            
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //Buscamos la cantidad de dias y noches del tours
            $numD_N = $this->numDiasNoches($fecha_salida, $fecha_retorno);
            if ($numD_N['dias'] * 2 - $park_dia < 0) {
                echo "<script>
							var msj = '- The passenger only entitled to " . ($numD_N['dias'] * 2) . " day parks ';
							var titulo = 'Parks day';
							mensaje(msj,titulo,'park_name');
						</script>";
            } else if ($numD_N['noches'] - $park_noche < 0) {
                echo "	<script>
							var msj = '- The passenger only entitled to " . $numD_N['noches'] . " night parks ';
							var titulo = 'Parks night';
							mensaje(msj,titulo,'park_name');
						</script>";
            //RESTRICCION A PARQUE VOLCANO BAY PARA TOUR 21////////////////////////////
                
//                else if ($id_park == 31 && $id_group == 6 && $dias == 2 && $noches == 1){
////                echo "Parque no admitido";
//                
//                
//             $this->borrar_park();
//             //echo "<script>  $(document).ready(function () {  setTimeout(function () { delete_park(31);  }, 100); });</script>";
//             echo "<script>  alert('Parque no Admitido en este Tour'); exit; </script>";
//             $this->ticketPark($dat, $adult, $child, $fecha_retorno);
//             $this->calcularValorPark($adult, $child);
//             exit;
//            
//            } 
                
            } else {

                $park = array();
                $park['text'] = array("nombre" => $parkdatos['nombre'], "grupo" => $parkdatos['grupo'], "id_grupo" => $parkdatos['id_grupo'], "id_parque" => $id_park);
                $park['transpor'] = array("child" => $parkdatos['child'], "adult" => $parkdatos['adult'], "fecha_salida" => $fecha_salida, "fecha_retorno" => $fecha_enviar);
                $park['opciones'] = array("ticket" => $_SESSION['tours']['atraccion_admision'], "transpor" => $_SESSION['tours']['atraccion_transpor'], "fecha_salida" => $fecha_salida, "fecha_retorno" => $fecha_enviar);
                $park['id_park'] = $id_park;
                //echo $id_park;
                $park['fecha_salida'] = $fecha_salida;
                $park['fecha_retorno'] = $fecha_enviar;
                array_push($atraccion[$parkdatos['id_grupo']], $park);
                
//                $parkes = array();
//                $park['parques'] = array("id_parque" => $parkdatos['id_parque']);
//                array_push($atraccion[$parkdatos['id_parque']], $park);
                
                
                $_SESSION['tours']['attraction'] = $atraccion;
                echo '<script>
			$("#numPark").val("' . $this->numPark() . '");
                        document.getElementById("add_attraction_list").disabled = true;   
                                                  
                      </script>';
                //Fin Transport park
                //Precio de Adminiciones
                $this->ticketPark($dat, $adult, $child, $fecha_retorno);
                //$this->ticketPark($dat, $adult, $child, $fecha_fin);
                $this->calcularValorPark($adult, $child);

                
            }
//            print_r($_SESSION['tours']['attraction']);
//            exit;
            //Fin Precio de Adminiciones

            $this->tablaPark($adult, $child);
            
            
            //$park['id']= array($park['parques'][0]= $id_park,$park['parques'][1]= $id_park);
//            
            //print_r($park['id']);
            
            //RESTRICCION PARA PARQUES LEGOLAND Y BUSCH GARDENS JUNTOS
            if($dias == 3 && $noches == 2){
                
           
                $atraccion = $_SESSION['tours']['attraction'];

                $numPark = 0;

                foreach ($atraccion as $id_grupo => $grupo) {

                    $numPark += count($grupo);
                    //echo $numPark;

                    foreach ($grupo as $id_park => $park) {

                    $id_parques = trim($park['id_park'].',');


                    $busch_garden = '12';
                    $lego_land = '27';

                    $busqueda = strpos($id_parques, $busch_garden); 
                    $busqueda2 = strpos($id_parques, $lego_land);

                    if ($busqueda === false) {
                        //echo "NO se ha encontrado el id de parque buscado!!!!";
                        $busch = '0';
                    } else {
                        $busch = '1';
                        $buschgarden = (int)$busch;
                        //echo $buschgarden;
                       

                    }                 


                    if ($busqueda2 === false) {
                        //echo "NO se ha encontrado el id de parque buscado!!!!";
                        $lego = '0';
                    } else {
                        $lego = '1';
                        $legoland = (int)$lego;
                        //echo $legoland;                       

                    }  

                    $result = $buschgarden + $legoland;
                    //echo $result;


                   }
                        
                } 
                
                if($result == 2){
                                           
                                             
                        //echo "<script> delete_park('5_0'); alert('Los Parques:\\n[ Busch Garden ] & [ Legoland ]\\nSolo pueden agregarse juntos en un  Tour de:\\n 4 dias y 3 Noches.');exit; </script>";
                        echo "<script> delete_park('16_0'); alert('<<<  1 Day to Busch Gardens  >>> AND <<<  1 Day to Legoland  >>>\\n\\n                                    (Min. 4 Day Tours)');exit; </script>";
                                             
                        $this->borrar_park();  
                        $this->ticketPark($dat, $adult, $child, $fecha_retorno);
                        $this->calcularValorPark($adult, $child);
                        exit;
                }
            
            }
          
        }
        
      
    }

    public function listTablaPark() {
        $adult = $this->params["adult"];
        $child = $this->params["child"];
        $id_agencia = $this->params["id_agency"];
        $dato = $this->params['dato'];

        $this->tablaPark($adult, $child);
        
        $this->calcularValorPark($adult, $child, $id_agencia);
    }

    public function tablaPark($adult, $child) {

        $url = Doo::conf()->APP_URL;
        $atraccion = $_SESSION['tours']['attraction'];



        if ($_SESSION['tours'] ['atraccion_admision'] == 0) {
            $imgAdmisionTodos = 'x02.png';
        } else {
            $imgAdmisionTodos = 'check2.png';
        }
        if ($_SESSION['tours']['atraccion_transpor'] == 0) {
            $imgTrnsporTodos = 'x02.png';
        } else {
            $imgTrnsporTodos = 'check2.png';
        }
        $tabla = ' <table class="grid2" cellspacing="0" cellpadding="0" id="table_7">  
                            <thead>
                                <th>NAME</th>
                                <th>GROUP</th>
                                <!--<th>DATE</th>-->                                
                                <th>TICKET<img src="' . $url . 'global/img/admin/' . $imgAdmisionTodos . '" style="cursor:pointer;" width="20" height="20" id="img_admision_park" />
								<script>
										$("#img_admision_park").click(function (){
											var img = $("#img_admision_park").attr("src");
											var opcion;
											if(img=="' . $url . 'global/img/admin/x02.png"){
												var img2 = "' . $url . 'global/img/admin/check2.png";
												opcion = 1;
											}else{
												var img2 = "' . $url . 'global/img/admin/x02.png"
												opcion = 0;
											}
											$("#img_admision_park").attr("src",img2);
											checker_admision_todos(opcion);
										});
									</script>
								</th>
                                <th>TRANSFER<img src="' . $url . 'global/img/admin/' . $imgTrnsporTodos . '" style="cursor:pointer;" width="20" height="20" id="img_transport_park" />
									<script>
										$("#img_transport_park").click(function (){
											var img = $("#img_transport_park").attr("src");
											var opcion;
											if(img=="' . $url . 'global/img/admin/x02.png"){
												var img2 = "' . $url . 'global/img/admin/check2.png";
												opcion = 1;
											}else{
												var img2 = "' . $url . 'global/img/admin/x02.png"
												opcion = 0;
											}
											$("#img_transport_park").attr("src",img2);
											checker_transport_todos(opcion);
										});
									</script>
								</th>
								<th>ADMISSION PER PARK</th>
                                <th>TRANSPORT</th>                                                               
                                <th>DELETE</th>
                                
                            </thead><tbody>';
        foreach ($atraccion as $id_group => $grupo) {
            foreach ($grupo as $id_park => $park) {
                $text = $park['text'];

                /////valor de transporte local a los parques

                $transpor = $park['transpor'];

                //$fecha_parque = $park['fecha_parque'];
                
                //$fecha_parque =  $this->params["fecha_parque"];
                
                //$fecha = array($fecha_parque);
                //echo $fecha_parque;

                $ticket = $park['ticket'];
                $opciones = $park['opciones'];
                if ($opciones['transpor'] == 1) {
                    $imgTransport = 'check2.png';
                    $checkTransport = 'checked="checked" ';
                } else {
                    $imgTransport = 'x02.png';
                    $checkTransport = '';
                }

                if ($opciones['ticket'] == 1) {
                    $imgAdmision = 'check2.png';
                    $checkAdmision = 'checked="checked" ';
                } else {
                    $imgAdmision = 'x02.png';
                    $checkAdmision = '';
                }
                $tabla .= '<tr class="row0">
                                <td>' . $text['nombre'] . '</td>
                                <td>' . $text['grupo'] . '</td>                        
                                <!--<td>' . $fecha_parque . '</td>-->
                                <td align="center" valign="top" style="padding:0; margin:0;" > 
								<img src="' . $url . 'global/img/admin/' . $imgAdmision . '" style="cursor:pointer;" width="20" height="20" id="img_admision_park_' . $id_group . '_' . $id_park . '" />
								<div>
									<script>
										$("#img_admision_park_' . $id_group . '_' . $id_park . '").click(function (){
											var chek = "chek_admision_park_' . $id_group . '_' . $id_park . '";
											var img = "img_admision_park_' . $id_group . '_' . $id_park . '";
											var id_park = "' . $id_group . '_' . $id_park . '";
											checker_admision(chek,img,id_park);
										});
									</script>
								</div>
								<input  ' . $checkAdmision . '  hidden="true"  type="checkbox" value="0" id="chek_admision_park_' . $id_group . '_' . $id_park . '" ></td>
								<td align="center" valign="top" style="padding:0; margin:0;" > 
								<img src="' . $url . 'global/img/admin/' . $imgTransport . '" style="cursor:pointer;" width="20" height="20" id="img_transport_park_' . $id_group . '_' . $id_park . '" />
								<div>
									<script>
										$("#img_transport_park_' . $id_group . '_' . $id_park . '").click(function (){
											var chek = "chek_transport_park_' . $id_group . '_' . $id_park . '";
											var img = "img_transport_park_' . $id_group . '_' . $id_park . '";
											var id_park = "' . $id_group . '_' . $id_park . '";
											checker_transport(chek,img,id_park);
										});
									</script>
								</div>
								<input ' . $checkTransport . ' hidden="true" type="checkbox" value="0" id="chek_transport_park_' . $id_group . '_' . $id_park . '" >
								</td>
								<td title="Chil: ' . $ticket['child'] . ', Adult: ' . $ticket['adult'] . '"> $ ' . $ticket['adult'] . " / " . $ticket['child']/* number_format((($ticket['child'] * $child) + ($ticket['adult'] * $adult)) / ($adult + $child), 2, '.', ',') */ . '</td>
								<td title="Chil: ' . $transpor['child'] . ', Adult: ' . $transpor['adult'] . '"> $ ' . $transpor['adult'] . " / " . $transpor['child'] /* number_format((($transpor['child'] * $child) + ($transpor['adult'] * $adult)) / ($adult + $child), 2, '.', ',') */ . '</td>                                                                   
                                                                <td align="center" title="Remove from the list the park ' . $text['nombre'] . '">
								<img src="' . $url . 'global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_park_' . $id_group . '_' . $id_park . '" onclick=delete_park("' . $id_group . '_' . $id_park . '"); />                                                                        
								</td>
                                                                
                            </tr>';
            }
        }
        if (empty($atraccion)) {
            for ($i = 0; $i < 3; $i++) {
                $tabla .= '<tr class="row1">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
							';
            }
        }
        $tabla .='</tbody></table>';
        echo $tabla;
//        $adult = $this->params["adult"];
//        
//        $child = $this->params["child"];
//       
    }

/////////////////////////////////////////////////////////////////////////// tarifa de transportes a parques
    public function transporPark($id_park, $dat, $platinum, $totalpax, $fecha = "2014-01-01") {


        $annio = substr($fecha, 0, 4) . '-01-01 00:00:00';

//                Doo::loadModel("Agency");
//                $dat = new Agency();
//                $dat->id = $id_agency;
//                $dat = Doo::db()->find($dat, array('limit' => 1));
//                $type_rate = $dat->type_rate;
//               //echo $type_rate;
//                GLOBAL $tarifa1;
//                $tarifa1 = $type_rate;

        if ($platinum == 0) {
            if ($dat->type_rate == 1) {
                $sql = 'SELECT t1.id, t1.id_grupo, t1.nombre,t2.nombre AS grupo,t3.adult,t3.child
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 2  AND t3.id_agency = ' . $dat->id . '  AND t1.id = ? AND t3.annio = ?';
                $rs = Doo::db()->query($sql, array($id_park, $annio));
                $parkdatos = $rs->fetch();
                if (!($parkdatos['adult'] && $parkdatos['child'])) {
                    $sql = 'SELECT t1.id, t1.id_grupo, t1.nombre,t2.nombre AS grupo,t3.adult,t3.child
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 1 AND t1.id = ? AND t3.annio = ?';
                    $rs = Doo::db()->query($sql, array($id_park, $annio));
                    $parkdatos = $rs->fetch();
                }
            } else {
                $sql = 'SELECT t1.id, t1.id_grupo, t1.nombre,t2.nombre AS grupo,t3.adult,t3.child
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = ' . $dat->type_rate . ' AND t1.id = ? AND t3.annio = ?';
                $rs = Doo::db()->query($sql, array($id_park, $annio));
                $parkdatos = $rs->fetch();
            }
            if ($id_park == 12) {
                $parkdatos['adult'] = 0;
                $parkdatos['child'] = 0;
            }

            if ($id_park == 20) {
                $parkdatos['adult'] = 0;
                $parkdatos['child'] = 0;
            }
        } else {
            if ($dat->type_rate == 1) {
                $sql = 'SELECT t1.id, t1.id_grupo, t1.nombre,t2.nombre AS grupo,t3.amount,t3.price
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasvipgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 2  AND t3.id_agency = ' . $dat->id . '  AND t1.id = ?  AND t3.amount = ? AND t3.annio = ?';
                $rs = Doo::db()->query($sql, array($id_park, $totalpax));
                $parkdatos = $rs->fetch();
                if (!($parkdatos['price'] && $parkdatos['amount'])) {
                    $sql = 'SELECT t1.id, t1.id_grupo, t1.nombre,t2.nombre AS grupo,t3.amount,t3.price
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasvipgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 1 AND t1.id = ? AND t3.amount = ? AND t3.annio = ?';
                    $rs = Doo::db()->query($sql, array($id_park, $totalpax, $annio));
                    $parkdatos = $rs->fetch();
                }
            } else {
                $sql = 'SELECT t1.id, t1.id_grupo, t1.nombre,t2.nombre AS grupo,t3.amount,t3.price
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasvipgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = ' . $dat->type_rate . ' AND t1.id = ? AND t3.amount = ? AND t3.annio = ?';
                $rs = Doo::db()->query($sql, array($id_park, $totalpax, $annio));
                $parkdatos = $rs->fetch();
                $parkdatos['vip'] = true;
            }
            $priceXp = ($parkdatos['price'] / $totalpax);



            if ($id_park == 12 && $platinum == 0) {
                $parkdatos['adult'] = 0;
                $parkdatos['child'] = 0;
            } else {
                $parkdatos['adult'] = $priceXp;
                $parkdatos['child'] = $priceXp;
            }
        }
//        print_r(Doo::db()->showSQL());
//        exit;
        return $parkdatos;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function ticketPark($dat, $adult, $child, $fecha_retorno) {



        $yearact = substr($fecha_retorno, 0, 4);

        $fecha_salida = $this->params["fecha_salida"];
        $fecha_retorno = $this->params["fecha_retorno"];

        $fecha1 = $fecha_salida;
        list ($dia, $mes, $anyo) = explode("-", $fecha1);
        $fecha2 = $mes . "-" . $dia . "-" . $anyo;
        $fecha3 = strtotime($fecha2);
        $fecha_ini = $fecha3;

//        echo '-->Ini' . $fecha_salida;
        ////////////////////////////////////////////////////////
        //$fecha_retorno2 = $this->params["fecha_salida"];
        $fecha4 = $fecha_retorno;
        list ($dia, $mes, $anyo) = explode("-", $fecha4);
        $fecha5 = $mes . "-" . $dia . "-" . $anyo;
        $fecha6 = strtotime($fecha5);
        $fecha_fin = $fecha6;

//        echo '<br />-->Fin' . $fecha_retorno;


        $sql = 'SELECT adults,child,id_parque ,cantidad
						FROM admin_parques_tarifa
						WHERE type_rate = 1 AND id_agency =-1 AND id_grupo = ?  AND cantidad = ? AND fecha_ini <= ? AND fecha_fin >= ?';
        $sql0 = 'SELECT adults,child,id_parque ,cantidad
						FROM admin_parques_tarifa
						WHERE type_rate = 2 AND id_parque = 0 AND id_agency =? AND  id_grupo = ? AND cantidad = ? AND fecha_ini <= ? AND fecha_fin >= ?';
        $atraccion = $_SESSION['tours']['attraction'];
        $parkFree = 0;
        $numPark = 0;
        $totalPark = 0;
        foreach ($atraccion as $id_grupo => $grupo) {
            $cantidad = count($atraccion[$id_grupo]); // parques en el grupo            
            $numPark +=$cantidad;
            //echo $numPark;///cantidad de parques
            foreach ($grupo as $id_park => $park) {
                if ($dat->id != -1) {
                    $rs = Doo::db()->query($sql0, array($dat->id, trim($id_grupo), trim($cantidad), $fecha_ini, $fecha_ini));
                    $consulta = $rs->fetch();


                    if (empty($consulta) || $consulta ['id_parque'] != 0) {
                        $rs = Doo::db()->query($sql, array(trim($id_grupo), trim($cantidad), $fecha_ini, $fecha_ini));
                        $consulta = $rs->fetch();
                        //echo $consulta ['id_parque'];
                        
                    }
                } else {
                    $rs = Doo::db()->query($sql, array(trim($id_grupo), trim($cantidad), $fecha_ini, $fecha_ini));
                    $consulta = $rs->fetch();
                }

                
                
                if (!empty($consulta) && $consulta ['id_parque'] == 0) {

                    $priceChild = $consulta['child'] /* / $cantidad */;
//                    $ninos = $priceChild;
                    $priceAdult = $consulta['adults'] /* / $cantidad */;
//                    $adultos = $priceAdult;
                    $cantidad_consulta = $consulta['cantidad'];


                    $sql2 = 'SELECT  adults,child,id_parque,cantidad,fecha_ini, fecha_fin
								FROM admin_parques_tarifa
								WHERE type_rate = 1 AND id_agency =-1 AND  id_parque = ? AND cantidad = 1 AND fecha_ini <= ? AND fecha_fin >= ?';
                    $sql02 = 'SELECT  adults,child,id_parque,cantidad
								FROM admin_parques_tarifa
								WHERE type_rate = 2 AND id_agency = ? AND  id_parque = ? AND cantidad = 1 AND fecha_fin >= ?';
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql02, array($dat->id, trim($park['id_park']), $fecha_fin));
                        $consulta2 = $rs->fetch();

                        if (empty($consulta2)) {
                            $rs = Doo::db()->query($sql2, array(trim($park['id_park']), $fecha_ini, $fecha_ini));
                            $consulta2 = $rs->fetch();
                        }
                    } else {
                        $rs = Doo::db()->query($sql2, array(trim($park['id_park']), $fecha_ini, $fecha_ini));
                        $consulta2 = $rs->fetch();
                    }
                    $park['ticket'] = array("child" => $consulta2['child'], "adult" => $consulta2['adults'], "precio_varios" => 1, "cantidad" => $cantidad_consulta, "v_p_child" => $priceChild, "v_p_adult" => $priceAdult);

                    if ($consulta['adults'] == 0) {
                        $parkFree ++;
                    }
                } else {
                    $fecha_salida = $this->params["fecha_salida"];
                    $fecha_retorno = $this->params["fecha_retorno"];

                    $fecha1 = $fecha_salida;
                    list ($dia, $mes, $anyo) = explode("-", $fecha1);
                    $fecha2 = $mes . "-" . $dia . "-" . $anyo;
                    $fecha3 = strtotime($fecha2);
                    $fecha_ini = $fecha3;

                    //echo '-->Ini' . $fecha_ini;
                    ////////////////////////////////////////////////////////
                    //$fecha_retorno2 = $this->params["fecha_salida"];
                    $fecha4 = $fecha_retorno;
                    list ($dia, $mes, $anyo) = explode("-", $fecha4);
                    $fecha5 = $mes . "-" . $dia . "-" . $anyo;
                    $fecha6 = strtotime($fecha5);
                    $fecha_fin = $fecha6;

                    $sql2 = 'SELECT  adults,child,id_parque,cantidad, fecha_ini,fecha_fin
								FROM admin_parques_tarifa
								WHERE type_rate = 1 AND id_agency =-1 AND  id_parque = ? AND cantidad = 1 AND fecha_ini <= ? AND fecha_fin >= ?';
                    $sql02 = 'SELECT  adults,child,id_parque,cantidad
								FROM admin_parques_tarifa
                    						WHERE type_rate = 2 AND id_agency = ? AND  id_parque = ? AND cantidad = 1  AND fecha_fin >= ?';





//                        //$atraccion = $_SESSION['tours']['attraction'];
//                    
//                        //AND  id_grupo = '.$id_grupo.'
//                        $fecha_fin = 1468483200;
//                        $id_park = $consulta ['id_parque'];
//                        $id_group = $consulta ['id_grupo'];
//                        //echo $id_group;
//                        //echo $id_park;
//                        
//                        //echo $id_grupo;
//                        //' .$id_grupo. '
//                        //echo $id_park;
//                        //AND  id_parque = ' .$id_park. '
//                        $sql6 = 'SELECT adults,child,id_parque,cantidad
//								FROM admin_parques_tarifa
//								WHERE type_rate = 1 AND id_agency =-1 AND  id_grupo = ' .$id_grupo. '  AND cantidad = ' .$numPark. ' AND fecha_ini <= ' .$fecha_fin. ' AND fecha_fin >= ' .$fecha_fin. ' ';
//                        
//                        $rs6 = Doo::db()->query($sql6);
//                        $precioadm = $rs6->fetchAll();
//                            //print_r($precioadm);      
//                        
//
//                        foreach ($precioadm as $clave => $key) {
//                
//                        //capturamos las admisiones de adultos y ninos
//                        $adm_Ad = $key['adults'];
//                        $adm_Ch = $key['child'];
//
//                        //capturamos el numero de adultos y ninos
//
//                        $grupal = $key['id_grupo'];
//                        $parque = $key['id_parque'];
//                        //$cant = $key['cantidad'];
//
//                        }




                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql02, array($dat->id, trim($park['id_park']), $fecha_ini));
                        $consulta = $rs->fetch();
                        if (empty($consulta)) {

                            //echo '<br />-->' . $fecha_fin;
                            $rs = Doo::db()->query($sql2, array(trim($park['id_park']), $fecha_ini, $fecha_ini));
                            $consulta = $rs->fetch();
//                            $lista =array(
//                                trim($park['id_park']),$fecha_ini ,$fecha_fin
//                            );
//                            echo '<pre>';
//                            print_r($consulta);
//                            echo '</pre>';
//                            exit();
//                            print_r($consulta);
//                            exit();
                        }
                    } else {

                        $rs = Doo::db()->query($sql2, array(
                            trim($park['id_park']), $fecha_ini, $fecha_ini));
                        $consulta = $rs->fetch();
                    }

                    if (!empty($consulta)) {
                        if ($consulta['cantidad'] == 1 && $consulta['id_parque'] != 0) {

                            //retorno de consulta

                            $priceChild = $consulta['child'];
                            //$priceChild = $key['child'];
                            $priceAdult = $consulta['adults'];
                            //$priceAdult = $key['adults'];

                            $park['ticket'] = array("child" => $priceChild, "adult" => $priceAdult);

                            if ($adultos == 0) {
                                $parkFree ++;
                            }
                            // echo $consulta['child']." - ".$consulta['adults']." / ".$cantidad;
                            //print_r($consulta);
                        } else {
                            $park['ticket'] = array("child" => 0, "adult" => 0); //No tiene precios Asginables
                        }
                    } else {
                        $park['ticket'] = array("child" => 0, "adult" => 0); //No tiene precios Asginables(No se agrega)
                    }
                }
                //Calculando el Precio Total atraccion
                if ($park['ticket']['adult'] >= 0) {
                    $priceTotalChild = $park['ticket']['child'] * $child;
                    $priceTotalAdult = $park['ticket']['adult'] * $adult;
                    $totalPark += $priceTotalChild + $priceAdult;
                    //fin Calculando el Precio Totol atraccion
                    $grupo[$id_park] = $park; // Actualizamos datos del park
                } else {
                    echo "<script>
				var msj = '- The park \"" . $park['text']['nombre'] . "\" is not configured for tours';
							var titulo = 'Unconfigured park';
							mensaje(msj,titulo,'park_name');
							$('#park_name').val('');
							</script>";

                    unset($grupo[$id_park]); // borramos el parque por que no esta configurado
                    //Mensaje
                }
            }
            if (empty($grupo)) {
                unset($atraccion[$id_grupo]);
            } else {
                $atraccion[$id_grupo] = $grupo; // Actualizamos datos del grupo
            }
        }
        if ($numPark - $parkFree > 0) {
            $promedio = $totalPark / (($numPark - $parkFree) * ($child + $adult));
        } else {
            $promedio = 0;
        }
        //print_r($atraccion);

        $_SESSION['tours']['attraction'] = $atraccion;
//        print_r($_SESSION['tours']['attraction']);
//        exit;
    }

    public function totalValorPark($adult, $child, $id_agency = -1) {

        
               
        $atraccion = $_SESSION['tours']['attraction'];
        
//        $this->borrar_park();
//        $this->agregarPark($park->id_park, $park->group, $agencia->id, $tours->starting_date, $tours->ending_date, $tours->platinum, $park->adult, $park->child, $park->admission, $park->trafic);
//        $this->ticketPark($dat, $adult, $child, $fecha_retorno);
        
        
        $fecha_salida = $this->params["fecha_salida"];
        $fec_sali = $park['fecha_salida'];   
        //identificador para cuando seleccionamos un parque en frmtours o frmtours_edit
        $idf = $this->params["idf"]; 
        
        //echo $idf;
        
        
        $fecha1 = $fecha_salida;
        //echo '-->'.$fecha1;
        list ($dia, $mes, $anyo) = explode("-", $fecha1);
        $fecha2 = $mes . "-" . $dia . "-" . $anyo;
        $fecha3 = strtotime($fecha2);
        $fecha_ini = $fecha3;
        
        
        $transporLocal = 0;
        $pricePark = 0;
        $grupo_array = array();
        $contador = 0;
        
                    
        foreach ($atraccion as $id_grupo => $grupo) {
            foreach ($grupo as $id_park => $park) {
                $opciones = $park['opciones'];
                $ticket = $park['ticket'];  
//                print_r($ticket);
              
                $fec_sali = $park['fecha_salida']; 
                if (isset($fec_sali)) {
                        list($mes1, $dia1, $anyo1) = explode("-", $fec_sali);
                        $fechasali = $anyo1 . "-" . $mes1 . "-" . $dia1;
                }
                        
                $fec_inicial = strtotime($fechasali);  
                

                
                if ($idf == 'New' || $idf == 'Edit'){
                  
                   $fec_inicial = strtotime($fechasali);  
                   //echo $fec_inicial;
                   
                }
                
                if ($idf == '' && $fec_inicial != ''){
                    
                    
                   //echo $fec_inicial;
                   
                   $fec_inicial = strtotime($fechasali); 
                }
                
                if ($idf == '' && $fec_inicial == ''){
                    
                    
                   //echo $fec_inicial;
                    
                   $fec_inicial = strtotime ( '+1 hour' , strtotime ( $fec_sali ) ) ;
                   //$fec_inicial = strtotime($fechasali); 
                }
                
                

                
                $fecha_retor = $park['fecha_retorno'];
                
                if (isset($fecha_retor)) {
                    list($mes5, $dia5, $anyo5) = explode("-", $fecha_retor);
                    $fecretorno = $mes5 . "-" . $dia5 . "-" . $anyo5;
                    
                } 
                //capturamos fecha retorno en formato unix
                $fec_final = strtotime($fecretorno);                          
                //echo $fec_final;
                //capturamos dias y noches del tour
                
                $f0 = strtotime($fechasali);
                $f1 = strtotime($fecretorno);
                $resultado = ($f1 - $f0);
                $resultado = $resultado / 60 / 60 / 24;
                $resultado = round($resultado);
                $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
                $noches = ($resultado + 1 > 0) ? $dias - 1 : '';
                
//                echo $dias;
//                echo "-";
//                echo $noches;
                
                $yearact = substr($fecha_sal, 0, 4);
                
                //echo $yearact;            
                if ($opciones["ticket"] == 1 && $ticket["precio_varios"] == 1) {
                    $contador++;
                }
            }

            $grupo_array[$id_grupo] = $contador;
            $contador = 0;
        }

   
        if ($id_agency == -1 || $id_agency == '' || $id_agency == 0) {
            $dat = new Agency();
            $dat->id = -1;
            $dat->type_rate = 0;
        } else {
            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
        }
        
  
        $sql = 'SELECT adults,child,id_parque ,cantidad
		FROM admin_parques_tarifa
		WHERE type_rate = 1 AND  id_agency = -1 AND id_grupo = ? AND  cantidad = ?  AND fecha_ini <= ? AND fecha_fin >= ? ';

        ///suministra valor para cantidades >1
        $sql0 = 'SELECT adults,child,id_parque ,cantidad
		FROM admin_parques_tarifa
                WHERE type_rate = 2 AND id_parque = 0 AND id_agency = ? AND  id_grupo = ? AND cantidad = ? AND fecha_ini <= ? AND fecha_fin >= ? ';

//        }
        
        
        
        $price_group_parks = array();        
        //print_r($atraccion);          
        foreach ($atraccion as $id_grupo => $grupo) {  
            foreach ($grupo as $id_park => $park) {                
                $opciones = $park['opciones'];               
                              
                
                $id_parke = $park['id_park'];
                $id_grupal = $id_grupo;
                //print($id_grupal);
                
                //sumatoria para cantidad = 2
                $sql3 = 'SELECT tari_2 AS tarifa FROM parques_restric  WHERE id_parque = ' . $id_parke . ' AND  id_grupo = ' . $id_grupal . ' AND fecha_ini <= ' . $fec_inicial . ' AND fecha_fin >= ' . $fec_inicial . ' AND cantidad = 2';
                $rs3 = Doo::db()->query($sql3);
                $consulta3 = $rs3->fetchAll(); 
                //print_r($consulta3);
                
                foreach ($consulta3 as $key => $tr) {

                    $tarifa_spc = $tr["tarifa"];
                    
                    //print $tarifa_spc;
                    //echo "sum(a) = " . array_sum($a) . "\n";
                    
                    $a = array($tarifa_spc);
                    //almacenamos en $sumatoria los valores de la variable $sumatoria para cada parque
                    $sumatoria += array_sum($a);         
                    //echo($sumatoria);
                   

                }
                
                //sumatoria para cantidad = 3
                
                $sql4 = 'SELECT tari_3 AS tarifa3 FROM parques_restric  WHERE id_parque = ' . $id_parke . ' AND  id_grupo = ' . $id_grupal . ' AND fecha_ini <= ' . $fec_inicial . ' AND fecha_fin >= ' . $fec_inicial . ' AND cantidad = 3';
                $rs4 = Doo::db()->query($sql4);
                $consulta4 = $rs4->fetchAll(); 
                
                foreach ($consulta4 as $key4 => $tr4) {

                    $tarifa_3 = $tr4["tarifa3"];
                    
                    //print $tarifa_spc;
                    //echo "sum(a) = " . array_sum($a) . "\n";
                    
                    $a3 = array($tarifa_3);
                    //almacenamos en $sumatoria los valores de la variable $sumatoria para cada parque
                    $sumatoria3 += array_sum($a3);    
                    //print($sumatoria3);
                   

                }
                
                //sumatoria para cantidad = 4
                
                $sql5 = 'SELECT tari_4 AS tarifa4 FROM parques_restric  WHERE id_parque = ' . $id_parke . ' AND  id_grupo = ' . $id_grupal . ' AND fecha_ini <= ' . $fec_inicial . ' AND fecha_fin >= ' . $fec_inicial . ' AND cantidad = 4';
                $rs5 = Doo::db()->query($sql5);
                $consulta5 = $rs5->fetchAll(); 
                
                foreach ($consulta5 as $key5 => $tr5) {

                    $tarifa_4 = $tr5["tarifa4"];
                    
                    //print $tarifa_spc;
                    //echo "sum(a) = " . array_sum($a) . "\n";
                    
                    $a4 = array($tarifa_4);
                    //almacenamos en $sumatoria los valores de la variable $sumatoria para cada parque
                    $sumatoria4 += array_sum($a4);                 
                   

                }
                
                //sumatoria para cantidad = 5
                
                $sql6 = 'SELECT tari_5 AS tarifa5 FROM parques_restric  WHERE id_parque = ' . $id_parke . ' AND  id_grupo = ' . $id_grupal . ' AND fecha_ini <= ' . $fec_inicial . ' AND fecha_fin >= ' . $fec_inicial . ' AND cantidad = 5';
                $rs6 = Doo::db()->query($sql6);
                $consulta6 = $rs6->fetchAll(); 
                
                foreach ($consulta6 as $key6 => $tr6) {

                    $tarifa_5 = $tr6["tarifa5"];
                    
                    //print $tarifa_spc;
                    //echo "sum(a) = " . array_sum($a) . "\n";
                    
                    $a5 = array($tarifa_5);
                    //almacenamos en $sumatoria los valores de la variable $sumatoria para cada parque
                    $sumatoria5 += array_sum($a5);                 
                   

                }
                
                //sumatoria para cantidad = 6
                
                $sql7 = 'SELECT tari_6 AS tarifa6 FROM parques_restric  WHERE id_parque = ' . $id_parke . ' AND  id_grupo = ' . $id_grupal . ' AND fecha_ini <= ' . $fec_inicial . ' AND fecha_fin >= ' . $fec_inicial . ' AND cantidad = 6';
                $rs7 = Doo::db()->query($sql7);
                $consulta7 = $rs7->fetchAll(); 
                
                foreach ($consulta7 as $key7 => $tr7) {

                    $tarifa_6 = $tr7["tarifa6"];
                    
                    //print $tarifa_spc;
                    //echo "sum(a) = " . array_sum($a) . "\n";
                    
                    $a6 = array($tarifa_6);
                    //almacenamos en $sumatoria los valores de la variable $sumatoria para cada parque
                    $sumatoria6 += array_sum($a6);                 
                   

                }
                
                
                
                if ($grupo_array[$id_grupo] > 0) {
                    $cantidad = $grupo_array[$id_grupo];
                    //print($cantidad);

                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql0, array($dat->id,trim($id_grupo),trim($cantidad),$fec_inicial,$fec_inicial));
                        $consulta = $rs->fetch();

                        if (empty($consulta) || $consulta ['id_parque'] != 0) {

                            
                            
                            $rs = Doo::db()->query($sql, array(trim($id_grupo),trim($cantidad),$fec_inicial,$fec_inicial));

                            $consulta = $rs->fetch();
                            //print_r($consulta);
//                            exit();
                        }
                    } else {
                        


                        $rs = Doo::db()->query($sql, array(trim($id_grupo),trim($cantidad),$fec_inicial,$fec_inicial));

                        $consulta = $rs->fetch();
                        //print_r($consulta);
//                        exit();
                    }
                    if (!empty($consulta) && $consulta ['id_parque'] == 0 && ($sumatoria == 0 || $sumatoria3 == 0 || $sumatoria4 == 0 || $sumatoria5 == 0 || $sumatoria6 == 0) ) {
                        
                       
                        $adult_price = $consulta["adults"];
                        $child_price = $consulta["child"];

//                       print($adult_price);

                        $ticket = array
                            (
                            "child" => $park["ticket"]["child"],
                            "adult" => $park["ticket"]["adult"],
                            "precio_varios" => $park["ticket"]["precio_varios"],
                            "cantidad" => $cantidad,
                            "v_p_child" => $child_price,
                            "v_p_adult" => $adult_price
                        );

                        $park['ticket'] = $ticket;
                        $price_group_parks[$id_grupo] = array("grupo" => $park['text']["grupo"], "cantidad" => $cantidad, "adult_price" => $adult_price, "child_price" => $child_price);

                   
                    } else {
                        $ticket = array
                            (
                            "child" => $park["ticket"]["child"],
                            "adult" => $park["ticket"]["adult"],
                            "precio_varios" => 0,
                            "cantidad" => 0,
                            "v_p_child" => 0,
                            "v_p_adult" => 0
                        );

                        $park['ticket'] = $ticket;
                    }
                }



                $grupo[$id_park] = $park;
                
            }
            //print($sumatoria);

            $atraccion[$id_grupo] = $grupo;
          
        }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        foreach ($atraccion as $id_grupo => $grupo) {
            foreach ($grupo as $id_park => $park) {
                $transpor = $park['transpor'];
                $ticket = $park['ticket'];
                $opciones = $park['opciones'];
                if ($opciones['transpor'] == 1) {

                    $transporLocal += ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                }
                
                ///////////////////////////////////////////////////////////////////////////////////////////////////////
                
                if ($opciones['ticket'] == 1) {
                   
                  if($dias == 2 && $noches == 1){
                    
                        if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo] && $sumatoria == 0) {
                        
                            $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                            $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];
                            //precio por grupo de parques con id_parque = 0


                            $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                        }else {
                            //precio independiente de cada uno de los parques
                            $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                            //echo $ticket["cantidad"];
                        }
                        
//                        $respuesta_html = "";
//                        foreach ($price_group_parks as $values) {
//                            $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
//                        }
                        
                        
                        
                
                  }
                  if($dias == 3 && $noches == 2){
                      
                        if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo] && $sumatoria3 == 0) {
                        
                            $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                            $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];
                            //precio por grupo de parques con id_parque = 0


                            $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                        }else {
                            //precio independiente de cada uno de los parques
                            $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                            //echo $ticket["cantidad"];
                        }
                        
             
                      
                  }
                  
                  
                  if($dias == 4 && $noches == 3){
                      
                        if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo] && $sumatoria4 == 0) {
                        
                            $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                            $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];
                            //precio por grupo de parques con id_parque = 0


                            $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                        }else {
                            //precio independiente de cada uno de los parques
                            $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                            //echo $ticket["cantidad"];
                        }
                        
             
                      
                  }
                  
                  if($dias == 5 && $noches == 4){
                      
                        if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo] && $sumatoria5 == 0) {
                        
                            $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                            $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];
                            //precio por grupo de parques con id_parque = 0


                            $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                        }else {
                            //precio independiente de cada uno de los parques
                            $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                            //echo $ticket["cantidad"];
                        }
                        
             
                      
                  }
                  
                  if($dias == 6 && $noches == 5){
                      
                        if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo] && $sumatoria6 == 0) {
                        
                            $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                            $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];
                            //precio por grupo de parques con id_parque = 0


                            $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                        }else {
                            //precio independiente de cada uno de los parques
                            $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                            //echo $ticket["cantidad"];
                        }
                        
             
                      
                  }
                  
                  if($dias > 6 && $noches > 5){
                      
                        if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo]) {
                        
                            $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                            $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];
                            //precio por grupo de parques con id_parque = 0


                            $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                        }else {
                            //precio independiente de cada uno de los parques
                            $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                            //echo $ticket["cantidad"];
                        }
                        
             
                      
                  }
                  
                  
                  
                    
                }
                                
                /////////////////////////////////////////////////////////////////////////////////////////////////////////                
            }
        
            
        }
        
        
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
        

        if($dias == 2 && $noches == 1 && $sumatoria == 0){
            
            //echo "sumatoria2";
            

                $respuesta_html = "";
                foreach ($price_group_parks as $values) {
                    $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                }
            
        }
    
        if($dias == 3 && $noches == 2 && $sumatoria3 == 0){
            
            //echo "sumatoria3";            

                $respuesta_html = "";
                foreach ($price_group_parks as $values) {
                    $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                }

            
        }
       
        if($dias == 4 && $noches == 3 && $sumatoria4 == 0){
            
            //echo "sumatoria4";   
                $respuesta_html = "";
                foreach ($price_group_parks as $values) {
                    $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                }
            
            
        }
       
        if($dias == 5 && $noches == 4 && $sumatoria5 == 0){

            //echo "sumatoria5"; 
            
                $respuesta_html = "";
                foreach ($price_group_parks as $values) {
                    $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                }
            

        }
        
        if($dias == 6 && $noches == 5 && $sumatoria6 == 0){
            
            //echo "sumatoria6"; 
            
                $respuesta_html = "";
                foreach ($price_group_parks as $values) {
                    $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                }
            
            
        }
        
        if($dias > 6 && $noches > 5){
            
            //echo "sumatoria6"; 
            
                $respuesta_html = "";
                foreach ($price_group_parks as $values) {
                    $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                }
            
            
        }

        
        
        $total = array();
        $total['admision'] = $pricePark;
        $total['transporLocal'] = $transporLocal;
        $total["respuesta_html"] = $respuesta_html;
        $_SESSION['tours']["mensaje_html"] = $respuesta_html;
        //print_r($pricePark);
        //print_r($total); 
//        exit;
//        print_r(Doo::db()->showSQL());
//        exit;
        return $total;
    }

    //**************************************************/////////////////
    
    
    
    
    //*************************************************/////////////////
    public function calcularValorPark($adult, $child, $id_agency = -1) {
        $total = $this->totalValorPark($adult, $child, $id_agency);
        $pricePark = $total['admision'];
        ///////////////traer valores de la tabla attraction_trafic
        //valor total de las admisiones a los parques
        //$pricePark = 435;
        ////////////////////////////////////////////////////////////////////////////
        $transporLocal = $total['transporLocal'];
        $respuesta_html = $total["respuesta_html"];
        echo '<script>
				$("#totalpriceAdmision").html("' . $pricePark . '");
				$("#totalpriceTransporLocal").html("' . $transporLocal . '");
				$("#info_html").html("' . $respuesta_html . '");
				calcularTotalPago();
		</script>';
    }
    
    public function calcularValorPark1($adult, $child, $id_agency = -1) {
        $total = $this->totalValorPark1($adult, $child, $id_agency);
        $pricePark = $total['admision'];
        ///////////////traer valores de la tabla attraction_trafic
        //valor total de las admisiones a los parques
        //$pricePark = 435;
        ////////////////////////////////////////////////////////////////////////////
        $transporLocal = $total['transporLocal'];
        $respuesta_html = $total["respuesta_html"];
        echo '<script>
				$("#totalpriceAdmision").html("' . $pricePark . '");
				$("#totalpriceTransporLocal").html("' . $transporLocal . '");
				$("#info_html").html("' . $respuesta_html . '");
				calcularTotalPago();
		</script>';
    }

    public function gestionAdminision() {
        if (isset($this->params["id_park"]) && isset($this->params["opcion"])) {
            $adult = $this->params["adult"];
            $child = $this->params["child"];
            $opcion = $this->params["opcion"];
            $id_agency = $this->params["id_agency"];
            if ($this->params['id_park'] != 'a') {
                $car = explode("_", $this->params["id_park"]);
                $id = $car[1];
                $id_g = $car[0];
            } else {
                $id = $this->params['id_park'];
            }
            $atraccion = $_SESSION['tours']['attraction'];

            if ($id != 'a') {
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $opciones = $park['opciones'];
                        if ($id_park == $id && $id_grupo == $id_g) {
                            $opciones['ticket'] = $opcion;
                        }
                        $park['opciones'] = $opciones;
                        $grupo[$id_park] = $park;
                    }
                    $atraccion[$id_grupo] = $grupo;
                }
            } else {

                $url = Doo::conf()->APP_URL;
                if ($opcion == 1) {
                    $ruta = $url . 'global/img/admin/check2.png';
                    $checked = 'true';
                } else {
                    $ruta = $url . 'global/img/admin/x02.png';
                    $checked = 'false';
                }
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $opciones = $park['opciones'];
                        $opciones['ticket'] = $opcion;
                        $park['opciones'] = $opciones;
                        $grupo[$id_park] = $park;
                        echo '<script>
					var img = "img_admision_park_' . $id_grupo . '_' . $id_park . '";
					var check = "chek_admision_park_' . $id_grupo . '_' . $id_park . '";
					$("#"+check).attr("checked",' . $checked . ');
					$("#"+img).attr("src","' . $ruta . '");
						  $("#"+img).show("blind", { direction: "vertical" }, 300);
						  </script>';
                    }
                    $atraccion[$id_grupo] = $grupo;
                }
            }
            $_SESSION['tours']['attraction'] = $atraccion;

           

            $this->calcularValorPark($adult, $child, $id_agency);
        }
    }

    public function change_pax_attractions() {
        $adults = $this->params["adults"];
        $childs = $this->params["childs"];
        $id_agency = $this->params["id_agency"];
        $this->calcularValorPark($adults, $childs, $id_agency);
    }

    public function gestionTransportLocal() {
        if (isset($this->params["id_park"]) && isset($this->params["opcion"])) {
            $adult = $this->params["adult"];
            $child = $this->params["child"];
            if ($this->params['id_park'] != 'a') {
                $car = explode("_", $this->params["id_park"]);
                $id = $car[1];
                $id_g = $car[0];
            } else {
                $id = $this->params['id_park'];
            }
            $opcion = $this->params["opcion"];
            $atraccion = $_SESSION['tours']['attraction'];
            if ($id != 'a') {
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $opciones = $park['opciones'];
                        if ($id_park == $id && $id_grupo == $id_g) {
                            $opciones['transpor'] = $opcion;
                        }
                        $park['opciones'] = $opciones;
                        $grupo[$id_park] = $park;
                    }
                    $atraccion[$id_grupo] = $grupo;
                }
            } else {
                $url = Doo::conf()->APP_URL;
                if ($opcion == 1) {
                    $ruta = $url . 'global/img/admin/check2.png';
                    $checked = 'true';
                } else {
                    $ruta = $url . 'global/img/admin/x02.png';
                    $checked = 'false';
                }
                foreach ($atraccion as $id_grupo => $grupo) {
                    foreach ($grupo as $id_park => $park) {
                        $opciones = $park['opciones'];
                        $opciones['transpor'] = $opcion;
                        $park['opciones'] = $opciones;
                        $grupo[$id_park] = $park;
                        echo '<script>
							var img = "img_transport_park_' . $id_grupo . '_' . $id_park . '";
							var check = "chek_transport_park_' . $id_grupo . '_' . $id_park . '";
							$("#"+check).attr("checked",' . $checked . ');
							$("#"+img).attr("src","' . $ruta . '");
							$("#"+img).show("blind", { direction: "vertical" }, 300);
							</script>';
                    }
                    $atraccion[$id_grupo] = $grupo;
                }
            }
            $_SESSION['tours']['attraction'] = $atraccion;
            $this->calcularValorPark($adult, $child);
        }
    }

    public function numDiasNoches($fecha_salida, $fecha_retorno) {

//        GLOBAL $fechaced;

        list ($mes, $dia, $anyo) = explode("-", $fecha_salida);

        $llegada = $anyo . "-" . $mes . "-" . $dia;

        if (isset($fecha_retorno)) {
            list ($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
            $salida = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }

        $f0 = strtotime($llegada);
        $f1 = strtotime($salida);
        $resultado = ($f1 - $f0);
        $resultado = $resultado / 60 / 60 / 24;
        $resultado = round($resultado);
        $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
        $noches = ($resultado + 1 > 0) ? $dias - 1 : '';

        return array("dias" => $dias, "noches" => $noches);
        ///////////////////////////////////////////////////////
    }

    public function numDiasNochesFechaok($llegada, $salida) {

        $f0 = strtotime($llegada);
        $f1 = strtotime($salida);
        $resultado = ($f1 - $f0);
        $resultado = $resultado / 60 / 60 / 24;
        $resultado = round($resultado);
        $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
        $noches = ($resultado + 1 > 0) ? $dias - 1 : '';
        //echo $noches;
        return array("dias" => $dias, "noches" => $noches);
    }

    public function borrar_park() {
        if (isset($this->params["id_park"])) {
            $adult = $this->params["adult"];
            $child = $this->params["child"];
            $id = $this->params["id_park"];
            list($gid, $id) = explode('_', $id);
            $atraccion = $_SESSION['tours']['attraction'];
            foreach ($atraccion as $id_grupo => $grupo) {
                $i = 0;
                if ($id_grupo == $gid) {
                    foreach ($grupo as $id_park => $park) {
                        if ($id_park == $id) {
                            unset($grupo[$id_park]); // borro el parque del grupo
                        }
                        $i += 1;
                        $atraccion[$id_grupo] = $grupo;
                    }
                }
                if (empty($grupo)) {// si el grupo no tiene parque lo elimino
                    unset($atraccion[$id_grupo]);
                } else {
                    $atraccion[$id_grupo] = $grupo;
                }
            }
            $_SESSION['tours']['attraction'] = $atraccion;
            $parks = $this->tablaPark($adult, $child);
            $this->calcularValorPark($adult, $child);
            echo '<script>
                           var vacio = "";
			   $("#numPark").val("' . $this->numPark() . '");
		           $("#table_7").children("tbody").html(' . $parks . ');
                           $("#park_name").val(vacio);
                           document.getElementById("add_attraction_list").disabled = true;
                           
			</script>';
        }
    }

    public function numPark() {
        $atraccion = $_SESSION['tours']['attraction'];
        $numPark = 0;
        foreach ($atraccion as $id_grupo => $grupo) {
            $numPark += count($grupo);
        }
        return $numPark;
    }

    public function pagoWeb() {
        extract($_POST, EXTR_SKIP);
        do {
            $mes = date("m");
            $dia = date("d");
            $y = date("y");
            $_SESSION['codconf'] = "TM" . $mes . $y . $dia . rand(0, 9999);
            $a = $this->db()->find('Tours', array('where' => 'code_conf = ?',
                'limit' => 1,
                'select' => 'code_conf',
                'param' => array($_SESSION['codconf'])
            ));
        } while ($a != null);
        // Consultando agencias
        Doo::loadModel("Agency");
//        GLOBAL $tarifa1;
        if (isset($id_agency) && $id_agency != -1) {
            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
        } else {
            $dat = new Agency();
            $dat->id = -1;
            $dat->type_rate = 0;
        }
        // Fin consultando Agecia
        //Consultando Cliente
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $idCliente;
        $cliente = Doo::db()->find($cliente, array('limit' => 1));
        //Fin Consultando Cliente
        $op = $this->types_payments();

        //Transporte del tours
        Doo::loadModel("Reserve");
        Doo::loadModel("Transfer");
        $totalPax = $child + $adult;
        //Transfer In
        $totalTransferIn = 0;
        if (isset($opcion_transfer_in)) {
            if ($a_type != 0) {
                $tranferIn = new Transfer();
                $tranferIn->total_pax = $totalPax;
                $tranferIn->arrival_time = $hora1;
                $tranferIn->type = $a_type + 1;
                if ($a_type == 1) {
                    $price = -1;
                    $tranferIn->type_transfer = 'VIP';
                    $tranferIn->city = $city;
                    $tranferIn->address = $address;
                    $tranferIn->zipcode = $zipcode;
                    $tranferIn->phone = $phone;
                    if ($dat->id == -1) {
                        $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                        $rs = Doo::db()->query($sql, array($totalPax));
                        $pricesvip = $rs->fetch();
                    } else {
                        $sql = 'SELECT id,cantidad,price,id_agency FROM tarifasvip WHERE cantidad = ? AND id_agency = ?';
                        $rs = Doo::db()->query($sql, array($totalPax, $dat->id));
                        $pricesvip = $rs->fetch();
                        if (empty($pricesvip)) {
                            $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                            $rs = Doo::db()->query($sql, array($totalPax));
                            $pricesvip = $rs->fetch();
                        }
                    }
                    if (!empty($pricesvip)) {
                        $price = number_format($pricesvip ['price'], 2, '.', '');
                    }
                    $tranferIn->total_price = $price;
                } else if ($a_type == 2) {
                    $price = -1;
                    $tranferIn->airlie = $airlinearrival;
                    $tranferIn->flight = $flightarrival;
                    $tranferIn->type_transfer = 'PLANE';
                    if ($dat->id == -1) {
                        $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                        $rs = Doo::db()->query($sql, array($totalPax));
                        $pricesbyplane = $rs->fetch();
                    } else {
                        $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND id_agency = ?';
                        $rs = Doo::db()->query($sql, array($totalPax, $dat->id));
                        $pricesbyplane = $rs->fetch();
                        if (empty($pricesbyplane)) {
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                            $rs = Doo::db()->query($sql, array($totalPax));
                            $pricesbyplane = $rs->fetch();
                        }
                    }
                    if (!empty($pricesbyplane)) {
                        $price = number_format($pricesbyplane ['price'], 2, '.', '');
                    }
                    $tranferIn->total_price = $price;
                } else if ($a_type == 3) {
                    $price = -1;
                    $tranferIn->type_transfer = 'CAR';
                    if ($dat->id == -1) {
                        $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = -1';
                        $rs = Doo::db()->query($sql);
                        $pricescar = $rs->fetch();
                    } else {
                        $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ?';
                        $rs = Doo::db()->query($sql, array($dat->id));
                        $pricescar = $rs->fetch();
                        if (empty($pricescar)) {
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = -1';
                            $rs = Doo::db()->query($sql);
                            $pricescar = $rs->fetch();
                        }
                    }

                    if (!empty($pricescar)) {
                        $price = number_format($pricescar ['price'], 2, '.', '');
                    }
                    $tranferIn->total_price = $price;
                }
                $totalTransferIn = $tranferIn->total_price;
            }
        }
        // FIN Transfer In
        //Transfer Out
        $totalTransferOut = 0;
        if (isset($opcion_transfer_out)) {
            if ($d_type != 0) {
                $tranferOut = new Transfer();
                $tranferOut->total_pax = $totalPax;
                $tranferOut->arrival_time = $hora2;
                $tranferOut->type = $d_type + 1;
                if ($d_type == 1) {
                    $price = -1;
                    $tranferOut->type_transfer = 'VIP';
                    $tranferOut->city = $city2;
                    $tranferOut->address = $address2;
                    $tranferOut->zipcode = $zipcode2;
                    $tranferOut->phone = $phone2;
                    if ($dat->id == -1) {
                        $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                        $rs = Doo::db()->query($sql, array($totalPax));
                        $pricesvip = $rs->fetch();
                    } else {
                        $sql = 'SELECT id,cantidad,price,id_agency FROM tarifasvip WHERE cantidad = ? AND id_agency = ?';
                        $rs = Doo::db()->query($sql, array($totalPax, $dat->id));
                        $pricesvip = $rs->fetch();
                        if (empty($pricesvip)) {
                            $sql = 'SELECT id,cantidad,price FROM tarifasvip WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                            $rs = Doo::db()->query($sql, array($totalPax));
                            $pricesvip = $rs->fetch();
                        }
                    }
                    if (!empty($pricesvip)) {
                        $price = number_format($pricesvip ['price'], 2, '.', '');
                    }
                    $tranferOut->total_price = $price;
                } else if ($d_type == 2) {
                    $price = -1;
                    $tranferOut->airlie = $airlinedeparture;
                    $tranferOut->flight = $flightdeparture;
                    $tranferOut->type_transfer = 'PLANE';
                    if ($dat->id == -1) {
                        $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                        $rs = Doo::db()->query($sql, array($totalPax));
                        $pricesbyplane = $rs->fetch();
                    } else {
                        $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND id_agency = ?';
                        $rs = Doo::db()->query($sql, array($totalPax, $dat->id));
                        $pricesbyplane = $rs->fetch();
                        if (empty($pricesbyplane)) {
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = -1';
                            $rs = Doo::db()->query($sql, array($totalPax));
                            $pricesbyplane = $rs->fetch();
                        }
                    }
                    if (!empty($pricesbyplane)) {
                        $price = number_format($pricesbyplane ['price'], 2, '.', '');
                    }
                    $tranferOut->total_price = $price;
                } else if ($d_type == 3) {
                    $price = -1;
                    $tranferOut->type_transfer = 'CAR';
                    if ($dat->id == -1) {
                        $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = -1';
                        $rs = Doo::db()->query($sql);
                        $pricescar = $rs->fetch();
                    } else {
                        $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ?';
                        $rs = Doo::db()->query($sql, array($dat->id));
                        $pricescar = $rs->fetch();
                        if (empty($pricescar)) {
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = -1';
                            $rs = Doo::db()->query($sql);
                            $pricescar = $rs->fetch();
                        }
                    }

                    if (!empty($pricescar)) {
                        $price = number_format($pricescar ['price'], 2, '.', '');
                    }
                    $tranferOut->total_price = $price;
                }
                $totalTransferOut = $tranferOut->total_price;
            }
        }
        //FIN Transfer Out
        //Fechas
        if (isset($fecha_salida) && $fecha_salida != '') {
            list($mes, $dia, $anio) = explode('-', $fecha_salida);
            $fecha_salida = $anio . '-' . $mes . '-' . $dia;
        } else {
            $fecha_salida = 'N/A';
        }
        if (isset($fecha_retorno)) {
            $values = explode('-', $fecha_retorno);
            if (count($values) == 3) {
                list($mes, $dia, $anio) = explode('-', $fecha_retorno);
                $fecha_retorno = $anio . '-' . $mes . '-' . $dia;
            } else {
                $fecha_retorno = 'N/A';
            }
        } else {
            $fecha_retorno = 'N/A';
        }
        //FIn fechas
        //tipo pago
        $arval = array_values($op[$opcion_pago]);
        $arkey = array_keys($op[$opcion_pago]);
        //fin tipo Pago
        // RESERVA
        $totalReserva = 0;
        if (( $a_type == 0 && isset($opcion_transfer_in) ) || ($d_type == 0 && isset($opcion_transfer_out))) {
            if (isset($ext_from1)) {
                $precio_e1 = $this->precio_extencion($ext_from1, $dat->type_rate);
            } else {
                $precio_e1 = 0;
                $ext_from1 = 0;
            }
            if (isset($ext_to2)) {
                $precio_e4 = $this->precio_extencion($ext_to2, $dat->type_rate);
            } else {
                $precio_e4 = 0;
                $ext_to2 = 0;
            }
            $trip1a = (isset($trip1a) ? ($adult * $trip1a) : 0);
            $trip1c = (isset($trip1c) ? ($child * $trip1c) : 0);
            $trip2a = (isset($trip2a) ? ($adult * $trip2a) : 0);
            $trip2c = (isset($trip2c) ? ($child * $trip2c) : 0);
            $precioA = $trip1a + $trip2a + (($precio_e1 + $precio_e4) * $adult);
            $precioN = $trip1c + $trip2c + (($precio_e1 + $precio_e4) * $child);

            $total = $precioA + $precioN;
            $totalReserva = $total;
        }
        // FIN RESERVA
        //Hotel reserva
        $totalHotel = 0;
        if (isset($opcion_hotel) && $nhoteles <= 1) {
            Doo::loadModel("Hotel_Reserves");
            $hotel = new Hotel_Reserves();
            $hotel->id_hotel = $hotel_id_select_0;
            $hotel->category = $hotel_category_0;
            $hotel->days = $days;
            $hotel->nights = $nights;
            $hotel->id_cliente = $cliente->id;
            $hotel->type_client = $cliente->tipo_client;
            $hotel->id_agencia = $dat->id;
            $hotel->roooms = $select_rooms;
            $hotel->adult = $adult;
            $hotel->child = $child;
            $hotel->total_persons = $totalPax;
            $hotel->room1_adult = (isset($adult1) ? $adult1 : 0);
            $hotel->room2_adult = (isset($adult2) ? $adult2 : 0);
            $hotel->room3_adult = (isset($adult3) ? $adult3 : 0);
            $hotel->room4_adult = (isset($adult4) ? $adult4 : 0);
            $hotel->room1_child = (isset($child1) ? $child1 : 0);
            $hotel->room2_child = (isset($child2) ? $child2 : 0);
            $hotel->room3_child = (isset($child3) ? $child3 : 0);
            $hotel->room4_child = (isset($child4) ? $child4 : 0);
            $hotel->type = 0;
            $hotel->additional_night = 0;
            $hotel->free_night = $hotel_nochesfree_0;

            //Costo hotel
            $nochesPagas = $nights - $hotel_nochesfree_0;

            if ($nochesPagas == 0) {
                $hotel->nightprice = 0;
                $hotel->totalnights = 0;
                $hotel->breakfastprice = 0;
                $hotel->totalbreakfasts = 0;
            } else {

                $costoHotel = $this->costoHotel($fecha_salida, $fecha_retorno, $hotel_id_select_0, $hotel->room1_adult, $hotel->room2_adult, $hotel->room3_adult, $hotel->room4_adult, $hotel_nochesfree_0, $hotel_nochesfree_buffet_0, $dat->type_rate, $noches_escogidas);

                $hotel->nightprice = $costoHotel['total'] / ($nochesPagas);
                $hotel->totalnights = $costoHotel['total'];
                if ($hotel_buffet_0 == 1) {
                    $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                    $hotel->totalbreakfasts = $costoHotel['priceBreakfast'];
                } else {
                    $hotel->breakfastprice = 0;
                    $hotel->totalbreakfasts = 0;
                }
            }
            $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
            $totalHotel = $hotel->total_paid;
        } else if ($nhoteles > 1) {
            $totalHotel = 0;
            $id = $slugfield;
            $rs = Doo::db()->query('select * from hotel_reserves where id_tours = ?', array($id));
            $hoteles = $rs->fetchAll();
            $i = 0;
            foreach ($hoteles as $dato) {
                $query = Doo::db()->query('select * from hoteles where id = ? limit 1', array($dato['id_hotel']));
                $rs = $query->fetchAll();
                $hotel = $rs[0];
                $tipos = $this->tipoHabitacion($dato['room1_adult'], $dato['room2_adult'], $dato['room3_adult'], $dato['room4_adult']);
                $sgl = $tipos['sgl'];
                $dbl = $tipos['dbl'];
                $tpl = $tipos['tpl'];
                $qua = $tipos['qua'];
                if ($hotel['breakfast'] == 1) {
                    $breakfastdato = "FREE BREAKFAST ";
                } else {
                    $breakfastdato = "NOT BREAKFAST ";
                }
                if ($dato['buffet'] == 1) {
                    $breakfastdato = "SUPER BREKFAST BUFFET";
                }
                $nochesPagas = $dato['nights'] - $dato['free_night'];


                $costohotel = $this->costoHotel($dato['starting_date'], $dato['ending_date'], $dato['id_hotel'], $dato['room1_adult'], $dato['room2_adult'], $dato['room3_adult'], $dato['room4_adult'], $dato['free_night'], $dato['free_night_buffet'], $dato['type'], $dato['totalnights']);
                $nightprice = $costohotel['total'] / ($nochesPagas);
                $totalnights = $costohotel['total'];
                if ($dato['buffet'] == 1) {
                    $breakfastprice = $costohotel['priceBreakfast'];
                    $totalbreakfasts = $costohotel['priceBreakfast'];
                } else {
                    $breakfastprice = 0;
                    $totalbreakfasts = 0;
                }
                $totalHotel += $totalnights + $totalbreakfasts;

                //aqui aqui aqui
            }
        }
        //FIN Hotel reserva
        //TRAFFIC TOURS
        $atracciones = array();
        $totalAtraccion = 0;
        if (isset($opcion_traffic)) {
            Doo::loadModel("Attraction_Trafic");
            $atraccion = $_SESSION['tours']['attraction'];
            foreach ($atraccion as $id_grupo => $grupo) {
                foreach ($grupo as $id_park => $park) {
                    $transpor = $park['transpor'];
                    $ticket = $park['ticket'];
                    $opciones = $park['opciones'];
                    $attraction = new Attraction_Trafic();
                    $attraction->admission = $opciones['ticket'];
                    $attraction->id_tours;
                    $attraction->type_tour = 'MULTI';
                    $attraction->adult = $adult;
                    $attraction->child = $child;
                    $attraction->group = $id_grupo;
                    $attraction->id_agencia = $dat->id;
                    $attraction->id_cliente = $cliente->id;
                    $attraction->id_park = $id_park;
                    $attraction->trafic = $opciones['transpor'];
                    $attraction->total_person = $totalPax;
                    if ($attraction->admission == 1) {
                        $attraction->admission_child = $ticket ['child'] * $child;
                        $attraction->admission_adtul = $ticket ['adult'] * $adult;
                    } else {
                        $attraction->admission_child = 0;
                        $attraction->admission_adtul = 0;
                    }
                    if ($opciones['transpor'] == 1) {
                        $attraction->totalTraspor = ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                    } else {
                        $attraction->totalTraspor = 0;
                    }
                    $attraction->totalAdmission = $attraction->admission_child + $attraction->admission_adtul;
                    $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;
                    $totalAtraccion += $attraction->total_paid;
                }
            }
        }
        // FIN TRAFFIC TOURS	

        $total = $totalHotel + $totalAtraccion + $totalReserva + $totalTransferIn + $totalTransferOut;
        $extra = ($extra == '') ? 0 : $extra;
        $total = $total + $extra;
        $_SESSION['tours_pago'] = '...';
        Doo::loadModel("Tours");
        if (isset($_SESSION['tours_edit'])) {
            $t_anterior = new Tours($_SESSION['tours_edit']);
            $pagado = $this->pagado($t_anterior->id);
        } else {
            $pagado = 0;
        }
        if (is_numeric($otheramount) && $otheramount > 0) {
            $apagar = $otheramount - $pagado;
        } else {
            $apagar = $total - $pagado;
        }
        $this->data['apagar'] = $apagar;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['usuario'] = $cliente;
        $this->view()->renderc('admin/configuracion/pago_tours', $this->data);
        return Doo::conf()->APP_URL . "admin/tours";
    }

    public function estado_pago() {
        if (isset($_SESSION['tours_pago']) && $_SESSION['tours_pago'] == 'ok') {
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
				</script>";
        } else if (isset($_SESSION['tours_pago']) && $_SESSION['tours_pago'] == '...') {
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
        } else if (isset($_SESSION['tours_pago']) && $_SESSION['tours_pago'] == 'no') {
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
            $_SESSION['tours_pago'] = 'ok';
            $data['rootUrl'] = Doo::conf()->APP_URL;
            $this->view()->renderc('admin/configuracion/approval_pago', $data);
        } else {
            unset($_SESSION['codconf']);
            unset($_SESSION['tours_pago']);
            return Doo::conf()->APP_URL . "transaction/admin/reserva/decline/";
        }
    }

    public function response_decline() {
        $_SESSION['tours_pago'] = 'no';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('admin/configuracion/decline', $data);
    }

    public function rastro_tours($tipo_cambio, $t_anterior, $t_nuevo, $login) {
//        
        $hotel_id = $_POST['hotel_id'];
//        echo '>>'. $hotel_id;
//        Doo::loadModel("Hotel_Reserves");
//        $hotel = new Hotel_Reserves();
//
//        foreach ($_SESSION['tours']['hoteles_n'] as $datos_hotel) {
//
//
//        $hotel->hotel_name = $datos_hotel["nombre"];
//        $hotel->id_hotel = $datos_hotel["id"];
//        $hotel->creation_date = date("Y-m-d H:i");
//        $hotel->starting_date = $datos_hotel["starting_date"];
//        $hotel->ending_date = $datos_hotel["ending_date"];
//
//        $costoHotel = $this->costoHotel($datos_hotel["starting_date"], $datos_hotel["ending_date"], $datos_hotel["id"], $hotel->room1_adult, $hotel->room2_adult, $hotel->room3_adult, $hotel->room4_adult, $hotel->free_night, $datos_hotel["free_night_buffet"], $dat->type_rate);
//
//        $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
//
//        }
        // $id_hotel = $this->params["rates"];
        //$fecha_salida = $this->params["fecha_salida"];
        //$fecha_retorno = $this->params["fecha_retorno"];

        Doo::loadModel("Tours_Rastro");
        $rastro = new Tours_Rastro();
        $array_nuevo = (array) $t_nuevo;
        $id_tours = $array_nuevo['id'];
        unset($array_nuevo['_table']);
        unset($array_nuevo['_primarykey']);
        unset($array_nuevo['_fields']);
        if ($t_anterior == NULL) {
            $cambios = $array_nuevo;
        } else {
            $array_anterior = (array) $t_anterior;
            unset($array_anterior['_table']);
            unset($array_anterior['_primarykey']);
            unset($array_anterior['_fields']);
            $cambios = $this->buscarCambios($array_anterior, $array_nuevo);
        }
        if ($t_nuevo->paid > 0 || !empty($cambios)) {
            $rastro->id_tours = $id_tours;
            $rastro->tipo_cambio = $tipo_cambio;
            $rastro->detalles = $this->cadena_array($cambios); // Ojo falta adecuar para mostrar cambios por separado
            $rastro->fecha = date('Y-m-d H:i:s');
            $rastro->usuario = $login->id;
            $rastro->tipo_usuario = $login->tipo;
            $rastro->id_hotel = $hotel_id;

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

    public function registrar_pago($tours, $t_anterior, $login, $amount, $tipoP_2, $formaP_2) {
        //Tours_Pago
        Doo::loadModel("Tours_Pago");
//        GLOBAL $tarifa1;
        //$tours->id = $id_tours;
        $pagor_t = new Tours_Pago();
        $pagor_t->id_tours = $tours->id;
        $pagor_t->pago = $formaP_2;
        $pagor_t->tipo_pago = $tipoP_2;
        $pagor_t->tipo = "MULTI";
        $pagor_t->pagado = $amount; /* ($tours->otheramount == 0) ? $tours->totalouta : $tours->otheramount; */
        $pagor_t->usuario = $login->id;
        $pagor_t->fecha = date('Y-m-d H:s');
        Doo::loadModel("Agency");
        if ($tours->id_agency != -1) {
            $dat = new Agency();
            $dat->id = $tours->id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
        } else {
            $dat = new Agency();
            $dat->id = -1;
            $dat->type_rate = 0;
        }
        if ($t_anterior == NULL) {
            Doo::db()->insert($pagor_t);
//            //CREDITO
//            if($pagor_t->tipo_pago  == 'VOUCHER'){// Actualizamos el credio
//                $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0","param" => array($dat->id),"limit" => 1));
//                if(!empty($creditos)){
//                    $creditos->disponible = ($creditos->disponible - $tours->total);
//                    Doo::db()->update($creditos);
//                }
//            }
        } else {
            $sql = "SELECT `id`, `id_tours`, `pago`, `tipo_pago`, `pagado`, `usuario`, `fecha` 
						FROM `tours_pago` 
						WHERE  id_tours = ?
                                                AND tipo = 'MULTI'
						ORDER BY  `id` DESC ";
            $rs = Doo::db()->query($sql, array($pagor_t->id_tours));
            $pagos = $rs->fetchAll();

            if (!empty($pagos)) {
                //echo ' de ('.$r_anterior->tipo_pago.') a ('.$reserve->tipo_pago.')';
                $pagos = new Tours_Pago($pagos[0]);
                if ($t_anterior->tipo_pago == $tours->tipo_pago && $t_anterior->totaltotal == $tours->totaltotal && $t_anterior->otheramount == $tours->otheramount) {
                    // Solo si se cambia el pago y si se modifica el valor se insertan los pagos
                } else if ($t_anterior->tipo_pago == $tours->tipo_pago && ($tours->tipo_pago == 'COLLECT ON BOARD' || $tours->tipo_pago == 'VOUCHER')) {
                    //echo '<br />De COLLECT ON BOARD a COLLECT ON BOARD o VOUCHER a VOUCHER';
                    $pagor_t->id = $pagos->id;
                    Doo::db()->update($pagor_t);
                } else if (($t_anterior->tipo_pago == 'PRED-PAID' && $tours->tipo_pago == 'PRED-PAID') ||
                        ($t_anterior->tipo_pago == 'PRED-PAID' && $tours->tipo_pago == 'COLLECT ON BOARD')) {
                    //echo '<br />De PRED-PAID a PRED-PAID o PRED-PAID a COLLECT ON BOARD';
                    $pagado = $this->pagado($pagor_t->id_tours);
                    $debe = $pagor_t->pagado - $pagado;
                    if ($debe > 0) {
                        $pagor_t->pagado = $debe;
                        Doo::db()->insert($pagor_t);
                    } else {
                        $this->registrarNotaCredito($pagor_t->id_tours, ($debe * -1));
                    }
                } else if ($t_anterior->tipo_pago == 'COLLECT ON BOARD' && $tours->tipo_pago == 'PRED-PAID') {
                    //echo '<br /> COLLECT a PRED-PAID';
                    $pagado = $this->pagado($pagor_t->id_tours);
                    $debe = $pagor_t->pagado - $pagado;
                    $pagor_t->pagado = $debe;
                    Doo::db()->insert($pagor_t);
                }
            }
        }
    }

    public function pagado($id_tours) {
        $sql = "SELECT SUM(`pagado`) as total
				FROM `tours_pago` 
				WHERE  id_tours = ? AND tipo = 'MULTI'
				ORDER BY  `id` DESC ";
        $rs = Doo::db()->query($sql, array($id_tours));
        $pagos = $rs->fetchAll();
        $pagado = isset($pagos[0]['total']) ? $pagos[0]['total'] : 0;
        return $pagado;
    }

    public function registrarNotaCredito($id_tours, $valor) {
        if ($valor > 0) {
            Doo::loadModel("Tours_Nota_Credi");
            $login = $_SESSION['login'];
            $notaC = new Tours_Nota_Credi();
            $notaC->id_tours = $id_tours;
            $notaC->tipo = "MULTI";
            $notaC = Doo::db()->find($notaC, array("limit", 1));
            if (empty($notaC)) {
                $notaC = new Tours_Nota_Credi();
                $notaC->id_tours = $id_tours;
                $notaC->valor = $valor;
                $notaC->usuario = $login->id;
                $notaC->fecha = date('Y-m-d H:s');
                Doo::db()->insert($notaC);
            } else {
                $notaC = new Tours_Nota_Credi($notaC[0]);
                $notaC->id_tours = $id_tours;
                $notaC->valor = $valor;
                $notaC->usuario = $login->id;
                $notaC->fecha = date('Y-m-d H:s');
                Doo::db()->update($notaC);
            }
        }
    }

    public function detalles_rastro() {
        Doo::loadModel("Tours_Rastro");
        $id = $this->params["id"];
        $rastro = new Tours_Rastro();
        $rastro->id = $id;
        $rastro = Doo::db()->find($rastro, array('limit' => 1));

        $array = $this->crearArray($rastro->detalles);
        echo '<div><p>THE <strong>' . $rastro->tipo_cambio . '</strong> performed by an <strong>' . $rastro->tipo_usuario . '</strong>.</p>
		<strong>The result was as follows:<strong><br />';

        if ($rastro->tipo_cambio == 'CREATE') {
            echo '<br />Creation date: ' . date('M-d-Y', strtotime($array['creation_date'])) . '
                                 <br />Paid: $' . $array['paid'] . '
                                 <br />Other Amount: $' . $array['otheramount'] . '
				 <br />Net Price: $' . $array['totalouta'] . '				
			';
        } else {
            foreach ($array as $key => $val) {
                echo '<br />' . $key . ' = ' . $val;
            }
        }
        echo '</div>';
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
            $prefijo = 'TM';
        } else {//Cotizacion
            $prefijo = 'QM';
        }
        do {
            $mes = date("m");
            $dia = date("d");
            $y = date("y");
            $code = $prefijo . $y . $mes . $dia . rand(0, 999);
            $a = $this->db()->find('Tours', array('where' => 'code_conf = ?',
                'limit' => 1,
                'select' => 'code_conf',
                'param' => array($code)
                    )
            );
        } while ($a != null);
        return $code;
    }

    public function mailrender($id) {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("Tours");
        $tour = new Tours();
        $tour->id = $id;
        $tour = Doo::db()->getOne($tour);
        $this->data['tour'] = $tour;
        $time = strtotime($tour->creation_date);
        $this->data['date'] = date('M d Y', $time);
        $this->data['hour'] = date('h:i:s A', $time);
        //cargando un cliente
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $tour->id_client;
        $cliente = Doo::db()->getOne($cliente);
        $this->data['cliente'] = $cliente;
        //total de pasajeros
        $this->data['adult'] = $tour->adult;
        $this->data['child'] = $tour->child;
        if ($tour->id_reserva != -1) {
            Doo::loadModel("Reserve");
            $reserve = new Reserve();
            $reserve->id = $tour->id_reserva;
            $reserve = Doo::db()->getOne($reserve);
            $this->data['reserve'] = $reserve;
            Doo::loadModel("Trips");
            $trip = new Trips();
            $trip->trip_no = $reserve->trip_no;
            $trip = Doo::db()->getOne($trip);
            $this->data['trip'] = $trip;
            Doo::loadModel("PickupDropoff");
            $pickup1 = new PickupDropoff();
            $pickup1->id = $reserve->pickup1;
            $pickup1 = Doo::db()->getOne($pickup1);
            $this->data['pickup1'] = $pickup1;
            $dropoff1 = new PickupDropoff();
            $dropoff1->id = $reserve->dropoff1;
            $dropoff1 = Doo::db()->getOne($dropoff1);
            $this->data['dropoff1'] = $dropoff1;
            Doo::loadModel("Areas");
            $area1 = new Areas();
            $area1->id = $dropoff1->id_area;
            $area1 = Doo::db()->getOne($area1);
            $this->data['area1'] = $area1;
            $trip2 = new Trips();
            $trip2->trip_no = $reserve->trip_no2;
            $trip2 = Doo::db()->getOne($trip2);
            $this->data['trip2'] = $trip2;
            $pickup2 = new PickupDropoff();
            $pickup2->id = $reserve->pickup2;
            $pickup2 = Doo::db()->getOne($pickup2);
            $this->data['pickup2'] = $pickup2;
            $dropoff2 = new PickupDropoff();
            $dropoff2->id = $reserve->dropoff2;
            $dropoff2 = Doo::db()->getOne($dropoff2);
            $this->data['dropoff2'] = $dropoff2;
        }
        if ($tour->id_hotel_reserve != -1) {
            Doo::loadModel("Hotel_Reserves");
            $reserve_hotel = new Hotel_Reserves();
            $reserve_hotel->id = $tour->id_hotel_reserve;
            $reserve_hotel = Doo::db()->getOne($reserve_hotel);
            $i = 0;
            if ($reserve_hotel->room1_adult >= 1 || $reserve_hotel->room1_child >= 1) {
                $i++;
            }
            if ($reserve_hotel->room2_adult >= 1 || $reserve_hotel->room2_child >= 1) {
                $i++;
            }
            if ($reserve_hotel->room3_adult >= 1 || $reserve_hotel->room3_child >= 1) {
                $i++;
            }
            if ($reserve_hotel->room4_adult >= 1 || $reserve_hotel->room4_child >= 1) {
                $i++;
            }
            $this->data['n_rooms'] = $i;
            $this->data['reserve_hotel'] = $reserve_hotel;
            Doo::loadModel("Hoteles");
            $hotel = new Hoteles();
            $hotel->id = $reserve_hotel->id_hotel;
            $hotel = Doo::db()->getOne($hotel);
            $this->data['hotel'] = $hotel;
        } else {
            $this->data['reserve_hotel'] = -1;
        }
        Doo::loadModel("Attraction_Trafic");
        Doo::loadModel("Parques");
        $traffic = new Attraction_Trafic();
        $traffic->id_tours = $tour->id;
        $traffic->type_tour = "MULTI";
        $parks = array();
        $traffics = Doo::db()->find($traffic);
        foreach ($traffics as $park_trans) {
            $park = new Parques();
            $park->id = $park_trans->id_park;
            $park = Doo::db()->getOne($park);
            $id = $park->id;
            $parks[$id] = $park;
        }
        $this->data['attractions_traffic'] = $traffics;
        $this->data['parks'] = $parks;
        if ($tour->id_transfer_in != -1) {
            Doo::loadModel("Transfer");
            $transfer_in = new Transfer();
            $transfer_in->id = $tour->id_transfer_in;
            $transfer_in = Doo::db()->getOne($transfer_in);
            $this->data['transfer_in'] = $transfer_in;
        }
        if ($tour->id_transfer_out != -1) {
            Doo::loadModel("Transfer");
            $transfer_out = new Transfer();
            $transfer_out->id = $tour->id_transfer_out;
            $transfer_out = Doo::db()->getOne($transfer_out);
            $this->data['transfer_out'] = $transfer_out;
        }
        $chain = $this->toString($this->data);
        return $chain;
    }

    public function enviarCorreo($cotenido, $destinatarios) {
        try {
            Doo::loadController('DatosMailController');
            $datosMail = new DatosMailController();
            $mail = new PHPMailer(true);
            $mail = $datosMail->datos();
            foreach ($destinatarios as $row) {
                $mail->AddAddress($row['email'], $row['nombre']);
            }
            $mail->Subject = 'Reservations Super Tours OF Orlando'; // Mensaje alternativo en caso que el destinatario no pueda abrir        // correos HTML
            $mail->AltBody = 'Reservations Super Tours OF Orlando'; // El cuerpo del mensaje, puede ser con etiquetas HTML
            $mail->MsgHTML($cotenido);
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }
    }

    public function toString($data) {
        $mail = '<title>Documento sin titulo</title>
<style type="text/css">
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
</style>
</head><div align="center">
<br />
    <table> 
     <tbody><tr>
       <td width="316" height="33" rowspan="2"><img width="316" height="88" src="' . $data["rootUrl"] . 'Logo-Supertours-mail.jpg"></td>
       <td colspan="3" align="center">Supertours.com</td>
     </tr>
     <tr>
       <td height="35" colspan="3">Date:' . $data["date"] . ' / Hour: ' . $data["hour"] . ' </td>
    </tr>
     <tr>
       <td align="center" height="33" colspan="4"> <h3>MULTI DAY TOURS CONFIRMATION</h3></td>
     </tr>
     <tr>
       <td height="15"><div><div class="im">LEAD TRAVELER:
       <br><br>
       <strong>User Name: </strong><a href="mailto:' . $data["cliente"]->username . '" target="_blank">' . $data["cliente"]->username . '</a>
       <br><br>
       <strong>Firstname: </strong>' . $data["cliente"]->firstname . '
       <br><br>
       </div><strong>Lastname: </strong>' . $data["cliente"]->lastname . '
       <br><br>
       <strong>Phone: </strong><a href="tel:' . $data["cliente"]->phone . '" value="+1' . $data["cliente"]->phone . '" target="_blank">' . $data["cliente"]->phone . '</a>
        <br><br>
       </div><strong>Cellphone: </strong>' . $data["cliente"]->celphone . '    
           
       </td>
       <td width="145" height="15">&nbsp;</td>
       <td colspan="2"><strong>AD: </strong>' . $data["adult"] . ' <strong>CHD:' . $data["child"] . '</strong>  <strong> TOTAL:</strong>' . ($data["child"] + $data["adult"]) . '<br><br><strong>Status :</strong>' . $data["tour"]->estado . '<br><br><strong> Code Quotation :</strong>' . $data["tour"]->code_conf . '</td>
     </tr>
      <tr>
    <td height="45" colspan="4"> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr><td colspan="3">
     <table width="96%" height="90">
      <tbody><tr>
        <td height="35" colspan="3"><strong><div align="left"> ITINERARY ARRIVAL</div></strong></td>
        </tr>
        <tr>
          <td height="47" colspan="3"><br><p> Date Arrival <strong>';
        if ($data['tour']->id_reserva != -1 && $data['tour']->id_transfer_in == -1) {
            $time = strtotime($data["tour"]->starting_date);
            $newformat = date("M d \of Y", $time);

            $mail.=$newformat . '</strong>';

            $newformat = date("h:i A", $time);

            $mail.=$newformat;

            $mail.='</strong> - Trip <strong>' . $data["reserve"]->trip_no . '</strong>, Luxury <strong>' . $data["trip"]->equipment . '</strong> - transportation from <strong>';
            $mail.=$data["pickup1"]->place . '
          </strong>, to <strong> ' . $data["dropoff1"]->place . ' of Orlando</strong>, arriving at <strong>';
            $time = strtotime($data["reserve"]->arrtime1);
            $newformat = date("h:i A", $time);
            $mail.= $newformat . '
          </strong> , you will be greeted by your tour guide/driver in Orlando. 
          </p><hr>
          <br>';
        }
        if ($data["tour"]->id_transfer_in == -1 && $data['tour']->id_reserva != -1) {
            $mail.='- Pick up time <strong>';

            $time = strtotime($data["reserve"]->deptime1);
            $newformat = date("h:i A", $time);

            $mail.=$newformat;

            $mail.='</strong> - Trip <strong>' . $data["reserve"]->trip_no . '</strong>, Luxury <strong>' . $data["trip"]->equipment . '</strong> - transportation from <strong>';
            $mail.=$data["pickup1"]->place . '
          </strong>, to <strong> ' . $data["dropoff1"]->place . ' of Orlando</strong>, arriving at <strong>';
            $time = strtotime($data["reserve"]->arrtime1);
            $newformat = date("h:i A", $time);
            $mail.=$newformat . '
          </strong> , you will be greeted by your tour guide/driver in Orlando. 
          </p><hr>
          <br>';
        } else if ($data['tour']->id_transfer_in != -1) {
            if ($data["transfer_in"]->type == 3) {
                $mail.='- Arriving: <strong>By plane</strong>  at Orlando International Airport';
                $mail.='Data Transfer In  :   Airline: <strong>' . $data["transfer_in"]->airlie . '</strong>   Flight #:   <strong>' . $data["transfer_in"]->flight . '</strong> Arrival Time: <strong>';
                $time = strtotime($data["transfer_in"]->arrival_time);
                $newformat = date("h:i A", $time);
                $mail.=$newformat . '</strong>.';
                if ($data["tour"]->id_hotel_reserve != -1) {
                    $mail.='You will be greeted by your tour guide/driver in orlando to take you to  <strong>' . $data["hotel"]->nombre . '</strong>';
                }
            } else if ($data["transfer_in"]->type == 2) {
                $mail.= '- you have choosen <strong>';
                $time = strtotime($data["transfer_in"]->arrival_time);
                $newformat = date("h:i A", $time);
                $mail.=$newformat . '</strong>, on a luxury private transportation from <strong>' . $data["transfer_in"]->city . '</strong>, <strong>' . $data["transfer_in"]->address . '</strong>.';
                if ($data["tour"]->id_hotel_reserve != -1) {
                    $mail.='And you will be take to <strong>' . $data["hotel"]->nombre . '</strong>.';
                }
            } else if ($data["transfer_in"]->type == 4) {
                $mail.='Date Arrival <strong>' . $data["tour"]->starting_date . '</strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, 
                TO FIGURE OUT HOW YOU WILL GET YOUR TICKETS.';
                if ($data["tour"]->id_hotel_reserve != -1) {
                    $mail.='OR WE CAN LEAVE YOUR TICKETS ON  <strong>' . $data["hotel"]->nombre . '</strong> AND TALK ABOUT OTHER SERVICES.';
                }
                $mail.='WE WILL PLEASED TO ASSIST YOU.';
            }
        }
        //<!-- Acomodacion -->

        if ($data["tour"]->id_hotel_reserve != -1) {
            $mail.='<strong> <div align="left"> ACCOMMODATION</div></strong>
                        <br>
                        Hotel accommodation at the <strong>' . $data["hotel"]->nombre . '</strong> in <strong>.' . $data["n_rooms"] . '</strong> room(s). for <strong>.' . $data["reserve_hotel"]->days . '</strong> day(s)';
            if ($data["reserve_hotel"]->nights >= 1) {
                $mail.='and <strong>' . $data["reserve_hotel"]->nights . '</strong> night(s)';
            }
            $mail.='from <strong>';

            $time = strtotime($data["reserve_hotel"]->starting_date);
            $newtime = date("M d Y", $time);
            $mail.=$newtime;
            $mail.='</strong> Check In Time is 4:00pm . To
                <strong>';
            $time = strtotime($data["reserve_hotel"]->ending_date);
            $newtime = date("M d Y", $time);
            $mail.= $newtime;
            $mail.='</strong> Check Out Time is 11:00am.';
            if ($data["hotel"]->breakfast == 1) {
                $mail.='FREE DAILY CONTINENTAL BREKFAST';
            }
            $mail.='Taxes are Included.
                <br><br>
                <hr><br>';
        }
        //<!-- fin acomodacion -->
        if (count($data["attractions_traffic"]) > 0) {
            $mail.='<strong> <div align="left"> LOCAL TRANSFERS TO PARKS</div></strong>';
            $mail.='Parks tagged with <strong>Transportations</strong> means you will have tranportation included from the hotel to the park.
                        Parks tagged with <strong> Tickets </strong> means you already payed for the entrances tickets to the park.
                        <br>
                        <ul style="list-style-type: square">';
            foreach ($data["attractions_traffic"] as $park) {
                $mail.='<li>';
                $id = $park->id_park;
                $mail.= $data["parks"][$id]->nombre . " ";
                if ($park->admission == 1) {
                    $mail.= "<strong>Ticket(s)</strong>";
                }
                if ($park->trafic == 1 && $park->admission == 1) {
                    $mail.= " and ";
                }
                if ($park->trafic == 1) {
                    $mail.= " <strong>Tranportations</strong>";
                }
                $mail.= "</li>";
            }
            $mail.='</ul>
                <div class="im">
                </div>
                <p></p>
                <p><strong> </strong></p><div align="left">';
        }
        $mail.='<strong> ITINERARY DEPARTURE</strong></div><br></div>
                Date departure <strong>' . $data["tour"]->ending_date . ' ';
        if ($data["tour"]->id_transfer_out == -1 && $data['tour']->id_reserva != -1 && $data['reserve']->tipo_ticket != 'oneway') {
            $mail.='- Pick up time <strong>';
            $time = strtotime($data["reserve"]->deptime2);
            $newformat = date("h:i A", $time);
            $mail.=$newformat;
            $mail.='</strong> -  Trip <strong>' . $data["trip2"]->trip_no . '</strong>, Luxury <strong>' . $data["trip2"]->equipment . '</strong> - transportation from <strong>Orlando' . $data["pickup2"]->place . '</strong> to <strong>' . $data["dropoff2"]->place . '</strong> arriving at <strong>';

            $time = strtotime($data["reserve"]->arrtime2);
            $newformat = date("h:i A", $time);
            $mail.=$newformat;
        } else if ($data['tour']->id_transfer_out != -1) {
            if ($data["transfer_out"]->type == 4) {
                $mail.='Departure: By Car.</p>';
            } else if ($data["transfer_out"]->type == 3) {
                $mail.='- Departure: By Plane at Orlando International Airport Transfer Out: Airline: <strong>' . $data["transfer_out"]->airlie . '</strong> Flight #: <strong>' . $data["transfer_out"]->flight . '</strong> Departure Time: <strong>' . $data["transfer_out"]->arrival_time . '</strong> ';
            } else if ($data["transfer_out"]->type == 2) {
                $mail.='</strong> - Time: <strong>';

                $time = strtotime($data["transfer_out"]->arrival_time);
                $newformat = date("h:i A", $time);
                $mail.=$newformat;
                $mail.='</strong>, on a luxury private transportation to <strong>' . $data["transfer_out"]->city . '</strong>, <strong>' . $data["transfer_out"]->address . '</strong>, in MIAMI.';
            }
        }
        $mail.='</strong>Thank you for choosing us !. <br>
           <br>
              <br>
            <p></p></td>
        </tr>
    </tbody></table>

      </td>
  </tr>
  <tr>
    <td height="33" colspan="4"><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan="4"><table width="90%" border="0">
      <tbody><tr>
        <td height="32" align="center"><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span>$' . $data["tour"]->totalouta . '</span> </td>
      </tr>
      <tr>
        <td height="40" align="center"><span>CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
      </tr>
      <tr>
        <td align="center">Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call <a href="tel:%28407%29%20370-3001" value="+14073703001" target="_blank">(407) 370-3001</a> and speak with our  Call Center.<br>
</td>   
      </tr>
    </tbody></table><div class="im">
    <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -</p><div><br>
      luggage restrictions apply - Please read the terms of transportation at <a href="http://www.supertours.com" target="_blank">www.supertours.com</a><br>
      THANK YOU FOR CHOOSING US<br>
      HAVE A NICE TRIP<br>
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br>
      Phone: <a href="tel:%28407%29%20370-3001" value="+14073703001" target="_blank">(407) 370-3001</a> / U.S.A. TOLL FREE <a href="tel:1-800-251-4206" value="+18002514206" target="_blank">1-800-251-4206</a> / <a href="mailto:reservations@supertours.com" target="_blank">reservations@supertours.com</a>
    
    </div><p></p></div></td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center"> <p align="center"> 
    
</p>       </td>

  </tr>
  </tbody></table>';

        return $mail;
    }

}
