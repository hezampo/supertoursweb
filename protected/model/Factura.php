<?php


Doo::loadCore('db/DooModel');

class Factura extends DooModel{

    public $id;
    public $id_agency;
    public $creation_date;
    public $subtotal;
    public $collect;
    public $total;
    public $canal;
    public $estado;

    public $_table = 'factura';
    public $_primarykey = 'id';
    public $_fields = array ('id','id_agency','creation_date','subtotal','collect','total','canal','estado');

} 