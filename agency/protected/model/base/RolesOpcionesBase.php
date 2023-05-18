<?php
Doo::loadCore('db/DooModel');

class RolesOpcionesBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $role_id;

    /**
     * @var varchar Max length is 5.
     */
    public $opcion;

    public $_table = 'roles_opciones';
    public $_primarykey = 'role_id, opcion';
    public $_fields = array('role_id','opcion');

    
}