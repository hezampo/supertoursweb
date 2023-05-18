<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/13/13
 * Time: 10:42 AM
 */

Doo::loadController('I18nController');
ob_start();
Doo::loadController('admin/ToursController');
Doo::loadModel('Clientes');
Doo::loadModel('Hoteles');
Doo::loadModel('Hotel_Reserves');
Doo::loadHelper('DooFile');
class ReportsController extends I18nController{

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function statement_report(){
        $id_agency = $this->params['id_agency'];
        $sql = "select f.id as factura, f.total, f.collect, p.fecha,IFNULL(p.monto,0) as monto from Factura as f left join Pagos as p on (f.id = p.factura) where f.estado = 'UNPAID' and f.id_agency = ?";
        $q = Doo::db()->query($sql, array($id_agency));
        $facturas = $q->fetchAll();
        Doo::loadModel('Agency');
        $agency = new Agency();
        $agency->id = $id_agency;
        $agency = Doo::db()->getOne($agency);
        $orden = array();
        //organizando
        foreach ($facturas as $statement){
            if(!isset($orden[$statement['factura']])){
                $input = array(
                    'consec'=>$statement['factura'],
                    'total' => $statement['total'],
                    'balance' => ($statement['total'] - $statement['collect']),
                    'avance' => $statement['collect'],
                    'pagos'=> array()
                );
                $orden[$statement['factura']] = $input;
                if($statement['monto'] != "0"){
                    array_push($orden[$statement['factura']]['pagos'],
                        array(
                            'fecha'=>substr($statement['fecha'],0,10),
                            'monto'=>$statement['monto'],
                        ));
                }
            }else{
                if($statement['monto'] != "0"){
                    array_push($orden[$statement['factura']]['pagos'],
                        array(
                            'fecha'=>substr($statement['fecha'],0,10),
                            'monto'=>$statement['monto'],
                        ));
                }
            }
        }
        //resultado
        $total = 0; //total facturas
        $totala = 0; //total abonado
        foreach($orden as $con => $factura){
            $total += intval($factura['total']);
            $totala += intval($factura['avance']);
        }
        $orden['abono'] = $totala;
        $orden['total'] = $total;
        $orden['topay'] = intval($total) - intval($totala);

        $html = '<head>
        <style>

            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:300px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">
                <h3>Statement Report</h3>
                <blockquote><h4>'.$agency->company_name.'</h4></blockquote>
            </div>
            </div>

        </div>
        <table>';
        foreach($orden as $con=>$factura){
            if($con != 'total' && $con!='abono' && $con !='topay'){
                $html.= '<tr class="borderon">
                    <th class="title" >Invoice #'.str_pad($con,8,'0',STR_PAD_LEFT).'</th>
                    <td class="totals borderon">Total Invoiced : '.$factura['total'].'</td>
                    </tr>';
                foreach($factura['pagos'] as $pagos){
                    $html.='<tr>
                                <td>
                                    <blockquote>Deposit date '.$pagos['fecha'].'</blockquote>
                                </td>
                                <td>
                                    <blockquote>Deposit Amount ('.$pagos['monto'].')</blockquote>
                                </td>
                            </tr>';
                }
                $html.='<tr>
                            <th>
                                Invoice Deposit :
                            </th>
                            <td class="totals" style="border-bottom: red solid 1px;">
                                '.$factura['avance'].'
                            </td>
                        </tr>
                        <tr>
                            <th> Invoice Due : </th>
                            <td class="totals">'.$factura['balance'].'</td>
                        </tr>';
            }else{
                if($con=="total"){
                    $html.='<tr>
                                <td class="title">
                                    <b>Total Invoices :</b>
                                </td>
                                <td class="totals" style="border-bottom: double #195fc7">
                                    <b>'.$factura.'</b>
                                </td>
                            </tr>';
                }else if($con == "abono"){
                    $html.='
                            <tr>
                                <td class="title">
                                    <b>Total Deposit :</b>
                                </td>
                                <td class="totals">
                                    <b>'.$factura.'</b>
                                </td>
                            </tr>
                            ';
                }else if($con == "topay"){
                    $html.='
                            <tr>
                                <td class="title"">
                                    <b>Total Due :</b>
                                </td>
                                <td class="totals">
                                    <b>'.$factura.'</b>
                                </td>
                            </tr>
                           ';
                }
            }
        }

        $html.='</table></div></body>';
        /*echo $html;*/
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('statement'.$id_agency,$html,true,'letter','letter');
        $pdf->doPDF();
    }

    public function cost_day_report(){
        $html = '<head>
        <style>

            table{
                width:800px;
                padding: 0;
                margin: 2px auto;
            }
            tr{
                margin-top:-5px;
                border-left: #0b55c4 1px solid;
                border-right: #0b55c4 1px solid;
            }
            td{
                padding-left: 5px;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;
            }

            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7 !important;
                border-radius: 5px !important;
                color:white !important;
                padding: 4px !important;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
            td{
                border-left: 1px solid #195fc7;
                border-right: 1px solid #195fc7;
                padding: 0 5px;
            }

            #table_principal{
                font-size: 0.8em;
            }
        </style>
        </head>
        <body>
         <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">
                <h3>Daily Cost Report '.date("Y-m-d").'</h3>
            </div>
            </div>
        </div>
        <table class="grid" id="table_principal" style="width:100% !important;">
            <thead>
            <tr>
                <th class="title" colspan="11"> DAILY COST REPORT </th>
            </tr>
            <tr>
                <th >Conf. Code</th>
                <th >Pax Name</th>
                <th >Company</th>
                <th >T. Trans.</th>
                <th >T. Hotel.</th>
                <th >T. Transf.</th>
                <th >T. Parks</th>
                <th >T.Trffc</th>
                <th >Collect</th>
                <th >T. Service</th>
                <th >Pay Meth</th>
            </tr>
            </thead>
            <tbody>
        ';

