<?php
Doo::loadCore('db/DooModel');

class RegresoBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id_reservas;

    public $fecha_retorno;

    public $pickup2;
    public $dropoff2;
    public $pax2;
	public $total;
    
	
    public $_table = 'regreso';
    public $_primarykey = 'id_reservas';
    public $_fields = array('id_reservas','fecha_retorno','pickup2','dropoff2','pax2','total');

    
}