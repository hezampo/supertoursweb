<?php
Doo::loadCore('db/DooModel');

class CountryBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $name;

    /**
     * @var varchar Max length is 5.
     */
    public $code;


	public $abb;
    /**
     * @var varchar Max length is 30.
     */
    

    public $_table = 'country';
    public $_primarykey = 'id';
    public $_fields = array('id','name','code','abb');

    
}