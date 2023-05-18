<?php
Doo::loadCore('db/DooModel');

class Bus_TripsBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id_bus;

    /**
     * @var varchar Max length is 4.
     */
    public $id_trips;

    /**
     * @var varchar Max length is 40.
     */
    
   
	
    public $_table = 'bus_trips';
   
    public $_fields = array('id_bus','id_trips');

}