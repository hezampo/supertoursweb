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
        if ($total == 0){
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
        if ($total == 0){
            $total = 1;
        }
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex'])){
            $pager->paginate(intval($this->params['pindex']));
        }
        else{
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
            $sql = "SELECT  id,company_name
				 			FROM agencia
							WHERE company_name LIKE ?  LIMIT 5  ";
            $rs = Doo::db()->query($sql, array('%' . $data . '%'));
            $consulta = $rs->fetchAll();
            $dataList = array();
            foreach ($consulta as $consul) {
                $toReturn = $consul['company_name'];
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
        $pertenece = $this->params["id2"];
        if ($pertenece == 'cliente') {
            $sql = "SELECT `id`, `username`, `firstname`, `lastname`, `password`, `phone`, `celphone`, `city`, `state`, `country`, `address`, `zip`, `tipo_client`, `birthday`, `fecha_r`, `points`, `left_points`, `paid_points` FROM  clientes WHERE id = ? ";
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
        $res = Doo::db()->query("SELECT id,firstname,lastname FROM user_agencia WHERE id like  ?  or firstname like  ? or lastname like  ? or email like  ? LIMIT 5", array($param, $param, $param, $param));

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

        //GLOBAL $categor;
        //echo  $categor;
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


//            $id_tour1 = $dat->id_tour;            
//            $id_tour = $id_tour1;
            
            $tourtrip = $this->params["rates"];
            if ($tourtrip == 0){
                  $id_tour = $dat->id_tour;
                 // echo $id_tour;
                  //$id_tour = $id_tour1;
          
            }else{
              $id_tour =   $tourtrip;
              //echo $id_tour;
             // $id_tour = $id_tour1;
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
            //echo $a;
            
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
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                                $rs = Doo::db()->query($sql, array($type_rate, $a));
                                $pricescar = $rs->fetch();
                            }
                        }

                        if (!empty($pricescar)) {
                            $price = number_format($pricescar ['price'], 2, '.', '');
                        }
                        $tranferIn->total_price = ($price)*($adult+$child);
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
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                                $rs = Doo::db()->query($sql, array($type_rate, $a));
                                $pricescar = $rs->fetch();
                            }
                        }
                        if (!empty($pricescar)) {
                            $price = number_format($pricescar ['price'], 2, '.', '');
                        }
                        $tranferOut->total_price = ($price)*($adult+$child);
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
                $prc_trip1_adult = ($trip1a/$adult) + (($precio_e1 + $precio_e4) * $adult);
                
                if($child == 0){
                   
                    $prc_trip1_child = 0;
                    
                 }else{
                
                $prc_trip1_child = ($trip1c/$child) + (($precio_e1 + $precio_e4) * $child);
                 
                
                 }
                
                //TRIP2
                $prc_trip2_adult = ($trip2a/$adult) + (($precio_e1 + $precio_e4) * $adult);
                
                if($child == 0){
                   
                    $prc_trip2_child = 0;
                    
                 }else{
                
                $prc_trip2_child = ($trip2c/$child) + (($precio_e1 + $precio_e4) * $child);
                
                }
//                $tot_trip1lt = $precio_trip1_adult;
//                $tot_trip1_child = 
                
                $total = $precioA + $precioN;
                ($extra == '') ? 0 : $extra;
                $fee = 0;
                if ($opcion_pago == 3) {
                    $fee = ($total + $extra) * 0.04;
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
                        $attraction->totalTraspor = $transporLocal;//actualizacion
                        
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

                $fee_n = 0.04;

                $extra = ($extra == '') ? 0 : $extra;
                if ($opcion_pago == 3) {
                    $fee = ($total + $extra) * $fee_n;
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
                $tours->tipo_pago = $arkey[0];
                $tours->op_pago = $opcion_pago;
                $tours->pago = $arval[0] . '-' . $tipoSaldo;
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
                    $tours->total = ceil($tours->total * ( 1 - ($descuento / 100)));//////////////////0.9
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
                            
                            
                          
                        $hotel->sql = $datos_hotel["sql"];
                        $hotel->dbl = $datos_hotel["dbl"];
                        $hotel->tpl = $datos_hotel["tpl"];
                        $hotel->qua = $datos_hotel["qua"];
                        
                        
                        //$hotel->nightprice = $costoHotel['total'] / ($nochesPagas);  
                        $hotel->nightprice =  $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"]; 
                      
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
                    $this->registrar_pago($tours, NULL, $login, $pay_amount, $tipoP_2, $formaP_2);
                } else {
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
            return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?menssage=Guardado Correctamente";
        } catch (Exception $exc) {
            //unset($_SESSION['tours']['hoteles_n']);
//            print_r($exc);
            Doo::db()->rollBack();
           return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?error=error al guardar, verifique con su administrador de software.";
        }
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
    //echo  $tourtrip;
    if ($tourtrip == 0){
          $id_tour = $dat->id_tour;
          //echo $id_tour1;
          //$id_tour = $id_tour1;
          
        }else{
          $id_tour =   $tourtrip;
         // echo $id_tour1;
         // $id_tour = $id_tour1;
        }
    
    
//    $id_tour1 = $dat->id_tour;
//    
//    $id_tour = $id_tour1;   
    
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


            $id_tour1 = $dat->id_tour;
            //echo $id_tour1;
            $id_tour = $id_tour1;
            
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
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $a));
                            $pricesbyplane = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $a));
                            $pricesbyplane = $rs->fetch();
                            if (empty($pricesbyplane)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? AND type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                            $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = 0 AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($a));
                            $pricescar = $rs->fetch();
                        } else {
                            $type_rate = 2;
                            $sql = 'SELECT id,price FROM tarifacar WHERE id_agency = ? and type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($dat->id, $type_rate, $a));
                            $pricescar = $rs->fetch();
                            if (empty($pricescar)) {
                                $type_rate = 1;
                                $sql = 'SELECT id,price FROM tarifacar WHERE type_rate = ? AND id_agency = "-1" and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                $precioN = $trip1c + $trip2c + (($precio_e1 + $precio_e4) * $child);

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
                    $precios = $this->price_transport_trip($dat, $trip_no_new, $a);
                    $precio_trip1_adult = $precios["adult"];
                    $precio_trip1_child = $precios["child"];
                } else {
                    $precio_trip1_adult = 0;
                    $precio_trip1_child = 0;
                }
                $trip2_no_new = (isset($d_trip_no)) ? $d_trip_no : '0';

                if ($trip2_no_new > 0) {
                    $a = $anio2 . '-01-01 00:00:00';
                    $precios = $this->price_transport_trip($dat, $trip2_no_new, $a);
                    $precio_trip2_adult = $precios["adult"];
                    $precio_trip2_child = $precios["child"];
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
                        
                        $hotel->sql = $datos_hotel["sql"];
                        $hotel->dbl = $datos_hotel["dbl"];
                        $hotel->tpl = $datos_hotel["tpl"];
                        $hotel->qua = $datos_hotel["qua"];               
                       
                                
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
                            
                            $costoHotel = $this->costoHotel($datos_hotel["starting_date"], $datos_hotel["ending_date"], $datos_hotel["id"], $hotel->room1_adult, $hotel->room2_adult, $hotel->room3_adult, $hotel->room4_adult, $hotel->free_night, $datos_hotel["free_night_buffet"], $dat->type_rate);
                            
                            //$hotel->nightprice = $costoHotel['total'] / ($nochesPagas);
                            $hotel->nightprice =  $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];                         
                            //$hotel->nightprice = 728;
                            //$hotel->totalnights = $costoHotel['total'];
                            $hotel->totalnights = $datos_hotel["sql"] + $datos_hotel["dbl"] + $datos_hotel["tpl"] + $datos_hotel["qua"];
                           
                            if ($datos_hotel["breakfast"] == 1) {
                                $hotel->buffet = True;
                                $hotel->breakfastprice = $costoHotel['priceBreakfast'];
                                $hotel->totalbreakfasts = $costoHotel['priceBreakfast'] * $adult;
                            } else {
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
                        $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
                        $total_paid_suma += $hotel->total_paid;

                        Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                    }
//print_r($hotel);
//                exit;
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

//           print_r($totalAtraccion);
//           exit;
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
                $tours = new Tours();
                $tours->id = $t_anterior->id;
                $tours->id_client = $cliente->id;
                $tours->type_client = $cliente->tipo_client;
                $tours->platinum = $type_services;
                $tours->id_agency = $dat->id;
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
                $tours->comments = $comments;
                $tours->tipo_pago = $arkey[0];
                $tours->pago = $arval[0] . '-' . $tipoSaldo;
                $tours->op_pago = $opcion_pago;
                $tours->extra_charge = $extra;
                $tours->otheramount = $otheramount;
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
                $tours->total = $total_sin_hotel + $fee + $extra;

                $tours->total = $total + $fee + $extra;

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
                    $fee_n = 0.03;
                } else {
                    $fee_n = 0.04;
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
                $tours->otheramount_sin_tax = $otheramount;
                $tours->canal = $canal;
                if ($t_anterior->estado == 'INVOICED') {
                    $tours->estado = 'INVOICED';
                } else {
                    $tours->estado = $estado;
                }

                if (isset($_SESSION['tours']["mensaje_html"])) {
                    $tours->mensaje_tiquetes = $_SESSION['tours']["mensaje_html"];
                }
//                print_r($tours);
//                exit;
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
                // FIN actializamos la reseva
                // actualizamos la reseva del hotel
//                if (isset($opcion_hotel) && $nhoteles == 1) {
//                    $sql = "update hotel_reserves set id_tours = ? where id = ?";
//                    $rs = Doo::db()->query($sql, array($tours->id, $hotel->id));
//                }
                // FIN actializamos la reseva
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
                $tours->id = $id_tours;
                $login = $_SESSION['login'];
                $login->tipo = 'OPERATOR';
                $t_anterior->paid = 0;
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
                    $this->registrar_pago($tours, NULL, $login, $pay_amount, $tipoP_2, $formaP_2);
                } else {
                    $tours->paid = 0;
                }

                $this->rastro_tours('UPDATE', $t_anterior, $tours, $login);
            }
//            echo "hola mundos!";
            //FIN Insert tours
//            if (isset($_SESSION['reinvoicing'])) {
//                echo '<script>window.close();</script>';
//                exit;
//            }
            //unset($_SESSION['tours']['hoteles_n']);
            Doo::db()->commit();
            return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?menssage=Guardado Correctamente";
        } catch (Exception $exc) {
            //unset($_SESSION['tours']['hoteles_n']);
            Doo::db()->rollBack();
            print_r($exc);
          return Doo::conf()->APP_URL . "admin/tours/edit/" . $id_tours . "?error=error al guardar, verifique con su administrador de software.";
        }
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
                
               
                
                
            $color_row=array('#DBE5DD', 'lightblue');
                    //#cccccc
            $ind_color=0;
                
                
                               
            $sql = "SELECT p1.nombre as PARQUE,g1.nombre AS GRUPO, a1.adult, a1.child, a1.admission_adtul,
                    a1.admission_child, a1.totalTraspor, a1.v_p_adult, a1.v_p_child, a1.total_paid, a1.cantidad 
                    FROM attraction_trafic a1
                    LEFT JOIN parques p1 on (a1.id_park = p1.id)
                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)
                    WHERE a1.id_tours = $tours->id AND a1.type_tour = 'MULTI'";
                
            $rs = Doo::db()->query($sql);
            $atracadm = $rs->fetchAll();
                    //print_r($atracadm);             
           
            $table = "<table border=1 align='center' style='text-align: center;'>";    
            $table .=" <tr>
              <td>PARK</td>                 
              <td>GROUP</td>                 
              <td>ADMISSION ADULT</td>
              <td>ADMISSION CHILD</td>
              <td>TRANSPORT</td>
                   </tr>
                 ";  
	
	
            foreach ($atracadm as $clave=>$key) 
             {
              $ind_color++;
              $ind_color %= 2;
            $table .="<tr bgcolor=${color_row[$ind_color]}>";
            $table .="<td>".$key["PARQUE"]."</td>";                 
            $table .="<td>".$key['GRUPO']."</td>";
            $table .="<td> $ ".$key['admission_adtul'].".00</td>";                  
            $table .="<td> $ ".$key['admission_child'].".00</td>";
            //echo"<td>&nbsp;&nbsp;".$key['admission_adtul']."&nbsp;&nbsp;".$key['admission_child']."</td>";
            $table .="<td> $ ".$key['totalTraspor'].".00</td>";                 
            $table .= "</tr>";
              }
            $table .= "</table>"; 
            //echo $table;
//            echo "<script>  </script>";
            
//            $priceadult  = $key['v_p_adult'];
//            $pricechild = $key['v_p_child'];
            
            
            
            $sql = "SELECT a1.cantidad,g1.nombre AS GRUPO, SUM(total_paid) AS TOTAL, ROUND(SUM(v_p_adult)) AS ADM_ADULT, ROUND(SUM(v_p_child)) AS ADM_CHILD
                    FROM attraction_trafic a1
                    LEFT JOIN grupo_parques g1 on (a1.group = g1.id)                    
                    WHERE id_tours = $tours->id AND type_tour = 'MULTI'";
                
            $rs = Doo::db()->query($sql);
            $atracadm2 = $rs->fetchAll();
//          $priceadult         = $key['v_p_adult'];
//          $pricechild         = $key['v_p_child'];
            
            foreach ($atracadm2 as $clave=>$key) 
             {
              
             }
            
            $price_total_paid   = $key['TOTAL'];       
            $adm_adult   = $key['ADM_ADULT'];   
            $adm_child   = $key['ADM_CHILD'];   
            $cantidad= $key['cantidad'];  
            
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
            echo '<input type="hidden" readonly="readonly" value="' . $price_total_paid . '" name="price_total_paid" id="price_total_paid"/>';
                
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
//                                print_r($costos_hoteles);
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
               //print_r($park);
