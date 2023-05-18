<?php
Doo::loadCore('db/DooModel');

class Type_serviceBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $name_service;

    /**
     * @var varchar Max length is 40.
     */
    public $price;

    

    public $_table = 'type_service';
    public $_primarykey = 'id';
    public $_fields = array('id','name_service','price');

   
}