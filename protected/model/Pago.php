<?php

Doo::loadCore('db/DooModel');

class Pago extends DooModel {

    public $id;
    //id del pago
    public $factura;
    //id de la factura
    public $monto;
    //monto pagado
    public $tipo;
    //tipo de pago, si es completo "FULL" o abono "DEPOSIT"
    public $medio;
    public $transnu;
    //numero del cheque

    public $adjunto;
    //adjunto de pago, ya sea el cheque o el extracto bancario o el que se necesecite (archivo)

    public $descuento;
    public $per_descuento;
    //si aplica el pago un tipo de descuento

    public $fecha;
    //fecha del pago

    public $metodo;
    //metodo de pago, si es cheque = 1, transferencia = 2, transferencia con cargo = 3, tarjeta de credito = 4
    //en el terminal = 5, en el bus = 6

    public $_table = 'pagos';
    public $_primarykey = 'id';
    public $_fields = array('id', 'factura', 'monto', 'tipo', 'medio', 'transnu', 'adjunto', 'descuento', 'por_descuento', 'fecha', 'metodo');

}
