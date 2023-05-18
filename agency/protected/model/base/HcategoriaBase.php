<?php
Doo::loadCore('db/DooModel');

class HcategoriaBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 4.
     */
    public $nombre;

    /**
     * @var varchar Max length is 40.
   */
    public $star;
    
    
	
    public $_table = 'hotelcategoria';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','star');

}