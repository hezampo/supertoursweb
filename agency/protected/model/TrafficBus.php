<?php

Doo::loadCore('db/DooModel');
class TrafficBus extends DooModel {

    public $id;

    public $short_name;

    public $name;

    public $type_bus;

    public $capacity;

    public $id_driver;

    public $_table = 'traffic_bus';

    public $_primarykey = 'id';

    public $_fields = array('id', 'short_name', 'name', 'type_bus', 'capacity', 'id_driver');

} 