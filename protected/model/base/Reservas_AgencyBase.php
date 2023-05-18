<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reserve_RegisterBase
 *
 * @author Administrador
 
 /*
 CREATE TABLE IF NOT EXISTS `reservas_agency` (
  `id_reservas` int(11) DEFAULT NULL,
  `id_agencia` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `type_client` int(11) NOT NULL,
  `id_useragency` int(11) NOT NULL,
  `paid_type` int(11) DEFAULT NULL,
  `metodo_paid` int(11) DEFAULT NULL,
  `paid_net` double(10,2) DEFAULT NULL,
  `paid_full` double(10,2) DEFAULT NULL,
  `agency_fee` double(10,2) DEFAULT NULL,
  `comision` double(10,2) DEFAULT NULL,
  `paper_voucher` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 */

Doo::loadCore('db/DooModel');

class Reservas_AgencyBase extends DooModel {
    //put your code here
    public $id; 
    public $id_reservas;
    public $id_agencia; 
	public $id_cliente; 
	public $type_client; 
	public $id_useragency; 
	public $paid_type; 
	public $metodo_paid; 
	public $paid_net; 
    public $paid_full; 
    public $agency_fee;
	public $otheramount; 
    public $comision; 
    public $paper_voucher; 
    
    public $_table = 'reservas_agency';
    public $_primarykey = 'id';
    public $_fields = array('id','id_reservas','id_agencia','id_cliente','type_client','id_useragency','paid_type','metodo_paid','paid_net','paid_full','agency_fee','otheramount','comision','paper_voucher');

   
}