//                exit;
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

                //Area de los parques: defaul orlando
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

                foreach ($tipo_transf as $clave10=>$key10) 
                 {          

                 }            

                $tipo_transfer   = $key10['type_transfer']; 
                //echo $tipo_transfer;

                if ($tipo_transfer == 'PLANE'){
                            
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
                
                
                if ($tipo_transfer == 'CAR'){
                    
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
                
                if ($tipo_transfer != 'PLANE' || $tipo_transfer != 'CAR' ){
                            
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
                $park = $this->totalValorPark($reserve->pax, $reserve->pax2);

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
    
    public function resumen(){
    
        Doo::loadModel("Tours");
        $prueba = $_POST['variable'];
        //echo $prueba;
       
       
                 
       $sql2= "SELECT id from reservas where id_tours='$prueba'";
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
	p6.nombre AS parque, 
        
	p8.buffet AS buffet,
        p8.super_breakfast AS superbrakfast,
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
        $super = $key['superbrakfast'];
        $habitacion = $key['habitacion'];
        $checkout = $key['checkout'];
        $checkin = $key['checkin'];
        $direccion = $key['direccion'];
        $nombreHotel = $key['nombreHotel'];
        $agencia = $key['agency'];
        $adulto1 = $key['adulto'];
        
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
            foreach ($datos_multi as $clave5=>$key5) 
             {          
              
             }

        


        $nombre = $key5['nombre'];
        $apellido = $key5['apellido'];
        $email = $key5['email'];
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
        $rpomedioA = ($rprecioA1/ $adult);
        $rpomedioA1 = number_format($rpomedioA, 2, '.', '');
      
        $totalApagar = ($rprecioA1+$rprecioC1);
        $totalApagar1 = number_format($totalApagar, 2, '.', '');
       

        
        
        $tipo_ticket = $key['tipo_ticket'];
//$tipo_ticket = strtoupper($key['tipo_ticket']);
//Primera letra en Mayuscula
        $ticket_oneway = ucwords($key['tipo_ticket']);
        
            

        if ($child == 0) {
            $child = '0';
            $nino = '00.00';
            $nxc = '00.00';
        }

        if ($email == '') {
            $email = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }

        if ($phone == '') {
            $phone = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        if ($admision == '1'){
            $add = "YES";
            //echo $add;
        }else{
            $add = "NO";
            //echo $add;
        }
        if ($buffet == '1'){
            $addb = "YES";
        }else{
            $addb = "NO";
        }
        if ($super == '1'){
            $addb1 = "YES";
        }else{
            $addb1 = "NO";
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
            
            foreach ($atracadm3 as $clave2=>$key2) 
             {                        
            $table .="<tr> <td align='left'>".$key2["PARQUE"]."</td> <td>".$add."</td><td>". 'YES' ."</td></tr>";                 
              
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

            foreach ($prc_trips as $clave10=>$key10) 
             {          
              
             }            
            
            $tipo_ticket = $key10['tipo_ticket'];
            $precio_trips1 = $key10['totaltotal'];
            $precio_trips = number_format($precio_trips1, 2, '.', '');
            //echo $precio_trips;
            
            if ($tipo_ticket != 'roundtrip'){
                $fecha_salida  = '';
                $fecha_retorno = '';
                $deptime1 = '';
                $deptime2 = '';
                $deptime3 = '';
                $deptime4 = '';
                $from1 = '';
                $to1 = '';
                $from2 = '';
                $to2 = '';
                
            }else{
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

            foreach ($transf_in as $clave8=>$key8) 
             {          
              
             }            
             
            $precio_transf_in1   = $key8['total_price']; 
            $precio_transf_in = number_format($precio_transf_in1, 2, '.', ''); 
            
            //echo $precio_transf_in;
            
            //TRANSFER OUT
            
            $sql9 = "SELECT total_price
                                        
                    FROM transfer tr1
                    LEFT JOIN tours to1 on (tr1.id = to1.id_transfer_out)
                    
                    WHERE to1.id = '$prueba'";
        
                
            $rs9 = Doo::db()->query($sql9);
            $transf_out = $rs9->fetchAll(); 

            foreach ($transf_out as $clave9=>$key9) 
             {          
              
             }            
             
            $precio_transf_out1   = $key9['total_price']; 
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

            foreach ($costo_hotel as $clave6=>$key6) 
             {          
              
             }            
             
            $total_paid_hotel   = $key6['total_paid']; 
            //echo  $total_paid_hotel;
            
            $Cantidad_personas = $adult + $child ;
            
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

            foreach ($atracadm4 as $clave3=>$key3) 
             {          
              
             }            
             
            
             
            $price_total_paid   = $key3['TOTAL']; 
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
            $adm_adult1   = (($key3['TOTAL'])/$adult); 
            
            $adm_adult = number_format($adm_adult1, 2, '.', ''); 
            
            if ($child > 0){
             //admisiones a parque para ninos
            $adm_child1   = (($key3['TOTAL'])/$child);
            $adm_child = number_format($adm_child1, 2, '.', ''); 
            
            }else{
            $adm_child = '0.00';
            }
            $transp_adult = $key3['transpor_adult'];
            
            $transp_child = $key3['transpor_child'];
          
            $rprecioA = ($tot_parq_adult+$prom_hotel)*$adult;
            
            $rprecioA1 = number_format($rprecioA, 2, '.', '');  
            
           // $rprecioA1 = number_format($rprecioA, 2, '.', '');
            
           
            $rprecioC = ($tot_parq_child+$prom_hotel)*$child;
            $rprecioC1 = number_format($rprecioC, 2, '.', '');  
            
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            $sql5 = "SELECT op_pago FROM tours 
                    
                    WHERE id = '$prueba'";
        
                
            $rs5 = Doo::db()->query($sql5);
            $tipo_pago = $rs5->fetchAll(); 

            foreach ($tipo_pago as $clave4=>$key4) 
             {          
              
             }
            
            $op_pago   = $key4['op_pago']; 
            
//            if ($paquete_transfer > 0){
//                $precio_trips = 0;
//            }
            
            
            
            //CREDIT CARD NO FEE-FULL  // COLLECT ON BOARD
            if ($op_pago == 8) {
            
            $totalApagar1 = '0.00';
                
            }
            
            //CREDIT CARD WITH FEE-FULL  // COLLECT ON BOARD
            if ($op_pago == 3) {
            
            $totalApagar5 = (($rprecioA1)+($rprecioC1)+($paquete_transfer)+($precio_trips))*0.04;
            $totalApagar1  = number_format($totalApagar5, 2, '.', ''); 
            
                
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
            
            $totalApagar5 = (($rprecioA1)+($rprecioC1)+($paquete_transfer)+($precio_trips))*0.04;
            $totalApagar1  = number_format($totalApagar5, 2, '.', '');  
                
            }
            
            //COMPLEMENTARY-FULL // FREE SERVICES
            if ($op_pago == 7) {
            
            $totalApagar1 = '0.00';
                
            }
            
             
             ///////////////////////////////////////////////////////////////////////////////////////////////////////
            
            $paquete_adultos_1 = ($tot_parq_adult + $prom_hotel);
            $paquete_adultos = number_format($paquete_adultos_1, 2, '.','' );
            
            if ($child > 0){
            $paquete_ninos_1 = ($tot_parq_child + $prom_hotel);
            $paquete_ninos = number_format($paquete_ninos_1, 2, '.','' );
            }else{
            $paquete_ninos = '0.00';
            }
            
            //$totalApagar_1 = round(($rprecioA1+$transp_adult) + ($rprecioC1+$transp_child) + ($paquete_transfer) + ($totalApagar1));
            $totalApagar_1 = round($rprecioA1+$transp_adult) + round($rprecioC1+$transp_child) + ($paquete_transfer) + ($precio_trips) + ($totalApagar1);
            $totalApagar  = number_format($totalApagar_1, 2, '.','' );   
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
       
           
            
        $codigoHTML.='
            <header>
            <div id="contenedor">

                <div id="sp-div">
                    <img src="global/img/icono26anios.png" alt="" style="width: 25%; margin-top: -1%;" />
                </div>
                <div id="sp-div-left" style="margin-left: 431px;">
                    <p style="font-size: 20px; margin-top: -5%;">
                        Confirmation  #:<u><b> <font style="font-size: 25px;">' . $codconf . '</font></b></u>
                    </p> 
                    
                </div>
            </div>
        </header>
       <p>
        <div id="contenido">
            <p style="font-size: 20px;  margin-left: 45%; margin-top: -5%;">
                <b>E-Ticket<b>
            </p>                                 
            <p>
                <i style="font-size: 27px; line-height: 1em;"><u><b>Passenger Information</b></u></i><br/>
                Lead Passenger Name: <u>' . $apellido . '  ' . $nombre . '</u><br />
                Adults: <u><b>' . $adult . '</b></u>&nbsp;&nbsp;&nbsp;Child(3-9): <u><b>' . $child . '</b></u>&nbsp;&nbsp;&nbsp;Total Passengers: <u><b>' . ($adult + $child) . '</b></u> <br />
                E-mail: <u>' . $email . '</u>&nbsp;&nbsp;&nbsp;Telephone: <u>' . $phone . '</u>
            </p>
            
            <table border="0" width ="550" bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
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
            <table border="0" bgcolor= "#D9E5F5"  cellpadding="1" cellspacing="1" style="border: 1px solid #000;width: 101%;">
                <thead>               
                    <tr>                         
                        <td align="center" style="font-size: 21px;width: 38%; "> <u><b><u><i>Accomodation</i></u></b></u></td>
                        <td align="center" colspan="3" style="font-size: 21px; width: 58%; "> <i><b><u>ON REQUEST</u></b></i> </td>
                    </tr>
                </thead>               
                <tbody>
                <tr>
                    <td>&nbsp;<b>Hotel:</b> <u>'.$nombreHotel.'</u></td>   
                    <td colspan="3"><b>Address:</b>&nbsp;<u>'.$direccion.'</u></td>
                </tr>
                <tr>
                    <td style="width: 90%;" <b>&nbsp;Check in:&nbsp;</b> <u>'.$checkin.'</u>&nbsp;After:&nbsp;<u>4:00 P.M.</u></td>
                    <td style="width: 20%;" colspan="3">Check out:&nbsp;<u>'.$checkout.'</u>&nbsp;Before:&nbsp;<u>11:00 A.M.</u><br></td>
                </tr>
                <tr>
                    <td colspan="3"> &nbsp;<b># of Rooms:</b>&nbsp;<u>'.$habitacion.'</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Continental Breakfast Include:</b>&nbsp;<u>'.$addb1.'</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Buffet Breakfast Included:</b>&nbsp;<u>'.$addb.'</u> </td>
                    <!--<td style="width: 85%; "<b>Continental Breakfast Include:</b>&nbsp;<u>'.$addb1.'</u></td>
                    <td style="width: 70%; "<b>Buffet Breakfast Included:</b>&nbsp;<u>'.$addb.'</u></td>-->
                </tr>                  
                </tbody>
            </table> 
            <br />
            
            <table border="0" width ="550" bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="border: 1px solid #000;">
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
                    
                        <td align="center">'  .$table.  '</td>
                        
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
                <table border="0" width ="270"  bgcolor= "#D9E5F5" cellpadding="1" cellspacing="1" id="tabla" style="margin-left 15%;border: 1px solid #000; line-height: 1.2em;">                 
                    <tr style="margin-left:50%;">
                        <td align="left" style="">Package Price Adult:</td>
                        <td align="right">$&nbsp;' . $paquete_adultos . '</td>
                        <td align="center">X</td>
                        <td align="center">' . $adult . '</td>
                        <td align="right">$&nbsp;' . $rprecioA1 . '</td>                        
                    </tr>   
                    
                    <tr>
                        <td align="left" style="">Round-Trip Child:</td>
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
                        <td align="right">$&nbsp;' . $totalApagar1 . '</td>                        
                    </tr>                  
                    
                    <tr>
                        <td align="left" style="width: 44%;">Total Amount Paid:</td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right"> </td>
                        <td align="right">$&nbsp;' . $totalApagar . '</td>                        
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
   
        $pdf = new DooPDF('Summary Multi-Day Tours', $codigoHTML, false, 'letter', 'letter');
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
            print_r($salida);

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
                                         <div class="label">FROM</div>
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
                                            <div class="label">TO</div>
                                            <select style="width:190px" name="to" id="to" class="select">';
            foreach ($area_park as $e) {
                echo '<option value="' . $e["id"] . '">' . $e["nombre"] . '</option>';
            }

            echo '                         </select>
                                        </div>
                                        </td>
                                        <td>
                                        	<div id="trip">
                                           
                                            <div class="label">TRIP</div>
                                   <table><tr><td>
                                    <span><input class="field" name="a_trip_no" type="text" id="a_trip_no" size="3" maxlength="3" value="" readonly="readonly"/></span></td>
                                    <td onclick="mostrarTrip1()" ><a><img id="popup1" style="cursor:pointer" src="' . $url . 'global/images/search.png"/></a>
                                            </td></tr></table>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td width="100%" colspan="3">
                                        <div id="pick-drop">
                                            <div class="label">PICK UP POINT/ADDRESS</div>
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
                                    	<td width="25%">
                                        EXTENSION AREA: </td>
                                        <td>
              <select name="ext_from1" id="ext_from1" class="select" style="width:200px;"  onchange="change_ext_from1();"> </select>
                                           
                                
                                        </td>
                                        <td>&nbsp;</td>
										  <td width="15%">
                                         <div id="rooms">
                                    <div class="label">LUGGAGE</div>
                                            <span><input name="a_luggage" type="text" id="a_luggage" size="2" maxlength="2" value=""
                                                         class="field"/></span>
                                        </div>
                                        </td>
                                        <td width="15%">
                                         <div id="rooms">
                                    <div class="label">ROOM #</div>
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
                                            <div class="label">EXTENTION DROPOFF POINT/ADDRESS</div>
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
						<td colspan="4" >&iquest;At what time you wish your private service leaves Miami?</td>
						<td width="29"><label>
							<input  autocomplete="off" name="hora1" type="text" id="hora1" value="" size="6" class="required"/>
						</label></td>
						<td width="29"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center">&iquest;From where in Miami?</div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58">City:</td>
						<td width="113"><input  autocomplete="off" name="city" type="text" id="city" size="25" class="required"  /></td>
						<td width="114"></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">Address:</td>
						<td height="2"><input  autocomplete="off" name="address" type="text" id="address" size="25" class="required" /></td>
						<td height="2"></td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">Zip Code:</td>
						<td height="3"><input  autocomplete="off" name="zipcode" type="text" id="zipcode" size="25" class="required"/></td>
						<td height="3"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">Phone #:</td>
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
						<td> <div align="left">Airline:</div></td><td><label>
						  <input  autocomplete="off" type="text" name="airlinearrival" id="airlinearrival"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left">Flight #:</div></td>
						<td><input  autocomplete="off" type="text" name="flightarrival" id="flightarrival"  class="required"/>
						  </td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="89"> <div align="left">Arrival Time:</div></td>
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
						<td width="211"><div align="left">Estimated arrival time to Orlando:</div></td>
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
                                         <div class="label">FROM</div>
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
                                            <div class="label">TO</div>
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
                                           
                                            <div class="label">TRIP</div>
                                   <table><tr><td>
                                    <span><input class="field" name="d_trip_no" type="text" id="d_trip_no" size="3" maxlength="3" value=""
                                                 readonly="readonly"/></span></td><td>
                                            <a rel="superbox[ajax][' . $url . 'admin/tours/trips/arrival][300x100]">
                                                <img id="popup2" style="cursor:pointer" src="' . $url . 'global/images/search.png" onclick="mostrarTrip2()"/>
                                                
                                            </a></td></tr></table>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td width="100%" colspan="3">
                                        <div id="pick-drop">
                                            <div class="label">DROP OFF POINT:/ADDRESS</div>
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
                                    	<td width="25%">
                                        EXTENSION AREA: </td>
                                        <td>
              <select name="ext_to2" id="ext_to2" class="select" style="width:200px;"  onchange="change_ext_to2();"></select>
                                           
                                
                                        </td>
                                        <td>&nbsp;</td>
										 <td width="15%">
                                         <div id="rooms">
                                    <div class="label">LUGGAGE</div>
                                            <span><input name="d_luggage" type="text" id="d_luggage" size="2" maxlength="1" value=""
                                                         class="field"/></span>
                                        </div>
                                        </td>
                                        <td width="15%">
                                         <div id="rooms">
                                    <div class="label">ROOM #</div>
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
                                            <div class="label">EXTENTION PICK UP POINT/ADDRESS</div>
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
						<td colspan="5" >&iquest;At what time you wish your private?</td>
						<td width="29"><label>
							<input  autocomplete="off" name="hora2" type="text" id="hora2" value="" size="6" class="required"/>
						</label></td>
						<td width="29"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center">&iquest;From where in Orlando?</div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58">City:</td>
						<td width="113"><input  autocomplete="off" name="city2" type="text" id="city2" size="25" class="required"  /></td>
						<td width="114"></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">Address:</td>
						<td height="2"><input  autocomplete="off" name="address2" type="text" id="address2" size="25" class="required" /></td>
						<td height="2"></td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">Zip Code:</td>
						<td height="3"><input  autocomplete="off" name="zipcode2" type="text" id="zipcode2" size="25" class="required"/></td>
						<td height="3"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">Phone #:</td>
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
						<td> <div align="left">Airline:</div></td><td><label>
						  <input  autocomplete="off" type="text" name="airlinedeparture" id="airlinedeparture"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left">Flight #:</div></td>
						<td><input  autocomplete="off" type="text" name="flightdeparture" id="flightdeparture"  class="required"/>
						</td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="104"> <div align="left">Departure Time:</div></td>
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
						<td width="211"><div align="left" style="">Remember the Hotel Check Out </div></td>
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

    
    if ($tourtrip == 0){
          $id_tour = $dat->id_tour;
         // $id_tour = $id_tour1;
          
        }else{
          $id_tour =   $tourtrip;
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
                                                AND id_ratesvalid = ' .$id_tour. '    
                                                
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
                                                AND id_ratesvalid = ' .$id_tour. '
                                                 
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
                                                AND id_ratesvalid = ' .$id_tour. '
                                                
					ORDER BY type_rate';
            $rs = Doo::db()->query($sql, array($trip, $type_rate, $id_agency, $anno));
            $prices = $rs->fetch();
            //echo $anno;
            //print_r($prices);      
            
           
            
            
        }

        if (empty($prices)) {//Se le pone un valor por defecto;
            $prices['adult'] = 60;
            $prices['child'] = 60;
        }
        return $prices;
    }

    public function selectTrip1() {
        
        
        
        if (isset($this->params["from"]) && isset($this->params["to"]) && isset($this->params["fecha"]) && isset($this->params["totalpax"]) && isset($this->params["tipo_pass"]) && isset($this->params["agency"])) {
            $from = $this->params["from"];
            $to = $this->params["to"];
            $fecha_salida = $this->params["fecha"];
            $anno = substr($fecha_salida, -4);
            $resident = $this->params["tipo_pass"];
            $tipo = 1;
            $id_agency = $this->params["agency"];

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

            //$fromto = $this->params["fromto"]; 

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
                         where t2.type_rate = 2 and t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? AND t2.id_agency = ?
                         ORDER BY t2.trip_departure ASC";

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

            echo '<table class="table table-bordered table-striped" id="tbl1">
             <thead>
                 <tr>
                     <th width="8%">Select</th>
                     <th width="8%">Trip</th>
                     <th width="12%">Departure</th>
                     <th width="12%">Arrive</th>
                     <th width="20%">' . ($resident == '1' ? 'FLA. Resident Adult' : 'Regular Price Adult') . '</th>
                     <th width="20%">' . ($resident == '1' ? 'FLA. Resident Child (3-9 Yrs)' : 'Regular Price Child') . '</th>
                     <th width="20%">Equipment</th>              					  
                 </tr>
             </thead>';

            $url = Doo::conf()->APP_URL;
            if (count($salida) > 0) {
                $i = 0;
                Doo::loadController("MainController");
                $main = new MainController();
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha = $anio . '-' . $mes . '-' . $dia;
                //echo $fecha;
                foreach ($salida as $e) {
                    
                    $precioTrip1 = $this->precioTripTours($e['trip_no'], $dat->type_rate, $dat->id, $anio);
                    //echo $dat->type_rate;
                   //print_r($precioTrip1);
                    $tourtrip = $this->params["rates"];
                    //echo $tourtrip;

                    $disponible = $main->disponible($e['trip_no'], $fecha);
                    //$priceAdult = ($resident == '1' ? $e['price4'] : $e['price'] );
                    //$priceChild = ($resident == '1' ? $e['price3'] : $e['price2'] );
                    
                    $priceAdult = $precioTrip1['adult'];
                    //echo $priceAdult;
                    $priceChild = $precioTrip1['child'];
                    //echo $priceChild;
//                   
                    ////////////////////*****************tabla gigante para trabajar transport///////////////////////////
                    echo '<tr class="row' . $i . '">  
                    <td><input type="radio" name="trip1" id="trip1"  value="' . $e['trip_no'] . '" />
					<input type="hidden" name="capacidad_trip_' . $e['trip_no'] . '"  id="capacidad_trip_' . $e['trip_no'] . '" value="' . $disponible . '" />
					<input type="hidden" name="deptime1_' . $e['trip_no'] . '"  id="deptime1_' . $e['trip_no'] . '" value="' . $e['trip_departure'] . '" />
					<input type="hidden" name="arrtime1_' . $e['trip_no'] . '"  id="arrtime1_' . $e['trip_no'] . '" value="' . $e['trip_arrival'] . '" />
					</td>
                    <td>' . $e['trip_no'] . '</td>
                    <td>' . date("g:i a", strtotime($e['trip_departure'])) . '</td>
                    <td>' . date("g:i a", strtotime($e['trip_arrival'])) . '</td>
                    <td>' . $priceAdult . ' <input type="hidden" name="priceTransporAdult1_' . $e['trip_no'] . '"  id="priceTransporAdult_' . $e['trip_no'] . '" value="' . $priceAdult . '" /> 
					</td>
                    <td>' . $priceChild . '
					<input type="hidden" name="priceTransporChild_' . $e['trip_no'] . '"  id="priceTransporChild_' . $e['trip_no'] . '" value="' . $priceChild . '" />
					</td>
                    <td>' . $e['equipment'] . '</td>
                </tr>';
                    $i = 1 - $i;
                }
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
		<script>
		$(document).ready(function() {
			
			$("#btn-SelectTrip").click(function(){
				var trip = $("input[name=trip1]:checked").val();
				var child = $("#child").val();
				var adult = $("#adult").val();
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
				calcularTotalPago();
				$("#userr").load("' . $url . 'admin/tours/comisionTransport/"+trip+"/"+1);	
				return false;
			});
			$("#btn-cancelarTrip").click(function(){
					$("#popup").fadeOut("slow");
					$("#popup").hide("fade");
					$("#mascaraP").fadeOut("slow");
					$("#mascaraP").hide("fade");									 
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
            $anno = substr($fecha_salida, -4);
            $resident = $this->params["tipo_pass"];
            $tipo = 1;
            $id_agency = $this->params["agency"];

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
            //$fromto = $this->params["fromto"]; 

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
							 where t2.type_rate = 2 and t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND t2.trip_departure > '' and t1.estado = '1' and t2.anno = ? AND t2.id_agency = ?
							 ORDER BY t2.trip_departure ASC";

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

            echo '<table class="table table-bordered table-striped" id="tbl1">
             <thead>
                 <tr>
                     <th width="8%">Select</th>
                     <th width="8%">Trip</th>
                     <th width="12%">Departure</th>
                     <th width="12%">Arrive</th>
                     <th width="20%">' . ($resident == '1' ? 'FLA. Resident Adult' : 'Regular Price Adult') . '</th>
                     <th width="20%">' . ($resident == '1' ? 'FLA. Resident Child (3-9 Yrs)' : 'Regular Price Child') . '</th>
                     <th width="20%">Equipment</th>              					  
                 </tr>
             </thead>';

            $url = Doo::conf()->APP_URL;
            if (count($salida) > 0) {
                $i = 0;
                Doo::loadController("MainController");
                $main = new MainController();
                list($mes, $dia, $anio) = explode('-', $fecha_salida);
                $fecha = $anio . '-' . $mes . '-' . $dia;
                foreach ($salida as $e) {
                    $precioTrip1 = $this->precioTripTours($e['trip_no'], $dat->type_rate, $dat->id, $anio);
                    $tourtrip = $this->params["rates"];
                    //echo $tourtrip;
                    $disponible = $main->disponible($e['trip_no'], $fecha);
                    //$priceAdult = ($resident == '1' ? $e['price4'] : $e['price'] );
                    //$priceChild = ($resident == '1' ? $e['price3'] : $e['price2'] );
                    $priceAdult = $precioTrip1['adult'];
                    $priceChild = $precioTrip1['child'];
                    echo '<tr class="row' . $i . '">  
                    <td><input type="radio" name="trip1" id="trip1"  value="' . $e['trip_no'] . '" />
					<input type="hidden" name="capacidad_trip_' . $e['trip_no'] . '"  id="capacidad_trip_' . $e['trip_no'] . '" value="' . $disponible . '" />
					<input type="hidden" name="deptime2_' . $e['trip_no'] . '"  id="deptime2_' . $e['trip_no'] . '" value="' . $e['trip_departure'] . '" />
					<input type="hidden" name="arrtime2_' . $e['trip_no'] . '"  id="arrtime2_' . $e['trip_no'] . '" value="' . $e['trip_arrival'] . '" />
					</td>
                    <td>' . $e['trip_no'] . '</td>
                    <td>' . date("g:i a", strtotime($e['trip_departure'])) . '</td>
                    <td>' . date("g:i a", strtotime($e['trip_arrival'])) . '</td>
                    <td>' . $priceAdult . ' <input type="hidden" name="priceTransporAdult1_' . $e['trip_no'] . '"  id="priceTransporAdult_' . $e['trip_no'] . '" value="' . $priceAdult . '" /> 
					</td>
                    <td>' . $priceChild . '
					<input type="hidden" name="priceTransporChild_' . $e['trip_no'] . '"  id="priceTransporChild_' . $e['trip_no'] . '" value="' . $priceChild . '" />
					</td>
                    <td>' . $e['equipment'] . '</td>
                </tr>';
                    $i = 1 - $i;
                }
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
		<script>
		$(document).ready(function() {
			
			$("#btn-SelectTrip").click(function(){
				var trip = $("input[name=trip1]:checked").val();
				var child = $("#child").val();
				var adult = $("#adult").val();
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
				calcularTotalPago();
				$("#userr").load("' . $url . 'admin/tours/comisionTransport/"+trip+"/"+2);	
				return false;
			});
			
			$("#btn-cancelarTrip").click(function(){
					$("#popup").fadeOut("slow");
					$("#popup").hide("fade");
					$("#mascaraP").fadeOut("slow");
					$("#mascaraP").hide("fade");									 
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
            
            if ($tourtrip == 0){
              $id_tour = $dat->id_tour;
              //$id_tour = $id_tour1;
          
            }else{
              $id_tour =   $tourtrip;
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
                    $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? and type_rate = ? and id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                    $rs = Doo::db()->query($sql, array($totalPax, $type_rate, $dat->id, $anno));
                    $pricesbyplane = $rs->fetch();                 
                    
                    if (empty($pricesbyplane)) {
                        $type_rate = 1;
                        $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? and type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. ' ';
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
                    $sql = 'SELECT id,cantidad,price FROM tarifaplane WHERE cantidad = ? and type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
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
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. ' ';
                        $rs = Doo::db()->query($sql, array($type_rate, $dat->id, $anno));
                        $pricescar = $rs->fetch();
                        if (empty($pricescar)) {
                            $type_rate = 1;
                            $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($type_rate, $anno));
                            $pricescar = $rs->fetch();
                            if (!empty($pricescar)) {
                                $price = number_format(($pricescar ['price'])*$totalPax, 2, '.', '');
                            }
                        } else {
                            $price = number_format(($pricescar ['price'])*$totalPax, 2, '.', '');
                        }
                    } else {
                        $type_rate = 0;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                        $rs = Doo::db()->query($sql, array($type_rate, $anno));
                        $pricescar = $rs->fetch();
                        if (!empty($pricescar)) {
                            $price = number_format(($pricescar ['price'])*$totalPax, 2, '.', '');
                        }
                    }
                } 
                
                //////*******SENTIDO 2*************//////
                
                if ($sentido == 2) {
                    if ($dat->id != -1) {
                        $type_rate = 1;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and id_agency = ? and annio = ? and id_ratesvalid = ' .$id_tour. ' ';
                        $rs = Doo::db()->query($sql, array($type_rate, $dat->id, $anno));
                        $pricescar = $rs->fetch();
                        if (empty($pricescar)) {
                            $type_rate = 1;
                            $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                            $rs = Doo::db()->query($sql, array($type_rate, $anno));
                            $pricescar = $rs->fetch();
                            if (!empty($pricescar)) {
                                $price = number_format(($pricescar ['price'])*$totalPax, 2, '.', '');
                            }
                        } else {
                            $price = number_format(($pricescar ['price'])*$totalPax, 2, '.', '');
                        }
                    } else {
                        $type_rate = 0;
                        $sql = 'SELECT id,price FROM tarifacar where type_rate = ? and annio = ? and id_ratesvalid = ' .$id_tour. '';
                        $rs = Doo::db()->query($sql, array($type_rate, $anno));
                        $pricescar = $rs->fetch();
                        if (!empty($pricescar)) {
                            $price = number_format(($pricescar ['price'])*$totalPax, 2, '.', '');
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
            $rooms = $adult;//////////////////////////////////////////////
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
		<ul style="display:inline-table; border: 1px solid #000; padding: 7px;"  > ';
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
		<ul style="display:inline-table; border: 1px solid #CCCCCC;"  > ';
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
									<td>' . $dato['nochesfree'] . '</td>
									<td>' . $dato['free_night_buffet'] . '</td>
									<td title=" $ ' . number_format($dato['sgl'], 2, '.', ',') . '">' . $dato['sql_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['dbl'], 2, '.', ',') . '">' . $dato['dbl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['tpl'], 2, '.', ',') . '">' . $dato['tpl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['qua'], 2, '.', ',') . '">' . $dato['qua_indicativo'] . '</td>
									<td id="breakfastdato" title="Delete">' . $breakfastdato . '</td>
									<td id="" ><img src="' . $url . 'global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_hotel_' . $dato['id'] . '_' . $dato['id'] . '" onclick=delete_hotel("' . $dato['id'] . '"); /></td>
						           <input type="hidden" name="hotel_id_select_0" id="hotel_id_select_' . $dato['id'] . '" value="' . $dato['id'] . '">
							   <input type="hidden" name="hotel_breakfast_' . $dato['id'] . '" id="hotel_breakfast_' . $dato['id'] . '" value="' . $dato['breakfast'] . '">
							   <input type="hidden" name="hotel_buffet_' . $dato['id'] . '" id="hotel_buffet_' . $dato['id'] . '" value="1">
							   <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min="0"  value="' . $dato['nochesfree'] . '">
                                                           <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min="0"  value="' . $dato['free_night_buffet'] . '">
							   <input type="hidden" name="hotel_resort_' . $dato['id'] . '" id="hotel_resort_' . $dato['id'] . '" value="">
							   <input type="hidden" name="hotel_category_' . $dato['id'] . '" id="hotel_category_' . $dato['id'] . '" value="' . $dato['categoria'] . '">
                                                           <input type="hidden" name="hotel_subtotal_' . $dato['id'] . '" id="hotel_subtotal_' . $dato['id'] . '" value="' . $dato['total'] . '">
			 </tr>';
                    }

                   
                    echo '<input type="hidden" name="hotel_id_select" id="hotel_id_select" value="1"><script>
				$("#totalpriceNights").html(' . $total_por_pax . ');
				$("#totalpriceBreakfast").html(' . $total_priceBreakfast_pax . ');
				//$("#hotel_nochesfree_buffet").val(' . $free_night_buffet . ');
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
                                                                        <td>' . $dato['nochesfree'] . '</td>
                                                                        <td>' . $dato['free_night_buffet'] . '</td>
									<td title=" $ ' . number_format($dato['sgl'], 2, '.', ',') . '">' . $dato['sql_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['dbl'], 2, '.', ',') . '">' . $dato['dbl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['tpl'], 2, '.', ',') . '">' . $dato['tpl_indicativo'] . '</td>
									<td title=" $ ' . number_format($dato['qua'], 2, '.', ',') . '">' . $dato['qua_indicativo'] . '</td>
									<td id="breakfastdato" title="$ 0.00">' . $breakfastdato . '</td>
									<td  title="Delete"><img src="' . $url . 'global/img/admin/x01.png" style="cursor:pointer;" width="20" height="20" id="img_delete_hotel_' . $dato['id'] . '_' . $dato['id'] . '" onclick=delete_hotel("' . $dato['id'] . '"); /></td>
									<input type="hidden" name="hotel_id_select_0" id="hotel_id_select_' . $dato['id'] . '" value="' . $dato['id'] . '">
							   <input type="hidden" name="hotel_breakfast_' . $dato['id'] . '" id="hotel_breakfast_' . $dato['id'] . '" value="' . $dato['breakfast'] . '">
							   <input type="hidden" name="hotel_buffet_' . $dato['id'] . '" id="hotel_buffet_' . $dato['id'] . '" value="1">
							   <input type="hidden" name="hotel_nochesfree_' . $dato['id'] . '" id="hotel_nochesfree_' . $dato['id'] . '" min="0" value="' . $dato['nochesfree'] . '">
							   <input type="hidden" name="hotel_nochesfree_buffet_' . $dato['id'] . '" id="hotel_nochesfree_buffet_' . $dato['id'] . '" value="' . $dato['free_night_buffet'] . '">
							   <input type="hidden" name="hotel_resort_' . $dato['id'] . '" id="hotel_resort_' . $dato['id'] . '" value="">
							   <input type="hidden" name="hotel_category_' . $dato['id'] . '" id="hotel_category_' . $dato['id'] . '" value="' . $dato['categoria'] . '">
                               <input type="hidden" name="hotel_subtotal_' . $dato['id'] . '" id="hotel_subtotal_' . $dato['id'] . '" value="' . $dato['total_price'] . '">
							   </tr>';
                    }

                    echo '<input type="hidden" name="hotel_id_select" id="hotel_id_select" value="1"><script>
				$("#totalpriceNights").html(' . $total_por_pax . ');
				$("#totalpriceBreakfast").html(' . $total_priceBreakfast_pax . ');
				//$("#hotel_nochesfree_buffet").val(' . $free_night_buffet . ');
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
                                                                        <td>' . $dato['free_night_buffet'] . '</td>    
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
							   <input type="hidden" name="hotel_nochesfree_buffet_' . $dato['id'] . '" id="hotel_nochesfree_buffet_' . $dato['id'] . '" value="' . $dato['free_night_buffet'] . '">
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
				//$("#hotel_nochesfree_buffet").val(' . $free_night_buffet . ');                                
				calcularTotalPago();
		     </script>';
            echo $tabla . '</tbody></table>';
        } else {
            echo '<script>
				$("#totalpriceNights").html(0);
				$("#totalpriceBreakfast").html(0);
				//$("#hotel_nochesfree_buffet").val(0);
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
							   <input type="hidden" name="hotel_nochesfree_buffet_' . $i . '" id="hotel_nochesfree_buffet_' . $i . '" value="' . $dato['free_night_buffet'] . '">
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
        
        ////////////////////////////////////////////////Actualizacion
        $id_agency1 = $this->params["id_agency"];
        //$id_tour = $dat->id_tour;
       

        
        Doo::loadModel("Agency");
        $dat = new Agency();
        $dat->id = $id_agency1;
        $dat = Doo::db()->find($dat, array('limit' => 1));
        $type_rate = $dat->type_rate;


        if ($idpromo == 0){
          $id_tour = $dat->id_tour;
        }else{
          $id_tour =   $idpromo;
        }
        

         
         if ($type_rate == 0){  
             

                    $id_tour;
               
            }
         if ($type_rate == 1){ 
             
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

        $fecha3 = new DateTime();
        $fecha3->setTimestamp(strtotime($fechaSalida));

        $fecha4 = new DateTime();
        $fecha4->setTimestamp(strtotime($fechaSalida));

        $priceRoom1 = $priceRoom2 = $priceRoom3 = $priceRoom4 = $priceBreakfast = 0;
        //print_r($room1.' '.$room2.' '.$room3.' '.$room4);
        $totaladult = $room1 + $room2 + $room3 + $room4;
        

	$room1_c = $this->params["room1_c"];
//        echo $room1_c;
        $room2_c = $this->params["room2_c"];
//        echo $room2_c;
        $room3_c = $this->params["room3_c"];
//        echo $room3_c;
        $room4_c = $this->params["room4_c"];
//        echo $room4_c;
       
        
        $numNoches = $this->numDiasNochesFechaok($fechaSalida, $fechaRetorno);
          
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
        
        //$desayuno = $costohotel['breackfast'];
        //echo $desayuno;
        
        //echo $idrv;
        
       // GLOBAL $idrv;
       // GLOBAL $desayuno;
        
        $categor = $costohotel['categoria'];
        
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
        
       
        
        $chv21=  $costohotel['chv21'];
        $chm21=  $costohotel['chm21'];
        
        $chv32=  $costohotel['chv32'];
        $chm32=  $costohotel['chm32'];
        
        $chv43=  $costohotel['chv43'];
        $chm43=  $costohotel['chm43'];
        
        $chv54=  $costohotel['chv54'];
        $chm54=  $costohotel['chm54'];
        
        $chv65=  $costohotel['chv65'];
        $chm65=  $costohotel['chm65'];
        
        $chv76=  $costohotel['chv76'];
        $chm76=  $costohotel['chm76'];
        
        $chv87=  $costohotel['chv87'];
        $chm87=  $costohotel['chm87'];
        
        $chv98=  $costohotel['chv98'];
        $chm98=  $costohotel['chm98'];
        
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
                     
                    if ($room1 == 1) {
                        $priceRoom1 += $costohotel ['sgl']+($chv21*$room1_c)+($fdv_adult21*$room1*$free_night_buffet)+($fdv_child21*$room1_c*$free_night_buffet);  
                        //echo $priceRoom1;
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += $costohotel ['dbl']+(($chv21*$room1_c)/2)+(($fdv_adult21*$room1*$free_night_buffet)/2)+(($fdv_child21*$room1_c*$free_night_buffet)/2);
                        
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += $costohotel ['tpl']+(($chv21*$room1_c)/3)+(($fdv_adult21*$room1*$free_night_buffet)/3)+(($fdv_child21*$room1_c*$free_night_buffet)/3);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += $costohotel ['qua']+(($chv21*$room1_c)/4)+(($fdv_adult21*$room1*$free_night_buffet)/4)+(($fdv_child21*$room1_c*$free_night_buffet)/4);
                    }
                    
                }
                
        //TOUR 21 MODERATE       
                
                       
         if ($numNoches['noches'] == 1 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += $costohotel ['sglm']+($chm21*$room1_c)+($fdm_adult21*$room1*$free_night_buffet)+($fdm_child21*$room1_c*$free_night_buffet);
                        
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += $costohotel ['dblm']+(($chm21*$room1_c)/2)+(($fdm_adult21*$room1*$free_night_buffet)/2)+(($fdm_child21*$room1_c*$free_night_buffet)/2);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += $costohotel ['tplm']+(($chm21*$room1_c)/3)+(($fdm_adult21*$room1*$free_night_buffet)/3)+(($fdm_child21*$room1_c*$free_night_buffet)/3);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += $costohotel ['quam']+(($chm21*$room1_c)/4)+(($fdm_adult21*$room1*$free_night_buffet)/4)+(($fdm_child21*$room1_c*$free_night_buffet)/4);
                    }
                }        
        
        //TOUR 32 VALUE
                
        
                
        if ($numNoches['noches'] == 2 && $categor == 2 && $room1 > 0) {
            
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl2']/2)+(($chv32*$room1_c)/2)+(($fdv_adult32*$room1*$free_night_buffet)/2)+(($fdv_child32*$room1_c*$free_night_buffet)/2);
                        
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl2']/2)+(($chv32*$room1_c)/4)+(($fdv_adult32*$room1*$free_night_buffet)/4)+(($fdv_child32*$room1_c*$free_night_buffet)/4);
                        
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl2']/2)+(($chv32*$room1_c)/6)+(($fdv_adult32*$room1*$free_night_buffet)/6)+(($fdv_child32*$room1_c*$free_night_buffet)/6);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua2']/2)+(($chv32*$room1_c)/8)+(($fdv_adult32*$room1*$free_night_buffet)/8)+(($fdv_child32*$room1_c*$free_night_buffet)/8);
                    }
                }  
                
        //TOUR 32 MODERATE
                
                       
         if ($numNoches['noches'] == 2 && $categor == 3 && $room1 > 0) {
                    
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm2']/2)+(($chm32*$room1_c)/2)+(($fdm_adult32*$room1*$free_night_buffet)/2)+(($fdm_child32*$room1_c*$free_night_buffet)/2);
                       
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm2']/2)+(($chm32*$room1_c)/4)+(($fdm_adult32*$room1*$free_night_buffet)/4)+(($fdm_child32*$room1_c*$free_night_buffet)/4);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm2']/2)+(($chm32*$room1_c)/6)+(($fdm_adult32*$room1*$free_night_buffet)/6)+(($fdm_child32*$room1_c*$free_night_buffet)/6);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam2']/2)+(($chm32*$room1_c)/8)+(($fdm_adult32*$room1*$free_night_buffet)/8)+(($fdm_child32*$room1_c*$free_night_buffet)/8);
                    }
                }       
        
        //TOUR 43 VALUE
                
            
                
        if ($numNoches['noches'] == 3 && $categor == 2 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl3']/3)+(($chv43*$room1_c)/3)+(($fdv_adult43*$room1*$free_night_buffet)/3)+(($fdv_child43*$room1_c*$free_night_buffet)/3);
                                               
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl3']/3)+(($chv43*$room1_c)/6)+(($fdv_adult43*$room1*$free_night_buffet)/6)+(($fdv_child43*$room1_c*$free_night_buffet)/6);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl3']/3)+(($chv43*$room1_c)/9)+(($fdv_adult43*$room1*$free_night_buffet)/9)+(($fdv_child43*$room1_c*$free_night_buffet)/9);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua3']/3)+(($chv43*$room1_c)/12)+(($fdv_adult43*$room1*$free_night_buffet)/12)+(($fdv_child43*$room1_c*$free_night_buffet)/12);
                    }
                }       
        //TOUR 43 MODERATE
                
                        
        if ($numNoches['noches'] == 3 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm3']/3)+(($chm43*$room1_c)/3)+(($fdm_adult43*$room1*$free_night_buffet)/3)+(($fdm_child43*$room1_c*$free_night_buffet)/3);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm3']/3)+(($chm43*$room1_c)/6)+(($fdm_adult43*$room1*$free_night_buffet)/6)+(($fdm_child43*$room1_c*$free_night_buffet)/3);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm3']/3)+(($chm43*$room1_c)/9)+(($fdm_adult43*$room1*$free_night_buffet)/9)+(($fdm_child43*$room1_c*$free_night_buffet)/9);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam3']/3)+(($chm43*$room1_c)/12)+(($fdm_adult43*$room1*$free_night_buffet)/12)+(($fdm_child43*$room1_c*$free_night_buffet)/12);
                    }
                }       
        
        //TOUR 54 VALUE 
                
                       
        if ($numNoches['noches'] == 4 && $categor == 2 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl4']/4)+(($chv54*$room1_c)/4)+(($fdv_adult54*$room1*$free_night_buffet)/4)+(($fdv_child54*$room1_c*$free_night_buffet)/4);
                   
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl4']/4)+(($chv54*$room1_c)/8)+(($fdv_adult54*$room1*$free_night_buffet)/8)+(($fdv_child54*$room1_c*$free_night_buffet)/8);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl4']/4)+(($chv54*$room1_c)/12)+(($fdv_adult54*$room1*$free_night_buffet)/12)+(($fdv_child54*$room1_c*$free_night_buffet)/12);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua4']/4)+(($chv54*$room1_c)/16)+(($fdv_adult54*$room1*$free_night_buffet)/16)+(($fdv_child54*$room1_c*$free_night_buffet)/16);
                    }
                }
        //TOUR 54 MODERATE
                
                   
        
                
        if ($numNoches['noches'] == 4 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm4']/4)+(($chm54*$room1_c)/4)+(($fdm_adult54*$room1*$free_night_buffet)/4)+(($fdm_child54*$room1_c*$free_night_buffet)/4);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm4']/4)+(($chm54*$room1_c)/8)+(($fdm_adult54*$room1*$free_night_buffet)/8)+(($fdm_child54*$room1_c*$free_night_buffet)/8);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm4']/4)+(($chm54*$room1_c)/12)+(($fdm_adult54*$room1*$free_night_buffet)/12)+(($fdm_child54*$room1_c*$free_night_buffet)/12);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam4']/4)+(($chm54*$room1_c)/16)+(($fdm_adult54*$room1*$free_night_buffet)/16)+(($fdm_child54*$room1_c*$free_night_buffet)/16);
                    }
                }   
        //TOUR 65 VALUE
                
               
                      
        if ($numNoches['noches'] == 5 && $categor == 2 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl5']/5)+(($chv65*$room1_c)/5)+(($fdv_adult65*$room1*$free_night_buffet)/5)+(($fdv_child65*$room1_c*$free_night_buffet)/5);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl5']/5)+(($chv65*$room1_c)/10)+(($fdv_adult65*$room1*$free_night_buffet)/10)+(($fdv_child65*$room1_c*$free_night_buffet)/10);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl5']/5)+(($chv65*$room1_c)/15)+(($fdv_adult65*$room1*$free_night_buffet)/15)+(($fdv_child65*$room1_c*$free_night_buffet)/15);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua5']/5)+(($chv65*$room1_c)/20)+(($fdv_adult65*$room1*$free_night_buffet)/20)+(($fdv_child65*$room1_c*$free_night_buffet)/20);
                    }
                } 
                
        //TOUR 65 MODERATE
                
             
                
         if ($numNoches['noches'] == 5 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm5'])/5+(($chm65*$room1_c)/5)+(($fdm_adult65*$room1*$free_night_buffet)/5)+(($fdm_child65*$room1_c*$free_night_buffet)/5);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm5'])/5+(($chm65*$room1_c)/10)+(($fdm_adult65*$room1*$free_night_buffet)/10)+(($fdm_child65*$room1_c*$free_night_buffet)/10);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm5'])/5+(($chm65*$room1_c)/15)+(($fdm_adult65*$room1*$free_night_buffet)/15)+(($fdm_child65*$room1_c*$free_night_buffet)/15);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam5'])/5+(($chm65*$room1_c)/20)+(($fdm_adult65*$room1*$free_night_buffet)/20)+(($fdm_child65*$room1_c*$free_night_buffet)/20);
                    }
                } 
                
        //TOUR 76 VALUE
                
                  
                
         if ($numNoches['noches'] == 6 && $categor == 2 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl6'])/6+(($chv76*$room1_c)/6)+(($fdv_adult76*$room1*$free_night_buffet)/6)+(($fdv_child76*$room1_c*$free_night_buffet)/6);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl6'])/6+(($chv76*$room1_c)/12)+(($fdv_adult76*$room1*$free_night_buffet)/12)+(($fdv_child76*$room1_c*$free_night_buffet)/12);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl6'])/6+(($chv76*$room1_c)/18)+(($fdv_adult76*$room1*$free_night_buffet)/18)+(($fdv_child76*$room1_c*$free_night_buffet)/18);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua6'])/6+(($chv76*$room1_c)/24)+(($fdv_adult76*$room1*$free_night_buffet)/24)+(($fdv_child76*$room1_c*$free_night_buffet)/24);
                    }
                }
                
        //TOUR 76 MODERATE 
                
       
                
                
        if ($numNoches['noches'] == 6 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm6'])/6+(($chm76*$room1_c)/6)+(($fdm_adult76*$room1*$free_night_buffet)/6)+(($fdm_child76*$room1_c*$free_night_buffet)/6);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm6'])/6+(($chm76*$room1_c)/12)+(($fdm_adult76*$room1*$free_night_buffet)/12)+(($fdm_child76*$room1_c*$free_night_buffet)/12);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm6'])/6+(($chm76*$room1_c)/18)+(($fdm_adult76*$room1*$free_night_buffet)/18)+(($fdm_child76*$room1_c*$free_night_buffet)/18);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam6'])/6+(($chm76*$room1_c)/24)+(($fdm_adult76*$room1*$free_night_buffet)/24)+(($fdm_child76*$room1_c*$free_night_buffet)/24);
                    }
                }        
       //************************************************************************************************************************************         
        //TOUR 87 VALUE
                
        
                
        if ($numNoches['noches'] == 7 && $categor == 2 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl7'])/7+(($chv87*$room1_c)/7)+(($fdv_adult87*$room1*$free_night_buffet)/7)+(($fdv_child87*$room1_c*$free_night_buffet)/7);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl7'])/7+(($chv87*$room1_c)/14)+(($fdv_adult87*$room1*$free_night_buffet)/14)+(($fdv_child87*$room1_c*$free_night_buffet)/14);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl7'])/7+(($chv87*$room1_c)/21)+(($fdv_adult87*$room1*$free_night_buffet)/21)+(($fdv_child87*$room1_c*$free_night_buffet)/21);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua7'])/7+(($chv87*$room1_c)/28)+(($fdv_adult87*$room1*$free_night_buffet)/28)+(($fdv_child87*$room1_c*$free_night_buffet)/28);
                    }
                }               
                
        //TOUR 87 MODERATE
        
              
        if ($numNoches['noches'] == 7 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm7'])/7+(($chm87*$room1_c)/7)+(($fdm_adult87*$room1*$free_night_buffet)/7)+(($fdm_child87*$room1_c*$free_night_buffet)/7);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm7'])/7+(($chm87*$room1_c)/14)+(($fdm_adult87*$room1*$free_night_buffet)/14)+(($fdm_child87*$room1_c*$free_night_buffet)/14);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm7'])/7+(($chm87*$room1_c)/21)+(($fdm_adult87*$room1*$free_night_buffet)/21)+(($fdm_child87*$room1_c*$free_night_buffet)/21);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam7'])/7+(($chm87*$room1_c)/28)+(($fdm_adult87*$room1*$free_night_buffet)/28)+(($fdm_child87*$room1_c*$free_night_buffet)/28);
                    }
                }               
                
        //TOUR 98 VALUE
                
                
               
        if ($numNoches['noches'] == 8 && $categor == 2 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sgl8'])/8+(($chv98*$room1_c)/8)+(($fdv_adult98*$room1*$free_night_buffet)/8)+(($fdv_child98*$room1_c*$free_night_buffet)/8);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dbl8'])/8+(($chv98*$room1_c)/16)+(($fdv_adult98*$room1*$free_night_buffet)/16)+(($fdv_child98*$room1_c*$free_night_buffet)/16);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tpl8'])/8+(($chv98*$room1_c)/24)+(($fdv_adult98*$room1*$free_night_buffet)/24)+(($fdv_child98*$room1_c*$free_night_buffet)/24);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['qua8'])/8+(($chv98*$room1_c)/32)+(($fdv_adult98*$room1*$free_night_buffet)/32)+(($fdv_child98*$room1_c*$free_night_buffet)/32);
                    }
                }  
                
        //TOUR 98 MODERATE
                
                        
        if ($numNoches['noches'] == 8 && $categor == 3 && $room1 > 0) {
                        
                    if ($room1 == 1) {
                        $priceRoom1 += ($costohotel ['sglm8'])/8+(($chm98*$room1_c)/8)+(($fdm_adult98*$room1*$free_night_buffet)/8)+(($fdm_child98*$room1_c*$free_night_buffet)/8);
                    }
                    if ($room1 == 2) {
                        $priceRoom1 += ($costohotel ['dblm8'])/8+(($chm98*$room1_c)/16)+(($fdm_adult98*$room1*$free_night_buffet)/16)+(($fdm_child98*$room1_c*$free_night_buffet)/16);
                    }
                    if ($room1 == 3) {
                        $priceRoom1 += ($costohotel ['tplm8'])/8+(($chm98*$room1_c)/24)+(($fdm_adult98*$room1*$free_night_buffet)/24)+(($fdm_child98*$room1_c*$free_night_buffet)/24);
                    }
                    if ($room1 == 4) {
                        $priceRoom1 += ($costohotel ['quam8'])/8+(($chm98*$room1_c)/32)+(($fdm_adult98*$room1*$free_night_buffet)/32)+(($fdm_child98*$room1_c*$free_night_buffet)/32);
                    }
                }  
        
                    date_add($fecha, date_interval_create_from_date_string('1 days'));
                    $contador++;
