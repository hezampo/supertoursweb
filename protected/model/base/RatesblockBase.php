<?php
Doo::loadCore('db/DooModel');

class RatesblockBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $id_hotel;

    /**
     * @var varchar Max length is 40.
     */
    public $fecha_ini;

    /**
     * @var varchar Max length is 40.
     */
    public $fecha_fin;

 

    public $_table = 'ratesblock';
    public $_primarykey = 'id';
    public $_fields = array('id','id_hotel','fecha_ini','fecha_fin');

   
}