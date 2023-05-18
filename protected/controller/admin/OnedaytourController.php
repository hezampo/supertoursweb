<?php

/**
 * Description of ToursvipController
 *
 * @author Angel Valencia.
 */
Doo::loadController('I18nController');

class OnedaytourController extends I18nController {

    public function beforeRun($resource, $action) {

        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {

        // Cargamos el paginador
        Doo::loadHelper('DooPager');


        if (!isset($this->params['type_rate'])) {
            $type_rate = "0";
        } else {
            $type_rate = $this->params['type_rate'];
        }


        if (!isset($_POST["id_agency"])) {
            if (!isset($this->params['id_agency'])) {
                $id_agency = "-1";
            } else {
                $id_agency = $this->params['id_agency'];
            }
        } else {
            $id_agency = $_POST["id_agency"];
        }


        if (!isset($_POST["company_name"])) {
            if (!isset($this->params['company_name'])) {
                $acompany = "";
            } else {
                $acompany = $this->params['company_name'];
            }
        } else {
            $acompany = $_POST["company_name"];
        }


        if (!isset($_POST["filtro"])) {
            if (!isset($this->params['filtro'])) {
                $filtro = "id";
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

        if (trim($texto) != '') {
            $texto .='%';
        }

        if (trim($acompany) != '') {
            $acompany .='%';
        }

        if ($type_rate == 2 && $id_agency == "-1") {
            $where = "type_rate=" . $type_rate . " and " . $filtro . " like ?  ";
            $param = array($texto . '%');
        } else {
            $where = "type_rate=" . $type_rate . " and id_agency = ? and " . $filtro . " like ?  ";
            $param = array($id_agency, $texto . '%');
        }

        $rs = Doo::db()->find("Onetour", array("select" => "COUNT(*) AS total",
            "where" => $where,
            "limit" => 1,
            "param" => $param
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/tarifa-vip/$filtro/$texto/$type_rate/$id_agency/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        $sql = "SELECT id, priceadult, pricechild, type_rate, id_agency, annio
                              " . (($type_rate == 2) ? ",company_name" : "") . "  
                              FROM onetour WHERE " . $where . " order by annio DESC limit $pager->limit";
        $rs = Doo::db()->query($sql, $param);

        $tarifaonetour = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tarifa-onedaytour.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = substr($texto, 0, -1);
        $this->data['type_rate'] = $type_rate;
        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = $acompany;
        $this->data['tarifaonetour'] = $tarifaonetour;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {

        Doo::loadModel("Onetour");

        $tarifaonetour = new Onetour();
        $tarifaonetour->id_agency = -1;
        $tarifaonetour->company_name = '';
        $tarifaonetour->type_rate = $this->params['type_rate'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tarifaonetour'] = Doo::db()->find($tarifaonetour, array('limit' => 1));
        $this->data['tarifaonetour'] = $tarifaonetour;
        $this->data['type_rate'] = $this->params['type_rate'];
        $this->data['content'] = 'configuracion/frm_tarionetour.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Onetour");

        $tarifaonetour = new Onetour();

        $new = false;

        $tarifaonetour->type_rate = $_POST['type_rate'];
        $tarifaonetour->id_agency = $_POST['id_agency'];
        $tarifaonetour->annio = $_POST['annio'] . '-01-01 00:00:00';
        $tarifaonetour = Doo::db()->find($tarifaonetour, array("limit", 1));
        if (empty($tarifaonetour)) {
            $tarifaonetour = new Onetour($_POST);
            $tarifaonetour->annio = $_POST['annio'] . '-01-01 00:00:00';//proximo a ser atacado
            $tarifaonetour->id = Null;
            $new = true;
        } else {
            $tarifaonetour = new Onetour($tarifaonetour[0]);
            $tarifaonetour->annio = $_POST['annio'] . '-01-01 00:00:00'; // proximo a ser atacado
            $tarifaonetour->priceadult = $_POST['priceadult'];
            $tarifaonetour->pricechild = $_POST['pricechild'];

            /** SUPLEMENTS FOR WALT DISNEY WORLD */
            $tarifaonetour->suplemag_adult = $_POST['suplemag_adult'];
            $tarifaonetour->suplemag_child = $_POST['suplemag_child'];
            
            $tarifaonetour->suplepcot_adult = $_POST['suplepcot_adult'];
            $tarifaonetour->suplepcot_child = $_POST['suplepcot_child'];
            
            $tarifaonetour->suplehollywood_adult = $_POST['suplehollywood_adult'];
            $tarifaonetour->suplehollywood_child = $_POST['suplehollywood_child'];
            
            $tarifaonetour->supleanimalk_adult = $_POST['supleanimalk_adult'];
            $tarifaonetour->supleanimalk_child = $_POST['supleanimalk_child'];
            /** FIN */
            
            /** SUPLEMENTS FOR UNIVERSAL PARKS */
            $tarifaonetour->suplemuniv_adult = $_POST['suplemuniv_adult'];
            $tarifaonetour->suplemuniv_child = $_POST['suplemuniv_child'];
            
            $tarifaonetour->suplemisland_adult = $_POST['suplemisland_adult'];
            $tarifaonetour->suplemisland_child = $_POST['suplemisland_child'];
            /** FIN */
            
            /** SUPLEMENTS FOR SEA WORLD */
            $tarifaonetour->suplemseaw_adult = $_POST['suplemseaw_adult'];
            $tarifaonetour->suplemseaw_child = $_POST['suplemseaw_child'];
            
            $tarifaonetour->suplemaquat_adult = $_POST['suplemaquat_adult'];
            $tarifaonetour->suplemaquat_child = $_POST['suplemaquat_child'];
            /** FIN */
            
            /** SUPLEMENTS FOR WATER PARKS  */
            $tarifaonetour->suplemwetn_adult = $_POST['suplemwetn_adult'];
            $tarifaonetour->suplemwetn_child = $_POST['suplemwetn_child'];
            
            $tarifaonetour->suplembliz_adult = $_POST['suplembliz_adult'];
            $tarifaonetour->suplembliz_child = $_POST['suplembliz_child'];
            /** FIN */
            
            /** SUPLEMENTS FOR HISTORIC PARKS  */
            $tarifaonetour->suplemkennedy_adult = $_POST['suplemkennedy_adult'];
            $tarifaonetour->suplemkennedy_child = $_POST['suplemkennedy_child'];
            
            $tarifaonetour->suplemholy_adult = $_POST['suplemholy_adult'];
            $tarifaonetour->suplemholy_child = $_POST['suplemholy_child'];
            
            /** FIN */
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if ($new) {
            if (Doo::db()->insert($tarifaonetour)) {
                $_SESSION['triocu'] = "Rates Successfully Saved...!!";
            } else {
                $_SESSION['triocu'] = "Failed to Save Rates...!!";
            }
        } else {
            if (Doo::db()->update($tarifaonetour)) {
                $_SESSION['triocu'] = "Rates Successfully Update...!!";
            } else {
                $_SESSION['triocu'] = "Failed to Update Rates...!!";
            }
        }
        return Doo::conf()->APP_URL . "admin/onedaytour/rates/" . $_POST['type_rate'];
    }

    public function edit() {
        Doo::loadModel("Onetour");
        $tarifaonetour = new Onetour();
        $tarifaonetour->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tarifaonetour'] = Doo::db()->find($tarifaonetour, array('limit' => 1));
        $this->data['type_rate'] = $this->data['tarifaonetour']->type_rate;
        $this->data['content'] = 'configuracion/frm_tarionetour.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Onetour");
        $tarifaonetour = new Onetour();
        $tarifaonetour->id = $_REQUEST['item'];
        $dats = Doo::db()->find($tarifaonetour, array("limit" => 1));
        if (empty($dats)) {
            $_SESSION['vip'] = "Failed to Delete Rates...!!";
        } else {
            $type_rate = $dats->type_rate;
            Doo::db()->delete($tarifaonetour);
            $_SESSION['vip'] = "Rates Successfully Delete...!!";
        }
        return Doo::conf()->APP_URL . "admin/onedaytour/rates/" . $type_rate;
    }

    public function add_oneday_tour() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT DISTINCT t1.trip_to AS id, t2.nombre
				FROM routes t1
				LEFT JOIN areas t2 ON ( t1.trip_to = t2.id ) 
				WHERE t1.trip_from =1";
        $rs = Doo::db()->query($sql);
        $to_areas = $rs->fetchAll();
        $sql = "select * from grupo_parques";
        $query = Doo::db()->query($sql);
        $rs2 = $query->fetchAll();
        $this->data['grupos'] = $rs2;
        $this->data['to_areas'] = $to_areas;
        $this->data['countries'] = Doo::db()->fetchAll("SELECT * FROM  country ");
        $this->data['states'] = Doo::db()->fetchAll("SELECT * FROM  state ");
        $this->data['content'] = 'configuracion/frm_oneday_tours.php';
        $this->view()->renderc('admin/index', $this->data);
    }

    public function getPriceParks() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $childs = $this->params['childs'];
        $adults = $this->params['adults'];
        $id_park = $this->params['id_park'];
        $id_agency = $this->params['id_agency'];
        $fecha = $this->params['fecha'];
        
        echo $fecha;
        
        //actializacion 03/08/2016
        //
        //$fecha = substr($this->params['fecha'], -4) . '-01-01 00:00:00';
        //
        //
        /////actualizacion marzo 2016
        
        //$fecha = $this->params['fecha'];
        
        ///////////////////////////////
        //// AND t.annio = ?
        $sql = "SELECT p.nombre, t.adults, t.child, t.cantidad, p.id_grupo AS gid, g.nombre AS gnombre
            FROM parques AS p, admin_parques_tarifa AS t, grupo_parques AS g
            WHERE p.id_grupo = t.id_grupo
            AND t.cantidad =1
            AND p.id = ?
            AND type_rate =1
            AND t.id_agency = ?
            AND g.id = p.id_grupo
            AND t.annio = ?           
            ORDER BY t.cantidad DESC 
            LIMIT 1";
        $rs = Doo::db()->query($sql, array($id_park, $id_agency, $fecha));
        $parks_rates_rows = $rs->rowCount();
       
        /////AND t.annio = ?
        
        if ($parks_rates_rows == 0) {
            $sql = "SELECT p.nombre, t.adults, t.child, t.cantidad, p.id_grupo AS gid, g.nombre AS gnombre
            FROM parques AS p, admin_parques_tarifa AS t, grupo_parques AS g
            WHERE p.id_grupo = t.id_grupo
            AND t.cantidad =1
            AND p.id = ?
            AND type_rate =1
            AND g.id = p.id_grupo
            AND t.annio =?
            ORDER BY t.cantidad DESC 
            LIMIT 1";
            $rs = Doo::db()->query($sql, array($id_park, $fecha));
        }
        $parks_rates = $rs->fetchAll();
        if (count($parks_rates) > 0) {
            $park_childs = $parks_rates[0]['child'];
            $park_adults = $parks_rates[0]['adults'];
            $admision = $parks_rates[0]['child'] * $childs + $parks_rates[0]['adults'] * $adults;
            $transport = ($id_park == 19) ? 50 * ($childs + $adults) : 0;
            $id_park_group = $parks_rates[0]['gid'];
            $row = '<td>' . $parks_rates[0]['nombre'] . '</td><td>' . $parks_rates[0]['gnombre'] . '</td><td><img id="include_ticket" src="' . $this->data['rootUrl'] . 'global/img/admin/x02.png" style="cursor:pointer;" width="20" height="20">
                 <input type="checkbox" style="display:none" id="adm_selector" name="include_park">
                 </td><td><img src="' . $this->data['rootUrl'] . 'global/img/admin/check2.png" style="cursor:pointer;" width="20" height="20" /></td><td>$ ' . $admision . '.00</td><td>$ ' . $transport . '.00</td><td><img id="delete_park" style="cursor:pointer;" width="20" height="20" src="' . $this->data['rootUrl'] . 'global/img/admin/x01.png"/></td>
                 <input type="hidden" id="admpark" type="number" value="' . $admision . '"/> <input type="hidden" name="trpark" id="trpark" type="number" value="' . $transport . '" /><input type="hidden" id="id_selected_park" name="id_selected_park" type="number" readonly="readonly" value="' . $id_park . '" />
                 <input type="hidden" id="gid" type="number" name="gid" value="' . $id_park_group . '"/>
                 <input type="hidden" id="rate_adults" type="number" name="rate_adults" value="' . $park_adults . '"/>
                 <input type="hidden" id="rate_childs" type="number" name="rate_childs" value="' . $park_childs . '"/>
                 <script>$("#nparks").val(parseFloat($("#nparks").val())+1);
                         calcularTotalPago();</script>';
            echo $row;
        } else {
            echo '<script>alert("this park don\'t have price for this date");</script>';
        }
    }

    public function getCosto() {
        $rate = $this->params['type_rate'];
      
        $fecha = substr($this->params['fecha'], -4) . '-01-01 00:00:00';
     
        $rs = Doo::db()->query('select * from onetour where type_rate = ? and annio = ?;', array($rate, $fecha));
        $costs = $rs->fetchAll();
        echo '<input type="hidden" readonly="readonly" value=' . $costs[0]['priceadult'] . ' name="pricexadult" id="pricexadult"/><input id="pricexchild" name="pricexchild" type="hidden" readonly="readonly" value="' . $costs[0]['pricechild'] . '"></input>';
    }

    public function getCost($rate, $fecha) {
        $fecha .='-01-01 00:00:00';
        
        $rs = Doo::db()->query('select * from onetour where type_rate = ? and annio = ? limit 1;', array($rate, $fecha));
        $costs = $rs->fetchAll();
        return $costs[0];
    }

    public function getCostoExt() {
        $ext = $this->params['ext'];
        $index = $this->params['index'];
        $rs = Doo::db()->query('select * from extension where id = ?', array($ext));
        $costs = $rs->fetchAll();
        echo '<input id="cost_ext' . $index . '" type="hiddeh" readonly="readonly" value="' . $costs[0]['precio_neto'] . '"/>';
    }

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
							WHERE (place LIKE ? or   address LIKE ?) and id_area = ? and valid = 0 LIMIT 5  ";
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
							WHERE (place LIKE ? or   address LIKE ?) and id_area = ? and valid = 0 LIMIT 5  ";
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
        } else if ($id == 'park_name') {
            if ($categoria_park == 0) {
                //$sql = "SELECT `id`, `nombre`, `id_grupo`, `image1`, `description` FROM `parques`
                //WHERE nombre LIKE ? limit 7";
                $sql = "SELECT p.id, p.nombre, p.id_grupo as id_grupo
                                                FROM parques AS p, grupo_parques AS g
                                                WHERE p.id_grupo = g.id
                                                AND ( g.id =4 OR g.id =5 OR g.id =6 OR g.id =7 OR g.id =8 OR g.id = 11 OR g.id = 12)
                                                AND p.id !=12 AND p.nombre LIKE ? limit 7";

                $rs = Doo::db()->query($sql, array('%' . $data . '%'));
            } else {
                $sql = "SELECT p.id, p.nombre, p.id_grupo as id_grupo
                                                FROM parques AS p, grupo_parques AS g
                                                WHERE p.id_grupo = g.id
                                                AND ( g.id =4 OR g.id =5 OR g.id =6 OR g.id =7 OR g.id =8)
                                                AND p.id !=12 AND p.id_grupo = ? AND p.nombre LIKE ? limit 7";
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

    public function save_oneday() {

        if (isset($_SESSION['codconf']) || isset($_SESSION['tours_pago'])) {
            unset($_SESSION['codconf']);
            unset($_SESSION['tours_pago']);
        }

        Doo::loadModel('Tour_oneday');
        $tour = new Tour_oneday();
        Doo::loadModel('Toursoneday_Rastro');
        $rastro = new Toursoneday_Rastro();
        $rastrostring = "";
        try {
            extract($_POST, EXTR_SKIP);

            Doo::loadModel('Clientes');
            $cliente = new Clientes();
            if ($idCliente > 0) {
                $cliente->id = $idCliente;
                $cliente = Doo::db()->getOne($cliente);
            } else {
                $cliente->firstname = $firstname1;
                $cliente->lastname = $lastname1;
                $cliente->username = $email1;
                $cliente->phone = $phone1;
                $cliente->tipo_client = $tipo_pass;
                $cliente->id = Doo::db()->insert($cliente);
            }
            $rastrostring .= "Customer = " . $cliente->lastname . ' ' . $cliente->firstname . '&';
            Doo::loadModel('Reserve');
            $reserve = new Reserve();
            $reserve->type_tour = 'ONE';
            list($m, $d, $y) = explode("-", $fecha_salida);
            $reserve->fecha_ini = $y . '-' . $m . '-' . $d;
            $rastrostring .= "Date = " . $y . '-' . $m . '-' . $d . '&';
            $reserve->trip_no = "301";
            $reserve->trip_no2 = "300";
            $reserve->tipo_ticket = "roundtrip";
            $reserve->fromt = $from;
            Doo::loadModel('Areas');
            $froma = new Areas();
            $froma->id = $reserve->fromt;
            $froma = Doo::db()->getOne($froma);
            $rastrostring .= "From = " . $froma->nombre . '&';
            $reserve->tot = $to;
            $reserve->fromt2 = $reserve->tot;
            $reserve->tot2 = $to2;

            $toa = new Areas();
            $toa->id = $reserve->tot2;
            $toa = Doo::db()->getOne($toa);
            $rastrostring.= "To = " . $toa->nombre . '&';


            $reserve->firsname = $cliente->firstname;
            $reserve->lasname = $cliente->lastname;
            $reserve->email = $cliente->username;
            $reserve->deptime1 = $deptime1;
            $reserve->arrtime1 = $arrtime1;
            $reserve->deptime2 = $deptime2;
            $reserve->arrtime2 = $arrtime2;
            $reserve->pax = $adult;
            $reserve->pax2 = $child;
            $reserve->precioA = $pricexadult * $adult;
            $reserve->precioN = $pricexchild * $child;
            $reserve->extension1 = $ext_from1;
            $reserve->pickup2 = $reserve->dropoff1 = 1;
            $reserve->ip_op = $_SESSION['login']->id;
            if ($ext_from1 > 0) {
                $sql = 'select precio_neto from extension where id = ?';
                $rs = Doo::db()->query($sql, array($ext_from1));
                $cost = $rs->fetchAll();
                $reserve->extension1 = $ext_from1;
                $reserve->precio_e1 = $cost[0]['precio_neto'];
                $reserve->pickup_exten1 = $a_pickup2;
                $reserve->pickup1 = 0;
            } else {
                $reserve->pickup1 = $a_id_pickup1;
                $reserve->precio_e1 = 0;
                $reserve->pickup_exten1 = "";
            }
            if ($ext_to2 > 0) {
                $sql = 'select precio_neto from extension where id = ?';
                $rs = Doo::db()->query($sql, array($ext_to2));
                $cost = $rs->fetchAll();
                $reserve->extension4 = $ext_to2;
                $reserve->precio_e4 = $cost[0]['precio_neto'];
                $reserve->pickup_exten4 = $d_pickup2;
                $reserve->dropoff2 = 0;
            } else {
                $reserve->dropoff2 = $d_id_pickup1;
                $reserve->precio_e4 = 0;
                $reserve->pickup_exten4 = "";
            }

            $reserve->extension2 = $reserve->extension3 = 0;
            $reserve->precio_e2 = $reserve->precio_e3 = 0;
            $reserve->fecha_salida = $reserve->fecha_retorno = $y . '-' . $m . '-' . $d;
            $reserve->id_clientes = $cliente->id;
            if ($opcion_pago == 2 || $opcion_pago == 1 || $opcion_pago == 6) {
                $reserve->tipo_pago = "PRE-PAID";
            }
            if ($opcion_pago == 4 || $opcion_pago == 3) {
                $reserve->tipo_pago = "COLLECT ON BOARD";
            }
            if ($opcion_pago == 5) {
                $reserve->tipo_pago == "CREDIT VOUCHER";
            }
            if ($opcion_pago == 7) {
                $reserve->tipo_pago == "COMPLEMENTARY";
            }

            //en los pagos de oneday no trabajara con el string sino con el
            //numero de pago siendo 1. para agency credit card 2. passenger credit card
            //3. credit card +4 fee 4. cash 5. credit voucher 6. cash in terminal
            //7. complementary ademas se concatenara - y 1 si es paid full, 2 si es
            //paid balance o 0 si no es ninguno de las 2 opciones

            if (isset($opcion_saldo)) {
                $reserve->pago = $opcion_pago . '-' . $opcion_saldo;
            } else {
                $reserve->pago = $opcion_pago . '-0';
            }

            $reserve->total2 = $reserve->totaltotal = $totalreserve;
            $reserve->hora = date('H:i:s');
            $reserve->comments = 'Reserva de tours';
            if (isset($tipo_pass)) {
                $reserve->resident = 1;
            } else {
                $reserve->resident = 0;
            }
            $reserve->agency = $id_agency;
            $reserve->tipo_client = $cliente->tipo_client;
            $reserve->reward_id = 0;
            $reserve->luggage1 = $reserve->luggage2 = $a_luggage;
            if ($opcion_pago == 2 && $opcion_pago == 1 || $estado == "") {
                $reserve->estado = "CONFIRMED";
                $tour->estado = "CONFIRMED";
            } else {
                $reserve->estado = $estado;
                $tour->estado = $estado;
            }
            if ($byr == 1) {
                $reserve->canal = "PHONE";
            } else if ($byr == 2) {
                $reserve->canal = "MAIL";
            } else {
                $reserve->canal = "WEBSALE";
            }
            do {
                $mes = date("m");
                $dia = date("d");
                $y = date("y");
                if ($estado == strtoupper("CONFIRMED")) {
                    $prefix = "TO";
                } else {
                    $prefix = "QO";
                }
                $_SESSION['codconf'] = $prefix . $mes . $y . $dia . rand(0, 9999);
                $a = $this->db()->find('Tour_oneday', array('where' => 'code_conf = ?',
                    'limit' => 1,
                    'select' => 'code_conf',
                    'param' => array($_SESSION['codconf'])
                        )
                );
            } while ($a != null);

            $reserve->codconf = $_SESSION['codconf'];
            $reserve->id = $reserve->insert();
            Doo::loadModel('Attraction_Trafic');
            $parks = new Attraction_Trafic();
            $parks->type_tour = "ONE";
            $parks->id_park = $id_selected_park;
            $parks->group = $gid;
            list($m, $d, $y) = explode("-", $fecha_salida);
            $parks->creation_date = date('Y-m-d H:i');
            $parks->starting_date = $y . '-' . $m . '-' . $d;
            //echo '...............'.$parks->starting_date.'...............';
            $parks->ending_date = $y . '-' . $m . '-' . $d;
            //echo '...............'.$parks->ending_date.'...............';
            if (isset($adm_selector)) {
                $parks->admission = 1;
            } else {
                $parks->admission = 0;
            }
            $parks->trafic = 1;
            $parks->id_cliente = $cliente->id;
            $parks->type_client = $cliente->tipo_client;
            $parks->id_agencia = $id_agency;
            $parks->adult = $adult;
            $parks->child = $child;
            $parks->total_person = $child + $adult;
            
            ////
            $parks->child = $child;
            $parks->adult = $adult;
            $parks->admission_child = $child * $rate_childs;
            $parks->admission_adtul = $rate_adults * $adult;
            $parks->totalAdmission = $parks->admission_adtul + $parks->admission_child;
            
            /////
            $parks->totalTraspor = $trpark;
            if (isset($include_park)) {
                $parks->admission = 1;
                $parks->total_paid = $parks->totalAdmission + $parks->totalTraspor;
            } else {
                $parks->total_paid = $parks->totalTraspor;
            }
            $parks->id = $parks->insert();
            Doo::loadModel('Parques');
            if ($parks->admission == 1) {
                $parque = new Parques();
                $parque->id = $parks->id_park;
                $parque = Doo::db()->getOne($parque);
                $parque->stock = intval($parque->stock) - ($child + $adult);
                $parque->update();
            }
            Doo::loadModel('Parques');
            $pk = new Parques();
            $pk->id = $id_selected_park;
            $pk = Doo::db()->getOne($pk);
            $rastrostring.= "Park selected = " . $pk->nombre . "&";

            $tour->id_client = $cliente->id;
            $tour->type_client = $cliente->tipo_client;
            $tour->id_agency = $id_agency;
            $tour->agency_employee = $id_auser;
            $tour->creation_date = date("Y-m-d H:i");
            list($m, $d, $y) = explode("-", $fecha_salida);
            $tour->starting_date = $y . '-' . $m . '-' . $d;
            $tour->ending_date = $y . '-' . $m . '-' . $d;
            $tour->length_day = 1;
            $tour->length_nights = 0;
            $tour->adult = $adult;
            $tour->child = $child;
            $tour->id_transfer_in = -1;
            $tour->id_transfer_out = -1;
            $tour->comments = $comments;
            $tour->total = $total_first;
            $tour->totalouta = $total_total;
            if (isset($opcion_pago)) {

                if ($opcion_pago == '2') {
                    $tour->totalouta = $total_total - intval($rastrocom);
                }
            }
            $tour->otheramount = $otheramount;
            $tour->extra_charge = $extra;
            $tour->descuento_procentaje = $descuento;
            $tour->descuento_valor = $descuento_valor;

            $rastrostring .= "$ Discount = " . $descuento_valor . '&';
            $rastrostring .= "% Discount = " . $descuento . '&';
            $rastrostring .= "Extra = " . $extra . '&';
            $rastrostring .= "Other Amount = " . $otheramount . '&';
            $rastrostring .= "Tour Cost = " . $total_first . '&';
            $rastrostring .= "Total Cost = " . $total_total . '&';


            if (isset($include_park)) {
                $tour->include_park = true;
            } else {
                $tour->include_park = false;
            }
            if ($byr == 1) {
                $tour->canal = "PHONE";
            } else if ($byr == 2) {
                $tour->canal = "MAIL";
            } else {
                $tour->canal = "WEBSALE";
            }


            $tour->code_conf = $reserve->codconf;
            $tour->id_reserva = $reserve->id;
            $tour->id = $tour->insert();

            Doo::loadModel('CollectService');
            $collected = new CollectService();
            $collected->id_servicio = $tour->id;
            $collected->tipo_servicio = "ONE";
            $collected->monto_pagado = 0;
            $collected->id = $collected->insert();

            //facturamos de ser necesario
            // generamos la factura del servicio //

            if ($opcion_pago == 3 || $opcion_pago == 4) {
                $collected->monto_pagado = $tour->totalouta;
                $collected->update();
            }



            $reserve->id_tours = $tour->id;
            $reserve->update();
            $sql = "update attraction_trafic as p set p.id_tours=? where p.id=?;";
            $rs = Doo::db()->query($sql, array($tour->id, $parks->id));

            $rastro->fecha = date('y-m-d h:i:s');
            $rastro->tipo_cambio = "CREATE";
            $rastro->id_tours = $tour->id;
            $rastro->tipo_usuario = "OPERATOR";
            $rastro->usuario = $_SESSION['login']->id;
            $rastro->detalles = $rastrostring;
            $rastro->insert();

            Doo::loadModel('Tours_Agency');
            if ($id_agency != -1) {
                $ta = new Tours_Agency();
                $ta->id_reserva = $reserve->id;
                $ta->id_tours = $tour->id;
                $ta->type_tour = "ONE";
                $ta->comision = 15;
                if ($ta->type_rate == 0) {
                    $ta->agency_fee = $rastrocom;
                }
                if ($opcion_pago == 4 || $opcion_pago == 3) {
                    $ta->tipo_pago = "COLLECT ON BOARD";
                }
                if ($opcion_pago == 5) {
                    $ta->tipo_pago == "CREDIT VOUCHER";
                }
                if ($opcion_pago == 7) {
                    $ta->tipo_pago == "COMPLEMENTARY";
                }

                if ($opcion_saldo == 1) {
                    $sufix = '- FULL';
                } else {
                    $sufix = '- BALANCE';
                }

                if ($opcion_pago == 2) {
                    $prefix = 'PASSENGER CREDIT CARD';
                }if ($opcion_pago == 1) {
                    $prefix = 'AGENCY CREDIT CARD';
                }if ($opcion_pago == 3) {
                    $prefix = 'CREDIT CARD 4% FEE';
                }if ($opcion_pago == 4) {
                    $prefix = 'CASH';
                }if ($opcion_pago == 5) {
                    $prefix = 'CREDIT VOUCHER';
                }if ($opcion_pago == 6) {
                    $prefix = 'CASH IN TERMINAL';
                }if ($opcion_pago == 7) {
                    $prefix = 'COMPLEMENTARY';
                    $sufix = '';
                }
                $ta->pago = $prefix . $sufix;
                $ta->total = $total_first;
                $ta->totalouta = $total_total;
                $ta->otheramount = $otheramount;
                Doo::db()->insert($ta);
            }
        } catch (Exception $e) {
            echo $e;
        }

        if ($opcion_pago == 2) {
            if (isset($cardholder)) {
                if ($zip != "" && $country != "" && $state != "" && $address != "" && $city != "") {
                    $cliente->zip = $zip;
                    $cliente->country = $country;
                    $cliente->state = $state;
                    $cliente->address = $address;
                    $cliente->city = $city;
                    $cliente->update();
                }
                $this->data['usuario'] = $cliente;
            } else {
                $cli = new Clientes();
                $cli->firstname = $firstname;
                $cli->lastname = $lastname;
                $cli->username = $username;
                $cli->phone = $phone;
                $cli->country = $country;
                $cli->state = $state;
                $cli->city = $city;
                $cli->address = $address;
                $cli->zip = $zip;
                $this->data['usuario'] = $cli;
            }
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['apagar'] = $tour->totalouta;
            if ($id_agency != -1 && $type_rate == 0) {
                if ($opcion_saldo == 1) {
                    $this->data['apagar'] = $tour->totalouta;
                } else if ($opcion_saldo == 2) {
                    $this->data['apagar'] = $tour->totalouta - $rastrocom;
                }
            }
            $_SESSION['tours_pago'] = '...';
            $this->view()->renderc('admin/configuracion/pago_onedaytour', $this->data);
            return Doo::conf()->APP_URL . "admin/onedaytour";
        }

        if ($opcion_pago == 1) {
            Doo::loadModel('Agency');
            $a = new Agency();
            $a->id = $tour->id_agency;
            $a = Doo::db()->getOne($a);
            $manager = new Clientes();
            $manager->username = $a->main_email;
            $manager->firstname = $a->company_name;
            $manager->lastname = $a->manager;
            $manager->address = $a->address;
            $manager->state = $a->state;
            $manager->zip = $a->zipcode;
            $manager->phone = $a->phone1;
            $this->data['usuario'] = $manager;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            if ($opcion_saldo == 1) {
                $this->data['apagar'] = $tour->totalouta;
            } else if ($opcion_saldo == 2) {
                $this->data['apagar'] = $tour->totalouta - $rastrocom;
            }
            $this->view()->renderc('admin/configuracion/pago_onedaytour', $this->data);
            return Doo::conf()->APP_URL . "admin/onedaytour";
        }

        if ($reserve->tipo_pago == 'COLLECT ON BOARD' || $reserve->tipo_pago == 'CREDIT VOUCHER' || $reserve->tipo_pago == "COMPLEMENTARY") {
            //ruta provisional
            if ($estado != 'QUOTE') {
                $this->enviar_correo($tour->id);
            }
            return Doo::conf()->APP_URL . 'admin/onedaytour/';
        }

        if ($opcion_pago == 6) {
            $this->enviar_correo($tour->id);
        }

        return Doo::conf()->APP_URL . 'admin/onedaytour/';
    }

    public function list_quoted() {
        if (isset($_SESSION['codconf']) || isset($_SESSION['tours_pago'])) {
            unset($_SESSION['codconf']);
            unset($_SESSION['tours_pago']);
        }


        if (!isset($_POST["filtro2"])) {
            if (!isset($this->params['filtro2'])) {

                $filtro = "id_clientes";
            } else {
                $filtro = $this->params['filtro2'];
            }
        } else {

            $filtro = $_POST["filtro2"];
            /* echo $filtro; */
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

        $page = $this->params['pindex'];

        $rs = Doo::db()->find("Tour_oneday", array("select" => "COUNT(*) AS total",
            "where" => "'$filtro' like ? and estado = 'QUOTE'",
            "limit" => 1,
            "param" => array($texto . '%')
        ));
        Doo::loadHelper('DooPager');
        $total = $rs->total;
        if ($total == 0) {
            $total = 1;
        }
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/onedaytour/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $sql = "SELECT DISTINCT t.`id` , t.`id_client` , t.`type_client` , t.`id_agency` , t.`code_conf` , t.`agency_employee` , t.`creation_date` , t.`starting_date` , t.`ending_date` , t.`length_day` , t.`length_nights` , t.`id_reserva` , t.`id_transfer_in` , t.`id_transfer_out` , t.`total` , t.`totalouta` , t.`otheramount` , t.`extra_charge` , CONCAT( c.firstname,  ' ', c.lastname ) AS nomcliente, company_name, CONCAT( ua.firstname,  ' ', ua.lastname ) AS nomempleado
                FROM  `tours_oneday` t
                LEFT JOIN clientes c ON ( t.id_client = c.id ) 
                LEFT JOIN agencia ag ON ( t.id_agency = ag.id ) 
                LEFT JOIN user_agencia ua ON ( t.agency_employee = ua.id ) 
                WHERE t.code_conf LIKE  ? and estado = 'QUOTE'
                ORDER BY t.`id` DESC limit $pager->limit";
        $rs = Doo::db()->query($sql, array($texto . '%'));
        $tours = $rs->fetchAll();
        $rs->closeCursor();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/onedaytours.php';
        $this->data['filtro2'] = $filtro;
        $this->data['texto2'] = $texto;
        $this->data['tours'] = $tours;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function list_oneday() {
        if (isset($_SESSION['codconf']) || isset($_SESSION['tours_pago'])) {
            unset($_SESSION['codconf']);
            unset($_SESSION['tours_pago']);
        }


        if (!isset($_POST["filtro2"])) {
            if (!isset($this->params['filtro2'])) {

                $filtro = "id_clientes";
            } else {
                $filtro = $this->params['filtro2'];
            }
        } else {

            $filtro = $_POST["filtro2"];
            /* echo $filtro; */
        }

        if (!isset($_POST["texto2"])) {
            if (!isset($this->params['texto2'])) {
                $texto = "";
            } else {
                $texto = $this->params['texto2'];
            }
        } else {

            $texto = $_POST["texto2"];
//            echo $texto;
        }

        $page = $this->params['pindex'];

        $rs = Doo::db()->find("Tour_oneday", array("select" => "COUNT(*) AS total",
            "where" => "'$filtro' like ? and estado = 'CONFIRMED'",
            "limit" => 1,
            "param" => array($texto . '%')
        ));
        Doo::loadHelper('DooPager');
        $total = $rs->total;
        if ($total == 0) {
            $total = 1;
        }
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/onedaytour/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $sql = "SELECT DISTINCT t.`id` , t.`id_client` , t.`type_client` , t.`id_agency` , t.`code_conf` , t.`agency_employee` , t.`creation_date` , t.`starting_date` , t.`ending_date` , t.`length_day` , t.`length_nights` , t.`id_reserva` , t.`id_transfer_in` , t.`id_transfer_out` , t.`total` , t.`totalouta` , t.`otheramount` , t.`extra_charge` , CONCAT( c.firstname,  ' ', c.lastname ) AS nomcliente, company_name, CONCAT( ua.firstname,  ' ', ua.lastname ) AS nomempleado
                FROM  `tours_oneday` t
                LEFT JOIN clientes c ON ( t.id_client = c.id ) 
                LEFT JOIN agencia ag ON ( t.id_agency = ag.id ) 
                LEFT JOIN user_agencia ua ON ( t.agency_employee = ua.id ) 
                WHERE t.code_conf LIKE  ? and estado = 'CONFIRMED'
                ORDER BY t.`id` DESC limit $pager->limit";
        $rs = Doo::db()->query($sql, array($texto . '%'));
        $tours = $rs->fetchAll();
        $rs->closeCursor();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/onedaytours_quoted.php';
        $this->data['filtro2'] = $filtro;
        $this->data['texto2'] = $texto;
        $this->data['tours'] = $tours;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function complete_client() {
        $sql = "select country,city,state,address,zip from clientes where id= ?";
        $rs = Doo::db()->query($sql, array($this->params['id']));
        $results = $rs->fetchAll();
        $output = true;
        foreach ($results[0] as $r => $v) {
            //echo $v;
            if ($v == "") {
                $output = '<input type="hidden" value="false" id="complete">';
                break;
            }
            $output = '<input type="hidden" value="true" id="complete">';
        }

        echo $output;
    }

    public function edit_oneday() {
        if (isset($_SESSION['codconf']) || isset($_SESSION['tours_pago'])) {
            unset($_SESSION['codconf']);
            unset($_SESSION['tours_pago']);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "select * from grupo_parques";
        $query = Doo::db()->query($sql);
        $rs2 = $query->fetchAll();
        $this->data['grupos'] = $rs2;

        $id = $this->params['id'];

        Doo::loadModel('Tour_oneday');
        $tour = new Tour_oneday();
        $tour->id = $id;

        $q = "select * from toursone_rastro where id_tours = ?";
        $r = Doo::db()->query($q, array($tour->id));
        $rs = $r->fetchAll();
        $this->data['rastros'] = $rs;

        $tour = Doo::db()->find($tour, array("limit" => 1));
        if (empty($tour)) {
            return Doo::conf()->APP_URL . 'admin/home/';
        }


        $sql = "SELECT DISTINCT t1.trip_to AS id, t2.nombre
				FROM routes t1
				LEFT JOIN areas t2 ON ( t1.trip_to = t2.id ) 
				WHERE t1.trip_from =1";
        $rs = Doo::db()->query($sql);
        $to_areas = $rs->fetchAll();
        $this->data['to_areas'] = $to_areas;
        $this->data['countries'] = Doo::db()->fetchAll("SELECT * FROM  country ");
        $this->data['states'] = Doo::db()->fetchAll("SELECT * FROM  state ");
        $this->data['estado'] = $tour->estado;
        Doo::loadModel('Clientes');
        $cli = new Clientes();
        $cli->id = $tour->id_client;
        $cli = Doo::db()->getOne($cli);
        $this->data['cliente'] = $cli;
        $scripts = "";

        if ($tour->id_agency != -1) {
            Doo::loadModel('Agency');
            $ag = new Agency();
            $ag->id = $tour->id_agency;
            $ag = Doo::db()->getOne($ag);
            $this->data['agency'] = $ag;
            Doo::loadModel('UserA');
            $uag = new UserA();
            $uag->id = $tour->agency_employee;
            $uag = Doo::db()->getOne($uag);
            $this->data['uag'] = $uag;
            $scripts .='<script>
                    $(function(){
                    $("#userr").load("' . Doo::conf()->APP_URL . 'admin/tours/cargardatos/' . $ag->id . '/agency");
                    });
                    </script>';
        }

        Doo::loadModel('Reserve');
        $res = new Reserve();
        $res->id = $tour->id_reserva;
        $res = Doo::db()->getOne($res);
        //aqui aqui
        $scripts .= "<script>$(function(){
                                $('#from').val(" . $res->fromt . ");
                                $('#to2').val(" . $res->tot2 . ");
                                $('#ext_from1').load('" . Doo::conf()->APP_URL . "consul/exten/" . $res->fromt . "',function(){\$('#ext_from1').val(" . $res->extension1 . ");});
                                $('#ext_to2').load('" . Doo::conf()->APP_URL . "consul/exten/" . $res->tot2 . "',function(){\$('#ext_to2').val(" . $res->extension4 . ");});
                                    });</script>";
        Doo::loadModel('PickupDropoff');
        $pupoint = new PickupDropoff();
        $dopoint = new PickupDropoff();
        $pupoint->id = $res->pickup1;
        $dopoint->id = $res->dropoff2;
        $pupoint = Doo::db()->getOne($pupoint);
        $dopoint = Doo::db()->getOne($dopoint);
        $this->data['pickup'] = $pupoint;
        $this->data['dropoff'] = $dopoint;
        if ($res->extension1 != 0) {
            $scripts.= '<script>$(function(){
                    $("#a_pickup2").val("' . $res->pickup_exten1 . '");
                    $("#a_pickup2").attr("disabled",false);
                    $("#a_pickup1").attr("disabled",true);
                    });</script>';
            Doo::loadModel('Extension');
            $ext1 = new Extension();
            $ext1->id = $res->extension1;
            $ext1 = Doo::db()->getOne($ext1);
            $this->data['ext1'] = $ext1;
        } else {
            $scripts.= '<script>$(function(){
                    $("#ext_from1").val(0);
                    $("#a_pickup2").attr("disabled",true);
                    $("#a_pickup1").attr("disabled",false);
                    });</script>';
        }

        $scripts.='<script>
                    $(function(){
                    var tres = (parseInt($("#pricexadult").val())*parseInt($("#adult").val()) + parseInt($("#pricexchild").val())*parseInt($("#child").val()))/2;
                    var ttres = 0;
                    if(' . $res->extension1 . '> 0){
                    ttres = parseInt($("#cost_ext").val())*(parseInt($("#child").val())+parseInt($("#adult").val()));
                    console.log(ttres+"......1...............");
                    }
                    $("#totalreserve").val(tres+ttres);
                    if(tres != Math.NaN){
                    $("#price_transport1pp").html("$"+Math.ceil(tres+ttres).toFixed(2))
                    }
                    });
                </script>';
        if ($res->extension4 != 0) {
            $scripts.= '<script>$(function(){
                    $("#d_pickup2").val("' . $res->pickup_exten4 . '");
                    $("#d_pickup2").attr("disabled",false);
                    $("#d_pickup1").attr("disabled",true);
                    });</script>';
            Doo::loadModel('Extension');
            $ext2 = new Extension();
            $ext2->id = $res->extension4;
            $ext2 = Doo::db()->getOne($ext2);
            $this->data['ext2'] = $ext2;
        } else {
            $scripts.= '<script>$(function(){
                    $("#ext_to2").val(0);
                    $("#d_pickup2").attr("disabled",true);
                    $("#d_pickup1").attr("disabled",false);
                    });</script>';
        }
        $rate = (isset($ag->id) ? $ag->type_rate : '0');
        $rs = Doo::db()->query('select * from onetour where type_rate = ? and annio = ?;', array($rate, substr($tour->starting_date, 0, 4) . '-01-01 00:00:00'));
        $costs = $rs->fetchAll();
        $this->data['pricexchild'] = $costs[0]['pricechild'];
        $this->data['pricexadult'] = $costs[0]['priceadult'];
        $scripts.= '<script> $(function(){
                     var tres = (parseInt($("#pricexadult").val())*parseInt($("#adult").val()) + parseInt($("#pricexchild").val())*parseInt($("#child").val()))/2;
                     var ttres = 0;
                     if(' . $res->extension4 . '> 0 ){
                     ttres = parseInt($("#cost_ext2").val())*(parseInt($("#child").val())+parseInt($("#adult").val()));
                     }
                     $("#totalreserver").val(parseInt(tres)+parseInt(ttres));
                     if(tres != Math.NaN){
                     $("#price_transport2pp").html("$"+Math.ceil(tres+ttres).toFixed(2))
                     }
                    });</script>';