        $sql0 = "(select r.codconf as cod_conf,
                    r.id,
                    r.pax as adults,
                    r.pax2 as childs,
                    IFNULL(a.id,-1) as agid,
                    CONCAT(r.lasname,', ',r.firsname) as paxname,
                    IFNULL(a.company_name,'SUPERTOURS') as company,
                    r.total2 as total_res,
                    '0' as total_hotel,
                    '0' as total_transfer,
                    '0' as total_parks,
                    '0' as total_traffic,
                    r.total2 as total_service,
                    (r.totaltotal) as total_collected,
                    r.pago,
                    'RESERVE' as type_service,
                    r.canal,
                    '0' as nites
             from reservas as r
               left join agencia as a on (r.agency = a.id)
             where DATE_FORMAT(DATE(r.fecha_salida),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') and r.id_tours = -1 and r.estado = 'CONFIRMED')
            union all
            (select t.code_conf as cod_conf,
                    t.id,
                    t.adult as adults,
                    t.child as childs,
                    IFNULL(a.id,-1) as agid,
                    CONCAT(c.lastname,', ',c.firstname) as paxname,
                    IFNULL(a.company_name,'SUPERTOURS') as company,
                    IFNULL(r.totaltotal,0) as total_res,
                    IFNULL(hr.total_paid,0) as total_hotel,
                    (IFNULL(tin.total_price,0) + IFNULL(tout.total_price,0)) as total_transfer,
                    (SELECT SUM(totalAdmission) as total from attraction_trafic where id_tours = t.id and type_tour= 'MULTI') as total_parks,
                    (SELECT SUM(totalTraspor) as total from attraction_trafic where id_tours = t.id and type_tour = 'MULTI') as total_traffic,
                    t.total as total_service,
                    t.totalouta as total_collected,
                    t.pago,
                    'MULTI' as type_service,
                    t.canal,
                    t.length_nights as nites
             from tours as t
               left join clientes as c on (t.id_client = c.id)
               left join agencia as a on (t.id_agency = a.id)
               left join reservas as r on (t.id_reserva = r.id)
               left join hotel_reserves as hr on (t.id_hotel_reserve = hr.id)
               left join transfer as tin on(t.id_transfer_in = tin.id)
               left join transfer as tout on (t.id_transfer_out = tout.id)
             where DATE_FORMAT(DATE(t.starting_date),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') and t.estado = 'CONFIRMED'
            ) union all
            ( select t.code_conf as cod_conf,
                     t.id,
                     t.adult as adults,
                     t.child as childs,
                     IFNULL(a.id,-1) as agid,
                     CONCAT(c.lastname,', ',c.firstname) as paxname,
                     IFNULL(a.company_name,'SUPERTOURS') as company,
                     r.totaltotal as total_res,
                     '0' as total_hotel,
                     '0' as total_transfer,
                     at.totalAdmission as total_parks,
                     at.totalTraspor as total_traffic,
                     t.total as total_service,
                     t.totalouta as total_collected,
                     r.pago,
                     'ONE' as type_service,
                     t.canal,
                     '0' as nites
              from tours_oneday as t
                left join clientes as c on (t.id_client = c.id)
                left join agencia as a on (t.id_agency = a.id)
                left join reservas as r on (t.id_reserva = r.id)
                left join attraction_trafic as at on (at.id_tours = t.id and at.type_tour = 'ONE')
              where DATE_FORMAT(DATE(t.starting_date),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') and t.estado = 'CONFIRMED'
            )";

        $q = Doo::db()->query($sql0);
        $rs = $q->fetchAll();
        $res = 0;
        $hot = 0;
        $trans = 0;
        $parks = 0;
        $traff = 0;
        $coll = 0;
        $sers = 0;
        foreach($rs as $service){

            if($service['type_service'] == "ONE" && $service['canal'] == "PHONE"){
                $pago = "";
                list($pago,$fb) = explode('-',$service['pago']);
                switch($pago){
                    case "1":
                        $pago = "Agency Credit Card";
                        break;
                    case "2":
                        $pago = "Passenger Credit Card";
                        break;
                    case "3":
                        $pago = "Credit Card +4% Fee";
                        break;
                    case "4":
                        $pago = "Cash";
                        break;
                    case "5":
                        $pago = "Credit Voucher";
                        break;
                    case "6":
                        $pago = "Cash in terminal";
                        break;
                    case "7":
                        $pago = "Complementary";
                }
                if($fb == "1"){
                    $pago.='-FULL';
                }else if($fb == "2"){
                    $pago.='-BALANCE';
                }else{
                    $pago.='-FULL';
                }
                $service['pago'] = $pago;
            }

            $html.='<tr>
                        <td>'.$service['cod_conf'].'</td>
                        <td>'.$service['paxname'].'</td>
                        <td>'.$service['company'].'</td>
                        <td>$'.number_format(doubleval($service['total_res']),2).'</td>
                        <td>$'.number_format(doubleval($service['total_hotel']),2).'</td>
                        <td>$'.number_format(doubleval($service['total_transfer']),2).'</td>
                        <td>$'.number_format(doubleval($service['total_parks']),2).'</td>
                        <td>$'.number_format(doubleval($service['total_traffic']),2).'</td>
                        <td>$'.number_format(doubleval($service['total_collected']),2).'</td>
                        <td>$'.number_format(doubleval($service['total_service']),2).'</td>
                        <td>'.$service['pago'].'</td>
                    </tr>';
            $res += intval($service['total_res']);
            $hot += intval($service['total_hotel']);
            $trans += intval($service['total_transfer']);
            $parks += intval($service['total_parks']);
            $traff += intval($service['total_traffic']);
            $coll += intval($service['total_collected']);
            $sers += intval($service['total_service']);
        }

        $html.='
            <tr>
                <td colspan="3" style="text-align:right; font-size: 1.2em;" class="title"><b>TOTALS</b></td>
                <td><b>$'.$res.'</b></td>
                <td><b>$'.$hot.'</b></td>
                <td><b>$'.$trans.'</b></td>
                <td><b>$'.$parks.'</b></td>
                <td><b>$'.$traff.'</b></td>
                <td><b>$'.$coll.'</b></td>
                <td colspan=2 class="title"><b>$'.$sers.'</b></td>
            </tr>
        ';

        $html.='</tbody>
        </table>';

        $alert = "";
        $total_childs = 0;
        $total_adults = 0;
        $hoteles = array();
        foreach($rs as $service){
            if($service['type_service']  != "RESERVE"){

                if($service['type_service'] == "MULTI"){
                    $sql1 = "select at.group, COUNT(at.group) as total, IF(COUNT(at.group) > 1,'GROUP',p.id) as park
                             from attraction_trafic as at
                                left join parques as p on (at.id_park = p.id)
                             where at.id_tours = ? and admission = 1 and type_tour = 'MULTI' group by `group`";
                    $q1 = Doo::db()->query($sql1,array($service['id']));
                    $rs1 = $q1->fetchAll();
                    foreach($rs1 as $disc){
                        if($disc['park'] == "GROUP"){
                            $sql2 = "select adults,child from admin_parques_tarifa where id_grupo = ? and cantidad = ? and type_rate = -1 and annio = ?";
                            $q2 = Doo::db()->query($sql2,array($disc['group'],$disc['total'],date('Y').'-01-01 00:00:00'));
                            $rs2 = $q2->fetchAll();
                            if(isset($rs2[0])){
                                $total_adults += intval($rs2[0]['adults']) * intval($service['adults']) * $disc['total'];
                                $total_childs += intval($rs2[0]['child']) * intval($service['childs']) * $disc['total'];
                            }else{
                                Doo::loadModel('Grupo_parque');
                                $park = new Grupo_parque();
                                $park->id = $disc['group'];
                                $park = Doo::db()->getOne($park);
                                $alert.='The costs for group '.$park->nombre.' aren\'t configured for '.$disc['total'].' parks<br>';
                            }
                        }else{
                            $sql2 = "select adults,child from admin_parques_tarifa where id_parque = ? and cantidad = ? and type_rate = -1 and annio = ?";
                            $q2 = Doo::db()->query($sql2,array($disc['park'], 1, date('Y').'-01-01 00:00:00'));
                            $rs2 = $q2->fetchAll();
                            if(isset($rs2[0])){
                                $total_adults += intval($rs2[0]['adults']) * intval($service['adults']);
                                $total_childs += intval($rs2[0]['child']) * intval($service['childs']);
                            }else{
                                Doo::loadModel('Parques');
                                $park = new Parques();
                                $park->id = $disc['park'];
                                $park = Doo::db()->getOne($park);
                                $alert.='The costs for '.$park->nombre.' aren\'t configured<br>';
                            }
                        }
                    }
                }else if($service['type_service'] == "ONE"){
                    $sql1 = "select at.group, COUNT(at.group) as total, IF(COUNT(at.group) > 1,'GROUP',p.id) as park
                             from attraction_trafic as at
                                left join parques as p on (at.id_park = p.id)
                             where at.id_tours = ? and admission = 1 and type_tour = 'ONE' group by `group`";
                    $q1 = Doo::db()->query($sql1,array($service['id']));
                    $rs1 = $q1->fetchAll();
                    if($q1->rowCount() > 0){
                        $sql2 = "select adults,child from admin_parques_tarifa where id_parque = ? and cantidad = ? and type_rate = -1 and annio = ?";
                        $q2 = Doo::db()->query($sql2,array($rs1[0]['park'], 1, date('Y').'-01-01 00:00:00'));
                        $rs2 = $q2->fetchAll();
                        if(isset($rs2[0])){
                            $total_adults += intval($rs2[0]['adults']) * intval($service['adults']);
                            $total_childs += intval($rs2[0]['child']) * intval($service['childs']);
                        }else{
                            Doo::loadModel('Parques');
                            $park = new Parques();
                            $park->id = $rs1[0]['park'];
                            $park = Doo::db()->getOne($park);
                            $alert.='The costs for '.$park->nombre.' aren\'t configured<br>';
                        }
                    }
                }
            }

            if($service['type_service'] == 'MULTI'){
                $sql3 = "select h.id,
                       h.nombre,
                       hr.room1_adult as room1,
                       hr.room2_adult as room2,
                       hr.room3_adult as room3,
                       hr.room4_adult as room4,
                       hr.buffet,
                       rv.sgl,
                       rv.dbl,
                       rv.tpl,
                       rv.qua,
                       rv.brackfast as breakfast
                from hotel_reserves as hr
                  left join hoteles as h on (hr.id_hotel = h.id)
                  left join ratesvalid rv on (hr.id_hotel = rv.id_hotel)
                where id_tours = ? and (UNIX_TIMESTAMP(hr.starting_date) >= rv.fecha_ini and UNIX_TIMESTAMP(hr.ending_date)<= rv.fecha_fin)";
                $q3 = Doo::db()->query($sql3,array($service['id']));
                $rs3 = $q3->fetchAll();
                if($q3->rowCount()>0){
                    Doo::loadController('admin/ToursController');
                    $tc = new ToursController();
                    $rooms = $tc->tipoHabitacion($rs3[0]['room1'],$rs3[0]['room2'],$rs3[0]['room3'],$rs3[0]['room4']);
                    if(isset($hoteles[$rs3[0]['id']])){
                        $hotel = $hoteles[$rs3[0]['id']];
                        $hotel['name'] = $rs3[0]['nombre'];
                        $hotel['single'] += ($rooms['sgl'] * $rs3[0]['sgl'])*$service['nites'];
                        $hotel['double'] += ($rooms['dbl'] * $rs3[0]['dbl'])*$service['nites'];
                        $hotel['triple'] += ($rooms['tpl'] * $rs3[0]['tpl'])*$service['nites'];
                        $hotel['quadro'] += ($rooms['qua'] * $rs3[0]['qua'])*$service['nites'];
                        $hotel['breakfast'] += ($rs3[0]['breakfast'])*$service['nites'];
                        $hoteles[$rs3[0]['id']] = $hotel;
                    }else{
                        $hotel = array();
                        $hotel['name'] = $rs3[0]['nombre'];
                        $hotel['single'] = ($rooms['sgl'] * $rs3[0]['sgl'])*$service['nites'];
                        $hotel['double'] = ($rooms['dbl'] * $rs3[0]['dbl'])*$service['nites'];
                        $hotel['triple'] = ($rooms['tpl'] * $rs3[0]['tpl'])*$service['nites'];
                        $hotel['quadro'] = ($rooms['qua'] * $rs3[0]['qua'])*$service['nites'];
                        $hotel['breakfast'] = ($rs3[0]['breakfast'])*$service['nites'];
                        $hoteles[$rs3[0]['id']] = $hotel;
                    }
                }

            }

        }

        $html.='<table class="grid">
                <tbody class="grid-body">
                    <tr>
                        <th colspan="7" class="title">Park Costs</th>
                    </tr>
                    <tr>
                        <th>T. Adults</th><th>T. Childs</th><th colspan="2">Total Parks</th><th colspan="3">To trans. funds</th>
                    </tr>
                    <tr>
                        <td>$ '.number_format(doubleval($total_adults),2).'</td>
                        <td>$ '.number_format(doubleval($total_childs),2).'</td>
                        <td colspan="2">$ '.number_format(doubleval($total_childs+$total_adults),2).'</td>
                        <td colspan="3">$ '.number_format(doubleval($parks - doubleval($total_childs+$total_adults)),2).'</td>
                    </tr>
                    <tr>
                        <th class="title" colspan="7">Hotel Costs</th>
                    </tr>
                    <tr>
                        <th>Hotel</th>
                        <th>Sgl</th>
                        <th>Dbl</th>
                        <th>Tri</th>
                        <th>Quad</th>
                        <th>Brkfs</th>
                        <th>Total</th>
                    </tr>';
        $total_hotel = 0;
        foreach($hoteles as $hotel){

            $html.='<tr>
                    <td>'.$hotel['name'].'</td>
                    <td>$ '.number_format(doubleval($hotel['single']),2).'</td>
                    <td>$ '.number_format(doubleval($hotel['double']),2).'</td>
                    <td>$ '.number_format(doubleval($hotel['triple']),2).'</td>
                    <td>$ '.number_format(doubleval($hotel['quadro']),2).'</td>
                    <td>$ '.number_format(doubleval($hotel['breakfast']),2).'</td>
                    <td>$ '.number_format(doubleval((intval($hotel['single'])+intval($hotel['double'])+intval($hotel['triple'])+intval($hotel['quadro'])+intval($hotel['breakfast']))),2).'</td>
                    </tr>';
            $total_hotel += (intval($hotel['single'])+intval($hotel['double'])+intval($hotel['triple'])+intval($hotel['quadro'])+intval($hotel['breakfast']));

        }
        $html.='<tr>
                <td colspan="6" class="title">Total Hotels</td>
                <td>$ '.number_format(doubleval($total_hotel),2).'</td>
                </tr>
                <tr>
                <td colspan="6" class="title"><b>To Trans. Funds</b></td>
                <td>$ '.number_format(doubleval(($hot - $total_hotel)),2).'</td>
                </tr>
                ';

        $html.='</tbody>
                </table>';
        $html.= '<span style="color:red; font-weight: bolder">'.$alert.'</span>';

        $total_trans = doubleval(($hot - $total_hotel)) + doubleval($parks - doubleval($total_childs+$total_adults)) + $res + $trans + $traff;

        $html.='<table class="grid">
                    <tbody class="grid-body">
                        <tr>
                            <th> Total Transportation Funds Today :</th>
                            <td>$ '.number_format($total_trans,2).'</td>
                        </tr>
                    </tbody>
                </table>';

        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Daily Cost Report - '.date('Y-m-d'),$html,false,'letter','landscape');
        $pdf->doPDF();

    }

    public function cost_range_report(){
        $fini = $this->params['fini'];
        $ffin = $this->params['ffin'];

        $html = '
        <head>
        <style>

            table{
                width:800px;
                padding: 0;
                margin: 2px auto;
            }
            tr{
                margin-top:-5px;
                border-left: #0b55c4 1px solid;
                border-right: #0b55c4 1px solid;
            }
            td{
                padding-left: 5px;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;
            }

            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7 !important;
                border-radius: 5px !important;
                color:white !important;
                padding: 4px !important;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
            td{
                border-left: 1px solid #195fc7;
                border-right: 1px solid #195fc7;
                padding: 0 5px;
            }
        </style>
        </head>
        <body>
         <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">
                <h3>Costs Report from '.$fini.' to '.$ffin.'</h3>
            </div>
            </div>
        </div>
        <table class="grid" style="width:1000px;">
        <thead>
            <tr>
                <td class="title" colspan="7">Total Selled Services</td>
            </tr>
            <tr>
                <th>Service</th>
                <th>Ammount</th>
                <th>Sales</th>
                <th>Collected</th>
                <th>Costs</th>
                <th>Comisions And Refunds</th>
                <th>Sub Total</th>
            </tr>
        </thead><tbody class="grid-body">';


        /********************************* TRANSPORTACION POR RANGO *****************************************/
        $sqltr = "select IFNULL(SUM(service_cost),0) as total_transport_cost, IFNULL(SUM(collect),0) as collected, COUNT(*) as total from(select
                      r.id,
                      r.fecha_salida,
                      r.fecha_retorno,
                      r.total2 as service_cost,
                      r.totaltotal as collect
                    from reservas as r
                    where
                      r.fecha_salida >= ?
                      and r.fecha_salida < ?
                      and id_tours = -1
                      and r.tipo_pago !='FREE SERVICES') as results;";

        $qtr = Doo::db()->query($sqltr,array($fini,$ffin));
        $rstr = $qtr->fetchAll();
        $com = doubleval(floatval($rstr[0]['collected']) - floatval($rstr[0]['total_transport_cost']));
        // Un valor positivo significa que en el periodo supertours debe pagar a agencias ese valor.
        // Un valor negativo significa lo que perdio supertours en descuentos y otros valores menores del servicio prestado
        $html.='<tr>
                <td>Transportation</td>
                <td>'.$rstr[0]['total'].'</td>
                <td>$ '.number_format($rstr[0]['total_transport_cost'],2).'</td>
                <td>$ '.number_format($rstr[0]['collected'],2).'</td>
                <td>$ 0.00 </td>
                <td '.(($com<0)?'style="color:red" ':'').'>$ '.number_format($com,2).'</td>
                <td>$ '.number_format($rstr[0]['collected'],2).'</td>
                </tr>';
        $total_trans = $rstr[0]['collected'];
        /****************************************TOTAL ACUMULADOR ******************************************/

        $total_diff = 0;

        /****************************** TRANSPORTACION TOUR POR RANGO **************************************/

        $sqlttr = "select IFNULL(SUM(service_cost),0) as total_transport_cost, COUNT(*) as total,
                      IFNULL(SUM(collect),0) as collect from(select
                            r.id,
                            r.fecha_salida,
                            r.fecha_retorno,
                            r.total2 as service_cost,
                            r.totaltotal as collect
                          from reservas as r
                            left join tours as t on (r.id_tours = t.id and r.type_tour = 'MULTI')
                            left join tours_oneday as ton on (r.id_tours = ton.id and r.type_tour = 'ONE')
                          where
                            r.fecha_salida >= ?
                            and r.fecha_salida < ?
                            and id_tours != -1
                            and IF(r.type_tour = 'MULTI',
                                   (t.estado != 'CANCELED' and t.estado != 'QUOTE') and t.tipo_pago != 'FREE SERVICES'
                                   ,(ton.estado != 'CANCELED' and ton.estado != 'QUOTE') and r.tipo_pago not like '7%')
                                       ) as results";
        $qttr = Doo::db()->query($sqlttr,array($fini,$ffin));
        $rsttr = $qttr->fetchAll();

        $html.='<tr>
                <td>(Tours) Transportation</td>
                <td>'.$rsttr[0]['total'].'</td>
                <td>$ '.number_format($rsttr[0]['total_transport_cost'],2).'</td>
                <td>$ '.number_format($rsttr[0]['total_transport_cost'],2).'</td>
                <td>$ 0.00 </td>
                <td>$ 0.00 </td>
                <td>$ '.number_format($rsttr[0]['total_transport_cost'],2).'</td>
                </tr>';
        $total_diff += floatval($rsttr[0]['total_transport_cost']);
        //com es 0 ya que se registra el valor de transportación pagada en tour como si no existiera descuento y demas
        //los descuentos, comisiones y paybacks se anotaran en otra linea donde se generalizaran dichos montos
        /** BIEN */

        /**************************** TRANSFERS TOURS POR RANGO *******************************************/

        $sqltrn = "select IFNULL(SUM(tinprice),0) as total_transfer, COUNT(*) as total from (select t.id,tr.total_price as tinprice from tours as t
                    inner join transfer as tr on (tr.id = t.id_transfer_in or tr.id = t.id_transfer_out)
                    where t.starting_date >= ? and t.starting_date < ? and t.estado != 'CANCELED' and t.estado != 'QUOTE' and t.tipo_pago != 'FREE SERVICES') as result";
        $qtrn = Doo::db()->query($sqltrn,array($fini,$ffin));
        $rstrn = $qtrn->fetchAll();

        $html.='<tr>
                <td>(Tours) Transfers IN/OUT</td>
                <td>'.$rstrn[0]['total'].'</td>
                <td>$ '.number_format($rstrn[0]['total_transfer'],2).'</td>
                <td>$ '.number_format($rstrn[0]['total_transfer'],2).'</td>
                <td>$ 0.00 </td>
                <td>$ 0.00 </td>
                <td>$ '.number_format($rstrn[0]['total_transfer'],2).'</td>
                </tr>';
        //com es 0 ya que se registra el valor de transfers pagada en tour como si no existiera descuento y demas
        //los descuentos, comisiones y paybacks se anotaran en otra linea donde se generalizaran dichos montos
        /* BIEN */
        $total_diff += floatval($rstrn[0]['total_transfer']);
        /************************** ATTRACTION TRAFFIC TOURS POR RANGO ********************************/


        $sqlatr = "select IFNULL(SUM(totalAdmision),0) as total_admision,
                      IFNULL(SUM(totalTransport),0) as total_transport,
                      IFNULL(SUM(totalPaid),0) as totalPaid,
                      IFNULL(SUM(tickets),0) as tickets,
                      IFNULL(SUM(trafics),0) as trafics
                    from (
                    (SELECT IFNULL(SUM(IF(at.admission=1,totalAdmission,0)),0) as totalAdmision,
                       IFNULL(SUM(IF(at.trafic = 1,totaltraspor,0)),0) as totalTransport,
                       IFNULL(SUM(total_paid),0) as totalPaid,
                       IFNULL(SUM(IF(at.trafic = 1,1,0)),0) as trafics,
                       IFNULL(SUM(IF(at.admission = 1,1,0)),0) as tickets
                     FROM `attraction_trafic` as at
                      inner join tours as t on (t.id = id_tours and type_tour = 'MULTI')
                    where t.starting_date >= ?
                          and t.starting_date < ?
                          and t.tipo_pago != 'FREE SERVICES'
                          and t.estado != 'CANCELED'
                          and t.estado !='QUOTE')
                    union
                    (SELECT IFNULL(SUM(IF(at.admission=1,totalAdmission,0)),0) as totalAdmision,
                       IFNULL(SUM(IF(at.trafic = 1,totaltraspor,0)),0) as totalTransport,
                       IFNULL(SUM(total_paid),0) as totalPaid,
                       IFNULL(SUM(IF(at.trafic = 1,1,0)),0) as trafics,
                       IFNULL(SUM(IF(at.admission = 1,1,0)),0) as tickets
                     FROM `attraction_trafic` as at
                       inner join tours_oneday as t on (t.id = id_tours and type_tour = 'ONE')
                       left join reservas as r on (t.id_reserva = r.id)
                     where t.starting_date >= ?
                           and t.starting_date < ?
                           and r.tipo_pago != '7%'
                           and t.estado != 'CANCELED'
                           and t.estado !='QUOTE') ) as result;
                    ";
        $qatr = Doo::db()->query($sqlatr,array($fini,$ffin,$fini,$ffin));
        $rsatr = $qatr->fetchAll();
        $html.='<tr>
                <td>(Tours) Attraction Traffics</td>
                <td>'.$rsatr[0]['trafics'].'</td>
                <td>$ '.number_format(($rsatr[0]['total_transport']),2).'</td>
                <td>$ '.number_format($rsatr[0]['total_transport'],2).'</td>
                <td>$ 0.00 </td>
                <td>$ 0.00 </td>
                <td>$ '.number_format($rsatr[0]['total_transport'],2).'</td>
                </tr>';

        $total_diff += floatval($rsatr[0]['total_transport']);

        /*************************** PARK COSTS ************************************************************/
        $sqlcp = "(select t.id, 'MULTI' as type_service, t.adult as adults, t.child as childs from tours as t where t.starting_date >=? and t.starting_date < ? and t.tipo_pago != 'FREE SERVICES' and t.estado != 'QUOTE' and t.estado != 'CANCELED')
                    union all
                    (select t.id, 'ONE' as type_service, t.adult as adults, t.child as childs from tours_oneday as t
                      left join reservas as r on (t.id_reserva = r.id)
                    where t.starting_date >=? and t.ending_date <? and (r.tipo_pago!= 'FREE SERVICES' or r.tipo_pago not like '7%') and t.estado != 'QUOTE' and t.estado != 'CANCELED')
                    ";
        $annio = substr($fini,0,4);
        $qcp = Doo::db()->query($sqlcp,array($fini,$ffin,$fini,$ffin));
        $rs = $qcp->fetchAll();
        $alert = '';
        $total_adults = 0;
        $total_childs = 0;
        foreach ($rs as $service){
        if($service['type_service'] == "MULTI"){
            $sql1 = "select at.group, COUNT(at.group) as total, IF(COUNT(at.group) > 1,'GROUP',p.id) as park
                             from attraction_trafic as at
                                left join parques as p on (at.id_park = p.id)
                             where at.id_tours = ? and admission = 1 and type_tour = 'MULTI' group by `group`";
            $q1 = Doo::db()->query($sql1,array($service['id']));
            $rs1 = $q1->fetchAll();
            foreach($rs1 as $disc){
                if($disc['park'] == "GROUP"){
                    $sql2 = "select adults,child from admin_parques_tarifa where id_grupo = ? and cantidad = ? and type_rate = -1 and annio = ?";
                    $q2 = Doo::db()->query($sql2,array($disc['group'],$disc['total'],$annio.'-01-01 00:00:00'));
                    $rs2 = $q2->fetchAll();
                    if(isset($rs2[0])){
                        $total_adults += intval($rs2[0]['adults']) * intval($service['adults']) * $disc['total'];
                        $total_childs += intval($rs2[0]['child']) * intval($service['childs']) * $disc['total'];
                    }else{
                        Doo::loadModel('Grupo_parque');
                        $park = new Grupo_parque();
                        $park->id = $disc['group'];
                        $park = Doo::db()->getOne($park);
                        $alert.='The costs for group '.$park->nombre.' aren\'t configured for '.$disc['total'].' parks<br>';
                    }
                }else{
                    $sql2 = "select adults,child from admin_parques_tarifa where id_parque = ? and cantidad = ? and type_rate = -1 and annio = ?";
                    $q2 = Doo::db()->query($sql2,array($disc['park'], 1, $annio.'-01-01 00:00:00'));
                    $rs2 = $q2->fetchAll();
                    if(isset($rs2[0])){
                        $total_adults += intval($rs2[0]['adults']) * intval($service['adults']);
                        $total_childs += intval($rs2[0]['child']) * intval($service['childs']);
                    }else{
                        Doo::loadModel('Parques');
                        $park = new Parques();
                        $park->id = $disc['park'];
                        $park = Doo::db()->getOne($park);
                        $alert.='The costs for '.$park->nombre.' aren\'t configured<br>';
                    }
                }
            }
        }else if($service['type_service'] == "ONE"){
            $sql1 = "select at.group, COUNT(at.group) as total, IF(COUNT(at.group) > 1,'GROUP',p.id) as park
                             from attraction_trafic as at
                                left join parques as p on (at.id_park = p.id)
                             where at.id_tours = ? and admission = 1 and type_tour = 'ONE' group by `group`";
            $q1 = Doo::db()->query($sql1,array($service['id']));
            $rs1 = $q1->fetchAll();
            if($q1->rowCount() > 0){
                $sql2 = "select adults,child from admin_parques_tarifa where id_parque = ? and cantidad = ? and type_rate = -1 and annio = ?";
                $q2 = Doo::db()->query($sql2,array($rs1[0]['park'], 1, $annio.'-01-01 00:00:00'));
                $rs2 = $q2->fetchAll();
                if(isset($rs2[0])){
                    $total_adults += intval($rs2[0]['adults']) * intval($service['adults']);
                    $total_childs += intval($rs2[0]['child']) * intval($service['childs']);
                }else{
                    Doo::loadModel('Parques');
                    $park = new Parques();
                    $park->id = $rs1[0]['park'];
                    $park = Doo::db()->getOne($park);
                    $alert.='The costs for '.$park->nombre.' aren\'t configured<br>';
                }
            }
        }
        }
        $total_cost_parks = $total_adults + $total_childs;


        $html.='<tr>
                <td>(Tours) Attraction Admisions</td>
                <td>'.$rsatr[0]['tickets'].'</td>
                <td>$ '.number_format(($rsatr[0]['total_admision']),2).'</td>
                <td>$ '.number_format($rsatr[0]['total_admision'],2).'</td>
                <td>$ '.$total_cost_parks.' </td>
                <td>$ 0.00 </td>
                <td>$ '.number_format((floatval($rsatr[0]['total_admision']) - floatval($total_cost_parks)),2).'</td>
                </tr>';

        $total_diff += floatval($rsatr[0]['total_admision']) - floatval($total_cost_parks);
        //com es 0 ya que se registra el valor de admisiones y transporte a los parques
        //pagada en tour como si no existiera descuento y demas
        //los descuentos, comisiones y paybacks se anotaran en otra linea donde se generalizaran dichos montos

        /***************************** HOTELES TOURS POR RANGO ******************************************/

        $sqlhot = "SELECT IFNULL(SUM( nights ),0) AS nites, IFNULL(SUM( totalnights ),2) AS total_nites, IFNULL(SUM( total_paid ),0) AS total_paid,
                      IFNULL(SUM(hr.totalbreakfasts),0) as total_breakfast, IFNULL(SUM(IF(hr.buffet = 1,1,0)),0) as buffets
                    FROM  `hotel_reserves` AS hr
                      INNER JOIN tours AS t ON ( t.id = hr.id_tours )
                    WHERE t.starting_date >=  ?
                          AND t.starting_date <  ?
                          AND t.tipo_pago !=  'FREE SERVICES'
                          AND t.estado !=  'QUOTE'
                          AND t.estado !=  'CANCELED';";

        $qhot = Doo::db()->query($sqlhot,array($fini,$ffin));
        $rshot = $qhot->fetchAll();

        /***************************************** HOTEL COSTS **************************************/

        $sqlchot = "select t.id, sum(t.length_nights) as nites, t.code_conf, h.nombre, hr.room1_adult, hr.room2_adult, hr.room3_adult, hr.room4_adult,sgl,dbl,tpl,qua from hotel_reserves as hr
                      left join tours as t on (t.id_hotel_reserve = hr.id)
                      left join hoteles as h on (hr.id_hotel = h.id)
                      left join ratesvalid as rv on (hr.id_hotel = rv.id_hotel and rv.fecha_fin >= UNIX_TIMESTAMP(hr.starting_date) and rv.fecha_ini < UNIX_TIMESTAMP(hr.ending_date))
                      where hr.starting_date >= ? and hr.starting_date < ? and t.tipo_pago!='FREE SERVICES';";
        $qchot = Doo::db()->query($sqlchot,array($fini,$ffin));
        $rschot = $qchot->fetchAll();
        Doo::loadController('admin/ToursController');
        $tc = new ToursController();
        $costs = array();
        $costs['sgl'] = 0;
        $costs['dbl'] = 0;
        $costs['tpl'] = 0;
        $costs['qua'] = 0;
        $r_cost = array();
        foreach($rschot as $hotel){
            $th = $tc->tipoHabitacion($hotel['room1_adult'],$hotel['room2_adult'],$hotel['room3_adult'],$hotel['room4_adult']);
            $out = array();
            foreach($th as $id=>$type){
                $costs[$id] += $th[$id]*$hotel[$id]*$hotel['nites'];
                $out[$id] = $th[$id]*$hotel[$id]*$hotel['nites'];
            }
            $r_cost[$hotel['id']] = $out;
        }
        $total_paid_hotel = $costs['sgl'] + $costs['dbl'] + $costs['tpl'] + $costs['qua'];

        $html.='<tr>
                <td>(Tours) Hotels</td>
                <td>(Nights) '.$rshot[0]['nites'].'</td>
                <td>$ '.number_format($rshot[0]['total_paid'],2).'</td>
                <td>$ '.number_format($rshot[0]['total_paid'],2).'</td>
                <td>$ '.number_format($total_paid_hotel,2).' </td>
                <td>$ 0.00 </td>
                <td>$ '.number_format(($rshot[0]['total_paid'] - $total_paid_hotel),2).'</td>
                </tr>';

        $total_diff += floatval($rshot[0]['total_paid'] - $total_paid_hotel);

        /********************************************** TOURS *******************************************/

        $sqltour = "select sum(t.totalouta) as collected, sum(t.total) as total_service, count(*) as total from tours as t where t.starting_date >= ? and t.starting_date < ? and t.estado != 'CANCELED' and t.estado != 'QUOTE' and t.tipo_pago!='FREE SERVICES'";
        $qtour = Doo::db()->query($sqltour,array($fini,$ffin));
        $rstour = $qtour->fetchAll();



        $html.='<tr>
                <td class="title"><b>Tours</b></td>
                <td>'.$rstour[0]['total'].'</td>
                <td>$ '.number_format($rstour[0]['total_service'],2).'</td>
                <td>$ '.number_format($rstour[0]['collected'],2).'</td>
                <td>$ 0.00 </td>
                <td>$'.number_format(($rstour[0]['collected'] - $rstour[0]['total_service']),2).'</td>
                <td>$ '.number_format($total_diff,2).'</td>
                </tr>';
        $html.='<tr><th colspan="6">Transports Funds</td><td>$ '.number_format((floatval($total_diff)+floatval($total_trans)),2).'</td>';
        $html.='</tbody></table>
        <span style="color:red">'.$alert.'</span>
        </body>';
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Cost Report - '.$fini.'--'.$ffin,$html,false,'letter','landscape');
        $pdf->doPDF();
        //echo $html;


    }

