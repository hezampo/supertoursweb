<?php
Doo::loadCore('db/DooModel');

class TripsBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 4.
     */
    public $trip_no;

    /**
     * @var varchar Max length is 40.
     */
    public $equipment;
    
    //public $capacity;
    
    public $lunes;
	
	public $martes;
	
	public $miercoles;
	
	public $jueves;
	
	public $viernes;
	
	public $sabado;
	
	public $domingo;
	
    public $_table = 'trips';
    public $_primarykey = 'id';
    public $_fields = array('id','trip_no','equipment', 'lunes' ,'martes','miercoles','jueves','viernes','sabado','domingo');

}