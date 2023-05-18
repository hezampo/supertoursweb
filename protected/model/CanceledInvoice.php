<?php
/**
 * Created by PhpStorm.
 * User: minrock
 * Date: 12/16/13
 * Time: 11:39 AM
 */

Doo::loadCore('db/DooModel');
class CanceledInvoice extends  DooModel{

    public $id;

    public $factura;

    public $motivo;

    public $adjunto;

    public $_table = 'CancelledInvoices';

    public $_primarykey = 'id';

    public $_fields = array('id','factura','motivo','adjunto');

} 