    public function reserve_collect_report(){

        $fecha_inicio = $this->params['fecha_inicio'];
        $fecha_final = $this->params['fecha_final'];
        
        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">Black Box</h3>
                <span>'.$fecha_inicio.' / '.$fecha_final.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 600px;">
            <thead>
                <tr>
                    <th>Code Reserve</th>
                    <th>Pax name</th>
                    <th>End date</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';


        $sql = "select reservas.codconf, reservas.id_clientes, reservas.totaltotal, reservas.tipo_pago,
                  reservas.fecha_salida, reservas.estado, reservas.fecha_salida, reservas.firsname, reservas.lasname
                  from reservas
                  where (reservas.codconf like 'R%' and reservas.tipo_pago = 'COLLECT ON BOARD' and reservas.estado = 'QUOTE')
                        and (reservas.fecha_salida >= ? and reservas.fecha_salida <= ?)";
        $query = $this->db()->query($sql, array($fecha_inicio, $fecha_final));
        $query_fetch = $query->fetchAll();

        $total = 0.0;
        foreach($query_fetch as $reserve){
            $html .= '<tr>
                <td>'.$reserve['codconf'].'</td>
                <td>'.$reserve['firsname'].' '.$reserve['lasname'].'</td>
                <td>'.$reserve['fecha_salida'].'</td>
                <td> $ '.$reserve['totaltotal'].'</td>
            </tr>';

            $total += $reserve['totaltotal'];
        }
        $total = $english_format_number = number_format($total, 2, '.', '');
        $html .= '<tr>
                <td class="title" colspan="3" style="text-align: center;">Total</td>
                <td>$ '.$total.'</td>
            </tr>';
        $html .= '</tbody>';

        $html.='</table></div></body>';
        //echo $html;
        //ini_set("memory_limit","100M");
        //ob_start(); 
        Doo::loadHelper('DooPDF');
        
        $pdf = new DooPDF('Black box '.$fecha_inicio.' to '.$fecha_final,$html,false,'letter','letter');
        $pdf->doPDF();
        //ob_flush();
    }

