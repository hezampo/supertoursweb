<?php
Doo::loadCore('db/DooModel');

class TarifasvipBase extends DooModel{

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
    public $price;

    public $type_rate;


    public $id_agency;

    public $company_name;

    public $annio;

    public $_table = 'tarifasvip';
    public $_primarykey = 'id';
    public $_fields = array('id','cantidad','price','type_rate','id_agency','company_name','annio');


}