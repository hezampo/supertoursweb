<?php
Doo::loadCore('db/DooModel');

class CodigosBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $tipo;

    /**
     * @var varchar Max length is 5.
     */
    public $codigo;

    /**
     * @var varchar Max length is 30.
     */
    public $descripcion;

    public $_table = 'codigos';
    public $_primarykey = 'id';
    public $_fields = array('id','tipo','codigo','descripcion');

    
}