    public function ventas_tours_report(){
        //TODO: crear pagina para que el usuario seleccione las fechas
        $estado = $this->params['estado'];
        /*
         * Tours y oneday
         * 1: CONFIRMED
         * 2: QUOTE
         * 3: CANCELLED
         * 4: INVOICED
         * Reservas o transportation
         * 5: NOT SHOW W/ CHARGE
         * 6: NOT SHOW W/O CHARGE
         * */
        $tipo = $this->params['tipo'];
        /*
         * 1: Reservas o Transportaton
         * 2: Multi Day
         * 3: One Day
         * */

        $titulo = '';
        $estado_elegido = '';
        if($estado == 1){
            $estado_elegido .= 'CONFIRMED';
        }elseif($estado == 2){
            $estado_elegido .= 'QUOTE';
        }elseif($estado == 3){
            $estado_elegido .= 'CANCELLED';
        }elseif($estado == 4){
            $estado_elegido .= 'INVOICED';
        }elseif($estado == 5){
            $estado_elegido .= 'NOT SHOW W/ CHARGE';
        }elseif($estado == 6){
            $estado_elegido .= 'NOT SHOW W/O CHARGE';
        }

        $tipo_elegido = '';
        if($tipo == 1){
            $tipo_elegido .= 'TRANSPORTATION';
        }elseif($tipo == 2){
            $tipo_elegido .= 'TOURS';
        }elseif($tipo == 3){
            $tipo_elegido .= 'ONEDAY';
        }

        $titulo .= $estado_elegido.' '.$tipo_elegido;
        $fecha_inicio = $this->params['fecha_inicio'];
        $fecha_final = $this->params['fecha_final'];

        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">'.$titulo.'</h3>
                <span>'.$fecha_inicio.' / '.$fecha_final.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 90%;">
            <thead>
                <tr>
                    <th>Code Reserve</th>
                    <th>Pax name</th>
                    <th>End date</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';

        if($tipo == 1){

            $sql = "select reservas.codconf, reservas.id_clientes, reservas.totaltotal, reservas.tipo_pago,
                      reservas.fecha_salida, reservas.estado, reservas.fecha_salida, reservas.firsname, reservas.lasname
                      from reservas
                      where (reservas.id_tours=-1 and reservas.tipo_pago != 'FREE SERVICES' and reservas.estado = ?)
                            and (reservas.fecha_salida >= ? and reservas.fecha_salida <= ?)
                        order by reservas.fecha_salida";
            $query = $this->db()->query($sql, array($estado_elegido, $fecha_inicio, $fecha_final));
            $query_fetch = $query->fetchAll();

        }elseif($tipo == 2){
            $sql = "select tours.code_conf as codconf, tours.id_client, tours.totalouta as totaltotal, tours.tipo_pago,
                      tours.starting_date as fecha_salida, tours.estado, clientes.firstname as firsname, clientes.lastname as lasname
                      from tours
                      left join clientes
                      on clientes.id=tours.id_client
                      where (tours.tipo_pago != 'FREE SERVICES' and tours.estado = ?)
                            and (tours.starting_date >= ? and tours.starting_date <= ?)
                        order by tours.starting_date";

            $query = $this->db()->query($sql, array($estado_elegido, $fecha_inicio, $fecha_final));
            $query_fetch = $query->fetchAll();
        }elseif($tipo == 3){
            $sql = "select tours_oneday.code_conf as codconf, tours_oneday.id_client, tours_oneday.totalouta as totaltotal, reservas.tipo_pago,
                      tours_oneday.starting_date as fecha_salida, tours_oneday.estado, clientes.firstname as firsname, clientes.lastname as lasname
                      from tours_oneday
                      left join clientes
                      on clientes.id=tours_oneday.id_client
                      left join reservas
                      on reservas.id_tours=tours_oneday.id and reservas.type_tour = 'ONE'
                      where (reservas.tipo_pago not like '7%' and tours_oneday.estado = ?)
                            and (tours_oneday.starting_date >= ? and tours_oneday.starting_date <= ?)
                        order by tours_oneday.starting_date";

            $query = $this->db()->query($sql, array($estado_elegido, $fecha_inicio, $fecha_final));
            $query_fetch = $query->fetchAll();
        }


        $total = 0.0;
        foreach($query_fetch as $reserve){
            $html .= '<tr>
                    <td>'.$reserve['codconf'].'</td>
                    <td>'.$reserve['firsname'].' '.$reserve['lasname'].'</td>
                    <td>'.$reserve['fecha_salida'].'</td>
                    <td> $ '.number_format($reserve['totaltotal'], 2, '.', '').'</td>
                </tr>';

            $total += $reserve['totaltotal'];
        }

        $total = number_format($total, 2, '.', '');
        $html .= '<tr>
                    <td class="title" colspan="3" style="text-align: center;">Total</td>
                    <td>$ '.$total.'</td>
                </tr>';
        $html .= '</tbody>';

        $html.='</table></div></body>';
        /*echo $html;*/
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF($titulo.' '.$fecha_inicio.' to '.$fecha_final, $html, false, 'letter', 'landscape');
        $pdf->doPDF();
    }

