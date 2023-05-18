<?php
Doo::loadCore('db/DooModel');

class Parks_vip_rateBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $cantidad;

    /**
     * @var varchar Max length is 40.
     */
    public $valor;

    /**
     * @var varchar Max length is 40.
     */


    public $_table = 'parque_tarifa_vip';
    public $_primarykey = 'id';
    public $_fields = array('id','cantidad','valor');

   
}