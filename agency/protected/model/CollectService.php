<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/9/13
 * Time: 4:01 PM
 */
Doo::loadCore('db/DooModel');
class CollectService extends DooModel{

    public $id;

    //id del servicio al que pertenece el collect
    public $id_servicio;
    //tipo de servicio 'ONE', 'MULTI' o 'RESERVE'
    public $tipo_servicio;
    //monto pagado a la fecha del collect
    public $monto_pagado;

    public $_table = 'collectservice';

    public $_primarykey = 'id';

    public $_fields = array('id','id_servicio','tipo_servicio','monto_pagado');


} 