    public function entry_services_report(){
        //TODO: crear pagina para que el usuario seleccione las fechas
        $fecha_inicio = $this->params['fecha_inicio'];
        $fecha_final = $this->params['fecha_final'];

        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">Canal Services</h3>
                <span>'.$fecha_inicio.' / '.$fecha_final.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 600px;">
            <thead>
                <tr>
                    <th></th>
                    <th>Web Sale</th>
                    <th>Phone</th>
                    <th>Mail</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';


//        $sql = "select reservas.codconf, reservas.id_clientes, reservas.totaltotal, reservas.tipo_pago,
//                  reservas.fecha_salida, reservas.estado, reservas.fecha_salida, reservas.firsname, reservas.lasname
//                  from reservas
//                  where (reservas.codconf like 'R%' and reservas.tipo_pago = 'COLLECT ON BOARD' and reservas.estado = 'QUOTE')
//                        and (reservas.fecha_salida >= ? and reservas.fecha_salida <= ?)";
//        $query = $this->db()->query($sql, array($fecha_inicio, $fecha_final));
//        $query_fetch = $query->fetchAll();


        /* Tour */
        $sum_websale = 0;
        $sum_phone = 0;
        $sum_mail = 0;
        $sql_sum_tours = "select count(*) as num
                              from tours
                              where (tours.estado = 'CONFIRMED' or tours.estado = 'INVOICED')
                              and (tours.starting_date >= ? and tours.starting_date <= ?) and (tours.canal = ? or tours.canal = ?);";
        $num_websale = $this->db()->query($sql_sum_tours, array($fecha_inicio, $fecha_final, 'WEBSALE', 'WEBSALE'));
        $num_websale = $num_websale->fetchAll();
        $num_websale = $num_websale[0]['num'];
        $sum_websale += $num_websale;

        $num_phone = $this->db()->query($sql_sum_tours, array($fecha_inicio, $fecha_final, 'PHONE', ''));
        $num_phone = $num_phone->fetchAll();
        $num_phone = $num_phone[0]['num'];
        $sum_phone += $num_phone;

        $num_mail = $this->db()->query($sql_sum_tours, array($fecha_inicio, $fecha_final, 'MAIL', 'MAIL'));
        $num_mail = $num_mail->fetchAll();
        $num_mail = $num_mail[0]['num'];
        $sum_mail += $num_mail;

        $html .= '<tr>
                <td class="title">Tours</td>
                <td>'.$num_websale.'</td>
                <td>'.$num_phone.'</td>
                <td>'.$num_mail.'</td>
                <td>'.($num_websale + $num_phone + $num_mail).'</td>
            </tr>';

        /* Tours One Day */

        $sql_sum_oneday = "select count(*) as num
                              from tours_oneday
                              where (tours_oneday.estado = 'CONFIRMED' or tours_oneday.estado = 'INVOICED')
                              and (tours_oneday.starting_date >= ? and tours_oneday.starting_date <= ?) and (tours_oneday.canal = ? or tours_oneday.canal = ?);";
        $num_websale = $this->db()->query($sql_sum_oneday, array($fecha_inicio, $fecha_final, 'WEBSALE', 'WEBSALE'));
        $num_websale = $num_websale->fetchAll();
        $num_websale = $num_websale[0]['num'];
        $sum_websale += $num_websale;

        $num_phone = $this->db()->query($sql_sum_oneday, array($fecha_inicio, $fecha_final, 'PHONE', ''));
        $num_phone = $num_phone->fetchAll();
        $num_phone = $num_phone[0]['num'];
        $sum_phone += $num_phone;

        $num_mail = $this->db()->query($sql_sum_oneday, array($fecha_inicio, $fecha_final, 'PHONE', 'PHONE'));
        $num_mail = $num_mail->fetchAll();
        $num_mail = $num_mail[0]['num'];
        $sum_mail += $num_mail;

        $html .= '<tr>
                <td class="title">One Day</td>
                <td>'.$num_websale.'</td>
                <td>'.$num_phone.'</td>
                <td>'.$num_mail.'</td>
                <td>'.($num_websale + $num_phone + $num_mail).'</td>
            </tr>';

        /* Reservas */

        $sql_sum_reserves = "select count(*) as num
                              from reservas
                              where (reservas.estado = 'CONFIRMED' or reservas.estado = 'INVOICED')
                              and (reservas.fecha_salida >= ? and reservas.fecha_salida <= ?) and (reservas.canal = ? or reservas.canal = ?);";

        $num_websale = $this->db()->query($sql_sum_reserves, array($fecha_inicio, $fecha_final, 'WEBSALE', 'WEBSALE'));
        $num_websale = $num_websale->fetchAll();
        $num_websale = $num_websale[0]['num'];
        $sum_websale += $num_websale;

        $num_phone = $this->db()->query($sql_sum_reserves, array($fecha_inicio, $fecha_final, 'PHONE', ''));
        $num_phone = $num_phone->fetchAll();
        $num_phone = $num_phone[0]['num'];
        $sum_phone += $num_phone;

        $num_mail = $this->db()->query($sql_sum_reserves, array($fecha_inicio, $fecha_final, 'MAIL', 'MAIL'));
        $num_mail = $num_mail->fetchAll();
        $num_mail = $num_mail[0]['num'];
        $sum_mail += $num_mail;

        $html .= '<tr>
                <td class="title">Transport</td>
                <td>'.$num_websale.'</td>
                <td>'.$num_phone.'</td>
                <td>'.$num_mail.'</td>
                <td>'.($num_websale + $num_phone + $num_mail).'</td>
            </tr>';


        $html .= '<tr>
                <td class="title">Total</td>
                <td class="title">'.$sum_websale.'</td>
                <td class="title">'.$sum_phone.'</td>
                <td class="title">'.$sum_mail.'</td>
                <td class="title">'.($sum_websale + $sum_phone + $sum_mail).'</td>
            </tr>';

        $html .= '</tbody>';

        $html.='</table></div></body>';

        /*echo $html;*/
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Canal Services '.$fecha_inicio.' to '.$fecha_final,$html,false,'letter','letter');
        $pdf->doPDF();
    }

