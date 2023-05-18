<?php
Doo::loadCore('db/DooModel');

class Rates_GroupBase extends DooModel{

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
    public $adult;

    /**
     * @var varchar Max length is 40.
     */
    public $child;


    public $type_rate;

    public $id_agency;

    public $company_name;

    public $annio;


    public $_table = 'parques_tarifasgrupo';
    public $_primarykey = 'id';
    public $_fields = array('id','id_grupo','adult','child','type_rate','id_agency','company_name','annio');


}