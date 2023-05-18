<?php
Doo::loadCore('db/DooModel');

class UsuariosBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $usuario;

    /**
     * @var varchar Max length is 40.
     */
    public $nombre;

    /**
     * @var varchar Max length is 40.
     */
    public $password;

    /**
     * @var char Max length is 2.
     */
    public $role;

    /**
     * @var char Max length is 1.
     */
    public $estado;    
    

    public $email;    
    

    public $fecha_creacion;   
    
    

    public $usuario_creacion;   
    
    
    
    public $id_pago;
    
    
    public $usuario_pago;
    
    
    public $pin_pago;
    

    public $_table = 'usuarios';
    public $_primarykey = 'id';
    public $_fields = array('id','usuario','nombre','password','role','email','estado', 'usuario_creacion', 'fecha_creacion','id_pago','usuario_pago','pin_pago');
   
}