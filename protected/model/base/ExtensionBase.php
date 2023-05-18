<?php
Doo::loadCore('db/DooModel');

class ExtensionBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $id_area;
    public $place;
       
    public $address;
    /**
     * @var varchar Max length is 4.
     */
    public $id_pickup_dropoff;

    /**
     * @var date
     */
    public $precio;

    public $precio_neto;
    
    public $precio_especial;


    public $valid;
    /**
     * @var char Max length is 4.
     */
   

    public $_table = 'extension';
    public $_primarykey = 'id';
    public $_fields = array('id','id_area','place','address','id_pickup_dropoff','precio','precio_neto','precio_especial','valid');

    
}