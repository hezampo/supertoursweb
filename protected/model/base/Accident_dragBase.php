<?php
Doo::loadCore('db/DooModel');

class Accident_dragBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $id_driver;

    /**
     * @var varchar Max length is 40.
     */
    public $fecha;

    /**
     * @var varchar Max length is 40.
     */
    public $reporte;

    /**
     * @var char Max length is 2.
     */
    public $anexo;

  

    public $_table = 'accident_drag';
    public $_primarykey = 'id';
    public $_fields = array('id','id_driver','fecha','reporte','anexo');

   
}