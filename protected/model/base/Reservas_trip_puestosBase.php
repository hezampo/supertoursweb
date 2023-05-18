<?php

Doo::loadCore('db/DooModel');



class Reservas_trip_puestosBase extends DooModel{



    /**

     * @var int Max length is 10.

     */

    public $id;

    public $trip_to;

	public $tipo;

    public $fecha_trip;

	public $cantidad;

    public $fecha_usado;

	public $usuario;

    public $estado;
    
    public $fecha_actividad;
	
    public $tarifa;

    public $_table = 'reservas_trip_puestos';

    public $_primarykey = 'id';

    public $_fields = array('id','trip_to','tipo','fecha_trip','cantidad','fecha_usado','usuario','estado', 'fecha_actividad','tarifa');

    

}