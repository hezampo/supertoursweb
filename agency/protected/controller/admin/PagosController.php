<?php
//Actualizado por Ing. Arturo Bustamante Madariaga. [2016-2018]

Doo::loadController('I18nController');
Doo::loadHelper('DooFile');

class PagosController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function cancel_pay() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        $this->data['id_reserva'] = $this->params['id_reserva'];
        $this->data['tipo_reserva'] = $this->params['tipo_reserva'];
        
        $this->data['content'] = 'pagos/cancelar_pago.php';
        $this->renderc('admin/index', $this->data, true);
    }

    public function cancel_pay_search() {
        $id_reserva = $this->params['id_reserva'];
        $id_filtro = $this->params['id_filtro'];

        if ($id_filtro == 0) {
            $sql = "SELECT r.*,r.id_reserva as id_r, u.nombre as usuario FROM reservas_pago r left join usuarios u on (r.usuario = u.id) WHERE id_reserva = ?";
        } else {
            if($id_filtro == 1){
                $where = "and tipo = 'MULTI'";
            }else if($id_filtro == 2){
                $where = "and tipo = 'ONE'";
            }
            $sql = "SELECT r.*,r.id_tours as id_r, u.nombre as usuario FROM tours_pago r left join usuarios u on (r.usuario = u.id) WHERE id_tours = ? $where";
        }

        $q = Doo::db()->query($sql, array($id_reserva));
        $rs = $q->fetchAll();
        if (isset($rs)) {

            //$rs[0]['id'] = str_pad($rs[0]['id'], 8, '0', STR_PAD_LEFT);

            echo json_encode($rs);
        } else {
            echo json_encode(false);
        }
    }

    public function cancel_pay_process() {
        
//        $id_reserva = $this->params['id_reserva'];
//        $id_filtro = $this->params['id_filtro'];
        extract($_POST, EXTR_SKIP);

        if ($filter == 0) {
            Doo::db()->loadModel("Reserve_Pago");
            $objeto = new Reserve_Pago();
        } else {
            Doo::db()->loadModel("Tours_Pago");
            $objeto = new Tours_Pago();
        }
        foreach ($pagos as $id) {
            $objeto->id = $id;            
            
//            print($id);
//            exit;
          
            
            //Reservas de transportacion////////////////////////////////////////////////////
            
            $sql1 = "SELECT pago AS PAGO, pagado AS PAGADO, tipo_pago AS TIPO_PAGO  FROM reservas_pago WHERE id = '$id'";
            $rs1 = Doo::db()->query($sql1);
            $pagado = $rs1->fetchAll();
//            print_r($pagado);
//            exit;
            foreach ($pagado as $pag){
                
                $metodo_pago = $pag['PAGO'];
                $pago = $pag['PAGADO'];
                $tipo_pago = $pag['TIPO_PAGO'];             
                
            }
            
//            print($pago);
//            exit();
            
            $sql = "SELECT id_reserva  FROM reservas_pago WHERE id = '$id'";
            $rs = Doo::db()->query($sql);
            $reserva = $rs->fetchAll();
//            print_r($reserva);
//            exit;
            foreach ($reserva as $id_reser){
                $idr = $id_reser['id_reserva'];
//                print($idr);
//                exit;
            }
            
            
            $sqlt = "SELECT totaltotal, paid_driver, pred_paid_amount, total_paid,  total_charge  FROM reservas WHERE id = '$idr' AND id_tours ='-1'";
            $rst= Doo::db()->query($sqlt);
            $rtot = $rst->fetchAll();
//            print_r($reserva);
//            exit;
            foreach ($rtot as $rt){
                
                $totaltotal1 = $rt['totaltotal'];
                $totaltotal = number_format($totaltotal1, 2, '.', '');
                
                $pre_paid_amount1 = $rt['pred_paid_amount'];
                $pre_paid_amount = number_format($pre_paid_amount1, 2, '.', '');
                
                $paid_driver1 = $rt['paid_driver'];
                $paid_driver = number_format($paid_driver1, 2, '.', '');
                
                $totalpaid1 = $rt['total_paid'];
                $totalpaid = number_format($totalpaid1, 2, '.', '');
                
                $total_charge1 = $rt['total_charge'];
                $total_charge = number_format($total_charge1, 2, '.', '');
                
                //$ttotal = $totaltotal - $total_charge;
                $ttotal = number_format($totaltotal - $total_charge, 2, '.', '');
                
                $tpaid = $totalpaid - $pago;
                $tpaid_prepaid = $pre_paid_amount - $pago;
                $tpaid_driver = $paid_driver - $pago;
                
                
                $pago_porc1 = ($pago) -($pago/1.04);
                $pago_porc = number_format($pago_porc1, 2, '.', '');
                
                $tcharge = $total_charge - $pago_porc;
                
                
                $ttotalcash = $totaltotal + $total_charge;
                $ttotalprepaid = $totaltotal - $total_charge;
                
                $passengerbaldue = number_format($ttotal, 2, '.', '');
                $passbaldue_prepaid = $ttotal;   
                $passbaldue_paid_driver = number_format($ttotal - $paid_driver, 2, '.', '');
                $agenbaldue_prepaid = $ttotal - $paid_driver;
//                print($agenbaldue_prepaid);
//                exit;
                $total_prepaid = $totaltotal - $pre_paid_amount;
                                
                
            }
            
            $sqlra = "SELECT paid_full  FROM reservas_agency WHERE id_reservas = '$idr' " ;
            $rsra= Doo::db()->query($sqlra);
            $rsag = $rsra->fetchAll();
            
            foreach ($rsag as $ra){
                
                $paid_fulle = $ra['paid_full'];
                $paid_full = number_format($paid_fulle, 2, '.', '');
                
                
                $paid_pag = $paid_full - $pago;
                
                
            }
       
             
            if($filter == 1){
                $objeto->tipo = "MULTI";
                
                    //Reservas de Multiday Tours//////////////////////////////////////////////////////////

                $sqltour = "SELECT pagado, tipo_pago, pago, pagado  FROM tours_pago WHERE id = $id AND tipo ='MULTI'";
                $rstour = Doo::db()->query($sqltour);
                $pagadotour = $rstour->fetchAll();

                foreach ($pagadotour as $pagtour){
                    $pagotour = $pagtour['pagado'];
                    $metodo_pagotour = $pagtour['pago'];
                    $pagado_multi = $pagtour['pagado'];
                    $tipo_pagotour = $pagtour['tipo_pago'];

                }

//                print($tipo_pagotour);
//                print("**");
//                print($modo_pago_multi);
//                exit;
                
                $sqltp = "SELECT id_tours  FROM tours_pago WHERE id = $id AND tipo ='MULTI'";
                $rstp = Doo::db()->query($sqltp);
                $res_tour = $rstp->fetchAll();
    //            print_r($reserva);
    //            exit;
                foreach ($res_tour as $id_tour){
                    $idtours = $id_tour['id_tours'];
//                    print($idtours);
//                    exit;
                }

                $sqlmulti = "SELECT total, paid_driver, pred_paid_amount, total_paid,  total_charge  FROM tours WHERE id = '$idtours'" ;
                $rsmulti= Doo::db()->query($sqlmulti);
                $rmulti = $rsmulti->fetchAll();

                foreach ($rmulti as $multiday){

                    $total_multi1 = $multiday['total'];
                    $total_multi = number_format($total_multi1, 2, '.', '');
                    
                    
                    
                    $pre_paid_amount_multi1 = $multiday['pred_paid_amount'];
                    $pre_paid_amount_multi = number_format($pre_paid_amount_multi1, 2, '.', '');

                    $paid_driver_multi1 = $multiday['paid_driver'];
                    $paid_driver_multi = number_format($paid_driver_multi1, 2, '.', '');

                    $totalpaid_multi1 = $multiday['total_paid'];
                    $totalpaid_multi = number_format($totalpaid_multi1, 2, '.', '');

                    $total_charge_multi1 = $multiday['total_charge'];
                    $total_charge_multi = number_format($total_charge_multi1, 2, '.', '');

                    //$ttotal_multi1 = $total_multi - $total_charge_multi;    
                    $ttotal_multi = number_format($total_multi - $total_charge_multi, 2, '.', '');
                    
//                    print($ttotal_multi);
//                    exit;

                    $tpaid_multi = $totalpaid_multi - $pagado_multi;
                    
                    
                    $tpaid_prepaid_multi = $pre_paid_amount_multi - $pagado_multi;
                    $tpaid_driver_multi = $paid_driver_multi - $pagado_multi;
                    
                    $tprepaidcharge = $pre_paid_amount_multi - $total_charge_multi;

                    $pago_porc_multi1 = ($pagado_multi) -($pagado_multi/1.04);
                    $pago_porc_multi = number_format($pago_porc_multi1, 2, '.', '');

                    $tcharge_multi = $total_charge_multi - $pago_porc_multi;


                    $ttotalcash_multi = $total_multi + $total_charge_multi;
                    $ttotalprepaid_multi = $total_multi - $total_charge_multi;
                    $passengerbaldue_multi = number_format($ttotal_multi, 2, '.', '');
                    
//                    print($passengerbaldue_multi);
//                    exit;
                    
                    $passbaldue_prepaid_multi = $ttotal_multi;
                    $passbaldue_paid_driver_multi = number_format($ttotal_multi - $paid_driver_multi, 2, '.', '');
                                        
//                    print($passbaldue_paid_driver);
//                    exit;
                    
                    $agenbaldue_prepaid_multi = $ttotal_multi - $paid_driver_multi;
                    
                    $total_prepaid_multi = $total_multi - $pre_paid_amount_multi;
                    $tpassenger_balance_due = $ttotal_multi - $pre_paid_amount_multi;


                }

                $sqltag = "SELECT totalouta  FROM tours_agency WHERE id_tours = '$idtours' AND type_tour ='MULTI'" ;
                $rstag= Doo::db()->query($sqltag);
                $rsagen = $rstag->fetchAll();

                foreach ($rsagen as $ragen){

                    $paid_fulle_multi = $ragen['totalouta'];
                    $paid_full_multi = number_format($paid_fulle_multi, 2, '.', '');


                    $paid_pag_multi = $paid_full_multi - $pagado_multi;
                    



                }

            }else if($filter == 2){
                
                
                $objeto->tipo = "ONE";            
                
                    //Reservas de OnedayTour//////////////////////////////////////////////////////////

                $sqlone1 = "SELECT pagado, tipo_pago, pago, pagado  FROM tours_pago WHERE id = $id AND tipo ='ONE'";
                $rsone1 = Doo::db()->query($sqlone1);
                $pagadoone = $rsone1->fetchAll();

                foreach ($pagadoone as $pagone){
                    $pago_one = $pagone['pagado'];
                    $metodo_pago_one = $pagone['pago'];
                    $pagado_one = $pagone['pagado'];
                    $tipo_pago_one = $pagone['tipo_pago'];
                    
                    
                }
                
//                print($pagado_one);
//                exit;

                $sqlop = "SELECT id_tours  FROM tours_pago WHERE id = $id AND tipo ='ONE'";
                $rsop = Doo::db()->query($sqlop);
                $res_one = $rsop->fetchAll();
    //            print_r($reserva);
    //            exit;
                foreach ($res_one as $id_one){
                    $id_oneday = $id_one['id_tours'];
//                    print($idtours);
//                    exit;
                }

                $sqlone = "SELECT total, paid_driver, pred_paid_amount, total_paid,  total_charge  FROM tours_oneday WHERE id = '$id_oneday'" ;
                $rsone= Doo::db()->query($sqlone);
                $rone = $rsone->fetchAll();

                foreach ($rone as $oneday){

                    $total_one1 = $oneday['total'];
                    $total_one = number_format($total_one1, 2, '.', '');
                    
                    
                    $pre_paid_amount_one1 = $oneday['pred_paid_amount'];
                    $pre_paid_amount_one = number_format($pre_paid_amount_one1, 2, '.', '');

                    $paid_driver_one1 = $oneday['paid_driver'];
                    $paid_driver_one = number_format($paid_driver_one1, 2, '.', '');

                    $totalpaid_one1 = $oneday['total_paid'];
                    $totalpaid_one = number_format($totalpaid_one1, 2, '.', '');

                    $total_charge_one1 = $oneday['total_charge'];
                    $total_charge_one = number_format($total_charge_one1, 2, '.', '');

                    //$ttotal_one = $total_one - $total_charge_one;
                    $ttotal_one = number_format($total_one - $total_charge_one, 2, '.', '');
                   

                    $tpaid_one = $totalpaid_one - $pagado_one;
                    
//                    print($tpaid_multi);
//                    exit;
                    $tpaid_prepaid_one = $pre_paid_amount_one - $pagado_one;
                    $tpaid_driver_one = $paid_driver_one - $pagado_one;


                    $pago_porc_one1 = ($pagado_one) -($pagado_one/1.04);
                    $pago_porc_one = number_format($pago_porc_one1, 2, '.', '');
                    
                    $ttotal_one_prepaid = number_format($total_one - $pago_porc_one, 2, '.', '');
                    $ttotal_one_pdp = number_format($total_one - $pago_porc_one, 2, '.', '');
                    
                   

                    $tcharge_one = $total_charge_one - $pago_porc_one;


                    $ttotalcash_one = $total_one + $total_charge_one;
                    $ttotalprepaid_one = $total_one - $total_charge_one;                    
                    $passengerbaldue_one = number_format($ttotal_one, 2, '.', '');
                    
                    $passbaldue_prepaid_one = $ttotal_one_prepaid - $tpaid_prepaid_one;
                    
                    $passbaldue_paid_driver_one = number_format($ttotal_one - $paid_driver_one, 2, '.', '');
                    $agenbaldue_prepaid_one = $ttotal_one_prepaid - $paid_driver_one - $tpaid_prepaid_one;
    //                print($agenbaldue_prepaid);
    //                exit;
                    $total_prepaid_one = $total_one - $pre_paid_amount_one;
                    $tpassenger_balance_due_one = $ttotal_one - $pre_paid_amount_one;

                    
                    $tprepaid_one = number_format(($pre_paid_amount_one) - ($pre_paid_amount_one/1.04), 2, '.', '');
                    $tprepaid_cash = number_format(($pre_paid_amount_one) - ($pagado_one), 2, '.', '');
                    $ttotal_prepaid_one = number_format($total_one - $tprepaid_one, 2, '.', '');
                    
                    $tcollectonboardcc_one = number_format(($paid_driver_one) - ($paid_driver_one/1.04), 2, '.', '');
                    
                    $ttotal_collectonboard_one = number_format($total_one - $tcollectonboardcc_one, 2, '.', '');
                    
                    $passbaldue_prep_one = number_format($ttotal_prepaid_one - $paid_driver_one, 2, '.', '');
                    $agenbaldue_prep_one = number_format($ttotal_prepaid_one - $paid_driver_one, 2, '.', '');
                    
                   

                }

                $sqltagone = "SELECT totalouta  FROM tours_agency WHERE id_tours = '$id_oneday' AND type_tour ='ONE'" ;
                $rstagone= Doo::db()->query($sqltagone);
                $rsagenone = $rstagone->fetchAll();

                foreach ($rsagenone as $ragenone){

                    $paid_fulle_one = $ragenone['totalouta'];
                    $paid_full_one = number_format($paid_fulle_one, 2, '.', '');


                    $paid_pag_one = $paid_full_one - $pagado_one;
                    

                }         
                
                

            }                  
            

            if($filter == 0){ //PAGOS TRASPORTACION
                
//                  echo($tipo_pago);
//                  exit();
                 
                if($paid_driver == '0.00' && $pre_paid_amount > '0.00'){
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CREDIT CARD WITH FEE'){
                        
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passbaldue_prepaid', agency_balance_due = '$ttotal', total_charge = '$tcharge', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CREDIT CARD NO FEE'){
                        
                         
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passengerbaldue', agency_balance_due = '$ttotal', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CASH'){
                        
                         
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passengerbaldue', agency_balance_due = '$ttotal', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CHECK'){
                        
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passengerbaldue', agency_balance_due = '$ttotal', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto); 
                        
                    }
                }
                
                if($paid_driver > '0.00' && $pre_paid_amount == '0.00'){
                    
                                        
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CASH'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$totaltotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($totaltotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($totaltotal-$pre_paid_amount),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CREDIT CARD WITH FEE'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($ttotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($ttotal-$pre_paid_amount), total_charge = '$tcharge', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CREDIT CARD NO FEE'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$totaltotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($totaltotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($totaltotal-$pre_paid_amount),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CHECK'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$totaltotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($totaltotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($totaltotal-$pre_paid_amount),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                }
                
                if($paid_driver > '0.00' && $pre_paid_amount > '0.00'){
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CASH'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$totaltotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($totaltotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($totaltotal-$pre_paid_amount),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CASH'){
                        
                         
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passengerbaldue', agency_balance_due = '$ttotal', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CREDIT CARD WITH FEE'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($ttotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($ttotal-$pre_paid_amount), total_charge = '$tcharge', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CREDIT CARD WITH FEE'){
                        
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passbaldue_prepaid', agency_balance_due = '$ttotal', total_charge = '$tcharge', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CREDIT CARD NO FEE'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$totaltotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($totaltotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($totaltotal-$pre_paid_amount),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CREDIT CARD NO FEE'){
                        
                         
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passengerbaldue', agency_balance_due = '$ttotal', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago == 'COLLECT ON BOARD' && $tipo_pago == 'CHECK'){
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$totaltotal', paid_driver = '$tpaid_driver', passenger_balance_due = ($totaltotal - $pre_paid_amount), paid_driver = '$tpaid_driver', total_paid = '$tpaid', agency_balance_due = ($totaltotal-$pre_paid_amount),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idr' AND id_tours ='-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago == 'PRED-PAID' && $tipo_pago == 'CHECK'){
                        
                        
                        Doo::db()->query("UPDATE reservas SET totaltotal = '$ttotal', paid_driver = '$paid_driver', pred_paid_amount = '$tpaid_prepaid', total_paid = '$tpaid', passenger_balance_due = '$passengerbaldue', agency_balance_due = '$ttotal', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idr' AND id_tours = '-1'");
                        Doo::db()->query("UPDATE reservas_agency SET paid_full = '$paid_pag', agency_fee = '0.00', comision = '0.00'  WHERE id_reservas ='$idr'");
                        Doo::db()->delete($objeto); 
                        
                    }
                    
                    
                }
                
                echo '<script>
                    alert("Pago Eliminado... <<< los resultados se cargaran en breve... >>>");
                    window.close("admin/pagos/cancelando/new","","");                
                    window.open("../../reservas/edit/'. $idr .'","RESERVAS","");   
                    exit;
                  </script>';
                
            }else if($filter == 1){//PAGOS MULTIDAY TOURS
                  
//                  print($metodo_pagotour);                  
//                  print(" ");
//                  print($tipo_pagotour);
//                  
//                  exit;
                  
                  if($paid_driver_multi == '0.00' && $pre_paid_amount_multi > '0.00'){
                    
                    if($metodo_pagotour == 'CREDIT CARD WITH FEE'){
                       
                        Doo::db()->query("UPDATE tours SET total = '$ttotal_multi', totalouta = '$ttotal_multi', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_multi', total_paid = '$tpaid_multi', passenger_balance_due = '$passbaldue_prepaid_multi', agency_balance_due = '$ttotal_multi', total_charge = '$tcharge_multi', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours = '$idtours' AND type_tour = 'MULTI'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    if($metodo_pagotour == 'CREDIT CARD NO FEE'){
                        
                        
                        Doo::db()->query("UPDATE tours SET total = '$ttotal_multi', totalouta = '$ttotal_multi', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_multi', total_paid = '$tpaid_multi', passenger_balance_due = '$passengerbaldue_multi', agency_balance_due = '$ttotal_multi', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours = '$idtours' AND type_tour = 'MULTI'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    if($metodo_pagotour == 'CASH' && $tipo_pagotour == 'PRED-PAID'){                        
                        
                        Doo::db()->query("UPDATE tours SET total = '$ttotal_multi', totalouta = '$ttotal_multi', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_multi', total_paid = '$tpaid_multi', passenger_balance_due = '$passengerbaldue_multi', agency_balance_due = '$ttotal_multi', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    
                    
                    
                    
                    if($metodo_pagotour == 'CHECK'){
                        
                        
                        Doo::db()->query("UPDATE tours SET total = '$ttotal_multi', totalouta = '$ttotal_multi', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_multi', total_paid = '$tpaid_multi', passenger_balance_due = '$passengerbaldue_multi', agency_balance_due = '$ttotal_multi', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto); 
                    }
                }
                
                if($paid_driver_multi > '0.00' && $pre_paid_amount_multi == '0.00'){
                    
                    if($metodo_pagotour == 'CASH' && $tipo_pagotour == 'COLLECT ON BOARD'){
                        
                        Doo::db()->query("UPDATE tours SET total = '$total_multi', totalouta = '$total_multi', paid_driver = '$tpaid_driver_multi', passenger_balance_due = ($total_multi - $pre_paid_amount_multi), paid_driver = '$tpaid_driver_multi', total_paid = '$tpaid_multi', agency_balance_due = ($total_multi-$pre_paid_amount_multi),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    
                    
                    
                    if($metodo_pagotour == 'CREDIT CARD WITH FEE'){
                        
                        
                        Doo::db()->query("UPDATE tours SET total = '$ttotal_multi', totalouta = '$ttotal_multi', paid_driver = '$tpaid_driver_multi', passenger_balance_due = ($ttotal_multi - $pre_paid_amount_multi), paid_driver = '$tpaid_driver_multi', total_paid = '$tpaid_multi', agency_balance_due = ($ttotal_multi-$pre_paid_amount_multi), total_charge = '$tcharge_multi', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pagotour == 'CREDIT CARD NO FEE'){
                        
                        Doo::db()->query("UPDATE tours SET total = '$total_multi', totalouta = '$total_multi', paid_driver = '$tpaid_driver_multi', passenger_balance_due = ($total_multi - $pre_paid_amount_multi), paid_driver = '$tpaid_driver_multi', total_paid = '$tpaid_multi', agency_balance_due = ($total_multi-$pre_paid_amount_multi),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pagotour == 'CHECK'){
                        
                        Doo::db()->query("UPDATE tours SET total = '$total_multi', totalouta = '$total_multi', paid_driver = '$tpaid_driver_multi', passenger_balance_due = ($total_multi - $pre_paid_amount_multi), paid_driver = '$tpaid_driver_multi', total_paid = '$tpaid_multi', agency_balance_due = ($total_multi-$pre_paid_amount_multi),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    
                }
                
                //////////////////////seguir en revision
                
                if($paid_driver_multi > '0.00' && $pre_paid_amount_multi > '0.00'){
                    
                    
                                        
                    if($metodo_pagotour == 'CREDIT CARD NO FEE'){
                        
                        
                        Doo::db()->query("UPDATE tours SET total = $total_multi, totalouta = $total_multi, paid_driver = $tpaid_driver_multi, pred_paid_amount = $pre_paid_amount_multi, passenger_balance_due = ($total_multi - $pre_paid_amount_multi), total_paid = $pre_paid_amount_multi, agency_balance_due = ($total_multi-$pre_paid_amount_multi), tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    //***********************************************************************
                    if($metodo_pagotour == 'CASH' && $tipo_pagotour == 'COLLECT ON BOARD'){
                        
                        
                        Doo::db()->query("UPDATE tours SET total = $total_multi, totalouta = $total_multi, paid_driver = $tpaid_driver_multi, pred_paid_amount = $pre_paid_amount_multi, passenger_balance_due = ($total_multi - $pre_paid_amount_multi), total_paid = $pre_paid_amount_multi, agency_balance_due = ($total_multi-$pre_paid_amount_multi), tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pagotour == 'CASH' && $tipo_pagotour == 'PRED-PAID'){                        
                        
                        Doo::db()->query("UPDATE tours SET total = '$ttotal_multi', totalouta = '$ttotal_multi', paid_driver = '$paid_driver_multi', pred_paid_amount = '$tpaid_prepaid_multi', total_paid = '$tpaid_multi', passenger_balance_due = '$passbaldue_paid_driver_multi', agency_balance_due = '$agenbaldue_prepaid_multi', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto); 
                    }
                    //**********************************************************************
                    
                    if($metodo_pagotour == 'CHECK'){
                        
                        
                        Doo::db()->query("UPDATE tours SET total = '$total_multi', totalouta = '$total_multi', paid_driver = '$tpaid_driver_multi', pred_paid_amount = '$pre_paid_amount_multi', passenger_balance_due = ($total_multi - $pre_paid_amount_multi), total_paid = '$pre_paid_amount_multi', agency_balance_due = ($total_multi-$pre_paid_amount_multi), tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pagotour == 'CREDIT CARD WITH FEE'){
                        
                             
                        
                        Doo::db()->query("UPDATE tours SET total = '$ttotalprepaid_multi', totalouta = '$ttotalprepaid_multi', paid_driver = '$paid_driver_multi', passenger_balance_due = $passbaldue_paid_driver_multi, pred_paid_amount = '$tpaid_prepaid_multi', total_paid = '$total_prepaid_multi', total_charge = '$tcharge_multi', agency_balance_due ='$agenbaldue_prepaid_multi',  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$idtours'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_multi', total = '$ttotal_multi'  WHERE id_tours ='$idtours' AND type_tour ='MULTI'");
                        Doo::db()->delete($objeto);
                        
                        
                    }
                    
                }
                
//                echo '<script>
//                    /*alert("Pago Eliminado... <<< los resultados se cargaran en breve... >>>");*/
//                    window.close("admin/pagos/cancelando/new","","");                
//                    window.open("../../tours/edit/'. $idtours .'","MULTIDAY","");             
//                  </script>';
                
                
                
            }else if($filter == 2){//PAGOS ONEDAY TOUR
                
                               
                if($paid_driver_one == '0.00' && $pre_paid_amount_one > '0.00'){
                    
                    if($metodo_pago_one == 'CREDIT CARD WITH FEE' && $tipo_pago_one == 'PRED-PAID'){
                       
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one_prepaid', totalouta = '$ttotal_one_prepaid', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passbaldue_prepaid_one', agency_balance_due = '$agenbaldue_prepaid_one', total_charge = '$tcharge_one', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one_prepaid', total = '$ttotal_one_prepaid'  WHERE id_tours = '$id_oneday' AND type_tour = 'ONE'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    if($metodo_pago_one == 'CREDIT CARD NO FEE' && $tipo_pago_one == 'PRED-PAID'){
                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one', totalouta = '$ttotal_one', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passengerbaldue_one', agency_balance_due = '$ttotal_one', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours = '$id_oneday' AND type_tour = 'ONE'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    if($metodo_pago_one == 'CASH' && $tipo_pago_one == 'PRED-PAID'){                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$total_one', totalouta = '$total_one', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passengerbaldue_one', agency_balance_due = '$ttotal_one', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$total_one', total = '$total_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    if($metodo_pago_one == 'CHECK' && $tipo_pago_one == 'PRED-PAID'){
                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one', totalouta = '$ttotal_one', paid_driver = '0.00', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passengerbaldue_one', agency_balance_due = '$ttotal_one', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto); 
                    }
                    
                }
                
                if($paid_driver_one > '0.00' && $pre_paid_amount_one == '0.00'){
                    
                    if($metodo_pago_one == 'CASH' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$total_one', totalouta = '$total_one', paid_driver = '$tpaid_driver_one', passenger_balance_due = ($total_one - $tpaid_driver_one), paid_driver = '$tpaid_driver_one', total_paid = '$tpaid_one', agency_balance_due = ($total_one-$tpaid_one),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago_one == 'CREDIT CARD WITH FEE' && $tipo_pago_one == 'COLLECT ON BOARD'){
                                                
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one_pdp', totalouta = '$ttotal_one_pdp', paid_driver = '$tpaid_driver_one', passenger_balance_due = ($ttotal_one_pdp - $tpaid_driver_one), paid_driver = '$tpaid_driver_one', total_paid = '$tpaid_one', agency_balance_due = ($ttotal_one_pdp-$tpaid_one), total_charge = '$tcharge_one', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one_pdp', total = '$ttotal_one_pdp'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago_one == 'CREDIT CARD NO FEE' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$total_one', totalouta = '$total_one', paid_driver = '$tpaid_driver_one', passenger_balance_due = ($total_one - $tpaid_driver_one), paid_driver = '$tpaid_driver_one', total_paid = '$tpaid_one', agency_balance_due = ($total_one-$tpaid_one),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago_one == 'CHECK' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$total_one', totalouta = '$total_one', paid_driver = '$tpaid_driver_one', passenger_balance_due = ($total_one - $tpaid_driver_one), paid_driver = '$tpaid_driver_one', total_paid = '$tpaid_one', agency_balance_due = ($total_one-$tpaid_one),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                    }
                    
                }
                
                
                
                if($paid_driver_one > '0.00' && $pre_paid_amount_one > '0.00'){
                    
                    
                                        
                    if($metodo_pago_one == 'CREDIT CARD NO FEE' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = $total_one, totalouta = $total_one, paid_driver = $tpaid_driver_one, pred_paid_amount = $pre_paid_amount_one, passenger_balance_due = ($total_one - $pre_paid_amount_one), total_paid = $pre_paid_amount_one, agency_balance_due = ($total_one-$pre_paid_amount_one), tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                        
                    }
                    
                    if($metodo_pago_one == 'CREDIT CARD NO FEE' && $tipo_pago_one == 'PRED-PAID'){                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one', totalouta = '$ttotal_one', paid_driver = '$paid_driver_one', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passbaldue_paid_driver_one', agency_balance_due = '$agenbaldue_prepaid_one', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto); 
                    }

                    
                   
                    if($metodo_pago_one == 'CASH' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = $total_one, totalouta = $total_one, paid_driver = $tpaid_driver_one, pred_paid_amount = $pre_paid_amount_one, passenger_balance_due = ($total_one - $pre_paid_amount_one), total_paid = $pre_paid_amount_one, agency_balance_due = ($total_one-$pre_paid_amount_one), tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago_one == 'CASH' && $tipo_pago_one == 'PRED-PAID'){                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one', totalouta = '$ttotal_one', paid_driver = '$paid_driver_one', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passbaldue_paid_driver_one', agency_balance_due = '$agenbaldue_prepaid_one', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto); 
                    }
                   
                    
                    if($metodo_pago_one == 'CHECK' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = $total_one, totalouta = $total_one, paid_driver = $tpaid_driver_one, pred_paid_amount = $pre_paid_amount_one, passenger_balance_due = ($total_one - $pre_paid_amount_one), total_paid = $pre_paid_amount_one, agency_balance_due = ($total_one-$pre_paid_amount_one), tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                    }
                    
                    if($metodo_pago_one == 'CHECK' && $tipo_pago_one == 'PRED-PAID'){                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_one', totalouta = '$ttotal_one', paid_driver = '$paid_driver_one', pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$tpaid_one', passenger_balance_due = '$passbaldue_paid_driver_one', agency_balance_due = '$agenbaldue_prepaid_one', total_charge = '0.00', tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8' WHERE id = '$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_one', total = '$ttotal_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto); 
                    }
                    
                    
                    if($metodo_pago_one == 'CREDIT CARD WITH FEE' && $tipo_pago_one == 'COLLECT ON BOARD'){
                        

                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_collectonboard_one', totalouta = '$ttotal_collectonboard_one', paid_driver = ($paid_driver_one - $pagado_one), passenger_balance_due = ($ttotal_collectonboard_one - $pre_paid_amount_one) , pred_paid_amount = '$pre_paid_amount_one', total_paid = '$pre_paid_amount_one', total_charge = ($total_charge_one - $tcollectonboardcc_one), agency_balance_due =($ttotal_collectonboard_one - $pre_paid_amount_one),  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_collectonboard_one', total = '$ttotal_collectonboard_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);                        
                        
                    }
                    
                    if($metodo_pago_one == 'CREDIT CARD WITH FEE' && $tipo_pago_one == 'PRED-PAID'){
                        
                        
                        Doo::db()->query("UPDATE tours_oneday SET total = '$ttotal_prepaid_one', totalouta = '$ttotal_prepaid_one', paid_driver = '$paid_driver_one', passenger_balance_due = $passbaldue_prep_one, pred_paid_amount = '$tpaid_prepaid_one', total_paid = '$total_prepaid_one', total_charge = '$tcharge_one', agency_balance_due ='$agenbaldue_prep_one',  tipo_pago = 'COLLECT ON BOARD', pago = 'CREDIT CARD NO FEE-FULL', op_pago= '8', op_pago_conductor = '8'  WHERE id ='$id_oneday'");
                        Doo::db()->query("UPDATE tours_agency SET totalouta = '$ttotal_prepaid_one', total = '$ttotal_prepaid_one'  WHERE id_tours ='$id_oneday' AND type_tour ='ONE'");
                        Doo::db()->delete($objeto);
                        
                        
                    }                   
                                        
                } 
                
//                echo '<script>
//                    /*alert("Pago Eliminado... <<< los resultados se cargaran en breve... >>>");*/
//                    window.close("admin/pagos/cancelando/new","","");                
//                    window.open("../../onedaytour/edit/'. $id_oneday .'","ONEDAY","");             
//                    </script>';
                
                
            }
            
        }

        if($filter == 0){
            echo '<script>
                    /*alert("Pago Eliminado... <<< los resultados se cargaran en breve... >>>");*/
                    window.close("admin/pagos/cancelando/new","","");                
                    window.open("../../reservas/edit/'. $idr .'","RESERVAS","");             
                  </script>';
        }
        
        if($filter == 1){
            echo '<script>
                    /*alert("Pago Eliminado... <<< los resultados se cargaran en breve... >>>");*/
                    window.close("admin/pagos/cancelando/new","","");                
                    window.open("../../tours/edit/'. $idtours .'","MULTIDAYSAVE","");             
                  </script>';
        }
        
        if($filter == 2){
            echo '<script>
                    alert("Pago Eliminado... <<< Haga click en Aceptar para hacer efectivos los cambios... >>>");
                    /*confirm("Desea Eliminar este Pago?");*/
                    window.close("admin/pagos/cancelando/new","","");                      
                    window.open("../../onedaytour/edit/'. $id_oneday .'","ONEDAYSAVE","");        
                   
                  </script>';
        }
        
    }

    public function generar_pago() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'pagos/pagos.php';
        if (!isset($this->params['id'])) {
            $this->renderc('admin/index', $this->data, true);
        } else {
            $this->data['preload'] = true;
            $this->data['id'] = $this->params['id'];
            Doo::loadModel('Agency');
            $ag = new Agency();
            $ag->id = $this->params['id'];
            $ag = Doo::db()->getOne($ag);
            $this->data['agency'] = $ag;
            $this->renderc('admin/index', $this->data, true);
        }
    }

    public function loadagency() {
        $id = $this->params['id'];
        $sql = 'select company_name, phone1, manager from agencia where id = ?';
        $q = Doo::db()->query($sql, array($id));
        $rs = $q->fetchAll();
        echo json_encode($rs);
    }

    public function get_invoicesa() {
        Doo::loadModel('Factura');
        $id = $this->params['id'];
        $sql = "SELECT f.id,f.creation_date,f.total,f.subtotal,IFNULL(p.descuento,0) as descuento,IFNULL(p.por_descuento,0) as pdescuento, IFNULL(p.monto,0) as monto, (f.subtotal - f.collect) as balance, IFNULL(p.fecha,'') as fecha, IFNULL(p.adjunto,'#') as url FROM factura AS f LEFT JOIN pagos AS p ON (p.factura = f.id)
        where f.id_agency = ? AND (f.estado = ? OR f.estado = ?)";
        $rs = Doo::db()->query($sql, array($id, 'UNPAID', 'COMISION'));
        $facturas = $rs->fetchAll();
        /* print_r(Doo::db()->showSQL());
          exit; */
        $output = '';
        foreach ($facturas as $factura) {

            $output.='<tr>
                      <td><input type="radio" id="' . $factura['id'] . '" value="' . $factura['id'] . '" name="factura" /></td>
                      <td>' . str_pad($factura['id'], 8, '0', STR_PAD_LEFT) . '</td>
                      <td><a href="' . Doo::conf()->APP_URL . 'admin/facturacion/genpdf/' . $factura['id'] . '">
                            <img class="pdficon" src="http://localhost/supertours/global/img/pdf.png">
                          </a></td>
                      <td> ' . (($factura['descuento'] > 0) ? '$' . $factura['descuento'] : '') . '<br>' . (($factura['pdescuento'] > 0) ? '% -' . $factura['pdescuento'] : '') . '</td>
                      <td>' . $factura['creation_date'] . '</td>
                      <td>' . $factura['total'] . '<br>' . $factura['subtotal'] . '</td>
                      <td>' . $factura['balance'] . '
                            <input type="hidden" name="balance-' . $factura['id'] . '" id="balance-' . $factura['id'] . '" value="' . $factura['balance'] . '" /></td>
                      <td>' . $factura['monto'] . '</td>
                      <td>' . $factura['fecha'] . '</td>
                      <td>' . (($factura['url'] == "#") ? 'No Att.' : '<a href="' . Doo::conf()->APP_URL . $factura['url'] . '" class="box"><img class="details" src = "' . Doo::conf()->APP_URL . 'global/img/details.png"/></a>') . '</td>
                      </tr>';
        }
        echo $output;
    }

    public function get_paid_invoicesa() {
        Doo::loadModel('Factura');
        $id = $this->params['id'];
        $sql = "SELECT f.id,f.creation_date,f.total,f.subtotal,IFNULL(p.descuento,0) as descuento,IFNULL(p.por_descuento,0) as pdescuento, IFNULL(p.monto,0) as monto, (f.total - f.collect) as balance, IFNULL(p.fecha,'') as fecha, IFNULL(p.adjunto,'#') as url FROM factura AS f LEFT JOIN pagos AS p ON (p.factura = f.id)
        where f.id_agency = ? AND f.estado = ?";
        $rs = Doo::db()->query($sql, array($id, 'PAID'));
        $facturas = $rs->fetchAll();
        //echo json_encode($facturas);
        $output = '';
        foreach ($facturas as $factura) {

            $output.='<tr>
                      <td>' . str_pad($factura['id'], 8, '0', STR_PAD_LEFT) . '</td>
                      <td> ' . (($factura['descuento'] > 0) ? '$' . $factura['descuento'] : '') . '<br>' . (($factura['pdescuento'] > 0) ? '% -' . $factura['pdescuento'] : '') . '</td>
                      <td>' . $factura['creation_date'] . '</td>
                      <td> s: ' . $factura['subtotal'] . '<br> T: ' . $factura['total'] . '</td>
                      <td>' . $factura['monto'] . '</td>
                      <td>' . $factura['fecha'] . '</td>
                      <td><a href="' . Doo::conf()->APP_URL . 'admin/facturacion/genpdf/' . $factura['id'] . '"><img src="' . Doo::conf()->APP_URL . 'global/img/pdf.png" class="pdficon" /></a></td>
                      <td>' . (($factura['url'] == "#") ? 'No Att.' : '<a href="' . Doo::conf()->APP_URL . $factura['url'] . '" class="box"><img class="details" src = "' . Doo::conf()->APP_URL . 'global/img/details.png"/></a>') . '</td>
                      </tr>';
        }
        echo $output;
    }

    public function realizar_pago() {
        try {
            Doo::db()->beginTransaction();

            Doo::loadModel('Pago');
            Doo::loadModel('Factura');
            $id_factura = $_POST['factura'];
            $factura = new Factura();
            $factura->id = $id_factura;
            $factura = Doo::db()->getOne($factura);
            $pago = new Pago();
            $pago->factura = $id_factura;
            $pago->transnu = $_POST['check-nu'];
            $pago->descuento = $_POST['discount'];
            $pago->per_descuento = $_POST['perdiscount'];
            $pago->monto = $_POST['ammount'];
            $pago->fecha = date('Y-m-d H:m:s');
            $df = new DooFile();
            $file = $df->upload(Doo::conf()->FILE_DIR . '/global/uploads/', 'attach', 'att_' . $id_factura . '-' . $pago->fecha . date('Hms'));
            if (isset($file)) {
                $pago->adjunto = 'global/uploads/' . $file;
            }
            $pago->insert();
            $balance = $_POST['balance-' . $factura->id];
            $factura->collect = ($factura->collect) + ($pago->monto) + ($pago->descuento) + ($pago->per_descuento * $balance);

            $factura->update();

            if ($factura->collect >= $factura->subtotal) {
                $factura->estado = "PAID";
                $factura->total = ($factura->subtotal) - ($factura->collect);
                $factura->update();
            } else {
                $factura->update();
            }
            Doo::db()->commit();
            return Doo::conf()->APP_URL . 'admin/pagos/' . $factura->id_agency;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function supertours_sales() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'pagos/ventas.php';
        $this->renderc('admin/index', $this->data);
    }

    public function get_invoicessu() {

        Doo::loadModel('Factura');
        $id = -1;
        $sql = "SELECT f.id,f.creation_date,f.total,f.subtotal,IFNULL(p.descuento,0) as descuento,IFNULL(p.por_descuento,0) as pdescuento, IFNULL(p.monto,0) as monto, (f.total - f.collect) as balance, IFNULL(p.fecha,'') as fecha, IFNULL(p.adjunto,'#') as url FROM factura AS f LEFT JOIN pagos AS p ON (p.factura = f.id)
        where f.id_agency = ? AND f.estado = ? order by f.id DESC";
        $rs = Doo::db()->query($sql, array($id, 'PAID'));
        $facturas = $rs->fetchAll();
        //echo json_encode($facturas);
        $output = '';
        foreach ($facturas as $factura) {

            $output.='<tr>
                      <td>' . str_pad($factura['id'], 8, '0', STR_PAD_LEFT) . '</td>
                      <td> ' . (($factura['descuento'] > 0) ? '$' . $factura['descuento'] : '') . '<br>' . (($factura['pdescuento'] > 0) ? '% -' . $factura['pdescuento'] : '') . '</td>
                      <td>' . $factura['creation_date'] . '</td>
                      <td> s: ' . $factura['subtotal'] . '<br> T: ' . $factura['total'] . '</td>
                      <td>' . $factura['monto'] . '</td>
                      <td>' . $factura['fecha'] . '</td>
                      <td><a href="' . Doo::conf()->APP_URL . 'admin/facturacion/genpdf/' . $factura['id'] . '"><img src="' . Doo::conf()->APP_URL . 'global/img/pdf.png" class="pdficon" /></a></td>
                      <td>' . (($factura['url'] == "#" || $factura['url'] == "online-paid") ? 'No Att.' : '<a href="' . Doo::conf()->APP_URL . $factura['url'] . '" class="box"><img class="details" src = "' . Doo::conf()->APP_URL . 'global/img/details.png"/></a>') . '</td>
                      </tr>';
        }
        echo $output;
    }

}
