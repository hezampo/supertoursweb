<?php

Doo::loadCore('db/DooModel');

class Passengers_BusBase extends DooModel {

    public $id;
    public $id_reservas;
    public $tipo;    
    public $id_bus;
    public $driver;
    public $driver2;
    public $driver3;
    public $driver4;
    public $driver5;
    public $fec_ini;
    
    public $_table = 'passengers_bus';
    public $_primarykey = 'id';
    public $_fields = array('id', 'id_reservas','trip', 'id_bus', 'driver', 'driver2', 'driver3','driver4','driver5','fec_ini');

}
