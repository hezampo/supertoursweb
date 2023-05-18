<?php

Doo::loadCore('db/DooModel');
class TrafficTypeTicket extends DooModel {

    public $id;

    public $type;

    public $description;

    public $_table = 'traffic_type_ticket';

    public $_primarykey = 'id';

    public $_fields = array('id', 'type', 'description');
}