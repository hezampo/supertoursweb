<?php

Doo::loadCore('db/DooModel');



class PickupDropoffBase extends DooModel{


    public $id;

    public $id_area;

    public $place;
    
    public $address;

    public $valid;

    public $posicion;

    public $trip100;

    public $trip200;

    public $trip300;
    
    public $trip101;

    public $trip201;

    public $trip301;

    public $type_web;

    public $active_web;	

    public $_table = 'pickup_dropoff';

    public $_primarykey = 'id';

    public $_fields = array('id','id_area','place', 'address','valid','posicion','trip100','trip200','trip300','trip101','trip201','trip301','type_web','active_web');



}