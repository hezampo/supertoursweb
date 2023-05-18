<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reserve_RegisterBase
 *
 * @author Administrador
 */
Doo::loadCore('db/DooModel');

class Reserve_RegisterBase extends DooModel {
    //put your code here
    public $id; 
    public $id_reserva;
    public $id_agencia; 
    public $comision; 
    public $pctida; 
    public $pctroudtrip; 
    public $type_rate; 
    public $total;
    
    public $_table = 'reserve_register';
    public $_primarykey = 'id';
    public $_fields = array('id','id_reserva','id_agencia','comision','pctida','pctroudtrip','type_rate','total');

   
}