    public function total_tickets_report(){
        //TODO: crear pagina para que el usuario seleccione las fechas
        $fecha_inicio = $this->params['fecha_inicio'];
        $fecha_final = $this->params['fecha_final'];

        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">Total Tickets</h3>
                <span>'.$fecha_inicio.' / '.$fecha_final.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 600px;">
            <thead>
                <tr>
                    <th>Park</th>
                    <th>Adults</th>
                    <th>Childs</th>
                    <th>Total Tickets</th>
                </tr>
            </thead>
            <tbody>';


//        $sql = "select reservas.codconf, reservas.id_clientes, reservas.totaltotal, reservas.tipo_pago,
//                  reservas.fecha_salida, reservas.estado, reservas.fecha_salida, reservas.firsname, reservas.lasname
//                  from reservas
//                  where (reservas.codconf like 'R%' and reservas.tipo_pago = 'COLLECT ON BOARD' and reservas.estado = 'QUOTE')
//                        and (reservas.fecha_salida >= ? and reservas.fecha_salida <= ?)";
//        $query = $this->db()->query($sql, array($fecha_inicio, $fecha_final));
//        $query_fetch = $query->fetchAll();


        /* Tour */
        $sum_websale = 0;
        $sum_phone = 0;
        $sum_mail = 0;
        $sql_tickets_parks = "select parques.nombre, parques.id_grupo as id_grupo_parques, grupo_parques.nombre as nombre_grupo,
                                (select sum(attraction_trafic.adult) from attraction_trafic where (attraction_trafic.id_park=parques.id and attraction_trafic.admission=1) and ((attraction_trafic.starting_date >= ? and attraction_trafic.starting_date <= ?))) as tickets_adults,
                                (select sum(attraction_trafic.child) from attraction_trafic where attraction_trafic.id_park=parques.id and attraction_trafic.admission=1 and ((attraction_trafic.starting_date >= ? and attraction_trafic.starting_date <= ?))) as tickets_childs
                              from parques
                              left join grupo_parques
                                on parques.id_grupo=grupo_parques.id
                              order by id_grupo;";
        $tickets_parks = $this->db()->query($sql_tickets_parks, array($fecha_inicio, $fecha_final, $fecha_inicio, $fecha_final));
        $tickets_parks = $tickets_parks->fetchAll();

        $i = 0;
        $first_group = null;
        $sum_grupo_adults = 0;
        $sum_grupo_childs = 0;
        $sum_total_adults = 0;
        $sum_total_childs = 0;
        $nombre_grupo = '';

        foreach($tickets_parks as $park){
            if($i == 0){
                $first_group = $park['id_grupo_parques'];
                $nombre_grupo = $park['nombre_grupo'];
            }
            if($first_group != $park['id_grupo_parques']){
                $html .= '<tr>
                    <td class="title">'.$nombre_grupo.'</td>
                    <td class="title">'.$sum_grupo_adults.'</td>
                    <td class="title">'.$sum_grupo_childs.'</td>
                    <td class="title">'.($sum_grupo_adults + $sum_grupo_childs).'</td>
                </tr>';

                $first_group = $park['id_grupo_parques'];
                $nombre_grupo = $park['nombre_grupo'];

                $sum_grupo_adults = 0;
                $sum_grupo_childs = 0;
            }

            if(!$park['tickets_adults']){
                $park['tickets_adults'] = 0;
            }

            if(!$park['tickets_childs']){
                $park['tickets_childs'] = 0;
            }
            $html .= '<tr>
                <td>'.$park['nombre'].'</td>
                <td>'.$park['tickets_adults'].'</td>
                <td>'.$park['tickets_childs'].'</td>
                <td>'.($park['tickets_adults'] + $park['tickets_childs']).'</td>
            </tr>';

            $sum_grupo_adults += $park['tickets_adults'];
            $sum_grupo_childs += $park['tickets_childs'];
            $sum_total_adults += $park['tickets_adults'];
            $sum_total_childs += $park['tickets_childs'];
            $i += 1;
        }
        $html .= '<tr>
            <td class="title">'.$nombre_grupo.'</td>
            <td class="title">'.$sum_grupo_adults.'</td>
            <td class="title">'.$sum_grupo_childs.'</td>
            <td class="title">'.($sum_grupo_adults + $sum_grupo_childs).'</td>
        </tr>';
        $html .= '<tr>
            <td class="title">Total</td>
            <td class="title">'.$sum_total_adults.'</td>
            <td class="title">'.$sum_total_childs.'</td>
            <td class="title">'.($sum_total_adults + $sum_total_childs).'</td>
        </tr>';

        $html .= '</tbody>';

        $html.='</table></div></body>';

//        echo $html;
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Total tickets '.$fecha_inicio.' to '.$fecha_final,$html,false,'letter','letter');
        $pdf->doPDF();
    }

