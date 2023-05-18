<?php

Doo::loadCore('db/DooModel');

class ClientBonosBase extends DooModel {

    public $id;
    public $client_id;
    public $reserve_id;
    public $bono_id;
    public $bono_nombre;
    public $points;
    public $valid_unitl;
    public $active;
    public $ammount;
    public $discuont_value;
    public $_table = 'client_bonos';
    public $_primarykey = 'id';
    public $_fields = array('id', 'client_id', 'reserve_id', 'bono_id','bono_nombre', 'points', 'valid_unitl', 'active', 'ammount', 'discuont_value');

}