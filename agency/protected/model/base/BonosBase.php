<?php

Doo::loadCore('db/DooModel');

class BonosBase extends DooModel {

    public $id;
    public $codigo;
    public $nombre;
    public $tipo_cliente;
    public $rule_id;
    public $asignado;
    public $redimido;
    public $valor;
    public $cantidad;
    public $fecha_creacion;
    public $fecha_vencimiento;
    public $_table = 'bonos';
    public $_primarykey = 'id';
    public $_fields = array('id', 'codigo', 'nombre', 'tipo_cliente', 'rule_id', 'asignado', 'redimido','valor','cantidad','fecha_creacion', 'fecha_vencimiento');

}