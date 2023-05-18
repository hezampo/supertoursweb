<?php
Doo::loadCore('db/DooModel');

class Grupo_parqueBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $nombre;

    /**
     * @var varchar Max length is 40.
     */
    public $code_refe;

    /**
     * @var varchar Max length is 40.
     */
    

    public $_table = 'grupo_parques';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','code_refe');

   
}