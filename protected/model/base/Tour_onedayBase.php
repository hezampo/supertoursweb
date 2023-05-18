<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Doo::loadCore('db/DooModel');

/**
 * Description of Tours
 *
 * @author Administrador
 */
class Tour_onedayBase extends DooModel {

    //put your code here
    public $id;
    public $id_client;
    public $type_client;
    public $id_agency;
    public $code_conf;
    public $agency_employee;
    public $creation_date;
    public $starting_date;
    public $ending_date;
    public $length_day;
    public $length_nights;
    public $adult;
    public $child;
    public $id_reserva;
    public $id_transfer_in;
    public $id_transfer_out;
    public $comments;
    public $comments2;
    

    /** Discriminacion de precios */
    public $t_price_adult;
    public $t_price_child;
    public $t_parque_adult;
    public $t_parque_child;
    public $entradas_price_adult;
    public $entradas_price_child;
    public $price_exten1_adult;
    public $price_exten1_child;
    public $price_exten2_adult;
    public $price_exten2_child;
    public $price_especial;

    /** Fin Discriminacion de Precios */
    public $total;
    public $totalouta;
    public $otheramount;
    public $otheramount_sin_tax;
    public $passenger_balance_due;
    public $paid_driver;
    public $agency_balance_due;
    public $total_paid;
    public $pred_paid_amount;
    public $total_charge;
    public $extra_charge;
    public $descuento_procentaje;
    public $descuento_valor;
    public $tipo_pago;
    public $pago;
    public $op_pago;
    public $op_pago_conductor;
    public $canal;
    public $estado;
    public $include_park;
    public $group_park;
    public $id_bus;
    public $ip_op;
    
    public $_table = 'tours_oneday';
    public $_primarykey = 'id';
    public $_fields = array('id', 'id_client', 'type_client', 'id_agency', 'code_conf', 'agency_employee', 'creation_date', 'starting_date', 'ending_date', 'length_day', 'length_nights', 'adult', 'child', 'id_reserva', 'id_transfer_in', 'id_transfer_out', 'comments', 'comments2', 't_price_adult', 't_price_child', 't_parque_adult', 't_parque_child', 'entradas_price_adult', 'entradas_price_child', 'price_exten1_adult', 'price_exten1_child', 'price_exten2_adult', 'price_exten2_child', 'price_especial', 'total', 'totalouta', 'otheramount', 'otheramount_sin_tax', 'passenger_balance_due', 'paid_driver', 'agency_balance_due', 'total_paid', 'pred_paid_amount', 'total_charge', 'extra_charge', 'descuento_procentaje', 'descuento_valor', 'canal','tipo_pago','pago','op_pago','op_pago_conductor','estado', 'include_park','group_park','id_bus','ip_op');

}
