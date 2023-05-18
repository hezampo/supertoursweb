<?php
Doo::loadCore('db/DooModel');

class ProgramacionBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 4.
     */
    public $trip_no;

    /**
     * @var date
     */
    public $fecha;

    /**
     * @var char Max length is 4.
     */
    public $anno;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    public $_table = 'programacion';
    public $_primarykey = 'id';
    public $_fields = array('id','trip_no','fecha','anno','estado');

    
}