<?php

DOO::loadController('I18nController');
DOO::loadModel('Traffic');
DOO::loadModel('TrafficBus');
DOO::loadModel('Parques');
DOO::loadModel('Attraction_Trafic');
DOO::loadModel('Tours');
DOO::loadModel('Tour_oneday');
DOO::loadModel('Transfer');
DOO::loadModel('Reserve');
DOO::loadModel('Driver');
DOO::loadModel('Agency');
DOO::loadModel('Routes');

class TrafficController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }
    private $sql_all_tour_1 = "(select tours.id, tours.code_conf, tours.id_client, clientes.firstname, clientes.lastname,
                                tours.starting_date, tours.ending_date, tours.adult, tours.child, 'MULTI' as type,  
                                hoteles.nombre as nombre_hotel,  agencia.company_name as customer, agencia.type_rate,
                                tours.length_day as days, tours.length_nights as nights, tours.total as total, tours.tipo_pago as tipo_pago,
                                transfer_in.type_transfer as transfer_in, transfer_out.type_transfer as transfer_out, tours.id_reserva,tours.estado,
                                tours.totalouta AS totaltotal, tours.otheramount AS otheramount, tours.total AS total2
                                from tours
                               left join clientes
                                 on clientes.id=tours.id_client
                               left join hotel_reserves
                                 on hotel_reserves.id=tours.id_hotel_reserve
                               left join hoteles
                                 on hotel_reserves.id_hotel=hoteles.id
                               left join agencia
                                 on agencia.id=tours.id_agency
                               left join transfer as transfer_in
                                 on transfer_in.id=tours.id_transfer_in
                               left join transfer as transfer_out
                                 on transfer_out.id=tours.id_transfer_out
                                 
                            where tours.starting_date =? and tours.ending_date >= ? AND tours.estado = 'CONFIRMED')
                            union
                            (select tours_oneday.id, tours_oneday.code_conf, tours_oneday.id_client, clientes.firstname, clientes.lastname, tours_oneday.starting_date, tours_oneday.ending_date,
                            tours_oneday.adult, tours_oneday.child, 'ONE' as type, 'One Day Tour' as nombre_hotel, agencia.company_name as customer, agencia.type_rate, tours_oneday.length_day as days, tours_oneday.length_nights as nights,
                            tours_oneday.total as total, reservas.tipo_pago as tipo_pago,  transfer_in.type_transfer as transfer_in, transfer_out.type_transfer as transfer_out, tours_oneday.id_reserva,tours_oneday.estado,tours_oneday.totalouta AS totaltotal,
                            tours_oneday.otheramount AS otheramount,
                            tours_oneday.total AS total2
                            from tours_oneday
                            left join clientes
                            on clientes.id=tours_oneday.id_client
                            left join agencia
                            on agencia.id=tours_oneday.id_agency
                            left join reservas
                            on reservas.id=tours_oneday.id_reserva
                            LEFT JOIN transfer AS transfer_in ON transfer_in.id=tours_oneday.id_transfer_in
                            LEFT JOIN transfer AS transfer_out ON transfer_out.id=tours_oneday.id_transfer_out
                            where tours_oneday.starting_date = ? and tours_oneday.ending_date >= ? AND tours_oneday.estado = 'CONFIRMED')
                            union
                            (select reservas.id, reservas.codconf as code_conf, reservas.id_clientes as id_client, clientes.firstname, clientes.lastname, reservas.fecha_salida as starting_date, reservas.fecha_retorno as ending_date,
                            reservas.pax as adult, reservas.pax2 as child, 'RESERVE' as type, reservas.tipo_ticket as nombre_hotel, agencia.company_name as customer, agencia.type_rate, '' as days, '' as nights,
                            reservas.totaltotal as total, reservas.tipo_pago as tipo_pago, '' as transfer_in, '' as transfer_out, reservas.id as id_reserva,reservas.estado,reservas.totaltotal AS totaltotal,
                            reservas.otheramount AS otheramount,
                            reservas.total2 AS total2
                            from reservas
                            left join clientes
                            on clientes.id=reservas.id_clientes
                            left join agencia
                            on agencia.id=reservas.agency
                            where (reservas.fecha_salida=? and reservas.fecha_retorno>=?) and (reservas.type_tour = '') AND reservas.estado = 'CONFIRMED' )  ORDER BY lastname ASC;";
    
    private $sql_all_tour = "(select tours.id, tours.code_conf, tours.id_client, clientes.firstname, clientes.lastname, tours.starting_date, tours.ending_date,
                               tours.adult, tours.child, 'MULTI' as type,  hoteles.nombre as nombre_hotel,  agencia.company_name as customer, agencia.type_rate, tours.length_day as days, tours.length_nights as nights,
                                                         tours.total as total, tours.tipo_pago as tipo_pago, transfer_in.type_transfer as transfer_in, transfer_out.type_transfer as transfer_out, tours.id_reserva,tours.estado,
          tours.totalouta AS totaltotal,
          tours.otheramount AS otheramount,
          tours.total AS total2
                             from tours
                               left join clientes
                                 on clientes.id=tours.id_client
                               left join hotel_reserves
                                 on hotel_reserves.id=tours.id_hotel_reserve
                               left join hoteles
                                 on hotel_reserves.id_hotel=hoteles.id
                               left join agencia
                                 on agencia.id=tours.id_agency
                               left join transfer as transfer_in
                                 on transfer_in.id=tours.id_transfer_in
                               left join transfer as transfer_out
                                 on transfer_out.id=tours.id_transfer_out
                                 
                            where tours.starting_date =? and tours.ending_date >= ? AND tours.estado = 'CONFIRMED')
                            union
                            (select tours_oneday.id, tours_oneday.code_conf, tours_oneday.id_client, clientes.firstname, clientes.lastname, tours_oneday.starting_date, tours_oneday.ending_date,
                            tours_oneday.adult, tours_oneday.child, 'ONE' as type, 'One Day Tour' as nombre_hotel, agencia.company_name as customer, agencia.type_rate, tours_oneday.length_day as days, tours_oneday.length_nights as nights,
                            tours_oneday.total as total, reservas.tipo_pago as tipo_pago,  transfer_in.type_transfer as transfer_in, transfer_out.type_transfer as transfer_out, tours_oneday.id_reserva,tours_oneday.estado,tours_oneday.totalouta AS totaltotal,
                            tours_oneday.otheramount AS otheramount,
                            tours_oneday.total AS total2
                            from tours_oneday
                            left join clientes
                            on clientes.id=tours_oneday.id_client
                            left join agencia
                            on agencia.id=tours_oneday.id_agency
                              left join reservas
                              on reservas.id=tours_oneday.id_reserva
                              LEFT JOIN transfer AS transfer_in ON transfer_in.id=tours_oneday.id_transfer_in
   LEFT JOIN transfer AS transfer_out ON transfer_out.id=tours_oneday.id_transfer_out
                            where tours_oneday.starting_date = ? and tours_oneday.ending_date >= ? AND tours_oneday.estado = 'CONFIRMED')
                            /*union
                            (select reservas.id, reservas.codconf as code_conf, reservas.id_clientes as id_client, clientes.firstname, clientes.lastname, reservas.fecha_salida as starting_date, reservas.fecha_retorno as ending_date,
                            reservas.pax as adult, reservas.pax2 as child, 'RESERVE' as type, reservas.tipo_ticket as nombre_hotel, agencia.company_name as customer, agencia.type_rate, '' as days, '' as nights,
                            reservas.totaltotal as total, reservas.tipo_pago as tipo_pago, '' as transfer_in, '' as transfer_out, reservas.id as id_reserva,reservas.estado,reservas.totaltotal AS totaltotal,
                            reservas.otheramount AS otheramount,
                            reservas.total2 AS total2
                            from reservas
                            left join clientes
                            on clientes.id=reservas.id_clientes
                            left join agencia
                            on agencia.id=reservas.agency
                            where (reservas.fecha_salida=? and reservas.fecha_retorno>=?) and (reservas.type_tour = '') AND reservas.estado = 'CONFIRMED' re) */ORDER BY lastname ASC;";
    
    private $sql_all_transp = "select reservas.id, reservas.codconf as code_conf, reservas.id_clientes as id_client, clientes.firstname, clientes.lastname, reservas.fecha_salida as starting_date, reservas.fecha_retorno as ending_date,
                            reservas.pax as adult, reservas.pax2 as child, 'RESERVE' as type, reservas.tipo_ticket as nombre_hotel, agencia.company_name as customer, agencia.type_rate, '' as days, '' as nights,
                            reservas.totaltotal as total, reservas.tipo_pago as tipo_pago, '' as transfer_in, '' as transfer_out, reservas.id as id_reserva,reservas.estado,reservas.totaltotal AS totaltotal,
                            reservas.otheramount AS otheramount,
                            reservas.total2 AS total2
                            from reservas
                            left join clientes
                            on clientes.id=reservas.id_clientes
                            left join agencia
                            on agencia.id=reservas.agency
                            where (reservas.fecha_salida=? and reservas.fecha_retorno>=?) and (reservas.type_tour = '') AND reservas.estado = 'CONFIRMED'  ORDER BY lastname ASC;";

    function index() {
        $data = array();

        if (isset($_POST['fecha_ini'])) {
            $fecha_recibida = $_POST['fecha_ini'];
            $div_fech_recibida = explode('-', $fecha_recibida);
            $select_date = getdate(mktime(0, 0, 0, $div_fech_recibida[0], $div_fech_recibida[1], $div_fech_recibida[2]));
        } else {

            if (isset($_SESSION['traffic_date'])) {
                $select_date = $_SESSION['traffic_date'];
            } else {
                $select_date = getdate();
            }
        }

        $_SESSION['traffic_date'] = $select_date;

        if ($select_date['mon'] <= 9) {
            $select_date['mon'] = "0$select_date[mon]";
        }

        if ($select_date['mday'] <= 9) {
            $select_date['mday'] = "0$select_date[mday]";
        }

        $fecha_recibida = "$select_date[mon]-$select_date[mday]-$select_date[year]";
        $select_date = "$select_date[year]-$select_date[mon]-$select_date[mday]";


//        echo $this->sql_all_tour_1;
//        echo "<br>";
//        echo $select_date;
//        exit;
                

        $all_tour = $this->db()->query($this->sql_all_tour_1, array($select_date, $select_date, $select_date, $select_date, $select_date, $select_date));
        $all_tour = $all_tour->fetchAll();
//        print_r(Doo::db()->showSQL());
//        exit;
        $drivers = $this->db()->query("select id, firstname, lastname from driver");
        $drivers = $drivers->fetchAll();

        $buses = $this->db()->query("select id, short_name, `name`, id_driver, type_bus, capacity  from traffic_bus");
        $buses = $buses->fetchAll();

        $type_tickets = $this->db()->query("select id, type, description from traffic_type_ticket");
        $type_tickets = $type_tickets->fetchAll();

        $parques = new Parques();
        $parques = $parques->find();

        $tours_with_traffic = array();
        for ($i = 0; $i < sizeof($all_tour); $i++) {
            $traffics = $this->generate_and_search_traffics($all_tour[$i]['id'], $all_tour[$i]['type']);
            $traffics = $traffics['traffics'];

            if (sizeof($traffics) > 0) {
                $tours_with_traffic[] = $all_tour[$i];
            }
        }

        $data['parques'] = $parques;


        $data['all_tours'] = $tours_with_traffic;
        $data['drivers'] = $drivers;
        $data['type_tickets'] = $type_tickets;
        $data['buses'] = $buses;
        $data['fecha_ini'] = $fecha_recibida;
        $data['date'] = $select_date;
        $data['content'] = 'traffic/index.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;


        $this->renderc('admin/index', $data, true);
    }

    function generate_and_search_traffics($id_tour, $type_tour, $solo_parques = false, $borra_nuevo = false) {
        Doo::db()->beginTransaction();
        try {

            $tour = null;
            if ($type_tour == 'MULTI') {
                $tour = new Tours();
            } else if ($type_tour == 'ONE') {
                $tour = new Tour_oneday();
            } else if ($type_tour == 'RESERVE') {
                $tour = new Reserve();
            }

            $tour->id = $id_tour;
            $tour = $tour->getOne();
            //print_r($tour);

            $traffics = new Traffic();
            $traffics->id_tour = $id_tour;
            $traffics->type_tour = $type_tour;
            // buscamos para ver si existe por lo menos un trafico para el tour
            $exists_traffic = $traffics->getOne();

            //print_r($exists_traffic);
            // Buscamos todos los dias disponibles para el tour
            if ($type_tour != 'RESERVE') {
                $ts1 = strtotime($tour->starting_date);
                $ts2 = strtotime($tour->ending_date);

                $div_start_date = explode('-', $tour->starting_date);
            } else {
                $ts1 = strtotime($tour->fecha_salida);
                $ts2 = strtotime($tour->fecha_retorno);

                $div_start_date = explode('-', $tour->fecha_salida);
            }
            //$start_date = getdate(mktime(0, 0, 0, $div_start_date[1], $div_start_date[2], $div_start_date[0]));
            $anno = $div_start_date[0];

            $seconds_diff = $ts2 - $ts1;
            $days = floor($seconds_diff / 3600 / 24);   #Dias del tour
            $dias = array();
            for ($j = 0; $j <= $days; $j++) {
                //echo '<br>';
                $dias_mas = $start_date[0] + (60 * 60 * 24 * $j);
                $dia = getdate($dias_mas);
                #$dias[] = "$fecha_final[mday]-$fecha_final[mon]-$fecha_final[year]";
                if ($dia['mon'] <= 9) {
                    $dia['mon'] = "0$dia[mon]";
                }
                if ($dia['mday'] <= 9) {
                    $dia['mday'] = "0$dia[mday]";
                }
                $dia = "$dia[year]-$dia[mon]-$dia[mday]";
                $dias[] = $dia;
            }

            // Si no existen trafico para el tour se crean
            if (!((bool) $exists_traffic) || $borra_nuevo == true) {
                //echo 'si';
                if ($borra_nuevo) {
                    $t_elimina = new Traffic();
                    $t_elimina->id_tour = $id_tour;
                    $t_elimina->delete();
                }
                $attraction_traffics = new Attraction_Trafic();
                $attraction_traffics->id_tours = $id_tour;
                $attraction_traffics->type_tour = $type_tour;
                $attraction_traffics->trafic = 1;
                $attraction_traffics = $attraction_traffics->find();

                /*
                 * Transfers type:
                 * 1: VIP
                 * 2: Airport
                 * 3: By car
                 *
                 * Reserva
                 *
                 * */
                $not_first_day_traffic_park = true;
                $defaul_name_hotel = 'Hotel';

                if ($type_tour != 'RESERVE') {
                    // Creamos el trafico para el transfer in
                    $from_first_traffic_park = null;
                    $time_am_first_traffic_park = '08:00:00';
                    if ($type_tour == 'ONE') {
                        $defaul_name_hotel = 'ONE DAY TOUR';
                    }


                    if ($tour->id_transfer_in > 0) {
                        $transer = new Transfer();
                        $transer->id = $tour->id_transfer_in;
                        $transer = $transer->getOne();

                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = '';
                        if ($transer->type == 2) {
                            $type_traffic = 'Transfer in VIP';
                            $traffic->from = "$transer->city $transer->address $transer->zipcode";
                        } elseif ($transer->type == 3) {
                            $type_traffic = 'Transfer in Airport';
                            $traffic->from = "Airport.Airline: $transer->airlie. Flight: $transer->flight.";
                        } elseif ($transer->type == 4) {
                            $type_traffic = 'Transfer in By car';
                        }

                        $traffic->type_traffic = $type_traffic;
                        if (strtotime($transer->arrival_time) <= strtotime('14:00:00')) {
                            $from_first_traffic_park = $traffic->from;
                            $time_am_first_traffic_park = $transer->arrival_time;
                        } else {
                            $not_first_day_traffic_park = false;
                        }
                        $traffic->time_am = $transer->arrival_time;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $tour->starting_date;
                        $hotel_name = $this->buscar_hotel($id_tour, $tour->starting_date, $tour->id_hotel_reserve);
                        $traffic->hotel_name = $hotel_name;
                        $traffic->to = 'Hotel';
                        $traffic->id_cliente = $tour->id_client;
                        $traffic->insert();
                    }

                    $from_out = 'Supertours Terminal';
                    // Creamos el trafico para el transfer out
                    if ($tour->id_transfer_out > 0) {
                        $transer = new Transfer();
                        $transer->id = $tour->id_transfer_out;
                        $transer = $transer->getOne();

                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = '';
                        if ($transer->type == 2) {
                            $type_traffic = 'Transfer out VIP';
                            $from_out = 'VIP';
                            $traffic->to = "$transer->city $transer->address $transer->zipcode";
                        } elseif ($transer->type == 3) {
                            $type_traffic = 'Transfer out Airport';
                            $from_out = 'Airport';
                            $traffic->to = "Airport.Airline: $transer->airlie. Flight: $transer->flight.";
                        } elseif ($transer->type == 4) {
                            $type_traffic = 'Transfer out By car';
                            $from_out = 'By car';
                        }

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $transer->arrival_time;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $tour->ending_date;
                        $hotel_name = $this->buscar_hotel($id_tour, $tour->ending_date, $tour->id_hotel_reserve);
                        $traffic->hotel_name = $hotel_name;

                        $traffic->from = 'Hotel';
                        $traffic->id_cliente = $tour->id_client;
                        $traffic->insert();
                    }

                    // Creamos el trafico para la reserva
                    if ($tour->id_reserva > 0) {
                        $reserve = new Reserve();
                        $reserve->id = $tour->id_reserva;
                        $reserve = $reserve->getOne();
                        $route = new Routes();
                        $route->trip_from = $reserve->fromt;
                        $route->trip_to = $reserve->fromt2;
                        $route->trip_no = $reserve->trip_no;
                        $route->anno = $anno;
                        $route = $route->getOne();

                        if ((bool) $route) {
                            if (strtotime($route->trip_arrival) <= strtotime('14:00:00')) {
                                $time_am_first_traffic_park = $route->trip_arrival;
                                $from_first_traffic_park = "Trip $route->trip_no";
                            } else {
                                $not_first_day_traffic_park = false;
                            }
                        }

                        // Creamos el trafico para la reserva de entrada (transfer in)
                        if ($reserve->extension1 > 0) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $type_traffic = 'Reserva in';

                            $traffic->type_traffic = $type_traffic;
                            $traffic->time_am = $reserve->deptime1;
                            $traffic->time_pm = '18:00:00';
                            $traffic->date = $tour->starting_date;
                            $hotel_name = $this->buscar_hotel($id_tour, $tour->starting_date, $tour->id_hotel_reserve);
                            $traffic->hotel_name = $hotel_name;

                            $traffic->from = $reserve->pickup_exten1;
                            $traffic->to = 'Hotel';
                            $traffic->id_cliente = $tour->id_client;
                            $traffic->insert();
                        }

                        // Creamos el trafico para la reserva de salida (transfer out)
                        if ($reserve->extension3 > 0) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $type_traffic = 'Reserva out';

                            $traffic->type_traffic = $type_traffic;
                            $traffic->time_am = $reserve->deptime1;
                            $traffic->time_pm = '18:00:00';
                            $traffic->date = $tour->starting_date;
                            $hotel_name = $this->buscar_hotel($id_tour, $tour->ending_date, $tour->id_hotel_reserve);
                            $traffic->hotel_name = $hotel_name;
                            $traffic->from = 'Hotel';
                            $traffic->to = $reserve->pickup_exten3;
                            $traffic->id_cliente = $tour->id_client;
                            $traffic->insert();
                        }
                    }

                    // Creamos un tour por cada attraction trafic
                    if ($not_first_day_traffic_park) {
                        $i = 0;
                    } else {
                        $i = 1;
                    }


                    foreach ($attraction_traffics as $attraction_traffic) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $traffic->time_am = '08:00:00';
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $dias[$i];

                        if ($type_tour == 'ONE') {
                            $traffic->from = 'Supertours Terminal';
                            $traffic->to = 'Supertours Terminal';
                            $traffic->hotel_name = 'ONE DAY TOUR';
                        } else {
                            $from = $this->buscar_hotel($id_tour, $dias[$i], $tour->id_hotel_reserve, 'Hotel');
                            $traffic->hotel_name = $from;


                            if ($i == 0 and (bool) $from_first_traffic_park) {
                                $traffic->from = $from_first_traffic_park;
                                $traffic->time_am = $time_am_first_traffic_park;
                            } else {
                                $traffic->from = $from;
                            }


                            if ($i == (sizeof($dias) - 1)) {
                                $traffic->to = $from_out;
                            } else {
                                $traffic->to = $from;
                            }
                        }

                        $traffic->id_cliente = $tour->id_client;
                        $traffic->type_traffic = 'PARK';
                        $traffic->id_attraction_trafic = $attraction_traffic->id;

                        $traffic->insert();

                        $i++;
                        if ((sizeof($dias) - 1) < $i) {
                            $i = 0;
                        }
                    }

                    $attraction_traffics = new Attraction_Trafic();
                    $attraction_traffics->id_tours = $id_tour;
                    $attraction_traffics->type_tour = $type_tour;
                    $attraction_traffics = $attraction_traffics->count();

                    $free_days = $tour->length_day - $attraction_traffics;
                    if ($free_days > 0) {
                        $inicio = $attraction_traffics;
                        for ($i = $inicio; $i < sizeof($dias); $i++) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $traffic->time_am = '08:00:00';
                            $traffic->time_pm = '18:00:00';
                            $traffic->type_traffic = 'FREE DAY';
                            $traffic->date = $dias[$i];
                            $from = $this->buscar_hotel($id_tour, $dias[$i], $tour->id_hotel_reserve, $defaul_name_hotel);
                            $traffic->from = $from;

                            if ($i == (sizeof($dias) - 1)) {
                                $traffic->to = $from_out;
                                $traffic->time_am = $time_am_first_traffic_park;
                            } else {
                                $traffic->to = $from;
                            }
                            $traffic->hotel_name = $from;
                            $traffic->id_cliente = $tour->id_client;


                            $traffic->insert();
                        }
                    }

                    $free_nights = $tour->length_nights - $attraction_traffics;
                    if ($free_nights > 0) {
                        $inicio = $attraction_traffics;
                        for ($i = $inicio; $i < (sizeof($dias) - 1); $i++) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $traffic->time_am = '08:00:00';
                            $traffic->time_pm = '18:00:00';
                            $traffic->type_traffic = 'ADD NIGHT';
                            $traffic->date = $dias[$i];
                            $from = $this->buscar_hotel($id_tour, $dias[$i], $tour->id_hotel_reserve, $defaul_name_hotel);
                            $traffic->hotel_name = $from;
                            $traffic->from = $from;

                            if ($i == (sizeof($dias) - 1)) {
                                $traffic->to = $from_out;
                            } else {
                                $traffic->to = $from;
                            }
                            $traffic->id_cliente = $tour->id_client;
                            $traffic->insert();
                        }
                    }
                } else {
                    $reserve = $tour;
                    // Creamos el trafico para la reserva de entrada (transfer in)
                    $defaul_name_hotel = 'RESERVE';
                    if ($reserve->extension1 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'One way pick up';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->deptime1;
                        $traffic->time_pm = $reserve->arrtime1;
                        $traffic->date = $reserve->fecha_salida;
                        $traffic->hotel_name = $defaul_name_hotel;

                        $traffic->from = $reserve->pickup_exten1;
                        $traffic->to = 'Supertours Terminal';
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }

                    if ($reserve->extension2 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'One way drop off';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->arrtime1;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $reserve->fecha_salida;
                        $traffic->hotel_name = $defaul_name_hotel;
                        $traffic->from = 'Supertours Terminal';
                        $traffic->to = $reserve->pickup_exten2;
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }

                    if ($reserve->extension3 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'Round trip pick up';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->deptime2;
                        $traffic->time_pm = $reserve->arrtime2;
                        $traffic->date = $reserve->fecha_retorno;
                        $traffic->hotel_name = $defaul_name_hotel;
                        $traffic->from = $reserve->pickup_exten3;
                        $traffic->to = 'Supertours Terminal';
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }

                    if ($reserve->extension4 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'Round trip drop off';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->arrtime2;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $reserve->fecha_retorno;
                        $traffic->hotel_name = $defaul_name_hotel;

                        $traffic->from = 'Supertours Terminal';
                        $traffic->to = $reserve->pickup_exten4;
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }
                }
            } else {
                
            }

            $filtro_parques = "";
            if ($solo_parques) {
                $filtro_parques = "and type_traffic='PARK'";
            }

            $sql_traffic_tour = "select traffic.id, traffic.id_tour, traffic.type_tour, traffic.date, traffic.time_am, traffic.time_pm, traffic.`from`, traffic.`to`, traffic.id_attraction_trafic, traffic.parking,
                              attraction_trafic.id_park, attraction_trafic.admission, parques.nombre as nombre_parque, traffic.id_cliente,
                              clientes.firstname, clientes.lastname,
                              traffic.id_bus_am, traffic.id_bus_pm, traffic.driver_am, traffic.driver_pm, traffic.type_ticket, traffic.type_traffic
                            from traffic
                              left join attraction_trafic
                                on attraction_trafic.id=traffic.id_attraction_trafic
                              left join parques
                                on attraction_trafic.id_park=parques.id
                              left join clientes
                                on traffic.id_cliente=clientes.id
                              where traffic.id_tour = ? and traffic.type_tour = ? $filtro_parques
                              order by traffic.date, traffic.time_am, traffic.time_pm asc;";
            $traffics_query = $this->db()->query($sql_traffic_tour, array($id_tour, $type_tour));



            $traffics_a = $traffics_query->fetchAll();

            $sql_extra_parks = "select attraction_trafic.id, parques.nombre as nombre_parque, attraction_trafic.admission, attraction_trafic.trafic, attraction_trafic.id_tours, attraction_trafic.type_tour
                              from attraction_trafic
                              left join parques
                                on parques.id=attraction_trafic.id_park
                              where id_tours=? and type_tour=? and attraction_trafic.trafic=0;";
            $attraction_traffics = $this->db()->query($sql_extra_parks, array($id_tour, $type_tour));

            $respuesta = array('traffics' => $traffics_a, 'dias' => $dias, 'extra_parks_without_traffic' => $attraction_traffics->fetchAll());
            Doo::db()->commit();
            return $respuesta;
        } catch (Exception $exc) {
            Doo::db()->rollBack();
            echo $exc->getTraceAsString();
        }
    }
    
        function search_tickets($id_tour, $type_tour, $solo_parques = false, $borra_nuevo = false) {
        Doo::db()->beginTransaction();
        try {

            $tour = null;
            if ($type_tour == 'MULTI') {
                $tour = new Tours();
            } else if ($type_tour == 'ONE') {
                $tour = new Tour_oneday();
            } else if ($type_tour == 'RESERVE') {
                $tour = new Reserve();
            }

            $tour->id = $id_tour;
            $tour = $tour->getOne();
//          print_r($tour);
//          exit();
            
                
            
            
            $traffics = new Traffic();
            $traffics->id_tour = $id_tour;
            $traffics->type_tour = $type_tour;
            // buscamos para ver si existe por lo menos un trafico para el tour
            $exists_traffic = $traffics->getOne();
            
           

            //print_r($exists_traffic);
            // Buscamos todos los dias disponibles para el tour
            if ($type_tour != 'RESERVE') {
                $ts1 = strtotime($tour->starting_date);
                $ts2 = strtotime($tour->ending_date);

                $div_start_date = explode('-', $tour->starting_date);
            } else {
                $ts1 = strtotime($tour->fecha_salida);
                $ts2 = strtotime($tour->fecha_retorno);

                $div_start_date = explode('-', $tour->fecha_salida);
            }
            //$start_date = getdate(mktime(0, 0, 0, $div_start_date[1], $div_start_date[2], $div_start_date[0]));
            $anno = $div_start_date[0];

            $seconds_diff = $ts2 - $ts1;
            $days = floor($seconds_diff / 3600 / 24);   #Dias del tour
            $dias = array();
            for ($j = 0; $j <= $days; $j++) {
                //echo '<br>';
                $dias_mas = $start_date[0] + (60 * 60 * 24 * $j);
                $dia = getdate($dias_mas);
                #$dias[] = "$fecha_final[mday]-$fecha_final[mon]-$fecha_final[year]";
                if ($dia['mon'] <= 9) {
                    $dia['mon'] = "0$dia[mon]";
                }
                if ($dia['mday'] <= 9) {
                    $dia['mday'] = "0$dia[mday]";
                }
                $dia = "$dia[year]-$dia[mon]-$dia[mday]";
                $dias[] = $dia;
            }

            // Si no existen trafico para el tour se crean
            if (!((bool) $exists_traffic) || $borra_nuevo == true) {
                //echo 'si';
                if ($borra_nuevo) {
                    $t_elimina = new Traffic();
                    $t_elimina->id_tour = $id_tour;
                    $t_elimina->delete();
                }
                $attraction_traffics = new Attraction_Trafic();
                $attraction_traffics->id_tours = $id_tour;
                $attraction_traffics->type_tour = $type_tour;
                $attraction_traffics->trafic = 1;
                $attraction_traffics = $attraction_traffics->find();

                /*
                 * Transfers type:
                 * 1: VIP
                 * 2: Airport
                 * 3: By car
                 *
                 * Reserva
                 *
                 * */
                $not_first_day_traffic_park = true;
                $defaul_name_hotel = 'Hotel';

                if ($type_tour != 'RESERVE') {
                    // Creamos el trafico para el transfer in
                    $from_first_traffic_park = null;
                    $time_am_first_traffic_park = '08:00:00';
                    if ($type_tour == 'ONE') {
                        $defaul_name_hotel = 'ONE DAY TOUR';
                    }


                    if ($tour->id_transfer_in > 0) {
                        $transer = new Transfer();
                        $transer->id = $tour->id_transfer_in;
                        $transer = $transer->getOne();

                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = '';
                        if ($transer->type == 2) {
                            $type_traffic = 'Transfer in VIP';
                            $traffic->from = "$transer->city $transer->address $transer->zipcode";
                        } elseif ($transer->type == 3) {
                            $type_traffic = 'Transfer in Airport';
                            $traffic->from = "Airport.Airline: $transer->airlie. Flight: $transer->flight.";
                        } elseif ($transer->type == 4) {
                            $type_traffic = 'Transfer in By car';
                        }

                        $traffic->type_traffic = $type_traffic;
                        if (strtotime($transer->arrival_time) <= strtotime('14:00:00')) {
                            $from_first_traffic_park = $traffic->from;
                            $time_am_first_traffic_park = $transer->arrival_time;
                        } else {
                            $not_first_day_traffic_park = false;
                        }
                        $traffic->time_am = $transer->arrival_time;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $tour->starting_date;
                        $hotel_name = $this->buscar_hotel($id_tour, $tour->starting_date, $tour->id_hotel_reserve);
                        $traffic->hotel_name = $hotel_name;
                        $traffic->to = 'Hotel';
                        $traffic->id_cliente = $tour->id_client;
                        $traffic->insert();
                    }

                    $from_out = 'Supertours Terminal';
                    // Creamos el trafico para el transfer out
                    if ($tour->id_transfer_out > 0) {
                        $transer = new Transfer();
                        $transer->id = $tour->id_transfer_out;
                        $transer = $transer->getOne();

                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = '';
                        if ($transer->type == 2) {
                            $type_traffic = 'Transfer out VIP';
                            $from_out = 'VIP';
                            $traffic->to = "$transer->city $transer->address $transer->zipcode";
                        } elseif ($transer->type == 3) {
                            $type_traffic = 'Transfer out Airport';
                            $from_out = 'Airport';
                            $traffic->to = "Airport.Airline: $transer->airlie. Flight: $transer->flight.";
                        } elseif ($transer->type == 4) {
                            $type_traffic = 'Transfer out By car';
                            $from_out = 'By car';
                        }

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $transer->arrival_time;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $tour->ending_date;
                        $hotel_name = $this->buscar_hotel($id_tour, $tour->ending_date, $tour->id_hotel_reserve);
                        $traffic->hotel_name = $hotel_name;

                        $traffic->from = 'Hotel';
                        $traffic->id_cliente = $tour->id_client;
                        $traffic->insert();
                    }

                    // Creamos el trafico para la reserva
                    if ($tour->id_reserva > 0) {
                        $reserve = new Reserve();
                        $reserve->id = $tour->id_reserva;
                        $reserve = $reserve->getOne();
                        $route = new Routes();
                        $route->trip_from = $reserve->fromt;
                        $route->trip_to = $reserve->fromt2;
                        $route->trip_no = $reserve->trip_no;
                        $route->anno = $anno;
                        $route = $route->getOne();

                        if ((bool) $route) {
                            if (strtotime($route->trip_arrival) <= strtotime('14:00:00')) {
                                $time_am_first_traffic_park = $route->trip_arrival;
                                $from_first_traffic_park = "Trip $route->trip_no";
                            } else {
                                $not_first_day_traffic_park = false;
                            }
                        }

                        // Creamos el trafico para la reserva de entrada (transfer in)
                        if ($reserve->extension1 > 0) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $type_traffic = 'Reserva in';

                            $traffic->type_traffic = $type_traffic;
                            $traffic->time_am = $reserve->deptime1;
                            $traffic->time_pm = '18:00:00';
                            $traffic->date = $tour->starting_date;
                            $hotel_name = $this->buscar_hotel($id_tour, $tour->starting_date, $tour->id_hotel_reserve);
                            $traffic->hotel_name = $hotel_name;

                            $traffic->from = $reserve->pickup_exten1;
                            $traffic->to = 'Hotel';
                            $traffic->id_cliente = $tour->id_client;
                            $traffic->insert();
                        }

                        // Creamos el trafico para la reserva de salida (transfer out)
                        if ($reserve->extension3 > 0) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $type_traffic = 'Reserva out';

                            $traffic->type_traffic = $type_traffic;
                            $traffic->time_am = $reserve->deptime1;
                            $traffic->time_pm = '18:00:00';
                            $traffic->date = $tour->starting_date;
                            $hotel_name = $this->buscar_hotel($id_tour, $tour->ending_date, $tour->id_hotel_reserve);
                            $traffic->hotel_name = $hotel_name;
                            $traffic->from = 'Hotel';
                            $traffic->to = $reserve->pickup_exten3;
                            $traffic->id_cliente = $tour->id_client;
                            $traffic->insert();
                        }
                    }

                    // Creamos un tour por cada attraction trafic
                    if ($not_first_day_traffic_park) {
                        $i = 0;
                    } else {
                        $i = 1;
                    }


                    foreach ($attraction_traffics as $attraction_traffic) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $traffic->time_am = '08:00:00';
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $dias[$i];

                        if ($type_tour == 'ONE') {
                            $traffic->from = 'Supertours Terminal';
                            $traffic->to = 'Supertours Terminal';
                            $traffic->hotel_name = 'ONE DAY TOUR';
                        } else {
                            $from = $this->buscar_hotel($id_tour, $dias[$i], $tour->id_hotel_reserve, 'Hotel');
                            $traffic->hotel_name = $from;


                            if ($i == 0 and (bool) $from_first_traffic_park) {
                                $traffic->from = $from_first_traffic_park;
                                $traffic->time_am = $time_am_first_traffic_park;
                            } else {
                                $traffic->from = $from;
                            }


                            if ($i == (sizeof($dias) - 1)) {
                                $traffic->to = $from_out;
                            } else {
                                $traffic->to = $from;
                            }
                        }

                        $traffic->id_cliente = $tour->id_client;
                        $traffic->type_traffic = 'PARK';
                        $traffic->id_attraction_trafic = $attraction_traffic->id;

                        $traffic->insert();

                        $i++;
                        if ((sizeof($dias) - 1) < $i) {
                            $i = 0;
                        }
                    }

                    $attraction_traffics = new Attraction_Trafic();
                    $attraction_traffics->id_tours = $id_tour;
                    $attraction_traffics->type_tour = $type_tour;
                    $attraction_traffics = $attraction_traffics->count();

                    $free_days = $tour->length_day - $attraction_traffics;
                    if ($free_days > 0) {
                        $inicio = $attraction_traffics;
                        for ($i = $inicio; $i < sizeof($dias); $i++) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $traffic->time_am = '08:00:00';
                            $traffic->time_pm = '18:00:00';
                            $traffic->type_traffic = 'FREE DAY';
                            $traffic->date = $dias[$i];
                            $from = $this->buscar_hotel($id_tour, $dias[$i], $tour->id_hotel_reserve, $defaul_name_hotel);
                            $traffic->from = $from;

                            if ($i == (sizeof($dias) - 1)) {
                                $traffic->to = $from_out;
                                $traffic->time_am = $time_am_first_traffic_park;
                            } else {
                                $traffic->to = $from;
                            }
                            $traffic->hotel_name = $from;
                            $traffic->id_cliente = $tour->id_client;


                            $traffic->insert();
                        }
                    }

                    $free_nights = $tour->length_nights - $attraction_traffics;
                    if ($free_nights > 0) {
                        $inicio = $attraction_traffics;
                        for ($i = $inicio; $i < (sizeof($dias) - 1); $i++) {
                            $traffic = new Traffic();
                            $traffic->id_tour = $id_tour;
                            $traffic->type_tour = $type_tour;
                            $traffic->time_am = '08:00:00';
                            $traffic->time_pm = '18:00:00';
                            $traffic->type_traffic = 'ADD NIGHT';
                            $traffic->date = $dias[$i];
                            $from = $this->buscar_hotel($id_tour, $dias[$i], $tour->id_hotel_reserve, $defaul_name_hotel);
                            $traffic->hotel_name = $from;
                            $traffic->from = $from;

                            if ($i == (sizeof($dias) - 1)) {
                                $traffic->to = $from_out;
                            } else {
                                $traffic->to = $from;
                            }
                            $traffic->id_cliente = $tour->id_client;
                            $traffic->insert();
                        }
                    }
                } else {
                    $reserve = $tour;
                    // Creamos el trafico para la reserva de entrada (transfer in)
                    $defaul_name_hotel = 'RESERVE';
                    if ($reserve->extension1 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'One way pick up';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->deptime1;
                        $traffic->time_pm = $reserve->arrtime1;
                        $traffic->date = $reserve->fecha_salida;
                        $traffic->hotel_name = $defaul_name_hotel;

                        $traffic->from = $reserve->pickup_exten1;
                        $traffic->to = 'Supertours Terminal';
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }

                    if ($reserve->extension2 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'One way drop off';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->arrtime1;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $reserve->fecha_salida;
                        $traffic->hotel_name = $defaul_name_hotel;
                        $traffic->from = 'Supertours Terminal';
                        $traffic->to = $reserve->pickup_exten2;
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }

                    if ($reserve->extension3 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'Round trip pick up';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->deptime2;
                        $traffic->time_pm = $reserve->arrtime2;
                        $traffic->date = $reserve->fecha_retorno;
                        $traffic->hotel_name = $defaul_name_hotel;
                        $traffic->from = $reserve->pickup_exten3;
                        $traffic->to = 'Supertours Terminal';
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }

                    if ($reserve->extension4 > 0) {
                        $traffic = new Traffic();
                        $traffic->id_tour = $id_tour;
                        $traffic->type_tour = $type_tour;
                        $type_traffic = 'Round trip drop off';

                        $traffic->type_traffic = $type_traffic;
                        $traffic->time_am = $reserve->arrtime2;
                        $traffic->time_pm = '18:00:00';
                        $traffic->date = $reserve->fecha_retorno;
                        $traffic->hotel_name = $defaul_name_hotel;

                        $traffic->from = 'Supertours Terminal';
                        $traffic->to = $reserve->pickup_exten4;
                        $traffic->id_cliente = $reserve->id_clientes;
                        $traffic->insert();
                    }
                }
            } else {
                
            }
            // on attraction_trafic.id=traffic.id_attraction_trafic

            $filtro_parques = "";
            if ($solo_parques) {
                $filtro_parques = "and type_traffic='PARK'";
            }

            $sql_traffic_tour = "select traffic.id, traffic.id_tour, traffic.type_tour, traffic.date, traffic.time_am, traffic.time_pm, traffic.`from`, traffic.`to`, traffic.id_attraction_trafic, traffic.parking,
                              attraction_trafic.id_park, attraction_trafic.admission, parques.nombre as nombre_parque, traffic.id_cliente,
                              clientes.firstname, clientes.lastname,
                              traffic.id_bus_am, traffic.id_bus_pm, traffic.driver_am, traffic.driver_pm, traffic.type_ticket, traffic.type_traffic
                            from traffic
                              left join attraction_trafic
                                on attraction_trafic.id=traffic.id_attraction_trafic
                              left join parques
                                on attraction_trafic.id_park=parques.id
                              left join clientes
                                on traffic.id_cliente=clientes.id
                              where traffic.id_tour = ? and traffic.type_tour = ? $filtro_parques
                              order by traffic.date, traffic.time_am, traffic.time_pm asc;";
            $traffics_query = $this->db()->query($sql_traffic_tour, array($id_tour, $type_tour));



            $traffics_a = $traffics_query->fetchAll();

            $sql_extra_parks = "select attraction_trafic.id, parques.nombre as nombre_parque, attraction_trafic.admission, attraction_trafic.trafic, attraction_trafic.id_tours, attraction_trafic.type_tour
                              from attraction_trafic
                              left join parques
                                on parques.id=attraction_trafic.id_park
                              where id_tours=? and type_tour=? and attraction_trafic.trafic=0;";
            $attraction_traffics = $this->db()->query($sql_extra_parks, array($id_tour, $type_tour));

            $respuesta = array('traffics' => $traffics_a, 'dias' => $dias, 'extra_parks_without_traffic' => $attraction_traffics->fetchAll());
            Doo::db()->commit();
            return $respuesta;
        } catch (Exception $exc) {
            Doo::db()->rollBack();
            echo $exc->getTraceAsString();
        }
    }

    function search_traffic($json = true) {
        // Obtenemos los datos del get
        $id_tour = $_GET['id_tour'];
        $type_tour = $_GET['type_tour'];
        $borrar_nuevo = $_GET['cambiar'];

        if ($borrar_nuevo != 1) {
            $respuesta = $this->generate_and_search_traffics($id_tour, $type_tour);
        } else {
            $respuesta = $this->generate_and_search_traffics($id_tour, $type_tour, false, true);
        }


        echo json_encode($respuesta);
    }

    function save_traffic() {
        
        $traffics = $_GET['data'];

        foreach ($traffics as $trafic) {
            $elementos = array($trafic['time_am'], $trafic['from'], $trafic['to'], $trafic['time_pm'], $trafic['date']);

            if ($trafic['bus_am'] == "") {
                $bus_am = "`id_bus_am` = NULL";
            } else {
                $bus_am = "`id_bus_am`=?";
                $elementos[] = $trafic['bus_am'];
            }

            if ($trafic['bus_pm'] == "") {
                $bus_pm = "`id_bus_pm` = NULL";
            } else {
                $bus_pm = "`id_bus_pm`=?";
                $elementos[] = $trafic['bus_pm'];
            }

            if ($trafic['driver_am'] == "") {
                $driver_am = "`driver_am` = NULL";
            } else {
                $driver_am = "`driver_am`=?";
                $elementos[] = $trafic['driver_am'];
            }

            if ($trafic['driver_pm'] == "") {
                $driver_pm = "`driver_pm` = NULL";
            } else {
                $driver_pm = "`driver_pm`=?";
                $elementos[] = $trafic['driver_pm'];
            }

            if ($trafic['type_ticket'] == "") {
                $type_ticket = "`type_ticket` = NULL";
            } else {
                $type_ticket = "`type_ticket`=?";
                $elementos[] = $trafic['type_ticket'];
            }

            if ($trafic['parking'] == "") {
                $parking = "`parking` = NULL";
            } else {
                $parking = "`parking`=?";
                $elementos[] = $trafic['parking'];
            }

            $elementos[] = $trafic['id_traffic'];

            $sql_update = "UPDATE traffic SET `time_am`=?, `from`=?, `to`=?, `time_pm`=?, date=?, $bus_am, $bus_pm, $driver_am, $driver_pm, $type_ticket, $parking WHERE id=?";
            $this->db()->query($sql_update, $elementos);
        }

        echo json_encode(array('num_registro' => sizeof($traffics), 'exito' => true));
    }

    function update_time_parks() {
        //print_r($_GET);
        $id_park = $_GET['park_to_update'];
        $time_am = $_GET['time_am'];
        $time_pm = $_GET['time_pm'];
        $days = $_GET['days_filter'];
        $nights = $_GET['nights_filter'];
        $date = $_GET['fecha_actual'];

        // actualizamos todos los traficos para el parque y dia seleccionados
        $sql_update_traffic_time_park = 'update traffic
                                          left join attraction_trafic
                                            on attraction_trafic.id=traffic.id_attraction_trafic
                                          left join tours
                                            on tours.id=traffic.id_tour
                                          left join tours_oneday
                                            on tours_oneday.id=traffic.id_tour
                                        set traffic.time_am=?, traffic.time_pm=?
                                        where (attraction_trafic.id_park=? and traffic.date=?) and ((tours.length_day=? and tours.length_nights=?) or (tours_oneday.length_day=? and tours_oneday.length_nights=?));
';
        $updates = $this->db()->query($sql_update_traffic_time_park, array($time_am, $time_pm, $id_park, $date, $days, $nights, $days, $nights));
        // buscamos el numero de filas afectadas
        $sql_count_traffic_time_park = 'select count(*)
                                        from traffic
                                          left join attraction_trafic
                                            on attraction_trafic.id=traffic.id_attraction_trafic
                                            left join tours
                                            on tours.id=traffic.id_tour
                                          left join tours_oneday
                                            on tours_oneday.id=traffic.id_tour
                                        where (attraction_trafic.id_park=? and traffic.date=?) and ((tours.length_day=? and tours.length_nights=?) or (tours_oneday.length_day=? and tours_oneday.length_nights=?));';
        $updates = $this->db()->query($sql_count_traffic_time_park, array($id_park, $date, $days, $nights, $days, $nights));
        $rows = $updates->fetchAll();

        echo json_encode(array('rows_updated' => $rows[0]['count(*)']));
    }

    function buscar_hotel($id_tour, $dia, $id_hotel_reserve, $name_hotel_default = 'Supertours Terminal') {
        // buscamos el hotel donde esta el cliente en el dia
        $sql_buscar_hotel = "select hotel_reserves.id_hotel, hoteles.nombre, hotel_reserves.starting_date, hotel_reserves.ending_date, hotel_reserves.id_tours
                                          from hotel_reserves
                                          left join hoteles
                                            on hoteles.id=hotel_reserves.id_hotel
                                        where hotel_reserves.id_tours=? and starting_date <=? and ending_date >= ?
                                        limit 1;";
        $hotel_cliente = $this->db()->query($sql_buscar_hotel, array($id_tour, $dia, $dia));
        $hotel_cliente = $hotel_cliente->fetchAll();
        //$from = 'Supertours Terminal';
        $from = $name_hotel_default;
        if ((bool) $hotel_cliente) {
            $from = $hotel_cliente[0]['nombre'];
        } else {
            // si no hay hoteles usamos el id de la reserva del hotel en el tours para ver si hay un hotel
            $sql_buscar_hotel = "select hotel_reserves.id_hotel, hoteles.nombre, hotel_reserves.starting_date, hotel_reserves.ending_date, hotel_reserves.id_tours
                                              from hotel_reserves
                                              left join hoteles
                                                on hoteles.id=hotel_reserves.id_hotel
                                            where hotel_reserves.id=?
                                            limit 1;";
            $hotel_cliente = $this->db()->query($sql_buscar_hotel, array($id_hotel_reserve));
            $hotel_cliente = $hotel_cliente->fetchAll();

            if ((bool) $hotel_cliente) {
                $from = $hotel_cliente[0]['nombre'];
            }
        }

        return $from;
    }

    function update_driver_bus() {
        //print_r($_GET);
        $id_driver = $_GET['driver_to_update'];
        $id_bus = $_GET['bus_to_update'];
        $date = $_GET['fecha_actual'];
        $time = $_GET['time_select'];

        $update_am = false;
        $update_pm = false;

        if ($time == 'all') {
            $update_am = true;
            $update_pm = true;
        } elseif ($time == 'am') {
            $update_am = true;
        } elseif ($time == 'pm') {
            $update_pm = true;
        }

        if ($update_am) {
            // actualizamos todos los traficos para el bus am y dia seleccionados
            $sql_update_traffic_driver_am = 'update traffic
    set driver_am=?
    where id_bus_am=? and `date`=?;';
            $updates = $this->db()->query($sql_update_traffic_driver_am, array($id_driver, $id_bus, $date));
        }

        if ($update_pm) {
            // actualizamos todos los traficos para el bus pm y dia seleccionados
            $sql_update_traffic_driver_pm = 'update traffic
    set driver_pm=?
    where id_bus_pm=? and `date`=?;';
            $updates = $this->db()->query($sql_update_traffic_driver_pm, array($id_driver, $id_bus, $date));
        }

        // buscamos el numero de filas afectadas
        $sql_count_traffic_updates = 'select count(*)
    from traffic
    where (id_bus_am=? or id_bus_pm=?) and `date`=?;';
        $updates = $this->db()->query($sql_count_traffic_updates, array($id_bus, $id_bus, $date));
        $rows = $updates->fetchAll();

        echo json_encode(array('rows_updated' => $rows[0]['count(*)']));
    }

    function index_change_park() {
        $data = array();

        $parques = new Parques();
        $parques = $parques->find();

        $data['parques'] = $parques;

        $data['content'] = 'traffic/update_parks.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;

        $this->renderc('admin/index', $data, true);
    }

    function index_reorder_bus() {
        $time = $this->params['time'];
        $sql_bus = '';
        if ($time == 'am') {
            $sql_bus = 'traffic.id_bus_am';
        } else if ($time == 'pm') {
            $sql_bus = 'traffic.id_bus_pm';
        } else {
            return Doo::conf()->APP_URL . "admin/traffic/index";
        }
        $data = array();
        if (isset($_POST['fecha_ini'])) {
            $fecha_recibida = $_POST['fecha_ini'];
            $div_fech_recibida = explode('-', $fecha_recibida);
            $select_date = getdate(mktime(0, 0, 0, $div_fech_recibida[0], $div_fech_recibida[1], $div_fech_recibida[2]));
        } else {
            if (isset($_SESSION['traffic_date'])) {
                $select_date = $_SESSION['traffic_date'];
            } else {
                $select_date = getdate();
            }
        }

        $_SESSION['traffic_date'] = $select_date;

        if ($select_date['mon'] <= 9) {
            $select_date['mon'] = "0$select_date[mon]";
        }

        if ($select_date['mday'] <= 9) {
            $select_date['mday'] = "0$select_date[mday]";
        }

        $fecha_recibida = "$select_date[mon]-$select_date[mday]-$select_date[year]";
        $select_date = "$select_date[year]-$select_date[mon]-$select_date[mday]";

        $sql_traffic_tour = "select tours_oneday.adult as adult_one, tours_oneday.child as child_one, tours.adult, tours.child, reservas.pax as adult_reserve, reservas.pax2 as child_reserve,traffic.id, traffic.id_tour, traffic.type_tour, traffic.date, traffic.time_am, traffic.time_pm, traffic.`from`, traffic.`to`, traffic.id_attraction_trafic,
                              attraction_trafic.id_park, attraction_trafic.admission, parques.nombre as nombre_parque, traffic.id_cliente,
                              clientes.firstname, clientes.lastname, tours.code_conf as tours_code_conf, tours_oneday.code_conf as oneday_code_conf, reservas.codconf as reserve_code_conf,
                              traffic.id_bus_am, traffic.id_bus_pm, traffic.driver_am, traffic.driver_pm, traffic.type_ticket, traffic.type_traffic
                            from traffic
                              left join attraction_trafic
                                on attraction_trafic.id=traffic.id_attraction_trafic
                              left join parques
                                on attraction_trafic.id_park=parques.id
                              left join clientes
                                on traffic.id_cliente=clientes.id
                              left join tours
                                on traffic.id_tour=tours.id
                              left join tours_oneday
                                on traffic.id_tour=tours_oneday.id
                              left join reservas
                                on traffic.id_tour=reservas.id
                            where traffic.date=?
                              order by $sql_bus asc;";

        $traffics_query = $this->db()->query($sql_traffic_tour, array($select_date));

        $traffics_a = $traffics_query->fetchAll();
        $buses = $this->db()->query('select traffic_bus.id, traffic_bus.short_name, traffic_bus.name, driver.firstname, driver.lastname,
  traffic_bus.id_driver, traffic_bus.type_bus, traffic_bus.capacity  from traffic_bus
  left join driver
    on traffic_bus.id_driver=driver.id;');
        $buses = $buses->fetchAll();

        $traffics_agruped_with_bus = array();
        $trafics_bus_null = array();

        $i = 0;
        $total_pax = 0;
        foreach ($traffics_a as $traffic) {
            if ($time == 'am') {
                $bus = $traffic['id_bus_am'];
            } else {
                $bus = $traffic['id_bus_pm'];
            }

            if (!isset($bus)) {
                $pax = 0;
                if (isset($traffic['child_one']) and isset($traffic['adult_one'])) {
                    $pax = $traffic['child_one'] + $traffic['adult_one'];
                    $traffic['child_t'] = $traffic['child_one'];
                    $traffic['adult_t'] = $traffic['adult_one'];
                }
                if (isset($traffic['child']) and isset($traffic['adult'])) {
                    $pax = $traffic['child'] + $traffic['adult'];
                    $traffic['child_t'] = $traffic['child'];
                    $traffic['adult_t'] = $traffic['adult'];
                }
                if (isset($traffic['child_reserve']) and isset($traffic['adult_reserve'])) {
                    $pax = $traffic['child_reserve'] + $traffic['adult_reserve'];
                    $traffic['child_t'] = $traffic['child_reserve'];
                    $traffic['adult_t'] = $traffic['adult_reserve'];
                }
                $total_pax += $pax;
                $traffic['total_pax'] = $pax;

                $trafics_bus_null[] = $traffic;
                unset($traffic[$i]);
            }
            $i++;
        }
        $bus['total_pax'] = $total_pax;
        $traffics_agruped_with_bus[] = array('bus' => null, 'traffics' => $trafics_bus_null, 'total_pax' => $total_pax);

        foreach ($buses as $bus) {
            $i = 0;
            $trafics_bus = array();
            $total_pax = 0;
            foreach ($traffics_a as $traffic) {
                if ($time == 'am') {
                    $bus_time = $traffic['id_bus_am'];
                } else {
                    $bus_time = $traffic['id_bus_pm'];
                }

                if ($bus_time == $bus['id']) {
                    $pax = 0;
                    $traffic['child_t'] = 0;
                    $traffic['adult_t'] = 0;
                    if (isset($traffic['child_one']) and isset($traffic['adult_one'])) {
                        $pax = $traffic['child_one'] + $traffic['adult_one'];
                        $traffic['child_t'] = $traffic['child_one'];
                        $traffic['adult_t'] = $traffic['adult_one'];
                    }
                    if (isset($traffic['child']) and isset($traffic['adult'])) {
                        $pax = $traffic['child'] + $traffic['adult'];
                        $traffic['child_t'] = $traffic['child'];
                        $traffic['adult_t'] = $traffic['adult'];
                    }
                    if (isset($traffic['child_reserve']) and isset($traffic['adult_reserve'])) {
                        $pax = $traffic['child_reserve'] + $traffic['adult_reserve'];
                        $traffic['child_t'] = $traffic['child_reserve'];
                        $traffic['adult_t'] = $traffic['adult_reserve'];
                    }
                    $traffic['total_pax'] = $pax;
                    $total_pax += $pax;

                    $trafics_bus_null[] = $traffic;
                    $trafics_bus[] = $traffic;
                    unset($traffic[$i]);
                }
                $i++;
            }
            $bus['total_pax'] = $total_pax;
            $traffics_agruped_with_bus[] = array('bus' => $bus, 'traffics' => $trafics_bus, 'total_pax' => $total_pax);
        }

        $data['fecha_ini'] = $fecha_recibida;
        $data['time'] = $time;
        $data['traffics_agruped_with_bus'] = $traffics_agruped_with_bus;
        $data['date'] = $select_date;
        $data['content'] = 'traffic/reorder_bus.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);
    }

    function index_reorder_bus_save() {
        $time = $_GET['time'];
        $buses = $_GET['buses'];

        if ($time == 'am') {
            $sql_bus = 'id_bus_am';
            $sql_driver = 'driver_am';
        } else {
            $sql_bus = 'id_bus_pm';
            $sql_driver = 'driver_pm';
        }

        foreach ($buses as $bus) {
            $id_bus = $bus['id_bus'];

            if (isset($bus['traffics'])) {
                $traffics = $bus['traffics'];
                if ($id_bus != 'null') {
                    $search_bus = new TrafficBus(array('id' => $id_bus));
                    $search_bus = $search_bus->getOne();
                } else {
                    $search_bus = null;
                }

                foreach ($traffics as $traffic) {
                    if ($id_bus != 'null') {
                        $sql_update = "UPDATE traffic SET $sql_bus=?, $sql_driver=? WHERE id=?";
                        $traffic_update = $this->db()->query($sql_update, array($id_bus, $search_bus->id_driver, $traffic));
                    } else {
                        $sql_update = "UPDATE traffic SET $sql_bus=NULL, $sql_driver=NULL WHERE id=?";
                        $traffic_update = $this->db()->query($sql_update, array($traffic));
                    }
                }
            }
        }

        echo json_encode(array('exito' => true));
    }

    
    public function tiketes_pdf() {
        //$select_date = $this->params['date'];
        $select_date = $this->params['fecha_inicial'];
        
        //header("Content-Type: text/html;charset=utf-8");
        $select_date_formated = date('d/m/y', strtotime($select_date));
        
        $page = "<head>
        <title>Documento sin tï¿½tulo</title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        
        
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
            background-color: #E7E7E7;
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
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height:20px;
                font-size:10px;
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
            background-color:#F8F8F8;
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

        

        </style></head><div align='center'>
        <br />
        
        <img src='global/img/admin/cabecera.png' alt='' style='width: 630px; margin-left: -328px; margin-top: 0px; height: 80px;' />
        
        <table   id='clearTable'  style=''  >
             
             <tr>                  
               
               <td style='width:500px; font-size:11px; ' valign='top' align='right' >
                    <b>" . trim(date('M-d-Y g:i a')) . "</b>
               </td>
               
             </tr>
             
             <tr>
                <td  style=' width:500px; height=35;'  id= titletd4 valign=top align=center>
                    <span style='font-weight: bold'>Daily Arrival</span>
                    <br />$select_date_formated      $select_date_formated
               </td>   
               
             </tr>";
        
//        $page .= '<img src="global/img/icono26anios.png" alt="" style="width: 25%;" />';
        
        $page .='</table><table style="">';
        $page .= '
                        <tr class="trInicial">
                            <th style="width:40px;" align="left">
                                PAX NAME.
                                <br>
                                #
                            </th>
                            <th style="width:130px;">IN TOUR</th>
                            <th style="width:100px;">CUSTOMER</th>
                            <th style="width:50px;">OUT</th>
                            <th style="width:10px;" >AD</th>
                            <th style="width:10px;">CHD</th>
                            <th  style="width:10px;">TOT.</th>
                            <th  style="width:60px;">COLLECT</th>
                            <th  style="width:340px;" COLSPAN="7">SERVICES INCLUDED</th>
                         </tr>
                    ';

        $all_tour = $this->db()->query($this->sql_all_tour, array($select_date, $select_date, $select_date, $select_date, $select_date, $select_date));
        $all_tour = $all_tour->fetchAll();

//        print_r($all_tour);
//        exit();
        $tours = array();
        for ($i = 0; $i < sizeof($all_tour); $i++) {
            $traffics = $this->search_tickets($all_tour[$i]['id'], $all_tour[$i]['type']);
            $traffics = $traffics['traffics'];

            if (sizeof($traffics) > 0) {
                $tours[] = $all_tour[$i];
            }
        }

        $cont = 0;
        $total_adult = 0;
        $total_child = 0;
        $total_collect = 0;
        foreach ($tours as $tour) {

            $page .= '<tr class="row' . ($cont % 2) . '" >';
            $page .= '<td style="width:40px;" >' . strtoupper(trim($tour['lastname'])) . ' ' . strtoupper(trim($tour['firstname'])) . '<br><span style="font-size:10px;"><strong>' . $tour['code_conf'] . '</strong></span></td>';

            $in = '';
            $out = '';
            if ($tour['id_reserva'] != -1) {
                $in = 'BUS';
                $out = 'BUS';
            } 
            if ($tour['transfer_in'] != '') {
                $in = $tour['transfer_in'];
            }
            if ($tour['transfer_out'] != '' ) {
                $out = $tour['transfer_out'];
            }
            
            if ($tour['type_rate'] == 1) {
                $rate = 'AB';
            } else {
                $rate = 'NR';
            }



            if ($tour['type'] == 'MULTI' || $tour['type'] == 'ONE') {
                $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?  ";
                $rs = Doo::db()->query($sql, array($tour['id'], $tour['type']));
                $pagado = $rs->fetch();

                $sql2 = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ? and tipo_pago = 'COLLECT ON BOARD' ";
                $rs2 = Doo::db()->query($sql2, array($tour['id'], $tour['type']));
                $collectado_consult = $rs2->fetch();
            } else {
                $sql = "select sum(pagado) as total from reservas_pago where id_reserva = ? ";
                $rs = Doo::db()->query($sql, array($tour['id']));
                $pagado = $rs->fetch();

                $sql2 = "select sum(pagado) as total from reservas_pago where id_reserva = ? and tipo_pago = 'COLLECT ON BOARD'";
                $rs2 = Doo::db()->query($sql2, array($tour['id']));
                $collectado_consult = $rs2->fetch();
            }

            if ($tour['otheramount'] > 0) {
                $valor_total = $tour['otheramount'];
            } else {
                $valor_total = $tour['totaltotal'];
            }
            if ($tour["tipo_pago"] == "COMPLEMENTARY") {
                $valor_total = 0;
            }
            if ($tour["tipo_pago"] == "VOUCHER") {
                $valor_total = 0;
            }



            //$collect = 0;

            $collect = $valor_total - $pagado["total"];


            if (abs($collect)) {
                $collect = 0;
            }
            $total_collect += $collect;
            $total_adult += $tour['adult'];
            $total_child += $tour['child'];
            if($tour['customer'] == ''){
                $tour['customer'] = "SUPERTOURS OF ORLANDO";
            }
            $page .= '<td rowspan="2" style="width:130px; font-size:12px;" >' . trim($in) . ' ' . $rate . ' - ' . $tour['type'] . ' ' . $tour['days'] . $tour['nights'] . ' ' . strtoupper($tour['nombre_hotel']) . '</td>';
            $page .= '<td rowspan="2" style="width:100px; font-size:12px;">' . trim($tour['customer']) . '</td>';
            $page .= '<td rowspan="2" style="width:50px; font-size:12px;">' . trim($out) . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . $tour['adult'] . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . $tour['child'] . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . ($tour['child'] + $tour['adult']) . '</td>';
            $page .= '<td rowspan="2" style="width:20px; font-size:12px;" align="center">' . number_format($collect, 2, '.', '.') . '</td>';
            
                     
            $services = $this->search_tickets($tour['id'], $tour['type']);

            $extra_parks = $services['extra_parks_without_traffic']; // parques que no generan trafico
            
            

            $services = $services['traffics'];
            $cant_services = sizeof($services);
            $cont_extra_parks = 0;
            for ($i = 0; $i < 7; $i++) {
                $name_service = '';
                if ($i < $cant_services) {
                    $service = $services[$i];

                    if (isset($service)) {
                        if ($service['type_traffic'] == 'PARK') {
                            //$name_service = $service['nombre_parque'];
                            if ($service['admission']) {
                                $name_service = $service['nombre_parque'];
                                $name_service .= " (TK)";
                            }else{
                                $name_service = $service['nombre_parque'];
                                $name_service .= " (NTK)";
                                //echo '<span style="color:red; text-align:center; font-size:10px;">NTK</span>';
                            }
                        } else {
                            $name_service = $service['nombre_parque'];
                            //$name_service = $service['type_traffic'];                            
                            
                        }
                    }
                } else {
                    if ($cont_extra_parks < sizeof($extra_parks)) {
                        $service = $extra_parks[$cont_extra_parks];
                        $name_service = $service['nombre_parque'];
                        if ($service['admission']) {
                            $name_service .= " (TK - NT)";
                        }
                        $cont_extra_parks++;
                    }
                }

                $page .= '<td style="width:30px; height:15px; font-size:10px;">' . $name_service . '</td>';
            }

            $page .= '</tr>';
            $page .= '<tr class="row' . ($cont % 2) . '" >';
            for ($i = 7; $i < 14; $i++) {
                $name_service = '';
                if ($i < $cant_services) {
                    $service = $services[$i];

                    if (isset($service)) {
                        if ($service['type_traffic'] == 'PARK') {
                            $name_service = $service['nombre_parque'];
                            $name_service .= " (TK)";
                        } else {
                            $name_service = $service['nombre_parque'];
                            $name_service .= " (NTK)";
                            //echo '<span style="color:red; text-align:center; font-size:10px;">NTK</span>';
                            //$name_service = $service['type_traffic'];
                            
                        }
                    }
                } else {
                    if ($cont_extra_parks < sizeof($extra_parks)) {
                        $service = $extra_parks[$cont_extra_parks];
                        //$name_service = $service['nombre_parque'];
                        if ($service['admission']) {
                            $name_service = $service['nombre_parque'];
                            $name_service .= " (TK)";                          
                      
                        }else{
                        $name_service = $service['nombre_parque'];
                        $name_service .= "  (NT)";                    
                        $cont_extra_parks++;
                        }
                    }
                }

                $page .= '<td style="width:30px; height:15px; font-size:10px;">' . $name_service . '</td>';
            }
            $page .= '</tr>';
            $cont++;

//
        }

        $page .= '<tr class="trInicial">
          <th  >&nbsp;</th>
          <th style="font-size:12px;">**TOTAL**</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th style=" font-size:12px;">' . $total_adult . '</th>
          <th style=" font-size:12px;">' . $total_child . '</th>
          <th style=" font-size:12px;">' . ($total_adult + $total_child) . '</th>
          <th style=" font-size:12px;">' . number_format($total_collect, 2, '.', '.') . '</th>
          <th colspan="7">&nbsp;</th>
        </tr>';

        $page .= "</table>
	    </div>
	    </html>";

        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF("Tickets $select_date_formated", $page, false, 'letter', 'landscape');
        $pdf->doPDF();
//        
        //echo $page;
        //echo $pdf;
        
    }    
    
    
    public function daily_arrival_pdf() {
        $select_date = $this->params['date'];
        //header("Content-Type: text/html;charset=utf-8");
        $select_date_formated = date('d/m/y', strtotime($select_date));
        
        $page = "<head>
        <title>Documento sin tï¿½tulo</title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        
        
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
            background-color: #E7E7E7;
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
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height:20px;
                font-size:10px;
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
            background-color:#F8F8F8;
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

        

        </style></head><div align='center'>
        <br />
        <table   id='clearTable'  style=''  >
        
             <tr>
               <td align='left' style='width:200px;' rowspan='2' height='133' id='titletd3'><img src='" . Doo::conf()->APP_URL . "global/img/admin/logo.png' style='width: 260px; height:80px;' /></td>
                   
               <td style='width:500px; font-size:11px; ' valign='top' align='right' >
                <b>" . trim(date('M-d-Y g:i a')) . "</b>
                </tr>
                <tr>
                <td height=35 style=width:500px;  id=titletd4 valign=top align=center>
                <span style='font-weight: bold'>Daily Arrival</span>
                <br />$select_date_formated      $select_date_formated
               </td>
               
            </tr>";
//        $page .= '<img src="global/img/icono26anios.png" alt="" style="width: 25%;" />';
        
        $page .='</table><table style="">';
        $page .= '
                        <tr class="trInicial">
                            <th style="width:40px;" align="left">
                                PAX NAME.
                                <br>
                                #
                            </th>
                            <th style="width:130px;">IN TOUR</th>
                            <th style="width:100px;">CUSTOMER</th>
                            <th style="width:50px;">OUT</th>
                            <th style="width:10px;" >AD</th>
                            <th style="width:10px;">CHD</th>
                            <th  style="width:10px;">TOT.</th>
                            <th  style="width:60px;">COLLECT</th>
                            <th  style="width:340px;" COLSPAN="7">SERVICES INCLUDED</th>
                         </tr>
                    ';

        $all_tour = $this->db()->query($this->sql_all_tour, array($select_date, $select_date, $select_date, $select_date, $select_date, $select_date));
        $all_tour = $all_tour->fetchAll();

        $tours = array();
        for ($i = 0; $i < sizeof($all_tour); $i++) {
            $traffics = $this->generate_and_search_traffics($all_tour[$i]['id'], $all_tour[$i]['type']);
            $traffics = $traffics['traffics'];

            if (sizeof($traffics) > 0) {
                $tours[] = $all_tour[$i];
            }
        }

        $cont = 0;
        $total_adult = 0;
        $total_child = 0;
        $total_collect = 0;
        foreach ($tours as $tour) {

            $page .= '<tr class="row' . ($cont % 2) . '" >';
            $page .= '<td style="width:40px;" >' . strtoupper(trim($tour['lastname'])) . ' ' . strtoupper(trim($tour['firstname'])) . '<br><span style="font-size:10px;"><strong>' . $tour['code_conf'] . '</strong></span></td>';

            $in = '';
            $out = '';
            if ($tour['id_reserva'] != -1) {
                $in = 'BUS';
                $out = 'BUS';
            } 
            if ($tour['transfer_in'] != '') {
                $in = $tour['transfer_in'];
            }
            if ($tour['transfer_out'] != '' ) {
                $out = $tour['transfer_out'];
            }
            
            if ($tour['type_rate'] == 1) {
                $rate = 'AB';
            } else {
                $rate = 'NR';
            }



            if ($tour['type'] == 'MULTI' || $tour['type'] == 'ONE') {
                $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?  ";
                $rs = Doo::db()->query($sql, array($tour['id'], $tour['type']));
                $pagado = $rs->fetch();

                $sql2 = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ? and tipo_pago = 'COLLECT ON BOARD' ";
                $rs2 = Doo::db()->query($sql2, array($tour['id'], $tour['type']));
                $collectado_consult = $rs2->fetch();
            } else {
                $sql = "select sum(pagado) as total from reservas_pago where id_reserva = ? ";
                $rs = Doo::db()->query($sql, array($tour['id']));
                $pagado = $rs->fetch();

                $sql2 = "select sum(pagado) as total from reservas_pago where id_reserva = ? and tipo_pago = 'COLLECT ON BOARD'";
                $rs2 = Doo::db()->query($sql2, array($tour['id']));
                $collectado_consult = $rs2->fetch();
            }

            if ($tour['otheramount'] > 0) {
                $valor_total = $tour['otheramount'];
            } else {
                $valor_total = $tour['totaltotal'];
            }
            if ($tour["tipo_pago"] == "COMPLEMENTARY") {
                $valor_total = 0;
            }
            if ($tour["tipo_pago"] == "VOUCHER") {
                $valor_total = 0;
            }



            //$collect = 0;

            $collect = $valor_total - $pagado["total"];


            if (abs($collect)) {
                $collect = 0;
            }
            $total_collect += $collect;
            $total_adult += $tour['adult'];
            $total_child += $tour['child'];
            if($tour['customer'] == ''){
                $tour['customer'] = "SUPERTOURS OF ORLANDO";
            }
            $page .= '<td rowspan="2" style="width:130px; font-size:12px;" >' . trim($in) . ' ' . $rate . ' - ' . $tour['type'] . ' ' . $tour['days'] . $tour['nights'] . ' ' . strtoupper($tour['nombre_hotel']) . '</td>';
            $page .= '<td rowspan="2" style="width:100px; font-size:12px;">' . trim($tour['customer']) . '</td>';
            $page .= '<td rowspan="2" style="width:50px; font-size:12px;">' . trim($out) . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . $tour['adult'] . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . $tour['child'] . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . ($tour['child'] + $tour['adult']) . '</td>';
            $page .= '<td rowspan="2" style="width:20px; font-size:12px;" align="center">' . number_format($collect, 2, '.', '.') . '</td>';            

                
            $services = $this->generate_and_search_traffics($tour['id'], $tour['type']);
            $extra_parks = $services['extra_parks_without_traffic']; // parques que no generan trafico

            $services = $services['traffics'];
            $cant_services = sizeof($services);
            $cont_extra_parks = 0;
            for ($i = 0; $i < 7; $i++) {
                $name_service = '';
                if ($i < $cant_services) {
                    $service = $services[$i];

                    if (isset($service)) {
                        if ($service['type_traffic'] == 'PARK') {
                            $name_service = $service['nombre_parque'];
                            if ($service['admission']) {
                                $name_service .= " (TK)";
                                //$name_service.= '<img src="https://www.supertours.com/TK.png" style="position: absolute; width: 32px; height: 29px; margin-left: 3px; margin-top: 4px;" />';
                            }else{
                                $name_service.= '<img src="https://www.supertours.com/NTK.png" style="position: absolute; width: 32px; height: 29px; margin-left: 3px; margin-top: 0px;" />';
                            }
                        } else {
                            $name_service = $service['type_traffic'];
                        }
                    }
                } else {
                    if ($cont_extra_parks < sizeof($extra_parks)) {
                        $service = $extra_parks[$cont_extra_parks];
                        $name_service = $service['nombre_parque'];
                        if ($service['admission']) {
                            $name_service .= " (TK - NT)";
                        }
                        $cont_extra_parks++;
                    }
                }

                $page .= '<td style="width:30px; height:15px; font-size:10px;">' . $name_service . '</td>';
            }

            $page .= '</tr>';
            $page .= '<tr class="row' . ($cont % 2) . '" >';
            for ($i = 7; $i < 14; $i++) {
                $name_service = '';
                if ($i < $cant_services) {
                    $service = $services[$i];

                    if (isset($service)) {
                        if ($service['type_traffic'] == 'PARK') {
                            $name_service = $service['nombre_parque'];
                        } else {
                            $name_service = $service['type_traffic'];
                        }
                    }
                } else {
                    if ($cont_extra_parks < sizeof($extra_parks)) {
                        $service = $extra_parks[$cont_extra_parks];
                        $name_service = $service['nombre_parque'];
                        if ($service['admission']) {
                            $name_service .= " (TK)";                          
                      
                        }
                            
                        $name_service .= "  (NT)";                    
                        $cont_extra_parks++;
                    }
                }

                $page .= '<td style="width:30px; height:15px; font-size:10px;">' . $name_service . '</td>';
            }
            $page .= '</tr>';
            $cont++;

//
        }

        $page .= '<tr class="trInicial">
          <th  >&nbsp;</th>
          <th style="font-size:12px;">**TOTAL**</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th style=" font-size:12px;">' . $total_adult . '</th>
          <th style=" font-size:12px;">' . $total_child . '</th>
          <th style=" font-size:12px;">' . ($total_adult + $total_child) . '</th>
          <th style=" font-size:12px;">' . number_format($total_collect, 2, '.', '.') . '</th>
          <th colspan="7">&nbsp;</th>
        </tr>';

        $page .= "</table>
	    </div>
	    </html>";

        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF("Daily Arrival $select_date_formated", $page, false, 'letter', 'landscape');
        $pdf->doPDF();
      //echo $page;
    }
    public function daily_arrival_exten_pdf() {
        $select_date = $this->params['date'];

        $select_date_formated = date('d/m/y', strtotime($select_date));

        $page = "<head>
        <title>Documento sin titulo</title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
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
            background-color: #E7E7E7;
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
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height:20px;
                font-size:10px;
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
            background-color:#F8F8F8;
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



        </style></head><div align='center'>
        <br />
        <table   id='clearTable'  style=''  >
             <tr>
               <td align='left' style='width:200px;' rowspan='2' height='33' id='titletd3'><img src='" . Doo::conf()->APP_URL . "global/img/admin/logo.png' style='width:200px;'  height='60' /></td>
               <td style='width:500px; font-size:11px; ' valign='top' align='right' >
                <b>" . trim(date('M-d-Y g:i a')) . "</b>
                </tr>
                <tr>
                <td height=35 style=width:500px;  id=titletd4 valign=top align=center>
                <span style='font-weight: bold'>Daily Arrival Extension</span>
                <br />$select_date_formated      $select_date_formated
               </td>
            </tr>";

        $page .='</table><table style="">';
        $page .= '
                        <tr class="trInicial">
                            <th style="width:40px;" align="left">
                                PAX NAME.
                                <br>
                                #
                            </th>
                            <th style="width:130px;">IN TOUR</th>
                            <th style="width:100px;">CUSTOMER</th>
                            <th style="width:50px;">OUT</th>
                            <th style="width:10px;" >AD</th>
                            <th style="width:10px;">CHD</th>
                            <th  style="width:10px;">TOT.</th>
                            <th  style="width:60px;">COLLECT</th>
                            <th  style="width:340px;" COLSPAN="7">SERVICES INCLUDED</th>
                         </tr>
                    ';

        $all_tour = $this->db()->query($this->sql_all_transp, array( $select_date, $select_date));
        $all_tour = $all_tour->fetchAll();

        $tours = array();
        for ($i = 0; $i < sizeof($all_tour); $i++) {
            $traffics = $this->generate_and_search_traffics($all_tour[$i]['id'], $all_tour[$i]['type']);
            $traffics = $traffics['traffics'];

            if (sizeof($traffics) > 0) {
                $tours[] = $all_tour[$i];
            }
        }

        $cont = 0;
        $total_adult = 0;
        $total_child = 0;
        $total_collect = 0;
        foreach ($tours as $tour) {

            $page .= '<tr class="row' . ($cont % 2) . '" >';
            $page .= '<td style="width:40px;" >' . strtoupper(trim($tour['lastname'])) . ' ' . strtoupper(trim($tour['firstname'])) . '<br><span style="font-size:10px;"><strong>' . $tour['code_conf'] . '</strong></span></td>';

            $in = '';
            $out = '';
            if ($tour['id_reserva'] != -1) {
                $in = 'BUS';
                $out = 'BUS';
            } 
            if ($tour['transfer_in'] != '') {
                $in = $tour['transfer_in'];
            }
            if ($tour['transfer_out'] != '' ) {
                $out = $tour['transfer_out'];
            }
            
            if ($tour['type_rate'] == 1) {
                $rate = 'AB';
            } else {
                $rate = 'NR';
            }



            if ($tour['type'] == 'MULTI' || $tour['type'] == 'ONE') {
                $sql = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ?  ";
                $rs = Doo::db()->query($sql, array($tour['id'], $tour['type']));
                $pagado = $rs->fetch();

                $sql2 = "select sum(pagado) as total from tours_pago where id_tours = ? and tipo = ? and tipo_pago = 'COLLECT ON BOARD' ";
                $rs2 = Doo::db()->query($sql2, array($tour['id'], $tour['type']));
                $collectado_consult = $rs2->fetch();
            } else {
                $sql = "select sum(pagado) as total from reservas_pago where id_reserva = ? ";
                $rs = Doo::db()->query($sql, array($tour['id']));
                $pagado = $rs->fetch();

                $sql2 = "select sum(pagado) as total from reservas_pago where id_reserva = ? and tipo_pago = 'COLLECT ON BOARD'";
                $rs2 = Doo::db()->query($sql2, array($tour['id']));
                $collectado_consult = $rs2->fetch();
            }

            if ($tour['otheramount'] > 0) {
                $valor_total = $tour['otheramount'];
            } else {
                $valor_total = $tour['totaltotal'];
            }
            if ($tour["tipo_pago"] == "COMPLEMENTARY") {
                $valor_total = 0;
            }
            if ($tour["tipo_pago"] == "VOUCHER") {
                $valor_total = 0;
            }



            //$collect = 0;

            $collect = $valor_total - $pagado["total"];


            if (abs($collect)) {
                $collect = 0;
            }
            $total_collect += $collect;
            $total_adult += $tour['adult'];
            $total_child += $tour['child'];
            if($tour['customer'] == ''){
                $tour['customer'] = "SUPERTOURS OF ORLANDO";
            }
            $page .= '<td rowspan="2" style="width:130px; font-size:12px;" >' . trim($in) . ' ' . $rate . ' - ' . $tour['type'] . ' ' . $tour['days'] . $tour['nights'] . ' ' . strtoupper($tour['nombre_hotel']) . '</td>';
            $page .= '<td rowspan="2" style="width:100px; font-size:12px;">' . trim($tour['customer']) . '</td>';
            $page .= '<td rowspan="2" style="width:50px; font-size:12px;">' . trim($out) . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . $tour['adult'] . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . $tour['child'] . '</td>';
            $page .= '<td rowspan="2" style="width:10px; font-size:12px;" align="center">' . ($tour['child'] + $tour['adult']) . '</td>';
            $page .= '<td rowspan="2" style="width:20px; font-size:12px;" align="center">' . number_format($collect, 2, '.', '.') . '</td>';

            $services = $this->generate_and_search_traffics($tour['id'], $tour['type']);
            $extra_parks = $services['extra_parks_without_traffic']; // parques que no generan trafico

            $services = $services['traffics'];
            $cant_services = sizeof($services);
            $cont_extra_parks = 0;
            for ($i = 0; $i < 7; $i++) {
                $name_service = '';
                if ($i < $cant_services) {
                    $service = $services[$i];

                    if (isset($service)) {
                        if ($service['type_traffic'] == 'PARK') {
                            $name_service = $service['nombre_parque'];
                            if ($service['admission']) {
                                $name_service .= " (TK)";
                            }
                        } else {
                            $name_service = $service['type_traffic'];
                        }
                    }
                } else {
                    if ($cont_extra_parks < sizeof($extra_parks)) {
                        $service = $extra_parks[$cont_extra_parks];
                        $name_service = $service['nombre_parque'];
                        if ($service['admission']) {
                            $name_service .= " (TK - NT)";
                        }
                        $cont_extra_parks++;
                    }
                }

                $page .= '<td style="width:30px; height:15px; font-size:10px;">' . $name_service . '</td>';
            }

            $page .= '</tr>';
            $page .= '<tr class="row' . ($cont % 2) . '" >';
            for ($i = 7; $i < 14; $i++) {
                $name_service = '';
                if ($i < $cant_services) {
                    $service = $services[$i];

                    if (isset($service)) {
                        if ($service['type_traffic'] == 'PARK') {
                            $name_service = $service['nombre_parque'];
                        } else {
                            $name_service = $service['type_traffic'];
                        }
                    }
                } else {
                    if ($cont_extra_parks < sizeof($extra_parks)) {
                        $service = $extra_parks[$cont_extra_parks];
                        $name_service = $service['nombre_parque'];
                        if ($service['admission']) {
                            $name_service .= " (TK)";
                        }
                        $name_service .= "  (NT)";
                        $cont_extra_parks++;
                    }
                }

                $page .= '<td style="width:30px; height:15px; font-size:10px;">' . $name_service . '</td>';
            }
            $page .= '</tr>';
            $cont++;

//
        }

        $page .= '<tr class="trInicial">
          <th  >&nbsp;</th>
          <th style="font-size:12px;">**TOTAL**</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th style=" font-size:12px;">' . $total_adult . '</th>
          <th style=" font-size:12px;">' . $total_child . '</th>
          <th style=" font-size:12px;">' . ($total_adult + $total_child) . '</th>
          <th style=" font-size:12px;">' . number_format($total_collect, 2, '.', '.') . '</th>
          <th colspan="7">&nbsp;</th>
        </tr>';

        $page .= "</table>
	    </div>
	    </html>";

        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF("Daily Arrival $select_date_formated", $page, false, 'letter', 'landscape');
        $pdf->doPDF();
//        echo $page;
    }
    function guides_services_pdf() {
        $time = $this->params['time'];

        $select_date = $this->params['date'];
        $select_date_formated = date('d/m/y', strtotime($select_date));
        $time = strtoupper($time);
        $page = "<head>
        <title>Documento sin t�tulo</title>
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
            background-color: #E7E7E7;
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
                background: #F0F0F0;
                color: #0B55C4;
                border-bottom: 1px solid white;
                border-left: 1px solid white;
                font-weight: bold;
                height:20px;
                font-size:10px;
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

        .vehicle td{
            border-bottom-width: 0.5px !important;
            border-bottom-style: solid !important;
            border-bottom-color: black !important;
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
            background-color:#F8F8F8;
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

        .pax_by_vehicle{
            font-size: 12px;

        }



        </style></head><div align='center'>
        <br />
        <table   id='clearTable'  style=''  >
             <tr>
               <td align='left' style='width:200px;' rowspan='2' height='33' id='titletd3'><img src='" . Doo::conf()->APP_URL . "global/img/admin/logo.png' style='width:200px;'  height='60' /></td>
               <td style='width:500px; font-size:11px; ' valign='top' align='right' >
                <b>" . trim(date('M-d-Y g:i a')) . "</b>
                </tr>
                <tr>
                <td height=35 style=width:500px;  id=titletd4 valign=top align=center>
                <span style='font-weight: bold'>Guides Services $time</span>
                <br />  $select_date_formated
               </td>
            </tr>";

        $page .='</table><table style="">';
        $page .= "
                        <tr class=\"trInicial\">
                            <th  style=\"width:20px;\" >TIME $time</th>
                            <th style=\"width:120px;\" align=\"left\">
                                PAX
                            </th>
                            <th style=\"width:160px;\">HOTEL NAME</th>
                            <th style=\"width:10px;\" >AD</th>
                            <th style=\"width:10px;\">CHD</th>
                            <th  style=\"width:10px;\">TOT.</th>
                            <th  style=\"width:300px;\">SERVICES</th>
                            <th  style=\"width:20px;\" >TIME PM</th>
                            <!--<th  style=\"width:40px;\">RESERVE</th>-->
                         </tr>
                    ";

        $cont = 0;
        $total_adult = 0;
        $total_child = 0;


        if ($time == 'AM') {
            $sql_bus = 'id_bus_am asc, driver_am asc';
        } else {
            $sql_bus = 'id_bus_pm asc, driver_pm asc';
        }

        $sql_traffic_tour = "select tours_oneday.adult as adult_one, tours_oneday.child as child_one, tours.adult, tours.child, reservas.pax as adult_reserve, reservas.pax2 as child_reserve,traffic.id,
                              traffic.id_tour, traffic.type_tour, traffic.hotel_name, traffic.date, traffic.time_am, traffic.time_pm, traffic.`from`, traffic.`to`, traffic.id_attraction_trafic,
                              attraction_trafic.id_park, attraction_trafic.admission, parques.nombre as nombre_parque, traffic.id_cliente,
                              clientes.firstname, clientes.lastname, tours.code_conf as tours_code_conf, tours_oneday.code_conf as oneday_code_conf, reservas.codconf as reserve_code_conf,
                              traffic.id_bus_am, traffic.id_bus_pm, traffic_bus_am.name as name_traffic_bus_am, traffic_bus_pm.name as name_traffic_bus_pm,
                              traffic.driver_am, traffic.driver_pm, driver_am.firstname as firstname_driver_am, driver_am.lastname as lastname_driver_am ,
                              driver_pm.firstname as firstname_driver_pm, driver_pm.lastname as lastname_driver_pm, traffic.type_ticket, traffic.type_traffic, traffic_type_ticket.type as name_type_ticket
                            from traffic
                              left join attraction_trafic
                                on attraction_trafic.id=traffic.id_attraction_trafic
                              left join parques
                                on attraction_trafic.id_park=parques.id
                              left join clientes
                                on traffic.id_cliente=clientes.id
                              left join tours
                                on traffic.id_tour=tours.id
                              left join tours_oneday
                                on traffic.id_tour=tours_oneday.id
                              left join reservas
                                on traffic.id_tour=reservas.id
                              left join driver as driver_am
                                on traffic.driver_am=driver_am.id
                              left join driver as driver_pm
                                on traffic.driver_pm=driver_pm.id
                              left join traffic_bus as traffic_bus_am
                                on traffic.id_bus_am=traffic_bus_am.id
                              left join traffic_bus as traffic_bus_pm
                                on traffic.id_bus_pm=traffic_bus_pm.id
                              left join traffic_type_ticket
                                on traffic.type_ticket=traffic_type_ticket.id

                              where traffic.date=? AND (tours.estado = 'CONFIRMED' or tours_oneday.estado = 'CONFIRMED' or reservas.estado = 'CONFIRMED' )
                                order by $sql_bus;";
        $traffics = $this->db()->query($sql_traffic_tour, array($select_date));

        $select_driver = null;
        $select_bus = null;

        if ($time == 'AM') {
            $key_driver = 'driver_am';
            $key_bus = 'id_bus_am';
            $key_name_bus = 'name_traffic_bus_am';
            $key_time = 'time_am';
        } else {
            $key_driver = 'driver_pm';
            $key_bus = 'id_bus_pm';
            $key_name_bus = 'name_traffic_bus_pm';
            $key_time = 'time_pm';
        }

        $cont_i = 0;
        $total_adult_by_vehicle = 0;
        $total_child_by_vehicle = 0;
        foreach ($traffics as $traffic) {
            if ($traffic[$key_driver] != $select_driver or $traffic[$key_bus] != $select_bus) {

                $select_driver = $traffic[$key_driver];
                $select_bus = $traffic[$key_bus];
                $bus_name = $traffic[$key_name_bus];
                $driver_name = $traffic['firstname_' . $key_driver] . ' ' . $traffic['lastname_' . $key_driver];

                // imprimimos el totoal por cada vehiculo
                $total_pax_by_vehicle = $total_child_by_vehicle + $total_adult_by_vehicle;
                if ($cont_i > 0) {
                    $page .= '<tr class="pax_by_vehicle vehicle">';
                    $page .= "<td colspan='2' align='center'> <strong>TOTAL PAX BY VEHICLE</strong> </td>";
                    $page .= "<td align='center'><strong>$total_adult_by_vehicle</strong></td>";
                    $page .= "<td align='center'><strong>$total_child_by_vehicle</strong></td>";
                    $page .= "<td align='center'><strong>$total_pax_by_vehicle</strong></td>";
                    $page .= "<td align='center' colspan='3'></td>";

                    $page .= '</tr>';
                }
                $total_adult_by_vehicle = 0;
                $total_child_by_vehicle = 0;

                $page .= '<tr class="row1 vehicle">';
                $page .= "<td colspan='1'>  </td>";
                $page .= "<td colspan='3' align='center'><strong>VEHICLE: $bus_name</strong></td>";
                $page .= "<td colspan='2' align='center'><strong>$driver_name</strong></td>";
                $page .= "<td colspan='2' align='center'></td>";
                $page .= '</tr>';
            } elseif (!isset($traffic[$key_driver]) and ! isset($traffic[$key_bus]) and $cont_i == 0) {
                // imprimimos el nombre para los traficos que no se encuentran en ningun bus
                $bus_name = 'Without BUS';
                $driver_name = '';

                $page .= '<tr class="row1 vehicle">';
                $page .= "<td colspan='1'>  </td>";
                $page .= "<td colspan='3' align='center'><strong>VEHICLE: $bus_name</strong></td>";
                $page .= "<td colspan='2' align='center'><strong>$driver_name</strong></td>";
                $page .= "<td colspan='2' align='center'></td>";

                $page .= '</tr>';
            }
            $page .= '<tr class="row0" >';
            $page .= '<td style="width:20px; font-size:10px;" align="center">' . date('H:i', strtotime($traffic[$key_time])) . '</td>';
            $page .= '<td style="width:120px;" >' . $traffic['firstname'] . ' ' . $traffic['lastname'] . '</td>';

            if ($traffic['type_tour'] == 'MULTI') {
                $adult = $traffic['adult'];
                $child = $traffic['child'];
                $code_conf = $traffic['tours_code_conf'];
            } elseif ($traffic['type_tour'] == 'ONE') {
                $adult = $traffic['adult_one'];
                $child = $traffic['child_one'];
                $code_conf = $traffic['oneday_code_conf'];
            } else {
                $adult = $traffic['adult_reserve'];
                $child = $traffic['child_reserve'];
                $code_conf = $traffic['reserve_code_conf'];
            }

            $total_adult_by_vehicle += $adult;
            $total_child_by_vehicle += $child;

            $total_adult += $adult;
            $total_child += $child;
            if ($traffic['type_traffic'] == 'PARK') {
                $park = $traffic['nombre_parque'];
            } else {
                $park = $traffic['type_traffic'];
            }
            $page .= '<td style="width:160px; font-size:10px;" align="center">' . $traffic['hotel_name'] . '</td>';
            $page .= '<td style="width:10px; font-size:10px;" align="center">' . $adult . '</td>';
            $page .= '<td style="width:10px; font-size:10px;" align="center">' . $child . '</td>';
            $page .= '<td style="width:10px; font-size:10px;" align="center">' . ($adult + $child) . '</td>';
            $page .= '<td style="width:300px; font-size:10px;" align="center">';
            if (isset($traffic['name_type_ticket'])) {
                $page .= '<strong>' . $traffic['name_type_ticket'] . ' /</strong> ';
            }
            $page .= $traffic['from'] . ' / ' . $park . ' / ' . $traffic['to'] . '</td>';
            $page .= '<td style="width:20px; font-size:10px;" align="center">' . date('H:i', strtotime($traffic["time_pm"])) . '</td>';
            $page .= ' <!--<td style="width:40px; font-size:10px;" align="center">' . $code_conf . '</td>-->';
            $page .= '</tr>';
            $cont_i++;
        }

        $total_pax_by_vehicle = $total_child_by_vehicle + $total_adult_by_vehicle;
        $page .= '<tr class="pax_by_vehicle vehicle">';
        $page .= "<td colspan='2' align='center'> <strong>TOTAL PAX BY VEHICLE</strong> </td>";
        $page .= "<td align='center'><strong>$total_adult_by_vehicle</strong></td>";
        $page .= "<td align='center'><strong>$total_child_by_vehicle</strong></td>";
        $page .= "<td align='center'><strong>$total_pax_by_vehicle</strong></td>";
        $page .= "<td align='center' colspan='3'></td>";
        $page .= '</tr>';

        $page .= '<tr class="trInicial">
          <th colspan="2">TOTAL PAX</th>
          <th >' . $total_adult . '</th>
          <th >' . $total_child . '</th>
          <th >' . ($total_adult + $total_child) . '</th>
          <th colspan="3">&nbsp;</th>
        </tr>';

        $page .= "</table>
	    </div>
	    </html>";

        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF("GUIDES SERVICES $time $select_date_formated", $page, false, 'letter', 'landscape');
        $pdf->doPDF();
    }

    function tickets_pdf() {
        $select_date = $this->params['date'];

        $select_date_formated = date('d/m/y', strtotime($select_date));

        $sql_traffic_tour = "select traffic.id, traffic.id_tour, traffic.type_tour, traffic.date, traffic.time_am, traffic.time_pm, traffic.`from`, traffic.`to`, traffic.id_attraction_trafic, traffic.parking,
                              attraction_trafic.id_park, attraction_trafic.admission, parques.nombre as nombre_parque, traffic.id_cliente,
                              clientes.firstname, clientes.lastname,
                              traffic.id_bus_am, traffic.id_bus_pm, traffic.driver_am, traffic.driver_pm, traffic.type_ticket, traffic.type_traffic, traffic.hotel_name
                            from traffic
                              left join attraction_trafic
                                on attraction_trafic.id=traffic.id_attraction_trafic
                              left join parques
                                on attraction_trafic.id_park=parques.id
                              left join clientes
                                on traffic.id_cliente=clientes.id
                              where traffic.date = ?
                              order by traffic.time_pm asc;
                              ";
        $traffics_query = $this->db()->query($sql_traffic_tour, array($select_date));

        $traffics_a = $traffics_query->fetchAll();
//        print_r(Doo::db()->showSQL());
//        exit;

        $tickets = "";
        $cont = 0;
        foreach ($traffics_a as $traffic) {
            /** */
            $time = date('H:i', strtotime($traffic['time_pm']));
            if ($traffic['type_traffic'] == 'PARK') {
                $nombre_parque = $traffic['nombre_parque'];
            } else {
                $nombre_parque = $traffic['from'];
            }

            $adult = 0;
            $child = 0;
            $to = 'MIAMI';
            if ($traffic['type_tour'] == 'MULTI') {
                $tour = new Tours();
                $tour->id = $traffic['id_tour'];
                $tour = $tour->getOne();
                if ($tour->estado != "CONFIRMED") {
                    continue;
                }
                $adult = $tour->adult;
                $child = $tour->child;
                $id_transfer = $tour->id_transfer_out;
                $transfer = new Transfer();
                $transfer->id = $id_transfer;
                $transfer = $transfer->getOne();

                if ($id_transfer > 0) {
                    if (isset($transfer)) {
                        $to = 'Airport';

                        if ($transfer->type == 4) {
                            $to = 'Other';
                        }
                    }
                }
            } elseif ($traffic['type_tour'] == 'ONE') {
                $tour = new Tour_oneday();
                $tour->id = $traffic['id_tour'];
                $tour = $tour->getOne();
                if ($tour->estado != "CONFIRMED") {
                    continue;
                }
                $adult = $tour->adult;
                $child = $tour->child;

                $transfer = new Transfer();
                $id_transfer = $tour->id_transfer_out;
                $transfer->id = $id_transfer;
                $transfer = $transfer->getOne();

                if ($id_transfer > 0) {
                    if (isset($transfer)) {
                        $to = 'Airport';

                        if ($transfer->type == 4) {
                            $to = 'Other';
                        }
                    }
                }
            } elseif ($traffic['type_tour'] == 'RESERVE') {
                $reserve = new Reserve();
                $reserve = $reserve->getOne();
                if ($reserve->estado != "CONFIRMED") {
                    continue;
                }
                $adult = $reserve->pax;
                $child = $reserve->pax2;
            }

            $pax_name = $traffic['firstname'] . ' ' . $traffic['lastname'];
            $tickets .= "
                <div class=\"ticket\">
                    <div class=\"title_time\">
                        <span>DEPARTURE TIME $time PM</span>
                        <span>BUS PARKING # {$traffic['parking']}</span>
                        <span>$nombre_parque</span>
                    </div>

                    <div class=\"title_time\">
                        <span>$pax_name X $adult+$child</span>
                        <span class=\"info_park\">{$traffic['hotel_name']}</span>
                        <span>$nombre_parque / $to</span>
                    </div>

                    <div class=\"info_empresa\">
                        <span>SUPERTOURS</span>
                        <span>5419 International Dr.</span>
                        <span>Orlando. FL 32819</span>
                        <span>1-800-899-3994</span>
                    </div>

                </div>
            ";



            $cont++;

            if ($cont % 2 == 0) {
                $tickets .= "
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                ";
            }

//
        }


        $page = "
            <html>
                <head>
                    <style>
                        body{
                            font-family: Verdana, Geneva, sans-serif;
                        }
                        .ticket{
                            border: thin solid #000000;
                            min-height: 3.318in;
                            min-width: 6in;
                            max-height: 3.318in;
                            max-width: 6in;
                            margin-top: 20px;
                        }
                        .clearfix{
                            clear: both;
                        }

                        .title_time{
                            font-weight: bold;
                            text-align: left;
                            margin-top: 1cm;
                            margin-left: 3cm;
                        }
                        .title_time span{
                            display: block;
                            margin-top: 5px;

                        }
                        .info_park{
                            margin-top: 20px !important;

                        }
                        .info_empresa{
                            float: right;
                            margin-left: 6cm;
                            margin-bottom: 1cm;

                            text-align: center;
                        }

                        .info_empresa > span:first-child{
                            font-weight: bold;
                        }

                        .info_empresa span{
                            display: block;
                        }
                    </style>
                </head>
                <body>

                    $tickets

                </body>
            </html>

        ";
        echo $page;
        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF("Tickets", $page, false, 'letter', 'letter');
        //$pdf->doPDF();
    }

}
