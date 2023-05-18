<?php
Doo::loadCore('db/DooModel');

class ExtenpickupdrBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 4.
     */
    public $id_extension;

    /**
     * @var varchar Max length is 40.
     */
    public $place;
    
    //public $capacity;
    
    public $address;
	
	
	
	
	
    public $_table = 'pickupdropoff_exten';
    public $_primarykey = 'id';
    public $_fields = array('id','id_extension','place', 'address' );

}