//                    print_r(Doo::db()->showSQL());
                }
//                exit;
                //$priceRoom1 = (round($priceRoom1) * $room1);
                $priceRoom1 = $priceRoom1*$room1;
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
                   
                        
                    
                    if ($numNoches['noches'] == 1 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {
                                                  
                        //($chv21*$room1_c)+($fdv_adult21*$room1*$free_night_buffet)+($fdv_child21*$room1_c*$free_night_buffet);
                        $priceRoom2 += $costohotel ['sgl']+($chv21*$room2_c)+($fdv_adult21*$room2*$free_night_buffet)+($fdv_child21*$room2_c*$free_night_buffet);
                        //echo $priceRoom2;
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += $costohotel ['dbl']+(($chv21*$room2_c)/2)+(($fdv_adult21*$room2*$free_night_buffet)/2)+(($fdv_child21*$room2_c*$free_night_buffet)/2);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += $costohotel ['tpl']+(($chv21*$room2_c)/3)+(($fdv_adult21*$room2*$free_night_buffet)/3)+(($fdv_child21*$room2_c*$free_night_buffet)/3);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += $costohotel ['qua']+(($chv21*$room2_c)/4)+(($fdv_adult21*$room2*$free_night_buffet)/4)+(($fdv_child21*$room2_c*$free_night_buffet)/4);
                    }
                    
                    }
                    
                    //TOUR 21 MODERATE
                    
                                       
                    if ($numNoches['noches'] == 1 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += $costohotel ['sglm']+($chm21*$room2_c)+($fdm_adult21*$room2*$free_night_buffet)+($fdm_child21*$room2_c*$free_night_buffet);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += $costohotel ['dblm']+(($chm21*$room2_c)/2)+(($fdm_adult21*$room2*$free_night_buffet)/2)+(($fdm_child21*$room2_c*$free_night_buffet)/2);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += $costohotel ['tplm']+(($chm21*$room2_c)/3)+(($fdm_adult21*$room2*$free_night_buffet)/3)+(($fdm_child21*$room2_c*$free_night_buffet)/3);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += $costohotel ['quam']+(($chm21*$room2_c)/4)+(($fdm_adult21*$room2*$free_night_buffet)/4)+(($fdm_child21*$room2_c*$free_night_buffet)/4);
                    }
                    
                    }
                    
                    //TOUR 32 VALUE
                    
                                      
                    if ($numNoches['noches'] == 2 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl2'])/2+(($chv32*$room2_c)/2)+(($fdv_adult32*$room2*$free_night_buffet)/2)+(($fdv_child32*$room2_c*$free_night_buffet)/2);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl2'])/2+(($chv32*$room2_c)/4)+(($fdv_adult32*$room2*$free_night_buffet)/4)+(($fdv_child32*$room2_c*$free_night_buffet)/4);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl2'])/2+(($chv32*$room2_c)/6)+(($fdv_adult32*$room2*$free_night_buffet)/6)+(($fdv_child32*$room2_c*$free_night_buffet)/6);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua2'])/2+(($chv32*$room2_c)/8)+(($fdv_adult32*$room2*$free_night_buffet)/8)+(($fdv_child32*$room2_c*$free_night_buffet)/8);
                    }
                    
                    }
                    
                    
                    //TOUR 32 MODERATE
                    
                            
                    
                    if ($numNoches['noches'] == 2 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm2'])/2+(($chm32*$room2_c)/2)+(($fdm_adult32*$room2*$free_night_buffet)/2)+(($fdm_child32*$room2_c*$free_night_buffet)/2);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm2'])/2+(($chm32*$room2_c)/4)+(($fdm_adult32*$room2*$free_night_buffet)/4)+(($fdm_child32*$room2_c*$free_night_buffet)/4);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm2'])/2+(($chm32*$room2_c)/6)+(($fdm_adult32*$room2*$free_night_buffet)/6)+(($fdm_child32*$room2_c*$free_night_buffet)/6);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam2'])/2+(($chm32*$room2_c)/8)+(($fdm_adult32*$room2*$free_night_buffet)/8)+(($fdm_child32*$room2_c*$free_night_buffet)/8);
                    }
                    
                    }
                    
                    //TOUR 43 VALUE
                    
                                      
                    if ($numNoches['noches'] == 3 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl3'])/3+(($chv43*$room2_c)/3)+(($fdv_adult43*$room2*$free_night_buffet)/3)+(($fdv_child43*$room2_c*$free_night_buffet)/3);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl3'])/3+(($chv43*$room2_c)/6)+(($fdv_adult43*$room2*$free_night_buffet)/6)+(($fdv_child43*$room2_c*$free_night_buffet)/6);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl3'])/3+(($chv43*$room2_c)/9)+(($fdv_adult43*$room2*$free_night_buffet)/9)+(($fdv_child43*$room2_c*$free_night_buffet)/9);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua3'])/3+(($chv43*$room2_c)/12)+(($fdv_adult43*$room2*$free_night_buffet)/12)+(($fdv_child43*$room2_c*$free_night_buffet)/12);
                    }
                    
                    }
                    
                    //TOUR 43 MODERATE
                    
                                      
                    
                    if ($numNoches['noches'] == 3 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm3'])/3+(($chm43*$room2_c)/3)+(($fdm_adult43*$room2*$free_night_buffet)/3)+(($fdm_child43*$room2_c*$free_night_buffet)/3);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm3'])/3+(($chm43*$room2_c)/6)+(($fdm_adult43*$room2*$free_night_buffet)/6)+(($fdm_child43*$room2_c*$free_night_buffet)/6);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm3'])/3+(($chm43*$room2_c)/9)+(($fdm_adult43*$room2*$free_night_buffet)/9)+(($fdm_child43*$room2_c*$free_night_buffet)/9);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam3'])/3+(($chm43*$room2_c)/12)+(($fdm_adult43*$room2*$free_night_buffet)/12)+(($fdm_child43*$room2_c*$free_night_buffet)/12);
                    }
                    
                    }
                    
                    //TOUR 54 VALUE
                    
                    
                                       
                    if ($numNoches['noches'] == 4 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl4'])/4+(($chv54*$room2_c)/4)+(($fdv_adult54*$room2*$free_night_buffet)/4)+(($fdv_child54*$room2_c*$free_night_buffet)/4);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl4'])/4+(($chv54*$room2_c)/8)+(($fdv_adult54*$room2*$free_night_buffet)/8)+(($fdv_child54*$room2_c*$free_night_buffet)/8);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl4'])/4+(($chv54*$room2_c)/12)+(($fdv_adult54*$room2*$free_night_buffet)/12)+(($fdv_child54*$room2_c*$free_night_buffet)/12);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua4'])/4+(($chv54*$room2_c)/16)+(($fdv_adult54*$room2*$free_night_buffet)/16)+(($fdv_child54*$room2_c*$free_night_buffet)/16);
                    }
                    
                    }
                    
                    
                     //TOUR 54 MODERATE
                    
                                       
                    if ($numNoches['noches'] == 4 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm4'])/4+(($chm54*$room2_c)/4)+(($fdm_adult54*$room2*$free_night_buffet)/4)+(($fdm_child54*$room2_c*$free_night_buffet)/4);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm4'])/4+(($chm54*$room2_c)/8)+(($fdm_adult54*$room2*$free_night_buffet)/8)+(($fdm_child54*$room2_c*$free_night_buffet)/8);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm4'])/4+(($chm54*$room2_c)/12)+(($fdm_adult54*$room2*$free_night_buffet)/12)+(($fdm_child54*$room2_c*$free_night_buffet)/12);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam4'])/4+(($chm54*$room2_c)/16)+(($fdm_adult54*$room2*$free_night_buffet)/16)+(($fdm_child54*$room2_c*$free_night_buffet)/16);
                    }
                    
                    }
                    
                    //TOUR 65 VALUE
                    
                    
                    if ($numNoches['noches'] == 5 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl5'])/5+(($chv65*$room2_c)/5)+(($fdv_adult65*$room2*$free_night_buffet)/5)+(($fdv_child65*$room2_c*$free_night_buffet)/5);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl5'])/5+(($chv65*$room2_c)/10)+(($fdv_adult65*$room2*$free_night_buffet)/10)+(($fdv_child65*$room2_c*$free_night_buffet)/10);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl5'])/5+(($chv65*$room2_c)/15)+(($fdv_adult65*$room2*$free_night_buffet)/15)+(($fdv_child65*$room2_c*$free_night_buffet)/15);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua5'])/5+(($chv65*$room2_c)/20)+(($fdv_adult65*$room2*$free_night_buffet)/20)+(($fdv_child65*$room2_c*$free_night_buffet)/20);
                    }
                    
                    }
                    
                    //TOUR 65 MODERATE
                    
                                       
                    if ($numNoches['noches'] == 5 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm5'])/5+(($chm65*$room2_c)/5)+(($fdm_adult65*$room2*$free_night_buffet)/5)+(($fdm_child65*$room2_c*$free_night_buffet)/5);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm5'])/5+(($chm65*$room2_c)/10)+(($fdm_adult65*$room2*$free_night_buffet)/10)+(($fdm_child65*$room2_c*$free_night_buffet)/10);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm5'])/5+(($chm65*$room2_c)/15)+(($fdm_adult65*$room2*$free_night_buffet)/15)+(($fdm_child65*$room2_c*$free_night_buffet)/15);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam5'])/5+(($chm65*$room2_c)/20)+(($fdm_adult65*$room2*$free_night_buffet)/20)+(($fdm_child65*$room2_c*$free_night_buffet)/20);
                    }
                    
                    }
                    
                    //TOUR 76 VALUE
                    
                    
                    
                    if ($numNoches['noches'] == 6 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl6'])/6+(($chv76*$room2_c)/6)+(($fdv_adult76*$room2*$free_night_buffet)/6)+(($fdv_child76*$room2_c*$free_night_buffet)/6);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl6'])/6+(($chv76*$room2_c)/12)+(($fdv_adult76*$room2*$free_night_buffet)/12)+(($fdv_child76*$room2_c*$free_night_buffet)/12);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl6'])/6+(($chv76*$room2_c)/18)+(($fdv_adult76*$room2*$free_night_buffet)/18)+(($fdv_child76*$room2_c*$free_night_buffet)/18);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua6'])/6+(($chv76*$room2_c)/24)+(($fdv_adult76*$room2*$free_night_buffet)/24)+(($fdv_child76*$room2_c*$free_night_buffet)/24);
                    }
                    
                    }
                    
                    //TOUR 76 MODERATE
                    
                    
                    if ($numNoches['noches'] == 6 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm6'])/6+(($chm76*$room2_c)/6)+(($fdm_adult76*$room2*$free_night_buffet)/6)+(($fdm_child76*$room2_c*$free_night_buffet)/6);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm6'])/6+(($chm76*$room2_c)/12)+(($fdm_adult76*$room2*$free_night_buffet)/12)+(($fdm_child76*$room2_c*$free_night_buffet)/12);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm6'])/6+(($chm76*$room2_c)/18)+(($fdm_adult76*$room2*$free_night_buffet)/18)+(($fdm_child76*$room2_c*$free_night_buffet)/18);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam6'])/6+(($chm76*$room2_c)/24)+(($fdm_adult76*$room2*$free_night_buffet)/24)+(($fdm_child76*$room2_c*$free_night_buffet)/24);
                    }
                    
                    }
                    
                    //TOUR 87 VALUE 
                    
                    
                                       
                    if ($numNoches['noches'] == 7 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl7'])/7+(($chv87*$room2_c)/7)+(($fdv_adult87*$room2*$free_night_buffet)/7)+(($fdv_child87*$room2_c*$free_night_buffet)/7);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl7'])/7+(($chv87*$room2_c)/14)+(($fdv_adult87*$room2*$free_night_buffet)/14)+(($fdv_child87*$room2_c*$free_night_buffet)/14);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl7'])/7+(($chv87*$room2_c)/21)+(($fdv_adult87*$room2*$free_night_buffet)/21)+(($fdv_child87*$room2_c*$free_night_buffet)/21);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua7'])/7+(($chv87*$room2_c)/28)+(($fdv_adult87*$room2*$free_night_buffet)/28)+(($fdv_child87*$room2_c*$free_night_buffet)/28);
                    }
                    
                    }
                    
                    //TOUR 87 MODERATE
                    
                          
                    
                    if ($numNoches['noches'] == 7 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm7'])/7+(($chm87*$room2_c)/7)+(($fdm_adult87*$room2*$free_night_buffet)/7)+(($fdm_child87*$room2_c*$free_night_buffet)/7);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm7'])/7+(($chm87*$room2_c)/14)+(($fdm_adult87*$room2*$free_night_buffet)/14)+(($fdm_child87*$room2_c*$free_night_buffet)/14);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm7'])/7+(($chm87*$room2_c)/21)+(($fdm_adult87*$room2*$free_night_buffet)/21)+(($fdm_child87*$room2_c*$free_night_buffet)/21);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam7'])/7+(($chm87*$room2_c)/28)+(($fdm_adult87*$room2*$free_night_buffet)/28)+(($fdm_child87*$room2_c*$free_night_buffet)/28);
                    }
                    
                    }
                    
                    // TOUR 98 VALUE
                    
                                  
                    
                    if ($numNoches['noches'] == 8 && $categor == 2 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sgl8'])/8+(($chv98*$room2_c)/8)+(($fdv_adult98*$room2*$free_night_buffet)/8)+(($fdv_child98*$room2_c*$free_night_buffet)/8);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dbl8'])/8+(($chv98*$room2_c)/16)+(($fdv_adult98*$room2*$free_night_buffet)/16)+(($fdv_child98*$room2_c*$free_night_buffet)/16);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tpl8'])/8+(($chv98*$room2_c)/24)+(($fdv_adult98*$room2*$free_night_buffet)/24)+(($fdv_child98*$room2_c*$free_night_buffet)/24);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['qua8'])/8+(($chv98*$room2_c)/32)+(($fdv_adult98*$room2*$free_night_buffet)/32)+(($fdv_child98*$room2_c*$free_night_buffet)/32);
                    }
                    
                    }
                    
                    //TOUR 98 MODERATE
                    
                                       
                    if ($numNoches['noches'] == 8 && $categor == 3 && $room2 > 0){
                        
                    if ($room2 == 1) {

                        $priceRoom2 += ($costohotel ['sglm8'])/8+(($chm98*$room2_c)/8)+(($fdm_adult98*$room2*$free_night_buffet)/8)+(($fdm_child98*$room2_c*$free_night_buffet)/8);
                    }
                    if ($room2 == 2) {

                        $priceRoom2 += ($costohotel ['dblm8'])/8+(($chm98*$room2_c)/16)+(($fdm_adult98*$room2*$free_night_buffet)/16)+(($fdm_child98*$room2_c*$free_night_buffet)/16);
                    }
                    if ($room2 == 3) {

                        $priceRoom2 += ($costohotel ['tplm8'])/8+(($chm98*$room2_c)/24)+(($fdm_adult98*$room2*$free_night_buffet)/24)+(($fdm_child98*$room2_c*$free_night_buffet)/24);
                    }
                    if ($room2 == 4) {

                        $priceRoom2 += ($costohotel ['quam8'])/8+(($chm98*$room2_c)/32)+(($fdm_adult98*$room2*$free_night_buffet)/32)+(($fdm_child98*$room2_c*$free_night_buffet)/32);
                    }
                    
                    }
                    
                    if ($room2 == 0) {

                        $priceRoom2 = 0;
                    }

                    date_add($fecha2, date_interval_create_from_date_string('1 days'));
                    $contador++;
                }

                //$priceRoom2 = round($priceRoom2) * $room2;
                $priceRoom2 = $priceRoom2*$room2;
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
                        
                    if ($room3 == 1) {

                        $priceRoom3 += $costohotel ['sgl']+($chv21*$room3_c)+($fdv_adult21*$room3*$free_night_buffet)+($fdv_child21*$room3_c*$free_night_buffet);
                        //echo $priceRoom3;
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += $costohotel ['dbl']+(($chv21*$room3_c)/2)+(($fdv_adult21*$room3*$free_night_buffet)/2)+(($fdv_child21*$room3_c*$free_night_buffet)/2);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += $costohotel ['tpl']+(($chv21*$room3_c)/3)+(($fdv_adult21*$room3*$free_night_buffet)/3)+(($fdv_child21*$room3_c*$free_night_buffet)/3);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += $costohotel ['qua']+(($chv21*$room3_c)/4)+(($fdv_adult21*$room3*$free_night_buffet)/4)+(($fdv_child21*$room3_c*$free_night_buffet)/4);
                    }
                    
                    }
                    
                     //TOUR 21 MODERATE
                    
                    
                    
                    if ($numNoches['noches'] == 1 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += $costohotel ['sglm']+($chm21*$room3_c)+($fdm_adult21*$room3*$free_night_buffet)+($fdm_child21*$room3_c*$free_night_buffet);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += $costohotel ['dblm']+(($chm21*$room3_c)/2)+(($fdm_adult21*$room3*$free_night_buffet)/2)+(($fdm_child21*$room3_c*$free_night_buffet)/2);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += $costohotel ['tplm']+(($chm21*$room3_c)/3)+(($fdm_adult21*$room3*$free_night_buffet)/3)+(($fdm_child21*$room3_c*$free_night_buffet)/3);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += $costohotel ['quam']+(($chm21*$room3_c)/4)+(($fdm_adult21*$room3*$free_night_buffet)/4)+(($fdm_child21*$room3_c*$free_night_buffet)/4);
                    }
                    
                    }
                    
                    //TOUR 32 VALUE
                    
                    
                    
                    if ($numNoches['noches'] == 2 && $categor == 2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl2'])/2+(($chv32*$room3_c)/2)+(($fdv_adult32*$room3*$free_night_buffet)/2)+(($fdv_child32*$room3_c*$free_night_buffet)/2);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl2'])/2+(($chv32*$room3_c)/4)+(($fdv_adult32*$room3*$free_night_buffet)/4)+(($fdv_child32*$room3_c*$free_night_buffet)/4);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl2'])/2+(($chv32*$room3_c)/6)+(($fdv_adult32*$room3*$free_night_buffet)/6)+(($fdv_child32*$room3_c*$free_night_buffet)/6);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua2'])/2+(($chv32*$room3_c)/8)+(($fdv_adult32*$room3*$free_night_buffet)/8)+(($fdv_child32*$room3_c*$free_night_buffet)/8);
                    }
                    
                    }
                    
                    
                    //TOUR 32 MODERATE
                    
                    
                    
                    if ($numNoches['noches'] == 2 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm2'])/2+(($chm32*$room3_c)/2)+(($fdm_adult32*$room3*$free_night_buffet)/2)+(($fdm_child32*$room3_c*$free_night_buffet)/2);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm2'])/2+(($chm32*$room3_c)/4)+(($fdm_adult32*$room3*$free_night_buffet)/4)+(($fdm_child32*$room3_c*$free_night_buffet)/4);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm2'])/2+(($chm32*$room3_c)/6)+(($fdm_adult32*$room3*$free_night_buffet)/6)+(($fdm_child32*$room3_c*$free_night_buffet)/6);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam2'])/2+(($chm32*$room3_c)/8)+(($fdm_adult32*$room3*$free_night_buffet)/8)+(($fdm_child32*$room3_c*$free_night_buffet)/8);
                    }
                    
                    }
                    
                     //TOUR 43 VALUE
                    
                    
                    
                    if ($numNoches['noches'] == 3 && $categor == 2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl3'])/3+(($chv43*$room3_c)/3)+(($fdv_adult43*$room3*$free_night_buffet)/3)+(($fdv_child43*$room3_c*$free_night_buffet)/3);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl3'])/3+(($chv43*$room3_c)/6)+(($fdv_adult43*$room3*$free_night_buffet)/6)+(($fdv_child43*$room3_c*$free_night_buffet)/6);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl3'])/3+(($chv43*$room3_c)/9)+(($fdv_adult43*$room3*$free_night_buffet)/9)+(($fdv_child43*$room3_c*$free_night_buffet)/9);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua3'])/3+(($chv43*$room3_c)/12)+(($fdv_adult43*$room3*$free_night_buffet)/12)+(($fdv_child43*$room3_c*$free_night_buffet)/12);
                    }
                    
                    }
                    
                    //TOUR 43 MODERATE
                    
                             
                    
                    if ($numNoches['noches'] == 3 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm3'])/3+(($chm43*$room3_c)/3)+(($fdm_adult43*$room3*$free_night_buffet)/3)+(($fdm_child43*$room3_c*$free_night_buffet)/3);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm3'])/3+(($chm43*$room3_c)/6)+(($fdm_adult43*$room3*$free_night_buffet)/6)+(($fdm_child43*$room3_c*$free_night_buffet)/6);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm3'])/3+(($chm43*$room3_c)/9)+(($fdm_adult43*$room3*$free_night_buffet)/9)+(($fdm_child43*$room3_c*$free_night_buffet)/9);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam3'])/3+(($chm43*$room3_c)/12)+(($fdm_adult43*$room3*$free_night_buffet)/12)+(($fdm_child43*$room3_c*$free_night_buffet)/12);
                    }
                    
                    }
                    
                    //TOUR 54 VALUE
                    
                    
                                   
                    if ($numNoches['noches'] == 4 && $categor == 2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl4'])/4+(($chv54*$room3_c)/4)+(($fdv_adult54*$room3*$free_night_buffet)/4)+(($fdv_child54*$room3_c*$free_night_buffet)/4);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl4'])/4+(($chv54*$room3_c)/8)+(($fdv_adult54*$room3*$free_night_buffet)/8)+(($fdv_child54*$room3_c*$free_night_buffet)/8);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl4'])/4+(($chv54*$room3_c)/12)+(($fdv_adult54*$room3*$free_night_buffet)/12)+(($fdv_child54*$room3_c*$free_night_buffet)/12);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua4'])/4+(($chv54*$room3_c)/16)+(($fdv_adult54*$room3*$free_night_buffet)/16)+(($fdv_child54*$room3_c*$free_night_buffet)/16);
                    }
                    
                    }
                    
                    //TOUR 54 MODERATE
                    
                                        
                    if ($numNoches['noches'] == 4 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm4'])/4+(($chm54*$room3_c)/4)+(($fdm_adult54*$room3*$free_night_buffet)/4)+(($fdm_child54*$room3_c*$free_night_buffet)/4);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm4'])/4+(($chm54*$room3_c)/8)+(($fdm_adult54*$room3*$free_night_buffet)/8)+(($fdm_child54*$room3_c*$free_night_buffet)/8);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm4'])/4+(($chm54*$room3_c)/12)+(($fdm_adult54*$room3*$free_night_buffet)/12)+(($fdm_child54*$room3_c*$free_night_buffet)/12);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam4'])/4+(($chm54*$room3_c)/16)+(($fdm_adult54*$room3*$free_night_buffet)/16)+(($fdm_child54*$room3_c*$free_night_buffet)/16);
                    }
                    
                    }
                    
                    // TOUR 65 VALUE
                    
                    
                                        
                    if ($numNoches['noches'] == 5 && $categor == 2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl5'])/5+(($chv65*$room3_c)/5)+(($fdv_adult65*$room3*$free_night_buffet)/5)+(($fdv_child65*$room3_c*$free_night_buffet)/5);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl5'])/5+(($chv65*$room3_c)/10)+(($fdv_adult65*$room3*$free_night_buffet)/10)+(($fdv_child65*$room3_c*$free_night_buffet)/10);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl5'])/5+(($chv65*$room3_c)/15)+(($fdv_adult65*$room3*$free_night_buffet)/15)+(($fdv_child65*$room3_c*$free_night_buffet)/15);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua5'])/5+(($chv65*$room3_c)/20)+(($fdv_adult65*$room3*$free_night_buffet)/20)+(($fdv_child65*$room3_c*$free_night_buffet)/20);
                    }
                    
                    }
                    
                    //TOUR 65 MODERATE
                    
                                    
                    
                    if ($numNoches['noches'] == 5 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm5'])/5+(($chm65*$room3_c)/5)+(($fdm_adult65*$room3*$free_night_buffet)/5)+(($fdm_child65*$room3_c*$free_night_buffet)/5);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm5'])/5+(($chm65*$room3_c)/10)+(($fdm_adult65*$room3*$free_night_buffet)/10)+(($fdm_child65*$room3_c*$free_night_buffet)/10);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm5'])/5+(($chm65*$room3_c)/15)+(($fdm_adult65*$room3*$free_night_buffet)/15)+(($fdm_child65*$room3_c*$free_night_buffet)/15);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam5'])/5+(($chm65*$room3_c)/20)+(($fdm_adult65*$room3*$free_night_buffet)/20)+(($fdm_child65*$room3_c*$free_night_buffet)/20);
                    }
                    
                    }
                    //TOUR 76 VALUE
                    
                                    
                    
                    if ($numNoches['noches'] == 6 && $categor==2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl6'])/6+(($chv76*$room3_c)/6)+(($fdv_adult76*$room3*$free_night_buffet)/6)+(($fdv_child76*$room3_c*$free_night_buffet)/6);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl6'])/6+(($chv76*$room3_c)/12)+(($fdv_adult76*$room3*$free_night_buffet)/12)+(($fdv_child76*$room3_c*$free_night_buffet)/12);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl6'])/6+(($chv76*$room3_c)/18)+(($fdv_adult76*$room3*$free_night_buffet)/18)+(($fdv_child76*$room3_c*$free_night_buffet)/18);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua6'])/6+(($chv76*$room3_c)/24)+(($fdv_adult76*$room3*$free_night_buffet)/24)+(($fdv_child76*$room3_c*$free_night_buffet)/24);
                    }
                    
                    }
                    
                    //TOUR 76 MODERATE
                    
                                      
                    
                    if ($numNoches['noches'] == 6 && $categor==3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm6'])/6+(($chm76*$room3_c)/6)+(($fdm_adult76*$room3*$free_night_buffet)/6)+(($fdm_child76*$room3_c*$free_night_buffet)/6);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm6'])/6+(($chm76*$room3_c)/12)+(($fdm_adult76*$room3*$free_night_buffet)/12)+(($fdm_child76*$room3_c*$free_night_buffet)/12);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm6'])/6+(($chm76*$room3_c)/18)+(($fdm_adult76*$room3*$free_night_buffet)/18)+(($fdm_child76*$room3_c*$free_night_buffet)/18);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam6'])/6+(($chm76*$room3_c)/24)+(($fdm_adult76*$room3*$free_night_buffet)/24)+(($fdm_child76*$room3_c*$free_night_buffet)/24);
                    }
                    
                    }
                    //TOUR 87 VALUE
                    
                    
                                  
                    
                    if ($numNoches['noches'] == 7 && $categor == 2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl7'])/7+(($chv87*$room3_c)/7)+(($fdv_adult87*$room3*$free_night_buffet)/7)+(($fdv_child87*$room3_c*$free_night_buffet)/7);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl7'])/7+(($chv87*$room3_c)/14)+(($fdv_adult87*$room3*$free_night_buffet)/14)+(($fdv_child87*$room3_c*$free_night_buffet)/14);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl7'])/7+(($chv87*$room3_c)/21)+(($fdv_adult87*$room3*$free_night_buffet)/21)+(($fdv_child87*$room3_c*$free_night_buffet)/21);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua7'])/7+(($chv87*$room3_c)/28)+(($fdv_adult87*$room3*$free_night_buffet)/28)+(($fdv_child87*$room3_c*$free_night_buffet)/28);
                    }
                    
                    }
                    
                    //TOUR 87 MODERATE
                    
                                       
                    if ($numNoches['noches'] == 7 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm7'])/7+(($chm87*$room3_c)/7)+(($fdm_adult87*$room3*$free_night_buffet)/7)+(($fdm_child87*$room3_c*$free_night_buffet)/7);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm7'])/7+(($chm87*$room3_c)/14)+(($fdm_adult87*$room3*$free_night_buffet)/14)+(($fdm_child87*$room3_c*$free_night_buffet)/14);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm7'])/7+(($chm87*$room3_c)/21)+(($fdm_adult87*$room3*$free_night_buffet)/21)+(($fdm_child87*$room3_c*$free_night_buffet)/21);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam7'])/7+(($chm87*$room3_c)/28)+(($fdm_adult87*$room3*$free_night_buffet)/28)+(($fdm_child87*$room3_c*$free_night_buffet)/28);
                    }
                    
                    }
                    
                    //TOUR 98 VALUE
                    
                                    
                    
                    if ($numNoches['noches'] == 8 && $categor == 2 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sgl8'])/8+(($chv98*$room3_c)/8)+(($fdv_adult98*$room3*$free_night_buffet)/8)+(($fdv_child98*$room3_c*$free_night_buffet)/8);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dbl8'])/8+(($chv98*$room3_c)/16)+(($fdv_adult98*$room3*$free_night_buffet)/16)+(($fdv_child98*$room3_c*$free_night_buffet)/16);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tpl8'])/8+(($chv98*$room3_c)/24)+(($fdv_adult98*$room3*$free_night_buffet)/24)+(($fdv_child98*$room3_c*$free_night_buffet)/24);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['qua8'])/8+(($chv98*$room3_c)/32)+(($fdv_adult98*$room3*$free_night_buffet)/32)+(($fdv_child98*$room3_c*$free_night_buffet)/32);
                    }
                    
                    }
                     //TOUR 98 MODERATE
                    
                   
                    
                    if ($numNoches['noches'] == 8 && $categor == 3 && $room3 > 0) {
                        
                    if ($room3 == 1) {

                        $priceRoom3 += ($costohotel ['sglm8'])/8+(($chm98*$room3_c)/8)+(($fdm_adult98*$room3*$free_night_buffet)/8)+(($fdm_child98*$room3_c*$free_night_buffet)/8);
                    }
                    if ($room3 == 2) {

                        $priceRoom3 += ($costohotel ['dblm8'])/8+(($chm98*$room3_c)/16)+(($fdm_adult98*$room3*$free_night_buffet)/16)+(($fdm_child98*$room3_c*$free_night_buffet)/16);
                    }
                    if ($room3 == 3) {

                        $priceRoom3 += ($costohotel ['tplm8'])/8+(($chm98*$room3_c)/24)+(($fdm_adult98*$room3*$free_night_buffet)/24)+(($fdm_child98*$room3_c*$free_night_buffet)/24);
                    }
                    if ($room3 == 4) {

                        $priceRoom3 += ($costohotel ['quam8'])/8+(($chm98*$room3_c)/32)+(($fdm_adult98*$room3*$free_night_buffet)/32)+(($fdm_child98*$room3_c*$free_night_buffet)/32);
                    }
                    
                    }
                    
                    if ($room3 == 0) {

                        $priceRoom3 = 0;
                    }

                    date_add($fecha3, date_interval_create_from_date_string('1 days'));
                    $contador++;
                }
                //$priceRoom3 = (round($priceRoom3) * $room3);
                $priceRoom3 = $priceRoom3*$room3;
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
                    
                                     
                    
                    if($numNoches['noches'] == 1 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += $costohotel ['sgl']+($chv21*$room4_c)+($fdv_adult21*$room4*$free_night_buffet)+($fdv_child21*$room4_c*$free_night_buffet);
                        //echo $priceRoom4;
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += $costohotel ['dbl']+(($chv21*$room4_c)/2)+(($fdv_adult21*$room4*$free_night_buffet)/2)+(($fdv_child21*$room4_c*$free_night_buffet)/2);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += $costohotel ['tpl']+(($chv21*$room4_c)/3)+(($fdv_adult21*$room4*$free_night_buffet)/3)+(($fdv_child21*$room4_c*$free_night_buffet)/3);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += $costohotel ['qua']+(($chv21*$room4_c)/4)+(($fdv_adult21*$room4*$free_night_buffet)/4)+(($fdv_child21*$room4_c*$free_night_buffet)/4);
                    }
                    
                    }
                    
                    //TOUR 21 MODERATE
                    
                                    
                    
                    if($numNoches['noches'] == 1 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += $costohotel ['sglm']+($chm21*$room4_c)+($fdm_adult21*$room4*$free_night_buffet)+($fdm_child21*$room4_c*$free_night_buffet);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += $costohotel ['dblm']+(($chm21*$room4_c)/2)+(($fdm_adult21*$room4*$free_night_buffet)/2)+(($fdm_child21*$room4_c*$free_night_buffet)/2);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += $costohotel ['tplm']+(($chm21*$room4_c)/3)+(($fdm_adult21*$room4*$free_night_buffet)/3)+(($fdm_child21*$room4_c*$free_night_buffet)/3);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += $costohotel ['quam']+(($chm21*$room4_c)/4)+(($fdm_adult21*$room4*$free_night_buffet)/4)+(($fdm_child21*$room4_c*$free_night_buffet)/4);
                    }
                    
                    }
                    
                    //TOUR 32 VALUE                    
                    
                    
                    
                    if($numNoches['noches'] == 2 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl2'])/2+(($chv32*$room4_c)/2)+(($fdv_adult32*$room4*$free_night_buffet)/2)+(($fdv_child32*$room4_c*$free_night_buffet)/2);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl2'])/2+(($chv32*$room4_c)/4)+(($fdv_adult32*$room4*$free_night_buffet)/4)+(($fdv_child32*$room4_c*$free_night_buffet)/4);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl2'])/2+(($chv32*$room4_c)/6)+(($fdv_adult32*$room4*$free_night_buffet)/6)+(($fdv_child32*$room4_c*$free_night_buffet)/6);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua2'])/2+(($chv32*$room4_c)/8)+(($fdv_adult32*$room4*$free_night_buffet)/8)+(($fdv_child32*$room4_c*$free_night_buffet)/8);
                    }
                    
                    }
                    
                    //TOUR 32 MODERATE
                    
                                
                    
                    if($numNoches['noches'] == 2 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm2'])/2+(($chm32*$room4_c)/2)+(($fdm_adult32*$room4*$free_night_buffet)/2)+(($fdm_child32*$room4_c*$free_night_buffet)/2);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm2'])/2+(($chm32*$room4_c)/4)+(($fdm_adult32*$room4*$free_night_buffet)/4)+(($fdm_child32*$room4_c*$free_night_buffet)/4);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm2'])/2+(($chm32*$room4_c)/6)+(($fdm_adult32*$room4*$free_night_buffet)/6)+(($fdm_child32*$room4_c*$free_night_buffet)/6);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam2'])/2+(($chm32*$room4_c)/8)+(($fdm_adult32*$room4*$free_night_buffet)/8)+(($fdm_child32*$room4_c*$free_night_buffet)/8);
                    }
                    
                    }
                    
                    // TOUR 43 VALUE                  
                            
                                      
                                        
                    if($numNoches['noches'] == 3 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl3'])/3+(($chv43*$room4_c)/3)+(($fdv_adult43*$room4*$free_night_buffet)/3)+(($fdv_child43*$room4_c*$free_night_buffet)/3); 
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl3'])/3+(($chv43*$room4_c)/6)+(($fdv_adult43*$room4*$free_night_buffet)/6)+(($fdv_child43*$room4_c*$free_night_buffet)/6); 
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl3'])/3+(($chv43*$room4_c)/9)+(($fdv_adult43*$room4*$free_night_buffet)/9)+(($fdv_child43*$room4_c*$free_night_buffet)/9); 
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua3'])/3+(($chv43*$room4_c)/12)+(($fdv_adult43*$room4*$free_night_buffet)/12)+(($fdv_child43*$room4_c*$free_night_buffet)/12); 
                    }
                    
                    }
                    
                     //TOUR 43 MODERATE
                    
                    
                                       
                    if($numNoches['noches'] == 3 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm3'])/3+(($chm43*$room4_c)/3)+(($fdm_adult43*$room4*$free_night_buffet)/3)+(($fdm_child43*$room4_c*$free_night_buffet)/3);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm3'])/3+(($chm43*$room4_c)/6)+(($fdm_adult43*$room4*$free_night_buffet)/6)+(($fdm_child43*$room4_c*$free_night_buffet)/6);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm3'])/3+(($chm43*$room4_c)/9)+(($fdm_adult43*$room4*$free_night_buffet)/9)+(($fdm_child43*$room4_c*$free_night_buffet)/9);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam3'])/3+(($chm43*$room4_c)/12)+(($fdm_adult43*$room4*$free_night_buffet)/12)+(($fdm_child43*$room4_c*$free_night_buffet)/12);
                    }
                    
                    }
                    
                     //TOUR 54 VALUE                
                                      
                    
                                    
                    if($numNoches['noches'] == 4 && $categor==2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl4'])/4+(($chv54*$room4_c)/4)+(($fdv_adult54*$room4*$free_night_buffet)/4)+(($fdv_child54*$room4_c*$free_night_buffet)/4);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl4'])/4+(($chv54*$room4_c)/8)+(($fdv_adult54*$room4*$free_night_buffet)/8)+(($fdv_child54*$room4_c*$free_night_buffet)/8);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl4'])/4+(($chv54*$room4_c)/12)+(($fdv_adult54*$room4*$free_night_buffet)/12)+(($fdv_child54*$room4_c*$free_night_buffet)/12);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua4'])/4+(($chv54*$room4_c)/16)+(($fdv_adult54*$room4*$free_night_buffet)/16)+(($fdv_child54*$room4_c*$free_night_buffet)/16);
                    }
                    
                    }
                    
                    //TOUR 54 MODERATE                    
                    
                       
                    
                    if($numNoches['noches'] == 4 && $categor==3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm4'])/4+(($chm54*$room4_c)/4)+(($fdm_adult54*$room4*$free_night_buffet)/4)+(($fdm_child54*$room4_c*$free_night_buffet)/4);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm4'])/4+(($chm54*$room4_c)/8)+(($fdm_adult54*$room4*$free_night_buffet)/8)+(($fdm_child54*$room4_c*$free_night_buffet)/8);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm4'])/4+(($chm54*$room4_c)/12)+(($fdm_adult54*$room4*$free_night_buffet)/12)+(($fdm_child54*$room4_c*$free_night_buffet)/12);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam4'])/4+(($chm54*$room4_c)/16)+(($fdm_adult54*$room4*$free_night_buffet)/16)+(($fdm_child54*$room4_c*$free_night_buffet)/16);
                    }
                    
                    }
                                     
                    //TOUR 65 VALUE                      
                    
                   
                    
                    if($numNoches['noches'] == 5 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl5'])/5+(($chv65*$room4_c)/5)+(($fdv_adult65*$room4*$free_night_buffet)/5)+(($fdv_child65*$room4_c*$free_night_buffet)/5);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl5'])/5+(($chv65*$room4_c)/10)+(($fdv_adult65*$room4*$free_night_buffet)/10)+(($fdv_child65*$room4_c*$free_night_buffet)/10);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl5'])/5+(($chv65*$room4_c)/15)+(($fdv_adult65*$room4*$free_night_buffet)/15)+(($fdv_child65*$room4_c*$free_night_buffet)/15);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua5'])/5+(($chv65*$room4_c)/20)+(($fdv_adult65*$room4*$free_night_buffet)/20)+(($fdv_child65*$room4_c*$free_night_buffet)/20);
                    }
                    
                    }
                    
                    //TOUR 65 MODERATE
                    
                                      
                    
                    if($numNoches['noches'] == 5 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm5'])/5+(($chm65*$room4_c)/5)+(($fdm_adult65*$room4*$free_night_buffet)/5)+(($fdm_child65*$room4_c*$free_night_buffet)/5);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm5'])/5+(($chm65*$room4_c)/10)+(($fdm_adult65*$room4*$free_night_buffet)/10)+(($fdm_child65*$room4_c*$free_night_buffet)/10);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm5'])/5+(($chm65*$room4_c)/15)+(($fdm_adult65*$room4*$free_night_buffet)/15)+(($fdm_child65*$room4_c*$free_night_buffet)/15);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam5'])/5+(($chm65*$room4_c)/20)+(($fdm_adult65*$room4*$free_night_buffet)/20)+(($fdm_child65*$room4_c*$free_night_buffet)/20);
                    }
                    
                    }
                    
                    //TOUR 76 VALUE
                    
                    
                                      
                     if($numNoches['noches'] == 6 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl6'])/6+(($chv76*$room4_c)/6)+(($fdv_adult76*$room4*$free_night_buffet)/6)+(($fdv_child76*$room4_c*$free_night_buffet)/6);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl6'])/6+(($chv76*$room4_c)/12)+(($fdv_adult76*$room4*$free_night_buffet)/12)+(($fdv_child76*$room4_c*$free_night_buffet)/12);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl6'])/6+(($chv76*$room4_c)/18)+(($fdv_adult76*$room4*$free_night_buffet)/18)+(($fdv_child76*$room4_c*$free_night_buffet)/18);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua6'])/6+(($chv76*$room4_c)/24)+(($fdv_adult76*$room4*$free_night_buffet)/24)+(($fdv_child76*$room4_c*$free_night_buffet)/24);
                    }
                    
                    }
                    
                    //TOUR 76 MODERATE
                    
                    
                    
                    if($numNoches['noches'] == 6 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm6'])/6+(($chm76*$room4_c)/6)+(($fdm_adult76*$room4*$free_night_buffet)/6)+(($fdm_child76*$room4_c*$free_night_buffet)/6);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm6'])/6+(($chm76*$room4_c)/12)+(($fdm_adult76*$room4*$free_night_buffet)/12)+(($fdm_child76*$room4_c*$free_night_buffet)/12);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm6'])/6+(($chm76*$room4_c)/18)+(($fdm_adult76*$room4*$free_night_buffet)/18)+(($fdm_child76*$room4_c*$free_night_buffet)/18);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam6'])/6+(($chm76*$room4_c)/24)+(($fdm_adult76*$room4*$free_night_buffet)/24)+(($fdm_child76*$room4_c*$free_night_buffet)/24);
                    }
                    
                    }
                    
                    //TOUR 87 VALUE 
                    
                    
                    
                    
                    if($numNoches['noches'] == 7 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl7'])/7+(($chv87*$room4_c)/7)+(($fdv_adult87*$room4*$free_night_buffet)/7)+(($fdv_child87*$room4_c*$free_night_buffet)/7);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl7'])/7+(($chv87*$room4_c)/14)+(($fdv_adult87*$room4*$free_night_buffet)/14)+(($fdv_child87*$room4_c*$free_night_buffet)/14);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl7'])/7+(($chv87*$room4_c)/21)+(($fdv_adult87*$room4*$free_night_buffet)/21)+(($fdv_child87*$room4_c*$free_night_buffet)/21);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua7'])/7+(($chv87*$room4_c)/28)+(($fdv_adult87*$room4*$free_night_buffet)/28)+(($fdv_child87*$room4_c*$free_night_buffet)/28);
                    }
                    
                    }
                    
                    //TOUR 87 MODERATE
                    
                    if($numNoches['noches'] == 7 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm7'])/7+(($chm87*$room4_c)/7)+(($fdm_adult87*$room4*$free_night_buffet)/7)+(($fdm_child87*$room4_c*$free_night_buffet)/7);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm7'])/7+(($chm87*$room4_c)/14)+(($fdm_adult87*$room4*$free_night_buffet)/14)+(($fdm_child87*$room4_c*$free_night_buffet)/14);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm7'])/7+(($chm87*$room4_c)/21)+(($fdm_adult87*$room4*$free_night_buffet)/21)+(($fdm_child87*$room4_c*$free_night_buffet)/21);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam7'])/7+(($chm87*$room4_c)/28)+(($fdm_adult87*$room4*$free_night_buffet)/28)+(($fdm_child87*$room4_c*$free_night_buffet)/28);
                    }
                    
                    }
                    
                   
                    
                    //TOUR 98 VALUE 
                    
                     if($numNoches['noches'] == 8 && $categor == 2 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sgl8'])/8+(($chv98*$room4_c)/8)+(($fdv_adult98*$room4*$free_night_buffet)/8)+(($fdv_child98*$room4_c*$free_night_buffet)/8);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dbl8'])/8+(($chv98*$room4_c)/16)+(($fdv_adult98*$room4*$free_night_buffet)/16)+(($fdv_child98*$room4_c*$free_night_buffet)/16);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tpl8'])/8+(($chv98*$room4_c)/24)+(($fdv_adult98*$room4*$free_night_buffet)/24)+(($fdv_child98*$room4_c*$free_night_buffet)/24);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['qua8'])/8+(($chv98*$room4_c)/32)+(($fdv_adult98*$room4*$free_night_buffet)/32)+(($fdv_child98*$room4_c*$free_night_buffet)/32);
                    }
                    
                    }
                    
                   
                    //TOUR 98 MODERATE
                    
                   
                    
                    if($numNoches['noches'] == 8 && $categor == 3 && $room4 > 0){
                        
                    if ($room4 == 1) {

                        $priceRoom4 += ($costohotel ['sglm8'])/8+(($chm98*$room4_c)/8)+(($fdm_adult98*$room4*$free_night_buffet)/8)+(($fdm_child98*$room4_c*$free_night_buffet)/8);
                    }
                    if ($room4 == 2) {

                        $priceRoom4 += ($costohotel ['dblm8'])/8+(($chm98*$room4_c)/16)+(($fdm_adult98*$room4*$free_night_buffet)/16)+(($fdm_child98*$room4_c*$free_night_buffet)/16);
                    }
                    if ($room4 == 3) {

                        $priceRoom4 += ($costohotel ['tplm8'])/8+(($chm98*$room4_c)/24)+(($fdm_adult98*$room4*$free_night_buffet)/24)+(($fdm_child98*$room4_c*$free_night_buffet)/24);
                    }
                    if ($room4 == 4) {

                        $priceRoom4 += ($costohotel ['quam8'])/8+(($chm98*$room4_c)/32)+(($fdm_adult98*$room4*$free_night_buffet)/32)+(($fdm_child98*$room4_c*$free_night_buffet)/32);
                    }
                    
                    }
                    
                    if ($room4 == 0) {

                        $priceRoom4 = 0;
                    }
                    date_add($fecha4, date_interval_create_from_date_string('1 days'));
                    $contador++;
                }
                //$priceRoom4 = (round($priceRoom4) * $room4);
                $priceRoom4 = $priceRoom4*$room4;
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
            $platinum = $this->params["platinum"];
            $adult = $this->params["adult"];
            $child = $this->params["child"];
            $totalpax = $child + $adult;
            $url = Doo::conf()->APP_URL;
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
                $_SESSION['tours']['attraction'] = $atraccion;
                echo '<script>
					 	$("#numPark").val("' . $this->numPark() . '");		
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
        }
    }

    public function listTablaPark() {
        $adult = $this->params["adult"];
        $child = $this->params["child"];
        $id_agencia = $this->params["id_agency"];
        
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
								<td title="Chil: ' . $ticket['child'] . ', Adult: ' . $ticket['adult'] . '"> $ ' . $ticket['adult'] . " / " . $ticket['child']/*number_format((($ticket['child'] * $child) + ($ticket['adult'] * $adult)) / ($adult + $child), 2, '.', ',') */ . '</td>
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
////        
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
                $parkdatos['adult'] = 24;
                $parkdatos['child'] = 24;
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
                $parkdatos['adult'] = 24;
                $parkdatos['child'] = 24;
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

        
        
        $yearact  = substr($fecha_retorno, 0, 4);
               
        $fecha_retorno = $this->params["fecha_salida"];
            
        $fecha1 = $fecha_retorno;
        list ($dia, $mes, $anyo) = explode("-", $fecha1);
        $fecha2 = $mes . "-" . $dia . "-" . $anyo;
        $fecha3 = strtotime($fecha2);       
        $fecha_fin = $fecha3;
       
        
        ////////////////////////////////////////////////////////
        
        $fecha_retorno = $this->params["fecha_salida"];     
        $fecha4 = $fecha_retorno;
        list ($dia, $mes, $anyo) = explode("-", $fecha4);
        $fecha5 = $mes . "-" . $dia . "-" . $anyo;
        $fecha6 = strtotime($fecha5);       
        $fecha_ini = $fecha6;
        

        $sql = 'SELECT adults,child,id_parque ,cantidad
						FROM admin_parques_tarifa
						WHERE type_rate = 1 AND id_agency =-1 AND id_grupo = ? AND  cantidad = ? AND fecha_ini <= ? AND fecha_fin >= ?';
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
            foreach ($grupo as $id_park => $park) {
                if ($dat->id != -1) {
                    $rs = Doo::db()->query($sql0, array(
                        $dat->id,
                        trim($id_grupo),
                        trim($cantidad),
                        $fecha_ini,
                        $fecha_fin
                    ));
                    $consulta = $rs->fetch();

                    if (empty($consulta) || $consulta ['id_parque'] != 0) {
                        $rs = Doo::db()->query($sql, array(
                            trim($id_grupo),
                            trim($cantidad),
                            $fecha_ini,
                            $fecha_fin
                        ));
                        $consulta = $rs->fetch();
                    }
                } else {
                    $rs = Doo::db()->query($sql, array(
                        trim($id_grupo),
                        trim($cantidad),
                        $fecha_ini,
                        $fecha_fin
                    ));
                    $consulta = $rs->fetch();
                }

                if (!empty($consulta) && $consulta ['id_parque'] == 0) {
                    $priceChild = $consulta['child'] /* / $cantidad */;
                    $ninos = $priceChild;
                    $priceAdult = $consulta['adults'] /* / $cantidad */;
                    $adultos = $priceAdult;
                    $cantidad_consulta = $consulta['cantidad'];
                    
                    $sql2 = 'SELECT  adults,child,id_parque,cantidad,fecha_ini,fecha_fin
								FROM admin_parques_tarifa
								WHERE type_rate = 1 AND id_agency =-1 AND  id_parque = ? AND cantidad = 1 AND fecha_ini <= ? AND fecha_fin >= ?';
                    $sql02 = 'SELECT  adults,child,id_parque,cantidad
								FROM admin_parques_tarifa
								WHERE type_rate = 2 AND id_agency = ? AND  id_parque = ? AND cantidad = 1 AND fecha_fin >= ?';
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql02, array(
                            $dat->id,
                            trim($park['id_park']), $fecha_fin
                        ));
                        $consulta2 = $rs->fetch();
                        
                        if (empty($consulta2)) {
                            $rs = Doo::db()->query($sql2, array(
                                trim($park['id_park']), $fecha_ini, $fecha_fin
                            ));
                            $consulta2 = $rs->fetch();
                        }
                    } else {
                        $rs = Doo::db()->query($sql2, array(
                            trim($park['id_park']), $fecha_ini, $fecha_fin
                        ));
                        $consulta2 = $rs->fetch();
                    }
                    $park['ticket'] = array("child" => $consulta2['child'], "adult" => $consulta2['adults'], "precio_varios" => 1, "cantidad" => $cantidad_consulta, "v_p_child" => $priceChild, "v_p_adult" => $priceAdult);

                    if ($consulta['adults'] == 0) {
                        $parkFree ++;
                    }
                } else {
                    
                    /////////////////////////////Elimina costos de admision a parques////////////////////////////////////
                    
                                
                    
                    $sql2 = 'SELECT  adults,child,id_parque,cantidad,fecha_ini
								FROM admin_parques_tarifa
								WHERE type_rate = 1 AND id_agency =-1 AND  id_parque = ? AND cantidad >= 1   AND fecha_fin >= ?';
                    $sql02 = 'SELECT  adults,child,id_parque,cantidad
								FROM admin_parques_tarifa
								WHERE type_rate = 2 AND id_agency = ? AND  id_parque = ? AND cantidad = 1   AND fecha_ini >= ?';
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql02, array(
                            $dat->id,
                            trim($park['id_park']), $fecha_ini
                                //, $fecha_fin
                        ));
                        $consulta = $rs->fetch();
                        if (empty($consulta)) {
                            $rs = Doo::db()->query($sql2, array(
                                trim($park['id_park']), $fecha_ini
                                    //, $fecha_fin
                            ));
                            $consulta = $rs->fetch();
                        }
                        
                    } else {
                        $rs = Doo::db()->query($sql2, array(
                            trim($park['id_park']),$fecha_ini
                                //, $fecha_fin
                        ));
                        $consulta = $rs->fetch();
                    }
                    //////////////////////////////////////////////////////////////////////////////////////////////////////
                    if (!empty($consulta)) {
                        if ($consulta['cantidad'] == 1 && $consulta['id_parque'] != 0) {
                           
                                                      //retorno de consulta
                            
                            $priceChild = $consulta['child'];
                            $priceAdult = $consulta['adults'];
                            
                       
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


        $transporLocal = 0;
        $pricePark = 0;
        $grupo_array = array();
        $contador = 0;      


          
        $fecha_retorno = $this->params["fecha_salida"];     
        $fecha4 = $fecha_retorno;
        list ($dia, $mes, $anyo) = explode("-", $fecha4);
        $fecha5 = $mes . "-" . $dia . "-" . $anyo;
        $fecha6 = strtotime($fecha5);        
        $fecha_ini = $fecha6;
       
        $fecha_retorno = $this->params["fecha_salida"];       
        $fecha1 = $fecha_retorno;
        list ($dia, $mes, $anyo) = explode("-", $fecha1);
        $fecha2 = $mes . "-" . $dia . "-" . $anyo;
        $fecha3 = strtotime($fecha2);        
        $fecha_fin = $fecha3;
        
        //$annio = substr($fecha_retorno, 0, 4) . '-01-01 00:00:00';
        //$annio = $fecha_retorno;
                 // . '-01-01 00:00:00';
        //  echo $annio;
        
        foreach ($atraccion as $id_grupo => $grupo) {
            foreach ($grupo as $id_park => $park) {
                $opciones = $park['opciones'];
                $ticket = $park['ticket'];
                $fecha = $park['fecha_retorno'];
                $yearact = substr($fecha, 0, 4);
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
            $dat->type_rate = 9;
        } else {
            $dat = new Agency();
            $dat->id = $id_agency;
            $dat = Doo::db()->find($dat, array('limit' => 1));
        }
        $sql = 'SELECT adults,child,id_parque ,cantidad
		FROM admin_parques_tarifa
		WHERE type_rate = 1 AND  id_agency = -1 AND id_grupo = ? AND  cantidad = ?  AND fecha_fin >= ?';
       
        ///suministra valor para cantidades >1
        $sql0 = 'SELECT adults,child,id_parque ,cantidad
		FROM admin_parques_tarifa
                WHERE type_rate = 2 AND id_parque = 0 AND id_agency = ? AND  id_grupo = ? AND cantidad = ? AND fecha_fin >= ?';
       
             
        
        $price_group_parks = array();
        foreach ($atraccion as $id_grupo => $grupo) {
            foreach ($grupo as $id_park => $park) {
                $opciones = $park['opciones'];

                if ($grupo_array[$id_grupo] > 0) {
                    $cantidad = $grupo_array[$id_grupo];
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql0, array(
                            $dat->id,
                            trim($id_grupo),
                            trim($cantidad),
                            //$fecha_ini,
                            $fecha_fin
                        ));
                        $consulta = $rs->fetch();

                        if (empty($consulta) || $consulta ['id_parque'] != 0) {
                            $rs = Doo::db()->query($sql, array(
                                trim($id_grupo),
                                trim($cantidad),
                                //$fecha_ini,
                                $fecha_fin
                            ));
                            $consulta = $rs->fetch();
                        }
                    } else {
                        $rs = Doo::db()->query($sql, array(
                            trim($id_grupo),
                            trim($cantidad),
                            //$fecha_ini,
                            $fecha_fin
                        ));
                        $consulta = $rs->fetch();
                    }
                    if (!empty($consulta) && $consulta ['id_parque'] == 0) {
                        $adult_price = $consulta["adults"];
                        $child_price = $consulta["child"];
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
                        
                        $respuesta_html = "";
                        foreach ($price_group_parks as $values) {
                        $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
                 
                        }
                        
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
            $atraccion[$id_grupo] = $grupo;
        }



        foreach ($atraccion as $id_grupo => $grupo) {
            foreach ($grupo as $id_park => $park) {
                $transpor = $park['transpor'];
                $ticket = $park['ticket'];
                $opciones = $park['opciones'];
                if ($opciones['transpor'] == 1) {
                   
                    $transporLocal += ($transpor['child'] * $child) + ($transpor['adult'] * $adult);
                }
                if ($opciones['ticket'] == 1) {
                    if ($ticket["precio_varios"] == 1 && $ticket["cantidad"] == $grupo_array[$id_grupo]) {
                        $precio_adulto = $ticket['v_p_adult'] / $ticket["cantidad"];
                        $precio_child = $ticket['v_p_child'] / $ticket["cantidad"];

                        $pricePark += ($precio_child * $child) + ($precio_adulto * $adult);
                        
                    } else {
                        $pricePark += ($ticket['child'] * $child) + ($ticket['adult'] * $adult);
                    }
                }
            }
        }
        ////////////////////////////////////
//        $respuesta_html = "";
//        foreach ($price_group_parks as $values) {
//            $respuesta_html .= "<p>" . $values["cantidad"] . " tickets to <strong>" . $values["grupo"] . "</strong> Adult $ <strong>" . $values["adult_price"] . "</strong> Child $ <strong>" . $values["child_price"] . "</strong> per person.</p>";
//                 
//        }
        ///////////////////////////////////
        $total = array();
        $total['admision'] = $pricePark;
        $total['transporLocal'] = $transporLocal;
        $total["respuesta_html"] = $respuesta_html;
        $_SESSION['tours']["mensaje_html"] = $respuesta_html;
        //print_r($pricePark);
//        print_r($total);
//        exit;
//        print_r(Doo::db()->showSQL());
//        exit;
        return $total;
    }

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
			   $("#numPark").val("' . $this->numPark() . '");
		           $("#table_7").children("tbody").html(' . $parks . ');
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
