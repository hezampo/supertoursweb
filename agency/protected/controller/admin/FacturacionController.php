<?php
set_time_limit(320);
ini_set('memory_limit', '356M');
/*
 * */
Doo::loadHelper('DooFile');
Doo::loadController('I18nController');

class FacturacionController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function invoicing() {
        $this->data['content'] = 'facturacion/invoicing.php';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $this->data, true);
    }

    public function get_reserves() {
        $f_ini = $this->params['fecha_inicial'];
        $f_fin = $this->params['fecha_final'];
        $filter_option = $this->params['filtro'];
        $text_filter = rawurldecode($this->params['texto']) ;
        $fecha_cadena = rawurldecode($this->params['cadena']) ;
        list($m1, $d1, $y1) = explode('-', $f_ini);
        list($m2, $d2, $y2) = explode('-', $f_fin);
        $f_ini = $y1 . '-' . $m1 . '-' . $d1;
        $f_fin = $y2 . '-' . $m2 . '-' . $d2;
        
        if ($filter_option == 0) {
            $filtro = 'true';
        } else if ($filter_option == 1) {
            $filtro = 'U.estado = "INVOICED"';
        } else if ($filter_option == 2) {
            $filtro = 'U.type_service = "MULTI"';
        } else if ($filter_option == 3) {
            $filtro = 'U.type_service = "ONE"';
        } else if ($filter_option == 4) {
            $filtro = 'U.type_service = "RESERVE"';
        } else if ($filter_option == 5) {
            $filtro = "U.agencia LIKE '%" . $text_filter . "%'";
        }

        $sql = "select * from ((
                (select 'MULTI' as 'type_service', t.comments as comments, t.id,IF(t.otheramount>0,t.otheramount,t.total) as 'total_amount',t.estado, t.code_conf as codigo, IFNULL(a.company_name,IF(t.canal = 'WEBSALE','Supertours WEBSALE','Supertours')) as 'agencia',t.starting_date,c.firstname,c.lastname from tours as t left join clientes as c on c.id = t.id_client left join agencia as a on a.id = t.id_agency  where (t.estado = 'CONFIRMED'  or t.estado = 'NOT SHOW W/ CHARGE') and (t.starting_date between '$f_ini' and '$f_fin') )
                union
                (select 'ONE' as 'type_service', t.comments as comments, t.id,IF(t.otheramount>0,t.otheramount,t.total) as 'total_amount',t.estado,t.code_conf as codigo, IFNULL(a.company_name,IF(t.canal = 'WEBSALE','Supertours WEBSALE','Supertours')) as 'agencia',t.starting_date,c.firstname,c.lastname from tours_oneday as t left join clientes as c on c.id = t.id_client left join agencia as a on a.id = t.id_agency where (t.estado = 'CONFIRMED'  or t.estado = 'NOT SHOW W/ CHARGE') and (t.starting_date between '$f_ini' and '$f_fin') )
                union
                (select 'RESERVE' as 'type_service', r.comments as comments, r.id, r.totaltotal as 'total_amount', r.estado, r.codconf as codigo, IFNULL(a.company_name,IF(r.canal = 'WEBSALE','Supertours WEBSALE','Supertours')) as 'agencia', r.fecha_salida_ns, r.firsname, r.lasname from reservas as r left join clientes as c on c.id = r.id_clientes left join agencia as a on a.id = r.agency where (r.estado = 'CONFIRMED'  OR r.estado = 'NOT SHOW W/ CHARGE') and (r.fecha_salida_ns between '$f_ini' and '$f_fin') and id_tours = -1) ORDER BY agencia desc)) as U where $filtro";
        $query = Doo::db()->query($sql);
        $result = $query->fetchAll();
        if ($query->rowCount() == 0) {
            echo '<script>alert("No Services to process")</script>';
            exit;
        }
