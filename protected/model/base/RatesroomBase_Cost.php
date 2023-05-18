<?php
Doo::loadCore('db/DooModel');

class Ratesroom_CostBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $id_hotel;

    /**
     * @var varchar Max length is 40.
     */
    public $fecha_ini;

    /**
     * @var varchar Max length is 40.
     */
    public $fecha_fin;

    /**
     * @var char Max length is 2.
     */
    public $sgl;

    /**
     * @var char Max length is 1.
     */
    public $dbl;

    public $tpl;

    public $qua; 
    
    
    public $brackfast; 
    
    public $super_breakfast;
    
    public $_table = 'hotel_cost';
    
    public $_primarykey = 'id';
    
    public $_fields = array('id','id_hotel','fecha_ini','fecha_fin','sgl','dbl','tpl','qua', 'brackfast','super_breakfast');

   
}