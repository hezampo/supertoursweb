<?php
Doo::loadCore('db/DooModel');

class Reserve_RastroBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $id_reserva;
    public $tipo_cambio;
	public $detalles;
    public $fecha;
    public $usuario;
	public $tipo_usuario;
	
    public $_table = 'reservas_rastro';
    public $_primarykey = 'id';
    public $_fields = array('id','id_reserva','tipo_cambio','detalles','fecha','usuario','tipo_usuario');

    
}