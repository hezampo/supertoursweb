<?php
Doo::loadCore('db/DooModel');

class Toursoneday_RastroBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $id_tours;
    public $tipo_cambio;
	public $detalles;
    public $fecha;
    public $usuario;
	public $tipo_usuario;
	
    public $_table = 'toursone_rastro';
    public $_primarykey = 'id';
    public $_fields = array('id','id_tours','tipo_cambio','detalles','fecha','usuario','tipo_usuario');

    
}