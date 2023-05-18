<?php
Doo::loadCore('db/DooModel');

class AreasBase extends DooModel{

    /**
     * @var int Max length is 2.
     */
    public $id;

    /**
     * @var varchar Max length is 40.
     */
    public $nombre;


    public $_table = 'areas';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre');
    
}