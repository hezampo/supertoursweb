<?php
Doo::loadCore('db/DooModel');

class Tours_Nota_CrediBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $id_tours;
    public $valor;
    public $usuario;
    public $fecha;
    public $tipo;
    public $_table = 'tours_notacredi';
    public $_primarykey = 'id';
    public $_fields = array('id','id_tours','valor','usuario','fecha','tipo');

    
}