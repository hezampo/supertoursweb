<?php
Doo::loadCore('db/DooModel');

class AcreditoBase extends DooModel{

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
    public $id_agency_account;

    /**
     * @var double Max length is 2.
     */
   public $disponible;

    public $_table = 'credito';
    public $_primarykey = 'id';
    public $_fields = array('id','fecha','cantidad','id_agency_account','disponible');

   
}