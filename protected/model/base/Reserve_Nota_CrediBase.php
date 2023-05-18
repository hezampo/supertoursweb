<?php
Doo::loadCore('db/DooModel');

class Reserve_Nota_CrediBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $id_reserva;
    public $valor;
    public $usuario;
	public $fecha;
	
    public $_table = 'reservas_notacredi';
    public $_primarykey = 'id';
    public $_fields = array('id','id_reserva','valor','usuario','fecha');

    
}