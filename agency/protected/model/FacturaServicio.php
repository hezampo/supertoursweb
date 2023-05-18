<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 11/15/13
 * Time: 4:44 PM
 */

Doo::loadCore('db/DooModel');

class FacturaServicio extends DooModel{
    public $id;
    public $id_factura;
    public $id_servicio;
    public $tipo_servicio;

    public $_table = 'facturaservicio';
    public $_primarykey = 'id';
    public $_fields = array('id','id_factura','id_servicio','tipo_servicio');
} 