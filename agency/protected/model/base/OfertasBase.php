<?php
Doo::loadCore('db/DooModel');

class OfertasBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 4.
     */
    public $trip_from;

    /**
     * @var varchar Max length is 40.
     */
    public $trip_to;
    
    //public $capacity;
    
    public $fecha_ini;
	
	public $fecha_fin;
	
	public $trip_no;
	
	public $price;
	
	public $price2;
	
	public $price3;
	
	public $price4;
	public $regular;
	public $frecuente;
	
    public $_table = 'ofertas';
    public $_primarykey = 'id';
    public $_fields = array('id','trip_from','trip_to', 'fecha_ini' ,'fecha_fin','trip_no','price','price2','price3','price4','regular','frecuente');

}