<?php
Doo::loadCore('db/DooModel');

class RolesBase extends DooModel{

    /**
     * @var int Max length is 2.
     */
    public $id;

    /**
     * @var varchar Max length is 40.
     */
    public $role;

    /**
     * @var varchar Max length is 200.
     */
    public $descripcion;

    public $_table = 'roles';
    public $_primarykey = 'id';
    public $_fields = array('id','role','descripcion');

    
}