        Doo::loadModel('Attraction_Trafic');
        $parkatr = new Attraction_Trafic();
        $parkatr->id_tours = $tour->id;
        $parkatr->type_tour = "ONE";
        $parkatr = Doo::db()->getOne($parkatr);
        Doo::loadModel('Parques');
        $park = new Parques();
        $park->id = $parkatr->id_park;
        $park = Doo::db()->getOne($park);
        Doo::loadModel('Grupo_parque');
        $grupo = new Grupo_parque();
        $grupo->id = $park->id_grupo;
        $grupo = Doo::db()->getOne($grupo);
        $this->data['grupo'] = $grupo;

        $this->data['attr'] = $parkatr;
        $this->data['park'] = $park;
        $this->data['grupo'] = $grupo;
        $scripts.= '<script>$(function(){
        $("#categoria_park").val(' . $grupo->id . ');
        });</script>';
        if ($tour->id_agency != -1) {
            Doo::loadModel('Tours_Agency');
            $ta = new Tours_Agency();
            $ta->id_tours = $tour->id;
            $ta = Doo::db()->getOne($ta);
            $this->data['ta'] = $ta;
        }
////////
        $sql = "SELECT p.nombre, t.adults, t.child, t.cantidad, p.id_grupo AS gid, g.nombre AS gnombre
            FROM parques AS p, admin_parques_tarifa AS t, grupo_parques AS g
            WHERE p.id_grupo = t.id_grupo
            AND t.cantidad =1
            AND p.id = ?
            AND type_rate =1
            AND t.id_agency = ?
            AND g.id = p.id_grupo
            ORDER BY t.cantidad DESC 
            LIMIT 1";
        $rs = Doo::db()->query($sql, array($park->id, ((isset($ag->id)) ? $ag->id : -1)));

        if ($rs->rowCount() == 0) {
            $sql = "SELECT p.nombre, t.adults, t.child, t.cantidad, p.id_grupo AS gid, g.nombre AS gnombre
            FROM parques AS p, admin_parques_tarifa AS t, grupo_parques AS g
            WHERE p.id_grupo = t.id_grupo
            AND t.cantidad =1
            AND p.id = ?
            AND type_rate =1
            AND t.id_agency = -1
            AND g.id = p.id_grupo
            ORDER BY t.cantidad DESC 
            LIMIT 1";
            $rs = Doo::db()->query($sql, array($park->id));
        }

        $parks_rates = $rs->fetchAll();
        $this->data['tpricexchild'] = $parks_rates[0]['child'];
        $this->data['tpricexadult'] = $parks_rates[0]['adults'];

        $this->data['actual_amount'] = $tour->totalouta;

        list($opcion_pago, $opcion_saldo) = explode("-", $res->pago);
        if ($tour->canal == "WEBSALE") {
            //cambio del tipo de pago que se usaba antes en la web, al que se usa en el admin de oneday
            if ($opcion_pago == "Cash") {
                $opcion_pago = 4;
            }
            if ($opcion_pago == "Credit Card+ 4 % FEE") {
                $opcion_pago = 3;
            }
            if ($opcion_pago == "Credit Voucher") {
                $opcion_pago = 5;
            }
            if ($opcion_pago == "Agency Credit Card") {
                $opcion_pago = 1;
            }
            if ($opcion_pago == "Passenger Credit Card") {
                $opcion_pago = 2;
            }
            if ($opcion_pago == "Cash in terminal") {
                $opcion_pago = 6;
            }
            if ($opcion_pago == "Complementary") {
                $opcion_pago = 7;
            }

            if ($opcion_saldo == "FULL") {
                $opcion_saldo = 1;
            }
            if ($opcion_saldo == "BALANCE") {
                $opcion_saldo = 2;
            }
        }


        $scripts.='<script>
                    $(function(){
                    var sel_payment = ' . $opcion_pago . ';
                    $("input[name=opcion_pago][value="+sel_payment+"]").attr("checked",true);
                    var sel_option_amount = ' . $opcion_saldo . ';
                    $("input[name=opcion_saldo][value="+sel_option_amount+"]").attr("checked",true);
                    });
               </script>';
        list($pago, $saldo) = explode("-", $res->pago);
        $res->tipo_pago = $pago . '-' . $saldo;
        $this->data['res'] = $res;
        $this->data['tour'] = $tour;
        $this->data['saldo'] = $saldo;
        if ($pago == 2 || $pago == 1) {
            $sql = 'SELECT SUM(pagado) FROM tours_pago where id_tours = ? and tipo = "ONE" ;';
            $rs = Doo::db()->query($sql, array($tour->id));
            $prepaid = $rs->fetchAll();
            $this->data['prepaid'] = $prepaid[0]['SUM(pagado)'];

            if ($pago == 2) {
                $scripts.='<script>
                $(function(){
                    $("#opcion_pago_passager").trigger("click");
                });
                </script>';
            } else {
                $scripts.='<script>
                $(function(){
                    $("#opcion_pago_agency").trigger("click");
                });
                </script>';
            }
        }

        if ($tour->include_park) {
            $scripts.='<script>
                    $("#total_parks").val(' . $parkatr->totalAdmission . ');
                    </script>';
        }

        $scripts.='<script>
        $(function(){
        $("#total_total").val(' . $tour->totalouta . ')
        calcularTotalPago();
        $("#bnt-save2").hide();
        });
        </script>';
        if ($tour->id_agency != -1) {
            $scripts.='
                <script>$(function(){
                    $("#debug").load("' . Doo::conf()->APP_URL . 'admin/tours/cargardatos/' . $tour->id_agency . '/agency");
                })</script>';
        }
        $this->data['scripts'] = $scripts;
        $this->data['content'] = 'configuracion/frm_onedaytour_edit.php';
        $this->view()->renderc('admin/index', $this->data);
    }

    public function save_edited_oneday() {

        Doo::loadModel('Tour_oneday');
        $tour = new Tour_oneday();
        try {
            extract($_POST, EXTR_SKIP);
            $tour->code_conf = $code_conf;
            $tour = Doo::db()->getOne($tour);

            Doo::loadModel('Clientes');
            $cliente = new Clientes();
            $cliente->id = $tour->id_client;
            $cliente = Doo::db()->getOne($cliente);

            Doo::loadModel('Toursoneday_Rastro');
            $rastro = new Toursoneday_Rastro();


            Doo::loadModel('Reserve');
            $reserve = new Reserve();
            $reserve->id = $tour->id_reserva;
            $reserve->type_tour = 'ONE';
            $reserve = Doo::db()->getOne($reserve);

            Doo::loadModel('Attraction_Trafic');
            $parks = new Attraction_Trafic();
            $parks->type_tour = "ONE";
            $parks->id_tours = $tour->id;
            $parks = Doo::db()->getOne($parks);

            $rastrostring = "";
            if ($tour->estado != $estado) {
                $tour->estado = $estado;
                $reserve->estado = $estado;
                //cambio de estado
                $rastrostring.= "Status = " . $estado . "&";
            }
            $cambio_tickets = false;
            if ($tour->id_client != $idCliente) {
                $tour->id_client = $idCliente;
                $reserve->firsname = $cliente->firstname;
                $reserve->lasname = $cliente->lastname;
                $reserve->email = $cliente->username;
                $reserve->id_clientes = $cliente->id;
                $reserve->tipo_client = $cliente->tipo_client;
                $tour->type_client = $cliente->tipo_client;
                //crear rastro de cambio de cliente;
                $rastrostring.= "Customer = " . $cliente->lastname . ' ' . $cliente->firstname . '&';
            }

            list($m, $d, $y) = explode("-", $fecha_salida);

            if ($reserve->fecha_ini != $y . '-' . $m . '-' . $d) {
                $reserve->fecha_ini = $y . '-' . $m . '-' . $d;
                $reserve->fecha_salida = $reserve->fecha_retorno = $y . '-' . $m . '-' . $d;
                $reserve->tipo_ticket = "roundtrip";
                //cambio dia del tour
                $rastrostring.= "Date = " . $fecha_salida . "&";
            }

            $reserve->trip_no = "301";
            $reserve->trip_no2 = "300";
            $reserve->tot = $to;
            $reserve->fromt2 = $reserve->tot;

            Doo::loadModel('Areas');
            $froma = new Areas();
            $froma->id = $from;
            $froma = Doo::db()->getOne($froma);

            if ($reserve->fromt != $from) {
                $reserve->fromt = $from;
                $reserve->deptime1 = $deptime1;
                $reserve->arrtime1 = $arrtime1;
                //cambio el lugar de salida del tour
                $rastrostring.= "From = " . $froma->nombre . "&";
            }

            Doo::loadModel('Areas');
            $toa = new Areas();
            $toa->id = $to2;
            $toa = Doo::db()->getOne($toa);

            if ($reserve->tot2 != $to2) {
                $reserve->tot2 = $to2;
                $reserve->deptime2 = $deptime2;
                $reserve->arrtime2 = $arrtime2;
                //cambio el lugar de arribo del tour
                $rastrostring.= "To = " . $toa->nombre . "&";
            }

            if ($reserve->pax != $adult || $reserve->pax2 != $child) {
                $reserve->pax = $adult;
                $reserve->pax2 = $child;
                $reserve->precioA = $pricexadult * $adult;
                $reserve->precioN = $pricexchild * $child;
                //cambio el numero de pasajeros
                $rastrostring.= "Total Pax = " . ($adult + $child) . "&";
            }

            if ($reserve->extension1 != $ext_from1) {
                $reserve->extension1 = $ext_from1;
                $reserve->pickup2 = $reserve->dropoff1 = 1;
                if ($ext_from1 > 0) {
                    $sql = 'select precio_neto from extension where id = ?';
                    $rs = Doo::db()->query($sql, array($ext_from1));
                    $cost = $rs->fetchAll();
                    $reserve->extension1 = $ext_from1;
                    $reserve->precio_e1 = $cost[0]['precio_neto'];
                    $reserve->pickup_exten1 = $a_pickup2;
                    $reserve->pickup1 = 0;
                    $rastrostring.= "From extension = " . $a_pickup2 . "&";
                } else {
                    $reserve->pickup1 = $a_id_pickup1;
                    $reserve->precio_e1 = 0;
                    $reserve->pickup_exten1 = "";
                }
                //cambio la extencion de recoger al pasajero
            }
            if ($reserve->extension4 != $ext_to2) {
                if ($ext_to2 > 0) {
                    $sql = 'select precio_neto from extension where id = ?';
                    $rs = Doo::db()->query($sql, array($ext_to2));
                    $cost = $rs->fetchAll();
                    $reserve->extension4 = $ext_to2;
                    $reserve->precio_e4 = $cost[0]['precio_neto'];
                    $reserve->pickup_exten4 = $d_pickup2;
                    $reserve->dropoff2 = 0;
                    $rastrostring.= "From extension = " . $d_pickup2 . "&";
                } else {
                    $reserve->dropoff2 = $d_id_pickup1;
                    $reserve->precio_e4 = 0;
                    $reserve->pickup_exten4 = "";
                }
                //cambio la extencion de retorno del pasajero
            }


            $reserve->extension2 = $reserve->extension3 = 0;
            $reserve->precio_e2 = $reserve->precio_e3 = 0;
            list($pago, $saldo) = explode("-", $reserve->pago);
            if (!isset($opcion_saldo)) {
                $opcion_saldo = 0;
            }
            if ($reserve->pago != $opcion_pago . '-' . $opcion_saldo) {
                if ($pago == 2 || $pago == 1 || $pago == 6) {
                    $reserve->tipo_pago = "PRE-PAID";
                }
                if ($pago == 4 || $pago == 3) {
                    $reserve->tipo_pago = "COLLECT ON BOARD";
                }
                if ($pago == 5) {
                    $reserve->tipo_pago == "CREDIT VOUCHER";
                }
                if ($pago == 7) {
                    $reserve->tipo_pago == "COMPLEMENTARY";
                }
                //cambio el tipo de pago
                if (isset($opcion_saldo)) {
                    $reserve->pago = $opcion_pago . '-' . $opcion_saldo;
                } else {
                    $reserve->pago = $opcion_pago . '-0';
                }
            }
            //en los pagos de oneday no trabajara con el string sino con el
            //numero de pago siendo 1. para agency credit card 2. passenger credit card
            //3. credit card +4 fee 4. cash 5. credit voucher 6. cash in terminal
            //7. complementary ademas se concatenara - y 1 si es paid full, 2 si es
            //paid balance o 0 si no es ninguno de las 2 opciones



            $reserve->total2 = $reserve->totaltotal = $totalreserve;
            $reserve->hora = date('H:i:s');
            $reserve->comments = 'Reserva de tours';

            if (isset($tipo_pass)) {
                $reserve->resident = 1;
            } else {
                $reserve->resident = 0;
            }

            if ($tour->id_agency != $id_agency) {
                //se cambio la agencia
                $reserve->agency = $id_agency;
                $tour->id_agency = $id_agency;
                $tour->agency_employee = $id_auser;
                Doo::loadModel('Agency');
                $a = new Agency();
                $a->id = $tour->id_agency;
                $a = Doo::db()->getOne($a);
                $rastrostring.= "Agency = " . $a->company_name . "&";
                Doo::loadModel('Tours_Agency');
                if ($id_agency != -1) {
                    $ta = new Tours_Agency();
                    $ta->id_reserva = $reserve->id;
                    $ta->id_tours = $tour->id;
                    $ta->type_tour = "ONE";
                    $ta->id_agencia = $tour->id_agency;
                    $ta->delete();
                    $ta = new Tours_Agency();
                    $ta->id_agencia = $id_agency;
                    $ta->id_reserva = $reserve->id;
                    $ta->id_tours = $tour->id;
                    $ta->type_tour = "ONE";
                    $ta->comision = 15;

                    if ($ta->type_rate == 0) {
                        $ta->agency_fee = $rastrocom;
                    }
                    if ($opcion_pago == 4 || $opcion_pago == 3) {
                        $ta->tipo_pago = "COLLECT ON BOARD";
                    }
                    if ($opcion_pago == 5) {
                        $ta->tipo_pago == "CREDIT VOUCHER";
                    }
                    if ($opcion_pago == 7) {
                        $ta->tipo_pago == "COMPLEMENTARY";
                    }

                    if ($opcion_saldo == 1) {
                        $sufix = '- FULL';
                    } else {
                        $sufix = '- BALANCE';
                    }

                    if ($opcion_pago == 2) {
                        $prefix = 'PASSENGER CREDIT CARD';
                    }if ($opcion_pago == 1) {
                        $prefix = 'AGENCY CREDIT CARD';
                    }if ($opcion_pago == 3) {
                        $prefix = 'CREDIT CARD 4% FEE';
                    }if ($opcion_pago == 4) {
                        $prefix = 'CASH';
                    }if ($opcion_pago == 5) {
                        $prefix = 'CREDIT VOUCHER';
                    }if ($opcion_pago == 6) {
                        $prefix = 'CASH IN TERMINAL';
                    }if ($opcion_pago == 7) {
                        $prefix = 'COMPLEMENTARY';
                        $sufix = '';
                    }

                    $ta->pago = $prefix . $sufix;
                    $ta->total = $total_first;
                    $ta->totalouta = $total_total;
                    $ta->otheramount = $otheramount;
                    Doo::db()->insert($ta);
                }
            }

            $reserve->rewrad_id = 0;
            $reserve->luggage1 = $reserve->luggage2 = $a_luggage;
            if ($byr == 1) {
                $reserve->canal = "PHONE";
            } else if ($byr == 2) {
                $reserve->canal = "MAIL";
            } else {
                $reserve->canal = "WEBSALE";
            }


            //$reserve->id = $reserve->insert();

            $cambio_park = false;
            if ($parks->id_park != $id_selected_park) {
                /* $parks->id_park = $id_selected_park;
                  $parks->id_tour */
                /* $parks->group = $gid;
                  list($m,$d,$y) = explode("-",$fecha_salida);
                  $parks->creation_date = date('Y-m-d H:i');
                  $parks->starting_date = $y.'-'.$m.'-'.$d;
                  //echo '...............'.$parks->starting_date.'...............';
                  $parks->ending_date = $y.'-'.$m.'-'.$d;
                  //echo '...............'.$parks->ending_date.'...............';
                  $parks->admission = 1;
                  $parks->trafic = 1;
                  $parks->id_cliente = $cliente->id;
                  $parks->type_client = $cliente->tipo_client;
                  $parks->id_agencia = $id_agency;
                  $parks->adult = $adult;
                  $parks->child = $child;
                  $parks->total_person = $child + $adult;
                  $parks->child = $child;
                  $parks->adult = $adult;
                  $parks->admission_child = $child * $rate_childs;
                  $parks->admission_adtul = $rate_adults * $adult;

                  $parks->totalTraspor = $trpark;
                  $parks->total_paid = $parks->totalAdmission + $parks->totalTraspor; */
                $cambio_park = true;
                //se cambio el parque a visitar
            }
            //$parks->id = $parks->insert();
            //$tour->id_client = $cliente->id;


            Doo::loadModel('Parques');
            $apark = new Parques();
            $apark->id = $parks->id_park;
            $apark = Doo::db()->getOne($apark);
            if ($parks->admission = 1) {
                $apark->stock = intval($apark->stock) + ($tour->adult + $tour->child);
            }
            $apark->update();

            list($m, $d, $y) = explode("-", $fecha_salida);
            $tour->starting_date = $y . '-' . $m . '-' . $d;
            $tour->ending_date = $y . '-' . $m . '-' . $d;
            $tour->length_day = 1;
            $tour->length_nights = 0;
            $tour->adult = $adult;
            $tour->child = $child;
            $tour->id_transfer_in = -1;
            $tour->id_transfer_out = -1;
            $tour->comments = $comments;
            $tour->total = $total_first;
            $tour->totalouta = $total_total;

            if (!$tour->include_park && isset($include_park)) {
                $cambio_tickets = true;
            }

            if (isset($include_park)) {
                $tour->include_park = true;
            } else {
                $tour->include_park = false;
            }

            if ($tour->otheramount != $otheramount) {
                $tour->otheramount = $otheramount;
                //cambio el other amount
            }
            if ($tour->extra_charge != $extra) {
                $tour->extra_charge = $extra;
                //cambio el cargo extra
            }
            if ($tour->descuento_procentaje != $descuento) {
                $tour->descuento_procentaje = $descuento;
                //cambio el % de descuento
            }
            if ($tour->descuento_procentaje != $descuento_valor) {
                $tour->descuento_valor = $descuento_valor;
                //cambio el valor de descuento
            }
            if ($byr == 1) {
                $tour->canal = "PHONE";
            } else if ($byr == 2) {
                $tour->canal = "MAIL";
            } else {
                $tour->canal = "WEBSALE";
            }

            $reserve->update();


            Doo::db()->delete($parks);
            //incertamos el nuevo parque por si cambiaron algo del anterior
            $parks = new Attraction_Trafic();
            $parks->type_tour = "ONE";
            $parks->id_park = $id_selected_park;
            $parks->group = $gid;
            list($m, $d, $y) = explode("-", $fecha_salida);
            $parks->creation_date = date('Y-m-d H:i');
            $parks->starting_date = $y . '-' . $m . '-' . $d;
            //echo '...............'.$parks->starting_date.'...............';
            $parks->ending_date = $y . '-' . $m . '-' . $d;
            //echo '...............'.$parks->ending_date.'...............';
            $parks->trafic = 1;
            $parks->id_cliente = $cliente->id;
            $parks->type_client = $cliente->tipo_client;
            $parks->id_agencia = $id_agency;
            $parks->adult = $adult;
            $parks->child = $child;
            $parks->total_person = $child + $adult;
            $parks->child = $child;
            $parks->adult = $adult;
            $parks->admission_child = $child * $rate_childs;
            $parks->admission_adtul = $rate_adults * $adult;
            $parks->totalAdmission = $parks->admission_adtul + $parks->admission_child;
            $parks->totalTraspor = $trpark;
            if (isset($include_park)) {
                $parks->admission = 1;
                $parks->total_paid = $parks->totalAdmission + $parks->totalTraspor;
            } else {
                $parks->total_paid = $parks->totalTraspor;
            }

            $parks->id = $parks->insert();
            Doo::loadModel('Parques');
            $apark = new Parques();
            $apark->id = $id_selected_park;
            $apark = Doo::db()->getOne($apark);
            if ($parks->admission == 1) {
                $apark->stock = intval($apark->stock) - ($tour->child + $tour->adult);
                $apark->update();
            }
            if ($cambio_park == True) {

                $rastrostring.= "Attraction/Park = " . $apark->nombre . "&";
            }
            if ($cambio_tickets) {
                $rastrostring.="Include Tickets to attraction &";
            }
            $sql = "update attraction_trafic as p set p.id_tours=? where p.id=?;";
            $rs = Doo::db()->query($sql, array($tour->id, $parks->id));
            $tour->update();
            $rastrostring.= "Total Tour = " . $total_total . "&";
            $rastro->fecha = date('Y-m-d h:i:s');
            $rastro->tipo_cambio = "UPDATE";
            $rastro->id_tours = $tour->id;
            $rastro->tipo_usuario = "OPERATOR";
            $rastro->usuario = $_SESSION['login']->id;
            $rastro->detalles = $rastrostring;
            $rastroid = $rastro->insert();

            if ($actual_diff > 0) {
                if ($opcion_pago == 2) {
                    $_SESSION['codconf'] = $tour->code_conf;
                    if (isset($cardholder)) {
                        if ($zip != "" && $country != "" && $state != "" && $address != "" && $city != "") {
                            $cliente->zip = $zip;
                            $cliente->country = $country;
                            $cliente->state = $state;
                            $cliente->address = $address;
                            $cliente->city = $city;
                            $cliente->update();
                        }
                        $this->data['usuario'] = $cliente;
                    } else {
                        $cli = new Clientes();
                        $cli->firstname = $firstname;
                        $cli->lastname = $lastname;
                        $cli->username = $username;
                        $cli->phone = $phone;
                        $cli->country = $country;
                        $cli->state = $state;
                        $cli->city = $city;
                        $cli->address = $address;
                        $cli->zip = $zip;
                        $this->data['usuario'] = $cli;
                    }
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->data['apagar'] = abs($actual_diff);

                    $_SESSION['tours_pago'] = '...';
                    $this->view()->renderc('admin/configuracion/pago_onedaytour', $this->data);
                    return Doo::conf()->APP_URL . "admin/onedaytour";
                }

                if ($opcion_pago == 1) {
                    $_SESSION['codconf'] = $tour->code_conf;
                    Doo::loadModel('Agency');
                    $a = new Agency();
                    $a->id = $tour->id_agency;
                    $a = Doo::db()->getOne($a);
                    $manager = new Clientes();
                    $manager->username = $a->main_email;
                    $manager->firstname = $a->company_name;
                    $manager->lastname = $a->manager;
                    $manager->address = $a->address;
                    $manager->state = $a->state;
                    $manager->zip = $a->zipcode;
                    $manager->phone = $a->phone1;
                    $this->data['usuario'] = $manager;
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->data['apagar'] = abs($actual_diff);
                    echo $_SESSION['codconf'] . ' -> ' . $_SESSION['tours_pago'];
                    $this->view()->renderc('admin/configuracion/pago_onedaytour', $this->data);
                    return Doo::conf()->APP_URL . "admin/onedaytour";
                }
            } else if ($actual_diff < 0) {
                $this->registrarNotaCredito($tour->id, abs($actual_diff));
                echo 'nota al credito';
            } else {
                $_SESSION['codconf'] = $tour->code_conf;
                if ($opcion_pago == 2) {
                    if (isset($cardholder)) {
                        if ($zip != "" && $country != "" && $state != "" && $address != "" && $city != "") {
                            $cliente->zip = $zip;
                            $cliente->country = $country;
                            $cliente->state = $state;
                            $cliente->address = $address;
                            $cliente->city = $city;
                            $cliente->update();
                        }
                        $this->data['usuario'] = $cliente;
                    } else {
                        $cli = new Clientes();
                        $cli->firstname = $firstname;
                        $cli->lastname = $lastname;
                        $cli->username = $username;
                        $cli->phone = $phone;
                        $cli->country = $country;
                        $cli->state = $state;
                        $cli->city = $city;
                        $cli->address = $address;
                        $cli->zip = $zip;
                        $this->data['usuario'] = $cli;
                    }
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->data['apagar'] = $tour->totalouta;
                    if ($id_agency != -1 && $type_rate == 0) {
                        if ($opcion_saldo == 1) {
                            $this->data['apagar'] = $tour->totalouta;
                        } else if ($opcion_saldo == 2) {
                            $this->data['apagar'] = $tour->totalouta - $rastrocom;
                        }
                    }
                    $_SESSION['tours_pago'] = '...';
                    $this->view()->renderc('admin/configuracion/pago_onedaytour', $this->data);
                    return Doo::conf()->APP_URL . "admin/onedaytour";
                }

                if ($opcion_pago == 1) {
                    Doo::loadModel('Agency');
                    $a = new Agency();
                    $a->id = $tour->id_agency;
                    $a = Doo::db()->getOne($a);
                    $manager = new Clientes();
                    $manager->username = $a->main_email;
                    $manager->firstname = $a->company_name;
                    $manager->lastname = $a->manager;
                    $manager->address = $a->address;
                    $manager->state = $a->state;
                    $manager->zip = $a->zipcode;
                    $manager->phone = $a->phone1;
                    $this->data['usuario'] = $manager;
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    if ($opcion_saldo == 1) {
                        $this->data['apagar'] = $tour->totalouta;
                    } else if ($opcion_saldo == 2) {
                        $this->data['apagar'] = $tour->totalouta - $rastrocom;
                    }
                    $this->view()->renderc('admin/configuracion/pago_onedaytour', $this->data);
                    return Doo::conf()->APP_URL . "admin/onedaytour";
                }
            }
        } catch (Exception $e) {
            echo $e;
        }


        if ($reserve->tipo_pago == 'COLLECT ON BOARD' || $reserve->tipo_pago == 'CREDIT VOUCHER' || $reserve->tipo_pago == "COMPLEMENTARY") {
            //ruta provisional
            return Doo::conf()->APP_URL . 'admin/onedaytour/';
        }

        return Doo::conf()->APP_URL . 'admin/onedaytour/';
    }

    public function approval_payment() {

        if (isset($_GET['ssl_approval_code']) && isset($_SESSION['codconf'])) {
            //pago realizado.
//                        echo $_SESSION['codconf'].' -> '.$_SESSION['tours_pago'];
            Doo::loadModel('Tour_oneday');
            $tour = new Tour_oneday();
            $tour->code_conf = $_SESSION['codconf'];
            $tour = Doo::db()->getOne($tour);
            $idtour = $tour->id;


            Doo::loadModel('Factura');
            Doo::loadModel('FacturaServicio');
            $factura = new Factura();
            $factura->creation_date = date('Y-m-d');
            $factura->total = $tour->totalouta;
            $factura->subtotal = $tour->totalouta;
            $factura->id_agency = $tour->id_agency;
            $factura->id = $factura->insert();
            $fs = new FacturaServicio();
            $fs->id_factura = $factura->id;
            $fs->id_servicio = $idtour;
            $fs->tipo_servicio = "ONE";
            $fs->insert();

            Doo::loadModel('Pago');
            $pago = new Pago();
            $pago->fecha = date('Y-m-d H:m:s');
            $pago->monto = $tour->totalouta;
            $pago->descuento = 0;
            $pago->per_descuento = 0;
            $pago->factura = $factura->id;
            $pago->tipo = 'FULL';
            $pago->transnu = '0';

            Doo::loadModel('Reserve');
            $reserve = new Reserve();
            $reserve->id = $tour->id_reserva;
            $reserve = Doo::db()->getOne($reserve);

            list($tipo_pago, $b) = explode('-', $reserve->pago);

            if ($tipo_pago == 1 || $tipo_pago == 2) {
                $pago->metodo = 4;
            } else if ($tour->tipo_pago == 6) {
                $pago->metodo = 5;
            }
            $pago->insert();

            $factura->collect = $tour->totalouta;
            $factura->total = $factura->subtotal - $factura->collect;
            $factura->estado = 'PAID';
            $factura->update();

            Doo::loadModel('CollectService');
            $collected = new CollectService();
            $collected->id_servicio = $tour->id;
            $collected->tipo_servicio = "ONE";
            $collected = Doo::db()->getOne($collected);
            $collected->monto_pagado = $tour->totalouta;
            $collected->update();

            $sql = "update tours_oneday set estado = 'INVOICED' where id = ?";
            $query = Doo::db()->query($sql, array($tour->id));


            Doo::loadModel('Tours_Pago');
            $tpago = new Tours_Pago();
            $tpago->tipo = "ONE";
            Doo::loadModel('Reserve');
            $rs = new Reserve();
            $rs->id = $tour->id_reserva;
            $rs = Doo::db()->getOne($rs);
            $tpago->pago = $rs->pago;
            $tpago->tipo_pago = $rs->tipo_pago;
            $tpago->pagado = $_GET['ssl_amount'];
            $usuario = $_SESSION['login'];
            $tpago->usuario = $usuario->id;
            $tpago->fecha = date('Y-m-d H:i:s A');
            $tpago->id_tours = $tour->id;
            $tpago->insert();
            Doo::loadModel('Clientes');
            $cliente = new Clientes();
            $cliente->id = $tour->id_client;
            $cliente = Doo::db()->getOne($cliente);
            $this->data['login'] = $cliente;
            $this->data['codeconf'] = $tour->code_conf;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $tour->code_conf.='_' . $_GET['ssl_approval_code'];
            $this->enviar_correo($tour->id);
            $sql = "UPDATE tours_oneday set code_conf = ? where id = ?";
            $rs = Doo::db()->query($sql, array($tour->code_conf, $tour->id));
            /* echo '<script>alert("'.$tour->id.')</script>'; */
            $_SESSION['tours_pago'] = 'ok';

            unset($_SESSION['codeconf']);
            return $this->view()->renderc('admin/configuracion/approval_one', $this->data);
//                        //que pasa luego del pago
//                        //1. enviar el correo.
        } else {
            if (isset($_SESSION['codconf']) || isset($_SESSION['tours_pago'])) {
                unset($_SESSION['codconf']);
                unset($_SESSION['tours_pago']);
            };
        }
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
                                        $(function(){
		   			$('#btn-save1').show();
		   			$('#btn-save2').hide();
                                        });
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

    public function registrarNotaCredito($id_tours, $valor) {
        if ($valor > 0) {
            Doo::loadModel("Tours_Nota_Credi");
            $login = $_SESSION['login'];
            $notaC = new Tours_Nota_Credi();
            $notaC->id_tours = $id_tours;
            $notaC->tipo = "ONE";
            $notaC = Doo::db()->find($notaC, array("limit", 1));
            if (empty($notaC)) {
                $notaC = new Tours_Nota_Credi();
                $notaC->id_tours = $id_tours;
                $notaC->tipo = "ONE";
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

    public function enviar_correo($idtour) {
//   public function enviar_correo(){
        Doo::loadModel('Tour_oneday');
        Doo::loadController('DatosMailController');
        $tour = new Tour_oneday(); //hay que borrar
        $tour->id = $idtour;
        $tour = Doo::db()->getOne($tour);
        $datosMail = new DatosMailController();
        $mail = new PHPMailer(true);
        $mail = $datosMail->datos();
        Doo::loadModel('Clientes');
        $c = new Clientes();
        $c->id = $tour->id_client;
        $c = Doo::db()->getOne($c);
        $data['cliente'] = $c;
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $data['tour'] = $tour;
        Doo::loadModel('Reserve');
        $reserve = new Reserve();
        $reserve->id = $tour->id_reserva;
        $reserve = Doo::db()->getOne($reserve);
        $data['res'] = $reserve;
        Doo::loadModel('Areas');
        $from = new Areas();
        Doo::loadModel("Trips");
        $trip = new Trips();
        $trip->trip_no = $reserve->trip_no;
        $trip = Doo::db()->getOne($trip);
        $data['trip'] = $trip;
        Doo::loadModel("PickupDropoff");
        $pickup1 = new PickupDropoff();
        $pickup1->id = $reserve->pickup1;
        $pickup1 = Doo::db()->getOne($pickup1);
        $data['pickup1'] = $pickup1;
        $dropoff1 = new PickupDropoff();
        $dropoff1->id = $reserve->dropoff1;
        $dropoff1 = Doo::db()->getOne($dropoff1);
        $data['dropoff1'] = $dropoff1;
        Doo::loadModel("Areas");
        $area1 = new Areas();
        $area1->id = $pickup1->id_area;
        $area1 = Doo::db()->getOne($area1);
        $data['area1'] = $area1;
        $trip2 = new Trips();
        $trip2->trip_no = $reserve->trip_no2;
        $trip2 = Doo::db()->getOne($trip2);
        $data['trip2'] = $trip2;
        $pickup2 = new PickupDropoff();
        $pickup2->id = $reserve->pickup2;
        $pickup2 = Doo::db()->getOne($pickup2);
        $data['pickup2'] = $pickup2;
        $dropoff2 = new PickupDropoff();
        $dropoff2->id = $reserve->dropoff2;
        $dropoff2 = Doo::db()->getOne($dropoff2);
        $data['dropoff2'] = $dropoff2;
        $area2 = new Areas();
        $area2->id = $dropoff2->id_area;
        $area2 = Doo::db()->getOne($area2);
        $data['area2'] = $area2;
        Doo::loadModel('Attraction_Trafic');
        $park_trans = new Attraction_Trafic();
        $park_trans->id_tours = $tour->id;
        $park_trans->type_tour = "ONE";
        $park_trans = Doo::db()->getOne($park_trans);
        Doo::loadModel('Parques');
        $park = new Parques();
        $park->id = $park_trans->id_park;
        $park = Doo::db()->getOne($park);
        $data['parks'] = $park;

        $style = "<title>Documento sin t�tulo</title>
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
                </style>
                </head>";

        $info = "
    <div align='center'>
<br />
    <table> 
     <tbody><tr>
       <td width='316' height='33' rowspan='2'><img width='316' height='88' src='" . $data["rootUrl"] . "Logo-Supertours-mail.jpg'></td>
       <td colspan='3' align='center'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3'>Date: " . $data['tour']->starting_date . " <!--/ Hour: --></td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4'> <h3>ONE DAY TOUR CONFIRMATION</h3></td>
     </tr>
     <tr>
       <td height='15'><div><div class='im'>LEAD TRAVELER:
       <br><br>
       <strong>User Name: </strong><a href='mailto:'" . $data["cliente"]->username . "' target='_blank'>" . $data["cliente"]->username . "</a>
       <br><br>
       <strong>Firstname: </strong>" . $data["cliente"]->firstname . "
       <br><br>
       </div><strong>Lastname: </strong>" . $data["cliente"]->lastname . "
       <br><br>
       <strong>Phone: </strong><a href='tel:" . $data["cliente"]->phone . "' value='+1" . $data["cliente"]->phone . "' target='_blank'>" . $data["cliente"]->phone . "</a>
        <br><br>
       </div><strong>Cellphone: </strong>" . $data["cliente"]->celphone . "    
           
       </td>
       <td width='145' height='15'>&nbsp;</td>
       <td colspan='2'><strong>AD: </strong>" . $data["tour"]->adult . "<strong>CHD:" . $data["tour"]->child . "</strong>  <strong> TOTAL:</strong>" . ($data["tour"]->adult + $data["tour"]->child) . "<br><br><strong>Status :</strong>" . $data["tour"]->estado . "<br><br><strong> Code Quotation :</strong>" . $data["tour"]->code_conf . "</td>
     </tr>
      <tr>
    <td height='45' colspan='4'> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr>";
        $body = "<div id='Bus'>
            <table width='96%' height='90' id='tableorder'>
            <tbody><tr><td height='35' colspan='3' id='titlett'><strong><div align='left'> Your Tour include</div></strong></td>
            </tr>
            <tr>";
        $body = '<td colspan="3">
     <table width="96%" height="90">
      <tbody><tr>
        <td height="35" colspan="3"><strong><div align="left"> ITINERARY ARRIVAL</div></strong></td>
        </tr>
        <tr>
          <td height="47" colspan="3"><br><p> Date Arrival <strong>';
        $time = strtotime($data["tour"]->starting_date);
        $newformat = date("M d \of Y", $time);

        $body.=$newformat . '</strong>';

        $newformat = date("h:i A", $time);

        $body.=$newformat;

        $body.='</strong> - Trip <strong>' . $data["res"]->trip_no . '</strong>, Luxury <strong>Bus</strong> - transportation from <strong>';
        $body.=$data['area1']->nombre . ' ' . $data["pickup1"]->place . '
          </strong>, to <strong> Orlando </strong>, <strong> ' . $data["dropoff1"]->place . ' of Orlando</strong>, arriving at <strong>';
        $time = strtotime($data["res"]->arrtime1);
        $newformat = date("h:i A", $time);
        $body.=$newformat . '
          </strong> , you will be greeted by your tour guide/driver in Orlando. 
          </p><hr>
          <br>';
        $body.='<strong> <div align="left"> LOCAL TRANSFERS TO PARKS</div></strong>';
        $body.='Parks tagged with <strong>Transportations</strong> means you will have tranportation included from the hotel to the park.
                        Parks tagged with <strong> Tickets </strong> means you already payed for the entrances tickets to the park.
                        <br>
                        <ul style="list-style-type: square">';

        $body.='<li>';
        $body.= $data["parks"]->nombre . " ";
        if ($tour->include_park == 1) {
            $body.= "<strong>Ticket(s)</strong>";
        }
        if ($tour->include_park == 1 && $park_trans->admission == 1) {
            $body.= " and ";
        }
        if ($park_trans->trafic == 1) {
            $body.= " <strong>Tranportations</strong>";
        }
        $body.= "</li>";

        $body.='</ul>
                <div class="im">
                </div>
                <p></p>
                <p><strong> </strong></p><div align="left">';

        $body.='<strong> ITINERARY DEPARTURE</strong></div><br></div>
                Date departure <strong>' . $data["tour"]->ending_date . ' ';

        $body.='- Pick up time <strong>';
        $time = strtotime($data["res"]->deptime2);
        $newformat = date("h:i A", $time);
        $body.=$newformat;
        $body.='</strong> -  Trip <strong>' . $data["res"]->trip_no2 . '</strong>, Luxury <strong>BUS</strong> - transportation from <strong> Orlando, ' . $data["pickup2"]->place . '</strong> to <strong>' . ' ' . $data['area2']->nombre . ' ' . $data["dropoff2"]->place . '</strong> arriving at <strong>';

        $time = strtotime($data["res"]->arrtime2);
        $newformat = date("h:i A", $time);
        $body.=$newformat;

        $body.='</strong><br> Thank you for choosing us !. <br>
           <br>
              <br>
            <p></p></td>
        </tr></tbody></table>
        <hr>
        <tr>
            <td height="33" colspan="4"><strong>PRICE</strong></td>
        </tr>
        ';
        $body.='<tr>
               <td colspan="4"><table width="90%" border="0">
                <tbody><tr>
                <td height="32" align="center"><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span>$' . ceil($data["tour"]->totalouta) . '</span> </td>
                </tr>
                <tr>
                <td height="40" align="center"><span>CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
                </tr>
                <tr>
                <td align="center">Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call <a href="tel:%28407%29%20370-3001" value="+14073703001" target="_blank">(407) 370-3001</a> and speak with our  Call Center.<br>
                </td>   
                </tr>';
        $body.='</tbody></table><div class="im">
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
                 </p></td>
                 </tr>
                 </tbody></table>';
        $mail->AddAddress($c->username, $c->lastname . ' ' . $c->firstname);
        if ($tour->id_agency != -1) {
            Doo::loadModel('Agency');
            $agency = new Agency();
            $agency->id = $tour->id_agency;
            $agency = Doo::db()->getOne($agency);
            $mail->AddAddress($agency->main_email, $agency->company_name);
        }
        $mail->Subject = 'Reservations Super Tours OF Orlando'; // Mensaje alternativo en caso que el destinatario no pueda abrir        // correos HTML
        $mail->AltBody = 'Reservations Super Tours OF Orlando'; // El cuerpo del mensaje, puede ser con etiquetas HTML
        $mail->MsgHTML($style . $info . $body);
        try {
            $mail->Send();
        } Catch (phpmailerException $phpmailer) {
            //ERRORES DE PHP MAILER
        } catch (Exception $ex) {
            //otros errores
        }
    }

    public function response_decline() {
        $_SESSION['tours_pago'] = 'no';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('admin/configuracion/decline', $data);
    }

    public function detalles_rastro() {
        Doo::loadModel("Toursoneday_Rastro");
        $id = $this->params["id"];
        $rastro = new Toursoneday_Rastro();
        $rastro->id = $id;
        $rastro = Doo::db()->find($rastro, array('limit' => 1));

        Doo::loadModel('Usuarios');
        $u = new Usuarios();
        $u->id = $rastro->usuario;
        $u = Doo::db()->getOne($u);


        echo '<div><p>THE <strong>' . $rastro->tipo_cambio . '</strong> performed by <strong>' . $u->nombre . '</strong>.</p>
		<strong>The result of the operation was as follows:<strong><br />';
        $array = explode("&", $rastro->detalles);

        foreach ($array as $key) {
            echo '<br />' . $key;
        }

        echo '</div>';
    }

}
