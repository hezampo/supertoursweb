<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Doo::loadCore('db/DooModel');
/**
 * Description of Tours_Agency
 *
 * @author Administrador
 */
class Tours_AgencyBase extends DooModel {
    //put your code here
    public $id;
    public $id_reserva;
    public $id_tours;
    public $type_tour; 
    public $id_agencia;
    public $comision; 
    public $type_rate;
    public $agency_fee; 
    public $tipo_pago; 
    public $pago; 
    public $totalouta; 
    public $otheramount;
    public $total; 
    public $_table = 'tours_agency';
    public $_primarykey = 'id';
    public $_fields = array('id', 'id_reserva', 'id_tours', 'type_tour', 'id_agencia', 'comision', 'type_rate', 'agency_fee', 'tipo_pago', 'pago', 'totalouta','otheramount', 'total');           
            
}


