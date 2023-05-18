<?php

Doo::loadCore('db/DooModel');

class ReserveBase extends DooModel {

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $fecha_ini;
    public $trip_no;
    public $trip_no2;
    public $tipo_ticket;
    public $fromt;
    public $tot;
    public $tarifa_one;
    public $fromt2;
    public $tot2;
    public $tarifa_round;
    public $id_tours;
    public $type_tour;
    public $firsname;
    public $lasname;
    public $email;
    public $deptime1;
    public $deptime2;
    public $arrtime1;
    public $arrtime2;

    /** NUEVOS CAMPOS PARA DISCRIMINACION DE PRECIOS */
    public $precio_trip1_a;
    public $precio_trip1_c;
    public $precio_trip2_a;
    public $precio_trip2_c;
    
    public $precio_exten1_a;
    public $precio_exten1_c;
    
    public $precio_exten2_a;
    public $precio_exten2_c;
    
    public $precio_exten3_a;
    public $precio_exten3_c;
    
    public $precio_exten4_a;
    public $precio_exten4_c;

    /** FIN AGREGADOS*/
    
    public $precioA;
    public $precioN;
    public $extension1;
    public $precio_e1;
    public $pickup_exten1;
    public $extension2;
    public $precio_e2;
    public $pickup_exten2;
    public $extension3;
    public $precio_e3;
    public $pickup_exten3;
    public $extension4;
    public $precio_e4;
    public $pickup_exten4;

    /** Nuevos Campos*/
    public $room1;
    public $room2;
    /** fin de nuevo campos*/

    public $fecha_salida;
    public $fecha_salida_ns;
    public $fecha_retorno;
    public $fecha_retorno_ns;
    public $pax;//adult
    public $pax2;//child
    public $pax3;//infat
    public $pax_r;//adult
    public $pax2_r;//child
    public $pax3_r;//infat
    public $id_clientes;
    public $customer_disabilities;
    public $pickup1;
    public $dropoff1;
    public $pickup2;
    public $dropoff2;
    public $totaltotal;
    public $pago;
    public $op_pago;
    public $op_pago_conductor;
    public $otheramount;
    public $paid_driver;
    public $passenger_balance_due;
    public $agency_balance_due;
    public $pred_paid_amount;
    public $total_paid;
    public $total_charge;
    public $id1;
    public $id2;    
    public $Btnpay;
    public $extra_charge;
    public $descuento_procentaje;
    public $descuento_valor;
    public $tipo_pago;
    public $codconf;
    public $hora;
    public $total2;
    public $comments;
    public $comments2;
    public $resident;
    public $agen;
    public $tipo_client;
    public $reward_id;
    public $agency;
    public $luggage1;
    public $luggage2;
    public $canal;
    public $estado;
    public $ip_op;
    public $toutwcharge;
    public $id_bus;
    public $estado_one;
    public $estado_round;
    public $viajes_one;
    public $viajes_round;
    public $_table = 'reservas';
    public $_primarykey = 'id';
    public $_fields = array('id', 'id_tours', 'type_tour', 'fecha_ini', 'trip_no', 'trip_no2', 'tipo_ticket', 'fromt', 'tot', 'tarifa_one', 'fromt2', 'tot2', 'tarifa_round','firsname', 'lasname', 'email', 'deptime1', 'deptime2', 'arrtime1', 'arrtime2', 'precio_trip1_a', 'precio_trip1_c', 'precio_trip2_a', 'precio_trip2_c','precio_exten1_a','precio_exten1_c','precio_exten2_a','precio_exten2_c','precio_exten3_a','precio_exten3_c','precio_exten4_a','precio_exten4_c','precioA', 'precioN', 'extension1', 'precio_e1', 'pickup_exten1', 'extension2', 'precio_e2', 'pickup_exten2', 'extension3', 'precio_e3', 'pickup_exten3', 'extension4', 'precio_e4', 'pickup_exten4','room1','room2', 'fecha_salida', 'fecha_salida_ns', 'fecha_retorno', 'fecha_retorno_ns', 'pax', 'pax2','pax3','pax_r', 'pax2_r','pax3_r','id_clientes','customer_disabilities', 'pickup1', 'dropoff1', 'pickup2', 'dropoff2', 'tipo_pago', 'pago','op_pago', 'op_pago_conductor', 'totaltotal', 'otheramount', 'paid_driver', 'passenger_balance_due', 'agency_balance_due', 'pred_paid_amount', 'total_paid', 'total_charge', 'id1', 'id2', 'Btnpay', 'extra_charge', 'descuento_procentaje', 'descuento_valor', 'codconf', 'hora', 'total2', 'comments', 'comments2', 'resident', 'agen', 'tipo_client', 'reward_id', 'agency', 'luggage1', 'luggage2', 'canal', 'estado', 'ip_op', 'toutwcharge', 'id_bus', 'estado_one','estado_round','viajes_one','viajes_round');

}
