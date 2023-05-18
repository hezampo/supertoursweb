<?php
Doo::loadCore('db/DooModel');

class AdebitoBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $fecha;

    /**
     * @var varchar Max length is 40.
     */
    public $cantidad;

    /**
     * @var varchar Max length is 40.
     */
   

    /**
     * @var char Max length is 2.
     */
    public $referepago;
    public $id_agency_account;
    public $_table = 'debito';
    public $_primarykey = 'id';
    public $_fields = array('id','fecha','cantidad','referepago','anexo','id_agency_account');

   
}