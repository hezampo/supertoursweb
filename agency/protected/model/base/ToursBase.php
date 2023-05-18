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
class ToursBase extends DooModel {

    //put your code here
    public $id;
    public $id_client;
    public $type_client;
    public $platinum;
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
    public $id_hotel_reserve;
    public $comments;
    public $comments2;
    public $tipo_pago;
    public $pago;
    public $op_pago;
    public $op_pago_conductor;
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
    public $canal;
    public $estado;
    public $mensaje_tiquetes;
    public $tarifario;
    public $id_bus;
    
    public $_table = 'tours';
    public $_primarykey = 'id';
    public $_fields = array('id', 'id_client', 'type_client', 'platinum', 'id_agency', 'code_conf', 'agency_employee', 'creation_date', 'starting_date', 'ending_date', 'length_day', 'length_nights', 'adult', 'child', 'id_reserva', 'id_transfer_in', 'id_transfer_out', 'id_hotel_reserve', 'comments', 'comments2', 'tipo_pago', 'pago','op_pago', 'op_pago_conductor', 'total', 'totalouta', 'otheramount','otheramount_sin_tax', 'passenger_balance_due', 'paid_driver', 'agency_balance_due', 'total_paid', 'pred_paid_amount', 'total_charge', 'extra_charge', 'descuento_procentaje', 'descuento_valor', 'canal', 'estado','mensaje_tiquetes','tarifario','id_bus');

}
