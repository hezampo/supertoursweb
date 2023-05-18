<?php
Doo::loadCore('db/DooModel');

class Service_driverBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $id_service_type;
    
	
	
	 public $id_driver;
    /**
     * @var varchar Max length is 40.
     */
    public $fecha;

    

    public $_table = 'services_driver';
    public $_primarykey = 'id';
    public $_fields = array('id','id_service_type','id_driver','fecha');

   
}