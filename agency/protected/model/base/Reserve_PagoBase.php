<?php
Doo::loadCore('db/DooModel');

class Reserve_PagoBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    public $id_reserva;
    public $pago;
	public $tipo_pago;
    public $pagado;
    public $usuario;
	public $fecha;
	
    public $_table = 'reservas_pago';
    public $_primarykey = 'id';
    public $_fields = array('id','id_reserva','pago','tipo_pago','pagado','usuario','fecha');

    
}