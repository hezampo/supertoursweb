<?php

Doo::loadCore('db/DooModel');

class Traffic extends DooModel {

    public $id;

    public $id_tour;

    public $type_tour;

    public $time_am;

    public $from;

    public $to;

    public $time_pm;

    public $id_bus_am;

    public $id_bus_pm;

    public $id_driver_am;

    public $id_driver_pm;

    public $date;

    public $id_attraction_trafic;

    public $id_cliente;

    public $type_traffic;

    public $type_ticket;

    public $hotel_name;

    public $parking;

    public $_table = 'traffic';

    public $_primarykey = 'id';

    public $_fields = array('id', 'id_tour', 'type_tour', 'time_am', 'from', 'to', 'id_attraction_trafic', 'date', 'id_cliente', 'time_pm', 'id_bus_am', 'id_bus_pm', 'type_traffic', 'driver_am', 'driver_pm', 'type_ticket', 'hotel_name', 'parking');

}