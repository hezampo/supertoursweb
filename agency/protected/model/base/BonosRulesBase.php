<?php

Doo::loadCore('db/DooModel');

class BonosRulesBase extends DooModel {

    public $id;
    public $tipo_bono;
    public $valor;
    public $vencimiento;
    public $_table = 'bonos_rules';
    public $_primarykey = 'id';
    public $_fields = array('id', 'tipo_bono', 'valor', 'vencimiento');

}