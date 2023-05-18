<?php
Doo::loadCore('db/DooModel');

class AgencomiBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $service;

    /**
     * @var varchar Max length is 40.
     */
    public $service_code;

    /**
     * @var varchar Max length is 40.
     */
    public $comision;

    /**
     * @var char Max length is 2.
     */


   

    public $_table = 'agencia_comision';
    public $_primarykey = 'id';
    public $_fields = array('id','service','service_code','comision');

   
}