<?php
Doo::loadCore('db/DooModel');

class Rates_vip_GroupBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $id_grupo;

    /**
     * @var varchar Max length is 40.
     */
    public $amount;

    /**
     * @var varchar Max length is 40.
     */
    public $price;


    public $type_rate;

    public $id_agency;

    public $company_name;

    public $annio;


    public $_table = 'parques_tarifasvipgrupo';
    public $_primarykey = 'id';
    public $_fields = array('id','id_grupo','amount','price','type_rate','id_agency','company_name','annio');


}