    public function total_service_by_client(){
        //TODO: crear pagina para que el usuario seleccione las fechas
        $id_cliente = $this->params['id_cliente'];

        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">Services by client</h3>
                </div>
            </div>

        </div>';


        /* Tour */
        $client = new Clientes(array('id'=>$id_cliente));
        $client = $client->getOne();

        $html .= '<h4>'.$client->firstname.' '.$client->lastname.'</h4>';
        $sql_tours = "select tours.id_client, clientes.firstname, clientes.lastname, tours.totalouta, tours.length_day, tours.length_nights, tours.code_conf
                        from tours
                        left join clientes
                        on clientes.id=tours.id_client
                        where tours.id_client = ?";
        $tours = $this->db()->query($sql_tours, array($client->id));
        $tours = $tours->fetchAll();
        $html .= '<table class="grid" style="width: 600px;">
        <thead>
            <tr>
                <th colspan="4" style="text-align: left; padding-left: 10px;">
                    Tours ( '.sizeof($tours).' )
                </th>
            </tr>
            <tr>
                <th>Code</th>
                <th>Days</th>
                <th>Nights</th>
                <th>Total Payment</th>
            </tr>
        </thead>
        <tbody>';



        foreach($tours as $tour){
            $html .= '<tr>
                <td>'.$tour['code_conf'].'</td>
                <td>'.$tour['length_day'].'</td>
                <td>'.$tour['length_nights'].'</td>
                <td>'.number_format($tour['totalouta'], 2, '.', '').'</td>
            </tr>';
        }

        $html .= '</tbody></table>';
        /*One day*/
        $sql_tours = "select tours_oneday.totalouta, tours_oneday.length_day, tours_oneday.length_nights, tours_oneday.code_conf
                        from tours_oneday
                        left join clientes
                        on clientes.id=tours_oneday.id_client
                        where tours_oneday.id_client = ?;";
        $tours = $this->db()->query($sql_tours, array($client->id));
        $tours = $tours->fetchAll();

        $html .= '<table class="grid" style="width: 600px;">
        <thead>
            <tr>
                <th colspan="4" style="text-align: left; padding-left: 10px;">
                    Oneday ( '.sizeof($tours).' )
                </th>
            </tr>
            <tr>
                <th>Code</th>
                <th>Days</th>
                <th>Nights</th>
                <th>Total Payment</th>
            </tr>
        </thead>
        <tbody>';


        foreach($tours as $tour){
            $html .= '<tr>
                <td>'.$tour['code_conf'].'</td>
                <td>'.$tour['length_day'].'</td>
                <td>'.$tour['length_nights'].'</td>
                <td>'.number_format($tour['totalouta'], 2, '.', '').'</td>
            </tr>';
        }

        $html .= '</tbody></table>';

        $sql_tours = "select reservas.totaltotal, reservas.fromt, reservas.tot, reservas.fromt2, reservas.tot2,
                       reservas.codconf, areasfromt.nombre as fromt_nombre, areastot.nombre as tot_nombre,
                       areasfromt2.nombre as fromt2_nombre, areastot2.nombre as tot2_nombre
                        from reservas
                        left join areas as areasfromt
                        on areasfromt.id=reservas.fromt
                        left join areas as areasfromt2
                        on areasfromt2.id=reservas.fromt2
                        left join areas as areastot
                        on areastot.id=reservas.tot
                        left join areas as areastot2
                        on areastot2.id=reservas.tot2
                        where reservas.id_clientes = ? and (reservas.estado = 'CONFIRMED' or reservas.estado = 'INVOICED') and reservas.id_tours = -1;";
        $tours = $this->db()->query($sql_tours, array($client->id));
        $tours = $tours->fetchAll();

        $html .= '<table class="grid" style="width: 600px;">
        <thead>
            <tr>
                <th colspan="1" style="text-align: left; padding-left: 10px;">
                    Transport ( '.sizeof($tours).' )
                </th>
                <th>From</th>
                <th>From</th>
                <th></th>

            </tr>
            <tr>
                <th>Code</th>
                <th>To</th>
                <th>To</th>
                <th>Total Payment</th>
            </tr>
        </thead>
        <tbody>';


        foreach($tours as $tour){
            $html .= '<tr>
                <td rowspan="2">'.$tour['codconf'].'</td>
                <td>'.$tour['fromt_nombre'].'</td>
                <td>'.$tour['fromt2_nombre'].'</td>
                <td rowspan="2">'.number_format($tour['totaltotal'], 2, '.', '').'</td>
            </tr>';
            $html .= '<tr>
                <td>'.$tour['tot_nombre'].'</td>
                <td>'.$tour['tot2_nombre'].'</td>
            </tr>';

        }

        $html .= '</tbody></table>';
        $html.='</div></body>';

//        echo $html;
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Service by client '.$client->firstname.' '.$client->lastname,$html,false,'letter','letter');
        $pdf->doPDF();
    }

    public function transfer_services_report(){
        //TODO: crear pagina para que el usuario seleccione las fechas
        $fecha_inicio = $this->params['fecha_inicio'];
        $fecha_final = $this->params['fecha_final'];

        $html = '<head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">Transfer Services</h3>
                <span>'.$fecha_inicio.' / '.$fecha_final.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 600px;">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Total Payment</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>';


//        $sql = "select reservas.codconf, reservas.id_clientes, reservas.totaltotal, reservas.tipo_pago,
//                  reservas.fecha_salida, reservas.estado, reservas.fecha_salida, reservas.firsname, reservas.lasname
//                  from reservas
//                  where (reservas.codconf like 'R%' and reservas.tipo_pago = 'COLLECT ON BOARD' and reservas.estado = 'QUOTE')
//                        and (reservas.fecha_salida >= ? and reservas.fecha_salida <= ?)";
//        $query = $this->db()->query($sql, array($fecha_inicio, $fecha_final));
//        $query_fetch = $query->fetchAll();

        $total_payment = 0;
        $total_amount = 0;
        /* VIP */
        $sql_transfer_in_payment = "select  sum(transfer.total_price) as total
                                          from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_in
                                          where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";
        $total_tranfer_in_payment = $this->db()->query($sql_transfer_in_payment, array('VIP', $fecha_inicio, $fecha_final));
        $total_tranfer_in_payment = $total_tranfer_in_payment->fetchAll();
        $total_tranfer_in_payment = $total_tranfer_in_payment[0]['total'];

        $sql_transfer_out_payment = "select sum(transfer.total_price) as total
                                            from tours
                                              left join transfer
                                                on transfer.id=tours.id_transfer_out
                                            where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";

        $total_tranfer_out_payment = $this->db()->query($sql_transfer_out_payment, array('VIP', $fecha_inicio, $fecha_final));
        $total_tranfer_out_payment = $total_tranfer_out_payment->fetchAll();
        $total_tranfer_out_payment = $total_tranfer_out_payment[0]['total'];

        $total_transfer_vip_payment = $total_tranfer_in_payment + $total_tranfer_out_payment;


        $sql_transfer_in_count = "select count(*) as total
                                        from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_in
                                        where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";
        $total_tranfer_in_count = $this->db()->query($sql_transfer_in_count, array('VIP', $fecha_inicio, $fecha_final));
        $total_tranfer_in_count = $total_tranfer_in_count->fetchAll();
        $total_tranfer_in_count = $total_tranfer_in_count[0]['total'];

        $sql_transfer_out_count = "select count(*) as total
                                        from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_out
                                        where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";

        $total_tranfer_out_count = $this->db()->query($sql_transfer_out_count, array('VIP', $fecha_inicio, $fecha_final));
        $total_tranfer_out_count = $total_tranfer_out_count->fetchAll();
        $total_tranfer_out_count = $total_tranfer_out_count[0]['total'];

        $total_transfer_vip_count = $total_tranfer_in_count + $total_tranfer_out_count;

        $total_payment += $total_transfer_vip_payment;
        $total_amount += $total_transfer_vip_count;

        $html .= '<tr>
                <td class="title">VIP</td>
                <td>$ '.$total_transfer_vip_payment.'</td>
                <td>'.$total_transfer_vip_count.'</td>
            </tr>';


        /* Airport */
        $sql_transfer_in_payment = "select  sum(transfer.total_price) as total
                                          from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_in
                                          where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";
        $total_tranfer_in_payment = $this->db()->query($sql_transfer_in_payment, array('PLANE', $fecha_inicio, $fecha_final));
        $total_tranfer_in_payment = $total_tranfer_in_payment->fetchAll();
        $total_tranfer_in_payment = $total_tranfer_in_payment[0]['total'];

        $sql_transfer_out_payment = "select sum(transfer.total_price) as total
                                            from tours
                                              left join transfer
                                                on transfer.id=tours.id_transfer_out
                                            where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";

        $total_tranfer_out_payment = $this->db()->query($sql_transfer_out_payment, array('PLANE', $fecha_inicio, $fecha_final));
        $total_tranfer_out_payment = $total_tranfer_out_payment->fetchAll();
        $total_tranfer_out_payment = $total_tranfer_out_payment[0]['total'];

        $total_transfer_vip_payment = $total_tranfer_in_payment + $total_tranfer_out_payment;


        $sql_transfer_in_count = "select count(*) as total
                                        from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_in
                                        where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";
        $total_tranfer_in_count = $this->db()->query($sql_transfer_in_count, array('PLANE', $fecha_inicio, $fecha_final));
        $total_tranfer_in_count = $total_tranfer_in_count->fetchAll();
        $total_tranfer_in_count = $total_tranfer_in_count[0]['total'];

        $sql_transfer_out_count = "select count(*) as total
                                        from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_out
                                        where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";

        $total_tranfer_out_count = $this->db()->query($sql_transfer_out_count, array('PLANE', $fecha_inicio, $fecha_final));
        $total_tranfer_out_count = $total_tranfer_out_count->fetchAll();
        $total_tranfer_out_count = $total_tranfer_out_count[0]['total'];

        $total_transfer_vip_count = $total_tranfer_in_count + $total_tranfer_out_count;

        $total_payment += $total_transfer_vip_payment;
        $total_amount += $total_transfer_vip_count;

        $html .= '<tr>
                <td class="title">Airport</td>
                <td>$ '.$total_transfer_vip_payment.'</td>
                <td>'.$total_transfer_vip_count.'</td>
            </tr>';

        /* By car */
        $sql_transfer_in_payment = "select  sum(transfer.total_price) as total
                                          from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_in
                                          where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";
        $total_tranfer_in_payment = $this->db()->query($sql_transfer_in_payment, array('CAR', $fecha_inicio, $fecha_final));
        $total_tranfer_in_payment = $total_tranfer_in_payment->fetchAll();
        $total_tranfer_in_payment = $total_tranfer_in_payment[0]['total'];

        $sql_transfer_out_payment = "select sum(transfer.total_price) as total
                                            from tours
                                              left join transfer
                                                on transfer.id=tours.id_transfer_out
                                            where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";

        $total_tranfer_out_payment = $this->db()->query($sql_transfer_out_payment, array('CAR', $fecha_inicio, $fecha_final));
        $total_tranfer_out_payment = $total_tranfer_out_payment->fetchAll();
        $total_tranfer_out_payment = $total_tranfer_out_payment[0]['total'];

        $total_transfer_vip_payment = $total_tranfer_in_payment + $total_tranfer_out_payment;


        $sql_transfer_in_count = "select count(*) as total
                                        from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_in
                                        where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";
        $total_tranfer_in_count = $this->db()->query($sql_transfer_in_count, array('CAR', $fecha_inicio, $fecha_final));
        $total_tranfer_in_count = $total_tranfer_in_count->fetchAll();
        $total_tranfer_in_count = $total_tranfer_in_count[0]['total'];

        $sql_transfer_out_count = "select count(*) as total
                                        from tours
                                          left join transfer
                                            on transfer.id=tours.id_transfer_out
                                        where transfer.type_transfer = ? and (tours.starting_date>=? and tours.starting_date <=?) and (tours.estado = 'INVOICED' or tours.estado = 'CONFIRMED');";

        $total_tranfer_out_count = $this->db()->query($sql_transfer_out_count, array('CAR', $fecha_inicio, $fecha_final));
        $total_tranfer_out_count = $total_tranfer_out_count->fetchAll();
        $total_tranfer_out_count = $total_tranfer_out_count[0]['total'];

        $total_transfer_vip_count = $total_tranfer_in_count + $total_tranfer_out_count;

        $total_payment += $total_transfer_vip_payment;
        $total_amount += $total_transfer_vip_count;

        $html .= '<tr>
                <td class="title">By car</td>
                <td>$ '.$total_transfer_vip_payment.'</td>
                <td>'.$total_transfer_vip_count.'</td>
            </tr>';

        $html .= '<tr>
                <td class="title">Total</td>
                <td class="title">$ '.$total_payment.'</td>
                <td class="title">'.$total_amount.'</td>
            </tr>';



//        $html .= '<tr>
//                <td class="title">Total</td>
//                <td class="title">'.$sum_websale.'</td>
//                <td class="title">'.$sum_phone.'</td>
//                <td class="title">'.$sum_mail.'</td>
//                <td class="title">'.($sum_websale + $sum_phone + $sum_mail).'</td>
//            </tr>';

        $html .= '</tbody>';

        $html.='</table></div></body>';

        /*echo $html;*/
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Transfer Services '.$fecha_inicio.' to '.$fecha_final,$html,false,'letter','letter');
        $pdf->doPDF();
    }

