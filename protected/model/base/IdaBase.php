<?php
Doo::loadCore('db/DooModel');

class IdaBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id_reservas;

    public $fecha_salida;

    public $pickup1;
    public $dropoff1;
    public $pax1;
	public $total;
    
	
    public $_table = 'ida';
    public $_primarykey = 'id_reservas';
    public $_fields = array('id_reservas','fecha_salida','pickup1','dropoff1','pax1','total');

    
}