//        print_r(Doo::db()->showSQL());
//        exit;
        foreach ($result as $row) {

            $disable = "";
            if ($row['estado'] == "INVOICED") {
                $disable = "disabled=''";
            }
            $servicio = '';
            if ($row['type_service'] == 'ONE') {
                $servicio = 'onedaytour';
                //$fecha_salida = $row['starting_date'];
                
            } else if ($row['type_service'] == "MULTI") {
                $servicio = 'tours';
                //$fecha_salida = $row['starting_date'];
                
            } else if ($row['type_service'] == "RESERVE") {
                $servicio = 'reservas';
                //$fecha_salida = $row['fecha_salida_ns'];
            }

            $edit_link = "<a href = '" . Doo::conf()->APP_URL . "admin/" . $servicio . "/edit/" . $row['id'] . "'>
                            <img src='" . Doo::conf()->APP_URL . "global/img/admin/edit.png' style='width:16px; height:16px; padding-left:10px;'>
                          </a>";

            echo '<tr>
                  <td><input type="checkbox" id="' . $row['type_service'] . '-' . $row['id'] . '" name="checkboxsel[]" value="' . $row['type_service'] . '-' . $row['id'] . '" ' . $disable . '></td>
                  <td>' . (($row['type_service'] == "RESERVE") ? 'TRANSPORTATION' : $row['type_service']) . '</td>
                  <td>' . $row['codigo'] . '</td>
                  <td>' . $row['lastname'] . ', ' . $row['firstname'] . ' </td>
                  <td>' . $row['agencia'] . '</td>
                  <td style="width: 80px;  text-align: center;">' . $row['starting_date'] . '</td>
                  <td>$ ' . $row['total_amount'] . '</td>
                  <td>' . $row['estado'] . '</td>
                  <td>' . (($row['estado'] != 'INVOICED') ? $edit_link : '') . '</td>
                  <td><a href="#" class="comment">Comments...</a>
                  <textarea style="display:none">' . $row['comments'] . '</textarea>
                  </td>
                  </tr>';
        }
    }

    public function process_invoice() {

        extract($_POST, EXTR_SKIP);
        $agencias = array();

        foreach ($checkboxsel as $row) {
            list($servicio, $id) = explode('-', $row);
            if ($servicio == "ONE") {
                $sql = "select id, id_agency from tours_oneday where id = ?";
                $query = Doo::db()->query($sql, array($id));
                $rs = $query->fetchAll();
                if (isset($agencias[$rs[0]['id_agency']])) {
                    $peer = array();
                    $peer['servicio'] = "ONE";
                    $peer['id'] = $rs[0]['id'];
                    array_push($agencias[$rs[0]['id_agency']], $peer);
                } else {
                    $peer = array();
                    $peer['servicio'] = "ONE";
                    $peer['id'] = $rs[0]['id'];
                    $agencias[$rs[0]['id_agency']] = array();
                    array_push($agencias[$rs[0]['id_agency']], $peer);
                }
            } else if ($servicio == "MULTI") {
                $sql = "select id, id_agency from tours where id = ?";
                $query = Doo::db()->query($sql, array($id));
                $rs = $query->fetchAll();
                if (isset($agencias[$rs[0]['id_agency']])) {
                    $peer = array();
                    $peer['servicio'] = "MULTI";
                    $peer['id'] = $rs[0]['id'];
                    array_push($agencias[$rs[0]['id_agency']], $peer);
                } else {
                    $peer = array();
                    $peer['servicio'] = "MULTI";
                    $peer['id'] = $rs[0]['id'];
                    $agencias[$rs[0]['id_agency']] = array();
                    array_push($agencias[$rs[0]['id_agency']], $peer);
                }
            } else if ($servicio == "RESERVE") {
                $sql = "select id, agency from reservas where id = ?";
                $query = Doo::db()->query($sql, array($id));
                $rs = $query->fetchAll();
                if (isset($agencias[$rs[0]['agency']])) {
                    $peer = array();
                    $peer['servicio'] = "RESERVE";
                    $peer['id'] = $rs[0]['id'];
                    array_push($agencias[$rs[0]['agency']], $peer);
                } else {
                    $peer = array();
                    $peer['servicio'] = "RESERVE";
                    $peer['id'] = $rs[0]['id'];
                    $agencias[$rs[0]['agency']] = array();
                    array_push($agencias[$rs[0]['agency']], $peer);
                }
            }
        }



        Doo::loadModel('Factura');
        Doo::loadModel('FacturaServicio');
        $generadas = array();
        try {
            Doo::db()->beginTransaction();


            foreach ($agencias as $id => $servicios) {
                
            //Capturamos la fecha enviada desde la vista Invoicing para facturar con la asignacion de esta misma
                $inv_fecha  = $_POST['invoice_date'];
                
            //damos formato a la variable para ser enviada al campo creation_date de la tabla factura   
                $nueva_fecha1 = date('Y-d-m', strtotime($inv_fecha));              
                list($dia1, $mes1, $anyo1) = explode("-", $nueva_fecha1);
                $nueva_fecha = trim($dia1 . "-" . $mes1 . "-" . $anyo1);
            
//                echo $nueva_fecha;
//                exit();
                //$nueva_fecha = date('Y-M-D', strtotime($lcNombre));
                //echo $lcNombre;
                if ($id != -1) {
                    //generamos facturas por agencias // ORDER BY consecutivo DESC LIMIT 0,1
                    $factura = new Factura();
                    $factura->id_agency = $id;
                    $factura->collect = 0;
                    $factura->subtotal = 0;
                    $factura->total = 0;
                    $factura->creation_date = $nueva_fecha;
                    $factura->id = Doo::db()->insert($factura);
                    $subtotal = 0;
                    $collect = 0;
                    foreach ($servicios as $servicio) {
                        $sfactura = new FacturaServicio();
                        $sfactura->id_factura = $factura->id;
                        $sfactura->id_servicio = $servicio['id'];
                        $sfactura->tipo_servicio = $servicio['servicio'];
                        $sfactura->id = Doo::db()->insert($sfactura);
                        //colocamos el servicio como facturado y obtenemos el subtotal
                        //para ese servicio y lo colectado hasta la fecha
                        if ($sfactura->tipo_servicio == "ONE") {
                            $tabla = "tours_oneday";
                            $sql = "select total,totalouta,otheramount,tipo_pago from tours_oneday where id = ? ";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            $totalouta = $rs['totalouta'];
                            $subtotal += $totalouta;
                            $otheramount = $rs['otheramount'];
                            $tipo_pago = $rs['tipo_pago'];
                            $total_n = $rs['total'];
//                            echo $totalouta."<br>";
//                            print_r($rs);
//                            exit;
                            $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio,"ONE"));
                            $rs = $query->fetch();
                            
                            if ($rs['pagado'] > 0) {
                                $collect += floatval($rs['pagado']);
                            } else if ($otheramount != 0) {
//                                Doo::loadModel('CollectService');
//                                $cs = new CollectService();
//                                $cs->id_servicio = $servicio['id'];
//                                $cs->tipo_servicio = $servicio['servicio'];
//                                $cs->monto_pagado = $otheramount;
//                                $cs->insert();
//                                $collect += $otheramount;                                
                            }
                            if($tipo_pago == "VOUCHER"){
                                $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($id), "limit" => 1));
                                if (!empty($creditos)) {
                                    $creditos->disponible = ($creditos->disponible - $total_n);
                                    if (!Doo::db()->update($creditos)) {
                                       return false;
                                   }
                                }
                            }
                            
                        } else if ($sfactura->tipo_servicio == "MULTI") {
                            $tabla = "tours";
                            $sql = "select total,totalouta,otheramount,tipo_pago from tours where id = ? ";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
//                            echo $rs['totalouta']."<br> t";
                            $totalouta = $rs['totalouta'];
                            $subtotal += $totalouta;
                            $otheramount = $rs['otheramount'];
                            $tipo_pago = $rs['tipo_pago'];
                            $total_n = $rs['total'];
//                             echo $totalouta."<br>";
                            $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio,"MULTI"));
                            $rs = $query->fetch();
                            if ($rs['pagado'] > 0) {
                                $collect += $rs['pagado'];
                            } else if ($otheramount != 0) {
//                                Doo::loadModel('CollectService');
//                                $cs = new CollectService();
//                                $cs->id_servicio = $servicio['id'];
//                                $cs->tipo_servicio = $servicio['servicio'];
//                                $cs->monto_pagado = $otheramount;
//                                $cs->insert();
//                                $collect = $otheramount;
                            }
                            if($tipo_pago == "VOUCHER"){
                                $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($id), "limit" => 1));
                                if (!empty($creditos)) {
                                    $creditos->disponible = ($creditos->disponible - $total_n);
                                    if (!Doo::db()->update($creditos)) {
                                       return false;
                                   }
                                }
                            }
//                            echo $subtotal." C ".$collect."<br>".$sfactura->id_servicio;
//                            exit;
                        } else if ($sfactura->tipo_servicio == "RESERVE") {
                            $tabla = "reservas";
                            $sql = "select total2 as total,totaltotal,otheramount,tipo_pago from reservas where id = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            $totalouta = $rs['totaltotal'];
                            $subtotal += $totalouta;
                            $otheramount = $rs['otheramount'];
                            $tipo_pago = $rs['tipo_pago'];
                            $total_n = $rs['total'];
//                            echo $totalouta."<br>";
//                            $sql = "select monto_pagado as pagado from collectservice where id_servicio = ? and tipo_servicio = 'RESERVE'";
                            $sql = 'SELECT sum(pagado) as pagado FROM reservas_pago WHERE id_reserva = ? ';
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            if ($rs['pagado'] > 0) {
                                $collect += floatval($rs['pagado']);
                            } else if ($otheramount != 0) {
//                                Doo::loadModel('CollectService');
//                                $cs = new CollectService();
//                                $cs->id_servicio = $servicio['id'];
//                                $cs->tipo_servicio = $servicio['servicio'];
//                                $cs->monto_pagado = $otheramount;
//                                $cs->insert();
//                                $collect += $otheramount;
                            }
                            if($tipo_pago == "VOUCHER"){
                                $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($id), "limit" => 1));
                                if (!empty($creditos)) {
                                    $creditos->disponible = ($creditos->disponible - $total_n);
                                    if (!Doo::db()->update($creditos)) {
                                       return false;
                                   }
                                }
                            }