    public function hotel_services_report(){
        //TODO: crear pagina para que el usuario seleccione las fechas
        $fecha_inicio = $this->params['fecha_inicio'];
        $fecha_final = $this->params['fecha_final'];

        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">Hotel Services</h3>
                <span>'.$fecha_inicio.' / '.$fecha_final.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 90%;">
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Single</th>
                    <th>Double</th>
                    <th>Triple</th>
                    <th>Quadrupel</th>
                    <th>Buffet</th>
                    <th>Total Paid</th>
                </tr>
            </thead>
            <tbody>';

        $hoteles = new Hoteles();
        $hoteles = $hoteles->find();

        foreach($hoteles as $hotel){
            $sql_reserves = "select hotel_reserves.*
              from hotel_reserves
              where (hotel_reserves.starting_date>=? and hotel_reserves.starting_date <=?) and hotel_reserves.id_hotel = ?;";
            $reserves = $this->db()->query($sql_reserves, array($fecha_inicio, $fecha_final, $hotel->id));
            $reserves = $reserves->fetchAll();
            $total_single = 0;
            $total_double = 0;
            $total_triple = 0;
            $total_quadruple = 0;
            $total_paid = 0;
            $total_buffet = 0;
            foreach($reserves as $reserve){
                $tours = new ToursController();
                $tipos = $tours->tipoHabitacion($reserve['room1_adult'], $reserve['room2_adult'], $reserve['room3_adult'], $reserve['room3_adult']);
                $total_single += $tipos['sgl'];
                $total_double += $tipos['dbl'];
                $total_triple += $tipos['tpl'];
                $total_quadruple += $tipos['qua'];
                $total_paid += $reserve['total_paid'];
                if($reserve['buffet']){
                    $total_buffet += 1;
                }
            }
            $html .= '<tr>
                <td>'.$hotel->nombre.'</td>
                <td>'.$total_single.'</td>
                <td>'.$total_double.'</td>
                <td>'.$total_triple.'</td>
                <td>'.$total_quadruple.'</td>
                <td>'.$total_buffet.'</td>
                <td>'.$total_paid.'</td>
            </tr>';

        }

        $html .= '</tbody>';

        $html.='</table></div></body>';

//        echo $html;
        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Hotel Services '.$fecha_inicio.' to '.$fecha_final,$html,false,'letter','landscape');
        $pdf->doPDF();
    }

    public function comission_refunds(){
        $fini = $this->params['fecha_inicio'];
        $ffin = $this->params['fecha_fin'];
        $sql0 = "select * from((select a.id,r.totaltotal as totalf, r.total2 as totals, a.company_name, IF(IF(IFNULL(ra.id,0) = 0,'NO','YES')='YES',IF((r.totaltotal - r.total2) >0,'COMISSION','REFUND'),'NO') as type,
                    r.codconf as code, IFNULL(ra.comision,0) as fee
                    from reservas as r
                      inner join agencia as a on (r.agency = a.id)
                      left join reservas_agency as ra on (ra.id_reservas = r.id)
                    where r.estado != 'QUOTE' and r.estado != 'CANCELED' and r.fecha_ini >=? and r.fecha_ini < ? and r.tipo_pago !='FREE SERVICES')
                    union all
                    (select a.id,t.totalouta as totalf,t.total as totals, a.company_name, IF(IF(IFNULL(ta.id,0) = 0,'NO','YES')='YES',IF(((t.totalouta - t.total) > 0) and a.type_rate = 0 ,'COMISSION','REFUND'),'NO') as type,
                    t.code_conf as code, IFNULL(ta.comision,0) as fee
                    from tours as t
                      inner join agencia as a on (t.id_agency = a.id)
                      left join tours_agency as ta on (ta.id_tours = t.id and ta.type_tour='MULTI')
                    where t.estado != 'QUOTE' and t.estado != 'CANCELED' and t.tipo_pago != 'FREE SERVICES' and t.starting_date >=? and t.starting_date < ?)
                    union all(
                    select a.id,ton.totalouta as totalf, ton.total as totals, a.company_name, IF(IF((ton.totalouta - ton.total > 0 ),'YES','NO') = 'YES',IF(a.type_rate = 0,'COMISSION','REFUND'),'NO') as type,
                    ton.code_conf as code, '15' as fee
                    from tours_oneday as ton
                      inner join agencia as a on (ton.id_agency = a.id)
                      left join reservas as r on (ton.id_reserva = r.id)
                    where ton.estado != 'QUOTE' and ton.estado != 'CANCELED' and r.tipo_pago!= 'FREE SERVICES' and r.tipo_pago not like '7%'
                    and ton.starting_date >=? and ton.starting_date < ?)) as result order by company_name;";
        $q0 = Doo::db()->query($sql0,array($fini,$ffin,$fini,$ffin,$fini,$ffin));
        $rs0= $q0->fetchAll();

        $html = '
        <head>
        <style>
            .grid thead th, .grid-body th {
                text-align: center;
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height: 25px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #666666;
            }
            table{
                margin: 2px auto;
            }
            tr{
                text-align: justify;
            }
            #header{
                height:200px;
            }
            #container{
                margin:auto;

            }
            .borderon{
                border-top: 1px solid #195fc7 !important;
                padding-right: 10px !important;
                border-top-right-radius: 15px;
            }
            .totals{
                text-align:right;
                font-style: italic;
                padding: 5px 0px;
            }
            .title{
                background-color:#195fc7;
                border-radius: 5px;
                color:white;
            }
            p{
                font-weight: bolder;
            }
            .todown{
                margin-bottom:10px;
            }
        </style>
        </head>
        <body>
        <div id="container">
        <div id="header">
            <img src="'.Doo::conf()->APP_URL.'global/img/admin/logo.png" style="display:inline-block">
            <div style="display:inline-block; padding-left:45px;">
                <p>Supertours of Orlando</p>
                        <blockquote>ORLANDO CROSSING MALL, 5419<br>International Drive<br><small>ORLANDO,FL. 32819</small></blockquote>
                <div class="todown">

                <h3 style="margin-bottom: 0px;">COMISSIONS AND REFUNDS</h3>
                <span>'.$fini.' / '.$ffin.'</span>
                </div>
            </div>

        </div>
        <table class="grid" style="width: 90%;">
            <thead>
                <tr>
                    <th style="width:40%">Company Name</th>
                    <th>Type</th>
                    <th>Total Sv.</th>
                    <th>Collected</th>
                    <th>Amount</th>
                    <th>Cod. Conf.</th>
                </tr>
            </thead>
            <tbody>';
            $total = 0;
            $i = -1;
            $count = 0;
            $cname = '';
            foreach($rs0 as $service){
                if($service['type'] != 'NO'){
                    if(intval($i) == -1){
                       $cname = $service['company_name'];
                       $i = $service['id'];
                    }else{
                        if($service['id'] != $i){
                            $html.='<tr><td colspan="4" class="title">'.$cname.'</td><td><b>$ '.number_format($count,2).'</b></td><td class="title"></td></tr>';
                            $i = $service['id'];
                            $count = 0;
                            $cname = $service['company_name'];
                        }
                    }
                    $html.='<tr>
                            <td>'.$service['company_name'].'</td>
                            <td>'.$service['type'].'</td>
                            <td>'.$service['totals'].'</td>
                            <td>'.$service['totalf'].'</td>
                            <td>$ '.(floatval($service['totalf'] - floatval($service['totals']))).'</td>
                            <td>'.$service['code'].'</td>
                            </tr>';
                    $total+= floatval($service['totalf'] - floatval($service['totals']));
                    $count+= floatval($service['totalf'] - floatval($service['totals']));
                }
            }
        $html.='<tr><td colspan="4" class="title">'.$cname.'</td><td><b>$ '.number_format($count,2).'</b></td><td class="title"></td></tr>';
        $html.='<tr>
                <td class="title" colspan="4"><b>Total</b></td>
                <td><b>$'.$total.'</b></td>
                <td class="title"></td>
                </tr>';


        Doo::loadHelper('DooPDF');
        $pdf = new DooPDF('Coms and refunds '.$fini.' to '.$ffin,$html,false,'letter','landscape');
        $pdf->doPDF();

    }

    public function reports_index(){
        $data['content'] = 'report_index.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);
    }

}