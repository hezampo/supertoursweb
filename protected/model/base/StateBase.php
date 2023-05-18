<?php
Doo::loadCore('db/DooModel');

class StateBase extends DooModel{

    /**
     * @var int Max length is 2.
     */
    public $id;

    /**
     * @var varchar Max length is 40.
     */
    public $name;
    public $abb;


    public $_table = 'state';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','abb');
    
}