//                             echo $subtotal." C ".$collect."<br>".$sfactura->id_servicio;
//                            exit;
                        }
                        $id = $sfactura->id_servicio;
                        $sql = "update $tabla set estado='INVOICED' where id = $id";
                        Doo::db()->query($sql);

                        $factura->subtotal = $subtotal;
                        $factura->collect = $collect;
                        $factura->total = $factura->subtotal - $factura->collect;
                        if ($factura->total == 0) {
                            $factura->estado = "PAID";
                        }else if($factura->total < 0){
                            $factura->estado = "COMISION";
                        }
                        
                        //print_r($factura);
                       
                        Doo::db()->update($factura);
                    }
                    
//                   echo $subtotal." C ".$collect."<br>".$sfactura->id_servicio;
//                   exit;
//                   exit;
                } else {
                    //generamos facturas por servicios
                    
                    //Capturamos la fecha enviada desde la vista Invoicing para facturar con la asignacion de esta misma
                    
                        $inv_fecha = $_POST['invoice_date'];
                        
                        
                    //damos formato a la variable para ser enviada al campo creation_date de la tabla factura                     
                        
                        $nueva_fecha1 = date('Y-d-m', strtotime($inv_fecha));              
                        list($dia1, $mes1, $anyo1) = explode("-", $nueva_fecha1);
                        $nueva_fecha = trim($dia1 . "-" . $mes1 . "-" . $anyo1);

//                        echo $nueva_fecha;
//                        exit();                       
                        
                        
                        $factura = new Factura();
                        $factura->id_agency = -1;
                        $factura->collect = 0;
                        $factura->subtotal = 0;
                        $factura->total = 0;
                        $factura->creation_date = $nueva_fecha;
                        $factura->id = Doo::db()->insert($factura);
                        $subtotal = 0;
                        $collect = 0;
                    foreach ($servicios as $servicio) {                        
                       
                        $sfactura = new FacturaServicio();
                        $sfactura->id_factura = $factura->id;
                        $sfactura->id_servicio = $servicio['id'];
                        $sfactura->tipo_servicio = $servicio['servicio'];
                        $sfactura->id = Doo::db()->insert($sfactura);
                        //colocamos el servicio como facturado y obtenemos el subtotal
                        //para ese servicio y lo colectado hasta la fecha
                        if ($sfactura->tipo_servicio == "ONE") {
                            $tabla = "tours_oneday";
                            $sql = "select total,totalouta,canal from tours_oneday where id = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            $canal = $rs['canal'];
                            $totalouta = $rs['totalouta'];
                            $subtotal += $totalouta;

                            $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio,"ONE"));
                            $rs = $query->fetch();

                            if ($rs['pagado'] > 0) {
                                $collect += $rs['pagado'];
                            }
                           
                        } else if ($sfactura->tipo_servicio == "MULTI") {
                            $tabla = "tours";
                            $sql = "select total,totalouta,canal from tours where id = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            $canal = $rs['canal'];
                            $totalouta = $rs['totalouta'];
                            $subtotal += $totalouta;

                            $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio,"MULTI"));
                            $rs = $query->fetch();
                            if ($rs['pagado'] > 0) {
                                $collect += $rs['pagado'];
                            }
                             
                        } else if ($sfactura->tipo_servicio == "RESERVE") {
                            $tabla = "reservas";
                            $sql = "select total2 as total,totaltotal,canal from reservas where id = ?";
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            $canal = $rs['canal'];
                            $totalouta = $rs['totaltotal'];
                            $subtotal += $totalouta;

                            $sql = 'SELECT sum(pagado) as pagado FROM reservas_pago WHERE id_reserva = ? ';
                            $query = Doo::db()->query($sql, array($sfactura->id_servicio));
                            $rs = $query->fetch();
                            if ($rs['pagado'] > 0) {
                                $collect += $rs['pagado'];
                            }
                        }
                        $id = $sfactura->id_servicio;
                        $sql = "update $tabla set estado='INVOICED' where id = $id";
                        Doo::db()->query($sql);

                        $factura->subtotal = $subtotal;
                        $factura->collect = $collect;
                        $factura->total = $factura->subtotal - $factura->collect;
                        $factura->canal = $canal;
                        Doo::db()->update($factura);
                        
                    }
                }
                $sql = "select * from factura as f left join facturaservicio as fs on fs.id_factura = f.id where f.id = ?";
                $query = Doo::db()->query($sql, array($factura->id));
                $rs = $query->fetchAll();

                

                /* return Doo::conf()->APP_URL.'admin/facturas'; */
            }
            Doo::db()->commit();
            echo '
                <script>
                    alert("invoicing proccess completed redirecting...");
                    location.href="' . Doo::conf()->APP_URL . 'admin/facturas/";
                </script>
                ';
        } catch (Exception $exc) {
            Doo::db()->rollBack();
            echo $exc->getTraceAsString();
        }


        exit;
    }

    public function invoices() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = "facturacion/invoices.php";
        $this->renderc('admin/index', $this->data, true);
    }

    public function search_invoices() {
        $starting = $this->params['start'];
        $ending = $this->params['end'];
        $filtro = $this->params['filter'];
        $disc = $this->params['texto'];
        if ($filtro == "all") {
            $texto = "1";
        } else if ($filtro == "company_name") {
            $texto = "agency like '%" . $disc . "%'";
        }
//        } else if ($filtro == "PAID") {
//            $texto = "estado = '$filtro'";
//        } else if ($filtro == "UNPAID") {
//            $texto = "estado = '$filtro'";
//        }else if ($filtro == "COMISION") {
//            $texto = "estado = '$filtro'";
//        }
        list($m1, $d1, $y1) = explode('-', $starting);
        list($m2, $d2, $y2) = explode('-', $ending);
        $f_ini = $y1 . '-' . $m1 . '-' . $d1;
        $f_fin = $y2 . '-' . $m2 . '-' . $d2;
        $sql = "select * from (select f.id,f.collect,f.subtotal,f.total, IFNULL(a.company_name,IF(f.canal = 'WEBSALE','Supertours WEBSALE','Supertours')) as agency, DATE_FORMAT(f.creation_date, '%Y-%m-%d') as invoicedate from factura as f left join agencia as a on f.id_agency = a.id where creation_date BETWEEN ? and ? and estado != 'CANCELED'  order by f.creation_date DESC) as result where $texto   ";
        
        $query = Doo::db()->query($sql, array($f_ini, $f_fin));
        $rs = $query->fetchAll();
//        echo $filtro;
//        print_r(Doo::db()->showSQL());
//        exit;
        if ($query->rowCount() == 0) {
            /* echo 'aqui';
              exit; */
            echo json_encode(array('resp' => "false"));
        } else {
            echo json_encode($rs);
        }
    }

    public function get_invoice() {
        try {
            $id = $this->params['id'];

            //averiguar el id de la compaÃ±ia de la factura para saber si colocar la informacion de la agencia o
            //hacer una factura dummy con los datos de supertour.

            $sql2 = "select id_agency from factura where id = ?";
            $q = Doo::db()->query($sql2, array($id));
            $rs = $q->fetchAll();
            $id_agency = intval($rs[0]['id_agency']);

            if ($id_agency != -1) {
                $sql = "select f.id as invoicenumber, f.total as total, f.subtotal as subtotal, f.collect as collect, f.creation_date as invoicedate, a.company_name as agency, a.address as addres, a.state as state, a.fax as fax, a.phone1 as phone1 from factura as f left join agencia as a on f.id_agency = a.id where f.id = ? ";
            } else {
                $sql = "select f.id as invoicenumber, f.total as total, f.subtotal as subtotal, f.collect as collect, f.creation_date as invoicedate, 'SUPERTOURS' as agency, '5419 International Drive' as addres, 'ORLANDO, FL. 32819' as state, '' as fax, '1-800-251-4206' as phone1 from factura as f left join agencia as a on f.id_agency = a.id where f.id = ? ";
            }
            $query = Doo::db()->query($sql, array($id));
            $rs = $query->fetchAll();

            $rs[0]['invoicedate'] = date('Y-m-d', strtotime($rs[0]['invoicedate']));

            echo json_encode($rs[0]);
        } catch (Exception $e) {
            
        }
    }

    public function get_invoice_services() {
        try {
            $id = $this->params['id'];
            $services = array();
            $sql = "select * from facturaServicio where id_factura = ?";
            $query = Doo::db()->query($sql, array($id));
            $rs = $query->fetchAll();
            foreach ($rs as $service) {
                $sdesc = array();
                if ($service['tipo_servicio'] == "ONE") {
                    Doo::loadModel('Tour_oneday');
                    $one = new Tour_oneday();
                    $one->id = $service['id_servicio'];
                    $one = Doo::db()->getOne($one);
                    $sdesc['adult'] = $one->adult;
                    $sdesc['children'] = $one->child;
                    $sdesc['confcode'] = $one->code_conf;
                    $sdesc['initdate'] = $one->starting_date;
                    $sdesc['enddate'] = $one->ending_date;
                    $sql2 = "select firstname,lastname from clientes where id = ?";
                    $q2 = Doo::db()->query($sql2, array($one->id_client));
                    $rs = $q2->fetchAll();
                    $sdesc['pax'] = $rs[0]['lastname'] . ', ' . $rs[0]['firstname'];
                    $sdesc['type'] = "ONE";
                    $sdesc['sale'] = $one->total;
                    $sql3 = "select monto_pagado from collectservice where id_servicio = ? and tipo_servicio = ?";
                    $q3 = Doo::db()->query($sql3, array($one->id, 'ONE'));
                    $rs = $q3->fetchAll();
                    if ($q3->rowCount() == 0) {
                        $sdesc['collect'] = 0;
                    } else {
                        $sdesc['collect'] = $rs[0]['monto_pagado'];
                    }
                    $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
                } else if ($service['tipo_servicio'] == "MULTI") {
                    Doo::loadModel('Tours');
                    $multi = new Tours();
                    $multi->id = $service['id_servicio'];
                    $multi = Doo::db()->getOne($multi);
                    $sdesc['adult'] = $multi->adult;
                    $sdesc['children'] = $multi->child;
                    $sdesc['confcode'] = $multi->code_conf;
                    $sdesc['initdate'] = $multi->starting_date;
                    $sdesc['enddate'] = $multi->ending_date;
                    $sql2 = "select firstname,lastname from clientes where id = ?";
                    $q2 = Doo::db()->query($sql2, array($multi->id_client));
                    $rs = $q2->fetchAll();
                    $sdesc['pax'] = $rs[0]['lastname'] . ', ' . $rs[0]['firstname'];
                    $sdesc['type'] = "MULTI";
                    $sdesc['sale'] = $multi->total;
                    $sql3 = "select monto_pagado from collectservice where id_servicio = ? and tipo_servicio = ?";
                    $q3 = Doo::db()->query($sql3, array($multi->id, 'MULTI'));
                    $rs = $q3->fetchAll();
                    if ($q3->rowCount() == 0) {
                        $sdesc['collect'] = 0;
                    } else {
                        $sdesc['collect'] = $rs[0]['monto_pagado'];
                    }
                    $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
                } else if ($service['tipo_servicio'] == "RESERVE") {
                    Doo::loadModel('Reserve');
                    $res = new Reserve();
                    $res->id = $service['id_servicio'];
                    $res = Doo::db()->getOne($res);
                    $sdesc['adult'] = $res->pax;
                    $sdesc['children'] = $res->pax2;
                    $sdesc['confcode'] = $res->codconf;
                    $sdesc['initdate'] = $res->fecha_ini;
                    $sdesc['enddate'] = $res->fecha_retorno;
                    $sdesc['pax'] = $res->lasname . ', ' . $res->firsname;
                    $sdesc['type'] = "RESERVE";
                    $sdesc['sale'] = $res->total2;
                    $sql3 = "select monto_pagado from collectservice where id_servicio = ? and tipo_servicio = ?";
                    $q3 = Doo::db()->query($sql3, array($res->id, 'RESERVE'));
                    $rs = $q3->fetchAll();
                    if ($q3->rowCount() == 0) {
                        $sdesc['collect'] = 0;
                    } else {
                        $sdesc['collect'] = $rs[0]['monto_pagado'];
                    }
                    $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
                }
                array_push($services, $sdesc);
            }

            echo json_encode($services);
        } catch (Exception $e) {
            
        }
    }

    public function genpdf() {
        $id = $this->params['id'];
        Doo::loadModel('Factura');
        Doo::loadModel('Agency');
        $factura = new Factura();
        $factura->id = $id;
        $factura = Doo::db()->getOne($factura);

        if ($factura->id_agency == -1) {
            $agency = new Agency();
            $agency->company_name = "Supertours";
            $agency->address = "712 DR. PHILLIPS BLVD.";
            $agency->city = "Orlando";
            $agency->state = "Florida";
            $agency->fax = "";
            $agency->phone1 = "1-800-251-4206";
        } else {
            $agency = new Agency();
            $agency->id = $factura->id_agency;
            $agency = Doo::db()->getOne($agency);
        }

        $sql = "SELECT t1.*,
                            t2.starting_date AS fecha
                     FROM facturaservicio t1
                     LEFT JOIN tours_oneday t2 ON (t1.id_servicio = t2.id)
                     WHERE t1.id_factura = ?
                       AND t1.TIPO_SERVICIO = 'ONE'
                     UNION
                     SELECT t1.*,
                            t2.starting_date AS fecha
                     FROM facturaservicio t1
                     LEFT JOIN tours t2 ON (t1.id_servicio = t2.id)
                     WHERE t1.id_factura = ?
                       AND t1.TIPO_SERVICIO = 'MULTI'
                     UNION
                     SELECT t1.*,
                            t2.fecha_salida_ns AS fecha
                     FROM facturaservicio t1
                     LEFT JOIN reservas t2 ON (t1.id_servicio = t2.id)
                     WHERE t1.id_factura = ?
                       AND t1.TIPO_SERVICIO = 'RESERVE'
                     ORDER BY fecha ASC";
        $query = Doo::db()->query($sql, array($id,$id,$id));
        $rs = $query->fetchAll();
        $services = array();
        foreach ($rs as $service) {
            $sdesc = array();
            if ($service['tipo_servicio'] == "ONE") {
                Doo::loadModel('Tour_oneday');
                $one = new Tour_oneday();
                $one->id = $service['id_servicio'];
                $one = Doo::db()->getOne($one);
                /* echo json_encode($service);
                  exit; */
                $sdesc['adult'] = $one->adult;
                $sdesc['children'] = $one->child;
                $sdesc['confcode'] = $one->code_conf;
                $sdesc['initdate'] = $one->starting_date;
                $sdesc['enddate'] = $one->ending_date;
                $sql2 = "select firstname,lastname from clientes where id = ?";
                $q2 = Doo::db()->query($sql2, array($one->id_client));
                $rs = $q2->fetchAll();
                $sdesc['pax'] = $rs[0]['lastname'] . ', ' . $rs[0]['firstname'];
                $sdesc['type'] = "ONE DAY TOUR";
                $sdesc['sale'] = $one->totalouta;
                $sql3 = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                $q3 = Doo::db()->query($sql3, array($one->id, 'ONE'));
                $rs = $q3->fetch();
                if ($rs['pagado'] > 0) {
                    $sdesc['collect'] = $rs['pagado'];                    
                } else {
                    $sdesc['collect'] = 0;
                }
                $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
            } else if ($service['tipo_servicio'] == "MULTI") {
                Doo::loadModel('Tours');
                $multi = new Tours();
                $multi->id = $service['id_servicio'];
                $multi = Doo::db()->getOne($multi);
                $sdesc['adult'] = $multi->adult;
                $sdesc['children'] = $multi->child;
                $sdesc['confcode'] = $multi->code_conf;
                $sdesc['initdate'] = $multi->starting_date;
                $sdesc['enddate'] = $multi->ending_date;
                $sql2 = "select firstname,lastname from clientes where id = ?";
                $q2 = Doo::db()->query($sql2, array($multi->id_client));
                $rs = $q2->fetchAll();
                $sdesc['pax'] = $rs[0]['lastname'] . ', ' . $rs[0]['firstname'];
                $sdesc['type'] = "MULTI DAY TOUR";
                $sdesc['sale'] = $multi->totalouta;
                $sql3 = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                $q3 = Doo::db()->query($sql3, array($multi->id, 'MULTI'));
                $rs = $q3->fetch();
                if ($rs['pagado'] > 0) {
                    $sdesc['collect'] = $rs['pagado'];
                } else {                    
                    $sdesc['collect'] = 0;
                }
                $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
            } else if ($service['tipo_servicio'] == "RESERVE") {
                Doo::loadModel('Reserve');
                $res = new Reserve();
                $res->id = $service['id_servicio'];
                $res = Doo::db()->getOne($res);
                $sdesc['adult'] = $res->pax;
                $sdesc['children'] = $res->pax2;
                $sdesc['confcode'] = $res->codconf;
                $sdesc['initdate'] = $res->fecha_salida_ns;
                $sdesc['enddate'] = $res->fecha_retorno_ns;
                $sdesc['pax'] = $res->lasname . ', ' . $res->firsname;
                $sdesc['type'] = "TRANSPORTATION";
                $sdesc['sale'] = $res->totaltotal;
                $sql3 = "SELECT sum(pagado) as pagado FROM reservas_pago WHERE id_reserva = ?";
                $q3 = Doo::db()->query($sql3, array($res->id));
                $rs = $q3->fetch();
                if ($rs['pagado'] > 0) {
                    $sdesc['collect'] = $rs['pagado'];
                } else {                    
                    $sdesc['collect'] = 0;
                }
                $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
            }

            array_push($services, $sdesc);
            
        }
//        print_r($services);
//            exit;
$fecha = $factura->creation_date;
$nuevafecha = strtotime ( '-0 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date('m-d-Y' , $nuevafecha);
 

        $inv_number = ($factura->estado == "CANCELED") ? '<strike>' . str_pad($factura->id, 8, '0', STR_PAD_LEFT) . '</strike><b>CANCELED</b>' : str_pad($factura->id, 8, '0', STR_PAD_LEFT);
        $html = '<html>
                 <head>
                    <style>

                        .invoice-info{
                            top: 30%;
                            right: 80px;
                            /*border: 1px #00002C solid;*/
                            padding: 5px 40px 5px 10px;
                            border-radius:10px;
                        }

                        .invoice-number{
                            border-bottom: 1px solid #000066;
                        }

                        .title-ninvoice{
                            color: #000066;
                            font-size: 12px;
                            font-style: italic;
                            font-weight: bold;
                        }

                        .other-info{
                            font-size: 12px;
                            font-weight: bold;
                        }

                        .ninvoice{
                            color: #EE0000;
                            font-size: 18px;
                            font-style: italic;
                            font-weight: bold;
                        }

                        .pretitle{
                            min-width:98%;
                            border: 1px solid #000000;
                            padding: 5px 0 5px 5px;
                            background-color: #DDDFE0;
                        }

                        .grid {
                            width: 100%;
                            border-spacing: 1px;
                            background-color: rgba(231, 231, 231, 0.42);
                            font-family: Arial, Helvetica, sans-serif;
                            font-size: 12px;
                            color: #0A439A;
                        }

                        thead {
                            display: table-header-group;
                            vertical-align: middle;
                            border-color: inherit;
                        }

                        .grid thead th {
                            text-align: center;
                            background: #DDDFE0;
                            color: #0B55C4;
                            border-bottom: 1px solid white;
                            border-left: 1px solid white;
                            font-weight: bold;
                            height: 25px;
                            border-bottom-width: 1px;
                            border-bottom-style: solid;
                            border-bottom-color: #666666;
                        }
                        .gris{
                          background-color: #DDDFE0;
                          text-align:center;
                        }
                        .linea  { border-bottom: thin solid rgba(0, 0, 0, 0.33); }
                    </style>
                 </head>
                 <body>
            <table style="padding: 0 16px 0 16px;width: 100%;">
        <tbody>
            <tr>
                <!--<td style="width: 5%;"><img src="' . Doo::conf()->APP_URL . 'global/img/admin/logo2.png" class="supertours-banner" style="width:250px;" >-->
                <td style="width: 5%;"><img src="https://www.supertours.com/logo2.png" class="supertours-banner" alt="" style="width: 250px;" />
                

                    <!--<p>Supertours of Orlando</p>
                    <blockquote>5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>-->
                </td>
                <td style="width:30%">

                    <table style="width:100%;">
                        <tbody><tr>
                            <td style="vertical-align: top">
                                <div class="invoice-info">
                                    <div class="invoice-number">
                                        <span class="title-ninvoice">SUPER TOURS OF ORLANDO, Inc.</span>
                                    </div>
                                    <div class="other-info" style="display:table">
                                        <p style="display:table-row"><span style="display:table-cell">5419 International Dr. Suite F</span></p>
                                        <p style="display:table-row"><span style="display:table-cell">Orlando, FL 32819</span></p>
                                        <p style="display:table-row"><span style="display:table-cell">(407) 370-3001</span></p>
                                        <p style="display:table-row"><span style="display:table-cell">accounting@supertours.com</span></p>
                                        <p style="display:table-row"><span style="display:table-cell">http://www.supertours.com</span></p>
                                    </div>
                                <div>
                            </div></div></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody></table>
                    

                </td>
                
                <td style="width:40%">
                <span style="font-size: 18px;    font-weight: bold;    margin-left:120px;">Invoice</span>
                    <table style="width:100%; border: 1px solid;">
                        <tbody>
                        <tr>
                            <!--<td style="vertical-align: top">
                                <div class="invoice-info">
                                    <div class="invoice-number">
                                        <span class="title-ninvoice">Invoice Number : </span><span class="ninvoice">' . $inv_number . '</span>
                                    </div>
                                    <div class="other-info" style="display:table">
                                        <p style="display:table-row"><span style="display:table-cell">Terms</span> <span style="display:table-cell"> : Due upon Receipt</span></p>
                                        <p style="display:table-row"><span style="display:table-cell">Date</span> <span style="display:table-cell"> : ' . $factura->creation_date . '</span></p>
                                    </div>
                                <div>
                            </div></div></td>-->
                            
                            <td class="gris" font-size:13px;>Date</td>
                            <td class="gris" font-size:13px;>Invoice #</td>

                        </tr>
                        <tr>
                            <td style="text-align:center;"><span style="font-size:13px;"> ' . $nuevafecha/*date("m-d-Y",strtotime($nuevafecha/*$factura->creation_date))*/ . '</span></td>
                            <td style="text-align:center;"><span class="ninvoice" style="font-size:13px;">' . $inv_number . '</span></td>
                        </tr>
                        <tr>
                            <td class="gris" font-size:13px;>Terms</td>
                            <td class="gris" font-size:13px;>Due Date</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;font-size:13px;with:100px">Due upon Receipt</td>
                            <td style="text-align:center;font-size:13px;"><span style="">' . $nuevafecha/*date("m-d-Y",strtotime($nuevafecha/*$factura->creation_date))*/ . '</span></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
            ';
        if ($agency->company_name != "Supertours") {
            $html.='
            <tr>
               <td><div class="pretitle">Bill To</div></td>
                <!-- <td><div class="pretitle">Make check payable to</div></td>-->

            </tr>
            <tr>
                <td style="border: 1px solid black;border-top: none;">
                
                    <b><span style="font-size:18px;">' . ucwords(strtolower($agency->company_name)) . '    </span></b><br>
                    <blockquote style="margin: 0px;">' . ucwords(strtolower($agency->address)) . '<br>' . ucwords(strtolower($agency->address2)) .($agency->address2!=""?"<br>":""). '
                        ' . ucwords(strtolower($agency->city)) . ',
                        ' . ucwords(strtolower($agency->state))  .' '. ucwords(strtolower($agency->zipcode)) .'<br>
                        ' . ucwords(strtolower($agency->main_email)) . '     <br>
                        ' . ucwords(strtolower($agency->phone1)) . '<br>
                    </blockquote>
                </td>
                <!--<td style="padding-left:10px;"><p><b>SUPERTOURS OF ORLANDO</b></p>
                <blockquote>ORLANDO CROSSING MALL, 5419<br>5419 International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>-->
            </tr>
            ';
        } else {
            $html.="<tr><td colspan='2' ><h3>Sales Report</h3></td></tr>";
        }
        $html .='
            <tr>
                </tr></tbody></table>
        ';
        $html.= '<table class="grid">
                    <thead>
                        <tr>
                            <th rowspan="2">AD</th>
                            <th rowspan="2">CH</th>
                            <th rowspan="2">Pax Name<br>Service</th>
                            <th rowspan="2">Confirmation</th>
                            <th rowspan="2">Departure <br> Return</th>
                            <th rowspan="2">Total Sale -<br>Amount Paid</th>
                            <th rowspan="2"><br> = Total Due</th>
                        </tr>
                        <tr>
                            
                        
                    </thead>
                    <tbody id="invoice-concepts">';

        foreach ($services as $service) {
          //$fecha_inicio = ($service['initdate'] != "N/A"?date("m-d-Y",strtotime($service['initdate'])):"N/A");
          $fecha_final = ($service['enddate'] != "N/A"?date("m-d-Y",strtotime($service['enddate'])):"N/A");
            $html.= '<tr>
                  <td style="text-align:center;" class="linea">' . $service['adult'] . '</td>
                  <td style="text-align:center;" class="linea">' . $service['children'] . '</td>
                  <td class="linea">' . $service['pax'] . '<br>' . $service['type'] . '</td>
                  <td class="linea">' . $service['confcode'] . '</td>
                  <td class="linea">' . date("m-d-Y",strtotime($service['initdate'])) . '<br>' . $fecha_final . '</td>
                  <td style="text-align:right;" class="linea">$ ' . number_format($service['sale'], 2, '.', '') . '<br>$ ' . number_format($service['collect'], 2, '.', '') . '</td>
                  <td style="text-align:right;" class="linea">$ ' . number_format($service['total'], 2, '.', '') . '</td>
                  </tr>';
        }

        $html .= '</tbody>
                 </table>';
        
        $html.='<table id="results" style="position:absolute; right:200px; border-radius:10px; border:1px #000 solid; min-height: 100%; margin:10px 0 50px 0;">
                    <tbody><tr>
                    <th>Total</th>
                    <td style="width:100px; text-align: right; font-size: 15px;">$ ' . $factura->subtotal . '</td>
                    </tr>
                    <tr>
                    <th>Collected</th>
                    <td style="border-bottom: 1px #000000 solid; text-align: right; font-size: 15px;">$ ' . $factura->collect . '</td>
                    </tr>
                    <tr>
                    <th>Balance Due</th>
                    <td style="text-align: right; font-size: 15px;">$ ' . $factura->total . '</td>
                    </tr>
                </tbody></table>';
        $html.='<table id="results" style="position:absolute; right:500px; border-radius:10px;  min-height: 50%; margin:100px 0 50px 0;">
                    <tbody><tr>
                    <th>THANK YOU FOR YOUR BUSINESS.<br> PLEASE REMIT PAYMENT PROMPTLY</th>                    
                    </tr>
                </tbody></table>';
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Invoice #' . $id, $html, false, 'letter', 'letter');
        $pdf->doPDF();
        //echo $html;
       // exit;
    }

    public function cancel_invoice() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'facturacion/canceling.php';
        $this->renderc('admin/index', $this->data, true);
    }

    public function getInvoicebyid() {
        $id_factura = $this->params['id'];
        $sql = "select f.id,a.company_name as agency, f.subtotal, f.collect,f.total,f.creation_date as invoicedate from factura as f left join agencia as a on (f.id_agency = a.id) where f.id = ? and (f.estado = 'UNPAID' or f.estado = 'COMISION' or f.estado = 'PAID') ";
        $q = Doo::db()->query($sql, array($id_factura));
        $rs = $q->fetchAll();
        if (isset($rs[0])) {
            $sql2 = "select * from pagos where factura = ?";
            $q2 = Doo::db()->query($sql2, array($id_factura));
            $rs2 = $q2->rowCount();
            $valid_op = true;
            if ($rs2 > 0) {
                $valid_op = false;
            }
            $rs[0]['id'] = str_pad($rs[0]['id'], 8, '0', STR_PAD_LEFT);
            $rs[0]['validop'] = $valid_op;
            echo json_encode($rs[0]);
        } else {
            echo json_encode(false);
        }
    }

    public function cancel_process() {
        $id_factura = ltrim($_POST['factura'], '0');
        Doo::loadModel('CanceledInvoice');
        $cancel = new CanceledInvoice();
        $cancel->factura = $id_factura;
        $cancel->motivo = $_POST['cancel-concept'];
        $df = new DooFile();
        $file = $df->upload(Doo::conf()->FILE_DIR . '/global/uploads/', 'attach', 'canceled_' . $id_factura . '-' . date('Y-m-d'));
        if (isset($file)) {
            $cancel->adjunto = '/global/uploads/' . $file;
        }
        $cancel->id = $cancel->insert();
        Doo::loadModel('Factura');
        $factura = new Factura();
        $factura->id = $id_factura;
        $factura = Doo::db()->getOne($factura);
        $factura->estado = "CANCELED";
        $factura->update();
        $sql0 = "select tipo_servicio, id_servicio from facturaservicio where id_factura = ?";
        $q = Doo::db()->query($sql0, array($id_factura));
        $rs = $q->fetchAll();

        foreach ($rs as $service) {
            if ($service['tipo_servicio'] == "RESERVE") {
                Doo::loadModel('Reserve');
                $reserve = new Reserve();
                $reserve->id = $service['id_servicio'];
                $reserve = Doo::db()->getOne($reserve);
                $reserve->estado = "CONFIRMED";
                $reserve->update();
            } else if ($service['tipo_servicio'] == "MULTI") {
                Doo::loadModel('Tours');
                $tour = new Tours();
                $tour->id = $service['id_servicio'];
                $tour = Doo::db()->getOne($tour);
                $tour->estado = "CONFIRMED";
                $tour->update();
            } else if ($service['tipo_servicio'] == "ONE") {
                Doo::loadModel('Tour_oneday');
                $tour = new Tour_oneday();
                $tour->id = $service['id_servicio'];
                $tour = Doo::db()->getOne($tour);
                $tour->estado = "CONFIRMED";
                $tour->update();
            }
        }

        echo  '<script>
                alert("Canceled Invoice Number #' . $id_factura . ', Redirecting to canceled invoices panel");
                location.href="' . Doo::conf()->APP_URL . 'admin/facturacion/canceladas";
              </script>';
    }

    public function canceled_invoices() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'facturacion/canceled.php';
        $this->renderc('admin/index', $this->data, true);
    }

    //buscar facturas canceladas
    public function search_cinvoices() {
        $filtro = $this->params['filter'];
        $disc = $this->params['texto'];
        if ($filtro == "all") {
            $texto = "1";
        } else if ($filtro == "company_name") {
            $texto = "agency like '%" . $disc . "%'";
        }

        $sql = "select * from (select f.id,f.collect,f.subtotal,f.total, IFNULL(a.company_name,'Supertours') as agency, DATE_FORMAT(f.creation_date, '%Y-%m-%d') as invoicedate, ci.id as cancelid from factura as f left join agencia as a on f.id_agency = a.id left join cancelledinvoices as ci on f.id = ci.factura where f.estado = 'CANCELED' ) as result where $texto ";
        $query = Doo::db()->query($sql);
        $rs = $query->fetchAll();
        if ($query->rowCount() == 0) {
            echo json_encode(array('resp' => "false"));
        } else {
            echo json_encode($rs);
        }
    }

    public function cancel_report() {
        $id = $this->params['id'];
        $sql = "select adjunto as imagen, motivo as texto from cancelledinvoices where id = ? limit 1";
        $q = Doo::db()->query($sql, array($id));
        $rs = $q->fetchAll();
        echo json_encode($rs[0]);
    }

    public function edit_invoice() {
        $id = $this->params['id'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'facturacion/edit.php';

        Doo::loadModel('Factura');
        $factura = new Factura();
        $factura->id = $id;
        $factura = Doo::db()->getOne($factura);

        if ($factura->id_agency != -1) {
            $sql = "SELECT a.company_name FROM agencia as a where id = ?";
            $q = Doo::db()->query($sql, array($factura->id_agency));
            $rs = $q->fetchAll();
            $this->data['company_name'] = $rs[0]['company_name'];
        } else {
            $this->data['company_name'] = "Supertours";
        }
        $this->data['factura'] = $factura;

        try {
            $services = array();
            $sql = "select * from facturaservicio where id_factura = ?";
            $query = Doo::db()->query($sql, array($id));
            $rs = $query->fetchAll();
            foreach ($rs as $service) {
                $sdesc = array();
                if ($service['tipo_servicio'] == "ONE") {
                    Doo::loadModel('Tour_oneday');
                    $one = new Tour_oneday();
                    $one->id = $service['id_servicio'];
                    $one = Doo::db()->getOne($one);
                    $sdesc['id'] = $one->id;
                    $sdesc['adult'] = $one->adult;
                    $sdesc['children'] = $one->child;
                    $sdesc['confcode'] = $one->code_conf;
                    $sdesc['initdate'] = $one->starting_date;
                    $sdesc['trip_no'] = 1;
                    $sdesc['enddate'] = $one->ending_date;
                    $sdesc['trip_no2'] = 1;
                    $sdesc['link'] = 'onedaytour';
                    $sql2 = "select firstname,lastname from clientes where id = ?";
                    $q2 = Doo::db()->query($sql2, array($one->id_client));
                    $rs = $q2->fetchAll();
                    $sdesc['pax'] = $rs[0]['lastname'] . ', ' . $rs[0]['firstname'];
                    $sdesc['type'] = "ONE";
                    $sdesc['sale'] = $one->totalouta;
//                    $sql3 = "select monto_pagado from collectservice where id_servicio = ? and tipo_servicio = ?";
                    $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                    $q3 = Doo::db()->query($sql, array($one->id, 'ONE'));
                    $rs = $q3->fetch();
                    if ($rs['pagado'] > 0) {
                        $sdesc['collect'] = $rs['pagado'];                        
                    } else {
                        $sdesc['collect'] = 0;
                    }
                    $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
                } else if ($service['tipo_servicio'] == "MULTI") {
                    Doo::loadModel('Tours');
                    $multi = new Tours();
                    $multi->id = $service['id_servicio'];
                    $multi = Doo::db()->getOne($multi);
                    $sdesc['id'] = $multi->id;
                    $sdesc['adult'] = $multi->adult;
                    $sdesc['children'] = $multi->child;
                    $sdesc['confcode'] = $multi->code_conf;
                    $sdesc['initdate'] = $multi->starting_date;
                    $sdesc['trip_no'] = 1;
                    $sdesc['enddate'] = $multi->ending_date;
                    $sdesc['trip_no2'] = 1;
                    $sdesc['link'] = 'tours';
                    $sql2 = "select firstname,lastname from clientes where id = ?";
                    $q2 = Doo::db()->query($sql2, array($multi->id_client));
                    $rs = $q2->fetchAll();
                    $sdesc['pax'] = $rs[0]['lastname'] . ', ' . $rs[0]['firstname'];
                    $sdesc['type'] = "MULTI";
                    $sdesc['sale'] = $multi->totalouta;
                    $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                    $q3 = Doo::db()->query($sql, array($multi->id, 'MULTI'));
                    $rs = $q3->fetch();
                    if ($rs['pagado'] > 0) {
                        $sdesc['collect'] = $rs['pagado'];
                    } else {                        
                        $sdesc['collect'] = 0;
                    }
                    $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
                } else if ($service['tipo_servicio'] == "RESERVE") {
                    Doo::loadModel('Reserve');
                    $res = new Reserve();
                    $res->id = $service['id_servicio'];
                    $res = Doo::db()->getOne($res);
                    $sdesc['id'] = $res->id;
                    $sdesc['adult'] = $res->pax;
                    $sdesc['children'] = $res->pax2;
                    $sdesc['confcode'] = $res->codconf;
                    $sdesc['initdate'] = $res->fecha_salida;//actaulizado(fecha_ini)
                    $sdesc['trip_no'] = $res->trip_no;
                    $sdesc['enddate'] = $res->fecha_retorno;
                    $sdesc['trip_no2'] = $res->trip_no2;
                    $sdesc['pax'] = $res->lasname . ', ' . $res->firsname;
                    $sdesc['type'] = "RESERVE";
                    $sdesc['sale'] = $res->totaltotal;
                    $sdesc['link'] = "reservas";
                    $sql = 'SELECT sum(pagado) as pagado FROM reservas_pago WHERE id_reserva = ? ';
                    
                    $q3 = Doo::db()->query($sql, array($res->id));
                    $rs = $q3->fetch();
                    
                    if ($rs['pagado'] > 0) {
                        $sdesc['collect'] = $rs['pagado'];
                    } else {
                        $sdesc['collect'] = 0;
                    }
                    $sdesc['total'] = $sdesc['sale'] - $sdesc['collect'];
                }
                array_push($services, $sdesc);
            }

            $this->data['services'] = $services;
            $_SESSION['reinvoicing'] = true;
        } catch (Exception $e) {
            print_r($e);
        }
        
        $this->renderc('admin/index', $this->data, true);
    }

    public function is_reinvoicing() {
        echo json_encode(array('reinvoicing' => $_SESSION['reinvoicing']));
    }

    public function remake_process() {
        unset($_SESSION['reinvoicing']);
        $id = $this->params['id'];
        
        Doo::loadModel('Factura');
        $factura = new Factura();
        $factura->id = $id;
        $factura = Doo::db()->getOne($factura);
        $sql = 'SELECT * FROM facturaservicio where id_factura = ?';
        $q = Doo::db()->query($sql, array($factura->id));
        $rs = $q->fetchAll();
        $n_factura = new Factura();
        $n_factura->id_agency = $factura->id_agency;
        $n_factura->creation_date = $factura->creation_date;
        $n_factura->estado = 'UNPAID';
        $n_factura->collect = $factura->collect;
        $n_factura->id = $factura->id;
        Doo::loadModel('FacturaServicio');
        $n_total = 0;
        $collect = 0;
        foreach ($rs as $service) {

            //creamos los nuevos servicios de facturacion
            $fs = new FacturaServicio();
            $fs->id_factura = $n_factura->id;
            $fs->id_servicio = $service['id_servicio'];
            $fs->tipo_servicio = $service['tipo_servicio'];
//            $fs->insert();
//            $collect = 0;
//            //buscamos los collect anteriores y los atamos
//            $sql2 = "SELECT * FROM collectservice where id_servicio = ? and tipo_servicio = ?";
//            $q2 = Doo::db()->query($sql2, array($fs->id_servicio, $fs->tipo_servicio));
//            $rs2 = $q2->fetchAll();
//            if (isset($rs2[0])) { //si hay un collect
//                Doo::loadModel('CollectService');
//                $cs = new CollectService();
//                $cs->id_servicio = $fs->id_servicio;
//                $cs->tipo_servicio = $fs->tipo_servicio;
//                $cs->monto_pagado = $rs2[0]['monto_pagado'];
//                $cs->insert();
//            }

            if ($service['tipo_servicio'] == 'ONE') {
                $sql0 = "select total,totalouta,canal from tours_oneday where id = ?";
                $q0 = Doo::db()->query($sql0, array($fs->id_servicio));
                $rs0 = $q0->fetch();
                $canal = $rs0['canal'];
                $totalouta = $rs0['totalouta'];
                $n_total += $totalouta;
                //echo $n_total."<br>";
                $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                $query = Doo::db()->query($sql, array($fs->id_servicio,"ONE"));
                $rs = $query->fetch();

                if ($rs['pagado'] > 0) {
                   $collect += $rs['pagado'];
                  // echo $collect."<br>";
                }
            } else if ($service['tipo_servicio'] == 'MULTI') {
                $sql0 = "select total,totalouta,canal from tours where id = ?";
                $q0 = Doo::db()->query($sql0, array($fs->id_servicio));
                $rs0 = $q0->fetch();
                $canal = $rs0['canal'];
                $totalouta = $rs0['totalouta'];
                $n_total += $totalouta;
                //echo $n_total."<br>";
                $sql = "SELECT SUM(pagado) AS pagado FROM tours_pago WHERE id_tours = ? and tipo = ?";
                $query = Doo::db()->query($sql, array($fs->id_servicio,"MULTI"));
                $rs = $query->fetch();
                if ($rs['pagado'] > 0) {
                     $collect += $rs['pagado'];
//                      echo $collect."<br>";
                }
            } else if ($service['tipo_servicio'] == 'RESERVE') {
                $sql0 = "select total2 as total,totaltotal,canal from reservas where id = ?";
                $q0 = Doo::db()->query($sql0, array($fs->id_servicio));
                $rs0 = $q0->fetch();
                $canal = $rs0['canal'];
                $totalouta = $rs0['totaltotal'];
                $n_total += $totalouta;
//                echo $n_total."<br>";
                $sql = 'SELECT sum(pagado) as pagado FROM reservas_pago WHERE id_reserva = ? ';
                $query = Doo::db()->query($sql, array($fs->id_servicio));
                $rs = $query->fetch();
                if ($rs['pagado'] > 0) {
                    $collect += $rs['pagado'];
//                     echo $collect."<br>";
                }
            }
        }
        
        $n_factura->subtotal = $n_total;
        $n_factura->total = $n_factura->subtotal - $collect;
        $n_factura->collect = $collect;
        $n_factura->canal = $canal;
        if($n_factura->total == 0){
            $estado = 'PAID';
        }else if($n_factura->total - 0){
            $estado = 'COMISION';
        }else if($n_factura->total > 0){
            $estado = 'UNPAID';
        }
        $n_factura->estado = $estado;
        //print_r();
        $n_factura->update();
//        Doo::loadModel('CanceledInvoice');
//        $ci = new CanceledInvoice();
//        $ci->factura = $factura->id;
//        $ci->motivo = "Remake Invoice Process onto new Invoice # " . str_pad($n_factura->id, 8, '0', STR_PAD_LEFT);
//        $ci->adjunto = "#";
//        $ci->insert();
//        $factura->estado = "CANCELED";
//        $factura->update();
        echo '<script>
                alert("Process complete... Redirecting");
                location.href="' . Doo::conf()->APP_URL . 'admin/facturas";
              </script>';
        /* return Doo::conf()->APP_URL.'admin/facturacion/genpdf/'.$n_factura->id; */
    }

}
