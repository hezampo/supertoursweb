<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 11/15/13
 * Time: 4:31 PM
 */

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